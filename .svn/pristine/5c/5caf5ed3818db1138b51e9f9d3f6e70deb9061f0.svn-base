<?php
session_start();
include "libchart/classes/libchart.php";


$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
//$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);


	function converdate($date)
	{
		$newdate	= explode("-",$date);
		$date		= $newdate[0];
		$month		= $newdate[1];
		$year		= $newdate[2];
		
		$c_date		= $year."-".$month."-".$date;
		return  $c_date;
	}
	function converdate_small($date)
	{
		$newdate	= explode("-",$date);
		$year		= substr($newdate[0], 2); 
		$month		= $newdate[1];
		$day		= $newdate[2];
		
		$c_date		= $day."-".$month."-".$year;
		return  $c_date;
	}
			$string="";
			$from="";
			$to="";
			$statusname="";
			
				$cur=$_SESSION['date'];
				$from=$cur;
				$to=$cur;
				
				$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
			
			
			header("Content-type: image/png");
				$chart = new PieChart(500, 300);
				$dataSet = new XYDataSet();
				$data=array();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("'".($result_login['mr_itemshortcode'])."'",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".$from. " to " .$to);
				 $chart->render();
				 }