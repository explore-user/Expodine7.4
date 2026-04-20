<?php 


session_start();		

include("../database.class.php"); 
$database	= new Database();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
<link href="../css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link href="../css/app.css" rel="stylesheet" type="text/css">
<link href="../bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="../mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="../mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="../mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="../mn/css/component.css" />
<link rel="stylesheet" href="../css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="../css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="../css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="../css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../mn/js/modernizr.custom.js"></script>
<script src="../js/jquery.nicescroll.min.js"></script>
<style>
    .table-font {
  
    font-size: 15px;
}
    .newconsl_table th, td{padding: 3px !important;}
    ::-webkit-scrollbar {
    width: 16px;
    height: auto;
}
.back-button-print{width: 100px;height: 30px;float: left;background: #1a1a1a;text-align: center;line-height:  30px;font-size: 14px;color: #fff !important}
.print_button_main{float: left;margin-right: 10px;height: 30px;width: 100px}
</style>
</head>

<style>
    .ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:67vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
</style>
 
<table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
        <tbody>
          <tr> 
              <td width="120px" id="printbutton"> <input type="submit" value="Print"  style="margin-right:55px;border: 0px" class="back-button-print print_button_main" onclick="return print_page()" />
          </td>
           <td>
           <a class="back-button-print" onclick="return close_page() ">Close</a>
          </td>
          </tr>
            
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
        </tbody>
        </table>

<?php
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='vendor_voucher_report'){
    
    
    ?>

<table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u></u></strong></th>
       
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>SUPPLIER VOUCHER </strong></th>
      </tr>

    </thead>
    </table> 

  <div class="ledger_list_sec" style="position:relative;overflow: auto;height: 457px;">
                             
                                   
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style=" min-width: 50px">SL</td>
                                                
                                                <td >Supplier Name</td>
                                                <td style=" min-width: 100px"> Date</td>
                                                 <td style="width:50%">Particulars</td>
                                                <td style=" min-width: 80px">Invoice No</td>
                                                 <td style=" min-width: 80px">Subtotal</td>
                                                  <td style=" min-width: 80px">Tax Amount</td>
                                               <td style=" min-width: 80px">Invoice Amt</td>
                                               <td style=" min-width: 80px">Paid </td>
                                                <td style=" min-width: 80px">Crdt Amt </td>
                                             
                                               
                                                <td style="min-width:70px">Voucher Id</td>
                                                 <td style="min-width:70px">From Acc</td>
                                                 <td style="min-width:70px">Return Amt </td>
                                                 
                                            </tr>
                                        </thead>
                                        <tbody id="load_vendor_data">
              
    <?php
    
    $string='';
    
    if($_REQUEST['v_name']!=''){
    $string.=" and tv.v_name like '%".$_REQUEST['v_name']."%'   ";
    }
    
     if($_REQUEST['search_inv_no']!=''){
    $string.=" and ts.sv_invoice_no like '%".$_REQUEST['search_inv_no']."%'   ";
    }
    
    
    
     if($_REQUEST['search_type']!=''){
    $string.=" and ts.sv_purchase_type = '".$_REQUEST['search_type']."'   ";
    }
    
     if($_REQUEST['search_tax_type']!=''){
         
     if($_REQUEST['search_tax_type']=='vat'){
         
    $string.=" and ts.sv_tax > '0' and ts.sv_type_pay='First'  ";
    
    }else{
        
        $string.=" and ts.sv_tax = '0' and ts.sv_type_pay='First'  ";
    }
    
     }

    $pd='yes';
     if($_REQUEST['search_payment_type']!=''){
    
    if($_REQUEST['search_payment_type']=='paid'){
        
        $string.=" and ts.sv_paid_amount > '0' ";
        
        $pd='no';
    
       }else{
        
       $string.=" and  ts.sv_entry_type='Credit'  and ts.sv_paid_fully= 'N' and ts.sv_type_pay='First'  "; 
       
        }
    
     }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and ts.sv_date between '".$from."' and '".$_REQUEST['todt']."' ";
                        
		}
    
       $inv_amount=0;
       $sub_amount=0;
       $tax_amount=0;
   
    $tot_paid_sup=0; $tot_sv_invoice_amount=0;
    
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_supplier_voucher ts  left join  tbl_vendor_master tv on tv.v_id=ts.sv_vendor_id left join tbl_ledger_master tm on tm.tlm_id=ts.sv_from  where tv.v_name!='' $string order by ts.sv_id desc"); 
  
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);

					if($num_kotlist){$i=0;
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { 
                 $i++;   
?>
                   <tr>
                   <td style="min-width: 50px"><?=$i?></td>
                 
                   <td style="min-width: 150px;text-transform: uppercase"><?=$result_kotlist['v_name']?></td>
                 
                     <td style="min-width: 100px;"><?=$result_kotlist['sv_date']?></td>
                       <td style="width:50%;"><?=$result_kotlist['sv_remarks']?></td>
                         <td style="min-width: 80px"><?=$result_kotlist['sv_invoice_no']?></td>
                           <td style="min-width: 80px;"><?=$result_kotlist['sv_subtotal']?></td>
                   <td style="min-width: 80px;"><?=$result_kotlist['sv_tax']?></td>
                     <td style="min-width: 80px;"><?=$result_kotlist['sv_invoice_amount']?></td>
                    <td style="min-width: 80px;"><?=$result_kotlist['sv_paid_amount']?></td>
                     <td style="min-width: 80px;"><?=$result_kotlist['sv_credit_amount']?></td>
                    
                    
                  
                  
                      <td style="min-width:70px;"><?=$result_kotlist['sv_id']?></td>
                       <td style="min-width:70px;"><?=$result_kotlist['tlm_ledger_name']?></td>
                    <td style="min-width:70px;"><?=$result_kotlist['sv_return_amount']?></td>
                   </tr>
<?php

   if($result_kotlist['sv_type_pay']=='First'){
       
       $inv_amount=$inv_amount+$result_kotlist['sv_invoice_amount'];
       $sub_amount=$sub_amount+$result_kotlist['sv_subtotal'];
       $tax_amount=$tax_amount+$result_kotlist['sv_tax'];
       
   }


             $tot_paid_sup=$tot_paid_sup+$result_kotlist['sv_paid_amount'];
             
             $tot_sv_invoice_amount=$tot_sv_invoice_amount+$result_kotlist['sv_invoice_amount'];

}
?>


                                     <tr>
                                          
                                          
                                                 <td style=" min-width: 50px;font-weight: bold">Total</td>
                                                
                                                <td style=" min-width: 150px;"> </td>
                                                <td style=" min-width: 100px"> </td>
                                                 <td style="min-width:200px"></td>
                                                <td style=" min-width: 80px"> </td>
                                                
                                                <td style=" min-width: 80px;font-weight: bold"><?=($sub_amount)?> </td>
                                               <td style=" min-width: 80px;font-weight: bold"><?=($tax_amount)?> </td>
                                               
                                                <td style=" min-width: 80px;font-weight: bold"> <?=($inv_amount)?> </td>
                                               <td style=" min-width: 80px;font-weight: bold"><?=($tot_paid_sup)?></td>
                                               
                                               <?php if($pd=='no'){  ?>
                                               <td style=" min-width: 80px"></td>
                                              <?php }else{ ?>
                                               
                                               <td style=" min-width: 80px;font-weight: bold"><?=($inv_amount-$tot_paid_sup)?></td>
                                               
                                               <?php } ?>
                                                
                                                  <td style="min-width:70px"> </td>
                                                   <td style="min-width:70px"> </td>
                                                   <td style="min-width:70px">  </td>
                                            </tr>    

<?php
}
                                        
}
 
?>

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
                                            