 <?php 
session_start();
  include("../database.class.php");
$database	= new Database();
error_reporting(0);

$date=date('Y-m-d');


$store_urban=''; $db_urban='';

$sql_login_dc  =  $database->mysqlQuery("select be_store_id,be_store_db from tbl_branchmaster "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $store_urban=$result_cat_s_tc['be_store_id'];
      $db_urban=$result_cat_s_tc['be_store_db'];
 }
}

$localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);



$total=0; $confirm=0; $cancel=0; $del=0;$accept=0; $pend=0; $dispatch=0; $assign=0;
 $sql_gen =  mysqli_query($localhost1,"select td_local_status,td_rider_status,td_webhook_status from tbl_order_details where date(td_date)='$date' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  { 
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                            $total++;
                            
                           if($result_cat_s_tc['td_local_status']=='Food Ready'){
                               $confirm++;
                           }         
                                    
                                    
                           if($result_cat_s_tc['td_local_status']=='Cancelled' || $result_cat_s_tc['td_webhook_status']=='Cancelled'  ){
                               $cancel++;
                           }  
                           
                           
                           if($result_cat_s_tc['td_rider_status']=='Delivered'){
                               $del++;
                           }  
                           
                             if($result_cat_s_tc['td_local_status']=='Acknowledged'){
                               $accept++;
                           }  
                           
                           if($result_cat_s_tc['td_local_status']=='' &&  $result_cat_s_tc['td_webhook_status']!='Cancelled'){
                               $pend++;
                           }  
                           
                           
                            if($result_cat_s_tc['td_webhook_status']=='Dispatched'){
                               $dispatch++;
                           }  
                           
                           if($result_cat_s_tc['td_rider_status']=='Assigned'){
                               $assign++;
                           }  
                           
                           
                           
                                }
                                }



?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Order History</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
    

.acc_table_scroll thead {
    width: 100%;
    display: block;
    padding-right:19px;
    background-color: #191919;
}
.acc_table_scroll tr {
    width: 100%;
    display: inline-table;
}
.acc_table_scroll tbody {
    height: 60vh;
    min-height: 360px;
    overflow-y: scroll;
    width: 100%;
    display: inline-block

}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="js/jquery-1.10.2.js"></script>




<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:70vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.acc_table_scroll tbody {height: 65vh;}
.odr_dtl_count_sec{width: 100%;height:auto;float:left;padding:10px}
.odr_dtl_count_box{width: 11%;height:70px;border-radius:5px;border:solid 1px #ccc;text-align:center;font-size:22px;color:#242424;float:left;margin-right:1%;font-weight:bold;    background-color: #ffe3e0;}
@media (max-width: 600px){
    .odr_dtl_count_box{width: 24%; margin-bottom:3px;}  
}
.odr_dtl_count_box span{color:#666;font-size:13px;width: 100%;height:auto;float:left;font-weight:normal;text-transform:uppercase}
.datepicker.dropdown-menu {
    top: 140px !important;
    bottom: inherit !important;
}
@media (max-width:1100px){
.odr_dtl_count_box span{font-size: 10px;}
.form-control{padding:8px 0px}
}

</style>


<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
  
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">


</head>
<body>
    
  <div class="main_loader_sec" style="display: none;width: 100%;height:100%;position: fixed;left:0;top:0;background-color:rgba(0,0,0,0.5);z-index: 999;text-align:center;padding-top:20%">
        <img src="img/loader.gif" style="width: 150px;" alt="">
  </div>
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">

<div class="mian">
	


<div class="top_site_map_cc new-sitemap-cc" style="width:100%">
      <div class="logo_container">
           <a href="../index.php"> <div class="logo"><img src="../img/logo20.png"></div></a>
        </div>
          <!-- <a  href="../index.php"  class="home_cio_online_odr">&nbsp; &nbsp;  Home &nbsp;  &nbsp; </a> -->
         
      
      </div>
                
            

                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <div class="row">
                                    <div class="col-md-4">
                                    <h3 class="ledger_head" style="margin-bottom:10px">
                                   <a href="online_order_screen.php"> <img src="../img/thin_left_arrow_333.png" alt=""></a>

                                   ORDER HISTORY  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 20px;background-color: #ff4229;border-radius: 5px "></span></h3>

                              
                                
                                
                                <div class="acc_add_box" style="width:20%;position:relative;">
                             	   
                                    <input style="font-size: 10px;font-weight: bold" type="text" class="form-control filte_new_box " maxlength="15" value="<?=$date?>" onchange="search_order()" id="order_date_search" name="" placeholder="Date">
                                </div>
                                
                                     <div class="acc_add_box" style="width:20%;">
                                         
                             	    <input style="font-size: 10px;font-weight: bold" type="text" class="form-control filte_new_box" id="agg_id_search"  onkeyup="search_order()" name="" placeholder="Order Id">
                                                       </div>   
                                    
                                    
                                    <div class="acc_add_box" style="width:20%;">
                                    <input style="font-size: 10px;font-weight: bold" type="text" class="form-control filte_new_box" id="order_id_search"  onkeyup="search_order()" name="" placeholder="Urb Id">
                                </div>     
                                  
                                        
                                  <div class="acc_add_box" style="width:20%;">
                             	   
                                   <select style="font-size: 10px;font-weight: bold" class="form-control filte_new_box" onchange="search_order();" id="order_channel_search">
                  <option value="">All Channel</option>
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
                                        
                                        
                                        
                                        
                                        
                                    <div class="acc_add_box" style="width:20%;">
                             	   
                                    <select style="font-size: 10px;font-weight: bold" class="form-control filte_new_box" id="order_sts_search"  onchange="search_order()" >
                                        
                                        <option value="">Status All</option>
                                         <option value="not_accept">Not Accepted</option>
                                        <option value="Acknowledged">Accepted</option>
                                        <option value="Food Ready">Food Ready</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Delivered">Delivered</option>
                                        
                                    </select>
                                  </div>       
                                        
                                    </div>

                                    <div class="col-md-8">

                                            <div class="odr_dtl_count_sec">
                                                    <div class="odr_dtl_count_box">
                                                        <strong id="tot_order_live">   <?=$total?>  </strong>
                                                        <span>Today's Orders</span>
                                                    </div>
                                                
                                                  
                                                    <div class="odr_dtl_count_box">
                                                      <strong id="pending_order_live">  <?=$pend?> </strong>
                                                        <span>Not Accepted </span>
                                                    </div>
                                                
                                                 <div class="odr_dtl_count_box">
                                                      <strong id="accept_order_live">  <?=$accept?> </strong>
                                                        <span>Accepted </span>
                                                    </div>
                                                
                                                
                                                    <div class="odr_dtl_count_box">
                                                      <strong id="foodready_order_live">  <?=$confirm?> </strong>
                                                        <span>Food Ready</span>
                                                    </div>
                                                    <div class="odr_dtl_count_box">
                                                         <strong id="cancel_order_live"> <?=$cancel?> </strong>
                                                        <span>Cancelled</span>
                                                    </div>
                                                
                                                
                                                 <div class="odr_dtl_count_box">
                                                     <strong id="dispatch_order_live">   <?=$dispatch?> </strong>
                                                        <span>DISPATCHED</span>
                                                    </div>
                                                
                                                <div class="odr_dtl_count_box">
                                                     <strong id="assigned_order_live">   <?=$assign?> </strong>
                                                        <span>Assigned</span>
                                                    </div>
                                                
                                                
                                                 <div class="odr_dtl_count_box">
                                                     <strong id="delivered_order_live">   <?=$del?> </strong>
                                                        <span>Delivered</span>
                                                    </div>
                                            </div>
                                        
                                    </div>   
                                </div>
                               
                         
                             </div>
                            
                            <div class="ledger_list_sec" style="position:relative">
                                <!-- <h3 style="font-size:18px" class="ledger_head"> &nbsp;</h3> -->
                                <div style="display:none;position:absolute;width: 120px;right:9px;top:3px;height: 33px;float: left" class="search_btn_member_invoice filte_new_box_btn">
                                   
                                    <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;display: none" onclick="return pop_on();" href="#">ADD PAYMENT</a></div>
                             
                                <div class="ledger_list_scr" style="overflow:auto;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">SL</td>
                                                  <td style="width:10%">Order Id</td>
                                                <td style="width:10%">Urb ID</td>
                                                  <td style="width:10%">Channel</td>
                                                <td style="width:15%">Order Time</td>
                                                 <td style="width:15%">Amount</td>
                                                 <td style="width:15%">Online  Status</td>
                                                  <td style="width:15%">Pos Status</td>
                                                   <td style="width:10%">Dispatch Status</td>
                                                <td style="width:15%">Delivery Status</td>
                                            </tr>
                                        </thead>
                                        <tbody id="load_acc_new">
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        
                                     </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
 
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->



<div class="new_item_sm_pop_sec" id="urban_item_div" style="display:none">
    <div class="new_item_sm_pop" >
			<div class="new_item_sm_pop_head">ORDER DETAILS
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

      
            <div class="md-overlay"></div><!-- the overlay element -->                       
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>
<link href="../loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
 <script src="../js/jquery-1.10.2.min.js"></script>  
 <script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>       
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../js/s"></script>
<script type="text/javascript" id="js">


$(document).ready(function() {
    
    $("#order_date_search").datepicker({
      changeMonth: true,
      changeYear: true,
       format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
    });
    
    
    var order_id=$('#order_id_search').val();
   var date=$('#order_date_search').val();
   var order_sts_search=$('#order_sts_search').val();
   var order_channel_search=$('#order_channel_search').val();
   
   var agg_id_search=$('#agg_id_search').val();
   
                        $.ajax({
			type: "POST",
			url: "load_data_urban.php",
			data: "set=load_order_search&order_id="+order_id+"&date="+date+"&status="+order_sts_search+"&channel="+order_channel_search+"&agg_id_search="+agg_id_search,
			success: function(msg)
			{ 
                            
                             $('#load_acc_new').html(msg);
                        }
                    });
    
    setInterval(function () {
       
         var order_id=$('#order_id_search').val();
   var date=$('#order_date_search').val();
   var order_sts_search=$('#order_sts_search').val();
   var order_channel_search=$('#order_channel_search').val();
       
       
                        $.ajax({
			type: "POST",
			url: "load_data_urban.php",
			data: "set=load_order_search&order_id="+order_id+"&date="+date+"&status="+order_sts_search+"&channel="+order_channel_search+"&agg_id_search="+agg_id_search,
			success: function(msg)
			{ 
                            
                            // $('#load_acc_new').html(msg);
                        }
                    });



           $.ajax({
			type: "POST",
			url: "load_data_urban.php",
			data: "set=load_order_today&order_id=&date="+date+"&status=&channel=",
			success: function(msg)
			{
                           var sts1=$.trim(msg);
                           
                           var sts=sts1.split('*');
                           
                           
                           $('#tot_order_live').text(sts[0]); 
                            $('#pending_order_live').text(sts[1]); 
                            $('#foodready_order_live').text(sts[3]); 
                            $('#cancel_order_live').text(sts[2]); 
                             
                              $('#accept_order_live').text(sts[4]); 
                             
                                $('#assigned_order_live').text(sts[7]); 
                                 $('#delivered_order_live').text(sts[8]); 
                                    $('#dispatch_order_live').text(sts[6]); 
                               
                               
                        }
                    });

    
     }, 10000);
     
     
     

  
   
   
}); 

function close_list_items(){
         $('#urban_item_div').hide();
         $('#load_data_item').html('');
     }
     
function order_detail_view(ord){
    
   $('.main_loader_sec').show();
    var datastringnewcard="set=list_urban_order&order_id="+ord;
       
        $.ajax({
        type: "POST",
        url: "load_data_urban.php",
        data: datastringnewcard,
        success: function(data)
        {      
          $('.main_loader_sec').hide();
        $('#urban_item_div').show();
        $('#load_data_item').html(data);
      
        }  
       });
}

function search_order(){
  
    var order_id=$('#order_id_search').val();
   var date=$('#order_date_search').val();
   var order_sts_search=$('#order_sts_search').val();
   var order_channel_search=$('#order_channel_search').val();
   
   var agg_id_search=$('#agg_id_search').val();
   
                        $.ajax({
			type: "POST",
			url: "load_data_urban.php",
			data: "set=load_order_search&order_id="+order_id+"&date="+date+"&status="+order_sts_search+"&channel="+order_channel_search+"&agg_id_search="+agg_id_search,
			success: function(msg)
			{ 
                            
                             $('#load_acc_new').html(msg);
                        }
                    });
}


</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
