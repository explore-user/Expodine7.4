<?php
include('includes/session.php');		// Check session
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
}
error_reporting(0);
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
//session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
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

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
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
<body style="background:none;overflow:scroll !important">
<!-- main header -->
<div >

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">
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
 if($_REQUEST['type']=="voucher_expense") {
     $reporthead="";
     $st="";
     
    
     ?>  
            
          <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Voucher Expense</strong></th>
      </tr>

    </thead>
    </table> 
       <?php
       
        $from="";
        $to='';
        $string='';
        $voucher=$_REQUEST['voucher'];
         $vouch_login=$_REQUEST['voucher_login'];
        if($voucher!="")
        {
        
            $vouchername="vh_vouchername='".$voucher."' AND";
        }
        else
        {
          $vouchername="";  
        }
        $voucher1=$_REQUEST['voucher1'];
         if($voucher1!="")
        {
        
            $vouchertype="vp_type='".$voucher1."' AND ";
        } 
        else
        {
          $vouchertype="";  
        }
		
        if($vouch_login!=""){
           $vp_approve= " vp_approvedby='".$vouch_login."' AND  ";
        }else{
            $vp_approve='';
            
        }
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		
	else
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                
		
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                
		
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		
                
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" vp_dayclose_date = CURDATE() - INTERVAL 1 day";
               
		
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		
               
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		
                
		$st= " Last 1 year "; 
		
	}
$reporthead=$st;
	}
	else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
			
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
	
        
        ?>
                              
                <table class="table table-bordered table-font user_shadow newconsl_table" >
                    <thead>
                      <tr>
                            <th colspan="19">Voucher Expense Report - <?=$reporthead?></th>
                      </tr>
                      <tr>
                          <th >Sl.no</th>
                          <th >Voucher Id</th>
                          <th >Date</th>
                          <th >Time</th>
                          <th >Voucher Head</th>
                          <th >Type</th>
                          <th >Status</th>
                          <th >Mode of Payment</th>
                         
                          <th >Paid To</th>
                          <th >Received By</th>
                         
                          <th >Approved By</th>
                          <th >Approved Date</th>
                          <th >Approved Time</th>
                          <th >Add Remark</th>
                         <th >Amount</th>
                          
                      </tr>
                    </thead>

        <?php
        $i=0;
        $amount1='';
    		   $sql_login  =  $database->mysqlQuery("select vp_id,vp_date,vh_vouchername,vp_type,vp_status,vp_paymentmode,vp_amount,vp_paidto,vp_receivedby,vp_chequebank,
           vp_chequebranch,vp_chequeleafno,ser_firstname,vp_approveddate,vp_add_remark,be_branchname from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid 
           left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and $vouchername $vouchertype $vp_approve  $string");
                   $num_login   = $database->mysqlNumRows($sql_login);
                 if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            $i++;
                            $voucherid=$result_login['vp_id'];
                            $datetime=$result_login['vp_date'];
                            $vouchername=$result_login['vh_vouchername'];
                            $type=$result_login['vp_type'];
                            $status=$result_login['vp_status'];
                            $modeofpayment=$result_login['vp_paymentmode'];
                            $amount=number_format($result_login['vp_amount'],$_SESSION['be_decimal']);
                            $paidto=$result_login['vp_paidto'];
                            $receivedby=$result_login['vp_receivedby'];
                            $chequebankname=$result_login['vp_chequebank'];
                            $chequebranchname=$result_login['vp_chequebranch'];
                            $chequeleafnumber=$result_login['vp_chequeleafno'];
                            $approvedby=$result_login['ser_firstname'];
                            $approveddatetime=$result_login['vp_approveddate'];
                            $approvedremark=$result_login['vp_add_remark'];
                            $branchname=$result_login['be_branchname'];

                            $date=date("d-m-Y",strtotime($datetime));
                            $approveddate=date("d-m-Y",strtotime($approveddatetime));
                            $time=date("H:i:s",strtotime($datetime));
                            $approvedtime=date("H:i:s",strtotime($approveddatetime));
$amount1=$amount1+number_format($result_login['vp_amount'],$_SESSION['be_decimal']);
        ?>
                    <tbody>
                        <tr>
                        <td><?=$i?></td>
                        <td><?=$voucherid?></td>
                        <td><?=$date?></td>
                        <td><?=$time?></td>
                        <td><?=$vouchername?></td>
                        <td><?=$type?></td>
                        <td><?=$status?></td>
                        <td><?=$modeofpayment?></td>
                      
                        <td><?=$paidto?></td>
                        <td><?=$receivedby?></td>
                       
                        
                      
                        <td><?=$approvedby?></td>
                        <td><?=$approveddate?></td>
                         <td><?=$approvedtime?></td>
                        <td><?=$approvedremark?></td>
                        <td><?=number_format(str_replace(',','',$amount),$_SESSION['be_decimal'])?></td>
                     </tr>                   
                    
        <?php
        } } 
        ?>
                        <tr>
                        <td>Total</td>
                        <td></td>
                       
                        <td></td>
                        <td></td>
                        <td></td>
                       
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                         <td></td>
                       
                        <td></td>
                         <td><?=number_format(str_replace(',','',$amount1),$_SESSION['be_decimal'])?></td>
                     </tr>            
                     </tbody>
                </table>
                           
  <?php
 }
 
 else if(($_REQUEST['type']=="advance_payment_cr"))
        {
     ?>
     
     
     
                                 <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="23">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="23"><strong> Advance Payment</strong></th>
      </tr>

      
    </thead>
    </table> 
	<?php 
        $string="";
	$reporthead='';
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tp_dayclose between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  tp_dayclose between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  tp_dayclose between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
               $reporthead= 'Last5days'; 
	}
        elseif($bydatz=="Last10days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
               $reporthead= 'Last10days'; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" tp_dayclose = CURDATE() - INTERVAL 1 day";
                                 $reporthead= 'Yesterday'; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead= 'Last15days'; 
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               $reporthead= 'Last20days'; 
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                 $reporthead= 'Last25days';  
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $reporthead= 'Last30days';      
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" tp_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                              $reporthead= 'Last1month';       
			  }
	else if($bydatz=="Today")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $reporthead= 'Today';   
	}
else if($bydatz=="Last90days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead= 'Last90days';   
	}
else if($bydatz=="Last180days")
	{
		$string.=" tp_dayclose  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead= 'Last180days';   
	}
else if($bydatz=="Last365days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
           $reporthead= 'Last365days';   
	}

	}
	else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tp_dayclose  between '".$from."' and '".$to."' ";
                        $reporthead=date("Y-m-d");
	}
		
	
	}
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
            <thead style="    table-layout: inherit;">
                                 <tr>
                                  <th colspan="8">ADVANCE PAYMENT - <?=$reporthead;?></th>
                                  </tr>
                                  
				<tr>
                                    <th style="width:10%" >Sl</th>
                                        <th style="width:10%" > Ref No</th>
                                        <th style="width:20%" > Customer</th>
                                         <th style="width:15%" > Number</th>
                                         <th style="width:10%" > Mode</th>
                                           <th style="width:15%" > Delivery Date</th>
                                      
                                       <th style="width:10%" >Date</th>
                                          <th style="width:10%" >Amount Paid</th>
				</tr>
				</thead>
				<tbody>
                                    
									
            <?php
            $tot=0;
          $sql_login  =  $database->mysqlQuery("select tp_customer,tp_id,tp_number,tp_mode,tp_delivery_date,tdd_dayclose_date,tdd_advance_amount from tbl_advance_payment  left join tbl_advance_day_detail on tdd_ref_id=tp_id  where $string order by tp_id asc "); 

  	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  if($num_login)
	  { $i=0;
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$i++;
                          $tot=   $tot+ $result_login['tdd_advance_amount'];
              ?>
          <tr>
           <td style="width:10%"> <?=$i?> </td>
           <td style="width:10%"> <?=$result_login['tp_id']?> </td>
           <td style="width:20%"> <?=$result_login['tp_customer']?> </td>
           <td style="width:15%"> <?=$result_login['tp_number']?> </td>
            <td style="width:10%"> <?=$result_login['tp_mode']?> </td>
            <td style="width:15%"> <?=$result_login['tp_delivery_date']?> </td>
            <td style="width:10%"> <?=$result_login['tdd_dayclose_date']?> </td>
            <td style="width:10%"><?=number_format($result_login['tdd_advance_amount'],$_SESSION['be_decimal'])?></td>
	  </tr>
                           
                           
<?php
	  }
          }
?>
                                    
              <tr style="font-weight: bold ">
	
       
           <td style="width:10%"> Total </td>
           <td style="width:10%"> </td>
           <td style="width:20%"> </td>
            <td style="width:15%">  </td>
             <td style="width:10%">  </td>
            <td style="width:15%">  </td>
             <td style="width:10%">  </td>
             
            <td style="width:10%"> <?=number_format($tot,$_SESSION['be_decimal'])?> </td>
           
	  </tr>                       
                                    
          </tbody>
                            </table>
          <?php
}
 else if($_REQUEST['type']=="loyalty_staff_cr")
{
	
	?>
	<table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="23">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="23"><strong> Customer Loyalty Report</strong></th>
      </tr>

      
    </thead>
    </table> 
	<?php
	$string="";
	$reporthead="";
	$st="";
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " lr.ly_loy_dayclose between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "lr.ly_loy_dayclose between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " lr.ly_loy_dayclose between '".$from."' and '".$to."' ";
		}
		
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		
		
	}
	
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" lr.ly_loy_dayclose CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" lr.ly_loy_dayclose = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" lr.ly_loy_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " lr.ly_loy_dayclose between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
		
	
	

	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  
                                   
                                  
                             
                                      <tr>
                                  	<th colspan="7">Report - <?=$reporthead?></th>
                                  
                                  </tr>
                                
                                  
                                  
									<tr>
                                  
                                     <th class="sortable">Date</th>
                                     <th class="sortable">Staff Login</th>
                                        
                                       <th class="sortable"> Orders In Login - DI</th>
                                       <th class="sortable"> Orders In Login - TA-HD-CS</th>   
                                      
                                       <th class="sortable">Total Orders In Login</th>  
                                         <th class="sortable">Total Customers In Login</th>
                                          <th class="sortable">Performance Percentage</th>            
                                   
					</tr>
					</thead>
					<tbody>
									
                                          <?php

  


  
    $sql_login  =  $database->mysqlQuery("select  count(lr.ly_id) as entrycount,lr.ly_loy_login, lr.ly_loy_dayclose,lr.ly_loy_dayclose,ts.ser_firstname  from tbl_loyalty_reg lr left join tbl_staffmaster ts on lr.ly_loy_login=ts.ser_staffid where $string group by lr.ly_loy_login"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
	     ?>
    			<tr >
                              
                           
                               <td><?=$result_login['ly_loy_dayclose']?></td>
                               <td><?=$result_login['ser_firstname']?></td>
                               
                               
                              
           <?php  
           $sql_login1  =  $database->mysqlQuery("select count(to1.ter_orderno) as ordercount from tbl_tableorder to1 left join tbl_logindetails tl on tl.ls_username=to1.ter_entryuser  where to1.ter_status='Closed'  and tl.ls_staffid='".$result_login['ly_loy_login']."' and to1.ter_dayclosedate='".$result_login['ly_loy_dayclose']."'  group by to1.ter_entryuser "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	 
	  if($num_login1){$order_ct=0;
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
                        
                      $order_ct=$result_login1['ordercount'];
                     
                      ?>
                           <td><?=$order_ct?></td>        
                               <?php
                               }
                               }else{$order_ct=0;
                                   ?>
                           <td>0</td>
                           <?php
                               }
                               ?>
                               
                               
                        
                           <?php  
           $sql_login11  =  $database->mysqlQuery("select count(to1.tab_billno) as ordercount from tbl_takeaway_billmaster to1 left join tbl_logindetails tl on tl.ls_username=to1.tab_loginid  where to1.tab_status='Closed'  and tl.ls_staffid='".$result_login['ly_loy_login']."' and to1.tab_dayclosedate='".$result_login['ly_loy_dayclose']."'  group by to1.tab_loginid "); 
	  $num_login11   = $database->mysqlNumRows($sql_login11);
	 
	  if($num_login11){$order_ct_ta=0;
		  while($result_login11  = $database->mysqlFetchArray($sql_login11)) 
			{   
                     
                     
                         $order_ct_ta=$result_login11['ordercount'];
                     
                      
                      ?>
                           <td><?=$order_ct_ta?></td>        
                               <?php
                               }
                               }else{$order_ct_ta=0;
                                   ?>
                           <td>0</td>
                           <?php
                               }
                             
                            //  echo  $order_ct.' - '.$order_ct_ta.' / ';
                              
                           $ctt= $order_ct+$order_ct_ta;
                               
                               ?>
                             <td><?=$ctt?></td> 
                             
                            <td><?=$result_login['entrycount']?></td>  
                            
                            
                            <?php 
                            $percent=0;
                            $sts='';
                            
                           
                               $percent=number_format(($result_login['entrycount']/$ctt)*100,2);
                            
                            
                            if($percent=='100' || $percent>='90'){
                                
                             $sts='[ Excellent ]';   
                                
                            }else if($percent<='10'){
                                 $sts='[ Weak ]';   
                            }
                            else if($percent>'10'  && $percent<'30'){
                                 $sts='[ Fair ]';   
                            }
                             else if($percent>'30'  && $percent<'60'){
                                 $sts='[ Average ]';   
                            }
                            else if($percent>'60'  && $percent<'90'){
                                 $sts='[ Good ]';   
                            }
                            ?>
                            
                               
                           <td><?=$percent?>%  <?=$sts?></td>  
                                  
                              </tr> 
                              <?php } } ?>
                              
                              
 
  <tr class="main">
    <td ></td>
    <td ></td>
    <td ></td>
   <td ></td>
    <td ></td>
     <td ></td>
      <td ></td>
 
    
  </tr>
                              
                             
    </tbody>
      </table>
                            
    <?php

	
	
	
	
	
}
 
 
 
 else if(($_REQUEST['type']=="consolidated_shift_report"))
{
     
        $string="";
        $cashcounter='';
        $loginstaff='';
        if($_REQUEST['shiftlogin']!="all"){       
        $string=" sd.sd_open_staff='".$_REQUEST['shiftlogin']."' AND ";
        $loginstaff.=" and sd.sd_open_staff='".$_REQUEST['shiftlogin']."' ";      
        }       
        $modeofview=$_REQUEST['modeofview'];
        if($_REQUEST['cashcounter']!=''){
        $cashcounter.=" and sd.sd_open_machineid= '".$_REQUEST['cashcounter']."' ";
        }
	$reporthead="";
	$st="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " sd.sd_day between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else 
	{
	$reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
     $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";       
        $st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";               
        $st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";               
        $st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";             
        $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";        
        $st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";        
		$st="Today";
	}
    else if($bydatz=="Yesterday")
	{
		 $string.=" sd.sd_day = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";                                 
		$st="Yesterday";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  sd.sd_day between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
        $st="Last 1 month";
	}
    else if($bydatz=="Last90days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";               
		$st="Last 3 months";
	}
    else if($bydatz=="Last180days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";               
			$st="Last 6 months";
	}
    else if($bydatz=="Last365days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";               
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{		
		    $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";                       
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }		
            }
	     ?>
     
     
     <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong> Shift Report : <?=$reporthead?></strong></th>
      </tr>

      
    </thead>
    </table> 
	<?php 
                            $sql_shiftdates  =  $database->mysqlQuery("select  sd.sd_day, sd.sd_open_staff,sd.sd_open_machineid,em.cm_ip_remarks,sm.ser_firstname,em.cm_ip_address FROM tbl_shift_details sd 
                                                                        LEFT JOIN  tbl_expodine_machines em on em.cm_ip_address=sd.sd_open_machineid
                                                                        left join tbl_staffmaster sm on sm.ser_staffid=sd.sd_open_staff where  $string $cashcounter  order by sd.sd_day,sd.sd_open_machineid");
                            $num_shiftdates   = $database->mysqlNumRows($sql_shiftdates);
                            if($num_shiftdates){ $previous_date='';$previous_ip='';
                            ?>  
                                <table class="table table-bordered table-font user_shadow">
                                <thead>
                                <tr>
                                    <th colspan="20"> Report - <?=$reporthead?></th>
                                </tr>
                                
                                 <tr>
                                    <th style="vertical-align: middle" class="sortable">Login </th>
                                    <th style="vertical-align: middle" class="sortable">Open Time</th>
                                    <th style="vertical-align: middle" class="sortable">Open Bal</th>
                                    <th style="vertical-align: middle" class="sortable">Open Petty</th>
                                    <th style="vertical-align: middle" class="sortable">Close Time</th>
                                    <th style="vertical-align: middle" class="sortable">Close Bal</th>
                                    <th style="vertical-align: middle" class="sortable">Close Petty</th>
                                    <th style="vertical-align: middle" class="sortable">DI</th>
                                    <th style="vertical-align: middle" class="sortable">TA</th>
                                    <th style="vertical-align: middle" class="sortable">CS</th>
                                    <th style="vertical-align: middle" class="sortable">HD</th>
                                    <th>Cash</th>
                                    <th>Card</th>
                                    <th>Credit</th>
                                    <th>Compl</th>
                                    <th style="display:none">Upi</th>
                                    <th style="display:none">Cheque</th>
                                    <th style="display:none">Coupon</th>
                                    <th>Discount</th>
                                    <th>Roundoff</th>
                                    <th>Expense</th>
                                    <th>Income</th>
                                    <th>Sale</th>  
                                </tr>
                                 </thead>
                                 <tbody> 
                            <?php
                            while($result_shiftdates  = $database->mysqlFetchArray($sql_shiftdates)) 
                                {
                                    if($previous_date!=$result_shiftdates['sd_day']){
                                       $previous_ip='';
                                        $previous_date=$result_shiftdates['sd_day'];
                        ?>     
                                 
                                <tr>
                                    <td colspan="2"><strong style="color:darkred">Date</strong></td>
                                    <td colspan="18" style="text-align: left"><strong><?=$previous_date?></strong></td>
                                </tr>
                                <?php }
                                if($previous_ip!=$result_shiftdates['sd_open_machineid']){                                     
                                        $previous_ip=$result_shiftdates['sd_open_machineid'];
                                ?>
                                <tr>
                                    <td colspan="2"><strong>Counter</strong></td>
                                    <td colspan="18" style="text-align: left"><strong><?=$previous_ip?> : <?=$result_shiftdates['cm_ip_remarks']?></strong></td>
                                </tr>
                                   
                           
                          
				<tr>
                                    
                                    <?php 
                                    if($modeofview!='detailed') {
                                    // query for shift open details starts ////
                                    $open_time=0;$open_balance=0;$open_petty=0;
                                    $sql_shift_open  =  $database->mysqlQuery("select sd.sd_open_balance,sd.sd_open_petty,sd.sd_open FROM tbl_shift_details sd where sd.sd_day ='".$previous_date."' and sd.sd_open_machineid ='".$previous_ip."'  order by sd.sd_open ASC limit 1");
                                   
                                    $num_shift_open  = $database->mysqlNumRows($sql_shift_open);
                                    if($num_shift_open){ 
                                        while($result_shift_open  = $database->mysqlFetchArray($sql_shift_open)) 
                                            {
                                                $open_time      =$result_shift_open['sd_open'];
                                                $open_balance   =$result_shift_open['sd_open_balance'] ;
                                                $open_petty     =$result_shift_open['sd_open_petty'] ;       
                                            }
                                    }
                                    // query for shift open details ends ////
                                    // query for shift close details starts ////
                                    $close_time=0;$close_balance=0;$close_petty=0;
                                    $sql_shift_close  =  $database->mysqlQuery("select sd.sd_close_balance,sd.sd_close_petty,sd.sd_close FROM tbl_shift_details sd where sd.sd_day ='".$previous_date."' and sd.sd_open_machineid ='".$previous_ip."'  order by sd.sd_close DESC limit 1");
                                    $num_shift_close  = $database->mysqlNumRows($sql_shift_close);
                                    if($num_shift_close){ 
                                        while($result_shift_close  = $database->mysqlFetchArray($sql_shift_close)) 
                                            {
                                                $close_time      =$result_shift_close['sd_close'];
                                                $close_balance   =$result_shift_close['sd_close_balance'] ;
                                                $close_petty     =$result_shift_close['sd_close_petty'] ;       
                                            }
                                    }
                                    // query for shift open details ends ////
                                    // query for dine in finaltotal sum starts ////
                                    $final_di=0;
                                    $sql_final_di  =  $database->mysqlQuery("select sum(bm.bm_finaltotal) as final  FROM tbl_tablebillmaster bm left join tbl_logindetails ld on ld.ls_username= bm.bm_settlement_login 
                                                                            left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and bm.bm_dayclosedate='".$previous_date."' and bm.bm_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  ");
                                    $num_final_di  = $database->mysqlNumRows($sql_final_di);
                                    if($num_final_di){ 
                                        while($result_final_di  = $database->mysqlFetchArray($sql_final_di)) 
                                            {
                                                $final_di      =$result_final_di['final'];
                                            }
                                    }
                                    // query for dine in finaltotal sum ends ////
                                    // query for takeaway in finaltotal sum starts ////
                                    $final_ta=0;$final_cs=0;$final_hd=0;
                                    $sql_final_ta  =  $database->mysqlQuery("select sum(tbm.tab_netamt)as final, tbm.tab_mode   FROM tbl_takeaway_billmaster tbm left join tbl_logindetails ld on ld.ls_username= tbm.tab_settlement_login 
                                                                        left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and tbm.tab_dayclosedate='".$previous_date."' and tbm.tab_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  group by tbm.tab_mode ");
                                    $num_final_ta  = $database->mysqlNumRows($sql_final_ta);
                                    if($num_final_ta){ 
                                        while($result_final_ta  = $database->mysqlFetchArray($sql_final_ta)) 
                                            {   
                                                if($result_final_ta['tab_mode']=='TA'){
                                                    $final_ta      =$result_final_ta['final'];
                                                }
                                                else if($result_final_ta['tab_mode']=='cs'){
                                                    $final_cs      =$result_final_ta['final'];
                                                }
                                                else if($result_final_ta['tab_mode']=='HD'){
                                                    $final_hd      =$result_final_ta['final'];
                                                }
                                            }
                                    }
                                    // query for takeaway in finaltotal sum ends ////
                                    /// di income, expense query starts ////
                                    $cash_di=0;$card_payments_di=0;$card_payments_di=0;$credit_payments_di=0;$coupon_payments_di=0;$complimentary_payments_di=0;$cheque_payments_di=0;$upi_payments_di=0;$round_of=0;$discount=0;
                                    $sql_cash_di  =  $database->mysqlQuery("select sum(bm.bm_finaltotal) as total,sum(bm.bm_amountpaid-bm.bm_amountbalace) cash , sum(bm.bm_transactionamount) as card, sum(bm.bm_chequebankamount) as cheque,sum(bm.bm_upi_amount) as upi, sum(bm.bm_couponamt) as coupon, sum(bm.bm_discountvalue) as discount, sum(bm.bm_roundoff_value) as roundoff, bm.bm_paymode  FROM tbl_tablebillmaster bm 
                                                                            left join tbl_logindetails ld on ld.ls_username= bm.bm_settlement_login 
                                                                            left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and  bm.bm_dayclosedate='".$previous_date."' and bm.bm_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  group by bm.bm_paymode");
                                    $num_cash_di  = $database->mysqlNumRows($sql_cash_di);
                                    if($num_cash_di){ 
                                        while($result_cash_di  = $database->mysqlFetchArray($sql_cash_di)) 
                                            {   
                                                if($result_cash_di['bm_paymode']=='1'){
                                                    $cash_di      =$cash_di+$result_cash_di['cash'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='2'){
                                                    $card_payments_di=$card_payments_di+$result_cash_di['card'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='3'){
                                                    $coupon_payments_di=$coupon_payments_di+$result_cash_di['coupon'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='5'){
                                                    $cheque_payments_di=$cheque_payments_di+$result_cash_di['cheque'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='6'){
                                                    $credit_payments_di=$credit_payments_di+($result_cash_di['total']-$result_cash_di['cash']);
                                                }
                                                else if($result_cash_di['bm_paymode']=='7'){
                                                    $complimentary_payments_di=$complimentary_payments_di+$result_cash_di['total'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='8'){
                                                    $upi_payments_di=$upi_payments_di+$result_cash_di['upi'];
                                                }
                                                $round_of=$round_of+$result_cash_di['roundoff'];
                                                $discount=$discount+$result_cash_di['discount'];
                                            }
                                    }
                                     /// di income, expense query ends ////
                                    /// ta income, expense query starts ////                                    
                                    $sql_cash_ta  =  $database->mysqlQuery("select sum(tbm.tab_netamt) as total, tbm.tab_mode ,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash , sum(tbm.tab_transactionamount) as card ,sum(tbm.tab_chequebankamount) as cheque,sum(tbm.tab_upi_amount) as upi, sum(tbm.tab_couponamt) as coupon,sum(tbm.tab_discountvalue) as discount, sum(tbm.tab_roundoff_value) as roundoff,tbm.tab_paymode FROM tbl_takeaway_billmaster tbm 
                                                                        left join tbl_logindetails ld on ld.ls_username= tbm.tab_settlement_login 
                                                                        left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and tbm.tab_dayclosedate='".$previous_date."' and tbm.tab_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  group  by tbm.tab_paymode");
                                    $num_cash_ta  = $database->mysqlNumRows($sql_cash_ta);
                                    if($num_cash_ta){ 
                                        while($result_cash_ta  = $database->mysqlFetchArray($sql_cash_ta)) 
                                            {   
                                                if($result_cash_ta['tab_paymode']=='1'){
                                                    $cash_di      =$cash_di+$result_cash_ta['cash'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='2'){
                                                    $card_payments_di=$card_payments_di+$result_cash_ta['card'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='3'){
                                                    $coupon_payments_di=$coupon_payments_di+$result_cash_ta['coupon'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='5'){
                                                    $cheque_payments_di=$cheque_payments_di+$result_cash_ta['cheque'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='6'){
                                                    $credit_payments_di=$credit_payments_di+($result_cash_ta['total']-$result_cash_ta['cash']);
                                                }
                                                else if($result_cash_ta['tab_paymode']=='7'){
                                                    $complimentary_payments_di=$complimentary_payments_di+$result_cash_ta['total'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='8'){
                                                    $upi_payments_di=$upi_payments_di+$result_cash_ta['upi'];
                                                }
                                                $round_of=$round_of+$result_cash_ta['roundoff'];
                                                $discount=$discount+$result_cash_ta['discount']; 
                                            }}
                                     /// ta income, expense query ends ////
                                    // query for  finaltotal sum starts ////
                                    $petty_income=0;$petty_expense=0;
                                    $sql_petty  =  $database->mysqlQuery("select sum(vp.vp_amount) as petty, vp.vp_type   FROM tbl_voucherpayment vp where DATE(vp.vp_approveddate)='".$previous_date."' GROUP BY vp.vp_type");
                                    $num_petty  = $database->mysqlNumRows($sql_petty);
                                    if($num_petty){ 
                                        while($result_petty  = $database->mysqlFetchArray($sql_petty)) 
                                            {    if($result_petty['vp_type']=='Income'){
                                                $petty_income      =$result_petty['petty'];
                                            }
                                            else if($result_petty['vp_type']=='Expense'){
                                                $petty_expense      =$result_petty['petty'];
                                            }
                                        }
                                    }
                                    
                                    if($open_time!=''){
                                    // query for  petty sum ends ////
                                    ?>
                                    <td>#</td>
                                    <td style="font-size: 10px"><?= date('h:i:s a', strtotime($open_time))?></td>
                                    <td><?= number_format($open_balance,$_SESSION['be_decimal'])?></td>
                                    <td><?= number_format($open_petty,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= date('h:i:s a', strtotime($close_time))?></td>
                                    <td style="font-size: 10px"><?= number_format($close_balance,$_SESSION['be_decimal'])?></td>
                                    <td><?= number_format($close_petty,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($final_di,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($final_ta,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($final_cs,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($final_hd,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($cash_di,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($card_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($credit_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($complimentary_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td style="display:none"><?= number_format($upi_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td style="display:none"><?= number_format($cheque_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td style="display:none"><?= number_format($coupon_payments_di,$_SESSION['be_decimal'])?></td>
                                    <td><?= number_format($discount,$_SESSION['be_decimal'])?></td>
                                    <td><?= number_format($round_of,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($petty_income,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format($petty_expense,$_SESSION['be_decimal'])?></td>
                                    <td style="font-size: 10px"><?= number_format(($final_di+$final_ta+$final_cs+$final_hd),$_SESSION['be_decimal'])?></td>
                                </tr>
                                
                                <?php
                                    } 
                                    
                                    } if($modeofview=='detailed') { ?>
                                
                                 
                                
                                <tr style="display:none">
                                    <th colspan='20'><strong>Shift Details</strong></th>
                                </tr>
                                <?php 
                                 $sql_shift_user  =  $database->mysqlQuery("select distinct(sd_open_staff), ld.ls_username FROM tbl_shift_details sd LEFT JOIN tbl_logindetails  ld on ld.ls_staffid= sd.sd_open_staff where sd.sd_day='".$previous_date."' and sd.sd_open_machineid='".$previous_ip."' $loginstaff order by sd_open ASC");
                                  $num_shift_user  = $database->mysqlNumRows($sql_shift_user);
                                    if($num_shift_user){ $i=0;
                                    ?>
                                    
                                    <?php
                                        while($result_shift_user  = $database->mysqlFetchArray($sql_shift_user)) 
                                            {
                                    $sql_shift_view  =  $database->mysqlQuery(" CREATE VIEW shiftcounter AS

                                                                        SELECT ts.sd_open_machineid,ts.sd_day,ts.sd_open,ts.sd_open_balance,ts.sd_open_petty,ts.sd_close,ts.sd_close_balance,ts.sd_close_petty,
                                                                        st.ser_firstname,em.cm_ip_remarks as countername,bm_finaltotal as final,'DI' AS mode,vp.vp_amount as voucheramount,vp.vp_type as vouchertype,
                                                                        (bm_amountpaid-bm_amountbalace) as cash, bm_transactionamount as card,bm.bm_chequebankamount as cheque, bm.bm_upi_amount as upi, bm.bm_couponamt as coupon,bm.bm_discountvalue as discount, bm.bm_roundoff_value as roundoff, bm.bm_paymode as payment_mode 
                                                                        FROM tbl_shift_details ts 
                                                                        left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                                                        left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                                                        left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                                                        left join tbl_voucherpayment vp on vp.vp_system_ip=ts.sd_open_machineid
                                                                        left join tbl_tablebillmaster bm on bm.bm_settlement_login=lg.ls_username
                                                                        where ts.sd_day = '".$previous_date."' and bm.bm_dayclosedate = '".$previous_date."' and  ts.sd_open_machineid ='".$previous_ip."'  and bm_finaltotal>0 and bm.bm_settlement_login='".$result_shift_user['ls_username']."'
                                                                        union all
                                                                        SELECT ts.sd_open_machineid,ts.sd_day,ts.sd_open,ts.sd_open_balance,ts.sd_open_petty,ts.sd_close,ts.sd_close_balance,ts.sd_close_petty,
                                                                        st.ser_firstname,em.cm_ip_remarks as countername,tab_netamt as final,tbm.tab_mode as mode, vp1.vp_amount as voucheramount,vp1.vp_type as vouchertype,
                                                                        (tab_amountpaid-tab_amountbalace) as cash, tab_transactionamount as card,tbm.tab_chequebankamount as cheque,tbm.tab_upi_amount as upi, tbm.tab_couponamt as coupon,tbm.tab_discountvalue as discount, tbm.tab_roundoff_value as roundoff,tbm.tab_paymode as payment_mode
                                                                        FROM tbl_shift_details ts 
                                                                        left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                                                        left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                                                        left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                                                        left join tbl_voucherpayment vp1 on vp1.vp_system_ip=ts.sd_open_machineid
                                                                        left join tbl_takeaway_billmaster tbm on tbm.tab_settlement_login=lg.ls_username
                                                                        where ts.sd_day = '".$previous_date."' and  tbm.tab_dayclosedate = '".$previous_date."' and ts.sd_open_machineid ='".$previous_ip."'   and tab_netamt> 0 and tbm.tab_settlement_login='".$result_shift_user['ls_username']."' ");
                                    
                                    $viewcash_di=0;$viewcard_payments_di=0;$viewcard_payments_di=0;$viewcredit_payments_di=0;$viewcoupon_payments_di=0;$viewcomplimentary_payments_di=0;$viewcheque_payments_di=0;$viewupi_payments_di=0;$viewrounddi_of=0;$viewdiscountdi=0; 
                                    $viewcash_ta=0;$viewcard_payments_ta=0;$viewcard_payments_ta=0;$viewcredit_payments_ta=0;$viewcoupon_payments_ta=0;$viewcomplimentary_payments_ta=0;$viewcheque_payments_ta=0;$viewupi_payments_ta=0;$viewroundta_of=0;$viewdiscountta=0; 
                                    $viewcash_cs=0;$viewcard_payments_cs=0;$viewcard_payments_cs=0;$viewcredit_payments_cs=0;$viewcoupon_payments_cs=0;$viewcomplimentary_payments_cs=0;$viewcheque_payments_cs=0;$viewupi_payments_cs=0;$viewroundcs_of=0;$viewdiscountcs=0; 
                                    $viewcash_hd=0;$viewcard_payments_hd=0;$viewcard_payments_hd=0;$viewcredit_payments_hd=0;$viewcoupon_payments_hd=0;$viewcomplimentary_payments_hd=0;$viewcheque_payments_hd=0;$viewupi_payments_hd=0;$viewroundhd_of=0;$viewdiscounthd=0; 
                                    $final_di1=0;$final_ta1=0;$final_cs1=0;$final_hd1=0;
                                    $viewvoucherincome_di=0;$viewvoucherincome_ta=0;$viewvoucherincome_cs=0;$viewvoucherincome_hd=0;
                                    $viewvoucherexpense_di=0;$viewvoucherexpense_ta=0;$viewvoucherexpense_cs=0;$viewvoucherexpense_hd=0;
                                    $sql_shift_details  =  $database->mysqlQuery("select ser_firstname,sd_open,sd_open_balance,sd_open_petty,sd_close,sd_close_balance,sd_close_petty,
                                    mode,final,payment_mode,cash,card,coupon,cheque,upi,roundoff,discount,vouchertype,voucheramount from shiftcounter order by mode");                          
                                    $num_shift_details  = $database->mysqlNumRows($sql_shift_details);
                                    if($num_shift_details){ $i=0;$user='';$user1='';$opentime='';$open_bal='';$open_pet='';
                                    $closetime='';$close_bal='';$close_pet='';
                                        while($result_shift_details  = $database->mysqlFetchArray($sql_shift_details)) 
                                            {   $i++;
                                            
                                            if($i=='1'){
                                                $user=$result_shift_details['ser_firstname'];
                                                $opentime=$result_shift_details['sd_open'];
                                                $open_bal=$result_shift_details['sd_open_balance'];
                                                $open_pet=$result_shift_details['sd_open_petty'];
                                            }
                                            else{
                                            $user=$user;
                                            $opentime=$opentime;
                                            $open_bal=$open_bal;
                                            $open_pet=$open_pet;
                                            }

                                            

                                                $closetime=$result_shift_details['sd_close'];
                                                $close_bal=$result_shift_details['sd_close_balance'];
                                                $close_pet=$result_shift_details['sd_close_petty'];                                               
                                                if($result_shift_details['mode']=='DI'){                                                    
                                                    $final_di1      =$final_di1+$result_shift_details['final'];
                                                if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_di      =$viewcash_di+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_di=$viewcard_payments_di+$result_shift_details['card'];
                                                }
                                                else if($result_shift_details['payment_mode']=='3'){
                                                    $viewcoupon_payments_di=$viewcoupon_payments_di+$result_shift_details['coupon'];
                                                }
                                                else if($result_shift_details['payment_mode']=='5'){
                                                    $viewcheque_payments_di=$viewcheque_payments_di+$result_shift_details['cheque'];
                                                }
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_di=$viewcredit_payments_di+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_di=$viewcomplimentary_payments_di+$result_shift_details['final'];
                                                }
                                                else if($result_shift_details['payment_mode']=='8'){
                                                    $viewupi_payments_di=$viewupi_payments_di+$result_shift_details['upi'];
                                                }
                                                $viewround_ofdi=$viewrounddi_of+$result_shift_details['roundoff'];
                                                $viewdiscountdi=$viewdiscountdi+$result_shift_details['discount'];
                                                if($result_shift_details['vouchertype']=='Expense'){
                                                    $viewvoucherexpense_di=$viewvoucherexpense_di+$result_shift_details['voucheramount'];
                                                }
                                                else if($result_shift_details['vouchertype']=='Income'){
                                                    $viewvoucherincome_di=$viewvoucherincome_di+$result_shift_details['voucheramount'];
                                                }    
                                                }
                                                else if($result_shift_details['mode']=='TA'){
                                                     
                                                     $final_ta1      =$final_ta1+$result_shift_details['final'];
                                                if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_ta      =$viewcash_ta+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_ta=$viewcard_payments_ta+$result_shift_details['card'];
                                                }
                                                else if($result_shift_details['payment_mode']=='3'){
                                                    $viewcoupon_payments_ta=$viewcoupon_payments_ta+$result_shift_details['coupon'];
                                                }
                                                else if($result_shift_details['payment_mode']=='5'){
                                                    $viewcheque_payments_ta=$viewcheque_payments_ta+$result_shift_details['cheque'];
                                                }
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_ta=$viewcredit_payments_ta+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_ta=$viewcomplimentary_payments_ta+$result_shift_details['final'];
                                                }
                                                else if($result_shift_details['payment_mode']=='8'){
                                                    $viewupi_payments_ta=$viewupi_payments_ta+$result_shift_details['upi'];
                                                }
                                                $viewroundta_of=$viewroundta_of+$result_shift_details['roundoff'];
                                                $viewdiscountta=$viewdiscountta+$result_shift_details['discount'];
                                                if($result_shift_details['vouchertype']=='Expense'){
                                                    $viewvoucherexpense_ta=$viewvoucherexpense_ta+$result_shift_details['voucheramount'];
                                                }
                                                else if($result_shift_details['vouchertype']=='Income'){
                                                    $viewvoucherincome_ta=$viewvoucherincome_ta+$result_shift_details['voucheramount'];
                                                }
                                                }
                                                else if($result_shift_details['mode']=='HD'){
                                                     $final_hd1      =$final_hd1+$result_shift_details['final'];
                                                if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_hd      =$viewcash_hd+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_hd=$viewcard_payments_hd+$result_shift_details['card'];
                                                }
                                                else if($result_shift_details['payment_mode']=='3'){
                                                    $viewcoupon_payments_hd=$viewcoupon_payments_hd+$result_shift_details['coupon'];
                                                }
                                                else if($result_shift_details['payment_mode']=='5'){
                                                    $viewcheque_payments_hd=$viewcheque_paymen_hd+$result_shift_details['cheque'];
                                                }
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_hd=$viewcredit_payments_hd+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_hd=$viewcomplimentary_payments_hd+$result_shift_details['final'];
                                                }
                                                else if($result_shift_details['payment_mode']=='8'){
                                                    $viewupi_payments_hd=$viewupi_payments_hd+$result_shift_details['upi'];
                                                }
                                                $viewroundhd_of=$viewroundhd_of+$result_shift_details['roundoff'];
                                                $viewdiscounthd=$viewdiscounthd+$result_shift_details['discount'];
                                                
                                                 if($result_shift_details['vouchertype']=='Expense'){
                                                    $viewvoucherexpense_hd=$viewvoucherexpense_hd+$result_shift_details['voucheramount'];
                                                }
                                                else if($result_shift_details['vouchertype']=='Income'){
                                                    $viewvoucherincome_hd=$viewvoucherincome_hd+$result_shift_details['voucheramount'];
                                                }       
                                                } 
                                                else if($result_shift_details['mode']=='CS'){
                                                     $final_cs1      =$final_cs1+$result_shift_details['final'];
                                                     if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_cs      =$viewcash_cs+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_cs=$viewcard_payments_cs+$result_shift_details['card'];
                                                }
                                                else if($result_shift_details['payment_mode']=='3'){
                                                    $viewcoupon_payments_cs=$viewcoupon_payments_cs+$result_shift_details['coupon'];
                                                }
                                                else if($result_shift_details['payment_mode']=='5'){
                                                    $viewcheque_payments_cs=$viewcheque_paymen_cs+$result_shift_details['cheque'];
                                                }
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_cs=$viewcredit_payments_cs+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_cs=$viewcomplimentary_payments_cs+$result_shift_details['final'];
                                                }
                                                else if($result_shift_details['payment_mode']=='8'){
                                                    $viewupi_payments_cs=$viewupi_payments_cs+$result_shift_details['upi'];
                                                }
                                                $viewroundcs_of=$viewroundcs_of+$result_shift_details['roundoff'];
                                                $viewdiscountcs=$viewdiscountcs+$result_shift_details['discount'];
                                                
                                                if($result_shift_details['vouchertype']=='Expense'){
                                                    $viewvoucherexpense_cs=$viewvoucherexpense_cs+$result_shift_details['voucheramount'];
                                                }
                                                else if($result_shift_details['vouchertype']=='Income'){
                                                    $viewvoucherincome_cs=$viewvoucherincome_cs+$result_shift_details['voucheramount'];
                                                }    
                                                }} ?>
                                    <tr>
                                        <td style="font-size: 10px"><?=substr($user,0,8)?></td>
                                        <td style="font-size: 10px"><?=date('h:i:s a',strtotime($opentime))?></td>
                                        <td><?=number_format($open_bal,$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format($open_pet,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=date('h:i:s a',strtotime($closetime))?></td>
                                        <td><?=number_format($close_bal,$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format($close_pet,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format($final_di1,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format($final_ta1,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format($final_cs1,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format($final_hd1,$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format(($viewcash_di+$viewcash_ta+$viewcash_cs+$viewcash_hd),$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format(($viewcard_payments_di+$viewcard_payments_ta+$viewcard_payments_cs+$viewcard_payments_hd),$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"> <?=number_format(($viewcredit_payments_di+$viewcredit_payments_ta+$viewcredit_payments_cs+$viewcredit_payments_hd),$_SESSION['be_decimal']) ?></td>
                                        <td style="font-size: 10px"><?=number_format(($viewcomplimentary_payments_di+$viewcomplimentary_payments_ta+$viewcomplimentary_payments_cs+$viewcomplimentary_payments_hd),$_SESSION['be_decimal'])?></td>
                                        <td style="display:none"><?=number_format(($viewupi_payments_di+$viewupi_payments_ta+$viewupi_payments_cs+$viewupi_payments_hd),$_SESSION['be_decimal']) ?></td>
                                        <td style="display:none"><?=number_format(($viewcheque_payments_di+$viewcheque_payments_ta+$viewcheque_payments_cs+$viewcheque_payments_hd),$_SESSION['be_decimal'])?></td>
                                        <td style="display:none"><?=number_format(($viewcoupon_payments_di+$viewcoupon_payments_ta+$viewcoupon_payments_cs+$viewcoupon_payments_hd),$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format(($viewdiscountdi+$viewdiscountta+$viewdiscountcs+$viewdiscounthd),$_SESSION['be_decimal']) ?></td>
                                        <td><?=number_format(($viewrounddi_of+$viewroundta_of+$viewroundcs_of+$viewroundhd_of),$_SESSION['be_decimal']) ?></td>
                                        <td style="font-size: 10px"><?=number_format(($viewvoucherincome_di+$viewvoucherincome_ta+$viewvoucherincome_cs+$viewvoucherincome_hd),$_SESSION['be_decimal'])?></td>
                                        <td style="font-size: 10px"><?=number_format(($viewvoucherexpense_di+$viewvoucherexpense_ta+$viewvoucherexpense_cs+$viewvoucherexpense_hd),$_SESSION['be_decimal'])?></td>
                                         <td style="font-size: 10px"><?=number_format(($final_di1+$final_ta1+$final_cs1+$final_hd1),$_SESSION['be_decimal'])?></td>
                                    </tr>
                        <?php
                                    }else{ ?>
                                    <tr >
                                    <th colspan='20'><strong>NO SHIFT DATA</strong></th>
                                </tr>
                                
                                <?php
                                    }
                                    
                                    $sqldrop  =  $database->mysqlQuery ("DROP VIEW shiftcounter");
                                        }
                                          }
                                }
                                }
                            }
                           ?>
                                     </tbody>
                                     </table>
                            <?php
                        } else{
                            echo '<p id="rcord" style="text-align:center;color:red; font-weight:bold; font-size:15px">No records to display</p>';
                            echo '<script> $("#rcord").delay(1000).fadeOut("slow")</script>';
                        } ?>    
    <?php       
}


else if(($_REQUEST['type']=="consolidated_timely_report"))
{
     	
        
	$string="";
        $stringta="";
	
        $reporthead="";
        $st="";
        $from="";
        $stringmodeta="";
        $from=$database->convert_date($_REQUEST['fromdt']);
        
        $string.= " bm.bm_dayclosedate = '".$from."'  ";
        $stringta.= " tbm.tab_dayclosedate = '".$from."' ";
         

//		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
//		{
//			$from=$database->convert_date($_REQUEST['fromdt']);
//			$to=$database->convert_date($_REQUEST['todt']);
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
//		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
//		{
//			$from=$database->convert_date($_REQUEST['fromdt']);
//			$to=date("Y-m-d");
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
//		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
//		{
//			$from=date("Y-m-d");
//			$to=$database->convert_date($_REQUEST['todt']);
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
                
                  
	
//	else 
//	{
//		
//		$bydatz=$_REQUEST['bydate'];
//                if($bydatz!="" && $bydatz!="null")
//                {
//	
//	if($bydatz=="Last5days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
//DAY AND CURDATE( )";
//                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
//DAY AND CURDATE( )";
//                $st="Last 5 days";
//	}elseif($bydatz=="Last10days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
//DAY AND CURDATE( )";
//                $st="Last 10 days";
//	}
//	else if($bydatz=="Yesterday")
//			  {
//				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
//                                  $stringta.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
//                                  $st="Yesterday";
//			  }
//	elseif($bydatz=="Last15days")
//	{
//		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
//DAY AND CURDATE( )";
//                $st="Last 15 days";
//	}
//	else if($bydatz=="Last20days")
//	{
//		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
//DAY AND CURDATE( )";
//                $st="Last 20 days";
//	}
//	else if($bydatz=="Last25days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
//DAY AND CURDATE( )";
//                $st="Last 25 days";
//	}
//	else if($bydatz=="Last30days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
//DAY AND CURDATE( )";
//                $st="Last 30 days";
//	}
//	 else if($bydatz=="Last1month")
//			  {
//				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
//                                  $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
//                                  $st="Last 1 MONTH";
//			  }
//	else if($bydatz=="Today")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
//                $st="TODAY";
//	}
//else if($bydatz=="Last90days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
//                $st="Last 90 days";
//	}
//else if($bydatz=="Last180days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
//                $st="Last 180 days";
//	}
//else if($bydatz=="Last365days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
//                $st="Last  1 Year";
//	}
//
//       
//	
//        $reporthead=$st;
//        }
//        else
//	{
//		
//		
//		$from=date("Y-m-d");
//			$to=date("Y-m-d");
//			$string.= " bm.bm_dayclosedate ='".$from."'";
//                        $stringta.= " tbm.tab_dayclosedate='".$from."'";
//                        $reporthead="On ".$database->convert_date($from);
//	}
//	
//        }
//	
	
	
	
	?>
                            <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong> Hourly Report</strong></th>
      </tr>

      
    </thead>
    </table> 
                            
                            
                <table class="table table-bordered table-font user_shadow" >
                    <thead>
                         
                        
                        
                        <tr>
                            <th colspan="3">Hourly Report - <?=$from?></td>
                        </tr>
                        
			 <tr>
                             <th >Sl</th>
                            <th >Hour Between </th>
                              <th >Final Total</th>
                        </tr>
                       
                    </thead>
                   
                    
                    <tbody>
                        
								
	
	
<?php
$final=0;

$p=0;
  $sql_logincashier  =  $database->mysqlQuery("select sum(x.total) as total, x.hour1 as hour1 from( 
                                                    select  SUM(bm.bm_finaltotal) AS total, HOUR(bm.bm_billtime ) as hour1 FROM tbl_tablebillmaster bm
                                                    where $string and bm.bm_status='Closed' and bm.bm_complimentary!='Y' group by HOUR(bm.bm_billtime ) union all
                                                    SELECT  SUM(tbm.tab_netamt) as total, HOUR(tbm.tab_time) as hour1  FROM tbl_takeaway_billmaster tbm
                                                    WHERE $stringta and tbm.tab_status='Closed' and tbm.tab_complimentary!='Y' group by HOUR(tbm.tab_time)
                                                    )x group by  x.hour1"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final=$final+$result_hourly_wise['total'];
                                $time1=date('h',strtotime($result_hourly_wise['hour1'].':0:0'));
                                $time2=$result_hourly_wise['hour1']+1;
                                $time2=date('h a',strtotime($time2.':0:0'));
          
           ?>
                    <tr>
                        <td><?=$p?></td>
                        <td><?=$time1.'-'.$time2?></td>
                        <td><?=number_format($result_hourly_wise['total'],$_SESSION['be_decimal'])?></td>
                        
                    </tr>       
           
      <?php 
        }}
        ?>
                     <tr>
                        <td ><strong>TOTAL</strong></td>
                            
                         <td></td>
                        
                        <td><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
                        </tr>
                    </tbody>
                    </table>
                        
<?php

}




 else if(($_REQUEST['type']=="tax_report"))
{
    
?>
                                 <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong> Tax Report</strong></th>
      </tr>

      
    </thead>
    </table> 
                            <?php
	$tax="";
    
    if(isset($_REQUEST['department'])){
            $dept=$_REQUEST['department'];
            
        }else{
            $dept="";
        }
    
   if(isset($_REQUEST['tax'])){
            $tx1=$_REQUEST['tax'];
            
              //$tx1=implode(',', $tax)  ;
        }else{
            $tx1="";
        }
	$string5.= " ";
                          $stringta6.= "  ";
      
        $string="";
        $stringta="";
        $string1="";
        $stringta1="";
                
	$string.=" tbm.bm_status='Closed' AND etm.bem_taxid in ($tx1)  and  tbm.bm_complimentary!='Y' AND  ";
        $string1.=" tbm.bm_status='Closed' and  tbm.bm_complimentary!='Y' AND  ";
        
        if($dept=="TA" || $dept=="CS" || $dept=="HD"){
        $stringta.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y' AND etm.tbe_taxid in ($tx1)  AND tkm.tab_mode='$dept'   and  tkm.tab_complimentary!='Y' AND ";
        $stringta1.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y' AND tkm.tab_mode='$dept'   and  tkm.tab_complimentary!='Y'  AND ";
        
        }
        else {
            $stringta.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y'  AND etm.tbe_taxid in ($tx1)  and  tkm.tab_complimentary!='Y' AND  ";
            $stringta1.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y'  and  tkm.tab_complimentary!='Y' AND  ";
        }
        
	$reporthead="";
	$st="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                          $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                          $string5.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                          $stringta6.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string5.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                          $stringta6.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string5.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                          $stringta6.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
		
		
	
	else 
	{
		

	$reporthead="";
	$st="";
        
	$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
                
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" tbm.bm_dayclosedate = CURDATE( ) - INTERVAL 1 day ";//" bm_dayclosedate =CURDATE() - 1  ";
                                   $stringta.=" tkm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 day ";
                                   
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $stringta.="  tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		
                $st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		
                $st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
		
	}
   $taxid         =array();
    $tax_values    =array();
    $bill_values   =array();
    $tax_name      =array();
    $values_sum    =array();
    
                $sql_login  =  $database->mysqlQuery(" select distinct(taxid) as taxid,taxname from ( select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  FROM tbl_tablebill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid where amc_id in ($tx1) group by amc_id  union all 
                                                        select distinct(betm.tbe_taxid) as taxid,betm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.tbe_taxid where amc_id in ($tx1) group by amc_id  ) x order by x.taxid asc"); 
                                                 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){ 
                    while($result_login=$database->mysqlFetchArray($sql_login)){
                    $tax_name[]=$result_login['taxname'];
                    $tax_id[]=$result_login['taxid'];
                    
                }}
                
                //**TAX DETAILS FETCHING**
                if($dept=="DI"){
                    $sql_tax_details  =  $database->mysqlQuery("SELECT tbm.bm_dayclosedate,sum(etm.bem_total_value) as tax, etm.bem_taxid as taxid   FROM tbl_tablebill_extra_tax_master etm left join tbl_tablebillmaster tbm on tbm.bm_billno= etm.bem_billno where $string  group by etm.bem_taxid,tbm.bm_dayclosedate"); 
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['bm_dayclosedate']][$result_tax_details['taxid']][]=$result_tax_details['tax'];

                    }}
                    
                }
                else if($dept=="TA" || $dept=="CS" || $dept=="HD"){
                    $sql_tax_details  =  $database->mysqlQuery("SELECT tkm.tab_dayclosedate,sum(etm.tbe_total_value) as tax, etm.tbe_taxid as taxid  FROM tbl_takeaway_bill_extra_tax_master etm left join tbl_takeaway_billmaster tkm on tkm.tab_billno = etm.tbe_billno where $stringta group by etm.tbe_taxid,tkm.tab_dayclosedate");
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['tab_dayclosedate']][$result_tax_details['taxid']][]=$result_tax_details['tax'];
                    }}
                }
                else{
                    $sql_tax_details  =  $database->mysqlQuery("select date, sum(tax) as tax,taxid from (
                            SELECT tbm.bm_dayclosedate as date,etm.bem_total_value as tax, etm.bem_taxid as taxid   FROM tbl_tablebill_extra_tax_master etm left join tbl_tablebillmaster tbm on tbm.bm_billno= etm.bem_billno where $string  union all
                            SELECT tkm.tab_dayclosedate as date,etm.tbe_total_value as tax, etm.tbe_taxid as taxid  FROM tbl_takeaway_bill_extra_tax_master etm left join tbl_takeaway_billmaster tkm on tkm.tab_billno = etm.tbe_billno where $stringta 
                            )x group by x.date,x.taxid");
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['date']][$result_tax_details['taxid']][]=$result_tax_details['tax'];

                    }}
                }
                //print_r($bill_values);
                
               //**TAX DETAILS FETCHING**
            if($tax_values){    
            ?>
            
            <table class="table table-bordered table-font user_shadow">
		<thead>
                    <tr>
                        <th colspan="<?=8+count($tax_name)?>"> Report - <?=$reporthead?></th>
                    </tr>
                    <tr>
                        <th class="sortable">Date</th>
                        <th class="sortable">Bill No From</th>
                        <th class="sortable">Bill No To</th>
                        <th class="sortable">Sales</th>
                        <?php
                        for($i=0;$i<count($tax_name);$i++){
                        ?>
                        <th class="sortable"><?=$tax_name[$i]?></th>
                        <?php } ?>
                        <th class="sortable">Total Tax Amount</th>
                        <th class="sortable">Tax Exempt Amount</th>
                        <th class="sortable">Round Off</th>
                        <th class="sortable">Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach($tax_values as $key=>$val){
                    $summ_tax =  array();
                    $min_bill='';
                    $max_bill='';
                    $bill=array();
                    //**BILL DETAILS FETCHING** 
                    if($dept=="DI"){
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(tbm.bm_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tbm.bm_billno, '-', -1)) as max_bill,tbm.bm_dayclosedate,sum(tbm.bm_subtotal_final) as subtotal, sum(tbm.bm_finaltotal) as final,sum(tbm.bm_discountvalue) as discount, sum(tbm.bm_roundoff_value) as roundof,sum(tbm.bm_tax_exempt) as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 tbm.bm_dayclosedate='$key' group by tbm.bm_dayclosedate order by tbm.bm_billtime,tbm.bm_billdate asc");
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['bm_dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                            
                        }}
                    }
                    else if($dept=="TA" || $dept=="CS" || $dept=="HD"){
                        $sql_bill_details  =  $database->mysqlQuery("select  min( SUBSTRING_INDEX(tkm.tab_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tkm.tab_billno, '-', -1)) as max_bill,tkm.tab_dayclosedate,sum(tkm.tab_subtotal_final) as subtotal, sum(tkm.tab_netamt) as final, sum(tkm.tab_discountvalue) as discount, sum(tkm.tab_roundoff_value) as roundof ,sum(tkm.tab_tax_exempt) as tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 tkm.tab_dayclosedate ='$key' group by tkm.tab_dayclosedate order by tkm.tab_time,tkm.tab_date asc ");

                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['tab_dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                        
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                        }}
                        
                    }
                   else{
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(bill, '-', -1) ) as min_bill, max(SUBSTRING_INDEX(bill, '-', -1)) as max_bill,billdate,billtime,dayclosedate,sum(subtotal) as subtotal ,sum(final) as final ,sum(discount) as discount,sum(roundof) as roundof,sum(tax_exempt) as tax_exempt from(
                                                                    select tbm.bm_billno as bill,tbm.bm_billdate as billdate,tbm.bm_billtime as billtime,tbm.bm_dayclosedate as dayclosedate,tbm.bm_subtotal_final as subtotal, tbm.bm_finaltotal as final,tbm.bm_discountvalue as discount, tbm.bm_roundoff_value as roundof,tbm.bm_tax_exempt as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 tbm.bm_dayclosedate='$key' union all
                                                                    select  tkm.tab_billno as bill,tkm.tab_date as billdate,tkm.tab_time as billtime,tkm.tab_dayclosedate as dayclosedate,tkm.tab_subtotal_final as subtotal, tkm.tab_netamt as final, tkm.tab_discountvalue as discount, tkm.tab_roundoff_value as roundof ,tkm.tab_tax_exempt as bm_tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 tkm.tab_dayclosedate ='$key')y group by y.dayclosedate order by billdate,billtime asc ");
                        
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                            
                        }}
                    }
                    //**BILL DETAILS FETCHING** 
                    $values_sum['SALES_TOTAL'][]        =$bill_values[$key]['SUB'];
                    $values_sum['TAX_EXEMPT_TOTAL'][]   =$bill_values[$key]['TAX_EXEM'];
                    $values_sum['ROUNDOFF_TOTAL'][]     =$bill_values[$key]['ROUND'];
                    $values_sum['FINAL_TOTAL'][]        =$bill_values[$key]['FINAL'];
                    natsort($bill);
                    
                ?>
                    <tr>
                        
                        <td><?=$key?></td>
                        <?php foreach($bill as $key1=>$val1){ ?>
                        <td><?=$val1?></td>
                        <?php } ?>
                        <td><?=number_format($bill_values[$key]['SUB'],$_SESSION['be_decimal'])?></td>
                        <?php
                        for($i=0;$i<count($tax_name);$i++){
                            if(array_key_exists($tax_id[$i],$tax_values[$key])){
                                $summ_tax[]=array_sum($tax_values[$key][$tax_id[$i]]);
                                $values_sum['EACH_TAX_TOTAL'][$tax_id[$i]][]=array_sum($tax_values[$key][$tax_id[$i]]);
                        ?>
                            <td><?=number_format(array_sum($tax_values[$key][$tax_id[$i]]),$_SESSION['be_decimal'])?></td>
                        <?php
                        }
                        else{
                        ?>
                            <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                        <?php    
                        }}
                        $values_sum['TOTAL_TAX_AMOUNT'][]=array_sum($summ_tax);
                        ?>
                        <td><?=number_format(array_sum($summ_tax),$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($bill_values[$key]['TAX_EXEM'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($bill_values[$key]['ROUND'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($bill_values[$key]['FINAL'],$_SESSION['be_decimal'])?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php
                    for($i=0;$i<count($tax_name);$i++){
                    ?>    
                     <td></td>
                    <?php    
                    } ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr> 
                
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td></td>
                    <td></td>
                    <td><strong><?=number_format(array_sum($values_sum['SALES_TOTAL']),$_SESSION['be_decimal'])?></strong></td>
                    <?php
                    for($i=0;$i<count($tax_name);$i++){
                        if(array_key_exists($tax_id[$i],$values_sum['EACH_TAX_TOTAL'])){
                    ?>
                        <td><strong><?=number_format(array_sum($values_sum['EACH_TAX_TOTAL'][$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
                    <?php }
                        else{
                    ?>
                         <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
                    <?php    
                        }    
                    } 
                    ?>
                    <td><strong><?=number_format(array_sum($values_sum['TOTAL_TAX_AMOUNT']),$_SESSION['be_decimal'])?></strong></td>
                    <td><strong><?=number_format(array_sum($values_sum['TAX_EXEMPT_TOTAL']),$_SESSION['be_decimal'])?></strong></td>
                    <td><strong><?=number_format(array_sum($values_sum['ROUNDOFF_TOTAL']),$_SESSION['be_decimal'])?></strong></td>
                    <td><strong><?=number_format(array_sum($values_sum['FINAL_TOTAL']),$_SESSION['be_decimal'])?></strong></td>
                </tr>
            </tbody>
            </table>
        <?php
            }
          else{ ?>           
            <table class="table table-bordered table-font user_shadow">
		<thead>
                    <tr>
                        <th colspan="4"> Report - <?=$reporthead?></th>
                    </tr>
                    <tr>
                        <th class="sortable">Date</th>
                        <th class="sortable">Bill No From</th>
                        <th class="sortable">Bill No To</th>
                        
                        <th class="sortable">Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $summ_tax =  array(); $bill_tot=array();
                    $min_bill='';
                    $max_bill='';
                    $bill=array();
                    $bill1=array();
                     $bill_dates_in=array(); $tot=0;
                    //**BILL DETAILS FETCHING** 
                    if($dept=="DI"){
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(tbm.bm_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tbm.bm_billno, '-', -1)) as max_bill,tbm.bm_dayclosedate,sum(tbm.bm_subtotal_final) as subtotal, sum(tbm.bm_finaltotal) as final,sum(tbm.bm_discountvalue) as discount, sum(tbm.bm_roundoff_value) as roundof,sum(tbm.bm_tax_exempt) as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 $string5 group by tbm.bm_dayclosedate order by tbm.bm_billtime,tbm.bm_billdate asc");
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values['SUB']=$result_bill_details['subtotal'];
                            $bill_values['FINAL']=$result_bill_details['final'];
                            $bill_values['DISC']=$result_bill_details['discount'];
                            $bill_values['ROUND']=$result_bill_details['roundof'];
                            $bill_values['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;                           
                        }}
                    }
                    else if($dept=="TA" || $dept=="CS" || $dept=="HD"){
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(tkm.tab_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tkm.tab_billno, '-', -1)) as max_bill ,tkm.tab_dayclosedate,sum(tkm.tab_subtotal_final) as subtotal, sum(tkm.tab_netamt) as final, sum(tkm.tab_discountvalue) as discount, sum(tkm.tab_roundoff_value) as roundof ,sum(tkm.tab_tax_exempt) as tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 $stringta6 group by tkm.tab_dayclosedate order by tkm.tab_time,tkm.tab_date asc ");
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values['SUB']=$result_bill_details['subtotal'];
                            $bill_values['FINAL']=$result_bill_details['final'];
                            $bill_values['DISC']=$result_bill_details['discount'];
                            $bill_values['ROUND']=$result_bill_details['roundof'];
                            $bill_values['TAX_EXEM']=$result_bill_details['tax_exempt'];                    
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                        }}
                    }
                   else{
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(bill, '-', -1) ) as min_bill, max(SUBSTRING_INDEX(bill, '-', -1)) as max_bill,billdate,billtime,dayclosedate,sum(subtotal) as subtotal ,sum(final) as final ,sum(discount) as discount,sum(roundof) as roundof,sum(tax_exempt) as tax_exempt from(
                                                                    select tbm.bm_billno as bill,tbm.bm_billdate as billdate,tbm.bm_billtime as billtime,tbm.bm_dayclosedate as dayclosedate,tbm.bm_subtotal_final as subtotal, tbm.bm_finaltotal as final,tbm.bm_discountvalue as discount, tbm.bm_roundoff_value as roundof,tbm.bm_tax_exempt as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 $string5 union all
                                                                    select  tkm.tab_billno as bill,tkm.tab_date as billdate,tkm.tab_time as billtime,tkm.tab_dayclosedate as dayclosedate,tkm.tab_subtotal_final as subtotal, tkm.tab_netamt as final, tkm.tab_discountvalue as discount, tkm.tab_roundoff_value as roundof ,tkm.tab_tax_exempt as bm_tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 $stringta6 )y group by y.dayclosedate order by billdate,billtime asc ");                       
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values['SUB']=$result_bill_details['subtotal'];
                            $bill_values['FINAL']=$result_bill_details['final'];
                            $bill_values['DISC']=$result_bill_details['discount'];
                            $bill_values['ROUND']=$result_bill_details['roundof'];
                            $bill_values['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill_values['DAY']=$result_bill_details['dayclosedate'];
                            $bill[]=$min_bill;
                            
                             $bill1[]=$max_bill;
                             $bill_dates_in[]=$result_bill_details['dayclosedate'];
                             $bill_tot[]=$result_bill_details['final'];
                             
                             $tot=$tot+$result_bill_details['final'];
                        }}
                    }
                    //**BILL DETAILS FETCHING** 
                    $values_sum['SALES_TOTAL'][]        =$bill_values['SUB'];
                    $values_sum['TAX_EXEMPT_TOTAL'][]   =$bill_values['TAX_EXEM'];
                    $values_sum['ROUNDOFF_TOTAL'][]     =$bill_values['ROUND'];
                    $values_sum['FINAL_TOTAL'][]        =$bill_values['FINAL'];
                    natsort($bill);  
                    
                    for($m=0;$m<count($bill_dates_in);$m++){
                ?>
                    <tr>
                        <td><?= $bill_values['DAY']?></td>
                        <td><?=$bill[$m]?></td>
                           <td><?=$bill1[$m]?></td>
                         <td><?=number_format($bill_tot[$m],$_SESSION['be_decimal'])?></td>
                    </tr>
                    
                  <?php
                }
                ?>  
                    
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr> 
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td></td>
                    <td></td>
                    
                    <td><strong><?=number_format($tot,$_SESSION['be_decimal'])?></strong></td>
                </tr>
            </tbody>
            </table>
        <?php
            }             

}
else if(($_REQUEST['type']=="sales_summary_report_cr"))
  {  ?>
                            
                            
                            
    <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
      </tr>
        
      <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Sales Summary</strong></th>
      </tr>

      
    </thead>
           
    </table> 
                            
                            
     
        <?php
     
	$string="";
        $stringtax='';
        $stringstat=" tab_complimentary!='Y'  AND ";
        $stringstatdi="bm_complimentary!='Y' AND ";
        $stringta="";
        $stringcs="";
        $stringhd="";
        $stringtacshd='';
        //$strings="";
	$reporthead="";
	$string .=" bm_status='Closed' AND ";
        $stringtacshd .=" tab_status='Closed' AND ";
        $stringta .=" tab_status='Closed' AND tab_mode='TA'  AND ";
        $stringcs .=" tab_status='Closed' AND tab_mode='CS'  AND ";
        $stringhd .=" tab_status='Closed' AND tab_mode='HD'  AND ";
	$stringtax.=" tab_status='Closed'  AND ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	else if(isset($_REQUEST['bydate']))
	{ 
            
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 DAY";
                $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY";
		$stringta.=" tab_dayclosedate =CURDATE( ) - INTERVAL 1 DAY";
                $stringtax.=" tab_dayclosedate =CURDATE( ) - INTERVAL 1 DAY";
                $stringcs.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                $stringhd.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                
                $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 DAY";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
        $reporthead=$st;
	}else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
                $stringtacshd.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
                $stringta.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
                $stringtax.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
                $stringcs.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
                $stringhd.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	  $final=0;
   $srvtx=0;
   $subtotal=0;
   $subtotalta=0;
   $subtotalcs=0;
   $subtotalhd=0;
   $salesinctaxtacshd=0;
   $salesinctax=0;
   $salesexcltaxdi=0;
   $salesexcltaxta=0;
   $salesexcltaxcs=0;
   $salesexcltaxhd=0;

   $servtax=0;
   $servtaxtacshd=0;
   $tot_servtax=0;
   $servcharge=0;
   $servchargetacshd=0;
   $vat=0;
   $vattacshd=0;
   $tot_vat=0;
   $roundof=0;
   $roundoftacshd=0;
   $tot_roundof=0;
   $taxexemptdi=0;
   $taxexemptta=0;
   $taxexempthd=0;
   $taxexemptcs=0;

   $uae_subtotal=0; 
   $uae_subtotal_ta=0;
   $uae_subtotal_hd=0; 
   $uae_subtotal_cs=0;

  $sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-(sum(bm_discountvalue)+sum(bm_redeem_amount))) as totexcl,sum(bm_roundoff_value) as totroundof,sum(bm_tax_exempt) as taxexempt FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
                        
                        $salesinctax = $salesinctax+$result_login['tot'];
                        $salesexcltaxdi = $salesexcltaxdi+$result_login['totexcl'];
                        $taxexemptdi = $taxexemptdi+$result_login['taxexempt'];
                        $roundof=$roundof+$result_login['totroundof'];
                         $uae_subtotal=$uae_subtotal+$result_login['uae_subtotal']; 
          } } }
          
          
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				if($result_loginta['tot'] != "")	{
			$subtotalta =$subtotalta + $result_loginta['tot'];
                        $salesexcltaxta =$salesexcltaxta+$result_loginta['totexcl'];
                        $taxexemptta = $taxexemptta+$result_loginta['taxexempt'];
                        $uae_subtotal_ta=$uae_subtotal_ta+$result_loginta['uae_subtotal']; 
          } } } 
          
          
          $sql_logincs  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs"); 
	  $num_logincs   = $database->mysqlNumRows($sql_logincs);
	  if($num_logincs){
		  while($result_logincs  = $database->mysqlFetchArray($sql_logincs)) 
			{ 
				if($result_logincs['tot'] != "")	{
			$subtotalcs =$subtotalcs + $result_logincs['tot'];
                        $salesexcltaxcs =$salesexcltaxcs+$result_logincs['totexcl'];
                        $taxexemptcs = $taxexemptcs+$result_logincs['taxexempt'];
                        $uae_subtotal_cs=$uae_subtotal_cs+$result_logincs['uae_subtotal']; 
          }}}
          
          
          $sql_loginhd  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd"); 
	  $num_loginhd   = $database->mysqlNumRows($sql_loginhd);
	  if($num_loginhd){
		  while($result_loginhd  = $database->mysqlFetchArray($sql_loginhd)) 
			{ 
				if($result_loginhd['tot'] != "")	{
			$subtotalhd =$subtotalhd + $result_loginhd['tot'];
                        $salesexcltaxhd =$salesexcltaxhd+$result_loginhd['totexcl'];
                        $taxexempthd = $taxexempthd+$result_loginhd['taxexempt'];
                        $uae_subtotal_hd=$uae_subtotal_hd+$result_loginhd['uae_subtotal']; 
			} } }
                         
                        
          $sql_logintacshd  =  $database->mysqlQuery("select sum(tab_netamt) as tot,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd"); 
	  $num_logintacshd   = $database->mysqlNumRows($sql_logintacshd);
	  if($num_logintacshd){
		  while($result_logintacshd  = $database->mysqlFetchArray($sql_logintacshd)) 
			{ 
                            if($result_logintacshd['tot'] != "")	{
                            
                            $roundoftacshd=$roundoftacshd+ $result_logintacshd['totroundof'];
          }}}
          
          
          
          $totroundofff=$roundoftacshd+$roundof;
         
          $rf1="";
          $ta_tax_value=array();
          $sql_logintax_ta  =  $database->mysqlQuery("select tbm.tab_mode,tketm.tbe_taxid,sum(tketm.tbe_total_value) AS sum_tax,tketm.tbe_label  FROM tbl_takeaway_bill_extra_tax_master tketm
                                left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tketm.tbe_billno where  $stringstat  $stringtax group by tbm.tab_mode,tketm.tbe_taxid"); 
        
          
        
          
	  $num_logintax_ta   = $database->mysqlNumRows($sql_logintax_ta);
	  if($num_logintax_ta){
		  while($result_logintax_ta  = $database->mysqlFetchArray($sql_logintax_ta)) 
			{ 
                           
                           if($result_logintax_ta['tab_mode']=='TA'){
                               $ta_tax_value['TA']['value'][]=$result_logintax_ta['sum_tax'];
                               $ta_tax_value['TA']['label'][]=$result_logintax_ta['tbe_label'];
                               
                           }
                           else if($result_logintax_ta['tab_mode']=='CS'){
                              $ta_tax_value['CS']['value'][]=$result_logintax_ta['sum_tax'];
                              $ta_tax_value['CS']['label'][]=$result_logintax_ta['tbe_label'];
                           }
                           else if($result_logintax_ta['tab_mode']=='HD'){
                             $ta_tax_value['HD']['value'][]=$result_logintax_ta['sum_tax'];
                             $ta_tax_value['HD']['label'][]=$result_logintax_ta['tbe_label'];
                           }
                            
                        }
                        //print_r($ta_tax_value);
                           }
            ?>        
                <table class="table table-bordered table-font user_shadow" >
   		<thead>
                <tr>
                 <th colspan="2">Sales Summary Report- <?=$reporthead?></td>
                </tr>
		<tr>
                  <th >Type</th>
                 <th >Value</th>
                  </tr>
		</thead>
		<tbody>
                <tr><td><b>SALES SUMMARY</b></td></tr>
									
                <?php

 
          if($subtotal!=0)
          {
          ?>
          <tr >
          <td>Dine in</td>
          <td><?=number_format($subtotal,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php  
          }
  
          
          if($subtotalta!=0)
          {
              ?>
          <tr >
          <td>Take Away</td>
          <td><?=number_format($subtotalta,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            
        <?php }
            
        
          if($subtotalcs!=0)
          {
          
          ?>
          <tr>
          <td>Counter Sale</td>
          <td><?=number_format($subtotalcs,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            
          <?php 
          
          }  
            
           
            if($subtotalhd!=0)
            {
            ?>
          <tr >
          <td>Home Delivery</td>
          <td><?=number_format($subtotalhd,$_SESSION['be_decimal'])?></td>
         
            </tr> 
          

			
		<?php
            }
		$total=$subtotal + $subtotalta+$subtotalcs+$subtotalhd;
                
			
            ?>
            <tr>
                <td><strong>Total Summary</strong></td>
                <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
                </tr>
                              
                <tr>
                    <td>&nbsp;</td>
                <td></td>
                </tr>              

 
                
         <tr><td><b>TAX SUMMARY</b></td></tr>
		
         

        <?php if($salesexcltaxdi!=0)
        {
           if($_SESSION['uae_tax_enable']=='Y'){ ?>  
              <tr>
            <td>Dine-In Sales Excl. Tax</td>
            <td><?=number_format($uae_subtotal,$_SESSION['be_decimal'])?></td>
            </tr>     
                    
           <?php   }else{      ?>
            <tr>
            <td>Dine-In Sales Excl. Tax</td>
            <td><?=number_format($salesexcltaxdi,$_SESSION['be_decimal'])?></td>
            </tr>
          
            <?php
            }
          }
        
        
        
            if($taxexemptdi!=0)
            {
                
            ?>
            <tr>
            <td>Tax Exempted Amount-DI  </td>
            <td><?=number_format($taxexemptdi,$_SESSION['be_decimal'])?></td>
            </tr>
          
            <?php
            
            }
            
            
            
            $roundof1="";
            
            $roundof12="";
            $tax_value=array();
            $ta_tax_valueta=0;
            $ta_tax_valuecs=0;
            $ta_tax_valuehd=0;
            $sql_login5  =  $database->mysqlQuery("select tetm.bem_taxid,sum(tetm.bem_total_value) as tax_sum,tetm.bem_label  FROM tbl_tablebill_extra_tax_master tetm 
                                                   left join tbl_tablebillmaster bm on bm.bm_billno=tetm.bem_billno
                                                   where  $stringstatdi $string group by tetm.bem_taxid "); 
           
            $di_tax_sum=0;
            $num_login5   = $database->mysqlNumRows($sql_login5);
            if($num_login5){
                while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{   
			$di_tax_sum=$di_tax_sum+$result_login5['tax_sum'];	
                                   
                ?>            
               <tr>
                    <td>Dine-In  <?=$result_login5['bem_label']?></td>
                    <td><?=number_format($result_login5['tax_sum'],$_SESSION['be_decimal'])?></td>
                </tr>       
                <?php
                }
            }
            ?>
         
         
          <tr>
                <td>&nbsp;</td>
                <td></td>
                </tr>  
            
        <?php    
            if($salesexcltaxta!=0)
            {
                
            if($_SESSION['uae_tax_enable']=='Y'){ ?>  
            <tr>
            <td>Take Away Sales Excl. Tax</td>
            <td><?=number_format($uae_subtotal_ta,$_SESSION['be_decimal'])?></td>
            </tr>     
                    
           <?php   }else{      ?>
              <tr>
            <td>Take Away Sales Excl. Tax</td>
            <td><?=number_format($salesexcltaxta,$_SESSION['be_decimal'])?></td>
            </tr>
         
          <?php
            }
            }
            
            
            
            if($taxexemptta!=0)
            {
                ?>
            <tr>
            <td>Tax Exempted Amount-TA  </td>
            <td><?=number_format($taxexemptta,$_SESSION['be_decimal'])?></td>
            </tr>
          
            <?php
            }
            for($s=0;$s<count($ta_tax_value['TA']['label']);$s++){
            $ta_tax_valueta=$ta_tax_valueta+$ta_tax_value['TA']['value'][$s];
              ?>
            	<tr>
                 <td>Takeaway  <?=$ta_tax_value['TA']['label'][$s]?></td>
            <td><?=number_format($ta_tax_value['TA']['value'][$s],$_SESSION['be_decimal'])?></td>
            </tr>
             <?php
            }
            ?>
            
                <tr>
                <td>&nbsp;</td>
                <td></td>
                </tr>     
         
            <?php
         if($salesexcltaxcs!=0)
         {
            if($_SESSION['uae_tax_enable']=='Y'){ ?>  
            <tr>
            <td>Counter Sales Excl. Tax</td>
            <td><?=number_format($uae_subtotal_cs,$_SESSION['be_decimal'])?></td>
            </tr>     
                    
           <?php   }else{      ?>
         
              <tr>
            <td>Counter Sales Excl. Tax</td>
            <td><?=number_format($salesexcltaxcs,$_SESSION['be_decimal'])?></td>
            </tr>
         
           <?php
           }
         }
         
         
           if($taxexemptcs!=0)
            {
                ?>
            <tr>
            <td>Tax Exempted Amount-CS  </td>
            <td><?=number_format($taxexemptcs,$_SESSION['be_decimal'])?></td>
            </tr>
          
            <?php
            
         }  
         
            for($s=0;$s<count($ta_tax_value['CS']['label']);$s++){
            $ta_tax_valuecs=$ta_tax_valuecs+$ta_tax_value['CS']['value'][$s];
              ?>
            	<tr>
                 <td>Counter Sales  <?=$ta_tax_value['CS']['label'][$s]?>  </td>
            <td><?=number_format($ta_tax_value['CS']['value'][$s],$_SESSION['be_decimal'])?></td>
            </tr>
             <?php
            }
            ?>
            
                <tr>
                <td>&nbsp;</td>
                <td></td>
                </tr>  
         
            <?php
            if($salesexcltaxhd!=0)
            {
                
            if($_SESSION['uae_tax_enable']=='Y'){ ?>  
            <tr>
            <td>Home Delivery Sales Excl. Tax</td>
            <td><?=number_format($uae_subtotal_hd,$_SESSION['be_decimal'])?></td>
            </tr>     
                    
           <?php  }else{      ?>
            <tr>
            <td>Home Delivery Sales Excl. Tax</td>
            <td><?=number_format($salesexcltaxhd,$_SESSION['be_decimal'])?></td>
            </tr>
            <?php 
            }
            }
            
            
            
            if($taxexempthd!=0)
            {
                ?>
            <tr>
            <td>Tax Exempted Amount-HD  </td>
            <td><?=number_format($taxexempthd,$_SESSION['be_decimal'])?></td>
            </tr>
          
            <?php
            
            }
 
            for($s=0;$s<count($ta_tax_value['HD']['label']);$s++){
            $ta_tax_valuehd=$ta_tax_valuehd+$ta_tax_value['HD']['value'][$s];
              ?>
            	<tr>
                 <td>Home Delivery  <?=$ta_tax_value['HD']['label'][$s]?>  </td>
            <td><?=number_format($ta_tax_value['HD']['value'][$s],$_SESSION['be_decimal'])?></td>
            </tr>
             <?php
            }
            
            

         
          if($totroundofff!=0)
            {
            ?>
            <td>Round Off  </td>
            <td><?=number_format($totroundofff,$_SESSION['be_decimal'])?></td>
            </tr>
            <?php }
          ?>
            
                <tr>
                    <td>&nbsp;</td>
                <td></td>
                </tr>  
                <tr>
                    
                    
              <?php
                    $del=0; 
 
$sql_login  =  $database->mysqlQuery("select tab_delivery_charge from tbl_takeaway_billmaster  where $stringhd and tab_complimentary!='Y' "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                        $del=	$del+$result_login['tab_delivery_charge'];
                        }
          }
          
          if($del>0){
                    ?>
                    
                     <tr>
                    <td>Home Delivery Charge</td>
                <td><?= number_format($del,$_SESSION['be_decimal'])?></td>
                </tr>  
                <tr>
                    
                <tr>
                <td>&nbsp;</td>
                <td></td>
                </tr>  
               
                    
          <?php } ?>      
                    
                    
                    
    <?php  if($_SESSION['uae_tax_enable']=='Y'){ ?>   
                     <tr>
                    <td><strong>Sales Inc.Tax</strong></td>
                <td><strong><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></strong></td>
                </tr>  
   <?php }else{ ?>  
                   <tr>  
                 <td><strong>Sales Inc.Tax</strong></td>
                <td><strong><?=number_format(str_replace(',','',$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$ta_tax_valueta+$ta_tax_valuecs+$ta_tax_valuehd+$di_tax_sum+$totroundofff+$del),$_SESSION['be_decimal'])?></strong></td>
                </tr>        
                    
   <?php } ?>      
                              
                             
                           </tbody>
                            </table>
                            
                            <?php
}
 else if(($_REQUEST['type']=="reprint_report"))
        {
        
        $string='';
        
          
       
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " DATE(tr_date) between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " DATE(tr_date) between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " DATE(tr_date)  between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
	
	else 
	{                   
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                
		
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                
		
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		
                
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" DATE(tr_date) = CURDATE() - INTERVAL 1 day";
               
		
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  DATE(tr_date) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		
               
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" DATE(tr_date) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		
                
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " DATE(tr_date) between '".$from."' and '".$to."' ";
			
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
	
        
    
        
        
        ?>
                   <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
     
      </tr>

      
    </thead>
    </table>          
                            
                            
                <table class="table table-bordered table-font user_shadow newconsl_table " >
                    <thead>
                      <tr>
                            <th colspan="5">Reprint Report - <?=$reporthead?></td>
                      </tr>
                      <tr>
                          <th width="50px">Sl No</th>
                           <th width="150px">Bill No </th>
                            <th width="150px">Amount </th>
                          <th width="150px">Date</th>
                          
                          <th width="150px">Login</th>
                          
                          
                      </tr>
                    </thead>
                         <tbody>
                   

        <?php
       
    		   $sql_login  =  $database->mysqlQuery("select tr_bill,tr_date,tr_login from tbl_reprint_details where tr_id!='' and  $string");
                   
                   
                   $num_login   = $database->mysqlNumRows($sql_login);
                 if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            $i++;
                            $bill=$result_login['tr_bill'];
                            $datetime=$result_login['tr_date'];
                            $login=$result_login['tr_login'];
               
        ?>
                
                        <tr>
                        <td><?=$i?></td>
                        <td><?=$bill?></td>
                        
                         <?php          
     $sql_login1  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster where bm_billno='$bill' limit 1");
      $num_login1   = $database->mysqlNumRows($sql_login1);
                 if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                        ?>
                        <td><?=$result_login1['bm_finaltotal']?></td>
                        <?php
                        }}
                        ?>
                        
                         <?php          
     $sql_login11  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster where tab_billno='$bill' limit 1 ");
      $num_login11   = $database->mysqlNumRows($sql_login11);
                 if($num_login11){
		  while($result_login11  = $database->mysqlFetchArray($sql_login11)) 
			{
                        ?>
                        <td><?=$result_login11['tab_netamt']?></td>
                        <?php
                        }}
                        
                        
                     if($num_login11==0 && $num_login1==0){
                         ?>
                        
                         <td>0</td> 
                        
                     <?php  } ?>
                        
                        
                        <td><?=$datetime?></td>
                        <td><?=$login?></td>
                        
                        
                     </tr>                   
                    
        <?php
        } } 
        
  } 
else if(($_REQUEST['type']=="summary_report_cr"))
        {
         ?>
       <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Sales Summary</strong></th>
      </tr>

      
    </thead>
    </table> 
                            
                            
     
     <?php
     $stringbnk_dt_di='';
        $stringbnk_dt_ta='';
        $stringcrd='';
     $stringvp='';
	$string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
        $string_credit_settle='';
	$strings=" bm_status='Closed' AND ";
        $stringstacshd=" tab_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
        $string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string3_strtacshd=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string7_str=" sum(bm_finaltotal)";
        $string7_strtacshd=" sum(tab_netamt) ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";	
		
		
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string2tacshd =$stringstacshd." pym_code='credit'  AND";
        $string3 =$strings. " pym_code='coupon'  AND";
        $string3tacshd =$stringstacshd. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";
        $string4tacshd =$stringstacshd. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string5tacshd =$stringstacshd. " pym_code='cheque' AND";
        $string6=$strings. " pym_code='credit_person' AND ";
        $string6tacshd=$stringstacshd. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
        $string7tacshd=$stringstacshd. " pym_code='complimentary' AND";
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                        $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
                            $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                        $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
                          
                          $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                         $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                         $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                          $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                          $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) "; 
                           
                           $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
		}
		
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 5  DAY  AND CURDATE( )" ;
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) "; 
                 
   $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ) ";
                
        }elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 10  DAY  AND CURDATE( )" ;
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ) ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 15  DAY  AND CURDATE( )" ;
		$st= " Last 15 days ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 20  DAY  AND CURDATE( )" ;
		$st= " Last 20 days ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ) ";
	}
        
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 25  DAY  AND CURDATE( )" ;
		$st= " Last 25 days ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 30  DAY  AND CURDATE( )" ;
		$st= " Last 30 days ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";  
           $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ) ";
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) "; 
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";
                  $stringvp.= " vp_dayclose_date between CURDATE( ) -  INTERVAL 5  DAY  ";
                   $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ) ";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate = CURDATE( ) - INTERVAL 1   DAY " ;
                $stringvp.= " vp_dayclose_date = CURDATE( ) -  INTERVAL 1  DAY " ;
		$st= " Yesterday ";
                 $stringbnk_dt_di.= " bm_dayclosedate = CURDATE() - INTERVAL 1 DAY ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                 $stringcrd.= "(bm.bm_dayclosedate = CURDATE( ) - INTERVAL 1    or  tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ) ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 1 MONTH   AND CURDATE( ) ";
		$st= " Last 1 month ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";
                 
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 3 MONTH   AND CURDATE( ) ";
		$st= " Last 3 months ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 6 MONTH   AND CURDATE( ) ";
		$st= " Last 6 months "; 
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";
		$st= " Last 1 year "; 
		
		 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 YEAR   AND CURDATE( ) ) ";
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                        $string_credit_settle.="cdp_dayclosedate between  '".$from."' and '".$to."'";
                         $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                         $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                  $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'   or  tbm.tab_dayclosedate between '".$from."' and '".$to."'  ) ";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
				<thead>
                                  <tr>
                                 <th colspan="2">Summary Report - <?=$reporthead?></td>
                                  </tr>
				<tr>
                                 <th >Type</th>
                                  <th >Value</th>
                                  </tr>
				</thead>
				<tbody>
									
                                          <?php

  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $subtotalcash=0;
  $subtotalcashta=0;
  $totalcash=0;
  $subtotalcredit=0;
    $subtotalcreditta=0;
    $totalcredit=0;
    $totalcoupon=0;
    $subtotalcoupon=0;
    $subtotalcouponta=0;
    $totalvoucher=0;
    $subtotalvoucher=0;
    $subtotalvoucherta=0;
    $totalcheque=0;
    $subtotalcheque=0;
    $subtotalchequeta=0;
    $totalcp=0;
    $subtotalcp=0;
    $subtotalcpta=0;
    $totalcomp=0;
    $subtotalcomp=0;
    $subtotalcompta=0;
    $finaltotal=0;
    $roundofdi=0;
    $roundofta=0;




  $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                         $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                         $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
         $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
          
  if($totalcash!=0)
  {    
      ?>
          <tr style="font-weight: bold">
          <td>CASH SALE</td>
          <td><?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
  }

	 $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
         if($totalcredit!=0)
         {
          
          ?>
            <tr style="font-weight: bold ">
            <td>CARD SALE</td>
            <td><?= number_format($totalcredit,$_SESSION['be_decimal'])?></td>
            </tr>
      	<?php	
        
        
        ////cardstart////
                
           
                
          $sql_logincredit  =  $database->mysqlQuery("select x.bnk,sum(x.tot) as total from ( 
                                                    select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot  FROM tbl_tablebillmaster bm
                                                    left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                                                    left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                                                    where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                                                    AND bm.bm_complimentary!='Y' AND $stringbnk_dt_di group by bnk 
                                                    union all
                                                    select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' 
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $stringbnk_dt_ta group by bnk
                                                    )x where x.bnk !=''  group by x.bnk "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{
                      
                      ?>
                      <tr>
            <td><?='* '.$result_logincredit['bnk']?></td>
            <td><?=number_format($result_logincredit['total'],$_SESSION['be_decimal'])?></td>
            </tr>
                      <?php
                      
            }}
          
                       
    //////cardend/////
        
         }
			
			
			
	$sql_logincoupon  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_logincoupon   = $database->mysqlNumRows($sql_logincoupon);

	  if($num_logincoupon){
		  while($result_logincoupon  = $database->mysqlFetchArray($sql_logincoupon)) 
			{
				
			if($result_logincoupon['tot'] != "")	{
				
				$subtotalcoupon =$subtotalcoupon + $result_logincoupon['tot'];
          }}}
          
          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);

	  if($num_logincouponta){
		  while($result_logincouponta  = $database->mysqlFetchArray($sql_logincouponta)) 
			{
				
			if($result_logincouponta['tot'] != "")	{
		$subtotalcouponta =$subtotalcouponta + $result_logincouponta['tot'];
          
                
                        }}}
          
          $totalcoupon=$subtotalcoupon+$subtotalcouponta;
          
         if($totalcoupon!=0)
         {
          ?>
          <tr >
          <td>COUPONS SALE</td>
          <td><?=number_format($totalcoupon,$_SESSION['be_decimal'])?>></td>
         
            </tr> 
            <?php
		}	
			
		$sql_loginvoucher  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
		$num_loginvoucher   = $database->mysqlNumRows($sql_loginvoucher);
                 if($num_loginvoucher){
		  while($result_loginvoucher  = $database->mysqlFetchArray($sql_loginvoucher)) 
			{ 
				if($result_loginvoucher['tot'] != "")
			{
			$subtotalvoucher =$subtotalvoucher + $result_loginvoucher['tot'];
			} }}
                  
                       
                        $sql_loginvoucherta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
			$num_loginvoucherta   = $database->mysqlNumRows($sql_loginvoucherta);
                        if($num_loginvoucherta){
                         while($result_loginvoucherta  = $database->mysqlFetchArray($sql_loginvoucherta)) 
                            { 
				if($result_loginvoucherta['tot'] != "")
                            {
			$subtotalvoucherta =$subtotalvoucherta + $result_loginvoucherta['tot'];
			} }}
                        
                        
                       $totalvoucher=$subtotalvoucher+$subtotalvoucherta;
                        
             if($totalvoucher!=0)
             {
                       
               ?>
          <tr >
          <td>VOUCHER SALE</td>
          <td><?=number_format($totalvoucher,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
		} 	
            $sql_logincheque  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincheque   = $database->mysqlNumRows($sql_logincheque);
	  if($num_logincheque){
		  while($result_logincheque  = $database->mysqlFetchArray($sql_logincheque)) 
			{ 
			if($result_logincheque['tot'] != "")
			{
			$subtotalcheque =$subtotalcheque + $result_logincheque['tot'];
			} }} 
                        
                        
               $sql_loginchequeta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	  if($num_loginchequeta){
		  while($result_loginchequeta  = $database->mysqlFetchArray($sql_loginchequeta)) 
			{ 
			if($result_loginchequeta['tot'] != "")
			{
			$subtotalchequeta =$subtotalchequeta + $result_loginchequeta['tot'];
			} }}           
                        
                  $totalcheque= $subtotalcheque+$subtotalchequeta;     
           
                  
           if($totalcheque!=0)
           {
            ?>
          <tr >
          <td>CHEQUE</td>
          <td><?=number_format($totalcheque,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
		} 	
			
				
            $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
          } }} 
          
          $totalcp=$subtotalcp+$subtotalcpta;
          if($totalcp!=0)
          {
          
          ?>
          <tr>
          <td style="font-weight: bold ">CREDITS SALE</td>
          <td><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
            
            
             ///creditstart/////////
              
	  $st="";  $string=""; $final=0;
	 
         
 	  $sql_login  =  $database->mysqlQuery("select sum(cd.cd_amount) as tot,s.ser_firstname,r.rm_roomno,l.ly_firstname,cm.ct_corporatename,c.crd_staffid,c.crd_roomid,c.crd_corporateid,c.crd_guestid from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $stringcrd group by cd.cd_masterid   order by cd.cd_dateofentry ASC"); 
	 
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
				else if($result_login['crd_roomid']!="")
				{
					$party=$result_login['rm_roomno'];
					$cat="Room";
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
				}
				
                                    
                                ?>
             <tr >
          <td><?='* '.$party?></td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php
                                
                        
                                            
                              	
					$i++;
                         }}         
                        
                            ////creditend/////
            
		}		
		
                $sql_logincomp  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  if($num_logincomp){
		  while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
			{ 
			if($result_logincomp['tot'] != "")
			{
			$subtotalcomp =$subtotalcomp + $result_logincomp['tot'];
			} }} 
                 
             $sql_logincompta  =  $database->mysqlQuery("select $string7_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  if($num_logincompta){
		  while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
			{ 
			if($result_logincompta['tot'] != "")
			{
			$subtotalcompta =$subtotalcompta + $result_logincompta['tot'];
			} }}      
                 $totalcomp= $subtotalcomp+$subtotalcompta;      
                        
                 if($totalcomp!=0)
                 {
                 ?>
          <tr >
          <td>COMPLIMENTARY SALE</td>
          <td><?=number_format($totalcomp,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
		}	
                $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
                       ?>
            <tr  style="display: none ">
                <td>Total Pax</td>
                <td><?=$qtycount?></td>
                </tr> 
                  <?php  }} 
                  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
                  
                  
                  ///taxcalc///////
                     
               //$stringbnk_dt_di_tax= "  bm.bm_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
          
         // $stringbnk_dt_ta_tax= "   tb.tab_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";                   
                                
                                
                                
           $tax_di_all=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND $stringbnk_dt_di   "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$tax_di_all=$tax_di_all + $result_stw['tax_di'];
			}
	  }
          
          
          
          $tax_ta_all=0;
		   $sql_stw1  =  $database->mysqlQuery("SELECT sum(te.tbe_total_value) as tax_ta FROM `tbl_takeaway_bill_extra_tax_master` te left join tbl_takeaway_billmaster tb on te.tbe_billno=tb.tab_billno WHERE tb.tab_status='Closed' AND tb.tab_complimentary!='Y' AND $stringbnk_dt_ta  "); 
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
				$tax_ta_all=$tax_ta_all + $result_stw1['tax_ta'];
			}
	  }
          
          
         $tax_name_val=0; 
          $sql_stw11  =  $database->mysqlQuery("SELECT sum(amc_value) as tax_val FROM `tbl_extra_tax_master`  WHERE amc_active='Y'   "); 
	  $num_stw11   = $database->mysqlNumRows($sql_stw11);
	  if($num_stw11){
		  while($result_stw11  = $database->mysqlFetchArray($sql_stw11)) 
			{
				$tax_name_val=$tax_name_val + $result_stw11['tax_val'];
			}
	  }
          
          
          
          $all_tax_show=$tax_ta_all+$tax_di_all;      
                                 
                      $finaltotal_excl=$finaltotal-$all_tax_show;
                      ?>
                            <tr class="main">
    <td ><strong>TOTAL (exclusive Tax)</strong></td>
    <td ><strong><?=number_format(str_replace(',','',$finaltotal_excl),$_SESSION['be_decimal'])?></strong></td>
  </tr>    
   
          
	 			 
              
                         <tr class="main">
    <td ><strong>Tax Amount</strong></td>
    <td ><strong><?=number_format(str_replace(',','',$all_tax_show),$_SESSION['be_decimal'])?></strong></td>
  </tr>
                  
                  
                           
    <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL (inclusive Tax)</strong></td>
    <td ><strong><?=number_format(str_replace(',','',$finaltotal),$_SESSION['be_decimal'])?></strong></td>
  </tr>
  <?php 
        $creditcash_settle=0;
        $creditcard_settle=0;
	$sql_creditsettlemt  =  $database->mysqlQuery("select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
                                                        where $string_credit_settle "); 

	$num_creditsettlemt   = $database->mysqlNumRows($sql_creditsettlemt);
	  if($num_creditsettlemt){
              ?>
                    <tr>
                        <td colspan="2" ><strong>Credit Settlement Income</strong></td>
                    </tr>
                <?php
		  while($result_creditsettlemt  = $database->mysqlFetchArray($sql_creditsettlemt)) 
			{
				$creditcash_settle=$result_creditsettlemt['settled_cash'];
                                $creditcard_settle=$result_creditsettlemt['settled_card'];
                        }}
                if($creditcash_settle>0){
                    
                    ?>
                <tr>
                    <td>Cash Settle</td>
                    <td><?=number_format(str_replace(',','',$creditcash_settle),$_SESSION['be_decimal'])?></td>
                </tr> 
                <?php 
                    }
                    if($creditcard_settle>0){
                ?>
                <tr>
                    <td>Card Settle</td>
                    <td><?=number_format(str_replace(',','',$creditcard_settle),$_SESSION['be_decimal'])?></td>
                </tr> 
                <?php 
                    }
                ?>
  
  
  <tr class="main">
    <td ><strong>SETTLEMENT TOTAL</strong></td>
    <td ><strong><?=number_format(str_replace(',','',($creditcard_settle+$creditcash_settle)),$_SESSION['be_decimal'])?></strong></td>
  </tr>
            
                                    
                                    
         <?php
  $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where vp_status='Approved' and $stringvp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $voucher_expense=  $result_login_loy12['expense'];
                    
                      
          }
          }   
            
                
            
            if($voucher_expense>0){
                ?>
  <tr>
                        <td colspan="2" ><strong>Petty Cash Expense </strong></td>
                    </tr>
  <tr class="main"></tr>
                <tr class="main">
    <td ><strong> Total Expense</strong></td>
    <td ><strong><?=number_format(str_replace(',','',($voucher_expense)),$_SESSION['be_decimal'])?></strong></td>
  </tr>
  <?php
              
      }
  ?>
                             
                             
                           </tbody>
                            </table>
                            

                        </div>
                       </div>
                      </div>
                     </div>
                    </div>
                   </body>
                  </html>

    <?php
    }
     else if($_REQUEST['type']=="daily_sales_statement_cr")
        {       
     ?>
        <table class="table table-bordered table-font user_shadow newconsl_table" >
        <thead>
         <tr>
        <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
         <img width="80px" src="img/report-logo/reportlogo.png" />
        <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Daily Sales Statement</strong></th>
      </tr>

      
    </thead>
    </table> 
                            
                            
     
     <?php

     //$from="";
        //$to="";
	$date="";
        $string="";
        $stringvoucher="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringstacshd=" tab_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
        $string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string3_strtacshd=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string7_str=" sum(bm_finaltotal)";
        $string7_strtacshd=" sum(tab_netamt) ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";	
		
		
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string2tacshd =$stringstacshd." pym_code='credit'  AND";
        $string3 =$strings. " pym_code='coupon'  AND";
        $string3tacshd =$stringstacshd. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";
        $string4tacshd =$stringstacshd. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string5tacshd =$stringstacshd. " pym_code='cheque' AND";
        $string6=$strings. " pym_code='credit_person' AND ";
        $string6tacshd=$stringstacshd. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
        $string7tacshd=$stringstacshd. " pym_code='complimentary' AND";
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['date']!="")
		{
			$date=$database->convert_date($_REQUEST['date']);
			//$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate='".$date."'";
                        $stringvoucher.= "  CAST(vp_date AS DATE) ='".$date."'";

                        //$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate='".$date."'";
                         
		
                        
                }
		
       if($date!="")
       {
                ?>

            <table class="table table-bordered table-font user_shadow  " >
                    <thead>
                      <tr>
                            <th colspan="19">Daily Sales Statement on - <?=$date?></td>
                      </tr>
                      <tr>
                          <th width="70%">PARTICULARS</th>
                          <th width="15%">Debit<br>Rs.</th>
                          <th width="15%">Credit<br> Rs.</th>
                      </tr>
                    </thead>
                     <tbody>
	
	
<?php	

  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $subtotalcash=0;
  $subtotalcashta=0;
  $totalcash=0;
  $subtotalcredit=0;
    $subtotalcreditta=0;
    $totalcredit=0;
    $totalcoupon=0;
    $subtotalcoupon=0;
    $subtotalcouponta=0;
    $totalvoucher=0;
    $subtotalvoucher=0;
    $subtotalvoucherta=0;
    $totalcheque=0;
    $subtotalcheque=0;
    $subtotalchequeta=0;
    $totalcp=0;
    $subtotalcp=0;
    $subtotalcpta=0;
    $totalcomp=0;
    $subtotalcomp=0;
    $subtotalcompta=0;
    $finaltotal=0;
    $amount_total=0;


         $sql_logincashdi  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
		if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select $string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta;
          
  if($totalcash!=0)
  {    
      ?>
                         
                         <tr>
                          <td>Op.Balance</td>
                          <td></td>
                          <td></td>   
                          </tr>
          <tr>
          <td>Sales(Cash)</td>
          <td><?=number_format($totalcash,$_SESSION['be_decimal'])?></td>
          <td></td>
         
            </tr> 
            <?php 
             }

	 $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
         $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
           $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
         if($totalcredit!=0)
         {
          
          ?>
            <tr>
            <td>Credit Card</td>
            <td><?=number_format($totalcredit,$_SESSION['be_decimal'])?></td>
            <td></td>
            </tr>
      	<?php	
         }
			
			
			
	$sql_logincoupon  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincoupon   = $database->mysqlNumRows($sql_logincoupon);

	  if($num_logincoupon){
		  while($result_logincoupon  = $database->mysqlFetchArray($sql_logincoupon)) 
			{
				
			if($result_logincoupon['tot'] != "")	{
				
				$subtotalcoupon =$subtotalcoupon + $result_logincoupon['tot'];
          }}}
          
          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);

	  if($num_logincouponta){
		  while($result_logincouponta  = $database->mysqlFetchArray($sql_logincouponta)) 
			{
				
			if($result_logincouponta['tot'] != "")	{
		$subtotalcouponta =$subtotalcouponta + $result_logincouponta['tot'];
          
                
                        }}}
          
          $totalcoupon=$subtotalcoupon+$subtotalcouponta;
          
         if($totalcoupon!=0)
         {
          ?>
          <tr >
          <td>Coupons</td>
          <td><?=number_format($totalcoupon,$_SESSION['be_decimal'])?>></td>
          <td></td>
         
            </tr> 
            <?php
		}	
			
		$sql_loginvoucher  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
                $num_loginvoucher   = $database->mysqlNumRows($sql_loginvoucher);
                 if($num_loginvoucher){
		  while($result_loginvoucher  = $database->mysqlFetchArray($sql_loginvoucher)) 
			{ 
				if($result_loginvoucher['tot'] != "")
			{
			$subtotalvoucher =$subtotalvoucher + $result_loginvoucher['tot'];
			} }}
                  
                       
                        $sql_loginvoucherta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
                        $num_loginvoucherta   = $database->mysqlNumRows($sql_loginvoucherta);
                        if($num_loginvoucherta){
                         while($result_loginvoucherta  = $database->mysqlFetchArray($sql_loginvoucherta)) 
                            { 
				if($result_loginvoucherta['tot'] != "")
                            {
			$subtotalvoucherta =$subtotalvoucherta + $result_loginvoucherta['tot'];
			} }}
                        
                        
                       $totalvoucher=$subtotalvoucher+$subtotalvoucherta;
                        
             if($totalvoucher!=0)
             {
                       
               ?>
          <tr >
          <td>Voucher</td>
          <td><?=number_format($totalvoucher,$_SESSION['be_decimal'])?></td>
          <td></td>
         
            </tr> 
            <?php 
		} 	
            $sql_logincheque  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
            $num_logincheque   = $database->mysqlNumRows($sql_logincheque);
	  if($num_logincheque){
		  while($result_logincheque  = $database->mysqlFetchArray($sql_logincheque)) 
			{ 
			if($result_logincheque['tot'] != "")
			{
			$subtotalcheque =$subtotalcheque + $result_logincheque['tot'];
			} }} 
                        
                        
               $sql_loginchequeta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
               $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	  if($num_loginchequeta){
		  while($result_loginchequeta  = $database->mysqlFetchArray($sql_loginchequeta)) 
			{ 
			if($result_loginchequeta['tot'] != "")
			{
			$subtotalchequeta =$subtotalchequeta + $result_loginchequeta['tot'];
			} }}           
                        
                  $totalcheque= $subtotalcheque+$subtotalchequeta;     
           
                  
           if($totalcheque!=0)
           {
            ?>
          <tr >
          <td>Cheque</td>
          <td><?=number_format($totalcheque,$_SESSION['be_decimal'])?></td>
          <td></td>
         
            </tr> 
            <?php 
		} 	
			
				
            $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
            $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
           $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
          } }} 
          
          $totalcp=$subtotalcp+$subtotalcpta;
          if($totalcp!=0)
          {
          
          ?>
          <tr>
          <td>Credit Sale</td>
          <td><?=number_format($totalcp,$_SESSION['be_decimal'])?></td>
          <td></td>
         
            </tr> 
            <?php 
		}		
		
                $sql_logincomp  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
                $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  if($num_logincomp){
		  while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
			{ 
			if($result_logincomp['tot'] != "")
			{
			$subtotalcomp =$subtotalcomp + $result_logincomp['tot'];
			} }} 
                 
             $sql_logincompta  =  $database->mysqlQuery("select $string7_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
             $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  if($num_logincompta){
		  while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
			{ 
			if($result_logincompta['tot'] != "")
			{
			$subtotalcompta =$subtotalcompta + $result_logincompta['tot'];
			} }}      
                 $totalcomp= $subtotalcomp+$subtotalcompta;      
                        
                 if($totalcomp!=0)
                 {
                 ?>
          <tr >
          <td>Complimentary</td>
          <td><?=number_format($totalcomp,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php 
		}	
               
                  
                  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp+$totalcomp;
                  
                  ?>            
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
    <td ><strong>Expense</strong></td>
    <td></td>
    <td> </td>
  </tr>
                <?php  
                 $sql_loginvoucherexpence  =  $database->mysqlQuery("select vp_amount,vh_vouchername from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where $stringvoucher");
                   $num_loginvoucherexpence   = $database->mysqlNumRows($sql_loginvoucherexpence);
                 if($num_loginvoucherexpence){
		  while($result_loginvoucherexpence  = $database->mysqlFetchArray($sql_loginvoucherexpence)) 
			{ 
			if($result_loginvoucherexpence['vp_amount'] != "")
			{
			  $vouchername=$result_loginvoucherexpence['vh_vouchername'];                       
        $amount=$result_loginvoucherexpence['vp_amount'];
        $amount_total=$amount_total+$result_loginvoucherexpence['vp_amount'];
			           
                        
                 if($amount!=0)
                 {
                 ?>
          <tr>
          <td><?=$vouchername?></td>
          <td><?=number_format($amount,$_SESSION['be_decimal'])?></td>
          <td></td>
         
            </tr> 
            <?php     
                 } }}} $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp+$totalcomp+$amount_total;
                 ?>
          
           <tr>
               <td><strong>Total</strong></td>
               <td><strong><?=number_format($finaltotal,$_SESSION['be_decimal'])?></strong></td>
          <td></td>
         
            </tr> 
           <tr>
          <td>Clo.Balance</td>
          <td></td>
          <td></td>
         
            </tr>
             <tr>
          <td>Less.Op.Cash Balance</td>
          <td></td>
          <td></td>
         
             </tr>
            
            <tr>
                
                <td colspan='3' style="padding: 0 !important">
                    <table class="table table-bordered table-font" style="background-color: transparent">
                        
                        <tr >
                            <td width='70%'style="padding: 0"><strong>Denominations</strong></td>
                            <td width='30%'style="padding: 0"><strong>Remarks</strong></td>
                        </tr>
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>2000 x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>500x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>100x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                      
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>50x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>20x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>10x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>5x</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'>Coins</td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        
                        
                        <tr>
                            <td width='70%' style="padding: 0 !important;border: 0 !important">
                                <table style="margin-bottom: 0;border: 0;background-color: transparent" class="table table-bordered table-font  " >
                                    <tr>
                                        <td width='55%'><strong>Total</strong></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                        <td width='15%'></td>
                                    </tr>
                                </table>
                                
                            </td>
                            <td width='30%'></td>
                        </tr>
                        <tr>
                        <td>Total Cash:</td>
                         <td></td>
                        </tr>
                        <tr>
                        <td>Less Op. Cash Balance:</td>
                        <td></td>
                        </tr>
                        <tr>
                        <td>Net Cash:</td>
                        <td></td>
                        </tr>
                        
                        
                    </table>
                </td>   
                
            </tr>
            
            <tr>
                <td colspan="3"><span width='50%' style="float:left">Prepared By:</span><span width='50%' style="float:center">Checked By:</span></td>
                
            </tr>
          
      
            </tbody>
             </table>
    <?php
        }}
        
        
        
        
        
          else if(($_REQUEST['type']=="total_summary_details_cr"))
        {
         ?>  
            <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Voucher Expense</strong></th>
      </tr>

      
    </thead>
    </table>   
              
              
        <?php      
              
              $from="";
            $to="";
	$string="";
        $stringta="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringsta=" tab_status='Closed' AND tab_mode!='cs' AND  ";
        $stringscs=" tab_status='Closed' AND tab_mode='CS' AND";
        //$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
        $string1_strta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
        $string2_strta=" sum(tab_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
        $string3_strta=" sum(tab_netamt) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_chequebankamount) ";
	$string6_str=" sum(cd_amount)";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =" ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =" pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =" pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =" pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
                $string6=" pym_code='credit_person' AND ";
                $string7=" pym_code='complimentary' AND";
	
	//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day AND CURDATE( )";
                $stringta.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day AND CURDATE( )";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
        $view_mode='';
	$view_mode=$_REQUEST['modeofview'];
	if($view_mode=='detailed'){
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="11">Report - <?=$reporthead?></td>
                                  </tr>
									<tr>
                                         <th >SlNo</th>
                                         <th >Date</th>
                                         <th >Cash</th>
                                         <th >Credit/Debit</th>
                                         <th >Coupons</th>
                                         <th >Voucher</th>
                                        <th >Cheque</th>
                                         
                                        <th >Credits</th>
                                        <th >Complimentary</th>
                                    <th >Pax</th>
                                    <th >Total</th>
                                  </tr>
								  </thead>
								  <tbody>
                                                                      
        
									
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_billdate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotalta=0;
  $subtotalcs=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcashta=0;
  $totalcashcs=0;
  $totalcouponsta=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalvoucherta=0;
  $totalcheque=0;
   $totalchequeta=0;
  $totalcredits=0;
  $totalcreditsta=0;
  $totalcomplimentary=0;
  $totalcomplimentaryta=0;
  $totalpax=0;
  $totalcreditordebit=0;
  $totalcreditordebitta=0;
  $slno=0;
  $slnota=0;
  $totalta="";
  
  $totalvouchercs=0;
  $totalchequecs=0;
  //$totalcredits=0;
  $totalcreditscs=0;
  $totalcouponscs=0;
  //$totalcomplimentary=0;
  $totalcomplimentarycs=0;
  $totalpax=0;
  //$totalcreditordebit=0;
  $totalcreditordebitcs=0;
  
  $slnocs=0;
  $totalcs="";
  ?>
 
   <tr><td colspan="11" style="font-size:15px"><strong>Dine In</strong></td></tr>
  <?php

  $sql = $database->mysqlQuery("select distinct(bm_dayclosedate) from tbl_tablebillmaster where $string_pax");
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        
        $total=0;
          $slno++;
        if($result != ""){
            echo "<tr><td>".$slno."</td><td>".$result['bm_dayclosedate']."</td>";
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
        }
  
  
?>
   
  
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	{
                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot'];
                        
                        
			?>
          
              
          
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
             
            <?php }else{
              echo "<td>--</td>";
          }}else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $strings $string2 "."$dt order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  
	
	
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			?>
            
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            
      
			
		<?php	
	  }else{
              echo "<td>--</td>";
          }
		 	
			
			
			$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string3"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			
                      
				
			if($result_login2['tot'] != "")	{
				
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	
                                
				 ?>
          
              
          
          <td><?=number_format($result_login2['tot'],$_SESSION['be_decimal'])?></td>
         
           
            <?php
			}
                         else{
              echo "<td>--</td>";
          }
                         }else{
              echo "<td>--</td>";
          }
                      
			
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string4"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 
			 
				if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total= $total + $result_login3['tot'];       
                        $subtotal =$subtotal + $result_login3['tot'];
                         
			?>
         
              
          
          <td><?=number_format($result_login3['tot'],$_SESSION['be_decimal'])?></td>
         
            
            <?php }
            else{
              echo "<td>--</td>";
          }
            
                        }
            else{
              echo "<td>--</td>";
          }
			
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string5"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login4  = $database->mysqlFetchArray($sql_login); 
			
			if($result_login4['tot'] != "")
			{
			
                        $totalcheque=$totalcheque + $result_login4['tot'];
                        $total= $total + $result_login4['tot'];       
                        $subtotal =$subtotal + $result_login4['tot'];
                        
			?>
          
              
          
          <td><?=number_format($result_login4['tot'],$_SESSION['be_decimal'])?></td>
         
            
            <?php } 
            else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
			
			
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
                     
                      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			if($result_login5['tot'] != "")
			{
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                          
			?>
         
              
          
          <td><?=number_format($result_login5['tot'],$_SESSION['be_decimal'])?></td>
         
           
            <?php }
            else{
              echo "<td>--</td>";
          }
            
                        }
            else{
              echo "<td>--</td>";
          }
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    

			?>
          
          <td><?=number_format($result_login6['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax and $dt"); 
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  $result_stw  = $database->mysqlFetchArray($sql_stw); 
			
                            
                            $qtycount=$qtycount + $result_stw['ct'];
                            $totalpax = $totalpax + $result_stw['ct'];
			?>
           
                
                
                <td><?=$result_stw['ct']?></td>
                <?php
	  }
          else{
              echo "<td>--</td>";
          }
			
			
			
			 ?>
                              
                              
 
  
      
    
    
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                              
                             
                           
                            
                            <?php
  }
  }
  ?>
    
  
  <tr><td colspan="11"></td></tr>
  <tr> <td><strong>TOTAL - DI</strong></td>
  <td><strong><?=$reporthead?></strong></td>
  <td colspan=""><strong><?=number_format($totalcash,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcoupons,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalvoucher,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcheque,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcredits,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=$totalpax?></strong></td>
  
  <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td></tr>

  <tr><td colspan="11" style="font-size:15px"><strong>Take Away/Home Delivery</strong></td></tr>
  
      
      
      <?php
    $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $stringta");
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnota++;
        if($result != ""){
            echo "<tr><td>".$slnota."</td><td>".$result['tab_dayclosedate']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }
  
  
?>
   
  
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringsta $string1 $dt order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashta  = $database->mysqlFetchArray($sql_login);
			
		if($result_logincashta['tot'] != "")	{
                                    
                        $totalcashta=$totalcashta + $result_logincashta['tot'];
                        $totalta= $totalta + $result_logincashta['tot'];            
			$subtotalta =$subtotalta + $result_logincashta['tot'];
                        
                        
			?>
          
              
          
          <td><?=number_format($result_logincashta['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }}else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsta "." $string2 "."$dt  order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditta  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitta=$totalcreditordebitta + $result_logincreditta['tot'];  
			$totalta= $totalta + $result_logincreditta['tot'];       
			$subtotalta =$subtotalta + $result_logincreditta['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditta['tot'],$_SESSION['be_decimal'])?></td>
            
      
			
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string3"." $dt order by tab_dayclosedate,tab_time ASC");
        
          
	  $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);
	  if($num_logincouponta){
		  $result_logincouponta  = $database->mysqlFetchArray($sql_logincouponta); 
			 
			if($result_logincouponta['tot'] != "")
			{
			$totalta= $totalta + $result_logincouponta['tot'];
                        $totalcouponsta= $totalcouponsta + $result_logincouponta['tot'];    
                        $subtotalta =$subtotalta + $result_logincouponta['tot'];
			?>
          
          <td><?=number_format($result_logincouponta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string4"." $dt order by tab_dayclosedate,tab_time ASC");
           
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginvoucherta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginvoucherta['tot'] != "")
			{
			$totalta= $totalta + $result_loginvoucherta['tot'];
                        $totalvoucherta= $totalvoucherta + $result_loginvoucherta['tot'];    
                        $subtotalta =$subtotalta + $result_loginvoucherta['tot'];
			?>
          
          <td><?=number_format($result_loginvoucherta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string5"." $dt order by tab_dayclosedate,tab_time ASC");
 
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginchequeta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginchequeta['tot'] != "")
			{
			$totalta= $totalta + $result_loginchequeta['tot'];
                        $totalchequeta= $totalchequeta + $result_loginchequeta['tot'];    
                        $subtotalta =$subtotalta + $result_loginchequeta['tot'];
			?>
          
          <td><?=number_format($result_loginchequeta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string6"." $dt order by tab_dayclosedate,tab_time ASC");
                            
          
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersonta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincreditpersonta['tot'] != "")
			{
			$totalta= $totalta + $result_logincreditpersonta['tot'];
                        $totalcreditsta= $totalcreditsta + $result_logincreditpersonta['tot'];    
                        $subtotalta =$subtotalta + $result_logincreditpersonta['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersonta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
		 	
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincompta['tot'] != "")
			{
			//$totalta= $totalta + $result_logincompta['tot'];
                        $totalcomplimentaryta= $totalcomplimentaryta + $result_logincompta['tot'];    
                        //$subtotalta =$subtotalta + $result_logincompta['tot'];
			?>
          
          <td><?=number_format($result_logincompta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }

		
			
			 ?>
          
          <td >--</td>                    
                              
 
  
      
    
    
    <td ><strong><?=number_format($totalta,$_SESSION['be_decimal'])?></strong></td>
                             
                             
                           
                            
                            <?php
  }
  }
  
  
  
  
  
  ?>
  <tr><td colspan="11"></td></tr>
  <tr> <td><strong>TOTAL - TA/HD</strong></td>
            <td><strong><?=$reporthead?></strong></td>
  <td colspan=""><strong><?=number_format($totalcashta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcouponsta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalvoucherta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalchequeta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditsta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentaryta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong>--</strong></td>
  
  <td colspan=""><strong><?=number_format($subtotalta,$_SESSION['be_decimal'])?></strong></td></tr>
  <tr><td colspan="11" style="font-size:15px"><strong>Counter Sale</strong></td></tr>
<?php
      $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $stringta");

  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnocs++;
        if($result != ""){
            echo "<tr><td>".$slnota."</td><td>".$result['tab_dayclosedate']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }
  
  
?>
   
  
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringscs $string1 $dt order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashcs  = $database->mysqlFetchArray($sql_login);
			
		if($result_logincashcs['tot'] != "")	{
                                    
                        $totalcashcs=$totalcashcs + $result_logincashcs['tot'];
                        $totalcs= $totalcs + $result_logincashcs['tot'];            
			$subtotalcs =$subtotalcs + $result_logincashcs['tot'];
                        
                        
			?>
          
              
          
          <td><?=number_format($result_logincashcs['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }}else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringscs "." $string2 "."$dt  order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditcs  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitcs=$totalcreditordebitcs + $result_logincreditcs['tot'];  
			$totalcs= $totalcs + $result_logincreditcs['tot'];       
			$subtotalcs =$subtotalcs + $result_logincreditcs['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditcs['tot'],$_SESSION['be_decimal'])?></td>
            
      
			
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string3"." $dt order by tab_dayclosedate,tab_time ASC");
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincouponcs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincouponcs['tot'] != "")
			{
			$totalcs= $totalcs + $result_logincouponcs['tot'];
                        $totalcouponscs= $totalcouponscs + $result_logincouponcs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincouponcs['tot'];
			?>
          
          <td><?=number_format($result_logincouponcs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string4"." $dt order by tab_dayclosedate,tab_time ASC");
         
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginvouchercs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginvouchercs['tot'] != "")
			{
			$totalcs= $totalcs + $result_loginvouchercs['tot'];
                        $totalvouchercs= $totalvouchercs + $result_loginvouchercs['tot'];    
                        $subtotalcs =$subtotalcs + $result_loginvouchercs['tot'];
			?>
          
          <td><?=number_format($result_loginvouchercs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string5"." $dt order by tab_dayclosedate,tab_time ASC");
          
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginchequecs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginchequecs['tot'] != "")
			{
			$totalcs= $totalcs + $result_loginchequecs['tot'];
                        $totalchequecs= $totalchequecs + $result_loginchequecs['tot'];    
                        $subtotalcs =$subtotalcs + $result_loginchequecs['tot'];
			?>
          
          <td><?=number_format($result_loginchequecs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string6"." $dt order by tab_dayclosedate,tab_time ASC");
          
          
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersoncs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincreditpersoncs['tot'] != "")
			{
			$totalcs= $totalcs + $result_logincreditpersoncs['tot'];
                        $totalcreditscs= $totalcreditscs + $result_logincreditpersoncs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincreditpersoncs['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersoncs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }
		 	
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompcs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincompcs['tot'] != "")
			{
			//$totalcs= $totalcs + $result_logincompcs['tot'];
                        $totalcomplimentarycs= $totalcomplimentarycs + $result_logincompcs['tot'];    
                        //$subtotalta =$subtotalta + $result_logincompcs['tot'];
			?>
          
          <td><?=number_format($result_logincompcs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          }

		
			
			 ?>
          
          <td >--</td>                    
                              
 
  
      
    
    
    <td ><strong><?=number_format($totalcs,$_SESSION['be_decimal'])?></strong></td>
                             
                             
                           
                            
                            <?php
  }
  }
  
  
  
  
  
  ?>
  <tr><td colspan="11"></td></tr>
  <tr> <td><strong>TOTAL - CS</strong></td>
  <td><strong><?=$reporthead?></strong></td>
  <td colspan=""><strong><?=number_format($totalcashcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcouponscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalvouchercs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalchequecs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentarycs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong>--</strong></td>
  
  <td colspan=""><strong><?=number_format($subtotalcs,$_SESSION['be_decimal'])?></strong></td></tr>

  
 


 
  <tr><td colspan="11" style="font-size:15px"><strong>Final Totals</strong></td></tr>
  <tr> <td><strong> FINAL TOTAL</strong></td>
  <td><strong><?=$reporthead?></strong></td>
  <td colspan=""><strong><?=number_format($totalcash+$totalcashta+$totalcashcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit+$totalcreditordebitta+$totalcreditordebitcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcoupons+$totalcouponsta+$totalcouponscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalvoucher+$totalvoucherta+$totalvouchercs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcheque+$totalchequeta+$totalchequecs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcredits+$totalcreditsta+$totalcreditscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary+$totalcomplimentaryta+$totalcomplimentarycs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=$totalpax?></strong></td>
  
  <td colspan=""><strong><?=number_format($subtotal+$subtotalta+$subtotalcs,$_SESSION['be_decimal'])?></strong></td></tr>

  
  </tbody>
   </table>

      
    
  <?php
    }
    if($view_mode=='summary'){
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
            <thead>
                <tr>
                      <th colspan="11">Report - <?=$reporthead?></td>
                </tr>
		<tr>
                    <th >DATE</th>
                    <th >DI</th>
                    <th >TA</th>
                    <th >CS</th>
                    <th >HD</th>
                    <th >DATE-TOTAL<br>(*Complimentary Excluded)</th>
                <tr>
            <thead>
            <tbody>
            <?php
            $payment_consolidated=array();
            $consolidated_final=0;
            
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary!='Y' and $string  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary!='Y' and bm.tab_payment_settled='Y' and $stringta
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
                    <td ><?=$key?></td>
                    <td ><?php if(array_key_exists("DI",$val)){$each_day_final=$each_day_final+$val['DI'];$each_module_sum['DI'][]=$val['DI']; echo number_format($val['DI'],$_SESSION['be_decimal']);}else{ $each_module_sum['DI'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("TA",$val)){ $each_day_final=$each_day_final+$val['TA'];$each_module_sum['TA'][]=$val['TA']; echo number_format($val['TA'],$_SESSION['be_decimal']);}else{ $each_module_sum['TA'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("CS",$val)){$each_day_final=$each_day_final+$val['CS'];$each_module_sum['CS'][]=$val['CS'];  echo number_format($val['CS'],$_SESSION['be_decimal']);}else{$each_module_sum['CS'][]=0;  echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php if(array_key_exists("HD",$val)){ $each_day_final=$each_day_final+$val['HD'];$each_module_sum['HD'][]=$val['HD']; echo number_format($val['HD'],$_SESSION['be_decimal']);}else{ $each_module_sum['HD'][]=0; echo number_format(0,$_SESSION['be_decimal']) ;} ?></td>
                    <td ><?php $consolidated_final=$consolidated_final+$each_day_final; echo number_format($each_day_final,$_SESSION['be_decimal']);?></td>
                <tr>
            <?php
                }
            ?>    
                
                <tr>
                    <td ><strong>TOTAL</strong></td>
                    <td ><strong><?=number_format(array_sum($each_module_sum['DI']),$_SESSION['be_decimal'])?></strong></td>
                    <td ><strong><?=number_format(array_sum($each_module_sum['TA']),$_SESSION['be_decimal'])?></strong></td>
                    <td ><strong><?=number_format(array_sum($each_module_sum['CS']),$_SESSION['be_decimal'])?></strong></td>
                    <td ><strong><?=number_format(array_sum($each_module_sum['HD']),$_SESSION['be_decimal'])?></strong></td>
                    <td ><strong><?=number_format($consolidated_final,$_SESSION['be_decimal'])?></strong></td>
                <tr>
            <?php
                }
            ?>
            </tbody>
        </table>        
<?php
    }
  
}


  else if($_REQUEST['type']=="totalsales_consolidate_report_cr")
{	
      
      /////adsr/////
      
      ?>
    <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
      <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Adsr Total Sales Consolidated  Report </strong></th>
      </tr>

      
    </thead>
    </table>   
    <?php
      
        $string_combo='';
      
        $string="";
        $stringta="";
        
        
        $mode=$_REQUEST['department'];
            
	$string.=" bm.bm_status = 'Closed' and bm.bm_complimentary!='Y' ";
        
        $stringta.=" bm.tab_status = 'Closed' and bm.tab_complimentary!='Y' ";
      
        if($_REQUEST['loginstaffsel']!='' && $_REQUEST['loginstaffsel']!='null' && $mode!='HD')
        {   
            $stringta.=" and bm.tab_loginid='".$_REQUEST['loginstaffsel']."' ";
        }
    
        
        
        if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		  $string.="and bm.bm_floorid='".$floorvalue."'";
                }
	}
       
	
       if($_REQUEST['staff_hd']!='' && $_REQUEST['staff_hd']!='null' && $mode=='HD'){
           
             $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
           
             $stringta.=" and bm.tab_assignedto='".$_REQUEST['staff_hd']."' ";
         }else {
             $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
         }
        
		
           $stringtx_ta= "  ";
           $stringtx_di= "  ";  
            
            
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                    $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                    $stringtx_ta.= " and tketm.tbet_daycolse between '".$from."' and '".$to."'  ";
                     $stringtx_di.= " and betm.bet_dayclose between '".$from."' and '".$to."'  ";
                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                     $stringtx_ta.= " and tketm.tbet_daycolse between '".$from."' and '".$to."'  ";
                     $stringtx_di.= " and betm.bet_dayclose between '".$from."' and '".$to."'  ";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                     $stringtx_ta.= " and tketm.tbet_daycolse between '".$from."' and '".$to."'  ";
                      $stringtx_di.= " and betm.bet_dayclose between '".$from."' and '".$to."'  ";
                }
				
					
           
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                    
                    $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose  between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     
                      $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                     
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                    
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 1 DAY  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 1 DAY  ";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                    
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between  CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  bm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                    
                     $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                    
                    $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                    
                    $stringtx_ta.= " and tketm.tbet_daycolse between  CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                    
                    $stringtx_ta.= " and tketm.tbet_daycolse between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                }
                
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $st="Last 365 days";
                    
                    $stringtx_ta.= " and tketm.tbet_daycolse between  CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )  ";
                     $stringtx_di.= " and betm.bet_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                }
                 $reporthead=$st;
                
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                $stringtx_ta.= " and tketm.tbet_daycolse between '".$from."' and '".$to."' ";
                $stringtx_di.= " and betm.bet_dayclose between  '".$from."' and '".$to."' ";
                
                
                }
                
               
	}
        
	
if($mode=="DI"){  ?>
	
    
                                  <table class="table table-bordered table-font user_shadow">
				  <thead>
                                    
                                   <?php
                                    
                                  $tax_name=array(); $tax_new_id=array();
                                  $sql_login  =  $database->mysqlQuery("SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y' "); 
                              
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                         $tax_name[]=$result_login['amc_name'];
                                         $tax_new_id[]=$result_login['amc_id'];
                                     }} 
                                     
                                     ?>
                                   
                                  <tr>
                                  	<th colspan="<?=13+count(array_unique($tax_name))?>">Report - <?=$reporthead?></th>
                                  
                                  </tr>
                                 
                                  
                                  
                                    <tr>
                                    <th class="sortable">Sl</th>
                                     <th class="sortable">Date</th>
					<th class="sortable">Bill No</th>
                                      <th class="sortable">Table</th>
                                      <th class="sortable">Sub Total</th>
                                        <th class="sortable">Exempt</th>
                                        <th class="sortable">Non Taxable</th>
                                     <?php
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php } ?>
                                      <th class="sortable">Discount</th>
                                     <th class="sortable">Final</th>
                                       <th class="sortable">Roundoff</th>
                                     <th class="sortable">Card</th>
                                     <th class="sortable">Cash</th>
                                       <th class="sortable">Credit</th>
                                    </tr>
				</thead>
                                <tbody>
									
   <?php

  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $tax_value=array();
  $subtotal=0;
  $crd=0; $sum_non_tax2=0; $roundoff=0; $exempt=0;
  $sql_login  =  $database->mysqlQuery("select  bm_tax_exempt,bm_roundoff_value,bm_tableno,bm_billno,bm_paymode,bm_dayclosedate,bm_transactionamount,bm_discountvalue,
      bm_subtotal,bm_finaltotal,
  (bm.bm_amountpaid-bm.bm_amountbalace) as cash , (bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)) as credit from tbl_tablebillmaster bm 
  where $string order by bm.bm_billno ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$q=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $q++;
                       if($result_login['bm_paymode']!=7){
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['bm_paymode']=='6'){
                            
			$bal=$bal + $result_login['credit'];
                        
                        }
                        $crd=$crd + $result_login['bm_transactionamount'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
                        
                        
			$subtotal=$subtotal + $result_login['bm_subtotal'];
                        $exempt=$exempt + $result_login['bm_tax_exempt'];
                        
			$roundoff=$roundoff + $result_login['bm_roundoff_value']; 
	 ?>

                            <tr >
                                <td><?=$q?></td>
                                <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>
                               <td><?=$result_login['bm_tableno']?></td>
                               <td><?=  number_format($result_login['bm_subtotal'],$_SESSION['be_decimal'])?></td>
                                <td><?=  number_format($result_login['bm_tax_exempt'],$_SESSION['be_decimal'])?></td> 
                               <?php  
                                  $sum_non_tax=0;    $sum_non_tax1=0;   $menu_chk='';  
                                  
                        for($s=0;$s<count(array_unique($tax_new_id));$s++){
                           
                                $sql_taxvalue5  =  $database->mysqlQuery("select betm.bet_menuid  "
                                . "FROM tbl_tablebill_extra_tax_details betm where betm.bet_billno='".$result_login['bm_billno']."' "
                                . " and betm.bet_tax_id='".$tax_new_id[$s]."'  order by betm.bet_tax_id asc"); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                     
                                 $menu_chk.="'".$result_taxvalue5['bet_menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ;  
                                        
                         $sql_taxvalue6  =  $database->mysqlQuery("select sum(bd_amount) as tot  
                        FROM tbl_tablebilldetails betm where
                        betm.bd_billno='".$result_login['bm_billno']."' and betm.bd_menuid not in($menu_chk1)  ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                        
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                         
                                    }
                                    }   
                                          
                                }
                                    }  
                               
                       }
                      
                         $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                       
                               ?>
                              
                                
                               <?php  if($sum_non_tax==0){ ?>
                                <td><?=number_format($result_login['subtotal'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                                  <td><?=number_format($sum_non_tax,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                              
                               <?php 
                               
                                for($s=0;$s<count(array_unique($tax_new_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select betm.bem_total_value,betm.bem_taxid,betm.bem_label  FROM tbl_tablebill_extra_tax_master betm where betm.bem_billno='".$result_login['bm_billno']."' and betm.bem_taxid='".$tax_new_id[$s]."'  order by betm.bem_label asc"); 
                           
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['bem_total_value']==''){
                                        $result_taxvalue['bem_total_value']=0;
                                    }
                                    $tax_value[$result_taxvalue['bem_taxid']][]=$result_taxvalue['bem_total_value'];
      
                                 
                                ?>
                                  <td><?=number_format($result_taxvalue['bem_total_value'],$_SESSION['be_decimal'])?></td>
                                 <?php  
                                } } 
                               else { 
                                   $tax_value[$tax_new_id[$s]][]=0;?>
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } }?>
                               
                                 <td><?=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal'])?></td>
                               
                                 <td><?=  number_format($result_login['bm_roundoff_value'],$_SESSION['be_decimal'])?></td>  
                               <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['cash'],$_SESSION['be_decimal'])?></td>
                               
                               <?php if($result_login['bm_transactionamount']==0){?>
                               <td><?=number_format($result_login['credit'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                               
                               <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                               
                                <?php } ?>
                            </tr> 
                             
                       <?php }} } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <?php 
    for($i=0;$i<count(array_unique($tax_new_id));$i++){ 
        ?>
    <td></td>
    <?php } 
       for($o=1;$o<=(count(array_unique($tax_new_id))-$i);$o++){ ?>
            <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
    <?php } ?>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <td  ><strong><?=number_format($exempt,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($sum_non_tax2,$_SESSION['be_decimal'])?></strong></td>
    <?php 
    for($i=0;$i<count(array_unique($tax_new_id));$i++){ 
        ?>
    <td><strong><?=number_format(array_sum($tax_value[$tax_new_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php } 
        for($o=1;$o<=(count(array_unique($tax_new_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
     <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td  ><strong><?=number_format($roundoff,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($crd,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                              
                             
                           </tbody>
                            </table>
      <?php
        }

        
     else if($mode=="TA" || $mode=="CS" || $mode=="HD"){
        ?>
        <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <?php
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery("  SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y'  "); 
                                  $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['taxnamc_nameame'];
                                       $tax_id[]=$result_login['amc_id'];
                                     }} 
                                
                                     ?>
                          <tr>
                                  	<th colspan="<?=13+count(array_unique($tax_id))?>">Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                    <?php if($mode=='HD'){ ?>
                                    <th class="sortable">Delivered By</th>
                                    <?php } else{ ?>
                                     <th class="sortable">Taken By</th>
                                    <?php }  ?>
                                    <th class="sortable">Sub Total</th>
                                     <th class="sortable">Exempt</th>
                                      <th class="sortable">Non Taxable</th>
                                    <?php
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php } ?>
                                    <th class="sortable">Discount</th>
                                     <th class="sortable">Roundoff</th>
                                    <th class="sortable">Final</th>
                                    <th class="sortable">Card</th>
                                    <th class="sortable">Cash</th>
                                     <th class="sortable">Credit</th>
				</tr>
			</thead>
		<tbody>
									
                                          <?php

 $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array(); $crd=0; $sum_non_tax2=0;
  $sql_login  =  $database->mysqlQuery("select tab_roundoff_value,tab_tax_exempt,ser_firstname,tab_loginid,tab_billno,tab_dayclosedate,tab_transactionamount,tab_paymode,tab_netamt,
  tab_discountvalue,tab_subtotal,(bm.tab_amountpaid-bm.tab_amountbalace) as cash , (bm.tab_netamt-(bm.tab_amountpaid-bm.tab_amountbalace)) as credit from tbl_takeaway_billmaster bm $hdstring  where $stringta and tab_mode='$mode' order by bm.tab_billno ASC ");
                              
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $subtotal=$subtotal + $result_login['tab_subtotal'];
                        $dsc=$dsc + $result_login['tab_discountvalue'];
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['tab_paymode']=='6'){
                            
			$bal=$bal + $result_login['credit'];
                        
                        }
                        $crd=$crd + $result_login['tab_transactionamount'];
                        
                        $exempt=$exempt + $result_login['tab_tax_exempt'];
                        
			$roundoff=$roundoff + $result_login['tab_roundoff_value'];      
	 ?>

    			<tr >
                               <td><?=$i?></td>
                               <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
                                  <?php if($mode!='HD'){ ?>
                               <td><?=$result_login['tab_loginid']?></td>
                                  <?php } else{ ?>
                               <td><?=$result_login['ser_firstname']?></td>
                                  <?php } ?>
                               
                               <td><?=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['tab_tax_exempt'],$_SESSION['be_decimal'])?></td>
                               
                                <?php  
                                
                         $sum_non_tax=0;    $sum_non_tax1=0; $menu_chk='';
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                           
                        $sql_taxvalue5  =  $database->mysqlQuery("select betm.tbet_menuid  "
                                . "FROM tbl_takeaway_bill_extra_tax_details betm where betm.tbet_billno='".$result_login['tab_billno']."' "
                                . " and betm.tbet_tax_id='".$tax_id[$s]."'  order by betm.tbet_tax_id asc"); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                     $menu_chk.="'".$result_taxvalue5['tbet_menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ; 
                                
                                        
                         $sql_taxvalue6  =  $database->mysqlQuery("select sum(tab_amount) as tot  
                        FROM tbl_takeaway_billdetails betm where
                        betm.tab_billno='".$result_login['tab_billno']."' and betm.tab_menuid not in ($menu_chk1)  ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                        
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                         
                                    }
                                    }   
                                          
                                }
                                    }  
                               
                          }
                      
                         $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                       
                               ?>
                               
                               
                                <?php  if($sum_non_tax==0){ ?>
                                <td><?=number_format($result_login['subtotal'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                                  <td><?=number_format($sum_non_tax,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                               
                                <?php 
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                              //echo "select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"; 
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['tbe_total_value']==''){
                                        $result_taxvalue['tbe_total_value']=0;
                                    }
                                    $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];
                                    
                                 
                                ?>
                            <td><?=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal'])?></td>
                            <?php  
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;?>
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } }?>
                                
                                
                               <td><?=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal'])?></td>
                                 <td><?=number_format($result_login['tab_roundoff_value'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['tab_transactionamount'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['cash'],$_SESSION['be_decimal'])?></td>
                               
                               <?php if($result_login['tab_transactionamount']==0){?>
                               <td><?=number_format($result_login['credit'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                               
                               <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                               
                                <?php } ?>
                        </tr> 
                             
                              
                   
                              
                              
                              <?php } }
                              
                              ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ 
        ?>
    <td></td>
    <?php } 
    ?>
    <td >&nbsp;</td> 
    <td >&nbsp;</td>
    
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   
    <td ></td>
    <td ></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($exempt,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($sum_non_tax2,$_SESSION['be_decimal'])?></strong></td>
     <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ 
        //print_r($tax_value);
        
        ?>
    <td><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
     }
     
   for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
   
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($roundoff,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($crd,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
    
  </tr>
                              
                             
       </tbody>
       </table>

  <?php

  }else{
      
      
  if($_REQUEST['modeofview']=='summary'){
                
   //adsr main/// 
                 
   ?>

                        <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <?php
                            $mn_ct=12;
                            $tax_name=array();
                            $tax_id=array();
                            $tx_num=0;
                             
                                  $sql_login  =  $database->mysqlQuery("SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y' "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                         $tax_name[]=$result_login['amc_name'];
                                         $tax_id[]=$result_login['amc_id'];
                                         $tx_num++;
                                     }} 
                                    
                            if($_REQUEST['non_tax']=='true'){
                                
                               $mn_ct=$mn_ct+1; 
                            }
                            
                             if($_REQUEST['tax_adsr']=='true'){
                                
                               $mn_ct=$mn_ct+$tx_num; 
                            }else{
                                 $mn_ct=$mn_ct+1; 
                            }
                                     
                                     
                           ?>
                                <tr>
                                  	<th colspan="<?=$mn_ct?>">Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Time</th>
                                    <th class="sortable">Bill No</th>
                                     
                                    <th class="sortable">Sub Total</th>
                                      <th class="sortable">Exempt</th>
                                    
                                      <?php   if($_REQUEST['non_tax']=='true'){ ?>
                                     <th class="sortable">Non Taxable</th>
                                   <?php } ?>
                                     
                                    <?php
                                     if($_REQUEST['tax_adsr']=='true'){
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php } } else{?>
                                        <th class="sortable">Tax</th>
                                       <?php } ?>  
                                    <th class="sortable">Discount</th>
                                     <th class="sortable">Roundoff</th>
                                    <th class="sortable">Final</th>
                                    <th class="sortable">Card</th>
                                    <th class="sortable">Cash</th>
                                    <th class="sortable">Credit</th>
				</tr>
			</thead>
		<tbody>
									
                                          <?php

  $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array(); $crd=0;  $sum_non_tax2=0; $tax_new=0; $tot_exempt=0; $tot_roff=0;
  $sql_login  =  $database->mysqlQuery("select tm,paymode,card,cash,credit,billno, taxamt,uae_subtotal,exempt,rounoff,
         subtotal,discount,final ,paid, balance,dayclosedate from 
        (select bm_roundoff_value as rounoff,bm_tax_exempt as exempt,bm_paymode as paymode,bm_billtime as tm,bm_transactionamount as card,(bm_amountpaid-bm_amountbalace) as cash ,
        (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,bm_billno as billno, 
         bm_subtotal as  subtotal,  bm_discountvalue as discount,bm_finaltotal as final, (bm_total - bm_subtotal_final ) as taxamt ,
        bm_amountpaid as paid,   bm_amountbalace as balance ,bm.bm_dayclosedate as dayclosedate,bm_taxable_amount as uae_subtotal
        from tbl_tablebillmaster bm  
        where  $string  
        union all
        select tab_roundoff_value as rounoff,tab_tax_exempt as exempt,tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,(tab_amountpaid-tab_amountbalace) as cash , 
        (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,  tab_billno as billno, 
         tab_subtotal as subtotal,tab_discountvalue as discount,tab_netamt as final,  (tab_total - tab_subtotal_final) as taxamt ,
         tab_amountpaid as paid,   tab_amountbalace as  balance,bm.tab_dayclosedate as dayclosedate ,tab_taxable_amount as uae_subtotal
        from tbl_takeaway_billmaster
        bm where  $stringta  )s
       group by billno,dayclosedate order by dayclosedate ,tm ASC ");
                               
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                         $i++;
                          $tax_new=$tax_new + $result_login['taxamt'];
                      
                      
                       if($_SESSION['uae_tax_enable']=='Y'){ 
                $subtotal=$subtotal + $result_login['uae_subtotal'];   
            }else{
            $subtotal=$subtotal + $result_login['subtotal'];
            }
                        
                        $dsc=$dsc + $result_login['discount'];
			$final=$final + $result_login['final'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['paymode']=='6'){
			$bal=$bal + $result_login['credit'];
                        }
                        
                        $crd=$crd + $result_login['card'];
                        
                        $tot_exempt=$tot_exempt+$result_login['exempt'];   
                        $tot_roff=$tot_roff+$result_login['rounoff'];   
                        
	 ?>

    			<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['dayclosedate'])?></td>
                                <td><?=$result_login['tm']?></td>
                               <td><?=$result_login['billno']?></td>
                              
                               
          <?php if($_SESSION['uae_tax_enable']=='Y'){ ?>
           <td><?=number_format($result_login['uae_subtotal'],$_SESSION['be_decimal'])?></td>     
          <?php  }else{ ?>
           <td><?=number_format($result_login['subtotal'],$_SESSION['be_decimal'])?></td>
           <?php } ?>
                               
              <td><?=number_format($result_login['exempt'],$_SESSION['be_decimal'])?></td>                 
                              
                               
                               
                       <?php  
                               
                       if($_REQUEST['non_tax']=='true'){  
                               
                       $sum_non_tax=0;    $sum_non_tax1=0;    $menu_chk='';
                       for($s=0;$s<count(array_unique($tax_id));$s++){
                           
                               
                        $sql_taxvalue5  =  $database->mysqlQuery("select menuid from
                        (select betm.bet_menuid as menuid
                        FROM tbl_tablebill_extra_tax_details betm where
                        betm.bet_billno='".$result_login['billno']."' and betm.bet_tax_id='".$tax_id[$s]."'           
                        union all
                        select tketm.tbet_menuid as menuid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_billno='".$result_login['billno']."' and tketm.tbet_tax_id ='".$tax_id[$s]."')s "); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                         $menu_chk.="'".$result_taxvalue5['menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ; 
                                    
                                 }
                                    }  
                               
                       }    
                                    
                                    
                         $sql_taxvalue6  =  $database->mysqlQuery("select tot from 
                        (select sum(bd_amount) as tot  
                        FROM tbl_tablebilldetails betm where
                        betm.bd_billno='".$result_login['billno']."' and betm.bd_menuid not in($menu_chk1)         
                        union all
                        select sum(tab_amount) as tot 
                        FROM tbl_takeaway_billdetails tketm  
                        where  tketm.tab_billno='".$result_login['billno']."' and tketm.tab_menuid not in ($menu_chk1) )s ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                        
                                         if($result_taxvalue6['tot']>0 && $result_taxvalue6['tot']!=''){
                                            
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                          
                                        }
                                         
                                    }
                                    }   
                                          
                               
                      
                                  $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                       
                               ?>
                              
                                
                               <?php  if($sum_non_tax==0){ ?>
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                                  <td><?=number_format($sum_non_tax,$_SESSION['be_decimal'])?></td>
                                <?php } 
                                
                           }
                                
                               
                            if($_REQUEST['tax_adsr']=='true'){
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,taxid,label from
                        (select betm.bem_total_value as taxtotal,betm.bem_taxid as taxid,betm.bem_label as label 
                        FROM tbl_tablebill_extra_tax_master betm where
                        betm.bem_billno='".$result_login['billno']."' and betm.bem_taxid='".$tax_id[$s]."'           
                        union all
                        select tketm.tbe_total_value  as taxtotal,tketm.tbe_taxid as taxid, tketm.tbe_label as label
                        FROM tbl_takeaway_bill_extra_tax_master tketm  
                        where  tketm.tbe_billno='".$result_login['billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."')s  
                        order by s.label asc"); 
                              
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['taxtotal']==''){
                                        $result_taxvalue['taxtotal']=0;
                                    }
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['taxtotal'];
                                    
                                 
                                ?>
                            <td><?=number_format($result_taxvalue['taxtotal'],$_SESSION['be_decimal'])?></td>
                            <?php  
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;
                                   ?>
                            
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                            <?php } } }else{ ?>
                                
                                 <td><?=number_format($result_login['taxamt'],$_SESSION['be_decimal'])?></td>
                                 
                               <?php } ?>  
                                
                                
                               <td><?=number_format($result_login['discount'],$_SESSION['be_decimal'])?></td>
                                 <td><?=number_format($result_login['rounoff'],$_SESSION['be_decimal'])?></td>      
                              <td><?=number_format($result_login['final'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['card'],$_SESSION['be_decimal'])?></td>
                              
                              <td><?=number_format($result_login['cash'],$_SESSION['be_decimal'])?></td>
                              
                               
                                
                                <?php if($result_login['card']==0){?>
                               <td><?=number_format($result_login['credit'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>
                               
                               <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                               
                                <?php } ?>
                               </tr> 
                             
                         <?php } } ?>
                              
                            
                              
                              
 <tr>
    
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
   <?php
     if($_REQUEST['non_tax']=='true'){ ?>
    <td ></td>
    
    <?php 
     }
     
     if($_REQUEST['tax_adsr']=='true'){
    for($i=0;$i<count(array_unique($tax_id));$i++){ ?>
      <td></td>
      <?php  
      }
     
    for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
    
     <td></td>
     <?php } }else{ ?>
     <td ></td>
     <?php } ?>
    
     <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
     <td >&nbsp;</td>
     <td ></td>
    <td ></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($tot_exempt,$_SESSION['be_decimal'])?></strong></td>
     <?php
     if($_REQUEST['non_tax']=='true'){ ?>
     <td style="font-size: 10px;font-weight: bold"><strong><?=number_format($sum_non_tax2,$_SESSION['be_decimal'])?></strong></td>
     
     <?php 
     }
    
     
     if($_REQUEST['tax_adsr']=='true'){ 
         
    for($i=0;$i<count(array_unique($tax_id));$i++){ ?>
    <td style="font-size: 10px;font-weight: bold"><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
     }
     
     for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
     <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
     <?php } }else{ ?>
    <td ><strong><?=number_format($tax_new,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
    
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($tot_roff,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($crd,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
    
  </tr>
                              
                             
                           </tbody>
                            </table>




<?php
 }else if($_REQUEST['modeofview']=='detailed'){
                           
                       ?>
 <table class="table table-bordered table-font user_shadow" >
			<thead>
                            
                          <tr>
                              
                              <?php
                            $bm_name=array();
                            $bm_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select bm_id,bm_name from tbl_bankmaster order by bm_id asc   "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $bm_name[]=$result_login['bm_name'];
                                       $bm_id[]=$result_login['bm_id'];
                                     }} 
                                    
                                     ?>
                                 <th colspan="<?=5+count(array_unique($bm_id))?>">Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                   
                                    <th class="sortable">Date</th>
                                   
                                    <th class="sortable">Card</th>
                                  <?php
                                     for($i=0;$i<count(array_unique($bm_name));$i++){
                                        ?>
                                        <th class="sortable">* <?=$bm_name[$i]?></th>
                                     <?php } ?>
                                    
                                    <th class="sortable">Cash</th>
                                    <th class="sortable">Credit</th>
                                    <th class="sortable">Final</th>
                                      
				</tr>
			</thead>
		<tbody>
									
                                          <?php

  $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array();$crd=0;
  $sql_login  =  $database->mysqlQuery(" select sum(s.card) as card1,sum(s.cash) as cash1,sum(s.credit) as credit1, sum(s.final) as final1,s.dayclose from 
        (select sum(bm_transactionamount) as card, sum((bm_amountpaid-bm_amountbalace)) as cash , 
        sum((bm_finaltotal-(bm_amountpaid-bm_amountbalace))) as credit ,bm_dayclosedate as dayclose, 
        sum(bm_finaltotal) as final from tbl_tablebillmaster bm where $string
        group by bm_dayclosedate union all select sum(tab_transactionamount) as card , 
        sum((tab_amountpaid-tab_amountbalace)) as cash , sum((tab_netamt-(tab_amountpaid-tab_amountbalace))) as credit ,
        tab_dayclosedate as dayclose , sum(tab_netamt) as final from tbl_takeaway_billmaster bm where $stringta group by tab_dayclosedate )s group by s.dayclose
 ");
   

  
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                      
			$final=$final + $result_login['final1'];
			$paid=$paid +$result_login['cash1'];
                        
                        
			$bal=$bal + $result_login['credit1'];
                        
                        
                        $crd=$crd + $result_login['card1'];
                        
	 ?>

    			<tr >
                          
                             <td><?=$result_login['dayclose']?></td>
                              
                              <td><?=number_format($result_login['card1'],$_SESSION['be_decimal'])?></td>
                            
                             
                              
                                <?php 
                              
                                for($sw=0;$sw<count(array_unique($bm_id));$sw++){
                                    
//                                $sql_taxvalue  =  $database->mysqlQuery("select  x.bid,x.bnk,sum(x.tot) as tot1,x.day from ( 
//                                                    select   bm.bm_transcbank as bid, bm.bm_dayclosedate as day,b.bm_name as bnk,sum(bm.bm_transactionamount) as tot  
//                                                    FROM tbl_tablebillmaster bm left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id 
//                                                    left join tbl_bankmaster b on  b.bm_id = bm.bm_transcbank  where  tbl_paymentmode.pym_code='credit'
//                                                    and  bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND bm.bm_transcbank='".$bm_id[$sw]."' and 
//                                                    bm.bm_dayclosedate ='".$result_login['dayclose']."'  group by bm.bm_dayclosedate  union all
//                                                    select bm.tab_transcbank as bid,   bm.tab_dayclosedate as day,b.bm_name as bnk, sum(bm.tab_transactionamount)
//                                                    as tot  FROM tbl_takeaway_billmaster bm left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
//                                                    left join tbl_bankmaster b  on  b.bm_id = bm.tab_transcbank where tbl_paymentmode.pym_code='credit' 
//                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND bm.tab_transcbank='".$bm_id[$sw]."'
//                                                    and bm.tab_dayclosedate ='".$result_login['dayclose']."' group by bm.tab_dayclosedate
//                                                    )x  group by x.day"); 
//                              
//                             
                             
                                $sql_taxvalue  =  $database->mysqlQuery("select x.bid,x.bnk,sum(x.tot) as tot1,x.day from ( 
                                                    select  bc.mc_to_bank as bid, bm.bm_dayclosedate as day,b.bm_name as bnk,sum(bc.mc_cardamount) as tot  FROM tbl_tablebillmaster bm
                                                    left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                                                    left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                                                    where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' and bm.bm_dayclosedate ='".$result_login['dayclose']."'
                                                    AND bm.bm_complimentary!='Y' AND  bc.mc_to_bank ='".$bm_id[$sw]."' group by bm.bm_dayclosedate,bc.mc_to_bank
                                                    union all
                                                    select bc.mc_to_bank as bid, bm.tab_dayclosedate as day,b.bm_name as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit'  and bm.tab_dayclosedate ='".$result_login['dayclose']."'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND  bc.mc_to_bank='".$bm_id[$sw]."' group by bm.tab_dayclosedate,bc.mc_to_bank
                                                    )x where x.bnk !=''  group by x.day,x.bid "); 
                                
                                
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { 
                                    $tax_value[$result_taxvalue['bid']][]=$result_taxvalue['tot1'];
                                    
                                    if($result_taxvalue['tot1']>0){
                                ?>
                            <td><?=number_format($result_taxvalue['tot1'],$_SESSION['be_decimal'])?></td>
                                    <?php } 
                                } } 
                               else {  ?>
                                   
                                   <td>0</td> 
                                   
                               <?php    $tax_value[$bm_id[$sw]][]=0;?>
                                
                                <?php } } ?>
                              
                              
                              
                              
                              
                              
                              <td><?=number_format($result_login['cash1'],$_SESSION['be_decimal'])?></td>
                              
                            
                               <td><?=number_format($result_login['credit1']-$result_login['card1'],$_SESSION['be_decimal'])?></td>
                           
                                
                                
                                 <td><?=$result_login['final1']?></td>
                        </tr> 
                             
                              
                              <?php } }
          
                              ?>
                              
                              
    
   </tbody>
   <tfoot style="width: 99%;">
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
  
    <td ><strong><?=number_format($crd,$_SESSION['be_decimal'])?></strong></td>
    <?php 
    for($i=0;$i<count(array_unique($bm_id));$i++){ 
        //print_r($tax_value);
        
        ?>
    <td><strong><?=number_format(array_sum($tax_value[$bm_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
     }?>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    
    <td ><strong><?=number_format($bal-$crd,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                              
     </tfoot>                        
                          
                            </table>




<?php
  }else{
      
     if($_REQUEST['hsn_code']=='false'){  ?>
    
    
                        <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <?php
                            $tax_name=array();
                            $tax_id=array(); 
                                $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y'  and amc_item_tax='Y'  "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['amc_name'];
                                       $tax_id[]=$result_login['amc_id'];
                                       $itemtx=0;
                                     }}else{
                                         $itemtx=1;
                                     } 
                                     
                                     if($itemtx==0){
                                  
                                     ?>
                          <tr>
                                  	<th colspan="<?=5+$itemtx+count(array_unique($tax_id))?>">Report - <?=$reporthead?></th>
                                   </tr>
				<tr>
                                    <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                     <th class="sortable">Item</th>
                                    <th class="sortable">Sub Total</th>
                                    <?php
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php }
                                     
                                     
                                     if($itemtx==1){ ?>
                                          <th class="sortable">Item Tax</th>
                                         <?php
                                     }
                                     ?>
                                        
                                        
                                        
                <th class="sortable">Final</th>
                </tr>
		</thead>
		<tbody>
                    
  <?php
  $final=0;
  $subtotal=0;
  $tax_value=array();
  $crd=0;
  $weight='';
  $sql_login  =  $database->mysqlQuery(" select weight, item_price,mr_menuid,mr_menuname,tm,paymode,card,cash,credit,billno, subtotal,final,paid,
      balance,dayclosedate,daytime,sum(item_price) as sub from 
  (select tbd.bd_unit_weight as weight, bd_amount as item_price, mr_menuid,mr_menuname, bm_paymode as paymode,bm_billtime as tm,bm_transactionamount as card,
  (bm_amountpaid-bm_amountbalace) as cash , (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,bm_billno as billno,  bm_subtotal as  subtotal, bm_finaltotal as final, bm_amountpaid as paid,   bm_amountbalace as balance ,bm.bm_dayclosedate as dayclosedate,bm.bm_billtime as daytime 
  from tbl_tablebillmaster bm  left join tbl_tablebilldetails tbd on tbd.bd_billno=bm.bm_billno left join tbl_menumaster tm on 
  tm.mr_menuid=tbd.bd_menuid
  where  $string 
  union all
  select tbd.tab_unit_weight as weight,tab_amount as item_price, mr_menuid,mr_menuname,tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,
  (tab_amountpaid-tab_amountbalace) as cash , (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,
  tbd.tab_billno as billno,  tab_subtotal as subtotal,tab_netamt as final,    tab_amountpaid as paid,   tab_amountbalace as  balance,
  bm.tab_dayclosedate as dayclosedate,bm.tab_time as daytime 
  from tbl_takeaway_billmaster
  bm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=bm.tab_billno left join tbl_menumaster tm on tm.mr_menuid=tbd.tab_menuid 
  where  $stringta )s
  group by billno,dayclosedate,mr_menuname order by dayclosedate,tm ASC ");                           
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                    if($result_login['weight']>0){
                    $weight=  '['.$result_login['weight'].']'; 
                    }else{
                     $weight='';   
                    }
                        
               $subtotal=$subtotal + $result_login['sub'];                         
	 ?>
                                <tr >
                               <td><?=$database->convert_date($result_login['dayclosedate'])?></td>
                               <td><?=$result_login['billno']?></td>
                               <td><?=$result_login['mr_menuname'].$weight?></td>
                               <td><?=number_format($result_login['sub'],$_SESSION['be_decimal'])?></td>
                                <?php 
                                $final1=0;
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                        $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,taxid,mid,sum(taxtotal) as tot from
                        (select betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid,betm.bet_menuid as mid
                        FROM tbl_tablebill_extra_tax_details betm where
                        betm.bet_billno='".$result_login['billno']."' and betm.bet_menuid='".$result_login['mr_menuid']."' "
                        . "and betm.bet_tax_id='".$tax_id[$s]."'           
                        union all
                        select tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid,tketm.tbet_menuid as mid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_billno='".$result_login['billno']."' and tketm.tbet_menuid='".$result_login['mr_menuid']."' "
                        . "and tketm.tbet_tax_id ='".$tax_id[$s]."')s  
                       group by mid order by s.taxid asc"); 
                         $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['tot']==''){
                                        $result_taxvalue['tot']=0;
                                    }
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['tot'];
                                 ?>
                            <td><?=number_format($result_taxvalue['tot'],$_SESSION['be_decimal'])?></td>
                            <?php 
                                    $final1=$final1+$result_taxvalue['tot'];
                            } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;?>
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } }?>
                                
                               <?php if($itemtx==1){?>
                                 <td >No Tax</td>
                                <?php } ?>
                                
                              <td><?=number_format($result_login['sub']+$final1,$_SESSION['be_decimal'])?></td>
                              
                              
                              </tr> 
                              <?php }
                              
                               }
                              
                              ?>
                              
                             
                              
  </tbody>
   <tfoot style="width: 99%;">
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
   
  <td style="font-size: 10px;font-weight: bold"><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ ?>
    <td style="font-size: 10px;font-weight: bold"><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
   $final=$final+array_sum($tax_value[$tax_id[$i]]);
     }
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
   
   <?php if($itemtx==1){?>
                                 <td >0</td>
                                <?php } ?>
  <td style="font-size: 10px;font-weight: bold"><strong><?=number_format($subtotal+$final,$_SESSION['be_decimal'])?></strong></td>
  </tr>                    
     </tfoot>                                            
    </table>
<?php
                                     }else{
                                         ?>
    <tr class="main">
    <td ><strong style="Color:darkred">NO ITEM TAX RECORDS</strong></td>
    <td ></td>
    <td ></td>
    </tr>
              <?php 
           
                                         
    }

   
   
  }else{ ?>
      
                <!--////hsn code/////-->
      
                        <table class="table table-bordered table-font user_shadow" >
			<thead>
                            
                            <?php
                            
                             $hsn='';
                            
                            if($_REQUEST['hsn_code_search']!=''){
                                
                                
                                $hsn.=" and tm.mr_hsn like '%".$_REQUEST['hsn_code_search']."%' ";
                                
                            }
                            
                            
                            
                            $tax_name=array(); $tax_val_sum=0;
                            $tax_id=array(); 
                            $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id,amc_value FROM `tbl_extra_tax_master` "
                                    . "where amc_active='Y'  and amc_item_tax='Y'  "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                          $tax_val_sum=  $tax_val_sum+$result_login['amc_value'];
                                            
                                            
                                       $tax_name[]=$result_login['amc_name'];
                                       $tax_id[]=$result_login['amc_id'];
                                       $itemtx=0;
                                     }}else{
                                         $itemtx=1;
                                     } 
                                     
                                     if($itemtx==0){
                                  
                                     ?>
                                <tr>
                                <th colspan="<?=6+$itemtx+count(array_unique($tax_id))?>">Report  <?=$reporthead?></th>
                                </tr>
				<tr>
                                    
<!--                                    <th class="sortable">Date</th>-->
                                    <th class="sortable">Description</th>
                                     <th class="sortable">HSN</th>
                                    <th class="sortable">Unit Of Measurement</th>
                                    <th class="sortable">Quantity</th>
                                     <th class="sortable">Tax(%)</th>
                                     <th class="sortable">Total Taxable Value</th>
                                    <?php
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php }
                                     
                                     
                                     if($itemtx==1){ ?>
                                          <th class="sortable">Item Tax</th>
                                         <?php
                                     }
                                     ?>
                                       
                                   
                 </tr>
		</thead>
		<tbody>
                    
  <?php
  $final=0;
  $subtotal=0;
  $tax_value=array();
  $crd=0;
  
  $sql_login  =  $database->mysqlQuery(" select sum(qty) as qty1,unit,sum(item_price) as sub1,mid,mr_menuname,mr_hsn,mr_description,
   dayclosedate,sum(weight) as weight1,weight,portionid,portionname,unitid,unitname,baseunitid,baseunitname,bill from 
      
   (select tbd.bd_qty as qty,tm.mr_unit_type as unit, tbd.bd_amount as item_price, tm.mr_menuid as mid,
   tm.mr_menuname,tm.mr_hsn,tm.mr_description,bm.bm_dayclosedate as dayclosedate,tbd.bd_unit_weight as weight,
   tbd.bd_portion as portionid,pm.pm_portionname as portionname,tbd.bd_unit_id as unitid,um.u_name as unitname,
   tbd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.bm_billno as bill
   
   from tbl_tablebillmaster bm  left join tbl_tablebilldetails tbd on tbd.bd_billno=bm.bm_billno
   left join tbl_menumaster tm on  tm.mr_menuid=tbd.bd_menuid 
   left join tbl_portionmaster pm ON pm.pm_id = tbd.bd_portion
   left join  tbl_unit_master um on um.u_id=tbd.bd_unit_id
   left join tbl_base_unit_master bum on bum.bu_id=tbd.bd_base_unit_id
   where $string $hsn
      
   union all
  
  select tbd.tab_qty as qty,tm.mr_unit_type as unit,tbd.tab_amount as item_price, tm.mr_menuid as mid,
  tm.mr_menuname,tm.mr_hsn, tm.mr_description,bm.tab_dayclosedate as dayclosedate,tbd.tab_unit_weight as weight,
  tbd.tab_portion as portionid,pm.pm_portionname as portionname,tbd.tab_unit_id as unitid,um.u_name as unitname,
  tbd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.tab_billno as bill
  
  from tbl_takeaway_billmaster
  bm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=bm.tab_billno
  left join tbl_menumaster tm on tm.mr_menuid=tbd.tab_menuid  
  left join tbl_portionmaster pm ON pm.pm_id = tbd.tab_portion
  left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
  left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
  where  $stringta $hsn )s
      
  where qty>0  group by mr_menuname order by mr_hsn ASC ");   
  
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  
                      
                      
                      if($result_login['portionid']!=''){
                              $weight='';
                              
                              $unit=$result_login['portionname'] ;
                             
                      }else{
                                
                                  
                                if($result_login['unitid']!=''){
                                    
                                    $unit=$result_login['unitname'] ;
                                }
                                else{
                                    
                                    $unit=$result_login['baseunitname'] ;
                                }
                      }
                      
                      
                      
                                $i++;
                                $subtotal=$subtotal + $result_login['sub1'];                         
	 ?>
                              <tr>
<!--                          <td><?//=$database->convert_date($result_login['dayclosedate'])?></td>-->
                              <td><?=substr($result_login['mr_menuname'],0,30)?></td>
                              <td><?=$result_login['mr_hsn']?></td>
                             
                               <td><?=$unit?></td>
                             
                                <?php if($result_login['unit']!=''){ ?>
                               <td><?=$result_login['weight1']?></td>
                                 <?php }else{ ?>
                               <td><?=$result_login['qty1']?></td>
                               <?php } ?>
                                
                               
                               <?php 
                         $tax_val_sum=0;
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                         
                          
                        $sql_taxvalue1  =  $database->mysqlQuery("select taxtotal,sum(taxtotal) as tx1,taxid,mid,vl from
                        (select betm.bet_tax_value as vl,betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid , betm.bet_menuid as mid
                        FROM tbl_tablebill_extra_tax_details betm where
                         betm.bet_menuid='".$result_login['mid']."' and betm.bet_tax_id='".$tax_id[$s]."'           
                        $stringtx_di 
                            
                        union all
                            
                        select tketm.tbet_tax_value as vl,tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid, tketm.tbet_menuid as mid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_menuid='".$result_login['mid']."'
                        and tketm.tbet_tax_id ='".$tax_id[$s]."' $stringtx_ta )s  
                      
                        group by taxid,mid order by s.taxid asc"); 
                        
                         $num_taxvalue1   = $database->mysqlNumRows($sql_taxvalue1);
                                if($num_taxvalue1){
                                    
                                    while($result_taxvalue1  = $database->mysqlFetchArray($sql_taxvalue1)) 
                                    { 
                                    
                                       $tax_val_sum=  $tax_val_sum+$result_taxvalue1['vl'];
                                       
                                    }}
                                    
                                    }
                                    ?>
                               
                               
                               
                               
                               
                               <td><?=$tax_val_sum?></td>
                               
                               <td><?=number_format($result_login['sub1'],$_SESSION['be_decimal'])?></td>
                               
                                <?php 
                                
                        $final1=0;  
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                            
                        $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,sum(taxtotal) as tx1,taxid,mid from
                        (select betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid , betm.bet_menuid as mid
                        FROM tbl_tablebill_extra_tax_details betm where
                         betm.bet_menuid='".$result_login['mid']."' and betm.bet_tax_id='".$tax_id[$s]."'           
                        $stringtx_di 
                            
                        union all
                            
                        select tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid, tketm.tbet_menuid as mid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_menuid='".$result_login['mid']."'
                        and tketm.tbet_tax_id ='".$tax_id[$s]."' $stringtx_ta )s  
                      
                         group by taxid,mid order by s.taxid asc"); 
                        
                         $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                if($num_taxvalue){
                                    
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { 
                                        
                                        
                                                if($result_taxvalue['taxtotal']==''){

                                                     $result_taxvalue['taxtotal']=0;
                                                }

                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['tx1'];
                                    
                                 ?>
                               
                               <td><?=number_format($result_taxvalue['tx1'],$_SESSION['be_decimal'])?></td>
                            
                               <?php 
                               
                               } }else { 
                                   
                                $tax_value[$tax_id[$s]][]=0;?>
                            
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                
                                <?php } } ?>
                                
                                
                               <?php if($itemtx==1){?>
                                
                                <td>No-Tax</td>
                                 
                               <?php } ?>
                                
                               </tr> 
                              
    <?php } } ?>
                              
                             
                              
  </tbody>
  
    <tfoot style="width: 99%;">
    <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td style="font-size: 10px;font-weight: bold"></td>  
    <td style="font-size: 10px;font-weight: bold"><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
    
   <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ ?>
  
    <td style="font-size: 10px;font-weight: bold"><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
           $final=$final+array_sum($tax_value[$tax_id[$i]]);
    }
     
   for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
   <?php } ?>
   
   <?php if($itemtx==1){?>
     <td >0</td>
   <?php } ?>

  </tr>  
  
     </tfoot>                                            
    </table>
                
   <?php }else{ ?>
                
    <tr class="main">
    <td ><strong style="Color:darkred">NO RECORDS</strong></td>
    </tr>
    
    <?php 
           
                                         
  }
      
  }





  }
             
             
  }    
}

else if(($_REQUEST['type']=="staff_change_log_report"))
        {
	
	           $string="";
	
       
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " date(date_time) between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  date(date_time) between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  date(date_time) between '".$from."' and '".$to."' ";
                         $reporthead= $from .' to ' .$to; 
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
               $reporthead= 'Last5days'; 
	}
        elseif($bydatz=="Last10days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
               $reporthead= 'Last10days'; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" date(date_time) = CURDATE() - INTERVAL 1 day";
                                 $reporthead= 'Yesterday'; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead= 'Last15days'; 
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               $reporthead= 'Last20days'; 
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                 $reporthead= 'Last25days';  
	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $reporthead= 'Last30days';      
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" date(date_time) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                              $reporthead= 'Last1month';       
			  }
	else if($bydatz=="Today")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $reporthead= 'Today';   
	}
else if($bydatz=="Last90days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead= 'Last90days';   
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead= 'Last180days';   
	}
else if($bydatz=="Last365days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
           $reporthead= 'Last365days';   
	}

	}
	else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " date(date_time) between '".$from."' and '".$to."' ";
                        $reporthead=date("Y-m-d");
	}
		
	
	}
	?>
    
     <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>STAFF CHANGE LOG REPORT </strong></th>
      </tr>

      
    </thead>
    </table>   

	<table class="table table-bordered table-font user_shadow" >
            <thead style="    table-layout: inherit;">
                                 <tr>
                                  <th colspan="3">Staff Change Log - <?=$reporthead;?></th>
                                  </tr>
                                  
				<tr>
                                    <th style="width:5%" >Slno</th>
                                      
                                      
                                        <th style="width:10%" > Changed Date-Time</th>	
                                        <th style="width:30%" >Message</th>
                                       
                                        
				</tr>
				</thead>
				<tbody>
                                    
									
            <?php
            
          $sql_login  =  $database->mysqlQuery("select date_time,message from tbl_staffmaster_logs where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  if($num_login)
	  { $i=0;
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$i++;
              ?>
                   <tr>
	
       
           <td style="width:5%"> <?=$i?> </td>
           <td style="width:10%"> <?=$result_login['date_time']?> </td>
            <td style="width:30%"> <?=$result_login['message']?> </td>
           
           
	  </tr>
                           
                           
<?php
	  }
          }
?>
          </tbody>
                            </table>
          <?php
}else if(($_REQUEST['type']=="stock_daywise_report"))
{ ?>
              <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>STOCK REPORT </strong></th>
      </tr>

      
    </thead>
    </table> 

    	<?php
	$string="";
        $reporthead='';
        
        $string.=" where ts_dayclose !=''  ";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                      $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
              $reporthead="Last 5 days"; 
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
           $reporthead="Last 10 days";     
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and ts_dayclose = CURDATE() - INTERVAL 1 day";
                              $reporthead="Yesterday";          
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $reporthead="Last 15 days";     
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
               $reporthead="Last 20 days";     
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
               $reporthead="Last 25 days";     
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
               $reporthead="Last 30 days";      
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and ts_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                $reporthead="Last 1 month";      
			  }
	else if($bydatz=="Today")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $reporthead="Today";     
	}
else if($bydatz=="Last90days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               $reporthead="Last 90 days";     
	}
else if($bydatz=="Last180days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead="Last 180 days";     
	}
else if($bydatz=="Last365days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
               $reporthead="Last 365 days";     
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                       $reporthead="Today";     
	}
		
	
	}
	
	
	if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
            
            $string.= " and mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            
        }
        
	?>
        <table class="table table-bordered table-font user_shadow" id="myTable">
				<thead >
                                  
                                
                                    <tr style=" table-layout: inherit;">
                                  	<th colspan="8">Stock Report - <?=$reporthead?></th>
                                    </tr>
							
                                    <tr >
                                        <th >Sl</th>                                       
                                        <th  >Date</th> 
                                        <th   >Menu</th>
                                         <th   >Portion</th>
                                        <th >Opening Stock</th>
                                        <th  >Added Stock</th>
                                         <th >Balance Stock</th>
                                             
                                        <th >Sold Stock</th>
                                    </tr>
				</thead>
				<tbody>
                                    <?php $clr=''; $open=0;$added=0;$balance=0;$sold=0;
  $sql_login  =  $database->mysqlQuery("select ts_open_stock,ts_added_stock,ts_balance_stock,ts_dayclose,mr_menuname,pm_portionname   from tbl_daily_stock_detail left join tbl_menumaster on mr_menuid=ts_menuid left join tbl_portionmaster on pm_id=ts_portion   $string order by ts_dayclose desc "); 
                          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;
	  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
              
            $open=$open+$result_login['ts_open_stock'];
              $added=$added+$result_login['ts_added_stock'];
              $balance=$balance+$result_login['ts_balance_stock'];
              
              $sold=$sold+(($result_login['ts_open_stock']+$result_login['ts_added_stock'])-$result_login['ts_balance_stock'] );
              
              if($clr!=$result_login['ts_dayclose']){
              $clr=$result_login['ts_dayclose'];
              
              }
           
              
              ?>
                                   
                      
            <tr>
		<td ><?=$i++?></td>
                <td ><?=$result_login['ts_dayclose']?> </td>
                <td ><?=$result_login['mr_menuname']?></td>
                <td ><?=$result_login['pm_portionname']?></td>
                <td ><?=$result_login['ts_open_stock']?></td>
                <td ><?=$result_login['ts_added_stock']?></td>
                <td ><?=$result_login['ts_balance_stock']?></td>
                <td ><?= (($result_login['ts_open_stock']+$result_login['ts_added_stock'])-$result_login['ts_balance_stock'] )?></td>
            </tr>
            
      
                  
                        <?php } ?>
                        
                        <tr>
		<td ></td>
                <td ></td>
                <td ></td>
                <td > </td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
            </tr> 
                        
                 <tr>
                     <td style="font-weight:bold" >TOTAL</td>
                <td ></td>
                <td ></td>
                <td></td>
                <td style="font-weight:bold"><?=$open?></td>
                <td style="font-weight:bold"><?=$added?></td>
                <td style="font-weight:bold"><?=$balance?></td>
                 <td style="font-weight:bold"><?=$sold?></td>
            </tr> 
                        
                        
                        
                 <?php        
              }else{
                      ?>
            <tr>
		<td ></td>
                <td ></td>
                <td ></td>
                <td style="color:red">NO DATA</td>
                <td ></td>
                <td ></td>
                <td ></td>
            </tr>
            
     
                <?php
                  } ?>
            
     </tbody>
      </table>       
            
<?php
}else if(($_REQUEST['type']=="shift_detail_cr"))
{
	$string="";
        
	$reporthead="";
        
	$st="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";                         
             $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}	
	else 
	{
	$reporthead="";
	$st="";       
	$bydatz=$_REQUEST['bydate'];	
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";             
        $st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";          
        $st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";         
        $st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";       
        $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";         
        $st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";                
		$st="Today";
	}
else if($bydatz=="Yesterday")
	{
		$string.=" sd.sd_day = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";                               
		$st="Yesterday";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  sd.sd_day between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";           
        $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";               
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";               
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";              
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{
	$from=date("Y-m-d");
	$to=date("Y-m-d");
	$string.= " sd.sd_day between '".$from."' and '".$to."' ";                      
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
        }
		
    
       }
       
       
    $lt=2500;                              
    $pagination=0;
    $recordcount="";
    if(isset($_REQUEST['pagination']))
    {
    $pagination= $_REQUEST['pagination'];
    $recordcount=$_REQUEST['recordcount'];

    }

    if($recordcount!=""){
       $p5=$recordcount;
    }else{
       $p5=-1;
    }

       
           ?>  

          <table class="table table-bordered table-font user_shadow">
          <thead>
          
              
                               
                                 
                                 <?php if($_REQUEST['comp_item_wise']!='true'){       ?>
                                        <tr>
                                    <th colspan='7'><strong>Shift Details <?=$reporthead?></strong></th>
                                 </tr>
                                    <tr>
                                    <th style="vertical-align: middle" class="sortable">Sl </th>
                                    <th style="vertical-align: middle" class="sortable">Sale Date </th>
                                   
                                   <th>Bill No</th>
                                   <th>Paymode</th>
                                   <th>Subtotal</th>
                                   <th>Tax</th>
                                   <th>Total</th>
                                   </tr>
                                 <?php }else{       ?>      
                                     <tr>
                                    <th colspan='11'><strong>Shift Item Details <?=$reporthead?></strong></th>
                                 </tr>
                                   <tr>
                                    <th >Sl </th>
                                    <th >Sale Date </th>
                                    <th >Item Name </th>
                                   
                                 
                                   <th >Unit Type</th>
                                  <th >Port/Wgt</th>
                                        <th  >Qty DI</th>
                                        <th > TA-HD</th>
                                        <th  > CS</th>
                                        <th  > Total Qty</th>
                                         <th  >Tot Weight</th>
                                            
                                        <th>Total</th>
                                   </tr>
                                     <?php }   ?>          
                                   
                              
          
          </thead><tbody>

                         <?php
          $user='';     $sub=0; $tot=0; $tax=0;  $sub1=0; $tot1=0; $tax1=0;
          $sql_login  =  $database->mysqlQuery("select sd.sd_day, sd.sd_open ,tl.ls_username, sd.sd_close from tbl_shift_details sd"
                  . "  left join tbl_logindetails tl on tl.ls_staffid=sd.sd_open_staff   "
                  . "  where $string and sd.sd_open_staff='".$_REQUEST['shiftlogin']."' and  sd.sd_close!=''  "); 

  	  $num_login   = $database->mysqlNumRows($sql_login);
          if($num_login)
	  { 
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                             $open=$result_login['sd_open'];
                             $close=$result_login['sd_close'];
                             $shiftuserid=$result_login['ls_username'];
                             
                                 ?>
              
              
               <tr>
                    <td style="font-weight:bold">Shift Name:  
                                         <?=$shiftuserid?>
                                   |  Open : <?=$open?>
                                   |  Close : <?=$close?></td>
                                       </td>
                                   
                </tr>
              
                            
                            
                            
                            
              <?php
              
      if($_REQUEST['comp_item_wise']=='true'){        
              
                  
          ///shift item wise////
          
         
             
   $sql_stw  =  $database->mysqlQuery("
                   select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,unitid,unitname,baseunitid,baseunitname,
                   sum(qty_di)as qty_di,sum(qty_ta)as qty_ta,sum(qty_cs)as qty_cs,sum(total)as total , dayclose,login
                   from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname,
                   bd.bd_rate_type as rate_type,bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                   bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                   bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty_di ,0 as qty_ta,0 as qty_cs, 
                   sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose,bm.bm_settlement_login as login
                   FROM tbl_tablebilldetails bd 
                   left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                   left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                   left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                   left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                   left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                   left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                   left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                   where  bd.bd_count_combo_ordering is NULL and  bm.bm_settlement_time  between  '$open' and  '$close' and
                   bm.bm_finaltotal>0 and bm.bm_settlement_login='$shiftuserid' and bm.bm_status='Closed'
                    and bm.bm_complimentary='N'
                   group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight,bm.bm_dayclosedate
                                            
   union all 
                                        
                   select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                   mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                   bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                   bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                   bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, 0  as qty_di,
                   sum(bd.tab_qty) as qty_ta ,0 as qty_cs, sum(bd.tab_rate* bd.tab_qty) as total,bm.tab_dayclosedate as dayclose,bm.tab_settlement_login as login
                   FROM tbl_takeaway_billdetails bd
                   left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                   left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                   left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                   left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                   left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                   left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                   left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                   where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD') and bm.tab_settlement_time between  '$open' and  '$close' 
                   and bm.tab_netamt> 0 and bm.tab_settlement_login='$shiftuserid' and bm.tab_status='Closed'
                   and bm.tab_complimentary='N'
                   group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight ,
                   bm.tab_dayclosedate
                                        
                         union all 
                                        
                    select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                    mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                    bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                    bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                    bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate,  0  as qty_di, 0 as qty_ta ,
                    sum(bd.tab_qty) as qty_cs , sum(bd.tab_rate* bd.tab_qty) as total, bm.tab_dayclosedate as dayclose,bm.tab_settlement_login as login
                    FROM tbl_takeaway_billdetails bd
                    left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                    left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                    left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                    left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                    left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                    left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                    left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                    where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('CS') and  bm.tab_settlement_time between  '$open' and  '$close' 
                    and bm.tab_netamt> 0 and bm.tab_settlement_login='$shiftuserid' and bm.tab_status='Closed'
                    and bm.tab_complimentary='N'
                    group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, 
                    bd.tab_unit_weight, bm.tab_dayclosedate  
                    
                    )x group by menuid,portionid,unitid,baseunitid,weight,dayclose,login order by dayclose,maincategory,menuid limit ". $pagination.",$lt ");   
   
   
   
   
   
   
   
   
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){
                    $p5=0;
                $t=0;$old_cat=""; $old_menu='';$unit_type='';  $old_menu2=''; $old_menu1=''; $tot_weight_all=0; $weight_in=0; $wgt1=0;
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0; $tot_wgt=0; $tot_wgt1=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                    { 
                    
                       $weight_in= $weight_in+ (($qty+$qty_ta+$qty_cs)*$weight);  
                     
                       if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                         $tot_wgt=  $tot_wgt+ $total;      
                       }
                     
                            $i++;$p5++;
                    
                            if($result_stw['maincategory']!=$old_cat){
                                
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                               $catname=''; 
                            }
                            
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_di'];
                            $qty_ta=$result_stw['qty_ta'];
                            $qty_cs=$result_stw['qty_cs'];
                            $qty_all=$qty+$qty_ta+$qty_cs;                          
                            $weight=$result_stw['weight'];    
                            
                            if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty=$result_stw['qty_di'];
                               $qty_ta=$result_stw['qty_ta'];
                               $qty_cs=$result_stw['qty_cs'];
                              
                            }else{
                                
                              $qty=$result_stw['qty_di'];
                              $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
                            }
                            
                            if($result_stw['portionid']!=''){
                                
                               $weight='';
                               $unit=$result_stw['portionname'] ;
                               $unit_type=$result_stw['rate_type'] ;
                            
                            }else{
                                
                                $unit_type=$result_stw['unit_type'] ;
                                
                                if($result_stw['unitid']!=''){
                                    $unit=$result_stw['unitname'] ;
                                }
                                else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            
                            if($unit_type=='Loose'){
                                
                                 $catname=$result_stw['maincategory'];        
                                
                                if($result_stw['menuid']==$old_menu){
                                    
                                   $weight_loose=($result_stw['weight']);
                                  
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];

                                     $catname='';
                                }else{
                                     $old_menu=$result_stw['menuid'];
                                     $weight_loose=$result_stw['weight'];
                                     $loose_total=$result_stw['total'];
                                  }
                                    $weight=$weight_loose;
                                    $total=$loose_total;
                                    $qty='0';
                          }
                          
           $old_menu2=$result_stw['menuid'];     
                   
           $old_menu1=$old_menu2;
           
           ?>
               
                    
                    <tr id="<?=$i?>">
                    <td ><?=$p5?></td>
                     <td ><?=$result_stw['dayclose']?></td>
                    <td style="width:10%;display: none" colspan="1"><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td style="width:10%;display: none" colspan="1"><?=strtoupper($subcatname)?></td>
                    <td ><?=substr(strtoupper($menuname),0,25)?></td>
                    <td  ><?=$unit_type?></td>
                    <td ><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td ><?=$qty?></td>
                    <td ><?=$qty_ta?></td>
                    <td><?=$qty_cs?></td>
                        
                    <td ><?=($qty+$qty_ta+$qty_cs)?></td>   
                       
                    <?php if($unit_type=='Loose' || $unit_type=='Packet' ){ ?>
                    <td >
                    <?=($qty+$qty_ta+$qty_cs)*$weight?> <span style="font-size: 9px " ><?=$unit?></span>
                    </td>   
                        
                    <?php }else{ ?>
                       
                    <td >0</td>   
                       
                    <?php } ?>
                        
                    <td>
                    <?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?>
                    </td>
                 </tr>  
                
                    <?php
                    
                   
                    
            } }

            
          
      }else{
                              $sql_shift_user  = $database->mysqlQuery(" select login,billno,final,payment_mode,machine,
                                countername,mode,open,close,dayin,taxamt,subtotal ,saledate from
                                (SELECT bm.bm_billno as billno,ts.sd_open_machineid as machine,ts.sd_day as dayin,ts.sd_open as open,
                                ts.sd_close as close,st.ser_firstname as login,
                                em.cm_ip_remarks as countername,bm_finaltotal as final,'DI' AS mode,
                                bm.bm_paymode as payment_mode , (bm.bm_total - bm.bm_subtotal_final ) as taxamt, bm.bm_subtotal as  subtotal,
                                bm.bm_dayclosedate as saledate FROM tbl_shift_details ts 
                                left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                left join tbl_tablebillmaster bm on bm.bm_settlement_login=lg.ls_username
                                where  bm.bm_settlement_time  between  '$open' and  '$close' and
                                bm.bm_finaltotal>0 and bm.bm_settlement_login='$shiftuserid' and bm.bm_status='Closed'
                                and bm.bm_complimentary='N' group by  bm.bm_dayclosedate,bm.bm_billno,st.ser_firstname
                                
                                union all

                                SELECT tbm.tab_billno as billno,ts.sd_open_machineid as machine,
                                ts.sd_day as dayin,ts.sd_open as open,ts.sd_close as close,
                                st.ser_firstname as login,em.cm_ip_remarks as countername,tab_netamt as final,tbm.tab_mode as mode, 
                                tbm.tab_paymode as payment_mode,(tbm.tab_total - tbm.tab_subtotal_final) as taxamt, tbm.tab_subtotal as  subtotal,
                                tbm.tab_dayclosedate as saledate FROM tbl_shift_details ts 
                                left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                left join tbl_takeaway_billmaster tbm on tbm.tab_settlement_login=lg.ls_username
                                where  tbm.tab_settlement_time between  '$open' and  '$close' 
                                and tbm.tab_netamt> 0 and tbm.tab_settlement_login='$shiftuserid' and tbm.tab_status='Closed'
                                and tbm.tab_complimentary='N' group by tbm.tab_dayclosedate,tbm.tab_billno,st.ser_firstname )x
                                
                                group by login,billno,saledate   order by saledate asc    ");
                                    
                              
                          
                              
                       $num_shift_user  = $database->mysqlNumRows($sql_shift_user);
                       if($num_shift_user){ 
                        $p5=1;
                        while($result_shift_user  = $database->mysqlFetchArray($sql_shift_user)) 
                        {
                            
                            
                            
                            $sub=$sub+$result_shift_user['subtotal'];
                            $tax=$tax+$result_shift_user['taxamt'];
                            $tot=$tot+$result_shift_user['final'];
                            
                            
                            
                            if($result_shift_user['payment_mode']=='1'){
                                
                                $mode='Cash';
                            }else  if($result_shift_user['payment_mode']=='2'){
                                
                                $mode='Card';
                            }else  if($result_shift_user['payment_mode']=='6'){
                                
                                $mode='Credit';
                            }else  if($result_shift_user['payment_mode']=='7'){
                                
                                $mode='Complimentary';
                            }
                            
                    
                        ?>
                             <tr>
                                        <td><?=$p5++?></td>
                                        <td><?=$result_shift_user['saledate']?></td>
                                      
                                        <td><?=$result_shift_user['billno']?></td>
                                         <td><?=$mode?></td>
                                        <td><?=number_format($result_shift_user['subtotal'],$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format($result_shift_user['taxamt'],$_SESSION['be_decimal']) ?></td>
                                        <td><?=number_format($result_shift_user['final'],$_SESSION['be_decimal'])?></td>
                                   
                            </tr>
                            
                            <?php
                } }
                
                                      $sub1=$sub1+$sub;
                            $tax1=$tax1+$tax;
                            $tot1=$tot1+$tot;
                            
                
                ?>
                
                <tr>
                    <td style="font-weight:bold">Shift Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight:bold"><?=number_format($sub,$_SESSION['be_decimal'])?></td>
                                        <td style="font-weight:bold"><?=number_format($tax,$_SESSION['be_decimal']) ?></td>
                                        <td style="font-weight:bold"><?=number_format($tot,$_SESSION['be_decimal'])?></td>
                                   
                                        
                  </tr>
                            
                            
                             <tr>
                    <td style="font-weight:bold"> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight:bold"></td>
                                        <td style="font-weight:bold"></td>
                                        <td style="font-weight:bold"></td>
                                   
                            </tr>
                            
                            
                            <tr>
                    
                            
               <?php
                }
                }   
                 ?>
                
                 <?php if($_REQUEST['comp_item_wise']!='true'){       ?> 
                <td style="font-weight:bold">Final Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight:bold"><?=number_format($sub1,$_SESSION['be_decimal'])?></td>
                                        <td style="font-weight:bold"><?=number_format($tax1,$_SESSION['be_decimal']) ?></td>
                                        <td style="font-weight:bold"><?=number_format($tot1,$_SESSION['be_decimal'])?></td>
                                   
                                        
                  </tr>
                 <?php }    ?>
                
                   
            <?php    }else { ?>
                            
  	<tr><td colspan="11" style="color:red;font-weight: bold;">No Records to Display</td></tr>
        
       <?php }  ?>
        
            </tbody>
            </table>

<div class="inv-pagination" style="bottom: -33px;position: 
    absolute;background-color: #fff;padding: 0rem;z-index: 999;
    border: solid;background-color: #382f2f;border-radius: 30px;">
                                         
                                        <?php 
                                       
                                        $m=0;
                                     
                                        $p1=floor(($p5/$lt)+1);
                                        
                                        ?>
                                        <a style="color:white" href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi0" onClick="return pagination('<?=$m?>','1');" >
                                        <strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p1;$j++){
                                          
                                        ?>
                                        <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p1?>"> 
                                        <a href="#" <?php if(($p1-1)==$j){ ?> style="color: black;border: solid 1px;padding: 1px;border-radius: 5px;padding-left: 2px;margin: 0px 4px;background-color: white" <?php } ?> style="padding-left: 2px;margin: 0px 4px;color:white" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong> <?=$j?> </strong></a>
                                        <?php $m=$m+$lt;
                                          
                                        }
                                        
                                        $m=$m-$lt;
                                        ?>
                                      
                                        <a style="color:white" href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p5?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
                                   
                                        <span style="color: #fff;margin: 0 10px;">[<?=$lt?> records]</span>

       </div>   


   <?php
                        
}
   else if($_REQUEST['type']=="item_ordered_cr")
{	
       
        $string_addon="";
        $stringta_addon="";
         $addon_head='';
          
        if($_REQUEST['addon']=='N')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
            $stringta_addon.=" and bd.tab_bill_addon_slno IS NULL ";
        }
        else if($_REQUEST['addon']=='Y')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
            $stringta_addon.=" and bd.tab_bill_addon_slno IS NOT NULL ";
             $addon_head='-Addons ';
        }
        else if($_REQUEST['addon']=='combo')
	{
            
             $addon_head='-Combos ';
        }
       
       
       
  ?>     
               <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Item Ordered <?=$addon_head ?></strong></th>
      </tr>

      
    </thead>
    </table>   
       
       
<?php       
       $string="";
        $stringta="";
        $string_combo="";
	$string.="bm.bm_status = 'Closed'";
        $stringta.="bm.tab_status = 'Closed'";
        
        
        
         if(isset($_REQUEST['staff']) && $_REQUEST['staff']!="" ){
              
            $string.= " and bm.bm_settlement_login = '".$_REQUEST['staff']."' ";
            $stringta.= " and bm.tab_settlement_login = '".$_REQUEST['staff']."' ";
           
        }
  
        
        
        if($_REQUEST['category_menu']!="" ){
            $string.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
             $stringta.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
        }
        
         if($_REQUEST['subcategory']!="" ){
            $string.= " and sc.msy_subcategoryid='".$_REQUEST['subcategory']."'";
             $stringta.= " and sc.msy_subcategoryid='".$_REQUEST['subcategory']."'";
        }
        
        
        if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
            $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            $string_combo.= " cn.cn_name LIKE '%".$_REQUEST['menu_search']."%' and ";
        }
        
       
        
        
        if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		$string.="and bm.bm_floorid='".$floorvalue."'";
                }
	}
       
	
					
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                    $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                }
				
					
           
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  bm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $st="Last 365 days";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                
                }
                $reporthead=$st;
	}
        
	
	if($_REQUEST['modeofview']!='summary'){
            
	?>
                            <table class="table table-bordered table-font user_shadow" id="myTable">
				<thead style=" table-layout: inherit;">
                                  <?php if($reporthead !="")
								  {?>
                                    <tr style=" table-layout: inherit;">
                                  	<th colspan="12">Report - <?=$reporthead?></th>
                                    </tr>
					   <?php } ?>
                                    
                                    <tr style=" table-layout: inherit;">
                                        <th style="width:5%" class="sortable">Sl no</th>                                       
                                        <th style="width:10%" class="sortable">Category</th>
					<th style="width:10%" class="sortable">Sub category</th>
                                        <th class="sortable" style="width:20%" >Item</th>
                                        <th class="sortable" style="width:8%">Unit Type</th>
                                        <th class="sortable" style="width:8%">Port/Wgt</th>
                                        <th class="sortable" style="width:5%" >Qty DI</th>
                                        <th class="sortable" style="width:5%" > TA-HD</th>
                                        <th class="sortable" style="width:5%" > CS</th>
                                        <th class="sortable" style="width:5%" > Total Qty</th>
                                         <th class="sortable" style="width:9%" >Tot Weight</th>
                                            
                                        <th class="sortable" style="width:10%">Total</th>
                                    </tr>
				</thead>
				<tbody>
       <?php
        $final=0;
        $qty=0;
        $qty_final=0;
        $qty_final_ta=0;
        $qty_final_cs=0;
        $i=0;$t=0;
        $p=0;
        
 if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            
   $sql_combo  =  $database->mysqlQuery(" select combo,comboid,combopackid, sum(qty_di) as qty_di,sum(qty_ta) as qty_ta,sum(qty_cs) as qty_cs,
       rate as rate, sum(total) as total,dayclose as dateofsale
   from (select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id as comboid, 
   cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty_di,0 as qty_ta ,0 as qty_cs,
   cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
   FROM tbl_combo_bill_details cbd 
   left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
   left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
   LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno 
   where $string_combo  and bm.bm_status='Closed' 
   group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno 
   union all 
   select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, 0 as qty_di,
   cbd.cbd_combo_qty as qty_ta, 0 as qty_cs,
   cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
   FROM tbl_combo_bill_details_ta cbd 
   left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
   left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
   LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
   where $string_combo  and bm.tab_status='Closed'   and bm.tab_mode IN ('TA','HD')
   group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno
   union all 


    select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, 0 as qty_di,
    0 as qty_ta, cbd.cbd_combo_qty as qty_cs, 
    cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
    FROM tbl_combo_bill_details_ta cbd 
    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
    LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
    where $string_combo  and bm.tab_status='Closed' and bm.tab_mode = 'CS'

    group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno) x 
    group by x.comboid, x.combopackid,dateofsale order by dateofsale  ");
            
            $dt_sale=  array();
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                    $i++;$p++;
                    $final=$final+$result_combo['total'];
                    $qty_final=$qty_final+$result_combo['qty_di'];
                    $qty_final_ta=$qty_final_ta+$result_combo['qty_ta'];
                    $qty_final_cs=$qty_final_cs+$result_combo['qty_cs'];
                    if(!array_key_exists($result_combo['dateofsale'],$dt_sale)){
                    $dt_sale[$result_combo['dateofsale']]=$result_combo['dateofsale'];
                    ?>            
                   <tr><td style="font-weight:bold ;text-align: left"><span style="background-color:lightgrey"><?=$result_combo['dateofsale']?> - COMBO</span></td></tr>
                    <?php } ?>
                <tr id="<?=$i?>">
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$p?></td>
                    <td style="width:10%" colspan="1" style="text-align:center"><strong><?php if($i==1) { ?>** COMBO MENU <?php } ?></strong></td>
                    <td style="width:10%" colspan="1" style="text-align:center"></td>
                    <td style="width:20%" colspan="1" style="text-align:center"><?=substr(strtoupper($result_combo['combo']),0,25)?></td>
                     <td style="width:10%" colspan="1" style="text-align:center"></td>
                    <td style="width:10%" colspan="1" style="text-align:center"></td>
                    
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$result_combo['qty_di']?></td>
                     <td style="width:5%" colspan="1" style="text-align:center"><?=$result_combo['qty_ta']?></td>
                      <td style="width:5%" colspan="1" style="text-align:center"><?=$result_combo['qty_cs']?></td>
                     
                      
                    <td style="width:9%" colspan="1" style="text-align:center"><?=($result_combo['qty_di']+$result_combo['qty_ta']+$result_combo['qty_cs'])?></td>  
                    
                    <td style="width:10%" colspan="1" style="text-align:center"></td>
                    <td style="width:11%" colspan="1" style="text-align:center"><?=number_format(str_replace(',','',$result_combo['total']),$_SESSION['be_decimal'])?></td>
                </tr>                      
   <?php
                    }
        } } 
        
        
        
       
        
  $dt_sale1=array();
  if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
      
             
   $sql_stw  =  $database->mysqlQuery("
   select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,unitid,unitname,baseunitid,baseunitname,
   sum(qty_di)as qty_di,sum(qty_ta)as qty_ta,sum(qty_cs)as qty_cs,sum(total)as total , dayclose
   from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname,
   bd.bd_rate_type as rate_type,bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
   bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
   bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty_di ,0 as qty_ta,0 as qty_cs, 
   sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
   FROM tbl_tablebilldetails bd 
   left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
   left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
   left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
   left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
   left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
   left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
   left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
   where  bd.bd_count_combo_ordering is NULL and $string $string_addon 
   group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight,bm.bm_dayclosedate
                                            
    union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, 0  as qty_di,
                                        sum(bd.tab_qty) as qty_ta ,0 as qty_cs, sum(bd.tab_rate* bd.tab_qty) as total,bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD')   and $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight ,
                                        bm.tab_dayclosedate
                                        
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate,  0  as qty_di, 0 as qty_ta ,
                                        sum(bd.tab_qty) as qty_cs , sum(bd.tab_rate* bd.tab_qty) as total, bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('CS') and $stringta $stringta_addon  
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, 
                                        bd.tab_unit_weight, bm.tab_dayclosedate  
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuid ");   
   
   
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){
                     $ff=0;
                $t=0;$old_cat=""; $old_menu='';$unit_type=''; $old_menu2=''; $old_menu1=''; $tot_weight_all=0; $weight_in=0;  $wgt1=0;
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0; $tot_wgt=0; $tot_wgt1=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                    { 
                      
                      
                          
                      $weight_in= $weight_in+ (($qty+$qty_ta+$qty_cs)*$weight);  
                      
                      if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                        $tot_wgt=  $tot_wgt+ $total;      
                      }
                              
                      $i++; $p++; $ff++;
                    
                            if($result_stw['maincategory']!=$old_cat){
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                               $catname=''; 
                            }
                            
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_di'];
                            $qty_ta=$result_stw['qty_ta'];
                            $qty_cs=$result_stw['qty_cs'];
                            $qty_all=$qty+$qty_ta+$qty_cs;                          
                            $weight=$result_stw['weight'];    
                   
                          
                            
                            if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty=$result_stw['qty_di'];
                              $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
                              
                            }else{
                                
                              $qty=$result_stw['qty_di'];
                              $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
                            }
                            
                            if($result_stw['portionid']!=''){
                              $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            
                            }else{
                                
                                $unit_type=$result_stw['unit_type'] ;
                                
                                if($result_stw['unitid']!=''){
                                    $unit=$result_stw['unitname'] ;
                                }
                                else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            
                            
                            $loose_total=0;
                            if($unit_type=='Loose'){
                                
                                $catname=$result_stw['maincategory'];        
                                
                                if($result_stw['menuid']==$old_menu){
                                    
                                   $weight_loose=($result_stw['weight']);
                                
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];

                                   $catname='';
                                   
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight'];
                                    $loose_total=$result_stw['total'];
                                  }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='0';
                                
                                  
                                
                          }
                              
                 
                          
                          
                          
                  $old_menu2=$result_stw['menuid'];         
                          
               if(!array_key_exists($result_stw['dayclose'],$dt_sale1)){
                    
                $dt_sale1[$result_stw['dayclose']]=$result_stw['dayclose'];
                    
                ?>
                
               <tr><td style="font-weight:bold ;text-align: left;min-width: 144px;"><span style="background-color:lightgrey"><?=$result_stw['dayclose']?>: NORMAL - ADDON</span></td></tr>
                   
               <?php } ?>
                    
                   
                 <?php
           
               if($old_menu2!=$old_menu1 && $p>1 && $weight_in>0){ 
              
               ?>
               
           <tr>
                  
		<td style="width:5%" colspan="1" style="text-align:center"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:20%"></td>
                <td style="width:8%"></td>
                <td style="width:8%"></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                 <td style="width:5%"><strong></strong></td>
                <td><strong> Total Wgt : <?=$weight_in?> <strong></td>
                <td style="width:10%"><strong><?=  $tot_wgt     ?></strong></td>
           </tr>
               
                   
             <?php   $weight_in=0;  $tot_wgt=0; } $old_menu1=$old_menu2;  ?>
              
               
               
               <tr id="<?=$i?>">
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$p?></td>
                    <td style="width:10%" colspan="1" style="text-align:center"><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td style="width:10%" colspan="1" style="text-align:center"><?=strtoupper($subcatname)?></td>
                    <td style="width:20%" colspan="1" style="text-align:center"><?=substr(strtoupper($menuname),0,25)?></td>
                    <td style="width:8%" colspan="1" style="text-align:center"><?=$unit_type?></td>
                    <td style="width:8%" colspan="1" style="text-align:center"><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$qty?></td>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$qty_ta?></td>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$qty_cs?></td>
                        
                      <td style="width:5%" colspan="1" style="text-align:center"><?=($qty+$qty_ta+$qty_cs)?></td>   
                       
                    
                    <?php if($unit_type=='Loose' || $unit_type=='Packet' ){ ?>
                    <td style="width:9%" colspan="1" style="text-align:center"><?=($qty+$qty_ta+$qty_cs)*$weight?> <span style="font-size: 9px " ><?=$unit?></span></td>   
                        
                    <?php }else{ ?>
                       
                    <td style="width:9%" colspan="1" style="text-align:center">0</td>   
                       
                    <?php } ?>
                        
                    <td style="width:10%" colspan="1" style="text-align:center"><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></td>
                </tr>  
               
               
       
       
               
               <?php
                  
               
               
                    $final=$final+$total;
                    
                    $qty_final=$qty_final+$qty;
                    $qty_final_ta=$qty_final_ta+$qty_ta;
                    $qty_final_cs=$qty_final_cs+$qty_cs;
                    $tt_qty=0;         
                    $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;  
                    
                 
                $wgt1= $wgt1+ (($qty+$qty_ta+$qty_cs)*$weight);
                
                
                 if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                        $tot_wgt1=  $tot_wgt1+ $total;      
                      }
                
                    
            } }

            }
            
            ?>
               
                 <?php    if( ( ($wgt1-($wgt1-$weight_in))+(($qty+$qty_ta+$qty_cs)*$weight) )  >0) {     ?>
               <tr>
                  
		<td style="width:5%" colspan="1" style="text-align:center"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:20%"></td>
                <td style="width:8%"></td>
                <td style="width:8%"></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                 <td style="width:5%"><strong></strong></td>
               <td><strong> Total Wgt : <?=($wgt1-($wgt1-$weight_in))+(($qty+$qty_ta+$qty_cs)*$weight)?> </strong></td>
                <td style="width:10%"><?=( ($tot_wgt1-($tot_wgt1-$tot_wgt))+$total )?><strong></td>
           </tr>     
               
                 <?php   }  ?>   
                   
            
                
            <tr>
		<td style="width:5%" colspan="1" style="text-align:center"><strong>Total</strong></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:20%"></td>
                <td style="width:8%"></td>
                <td style="width:8%"></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                <td style="width:5%"><strong></strong></td>
                 <td style="width:5%"><strong></strong><?=$tt_qty?></td>
                <td style="width:9%"><strong></strong> </td>  
                <td style="width:10%"><strong><?= number_format(str_replace(',','',$final),$_SESSION['be_decimal'])?></strong></td>
            </tr>
            
      </tbody>
      </table>
            

      <?php  }else{  ?>
                
                
      <!--/////////summmmmmary//////////-->         
                
                            <table class="table table-bordered table-font user_shadow" id="myTable">
				<thead style=" table-layout: inherit;">
                                  
                                  <?php if($reporthead !="")
								  {?>
                                    <tr style=" table-layout: inherit;">
                                  	<th colspan="9">Report - <?=$reporthead?></th>
                                    </tr>
								  <?php }?>
                                    <tr style=" table-layout: inherit;">
                                        <th style="width:5%" class="sortable">Sl no</th>                                       
                                        <th style="width:12%" class="sortable">Category</th>
					<th style="width:12%" class="sortable">Sub category</th>
                                        <th class="sortable" style="width:22%" >Item</th>
                                        <th class="sortable" style="width:10%">Unit Type</th>
                                        <th class="sortable" style="width:10%">Portion/Weight</th>
                                        <th class="sortable" style="width:5%" >Qty</th>
                                         
                                         <th class="sortable" style="width:5%" >Rate</th>     
                                        <th class="sortable" style="width:10%">Total</th>
                                    </tr>
				</thead>
				<tbody>
                    
       <?php
        $final=0;
        $qty=0;
        $qty_final=0;
        $qty_final_ta=0;
        $qty_final_cs=0;
        $i=0;$t=0;
        $p=0;
        if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            
            $sql_combo  =  $database->mysqlQuery(" select combo,comboid,combopackid, sum(qty_all) as qty_all, rate as rate, sum(total) as total,dayclose as dateofsale
from (select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty_all,
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno 
where $string_combo  and bm.bm_status='Closed' 
group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno 
union all 
select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id,  cbd.cbd_combo_qty as qty_all,
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details_ta cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
where $string_combo  and bm.tab_status='Closed'   and bm.tab_mode IN ('TA','HD','CS')
group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno
) x 
group by x.comboid, x.combopackid order by dateofsale  ");
            
     
            
           
            $dt_sale=  array();
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                
                
                ?>
                                     <tr><td style="font-weight:bold ;text-align: left"><span style="background-color:lightgrey"> COMBO</span></td></tr>
                                    <?php
                
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                    $i++;$p++;
                    $final=$final+$result_combo['total'];
                    $qty_final=$qty_final+$result_combo['qty_di'];
                    $qty_final_ta=$qty_final_ta+$result_combo['qty_ta'];
                    $qty_final_cs=$qty_final_cs+$result_combo['qty_cs'];
                    
                    
                   
                    ?>
                                    
                  
               
                   
                   
                <tr id="<?=$i?>">
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$p?></td>
                    <td style="width:12%" colspan="1" style="text-align:center"><strong><?php if($i==1) { ?>** COMBO MENU <?php } ?></strong></td>
                    <td style="width:12%" colspan="1" style="text-align:center"></td>
                    <td style="width:22%" colspan="1" style="text-align:center"><?=substr(strtoupper($result_combo['combo']),0,25)?></td>
                     <td style="width:10%" colspan="1" style="text-align:center"></td>
                    <td style="width:10%" colspan="1" style="text-align:center"></td>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$result_combo['qty_all']?></td>
                     <td style="width:5%" colspan="1" style="text-align:center"></td>
                    <td style="width:10%" colspan="1" style="text-align:center"><?=number_format(str_replace(',','',$result_combo['total']),$_SESSION['be_decimal'])?></td>
                </tr>                      
   
                
                    <?php
                    }
        } } 
        
        
        $dt_sale1=array();
         if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
             
             
            $sql_stw  =  $database->mysqlQuery("
            select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,unitid,unitname,baseunitid,baseunitname,
            sum(qty_all)as qty_all,sum(total)as total , dayclose,rt
            from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all , sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where  bd.bd_count_combo_ordering is NULL and $string $string_addon 
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,weight
                                            
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate as rt, sum(bd.tab_qty) as qty_all , sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD','CS')   and $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id,weight
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory,menuid     ");
                
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){
                  ?>
                 <tr><td style="font-weight:bold ;text-align: left"><span style="background-color:lightgrey"> NORMAL - ADDON</span></td></tr>
                <?php
                    
                    
                    
                    $t=0;$old_cat=""; $old_menu='';$unit_type='';
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                    {  $i++;$p++;
                            if($result_stw['maincategory']!=$old_cat){
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                               $catname=''; 
                            }
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_all'];
                            
                            $qty_all=$qty;
                            
                            $weight=$result_stw['weight'];
                            
                            if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty='';
                             
                            }else{
                                
                              
                               $qty=$result_stw['qty_all'];
                            
                            }
                            
                            
                            
                            if($result_stw['portionid']!=''){
                                $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            }
                            else{
                                  $unit_type=$result_stw['unit_type'] ;
                                if($result_stw['unitid']!=''){
                                    $unit=$result_stw['unitname'] ;
                                  
                                }
                                else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            if($unit_type=='Loose'){
                                
                                    $catname=$result_stw['maincategory'];            
                                    
                                if($result_stw['menuid']==$old_menu){
                                
                                
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty_all);
                                   
                                   $t=$i-1;
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                   
                                   echo '<script>
                                       
                                   
                                        document.getElementById("'.$t.'").style.display="none";
                                      
                                        </script>';
                                   $p=$p-1;
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$qty_all;
                                    $loose_total=$result_stw['total'];
                                    
                                    
                                    
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='';
                                
                            }
                            
                            
                            
//                    if(($unit_type!='Loose' ) ||($unit_type=='Loose' && $result_stw['menuid']!=$old_menu)){        
//                     $old_menu=$result_stw['menuid'];   
               
                
                ?>
                                    
                  
                   
                
                
                
                <tr id="<?=$i?>">
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$p?></td>
                    <td style="width:12%" colspan="1" style="text-align:center"><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td style="width:12%" colspan="1" style="text-align:center"><?=strtoupper($subcatname)?></td>
                    <td style="width:22%" colspan="1" style="text-align:center"><?=substr(strtoupper($menuname),0,25)?></td>
                     <td style="width:10%" colspan="1" style="text-align:center"><?=$unit_type?></td>
                    <td style="width:10%" colspan="1" style="text-align:center"><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$qty?></td>
                    <?php  if($unit_type=='Loose'){ ?>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=($total/$weight)?></td>
                    <?php }else{  ?>
                    <td style="width:5%" colspan="1" style="text-align:center"><?=$result_stw['rt']?></td>
                    <?php  } ?>
                    
                    <td style="width:10%" colspan="1" style="text-align:center"><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></td>
                </tr>                      
   
                
                    <?php
                    
                    $final=$final+$total;
                   
                        $qty_final=$qty_final+$qty;
                    
                  
                        $qty_final_ta=$qty_final_ta+$qty_ta;
                    
                   
                        $qty_final_cs=$qty_final_cs+$qty_cs;
                        
                        
               $tt_qty=0;         
              $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;
                    
}}}?>
                
              
            <tr>
		<td style="width:5%" colspan="1" style="text-align:center"><strong>Total</strong></td>
                <td style="width:12%"></td>
                <td style="width:12%"></td>
                <td style="width:22%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"><strong></strong> </td>
                <td style="width:5%"><strong></strong></td>
                
                <td style="width:10%"><strong><?= number_format(str_replace(',','',$final),$_SESSION['be_decimal'])?></strong></td>
            </tr>
            
      </tbody>
      </table>
      <?php  
            
            
            
            
        }

        }
        
 else if($_REQUEST['type'] == "categorywise_report_cr")
{	
 ?>       
              <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Category wise</strong></th>
      </tr>

      
    </thead>
    </table>     
        
        
        
        
<?php       
        $string="";
	$string.="bm.bm_status = 'Closed'";
        $stringta="";
	$stringta.="tbm.tab_status = 'Closed'";
        $reporthead="";
//        if(isset ($_REQUEST['floorz']))
//	{
//		
//		$floorvalue=$_REQUEST['floorz'];
//                if($floorvalue!="")
//                {
//		
//		$string.="and bm.bm_floorid='".$floorvalue."'";
//                }
//	}
//       
	
					
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $reporthead.="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
					
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $reporthead="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $reporthead="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $reporthead="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $reporthead="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $reporthead="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $reporthead="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $reporthead="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $reporthead="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $reporthead="Last 365 days";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                
                }
                //$reporthead=$st;
	}
        
	
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
				<thead>
                                 <tr>
                                  <th colspan="10">Category Wise Report-<?=$reporthead;?></th>
                                  </tr>
                                  
				<tr>
                                        <th class="sortable">Slno</th>
                                        <th class="sortable">Main Category Name</th>
                                        <th class="sortable">No of Items</th>
                                        <th class="sortable">Qty</th>	
                                        <th class="sortable">Total</th>
                                       
                                        
				</tr>
				</thead>
				<tbody>
                                    
									
            <?php
            $total=0;
            $totalta=0;
            $final=0;
            $i=1;
            $sql_login_combo  =  $database->mysqlQuery(" select sum(items) as noofitems,category,sum(qty) as qty, sum(amount) as amount from (
                                                        select  distinct( count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details cbd left join  tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno where $string group by cbd.cbd_billno union all
                                                        select  distinct(count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details_ta cbd left join  tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno where $stringta group by cbd.cbd_billno)x group by x.category");

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=0;
		  while($result_login_combo  = $database->mysqlFetchArray($sql_login_combo)) 
			{$t++;
                          $total=$total+$result_login_combo['amount'];
                          //$final=$final+$result_login['Final'];                     
                        ?>
                        
                             <tr>
                                <td><?=$i?></td>
                                <td>**<?=strtoupper($result_login_combo['category'])?></td>
                                <td><?=$result_login_combo['noofitems']?></td>
                                <td><?=$result_login_combo['qty'];?></td>
                                <td><?=number_format($result_login_combo['amount'],$_SESSION['be_decimal']);?></td>
                                
                              </tr> 
             <?php $i++;}} 
            $sql_login  =  $database->mysqlQuery(" SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC ");

     
     $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total'];
                          //$final=$final+$result_login['Final'];                     
                        ?>
                        
                             <tr>
                                <td><?=$i?></td>
                                <td><?=strtoupper($result_login['mmy_maincategoryname']);?></td>
                                <td><?=$result_login['noofitems'];?></td>
                                <td><?=$result_login['qty'];?></td>
                                <td><?=number_format($result_login['Total'],$_SESSION['be_decimal']);?></td>
                                
                              </tr> 
             <?php $i++;}} ?>
                              
                              
                              
                              <tr>
	 <td colspan="1" style="text-align:center"><strong>Total</strong>
         </td>
           <td></td>
           <td></td>
            <td></td>
           <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
           
	  </tr>
                           
                           </tbody>
                            </table>
                            
<?php 

} 
else if(($_REQUEST['type']=="cash_settling_report_cr"))
        {
            $from="";
            $to="";
	$string="";
        $stringta="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringsta=" tab_status='Closed' AND tab_mode!='CS' and tab_payment_settled='Y'  AND  ";
        $stringscs=" tab_status='Closed' AND tab_mode='CS' and tab_payment_settled='Y' AND";
        
          $stringsall_tacs=" tab_status='Closed'  and tab_payment_settled='Y' AND";
        //$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
        $string1_strta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
        $string2_strta=" sum(tab_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
        $string3_strta=" sum(tab_netamt) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_chequebankamount) ";
	$string6_str=" sum(cd_amount)";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =" ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =" pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =" pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =" pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
                $string6=" pym_code='credit_person' AND ";
                $string7=" pym_code='complimentary' AND";
	$view_mode='';
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
                $stringta.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
                $stringta.=" tab_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
        
          
          
          
          
	?>
    <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Staff Settlement Report</strong></th>
      </tr>

      
    </thead>
    </table>     
    
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="8">Report - <?=$reporthead?></td>
                                  </tr>
									<tr>
                                       
                                         <th >Date</th>
                                          <th >Staff</th>
                                         <th >Cash</th>
                                         <th >Card</th>
                                        
                                        <th >Credit</th>
                                        <th >Complimentary</th>
                                   
                                    <th >Total</th>
                                  </tr>
								  </thead>
								  <tbody>
                                                                      
        
									
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_billdate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotalta=0;
  $subtotalcs=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcashta=0;
  $totalcashcs=0;
  $totalcouponsta=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalvoucherta=0;
  $totalcheque=0;
   $totalchequeta=0;
  $totalcredits=0;
  $totalcreditsta=0;
  $totalcomplimentary=0;
  $totalcomplimentaryta=0;
  $totalpax=0;
  $totalcreditordebit=0;
  $totalcreditordebitta=0;
  $slno=0;
  $slnota=0;
  $totalta="";
  
  $totalvouchercs=0;
  $totalchequecs=0;
  //$totalcredits=0;
  $totalcreditscs=0;
  $totalcouponscs=0;
  //$totalcomplimentary=0;
  $totalcomplimentarycs=0;
  $totalpax=0;
  //$totalcreditordebit=0;
  $totalcreditordebitcs=0;
  
  $slnocs=0;
  $totalcs="";
  if($_REQUEST['department']=='DI'){
  ?>
 
 
  <?php

  if($_REQUEST['staff']!="")
        {
           
           $sql = $database->mysqlQuery("select distinct bm_dayclosedate,bm_settlement_login from tbl_tablebillmaster where $string_pax and bm_settlement_login='".$_REQUEST['staff']."' ");
        }else{
           $sql = $database->mysqlQuery("select distinct bm_dayclosedate,bm_settlement_login from tbl_tablebillmaster where $string_pax");
        }
  
 
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        
        $total=0;
          $slno++;
        if($result != ""){
            echo "<tr><td>".$slno."</td><td>".$result['bm_dayclosedate']."</td>";
            echo "<td>".$result['bm_settlement_login']."</td>";
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
            
              $dt1= " and bm_settlement_login='".$result['bm_settlement_login']."'";
        }

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	{
                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          
//
	$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $strings $string2 "."$dt $dt1 order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	 
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			?>
            
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            
      
			
		<?php	
	  }else{
              echo "<td>--</td>";
          }
		 	
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
                     
                      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                          
			?>
         
              
          
          <td><?=number_format($result_login5['tot'],$_SESSION['be_decimal'])?></td>
         
           
            <?php 
            
                        
                        }else{
              echo "<td>--</td>";
          }
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
                        
			?>
          
          <td><?=number_format($result_login6['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            
			 $qtycount=0;
		  
			 ?>
                        
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                        
                            <?php
  }
  }
  
  
 
  ?>
    
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
   <td><strong></strong></td>
  <td colspan=""><strong><?=number_format($totalcash,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></strong></td>
  
  <td colspan=""><strong><?=number_format($totalcredits,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td></tr>

  
    <?php }  if($_REQUEST['department']=='TA' || $_REQUEST['department']=='HD' ){ ?>
  

  
    
      
      <?php
      
      if($_REQUEST['staff']!=''){
         $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' ");  
      }else{
      
    $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta");
      }
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnota++;
        if($result != ""){
            echo "<tr><td>".$slnota."</td><td>".$result['tab_dayclosedate']."</td>";
             echo "<td>".$result['tab_settlement_login']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
             $dt1 = "  and  tab_settlement_login='".$result['tab_settlement_login']."'";
        }
  
  
?>
   
  
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringsta $string1 $dt $dt1 order by tab_dayclosedate,tab_time ASC"); 
;
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashta  = $database->mysqlFetchArray($sql_login);
			        
                        $totalcashta=$totalcashta + $result_logincashta['tot'];
                        $totalta= $totalta + $result_logincashta['tot'];            
			$subtotalta =$subtotalta + $result_logincashta['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_logincashta['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsta "." $string2 "."$dt $dt1 order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditta  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitta=$totalcreditordebitta + $result_logincreditta['tot'];  
			$totalta= $totalta + $result_logincreditta['tot'];       
			$subtotalta =$subtotalta + $result_logincreditta['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditta['tot'],$_SESSION['be_decimal'])?></td>
            	
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string6"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");

          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersonta  = $database->mysqlFetchArray($sql_login); 
			 
			
			$totalta= $totalta + $result_logincreditpersonta['tot'];
                        $totalcreditsta= $totalcreditsta + $result_logincreditpersonta['tot'];    
                        $subtotalta =$subtotalta + $result_logincreditpersonta['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersonta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php 
                        
                        }
            else{
              echo "<td>--</td>";
          }
		 		
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string7"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");
                   
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompta  = $database->mysqlFetchArray($sql_login); 
			 
			
			
                        $totalcomplimentaryta= $totalcomplimentaryta + $result_logincompta['tot'];    
                        
			?>
          
          <td><?=number_format($result_logincompta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                       

			 ?>
          
    <td ><strong><?=number_format($totalta,$_SESSION['be_decimal'])?></strong></td>
                           
                            <?php
  }
  }
  
  ?>
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
            <td><strong><?=$reporthead?></strong></td>
            <td> </td>
                
  <td colspan=""><strong><?=number_format($totalcashta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitta,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($totalcreditsta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentaryta,$_SESSION['be_decimal'])?></strong></td>

  <td colspan=""><strong><?=number_format($subtotalta,$_SESSION['be_decimal'])?></strong></td></tr>
  
   <?php }  if($_REQUEST['department']=='CS'){ ?>
  
  
<?php
 if($_REQUEST['staff']!=''){
         $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' ");  
      }else{
      $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta");
      }
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnocs++;
        if($result != ""){
            echo "<tr><td>".$slnocs."</td><td>".$result['tab_dayclosedate']."</td>";
            echo "<td>".$result['tab_settlement_login']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
             $dt1 = "  and  tab_settlement_login='".$result['tab_settlement_login']."'";
            
        }
  
  
?>
   
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringscs $string1 $dt $dt1 order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashcs  = $database->mysqlFetchArray($sql_login);
			         
                        $totalcashcs=$totalcashcs + $result_logincashcs['tot'];
                        $totalcs= $totalcs + $result_logincashcs['tot'];            
			$subtotalcs =$subtotalcs + $result_logincashcs['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_logincashcs['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringscs "." $string2 "."$dt $dt1 order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditcs  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitcs=$totalcreditordebitcs + $result_logincreditcs['tot'];  
			$totalcs= $totalcs + $result_logincreditcs['tot'];       
			$subtotalcs =$subtotalcs + $result_logincreditcs['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditcs['tot'],$_SESSION['be_decimal'])?></td>
            
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string6"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");

          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersoncs  = $database->mysqlFetchArray($sql_login); 
			 
			
			$totalcs= $totalcs + $result_logincreditpersoncs['tot'];
                        $totalcreditscs= $totalcreditscs + $result_logincreditpersoncs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincreditpersoncs['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersoncs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                     	
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string7"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");
                   
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompcs  = $database->mysqlFetchArray($sql_login); 
			 
                        $totalcomplimentarycs= $totalcomplimentarycs + $result_logincompcs['tot'];    
                       
			?>
          
          <td><?=number_format($result_logincompcs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        
			 ?>
          
    <td ><strong><?=number_format($totalcs,$_SESSION['be_decimal'])?></strong></td>
                             
                            <?php
  }
  }
  
  
  ?>
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
   <td><strong></strong></td>
  <td colspan=""><strong><?=number_format($totalcashcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitcs,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($totalcreditscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentarycs,$_SESSION['be_decimal'])?></strong></td>

  
  <td colspan=""><strong><?=number_format($subtotalcs,$_SESSION['be_decimal'])?></strong></td></tr>

  
 
 <?php }if($_REQUEST['department']==''){ 
     
     
     ///di//////

     if($_REQUEST['staff']!=''){
         
  $sql = $database->mysqlQuery("select dayclose,login from (select  bm_dayclosedate as dayclose ,bm_settlement_login as login from tbl_tablebillmaster where $string_pax and bm_settlement_login='".$_REQUEST['staff']."' union all"
          . " select distinct tab_dayclosedate as dayclose,tab_settlement_login as login from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' )x group by dayclose, login ");
     }else{
         $sql = $database->mysqlQuery("select dayclose,login from (select  bm_dayclosedate as dayclose ,bm_settlement_login as login from tbl_tablebillmaster where $string_pax union all"
          . " select distinct tab_dayclosedate as dayclose,tab_settlement_login as login from tbl_takeaway_billmaster where $stringta)x group by  login ");
         
     }
  
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        $total1=0;$total2=0;$total3=0;
        //$total=0;
          $slno++;
          if($result['login']!='' ){ 
          
        if($result != ""){
           
            
            echo "<tr>";
            
            
             if($_REQUEST['staff']!=''){
                 $stringta='';
                 $string_pax='';
            echo "<td>".$result['dayclose']."</td>";
             }else{
                 echo "<td></td>"; 
             }
            
            
            echo "<td>".$result['login']."</td>";
            
             if($_REQUEST['staff']!=''){
             //$dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";    
            $dt = " bm_dayclosedate='".$result['dayclose']."'";
             $dt1 = "  and  bm_settlement_login='".$result['login']."'";
             
             $dt2 = " tab_dayclosedate='".$result['dayclose']."'";
             $dt3 = "  and  tab_settlement_login='".$result['login']."'";
             }
        }

  $sql_login  =  $database->mysqlQuery("select sum(tot) as all_cash,dayclose,login from (select $string1_str as tot ,bm_dayclosedate as dayclose, bm_settlement_login as login from tbl_tablebillmaster left join tbl_paymentmode on "
          . "tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt $dt1 $string_pax  and bm_settlement_login='".$result['login']."'   union all "
          . "select $string1_strta  as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
        from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
          where $stringsall_tacs $string1 $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x where   tot>0 group by  login"); 
  
 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)){
			 
		if($result_login['all_cash'] >0 )	{
                                    
                        $totalcash1=$totalcash1 + $result_login['all_cash'];
                        $total1= $total1 + $result_login['all_cash'];            
			$subtotal1 =$subtotal1 + $result_login['all_cash'];
                        
                         echo "<td>".$result_login['all_cash']."</td>";
                        
          }else{
               echo "<td>0</td>";
          }
          
          }
    }else{
               echo "<td>0</td>";
          }
          

 $sql_login1  =  $database->mysqlQuery("select sum(tot) as allcard,login,dayclose from (select $string2_str as tot,bm_dayclosedate as dayclose, bm_settlement_login as login "
         . "from tbl_tablebillmaster tb left join tbl_paymentmode"
                . " on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank  "
                . "AND $strings $string2 "."$dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string2_strta as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsall_tacs "." $string2 "."$dt2 $dt3  $stringta and tab_settlement_login='".$result['login']."')x  where login='".$result['login']."' and tot>0 group by login "); 
 
 
 
 
 
 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	 
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)){ 
			
                      
                      if($result_login1['allcard'] >0 ){
                         
                      
                      
                      
                        $totalcreditordebit1=$totalcreditordebit1 + $result_login1['allcard'];  
			$total2= $total2 + $result_login1['allcard'];       
			$subtotal2 =$subtotal2 + $result_login1['allcard'];
                        
                        echo "<td>".$result_login1['allcard']."</td>";
                        
                      }else{
                          echo "<td>0</td>";
                      }
			
          }
          } else{
               echo "<td>0</td>";
          }	
				
			$sql_login  =  $database->mysqlQuery(" select sum(tot) as allcredit ,login,dayclose from (select $string6_str as tot,bm_dayclosedate as dayclose,"
                                . " bm_settlement_login as login from tbl_tablebillmaster"
                                . " left join tbl_credit_details tcd"
                                . " on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id"
                                . " where $strings $string6"." $dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string6_str as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsall_tacs $string6"." $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x  where login='".$result['login']."' and tot>0 group by login "); 
                        
                        
                        
                        
                        
                     
                      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login5  = $database->mysqlFetchArray($sql_login)){
			
			
			if($result_login5['allcredit']>0){
                            
                        $totalcredits1=$totalcredits1 + $result_login5['allcredit'];
                        $total3= $total3 + $result_login5['allcredit'];     
                        $subtotal3 =$subtotal3 + $result_login5['allcredit'];
                        
                         echo "<td>".$result_login5['allcredit']."</td>";
                         
                        }else{
                             echo "<td>0</td>";
                        }
			
                        
          } }else{
               echo "<td>0</td>";
          }
				
			$sql_login  =  $database->mysqlQuery("select sum(tot) as allcomp ,login,dayclose from (select $string7_str as tot,bm_dayclosedate as dayclose, "
                                . "bm_settlement_login as login from tbl_tablebillmaster left join tbl_paymentmode on"
                         . " tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string3_strta as tot,tab_dayclosedate as dayclose,
                              tab_settlement_login as login 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsall_tacs $string7"." $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x   where  login='".$result['login']."' and tot>0 group by login "); 
                        
                        
                        
                        
                        
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login6  = $database->mysqlFetchArray($sql_login) ){
			
                  
                  if($result_login6['allcomp']>0){
                      
                  
                        $totalcomplimentary1= $totalcomplimentary1 + $result_login6['allcomp'];  
                        
                         echo "<td>".$result_login6['allcomp']."</td>";
                         
			} else{
                             echo "<td>0</td>";
                        }
                         
			
    }}else{
               echo "<td>0</td>";
          }
	
    
    
     echo "<td>".number_format(($total1+$total2+$total3),$_SESSION['be_decimal'])."</td>";
                         
    }
  
    }}
  
  
  
  
  
  
  
 
  ?>
    
 
    

 
  
  <tr> <td><strong>  TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
   
  <td colspan=""><strong><?=number_format($totalcash1,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit1,$_SESSION['be_decimal'])?></strong></td>
  
  <td colspan=""><strong><?=number_format($totalcredits1,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary1,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($subtotal1+$subtotal2+$subtotal3,$_SESSION['be_decimal'])?></strong></td></tr>

  </tbody>
   </table>

  <?php
    
 }
  
}
else if(($_REQUEST['type']=="cash_settling_report_cr1"))
{
    
?>
<table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Settlement Report</strong></th>
      </tr>

      
    </thead>
    </table>     
        


<?php
$staff=$_REQUEST['staff'];
        $department=$_REQUEST['department'];
	$string="";
        $stringta="";
	$string.=" bm_status='Closed' AND ";
        $stringta.=" tab_status='Closed' AND ";
        $reporthead="";
        $st="";
        $from="";
        $stringmodeta="";
         if($staff!="")
        {
           $string.="bm_settlement_login='".$staff."' AND ";
           $stringta.=" tab_settlement_login='".$staff."' AND ";
                
        }
	if($department!=""&&$department!='DI')
        {
            $stringta.=" tab_mode='".$department."' AND  ";
            
                
        }

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                
                  
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
                if($bydatz!="" && $bydatz!="")
                {
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $st="Last 10 days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $st="Last 30 days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $st="Last 1 MONTH";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="TODAY";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 90 days";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 180 days";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $st="Last  1 Year";
	}

       
	
        $reporthead=$st;
        }
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate ='".$from."'";
                        $stringta.= " tab_dayclosedate='".$from."'";
                        $reporthead="On ".$database->convert_date($from);
	}
	
        }
	
	
	
	
	?>
                <table class="table table-bordered table-font user_shadow" >
                    <thead>
                         
                        
                        <?php if($department==""&& $staff==""){?>
                        <tr>
                            <th colspan="4">Settlement Report - <?=$reporthead?></td>
                        </tr>
                            
                      <tr>
                            <th >STAFF</th>
                            <th >CASH</th>
                            <th >CARD</th>
                             
                            <th >TOTAL</th>
                        </tr>
                        
                       
                        <?php } else{?>
                        <tr>
                            <th colspan="6">Settlement Report  - <?=$staff?> - <?=$reporthead?></td>
                        </tr>
                        
			 <tr>
                             <th >DATE</th>
                            <th >Bill NO</th>
                            <th >CASH</th>
                            <th >CARD</th>
                             <th >COMPLIMENTARY</th>
                            <th >TOTAL</th>
                        </tr>
                        <?php } ?>
                    </thead>
                   
                    
                    <tbody>
                        
								
	
	
<?php
$final=0;

if($department=="" && $staff==""){
  $sql_logincashier  =  $database->mysqlQuery("select login, sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card from ( select distinct(bm_settlement_login) as login ,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string and bm_complimentary='N' and bm_settlement_login!='' group by bm_settlement_login union all
select distinct(tab_settlement_login)as login,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta and tab_complimentary='N' and tab_settlement_login!='' group by tab_settlement_login)x group by login"); 

}
else if($department==""&&$staff!=""){
  $sql_logincashier  =  $database->mysqlQuery("select billno,date,sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card,comp from ( select distinct(bm_settlement_login) as login ,bm_billdate as date, sum((bm_amountpaid)-(bm_amountbalace)) as cash,bm_complimentary as comp,bm_billno as billno,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string group by bm_billno union all
select distinct(tab_settlement_login)as login, tab_date as date,sum((tab_amountpaid)-(tab_amountbalace)) as cash,tab_complimentary as comp,tab_billno as billno,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta group by tab_billno)x group by billno"); 

}


else if($department!=""&& $department=='DI' ){
    $sql_logincashier  =  $database->mysqlQuery("select distinct(bm_settlement_login) as login ,bm_complimentary as comp,bm_billdate as date,bm_billno as billno,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as tot from tbl_tablebillmaster where $string group by bm_billno"); 
}


else if($department!=""&& $department!='DI'){
    $sql_logincashier  =  $database->mysqlQuery("select distinct(tab_settlement_login)as login,tab_complimentary as comp,tab_date as date,tab_billno as billno,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as tot from tbl_takeaway_billmaster where  $stringta  group by tab_billno"); 

}

  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_logincashier  = $database->mysqlFetchArray($sql_logincashier))
       {
           $final= $final + $result_logincashier['tot'];
          if($staff=="" && $department=="" ){ ?>
                        <tr>
                            <td><?=$result_logincashier['login']?></td>
                            <td><?=number_format($result_logincashier['cash'],$_SESSION['be_decimal'])?></td>
                            <td><?=number_format($result_logincashier['card'],$_SESSION['be_decimal'])?></td>
                            <td><?=number_format($result_logincashier['tot'],$_SESSION['be_decimal'])?></td>
                        </tr>
                        
                                 
       <?php    
       }
       
       else{?>
           
                    <tr>
                        <td><?=$result_logincashier['date']?></td>
                        <td><?=$result_logincashier['billno']?></td>
                        <td><?=number_format($result_logincashier['cash'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($result_logincashier['card'],$_SESSION['be_decimal'])?></td>
                        <td><?php if($result_logincashier['comp']=='Y'){ echo number_format($result_logincashier['tot'],$_SESSION['be_decimal']);} else{ echo "0.00";} ?></td>
                        <td><?=number_format($result_logincashier['tot'],$_SESSION['be_decimal'])?></td>
                    </tr>       
           
      <?php }
        }}
        ?>
                     <tr>
                        <td ><strong>TOTAL</strong></td>
                            <td ></td>
                            <td ></td>
                         <?php   if($staff!="" || $department!="" ){ ?>
                         <td></td>
                         <td></td> <?php }?>
                          
                            <td><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
                        </tr>
                    </tbody>
                    </table>
                        
<?php

}
else if(($_REQUEST['type']=="kitchen_wise_report_cr"))
{
 ?>
        <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong>Kitchen Wise Report</strong></th>
      </tr>

      
    </thead>
    </table>


<?php
        
	$string="";
        $stringta="";
        $reporthead="";
        $kitchen='';
        $kitchen=$_REQUEST['kitchen'];
	$string.=" bm.bm_status='Closed' AND ";
        $stringta.=" tbm.tab_status='Closed' AND ";
        if($kitchen!=''){
            $string.=" km.kr_kotcode='".$kitchen."' AND ";
            $stringta.=" km.kr_kotcode='".$kitchen."' AND ";
        }
         
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead.= " From-".$from."- To-".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To".$to."' ";
		}
                else
                {
                    $bydatz=$_REQUEST['bydate'];
//$search="";
         
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}

        }
                ?>
                
                <table class="table table-bordered table-font user_shadow" >
                    <thead>
                         
                        
                       
                        <tr>
                            <th colspan="4">Kitchen Wise Report - <?=$reporthead?></td>
                        </tr>
                            
                      <tr>
                            <th >Sl.No</th>
                            <th >ITEMS</th>
                            <th >QUANTITY</th>
                            <th >AMOUNT</th>
                        </tr>
                      </thead>
                      <tbody>  

                <?php
        $i=0;
        $final=0;
        $quantity=0;
        $oldkitchen='';
        $oldcat='';
    $sql_login  =  $database->mysqlQuery("select kitchen,sum(qty) as qty,menu,category,sum(amount) as tot from( SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
                                          LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where $string group by bd_menuid union all SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
                                           left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where $stringta  group by tbd.tab_menuid)x group by kitchen,menu,category order by kitchen, category"); 
                
   $num_login   = $database->mysqlNumRows($sql_login);
  
	
	  if($num_login)
	  {
              while($result_login  = $database->mysqlFetchArray($sql_login))
                {
                    $final= $final + $result_login['tot'];
                    $quantity= $quantity + $result_login['qty'];
                    if($oldkitchen!=$result_login['kitchen']){
                        $oldkitchen=$result_login['kitchen'];
                    ?>    
                          <tr><td colspan="4" style="color:red"><strong><?=$oldkitchen?>   Kitchen</strong></td></tr>
                    <?php }
                    $i++;
                          
                        if($oldcat!=$result_login['category']){
                        $oldcat=$result_login['category'];
                    ?>    
                          <tr><td colspan="4" style="text-align:left"><strong>CATEGORY :<span><?=$oldcat?></span></strong></td></tr>
                    <?php }
                   ?>  
                          
                          
                          
                          <tr>
                              <td><?=$i?></td>
                              <td><?=$result_login['menu']?></td>
                              <td><?=$result_login['qty']?></td>
                              <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
                          </tr>
                    <?php
			
                } 
          }
          ?>
                          
                          <tr>
                              <td><strong>TOTAL</strong></td>
                              <td></td>
                              <td><?=$quantity?></td>
                              <td><?=number_format($final,$_SESSION['be_decimal'])?></td>
                          </tr>
<?php                          
}
else if(($_REQUEST['type']=="discount_report_cr"))
{
    
 ?>
   <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong> CONSOLIDATED DISCOUNT REPORT </strong></th>
      </tr>

      
    </thead>
    </table>
<?php                          
	$string="";
        $stringta="";
        $mode=$_REQUEST['department'];
        
	if($_REQUEST['item_disc']!='true'){  
        
    $string=" bm.bm_status='Closed' AND bm.bm_discountvalue>0 and  ";
    $stringta=" tbm.tab_status='Closed' AND  tbm.tab_discountvalue>0 and ";
    }else{
        
         $string=" bm.bm_status='Closed' and  ";
         $stringta=" tbm.tab_status='Closed'  and ";
    }
        
	$reporthead="";
	

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                         $reporthead.= " From".$from."- To".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                         $reporthead.= " From".$from."- To".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                         $reporthead.= " From".$from."- To".$to."' ";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $reporthead="Yester Day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $reporthead="Last 30 days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $reporthead="Last 1 Month";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $reporthead="Today";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $reporthead="Last 3 Months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $reporthead="Last 6 Months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $reporthead="Last 1 Year";
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=" on--".$from;
	}
		
	
	}
	
                    
                                                                     
	  if($_REQUEST['item_disc']!='true'){  

          if($mode==''){
           
            $sql_login  =  $database->mysqlQuery("select * from ( select bm.bm_login as login,bm.bm_dayclosedate as dayclose,bm.bm_discountlabel as disc_per,
            bm.bm_billno as bill,bm.bm_discountvalue as discount, 
            bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm where $string union all
            select  tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_discount_label as disc_per,
            tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
            where $stringta ) x order by mode"); 
            
            }
            
            else if($mode=='DI'){
                
            $sql_login  =  $database->mysqlQuery(" select bm.bm_login as login,bm.bm_dayclosedate as dayclose,bm.bm_discountlabel as disc_per,
                bm.bm_billno as bill,bm.bm_discountvalue as discount, 
                bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm where $string "); 
            }
            else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
                
            $sql_login  =  $database->mysqlQuery(" select  tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_discount_label as disc_per,
                tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, 
                tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm where $stringta and tab_mode='".$mode."' order by  tbm.tab_mode"); 
            }
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
            ?>
                        <table class="table table-bordered table-font user_shadow" >
                        <thead>
                            <tr>
                                <th colspan="7"> Consolidated Discount Report- <?=$reporthead?></td>
                            </tr>
                            <tr>
                              <th >Sl</th>
                        <th >Date</th>
                        <th >Bill</th>
                         <th >Login</th>
                        <th >Mode</th>
                        <th >Bill Amount</th>
                        <th >Discount</th>
                                
                            </tr>
                    </thead>
                    <tbody>
         <?php  $i=0; 
                $total=0;
                $discount=0;
		while($result_login  = $database->mysqlFetchArray($sql_login)){
                    $i++;
                    $total=$total+$result_login['amount'];
                    $discount=$discount+$result_login['discount'];
                  ?>
                    <tr>
                             <td ><?=$i?></td>
                        <td ><?=$result_login['dayclose'].' '.$result_login['time']?></td>   
                        <td ><?=$result_login['bill']?></td>
                        <td ><?=$result_login['login']?></td>
                        <td ><?=$result_login['mode']?></td>
                        <td ><?=$result_login['amount']?></td>
                        <td > <?=$result_login['discount']?> &nbsp;&nbsp;  <?=$result_login['disc_per']?></td>
                            </tr>                                             
                <?php     
                 }  
                
	  
          ?>    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
                    <td><strong><?=number_format($discount,$_SESSION['be_decimal'])?></strong></td>
                </tr>
                  <?php           
              }
         else
	  {
		  
                            echo '<p id="rcord" style="text-align:center;color:red; font-weight:bold; font-size:15px">No records to display</p>';
                            echo '<script> $("#rcord").delay(1000).fadeOut("slow")</script>';
                            
                        
	  }
          ?>
                        </tbody>
                      </table>
 <?php  
 }else{ 
     
     
     if($_REQUEST['item_disc_type']!=''){  
        
            $string.="  and tds.bd_discount_id='".$_REQUEST['item_disc_type']."'   ";
            $stringta.="  and tks.tbd_discount_id='".$_REQUEST['item_disc_type']."'  ";

    }else{
        
         $string.="    ";
         $stringta.="    ";
    
    }
     
     
     
     ///////////item wise offer/////
 
  if($mode==''){
      
    
      
    $sql_login  =  $database->mysqlQuery("select * from ( select tbld.bd_org_rate as org,tbld.bd_rate as rate,tbld.bd_qty as qty,
                 tds.bd_discount as disc,tm.mr_menuname as menu,
                 tds.bd_discount_remarks as discname, bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,
                 'DI' AS mode FROM tbl_tablebillmaster bm
                left join tbl_tablebill_item_discount tds on tds.bd_billno=bm.bm_billno left join tbl_menumaster tm on
                tm.mr_menuid=tds.bd_menuid left join tbl_tablebilldetails tbld on tbld.bd_billno=bm.bm_billno
                where tds.bd_discount>0 and  $string  group by bill,menu,discname union all
                    
                select tkld.tab_org_rate as org,tkld.tab_rate as rate,tkld.tab_qty as qty,tks.tbd_discount as disc,ttm.mr_menuname as menu,
                tks.tbd_discount_remarks as discname,tbm.tab_billno as bill,
                tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                left join tbl_takeaway_item_discount tks on tks.tbd_billno=tbm.tab_billno left join tbl_menumaster ttm on
                ttm.mr_menuid=tks.tbd_menuid left join tbl_takeaway_billdetails tkld on tkld.tab_billno=tbm.tab_billno
                where tks.tbd_discount>0 and $stringta group by bill,menu,discname ) x order by bill,menu,discname "); 
            }
    else if($mode=='DI'){
        $sql_login  =  $database->mysqlQuery("select tbld.bd_org_rate as org,tbld.bd_rate as rate,tbld.bd_qty as qty,
                 tds.bd_discount as disc,tm.mr_menuname as menu,
                 tds.bd_discount_remarks as discname, bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,
                 'DI' AS mode FROM tbl_tablebillmaster bm
                left join tbl_tablebill_item_discount tds on tds.bd_billno=bm.bm_billno left join tbl_menumaster tm on
                tm.mr_menuid=tds.bd_menuid left join tbl_tablebilldetails tbld on tbld.bd_billno=bm.bm_billno
                where tds.bd_discount>0 and  $string  group by bill,menu,discname "); 
            }
    else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
        $sql_login  =  $database->mysqlQuery(" select tkld.tab_org_rate as org,tkld.tab_rate as rate,tkld.tab_qty as qty,tks.tbd_discount as disc,ttm.mr_menuname as menu,
                tks.tbd_discount_remarks as discname,tbm.tab_billno as bill,
                tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                left join tbl_takeaway_item_discount tks on tks.tbd_billno=tbm.tab_billno left join tbl_menumaster ttm on
                ttm.mr_menuid=tks.tbd_menuid left join tbl_takeaway_billdetails tkld on tkld.tab_billno=tbm.tab_billno
                where tks.tbd_discount>0 and $stringta and tab_mode='".$mode."' group by bill,menu,discname"); 
            }
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	 ?>
            <table class="table table-bordered table-font user_shadow" >
            <thead>
                    <tr>
                        <th colspan="11"> Consolidated Discount Report- <?=$reporthead?></td>
                    </tr>
                    <tr>
                        <th >Sl</th>
                        <th >Bill No</th>
                        <th >Discount Name</th>
                        <th >Item</th>
                        <th >Qty</th>
                        <th >Rate Before</th>
                        <th >Item Discount</th>
                        <th >Rate After</th>
                        <th >Total</th>
                        <th >Total Discount</th>
                        <th >Final Total</th>
                    </tr>
            </thead>
            <tbody>
         <?php  $i=0; 
                $total=0;
                $discount=0;
                if($num_login)
                {
		while($result_login  = $database->mysqlFetchArray($sql_login)){
                    $i++;
                    $total=$total+$result_login['amount'];
                    $discount=$discount+($result_login['disc']*$result_login['qty']);
                    
                  ?>
                    <tr>
                        <td ><?=$i?></th>
                        <td ><?=$result_login['bill']?></td>
                         <td ><?=$result_login['discname']?></td>
                          <td ><?=$result_login['menu']?></td>
                        <td><?=$result_login['qty']?></td>
                         <td><?=$result_login['org']?></td>
                          <td><?=$result_login['disc']?></td>
                        <td><?=$result_login['rate']?></td>
                        
                        <td ><?=$result_login['org']*$result_login['qty']?></td>
                        
                        <td ><?=$result_login['disc']*$result_login['qty']?></td>
                        
                         <td ><?=$result_login['rate']*$result_login['qty']?></td>
                       
                        </tr>                                             
                <?php     
                 }  
          ?>    
                <tr>
                    <td><strong>Total</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                       <td></td>
                    <td><strong><?=number_format($discount,$_SESSION['be_decimal'])?></strong></td>
                      <td></td>
                </tr>
                  <?php           
              }
         else
	  { ?>
        <tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr>             
	<?php  }?>
        </tbody></table>
 
 
 <?php
 }
 
}
else if(($_REQUEST['type']=="complimentary_cr"))
{
     //echo "haiii";
?>
                          
        <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="17"><strong> CONSOLIDATED COMPLIMENTARY REPORT </strong></th>
      </tr>

      
    </thead>
    </table>
<?php                          
	$string="";
        $stringta="";
        $mode=$_REQUEST['department'];
        
	$string.=" bm.bm_status='Closed' AND bm.bm_complimentary='Y' and   ";
        $stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary='Y' and  ";
	
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
        else{
           
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
                $stringta.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
                
		$reporthead="On ".$database->convert_date($cur);	
	
        }

	}

		
	
	}
       
                      
	


        if($mode==''){
            
        $sql_login  =  $database->mysqlQuery("select * from (select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_complimentaryremark as remarks,tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta union all
        select bm.bm_login as login,bm.bm_dayclosedate as dayclose, bm.bm_complimentaryremark as remarks,bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string )x order by x.mode asc "); 

      
        }
        else if($mode=='DI'){
            
            $sql_login  =  $database->mysqlQuery(" select bm.bm_login as login,bm.bm_dayclosedate as dayclose, bm.bm_complimentaryremark as remarks,bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string "); 
        }
        else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
            
          $sql_login  =  $database->mysqlQuery(" select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose, tbm.tab_complimentaryremark as remarks,tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta and tbm.tab_mode='".$mode."' ");   
        }
	$num_login   = $database->mysqlNumRows($sql_login);
          
          if($num_login)
	  {
	  ?>
                      <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="7">Consolidated Complimentary Report</th>
                            </tr>
                            <tr>
                                <th class="sortable">Sl</th>               
                                <th class="sortable">Date</th>               
                                <th class="sortable">Bill No</th>
                                <th class="sortable">Login</th>               
				<th class="sortable">Mode</th>
                                <th class="sortable">Remarks</th>
                                <th class="sortable">Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>		
	  <?php
          $i=0;
          $amount=0;
              while($result_login= $database->mysqlFetchArray($sql_login)){
                  $i++;
                  $amount=$amount+$result_login['amount'];
             ?>     
                    <tr>
                        <td style="font-weight:bold" class="sortable"><?=$i?></td> 
                         <td style="font-weight:bold" class="sortable"><?=$result_login['dayclose']?></td>
                        <td style="font-weight:bold" class="sortable"><?=$result_login['bill']?></td>
                         <td style="font-weight:bold" class="sortable"><?=$result_login['login']?></td>
			<td style="font-weight:bold" class="sortable"><?=$result_login['mode']?></td>
                        <td style="font-weight:bold" class="sortable"><?=$result_login['remarks']?></td>
                        <td style="font-weight:bold" class="sortable"><?=number_format($result_login['amount'],$_SESSION['be_decimal'])?></td>
                                
                    </tr>
                  
           <?php    if($_REQUEST['comp_item_wise']=='true' && ($mode=='DI' || $mode=='')){
           
           $ct=1;  
           $sql_login1  =  $database->mysqlQuery("select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total,bd_rate as rate,
               CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),
               COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_billno='".$result_login['bill']."' 
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight  ");   
           
          
            $num_login1   = $database->mysqlNumRows($sql_login1); 
             if($num_login1)
            {
            while($result_login1= $database->mysqlFetchArray($sql_login1)){
               
               
                
             ?>     
                <tr>
                    <td class="sortable"><?=$ct++?></td>   
                     <td class="sortable"></td>   
                    <td class="sortable">* <?=$result_login1['menu']?></td>
                      <td class="sortable"></td>   
		      <td class="sortable">Qty: <?=$result_login1['qty']?></td>
                    <td class="sortable"> Rate : <?=number_format($result_login1['rate'],$_SESSION['be_decimal'])?></td>
                    <td class="sortable"><?=number_format($result_login1['total'],$_SESSION['be_decimal'])?></td>
                </tr>     
                 
            <?php }  ?>
            
            <tr>
                    <td class="sortable"></td>                                       
                    <td class="sortable"></td>
		      <td class="sortable"></td>
                    <td class="sortable"> </td>
                    <td class="sortable"></td>
                      <td class="sortable"></td>   
                        <td class="sortable"></td>   
                </tr>    
            
            <?php } } 
                
                
                
          if($_REQUEST['comp_item_wise']=='true' && ( ($mode=='TA'|| $mode=='CS'|| $mode=='HD') || $mode=='')){
           
           $ct=1;  
           
           
           $sql_login1  =  $database->mysqlQuery("select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, 
               CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),
               COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid,tbd.tab_rate as rate
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_billno='".$result_login['bill']."' 
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight ");
   
           
          
            $num_login1   = $database->mysqlNumRows($sql_login1); 
             if($num_login1)
            {
            while($result_login1= $database->mysqlFetchArray($sql_login1)){
               
               
                
             ?>     
                <tr>
                    <td class="sortable"><?=$ct++?></td>        
                      <td class="sortable"></td>   
                    <td class="sortable">* <?=$result_login1['menu']?></td>
                      <td class="sortable"></td>   
		      <td class="sortable">Qty: <?=$result_login1['qty']?></td>
                    <td class="sortable"> Rate : <?=number_format($result_login1['rate'],$_SESSION['be_decimal'])?></td>
                    <td class="sortable"><?=number_format($result_login1['total'],$_SESSION['be_decimal'])?></td>
                </tr>     
                 
            <?php }  ?>
            
            <tr>
                    <td class="sortable"></td>                                       
                    <td class="sortable"></td>
                    <td class="sortable"></td>                                       
                    <td class="sortable"></td>
		      <td class="sortable"></td>
                    <td class="sortable"> </td>
                    <td class="sortable"></td>
                </tr>    
            
            <?php } } ?>             
                            
                            
                            
                            
                            
         <?php  } ?>
                    <tr>
                        <td class="sortable"><strong>Total</strong></td>                                       
                        <td class="sortable"></td>
			<td class="sortable"></td>
                        <td class="sortable"></td>
                        <td class="sortable"></td>
                        <td class="sortable"></td>
                        <td class="sortable"><strong><?=number_format($amount,$_SESSION['be_decimal'])?></strong></td>
                                
                    </tr>
          <?php           
              }
         else
	  {
		  
                            echo '<p id="rcord" style="text-align:center;color:red; font-weight:bold; font-size:15px">No records to display</p>';
                            echo '<script> $("#rcord").delay(1000).fadeOut("slow")</script>';
                            
                        
	  }
          ?>
                        </tbody>
                      </table>
<?php
}
else if(($_REQUEST['type']=="consolidated_cancel_report"))
{
    
    ?>
    <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="4">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="4"><strong> Item  Cancel Report </strong></th>
      </tr>

      
    </thead>
    </table>
        <?php
	$string="";
        $stringta="";
        $mode="";
        $reporthead="";
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
            $mode1=$mode;
        }
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	else
	{
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
	{
            $string.=" ch_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta.=" tc_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $reporthead="Yesterday";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $reporthead="Last 30 days";
	}
	else if($bydatz=="Last1month")
	{
            $string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            $reporthead="Last 1 Month";
	}
	else if($bydatz=="Today")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $reporthead="Today";
	}
        else if($bydatz=="Last90days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead="Last 90 days";
	}
        else if($bydatz=="Last180days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $reporthead="Last 6 Months";
	}
        else if($bydatz=="Last365days")
	{
		$string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $reporthead="Last 1 Year";
	}

	}
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ch_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tc_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }
	
	?>
                    <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="10"><?=$mode1?>--Item Cancel Report  - <?=$reporthead?></th>
                            </tr>
                            <tr>
                                
                               <th class="sortable">Bill/Order No</th>
                                <th class="sortable">Kot/Bill No</th>
                                <th class="sortable">Menu</th>
                               <th class="sortable">Cancelled Qty</th>
                                <th class="sortable">Cancelled Rate</th>
                                 <th class="sortable">Cancelled Total</th>
                                <th class="sortable">Cancelled By</th>
                                  <th class="sortable">Login </th>
                                 <th class="sortable">Cancelled Time</th>
                                  <th class="sortable">Cancelled Reason</th>
                                
                            </tr>
                        </thead>
                        <tbody>
        <?php
          $rate=0;   $rate1=0; $tot_rt=0; $tot_rt1=0;
        $qtyall=0; $tot_rt_all=array();
       $rate11=array();
        $bill_order=array();
        $cancel_qty=array();
        $cancel_by  =array();     
         $cancel_time  =array();
         $cancel_reason=  array();
         $menu_all=  array();
         $cancel_kotno=array();
         $log_by_all = array();
         
         
         
         
          if($mode==''){
              
              $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, oc.*,ts.ser_firstname,cr_reason FROM tbl_combo_ordering_details cod 
                                                    left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                    left join tbl_tableorder  o on cod.cod_count_combo_ordering=o.ter_count_combo_ordering,tbl_tableorder_changes oc 
                                                    left join tbl_staffmaster ts on ts.ser_staffid=oc.ch_cancelledby_careof 
                                                    left join tbl_cancellation_reasons tcr on tcr.cr_id=oc.ch_cancelledreason
                                                    where $string and oc.ch_orderno = o.ter_orderno and oc.ch_orderslno = o.ter_slno
                                                    group by cod.cod_count_combo_ordering,cod.cod_orderno, oc.ch_kot_cancel_id order by CAST(oc.ch_kot_cancel_id AS UNSIGNED) asc"); 
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    $bill_order[]=$result_combo['ch_orderno'];
                    $cancel_qty[]=$result_combo['ch_combo_pack_cancelled_qty'];
                    $cancel_by[]=$result_combo['ser_firstname'];
                    $cancel_time[]=$result_combo['ch_entrydate'];
                    $menu_all[]=$result_combo['combo'];
                    $cancel_reason[]=$result_combo['cr_reason'];
                    $cancel_kotno[]=$result_combo['ch_kotno'];
                    $log_by_all[]=$result_combo['ch_cancelledlogin'];
                    
                }
            }
            
            $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, ci.*,ts.ser_firstname,cr_reason,bm.tab_mode as mode
                                                FROM tbl_combo_bill_details_ta cbd 
                                                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                left join tbl_takeaway_billdetails tb on tb.tab_count_combo_ordering=cbd.cbd_count_combo_ordering
                                                left join  tbl_takeaway_billmaster bm on bm.tab_billno = tb.tab_billno, tbl_takeaway_cancel_items ci 
                                                left join tbl_staffmaster ts on ts.ser_staffid=ci.tc_cancelled_by
                                                left join tbl_cancellation_reasons tcr on tcr.cr_id=ci.tc_reason
                                                where  $stringta  and ci.tc_billno=tb.tab_billno and ci.tc_bill_slno=tb.tab_slno 
                                                group by cbd.cbd_count_combo_ordering,cbd.cbd_billno, ci.tc_cancel_id order by CAST(ci.tc_cancel_id  AS UNSIGNED) asc"); 
            
            
            
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    $bill_order[]=$result_combo['tc_billno'];
                    
                    $cancel_qty[]=$result_combo['tc_combo_pack_cancelled_qty'];
                    $cancel_by[]=$result_combo['ser_firstname'];
                    $cancel_time[]=$result_combo['tc_cancelled_time'];
                    $menu_all[]=$result_combo['combo'];
                    $cancel_reason[]=$result_combo['cr_reason'];
                    $log_by_all[]=$result_combo['tc_cancelled_login']; 

                    if($result_combo['tc_cancel_kotno']!=""){
                        $cancel_kotno[]=$result_combo['tc_cancel_kotno'];
                    }else{
                        $cancel_kotno[]=$result_combo['tc_billno']; 
                    }
                    
                }
            }
            
            
            
              $sql_login1  =  $database->mysqlQuery("select ch_cancelledlogin,ch_kotno,ch_entrydate,ch_cancelled_qty,ch_orderno,ch_kot_cancel_id,"
                      . " mr_menuname,ser_firstname,cr_reason,ter_rate from tbl_tableorder_changes tbo left join tbl_staffmaster ts on "
                      . " ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join"
                      . " tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on "
                      . " tm.mr_menuid=to1.ter_menuid where $string and tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc"); 
           
            $num_login1   = $database->mysqlNumRows($sql_login1);
            if($num_login1){
                while($result_login1= $database->mysqlFetchArray($sql_login1))
                {

                $cancelid1=$result_login1['ch_kot_cancel_id'];
                 $bill_order1=$result_login1['ch_orderno'];
                  $cancel_qty1=$result_login1['ch_cancelled_qty'];
                   $cancel_by1=$result_login1['ser_firstname'];
                   $cancel_time1=$result_login1['ch_entrydate'];
                   $cancel_reason1=$result_login1['cr_reason'];
                   $menu=$result_login1['mr_menuname'];
                   $kotno=$result_login1['ch_kotno'];
                   $log_by=$result_login1['ch_cancelledlogin'];
                   
                   $rate=$result_login1['ter_rate'];
                 
                 $tot_rt=$tot_rt+($rate*$cancel_qty1); 
                   
                 ?>                         
                         <tr>
                                <td ><?=$bill_order1?></td>
                                <td ><?=$kotno?></td>
                                <td ><?=$menu?></td>
				 <td ><?=$cancel_qty1?></td>
                                 <td ><?=$rate?></td>
                                 <td ><?=$rate*$cancel_qty1?></td>
                                <td ><?=$cancel_by1?></td>
                                <td><?=$log_by?></td>
                                <td ><?=$cancel_time1?></td>
                                <td ><?=$cancel_reason1?></td>
                                
                            </tr>          
                           
                            <?php
               
            }
	  }
        
        
        $sql_loginta1  =  $database->mysqlQuery("select tc_cancel_kotno,tc_cancelled_login,tc_cancelled_time,tc_cancel_qty,tc_billno,tc_cancel_id,"
                . " mr_menuname,ser_firstname,cr_reason,tab_rate from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on "
                . " ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join "
                . " tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster tm"
                . " on tm.mr_menuid=tbdw.tab_menuid where $stringta and  tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc"); 

        $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	if($num_loginta1)
	  {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                  
                 $cancelid2=$result_loginta1['tc_cancel_id'];
                 $bill_order2=$result_loginta1['tc_billno'];
                 $cancel_qty2=$result_loginta1['tc_cancel_qty'];
                 $cancel_by2=$result_loginta1['ser_firstname'];
                 $cancel_time2=$result_loginta1['tc_cancelled_time'];
                 $cancel_reason2=$result_loginta1['cr_reason'];
                 $menu1=$result_loginta1['mr_menuname'];
                 $log_by1=$result_loginta1['tc_cancelled_login'];
                   
                   
                 if($result_loginta1['tc_cancel_kotno']!=""){
                      $kotno1=$result_loginta1['tc_cancel_kotno'];
                 }else{
                      $kotno1=$result_loginta1['tc_billno'];
                 }
                 
                  $rate1=$result_loginta1['tab_rate'];
                 
                  $tot_rt1=$tot_rt1+($rate1*$cancel_qty2);  
                 
              ?>
                           
                            <tr>
                                <td ><?=$bill_order2?></td>
                                <td ><?=$kotno1?></td>
                                <td ><?=$menu1?></td> 
				<td ><?=$cancel_qty2?></td>
                                <td ><?=$rate1?></td>
                                 <td ><?=$rate1*$cancel_qty2?></td>
                                <td ><?=$cancel_by2?></td>
                                <td ><?=$log_by1?></td>
                                <td ><?=$cancel_time2?></td>
                                <td ><?=$cancel_reason2?></td>
                            </tr>     
                            
                            <?php
               
            }
	  }
       
          ?>
                    
                    
                    
                   <tr>
                        <td >Total</td>
                        <td ></td>
                        <td ></td> 
			<td ></td>
                        <td ></td>
                        <td ><?=$tot_rt+$tot_rt1?></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                    </tr>               
          
          
          
        <?php
          
          
          
          
          }
          
          
          
          
          
        if($mode=='DI'){
            
            
            
            $sql_dicombo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, oc.*,ts.ser_firstname,cr_reason FROM tbl_combo_ordering_details cod 
                                                    left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                    left join tbl_tableorder  o on cod.cod_count_combo_ordering=o.ter_count_combo_ordering,tbl_tableorder_changes oc 
                                                    left join tbl_staffmaster ts on ts.ser_staffid=oc.ch_cancelledby_careof 
                                                    left join tbl_cancellation_reasons tcr on tcr.cr_id=oc.ch_cancelledreason
                                                    where $string and oc.ch_orderno = o.ter_orderno and oc.ch_orderslno = o.ter_slno
                                                    group by cod.cod_count_combo_ordering,cod.cod_orderno, oc.ch_kot_cancel_id order by CAST(oc.ch_kot_cancel_id AS UNSIGNED) asc"); 
            $num_dicombo   = $database->mysqlNumRows($sql_dicombo);
            if($num_dicombo){
                while($result_dicombo= $database->mysqlFetchArray($sql_dicombo)){    
                    $bill_order[]=$result_dicombo['ch_orderno'];
                    $cancel_qty[]=$result_dicombo['ch_combo_pack_cancelled_qty'];
                    $cancel_by[]=$result_dicombo['ser_firstname'];
                    $cancel_time[]=$result_dicombo['ch_entrydate'];
                    $menu_all[]=$result_dicombo['combo'];
                    $cancel_reason[]=$result_dicombo['cr_reason'];
                    $cancel_kotno[]=$result_dicombo['ch_kotno'];
                    $log_by_all[]=$result_dicombo['ch_cancelledlogin'];
                    
                }
            }
	$sql_login  =  $database->mysqlQuery("select ch_cancelledlogin,ch_kotno,ch_entrydate,ch_cancelled_qty,ch_orderno,ser_firstname,mr_menuname,"
                . " cr_reason,ter_rate from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left join "
                . " tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno "
                . " and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string and "
                . " tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc"); 
      
        
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
               $bill_order[]=$result_login['ch_orderno'];
                $cancel_qty[]=$result_login['ch_cancelled_qty'];
                 $cancel_by[]=$result_login['ser_firstname'];
                 $cancel_time[]=$result_login['ch_entrydate'];
                  $menu_all[]=$result_login['mr_menuname'];
                  $cancel_reason[]=$result_login['cr_reason'];
                  $cancel_kotno[]=$result_login['ch_kotno'];
                   $log_by_all[]=$result_login['ch_cancelledlogin'];
                   $rate11[]=$result_login['ter_rate'];
                 ?>
                            
                      
                           
                            <?php
               
            }
	  }
        }
        if($mode=='TA'||$mode=='HD'||$mode=='CS'){
            
          $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, ci.*,ts.ser_firstname,cr_reason,bm.tab_mode as mode
                                                FROM tbl_combo_bill_details_ta cbd 
                                                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                left join tbl_takeaway_billdetails tb on tb.tab_count_combo_ordering=cbd.cbd_count_combo_ordering
                                                left join  tbl_takeaway_billmaster bm on bm.tab_billno = tb.tab_billno, tbl_takeaway_cancel_items ci 
                                                left join tbl_staffmaster ts on ts.ser_staffid=ci.tc_cancelled_by
                                                left join tbl_cancellation_reasons tcr on tcr.cr_id=ci.tc_reason
                                                where   bm.tab_mode='$mode' and $stringta  and ci.tc_billno=tb.tab_billno and ci.tc_bill_slno=tb.tab_slno 
                                                group by cbd.cbd_count_combo_ordering,cbd.cbd_billno, ci.tc_cancel_id order by CAST(ci.tc_cancel_id  AS UNSIGNED) asc"); 
//                                  
          
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    $bill_order[]=$result_combo['tc_billno'];
                    $cancel_qty[]=$result_combo['tc_combo_pack_cancelled_qty'];
                    $cancel_by[]=$result_combo['ser_firstname'];
                    $cancel_time[]=$result_combo['tc_cancelled_time'];
                    $menu_all[]=$result_combo['combo'];
                    $cancel_reason[]=$result_combo['cr_reason'];
                    $log_by_all[]=$result_combo['tc_cancelled_login']; 

                    if($result_combo['tc_cancel_kotno']!=""){
                        $cancel_kotno[]=$result_combo['tc_cancel_kotno'];
                    }else{
                        $cancel_kotno[]=$result_combo['tc_billno']; 
                    }
                    
                }
            }  
            
            
        $sql_loginta  =  $database->mysqlQuery("select tc_cancel_kotno,tc_cancelled_login,tc_cancelled_time,tc_cancel_qty,tc_billno,mr_menuname,"
                . " ser_firstname,cr_reason ,tab_rate from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on ts.ser_staffid=tbc.tc_cancelled_by "
                . " left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join tbl_takeaway_billdetails tbdw on "
                . " tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster tm on tm.mr_menuid=tbdw.tab_menuid "
                . " where tc_mode='$mode' and $stringta and tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc "); 
        
        $num_loginta   = $database->mysqlNumRows($sql_loginta);
	if($num_loginta)
	  {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                  
                $bill_order[]=$result_loginta['tc_billno'];
                $cancel_qty[]=$result_loginta['tc_cancel_qty'];
                $cancel_by[]=$result_loginta['ser_firstname'];
                $cancel_time[]=$result_loginta['tc_cancelled_time'];
                $menu_all[]=$result_loginta['mr_menuname'];
                $cancel_reason[]=$result_loginta['cr_reason'];
                $log_by_all[]=$result_loginta['tc_cancelled_login']; 
                 $rate11[]=$result_loginta['tab_rate'];  
                     if($result_loginta['tc_cancel_kotno']!=""){
                 $cancel_kotno[]=$result_loginta['tc_cancel_kotno'];
            }else{
                $cancel_kotno[]=$result_loginta['tc_billno']; 
            }
              ?>
                        
                            <?php
               
            }
	  }
        }
        
        for ($i=0;$i<count($bill_order);$i++){
            
          $tot_rt_all[]=($rate11[$i]*$cancel_qty[$i]);    
            
                  ?>  
                            
                           <tr>
                               
                                <td ><?=$bill_order[$i]?></td>
                               <td ><?= $cancel_kotno[$i]?></td>
                                <td><?=$menu_all[$i]?></td>
				<td ><?=$cancel_qty[$i]?></td>
                                <td ><?=$rate11[$i]?></td>
            
            <td ><?=$rate11[$i]*$cancel_qty[$i]?></td>
                                <td ><?=$cancel_by[$i]?></td>
                                  <td ><?=$log_by_all[$i]?></td>
                               
                                <td ><?=$cancel_time[$i]?></td>
                                 <td ><?=$cancel_reason[$i]?></td>
                            </tr> 
        <?php
        }
        ?>
                            
                            
             <?php if($i>0){ ?>
        
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td ></td> 
			<td ></td>
                        <td ></td>
                        <td ><?=array_sum($tot_rt_all)?></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                    </tr>  
                    
         <?php } ?>                
                            
                          
                        </tbody>
                    </table>
<?php

}


else if(($_REQUEST['type']=="consolidated_payment_cr"))
{
	$string="";
        $stringta="";
        $string1="";
        $stringta1="";
        $mode="";
        $reporthead="";
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
           $mode1=$mode;
        }
        
           if($_REQUEST['payment']=="1")
	    {
                    $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0)  and";
		    $stringta=" ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and t.tab_status='closed' and ((t.tab_amountpaid-t.tab_amountbalace) > 0) and ";
                    $fields="<th class='sortable'>Cash Amount</th>";
                    $fields_dummy="<td></td>";
	   }else if($_REQUEST['payment']=="2")
	  {
		$string = " pym_code='credit' and bm_status='closed' and   ";
                $stringta = " pym_code='credit'  and tab_status='closed' and   ";
		$fields="<th class='sortable'>Bank</th>";
                $fields.="<th class='sortable'>Card Amount</th>";
		  $fields_dummy="<td></td>";
                    $fields_dummy.="<td></td>";
                    
                    if($_REQUEST['bank_name']!=''){
            
             $string.= "   bm_transcbank ='".$_REQUEST['bank_name']."' and  ";
            
             $stringta.="   tab_transcbank ='".$_REQUEST['bank_name']."' and ";
             
            }
                    
                    
                    
	  }else if($_REQUEST['payment']=="3")
	{
		$string = " pym_code='coupon' and bm_status='closed' and ";
                $stringta = " pym_code='coupon' and tab_status='closed' and ";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
                  $fields_dummy="<td></td>";
                    $fields_dummy.="<td></td>";
                      $fields_dummy.="<td></td>";
	}else if($_REQUEST['payment']=="4")
	{
		$string = " pym_code='voucher' and bm_status='closed' and";
                $stringta= " pym_code='voucher' and tab_status='closed' and";
		$fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['payment']=="5")
	{
		
		$string = " pym_code='cheque' and bm_status='closed' and";
                $stringta = " pym_code='cheque' and tab_status='closed' and";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
                $fields_dummy="<td></td>";
          $fields_dummy.="<td></td>";
            $fields_dummy.="<td></td>";
	}  
	else if($_REQUEST['payment'] =="6")
	{
		$string = " bm_paymode='6' and bm_status='closed' and";
                $stringta = " tab_paymode='6' and  tab_status='closed' and";
		$fields="<th class='sortable'>Credit Amount</th>";
		$fields_dummy="<td></td>";
          
	} 
        else if($_REQUEST['payment'] =="7")
	{
		$string = " bm_complimentary='Y' and bm_status='closed' and";
                $stringta = " tab_complimentary='Y' and tab_status='closed' and";
		$fields="<th class='sortable'>Complimentary Amount </th>";
		$fields_dummy="<td></td>";
         
	}
         else if($_REQUEST['payment'] =="8")
	{
		$string = " bm_paymode='8' and bm_status='closed' and";
                $stringta = " tab_paymode='8' and  tab_status='closed' and";
		$fields="<th class='sortable'>Upi Amount</th>";
                $fields_dummy="<td></td>";
       
	
	}else if($_REQUEST['payment'] =="all")
	{
		$string = "  bm_status='closed' and ";
                $stringta = "  tab_status='closed' and ";
                 $fields="<th class='sortable'>Cash Amount</th>";
                  $fields.="<th class='sortable'>Card Amount</th>";
                 
                  $fields.="<th class='sortable'>Cheque</th>";
                  $fields.="<th class='sortable'>Coupon Amount</th>";
                  $fields.="<th class='sortable'>Credit Amount</th>";
                  $fields.="<th class='sortable'>Complimentary Amount </th>";
		$fields.="<th class='sortable'>Upi Amount</th>";
                $fields_dummy="<td></td>";
       
	
	}
                 
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
               
	  else
	   {
		$bydatz=$_REQUEST['bydate'];
		
	        if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $reporthead.="Last5days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $reporthead.="Last10days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                     $string1.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta1.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                     $reporthead.="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                     $string1.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta1.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                     $reporthead.="Last15days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $string1.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta1.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $reporthead.="Last20days";
                }   
                else if($bydatz=="Last25days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                      $reporthead.="Last25days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                      $reporthead.="Last30days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                     $reporthead.="Last1month";
                }
                else if($bydatz=="Today")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                     $reporthead.="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                     $reporthead.="Last90days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $reporthead.="Last180days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $reporthead.="Last365days";
                }
                }
        else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string1.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta1.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }
	
	?>
                        <table class="table table-bordered table-font user_shadow" >
			<thead>
                        <tr>
                        <th colspan="15"><?=$mode1?>-- Payment Report  -<?=$reporthead?></th>
                        </tr>
                        <tr>
                         <th class="sortable">Bill No</th> 
                        <th class="sortable">Bill Date </th>
                         <?=$fields?>
                         <th class="sortable">Amount</th>
                               
                        </tr>
                        </thead>
                        <tbody>
   <?php
   
                               $all_total="";
                               $cash1="";
                               $card1="";
                               $coup1="";
                               $voucher1="";
                               $cheq1="";
                               $credit1="";
                               $complimentary1="";
                               $upi1="";
                               
                               $all_total1="";
                               $cash2="";
                               $card2="";
                               $coup2="";
                               $voucher2="";
                               $cheq2="";
                               $credit2="";
                               $complimentary2="";
                               $upi2="";
   
                $billno=array();
                $day=array();
                $cash= array();
                $bank=array();
                $card=array();
                $coupon=array();
		$coupon_company=array();
                $coupon_paid=array();
                $voucherid=array();
		$voucher=array();		
		$cheqno=array();
                $cheq_bank=array();
                $cheqamount=array();
                $credit_person=array();
                $complimentary=array();
		$upi=array();
		$final=array();
                $all_total_mode=  array();
          if($mode==''){
              
              $sql_login1  =  $database->mysqlQuery("select bm_billno,bm_billdate,bm_amountpaid,bm_amountbalace,bm_name,bm_transactionamount,bm_couponamt,bm_couponcompany,
              bm_voucherid,bm_chequeno,bm_chequebankname,bm_finaltotal,bm_upi_amount,bm_chequebankamount from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc "); 
                        
              $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
	  { 
              while($result_login= $database->mysqlFetchArray($sql_login1))
              {        
                 ?>
                          <tr>
                             <td><?=$result_login['bm_billno']?></td>
                             <td><?=$database->convert_date($result_login['bm_billdate'])?></td>
                             
                               <?php
				if($_REQUEST['payment']=="1")
				{
				?>
				<td><?=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal'])?></td>
				<?php	
				}else if($_REQUEST['payment']=="2")
				{
				?>
                                <td><?=$result_login['bm_name']?></td>
                                <td><?=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="3")
				{$coup=$coup + $result_login['bm_couponamt'];
				?>
                                <td><?=$result_login['bm_couponcompany']?></td>
                                <td><?=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="4")
				{
				?>
                                <td><?=$result_login['bm_voucherid']?></td>
                                <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="5")
				{
				?>
                                <td><?=$result_login['bm_chequeno']?></td>
                                <td><?=$result_login['bm_chequebankname']?></td>
                                <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				}
				
                                else if($_REQUEST['payment']=="6")
				{
				?>
                              
                                <td><?=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="7")
				{
				?>
                              
                                <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="8")
				{
				?>
                              
                                <td><?=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal'])?></td>
                                <?php
				}
                                  else if($_REQUEST['payment']=="all")
				{
				?>
                                <?php if(($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])>0){ ?>
                              <td><?=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                               <?php if($result_login['bm_paymode']=='2'){ ?>
                              <td><?=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              <?php if($result_login['bm_paymode']=='3'){ ?>
                              <td><?=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                               <?php if($result_login['bm_paymode']=='5'){ ?>
                              <td><?=number_format($result_login['bm_chequebankamount'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                              <?php if($result_login['bm_paymode']=='6'){ ?>
                              <td><?=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                               <?php if($result_login['bm_paymode']=='7'){ ?>
                              <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                               <?php if($result_login['bm_paymode']=='8'){ ?>
                              <td><?=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                               
                                <?php
				}
				?>
                               <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                               </tr>       
                               <?php
                               $all_total=$all_total+$result_login['bm_finaltotal'];
                               $cash1=$cash1+($result_login['bm_amountpaid']-$result_login['bm_amountbalace']);
                               $card1=$card1+$result_login['bm_transactionamount'];
                               $coup1=$coup1+$result_login['bm_couponamt'];
                               $voucher1=$voucher1+$result_login['bm_amountpaid'];
                               $cheq1=$cheq1+$result_login['bm_chequebankamount'];
                               $credit1=$credit1+($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace']));
                               $complimentary1=$complimentary1+$result_login['bm_finaltotal'];
                               $upi1=$upi1+$result_login['bm_upi_amount'];
                               
                               
               
            }
	  }
        
        $sql_loginta1  =  $database->mysqlQuery("select tab_billno,tab_date,tab_amountpaid,tab_amountbalace,tab_transactionamount,bm_name,tab_couponamt,tab_couponcompany,tab_voucherid,tab_chequeno,tab_chequebankname,
        tab_netamt,tab_upi_amount,tab_paymode,tab_chequebankamount,tab_netamt from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where $stringta order by t.tab_date,t.tab_time asc "); 
      
        $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	if($num_loginta1)
	  {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                      
                
                  ?>
                           <tr >
                             <td><?=$result_loginta1['tab_billno']?></td>
                             <td><?=$database->convert_date($result_loginta1['tab_date'])?></td>
                              
                               
                               <?php
				if($_REQUEST['payment']=="1")
				{
				?>
				<td><?=number_format(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']),$_SESSION['be_decimal'])?></td>
				<?php	
				}else if($_REQUEST['payment']=="2")
				{
				?>
                                <td><?=$result_loginta1['bm_name']?></td>
                                <td><?=number_format($result_loginta1['tab_transactionamount'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="3")
				{$coup=$coup + $result_loginta1['tab_couponamt'];
				?>
                                <td><?=$result_loginta1['tab_couponcompany']?></td>
                                <td><?=number_format($result_loginta1['tab_couponamt'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="4")
				{
				?>
                                <td><?=$result_loginta1['tab_voucherid']?></td>
                                <td><?=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="5")
				{
				?>
                                <td><?=$result_loginta1['tab_chequeno']?></td>
                                <td><?=$result_loginta1['tab_chequebankname']?></td>
                                <td><?=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                                <?php
				} else if($_REQUEST['payment']=="6")
				{
				?>
                              
                                <td><?=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="7")
				{
				?>
                              
                                <td><?=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal'])?></td>
                                <?php
				}else if($_REQUEST['payment']=="8")
				{
				?>
                              
                                <td><?=number_format($result_loginta1['tab_upi_amount'],$_SESSION['be_decimal'])?></td>
                                <?php
				}
                                else if($_REQUEST['payment']=="all")
				{
                                    
                                    
                               if(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])>0){  
				?>


                                
				<td><?=number_format(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']),$_SESSION['be_decimal'])?></td>
				<?php	
				}else{ ?>
                                 <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                               
                                 <?php
                                if($result_loginta1['tab_paymode']=='2'){  
				?>
                                
				<td><?=number_format($result_loginta1['tab_transactionamount'],$_SESSION['be_decimal'])?></td>
				<?php	
				}else{ ?>
                                 <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                <?php if($result_loginta1['tab_paymode']=='3'){ ?>
                              <td><?=number_format($result_loginta1['tab_couponamt'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                               <?php if($result_loginta1['tab_paymode']=='5'){ ?>
                              <td><?=number_format($result_loginta1['tab_chequebankamount'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                              <?php if($result_loginta1['tab_paymode']=='6'){ ?>
                              <td><?=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                               <?php if($result_loginta1['tab_paymode']=='7'){ ?>
                              <td><?=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                              
                              
                               <?php if($result_loginta1['tab_paymode']=='8'){ ?>
                              <td><?=number_format($result_loginta1['tab_upi_amount'],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                 
                                 
                              
                                
                                <?php
				}
				?>


                               <td><?=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               </tr>    
                            
                            <?php
               $all_total1=$all_total1+$result_loginta1['tab_netamt'];
               $cash2=$cash2+($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']);
               $card2=$card2+$result_loginta1['tab_transactionamount'];
               $coup2=$coup2+$result_loginta1['tab_couponamt'];
               $voucher2= $voucher2+$result_loginta1['tab_amountpaid'];
               $cheq2=$cheq2+$result_loginta1['tab_chequebankamount'];
               $credit2=$credit2+($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']));
               $complimentary2= $complimentary2+$result_loginta1['tab_netamt'];
               $upi2=$upi2+$result_loginta1['tab_upi_amount'];
   } }
       
   $alltotal_sum=$all_total1+$all_total;
   $cash_sum=$cash1+$cash2;
   $card_sum=$card1+$card2;
   $coupon_sum=$coup1+$coup2;
   $voucher_sum=$voucher2+$voucher1;
   $cheq_sum=$cheq2+$cheq1;
   $creditsum=$credit1+$credit2;
   $compli_sum=$complimentary2+$complimentary1;
   $upi_sum=$upi1+$upi2;
   
   
   if($_REQUEST['payment']=="1")
				{
    ?>
                               <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><strong><?=number_format($cash_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
                               <?php
  }else if($_REQUEST['payment']=="2")
	{
      ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong><?=number_format($card_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="3")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                     <td></td>
                                    <td><strong><?=number_format($coupon_sum,$_SESSION['be_decimal'])?></strong></td>
                                     <td></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
      
  } else if($_REQUEST['payment']=="4")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong><?=number_format($voucher_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="5")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                     <td></td>
                                    <td><strong><?=number_format($cheq_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="6")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><strong><?=number_format($creditsum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  }
  else if($_REQUEST['payment']=="7")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><strong><?=number_format($compli_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  }else if($_REQUEST['payment']=="8")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><strong><?=number_format($upi_sum,$_SESSION['be_decimal'])?></strong></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  }
  else if($_REQUEST['payment']=="all")
	{
      $c1=0;
      $c2=0;
      $sql_loginta12  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster  where tab_paymode='7' and tab_status='Closed' and $stringta1 "); 
       
        $num_loginta12   = $database->mysqlNumRows($sql_loginta12);
	if($num_loginta12)
	  {
              while($result_loginta12= $database->mysqlFetchArray($sql_loginta12))
              {
                 $c1= $c1+$result_loginta12['tab_netamt'];
                  
              }
              }
      
      $sql_loginta13  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where bm_paymode='7' and bm_status='Closed' and $string1 "); 
       
        $num_loginta13   = $database->mysqlNumRows($sql_loginta13);
	if($num_loginta13)
	  {
              while($result_loginta13= $database->mysqlFetchArray($sql_loginta13))
              {
                  $c2= $c2+$result_loginta13['bm_finaltotal'];
                  
              }
              }
      $co_all=$c1+$c2;
      
      
      $cr1=0;
      $cr2=0;
      $sql_loginta121  =  $database->mysqlQuery("select tab_netamt,tab_amountpaid,tab_amountbalace from tbl_takeaway_billmaster  where tab_paymode='6' and tab_status='Closed' and $stringta1 "); 
       
        $num_loginta121   = $database->mysqlNumRows($sql_loginta121);
	if($num_loginta121)
	  {
              while($result_loginta121= $database->mysqlFetchArray($sql_loginta121))
              {
                 $cr1= $cr1+($result_loginta121['tab_netamt']-($result_loginta121['tab_amountpaid']-$result_loginta121['tab_amountbalace']));
                  
              }
              }
      
      $sql_loginta131  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace from tbl_tablebillmaster  where bm_paymode='6' and bm_status='Closed' and $string1 "); 
       
        $num_loginta131   = $database->mysqlNumRows($sql_loginta131);
	if($num_loginta131)
	  {
              while($result_loginta131= $database->mysqlFetchArray($sql_loginta131))
              {
                  $cr2= $cr2+($result_loginta131['bm_finaltotal']-($result_loginta131['bm_amountpaid']-$result_loginta131['bm_amountbalace']));
                  
              }
              }
      $cr_all=$cr1+$cr2;
      
      
      
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                     <td><?=number_format($cash_sum,$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format($card_sum,$_SESSION['be_decimal'])?></td>
                                       <td><?=number_format($coupon_sum,$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format($cheq_sum,$_SESSION['be_decimal'])?></td>
                                        
                                         <td><?=number_format($cr_all,$_SESSION['be_decimal'])?></td>
                                         
                                           <td><?=number_format($co_all,$_SESSION['be_decimal'])?></td>
                                            
                                     <td><?=number_format($upi_sum,$_SESSION['be_decimal'])?></td>
                                      <td><strong><?=number_format($alltotal_sum,$_SESSION['be_decimal'])?></strong></td>
                                        
                               </tr>
      <?php
  }
  
  
  
  
  
          }
  
  
  
 
  
           $mode_pay=  array();
        if($mode=='DI'){
	$sql_login  =  $database->mysqlQuery("select bm_paymode,bm_billno,bm_billdate,bm_amountpaid,bm_amountbalace,bm_name,bm_transactionamount,bm_couponamt,bm_couponcompany,bm_voucherid,bm_chequeno,
  bm_chequebankname,bm_finaltotal,bm_upi_amount from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc"); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {  $mode_pay[]=  $result_login['bm_paymode'];
                $billno[]=$result_login['bm_billno'];
                $day[]=$database->convert_date($result_login['bm_billdate']);
                $cash[]= number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);             
                $bank[]=$result_login['bm_name'];
                $card[]=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
                $coupon[]=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);       
		$coupon_company[]=$result_login['bm_couponcompany'];
                $coupon_paid[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                $voucherid[]=$result_login['bm_voucherid'];
		$voucher[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);		
		$cheqno[]=$result_login['bm_chequeno'];	
                $cheq_bank[]=$result_login['bm_chequebankname'];
                $cheqamount[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                $credit_person[]=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal']);
                $complimentary[]=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
		$upi[]=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal'])	;
		$final[]=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);		
               
            }
	  }
        }
        
          if($mode=='TA'||$mode=='HD'||$mode=='CS'){
             $sql_loginta  =  $database->mysqlQuery("select tab_paymode,tab_billno,tab_date,tab_amountpaid,tab_amountbalace,bm_name,tab_transactionamount,tab_couponamt,tab_couponcompany,tab_voucherid,
             tab_chequeno,tab_chequebankname,tab_netamt,tab_upi_amount from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where tab_mode='$mode' and $stringta order by t.tab_date,t.tab_time asc "); 
       
             $num_loginta   = $database->mysqlNumRows($sql_loginta);
	     if($num_loginta)
	      {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                  $mode_pay[]=  $result_loginta['tab_paymode']; 
                $billno[]=$result_loginta['tab_billno'];
                $day[]=$database->convert_date($result_loginta['tab_date']);
                $cash[]= number_format(($result_loginta['tab_amountpaid']-$result_loginta['tab_amountbalace']),$_SESSION['be_decimal']);             
                $bank[]=$result_loginta['bm_name'];
                $card[]=number_format($result_loginta['tab_transactionamount'],$_SESSION['be_decimal']);
                $coupon[]=number_format($result_loginta['tab_couponamt'],$_SESSION['be_decimal']);       
		$coupon_company[]=$result_loginta['tab_couponcompany'];
                $coupon_paid[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);
                $voucherid[]=$result_loginta['tab_voucherid'];
		$voucher[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);		
		$cheqno[]=$result_loginta['tab_chequeno'];	
                $cheq_bank[]=$result_loginta['tab_chequebankname'];
                $cheqamount[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);
                $credit_person[]=number_format(($result_loginta['tab_netamt']-($result_loginta['tab_amountpaid']-$result_loginta['tab_amountbalace'])),$_SESSION['be_decimal']);
                $complimentary[]=number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);
		$upi[]=number_format($result_loginta['tab_upi_amount'],$_SESSION['be_decimal'])	;
		$final[]=number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);		
		
            }
	  }
        }
        
        for ($i=0;$i<count($billno);$i++){
                 ?>
                   <tr>
                             <td><?=  $billno[$i]?></td>
                             <td><?=$database->convert_date($day[$i])?></td>
                              
                               <?php
				if($_REQUEST['payment']=="1")
				{
				?>
				<td><?= $cash[$i]?></td>
				<?php	
				}else if($_REQUEST['payment']=="2")
				{
				?>
                                <td><?= $bank[$i]?></td>
                                <td><?= $card[$i]?></td>
                                <?php
				}else if($_REQUEST['payment']=="3")
				{
				?>
                                <td><?=$coupon_company[$i]?></td>
                                <td><?= $coupon[$i]?></td>
                                <td><?=$coupon_paid[$i]?></td>
                                <?php
				}else if($_REQUEST['payment']=="4")
				{
				?>
                                <td><?= $voucherid[$i]?></td>
                                <td><?=$voucher[$i]?></td>
                                <?php
				}else if($_REQUEST['payment']=="5")
				{
				?>
                                <td><?=$cheqno[$i]?></td>
                                <td><?=$cheq_bank[$i]?></td>
                                <td><?= $cheqamount[$i]?></td>
                                <?php
				} else if($_REQUEST['payment']=="6")
				{
				?>
                              
                                <td><?= $credit_person[$i]?></td>
                                <?php
				}else if($_REQUEST['payment']=="7")
				{
				?>
                              
                                <td><?= $complimentary[$i]?></td>
                                <?php
				}else if($_REQUEST['payment']=="8")
				{
				?>
                              
                                <td><?=$upi[$i]?></td>
                                <?php
				}
                                 else if($_REQUEST['payment']=="all")
				{
                                    
				?>
                                
                                <?php if(str_replace(",","",$cash[$i])>0){ ?>
                              <td><?=number_format(str_replace(",","",$cash[$i]),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                
                                <?php if($mode_pay[$i]=='2'){ ?>
                              <td><?=number_format(str_replace(",","",$card[$i]),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                <?php if($mode_pay[$i]=='3'){ ?>
                              <td><?=number_format($coupon_paid[$i],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                
                                <?php if($mode_pay[$i]=='5'){ ?>
                              <td><?=number_format($cheqamount[$i],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                <?php if($mode_pay[$i]=='6'){ ?>
                              <td><?=number_format(str_replace(",","",$credit_person[$i]),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                <?php if($mode_pay[$i]=='7'){ ?>
                              <td><?=number_format(str_replace(",","",$complimentary[$i]),$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                
                              <?php if($mode_pay[$i]=='8'){ ?>
                              <td><?=number_format($upi[$i],$_SESSION['be_decimal'])?></td>
                                <?php } else{ ?>
                              <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } ?>
                                
                                
                                
                                <?php
				}
				?>
                               <td><?=$final[$i]?></td>
                               </tr>                
                   <?php       
                           
        }
              if($mode!=""){   
                  
                  $total_final=str_replace(",","",$final);
                  $cash_final=str_replace(",","",$cash);
                  $card_final=str_replace(",","",$card);
                  $coupon_final=str_replace(",","",$coupon_paid);
                  $voucher_final= str_replace(",","",$voucher);
                  $cheq_final= str_replace(",","",$cheqamount);
                  $credit_final= str_replace(",","",$credit_person);
                  $compli_final= str_replace(",","",$complimentary);
                  $upi_final=str_replace(",","",$upi);
                  
                  
        
                  if($_REQUEST['payment']=="1")
				{
         ?>
                               <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><?=number_format(array_sum($cash_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
                               <?php
  }else if($_REQUEST['payment']=="2")
	{
      ?>
      <tr>
                                 <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td><?=number_format(array_sum($card_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="3")
	{
       ?>
      <tr>
                                  <td><strong>Total</strong></td>
                                    <td></td>
                                     <td></td>
                                    <td><?=number_format(array_sum($coupon_final),$_SESSION['be_decimal'])?></td>
                                    <td></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
      
  } else if($_REQUEST['payment']=="4")
	{
       ?>
      <tr>
                                  <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                  <td><?=number_format(array_sum($voucher_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="5")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    <td></td>
                                     <td></td>
                                   <td><?=number_format(array_sum($cheq_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
  } else if($_REQUEST['payment']=="6")
	{
       ?>
      <tr>
                                  <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                   <td><?=number_format(array_sum($credit_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
  }
  else if($_REQUEST['payment']=="7")
	{
       ?>
      <tr>
                                  <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                   <td><?=number_format(array_sum($compli_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
      <?php
  }else if($_REQUEST['payment']=="8")
	{
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                    
                                    <td><?=number_format(array_sum($upi_final),$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
     
            
                              
        <?php } 
         else if($_REQUEST['payment']=="all")
	{
            
            $compl= array();
            $credi=  array();
            if($mode=='TA'||$mode=='HD'||$mode=='CS'){
             $sql_loginta  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster  where tab_mode='$mode' and $stringta1 and tab_status='Closed' and tab_paymode='7' "); 
       
             $num_loginta   = $database->mysqlNumRows($sql_loginta);
	     if($num_loginta)
	      {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                 $compl[]= number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);
                  
              }
              }
              
              
              
              $sql_loginta1  =  $database->mysqlQuery("select tab_netamt,tab_amountpaid,tab_amountbalace from tbl_takeaway_billmaster  where tab_mode='$mode' and $stringta1 and tab_status='Closed' and tab_paymode='6' "); 
       
             $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	     if($num_loginta1)
	      {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                 $credi[]=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal']);
                  
              }
              }
              
              
            }
            
            if($mode=="DI"){
               $sql_login  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where $string1 and bm_status='Closed' and bm_paymode='7' "); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                   $compl[]= number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                  
              }
              } 
              
              
              $sql_login1  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace from tbl_tablebillmaster  where $string1 and bm_status='Closed' and bm_paymode='6' "); 
     
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
	  {
              while($result_login1= $database->mysqlFetchArray($sql_login1))
              {
                   $credi[]= number_format(($result_login1['bm_finaltotal']-($result_login1['bm_amountpaid']-$result_login1['bm_amountbalace'])),$_SESSION['be_decimal']);
                  
              }
              } 
              
              
            }
            
            
            if($mode!=''){
             $compli_final_new= str_replace(",","",$compl);
                $credit_final_new= str_replace(",","",$credi);
            }
            
       ?>
      <tr>
                                   <td><strong>Total</strong></td>
                                    <td></td>
                                      <td><?=number_format(array_sum($cash_final),$_SESSION['be_decimal'])?></td>
                                       <td><?=number_format(array_sum($card_final),$_SESSION['be_decimal'])?></td>
                                       <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                        <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                         <td><?=number_format(array_sum($credit_final_new),$_SESSION['be_decimal'])?></td>
                                          <td><?=number_format(array_sum($compli_final_new),$_SESSION['be_decimal'])?></td>
                                    <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                      <td><?=number_format(array_sum($total_final),$_SESSION['be_decimal'])?></td>
                                        
                               </tr>
     
            
                              
        <?php }
        
        
        }?>             
       </tbody>
       </table>
<?php

}


else if(($_REQUEST['type']=="most_revenue_generated_item_cr"))
{
    
                         
	$string="";
        $stringta="";
        $string_combo="";
        $stringta_combo="";
        $mode="";
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
            $mode1=$mode;
        }
	$string=" bm.bm_status='Closed' AND bm.bm_complimentary!='Y' and ";
        $string_combo=" bm.bm_status='Closed' AND bm.bm_complimentary!='Y' and ";
        
        if($mode=='TA'|| $mode=='HD'||$mode=='CS'){
          $stringta.= " tbm.tab_mode='".$mode."' and ";
          $stringta_combo.= " tbm.tab_mode='".$mode."' and ";
        }
	$stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary!='Y' and ";
        $stringta_combo.=" tbm.tab_status='Closed' AND tbm.tab_complimentary!='Y' and ";
        $reporthead="";
	
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	
	else
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
	{
            $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta.="tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $string_combo.="cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta_combo.="cbd.cbd_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $reporthead="Yesterday";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $string_combo.=" cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_combo.=" cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $reporthead="Last 30 days";
	}
	else if($bydatz=="Last1month")
	{
            $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            $reporthead="Last 1 Month";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $reporthead="Today";
	}
        else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead="Last 90 days";
	}
        else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $reporthead="Last 6 Months";
	}
        else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $reporthead="Last 1 Year";
	}

	}
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= "cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= "cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }
	
        
        if($_REQUEST['most_revenue']=="Y"){
	?>
                          
                       <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="4">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="4"><strong> Most Revenue Generating Items </strong></th>
      </tr>

      
    </thead>
    </table>      
                          
                          
                    <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="4">Report - <?=$reporthead?></th>
                            </tr>
                            <tr>
                                <th class="sortable">Sl No</th>                                       
                                <th class="sortable">Menu</th>
				<th class="sortable">Quantity</th>
                                <th class="sortable">Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
        <?php
	$menu_qty=array();
        $menu_name=array();
        $menu_rate=array();
        if($mode==""||$mode=='DI'){
            
        $sql_login_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo
                                                    group by cbd.cbd_combo_pack_id"); 
        
        $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
	if($num_login_combo)
	{$i=0;
            while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
            {$i++;
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                  
                  if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                  }
                  if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['total'];
                  }
                  else{
                     $menu_rate[$result_login_combo['menuid']]=$result_login_combo['total']; 
                  }
            }
        }
	$sql_login  =  $database->mysqlQuery("select distinct(bd.bd_menuid)as menuid,mr.mr_menuname as menu,sum(bd.bd_qty) as totqty,sum(bd.bd_amount) as totamt from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string AND bd.bd_count_combo_ordering IS NULL group by bd.bd_menuid order by totamt  DESC "); 

        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                  
                  if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['totqty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['totqty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['totamt'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['totamt']; 
                  }
            }
	  }
        }
        if($mode==""||$mode=='TA'||$mode=='HD'||$mode=='CS'){
        $sql_loginta_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo
                                                    group by cbd.cbd_combo_pack_id "); 
        
        $num_loginta_combo   = $database->mysqlNumRows($sql_loginta_combo);
	if($num_loginta_combo)
	{$j=0;
            while($result_loginta_combo= $database->mysqlFetchArray($sql_loginta_combo))
            {$j++;
                  $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];
                  
                  if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                  }
                  if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_loginta_combo['total'];
                  }
                  else{
                     $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['total']; 
                  }
            }
	}     
          $sql_loginta  =  $database->mysqlQuery("select distinct(tbd.tab_menuid)as menuid,mr.mr_menuname as menu,sum(tbd.tab_qty) as totqty,sum(tbd.tab_amount) as totamt from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta  AND tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid order by totamt  DESC "); 
     
        $num_loginta   = $database->mysqlNumRows($sql_loginta);
	if($num_loginta)
	  {$j=0;
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {$j++;
                  $menu_name[$result_loginta['menuid']]=$result_loginta['menu'];
                  
                  if(array_key_exists($result_loginta['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta['menuid']]=$menu_qty[$result_loginta['menuid']]+$result_loginta['totqty'];
                  }
                  else{
                      $menu_qty[$result_loginta['menuid']]=$result_loginta['totqty'];
                  }
                  if(array_key_exists($result_loginta['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta['menuid']]=$menu_rate[$result_loginta['menuid']]+$result_loginta['totamt'];
                  }
                  else{
                     $menu_rate[$result_loginta['menuid']]=$result_loginta['totamt']; 
                  }
            }
	  }
        }
//         $sorted_menu=array();
//          $sorted_menu=arsort($menu_rate);  
         // print_r($sorted_menu);
          arsort($menu_rate);
          $m=0;
          $menurate_sum=0;
          $menuquant_sum=0;
          foreach($menu_rate as $key=>$val){
              $m++;
              if($m<=10)
              {$menurate_sum=$menurate_sum+$menu_rate[$key];
              $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                  ?>   
                            <tr>
                                <td ><?=$m?></td>                                       
                                <td ><?=$menu_name[$key]?></td>
				<td ><?=$menu_qty[$key];?></td>
                                <td ><?=number_format($menu_rate[$key],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php                
          }}
          ?>
                            <tr>
                                <td ><strong>Total</strong></td>                                       
                                <td ></td>
				<td ><strong><?=$menuquant_sum?></strong></td>
                                <td ><strong><?=number_format($menurate_sum,$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr>
                        </tbody>
                    </table>
<?php

        }
        
         if($_REQUEST['best_selling']=='Y'){
            
    ?>
            
                           
                       <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="4">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="4"><strong> Best Selling Items </strong></th>
      </tr>

      
    </thead>
    </table>      
                          
                          
                    <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="4">Report - <?=$reporthead?></th>
                            </tr>
                            <tr>
                                <th class="sortable">Sl No</th>                                       
                                <th class="sortable">Menu</th>
				<th class="sortable">Quantity</th>
                                <th class="sortable">Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
        <?php
	$menu_qty=array();
        $menu_name=array();
        $menu_rate=array();
        if($mode==""||$mode=='DI'){
            
        $sql_login_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo
                                                    group by cbd.cbd_combo_pack_id"); 
        
        $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
	if($num_login_combo)
	{$i=0;
            while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
            {$i++;
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                  
                  if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                  }
                  if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['total'];
                  }
                  else{
                     $menu_rate[$result_login_combo['menuid']]=$result_login_combo['total']; 
                  }
            }
        }
	$sql_login  =  $database->mysqlQuery("select distinct(bd.bd_menuid)as menuid,mr.mr_menuname as menu,sum(bd.bd_qty) as totqty,"
                . " sum(bd.bd_amount) as totamt from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno "
                . "left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string AND bd.bd_count_combo_ordering IS NULL"
                . " group by bd.bd_menuid order by totqty  DESC "); 

        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                  
                  if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['totqty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['totqty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['totamt'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['totamt']; 
                  }
            }
	  }
        }
        if($mode==""||$mode=='TA'||$mode=='HD'||$mode=='CS'){
        $sql_loginta_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo
                                                    group by cbd.cbd_combo_pack_id "); 
        
        $num_loginta_combo   = $database->mysqlNumRows($sql_loginta_combo);
	if($num_loginta_combo)
	{$j=0;
            while($result_loginta_combo= $database->mysqlFetchArray($sql_loginta_combo))
            {$j++;
                  $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];
                  
                  if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                  }
                  if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_loginta_combo['total'];
                  }
                  else{
                     $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['total']; 
                  }
            }
	}     
          $sql_loginta  =  $database->mysqlQuery("select distinct(tbd.tab_menuid)as menuid,mr.mr_menuname as menu,sum(tbd.tab_qty) as totqty,"
                  . "sum(tbd.tab_amount) as totamt from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on "
                  . "tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta  AND "
                  . "tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid order by totqty  DESC "); 
     
        $num_loginta   = $database->mysqlNumRows($sql_loginta);
	if($num_loginta)
	  {$j=0;
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {$j++;
                  $menu_name[$result_loginta['menuid']]=$result_loginta['menu'];
                  
                  if(array_key_exists($result_loginta['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta['menuid']]=$menu_qty[$result_loginta['menuid']]+$result_loginta['totqty'];
                  }
                  else{
                      $menu_qty[$result_loginta['menuid']]=$result_loginta['totqty'];
                  }
                  if(array_key_exists($result_loginta['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta['menuid']]=$menu_rate[$result_loginta['menuid']]+$result_loginta['totamt'];
                  }
                  else{
                     $menu_rate[$result_loginta['menuid']]=$result_loginta['totamt']; 
                  }
            }
	  }
        }
//         $sorted_menu=array();
//          $sorted_menu=arsort($menu_rate);  
         // print_r($sorted_menu);
          arsort($menu_qty);
          $m=0;
          $menurate_sum=0;
          $menuquant_sum=0;
          foreach($menu_qty as $key=>$val){
              $m++;
              if($m<=10)
              {$menurate_sum=$menurate_sum+$menu_rate[$key];
              $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                  ?>   
                            <tr>
                                <td ><?=$m?></td>                                       
                                <td ><?=$menu_name[$key]?></td>
				<td ><?=$menu_qty[$key];?></td>
                                <td ><?=number_format($menu_rate[$key],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php                
          }}
          ?>
                            <tr>
                                <td ><strong>Total</strong></td>                                       
                                <td ></td>
				<td ><strong><?=$menuquant_sum?></strong></td>
                                <td ><strong><?=number_format($menurate_sum,$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr>
                        </tbody>
                    </table>     
            
            
 <?php
    
 }



}

else if(($_REQUEST['type']=="hourlywise_report_cr"))
{
    ?>
                            <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="4">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="4"><strong> Hourly Wise Report </strong></th>
      </tr>

      
    </thead>
    </table> 
    <?php
	$string="";
        $stringta="";
        $string_combo="";
        $stringta_combo="";
        $mode="";
        $days="";
        $days2="";
        $days1="";
        
        $fromtime=$_REQUEST['fromtime'];
        if($fromtime!=""){
        $newfromtime="'".date("H:i:s", strtotime($fromtime))."'";
        }
        else{
           $newfromtime="'00:00:00'"; 
        }
        
        $totime=$_REQUEST['totime'];
        if($totime!=""){
        $newtotime="'".date("H:i:s", strtotime($totime))."'";
        } 
        else{
          $newtotime  ="'23:59:59'";
        }
        $days=trim($_REQUEST['day'],",");
        if($days!=""){
         $days1=explode(',',$days);
        for($i=0;$i<count($days1);$i++){
        $days2.="'".$days1[$i]."',";    
        }
          $days2=trim($days2,",");
          
        if(($days2)!=""){
            $string .=" DAYNAME(bm.bm_billdate) IN ($days2) and  ";
            $stringta.="  DAYNAME(tbm.tab_date) IN ($days2) and ";
            $string_combo .=" DAYNAME(bm.bm_billdate) IN ($days2) and  ";
            $stringta_combo.="  DAYNAME(tbm.tab_date) IN ($days2) and ";
        }
       }
        
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
            $mode1=$mode;
        }
	$string.=" bm.bm_status='Closed'   ";
        $string_combo.=" bm.bm_status='Closed'   ";
        if($mode=='TA'|| $mode=='HD'||$mode=='CS'){
          $stringta.= " tbm.tab_mode='".$mode."' and ";
          $stringta_combo.= " tbm.tab_mode='".$mode."' and ";  
        }
	$stringta.=" tbm.tab_status='Closed'  ";
        $stringta_combo.=" tbm.tab_status='Closed'  ";
        $reporthead="";
	
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	
	
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
	

	?>
                    <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="4"><?=$mode1?>--Hourly wise Report  - <?=$reporthead?> between <?=$newfromtime?> and <?=$newtotime?> </th>
                            </tr>
                            
                        </thead>
                        <tbody>
        <?php
        $amount=array();
        $mode_name=array();
        $menu_qty=array();
        $menu_name=array();
        $menu_id=array();
        $menu_rate=array();
        $billno=array();
        
        if($mode=='DI'){
         $sql_login_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo and bm.bm_billtime between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id"); 
        
        $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
	if($num_login_combo)
	{$i=0; 
            while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
            {$i++;
                if(!array_key_exists($result_login_combo['paymode'],$mode_name)){
                    $mode_name[$result_login_combo['paymode']]=$result_login_combo['paymodename'];
                    }
                    if(!in_array($result_login_combo['billno'], $billno)){
                        $billno[]=$result_login_combo['billno'];
                        $amount[$result_login_combo['paymode']][]=$result_login_combo['final'];
                    }
                    if(!array_key_exists($result_login_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_login_combo['menuid'];
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                    }
                  if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                  }
                  if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['amount'];
                  }
                  else{
                     $menu_rate[$result_login_combo['menuid']]=$result_login_combo['amount']; 
                  }
            }
        }    
            
	$sql_login  =  $database->mysqlQuery("select bm.bm_billno as billno,sum(bm.bm_finaltotal) as final,sum(bd.bd_qty) as qty,sum(bd.bd_amount) as amount,pm.pym_name as paymodename,bm.bm_paymode as paymode,bd.bd_menuid as menuid,mr.mr_menuname as menu from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode left join tbl_tablebilldetails bd on bd.bd_billno=bm.bm_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string and bm.bm_billtime between $newfromtime and $newtotime and bd.bd_count_combo_ordering IS NULL group by bd_menuid,bm_paymode,bm_billno order by mr_menuname asc "); 

        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                  if($result_login['menuid']){
                  if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                    if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                  if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                }  
            }
	  }
        }
        else if($mode=='TA'||$mode=='HD'||$mode=='CS'){
          $sql_loginta_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,sum(tbm.tab_netamt) as final,tbm.tab_paymode as paymode,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo and tbm.tab_time between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id "); 
        
        $num_loginta_combo   = $database->mysqlNumRows($sql_loginta_combo);
	if($num_loginta_combo)
	{$j=0;
            while($result_loginta_combo= $database->mysqlFetchArray($sql_loginta_combo))
            {$j++;
                  if(!array_key_exists($result_loginta_combo['paymode'],$mode_name)){
                    $mode_name[$result_loginta_combo['paymode']]=$result_loginta_combo['paymodename'];
                    }
                  
                  if(!in_array($result_loginta_combo['billno'], $billno)){
                        $billno[]=$result_loginta_combo['billno'];
                        $amount[$result_loginta_combo['paymode']][]=$result_loginta_combo['final'];
                    }
                    
                    if(!array_key_exists($result_loginta_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_loginta_combo['menuid'];
                  $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];
                    }
                   
                   if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                  }
                   if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['amount']; 
                  }
            }
	}  
            
            
          $sql_login  =  $database->mysqlQuery("select tbm.tab_billno as billno, sum(tbm.tab_netamt) as final,sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as amount,pm.pym_name as paymodename,tbm.tab_paymode as paymode,tbd.tab_menuid as menuid,mr.mr_menuname as menu from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid   where $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid,tbm.tab_paymode,tbm.tab_billno order by mr_menuname asc  "); 

        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
                 if($result_login['menuid']){
                    if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                  
                  if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                   
                   if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                   if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                      
                 }
            }
	  }
        }
        else{
        $sql_login_combo  =  $database->mysqlQuery("select billno,sum(final) as final,sum(qty) as qty, sum(amount) as amount,paymodename,paymode,menuid,menu from ( 
                                                    select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo and bm.bm_billtime between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id 
                                                    union all
                                                    select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,sum(tbm.tab_netamt) as final,tbm.tab_paymode as paymode,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo and tbm.tab_time between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id ) x group by menuid,paymode,billno order  by menu asc "); 
        
        $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
	if($num_login_combo)
	{$i=0; 
            while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
            {$i++;
                if(!array_key_exists($result_login_combo['paymode'],$mode_name)){
                    $mode_name[$result_login_combo['paymode']]=$result_login_combo['paymodename'];
                    }
                    if(!in_array($result_login_combo['billno'], $billno)){
                        $billno[]=$result_login_combo['billno'];
                        $amount[$result_login_combo['paymode']][]=$result_login_combo['final'];
                    }
                    if(!array_key_exists($result_login_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_login_combo['menuid'];
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                    }
                  if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                  }
                  if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['amount'];
                  }
                  else{
                     $menu_rate[$result_login_combo['menuid']]=$result_login_combo['amount']; 
                  }
            }
        }    
        $sql_login  =  $database->mysqlQuery(" select billno,sum(final) as final,sum(qty) as qty, sum(amount) as amount,paymodename,paymode,menuid,menu from ( select bm.bm_billno as billno,bm.bm_finaltotal as final,bd.bd_qty as qty,bd.bd_amount as amount,pm.pym_name as paymodename,bm.bm_paymode as paymode,bd.bd_menuid as menuid,mr.mr_menuname as menu from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode left join tbl_tablebilldetails bd on bd.bd_billno=bm.bm_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string and bm.bm_billtime between $newfromtime and $newtotime and bd.bd_count_combo_ordering IS NULL union all
                                               select tbm.tab_billno as billno, tbm.tab_netamt as final,tbd.tab_qty as qty,tbd.tab_amount as amount,pm.pym_name as paymodename,tbm.tab_paymode as paymode,tbd.tab_menuid as menuid,mr.mr_menuname as menuname from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid   where $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL ) x group by menuid,paymode,billno order  by menu asc "); 
      
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                    if($result_login['menuid']){
                    if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                    if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                    
                     
                   if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                }  
            }
	  }
        }
        ?>
                            
                            <tr>
                                <th colspan="4">Item Ordered Details</th>
                            </tr>
                            <tr>
                                <th class="sortable">SlNo</th>                                       
                                <th class="sortable">Menu</th>
                                <th class="sortable">Quantity</th>                                       
                                <th class="sortable">Amount</th>
				
                                
                            </tr>
                        
                        
                      
<?php
            //print_r($billno);
            arsort($menu_rate);
          $m=0;
          $menurate_sum=0;
          $menuquant_sum=0;
          
          foreach($menu_id as $key=>$val){
              $m++;
              //$menurate_sum=$menurate_sum+$menu_rate[$key];
              //$menuquant_sum=$menuquant_sum+$menu_qty[$key];
                  ?>   
                            <tr>
                                <td ><?=$m?></td>                                       
                                <td ><?=$menu_name[$val]?></td>
				<td ><?=$menu_qty[$val]?></td>
                                <td ><?=number_format($menu_rate[$val],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
   <?php                
    }
  ?>         
                            <tr>
                                <td ><strong>Total</strong></td>                                       
                                <td ></td>
				<td ><strong><?=array_sum($menu_qty)?></strong></td>
                                <td ><strong><?=number_format(array_sum($menu_rate),$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr>
                       


<?php                

         //print_r($billno);       
          asort($mode_name);
          $m=0;
          $total_sum=0;
          ?>                <tr>
                                <th colspan="4">Settlement Summary</th>
                            </tr>
                            <tr colspan="4">
                                <th class="sortable" colspan="2">Mode of Settlement</th>                                       
                                <th class="sortable" colspan="2" >Amount</th>
				
                                
                            </tr>
         <?php
         $total=0;
         
         if($mode=='DI'){
            $sql_login  =  $database->mysqlQuery(" select bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,sum(bm.bm_amountpaid-bm.bm_amountbalace) as cash, 
                sum(bm.bm_transactionamount) as card,sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)-bm.bm_transactionamount) as credit,
                sum(bm.bm_chequebankamount) as cheque
                FROM tbl_tablebillmaster bm where $string and bm.bm_billtime between $newfromtime and $newtotime group by bm.bm_paymode ");

         }
         else if($mode=='TA'||$mode=='HD'||$mode=='CS'){
             $sql_login  =  $database->mysqlQuery(" select tbm.tab_paymode as paymode,sum(tbm.tab_netamt) as final,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash, 
                sum(tbm.tab_transactionamount) as card,sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)-tbm.tab_transactionamount) as credit,
                sum(tbm.tab_chequebankamount) as cheque
                FROM tbl_takeaway_billmaster tbm where $stringta AND tbm.tab_mode='".$mode."' and tbm.tab_time between $newfromtime and $newtotime group by tbm.tab_paymode");
            }
         else{
             $sql_login  =  $database->mysqlQuery("  select  paymode,sum(final) as final, sum(cash) as cash, sum(card) as card, sum(credit) as credit , sum(cheque) as  cheque  from ( 
                select bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,sum(bm.bm_amountpaid-bm.bm_amountbalace) as cash, 
                sum(bm.bm_transactionamount) as card,sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)-bm.bm_transactionamount) as credit,
                sum(bm.bm_chequebankamount) as cheque
                FROM tbl_tablebillmaster bm where $string and bm.bm_billtime between $newfromtime and $newtotime group by bm.bm_billno,bm.bm_paymode

                union all

                select tbm.tab_paymode as paymode,sum(tbm.tab_netamt) as final,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash, 
                sum(tbm.tab_transactionamount) as card,sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)-tbm.tab_transactionamount) as credit,
                sum(tbm.tab_chequebankamount) as cheque
                FROM tbl_takeaway_billmaster tbm where $stringta and tbm.tab_time between $newfromtime and $newtotime group by tbm.tab_billno,tbm.tab_paymode)x x.paymode");
             
         }
            $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
            { $i=0;$total=0;
              while($result_login= $database->mysqlFetchArray($sql_login)){
                  $total=$total+$result_login['final'];
              if($result_login['paymode']==1 && $result_login['cash']>0){
            ?>
                            <tr colspan="4">
                                <td colspan="2" >Cash</td>
				<td colspan="2" ><?=number_format($result_login['cash'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php
              }
            if($result_login['paymode']==2 && $result_login['card']>0){
            ?>
                            <tr colspan="4">
                                <td colspan="2" >Card</td>
				<td colspan="2" ><?=number_format($result_login['card'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php
            }
            if($result_login['paymode']==6 && $result_login['credit']>0){
            ?>
                            <tr colspan="4">
                                <td colspan="2" >Credit</td>
				<td colspan="2" ><?=number_format($result_login['credit'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php
            }
            if($result_login['paymode']==5 && $result_login['cheque']>0){
            ?>
                            <tr colspan="4">
                                <td colspan="2" >Cheque</td>
				<td colspan="2" ><?=number_format($result_login['cheque'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php
            }
            if($result_login['paymode']==7 && $result_login['final']>0){
            ?>
                            <tr colspan="4">
                                <td colspan="2" >Complimentary</td>
				<td colspan="2" ><?=number_format($result_login['final'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
            <?php
            }
          }
          
          ?>
                            <tr colspan="4">
                                <td colspan="2"><strong>Total</strong></td>                                       
                                <td colspan="2"><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr> 
                             </tbody>
                    </table>
    <?php
}}
else if(($_REQUEST['type']=="credit_summary_client"))
{   
     	
        $string="";
       
	$creditsataff='';
        
        if($_REQUEST['creditstaff']!=''){
	$creditstaff= " and  cm.crd_type ='".$_REQUEST['creditstaff']."' ";
        }
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                       $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}

	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
	if($bydatz!=null && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
          
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd.cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
        $credit_amount=0;
        $credit_amount1=0;
        $received_amount=0;
        $received_amount1=0;
        $creditperson='';
        $settled_status='';
        $billamount=0;
        $balance1=0;
        $balance=0;
        $remark='';
        //$received_amount=array();
        ?>
                      <table class="table table-bordered table-font user_shadow" >
                    <thead>
                         
                        
                       
                        <tr>
                            <th colspan="7"> Summary Report Credit- <?=$reporthead?></td>
                        </tr>
                            
                      <tr>
                            <th>Sl.No</th>
                           
                            <th >Type</th>
                            <th >Party Name</th>
                             <th >Number</th>
                            <th >Credit Amount</th>
                            
                            
                        </tr>
                      </thead>
                      <tbody>  
        <?php
        
	$sql_login  =  $database->mysqlQuery("select cm.crd_totalamount,cd.cd_billno,ct.ct_credit_type,sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,"
                . "c.ct_corporatename as company,sum(tb.bm_finaltotal) as dine_bill_total, sum(tbm.tab_netamt) as ta_bill_total,sum(cd.cd_amount) as credit,"
                . "cd.cd_settled from tbl_credit_details cd left join tbl_credit_master cm on cd_masterid =crd_id left join tbl_staffmaster"
                . " sm on ser_staffid=crd_staffid left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid left join tbl_loyalty_reg lr "
                . "on ly_id=crd_guestid left join tbl_credit_types ct on ct.ct_creditid=cm.crd_type left join tbl_tablebillmaster tb on bm_billno =cd_billno left join"
                . " tbl_takeaway_billmaster tbm on tab_billno=cd_billno where cd.cd_settled='N' and "
                . " $string $creditstaff group by guest,company,staff,lr.ly_mobileno  order by ct_credit_type,guest,company,staff,lr.ly_mobileno asc  " ); 

        
        
    
        $num_login   = $database->mysqlNumRows($sql_login); 
    if($num_login){$i=0;$credit_amount=0;$received_amount=0;$crd_all=0; $bal_all=0;$rec_all=0;
        while($result_login=$database->mysqlFetchArray($sql_login))
        {   $i++;
          
            
           
            $credit_amount=$result_login['credit'];
           
            
            
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'] ;   
            }
            
           
            
                
            $crd_all=$crd_all+$result_login['credit'];
            
            
            $bal_all=$bal_all+$result_login['crd_totalamount'];
            
            
            $rec_all=$rec_all+($result_login['credit']-$result_login['crd_totalamount']);
          
        ?>
                        <tr>
                            <td><?=$i?></td>
                            
                            <td ><?=$result_login['ct_credit_type']?></td>
                          
                             <td ><?=$creditperson?></td>
                              <td ><?=$result_login['ly_mobileno']?></td> 
                            <td ><?=number_format($credit_amount,$_SESSION['be_decimal'])?></td>
                           
                            
                            
                        </tr>     
        <?php
        }
        
    }else{
    ?>
                        
            <tr>
                            <td></td>
                            
                            <td ></td>
                          
                           
                              <td style="color:darkred;text-align: left;font-weight:bold " >NO RECORDS TO DISPLAY</td> 
                               <td > </td>
                            <td ></td>
                            
                            
                            
                        </tr>                 
                        
       
                        <?php } ?>
                        
                        <tr>
                            <td></td>
                            
                            <td></td>
                          
                            <td> </td>
                              <td></td> 
                            <td ></td>
                           
                            
                            
                        </tr>    
                     <tr>
                         <td style="font-weight:bold">Total</td>
                            
                            <td></td>
                          
                            <td> </td>
                            <td></td> 
                            <td ><?=number_format($crd_all,$_SESSION['be_decimal'])?></td>
                           
                            
                            
                        </tr>      
                        
                        
                        
                      </tbody>
                      </table>
<?php
}
else if(($_REQUEST['type']=="consolidated_credit_summury"))
{   
    
                           
        $string="";
       
	$creditsataff='';
	$creditstaff=$_REQUEST['creditstaff'];
            if($creditstaff!=''){
               $string.= " cm.crd_type='$creditstaff' and ";
               
               if($_REQUEST['credit_staff_company']!=''){
                   
                    if($creditstaff=='2'){
                      $string.= " ser_staffid='".$_REQUEST['credit_staff_company']."' and "; 
                    }
                    else if($creditstaff=='3'){
                     $string.= " ct_corporatecode='".$_REQUEST['credit_staff_company']."' and ";  
                    }
                    else if($creditstaff=='4'){
                      $string.= " ly_id='".$_REQUEST['credit_staff_company']."' and "; 
                    }
                }
            }
        $checked_status='';
        if($_REQUEST['checkedstatus']=="true"){
            $checked_status=" and cd.cd_settled='N' ";
        }
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                       
		}

	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
	if($bydatz!=null && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
          
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd.cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
        $credit_amount=0;
        $credit_amount1=0;
        $received_amount=0;
        $received_amount1=0;
        $creditperson='';
        $settled_status='';
        $billamount=0;
        $balance1=0;
        $balance=0;
        $remark='';
        //$received_amount=array();
        
        
      if($_REQUEST['credit_partial_pay']=="N"){   
        
        ?>
                          
                          
                          
                         <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="4">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="4"><strong> Credit Summary Report </strong></th>
      </tr>

      
    </thead>
    </table>   
                          
                          
                      <table class="table table-bordered table-font user_shadow" >
                    <thead>
                         
                        
                       
                        <tr>
                            <th colspan="11">Credit Summary Report - <?=$reporthead?></td>
                        </tr>
                            
                      <tr>
                            <th>Sl.No</th>
                            <th >Date</th>
                            <th >Category</th>
                            <th >Party Name</th>
                             <th >Remarks</th>
                            <th >Bill No</th>
                            <th >Bill Amount</th>
                            <th >Credit Amount</th>
                            <th >Received Amount</th>
                            <th >Balance Amount</th>
                            <th >Credit Settle Date</th>
                        </tr>
                      </thead>
                      <tbody>  
        <?php
	$sql_login  =  $database->mysqlQuery("select tbm.tab_status as ta_sts, tb.bm_status as di_sts,cd.cd_dateofsettle,tb.bm_creditremark as di_remarks,tbm.tab_creditremark as ta_remarks,cd.cd_dayclosedate,cd.cd_billno,ct.ct_credit_type,sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,c.ct_corporatename as company,tb.bm_finaltotal as dine_bill_total, tbm.tab_netamt as ta_bill_total,cd.cd_amount,cd.cd_settled from tbl_credit_details cd
left join tbl_credit_master cm on cd_masterid =crd_id 
left join tbl_staffmaster sm on ser_staffid=crd_staffid 
left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid 
left join tbl_loyalty_reg lr on ly_id=crd_guestid 
left join tbl_credit_types ct  on ct.ct_creditid=cm.crd_type 
left join tbl_tablebillmaster tb on bm_billno =cd_billno 
left join tbl_takeaway_billmaster tbm on tab_billno=cd_billno 
where  $string $checked_status " ); 

        $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){$i=0;$credit_amount=0;$received_amount=0;
        while($result_login=$database->mysqlFetchArray($sql_login))
        {  
            if($result_login['ta_sts']!='Cancelled' && $result_login['di_sts']!='Cancelled'){
                
            
            $i++;
            $settled_status=$result_login['cd_settled'];
            if($settled_status=='N'){
            $credit_amount=$result_login['cd_amount'];
            $received_amount=0;
            $credit_amount1=$credit_amount1+$credit_amount;
            }
            else if($settled_status=='Y'){
            $received_amount=$result_login['cd_amount'];
            $credit_amount=0;
             $received_amount1=$received_amount1+$received_amount;
            }
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'].' - '.$result_login['ly_mobileno'] ;   
            }
            if($result_login['dine_bill_total']!=''){
             $billamount=$result_login['dine_bill_total'];   
            }
            else if($result_login['ta_bill_total']!=''){
             $billamount=$result_login['ta_bill_total'];   
            }
            $balance=round($credit_amount,2)-round($received_amount,2);
            if($balance<1){
                $balance=0;
            }
            
            if($result_login['di_remarks']!=''){
             $remark=$result_login['di_remarks'];   
            }
            else if($result_login['ta_remarks']!=''){
             $remark=$result_login['ta_remarks'];   
            }
            
            
            $balance1=$balance1+$balance;
        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td ><?=$result_login['cd_dayclosedate']?></td>
                            <td ><?=$result_login['ct_credit_type']?></td>
                            <td ><?=$creditperson?></td>
                             <td ><?=$remark?></td>
                            <td ><?=$result_login['cd_billno']?></td>
                            <td ><?=round($billamount,2)?></td>
                            <td ><?=round($credit_amount,2)?></td>
                            <td ><?=round($received_amount,2)?></td>
                            <td ><?=$balance?></td>
                             <td ><?=$result_login['cd_dateofsettle']?></td>
                            
                        </tr>     
        <?php
        }
        
    } }
    ?>
                        <tr>
                            <td>Total</td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                             <td ></td>
                            
                            <td ></td>
                            <td ><?=$credit_amount1?></td>
                            <td ><?=$received_amount1?></td>
                            <td ><?=$balance1?></td>
                              <td ></td>
                        </tr> 
                      <tbody>
                      </table>
<?php

      }
      
      
  if($_REQUEST['credit_partial_pay']=="Y"){    
      
      
      $lt=2500;                              
    $pagination=0;
    $recordcount="";
    if(isset($_REQUEST['pagination']))
    {
    $pagination= $_REQUEST['pagination'];
    $recordcount=$_REQUEST['recordcount'];

    }


    if($recordcount!=""){
           $i=$recordcount;
    }else{
           $i=0;
    }
      
        ?>
        <table class="table table-bordered table-font user_shadow" >
            <thead>
               <tr>
                <th colspan="10">Credit Partial Pay Report : <?=$reporthead?></td>
               </tr>
               <tr>
                    <th>Sl</th>
                    <th >Bill Date</th>
                    <th >Category</th>
                    <th >Party Name</th>
                    <th >Bill No</th>
                    <th >Bill Amount</th>
                    
                    <th >Paid Amount</th>
                    <th >Login</th>
                    <th >Pay Type</th>
                    <th >Paid Date</th>
                </tr>
            </thead>
        <tbody>  
        <?php
     
        $crd_partial=0;
	$sql_login  =  $database->mysqlQuery("select  cd.cd_dateofsettle,tcp.tcp_amount,
            cd.cd_dayclosedate,cd.cd_billno,ct.ct_credit_type,tcp.tcp_mode,tcp.tcp_date,tcp.tcp_login,
            sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,c.ct_corporatename as company,tb.bm_finaltotal as dine_bill_total,
            tbm.tab_netamt as ta_bill_total,cd.cd_amount,cd.cd_settled from tbl_credit_details cd
            left join tbl_credit_master cm on cd_masterid =crd_id 
            left join tbl_credit_partial_bill tcp on tcp_billno=cd_billno
            left join tbl_staffmaster sm on ser_staffid=crd_staffid 
            left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid 
            left join tbl_loyalty_reg lr on ly_id=crd_guestid 
            left join tbl_credit_types ct  on ct.ct_creditid=cm.crd_type 
            left join tbl_tablebillmaster tb on bm_billno =cd_billno 
            left join tbl_takeaway_billmaster tbm on tab_billno=cd_billno 
            where  $string and  tcp_billno!=''   limit ". $pagination.",$lt " ); 
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        $credit_amount=0;$received_amount=0;
        while($result_login=$database->mysqlFetchArray($sql_login))
        {  
            if($result_login['ta_sts']!='Cancelled' && $result_login['di_sts']!='Cancelled'){
            $i++;
            $settled_status=$result_login['cd_settled'];
            $credit_amount=$result_login['cd_amount'];
            $received_amount=0;
            $credit_amount1=$credit_amount1+$credit_amount;
         
            if($settled_status=='Y'){
            $received_amount=$result_login['cd_amount'];
            $received_amount1=$received_amount1+$received_amount;
            }
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'].' - '.$result_login['ly_mobileno'] ;   
            }
            if($result_login['dine_bill_total']!=''){
             $billamount=$result_login['dine_bill_total'];   
            }
            else if($result_login['ta_bill_total']!=''){
             $billamount=$result_login['ta_bill_total'];   
            }
            $balance=round($credit_amount,2)-round($received_amount,2);
            if($balance<1){
                $balance=0;
            }   
            
           $crd_partial=$crd_partial+$result_login['tcp_amount'];
            
            
            $balance1=$balance1+$balance;
        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td ><?=$result_login['cd_dayclosedate']?></td>
                            <td ><?=$result_login['ct_credit_type']?></td>
                            <td ><?=$creditperson?></td>
                           
                            <td ><?=$result_login['cd_billno']?></td>
                            <td ><?=number_format($billamount,3)?></td>
                            <td ><?=number_format($result_login['tcp_amount'],3)?></td>
                            <td ><?=$result_login['tcp_login']?></td>
                           
                            <?php if($result_login['tcp_mode']=='1'){ ?>
                            <td >Cash</td>
                            <?php }else{ ?>
                            
                              <td >Card</td>
                            <?php } ?>
                            
                            
                            <td ><?=$result_login['tcp_date']?></td>
                        </tr>     
        <?php
        }  
    }
}

    ?>
                        <tr>
                            <td>Total</td>
                            <td ></td>
                            <td ></td>
                           
                           
                            <td ></td>
                            <td ></td>
                            <td ><?=number_format($credit_amount1,3)?></td>
                            <td ><?=number_format($crd_partial,3)?></td>
                            <td ></td>
                            <td ></td>
                              <td ></td>
                        </tr> 
                        
                        
             <div class="inv-pagination" style="bottom: -33px;position: 
    absolute;background-color: #fff;padding: 0rem;z-index: 999;
    border: solid;background-color: #382f2f;border-radius: 30px;">
                                         
                                        <?php 
                                       
                                        $m=0;
                                     
                                        $p1=floor(($i/$lt)+1);
                                        
                                        ?>
                                        <a style="color:white" href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi0" onClick="return pagination('<?=$m?>','1');" >
                                        <strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p1;$j++){
                                          
                                        ?>
                                        <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p1?>"> 
                                        <a href="#" <?php if(($p1-1)==$j){ ?> style="color: black;border: solid 1px;padding: 1px;border-radius: 5px;padding-left: 2px;margin: 0px 4px;background-color: white" <?php } ?> style="padding-left: 2px;margin: 0px 4px;color:white" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong> <?=$j?> </strong></a>
                                        <?php $m=$m+$lt;
                                          
                                        }
                                        
                                        $m=$m-$lt;
                                        ?>
                                      
                                        <a style="color:white" href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$i?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
                                   
                                        <span style="color: #fff;margin: 0 10px;">[<?=$lt?> records]</span>

       </div>              
                        
                      <tbody>
                      </table>
    
    
     
    
<?php

}    
      


}
else if(($_REQUEST['type']=="tips_collected_consolidated"))
{
     	$reporthead='';
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND tab_payment_settled='Y' AND ";
        $st= "";
	$view_mode='';
	$view_mode=$_REQUEST['modeofview'];
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
          $st= " Last 5 days ";      
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $st= " Last 10 days ";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                    $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                    $st= " YESTER DAY ";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $st= " Last 30 days ";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                   $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                   $st= " Last 1 Month ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $st= " Today ";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st= " Last 90 days ";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $st= " Last 180 days ";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $st= " Last 1 Year ";
	}
        $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead= " On ".$from;
	}
		
	
	}
        ?>
                <table class="table table-bordered table-font user_shadow" >
                    <thead>
                        <tr>
                            <th colspan="9">Tips Collected Report - <?=$reporthead?></td>
                        </tr>
                            
                        <tr>
                            <th><?php if($view_mode=='summary') { echo 'Sl.No';} else if($view_mode=='detailed'){ echo 'Bill No';} ?></th>
                            <th >CASH</th>
                            <th >CARD</th>
                            <th >TOTAL</th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                      
	<?php
       
        
         $tips_details=array();
        if($view_mode=='summary'){
            $sql_tip  =  $database->mysqlQuery("select sum(tip) as tip,mode,date from(
                                                select sum( bm_tips_given) as tip,bm_tips_mode as mode,bm_dayclosedate as date FROM tbl_tablebillmaster where $string group by bm_dayclosedate,bm_tips_mode   union all
                                                select sum(tab_tips_given) as tip,tab_tips_mode as mode,tab_dayclosedate as date  FROM tbl_takeaway_billmaster  where $stringta group by tab_dayclosedate,tab_tips_mode
                                                )x  group by mode,date order by date,mode");
            
            $num_tip   = $database->mysqlNumRows($sql_tip);
            if($num_tip)
            {   
                while($result_tip = $database->mysqlFetchArray($sql_tip)){
                   
                    $tips_details[$result_tip['date']][$result_tip['mode']]=$result_tip['tip'];
                    
                }
                $i=0;
                $total_tip_cash=0;
                $total_tip_card=0;
                $total_tip=0;
                foreach($tips_details as $key=>$val){
                    $total_tip_each_day=0;
                    foreach($val as $key1=>$val1){
                        $total_tip_each_day=$total_tip_each_day+$val1;
                        $total_tip=$total_tip+$val1;
                        if($key1=='C'){
                           $total_tip_cash=$total_tip_cash+$val1;
                        }else if($key1=='D'){
                            $total_tip_card=$total_tip_card+$val1;
                        }
                    }
                  $i++;  
                ?>
                    <tr>
                        <td colspan="4"><strong>Date: <?=$key?></strong></td>
                    </tr>
                    <tr>
                        <td><?=$i?></td>
                        <td><?php if(array_key_exists('C',$val)){ echo number_format($val['C'],$_SESSION['be_decimal']);} else{ echo number_format(0,$_SESSION['be_decimal']);}?></td>
                        <td><?php if(array_key_exists('D',$val)){ echo number_format($val['D'],$_SESSION['be_decimal']);} else{ echo number_format(0,$_SESSION['be_decimal']);}?></td>
                        <td><?=number_format($total_tip_each_day,$_SESSION['be_decimal'])?></td>
                    </tr>
                <?php    
                }
                ?>
                    <tr>
                        <td><strong>TOTAL</strong></td>
                        <td><strong><?=number_format($total_tip_cash,$_SESSION['be_decimal'])?></strong></td>
                        <td><strong><?=number_format($total_tip_card,$_SESSION['be_decimal'])?></strong></td>
                        <td><strong><?=number_format($total_tip,$_SESSION['be_decimal'])?></strong></td>
                    </tr>
                
            <?php    
            }
        }
        else if($view_mode=='detailed'){
            $sql_tip  =  $database->mysqlQuery("select bm_billno,bm_tips_given as tip,bm_tips_mode as mode,bm_dayclosedate as date FROM tbl_tablebillmaster where $string AND bm_tips_given>0 group by bm_dayclosedate,bm_tips_mode,bm_billno   union all
                                                select tab_billno,tab_tips_given as tip,tab_tips_mode as mode,tab_dayclosedate as date  FROM tbl_takeaway_billmaster  where $stringta AND tab_tips_given>0 group by tab_dayclosedate,tab_tips_mode,tab_billno");
            
            $num_tip   = $database->mysqlNumRows($sql_tip);
            if($num_tip)
            {   
                while($result_tip = $database->mysqlFetchArray($sql_tip)){
                   
                    $tips_details[$result_tip['date']][$result_tip['bm_billno']][$result_tip['mode']]=$result_tip['tip'];
                    
                }
                $i=0;
                $total_tip_cash=0;
                $total_tip_card=0;
                $total_tip=0;
                foreach($tips_details as $key2=>$val2){ ?>
                    <tr>
                        <td colspan="4"><strong>Date: <?=$key2?></strong></td>
                    </tr>
                <?php    
                    foreach($val2 as $key=>$val){
                        $total_tip_each_day=0;
                        foreach($val as $key1=>$val1){
                            $total_tip_each_day=$total_tip_each_day+$val1;
                            $total_tip=$total_tip+$val1;
                            if($key1=='C'){
                               $total_tip_cash=$total_tip_cash+$val1;
                            }else if($key1=='D'){
                                $total_tip_card=$total_tip_card+$val1;
                            }
                        }
                        
                    ?>
                       
                        <tr>
                            <td><?=$key?></td>
                            <td><?php if(array_key_exists('C',$val)){ echo number_format($val['C'],$_SESSION['be_decimal']);} else{ echo number_format(0,$_SESSION['be_decimal']);}?></td>
                            <td><?php if(array_key_exists('D',$val)){ echo number_format($val['D'],$_SESSION['be_decimal']);} else{ echo number_format(0,$_SESSION['be_decimal']);}?></td>
                            <td><?=number_format($total_tip_each_day,$_SESSION['be_decimal'])?></td>
                        </tr>
                    <?php    
                    }
                }
                    ?>
                    <tr>
                        <td><strong>TOTAL</strong></td>
                        <td><strong><?=number_format($total_tip_cash,$_SESSION['be_decimal'])?></strong></td>
                        <td><strong><?=number_format($total_tip_card,$_SESSION['be_decimal'])?></strong></td>
                        <td><strong><?=number_format($total_tip,$_SESSION['be_decimal'])?></strong></td>
                    </tr>
                <?php    
                }    
        }
       
}
else if(($_REQUEST['type']=="billwise_item_cr"))
{
$reporthead="";
$st="";

	$string="";
	$string=" bm.bm_status='Closed' AND ";
	$sort_string='';
        $sort_string1='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

	}
    }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  
                                  <tr>
                                	<th colspan="9">Report - <?=$reporthead?></th>
                                  </tr>
                                  
									<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Time</th>
                                     <th class="sortable">Bill NO</th>
									  <th class="sortable">Items</th>
                                      <th class="sortable">Portion</th>
                                      <th class="sortable">Quantity</th>
                                      <th class="sortable">Rate</th>
                                      <th class="sortable">Discount</th>
                                     
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php
   
    
                                          
                                          
 $final=0;
 $dsc=0;
 $dscfinal=0;
  if($_REQUEST['comp_item']!='comp'){
  $sql_login  =  $database->mysqlQuery("SELECT td.bd_unit_weight,td.bd_unit_type,bm.bm_billtime,td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1 "); 

   }else{
      $sql_login  =  $database->mysqlQuery("SELECT to1.ter_rate_before_comp,td.bd_unit_weight,td.bd_unit_type,bm.bm_billtime,td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno left join tbl_tableorder to1 on to1.ter_menuid= td.bd_menuid and td.bd_billno=to1.ter_billnumber  WHERE to1.ter_rate_before_comp >0 and  $string $sort_string1 group by td.bd_billno,mn.mr_menuname,pm.pm_portionname"); 
    }
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          
          ?>
           <tr class="main" style="background-color: lightgray ">
      <td></td>  
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ><strong>DI</strong></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     
  </tr>
    <?php      
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                               if($_REQUEST['comp_item']!='comp'){
				$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
                               }else{
                                 $final=$final + ($result_login['ter_rate_before_comp'] * $result_login['bd_qty']);  
                               }
                               
                               
				if($i==1)
				{
					
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
                                        
					 if($_REQUEST['comp_item']!='comp'){
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
                                         }else{
                                           $each=$each + ($result_login['ter_rate_before_comp'] * $result_login['bd_qty']);  
                                         }
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					?>
                     <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                    <td><?=$result_login['bm_billtime']?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>] </td>
                   <td><?=$result_login['bd_qty']?></td>
                   
                   <?php  if($_REQUEST['comp_item']!='comp'){ ?>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   
                   <?php } else{ ?>
                   <td><?=number_format(($result_login['ter_rate_before_comp'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                    <?php }  ?>
                   
                   <td></td>
                  </tr> 
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					
					if($new==$old)
					{
                                             if($_REQUEST['comp_item']!='comp'){
                                            $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
                                        }else{
                                             $each=$each + ($result_login['ter_rate_before_comp'] * $result_login['bd_qty']);
                                        }
						?>
                      <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>]</td>
                   <td><?=$result_login['bd_qty']?></td>
                    <?php  if($_REQUEST['comp_item']!='comp'){ ?>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <?php } else{ ?>
                   <td><?=number_format(($result_login['ter_rate_before_comp'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                    <?php }  ?>
                   <td></td>
                  </tr> 
                      <?php
					}else
					{
						
						?>
                         <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php $each=0;$dsc=0;
                  
                    if($_REQUEST['comp_item']!='comp'){
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
                                  }else{
                                             $each=$each + ($result_login['ter_rate_before_comp'] * $result_login['bd_qty']);
                                        } 
                                  
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				   ?>
                      <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                     <td><?=$result_login['bm_billtime']?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>]</td>
                   <td><?=$result_login['bd_qty']?></td>
                   
                    <?php  if($_REQUEST['comp_item']!='comp'){ ?>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                    <?php } else{ ?>
                   <td><?=number_format(($result_login['ter_rate_before_comp'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                    <?php }  ?>
                   
                   <td></td>
                  </tr> 
                  <?php
					}
				}
				$i++;
	       ?>

               
     <?php 
	 } ?>
     
      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  
                  
                   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
    <td ></td>
      <td ></td>
     
  </tr>
                  
                  
                  <?php } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
      <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>GRAND TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td colspan="2"><strong><?=number_format(($final-$dscfinal),$_SESSION['be_decimal'])?> /-</strong></td>
     
  </tr>
                              
                             
                           
                            
                            <?php
                            
                            
        $stringt="";
	$stringt=" tbm.tab_status='Closed' ";
        $sort_string='';
        $sort_string1='';
       
	$reporthead="";
	
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					
					
				
	else 
	
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $stringt.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$stringt.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$stringt.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Last90days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	
	?>
    
    
	
									
                                          <?php
 $final1=0; 
  $dsc=0;
 $dscfinal1=0;
  if($_REQUEST['comp_item']!='comp'){
 $sql_login  =  $database->mysqlQuery("select tbd.tab_unit_type,tbd.tab_unit_weight,tbm.tab_time,tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $stringt $sort_string1 "); 
  }else{
      
     $sql_login  =  $database->mysqlQuery("select tbd.tab_rate_before_comp,tbd.tab_unit_type,tbd.tab_unit_weight,tbm.tab_time,tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where tbd.tab_rate_before_comp>0 and  $stringt $sort_string1 "); 
   
  }
 
 $old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          ?>
           <tr class="main" style="background-color: lightgray ">
      <td></td>  
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ><strong>TA-HD-CS</strong></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     
  </tr>
    <?php      
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      if($_REQUEST['comp_item']!='comp'){
			$final1=$final1+($result_login['tab_rate'] * $result_login['tab_qty']);
                      }else{
                        $final1=$final1+($result_login['tab_rate_before_comp'] * $result_login['tab_qty']);  
                      }
                      
                      
                        if($i==1)
				{
					
					$dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
					$dsc=$dsc + ($result_login['tab_discountvalue']);
                                        
                                         if($_REQUEST['comp_item']!='comp'){
					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                                         }else{
                                          $each=$each + ($result_login['tab_rate_before_comp'] * $result_login['tab_qty']);   
                                         }
//					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					$old=$result_login['tab_billno'];
					$new=$result_login['tab_billno'];
	 ?>

    						<tr >
                            <td><?=$k++?></td>
                             
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>
                               	<td><?=$result_login['tab_time'];?></td>
				<td><?=$result_login['tab_billno'];?></td>
                               
                               <td><?=$result_login['mr_menuname'];?></td>
                               
                                <td><?=$result_login['pm_portionname']?> <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
				<td><?=$result_login['tab_qty'];?></td>
                                
                                <?php if($_REQUEST['comp_item']!='comp'){ ?>
		               <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                               
                                <?php } else{ ?>
                               <td><?=number_format(($result_login['tab_rate_before_comp'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                                <?php }  ?>
                             <td></td>
                              </tr> 
                             
                              <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['tab_billno'];
					
					if($new==$old)
					{
                                            if($_REQUEST['comp_item']!='comp'){ 
                                            $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                                            }else{
                                               $each=$each + ($result_login['tab_rate_before_comp'] * $result_login['tab_qty']);  
                                            }
						?>
                      <tr>
                   <td></td>
                     <td></td>
                   <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
                   <td><?=$result_login['tab_qty']?></td>
                   
                    <?php if($_REQUEST['comp_item']!='comp'){ ?>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <?php } else{ ?>
                               <td><?=number_format(($result_login['tab_rate_before_comp'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                                <?php }  ?>
                   
                   
                   
                   <td></td>
                  </tr> 
                      <?php
					}else
					{
						
						?>
                  
                         <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  
                   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
    <td ></td>
      <td ></td>
     
  </tr>
                  
                  
                  <?php $each=0;$dsc=0;
                  if($_REQUEST['comp_item']!='comp'){ 
				  $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                  }else{
                      $each=$each + ($result_login['tab_rate_before_comp'] * $result_login['tab_qty']);
                  }         
                                  
                                  
				  $dsc=$dsc + ($result_login['tab_discountvalue']);
				  $dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
				   ?>
                      <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                    	<td><?=$result_login['tab_time'];?></td>
                   <td><?=$result_login['tab_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
                   <td><?=$result_login['tab_qty']?></td>
                    <?php if($_REQUEST['comp_item']!='comp'){ ?>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <?php } else{ ?>
                   <td><?=number_format(($result_login['tab_rate_before_comp'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                    <?php }  ?>
                                      
                   <td></td>
                  </tr> 
                  <?php
			}
				}
				$i++;
	       ?>

               
     <?php 
	 } ?>
      <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
    <td ></td>
      <td ></td>
     
  </tr>
      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td ><strong><?=number_format($final1,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal1,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>GRAND TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td colspan="2"><strong><?=number_format(($final1-$dscfinal1),$_SESSION['be_decimal'])?> /-</strong></td>
     
  </tr>
  
  
  
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
    <td ></td>
      <td ></td>
     
  </tr>
  
  <?php 
  $all_fin=0;
  $di_fin=0;
  $tch_fin=0;
  $di_fin=$final-$dscfinal;
  $tch_fin=$final1-$dscfinal1;
  
  
  $all_fin=$di_fin+$tch_fin;
  ?>
  
  
  
  <tr class="main">
      <td colspan="2" style="font-weight: bold " > Sub Total (All Modules) : </td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ><strong style="background-color: lightcoral "><?=number_format($all_fin,$_SESSION['be_decimal']) ?> </strong></td>
     
  </tr>
  
  
                      
                             
                           </tbody>
                            </table>
                            
                            <?php                    
                            
                            
}
else if(($_REQUEST['type']=="billwise_item_cr1"))
{
$reporthead="";
$st="";

	$string="";
	$string=" bm.bm_status='Closed' AND ";
	$sort_string='';
        $sort_string1='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

	}
    }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
            
            
            
								 <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="9">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="9"><strong>Sales Summary</strong></th>
      </tr>

      
    
                                  
                                  <tr>
                                	<th colspan="9">Report - <?=$reporthead?></th>
                                  </tr>
                                  
									<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Time</th>
                                     <th class="sortable">Bill NO</th>
									  <th class="sortable">Items</th>
                                      <th class="sortable">Portion</th>
                                      <th class="sortable">Quantity</th>
                                      <th class="sortable">Rate</th>
                                      <th class="sortable">Discount</th>
                                     
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php
 $final=0;
 $dsc=0;
 $dscfinal=0;
  $sql_login  =  $database->mysqlQuery("SELECT td.bd_unit_weight,td.bd_unit_type,bm.bm_billtime,td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1 "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          
          ?>
           <tr class="main" style="background-color: lightgray ">
      <td></td></td>
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ><strong>DI</strong></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     
  </tr>
    <?php      
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
				
				if($i==1)
				{
					
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
					
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					?>
                     <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                    <td><?=$result_login['bm_billtime']?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>]</td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					
						?>
                      <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>]</td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                      <?php
					}else
					{
						
						?>
                         <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php $each=0;$dsc=0;
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				   ?>
                      <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                     <td><?=$result_login['bm_billtime']?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?> <?=$result_login['bd_unit_type']?> [<?=$result_login['bd_unit_weight']?>]</td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                  <?php
					}
				}
				$i++;
	       ?>

               
     <?php 
	 } ?>
     
      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
      <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>GRAND TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td colspan="2"><strong><?=number_format(($final-$dscfinal),$_SESSION['be_decimal'])?> /-</strong></td>
     
  </tr>
                              
                             
                           
                            
                            <?php
                            
                            
        $stringt="";
	$stringt=" tbm.tab_status='Closed' ";
        $sort_string='';
        $sort_string1='';
       
	$reporthead="";
	
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					
					
				
	else 
	
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $stringt.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$stringt.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$stringt.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Last90days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	
	?>
    
    
	
									
                                          <?php
 $final1=0; 
  $dsc=0;
 $dscfinal1=0;
 
$sql_login  =  $database->mysqlQuery("select tbd.tab_unit_type,tbd.tab_unit_weight,tbm.tab_time,tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $stringt $sort_string1 "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          ?>
           <tr class="main" style="background-color: lightgray ">
      <td ></td> 
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ><strong>TA-HD-CS</strong></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     
  </tr>
    <?php      
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final1=$final1+($result_login['tab_rate'] * $result_login['tab_qty']);
                        
                        if($i==1)
				{
					
					$dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
					$dsc=$dsc + ($result_login['tab_discountvalue']);
					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
//					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					$old=$result_login['tab_billno'];
					$new=$result_login['tab_billno'];
	 ?>

    						<tr >
                            <td><?=$k++?></td>
                             
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>
                               	<td><?=$result_login['tab_time'];?></td>
				<td><?=$result_login['tab_billno'];?></td>
                               
                               <td><?=$result_login['mr_menuname'];?></td>
                               
                                <td><?=$result_login['pm_portionname'];?>  <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
				<td><?=$result_login['tab_qty'];?></td>
		               <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                             <td></td>
                              </tr> 
                             
                              <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['tab_billno'];
					
					if($new==$old)
					{
                                            $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
						?>
                      <tr>
                   <td></td>
                     <td></td>
                   <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?>  <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
                   <td><?=$result_login['tab_qty']?></td>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                      <?php
					}else
					{
						
						?>
                         <tr>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php $each=0;$dsc=0;
				  $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
				  $dsc=$dsc + ($result_login['tab_discountvalue']);
				  $dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
				   ?>
                      <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                    	<td><?=$result_login['tab_time'];?></td>
                   <td><?=$result_login['tab_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?>  <?=$result_login['tab_unit_type']?> [<?=$result_login['tab_unit_weight']?>]</td>
                   <td><?=$result_login['tab_qty']?></td>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                  <?php
			}
				}
				$i++;
	       ?>

               
     <?php 
	 } ?>
     
      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td ><strong><?=number_format($final1,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal1,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong>GRAND TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td colspan="2"><strong><?=number_format(($final1-$dscfinal1),$_SESSION['be_decimal'])?> /-</strong></td>
     
  </tr>
  
  
  
  
   <tr class="main">
    <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ></td>
     <td ></td>
     <td ></td>
    <td ></td>
      <td ></td>
     
  </tr>
  
  <?php 
  $all_fin=0;
  $di_fin=0;
  $tch_fin=0;
  $di_fin=$final-$dscfinal;
  $tch_fin=$final1-$dscfinal1;
  
  
  $all_fin=$di_fin+$tch_fin;
  ?>
  
  
  
  <tr class="main">
      <td colspan="2" style="font-weight: bold " > Sub Total (All Modules) : </td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
  
     <td ></td>
     <td ></td>
      <td ></td>
      <td ><strong style="background-color: lightcoral "><?=number_format($all_fin,$_SESSION['be_decimal']) ?> </strong></td>
     
  </tr>
  
  
                      
                             
                           </tbody>
                            </table>
                            
                            <?php                    
                            
                            
}
else if(($_REQUEST['type']=="expense_acc_report"))
{
	      $string="";
        $stringev="";
        $stringsu="";
        $stringln="";
        $stringasp="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);

			$string.= " ev_date between '".$from."' and '".$to."' ";
      $stringev.= " ev_date between '".$from."' and '".$to."' ";
      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $stringln.= "tla_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to;
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");

			$string.= " ev_date between '".$from."' and '".$to."' ";
      $stringev.= " ev_date between '".$from."' and '".$to."' ";
      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $stringln.= "tla_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ev_date between '".$from."' and '".$to."' ";
      $stringev.= " ev_date between '".$from."' and '".$to."' ";
      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $stringln.= "tla_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to;
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{

	
	if($bydatz=="Last5days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
    $stringev.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";               
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )"; 
    $reporthead.= "Last 5 days";
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $stringev.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $reporthead.= "Last 10 days";
                
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" ev_date = CURDATE() - INTERVAL 1 day";
    $stringev.=" ev_date = CURDATE() - INTERVAL 1 day";
    $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
    $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
    $stringln.=" tla_date = CURDATE() - INTERVAL 1 day";
    $reporthead.= "Yesterday";
	}

	elseif($bydatz=="Last15days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $stringev.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )"; 
    $reporthead.= "Last 15 days"; 
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
    $stringev.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
    $reporthead.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
    $stringev.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
    $reporthead.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
    $stringev.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
    $reporthead.= "Last 30 days";
	}
	else if($bydatz=="Last1month")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $stringev.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
    $reporthead.= "Last 1 month"; 
	}
	else if($bydatz=="Today")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
    $stringev.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";  
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";    
    $reporthead.= "Today"; 
                
	}
else if($bydatz=="Last90days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
    $stringev.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
    $reporthead.= "Last 3 month"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $stringev.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
    $reporthead.= "Last 6 month"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
    $stringev.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  
    $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
    $reporthead.= "Last 1 Year"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "ev_date between '".$from."' and '".$to."' ";
    $stringev.= "ev_date between '".$from."' and '".$to."' ";
    $stringsu.= "sv_date between '".$from."' and '".$to."' ";
    $stringasp.= "tpd_date between '".$from."' and '".$to."' ";
    $stringln.= "tla_date between '".$from."' and '".$to."' ";
    $reporthead.= $from.' - '.$to;
	}	
	} ?>


 <table class="table table-bordered table-font user_shadow" >
                    <thead>
                        <tr>
                            <th colspan="7">Account Expense Report - <?=$reporthead?> </td>
                        </tr>
                            
                      <tr>
                            <th >Date</th>
                            <th >Invoice No </th>
                            <th >From Acc</th>
                            <th >To Acc</th>
                            <th >Particulars</th>
                            <th >Amount</th>    
                            <th >Acc Type</th>                                              
                        </tr>                       
                    </thead>

                    <tbody>
	
	<?php
        
        if($_REQUEST['from_ledger']!=''){           
            $string.=    " and ev_from_acc = '".$_REQUEST['from_ledger']."'   " ;            
            $stringsu.=     " and sv_from = '".$_REQUEST['from_ledger']."'   " ;             
            $stringev.=    " and ev_from = '".$_REQUEST['from_ledger']."'   " ;  
            $stringasp.=     " and tpd_from_acc = '".$_REQUEST['from_ledger']."'   " ; 
            $stringln.=   " and tla_from = '".$_REQUEST['from_ledger']."'   " ;          
        }

        if($_REQUEST['to_ledger']!=''){            
            $string.=  " and ev_to_acc = '".$_REQUEST['to_ledger']."'   " ;            
            $stringsu.=     " and sv_vendor_id = '".$_REQUEST['to_vendor']."'   " ;             
            $stringev.=     " and ev_employee_id = '".$_REQUEST['to_staff']."'   " ; 
            $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;
            $stringln.=   " and tla_to = '".$_REQUEST['to_ledger']."'   " ;          
        }

        $final=0; $final1=0 ; $final2=0;
        
        if($_REQUEST['acc_type']==''){

   /////////expense voucher////
  $sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_amount,ev_date,ev_remarks,ev_from_acc,ev_to_acc from tbl_expense_voucher  where $string"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {         
                $final=$final+$result_hourly_wise['ev_amount'];
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['ev_entry_time']?></td>
                        <td><?=$result_hourly_wise['ev_id']?></td>
                              
                        <?php
                                              
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}  else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php } ?> 
                                              
                                       
                         <td><?=$result_hourly_wise['ev_remarks']?></td>                      
                        <td><?=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal'])?></td>
                        <td>Expense Voucher</td>
                    </tr>  
                              
       <?php
    
        }}
        
        
        
        $final1=0;
        ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_entry_time,sv_id,sv_paid_amount,sv_date,sv_remarks,sv_invoice_no,sv_from,sv_vendor_id from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                               
          
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['sv_entry_time']?></td>
                        <td><?=$result_hourly_wise['sv_id']?></td>
                   
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}  else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php } ?> 
                                        
                          <td><?=$result_hourly_wise['sv_remarks']?></td>
                        <td><?=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal'])?></td>
                        <td>Supplier Voucher</td>
                        
                    </tr>  
                          
    <?php
        }}
        $final2=0;
    ///////employee voucher///
        $sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_amount,ev_date,ev_remarks,ev_from,ev_employee_id from tbl_employee_voucher where $stringev"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final2=$final2+$result_hourly_wise['ev_amount'];
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['ev_entry_time']?></td>
                        <td><?=$result_hourly_wise['ev_id']?></td>
                      
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  ?> 
                                        <td><?=$result_hourly_wise['ev_remarks']?></td>
                        <td><?=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal'])?></td>
                        <td>Employee Voucher</td>
                        
                        
                    </tr>  
    
    
    <?php
        }}

        $final3=0;
        $sql_logincashier  =  $database->mysqlQuery("select tpd_id,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
        $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
          {
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                      $final3=$final3+$result_hourly_wise['tpd_paid_amount'];
                   ?>
                            <tr>
                                <td><?=$result_hourly_wise['tpd_date']?></td>
                                <td><?=$result_hourly_wise['tpd_id']?></td>
                                 <?php
                                    $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                                $num_login88   = $database->mysqlNumRows($sql_login88);
                  if($num_login88){                                        
                  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                  {  ?>
                                 <td ><?=$result_login88['tlm_ledger_name']?></td>
                                                <?php }}else{ ?>
                                                <td ></td>    
                                                <?php }   
                                $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
                          $num_login88   = $database->mysqlNumRows($sql_login88);
                  if($num_login88){
                            while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                  { ?>
                                                      <td><?=$result_login88['tlm_ledger_name']?></td>
                                                <?php }} else{ ?>
                                                  <td ></td>    
                                                <?php }  ?> 
                                <td><?=$result_hourly_wise['tpd_remarks']?></td>  
                                <td><?=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal'])?></td> 
                                <td>Asset Supplier Voucher</td>
                                                    
                            </tr>                    
            <?php
                }}

                
        $final4=0;
        ///////loan voucher///   
        $sql_logincashier  =  $database->mysqlQuery("SELECT tla_id,tla_date,tla_from,tla_to,tla_amount,tla_particulars  FROM `tbl_loan_advance` where tla_amount!='' and $stringln"); 
        $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
       if($num_logincashier)
        {
           while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
           {
               $p++;
                    $final4=$final4+$result_hourly_wise['tla_amount'];
               ?>
                        <tr>
                            <td><?=$result_hourly_wise['tla_date']?></td>
                            <td><?=$result_hourly_wise['tla_id']?></td>                 
                             <?php
                                    $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
                                $num_login88   = $database->mysqlNumRows($sql_login88);
                        if($num_login88){
                        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                        {  ?>
                             <td ><?=$result_login88['tlm_ledger_name']?></td>
                                            <?php }}else{ ?>
                                              <td ></td>    
                                            <?php }   
                            $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
                            $num_login88   = $database->mysqlNumRows($sql_login88);
                        if($num_login88){
                        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                        {  ?>
                                 <td><?=$result_login88['tlm_ledger_name']?></td>
                                            <?php }}  else{ ?>
                                            <td ></td>    
                                           <?php }  ?> 
                             <td><?=$result_hourly_wise['tla_particulars']?></td>
                            <td><?=number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal'])?></td>
                            <td>Loan Voucher</td>
                              
                        </tr>  
        <?php
            }}
        
        
        }else if($_REQUEST['acc_type']=='exp_acc'){
        
        
        
   /////////expense voucher////
         $sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_amount,ev_date,ev_remarks,ev_from_acc,ev_to_acc from tbl_expense_voucher  where $string"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
          
                                $final=$final+$result_hourly_wise['ev_amount'];
                               
          
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['ev_entry_time']?></td>
                        <td><?=$result_hourly_wise['ev_id']?></td>
                        
                      
                                <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }               
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}  else{ ?>

                                          <td ></td>    
                                        <?php } ?>   
                                        <td><?=$result_hourly_wise['ev_remarks']?></td>                
                        <td><?=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal'])?></td>  
                        <td>Expense Voucher</td>
                                        
                    </tr>                
       <?php
    
        }}
        
        }else if($_REQUEST['acc_type']=='sup_acc'){
            
            
            
              ///////supplier voucher///
  $sql_logincashier  =  $database->mysqlQuery("select sv_entry_time,sv_id,sv_paid_amount,sv_date,sv_remarks,sv_invoice_no,sv_from,sv_vendor_id from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                               
          
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['sv_entry_time']?></td>
                        <td><?=$result_hourly_wise['sv_id']?></td>
                         
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  ?> 
                                        <td><?=$result_hourly_wise['sv_remarks']?></td>
                        <td><?=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal'])?></td>
                        <td>Supplier Voucher</td>
                        
                        
                    </tr>  
                          
    <?php
        }}
            
            
            
        }else if($_REQUEST['acc_type']=='emp_acc'){
            
            ///////employee voucher///
        $sql_logincashier  =  $database->mysqlQuery("select ev_entry_time, ev_id,ev_amount,ev_date,ev_remarks,ev_from,ev_employee_id from tbl_employee_voucher where $stringev"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final2=$final2+$result_hourly_wise['ev_amount'];
                               
          
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['ev_entry_time']?></td>
                        <td><?=$result_hourly_wise['ev_id']?></td>
                      
              
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}  else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php } ?> 
                                        <td><?=$result_hourly_wise['ev_remarks']?></td>
                        <td><?=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal'])?></td>
                        <td>Employee Voucher</td>
                         
                        
                    </tr>  
    
    
    <?php
        }}
            
        }
        ///////------------------------asset supplier voucher--------------------///  
else if($_REQUEST['acc_type']=='asset_acc')
{
    $final3=0;
$sql_logincashier  =  $database->mysqlQuery("select tpd_id,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
if($num_logincashier)
{
   while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
   {
       $p++;
          $final3=$final3+$result_hourly_wise['tpd_paid_amount'];
       ?>
                <tr>
                    <td><?=$result_hourly_wise['tpd_date']?></td>
                    <td><?=$result_hourly_wise['tpd_id']?></td>
                     <?php
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                    $num_login88   = $database->mysqlNumRows($sql_login88);
      if($num_login88){                                        
      while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
      {  ?>
                     <td ><?=$result_login88['tlm_ledger_name']?></td>
                                    <?php }}else{ ?>
                                    <td ></td>    
                                    <?php }   
                    $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
              $num_login88   = $database->mysqlNumRows($sql_login88);
      if($num_login88){
                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
      { ?>
                                          <td><?=$result_login88['tlm_ledger_name']?></td>
                                    <?php }} else{ ?>
                                      <td ></td>    
                                    <?php }  ?> 
                    <td><?=$result_hourly_wise['tpd_remarks']?></td>  
                    <td><?=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal'])?></td> 
                    <td>Asset Supplier Voucher</td>
                                        
                </tr>                    
<?php
    }}
   
}
     ///////-----------loan voucher------------------/// 
     else if($_REQUEST['acc_type']=='loan_acc')
     {
         $final4=0;        
         $sql_logincashier  =  $database->mysqlQuery("SELECT tla_id,tla_date,tla_from,tla_to,tla_amount,tla_particulars  FROM `tbl_loan_advance` where tla_amount!='' and $stringln"); 
         $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
        if($num_logincashier)
         {
            while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
            {
                $p++;
                     $final4=$final4+$result_hourly_wise['tla_amount'];
                ?>
                         <tr>
                             <td><?=$result_hourly_wise['tla_date']?></td>
                             <td><?=$result_hourly_wise['tla_id']?></td>                 
                              <?php
                                     $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
                                 $num_login88   = $database->mysqlNumRows($sql_login88);
                         if($num_login88){
                         while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                         {  ?>
                              <td ><?=$result_login88['tlm_ledger_name']?></td>
                                             <?php }}else{ ?>
                                               <td ></td>    
                                             <?php }   
                             $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
                             $num_login88   = $database->mysqlNumRows($sql_login88);
                         if($num_login88){
                         while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                         {  ?>
                                  <td><?=$result_login88['tlm_ledger_name']?></td>
                                             <?php }}  else{ ?>
                                             <td ></td>    
                                            <?php }  ?> 
                             <td><?=$result_hourly_wise['tla_particulars']?></td>
                             <td><?=number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal'])?></td>
                             <td>Loan Voucher</td>                           
                         </tr>  
         <?php
             }}
     }
    ?>
     
        <tr>
            <td style="font-weight:bold">Total</td>
                         <td></td>
                         <td></td>
                          <td></td>
                         <td></td> 
                         <td><?=number_format(($final+$final1+$final2+$final3+$final4),$_SESSION['be_decimal'])?></td>   
                          <td></td>  
                          
<?php
}
else if(($_REQUEST['type']=="mult_card_bank_report"))
{ 

        $stringsu="";
        $stringasp="";
        
          $stringsu.= " bm.bm_status='Closed' and bm.bm_complimentary!='Y' and ";
          $stringasp.= "  tbm.tab_status='Closed' and tbm.tab_complimentary!='Y' and ";
        
        
        
        if($_REQUEST['bank_name']!="" )
	{
            
              $stringsu.= "    tbc.mc_to_bank ='".$_REQUEST['bank_name']."' and ";
              
              $stringasp.= "    tbc.mc_to_bank ='".$_REQUEST['bank_name']."' and ";
        }
        
        if($_REQUEST['card_name']!="" )
	{
            
              $stringsu.= "    tbc.mc_cardtype ='".$_REQUEST['card_name']."' and ";
              
              $stringasp.= "    tbc.mc_cardtype ='".$_REQUEST['card_name']."' and ";
        }
        

	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
	{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
                         $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                         $stringasp.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
            
                $reporthead.= $from.' - '.$to;
                
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
            $stringsu.= " sv_date between '".$from."' and '".$to."' ";
            $stringasp.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead.= $from.' - '.$to; 
            
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
            $stringsu.= " sv_date between '".$from."' and '".$to."' ";
            $stringasp.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead.= $from.' - '.$to;
            
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
                
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
        $stringsu.="  bm.bm_dayclosedateate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringasp.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        
        $reporthead.= "Last 5 days";   
	}elseif($bydatz=="Last10days")
	{
        $stringsu.="  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringasp.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $reporthead.= "Last 10 days";     
        
	}
	else if($bydatz=="Yesterday")
	{
        $stringsu.="  bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
        $stringasp.="  tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
        $reporthead.= "Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
        $stringsu.="  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringasp.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $reporthead.= "Last 15 days"; 
	}
	else if($bydatz=="Last20days")
	{
        $stringsu.="  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringasp.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";  
        $reporthead.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
        $reporthead.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
        $reporthead.= "Last 30 days";
	}
	 else if($bydatz=="Last1month")
	{
        $stringsu.="  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
        $stringasp.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
        $reporthead.= "Last 1 month"; 
	}
	else if($bydatz=="Today")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $reporthead.= "Today";   
	}
else if($bydatz=="Last90days")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
        $reporthead.= "Last 3 month"; 
	}
else if($bydatz=="Last180days")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $reporthead.= "Last 6 month"; 
	}
else if($bydatz=="Last365days")
	{
        $stringsu.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $stringasp.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  
        $reporthead.= "Last 1 Year"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
        $stringsu.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringasp.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
        $reporthead.= $from.' - '.$to;
	}
	} ?>
        
        
      
     <table class="table table-bordered table-font user_shadow" >
                    <thead>
                        <tr>
                            <th colspan="6">Multi Card / Bank Report - <?=$reporthead?> </td>
                        </tr>                           
                      <tr>
                            <th >Date</th>
                            <th >Bill No</th>
                                              
                            <th >Customer Card</th>
                            <th >Card No</th>    
                            <th >Bank name </th>
                               
                             <th >Amount</th>           
                                                                   
                        </tr>                        
                    </thead>
                   <tbody>
	<?php

     
        
     $total=0 ;

     
    
    $sql_logincashier  =  $database->mysqlQuery("select total,bill,cardamt, date,cardno, bank,card from( 
    select crm.crd_name as card, bmt.bm_name  as bank, bm.bm_finaltotal AS total,bm.bm_billno as bill,tbc.mc_carnumber as cardno, tbc.mc_cardamount as cardamt, bm.bm_dayclosedate  as date
    FROM tbl_tablebillmaster bm left join tbl_bill_card_payments tbc on tbc.mc_billno=bm.bm_billno
    left join tbl_bankmaster bmt on bmt.bm_id=tbc.mc_to_bank
    left join tbl_cardmaster crm on crm.crd_id=tbc.mc_cardtype  where  $stringsu   union all
    SELECT  crm.crd_name as card, bmt.bm_name as bank,tbm.tab_netamt as total,tbm.tab_billno as bill,tbc.mc_carnumber as cardno, tbc.mc_cardamount as cardamt ,
    tbm.tab_dayclosedate  as date FROM tbl_takeaway_billmaster tbm left join tbl_bill_card_payments tbc on tbc.mc_billno=tbm.tab_billno
    left join tbl_cardmaster crm on crm.crd_id=tbc.mc_cardtype   left join tbl_bankmaster bmt on bmt.bm_id=tbc.mc_to_bank
    WHERE  $stringasp )x where cardamt>0 ");
   $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
            
              
              $total=$total+$result_hourly_wise['cardamt'];
              
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['date']?></td>
                        
                        <td><?=$result_hourly_wise['bill']?></td> 
                       
                        <td><?=$result_hourly_wise['card']?></td> 
                        
                         <td><?=$result_hourly_wise['cardno']?></td> 
                         
                        <td><?=$result_hourly_wise['bank']?></td> 
                        
                        <td><?=number_format($result_hourly_wise['cardamt'],$_SESSION['be_decimal'])?></td> 
                                            
                    </tr>                    
    <?php
        }}
       ?>
  
   
        <tr>
            <td style="font-weight:bold">Total</td>
            <td></td>
           
            
            <td></td>
            <td></td>  
            <td></td>  
            <td><?=number_format(($total),$_SESSION['be_decimal'])?></td>             
            
        </tr>
      <?php
}
else if(($_REQUEST['type']=="purchase_acc_report"))
{
        $stringsu="";
        $stringasp="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);

      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to;
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");

      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
      $stringsu.= " sv_date between '".$from."' and '".$to."' ";
      $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
      $reporthead.= $from.' - '.$to;
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{

	
	if($bydatz=="Last5days")
	{            
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )"; 
    $reporthead.= "Last 5 days";
                
	}elseif($bydatz=="Last10days")
	{
    $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
    $reporthead.= "Last 10 days";
                
	}
	else if($bydatz=="Yesterday")
	{
    $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
    $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
    $reporthead.= "Yesterday";
	}

	elseif($bydatz=="Last15days")
	{
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
    $reporthead.= "Last 15 days"; 
	}
	else if($bydatz=="Last20days")
	{
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
    $reporthead.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
    $reporthead.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
    $reporthead.= "Last 30 days";
	}
	else if($bydatz=="Last1month")
	{
    $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    $reporthead.= "Last 1 month"; 
	}
	else if($bydatz=="Today")
	{
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";  
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";     
    $reporthead.= "Today"; 
                
	}
else if($bydatz=="Last90days")
	{
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";   
    $reporthead.= "Last 3 month"; 
	}
else if($bydatz=="Last180days")
	{
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
    $reporthead.= "Last 6 month"; 
	}
else if($bydatz=="Last365days")
	{ 
    $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
    $stringasp.="tpd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  

    $reporthead.= "Last 1 Year"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");

    $stringsu.= "sv_date between '".$from."' and '".$to."' ";
    $stringasp.= "tpd_date between '".$from."' and '".$to."' ";
    $reporthead.= $from.' - '.$to;
	}	
	} ?>


 <table class="table table-bordered table-font user_shadow" >
                    <thead>
                        <tr>
                            <th colspan="7">Account Expense Report - <?=$reporthead?> </td>
                        </tr>
                            
                      <tr>
                            <th >Date</th>
                            <th >From Acc</th>
                            <th >Supplier</th>
                            <th >Type</th>
                            <th >Invoice Amount</th>    
                            <th >Paid Amount</th>  
                            <th >Credit Amount</th>                                           
                        </tr>                       
                    </thead>

                    <tbody>
	
	<?php
        
        if($_REQUEST['from_ledger']!=''){                     
            $stringsu.=     " and sv_from = '".$_REQUEST['from_ledger']."'   " ;              
            $stringasp.=     " and tpd_from_acc = '".$_REQUEST['from_ledger']."'   " ;          
        }

        if($_REQUEST['to_ledger']!=''){                        
            $stringsu.=     " and sv_vendor_id = '".$_REQUEST['to_vendor']."'   " ;              
            $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;        
        }

        $final=0; $final1=0 ; $final2=0;
        
        if($_REQUEST['pur_acc_type']==''){


        $final1=0;
        ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_invoice_amount,sv_paid_amount,sv_date,sv_credit_amount,sv_invoice_no,sv_from,sv_vendor_id from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
            $final1=$final1+$result_hourly_wise['sv_paid_amount'];

           ?>
                    <tr>
                        <td><?=$result_hourly_wise['sv_date']?></td>
                        
                   
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }}  else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php } ?> 
                           <td>Supplier Voucher</td>             
                           <td><?=number_format($result_hourly_wise['sv_invoice_amount'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($result_hourly_wise['sv_credit_amount'],$_SESSION['be_decimal'])?></td>
                        
                        
                    </tr>  
                          
    <?php
        }}


        $final2=0;
        $sql_logincashier  =  $database->mysqlQuery("select tpd_netamount,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_credit_amount from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
        $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
          {
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                      $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
                   ?>
                            <tr>
                                <td><?=$result_hourly_wise['tpd_date']?></td>
                 
                                 <?php
                                    $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                                $num_login88   = $database->mysqlNumRows($sql_login88);
                  if($num_login88){                                        
                  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                  {  ?>
                                 <td ><?=$result_login88['tlm_ledger_name']?></td>
                                                <?php }}else{ ?>
                                                <td ></td>    
                                                <?php }   
                                $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
                          $num_login88   = $database->mysqlNumRows($sql_login88);
                  if($num_login88){
                            while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                  { ?>
                                                      <td><?=$result_login88['tlm_ledger_name']?></td>
                                                <?php }} else{ ?>
                                                  <td ></td>    
                                                <?php }  ?> 
                                 <td>Asset Supplier Voucher</td>
                                 <td><?=number_format($result_hourly_wise['tpd_netamount'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal'])?></td> 
                                <td><?=number_format($result_hourly_wise['tpd_credit_amount'],$_SESSION['be_decimal'])?></td>
                                
                                                    
                            </tr>                    
            <?php
                }}


  
        
        }
  
        else if($_REQUEST['pur_acc_type']=='sup_acc'){
            
            
            
              ///////supplier voucher///
  $sql_logincashier  =  $database->mysqlQuery("select sv_invoice_amount,sv_paid_amount,sv_date,sv_remarks,sv_credit_amount,sv_from,sv_vendor_id from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                               
          
           ?>
                    <tr>
                        <td><?=$result_hourly_wise['sv_date']?></td>
  
                         
                         <?php
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                         <td ><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            ?>
                                              <td><?=$result_login88['tlm_ledger_name']?></td>
                                        <?php }} else{ ?>
                                            
                                            
                                          <td ></td>    
                                            
                                        <?php }  ?> 
                                        <td>Supplier Voucher</td>
                         <td><?=number_format($result_hourly_wise['sv_invoice_amount'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal'])?></td>
                        <td><?=number_format($result_hourly_wise['sv_credit_amount'],$_SESSION['be_decimal'])?></td>
                       
                        
                        
                    </tr>  
                          
    <?php
        }}
            
            
            
        }
        ///////------------------------asset supplier voucher--------------------///  
else if($_REQUEST['pur_acc_type']=='asset_acc')
{
    $final3=0;
$sql_logincashier  =  $database->mysqlQuery("select tpd_netamount,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_credit_amount from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
if($num_logincashier)
{
   while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
   {
       $p++;
          $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
       ?>
                <tr>
                    <td><?=$result_hourly_wise['tpd_date']?></td>
                    <td><?=$result_hourly_wise['tpd_id']?></td>
                     <?php
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                    $num_login88   = $database->mysqlNumRows($sql_login88);
      if($num_login88){                                        
      while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
      {  ?>
                     <td ><?=$result_login88['tlm_ledger_name']?></td>
                                    <?php }}else{ ?>
                                    <td ></td>    
                                    <?php }   
                    $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
              $num_login88   = $database->mysqlNumRows($sql_login88);
      if($num_login88){
                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
      { ?>
                                          <td><?=$result_login88['tlm_ledger_name']?></td>
                                    <?php }} else{ ?>
                                      <td ></td>    
                                    <?php }  ?> 
                     <td>Asset Supplier Voucher</td>
                     <td><?=number_format($result_hourly_wise['tpd_netamount'],$_SESSION['be_decimal'])?></td> 
                     <td><?=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal'])?></td> 
                    <td><?=number_format($result_hourly_wise['tpd_credit_amount'],$_SESSION['be_decimal'])?></td> 
                    
                                        
                </tr>                    
<?php
    }}
   
}
 
    ?>
     
        <tr>
            <td style="font-weight:bold">Total</td>
                         <td></td>
                         <td></td>
                          <td></td>
                         <td></td> 
                         <td><?=number_format(($final1+$final2),$_SESSION['be_decimal'])?></td>   
                          <td></td>  
                          
<?php
}
else if(($_REQUEST['type']=="bill_cancel_consolidated"))
{
    
    
$reporthead="";
$st="";


if($_REQUEST['department']==''){



	$string="";
	$string=" bm.bm_status='Cancelled' AND ";
	$sort_string='';
        $sort_string1='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

	}
    }
	
	?>
    
    
         <table class="table table-bordered table-font user_shadow" >
       <thead>
                                                                      
       <tr>
       <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="9">
       <img width="80px" src="img/report-logo/reportlogo.png" />
       <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
      <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="9"><strong>BILL CANCEL CONSOLIDATED </strong></th>
      </tr>                                   
                                                                      
                                  
                                  <tr>
                                	<th colspan="9">Report - <?=$reporthead?></th>
                                  </tr>
                                  
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Bill Date</th>
                                     <th class="sortable">Bill No</th>
					<th class="sortable">Cancelled Login</th>
                                        <th class="sortable">Cancelled Date</th>
                                        <th class="sortable">Cancelled By</th>
                                          <th class="sortable">Kot No</th>
                                      <th class="sortable">Total</th>
                                      <th class="sortable">Mode</th>
					</tr>
					</thead>
					<tbody>
									
                                          <?php
  $final=0;
  $dsc=0;
  $dscfinal=0;
  $sql_login  =  $database->mysqlQuery("SELECT bm.ter_cancelledsecretkey,tod.ter_kotno, bm.bm_lastprintime,bm.bm_bill_printed_by, ts.ser_firstname,bm.bm_cancelled_date_time,bm.ter_cancelledlogin,bm.bm_finaltotal,bm.bm_billtime,bm.bm_billno,bm.bm_dayclosedate from  tbl_tablebillmaster  bm  left join tbl_tableorder tod on tod.ter_billnumber=bm.bm_billno left join tbl_staffmaster ts on ts.ser_staffid=bm.ter_cancelledby_careof  WHERE $string $sort_string1 group by bm.bm_billno"); 

 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;$k=1;
          
          ?>
           <tr class="main" style="background-color: lightgray ">
               <td><strong>DINE-IN</strong>  </td>
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
      <td ></td>
  </tr>
    <?php      
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $final_di=$final_di+$result_login['bm_finaltotal'];
                      
					?>
                     <tr>
                   <td><?=$k++?></td>
                   <td><?=$result_login['bm_dayclosedate']?></td>
                   
                   <td><?=$result_login['bm_billno']?></td>
                   
                   <?php if($result_login['ter_cancelledlogin']!=''){ ?>
                   <td><?=$result_login['ter_cancelledlogin'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_bill_printed_by'].' '.$result_login['ter_cancelledsecretkey'];?></td>
                    <?php } ?>
                   
                    
                    
                    
                     <?php if($result_login['bm_cancelled_date_time']!=''){ ?>
                   <td><?=$result_login['bm_cancelled_date_time'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_lastprintime'];?></td>
                    <?php } ?>
                    
                    
                  <?php if($result_login['ter_cancelledsecretkey']==''){ ?>  
                     <?php if($result_login['ser_firstname']!=''){ ?>
                   <td><?=$result_login['ser_firstname'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_bill_printed_by'];?></td>
                    <?php } ?>
                    
                    
                    <?php }else{ ?>
                    <td><?=$result_login['ter_cancelledsecretkey'];?></td>
                    <?php } ?>
                    
                       <td><?=$result_login['ter_kotno'];?></td>
                    
                   <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                 
                    <?php if(substr($result_login['ter_cancelledsecretkey'],0,3)=='USR'){ ?>
                    <td>CLOUD</td>
                   <?php }else{ ?>
                    <td>LOCAL</td>
                   <?php } ?>
                   
                   
                   
                  </tr> 
                  <?php
				
		$i++;
               
	       ?>

               
     
     
     
                        <?php }  $ta_sl=$i; } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
      <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
   <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  
  
  <?php if($_REQUEST['department']=='DI'){ ?>
                                            
  <tr class="main">
    
    <td ><strong>Total</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
    <td ><strong><?=number_format($final_di,$_SESSION['be_decimal'])?></strong></td>
     <td >&nbsp;</td>
  </tr>
<?php }  ?>
                            <?php
                            
                            
        $stringt="";
	$stringt=" tbm.tab_status='Cancelled' ";
        $sort_string='';
        $sort_string1='';
       
	$reporthead="";
	
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					
					
				
	else 
	
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $stringt.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$stringt.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$stringt.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Last90days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	
	?>
    
    
	
									
                                          <?php
 $final1=0; 
  $dsc=0;
 $final1_ta=0; $final1_ta1=0;

$sql_login  =  $database->mysqlQuery("select  tbm.tab_cancelledsecretkey,tbm.tab_kotno,tbm.tab_loginid,tbm.tbl_takeaway_print_time, ts.ser_firstname,tbm.tab_cancelledtime,ts.ser_firstname,tbm.tab_cancelledlogin,tbm.tab_time,tbm.tab_netamt,tbm.tab_billno,tbm.tab_dayclosedate from tbl_takeaway_billmaster tbm  left join tbl_staffmaster ts on ts.ser_staffid=tbm.tab_cancelledby_careof where $stringt $sort_string1"); 

$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=$ta_sl+1;$each=0;$dsc=0;
          ?>
           <tr class="main" style="background-color: lightgray ">
               <td ><strong>TA-HD-CS</strong> </td>
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     <td ></td> 
  </tr>
    <?php      
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
			$final1_ta=$final1_ta+$result_login['tab_netamt'] ;
                   			
	 ?>

    						<tr >
                            <td><?=$k++?></td>
                             
                               <td><?=$result_login['tab_dayclosedate']?></td>
                              
				<td><?=$result_login['tab_billno'];?></td>
                               
                  <?php if($result_login['tab_cancelledlogin']!=''){ ?>
                   <td><?=$result_login['tab_cancelledlogin'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tab_loginid'];?></td>
                    <?php } ?>
                   
                    
                    
                  
                     <?php if($result_login['tab_cancelledtime']!=''){ ?>
                   <td><?=$result_login['tab_cancelledtime'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tbl_takeaway_print_time'];?></td>
                    <?php } ?>
                    
                    
                    
                      <?php if($result_login['tab_cancelledsecretkey']==''){ ?>
                    
                     <?php if($result_login['ser_firstname']!=''){ ?>
                   <td><?=$result_login['ser_firstname'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tab_loginid'];?></td>
                    <?php } ?>
                    
                    
                     <?php }else{ ?>
                    <td><?=$result_login['tab_cancelledsecretkey'];?></td>
                    <?php } ?>
                    
                    
                    
                     <td><?=$result_login['tab_kotno'];?></td>
                     
		              <?php if($result_login['tab_netamt']>0){ ?>
		               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                         <?php }else{ 
                             
                  $item_tot=0; $item_sl=''; $tot_can=0;
                 $sql_login88  =  $database->mysqlQuery("select tc_bill_slno,tc_cancel_qty from tbl_takeaway_cancel_items  where tc_billno='".$result_login['tab_billno']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                              $item_qty=$result_login88['tc_cancel_qty'];
                                              $item_sl=$result_login88['tc_bill_slno'];
                                     $item_rate=0;         
                             $sql_login881  =  $database->mysqlQuery("select sum(tab_rate) as rate  from tbl_takeaway_billdetails  where  tab_billno='".$result_login['tab_billno']."' and  tab_slno='".$result_login88['tc_bill_slno']."'  "); 
	
                                          $num_login881   = $database->mysqlNumRows($sql_login881);
					if($num_login881){
                                           
					while($result_login881  = $database->mysqlFetchArray($sql_login881)) 
					{ 
                                            
                                              $item_rate=$item_rate+$result_login881['rate'];
                                             
                                             
                                        }} 
                                        
                                        $tot_can=$tot_can+($item_qty*$item_rate);
                                   
                                         }} 
                                         
                                         
                                    $final1_ta1=$final1_ta1+$tot_can ;          
                                        ?>
                      <td><?=number_format($tot_can,$_SESSION['be_decimal'])?></td>          
                    <?php } ?> 
                      
                   <?php if(substr($result_login['tab_cancelledsecretkey'],0,3)=='USR'){ ?>
                    <td>CLOUD</td>
                   <?php }else{ ?>
                    <td>LOCAL</td>
                   <?php } ?>     
                           
                           
                              </tr> 
                             
                              <?php
				  
				
				$i++;
	       ?>

               
     <?php 
          } } ?>
     <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
       <td >&nbsp;</td>
         <td >&nbsp;</td>
       <td></td>
  </tr>
      
  
  
  <tr>
                 <?php if($_REQUEST['department']=='TA' || $_REQUEST['department']=='HD' ||  $_REQUEST['department']=='CS'){?>
      
                    <td><b>Total</b></td>
                    <td></td>
                   <td ></td>
                    <td></td>
                    <td >&nbsp;</td>
                     <td >&nbsp;</td>
                     
                   <td><b><?=number_format(($final1_ta+$final1_ta1),$_SESSION['be_decimal'])?> /-</b></td>
                     <td >&nbsp;</td>
                  </tr>
                  
                 <?php }  ?>
                              
     
                  
                  
 
  
  
  
   <tr class="main">
       
       <td ><strong>FINAL TOTAL</strong></td>
    <td ></td>
     <td ></td>
     <td></td>
    <td ></td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
     <td ><strong><?=number_format(($final1_ta+$final1_ta1)+$final_di,$_SESSION['be_decimal'])?></strong></td>
     
     
  </tr>
   
                           </tbody>
                            </table>
                            
                            <?php                    
                            
}
else if($_REQUEST['department']=='DI'){
    
    $string="";
	$string=" bm.bm_status='Cancelled' AND ";
	$sort_string='';
        $sort_string1='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

	}
    }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                                                      
                              <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="9">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="9"><strong>BILL CANCEL CONSOLIDATED </strong></th>
      </tr>                                                                       
                                                                      
                                  
                                  <tr>
                                	<th colspan="10">Report - <?=$reporthead?></th>
                                  </tr>
                                  
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                   
                                     <th class="sortable">Bill No</th>
					<th class="sortable">Cancelled Login</th>
                                         <th class="sortable">Cancelled Date</th> 
                                       <th class="sortable">Cancelled By</th>
                                        <th class="sortable">Kot No</th>
                                      <th class="sortable">Total</th>
                                      <th class="sortable">Mode</th>
					</tr>
					</thead>
					<tbody>
									
                                          <?php
 $final=0;
 $dsc=0;
 $dscfinal=0;
 
  $sql_login  =  $database->mysqlQuery("SELECT bm.ter_cancelledsecretkey,tod.ter_kotno,bm.bm_lastprintime,bm.bm_bill_printed_by, ts.ser_firstname,bm.bm_cancelled_date_time,bm.ter_cancelledlogin,bm.bm_finaltotal,bm.bm_billtime,bm.bm_billno,bm.bm_dayclosedate from tbl_tablebillmaster  bm left join tbl_tableorder tod on tod.ter_billnumber=bm.bm_billno left join tbl_staffmaster ts on ts.ser_staffid=bm.ter_cancelledby_careof  WHERE $string $sort_string1 group by bm.bm_billno"); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          
          ?>
           <tr class="main" style="background-color: lightgray ">
               <td><strong>DINE-IN</strong>  </td>
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
      <td ></td>
  </tr>
    <?php      
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $final_di=$final_di+$result_login['bm_finaltotal'];
                      
					?>
                     <tr>
                   <td><?=$k++?></td>
                   <td><?=$result_login['bm_dayclosedate']?></td>
                   
                   <td><?=$result_login['bm_billno']?></td>
                  
                     <?php if($result_login['ter_cancelledlogin']!=''){ ?>
                   <td><?=$result_login['ter_cancelledlogin'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_bill_printed_by'].' '.$result_login['ter_cancelledsecretkey'];?></td>
                    <?php } ?>
                   
                    
                    
                    
                     <?php if($result_login['bm_cancelled_date_time']!=''){ ?>
                   <td><?=$result_login['bm_cancelled_date_time'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_lastprintime'];?></td>
                    <?php } ?>
                    
                    
                    
                      <?php if($result_login['ter_cancelledsecretkey']==''){ ?>  
                     <?php if($result_login['ser_firstname']!=''){ ?>
                   <td><?=$result_login['ser_firstname'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['bm_bill_printed_by'];?></td>
                    <?php } ?>
                    
                     <?php }else{ ?>
                    <td><?=$result_login['ter_cancelledsecretkey'];?></td>
                    <?php } ?>
                   
                     <td><?=$result_login['ter_kotno'];?></td>
                   <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                 
                    <?php if(substr($result_login['ter_cancelledsecretkey'],0,3)=='USR'){ ?>
                    <td>CLOUD</td>
                   <?php }else{ ?>
                    <td>LOCAL</td>
                   <?php } ?>   
                   
                   
                  </tr> 
                  <?php
				
		$i++;
                $ta_sl=$i++;
	       ?>

               
     
     
     
                        <?php }  } ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
      <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td></td>
        <td ></td>
         <td></td>
          <td></td>
  </tr>
  
  
  <?php if($_REQUEST['department']=='DI'){?>
  <tr class="main">
    
    <td ><strong>Total</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
       <td></td>
          <td ></td>
           <td></td>
           
    <td ><strong><?=number_format($final_di,$_SESSION['be_decimal'])?></strong></td>
     <td></td>
  </tr>
    
  <?php }
}




else if($_REQUEST['department']=='TA' || $_REQUEST['department']=='HD' || $_REQUEST['department']=='CS'){
    
    
         $stringt="";
	$stringt=" tbm.tab_status='Cancelled' and tab_mode='".$_REQUEST['department']."' ";
        $sort_string='';
        $sort_string1='';
       
	$reporthead="";
	
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					
					
				
	else 
	
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $stringt.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$stringt.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$stringt.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Last90days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	
	?>
    
    
	
									
  <?php
  
  $final1=0; 
  $dsc=0;
  $final1_ta=0;
  $sql_login  =  $database->mysqlQuery("select tbm.tab_cancelledsecretkey,tbm.tab_kotno,tbm.tab_loginid,tbm.tbl_takeaway_print_time,  ts.ser_firstname,tbm.tab_cancelledtime, tbm.tab_cancelledlogin,tbm.tab_time,tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion left join tbl_staffmaster ts on ts.ser_staffid=tbm.tab_cancelledby_careof where $stringt $sort_string1 group by tbm.tab_billno "); 
  $old='';$new='';	 
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          ?>
  
  
  <table class="table table-bordered table-font user_shadow" >
								  <thead>
                                                                      
                                                                     <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="9">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="9"><strong>BILL CANCEL CONSOLIDATED </strong></th>
      </tr>                               
                                  
                                  <tr>
                                	<th colspan="9">Report - <?=$reporthead?></th>
                                  </tr>
                                  
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                   
                                     <th class="sortable">Bill No</th>
					<th class="sortable">Cancelled Login</th>
                                       <th class="sortable">Cancelled Date</th> 
                                       <th class="sortable">Cancelled By</th>
                                        <th class="sortable">Kot No</th>
                                      <th class="sortable">Total</th>
                                       <th class="sortable">Mode</th>
					</tr>
					</thead>
					<tbody>
  
           <tr class="main" style="background-color: lightgray ">
               <td ><strong><?=$_REQUEST['department']?></strong> </td>
    <td ></td>
     <td ></td>
   
    <td ></td>
    <td  ></td>
     <td ></td>
     <td ></td>
      <td ></td>
      <td ></td>
     
     
  </tr>
    <?php      
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
			$final1_ta=$final1_ta+$result_login['tab_netamt'] ;
                   			
	 ?>

    						<tr >
                            <td><?=$k++?></td>
                             
                               <td><?=$result_login['tab_dayclosedate']?></td>
                             
				<td><?=$result_login['tab_billno'];?></td>
                               
                                <?php if($result_login['tab_cancelledlogin']!=''){ ?>
                   <td><?=$result_login['tab_cancelledlogin'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tab_loginid'];?></td>
                    <?php } ?>
                   
                    
                    
                    
                     <?php if($result_login['tab_cancelledtime']!=''){ ?>
                   <td><?=$result_login['tab_cancelledtime'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tbl_takeaway_print_time'];?></td>
                    <?php } ?>
                    
                    
                     <?php if($result_login['tab_cancelledsecretkey']==''){ ?>
                    
                     <?php if($result_login['ser_firstname']!=''){ ?>
                   <td><?=$result_login['ser_firstname'];?></td>
                   <?php }else{ ?>
                    <td><?=$result_login['tab_loginid'];?></td>
                    <?php } ?>
                    
                     <?php }else{ ?>
                    <td><?=$result_login['tab_cancelledsecretkey'];?></td>
                    <?php } ?>
                                
                             <td><?=$result_login['tab_kotno'];?></td>    
		              <?php if($result_login['tab_netamt']>0){ ?>
		               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                         <?php }else{ 
                             
                  $item_tot=0; $item_sl=''; $tot_can=0;
                 $sql_login88  =  $database->mysqlQuery("select tc_bill_slno,tc_cancel_qty from tbl_takeaway_cancel_items  where tc_billno='".$result_login['tab_billno']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                              $item_qty=$result_login88['tc_cancel_qty'];
                                              $item_sl=$result_login88['tc_bill_slno'];
                                    $item_rate=0;         
                             $sql_login881  =  $database->mysqlQuery("select sum(tab_rate) as rate  from tbl_takeaway_billdetails  where  tab_billno='".$result_login['tab_billno']."' and  tab_slno='".$result_login88['tc_bill_slno']."'  "); 
	
                                          $num_login881   = $database->mysqlNumRows($sql_login881);
					if($num_login881){
                                           
					while($result_login881  = $database->mysqlFetchArray($sql_login881)) 
					{ 
                                            
                                              $item_rate=$item_rate+$result_login881['rate'];
                                             
                                             
                                        }} 
                                        
                                        $tot_can=$tot_can+($item_qty*$item_rate);
                                        
                                         }} 
                                         
                                        $final1_ta1=$final1_ta1+$tot_can ;     
                                         
                                        ?>
                      <td><?=number_format($tot_can,$_SESSION['be_decimal'])?></td>          
                    <?php } ?>     
                           
                      
                      
                       <?php if(substr($result_login['tab_cancelledlogin'],0,3)=='USR'){ ?>
                    <td>CLOUD</td>
                   <?php }else{ ?>
                    <td>LOCAL</td>
                   <?php } ?>   
                              </tr> 
                             
                              <?php
				  
				
				$i++;
	       ?>

               
     <?php 
          } } ?>
     <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
      <td >&nbsp;</td>
         <td >&nbsp;</td>
           <td >&nbsp;</td>
       <td></td>
  </tr>
      
  
  
  <tr>
                 <?php if($_REQUEST['department']=='TA' || $_REQUEST['department']=='HD' ||  $_REQUEST['department']=='CS'){?>
      
                    <td><b>Total</b></td>
                    <td></td>
                   <td ></td>
                    <td></td>
                     <td></td>
                      <td >&nbsp;</td>
                         <td >&nbsp;</td>
                   <td><b><?=number_format(($final1_ta+$final1_ta1),$_SESSION['be_decimal'])?> /-</b></td>
                     <td >&nbsp;</td>
                  </tr>
                  
                 <?php }  
                              
    
    
    
    
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