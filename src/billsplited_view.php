<?php session_start();
header('Content-Type: text/html; charset=utf-8');
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
//print_r($_SESSION['bilsplitorderfinal']);
//echo $_SESSION['bilsplitorderfinal'][0];
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');


require_once("includes/title_settings.php");
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }



function equal_array($arr){
  $ArrayObject = new ArrayObject($arr);
  return $ArrayObject->getArrayCopy();  
}

if(!isset($_SESSION['finalbills']))
{
$_SESSION['finalbills1']= equal_array($_SESSION['bilsplitorderfinal']);
foreach( $_SESSION['finalbills1'] as $number => $value)
	 {
		$sql_listall1  =  $database->mysqlQuery("SELECT * from tbl_temp_tablebillmaster as td  WHERE td.bm_temp_billno='".$value."'  "); 
		$num_listall1  = $database->mysqlNumRows($sql_listall1);
		if($num_listall1){
			//unset($_SESSION['finalbills'][$key]); 
			$_SESSION['finalbills'][]=$value;
		}
	 }

}
if(count($_SESSION['finalbills'])==0)
{
header("location:payment_pending.php");
}

?>


<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bill Split</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_split.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/bill_split_view.js"></script> 


<!--<script src="js/bill_paymentscreen_main.js"></script> 
<script src="js/bill_paymentscreen_select.js"></script>
--><style>
body{font-family:inherit}
/*.left_contant_container {height: 80vh;padding-bottom:0px;}	*/
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.take_staff_view_cc{width: 32.5%;margin:0px !important;margin-left:0.6% !important;margin-top: 10px !important;float:none;display:inline-block}
#billdetails .billgenration_new_table tbody {min-height: 410px;height: 73vh;}
.tottal_rate_contain {width: auto;min-width: 110px;float: right;height: 40px;line-height: 38px;font-size: 15px;color: #FFF;font-weight:400;margin-right:1%}
.take_staff_view_cont_cc {height: 400px;min-height: 70vh;border-bottom: dashed;}
.billgenration_new_table_content_container {min-height:270px;height:55vh;}
.left_contant_container{overflow-y:hidden;white-space:nowrap;min-height: inherit !important;height: auto;padding-bottom:0px;}
.billgenration_new_table thead{background-color: bisque;}
.billgenration_new_table th{background-color:transparent;color:#000}
.billgenration_new_table_content td {height: 35px;}
</style>

</head>

<body>

<div class="container-fluid no-padding">
<?php //include"includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
      
        
               <!-- <a href=" table_selection.php "><div class="backto_table_select" style="float:left;width: 165px">
                     <div class="backtable_ico"></div>
                     <div style="width: 130px;" class="tableselect_text">Table Selection</div>
           		 </div></a>-->
              <?php //include"includes/new_right_menu.php"; ?> 
            	<div class="billgeneration_head"><?=$_SESSION['splited_view_splitted_bill']?></div>
                <div class="error_feed" style="color:#F00">
                <?php if(isset($_REQUEST['msg'])){echo $_SESSION['splited_view_error_bill_printed']; } ?>
                </div>
             
                
               <!-- <a href=" bill_history.php "> <div class="backto_table_select back_bill_his" >
                     <div class="tableselect_text">Bill History</div>
                     <div style="background-image:url(img/goto_bill_ico.png);" class="backtable_ico"></div>
           		 </div></a>-->
                         
                  
                  <!-- <a href=" completed_order.php "><div class="backto_table_select" style="float:right;width: 160px;">
                   	<div  class="backtable_ico"></div>
                     <div style="width: 130px;" class="tableselect_text">Completed Order</div>
           		 </div></a>-->
                  
              
        </div>
        <?php 
				$bills=$_SESSION['finalbills'];
				$bilcount=count($_SESSION['finalbills']);
				$bilcount_split=count($_SESSION['bilsplitorderfinal']);
				
				?>
                <input type="hidden" name="noofbillssplitted" id="noofbillssplitted" value="<?=$bilcount_split ?>" >
            <script type="text/javascript" src="js/bill_split_view_close.js?v=<?=md5_file('js/bill_split_view_close.js')?>"></script>  
      		<div style="  min-height:460px;width:100%" class="left_contant_container loadsplittedlist">
            
                 
                <?php
				//if(isset($_SESSION['finalbills']))
				//{
				/*foreach( $bills as $number => $value)
				 {//$value='101';// coment this
				 $total1=0;
				 $sql_listall1  =  $database->mysqlQuery("SELECT * from tbl_temp_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_temp_billno='".$value."' order by td.bd_billslno "); 
					$num_listall1  = $database->mysqlNumRows($sql_listall1);
					if($num_listall1){
						  while($row_listall1  = $database->mysqlFetchArray($sql_listall1)) 
							  {
								  $total1= $row_listall1['bd_amount'];
							  }
					}if($total1==0)
					{//echo $total1;
						foreach ($_SESSION['finalbills'] as $key1 => $value1){
							//echo $value1;
							if ($value1 == $value) {
								unset($_SESSION['finalbills'][$key1]);
							}
						}
					}
				 }*///}//print_r($_SESSION['finalbills']);
				if(isset($_SESSION['finalbills']))
				{
				foreach( $bills as $number => $value)
				 {//$value='101';// coment this
				 /*$total1=0;
				 $sql_listall1  =  $database->mysqlQuery("SELECT * from tbl_temp_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_temp_billno='".$value."' order by td.bd_billslno "); 
					$num_listall1  = $database->mysqlNumRows($sql_listall1);
					if($num_listall1){
						  while($row_listall1  = $database->mysqlFetchArray($sql_listall1)) 
							  {
								 $total1= $row_listall1['bd_amount'];
							  }
					}if($total1==0)
					{
						foreach ($_SESSION['finalbills'] as $key1 => $value1){
							if ($value1 == $value) {
								unset($_SESSION['finalbills'][$key]);
							}
						}
					}
					if($total1!=0)*/{
					 ?>     
                <div class="take_staff_view_cc">
                 
                	<!--<div class="bill_shadow_left"></div>-->
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd"><?=$value?>
                        <div class="bill_split_head_right_chk">
                        	<!--<div class="checkboxFive">
                          <input type="checkbox" value="1" id="checkboxFiveInput" name=""/>
                          <label for="checkboxFiveInput"></label>
                          </div>-->
                        </div>
                        
                        </div>
                    </div><!--take_staff_view_head-->
                    
                     
                     
                    <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                    	
                     
                     <div class="bill_gen_new_table_head loadallhead">
                     <table class="billgenration_new_table" width="100%" border="0">
                        	<thead>
                                    <tr>
                                    <th width="10%"><?=$_SESSION['splited_view_slno']?></th>
                                    <th width="40%"><?=$_SESSION['splited_view__menuitem']?></th>
                                    <th width="10%"><?=$_SESSION['splited_view_qty']?></th>
                                    <th width="15%"><?=$_SESSION['splited_view_rate']?></th>
                                    <th width="22%"><?=$_SESSION['splited_view_amount']?></th>
                                    
                                  </tr>
                            </thead>
                       </table>
                     </div><!--bill_gen_new_table_head-->
                     
                    <div  class="billgenration_new_table_content_container">
                    	
                          <table class="billgenration_new_table_content" width="100%" border="0">  
                            <tbody>
                                 <?php   
								 $total=0;
								 //`bd_temp_billno`, `bd_billslno`, `bd_menuid`, `bd_portion`, `bd_rate`, `bd_qty`, `bd_amount`, `bd_type` FROM `tbl_temp_tablebilldetails
								 //echo "SELECT * from tbl_temp_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_temp_billno='".$value."' order by td.bd_billslno ";
				 $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuid,mn.mr_menuname from tbl_temp_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_temp_billno='".$value."' order by td.bd_billslno "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
                                                                //$billsplit_menuid= trim(json_encode($row_listall['mr_menuid']),'""');
                                                                $billsplit_menuid= $row_listall['mr_menuid'];
                                                                $billsplit_menu=$row_listall['mr_menuname'];
                                                                    if($_SESSION['main_language']!='english'){

                                                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billsplit_menuid."' and ls_language='".$_SESSION['main_language']."'");

                                                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                                    $billsplit_menu=$result_arabmenu['lm_menu_name'];
                                                                    // $catid['name'][] = $catname;
                                                                    //echo $catname;
                                                                    }
//                                                                $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$billsplit_menuid&dat=$other_lang","r");
//                                                                $response['messages'] = stream_get_contents($fp);
//                                                                //echo  $response['messages'];
//                                                                $resu= json_decode($response['messages'],true);
								 $total=$total + $row_listall['bd_amount'];
								  ?>
                                  <tr>
                                    <td width="10%"><?=$row_listall['bd_billslno'] ?></td>
                                    <td width="40%"><?=$billsplit_menu//$row_listall['mr_menuname'] ?></td>
                                    <td width="10%"><?=$row_listall['bd_qty'] ?></td>
                                    <td width="15%"><?=number_format($row_listall['bd_rate'],$_SESSION['be_decimal']) ?></td>
                                    <td width="22%"><?=number_format($row_listall['bd_amount'],$_SESSION['be_decimal']) ?></td>
                                  </tr>
                                 
                                  <?php } } ?>
                                                   
                            </tbody>
                            
                      </table>
                      </div><!--billgenration_new_table_content_container--->
                          
                    <div class="billsplited_view_bottom_cc">
                    	<div class="billsplited_bottom_right_rate">
                            <div class="bill_splited_total_rate"><?=number_format($total,$_SESSION['be_decimal'])?>/-</div>
                            <div class="bill_splited_total_text"><?=$_SESSION['splited_view_total']?> - </div>
                        </div>
                         <div class="billsplited_bottom_right_rate" >
                            <div class="billsplited_mainbotom_right_print_btn_cc" style="margin-top:0px !important">
                                <a href="#" class="printsplittedbill" bilnosplt="<?=$value?>"><div class="billsplited_print_btn" style="    margin-left: -129px;"><?=$_SESSION['splited_view_printbutton']?></div></a>
                            </div>
                        </div>
                       <!-- <div class="billsplited_bottom_right_rate">
                            <div class="bill_splited_total_rate">0/-</div>
                            <div class="bill_splited_total_text">Balance - </div>
                        </div>-->
                    </div><!--billsplited_view_bottom_cc-->
                        
                    </div><!--take_staff_view_cont_cc-->
                </div>
                
                
                
                
                <?php }
				}
				 }else { 
                
             header("location:payment_pending.php");
				}
				
				 ?>
                
                
                
                
              
              
                
       
        
                
  </div><!--left_contant_container-->
   <input type="hidden" id="discstatus" name="discstatus" >
<input type="hidden" name="printwithdiscount" id="printwithdiscount" value="<?=$_SESSION['s_printwithdiscount']?>">
<input type="hidden" name="printwithloyality" id="printwithloyality" value="<?=$_SESSION['s_printwithloyality']?>">
<input type="hidden" name="staffwithdiscount" id="staffwithdiscount" value="<?=$_SESSION['s_discountpermission']?>">
<input type="hidden" name="loyalityid" id="loyalityid">
<input type="hidden" name="printconfirmation" id="printconfirmation" value="N">
<input type="hidden" name="verifyconfirmation" id="verifyconfirmation" value="N"> 
<input type="hidden" name="billnotoprint" id="billnotoprint" >
 <input type="hidden" name="staffwithdiscountmanual" id="staffwithdiscountmanual" value="<?=$_SESSION['s_discount_manual']?>"> 
    
    <!--<div class="billsplited_view_main_botom_container">
        <!--<div class="billsplited_mainbotom_right_print_btn_cc" style="float:left;">
                <a href="#"><div class="billsplited_print_btn" style="float:right;">Back</div></a>
            </div>-->
    
    	<!--<div class="billsplited_mainbotom_right_print_btn_cc">
        	<a href="#"><div class="billsplited_print_btn">Print all</div></a>
        </div>-->
        
        <!--<div class="billsplited_mainbotom_right_total_right">
        		<div class="billsplited_bottom_right_rate">
                            <div class="bill_splited_total_rate">1200</div>
                            <div class="bill_splited_total_text"> Bill Total - </div>
                        </div>
        </div>-->
        
   <!-- </div><!--billsplited_view_main_botom_container-->
        
        
</div><!--middle_container-->          
</div><!--container_fluide-->


<!-- <script src="js/takeaway_staff.js"></script>
  <script src="js/takeaway_biilsubmn.js"></script>-->
<!--   <script src="js/basicTabs-min.js"></script>
	<link rel="stylesheet" href="btn/tabs_cont_2.css">
   
	<script type="text/javascript">
	$(document).ready(function(){
		$('#tabwrap').basicTabs();
	});
	</script> -->


<div style="display:none;height: auto;bottom: auto;top: 30%;width:315px;" class="index_popup_1 disountenterpopup">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head"><?=$_SESSION['splited_view_popup_enter_discount']?> </h3>
            
   		<span class="contenttext"  style="display: inline-block;margin: 10px 0 0 0;padding-left:6%;text-align: left;width: 100%;">
        <p style="display:inline-block;margin-bottom: 5px;"><?=$_SESSION['splited_view_popup_discount_type']?></p>
        	<!--<input type="text" class="form-control" name="disountamount" id="disountamount" style="width: 20%;margin-top: -37px;margin-left: 284px;  border: 1px solid #847D7D;">-->
            <select  class="form-control" name="disountamount_drop" id="disountamount_drop" onchange="dischange1()" style="width:80%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;">
              <option value="none"><?=$_SESSION['splited_view_popup_discount_none']?></option>
              <?php
			  $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status!='Non Active'"); 
			  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
			  if($num_listall_dsc){
					while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
						{
			?>
             <option value="<?=$row_listall_dsc['ds_discountid']?>" ><?=$row_listall_dsc['ds_discountname']//$row_listall_dsc['ds_discountname']?></option>
            <?php } } ?>
          </select>&nbsp; 
           <div class="discount_offer_or_cc">
           <?php if($_SESSION['s_discount_manual']=="Y") { ?>
<!--              <span style="margin:0 8px 0 0" class="or_round_sp"><?=$_SESSION['splited_view_popup_discount_or']?> </span>-->
          <?=$_SESSION['splited_view_popup_discount_manual']?> <input type="text" class="form-control" name="disountamount" id="disountamount" style="width:40%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;" value="0"> 
          <label style="display:inline;font-weight:normal">
               <span style="top:0px;" class="percen_radio">
                 <input type="radio" class="typesel" name="typesel" id="P"  value="P"<?php if($_SESSION['s_discpountypeoption']=="P") { ?> checked <?php } ?>>%
               </span> 
           </label>
          <label style="display:inline;font-weight:normal">
             <span style="top:17px;" class="percen_radio"> 
             	<input type="radio" class="typesel"  name="typesel" id="V"  value="V"<?php if($_SESSION['s_discpountypeoption']=="V") { ?> checked <?php } ?>><?=$_SESSION['splited_view_popup_discount_value']?>
             </span> 
         </label>
          <?php } ?>   
         </div> 
        </span>
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;border-top: 1px #e4e4e4 solid;">
    	<div style="width: 25%;" class="btn_index_popup"><a href="#" class="closedisount"><?=$_SESSION['splited_view_popup_discount_printbutton']?></a></div>
        <div style="width: 25%;" class="btn_index_popup"><a href="#" class="canceldisount"><?=$_SESSION['splited_view_popup_discount_cancelbutton']?></a></div>
    </div>
 </div><!--index_popup_2-->
 
 <div style="display:none;height: auto;bottom: auto;top: 30%;width: 480px;" class="index_popup_1 loyalitypopup">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head" ><?=$_SESSION['splited_view_popup_enter_loyality']?>
            	<div class="new_error_div anth-eror"><span class="error_loyal" style="float:right;color:#F00; display:none;    width: 35%;
    margin-top: -32px;"></span></div>
            </h3>
   		<span class="contenttext" style="display: inline-block;margin: 10px 0 0 0;padding-left: 7%;text-align: left;width: 100%;">
      <!--  <p style="display:inline-block;margin-bottom: 5px;">Name</p>
        	<input type="text" class="form-control" name="loyalityname" id="loyalityname" style="width:30%;border: 1px solid #C1C1C1;display:inline-block;height: 34px;">
          &nbsp; <span class="or_round_sp">OR </span>-->
         <p style="display:inline-block;margin-bottom: 5px;"><?=$_SESSION['splited_view_popup_mobile']?></p>
        	<input type="text" class="form-control" name="loyalitymob" id="loyalitymob" style="width:30%;border: 1px solid #C1C1C1;display:inline-block;height: 34px;">
            
            
        </span>
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;">
    	<div class="btn_index_popup"><a href="#" class="loyalityok"><?=$_SESSION['splited_view_popup_submitbutton']?></a></div>
        <div class="btn_index_popup"><a href="#" class="loyalitycancel"><?=$_SESSION['splited_view_popup_cancelbutton']?></a></div>
    </div>
 </div><!--index_popup_2-->
 
 <div style="display:none;height: auto;bottom: auto;top: 30%;width: 320px;" class="index_popup_reg registerpopup">
 	<h3 class="sm_pop_head"><?=$_SESSION['splited_view_popup_loyality']?></h3>
 	<div style="width:35%;text-align:right;margin: 2% 0;" class="index_popup_contant"><?=$_SESSION['splited_view_popup_registered']?>?</div>
    <div style="width:65%;margin: 2% 0;" class="index_popup_contant">
    	<div style="width: 80px;" class="btn_index_popup"><a href="#" class="registeredok"><?=$_SESSION['splited_view_popup_reg_yesbutton']?></a></div>
        <div style="width: 80px;" class="btn_index_popup"><a href="#" class="registeredcancel"><?=$_SESSION['splited_view_popup_reg_nobutton']?></a></div>
    </div>
 </div><!--index_popup_2-->

 <div style="display:none" class="index_popup_confrm confrimprint">
 	<div class="index_popup_contant">Are you Sure you Want to Print</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="printconfirm">Yes</a></div>
        <div class="btn_index_popup"><a href="#" class="closeprintconfirm">No</a></div>
    </div>
 </div>
    
 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script> 
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
    <script>
                function dischange1(){
     
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
    if(ds1!=''){
     $('#disountamount_drop').attr("disabled","disabled"); 
 }else{
      $('#disountamount_drop').removeAttr('disabled');
      
 }
  });
    </script>
</body>

</html>