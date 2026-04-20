<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once("includes/title_settings.php");
include('includes/master_settings.php');
include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
error_reporting(0);
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Generate Bill</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/bill_completedorder_main.js"></script> 
<script src="js/bill_completedorder_select.js"></script> 
<style>
body{font-family:inherit}
.left_contant_container {height: 80vh;padding-bottom:15px;}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.back_bill_his .tableselect_text { width:114px;}
.back_bill_his {width: 145px}
.billgenration_new_table tbody{min-height: 360px;height: 68.5vh;margin-bottom: 8vh;}
.take_staff_view_cont_bottom_contain{height:45px}
.cancel_rate_cc{margin-top:7px}
.disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
.total_rate_sh{    
    width: 18%;display: block;line-height: 15px;font-size: 15px;text-align: center;
    ;font-weight: bold;padding-top: 8px;}
.total_rate_sh span{font-size: 17px}
.combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
    display: inline-block;}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
    <?php include "includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
      
  <?php include"includes/new_right_menu.php"; ?>   
<?php if(in_array("table_selection", $_SESSION['menuarray'])) { ?> 
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> table_selection.php <?php }else {  ?>#<?php } ?>"><div class="backto_table_select" style="float:left;width: 165px">
                     <div class="backtable_ico"></div>
                     <div style="width: 130px;" class="tableselect_text"><?=$_SESSION['completed_order_table_selection']?></div>
           		 </div></a>
       <?php } ?>
            	<div class="billgeneration_head"><?=$_SESSION['completed_order_completed_orders']?></div>
                <div class="error_feed"></div>
                


      
       <?php if($_SESSION['s_ta_directclosefirst']=='N' && in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>             
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>payment_pending.php  <?php }else {  ?>#<?php } ?>"> <div class="backto_table_select back_bill_his" >
                     <div class="tableselect_text"><?=$_SESSION['completed_order_payment_pending']?></div>
                     <div style="background-image:url(img/goto_bill_ico.png);" class="backtable_ico"></div>
           		 </div></a>
       <?php } ?>
                  

                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
            <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>">
     		<div style="  min-height:480px;width:100%;" class="left_contant_container">
                     
                <div class="take_staff_view_cc">
                 
                	<div class="bill_shadow_left"></div>
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd new_left_settle_head"><?=$_SESSION['completed_order_table_details']?></div>
                        <div class="compaing_table_main_cc">
                            <button class="compaing_table_button camp" id="button1" style="display:block" onclick="enableButton1()"><?=$_SESSION['completed_order_combine123']?></button>
                            <button class="compaing_table_button camp1" id="button2" style="display:none" onclick="enableButton2()"><?=$_SESSION['completed_order_combine123']?></button>
                        </div>
                        
                    </div><!--take_staff_view_head-->
                    
                     
                     
                    <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                    	<div class="floor_sel_in_table_detail">
                     	<div class="floor_area_sel_name"><?=$_SESSION['completed_order_floor_select']?></div>
                        <div class="floor_area_sel_textbx">
                        	<select style="width:100%;" class="discount_text_box tax_textbox" id="co_areachnage" name="co_areachnage">
                                  <option value="" selected=""><?=$_SESSION['completed_order_select_area']?></option>
                                   <?php
					 //`tbl_floormaster`(`fr_floorid`, `fr_branchid`, `fr_floorname`, `fr_status`)
					 $sql_floor_sel  ='';
					 if(!is_null($_SESSION['floorstaff']))
						{
							 $sql_floor_sel  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."' AND fr_floorid='".$_SESSION['floorstaff']."'  and fr_status='Active' order by fr_floorid");
						}else
						{
						 $sql_floor_sel  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."' and fr_status='Active' order by fr_floorid"); 
						}
					
		  			$num_floor  = $database->mysqlNumRows($sql_floor_sel);
		 			if($num_floor){$i=0;
					while($result_floor_sel  = $database->mysqlFetchArray($sql_floor_sel)) 
					{ 
						  if($i==0) 
						  { 
							  $first=$result_floor_sel['fr_floorid'];
							  //$_SESSION['floorid']=$first; 
							  if(!isset($_SESSION['floorid']) || $_SESSION['floorid']=="all")
								{
								$_SESSION['floorid']=$first;
							   
								}
							  $i++; 
							  $firstfloor=$result_floor_sel['fr_floorname'];
						  }
					
							$_SESSION['florids']=$first;
                                                        $floor_name=$result_floor_sel['fr_floorname'];
                                                   
                                                   if($_SESSION['main_language']!='english'){
                
                                                    $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_floor_sel['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");

                                                    //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                    $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                     if($num_arabfloor){
                                                        while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                    $floor_name=$result_arabfloor['f_floor_name'];

                                                    }}}
//                                                    $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                                    $response_floor['messages'] = stream_get_contents($fpfloor);
//                                                    //echo  $response['messages'];
//                                                    $resu_floor= json_decode($response_floor['messages'],true);
//                                                    //var_dump($resu_floor);
//                                                    $floor_count=count($resu_floor['floor_id']);
//                                                    for($f=0;$f<$floor_count;$f++)
//                                                    {
//                                                        if($result_floor_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                            $floor_name=$resu_floor['floor_name'][$f];
//                                                        }  
//                                    
//                                                    }    
                                                        
                                            ?>
                                    <option value="<?=$result_floor_sel['fr_floorid']?>" <?php if($_SESSION['floorid']==$result_floor_sel['fr_floorid']){?> selected <?php } ?>><?=$floor_name//$result_floor_sel['fr_floorname']?></option>	
                    <?php }} ?> 
                    <!--<option value="all" <?php //if($_SESSION['floorid']=='all'){?> selected <?php //} ?>><?=$_SESSION['completed_order_all_flr']?></option>		-->
                                  </select>
                        </div>
                     </div><!--floor_sel_in_table_detail-->

                      <div class="bill_gen_new_table_head " id="listheadsection">
                   
                    	<table class="billgenration_new_table" width="100%" border="0">
                        	<thead>
                                    <tr>
                                   <th width="20%"><?=$_SESSION['completed_order_tableno']?></th>
                                    <th width="25%"><?=$_SESSION['completed_order_ordertime']?></th>
                                     <?php if($_SESSION['floorid']=='all'){?> <th width="20%"><?=$_SESSION['completed_order_floor_select']?></th> <?php } ?>
                                    <th width="15%"><?=$_SESSION['completed_order_orderrate']?></th>
                                    
                                  </tr>
                            </thead>
                            </table>
                            </div><!--bill_gen_new_table_head-->
                     
                    <div id="load_listcompletedorders"  class="billgenration_new_table_content_container verifycompletedorder "  style="height:63.5vh">
                    
                        <table class="billgenration_new_table_content" id="autoselecttable" width="100%" border="0">
                        
 <?php
		 if((isset($_REQUEST['floorid'])))
			{
				$_SESSION['floorid']=$_REQUEST['floorid'];
				$_SESSION['florids']=$_REQUEST['floorid'];
                                $floorid=  trim(json_encode($_SESSION['floorid']),'""');
			}
		
		if(isset($_SESSION['floorid']))
		{
			
			if($_SESSION['floorid']=="all")
			{
				$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,ts.ts_totalamount,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,fm.fr_floorid FROM tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND (ts.ts_status<>'Billed') AND (ts.ts_completed_order = 'Y') AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno");
				//SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,ts.ts_totalamount,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,fm.fr_floorid FROM tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active'  AND ((tor.ter_status='Served' OR tor.ter_status='KOT_Cancel') AND tor.ter_status<>'Added') AND ts.ts_status<>'Billed'    AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno 
			}else
			{
			$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,ts.ts_totalamount,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,fm.fr_floorid FROM tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND ts.ts_floorid='".$_SESSION['floorid']."'  AND (ts.ts_status<>'Billed') AND (ts.ts_completed_order = 'Y') AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
			}
		  $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{     
                                            
                                            $floor_name="";
                                            $floor_name=$result_table_sel['fr_floorname'];
                                            
                                            if($_SESSION['main_language']!='english'){
                
                                                $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_table_sel['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");
                                                //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                if($num_arabfloor){
                                                    while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                    $floor_name=$result_arabfloor['f_floor_name'];
                                                }}}
//                                            $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                            //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//                                            $response_floor['messages'] = stream_get_contents($fpfloor);
//                                            //echo  $response['messages'];
//                                            $resu_floor= json_decode($response_floor['messages'],true);
//                                            //var_dump($resu_floor);
//                                            //var_dump($result_table_sel['fr_floorid']);
//                                            $floor_count=count($resu_floor['floor_id']);
//                                            //echo $floor_count;
//                                            for($f=0;$f<$floor_count;$f++)
//                                            {
//                                                if($result_table_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                $floor_name=$resu_floor['floor_name'][$f];
//                                                //echo $floor_name;
//                                                }  
//                                            }
                                    
                                    
                                    
                                    
                                                $table_name="";
                                              $table_id=$result_table_sel['ts_tableid'];
                                               $table_name=$result_table_sel['tr_tableno'];
//                                              $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                              $response_table['messages'] = stream_get_contents($fptable);
//                                              //var_dump($response_table['messages']);
//                                              $resu_table= json_decode($response_table['messages'],true);
//                                              //var_dump($resu_table['table_id'][0]);
//                                              $table_count=count($resu_table['table_id']);
//                                              // echo $table_count;
//                                              for($m=0;$m<$table_count;$m++){
//                                                  if($table_id==$resu_table['table_id'][$m])
//                                                  {
//                                                     $table_name=$resu_table['table_name'][$m]; 
//                                                     //echo $table_name;
//                                                  }
//                                              }
                                    
					?>
 
                                 <tr class="clickeachrowcompld" name="<?= $result_table_sel['ts_tableid'] ?>" pref="<?= $result_table_sel['ts_tableidprefix'] ?>" ordno="<?= $result_table_sel['ts_orderno'] ?>" tabname="<?= $result_table_sel['tr_tableno']?>" tablename="<?= $result_table_sel['tr_tableno']."(".$result_table_sel['ts_tableidprefix'].")" ?>"><!--<tr class="tr_bill_gen_active">-->
                                
                                    <td width="20%"><strong id="complete_tablename"><?=$table_name ." (".$result_table_sel['ts_tableidprefix'].")" ?></strong></td><!-- $result_table_sel['tr_tableno']-->
                                    <td width="25%"> <?= date("h:i:s",strtotime($result_table_sel['ts_dineintime'])) ?></td>
                                    <?php if($_SESSION['floorid']=='all'){?> <td width="20%"><?=$floor_name//$result_table_sel['fr_floorname']?></td> <?php } ?>
                                    <td width="15%"><?=number_format($result_table_sel['ts_totalamount'],$_SESSION['be_decimal'])?>/-</td>
                                  </tr>
                                
                   <?php }}else { 
				   ?>
                   <tr>
                   <td style="color:#F00"><?=$_SESSION['credit_settlement_error_record_display']?></td>
                   </tr>
                   <?php
				   }} ?>
                   
                
                            </table>
					</div><!--billgenration_new_table_content_container-->
                    
                                        <div style="width:100%; display:none;padding-top:22px;" class="no_selected_table_cc selectedtables no_of_table ">No of Selected Table (0)</div>

                    <div class="take_staff_view_cont_bottom_contain">
                        <input type="hidden" name="completeorder" id="compordermsg1" value="<?=$_SESSION['completed_order_error_selectorder_proceed']?>">
                        <input type="hidden" name="bilprintmsg" id="bilprintmsg" value="<?=$_SESSION['completed_order_bilprint']?>">
                        <input type="hidden" name="removcclmsg" id="removcclmsg" value="<?=$_SESSION['completed_order_removcclmsg']?>">
						<input type="hidden" name="itemcclmsg" id="itemcclmsg" value="<?=$_SESSION['completed_order_itemcclmsg']?>">
                        <input type="hidden" name="completeorder" id="compordermsg20" value="<?=$_SESSION['completed_order_error_number_error']?>">
                     <input type="hidden" name="printwithdiscount" id="printwithdiscount" value="<?=$_SESSION['s_printwithdiscount']?>">
                    <input type="hidden" name="printwithloyality" id="printwithloyality" value="<?=$_SESSION['s_printwithloyality']?>">
                      <input type="hidden" name="staffwithdiscount" id="staffwithdiscount" value="<?=$_SESSION['s_discountpermission']?>">
                      <input type="hidden" name="staffwithdiscountmanual" id="staffwithdiscountmanual" value="<?=$_SESSION['s_discount_manual']?>">
                    <input type="hidden" name="loyalityid" id="loyalityid">
                     <input type="hidden" name="printconfirmation" id="printconfirmation" value="N">
                     <input type="hidden" name="verifyconfirmation" id="verifyconfirmation" value="N">
                     <a href="#" class="verifycompletedorder" id="verifycompletedorder123" onclick="orderdiscclr()"><div></div></a>
<!--                     <a href="#" class="printcompletedorder" onclick="orderdiscclr()"><div class="bill_print_btn campaign"><?//=$_SESSION['completed_order_printbutton']//?></div></a>-->
                          <?php if($_SESSION['s_closebydiscount']=='Y') { ?>
                          <a href="#" class="discclosecompletedorder"><div class="bill_print_btn"><?=$_SESSION['completed_order_disccbutton']?></div></a>
                          <?php } ?>
                          <?php if($_SESSION['s_ta_directclosefirst']=='Y') { ?>
                          <a href="#" class="closecompletedorder"><div class="bill_print_btn"><?=$_SESSION['completed_order_closebutton']?></div></a>
                          <?php } ?>
                    	<!--<a href="#"><div class="bill_print_btn">Bill Split</div></a>-->
                       <!-- <a href="#"><div class="bill_print_btn">Close</div></a>-->
                           <!--<a href="#"><div class="bill_print_btn">Discount/Close</div></a>-->
                    </div>
                        
                    </div><!--take_staff_view_cont_cc-->
                </div><!--take_staff_view_cc-->
                
                <div style="width: 66.5%;margin-left: 0;margin-right: 0;" class="take_staff_view_cc">
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd "><?=$_SESSION['completed_order_order_details']?></div>
                    </div><!--take_staff_view_head-->
                  <div class="take_staff_view_cont_cc" id="listwholedetailslist">
                  
                              
                      
                  </div><!--take_staff_view_cc-->
                    <div class="take_staff_view_cont_bottom_contain" style="">
                     <div class="gst-number-cc" style="border:0;">
                    <div class="total_rate_sh cancel_rate_cc loadtotal" style="display:none"><?=$_SESSION['completed_order_total_rate']?> : <span id="totalrate">1500</span> </div>
                    <?php if($_SESSION['be_gst_info']=='Y') { ?>
                    
                    <div class="col-md-2" style="padding: 0 1%">
                                    	<input style="display:none" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="billname" placeholder="Customer Name" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0 1%">
                                        <input style="display:none" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="billnum" onkeypress="return numonly();"  placeholder="Contact No" />
                                    </div>
                                    <div class="col-md-2" style="padding: 0 1%">
                                    	<input style="display:none" type="text" class="discount_text_box tax_textbox gst-name-textbox" id="billgst" placeholder="GST Number" />
                                    </div>
                    
                    <?php }?>
                    	<a href="#" style="display:none" class="loadproceedbutton proceedbuttonclick"> 
                          <div style="height: 37px;margin-top: 3px;border-bottom: 3px solid #250400 !important;padding-top: 0px;" class="backto_table_select back_bill_his primary-clr">
                              <div style="line-height:33px;font-size:16px;" class="tableselect_text proceedbillbutton campaign"><?=$_SESSION['completed_order_proceedbillbutton']?></div>
                              <div style="background-image:url(img/goto_bill_ico.png);margin-top: 4px;" class="backtable_ico"></div>
                          </div>
                 		</a>
                         </div> 
                    </div>
                  </div><!--take_staff_view_cont_cc-->
                
                
                </div><!--take_staff_view_cc-->
                
            </div><!--left_contant_container-->
    
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->


 <div style="display:none;height: auto;bottom: auto;top: 30%;width: 315px;" class="index_popup_1 disountenterpopup">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head"><?=$_SESSION['completed_order_popup_enter_discount']?> </h3>
            
   		<span class="contenttext"  style="display: inline-block;margin: 10px 0 0 0;padding-left:6%;text-align: left;width: 100%;">
        <p style="display:inline-block;margin-bottom: 5px;"><?=$_SESSION['completed_order_popup_discount_type']?></p>
        	<!--<input type="text" class="form-control" name="disountamount" id="disountamount" style="width: 20%;margin-top: -37px;margin-left: 284px;  border: 1px solid #847D7D;">-->
        <select  class="form-control" autofocus="autofocus" name="disountamount_drop" id="disountamount_drop" onchange="dischange();" style="width:74%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;margin-left: 6.5%;   ">
              <option value="none"><?=$_SESSION['completed_order_popup_type_none']?></option>
              <?php
			  $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status!='Inactive'"); 
			  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
			  if($num_listall_dsc){
					while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
						{
			?>
             <option value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $row_listall_dsc['ds_discountname']//$row_listall_dsc['ds_discountname']?></option>
            <?php } } ?>
          </select>&nbsp; 
           <div class="discount_offer_or_cc">
          <?php if($_SESSION['s_discount_manual']=="Y") { ?>
          
              <!--<span style="margin:0 8px 0 0" class="or_round_sp"><?=$_SESSION['completed_order_popup_type_or']?> </span>-->
              <?=$_SESSION['completed_order_popup_type_manual']?> <input type="text" class="form-control" name="disountamount" id="disountamount" style="width:53%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;" value=""> 
              <label style="display:inline;font-weight:normal">
                   <span style="top:0px;" class="percen_radio">
                     <input type="radio" class="typesel" name="typesel" id="P"  value="P"<?php if($_SESSION['s_discpountypeoption']=="P") { ?> checked <?php } ?>>%
                   </span> 
               </label>
              <label style="display:inline;font-weight:normal">
                 <span style="top:17px;" class="percen_radio"> 
                    <input type="radio" class="typesel"  name="typesel" id="V"  value="V"<?php if($_SESSION['s_discpountypeoption']=="V") { ?> checked <?php } ?>><?=$_SESSION['completed_order_popup_discount_value']?>
                 </span> 
             </label>
              <?php } ?>  
            </div>
            
        </span>
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;border-top: 1px #e4e4e4 solid;">
    	<div  style="width: 28%;" class="btn_index_popup campaign"><a href="#" class="closedisount"><?=$_SESSION['completed_order_popup_bill_printbutton']?></a></div>
        <div  style="width: 28%;" class="btn_index_popup"><a href="#" class="canceldisount"><?=$_SESSION['completed_order_popup_bill_cancelbutton']?></a></div>
    </div>
 </div><!--index_popup_2-->
 
 <div style="display:none;height: auto;bottom: auto;top: 30%;width: 480px;" class="index_popup_1 loyalitypopup">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head" ><?=$_SESSION['completed_order_popup_loyality_details']?>
            	<div class="new_error_div anth-eror"><span class="error_loyal" style="float:right;color:#F00; display:none;width:100%;"></span></div>
            </h3>
   		<span class="contenttext" style="display: inline-block;margin: 10px 0 0 0;padding-left: 7%;text-align: left;width: 100%;">
       <!-- <p style="display:inline-block;margin-bottom: 5px;">Name</p>
        	<input type="text" class="form-control" name="loyalityname" id="loyalityname" style="width:30%;border: 1px solid #C1C1C1;display:inline-block;height: 34px;">
          &nbsp; <span class="or_round_sp">OR </span>-->
         <p style="display:inline-block;margin-bottom: 5px;"><?=$_SESSION['completed_order_popup_mobile']?></p>
        	<input type="text" class="form-control" name="loyalitymob" id="loyalitymob" style="width:30%;border: 1px solid #C1C1C1;display:inline-block;height: 34px;">
            
            
        </span>
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;">
    	<div class="btn_index_popup"><a href="#" class="loyalityok"><?=$_SESSION['completed_order_popup_loyality_submit']?></a></div>
        <div class="btn_index_popup"><a href="#" class="loyalitycancel"><?=$_SESSION['completed_order_popup_loyality_cancel']?></a></div>
    </div>
 </div><!--index_popup_2-->
 
 <div style="display:none;height: auto;bottom: auto;top: 30%;width: 320px;" class="index_popup_reg registerpopup">
 	<h3 class="sm_pop_head"><?=$_SESSION['completed_order_popup_loyality']?></h3>
 	<div style="width:35%;text-align:right;margin: 2% 0;" class="index_popup_contant"><?=$_SESSION['completed_order_popup_registered']?>?</div>
    <div style="width:65%;margin: 2% 0;" class="index_popup_contant">
    	<div style="width: 80px;" class="btn_index_popup"><a href="#" class="registeredok"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div style="width: 80px;" class="btn_index_popup"><a href="#" class="registeredcancel"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div><!--index_popup_2-->
 
 <input type="hidden" name="hidcancelsecret" id="hidcancelsecret" value="<?=$_SESSION['s_cancelwithsecret']?>">
  <input type="hidden" name="hidcancelsecretsinlgeauth" id="hidcancelsecretsinlgeauth" value="<?=$_SESSION['s_singlecancel_billauth']?>">
  
 <input type="hidden" name="hidordernumber" id="hidordernumber">
 <input type="hidden" name="hidkotno" id="hidkotno">
 <input type="hidden" name="hidslno" id="hidslno">
 <input type="hidden" name="hidmenuid" id="hidmenuid">
 <input type="hidden" name="hidqty" id="hidqty">
 
     
 
<input type="hidden" name="hid_menuchange" id="hid_menuchange">
<input type="hidden" name="hid_portchange" id="hid_portchange">
<input type="hidden" name="hid_kotchange" id="hid_kotchange">
<input type="hidden" name="hid_ordchange" id="hid_ordchange">
<input type="hidden" name="hid_final" id="hid_final">
<input type="hidden" name="hid_slno" id="hid_slno">
 <input type="hidden" name="hid_qtychange" id="hid_qtychange">
 
 <div style="display:none" class="index_popup_confrm confrimeachcancel">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_cancel']?></div>
    <div class="index_popup_contant">
        <div class="btn_index_popup"><a href="#" onclick="verifyclr()" class="canceleachitems"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closepopup_noeach"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
 
 <div style="display:none" class="index_popup_confrm confrimcancel">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_cancel']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="cancelitems"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closepopup"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
  <div style="display:none" class="index_popup_confrm confrimenable">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_enable']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="enableitems"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closepopup"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>

<div style="display:none" class="index_popup_confrm confrimclosedirect">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_closedirt']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closedirect"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="canc_closedirect"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
 <input type="hidden" id="discstatus" name="discstatus" >
 <div style="display:none" class="index_popup_confrm confrimclosedirectdiscount">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_discclose']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closedirectdisc"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="canc_closedirectdisc"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
 
 <div style="display:none" class="index_popup_confrm confrimprint">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_print']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="printconfirm"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closeprintconfirm"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
 <div style="display:none" class="index_popup_confrm confrimverify">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_verify']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="printverify"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closeprintverify"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>
 
<!-- <div style="display:none" class="index_popup_confrm confrimproceed">
 	<div class="index_popup_contant"><?=$_SESSION['completed_order_popup_msg_proceed']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="okproceed"><?=$_SESSION['completed_order_popup_reg_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="closeproceed"><?=$_SESSION['completed_order_popup_reg_no']?></a></div>
    </div>
 </div>-->



<div style="display:none;height: auto;bottom: auto;top: 30%;width: 315px;" class="index_popup_confrm confrimproceed">
 	<div style="height:auto" class="index_popup_contant">
            <h3 class="sm_pop_head"><?=$_SESSION['completed_order_popup_enter_discount']?> </h3>
            
   		<span class="contenttext"  style="display: inline-block;margin: 10px 0 0 0;padding-left:6%;text-align: left;width: 100%;">
        <p style="display:inline-block;margin-bottom: 5px;"><?=$_SESSION['completed_order_popup_discount_type']?></p>
<!--        	<input type="text" class="form-control" name="disountamount" id="disountamount" style="width: 20%;margin-top: -37px;margin-left: 284px;  border: 1px solid #847D7D;">-->
            <select  class="form-control" name="disountamount_drop" id="disountamount_drop" style="width:80%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;">
              <option value="none"><?=$_SESSION['completed_order_popup_type_none']?></option>
              <?php
			  $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status!='Non Active'"); 
			  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
			  if($num_listall_dsc){
					while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
						{
			?>
             <option value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $_SESSION[$row_listall_dsc['ds_discountid']]['discount']//$row_listall_dsc['ds_discountname']?></option>
            <?php } } ?>
          </select>&nbsp; 
           <div class="discount_offer_or_cc">
          <?php if($_SESSION['s_discount_manual']=="Y") { ?>
          
              <!--<span style="margin:0 8px 0 0" class="or_round_sp"><?=$_SESSION['completed_order_popup_type_or']?> </span>-->
              <?=$_SESSION['completed_order_popup_type_manual']?> <input type="text" class="form-control" name="disountamount" id="disountamount" style="width:40%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;" value="0"> 
              <label style="display:inline;font-weight:normal">
                   <span style="top:0px;" class="percen_radio">
                     <input type="radio" class="typesel" name="typesel" id="P"  value="P"<?php if($_SESSION['s_discpountypeoption']=="P") { ?>  <?php } ?>>%
                   </span> 
               </label>
              <label style="display:inline;font-weight:normal">
                 <span style="top:17px;" class="percen_radio"> 
                    <input type="radio" class="typesel"  name="typesel" id="V"  value="V"<?php if($_SESSION['s_discpountypeoption']=="V") { ?> checked <?php } ?>><?=$_SESSION['completed_order_popup_discount_value']?>
                 </span> 
             </label>
              <?php } ?>  
            </div>
            
        </span>
    </div>
    <div class="index_popup_contant" style="margin-top: 4px;border-top: 1px #e4e4e4 solid;">
    	<div  style="width: 25%;" class="btn_index_popup"><a href="#" class="closedisount"><?=$_SESSION['completed_order_popup_bill_printbutton']?></a></div>
        <div  style="width: 25%;" class="btn_index_popup"><a href="#" class="canceldisount"><?=$_SESSION['completed_order_popup_bill_cancelbutton']?></a></div>
    </div>
 </div><!--index_popup_2-->





 
  <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadcanceldetails">
 	<div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['bill_history_popup_cancellation']?>
    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
    </h3></div>
    	
    <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
        <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext" id="reasontext" autofocus="autofocus"></div><br>
        <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_staffname']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
         <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
           <option value="null" default><?=$_SESSION['bill_history_popup_select_staff']?></option>
           <?php
               $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'"); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                      {
                      ?>
          <option class="popup_conform_his" value="<?=$result_login['ser_staffid']?>" cancelkey="<?=$result_login['ser_cancelwithkey']?>"><?=$_SESSION[$result_login['ser_staffid']]['staffmaster_first']//$result_login['ser_firstname']?></option>
         <?php } } ?>	
          </select>
          <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp"><?=$_SESSION['bill_history_popup_send_otpbutton']?></a></div>
        
        </div><br>
        <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?> <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
    </div>   
    <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
    	<div style="width: 95px;" class="btn_index_popup"><a href="#" class="submitcancelation"><?=$_SESSION['bill_history_popup_submitbutton']?></a></div>
        <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closepopup"><?=$_SESSION['bill_history_popup_cancel']?></a></div>
    </div>      
 </div>
 <input type="hidden" name="hidenterpaswd" id="hidenterpaswd" value="<?=$_SESSION['completed_order_popup_password']?>">
 <input type="hidden" name="hidenterotp" id="hidenterotp" value="<?=$_SESSION['completed_order_popup_otp']?>">
 <input type="hidden" name="hiderrormg" id="hiderrormg" value="<?=$_SESSION['completed_order_error_error_mg']?>">
 <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_2 loadsinglecancelauth">
 	<div class="index_popup_contant textcontent"><h3 class="sm_pop_head"><?=$_SESSION['bill_history_popup_cancellation']?>
    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror_sca"></span></div>
    </h3></div>
    	
    <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:5%;text-align:left;width:100%;height:auto">
    	<span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_reason']?></span><div style="background-color: #fff !important;width: 60%;height:auto;    margin-bottom: 15px;" class="btn_index_popup"><input type="text" class="popup_conform_his" style="" name="reasontext_sca" id="reasontext_sca"></div><br>
        <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_select_staff']?></span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
         <select style="float: left;width: 51%;" class="popup_conform_his"  id="stafflist_sca" name="stafflist_sca" >
           <option value="null" default>Select Staff</option>
           <?php
               $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'"); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                      {
                      ?>
          <option class="popup_conform_his" value="<?=$result_login['ser_staffid']?>" cancelkey="<?=$result_login['ser_cancelwithkey']?>"><?=$_SESSION[$result_login['ser_staffid']]['staffmaster_first']//$result_login['ser_firstname']?></option>
         <?php } } ?>	
          </select>
          <div style="margin-top:0px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp_sca"><?=$_SESSION['bill_history_popup_send_otpbutton']?></a></div>
        
        </div><br>
        <span style="line-height: 40px;width:26%;float:left"><?=$_SESSION['bill_history_popup_enter_password']?> <span id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey_sca" id="secretkey_sca"></div>
    </div>   
    <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
    	<div style="width: 95px;" class="btn_index_popup"><a href="#" class="submitsinglecancelauth"><?=$_SESSION['bill_history_popup_submitbutton']?></a></div>
        <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closepopupauth"><?=$_SESSION['bill_history_popup_cancel']?></a></div>
    </div>      
 </div>
 
 
  <input type="hidden" name="hidbillclose_null" id="hidbillclose_null" value="<?=$_SESSION['procedures_proc_billclose_null']?>">
  <input type="hidden" name="hidbillclose_closed" id="hidbillclose_closed" value="<?=$_SESSION['procedures_proc_billclose_closed']?>">

  <input type="hidden" name="hidbillgenerate_error" id="hidbillgenerate_error" value="<?=$_SESSION['procedures_proc_billgenerate_error']?>">
  <input type="hidden" name="hidbillgenerate_pend" id="hidbillgenerate_pend" value="<?=$_SESSION['procedures_proc_billgenerate_pend']?>">
  <input type="hidden" name="hidbillgenerate_bill" id="hidbillgenerate_bill" value="<?=$_SESSION['procedures_proc_billgenerate_bill']?>">
 <div style="display:none" class="confrmation_overlay"></div>
 
<div style="display:none" class="new_print_loading_bill"><img src="img/ajax-loaders/ajax-loader.gif"></div> 
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
	height:50px;
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
	height:35px;
	line-height:35px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	margin-top:7px;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}
.new_print_loading_bill{width:100%;height:100%;position:absolute;top:0;left:0;background-color:rgba(0,0,0,0.7);text-align:center;z-index:9999999999999;padding-top:40vh;}
.new_print_loading_bill img {width:100px;}

	</style>

  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
 <script>
  $('.sendotp').click(function () {//alert("j");
   
   
  
		var stafflist       =  $('#stafflist').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
		$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			$("#deatilserror").css("display","block");
			$("#deatilserror").text("OTP Send..");
			$("#deatilserror").delay(2000).fadeOut('slow');
			//alert(data);
			});
	 
	 
	 });
         
function verifyclr()
                        {
                            document.getElementById('reasontext').value = '';
                            document.getElementById('stafflist').value = 'null';
                            document.getElementById('secretkey').value = '';
                        }
 $('.sendotp_sca').click(function () {//alert("j");
   
   
  
		var stafflist       =  $('#stafflist_sca').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
		$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			$("#deatilserror_sca").css("display","block");
			$("#deatilserror_sca").text("OTP Send..");
			$("#deatilserror_sca").delay(2000).fadeOut('slow');
			//alert(data);
			});
	 
	 
	 });
         function orderdiscclr()
{
	document.getElementById('disountamount_drop').value = 'none';
	document.getElementById('disountamount').value = '';
        $("#V").each(function() { this.checked=false; });
        $("#P").each(function() { this.checked=true; });
} 
 
 
 

      

 
 
 
 
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
    if(ds1!=''){
     $('#disountamount_drop').attr("disabled","disabled"); 
 }else{
      $('#disountamount_drop').removeAttr('disabled');
 }
  });
      

          
          
</script>
 
 <div style="display:none;height: 160px;" class="index_popup_1 closeoneclass kotconfirmpopup">
        <span id="kotfailmsg" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant">Are you sure you want continue without Bill Print ?</div>
    <div class="index_popup_contant">
        <?php
         $sql_listall_dsc1  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_printer "); 
			  $num_listall_dsc1  = $database->mysqlNumRows($sql_listall_dsc1);
			  if($num_listall_dsc1){
					while($row_listall_dsc1  = $database->mysqlFetchArray($sql_listall_dsc1)) 
						{
                         $billonoff=$row_listall_dsc1['bp_print_proceed_btn'];  
                         if($billonoff=='Y'){
        ?>
        
        
    	<div class="btn_index_popup"><a href="#" class="confirmbillok">Yes</a></div>
                         <?php } } }?>
        
        <div class="btn_index_popup"><a href="#" class="confirmbillclose">Cancel</a></div>
    </div>
 </div>
 
 
</body>

</html>