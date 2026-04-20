<?php
session_start();
  include("../database.class.php");
$database	= new Database();
//error_reporting(0);
$store_urban=''; $db_urban=''; $qr_db_check='';

$sql_login_dc  =  $database->mysqlQuery("select be_qrcode_db,be_store_id,be_store_db from tbl_branchmaster "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
      $store_urban=$result_cat_s_tc['be_store_id'];
      $db_urban=$result_cat_s_tc['be_store_db'];
      $qr_db_check=$result_cat_s_tc['be_qrcode_db'];
 }
}

$dt_order_ta=date('Y-m-d');

$sql_login_dc3  =  $database->mysqlQuery(" SELECT tab_billno,tab_urban_order_id, COUNT(*)
FROM tbl_takeaway_billmaster where tab_urban_order_id!='' and tab_date='$dt_order_ta'
GROUP BY tab_urban_order_id
HAVING COUNT(*) > 1 "); 
$num_cat_s_dc3  = $database->mysqlNumRows($sql_login_dc3);
if($num_cat_s_dc3 ){
   while($result_cat_s_tc39  = $database->mysqlFetchArray($sql_login_dc3)) 
	  { 
 
      $sql_login_dc77  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_status='Cancelled',tab_cancelledreason='OnlineDuplicate'  where tab_mode='TA' and   tab_urban_order_id='".$result_cat_s_tc39['tab_urban_order_id']."' and tab_billno!='".$result_cat_s_tc39['tab_billno']."' "); 
    
    }

  }

?>


<link rel="shortcut icon" href="img/favicon.ico">

<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Online </title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">
<style>
    
    
    .confrmation_overlay_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
        display: none;
        text-align:center;
	padding-top:150px
}

.confrmation_overlay_auth img{
    
    width:100px;
    height:100px;
   
}


.online_order_history_btn{width: 130px;    margin-left: 1%;}
.acc_table_scroll tbody {height: 56vh;}
.new_order_box_sc .take-away-quee-box {width:12%}
.online_order_history_btn img{width: 20px;}
.new_item_sm_pop{    height: 602px;}
@media (max-width:1100px){
  .new_order_box_sc .take-away-quee-box {width:17%}
}

@media (max-width:750px){
  .new_order_box_sc .take-away-quee-box {width:40%; margin:1%; margin-left:5%;}
  .online_order_history_btn{width: 75px;margin-left: 2%;font-size:5px;}
}
.disablegenerate
        {
            pointer-events: none;
            opacity: 0.2;
            cursor:none;

        }
        @media (max-width:800px){
  .new_order_box_sc .take-away-quee-box {width:40%; margin:1%; margin-left:5%;}
  .online_order_history_btn{width: 65px!important;margin-left: 2%;font-size:5px;margin:2px!important; float:right!important; display: inline-block;}
  .odr_online_home_top_filter select{
			width: 65%;
			/* font-size: 10px;
      margin-top: 50px;
    margin-left: -100px; */
			
		}

    .top_site_map_cc{
      /* height:100px; */
    }
  }
  @media (max-width:750px){
    .odr_online_home_top_filter{
      /* width: 50%;
      font-size: 10px; */
      margin-top: 50px;
      margin-left: -100px;
    }
    .alet{
      display:inline-block;
      /* margin-top:50px; */
    }

}

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

.blink_border{
position:relative;top:4px;font-size: 11px;width: 115px;left: 490px;
}
@media (max-width:750px){
  .blink_border{
    width: 157px;
    top: 57px !important;
    left: 490px;
}
}
</style>

   <script src="../js/jquery-1.10.2.min.js"></script>  
    
   <script type="text/javascript">
            $(document).ready(function () {
                
//                      $.post("../autoload_menu.php", {set:'urban_piper_order'},
//					function(data)
//					{
//					  data=$.trim(data);
//                                          var ub_count=  $('#count_order').html();
//                                          if(ub_count>0)
//					  { 
//					    $('#urbanAudio')[0].play();
//					  }
//                                        $('#count_order').html(data);
//			});
                        
                        
   setInterval(function() {
        
    location.reload();
        
    }, 900000);    
                
          
          
          
    setInterval(function () {
             
      var channel_id=$('#channel_id').val();
       
        var datastringnewcard="channel="+channel_id;
       
       $.ajax({
        type: "POST",
        url: "load_online_order_screen.php",
        data: datastringnewcard,
        success: function(data)
        {  
            $('.take-away-quee-contant-cc').html(data);
         } 
         });
         
         
      $.post("../autoload_menu.php", {set:'urban_piper_order'},
					function(data)
					{
                                            data=$.trim(data);
                                     
                                            var ub_count=  $('#count_order').html();
                                    
                                            if(ub_count>0)
					    { 
						$('#urbanAudio')[0].play();
					    }
                                             
                                           $('#count_order').html(data);
	});
                 
       }, 10000);
                 
  });  
            
    
    function go_home_new(){
          
        window.parent.location.href ="../index.php";
         
     }
     
    function go_nav(){
        
          $('.main_loader_sec').css('display','block'); 
       
            window.location.href="qr_order_screen.php";
    }
    
    
    
    function confirm_order(order,store,channel,name,phone,address,landmark,area,remarks,agg){
        
        var check = confirm("NOTICE : ONCE ACCEPETED CAN'T BE CANCELLED ?");
	if(check==true)
	{
            
        $('.main_loader_sec').css('display','block'); 
            
        $('#order_box_'+order).addClass('disablegenerate');
        
        $('#confirm_btn_'+order).show();
        $('#accept_btn_'+order).hide();
        $('#cancel_btn_'+order).hide();
        
        $('#confirm_msg_'+order).show();
        
        
       var datastringnewcard="set=add_order_urban&order_id="+order+"&store_id="+store+"&channel="+channel+"&agg="+agg;
       
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        { 
            $('#order_box_'+order).addClass('disablegenerate');
            $('#confirm_btn_'+order).show();
            $('.main_loader_sec').css('display','block'); 
            
         }
        }); 
          
       $('#order_box_'+order).addClass('disablegenerate');
       $('.main_loader_sec').css('display','block'); 
       
      var homed='TA'; var discount_of='0'; var discount='N'; var discount_unit=''; var discountid='';
       
       var gst=''; var loyalty_redeemamount=''; var id_of_order='';
            
            var dataString = 'value=submitvalues_ta&name=' + name +'&address=' + address +'&orderaddr='+ address +'&landmark=' +
                                landmark +'&area=' + area +'&remarks='+remarks+'&mobile=' + phone +'&homed=' + homed
                                + '&discount_of='+ discount_of + '&discount=' + discount + ' &discount_unit='+discount_unit
                                + '&discountid='+discountid+'&gst='+gst
                                +"&redeemamount="+loyalty_redeemamount
                                +"&id_of_order="+id_of_order+"&bill_setup=online_setup";
			
				 $('#order_box_'+order).addClass('disablegenerate'); 
				 $.ajax({
					type: "POST",
					url: "../load_takeaway.php",
					data: dataString,
					success: function(data1) { 
                                         $('.main_loader_sec').css('display','block');    
                                        $('#order_box_'+order).addClass('disablegenerate');       
                                $('#confirm_btn_'+order).show();
                                setInterval(function () {
                 $('#order_box_'+order).removeClass('disablegenerate');
                 $('.main_loader_sec').css('display','none');    
                 }, 5000);  
                         
                           
                                     }
				});
                                                      
//                                    var  dataString77 = 'value=getbill_amt';
//                                             $.ajax({
//					type: "POST",
//					url: "../load_takeaway.php",
//					data: dataString77,
//					success: function(datax) { 
//                                      
//                                                 datax=datax.trim();
//                                                     
//                                                var det=datax.split(",");
//                                                
//                                                localStorage.urban_bill_amount5=parseFloat(det[1]).toFixed(2); 
//                                                
//                                                }
//                                        });
                                            
//                                                     var  data_cr = {
//								  "set"				: "bill_settle_ta",
//								  "type"			: 'credit_person',
//								  "typenam"			: "6",
//								  "creditype"			: '3',
//								  "creditdeatils"		: '',
//								  "paidamount_credit"	        : '0',
//								  "amount_credit"		: localStorage.urban_bill_amount5,
//								  "bal"				: '0',
//				                                   "stl" 		        : 'drct',
//                                                                   "credit_remarks_ta"          :'',
//                                                                   "guestnumber"                :'',
//                                                                  "guestname"                   :channel,
//                                                                  "room"                        :'' 
//								};
                      
//                       data_cr = $(this).serialize() + "&" + $.param(data_cr)+"&tip_amount=0&tip_mode=C&auth_staff=&coupon_code=&bill_final_amount_new="+localStorage.urban_bill_amount5; 
//			 $.ajax({
//					type: "POST",
//					url: "../load_payments_ta_cs.php",
//					data: data_cr,
//					success: function(msg)
//					{ 
                   
//                                        }
//                                        });
    
    
   
    
        }
       
    }
    
    
    function reorder_bill(ord,store){
        
        var check = confirm("CONFIRM REORDER OF THE ACCEPTED BILL ?");
	if(check==true)
	{
            $('.main_loader_sec').css('display','block'); 
         var datastringnewcard="set=reorder_bill&order_id="+ord+"&store_id="+store;
       
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        {      
          location.reload();
        }  
       });
        
        }
    }
    
  
    function load_urban_items(ord,store){
       
         $('.main_loader_sec').css('display','block'); 
         var datastringnewcard="set=list_urban_order&order_id="+ord+"&store_id="+store;
       
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        {      
          
        $('#urban_item_div').show();
         $('#load_data_item').html(data);
       $('.main_loader_sec').css('display','none'); 
        }  
       });
        
        
    }
    
     function close_list_items(){
         $('#urban_item_div').hide();
         $('#load_data_item').html('');
     }
    
    
    function load_channel_wise(){
        $('.main_loader_sec').css('display','block');   
        //  $('.confrmation_overlay_auth').html('<img src="../img/ajax-loaders/ajax-loader.gif" />');   
        var channel_id=$('#channel_id').val();
        
        var datastringnewcard="channel="+channel_id;
       
        $.ajax({
        type: "POST",
        url: "load_online_order_screen.php",
        data: datastringnewcard,
        success: function(data)
        { 
            $('.main_loader_sec').css('display','none');   
        
            $('.take-away-quee-contant-cc').html(data);
        } 
      });
   }
    
     function cancel_order_status_ok(){
        
         var store=$('.cancel_reason_popup_sec').attr('store');
           var ord= $('.cancel_reason_popup_sec').attr('order');
          
          var channel= $('.cancel_reason_popup_sec').attr('channel');
           
          var cancel_reason=$('#cancel_reason').val();
          
         
          if(cancel_reason!=''){
           
        $('.cancel_reason_popup_sec').css('display','none');   
        
        $('.main_loader_sec').css('display','block');   
         // $('.confrmation_overlay_auth').html('<img src="../img/ajax-loaders/ajax-loader.gif" />');   
       
        
        var datastringnewcard="set=cancel_order_urban&order_id="+ord+"&store_id="+store+"&cancel_reason="+cancel_reason;
      
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        {
            if(channel!='swiggy'){
            
            location.reload();
            
            }else{
                
               alert($.trim(data)); 
            
             setInterval(function () {
                   location.reload();
                 
                 }, 1000);  
            
            }
            
            
        } 
      });
      
      }else{
          
          alert('SELECT REASON FOR CANCELLATION');
          
          }
      
      
   }
    
    
    function cancel_order_status(ord,store,channel){
        
           $('.cancel_reason_popup_sec').attr('store',store);
           $('.cancel_reason_popup_sec').attr('order',ord);
           $('.cancel_reason_popup_sec').attr('channel',channel);
        $('.cancel_reason_popup_sec').css('display','block');   
        
       
      
   }
   function ready_order_urban(ord,store){
       
        $('#order_box_'+ord).addClass('disablegenerate');
       $('#confirm_btn_'+ord).hide();
      $('#confirm_msg_'+ord).show();
        $('.main_loader_sec').css('display','block'); 
        
        var datastringnewcard="set=ready_order_urban&order_id="+ord+"&store_id="+store;
       
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        { 
              $('#confirm_btn_'+ord).hide();
              $('#confirm_msg_'+ord).show();
              $('#order_box_'+ord).addClass('disablegenerate');
              $('.main_loader_sec').css('display','block'); 
              
           setInterval(function () {
                   $('#order_box_'+ord).removeClass('disablegenerate');
                   $('.main_loader_sec').css('display','none'); 
                
                 }, 4000);  
           
        } 
      });
   }
   
    function cancel_order_close(){
        
        $('.cancel_reason_popup_sec').css('display','none');   
        
   }
    
    
    function print_urban_bill(bill){
           
        var check = confirm("CONFIRM PRINT ?");
	if(check==true)
	{
            
              $('.main_loader_sec').css('display','block'); 
		var dataString = "set=reprint_ta_new&homed=HD&billno="+bill;
                
		$.ajax({
		type: "POST",
		url: "../print_details.php",
		data: dataString,
		success: function(data2) {
                  $('.main_loader_sec').css('display','none'); 
                }
            });
            
           
       }     
   } 
   
   
     
    function print_urban_kot(kot,bill){
           
           var check = confirm("CONFIRM KOT ?");
	if(check==true)
	{
              $('.main_loader_sec').css('display','block'); 
		var dataString = "bill_kot=online_kot&online_kot="+kot+"&online_bill="+bill;
                
		$.ajax({
		type: "POST",
		url: "../load_takeaway.php",
		data: dataString,
		success: function(data2) {
                  $('.main_loader_sec').css('display','none'); 
                }
            });
           
       }     
   } 
    </script>

</head>

<body id="div_full_body">
 
    <input type="hidden" value="order_ok" id="load_order_ok">
    
<div class="container-fluid no-padding">
      <div class="middle_container">
      <div class="top_site_map_cc new-sitemap-cc" style="width:100%">
      <div class="logo_container">
           <a onclick="go_home_new();" href="#"> <div class="logo"><img src="../img/logo20.png"></div></a>
        </div>
          <!-- <a  href="../index.php"  class="home_cio_online_odr">&nbsp; &nbsp;  Home &nbsp;  &nbsp; </a> -->
          <div class="odr_online_home_top_filter">
                  <select onchange="load_channel_wise();" id="channel_id">
                  <option value="">All</option>
               <option value="zomato">zomato</option>
              
                <option   value="swiggy">swiggy </option>
                <option   value="ubereats">ubereats</option> 
                <option   value="scootsy">scootsy</option> 
                <option   value="dunzo">dunzo</option>
                <option   value="dotpe">dotpe</option>
                <option  value="foodpanda">foodpanda</option>
                <option   value="amazon">amazon</option>
                <option   value="swiggystore">swiggystore</option>
                <option  value="zomatomarket">zomatomarket</option>
            </select>
          </div>

          <?php if($qr_db_check!=''){ ?>
          <div style="background-color: darkred;font-size: 10px;width: 140px;font-weight: bold;" onclick="go_nav()" class="online_order_history_btn"> <a href="#"><img src="../img/download_pdf_btn.png" alt=""> GO TO  QR ORDERS</a> </div>
          <?php }else{ ?>
           <div style="background-color: #8c8c37;"  class="online_order_history_btn"> <a href="#"><img src="../img/download_pdf_btn.png" alt="">ONLINE ORDERS</a> </div>
         
           <?php } ?>
          
          <span  class="online_odr_main_head border_blink blink_border" style="border-radius:3px;width: 160px;left: 465px">   <span title="FAST ACCEPTANCE INCREASE RESTAURANT RATINGS" Class="alet" style="color:white;font-size:11px;font-weight: bold; ">  ACCEPT ORDERS IN 3 MINS</span></span>
          
            <div style="float:right;background-color: #526654;width:80px" class="online_order_history_btn"> <a target="_blank" href="https://www.expodinereports.com/urban_piper/index.php?exp_id_con=<?=$db_urban?>"><img src="../img/mn_master_mn_ico.png" alt="">ADMIN</a> </div>
          
          <div style="float:right;background-color: darkred;width:70px" class="online_order_history_btn"> <img src="../img/mn_master_mn_ico.png" alt=""><strong id="count_order"><?php if(isset($_SESSION['qr_order_count'])){ echo $_SESSION['qr_order_count']; } ?></strong></div>
          
        

           <div style="float:right;background-color: darkred;width:80px" class="online_order_history_btn"> <a target="_blank" href="https://prime.urbanpiper.com/auth/login"><img src="../img/mn_master_mn_ico.png" alt="">PRIME</a> </div>

          
          <div style="float:right;width: 85px;background-color:darkred " class="online_order_history_btn"> <a href="order_history.php"><img src="../img/mn_master_mn_ico.png" alt="">HISTORY</a> </div>
          
      </div>
          
         
          <div class="take-away-quee-contant-cc new_order_box_sc" style="overflow-y: scroll ">

            <?php
            
            
     $addr=''; $addr1='';
            
     $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);       
            
  $dt_order=date('Y-m-d');
//  echo "select td_order_id,td_local_status,tp_platform_id,td_channel,td_date,td_order_local_accepted,tor_line1,tor_line2,tor_customer,tor_phone,tor_city,td_payable_amount,td_store_id,tor_landmark,tor_sublocality,tor_tag from tbl_order_details td left join tbl_order_relay_platform tp on tp.tp_order_id=td.td_order_id left join tbl_order_relay_customer tc on td.td_order_id = tc.tor_order_no   where date(td.td_date)='$dt_order' and  (td.td_webhook_status is NULL or td.td_webhook_status='Acknowledged' or  td.td_webhook_status='Placed'  )    order by td.td_date desc";
 $sql_gen =  mysqli_query($localhost1,"select td_order_id,td_local_status,tp_platform_id,td_channel,td_date,td_order_local_accepted,tor_line1,tor_line2,tor_customer,tor_phone,tor_city,td_payable_amount,td_store_id,tor_landmark,tor_sublocality,tor_tag from tbl_order_details td left join tbl_order_relay_platform tp on tp.tp_order_id=td.td_order_id left join tbl_order_relay_customer tc on td.td_order_id = tc.tor_order_no   where date(td.td_date)='$dt_order' and  (td.td_webhook_status is NULL or td.td_webhook_status='Acknowledged' or  td.td_webhook_status='Placed'  )    order by td.td_date desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                        
                                    $addr1=trim($result_cat_s_tc['tor_line1'].' '.$result_cat_s_tc['tor_line2']);
                                    
                                    
                                    
                                    $addr= preg_replace("/[^A-Za-z0-9 ]/", '', $addr1);


    
    $bill_ta=''; $kot_ta='';
$sql_login_dc  =  $database->mysqlQuery("select tab_billno,tab_kotno from  tbl_takeaway_billmaster where tab_urban_order_id='".$result_cat_s_tc['td_order_id']."' "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $bill_ta=$result_cat_s_tc3['tab_billno'];
     $kot_ta=$result_cat_s_tc3['tab_kotno'];
      
 }
}

$start = strtotime($result_cat_s_tc['td_date']);
$end = strtotime(date('Y-m-d H:i:s'));
$mins = ($end - $start) / 60;


                            ?>
          
            <div class="take-away-quee-box" id="order_box_<?=$result_cat_s_tc['td_order_id']?>"  style="height:175px">       
                            
                <div   class="take-away-quee-box-head" title="<?=$result_cat_s_tc['td_order_id']?>"> 
                      <strong> <?=$result_cat_s_tc['td_channel']?> 
                          
                         <?php if( (strpos($bill_ta, 'TEMP') !== false || $bill_ta=='') && $result_cat_s_tc['td_order_local_accepted']=="Y"){?>
                          <span onclick="reorder_bill('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>')" title="REORDER THE BILL" style="width: 10%;position: absolute;top: 6px;right: 9px "><img style="width:20px;border: solid 1px;border-radius: 5px;" src="../img/refresh.png"></span>
                           <?php } ?> 
                          
                      </strong>
                      <div class="take-away-quee-box-time"><span>#<?=$result_cat_s_tc['tp_platform_id']?></span></div>
                     
                    </div>
                
                   <div class="take-away-quee-box-time"><img src="img/cst.png" alt=""> : <span> <?=$result_cat_s_tc['tor_customer']?></span></div>
                    <div class="take-away-quee-box-time"><img src="img/phn.png" alt=""> : <span> <?=$result_cat_s_tc['tor_phone']?></span></div>
                     <div class="take-away-quee-box-time"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['tor_city']?></span></div>
                     
                      <div class="take-away-quee-box-time"><img src="img/amt.png" alt=""> : <span> <?=number_format($result_cat_s_tc['td_payable_amount'],$_SESSION['be_decimal'])?></span></div>
                      <div class="take-away-quee-box-time" style="color: darkred;font-weight: bold"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['td_date']?></span></div>
                      
         <div  class="online_acpt_btn_new" id="confirm_msg_<?=$result_cat_s_tc['td_order_id']?>"  style="width:100% !important;background-color: #63745d ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer;display: none ">CONFIRMED</div>         
                      
           
                    <?php if($result_cat_s_tc['td_order_local_accepted']=="N" && $mins < 15  && $bill_ta=='' ){   ?>
                          
                     <div id="accept_btn_<?=$result_cat_s_tc['td_order_id']?>" class="online_acpt_btn_new" onclick="confirm_order('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>','<?=$result_cat_s_tc['td_channel']?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_customer'])?>',' <?=$result_cat_s_tc['tor_phone']?>','<?=$addr?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_landmark'])?>','<?=preg_replace("/[^A-Za-z0-9 ]/", '', $result_cat_s_tc['tor_sublocality'])?>','<?=$result_cat_s_tc['tor_tag']?>','<?=$result_cat_s_tc['tp_platform_id']?>' );"  style="background-color: #659465 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">Accept  </div> 
                   <?php  }  ?>
                   
                   
                     
                     
                       <?php if($result_cat_s_tc['td_order_local_accepted']=="N" &&  $mins < 15  && $bill_ta=='' ){   ?>
                     
                      <div  class="online_acpt_btn_new" id="cancel_btn_<?=$result_cat_s_tc['td_order_id']?>" onclick="cancel_order_status('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>','<?=$result_cat_s_tc['td_channel']?>' );"  style="background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CANCEL</div>  
                     
                     
                     <?php  }  ?>
                      
                      
                     
                      
                      
                      <?php if($result_cat_s_tc['td_order_local_accepted']=="Y" && $result_cat_s_tc['td_local_status']!="Food Ready"  ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn_<?=$result_cat_s_tc['td_order_id']?>" onclick="ready_order_urban('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>' );"  style="width:100% !important;background-color: darkred ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">READY</div>  
                     
                       <?php  }else{ ?>
                     
                     
                     <?php  if($result_cat_s_tc['td_order_local_accepted']=="Y"  ){ ?>
                     <div  class="online_acpt_btn_new" id="ready_msg_btn"  style="width:100% !important;background-color: darkolivegreen ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">ORDER READY</div>            
                      <?php  }  ?>
                     
                       <?php  } ?>
                       
                       
                       
                       
                       <?php if($mins >15 && $result_cat_s_tc['td_order_local_accepted']=='N' ){
                       ?>  <div  class="online_acpt_btn_new"   style="width:100% !important;background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">ORDER TIMEOUT</div>             <?php
                              }
                       
                       ?>
            
                        
                      <div   class="take-away-quee-box-head" > 
                       
                        <?php if($result_cat_s_tc['td_order_local_accepted']=="Y"){   ?>
                      <span title="<?=$kot_ta?>" style="float:right;margin-right: 110px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white " class="odr_item_view_btn " onclick="print_urban_kot('<?=$kot_ta?>','<?=$bill_ta?>');">KOT</span>
                      <span title="<?=$bill_ta?>" style="float:right;margin-right: 65px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white" class="odr_item_view_btn" onclick="print_urban_bill('<?=$bill_ta?>');">BILL</span>
                      <?php } ?> 
                      
                      <span class="odr_item_view_btn" style="background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white;margin-right: 5px" onclick="load_urban_items('<?=$result_cat_s_tc['td_order_id']?>','<?=$result_cat_s_tc['td_store_id']?>');">INFO</span>
                   
                    </div>
                       
                       
                       
                  
                 </div>
            
<?php


 } }else{
    
    ?>
    
    <span style="margin-left: 0%;padding-top: 30%;color: red;margin-top: 0px;" >NO ORDERS FOUND</span> 
    
    <?php
    
   }

?>
            
        </div>
        
        
      </div>    
</div>



    <div class="new_item_sm_pop_sec" id="urban_item_div" style="display:none" >
	<div class="new_item_sm_pop">
			<div class="new_item_sm_pop_head">View Items
                            <a onclick="close_list_items()" href="#"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>

			</div>
			<div class="new_item_sm_pop_cnt">
				<table>
					<thead>
						<tr>
						<th>Name</th>
						<th>Qty</th>
                                            <th>Amount</th>
                                            <th>Total</th>
						</tr>
					</thead>
                                        <tbody id="load_data_item">
						
						
						
						
					</tbody>
				</table>
			</div>
		
	</div>
</div>



    <div class="cancel_reason_popup_sec" style="display:none">
   <div class="cancel_reason_popup">
      <div class="cancel_reason_popup_head">
          CANCEL REASON  
          <a onclick="cancel_order_close()" href="#"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>
      </div>
      <div class="cancel_reason_popup_cnt">
          <div class="reson_select_drp">
              <select class="reson_select_sec_option" id="cancel_reason">
                    <option value="">SELECT REASON</option>
                  <option value="item_out_of_stock">Item_out_of_stock</option>
         
 <option value="store_closed">Store_closed</option>
 <option value="store_busy">Store_busy</option>
 <option value="rider_not_available">Rider_not_available</option>
 <option value="out_of_delivery_radius">Out_of_delivery_radius</option>
 <option value="connectivity_issue">Connectivity_issue</option>
 <option value="total_missmatch">Total_missmatch</option>
 <option value="invalid_item">Invalid_item</option>
 <option value="option_out_of_stock">Option_out_of_stock</option>
 <option value="invalid_option">Invalid_option</option>
 <option value="unspecified">Unspecified</option>
              </select>
          </div>
      </div>
       <div class="reson_select_sec_btn_row" onclick="cancel_order_status_ok();">
          <div  class="reson_sub_btn">SUBMIT</div>
      </div>
   </div>
</div>



<div style="display:none" class="confrmation_overlay_auth"></div>

 <div class="main_loader_sec" style="display: none;width: 100%;height:100%;position: fixed;left:0;top:0;background-color:rgba(0,0,0,0.5);z-index: 999;text-align:center;padding-top:20%">
     <img src="../img/ajax-loaders/pls_wait.gif" style="width: 150px;" alt="">
  </div>
  <audio id="urbanAudio"><source src="../urban.ogg" type="audio/ogg"></audio>
</body>
</html>
<!-- <meta http-equiv="refresh" content="2">-->