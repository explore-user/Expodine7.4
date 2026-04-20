<style>td{padding:5px;font-family:sans-serif;font-size: 14px;}
</style>
<style>
@page { size: auto;  margin: 0mm; }
.lhs_content{width: 100%;height: auto;float: left}
.rhs_content{width: 100%;height: auto;float: left}
.inner_tbody{height:100%;display:inline-block;width: 100%;}
</style>
<div style="width: 92%;height: auto;float: left;padding: 2%;border: solid 1px #ccc;margin: 2%;"  >
<?php

include('../includes/session.php');		

    include("../database.class.php");  
    $database	= new Database();
		
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  
  if(isset($_REQUEST['a4_pl']) && $_REQUEST['a4_pl']=='a4_pl_print'){
  
      
        $string='';
        $stringta='';
        $string1_str='';
        $string1_strtacshd='';
        $strings='';
        $stringsta='';
        $string_exp='';
        
	      $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND bm_credit='N' AND ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND  tab_credit='N' AND ";
        $string1_str.=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd.=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
	 
	      $strings.=" bm_status='Closed' AND ";
        $stringsta.=" tab_status='Closed' AND ";
        $string_exp_emp= " ";
        $string_exp_staff=" "; 
        $string_exp_supp="  ";
        $head_print='';
        $string_rec= " ";
        $stringdi1= " ";
			  $stringta1= "  ";
        $string_stock= " ";        
        $string_ass=" ";
        $string_supp="  ";
        $string_stock_to=" ";
        $stringr="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];                 
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			$to=date("Y-m-d");
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$_REQUEST['todt'];
		}
    else
	  {
		  $from=date("Y-m-d");
			$to=date("Y-m-d");
		 }
      
      $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_exp.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_emp.= " ev_date between '".$from."' and '".$to."' ";
      $string_exp_staff.=" ev_date between '".$from."' and '".$to."' "; 
      $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
      $head_print.=$from.' To '.$to;
      $stringdi1.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta1.= " tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_rec.= " tr_date between '".$from."' and '".$to."' ";
      $string_stock.= " tas_date = '".$from."'  ";
      $string_stock_to.= " tas_date = '".$to."'  ";
      $string_ass.=" tpd_date between '".$from."' and '".$to."' ";
      $string_supp.=" sv_date between '".$from."' and '".$to."' ";
      $stringr.=" date(tr_date) between '".$from."' and '".$to."' ";
                 
                       
              
   ?>
    <span onclick="return ref_page();" id="ref_btn" style="border-radius: 5px;float: right;cursor: pointer;padding:5px 10px;color:#fff;display: none" ><a style="color:#fff;text-decoration:none" > <img src="img/refresh.png"  > </a></span>
<span id="back_btn" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff" ><a style="color:#fff;text-decoration:none" href="load_ledger_sheet.php?redirect=redirect_account"> GO BACK </a></span>
<span id="print_btn" onclick="return print_page();" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff;margin-right:10px" > PRINT </span>


<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;padding-top: 0px;" colspan="17">
       <img width="150px" style="margin-top: -37px;" src="img/report-logo/reportlogo.png" />
    
       
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>ACCOUNTS REPORT </strong></th>
      </tr>
<tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>DATE : <?=$head_print ?></strong></th>
      </tr>
    </thead>
    </table> 

    
<?php
                        
                        
    $dine_sale=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster  where  $string "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
				
			$dine_sale =$dine_sale + $result_login['tot'];
                        
          } } 
          
          $ta_sc_hd_sale=0;
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_netamt) as tot from tbl_takeaway_billmaster where   $stringta"); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				
			$ta_sc_hd_sale =$ta_sc_hd_sale + $result_loginta['tot'];
                 
                        
                        
          } } 
          
          
          $close_val=0;
         $sql_login_loy1  =  $database->mysqlQuery("select tas_close_stock_value as close_stock  FROM tbl_account_stock where $string_stock_to "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $close_val=  $close_val+$result_login_loy1['close_stock'];
                      
                      
          }
          }   
          
          
          $total_module_sale=$dine_sale+$ta_sc_hd_sale+$close_val;
          
          
          
         $subtotalcash=0; $roundofdi=0;
          $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string order by bm_dayclosedate,bm_billtime ASC"); 
 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          
          $subtotalcashta=0;$roundofta=0;
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringta order by tab_dayclosedate,tab_time ASC"); 
   
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
          
          $subtotalcredit=0;
           $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank AND  tbl_paymentmode.pym_code='credit' and "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          
          
          $subtotalcreditta=0;
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  tbl_paymentmode.pym_code='credit' and "."$stringta group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
          
          
          
          
          $subtotalcp=0;
           $sql_logincp  =  $database->mysqlQuery("select  (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where tbl_paymentmode.pym_code='credit_person' AND "." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          
          
          
          
          $subtotalcpta=0;
           $sql_logincpta  =  $database->mysqlQuery("select (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where tbl_paymentmode.pym_code='credit_person' AND "." $stringta order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
          } }} 
          
          $totalcp=$subtotalcp+$subtotalcpta;
          
           ///tax/////
          
          $tax_di_all=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND $string  "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$tax_di_all=$tax_di_all + $result_stw['tax_di'];
			}
	  }
          
          
          
          $tax_ta_all=0;
		   $sql_stw1  =  $database->mysqlQuery("SELECT sum(te.tbe_total_value) as tax_ta FROM `tbl_takeaway_bill_extra_tax_master` te left join tbl_takeaway_billmaster tb on te.tbe_billno=tb.tab_billno WHERE tb.tab_status='Closed' AND tb.tab_complimentary!='Y' AND $stringta  "); 
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
				$tax_ta_all=$tax_ta_all + $result_stw1['tax_ta'];
			}
	  }
         
          
          
          
          
          
          
           $all_tax_show=$tax_ta_all+$tax_di_all;      
           
         $tot_excl=  $total_module_sale-$all_tax_show;
                                        ?>   
                                           
                                          
                                           <div style="width:45%;float:right;border-right:1px #ccc solid">       
            
                                            <h3  style="width:100%;float:left;font-family:sans-serif">INCOME</h3>
                                            
                                            
                                            
                                            <table style="float:left;width:100%">
                                                  <tbody> 
                                             
                                            
                                            <tr>
                                                <td style="width:50%"> Closing Stock</td>
                                                 <td style="width:50%"><?=number_format($close_val,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="width:50%"> </td>
                                                 <td style="width:50%"></td>
                                            </tr>
   <?php                         
   $indirect_income=0;
   $sql_login_loy1  =  $database->mysqlQuery("select sum(tr_amount) as amt FROM tbl_receipts where tr_acc_type='Indirect_income' and  $string_rec ");       
	 $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $indirect_income=  $indirect_income+$result_login_loy1['amt'];           
          }
          }   
   
  $return_amt=0;
  $sql_login_loy1  =  $database->mysqlQuery("select sum(tr_return_amount) as return_amt FROM tbl_return_payment where $stringr "); 
  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);

  if($num_login_loy1)
  { 
    while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
    {   
     $return_amt=  $return_amt+$result_login_loy1['return_amt'];           
    }
  }  
          
           $asset_discount=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail where tpd_type_pay='First' and  $string_ass "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $asset_discount=  $asset_discount+$result_login_loy1['amt'];
                      
                      
          }
          }   
          
          $supp_discount=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher where sv_type_pay='First' and  $string_supp "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount=  $supp_discount+$result_login_loy1['amt1'];
                      
                      
          }
          }
          
          ?>
                                             <tr>
                                                <td style="width:50%">Indirect Income</td>
                                                 <td style="width:50%"><?=number_format($indirect_income,$_SESSION['be_decimal'])?></td>
                                            </tr>

                                            <tr>
                                                <td style="width:50%">Purchase Return</td>
                                                 <td style="width:50%"><?=number_format($return_amt,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="width:50%">Asset Discount</td>
                                                 <td style="width:50%"><?=number_format($asset_discount,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                                <td style="width:50%">Supplier Discount </td>
                                                 <td style="width:50%"><?=number_format($supp_discount,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                                <td style="width:50%"> </td>
                                                 <td style="width:50%"></td>
                                            </tr>
                                            
                                            
                                             <tr >
                                                <td style="width:50%;font-weight: bold">TOTAL SALE(excl tax) </td>
                                                 <td style="width:50%;font-weight: bold"><?=number_format($tot_excl,$_SESSION['be_decimal'])?> </td>
                                            </tr>
                                            
                                            
                                            <tr style="display:none">
                                                <td style="width:50%;font-weight: bold">TAX </td>
                                                 <td style="width:50%;font-weight: bold"><?=number_format($all_tax_show,$_SESSION['be_decimal'])?> </td>
                                            </tr>
                                            
                                          <tr style="display:none">
                                                <td style="width:50%;font-weight: bold"> Sales [incl tax] </td>
                                                 <td style="width:50%;font-weight: bold"><?=number_format($total_module_sale,$_SESSION['be_decimal'])?> </td>
                                            </tr>
                                            <tr style="display:none">
                                                <td style="width:50%"> Cash Sale</td>
                                                 <td style="width:50%"><?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            <tr style="display:none">
                                                <td style="width:50%"> Bank</td>
                                                 <td style="width:50%"><?=number_format($totalcredit,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                              
                                             <tr style="display:none">
                                                <td style="width:50%"> Credit Sale</td>
                                                 <td style="width:50%"><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                           <?php 
                                           $profit_sum=0;
                                        $sql_login  =  $database->mysqlQuery("select tas_loss from tbl_account_settings "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                           $profit_sum= $result_login['tas_loss'];
                                          
                                        }}
                                        
                                        if($profit_sum>0){
                                           ?>
                                             <tr id="profit_div1" >
                                                 <td style="width:35%;font-weight: bold;">LOSS</td>
                                                 <td style="width:35%;font-weight: bold"id="profit_val_set1" ><?=number_format($profit_sum,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                        <?php } ?>
      </tbody>
           </table>
    
     <?php
            $payment_consolidated=array();
            $consolidated_final=0;
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where  $string  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where  $stringta
                                                    )x group by x.mode, x.dayclosedate order by x.dayclosedate asc "); 
          
            $num_summary  = $database->mysqlNumRows($sql_summary);
            if($num_summary){
                while($result_summary  = $database->mysqlFetchArray($sql_summary)){
                    $payment_consolidated[$result_summary['dayclosedate']][$result_summary['mode']]=$result_summary['total'];
                }
                foreach($payment_consolidated as $key=>$val){
                    $each_day_final=0;
                    ?>
  <table style="width:100%;float:left;display: none">
    <tbody>
        <tr>
            <td></td>
            <td></td>
        </tr>
                  <tr id="date_by_sale" >
                      
                      
                    <td style="width:50%"><?=$key?></td>
                   
                     <?php if(array_key_exists("DI",$val)){$each_day_final=$each_day_final+$val['DI'];$each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; } ?>
                    <?php if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA'];$each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } ?>
                    <?php if(array_key_exists("CS",$val)){$each_day_final=$each_day_final+$val['CS'];$each_module_sum['CS'][]=$val['CS'];  }else{$each_module_sum['CS'][]=0;  } ?>
                   <?php if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD'];$each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; } ?>
                    
                    <td style="width:50%"><?php $consolidated_final=$consolidated_final+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                <tr>
                    </tbody>
                    </table>
            <?php } } ?>   
                            <table style="width:100%;float:left">
    <tbody>                
    
                                                   <tr>
                                                 <td style="width:35%;font-weight: bold">TOTAL INCOME</td>
                                                 <td style="width:35%"><?=number_format($return_amt+$tot_excl+$indirect_income+$asset_discount+$supp_discount,$_SESSION['be_decimal'])?></td>
                                            </tr>
     </tbody>
                    </table>
   <?php
                                               
 
                                                          
                        
           $expense_voucher_direct=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as tot1 from tbl_expense_voucher where ev_acc_type='Direct Expense' and $string_exp "); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$expense_voucher_direct =$expense_voucher_direct + $result_logincpta['tot1'];
          } }
          
          $expense_voucher_indirect=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as tot2 from tbl_expense_voucher where ev_acc_type='Indirect Expense' and $string_exp "); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$expense_voucher_indirect =$expense_voucher_indirect + $result_logincpta['tot2'];
          } }
          
         
          $salary_direct_expense=0;
           $sql_logincpta  =  $database->mysqlQuery("select ev_net_salary_new from tbl_employee_voucher where ev_id!='' and  $string_exp_staff group by ev_month,ev_year,ev_employee_id "); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$salary_direct_expense =$salary_direct_expense + $result_logincpta['ev_net_salary_new'];
          } }
          
          
          
           $supplier_indirect_expense=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Normal' and  $string_exp_supp "); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$supplier_indirect_expense =$supplier_indirect_expense + $result_logincpta['tot4'];
          } }
          
          
          $supplier_indirect_expense4=0;
           $sql_logincpta4  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot5 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp "); 
	  $num_logincpta4   = $database->mysqlNumRows($sql_logincpta4);
	  if($num_logincpta4){
		  while($result_logincpta4  = $database->mysqlFetchArray($sql_logincpta4)) 
			{ 
			
			$supplier_indirect_expense4 =$supplier_indirect_expense4 + $result_logincpta4['tot5'];
          } }
                                                
           $payment_consolidated=array();
            $consolidated_final_comp=0;
            
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary='Y' and $stringdi1  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary='Y' and $stringta1
                                                    )x group by x.mode, x.dayclosedate order by x.dayclosedate asc "); 
            
           
            $num_summary  = $database->mysqlNumRows($sql_summary);
            if($num_summary){
                while($result_summary  = $database->mysqlFetchArray($sql_summary)){
                    $payment_consolidated[$result_summary['dayclosedate']][$result_summary['mode']]=$result_summary['total'];
                }
                foreach($payment_consolidated as $key=>$val){
                    $each_day_final=0;
                    
               
                   
                  if(array_key_exists("DI",$val)){ $each_day_final=$each_day_final+$val['DI']; $each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; }
                  if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA']; $each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } 
                    if(array_key_exists("CS",$val)){ $each_day_final=$each_day_final+$val['CS']; $each_module_sum['CS'][]=$val['CS'];  }else{ $each_module_sum['CS'][]=0;  }
                  if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD']; $each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; } 
           
                  
                  $consolidated_final_comp=$consolidated_final_comp+$each_day_final;
                  }}
                  
                  
                  $open_val=0;
         $sql_login_loy1  =  $database->mysqlQuery("select tas_open_stock_value as open_stock  FROM tbl_account_stock where $string_stock "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $open_val=  $open_val+$result_login_loy1['open_stock'];
                      
                      
          }
          }   
                  
                  
                  
          
          $direct_exp_total=$supplier_indirect_expense4+$salary_direct_expense+$expense_voucher_direct+$supplier_indirect_expense;
          
          
          $tot_all_expense=$direct_exp_total+$expense_voucher_indirect+$consolidated_final_comp+$open_val;
                                        ?>   
   </div>        

<div style="width:45%;float:left">     
<h3  style="width:100%;float:left;font-family:sans-serif">EXPENSE</h3>                                  
    <table style="float: right;width:100%">
    <tbody>
        
        
         <tr>
                                                 <td style="width:35%;font-weight: bold"> Opening Stock </td>
                                                 <td style="width:35%"><?=number_format($open_val,$_SESSION['be_decimal'])?></td>
                                            </tr>
        
                                            <tr>
                                                <td style="width:35%;font-weight: bold"> Direct Expense</td>
                                                <td style="width:35%"><?=number_format($direct_exp_total,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                            
                                            <tr id="employee_section">
                                                <td style="width:35%">Employee Vouchers </td>
                                                <td style="width:35%"><?=number_format($salary_direct_expense,$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                                
                                                
                                             <tr  id="employee_section1">    
                                                 <td style="width:35%">Expense Vouchers  </td>
                                                <td style="width:35%"><?=number_format($expense_voucher_direct,$_SESSION['be_decimal'])?></td>
                                             </tr>
                                            
                                             <tr  id="supplier_section">
                                                  <td style="width:35%">Supplier Vouchers  </td>
                                                <td style="width:35%"><?=number_format(($supplier_indirect_expense+$supplier_indirect_expense4),$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                            
                                            <tr>
                                                <td style="width:35%">  </td>
                                                <td style="width:35%"></td>
                                            </tr>
                                            
                                           
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"> Indirect Expense</td>
                                                 <td style="width:35%"><?=number_format($expense_voucher_indirect+$consolidated_final_comp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                 <td style="width:35%">Indirect </td>
                                                 <td style="width:35%"><?=number_format($expense_voucher_indirect,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                 <td style="width:35%">Complimentary Sale</td>
                                                 <td style="width:35%"><?=number_format($consolidated_final_comp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                <td style="width:35%">  </td>
                                                <td style="width:35%"></td>
                                            </tr>
                                            <?php
                                            $loss_chk=0;
          $sql_loginta  =  $database->mysqlQuery("select tas_profit from tbl_account_settings"); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				
			$loss_chk =$result_loginta['tas_profit'];
                      
          } } 
          ?>
                    <tr>
                                                 <td style="width:35%;font-weight: bold">PROFIT</td>
                                                 <td style="width:35%"><?=number_format($loss_chk,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                                                    
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"> TOTAL EXPENSE </td>
                                                 <td style="width:35%"><?=number_format($tot_all_expense,$_SESSION['be_decimal'])?></td>
                                            </tr>  
                                                    
                             
    </tbody>                 
</table>
              </div>                                   
        <?php                                      

  }
  
  
   else if(isset($_REQUEST['a4_bl']) && $_REQUEST['a4_bl']=='a4_bl_print'){
  
      
     $string='';
     $head_print='';
     $string_exp_supp=" ";
     $stringast='';
     $stringdi='';
     $stringta='';
     $stringdi .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
     $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND ";    
     $string_close="  ";
     $string_crd_new="  ";
     $string_sup1="  ";
     $string_crd_new1='';
     $stringr='';

                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");                                
                        }
                        
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];                               
                        }
                        else
	                      {
		                        $from=date("Y-m-d");
			                      $to=date("Y-m-d");
                        }

			                  $string.= " cv_date  between '".$from."' and '".$to."' ";
                        $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
                        $head_print.=$from.' To '.$to;
			                  $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringast.=" tpd_date between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_close.=" tas_date =  '".$to."' ";
                        $string_crd_new.=" cd_dayclosedate between '".$from."' and '".$to."' ";
                        $string_sup1.=" sv_date between '".$from."' and '".$to."' ";
                        $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                        $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$to."' "; 
          
   ?>
<span onclick="return ref_page();" id="ref_btn" style="border-radius: 5px;float: right;cursor: pointer;padding:5px 10px;color:#fff;display: none" ><a style="color:#fff;text-decoration:none" > <img src="img/refresh.png"  > </a></span>
<span id="back_btn" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff" ><a style="color:#fff;text-decoration:none" href="load_ledger_sheet.php"> GO BACK </a></span>
<span id="print_btn" onclick="return print_page();" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff;margin-right:10px" > PRINT </span>


<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
    <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;padding-top: 0px;" colspan="17">
      <img width="150px" style="margin-top: -37px;" src="img/report-logo/reportlogo.png" />        
    </tr>
    <tr>
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>ACCOUNTS REPORT </strong></th>
    </tr>
    <tr>
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>DATE : <?=$head_print ?></strong></th>
    </tr>
    </thead>
</table> 

  <?php
    $contra_sum=0;
    $sql_login  =  $database->mysqlQuery("select sum(cv_amount) as tot from tbl_contra_voucher where cv_id!='' and $string "); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){
			while($result_login  = $database->mysqlFetchArray($sql_login)) 
				{ 
          //$contra_sum=$contra_sum+ $result_login['tot'];
        } } 
                                         
                                         
    $totalcp=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(cd_amount) as tot from tbl_credit_details  where cd_settled='N' and $string_crd_new"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			  $totalcp =$totalcp + $result_logincpta['tot'];
      }} 
                                  
                                            
    $asst_tot=0;
    $fnct_menu = $database->mysqlQuery("select distinct(tpd_invoice),tpd_vendor,tpd_netamount  from tbl_asset_purchase_invoice_detail where tpd_id!='' and $stringast group by tpd_invoice,tpd_vendor  ");
    $num_fdtl = $database->mysqlNumRows($fnct_menu);
    if($num_fdtl > 0) {
        while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
        {
            $asst_tot =$asst_tot + $result_fnctvenue['tpd_netamount'];   
        }}                  
                                                                        
               
      $close_stock=0;
      $fnct_menu6 = $database->mysqlQuery("select sum(tas_close_stock_value) as total_asset_bill  from tbl_account_stock where tas_id!='' and $string_close  ");
      $num_fdtl6 = $database->mysqlNumRows($fnct_menu6);
      if($num_fdtl6 > 0) {
          while ($result_fnctvenue6 = $database->mysqlFetchArray($fnct_menu6))
          {
            $close_stock =$close_stock + $result_fnctvenue6['total_asset_bill'];   
        }}

        $total_asset_all=$asst_tot+$totalcp+$contra_sum+$close_stock;
             ?>   
                                           
                                          
                                           <div class="rhs_content" style="width:45%;float:right;border-right:1px #ccc solid">       
            
                                            <h3  style="width:100%;float:left;font-family:sans-serif">ASSET </h3>
                                            
                                            
                                            
                                            
                                            <table style="float:left;width:100%">
                                                  <tbody class="inner_tbody"> 
                                                      
                                                      
                                                      <tr style="display:none">
                                                <td style="width:50%">Cash and Bank </td>
                                                 <td style="width:50%"><?=number_format($contra_sum,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                 <td style="width:35%;">Fixed Asset </td>
                                                 <td style="width:35%"><?=number_format($asst_tot,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;font-weight: bold">Current Asset </td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                        
                                            
                                             <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>                                                                               
      <?php                                          
      $stringy='';
      $string1y='';
      $string2y='';
      $string3y='';
      $string_rec='';
      $string_adv_loan='';
      $string_asy='';	
      $string_con5y='';
      $string_crd_new1='';


       
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
      $from = $_REQUEST['fromdt'];
      $to = $_REQUEST['todt'];
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
      $from = $_REQUEST['fromdt'];
			$to=date("Y-m-d");
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to = $_REQUEST['todt'];
		}else
	  {
		  $from=date("Y-m-d");
			$to=date("Y-m-d");
     }                    
                        
        $stringy.= " and ts.sv_date between '".$from."' and '".$to."' ";
        $string1y.= " and ts.ev_date between '".$from."' and '".$to."' ";
        $string2y.= " and  date(tes.tes_entrydate) between '".$from."' and '".$to."' ";
        $string3y.= " and tes.ev_date between '".$from."' and '".$to."' ";
        $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
        $string_asy.= " and tpd_date  between '".$from."' and '".$to."' ";
        $string_con5y.= " and cv_date  between '".$from."' and '".$to."' ";
        $string_rec.= " and tr_date  between '".$from."' and '".$to."' ";   
        $string_adv_loan.= "  tla_date  between '".$from."' and '".$to."' "; 
 

	              
      //-------- - loan given- amount from bank account----------------------------------//                              
      $loan_advance_bank=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tlm_type='Bank_account' and    $string_adv_loan  "); 
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
      if($num_logincpta34){
        while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
        { 
        $loan_advance_bank =$loan_advance_bank + $result_logincpta34['netamt'];            
        } 
      }           
            
         //-------- - loan given- amount from cash account----------------------------------//           
      $loan_advance_cash=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tlm_type='Cash_account' and    $string_adv_loan  "); 
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
      if($num_logincpta34){
        while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
        { 
        $loan_advance_cash =$loan_advance_cash + $result_logincpta34['netamt'];           
        } 
      }           
                       
                       
    //-------- - loan return- amount from cash account----------------------------------//                   
    $cash_loan_return=0;
    $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tlm_type='Cash_account' and tla_type='Loan' and  $string_adv_loan"); 
      $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
      if($num_loginta9){
        while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
        { 
        $cash_loan_return =$cash_loan_return+$result_loginta15['paid'];                     
        } 
      } 
      
      
          //--------paid - loan - amount from bank account----------------------------------//       
    $bank_loan_return=0;
    $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tlm_type='Bank_account' and  tla_type='Loan' and  $string_adv_loan"); 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 	
			$bank_loan_return =$bank_loan_return+$result_loginta15['paid'];                    
      } 
    } 
                                 
                       
               
       //---Asset purchase -------discount -------------cash account---------------------// 
       $asset_discount_cash=0;
       $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master on tpd_from_acc=tlm_id  where tlm_type='Cash_account' and tpd_type_pay='First'   $string_asy "); 
       $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
       if($num_login_loy1){    
         while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
         {   
           $asset_discount_cash=  $asset_discount_cash+$result_login_loy1['amt'];           
         }
         }     
          
      //---Asset purchase -------discount -------------bank account---------------------//       
      $asset_discount_bank=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tlm_type='Bank_account' and tpd_type_pay='First'   $string_asy "); 
      $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
      if($num_login_loy1){ 
        while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
        {   		 
          $asset_discount_bank=  $asset_discount_bank+$result_login_loy1['amt'];           
        }
        }   
          
          
     //---Supplier voucher -------discount -------------cash account---------------------//        
     $supp_discount_cash=0;
     $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id where tm.tlm_type='Cash_account' and ts.sv_type_pay='First'   $stringy ");  
     $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
     if($num_login_loy1){         
       while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
       {   
        $supp_discount_cash=  $supp_discount_cash+$result_login_loy1['amt1'];          
       }
        }
          
          
    //---Supplier voucher -------discount -------------bank account---------------------//         
    $supp_discount_bank=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $stringy "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
      }
      }  
          
          
          
          
     ////--------------cash sale----------------------------------------------- ////
        
    $dine_sale_cash=0;                 
    $sql_login  =  $database->mysqlQuery("select (sum(bm_amountpaid) - (sum(bm_amountbalace) )) as tot FROM tbl_tablebillmaster  where bm_paymode='1' and   $stringdi "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){        
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   				
			$dine_sale_cash =$dine_sale_cash + $result_login['tot'];                       
          } } 
          
    $ta_sc_hd_sale_cash=0;
    $sql_loginta  =  $database->mysqlQuery("select (sum(tab_amountpaid) - (sum(tab_amountbalace)))  as tot from tbl_takeaway_billmaster where tab_paymode='1' and  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 				
			$ta_sc_hd_sale_cash =$ta_sc_hd_sale_cash + $result_loginta['tot'];                    
          } } 
          
    $total_module_sale_cash=$dine_sale_cash+$ta_sc_hd_sale_cash;
          

    ///-------cash_credit-------------//
    $credit_cash=0;
    $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_cash =$credit_cash + $result_logincpta['tot'];
      }} 



      $supplier_return_cash=0;    
        $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr from tbl_return_payment tp left join tbl_ledger_master tm on tm.tlm_id=tp.tr_to_acc     where tm.tlm_type='Cash_account'  $stringr  "); 
        $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
        if($num_logincpta1){
          while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
          { 
          $supplier_return_cash =$supplier_return_cash + $result_logincpta1['totr'];
              } }   
              
        $supplier_return_bank=0;     
        $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr1 from tbl_return_payment tp left join tbl_ledger_master tm on tm.tlm_id=tp.tr_to_acc     where tm.tlm_type='Bank_account'  $stringr  "); 
        $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
        if($num_logincpta1){
          while($result_logincpta19  = $database->mysqlFetchArray($sql_logincpta1)) 
          { 
          $supplier_return_bank =$supplier_return_bank + $result_logincpta19['totr1'];
          } } 
          

    /////////----------------------All in cash account-----------------------------------//                          
     $all_in_cash1=0;

    $fnct_menu3 = $database->mysqlQuery("select tlm_id,tlm_ledger_name  from tbl_ledger_master where tlm_type='Cash_account'  ");
    $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
    if ($num_fdtl3 > 0) {
        while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
        {
         $string678='';
        if($_REQUEST['fromdt']!="")
		      { 
	          $string678.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";                       
		      }
          else
          {
            $from=date("Y-m-d");
            $string678.= "   tps_dayclosedate = '".$from."'  ";
          }
                              
      $yes_open=0;
                                    
    $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login)
    {
      $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string678 and tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
             $yes_open=  $result_login['tps_ledger_open_bal'];
          }} 
    }
    else
    {
      $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$result_fnctvenue3['tlm_id']."'  "); 
			$num_login   = $database->mysqlNumRows($sql_login);
			if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $yes_open=  $result_login['tlm_open_bal'];
          }} 
    }
                  

    //---Receipts -------to -------------cash account---------------------// 
    $cash_receipt_to=0;
    $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr where tr.tr_to='".$result_fnctvenue3['tlm_id']."' $string_rec "); 
    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
    if($num_logincpta34){
       while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
        { 		
       $cash_receipt_to =$cash_receipt_to + $result_logincpta34['netamt12'];           
       } 
    }            
     
    
        //---Receipts -------from -------------cash account---------------------// 
        $cash_receipt_from = 0;
        $sql_receipt_from  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr where tr.tr_from='".$result_fnctvenue3['tlm_id']."' $string_rec "); 
        $num_receipt   = $database->mysqlNumRows($sql_receipt_from);
        if($num_receipt){
          while($result_receipt= $database->mysqlFetchArray($sql_receipt_from)) 
          { 
            $cash_receipt_from =$cash_receipt_from + $result_receipt['netamt12'];
          } 
        } 
       
      
     //----contra voucher to account-------------------------//   
    $cash_contra_to=0;    
    $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	  $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
           while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          $cash_contra_to=$cash_contra_to+$result_login5['cv_amount'];
          }}   
                  
    //----contra voucher from account-------------------------//               
    $cash_contra_from=0;    
    $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	  $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
           while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $cash_contra_from=$cash_contra_from+$result_login['cv_amount'];                 
           }}
                  
                  
    //--asset purchase --paid amount----------------//              
    $tot_supplier_asset=0;
    $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_asy "); 
    $num_login454   = $database->mysqlNumRows($sql_login454);
		if($num_login454){
    while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
          }}
              
                                        
                                        
    //--supplier voucher --paid amount----------------//                                        
    $tot_supplier=0;
    $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."' $stringy "); 
    $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
	  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	  { 
    $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
    }}    
                                        
                                        
    //--employee voucher --paid amount----------------//                                     
    $tot_employee=0; 
    $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1y "); 
    $num_login5   = $database->mysqlNumRows($sql_login5);
		if($num_login5){
      while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
          }}
                                        
                       
    
      //----expense voucher ------direct expense-------------------------//
      $tot_direct=0; 
      $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3y "); 
      $num_login78   = $database->mysqlNumRows($sql_login78);
      if($num_login78){
      while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
            { 
            $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
            }}        
                                        
                
     //----expense voucher ------indirect expense-------------------------//                
     $tot_indirect=0; 
     $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3y"); 
     $num_login79   = $database->mysqlNumRows($sql_login79);
     if($num_login79){
        while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
         {         
          $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         }}
                                        
        $all_in_cash=$yes_open-($tot_supplier+$cash_contra_from+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect+$cash_receipt_from)+($cash_contra_to+$cash_receipt_to); 
        $all_in_cash1=$all_in_cash1+$all_in_cash;
        
        
        
        ?>
              
                                          
            <tr>
            <td style="width:35%;"><?=$result_fnctvenue3['tlm_ledger_name']?> </td>
            <td style="width:35%"><?=number_format(($supplier_return_cash+$credit_cash+$all_in_cash1+$cash_loan_return+$total_module_sale_cash)-($loan_advance_cash),$_SESSION['be_decimal'])?>
            </td>
            </tr>  <?php }} ?>
                                            
            <tr>
            <td style="width:35%;font-weight: bold">Cash Account</td>
            <td style="width:35%"><?=number_format(($supplier_return_cash+$credit_cash+$all_in_cash1+$cash_loan_return+$total_module_sale_cash)-($loan_advance_cash),$_SESSION['be_decimal'])?></td>
            </tr>

            <tr>
                 <td style="width:35%;font-weight: bold"></td>
                 <td style="width:35%"></td>
            </tr>
                                            
             <?php  
             
  //            $bank_receipt_all=0;
  //          $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tm.tlm_type='Bank_account'   $string_rec  "); 
	// // echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
  //          $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	//   if($num_logincpta34){
	// 	  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
	// 		{ 
			
	// 		$bank_receipt_all =$bank_receipt_all + $result_logincpta34['netamt'];
                        
                        
  //         } }       
             
    
   /////------------bank sale--------------------------------////
    
    $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster  where  bm_paymode='2' and   $stringdi "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
    {
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   			
			$dine_sale_card =$dine_sale_card + $result_login['tot'];                       
      } } 
          
    $ta_sc_hd_sale_card=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster  where  tab_paymode='2' and  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];            
      } } 
          
      $total_module_sale_card=$dine_sale_card+$ta_sc_hd_sale_card;
          
          
    $credit_card=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment  where  $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_card =$credit_card + $result_logincpta['tot'];
      }}  
      

                  
          
          
//////////----------------all in bank-----------------------------------------//                                           
                                            
    $all_in_bank1=0;

    $fnct_menu33 = $database->mysqlQuery("select tlm_id,tlm_ledger_name  from tbl_ledger_master where tlm_type='Bank_account'");
    $num_fdtl33 = $database->mysqlNumRows($fnct_menu33);
  
    if($num_fdtl33 > 0) {
        while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu33))
        {
          $string678='';
        if($_REQUEST['fromdt']!="")
		    { 
	          $string678.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";                       
		    }else{
            $from=date("Y-m-d");
            $string678.= "   tps_dayclosedate = '".$from."'  ";
            }                
                
    $yes_open1=0;
                                    
    $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login)
    {
      $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string678 and tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
			$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $yes_open1=  $result_login['tps_ledger_open_bal'];
          }} 
    }
    else
    {
      $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$result_fnctvenue3['tlm_id']."'  "); 
			$num_login   = $database->mysqlNumRows($sql_login);
			if($num_login){
				while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $yes_open1=  $result_login['tlm_open_bal'];
          }} 
    }
                  

        //-----------Receipt voucher---to ---bank-----------// 
        $bank_receipt_to=0;
        $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr where tr.tr_to='".$result_fnctvenue3['tlm_id']."'   $string_rec  "); 
        $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
        if($num_logincpta34){
           while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
           { 	
           $bank_receipt_to =$bank_receipt_to + $result_logincpta34['netamt'];           
           } 
        } 
         
             //-----------Receipt voucher---from ---bank-----------// 
        $bank_receipt_from=0;
        $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr where tr.tr_from='".$result_fnctvenue3['tlm_id']."'  $string_rec  "); 
        $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
        if($num_logincpta34){
        while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
         { 	
         $bank_receipt_from =$bank_receipt_from + $result_logincpta34['netamt'];           
         } 
       }       
                  
             //-----------contra voucher---to ---bank-----------//
          $bank_contra_to=0;    
          $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	        $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
          while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          $bank_contra_to=$bank_contra_to+$result_login5['cv_amount'];
          }}   

         //-----------contra voucher---from ---bank-----------//
          $bank_contra_from=0;    
          $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	        $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
            while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{        
          $bank_contra_from=$bank_contra_from+$result_login['cv_amount'];
          }}
            
      
                  
         //-ASSET PURCHASE--- PAID----------//
         $tot_supplier_asset=0;
         $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_asy "); 
         $num_login454   = $database->mysqlNumRows($sql_login454);
         if($num_login454){                                
         while($result_login  = $database->mysqlFetchArray($sql_login454)) 
         { 
         $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
         }}
          

                                        
                  //----SUPLLIER VOUCHER----------PAID--------------//                              
          $tot_supplier=0;
          $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $stringy "); 
	        $num_login   = $database->mysqlNumRows($sql_login);
          
					if($num_login){                                 
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{         
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
          }}     
            
                //---EMPLOYEE VOUCHER----PAID-------------------------//
          $tot_employee=0; 
          $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1y "); 
          $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){                               
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
           }}
                                        
                       
                  //----EXPENSE VOUCHER ------  DIRECT EXPENSE---------//
          $tot_direct=0; 
          $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3y "); 
          $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){                                     
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
          }}        
                            
                //----EXPENSE VOUCHER ------ INDIRECT EXPENSE---------//      
                           
          $tot_indirect=0; 
          $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3y"); 
          $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){                                            
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
          $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
          }} 
          
      

          $supplier_return=0;     
          $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr1 from tbl_return_payment tp where tr_to_acc='".$result_fnctvenue3['tlm_id']."'   $stringr  "); 
          $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
          if($num_logincpta1){
            while($result_logincpta19  = $database->mysqlFetchArray($sql_logincpta1)) 
            { 
            $supplier_return =$supplier_return + $result_logincpta19['totr1'];
            } } 
             

                                        
          $all_in_bank=$yes_open1-($tot_supplier+$bank_contra_from+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect+$bank_receipt_from)+($supplier_return+$bank_contra_to+$bank_receipt_to);

          $all_in_bank1=$all_in_bank1+$all_in_bank;
          

                  ?>
              
                  <tr>
                    <td style="width:35%;"><?=$result_fnctvenue3['tlm_ledger_name']?> </td>
                    <td style="width:35%"><?=number_format(($credit_card+$total_module_sale_card+$all_in_bank+$bank_loan_return)-($loan_advance_bank),$_SESSION['be_decimal'])?>
                    </td>
                  </tr>
                       <?php }} ?>
                  <tr>
                       <td style="width:35%;font-weight: bold">Bank</td>
                       <td style="width:35%"><?=number_format(($credit_card+$total_module_sale_card+$all_in_bank1+$bank_loan_return)-($loan_advance_bank),$_SESSION['be_decimal'])?></td>
                  </tr>
                  <tr>
                       <td style="width:35%;font-weight: bold"></td>
                       <td style="width:35%"></td>
                  </tr>
                                            
                                            
                                             <?php
                                        
          
          
          
          $loan_adv=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_amount) as tot from tbl_loan_advance where   $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta1  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_adv =$loan_adv+$result_loginta1['tot'];
                      
          } } 
          
          
           $loan_adv_minus=0;
          $adv_minus=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance where tla_type='Advance' and $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$adv_minus =$adv_minus+$result_loginta15['paid'];
                      
          } } 
          
          
          $loan_minus=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance where tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus =$loan_minus+$result_loginta15['paid'];
                      
          } } 
          
          
          $loan_adv_minus=($loan_minus+$adv_minus);
                                        
                                        ?>
                                            
                                             
                                            
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;">Loans & Advances </td>
                                                 <td style="width:35%"><?=number_format($loan_adv-$loan_adv_minus,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;">Sundry Debtors</td>
                                                 <td style="width:35%"><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                 <td style="width:35%;">Closing Stock  </td>
                                                 <td style="width:35%"><?=number_format($close_stock,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <?php
                                       $profit_sum=0;
                                        $sql_login  =  $database->mysqlQuery("select tas_loss from tbl_account_settings "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                           $profit_sum= $result_login['tas_loss'];
                                          
                                        }}
                                        
                                        
                                        
                                        
                                        $all_prof_chk_in=($credit_cash+$credit_card+$total_asset_all+$profit_sum+$all_in_cash1+$all_in_bank1+$total_module_sale_cash+$total_module_sale_card);
                                        
                                        if($profit_sum>0){
                                        ?>   
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            <tr  >
                                                 <td style="width:35%;font-weight: bold">LOSS</td>
                                                 <td style="width:35%;font-weight: bold" ><?=number_format($profit_sum,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            </tbody>
                                       <?php 
                                              
                                            } 
                                       ?>   
                                       <tfoot>
                                            <tr>
                                                 <td style="width:35%;font-weight: bold">TOTAL ASSET</td>
                                                 <td style="width:35%"><?=number_format($all_prof_chk_in,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            </tfoot>  
                                            
                                            
                                            
                                     
                                    </table>
    
    
    
    
   <?php
   
   
    $string='';
   $string_exp_supp2='';
    $string_asset_liab='';
    $string_emp_liab='';
    $string_rec=" ";
    
    $stringta='';
    $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND ";
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                
                                $string_exp_supp2.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                               
                                $string_exp_supp2.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                
                                $string_exp_supp2.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                         else
	               {
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
			$string_exp_supp2.=" sv_date between '".$from."' and '".$to."' ";
                        $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                        
                         $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                        
                        $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                        
                         $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
	               }
   
                                               
 $supplier_indirect_expense=0;
           $sql_logincpta  =  $database->mysqlQuery("select distinct(sv_invoice_no),sv_vendor_id, sv_invoice_amount as tot4 from tbl_supplier_voucher where sv_entry_type ='Credit' and  $string_exp_supp group by sv_invoice_no,sv_vendor_id"); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$supplier_indirect_expense =$supplier_indirect_expense + $result_logincpta['tot4'];
          } }   
                                                          
                 $supplier_indirect_expense1=0;
           $sql_logincpta1  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot41 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp2 "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	  if($num_logincpta1){
		  while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 
			
			$supplier_indirect_expense1 =$supplier_indirect_expense1 + $result_logincpta1['tot41'];
          } }   
          
          
          $tot_supply_pay=$supplier_indirect_expense-$supplier_indirect_expense1;       
           
               
          $asset_liab=0;
           $sql_logincpta3  =  $database->mysqlQuery("select distinct(tpd_invoice),tpd_vendor,tpd_netamount as netamt from tbl_asset_purchase_invoice_detail where tpd_id !='' and  $string_asset_liab group by tpd_invoice,tpd_vendor"); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta3   = $database->mysqlNumRows($sql_logincpta3);
	  if($num_logincpta3){
		  while($result_logincpta3 = $database->mysqlFetchArray($sql_logincpta3)) 
			{ 
			
			$asset_liab =$asset_liab + $result_logincpta3['netamt'];
                       
                        
          } }   
          
          $asset_liab1=0;
           $sql_logincpta3  =  $database->mysqlQuery("select sum(tpd_paid_amount) as paid from tbl_asset_purchase_invoice_detail where tpd_id !='' and  $string_asset_liab "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta3   = $database->mysqlNumRows($sql_logincpta3);
	  if($num_logincpta3){
		  while($result_logincpta3 = $database->mysqlFetchArray($sql_logincpta3)) 
			{ 
			
			
                        $asset_liab1 =$asset_liab1 + $result_logincpta3['paid'];
                        
          } }   
          
          $asset_liab_all=$asset_liab-$asset_liab1;
          
          $todate = $_REQUEST['todt'];
          $month = date('m', strtotime($todate));
          $year = date('Y', strtotime($todate));
      
          $salry_net=0;
          $sql_logincpta34  =  $database->mysqlQuery("SELECT sum(tes_netsalary) as net from tbl_employee_salary WHERE tes_month<=$month and tes_year<=$year"); 
          $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
          if($num_logincpta34){
            while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
            { 
                $salry_net =$salry_net + $result_logincpta34['net'];
            } }   
             
            $salry_paid=0;
            $sql_logincpta34  =  $database->mysqlQuery("SELECT sum(ev_amount) as paid from tbl_employee_voucher WHERE ev_month<=$month and ev_year<=$year"); 
            $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
            if($num_logincpta34){
              while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
              { 
                  $salry_paid =$salry_paid + $result_logincpta34['paid'];
              } }  
      
      
              $salry_liab_all=$salry_net-$salry_paid; 
          
          $capital_acc=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tlm_open_bal) as netamt from tbl_ledger_master where tlm_type='Capital'  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$capital_acc =$capital_acc + $result_logincpta34['netamt'];
                        
                        
          } }   
          
          
          
          $tax_di_all=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND $string  "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$tax_di_all=$tax_di_all + $result_stw['tax_di'];
			}
	  }
          
          
          
          $tax_ta_all=0;
		   $sql_stw1  =  $database->mysqlQuery("SELECT sum(te.tbe_total_value) as tax_ta FROM `tbl_takeaway_bill_extra_tax_master` te left join tbl_takeaway_billmaster tb on te.tbe_billno=tb.tab_billno WHERE tb.tab_status='Closed' AND tb.tab_complimentary!='Y' AND $stringta  "); 
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
				$tax_ta_all=$tax_ta_all + $result_stw1['tax_ta'];
			}
	  }
         
          
          
          
          
          
          
           $tax_amt=$tax_ta_all+$tax_di_all; 
          
          
          
                                        ?>   
   </div>        

<div class="lhs_content" style="width:45%;float:left">     
<h3  style="width:100%;float:left;font-family:sans-serif">LIABILITIES</h3>                                  
    <table style="float: right;width:100%">
    <tbody class="inner_tbody">
        
        
        
                                                   <tr>
                                                <td style="width:35%;font-weight: bold">Capital</td>
                                                 <td style="width:35%"><?=number_format($capital_acc,$_SESSION['be_decimal'])?></td>
                                            </tr>
        
                                            
                                             <?php   
                                             $sql_logincpta34  =  $database->mysqlQuery("select tlm_open_bal,tlm_ledger_name  from tbl_ledger_master where tlm_type='Capital' "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			?>
                                        <tr>         
                               <td style="width:35%;"><?=$result_logincpta34['tlm_ledger_name']?></td>
                                <td style="width:35%;" ><?=number_format($result_logincpta34['tlm_open_bal'],$_SESSION['be_decimal'])?></td>         
                                        
                                        </tr>       
                                        <?php
                        
                        
          } }   
          ?>
                                            
                                            
                                        <tr>
                                                <td style="width:35%"> </td>
                                                 <td style="width:35%"> </td>
                                            </tr>      
                                            
                                            
        
                                            <tr>
                                                <td style="width:35%;font-weight: bold">Current Liabilities </td>
                                                 <td style="width:35%"> </td>
                                            </tr>
                                            
                                            
                                              <tr>
                                                <td style="width:35%">Tax</td>
                                                 <td style="width:35%">     <?=number_format($tax_amt,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                                <td style="width:35%">Sundry Creditors</td>
                                                 <td style="width:35%">     <?=number_format($tot_supply_pay,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td style="width:35%">Asset Liability</td>
                                                 <td style="width:35%"><?=number_format($asset_liab_all,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                             <tr>
                                                <td style="width:35%">Salary Outstanding</td>
                                                 <td style="width:35%"><?=number_format($salry_liab_all,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                          
                                            
                                         <tr>
                                                <td style="width:35%"> </td>
                                                 <td style="width:35%"> </td>
                                            </tr>      
                      
                                        
                                        
                                        <?php      
                                       $loan=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts where tr_acc_type='Loan' and  $string_rec "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan =$loan + $result_logincpta34['netamt'];
                        
                        
          } }         
                 
          
          
           $invest=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt1 from tbl_receipts where tr_acc_type='Investment' and  $string_rec "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$invest =$invest + $result_logincpta34['netamt1'];
                        
                        
          } }         
          
          
            ?>                             <tr>
                                                <td style="width:35%;font-weight: bold">Non Current Liabilities </td>
                                                 <td style="width:35%"> </td>
                                            </tr>     
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            
                                            
                                            
                                            <tr>
                                                <td style="width:35%">Loans</td>
                                                 <td style="width:35%"><?=number_format($loan,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td style="width:35%">Investment</td>
                                                 <td style="width:35%"><?=number_format($invest,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <?php
                                       $loss_sum=0;
                                        $sql_login  =  $database->mysqlQuery("select tas_profit from tbl_account_settings "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                           $loss_sum= $result_login['tas_profit'];
                                          
                                        }}
                                        
                                        
                                        $all_liab_in=$tot_supply_pay+$loss_sum+$asset_liab_all+$salry_liab_all+$capital_acc+$loan+$invest+$tax_amt;
                                        
                                        if($loss_sum>0){
                                        ?>   
                                           <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            <tr>
                                                 <td style="width:35%">PROFIT</td>
                                                 <td style="width:35%" ><?=$loss_sum?></td>
                                            </tr>
                                            
                                            </tbody> 
                                            <?php 
                                              
                                         } 
                                        ?>            
                                            <tfoot>
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"> TOTAL LIABILITIES </td>
                                                 <td style="width:35%"><?=number_format($all_liab_in,$_SESSION['be_decimal'])?></td>
                                            </tr>  
                                            </tfoot>
                                            
                                            
                                              
                             
                   
</table>
              </div>                                   
        <?php                                      

  }
  ?>
<script src="js/jquery-1.11.1.min.js"></script>

<script>
var maxHeight = 0;
$('.inner_tbody').each(function() {
    maxHeight = Math.max(maxHeight, $(this).height());
});
$('.lhs_content .inner_tbody, .rhs_content .inner_tbody').css({height:maxHeight + 'px'});
</script>
    
     <script type="text/javascript">
function print_page()
{
    document.getElementById("back_btn").style.display = "none";	
    document.getElementById("print_btn").style.display = "none";
    document.getElementById("ref_btn").style.display = "block";
 
 
  window.print();
}

function ref_page()
{
    document.getElementById("back_btn").style.display = "block";	
    document.getElementById("print_btn").style.display = "block";
    document.getElementById("ref_btn").style.display = "none";
 
 
 
}
</script>  

</div>