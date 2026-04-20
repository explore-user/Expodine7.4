<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");
//include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }

if(!isset($_SESSION['set_billnotosplit']) ){ header("location:payment_pending.php"); }

//echo $_SESSION['set_billnotosplit'];



$bills=$_SESSION['bilsplitorderfinal'];
foreach( $bills as $number => $value)
 {//$value=
 $sql_table_sel  =  $database->mysqlQuery("DELETE FROM tbl_tablebilldetails WHERE bd_billno='".$value."'");
 
 }
 unset($_SESSION['bilsplitorderfinal']);

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
<link href="css/menu_odr_bill.css" rel="stylesheet" type="text/css">
<link href="css/bill_split.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/bill_split_main.js"></script>
<style>
body{font-family:inherit;background-color:#ccc !important}
/*.left_contant_container {height: 80vh;padding-bottom:15px;}*/	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.bill_split_center_table th{min-width:100px;}
.bill_split_center_table td{min-width:100px;}
</style>

</head>

<body>

<div class="container-fluid no-padding">
     <?php include"includes/topbar.php"; ?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
      
                  <?php include"includes/new_right_menu.php"; ?>  
                  
          <?php if($_SESSION['s_ta_directclosefirst']=='N' && in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>             
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>payment_pending.php  <?php }else {  ?>#<?php } ?>"> <div class="backto_table_select" style="float:left;width: 165px">
                     <div class="backtable_ico"></div>
                     <div style="width: 130px;" class="tableselect_text"><?=$_SESSION['bill_split_payment_pending']?></div>
           		 </div></a>
       <?php } ?>
                  
                               
                
      <input type="hidden" name="hidbilnosplit" id="hidbilnosplit" value="<?=$_SESSION['set_billnotosplit'] ?>">
            	<div class="billgeneration_head"><?=$_SESSION['bill_split_billsplit']?></div>
                <div class="error_feed"></div>
                
            </div>
          
            
      		<div class="bill_split_left_contant_container">
                     
                <div class="billsplit_left_container">
                    <div class="bill_split_head">
                    	<span><?=$_SESSION['bill_split_table_split']?></span>
<!--                    	<div class="bill_split_head_right_chk">
                        	<div class="checkboxFive">
                                    <input type="checkbox" value="1" id="checkboxFiveInput" name="selectwhole"  class="wholeclick"  checked  />
                          <label for="checkboxFiveInput"></label>
                          </div>
                        </div>-->
                    </div><!--bill_split_head-->
                    <?php
					//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`, `ts_floorid`, `ts_orderstaff`, `ts_reservetime`, `ts_totalamount`, `ts_entrydate`, `ts_interface`, `ts_billnumber`, `ts_paxcount`, `ts_username`, `ts_in_access`) 
					//`tbl_tablemaster`(`tr_tableid`, `tr_branchid`, `tr_floorid`, `tr_tableno`, `tr_status`, `tr_maxchaircount`, `tr_vaccantcount`, `tr_nextprefix_ascii`, `tr_displayorder`)
					?>
                    <div class="bill_split_contant_cc">
                     <div class="bill_split_contant_scroll">
                     <?php
					 
					  $sql_menulists="select ts.ts_tableid,ts.ts_tableidprefix,tm.tr_tableno,ts.ts_totalamount,ts.ts_orderno FROM tbl_tabledetails as ts LEFT JOIN  tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid where ts.ts_billnumber='".$_SESSION['set_billnotosplit']."' ";
					  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
					  $num_menuss  = $database->mysqlNumRows($sql_menuss);
					  if($num_menuss){	
					  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
							  {	$qty=0;
                                                          
                                                          $table_name="";
                                                          $table_id=$result_menuss['ts_tableid'];
                                                          $table_name=$result_menuss['tr_tableno'];
//                                                          $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                                          $response_table['messages'] = stream_get_contents($fptable);
//                                                          //var_dump($response_table['messages']);
//                                                          $resu_table= json_decode($response_table['messages'],true);
//                                                          //var_dump($resu_table['table_id'][0]);
//                                                          $table_count=count($resu_table['table_id']);
//                                                          //echo $table_count;
//                                                          for($m=0;$m<$table_count;$m++){
//                                                            if($table_id==$resu_table['table_id'][$m])
//                                                            {  
//                                                                $table_id1=$resu_table['table_id'][$m];
//                                                                $table_name=$resu_table['table_name'][$m]; 
//                                                                //echo $table_name;
//                                                            }
//                                                        }
                                                          
                                                          
                                                          
							  $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$_SESSION['set_billnotosplit']."' order by td.bd_billslno "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
								 $qty=$qty + $row_listall['bd_qty'];
							  }}
							  //echo $qty;		
										
					  ?>
                         <input type="hidden" name="bilsplittotqty" id="bilsplittotqty" value="<?=$qty?>">
                         <input type="hidden" name="billsplit" id="billsplitmsg1" value="<?=$_SESSION['bill_split_error_select_tables']?>">
                    	<input type="hidden" name="billsplit" id="billsplitmsg2" value="<?=$_SESSION['bill_split_error_invalid_split']?>">
                        <input type="hidden" name="billsplit" id="billsplitmsg3" value="<?=$_SESSION['bill_split_error_invalid_quantity']?>">
                        <input type="hidden" name="billsplit" id="billsplitmsg4" value="<?=$_SESSION['splited_view_error_enter_fields']?>">
                        
                        <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>">
                        <div class="bill_split_left_table_detail">
                            <div class="bill_split_left_chk_box"><input type="checkbox"  class="singlecheck"  value="1" id="" name="selecteach" tableid="<?=$result_menuss['ts_tableid']?>" prefx="<?=$result_menuss['ts_tableidprefix']?>" orderno="<?=$result_menuss['ts_orderno']?>" tablenames="<?=$table_name."(".$result_menuss['ts_tableidprefix'].")" ?>" checked/></div>
                        	<div class="bill_split_left_table_no"><?=$table_name."(".$result_menuss['ts_tableidprefix'].")" ?></div><!--$result_menuss['tr_tableno']-->
                            <div class="bill_split_left_table_rate"><?=number_format($result_menuss['ts_totalamount'],$_SESSION['be_decimal'])?>/-</div>
                        </div>
                        <?php
							}
						}
						?>
                        
                     </div><!---bill_split_contant_scroll-->
                        
                        <div class="bill_split_botttom_container shadow">
                        	<div class="billsplit_botom_left_text"><?=$_SESSION['bill_split_total']?></div>
                            <?php
							$bilamont=$database->show_billdetails_ful($_SESSION['set_billnotosplit']);
							?>
                            <div class="billsplit_botom_rate biltotalrate" ><?=number_format($bilamont['bm_subtotal'],$_SESSION['be_decimal'])?>/-</div>
                        </div><!--bill_split_botttom_container-->
                        
                    </div><!--bill_split_contant_cc-->
                </div><!--billsplit_left_container-->
                
                <div class="billsplit_right_container">
               
                	<div class="bill_split_head">
                    	<span><?=$_SESSION['bill_split_split_bill']?></span>
                   		<div class="center_left_textbox_contain">
                         <div class="center_left_textbox"><input placeholder="<?=$_SESSION['bill_split_placeholder_add_bill']?>" class="bill_split_textbox" name="bilsplitcount" id="bilsplitcount" type="text"></div>
                            <a href="#" class="addsplitnumbers"><div class="center_left_textbox_btn"><?=$_SESSION['bill_split_addbutton']?></div></a>
                        </div>
                        <div class="billsplit_right_top_chk_btn">
                        	<div class="bill_split_top_right_chk_box"><!--<input type="checkbox" value="1" id="" name="">--></div>
                            <a class="confirmbills" style="display:none"><div class="center_right_top_textbox_btn"><?=$_SESSION['bill_split_confirm_button']?></div></a>
                            <a  style="display:none" class="completeall"><div class="center_right_top_textbox_btn"><?=$_SESSION['bill_split_confirmsplit_okbutton']?></div></a>
                            <!--href="billsplited_view.php"-->
                        </div>
                    </div>
                   
                  <div class="loadbildeatilstotal"><!--list whole list load -- jeshina-->
                
                 </div><!--list whole list load ends -- jeshina-->
                
                
                </div><!--take_staff_view_cc-->
                
            </div><!--left_contant_container-->
    
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->

 <div style="display:none" class="index_popup_confrm confrimverify">
 	<div class="index_popup_contant conformpop_head"> <?=$_SESSION['bill_split_popup_confirm_split']?></div>
	<div class="index_popup_contant confrim_pop_new_value_cc"><span class="conform_pop_left_txt"><?=$_SESSION['bill_split_popup_table_names']?> -</span>  <span class="tableidpop conform_pop_right_txtbox">  </span></div>
 	<div class="index_popup_contant confrim_pop_new_value_cc"> <span class="conform_pop_left_txt"><?=$_SESSION['bill_split_popup_split_no']?> -</span>  <span class="splitnospop conform_pop_right_txtbox"> </span> </div>
 	<div class="index_popup_contant conform_msg_split"><strong><?=$_SESSION['bill_split_popup_split_sure']?>  ?</strong></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="yesverify"><?=$_SESSION['bill_split_popup_split_yesbutton']?></a></div>
        <div class="btn_index_popup"><a href="#" class="noverify"><?=$_SESSION['bill_split_popup_split_nobutton']?></a></div>
    </div>
 </div>
 
 <div style="display:none;height:90px" class="index_popup_confrm confrimwhole" >
 	<div class="index_popup_contant conform_msg_split"><strong><?=$_SESSION['bill_split_popup_split_proceed']?></strong></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="cfmverify"><?=$_SESSION['bill_split_popup_proceed_yes']?></a></div>
        <div class="btn_index_popup"><a href="#" class="nocfmverify"><?=$_SESSION['bill_split_popup_proceed_no']?></a></div>
    </div>
 </div>
 
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
	height:40px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}
.index_popup_confrm{
	width:35%;
	height:200px;
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
<script type="text/javascript">
$(function(){
 $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_scroll_center_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
  $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_table_head_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
});
</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>   
</body>

</html>