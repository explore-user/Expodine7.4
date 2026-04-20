<?php
include("../database.class.php"); 
$database	= new Database();
error_reporting(0);
?>
<body>
<html>
     <div class="ledger_list_sec"  style="border:none;">


                               
                                <div class="ledger_list_scr">
                                    
                                    
           <table  cellpadding="1" cellspacing="3" width="50%" style="float:left;width: 99% !important;border-collapse: collapse; ">
        <tbody>
          <tr> 
              <td style="width:10%" id="printbutton"> <input type="submit" value="Print"  class="back-button-print print_button_main" onclick="return print_page()" />
          </td>
          
           <td  style="width:10%"> LEDGER DETAILS  </td>
               
             <td style="width:10%" id="printbutton">
                 
                 <img src="img/thin_left_arrow_333.png" onclick="return close_page()" style="cursor: pointer ">
                 
                 <input style="display:none" type="submit" value="Close"  class="back-button-print print_button_main" onclick="return close_page() " />   
        
          </td>
          
          </tr>
         
          
        </tbody>
        </table>
    
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:71vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.journal_opening_blc{width:auto;float:left;padding:10px;color:#fff;background-color:#4CAF50;font-size:16px;margin-bottom:10px}
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">

<?php
 if(isset($_REQUEST['acc']) && $_REQUEST['acc'] !=''){
          
          
      $string='';
      $string1='';
      $string2='';
      $string3='';
      $stringta='';
      $stringdi='';       
      $string_as='';	
      $string_con5='';
      $string_rec='';
      $string_loan_adv='';
      $string_crd_new1=" "; 
      $stringr='';
      $openclose=''; 
         
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{                    
      $openclose.=" and tps_dayclosedate  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
      $from = $_REQUEST['fromdt'];
      $to = $_REQUEST['todt'];
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from = $_REQUEST['fromdt'];
			$to=date("Y-m-d");                 
      $openclose.=" and tps_dayclosedate  between '".$_REQUEST['fromdt']."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
      $to=date("Y-m-d"); 
      $openclose.=" and tps_dayclosedate  between '".$from."' and '".$_REQUEST['todt']."' ";
		}else
	  {
		  $from=date("Y-m-d");
			$to=date("Y-m-d");
      $openclose.=" and tps_dayclosedate  between '".$from."' and '".$to."' ";
	  } ?>
    
    <table style="width: 99% !important;border-collapse: collapse;" >
        <thead>
          <tr>
              <td style="width:10%">Date</td> 
              <td style="width:16%">Account Type</td> 
              <td style="width:18%">Account Name</td>
              <td style="width:28%">Particular</td>
              <td style="width:14%">Debit </td>
              <td style="width:14%">Credit</td>                                             
          </tr>
      </thead>                                       
      <tbody id="load_journal_detail">
    <?php
    $sql_openbal  =  $database->mysqlQuery("select tps_dayclosedate,tps_ledger_open_bal from tbl_ledger_setting where tps_dayclosedate>='".$from."' and tps_ledger_id='".$_REQUEST['acc']."' limit 1"); 
    $num_openbal   = $database->mysqlNumRows($sql_openbal);  
    if($num_openbal){
      while($result_openbal  = $database->mysqlFetchArray($sql_openbal)) 
      {  ?>             
        <tr>
         <td><?=$result_openbal['tps_dayclosedate'] ?></td>
            <td colspan=5 style="font-weight:bold;text-align:left;padding-left:5px;">Opening Balance :             
               <span style="color:darkred">    <?=number_format($result_openbal['tps_ledger_open_bal'],$_SESSION['be_decimal']) ?> <span>
            </td>
         </tr>                                     
     <?php
      }
    }    
    $sql_logincashdi  =  $database->mysqlQuery("select tps_dayclosedate from tbl_ledger_setting where tps_dayclosedate!='' $openclose and tps_ledger_id='".$_REQUEST['acc']."' "); 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
      foreach ($sql_logincashdi as $result_login_openclose)
		  //while($result_login_openclose  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
                        $string= " and  ts.sv_date = '".$result_login_openclose['tps_dayclosedate']."' ";
                        $string1= " and  ts.ev_date = '".$result_login_openclose['tps_dayclosedate']."' ";
                        $string2= " and  date(tes.tes_entrydate) = '".$result_login_openclose['tps_dayclosedate']."' ";
                        $string3= " and tes.ev_date  ='".$result_login_openclose['tps_dayclosedate']."' ";                        
                        $stringdi= " bm_dayclosedate = '".$result_login_openclose['tps_dayclosedate']."' ";
			                  $stringta= " tab_dayclosedate  ='".$result_login_openclose['tps_dayclosedate']."' ";                       
                        $string_as= " and tpd_date  = '".$result_login_openclose['tps_dayclosedate']."' ";                        
                        $string_con5= " and cv_date   ='".$result_login_openclose['tps_dayclosedate']."' ";  
                        $string_crd_new1=" cdp_dayclosedate = '".$result_login_openclose['tps_dayclosedate']."' ";                          
                        $string_rec= " and tr_date =  '".$result_login_openclose['tps_dayclosedate']."' ";
                        $string_loan_adv=" and tla_date =  '".$result_login_openclose['tps_dayclosedate']."' ";
                        $stringr=" and date(tr_date)  = '".$result_login_openclose['tps_dayclosedate']."' ";
                                                        
////////////////-------------------------complimentary---------------------------------------------------///////////////                                                                     
    $consolidated_final=0;
    if($_REQUEST['acc_type'] =='Complimentary')
    {
            $payment_consolidated=array();
            $consolidated_final=0;           
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery ("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary='Y' and $stringdi  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary='Y' and $stringta
                                                    )x group by x.mode, x.dayclosedate order by x.dayclosedate asc "); 
                                                              
            $num_summary  = $database->mysqlNumRows($sql_summary);
            if($num_summary)
            {
                while($result_summary  = $database->mysqlFetchArray($sql_summary))
                {
                    $payment_consolidated[$result_summary['dayclosedate']][$result_summary['mode']]=$result_summary['total'];
                }
                foreach($payment_consolidated as $key=>$val){
                  $each_day_final=0;
                  if(array_key_exists("DI",$val)){ $each_day_final=$each_day_final+$val['DI']; $each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; }
                  if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA']; $each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } 
                  if(array_key_exists("CS",$val)){ $each_day_final=$each_day_final+$val['CS']; $each_module_sum['CS'][]=$val['CS'];  }else{ $each_module_sum['CS'][]=0;  }
                  if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD']; $each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; }    
            ?>
                <tr>
                    <td ><?=$key?></td>
                    <td >Sales</td>
                    <td></td>
                    <td >Complimentary Sales</td>
                    <td ><?php $consolidated_final=$consolidated_final+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                    <td >0.000</td>
                </tr> 
                <tr>
                    <td ></td>
                    <td ><?php if(array_key_exists("DI",$val)){ echo 'DI - ' .number_format($val['DI'],$_SESSION['be_decimal']);}else{ $each_module_sum['DI'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("TA",$val)){ echo 'TA - ' . number_format($val['TA'],$_SESSION['be_decimal']);}else{ $each_module_sum['TA'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("CS",$val)){ echo 'CS - ' . number_format($val['CS'],$_SESSION['be_decimal']);}else{$each_module_sum['CS'][]=0;  echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("HD",$val)){  echo 'HD - ' . number_format($val['HD'],$_SESSION['be_decimal']);}else{ $each_module_sum['HD'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    
                </tr>    
                  <tr >
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>                
                    <td ></td>
                </tr>            
            <?php
             }
            ?>    
                </tr >
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                 
                    <td ></td>
                </tr>    
                    
                    
                <tr style="font-weight: bold;" >
                    <td ><strong>Total</strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong><?=number_format($consolidated_final,$_SESSION['be_decimal'])?></strong></td>
                    <td ><strong>0.000</strong></td>
                </tr>
            <?php
    } }   ?>                                                              
   <!--        /////////////Sales//////////       -->
      <?php
      $consolidated_final_sale=0;
    if($_REQUEST['acc_type'] =='Sales'){
        $string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
            $payment_consolidated=array();
            $consolidated_final_sale=0;
            
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary!='Y' and $stringdi  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary!='Y' and $stringta
                                                    )x group by x.mode, x.dayclosedate order by x.dayclosedate asc "); 
                       
            $num_summary  = $database->mysqlNumRows($sql_summary);
            if($num_summary){
                while($result_summary  = $database->mysqlFetchArray($sql_summary)){
                    $totalcash=0;$subtotalcash=0;$subtotalcashta=0;$roundofdi=0;$roundofta=0;
        $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where bm_dayclosedate='".$result_summary['dayclosedate']."' and $stringdi group by bm_dayclosedate order by bm_dayclosedate ASC"); 
 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where tab_dayclosedate='".$result_summary['dayclosedate']."' and $stringta group by tab_dayclosedate order by tab_dayclosedate ASC"); 
  
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
                    
                    $payment_consolidated[$result_summary['dayclosedate']][$result_summary['mode']]=$result_summary['total'];
                }
                foreach($payment_consolidated as $key=>$val){
                    $each_day_final=0;

                  if(array_key_exists("DI",$val)){ $each_day_final=$each_day_final+$val['DI']; $each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; }
                  if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA']; $each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } 
                    if(array_key_exists("CS",$val)){ $each_day_final=$each_day_final+$val['CS']; $each_module_sum['CS'][]=$val['CS'];  }else{ $each_module_sum['CS'][]=0;  }
                  if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD']; $each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; } 
       
            ?>

                <tr>
                    <td ><?=$key?></td>
                   
                    <td >Sales</td>
                    <td >Software Sales</td>
                    <td >0.000</td>
                    <td ><?php $consolidated_final_sale=$consolidated_final_sale+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                </tr>
                    
                    
                <tr style="display:none">
                    <td ></td>
                    <td ><?php if(array_key_exists("DI",$val)){ echo 'DI - ' .number_format($val['DI'],$_SESSION['be_decimal']);}else{ $each_module_sum['DI'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("TA",$val)){ echo 'TA - ' . number_format($val['TA'],$_SESSION['be_decimal']);}else{ $each_module_sum['TA'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("CS",$val)){ echo 'CS - ' . number_format($val['CS'],$_SESSION['be_decimal']);}else{$each_module_sum['CS'][]=0;  echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("HD",$val)){  echo 'HD - ' . number_format($val['HD'],$_SESSION['be_decimal']);}else{ $each_module_sum['HD'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    
                </tr>    
                
                
                <tr style="display:none" >
                     <td ><strong></strong></td>
                    <td >Cash - <?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
                   
                    <td >Bank - <?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
                    <td >Credit - <?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
                 
                    <td ></td>
                </tr>      
                
                
                  <tr >
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                 
                    <td ></td>
                </tr>      
                    
                    
            <?php
                }
            ?>    
                
                <tr >
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                 
                    <td ></td>
                </tr>    
                    
                    
                <tr style="font-weight: bold;" >
                    <td ><strong>TOTAL</strong></td>
                    <td ><strong></strong></td>
                    <td ><strong></strong></td>
                    <td ><strong>0.000</strong></td>
                 
                    <td ><strong><?=number_format($consolidated_final_sale,$_SESSION['be_decimal'])?></strong></td>
                </tr>
            <?php
    } }                                
            
//----------------------/////////////---- sale calculation  cash and card //////////----------------------------------------//
               
      $string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
      $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
        
      $tot_cash=0; $tot_card=0;
      $payment_consolidated=array();            
      $each_module_sum=array();
            
           
      $sql_summary  =  $database->mysqlQuery("select sum(x.total) as total,x.pay1, x.dayclosedate from ( 
                                              select bm.bm_paymode as pay1,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary!='Y' and bm.bm_credit='N' and $stringdi  union all
                                              select bm.tab_paymode as pay1, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary!='Y' and bm.tab_credit='N' and $stringta
                                              )x group by x.pay1,x.dayclosedate order by x.dayclosedate desc"); 

      $num_summary  = $database->mysqlNumRows($sql_summary);
      if($num_summary)
      {
        while($result_summary  = $database->mysqlFetchArray($sql_summary))
        {
        $totalcash=0;$subtotalcash=0;$subtotalcashta=0;$roundofdi=0;$roundofta=0;
        $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster  where bm_status='Closed' and bm_paymode='1' and bm_dayclosedate='".$result_summary['dayclosedate']."'   group by bm_dayclosedate order by bm_dayclosedate ASC"); 
 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster  where tab_status='Closed' and tab_dayclosedate='".$result_summary['dayclosedate']."' group by tab_dayclosedate order by tab_dayclosedate ASC"); 
  
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
                    
                    
                    
             $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster left join tbl_bankmaster on bm_id=bm_transcbank left join tbl_ledger_master  on tlm_id=bm_account  where bm_paymode='2' and tlm_id='".$_REQUEST['acc']."' and bm_status='Closed' and bm_dayclosedate='".$result_summary['dayclosedate']."' group by bm_dayclosedate order by bm_dayclosedate ASC "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
				
			$dine_sale_card =$dine_sale_card + $result_login['tot'];
                        
          } } 

          //card
          $ta_sc_hd_sale_card=0;
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster left join tbl_bankmaster on bm_id=tab_transcbank left join tbl_ledger_master  on tlm_id=bm_account where tab_paymode='2' and tlm_id='".$_REQUEST['acc']."' and tab_status='Closed' and tab_dayclosedate='".$result_summary['dayclosedate']."' group by tab_dayclosedate order by tab_dayclosedate ASC "); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];
                      
          } }
          $total_module_sale_card=$dine_sale_card+$ta_sc_hd_sale_card;

          if($result_summary['pay1']=='1'){
              if($_REQUEST['acc_type'] =='Cash_account')
              {
               $tot_cash=  $tot_cash+$totalcash;              
                if($totalcash > 0 )
                { ?>
                <tr> 
                    <td style="width:10%;"><?=$result_summary['dayclosedate']?></td>                  
                    <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Sale</td>
                    <td style="width:18%;">Sales</td>
                    <td style="width:18%;">Cash </td>                   
                    <td style="width:14%;"><?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
                  <td style="width:14%;"></td>                  
                </tr>      
                
              <?php } } 
          }
          
          else{ 
              
               $tot_card=  $tot_card+$total_module_sale_card;                               
               if($tot_card > 0)
               {?>                   
                    <tr>
                      <td style="width:10%;"><?=$result_summary['dayclosedate']?></td>                 
                      <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Card</td>
                      <td style="width:18%;">Sales</td>
                      <td style="width:18%;">Card </td>
                      <td style="width:14%;"><?=number_format($total_module_sale_card,$_SESSION['be_decimal'])?></td>
                      <td style="width:14%;"></td>                 
                    </tr>                        
            <?php
              } }
            
            
                }
           
                }   
            ?>
                
                 
                
<!--                 
                <?php if($tot_card >0 || $tot_cash>0 ){ ?>
                 <tr style="font-weight: bold;">
                     
                     
                      <td style="width:10%;">Total</td>
                    <td style="width:18%;"> </td>
                   
                    <td style="width:18%;"></td>
                     
                    <td style="width:30%;"><?=number_format($tot_card+$tot_cash,$_SESSION['be_decimal'])?></td>
                  <td style="width:18%;"><?=number_format(0,$_SESSION['be_decimal'])?></td>
                  
                </tr>      -->
                
              
                
                    
<!--                 
                
                 <tr >
                     
                     
                      <td style="width:10%;"></td>
                    <td style="width:18%;"> </td>
                   
                    <td style="width:18%;"></td>
                     
                    <td style="width:30%;"></td>
                  <td style="width:18%;"></td>
                  
                </tr>      -->
                  <?php } ?>
                
                <?php
            
///---------------------------------------credit settle cash card------------------------------------------------------//
  $tot_credit_card=0;   $tot_credit_cash=0;
  $sql_logincpta1  =  $database->mysqlQuery("select cdp_dayclosedate,cdp_bank from tbl_credit_details_payment where $string_crd_new1 group by cdp_dayclosedate,cdp_bank"); 
	$num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	if($num_logincpta1){
             
		while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
		{     
    $credit_cash=0;
    $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where cdp_dayclosedate='".$result_logincpta1['cdp_dayclosedate']."' group by  cdp_dayclosedate"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_cash =$credit_cash + $result_logincpta['tot'];
           }} 
          $credit_card=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment left join 
           tbl_bankmaster on bm_id=cdp_bank  left join tbl_ledger_master  on tlm_id=bm_account where tlm_id='".$_REQUEST['acc']."' and 
           cdp_dayclosedate='".$result_logincpta1['cdp_dayclosedate']."' group by  cdp_dayclosedate "); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_card =$credit_card + $result_logincpta['tot'];
           }} 
           if($result_logincpta1['cdp_bank']=='0' ){              
              if($_REQUEST['acc_type'] =='Cash_account'){
                $tot_credit_cash=  $tot_credit_cash+$credit_cash;
                ?>
                <tr>
                    <td style="width:10%;"><?=$result_logincpta1['cdp_dayclosedate']?></td>
                    <td style="font-weight: bold;width:16%;" >Credit Sales</td>                   
                    <td style="width:18%;">Sales</td>
                    <td style="width:28%;">Cash </td>
                    <td style="width:14%;"><?=number_format($credit_cash,$_SESSION['be_decimal'])?></td>
                    <td style="width:14%;"></td>
                </tr>                     
          <?php
               }
           } else{ 
                $tot_credit_card=  $tot_credit_card+$credit_card; ?>                   
                    <tr>                    
                      <td style="width:10%;"><?=$result_logincpta1['cdp_dayclosedate']?></td>
                      <td style="font-weight: bold;width:16%;" >Credit Sales</td>                      
                      <td style="width:18%;">Sales</td>
                      <td style="width:28%;">Card </td>
                      <td style="width:14%;"><?=number_format($credit_card,$_SESSION['be_decimal'])?></td>
                      <td style="width:14%;"></td>                 
                    </tr>                       
            <?php
          }}} ?> 
                
                 
                
                 <!-- <?php if($tot_credit_card >0 || $tot_credit_cash>0 ){ ?> 
                 <tr style="font-weight: bold;">                                       
                    <td style="width:10%;">Total</td>
                    <td style="width:18%;"> </td>
                    <td></td>
                    <td style="width:18%;"></td>                    
                    <td style="width:30%;"><?=number_format($tot_credit_card+$tot_credit_cash,$_SESSION['be_decimal'])?></td>
                    <td style="width:18%;"><?=number_format(0,$_SESSION['be_decimal'])?></td>                  
                  </tr>     

                <?php } ?>    
                
                 <tr>   
                      <td style="width:10%;"></td>
                    <td style="width:18%;"> </td>
                   
                    <td style="width:18%;"></td>
                     
                    <td style="width:30%;"></td>
                  <td style="width:18%;"></td>
                  
                </tr> -->
                
                <?php
           /////--------------------------------------loan-------------------------------------------//// 
          $tot_debit_loan_adv=0; $tot_credit_loan_adv=0;  
           $sql_login457  =  $database->mysqlQuery("select * from tbl_loan_advance  where tla_from='".$_REQUEST['acc']."'  $string_loan_adv "); 
	
           $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){ 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_credit_loan_adv=$tot_credit_loan_adv+$result_login['tla_amount'];  ?>
              <tr>
                 <td style="width:10%;"><?=$result_login['tla_date']?></td>
                  <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Loan-Advance Voucher</td>  
             <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tla_to']."'  "); 
	            $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4)
          {                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>                        
                <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                 <?php }} else { echo '<td></td>'; } ?>  
                <td style="width:28%;"><?=ucwords(strtolower($result_login['tla_particulars']))?></td>
                <td style="width:14%;"></td>
                <td style="width:14%;"><?= number_format($result_login['tla_amount'],$_SESSION['be_decimal'])?></td>   
                </tr>
                <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit_loan_adv,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit_loan_adv,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                     
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
                                              
                                        
      <?php }  ?>                 
              
 <!-------------------------------------------/////////////loan adv to acc ////////// ------------------------------------------>
        <?php                                  
          $tot_debit_loan_adv1=0; $tot_credit_loan_adv1=0;  
           $sql_login457  =  $database->mysqlQuery("select tla_paid,tla_date,tla_from from tbl_loan_advance  where tla_to='".$_REQUEST['acc']."'  $string_loan_adv "); 
	
           $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_debit_loan_adv1=$tot_debit_loan_adv1+$result_login['tla_paid']; ?>
           <tr>
              <td style="width:10%;"><?=$result_login['tla_date']?></td>
              <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Loan-Advance Voucher</td>
              <?php
                                              
          $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tla_from']."'  "); 
          $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>
                <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                <?php }}  else { echo '<td></td>';} ?>  
                <td style="width:28%;"><?=ucwords(strtolower($result_login['tla_particulars']))?></td>
                <td style="width:14%;"><?= number_format($result_login['tla_paid'],$_SESSION['be_decimal'])?></td>  
                <td style="width:14%;"></td> 
                </tr>
                <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit_loan_adv1,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit_loan_adv1,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                      
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
                                              
                                        
      <?php
                                        }           
                
               
               ?>                
                                        
          <!--        /////////////Receipt From acc //////////                                -->
               
       
           
           
        <?php                                
   
          $tot_debit_rec=0; $tot_credit_rec=0;  
           $sql_login457  =  $database->mysqlQuery("select tr_amount,tr_date,tr_to,tr_particulars from tbl_receipts  where tr_from='".$_REQUEST['acc']."'  $string_rec "); 
	
           $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){ 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_credit_rec=$tot_credit_rec+$result_login['tr_amount']; ?>
                                    <tr>
                                      <td style="width:10%;"><?=$result_login['tr_date']?></td>
                                      <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Receipt Voucher</td>     
          <?php
          $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tr_to']."'  "); 
	        $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                               
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
                                 <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                                 <?php }} else { echo '<td></td>'; } ?>  
                                <td style="width:28%;"><?=ucwords(strtolower($result_login['tr_particulars']))?></td>
                                 <td style="width:14%;"></td>
                                 <td style="width:14%;"><?= number_format($result_login['tr_amount'],$_SESSION['be_decimal'])?></td>   
                                 </tr>                                       
                     <?php    }    ?>  
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit_rec,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit_rec,$_SESSION['be_decimal'])?></td>
                                        </tr>                                -->
      <?php
                                        }           
                
               
               ?>                 
                
                
                                        
            <!--        /////////////Receipt to acc //////////                                -->
               
       
           
           
        <?php                                
   
          $tot_debit_rec1=0; $tot_credit_rec1=0;  
           $sql_login457  =  $database->mysqlQuery("select tr_amount,tr_date,tr_from,tr_particulars from tbl_receipts  where tr_to='".$_REQUEST['acc']."'  $string_rec "); 
	
           $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){ 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_debit_rec1=$tot_debit_rec1+$result_login['tr_amount'];?>
            <tr>
                <td style="width:10%;"><?=$result_login['tr_date']?></td>
                <td style="font-weight: bold;width:16%;text-transform: capitalize ;" >Receipt voucher</td>
           <?php                                             
          $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tr_from']."'  "); 
	        $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
                <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                <?php }} else { echo '<td></td>';} ?>  
                <td style="width:28%;"><?=ucwords(strtolower($result_login['tr_particulars']))?></td>
                <td style="width:14%;"><?= number_format($result_login['tr_amount'],$_SESSION['be_decimal'])?></td>   
                <td style="width:14%;"></td> 
                </tr>
    <?php }    ?>
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit_rec1,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit_rec1,$_SESSION['be_decimal'])?></td>
                                        </tr>                                  -->
      <?php
         }           
      ?>                 
 <!------------------------/////////////Contra From acc /////////------------------------------->
  <?php                                
    $tot_debit15=0; $tot_credit15=0;  
    $sql_login457  =  $database->mysqlQuery("select * from tbl_contra_voucher  where cv_from_acc='".$_REQUEST['acc']."'  $string_con5 "); 
	  $num_login457   = $database->mysqlNumRows($sql_login457);
		if($num_login457){ 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{          
          $tot_credit15=$tot_credit15+$result_login['cv_amount']; ?>
                       <tr>
                            <td style="width:10%;"><?=$result_login['cv_date']?></td>
                            <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Contra Voucher</td>
              <?php
                  $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['cv_to_acc']."'  ");   
                  $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
                           <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
          <?php }}  else {
            echo '<td></td>';
            }?>  
                          <td style="width:28%;"><?=ucwords(strtolower($result_login['cv_remarks']))?></td>
                          <td style="width:14%;"></td>
                          <td style="width:14%;"><?= number_format($result_login['cv_amount'],$_SESSION['be_decimal'])?></td>   
                          </tr>                                   
                     <?php    }    ?>
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td><td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit15,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit15,$_SESSION['be_decimal'])?></td>
                                        </tr>                                -->
      <?php  }   ?>                            
  <!--------------------------/////////////Contra to acc //////////------------------------------------ -->         
  <?php                                
    $tot_debit16=0; $tot_credit16=0;  
    $sql_login4575  =  $database->mysqlQuery("select * from tbl_contra_voucher  where cv_to_acc='".$_REQUEST['acc']."'  $string_con5 "); 
    $num_login4575   = $database->mysqlNumRows($sql_login4575);
		if($num_login4575){ 
					while($result_login  = $database->mysqlFetchArray($sql_login4575)) 
					{         
          $tot_debit16=$tot_debit16+$result_login['cv_amount']; ?>
                  <tr>
                    <td style="width:10%;"><?=$result_login['cv_date']?></td>
                    <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Contra Voucher</td>
                  <?php
                   $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['cv_from_acc']."'  "); 
	                $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){
                                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
          <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
          <?php }} else { echo '<td></td>'; } ?>  
          <td style="width:28%;"><?=ucwords(strtolower($result_login['cv_remarks']))?></td>
          <td style="width:14%;"><?= number_format($result_login['cv_amount'],$_SESSION['be_decimal'])?></td>   
          <td style="width:14%;"></td>
          </tr>
          <?php  }  ?>
                                        
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit16,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit16,$_SESSION['be_decimal'])?></td>
                                        </tr>
                              -->
      <?php }       ?>                   
                    
         <!---------------------------------/////////////supplier asset //////////-------------------------->   
        <?php                                
          $tot_debit11=0; $tot_credit11=0;
           $sql_login45  =  $database->mysqlQuery("select * from tbl_asset_purchase_invoice_detail  where tpd_vendor='".$_REQUEST['ven']."'  $string_as order by tpd_id asc"); 
           $num_login45   = $database->mysqlNumRows($sql_login45);
					if($num_login45){ 
					while($result_login  = $database->mysqlFetchArray($sql_login45)) 
					{ 
          $tot_debit11=$tot_debit11+$result_login['tpd_paid_amount']; ?>
            <tr>
                  <td style="width:10%;"><?=$result_login['tpd_date']?></td>
                  <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Supplier Asset</td>
                  <?php                                             
                    $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login['tpd_from_acc']."'  "); 
                    $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                  
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
                  <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
           <?php }} else{ echo '<td></td>'; } ?>  
                  <td style="width:28%;"><?=ucwords(strtolower($result_login['tpd_remarks']))?></td>
                   <td style="width:14%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>        
           <?php if($result_login['tpd_type_pay']=='First'){ 
            $tot_credit11=$tot_credit11+$result_login['tpd_netamount'];
            ?>
            <td style="width:14%;"><?= number_format($result_login['tpd_netamount'],$_SESSION['be_decimal'])?></td>
            <?php }else{ ?>
         <td style="width:14%;"></td>
             <?php } ?>
               </tr>                                        
                <?php    }    ?>
                                        
                    <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td>Balance : <?=$tot_credit11-$tot_debit11?> </td>
                                               <td></td>
                                        </tr>
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit11,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit11,$_SESSION['be_decimal'])?></td>
                                        </tr> -->
                                        
<!--                                         
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                         -->
                                              
                                        
      <?php
                                        }           
                
               
               ?>
                <!--        /////////////supplier from acc  asset //////////                                -->
               
        <?php                                
   
          $tot_debit12=0;$tot_credit12=0;    
           $sql_login454  =  $database->mysqlQuery("select * from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$_REQUEST['acc']."'  $string_as "); 
	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){
                                            ?>
                                          <!-- <tr>
                                            <td style="font-weight: bold;" >Supplier Asset</td>
                                             
                                        </tr> -->
                                        <?php
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{ 
          
          $tot_credit12=$tot_credit12+$result_login['tpd_paid_amount'];
          //$tot_debit12=$tot_debit12+$result_login['tpd_discount'];
          $tot_debit12=$tot_debit12;  ?>
             <tr>
                  <td style="width:10%;"><?=$result_login['tpd_date']?></td>
                  <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Supplier Asset</td>
            <?php
            $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login['tpd_vendor']."'  "); 
            $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>                                                           
                <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                <?php }}  
                else {
                  echo '<td></td>';
                }?>                                            
                <td style="width:28%;"><?=ucwords(strtolower($result_login['tpd_remarks']))?></td>                                            
                <td style="width:14%;"></td>                                           
                <td style="width:14%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>
                                          
          </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit12,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit12,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
                                              
                                        
      <?php
                                        }           
         ?>           
                    
                    
                    
<!--        /////////////supplier from acc//////////                                -->
                                        
          

 <?php                                
    $tot_debit=0;$tot_credit=0;
    /*
    $sql_login  =  $database->mysqlQuery("select * from tbl_supplier_voucher ts  where ts.sv_from='".$_REQUEST['acc']."'  $string "); 
    $num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){ 
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          $tot_debit=$tot_debit+$result_login['sv_discount']; 
          
          $tot_credit=$tot_credit+$result_login['sv_paid_amount']; ?>
             <tr>
                <td style="width:10%;"><?=$result_login['sv_date']?></td>
                <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Supplier</td>
                <?php                                              
                $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login['sv_vendor_id']."'  "); 
                $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{  ?>
              <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
              <?php }} 
              else {
                echo '<td></td>';
              } ?>  
              <td style="width:28%;"><?=ucwords(strtolower($result_login['sv_remarks']))?></td>
              <td style="width:14%;"><?= number_format($result_login['sv_discount'],$_SESSION['be_decimal'])?></td>
              <td style="width:14%;"><?=$result_login['sv_paid_amount']?></td>
              </tr>                                       
           <?php    }    ?>
<!--                     
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit,$_SESSION['be_decimal'])?></td>
                                        </tr> -->
 
            <!--        /////////////supplier vendor side//////////                                -->                                              
                                        
      <?php
                                        }*/
                                        
                                        
                                      
          $tot_debit6=0;$tot_credit6=0; $rt=0;
          $sql_login66  =  $database->mysqlQuery("select sv_paid_amount,sv_date,sv_from,sv_remarks,sv_paid_amount,sv_type_pay,sv_invoice_amount from tbl_supplier_voucher ts  where ts.sv_from='".$_REQUEST['acc']."'  $string order by ts.sv_id asc "); 
          $num_login66   = $database->mysqlNumRows($sql_login66);
					if($num_login66){
                                            
					while($result_login66  = $database->mysqlFetchArray($sql_login66)) 
					{ 
            if($result_login66['sv_paid_amount']>0){
            ?>
            <tr>
              <td style="width:10%;"><?=$result_login66['sv_date']?>  </td>
              <td style="font-weight: bold;" >Supplier </td>
          <?php
          $tot_debit6=$tot_debit6+$result_login66['sv_paid_amount'];                   
          $sql_login5212  =  $database->mysqlQuery("select sum(tr_return_amount) as tot  from tbl_return_payment where tr_to_acc='".$_REQUEST['acc']."'   "); 
          $num_login45   = $database->mysqlNumRows($sql_login5212);
					if($num_login45)
          {                                           
					while($result_login452  = $database->mysqlFetchArray($sql_login5212)) 
					{ 
            $rt=$result_login452['tot'];  
          }
          }
   
          if($result_login66['sv_from']!='')
          {
          $sql_login52  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login66['sv_from']."'  "); 
          $num_login45   = $database->mysqlNumRows($sql_login52);
					  if($num_login45)
            {                                           
					    while($result_login45  = $database->mysqlFetchArray($sql_login52)) 
					    {  ?>
              <td style="width:18%;"><?=ucwords(strtolower($result_login45['tlm_ledger_name']))?></td>
              <?php 
              }
            } 
                                        
          }else
          { ?>                                            
          <td style="width:18%;"></td>
          <?php
          } ?>                                                
          <td style="width:30%;"><?=$result_login66['sv_remarks']?></td>
                  <?php  if($_REQUEST['acc_type'] =='Cash_account' || $_REQUEST['acc_type'] =='Bank_account'){ ?>               
                  <td style="width:18%;"></td>
                  <td style="width:18%;"><?=$result_login66['sv_paid_amount']?></td>
                    <?php } 
                    else{ ?>              
                  <td style="width:18%;"><?=$result_login66['sv_paid_amount']?></td>
                  <td style="width:18%;"></td>                 
                    <?php } ?>
                                              
          <?php /*if($result_login66['sv_type_pay']=='First'){ 
                                              
          $tot_credit6=$tot_credit6+$result_login66['sv_invoice_amount']; ?>
          <td style="width:14%;"><?= number_format($result_login66['sv_invoice_amount'],$_SESSION['be_decimal'])?></td>
          <?php }else{ ?>
          <td style="width:14%;"><?= number_format(0,$_SESSION['be_decimal'])?></td>
          <?php }*/ ?>
          </tr>
          <?php   } }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit6,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_credit6,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td><?php echo $rt ; ?></td>
                                              <td>Balance: <?=($tot_credit6-$tot_debit6)-$rt?> </td>
                                               <td></td>
                                        </tr> -->
                                        
                                                          
                                        
      <?php
                                        }                             
                                        
                                        
                  /////////////return payment vendor//////////                                
                   
   
          $tot_debitr1=0;$tot_creditr1=0;
           $sql_login  =  $database->mysqlQuery("select * from tbl_return_payment  where tr_vendor='".$_REQUEST['ven']."'  $stringr "); 
	//echo "select * from tbl_supplier_voucher ts left join tbl_ledger_master tm  on ts.sv_vendor_id=tm.tlm_vendor_id where tm.tlm_id='".$_REQUEST['acc']."' and tm.tlm_group='".$_REQUEST['grp']."' $string ";
           $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
         
          
          $tot_debitr1=$tot_debitr1+$result_login['tr_return_amount'];
                  
          
                                        ?>
                                        <tr>
                                              <td style="width:10%;"><?=$result_login['tr_date']?></td>
                                              <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Supplier Return</td>
                                              <?php
                                              
                                               $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login['tr_vendor']."'  "); 
	
                                          $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){
                                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>
               <td style="width:18%; "><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                <?php }}  else { echo '<td></td>'; }?>                                               
                                              <td style="width:28%;"><?=ucwords(strtolower($result_login['tr_particulars']))?></td>
                                              <td style="width:14%;"><?=$result_login['tr_return_amount']?></td>
                                              <td style="width:14%;"></td>
                                        </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debitr1,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_creditr1,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
                                                            
                                        
      <?php
                                        
                                        }                          
                /////////////return payment end //////////                                
                                
                                        
                     /////////////purchase return entry //////////                                
                   if($_REQUEST['grp']=='66'){
   
          $tot_debitr11=0;$tot_creditr11=0;
           $sql_login  =  $database->mysqlQuery("select * from tbl_return_payment  where tr_vendor!=''  $stringr "); 
        $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                     
					while($result_login11  = $database->mysqlFetchArray($sql_login)) 
					{ 
         
          
          $tot_creditr11=$tot_creditr11+$result_login11['tr_return_amount'];
                  
          
                                        ?>
                                        <tr>
                                              <td style="width:10%;"><?=$result_login11['tr_date']?></td>
                                              <td style="font-weight: bold;width:16%;" >Purchase Return</td>
                                              <?php
                                              
                                               $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login11['tr_vendor']."'  "); 
	
                                          $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){
                                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ 
                                            ?>
                                        
                                              
                                              <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                                        <?php }}  ?>  
                                              
                                              <td style="width:28%;"><?=ucwords(strtolower($result_login11['tr_particulars']))?></td>
                                              
                                             
                                             
                                             
                                          
                                                
                                               <td style="width:14%;"></td>
                                              <td style="width:14%;"><?=$result_login11['tr_return_amount']?></td>
                                             
                                        </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debitr11,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_creditr11,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
                                                            
                                        
      <?php
                                        
                                        }    
                                        
                   }
                /////////////pr end  return payment //////////                       
                                  
   
          $tot_debitr=0;$tot_creditr=0;  $rt_type='No';

           $sql_login  =  $database->mysqlQuery("select date(tr_date) as tr_date ,tr_return_amount,tr_vendor,tr_particulars from tbl_return_payment  where tr_to_acc='".$_REQUEST['acc']."'  $stringr "); 
           $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            ?>
                                          <!-- <tr>
                                            <td style="font-weight: bold;color:darkred" >Supplier Return</td>
                                             
                                        </tr> -->
                                        <?php
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{
             $sql_login2  =  $database->mysqlQuery("select tlm_type from tbl_ledger_master  where tlm_id='".$_REQUEST['acc']."' and (tlm_type='Bank_account' or tlm_type='Cash_account') "); 
              $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){
                   $rt_type='Yes';
                  }else{
                  $rt_type='No';
                  }

          $tot_debitr=$tot_debitr+$result_login['tr_return_amount'];
               ?>
     <tr>
          <td style="width:10%;"><?=$result_login['tr_date']?></td>
          <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Supplier Return</td>
      <?php
       $sql_login2  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login['tr_vendor']."'  "); 
	
        $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4){
                                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ 
                                            ?>
                                        
                                              
                                              <td style="width:18%;"><?=ucwords(strtolower($result_login4['tlm_ledger_name']))?></td>
                                        <?php }}  ?>  
                                              
                                              <td style="width:28%;"><?=ucwords(strtolower($result_login['tr_particulars']))?></td>
                                              
                                             
                                             
                                             
                                           <td style="width:14%;"><?=$result_login['tr_return_amount']?></td>
                                                <td style="width:14%;"></td>
                                              
                                             
                                        </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debitr,$_SESSION['be_decimal'])?></td>
                                               <td><?= number_format($tot_creditr,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                        
                                   <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                        
   <!----------------/////////////supplier vendor side////////// -------------------------------------------------->                                                                             
      <?php
                                        }                             
                               
      //////////////-------------------------employeeeee voucher from acc--------------------///////////////////////////////
      
      
       $tot_debit1=0; $tot_credit1=0;
           $sql_login5  =  $database->mysqlQuery("select * from tbl_employee_voucher ts  where ts.ev_from='".$_REQUEST['acc']."'  $string1 "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_credit1=$tot_credit1+$result_login5['ev_amount'];
         
                  
          
                                        ?>
                                        <tr>
                                              <td style="width:10%;"><?=$result_login5['ev_date']?></td>
                                              <td style="font-weight: bold;width:16%;text-transform: capitalize; ">Employee Voucher</td>
                                              <?php
                                              
                                               $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_staff_id='".$result_login5['ev_employee_id']."'  "); 
	
                                          $num_login6   = $database->mysqlNumRows($sql_login6);
					if($num_login6){
                                           
					while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                            ?>
                                        
                                              
                                              <td style="width:18%;"><?=ucwords(strtolower($result_login6['tlm_ledger_name']))?></td>
                                        <?php }}  ?>  
                                              
                                              <td style="width:28%;"><?=ucwords(strtolower($result_login5['ev_remarks']))?></td>
                                             
                                              
                                                <td style="width:14%;"></td>
                                                
                                              <td style="width:14%;"><?=$result_login5['ev_amount']?></td>
                                              
                                        </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr>
                                     <tr style="font-weight: bold;">
                                         <td>TOTAL</td>
                                             <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit1,$_SESSION['be_decimal'])?></td>
                                               <td><?=  number_format($tot_credit1,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                         -->
                                       <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> 
                                        
                                           -->
                                        
      <?php
                                        }
     
                                        
                //////////////employeeeee voucher to acc///////////////////////////////
      
      
       $tot_debit7=0; $tot_credit7=0;
           $sql_login56  =  $database->mysqlQuery("select * from tbl_employee_voucher ts  where ts.ev_employee_id='".$_REQUEST['staff']."'  $string1 "); 
	
           $num_login56   = $database->mysqlNumRows($sql_login56);
					if($num_login56){
                                            ?>
                                        <tr>
                                            <td style="font-weight: bold;color:darkred" >EMPLOYEE VOUCHER</td>
                                             
                                        </tr> 
                                        <?php
					while($result_login56  = $database->mysqlFetchArray($sql_login56)) 
					{ 
                                            
                                            
          $tot_debit7=$tot_debit7+$result_login56['ev_amount'];
         
                  
          
                                        ?>
                                        <tr>
                                              <td style="width:10%;"><?=$result_login56['ev_date']?></td>
                                              <?php
                                              
                                               $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login56['ev_from']."'  "); 
	
                                          $num_login6   = $database->mysqlNumRows($sql_login6);
					if($num_login6){
                                           
					while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                            ?>
                                        
                                              
                                              <td style="width:16%;"><?=ucwords(strtolower($result_login6['tlm_ledger_name']))?></td>
                                        <?php }}  ?>  
                                              
                                              <td style="width:28%;"><?=ucwords(strtolower($result_login56['ev_remarks']))?></td>
                                             
                                              <td style="width:14%;"><?=$result_login56['ev_amount']?></td>
                                              
                                              
                                              
                                        <?php if($result_login56['ev_pay_type_acc']=='First'){ 
                                              
                                              $tot_credit7=$tot_credit7+$result_login56['ev_net_salary_new']; 
                                              
                                              ?>
                                                <td style="width:14%;"><?=  number_format($result_login56['ev_net_salary_new'],$_SESSION['be_decimal'])?></td>
                                              
                                        <?php }else{ ?>       
                                               <td style="width:14%;"></td>  
                                                
                                           <?php } ?>  
                                               
                                               
                                        </tr>
                                        
                     <?php    }    ?>
                    
                                        <!-- <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td></td>
                                               <td></td>
                                        </tr> -->
                                     <!-- <tr style="font-weight: bold;">
                                         <td>TOTAL</td>
                                             <td></td>
                                               <td></td>
                                               
                                             <td><?=  number_format($tot_debit7,$_SESSION['be_decimal'])?></td>
                                               <td><?=  number_format($tot_credit7,$_SESSION['be_decimal'])?></td>
                                        </tr>
                                        
                                       <tr>
                                            <td ></td>
                                             <td></td>
                                               <td></td>
                                              <td>Balance : <?=$tot_credit7-$tot_debit7?> </td>
                                               <td></td>
                                        </tr> 
                                         -->
                                          
                                        
      <?php
                                        }                        
                                        
                                        
      //////////////direct expense to///////////////////////////////
      
      
    $tot_debit2=0; $tot_credit2=0;
    $sql_login78  =  $database->mysqlQuery("select * from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_to_acc='".$_REQUEST['acc']."'  $string3 "); 
	  $num_login78   = $database->mysqlNumRows($sql_login78);
		if($num_login78){ 
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
          $tot_debit2=$tot_debit2+$result_login78['ev_amount']; ?>
                    <tr>
                      <td style="width:10%;"><?=$result_login78['ev_date']?></td>
                      <td style="font-weight: bold;color:darkred;width:16%;" >Direct Expense</td>
         <?php
          $sql_login88  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login78['ev_from_acc']."'  "); 
	        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){                             
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{  ?>
                     <td style="width:18%;"><?=ucwords(strtolower($result_login88['tlm_ledger_name']))?></td>
          <?php }} 
          else { echo '<td></td>'; }
          ?>  
                     <td style="width:28%;"><?=ucwords(strtolower($result_login78['ev_remarks']))?></td>
                     <td style="width:14%;"><?=  number_format($result_login78['ev_amount'],$_SESSION['be_decimal'])?></td>
                    <td style="width:14%;"></td>
                    </tr>
                    <?php    }   ?>

                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td>
                                               <td></td>
                                             <td><?=  number_format($tot_debit2,$_SESSION['be_decimal'])?></td>
                                               <td><?=  number_format($tot_credit2,$_SESSION['be_decimal'])?></td>
                                        </tr>                                    -->
      <?php
                                        }
                         
//////////////---------------------------------- direct expense from----------------------------------///////////////////////////////
       $tot_debit3=0; $tot_credit3=0; 
       $sql_login781  =  $database->mysqlQuery("select * from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$_REQUEST['acc']."'  $string3 "); 
	     $num_login781   = $database->mysqlNumRows($sql_login781);
					if($num_login781){
					while($result_login781  = $database->mysqlFetchArray($sql_login781)) 
					{     
         $tot_credit3=$tot_credit3+$result_login781['ev_amount']; ?>
               <tr> 
                <td style="width:10%;"><?=$result_login781['ev_date']?></td>
                  <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Direct Expense</td>
               <?php
          $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login781['ev_to_acc']."'  "); 
	        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){                                         
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{  ?>
            <td style="width:18%;"><?=ucwords(strtolower($result_login88['tlm_ledger_name']))?></td>
         <?php }}
         else {
          echo "<td></td>";
         }  ?>  
            <td style="width:28%;"><?=ucwords(strtolower($result_login781['ev_remarks']))?></td>
            <td style="width:14%;"></td> 
            <td style="width:14%;"><?=  number_format($result_login781['ev_amount'],$_SESSION['be_decimal'])?></td>
          </tr>
          <?php  }  ?>                  
              <!-- <tr style="font-weight: bold;">
                  <td  >TOTAL</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><?=  number_format($tot_debit3,$_SESSION['be_decimal'])?></td>
                  <td><?=  number_format($tot_credit3,$_SESSION['be_decimal'])?></td>
              </tr>                                                                                   -->
      <?php
       }                             
                                        
      //////////////INDIRECECT EXPENSE FROM ///////////////////////////////
    
      $tot_debit4=0; $tot_credit4=0;
      $sql_login79  =  $database->mysqlQuery("select * from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$_REQUEST['acc']."'   $string3"); 
	    $num_login79   = $database->mysqlNumRows($sql_login79);
			if($num_login79){
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
         $tot_credit4=$tot_credit4+$result_login79['ev_amount']; ?>
                        <tr>
                          <td style="width:10%;"><?=$result_login79['ev_date']?></td>
                          <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Indirect Expense</td>
         <?php
          $sql_login89  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login79['ev_to_acc']."'  "); 
	        $num_login89   = $database->mysqlNumRows($sql_login89);
					if($num_login89){                                           
					while($result_login89  = $database->mysqlFetchArray($sql_login89)) 
					{  ?>
                         <td style="width:18%;"><?=ucwords(strtolower($result_login89['tlm_ledger_name']))?></td>
           <?php }}  ?>  
                          <td style="width:28%;"><?=ucwords(strtolower($result_login79['ev_remarks']))?></td>
                          <td style="width:14%;"></td>
                          <td style="width:14%;"><?=  number_format($result_login79['ev_amount'],$_SESSION['be_decimal'])?></td>
                          </tr>                                        
                     <?php    }   ?>                  
                                     <!-- <tr style="font-weight: bold;">
                                         <td  >TOTAL</td>
                                             <td></td>
                                               <td></td> <td></td>
                                             <td><?=  number_format($tot_debit4,$_SESSION['be_decimal'])?></td>
                                               <td><?=  number_format($tot_credit4,$_SESSION['be_decimal'])?></td>
                                        </tr>                                    -->
 <?php } 
 
 //////////////INDIRECECT EXPENSE TO ///////////////////////////////
    
    $tot_credit5=0; $tot_debit5=0;
    $sql_login79  =  $database->mysqlQuery("select * from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_to_acc='".$_REQUEST['acc']."'   $string3"); 
    $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{          
          $tot_debit5=$tot_debit5+$result_login79['ev_amount'];  ?>
              <tr>
                  <td style="width:10%;"><?=$result_login79['ev_date']?></td>
                  <td style="font-weight: bold;width:16%;text-transform: capitalize;" >Indirect Expense</td>
              <?php
                 $sql_login89  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login79['ev_from_acc']."'  "); 
	               $num_login89   = $database->mysqlNumRows($sql_login89);
					if($num_login89){                                          
					while($result_login89  = $database->mysqlFetchArray($sql_login89)) 
					{  ?>
              <td style="width:18%;"><?=ucwords(strtolower($result_login89['tlm_ledger_name']))?></td>
              <?php }}  ?>  
              <td style="width:28%;"><?=ucwords(strtolower($result_login79['ev_remarks']))?></td>
              <td style="width:14%;"><?=  number_format($result_login79['ev_amount'],$_SESSION['be_decimal'])?></td>
              <td style="width:14%;"></td>
              </tr>                   
      <?php   }   ?>

              <!-- <tr style="font-weight: bold;">
                  <td  >TOTAL</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><?=  number_format($tot_debit5,$_SESSION['be_decimal'])?></td>
                  <td><?=  number_format($tot_credit5,$_SESSION['be_decimal'])?></td>
                </tr>                                                                             -->
 <?php }  ?>
                                         
     
                                            
                <?php
 
 
   
 $debt=$debt+ ($tot_debitr+$tot_debitr1+$tot_debit+$tot_debit1+$tot_debit2+$tot_debit3+$tot_debit4+$tot_debit5+
 $tot_debit7+$tot_debit11+$tot_debit12+$tot_debit15+$tot_debit16+$tot_debit_rec+
 $tot_debit_rec1+$tot_debit_loan_adv+$tot_debit_loan_adv1+$tot_card+$tot_cash+$tot_credit_card+$tot_credit_cash)  ;


if($rt_type=='No') 
{
$crdt=$crdt+($tot_debit6+$tot_creditr1+$tot_credit+$tot_credit1+$tot_credit2+$tot_credit3+$tot_credit4+$tot_credit5+$tot_credit6+$tot_credit7+$consolidated_final_sale+$tot_credit11+$tot_credit12+$tot_credit15+$tot_credit16+$tot_credit_rec+$tot_credit_rec1+$tot_credit_loan_adv1+$tot_credit_loan_adv)-$tot_creditr ;
}else{ // acc_type = bank or cash
$crdt=$crdt+($tot_debit6+$tot_creditr1+$tot_credit+$tot_credit1+$tot_credit2+$tot_credit3+$tot_credit4+$tot_credit5+$tot_credit6+$tot_credit7+$consolidated_final_sale+$tot_credit11+$tot_credit12+$tot_credit15+$tot_credit16+$tot_credit_rec+$tot_credit_rec1+$tot_credit_loan_adv1+$tot_credit_loan_adv)+$tot_creditr ;    
}
 }
}



 ?>
                                        <tr>
                                            <td style="color:darkslateblue;font-weight: bold;">FINAL TOTAL</td>
                                             <td></td>
                                             <td></td>
                                               <td></td>
                                              <td id="tot_debit"><?=number_format($debt,$_SESSION['be_decimal'])?></td>
                                               <td id="tot_credit"><?=number_format($crdt,$_SESSION['be_decimal'])?></td>
                                        </tr>

<?php $sql_closebal  =  $database->mysqlQuery("select tps_dayclosedate,tps_closing_balance from tbl_ledger_setting where tps_dayclosedate='".$to."' and tps_ledger_id='".$_REQUEST['acc']."' limit 1"); 
$num_closebal   = $database->mysqlNumRows($sql_closebal);  
if($num_closebal){
  while($result_closebal  = $database->mysqlFetchArray($sql_closebal)) 
  {  ?>             
    <tr>
     <td><?=$result_closebal['tps_dayclosedate'] ?></td>
        <td colspan=5 style="font-weight:bold;text-align:left;padding-left:5px;">Closing Balance :             
        <span style="color:darkred">    <?=number_format($result_closebal['tps_closing_balance'],$_SESSION['be_decimal']) ?> <span>
        </td>
     </tr>                                     
 <?php
  }
}  
?>

                                        
                                         </tbody>  
                                     
                                    </table>
  
  
</div>
</div>
</html>                                  
</body>  

 <script type="text/javascript">
function print_page()
{
  document.getElementById("printbutton").style.display = "none";	
  window.print();
}
function close_page(){
   window.top.close();
}
</script>  
                                        <?php
      
  }








?>

