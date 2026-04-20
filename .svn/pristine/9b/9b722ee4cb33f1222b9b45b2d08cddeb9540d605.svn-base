
<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("database.class.php");
$database	= new Database(); 
include('includes/master_settings.php');

if(isset($_REQUEST['set_split'])&& $_REQUEST['set_split']=="order_split"){

 if (isset($_REQUEST['billcount'])) {
   $_SESSION['billcount']=$_REQUEST['billcount'];
   $_SESSION['paxcount']=0;
   $_SESSION['order_type']=" - MANUAL";
  
   
}

if (isset($_REQUEST['pax'])) {
    $_SESSION['paxcount']=$_REQUEST['pax'];
    $_SESSION['billcount']=0;
    $_SESSION['order_type']=" - EQUAL";
   
}

if (isset($_REQUEST['order_no'])) {
    
$_SESSION['split_orderno']=$_REQUEST['order_no'];


}

if (isset($_REQUEST['floor_split'])) {
    
$_SESSION['floor_split']=$_REQUEST['floor_split'];

}


}


$orderno_od=explode(',',$_SESSION['split_orderno']);       

    $orderno116=array();
    $orderno116=array_unique($orderno_od);
    foreach($orderno116 as $key => $value){
                                  
                                 if($value!=""){
 $sql_spl= $database->mysqlQuery("select ter_staff from tbl_tableorder where ter_orderno='".$value."' and ter_qty>0");
                      
                            $num_spl = $database->mysqlNumRows($sql_spl);
                            if ($num_spl) {
                               
                                while ($result_spl = $database->mysqlFetchArray($sql_spl)) {
                                    
                                     $_SESSION['stw_split']=$result_spl['ter_staff'];
                                }
                                }


                                 }
                                }

?>		

<html>
<head>

<title>Order Split  </title>
<link rel="shortcut icon" href="img/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/table_new.css">
    <link rel="stylesheet" href="css/bootstrap-3.3.2.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles_drop.css" />
<!--    <link rel="stylesheet" type="text/css" href="css/new-index.css" />-->
    <link id="main-css" href="css/accord/accordion.css" rel="stylesheet"/>
    <link id="main-css" href="css/accord/font-awesome.css" rel="stylesheet"/>
         
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/require_status_style.css">
    <link rel="stylesheet" href="css/responsive.css">
        
    <script src="js/jquery-1.10.2.min.js"></script> 
    
    <style>/*body{overflow:auto !important}*/  .index_popup_2{z-index:9999999999 !important}.navbar-default .manage {display: none;}body{background-image: none !important;background-color: #e6e6e6;}
       .order_split_top_section{position: relative}
.keybord_sec_cc{
	width: 40px;
    height: 53px;
    float: left;
    background-color: #0a212f;
    position: absolute;
    right: 1px;
    border-bottom: 4px #05141d solid;
    -moz-border-radius-topleft: 0px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomleft: 0px;
    -moz-border-radius-bottomright: 5px;
    -webkit-border-top-left-radius: 0px;
    -webkit-border-top-right-radius: 10px;
    -webkit-border-bottom-left-radius: 0px;
    -webkit-border-bottom-right-radius: 5px;
    border-top-left-radius: 0px;
    border-top-right-radius: 5px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 5px;
    text-align: center;
    padding-top: 14px;
}
.keybord_sec_cc img{
	width: 19px;
}
.key_bord_counter_sel{
	    width: 220px;
    height: auto;
    float: left;
    position: absolute;
    bottom: -226px;
}
.key_bord_counter_sel_cc{
	width: 100%;
	height: auto;
	float: left;
}
.key_bord_counter_sel_cc .settle_key{
	margin-top: 0;
	background-color: rgba(125, 121, 115, 0.36);
    border-radius: 5px;
}
.key_bord_counter_sel_cc .settle_key .calculator_settle:nth-child(3n+3) {
    margin-right: 0 !important;
}
.key_bord_counter_sel_cc .keys span, .top span.clear{width: 31%;}


.key_bord_counter_sel_cc .settle_key .clc_btn_12:nth-child(3n+3) {
    margin-right: 0 !important;
}
.keys span, .top span.clear {
    float: left;
    position: relative;
    top: 0;
    cursor: pointer;
    width: 30%;
    height: 45px;
    background: rgba(255, 255, 255, 0.67);
    border-radius: 3px;
    box-shadow: 0px 4px rgba(0, 0, 0, 0.8);
    -moz-box-shadow: 0px 4px rgba(0, 0, 0, 0.8);
    -webkit-box-shadow: 0px 4px rgba(0, 0, 0, 0.8);
    margin: 0 3% 4% 0;
    color: #000 !important;
    font-size: 16px;
    line-height: 3em;
    text-align: center;
    user-select: none;
    transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -o-transition: all 0.2s ease;
    -ms-transition: all 0.2s ease;
}
.keys span:hover{background-color: #fff;}
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
	height:50px;
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
	    display: inline-block;
    height: 35px;
    line-height: 35px;
    background-color: #FF2306;
    text-align: center;
    margin-right: 1%;
    border-radius: 5px;
    transition: all 0.2s ease;
    margin-top: 7px;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}    
.discount_offer_or_cc{width: 100%; height: auto; float: left;  position: relative;}
.percen_radio {
    width: 60px;
    height: 20px;
    line-height: 20px;
    position: absolute;
    top: 40px;
}
</style>   
</head>

<body>
 <div style="display:none" class="confrmation_overlay"></div>
  <div id="container">
  <?php include "includes/topbar.php"; ?>
  </div> <!--container-->

  <div class="new_main_page_container">
      
      <?php
        $min_redeem=0;
        $sql_cat2  =  $database->mysqlQuery("select * from tbl_branchmaster "); 
					$num_cat2   = $database->mysqlNumRows($sql_cat2);
					if($num_cat2){
					while($result_cat2  = $database->mysqlFetchArray($sql_cat2)) 
						{
                                            
                                            $loyalty_on_off=$result_cat2['be_loyalty_settle'];
                                            $min_redeem =$result_cat2['be_min_redeem_point'];
                                                }
                                        }

         $point_rule=1;                        
         $amount_rule=1;                        
         $sql_desg_nos119="select * from tbl_loyalty_redeem_rule";

				$sql_desg119  =  $database->mysqlQuery($sql_desg_nos119);
				$num_desg119  = $database->mysqlNumRows($sql_desg119);
			      
				if($num_desg119){
				while($result_desg119  = $database->mysqlFetchArray($sql_desg119)) 
					{
						$point_rule=$result_desg119['lyr_point'];					
						$amount_rule=$result_desg119['lyr_amount'];
                                              
					}
                                        
                                }
                                
                                $point_rule_add=1;
                                $amount_rule_add=1;
                                $sql_desg_nos1190="select * from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }
                                
                                
                                ?>  
      
        <input type="hidden"  id="subtotal_loy_org">
      
      
      <input type="hidden" id="point_rule_add" amt_add="<?=$amount_rule_add?>" value="<?=$point_rule_add?>" />
          <input type="hidden" id="point_rule" amt="<?=$amount_rule?>" value="<?=$point_rule?>" />                                
               <input type="hidden" id="min_redeem" value="<?=$min_redeem?>">              
             <input type="hidden" id="grand_org">
      
     <input type="hidden" value="<?=$loyalty_on_off?>"  id="loyalty_status">  
      <input type="hidden" id="focusedtext">
      <input type="hidden" value="<?=$_SESSION['s_printwithdiscount']?>" id="discount_enable">
       <input type="hidden" value="<?=$_SESSION['loyalty_settle_on']?>" id="loyalty_on_off">
      
      <input type="hidden" value="<?= $_SESSION['stw_split']?>" id="steward" >
      <input type="hidden" id="focus_split" >
      <input type="hidden" id="decimal"  value="<?=$_SESSION['be_decimal']?>">
      <input type="hidden" id="bill_count_return" value="0" >
      
      <input type="hidden" id="h_slno" >
      <input type="hidden" id="h_orderno" >
      <input type="hidden" id="h_forloop" >
      
       <input type="hidden"  id="h_slno_cb">
        <input type="hidden"  id="h_orderno_cb">
         <input type="hidden"  id="h_forloop_cb">
         
       <input type="hidden" id="h_slno_ad" >
      <input type="hidden" id="h_orderno_ad" >
      <input type="hidden" id="h_forloop_ad" >
      <input type="hidden"  id="h_tslno_ad">
      
       <input type="hidden"  id="enter_key_attr">
     
        <input type="hidden" id="floor_split" value="<?= $_SESSION['floor_split']?>" >
      <input type="hidden" id="slide_pax_count" value="<?=$_SESSION['paxcount']?>" >
       <input type="hidden" id="slide_bill_count" value="<?=$_SESSION['billcount']?>" >
  
  		<div class="order_split_top_section">
                    <strong>ORDER SPLIT </strong> 
                    <div class="key_bord_counter_sel key_1 calc_split" style="display:none">
			<div class="key_bord_counter_sel_cc">
			  <div class="keys settle_key">
                                <span class="clc_btn_12 split_table">1</span>
                                <span class="clc_btn_12 split_table">2</span>
                                <span class="clc_btn_12 split_table">3</span>
                                <span class="clc_btn_12 split_table">4</span>
                                <span class="clc_btn_12 split_table">5</span>
                                <span class="clc_btn_12 split_table">6</span>
                                <span class="clc_btn_12 split_table">7</span>
                                <span class="clc_btn_12 split_table">8</span>
                                <span class="clc_btn_12 split_table">9</span>
                                <span class="clc_btn_12 split_table">.</span>
                                <span class="clc_btn_12 split_table">0</span>
                                <span class="clc_btn_12 split_table">Clear</span>
                              
                            </div>
			  </div>
			</div>
                   
                    <a href="#" onclick="return calc_display();" ><div class="keybord_sec_orderplit"><img src="img/clc-btn.png"></div></a>
                    <div style="float: left;width: 235px; height:15px;font-size: 15px"> <strong style="color:red;" id="error_msg"></strong> </div>
<!--  			<a href="#"><div class="order_split_left_org_bill_table_btn">Print All</div></a>-->
                        <a id="cancel_btn_split" href="table_selection.php"><div style="background-color: chocolate;" class="order_split_left_org_bill_table_btn">Cancel all</div></a>
  		     </div>
  		
  		        <div class="order_split_left_org_bill">
  			<div class="order_split_left_org_bill_head">Orginal Order</div>
                        
  			<div class="order_split_left_section">
  			<div class="order_split_left_org_bill_table_head">
  				<table>
  						<tr>
  							<td width="40%">PRODUCT</td>         
  							<td width="20%">Unit</td>     
  							<td width="10%">QTY</td>	
  							<td width="20%">AMOUNT</td>
  						</tr>
  				</table>
  				</div>
  				<div class="order_split_left_org_bill_table_contant">
  				<table>
                                            
                                <?php
                                $orderno=explode(',',$_SESSION['split_orderno']);       
                                             
                                $table_name_list='';
                                $orderno11=array();
                                $orderno11=array_unique($orderno);
                                foreach($orderno11 as $key => $value){
                                  
                                 if($value!=""){
                                     
                                     
				 $sql_kotlist  =  $database->mysqlQuery("SELECT tm.tr_tableno,ts.ts_noofpersons,ts.ts_tableidprefix,tm.tr_tableid from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1.ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
				
                                $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
				if($num_kotlist){$i=0; $table_prefix=array(); $table_name=array(); $pax_table=array();
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {    
                                                                $table_prefix[]=$result_kotlist['ts_tableidprefix'];   
                                                                $table_id=$result_kotlist['tr_tableid'];
                                                                $table_name[]=$result_kotlist['tr_tableno'];
                                                                $table_name_list.=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')'.',';
                                                                $pax_table[]=$result_kotlist['ts_noofpersons'];
                                                                
                                                          } }  }
                                       $table_name_list = implode(',',array_unique(explode(',', $table_name_list)));
                                     ?>
                                            <tr>
                                                <td colspan="4">
                                                    <span style="background-color: #c1785c;" class="order-split-table-sec" >    Table :  <?php for($p=0;$p<count(array_unique($table_name));$p++){ if($p>0){ echo  '';} echo $table_name[$p] .'('.$table_prefix[$p].')';} ?> </span>  
                                                    <span style="background-color: #c1785c;float: right" class="order-split-table-sec" >Pax-  <?php for($pp=0;$pp<count(array_unique($pax_table));$pp++){ if($p>0){ echo  '';} echo $pax_table[$pp] ;} ?>    </span>
                                                </td>
                                            </tr>
                                            <?php
                                            
                                            
                                    $total2=0; 
                                    $combo_entry_count=array();       
                             $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."'  and cod.cod_cancel='N'"); 
					$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
					if($num_combo_list){
						  while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
							  {     
                                                            $slno2=$slno2+1; 
                                                            $combo_menu_array=array();
                                                          if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                                                $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                                                $total2=$total2+$result_combo_list['cod_combo_total_rate'];
                                                               
                                                                $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                                               left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                               where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                                                
                                                          ?>
                             
                                                    <tr>
<!--                                                       <td width="5%"><?//=$slno2?></td>-->
                                                       <td width="35%" style="text-align:left"><?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?><br>
<!--                                                           <span class="combo_tbl_lst"><?//=implode(',',array_unique($combo_menu_array));?></span>-->
                                                       </td>
                                                       <td width="20%" style="color:red">Combo</td>
                                                       <td width="10%" id="main_qty_combo<?=$value?><?=$result_combo_list['cod_count_combo_ordering']?>" menu_rate_each_combo="<?=$result_combo_list['cod_combo_pack_rate']?>" ><?=$result_combo_list['cod_combo_qty']?></td>
<!--                                                       <td width="15%"><?//=number_format($result_combo_list['cod_combo_pack_rate'],$_SESSION['be_decimal'])?></td>-->
                                                       
                                                       <td width="12%" ><span><?=number_format($result_combo_list['cod_combo_total_rate'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                <?php
                                                          }
                                                }}  
                                           
                            $sql_spl= $database->mysqlQuery("select *,tp.pm_portionshortcode,tm.mr_menuname,tm.mr_menuid from tbl_tableorder tb left join tbl_menumaster tm on tm.mr_menuid=tb.ter_menuid left join tbl_portionmaster tp on tp.pm_id=tb.ter_portion where tb.ter_orderno='".$value."' and tb.ter_qty>0 and tb.ter_count_combo_ordering IS NULL");
                      
                            $num_spl = $database->mysqlNumRows($sql_spl);
                            if ($num_spl) {
                               
                                while ($result_spl = $database->mysqlFetchArray($sql_spl)) {
                                    
                                        $slno=$result_spl['ter_slno'];
                                        $m_name_split= $result_spl['mr_menuname'];
                                        if($_SESSION['main_language']!='english'){
                
                                              $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_spl['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $m_name_split=$result_arabmenu['lm_menu_name'];
                                                }
                                    
                                                $sl=$sl+1;
                                                $total=$total+$result_spl['ter_total_rate'];
                                      ?>
                                           
  						<tr>
                                                    <td width="40%"><?=$m_name_split?> <span style="color:red">(<?=$result_spl['pm_portionshortcode']?>)</span> </td>         
                                                        <td width="20%"><?php if($result_spl['ter_unit_type']!=""){ echo $result_spl['ter_unit_type'];}else{ echo $result_spl['ter_rate_type']; } ?></td>     
  							<td id="main_qty<?=$result_spl['ter_slno']?><?=$value?>"  menu_rate_each="<?=$result_spl['ter_rate']?>" width="10%"><?=$result_spl['ter_qty']?></td>	
  							<td width="20%"><?=number_format($result_spl['ter_total_rate'],$_SESSION['be_decimal'])?></td>
  						</tr>
                                                
                                                 <?php
                                                     
                                                
                                                   } }
                                                
                                                   }
                                 
                                          $whole_total=$total+$total2;
                                                ?>
  					</table>
  				</div>
  				<div class="order_split_left_org_bill_table_btm_rate">
                                 <span style="float:left">ITEMS : &nbsp; <?=($sl+$sl1+$slno2)?></span>
                                 <span>TOTAL : &nbsp;&nbsp; <span id="grandtotal"><?=number_format($whole_total,$_SESSION['be_decimal'])?></span> </span> 
				</div>
  				
  		</div>
  		</div><!--order_split_left_org_bill-->
  		<div class="right_splited_order_sec">
  			<div style="display: none " id="rightArrow"><img src="img/arow-rght.png"></div>
  		  <div id="tslshow">
                       
                      
  <!--  ------------------bill count start------------------------------  -->			
  	
  
  
   <?php
        for($ic=0;$ic<$_SESSION['billcount'];$ic++){
   ?>
 
  			        <div class="right_splited_order_box">
                                     <div id="disable_split<?=$ic?>"  class=""></div>
  				<?php if($ic==($_SESSION['billcount']-1)){ ?>
                                    <div class="add_new_bill"><img src="img/pls_btn.png" style="display:none"></div>
                                    <?php }?>
  				<div class="right_splited_order_box_head">
					<div class="right_splited_order_box_head_bill"></div>
					<div class="right_splited_order_box_head_bill_1">Bill - <?=$ic+1?></div>
  				</div>
				<div class="right_splited_order_box_cnt_table_cc">
					<div class="right_splited_order_box_cnt_table_head">
					<table>
                                        <tr>
					<td width="40%">PRODUCT</td>         
					<td width="40%">QTY</td>	
					<td width="20%">AMOUNT</td>
					</tr>
  					</table>
					</div>
					<div class="order_splited_bill_table_contant">
					<table>
                                 <?php
                                 $old_tableno="";
                                 $table_no_all="";
                                $orderno=explode(',',$_SESSION['split_orderno']);       
                                $table_name_list='';
                                $orderno11=array();
                                $orderno11=array_unique($orderno);
                                  $zz=0;
                                foreach($orderno11 as $key => $value){
                                  
                                 if($value!=""){
                                 $i=0; $table_prefix=array(); $table_name=array(); $pax_table=array(); 
                                     
				 $sql_kotlist  =  $database->mysqlQuery("SELECT tm.tr_tableno,ts.ts_noofpersons,ts.ts_tableidprefix,tm.tr_tableid from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1.ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='".$value."'  and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
                                
                                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
                                         
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {    
                                               
                                                      $table_prefix[]=$result_kotlist['ts_tableidprefix'];   
                                                                $table_id=$result_kotlist['tr_tableid'];
                                                                $table_name[]=$result_kotlist['tr_tableno'];
                                                                $table_name_list.=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')'.',';
                                                                $pax_table[]=$result_kotlist['ts_noofpersons'];
                                                                
                                                                if($zz==0){
                                                                    if($old_tableno!=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')'){
                                                                     $old_tableno=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')';
                                                                $table_no_all.=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')';
                                                                    }
                                                                }else{
                                                                    if($old_tableno!=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')'){
                                                                     $old_tableno=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')';
                                                                      $table_no_all.=",".$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')';
                                                                    }
                                                                }
                                                                    $zz++;
                                                                   
                                                          } }  }
                                                          $table_name_list = implode(',',array_unique(explode(',', trim($table_name_list,','))));
                                                          
                       ?>
                                            <tr>
                                                <td colspan="4">
                                                    <span style="background-color: #c1785c;" class="order-split-table-sec" >    Table :  <?php for($p=0;$p<count(array_unique($table_name));$p++){ if($p>0){ echo  '';} echo $table_name[$p] .'('.$table_prefix[$p].')';} ?> </span>  
                                                    <span style="background-color: #c1785c;float: right" class="order-split-table-sec" >Pax-  <?php for($pp=0;$pp<count(array_unique($pax_table));$pp++){ if($p>0){ echo  '';} echo $pax_table[$pp] ;} ?>    </span>
                                                </td>
                                            </tr>
                                            <?php
                              $slno3=0; $total2=0;
                                           $combo_entry_count=array();  
                                            $combo_entry_combo=  array();
                                           $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering,cod.cod_menu_id, cod.cod_kot_no,cod.cod_combo_pack_rate,cod.cod_combo_id,cod.cod_combo_id,cod.cod_combo_pack_id, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."'  and cod.cod_cancel='N'"); 
					
                                           $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
					if($num_combo_list){
                                           
						  while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
							  {
                                                      
                                                      
                                                       $combo_entry_combo[]=$result_combo_list['cod_count_combo_ordering'];
                                                     
                                                            $slno3++;
                                                            $combo_menu_array=array();
                                                          if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                                                $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                                                $total2=$total2+$result_combo_list['cod_combo_total_rate'];
                                                               
                                                                $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                                               left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                               where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                                                
                                                          ?>
                             
                                                    <tr class="details_row_split_combo<?=$ic?><?=$value?><?=$result_combo_list['cod_count_combo_ordering']?>" >
<!--                                                       <td width="5%"><?//=$slno3?></td>-->
                                                       <td width="35%" style="text-align:left" class="menuid_row_split_combo<?=$ic?><?=$value?><?=$result_combo_list['cod_count_combo_ordering']?>"    menukot_combo="<?=$result_combo_list['cod_kot_no']?>"    menuid_attr_combo_id="<?=$result_combo_list['cod_combo_id']?>" menuid_attr_combo_pack_id="<?=$result_combo_list['cod_combo_pack_id']?>"   > <?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?> <span style="color:red">[C]</span><br>
<!--                                                           <span class="combo_tbl_lst"><?//=implode(',',array_unique($combo_menu_array));?></span>-->
                                                       </td>
                                                       
<!--                                                       <td width="10%"><?//=$result_combo_list['cod_combo_qty']?></td>-->
                                                        <td>
                                                       
                                                        <div class="odr_split_qty_btn" onclick="return minus_split_combo('<?=$result_combo_list['cod_count_combo_ordering']?>','<?=$ic?>','<?=$value?>');">-</div>
                                                        <input  type="text" maxlength="3" onkeypress="return numdot_split(event);" onkeyup="check_split_qty_combo('<?=$result_combo_list['cod_count_combo_ordering']?>','<?=$ic?>','<?=$value?>');"  onclick="return split_value_combo('<?=$result_combo_list['cod_count_combo_ordering']?>','<?=$ic?>','<?=$value?>');" onchange="return split_value_combo('<?=$result_combo_list['cod_count_combo_ordering']?>','<?=$ic?>','<?=$value?>');"   class="odr_split_qty_textbox menu_split_qty_combo_clear<?=$ic?><?=$value?><?=$result_combo_list['cod_count_combo_ordering']?>  menu_split_qty_combo<?=$ic?><?=$value?><?=$result_combo_list['cod_count_combo_ordering']?>   split_qty_class_combo<?=$result_combo_list['cod_count_combo_ordering']?><?=$value?>" id="split_qty_combo<?=$result_combo_list['cod_count_combo_ordering']?><?=$ic?><?=$value?>" autofocus >
                                                        <div class="odr_split_qty_btn" onclick="return plus_split_combo('<?=$result_combo_list['cod_count_combo_ordering']?>','<?=$ic?>','<?=$value?>');" >+</div>                
                                                       
                                                       </td>
                                                       
<!--                                                       <td width="15%"><?//=number_format($result_combo_list['cod_combo_pack_rate'],$_SESSION['be_decimal'])?></td>-->
                                                        
                                                       <td width="12%" class="menu_rate_split_combo<?=$ic?><?=$value?><?=$result_combo_list['cod_count_combo_ordering']?> rate_sum<?=$ic?>" id="each_rate_combo<?=$result_combo_list['cod_count_combo_ordering']?><?=$ic?><?=$value?>" >0</td>
                                                     </tr>
                                                <?php
                                                          }
                                                }}    
                                            
                                            
                                            
                                            
                                            
                                        $sql_spl_1= $database->mysqlQuery("select *,tp.pm_portionshortcode,tm.mr_menuname from tbl_tableorder tb left join tbl_menumaster tm on tm.mr_menuid=tb.ter_menuid left join tbl_portionmaster tp on tp.pm_id=tb.ter_portion where tb.ter_orderno='".$value."' and tb.ter_qty>0  and tb.ter_count_combo_ordering IS NULL ");
                      
                                        $num_spl_1 = $database->mysqlNumRows($sql_spl_1);
                                        if ($num_spl_1) {
                               
                                              while ($result_spl_1 = $database->mysqlFetchArray($sql_spl_1)) {
                                                $m_name_split=$result_spl_1['mr_menuname'];
                                                $slno=$result_spl_1['ter_slno'];
                                                if($_SESSION['main_language']!='english'){
                                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_spl_1['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $m_name_split=$result_arabmenu['lm_menu_name'];
                                                }
                                    
                                                ?>
                                                      <tr class="details_row_split<?=$ic?><?=$value?>" >
                                                          <td   class="menuid_row_split"  menukot="<?=$result_spl_1['ter_kotno']?>"  menuslno="<?=$result_spl_1['ter_slno']?>"   menuid_attr="<?=$result_spl_1['ter_menuid']?>"  width="40%"><?=$m_name_split?> <span style="color:red">(<?=$result_spl_1['pm_portionshortcode']?>)</span> </td>         
                                                        <td width="40%">
                                                            <div class="odr_split_qty_btn" onclick="return minus_split('<?=$result_spl_1['ter_slno']?>','<?=$ic?>','<?=$value?>');">-</div>
                                                            <input  type="text" maxlength="3" onkeypress="return numdot_split(event);" onkeyup="check_split_qty('<?=$result_spl_1['ter_slno']?>','<?=$ic?>','<?=$value?>');"  onclick="return split_value('<?=$result_spl_1['ter_slno']?>','<?=$ic?>','<?=$value?>');" onchange="return split_value('<?=$result_spl_1['ter_slno']?>','<?=$ic?>','<?=$value?>');" class="odr_split_qty_textbox menu_split_qty split_qty_class<?=$result_spl_1['ter_slno']?><?=$value?>" id="split_qty<?=$result_spl_1['ter_slno']?><?=$ic?><?=$value?>" autofocus >
                                                        <div class="odr_split_qty_btn" onclick="return plus_split('<?=$result_spl_1['ter_slno']?>','<?=$ic?>','<?=$value?>');" >+</div>
							</td>	
							<td class="menu_rate_split rate_sum<?=$ic?>" id="each_rate<?=$result_spl_1['ter_slno']?><?=$ic?><?=$value?>"  width="20%">0</td> 
							</tr>
                                                        
							<?php 
                                                        
                                                } } }
                                                ?>
  						</table>
					</div>
					<div class="order_split_left_org_bill_table_btm_rate">
                                            <span> TOTAL : &nbsp; <span  id="total_each_bill<?=$ic?>"> 0 </span> </span>
					</div>
					<div class="order_split_left_org_bill_table_btm_button_cc">
                                            <input type="hidden" id="combo_slno_hid" value="<?=implode(',',$combo_entry_combo)?>" >
<!--					<a href="#"><div class="order_split_left_org_bill_table_btn cancel_sec">-->
<!--					<img src="img/uploadify-cancel.png"> Cancel</div></a>-->
                               <a href="#" onclick="return bill_print_one('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');" ><div class="order_split_left_org_bill_table_btn"> BILL  PRINT</div></a>
					</div>
					
                                    
 <div style="display:none;height: 100px;position:fixed" class="index_popup_1 closeoneclass kotconfirmpopup_split<?=$ic?>" >
        <span id="kotfailmsg<?=$ic?>" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
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
        
        
        <div class="btn_index_popup"><a onclick="return confirm_print_on_bill('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');" href="#" class="confirmbillok">Yes</a></div>
                         <?php } } }?>
        
        <div class="btn_index_popup"><a onclick="return close_print_on_bill('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');" href="#" class="confirmbillclose">Cancel</a></div>
    </div>
 </div>
                                    
                                    
				</div>
  			        </div>
              
   
              
  
  
  
              
              
  <div style="display: none; height: 240px; bottom: 0; top:0px; width: 350px; left: -190px; overflow: visible;position:fixed" class="index_popup_1 loyalty_main_popup<?=$ic?>">
    
    <div class="discount_popu_head_cc">
        <?php
        if( $_SESSION['s_printwithdiscount']=='Y'){ ?>  
     <h3 style="" class="sm_pop_head discount_click discount_popo_head_act" dis_clk="<?=$ic?>" >Enter Discount </h3>
     
        <?php }
        if($_SESSION['loyalty_settle_on']=='Y'){ ?>
      <h3 style="" class="sm_pop_head  loyalty_click" loy_clk="<?=$ic?>" >Add/Redeem</h3>
        <?php } ?>     
    </div>
    <div class="discount_loyalty_popup  loyalty_popo_div<?=$ic?>" >
        
        <div class="cs_loyalty_sec">
            <div class="alert_section"><span id="error_msg2<?=$ic?>" class="loy_error"></span></div>
             
            <div class="cs_loyalty_sec_box" style="position:relative">
                <!--<div class="cs_loyalty_lable ">Loyalty ID</div>-->
                <input placeholder="Loyalty ID" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onkeyup="return search_id(event,<?=$ic?>);" onkeypress="return numdot(event,<?=$ic?>);" onfocus="return search_id(event,<?=$ic?>);" onclick="return search_id(event,<?=$ic?>);" id="ly_id<?=$ic?>" autocomplete="off" autofocus="">
                     <div id="id_load<?=$ic?>" class="customer_list_autoload" style="width: 100%; top: 30px; left: 0px;">


</div>
            </div>
            <div class="cs_loyalty_sec_box" style="position:relative">
               
                <input placeholder="Customer Name" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onclick="return search_name(event,<?=$ic?>);" onfocus="return search_name(event,<?=$ic?>);" onkeyup="return search_name(event,<?=$ic?>);" id="ly_name<?=$ic?>" autocomplete="off">
                     <div id="name_load<?=$ic?>" class="customer_list_autoload" style="display:none;width: 100%;top: 30px; left: 0px;">
                            <ul>
                               <li onclick="return name_click();" style="cursor: pointer"> </li>
                             </ul>
                      </div>
            </div>
            <div class="cs_loyalty_sec_box" style="position:relative">
                <input placeholder="Mobile No" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onclick="return search_number(event,<?=$ic?>);" onkeypress="return numdot(event,<?=$ic?>);" onfocus="search_number(event,<?=$ic?>);" onkeyup="search_number(event,<?=$ic?>);" id="ly_number<?=$ic?>" autocomplete="off">
                  <div id="number_load<?=$ic?>" class="customer_list_autoload" style="display:none;width: 100%;top: 30px; left: 0px;">
                        <ul>
                            <li onclick="return number_click();" style="cursor: pointer"></li>
                        </ul>
                  </div>
            </div>
            <div class="cs_loyalty_sec_box">
                <input placeholder="Customer Points" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" id="ly_points<?=$ic?>" autocomplete="off" readonly="">
            </div>
            <div class="cs_loyalty_sec_box">
                <input placeholder="Points to Redeem" class="tax_textbox transa_txt counter_text_box cs_lyt_text_box" onkeypress="return numdot(event,<?=$ic?>);" onclick="return redeem_point(event,<?=$ic?>);" onchange="return redeem_point(event,<?=$ic?>);" id="redeem_point<?=$ic?>" onkeyup="return redeem_point(event,<?=$ic?>);" autocomplete="off">
            </div>
            <div class="cs_loyalty_sec_box" style="margin-right: 0; width: 50%; margin-bottom: 0;position: relative">
            <div id="point_show<?=$ic?>" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">Redeem(<span id="redeem_point_total<?=$ic?>">0</span>pts): <span id="redeem_amount_total<?=$ic?>">0</span></span></div>  
            <div id="point_amount_show<?=$ic?>" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">Before Redeem: <span id="total_before_redeem<?=$ic?>">0</span> </span></div>                          
           <div id="point_show_after<?=$ic?>" style="width: 100%;  text-align: right;  padding: 0; font-size: 13px; line-height: 16px;  height: auto;display: none;position: absolute;bottom:-14px" class="lable_counter_paymnet_cc counter_right_lable"><span style="float:right">After Redeem: <span id="total_after_redeem<?=$ic?>"> 0 </span> </span></div>                          
            </div>
             </div>
        
        <div class="index_popup_contant" style="margin-top: 3px;height: 40px;">
<!--            <div style="width: 25%;" class="btn_index_popup btn_index_popup_cls"><a href="#" class="canceldisount">Cancel</a></div>-->
             <div style="width: 25%;margin-top: -2px" class="btn_index_popup ">
                 <a class="redeem_btn_click" dis_red_count="<?=$ic?>"  href="#">REDEEM</a>
                 <a class="clear_btn_click" dis_clr_count="<?=$ic?>"  style="display:none" href="#" >Clear</a>
             </div>
            
           
            <div style="width: 25%; background-color: #6bb943;margin-top: -2px" class="btn_index_popup " id="new_proceed_loyalty_div<?=$ic?>">
            <a id="new_proceed_loyalty" href="#" onclick="return bill_print_one_with_discount('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');" >PROCEED </a>
            </div>
           
            
            
         </div>
    </div>
    <div class="loyalty_popup_keybord_cc">
        <a  id="" href="#" onclick="close_all('<?=$ic?>');" class=""><div class="auth_dis_popup_close"><img src="img/cancel-icon.png"></div></a>
        <strong style="color:#3e3e3e;font-size: 16px; margin-top: -4px;float: left;width: 100%;text-align: left;height: 37px;padding-left: 8px;">Subtotal :  <strong id="subtotal_dis<?=$ic?>">0</strong> </strong> 
        
        <div class="keys settle_key" style="margin-top:-7px;padding: 0 0 2% 2%;">
               <span class="pay_settle_btn">1</span>
               <span class="pay_settle_btn">2</span>
               <span class="pay_settle_btn">3</span>
               <span class="pay_settle_btn">4</span>
               <span class="pay_settle_btn">5</span>
               <span class="pay_settle_btn">6</span>
               <span class="pay_settle_btn">7</span>
               <span class="pay_settle_btn">8</span>
               <span class="pay_settle_btn">9</span>
               <span class="pay_settle_btn">0</span>
               <span class="pay_settle_btn">.</span>
               <span class="pay_settle_btn">Clear</span>
           </div>
        
    </div>
        
</div>
  
  <div class="auothorize_popup auth_dis_pop<?=$ic?>" style="height: 162px; bottom: 0; top:0px; width: 350px; left: -190px; overflow: visible; display: none;position:fixed">
        <div class="auothorize_popup_bg"></div>
        <div class="auothorize_popup_head">Discount Authorization</div>
        <span style="width: 100%;float: left;height: 20px;margin-top: 5px">
        <span style="text-align: center;width: 100%;float: left;height: 20px;display: block;color:red" id="error_msg1<?=$ic?>"></span>
        </span>
        <div class="discout_auth_contant">
            <div class="discout_auth_contant_textbox_name" style="height:20px"></div>
            <input style="border-radius: 30px;outline: none !important " type="password" onkeypress=" return numdot(event);" onchange="return dis_pincheck1('<?=$ic?>')" onclick="return dis_pincheck1('<?=$ic?>')" onfocus="return dis_pincheck1('<?=$ic?>')" id="dis_pin<?=$ic?>" maxlength="4" placeholder="Enter Your Pin" class="discout_auth_contant_textbox pin_clas_dis" cnt_dis="<?=$ic?>" autocomplete="off" autofocus="">
            <span style="text-align: center;width: 100%;float: left;color: red ;height:20px;margin-top:15px"> <strong id="dis_error"></strong></span>
        </div>
        
        <div class="auothorize_popup_footer_btn_cc">
<!--
            <div style="width: 25%;" class="btn_index_popup btn_index_popup_cls">
                <a id="close_dis" href="#" class="">Close</a>
             </div>
-->
            <div style="width: 25%;background-color: #ca070a;margin-top: -2px;" class="btn_index_popup" id="dis_auth_proceed_without_discount_split_div<?=$ic?>" >
                  <a id="dis_auth_proceed_without_discount_split" href="#" onclick="return bill_print_one_with_discount('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');" class=""> No Discount</a>
             </div>
            
            <div style="width: 25%; background-color: #6bb943;margin-top: -2px;" class="btn_index_popup ">
                 <a class="dis_auth_proceed1" count_ds1="<?=$ic?>" href="#" >Proceed</a>
             </div>
        </div>
    </div>
  
     <div style="display: none; height: 162px; bottom: 0; top: 0px; width: 350px; left: -190px; overflow: visible;position:fixed" class="index_popup_1 disountenterpopup" id="discount_billcount<?=$ic?>">
 	<div style="height:auto" class="index_popup_contant">
           
   		<span class="contenttext"  style="display: inline-block;padding:29px 0 29px 0; padding-left:6%;text-align: left;width: 100%;background-color: #f3f3f3; height: 155px;">
        <p style="display:inline-block;margin-bottom: 5px;color: #000"><?=$_SESSION['splited_view_popup_discount_type']?></p>
        	
            <select  class="form-control" name="disountamount_drop" id="disountamount_drop<?=$ic?>" onchange="dischange1('<?=$ic?>')" style="width:74%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;    margin-left: 6.5%;    box-shadow: 0px 2px 7px #bdbdbd;">
              <option value="none">Select</option>
              <?php
			  $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status!='Non Active'"); 
			  $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
			  if($num_listall_dsc){
					while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
						{
			?>
             <option  mode_ds="<?=$row_listall_dsc['ds_mode']?>"  val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?=$row_listall_dsc['ds_discountname']?></option>
            <?php } } ?>
          </select>&nbsp; 
           <div class="discount_offer_or_cc">
           <?php if($_SESSION['s_discount_manual']=="Y"){ ?>

          <?=$_SESSION['splited_view_popup_discount_manual']?> <input type="text" onfocus="return dis_keypad('<?=$ic?>');"  onclick="return dis_keypad('<?=$ic?>');" onkeyup=" return dis_amount_change('<?=$ic?>');"  class="form-control" name="disountamount" id="disountamount<?=$ic?>" style="width:40%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;box-shadow: 0px 2px 7px #bdbdbd;" value=""> 
          <label style="display:inline;font-weight:normal">
               <span style="top:0px;" class="percen_radio">
                   <input type="checkbox" class="typesel percent_click" name="typesel" id="P"  value="P" checked > %
               </span> 
           </label>
          <label style="display:inline;font-weight:normal">
             <span style="top:17px;" class="percen_radio"> 
             <input type="checkbox" class="typesel value_click"  name="typesel" id="V"  value="V"> <?=$_SESSION['splited_view_popup_discount_value']?>
             </span> 
         </label>
          <?php } ?>   
         </div> 
         
          
            <span style="width: 100%;display: inline-block;height: 20px;"><span id="error_msg_dis<?=$ic?>" style="color:red;    line-height: 17px;"></span></span>
        </span>
         
    </div>
   
    <div class="index_popup_contant" style="margin-top: 4px;border-top: 1px #e4e4e4 solid;height:40px;">
    	<div style="width: 25%;margin-top: -2px;" class="btn_index_popup proceed_inside<?=$ic?>"><a  href="#" onclick="return bill_print_one_with_discount('<?=$_SESSION['split_orderno']?>','<?=$ic?>','<?=$table_name_list?>');"  class="closedisount"><?=$_SESSION['splited_view_popup_discount_printbutton']?></a></div>
        <div style="width: 25%;margin-top: -2px;" class="btn_index_popup"><a href="#" class="canceldisount"  onclick="return close_discount_split('<?=$ic?>');" ><?=$_SESSION['splited_view_popup_discount_cancelbutton']?></a></div>
    </div>
 </div>
<!--  <div style="z-index: 999;left: 0;display:block" class="confrmation_overlay_2"></div>            -->
              
      
   
                    <?php } ?>
                            
<!-----------------------------bill count ends------------------------------  -->




<!----------------------------pax count Starts------------------------------  -->
                    
 <?php
 for($p=0;$p<$_SESSION['paxcount'];$p++){
 ?>
  		                <div class="right_splited_order_box" >
                                    <?php if($p==($_SESSION['paxcount']-1)){ ?>
  				<div class="add_new_bill"><img src="img/pls_btn.png"></div>
                                    <?php }?>
  				<div class="right_splited_order_box_head">
					<div class="right_splited_order_box_head_bill"></div>
					<div class="right_splited_order_box_head_bill_1" >Bill - <?=$p+1?></div>
  				</div>
				<div class="right_splited_order_box_cnt_table_cc">
				<div class="right_splited_order_box_cnt_table_head">
				<table>
                            
					<tr>
					<td width="40%">PRODUCT</td>         
					<td width="40%">QTY</td>	
					<td width="20%">AMOUNT</td>
					</tr>
  					</table>
					</div>
					<div class="order_splited_bill_table_contant">
					<table>
                            <?php
          
                            $sql_spl_1= $database->mysqlQuery("select *,tm.mr_menuname from tbl_tableorder tb left join tbl_menumaster tm on tm.mr_menuid=tb.ter_menuid where tb.ter_orderno='".$value."'");
                      
                            $num_spl_1 = $database->mysqlNumRows($sql_spl_1);
                            if($num_spl_1){
                               
                                while ($result_spl_1 = $database->mysqlFetchArray($sql_spl_1)) {
                                       $m_name_split=$result_spl_1['mr_menuname'];
                                     $slno=$result_spl_1['ter_slno'];
                                       if($_SESSION['main_language']!='english'){
                
                                              $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_spl_1['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $m_name_split=$result_arabmenu['lm_menu_name'];
                                        }
                                    
                                                 ?>
							<tr>
                                                        <td width="40%"><?=$m_name_split?> </td>         
                                                        <td width="40%">
							<input type="text" class="odr_split_qty_textbox" readonly>
							</td>	
							<td width="20%"><?=number_format($result_spl_1['ter_total_rate'],$_SESSION['be_decimal'])?></td> 
							</tr>
							<?php
                                                        
                                                        $addonallslno=array();
                                                        $addonallmenus=array();
                                                        $addonqty=0;
                                                        $addonrate=0;
                                                        $sql_menulist_addon="select * from `tbl_order_addon` as ta LEFT JOIN tbl_menumaster as mr ON ta.ad_addon_menu=mr.mr_menuid left join tbl_tableorder tor on tor.ter_orderno=ta.ad_orderno and tor.ter_slno=ta.ad_order_slno where tor.ter_orderno='" . $value . "'  and tor.ter_slno='".$slno."' and  ta.ad_qty>0>0  ";//LPAD(lower(mmy_orderof_print), 10,0),
                                                        //echo "select * from `tbl_order_addon` as ta LEFT JOIN tbl_menumaster as mr ON ta.ad_addon_menu=mr.mr_menuid left join tbl_tableorder tor on tor.ter_orderno=ta.ad_orderno and tor.ter_slno=ta.ad_order_slno where tor.ter_orderno='" . $value . "'  and tor.ter_slno='".$slno."' and  ta.ad_qty>0 ";
                                                        $sql_menus_addon  =  $database->mysqlQuery($sql_menulist_addon); 
                                                        $num_menus_addon  = $database->mysqlNumRows($sql_menus_addon);
                                                        if($num_menus_addon){ $p=0; 
                                                            while($result_menus_addon  = $database->mysqlFetchArray($sql_menus_addon)){ 
                                                            $p++;
                                                            
                                                              $sl1=$sl1+1;
                                                                if(!in_array($result_menus_addon['ad_order_slno'],$addonallslno)){
                                                                $addonallslno[] = $result_menus_addon['ad_order_slno'];
                                                            }
                                                            if(!in_array($result_menus_addon['ad_addon_menu'],$addonallmenus)){
                                                                $addonallmenus[] = $result_menus_addon['ad_addon_menu'];
                                                            }
                                                            $addonqty=$addonqty+$result_menus_addon['ad_qty'];
                                                            $addonrate=$addonrate+$result_menus_addon['ad_total_rate'];
                                                            
                                                             $total1=$total1+$result_menus_addon['ad_total_rate'];
                                                            
                                                         ?>
                                                        
                                                        <tr>
                                                        <td width="40%"><?=$p?>) <?=$result_menus_addon['mr_menuname']?> <span style="color:red">(ADD-ON)</span> </td>         
                                                        <td width="40%">
							
							<input type="text" class="odr_split_qty_textbox">
							
							</td>	
							<td width="20%"><?=number_format($result_menus_addon['ad_total_rate'],$_SESSION['be_decimal'])?></td> 
							</tr>
                                                      
                                                    <?php
                                                   } }
                                                        
                                                   } } 
                                                   ?>
                                                        
  						</table>
					</div>
					<div class="order_split_left_org_bill_table_btm_rate">
  					<span>TOTAL - 1000</span>
					</div>
					<div class="order_split_left_org_bill_table_btm_button_cc">
					<a href="#"><div class="order_split_left_org_bill_table_btn cancel_sec">
					<img src="img/uploadify-cancel.png"> Cancel</div></a>
					<a href="#"><div class="order_split_left_org_bill_table_btn">Print Bill</div></a>
					</div>
					</div>
  			                </div>
  			
    <?php } ?>

    <!--------------------Pax count ends------------------------------  -->
  			
 </div>
 <div style="display: none " id="leftArrow"><img src="img/arow-left.png"></div>
 </div>
 </div>
 
  <script>
      $(document).ready(function(){
          var ctrlKeyDown = false;
       $(document).on("keydown", keydown);
       
       function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};
          
          $(document).keyup(function(e) {
           if (e.keyCode == 27) { 
           $('.calc_split').hide();
          }
         });
          
          
          
          var count_box=$('#slide_pax_count').val();
          var count_box1=$('#slide_bill_count').val();
          
         if(count_box1>2){
         $("#leftArrow").show();
         $("#rightArrow").show();
         }
          
          if(count_box>2){
          $("#leftArrow").show();
          $("#rightArrow").show();
          }
          
  $('.split_table').click( function(event) {
                event.stopImmediatePropagation();
                var focused=$('#focus_split').val();
                var calval=($(this).text());
       
                var org=$('#'+focused).val();
		if(calval>=0)
		{
                if(org.length < 3){
		if(org==0)
		{
		$('#'+focused).val(calval);
		}else if(org>0)
		{
		$('#'+focused).val(org+calval);
		}else if(org<0)
		{
		$('#'+focused).val(org+calval);
		}
                }
		}else if(calval=="Clear")
		{
		$('#'+focused).val("");
		}
		$('#'+focused).change();
		$('#'+focused).focus();
        
              
      if($('#h_slno').val()!=""){
          
     var sl= $('#h_slno').val();
     var v=  $('#h_orderno').val();
     var i=$('#h_forloop').val();     

     var qty=$('#split_qty'+sl+i+v).val();
     
     if(qty=="" || qty==0){
     $('.menu_split_qty_addon_clear'+i+v+sl).val('');
      $('.menu_split_qty_addon_clear_rate'+i+v+sl).text('0');
      }
     
     var main_qty=parseFloat($('#main_qty'+sl+v).text());
     var q=0;
     $('.split_qty_class'+sl+v).each(function(){
     if($(this).val()){
        q+=parseFloat($(this).val());
     }
     });
     var each_rate=$('#main_qty'+sl+v).attr('menu_rate_each');
     var new_rate=parseFloat(each_rate*qty);
     var decimal= $('#decimal').val();
     $('#each_rate'+sl+i+v).text(new_rate.toFixed(decimal));
     var rt=0;
     $('.rate_sum'+i).each(function(){
     if($(this).text()){
        rt+=parseFloat($(this).text());
     }
     });
    if(q<=main_qty){
     $('#total_each_bill'+i).text(rt.toFixed(decimal));
    }
    if(q>main_qty){
    
       $("#error_msg").css("display","block");
        $("#error_msg").text("Invalid Quantity");
        $("#error_msg").delay(2000).fadeOut('slow');
       $('#split_qty'+sl+i+v).focus();
        $('#split_qty'+sl+i+v).val('');
         $('#each_rate'+sl+i+v).text('0');
         
    }
    }
    
   
    
    
    
     if($('#h_slno_cb').val()!=""){
        
         
     var sl1= $('#h_slno_cb').val();
     var v1=  $('#h_orderno_cb').val();
     var i1=$('#h_forloop_cb').val(); 
    
  
  
    var main_qt_chk=$('#split_qty_combo'+sl1+i1+v1).val();
   
              if(main_qt_chk=="" || main_qt_chk==0){
                  
                  $('#split_qty_combo'+sl1+i1+v1).val('');
                  $("#error_msg").css("display","block");
                   $("#error_msg").text("Main Menu For Addon is empty");
                        $("#error_msg").delay(2000).fadeOut('slow');
              }
  
  
    var qty1=$('#split_qty_combo'+sl1+i1+v1).val();
    var main_qty1=parseFloat($('#main_qty_combo'+v1+sl1).text());
    var q1=0;
    $('.split_qty_class_combo'+sl1+v1).each(function(){
     if($(this).val()){
        q1+=parseFloat($(this).val());
     }
   });
    var each_rate_ad=$('#main_qty_combo'+v1+sl1).attr('menu_rate_each_combo');
   var new_rate=parseFloat(each_rate_ad*qty1);
   
    var decimal= $('#decimal').val();
    $('#each_rate_combo'+sl1+i1+v1).text(new_rate.toFixed(decimal));
   
   var rt=0;
   $('.rate_sum'+i1).each(function(){
     if($(this).text()){
        rt+=parseFloat($(this).text());
     }
   });
  if(q1<=main_qty1){
     $('#total_each_bill'+i1).text(rt.toFixed(decimal));
    }else{
          $('#total_each_bill'+i1).text(0);
    }
 
    if(q1>main_qty1){
    
       $("#error_msg").css("display","block");
        $("#error_msg").text("Invalid Quantity");
        $("#error_msg").delay(2000).fadeOut('slow');
       $('#split_qty_combo'+sl1+i1+v1).focus();
        $('#split_qty_combo'+sl1+i1+v1).val('');
         $('#each_rate_combo'+sl1+i1+v1).text('0');
    }
    
    
     }
    
    
    });
          
 });
      </script>
  
  
  
 <script>
    
    
    
$("#rightArrow").click(function(){
    var move = "363px";
    var view = $("#tslshow");
    var ct=$('#slide_pax_count').val();
    var ct1=$('#slide_bill_count').val();
    if(ct>0){
      var sliderLimit = -360* parseFloat(ct-2);  
    }else{
      sliderLimit = -360* parseFloat(ct1-2);     
    }
   
    var currentPosition = parseInt(view.css("left"));
    if (currentPosition >= sliderLimit) view.stop(false,true).animate({left:"-="+move},{ duration: 500})

});





$("#leftArrow").click(function(){
    var move = "363px";
    var ct=$('#slide_pax_count').val();
    var ct1=$('#slide_bill_count').val();
    if(ct>0){
       var sliderLimit = -360* parseFloat(ct);  
    }else{
       sliderLimit = -360* parseFloat(ct1);     
    }
   
    var view = $("#tslshow");
    var currentPosition = parseInt(view.css("left"));
    if (currentPosition <-180) view.stop(false,true).animate({left:"+="+move},{ duration: 500})

});



 function numdot_split(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }

function plus_split(sl,i,v){
    
                 if($('#split_qty'+sl+i+v).val()!=""){
                   $('#split_qty'+sl+i+v).val(parseInt($("#split_qty"+sl+i+v).val())+1);
                 }else{
                   $('#split_qty'+sl+i+v).val('1');
                 }

                 var qty=$('#split_qty'+sl+i+v).val();
                 var main_qty=parseFloat($('#main_qty'+sl+v).text());
                 var q=0;
                 $('.split_qty_class'+sl+v).each(function(){
                 if($(this).val()){
                    q+=parseFloat($(this).val());
                 }
                 });
                 var each_rate=$('#main_qty'+sl+v).attr('menu_rate_each');
                 var new_rate=parseFloat(each_rate*qty);
                 var decimal= $('#decimal').val();
                 $('#each_rate'+sl+i+v).text(new_rate.toFixed(decimal));
                 var rt=0;
                 $('.rate_sum'+i).each(function(){
                 if($(this).text()){
                    rt+=parseFloat($(this).text());
                 }
                 });
                 if(q<=main_qty){
                   $('#total_each_bill'+i).text(rt.toFixed(decimal));
                  }
                  if(q>main_qty){

                   $("#error_msg").css("display","block");
                   $("#error_msg").text("Invalid Quantity");
                   $("#error_msg").delay(2000).fadeOut('slow');
                   $('#split_qty'+sl+i+v).focus();
                   $('#split_qty'+sl+i+v).val('');
                    $('#each_rate'+sl+i+v).text('0');
                   }
    
 }
   
   
   
   
   
 function minus_split(sl,i,v){

                    if($('#split_qty'+sl+i+v).val()>0){
                       $('#split_qty'+sl+i+v).val(parseInt($("#split_qty"+sl+i+v).val())-1);
                    }else{
                       $('#split_qty'+sl+i+v).val('0');
                    }
                      var qty=$('#split_qty'+sl+i+v).val();

 if(qty=="" || qty==0){
     $('.menu_split_qty_addon_clear'+i+v+sl).val('');
      $('.menu_split_qty_addon_clear_rate'+i+v+sl).text('0');
     
 }


                   var each_rate=$('#main_qty'+sl+v).attr('menu_rate_each');
                   var new_rate=parseFloat(each_rate*qty);
                   var decimal= $('#decimal').val();
                   $('#each_rate'+sl+i+v).text(new_rate.toFixed(decimal));
                   var rt=0;
                   $('.rate_sum'+i).each(function(){
                     if($(this).text()){
                       rt+=parseFloat($(this).text());
                    }
                  });
                 $('#total_each_bill'+i).text(rt.toFixed(decimal));
 }
   
   
   
   
   

      
    
 
   
   
   
   
   function plus_split_combo(sl,i,v){
  
   
                    if($('#split_qty_combo'+sl+i+v).val()!=""){
                       $('#split_qty_combo'+sl+i+v).val(parseInt($("#split_qty_combo"+sl+i+v).val())+1);
                    }else{
                       $('#split_qty_combo'+sl+i+v).val('1');
                    }


 var main_qt_chk=$('#split_qty_combo'+sl+i+v).val();
  
              if(main_qt_chk=="" || main_qt_chk==0){
                  
                  $('#split_qty_combo'+sl+i+v).val('');
                        $("#error_msg").css("display","block");
                        $("#error_msg").text("Main Menu For Combo is empty");
                        $("#error_msg").delay(2000).fadeOut('slow');
              }



                    var qty1=$('#split_qty_combo'+sl+i+v).val();
                    var main_qty1=parseFloat($('#main_qty_combo'+v+sl).text());
                  
                    var q1=0;
                    $('.split_qty_class_combo'+sl+v).each(function(){
                     if($(this).val()){
                        q1+=parseFloat($(this).val());
                     }
                   });

                   var each_rate_ad=$('#main_qty_combo'+v+sl).attr('menu_rate_each_combo');
                   var new_rate=parseFloat(each_rate_ad*qty1);

                   var decimal= $('#decimal').val();
                   $('#each_rate_combo'+sl+i+v).text(new_rate.toFixed(decimal));
                   var rt=0;
                   $('.rate_sum'+i).each(function(){
                     if($(this).text()){
                        rt+=parseFloat($(this).text());
                     }
                     });
                     if(q1<=main_qty1){
                     $('#total_each_bill'+i).text(rt.toFixed(decimal));
                      }

                     if(q1>main_qty1){

                      $("#error_msg").css("display","block");
                      $("#error_msg").text("Invalid Quantity");
                      $("#error_msg").delay(2000).fadeOut('slow');
                      $('#split_qty_combo'+sl+i+v).focus();
                      $('#split_qty_combo'+sl+i+v).val('');
                      $('#each_rate_combo'+sl+i+v).text('0');
                    }

    
    }
      
    
 function minus_split_combo(sl,i,v){
                    if($('#split_qty_combo'+sl+i+v).val()>0){
                       $('#split_qty_combo'+sl+i+v).val(parseInt($("#split_qty_combo"+sl+i+v).val())-1);
                     }else{
                       $('#split_qty_combo'+sl+i+v).val('0');
                     }
                    var qty1=$('#split_qty_combo'+sl+i+v).val();
                    var each_rate_ad=$('#main_qty_combo'+v+sl).attr('menu_rate_each_combo');
                    var new_rate=parseFloat(each_rate_ad*qty1);

                   var decimal= $('#decimal').val();
                   $('#each_rate_combo'+sl+i+v).text(new_rate.toFixed(decimal));

                   var rt=0;
                    $('.rate_sum'+i).each(function(){
                    if($(this).text()){
                       rt+=parseFloat($(this).text());
                    }
                   });
                  $('#total_each_bill'+i).text(rt.toFixed(decimal));
    
        }
   
   
 function calc_display(){
         $('.calc_split').slideToggle("fast");
 }   
 
 
 
 function split_value(s,i,v){
            $('#focus_split').val('split_qty'+s+i+v);

            $('#h_slno').val(s);
            $('#h_orderno').val(v);
            $('#h_forloop').val(i);

 }
 
  
 
 function split_value_combo(s,i,v){
     
            $('#focus_split').val('split_qty_combo'+s+i+v);
            $('#h_slno_cb').val(s);
            $('#h_orderno_cb').val(v);
            $('#h_forloop_cb').val(i);

           
 }
 
 
 function check_split_qty(s,i,v){
                    var qty=$('#split_qty'+s+i+v).val();
                    var main_qty=parseFloat($('#main_qty'+s+v).text());


 if(qty=="" || qty==0){
     $('.menu_split_qty_addon_clear'+i+v+s).val('');
      $('.menu_split_qty_addon_clear_rate'+i+v+s).text('0');
     
 }




                    var q=0;
                    $('.split_qty_class'+s+v).each(function(){
                     if($(this).val()){
                        q+=parseFloat($(this).val());
                     }
                    });

                     var each_rate=$('#main_qty'+s+v).attr('menu_rate_each');
                     var new_rate=parseFloat(each_rate*qty);


                     var decimal= $('#decimal').val();
                     $('#each_rate'+s+i+v).text(new_rate.toFixed(decimal));


                      var rt=0;
                      $('.rate_sum'+i).each(function(){
                      if($(this).text()){
                        rt+=parseFloat($(this).text());
                     }
                      });
                    if(q<=main_qty){
                      $('#total_each_bill'+i).text(rt.toFixed(decimal));
                      }




                     if(q>main_qty){

                       $("#error_msg").css("display","block");
                       $("#error_msg").text("Invalid Quantity");
                       $("#error_msg").delay(2000).fadeOut('slow');
                       $('#split_qty'+s+i+v).focus();
                       $('#split_qty'+s+i+v).val('');
                       $('#each_rate'+s+i+v).text('0');
                       $('#total_each_bill'+i+v).text('0');
                    }
  
 }
 
 
 
 
 
 
 
 
 
 
  function check_split_qty_combo(s,i,v){
     
     
               var main_qt_chk=$('#split_qty_combo'+i+v).val();
             
              if(main_qt_chk=="" || main_qt_chk==0){
                
                  $('#split_qty_combo'+s+i+v).val('');
                        $("#error_msg").css("display","block");
                        $("#error_msg").text("Main Menu For Addon is empty");
                        $("#error_msg").delay(2000).fadeOut('slow');
              }
     
      
                    var qty1=$('#split_qty_combo'+s+i+v).val();
                    var main_qty1=parseFloat($('#main_qty_combo'+v+s).text());
                    var q1=0;
                    $('.split_qty_class_combo'+s+v).each(function(){
                     if($(this).val()){
                        q1+=parseFloat($(this).val());
                     }
                   });

                    var each_rate_ad=$('#main_qty_combo'+v+s).attr('menu_rate_each_combo');
                   var new_rate=parseFloat(each_rate_ad*qty1);

                    var decimal= $('#decimal').val();
                   $('#each_rate_combo'+s+i+v).text(new_rate.toFixed(decimal));

                        var rt=0;
                    $('.rate_sum'+i).each(function(){
                     if($(this).text()){
                        rt+=parseFloat($(this).text());
                     }
                   });
                    if(q1<=main_qty1){
                     $('#total_each_bill'+i).text(rt.toFixed(decimal));
                    }else{
                        $('#total_each_bill'+i).text(0); 
                    }
                   if(q1>main_qty1){

                        $("#error_msg").css("display","block");
                        $("#error_msg").text("Invalid Quantity");
                        $("#error_msg").delay(2000).fadeOut('slow');
                        $('#split_qty_combo'+s+i+v).focus();
                        $('#split_qty_combo'+s+i+v).val('');
                        $('#each_rate_combo'+s+i+v).text('0');

                    }
    
 }
 
function close_all(i){
   
  $('.loyalty_main_popup'+i).hide();
  $('.auth_dis_pop'+i).hide();
             $('#discount_billcount'+i).hide();
               $('.loyalty_popo_div'+i).hide();
                $('.confrmation_overlay').hide();
 }
 
 
 function close_print_on_bill(o,l,p){
     $('.kotconfirmpopup_split'+l).css('display','none');   
              
      $(".confrmation_overlay").css("display","none");   
 }
 
 
 function confirm_print_on_bill(order,loop,table){
     
     $('.kotconfirmpopup_split'+loop).css('display','none');   
              
      $(".confrmation_overlay").css("display","none");   
     
     var floor=$('#floor_split').val();
     var bill_count_all=$('#slide_bill_count').val();
     var discount_enable=$('#discount_enable').val();
        
      var loyalty_on=$('#loyalty_on_off').val();
        
      var subt=$('#total_each_bill'+loop).html();
      $('#subtotal_dis'+loop).html(subt);
          
          $('#subtotal_loy_org').val(subt);
           if(discount_enable=="Y" && loyalty_on=="Y"){
          $(".discount_click").addClass("discount_popo_head_act");
          $(".loyalty_click").removeClass("discount_popo_head_act");
                }   
          
         if(discount_enable=="Y" || loyalty_on=="Y"){
             
            $('.loyalty_main_popup'+loop).show();
            $('.confrmation_overlay').show();
          
         if(discount_enable=="Y") {
          $('.auth_dis_pop'+loop).show();
          $('#discount_billcount'+loop).show();
          $('#dis_pin'+loop).focus();
          $('#dis_pin'+loop).val('');
    
         }else{
             $('.auth_dis_pop'+loop).hide();
             $('#discount_billcount'+loop).hide();
         }
         
     if(loyalty_on=='Y'){
        $('.loyalty_popo_div'+loop).show();
          }else{
        $('.loyalty_popo_div'+loop).hide();
          }
      
         
         }else{
         var order_new=order.split(',');
         var m;
   
         var split_order=new Array();
     
         var split_order_combo=new Array();
         
         for(m=0;m<order_new.length;m++){
       
         $('.details_row_split'+loop+order_new[m]).each(function(){
            var qq=0;
          
            var menuid=$(this).find('.menuid_row_split').attr('menuid_attr');
            var menu_qty=$(this).find('.menu_split_qty').val();
            var menu_rate=$(this).find('.menu_rate_split').text();
            var menu_slno=$(this).find('.menuid_row_split').attr('menuslno');  
            var menu_kot=$(this).find('.menuid_row_split').attr('menukot');  
   
      if(menu_qty>0 && menu_qty!=""){
      split_order.push({
         'menu_id':$.trim(menuid),
         'menu_qty':$.trim(menu_qty),
         'menu_rate':$.trim(menu_rate),
         'menu_order':$.trim(order_new[m]),
         'menu_slno':$.trim(menu_slno),
          'menu_kot':$.trim(menu_kot)
      });
      
      }
      
 
   
    var total_lopp=$('#slide_bill_count').val();
  
      var all_qty_main=parseFloat($('#main_qty'+menu_slno+order_new[m]).text());
        
    var s;
    for(s=0;s<total_lopp;s++){
       
      if( parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val())){
       qq+= parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val());
    
        }
         
    }
       
      
       
     if(qq!=all_qty_main){
          
         $("#error_msg").css("display","block");
        $("#error_msg").text("MENU QTY NOT MATCHING");
        $("#error_msg").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
          exit;
        }else{
         $("#cancel_btn_split").hide();
            $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
  
   });
   
   
    var ar_cb=$('#combo_slno_hid').val();
       var arr_combo_slno=ar_cb.split(',');
       
    for(var cb=0;cb<arr_combo_slno.length;cb++){
     
      $('.details_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).each(function(){
       var qq11=0;
       var menuid_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_id');
      var menuid_combo_pack=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_pack_id');
       var menu_qty_combo=$(this).find('.menu_split_qty_combo'+loop+order_new[m]+arr_combo_slno[cb]).val();
       var menu_rate_combo=$(this).find('.menu_rate_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).text();
         var menu_kot_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menukot_combo');
         
          if(menu_qty_combo>0 && menu_qty_combo!=""){
         split_order_combo.push({
         'menu_id_cb':$.trim(menuid_combo),
         'menu_id_pack_cb':$.trim(menuid_combo_pack),
         'menu_qty_cb':$.trim(menu_qty_combo),
         'menu_rate_cb':$.trim(menu_rate_combo),
         'menu_order_cb':$.trim(order_new[m]),
         'menu_cbslno_cb':$.trim(arr_combo_slno[cb]),
           'menu_kot_combo':$.trim(menu_kot_combo)
      });
      }
        
        
      var all_qty_main_combo=parseFloat($('#main_qty_combo'+order_new[m]+arr_combo_slno[cb]).text());
         
    var total_lopp1=$('#slide_bill_count').val(); 
    var s1;
    for(s1=0;s1<total_lopp1;s1++){
       
      if( parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val())){
       qq11+= parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val());
    
        }
         
    }
       
     
     if(qq11!=all_qty_main_combo){
          
         $("#error_msg").css("display","block");
        $("#error_msg").text("COMBO QTY NOT MATCHING");
        $("#error_msg").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
          exit;
        }else{
         $("#cancel_btn_split").hide();
         $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
    });
    
    
    
    }
   
   
   
   
   
        }
       
       var split_all_json_detail_combo= JSON.stringify(split_order_combo);
   
       var split_all_json_detail= JSON.stringify(split_order);
      
       
       var steward=$('#steward').val();
       var data_split="set_split=split_bill&split_orderno="+order+"&split_tableno="+table+"&steward="+steward;
     
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split,
        success: function(data)
        {
      
    
       var  bill_no=$.trim(data);
       
       var data_split="set_split_json=split_bill_json&split_orderno="+order+"&split_tableno="+table+"&split_all_json_detail="+split_all_json_detail+"&bill_no_split="+bill_no+"&floor="+floor+"&bill_count="+bill_count_all+"&split_all_json_detail_combo="+split_all_json_detail_combo;
      
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split,
        success: function(data)
        {
           
        var msg=$.trim(data);
         
            
        $("#error_msg").css("display","block");
        $("#error_msg").text(msg);
        $("#error_msg").delay(2000).fadeOut('slow');
         var total_loop_ct=$('#slide_bill_count').val();
       
         
         
        if( $('#bill_count_return').val()!=total_loop_ct){
            
            $('#bill_count_return').val(parseFloat($('#bill_count_return').val())+1);
        }
        
        var each_bill_ct= $('#bill_count_return').val();
      
    
        if(each_bill_ct==total_loop_ct){
            window.location.href="table_selection.php";
        }
       
        }
        });
      
        }
    });
    }
     
     
     
 }
 
 
 function bill_print_one(order,loop,table){
     
          var flr_id=$('#floor_split').val();
          var Bill_print = "Bill_print";
      
          $.post("printercheck_1.php", {type:Bill_print,floor:flr_id},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            if(data !='')
            { 
                                            
               $('.kotconfirmpopup_split'+loop).css('display','block');   
              $('#kotfailmsg'+loop).html(data);
               $(".confrmation_overlay").css("display","block");                              
                                          
            }
            else{
   
     var floor=$('#floor_split').val();
     var bill_count_all=$('#slide_bill_count').val();
     var discount_enable=$('#discount_enable').val();
        
      var loyalty_on=$('#loyalty_on_off').val();
        
      var subt=$('#total_each_bill'+loop).html();
      $('#subtotal_dis'+loop).html(subt);
          
          $('#subtotal_loy_org').val(subt);
           if(discount_enable=="Y" && loyalty_on=="Y"){
          $(".discount_click").addClass("discount_popo_head_act");
          $(".loyalty_click").removeClass("discount_popo_head_act");
                }   
          
         if(discount_enable=="Y" || loyalty_on=="Y"){
             
            $('.loyalty_main_popup'+loop).show();
            $('.confrmation_overlay').show();
          
         if(discount_enable=="Y") {
          $('.auth_dis_pop'+loop).show();
          $('#discount_billcount'+loop).show();
          $('#dis_pin'+loop).focus();
          $('#dis_pin'+loop).val('');
    
         }else{
             $('.auth_dis_pop'+loop).hide();
             $('#discount_billcount'+loop).hide();
         }
         
     if(loyalty_on=='Y'){
        $('.loyalty_popo_div'+loop).show();
          }else{
        $('.loyalty_popo_div'+loop).hide();
          }
      
         
         }else{
         var order_new=order.split(',');
         var m;
   
         var split_order=new Array();
         var split_order_addon=new Array();
         var split_order_combo=new Array();
         
         for(m=0;m<order_new.length;m++){
       
         $('.details_row_split'+loop+order_new[m]).each(function(){
            var qq=0;
          
            var menuid=$(this).find('.menuid_row_split').attr('menuid_attr');
            var menu_qty=$(this).find('.menu_split_qty').val();
            var menu_rate=$(this).find('.menu_rate_split').text();
            var menu_slno=$(this).find('.menuid_row_split').attr('menuslno');  
            var menu_kot=$(this).find('.menuid_row_split').attr('menukot');  
   
      if(menu_qty>0 && menu_qty!=""){
      split_order.push({
         'menu_id':$.trim(menuid),
         'menu_qty':$.trim(menu_qty),
         'menu_rate':$.trim(menu_rate),
         'menu_order':$.trim(order_new[m]),
         'menu_slno':$.trim(menu_slno),
          'menu_kot':$.trim(menu_kot)
      });
      
      }
      
    $('.details_row_split_addon'+loop+menuid+order_new[m]+menu_slno).each(function(){
          var qq1=0;
        var menuid_addon=$(this).find('.menuid_row_split_addon'+loop+menuid+order_new[m]+menu_slno).attr('menuid_attr_addon');
       var menu_qty_addon=$(this).find('.menu_split_qty_addon'+loop+menuid+order_new[m]+menu_slno).val();
       var menu_rate_addon=$(this).find('.menu_rate_split_addon'+loop+menuid+order_new[m]+menu_slno).text();
         var menu_kot_addon=$(this).find('.menuid_row_split_addon'+loop+menuid+order_new[m]+menu_slno).attr('menukot_addon');
         
          if(menu_qty_addon>0 && menu_qty_addon!=""){
      split_order_addon.push({
         'menu_id_ad':$.trim(menuid_addon),
         'menu_qty_ad':$.trim(menu_qty_addon),
         'menu_rate_ad':$.trim(menu_rate_addon),
         'menu_order_ad':$.trim(order_new[m]),
           'menu_kot_addon':$.trim(menu_kot_addon)
      });
      }
        
        
         var all_qty_main_addon=parseFloat($('#main_qty_addon'+menuid_addon+order_new[m]+menu_slno).text());
         
       var total_lopp1=$('#slide_bill_count').val(); 
    var s1;
    for(s1=0;s1<total_lopp1;s1++){
       
      if( parseFloat($('.details_row_split_addon'+s1+menuid+order_new[m]+menu_slno).find('#split_qty_addon'+menuid_addon+s1+order_new[m]+menu_slno).val())){
       qq1+= parseFloat($('.details_row_split_addon'+s1+menuid+order_new[m]+menu_slno).find('#split_qty_addon'+menuid_addon+s1+order_new[m]+menu_slno).val());
    
        }
         
    }
       
     
     if(qq1!=all_qty_main_addon){
          
         $("#error_msg").css("display","block");
        $("#error_msg").text("ADDON QTY NOT MATCHING");
        $("#error_msg").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
          exit;
        }else{
         $("#cancel_btn_split").hide();
            $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
    });
    
    
 
    
    
    
   
    var total_lopp=$('#slide_bill_count').val();
  
      var all_qty_main=parseFloat($('#main_qty'+menu_slno+order_new[m]).text());
        
    var s;
    for(s=0;s<total_lopp;s++){
       
      if( parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val())){
       qq+= parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val());
    
        }
         
    }
       
      
       
     if(qq!=all_qty_main){
          
         $("#error_msg").css("display","block");
        $("#error_msg").text("MENU QTY NOT MATCHING");
        $("#error_msg").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
          exit;
        }else{
         $("#cancel_btn_split").hide();
            $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
  
   });
   
   
    var ar_cb=$('#combo_slno_hid').val();
       var arr_combo_slno=ar_cb.split(',');
       
    for(var cb=0;cb<arr_combo_slno.length;cb++){
     
      $('.details_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).each(function(){
       var qq11=0;
       var menuid_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_id');
      var menuid_combo_pack=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_pack_id');
       var menu_qty_combo=$(this).find('.menu_split_qty_combo'+loop+order_new[m]+arr_combo_slno[cb]).val();
       var menu_rate_combo=$(this).find('.menu_rate_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).text();
         var menu_kot_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menukot_combo');
         
          if(menu_qty_combo>0 && menu_qty_combo!=""){
         split_order_combo.push({
         'menu_id_cb':$.trim(menuid_combo),
         'menu_id_pack_cb':$.trim(menuid_combo_pack),
         'menu_qty_cb':$.trim(menu_qty_combo),
         'menu_rate_cb':$.trim(menu_rate_combo),
         'menu_order_cb':$.trim(order_new[m]),
         'menu_cbslno_cb':$.trim(arr_combo_slno[cb]),
           'menu_kot_combo':$.trim(menu_kot_combo)
      });
      }
        
        
      var all_qty_main_combo=parseFloat($('#main_qty_combo'+order_new[m]+arr_combo_slno[cb]).text());
         
    var total_lopp1=$('#slide_bill_count').val(); 
    var s1;
    for(s1=0;s1<total_lopp1;s1++){
       
      if( parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val())){
       qq11+= parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val());
    
        }
         
    }
       
     
     if(qq11!=all_qty_main_combo){
          
         $("#error_msg").css("display","block");
        $("#error_msg").text("COMBO QTY NOT MATCHING");
        $("#error_msg").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
          exit;
        }else{
         $("#cancel_btn_split").hide();
         $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
    });
    
    
    
    }
   
   
   
   
   
        }
       
       var split_all_json_detail_combo= JSON.stringify(split_order_combo);
   
       var split_all_json_detail= JSON.stringify(split_order);
       var split_all_json_detail_addon= JSON.stringify(split_order_addon);
       
       var steward=$('#steward').val();
       var data_split="set_split=split_bill&split_orderno="+order+"&split_tableno="+table+"&steward="+steward;
     
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split,
        success: function(data)
        {
      
    
       var  bill_no=$.trim(data);
       
       var data_split="set_split_json=split_bill_json&split_orderno="+order+"&split_tableno="+table+"&split_all_json_detail="+split_all_json_detail+"&bill_no_split="+bill_no+"&split_all_json_detail_addon="+split_all_json_detail_addon+"&floor="+floor+"&bill_count="+bill_count_all+"&split_all_json_detail_combo="+split_all_json_detail_combo;
      
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split,
        success: function(data)
        {
           
        var msg=$.trim(data);
         
            
        $("#error_msg").css("display","block");
        $("#error_msg").text(msg);
        $("#error_msg").delay(2000).fadeOut('slow');
         var total_loop_ct=$('#slide_bill_count').val();
       
         
         
        if( $('#bill_count_return').val()!=total_loop_ct){
            
            $('#bill_count_return').val(parseFloat($('#bill_count_return').val())+1);
        }
         
        var each_bill_ct= $('#bill_count_return').val();
      
    
        if(each_bill_ct==total_loop_ct){
            window.location.href="table_selection.php";
        }
       
        }
        });
      
        }
    });
    }
    }
    });
 }
 
 
 
function close_discount_split(loop){
  $('.auth_dis_pop'+loop).css('display','block');
   //$('.confrmation_overlay').hide();
   //  $('#discount_billcount'+loop).hide();
  $('#disountamount_drop').val('none');
    $('#disountamount').val('');
     $('#dis_pin'+loop).val('');
      $('#dis_pin'+loop).focus();
    
 }
 
 
 
 function bill_print_one_with_discount(order,loop,table){
     
    $('#dis_auth_proceed_without_discount_split_div'+loop).hide();
    $('.proceed_inside'+loop).hide();
    $('#new_proceed_loyalty_div'+loop).hide();
         
   var floor=$('#floor_split').val();
   var order_new=order.split(',');
   var m;
   var bill_count_all=$('#slide_bill_count').val();
   var split_order=new Array();
   var split_order_addon=new Array();
   var split_order_combo=new Array();
    
   for(m=0;m<order_new.length;m++){
       
   $('.details_row_split'+loop+order_new[m]).each(function(){
   var qq=0;
   var menuid=$(this).find('.menuid_row_split').attr('menuid_attr');
   var menu_qty=$(this).find('.menu_split_qty').val();
   var menu_rate=$(this).find('.menu_rate_split').text();
   var menu_slno=$(this).find('.menuid_row_split').attr('menuslno');  
    var menu_kot=$(this).find('.menuid_row_split').attr('menukot');  
   
      if(menu_qty>0 && menu_qty!=""){
       split_order.push({
         'menu_id':$.trim(menuid),
         'menu_qty':$.trim(menu_qty),
         'menu_rate':$.trim(menu_rate),
         'menu_order':$.trim(order_new[m]),
         'menu_slno':$.trim(menu_slno),
          'menu_kot':$.trim(menu_kot)
      });
      
      }
      
    $('.details_row_split_addon'+loop+menuid+order_new[m]+menu_slno).each(function(){
        var qq1=0;
        var menuid_addon=$(this).find('.menuid_row_split_addon'+loop+menuid+order_new[m]+menu_slno).attr('menuid_attr_addon');
        var menu_qty_addon=$(this).find('.menu_split_qty_addon'+loop+menuid+order_new[m]+menu_slno).val();
        var menu_rate_addon=$(this).find('.menu_rate_split_addon'+loop+menuid+order_new[m]+menu_slno).text();
        var menu_kot_addon=$(this).find('.menuid_row_split_addon'+loop+menuid+order_new[m]+menu_slno).attr('menukot_addon');
         
         if(menu_qty_addon>0 && menu_qty_addon!=""){
         split_order_addon.push({
         'menu_id_ad':$.trim(menuid_addon),
         'menu_qty_ad':$.trim(menu_qty_addon),
         'menu_rate_ad':$.trim(menu_rate_addon),
         'menu_order_ad':$.trim(order_new[m]),
           'menu_kot_addon':$.trim(menu_kot_addon)
      });
      }
        
        
    var all_qty_main_addon=parseFloat($('#main_qty_addon'+menuid_addon+order_new[m]+menu_slno).text());
         
    var total_lopp1=$('#slide_bill_count').val(); 
    var s1;
    for(s1=0;s1<total_lopp1;s1++){
       
      if( parseFloat($('.details_row_split_addon'+s1+menuid+order_new[m]+menu_slno).find('#split_qty_addon'+menuid_addon+s1+order_new[m]+menu_slno).val())){
       qq1+= parseFloat($('.details_row_split_addon'+s1+menuid+order_new[m]+menu_slno).find('#split_qty_addon'+menuid_addon+s1+order_new[m]+menu_slno).val());
    
      }
         
    }
       
     
     if(qq1!=all_qty_main_addon){
          
        $("#error_msg_dis"+loop).css("display","block");
        $("#error_msg_dis"+loop).text("ADDON QTY NOT MATCHING");
        $("#error_msg_dis"+loop).delay(2000).fadeOut('slow');
        $('#disable_split'+loop).removeClass('disable_split_box');
      
        $("#error_msg1"+loop).css("display","block");
        $("#error_msg1"+loop).text("ADDON QTY NOT MATCHING");
        $("#error_msg1"+loop).delay(2000).fadeOut('slow');
        
        $("#error_msg2"+loop).css("display","block");
        $("#error_msg2"+loop).text("ADDON QTY NOT MATCHING");
        $("#error_msg2"+loop).delay(2000).fadeOut('slow');
        
       $('#dis_auth_proceed_without_discount_split_div'+loop).show();
       $('.proceed_inside'+loop).show();
       $('#new_proceed_loyalty_div'+loop).show();
       exit;
       
     }else{
            
            $("#cancel_btn_split").hide();
            $('#disable_split'+loop).addClass('disable_split_box');
          
     }
       
    });
    
    
      var total_lopp=$('#slide_bill_count').val();
  
      var all_qty_main=parseFloat($('#main_qty'+menu_slno+order_new[m]).text());
        
    var s;
    for(s=0;s<total_lopp;s++){
      //  alert(menuid+'-'+menu_slno+'-'+s);
      if( parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val())){
       qq+= parseFloat($('.details_row_split'+s+order_new[m]).find('#split_qty'+menu_slno+s+order_new[m]).val());
     }
        
    }
  
     if(qq!=all_qty_main){
          
         $("#error_msg_dis"+loop).css("display","block");
         $("#error_msg_dis"+loop).text("MENU QTY NOT MATCHING");
         $("#error_msg_dis"+loop).delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
         
        $("#error_msg1"+loop).css("display","block");
        $("#error_msg1"+loop).text("MENU QTY NOT MATCHING");
        $("#error_msg1"+loop).delay(2000).fadeOut('slow');
        
        $("#error_msg2"+loop).css("display","block");
        $("#error_msg2"+loop).text("MENU QTY NOT MATCHING");
        $("#error_msg2"+loop).delay(2000).fadeOut('slow');
        
    $('#dis_auth_proceed_without_discount_split_div'+loop).show();
    $('.proceed_inside'+loop).show();
    $('#new_proceed_loyalty_div'+loop).show();
    exit;
    
    }else{
           
        $("#cancel_btn_split").hide();
        $('#disable_split'+loop).addClass('disable_split_box');
    }
        
  
   });
   
   
   
       var ar_cb=$('#combo_slno_hid').val();
       var arr_combo_slno=ar_cb.split(',');
      
     for(var cb=0;cb<arr_combo_slno.length;cb++){
     
      $('.details_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).each(function(){
      var qq11=0;
      var menuid_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_id');
      var menuid_combo_pack=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menuid_attr_combo_pack_id');
       var menu_qty_combo=$(this).find('.menu_split_qty_combo'+loop+order_new[m]+arr_combo_slno[cb]).val();
       var menu_rate_combo=$(this).find('.menu_rate_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).text();
       var menu_kot_combo=$(this).find('.menuid_row_split_combo'+loop+order_new[m]+arr_combo_slno[cb]).attr('menukot_combo');
         
          if(menu_qty_combo>0 && menu_qty_combo!=""){
         split_order_combo.push({
         'menu_id_cb':$.trim(menuid_combo),
         'menu_id_pack_cb':$.trim(menuid_combo_pack),
         'menu_qty_cb':$.trim(menu_qty_combo),
         'menu_rate_cb':$.trim(menu_rate_combo),
         'menu_order_cb':$.trim(order_new[m]),
         'menu_cbslno_cb':$.trim(arr_combo_slno[cb]),
           'menu_kot_combo':$.trim(menu_kot_combo)
      });
      }
        
        
      var all_qty_main_combo=parseFloat($('#main_qty_combo'+order_new[m]+arr_combo_slno[cb]).text());
         
    var total_lopp1=$('#slide_bill_count').val(); 
    var s1;
    for(s1=0;s1<total_lopp1;s1++){
       
      if( parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val())){
       qq11+= parseFloat($('.details_row_split_combo'+s1+order_new[m]+arr_combo_slno[cb]).find('#split_qty_combo'+arr_combo_slno[cb]+s1+order_new[m]).val());
    
        }
         
    }
       
     
     if(qq11!=all_qty_main_combo){
          
         $("#error_msg_dis").css("display","block");
        $("#error_msg_dis").text("COMBO QTY NOT MATCHING");
        $("#error_msg_dis").delay(2000).fadeOut('slow');
         $('#disable_split'+loop).removeClass('disable_split_box');
      
      $("#error_msg1"+loop).css("display","block");
        $("#error_msg1"+loop).text("COMBO QTY NOT MATCHING");
        $("#error_msg1"+loop).delay(2000).fadeOut('slow');
        
        $("#error_msg2"+loop).css("display","block");
        $("#error_msg2"+loop).text("COMBO QTY NOT MATCHING");
        $("#error_msg2"+loop).delay(2000).fadeOut('slow');
        
        $('#dis_auth_proceed_without_discount_split_div'+loop).show();
    $('.proceed_inside'+loop).show();
    $('#new_proceed_loyalty_div'+loop).show();
          exit;
        }else{
         $("#cancel_btn_split").hide();
         $('#disable_split'+loop).addClass('disable_split_box');
          
        }
        
    });
    
    
    
    }
   
   
   
   
   
   
   
        }
        
         var split_all_json_detail_combo= JSON.stringify(split_order_combo);
        
       var split_all_json_detail= JSON.stringify(split_order);
       var split_all_json_detail_addon= JSON.stringify(split_order_addon);
 
    
     var dis_drop=$('#disountamount_drop'+loop).val();
     var dis_text=$('#disountamount'+loop).val();
    
     if(dis_text>0){
      var type="text";
       var  disctype=$("input[name='typesel']:checked").val();
     }else{
      type="drop";
      disctype='';
     }
     
     
     
     
     
     
     if($('#redeem_amount_total').text()!=""){
               var redeem_amount=$('#redeem_amount_total').text();
            }
            else{
                redeem_amount=0;
            }
            
            
            if($('#ly_number'+loop).val()!=""){
                                               
                                           var loyalty_id=$('#ly_id'+loop).val();
                                           var loyalty_billamount6=$('#total_before_redeem'+loop).text();
                                           var loyalty_billamount=loyalty_billamount6.replace(',','');
                                           var loyalty_billamount11=$('#subtotal_dis'+loop).text();
                                           var loyalty_billamount1=loyalty_billamount11.replace(',','');
                                           var lp_add=$('#point_rule_add').val();
                                           var lp_amt=$('#point_rule_add').attr('amt_add');
                                           var tot_point=parseFloat((loyalty_billamount1/lp_amt)*lp_add);
                                           var loyalty_pointredeem=parseFloat($('#redeem_point_total'+loop).text());
                                           var loyalty_redeemamount=$('#redeem_amount_total'+loop).text();
                                           var loy_number=$('#ly_number'+loop).val();
                                           var loy_name=$('#ly_name'+loop).val();
                              
                               }else{
                                  tot_point=0;
                                  loyalty_pointredeem=0;
                                  loyalty_redeemamount=0;
                                  loyalty_billamount=0;
                               }
     
     
     
     
       var steward=$('#steward').val();
       
        var data_split="set_split=split_bill&split_orderno="+order+"&split_tableno="+table+"&steward="+steward;
     
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split,
        success: function(data)
        {
      
       var bill_no=$.trim(data);
     
       
   if(dis_drop!='none' || dis_text>0){
       var data_split1="set_split_json=split_bill_json&split_orderno="+order+"&split_tableno="+table+"&split_all_json_detail="+split_all_json_detail+"&bill_no_split="+bill_no+"&split_all_json_detail_addon="+split_all_json_detail_addon+"&type="+type+"&dis_drop="+dis_drop+"&dis_text="+dis_text+"&disctype="+disctype+"&floor="+floor+"&bill_count="+bill_count_all+"&split_all_json_detail_combo="+split_all_json_detail_combo+"&redeem_amount="+redeem_amount+"&id_loy="+loyalty_id+"&point_add="+tot_point+"&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+"&redeemamount="+loyalty_redeemamount+"&new_bill_amt="+loyalty_billamount1+"&loy_number="+loy_number+"&loy_name="+loy_name;
   }
   else{
       
       var data_split1="set_split_json=split_bill_json&split_orderno="+order+"&split_tableno="+table+"&split_all_json_detail="+split_all_json_detail+"&bill_no_split="+bill_no+"&split_all_json_detail_addon="+split_all_json_detail_addon+"&floor="+floor+"&bill_count="+bill_count_all+"&split_all_json_detail_combo="+split_all_json_detail_combo+"&redeem_amount="+redeem_amount+"&id_loy="+loyalty_id+"&point_add="+tot_point+"&point_redeem="+loyalty_pointredeem+"&billamount="+loyalty_billamount+"&redeemamount="+loyalty_redeemamount+"&new_bill_amt="+loyalty_billamount1+"&loy_number="+loy_number+"&loy_name="+loy_name;
   }
    
        $.ajax({
        type: "POST",
        url: "load_order_split.php",
        data: data_split1,
        success: function(data)
        {
           
           
         var msg=$.trim(data);
         $('#disountamount').val('');
            
         $('.confrmation_overlay').hide();
         $('#discount_billcount'+loop).hide();
            
         $('.loyalty_main_popup'+loop).hide();
         $('.auth_dis_pop'+loop).hide();
       
         $('.loyalty_popo_div'+loop).hide();
            
        $("#error_msg").css("display","block");
        $("#error_msg").text(msg);
        $("#error_msg").delay(2000).fadeOut('slow');
        
         var total_loop_ct=$('#slide_bill_count').val();
         
        if( $('#bill_count_return').val()!=total_loop_ct){
            
            $('#bill_count_return').val(parseFloat($('#bill_count_return').val())+1);
        }
        
        var each_bill_ct= $('#bill_count_return').val();
       
        if(each_bill_ct==total_loop_ct){
            window.location.href="table_selection.php";
        }
       
        }
        });
      
        }
    });
     
      
 }
 
 function dischange1(t){
     
        var ds=$('#disountamount_drop'+t).val();
     
        var mode =  $('#disountamount_drop'+t).find('option:selected').attr('mode_ds');
             
        var mode_value=parseFloat($('#disountamount_drop'+t).find('option:selected').attr('val_ds'));
             
     if(ds!='none'){
          $("#disountamount"+t).prop("readonly", true); 
          
      }else
      {
        $("#disountamount"+t).prop("readonly", false);   
      }
      
     var subtotal_dis=parseFloat($('#subtotal_dis'+t).text());
     
      if((mode_value>100 && mode=='P') || (mode_value>subtotal_dis && mode=='V') ){
           $("#disountamount"+t).val('');
           $("#error_msg_dis"+t).css("display","block");
           $("#error_msg_dis"+t).css("color", "red");
           $("#error_msg_dis"+t).text("Invalid Discount");
           $("#error_msg_dis"+t).delay(1000).fadeOut('slow');
           
         }else{
           
           $("#error_msg_dis"+t).css("display","block");
           $("#error_msg_dis"+t).css("color", "black");
           $("#error_msg_dis"+t).text('['+mode+" : "+mode_value+']');
            
        }
      
      
 }
          
   
   function dis_keypad(d){
     $('#focusedtext').val('disountamount'+d)  
    }
    
 function dis_amount_change(i) {
     
        var ds1= $("#disountamount"+i).val();
        var  disctype=$("input[name='typesel']:checked").val();
        var bill_total= parseFloat($('#total_each_bill'+i).text());
             
        if((ds1>=100 && disctype=="P") || (ds1>bill_total && disctype=="V") ){
           $("#disountamount"+i).val('');
           $("#error_msg_dis"+i).css("display","block");
           $("#error_msg_dis"+i).text("Invalid Discount");
           $("#error_msg_dis"+i).delay(2000).fadeOut('slow');
         }
         if(ds1!=''){
         $('#disountamount_drop'+i).attr("disabled","disabled"); 
         }else{
         $('#disountamount_drop'+i).removeAttr('disabled');
         }
 }
 
 
 function dis_pincheck1(i){
     $('#focusedtext').val('dis_pin'+i);
  }
 
 $('.percent_click').click(function(){
    $('.percent_click').prop('checked',true);
      $('.value_click').prop('checked',false);
 });
 
  $('.value_click').click(function(){
      $('.value_click').prop('checked',true);
        $('.percent_click').prop('checked',false);
 });
 
 
  $('.dis_auth_proceed1').click(function (event) {
       
         event.stopImmediatePropagation();
         
         var ct;
         
         if($('#enter_key_attr').val()!=""){
               ct=$('#enter_key_attr').val();
         }else{
               ct=$(this).attr('count_ds1');
         }
         
         
         $("#disountamount"+ct).val('');
         
              var pin =  $('#dis_pin'+ct).val();
              if(pin !=''){
                  
                $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                    
                 data=$.trim(data);
                 var staff_sl=data.split('*');
                 var staff=staff_sl[0];
                
                    if(data!="NO")
                    { 
                     
                        if(staff_sl[8]=='dis_auth:Y'){
                          // alert(ct);
                        $('.auth_dis_pop'+ct).css('display','none');
                       
                         if(staff_sl[9]=='dis_manual:Y'){
                         $('.manual_permission_ta').css('display','block');
                          }
                        $('#new_proceed_loyalty_div').hide();
                        $('#dis_pin'+ct).val('');
                        $('#ly_id'+ct).focus();
                        
                        }else{
                        $("#dis_error").css("display","block");
			$("#dis_error").text("NO PERMISSION TO APPLY DISCOUNT");
			$("#dis_error").delay(2000).fadeOut('slow');
                        $("#dis_pin"+ct).val('');
                        $("#dis_pin"+ct).off('blur');
                        $("#dis_pin"+ct).focus();
                       }		
                    }
                    else{
                       
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER A VALID PIN");
			$("#dis_error").delay(2500).fadeOut('slow');
                        $("#dis_pin"+ct).val('');
                        $("#dis_pin"+ct).off('blur');
                        $("#dis_pin"+ct).focus();
                    }
                });
            }
            else{      
                
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER YOUR PERSONAL PIN");
			$("#dis_error").delay(2000).fadeOut('slow');
                        documet.getElementById('dis_pin'+ct).focus();
                       
                         
            }
        
   });
 
 $(".pin_clas_dis").keyup(function(event) {
    
         var ct1=$(this).attr('cnt_dis');
      
            if (event.keyCode == 13) {
                  
                if($("#dis_pin"+ct1).is(':focus')){
                  
               $("#dis_pin"+ct1).blur();
                  
                 
                  $('#enter_key_attr').val($(this).attr('cnt_dis'));
               $('.dis_auth_proceed1').trigger('click');
          
                }
              
              } 
        });
 
 
 $(".discount_click").click(function(){
            
             var ct1=$(this).attr('dis_clk');     
                        var staffwithdiscountcs=$('#staffwithdiscountcs').val();
	                var disc=$('#counter_discount_popup').val();
			$(".loyalty_main_popup"+ct1).css("display","block");
                        if(disc=="Y" && staffwithdiscountcs=="Y")
	                {
			$(".discount_div").css("display","block");
                        }
                        $(".loyalty_popo_div"+ct1).css("display","none");
			$(".discount_click").addClass("discount_popo_head_act");
			$(".loyalty_click").removeClass("discount_popo_head_act");
                        $('#disountamount').focus();
                        $('#dis_pin'+ct1).focus();
                          $('.auth_dis_pop'+ct1).show();
                          $('#discount_billcount'+ct1).show();
                          $('#new_proceed_loyalty_div'+ct1).show();
	});
                
        $(".loyalty_click").click(function(){
                        
                   var ct=$(this).attr('loy_clk');     
                      
                        var loyalty_status=$('#loyalty_status').val();
                        $(".loyalty_main_popup"+ct).css("display","block");
			$(".discount_div").css("display","none");
                          $('#discount_billcount'+ct).hide();
                          if( $('#redeem_amount_total'+ct).text()>0){
                           $('.clear_btn_click').show();
                            $('.redeem_btn_click').hide();
                        }else{
                            $('.clear_btn_click').hide();
                            $('.redeem_btn_click').show();
                        }
                        if(loyalty_status=="Y"){
                         $(".loyalty_click").addClass("discount_popo_head_act");
                         }
                         
                         
                         $(".discount_click").removeClass("discount_popo_head_act");
                         $(".loyalty_popo_div"+ct).css("display","block");
                         $('.auth_dis_pop'+ct).hide();
                         if( $('#ly_id').val()==""){
                          $('#ly_id').focus();
                          
                         }
        });
 
 
   $('.pay_settle_btn').click( function(event) {
      
	event.stopImmediatePropagation();
        
	var focused=$('#focusedtext').val();
               
	var calval=($(this).text());
		
	var org=$('#'+focused).val();
                
			if(calval>=0)
			{   
                            if(org.length<12){
				if(org==0)
			        {
				  $('#'+focused).val(org+calval);
				}else if(parseFloat(org)>0)
				{ 
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                                else if(org=='.')
				{
					$('#'+focused).val("0"+org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval=="." )
			{
				$('#'+focused).val(org+".");
			}
                        
			$('#'+focused).change();
		         $('#'+focused).focus();
		
		
		
	}); 
 
 
 
 
 
     
    function search_name(e,i){
    
      $('#focusedtext').val('ly_name'+i);
     var name=$('#ly_name'+i).val();
       if (e.keyCode ==40) { 
      
         $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Click On Name To Select");
	$('.loy_error').delay(2000).fadeOut('slow');

    }
     var data="set=searchname&name="+name+"&count="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        { 
             $('#name_load'+i).show();
         
           $('#name_load'+i).html(data);
           
        }
    });      
       
       if(name==''){
            var decimal=$('#decimal').val();
          
         
        $('#redeem_point_total'+i).text(0)
        $('#redeem_amount_total'+i).text(0);
        $('#total_before_redeem'+i).text(0);
        
        $('#ly_id'+i).val('');
        $('#ly_number'+i).val(''); 
        $('#ly_points'+i).val('');   
         $('#redeem_point'+i).val('');
    }
}
function  name_click(n,i,num,ct){

     var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points'+ct).val(point);   
        }
    });      
         
       $('#ly_id'+ct).val(i);
       $('#ly_name'+ct).val(n);
   
    $('#ly_number'+ct).val(num);
     $('#redeem_point'+ct).val(0)
     $('#id_load'+ct).hide();
    $('#name_load'+ct).hide();
     $('#number_load'+ct).hide();
     
    $("#ly_name"+ct).attr("name_id", i);
   
}



function search_number(e,i){
     $('#focusedtext').val('ly_number'+i);
     var number=$('#ly_number'+i).val();
   
   
     if (e.keyCode ==40){ 
              
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Click On Number To Select");
	$('.loy_error').delay(2000).fadeOut('slow');

    }
   
   
     var data="set=searchnumber&number="+number+"&count="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           $('#number_load'+i).show();
         
           $('#number_load'+i).html(data);
           
        }
    });      
       
       if(number==''){
           var decimal=$('#decimal').val();
          
          $('#redeem_point_total'+i).text(0)
           $('#redeem_amount_total'+i).text(0);
        $('#total_before_redeem'+i).text(0);
        
        $('#ly_name'+i).val(''); 
        $('#ly_points'+i).val('');  
        $('#ly_id'+i).val('');
         $('#redeem_point'+i).val('');
    }
}

function  number_click(n,i,num,ct){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points'+ct).val(point);   
        }
    });      
         
         
   $('#ly_name'+ct).val(n);
   
   $('#ly_number'+ct).val(num);
      $('#redeem_point'+ct).val(0)
    $('#number_load'+ct).hide();
     $('#id_load'+ct).hide();
      $('#name_load'+ct).hide();
      
    $("#ly_name"+ct).attr("name_id", i);
    $('#ly_id'+ct).val(i);
}


function search_id(e,i){
  
    $('#focusedtext').val('ly_id'+i);
    
    if (e.keyCode ==40) { 
      
         $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Click On ID To Select");
	$('.loy_error').delay(2000).fadeOut('slow');

    }
    
     var id=$('#ly_id'+i).val();
   
     var data="set=search_loyal_id&id_loyalty="+id+"&count="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           $('#id_load'+i).show();
         
           $('#id_load'+i).html(data);
           
           
        }
    });      
       
       if(id==''){
           var decimal=$('#decimal').val();
         
          $('#redeem_point_total'+i).text(0)
           $('#redeem_amount_total'+i).text(0);
        $('#total_before_redeem'+i).text(0);
        
        $('#ly_name'+i).val(''); 
        $('#ly_points'+i).val('');  
          $('#ly_number'+i).val('');  
          $('#redeem_point'+i).val('');
    }
    
    
    
}

function  id_click(n,i,num,ct){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points'+ct).val(point);   
        }
    });      
         
         
   $('#ly_name'+ct).val(n);
   $('#redeem_point'+ct).val(0);
   $('#ly_number'+ct).val(num);
    
    $('#ly_id'+ct).val(i);
     $('#id_load'+ct).hide();
     $('#number_load'+ct).hide();
       $('#name_load'+ct).hide();
    $("#ly_name"+ct).attr("name_id", i);
    
}


function redeem_point(e,i){
  
    $('#focusedtext').val('redeem_point'+i);
    var redeem_point=parseFloat($('#redeem_point'+i).val());
     var redeem_point1=$('#redeem_point'+i).val();
    var tot_point=parseFloat($('#ly_points'+i).val());
    var loyalty_id=$('#ly_id'+i).val();
    var number=$('#ly_number'+i).val();
    var min_redeem=parseFloat($('#min_redeem').val());
    
   if(redeem_point1.length==0) {
     $('#redeem_point_total'+i).text(0)
      $('#redeem_amount_total'+i).text(0);
           
           var decimal=$('#decimal').val();
         
        $('#total_before_redeem'+i).text(0);
   }
    
    if(redeem_point>tot_point){
        $('#redeem_point'+i).val('0');
          $('#redeem_point_total'+i).text(0)
           $('#redeem_amount_total'+i).text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem'+i).text(0);
           
       $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("You have only "+tot_point+" Points");
	$(".loy_error").delay(3000).fadeOut('slow');
    }else if(loyalty_id==""  || number==""){
           $('#redeem_point'+i).val('');
           $('#redeem_point_total'+i).text(0)
           $('#redeem_amount_total'+i).text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem'+i).text(0);
        
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Enter Loyalty Details ");
	$(".loy_error").delay(3000).fadeOut('slow');
    }
    
    }


$('.redeem_btn_click').click(function(){
     var ct5=$(this).attr('dis_red_count');
     var subt=$('#total_each_bill'+ct5).html();
  
    if(subt>0){
   
     var decimal=$('#decimal').val();
     var min_redeem=parseFloat($('#min_redeem').val());
     var redeem_point=parseFloat($('#redeem_point'+ct5).val());
     var loyalty_id=$('#ly_id'+ct5).val();
     var number=$('#ly_number'+ct5).val();
    
    var pt=parseFloat($('#point_rule').val());
    var amt=parseFloat($('#point_rule').attr('amt'));
    
    var gt1=$('#total_each_bill'+ct5).html();
    var gt=gt1.replace(',','');
    var pt_values=parseFloat(redeem_point/pt);
    var tot_point_amount=parseFloat(pt_values*amt).toFixed(decimal);
 
      var rdp=$('#redeem_point_total'+ct5).text();
      var rda=  $('#redeem_amount_total'+ct5).text();

      if(loyalty_id==""  || number==""){
          $('#redeem_point'+ct5).val('');
          $('#redeem_point_total'+ct5).text(0)
          $('#redeem_amount_total'+ct5).text(0);
           
         var decimal=$('#decimal').val();
        
         
        $('#total_before_redeem'+ct5).text(0);
              
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Enter Loyalty Details ");
	$(".loy_error").delay(3000).fadeOut('slow');
        $('#ly_id'+ct5).focus();
        
       exit; 
    }else if(redeem_point<=min_redeem || redeem_point==""){
         $('#redeem_point'+ct5).val(0);
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
          
           var decimal=$('#decimal').val();
         
         
        $('#total_before_redeem'+ct5).text(0);
           
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Minimum Redeem Point should be greater than "+min_redeem);
	$(".loy_error").delay(3000).fadeOut('slow');
          $('#redeem_point'+ct5).focus();
        exit;
    }else if(parseFloat(tot_point_amount)>=parseFloat(gt)){
          $('#redeem_point'+ct5).val(0);
          $('#redeem_point_total'+ct5).text(0)
          $('#redeem_amount_total'+ct5).text(0);
          var decimal=$('#decimal'+ct5).val();
         
         
        $('.total_before_redeem'+ct5).text(0);
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Redeem Amount should not be greater than Total");
	$('.loy_error').delay(3000).fadeOut('slow');
          $('#redeem_point'+ct5).focus();
        exit;
        }else{
        
        $(".payment_pend_right_cash_error").text("");
    }
  
  $('#point_show'+ct5).css('display','block');
   $('#point_amount_show'+ct5).css('display','block');
  
  
  $('#redeem_point_total'+ct5).text(redeem_point);
  
   
   $('#redeem_amount_total'+ct5).text(tot_point_amount);
  
   $('#total_before_redeem'+ct5).text(gt);
   
   
      
   var gtt=parseFloat(gt-tot_point_amount);
   
     $('#subtotal_dis'+ct5).text(gtt.toFixed(decimal));
     
     $('#redeem_point'+ct5).attr('readonly', true);
      $('.redeem_btn_click').hide();
      
         $('.redeeming_value_total'+ct5).text('Redeemed Already');
         $('.clear_btn_click').show();
         $('#ly_number'+ct5).attr('readonly', true);
         $('#ly_name'+ct5).attr('readonly', true);
         $('#ly_id'+ct5).attr('readonly', true);
         $('#id_load'+ct5).hide();
         $('#number_load'+ct5).hide();
          $('#name_load'+ct5).hide();
          
       $(".settle-btn1").click();   
   }else{
      
        $(".loy_error").css("display","block");
	$(".loy_error").addClass("popup_validate");
	$(".loy_error").text("Split the order first");
	$('.loy_error').delay(3000).fadeOut('slow');
   }
    });
    
    
 $('.clear_btn_click').click(function(){
      
     var ct=$(this).attr('dis_clr_count');
     var subt=$('#total_each_bill'+ct).html();
      
      $('#redeem_point'+ct).attr('readonly', false);
      $('#ly_number'+ct).attr('readonly', false);
      $('#ly_name'+ct).attr('readonly', false);
      $('#ly_id'+ct).attr('readonly', false);
      $('.redeem_btn_click').show();
      
      $('.redeeming_value_total'+ct).text('');
      $('.clear_btn_click').hide();
      $('#redeem_point_total'+ct).text('0');
  
      $('#redeem_amount_total'+ct).text('0');
  
      $('#total_before_redeem'+ct).text('0');
      
      $('#redeem_point'+ct).val(0);
      $('#ly_number'+ct).val('');
    
      $('#ly_id'+ct).val('');
     
        $('#ly_name'+ct).val('');
        $('#ly_number'+ct).val('');
        $('#ly_points'+ct).val('');
        
         var decimal=$('#decimal').val();
         var gtt=$('#subtotal_loy_org').val();
       
     $('#subtotal_dis'+ct).text(gtt);
       
      $('#id_load'+ct).hide();
     $('#number_load'+ct).hide();
       $('#name_load'+ct).hide();
       
        $('#point_show'+ct).hide();
         $('#point_amount_show'+ct).hide();
         $('#ly_id'+ct).focus();
     });
 
 
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script> 
<style>
 .auth_dis_popup_close{width: 30px; height: 30px;position: absolute;right: 4px;top: 3px;background-color: #fff;}
     .auth_dis_popup_close img{width: 100%;}
     
      .discout_auth_contant{width: 100%; height: auto;float: left;padding: 10px; margin-top: 10px;}
     .discout_auth_contant_textbox_name{width: 100%;height: auto;float: left;font-size: 15px;color: #666;    margin-bottom: 5px;}
     .discout_auth_contant_textbox{
         width: 98%;
         height: 38px;
         float: left;
         border: 0;
            box-shadow: 0px 2px 7px #bdbdbd;
         background-color: #fff;
         padding-left: 10px;
        text-align: center;
             border-radius: 7px;
     }
     .auothorize_popup{
         width: 100%;
         height:162px;
         background-color: #f3f3f3;
         position: absolute;
         top:0px;
         left: 0;
             right: 0;
            margin: auto;
            z-index: 99999;
     }

     
     .auothorize_popup_head{
                 width: 100%;
    height: 41px;
    float: left;
    text-align: center;
    color: #5f2903;
    font-size: 18px;
    position: absolute;
    padding-top:25px;
/*    top: -41px;*/
    padding-bottom: 10px;
/*    background-color: #ffffff;*/

     }
     .auothorize_popup_head_act{
             background-color: #d2691e;
             color: #fff;
     }
     .auothorize_popup_footer_btn_cc{
         width: 100%;
         height: 41px;
        bottom: -37px;
        position: absolute;
         background-color: #fff;
         text-align: center;
    padding-top: 6px;
     }
/*     .discount_popu_head_cc h3:last-child{float: right}*/
/*     .auothorize_popup_bg{width: 100%;height: 42px;position: absolute;top: -41px;left: 0;}*/
     .loyalty_popup_keybord_cc{
         width: 198px;height: 240px;position: absolute;top: 0;
         right: -198px;background-color: #f3f3f3;padding-left: 7px; padding-top: 12px;
     }
     .loyalty_popup_keybord_cc .settle_key span, .top span.clear{    background-color: #d8d8d8 !important;    height: 43px;}
     .alert_section .popup_validate{line-height: 10px;    width: 100%;font-size: 13px;}
     .alert_section{width: 100%;height: 20px;float: left;text-align: center;padding: 0 2%;color: #f00;font-size: 13px;line-height: 18px}
     .cs_lyt_text_box{
         width: 100%;
         height: 30px;
         border: 0;
         float: left;
         box-shadow: 0px 2px 7px #bdbdbd;
         padding-left: 5px;
         border-radius: 4px;
     }
     .cs_loyalty_lable{width: 100%;height: auto;float: left;font-size: 12px; margin-bottom: 0px;  color: #8a8686;}
     .cs_loyalty_sec_box{
         width: 46%;
         height: auto;
         float: left;
         margin-right: 4%;
         margin-bottom: 10px;
     }
     .cs_loyalty_sec{
          width: 100%;
         height: auto;
         float: left;
         display: inline-block;
         padding: 6px 0 7px 0;
         padding-left: 4%;
         text-align: left;
         width: 100%;
         min-height: 98px;
         background-color: #f3f3f3;
             
     }
     .discount_loyalty_popup{
         width: 100%;
         height: auto;
         float: left;
        
     }
     .discount_popu_head_cc{
          width: 100%;
         height: auto;
         float: left;
         border-bottom: 1px #ccc solid; margin: 0px;margin-bottom:0
     }
     .discount_popu_head_cc h3{width: 50%;text-align: center;float: left;margin: 0;font-size: 18px;
         padding: 10px 0 10px 0;
           position: relative;
         cursor: pointer;
    border-bottom: 3px #f3f3f3 solid;
         background-color: #fff;
         height: auto;
         line-height: 20px;
           
     }
     .discount_popo_head_act{
          background-color: chocolate !important;
           border-bottom: 3px #a24c0f solid  !important;
        color: #fff;
     }
     
     
 .confrmation_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
 .confrmation_overlay_1{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
        display: none;
		}
  .confrmation_overlay_2{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99991;
	background-color:rgba(0,0,0,0.8);
	top:0;
        display: none;
		}
.index_popup_contant{
	width:100%;
	height:30px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}
</style>  
</body>
</html>
