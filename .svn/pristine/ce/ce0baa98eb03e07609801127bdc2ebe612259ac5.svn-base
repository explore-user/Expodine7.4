<?php

  session_start();

  include("database.class.php"); 
  $database	= new Database();

  error_reporting(0);
 
  $id = $_GET['id'];
  $total=$_GET['bill'];
  
      
     $master=0;   $bill_in= explode(",",$_GET['id']);   
     
     
     $sql_desg11="select cd_masterid from tbl_credit_details where cd_billno='".$bill_in[0]."' limit 1  ";
	$sql_desg21  =  $database->mysqlQuery($sql_desg11); 
	$num_desg21  = $database->mysqlNumRows($sql_desg21);
	if($num_desg21)
	{
	while($result_desg21  = $database->mysqlFetchArray($sql_desg21)) 
	{
            $master=$result_desg21['cd_masterid'];
                 
        }
        }
  
        
  
  if($_GET['paid']>0 || $_GET['trans']>0 ){
        
        $billno		        	= explode(",",$_GET['id']);    
	$typenam			= $_GET['typenam'];
	$amountpaid                     = 0;
        $amount_bal                     = 0;
	$rate_new                       =explode(",",$_GET['rates']);
        
        if($_GET['mode']=="cash")
	{
		$amountpaid=$_GET['paid'];
                $amount_bal=$_GET['bal'];
                $card_bank=0;
		$transactionamount=0;
                
            
                
	}else if($_GET['mode']=="credit")
	{
		$transactionamount =$_GET['trans'];
		$card_bank =$_GET['bank'];
		$amountpaid=$_GET['paid'];
                $amount_bal=$_GET['bal'];
		
                
                
	}
        
        
    $date=date("Y-m-d H:i:s");
         
    
    for($i=0;$i<count($billno);$i++)
    { 
   
        
        if($_GET['paid_partial']==$_GET['tot_partial']){
            
          $sql=$database->mysqlQuery("UPDATE tbl_credit_details SET cd_settled='Y' , cd_dateofsettle='$date' "
         . " WHERE cd_billno='".$billno[$i]."'  ");
         
        }
        
        
        if(count($billno)>1){
            
            $paid=$rate_new[$i];
             $trans =$rate_new[$i];
             
              $tot_part_paid=0;
             $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno[$i]."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                    
                    $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                }
                
            $paid=$paid-$tot_part_paid;
            
              $trans =$trans-$tot_part_paid;
             
             
        }else{
            
             $paid=$_GET['paid'];
             $trans =$_GET['trans'];
        }
         
        if($_GET['mode']=="cash" && ($_GET['bal_partial']>0 || $_GET['paid_partial']>0) )
	{
            $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
            . " VALUES ('".$billno[$i]."','1','$paid','$date','".$_SESSION['expodine_id']."')");   
            
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
        
        
        if($_GET['mode']=="credit" && ($_GET['bal_partial']>0 || $_GET['paid_partial']>0) )
	{
            $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
            . " VALUES ('".$billno[$i]."','2','$trans','$date','".$_SESSION['expodine_id']."')");   
            
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
       
    }
    
    
   if($amountpaid>0 || is_nan($amountpaid)){
        
    }else{
        $amountpaid=0;
    }
    
    if($amount_bal>0 || is_nan($amount_bal)){
        
    }else{
        $amount_bal=0;
    } 
      
   $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_details_payment`(`cdp_master_id`, `cdp_dayclosedate`, `cdp_paid_cash`, `cdp_transaction_amount`, "
   . " `cdp_balance`,`cdp_login_id`,`cdp_bank`) VALUES"
   . " ('$master','".$_SESSION['date']."','$amountpaid','$transactionamount','$amount_bal','".$_SESSION['login_staff_id_expodine']."','$card_bank')");
	
   
    
   $sql=$database->mysqlQuery("UPDATE tbl_credit_master SET crd_totalamount=0 WHERE crd_totalamount<0 ");
       
   $sql=$database->mysqlQuery("delete from  tbl_credit_details  WHERE (cd_billno='' or cd_billno is null) ");
     
   $sql=$database->mysqlQuery("delete from tbl_credit_details_payment  WHERE (cdp_master_id='' or cdp_master_id is null or cdp_master_id='undefined') ");
    
    
    if($_GET['mode']=="cash")
	{
    header( "refresh:1;url=load_printcredit.php?id=".$_GET['id']."&bill=".$_GET['bill']."&credino=".$_GET['credino']."&paid_partial=".$_GET['paid'] );
     
    }else{
            
       header( "refresh:1;url=load_printcredit.php?id=".$_GET['id']."&bill=".$_GET['bill']."&credino=".$_GET['credino']."&paid_partial=".$_GET['trans'] );
           
   }
    
    
     
    }
    
    
?>

<link rel="stylesheet" href="css/bootstrap/3.3.1/css/bootstrap.min.css">

<style type="text/css" media="print">
    @page 
        {
            size: auto;   
            margin: 0mm;  
        }
    
</style>

         <table border="0" cellpadding="1" cellspacing="3" width="100%" style="float:left">
         <tbody>
                   
          <tr>
          <td id="back_button" style="padding-left: 20px"> 
          <input type="submit" value="Back" class="print_button_main" onclick="return close_page()" /> &nbsp;&nbsp;&nbsp;
          <input type="submit" id="printbutton" value="Print" class="print_button_main " onclick="return print_page()" />   </td>
          
         </tr>
          
        </tbody>
        </table>


<div style="margin-top: 20px;"></div>

 <?php

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
        <div class="table  table-font user_shadow" style="width: 100%;text-align: center;margin-bottom: 5px;">
               <div style="font-size:20px;color:#000;background-color:#FFF;">
               <img width="200px" src="img/report-logo/reportlogo.png" /></div>
               <div style="font-size:17px;color:#525252;background-color:#FFF;">
               <?=$address?></div>
        </div>


 <div style="padding-left: 20px;font-weight: bold;font-size:10px;">DATE: <?=date("Y-m-d H:i:s")?>  &nbsp; &nbsp;  ID: [<?=$master?>]</div>


 <div class="table  table-font user_shadow" style="width: 100%;text-align: center;height: 50px;float: left">
    <div style="font-size:12px;color:#000;background-color:#FFF;line-height: 70px" colspan="10">
        <strong><u>CREDIT SETTLEMENT RECEIPT</u></strong>
    </div>
 </div>


 <div class="section_content" id="div_list" style="margin-top: 5px;float: left;width: 100%">
                      
         <div class="print_content">  
         <div class="estimate_cnt_wrapper_print">  
         <div class="table_wrapper">
           
         <?php 
           
         date_default_timezone_set('Asia/Kolkata');
         $time = date('H:i:s');  

         $creditype=$_SESSION['creditypeid'];
	 $sqlquery='';
         
	 if($creditype=='1')
	 {
             
	 $sqlquery=("SELECT rm.rm_roomno as name,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from"
                 . " tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_roommaster as rm ON"
                 . " rm.rm_roomid=cm.crd_roomid  WHERE ct.ct_active='Y' AND cm.crd_totalamount>'0' AND ct.ct_creditid='1'");
	
         }else if($creditype=='2'){
             
	$sqlquery=("SELECT sm.ser_firstname as name,sm.ser_lastname  as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,"
                . " ct.ct_creditid as labellan,ct.crd_staffid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type"
                . "  LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=cm.crd_staffid WHERE ct.ct_active='Y' AND cm.crd_totalamount>'0' AND "
                . " ct.ct_creditid='2' AND sm.ser_employeestatus='Active'");
	
        
         }else if($creditype=='3'){
             
	 $sqlquery=("SELECT csm.ct_corporatename as name, cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan ,"
                . " cm.crd_corporateid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN "
                . " tbl_corporatemaster as csm ON csm.ct_corporatecode=cm.crd_corporateid  WHERE ct.ct_active='Y' AND cm.crd_totalamount>'0' AND "
                . " ct.ct_creditid='3'");
         
	}else if($creditype=='4'){
            
	$sqlquery=("SELECT lr.ly_firstname as name,lr.ly_lastname as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,"
                . " ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN "
                . " tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid  WHERE ct.ct_active='Y' AND cm.crd_totalamount>'0' AND ct.ct_creditid='4'");
	
        
        }else if($creditype=='all'){
            
		$sqlquery=("SELECT cm.crd_staffid,cm.crd_roomid,cm.crd_corporateid,cm.crd_guestid,cm.crd_totalamount as amount,ct.ct_labels as label,"
                        . " cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON "
                        . " ct.ct_creditid=cm.crd_type LEFT JOIN tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid WHERE ct.ct_active='Y' AND "
                        . " cm.crd_totalamount>'0' ");
	}
       
	        $sql_ds  =  $database->mysqlQuery($sqlquery); 
		$num_ds = $database->mysqlNumRows($sql_ds);
		if($num_ds){ $i=1;
		 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
				{
					
					if($creditype=='all')
					{  
						  if(!is_null($result_ds['crd_staffid']))
						  {
							  $staff=$database->show_masterstaff_details($result_ds['crd_staffid']);
							  $name=$staff['ser_firstname'];
						  }else if(!is_null($result_ds['crd_roomid']))
						  {
							  $staff=$database->show_masterroom_details($result_ds['crd_roomid']);
							  $name=$staff['rm_roomno'];
						  }else if(!is_null($result_ds['crd_corporateid']))
						  {
							  $staff=$database->show_mastercorporate_details($result_ds['crd_corporateid']);
							  $name=$staff['ct_corporatename'];
						  }else if(!is_null($result_ds['crd_guestid']))
						  {
							  $staff=$database->show_masterloyality_details($result_ds['crd_guestid']);
							  $name=$staff['ly_firstname'];
						  }
                                                  
					}else
					{
					
                                            
						if(trim($result_ds['label'])=="Staff name")
						  {
							  $staff=$database->show_masterstaff_details($result_ds['crd_staffid']);
							  $name=$staff['ser_firstname'];
						  }else if($result_ds['label']=="Room No")
						  {
							  $staff=$database->show_masterroom_details($result_ds['crd_roomid']);
							  $name=$staff['rm_roomno'];
						  }else if($result_ds['label']=="Company Name")
						  {
							  $staff=$database->show_mastercorporate_details($result_ds['crd_corporateid']);
							  $name=$staff['ct_corporatename'];
						  }else if($result_ds['label']=="Guest Name")
						  {
							  $staff=$database->show_masterloyality_details($result_ds['crd_guestid']);
							  $name=$result_ds['name'];
						  }
						
					}
   
   $result='';                                    
   $number = $total;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
       
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';                 
      
  }}
  
?> 

            <div style="color: #000;font-family: arial;line-height: 40px;padding-left: 20px">
            <p> <span style="width:40%;float: left;">Received from </span>
            <span style="text-decoration: underline;width:53%;float: left;height: 33px;">
                
          <?php
         
          $id1=("('".$id."')");
          
          $id2=  str_replace(",", "','", $id1);
          
              
          
                  $sql_branch11 =  $database->mysqlQuery("Select cd_masterid,crd_guestid,ly_firstname as name1,ct_corporatename as name2, "
                  . " ser_firstname as name3 from tbl_credit_details cd left join tbl_credit_master tcm on cd.cd_masterid=tcm.crd_id  "
                  . " left join tbl_loyalty_reg tl on tl.ly_id=tcm.crd_guestid left join tbl_corporatemaster tct on "
                  . " tct.ct_corporatecode=tcm.crd_corporateid left join tbl_staffmaster ts on ts.ser_staffid=tcm.crd_staffid "
                  . " where cd_billno in $id2 group by cd_masterid ");
                                               
		  $num_branch11  = $database->mysqlNumRows($sql_branch11);
		  if($num_branch11)
		  {
		    while($result_branch11  = $database->mysqlFetchArray($sql_branch11)) 
			{
					$cdid1=	$result_branch11['name1']; 
                                        $cdid2=	$result_branch11['name2']; 
                                        $cdid3=	$result_branch11['name3']; 
			?>
                
                        <strong> <?= $cdid1. $cdid2 .$cdid3 ?></strong></span></p><br>
                        
                  <?php } } ?>
                
               
              
                <p> <span style="width:40%;float: left;">Bill Amount <?=$_SESSION['base_currency']?>. </span>
                    
                    <span style="text-decoration: underline;width:20%;float: left;height: 33px;"><strong><?=$total?></strong> </span> <br>
                  
                     <span style="width:40%;float: left;">Paid <?=$_SESSION['base_currency']?>. </span>
                    
                     <span style="text-decoration: underline;width:50%;float: left;height: 33px;"><strong><?=$_REQUEST['paid_partial']?></strong>  </span>
                    
                    <span style="width:15%;float: left;display: none"> &nbsp;&nbsp; Amount in words</span> 
                    
                    <span style="text-decoration: underline;width:20%;float: left;height: 33px;display: none"><strong><?=$result .$_SESSION['base_currency']. $points . " only" ?></strong></span></p><br>
                
                <p > <span style="width:45%;font-size: 10px"> by Cash/Card towards settlement of Bill No : </span> <span style="border-bottom:1px solid;font-size: 10px"><strong><?=$id?></strong></span></p>    
              
           
            </div>
              
               
                 <div style="line-height: 70px;padding-left: 20px">
                    <p><span style="width:45%;float: left; line-height: 33px;">Remarks:</span>
                    <span style="border-bottom:1px solid;width:30%;float: left;height: 33px;"><strong></strong></span>
                    </p>
                    
                    <div style="width: 100%;height: auto;float: left">
                        <span style="width:31.3%;float: left;">Check By:</span>  
                        <span style="width:34.3%;float: left;text-align: center">Approve By:</span>  
                        <span style="width:34.3%;float: left;text-align: center">Receive By:</span> 
                    </div>
                    
                </div>     
                
  </div>
  </div>    
  </div>
  </div>  



<script src="js/jquery-1.10.2.min.js"></script>
 
<script>
    
    $(document).ready(function(){ 
        
        
          onafterprint = function () {
              document.getElementById("back_button").style.display = "block";	
          }
          
        
      
      
      
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
    
    
    });  
    
    
    
function print_page()
{ 
  document.getElementById("back_button").style.display = "none";	
 	
  window.print();
  
}


function close_page(){
   window.top.close();
   
}

</script>
