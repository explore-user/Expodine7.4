<?php
    ob_start();
//	session_start();
//include('includes/session.php');
	if($_REQUEST['type']=="tot_sales_ta")
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
	}else if($_REQUEST['type']=="type_pay")
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
		$_SESSION['types']=$_REQUEST['types'];
	}else if($_REQUEST['type']=="item")
	{
		$_SESSION['floorv']=$_REQUEST['floorv'];
	}else if($_REQUEST['type']=="steward")
	{	
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
		$_SESSION['stwr']=$_REQUEST['stwr'];
	}else if($_REQUEST['type']=="order")
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
	}else if($_REQUEST['type']=="portion_order")
	{	
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
		$_SESSION['prtn']=$_REQUEST['prtn'];
	}
	
	else if($_REQUEST['type']=="delivery_amt")
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
		$_SESSION['todt']=$_REQUEST['to'];
		$_SESSION['stwr']=$_REQUEST['stwr'];
	}
	
	
	
	
	
    include(dirname(__FILE__)."/tapdf_bill_page.php");
    $content = ob_get_clean();

    // convert in PDF
    require_once(dirname(__FILE__).'/htmltppdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		
		$cur=date("Y-m-d");
		if($_REQUEST['type']=="portion_order")
		{
		$names="PortionOrderReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="tot_sales_ta")
		{
			$names="TotalSalesReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="type_pay")
		{
			$names="PaymentReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="item")
		{
			$names="MenuReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="steward")
		{
			$names="StewardReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="order")
		{
			$names="ItemOrderReport".$cur.".pdf";
		}
		elseif($_REQUEST['type']=="delivery_amt")
		{
			$names="CollectionReport".$cur.".pdf";
		}
        $html2pdf->Output($names,'FD');
		
		unlink($names);
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
	
	
	
	
	
	
