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
<title> Total Bill History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/total_take_away_bill_history.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<!--<script src="js/load_ta_total_billhistory.js"></script> -->
<!--ESC Key press starts-->
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
 <script>
 $(document).ready(function() {
  $("#datepicker_ta").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	$("#datepicker_ho").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	$("#datepicker_cs").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	 /*************************************** cancel close click starts ******************************************************************  */
   $('.update_billdetails').click(function () {
	  //checkday checkmonth checkyear
	  // var dateset=$('#checkyear').val() +"-"+ $('#checkmonth').val() +"-"+ $('#checkday').val();
	 // var dt=$('#datepicker').val();
	  //var res = dt.split("-");
	  //var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	/*  $('#datepicker').val($('#datehid').val());
		 var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }
		  $.post("load_ta_history.php", {billno:billno,value:'billwholeload_ta'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#ta_billlisttotal').html(data);
				  });*/
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
	
 });
 
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
	  //alert(typ);
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
	var dt;
	if(val=="TA")
	{
		 dt=$('#datepicker_ta').val();
	}
	else if(val=="HD")
	{
		 dt=$('#datepicker_ho').val();
	}
	else if(val=="CS")
	{
	 	 dt=$('#datepicker_cs').val();
	}
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
		 /*var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }billno:billno,*/
		  $.post("load_ta_total_billhistory.php", {datefield:dateset,value:'loadtahistory_date_ta',type:val},
				  function(data)
				  {
				  	data=$.trim(data);
					if(val=="TA")
					  {
						   $('#billlisttotal_ta').html(data);
					  }
					   if(val=="HD")
					  {
						   $('#billlisttotal_ho').html(data);
					  }
					   if(val=="CS")
					  {
						  $('#billlisttotal_cs').html(data);
					  }
				  	
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
    float: left;
    background-image: url(img/update.png);
    background-repeat: no-repeat;
    background-position: center;
    /* position: absolute; */
    cursor: pointer;
    /* left: 110px; */
    /* top: 20px; */
    margin-top: -4px;
    margin-left: -80px;
	}
.billgenration_validate{width:35%;}
.top_site_map_cc{height: 35px;}

.left_bill_history_contain{background-color:#fff;min-width: 240px}
.bill_history_details_table td{color:#000;border: solid 1px #BDBDBD;}
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
.bill_history_details_table {min-height: 445px;height:74vh}
.top_site_map_cc  .new_right_drop{display:none}
.new_right_drop{margin-top:-8px;}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>
     
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
               	
                   <div class="bill_history_head"> BILL HISTORY</div>
                
            <?php if(in_array("Take Away", $_SESSION['menumodarray'])){ ?>  
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>take_away_.php  <?php }else {  ?>#<?php } ?>"><div class="bill_his_back_btn">Back</div></a>
                 <?php } ?>  
                

                <div class="top_al_search_cc loaderror" ></div>
            </div><!--top_site_map_cc-->
                 <?php
                    
					$datev=explode("-",$_SESSION['date']);
					$sesdate=$datev[2]."-".$datev[1]."-".$datev[0];
					?>
                    <input type="hidden" name="datehid" id="datehid" value="<?=$sesdate?>">     
            
      		       <div style="min-height: 85vh; width: 100%; display: flex;" class="left_contant_container">
            
                       <div class="left_bill_history_contain" style="width: 24%">
                       <div class="bill_number_head" style="color:white;font-weight: bold;">
                           DINE IN <img src="img/bill-icon.png" style="margin-top: -5px;width: 35px;" >
                       <div style="float:left;display: none">
                              
                       <input value="<?=$today?>" type="text" id="datepicker_ta" name="datepicker_ta" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 1px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange('TA')">
                  
                      </div>
                       <a class="updatestock update_billdetails" style="display:block;" onClick="updatebillby_date('TA')"></a>
                      </div>
                       <?php
					   $del_ta1='0';$pack_ta1='0';$gen_ta1='0';$prcs_cs1='0';$bill_sts__ta1='0';
					   
					   $sql_bilhis="select count(bm_billno) as ct,bm_status  from tbl_tablebillmaster WHERE bm_dayclosedate='".$_SESSION['date']."'  group by bm_status ORDER BY bm_billdate,bm_billtime DESC";
						
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									if($result_bilhistory['bm_status']=="Processing")
									$prcs_cs1=$result_bilhistory['ct'];
									if($result_bilhistory['bm_status']=="Closed")
									$del_ta1=$result_bilhistory['ct'];
									if($result_bilhistory['bm_status']=="Packed")
									$pack_ta1=$result_bilhistory['ct'];
									if($result_bilhistory['bm_status']=="Kot_Generated")
									$gen_ta1=$result_bilhistory['ct'];
                                                                        if($result_bilhistory['bm_status']=="Billed")
									$bill_sts__ta1=$result_bilhistory['ct'];
								}
						}
									?>
                      <div class="total_count_ta_cc">
                      		<div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Closed : <?=$del_ta1?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                            
                           
                            <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Served : <?=$gen_ta1?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                             <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Billed : <?=$bill_sts__ta1?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                      </div>
                            
                            
                            
                      <div class="bill_history_details_table">
                          <table style="width:100%">
                              <tbody>
                                  <tr>
                                      <th width="8%">
                                           Sl</th>
                                       <th width="40%">
                                          <input type="text" class="take_away_search_box" placeholder="Bill No" name="search_billno_ta" id="search_billno_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none"> Bill No</th>
                                      <th width="25%">
                                          <input type="text" class="take_away_search_box" placeholder="Name" name="search_name_ta" id="search_name_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none">  Amount</th>
                                      <th width="20%">
                                          <input type="text" class="take_away_search_box" placeholder="No" name="search_no_ta" id="search_no_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none"> Mode</th>
                                      <th width="14%">
                                          <input type="text" class="take_away_search_box" placeholder="Status" name="search_status_ta" id="search_status_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none"> Status
                                      </th>
                                </tr>
                              </tbody>
                          </table>
                          <div id="billlisttotal_ta" class="left_detail_scroll">
                              <table class="new_fnt" width="100%" border="0">
                                
                                  <tbody>
                                   <?php
						$tot_di=0; $mode='';
						 $sql_bilhis= "select bm_paymode, bm_billno,bm_status ,bm_finaltotal from tbl_tablebillmaster WHERE bm_dayclosedate='".$_SESSION['date']."'   ORDER BY bm_billdate,bm_billtime DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
                                                            
                                                            
                                                            if($result_bilhistory['bm_paymode']=='1'){
                                                                
                                                                $mode='Cash';
                                                            }else if($result_bilhistory['bm_paymode']=='2'){
                                                                
                                                                $mode='Card';
                                                            }else if($result_bilhistory['bm_paymode']=='6'){
                                                                
                                                                $mode='Credit';
                                                            }else if($result_bilhistory['bm_paymode']=='7'){
                                                                
                                                                $mode='Comp';
                                                            }else{
                                                                
                                                               $mode='';  
                                                            }
                                                            
                                                            
                                                            
                                                            
                                                            $tot_di=$tot_di+$result_bilhistory['bm_finaltotal'];
									?>
                                   
                            <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['bm_billno']?>">
                            <td width="8%"><strong><?=$i++?></strong></td>
                            <td width="40%"><a href="bill_history.php?bilno=<?=$result_bilhistory['bm_billno']?>#<?=$result_bilhistory['bm_billno']?>"><?=$result_bilhistory['bm_billno']?></a></td>
                             <td style="font-size:11px" width="25%"><?=$result_bilhistory['bm_finaltotal']?></td>
                             <td style="font-size:10px" width="20%"><?=$mode?></td>
                             <td style="font-size:10px" width="14%"  ><?=$result_bilhistory['bm_status']?></td>
                             
                                      </tr>
                                     <?php }  ?>
                                      
                                      
                            <tr class="bill_history_number">
                            <td width="8%"></td>
                            <td width="27%">Total</td>
                             <td style="font-size:11px" width="31%"><?=number_format($tot_di,$_SESSION['be_decimal'])?></td>
                             <td style="font-size:10px" width="20%"></td>
                             <td style="font-size:10px" width="14%"  ></td>
                             
                                      </tr> 
                                      
                                      
                                <?php }else{ ?>
                             
                            <tr class="bill_history_number">
                            
                             <td style="font-size:11px;font-weight: bold" width="31%">NO DATA</td>
                             
                             </tr>  
                              <?php }  ?>      
                                      
                                  </tbody>
                              </table>
                          </div>
                      </div>
                     
                  </div>
                            
                            
                            
                      <div class="left_bill_history_contain" style="margin-left: 13px;width: 24%">
                      <div class="bill_number_head" style="color:white;font-weight: bold;" >
                    TAKEAWAY <img src="img/bill-icon.png" style="margin-top: -5px;width: 35px;" >
                          <div style="float:left;display: none">
                              
                               <input value="<?=$today?>" type="text" id="datepicker_ta" name="datepicker_ta" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 1px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange('TA')">
                  
                          </div>
                       <a class="updatestock update_billdetails" style="display:block;" onClick="updatebillby_date('TA')"></a>
                      </div>
                       <?php
					   $del_ta='0';$pack_ta='0';$gen_ta='0';$prcs_cs='0';$bill_sts__ta='0';
					   
					   $sql_bilhis="select count(tab_billno) as ct,tab_status  from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."' and tab_mode='TA' group by tab_status ORDER BY tab_date,tab_time DESC";
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' and tab_mode='TA' ORDER BY 	tab_date,tab_time DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									if($result_bilhistory['tab_status']=="Processing")
									$prcs_cs=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Closed")
									$del_ta=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Packed")
									$pack_ta=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Kot_Generated")
									$gen_ta=$result_bilhistory['ct'];
                                                                        if($result_bilhistory['tab_status']=="Billed")
									$bill_sts__ta=$result_bilhistory['ct'];
								}
						}
									?>
                      <div class="total_count_ta_cc">
                      		<div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Closed : <?=$del_ta?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                            
                            
                             <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Billed : <?=$bill_sts__ta?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                            
                             <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head"> Processing : <?=$prcs_cs?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                      </div>
                            
                            
                            
                      <div class="bill_history_details_table">
                          <table style="width:100%">
                              <tbody>
                                  <tr>
                                      <th width="8%">
                                           Sl</th>
                                       <th width="40%">
                                          <input type="text" class="take_away_search_box" placeholder="Bill No" name="search_billno_ta" id="search_billno_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none"> Bill No</th>
                                      <th width="25%">
                                          <input type="text" class="take_away_search_box" placeholder="Name" name="search_name_ta" id="search_name_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none">  Amount</th>
                                      <th width="20%">
                                          <input type="text" class="take_away_search_box" placeholder="No" name="search_no_ta" id="search_no_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none">  Mode</th>
                                      <th width="14%">
                                          <input type="text" class="take_away_search_box" placeholder="Status" name="search_status_ta" id="search_status_ta" onKeyPress="validateSearch_ta()" onKeyDown="validateSearch_ta()" onKeyUp="validateSearch_ta()" style="color:#000;display: none"> Status
                                      </th>
                                  </tr>
                              </tbody>
                          </table>
                          <div id="billlisttotal_ta" class="left_detail_scroll">
                              <table class="new_fnt" width="100%" border="0">
                                
                                  <tbody>
                                   <?php $tot_ta=0; $mode='';
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' and tab_mode='TA' ORDER BY 	tab_date,tab_time DESC";
						 $sql_bilhis= "Select tb.tab_paymode,tb.tab_netamt,tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='TA'  AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' order by tb.tab_date,tb.tab_time DESC ";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
                                                            
                                                             if($result_bilhistory['tab_paymode']=='1'){
                                                                
                                                                $mode='Cash';
                                                            }else if($result_bilhistory['tab_paymode']=='2'){
                                                                
                                                                $mode='Card';
                                                            }else if($result_bilhistory['tab_paymode']=='6'){
                                                                
                                                                $mode='Credit';
                                                            }else if($result_bilhistory['tab_paymode']=='7'){
                                                                
                                                                $mode='Comp';
                                                            }else{
                                                                
                                                               $mode='';  
                                                            }
                                                            
                                                            
                                                            $tot_ta=$tot_ta+$result_bilhistory['tab_netamt'];
									?>
                                   
                                      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
                            <td width="8%"><strong><?=$i++?></strong></td>
                            <td width="40%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>#<?=$result_bilhistory['tab_billno']?>"><?=$result_bilhistory['tab_billno']?></a></td>
                             <td style="font-size:11px" width="25%"><?=$result_bilhistory['tab_netamt']?></td>
                             <td style="font-size:9px" width="20%"><?=$mode?></td>
                             <td style="font-size:10px" width="14%"  ><?=$result_bilhistory['tab_status']?></td>
                             
                                      </tr>
                             
                                     <?php }  ?>
                                       <tr class="bill_history_number">
                            <td width="8%"></td>
                            <td width="27%">Total</td>
                             <td style="font-size:11px" width="31%"><?=number_format($tot_ta,$_SESSION['be_decimal'])?></td>
                             <td style="font-size:10px" width="20%"></td>
                             <td style="font-size:10px" width="14%"  ></td>
                             
                                      </tr> 
                                  
                                    <?php }else{ ?>
                             
                            <tr class="bill_history_number">
                            
                             <td style="font-size:11px;font-weight: bold" width="31%">NO DATA</td>
                             
                             </tr>  
                              <?php }  ?>  
                                      
                                      
                                      
                                  </tbody>
                                  
                                  
                                  
                              </table>
                          </div>
                      </div>
                      <!--bill_history_details_table--->
                  
                  </div>
         
    			
                            
                            
                            
            
                 	<div class="left_bill_history_contain mrg_center" style="width: 24%;margin-left: 11px;">
                        <div class="bill_number_head" style="color:white;font-weight: bold;">
                      HOME DELIVERY <img src="img/bill-icon.png" style="margin-top: -5px;width: 35px;" >
                           <div style="float:left;display: none">
                              
                               <input value="<?=$today?>" type="text" id="datepicker_ho" name="datepicker_ho" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 1px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange('HD')">
                  
                          </div>
                          <a class="updatestock update_billdetails" style="display:block" onClick="updatebillby_date('HD')"></a>
                      </div>
                       <?php
					   $del_hd='0';$pack_hd='0';$gen_hd='0';$asg_hd='0';$cls_hd='0';$prcs_cs='0';
					   $sql_bilhis="select count(tab_billno) as ct,tab_status  from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."' and tab_mode='HD' group by tab_status ORDER BY tab_date,tab_time DESC";
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' and tab_mode='TA' ORDER BY 	tab_date,tab_time DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									if($result_bilhistory['tab_status']=="Billed")
									$prcs_cs=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Closed")
									$cls_hd=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Delivered")
									$del_hd=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Settled")
									$pack_hd=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Kot_Generated")
									$gen_hd=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Assigned")
									$asg_hd=$result_bilhistory['ct'];
								}
						}
									?>
                      <div class="total_count_ta_cc">
                     		 <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Closed : <?=$cls_hd?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                      		<div class="total_count_contain" style="width:32.2%;display: none">
                            	<div class="total_count_contain_head">Deliver : <?=$del_hd?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                             <div class="total_count_contain" style="width:32.2%;display: none">
                            	<div class="total_count_contain_head">Assign : <?=$asg_hd?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                          
                            <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Billed : <?=$prcs_cs?></div>
                               <div class="total_count_contain_count"></div>
                            </div>
                            
                             <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Settled : <?=$pack_hd?></div>
                               <div class="total_count_contain_count"></div>
                            </div>
                            
                             
                           
                           
                      </div>
                      <div class="bill_history_details_table">
                          <table style="width:100%">
                              <tbody>
                                  <tr>
                                      <th width="8%">
                                           Sl</th>
                                      <th width="40%">
                                          <input type="text" class="take_away_search_box" placeholder="Bill No" name="search_billno_ho" id="search_billno_ho" onKeyPress="validateSearch_ho()" onKeyDown="validateSearch_ho()" onKeyUp="validateSearch_ho()" style="color:#000;display: none"> Bill No</th>
                                      <th width="25%">
                                          <input type="text" class="take_away_search_box" placeholder="Name" name="search_name_ho" id="search_name_ho" onKeyPress="validateSearch_ho()" onKeyDown="validateSearch_ho()" onKeyUp="validateSearch_ho()" style="color:#000;display: none">  Amount</th>
                                      <th width="20%">
                                          <input type="text" class="take_away_search_box" placeholder="No" name="search_no_ho" id="search_no_ho" onKeyPress="validateSearch_ho()" onKeyDown="validateSearch_ho()" onKeyUp="validateSearch_ho()" style="color:#000;display: none">  Mode</th>
                                      <th width="14%">
                                          <input type="text" class="take_away_search_box" placeholder="Status" name="search_status_ho" id="search_status_ho" onKeyPress="validateSearch_ho()" onKeyDown="validateSearch_ho()" onKeyUp="validateSearch_ho()" style="color:#000;display: none"> Status
                                      </th>
                                  </tr>
                              </tbody>
                          </table>
                          <div id="billlisttotal_ho" class="left_detail_scroll">
                              <table class="new_fnt" width="100%" border="0">
                                  <!----bill_history_active--->
                                  <tbody>
                                   <?php $tot_hd=0; $mode='';
						$sql_bilhis= "Select tb.tab_paymode,tb.tab_netamt,tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='HD' order by tb.tab_date,tb.tab_time DESC ";
								   
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' and tab_mode='HD' ORDER BY 	tab_date,tab_time DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{ $i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
                                                            
                                                             if($result_bilhistory['tab_paymode']=='1'){
                                                                
                                                                $mode='Cash';
                                                            }else if($result_bilhistory['tab_paymode']=='2'){
                                                                
                                                                $mode='Card';
                                                            }else if($result_bilhistory['tab_paymode']=='6'){
                                                                
                                                                $mode='Credit';
                                                            }else if($result_bilhistory['tab_paymode']=='7'){
                                                                
                                                                $mode='Comp';
                                                            }else{
                                                                
                                                               $mode='';  
                                                            }
                                                            
                                                            $tot_hd=$tot_hd+$result_bilhistory['tab_netamt'];
									?>
                                     
                                      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?> ">
                            <td width="8%"><strong><?=$i++?></strong></td>
                            <td width="40%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>#<?=$result_bilhistory['tab_billno']?>"><?=$result_bilhistory['tab_billno']?></a></td>
                             <td style="font-size:11px" width="25%"><?=$result_bilhistory['tab_netamt']?></td>
                             <td style="font-size:9px" width="20%"><?=$mode?></td>
                             <td style="font-size:10px" width="14%" ><?=$result_bilhistory['tab_status']?></td>
                                     <?php }  ?>
                                      
                             
                              <tr class="bill_history_number">
                            <td width="8%"></td>
                            <td width="27%">Total</td>
                             <td style="font-size:11px" width="31%"><?=number_format($tot_hd,$_SESSION['be_decimal'])?></td>
                             <td style="font-size:10px" width="20%"></td>
                             <td style="font-size:10px" width="14%"  ></td>
                             
                             </tr> 
                             
                               <?php }else{ ?>
                             
                            <tr class="bill_history_number">
                            
                             <td style="font-size:11px;font-weight: bold" width="31%">NO DATA</td>
                             
                             </tr>  
                              <?php }  ?>
                             
                             
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!--bill_history_details_table--->
                  
                  </div>
         
            
                            
                            
                            
                 	<div class="left_bill_history_contain" style="width: 24%;    margin-left: 9px;">
                        <div class="bill_number_head" style="color:white;font-weight: bold;">
                       COUNTER SALES <img src="img/bill-icon.png" style="margin-top: -5px;width: 35px;" >
                          <div style="float:left;display: none">
                              
                               <input value="<?=$today?>" type="text" id="datepicker_cs" name="datepicker_cs" style="color:#333;width: 50%;float: left;height: 26px;margin: 2px 0 0 1px;line-height: 27px;border-radius: 4px;border: 0;padding-left: 3px;" readonly onChange="datechange('CS')">
                  
                          </div>
                          <a class="updatestock update_billdetails" style="display:block" onClick="updatebillby_date('CS')"></a>
                      </div>
                       <?php
					   $del_cs='0';$pack_cs='0';$gen_cs='0';$prcs_cs='0';$bil_cs_st=0;
					   $sql_bilhis="select count(tab_billno) as ct,tab_status  from tbl_takeaway_billmaster WHERE tab_dayclosedate='".$_SESSION['date']."' and tab_mode='CS' group by tab_status ORDER BY tab_date,tab_time DESC";
						//$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' and tab_mode='TA' ORDER BY 	tab_date,tab_time DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
									if($result_bilhistory['tab_status']=="Processing")
									$prcs_cs=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Closed")
									$del_cs=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Packed")
									$pack_cs=$result_bilhistory['ct'];
									if($result_bilhistory['tab_status']=="Kot_Generated")
									$gen_cs=$result_bilhistory['ct'];
                                                                        if($result_bilhistory['tab_status']=="Bill_Generated")
									$bil_cs_st=$result_bilhistory['ct'];
								}
						}
						?>
                            
                           <div class="total_count_ta_cc">
                      		<div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Closed : <?=$del_cs?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                           
                           
                            <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Billed : <?=$bil_cs_st?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                            
                            
                            <div class="total_count_contain" style="width:32.2%;">
                            	<div class="total_count_contain_head">Processing : <?=$prcs_cs?></div>
                                <div class="total_count_contain_count"></div>
                            </div><!--total_count_contain-->
                            
                         </div>
                            
                      <div class="bill_history_details_table">
                          <table style="width:100%">
                              <tbody>
                                  <tr>
                                      <th width="8%">
                                         
                                          Sl</th>
                                      <th width="40%">
                                          <input type="text" class="take_away_search_box" placeholder="Bill No" name="search_billno_cs" id="search_billno_cs" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()" style="color:#000;display: none"> Bill No</th>
                                      <th width="25%">
                                          <input type="text" class="take_away_search_box" placeholder="Name" name="search_name_cs" id="search_name_cs" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()" style="color:#000;display: none">Amount</th>
                                      <th width="20%">
                                          <input type="text" class="take_away_search_box" placeholder="No" name="search_no_cs" id="search_no_cs" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()" style="color:#000;display: none"> Mode</th>
                                      <th width="14%">
                                          <input type="text" class="take_away_search_box" placeholder="Status" name="search_status_cs" id="search_status_cs" onKeyPress="validateSearch_cs()" onKeyDown="validateSearch_cs()" onKeyUp="validateSearch_cs()" style="color:#000;display: none"> Status
                                      </th>
                                  </tr>
                              </tbody>
                          </table>
                          <div id="billlisttotal_cs" class="left_detail_scroll">
                              <table class="new_fnt" width="100%" border="0">
                                  <!----bill_history_active--->
                                  <tbody>
                                   <?php
						$tot_cs=0; $mode='';
						 $sql_bilhis= "Select tb.tab_paymode,tb.tab_netamt,tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='CS' AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' order by tb.tab_date,tb.tab_time DESC ";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{       
                                                        $i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
							{
                                                            if($result_bilhistory['tab_paymode']=='1'){
                                                                
                                                                $mode='Cash';
                                                            }else if($result_bilhistory['tab_paymode']=='2'){
                                                                
                                                                $mode='Card';
                                                            }else if($result_bilhistory['tab_paymode']=='6'){
                                                                
                                                                $mode='Credit';
                                                            }else if($result_bilhistory['tab_paymode']=='7'){
                                                                
                                                                $mode='Comp';
                                                            }else{
                                                                
                                                                $mode='';  
                                                            } 
                                                            
                                                            $tot_cs=$tot_cs+$result_bilhistory['tab_netamt'];
							?>
                                    
                             <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
                             <td width="8%"><strong><?=$i++?></strong></td>
                             <td width="40%"><a href="cs_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>#<?=$result_bilhistory['tab_billno']?>"><?=$result_bilhistory['tab_billno']?></a></td>
                             <td style="font-size:11px" width="25%"><?=$result_bilhistory['tab_netamt']?></td>
                             <td style="font-size:9px" width="20%"><?=$mode?></td>
                             
                             <?php if($result_bilhistory['tab_status']=='Bill_Generated'){?>
                             <td style="font-size:10px" width="14%">Billed</td>
                             <?php }else{ ?>
                             <td style="font-size:10px" width="14%"><?=$result_bilhistory['tab_status']?></td>
                             <?php } ?> 
                             
                             
                            <?php }  ?>
                                      
                             
                             <tr class="bill_history_number">
                             <td width="8%"></td>
                             <td width="27%">Total</td>
                             <td style="font-size:11px" width="31%"><?=  number_format($tot_cs,$_SESSION['be_decimal'])?></td>
                             <td style="font-size:10px" width="20%"></td>
                             <td style="font-size:10px" width="14%"  ></td>
                             
                              </tr> 
                              
                              <?php }else{ ?>
                             
                            <tr class="bill_history_number">
                            
                             <td style="font-size:11px;font-weight: bold" width="31%">NO DATA</td>
                             
                             </tr>  
                              <?php }  ?>
                              
                              
                                  </tbody>
                              </table>
                              
                          </div>
                          
    <span style="font-weight: bold;float: right;padding-top: 3px;font-size: 15px;"> Total : <?=number_format(($tot_di+$tot_ta+$tot_hd+$tot_cs),$_SESSION['be_decimal'])?></span> 
                      </div>
                           
                  </div>
         
    		</div>
        
        
        
                    
                    
                    
      </div>       
</div>

<script type="text/javascript">
    
function validateSearch_cs()
{

  var billno=$("#search_billno_cs").val();
  if(billno=="")
  {
	  billno="null";
  }
  var name=$("#search_name_cs").val();
  if(name=="")
  {
	  name="null";
  }  
 var nos=$("#search_no_cs").val();
  if(nos=="")
  {
	  nos="null";
  }
  var statuss=$("#search_status_cs").val();
  if(statuss=="")
  {
	  statuss="null";
  }
//load_ta_history.php
//alert(billno+name+nos+statuss);
  $.ajax({
		type: "POST",
		url: "load_ta_total_billhistory.php",
		data: "value=searchtahistory_cs&billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,
		success: function(msg)
		{
			$('#billlisttotal_cs').html(msg);
		}
	});  
}

function validateSearch_ta()
{//search_billno search_name search_no search_status

  var billno=$("#search_billno_ta").val();
  if(billno=="")
  {
	  billno="null";
  }
  var name=$("#search_name_ta").val();
  if(name=="")
  {
	  name="null";
  }  
 var nos=$("#search_no_ta").val();
  if(nos=="")
  {
	  nos="null";
  }
  var statuss=$("#search_status_ta").val();
  if(statuss=="")
  {
	  statuss="null";
  }
//load_ta_history.php
//alert(billno+name+nos+statuss);
  $.ajax({
		type: "POST",
		url: "load_ta_total_billhistory.php",
		data: "value=searchtahistory_ta&billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,
		success: function(msg)
		{
			$('#billlisttotal_ta').html(msg);
		}
	});  
}

function validateSearch_ho()
{//search_billno search_name search_no search_status

  var billno=$("#search_billno_ho").val();
  if(billno=="")
  {
	  billno="null";
  }
  var name=$("#search_name_ho").val();
  if(name=="")
  {
	  name="null";
  }  
 var nos=$("#search_no_ho").val();
  if(nos=="")
  {
	  nos="null";
  }
  var statuss=$("#search_status_ho").val();
  if(statuss=="")
  {
	  statuss="null";
  }
//load_ta_history.php
//alert(billno+name+nos+statuss);
  $.ajax({
		type: "POST",
		url: "load_ta_total_billhistory.php",
		data: "value=searchtahistory_ho&billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,
		success: function(msg)
		{
			$('#billlisttotal_ho').html(msg);
		}
	});  
}
</script>

 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
</body>

</html>
