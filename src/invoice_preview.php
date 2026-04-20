<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
//error_reporting(0);
error_reporting(0);
    $billnm="";
$idin1="";
$_SESSION['dup']="";
 $_SESSION['gr11']="";
   $_SESSION['bpt']="";
if(isset($_REQUEST['value'])&&($_REQUEST['value']=="inv")){
 //$idin1=$_REQUEST['idinbq'];
    $_SESSION['idofbq']=$_REQUEST['idinbq'];
     
    $_SESSION['dup']=$_REQUEST['dup'];
    $_SESSION['gr11']=$_REQUEST['gr11'];
     $_SESSION['bpt']=$_REQUEST['bpt'];
 
 //echo  $_SESSION['bpt'];
 }

?>

<input type="hidden" id="duplct" value="<?=$_SESSION['dup']?>">
<input type="hidden" id="idofbill" value="<?=$_SESSION['idofbq']?>">
<input type="hidden" id="bpt12" value="<?=$_SESSION['bpt']?>">

<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Invoice</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
<link rel="stylesheet" type="text/css" media="screen" href="css/bqt_print_view_page.css" />

 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
</style>

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
    min-height: 380px;
    height: 72vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
		.bnq_dtail_table th, td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table th, td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.banq_inv_right_table th{
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
.banq_gen_invoice_right_table_cc .banq_left_mn_detail_contant_bdy {
    min-height: 403px;
    height: 60vh;
}
.form-control{height: 35px !important;}
.form_name_cc{height: 36px !important;}
.md-content button{    margin: 8px 0;}
.del_contain_pop{
	width:130%;
	height:120%;
	background-color:rgba(0,0,0,0.6);
	position:fixed;
	top:0;
	  z-index:999999999999;
	    display:none;

	}
.delete_con_pop{
	 position:fixed;
	 height:60px;
	 width:40%;
	 background-color:#fff;
	  color:#000;
	  text-transform:none;
	 /* margin-top: -32px;*/
	  top: 50%;
	  text-align: center;
	  padding-top: 10px;
	  right:0;
	  left:0;
	  font-weight: bold;
	  font-size:15px;
	  margin:auto;
	    border-radius: 5px;
	  border: solid 1px #07bf29;
	  }
.delete_con_pop a{
	  color: #FFF;
  background-color: #C73500;
  display: inline-block;
padding: 9px 22px;
  border-radius: 7px;
}
.delete_con_pop a:hover{background-color:#F00;color:#fff}  
</style>
</head>
<body>
    <?php

            $brname="";
            $address="";
            $nm="";
    $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         $sql_gen =  mysqli_query($localhost,"select * from tbl_branchmaster"); 
         //echo "select * from   tbl_function_details where fd_id='".$_SESSION['bid']."'";
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_invoice6  = mysqli_fetch_array($sql_gen)) 
					{
                                       $brname=$result_invoice6['be_branchname'];
                                       $address=$result_invoice6['be_address'];
                                       $nm=$result_invoice6['be_phone'];
                                        $gstno=$result_invoice6['be_others3'];
                                        $banq_gst=$result_invoice6['be_banquet_gst'];
                                        
                                        }
                                }
                                
                           
          
          $perhead="";
          $date="";
        $funid="";
          $time="";
         $name="";
         $type="";
         $phone ="";    
         $pax ="";   
         $menu =""; 
          $total1="";
        $venue="";
        $session="";
        $billtype="";
        $advgiv="";
         $sql_invoice =  mysqli_query($localhost,"select *,ft_name,fv_name from   tbl_function_details tf left join tbl_function_type tft on tf.fd_function_type=tft.ft_id left join tbl_function_venue tv on tv.fv_id=tf.fd_venue where fd_id='".$_SESSION['idofbq']."'"); 
         //echo "select *,ft_name,fv_name from   tbl_function_details tf left join tbl_function_type tft on tf.fd_function_type=tft.ft_id left join tbl_function_venue tv on tv.fv_id=tf.fd_venue where fd_id='".$idin1."'";
		  $num_invoice  = mysqli_num_rows($sql_invoice);
		  if($num_invoice)
		  {
				while($result_invoice  = mysqli_fetch_array($sql_invoice)) 
					{
                                    $pax=$result_invoice['fd_no_of_pax'];
                                      $perhead=$result_invoice['fd_per_head_cost'];
                                        $phone=$result_invoice['fd_mobile_1'];	
					$funid=$result_invoice['fd_id'];	
                                   $date=$result_invoice['fd_date'];
                                    $time=  $result_invoice['fd_time']; 
                                     $name=  $result_invoice['fd_customer'];   
                                     $type=$result_invoice['ft_name']; 
                                     $session=$result_invoice['fd_session'];
                                     $venue=$result_invoice['fv_name'];
                                     $billtype=$result_invoice['fd_billing_type'];
                                      $total1=$result_invoice['fd_total_rate'];
                                       $advgiv=$result_invoice['fd_advance_given'];
                                    $addrs_nw=$result_invoice['fd_address'];
					}
		  }
                   
$billnum1="";
$sql_gen1 =  mysqli_query($localhost,"select * from tbl_function_invoice where fi_function_id='".$_SESSION['idofbq']."'"); 
        
		  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
				while($result_invoice5  = mysqli_fetch_array($sql_gen1)) 
					{
                                       $billnum1=$result_invoice5['fi_invoice_no'];
                                      $grthh=$result_invoice5['fi_total_final_rate'];
                                        }
                                }



               
                                
    ?>
<div class="banq_view_popup_container">
	
    <div class="banq_view_section_1">
    	
        
        <input id="close_icon"  type="submit" value="CLOSE" class="print_button_main" onclick="return close_page()" style="float: left ;margin: 1%;position: absolute" />
        <div class="print_main_container" id="popdivprint">
    	<div class="print_main_head" style="height: auto;padding-bottom: 5px;">
               
               <div style="width: 30%;float: none;margin: auto" class="company_logo_container"></div>
            
          
             
               
            <span style="width:100%;text-align:center;float:left;font-size: 14px;line-height: 20px;font-family: arial;">
                <img width="80px" src="img/print-logo/print_logo.png" /> <br>
                <span id="branchname1"><?=$brname?></span><br/>
                <span id="address1"><?=$address?></span><br/>
                
                   <?php if($nm!=''){ ?>
                     <span id="phn1"> <?=$nm?> </span> 
                   <?php } ?>
                   
                   <?php if($gstno!=''){ ?>
                     <span id=""> <?=$gstno?> </span> 
                   <?php } ?>
                   
                   
                   <?php if($banq_gst!=''){ ?>
                     <span id="banq_gst"> <?=$banq_gst?> </span> 
                   <?php } ?>
            </span>
            
               <div class="print_comp_main_head" style="width:100%;text-align:center;height: 45px;padding: 0;line-height:53px;font-size:22px"><?=$brname?>
                   
               </div>
            <table style="width:100%;float:left">
                <tr>
                <td style="width:100%;border: 0;height: 60px"></td>
                </tr>
            </table>
               
        </div><!--print_main_head-->

        <div class="print_date_main_container" style="height: auto;">
       	
        	
<table style="width:100%;float:left">
                   <tr>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold " > Bill No</td>
                       <td style="width: 35%;text-align:left;border: 0" >:  <strong style="border-bottom: 1px #808080 solid;"><?=$billnum1?></strong></td>
                       <td style="width: 15%;text-align:left;border: 0 ;font-size:15px !important ;font-weight:bold" >Bill Date</td>
                       <td style="width: 35%;text-align:left;border: 0" >: <strong style="border-bottom: 1px #808080 solid;"><?=date("d-m-Y")?></strong></td>
                       
                   </tr>
                   <tr>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" > Customer Name</td>
                       <td style="width: 35%;text-align:left;border: 0" >:  <strong style="border-bottom: 1px #808080 solid;"><?=$name?></strong></td>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" >Time- Date</td>
                       <td style="width: 35%;text-align:left;border: 0" >: <strong style="border-bottom: 1px #808080 solid;"><?= date('h:i:s a',strtotime($time))?> - <?=$date?></strong></td>
                       
                   </tr>
                   
                   <tr>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" > Contact Number</td>
                       <td style="width: 35%;text-align:left;border: 0" >:  <strong style="border-bottom: 1px #808080 solid;"><?=$phone?></strong></td>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" >Function Type</td>
                       <td style="width: 35%;text-align:left;border: 0" >: <strong style="border-bottom: 1px #808080 solid;"><?=$type?></strong></td>
                       
                   </tr>
                   <tr>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" > Venue</td>
                       <td style="width: 35%;text-align:left;border: 0" >:  <strong style="border-bottom: 1px #808080 solid;"><?=$venue?></strong></td>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" >Session</td>
                       <td style="width: 35%;text-align:left;border: 0" >: <strong style="border-bottom: 1px #808080 solid;"><?=$session?></strong></td>
                       
                   </tr>
                   <tr>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" > Address</td>
                       <td style="width: 35%;text-align:left;border: 0" >:  <strong style="border-bottom: 1px #808080 solid;"><?=$addrs_nw?></strong></td>
                       <td style="width: 15%;text-align:left;border: 0;font-size:15px !important ;font-weight:bold" ></td>
                       <td style="width: 35%;text-align:left;border: 0" > <strong style="border-bottom: 1px #808080 solid;"></strong></td>
                       
                   </tr>

               </table>
<!--            <div class="left_date_contain">
                 <div class="left_date_contain_text">Bill No</div>
                 <div class="left_date_contain_textbox_contain"><span style="margin-left: 3px;" class=""><?=$billnum1?></span></div>
            </div>-->
            
<!--            <div class="right_date_contain">
                	<div class="left_date_contain_text">Bill Date</div>
                        <div class="left_date_contain_textbox_contain"><span class="left_date_contain_textbox"><?=date("d-m-Y")?></span></div>
             </div>-->
             
            
<!--             <div class="left_date_contain">
            	   <div class="left_date_contain_text">Customer Name</div>
                <div class="left_date_contain_textbox_contain"><span class="left_date_contain_textbox"><?=$name?></span></div>
            </div>
            <div class="right_date_contain">
            	<div class="left_date_contain_text">Time-Date</div>
                <div class="left_date_contain_textbox_contain"><span style="margin-left: 3px;" class="left_date_contain_textbox"><?=$time?>&nbsp;&nbsp;<?=$date?></span></div>
            </div>
            
            
            <div class="right_date_contain">
            	   <div class="left_date_contain_text">Function Type</div>
                <div class="left_date_contain_textbox_contain"><span class="left_date_contain_textbox"><?=$type?></span></div>
            </div>
             
             <div class="left_date_contain">
            	<div class="left_date_contain_text">Contact Number</div>
                <div class="left_date_contain_textbox_contain"><span style="margin-left: 3px;" class="left_date_contain_textbox"><?=$phone?></span></div>
            </div>

            <div class="left_date_contain">
            	<div class="left_date_contain_text">Venue</div>
                <div class="left_date_contain_textbox_contain"><span style="margin-left: 3px;" class="left_date_contain_textbox"><?=$venue?></span></div>
            </div>
              <div class="right_date_contain">
            	   <div class="left_date_contain_text">Session</div>
                <div class="left_date_contain_textbox_contain"><span class="left_date_contain_textbox"><?=$session?></span></div>
            </div>-->
             
        </div><!--print_date_main_container-->
  <div style="width:25opx;height:70px"></div>
        <div class="center_print_data_container">
        	 <div class="top_date_con_head">Invoice Details</div>
        	<table class="print_detail_table" width="100%" border="0" cellspacing="0">
              <tr>
                <th style="text-align:center" width="8%" scope="col">SL No</th>
                <th style="text-align:center" width="40%"  scope="col">Item Name</th>
                <th  style="text-align:center"  width="13%" scope="col">Per head</th>
                <th  style="text-align:center" width="13%" scope="col">Qty</th>
                <th style="text-align:center" width="13%" scope="col">Rate</th>
                <th  style="text-align:center" width="15%" scope="col">Total Rate</th>

                                              <?php
                                            $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
                                            
                       $menu1 ="";
                       $qty1="";
                       $unit1="";
                       $total12="";
         $sql_invoice3 =  mysqli_query($localhost,"select fdm_menu,fdm_qty,fdm_unit_rate,fdm_total_rate  from   tbl_function_details_menu"
                 . " where fdm_function_id='".$_SESSION['idofbq']."'"); 
         //echo "select * from   tbl_function_details where fd_id='".$_SESSION['bid']."'";
		  $num_invoice3  = mysqli_num_rows($sql_invoice3);
                  $c=1;
		  if($num_invoice3)
		  {
				while($result_invoice3  = mysqli_fetch_array($sql_invoice3)) 
					{
						
                                   
                                     $menu1=  substr($result_invoice3['fdm_menu'],0,20); 
                                     $qty1=$result_invoice3['fdm_qty'];
                                     $unit1=$result_invoice3['fdm_unit_rate'];
                                     $total12=$result_invoice3['fdm_total_rate'];        
                                     ?>
                                        <tr>
                                            <td style="text-align:center"><?=$c++?></td>
                                        	<td style="text-align:center"><?=$menu1?></td>
                                               
                                               <td style="text-align:center"><?=number_format($perhead,$_SESSION['be_decimal'])?></td>
                                               <td style="text-align:center"><?=$qty1?></td>
                                            <td style="text-align:center"><strong ><?=number_format($unit1,$_SESSION['be_decimal'])?></strong></td>
                                             <td style="text-align:center"><strong ><?=number_format($total12,$_SESSION['be_decimal'])?></strong></td>
                                             </tr>
                                            <?php
					}$c++;
		  }
                  
                  
                  
                   $sql_invoice2 =  mysqli_query($localhost,"select fi_invoice_no,fi_balance_amt,fi_total_final_rate,fi_discount_amount,fi_total_extra_cost from tbl_function_invoice"
                 . " where fi_function_id='".$_SESSION['idofbq']."'"); 
        
		  $num_invoice2  = mysqli_num_rows($sql_invoice2);
		  if($num_invoice2)
		  {
				while($result_invoice2  = mysqli_fetch_array($sql_invoice2)) 
					{
					$dst=$result_invoice2['fi_discount_amount'];	
                                      $ext=$result_invoice2['fi_total_extra_cost'];
                                     $invo=$result_invoice2['fi_invoice_no'];
                                     $grtotal=$result_invoice2['fi_total_final_rate'];
                                     $bpee=$result_invoice2['fi_balance_amt'];
                                        }
                  }
                  
                                            ?>
                                             <?php if($perhead==0){?>
                                      <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">Total Item Rate</div></td>
                <td><div class="sub_total_div"><?= number_format($total1,$_SESSION['be_decimal'])?></div></td>
                </tr>        
                                             <?php } else{ ?>
                           <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">(No of Pax(<?=$pax?>) * (<?=number_format($perhead,$_SESSION['be_decimal'])?>) Per head cost) Total Item Rate per</div></td>
                <td><div class="sub_total_div"><?= number_format($total1,$_SESSION['be_decimal'])?></div></td>
                </tr>  
                <?php } ?>
                                             
                             <?php                
                                   $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
            $sql_gen9 =  mysqli_query($localhost,"select fec_cost,fi_extra_rate,fec_name from tbl_function_invoice_extras tfe left join tbl_function_extra_costs tfc on tfc.fec_id=tfe.fi_extra_id where fi_invoice_no='".$invo."'"); 
         //echo "select * from   tbl_function_details where fd_id='".$_SESSION['bid']."'";
		  $num_gen9  = mysqli_num_rows($sql_gen9);
		  if($num_gen9)
		  {
				while($result_invoice9  = mysqli_fetch_array($sql_gen9)) 
					{
                                       $extras=$result_invoice9['fec_name'];
                                        $exost=$result_invoice9['fi_extra_rate'];
                                       
                                       $ex_percent=$result_invoice9['fec_cost'];
                                       
                               if($extras!=""){        
                                       ?>
                                           
                               
                                <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div"><?=$extras .'('.$ex_percent.'%)'?></div></td>
                <td><div class="sub_total_div"><?= number_format($exost,$_SESSION['be_decimal']) ?></div></td>
                </tr>  
                  <?php
                               }
                                        }
                                }
                                ?>
                
                   <?php if($dst!=0){ ?>
                                <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">Total Discount</div></td>
                <td><div class="sub_total_div"><?= number_format($dst,$_SESSION['be_decimal'])    ?></div></td>
                </tr>          
                                             
                   <?php } ?>                        
                
                
                
                
                <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">Grand Total</div></td>
                <td><div class="sub_total_div"><?= number_format($grthh,$_SESSION['be_decimal'])  ?></div></td>
                </tr>
                <?php if($advgiv!=0){ ?>
                <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">Advance given</div></td>
                <td><div class="sub_total_div"><?=  number_format($advgiv,$_SESSION['be_decimal'])?></div></td>
                </tr>
                <?php }  ?>
                <tr class="pri_toal">
                <td colspan="5"><div style="float:right" class="sub_total_div">Balance paid</div></td>
                <td><div class="sub_total_div"><?= number_format($bpee,$_SESSION['be_decimal'])?></div></td>
                </tr>
                
            </table>
                  <div style="width:25opx;height:70px"></div>
        </div>
       
        <!--center_print_data_container-->

<!--      <div class="bottom_remarks_by">
          <div class="half_wdth" style="width:32%;">
            <div style="width: 40%;text-align:left" class="bottom_name_con">Prepared By :-</div>
            <div style="width: 60%;" class="bottom_name_wrote_view"></div>
          </div>

            <div class="half_wdth" style="width:32%;margin:0 0.5%;">
            <div style="width: 50%;" class="bottom_name_con">Approved By :-</div>
            <div style="width:50%;" class="bottom_name_wrote_view"></div>
          </div>

           <div class="half_wdth" style="width:32%;">
      			<div style="float:right;width:50%;" class="bottom_name_wrote_view"></div>
                <div style="float:right;width:50%;" class="bottom_name_con">Approved Date :-</div>
      		</div>

      </div> bottom_remarks_by-->

      <div class="bottom_thanks_cc">
          <div class="botom_tanks_txt" style="text-align:center">
              	<span>Thank You</span>
                
              	<div class="print_comp_name_cc"><?=$brname?></div>
              </div><!--botom_tanks_txt-->
      </div><!--bottom_thanks_cc-->

    </div><!--print_main_container-->
                                     
       <a href="#" id="print_in_44"><div style="position: absolute;bottom: 2px;right: 160px;" class="banq_sub_btn print_in_a4" id="hai" >A4 PRINT</div><div style="position: absolute;bottom: 2px;right: 10px;" class="banq_sub_btn print_in_th" >THERMAL PRINT</div></a> 
    </div>
</div>
    <script>
    $(".print_in_th").click(function(){  
           
           var branch=$('#branchname1').text();
           var adr=$('#address1').text();
           var phn=$('#phn1').text();
           var fid=$('#idofbill').val();
           var bp12=$('#bpt12').val();
           var dup1=$('#duplct').val();
           var gst1=$('#banq_gst').val();
          //alert(bp12);
          // alert(fid);
           var datastring="set=thermal_invoice&branch="+branch+"&adr="+adr+"&phn="+phn+"&fid="+fid+"&bp="+bp12+"&dup1="+dup1;
           $.ajax({
                type: "POST",
                url: "print_details.php",
                data: datastring,
                success: function (data) {
                   //alert(data); 
                   window.opener.location = 'banquet_list.php';
                }
           
          
        });
        //location.replace("banquet_list.php");
         // window.close();    
   
       });
       
     $(".print_in_a4").click(function(){ 
         
          
        
//          $('.print_in_a44').trigger('click');
         
            //window.location.replace("a4_print_invoice.php");
    var divToPrint = document.getElementById('popdivprint');
    var htmlToPrint = '' +
        '<style type="text/css">' +
         'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
 
         
         
     
         
         
      });
    
    
    function close_page(){
   window.top.close();
}

    
    </script>
    </body>
</html>