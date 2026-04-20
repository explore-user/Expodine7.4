<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Total Bill History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/customer_history.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<!--ESC Key press starts-->
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
 <script>
 $(document).ready(function() {
  $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
 });
 </script>
<style>
body{font-family:inherit}
.left_contant_container {height: 80vh;padding-top:0}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.updatestock{
	width: 40px;
    height: 37px;
    float: right;
    background-image: url(img/update.png);
    background-repeat: no-repeat;
    background-position: center;
	position:absolute;
	cursor:pointer;
    left: 110px;
	top: 20px;
    margin-top: -16px;
	}
.billgenration_validate{width:35%;}
.top_site_map_cc{height: 35px;}

.left_bill_history_contain{background-color:#f5f5f5}
.bill_history_details_table td{color:#000;border: solid 1px #ccc;}
.bill_number_head{background-color: #AB2426;}
.bill_history_center_bill{background-color:#fff}
.bill_history_right_detail{background-color:#fff}
.bill_his_order_detail_head td{    background-color: #333;;border: solid 1px #ccc;}
.bil_his_dish_name, .bil_his_sl_no{color:#000;border: solid 1px #ccc;border-top: 0;padding: 1% 0;height:30px;line-height: 22px;}
.bill_history_close_btn{background-color: rgba(247, 146, 146, 0.5);}
.bill_history_orderd_cont{margin:0;min-height: 200px;height:35vh;}
.bill_story_center_top_txt{width:100%;height:20px;line-height:15px;display: inline-block;text-align: left;padding-left:5px}
.bill_story_center_txt{width:95%;height:30px;line-height:30px;padding-left:5px;border:solid 1px #ccc;display: inline-block;text-align: left;margin-bottom:5px;border-radius: 3px;background: #FFF7EB;}
.none_border_table td{border:none;padding-top:0px;}
.right_bill_history_detail{height:30px;margin-bottom:0}
.bill_story_center_txt{height: 26px;line-height: 26px;}
.bill_his_buton_cc, .bill_cancel_btn{text-align:center;padding-left: 0;border: solid 1px #ccc;}
.bill_cancel_btn{margin-right:2%;padding-top:0px;background-position: 10px 48%;width: 30%;position:relative;display:inline-block;float: none;}
.bill_story_center_txt{overflow:hidden;margin-bottom:1px;}
.bill_history_details_table {min-height: 445px;height:74vh }
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
               	
                 <?php include"includes/new_right_menu.php"; ?> 
                   <div class="bill_history_head">Total TA Bill History</div>
                
            <?php if(in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>  
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>payment_pending.php  <?php }else {  ?>#<?php } ?>"><div class="bill_his_back_btn">Back</div></a>
                 <?php } ?>  
                

                <div class="top_al_search_cc loaderror" ></div>
            </div><!--top_site_map_cc-->
            
            
                      
            
      			<div style="min-height:480px;width:100%" class="left_contant_container">
                      <div class="left_bill_history_contain">
                          <div class="bill_number_head">
                              <div style="float:left">
                                  
                                   <input value="<?=$today?>" type="text" id="datepicker" name="datepicker" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 7px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange()">
                  
                              </div>
                              <a class="updatestock update_billdetails" style="display:block"></a>
                          </div>
                          <div class="bill_history_details_table">
                              <table style="width:100%">
                                  <tbody>
                                      <tr>
                                          <th width="60%">Guest Name</th>
                                          <th width="40%">Mobile No</th>
                                      </tr>
                                  </tbody>
                              </table>
                              <div id="billlisttotal" class="left_detail_scroll">
                                  <table class="new_fnt" width="100%" border="0">
                                      <!----bill_history_active--->
                                      <tbody>
                                         <tr class="bill_history_active ">
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                         <tr>
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                         <tr>
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                         <tr>
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                         <tr>
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                         <tr>
                                         	<td width="60%">User 123</td>
                                            <td width="40%">9876543210</td>
                                         </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!--bill_history_details_table--->
                  
                      </div>
                      <!--left_bill_history_contain-->
                  
                      <div class="bill_history_center_bill" style="position:relative;">
                          <div class="bill_number_head">Details</div>
                  			<div class="bill_history_orderd_cont">
                         		<div class="bill_user_detail_cc">
                                	<table>
                                    	<tr>
                                        	<td><strong>Name :</strong></td>
                                            <td>Lorem Ipsum</td>
                                        </tr>
                                        <tr>
                                        	<td><strong>Last Name :</strong></td>
                                            <td>Lorem Ipsum Doler</td>
                                        </tr>
                                         <tr>
                                        	<td><strong>Date of Birth :</strong></td>
                                            <td>10/04/1990</td>
                                        </tr>
                                        <tr>
                                        	<td><strong>Status :</strong></td>
                                            <td>Lorem</td>
                                        </tr>
                                        <tr>
                                        	<td><strong>Email :</strong></td>
                                            <td>Lorem@gmail.com</td>
                                        </tr>
                                        <tr>
                                        	<td><strong>Profession :</strong></td>
                                            <td>Lorem Ipsum</td>
                                        </tr>
                                         <tr>
                                        	<td><strong>Address :</strong></td>
                                            <td>Lorem Ipsum</td>
                                        </tr>
                                    </table>
                                </div>
                        	</div><!--bill_history_orderd_cont-->
                  
                          
        
                           
                  
                  
                          <div style="position:relative;" class="bill_number_head">Bill Detail
                          </div>
                          <div class="settle_ment_change_history settlementdetails">
                              <div class="bill_his_order_detail_head">
                                  <table style="width:98.5%" class=" " border="0">
                                      <tbody>
                                          <tr>
                                              <td width="50%">Bill No</td>
                                              <td width="25%">Date</td>
                                              <td width="25%">Amount</td>
                      
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                              
                              <div class="bill_detail_table_data">
                              	<table class="table_detail_new_table" width="100%" border="0">
                                	<tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                    <tr>
                                    	<td width="50%">Bill-12504586</td>
                                        <td width="25%">10/02/2016</td>
                                        <td width="25%">120/-</td>
                                    </tr>
                                </table>
                              </div>
                              <div class="table_detail_new_total">
                              		<div class="table_detail_new_total_txt">Total Rate : <strong>1200/-</strong></div>
                              </div><!--table_detail_new_total-->
                         
                          </div>
                          <!--bill_history_center_bill-->
                    
                          </div>
                          <!--bill_history_center_bill-->
                  
                  
                      <div class="bill_history_right_detail">
                  
                          <div class="bill_number_head">Bill Order Details</div>
                          
                          <div class="bill_his_order_detail_head">
                              <table style="width:98.5%" class=" " border="0">
                                  <tbody>
                                      <tr>
                                          <td width="11.5%">Sl No</td>
                                          <td width="39.8%">Dish Name</td>
                                          <td width="15.6%">Portion</td>
                                          <td width="7.5%">Qty</td>
                                          <td width="12%">Rate</td>
                  
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                  
                          <div  class="bill_history_details_table">
                     			<table>
                               	   <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                    <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                    <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                    <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                   
                                    <tr class="bill_detail_head">
                                    	  <td colspan="5" width="100%">Bill-125024</td>
                                     </tr> 
                                         
                                    <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                    <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                     <tr>
                                    	  <td width="11.5%">1</td>
                                          <td width="39.8%">STRAWBERRY CHEESE CAKE</td>
                                          <td width="15.6%">Single</td>
                                          <td width="7.5%">2</td>
                                          <td width="12%">360/-</td>
                                    </tr>
                                </table>
                          </div>
                          <!--bill_history_details_table-->
                          <div class="table_detail_new_total">
                              	<div class="table_detail_new_total_txt">Total Rate : <strong>1200/-</strong></div>
                           </div><!--table_detail_new_total-->
                          
                  
                      </div>
                      <!--bill_history_right_detail-->
                  
                  
                               
                        </div>
                        <!--bill_history_details_table-->
                  
                  
                      </div>
                      <!--left_contant_container-->
                  
                  
                  
                  </div><!--left_contant_container-->
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->



 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
</body>

</html>