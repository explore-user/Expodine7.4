<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Take Away</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/bill_history.js"></script>
<script src="js/bill_reprint.js"></script>
<script src="js/bill_cancel.js"></script>
<!--ESC Key press starts-->
 
 
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
    right: 0px;
	top: 20px;
	    margin-right: 83%;
    margin-top: -16px;
	}

</style>
<script>
$(function() {

 /*************************************** cancel close click starts ******************************************************************  */
   $('.update_billdetails').click(function () {
		 var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }
		  $.post("load_bill_history.php", {billno:billno,set:'billwholeload'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#billlisttotal').html(data);
				  });
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
});
</script> 
</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
            	<ul>
					<li><a href="bill_generation_screen1.php" title=""><span class="home_icon"></span>\</a></li>
					<li><a title="">Bill History</a></li>
				</ul>
                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
      		<div style="  min-height:480px;width:100%" class="left_contant_container">
            	
                <div class="left_bill_history_contain">
                	<div class="bill_number_head">Bill Number<a class="updatestock update_billdetails" style="display:block"></a></div>
                      <div class="bill_history_details_table" id="billlisttotal">    
                		<table width="100%" class=" " border="0"> <!----bill_history_active--->
                        <?php
						$sql_bilhis="select bm_billno  from tbl_tablebillmaster WHERE bm_dayclosedate='".$_SESSION['date']."' ORDER BY bm_billdate,bm_billtime DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									?>
                          <tr class="bill_history_number " billno="<?=$result_bilhistory['bm_billno']?>">
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="41%"><?=$result_bilhistory['bm_billno']?></td>
                           </tr>
                           <?php } } ?>
                           
                         </table> 
              </div><!--bill_history_details_table---> 
                   
                </div><!--left_bill_history_contain-->
                
                <div class="bill_history_center_bill">
            	
                	<div class="bill_number_head">Bill Details</div>
                	<div class="bill_history_details_table" id="detailsset1">
                    	
                    </div><!--bill_history_details_table-->
                                        
            	</div><!--bill_history_center_bill-->
                
                <div class="bill_history_right_detail">
                	
                    	<div class="bill_number_head">Bill Order Dtails</div>
                      
                            <div class="bill_his_order_detail_head">
                                <table style="width:99%" class=" " border="0">
                                  <tr>
                                    <td width="13%">Sl No</td>
                                    <td width="45%">Dish Name</td>
                                    <td width="13%"><?=$_SESSION['s_portionname']?></td>
                                    <td width="13%">Qty</td>
                                      <td width="13%">Rate</td>
                                      
                                  </tr>
                                </table> 
                            </div>
                 
                        
                     <div class="bill_history_orderd_cont" id="billdetailsset2">
                    	
                        
                    </div><!--bill_history_orderd_cont-->
                    
                    <div class="bill_his_buton_cc">
                    	<div class="bill_cancel_btn" id="reprintbill"><a href="#">Reprint</a></div>
                        <div style="right:2%;left:inherit;background-image:url(img/cancel_bill.png)" class="bill_cancel_btn" id="cancelbill"><a href="#">Cancel</a></div>
                    </div><!--bill_his_buton_cc-->
                    
                </div><!--bill_history_right_detail-->
                
               		
                    
                
            </div><!--left_contant_container-->
            
         
    
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->


 <!----dock----> 
   <?php //include "includes/top_main_menu.php"; ?>
 <!----dock----> 


<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->  

 <div style="display:none" class="index_popup_1 closeoneclass">
 	<div class="index_popup_contant">Are you Sure you Want to Cancel This Bill?</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel">Cancel</a></div>
    </div>
 </div><!--index_popup_2-->
 
 <div style="display:none" class="confrmation_overlay"></div>
 <style>
 .confrmation_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
 .index_popup_1{
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
.index_popup_contant{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}		
.btn_index_popup{
	width:15%;
	display:inline-block;
	height:25px;
	line-height:25px;
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

	</style>


</body>

</html>