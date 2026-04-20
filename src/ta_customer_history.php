<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
$date_given=explode("-",$_SESSION['date']);	
$days_in_month=cal_days_in_month(CAL_GREGORIAN,$date_given[1],$date_given[0]);
 $month_set=$date_given[1];//date('m');//date("M", strtotime(date('m')));
 $year_set=$date_given[0];//=date("Y");
 $day_set=$date_given[2];//date("d");

$today=$day_set."-".$month_set."-".$year_set;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TA Customer History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/customer_history.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/takeaway_custhist.js"></script> 

<script type="text/javascript">
$(document).ready(function() {
	$("#billlisttotal" ).load( "pagination_functions.php?value=load_custhis"); //load initial records
	
	//executes code below when user click on pagination links
	$("#billlisttotal").on( "click", ".pagination a", function (e){
		e.preventDefault();
		//$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		$("#billlisttotal").load("pagination_functions.php",{"value":'load_custhis',"page":page}, function(){ //get content from PHP page
			//$(".loading-div").hide(); //once done, hide loading element
		});
		
	});
});
</script>
<!--<style>
.ui-autocomplete{z-index:999999 !important;}</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#search_guest').autocomplete({source:'pagination_functions.php?value=load_custhis&type=guest', minLength:1});
			$('#search_code').autocomplete({source:'pagination_functions.php?value=load_custhis&type=code', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />-->



<!--ESC Key press starts-->
 <!-- <link rel="stylesheet" href="css/jquery-ui.css">-->
  <!--<script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">-->
 <script>
/* $(document).ready(function() {
  $("#datepicker").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
 });*/
 function updatebillby_date(typ)
 {
	 if(typ=="TA")
	{
		 $('#datepicker_ta').val($('#datehid').val());
	}
	else if(typ=="HD")
	{
		 $('#datepicker_ho').val($('#datehid').val());
	}
	else if(typ=="CS")
	{
	 	 $('#datepicker_cs').val($('#datehid').val());
	}
	var dt=$('#datehid').val();
	 var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  //alert(dateset);
	 $.post("load_ta_total_billhistory.php", {datefield:dateset,value:'loadtahistory_date_ta',type:typ},
				  function(data)
				  {
				  	data=$.trim(data);
					if(typ=="TA")
					  {
						   $('#billlisttotal_ta').html(data);
					  }
					   if(typ=="HD")
					  {
						   $('#billlisttotal_ho').html(data);
					  }
					   if(typ=="CS")
					  {
						  $('#billlisttotal_cs').html(data);
					  }
				  	
				  });
	 
 }
 
 function datechange(val)
{
	
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
		 /*var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }billno:billno,*/
		  $.post("load_ta_cust_history.php", {datefield:dateset,value:'loadtacusth_date_ta'},
				  function(data)
				  {
				  	data=$.trim(data);
					
						   $('#billlisttotal').html(data);
					 
				  	
				  });
}
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
.bill_history_details_table {min-height: 435px;height: 70vh;overflow:visible;}
.top_site_map_cc  .new_right_drop{display:none}
.new_right_drop{margin-top:-8px;}
.left_detail_scroll{min-height: 365px;height: 65vh;}
.left_bill_history_contain{overflow:visible;}
.pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
               	
                 
                   <div style="width: 20% !important;" class="bill_history_head">Total TA Customer History</div>
                
            <?php if(in_array("Take Away", $_SESSION['menumodarray'])){ ?>  
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>take_away_.php  <?php }else {  ?>#<?php } ?>"><div class="bill_his_back_btn">Back</div></a>
                 <?php } ?>   
                

                <div class="top_al_search_cc loaderror" ></div>
            </div><!--top_site_map_cc-->
            
            
                      
            
      			<div style="min-height:480px;width:100%" class="left_contant_container">
                      <div class="left_bill_history_contain">
                          <div class="bill_number_head">
                           Guest Details
                              <div style="float:left;text-align:center;width:100%;">
                             
                                  <?php
                    
					$datev=explode("-",$_SESSION['date']);
					$sesdate=$datev[2]."-".$datev[1]."-".$datev[0];
					?>
                    <input type="hidden" name="datehid" id="datehid" value="<?=$sesdate?>"> 
                                   <!--<input value="<?=$today?>" type="text" id="datepicker" name="datepicker" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 7px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange()">-->
                  
                              </div>
                              <!--<a class="updatestock update_billdetails" style="display:block"></a>-->
                          </div>
                          
                          <div class="guest_detail_filter">
                          	   <div class="guest_filter_contain" style="width:60%">
                               		<div class="left_filter_name">Guest Name</div>
                                    <input type="text" name="search_guest" placeholder="Guest Name" class="guest_filter_textbox" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()" id="search_guest" onChange="validateSearch_cs()">
                               </div>
                               <div class="guest_filter_contain">
                               		<div class="left_filter_name">Mobile</div>
                                    <input type="text" name="search_code" placeholder="Enter Mobile" class="guest_filter_textbox" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()"  id="search_code" onChange="validateSearch_cs()">
                               </div>
                          </div>
                          
                          
                          <div class="bill_history_details_table">
                              <table style="width:100%">
                                  <tbody>
                                      <tr>
                                      	  <th width="10%">SlNo</th>
                                          <th width="50%">Guest Name</th>
                                          <th width="40%">Mobile No</th>
                                      </tr>
                                  </tbody>
                              </table>
                              <div id="billlisttotal"> 
                              <div  class="left_detail_scroll">
                                  <table class="new_fnt" width="100%" border="0">
                                      <!----bill_history_active--->
                                      <tbody>
                                      <?php //tab_billno
						/*$sql_bilhis="select distinct tab_customername,tab_customermobile from tbl_takeaway_billmaster where tab_customername<>'' OR tab_customermobile<>'' order by tab_customername";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);$i=1;
						if($num_bilhistory)
						{
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{*/
									?>
                                         <!--<tr class="custhistory_eachs" mode="1" cname="<?=$result_bilhistory['tab_customername']?>" cmob="<?=$result_bilhistory['tab_customermobile']?>"><!--class="bill_history_active "-->
                                         <!-- <td width="10%"><?=$i++?></td>
                                         	<td width="50%"><?=$result_bilhistory['tab_customername']?></td>
                                            <td width="40%"><?=$result_bilhistory['tab_customermobile']?></td>
                                         </tr>-->
                                       <?php //} } ?>
                                        <?php //tab_billno
										//`tbl_takeaway_customer`(`tac_customerid`, `tac_customername`, `tac_contactno`, `tac_address`, `tac_landmark`, `tac_area`, `tac_branchid`, `tac_per_address`
						$sql_bilhis="select distinct tac_customername,tac_contactno from tbl_takeaway_customer where tac_customername<>'' OR tac_contactno<>'' order by tac_customername";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									?>
                                         <tr class="custhistory_eachs" mode='2' cname="<?=$result_bilhistory['tac_customername']?>" cmob="<?=$result_bilhistory['tac_contactno']?>"><!--class="bill_history_active "-->
                                         <td width="10%"><?=$i++?></td>
                                         	<td width="50%"><?=$result_bilhistory['tac_customername']?></td>
                                            <td width="40%"><?=$result_bilhistory['tac_contactno']?></td>
                                         </tr>
                                       <?php } } ?>
                                         
                                      </tbody>
                                  </table>
                              </div>
                             <!-- <div class="ta_cumstomer_pagination_cc">
                              	<ul class = "pagination">
                                   <li><a href = "#">&laquo;</a></li>
                                   <li><a href = "#">1</a></li>
                                   <li><a href = "#">2</a></li>
                                   <li><a href = "#">...</a></li>
                                   <li><a href = "#">9</a></li>
                                   <li><a href = "#">10</a></li>
                                   <li><a href = "#">&raquo;</a></li>
                                </ul>
                              </div>-->
                              </div>
                          </div>
                          <!--bill_history_details_table--->
                  
                      </div>
                      <!--left_bill_history_contain-->
                  
                      <div class="bill_history_center_bill" style="position:relative;">
                          <div class="bill_number_head">Details</div>
                  			<div class="bill_history_orderd_cont">
                         		<div class="bill_user_detail_cc loadcustdetails">
                                	
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
                              <div class="load_ta_billdetails">
                                  <div class="bill_detail_table_data ">
                                    
                                  </div>
                                  <div class="table_detail_new_total">
                                       <!-- <div class="table_detail_new_total_txt">Total Rate : <strong>1200/-</strong></div>-->
                                  </div><!--table_detail_new_total-->
                         	  </div>
                          </div>
                          <!--bill_history_center_bill-->
                    
                          </div>
                          <!--bill_history_center_bill-->
                  
                  
                      <div class="bill_history_right_detail ">
                  
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
                  		<div class="load_ta_billeach_det refload">
                          
                 		</div>
                      </div>
                      <!--bill_history_right_detail-->
                  
                  
                               
                        </div>
                        <!--bill_history_details_table-->
                  
                  
                      </div>
                      <!--left_contant_container-->
                  
                  
                  
                  </div><!--left_contant_container-->
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->




</body>

</html>

 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 
  <script type="text/javascript">
function validateSearch_cs()
{//search_guest search_code

  var search_guest=$("#search_guest").val();
  if(search_guest=="")
  {
	  search_guest="null";
  }
  var search_code=$("#search_code").val();
  if(search_code=="")
  {
	  search_code="null";
  } 
  //pagination_functions.php?value=load_custhis&type=guest 
 // alert(search_guest)
  //alert(search_code)
  $.ajax({
		type: "POST",
		url: "pagination_functions.php",
		data: "value=load_custhis&search_guest="+search_guest+"&search_code="+search_code+"&mode=2",
		success: function(msg)
		{//alert(msg);
			$('#billlisttotal').html(msg);
		}
	});  
}
</script>
