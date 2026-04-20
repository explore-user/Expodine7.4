<?php
session_start();
include("../database.class.php"); 
$database	= new Database();
$sql_branch =  $database->mysqlQuery("Select be_branchname,be_address from tbl_branchmaster "); 
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

<style>
    .expencevoucher{
      display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }
    .voucher{
      display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    column-gap: 136px;
    }
    .voucher-data{
    font-size: 24px;
    font-weight: 500;
    color: #555;
    
    }
</style>

<input type="submit" value="PRINT"  id="printbutton" style="position: absolute;top: 10;left: 10px;cursor: pointer;background-color: darkred;border: 0px;color: white" onclick="return print_page()" />
          
<input type="submit" value="CLOSE" id="closebutton" style="position: absolute;top: 10;left: 90px;margin-right:55px;cursor: pointer;border: 0px;background-color: darkred;color: white" onclick="return close_page()" />


<script type="text/javascript">
function print_page()
{
    document.getElementById("printbutton").style.display = "none";	
    document.getElementById("closebutton").style.display = "none";	
                 

	window.print();
                document.getElementById("printbutton").style.display = "block";	
                document.getElementById("closebutton").style.display = "block";	
       
			
}
  function close_page(){
   window.top.close();
}
</script>


<?php
                  
 if(($_REQUEST['type']=="supplier_voucher"))
  {
      $sql_login  =  $database->mysqlQuery("select * from  tbl_supplier_voucher where sv_id='".$_REQUEST['id']."' "); 
         $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login)
	    {
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	    {
              ?>
                             
   <div class="expencevoucher" id="print_div">
                        <img style="width:60px" src="img/report-logo/reportlogo.png" alt="">
                      <h2><?=$branchname?></h2>
                      <h4>SUPPLIER VOUCHER</h4>
                      <div class="voucher">
                       <div><span>Date : </span><span class="voucher-data"><?=$result_login['sv_date']?> <hr> </span></div>
                       <div><span> Type : </span><span class="voucher-data"><?=$result_login['sv_purchase_type']?>  <hr> </span></div>
                       
                       <?php
                                              
                             $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login['sv_from']."'  "); 
	                        $num_login6   = $database->mysqlNumRows($sql_login6);
					if($num_login6){
                                          while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>From Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                          <?php } } ?>
                       
                       
                           <?php
                                              
                            $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_vendor_id='".$result_login['sv_vendor_id']."'  "); 
	                     $num_login6   = $database->mysqlNumRows($sql_login6);
				if($num_login6){
                                   while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>To Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                        <?php } } ?>
                       
                       
                       
                       <div><span>Amount : </span><span class="voucher-data"><?=$result_login['sv_paid_amount']?>  <hr> </span></div>
                      
                     
                        <div><span>By : </span><span class="voucher-data"><?=$result_login['sv_login']?>  <hr> </span></div>
                         <div><span>Transaction Details : </span><span class="voucher-data"><?=$result_login['sv_trn_detail']?>  <hr> </span></div>
                          <div><span>Particulars : </span><span class="voucher-data"><?=$result_login['sv_remarks']?>  <hr> </span></div>
                      </div>
                    </div>
<?php
 }
  }

}

if(($_REQUEST['type']=="expense_voucher"))
  {
      $sql_login  =  $database->mysqlQuery("select * from tbl_expense_voucher where ev_id='".$_REQUEST['id']."' "); 
         $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login)
	    {
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	    {
              ?>
                             
<div class="expencevoucher" id="print_div">
                        <img style="width:60px" src="img/report-logo/reportlogo.png" alt="">
                      <h2><?=$branchname?></h2>
                      <h4>EXPENSE VOUCHER</h4>
                      <div class="voucher">
                       <div><span>Date : </span><span class="voucher-data"><?=$result_login['ev_date']?> <hr> </span></div>
                       <div><span>Acc Type : </span><span class="voucher-data"><?=$result_login['ev_acc_type']?>  <hr> </span></div>
                       
                       <?php
                                              
                             $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login['ev_from_acc']."'  "); 
	                        $num_login6   = $database->mysqlNumRows($sql_login6);
					if($num_login6){
                                          while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>From Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                          <?php } } ?>
                       
                       
                           <?php
                                              
                            $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login['ev_to_acc']."'  "); 
	                     $num_login6   = $database->mysqlNumRows($sql_login6);
				if($num_login6){
                                   while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>To Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                        <?php } } ?>
                       
                       
                       
                       <div><span>Amount : </span><span class="voucher-data"><?=$result_login['ev_amount']?>  <hr> </span></div>
                        <div><span>By : </span><span class="voucher-data"><?=$result_login['ev_login']?>  <hr> </span></div>
                       <div><span>Transaction Details : </span><span class="voucher-data"><?=$result_login['ev_transaction_data']?>  <hr> </span></div>
                       <div><span>Particulars : </span><span class="voucher-data"><?=$result_login['ev_remarks']?>  <hr> </span></div>
                       
                      </div>
                    </div>
<?php
 }
  }

}


if(($_REQUEST['type']=="employee_voucher"))
  {
      $sql_login  =  $database->mysqlQuery("select * from tbl_employee_voucher where ev_id='".$_REQUEST['id']."' "); 
         $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login)
	    {
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	    {
              ?>
                             
<div class="expencevoucher" id="print_div">
                        <img style="width:60px" src="img/report-logo/reportlogo.png" alt="">
                      <h2><?=$branchname?></h2>
                      <h4>EXPENSE VOUCHER</h4>
                      <div class="voucher">
                       <div><span>Date : </span><span class="voucher-data"><?=$result_login['ev_date']?> <hr> </span></div>
                       <div><span>Acc Type : </span><span class="voucher-data"><?=$result_login['ev_pay_type']?>  <hr> </span></div>
                       
                       <?php
                                              
                             $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_id='".$result_login['ev_from']."'  "); 
	                        $num_login6   = $database->mysqlNumRows($sql_login6);
					if($num_login6){
                                          while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>From Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                          <?php } } ?>
                       
                       
                           <?php
                                              
                            $sql_login6  =  $database->mysqlQuery("select * from tbl_ledger_master  where tlm_staff_id='".$result_login['ev_employee_id']."'  "); 
	                     $num_login6   = $database->mysqlNumRows($sql_login6);
				if($num_login6){
                                   while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
					{ 
                                        ?>
                       <div><span>To Acc : </span><span class="voucher-data"><?=$result_login6['tlm_ledger_name']?>  <hr> </span></div>
                        <?php } } ?>
                       
                       
                       
                       <div><span>Amount : </span><span class="voucher-data"><?=$result_login['ev_amount']?>  <hr> </span></div>
                         <div><span>By : </span><span class="voucher-data"><?=$result_login['ev_login']?>  <hr> </span></div>
                       <div><span>Transaction Details : </span><span class="voucher-data"><?=$result_login['ev_trans']?>  <hr> </span></div>
                      
                      
                         <div><span>Particulars : </span><span class="voucher-data"><?=$result_login['ev_remarks']?>  <hr> </span></div>
                      </div>
                    </div>
<?php
 }
  }

}

if(($_REQUEST['type']=="voucher_payment_old"))
  {
      $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment where vp_id='".$_REQUEST['id']."' "); 
         $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login)
	    {
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	    {
              ?>
                             
<div class="expencevoucher" id="print_div">
                        <img style="width:60px" src="img/report-logo/reportlogo.png" alt="">
                      <h2><?=$branchname?></h2>
                      <h4> VOUCHER PAYMENT</h4>
                      <div class="voucher">
                       <div><span>Date : </span><span class="voucher-data"><?=$result_login['vp_dayclose_date']?> <hr> </span></div>
                       <div><span> Type : </span><span class="voucher-data"><?=$result_login['vp_type']?>  <hr> </span></div>
                       
                       <div><span>Amount : </span><span class="voucher-data"><?=$result_login['vp_amount']?>  <hr> </span></div>
                      
                       <div><span>Paid To  : </span><span class="voucher-data"><?=$result_login['vp_paidto']?>  <hr> </span></div>
                        <div><span>Received By : </span><span class="voucher-data"><?=$result_login['vp_receivedby']?>  <hr> </span></div>
                        <div><span>Pay Mode : </span><span class="voucher-data"><?=$result_login['vp_paymentmode']?>  <hr> </span></div>
                         <div><span>Remarks : </span><span class="voucher-data"><?=$result_login['vp_remarks']?>  <hr> </span></div>
                      </div>
                    </div>
<?php
 }
  }

}
?>
