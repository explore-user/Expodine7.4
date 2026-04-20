<?php

session_start();
include("../database.class.php"); 
$database	= new Database(); 



if(isset($_REQUEST['set'])&& $_REQUEST['set']=="add_group"){
    
    
    $insertion['tlg_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['group_name']);
    $insertion['tlg_status'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Y');
    $insertion['tlg_group_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type_of_group']);
    $insertion['tlg_exp_inc_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type_of_exp_inc']);
    
    
    

    $sql=$database->check_duplicate_entry('tbl_ledger_group',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_ledger_group',$insertion);
        }
    
}
else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="update_group"){
    
    $sql_stwrd  =  $database->mysqlQuery("Update tbl_ledger_group set tlg_name='".$_REQUEST['group_name']."',tlg_status='".$_REQUEST['status_group']."',tlg_group_type='".$_REQUEST['type_of_group']."',tlg_exp_inc_type='".$_REQUEST['type_of_exp_inc']."' where tlg_id='".$_REQUEST['id']."' ");
    
}



else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="update_ledger"){
    
    if($_REQUEST['capital_cash_bank']!=''){
    
    $sql_stwrd  =  $database->mysqlQuery("Update tbl_ledger_master set tlm_ledger_name='".$_REQUEST['ledger']."',tlm_group='".$_REQUEST['group_id']."',tlm_open_bal='".$_REQUEST['ledger_balance']."',tlm_type='".$_REQUEST['type']."',tlm_capital_cb='".$_REQUEST['capital_cash_bank']."' where tlm_id='".$_REQUEST['id']."' ");
    
    }else{
    $sql_stwrd  =  $database->mysqlQuery("Update tbl_ledger_master set tlm_ledger_name='".$_REQUEST['ledger']."',tlm_group='".$_REQUEST['group_id']."',tlm_open_bal='".$_REQUEST['ledger_balance']."',tlm_type='".$_REQUEST['type']."' where tlm_id='".$_REQUEST['id']."' ");   
    }
    
//updating tps_open_bal_updated=N in ledger settings table
    $start_date_qry = $database->mysqlQuery("SELECT be_accounts_start_date FROM tbl_branchmaster");
    $num_start_date   = $database->mysqlNumRows($start_date_qry);
    if($num_start_date)
    {
      $result  = $database->mysqlFetchArray($start_date_qry);
      $start_date = $result['be_accounts_start_date']; 
      if($_REQUEST['old_ledger_balance']!=$_REQUEST['ledger_balance']) //opening balance updation - start from account start date
      {
      $open_bal_update  =  $database->mysqlQuery("Update tbl_ledger_setting set tps_open_bal_updated='N' where tps_ledger_id='".$_REQUEST['id']."' AND tps_dayclosedate<'".$start_date."' ");  
      $open_bal_update  =  $database->mysqlQuery("Update tbl_ledger_setting set tps_ledger_open_bal='".$_REQUEST['ledger_balance']."',tps_closing_balance='".$_REQUEST['ledger_balance']."' where tps_ledger_id='".$_REQUEST['id']."' AND tps_dayclosedate='".$start_date."' "); 
      }
    }
//end
    $date_in=date('Y-m-d H:i:s');

    $insertion['top_ledger'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['id']);
    $insertion['top_login'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']);
    $insertion['top_date'] 		=  mysqli_real_escape_string($database->DatabaseLink,$date_in);     
    $insertion['top_amount_now'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ledger_balance']);

    $sql=$database->check_duplicate_entry('tbl_ledger_openbal_log',$insertion);
	if($sql!=1)
	{
	$insertid  =  $database->insert('tbl_ledger_openbal_log',$insertion);
  }
    
}
else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="add_ledger"){
    
    
    $insertion['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ledger']);
    $insertion['tlm_group'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['group_id']);
    $insertion['tlm_open_bal'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ledger_balance']);     
    $insertion['tlm_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']);
      
    if($_REQUEST['capital_cash_bank']!=''){
      $insertion['tlm_capital_cb'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['capital_cash_bank']);
      }
      
    $sql=$database->check_duplicate_entry('tbl_ledger_master',$insertion);
	if($sql!=1)
	{
	$insertid =  $database->insert('tbl_ledger_master',$insertion);
  }
    echo $insertid;
    
}


else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="ledger_change"){
    
     $sql_login  =  $database->mysqlQuery("select tlg_id,tlg_name,tlg_group_type from tbl_ledger_master left join tbl_ledger_group on tlg_id=tlm_group where tlm_id='".$_REQUEST['ledger_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
             echo   $result_login['tlg_name'].'*'.$result_login['tlg_group_type'].'*'.$result_login['tlg_id'];  
          }
                  }
    
    
}
else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="submit_ledger"){
    
    
    $date_in=date('Y-m-d H:i:s');
    
     $insertion['tvp_ledger_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ledger']);
     $insertion['tvp_group_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['group']);
     $insertion['tvp_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['amount']);
     $insertion['tvp_voucher_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucher']);
     $insertion['tvp_transaction_mode'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mode_of_pay']);
     $insertion['tvp_group_pay_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['group_type_pay']);
     $insertion['tvp_contra_entry_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['entry_type']);
     $insertion['tvp_contra_pay_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['entry_type_pay']);
     $insertion['tvp_bank_acc_no'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['bank_acc_no']);
     $insertion['tvp_cheque_no'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['cheq_no']);
     $insertion['tvp_dd_no'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['dd_no']);
     $insertion['tvp_voucher_no'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucher_no']);
     $insertion['tvp_remarks'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['remark']);
      $insertion['tvp_date_time'] 		=  mysqli_real_escape_string($database->DatabaseLink,$date_in);
    
    $sql=$database->check_duplicate_entry('tbl_ledger_voucher_payment',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_ledger_voucher_payment',$insertion);
        }
    
    
}

else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="load_balance_sheet_asset"){
    
    
     $string='';
     $stringdi='';
     $stringta='';
     $stringast='';
     $stringdi .=" bm_status='Closed' AND bm_complimentary!='Y'  AND  ";
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
			  $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
        $stringast.=" tpd_date between '".$from."' and '".$to."' ";                      
        $string_close.=" tas_date = '".$to."' ";                       
        $string_crd_new.=" cd_dayclosedate between '".$from."' and '".$to."' ";
        $string_sup1.=" sv_date between '".$from."' and '".$to."' ";
        $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
        $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$to."' ";    

        $contra_sum=0;
        $sql_login  =  $database->mysqlQuery("select sum(cv_amount) as tot from tbl_contra_voucher where cv_id!='' and $string "); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ //$contra_sum=$contra_sum+ $result_login['tot'];
          }}
         
          // sundry debitor - balance --------------------------//  
        $totalcp=0;
        $sql_logincpta  =  $database->mysqlQuery("select sum(cd_amount) as tot from tbl_credit_details  where cd_settled='N' and $string_crd_new"); 
	      $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	      if($num_logincpta){
		    while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			  { 
			    $totalcp =$totalcp + $result_logincpta['tot'];
        }} 
          
                                        
          
          $asst_tot=0;
           $fnct_menu = $database->mysqlQuery("select distinct(tpd_invoice),tpd_vendor,tpd_netamount  from tbl_asset_purchase_invoice_detail where tpd_id!='' and $stringast group by tpd_invoice,tpd_vendor ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {           
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
               
                   $asst_tot =$asst_tot + $result_fnctvenue['tpd_netamount'];
                       
        }}
        
      

        $asst_tot_supp=0;
           $fnct_menu = $database->mysqlQuery("select distinct(sv_invoice_no),sv_vendor_id,sv_invoice_amount  from tbl_supplier_voucher where sv_id!='' and $string_sup1 group by sv_invoice_no,sv_vendor_id ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {           
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
               
                   $asst_tot_supp =$asst_tot_supp + $result_fnctvenue['sv_invoice_amount'];
                       
        }}
        
        
          
          $close_stock=0;
           $fnct_menu6 = $database->mysqlQuery("select tas_close_stock_value as total_asset_bill  from tbl_account_stock where tas_id!='' and $string_close  ");
         $num_fdtl6 = $database->mysqlNumRows($fnct_menu6);
        if ($num_fdtl6 > 0) {
              while ($result_fnctvenue6 = $database->mysqlFetchArray($fnct_menu6))
              {
                   $close_stock =$close_stock + $result_fnctvenue6['total_asset_bill'];   
        }}
        
        
        $total_asset_all=$asst_tot+$totalcp+$contra_sum+$close_stock;

  

                      ?>   
                                      
                                        <tr style="display: none">
                                                <td style="width:35%">Cash - Bank [Contra] </td>
                                                 <td style="width:35%"><?=number_format($contra_sum,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                 <td style="width:35%;">Fixed Asset <a style="float: right;background-color: darkred;color: white" href="asset_invoice.php?from=<?=$from?>&to=<?=$to?>"> [View All]</a></td>
                                                 <td style="width:35%"><?=number_format($asst_tot,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                           <tr style="display: none">
                                               <td style="width:35%;">Supplier Asset <a style="float: right;background-color: darkred;color: white" href="voucher_view.php"> [View All]</a></td>
                                                 <td style="width:35%"><?=number_format($asst_tot_supp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            <tr>
                                                 <td style="width:35%;font-weight: bold">Current Asset</td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                           
                                  
         <?php
          $stringy='';
          $string1y='';
          $string2y='';
          $string3y='';
          $string_asy='';	
          $string_con5y='';
          $string_adv_loan='';
          $string_rec='';

    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
      $from = $_REQUEST['fromdt'];
      $to = $_REQUEST['todt'];
		}                   
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
      $from= $_REQUEST['fromdt'];
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
      $string_rec.= " and tr_date  between '".$from."' and '".$to."' ";    
      $string_adv_loan.= "  tla_date  between '".$from."' and '".$to."' ";  
	               
     
                       
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
          
    //---Supplier voucher -------discount -------------cash account---------------------//         
    $supp_discount_bank=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $stringy "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
      }
      }   
          
    /////////----------------------All in cash account-----------------------------------//                  
    $all_in_cash1=0;

    $fnct_menu3 = $database->mysqlQuery("select tlm_id  from tbl_ledger_master where tlm_type='Cash_account'  ");
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
                                    
          $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){                                 
          $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string678 and tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
             $yes_open=  $result_login['tps_ledger_open_bal'];
          }} 
          }
          else{                                 
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
        
        }}
    

//////////----------------all in bank-----------------------------------------//
        $all_in_bank1=0;
        $fnct_menu31 = $database->mysqlQuery("select tlm_id  from tbl_ledger_master where tlm_type='Bank_account' ");
        $num_fdtl31 = $database->mysqlNumRows($fnct_menu31);
        if ($num_fdtl31 > 0) {
              while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu31))
              {
                  $string6781='';
              if($_REQUEST['fromdt']!="")
		            { 
	              $string6781.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";                     
		            }else{
                    $from=date("Y-m-d");
                    $string6781.= "   tps_dayclosedate = '".$from."'  ";
                }
                
          $yes_open1=0;
                                  
          $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
          $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string6781 and tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
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
          
          $all_in_bank=$yes_open1-($tot_supplier+$bank_contra_from+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect+$bank_receipt_from)+($bank_contra_to+$bank_receipt_to);

          $all_in_bank1=$all_in_bank1+$all_in_bank;

        }} 

    
      /////--------------cash sale -------------------////
        
    $dine_sale_cash=0;                 
    $sql_login  =  $database->mysqlQuery("select (sum(bm_amountpaid) - (sum(bm_amountbalace) )) as tot FROM tbl_tablebillmaster  where   $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   				
			$dine_sale_cash =$dine_sale_cash + $result_login['tot'];
      } } 
       
    $ta_sc_hd_sale_cash=0;
    $sql_loginta  =  $database->mysqlQuery("select (sum(tab_amountpaid) - (sum(tab_amountbalace)))  as tot from tbl_takeaway_billmaster where  $stringta"); 
    $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_cash =$ta_sc_hd_sale_cash + $result_loginta['tot'];
      } } 
          
      $total_module_sale_cash=$dine_sale_cash+$ta_sc_hd_sale_cash;


      /////---------------bank sale----------------////
          
    $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster  where bm_paymode='2' and   $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
    while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{   		
			$dine_sale_card =$dine_sale_card + $result_login['tot'];
    } } 
      
    $ta_sc_hd_sale_card=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster where tab_paymode='2' and  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];
      } } 
          
    $total_module_sale_card=$dine_sale_card+$ta_sc_hd_sale_card;

- 
    ///--------cash_credit----------------//
    $credit_cash=0;
    $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_cash =$credit_cash + $result_logincpta['tot'];
      }} 
          
    $credit_card=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_card =$credit_card + $result_logincpta['tot'];
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
    ?>
                                            
      <tr>
          <td style="width:35%;">Cash Account </td>
          <td style="width:35%"> <span><?=number_format(($supplier_return_cash+$credit_cash+$all_in_cash1+$cash_loan_return+$total_module_sale_cash)-($loan_advance_cash),$_SESSION['be_decimal'])?> </span>
              
              <span id="plus_btn_cash" onclick="return view_cash_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer"> + </span>
         <span id="minus_btn_cash" onclick="return close_cash_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span>                        
          </td>
     </tr>
     
     
      <tr style="display: none" id="cash_acc_div">  </tr>
              

    <tr>
         <td style="width:35%;">Bank </td>
         <td style="width:35%"> <span><?=number_format(($supplier_return_bank+$credit_card+$total_module_sale_card+$all_in_bank1+$bank_loan_return)-($loan_advance_bank),$_SESSION['be_decimal'])?> </span>
             
             <span id="plus_btn_bank" onclick="return view_bank_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer"> + </span>
        <span id="minus_btn_bank" onclick="return close_bank_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span>                        
         </td>
    </tr>
                                            
                                            
                                            <tr style="display: none" id="bank_acc_div">
                                                
                                            </tr>
                                            
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;"> </td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                        
                                            
                                            <tr style="display: none">
                                                 <td style="width:35%;">Sales </td>
                                                 <td style="width:35%"><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;"> </td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            
                                            
                                            
    <?php
    $prof_chk=0;
    $sql_loginta  =  $database->mysqlQuery("select tas_loss from tbl_account_settings");
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 				
			$prof_chk =$result_loginta['tas_loss'];                     
      } } 

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


  
        $all_prof_chk_in=($supplier_return_bank+$credit_cash+$credit_card+$total_asset_all+$prof_chk+$all_in_cash1+$all_in_bank1+$total_module_sale_cash+$total_module_sale_card);


   
        ?>   
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;">Loans & Advances<a style="float: right;background-color: darkred;color: white" href="loan_advance.php?from=<?=$from?>&to=<?=$to?>"> [View All]</a></td>
                                                 <td style="width:35%"><?=number_format(($loan_adv-$loan_adv_minus),$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                             <tr>
                                                 <td style="width:35%;">Sundry Debtors</td>
                                                 <td style="width:35%"><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                 <td style="width:35%;">Closing Stock  </td>
                                                 <td style="width:35%"><?=number_format($close_stock,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            <tr id="loss_div" style="display: none" >
                                                 <td style="width:35%;font-weight: bold;background-color: #de7171">LOSS</td>
                                                 <td style="width:35%;font-weight: bold"id="loss_val_set" ></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold">TOTAL ASSET</td>
                                                 <td  style="width:35%"><?=number_format($all_prof_chk_in,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                             <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            
                                            
  <?php
                                        
                                        
             
                                        
           $sql_loginta  =  $database->mysqlQuery("update tbl_dayclose set dc_asset='$all_prof_chk_in' where dc_day='".$_SESSION['date']."'   ");                                 
                                       
                                            
 }

 
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="load_balance_sheet_liability")
 {
    $string='';
    $stringta='';
    $string_exp_supp='';
    $string_asset_liab='';
    $string_emp_liab='';
    $string_rec='';
    $stringr='';
    
    $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
    $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND ";
        
        
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                
                                $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                 $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                 
                                 $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringr.=" and date(tr_date)  between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                               
                                $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                 $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                 
                                 $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                 $stringr.=" and date(tr_date)  between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                
                                $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
                                $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                                 $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                                $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                                
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $stringr.=" and date(tr_date)  between '".$from."' and '".$to."' ";
                        }
                         else
	                        {
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
			$string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
                        $string_asset_liab.=" tpd_date between '".$from."' and '".$to."' ";
                        
                         $string_emp_liab.=" ev_date between '".$from."' and '".$to."' ";
                         $string_rec.=" tr_date between '".$from."' and '".$to."' ";
                         
                         $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $stringr.=" and date(tr_date)  between '".$from."' and '".$to."' ";   
	               } 


  $supplier_indirect_expense=0;
  $sql_logincpta  =  $database->mysqlQuery("select distinct(sv_invoice_no),sv_vendor_id, sv_invoice_amount as tot4 from tbl_supplier_voucher where sv_entry_type ='Credit' and sv_pr_return ='N' and  $string_exp_supp group by sv_invoice_no,sv_vendor_id"); 
	$num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$supplier_indirect_expense =$supplier_indirect_expense + $result_logincpta['tot4'];
          } }             
          
          
  $supplier_indirect_expense1=0;
  $sql_logincpta1  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot41 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp "); 
  $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	  if($num_logincpta1){
		  while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 
			$supplier_indirect_expense1 =$supplier_indirect_expense1 + $result_logincpta1['tot41'];
      } }   


  $supplier_return=0;
  $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr from tbl_return_payment left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_return_payment.tr_to_acc   where tbl_ledger_master.tlm_vendor_id!='' and tbl_ledger_master.tlm_type='Normal'  $stringr  "); 
	$num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	if($num_logincpta1){
		  while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 
			
			$supplier_return =$supplier_return + $result_logincpta1['totr'];
          } }   
          
          $tot_supply_pay=$supplier_indirect_expense-$supplier_indirect_expense1-$supplier_return;
          

  // $asset_liab=0;
  // $sql_logincpta3  =  $database->mysqlQuery("select distinct(tpd_invoice),tpd_vendor,tpd_netamount as netamt from tbl_asset_purchase_invoice_detail where tpd_id !='' and  $string_asset_liab group by tpd_invoice,tpd_vendor"); 
	// $num_logincpta3   = $database->mysqlNumRows($sql_logincpta3);
	//   if($num_logincpta3){
	// 	  while($result_logincpta3 = $database->mysqlFetchArray($sql_logincpta3)) 
	// 		{ 
	// 		$asset_liab =$asset_liab + $result_logincpta3['netamt'];        
  //     } }   
          
  // $asset_liab1=0;
  // $sql_logincpta3  =  $database->mysqlQuery("select sum(tpd_paid_amount) as paid from tbl_asset_purchase_invoice_detail where tpd_id !='' and  $string_asset_liab "); 
	// $num_logincpta3   = $database->mysqlNumRows($sql_logincpta3);
	//   if($num_logincpta3){
	// 	  while($result_logincpta3 = $database->mysqlFetchArray($sql_logincpta3)) 
	// 		{ 
  //       $asset_liab1 =$asset_liab1 + $result_logincpta3['paid'];
  //      } }   
          
  //         $asset_liab_all=$asset_liab-$asset_liab1;
    
  
   $asset_liab1=0;
  $sql_logincpta3  =  $database->mysqlQuery("select sum(tpd_credit_amount) as paid from tbl_asset_purchase_invoice_detail where tpd_id !='' and  $string_asset_liab "); 
	$num_logincpta3   = $database->mysqlNumRows($sql_logincpta3);
	  if($num_logincpta3){
		  while($result_logincpta3 = $database->mysqlFetchArray($sql_logincpta3)) 
			{ 
        $asset_liab1 =$asset_liab1 + $result_logincpta3['paid'];
       } } 
         
       $asset_liab_all=$asset_liab1;
          
          $salry_liab=0;$salry_liab1=0;
          
           $sql_logincpta34  =  $database->mysqlQuery("select ev_net_salary_new from tbl_employee_voucher where ev_date !='' and  $string_emp_liab group by ev_month,ev_year,ev_employee_id "); 
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$salry_liab =$salry_liab + $result_logincpta34['ev_net_salary_new'];
                       
                        
          } }   
          
          
          
       
    //   $sql_logincpta34  =  $database->mysqlQuery("select sum(ev_amount) as paid from tbl_employee_voucher where ev_date !='' and  $string_emp_liab "); 

    //        $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  // if($num_logincpta34){
		//   while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
		// 	{ 
			
			
    //                     $salry_liab1 =$salry_liab1 + $result_logincpta34['paid'];
                        
    //       } }   
          
         
          
    //       $salry_liab_all=$salry_liab-$salry_liab1; 

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
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tlm_open_bal) as netamt from tbl_ledger_master where tlm_type='Capital' "); 
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
                                            
                                            <tr>
                                                <td style="width:35%;font-weight: bold" >Capital</td>
                                                 <td style="width:35%"><?=number_format($capital_acc,$_SESSION['be_decimal'])?>
                                                 
                                                 <span id="plus_btn_cap" onclick="return view_cap_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer"> + </span>
                                                <span id="minus_btn_cap" onclick="return close_cap_acc();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span>                        
                                          </td>
                                          
                                            <tr style="display: none" id="cap_acc_div">
                                                
                                            </tr>
                                          
                                            </tr>
                                            
                                             <tr>
                                                <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                             <tr>
                                                <td style="width:35%;font-weight: bold">Current Liability</td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                          <tr>
                                                <td style="width:35%">Tax</td>
                                                 <td style="width:35%"><?=number_format($tax_amt,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                        
                                             <tr>
                                                <td style="width:35%">Sundry Creditors  </td>
                                                 <td style="width:35%"><?=number_format($tot_supply_pay,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                             <tr>
                                                <td style="width:35%">Asset Liability</td>
                                                 <td style="width:35%"><?=number_format($asset_liab_all,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                             <tr>
                                                <td style="width:35%">Salary Outstanding  </td>
                                                 <td style="width:35%"><?=number_format($salry_liab_all,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            
                                          
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
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
                                          
          
          
            ?>                     
                                            
                                       <tr>
                                                 <td style="width:35%;font-weight: bold">Non Current Liability</td>
                                                 <td style="width:35%"></td>
                                            </tr>      
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;">Loans</td>
                                                 <td style="width:35%"><?=number_format($loan,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;">Investment</td>
                                                 <td style="width:35%"><?=number_format($invest,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                             
                                            
                                            <tr id="profit_div" style="display: none" >
                                                 <td style="width:35%;font-weight: bold;background-color: #83a587">PROFIT</td>
                                                 <td style="width:35%;font-weight: bold"id="profit_val_set" ></td>
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
          
          
          $all_liab_in=$tot_supply_pay+$loss_chk+$asset_liab_all+$salry_liab_all+$capital_acc+$loan+$invest+$tax_amt;
                                            ?>
                                            
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold">TOTAL LIABILITIES</td>
                                                 <td style="width:35%"><?=number_format($all_liab_in,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                           
                                            
                                            
                                            
        <?php
                                        
        $sql_loginta  =  $database->mysqlQuery("update tbl_dayclose set dc_liab='$all_liab_in' where dc_day='".$_SESSION['date']."'  ");                             
                                              
 }
 
 
  
  else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="load_balance_sheet_profit"){
    
        $string='';
        $stringta='';
        $string1_str='';
        $string1_strtacshd='';
        $strings='';
        $stringsta='';
        $string_exp='';
        $stringr='';
        
        $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y' AND "; 

        $string1_str.=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd.=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
	      $strings.=" bm_status='Closed' AND ";
        $stringsta.=" tab_status='Closed' AND ";
        
       $string_credit_pay=" ";
       $string_stock=" ";
       $string_rec='';

       $string_ass=" ";
       $string_supp=" ";

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
      $string_credit_pay.=" cdp_dayclosedate between '".$from."' and '".$to."' ";      
      $string_rec.=" tr_date between '".$from."' and '".$to."' ";   
      $string_stock.=" tas_date='".$to."' ";      
      $string_ass.=" tpd_date between '".$from."' and '".$to."' ";
      $string_supp.=" sv_date between '".$from."' and '".$to."' ";
      $stringr.=" date(tr_date) between '".$from."' and '".$to."' ";

     
      //---------------------------------- Sale-----------------------------------------------------//
    $dine_sale=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster  where  $string "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
    {
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
			$dine_sale =$dine_sale + $result_login['tot'];                       
      } 
    } 
          
    $ta_sc_hd_sale=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_netamt) as tot from tbl_takeaway_billmaster where   $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta)
    {
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale =$ta_sc_hd_sale + $result_loginta['tot'];                     
      } 
    } 
          
    $total_module_sale=$dine_sale+$ta_sc_hd_sale; //total card sale
  
          
    $subtotalcash=0; $roundofdi=0;
    $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			    $subtotalcash =$subtotalcash + $result_logincashdi['tot'];
          $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }
      }} 
     
          
    $subtotalcashta=0;$roundofta=0;
    $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringta order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			    $subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
          $roundofta=$roundofta+$result_logincashta['roundofta'];
          }
      }} 

      $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta; // total cash sale
          
    $subtotalcredit=0;
    $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank AND  tbl_paymentmode.pym_code='credit' and "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
      }
    }
             
    $subtotalcreditta=0;
    $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  tbl_paymentmode.pym_code='credit' and "."$stringta group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
      }
    }
      $totalcredit=$subtotalcredit+$subtotalcreditta; // total bank credit sale
          
      ////creditperson/////
          
        $subtotalcp=0;
        $string_cr=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string3_cr=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";   
                 
    $sql_logincp  =  $database->mysqlQuery("select $string_cr as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $string and  pym_code='credit_person' order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
      }
      }} 

    $subtotalcpta=0;
    $sql_logincpta  =  $database->mysqlQuery("select $string3_cr as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringta and  pym_code='credit_person' order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
          } }} 
          
    $totalcp=$subtotalcp+$subtotalcpta;  //total credit person
          
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
         
    $all_tax_show=$tax_ta_all+$tax_di_all; //total tax     
           
    $tot_excl=  $total_module_sale-$all_tax_show; // card sale -tax
          
               
    $credit_settled_all=0; $pay_bal=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(cdp_paid_cash) as cash_pay,sum(cdp_transaction_amount) as card_pay,sum(cdp_balance) as pay_bal  FROM tbl_credit_details_payment where $string_credit_pay "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1)
    {     
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   			 
          $cashpay=  $result_login_loy1['cash_pay'];
          $cardpay=  $result_login_loy1['card_pay'];
          //$pay_bal= $result_login_loy1['pay_bal'];                     
      }
    }         

    $credit_settled_all=($cardpay+$cashpay)-$pay_bal;      
         
//------------------------------------------------ Closing Stock -------------------------------------------//    
    $close_val=0;
    $sql_login_loy1  =  $database->mysqlQuery("select tas_close_stock_value as close_stock  FROM tbl_account_stock where $string_stock ");      
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1)
    {    
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $close_val=  $close_val+$result_login_loy1['close_stock'];            
      }
    }   ?>   
                                  
       <tr>
        <td style="width:35%"> Closing Stock</td>
            <td style="width:35%"><?=number_format($close_val,$_SESSION['be_decimal'])?></td>
       </tr>
       <tr>
            <td style="width:35%;font-weight: bold"></td>
            <td style="width:35%"></td>
       </tr>   
        
<!------------------------------------------------ Indirect income ------------------------------------------->
      <?php 
      $indirect_income=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tr_amount) as amt FROM tbl_receipts where tr_acc_type='Indirect_income' and  $string_rec "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1)
    { 
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 $indirect_income=  $indirect_income+$result_login_loy1['amt'];           
      }
    }   ?>

    <!------------------------------------------------ purchase return ------------------------------------------->
    <?php 
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
          
//------------------------------------------------ Asset Discount -------------------------------------------//     
    $asset_discount=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail where tpd_type_pay='First' and  $string_ass "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1)
    {     
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
        $asset_discount=  $asset_discount+$result_login_loy1['amt'];
      }
    }   

  //------------------------------------------------ Supplier Discount -------------------------------------------//   
      $supp_discount=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher where sv_type_pay='First' and  $string_supp "); 
	    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	    if($num_login_loy1)
      {  
		    while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			  {   
          $supp_discount=  $supp_discount+$result_login_loy1['amt1'];         
        }
      }  ?> 
      
      
        <tr>
          <td style="width:35%">Indirect Income </td>
          <td style="width:35%"><?=number_format($indirect_income,$_SESSION['be_decimal'])?></td>
      </tr> 

      <tr>
          <td style="width:35%">Purchase Return </td>
          <td style="width:35%"><?=number_format($return_amt,$_SESSION['be_decimal'])?></td>
      </tr> 
      
       <tr>
            <td style="width:35%">Asset Discount </td>
          <td style="width:35%"><?=number_format($asset_discount,$_SESSION['be_decimal'])?></td>
      </tr> 
          
          <tr >
            <td style="width:35%">Supplier Discount </td>
          <td style="width:35%"><?=number_format($supp_discount,$_SESSION['be_decimal'])?></td>
        </tr>  
                                                                                      
        <tr>
            <td style="width:35%"> </td>
             <td style="width:35%"></td>
        </tr>
                                            
                                            
                                            
       <tr style="display:none">
          <td style="width:35%"> Credit Settlement Income</td>
           <td style="width:35%"><?=number_format($credit_settled_all,$_SESSION['be_decimal'])?></td>
      </tr>
                                                                             
      <tr >
           <td style="width:35%;font-weight: bold;"> Sales(excl tax) </td>
            <td style="width:35%;font-weight: bold"><?=number_format($tot_excl,$_SESSION['be_decimal'])?> </td>
       </tr>
                                            
       <tr style="display: none">
          <td style="width:35%;font-weight: bold;">TAX </td>
           <td style="width:35%;font-weight: bold"><?=number_format($all_tax_show,$_SESSION['be_decimal'])?> </td>
      </tr>
                                            
                                            
      <tr style="width:35%;font-weight: bold;display:none">
          <td style="width:35%;font-weight: bold;display:none"> Sales [incl tax]</td>
            <td style="width:35%;font-weight: bold"><?=number_format($total_module_sale,$_SESSION['be_decimal'])?> <span id="plus_btn_sale1" onclick="return view_sale1();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display:none "> + </span><span id="minus_btn_sale1" onclick="return hide_sale1();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span> </td>
      </tr>
        
      <tr id="cash_div_view" style="display:none">
            <td style="width:35%"> Cash Sale</td>
            <td style="width:35%"><?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
      </tr>

      <tr id="bank_div_view" style="display:none">
          <td style="width:35%"> Bank</td>
            <td style="width:35%"><?=number_format($totalcredit,$_SESSION['be_decimal'])?></td>
      </tr>

      <tr id="credit_div_view" style="display:none">
         <td style="width:35%"> Credit Sale</td>
          <td style="width:35%"><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
      </tr>
        
      <tr>
          <td style="width:35%;font-weight: bold"></td>
          <td style="width:35%"></td>
      </tr>
                                                                                                                   
      <tr id="loss_div1" style="display: none" >
           <td style="width:35%;font-weight: bold;background-color: #de7171">LOSS</td>
           <td style="width:35%;font-weight: bold"id="loss_val_set1"></td>
      </tr>
                                            
                                            
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
                                            
                                            
                
                  <tr id="date_by_sale" style="display: none">
                    <td style="width:35%"><?=$key?></td>
                   
                     <?php if(array_key_exists("DI",$val)){$each_day_final=$each_day_final+$val['DI'];$each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; } ?>
                    <?php if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA'];$each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } ?>
                    <?php if(array_key_exists("CS",$val)){$each_day_final=$each_day_final+$val['CS'];$each_module_sum['CS'][]=$val['CS'];  }else{$each_module_sum['CS'][]=0;  } ?>
                   <?php if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD'];$each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; } ?>
                    
                    <td style="width:35%"><?php $consolidated_final=$consolidated_final+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                </tr>
            <?php } } ?>  
                
                                            <tr id="tot_inc">
                                                 <td style="width:35%;font-weight: bold;background-color: lightgrey">TOTAL INCOME</td>
                                                 <td style="width:35%"><?=number_format(($return_amt+$tot_excl+$close_val+$indirect_income+$supp_discount+$asset_discount),$_SESSION['be_decimal'])?></td>
                                            </tr>
                
   <?php
                                               
 }
  
 
  else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="load_balance_sheet_loss"){
    
      $stringdi='';
      $stringta='';
      $string_exp='';
      $string_exp_emp='';
      $string_exp_staff='';
      $string_exp_supp="  ";
      $string='';
      $string_stock='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
      $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_exp.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_emp.= " ev_date between '".$from."' and '".$to."' ";
      $string_exp_staff.=" ev_date between '".$from."' and '".$to."' "; 
      $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
      $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
      $string_stock.= " tas_date = '".$from."'  ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
      $string_exp.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_emp.= " ev_date between '".$from."' and '".$to."' ";
      $string_exp_staff.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";                  
      $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_stock.= " tas_date = '".$from."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$_REQUEST['todt'];
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
      $string_exp.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_emp.= " ev_date between '".$from."' and '".$to."' ";
      $string_exp_staff.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";                       
      $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_stock.= " tas_date = '".$from."'  ";
		}
    else
	  {
		  $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
      $string_exp.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_emp.= " ev_date between '".$from."' and '".$to."' ";
      $string_exp_staff.=" ev_date between '".$from."' and '".$to."' ";
      $string_exp_supp.=" sv_date between '".$from."' and '".$to."' ";
      $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
      $string_stock.= " tas_date = '".$from."'  ";
	  }
                       
                        
                        
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
           $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as ev_amount  from tbl_employee_voucher where ev_id!='' and  $string_exp_staff group by ev_month,ev_year,ev_employee_id "); 
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
          
         
          
          
          
           $open_val=0;
         $sql_login_loy1  =  $database->mysqlQuery("select tas_open_stock_value as open_stock  FROM tbl_account_stock where $string_stock "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $open_val=  $open_val+$result_login_loy1['open_stock'];
                      
                      
          }
          }   
          
          
           $direct_exp_total=$salary_direct_expense+$expense_voucher_direct+$supplier_indirect_expense+$supplier_indirect_expense4;
                                        ?>   
                                         
                                            
                                            
                                           
                                             <tr>
                                                <td style="width:35%">Opening Stock  </td>
                                                <td style="width:35%"><?=number_format($open_val,$_SESSION['be_decimal'])?></td>
                                            </tr>
                                           
                                            <tr>
                                                <td style="width:35%;font-weight: bold"> Direct Expense</td>
                                                <td style="width:35%"><?=number_format($direct_exp_total,$_SESSION['be_decimal'])?>   <span id="plus_btn" onclick="return view_employee();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer"> + </span><span id="minus_btn" onclick="return hide_employee();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span> </td>
                                            </tr>
                                            
                                            
                                            
                                            
                                            <tr style="display: none" id="employee_section">
                                                <td style="width:35%">Employee Vouchers <?php if($salary_direct_expense>0){ ?> <a href="employee_voucher.php?redirect=profit_loss&from=<?=$from?>&to=<?=$to?>" style="float: right;background-color: darkred;color: white">[View All]</a> <?php } ?></td>
                                                <td style="width:35%"><?=number_format($salary_direct_expense,$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                                
                                                
                                             <tr style="display: none" id="employee_section1">    
                                                 <td style="width:35%">Expense Vouchers <?php if($expense_voucher_direct>0){ ?> <a href="expense_voucher.php?redirect=profit_loss&from=<?=$from?>&to=<?=$to?>" style="float: right;background-color: darkred;color: white">[View All]</a> <?php } ?> </td>
                                                <td style="width:35%"><?=number_format($expense_voucher_direct,$_SESSION['be_decimal'])?></td>
                                             </tr>
                                            
                                             <tr style="display: none" id="supplier_section">
                                                  <td style="width:35%">Supplier Vouchers<?php if($supplier_indirect_expense>0 || $supplier_indirect_expense4>0){ ?> <a href="voucher_view.php?redirect=profit_loss&from=<?=$from?>&to=<?=$to?>" style="float: right;background-color: darkred;color: white">[View All]</a> <?php } ?> </td>
                                                <td style="width:35%"><?=number_format(($supplier_indirect_expense+$supplier_indirect_expense4),$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                            
                                              
                                              
                                                
                                                
                                            <tr>
                                                <td style="width:35%">  </td>
                                                <td style="width:35%"></td>
                                            </tr>
                                            
                                           
                        
                                            
                                           <?php 
           $payment_consolidated=array();
            $consolidated_final_comp=0;
            
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary='Y' and $stringdi  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary='Y' and $stringta
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
                  
                  
                  
                  
                  
                  $tot_all_expense=$direct_exp_total+$expense_voucher_indirect+$consolidated_final_comp+$open_val;                         
                                           ?>
                                            
                                        <tr>
                                                 <td style="width:35%;font-weight: bold"> Indirect Expense <?php if($expense_voucher_indirect>0){ ?> <a href="expense_voucher.php?redirect=profit_loss_indirect" style="float: right;background-color: darkred;color: white">[View All]</a> <?php } ?> </td>
  <td style="width:35%"><?=number_format($expense_voucher_indirect+$consolidated_final_comp,$_SESSION['be_decimal'])?>  <span id="plus_btn_sup" onclick="return view_supplier();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer"> + </span><span id="minus_btn_sup" onclick="return hide_supplier();" style="float: right;background-color: darkslateblue;color: white;width: 30px;text-align: center;cursor: pointer;display: none"> - </span> </td>
                                            </tr>
                                            
                                             
                                            <tr style="display:none" id="comp_div1" >
                                                  <td style="width:35%">Indirect  </td>
                                                <td style="width:35%"><?=number_format($expense_voucher_indirect,$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                            
                                            
                                            <tr style="display:none" id="comp_div" >
                                                  <td style="width:35%">Complimentary Sale</td>
                                                <td style="width:35%"><?=number_format($consolidated_final_comp,$_SESSION['be_decimal'])?></td>
                                            <tr> 
                                            
                                             
                                                
                                            <tr>
                                                 <td style="width:35%;font-weight: bold"></td>
                                                 <td style="width:35%"></td>
                                            </tr>
                                            
                                            
                                             <tr id="profit_div1" style="display: none" >
                                                 <td style="width:35%;font-weight: bold;background-color: #83a587">PROFIT</td>
                                                 <td style="width:35%;font-weight: bold"id="profit_val_set1" ></td>
                                            </tr>
                                            
                                            
                                            <tr id="ttl_expnce">
                                                 <td style="width:35%;font-weight: bold;background-color: lightgrey"> TOTAL EXPENSE </td>
                                                 <td style="width:35%"><?=number_format($tot_all_expense,$_SESSION['be_decimal'])?></td>
                                            </tr>                             
                                             
                                            
        <?php                                      
 }
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="load_profit_loss_sale_bydate"){
    
        $string='';
        $stringta='';
       
       
	$string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND ";
       
        
        
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                         $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$_REQUEST['todt'];
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                         $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                     
                        
		}
                else
	        {
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                       
	               }
                       
                        
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
                
                  <tr>
                    <td style="width:35%"><?=$key?></td>
                   
                     <?php if(array_key_exists("DI",$val)){$each_day_final=$each_day_final+$val['DI'];$each_module_sum['DI'][]=$val['DI']; }else{ $each_module_sum['DI'][]=0; } ?>
                    <?php if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA'];$each_module_sum['TA'][]=$val['TA']; }else{ $each_module_sum['TA'][]=0; } ?>
                    <?php if(array_key_exists("CS",$val)){$each_day_final=$each_day_final+$val['CS'];$each_module_sum['CS'][]=$val['CS'];  }else{$each_module_sum['CS'][]=0;  } ?>
                   <?php if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD'];$each_module_sum['HD'][]=$val['HD']; }else{ $each_module_sum['HD'][]=0; } ?>
                    
                    <td style="width:35%"><?php $consolidated_final=$consolidated_final+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                <tr>
            <?php } }else{
                ?>
                <tr>
                    <td colspan="2" style="width:100%;text-align: center !important;color:darkred;font-weight: bold">NO SALE</td>
                  
                </tr>  
                    <?php
            } 
 }
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="loss_profit_calculator"){
     
     
        $string='';
        $stringta='';
        $string_exp='';
        $string_exp_emp='';
	      $string .=" bm_status='Closed' AND bm_complimentary!='Y'  AND ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND ";
        $string_exp_staff='';
        $string_exp_supp="  ";
        $string_stock="  ";
        $stringdi= " ";
			  $stringta1= " ";
        $string_rec="  ";
        $string_ass="  ";
        $string_supp=" ";
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
    $string_stock.=" tas_date between '".$from."' and '".$to."' ";
    $stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
    $stringta1.= " tab_dayclosedate between '".$from."' and '".$to."' ";
    $string_rec.=" tr_date between '".$from."' and '".$to."' ";
    $string_ass.=" tpd_date between '".$from."' and '".$to."' ";
    $string_supp.=" sv_date between '".$from."' and '".$to."' ";
    $stringr.=" date(tr_date) between '".$from."' and '".$to."' ";
                    
                        
                       
    // --------------------------  Direct Expense  ------------------------//            
    $expense_voucher_direct=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as tot1 from tbl_expense_voucher where ev_acc_type='Direct Expense' and $string_exp "); 
    $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
    if($num_logincpta)
    {
      while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
        { 
        $expense_voucher_direct =$expense_voucher_direct + $result_logincpta['tot1'];
        } 
    }
        
    // --------------------------  Indirect Expense  ------------------------// 
    $expense_voucher_indirect=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as tot2 from tbl_expense_voucher where ev_acc_type='Indirect Expense' and $string_exp "); 
    $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
    if($num_logincpta)
    {
      while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
        { 
        $expense_voucher_indirect =$expense_voucher_indirect + $result_logincpta['tot2'];
      } 
    }
      
    // --------------------------  Employee salary  Expense  ------------------------// 
    $salary_direct_expense=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(ev_amount) as ev_amount from tbl_employee_voucher where ev_id!='' and  $string_exp_staff group by ev_month,ev_year,ev_employee_id "); 
    $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
    if($num_logincpta)
    {
      while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
        { 
        $salary_direct_expense =$salary_direct_expense + $result_logincpta['ev_amount'];
        } 
    }
      
    // --------------------------  Supplier normal  Expense  ------------------------//      
    $supplier_indirect_expense=0;
    $sql_logincpta  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Normal' and  $string_exp_supp "); 
    $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
    if($num_logincpta)
    {
      while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
        { 
        $supplier_indirect_expense =$supplier_indirect_expense + $result_logincpta['tot4'];
        } 
    }
      
    // --------------------------  Supplier Credit  Expense  ------------------------//     
    $supplier_indirect_expense4=0;
    $sql_logincpta4  =  $database->mysqlQuery("select sum(sv_paid_amount) as tot5 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp "); 
    $num_logincpta4   = $database->mysqlNumRows($sql_logincpta4);
    if($num_logincpta4)
    {
      while($result_logincpta4  = $database->mysqlFetchArray($sql_logincpta4)) 
        { 
        $supplier_indirect_expense4 =$supplier_indirect_expense4 + $result_logincpta4['tot5'];
        } 
    }
      
    // --------------------------  Open Stock  ------------------------//       
      $open_val=0;
      $sql_login_loy1  =  $database->mysqlQuery("select sum(tas_open_stock_value) as open_stock  FROM tbl_account_stock where $string_stock "); 
    $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
    if($num_login_loy1)
    { 
      while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
        {   
            $open_val=  $open_val+$result_login_loy1['open_stock'];          
        }
    }   
      
      
      $direct_exp_total=$salary_direct_expense+$expense_voucher_direct+$supplier_indirect_expense+$supplier_indirect_expense4+$open_val;
      
   
      
       $payment_consolidated=array();
        $consolidated_final_comp=0;
        
        $each_module_sum=array();
        $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary='Y' and $stringdi  union all
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
      
      
      
      $tot_all_expense=$direct_exp_total+$expense_voucher_indirect+$consolidated_final_comp; //total expenses

      
  //----------------------Income calculation------------------------------------------------------
          
      
    // --------------------------  Dine in Sale  ------------------------//         
    $dine_sale=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster  where  $string "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
			$dine_sale =$dine_sale + $result_login['tot'];            
      } 
    } 
     
    // --------------------------  Take away Sale  ------------------------//     
    $ta_sc_hd_sale=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_netamt) as tot from tbl_takeaway_billmaster where   $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta)
    {
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale =$ta_sc_hd_sale + $result_loginta['tot'];           
      } 
    } 
 
    // --------------------------  Close Stock  ------------------------//     
    $close_val=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(tas_close_stock_value) as close_stock  FROM tbl_account_stock where $string_stock "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   			 
        $close_val=  $close_val+$result_login_loy1['close_stock'];           
      }
    }   
    // --------------------------  Indirect income   ------------------------//
    $indirect_income=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(tr_amount) as amt FROM tbl_receipts where tr_acc_type='Indirect_income' and  $string_rec ");  
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){   
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
          $indirect_income=  $indirect_income+$result_login_loy1['amt'];                               
      }
      }   
          
    // --------------------------  Dicount -asset purchase   ------------------------//
    $asset_discount=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail where tpd_type_pay='First' and  $string_ass "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1)
    {    
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
          $asset_discount=  $asset_discount+$result_login_loy1['amt'];          
      }
    }   

    // --------------------------  Dicount -Supplier    ------------------------//
    $supp_discount=0;
    $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher where sv_type_pay='First' and  $string_supp "); 
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){    
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   			 
          $supp_discount=  $supp_discount+$result_login_loy1['amt1'];          
      }
    } 
    
    //------------------------------------------------ purchase return -------------------------------------------//
    
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
 
    // --------------------------  Tax -Received    ------------------------//        
    $tax_di_all=0;
		$sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND $string  "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw)
    {
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
         
    $tax_amt=$tax_ta_all+$tax_di_all; //total tax received
          
    $total_module_sale=($dine_sale+$ta_sc_hd_sale+$close_val+$indirect_income+$asset_discount+$supp_discount+$return_amt)-$tax_amt; //total income
  
    $calc_val=0;



        if($total_module_sale>$tot_all_expense)
          {
            $calc_val=$total_module_sale-$tot_all_expense;
            echo 'profit*'.number_format($calc_val,$_SESSION['be_decimal']);
            $sql_loginta  =  $database->mysqlQuery("update tbl_account_settings set tas_profit='".$calc_val."',tas_loss='0'  ");              
            $sql_loginta  =  $database->mysqlQuery("update tbl_dayclose set dc_income='$total_module_sale', dc_expense='$tot_all_expense', dc_profit='$calc_val' where dc_day='".$_SESSION['date']."'  ");                 
          }
          else if($total_module_sale<$tot_all_expense)
          {
            $calc_val=$tot_all_expense-$total_module_sale; 
            echo 'loss*'.number_format($calc_val,$_SESSION['be_decimal']);
            $sql_loginta  =  $database->mysqlQuery("update tbl_account_settings set tas_profit='0',tas_loss='".$calc_val."'  ");               
            $sql_loginta  =  $database->mysqlQuery("update tbl_dayclose set dc_income='$total_module_sale', dc_expense='$tot_all_expense', dc_loss='$calc_val' where dc_day='".$_SESSION['date']."'  ");                 
          }
          else if($total_module_sale==$tot_all_expense)
          {
            echo 'equal*0';
            $sql_loginta  =  $database->mysqlQuery("update tbl_account_settings set tas_profit='0',tas_loss='0'  ");   
          }
          else if($total_module_sale==0 && $tot_all_expense==0)
          {
            echo 'zero*0';
            $sql_loginta  =  $database->mysqlQuery("update tbl_account_settings set tas_profit='0',tas_loss='0'  ");  
          }
          else
          {
              echo 'invalid';
          }   
 }
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="bank_acc_load"){
 
     $string='';
     $string1='';
     $string2='';
     $string3='';
             
          $stringta='';
        $stringdi='';
        
         $stringdi .=" bm_status='Closed' AND bm_complimentary!='Y'  AND  ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND "; 
        
        $string_rec='';
       $string_as='';	
       $string_con5='';
       $string_adv_loan='';
        $string_crd_new1=" ";
        $stringr='';
      if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and  ts.ev_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string3.= " and tes.ev_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         
                         $stringdi.= " bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
			$stringta.= " tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
                         $string_as.= " and tpd_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_rec.= " and tr_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_con5.= " and cv_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";    
                         $string_crd_new1.=" cdp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' "; 
                         $string_adv_loan.= "  tla_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' "; 
                          $stringr.=" and date(tp.tr_date)  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        $string1.= " and  ts.ev_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          $string3.= " and tes.ev_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          
                          $stringdi.= " bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
                         $string_as.= " and tpd_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         
                         $string_rec.= " and tr_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_con5.= " and cv_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";    
                          $string_crd_new1.=" cdp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_adv_loan.= "  tla_date  between '".$_REQUEST['fromdt']."' and '".$to."' "; 
                         
                         $stringr.=" and date(tp.tr_date)  between '".$_REQUEST['fromdt']."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and ts.sv_date between '".$from."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and ts.ev_date between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$from."' and '".$_REQUEST['todt']."' ";
                          $string3.= " and tes.ev_date between '".$from."' and '".$_REQUEST['todt']."' ";
                          
                          $stringdi.= " bm_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                           $string_as.= " and tpd_date  between '".$from."' and '".$_REQUEST['todt']."' ";
                           
                       $string_con5.= " and cv_date  between '".$from."' and '".$_REQUEST['todt']."' ";    
                           $string_rec.= " and tr_date  between '".$from."' and '".$_REQUEST['todt']."' ";
                          $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";  
                            $string_adv_loan.= "  tla_date  between '".$from."' and '".$_REQUEST['todt']."' "; 
                            $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$_REQUEST['todt']."' ";
		}else
	        {
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
                        
                        
                        $string.= " and ts.sv_date between '".$from."' and '".$to."' ";
                        $string1.= " and ts.ev_date between '".$from."' and '".$to."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$from."' and '".$to."' ";
                          $string3.= " and tes.ev_date between '".$from."' and '".$to."' ";
                        
                        
			$stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $string_as.= " and tpd_date  between '".$from."' and '".$to."' ";
                        
                        $string_con5.= " and cv_date  between '".$from."' and '".$to."' ";
                        $string_rec.= " and tr_date  between '".$from."' and '".$to."' ";
                         $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                        $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$to."' ";
                         $string_adv_loan.= "  tla_date  between '".$from."' and '".$to."' "; 
	               }
     
     $all_in_cash1=0;

      $fnct_menu3 = $database->mysqlQuery("select *  from tbl_ledger_master where tlm_type='Bank_account'  ");
      $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
        if ($num_fdtl3 > 0) {
              while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
              {                 
                   $string678='';
                if($_REQUEST['fromdt']!="")
		            { 
	                $string678.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";                      
		            }
                else{
                    $from=date("Y-m-d");
                    $string678.= "   tps_dayclosedate = '".$from."'  ";
                }
                
                $yes_open=0;
                                    
          $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
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
          $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$result_fnctvenue3['tlm_id']."'"); 
					$num_login   = $database->mysqlNumRows($sql_login);
        
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                    
                                          $yes_open=  $result_login['tlm_open_bal'];
                                            
                                         }} 
                                         
                                        }
                  
                                        
                   /////bank sale////
          
          
          
    $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster left join tbl_bankmaster on bm_id=bm_transcbank left join tbl_ledger_master  on tlm_id=bm_account     where tlm_id='".$result_fnctvenue3['tlm_id']."' and  bm_paymode='2' and   $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ 
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
			$dine_sale_card =$dine_sale_card + $result_login['tot'];             
          } } 
          
          $ta_sc_hd_sale_card=0;
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster left join tbl_bankmaster on bm_id=tab_transcbank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  tab_paymode='2' and  $stringta"); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 	
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];                     
          } } 
          
          $total_module_sale_card=$dine_sale_card+$ta_sc_hd_sale_card;
                  
                 
          
          $credit_card=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment left join tbl_bankmaster on bm_id=cdp_bank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			$credit_card =$credit_card + $result_logincpta['tot'];
           }} 
           
                  
                  
                  
                  
                  $loan_minus2=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id    where tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and  tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];
                      
          } } 
                  
                
          
          
          $asset_discount_bank=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and tpd_type_pay='First'   $string_as "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
        $asset_discount_bank=  $asset_discount_bank+$result_login_loy1['amt'];
                      
                      
          }
          }   







     $supp_discount_bank=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where  ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $string "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
                      
                      
          }
          }   
          
          
          
          
                  
                  $loan_advance_bank=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and    $string_adv_loan  "); 
 $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan_advance_bank =$loan_advance_bank + $result_logincpta34['netamt'];
                        
                        
          } }           
                  
                  
                  
                  
  $bank_receipt=0;
  $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and  tm.tlm_type='Bank_account' $string_rec  "); 
  $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			$bank_receipt =$bank_receipt + $result_logincpta34['netamt'];           
      } }       
                  
      $bank_receipt_from=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_from=tm.tlm_id  where tr.tr_from='".$result_fnctvenue3['tlm_id']."' and  tm.tlm_type='Bank_account' $string_rec  "); 
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
      if($num_logincpta34){
      while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
        { 
        $bank_receipt_from =$bank_receipt_from + $result_logincpta34['netamt'];           
        } 
      }                     
                  
                  
                  
                  
                  $tot_contra1=0;    
           $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
                                        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
                  
                                        }}   
                  
              $tot_contra=0;    
           $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
          while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          
          $tot_contra=$tot_contra+$result_login['cv_amount'];
                  
                                        }}
                  
                  
            $tot_supplier_asset=0;
           $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_as "); 
	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){
                                           
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{ 
          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
                                        }}
                                        
                                        
                     
                                        
            $tot_supplier=0;
           $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $string "); 
          $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
                                        
                                        }}    
                                        
                                        
                                        
                                        
                                        
               $tot_employee=0; 
           $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1 "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
                                           
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
                                        }}
                                        
                       
                                        
                                        
                                        
                  $tot_direct=0; 
           $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3 "); 
	
           $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){
                                      
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
                                        
                                        }}        
                                        
                
                                        
                                        
                $tot_indirect=0; 
           $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3"); 
	
           $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){
                                            
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
         
         $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         
                                        }}
                                        
                   $supplier_return_bank=0;
          
          $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr1 from tbl_return_payment tp left join tbl_ledger_master tm on tm.tlm_id=tp.tr_to_acc     where tp.tr_to_acc='".$result_fnctvenue3['tlm_id']."'  $stringr  "); 
        $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	  if($num_logincpta1){
		  while($result_logincpta19  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 
			
			$supplier_return_bank =$supplier_return_bank + $result_logincpta19['totr1'];
          } }   
            
                                        
                                        
                                        
                                        
        $all_in_cash=$yes_open-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect-$tot_contra1);
                  
        
        $all_in_cash1=$all_in_cash1+$all_in_cash;

    
     
                  ?>
              
                                          
       <tr>
       <td style="width:35%;"><?=$result_fnctvenue3['tlm_ledger_name']?> </td>
       <td style="width:35%"><?=number_format(($supplier_return_bank+$all_in_cash+$bank_receipt+$loan_minus2+$supp_discount_bank+$asset_discount_bank+$total_module_sale_card+$credit_card)-($loan_advance_bank+$bank_receipt_from),$_SESSION['be_decimal'])?>
       </td>
       </tr>
                                            
        <?php } } 
                                            
                                            
                                            }
 else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="cash_acc_load"){
 
     $string='';
           $string1='';
            $string2='';
             $string3='';
             
          $stringta='';
        $stringdi='';
        
        $stringdi .=" bm_status='Closed' AND bm_complimentary!='Y'  AND  ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND "; 
        
       $string_as='';	
       $string_con5='';
       $string_rec= "  ";
       $string_adv_loan='';
        $string_crd_new1=" ";
        $stringr='';
      if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and  ts.ev_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string3.= " and tes.ev_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         
                         $stringdi.= " bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
			$stringta.= " tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_crd_new1.=" cdp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_as.= " and tpd_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_rec.= " and tr_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string_con5.= " and cv_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";    
                         $string_adv_loan.= "  tla_date  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' "; 
                         $stringr.=" and date(tp.tr_date)  between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
		}
                
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        $string1.= " and  ts.ev_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          $string3.= " and tes.ev_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          
                          $stringdi.= " bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_crd_new1.=" cdp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_as.= " and tpd_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_adv_loan.= "  tla_date  between '".$_REQUEST['fromdt']."' and '".$to."' "; 
                         $string_rec.= " and tr_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string_con5.= " and cv_date  between '".$_REQUEST['fromdt']."' and '".$to."' ";   
                         $stringr.=" and date(tp.tr_date)  between '".$_REQUEST['fromdt']."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and ts.sv_date between '".$from."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and ts.ev_date between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$from."' and '".$_REQUEST['todt']."' ";
                          $string3.= " and tes.ev_date between '".$from."' and '".$_REQUEST['todt']."' ";
                          
                          $stringdi.= " bm_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                           $string_as.= " and tpd_date  between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";   
                       $string_con5.= " and cv_date  between '".$from."' and '".$_REQUEST['todt']."' ";    
                          $string_rec.= " and tr_date  between '".$from."' and '".$_REQUEST['todt']."' "; 
                           $string_adv_loan.= "  tla_date  between '".$from."' and '".$_REQUEST['todt']."' "; 
                           $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$_REQUEST['todt']."' ";
		}else
	        {
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
                        
                        
                        $string.= " and ts.sv_date between '".$from."' and '".$to."' ";
                        $string1.= " and ts.ev_date between '".$from."' and '".$to."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$from."' and '".$to."' ";
                          $string3.= " and tes.ev_date between '".$from."' and '".$to."' ";
                        
                        
			$stringdi.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $string_as.= " and tpd_date  between '".$from."' and '".$to."' ";
                        
                        $string_con5.= " and cv_date  between '".$from."' and '".$to."' ";
                         $string_crd_new1.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                         $string_adv_loan.= "  tla_date  between '".$from."' and '".$to."' "; 
                        $string_rec.= " and tr_date  between '".$from."' and '".$to."' ";
                        $stringr.=" and date(tp.tr_date)  between '".$from."' and '".$to."' ";
	               }
     
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
                                    
          $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$result_fnctvenue3['tlm_id']."' "); 
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
                  
                  
                  
                  
                   $credit_cash=0;
           $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$credit_cash =$credit_cash + $result_logincpta['tot'];
           }} 
                   
                  
                        /////cash sale ////
        
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
                 
                  
                  
                  
                 
          $asset_discount_cash=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and tpd_type_pay='First'   $string_as "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $asset_discount_cash=  $asset_discount_cash+$result_login_loy1['amt'];
                      
                      
          }
          }   



$supp_discount_cash=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id where ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account' and ts.sv_type_pay='First'   $string "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount_cash=  $supp_discount_cash+$result_login_loy1['amt1'];
                      
                      
          }
          }  
                  
                  
                  
                  
                  $loan_minus2=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where  tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and  tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];
                      
          } } 
                  
                  
                  $loan_advance_cash=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and    $string_adv_loan  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan_advance_cash =$loan_advance_cash + $result_logincpta34['netamt'];
                        
                        
          } }       
                  
                  
                  
                  $cash_receipt=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account'  $string_rec "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$cash_receipt =$cash_receipt + $result_logincpta34['netamt12'];
                        
                        
          } }         
                  
      $cash_receipt_from=0;
      $sql_receipt_from  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_from=tm.tlm_id  where tr.tr_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account'  $string_rec "); 
      $num_receipt_from   = $database->mysqlNumRows($sql_receipt_from);
   if($num_receipt_from){
     while($result_receipt_from = $database->mysqlFetchArray($sql_receipt_from)) 
     { 
     $cash_receipt_from =$cash_receipt_from + $result_receipt_from['netamt12'];            
         } }        
      


                  
                  $tot_contra1=0;    
           $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
                                        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
                  
                                        }}   
                  
              $tot_contra=0;    
           $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
                                        while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          
          $tot_contra=$tot_contra+$result_login['cv_amount'];
                  
                                        }}
                  
                  
            $tot_supplier_asset=0;
           $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_as "); 
	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){
                                           
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{ 
          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
                                        }}
                                        
                                        
                     
                                        
            $tot_supplier=0;
           $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $string "); 
	//echo "select * from tbl_supplier_voucher ts left join tbl_ledger_master tm  on ts.sv_vendor_id=tm.tlm_vendor_id where tm.tlm_id='".$_REQUEST['acc']."' and tm.tlm_group='".$_REQUEST['grp']."' $string ";
           $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
                                        
                                        }}    
                                        
                                        
                                        
                                        
                                        
               $tot_employee=0; 
           $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1 "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
                                           
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
                                        }}
                                        
                       
                                        
                                        
                                        
                  $tot_direct=0; 
           $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3 "); 
	
           $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){
                                      
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
                                        
                                        }}        
                                        
                
                                        
                                        
                $tot_indirect=0; 
           $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3"); 
	
           $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){
                                            
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
         
         $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         
                                        }}
                                        
                                        
                                        
               $supplier_return_cash=0;
           
           $sql_logincpta1  =  $database->mysqlQuery("select sum(tr_return_amount) as totr from tbl_return_payment tp left join tbl_ledger_master tm on tm.tlm_id=tp.tr_to_acc  where tp.tr_to_acc='".$result_fnctvenue3['tlm_id']."'  $stringr  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	  if($num_logincpta1){
		  while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 
			
			$supplier_return_cash =$supplier_return_cash + $result_logincpta1['totr'];
          } }                            
                                        
                                        
                                        
        $all_in_cash=$yes_open-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect-$tot_contra1);
                  
        
        $all_in_cash1=$all_in_cash1+$all_in_cash;
     
                  ?>
              
                                          
                                                <tr>
                                                
                                                 <td style="width:35%;"><?=$result_fnctvenue3['tlm_ledger_name']?>  </td>
                                                 <td style="width:35%"><?=number_format(($supplier_return_cash+$total_module_sale_cash+$all_in_cash+$cash_receipt+$loan_minus2+$credit_cash)-($loan_advance_cash+$cash_receipt_from) ,$_SESSION['be_decimal'])?>
                                                 
                              
                                                 
                                                 </td>
                                           
                                                </tr>
                                            
                                           <tr>
                                                
                                                 <td style="width:35%;"> </td>
                                                 <td style="width:35%">
                                                 
                              
                                                 
                                                 </td>
                                           
                                                </tr>
                                            <?php } } 
                                            
                                            
                                            }
    
    else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="list_account_heads"){
    $string='';
        
        if($_REQUEST['group']!=''){
            $string.=" and tlg_name like '%".$_REQUEST['group']."%'  ";
        }
        
        if($_REQUEST['type_of_group']!=''){
            $string.="and  tlg_group_type = '".$_REQUEST['type_of_group']."'  ";
        }
                
         if($_REQUEST['type_of_exp_inc']!=''){
            $string.=" and tlg_exp_inc_type = '".$_REQUEST['type_of_exp_inc']."'  ";
        }        
        
      
        $i=0;
        $sql_login  =  $database->mysqlQuery("select tlg_id,tlg_status,tlg_name,tlg_group_type,tlg_exp_inc_type from tbl_ledger_group where 1 $string "); 
 $num_login   = $database->mysqlNumRows($sql_login);
if($num_login){
while($result_login  = $database->mysqlFetchArray($sql_login)) 
{ $i++;            
    if($result_login['tlg_status']=='Y'){
        $sts='Active';
    }else{
        $sts='Inactive'; 
    }
            
    ?>   
    <tr>
         <td style="width:10%"><?=$i?></td>
        <td style="width:30%;text-transform: uppercase"><?=$result_login['tlg_name']?></td>
        
          <td style="width:18%;text-transform: uppercase"><?=$result_login['tlg_group_type']?></td>
          
           <td style="width:18%;text-transform: uppercase"><?=$result_login['tlg_exp_inc_type']?></td>
           
          <td style="width:18%;text-transform: uppercase"><?=$sts?></td>
          
        <td  style="width:25%" onclick="edit_group('<?=$result_login['tlg_name']?>','<?=$result_login['tlg_group_type']?>','<?=$result_login['tlg_status']?>','<?=$result_login['tlg_id']?>','<?=$result_login['tlg_exp_inc_type']?>')" style="width:25%;cursor:pointer;"><a> <div class="action_button printer_delete"><i class="glyphicon glyphicon-pencil"></i></div></a></td>
    </tr>
    <?php } } 
    
    
}



    else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="serach_acc_name"){
    $string='';
        
        if($_REQUEST['acc_name']!=''){
            $string.=" and  tlm_ledger_name like '%".$_REQUEST['acc_name']."%'  ";
        }
        
        if($_REQUEST['acc_group']!=''){
            $string.=" and  tlm_group = '".$_REQUEST['acc_group']."'  ";
        }
                
         if($_REQUEST['type']!=''){
            $string.=" and  tlm_type = '".$_REQUEST['type']."'  ";
        }        
        
     $i=0;
          $sql_login  =  $database->mysqlQuery("select tlm_id,tlg_id,tlm_ledger_name,tlg_name,tlm_type,tlm_open_bal,tlm_type,tlm_capital_cb from tbl_ledger_master left join tbl_ledger_group on tlg_id=tlm_group where tlm_ledger_name!='' $string order by tlm_ledger_name asc "); 
					$num_login   = $database->mysqlNumRows($sql_login);
          
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ $i++;?>   
          <tr>
              <td style="min-width:10px;max-width:10px"><?=$i?></td>
              <td style="min-width:25px;max-width:25px;text-transform: uppercase"><?=$result_login['tlm_ledger_name']?></td>
              <td style="min-width:25px;max-width:25px;text-transform: uppercase"><?=$result_login['tlg_name']?></td>
              <td style="min-width:25px;max-width:25px;"><?=$result_login['tlm_type']?></td>
              <td style="min-width:25px;max-width:25px;text-transform: uppercase"><?=$result_login['tlm_open_bal']?></td>
              <td   onclick="edit_ledger('<?=$result_login['tlm_ledger_name']?>','<?=$result_login['tlg_id']?>','<?=$result_login['tlm_id']?>','<?=$result_login['tlm_open_bal']?>','<?=$result_login['tlm_type']?>','<?=$result_login['tlm_capital_cb']?>');" style="min-width:15px;max-width:15px"><a href="#" > <div class="action_button printer_delete"><i class="glyphicon glyphicon-pencil"></i></div></a></td>
          </tr>
          <?php } } 
    
    
}
  else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="cap_acc_load"){
      
      
     
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
      
  }else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="opening_balance_calculation"){
 
           $string='';
           $string1='';
            $string2='';
             $string3='';
             
          $stringta='';
        $stringdi='';
        
         $stringdi .=" bm_status='Closed' AND bm_complimentary!='Y'  AND  ";
        $stringta .=" tab_status='Closed'  AND tab_complimentary!='Y'  AND "; 
        
        $string_rec='';
       $string_as='';	
       $string_con5='';
       $string_adv_loan='';
        $string_crd_new1=" ";
      if($_REQUEST['date']!='')
		{
			$string.= " and  ts.sv_date between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                        $string1.= " and  ts.ev_date between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                         $string2.= " and  date(tes.tes_entrydate) between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                         $string3.= " and tes.ev_date between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                         
                         $stringdi.= " bm_dayclosedate between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
			$stringta.= " tab_dayclosedate between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                        
                         $string_as.= " and tpd_date  between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                         $string_rec.= " and tr_date  between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";
                         $string_con5.= " and cv_date  between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' ";    
                         $string_crd_new1.=" cdp_dayclosedate between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' "; 
                         $string_adv_loan.= "  tla_date  between '".$_REQUEST['date']."' and '".$_REQUEST['date']."' "; 
		}
		
		
	        
     
     $all_in_cash1=0;
$yes_open=0;
         $fnct_menu3 = $database->mysqlQuery("select tlm_id from tbl_ledger_master where tlm_type='Bank_account' and tlm_id='".$_REQUEST['ledger']."'   ");
         $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
        if ($num_fdtl3 > 0) {
              while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
              {

                    $yes_open=$_REQUEST['open'];
                                    
//                                   $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//                                  
//                                            
//                                            $maxid='';                       
//                $sql_desg_nos3="select max(tps_id) as id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' ";
// 
//		$sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
//		$num_desg3  = $database->mysqlNumRows($sql_desg3);
//		if($num_desg3)
//		{
//			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
//				{
//                           
//                           $maxid= $result_desg3['id'];
//                            
//                }}
//                                            
//                                          $sql_login  =  $database->mysqlQuery("select tps_closing_balance  from tbl_ledger_setting where tps_id='$maxid' and  tps_ledger_id='".$_REQUEST['ledger']."' and  tps_dayclosedate != '".$_REQUEST['date']."' "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//					while($result_login  = $database->mysqlFetchArray($sql_login)) 
//					{ 
//                                    
//                                          $yes_open=  $result_login['tps_closing_balance'];
//                                            
//                                         }} 
//                                            
//                                        }else{
//                                 
//                                           
//                                          $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_master where tlm_id='".$_REQUEST['ledger']."'  "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//					while($result_login  = $database->mysqlFetchArray($sql_login)) 
//					{ 
//                                    
//                                          $yes_open=  $result_login['tlm_open_bal'];
//                                            
//                                         }} 
//                                         
//                                        }
                  
                  
                  
                  
                  
                  
                   /////bank sale////
          
          
          
          $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster left join tbl_bankmaster on bm_id=bm_transcbank left join tbl_ledger_master  on tlm_id=bm_account     where tlm_id='".$result_fnctvenue3['tlm_id']."' and  bm_paymode='2' and   $stringdi "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
				
			$dine_sale_card =$dine_sale_card + $result_login['tot'];
                        
          } } 
          
          $ta_sc_hd_sale_card=0;
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster left join tbl_bankmaster on bm_id=tab_transcbank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  tab_paymode='2' and  $stringta"); 
 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];
                      
          } } 
          
          $total_module_sale_card=$dine_sale_card+$ta_sc_hd_sale_card;
                  
                 
          
          $credit_card=0;
           $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment left join tbl_bankmaster on bm_id=cdp_bank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tlm_id']."' and  $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$credit_card =$credit_card + $result_logincpta['tot'];
           }} 
           
                  
                  
                  
                  
                  $loan_minus2=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id    where tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and  tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];
                      
          } } 
                  
                
          
          
          $asset_discount_bank=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and tpd_type_pay='First'   $string_as "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $asset_discount_bank=  $asset_discount_bank+$result_login_loy1['amt'];
                      
                      
          }
          }   







     $supp_discount_bank=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where  ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Bank_account' and ts.sv_type_pay='First'   $string "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
                      
                      
          }
          }   
          
          
          
          
                  
                  $loan_advance_bank=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Bank_account' and    $string_adv_loan  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan_advance_bank =$loan_advance_bank + $result_logincpta34['netamt'];
                        
                        
          } }           
                  
                  
                  
                  
                  $bank_receipt=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and  tm.tlm_type='Bank_account'    $string_rec  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$bank_receipt =$bank_receipt + $result_logincpta34['netamt'];
                        
                        
          } }       
                  
                  
                  
                  
                  
                  
                  $tot_contra1=0;    
           $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
                                        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
                  
                                        }}   
                  
              $tot_contra=0;    
           $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
                                        while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          
          $tot_contra=$tot_contra+$result_login['cv_amount'];
                  
                                        }}
                  
                  
            $tot_supplier_asset=0;
           $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_as "); 
	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){
                                           
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{ 
          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
                                        }}
                                        
                                        
                     
                                        
            $tot_supplier=0;
           $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $string "); 
	//echo "select * from tbl_supplier_voucher ts left join tbl_ledger_master tm  on ts.sv_vendor_id=tm.tlm_vendor_id where tm.tlm_id='".$_REQUEST['acc']."' and tm.tlm_group='".$_REQUEST['grp']."' $string ";
           $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
                                        
                                        }}    
                                        
                                        
                                        
                                        
                                        
               $tot_employee=0; 
           $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1 "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
                                           
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
                                        }}
                                        
                       
                                        
                                        
                                        
                  $tot_direct=0; 
           $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3 "); 
	
           $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){
                                      
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
                                        
                                        }}        
                                        
                
                                        
                                        
                $tot_indirect=0; 
           $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3"); 
	
           $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){
                                            
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
         
         $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         
                                        }}
                                        
                                        
                                        
        $all_in_cash=$yes_open-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect-$tot_contra1);
                  
        
        $all_in_cash1=$all_in_cash1+$all_in_cash;
     
        
        $bankall=($all_in_cash+$bank_receipt+$loan_minus2+$supp_discount_bank+$asset_discount_bank+$total_module_sale_card+$credit_card)-$loan_advance_bank;
       echo number_format($bankall,$_SESSION['be_decimal']);
                  
                                    
                                         } } 
                        
                           
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
                                         
         //////////////////cash account/////////////
     
     $all_in_cash1=0;

         $fnct_menu3 = $database->mysqlQuery("select tlm_id  from tbl_ledger_master where tlm_type='Cash_account' and tlm_id='".$_REQUEST['ledger']."'  ");
         $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
        if ($num_fdtl3 > 0) {
              while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
              {
                  

                    $yes_open1=0;
                    
                    $yes_open1=$_REQUEST['open'];
                    
                                    
//                                   $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//                                  
//                                            
//                                            $maxid='';                       
//                $sql_desg_nos3="select max(tps_id) as id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' ";
// 
//		$sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
//		$num_desg3  = $database->mysqlNumRows($sql_desg3);
//		if($num_desg3)
//		{
//			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
//				{
//                           
//                           $maxid= $result_desg3['id'];
//                            
//                }}
//                ?>
                                        
                                        
                                        
                                        <?php
//                                             
//                                          $sql_login  =  $database->mysqlQuery("select tps_closing_balance  from tbl_ledger_setting where tps_id='$maxid' and  tps_ledger_id='".$_REQUEST['ledger']."' "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//					while($result_login  = $database->mysqlFetchArray($sql_login)) 
//					{ 
//                                    
//                                          $yes_open1=  $result_login['tps_closing_balance'];
//                                            
//                                         }} 
//                                            
//                                        }else{
//                                 
//                                           
//                                          $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_master where tlm_id='".$_REQUEST['ledger']."'  "); 
//					$num_login   = $database->mysqlNumRows($sql_login);
//					if($num_login){
//					while($result_login  = $database->mysqlFetchArray($sql_login)) 
//					{ 
//                                    
//                                          $yes_open1=  $result_login['tlm_open_bal'];
//                                            
//                                         }} 
//                                         
//                                        }
                  
                  
                  
                   $credit_cash=0;
           $sql_logincpta  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot from tbl_credit_details_payment where $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			
			$credit_cash =$credit_cash + $result_logincpta['tot'];
           }} 
                   
                  
                        /////cash sale ////
        
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
                 
                  
                  
                  
                 
          $asset_discount_cash=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and tpd_type_pay='First'   $string_as "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $asset_discount_cash=  $asset_discount_cash+$result_login_loy1['amt'];
                      
                      
          }
          }   



$supp_discount_cash=0;
         $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id where ts.sv_from='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account' and ts.sv_type_pay='First'   $string "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $supp_discount_cash=  $supp_discount_cash+$result_login_loy1['amt1'];
                      
                      
          }
          }  
                  
                  
                  
                  
                  $loan_minus2=0;
          $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id  where  tla_to='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and  tla_type='Loan' and  $string_adv_loan"); 
 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 
				
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];
                      
          } } 
                  
                  
                  $loan_advance_cash=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tlm_id']."' and tlm_type='Cash_account' and    $string_adv_loan  "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$loan_advance_cash =$loan_advance_cash + $result_logincpta34['netamt'];
                        
                        
          } }       
                  
                  
                  
                  $cash_receipt=0;
           $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt12 from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tlm_id']."' and tm.tlm_type='Cash_account'  $string_rec "); 
	// echo "select sum(sv_paid_amount) as tot4 from tbl_supplier_voucher where sv_entry_type='Credit' and  $string_exp_supp ";
           $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			
			$cash_receipt =$cash_receipt + $result_logincpta34['netamt12'];
                        
                        
          } }         
                  
                  
                  
                  $tot_contra1=0;    
           $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login4575   = $database->mysqlNumRows($sql_login4575);
					if($num_login4575){
                                        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{ 
          
          $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
                  
                                        }}   
                  
              $tot_contra=0;    
           $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_con5 "); 
	   $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
                                        while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          
          $tot_contra=$tot_contra+$result_login['cv_amount'];
                  
                                        }}
                  
                  
            $tot_supplier_asset=0;
           $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tlm_id']."'  $string_as "); 
	
           $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){
                                           
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{ 
          
          $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
                                        }}
                                        
                                        
                     
                                        
            $tot_supplier=0;
           $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tlm_id']."'  $string "); 
	//echo "select * from tbl_supplier_voucher ts left join tbl_ledger_master tm  on ts.sv_vendor_id=tm.tlm_vendor_id where tm.tlm_id='".$_REQUEST['acc']."' and tm.tlm_group='".$_REQUEST['grp']."' $string ";
           $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
                                            
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          
          $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
                                        
                                        }}    
                                        
                                        
                                        
                                        
                                        
               $tot_employee=0; 
           $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tlm_id']."'  $string1 "); 
	
           $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){
                                           
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
                                        }}
                                        
                       
                                        
                                        
                                        
                  $tot_direct=0; 
           $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'  $string3 "); 
	
           $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){
                                      
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{ 
         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
                                        
                                        }}        
                                        
                
                                        
                                        
                $tot_indirect=0; 
           $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tlm_id']."'   $string3"); 
	
           $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){
                                            
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{ 
         
         $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         
                                        }}
                                        
                                        
                                        
        $all_in_cash=$yes_open1-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect-$tot_contra1);
                  
        
        $all_in_cash1=$all_in_cash1+$all_in_cash;
     
        
        $cash_all=($total_module_sale_cash+$all_in_cash+$cash_receipt+$loan_minus2+$asset_discount_cash+$supp_discount_cash+$credit_cash)-$loan_advance_cash;
        echo number_format($cash_all,$_SESSION['be_decimal']);
            
                                        } } 
                                            
                                            
  }
  

  else if(isset($_REQUEST['set']) && $_REQUEST['set']=="open_ledger_daywise")
   {
       error_reporting(0);
       $dates=array();
       $ledgers = array();    
      
      ///updating openclose/// 
       $first_day='';

     
       if(isset($_REQUEST['date']))
       {
        $date=$_REQUEST['date'];
        $date_exist=  $database->mysqlQuery("select tps_dayclosedate from tbl_ledger_setting  where tps_dayclosedate='".$date."'"); 
        $num_exist   = $database->mysqlNumRows($date_exist);

        if($num_exist>0){
      
        while($result_exist  = $database->mysqlFetchArray($date_exist)) 
        { 
            $first_day=$result_exist['tps_dayclosedate'];             
        }}
      
       else{
     
                                        $sql_login4  =  $database->mysqlQuery("select be_accounts_start_date as first_day from tbl_branchmaster "); 

					$num_login4   = $database->mysqlNumRows($sql_login4);
         
					if($num_login4>0){

					while($result_login4  = $database->mysqlFetchArray($sql_login4)) 
					{ 
                                            
                                             $first_day=$result_login4['first_day'];             
                                        }}

          
        }
      }
        
      
    $current_day=date('Y-m-d');
                                
    $period = new DatePeriod(new DateTime($first_day), new DateInterval('P1D'), new DateTime($current_day.' +1 day'));

    foreach ($period as $date) 
    {
        $dates[] = $date->format("Y-m-d");
    } 
    

                                        $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_open_bal from tbl_ledger_master "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login)
                                        {
					while($result_login5  = $database->mysqlFetchArray($sql_login)) 
					{   
                                             $ledgers[]=$result_login5['tlm_id'];
                                        }
                                        }                         
                                                                             
        for($i=0;$i<=count($dates);$i++){
                          
        for($ii=0;$ii<=count($ledgers);$ii++){
                              
        $sql_login6  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$ledgers[$ii]."' and tps_dayclosedate='$dates[$i]' and tps_open_bal_updated='Y' "); 
	$num_login6   = $database->mysqlNumRows($sql_login6);

	if($num_login6)
        {
        $sql_login_q  =  $database->mysqlQuery("SELECT tps_ledger_id,tps_closing_balance FROM tbl_ledger_setting WHERE tps_ledger_id='".$ledgers[$ii]."'  and tps_dayclosedate < '$dates[$i]' and tps_open_bal_updated='Y' ORDER BY ABS(DATEDIFF(tps_dayclosedate, NOW())) ASC LIMIT 1  "); 
        $num_login  = $database->mysqlNumRows($sql_login_q);
       
        if($num_login)    //-------previous day data exist----//
        {   
	   while($result_login  = $database->mysqlFetchArray($sql_login_q)) 
	   {
             $sql_login6  =  $database->mysqlQuery("update tbl_ledger_setting set tps_ledger_open_bal='".$result_login['tps_closing_balance']."' where tps_ledger_id='".$result_login['tps_ledger_id']."' and tps_dayclosedate='$dates[$i]' ");                                 
           }
        }  
          
        else {           //-------previous day data not-exist----//
         
          $sql_open_bal = $database->mysqlQuery("select tlm_id,tlm_open_bal from tbl_ledger_master where tlm_id='".$ledgers[$ii]."'"); 

          $num_open_bal  = $database->mysqlNumRows($sql_open_bal);
          if($num_open_bal)
          {   
            while($result_open_bal  = $database->mysqlFetchArray($sql_open_bal)) 
            { 
               $sql_up_bal  =  $database->mysqlQuery("update tbl_ledger_setting set tps_ledger_open_bal='".$result_open_bal['tlm_open_bal']."' where tps_ledger_id='".$result_open_bal['tlm_id']."' and tps_dayclosedate='$dates[$i]' ");                                 
            }
            }
          
          
          
        }

    }else{
     
    //--------------inserting------------//
        
    $sql_login8  =  $database->mysqlQuery("select tlm_open_bal,tlm_id from tbl_ledger_master "); 
    $num_login8   = $database->mysqlNumRows($sql_login8);  
		if($num_login8){

		while($result_login9  = $database->mysqlFetchArray($sql_login8)) 
		{  
                    
        $insertion['tps_ledger_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$result_login9['tlm_id']);
        $insertion['tps_ledger_open_bal'] 		=  mysqli_real_escape_string($database->DatabaseLink,$result_login9['tlm_open_bal']);
        $insertion['tps_dayclosedate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$dates[$i]);
        $insertion['tps_closing_balance'] 		=  mysqli_real_escape_string($database->DatabaseLink,$result_login9['tlm_open_bal']);
        $insertion['tps_open_bal_updated'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Y');
        $sql=$database->check_duplicate_entry('tbl_ledger_setting',$insertion);

	 if($sql!=1)
	 {

	   $insertid =  $database->insert('tbl_ledger_setting',$insertion);  

         }      
                 }}
                 
                 
                  }
                    }
                      }   
  }
  
  else if(isset($_REQUEST['set']) && $_REQUEST['set']=="close_ledger_daywise")
  {

        error_reporting(0);
      
        $string='';
        $string1='';
        $string2='';
        $string3='';            
        $stringta='';
        $stringdi='';        
        $string_rec='';
        $string_as='';	
        $string_con5='';
        $string_adv_loan='';
        $string_crd_new1=" ";
     
      $yes_open=0;

      $dates=array();
      $ledgers = array(); 
      $ledgers_type=array();   
  
          
          if(isset($_REQUEST['date']))
          {
           $date=$_REQUEST['date'];
           $date_exist=  $database->mysqlQuery("select tps_dayclosedate from tbl_ledger_setting  where tps_dayclosedate='".$date."'"); 
           $num_exist   = $database->mysqlNumRows($date_exist);
           if($num_exist){
           while($result_exist  = $database->mysqlFetchArray($date_exist)) 
           { 
               $first_day=$result_exist['tps_dayclosedate'];             
           }}
         
          else{
              
             $sql_login4  =  $database->mysqlQuery("select be_accounts_start_date as first_day from tbl_branchmaster "); 
   
             $num_login4   = $database->mysqlNumRows($sql_login4);
             if($num_login4){
             while($result_login4  = $database->mysqlFetchArray($sql_login4)) 
             { 
                 $first_day=$result_login4['first_day'];             
             }}
             
           }
           
          }
          
    $current_day=date('Y-m-d');
                
    $period = new DatePeriod(new DateTime($first_day), new DateInterval('P1D'), new DateTime($current_day.' +1 day'));
    foreach ($period as $date) {
        $dates[] = $date->format("Y-m-d");
    }           
       
   
          $sql_login  =  $database->mysqlQuery("select tlm_type,tlm_id from tbl_ledger_master"); 
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login){
	  while($result_login5  = $database->mysqlFetchArray($sql_login)) 
	  {   
              $ledgers[]=$result_login5['tlm_id'];
              $ledgers_type[]=$result_login5['tlm_type'];
          }
          }                         
                                                            
              for($i=0;$i<=count($dates);$i++){
                          
                         $stringdi =" bm_status='Closed' AND bm_complimentary!='Y'  AND  ";
                         $stringta =" tab_status='Closed'  AND tab_complimentary!='Y'  AND "; 
                         $string= " and  ts.sv_date = '".$dates[$i]."'";
                         $string1= " and  ts.ev_date = '".$dates[$i]."'  ";
                         $string2= " and  date(tes.tes_entrydate) = '".$dates[$i]."'  ";
                         $string3= " and tes.ev_date = '".$dates[$i]."'  ";                       
                         $stringdi= " bm_dayclosedate = '".$dates[$i]."'  ";
			                   $stringta= " tab_dayclosedate = '".$dates[$i]."'  ";
                         $string_as= " and tpd_date  = '".$dates[$i]."'  ";
                         $string_rec= " and tr_date  = '".$dates[$i]."'  ";
                         $string_con5= " and cv_date  = '".$dates[$i]."'  ";    
                         $string_crd_new1=" cdp_dayclosedate = '".$dates[$i]."' "; 
                         $string_adv_loan= "  tla_date  = '".$dates[$i]."'  "; 
                         $stringr="and date(tr_date)  = '".$dates[$i]."' "; 
                          
                          
  for($ii=0;$ii<=count($ledgers);$ii++){

  $fnct_menu3 = $database->mysqlQuery("select tps_ledger_id,tps_ledger_open_bal from tbl_ledger_setting where tps_ledger_id='". $ledgers[$ii]."' and tps_dayclosedate='".$dates[$i]."'  ");
  
  $num_fdtl3 = $database->mysqlNumRows($fnct_menu3);
  if ($num_fdtl3 > 0) {
    while ($result_fnctvenue3 = $database->mysqlFetchArray($fnct_menu3))
      {
        $yes_open=$result_fnctvenue3['tps_ledger_open_bal'];

      
    //--------Sale --- Income--------Dr----------//

    $dine_sale_card=0;                 
    $sql_login  =  $database->mysqlQuery("select sum(bm_transactionamount) as tot FROM tbl_tablebillmaster left join tbl_bankmaster on bm_id=bm_transcbank left join tbl_ledger_master  on tlm_id=bm_account where tlm_id='".$result_fnctvenue3['tps_ledger_id']."' and  bm_paymode='2' and   $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){     
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
			$dine_sale_card =$dine_sale_card + $result_login['tot'];                
      } } 
      
    $ta_sc_hd_sale_card=0;
    $sql_loginta  =  $database->mysqlQuery("select sum(tab_transactionamount) as tot from tbl_takeaway_billmaster left join tbl_bankmaster on bm_id=tab_transcbank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tps_ledger_id']."' and  tab_paymode='2' and  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_card =$ta_sc_hd_sale_card + $result_loginta['tot'];
      } } 
            
    $dine_sale_cash=0;                 
    $sql_login  =  $database->mysqlQuery("select (sum(bm_amountpaid) - (sum(bm_amountbalace) )) as tot FROM tbl_tablebillmaster  where $stringdi "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){        
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   				
			$dine_sale_cash =$dine_sale_cash + $result_login['tot'];
      } } 
                 
    $ta_sc_hd_sale_cash=0;
    $sql_loginta  =  $database->mysqlQuery("select (sum(tab_amountpaid) - (sum(tab_amountbalace)))  as tot from tbl_takeaway_billmaster where   $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
			$ta_sc_hd_sale_cash =$ta_sc_hd_sale_cash + $result_loginta['tot'];
      } } 
       
        
    
    $credit_card=0;  
    $sql_logincpta  =  $database->mysqlQuery("select sum(cdp_transaction_amount)  as tot from tbl_credit_details_payment left join tbl_bankmaster on bm_id=cdp_bank  left join tbl_ledger_master  on tlm_id=bm_account  where tlm_id='".$result_fnctvenue3['tps_ledger_id']."' and  $string_crd_new1"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 			
      $credit_card =$credit_card + $result_logincpta['tot'];        
      }} 

                 
    $cash_tot=0;
    $sql_logincpta1  =  $database->mysqlQuery("select (sum(cdp_paid_cash) - (sum(cdp_balance)))  as tot1 from tbl_credit_details_payment  where cdp_paid_cash!='' and  $string_crd_new1"); 
	  $num_logincpta1   = $database->mysqlNumRows($sql_logincpta1);
	  if($num_logincpta1){
		  while($result_logincpta1  = $database->mysqlFetchArray($sql_logincpta1)) 
			{ 			
        $cash_tot =$cash_tot + $result_logincpta1['tot1'];
			}} 
           
           $total =0;
           if($ledgers_type[$ii]=='Cash_account')
           {
            $total = $dine_sale_cash+$ta_sc_hd_sale_cash+$cash_tot;
           }
           elseif($ledgers_type[$ii]=='Bank_account')
           {
            $total = $dine_sale_card+$ta_sc_hd_sale_card +$credit_card;
           }
           else {

           }
   
          
//----------Sale --------- end------------//    
           
           
           
//--------Loan --Expense --------------Cr------------//
           
    $loan_minus2=0;
    $sql_loginta9  =  $database->mysqlQuery("select sum(tla_paid) as paid from tbl_loan_advance left join tbl_ledger_master  on tla_to=tlm_id    where tla_to='".$result_fnctvenue3['tps_ledger_id']."' and  tla_type='Loan' and  $string_adv_loan"); 
	  $num_loginta9   = $database->mysqlNumRows($sql_loginta9);
	  if($num_loginta9){
		  while($result_loginta15  = $database->mysqlFetchArray($sql_loginta9)) 
			{ 				
			$loan_minus2 =$loan_minus2+$result_loginta15['paid'];                      
      } } 
  //---------------------------Loan-------------end----------------------------//               
       
  //------------- Discount section is removed ()--------------------------------//
    //   $asset_discount_bank=0;
    //      $sql_login_loy1  =  $database->mysqlQuery("select sum(tpd_discount) as amt FROM tbl_asset_purchase_invoice_detail left join tbl_ledger_master  on tpd_from_acc=tlm_id  where tpd_from_acc='".$result_fnctvenue3['tps_ledger_id']."' and  tpd_type_pay='First'   $string_as "); 
       
	  // $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  // if($num_login_loy1){ 
         
		//   while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
		// 	{   
			 
    //           $asset_discount_bank=  $asset_discount_bank+$result_login_loy1['amt'];
                      
                      
    //       }
    //       }   

    //      $supp_discount_bank=0;
    //      $sql_login_loy1  =  $database->mysqlQuery("select sum(sv_discount) as amt1 FROM tbl_supplier_voucher ts left join tbl_ledger_master tm on ts.sv_from=tm.tlm_id  where  ts.sv_from='".$result_fnctvenue3['tps_ledger_id']."'  and ts.sv_type_pay='First'   $string "); 
       
	  // $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  // if($num_login_loy1){ 
         
		//   while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
		// 	{   
			 
    //                  $supp_discount_bank=  $supp_discount_bank+$result_login_loy1['amt1'];
                      
                      
    //       }
    //       }   
   //------------- Discount section is removed -end()--------------------------------//       
   
   //------------------------Loan----expense ------------Cr---------------------------//
      $loan_advance_bank=0;
      $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_amount) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_from=tlm_id  where tla_from='".$result_fnctvenue3['tps_ledger_id']."' and  $string_adv_loan  "); 
      $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	    if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			 $loan_advance_bank =$loan_advance_bank + $result_logincpta34['netamt'];                                              
      } }           
    //------------------------Loan----expense end---------------------------------------//              
              
    //    //------------------------Loan----expense ------------dr---------------------------//
    //    $loan_return_bank=0;
    //    $sql_logincpta34  =  $database->mysqlQuery("select sum(tla_paid) as netamt from tbl_loan_advance  left join tbl_ledger_master  on tla_to=tlm_id  where tla_to='".$result_fnctvenue3['tps_ledger_id']."' and  $string_adv_loan  "); 
    //    $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
    //    if($num_logincpta34){
    //    while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
    //    { 
    //     $loan_return_bank =$loan_return_bank + $result_logincpta34['netamt'];                                              
    //    } }           
    //  //------------------------Loan----expense end---------------------------------------//              
          


    //------------------------Receipts----Indirect Income ------------Dr---------------------------//       
    $bank_receipt=0;
    $sql_logincpta34  =  $database->mysqlQuery("select sum(tr_amount) as netamt from tbl_receipts tr left join tbl_ledger_master tm on tr.tr_to=tm.tlm_id  where tr.tr_to='".$result_fnctvenue3['tps_ledger_id']."'   $string_rec  "); 
	  $num_logincpta34   = $database->mysqlNumRows($sql_logincpta34);
	  if($num_logincpta34){
		  while($result_logincpta34 = $database->mysqlFetchArray($sql_logincpta34)) 
			{ 
			 $bank_receipt =$bank_receipt + $result_logincpta34['netamt'];            
      } }       
    //------------------------Receipts----Indirect Income -End--------------------------------------//       
   


     //------------------------Receipts- from---Indirect Income ------------Cr---------------------------//       
     $receipt_amount=0;
     $receipt_from  =  $database->mysqlQuery("select tr_amount  from tbl_receipts  where tr_from='".$result_fnctvenue3['tps_ledger_id']."'  $string_rec "); 	
     $num_receipt_from   = $database->mysqlNumRows($receipt_from);
     if($num_receipt_from){
       while($result_receipt_from = $database->mysqlFetchArray($receipt_from)) 
       { 
        $receipt_amount =$receipt_amount + $result_receipt_from['tr_amount'];            
       } }       
     //------------------------Receipts----Indirect Income -End--------------------------------------// 
    
      
    //------------------------Contra voucher---- Income ------------Dr---------------------------//
    $tot_contra1=0;    
    $sql_login4575  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_to_acc='".$result_fnctvenue3['tps_ledger_id']."'  $string_con5 "); 
	  $num_login4575   = $database->mysqlNumRows($sql_login4575);
		if($num_login4575){
        while($result_login5  = $database->mysqlFetchArray($sql_login4575)) 
					{           
           $tot_contra1=$tot_contra1+$result_login5['cv_amount'];
          }} 
    //------------------------Contra voucher---- End ---------------------------------------//

    //------------------------Contra voucher---- Expense ------------Cr---------------------------//              
      $tot_contra=0;    
      $sql_login457  =  $database->mysqlQuery("select cv_amount from tbl_contra_voucher  where cv_from_acc='".$result_fnctvenue3['tps_ledger_id']."'  $string_con5 "); 
	    $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){
          while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{          
           $tot_contra=$tot_contra+$result_login['cv_amount'];
          }}
    //------------------------Contra voucher---- End -----------------------------------------//                
                  
    //------------------------Purchase---- Expense ------------Cr---------------------------//   
    //  if($ledgers_type[$ii]=='Cash_account' || $ledgers_type[$ii]=='Bank_account'){
      $tot_supplier_asset=0;
      $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_from_acc='".$result_fnctvenue3['tps_ledger_id']."'  $string_as "); 
      $num_login454   = $database->mysqlNumRows($sql_login454);
					if($num_login454){                                          
					while($result_login  = $database->mysqlFetchArray($sql_login454)) 
					{          
           $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
          }}
      //   }
      //   else{
      //     $tot_supplier_asset=0;
      // $sql_login454  =  $database->mysqlQuery("select tpd_paid_amount from tbl_asset_purchase_invoice_detail  where tpd_t_acc='".$result_fnctvenue3['tps_ledger_id']."'  $string_as "); 
      // $num_login454   = $database->mysqlNumRows($sql_login454);
			// 		if($num_login454){                                          
			// 		while($result_login  = $database->mysqlFetchArray($sql_login454)) 
			// 		{          
      //      $tot_supplier_asset=$tot_supplier_asset+$result_login['tpd_paid_amount'];
      //     }}
      //   }
        


    //------------------------Purchase---- End --------------------------------------------//  
                                                                                                
    //------------------------Supplier Voucher---- Expense ------------Cr---------------------------//                                      
      $tot_supplier=0;
      $sql_login  =  $database->mysqlQuery("select sv_paid_amount from tbl_supplier_voucher ts  where ts.sv_from='".$result_fnctvenue3['tps_ledger_id']."'  $string "); 
	    $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){                                           
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $tot_supplier=$tot_supplier+$result_login['sv_paid_amount'];                            
          }}    
    //------------------------Supplier Voucher---- End ----------------------------------------------//      
    
       //---------------vendors ---------Supplier Voucher---- Expense ------------Dr---------------------------//                                      
       $tot_supplier_dr=0; $tot_supplier_cr=0;
       $sql_login  =  $database->mysqlQuery("select sv_paid_amount,sv_invoice_amount,sv_type_pay from tbl_supplier_voucher ts left join tbl_ledger_master lm on ts.sv_vendor_id=lm.tlm_vendor_id where lm.tlm_id='".$result_fnctvenue3['tps_ledger_id']."'  $string "); 
       $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login){                                           
           while($result_login  = $database->mysqlFetchArray($sql_login)) 
           { 
            if($result_login['sv_type_pay']=='First')
            {
              $tot_supplier_cr=$tot_supplier_cr+$result_login['sv_invoice_amount'];
            }
             $tot_supplier_dr=$tot_supplier_dr+$result_login['sv_paid_amount'];                            
           }}    
     //------------------------Supplier Voucher---- End ----------------------------------------------//  

            //-----------------------Supplier return Voucher---- Expense ------------Dr---------------------------//                                      
       $tot_sup_returndr=0; 
       $sql_login  =  $database->mysqlQuery("select tr_date,tr_return_amount,tr_vendor,tr_particulars from tbl_return_payment  where tr_to_acc='".$result_fnctvenue3['tps_ledger_id']."'  $stringr "); 
       $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login){                                           
           while($result_login  = $database->mysqlFetchArray($sql_login)) 
           { 
            $tot_sup_returndr=$tot_sup_returndr+$result_login['tr_return_amount'];                           
           }}    
     //------------------------Supplier return Voucher---- End ----------------------------------------------//  
                                         
    //------------------------Employee Voucher---- Expense ------------Cr---------------------------//                                    
      $tot_employee=0; 
      $sql_login5  =  $database->mysqlQuery("select ev_amount from tbl_employee_voucher ts  where ts.ev_from='".$result_fnctvenue3['tps_ledger_id']."'  $string1 "); 
      $num_login5   = $database->mysqlNumRows($sql_login5);
					if($num_login5){                                          
					while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
					{ 
          $tot_employee=$tot_employee+$result_login5['ev_amount'];
          }}
    //------------------------Employee Voucher---- End-------------------------------------------------//                              
     
    //------------------------Expense Voucher---- Direct Expense ------------Cr---------------------------//  
      $tot_direct=0; 
      $sql_login78  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes  where tes.ev_acc_type='Direct Expense' and tes.ev_from_acc='".$result_fnctvenue3['tps_ledger_id']."'  $string3 "); 
      $num_login78   = $database->mysqlNumRows($sql_login78);
					if($num_login78){                                     
					while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
					{         
          $tot_direct=$tot_direct+$result_login78['ev_amount'];                      
          }}        
    //------------------------Expense Voucher---- End-------------------------------------------------//                                    
      
    //------------------------Expense Voucher---- Indirect Expense ------------Cr---------------------------//  
      $tot_indirect=0; 
      $sql_login79  =  $database->mysqlQuery("select ev_amount from tbl_expense_voucher tes   where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc='".$result_fnctvenue3['tps_ledger_id']."'   $string3"); 
      $num_login79   = $database->mysqlNumRows($sql_login79);
					if($num_login79){                                           
					while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
					{         
         $tot_indirect=$tot_indirect+$result_login79['ev_amount'];
         }}
    //------------------------Expense Voucher---- End-------------------------------------------------// 

    /*--------closing bal calculation old-----------------

        $all_in_cash=$yes_open-($tot_supplier+$tot_contra+$tot_supplier_asset+$tot_employee+$tot_direct+$tot_indirect-$tot_contra1);     
        $bankall=($all_in_cash+$bank_receipt+$loan_minus2+$supp_discount_bank+$asset_discount_bank+$total_module_sale_card+$credit_card+$cash_tot)-$loan_advance_bank;    
        $aa= number_format($bankall,$_SESSION['be_decimal']);       
        $aa1=str_replace(',','',$aa); 

    --------closing bal calculation-----------------*/



    $total_debit = $total+$bank_receipt+ $tot_contra1+$loan_minus2+$tot_supplier_dr+$tot_sup_returndr;
    $total_credit = $tot_supplier_cr+$loan_advance_bank+$tot_contra+$tot_supplier_asset+$tot_supplier+$tot_employee+$tot_direct+$tot_indirect+$receipt_amount;
    
  

    if($ledgers_type[$ii]=='Cash_account' || $ledgers_type[$ii]=='Bank_account')
    {
      
      // closing balance = opening balance + debit - credit//
      $closing_balance = $yes_open + $total_debit - $total_credit;
      
    }
    else
    {
      // closing balance = opening balance - debit + credit//
      $closing_balance = ($yes_open - $total_debit) + $total_credit;


    }


    $aa= number_format($closing_balance,$_SESSION['be_decimal']);       
    $aa1=str_replace(',','',$aa);
       
  $sql_login6  =  $database->mysqlQuery("update tbl_ledger_setting set tps_closing_balance='".$aa1."' where tps_ledger_id='".$ledgers[$ii]."' and tps_dayclosedate='$dates[$i]' ");             
                          
    } } 
                        
                                             
    }}                       
  
  }

  else if(isset($_REQUEST['set']) && $_REQUEST['set']=="opening_balance_calculation1")
   {
        $date_prev = '';
        $date_next = ''; 
        $dates=array();
        $yes_open=0;
          
        $sql_login  =  $database->mysqlQuery("select tps_dayclosedate from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' order by tps_dayclosedate desc "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                            
                                            $dates[]=$result_login['tps_dayclosedate'];
                                        }
                                        }   
       
        foreach($dates as $da){
            if(strtotime($da) < strtotime($_REQUEST['date']))
                if(!strtotime($date_prev) || strtotime($date_prev) < strtotime($da))
                    $date_prev = $da;
            if(strtotime($da) > strtotime($_REQUEST['date']))
                if(!strtotime($date_next) || strtotime($date_next) > strtotime($da))
                    $date_next = $da;
        }


                                  
                                    
    $sql_login = $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."'"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){
                                                                     
                 $yesterday=date("Y-m-d", strtotime("yesterday"));   
                 $maxid='';   
                 
                $sql_desg_nos3="select max(tps_id) as id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['ledger']."' and tps_dayclosedate ='".$date_prev."' ";
 
		$sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
		$num_desg3  = $database->mysqlNumRows($sql_desg3);
		if($num_desg3)
		{
			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
				{
                           
                   $maxid= $result_desg3['id'];
                            
                }}
                       
                                        
                    $sql_login  =  $database->mysqlQuery("select tps_closing_balance from tbl_ledger_setting where tps_id='$maxid' and tps_ledger_id='".$_REQUEST['ledger']."' "); 
		    $num_login   = $database->mysqlNumRows($sql_login);
         	    if($num_login){
			while($result_login  = $database->mysqlFetchArray($sql_login)) 
			 { 
                                    
                            $yes_open=  $result_login['tps_closing_balance'];
                                            
                               }} 
                              
                               
                      }else{
                                 
                                           
                        $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$_REQUEST['ledger']."'  "); 
			$num_login   = $database->mysqlNumRows($sql_login);
			if($num_login){
			while($result_login  = $database->mysqlFetchArray($sql_login)) 
			 { 
                                    
                            $yes_open=  $result_login['tlm_open_bal'];
                                            
                           }} 
                                         
                      }
                         echo $yes_open;        
                                  
         
     }
     else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="opening_balance_calculation2"){
         
     $string='';
    if($_REQUEST['fromdt']!="")
		{ 
	      $string.= "   tps_dayclosedate = '".$_REQUEST['fromdt']."' ";       
		}
    else
    {
        $from=date("Y-m-d");
        $string.= "";
    }                                   
     $string1='';
    if($_REQUEST['todt']!="")
		{ 
		     $string1.= "   tps_dayclosedate = '".$_REQUEST['todt']."' ";                       
		}else
    {
       $to=date("Y-m-d");
       $string1.= "";
    }
     
   
                                   
        $yes_open=0;
                                    
        $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['acc']."' "); 
				$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
          if($string!=''){  
          $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal  from tbl_ledger_setting where $string and tps_ledger_id='".$_REQUEST['acc']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                    
            $yes_open=  $result_login['tps_ledger_open_bal'];
                                            
          }} 
          }else{

     $sql_desg_nos3="select max(tps_id) as id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['acc']."' ";
 
		$sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
		$num_desg3  = $database->mysqlNumRows($sql_desg3);
		if($num_desg3)
		{
			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
				{                  
          $maxid= $result_desg3['id'];                           
        }}

        $sql_login  =  $database->mysqlQuery("select tps_ledger_open_bal from tbl_ledger_setting where tps_id='$maxid' and tps_ledger_id='".$_REQUEST['acc']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{                                     
            $yes_open=  $result_login['tps_ledger_open_bal'];
          }} 
  
          }

          }else{
                                                                       
          $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$_REQUEST['acc']."'  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                    
                                          $yes_open=  $result_login['tlm_open_bal'];
                                            
                                         }} 
                                         
                                        }
                                         
                                         
                       echo $yes_open.'*';        

                       $yes_close=0;
                                    
      $sql_login  =  $database->mysqlQuery("select tps_ledger_id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['acc']."'"); 
			$num_login   = $database->mysqlNumRows($sql_login);
			if($num_login){
              
          if($string1!='')
          {                                             
          $sql_login  =  $database->mysqlQuery("select tps_closing_balance  from tbl_ledger_setting where $string1 and tps_ledger_id='".$_REQUEST['acc']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
            $yes_close=  $result_login['tps_closing_balance'];                                           
          }}                                            
          
          }else{
                                                 
    $sql_desg_nos3="select max(tps_id) as id from tbl_ledger_setting where tps_ledger_id='".$_REQUEST['acc']."' ";
 
		$sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
		$num_desg3  = $database->mysqlNumRows($sql_desg3);
		if($num_desg3)
		{
			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
				{                          
             $maxid= $result_desg3['id'];                           
        }}
                       
                        
          $sql_login  =  $database->mysqlQuery("select tps_closing_balance from tbl_ledger_setting where tps_id='$maxid' and tps_ledger_id='".$_REQUEST['acc']."' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{                                    
               $yes_close=  $result_login['tps_closing_balance'];
            }} 
                                                  
            }
                                         
                                         
                                        }else{
                                 
                                           
          $sql_login  =  $database->mysqlQuery("select tlm_open_bal from tbl_ledger_master where tlm_id='".$_REQUEST['acc']."'  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
                                    
                                          $yes_close=  $result_login['tlm_open_bal'];
                                            
                                         }} 
                                         
                                        }
 
                       echo $yes_close;        
           
     }
     else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="get_ledger_id")
     {
      $sql_login  =  $database->mysqlQuery("select tlm_id from tbl_ledger_master where tlm_vendor_id='".$_REQUEST['vendor']."'  "); 
      $num_login   = $database->mysqlNumRows($sql_login);
      if($num_login){
      while($result_login  = $database->mysqlFetchArray($sql_login)) 
      { 
          $ledger=  $result_login['tlm_id'];
      }
    } 
    echo $ledger;

     }
      else if(isset($_REQUEST['set'])&& $_REQUEST['set']=="set_acc_date_new")
     {
          $date_in=date('Y-m-d');
          
          $sql_login  =  $database->mysqlQuery("update tbl_branchmaster set be_accounts_start_date='$date_in'  "); 
         $_SESSION['be_accounts_start_date']=$date_in;
     }
  ?>   
             
