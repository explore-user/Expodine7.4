<style>td{padding:5px;font-family:sans-serif;font-size: 14px;}
</style>
<style>
@page { size: auto;  margin: 0mm; }
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
  
  
 if(isset($_REQUEST['a4_daybook']) && $_REQUEST['a4_daybook']=='a4_daybook_print'){
         
           ?>
    
    <span onclick="return ref_page();" id="ref_btn" style="border-radius: 5px;float: right;cursor: pointer;padding:5px 10px;color:#fff;display: none" ><a style="color:#fff;text-decoration:none" > <img src="img/refresh.png"  > </a></span>
    <span id="back_btn" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff" ><a style="color:#fff;text-decoration:none" href="daybook.php"> GO BACK </a></span>
<span id="print_btn" onclick="return print_page();" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff;margin-right:10px" > PRINT </span>


<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;padding-top: 0px;" colspan="17">
       <img width="150px" style="margin-top: -37px;" src="img/report-logo/reportlogo.png" />
    
       
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>DAYBOOK REPORT </strong></th>
      </tr>
<tr >
 <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>DATE <?=$_REQUEST['fromdt']?> :  <?php if($_REQUEST['todt']!=''){ echo $_REQUEST['todt']; }else{ echo date('Y-m-d'); } ?></strong></th>
      </tr>
    </thead>
    </table> 
    


<table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                            <td style="width:15%">Date</td> 
                                            <td style="width:10%">Voucher Id</td>                                                    
                                            <td style="width:10%">Type</td>                                                   
                                            <td style="width:18%">Account Name</td>
                                            <td style="width:30%">Particular</td>
                                            <td style="width:18%">Debit Amt </td>
                                            <td style="width:18%">Credit Amt</td>                                              
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                            <tr>
                                            <td style="width:15%"></td> 
                                            <td style="width:10%"></td>                                                    
                                            <td style="width:10%"></td>                                                   
                                            <td style="width:18%"></td>
                                            <td style="width:30%"></td>
                                            <td style="width:18%;color: grey;text-decoration: underline">(inwards Qty) </td>
                                            <td style="width:18%;color: grey;text-decoration: underline">(outwards Qty)</td>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>

     
         <?php
       
 if($_REQUEST['type']=='all'  )
  {                        

        $debt=0;
        $crdt=0;

    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
      $to = $_REQUEST['todt'];                         
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
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
                              
$dates = array();                    
$period = new DatePeriod(new DateTime($from), new DateInterval('P1D'), new DateTime($to.' +1 day'));

foreach ($period as $date) 
{
$dates[] = $date->format("Y-m-d");
}

for($i=0;$i<count($dates);$i++){
  //-------------------------- cash sale----------------------------------//  
$subtotalcashdi=0;  $roundofdi=0;   
$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
$sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot 
                                            from tbl_tablebillmaster 
                                            left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id 
                                            where bm_status='Closed' and bm_dayclosedate='$dates[$i]' 
                                            order by bm_dayclosedate,bm_billtime ASC"); 
$num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
if($num_logincashdi){
    while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
      { 
          if($result_logincashdi['tot'] != "")	{
              $subtotalcashdi =$subtotalcashdi + $result_logincashdi['tot'];
              $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }
      }} 

$subtotalcashta=0; $roundofta=0;   
$string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
    $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot 
                                                from tbl_takeaway_billmaster 
                                                left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id 
                                                where tab_status='Closed' and tab_dayclosedate='$dates[$i]'  
                                                order by tab_dayclosedate,tab_time ASC");   
$num_logincashta   = $database->mysqlNumRows($sql_logincashta);
if($num_logincashta){
    while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
      { 
          if($result_logincashta['tot'] != "")	{
              $subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
              $roundofta=$roundofta+$result_logincashta['roundofta'];
            }
          }} 
    $totalcash=$subtotalcashdi+$subtotalcashta+$roundofdi+$roundofta; 
    if($totalcash)
    {
        ?>                                                              
              <tr>
                  <td><?php echo $dates[$i]; ?> </td>
                  <td></td>
                  <td>Sales</td>
                  <td>Cash</td>
                  <td></td>                 
                  <td><?= number_format(($totalcash),$_SESSION['be_decimal'])?></td>
                  <td></td>
              </tr>                                
            
            <tr><td colspan=7></td></tr> 
            <?php  } 
 ////--------------------------card sale------------------------------////    
    $sql_logincredit  =  $database->mysqlQuery("select x.bnk,sum(x.tot) as total from ( 
                                                select  distinct (b.bm_name) as bnk,sum(bm.bm_transactionamount) as tot  
                                                FROM tbl_tablebillmaster bm left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                                                left join tbl_bankmaster b on  b.bm_id = bm.bm_transcbank  
                                                where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                                                AND bm.bm_complimentary!='Y' AND bm_dayclosedate='$dates[$i]' group by bnk  union all
                                                select distinct (b.bm_name) as bnk, sum(bm.tab_transactionamount) as tot  
                                                FROM tbl_takeaway_billmaster bm 
                                                left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id  
                                                left join tbl_bankmaster b  on  b.bm_id = bm.tab_transcbank 
                                                where tbl_paymentmode.pym_code='credit' and bm.tab_status='Closed' 
                                                AND bm.tab_complimentary!='Y' AND tab_dayclosedate='$dates[$i]' group by bnk
                                                )x group by x.bnk "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);


	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{ ?>
            <tr>
            <td><?php echo $dates[$i]; ?></td>
            <td></td>
            <td>Sales</td>
            <td>Card</td>          
            <td><?='* '.$result_logincredit['bnk']?></td>
            <td><?=number_format($result_logincredit['total'],$_SESSION['be_decimal'])?></td>
            <td></td>
            </tr>
            <?php   
            } ?>
            <tr><td colspan=7></td></tr>  
          <?php }

//--------------------------------credit sale-----------------------------------------//

$stringcrd= "(bm.bm_dayclosedate='$dates[$i]'  or  tbm.tab_dayclosedate='$dates[$i]' ) ";
         $st="";   $final=0;  
         $sql_login  =  $database->mysqlQuery("select sum(cd.cd_amount) as tot,s.ser_firstname,l.ly_firstname,
                                             cm.ct_corporatename,c.crd_staffid,c.crd_corporateid,c.crd_guestid,cd.cd_settled 
                                             from tbl_credit_master as c 
                                             left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid 
                                             left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid                                              
                                             left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode 
                                             left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id 
                                             left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  
                                             left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno 
                                             WHERE $stringcrd group by cd.cd_masterid   order by cd.cd_dateofentry ASC"); 	 
        
            $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login)
            {        
                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                      {
                  if($result_login['crd_staffid']!="")				
                  {
                      $party=$result_login['ser_firstname'];					
                      $cat='Staff';
                  }             			
                  else if($result_login['crd_corporateid']!="")
                  {
                      $party=$result_login['ct_corporatename'];
                      $cat="Corporate";
                  }
                  else if($result_login['crd_guestid']!="")
                  {
                      $party=$result_login['ly_firstname'];
                      $cat="Guest";
                  } ?>
               <tr >
                <td><?php echo $dates[$i]; ?></td>
                <td></td>
                <td>Sales</td>
                <td>Credit Sale</td>
                <td><?='* '.$party?></td>
                <?php if($result_login['cd_settled']=='Y'){ ?>
                  <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td> 
                  <?php } else { ?>
                         <td></td>     
                  <?php }?>        
                <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>   
                   
              </tr> 
              <?php          	
              } ?>
               <tr><td colspan=7></td></tr>  
             <?php  } ?>

             <?php 
/////-----------------------------loan-------------------------------////  
             
          $tot_debit_loan_adv=0; $tot_credit_loan_adv=0;  
          $sql_login457  =  $database->mysqlQuery("select tla_id,tla_date,tla_amount,tla_to,tla_particulars,tla_from 
                                                   from tbl_loan_advance 
                                                   where tla_amount!='' and tla_from!='' and tla_date ='$dates[$i]' order by tla_id asc"); 
          $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457)
          { 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_credit_loan_adv=$tot_credit_loan_adv+$result_login['tla_amount']; 
          $tot_debit_loan_adv=$tot_debit_loan_adv+$result_login['tla_amount']; ?>
          
          <tr>
                <td style="width:10%;"><?=$result_login['tla_date']?></td>
                <td style="width:10%;">L <?=$result_login['tla_id']?></td>
                <td style="width:10%;">Loans</td>
            <?php
            $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tla_from']."'"); 
            $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4)
          {                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>                                       
              <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
         <?php }}  ?>  
                                              
              <td style="width:30%;"><?=$result_login['tla_particulars']?></td>
              <td style="width:18%;"></td>
              <td style="width:18%;"><?= number_format($result_login['tla_amount'],$_SESSION['be_decimal'])?></td>   
            </tr>

            <tr>
                <td style="width:10%;"><?=$result_login['tla_date']?></td>
                <td style="width:10%;">L <?=$result_login['tla_id']?></td>
                <td style="width:10%;">Loans</td>
            <?php
            $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master where tlm_id='".$result_login['tla_to']."'"); 
            $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4)
          {                                          
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>                                       
              <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
         <?php }}  ?>  
                                              
              <td style="width:30%;"><?=$result_login['tla_particulars']?></td>             
              <td style="width:18%;"><?= number_format($result_login['tla_amount'],$_SESSION['be_decimal'])?></td>
              <td style="width:18%;"></td>   
            </tr>
           <?php   }  ?>
           <tr><td colspan=7></td></tr>                                                                         
      <?php
            }                 
        ?>                          
                <!-----------------------------------------/////////////loan adv to acc //////////------------------------------------------------>
        <?php                                
          $tot_debit_loan_adv1=0; $tot_credit_loan_adv1=0;  
          $sql_login457  =  $database->mysqlQuery("select tla_id,tla_date,tla_paid,tla_from,tla_particulars,tla_amount,tla_to 
                                                   from tbl_loan_advance  
                                                   where tla_paid!='' and tla_to !='' and tla_date='$dates[$i]' order by tla_id asc "); 
	
           $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457)
          { 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_debit_loan_adv1=$tot_debit_loan_adv1+$result_login['tla_paid'];
          $tot_credit_loan_adv1=$tot_credit_loan_adv1+$result_login['tla_paid']
          ?>
              <tr>
              <td style="width:10%;"><?=$result_login['tla_date']?></td>
                <td style="width:10%;">L <?=$result_login['tla_id']?></td>
                <td style="width:10%;">Loan-Return</td>
              <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tla_to']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4)
          {                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>  
                                              
            <td style="width:30%;"><?=$result_login['tla_particulars']?></td>
            <td style="width:18%;"><?= number_format($result_login['tla_paid'],$_SESSION['be_decimal'])?></td>  
            <td style="width:18%;"></td> 
          </tr>

          <tr>
          <td style="width:10%;"><?=$result_login['tla_date']?></td>
                <td style="width:10%;">L <?=$result_login['tla_id']?></td>
                <td style="width:10%;">Loan-Return</td>
              <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tla_from']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					if($num_login4)
          {                           
					while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					{ ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                            
            <td style="width:30%;"><?=$result_login['tla_particulars']?></td>
            <td style="width:18%;"></td> 
            <td style="width:18%;"><?= number_format($result_login['tla_paid'],$_SESSION['be_decimal'])?></td>           
          </tr>
          <?php    }    ?>
                                              
            <tr><td colspan=7></td></tr>      
                               
      <?php
        }   
      ?>     
                                        
     <!------ /////////////Receipt  //////////-------------- -->   
     <?php                                
        $tot_debit_rec=0; $tot_credit_rec=0;  
        $sql_login457  =  $database->mysqlQuery("select tr_id,tr_amount,tr_date,tr_to,tr_particulars,tr_from
                                                 from tbl_receipts tr
                                                 where tr_from !='' and tr_to !='' and tr_date='$dates[$i]' order by tr_id asc "); 
	
        $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457)
          { 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
            $tot_credit_rec=$tot_credit_rec+$result_login['tr_amount']; ?>
        <tr>
          <td style="width:10%;"><?=$result_login['tr_date']?></td>
          <td style="width:10%;">R <?=$result_login['tr_id']?></td>
          <td style="width:10%;">Receipt</td>
          <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tr_to']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                    
          <td style="width:30%;"><?=$result_login['tr_particulars']?></td>
          <td style="width:18%;"><?= number_format($result_login['tr_amount'],$_SESSION['be_decimal'])?></td>   
          <td style="width:18%;"></td>
        </tr>

        <tr>
          <td style="width:10%;"><?=$result_login['tr_date']?></td>
          <td style="width:10%;">R <?=$result_login['tr_id']?></td>
          <td style="width:10%;">Receipt</td>
          <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tr_from']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                    
          <td style="width:30%;"><?=$result_login['tr_particulars']?></td>
          <td style="width:18%;"></td>
          <td style="width:18%;"><?= number_format($result_login['tr_amount'],$_SESSION['be_decimal'])?></td>            
        </tr>
          <?php    }    ?>
          <tr><td colspan=7></td></tr>   
     <?php }     
 ?>                                               
 <!------------------/////////////Contra //////////------------------------->
        <?php                                
          $tot_debit15=0; $tot_credit15=0;  
          $sql_login457  =  $database->mysqlQuery("select cv_id,cv_amount,cv_date,cv_to_acc,cv_remarks,cv_from_acc 
                                                    from tbl_contra_voucher tcv
                                                    where cv_from_acc !='' and cv_to_acc !='' and cv_date='$dates[$i]' order by cv_id asc"); 
	
          $num_login457   = $database->mysqlNumRows($sql_login457);
					if($num_login457){ 
					while($result_login  = $database->mysqlFetchArray($sql_login457)) 
					{ 
          $tot_credit15=$tot_credit15+$result_login['cv_amount']; ?>
          <tr>
          <td style="width:10%;"><?=$result_login['cv_date']?></td>
          <td style="width:10%;">C <?=$result_login['cv_id']?></td>
          <td style="width:10%;">Contra</td>  
          <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['cv_to_acc']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                    
          <td style="width:30%;"><?=$result_login['cv_remarks']?></td>         
          <td style="width:18%;"><?= number_format($result_login['cv_amount'],$_SESSION['be_decimal'])?></td>   
          <td style="width:18%;"></td>
          </tr>

          <tr>
            <td style="width:10%;"><?=$result_login['cv_date']?></td>
            <td style="width:10%;">C <?=$result_login['cv_id']?></td>
            <td style="width:10%;">Contra</td>
            <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['cv_from_acc']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>      
            <td style="width:30%;"><?=$result_login['cv_remarks']?></td>
            <td style="width:18%;"></td>
            <td style="width:18%;"><?= number_format($result_login['cv_amount'],$_SESSION['be_decimal'])?></td>   
          </tr>

          <?php    }    ?>
         <tr><td colspan=7></td></tr>                                                   
                                       
      <?php  }   ?>   

       <!-------------------------/////////////supplier asset ////////// ----------------------------->
               
        <?php                                
   
          $tot_debit11=0; $tot_credit11=0;
           $sql_login45  =  $database->mysqlQuery("select tpd_id,tpd_date,tpd_paid_amount,tpd_from_acc,tpd_remarks,tpd_credit_amount,tpd_type_pay,tpd_netamount,tpd_vendor 
                                                  from tbl_asset_purchase_invoice_detail tap  
                                                  where tpd_vendor !='' and tpd_from_acc !='' and tpd_date='$dates[$i]' order by tpd_id asc"); 
	
           $num_login45   = $database->mysqlNumRows($sql_login45);
					if($num_login45){ 
					while($result_login  = $database->mysqlFetchArray($sql_login45)) 
					{ 
          $tot_debit11=$tot_debit11+$result_login['tpd_paid_amount'];
          ?>
          <tr>
            <td style="width:10%;"><?=$result_login['tpd_date']?></td>
            <td style="width:10%;">AS <?=$result_login['tpd_id']?></td>
            <td style="width:10%;">Asset Supplier</td>
            <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tpd_from_acc']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                                  
            <td style="width:30%;"><?=$result_login['tpd_remarks']?></td>  
            <td style="width:30%;"></td>                                 
            <td style="width:18%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>   
          </tr> 
          
          <tr>
             <td style="width:10%;"><?=$result_login['tpd_date']?></td>
             <td style="width:10%;">AS <?=$result_login['tpd_id']?></td>
             <td style="width:10%;">Asset Supplier</td>
             <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_login['tpd_vendor']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>      
            <td style="width:30%;"><?=$result_login['tpd_remarks']?></td>                             
            <td style="width:18%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>
            <?php if($result_login['tpd_type_pay']=='First'){  ?>
            <td style="width:18%;"><?= number_format($result_login['tpd_netamount'],$_SESSION['be_decimal'])?></td>
            <?php }else{ ?>
            <td style="width:18%;"></td>
            <?php } ?>                             
           </tr>
          <?php    }    ?>    
             <tr><td colspan=7></td></tr>                
      <?php }    
        ?>   

                                  
<!----------------------------------------/////////////supplier //////////------------------------------------------------------->                                                                                 
      <?php
                                                                    
      $tot_debit6=0;$tot_credit6=0; $rt=0;
      $sql_login66  =  $database->mysqlQuery("select sv_id,sv_paid_amount,sv_date,sv_from,sv_remarks,sv_type_pay,sv_invoice_amount,sv_discount,sv_vendor_id 
                                              from tbl_supplier_voucher ts
                                             where ts.sv_vendor_id !='' and ts.sv_from!='' and ts.sv_date='$dates[$i]' order by ts.sv_id asc "); 
	
      $num_login66   = $database->mysqlNumRows($sql_login66);
			if($num_login66){ ?>                             
      <?php
					while($result_login66  = $database->mysqlFetchArray($sql_login66)) 
					{ 
          $tot_debit6=$tot_debit6+$result_login66['sv_paid_amount'];                    
         ?>
         <tr>
          <td style="width:10%;"><?=$result_login66['sv_date']?></td>
          <td style="width:10%;">S <?=$result_login66['sv_id']?></td>
          <td style="width:10%;">Supplier</td>
          <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login66['sv_from']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                  
          <td style="width:30%;"><?=$result_login66['sv_remarks']?></td>
          <td style="width:18%;"></td>
          <td style="width:18%;"><?=$result_login66['sv_paid_amount']?></td>         
          </tr>

          <tr>
        <td style="width:10%;"><?=$result_login66['sv_date']?></td>
        <td style="width:10%;">S <?=$result_login66['sv_id']?></td>
        <td style="width:10%;">Supplier</td>
        <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_login66['sv_vendor_id']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
            <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
          <?php }}  ?>                                                  
        <td style="width:30%;"><?=$result_login66['sv_remarks']?></td>
        <td style="width:18%;"><?= number_format($result_login66['sv_paid_amount'],$_SESSION['be_decimal'])?></td>
        <?php if($result_login66['sv_type_pay']=='First') {?>
        <td style="width:18%;"><?= number_format($result_login66['sv_invoice_amount'],$_SESSION['be_decimal'])?></td>
        <?php }
         else { ?> 
        <td style="width:18%;"></td>
       <?php } ?>        
        </tr>
          <?php    }    ?>           
          <tr><td colspan=7></td></tr>                                                                                              
      <?php
       }                       
                    
                                        
       /////////////---------------return payment ----------------------//////////                                
                   
   
       $tot_debitr1=0;$tot_creditr1=0;
       $sql_login  =  $database->mysqlQuery("select tr_id,tr_date,tr_return_amount,tr_vendor,tr_particulars,tr_to_acc 
                                             from tbl_return_payment tr
                                             where tr_vendor !='' and tr_to_acc!='' and date(tr_date)='$dates[$i]' order by tr_id asc"); 	
       $num_login   = $database->mysqlNumRows($sql_login);
       if($num_login){ 
       while($result_login  = $database->mysqlFetchArray($sql_login)) 
       {                    
       $tot_debitr1=$tot_debitr1+$result_login['tr_return_amount']; ?>
           <tr>
           <td style="width:10%;"><?=date("Y-m-d",strtotime($result_login['tr_date']))?></td>
           <td style="width:10%;">SR <?=$result_login['tr_id']?></td>
           <td style="width:18%;">Supplier Return</td> 
           <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tr_to_acc']."' ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>                                       
           <td style="width:30%;"><?=$result_login['tr_particulars']?></td>                                                                                 
           <td style="width:18%;"><?=$result_login['tr_return_amount']?></td>
           <td style="width:18%;"></td>    
          </tr>  
       <tr>
         <td style="width:10%;"><?=date("Y-m-d",strtotime($result_login['tr_date']))?></td>
         <td style="width:18%;">SR <?=$result_login['tr_id']?></td> 
         <td style="width:18%;">Supplier Return</td> 
         <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_login['tr_vendor']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?> 
         <td style="width:30%;"><?=$result_login['tr_particulars']?></td>
         <td style="width:18%;"></td>
         <td style="width:18%;"><?=$result_login['tr_return_amount']?></td>
        
        </tr>
       <?php    }   ?>
       <tr><td colspan=7></td></tr> 
           <?php    }      
                         
                /////////////return payment end //////////                                
                         
   //////////////------------employeeeee------------///////////////////////////////

   $tot_debit1=0; $tot_credit1=0;
   $sql_login5  =  $database->mysqlQuery("select ev_id,ev_date,ev_amount,ev_employee_id,ev_remarks,ev_amount,ev_pay_type_acc,
                                           ev_net_salary_new,ev_from
                                          from tbl_employee_voucher ts
                                          where ts.ev_from !='' and  ts.ev_employee_id !='' and ts.ev_date='$dates[$i]' order by ev_id asc"); 

   $num_login5   = $database->mysqlNumRows($sql_login5);
       if($num_login5){  
       while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
       { 
       $tot_credit1=$tot_credit1+$result_login5['ev_amount'];        
        ?>
       <tr>
       <td style="width:10%;"><?=$result_login5['ev_date']?></td>
       <td style="width:10%;">E <?=$result_login5['ev_id']?></td>
       <td style="width:10%;">Employee</td>
       <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login5['ev_from']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>                                             
       <td style="width:30%;"><?=$result_login5['ev_remarks']?></td>
       <td style="width:18%;"></td>
       <td style="width:18%;"><?=$result_login5['ev_amount']?></td>
       </tr>

     <tr>
       <td style="width:10%;"><?=$result_login5['ev_date']?></td>
       <td style="width:10%;">E <?=$result_login5['ev_id']?></td>
       <td style="width:10%;">Employee</td>
       <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_login5['ev_employee_id']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>                                             
       <td style="width:30%;"><?=$result_login5['ev_remarks']?></td>         
       <td style="width:18%;"><?=number_format($result_login5['ev_amount'],$_SESSION['be_decimal'])?></td>
       <?php if($result_login5['ev_pay_type_acc']=='First') {?>
       <td style="width:18%;"><?=number_format($result_login5['ev_net_salary_new'],$_SESSION['be_decimal'])?></td>
       <?php } else {?>
         <td style="width:18%;"></td>
       <?php } ?>
     </tr>
       <?php    }   ?> 
       <tr><td colspan=7></td></tr> 
          <?php  }   

                            
   //////////////direct expense to///////////////////////////////
   
    $tot_debit2=0; $tot_credit2=0;
        $sql_login78  =  $database->mysqlQuery("select ev_id,ev_amount,ev_date,ev_from_acc,ev_remarks,ev_to_acc 
                                               from tbl_expense_voucher tes 
                                               left join tbl_ledger_master lm on tes.ev_from_acc=lm.tlm_id  
                                               where tes.ev_acc_type='Direct Expense' and tes.ev_to_acc !='' 
                                               and tes.ev_from_acc !='' and tes.ev_date='$dates[$i]' order by ev_id asc"); 	
        $num_login78   = $database->mysqlNumRows($sql_login78);
       if($num_login78){ 
       while($result_login78  = $database->mysqlFetchArray($sql_login78)) 
       {          
       $tot_debit2=$tot_debit2+$result_login78['ev_amount']; ?>
     <tr>
       <td style="width:10%;"><?=$result_login78['ev_date']?></td>
       <td style="width:10%;">EX <?=$result_login78['ev_id']?></td>
       <td style="width:10%;">Direct Exp</td>
       <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login78['ev_from_acc']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>                                                
       <td style="width:30%;"><?=$result_login78['ev_remarks']?></td>
       <td style="width:18%;"></td>
       <td style="width:18%;"><?=  number_format($result_login78['ev_amount'],$_SESSION['be_decimal'])?></td>         
       </tr> 
       
       <tr>
       <td style="width:10%;"><?=$result_login78['ev_date']?></td>
       <td style="width:10%;">EX <?=$result_login78['ev_id']?></td>
       <td style="width:10%;">Direct Exp</td>
       <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login78['ev_to_acc']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>                                  
       <td style="width:30%;"><?=$result_login78['ev_remarks']?></td>         
       <td style="width:18%;"><?=  number_format($result_login78['ev_amount'],$_SESSION['be_decimal'])?></td>
       <td style="width:18%;"></td>
       </tr>
       <?php    }   ?>
     <tr><td colspan=7></td></tr>                              
     <?php   } 
                                                                                                                                  
//////////////-----------INDIRECT EXPENSE ------------- ///////////////////////////////
 
    $tot_debit4=0; $tot_credit4=0;
        $sql_login79  =  $database->mysqlQuery("select ev_id,ev_date,ev_amount,ev_to_acc,ev_remarks,ev_from_acc
                                               from tbl_expense_voucher tes  
                                               left join tbl_ledger_master tlm on tes.ev_to_acc=tlm.tlm_id
                                               where tes.ev_acc_type='Indirect Expense' and tes.ev_from_acc !='' 
                                               and tes.ev_to_acc!='' and tes.ev_date='$dates[$i]' order by ev_id asc"); 

       $num_login79   = $database->mysqlNumRows($sql_login79);
       if($num_login79){
       while($result_login79  = $database->mysqlFetchArray($sql_login79)) 
       { 
      $tot_credit4=$tot_credit4+$result_login79['ev_amount'];  ?>

     <tr>
         <td style="width:10%;"><?=$result_login79['ev_date']?></td>
         <td style="width:10%;">IEX <?=$result_login79['ev_id']?></td>
         <td style="width:10%;">Indirect Exp</td>
         <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login79['ev_from_acc']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>
         <td style="width:30%;"><?=$result_login79['ev_remarks']?></td>
         <td style="width:18%;"></td>
         <td style="width:18%;"><?=  number_format($result_login79['ev_amount'],$_SESSION['be_decimal'])?></td>           
       </tr>

       <tr>
       <td style="width:10%;"><?=$result_login79['ev_date']?></td>
       <td style="width:10%;">IEX <?=$result_login79['ev_id']?></td>
       <td style="width:10%;">Indirect Exp</td>
       <?php
           $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login79['ev_to_acc']."'  ");
           $num_login4   = $database->mysqlNumRows($sql_login2);
           if($num_login4)
           {                           
           while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
           { ?>                                       
         <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
       <?php }}  ?>      
       <td style="width:30%;"><?=$result_login79['ev_remarks']?></td>         
       <td style="width:18%;"><?=  number_format($result_login79['ev_amount'],$_SESSION['be_decimal'])?></td>
       <td style="width:18%;"></td>
       </tr>                  
      <?php    }   ?>
      <tr><td colspan=7></td></tr>                                                                                             
<?php } }
                       
   }
       
   /////////////Credit purchase-------- /////////---------------- -//
   if($_REQUEST['type']=='credit_purchase'){ 

        
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
      $from = $_REQUEST['fromdt'];
      $to= $_REQUEST['todt'];                      
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
      $from = $_REQUEST['fromdt'];
			$to=date("Y-m-d");                     
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
      $to= $_REQUEST['todt'];                       
		}
    else
	  {
		  $from=date("Y-m-d");
			$to=date("Y-m-d");
    }  
     
                             
    $period = new DatePeriod(new DateTime($from), new DateInterval('P1D'), new DateTime($to.' +1 day'));

    foreach ($period as $date) 
    {
        $dates[] = $date->format("Y-m-d");
    } 
          $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_vendor_id from tbl_ledger_master where tlm_vendor_id!='' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login)
          {
					while($result_login5  = $database->mysqlFetchArray($sql_login)) 
					{   
            $vendors[]=$result_login5['tlm_vendor_id'];
          }
          } 
        
          for($i=0;$i<count($dates);$i++){
                   
            for($ii=0;$ii<count($vendors);$ii++){
    
          ///////////////credit purchase  --- supplier from acc  asset ////////// -------------- -
              $sql_login454  =  $database->mysqlQuery("select tpd_id,tpd_date,tpd_paid_amount,tpd_remarks,tpd_vendor,tpd_invoice,tpd_type_pay,
                                                      tpd_netamount,tpd_from_acc
                                                      from tbl_asset_purchase_invoice_detail tap                                          
                                                      where tpd_paid_amount!=tpd_netamount 
                                                      and tpd_vendor ='$vendors[$ii]' and  tpd_date='$dates[$i]' order by tpd_id asc");     
                                                                              
              $num_login454   = $database->mysqlNumRows($sql_login454);
                if($num_login454)
                {                                          
                while($result_login  = $database->mysqlFetchArray($sql_login454)) 
                { 
                $tot_credit_pay1=$tot_credit_pay1+$result_login['tpd_paid_amount'];
                ?>
                <tr>
                <td style="width:10%;"><?=$result_login['tpd_date']?></td>
                <td style="width:10%;">AS <?=$result_login['tpd_id']?></td>
                <td style="width:10%;">Asset Supplier </td>
                <?php
                    $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_login['tpd_vendor']."'  ");
                    $num_login4   = $database->mysqlNumRows($sql_login2);
                if($num_login4)
                {                           
                while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
                { ?>                                       
                  <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
                <?php }}  ?>  
                <td style="width:30%;"><?=$result_login['tpd_remarks']?></td>
                <td style="width:18%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>
                <?php 
                if($result_login['tpd_type_pay']=='First')
                { ?>
                  <td style="width:18%;"><?= number_format($result_login['tpd_netamount'],$_SESSION['be_decimal'])?></td>
                <?php }else{ ?>
                  <td style="width:18%;"></td> 
                <?php  } ?>  
                </tr>
      
                <tr>
                <td style="width:10%;"><?=$result_login['tpd_date']?></td>
                <td style="width:10%;">AS <?=$result_login['tpd_id']?></td>
                <td style="width:10%;">Asset Supplier</td>
                <?php
                    $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['tpd_from_acc']."'  ");
                    $num_login4   = $database->mysqlNumRows($sql_login2);
                if($num_login4)
                {                           
                while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
                { ?>                                       
                  <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
                <?php }}  ?>  
                <td style="width:30%;"><?=$result_login['tpd_remarks']?></td>
                <td style="width:18%;"></td>
                <td style="width:18%;"><?= number_format($result_login['tpd_paid_amount'],$_SESSION['be_decimal'])?></td>          
                </tr>
         
                <?php    }    ?>  
                <tr><td colspan="7" ></td></tr>                           
                <?php
                 } ?>
                 
                 <!----------/////////////Credit purchase - supplier from acc//////////-------------------------------->                                                              
        <?php 
        $tot_credit_pay=0;                               
           $sql_login  =  $database->mysqlQuery("select sv_date,sv_id,sv_paid_amount,sv_remarks,sv_vendor_id,sv_invoice_no,sv_invoice_amount,
                                                  sv_type_pay,sv_from
                                                  from tbl_supplier_voucher ts                              
                                                  where ts.sv_invoice_amount!=ts.sv_paid_amount and sv_remarks!=''
                                                  and ts.sv_vendor_id ='$vendors[$ii]' and sv_date='$dates[$i]' order by sv_id asc "); 
	         $num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){                                      
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ 
          $tot_credit_pay=$tot_credit_pay+$result_login['sv_paid_amount'];
          ?>
              <tr>
              <td style="width:10%;"><?=$result_login['sv_date']?></td>
              <td style="width:10%;">S <?=$result_login['sv_id']?></td>
              <td style="width:18%;">Supplier</td>
              <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_login['sv_vendor_id']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
              <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
              <?php }}  ?> 
              <td style="width:30%;"><?=$result_login['sv_remarks']?> </td>
              <td style="width:18%;"><?=$result_login['sv_paid_amount']?></td>
              <?php if($result_login['sv_type_pay']=='First'){?>
              <td style="width:18%;"><?= number_format($result_login['sv_invoice_amount'],$_SESSION['be_decimal'])?></td>
             <?php } else { ?>
              <td style="width:18%;"></td>
             <?php } ?>
             </tr>

             <tr>
              <td style="width:10%;"><?=$result_login['sv_date']?></td>
              <td style="width:10%;">S <?=$result_login['sv_id']?></td>
              <td style="width:18%;">Supplier</td>
              <?php
              $sql_login2  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_login['sv_from']."'  ");
              $num_login4   = $database->mysqlNumRows($sql_login2);
					    if($num_login4)
              {                           
					    while($result_login4  = $database->mysqlFetchArray($sql_login2)) 
					    { ?>                                       
              <td style="width:18%;"><?=$result_login4['tlm_ledger_name']?></td>
              <?php }} else{ ?> 
                <td style="width:18%;"></td>
                <?php }?>
              <td style="width:30%;"><?=$result_login['sv_remarks']?> </td>
              <td style="width:18%;"></td>
              <td style="width:18%;"><?=$result_login['sv_paid_amount']?></td>             
             </tr>
            <?php } ?>
                <tr><td colspan="7" ></td></tr>              
           <?php }

            }
          }            
}     
                 
   } 

  ?>
      </tbody>
</table>   

    
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