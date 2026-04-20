<?php
	
session_start();

if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
}
$branchname='';
$address='';
 $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $address=$result_branch['be_address'];
					}
		  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="img/favicon.ico">
<title>Shift Report</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.back-button-print{width: 100px;height: 30px;float: left;background: #1a1a1a;text-align: center;line-height:  30px;font-size: 14px;color: #fff !important}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
</head>
<body style="background:none;overflow:scroll !important">
<!-- main header -->
<div style="width:1000px;margin:0 auto">

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">
                
                
                
                <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
      <tbody>
          <tr> 
          <td id="printbutton">
              <input type="submit" value="Print" style="margin-right:55px;border: 0px;display: none" class="back-button-print print_button_main" onclick="return print_page()" />
              <a style="margin-left: -166px;margin-top: 5px;" href="shiftdetails.php" class="back-button-print" onclick="return close_page1()" >BACK</a>
          </td>
          
          
          </tr>
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
      </tbody>
  </table>
                
                
                
                
                
<?php               

if(isset($_REQUEST['set']) && $_REQUEST['set']=='shift_email'){
    
    $sl=$_REQUEST['slnoshift'];
    $date=$_REQUEST['day_shift'];
    
   
            	
                   $datetime= date('m/d/Y h:i:s a', time());
                   
                                          
                 $sql_decimal="Select be_decimal,be_branchname,be_logoinbill,be_footer4,be_others3 from  tbl_branchmaster";
		$sql_decimal_va  =  mysqli_query($localhost,$sql_decimal); 
		$num_decimal_va  = mysqli_num_rows($sql_decimal_va);
		if($num_decimal_va){	
		while($result_decimal  = mysqli_fetch_array($sql_decimal_va)) 
				{
					 $decimal=$result_decimal['be_decimal'];
                                         $loginbill=$result_decimal['be_logoinbill'];
                                         $footer=$result_decimal['be_footer4'];
                                         $gstno=$result_decimal['be_others3'];
                                         $branch=$result_decimal['be_branchname'];
				}
		} 
                              
                
                
            	
	
                
               $sql_login_shift="Select *,ts.ser_firstname,tl.ls_username from tbl_shift_details tsd left join tbl_staffmaster ts on "
                       . " ts.ser_staffid=tsd.sd_open_staff left join tbl_logindetails tl on tl.ls_staffid=tsd.sd_open_staff where sd_id='$sl' "
                       . " and sd_day='".$date."'";
                
		$sql_login_shift1  =  mysqli_query($localhost,$sql_login_shift); 
		$num_login_shift  = mysqli_num_rows($sql_login_shift1);
		if($num_login_shift){	
		while($result_login_shift  = mysqli_fetch_array($sql_login_shift1)) 
				{
                                          $shiftuserid=$result_login_shift['ls_username'];
					  $shiftopentime=$result_login_shift['sd_open'];
                                           $shiftclosetime=$result_login_shift['sd_close'];
                                            $shiftuser=$result_login_shift['ser_firstname'];
                                            $shiftopening_balance= $result_login_shift['sd_total_value'];
                                            $shit_expid=$result_login_shift['sd_open_staff'];
                                            $shiftclosing_balance=  $result_login_shift['sd_total_value_close'];
                                            $shift_open_petty_in=$result_login_shift['sd_open_petty'];
                                             $shift_close_petty_in=$result_login_shift['sd_close_petty'];
                                            $shift_dayclose=$result_login_shift['sd_day'];
				}
		}
                
                
              $shift_subtotal_ta_cs=0;  
               $shift_subtotal_di=0; 
               $sql_login_shift1="Select sum(tab_netamt) as subtotal_ta,sum(tab_roundoff_value) as round_ta,sum(tab_discountvalue) as disc_ta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
               //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
		while($result_login_shift1  = mysqli_fetch_array($sql_login_shift11)) 
				{
					  $shift_subtotal_ta_cs=$result_login_shift1['subtotal_ta'];
                                          $shift_roundoff_ta_cs=$result_login_shift1['round_ta'];
                                           $shift_discount_ta_cs=$result_login_shift1['disc_ta'];
                                           
                                           
				}
		} 
                
                
                $sql_login_shift1ta="Select sum(tab_netamt) as subtotal_ta1 from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_mode='TA' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
               //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift11ta  =  mysqli_query($localhost,$sql_login_shift1ta); 
		$num_login_shift1ta  = mysqli_num_rows($sql_login_shift11ta);
		if($num_login_shift1ta){	
		while($result_login_shift1ta  = mysqli_fetch_array($sql_login_shift11ta)) 
				{
					  $shift_subtotal_ta=$result_login_shift1ta['subtotal_ta1'];
                                         
                                           
                                           
				}
		}
                
                
                
                   $sql_login_shift1cs="Select sum(tab_netamt) as subtotal_cs from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_mode='CS'and tab_complimentary='N'  and tab_dayclosedate='$shift_dayclose' ";
               //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift11cs  =  mysqli_query($localhost,$sql_login_shift1cs); 
		$num_login_shift1cs  = mysqli_num_rows($sql_login_shift11cs);
		if($num_login_shift1cs){	
		while($result_login_shift1cs  = mysqli_fetch_array($sql_login_shift11cs)) 
				{
					  $shift_subtotal_cs=$result_login_shift1cs['subtotal_cs'];
                                         
                                           
                                           
				}
		}
                
                 $sql_login_shift1hd="Select sum(tab_netamt) as subtotal_hd from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_mode='HD' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
               //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift11hd  =  mysqli_query($localhost,$sql_login_shift1hd); 
		$num_login_shift1hd  = mysqli_num_rows($sql_login_shift11hd);
		if($num_login_shift1hd){	
		while($result_login_shift1hd  = mysqli_fetch_array($sql_login_shift11hd)) 
				{
					  $shift_subtotal_hd=$result_login_shift1hd['subtotal_hd'];
                                         
                                           
                                           
				}
		}
                
                
                
                $sql_login_shift2="Select sum(bm_finaltotal) as subtotal_di,sum(bm_roundoff_value) as round_di,sum(bm_discountvalue) as disc_di from tbl_tablebillmaster where bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed' and bm_complimentary='N' and bm_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift12  =  mysqli_query($localhost,$sql_login_shift2); 
		$num_login_shift2  = mysqli_num_rows($sql_login_shift12);
		if($num_login_shift2){	
		while($result_login_shift2 = mysqli_fetch_array($sql_login_shift12)) 
				{
					  $shift_subtotal_di=$result_login_shift2['subtotal_di'];
                                           $shift_roundoff_di=$result_login_shift2['round_di'];
                                           $shift_discount_di=$result_login_shift2['disc_di']; 
				}
		}
                
                
                $totalsales=$shift_subtotal_ta_cs+$shift_subtotal_di;
                $totalroundoff=$shift_roundoff_ta_cs+$shift_roundoff_di;
                $totaldiscount=$shift_discount_di+$shift_discount_ta_cs;
                
                
                
                $sql_login_shift12="Select sum(tab_amountpaid-tab_amountbalace) as cash_ta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
               //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift112  =  mysqli_query($localhost,$sql_login_shift12); 
		$num_login_shift12  = mysqli_num_rows($sql_login_shift112);
		if($num_login_shift12){	
		while($result_login_shift12  = mysqli_fetch_array($sql_login_shift112)) 
				{
					  $shift_cash_ta_cs=$result_login_shift12['cash_ta'];
                                          
                                           
				}
		} 
                
                
                
                $sql_login_shift23="Select sum(bm_amountpaid-bm_amountbalace) as cash_di from tbl_tablebillmaster where bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed' and bm_complimentary='N' and bm_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift123  =  mysqli_query($localhost,$sql_login_shift23); 
		$num_login_shift23  = mysqli_num_rows($sql_login_shift123);
		if($num_login_shift23){	
		while($result_login_shift23 = mysqli_fetch_array($sql_login_shift123)) 
				{
					  $shift_cash_di=$result_login_shift23['cash_di'];
                                            
				}
		}
                $totalcash_shift=$shift_cash_ta_cs+$shift_cash_di;
                
                
                 $sql_login_shift123="Select sum(tab_transactionamount) as card_ta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_paymode='2' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
                 //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift1123  =  mysqli_query($localhost,$sql_login_shift123); 
		$num_login_shift123  = mysqli_num_rows($sql_login_shift1123);
		if($num_login_shift123){	
		while($result_login_shift123  = mysqli_fetch_array($sql_login_shift1123)) 
				{
					  $shift_card_ta_cs=$result_login_shift123['card_ta'];
                                          
                                           
				}
		} 
                
                
                
                $sql_login_shift233="Select sum(bm_transactionamount) as card_di from tbl_tablebillmaster where bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed' and bm_paymode='2' and bm_complimentary='N' and bm_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift1233  =  mysqli_query($localhost,$sql_login_shift233); 
		$num_login_shift233  = mysqli_num_rows($sql_login_shift1233);
		if($num_login_shift233){	
		while($result_login_shift233 = mysqli_fetch_array($sql_login_shift1233)) 
				{
					  $shift_card_di=$result_login_shift233['card_di'];
                                            
				}
		}
                
                
                $totalcard_shift=$shift_card_ta_cs+$shift_card_di;
                
                
                $sql_login_shift2334="SELECT sum(vp_amount) as vp_income FROM tbl_voucherpayment where  vp_approvedby='$shit_expid' and vp_approveddate between '$shiftopentime' and '$shiftclosetime' and vp_status='Approved' and vp_type='Income' ";
             
		$sql_login_shift12334  =  mysqli_query($localhost,$sql_login_shift2334); 
		$num_login_shift2334  = mysqli_num_rows($sql_login_shift12334);
		if($num_login_shift2334){	
		while($result_login_shift2334 = mysqli_fetch_array($sql_login_shift12334)) 
				{
					  $shift_voucher_income=$result_login_shift2334['vp_income'];
                                            
				}
		}
                
                $sql_login_shift2335="Select sum(vp_amount) as vp_expense FROM tbl_voucherpayment  where vp_approvedby='$shit_expid' and vp_approveddate between '$shiftopentime' and '$shiftclosetime' and vp_status='Approved' and vp_type='Expense' ";
               
		$sql_login_shift12335  =  mysqli_query($localhost,$sql_login_shift2335); 
		$num_login_shift2335  = mysqli_num_rows($sql_login_shift12335);
		if($num_login_shift2335){	
		while($result_login_shift2335 = mysqli_fetch_array($sql_login_shift12335)) 
				{
					  $shift_voucher_expense=$result_login_shift2335['vp_expense'];
                                            
				}
		}
                
                
                ////acc start////
                  
          $total_shift_expense_all=0; 
             
           $expense_voucher=0;
          
           $sql_login_shift_ex="select sum(ev_amount) as expense FROM tbl_expense_voucher where ev_login='$shiftuserid' and ev_entry_time between '$shiftopentime' and '$shiftclosetime' ";
               
		$sql_login_shift_ex1  =  mysqli_query($localhost,$sql_login_shift_ex); 
		$num_login_shift_ex1  = mysqli_num_rows($sql_login_shift_ex1);
		if($num_login_shift_ex1){	
		while($result_login_shift_ex = mysqli_fetch_array($sql_login_shift_ex1)) 
				{
					 
                                        $expense_voucher=  $result_login_shift_ex['expense'];    
				}
		}
          
          
          
          
          
          $supplier_voucher=0;
          
          
          $sql_login_shift_ex="select sum(sv_paid_amount) as expense1 FROM tbl_supplier_voucher where sv_login='$shiftuserid' and  sv_entry_time between '$shiftopentime' and '$shiftclosetime' ";
               
		$sql_login_shift_ex1  =  mysqli_query($localhost,$sql_login_shift_ex); 
		$num_login_shift_ex1  = mysqli_num_rows($sql_login_shift_ex1);
		if($num_login_shift_ex1){	
		while($result_login_shift_ex = mysqli_fetch_array($sql_login_shift_ex1)) 
				{
					 
                                        $supplier_voucher=  $result_login_shift_ex['expense1'];    
				}
		}
          
          
          
           $employee_voucher=0;
          
          $sql_login_shift_ex="select sum(ev_amount) as expense2 FROM tbl_employee_voucher where ev_login='$shiftuserid' and  ev_entry_time between '$shiftopentime' and '$shiftclosetime'";
               
		$sql_login_shift_ex1  =  mysqli_query($localhost,$sql_login_shift_ex); 
		$num_login_shift_ex1  = mysqli_num_rows($sql_login_shift_ex1);
		if($num_login_shift_ex1){	
		while($result_login_shift_ex = mysqli_fetch_array($sql_login_shift_ex1)) 
				{
					 
                                        $employee_voucher=  $result_login_shift_ex['expense2'];    
				}
		}
          
          
         
          $total_shift_expense_all=($employee_voucher+$supplier_voucher+$expense_voucher);
          
          
        ///acc end//
                
                ///cash acc //start//
                $total_shift_expense_all_cash=0;
                
                
               $expense_voucher_cash=0;
           $sql_login_shift_ex_cash="select sum(ev_amount) as expense FROM tbl_expense_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_expense_voucher.ev_from_acc where tlm_type='Cash_account' and  ev_login='$shiftuserid' and ev_entry_time between '$shiftopentime' and '$shiftclosetime' ";
               
		$sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1_cash);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $expense_voucher_cash=  $result_login_shift_ex_cash['expense'];    
				}
		}
                 
                
                
            $supplier_voucher_cash=0;
          
          
          $sql_login_shift_ex_cash="select sum(sv_paid_amount) as expense1 FROM tbl_supplier_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_supplier_voucher.sv_from where tlm_type='Cash_account' and sv_login='$shiftuserid' and  sv_entry_time between '$shiftopentime' and '$shiftclosetime' ";
               
		$sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $supplier_voucher_cash=  $result_login_shift_ex_cash['expense1'];    
				}
		}    
                
          $employee_voucher_cash=0;
          
          $sql_login_shift_ex_cash="select sum(ev_amount) as expense2 FROM tbl_employee_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_employee_voucher.ev_from where tlm_type='Cash_account' and ev_login='$shiftuserid' and  ev_entry_time between '$shiftopentime' and '$shiftclosetime'";
               
		$sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1_cash);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $employee_voucher_cash=  $result_login_shift_ex_cash['expense2'];    
				}
		}
                
                
           $total_shift_expense_all_cash=($employee_voucher_cash+$supplier_voucher_cash+$expense_voucher_cash);   
                
                
                
               $stringta=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
                $sql_login_shift1235="Select $stringta as credit_ta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_paymode='6' and tab_complimentary='N' and tab_dayclosedate='$shift_dayclose' ";
                 //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift11235  =  mysqli_query($localhost,$sql_login_shift1235); 
		$num_login_shift1235  = mysqli_num_rows($sql_login_shift11235);
		if($num_login_shift1235){	
		while($result_login_shift1235  = mysqli_fetch_array($sql_login_shift11235)) 
				{
					  $shift_card_ta_cs_credit=$result_login_shift1235['credit_ta'];
                                          
                                           
				}
		} 
                
                 $stringdi=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
                
                $sql_login_shift2335="Select $stringdi as credit_di from tbl_tablebillmaster where bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed' and bm_paymode='6' and  bm_complimentary='N' and bm_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift12335  =  mysqli_query($localhost,$sql_login_shift2335); 
		$num_login_shift2335  = mysqli_num_rows($sql_login_shift12335);
		if($num_login_shift2335){	
		while($result_login_shift2335 = mysqli_fetch_array($sql_login_shift12335)) 
				{
					  $shift_card_di_credit=$result_login_shift2335['credit_di'];
                                            
				}
		}
                
                
                $totalcreditsale=$shift_card_di_credit+$shift_card_ta_cs_credit;
                
                
                $sql_login_shift12351="Select sum(tab_netamt) as comp_ta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' and tab_paymode='7' and tab_complimentary='Y' and tab_dayclosedate='$shift_dayclose' ";
                 //echo "Select sum(tab_total) as subtotalta from tbl_takeaway_billmaster where tab_settlement_login='$shiftuserid' and tab_settlement_time between '$shiftopentime' and '$shiftclosetime' and tab_status='Closed' ";
		$sql_login_shift112351  =  mysqli_query($localhost,$sql_login_shift12351); 
		$num_login_shift12351  = mysqli_num_rows($sql_login_shift112351);
		if($num_login_shift12351){	
		while($result_login_shift12351  = mysqli_fetch_array($sql_login_shift112351)) 
				{
					  $comp_ta=$result_login_shift12351['comp_ta'];
                                          
                                           
				}
		} 
                
               
                
                $sql_login_shift23351="Select sum(bm_finaltotal) as com_di from tbl_tablebillmaster where bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed' and bm_paymode='7' and  bm_complimentary='Y' and bm_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift123351  =  mysqli_query($localhost,$sql_login_shift23351); 
		$num_login_shift23351  = mysqli_num_rows($sql_login_shift123351);
		if($num_login_shift23351){	
		while($result_login_shift23351 = mysqli_fetch_array($sql_login_shift123351)) 
				{
					  $comp_di=$result_login_shift23351['com_di'];
                                            
				}
		}
                $credit_settle_income_cash=0;$credit_settle_income_card=0;$credit_settle_income=0;
                $sql_login_shift233512="Select sum(cdp_paid_cash) as cashpay,sum(cdp_transaction_amount) as cardpay,sum(cdp_balance) as paybal from tbl_credit_details_payment where   cdp_entry_time between '$shiftopentime' and '$shiftclosetime' and cdp_login_id='$shit_expid' and cdp_dayclosedate='$shift_dayclose' ";
               // echo "Select sum(bm_total) as subtotal_di from tbl_tablebillmaster bm_settlement_login='$shiftuserid' and bm_settlement_time between '$shiftopentime' and '$shiftclosetime' and bm_status='Closed'";
		$sql_login_shift1233512  =  mysqli_query($localhost,$sql_login_shift233512); 
		$num_login_shift233512  = mysqli_num_rows($sql_login_shift1233512);
		if($num_login_shift233512){	
		while($result_login_shift233512 = mysqli_fetch_array($sql_login_shift1233512)) 
				{
					  $credit_settle_income=($result_login_shift233512['cashpay']+$result_login_shift233512['cardpay'])-$result_login_shift233512['paybal'];
                                          $credit_settle_income_cash=$result_login_shift233512['cashpay']-$result_login_shift233512['paybal'];
                                           $credit_settle_income_card=$result_login_shift233512['cardpay'];
                                          
				}
		}
                
                
                $tot_compli_shift=$comp_di+$comp_ta;
                
                
               $shift_open_bal_new=str_replace(",","",number_format($shiftopening_balance,$decimal));
                   
             
                $totincome=$totalcash_shift+$shift_voucher_income+$totalcard_shift+$totalcreditsale;
                
                
          $tot_all_in=$shiftopening_balance+$totalsales;
                
                
                     
                
                
               $netcash=($shift_open_bal_new+$totalcash_shift)-$total_shift_expense_all_cash;
                
                  
                  
                
                $shift_close_bal_new=str_replace(",","",number_format($shiftclosing_balance,$decimal));
                 
                 
                 
                 
                  
                  $tot_all_at_diff=$shift_close_bal_new-$netcash;
                  $new_diff=str_replace(",","",number_format($tot_all_at_diff,$decimal));
                  
                  if($new_diff<0){
                      $label_shft="Short";
                  }else{
                     $label_shft="Excess"; 
                  }
                  
                  
                  
           /////////itemcancel////billcancel//////////
             
           
                
            $tot_billcancel_all="";
             $total_cancel_bill_di="";
             $total_cancel_bill_tacshd="";
             $tot_count="";
             $tot_count_di="";
                
                              
                              
                 $sql_login_shift1="select sum(bm_finaltotal) as tot_bill_cancel_di,count(bm_billno) as tot_count_di FROM tbl_tablebillmaster  where bm_status='Cancelled'  AND bm_cancelled_date_time   between '$shiftopentime' and '$shiftclosetime' and ter_cancelledlogin='".$shiftuserid."' and bm_dayclosedate='$shift_dayclose' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_d  = mysqli_fetch_array($sql_login_shift11)) 
				{    
                              
                              
                              

                              $total_cancel_bill_di= $result_login_d['tot_bill_cancel_di'];
                              $tot_count_di=  $result_login_d['tot_count_di'];

                  }
                  } 

                  
                              
                              
                $sql_login_shift1="select sum(tab_netamt) as tot_bill_cancel_tacshd,count(tab_billno) as tot_count FROM tbl_takeaway_billmaster  where  tab_status='Cancelled' AND tab_cancelledtime between '$shiftopentime' and '$shiftclosetime' and tab_cancelledlogin='".$shiftuserid."' and tab_dayclosedate='$shift_dayclose' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_t  = mysqli_fetch_array($sql_login_shift11)) 
				{          
                              
                              

                              $total_cancel_bill_tacshd= $result_login_t['tot_bill_cancel_tacshd'];
                              $ta_count=$result_login_t['tot_count'];

                  }
                  } 


                  $tot_billcancel_all=$total_cancel_bill_di+$total_cancel_bill_tacshd;
                  $tot_count=$tot_count_di+$ta_count;



                        $tot_count_di="";
                        $tot_count_ta="";
                        

$sql_login_shift1="select count(ch_kot_cancel_id) as di_count  FROM tbl_tableorder_changes where ch_entrydate between '$shiftopentime' and '$shiftclosetime' and ch_cancelledlogin='".$shiftuserid."' and ch_dayclosedate='$shift_dayclose' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_cd  = mysqli_fetch_array($sql_login_shift11)) 
				{
                              
                              
                              $tot_count_di=  $result_login_cd['di_count'];

                  }
                  }   

                 

                              
                              
                $sql_login_shift1="select count(tc_cancel_id) as ta_count  FROM tbl_takeaway_cancel_items where tc_cancelled_time between '$shiftopentime' and '$shiftclosetime' and tc_cancelled_login='".$shiftuserid."' and tc_dayclosedate='$shift_dayclose' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_td  = mysqli_fetch_array($sql_login_shift11)) 
				{

                              $tot_count_ta=  $result_login_td['ta_count'];

                  }
                  }   


                  $tot_item_cancel_count=$tot_count_di+$tot_count_ta;

 
          /////////////ends cancel//////////        
                  
                  $tot_oc=0;
                $sql_login_shift1="Select distinct(dm.dm_denomination),tc1.dod_count,tc1.dod_value,tsd.sd_changein_close from tbl_shift_details tsd left join tbl_shift_close_denomination tc1 on tc1.dod_shidt_slno=tsd.sd_id  and tsd.sd_day=tc1.dod_day left join tbl_denomination_master dm on dm.dm_id=tc1.dod_deno_id  where  tsd.sd_close = '$shiftclosetime' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_shift1  = mysqli_fetch_array($sql_login_shift11)) 
				{
                                          $deno_oc=$result_login_shift1['dm_denomination'];
					  $count_oc=$result_login_shift1['dod_count'];
                                          $amt_oc=str_replace(",","",number_format($result_login_shift1['dod_value'],$decimal));
                                          $change_oc=$result_login_shift1['sd_changein_close'];
                                          
                             $tot_oc= $tot_oc+  str_replace(",","",number_format($result_login_shift1['dod_value'],$decimal));        
                                            
                                            
				}
		}
                
                
                $sql_login_shift11="Select distinct(sb.sb_bankid_close),bm.bm_name,sb.sb_card_amount_close from tbl_shift_details tsd left join tbl_shift_card_detail_close sb on sb.sb_shiftid_close=tsd.sd_id  and tsd.sd_day=sb.sb_shiftdate_close left join tbl_bankmaster bm on bm.bm_id=sb.sb_bankid_close  where  tsd.sd_close = '$shiftclosetime' ";
                //echo  "Select distinct(sb.sb_bankid_close),bm.bm_name,sb.sb_card_amount_close from tbl_shift_details tsd left join tbl_shift_card_detail_close sb on sb.sb_shiftid_close=tsd.sd_id  and tsd.sd_day=sb.sb_shiftdate_close left join tbl_bankmaster bm.bm_id=sb.sb_bankid_close  where  tsd.sd_close = '$shiftclosetime' ";
                 
		$sql_login_shift111  =  mysqli_query($localhost,$sql_login_shift11); 
		$num_login_shift11 = mysqli_num_rows($sql_login_shift111);
		if($num_login_shift11){	
                    
		while($result_login_shift11  = mysqli_fetch_array($sql_login_shift111)) 
				{
                                          $bankname=$result_login_shift11['bm_name'];
					 
                                          $amount_bnk=str_replace(",","",number_format($result_login_shift11['sb_card_amount_close'],$decimal));
                                         
                                          
                                            
				}
		}
                
             

$msg_temp='<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shift Close</title>
    <style>
    @media (max-width: 768px) {
        .main_sec{width:100% !important}
    }
    </style>
</head>
<body style="margin: 0;padding:0;background-color: #eeeeee;">


    <div style="width: 100%;height: auto;float:left;padding: 0px;text-align: center;font-family: sans-serif;background-color: #eeeeee">
    
        <div class="main_sec" style="width:100%;max-width: 730px;background-color: #fff;height: auto;padding:20px;display: inline-block;margin:auto;margin-top: -54px;">
                <div style="width: 700px;height: auto;float:left;text-align: center;color: #464646;">
                    <h1 style="margin:0;padding:5px 0;font-size: 22px;">SHIFT REPORT</h1>
                </div>

                <div style="width: 700px;float: left;height: auto;margin-top: 0px;text-align: center">
                    <span style="width: 100%;height: auto;float: left;font-size: 14px;color: #333;margin-bottom: 10px;">Shift By : <strong>'.$shiftuser.'</strong> </span>
                    <span style="width: 100%;height: auto;float: left;font-size: 14px;color: #929292;margin-bottom: 0px;">
                        Opend : <strong>'.$shiftopentime.'</strong> | Closed : <strong>'.$shiftclosetime.'</strong> 
                     </span>
                    


                  

                    <div style="width:700px;height: auto;float:left;padding:0px 0px;margin-top: 10px;">

                        <div style="width:189px;height:70px;float:left;background-color:#797575;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#fff;font-size:14px;line-height:22px">Opening Balance</span><br>
                            <strong style="color:#fff;font-size:20px">'.$shift_open_bal_new.'</strong>
                        </div>
                        <div style="width:300px;height:70px;float:left;background-color:#797575;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#fff;font-size:14px;line-height:22px">Closing Balance</span><br>
                            <strong style="color:#fff;font-size:20px">'.$shift_close_bal_new.'</strong>
                        </div>
                        <div style="width:189px;height:70px;float:left;background-color:#797575;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#fff;font-size:14px;line-height:22px">Difference</span><br>
                            <strong style="color:#fff;font-size:20px">'.$new_diff.'</strong>
                        </div>

                    </div>

                    <div style="width:677px;height: auto;float:left;background-color: #f3f3f3;padding:10px 10px;margin-top: 0px;">
                      

                        <div style="width:677px;height:50px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;padding-top:0px;margin-bottom:0px">
                            <span style="color:#727272;font-size:18px">TOTAL SALE</span><br>
                            <strong style="color:black;font-size:20px">'.number_format($totalsales,$decimal).'</strong>
                        </div>



                    </div>

                    <div style="width:700px;height: auto;float:left;padding:0px 0px;margin-top:5px;">

                        <div style="width:170px;height:70px;float:left;background-color:#e6e6e6;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#666;font-size:14px;line-height:22px">Dine In</span><br>
                            <strong style="color:#242424;font-size:20px">'.number_format($shift_subtotal_di,$decimal).'</strong>
                        </div>

                        <div style="width:170px;height:70px;float:left;background-color:#dedede;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#666;font-size:14px;line-height:22px">Take Away</span><br>
                            <strong style="color:#242424;font-size:20px">'.number_format($shift_subtotal_ta,$decimal).'</strong>
                        </div>
                        <div style="width:170px;height:70px;float:left;background-color:#dadada;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #dcdcdc;padding: 20px;">
                            <span style="color:#666;font-size:14px;line-height:22px">Home Delivery</span><br>
                            <strong style="color:#242424;font-size:20px">'.number_format($shift_subtotal_hd,$decimal).'</strong>
                        </div>
                        <div style="width:170px;height:70px;float:left;background-color:#e6e6e6;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 2px #e5e5e5;padding: 20px;">
                            <span style="color:#666;font-size:14px;line-height:22px">Counter Sales</span><br>
                            <strong style="color:#242424;font-size:20px">'.number_format($shift_subtotal_cs,$decimal).'</strong>
                        </div>

                    </div>


                   
                   


                    <div style="width:700px;height: auto;float:left;padding:0px 0px;margin-top:10px;">

                        <div style="width:172px;height:70px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 0px;">
                            <span style="color:#333;font-size:14px;line-height:22px;padding: 5px;background-color: #e4e4e4;width: 94%;float:left">Cash </span><br>
                            <strong style="color:#242424;font-size:20px;padding: 10px 5px;width: 93%;float:left">'.number_format($totalcash_shift,$decimal).'</strong>
                        </div>

                        <div style="width:172px;height:70px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 0px;">
                            <span style="color:#333;font-size:14px;line-height:22px;padding: 5px;background-color: #e4e4e4;width: 94%;float:left">Card </span><br>
                            <strong style="color:#242424;font-size:20px;padding: 10px 5px;width: 93%;float:left">'.number_format($totalcard_shift,$decimal).'</strong>
                        </div>
                        <div style="width:172px;height:70px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 0px;">
                            <span style="color:#333;font-size:14px;line-height:22px;padding: 5px;background-color: #e4e4e4;width: 94%;float:left">Credit </span><br>
                            <strong style="color:#242424;font-size:20px;padding: 10px 5px;width: 93%;float:left">'.number_format($totalcreditsale,$decimal).'</strong>
                        </div>
                        <div style="width:163px;height:70px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 0px;">
                            <span style="color:#333;font-size:14px;line-height:22px;padding: 5px;background-color: #e4e4e4;width: 94%;float:left">Complimentory</span><br>
                            <strong style="color:#242424;font-size:20px;padding:10px 5px;width: 93%;float:left">'.number_format($tot_compli_shift,$decimal).'</strong>
                        </div>

                    </div>

                    <div style="width:674px;height: auto;float:left;padding:0px 0px;margin-top:10px;background-color: #ededed;padding: 10px 10px 0px 10px;    line-height: 23px;">


                        <span style="width: 33%;height: auto;float: left;font-size: 15px;color: #000;margin-bottom: 10px;text-align: center">Expense  <strong><br>
                           '.number_format($total_shift_expense_all,$decimal).'</strong> </span>
    
                        <span style="width: 33%;height: auto;float: left;font-size: 15px;color: #000;margin-bottom: 10px;text-align: center;">Credit Settle Cash  <strong><br>
                            '.number_format($credit_settle_income_cash,$decimal).'</strong> </span>
    
                            <span style="width: 33%;height: auto;float: left;font-size: 15px;color: #000;margin-bottom: 10px;text-align: center">Credit Settle Card <strong><br>
                              '.number_format($credit_settle_income_card,$decimal).'</strong> </span>
    
                            </div>


                            <div style="width:700px;height: auto;float:left;padding:0px 0px;margin-top:12px;">

                                <div style="width:189px;height:67px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 20px;">
                                    <span style="color:#666;font-size:14px;line-height:22px">ITEM CANCELLED                                    </span><br>
                                    <strong style="color:black;font-size:20px">'.$tot_item_cancel_count.'</strong>
                                </div>
                                <div style="width:295px;height:67px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #dcdcdc;padding: 20px;">
                                    <span style="color:#666;font-size:14px;line-height:22px">BILL CANCELLED/AMOUNT </span><br>
                                    <strong style="color:black;font-size:20px">'.$tot_count.'/'.number_format($tot_billcancel_all,$_SESSION['be_decimal']).'</strong>
                                </div>
                                <div style="width:189px;height:67px;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin:0px 0 0 0;border:solid 1px #e5e5e5;padding: 20px;">
                                    <span style="color:black;font-size:14px;line-height:22px">DISCOUNTS
                                    </span><br>
                                    <strong style="color:black;font-size:20px">'.number_format($totaldiscount,$_SESSION['be_decimal']) .'</strong>
                                </div>
                               
        
                            </div>
        





                            


                            <div style="width:350px;height:auto;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin-top:0px">
                                <div style="width:350px;height:40px;line-height:42px;text-align: center;font-size: 15px;text-align: left"><strong>
                                    SALES SUMMARY</strong></div>
                                <table width="350px" border="0" style="line-height:6px;font-size:13px;color:#333;padding:5px;    border: solid 1px #e0e0e0;float:left">
                                  <tbody>
                                   <tr>
                                    <th width="50%" style="text-align:right;padding: 5px;background-color: #f3f3f3;font-size: 14px;">Type</th>
                                    <th width="50%"  style="text-align:right;;padding: 5px;background-color: #f3f3f3;font-size: 14px">Amount</th>
                                  </tr>
                                
                                  <tr>
                                  <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">Cash</td>
                                  <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($totalcash_shift,$decimal).'</td>
                                  </tr>
                                  <tr>
                                    <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">Card</td>
                                    <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($totalcard_shift,$decimal).'</td>
                                    </tr>
        
                                    <tr>
                                        <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">Credit</td>
                                        <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($totalcreditsale,$decimal).'</td>
                                        </tr>
        
                                    <tr>
                                        <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">Expense</td>
                                        <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($total_shift_expense_all,$decimal).'</td>
                                        </tr>
        
                                        
                                                <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">Petty Cash Expense</td>
                                                <td width="50%"  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($total_shift_expense_all_cash,$decimal).'</td>
                                                </tr>
                
        
                                    <tr>
                                        <td style="text-align:right;padding: 5px;border:solid 1px #dedede;text-align:right;"><strong>Diffrence</strong></td>
                                        <td style="text-align:right;padding: 5px;border:solid 1px #dedede"><strong> ['.$label_shft.'] '.$new_diff.'</strong></td>
                                        </tr> 
                                
                                </tbody></table>
        
        
        
                               
        
                                
                    
                            </div>
                            




                    <div style="width:325px;height:auto;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin-top:0px">
                        <div style="width:350px;height:40px;line-height:42px;text-align: center;font-size: 15px;text-align: left;"><strong>
                            CLOSING DENOMINATIONS</strong></div>
                        <table width="325px" border="0" style="line-height:6px;font-size:13px;color:#333;padding:5px; border: solid 2px #e0e0e0;float:left">
                          <tbody>
                           <tr>
                          <td style="text-align:left;padding: 5px;border:solid 1px #f3f3f3;background-color: #f3f3f3;font-weight:bold">Denomination</td>
                          <td style="padding: 5px;border:solid 1px #f3f3f3;background-color: #f3f3f3;font-weight:bold"  >Count</td>
                          <td  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3;background-color: #f3f3f3;font-weight:bold">Total</td>
                          </tr>';   
$change_oc1=0;$tot_oc1=0;
$sql_login_shift1="Select distinct(dm.dm_denomination),tc1.dod_count,tc1.dod_value,tsd.sd_changein_close from tbl_shift_details tsd left join tbl_shift_close_denomination tc1 on tc1.dod_shidt_slno=tsd.sd_id  and tsd.sd_day=tc1.dod_day left join tbl_denomination_master dm on dm.dm_id=tc1.dod_deno_id  where  tsd.sd_close = '$shiftclosetime' ";
                
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_shift1  = mysqli_fetch_array($sql_login_shift11)) 
				{
                    
                    $deno_oc=$result_login_shift1['dm_denomination'];
					  $count_oc=$result_login_shift1['dod_count'];
                                          $amt_oc=str_replace(",","",number_format($result_login_shift1['dod_value'],$decimal));
                                          $change_oc1=$result_login_shift1['sd_changein_close'];
                                          
                             $tot_oc1=$tot_oc1+  str_replace(",","",number_format($result_login_shift1['dod_value'],$decimal));     
                    


                        $msg_temp.= '   <tr>
                          <td style="text-align:left;padding: 5px;border:solid 1px #f3f3f3">'.$deno_oc.'</td>
                          <td style="padding: 5px;border:solid 1px #f3f3f3"  >'.$count_oc.'</td>
                          <td  style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.$amt_oc.'</td>
                          </tr>';  
                }} 

                       $msg_temp.= '      <tr>
                                <td style="text-align:left;padding: 5px;border:solid 1px #f3f3f3">Change</td>
                                <td style="padding: 5px;border:solid 1px #f3f3f3" ></td>
                                <td style="text-align:right;padding: 5px;border:solid 1px #f3f3f3">'.number_format($change_oc,$decimal).'</td>
                                </tr> 

                            <tr>
                                <td style="text-align:left;padding: 5px;border:solid 1px #dedede"></td>
                                <td style="padding: 5px;border:solid 1px #dedede;text-align:right;" >Total</td>
                                <td style="text-align:right;padding: 5px;border:solid 1px #dedede"><strong>'.number_format(($tot_oc1+$change_oc1),$decimal).'</strong></td>
                                </tr> 
                        
                        </tbody></table>

                    </div>

                  


                  

   <div style="width:325px;height:auto;float:left;background-color:#fff;text-align:center;font-family:Arial,Helvetica,sans-serif;margin-top:0px">
                        
                        <table width="325px" border="0" style="line-height:6px;font-size:13px;color:#333;padding:5px; border: solid 2px #e0e0e0;float:left">
                          <tbody>
                           <tr>
                          <td style="text-align:left;padding: 5px;border:solid 1px #f3f3f3;background-color: #f3f3f3;font-weight:bold">Bank </td>
                          <td style="padding: 5px;border:solid 1px #f3f3f3;background-color: #f3f3f3;font-weight:bold"  >Amount</td>
                          </tr>';   
$change_oc1=0;$tot_oc1=0;
//$sql_login_shift1="Select distinct(dm.dm_denomination),tc1.dod_count,tc1.dod_value,tsd.sd_changein_close from tbl_shift_details tsd left join tbl_shift_close_denomination tc1 on tc1.dod_shidt_slno=tsd.sd_id  and tsd.sd_day=tc1.dod_day left join tbl_denomination_master dm on dm.dm_id=tc1.dod_deno_id  where  tsd.sd_close = '$shiftclosetime' ";
  $sql_login_shift1="Select distinct(sb.sb_bankid_close),bm.bm_name,sb.sb_card_amount_close from tbl_shift_details tsd left join tbl_shift_card_detail_close sb on sb.sb_shiftid_close=tsd.sd_id  and tsd.sd_day=sb.sb_shiftdate_close left join tbl_bankmaster bm on bm.bm_id=sb.sb_bankid_close  where  tsd.sd_close = '$shiftclosetime'  ";            
		$sql_login_shift11  =  mysqli_query($localhost,$sql_login_shift1); 
		$num_login_shift1  = mysqli_num_rows($sql_login_shift11);
		if($num_login_shift1){	
                    
                    
		while($result_login_shift1  = mysqli_fetch_array($sql_login_shift11)) 
				{
                    
                    $bankname=$result_login_shift1['bm_name'];
					 
                                          $amount_bnk=str_replace(",","",number_format($result_login_shift1['sb_card_amount_close'],$decimal));
                    


                        $msg_temp.= '   <tr>
                          <td style="text-align:left;padding: 5px;border:solid 1px #f3f3f3">'.$bankname.'</td>
                          <td style="padding: 5px;border:solid 1px #f3f3f3"  >'.$amount_bnk.'</td>
                       
                          </tr>';  
                }} 

                       $msg_temp.= ' 
                        
                        </tbody></table>

                    </div>



                    



                </div>


                


        
        </div>

        
    
    
    </div>
    
</body>
</html>';
                       
             

}
echo $msg_temp;

?>
 




	</div>
	</div>
        <!-- Bottom TABLE -->
    </div>
  </div></div>
				
							<!--[if !IE]>end section content bottom<![endif]-->
							

</body>
</html>

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
