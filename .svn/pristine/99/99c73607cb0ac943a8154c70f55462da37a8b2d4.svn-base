
<?php
include('includes/session.php');		// Check session
//session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}
if(($_REQUEST['type']=="tot_sales_an"))
{
	$string="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{
		$bydatz=$_REQUEST['paymenttyp'];
		  if($bydatz!="null")
		  {
			  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
			  if($bydatz=="Today")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
			  }else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - 1 group by bm_dayclosedate order by totamt DESC";
			  }else if($bydatz=="Last5days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }elseif($bydatz=="Last10days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  elseif($bydatz=="Last15days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last20days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last25days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last30days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last3months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last6months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last1year")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
		  }
		  else
		  {
			  $from=date("Y-m-d");
			  $to=date("Y-m-d");
			  $string.= "bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC ";
		  }
	}
	else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string= " bm_dayclosedate between '".$from."' and '".$to."'  group by bm_dayclosedate order by totamt DESC ";
	}

  $sql_login  =  $database->mysqlQuery("select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}else if(($_REQUEST['type']=="tot_sales_ta"))
{
	
//	$string="";
     $string=" tab_status='closed' AND tab_mode!= 'CS' and tab_complimentary!='Y' AND ";
	if(isset($_REQUEST['set']))
	{
            $typesale=$_REQUEST['typesale'];
	
	if($_REQUEST['typesale']!='')
	{
		$string.="tab_mode='".$typesale."' AND ";
		
	}
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
		
		
		
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string="tab_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "Ok";
	  }else
	  {
		  echo "Sorry";
	  }

}


else if(($_REQUEST['type']=="discount_ta"))
{
	
	  $string=" tab_status='closed' AND tab_mode!='CS' AND tab_discountvalue!='0.00' AND ";
          $typedisc=$_REQUEST['typedisc'];
	
	if($_REQUEST['typedisc']!='')
	{
	
		$string.="tab_mode='".$typedisc."' AND ";
	}
	if(isset($_REQUEST['set']))
	{
//            $typedisc=$_REQUEST['typedisc'];
//	
//	if($_REQUEST['typedisc']!='')
//	{
//		$string.="tab_mode='".$typedisc."' AND ";
//		
//	}

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string="tab_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo $string;
	  }else
	  {
		  echo $string;
	  }

}



else  if($_REQUEST['type']=="type_sale")
{
	$string="";
	
	if($_REQUEST['typesale']!='null')
	{
		$string.=" tab_mode='".$_REQUEST['typesale']."' AND ";
		
	}
	
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
	
		 $bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
		
		
		
	}
	else if(isset($_REQUEST['set']))
	{
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['bydate']!="null")
		{
			$bydatz=$_REQUEST['bydate'];
			
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate=CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	
		}
		else
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
			
		}
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }



}



else if(($_REQUEST['type']=="type_pay_ta"))
{
	$string="tbm.tab_status='closed' AND tbm.tab_mode!='CS' AND ";
	$fields="";
        $typepaysale=$_REQUEST['typepaysale'];
	
	if($_REQUEST['typepaysale']!='')
	{
	
		$string.="tbm.tab_mode='".$typepaysale."' AND ";
	}
	if(isset($_REQUEST['set']))
{
        
	if($_REQUEST['typepay']=="cash")
	{
            $string.= "";
		$fields="";
		/*$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";*/
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='closed' ";
//		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
	/*	$string = " tab_transactionamount <>'' ";*/
	       $string.= "p.pym_code='credit' ";
//		$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
		$fields="<th class='sortable'>Transaction Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
                     $string = "pym_code='coupon'";
		/*$string = " tab_couponcompany <>''  and tab_couponcompany <>'0.00'";*/
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		/*$string = " tab_voucherid <>''";*/
	$string = " pym_code='voucher'";
//			$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
                  $string = " pym_code='cheque'";
	/*	$string = " tab_chequebankname <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
 
        
	//fromdt todt
        
     
       	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.="tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.="tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.="tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
			$fields="<th class='sortable'>Cheque No</th>";
		    $fields.="<th class='sortable'>Bank Name</th>";
			
		}
}

else if(isset($_REQUEST['pay']))
{
	if($_REQUEST['typepay']=="cash")
	{
            $string.= "";
		
		/*$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";*/
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
	/*	$string = " tab_transactionamount <>'' ";*/
	$string.= " p.pym_code='credit' ";
//	$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
            $string = " pym_code='coupon'";
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		/*$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";*/
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
            $string = " pym_code='voucher'";
		/*$string = " tab_voucherid <>''";*/
//		$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
            $string = " pym_code='cheque'";
		/*$string = " tab_chequeno <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
	
	//fromdt todt


	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($paybydate=="Yesterday")
			  {
				  $string.="tbm.tab_dayclosedate =CURDATE() - 1 ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last90days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
 
 
	}
}
else if(isset($_REQUEST['abc']))
{
	
		if($_REQUEST['typepay']=="cash")
	{
                    $string.= "";
		$fields="";
	/*	$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";*/
		
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='Delivered' ";
//		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
		$string= "p.pym_code='credit' ";
//		$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
	/*	$string = " tab_transactionamount <>'' ";*/
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
            $string = " pym_code='coupon'";
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
	/*	$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";*/
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
            $string = " pym_code='voucher'";
		/*$string = " tab_voucherid <>''";*/
//		$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
            $string = " pym_code='cheque'";
	/*	$string = " tab_chequeno <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
	
	//fromdt todt


	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.="tbm.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($paybydate=="Last90days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	}
}
else
		{
			
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "(tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}
		
		
	/*echo "select * from tbl_takeaway_billmaster where $string";	
	die();*/
		
 	/*  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); */
 //echo "select * from tbl_tablebillmaster where $string";

$sql_login =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_transactionamount,tbm.tab_dayclosedate,tbm.tab_amountpaid,b.bm_name,
tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id left join tbl_bankmaster b on b.bm_id=tbm.tab_transcbank where $string order by tbm.tab_billno asc");
//		 $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster LEFT JOIN tbl_bankmaster ON tbl_takeaway_billmaster.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode ON tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id   where $string");
//                $sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tbm.tab_dayclosedate,tbm.tab_amountpaid,tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id where $string");
//	$sql = "select tbm.tab_billno,tbm.tbm.tab_dayclosedate,tbm.tab_amountpaid,tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id where $string";
	   $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  	{
//              echo $sql;
		  echo $string;
		  }else /**/
		  {
//			echo $sql;
			  echo $string;
		  } 
   
}else if(($_REQUEST['type']=="item"))
{
	$floor=$_REQUEST['floorvals'];
	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$j++;
				
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub)
				{ 
				echo "ok";
				}else
				{
					echo "sorry";
				} 
					
				}
			}
		}else
		{
			echo "sorry";
		}
	
}else if(($_REQUEST['type']=="steward"))
{
		$stw=$_REQUEST['stwrd'];
	$string="";
	if(isset($_REQUEST['abc']))
	{
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");
$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }


	}
	
	
	else if(isset($_REQUEST['set']))
{
	$stw=$_REQUEST['stwrd'];
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if(isset($_REQUEST['stwr']))
{
	
	
	$stw=$_REQUEST['stwrd'];
	$string="";
	
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");

$num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}



else 
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		} 
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	 // echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	  
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	}
	
}

else if($_REQUEST['type']=="delivery_amt")
{
	
		$stw=$_REQUEST['stwrd'];
	$string="";
	if(isset($_REQUEST['abc']))
	{
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	
$sql_stw  =  $database->mysqlQuery("
Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_dayclosedate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");
//Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC
$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }


	}
	
	
	else if(isset($_REQUEST['set']))
{
	$stw=$_REQUEST['stwrd'];
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_dayclosedate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");

	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if(isset($_REQUEST['stwr']))
{
	
	
	$stw=$_REQUEST['stwrd'];
	$string="";
	
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_dayclosedate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");


$num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}



else 
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		} 
 	  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_dayclosedate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");
 
	 // echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	  
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	}
	

	
	
	
	
}





else if(($_REQUEST['type']=="order"))
{
	$string="";
	if(isset($_REQUEST['fromdt']) && isset($_REQUEST['todt']))
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		} 
	}
	
		else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['orderbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="  tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
		
		
		
	}
	
	
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
	}
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails. tab_billno Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid  Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw)
	  {
		  echo "ok";
		  }else
		  {
			  echo "sorry";
		  }
	 
}else if(($_REQUEST['type']=="portion_order"))

{
	
	$string="";
	//$prtn=$_REQUEST['portn'];
	if(isset($_REQUEST['set']))
	{
		$prtn=$_REQUEST['portn'];
	if($prtn !="null")
	{
		/*if($string!="")
		{
			$string.=" and  tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'";
		}
		
	}*/
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			/*if($string!="")*/
			/*{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
				
			/*}*/
			
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			/*if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
			/*}*/
			
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			/*if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
			/*}*/
			
		
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			/*if($string!="")
			{
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{*/
				$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'   ) ";
		/*	}*/
			
		} 
		
		
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC");
		
		//echo "Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC";
		 $num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	}
	
	else
	{
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
		/*	if($string!="")*/
			/*{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'   ) ";
				
			/*}*/
			
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			/*if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'  ) ";
			/*}*/
			
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			/*if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{*/
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'   ) ";
			/*}*/
			
		
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			/*if($string!="")
			{
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{*/
				$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."'   ) ";
		/*	}*/
			
		} 
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC");
		
		//echo "Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC";
		 $num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
		
	}
	
	}
	
	else if(isset($_REQUEST['port']))
	{
		
		$prtn=$_REQUEST['portn'];
		$portionbydate=$_REQUEST['portionbydate'];
	/*if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}*/

	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
			
		//$search="";
	if($portionbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
else if($portionbydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate  =CURDATE() - 1 ";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string and tbl_takeaway_billdetails.tab_portion='".$prtn."' Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
		}
		
		else
		{
			
				if($portionbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	

else if($paybydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate   =CURDATE() - 1 ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
			
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		}
	}
	  else
	  {
		  
		  	$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);
//echo $num_stw;
//die();
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
			
	  }

	
	}
	else if(isset($_REQUEST['abc']))
	{
		$prtn=$_REQUEST['portn'];
			$portionbydate=$_REQUEST['portionbydate'];
	/*		if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}
		*/
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	

else if($portionbydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate  =CURDATE() - 1 ";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR
		 AND CURDATE( )"; 
	}
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where tbl_takeaway_billdetails.tab_portion='".$prtn."'  and $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
		    $num_stw   = $database->mysqlNumRows($sql_stw);


	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		

	}
	else
	{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
		if($portionbydate=="Last5days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
	
	

else if($portionbydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}	
			
		else
		{
			$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	
		    $num_stw   = $database->mysqlNumRows($sql_stw);

//echo $num_stw;
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }	
	}
	
	
	
	}
	
	
	
	else
	{
			$string.="  tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
			   $num_stw   = $database->mysqlNumRows($sql_stw);
//echo $num_stw;

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		
	}
	
	
	
	
	 
//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where $string   Group By tbl_menumaster.mr_menuname order by ct DESC";
	
		
		
		
	
	}
	
	
	
	
		else
		{
			
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		
			 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
				    $num_stw   = $database->mysqlNumRows($sql_stw);


	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		
		}

	 /* $num_stw   = $database->mysqlNumRows($sql_stw);
echo $num_stw;
die();*/
	 /* if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/
		
		
		
		
		
	}	


	 
	





else if(($_REQUEST['type']=="type_order"))
{
	$string="";
	$ordtype=$_REQUEST['ordtype'];
	
	
		if(isset($_REQUEST['set']))
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
		
		
	}
	
else if(isset($_REQUEST['abc']))
	{
		
		$ordtype=$_REQUEST['ordtype'];
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
else if($ordertypebydate=="Yesterday")
			  {
				  $string.="tbl_tableorder.ter_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
		
		
		
		
		
		
		
		
		/*
		if($_REQUEST['abc']==1)
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			
		}
		else
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}
		*/
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC";
	
	}
	
	else if(isset($_REQUEST['typeord']	))

	{
		
	$ordtype=$_REQUEST['ordtype'];
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
else if($ordertypebydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate  = CURDATE() - 1";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($ordertypebydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 year AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	  //$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
	
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_type =  '".$ordtype."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");
//
//$num_stw   = $database->mysqlNumRows($sql_stw);
//
//
//	  if($num_stw){
//		  echo "ok";
//	  }else
//	  {
//		  echo "sorry";
//	  }
}
	
	
	
	
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
	}
	
 	
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  if($num_stw){echo "ok";}else{echo "sorry";}
	 
}



//else if($_REQUEST['value']=="checkmenu")
//	 {
//		$test= $_REQUEST['mid'];
//	
//	 $sql_login  =  $database->mysqlQuery("select (mr_menuname) from tbl_menumaster where mr_menuname='$test'"); 
//	
//	  
//      $num_login   = $database->mysqlNumRows($sql_login);
//
//	 
//	  if($num_login =='1')
//	  {
//		 echo 'sorry';
//	  }
//	  else
//	  {
//		echo 'ok';
//	  }
//	 }


?>