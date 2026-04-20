
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
  
        $rt='';
        $string='';
        $stringta='';
        $string1_str='';
        $string1_strtacshd='';
        $strings='';
        $stringsta='';
        $string_exp='';
        
	      $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND bm_credit='N' AND  ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'   AND tab_credit='N' AND  ";
       
        
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
                        
             $string_stock_cls=" ";           
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
      $string_stock.= " tas_date = '".$from."' ";
      $string_stock_cls.= " tas_date = '".$to."' ";
      $string_ass.=" tpd_date between '".$from."' and '".$to."' ";
      $string_supp.=" sv_date between '".$from."' and '".$to."' ";
      $rt.= " '".$from."' to '".$to."' ";
	           
                
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
  $sql_login_loy1  =  $database->mysqlQuery("select sum(tas_close_stock_value) as close_stock  FROM tbl_account_stock where $string_stock_cls "); 
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
         
         
                    
    $data=array();
    $data1=array();
                     
                    
                    
                    $data['Income']="Closing Stock  ";
                    $data['Value']=number_format($close_val,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
         
                        
                    
     $indirect_income=0;
     $sql_login_loy1  =  $database->mysqlQuery("select sum(tr_amount) as amt FROM tbl_receipts where tr_acc_type='Indirect_income' and  $string_rec "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){          
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $indirect_income=  $indirect_income+$result_login_loy1['amt'];           
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
                    
                    $data['Income']="Indirect Income ";
                    $data['Value']=number_format($indirect_income,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
          
                    $data['Income']="Asset Discount ";
                    $data['Value']=number_format($asset_discount,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);         
                    
                    $data['Income']="Supplier Discount ";
                    $data['Value']=number_format($supp_discount,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
          
                    $data['Income']="TOTAL SALE[excl tax] ";
                    $data['Value']=number_format($tot_excl,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
          
                    
                    
  $profit_sum=0;
  $sql_login  =  $database->mysqlQuery("select tas_loss from tbl_account_settings "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{ 
      $profit_sum= $result_login['tas_loss'];
    }}
                                        
                                        
                                        
                                        
                                        
                    if($profit_sum>0)
                    {                                            
                    $data['Income']="LOSS ";
                    $data['Value']=number_format($profit_sum,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    }
                                        
                      $data['Income']="TOTAL INCOME ";
                    $data['Value']=number_format($tot_excl+$indirect_income+$asset_discount+$supp_discount,$_SESSION['be_decimal']);
                    $data['Expense']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                            
    
                                                   
 
                                                          
                        
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
           $sql_logincpta  =  $database->mysqlQuery("select ev_amount  from tbl_employee_voucher where ev_id!='' and  $string_exp_staff group by ev_month,ev_year,ev_employee_id"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$salary_direct_expense =$salary_direct_expense + $result_logincpta['ev_amount'];
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
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tas_open_stock_value) as open_stock  FROM tbl_account_stock where $string_stock "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $open_val=  $open_val+$result_login_loy1['open_stock'];
                      
                      
          }
          }   
                  
                  
                  
          
          $direct_exp_total=$supplier_indirect_expense4+$salary_direct_expense+$expense_voucher_direct+$supplier_indirect_expense;
          
          
          $tot_all_expense=$direct_exp_total+$expense_voucher_indirect+$consolidated_final_comp+$open_val;
          
          
                     $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="EXPENSE";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
          
                    
                     $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Opening Stock";
                    $data['Value.']=number_format($open_val,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Direct Expense";
                    $data['Value.']=number_format($direct_exp_total,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Employee Vouchers";
                    $data['Value.']=number_format($salary_direct_expense,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
          
          $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Expense Vouchers";
                    $data['Value.']=number_format($expense_voucher_direct,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    
                     $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Supplier Vouchers";
                    $data['Value.']=number_format(($supplier_indirect_expense+$supplier_indirect_expense4),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Indirect Expense";
                    $data['Value.']=number_format(($expense_voucher_indirect+$consolidated_final_comp),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Indirect ";
                    $data['Value.']=number_format($expense_voucher_indirect,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    
                     $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="Complimentary Sale";
                    $data['Value.']=number_format($consolidated_final_comp,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                                        
                                            $loss_chk=0;
          $sql_loginta  =  $database->mysqlQuery("select tas_profit from tbl_account_settings"); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				
			$loss_chk =$result_loginta['tas_profit'];
                      
          } } 
          
          
          
          
          
                     $data['Income']="";
                    $data['Value']="";
                    $data['Expense']="PROFIT";
                    $data['Value.']=number_format($loss_chk,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
          
           $data['Income']="";
                    $data['Value']="";
                    $data['Expense']=" TOTAL EXPENSE";
                    $data['Value.']=number_format($tot_all_expense,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
          
                                    
$filename = "p&l".$rt.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
exit;    
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
     $string_crd_new1='';
     $stringr='';
     $rt='';

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
      $rt.= " '".$from."' to '".$to."' ";
      $string_crd_new.=" cd_dayclosedate between '".$from."' and '".$to."' ";
      $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
      $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$to."' ";  
	               
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
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                   $asst_tot =$asst_tot + $result_fnctvenue['tpd_netamount'];   
        }}                  
                                         
                                         
               
        $close_stock=0;
           $fnct_menu6 = $database->mysqlQuery("select sum(tas_close_stock_value) as total_asset_bill  from tbl_account_stock where tas_id!='' and $string_close  ");
         $num_fdtl6 = $database->mysqlNumRows($fnct_menu6);
        if ($num_fdtl6 > 0) {
              while ($result_fnctvenue6 = $database->mysqlFetchArray($fnct_menu6))
              {
                   $close_stock =$close_stock + $result_fnctvenue6['total_asset_bill'];   
        }}
                                         
                      
        
        
        $data=array();
            $data1=array();
                     
                    
                    
                    $data['Asset']="Fixed Asset ";
                    $data['Value']=number_format($asst_tot,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
        
        
                    $data['Asset']="Current Asset ";
                    $data['Value']="";
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    $data['Asset']="Current Asset ";
                    $data['Value']="";
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                       
                                          
      $stringy='';
      $string1y='';
      $string2y='';
      $string3y='';             
      $string_rec='';
      $string_adv_loan='';
      $string_asy='';	
      $string_con5y='';$string_crd_new1='';

    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
      $form = $_REQUEST['fromdt'];
      $to = $_REQUEST['todt'];
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$form = $_REQUEST['fromdt'];
			$to=date("Y-m-d");
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
      $to = $_REQUEST['todt'];
		}
    else
	  {
		$from=date("Y-m-d");
		$to=date("Y-m-d");
     }                    
                        
        $stringy.= " and ts.sv_date between '".$from."' and '".$to."' ";
        $string1y.= " and ts.ev_date between '".$from."' and '".$to."' ";
        $string2y.= " and  date(tes.tes_entrydate) between '".$from."' and '".$to."' ";
        $string3y.= " and tes.ev_date between '".$from."' and '".$to."' ";
        $string_asy.= " and tpd_date  between '".$from."' and '".$to."' ";
        $string_con5y.= " and cv_date  between '".$from."' and '".$to."' ";
        $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
        $string_rec.= " and tr_date  between '".$from."' and '".$to."' ";   
        $string_adv_loan.= "  tla_date  between '".$from."' and '".$to."' "; 
	              
     
                       
    $loan_advance_bank=0;
    $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tlm_type='Bank_account' and    $string_adv_loan  "); 
    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$loan_advance_bank =$loan_advance_bank + $result_logincpta34['netamt'];          
      } }           
          
          
      $loan_advance_cash=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tlm_type='Cash_account' and    $string_adv_loan  ");
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	    if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$loan_advance_cash =$loan_advance_cash + $result_logincpta34['netamt'];           
      } }               
                                
      $cash_receipt_all=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where  tm.tlm_type='Cash_account'  $string_rec "); 
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	    if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$cash_receipt_all =$cash_receipt_all + $result_logincpta34['netamt12'];         
      } }                         
  
      $loan_minus2=0;
      $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tlm_type='Cash_account' and  tla_type='Loan' and  $string_adv_loan"); 
	    $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	    if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 	
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];                   
      } } 
                     
      $asset_discount_cash=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master on tpd_from_acc=tlm_id  where tlm_type='Cash_account' and tpd_type_pay='First'   $string_asy "); 
	    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	    if($num_login_loy1)
      {   
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   			
        $asset_discount_cash=  $asset_discount_cash+$result_login_loy1['amt'];           
      }
      }   
             
      $asset_discount_bank=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tlm_type='Bank_account' and tpd_type_pay='First'   $string_asy ");       
	    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	    if($num_login_loy1)
      {         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
        $asset_discount_bank=  $asset_discount_bank+$result_login_loy1['amt'];          
      }
      }   
          
      $supp_discount_cash=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id where tm.tlm_type='Cash_account' and ts.sv_type_pay='First'   $stringy ");  
	    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	    if($num_login_loy1){         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			  $supp_discount_cash=  $supp_discount_cash+$result_login_loy1['amt1'];            
      }
      }   

      $supp_discount_bank=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $stringy ");        
	    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	    if($num_login_loy1){          
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			  $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
      }
      }
          
          
/////------cash sale------------------------------- ////
        
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
          
          
          ///cash_credit//
          $credit_cash=0;
           $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$credit_cash =$credit_cash + $result_logincpta['tot'];
           }} 
          
          
                       
     $all_in_cash1=0;

         $fnct_menu3 = $database->mysqlQuery("select *  from tbl_ledger_master where tlm_type='Cash_account'  ");
         $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
        if ($num_fdtl3 > 0) {
              while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
              {
                $string678='';
             if($_REQUEST['fromdt']!="")
		          { 
	            $string678.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";                        
		          }else{
                    $from=date("Y-m-d");
                    $string678.= "   tps_dayclosedate = '".$from."'  ";
                }
              
                $yes_open=0;
                                    
          $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                  
          $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string678 and tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
             $yes_open=  $result_login['tps_ledger_open_bal'];
          }} 
          }else{
                                
          $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$result_fnctvenue3['tlm_id']."'  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
             $yes_open=  $result_login['tlm_open_bal'];
          }} 
          }
                  
                  
                  
    // $asset_discount_cash1=0;
    // $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and tpd_type_pay='First'   $string_asy ");  
	  // $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  // if($num_login_loy1){ 
		//   while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
		// 	{   			 
    //       $asset_discount_cash1=  $asset_discount_cash1+$result_login_loy1['amt'];           
    //       }
    //       }   



// $supp_discount_cash1=0;
//          $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id where ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account' and ts.sv_type_pay='First'   $stringy "); 
       
// 	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
// 	  if($num_login_loy1){ 
         
// 		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
// 			{   
			 
//                      $supp_discount_cash1=  $supp_discount_cash1+$result_login_loy1['amt1'];
                      
                      
//           }
//           }
                  
                  
                  
                  
      $loan_minus22=0;
      $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and  tla_type='Loan' and  $string_adv_loan"); 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
			$loan_minus22 =$loan_minus22+$result_loginta15['paid'];
      } } 
                  
      $loan_advance_cash1=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and    $string_adv_loan  "); 
	    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$loan_advance_cash1 =$loan_advance_cash1 + $result_logincpta34['netamt'];
      } }       
                  
                  
      $cash_receipt=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and  tm.tlm_type='Cash_account'  $string_rec "); 
	    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 			
			$cash_receipt =$cash_receipt + $result_logincpta34['netamt12'];
      } }  
      
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
    $tot_contra1=0;    
    $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
          while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{           
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
          }}   
                  
       //----contra voucher from account-------------------------//               
    $tot_contra=0;    
    $sql_login457  =  $database->mysqlQuery("select * from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	  $num_login457   = $database->mysqlNumRows($sql_login457);
			if($num_login457){
          while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_contra=$tot_contra+$result_login['cv_amount'];
          }}
                  
      //--asset purchase --paid amount----------------//               
        $tot_supplier_asset=0;
        $sql_login454  =  $database->mysqlQuery("select * from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_asy "); 
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){                                          
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
          }}
                                                   
     //--supplier voucher --paid amount----------------//                                           
          $tot_supplier=0;
          $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $stringy "); 
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
                                        
                                                  
          $tot_direct=0; 
          $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3y "); 	
          $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){                                     
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
          }}        
                           
          $tot_indirect=0; 
          $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3y"); 
          $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){                                           
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{         
          $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
          }}
                                        
                                        
                                        
        $all_in_cash=$yes_open-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect+$cash_receipt_from)+($cash_receipt+$tot_contra1);
                  
        $all_in_cash1=$all_in_cash1+$all_in_cash;

        
        
                    $data['Asset']=$result_fnctvenue3['tlm_ledger_name'];
                    $data['Value']=number_format(($credit_cash+$total_module_sale_cash+$all_in_cash+$loan_minus22)-$loan_advance_cash1,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);        
                    } } 
                                            
                                             
                                             
                    $data['Asset']='Cash Account';
                    $data['Value']=number_format(($credit_cash+$total_module_sale_cash+$all_in_cash1+$loan_minus2)-$loan_advance_cash,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                            
                                            
             
    $bank_receipt_all=0;
    $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tm.tlm_type='Bank_account'    $string_rec  "); 
    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$bank_receipt_all =$bank_receipt_all + $result_logincpta34['netamt'];           
      } }       
             
          
    $loan_minus3=0;
    $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tlm_type='Bank_account' and  tla_type='Loan' and  $string_adv_loan"); 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
			$loan_minus3 =$loan_minus3+$result_loginta15['paid'];             
      } } 
          
          
      /////---------------------bank sale----------------------------------////
          
    $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster  where   bm_paymode='2' and   $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){        
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   				
			$dine_sale_card =$dine_sale_card + $result_login['tot'];                        
      } } 
          
    $ta_sc_hd_sale_card=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster   where  tab_paymode='2' and  $stringta"); 
 
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

         $fnct_menu33 = $database->mysqlQuery("select *  from tbl_ledger_master where tlm_type='Bank_account'  ");
         $num_fdtl33 = $database->mysqlNumRows($fnct_menu33);
        if ($num_fdtl33 > 0) {
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
          $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
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
          }else{
                              
          $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$result_fnctvenue3['tlm_id']."'  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $yes_open1=  $result_login['tlm_open_bal'];
          }} 
          }
                  
                  
                    /////bank sale////
    $credit_card1=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment left join tbl_bankmaster on bm_id=cdp_bank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$credit_card1 =$credit_card1 + $result_logincpta['tot'];
           }}  

    $dine_sale_card1=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster left join tbl_bankmaster on bm_id=bm_transcbank left join tbl_ledger_master  on tlm_id=bm_account     where tlm_id='".$result_fnctvenue3['tlm_id']."' and  bm_paymode='2' and   $stringdi "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
			$dine_sale_card1 =$dine_sale_card1 + $result_login['tot'];
      } } 
          
    $ta_sc_hd_sale_card1=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster left join tbl_bankmaster on bm_id=tab_transcbank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  tab_paymode='2' and  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_card1 =$ta_sc_hd_sale_card1 + $result_loginta['tot'];                     
          } } 
          
          $total_module_sale_card1=$dine_sale_card1+$ta_sc_hd_sale_card1;
                  
                  
                  
    $asset_discount_bank1=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and tpd_type_pay='First'   $string_asy "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $asset_discount_bank1=  $asset_discount_bank1+$result_login_loy1['amt'];
                      
                      
          }
          }   







     $supp_discount_bank1=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where  ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $stringy "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount_bank1=  $supp_discount_bank1+$result_login_loy1['amt1'];
                      
                      
          }
          }   
                  
                  
                  
      $loan_minus33=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and  tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus33 =$loan_minus33+$result_loginta15['paid'];
                      
          } } 
                  
                  
                  $loan_advance_bank1=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and    $string_adv_loan  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan_advance_bank1 =$loan_advance_bank1 + $result_logincpta34['netamt'];
                        
                        
          } }           
                  
                  
            //-----------Receipt voucher---from ---bank-----------//         
        $bank_receipt=0;
        $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Bank_account'   $string_rec  "); 
	      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	     if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 			
			$bank_receipt =$bank_receipt + $result_logincpta34['netamt'];           
          } } 
          
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
                  
               $tot_contra1=0;    
           $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
                                        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
                  
                                        }}   
                  
                  
              $tot_contra=0;    
           $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5y "); 
	   $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
                                        while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          
          $tot_contra=$tot_contra+$result_login['cv_amount'];
                  
                                        }}
                  
                  
            $tot_supplier_asset=0;
           $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_asy "); 	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){                                           
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
          }}
                                        
                           
          $tot_supplier=0;
          $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $stringy "); 
          $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
                                        
                                        }}    
                                        
                                        
                                        
                                        
                                        
        $tot_employee=0; 
           $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1y "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
                                           
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
                                        }}
                                        
                       
                                        
                                        
                                        
                  $tot_direct=0; 
           $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3y "); 
	
           $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){
                                      
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
                                        
                                        }}        
                                        
                
                                        
                                        
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
                                        
                                        
                                        
        $all_in_bank=$yes_open1-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect+$bank_receipt_from+$loan_minus33)+($supplier_return+$tot_contra1+$bank_receipt+$loan_advance_bank1);

        
        $all_in_bank1=$all_in_bank1+$all_in_bank;
     
        
        
        $data['Asset']=$result_fnctvenue3['tlm_ledger_name'];
                    $data['Value']=number_format(($credit_card1+$total_module_sale_card1+$all_in_bank),$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    
                                                
                                           
                                             } } 
                                            
                                             $data['Asset']='Bank';
                    $data['Value']=number_format(($credit_card+$total_module_sale_card+$all_in_bank1),$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                            
                                            
                                         $dine_sale=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster  where  $stringdi "); 
 
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
          
          $total_module_sale=$dine_sale+$ta_sc_hd_sale;
                                        
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
          
          
          
          
           
                    
                    $data['Asset']='Sundry Debtors';
                    $data['Value']=number_format($totalcp,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    
                     $data['Asset']='Loans & Advances';
                    $data['Value']=number_format($loan_adv-$loan_adv_minus,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    $data['Asset']='Closing Stock ';
                    $data['Value']=number_format($close_stock,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                       
                                       $profit_sum=0;
                                        $sql_login  =  $database->mysqlQuery("select tas_loss from tbl_account_settings "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                           $profit_sum= $result_login['tas_loss'];
                                          
                                        }}
                                        
                                        
                                        
                                        
                                   $tot_asset_all_in=     ($credit_card+$credit_cash+$profit_sum+$asst_tot+$totalcp+$all_in_cash1+$close_stock+$all_in_bank1+$total_module_sale_card+$total_module_sale_cash);
                                        
                                        if($profit_sum>0){
                                            
                                            
                                            $data['Asset']='Loss ';
                    $data['Value']=number_format($profit_sum,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                        
                                              
                                            }
                                            
                                            
                    $data['Asset']='Total Asset ';
                    $data['Value']=number_format($tot_asset_all_in,$_SESSION['be_decimal']);
                    $data['Liabilities']="";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                                        
                                            
                                      
   
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
           $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Capital";
                    $data['Value.']=number_format($capital_acc,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                     $sql_logincpta34  =  $database->mysqlQuery("select tlm_open_bal,tlm_ledger_name  from tbl_ledger_master where tlm_type='Capital' "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
                      
                      
                      
                      $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']=$result_logincpta34['tlm_ledger_name'];
                    $data['Value.']=number_format($result_logincpta34['tlm_open_bal'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
			
			    
                                       
                        
          } }   
          
           $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Non Current Liabilities";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
          
                    
          
           $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Current Liabilities";
                    $data['Value.']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    
                    
                     $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Tax";
                    $data['Value.']=number_format($tax_amt,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                     $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Sundry Creditors";
                    $data['Value.']=number_format($tot_supply_pay,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Asset Liability";
                    $data['Value.']=number_format($asset_liab_all,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']="Salary Outstanding";
                    $data['Value.']=number_format($salry_liab_all,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
                   
                    
                                        
                                            
             
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
          
            $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']='Loans';
                    $data['Value.']=number_format($loan,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']='Investment';
                    $data['Value.']=number_format($invest,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
			
                    
                    
                    
            ?>            

                                            
                                           
                                            
                                           
                                            
                                            
                                            
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
                                            
                                            $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']='PROFIT';
                    $data['Value.']=number_format($loss_sum,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                                        
                                              
                                         } 
                                         
                                         
                                         
                                            $data['Asset']=' ';
                    $data['Value']='';
                    $data['Liabilities']=' TOTAL LIABILITIES ';
                    $data['Value.']=number_format($all_liab_in,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                                            

                    $filename = " Bl".$rt. ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
    }
  unset($data);
  unset($data1);
 
             
             

 exit;
                    
                    
  }
  ?>

    
     

