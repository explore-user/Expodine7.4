<?php
include('includes/session.php');		
include("database.class.php"); 
$database	= new Database();

include('includes/master_settings.php');
require_once("includes/title_settings.php");
//require_once("includes/menu_settings.php");
include("api_multiplelanguage_link.php");



if(isset($_REQUEST['billnoview'])){
     
        $row2=array();
        $opt=array();    $opt2=array();
        $multibill=     'temp_'.$_REQUEST['billnoview'];
       
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments  where mc_billno='".$multibill."' order by mc_id DESC limit 10");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                   $row2[]=$result_fnctvenue;
                }
              }
        
                                           $option="";
                                           $sql_rsn1 = "select crd_id,crd_name from tbl_cardmaster where crd_active = 'Y' ";
                                           $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                           $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                           if ($num_rsns1) {
                                           while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                               }}
                               
                               
                    $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;     
                              
    $opt[]=$option;
   
    if($row2!="" && $opt!=""){
       echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
    }
}


if(isset($_REQUEST['camount'])){
     
             $row2=array();
             $opt=array();  $opt2=array();
             $multibill=     'temp_'.$_REQUEST['billno'];
             $multicardnum= $_REQUEST['cnumber'];
             $multicardtype=$_REQUEST['ctype'];
             $multicardamount=$_REQUEST['camount'];
    
             
       if($multicardamount>0){              
             
           if($_REQUEST['full_settle']!="Y"){  
              
             $insertion['mc_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($multibill));
          }else{
              
             $insertion['mc_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['billno']));   
          }
             
             
             
             if($_REQUEST['btype']!=""){
               $insertion['mc_to_bank']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['btype']));
             }else{
               $insertion['mc_to_bank']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bankdefault']));  
             }
             
             
              if($multicardtype!=""){
             $insertion['mc_cardtype']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardtype));
             }
             
             $insertion['mc_cardamount']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardamount));
             
             if($multicardnum!=""){
             $insertion['mc_carnumber']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardnum));
             }
        
            $sql=$database->check_duplicate_entry('tbl_bill_card_payments',$insertion);
            if($sql!=1)
             {
                
	      $insertid      =  $database->insert('tbl_bill_card_payments',$insertion);  
         
            $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments   where mc_billno='".$multibill."' order by mc_id DESC limit 10" );
            $num_fdtl = $database->mysqlNumRows($fnct_menu);
            if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                 $row2[]=$result_fnctvenue;
              }
            }
        
                    $option="";
                    $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                     }}
                     
                    $opt[]=$option;
                    
                    
                    $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;
                    
                    
   
                }
 
               echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
       }
   }
   

 $tastatuscs="";
 if(isset($_REQUEST['setcscommon'])&& ($_REQUEST['setcscommon']=='settlecspopup')) 
 {
     
  $tastatuscs=$_REQUEST['setcscommon'];
   
}

 if(isset($_REQUEST['setmultinew16'])&&($_REQUEST['setmultinew16']=="multicardnew16")){
     
     $multibilledit16=     $_REQUEST['multibillnew16'];
     $_SESSION['billcardcs']=$multibilledit16;
             
 } 
            
 if(isset($_REQUEST['setdel'])&&($_REQUEST['setdel']=="delcar")){
     
   $multibilldel=      'temp_'.$_REQUEST['bilcard'];
   $multislnodel=     $_REQUEST['slnocard'];
          
   $query321=$database->mysqlQuery(" DELETE FROM tbl_bill_card_payments WHERE mc_billno='$multibilldel' and mc_slno='$multislnodel' ");    
             
 }          


if(isset($_REQUEST['set']) && $_REQUEST['set']=="secretkeycheck") 
{

 $result="";
 $sql_table_sel3  = $database->mysqlQuery("SELECT ser_cancelwithkey  from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
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
	{ 
	        $sql_table_sel3  = $database->mysqlQuery("SELECT sr_staffid from tbl_secretkeymaster  WHERE sr_staffid='".$_REQUEST['stafflist']."' and sr_key='".$_REQUEST['secretkey']."' AND  (sr_expiredtime ='0000-00-00 00:00:00' OR  sr_expiredtime IS NULL) AND sr_defaultkey='Y'"); 
		$num_table3  = $database->mysqlNumRows($sql_table_sel3);
		if($num_table3)
		{
			  echo "key_ok";
		}else
		{
			  echo "key_sorry";
		}
	}else
	{
		          echo "key_sorry";
	}
}else
{
	if($_REQUEST['secretkey']!='')
	{
	   $sql_table_sel3  = $database->mysqlQuery("SELECT ls_staffid from tbl_logindetails  WHERE ls_staffid='".$_REQUEST['stafflist']."' and ls_password='".md5($_REQUEST['secretkey'])."'");
		$num_table3  = $database->mysqlNumRows($sql_table_sel3);
		if($num_table3)
		{
			  echo "key_ok";
		}else
		{
			  echo "key_sorry";
		}
	}else
	{
		          echo "key_sorry";
	}
}
 
}

$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
$opendate=  trim(json_encode($_SESSION['date']),'""');
$listimage=  trim(json_encode($_SESSION['s_listimage']),'""');

$floorid="";

if( !isset($_SESSION['cursession']) ) {
    
    $_SESSION['cursession'] = 1;
    
}else{

 if(isset($_REQUEST['set5'])&&($_REQUEST['set5']=="cat5")){
     
           $iddcur1212=trim($_REQUEST['idofcur5']); 
           $_SESSION['cursession']=$iddcur1212;
           echo $_SESSION['cursession'];   
           
           $_SESSION['cs_order_id']='';
           unset($_SESSION['cs_order_id']);
    
    }
}


if(!isset($_SESSION['timeopen']) ){
    
    header("location:index.php?msg=1"); 
    
}


if(!isset($_SESSION['cs_order_id']))
{
    
    
     $orderid="TEMP*".$database->getEpoch();
     //$_SESSION['cs_order_id']=$orderid;


        $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        
        $ips=  substr($localIP,($ln-3),3);
        
        
	 $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;

}


?>

<!DOCTYPE HTML>
<html style="overflow: hidden;"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Counter Sale</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/calculator.css">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/counter_order_new.css" rel="stylesheet" type="text/css">
<!--<link href="css/whitebg/take_away.css" rel="stylesheet" type="text/css">-->

<!--  multiple select drop down starts -->
<link rel="stylesheet" href="css/bootstrap-3.3.2.min.css" type="text/css">
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
<!--js File Attachement-->

<script src="js/jquery-1.10.2.min.js"></script>

<style>
  
    
    .right_top_action_btn{    top: 51px;}
    .notification_1{top: 15px;}
.ui-autocomplete{z-index:999999 !important;max-height: 400px;    height: auto; overflow: scroll;}
.new_right_drop{margin-top:-8px;top: 14px !important;}
.tka_sum_btn_cc{ padding: 1% 1.2%;}
.take_left_main_list{height:75vh;min-height: 510px;}
.menu_item_contain_new{
    width: 100%;
    max-height: 70vh;
    height: auto !important;
    float: left;
    overflow: auto;
    padding: 0.5% 0 0 0.5%;
    display: flex !important;
    align-items: stretch;
    flex-wrap: wrap;
    gap: 5px;
    row-gap:5px;
    border-bottom: 0; 
    padding: 5px;
    padding-left: 10px;  
    padding-top: 15px;
}
.tkw_sub_items_cc{
    min-height: 592px;
    height: 93vh;
}

@media screen and (max-width: 1200px) {
    .menu_sub_item1{
        width: 160px !important;
    }
}
@media screen and (max-width: 1200px) {
    .menu_sub_item1{
        width: 140px !important;
    }
}

@media  (min-height: 768px) {.take_left_main_list,.menu_item_contain{	height: 80vh !important;}}
	@media  (min-height: 1050px) {.take_left_main_list,.menu_item_contain{	height: 81vh !important;}}
.right_main_contant_cc{height:77vh;}
.left_contant_container{min-height:inherit}
.left_contant_container{min-height:inherit;height:auto;}
.right_calc_cc{min-height:inherit;}
.tottal_rate_contain{margin-right:0}
.errorpaymentpop{position: absolute;left:0px;top: 0;color:#fff !important;padding:0 10px ;} 
.payment_hold_pop_buton_cc{line-height: 50px;padding-left: 10px;}             
                #content1 {
                    left: 1%;
                    right: 1%;
                    position: absolute;}
                .md-content{top:5% !important;}
                .menu-trigger{display:none;}
                .md-content button{position:absolute;}
                .main_div_dyc .right_div_cc{height:82vh !important;}
                .right_div_cc{height: 74vh;min-height: 590px !important;}
                .main_div_dyc .ordelist_table{  height: 67.5vh !important;/*min-height: 445px !important;*/}
                .navbar-brand{margin-top:-13px}
                .perspective .btn{border: solid 1px #ABABAB !important;}
                .menu_order_dish_name {width: 47%;overflow:hidden}
                .portion_txt{    width: 35%;}
                .quantity_txt { width: 14%;}
                .ordelist_table{margin-top:0px;}
                .center_contain_1{padding-bottom:40px;min-height:540px;}
                .left_main_menu_items li{display:inline}
                .left_main_menu_items li a{margin-right: 5px;margin-bottom: 5px;padding: 0 35px !important;height: 39px !important;}
                .md-content{width:502px !important;right:0px;left:0px !important;}
                #popup_box .form-control{height:30px;}
				.counter_payment_contain{    min-height: 439px;}
				.paid_amount_cc{width: 100%;margin-top: 5px;margin-bottom: 5px;}
				.crd_head{margin-bottom:0px;}
				.counter_settle_popup_right_calc_cc{height:584px}
				.counter_settle_popup{top:1%; height:584px;}
                                 .size_compat option{font-size:20px}
                                 .rateentry::-webkit-input-placeholder { color: black; }
								 .close_card_pop {width: 7%;height: 45px;float: right;text-align: center;line-height: 47px;cursor: pointer;right: 7px;position: absolute;top: -5px;opacity: 0.7;}
                                                                  .pop-navigation{
     
         color: white;
    float: left;
    text-decoration: none;
    border: solid;
    border-radius: 4px;
    border-width: 1px;
    margin: 0.5%;
    line-height: 24px;
    height: 25px;
    font-size: 14px;
    text-align: center;
    padding: 0 9px;
    background-color: #793333;
    
 }
 .pop-navigation:hover{color:white}
 .counter_main_orderd_detail_contant td{border-bottom: 0}
    .counter_main_orderd_detail_contant{height: 50vh;min-height: 300px;}
    @media(min-height:768px){
       .counter_main_orderd_detail_contant {height: 60vh;}
    }
    @media(min-height:800px){
       .counter_main_orderd_detail_contant {height: 63vh;}
    }
    @media(min-height:1050px){
       .counter_main_orderd_detail_contant {height: 65vh;}
    }
	.counter_bottm_quick_btn{width: 45%;}
	.counter_right_payment_button_cc{height: 50px;     margin-bottom: -10px;}
 .pref-td-take-away .counter_right_pref{    top: -9px;}
 .kot_cancel_value_btn{    width: 37px;height: 37px;float: left;margin: 1%;cursor: pointer;border: solid 1px #fff;border-radius: 10px;line-height: 35px;
    text-align: center;color: #fff;font-size: 22px;font-family: 'CALIBRI_0';background-color: #7b0000;box-shadow: 1px 1px 5px #4a4949;
    -webkit-box-shadow: 1px 1px 5px #4a4949; margin-left: 5px;}
 .counter_sl_payment_hist_pop{    width: 850px;}
	.right_main_cc{min-height: 536px;height: 80.8vh; }	
    .customer_list_autoload{    width: 100%;top: 31px;    right: 0;}
    .combo_button_mn_odr span{top: 1px;}
    .combo_menu .menu_sub_item strong{color: #cc3500;}
    .combo_menu .menu_sub_item p{font-size: 13px;color: #797979; font-weight: lighter !important;margin: 0;    line-height: 15px;}
    .combo_menu .take_item_active.menu_sub_item strong{color: #fff;}
     .combo_menu .take_item_active.menu_sub_item p{color: #fff;}
    .combo_menu .menu_sub_item{padding: 4px 14px;}
    .combo_menu .menu_sub_item {padding: 4px 14px;max-width: 200px;max-height: 75px;overflow: hidden;}
    @media (max-width: 1148px){.combo_button_mn_odr {padding-top: 0px;}.combo_button_mn_odr img { width: 20%;}}
      #combo_ordering_popup .combo_image_load{margin-top: 15% !important}
         
.addon_section{cursor: default !important;background-color: transparent !important}
.addon_section_head{cursor: default !important;background-color: transparent !important}
.addon_section td{font-size: 12px;height: auto;padding-bottom: 0px}
.addon_section_head td{font-size: 12px;text-align: left;height: 10px;color: #F00;padding: 0;padding-left: 25px;padding-top: 5px}
.addon-mn-row-ad { width: 100%; height: auto;float: left; margin-bottom: 4px;}
.addon-preview-secion-mn-1 {width: 45%;height: auto;float: left;font-weight: bold;font-family: 'CALIBRIB_0';font-size: 13px;}
.addon-preview-secion-qty { width: 20%;height: auto;float: left;font-weight: bold;font-family: 'CALIBRIB_0';font-size: 13px;}
.addon-preview-secion-rate { width: 35%;height: auto;float: left;font-weight: bold;font-family: 'CALIBRIB_0'; font-size: 13px;}
.addon-mn-row-ad:last-child{ padding-bottom: 6px;  border-bottom: 1px #041a1f  solid;}
.tip_section{
    width: 375px;
    float: right;

    padding-bottom: 3px;   
}
.tip_section .selecting_payment_one {margin-top: 0px; background-color: beige;padding: 3px 0}
.tip_section .counter_right_lable{font-weight: bold}
.counter_settle_popup .tip_section .tax_textbox{  background: transparent;}
    .sec_pop_div_right{max-height: 265px;}
.nw_clr_btn{
	width: 55px;
    line-height: 35px;
    margin-top: 2px;
    height: 37px;
    border-bottom: 3px #8a4804 solid;
    background-color: rgb(208, 115, 19);
    border-radius: 5px;
}

    .pop_payment_mode_sel_btn77 {
    width: 100%;
    float: left;
    height: 35px;
    margin-top: 2px;
    background-color: rgb(88 32 33);
    color: rgb(255, 255, 255);
    text-align: center;
    line-height: 35px;
    font-size: 14px;
    cursor: pointer;
    font-family: CALIBRI_0;
    box-shadow: rgb(130, 0, 2) 0px 4px;
    margin-bottom: 7px;
    transition: all 0.2s ease;
}
.view_items_btn_dis{
    width: 100px;
    height: 33px;
    text-align: center;
    display: inline-block;
    line-height: 33px;
    font-size: 12px;
    font-family: sans-serif;
    background-color: darkred;
    color: #fff;
        top: -4px;
    position: relative;
    border-radius: 5px;
    letter-spacing: 1px;
    cursor: pointer;    
}
.disablegenerate { pointer-events: none; opacity: 0.4; cursor:none;}
.counter_logo{margin-left:1%}
.menu_sub_item1 {
    min-height: 40px;
    height: 100%;
    width: 140px;
    padding: 4px 12px;
    float: left;
    background-repeat: no-repeat;
    background-position: left;
    background-color: #fff;
    text-align: center;
    color: #000;
    font-size: clamp(14px, 2vw + 1.5em, 14px);
    line-height: 17px;
    align-items: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 1%;
    -moz-box-shadow: 3px 3px 0px #222;
    -webkit-box-shadow: 3px 3px 0px #222;
    box-shadow: 3px 3px 0px #222;
    cursor: pointer;
    position: relative;
    font-family: 'CALIBRI_0';
    border-radius: 5px;
    border: 1px;
     font-weight: bold;
}
.menu_sub_item1 p{
    margin: 0 !important;
    height: auto !important;
    line-height: 14px !important;
        max-height: 28px;
}
.menu_1:active{
    background-color:#721e35;
}
@media (min-width:1600px){
    .menu_sub_item1{
     font-size:16px;   
    }  
}


.tax_1{
    overflow-y: scroll;
    height:75px;
}
.tax_1::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #fff; 
  border-radius: 5px;
  width:5px;
  background-color:#fff;
}
.tax_1::-webkit-scrollbar {
  width: 5px;
}
.tax_1::-webkit-scrollbar-thumb {
  background: #fff; 
  border-radius: 5px;
}
.item_price { width: 100%; padding: 3px 0; font-size: 12px; color: #000; text-align: center; display: inline-block; height: auto;margin:0 !important;    line-height: 12px; }

.bdm_right{
        display:inline-block;
        width:100%;
    }

@media screen and (min-height: 768px) {
    .bdm_right{
        margin-top: 2px;
    }
}

body {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;   /* smoother fade */
}
body.loaded {
    opacity: 1;
}


</style>


<script type="text/javascript" src="js/jquery-ui-1.10.4.js"></script> 
 
 <script src="js/counter_sales.js"></script>
 <script>
 var len = $('script[src="js/counter_sales.js"]').length;
 
 if (len === 0) {
    $.getScript('js/counter_sales.js');
  }
</script>

 <script src="js/counter_holdview.js"></script>

 <script src="js/counter_each.js"></script>
 <script src="js/counter_popup.js"></script>

 <script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  
 <input type="hidden" id="search_popup_single" value="<?=$_SESSION['search_popup_single']?>">
 
 <input type="hidden" id="otp_item_cancel" value="<?=$_SESSION['otp_item_cancel']?>">
 
 <input type="hidden" id="otp_login" value="<?=$_SESSION['expodine_id']?>">
 
 <input type="hidden" id="commoncs" value="<?=$tastatuscs?>" >

 <input type="hidden" name="be_search_focus_cs" id="be_search_focus_cs" value="<?=$_SESSION['be_search_focus_counter']?>" />
 
 <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
 
 <script type="text/javascript"> 
            
 $(document).ready(function(){
     
    window.onload = function() {
     document.body.classList.add("loaded");
    };

    ///reorder code//
    
    var url_check=$('#url_check').val();
   
    var new_id=url_check.split('set_reorder=');

    if(new_id[1]=='coming'){
        
        var itemsact = $('.eachitem_counter');
        var itemsact1 = $('.preference_table');	
	var actlenght=(parseFloat(itemsact.length)+parseFloat(itemsact1.length) );
        
	if(actlenght>=1)
	{  
            
        $('.alert_error_popup_all_in_one').show();
        $('.alert_error_popup_all_in_one').text('BILLING');
       
        $('.closedisount').click();
        
        }
  
   }
   ///reorder code ends//
   
    
   $(document).click(function() { 
       var container = $("#notificationContainer");
       if (!container.is(event.target) && !container.has(event.target).length && $('.hold_list_pop_contatnt:visible').length == 0) {
         container.hide();
       }
    });
    
    
     
  $('#disountamount').keypress(function(event) {

     if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
       return true;

     else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
       event.preventDefault();

 });
      
       
 $('#discount_after_bill_btn').click(function(){
        
       $('.discount_after_cc').show();
        
       $('.paid_amount_cc').hide();
      
       $('.credit_cc_normal').hide();
       $('.credit_type').hide();
       
       $('.cheque_cc').hide();
        
       $('.paid_amount_cc_credit').hide();
         
       $('.complimentrary_cc').hide();
          
       $('.voucher_cc').hide();
       $('.coupon_cc').hide();
       $('#dis_after_manual').focus();
       
       $('#dis_after_manual').val('');
      
  });
      
      
 $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
  });
  
  
  $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
  });
                    
 if($('#pole_on').val()=='Y'){  
     
      var data_pole = "set_pole=pole_display_all&display=none";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
	});
  }             
              
   $('#search').focus();
  
   
   var ststa1=$('#commoncs').val();
                           
   if(ststa1=="settlecspopup"){
   $(".counter_sl_payment_hist").click();
   }
   
   
   $("#phone_cs").autocomplete({
                            minLength: 1,
                            source: "load_index.php?set=search_loyalty_num_method",
                            focus: function (event, ui) { 
                                
                                },
                         
                                 select: function (event, ui) {
                                 
                                $('#firstname_cs').val(ui.item.name);
                                $('#phone_cs').val(ui.item.label);
                                $('#email_cs').val(ui.item.email);
                                $('#gst_loy').val(ui.item.gst);
     
                                $("#firstname_cs").attr("edit_id", ui.item.id);
                                 localStorage.enter_key='no';
                                  return false;
                            }

   });
   
   $("#firstname_cs").autocomplete({
       
                            minLength: 1,
                            source: "load_index.php?set=search_loyalty_name_method",
                            focus: function (event, ui) {
                            
                            },
                         
                                 select: function (event, ui) {
                                 
                                $('#firstname_cs').val(ui.item.label);
                                $('#phone_cs').val(ui.item.num);
                                $('#email_cs').val(ui.item.email);
                                $('#gst_loy').val(ui.item.gst);					 
				$("#firstname_cs").attr("edit_id", ui.item.id);
                                localStorage.enter_key='no';
                                return false;
                            }

  });
   
   
   
                 
  $("#search_barcode").autocomplete({
                            minLength: 1,
                            source: "load_counter_sales.php?value=searchnameonly_barcode",
                            focus: function (event, ui) {
                              
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                            },
                         
                                 select: function (event, ui) {
                                   
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
                                
                                 var barcode = $("#search_barcode").val();
								
				$('.counter_menu_popup_overlay').css("display","block"); 
				$('.counter_menu_popup').css("display","block"); 
						  						   
									
				var request = $.ajax({
				url: "counter_popup.php",
				method: "POST",
				data: {menu:menunames,barcode:barcode,typesub:'Add' },
				dataType: "html"
				});
										 
				request.done(function( msg ) {
				$( ".counter_menu_popup" ).html( msg );
				  
				});
										
				data = null;
				msg=null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
				
                                return false;
                            }

 });     
                        
                        
  $("#search").autocomplete({
                            minLength: 1,
                            source: "load_counter_sales.php?value=searchnameonly",
                            focus: function (event, ui) {
                               
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                            },
                         
                                 select: function (event, ui) {
                                   
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
								
				$('.counter_menu_popup_overlay').css("display","block"); 
				$('.counter_menu_popup').css("display","block"); 
								  						   
									
				var request = $.ajax({
				url: "counter_popup.php",
				method: "POST",
				data: {menu:menunames,typesub:'Add' },
				dataType: "html"
				});
										 
				request.done(function( msg ) {
                                    
				$(".counter_menu_popup" ).html(msg);
				$("#search").val('');
                                $('#search').blur();
                                $("#valueofsearch_menu").val('');
                                $("#search").focus();
				$(".focussed").focus();	
                                
                                 
                                if($('#search_popup_single').val()=='Y'){
                                     
                                    $(".enter-qty-act").val('1');
                                    $('.weight-field').text('1');  
                                   
                                    $(".counter_menu_popup").css({
                                      "filter": "blur(3px)",
                                      "pointer-events": "none"
                                    });
                                      
                                    $('.countersale_addnew').click();
                                    
                                    setTimeout(function () {
                                      $(".counter_menu_popup").css({
                                        "filter": "none",
                                        "pointer-events": "auto"
                                    });
                                      
                                    }, 500);
                                    
                                    
                                }
                                
                                
				});
										
				data = null;
				msg=null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
				
                                return false;
                            }

   });
			
     //-----------searhmenu code starts-----//
     
      $("#codesrch_c").autocomplete({ 
                            minLength: 1,
                            source: "load_counter_sales.php?value=searchcode",
                            focus: function (event, ui) {
                                $("#codesrch_c").val(ui.item.label2);
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                            },
                            select: function (event, ui) {
                                 
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
								
								
								 $('.counter_menu_popup_overlay').css("display","block"); 
								$('.counter_menu_popup').css("display","block"); 
								  						   
									
										var request = $.ajax({
										  url: "counter_popup.php",
										  method: "POST",
										  data: {menu:menunames,typesub:'Add' },
										  dataType: "html"
										});
										 
										request.done(function( msg ) {
										  $( ".counter_menu_popup" ).html( msg );
										   $("#search").val('');
                                            $('#codesrch_c').blur();
                                            $("#valueofsearch_menu").val('');
                                            $("#codesrch_c").focus();
                                            $(".focussed").focus();	
                                            
					});
										
					data = null;
					msg=null;
					request.onreadystatechange = null;
					request.abort = null;
					request = null;
								
				
                                return false;
     }


     });
                    
   //----------searhmenu code ends--------------//
			
     $( "#ta_name" ).autocomplete({
				minLength: 0,
				source:"load_takeaway.php?value=searchname",
				focus: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.label );
				  return false;
				},
				select: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.label );
				  $( "#ta_mobile" ).val( ui.item.phn );
				  $( "#ta_orderaddress" ).val( ui.item.addr );
				  $( "#ta_landmark" ).val( ui.item.lndm );
				  $( "#ta_area" ).val( ui.item.are );
				  $( "#ta_address" ).val( ui.item.peraddr );
                                   $( "#ta_gst" ).val( ui.item.gst );
				  return false;
	}
	});
        
        
    $( "#ta_mobile" ).autocomplete({
				minLength: 0,
				source:"load_takeaway.php?value=searchmobile",
				focus: function( event, ui ) {
				  $( "#ta_mobile" ).val( ui.item.label );
				  return false;
				},
				select: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.name );
				  $( "#ta_mobile" ).val( ui.item.phn );
				  $( "#ta_orderaddress" ).val( ui.item.addr );
				  $( "#ta_landmark" ).val( ui.item.lndm );
				  $( "#ta_area" ).val( ui.item.are );
				  $( "#ta_address" ).val( ui.item.peraddr );
                                   $( "#ta_gst" ).val( ui.item.gst );
				  return false;
				}
	});
			  
			  
  $(".checkeachitm").on('click', function() {
                             
				  var $box = $(this);
				  if ($box.is(":checked")) {
								$('.eachitem_counter').addClass('active_couter_list')  
				  }else
				  {
					  $('.eachitem_counter').removeClass('active_couter_list') 
				  }
				  var itemsact = $('.active_couter_list');	
					var actlenght=(itemsact.length);
					if(actlenght==1)
					{
						$('.edititems').removeClass('right_act_edit_dsbl');
					}else
					{
						$('.edititems').addClass('right_act_edit_dsbl');
					}
					if(actlenght>=1)
					{
						$('.delitems').removeClass('right_act_delete_dsbl');
					}
					else
					{
						$('.delitems').addClass('right_act_delete_dsbl');
					}
				});
                                
                                   
  });
	
        
  
        
        
        
  function barcode_entry(){
      
        if($("#search_barcode").val()!=''){
                 var barcode = $("#search_barcode").val();
         }else{
                 barcode = $("#search").val(); 
         }
         
        if(barcode!=''){
            
                 
               var br_code=barcode.split('#');
                 
               if(br_code[1]!='' && br_code[1]!=undefined ){
               
               var new_menu1=br_code[0].substr(0,4);
              
               var qty='1';
               
               var new_menu=  parseInt(new_menu1, 10);
               
               var weight_in=br_code[1].substr(0,5);
               
               var new_weight=(weight_in*1/1000);
              
               var dataString23 = 'set=check_barcode_plu&plu='+new_menu;
				
                            $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString23,
				success: function(data23) {
               var mn_plu=$.trim(data23);
            
               var dataString2 = 'set=check_barcode_cs&menuid='+mn_plu;
				
                            $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString2,
				success: function(data2) {
                                    
            var det=$.trim(data2).split('*');         
            var rate= parseFloat(det[6])*parseFloat(new_weight);  
                
            var dataString = 'value=menusubmission&menuid='+mn_plu+"&portion=&rate="+rate+"&qty="+qty+"&preferncetext=&mode=Add&order_from=CS&ratetype="+det[0]+"&unittype="+det[1]+"&unitweight="+det[3]+"&baseunitweight="+new_weight+"&unitid="+det[4]+"&baseunitid="+det[5]+"&serialno=&addon=";
         
				
                                $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString,
				success: function(data) {
                        
                                 location.reload();
                                 
                                 }
                                });
                 
         }
        });   
        
         }
        }); 
        
    }else{ 
       
			var dataString = 'value=searchnameonly_barcode&term='+barcode;
			$.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
                        var a= JSON.parse(data);  
                            
                        var id= a[0].id;   
                       
                        $("#valueofsearch_menu").val(id);      
                       
                        if(id!='')
                        {         
                        
                                var menunames = $("#valueofsearch_menu").val();
                                var barcode = $("#search_barcode").val();
								
				$('.counter_menu_popup_overlay').css("display","block"); 
				$('.counter_menu_popup').css("display","block"); 
									
				var request = $.ajax({
				url: "counter_popup.php",
				method: "POST",
				data: {menu:menunames,barcode:barcode,typesub:'Add' },
				dataType: "html"
				});
										 
				request.done(function( msg ) {
				$( ".counter_menu_popup" ).html( msg );
				$("#search_barcode").val('');
                                $('#search_barcode').blur();
                                $("#valueofsearch_menu").val('');
                                $("#search_barcode").focus();
				$(".focussed").focus();	
                                $(".enter-qty-act").val('1');
                                
                                $('.countersale_addnew').click();
                                
				});
										
				data = null;
				msg=null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
				return false;
                            }
                     }  });
             
             
            }
        }
   }
   
  
   
   function minus_single(mn,ord,qty,p,u,b,bw,sl){
       
         $(".minus_button_cs").css('pointer-events','none');
         
        if(qty >=2 ){    
                var dataString2 = 'set=single_click_cart_qty&mode=CS&menuid='+mn+"&type=minus&order_id="+ord+"&portion="+p+"&unit="+u+"&base="+b+"&baseweight="+bw+"&sl_no="+sl;
				
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                          $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("QTY CHANGED");
			  $('.ta_errormsg').delay(500).fadeOut('slow');
                          
                       $(".minus_button_cs").css('pointer-events','inherit');
                       
						var dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) {
								$('.listorderditems').html(data);
                                                               
                                                            }
                                                        });
        
         }
        });
        
        }else{
         
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('MINIMUM QTY IS ONE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                         $(".minus_button_cs").css('pointer-events','inherit');
        }
        
        
          var focus_on=$('#be_search_focus_cs').val();
                          if(focus_on=='search'){
                          $('#'+focus_on).focus();
                          }
                          else if(focus_on=='search_code'){
                          $('#codesrch_c').focus();
                          }else{
                          $('#search_barcode').focus();
                          }
        
        
      
  }   
     
   function plus_single(mn,ord,p,u,b,bw,sl){
       
       
        var dataString1 = 'set=check_plus_cart_stock&menuid='+mn+"&qty=1&weight=1&mode=cs&type=plus&mode_in=Edit";
	var request=  $.ajax({
	type: "POST",
	url: "load_index.php",
	data: dataString1,
	success: function(data) { 
            //counter_menu_popup alert(data);
            if($.trim(data)=='OK'){
       
           
                var dataString2 = 'set=single_click_cart_qty&mode=CS&menuid='+mn+"&type=plus&order_id="+ord+"&portion="+p+"&unit="+u+
                        "&base="+b+"&baseweight="+bw+"&sl_no="+sl;
				
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                          
                           $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("QTY CHANGED");
			  $('.ta_errormsg').delay(500).fadeOut('slow');

            
						var dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) { 
							$('.listorderditems').html(data);
                                                            }
                                                        });
        
        
         }
        });
        
                           var focus_on=$('#be_search_focus_cs').val();
                          if(focus_on=='search'){
                          $('#'+focus_on).focus();
                          }
                          else if(focus_on=='search_code'){
                          $('#codesrch_c').focus();
                          }else{
                          $('#search_barcode').focus();
                          }
                          
        }else{
                        $('.alert_error_popup_all_in_one').show();
                        
                        $('.alert_error_popup_all_in_one').text('NO STOCK IN INVENTORY');
                       
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
            
        }
                          
        }
        });              
                          
   
   } 
   
        
   function single_cart(mn,stk){
        
                           $('.pref_key_entry').val('');
                
                           var dataString2 = 'set=check_single_click_cart&mode=CS&menuid='+mn+"&stk="+stk;
				
                           $.ajax({
                           type: "POST",
                           url: "load_index.php",
                           data: dataString2,
			   success: function(data2) {
                                  
                           if($.trim(data2) !='no' && $.trim(data2) !='nostock') {
                               
                           var decimal=$('#decimal').val();      
                           var det=$.trim(data2).split('*');         
                           var rate= parseFloat(det[0]).toFixed(decimal);
                           var portion= det[1]; 
                               
                           $('.ta_errormsg').css("display",'block');
                           $('.ta_errormsg').text(" ITEM ADDED ");
                        
      var dataString = 'value=menusubmission&menuid='+mn+"&portion="+portion+"&rate="+rate+
      "&qty=1&preferncetext=&mode=Add&order_from=CS&ratetype=Portion&unittype=&unitweight=&baseunitweight=&unitid=&baseunitid=&serialno=&addon=";
      //alert(dataString);	
                            $.ajax({
				type: "POST",
				url: "load_counter_sales.php",
				data: dataString,
				success: function(data){
                                 
                                              var dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) { 
                                                    
                                                       $('.listorderditems').html(data);

                                                       $('.ta_errormsg').delay(1000).fadeOut('slow');    
                                                       $('.ta_errormsg').text("");
                                                       
                                               }
                                               });
                  
                  
                        }
                        });
         
         }else{
                        $('.alert_error_popup_all_in_one').show();
                        
                        if($.trim(data2)=='nostock'){
                            
                        $('.alert_error_popup_all_in_one').text('NO STOCK IN INVENTORY');
                        
                        }else{
                            
                           $('.alert_error_popup_all_in_one').text('PLS ADD RATE ');  
                        }
                        
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
         }
         
        }
        });
        
        $('#search').focus();
     
 }    
   
</script>

<script type="text/javascript"> 
    
$(document).ready(function(){
   
//     $('#codesrch_c').bind("keypress", function(e) {
//          if (e.keyCode == 13) {
//          
//			var menuname;
//			menuname=($('#codesrch_c').val());
//			var dataString;
//			dataString = 'value=menusearch_counter&menuname='+menuname;
//			$.ajax({
//			type: "POST",
//			url: "load_counter_sales.php",
//			data: dataString,
//			success: function(data) {
//			data=$.trim(data);
//			 if(data=="sorry")
//			{
//			   $('.ta_errormsg').css("display",'block');
//			   $('.ta_errormsg').text("Sorry, No menu..");
//			   $('.ta_errormsg').delay(2000).fadeOut('slow');
//			  
//			    }else
//			    {
//					$('.counter_menu_popup_overlay').css("display","block"); 
//		 			$('.counter_menu_popup').css("display","block"); 
//					 var request = $.ajax({
//						  url: "counter_popup.php",
//						  method: "POST",
//						  data: {menu:data,typesub:'Add' },
//						  dataType: "html"
//					});
//				   
//					request.done(function( msg ) {
//						$( ".counter_menu_popup" ).html( msg );
//						});
//						$('#codesrch_c').val('')
//						data = null;
//						msg=null;
//						request.onreadystatechange = null;
//						request.abort = null;
//						request = null;
//				}
//			}
//			});
//            return false; 
//        }
//});


});
</script>
<SCRIPT TYPE="text/javascript">
$(document).bind("contextmenu", function (e) {
        e.preventDefault();
      
    });
	
	
</SCRIPT>

    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 

</head>

<body style="overflow: hidden;" class="mouse_mover">
    
<?php include "includes/page_shortcuts.php"; ?>
    
     <input type="hidden" id="bill_settle_auth" value="<?=$_SESSION['s_cs_settle_auth']?>" >
     
    <input type="hidden" id="kot_after_settle" value="<?=$_SESSION['s_cs_kot_after_settle']?>" >
    <input type="hidden" id="kot_before_settle" value="<?=$_SESSION['s_cs_kot_before_settle']?>" >
    <input type="hidden" id="logid" value="<?=$_SESSION['expodine_id']?>" >
    <input type="hidden" id="coupon_code" >
    <input type="hidden" id="code_comp_credit" >
    <input type="hidden" id="loyalty_settle_on" value="<?= $_SESSION['loyalty_settle_on']?>" >
<input type="hidden" name="decimal" id="decimal" value="<?= $_SESSION['be_decimal'] ?>">
<input type="hidden"  id="pole_on" value="<?=$_SESSION['s_customer_display']?>">



<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
 
      <div class="middle_container">
     
      <div class="top_site_map_cc   <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){ ?> disablegenerate  <?php } ?>">
          
          
          <div class="quick_navigation_section" style="top: 0px;display:none">
              
               <?php if(in_array("dinein", $_SESSION['menuarray'])) { ?>
                        <div class="quick_navigation_nav_1">
                            <a href="table_selection.php">
                            <div class="quick_navigation_nav_ico"><img src="img/mn_dn.png"></div>
                            <div class="quick_navigation_nav_text">DI</div>
                             </a>
                        </div>
               <?php } ?>
              
              <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
                         <div class="quick_navigation_nav_1">
                             <a href="take_away_.php">
                            <div class="quick_navigation_nav_ico"><img src="img/mn_ta.png"></div>
                            <div class="quick_navigation_nav_text">TA</div>
                             </a>
                        </div>
               <?php } ?>
              
               <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
                        <div class="quick_navigation_nav_1 qc_nav_act">
                            <a href="counter_sales.php">
                            <div class="quick_navigation_nav_ico"><img src="img/mn_cs.png"></div>
                            <div class="quick_navigation_nav_text">CS</div>
                            </a>
                        </div>
               <?php } ?>
              
              
                    </div>
    
      <div class="counter_logo"><a href="index.php"><img src="img/logo20.png"></a></div>
            	<ul style="position:absolute;right:0;left:0;margin:auto;width:160px;">
					<!--<li><a href="index.php" ><span class="home_icon"></span>\</a></li>-->
					<!--<li><a href="#"><?=$_SESSION['home_headcounter']?></a></li>-->
				</ul>
                <div class="user_logout_cc" style="    margin-top: 0;">
                <?php include "includes/topbar_dropdown.php"; ?> 
               </div>
                
                 <strong class="top_al_search_name ta_errormsg" style="width:30%;color: darkorange;float:left;font-size: 18px;    margin-left: 10px;"></strong>
                
                 
    <div id="logout_pop" class="main_logout_popup_cc logout_main_popup_for_all">

    <div class="main_logout_popup">
    <div>
      <h1 class="logout_contant_txt"> LOGOUT FROM EXPODINE ?</h1>
       
       <div class="btn_logout_yes_no"><a onclick="return pop_logout_yes();" href="#" class="">YES</a></div>
       <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="return pop_logout_no();" style="color:#AB2426 !important"  href="#" class="">NO</a></div>
   </div>
   </div>
     </div>
                
   <script>
        function pop_logout_yes()
	{   
          localStorage.pin_relogin='';
	  var logid=$('#logid').val();       
          var datastring="setid=loginid&logid="+logid;
  
        $.ajax({
        type: "POST",
        url: "login.php",
        data: datastring,
        success: function(data)
        {  
          
        }
        });
	    window.location="logout.php";
         }   
           
        
        function confirmation()
	{   
            $('#logout_pop').show();
	}
        
          
        function pop_logout_no()
	{     
	   $('#logout_pop').hide();
        }
        
        
 </script>
     
        <?php
        $min_redeem=0;
        $sql_cat2  =  $database->mysqlQuery("select be_loyalty_settle,be_min_redeem_point from tbl_branchmaster "); 
					$num_cat2   = $database->mysqlNumRows($sql_cat2);
					if($num_cat2){
					while($result_cat2  = $database->mysqlFetchArray($sql_cat2)) 
						{
                                                  $loyalty_on_off=$result_cat2['be_loyalty_settle'];
                                                  $min_redeem =$result_cat2['be_min_redeem_point'];
                                                }
                                        }

         $point_rule=1;                        
         $amount_rule=1;                        
         $sql_desg_nos119="select lyr_point,lyr_amount from tbl_loyalty_redeem_rule";

				$sql_desg119  =  $database->mysqlQuery($sql_desg_nos119);
				$num_desg119  = $database->mysqlNumRows($sql_desg119);
			      
				if($num_desg119){
				while($result_desg119  = $database->mysqlFetchArray($sql_desg119)) 
					{
						$point_rule=$result_desg119['lyr_point'];					
						$amount_rule=$result_desg119['lyr_amount'];
                                              
					}
                                        
                                }
                                
                                $point_rule_add=1;
                                $amount_rule_add=1;
                                $sql_desg_nos1190="select lyp_point,lyp_amount from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }
                                
            $credit_view='';
            $comp_view='';
             $sql_paytypes1 = mysqli_query($localhost,"SELECT ser_credit_view,ser_comp_view FROM tbl_logindetails tl left join tbl_staffmaster ts on ts.ser_staffid=tl.ls_staffid  WHERE tl.ls_username='".$_SESSION['expodine_id']."' ");
                $num_paytypes1 = mysqli_num_rows($sql_paytypes1);
                if ($num_paytypes1) {
                    while ($result_paytypes1 =mysqli_fetch_array($sql_paytypes1)) {
                        
                        $credit_view=$result_paytypes1['ser_credit_view'];
                        $comp_view=$result_paytypes1['ser_comp_view'];
                        
                    }
                    }
                ?>  
 
            </div>
          
          
            <div class="ta_diableforedit"></div>
            
             <input type="hidden" value="<?=$_SESSION["archive_enabled"]?>" id="archieve_onoff" >
             <input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" >
             <input type="hidden" value="<?=$loyalty_on_off?>"  id="loyalty_status">
             <input type="hidden" id="point_rule_add" amt_add="<?=$amount_rule_add?>" value="<?=$point_rule_add?>" />
             <input type="hidden" id="point_rule" amt="<?=$amount_rule?>" value="<?=$point_rule?>" />                                
             <input type="hidden" id="min_redeem" value="<?=$min_redeem?>">              
             <input type="hidden" id="grand_org">
             <input type="hidden" value="<?=$credit_view?>" id="credit_view_per" > 
             <input type="hidden" value="<?=$comp_view?>" id="comp_view_per" > 
             <input type="hidden" value="<?= $_SESSION['s_default_company']?>" id="default_company" >
             
             <input type="hidden" name="hidprinter" id="hidprinter" value="<?=$_SESSION['s_printst']?>" >
             <input type="hidden" name="counter_discount_popup" id="counter_discount_popup" value="<?=$_SESSION['counter_discount_popup']?>" >
             <input type="hidden" name="counter_bill_before_settle" id="counter_bill_before_settle" value="<?=$_SESSION['counter_bill_before_settle']?>" >
             <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />
             <input type="hidden" name="valueofsearch_portion" id="valueofsearch_portion"  />
             <input type="hidden" name="valueofsearch_qty" id="valueofsearch_qty"  />
             <input type="hidden" name="staffwithdiscountcs" id="staffwithdiscountcs" value="<?=$_SESSION['s_discountpermission']?>">
             <input type="hidden" name="settlebill" id="settlebill" value="<?=$_SESSION['settlebillprint_cs']?>" />
             <input type="hidden" name="hidcancelsecret" id="hidcancelsecret" value="<?=$_SESSION['s_cancelwithsecret']?>">
      	     <div class="left_contant_container">
        	
        	<div class="take_left_main_list_cc">
            	<div class="top_head" id="top_head"><?=$_SESSION['maincategoryta']?></div>

                <div class="takeaway_head_search_span" style="position:relative;width:100%">
                            <?=$_SESSION['searchby_ta']?>
                    
                            <?php if( $_SESSION['be_combo_enable']=="Y"){ ?>
                            <div class="combo_button_mn_odr" id="combo_display_click"><img src="img/combo-ico.png">
                            <span><?=$_SESSION['combo_ico_com']?></span>
                            </div>
                             <?php } ?>
                    
                            <div class="combo_button_mn_odr" id="back_to_maincategory" style="display:none">
                            <span style="top: 6px;color:#fff;"><?=$_SESSION['maincategoryta']?></span>
                            </div>  
                    </div>

      <a class="ta_categorysel" onclick="load_best_sell_cat();">
      <div class="main_category_list" style="font-weight:bold;font-size: 15px;color: #4fa0a9;border: solid 2px white;border-radius: 7px;margin-top: 6px;">
      #BEST SELLING ITEMS
      </div>
      </a>
                
                <div class="take_left_main_list">
                <?php
                                   $sql_cat = $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid,my.mmy_maincategoryname,my.mmy_maincategoryid,my.mmy_displayorder   from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where my.mmy_active='Y'  order by my.mmy_displayorder");
                                       
                                        $num_cat = $database->mysqlNumRows($sql_cat);
                                             if ($num_cat) {
                                                  $j =0;
                                                 
                                                 $catid_for_subcat=array();
                                                 while ($result_cat = $database->mysqlFetchArray($sql_cat)) {
                                                     
                                                 $sql_cat_r = $database->mysqlQuery("select mrc.mrc_rate  FROM tbl_menurate_counter mrc LEFT JOIN tbl_menumaster as ms ON mrc.`mrc_menuid`=ms.mr_menuid WHERE ms.mr_maincatid='".$result_cat['catid']."' AND (mrc.mrc_rate<>'0' OR mrc.mrc_rate IS NOT NULL)");
                                                
                                                 $num_cat_r = $database->mysqlNumRows($sql_cat_r);
                                                 if ($num_cat_r) {
                                                     $catname=$result_cat['mmy_maincategoryname'];
                                                     $maincategoryid = $result_cat['catid'];

                                                 if($_SESSION['main_language']!='english'){
                                                     $sql_arabcat=$database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_main left join tbl_languages on ls_id=mm_lang_id WHERE mm_categoryid='".$result_cat['mmy_maincategoryid']."' and ls_language='".$_SESSION['main_language']."'");

                                                     
                                                     $num_arabcat = $database->mysqlNumRows($sql_arabcat);
                                                     $result_arabcat = $database->mysqlFetchArray($sql_arabcat);
                                                     $catname=$result_arabcat['mm_name'];
                                                     
                                                 }
                                                  
                                            $catid_for_subcat[]=$maincategoryid;
                                            $j++;
                                            if($j==1){ $_SESSION['sel_cat_id']=$maincategoryid; }
                                            $menucat=$database->show_category_ful_details($maincategoryid);
                                            if($catname!="")
                                            {	
					?>
                    <a catid="catid_<?=$maincategoryid?>" class="ta_categorysel">
                        <div class="main_category_list <?php if($j==1){ ?> main_category_list_act<?php } ?>"><?=$catname?></div>
                    </a>
                    <?php } }} } ?> 
                    
                    <input type="hidden" name="ta_catname"  id="ta_catname" value="<?=$_SESSION['sel_cat_id']?>" >
                   
            </div><!--take_left_main_list--> 
            </div><!--take_left_main_list_cc-->
            
           <div class="tkw_sub_items_cc" >
                    <div class="top_head">
                	
                    <div class="top_al_search_cc take_search" style="width:20%;display:none">
                    <span style="width: 40%;float: left;font-size: 16px;text-align:cent"><?=$_SESSION['code_ta']?></span>
                    <span style="width: 60%;float: left;"><input autocomplete="off" style="width: 100%;padding-right:0" class="search" placeholder="Code " type="text" id="codesrch_c" name="codesrch_c" ></span><!--onKeyPress="validateSearch_code('C')" onKeyDown="validateSearch_code('C')" onKeyUp="validateSearch_code('C')" onChange="validateSearch_code('C')" onBlur="validateSearch_code('C')"-->
                </div>
                  
                   
                <div class="top_al_search_cc " style="width:25%;display:block">
                    <span  style="width: 25%;float: left;text-align: left;font-size: 16px;text-align:center;display: none"><img style="margin-top: -4px" src="img/barcode.png"></span>
                    <span style="width:75%;"><input autocomplete="off" class="search" placeholder="Barcode " name="search_barcode"  id="search_barcode"  onchange="barcode_entry();" type="text" style="float: left;width: 100%;margin-right: 0;padding-right:0;display:none" ></span><!--onKeyPress="validateSearch('N')" onKeyDown="validateSearch('N')" onKeyUp="validateSearch('N')" onChange="validateSearch('N')" onBlur="validateSearch('N')" -->
                </div>
                <div class="top_al_search_cc take_search" style="width:74%;padding-left:5px">
                    
                    <span style="float: left;width:99%;"><input autofocus autocomplete="off" class="search" onchange="barcode_entry();"  placeholder="NAME - CODE - BARCODE" name="search" id="search" type="text" style="float: left;width: 100%;margin-right: 0;padding-right:0" ></span><!--onKeyPress="validateSearch('N')" onKeyDown="validateSearch('N')" onKeyUp="validateSearch('N')" onChange="validateSearch('N')" onBlur="validateSearch('N')" -->
                    </div>
                </div><!--top_head-->
                
                 <input type="hidden" name="bchid" id="bchid" value="<?=$_SESSION['branchofid']?>">
                 
                      <input type="hidden" name="ordrid" id="ordrid" value="<?=$_SESSION['cs_order_id']?>">  
                      
                      <div class="counter_sub_cate_cc" id="ta_loadsubcat">
                          
                       <?php
					$_SESSION['sel_sub_id']=NULL;
                                      
                                        $sql_subcat = $database->mysqlQuery("select distinct(mr.mr_subcatid) as subid,msy_subcategoryid,msy_subcategoryname from tbl_menumaster as mr LEFT JOIN tbl_menusubcategory as ms ON mr.mr_subcatid=ms.msy_subcategoryid where (ms.msy_active='Y' or mr_subcatid is NULL ) and mr.mr_maincatid='" . $catid_for_subcat[0] . "' order by ms.msy_sub_displayorder");
                                        
                                        $num_subcat = $database->mysqlNumRows($sql_subcat);
                                        if($num_subcat){
                                            $j = 0;
                                            $k=0;
                                            $k++;
                                ?>
                                 			 
                              <div values="all" class="subcategory_items ta_subcatchange <?php if($k==1){ ?>  subctselected <?php } ?>"><?=$_SESSION['all_ta']?></div>
                              
                              <?php
//					for($s=0;$s<$countersale_sub_count;$s++) { $k++;
//                                            if($resu_countersale_subcat['subcatid'][$s]!=""){
//                                                $menusub=$database->show_subcategory_ful_details($resu_countersale_subcat['subcatid'][$s]);
//                                                if ($resu_countersale_subcat['subcat'][$s] != "") {
                                                                  
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
                              <?php } ?> 

                             </div>
               <div class="menu_item_contain_new" id="ta_loadmenuitems">
               <?php
				   $curdate=date("Y-m-d");
				          
                                   $sql_menulist = ("select mr_stock_inventory,mr_description,mr_menuname,mr_menuid,mr_unit_type,mk_stock from tbl_menumaster as mr "
                                           . " LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid left join "
                                           . " tbl_menusubcategory as sb on sb.msy_subcategoryid=mr.mr_subcatid left join "
                                           . " tbl_menurate_counter mrc on mrc.mrc_menuid=mr.mr_menuid  LEFT JOIN tbl_menustock ON "
                                           . " tbl_menustock.mk_menuid=mr.mr_menuid WHERE mr.mr_stock_in_out='Y' and mc.mmy_active='Y' and mr.mr_active='Y' "
                                           . " and ( (sb.msy_active='Y' && mr.mr_subcatid!='') ||  (mr.mr_subcatid is null) ) and "
                                           . " mr.mr_maincatid='" . $catid_for_subcat[0] . "'  and tbl_menustock.mk_date='" . $_SESSION['date'] . "'"
                                           . " and (mrc_rate >0 and mrc_rate IS NOT NULL) GROUP BY mr.mr_menuid  order by mr_menuname ASC ");
                                     
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                           $menu_name = $result_menus['mr_menuname'];
                                           
                                           $stock_in_no=$result_menus['mr_stock_inventory'];
                                           
                                           $menu_desc=$result_menus['mr_description'];
                                           
                                           $menu_id = $result_menus['mr_menuid'];
                                            
                                            $menu_type_click= $result_menus['mr_unit_type'];
                                            
                                            $menu_stock = $result_menus['mk_stock'];
                                          
                                            if($_SESSION['main_language']!='english'){

                                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

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
                                          $sql_menuportion = "select mrc_menuid from tbl_menurate_counter where mrc_menuid='".$result_menus['mr_menuid']."' and (mrc_rate<>'0' OR mrc_rate IS NOT NULL)";
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
                                            
                                       if($_SESSION['s_listimage'] == "Y") { 
                                           
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
                ?>
                   
                   
               <a title="<?=$menu_desc?>"  typ_pop="<?=$menu_type_click?>" style="position: relative; " <?php  if($dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y'  && $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$stock_in_no?>')" <?php } ?> menuid="<?=$menu_id?>" class="ta_menuitem <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate=='yes' ){ ?> counter_popup_button <?php }  ?>  <?php if ($portion == "N") { ?> noportionalert_cs <?php } ?>">
                  
               <div <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="width:185px;height:160px;padding:0;overflow:hidden;" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> menu_sub_item <?php }else{ ?> menu_sub_item1 menu_1 <?php if ($portnstock=="N") { ?> tka_btn_disable <?php } ?> clear_color_<?=$menu_id?>   <?php } ?>">

               <?php if($_SESSION['s_listimage'] == "Y"){  //image show permission  ?>
                   
               <div class="product_img" style="border-radius: 0px;height:110px;width:100%"><img src="<?= $image ?>"  /></div>
               
               <?php } ?>



            <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?>
               
             <p style="height: 28px;margin-bottom: 0px;overflow: hidden;margin-top: -7px;line-height: 1.2;width:100%; <?php if($_SESSION['s_listimage'] == "N"){ ?> overflow: hidden;margin-top: -4px; <?php } ?> "> <?=$menu_name?> </p> 
             
             <?php } else{ ?>  <?=$menu_name?>  <?php } ?>
             
             <span class="item_round"></span> 
			
                
                    <?php  $rtr=''; $rater=''; 
                    
                           $sql_menuportion127 = "SELECT u_name ,bu_name, pm_portionshortcode ,mrc_rate from tbl_menurate_counter mc "
                           . " left join tbl_portionmaster pm on pm.pm_id=mc.mrc_portion left join tbl_base_unit_master tbu "
                           . " on tbu.bu_id=mc.mrc_base_unit_id left join tbl_unit_master tu on tu.u_id=mc.mrc_unit_id "
                           . " where mc.mrc_menuid='$menu_id' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) { 
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                   
                    $rtr.= $result_imgs['u_name'].' '. $result_imgs['bu_name'].$result_imgs['pm_portionshortcode'].' : '.$result_imgs['mrc_rate'].'|'; 
                                                
                                           
                           
                    } } 
                           
                           
            $rater= explode('|', $rtr) ;
                          
            ?>  
                           
                               
            <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
            <span class="item_price"  style="<?php if($_SESSION['s_listimage']=="Y"){ ?> position:absolute;top:100px;padding:5px 0;background-color:#000000b8;left:0;color:#fff<?php }else{ ?> margin-top:-15px;  <?php } ?>" > <?=$rater[0].$rater[1]?> <?=$rater[2].$rater[3]?></span>
           
            
            <?php } ?>
                      
                      
                   </div>   
                   </a>
                   
                   
                     <?php  }} else
					 {
			echo "<span style='color: #F00E0E;margin-left: 43%;'> Nothing to display </span>";
		 } ?> 
                     
               </div> 
               
               <div class="gst-enter-sec" style="display:none">
               		<div class="col-md-3" style="width:30%;padding-right:0;">
                            <input style="" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="cs_name"  placeholder="Customer Name">
                    </div>
                    <div class="col-md-3" style="width:30%;padding-right:0;">
                        <input style="" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="cs_phone" onkeypress="return numonly();" placeholder="Number">
                    </div>
                    <div class="col-md-3" style="width:30%;padding-right:0;">
                        <input style="" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="cs_gst"  placeholder="GST Number">
                    </div>
               </div><!--gst-enter-sec-->
               
               
           </div><!--tkw_sub_items_cc-->
           
           <div style="width:100%;display:none" class="bottom_view_quicklist" >
        	<!--<div class="botom_orderlist_head">
           </div>-->
            
            <div style="text-align: left;"  class="order_list_cont">
            
            	 <div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><span style="line-height:60px" class="time_sp" id="time"></span></div>
                    <div class="counter_bottm_quic_btn_text">&nbsp;</div>
                </div>
                
                 <a  href="index.php"><div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/botom_home-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['home_cs']?></div>
                </div></a>
                

            
            	<a id="calulator" href="#"><div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/calc-ico.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['calc_cs']?></div>
                </div></a>
                 	
                <a class="" href="stock_master.php"><div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/settle-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['stock_ta']?></div>
                </div></a>

          
                <a href="cs_bill_history.php"> <div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/history-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['billhistory_ta']?></div>
                </div></a>
              
                 <a class="counter_sl_payment_hist" href="#">
                 <div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/payment-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['paymnt_cs']?>455</div>
                </div></a>

          
               
            </div>
        </div>
            
        </div>
        
        <div class="right_order_inform right_calc_cc">
              
            <div class="right_main_cc">
            
                <div class="top_head <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){ ?> disablegenerate  <?php } ?>">

                    
                	<div class="right_top_action_btn">
                           
                             <?php 
                   
                   $sql_menulist= "SELECT ly_default FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_module='CS' limit 1 ";
						 $sql_menus  =  $database->mysqlQuery($sql_menulist); 
						$num_menus  = $database->mysqlNumRows($sql_menus);
						if(!$num_menus){
                                                    
                                                ?>
                        <div id="customer_set_data3" class="counter_list_action_btn" style="line-height: 34px;">
                        <a  href="#" onclick="return show_loy_pop();" style=""> <img style="" src="img/user-loyalty-icon.png"> </a>
                        </div>
                            
                            <?php } else { ?>
                            
                            
                            <div id="customer_set_data4" class="counter_list_action_btn" style="line-height: 34px;">
                            <a  href="#" onclick="return clear_loy_pop();" style=""> <img style="" src="img/close-icon.png"> </a>
                            </div>
                            
                            <?php } ?>
                            
                            <div id="customer_set_data5" class="counter_list_action_btn" style="line-height: 34px;display: none">
                            <a  href="#" onclick="return show_loy_pop();" style=""> <img style="" src="img/user-loyalty-icon.png"> </a>
                            </div>
                            
                            
                    </div>
                    
                 <!-- <?=$_SESSION['orddetail_ta']?> -->

                    <span class="customer_dtl_sec">
         <?php 
         $sql_menulist= "SELECT ly_id,ly_firstname,ly_mobileno,ly_emailid,ly_gst FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_module='CS' order by ly_id desc limit 1 ";
		$sql_menus  =  $database->mysqlQuery($sql_menulist); 
		$num_menus  = $database->mysqlNumRows($sql_menus);
		if($num_menus){
		while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
						
                     ?>
                     <div id="customer_set_data1">
                     <div style="cursor: pointer" onclick="edit_loy_data('<?=$result_menus['ly_id']?>','<?=$result_menus['ly_firstname']?>','<?=$result_menus['ly_mobileno']?>','<?=$result_menus['ly_gst']?>','<?=$result_menus['ly_emailid']?>');">
                     <strong id="name_loaded"><?=$result_menus['ly_firstname']?></strong>
                         <span id="num_loaded"><?=$result_menus['ly_mobileno']?></span>
                     </div>
                     </div>
                        
                <?php } }else{  ?>
                        
                    <strong>CUSTOMER NAME</strong>
                    <span>NUMBER</span>
                     
                <?php }   ?>
                    
                    
                    <div id="customer_set_data2" style="display:none">
                    <strong>CUSTOMER NAME</strong>
                    <span>NUMBER</span>
                    </div> 
                    
                    
                </span>

               <input type="hidden" name="hibilhold"  class="hibilhold">
                <div class="right_top_action_btn" style="right:0;    width:50px;">
                        
                        
                    
                            <?php if($_SESSION['counter_enable_hold']=='Y' && $_SESSION['s_enable_hold']=='Y') { ?>
                            <a href="#" id="notificationLink" style="display:block"><div class="counter_list_action_btn">
                            	<img style="vertical-align:sub" height="40px" src="img/hold_ico.png"></div>
                                <div class="hold_notify_ico load_hold_new_count">*</div>
                            </a>
                            <?php } ?>
                    
                    
                            <div id="notificationContainer">
                            <div id="notificationTitle">Hold List
                            	<div style="margin-top:5px;" class="counter_list_action_btn"><input class="count_check_all holdlistcheck"  type="checkbox" value=""></div>
                                <div style="float:right;margin-top:-3px;display:block;margin-right: 51px" class="counter_list_action_btn">
                                	<a href="#" class="deleteallselecthold"><img src="img/delete-icon2.png"></a>
                                </div>
                            </div>
                            <div style=" width: 100%;" id="notificationsBody" class="notifications">
                            	<div class="hold_data_table">
                            	<table width="100%" border="0">
                                <thead>
                                  <tr>
                                    <th width="20%">Hold No</th>
                                    <th >Time</th>
                                    <th  width="30%">Amount</th>
                                   
                                    <th  width="10%">&nbsp;</th>
                                  </tr>
                                  </thead>
                                  <tbody id="load_hold_new">
                                  
                                    
                                  </tbody>
                                </table>
                                </div>
                            </div>
                            </div>
                        
                    </div>
                </div>
              	<div class="right_main_contant_cc" style="position:relative">
                
                	<div class="counter_main_orderd_detail_cc">
                    	<div class="counter_main_orderd_detail_head">
                        	<table width="100%" border="0">
                             <thead>
                              <tr>
                                <!-- <th width="12%"><?=$_SESSION['slno_ta']?></th> -->
                                <th style="text-align:left;padding-left: 1%;" width="40%"><?=$_SESSION['menuitem_ta']?></th>
                                <th style="text-align:center" width="20%"><?=$_SESSION['qty_ta']?></th>
                                <th  width="20%"><?=$_SESSION['amount_ta']?></th>
                                 <th  width="10%">&nbsp</th>
                              </tr>
                              </thead>
                            </table>
                        </div>
                            
                            
         <div class="counter_main_orderd_detail_contant listorderditems">
                            
           <!------------COMBO MENUS CART DISPLAY STARTS--------->  
       <?php         
        if( $_SESSION['be_combo_enable']=="Y"){
            
                            $total=0;
                            $slno=0;
                            $sql_combo_name_list =  $database->mysqlQuery("select cbd.cbd_regen_status,tkb.tab_regen_status,cbd.cbd_count_combo_ordering,
                                cbd.cbd_combo_pack_id,cbd.cbd_order_status,cbd.cbd_combo_total_rate,cbd.cbd_combo_qty,cbd.cbd_combo_preference , 
                                cn.cn_name,cn.cn_stock_check,cp.cp_pack_name FROM tbl_combo_bill_details_ta cbd
                                left join tbl_takeaway_billmaster tkb on tkb.tab_billno = cbd.cbd_billno                        
                                left join tbl_combo_name cn on cn.cn_id = cbd.cbd_combo_id
                                left join tbl_combo_packs cp on cp.cp_id = cbd.cbd_combo_pack_id
                                where tkb.tab_dayclosedate='".$_SESSION['date']."' and cbd.cbd_billno='".$_SESSION['cs_order_id']."'"
                                . "group by cbd_count_combo_ordering  order by cbd.cbd_entry_date asc limit 250");
                            $num_combo_name_list = $database->mysqlNumRows($sql_combo_name_list);
                            if($num_combo_name_list!=NULL){$p=0; 
                                while ($result_combo_name_list = $database->mysqlFetchArray($sql_combo_name_list)) {
                                    if($result_combo_name_list['cbd_combo_qty']>=0){
                                    $p++;
                                    $combo_preference=array();
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
                           <div class="preference_table combo_added_sec  <?php if($reg_item_cb !='N'){ ?> disablegenerate <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "Generated" || $result_combo_name_list['cod_order_status'] == "Billed" || $result_combo_name_list['cbd_order_status'] == "Closed") { ?> odr_served <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "Opened") { ?> odr_confirmed <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "NotInStock") { ?> odr_notinstock <?php } ?>" id="<?=$p?>" style="cursor:pointer">
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
                                        $sql_combo_cart_list =  $database->mysqlQuery("select cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, 
                                        cbd.cbd_slno,cbd.cbd_combo_qty, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, sum(cbd.cbd_menu_qty) as cbd_menu_qty, 
                                        cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status,cn.cn_name,cp.cp_pack_name,  
                                        mm.mr_menuname,mm.mr_menuid,cpm.cpm_menu_sale_type
                                        FROM tbl_combo_bill_details_ta cbd
                                        left join tbl_combo_name cn on cn.cn_id = cbd.cbd_combo_id
                                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                        left join tbl_combo_pack_menus cpm on cpm.cpm_menu_id=cbd.cbd_menu_id and cpm.cpm_combo_pack_id=cbd.cbd_combo_pack_id
                                        left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                        where cbd.cbd_dayclosedate='".$_SESSION['date']."' and cbd.cbd_billno='".$_SESSION['cs_order_id']."' and 
                                        cbd.cbd_count_combo_ordering='".$result_combo_name_list['cbd_count_combo_ordering']."' group by cbd.cbd_menu_id,"
                                        . "cbd.cbd_order_status limit 250" ); 

                                        
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
                              
  <!--------COMBO MENUS  DISPALY ENDS--------->   
         
   <!-------- NORMAL MENUS CART DISPALY START--------->    
   
   <table width="100%" border="0">
                             
    <?php 
    
      $localIP = getHostByName(getHostName());
      
                                $total2=0;    
                                $tot_incl_sub=0;
                                $order_unit_weight='';
                                $order_packet_or_loose='';
                                $unit_weight_name='';
                                 
				$sql_menulist= "Select tbl_menumaster.mr_stock_inventory,tbl_takeaway_billdetails.tab_disc_before,
                                tbl_takeaway_billdetails.tab_rate_before_comp,tbm.tab_regen_status, tbl_takeaway_billdetails.tab_regen_status_menu,
                                tbl_menumaster.mr_menuid,tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionshortcode as portioncode,
                                tbl_portionmaster.pm_id as porname,tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,
                                tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,
                                tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate, 
                                tbl_takeaway_billdetails.tab_new_rate_incl,tbl_takeaway_billdetails.tab_unit_id,tbl_takeaway_billdetails.tab_base_unit_id,
                                tbl_takeaway_billdetails.tab_rate_type,tbl_takeaway_billdetails.tab_unit_weight,tbl_takeaway_billdetails.tab_unit_type,
                                u.u_id,u.u_name,bu.bu_id,bu.bu_name
                                From  tbl_takeaway_billmaster tbm
                                left Join tbl_takeaway_billdetails On tbm.tab_billno = tbl_takeaway_billdetails.tab_billno
                                left Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid 
                                left Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id 
                                left join tbl_unit_master u on u.u_id=tbl_takeaway_billdetails.tab_unit_id
                                left join tbl_base_unit_master bu on bu.bu_id=tbl_takeaway_billdetails.tab_base_unit_id
                                Where tbl_takeaway_billdetails.tab_dayclose_in='".$_SESSION['date']."' and tbm.tab_dayclosedate='".$_SESSION['date']."' and  tbl_takeaway_billdetails.tab_billno = '".$_SESSION['cs_order_id']."'  AND tbm.tab_mode ='CS' and tab_count_combo_ordering IS NULL AND tbl_takeaway_billdetails.tab_bill_addon_slno  IS  NULL
                                order by tbl_takeaway_billdetails.tab_entrytime desc limit 250";
                                
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$_SESSION['submitbutst']="1";$i=1;
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

                                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$ordermenu_idcs."' and ls_language='".$_SESSION['main_language']."'");

                                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                            $ordermenu_cs=$result_arabmenu['lm_menu_name'];
                                        
                                            }
    
                                            
                                            $total+=$result_menus['tab_amount'];
                                            $discount_name=array();
                                            $discountname = $database->mysqlQuery("SELECT tbd_discount_remarks FROM tbl_takeaway_item_discount where tbd_billno='".$_SESSION['cs_order_id']."' and tbd_slno='".$result_menus['slno']."'");
                                            
                                            $num_discountname = $database->mysqlNumRows($discountname);
                                           
                                            if ($num_discountname) {
                                                while ($rs_discountname = $database->mysqlFetchArray($discountname)) {
                                                    $discount_name[] = $rs_discountname['tbd_discount_remarks'];
                                                }
                                            } else {
                                                $discount_name[] = "";
                                            }
                                            
                                              
                                                
                                         
                                          $tax_in1 = $database->mysqlQuery("SELECT amc_value,amc_unit FROM tbl_extra_tax_master te left join tbl_menu_tax_master tem on tem.mtm_tax_id=te.amc_id where te.amc_active='Y' and te.amc_enable_cs='Y' and te.amc_item_tax='Y' and tem.mtm_menuid='".$result_menus['menuid']."'  ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                             while ($tx_in1 = $database->mysqlFetchArray($tax_in1)) {
                                                    
                                                    $tax_value1=$tx_in1['amc_value'];
                                                    $tax_unit1=$tx_in1['amc_unit'];
                                                      
                                                    if($tax_unit1=="P"){
                                                       
                                                        $total2=  $total2+($result_menus['tab_amount']*$tax_value1/100);
                                                            
                                                    }else if($tax_unit1=="V"){
                                                      
                                                        $total2=  $total2+$tax_value1;
                                                       
                                                    }
                                                    
                                                    
                                        }
                                    }
                                  
				?>
                            <input type="hidden" id="checkid" >
                            
                            <tr class="<?php if($reg_item !='N'){ ?> disablegenerate <?php } ?>" >
                                
                                
                                <!-- <td width="12%"><?=$slno?>)</td> -->
                                
                                
                         <?php if($_SESSION['ser_com_item']=='Y' || $_SESSION['ser_item_discount_manual']=='Y'){ ?> 
                                
                                <td style="padding-left: 1px "  width="12%" >
                                    
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
                                 
                                 
                                 
                                <td class="eachitem_counter" menuid="<?=$result_menus['menuid']?>"sln="<?=$result_menus['slno']?>" actqty="<?=$result_menus['qty']?>" portionname="<?=$result_menus['porname']?>" pref="<?=$result_menus['tab_preferencetext']?> " rate="<?=$result_menus['tab_rate']?>" style="text-align:left;padding-left: 3%; <?php if($result_menus['tab_rate_before_comp']>0){ ?> pointer-events:none <?php } ?> " width="40%"><?=$ordermenu_cs?><?php if($result_menus['portioncode']!='') { echo $portion_shortcode ;}?>
                                <?php  if($unit_weight_name!=''){ ?>
                                    <span class="counter_right_unit" colspan="4"><?= $unit_weight_name?> </p></span>
                                <?php } ?>
                                </td>
                                <!-- <td  width="20%"><?=$result_menus['qty']?></th> -->
                                <td width="20%">
                                       <span class="qty_incr_btn_sec_cc">
                                        
                                       <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>                                                             
                                       <span  onclick="minus_single('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['qty']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>');"  class="qty_incr_btn minus_button_cs">-</span>
                                       <?php } ?>
                                        
                                       <input class="qty_incr_val" readonly type="text" value="<?=$result_menus['qty']?>">
                                       
                                       <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>
                                       <span  onclick="plus_single('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>');"  class="qty_incr_btn">+</span>
                                       <?php } ?>
                                        
                                       </span>
                                </td>
                                
                                 <?php  if($_SESSION['incl_bill_format']=='N'){  ?>
                                 <td  width="20%"><?=number_format($result_menus['tab_amount'],$_SESSION['be_decimal'])?></td>
                                 <?php }else{ ?>   
                                 <td  width="20%"><?=number_format($result_menus['tab_new_rate_incl']*$result_menus['qty'],$_SESSION['be_decimal'])?></td>
                                 <?php } ?>   
                                
                                 <td width="10%"><span style="padding: 6px 0;border-radius:3px" class="hold_list_add" id="cs_delete_item" onclick="return delete_cs_item('<?=$result_menus['menuid']?>','<?=$result_menus['slno']?>');"><img src="img/close-icon.png"></span></td>
                               
                             <?php
                                  
                                   $tax_in1 = $database->mysqlQuery("SELECT tmp_pref_name,tmp_qty FROM tbl_menu_preference_kot where "
                                           . "tmp_menu='".$result_menus['menuid']."' and tmp_orderno_bill= '".$_SESSION['cs_order_id']."' ");
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
                              <tr><td style='text-align:left;font-weight:bold !important ;color:#fd5659; height:auto;padding-left:6px;padding-bottom:7px; text-transform: uppercase;' colspan='5'><?php for($s=0;$s<count($discount_name);$s++) {if($s>0){ echo ',';} echo $discount_name[$s]; }?></td></tr> 
                              <?php }?>    
                              <tr style="background-color: transparent; border-bottom: 1px rgba(0, 0, 0, 0.15) solid;margin-bottom: 3px">
                             
                                  <td class="pref-td-take-away" colspan="5">
                                  <?php if(strlen(trim($result_menus['tab_preferencetext']))>1){  ?>
                                          
                                  <span class="counter_right_pref" style="margin-bottom: 3px;" colspan="4"><p style="font-size: 15px">PREF : <?=str_replace(',,',',',$result_menus['tab_preferencetext'])?></p></span>
                                    
                                  <?php } ?>
                                  </td>
                                  
                                  <?php
                                    
                                  $sql_addon_menus  =  $database->mysqlQuery("select  tbd.tab_slno, tbd.tab_qty, tbd.tab_amount,mm.mr_itemshortcode
                                   FROM tbl_takeaway_billdetails tbd
                                   left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid
                                   WHERE tbd.tab_bill_addon_slno  IS NOT NULL and tbd.tab_billno='".$_SESSION['cs_order_id']."' and"
                                   . " tbd.tab_bill_addon_slno='".$result_menus['slno']."' order by tbd.tab_slno asc limit 250"); 
                                   $num_addon_menus  = $database->mysqlNumRows($sql_addon_menus);
                                   if($num_addon_menus){$addon_sl=0;
                                        
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
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                   
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
    
     $new_tot = $database->mysqlQuery("SELECT sum(tab_amount) as minus_tot FROM tbl_takeaway_billdetails  left Join tbl_takeaway_billmaster  On tbl_takeaway_billmaster.tab_billno = tbl_takeaway_billdetails.tab_billno
     WHERE tab_dayclosedate='".$_SESSION['date']."' and tbl_takeaway_billmaster.tab_billno = '".$_SESSION['cs_order_id']."'  AND tab_menuid IN(SELECT mr_menuid  FROM  tbl_menumaster WHERE mr_excempt_tax ='Y') limit 250");
                                          $num_1 = $database->mysqlNumRows($new_tot);
                                           if ($num_1) {
                                            while ($new_tot_amt = $database->mysqlFetchArray($new_tot)) {
                                                    
                                                $minus_tot=$new_tot_amt['minus_tot'];
                                             }
                                           }          
                
                 $new_tot_all=($total-$minus_tot);
                 
                                            $total1=0;
                                            $tax_in = $database->mysqlQuery("SELECT * FROM tbl_extra_tax_master where amc_active='Y' and amc_enable_cs='Y' and amc_item_tax!='Y' ");
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
                                                    
                                                    
                                                 }
                                                }
                                               
                                            $tax_in1_rf = $database->mysqlQuery("SELECT bsc_nearest_roundoff FROM tbl_branch_settings_counter ");
                                            $num_tx1_rf = $database->mysqlNumRows($tax_in1_rf);
                                            if ($num_tx1_rf) {
                                                while ($tx_in1_rf = $database->mysqlFetchArray($tax_in1_rf)) {
                                                    
                                                      $rof_ta=$tx_in1_rf['bsc_nearest_roundoff'];
                                                }
                                                }
                                                
                                               
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
                      </div>
                            
                       
                    <input type="hidden" value="<?=$total?>" id="tot_org" >
                            
                    <input type="hidden" name="counter_gen" id="counter_gen"  value="<?=$_SESSION['counter_enable_gen']?>">
                    <input type="hidden" name="counter_staff_gen" id="counter_staff_gen"  value="<?=$_SESSION['s_enable_gen']?>">
                    
                    <input type="hidden" name="counter_hold" id="counter_hold"  value="<?=$_SESSION['counter_enable_hold']?>">
                    <input type="hidden" name="counter_staff_hold" id="counter_staff_hold"  value="<?=$_SESSION['s_enable_hold']?>">
                    </div><!--counter_main_orderd_detail_cc-->
                    
                    <div class="bdm_right" >
                    <div class="counter_right_total">
                    	<div class="tottal_rate_contain" style="color:#fff;font-size: 12px;text-align:right">
                              <span style="  margin-left: 2%;float: left;"><?=$_SESSION['items_com']?> : </span><span style=" margin-left: 2%;float: left;" class="total_itemcount2">0</span>
                        	<?=$_SESSION['subtotal_com']?> : <span class="tal_viewtotal" style="margin-right: 15%; font-size: 16px;">0</span><span></span></div>
                        
                                <?php  if($_SESSION['incl_bill_format']=='N'){  ?>
                                
                         <div class="tottal_rate_contain" style="color:#fff;font-size: 12px;text-align:right">
                              <span style="  margin-left: 2%;float: left;"><?=$_SESSION['tax_com']?> : </span><span style="margin-left: 2%;float: left;" class="tax_show">0</span>
                               <?=$_SESSION['payable_com']?> : <span class="final_show" style="margin-right: 15%; font-size: 16px;">0</span><span></span></div>
                        <?php } ?>
                               
                               
                         <div class="counter_right_payment_button_cc">
                         	
                            <?php if($total!=0){ ?>
                         
                        <!-- <?=$_SESSION['genset']?> -->
                            <?php }else{ ?>
                            <?php if($_SESSION['counter_enable_hold']=='Z' && $_SESSION['s_enable_hold']=='Z') { ?>
                             <a href="#"><div class="counter_right_payment_button holdorders"  style="display:none;">Hold5</div></a>
                             <?php } ?>
                             
                            <?php } ?>
                            
                            
                             <a href="#"><div style="width:20%" class="counter_right_payment_button  settle_direct" setpay="Y"  >Settle</div></a>
                            
                            <a href="#"><div style="width:20%" class="counter_right_payment_button countergenerate gensettl" setpay="Y" style="display:block">Discount</div></a>
                            
                            <?php if($_SESSION['counter_enable_hold']=='Y' && $_SESSION['s_enable_hold']=='Y') { ?>
                             <a href="#"><div class="counter_right_payment_button holdorders <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){ ?> disablegenerate  <?php } ?>"  style="display:block;background-color: rgb(208, 115, 19);    width: 13%;"><?=$_SESSION['hold_ta1']?></div></a>
                             <?php } ?>
                             
                            <a href="#"><div style="border:0;width: 13%;line-height: 40px;height: 40px;" class="counter_right_payment_button  clear_all_cs nw_clr_btn <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){ ?> disablegenerate  <?php } ?>" >Clear</div></a>
                          
                            
                            <?php if($_SESSION['s_print_option']=='Y' ){ ?>
                           
                           <a href="#"><div class="counter_right_payment_button no_print_in" onclick="no_print_in('<?=$_SESSION['cs_order_id']?>')"; style=" background-color: #AB2426; width: 12%;font-size: 9px;">NO PRINT</div></a>
    
                           <?php } ?>
                            
                            
                            
                            <?php if($reg_sts =='Y'){ ?>
    
                           <a href="#"><div class="counter_right_payment_button cancel_reorder" onclick="reorder_cancel('<?=$_SESSION['cs_order_id']?>')"; style=" background-color: red; width: 15%;font-size: 9px;">EXIT REORDER</div></a>
    
                           <?php } ?>
                           
                           
                           
                            
                            <input type="hidden" class="settypeval">
                         </div><!-- class="settle_btn"-->
 
                    </div><!--counter_right_total-->
          
            
            <div style="width:50%;text-align: center;    padding-top: 3px;" class="bottom_view_quicklist bottom_view_quicklist1  <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){ ?> disablegenerate <?php } ?>">
                <?php if(in_array("cs_bill_history", $_SESSION['menusubarray'])) { ?>         
                <a href="cs_bill_history.php"> <div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/history-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['billhistory_ta']?></div>
                </div></a>
            <?php } ?> 
                 <a class="counter_sl_payment_hist" href="#">
                   <div class="counter_bottm_quick_btn">
             		<div class="counter_bottm_quic_btn_img"><img src="img/payment-icon.png"></div>
                    <div class="counter_bottm_quic_btn_text"><?=$_SESSION['paymnt_cs']?></div>
                </div></a>
                           
            </div>

            <div style="width:50%;position: relative" class="bottom_view_quicklist bottom_view_quicklist1">
             
             	<div class="table_sel_section">
					<!-- <div class="table_sel_section_name"></div> -->
					<div class="selection_table_btn">
						<input type="text" class="selection_table_input" id="table_cs" placeholder="Tbl/Remarks">
					</div>
					<a href="#"><div class="keybord_sec_cc key_1_btn"><img src="img/clc-btn.png"></div></a>
					<div class="key_bord_counter_sel key_1">
							
				<div class="key_bord_counter_sel_cc">
				<div class="keys settle_key">
                                <span class="clc_btn_12 cs_table">1</span>
                                <span class="clc_btn_12 cs_table">2</span>
                                <span class="clc_btn_12 cs_table">3</span>
                                <span class="clc_btn_12 cs_table">4</span>
                                <span class="clc_btn_12 cs_table">5</span>
                                <span class="clc_btn_12 cs_table">6</span>
                                <span class="clc_btn_12 cs_table">7</span>
                                <span class="clc_btn_12 cs_table">8</span>
                                <span class="clc_btn_12 cs_table">9</span>
                                <span class="clc_btn_12 cs_table"><img src="img/back_ico_1.png"></span>
                                <span class="clc_btn_12 cs_table">0</span>
                                <span class="clc_btn_12 cs_table">Clear</span>
                               
                                </div>
				</div>
						
				</div>
				</div>
            
            	<div class="table_sel_section">
			    <!-- <div class="table_sel_section_name"></div> -->
			    <div class="selection_table_btn" style="margin-left: 20%;">
                            <input type="text" class="selection_table_input " id="cspax" onclick="this.removeAttribute('readonly');" readonly placeholder="RefNo/Pax" onkeypress="return numonly(this.evt)">
				</div>
				<a href="#"><div class="keybord_sec_cc key_2_btn"style="left: 77%;"><img src="img/clc-btn.png"></div></a>
				<div class="key_bord_counter_sel key_2">
							
				<div class="key_bord_counter_sel_cc">
				<div class="keys settle_key">
                                <span class="clc_btn_12 cs_pax">1</span>
                                <span class="clc_btn_12 cs_pax">2</span>
                                <span class="clc_btn_12 cs_pax">3</span>
                                <span class="clc_btn_12 cs_pax">4</span>
                                <span class="clc_btn_12 cs_pax">5</span>
                                <span class="clc_btn_12 cs_pax">6</span>
                                <span class="clc_btn_12 cs_pax">7</span>
                                <span class="clc_btn_12 cs_pax">8</span>
                                <span class="clc_btn_12 cs_pax">9</span>
                                <span class="clc_btn_12 cs_pax"><img src="img/back_ico_1.png"></span>
                                <span class="clc_btn_12 cs_pax">0</span>
                                <span class="clc_btn_12 cs_pax">Clear</span>
                               
                            </div>
				</div>
						
				</div>
				</div>
                <span style="color:lightcoral;position: absolute;bottom: 8%;left: 1%;font-size: 11px">   <?php if(substr($_SESSION['cs_order_id'],0,4) !='TEMP'){  echo '[Reorder Bill : ' .$_SESSION['cs_order_id'].']';   } ?>   </span>    
		</div>
                </div>  
                </div>
        	</div>
               
      </div>
        
      </div> 
</div>


<div class="counter_menu_popup" style="position:fixed;width:506px;left:0%;top:0%;z-index:99999;right:0">

</div>

<div class="counter_menu_popup_overlay"></div>
<input type="hidden" name="hidregennotpos"  id="hidregennotpos" value="<?=$_SESSION['payment_pending_error_regennot']?>" >
<input type="hidden" name="hidselbiltopr"  id="hidselbiltopr" value="<?=$_SESSION['payment_pending_error_selectbill']?>" >
<input type="hidden" name="hidenterpaswd" id="hidenterpaswd" value="<?=$_SESSION['completed_order_popup_password']?>">
<input type="hidden" name="hidenterotp" id="hidenterotp" value="<?=$_SESSION['completed_order_popup_otp']?>">
<input type="hidden" name="hiderrormg" id="hiderrormg" value="<?=$_SESSION['completed_order_error_error_mg']?>">
<input type="hidden" name="hidentramt" id="hidentramt" value="<?=$_SESSION['payment_pending_enteramount']?>">
<input type="hidden" name="hidinsufamt" id="hidinsufamt" value="<?=$_SESSION['payment_pending_insufamount']?>">
<input type="hidden" name="hidentertrnsdt" id="hidentertrnsdt" value="<?=$_SESSION['payment_pending_entertransdt']?>">
<input type="hidden" name="hidchktrnsdt" id="hidchktrnsdt" value="<?=$_SESSION['payment_pending_chktransdt']?>">
<input type="hidden" name="hidselectcoup" id="hidselectcoup" value="<?=$_SESSION['payment_pending_selectcoupon']?>">
<input type="hidden" name="hidentervoucher" id="hidentervoucher" value="<?=$_SESSION['payment_pending_entervoucher']?>">
<input type="hidden" name="hidenterchequeamt" id="hidenterchequeamt" value="<?=$_SESSION['payment_pending_enterchequeamt']?>">
<input type="hidden" name="hidenterbankname" id="hidenterbankname" value="<?=$_SESSION['payment_pending_enterbankname']?>">
<input type="hidden" name="hidenterchecknumber" id="hidenterchecknumber" value="<?=$_SESSION['payment_pending_enterchecknumber']?>">
<input type="hidden" name="hidincrt_amt" id="hidincrt_amt" value="<?=$_SESSION['payment_pending_incrt_amt']?>">
<input type="hidden" name="hidsel_paytype" id="hidsel_paytype" value="<?=$_SESSION['payment_pending_sel_paytype']?>">
<input type="hidden" name="hidsel_credttype" id="hidsel_credttype" value="<?=$_SESSION['payment_pending_sel_credttype']?>">
<input type="hidden" name="hidadd_compli_rem" id="hidadd_compli_rem" value="<?=$_SESSION['payment_pending_add_compli_rem']?>">
<input type="hidden" name="hidvoucher_not" id="hidvoucher_not" value="<?=$_SESSION['payment_pending_voucher_not']?>">
<input type="hidden" name="hidvoucher_ok" id="hidvoucher_ok" value="<?=$_SESSION['payment_pending_voucher_ok']?>">
<input type="hidden" name="hidincrt_coupamt" id="hidincrt_coupamt" value="<?=$_SESSION['payment_pending_incrt_coupamt']?>">
<input type="hidden" name="hidincrt_cheqamt" id="hidincrt_cheqamt" value="<?=$_SESSION['payment_pending_incrt_cheqamt']?>">
<input type="hidden" name="hidsel_tabls" id="hidsel_tabls" value="<?=$_SESSION['payment_pending_sel_tabls']?>">
<input type="hidden" name="hidsel_option" id="hidsel_option" value="<?=$_SESSION['payment_pending_select_roomname']?>">

<input type="hidden" name="hidproc_regen" id="hidproc_regen" value="<?=$_SESSION['procedures_proc_bill_regenerate']?>">

<!------------ end Counter menu add popup ----------------->

<div class="counter_settle_popup" style="display:none">
              <div class="top_head">Bill Details - <span id="settleingbilno"></span>
             
              </div>
              	<div class="settle_main_pop_contant" style="position:relative">
                	<div class="counter_payment_contain" style="position:relative">
                    
                    <div class="tottal_rate_contain" style="color:#000;font-size: 16px;text-align:right;width:100%;background:#cdcecf;margin:0;">
                   			<div class="poup_sub_total"><span style="float: right;padding-left:5px"></span>
                            </div>
                            
                        	
                            <div style="width:100%;text-transform: uppercase" class="payment_pend_right_cash_error"></div>
                            </div>
                            
                            
                       
                       <div class="pop_payment_mode_sel_btn_cc">
                           
                           
                       <?php
                          
			$sql_ds_nos = "select pym_code,pym_id,pym_name from tbl_paymentmode WHERE pym_active='Y' and pym_counter_view='Y'";
			$sql_ds = $database->mysqlQuery($sql_ds_nos);
			$num_ds = $database->mysqlNumRows($sql_ds);
			if ($num_ds) {
			$i = 1;
			while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
								
       			?>

                        <div id="<?= $result_ds['pym_code'] ?>" idval="<?= $result_ds['pym_id'] ?>" class="pop_payment_mode_sel_btn <?php if ($i == 1) { ?> mode_sel_btn_act <?php } ?>">
                       
                       <?php if($result_ds['pym_name']=='Credit / Debit'){ ?>
                             
                       Card - Upi
                           
                       <?php }else{ ?>   
                            
                          <?= $result_ds['pym_name'] ?>
                            
                        <?php } ?>       
                            
                        </div>
                       
                        <?php $i++;
								
			}
			}
                        
                        ?>
                       
                <?php if($_SESSION['be_disc_after']=='Y'  &&  $_SESSION['ser_discount_after']=='Y'){ ?>
                <div id="discount_after_bill_btn"  class="pop_payment_mode_sel_btn77" >DISCOUNT</div>
                <?php } ?>
                       
                       		
                       </div>
                       
                       <div  class="sec_pop_div_right" style="padding-bottom:8px;">
                        
                           <div class="credit_cc_normal" style="display: none;" >
                           <div class="discount_text_cc crd_head" style="display: none;"><?=$_SESSION['payment_pending_card_title']?>Card</div>
                            
                           <div class="selecting_payment_cc" style="display: none;">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_transactionbank']?></div>
                                      
                                         <select id="bankdetails" class=" discount_text_box tax_textbox counter_text_box size_compat">
                                                        
                                                        <?php
                                                        $sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
                                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                                        if ($num_ds) {
                                                            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                                ?>    
                                                                <option value="<?= $result_ds['bm_id'] ?>"><?= $result_ds['bm_name']//$result_ds['bm_name'] ?></option>
                                                            <?php }
                                                        } 
                                                        
                                                        
                       $sql_loginon  =  $database->mysqlQuery("select be_multicard from tbl_branchmaster"); 
	               $num_loginon  = $database->mysqlNumRows($sql_loginon);
	               if($num_loginon){
		          while($result_loginon  = $database->mysqlFetchArray($sql_loginon)) 
		        {
                              
                              $multion=$result_loginon['be_multicard'];
                       } }  
                               
                       ?>
                            </select>
                            </div>
                            </div>
                               
                               
                               <div class="card_detail_popup_contant cardadder" style="padding: 1px;" >
                                    <div class="card_detail_popup_list_head">
                                        
                                        <div class="card_detail_popup_type" style="width:25%;margin-right:1%;display: none">
                                            <div class="card_detail_popup_type_text">Customer Card</div>
                                         </div>  
                                        
                                         <div class="card_detail_popup_type" style="width:30%;display: none">
                                            <div class="card_detail_popup_type_text">Card Last 4 Digits</div>
                                          </div> 
                                          <div class="card_detail_popup_type" style="width:30%;margin-left:1%">
                                            <div class="card_detail_popup_type_text">Amount</div>
                                         </div> 
                                        
                                          <div class="card_detail_popup_type" style="width:23%;margin-left:1%">
                                              <div class="card_detail_popup_type_text" style="margin-left: 40px;">To Bank</div>
                                         </div> 
                                            
                                    </div>
                                   <div id="newref">
                                    <div class="card_detail_popup_list" style="margin-bottom:3px"  id="card_detail_popup_list">
                                        
                                        <div class="card_detail_popup_type" style="width:25%;margin-right:1%;display: none">
                                          <select class="card_type_dropdwn cardselect" id="multicardtype" onclick="return selectdefault();">
                                          <option value="" > Card</option>
                                                  <?php
                                                $sql_rsn1 = "select crd_id,crd_name from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                    while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                            ?>
                                                 
                                                      <option value="<?= $result_rsns1['crd_id']?>"><?= $result_rsns1['crd_name']?></option>
                                                <?php  }}?>
                                             </select>
                                        </div>
                                        
                                        
                                       <div class="card_detail_popup_type" style="width: 30%;display: none">
                                            <input class="card_popup_digits cardno" type="text" id="card_1" value="" name="card_1" chk="0" onkeypress="return numonly()" onclick="return pincard()" onchange="return pincard()" maxlength="4" autocomplete="off">
                                            
                                        </div>
                                        
                                        
                                        <div class="card_detail_popup_type" style="width:40%;margin-left:1%">
                                            <input type="text" class="card_type_dropdwn amountall" id="multi_cardamount" value="" name="multi_cardamount" onkeypress="return enter_plus(event)" onkeyup="return cardsum()" onclick="return cardsum()" onchange="return cardsum()" autofocus autocomplete="off">
                                        </div>
                                        
                                        
                                        <div class="card_detail_popup_type" style="width:43%;margin-right:1%">
                                          <select class="card_type_dropdwn bankselect_new" id="multibanktype" onclick="">
                                         
                                                  <?php
                                                $sql_rsn1 = "select bm_id,bm_name from tbl_bankmaster where bm_active='Y' ";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                    while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                            ?>
                                                 
                                                      <option value="<?= $result_rsns1['bm_id']?>"><?= $result_rsns1['bm_name']?></option>
                                                <?php  }}?>
                                             </select>
                                        </div>
                                        
                                        
                                    </div>
                               </div>     
                          <input type="hidden" value="" id="countload">
                               
                <div style="width: 12%;height: 34px;margin-top: -38px;float: left;margin-left: 323px;background-color: #e6b3b3;display: none " class="menut_add_bq_btn plusbtn" onclick="return plus();">+</div>     
                        
                                </div>
                               
                               
                                    <div class="trrefresh">
                                    <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        
                                        <div style="font-size: 13px;display: none" class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_transactionamount']?></div>
                                        
                                        <input type="hidden" name="pending" id="paymentmsg1" value="<?=$_SESSION['payment_pending_error_comp_remark']?>">
                                        <input type="hidden" name="pending" id="paymentmsg2" value="<?=$_SESSION['payment_pending_error_bill_reprint']?>">
                                        <input type="hidden" name="pending" id="paymentmsg3" value="<?=$_SESSION['payment_pending_error_select_staff']?>">
                                                  
                                          <?php
                                          $sql_rsnrate4 = "select sum(mc_cardamount) as totamount from tbl_bill_card_payments where mc_billno = 'temp_".$_SESSION['billcardcs']."'";
                                          
                                           $sql_rsns1rate4 = $database->mysqlQuery($sql_rsnrate4);
                                                $num_rsns1rate4 = $database->mysqlNumRows($sql_rsns1rate4);
                                                if ($num_rsns1rate4) {
                                                    while ($result_rsns1rate4 = $database->mysqlFetchArray($sql_rsns1rate4)) {
                                                        if($result_rsns1rate4['totamount']!=""){
                                                           $totalcardbill4=$result_rsns1rate4['totamount'];
                                                        }else{
                                                            $totalcardbill4="0";
                                                        }
                                                    }
                                                    
                                                    }
                                                  
                                           $sql_rsnrate74 = " select tab_netamt from tbl_takeaway_billmaster where "
                                           . "tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$_SESSION['billcardcs']."'";
                                           $sql_rsns1rate74 = $database->mysqlQuery($sql_rsnrate74);
                                                $num_rsns1rate74 = $database->mysqlNumRows($sql_rsns1rate74);
                                                if ($num_rsns1rate74) {
                                                    while ($result_rsns1rate74 = $database->mysqlFetchArray($sql_rsns1rate74)) {
                                                        if($result_rsns1rate74['tab_netamt']!=""){
                                                            $totalcardbill74=  number_format($result_rsns1rate74['tab_netamt']-$totalcardbill4,$_SESSION['be_decimal']);
                                                        }else{
                                                            $totalcardbill74="0";
                                                        }
                                                    }
                                                    
                                                    }
                                                    
                                                    
                                                  ?>
                                                  
                                                  
                                                  
                                        <input style="width: 80px;margin-left: -63px;display: none"  placeholder="<?=$_SESSION['payment_pending_palceholder_transaction_amount']?>" class="tax_textbox transa_txt counter_text_box" value="<?=number_format($totalcardbill4,$_SESSION['be_decimal'])?>"  name="transcationid" id="transcationid" onChange="transamountchange()" onkeypress="transamountchange(event)" onkeydown="transamountchange(event)" onkeyup="transamountchange(event)" onclick="transamountchange(event)" autocomplete="off"   readonly  >
                                      
                                    </div>
                               </div>
                              
                               
                               <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div style="margin-top: 9px;font-size: 13px;margin-left: 0px;" class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_balancepay']?></div>
                                      
                                        <input style="margin-left:-7px;margin-top: 5px;width: 140px;"  placeholder="<?=$_SESSION['payment_pending_palceholder_card_balance']?>" class="tax_textbox transa_txt counter_text_box" value="<?=$totalcardbill74?>"  name="transbal" id="transbal" readonly>
                                    </div>
                               </div><!--selecting_payment_cc-->
                                </div>
                           </div><!--credit_cc_normal-->
                           
                            <div class="coupon_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_coupon_title']?></div>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Coupon Code</div>
                                        <input placeholder=" Coupon Code " class="tax_textbox transa_txt counter_text_box" name="coupname" id="coupname"  onkeyup="return coupon_code_redeem(event);"  autocomplete="off">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                    <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_coupon_amount']?></div>
                                    <!--<input placeholder="Coupon Amount" class="tax_textbox transa_txt counter_text_box">-->
                                    <input  placeholder="<?=$_SESSION['payment_pending_palceholder_coupon_enteramount']?>" class="tax_textbox transa_txt counter_text_box" readonly name="coupamount" id="coupamount"  onKeyup="couponamountchange(event)" autocomplete="off">
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_coupon_balancepay']?></div>
                                        <!--<input placeholder="Balance" class="tax_textbox transa_txt counter_text_box">-->
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_coupon_balance']?>" class="tax_textbox transa_txt counter_text_box" name="coupbal" id="coupbal" readonly>
                                    </div>
                              	 </div>
                                 
                            </div>
                            
                            <div class="voucher_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_voucher_title']?></div>
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_voucher_id']?></div>
                                      
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_id']?>" class="tax_textbox transa_txt counter_text_box" name="vouchid" id="vouchid" >
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_voucher_amount']?></div>
                                         <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_amount']?>" class="tax_textbox transa_txt counter_text_box" name="vocamount" id="vocamount" readonly    autocomplete="off" >
                                      
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                  <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_balancepay']?></div>
                                        
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_voucher_balance']?>" class="tax_textbox transa_txt counter_text_box" name="vouchbal" id="vouchbal" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                            </div><!--voucher_cc-->  
                            
                             <div class="cheque_cc" style="display: none;">
                             		<div class="discount_text_cc crd_head"><?=$_SESSION['payment_pending_cheque_title']?></div>
                                    <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_cheque_no']?></div>
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_no']?>" class="tax_textbox transa_txt counter_text_box"  name="cheqname" id="cheqname" onclick="chqname()" >
                                        
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_cheque_bankname']?></div>
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_bankname']?>" class="tax_textbox transa_txt counter_text_box" name="cheqbank" id="cheqbank" onclick="cheqbank()">
                                      
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_check_amount']?></div>
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_amount']?>" class="tax_textbox transa_txt counter_text_box" name="cheqamount" id="cheqamount" onChange="cheqamountchange()" onkeypress="cheqamountchange(event)" onkeydown="cheqamountchange(event)"  onkeyup="cheqamountchange(event)" onclick="cheqamountchange(event)"    autocomplete="off">
                                       
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable"><?=$_SESSION['payment_pending_cheque_balancepay']?></div>
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_cheque_balance']?>" class="tax_textbox transa_txt counter_text_box" name="cheqbal" id="cheqbal" readonly>
                                       
                                    </div>
                              	 </div>

                                </div>
                                
                                
                                
                                  <div class="paid_amount_cc_credit" style="display: none;">
                                      
                                      <div id='cs_currency_credit' style="display:none">
                             <?php 
                             $lang11="";
                             $sql_login11  =  $database->mysqlQuery("select c_name from tbl_currency_master where c_id='".$_SESSION['cursession']."'"); 
			     $num_login11   = $database->mysqlNumRows($sql_login11);
			     if($num_login11){
				while($result_login11  = $database->mysqlFetchArray($sql_login11)) 
				{
                                          
                                 $lang11= $result_login11['c_name'];
                                            
                                }
                                }
                                ?>
                                          
                                          
                                       <div class="selecting_payment_cc">
                                       <div class="selecting_payment_one">
                                       <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                                         <select id="countersel1" onclick="hiddenselect1()" onchange="countchange11()" class="tax_textbox transa_txt counter_text_box size_compat ">
                                         <option id="hidoption1"><?=$lang11?></option>
                                <?php
			        $sql_select  =  $database->mysqlQuery("select c_id,c_name from tbl_currency_master where c_status='Active'"); 
				$num_select   = $database->mysqlNumRows($sql_select);
				if($num_select){
					while($result_select  = $database->mysqlFetchArray($sql_select)) 
					  {
                                            $selectid=$result_select['c_id'];
                                            $selname=$result_select['c_name'];
				?>
                                              
                                <option value="<?=$selectid?>_<?=$selname?>"><?=$result_select['c_name']?></option>
               
                                <?php } } ?>
                
                                      </select>
                                            
                                     </div>
                                     </div><!--selecting_payment_cc-->
                                     <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Amount Paid</div>
                                            <input placeholder="Paid Amount" id="currencyinput1" name="currencyinput1" onchange="currencyinput1()" onkeydown="currencyinpu()" onkeypress="currencyinput1()" onkeyup="currencyinput1()" onclick="currencyinput1()" class="tax_textbox transa_txt counter_text_box" onfocus="currencyinput1();" autofocus value=""  >
                                            
                                        </div>
                                     </div>
                                     
                                      </div>
                                      
                                       
                                  
                                  </div><!--paid_amount_cc_credit-->
                                  
                                  <div class="credit_type" style="display: none;">
                            			<div class="discount_text_cc crd_head" style="display: none;"><?=$_SESSION['payment_pending_credit_title']?></div>
                                        <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">&nbsp; Select Type</div>
                                           
                                                 <select  class="staff_menu_select counter_text_box tax_textbox" name="selectcreditypes" id="selectcreditypes" >
                                            <option value=""><?=$_SESSION['payment_pending_credit_selectlist']?></option>
                                        <?php
                                       
                                        $sql_ds_nos = "select * from tbl_credit_types where ct_active='Y' ";
                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                        if ($num_ds) {
                                            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                                ?>    

                                       <option  value="<?= $result_ds['ct_creditid'] ?>" label="<?=$_SESSION[$result_ds['ct_creditid']]['credittypes_label']// $result_ds['ct_labels'] ?>"><?=$result_ds['ct_credit_type']// $result_ds['ct_credit_type'] ?></option>

                                                <?php }
                                            } ?>                            
                                        </select>
                                        </div>
                                     </div>
                                     
                                      <div class="crd_select_head_cc credtitypeloads" id="crtype_div">
                                      
                                      </div>
                                      
                                                
                                        <div class="selecting_payment_cc" >
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable "> &nbsp;  <?=$_SESSION['payment_pending_credit_amount']?></div>
                                           
                                            <input  style="    margin-top: -8px" placeholder="<?=$_SESSION['payment_pending_palceholder_credit_enteramount']?>" class="tax_textbox transa_txt counter_text_box" id="paidamount_credit" name="paidamount_credit" maxlength="12" onChange="enterbalance_credit()"  onfocus="enterbalance_credit(event)"  onclick="enterbalance_credit(event)"  onkeyup="enterbalance_credit(event)" value="">
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     
                                     
                                     <div class="selecting_payment_cc" style="display:none" >
                                        <div class="selecting_payment_one" style="margin-bottom:5px;">
                                            <div class="lable_counter_paymnet_cc counter_right_lable "> &nbsp;  <?=$_SESSION['payment_pending_credit_balance']?></div>
                                           
                                            <input style="    margin-top: -8px" placeholder="<?=$_SESSION['payment_pending_palceholder_creditbalance_amount']?>" class="tax_textbox transa_txt counter_text_box" id="balanceamout_credit" name="balanceamout_credit" value="" readonly>
                                        </div>
                                     </div>        
                                                
                                                
                                                
                                     <textarea class="credit_remarks_cc" id="credit_remark_cs" name="credit_remark_cs" style="display: none " placeholder="Remarks"></textarea>
                                		
                                </div><!--credit_type-->
                                
                                <div style="display:none" class="complimentrary_cc">
                                 	<div class="discount_text_cc crd_head">Complimentary</div>
                                   
                                        <textarea placeholder="<?=$_SESSION['payment_pending_palceholder_enter_complimentary']?>"  class="room_textarea tax_textbox" name="completext" id="completext" onkeyup="comp_text()" onchange="comp_text()" style="height:80px;color:#000;margin-left: 5px;width: 96%;"></textarea>
                            </div><!--complimentrary_cc-->
                            <div class="upi_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">UPI</div>
                                 <div class="selecting_payment_cc">
                                     <div class="selecting_payment_one" style="text-align: center">
                                         <a href="#"><div class="upi-sub-btn" id="txnstatuscheck">Click here to check status</div></a>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Status</div>
                                      
                                        <input placeholder="Upi Transaction Status" class="tax_textbox transa_txt counter_text_box" name="upistatus" id="upistatus"  autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Amount Paid</div>
                                      
                                        <input placeholder="Upi Amount" class="tax_textbox transa_txt counter_text_box" name="upiamount" id="upiamount"  onchange="upiamountchange(event)" autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable">Upi Transaction Id</div>
                                      
                                        <input placeholder="Upi Transaction Id" class="tax_textbox transa_txt counter_text_box" name="upitransactionid" id="upitransactionid"   autocomplete="off" readonly>
                                    </div>
                              	 </div><!--selecting_payment_cc-->
                                 
                                 <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable upibalanceamount">Balance Amount To Pay</div>
                                        
                                        <input placeholder="Balance Amount To Pay" class="tax_textbox transa_txt counter_text_box" name="upibalanceamount" id="upibalanceamount"  autocomplete="off" readonly>
                                    </div>
                              	 </div>
                                 
                            </div><!--upi--> 
                            
                <?php
                $sq_lang451=$database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
                $nm_lang451= $database->mysqlNumRows($sq_lang451);
                if($nm_lang451){
		while($result_lang451  = $database->mysqlFetchArray($sq_lang451)) 
		{
                      $basecurrency                 =$result_lang451['be_base_currency'];
                      $showcurrency                 =$result_lang451['be_show_currency'];
                    }
                }
                
       $lang1="";
       $sql_login11  =  $database->mysqlQuery("select c_name from tbl_currency_master where c_id='".$_SESSION['cursession']."'"); 
				$num_login11   = $database->mysqlNumRows($sql_login11);
				if($num_login11){
					while($result_login11  = $database->mysqlFetchArray($sql_login11)) 
					  {
                                          
                                          $lang1= $result_login11['c_name'];
                                            
                                }
                          }
                
 $lang31="";
 $sql_login31  =  $database->mysqlQuery("select c_short_code from tbl_currency_master where c_id='".$basecurrency."'"); 
				$num_login31   = $database->mysqlNumRows($sql_login31);
				if($num_login31){
				while($result_login31  = $database->mysqlFetchArray($sql_login31)) 
				{
                                          
                                 $lang31= $result_login31['c_short_code'];
                                             
                     }
                    }
                       
                ?>
                            
                              <input type="hidden" id="curshowfocus" value="<?=$showcurrency?>" > 
                              <input type="hidden" id="cursign2all" name="cursign2all">   
                              <input type="hidden" id="cursignall" name="cursignall">   
                              <input type="hidden" id="cursign2all1" name="cursign2all1">   
                              <input type="hidden" id="cursignall1" name="cursignall1">   
                              <input type="hidden" id="bscur" name="bscur" value="<?=$basecurrency?>">  
                             
                              <div  id="divall" class="paid_amount_cc" style="min-height:35px">
                                
           <?php
                                           
            $sq_lang461=$database->mysqlQuery("select cc_conversion_rate from  tbl_currency_conv_rate where "
            . "cc_base_currency='".$basecurrency."' and cc_currency='".$_SESSION['cursession']."'");
            
            $nm_lang461= $database->mysqlNumRows($sq_lang461);
            if($nm_lang461){
		while($result_lang461 = $database->mysqlFetchArray($sq_lang461)) 
		{
                      $conversionrt  =$result_lang461['cc_conversion_rate'];
                      }
                }
                                ?>
                                
                                <input type="hidden" id="convoratenew" value="<?=$conversionrt?>" > 
                                <?php if($showcurrency=="Y") { ?>                     
                            	<div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Currency</div>
                                            <select id="countersel" onclick="hiddenselect()" onchange="countchange1()" class="tax_textbox transa_txt counter_text_box size_compat ">
                                            <option id="hidoption"><?=$lang1?></option>
                           <?php
			        $sql_select  =  $database->mysqlQuery("select c_id,c_name from tbl_currency_master where c_status='Active'"); 
				$num_select   = $database->mysqlNumRows($sql_select);
				if($num_select){
					while($result_select  = $database->mysqlFetchArray($sql_select)) 
					  {
                                            $selectid=$result_select['c_id'];
                                            $selname=$result_select['c_name'];
					  ?>
                                              
                                    <option value="<?=$selectid?>_<?=$selname?>"><?=$result_select['c_name']?></option>
               
                                    <?php } } ?>
                
                                        </select>
                                            
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                     <div class="selecting_payment_cc">
                                        <div class="selecting_payment_one">
                                            <div class="lable_counter_paymnet_cc counter_right_lable">Amount Paid</div>
                                            <input placeholder="Paid Amount" id="currencyinput" name="currencyinput" onchange="currencyinput()" onkeydown="currencyinput()" onkeypress="currencyinput()" onkeyup="currencyinput()" onclick="currencyinput()" class="tax_textbox transa_txt counter_text_box" onfocus="calc_set();" autofocus value=""  >
                                            
                                        </div>
                                     </div><!--selecting_payment_cc-->
                                       <?php } ?>
                                  <div class="selecting_payment_cc">
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable paid_cls">Paid Cash </div>
                                        <!--<input placeholder="Paid Amount" class="tax_textbox transa_txt counter_text_box">-->
                                        <input  placeholder="<?=$_SESSION['payment_pending_palceholder_enteramount']?>" class="tax_textbox transa_txt counter_text_box" id="paidamount" name="paidamount" maxlength="12" onkeypress="number_dot(event)" onChange="enterbalance(event)" onKeyup="enterbalance(event)" onclick="enterbalance()" value="" autocomplete="off" autofocus="off">
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 <div class="selecting_payment_cc bal_cls_div" >
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable bal_cls">Balance Cash</div>
                                        <!--<input placeholder="Balance Amount" class="tax_textbox transa_txt counter_text_box">-->
                                         <input  placeholder="<?=$_SESSION['payment_pending_palceholder_balance_amount']?>" class="tax_textbox transa_txt counter_text_box" id="balanceamout" name="balanceamout" value="0" readonly>
                                    </div>
                                 </div><!--selecting_payment_cc-->
                                 
                            </div><!--paid_amount_cc-->
                            
                            
               <div class="discount_after_cc" style="display: none;">
               <div class="discount_text_cc crd_head">Discount</div>
               <div class="selecting_payment_cc">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Discount Type</div>
                  
                     <select class="tax_textbox transa_txt counter_text_box" id="dis_after_drop" onchange="dischange_after();">
                                            <option value="">Select Discount</option>
                         <?php
                                            
                        $sql_currency8 = mysqli_query($localhost,"SELECT ds_mode,ds_discountof,ds_discountid,ds_discountname from tbl_discountmaster where ds_status='Active' and ds_item_discount='N' ");
                        $num_currency8 = mysqli_num_rows($sql_currency8);
                        if ($num_currency8) {
                         
		          while($row_listall_dsc  = $database->mysqlFetchArray($sql_currency8)) 
		        { 
                                            
                                          
                                                    ?>
                         <option mode_ds="<?=$row_listall_dsc['ds_mode']?>" val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $row_listall_dsc['ds_discountname']?></option>
                          <?php } } ?>
                         </select>
                     
                  </div>
               </div>
               <!--selecting_payment_cc-->
               <div class="selecting_payment_cc" style="margin-bottom:10px">
                  <div class="selecting_payment_one">
                     <div class="lable_counter_paymnet_cc counter_right_lable">Discount</div>
                     <input style="width:25%;" class="tax_textbox transa_txt counter_text_box" name="dis_after_manual" id="dis_after_manual">
                     <select style="width: 22%; margin-left: 2%;"  class="tax_textbox transa_txt counter_text_box"  id="dis_after_type">
                        <option value="P">%</option>
                         <option value="V">Value</option>
                     </select>
                  </div>
               </div>
              
               
            <div style="float:right;margin: 7px 5px 0 0" class="view_items_btn_dis discount_apply_after">Apply</div>
            </div>       
                            
                            </div><!---sec-div-->
                            <!--tip div-->
                                <div class="tip_section">
                                   <div class="selecting_payment_cc">
                                     <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" style="width: 30%;">TIP</div>
                                        <input placeholder="Tip" class="tax_textbox transa_txt counter_text_box" id="tip_amount" onclick="$('#tip_amount').val('');" onfocus=" return AddClass(this.id)" onkeypress="return charlimit(event,this.value)"  onkeyUp=" return enterbalance(event,this.id)"  value="" autocomplete="off" maxlength="12" style="width: 28%;float: right">
                                        <select class="tax_textbox transa_txt counter_text_box" id="tip_pay_mode" style="width: 22%;float: right;margin-right: 5px">
                                            <option value="C">CASH</option>
                                            <option value="D">CARD</option>
                                        </select>
                                     </div>
                                  </div>
                                </div>

                            <!--tip div-->
                            <div style="width:100%;float:left;" class="">
                             <div class="popup_bottom_tax_detail tax_1" id="taxdetails_div" style="width:50%;padding-right: 3%;">
                            
                             </div>
                             <div class="popup_bottom_tax_detail" style="width:50%;float:right;padding-right: 3%;">
                            	<div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">Discount :<span id="totaldisc"></span></div>
                                <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable"><span id="dis_details_new"></span></div>
                                <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable">Item Discount :<span id="dis_item_new"></span></div>
                                <div style="width:100%" class="lable_counter_paymnet_cc counter_right_lable" ><strong>Sub Total : <span id="final"></span><span></span></strong></div>
                             </div>
                            </div><!--div-->
                            
                      
                            <div style="width:100%;display:block;font-size:22px;text-align: right;padding-top:8px;padding-right: 3%;" class="lable_counter_paymnet_cc counter_right_lable"><strong>Total : (<?=$_SESSION['base_currency']?>) <span id="grandtotal"></span></strong></div>

                           </div><!--counter_payment_contain-->
                           
                           
                           <div class="sms_detail_cls" >
                           
                               
                           <div id="number_load_settle" class="customer_list_autoload" style="display:none;top: 476px;width: 31%;left: 10px;height: 90px;">
                           <ul>
                            <li onclick="return number_click_settle();" style="cursor: pointer"></li>
                                </ul>
                               </div>
                               <input class=""  style="display: none;width:27%;margin:0 10px;margin-bottom:61px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" onkeyup="search_number_settle(event);" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" type="text" onkeypress="number_dot(event)" id="num_sms_new" placeholder="Number">      
                                  
                               <input class="" style="display: none;width:27%;margin:0 10px;margin-bottom:61px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" type="text" id="name_sms_new" placeholder="Name"> 
                                
                               <input class="" style="display: none;width: 27%;margin: 0 10px;height: 33px; font-size: 13px;padding-left: 5px;line-height: 33px;border-radius: 5px;border: solid 1px #C7C7C7;" type="text" onclick="this.removeAttribute('readonly');"  readonly autocomplete="off" id="remarks_sms_new" placeholder="Remarks"> 
                                   
                           </div>
                           
                        <div class="right_bottom_button_cc" style="bottom: -96px;">
                       	<div style="width:30%;float:right;" class="tka_sum_btn_cc">
                        <a class="tka_submit_buton submittranscations" style="cursor:pointer"><?=$_SESSION['settle_ta']?></a>
                        </div>
                            
                            
                            <?php if($_SESSION['s_sms_bill']=="Y") { ?>
                            <div style="width:30%;float:right;" class="tka_sum_btn_cc">
                                <input id="sms_bill_settle" type="checkbox" >
                                       WHATSAPP-SMS BILL
                            </div>
                            <?php } ?>
                            
                            
                            <div style="width:30%;float:left;" class="tka_sum_btn_cc">
                            <a  class="tka_submit_buton settle_popup_close" style="cursor:pointer" href="#"><?=$_SESSION['skip_ta']?></a>
                            </div>
                            
                       </div><!--right_bottom_button_cc-->
                       
                       <div class="counter_settle_popup_right_calc_cc" <?php if($_SESSION['counter_default_settle_touchpad']=="Y") { ?> style="display:block" <?php } ?>>
                       
                       <div class="counter_pop_left_portion" style="height:auto">
            
                            <div class="keys settle_key" style="margin-top:0">
                                <span class="calculator_settle">1</span>
                                <span class="calculator_settle">2</span>
                                <span class="calculator_settle">3</span>
                                <span class="calculator_settle">4</span>
                                <span class="calculator_settle">5</span>
                                <span class="calculator_settle">6</span>
                                <span class="calculator_settle">7</span>
                                <span class="calculator_settle">8</span>
                                <span class="calculator_settle">9</span>
                                <span class="calculator_settle">0</span>
                                <span class="calculator_settle">.</span>
                                <span class="calculator_settle">Clear</span>
                               
                            </div>
                           <div class="settle_quick_cash">
                                    <div class="settle_quick_cash_head">QUICK CASH</div>
                                      <?php
                            $sql_login5  =  $database->mysqlQuery("select dm_denomination from tbl_denomination_master where dm_active='Y' order by dm_display_order asc"); 
	               $num_login5   = $database->mysqlNumRows($sql_login5);
	               if($num_login5){
		          while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
		        {
                          ?>
                          
                       <div class="settle_quick_cash_btn calculator_settle"><?=$result_login5['dm_denomination']?></div>
                       <?php } } ?>         
                                    
                                </div>
            	
           		    </div>
                       
                       </div>
                       
                </div><!--right_main_contant_cc-->
              
              </div><!--right_main_cc---> 
<!--------->

<!--***************  calculator popup  **************-->

<div class="calculator" style="width:350px;">
<div class="counter_menu_popup_head" style="margin-bottom:10px;">
    <div class="counter_menu_popup_head_text">CALCULATOR</div>
	<div id="calc_close" class="counter_menu_popup_head_close" style="margin-top: -3px;right: 10px;position: relative"><img width="30px" src="img/cancel-icon.png"></div>
</div>
			<input type="text" readonly>
			<div class="row_1">
				<div class="key">1</div>
				<div class="key">2</div>
				<div class="key">3</div>
				<div class="key last">0</div>
			</div>
			<div class="row_1">
				<div class="key">4</div>
				<div class="key">5</div>
				<div class="key">6</div>
				<div class="key last action instant">CLEAR</div>
			</div>
			<div class="row_1">
				<div class="key">7</div>
				<div class="key">8</div>
				<div class="key">9</div>
				<div class="key last action instant">=</div>
			</div>
			<div class="row_1">
				<div class="key action">+</div>
				<div class="key action">-</div>
				<div class="key action">x</div>
				<div class="key last action">/</div>
			</div>
	  </div>



<!--**************Hoold list *************************-->

<div class="hold_list_pop_contatnt" id="load_holdlist">
	
</div>

<!--*********End Hoold list *********-->

<!--******* payment pending *********---->
<input type="hidden" class="submitbill">
<div class="counter_sl_payment_hist_pop" id="listallpending">
   <div style="padding-left: 40px;" class="top_head">
            
            
    Payment
    <span class="errorpaymentpop" style="color:#F00; display:none"></span>
       <div style="margin-top:-4px;margin-right:5px;" class="counter_menu_popup_head_close closepaypop close_payment_hold_pop"><img src="img/cancel_bill.png"></div>
    </div>
	<div class="counter_sl_payment_hist_pop_contant">
    	<div class="payment_hold_pop_left_cc">
        	<div class="payment_hold_pop_left_head">
            	 <table width="100%" border="0">
                    <thead>
                      <tr>
                        <th>Bill No</th>
                        <th width="25%">Bill Time</th>
                        <th width="25%">Amount</th>
                      </tr>
                    </thead>
                 </table>   
            </div>
            
            <div class="payment_hold_pop_left_contant_tbl">
            	<table width="100%" border="0">
                    <tbody>
                    <?php
    $sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_loy_id,tb.tab_tips_given,tb.tab_subtotal_final,tb.tab_time,tb.tab_hdcustomerid ,"
            . " ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt,tb.tab_subtotal as subtot,"
            . " tb.tab_servicetax as sertax,tb.tab_vat as vat,tab_discountvalue  as disc,tb.tab_table_no,tb.tab_no_pax From tbl_takeaway_billmaster as tb LEFT JOIN "
            . " tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."'  And "
            . " (tb.tab_payment_settled = 'N') And (tb.tab_mode='CS')   order by tb.tab_time asc ";
    $sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
    $num_table = $database->mysqlNumRows($sql_table_sel);
    if ($num_table) {
        while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
            
			        if($_SESSION['uae_tax_enable']=='Y'){ 
                                  $subt=$result_table_sel['tab_subtotal_final'];  
                                }else{
				   $subt=$result_table_sel['subtot'];
                                }
					 ?>
                        <tr <?php if($result_table_sel['tab_table_no']!='' || $result_table_sel['tab_no_pax']!=''){ ?> title="<?=' Tbl/Rmk : '.$result_table_sel['tab_table_no'].' | Ref/Pax : '.$result_table_sel['tab_no_pax']?>" <?php } ?> ondblclick="double_click_settle('<?=$result_table_sel["tab_billno"]?>')" class="paymenteachnew bill_dbl_<?=$result_table_sel['tab_billno']?>" loy_id="<?= $result_table_sel['tab_loy_id'] ?>" billno="<?= $result_table_sel['tab_billno'] ?>" tips="<?=$result_table_sel['tab_tips_given']?>" kotno="<?=$result_table_sel['tab_kotno']?>" amount="<?= $result_table_sel['tab_netamt'] ?>" servt="<?= $result_table_sel['sertax'] ?>" vat="<?= $result_table_sel['vat'] ?>" subt="<?=$subt?>"  disc="<?= $result_table_sel['disc'] ?>" ><!--payment_hol_act-->
                        <td><?= $result_table_sel['tab_billno'] ?></td>
                        <td width="25%"><?= date("h:i:s", strtotime($result_table_sel['tab_time'])) ?></td>
                        <td width="25%"><?= number_format($result_table_sel['tab_netamt'],$_SESSION['be_decimal'])?></td>
                      </tr>
    <?php } } ?>
                     
            </tbody>
            </table>  
            </div>
        </div>
        
        <div class="payment_hold_pop_right_cc">
        	<div class="payment_hold_pop_left_head">
            	 <table width="100%" border="0">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th width="30%">Qty</th>
                        <th width="25%">Amount</th>
                      </tr>
                    </thead>
                 </table>   
            </div>
            
            <div style="height:355px;background-color: #D8D8D8;" class="payment_hold_pop_left_contant_tbl loadpaymetdetls">
            	  
            </div>
            <div class="payment_pop_item_total">Total:<span id="totalamoutpaymnt"></span></div>
            <div class="payment_hold_pop_buton_cc">
            	
                <a href="#"><div class="payment_hold_btn paysubmitbut">LOADING</div></a>
               
            </div>
        </div>
        
        
    </div>
</div>

<!-- ***************** manage popup starts  ************************ -->

<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->    
 
 <input type="hidden" name="staffwithdiscount" id="staffwithdiscount" value="<?=$_SESSION['s_discountpermission']?>">
 <input type="hidden" name="staffwithdiscountmanual" id="staffwithdiscountmanual" value="<?=$_SESSION['s_discount_manual']?>">

<div class="new_alert_cc" >
 <div class="confirm_detail_con_pop"></div> 
    
</div> 


<div style="display:none;height: auto;bottom: auto;top: 150px;width: 315px;overflow:visible;   left: -150px;height: 275px" class="index_popup_1 loyalty_main_popup">
    <div class="discount_popu_head_cc">
        
        <?php if($_SESSION['counter_discount_popup']=="Y"){ ?>
        <h3 style="" class="sm_pop_head discount_click discount_popo_head_act">Enter Discount </h3>
        <?php } ?>
        
        <?php if( $_SESSION['loyalty_settle_on']=="Y"){ ?>
        <h3 style="" class="sm_pop_head  loyalty_click">Add/Redeem</h3>
        <?php } ?>
        
    </div>
    <div class="discount_loyalty_popup  loyalty_popo_div"  style="display:none">
        
        <div class="cs_loyalty_sec">
            <div class="alert_section"><span id="loy_error"></span></div>
            <div class="cs_loyalty_sec_box" style="position:relative">
               
                <input placeholder="Loyalty ID" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onkeyup="return search_id(event);"  onkeypress="return numdot(event);" onfocus="return search_id(event);" onclick="return search_id(event);"  id="ly_id"  autocomplete="off" autofocus >
                     <div id="id_load" class="customer_list_autoload" style="display:none;">
                           <ul>
                             <li onclick="return id_click();" style="cursor: pointer"> </li>
                           </ul>
                     </div>
            </div>
            <div class="cs_loyalty_sec_box" style="position:relative">
               
                <input placeholder="Customer Name" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onclick="return search_name(event);" onfocus="return search_name(event);"  onkeyup="return search_name(event);" id="ly_name"  autocomplete="off">
                     <div id="name_load" class="customer_list_autoload" style="display:none;">
                            <ul>
                               <li onclick="return name_click();" style="cursor: pointer"> </li>
                             </ul>
                      </div>
            </div>
            <div class="cs_loyalty_sec_box" style="position:relative">
                <input placeholder="Mobile No" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onclick="return search_number(event);" onkeypress="return numdot(event);" onfocus="search_number(event);" onkeyup="search_number(event);" id="ly_number" autocomplete="off">
                  <div id="number_load" class="customer_list_autoload" style="display:none;">
                        <ul>
                            <li onclick="return number_click();" style="cursor: pointer"></li>
                        </ul>
                  </div>
            </div>
            <div class="cs_loyalty_sec_box">
                <input placeholder="Customer Points" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box"  id="ly_points" autocomplete="off" readonly>
            </div>
            <div class="cs_loyalty_sec_box">
                <input placeholder="Points to Redeem" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onkeypress="return numdot(event);" onclick="return redeem_point(event);" onchange="return redeem_point(event);"   id="redeem_point" onkeyup="return redeem_point();" autocomplete="off">
            </div>
            
            <div class="cs_loyalty_sec_box">
                <a  title="ADD CUSTOMER" href="#" onclick="return show_loy_pop();" style="display: none "> <img style="background-color: darkred " src="img/user-loyalty-icon.png"> </a>
                
                
                <a style="margin-left: 25px  " title="BILL DETAILS" href="#" onclick="return list_loyalty_bill();" class="action-btn"><img style="border:solid 1px " src="img/rate.png"></a>
            </div>
            
            <div class="cs_loyalty_sec_box" style="display: flex;margin-right: 0; width: 100%; margin-bottom: 0;position: relative">
            <div id="point_show" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">Redeem(<span id="redeem_point_total"> 0 </span>pts): <span id="redeem_amount_total"> 0</span></span></div>  
            <div id="point_amount_show" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">Before Redeem: <span id="total_before_redeem"> 0 </span> </span></div>                          
           <div id="point_show_after" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none;position: absolute;bottom:-14px" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">After Redeem: <span id="total_after_redeem"> 0 </span> </span></div>                          
            </div>
             </div>
        
        <div class="index_popup_contant" style="margin-top: 17px;">
    	  
             <div style="width: 25%;" class="btn_index_popup ">
                 <a id="redeem_btn_click" href="#" class="">REDEEM</a>
                 <a id="clear_btn_click" style="display:none" href="#" class="">Clear</a>
                 
             </div>
             
            <div style="width: 25%;background-color: #6bb943"  class="btn_index_popup" id="new_proceed_loyalty_div">
            <a id="new_proceed_loyalty" href="#" >PROCEED </a>
            </div>
             
        </div>
    </div>
    
    <div class="loyalty_popup_keybord_cc" style="height:275px">
        <a id="" href="counter_sales.php" class=""><div class="auth_dis_popup_close"><img src="img/cancel-icon.png"></div></a>
        <strong style="color:#3e3e3e;font-size: 16px; margin-top: -4px;float: left;width: 100%;text-align: left;height: 37px;padding-left: 8px;"> Subtotal :  <strong id="subtotal_l1"></strong> </strong> 
        <div class="keys settle_key" style="margin-top:-7px;padding: 0 0 2% 2%;">
               <span class="pay_settle_btn">1</span>
               <span class="pay_settle_btn">2</span>
               <span class="pay_settle_btn">3</span>
               <span class="pay_settle_btn">4</span>
               <span class="pay_settle_btn">5</span>
               <span class="pay_settle_btn">6</span>
               <span class="pay_settle_btn">7</span>
               <span class="pay_settle_btn">8</span>
               <span class="pay_settle_btn">9</span>
               <span class="pay_settle_btn">0</span>
               <span class="pay_settle_btn">.</span>
               <span class="pay_settle_btn">Clear</span>
           </div>
         
    </div>
    
</div>

<div class="auothorize_popup" style="display:none;bottom: auto;top: 191px;width: 315px;overflow:visible;left: -150px;">
    
        <div class="auothorize_popup_head" style="margin-top:23px">Discount Authorization</div>
        <span style="text-align: center;width: 100%;float: left;height:20px;"></span>
        <div class="discout_auth_contant" style="    padding-top: 40px;">
           
            <form autocomplete="off"  style="text-align: center;width: 100%;float: left">
            <input  type="password" onkeypress=" return numdot(event);" onchange="return dis_pincheck()" onclick="return dis_pincheck()" onfocus="return dis_pincheck()" id="dis_pin" maxlength="4" placeholder="Enter Your Pin" class="discout_auth_contant_textbox" autocomplete="off" autofocus style="width: 50%;float: none;display: inline-block;border-radius: 30px;outline: none !important ">
           
            <input  type="text" onkeypress=" return numdot(event);"    id="dis_phone" maxlength="15" placeholder="Enter Your Loyalty Number" class="discout_auth_contant_textbox" autocomplete="off" autofocus style="margin-top: 8px;width: 70%;float: none;display: inline-block;border-radius: 30px;outline: none !important ">
           
            
            <input  type="text" onkeypress=" return numdot(event);"    id="dis_otp" maxlength="15" placeholder="Enter Your OTP In MAil" class="discout_auth_contant_textbox" autocomplete="off" autofocus style="display: none;margin-top: 8px;width: 70%;float: none;display: inline-block;border-radius: 30px;outline: none !important ">
           
            
            </form>
            
            <span style="text-align: center;width: 100%;float: left;color: red ;height:20px;margin-top:15px;"> <strong id="dis_error" ></strong></span>
        </div>
        
        <div class="auothorize_popup_footer_btn_cc">

    <?php if($_SESSION['s_print_option']=='Y'){ ?>
        <label style="width:100%;display: none;float:left;margin-top: -28px; text-align: center;" for="print_checker"><input type="checkbox" checked="checked" id="print_checker"> Print &nbsp;&nbsp;</label>
    <?php } ?>
            
            <div style="width: 25%;background-color: #ca070a" class="btn_index_popup ">
                  <a id="dis_auth_proceed_without_discount" href="#" class="">Bill</a>
             </div>
            <div style="width: 25%;background-color: #6bb943" class="btn_index_popup ">
                <a  id="dis_auth_proceed" href="#" class="">Discount</a>
             </div>
            
        </div>
    </div>

<div style="display:none;height: auto;bottom: auto;top: 191px;width: 315px;overflow:visible;   left: -150px;height: auto;" class="index_popup_1 disountenterpopup discount_div">
    
    <div class=" discount_loyalty_popup ">
        <div style="height:auto;" class="index_popup_contant ">
                
            <span class="contenttext"  style="display: inline-block;padding: 29px 0 29px 0;padding-left:6%;text-align: left;width: 100%;background-color: #f3f3f3;height:155px">
            <p style="display:inline-block;margin-bottom: 5px;">Type</p>
                
                <select  class="form-control" name="disountamount_drop" id="disountamount_drop"  onchange="dischange();" style="width:74%;border: 0;display:inline-block;height:33px;padding:0px;margin-left: 6.5%;box-shadow: 0px 2px 7px #bdbdbd;">
                  <option value="none">none</option>
                  <?php
                  $sql_listall_dsc  =  $database->mysqlQuery("SELECT ds_mode,ds_discountof,ds_discountid,ds_discountname from tbl_discountmaster where ds_status!='Inactive' and ds_item_discount!='Y' "); 
                  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
                  if($num_listall_dsc){
                   while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
                  {
                 ?>
                 <option mode_ds="<?=$row_listall_dsc['ds_mode']?>" val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?=$row_listall_dsc['ds_discountname']?></option>
                <?php } } ?>
              </select>&nbsp; 
              <div class="discount_offer_or_cc manual_permission_cs" style="margin-top: 0px;display:none">
             

             
              Manual <input type="text" class="form-control" onkeyup="return discount_in_loy();" onfocus="return discount_in_loy();" onclick="return discount_in_loy();" onchange="return discount_in_loy();" name="disountamount" id="disountamount" style="width:53%;border: 0;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;box-shadow: 0px 2px 7px #bdbdbd;" value=""> 
              <label style="display:inline;font-weight:normal">
                   <span class="percen_radio" style="top:0">
                     <input type="radio" class="typesel" name="typesel" id="P"  value="P" checked>%
                   </span> 
               </label>
              <label style="display:inline;font-weight:normal">
                 <span style="top: 17px;" class="percen_radio"> 
                    <input type="radio" class="typesel"  name="typesel" id="V"  value="V">Value
                 </span> 
             </label>
               
               </div> 
              <div><p id="load_discount_data" style="text-align: center;"></p></div>
            </span>

        </div>

    <div class="index_popup_contant" style="margin-top: 8px;">
    	

        <div style="width: 25%;    background-color: #6bb943;" class="btn_index_popup "><a href="#" class="closedisount">Submit</a></div>
    </div>
        
     <div class="loyalty_popup_keybord_cc" style="    top: -41px;">
         <a id="" href="counter_sales.php" class=""><div class="auth_dis_popup_close"><img src="img/cancel-icon.png"></div></a>
         <strong style="color:#3e3e3e;font-size: 16px; margin-top: -4px;float: left;width: 100%;text-align: left;height: 37px;padding-left: 8px;">Subtotal :  <strong id="subtotal_d1"></strong> </strong> 
        <div class="keys settle_key" style="margin-top:-7px;padding: 0 0 2% 2%;">
               <span class="pay_settle_btn">1</span>
               <span class="pay_settle_btn">2</span>
               <span class="pay_settle_btn">3</span>
               <span class="pay_settle_btn">4</span>
               <span class="pay_settle_btn">5</span>
               <span class="pay_settle_btn">6</span>
               <span class="pay_settle_btn">7</span>
               <span class="pay_settle_btn">8</span>
               <span class="pay_settle_btn">9</span>
               <span class="pay_settle_btn">0</span>
               <span class="pay_settle_btn">.</span>
               <span class="pay_settle_btn">Clear</span>
           </div>
          
    </div>
 </div>
 </div>


<!-- *************** add new menu item popup starts  ************ -->
    <div style="position:fixed;width:100%;left:0%;top:7%;z-index:99999;right:0" class="mynewpopupload"  ></div>
 <!-- ********** add new menu item popup ends  *************** -->
 
 <input type="hidden" name="focusedtext" id="focusedtext" >
 
 
<div class="del_contain_pop" id="cs__clearall_confirm">
	<div class="delete_con_pop"> CLEAR CART ? &nbsp; &nbsp; <a style="cursor:pointer"  class="clear_all_ok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="ts_status">Cancel</a> </div>
</div> 
<div class="del_contain_pop" id="ta_confirm">
	<div class="delete_con_pop">Are you sure you want to delete? <a style="cursor:pointer" ck="ok" class="ts_statusok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="ts_status">Cancel</a> </div>
</div> 

<div class="del_contain_pop" id="confirmhold">
	<div class="delete_con_pop">Are you sure you want to this to hold? <a style="cursor:pointer" ck="ok" class="confirmholdok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="confirmholdccl">Cancel</a> </div>
</div> 

<div class="del_contain_pop" id="reverthold">
	<div class="delete_con_pop">Are you sure you want to Revert? <a style="cursor:pointer" ck="ok" class="revertholdok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="revertholdccl">Cancel</a> </div>
</div> 

<div class="del_contain_pop" id="deletehold">
	<div  class="delete_con_pop">Are you sure you want to Delete? <a style="cursor:pointer" ck="ok" class="deleteholdok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="deleteholdccl">Cancel</a> </div>
</div> 

<div class="del_contain_pop" id="deleteallhold">
    <div style="width:45%" class="delete_con_pop">Are you sure you want to Delete Selected? <a style="cursor:pointer" ck="ok" class="deleteholdallok">OK</a> &nbsp; <a  style="cursor:pointer" ck="cancel" class="deleteholdallccl">Cancel</a> </div>
</div> 

 <div style="display:none" class="confrmation_overlay_auth"></div>

 <div style="display:none" class="confrmation_overlay"></div>
 
  <div style="display:none" class="confrmation_overlay_settle_auth"></div>
  
  <div style="display:none" class="confrmation_overlay_kot"></div>
 
 
  <div class="cs_loy_pop" id="loyalty_cs_pop" style="z-index:1">
     <div class="delete_con_pop" style="height:auto;width: 350px;top:20%;background-color:white;color: black !important;border: 0;padding-bottom: 10px ! important ">
         <div class="loyalty_cs_pop_overlay" style="display: none " ><img src="img/ajax-loaders/pls_wait.gif"></div>
         Customer Details <br>
         
     <div style="  height: auto; width: 100%;text-align: left;padding: 7px 20px;margin-top: 7px; margin-bottom: 8px; float: left; background-color: #f3f3f3; ">   

     <div class="inp_lyt_hlf_dv">
     <div class="lyt_txtbx_row" style=""><input onkeypress="return numdot(event);"  onkeyup="return search_new_enter(event);" class="lyt_inp" type="text" id="phone_cs" style="float:right"  placeholder="Number"></div>
     <div id="num_load_new" class="customer_list_autoload" style="display:none; width: 89%; top: 75px; right: 19px">
       <ul>
        <li onclick="return num_click_new();" style="cursor: pointer"> </li>
      </ul>
       </div>
     
     </div>    
           
           
       <div class="inp_lyt_hlf_dv">
           <div class="lyt_txtbx_row" style="width:100%;float: left;;margin-bottom: 10px;font-size:12px">   <input class="lyt_inp" onkeyup="return search_new_enter(event);"  onkeypress="return alpha_name(event)" type="text" id="firstname_cs" style="float:right" placeholder="First Name"></div>
                  <div id="name_load_new" class="customer_list_autoload" style="display:none; width: 89%; top: 115px; right: 19px">
                            <ul>
                               <li onclick="return name_click_new();" style="cursor: pointer"> </li>
                             </ul>
                      </div>
       
       </div>    
            
     
    
      <div class="inp_lyt_hlf_dv">
      <div class="lyt_txtbx_row" style="width:100%;float: left;margin-bottom: 10px">      <input class="lyt_inp" type="text" id="email_cs" style="float:right" placeholder="Email"></div>
      </div>  
      <div class="inp_lyt_hlf_dv">
      <div class="lyt_txtbx_row" style="width:100%;float: left;margin-bottom: 10px">
                  <input style="" type="text" class="lyt_inp" id="gst_loy"  placeholder="Remarks/TRN/VAT/GST NO">
        </div>  </div>  
      <div class="inp_lyt_hlf_dv">
    
          <div class="inp_lyt_hlf_dv sms_mail_div" style="width: 57%;">

        <div style="width:auto;float: left;margin-bottom: 10px"> SMS  -   <input style="position: relative;top: 2px " type="checkbox" id="checkbox_sms"> </div>
         
     
      <div style="width:auto;float: left;margin-bottom: 10px;margin-left:15px"> MAIL  -    <input style="position: relative;top: 2px " type="checkbox" id="checkbox_mail"> </div>
      </div>    
      
     
       </div>
         
       
       <div style="width:100%;height:15px;right:10px;bottom:10px"><strong   id="error_show" style="display:none;color: darkred" ></strong></div>
       
           
      <a onclick="return close_loy_pop();" style="cursor:pointer;background-color:#5f0909 !important;text-decoration:none;float:right;" ck="cancel" class="ts_status">EXIT</a>    &nbsp;
        
   <a style="cursor:pointer;background-color:#5f0909 !important;text-decoration:none;float:right;margin-right:8px" onclick="return submit_loy_cs();"  class="clear_all_ok">SUBMIT</a> 
      </div>
 </div> 
 </div> 
 
 <style>
     .product_img{
	  border-bottom: 0;
	width:168px;
	height:120px;
	float:left;
	vertical-align:middle;
	border:solid 0px #ccc;
	  overflow: hidden;
	  margin-bottom:5px;
	}
.product_img img{width:100%;overflow:hidden;}
 .loyalty_cs_pop_overlay{
    width:100%;
	height:100%;
	position:absolute;
	z-index:999;
	background-color:rgba(255, 255, 255, 0.8);
    top:0;
    display:flex;
    align-items:center;
    justify-content: center;
 }
 .loyalty_cs_pop_overlay img{width:150px}
.lyt_inp{width:100%;float:left;height:30px;border:solid 1px #ccc;padding-left:10px;font-size:13px}
.lyt_txtbx_row{width:100%;float: left;margin-bottom: 10px;font-size: 12px;font-weight: lighter;}
.inp_lyt_hlf_dv{
  width: 100%;
  height: auto;
  float: left; 
  margin-right:15px
}

     .auth_dis_popup_close{width: 30px; height: 30px;position: absolute;right: 4px;top: 3px;background-color: #fff;}
     .auth_dis_popup_close img{width: 100%;}
     .discout_auth_contant{width: 100%; height: auto;float: left;padding: 10px; margin-top: 10px;}
     .discout_auth_contant_textbox_name{width: 100%;height: auto;float: left;font-size: 15px;color: #666;    margin-bottom: 5px;}
     .discout_auth_contant_textbox{
         width: 98%;
         height: 38px;
         float: left;
         border: 0;
            box-shadow: 0px 2px 7px #bdbdbd;
         background-color: #fff;
         padding-left: 10px;
        
             border-radius: 7px;
     }
     .auothorize_popup{
        width: 100%;
         height:166px;
         background-color: #f3f3f3;
         position: absolute;
         top:0px;
         left: 0;
             right: 0;
            margin: auto;
            z-index: 99999;
     }
     .auothorize_popup_head{
         width: 100%;
    height: 41px;
    float: left;
    text-align: center;
    color: #5f2903;
    font-size: 18px;
    position: absolute;
    padding-top: 10px;
/*    top: -41px;*/
    padding-bottom: 10px;
/*    background-color: #ffffff;*/


     }
     .auothorize_popup_footer_btn_cc{
         width: 100%;
         height: 41px;
        bottom: -33px;
        position: absolute;
         background-color: #fff;
         text-align: center;
    padding-top: 4px;
     }
     .loyalty_popup_keybord_cc{
         width: 198px;height: 240px;position: absolute;top: 0;
         right: -195px;background-color: #f3f3f3;padding-left: 7px; padding-top: 12px;
     }
     .loyalty_popup_keybord_cc .settle_key span, .top span.clear{    background-color: #d8d8d8 !important;    height: 43px;}
     .alert_section .popup_validate{line-height: 10px;    width: 100%;font-size: 13px;}
     .alert_section{width: 100%;height: 20px;float: left;text-align: center;padding: 0 2%;color: #f00;font-size: 13px;line-height: 18px}
     .cs_lyt_text_box{
         width: 100%;
         height: 30px;
         border: 0;
         float: left;
         box-shadow: 0px 2px 7px #bdbdbd;
         padding-left: 5px;
         border-radius: 4px;
     }
     .cs_loyalty_lable{width: 100%;height: auto;float: left;font-size: 12px; margin-bottom: 0px;  color: #8a8686;}
     .cs_loyalty_sec_box{
         width: 46%;
         height: auto;
         float: left;
         margin-right: 4%;
         margin-bottom: 10px;
     }
     .cs_loyalty_sec{
          width: 100%;
         height: auto;
         float: left;
         display: inline-block;
         padding: 6px 0 7px 0;
         padding-left: 4%;
         text-align: left;
         width: 100%;
         min-height: 98px;
         background-color: #f3f3f3;
             
     }
     .discount_loyalty_popup{
         width: 100%;
         height: auto;
         float: left;
        
     }
     .discount_popu_head_cc{
          width: 100%;
         height: auto;
         float: left;
         border-bottom: 1px #ccc solid; margin: 0px;margin-bottom:0
     }
     .discount_popu_head_cc h3{width: 50%;text-align: center;float: left;margin: 0;font-size: 18px;
         padding: 10px 0 10px 0;
           position: relative;
         cursor: pointer;
    border-bottom: 3px #f3f3f3 solid;
         background-color: #fff;
           
     }
     .discount_popo_head_act{
          background-color: chocolate !important;
           border-bottom: 3px #a24c0f solid  !important;
        color: #fff;
     }
     
 .confrmation_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
                
                .confrmation_overlay_kot{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
        
		}
                
 .confrmation_overlay_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
                
                 .confrmation_overlay_settle_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
.index_popup_contant{
	width:100%;
	height:30px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}			
.index_popup_reg{
		width:35%;
	height:80px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
 .index_popup_1{
	width:35%;
	height:180px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}
.index_popup_contant{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}
.index_popup_confrm{
		width:35%;
	height:80px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
.index_popup_2{
	width:35%;
	height:270px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}			
.btn_index_popup{
	width:15%;
	display:inline-block;
	height:34px;
	line-height:36px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}
.btn_index_popup_cls{background-color: #fff !important;border: solid 1px #f00;}
     .btn_index_popup_cls a{color: #666 !important;}
	</style>

<script src="js/calculator.js"></script>
<script src="js/counter_del.js"></script>

<script type="text/javascript"> 

       $(".discount_click").click(function(){
            
                        var staffwithdiscountcs=$('#staffwithdiscountcs').val();
	                var disc=$('#counter_discount_popup').val();
			$(".loyalty_main_popup").css("display","block");
                        if(disc=="Y" && staffwithdiscountcs=="Y")
	                {
			$(".discount_div").css("display","block");
                        }
                        $(".loyalty_popo_div").css("display","none");
			$(".discount_click").addClass("discount_popo_head_act");
			$(".loyalty_click").removeClass("discount_popo_head_act");
                        $('#disountamount').focus();
                        $('#dis_pin').focus();
                          $('.auothorize_popup').show();
                           $('#new_proceed_loyalty_div').show();
	});
                
        $(".loyalty_click").click(function(){
                        
                        var loyalty_status=$('#loyalty_status').val();
                        $(".loyalty_main_popup").css("display","block");
			$(".discount_div").css("display","none");
                        if(loyalty_status=="Y"){
                         $(".loyalty_click").addClass("discount_popo_head_act");
                         }
                         $(".discount_click").removeClass("discount_popo_head_act");
                         $(".loyalty_popo_div").css("display","block");
                         $('.auothorize_popup').hide();
                         if( $('#ly_id').val()==""){
                          $('#ly_id').focus();
                          }
        });
	
		
		
		$(".settle_btn").click(function(){//alert("h");
			$(".counter_settle_popup").css("display","block");
			$(".counter_menu_popup_overlay").css("display","block");
		});
                
                
                
		
     $(".settle_popup_close").click(function(event){
         
         
	event.stopImmediatePropagation();
        
        $("#customer_set_data2").css("display","block");
        
        $("#customer_set_data3").css("display","none");
        
        //if($("#customer_set_data3").css('display') == 'none' ){
        $("#customer_set_data5").css("display","block");  
        // }
        
        $("#customer_set_data1").css("display","none");
        $("#customer_set_data4").css("display","none");
        
	$(".counter_settle_popup").css("display","none");
	$(".counter_menu_popup_overlay").css("display","none");
     
        var sel=$('#bscur').val();
       
        var datastringnew22="set5=cat5&idofcur5="+sel;
      
        $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew22,
        success: function(data)
        {
           $("#refdiv").load(location.href + " #refdiv");
        }
        
       });
  
    
 
     if(localStorage.coming_from=='direct_flow'){
        
       if( $('.cancel_reorder').css('display') == 'block') {
           window.location.href = "counter_sales.php";  
       }
       
        $(".counter_settle_popup").css("display","none");
	$(".counter_menu_popup_overlay").css("display","none");
	$(".confrmation_overlay").css("display","none");
        
       }else{
       
        if($('.counter_settle_popup:visible').length == 0)
        {
           window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
           
        }else{
         
        if($('.cancel_reorder').css('display') == 'block') {
            
            window.location.href = "counter_sales.php";   
        }
         
        $(".counter_settle_popup").css("display","none");
	$(".counter_menu_popup_overlay").css("display","none");
	$(".confrmation_overlay").css("display","none");
        
        }
        }
    	
        $(".counter_settle_popup").css("display","none");
	$(".counter_menu_popup_overlay").css("display","none");
	$(".confrmation_overlay").css("display","block");
        
        $('.alert_error_popup_all_in_one').show();
        $('.alert_error_popup_all_in_one').text('SKIPPING BILL');
       
       // window.location.href = "counter_sales.php";  
        
        var billno1=$('#settleingbilno').text();
        var gtt=parseFloat($('#grand_org').val());
      
       $(".confrmation_overlay").css("display","none");  
       $('.alert_error_popup_all_in_one').hide();
      
       if(gtt>0 && billno1!=''){
            
                  var data_loy = "set_loyalty_bill_change_old=bill_amount_change_old&billno_old="+billno1+"&new_amount_old="+gtt;
		
                        $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: data_loy,
			success: function(data55) {
                          
                          $(".confrmation_overlay").css("display","none");  
			  $('.alert_error_popup_all_in_one').hide();
                          //  window.location.href = "counter_sales.php";  
                       
    var url_check=$('#url_check').val();
   
    var new_id=url_check.split('set_reorder=');

    if(new_id[1]=='coming'){
         window.location.href = "counter_sales.php";  
    }
                       
                       
     }
		
     });
     }
            
     $(".loyalty_main_popup").css("display","none");     
         
     if('<?=$_SESSION['be_search_focus_counter']?>'=='search'){
         $('#search').focus();
     }
     else if('<?=$_SESSION['be_search_focus_counter']?>'=='search_code'){
     
        $('#search').focus();
     }else{
                      
        $('#search').focus();
                     
     }
               
        // $('#customer_set_data5').hide();   
        $('.total_itemcount2').text('0');
        $('.tal_viewtotal').text('0');
        $('.final_show').text('0');
        $('.tax_show').text('0'); 
        $('.listorderditems').empty();  
        $('.countergenerate').show();
        $('.settle_direct').show();     
        $('#taxdetails_div').text('');
        $('#table_cs').val(''); 
        $('#cspax').val(''); 
        $('#dis_pin').val('');
        $('#disountamount').val('');
        
        
          var  dataString1 = 'set=set_print_option&print_option=Y' ;
                      
		$.ajax({
		type: "POST",
		url: "load_index.php",
		data: dataString1,
		success: function(data) {
                    
                
                 }
                });
        
        
  });
  
  
                
  $("#settle_close").click(function(){
	$(".counter_settle_popup").css("display","none");
	$(".counter_menu_popup_overlay").css("display","none");
	$(".confrmation_overlay").css("display","none");
  });
		
				
  $("#calulator").click(function(){
	$(".calculator").css("display","block");
	$(".counter_menu_popup_overlay").css("display","block");
  });


  $("#calc_close").click(function(){
      $(".calculator").css("display","none");
      $(".counter_menu_popup_overlay").css("display","none");
  });
	
        
  $(".hold_list_pop").click(function(){
     $(".hold_list_pop_contatnt").css("display","block");
     $(".counter_menu_popup_overlay").css("display","block");
  });
		
		
		
  $(".counter_sl_payment_hist").click(function(){
			
			localStorage.coming_from='payment_pending';
			
			$(".counter_sl_payment_hist_pop").css("display","block");
			$(".counter_menu_popup_overlay").css("display","block");
			
			 var request = $.ajax({
						  url: "load_counter_sales.php",
						  method: "POST",
						  data: {value:'listpaymentpending' },
						  dataType: "html"
						});
				   
						request.done(function( msg ) {
						  $( "#listallpending" ).html( msg );
						
						  });
						
						data = null;
						msg=null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
				
  });
	
        
        
 $(".close_payment_hold_pop").click(function(){
                   
    $(".counter_sl_payment_hist_pop").css("display","none");
    $(".counter_menu_popup_overlay").css("display","none");
                        
 });
 
		
</script>

<script type="text/javascript"> 

  function alpha_name(e) {
      
     var k;
     document.all ? k = e.keyCode : k = e.which;
     return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
  }    


  function double_click_settle(bill){
         
        $('.bill_dbl_'+bill).addClass('payment_hol_act');
         
        $('.payment_hol_act').attr('billno',bill);
         
        $('.paysubmitbut').click();
          
  }        
           


 function validateSearch_code1(type)
 {
	var menuname;
	if(type=="N")
	{
		menuname=($('#search').val());
	}else
	{
		menuname=($('#codesrch_c').val());
	}
	                var dataString;
			dataString = 'value=menusearch_counter&menuname='+menuname;
			$.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
			data=$.trim(data);
				if(data=="sorry")
				{
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Sorry, No menu..");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			  
				}else
				{
					$('.counter_menu_popup_overlay').css("display","block"); 
		 			 $('.counter_menu_popup').css("display","block"); 
					 var request = $.ajax({
						  url: "counter_popup.php",
						  method: "POST",
						  data: {menu:data,typesub:'Add' },
						  dataType: "html"
						});
				   
						request.done(function( msg ) {
						  $( ".counter_menu_popup" ).html( msg );
						});
						
						data = null;
						  msg=null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
				}
			}
			});
	
  }



  function validateSearch(type)
  {
			var menuname;
			if(type=="N")
			{
				menuname=($('#search').val());
			}else
			{
				menuname=($('#codesrch').val());
			}
			
			var dataString;//alert(menuname);
			dataString = 'value=menusearch&menuname='+menuname;
			$.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
				data=$.trim(data);
				if(data!="sorry")
				{
					var id_arr	  =	 data.split(",");
					var menuid       =  id_arr[0];
					var catid       =  id_arr[1];
					var subcatid       =  id_arr[2];
					$(".ta_categorysel>div").removeClass("main_category_list_act");
					 $('.ta_categorysel').filter('[catid="catid_'+catid+'"]').find('div').addClass('main_category_list_act');
					 var datastring1;
					 if(subcatid!="")
					 {
					  datastring1 = 'value=subcatselection&category=' + catid +'&subcategory=' + subcatid;
					 }else
					 {
						  datastring1 = 'value=subcatselection&category=' + catid;
					 }
					 $('#ta_catname').val(catid);
					  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: datastring1,
						success: function(data) {
						 $('#ta_loadsubcat').html(data);
						 var subcategory=$('.ta_subcatchange').val();
						 var datastring2;
						 if(subcategory!="all")
							{
								datastring2 = 'value=menuselection&category=' + catid +'&menuid=' + menuid +'&subcategory=' + subcatid;
							}else
							{
								 datastring2 = 'value=menuselection&category=' + catid +'&menuid=' + menuid;
							}
                                                        
							 $.ajax({
								type: "POST",
								url: "load_counter_sales.php",
								data: datastring2,
								success: function(data) {
										
										var bchid=$('#bchid').val();
										
											$('.counter_menu_popup_overlay').css("display","block"); 
		 			 $('.counter_menu_popup').css("display","block"); 
					 var request = $.ajax({
						  url: "counter_popup.php",
						  method: "POST",
						  data: {menu:menuid,typesub:'Add' },
						  dataType: "html"
						});
				   
						request.done(function( msg ) {
						  $( ".counter_menu_popup" ).html( msg );
						
						 });
						
						data = null;
						  msg=null;
						request.onreadystatechange = null;
						request.abort = null;
						request = null;
										
										
									}
								});
						 
						 
						 
						}
					  });
					
				}
					
				}
	  		});
		}

</script>
 <script type="text/javascript">
 
 function cpyaddress()
 {
	 var praddress = $("#ta_address").val();
	 $("#ta_orderaddress").val(praddress);
 }
 
 </script>   

<script>

$("#permnt_add").click(function(){
    
        $(".permnt_add").css("display","block");
	$(".order_add").css("display","none");
	$("#permnt_add").addClass("act_clr");
	$("#order_add").removeClass("act_clr");
	
});


$("#order_add").click(function(){
    
         $(".order_add").css("display","block");
	 $(".permnt_add").css("display","none");
	 $("#permnt_add").removeClass("act_clr");
	 $("#order_add").addClass("act_clr");
});


</script>



<script type="text/javascript">

		$(".credit_cc").hide();
		$(".coupon_cc").hide();
		$(".voucher_cc").hide();
		$(".cheque_cc").hide();
		  
		
  $("#cash").click(function(){
                  
                   $("#paidamount").val($('#grandtotal').text());
                   $("#balanceamout").val("0");
                   $("#paidamount").select();
                    
                      $('.discount_after_cc').hide();
                      $('#loyaltydiv').hide();
                      // $('#paidamount').val("");
                      $("#coupamount").val("");
                      $("#coupbal").val("");
                      $("#coupname").val("");
                      // $("#balanceamout").val("");
           
                       $('#countersel').attr("disabled", false);  
                       $('#currencyinput').attr("disabled", false);
                          
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		        $(this).addClass('mode_sel_btn_act');
			$(".cash_cc").show(1500);
                        $(".upi_cc").hide(500);
                        $(".credit_cc").hide(500);
		        $(".credit_cc_normal").hide(500);
                        $(".coupon_cc").hide(500);
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        // $("#paidamount").val("");
                                        // $("#balanceamout").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                                        $("#currencyinput").val("");
                                        var on=$('#curshowfocus').val();
                                       
                                      if(on=="Y"){
                                          $("#currencyinput").focus();
                                          $('#focusedtext').val('currencyinput');
                                      }else{
                                           $("#paidamount").focus();
                                           $('#focusedtext').val('paidamount');
                                      }
 });
       
   $(".pop_payment_mode_sel_btn").click(function(){ 
       
       if( $(this).attr('id')=='credit'){
           
           $("#paidamount").css('width','140px'); 
           $("#balanceamout").css('width','230px'); 
           
            $("#transbal").css('width','230px'); 
          
           $("#paidamount").css('margin-left','-7px');       
           $(".paid_cls").css('font-size','13px');       
          
           $("#balanceamout").css('margin-left','285px'); 
           $("#balanceamout").css('margin-top','-38px'); 
          
           $(".bal_cls").css('font-size','13px');   
           
           $(".bal_cls").css('margin-top','-38px');   
            
           $(".bal_cls").css('margin-left','200px'); 
           
           $(".bal_cls_div").css('display','none'); 
           
         
     }else{
          
           $("#paidamount").css('width','138px'); 
           $("#balanceamout").css('width','138px');
           $("#paidamount").css('margin-left','0px');       
           $("#paidamount").css('font-size','15px');    
           
            $("#balanceamout").css('margin-left','0px'); 
            $("#balanceamout").css('margin-top','0px'); 
           
            $(".bal_cls").css('font-size','15px'); 
            $(".paid_cls").css('font-size','15px');       
            
            $(".bal_cls").css('margin-top','0px');   
            
            $(".bal_cls").css('margin-left','0px'); 
            
          $(".bal_cls_div").css('display','block'); 
      }
       
       
   });    
       
       
       
                
 $("#credit").click(function(){ 
     
      var gtt22=$('#grandtotal').html();
      $('#multi_cardamount').val(gtt22);
      
       $('.plusbtn').hide();  
     
     
         $('.discount_after_cc').hide();
         $('#loyaltydiv').hide();
         $('.refdiv_card').html('');
         
         var multibillnew16=$('#settleingbilno').html();  
        
         var datastring = "billnoview="+multibillnew16;

                 $.ajax({
                 type: "POST",
                 url: "counter_sales.php",
                 data: datastring,
                 success: function (data)
                 {
                      
                      
                     var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var c=JSON.parse(arr[2]);
                     var decimal=$('#decimal').val();
                    
                  if(a!=''){
                      
                      $('.plusbtn').show();  
            
        
                
                     $("#multibanktype").val($("#multibanktype option:first").val());  
                     // $("#multibanktype").val('');
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                
                 
                     $.each(a, function(i, record) {
                         
                         var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
                         
                          if($.trim(record.mc_carnumber)==''){
                                 var cardnum='';
                                 
                            }else{
                                
                                 var cardnum=record.mc_carnumber;
                            }
            
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
                  
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:25%;margin-right:1%;display:none'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 30%;display:none'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly()' onclick='return pincard()' onchange='return pincard()' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:40%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return isNumberKey()' onkeyup='return cardsum()' onclick='return cardsum()' onchange='return cardsum()' autocomplete='off'>"+
              " </div>"+
              
             " <div class='card_detail_popup_type' style='width:43%;margin-right:1%'>"+
              "<select class='card_type_dropdwn bankselect_new' id='multibanktype"+record.mc_slno+"' onclick=''> <option value='' > Bank</option>"+
              c+ "</select>"+
              "</div>"+  
              
              
              "<div style='width: 12%;height: 34px;margin-top: -1px;float: left;margin-left: 4px;' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' style='margin-top: -7px;' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
                    );
                                
                   }
                         $("#multibanktype"+record.mc_slno).val(record.mc_to_bank);
                         $("#multibanktype"+record.mc_slno).prop('disabled',true);
                         
                         $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                         $("#multicardtype"+record.mc_slno).prop('disabled',true);
                         
                         $("#card_1"+record.mc_slno).prop('disabled',true);
                         $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
                         
           var gtt=$('#grandtotal').html();
           var tran=$('#transcationid').val();
           var camount = $('#multi_cardamount').val();
           var  tot=parseFloat(camount)+parseFloat(tran);
           
           if(tot==gtt){
               
              $('#balanceamout').val('0');
              $('#paidamount').val('0');
              
               
           }
          
           });
                      
           }else{ 
                 
                   var gtt22=$('#grandtotal').html();
                   $('#multi_cardamount').val(gtt22);
                   $('#transcationid').val(gtt22);
                   $('#transbal').val('0');
                   $('#multi_cardamount').focus();
                   $('#paidamount').val(0);
                   $('#balanceamout').val('0');
          }  
                
       
                
     } 
                    
    });
                 
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
        $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
          $(".trrefresh").load(location.href + " .trrefresh");
         
        }
        });
                 
                        $('#countersel').attr("disabled", false);  
                        $('#currencyinput').attr("disabled", false);
			$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		        $(this).addClass('mode_sel_btn_act');
			$(".cash_cc").hide(500);
                        $(".upi_cc").hide(500);
			$(".credit_cc_normal").show(1500);
                        $(".credit_cc").hide(500);
                        $(".coupon_cc").hide(500);
                        
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
				        $(".complimentrary_cc").hide(500);
			     	        $(".credit_type").hide(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
                                        $("#paidamount").val(0);
                                        $("#balanceamout").val(0);
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                                        $("#currencyinput").val("");
                                        var on=$('#curshowfocus').val();
                                      
                                       $('#multi_cardamount').focus();          
                                       $('#focusedtext').val('multi_cardamount');
                                       
                                       
                                       
                                       
                                       
  });
                
                
$("#coupon").click(function(){

                    $('.discount_after_cc').hide();
                    $('#loyaltydiv').hide();
                    $('#paidamount').val("");
                    $("#coupamount").val("");
                    $("#coupbal").val("");
                    $("#coupname").val("");
                    $("#balanceamout").val("");
                    $('#countersel').attr("disabled", false);  
                    $('#currencyinput').attr("disabled", false);
	            $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		    $(this).addClass('mode_sel_btn_act');
		    $(".cash_cc").hide(500);
                    $(".upi_cc").hide(500);
                    $(".credit_cc").hide(500);
		    $(".credit_cc_normal").hide(500);
                    $(".coupon_cc").show(500);
		    $(".voucher_cc").hide(500);
		    $(".cheque_cc").hide(500);
		    $(".complimentrary_management").hide(500);
		    $(".complimentrary_cc").hide(500);
		    $(".credit_type").hide(500);
	            $('.paid_amount_cc').show(500);
		    $('.paid_amount_cc_credit').hide(500);
		    $('#ta_staffsubmit').show();
		    $('#ta_staffclose').hide();
		    $("#coupname").focus();
  });
  
  
  
  $("#voucher").click(function(){
      
                    $('.discount_after_cc').hide();
                    $('#loyaltydiv').hide();
                    $('#countersel').attr("disabled", false);  
                    $('#currencyinput').attr("disabled", false);
		    $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		    $(this).addClass('mode_sel_btn_act');
		    $(".cash_cc").hide(500);
                    $(".upi_cc").hide(500);
                    $(".credit_cc").hide(500);
		    $(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
                    
		    $(".complimentrary_management").hide(500);
		    $(".complimentrary_cc").hide(500);
		    $(".credit_type").hide(500);
		    $(".voucher_cc").show(500);
		    $(".cheque_cc").hide(500);
		    $('.paid_amount_cc').show(500);
		    $('.paid_amount_cc_credit').hide(500);
		    $('#ta_staffsubmit').show();
		    $('#ta_staffclose').hide();
                    
});
                
                
 $("#cheque").click(function(){
     
                     $('.discount_after_cc').hide();
                     $('#loyaltydiv').hide();
                     $('#countersel').attr("disabled", false);  
                     $('#currencyinput').attr("disabled", false);
                     $('#cheqamount').focus();
		     $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		     $(this).addClass('mode_sel_btn_act');
		     $(".cash_cc").hide(500);
                     $(".upi_cc").hide(500);
                     $(".credit_cc").hide(500);
		     $(".credit_cc_normal").hide(500);
                     $(".coupon_cc").hide(500);
		     $(".voucher_cc").hide(500);
		     $(".complimentrary_management").hide(500);
		     $(".complimentrary_cc").hide(500);
		     $(".credit_type").hide(500);
                     
					$(".cheque_cc").show(500);
					$('.paid_amount_cc').show(500);
					$('.paid_amount_cc_credit').hide(500);
					$('#ta_staffsubmit').show();
					$('#ta_staffclose').hide();
                                        $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                                        $("#currencyinput").val("");
                                        var on=$('#curshowfocus').val();
                                        if(on=="Y"){
                                           $("#cheqamount").focus();
                                           $('#focusedtext').val('cheqamount');
                                        }else{
                                            $("#cheqamount").focus();
                                            $('#focusedtext').val('cheqamount');
                                        }
                                        
  });
  
                
 $("#credit_person").click(function(){
                    
        $('.discount_after_cc').hide();
         
        var default_company=$('#default_company').val();
         
        if(default_company=='Y'){
             
            $('#selectcreditypes').val('4');
            $("#selectcreditypes").trigger("change");
            $('.payment_auth_pop').hide();
            $('.head_change').text('');
            $('.confrmation_overlay_auth').css('display','none');
            
       }else{
         
            $('.payment_auth_pop').show();
            $('.head_change').text('Credit Authorization');
            $('.confrmation_overlay_auth').css('display','block');
       }
        
        
                   /////////company ends/////////   
                    
                    
                    $('#pin_pay').focus();
                    $('#pin_pay').val('');
                    $('#loyaltydiv').hide();
                    $('#countersel').attr("disabled", false);  
                    $('#currencyinput').attr("disabled", false);
		    $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		    $(this).addClass('mode_sel_btn_act');
		    $(".cash_cc").hide(500);
                    $(".upi_cc").hide(500);
                    $(".credit_cc").hide(500);
		    $(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
                    
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").hide(500);
					$(".credit_type").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').show(500);
	        		        $('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                        $("#paidamount").val("");
                                        $("#balanceamout").val("");
                                        $("#transcationid").val("");
                                        $("#transbal").val("");
                                        $("#cheqamount").val("");
                                        $("#cheqbal").val("");
                                        $("#currencyinput").val("");
                                        $("#completext").val("");
                                              
                                        $("#paidamount_credit").val("");
                                        $("#balanceamout_credit").val("");
                                        $("#amount_credit").val("");
                                        //$("#selectcreditypes").val("");
                                        $("#selectcreditdetails").val("");
                                                
                                      var on=$('#curshowfocus').val();
                                      
                                     if(on=="Y"){
                                       
                                           $("#paidamount_credit").val('0');
                                           $('#focusedtext').val('currencyinput1');
                                           $('#cs_currency_credit').show();
                                           //$("#currencyinput1").focus();
                                           $('#paidamount_credit').prop('disabled',true);
                                           
                                      }else{
                                          
                                           $("#paidamount_credit").val('0');
                                           // $("#paidamount_credit").focus();
                                           $('#focusedtext').val('paidamount_credit');
                                           $('#cs_currency_credit').hide();
                                           $('#paidamount_credit').prop('disabled',false);
                                      }
  });
              
              
  $("#complimentary").click(function(){
      
                    $('.discount_after_cc').hide();
                    $('.payment_auth_pop').show();
                    $('.confrmation_overlay_auth').show();
                    $('.head_change').text('Complimentary Authorization');
                    
                    $('#pin_pay').focus();
                    $('#pin_pay').val('');
                    $('#loyaltydiv').hide();
                    
                $('#countersel').attr("disabled", false);  
                $('#currencyinput').attr("disabled", false);
		$(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		$(this).addClass('mode_sel_btn_act');
		$(".cash_cc").hide(500);
                $(".cash_cc").hide(500);
                $(".upi_cc").hide(500);
                $(".credit_cc").hide(500);
		$(".credit_cc_normal").hide(500);
                $(".coupon_cc").hide(500);
                
					$(".voucher_cc").hide(500);
					$(".cheque_cc").hide(500);
					$(".credit_type").hide(500);
					$(".complimentrary_management").hide(500);
					$(".complimentrary_cc").show(500);
					$('.paid_amount_cc').hide(500);
					$('.paid_amount_cc_credit').hide(500);
	        		        $('#ta_staffsubmit').hide();
					$('#ta_staffclose').show();
                                        
                                         $("#paidamount").val("");
                                         $("#balanceamout").val("");
                                         $("#transcationid").val("");
                                         $("#transbal").val("");
                                         $("#cheqamount").val("");
                                         $("#cheqbal").val("");
                                         $("#currencyinput").val("");
                                         $("#completext").val("");
                                         // $("#completext").focus();
                                         //  $('#focusedtext').val('completext');
                                        
  });
  
		
  $("#upi").click(function(){
      
                    $('.discount_after_cc').hide();
                    $('#loyaltydiv').hide();
                    $('#currencychg').attr("disabled", false);  
                    $('#curpaid').attr("disabled", false);
                    $("#amount_credit1").val("");
                    $("#paidamount_credit").val("");
                    $("#completext").val("");
                    $('#paidamount').val("");
                    $("#coupamount").val("");
                    $("#coupbal").val("");
                    $("#coupname").val("");
                    $('#curpaid').val("");
                    $("#balanceamout").val("");
                       
                    $('#upistatus').val('');
                    $('#upiamount').val('');
                    $('#upibalanceamount').val('');
                    $('#upitransactionid').val('');  
                           
                    $(".pop_payment_mode_sel_btn").removeClass('mode_sel_btn_act');
		    $(this).addClass('mode_sel_btn_act');
		    $(".cash_cc").hide(500);
                    $(".credit_cc").hide(500);
		    $(".credit_cc_normal").hide(500);
                    $(".coupon_cc").hide(500);
                    $(".upi_cc").show(500);
                    //$(".upi_cc").hide(500);
				$(".voucher_cc").hide(500);
				$(".cheque_cc").hide(500);
				$(".complimentrary_management").hide(500);
				$(".complimentrary_cc").hide(500);
				$(".credit_type").hide(500);
				$('.paid_amount_cc').hide(500);
                                $('.upibalanceamount').hide(500);
                                $('#upibalanceamount').hide(500);
				$('.paid_amount_cc_credit').hide(500);
				$('#ta_staffsubmit').show();
				$('#ta_staffclose').hide();
   });
                
                
        
                
               
                
                
  $("#txnstatuscheck").click(function(){
                    
                    var billno = $('#settleingbilno').text(); 
                    var grand=parseFloat($('#grandtotal').text());
                   
                  
                    var transaction_id=$('#upitxnid').val();
                    var data_upipayment_satus="set=upipayment_status&billno="+billno;
                  
                     $.ajax({
                      type: "POST",
                      url: "load_payments_ta_cs.php",
                      data: data_upipayment_satus,
                      success: function(data)
                        {
                          
                            var rs=JSON.parse(data);
                             $('#upistatus').val(rs.TXN_STATUS);
                             
                            if(rs.TXN_STATUS=='success'){
                            $('#upiamount').val(rs.TXN_AMOUNT);
                            $('#upitransactionid').val(rs.TXN_ID);


                        var upi=rs.TXN_AMOUNT;
                        
                       if($('#pole_on').val()=='Y'){  
                        
                        var data_pole = 'set_pole_paid=pole_display_paid&paid='+upi+"&mode=upi";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
                      }


       }else{
             
           $('#upiamount').val('');
           $('#upitransactionid').val('');

       }
       }
        
     });
                    
  });
	
        
      
	$('body').click( function(e){
            
            if(!$('#cspax').is(':focus')){
               
               $('.key_2').removeClass('show_1');
           }
           if(!$('#table_cs').is(':focus')){
                $('.key_1').removeClass('show_1');
            }
             
          
        });    
	
   $(".key_1_btn").click(function(e){
		
		$(".key_1").toggleClass('show_1');
                $(".key_2").removeClass('show_1');
                 e.stopPropagation(); 
              
   });
           
            
  $(".key_2_btn").click(function(e){
                e.stopPropagation(); 
		$(".key_2").toggleClass('show_1');
                $(".key_1").removeClass('show_1');
               
		
  });
  
                    
  $('.cs_table').click(function(){
      
                  $('#table_cs').focus();
                  var keyval= $(this).text();
                    
                  var tableno=$('#table_cs').val();
                   
                  if($.isNumeric(keyval)){
                        if(tableno==''){
                            $('#table_cs').val(keyval);
                        }
                        else{
                            $('#table_cs').val(tableno+keyval);
                        }
                    }
                else if(keyval=='Clear'){
                    $('#table_cs').val('');
                }
                else if(keyval==''){
                    $('#table_cs').val($('#table_cs').val().substring(0,$('#table_cs').val().length - 1));
                    $('#table_cs').focus();
                }
                    
                });
		$('.cs_pax').click(function(e){
                 e.stopPropagation(); 
                   var keyval1= $(this).text();
                    var pax=$('#cspax').val();
                    if($.isNumeric(keyval1)){
                    
                       if(pax==''){
                            $('#cspax').val(keyval1);
                        }
                        else{
                            $('#cspax').val(pax+keyval1);
                        }
                    
                }
                else if(keyval1=='Clear'){
                    $('#cspax').val('');
                }
                else{
                    $('#cspax').val($('#cspax').val().substring(0,$('#cspax').val().length - 1));
                    $('#cspax').focus();
                }
   });
		
	/***************************************  credit types ends **********************************************************  */
       </script> 

 <script>
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
	
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
	
    t = setTimeout(function () {
        startTime()
    }, 500);
}
startTime();
</script>

  <script>

 $(document).ready(function(){
 
     document.getElementById('search').setAttribute('autocomplete', 'off');
     
     document.getElementById('codesrch_c').setAttribute('autocomplete', 'off');
    
     document.getElementById('search_barcode').setAttribute('autocomplete', 'off');
  

$('.manage').click( function() { 
    
	$('.mynewpopupload1').css("display","block"); 
	$(".olddiv1").addClass("new_overlay");
	var menuid=$('#hiddenmenuid').val();
	$.post("popup/stock.php", {menu:menuid},
	function(data)
	{
	data=$.trim(data);
	$('.mynewpopupload1').html(data);
	});  
	});
        
        
        
 $(document).on('keypress',function(e) {
    if(e.which == 13) {
       
      if($('.logout_main_popup_for_all').is(':visible')){
       pop_logout_yes();
            
     }
        
     }
});



	
});

</script>


<script type="text/javascript" >
$(document).ready(function()
{
    
                        var datah1 = "set=load_hold_new_count";
			$.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: datah1,
			success: function(data551) {
                            
			$('.load_hold_new_count').html($.trim(data551));
                        
			}
	               });
    
$("#notificationLink").click(function()
{
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");



 var datah = "set=load_hold_new";
			$.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: datah,
			success: function(data55) {
                            
			$('#load_hold_new').html(data55);
                        
           }
	});
//                        var datah1 = "set=load_hold_new_count";
//			$.ajax({
//			type: "POST",
//			url: "load_counter_sales.php",
//			data: datah1,
//			success: function(data551) {
//                            
//			$('.load_hold_new_count').html($.trim(data551));
//                        
//			}
//	               });
                        



return false;
});



});
</script>
<script>


  $(".discount_apply_after" ).click(function() {
           
             var ds_val= $("#dis_after_manual").val();
             var ds_drop= $("#dis_after_drop").val();
             
             
           var ds_type='';  
           var discount='';
           var type='';
            
            if(ds_drop!=''){
                ds_type='';  
                discount=$("#dis_after_drop").val();
                type="drop";
            }else{
            
              ds_type= $("#dis_after_type").val();
              discount=$("#dis_after_manual").val();
              type="text";
           }
             
             
        if(ds_val!=''  || ds_drop!=''){

        var billno=$('#settleingbilno').text();
        var dataString_log ='set=proceed_after_dis&billno='+billno+"&discount="+discount+"&type="+type+"&disctype="+ds_type;
        
                                $.ajax({
                                    type: "POST",
                                    url: "load_counter_sales.php",
                                    data: dataString_log,
                                    success: function(data) {
                                 
                                      window.location.href="counter_sales.php?setcscommon=settlecspopup";  
                                      
                                    }
                                });
        
        
        
    }
    else{
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text("ENTER DISCOUNT");
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');   
     }
           
           
           
  });



$('.calculator_icon_pop').click(function() {
   $('.counter_settle_popup_right_calc_cc').toggle();
  
});


$( "#dis_after_manual" ).keyup(function() {
      var ds1= $("#dis_after_manual").val();
      
      var st=$('#final').text();
      var subt=st.replace(',','');
      
     
    if(ds1!=''){
        $('#dis_after_drop').val(""); 
        $('#dis_after_drop').attr("disabled",true);
        
        if($("#dis_after_type").val()=='P' && parseFloat($("#dis_after_manual").val())>=100){
            $( "#dis_after_manual" ).val("");
            
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text("Discount should be less than 100%");
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');
        }
        else if($("#dis_after_type").val()=='V' && parseFloat($("#dis_after_manual").val())>=parseFloat(subt)){
            $( "#dis_after_manual" ).val("");
            $('.payment_pend_right_cash_error ').css('display','block');
            $('.payment_pend_right_cash_error ').text('Discount should be less than Subtotal');
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');
        }
 }else{
      $('#dis_after_drop').removeAttr('disabled');
      
 }
 
  });



function dischange_after(){
     
     var ds=$('#dis_after_drop').val();
     
     if(ds!=''){
          $("#dis_after_manual").val('');
          $("#dis_after_manual").attr('disabled',true);
          $("#dis_after_type").attr("disabled",true);
      }else
      {
           
        $("#dis_after_manual").attr('disabled',false); 
        $("#dis_after_type").removeAttr('disabled');
      }
    }
    
    
function currencyinput(){
    $('#focusedtext').val('currencyinput');
    $('#paidamount').prop('disabled',true);
    var tran=$('#transcationid').val();
    var chq=$('#cheqname').val();
    var tranbl=$('#transbal').val(); 
    var chbl=$('#cheqbal').val(); 
    var curvalue=$('#currencyinput').val();
    var convo=$('#convoratenew').val();
    var actual=curvalue*convo;
    var grt=$('#grandtotal').html();
    var pd=$('#paidamount').val();
    $('#paidamount').val(actual.toFixed(3));
    var pd=$('#paidamount').val();
  
    var tot=parseFloat(actual)-parseFloat(grt);
   
    
    if(parseFloat(actual)> parseFloat(grt)){
    $('#balanceamout').val(tot.toFixed(3));
  
    }
    if(parseFloat(pd)< parseFloat(grt)){
    $('#balanceamout').val('');
  
    }
      if(tran=="" || tran==0){
   if(parseFloat(actual)==parseFloat(grt)){
       
    $('#balanceamout').val(tot.toFixed(3));
  
    }  
    }  
     
    if(actual==""){
        $('#balanceamout').val("");  
         $('#paidamount').val("");
     }
    
  if(tran!="" && chbl=="" && tran!=0){
      var bm=actual-tranbl;
    
        $('#balanceamout').val(bm.toFixed(3));  
  }
  
  if(chbl!=""){
        var chbl23=$('#cheqbal').val(); 
       var pd23=$('#paidamount').val();
     $('#balanceamout').val('');  
     
      var tr1 =pd23-chbl23;
     
        $('#balanceamout').val(tr1.toFixed(3));  
   
  }
  
if(event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
                {
                 
                 
                                 $('.submittranscations').click();
                }

}


function currencyinput1(){
    
    $('#focusedtext').val('currencyinput1');
    $('#paidamount').prop('disabled',true);
    var decimal=$('#decimal').val();
    var curvalue=$('#currencyinput1').val();
    var convo=$('#convoratenew').val();
    var actual=curvalue*convo;
    var grt=$('#grandtotal').html();
    var pd=$('#paidamount_credit').val();
    $('#paidamount_credit').val(actual.toFixed(decimal));
 
    var tot=parseFloat(grt)-parseFloat(actual);
   
    if(parseFloat(actual)> parseFloat(grt)){
    $('#balanceamout_credit').val(grt.toFixed(decimal));
    $('#currencyinput1').val('');
    $('#paidamount_credit').val('0');
    $('#amount_credit').val(grt.toFixed(decimal));
   
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("Check Amount");
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
    }
    if(parseFloat(actual)< parseFloat(grt)){
  $('#balanceamout_credit').val(tot.toFixed(decimal));
     $('#amount_credit').val(tot.toFixed(decimal));
  
    }
      
    if(actual==""){
       
           $('#amount_credit').val(grt.toFixed(decimal));
           $('#paidamount_credit').val("0");
           $('#balanceamout_credit').val(grt.toFixed(decimal));  
     }
    
if(event.keyCode == 13)//////alt+Enter(popup submit regeratebill)///////
                {
                 
                   $('.submittranscations').click();
                }

}


function hiddenselect(){
    
   $('#hidoption').hide();
 }
 
 function hiddenselect1(){
    
   $('#hidoption1').hide();
 }


function countchange1(){
  
   var sg34=$('#countersel').val();
   var sg134=sg34.split("_");
   $('#cursignall').html(sg134[1]);
   $('#cursign2all').html(sg134[0]);
   var tt=sg134[0];
  
  
  var datastringnew="set5=cat5&idofcur5="+tt;
       
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew,
        success: function(data)
        {
        
        }
        
    });
   
 $("#divall").load(location.href + " #divall");
 
}


function countchange11(){
  
    var sg34=$('#countersel1').val();
    var sg134=sg34.split("_");
    $('#cursignall1').html(sg134[1]);
    $('#cursign2all1').html(sg134[0]);
    var tt=sg134[0];
  
  var datastringnew="set5=cat5&idofcur5="+tt;
       
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnew,
        success: function(data)
        {
        
        }
        
    });
   
  //$("#countersel").load(location.href + " #countersel");
  //$("#divall").load(location.href + " #divall");

}



function chqname(){
    $('#focusedtext').val('cheqname');
}

function cheqbank(){
    $('#focusedtext').val('cheqbank');
}

$("#disountamount_drop").change(function(){
           
            var mode =  $('option:selected', this).attr('mode_ds');
             
             var mode_value=parseFloat($('option:selected', this).attr('val_ds')); 
            
             
             if(mode=='V' ){ 
                 
              
              
              $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "black";
                $('#load_discount_data').text(' Value : '+mode_value);
                
              
             }
             
             if(mode=='P'){ 
               
                  $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "black";
                $('#load_discount_data').text(' % : '+mode_value);
             }
             
             
            if(mode==undefined || mode=='undefined' ){ 
                $('#load_discount_data').show();
                 $('#load_discount_data').text('');
             }
             
             
        });


 $("#disountamount_drop").change(function(){
           
            var mode =  $('option:selected', this).attr('mode_ds');
             
             var mode_value=parseFloat($('option:selected', this).attr('val_ds')); 
             var sub_ds=parseFloat($('#subtotal_d1').text());
             
             if(mode=='V' && mode_value>=sub_ds){ 
              
                  $('#disountamount_drop').val('none');
                
                 $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "red";
                 $('#load_discount_data').text('Discount Value Cant be greater than Subtotal');
                
                 $('#load_discount_data').delay(500).fadeOut('slow');
             }
             
             if(mode=='P' && mode_value>99){ 
               
                 $('#disountamount_drop').val('none');
                
                 $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "red";
                 $('#load_discount_data').text('Discount % Cant be greater than Subtotal');
                
                 $('#load_discount_data').delay(500).fadeOut('slow');
             }
             
             
  });
        
        
        
        


 function dischange(){
 
     var ds=$('#disountamount_drop').val();
     if(ds!='none'){
          $("#disountamount").prop("readonly", true);
      }else
      {
        $("#disountamount").prop("readonly", false);   
      }
 }
          
   
  $( "#disountamount" ).keyup(function() {
     
      var ds1= $("#disountamount").val();
      if(ds1[0]==0){
       $("#disountamount").val('');
           
      }
  
    if(ds1!='' && ds1[0]!=0){
      
     $('#disountamount_drop').attr("disabled","disabled"); 
     }else{
      $('#disountamount_drop').removeAttr('disabled');
         
    }
  });


function isNumberKey(evt)
       { 
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
          
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
  
  
    
    
    
  function enter_plus(evt)
  {
    
    if(evt.keyCode == 13 ) {
         
      $(".plusbtn").click();     
       
     }
    return true;
 }
  
  
  

 $(".plusbtn").click(function()
 {
      var decimal=$('#decimal').val();
      $('.plusbtn').addClass('disablegenerate'); 
    
          setTimeout(function(){
           
          $('.plusbtn').removeClass('disablegenerate'); 
          
        }, 2500);
            
            $(".plusbtn").css('pointer-events','none');
            
            var gtt=$('#grandtotal').html().replace(',','');
            var tran=$('#transcationid').val().replace(',','');
            var camount = $('#multi_cardamount').val();
            
            var  tot=(parseFloat(camount) + parseFloat(tran)).toFixed(decimal);;
            
            if(tot==gtt){
                
              $('#balanceamout').val('0');
              $('#paidamount').val('0');
            
            }
            
            
          
            if(camount!="" && tot<=gtt  ){ 
                
             var ctype   = $("#multicardtype").val();
             var camount = $('#multi_cardamount').val();
             var cnumber = $("#card_1").val();
             var billno  = $('#settleingbilno').html(); 
                
             var btype =  $("#multibanktype").val();   
                
             var bankdefault =  $("#bankdetails").val();   
                
             var datastring = "ctype="+ctype+"&camount="+camount+"&cnumber="+cnumber+"&billno="+billno+"&btype="+btype+"&bankdefault="+bankdefault;
            
                 $.ajax({
                 type: "POST",
                 url: "counter_sales.php",
                 data: datastring,
                 success: function (data)
                 {  
                     var arr = data.split("+");
                     var a=JSON.parse(arr[0]);
                     var b=JSON.parse(arr[1]);
                     var c=JSON.parse(arr[2]);
                     
                    
                       
                     $("#multibanktype").val($("#multibanktype option:first").val());  
                       
                     // $("#multibanktype").val('');
                     $("#multicardtype").val('');
                     $("#multi_cardamount").val('');
                     $("#card_1").val('');
                 
                     $.each(a, function(i, record) {
                     
                      if($.trim(record.mc_carnumber)==''){
                          
                             var cardnum='';
                             
                       }else{
                             var cardnum=record.mc_carnumber;
                      }
                     
              var amount=parseFloat(record.mc_cardamount).toFixed(decimal);
              
              if($('.cardadder').find('#del_card' + record.mc_slno).length === 0) {
                  
              $(".cardadder").append("<div class='card_detail_popup_list refdiv_card' id='card_detail_popup_list"+record.mc_slno+"'  style='margin-bottom:3px'> <div class='card_detail_popup_type' style='width:25%;margin-right:1%;display:none'>"+
              "<select class='card_type_dropdwn cardselect' id='multicardtype"+record.mc_slno+"' onclick='return selectdefault();'> <option value='' > Card</option>"+
              b+ "</select>"+
              "</div>"+  
              "  <div class='card_detail_popup_type' style='width: 30%;display:none'>"+
              "<input class='card_popup_digits cardno' type='text' id='card_1"+record.mc_slno+"' value='" + cardnum + "' name='card_1"+record.mc_slno+"'  onkeypress='return numonly("+record.mc_slno+")' onclick='return pincard("+record.mc_slno+")' onchange='return pincard("+record.mc_slno+")' maxlength='4' autocomplete='off'>"+
              "</div>"+
              "<div class='card_detail_popup_type' style='width:40%;margin-left:1%'>"+
              "<input type='text' class='card_type_dropdwn amountall' id='multi_cardamount"+record.mc_slno+"' value='" + amount + "' name='multi_cardamount"+record.mc_slno+"' onkeypress='return numonly()' onkeyup='return cardsum("+record.mc_slno+")' onclick='return cardsum("+record.mc_slno+")' onchange='return cardsum("+record.mc_slno+")' autocomplete='off'>"+
              " </div>"+
              
              "<div class='card_detail_popup_type' style='width:43%;margin-right:1%'>"+
               "<select class='card_type_dropdwn bankselect_new' id='multibanktype"+record.mc_slno+"' onclick=''> <option value='' >Bank</option>"+
              c+ "</select>"+
               " </div>"+
              
              "<div style='width: 12%;height: 34px;margin-top: -1px;float: left;margin-left: 4px;' id='del_card"+record.mc_slno+"' name='del_card"+record.mc_slno+"' class='menut_add_bq_btn' onclick='return deletecard("+record.mc_slno+");'><img width='23px' style='margin-top: -7px;' src='img/cancel-icon.png'></div>"+
              "</div>"        
              
            );
                                 
            }
                         
                         $("#multibanktype"+record.mc_slno).val(record.mc_to_bank);
                         $("#multibanktype"+record.mc_slno).prop('disabled',true);
                         
                         $("#multicardtype"+record.mc_slno).val(record.mc_cardtype);
                         $("#multicardtype"+record.mc_slno).prop('disabled',true);
                         $("#card_1"+record.mc_slno).prop('disabled',true);
                         $("#multi_cardamount"+record.mc_slno).prop('disabled',true);
                         
                        
              });
                     
                      $(".plusbtn").css('pointer-events','inherit');
                      
                 }
   });
                 
                 
                
           var bill_settle_auth=$('#bill_settle_auth').val();
           
           if(bill_settle_auth !='Y'){ 
           
            setTimeout(function(){
         
               $('.submittranscations').click();
        
            }, 1000); 
             
             
           } 
                 
                 
        var multibillnew16=$('#settleingbilno').html();  
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
        $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnewmultinew16,
        success: function(data)
        {
            $(".trrefresh").load(location.href + " .trrefresh");
        }
       });
    
         var decimal=$('#decimal').val();
         
         var tr=parseFloat($('#transcationid').val());
         if(tr==0){
         tr=(0+ parseFloat(camount)).toFixed(decimal);
         }else{
         tr=(tr+ parseFloat(camount)).toFixed(decimal);
         }
         var tb=(parseFloat(gtt)-tr).toFixed(decimal);
         
         if($('#pole_on').val()=='Y'){
         
         var data_pole = 'set_pole_paid=pole_display_paid&paid='+tr+"&balance="+tb+"&mode=card";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
	}
	});      
        }
           
            $('#paidamount').val('0');
            $('#balanceamout').val('0');
            
                 }else{
                $(".payment_pend_right_cash_error").css("display","block");
		$(".payment_pend_right_cash_error").addClass("popup_validate");
		$(".payment_pend_right_cash_error").text("Check Amount");
		$('.payment_pend_right_cash_error').delay(2000).fadeOut('slow');
                $(".plusbtn").css('pointer-events','inherit');
                
                }
             
        });
        
        
        

    function pincard(r){

     $('#focusedtext').val('card_1');

    }

  function cardsum(r){
    
       $('#focusedtext').val('multi_cardamount');

       var card= parseFloat($('#multi_cardamount').val());
       var gtt= parseFloat($('#grandtotal').html());
        
        
         // alert(card); alert(gtt);
   
        if(card==gtt){
            
             $('#transbal').val('0.00');
             //$('#transcationid').val(parseFloat(card));
             $('#transcationid').val('0');
             $('.plusbtn').hide();  
             
        }else{
          
          $('.plusbtn').show();  
            
        }
         
         if(card> gtt){
            
            $('.payment_pend_right_cash_error ').css('display','block');
              $('.payment_pend_right_cash_error ').css('color','red');
            $('.payment_pend_right_cash_error ').text("TRANSACTION AMOUNT CANT BE GREATER THAN TOTAL");
            $('.payment_pend_right_cash_error ').delay(2000).fadeOut('slow');  
            $('#multi_cardamount').val('');
        }
         
         
         
         
         
  }
  
  
 function isNumberKey(evt)
       {  
          var charCode = (evt.which) ? evt.which : event.keyCode
         
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }

 function settlepopupcommonta(){
   
     window.location.href = "take_away_.php?settacommon=settletapopup";

   }

function deletecard(e){
    
    var check = confirm("Are you sure you want to Delete?");
	if(check==true)
	{
    var bil=$('#settleingbilno').html();

    $('#card_detail_popup_list'+e).hide();
     var datastringnewcard="setdel=delcar&bilcard="+bil+"&slnocard="+e;

 
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnewcard,
        success: function(data)
        {      
           var multibillnew16=$('#settleingbilno').html();  
        var datastringnewmultinew16="setmultinew16=multicardnew16&multibillnew16="+multibillnew16;
    
       $.ajax({
        type: "POST",
        url: "counter_sales.php",
        data: datastringnewmultinew16,
        success: function(data)
        {  
          
        $(".trrefresh").load(location.href + " .trrefresh");
          //$("#card_detail_popup_list"+e).load(location.href + " #card_detail_popup_list"+e);
        $('#card_detail_popup_list'+e).remove();
        $('#balanceamout').val('');
        $('#paidamount').val('');
              
            $("#credit").click();  
              
              
        }
    });
     
        }
        
    });
    
    var decimal=$('#decimal').val();
    var tr1=parseFloat($('#transcationid').val());
    var tr_row=parseFloat($('#multi_cardamount'+e).val());
    var tr_del=(tr1-tr_row).toFixed(decimal);
    var gtt=parseFloat($('#grandtotal').html());
    var tb_del =(gtt-tr_del).toFixed(decimal); 
    if(tr_del==0){
        tb_del=0;
        tr_del=0;
    }
    
    
    if($('#pole_on').val()=='Y'){  
        
    var data_pole = 'set_pole_paid=pole_display_paid&paid='+tr_del+"&balance="+tb_del+"&mode=card";
    $.ajax({
    type: "POST",
    url: "index.php",
    data: data_pole,
    success: function(data5) {
        
        }
	});
    
   }
     
     
     
  }
 
}


function name_search_click() {
     $("#suggession_name").hide();
}



function number_search(number) {
    
    $('#focusedtext').val('selectcreditdetailsnumber');
    
     var credit_type=$('#selectcreditypes').val();
 
   // $("#suggession_name").html('');
    
 
    
    if(number.length>1){
        
         $("#suggession_number").show();
      
      
        var data_number='';
        var data_name='';
        var data1="value=guestnumber_search&number="+number+"&name=&credit_type="+credit_type;;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data1,
        success: function(data)
        {  
            
        $("#suggession_number").html('');
            
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
         
        for(var i=0;i<data_number.length;i++)
                {
                   $("#suggession_number").append('<div id="'+data_name[i]+'"  onclick="return number_select(this.id,'+data_number[i]+')">'+data_number[i]+' - '+data_name[i]+'</div>') ;
                     
                }
        }
         
        });
       
    }else{
        
            $("#suggession_number").html('');
          //  $("#suggession_name").html('');
            $("#suggession_number").hide();
            $("#suggession_number").html('');
           // $('#selectcreditdetailsname').val('');
     }
}


function number_select(name,number){
    
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    $("#suggession_number").html('');
    
}

function name_search(name) {
    
    var credit_type=$('#selectcreditypes').val();
  
   // $("#suggession_number").html('');
    
    if(name.length>1){
        
        if($("#suggession_name").html()!=''){
          
           $('#selectcreditdetailsnumber').val('');
        }
       if(credit_type=='4'){
           
        var data_number='';
        var data_name='';
        var data1="value=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data1,
        success: function(data)
        {    $("#suggession_name").show();
            $("#suggession_name").html('');
           
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div id="'+data_name[j]+'"  onclick="return name_select(this.id,'+data_number[j]+')">'+data_name[j]+' - '+data_number[j]+'</div>') ;
                     
                }
        }
    });
    }
    
    else if(credit_type=='3'){
           
        var data_number='';
        var data_name='';
        var data11="value=guestnumber_search&number=&name="+name+"&credit_type="+credit_type;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data11,
        success: function(data)
        {   $("#suggession_name").show();
            $("#suggession_name").html('');
          
           var data12=JSON.parse(data);
           var data_name=data12.name;
        
        for(var j1=0;j1<data_name.length;j1++)
                {
                   $("#suggession_name").append('<div id="'+data_name[j1]+'"  onclick="return name_select1(this.id)">'+data_name[j1]+'</div>') ;
                     
                }
        }
        });
        
        }
         
        }else{
            
            // $("#suggession_number").html('');
             $("#suggession_name").hide();
             $("#suggession_name").html('');
             $("#suggession_number").hide();
           //  $('#selectcreditdetailsnumber').val('');
        }
       
 }

 function name_select(name,number){
     
    var credit_type=$('#selectcreditypes').val();
    if(credit_type=='4'){
    $('#selectcreditdetailsnumber').val(number);
    $('#selectcreditdetailsname').val(name);
    }
    else if(credit_type=='3'){
        $('#selectcreditdetailsname').val(name);
    }
    $("#suggession_name").html('');
   
    
}


function name_select1(name){
    
    $('#selectcreditdetailsname').val(name);
    $("#suggession_name").html('');
    
    }

////loyalty redeem add start////


function search_new_enter(e){
   
    if(e.keyCode == 13)
     {
        if(localStorage.enter_key=='yes'){
        submit_loy_cs();
         
        }
        localStorage.enter_key='yes';
    }
     
}
   
   
function search_name(e){
    
     $('#focusedtext').val('ly_name');
     var name=$('#ly_name').val();
 if (e.keyCode ==40) { 
      
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Tap On Name To Select");
	$('#loy_error').delay(2000).fadeOut('slow');

    }
     var data="set=searchname&name="+name;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        { 
             $('#name_load').show();
         
           $('#name_load').html(data);
           
        }
    });      
       
       if(name==''){
           
         var decimal=$('#decimal').val();
         var gtt=parseFloat($('#grand_org').val());
         $('#grandtotal').text(gtt.toFixed(decimal));
         $('#redeem_point_total').text(0)
         $('#redeem_amount_total').text(0);
         $('#total_before_redeem').text(0);
        
         $('#redeem_point').val('');
    }
}
function  name_click(n,i,num){

     var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        {
           
           var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
    $('#ly_id').val(i);
         
    $('#ly_name').val(n);
   
    $('#ly_number').val(num);
    $('#redeem_point').val(0)
    $('#id_load').hide();
    $('#name_load').hide();
    $('#number_load').hide();
     
    $("#ly_name").attr("name_id", i);
   
}

function search_number_settle(e){
    
     var number=$('#num_sms_new').val();
   
     var data="set=searchnumber&number="+number;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        {
            
        if(number.length>2){
             if($.trim(data)!=''){
           $('#number_load_settle').show();
         
           $('#number_load_settle').html(data);
       }
       }else{
            $('#number_load_settle').hide();
         
           $('#number_load_settle').html('');
        }
           
        }
    });      
       
       
}


function search_number(e){
     $('#focusedtext').val('ly_number');
     var number=$('#ly_number').val();
   
     if (e.keyCode ==40){ 
              
       $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Tap On Number To Select");
	$('#loy_error').delay(2000).fadeOut('slow');
    }
   
   
     var data="set=searchnumber&number="+number;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        {
           $('#number_load').show();
         
           $('#number_load').html(data);
           
        }
    });      
       
    if(number==''){
        
        var decimal=$('#decimal').val();
        var gtt=parseFloat($('#grand_org').val());
        $('#grandtotal').text(gtt.toFixed(decimal));
        $('#redeem_point_total').text(0)
        $('#redeem_amount_total').text(0);
        $('#total_before_redeem').text(0);
       
         $('#redeem_point').val('');
    }
}

function  number_click(n,i,num){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
      
    if($('#num_sms_new').val()!=''){  
    $('#name_sms_new').val(n);
   
    $('#num_sms_new').val(num);
    $('#number_load_settle').hide();
         
    $('#number_load_settle').html('');
    
   }else{
        
   $('#ly_name').val(n);
   
   $('#ly_number').val(num);
  }
   
   
    $('#redeem_point').val(0)
    $('#number_load').hide();
    $('#id_load').hide();
    $('#name_load').hide();
      
    $("#ly_name").attr("name_id", i);
    $('#ly_id').val(i);
}


function search_id(e){
  
    
    $('#focusedtext').val('ly_id');
    
    if (e.keyCode ==40) { 
      
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Tap On ID To Select");
	$('#loy_error').delay(2000).fadeOut('slow');

    }
    
     var id=$('#ly_id').val();
   
     var data="set=search_loyal_id&id_loyalty="+id;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(datau)
        {
            
           $('#id_load').show();
         
           $('#id_load').html(datau);
           
           
        }
    });      
       
       if(id==''){
           
        var decimal=$('#decimal').val();
        var gtt=parseFloat($('#grand_org').val());
        $('#grandtotal').text(gtt.toFixed(decimal));
        $('#redeem_point_total').text(0)
        $('#redeem_amount_total').text(0);
        $('#total_before_redeem').text(0);
       
         $('#redeem_point').val('');
    }
    
    
    
}

function  id_click(n,i,num){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_counter_sales.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
         
   $('#ly_name').val(n);
   $('#redeem_point').val(0);
   $('#ly_number').val(num);
    
    $('#ly_id').val(i);
    $('#id_load').hide();
    $('#number_load').hide();
    $('#name_load').hide();
    $("#ly_name").attr("name_id", i);
    
}


function redeem_point(){
  
    $('#focusedtext').val('redeem_point');
    var redeem_point=parseFloat($('#redeem_point').val());
     var redeem_point1=$('#redeem_point').val();
    var tot_point=parseFloat($('#ly_points').val());
    var loyalty_id=$('#ly_id').val();
    var number=$('#ly_number').val();
    var min_redeem=parseFloat($('#min_redeem').val());
    
   if(redeem_point1.length==0) {
     $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem').text(0);
   }
    
    if(redeem_point>tot_point){
        $('#redeem_point').val('0');
          $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem').text(0);
           
       $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Invalid Point Entry");
	$('#loy_error').delay(2000).fadeOut('slow');
    }else if(loyalty_id==""  || number==""){
         $('#redeem_point').val('');
           $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
           
        $('#total_before_redeem').text(0);
        
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Enter Loyalty Details ");
	$('#loy_error').delay(2000).fadeOut('slow');
        
    }
    
 }


$('#redeem_btn_click').click(function(){
    
     var decimal=$('#decimal').val();
     var min_redeem=parseFloat($('#min_redeem').val());
     var redeem_point=parseFloat($('#redeem_point').val());
     var loyalty_id=$('#ly_id').val();
     var number=$('#ly_number').val();
    
    var pt=parseFloat($('#point_rule').val());
    var amt=parseFloat($('#point_rule').attr('amt'));
    
    var gt=parseFloat($('.tal_viewtotal').text());
    
   var pt_values=parseFloat(redeem_point/pt);
   var tot_point_amount=parseFloat(pt_values*amt).toFixed(decimal);
   
  var rdp=$('#redeem_point_total').text();
  var rda=  $('#redeem_amount_total').text();

      if(loyalty_id==""  || number==""){
          $('#redeem_point').val('');
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
           
         var decimal=$('#decimal').val();
         
         
        $('#total_before_redeem').text(0);
           
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Enter Loyalty Details ");
	$('#loy_error').delay(2000).fadeOut('slow');
          $('#ly_id').focus();
       exit; 
    }else if(redeem_point<=min_redeem || redeem_point==""){
         $('#redeem_point').val(0);
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
          
           var decimal=$('#decimal').val();
           
        $('#total_before_redeem').text(0);
           
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Minimum Redeem Point should be greater than "+min_redeem);
	$('#loy_error').delay(3000).fadeOut('slow');
          $('#redeem_point').focus();
        exit;
    }else if(tot_point_amount>=gt){
          $('#redeem_point').val(0);
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
          var decimal=$('#decimal').val();
         
         
        $('#total_before_redeem').text(0);
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Redeem Amount should not be greater than final Total");
	$('#loy_error').delay(3000).fadeOut('slow');
          $('#redeem_point').focus();
        exit;
        }else{
        
        $("#loy_error").text("");
    }
  
  $('#point_show').show();
   $('#point_amount_show').show();
    $('#point_show_after').show();
  
  
  $('#redeem_point_total').text(redeem_point);
  $('#redeem_amount_total').text(tot_point_amount);
  $('#total_before_redeem').text(gt.toFixed(decimal));
   
     
  var gtt=parseFloat(gt-tot_point_amount);
  $('.tal_viewtotal').text(gtt.toFixed(decimal));
  $('#total_after_redeem').text(gtt.toFixed(decimal));
  $('#redeem_point').attr('readonly', true);
     
     var staffwithdiscountcs=$('#staffwithdiscountcs').val();
     var disc=$('#counter_discount_popup').val();
     
     if(disc=="Y" && staffwithdiscountcs=="Y" && $('.auothorize_popup').css('display') == 'none'){
         
         $(".discount_click").click(); 
         
      }
        $('#redeem_btn_click').hide();
        $("#loy_error").css("display","block");
	
	$("#loy_error").text("Redeemed Already ");
         
         $('#clear_btn_click').show();
         $('#ly_number').attr('readonly', true);
         $('#ly_name').attr('readonly', true);
         $('#ly_id').attr('readonly', true);
         $('#id_load').hide();
         $('#number_load').hide();
         $('#name_load').hide();
            
  });
    
    
  $('#clear_btn_click').click(function(){
      
            $('#redeem_point').attr('readonly', false);
            $('#ly_number').attr('readonly', false);
            $('#ly_name').attr('readonly', false);
            $('#ly_id').attr('readonly', false);
            $('#redeem_btn_click').show();
      
            $('.redeeming_value_total').text('');
            $('#clear_btn_click').hide();
            $('#redeem_point_total').text('0');

            $('#redeem_amount_total').text('0');

            $('#total_before_redeem').text('0');
             $('#total_after_redeem').text('0');

            $('#loy_error').text('');
            $('#redeem_point').val(0);
            $('#ly_number').val('');
    
    
     $('#point_show').hide();
     $('#point_amount_show').hide();
     $('#point_show_after').hide();
   
    
        $('#ly_id').val('');
        $('#ly_name').val('');
        $('#ly_number').val('');
        $('#ly_points').val('');
        
        var decimal=$('#decimal').val();
        var gtt=parseFloat($('#tot_org').val());
        
        $('.tal_viewtotal').text(gtt.toFixed(decimal));
        $('#id_load').hide();
        $('#number_load').hide();
        $('#name_load').hide();
        $('#ly_id').focus();
        
     });

/////loyalty ends//////////


function discount_in_loy(){
   
       $('#focusedtext').val('disountamount');
       
       var ds1= $("#disountamount").val();
   
        if(ds1!=''){
        $('#disountamount_drop').val("none"); 
        $('#disountamount_drop').attr("disabled",true);
       
        if($("input:radio.typesel:checked").val()=='P' && parseFloat($("#disountamount").val())>=100){
            $( "#disountamount" ).val("");
            
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text("Discount should be less than 100%");
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
        else if($("input:radio.typesel:checked").val()=='V' && parseFloat($("#disountamount").val())>=parseFloat($('.tal_viewtotal').text())){
            $( "#disountamount" ).val("");
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text('Discount should be less than Total');
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
 }else{
      $('#disountamount_drop').removeAttr('disabled');
      
 }
       
       
   }

function dis_pincheck(){
     $('#focusedtext').val('dis_pin');
 }
    
    
 function calc_set(){
     $('#focusedtext').val('currencyinput');
 }


function coupon_code_redeem(e){
 
    var decimal=$('#decimal').val();
    var code=$('#coupname').val();
    var data1 ='set=coupon_check&code='+code;
    var total1=$('#grandtotal').text();
    var total=total1.replace(',','');

                                $.ajax({
                                    type: "POST",
                                    url: "load_counter_sales.php",
                                    data: data1,
                                    success: function(data) {
                                        
                                 var code_value1=$.trim(data).split('*');
                                 var code_value = code_value1[0];
                                 var code_active=code_value1[1];
                                 if(code_value1[2]=='Y'){
                                 if(code_active=='Y'){ 
                                     if(code_value!=''){
                                         
                                         
                                     $('.payment_pend_right_cash_error').css("display","block");
                                     $(".payment_pend_right_cash_error").addClass("popup_validate");
                                     $('.payment_pend_right_cash_error').text('Coupon Code Applied Successfully - '+code_value+'%');
                                     $('.payment_pend_right_cash_error') .delay(3000).fadeOut('slow');
                                     
                                        var coup_amt=(total*code_value/100);
                                        var bal=total-coup_amt;
                                        $('#coupamount').val(coup_amt.toFixed(decimal));
                                        $('#coupbal').val(bal.toFixed(decimal));   
                                        $('#paidamount').val('');  
                                        $('#balanceamout').val('0');
                                        
                                        $('#coupon_code').val(code);
                                      }else{
                                          
                                         $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                      }
                                  }else if(code_active=='N'){
                                      $('.payment_pend_right_cash_error').css("display","block");
                                     $(".payment_pend_right_cash_error").addClass("popup_validate");
                                     $('.payment_pend_right_cash_error').text('Coupon Code Already Used');
                                     $('.payment_pend_right_cash_error') .delay(2000).fadeOut('slow');
                                      $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                  }
                              }else{
                                       $('.payment_pend_right_cash_error').css("display","block");
                                       $(".payment_pend_right_cash_error").addClass("popup_validate");
                                       $('.payment_pend_right_cash_error').text('Coupon Does Not Exist');
                                       $('.payment_pend_right_cash_error') .delay(1500).fadeOut('slow');
                                       $('#coupamount').val('');  
                                         $('#coupbal').val(total);  
                                         $('#paidamount').val('');  
                                         $('#balanceamout').val('0');  
                                  }
                              
                             }
                                    
                                });
}


function number_dot(event){
 if (event.which != 46 && (event.which < 47 || event.which > 59))
    {
        event.preventDefault();
        if ((event.which == 46) && ($(this).indexOf('.') != -1)) {
            event.preventDefault();
        }
    }   
}

function close_customer_data_pop(){
    $('#load_loy_bill_data').hide();
 }


function search_loy_pop_data(){ 
    
        var id_bill=$('#ly_id').val();
     
        var billno_src=$('#bill_loy_srch').val();
        var from_src=$('#from_loy_srch').val();
        var to_src=$('#to_loy_srch').val();
    
    var data2="value=loyalty_list_bill_bill_data&loy_id_list="+id_bill+"&bill_loy="+billno_src+"&from_loy="+from_src+"&to_loy="+to_src;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data2,
        success: function(data2)
        { 
         
        $('#bill_data_loy').html(data2);
         
        }
    });
}


function list_loyalty_bill(){
    
    var id_bill=$('#ly_id').val();
    
   var data="value=loy_id_check_module&id_check="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
          
       var data_ch=$.trim(data);
   
   
    if(id_bill!='' && data_ch=='Yes'){
        
        $('#load_loy_bill_data').show(); 
        
     var data="value=loyalty_list_bill_general_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
         
        $('#general_data_loy').html(data);
         
         
         
        }
 });
    
    
    
   var data1="value=loyalty_list_bill_fav_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data1,
        success: function(data1)
        { 
         
        $('#fav_data_loy').html(data1);
         
         
         
        }
  });
    
    
    
   var data2="value=loyalty_list_bill_bill_data&loy_id_list="+id_bill;
    
        $.ajax({
        type: "POST",
        url: "loyalty/load_loyalty_list.php",
        data: data2,
        success: function(data2)
        { 
         
        $('#bill_data_loy').html(data2);
         
        }
    });
    
    
   }else{
               $("#loy_error").show();
               var error_show=$('#loy_error');
	       error_show.text('Invalid Customer Details');	
	       $("#loy_error").delay(2000).fadeOut('slow'); 
               $('#ly_id').focus();
    }
     }
        });
    
 }


function clear_loy_pop(){
    
     var check = confirm("CLEAR CUSTOMER DETAILS?");
	if(check==true)
	{
    
						var dataString1 = 'set=clear_loy_pop&mode=CS';
						var request=  $.ajax({
						type: "POST",
						url: "load_index.php",
						data: dataString1,
						success: function(data) {
                                            
                                           setInterval(function () {
                                            location.reload();
        
                                        }, 500);                    
                                                                
                                                                
                              }
                               });
                           }
    }


function show_loy_pop(){
    
   $('#loyalty_cs_pop').show();
    $('#phone_cs').focus();
    
  }
  
  
 function close_loy_pop(){
        $('#loyalty_cs_pop').hide();
        
        $('#firstname_cs').val('');
   
        $('#phone_cs').val('');
     
        $('#email_cs').val('');
    
        $('#gst_loy').val('');
  }
  
    
 function edit_loy_data(id,n,p,g,e){
     
        $('.sms_mail_div').hide();
      
        $('#firstname_cs').val(n);
              $('#phone_cs').val(p);
               $('#email_cs').val(e);
               $('#gst_loy').val(g);
               $('#firstname_cs').attr('edit_id',id);
               
                  $('#loyalty_cs_pop').show();
        
  }
    
    
 function reorder_cancel(bill){
     
      $('.ta_errormsg').show();
                                    
                        $('.ta_errormsg').text('REORDER CANCELLED');
                       $('.ta_errormsg').delay(1000).fadeOut('slow');
                       
                                                var dataString1;
						dataString1 = 'set=reorder_cancel&billno='+bill;
						var request=  $.ajax({
						type: "POST",
						url: "load_index.php",
						data: dataString1,
						success: function(data) {
                                                     $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('REORDER CANCELLED');
                       $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
								
                                                        setInterval(function () {
               location.reload();
        
          }, 500);                    
                                                                
                                                                
                                                            }
                                                        });
       
   }
    
 function submit_loy_cs(){
     
      event.stopImmediatePropagation();  
      
      var edit_id= $('#firstname_cs').attr('edit_id');
      
      if(edit_id!='' && edit_id!='undefined' && edit_id!=undefined ){
          
          var fname=$('#firstname_cs').val();
                   var lname='';
                   var phone=$('#phone_cs').val();
                   var bday='';
                    var email=$('#email_cs').val();
                   var marital='';
                   var anvy='';
                   var prof='';
                   var gender='';
           var  gst_loy =$('#gst_loy').val(); 
           var  mode_loy ='CS' 
                                 
                   var chk_mail='N';
                            
                   var chk_sms='N';
                      
                    var len=$('#phone_cs').val().length;
                    
                 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mobileadd_loyalty_edit&mid="+phone+"&ly_id="+edit_id,
			success: function(msg)
			{
			msg=$.trim(msg);
				
		if(msg =="sorry")
		{
                                            
	        $("#error_show").show();
                var error_show=$('#error_show');
	        error_show.text('Number Already Exists');	
	        $("#error_show").delay(2000).fadeOut('slow');
		$('#phone_cs').focus();	    
		}
		else
		{
                 
                  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mailadd_loyalty_edit&mid="+email+"&ly_id="+edit_id,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
				
			if(msg1 =="sorry" && email!='')
			{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#email_cs').focus();	    
					}
					else
					{
                 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

   
                  if(phone!="" && len>='5' && fname!="") {   
                          
         var data="set_update=update_loyalty&fname1="+fname+"&lname1="+lname+"&email1="+email+"&bday1="+bday+"&phone1="+phone+"&marital1="+marital+"&anvy1="+anvy+"&prof1="+prof+"&chk_mail1="+chk_mail+"&chk_sms1="+chk_sms+"&gender1="+gender+"&gst_loy="+gst_loy+"&ly_id="+edit_id+'&chk_sts1=Active&mode_loy='+mode_loy;
      
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('ADDING DATA...');
    
            $('.loyalty_cs_pop_overlay').show();
    
        $.ajax({
        type: "POST",
        url: "loyalty/registration.php",
        data: data,
        success: function(data)
        {   
            	
             $('.alert_error_popup_all_in_one').show();
              $('.alert_error_popup_all_in_one').text('LOADING');
       
               $('#gender_cs').val('M');
               $('#firstname_cs').val('');
               $('#lastname_cs').val('');
               $('#phone_cs').val('');
               $('.bday_cs').val('');
               $('#email_cs').val('');
               $('#marital_cs').val('single');
               $('.anniversary_cs').val('');
               $("#profession_cs").val($("#profession_cs option:first").val());
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
               $('.loyalty_cs_pop_overlay').hide();
               $('#loyalty_cs_pop').hide();
              
                 error_show.text(''); 
                 
                 location.reload();
                 
        }
    });
    
    
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	      
               if($('#phone_cs').val()==""){
               error_show.text('Enter Number');	
	       $("#error_show").delay(2000).fadeOut('slow');
               $('#phone_cs').focus();
               }
               else if($('#firstname_cs').val()==""){
               error_show.text('Enter Name');	
	       $("#error_show").delay(2000).fadeOut('slow');
               $('#firstname_cs').focus();
               
               }else if($('#phone_cs').val()!="" && len<5){
                $('#phone_cs').focus(); 
                error_show.text('Enter Valid Number');	
            }
               
    }
    
            
     }
        }
    });
            }
        }
    });
          
        }else{
      
                   var fname=$('#firstname_cs').val();
                   var lname='';
                   var phone=$('#phone_cs').val();
                   var bday='';
                   var email=$('#email_cs').val();
                   var marital='';
                   var anvy='';
                   var prof='';
                   var gender='';
           var  gst_loy =$('#gst_loy').val(); 
           var  mode_loy ='CS' 
           
           
                   var chk_mail;
                   if($("#checkbox_mail").is(':checked'))
			     {
                             chk_mail='Y';              
                             }else{
                              chk_mail='N';
                            }
                            
                   var chk_sms;
                   if($("#checkbox_sms").is(':checked'))
			{
                        chk_sms='Y';              
                         }else{
                        chk_sms='N';
                        }
                            
                    var len=$('#phone_cs').val().length;
                    
                 
                 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mobileadd_loyalty&mid="+phone,
			success: function(msg)
			{
			msg=$.trim(msg);
				
			if(msg =="sorry")
			{
                                            
		$("#error_show").show();
                var error_show=$('#error_show');
	        error_show.text('Number Already Exists');	
	        $("#error_show").delay(2000).fadeOut('slow');
		$('#phone_cs').focus();	    
		}
		else
		{
                       $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mailadd_loyalty&mid="+email,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
				
			if(msg1 =="sorry" && email!='')
			{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
	       $('#email_cs').focus();	    
		}
		else
		{
                    
                 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

                  if(phone!="" && len>='5' && fname!="") {   
                       
         var data="set_add=add_loyalty&fname="+fname+"&lname="+lname+"&email="+email+"&bday="+bday+"&phone="+phone+"&marital="+marital+"&anvy="+anvy+"&prof="+prof+"&chk_mail="+chk_mail+"&chk_sms="+chk_sms+"&gender="+gender+"&gst_loy="+gst_loy+"&mode_loy="+mode_loy;
      
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('ADDING DATA...');
    
        $('.loyalty_cs_pop_overlay').show();
    
        $.ajax({
        type: "POST",
        url: "loyalty/registration.php",
        data: data,
        success: function(data)
        {   
            	
               $('#gender_cs').val('M');
               $('#firstname_cs').val('');
               $('#lastname_cs').val('');
               $('#phone_cs').val('');
               $('.bday_cs').val('');
               $('#email_cs').val('');
               $('#marital_cs').val('single');
               $('.anniversary_cs').val('');
               $("#profession_cs").val($("#profession_cs option:first").val());
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
               $('.loyalty_cs_pop_overlay').hide();
               $('#loyalty_cs_pop').hide();
              
                 error_show.text(''); 
                 
                 location.reload();
                 
        }
    });
    
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	      
               if($('#phone_cs').val()==""){
               error_show.text('Enter Number');	
	       $("#error_show").delay(2000).fadeOut('slow');
               $('#phone_cs').focus();
               }
               else if($('#firstname_cs').val()==""){
               error_show.text('Enter Name');	
	       $("#error_show").delay(2000).fadeOut('slow');
               $('#firstname_cs').focus();
               }else if($('#phone_cs').val()!="" && len<5){
                $('#phone_cs').focus(); 
               error_show.text('Enter Valid Number');	
            }
               
    }
    
            
     }
        }
    });
            }
        }
    });
    
        }
        
    }


 function comp_bill(mn,ord,p,u,b,bw,sl){
        var check = confirm("MARKED ITEM WILL BE COMPLIMENTARY . NO RATE WILL BE INCLUDED IN BILL ?");
	if(check==true)
	{
    
        if($("#comp_bill_"+mn+'_'+sl).prop('checked') == true){
             var chk='yes';
        }else{
             var chk='no';
        }
        
      
      var matches =  $('.comp_bill:checkbox:not(":checked")').length;
      
      if(matches>0){
                var dataString2 = 'set=comp_item_setup&mode=CS&menuid='+mn+"&type=plus&order_id="+ord+"&portion="+p+"&unit="+u+"&base="+b+"&baseweight="+bw+"&sl_no="+sl+"&chk="+chk;
				
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
            location.reload();
                          
           }
    });
    
    }else{
              
               $("#comp_bill_"+mn+'_'+sl).attr('checked',false);
        alert('ONE ITEM SHOULD BE THERE FOR BILL PRINT WITH RATE ')
     }
    
     }else{
              //   $("#comp_bill_"+mn+'_'+sl).attr('checked',false);
               location.reload();
              
     }
    
    }
    
    
    
     function item_dis_bill(mn,ord,p,u,b,bw,sl,rate,incl,menu){
        
         $('#add_stock_pop').show();
         $('#item_dis_val').val('');
         $('#item_dis_val').focus();
         
         $('#add_stock_pop').attr('menu',mn); 
         $('#add_stock_pop').attr('order',ord); 
         $('#add_stock_pop').attr('sl',sl); 
         $('#add_stock_pop').attr('rate',rate); 
         $('#add_stock_pop').attr('portion',p); 
         $('#add_stock_pop').attr('base',b); 
         $('#add_stock_pop').attr('baseweight',bw); 
         $('#add_stock_pop').attr('unit',u); 
         $('#add_stock_pop').attr('incl_rate',incl);
                
         $('#name_dis_new').text(menu+' : '+rate);
    }
    
    
       function go_dis(){
        
          var mn = $('#add_stock_pop').attr('menu'); 
          var ord =$('#add_stock_pop').attr('order'); 
          var sl    = $('#add_stock_pop').attr('sl'); 
          var rate  = parseFloat($('#add_stock_pop').attr('rate')); 
          var dis   = parseFloat($('#item_dis_val').val()); 
          var p=$('#add_stock_pop').attr('portion'); 
          var b=  $('#add_stock_pop').attr('base'); 
          var bw=  $('#add_stock_pop').attr('baseweight'); 
          var u=   $('#add_stock_pop').attr('unit'); 
           
          var item_dis_type= $('#item_dis_type').val();
          var item_dis_val= $('#item_dis_val').val();
            
          var  incl_rate =parseFloat($('#add_stock_pop').attr('incl_rate')); 
           
           
           
           if(((dis>rate) && item_dis_type=='v') || ( item_dis_type=='p' && dis>=100) ){
               
               alert('Discount Must be less than Item Rate');
               
           }else{
               
               var dataString2 = 'set=item_dis_bill&mode=CS&menuid='+mn+"&type=plus&order_id="+ord+"&portion="+p+"&unit="+u+"&base="+b+"&baseweight="+bw+"&sl_no="+sl+"&item_dis_type="+item_dis_type+"&item_dis_val="+item_dis_val+"&rate="+rate+'&incl_rate='+incl_rate;
		
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                                       $('#add_stock_pop').hide(); 
                                       $('#item_dis_val').val('');
                                       $('#item_dis_type').val('v');
                                       
                                       
                                    var dataString1 = 'value=loaditemsorderd';
						var request=  $.ajax({
						type: "POST",
						url: "load_counter_sales.php",
						data: dataString1,
						success: function(data) {
								$('.listorderditems').html(data);
                                                               
                                                            }
                                                        });
                                }
                            });
               
           }
           
    }

function load_best_sell_cat(){
    
     $('#ta_loadsubcat').html('');
    
     $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadmenuitems').css("vertical-align","middle");
	   $('#ta_loadmenuitems').css("display","flex");
           
	 var  dataString = 'value=best_selling_cat';
	   var request= $.ajax({
			type: "POST",
			url: "load_counter_sales.php",
			data: dataString,
			success: function(data) {
				 $('#ta_loadmenuitems').html(data);
				 $('#ta_loadmenuitems').css("text-align","left");
				 $('#ta_loadmenuitems').css("display","inherit");
			}
	 	 });
}



</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<style>.open>.dropdown-menu{bottom: 38px !important;}.multiselect{width: 100% !important;height: 35px;float: left;background-color: #2D3337 !important;border-radius: 5px;padding-left: 5px;border: 0px;font-size: 14px;}.pop_prference_cc .btn-group, .btn-group-vertical{width: 93%;margin: 8px;margin-bottom: 0;}.open>.dropdown-menu{width:100%}
/* .right_drop_menu {  bottom: inherit !important;}*/
.top_site_map_cc .open>.dropdown-menu{bottom: auto !important;}
.top_site_map_cc  .btn-group{margin-top:5px;}
.notinstock_cs .menu_sub_item::after { 
    content: " - Out of Stock -";
    width: 100%;
    position: absolute;
    left: 0;
    top: 23px;
    font-size: 12px;
    color: #f00;
}
.noportionalert_cs .menu_sub_item::after { 
    content: " - No Portion -";
    width: 100%;
    position: absolute;
    left: 0;
    top: 23px;
    font-size: 12px;
    color: #f00;
}

 </style>   
<!--<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999999999;" class="mynewpopupload1"  ></div>--> 
 <div style="display:none;height: 160px;" class="index_popup_1 closeoneclass kotconfirmpopup_cs">
        <span id="kotfailmsg_cs" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant"> Continue without Print ?</div>
       <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="confirmkotok_cs">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_cs">No</a></div>
    </div>
 </div>
<div style="display:none;height: auto;top:40%;bottom: inherit;" class="index_popup_1 closeoneclass kotconfirmpopup_cs_bill">
        <span id="kotfailmsg_cs_bill" style="text-align: center;width: 100%;float: left ;padding-top: 7px;color:red;font-weight: bold"></span>
 	<div class="index_popup_contant" style="height:auto">Continue Without Print ?</div>
       <div class="index_popup_contant">
    	<div style="background-color: green" class="btn_index_popup"><a href="#" class="confirmkotok_cs_bill">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_cs_bill">No</a></div>
    </div>
 </div>

<!--///kot check cs on payment submit///-->
<div style="display:none;height: auto;top:40%;bottom:inherit;" class="index_popup_1 closeoneclass kotconfirmpopup_cs_submit">
        <span id="kotfailmsg_cs_submit" style="text-align: center;width: 100%;float: left ;padding-top: 7px;color:red;font-weight: bold"></span>
 	<div class="index_popup_contant">Continue Without Print ?</div>
       <div class="index_popup_contant">
    	<div style="background-color: green" class="btn_index_popup"><a href="#" class="confirmkotok_cs_submit">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="confirmkotclose_cs_submit">No</a></div>
    </div>
 </div>


<div class="payment_auth_pop" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head head_change"></div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error_split" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_pay" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close_auth" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel pin_pay_auth" id="kotcancel_reason_popup_new_proceed_btn_cs11">Proceed</div></a>
    </div> 
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle_auth">1</span>
            <span class="calculator_settle_auth">2</span>
            <span class="calculator_settle_auth">3</span>
            <span class="calculator_settle_back_auth">&nbsp;</span>
            <span class="calculator_settle_auth">4</span>
            <span class="calculator_settle_auth">5</span>
            <span class="calculator_settle_auth">6</span>
             <span class="calculator_settle_auth">Clear</span>
            <span class="calculator_settle_auth">7</span>
            <span class="calculator_settle_auth">8</span>
            <span class="calculator_settle_auth">9</span>
            <span class="calculator_settle_auth">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>


 <div class="cs_settle_auth_pop" style="display:none">
 <input type="hidden" name="focusedtext_set" id="focusedtext_set" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head ">SETTLE AUTHORIZATION</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error_set" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_set" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close_settle_auth" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel cs_settle_auth" id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
    </div> 
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle_set">1</span>
            <span class="calculator_settle_set">2</span>
            <span class="calculator_settle_set">3</span>
            <span class="calculator_settle_set">&nbsp;</span>
            <span class="calculator_settle_set">4</span>
            <span class="calculator_settle_set">5</span>
            <span class="calculator_settle_set">6</span>
             <span class="calculator_settle_set">Clear</span>
            <span class="calculator_settle_set">7</span>
            <span class="calculator_settle_set">8</span>
            <span class="calculator_settle_set">9</span>
            <span class="calculator_settle_set">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>


<div class="kotcancel_reason_popup_new" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorization</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	<div class="kotcancel_reason_popup_new_textbox_cc">
            <select class="kotcancel_reason_popup_new_textbox_input" id="authcodersn">
               
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
        </div>
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
        <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" id="kotcancel_reason_popup_new_proceed_btn_cs">Proceed</div></a>
        
    </div>
    
  </div>
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div>
</div>

 <!--******** combo add popup **********-->                                   
          
   <div class="combo-popup-cc" id="combo_ordering_popup" style="display:none">
                
    </div>
                
  <!--**************** combo popup END *******--> 

<script>
$('.combo_menu').click(function () {
    $(".combo-popup-cc").show();
 });
      
</script>

<style>
    .counter_main_orderd_detail_contant table{ background-color: rgba(19, 41, 53, 0.60);}
    .combo_added_sec .menu_order_dish_name {
    max-width: 80%;
    min-width: 20%;
    width: auto;
    overflow: hidden;
    font-weight: bold;
    font-family: 'CALIBRIB_0';
    font-size: 16px;
    color: #fff;
    text-align: center;
    text-transform: uppercase;
}
    .combo_added_sec {
       width: 99%;
    height: auto;
    float: right;
    margin-right: 4px;
       background-color: rgba(19, 41, 53, 0.60);
   /* box-shadow: 0px 3px 7px #000 !important;*/
  border-bottom: 1px #0c7298  dashed !important;
    border-top: 1px #0c7298  dashed !important;
    background-image: none !important;
    
    margin-bottom: 5px;
    /*background-color: #fff;*/
}
.combo_added_sec .menu_order_dishname_cc {
    padding: 1%;
    width: 86%;
    height: auto;
    float: left;
}
.combo_added_sec .menuodr_rate_cc {
    width: 100%;
    height: auto;
    float: left;
        color: #fff;
}
.combo_added_sec .dine_menu_rate {
    min-width: 40%;
    width: auto;
    max-width: 60%;
    height: auto;
    float: left;
    margin-top: 5px;
    font-weight: bold;
    font-family: 'CALIBRIB_0';
}
.combo_added_sec .dine_menu_qty {
    max-width: 25%;
    width: auto;
    height: auto;
    float: left;
    margin-top: 5px;
    min-width: 23%;
}
.combo_added_sec  .combo_order_delet_btn {
    width: 13%;
    height: 45px;
    float: left;
    position: relative;
    z-index: 99;
    margin-top: 5px;
}
.combo_added_sec .combo-preview-secion {
    width: 100%;
    /* min-height: 50px; */
    float: left;
    text-align: left;
    color: #dce7ea;
    word-wrap: break-word;
    font-size: 15px;
       border-top: 1px rgba(0, 0, 0, 0.20) solid;
    vertical-align: middle;
    padding: 5px;
    overflow: hidden;
    /* background-color: #fff; */
}
.combo_added_sec .menu_order_preference_text {
    width: 100%;
    max-height: 50px;
    float: left;
    text-align: left;
    color: #b6d4e2;
    word-wrap: break-word;
    font-size: 15px;
    border-top: 1px rgba(0, 0, 0, 0.20)  solid;
    vertical-align: middle;
    padding:4px;
    overflow: hidden;
    /* padding-left: 15px; */
}
.combo_added_sec .menu_eachpc_head {
    width: 100%;
    margin-top: -4px;
    margin-bottom: 5px;
    float: left;
    color: #8f9ba5;
}
.combo_added_sec  .addon-mn-row {
    width: 100%;
    height: auto;
    float: left;
    margin-bottom: 4px;
}
.combo-preview-secion .addon-preview-secion-mn-1 {
    width: 80%;
        height: auto;
    float: left;
    font-weight: bold;
    font-family: 'CALIBRIB_0';
    font-size: 13px;
}
.combo_added_sec  .addon-preview-secion-qty {
    width: 20%;
    height: auto;
    float: left;
    font-weight: bold;
    font-family: 'CALIBRIB_0';
    font-size: 13px;
}
.combo_added_sec .preferance_table_btn .hold_list_add { border: solid 2px #fff !important;margin-top: 5px !important;}
.menu_order_dish_name span {
    float: left;
    padding-left: 3%;
}

 </style>
 
 <div id="load_loy_bill_data" class="load_loy_bill_data_cl">

        <div class="load_loy_bill_data_cl_head">
            CUSTOMER DETAILS  <div onclick="return close_customer_data_pop();" class="load_loy_bill_data_close"><img src="img/uploadify-cancel.png"></div>
        </div>

        <div class="load_loy_bill_data_contant">
          
        <div class="load_loy_bill_data_contant_row">
                <table class="load_loy_bill_data_contant_tbl">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>NUMBER</th>
                            <th>EMAIL</th>
                            <th>JOINED</th>
                            <th>NO OF VISITS</th>
                            <th>TOTAL POINTS</th>
                            <th>AMOUNT SPEND</th>
                        </tr>
                    </thead>
                    <tbody id="general_data_loy">
                        
                    </tbody>
                </table>
            </div>

            <div class="load_loy_bill_data_contant_row">
                <table class="load_loy_bill_data_contant_tbl">
                    <thead>
                        <tr>
                            <th>FAVOURITE 5 ITEMS</th>
                           
                        </tr>
                    </thead>
                    <tbody id="fav_data_loy">
                        
                    </tbody>
                </table>
            </div>

            <div class="load_loy_bill_data_contant_row">
            <div class="card-box table-responsive">
                            
          <form>
                            
          <div class="dt-buttons btn-group" style="margin-bottom:8px;width:100%">
                            	
                            
                             <div class="col-sm-3">
                                	<div class="table-filter-text">Bill No</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Bill No" id="bill_loy_srch" onkeyup="search_loy_pop_data();">
                                </div>
                                
                                <div class="col-sm-3">
                                        <div class="table-filter-text">From Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="From Date" id="from_loy_srch" onkeyup="search_loy_pop_data();" >
                                </div>
                                
                                <div class="col-sm-3">
                                        <div class="table-filter-text">To Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="To Date" id="to_loy_srch" onkeyup="search_loy_pop_data();" >
                                </div>
                                
        </div>
       </form>
                            
      <div class="load_loy_bill_data_contant_tbl_scr">  	
         <table class="load_loy_bill_data_contant_tbl">
         <thead>
          <tr>
                            <th>BILL NO</th>
                            <th>SUBTOTAL AMOUNT	</th>
                            <th>REDEEM POINT	</th>
                            <th>ADDED POINT	</th>
                            <th>REDEEM AMOUNT	</th>
                            <th>TTL AFTER REDEEM </th>
                            <th>DATE</th>
                           
          </tr>
      </thead>

     <tbody id="bill_data_loy">

      </tbody>
      
    </table></div></div></div></div></div>
   
  <div class="kotcancel_reason_popup_reprint_cs" style="display:none;width:370px;
	height:auto;
	position:absolute;
	z-index:99999999;
	background-color:#fff;
	left:0;
	right:0;
	margin:auto;
	border-radius:8px;
	top:15%;">
    <input type="hidden" name="focusedtext" id="focusedtext" />
    
     <input type="hidden" name="mode_set" id="mode_set" />
     
 <div class="kotcancel_reason_popup_new_left_cc">
     <div class="kotcancel_reason_popup_new_head" style="color:gray;font-weight: bold">RE-PRINT AUTHORIZATION </div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_errorbh" style="color:darkred;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pinbh" onkeypress="pincheck(this.val)" autofocus="true" maxlength="4"/>
            <span style="height: 47px;" class="login_back_btn calculator_settle_back">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a  href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnbh_cs">EXIT</div></a>
    	<a href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnbh_cs">GO</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle2">1</span>
            <span class="calculator_settle2">2</span>
            <span class="calculator_settle2">3</span>
            
            <span class="calculator_settle2">4</span>
            <span class="calculator_settle2">5</span>
            <span class="calculator_settle2">6</span>
            <span class="calculator_settle2">7</span>
            <span class="calculator_settle2">8</span>
            <span class="calculator_settle2">9</span>
            <span class="calculator_settle2">0</span>
            <span style="width: 46.2%;max-width: inherit;" class="calculator_settle2">Clear</span>
        </div>
  </div>
</div>
 
 <div class="kotcancel_reason_popup_regen_cs" style="display:none;width:370px;
	height:auto;
	position:absolute;
	z-index:99999999;
	background-color:#fff;
	left:0;
	right:0;
	margin:auto;
	border-radius:8px;
	top:15%;">
    <input type="hidden" name="focusedtext" id="focusedtext" />
    
    <input type="hidden" name="mode_set" id="mode_set" />
     
 <div class="kotcancel_reason_popup_new_left_cc">
     <div class="kotcancel_reason_popup_new_head" style="color:gray;font-weight: bold">REGENERATE AUTHORIZATION </div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error_reg" style="color:darkred;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="width:80%;float:left" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_reg" onkeypress="pincheck(this.val)" autofocus="true" maxlength="4"/>
            <span style="height: 47px;" class="login_back_btn calculator_settle_back">&nbsp;</span>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a  href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="reg_cancel">EXIT</div></a>
    	<a href="#"><div style="background-color:darkred; " class="kotcancel_reason_popup_new_textbox_btn" id="reg_proceed">GO</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle2">1</span>
            <span class="calculator_settle2">2</span>
            <span class="calculator_settle2">3</span>
            
            <span class="calculator_settle2">4</span>
            <span class="calculator_settle2">5</span>
            <span class="calculator_settle2">6</span>
            <span class="calculator_settle2">7</span>
            <span class="calculator_settle2">8</span>
            <span class="calculator_settle2">9</span>
            <span class="calculator_settle2">0</span>
            <span style="width: 46.2%;max-width: inherit;" class="calculator_settle2">Clear</span>
        </div>
  </div>
</div>
 
 
  <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:9999999999;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:6px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
     <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">  
        
        <div class="stok_add_popup" style="width:300px;height: 160px">
        <div class="stok_add_popup_hd">  
            <strong style="font-size: 13px " id="name_dis_new"></strong> <span style="font-size: 13px "><?=$lang31?></span>
            <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
            <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        
        <div class="stok_add_popup_cnt" id="cus_div">
            <span style="font-size:10px;font-weight: bold;color: darkred">ENTER ITEM DISCOUNT</span>  &nbsp; <br>
            <input style="width:30%;margin-right: 20px;border-radius: 5px;"  maxlength="10" type="text" class="stock_add_txtbx" id="item_dis_val" placeholder="Enter Value"> &nbsp;&nbsp;
            <select style="width:24%;border-radius: 5px;background-color: #e5e5e5"class="stock_add_txtbx" id="item_dis_type">
                <option value="v">Value</option>
                <option value="p">%</option>
            </select>
          <a  onclick="go_dis();" href="#"><div   style="width:30%" class="stock_add_btn">GO</div></a>
            
        </div>
        
    </div>
   </div>
 
 
 
  <div class="stok_add_popup_sec" style="display:none" id="otp_pop">  
        
        <div class="stok_add_popup" style="width:300px;height: 160px">
        <div class="stok_add_popup_hd">  
            <strong style="font-size: 13px " id="name_dis_new"></strong> 
            <a href="#" onclick="$('#otp_pop').hide();"><div class="stok_add_popup_cls">
            <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        
        <div class="stok_add_popup_cnt" id="cus_div">
            <span style="font-size:10px;font-weight: bold;color: darkred">ENTER OTP PROVIDED BY OUTLET OWNER ? </span>  &nbsp; <br>
            <input style="width:56%;margin-right: 20px;border-radius: 5px;"  maxlength="10" type="password" class="stock_add_txtbx" id="code_otp" placeholder="OTP"> &nbsp;&nbsp;
           
       <a id="go_item_cancel" onclick="go_otp();" href="#"><div   style="width:30%" class="stock_add_btn">GO</div></a>
            
        </div>
        
    </div>
   </div>
 
</body>

</html>
