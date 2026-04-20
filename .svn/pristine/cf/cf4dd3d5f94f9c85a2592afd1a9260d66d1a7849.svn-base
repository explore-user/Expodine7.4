<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");
//require_once("includes/menu_settings.php");
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
//$_SESSION['date']='2015-12-11';
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
<title>Kot History</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/kot_history.js"></script>
<script src="js/kot_history_select.js"></script>
<!--
<script src="js/bill_cancel.js"></script>
<script src="js/bill_eachcancelhistory.js"></script>-->
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
.tr_bill_gen_active	{
	    background-color: #930;
	}
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
.billgenration_validate{width:35%;}
.top_site_map_cc{height: 35px;}
.left_bill_history_contain{width: 52%;position:relative}
.bill_history_right_detail {width: 47%;}
.updatestock{top: 12px;margin-right: 78%;}
.bill_history_orderd_cont{margin-top:0;width: 100%;min-height: 370px;height: 73vh;}
.kot_history_right_table{width:100%;height:auto;float:left;}
.kot_history_right_table td{height: 25px;border: solid 1px rgba(255,255,255,0.1);color: #fff;font-size: 14px;}
.bill_history_details_table {min-height: 460px;height: 78vh;}
.combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
    display: inline-block;}
</style>
<script>
$(function() {

 /*************************************** cancel close click starts ******************************************************************  */
   $('.update_billdetails').click(function () {
	  //checkday checkmonth checkyear
	  // var dateset=$('#checkyear').val() +"-"+ $('#checkmonth').val() +"-"+ $('#checkday').val();
	 // var dt=$('#datepicker').val();
	  //var res = dt.split("-");
	  //var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  $('#datepicker').val($('#datehid').val());
		/* var billno       =  $('.bill_history_active').attr("billno");
		  if(billno=='')
		  {
			  billno='';
		  }*/
	var dateval= $('#datehid').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
	$('#kotno').val('');
	$('#bilno').val('');
	 $('#statuss').val('');
	 $('#bilsts').val('');
	 	  
	  var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{
			
				$('#kotlisttotal').html(msg);
				$('#loadkotdeatils').empty();
			   
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
				$('#printkot').css("display","block");
			}
		}
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
});
function datechange()
{
	 var dt=$('#datepicker').val();
	  var res = dt.split("-");
	  var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	  
		 var kotno= null;
	 var bilno= null;
	 var statuss= null;
	 var bilsts= null;
	 
	$('#statuss').find('option:first').attr('selected', 'selected');
	$('#bilsts').find('option:first').attr('selected', 'selected');
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&bilsts="+bilsts,
			success: function(msg)
			{
			//alert(msg);
				$('#kotlisttotal').html(msg);
				$('#loadkotdeatils').empty();
			   
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		
		var dateval= $('#datehid').val();
		var res = dateval.split("-");
		var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	
		var dt= $('#datepicker').val();
		if(dt!=dateset)
		{
			$('#printkot').css("display","none");
		}else
		{
			if($('#printerstatus').val()=="Y")
			{
					$('#printkot').css("display","block");
			}
		}
}
</script> 
</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
     <?php include"includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
            	<!--<ul>
					<li><a href="bill_generation_screen1.php" title=""><span class="home_icon"></span>\</a></li>
					<li><a title="">Bill History</a></li>
				</ul>-->
                <!--<a href="payment_pending.php"><div class="bill_his_back_btn">Back</div></a>-->
               	
                 <?php include"includes/new_right_menu.php"; ?> 
                   <div class="bill_history_head"><?=$_SESSION['kot_history_kothistory']?> - DI</div>
                
           
                

           
                <a href="index.php"><div class="bill_his_back_btn"><?=$_SESSION['kot_history_back_button']?></div></a>
                 
                

                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
                      
            
      		<div style="  min-height:480px;width:100%" class="left_contant_container">
            	
                <div class="left_bill_history_contain">
                	<div class="bill_number_head">
                    <div style="float:left;    width: 20%;">
                    <?php
                    
					$datev=explode("-",$_SESSION['date']);
					$sesdate=$datev[2]."-".$datev[1]."-".$datev[0];
					?>
                    <input type="hidden" name="datehid" id="datehid" value="<?=$sesdate?>">
                    <input value="<?=$today?>" type="text" id="datepicker" name="datepicker" style="color:#333;width: 67%;float: left;height: 30px;margin-left: 2%;" readonly onChange="datechange()">
                   
                    
                  </div>
                   <div style="float:left;    width: 20%;"><?=$_SESSION['kot_history_kot']?>
                       <input   type="text" id="kotno" name="kotno" style="color:#333;width: 50%;height: 30px;margin-left: 2%;" onkeyup="searchkot_history()">
                    <!--<select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()" style="color: black;">
                                <option value="null">All</option>
                                <option value="Active">Active</option>
                                <option value="Non Active">Non-Active</option>
                                </select>-->
                    
                  </div>
                   <div style="float:left;    width: 20%;"><?=$_SESSION['kot_history_bill']?>
                   <input  type="text" id="bilno" name="bilno" style="color:#333;width: 70%;height: 30px;margin-left: 2%;" onkeyup="searchkot_history()">
                   <!-- <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()" style="color: black;">
                                <option value="null">All</option>
                                <option value="Active">Active</option>
                                <option value="Non Active">Non-Active</option>
                                </select>-->
                    
                  </div>
                   <div style="float:left;    width: 20%;"><?=$_SESSION['kot_history_printed']?>
                   <select  class="add_text_box filte_new_box"  id="statuss" name="statuss"  style="color: black;" onChange="searchkot_history()">
                                <option value="null"><?=$_SESSION['kot_history_all']?></option>
                                <option value="Yes"><?=$_SESSION['kot_history_print_yes']?></option>
                                <option value="No"><?=$_SESSION['kot_history_print_no']?></option>
                                </select>
                    
                  </div>
                   <div style="float:left;    width: 20%;"><?=$_SESSION['kot_history_status']?>
                   <select  class="add_text_box filte_new_box"  id="bilsts" name="bilsts"  style="color: black;float: left;width: 60%;margin-top: 4px;" onChange="searchkot_history()">
                                <option value="null"><?=$_SESSION['kot_history_status_all']?></option>
                                <option value="Served"><?=$_SESSION['kot_history_served']?></option>
                                <option value="Closed"><?=$_SESSION['kot_history_closed']?></option>
                                <option value="Billed"><?=$_SESSION['kot_history_billed']?></option>
                                <option value="Cancelled"><?=$_SESSION['kot_history_cancelled']?></option>
                                </select>
                    
                  </div>
                  
                    <a class="updatestock update_billdetails" style="display:block; float:right"></a>
                    
                    </div>
                    	<div class="kot_his_order_detail_head">
                        <table width="100%" class=" " border="0"> <!----bill_history_active--->
                        <thead>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_slno']?></th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> Time </th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_kot']?> </th>
                        <th  width="15%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_bill_no']?> </th>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_printed']?> </th>
                        <th  width="10%" style="color:#FFF;text-align:center;"> <?=$_SESSION['kot_history_status']?> </th>
                        </thead>
                        </table>
                        </div>
                      <div class="bill_history_details_table" id="kotlisttotal">    
                		<table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
						// `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`) 
						// $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber ,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' ORDER BY ter_dayclosedate,ter_entrytime DESC";
						 $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						 //echo "select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE ter_dayclosedate='".$_SESSION['date']."' AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{$name='';$status='';
									if(is_null($result_bilhistory['ter_billnumber']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['ter_billnumber'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['ter_kotno']);
									$sts='';
									if($print['kr_print']=='Y')
									{
										$sts=$_SESSION['kot_history_print_yes'];
									}else {
										$sts=$_SESSION['kot_history_print_no'];
									}
									
									if($result_bilhistory['ter_status']=="Closed")
									{$status=$_SESSION['status_msg_closed'];
									}else 
									if($result_bilhistory['ter_status']=="Cancelled")
									{$status=$_SESSION['status_msg_cancelled'];
									}else 
									if($result_bilhistory['ter_status']=="Billed")
									{$status=$_SESSION['status_msg_billed'];
									}
									?>
                          <tr class="kot_history_number <?php if($result_bilhistory['ter_status']=='N'){ ?> bill_history_cancel <?php } ?>" kotno="<?=$result_bilhistory['ter_kotno']?>" style="cursor:pointer" status="<?=$result_bilhistory['ter_status']?>" >
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['ter_entrytime']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['ter_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts?></td>
                             <td width="10%"><?=$status?></td>
                           </tr>
                           <?php } } ?>
                           </tbody>
                         </table> 
              </div><!--bill_history_details_table---> 
                   
                </div><!--left_bill_history_contain-->
                
                
                
      <div class="bill_history_right_detail">
                	
                    	<div class="bill_number_head"><?=$_SESSION['kot_history_kot_details']?></div>
                      		
                            
                 
                        
           <div class="bill_history_orderd_cont" id="loadkotdeatils">
           
          <!-- <table class="kot_history_right_table" border="0">
                                  <tr>
                                    <td width="11.5%">1</td>
                                    <td width="39.8%">Dish Name</td>
                                    <td width="15.6%">Full</td>
                                    <td width="7.5%">5</td>
                                      <td width="12%">1120/-</td>
                                     </tr>
                                </table> -->
                        
          </div><!--bill_history_orderd_cont-->
                    
              <div  class="bill_his_buton_cc" style="display:block;width: 290px">
                    	<div class="bill_cancel_btn" id="printkot"><a href="#"></a>RE-PRINT</div>
                        <?php if($_SESSION['s_printst']=="Y" && $_SESSION['s_kotrefresh']=='Y') { ?>
                        <div style="right:2%;left:inherit;background-image:url(img/update.png)" class="bill_cancel_btn" id="refreshkot"><a href="#"><?=$_SESSION['kot_history_refresh']?></a></div>
                        <?php }?>
                    </div><!--bill_his_buton_cc-->
                    
                </div><!--bill_history_right_detail-->
                
               		
                    
                
            </div><!--left_contant_container-->
            
         
    
      <input type="hidden" name="printerstatus"  id="printerstatus"  value="<?=$_SESSION['s_printst']?>">
      <input type="hidden" name="hidkotprinted"  id="hidkotprinted"  value="<?=$_SESSION['kot_history_kot_printed']?>">  
        
      </div><!--middle_container-->          
</div><!--container_fluide-->


 <!----dock----> 
   <?php //include "includes/top_main_menu.php"; ?>
 <!----dock----> 


<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->  

 <div style="display:none;height: auto;bottom: auto;top: 30%;width:350px;" class="index_popup_1 closeoneclass">
  <h3 class="sm_pop_head">Message</h3>
 	<div class="index_popup_contant">Are you sure you want to cancel this Bill?</div>
    <div style="height:40px;" class="index_popup_contant">
    	<div  style="width: 20%;"  class="btn_index_popup"><a href="#" class="closeok">Yes</a></div>
        <div  style="width: 20%;" class="btn_index_popup"><a href="#" class="closecancel">No</a></div>
    </div>
 </div><!--index_popup_2-->
 
<!--index_popup_2-->
 
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
.index_popup_contant{
	width:100%;
	height:30px;
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

.btn_index_popup_send{
	width:15%;
	display:inline-block;
	height:25px;
	line-height:25px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	display:none;
	margin-top: 38px;
    margin-left: 121px;
	}
.btn_index_popup_send a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:none;
	}		
.btn_index_popup_send:hover{background-color:#333;}	
.btn_index_popup_send a:hover{color:#fff;}

	</style>

 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
</body>

</html>