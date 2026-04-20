<?php
//session_start();
include('includes/session.php');
include "libchart/classes/libchart.php";
error_reporting(0);

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
	if($_REQUEST['type']=="tot_sales")
	{ /*  ################################################# Total Sales######################################################### */
			$string="";
			$from="";
			$to="";
			$statusname="";
			$string=" bm_status='Closed' AND ";
			if(isset($_REQUEST['set']))
			{
				if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
				{
					$from=converdate($_REQUEST['fromdt']);
					$to=converdate($_REQUEST['todt']);
					$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				}
				else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
				{
					$from=converdate($_REQUEST['fromdt']);
					$to=date("Y-m-d");
					$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				}
				else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
				{
					$from=date("Y-m-d");
					$to=converdate($_REQUEST['todt']);
					$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				}
			}else if(isset($_REQUEST['newsearch']))
			{
				$bydatz=$_REQUEST['paymenttyp'];
				  if($bydatz!="null")
				  {
					  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
					  if($bydatz=="Today")
					  {
						  $statusname="Today";
						  $string.="bm_dayclosedate = (CURDATE( )) "; 
					  }else if($bydatz=="Yesterday")
					  {
						  $statusname="Yesterday";
						  $string.="bm_dayclosedate = (CURDATE( ) - 1  ) ";
					  }else if($bydatz=="Last5days")
					  {
						  $statusname="Last 5 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
					  }elseif($bydatz=="Last10days")
					  {
						  $statusname="Last 10 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
					  }
					  elseif($bydatz=="Last15days")
					  {
						  $statusname="Today";
						  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last20days")
					  {
						  $statusname="Last 20 days";
						  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last25days")
					  {
						  $statusname="Last 25 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last30days")
					  {
						  $statusname="Last 30 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last1month")
					  {
						  $statusname="Last month";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last3months")
					  {
						  $statusname="Last 3 months";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last6months")
					  {
						  $statusname="Last 6 months";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last1year")
					  {
						  $statusname="Last year";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
					  }
				  }
				  else
				  {
					  $statusname="Today";
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= "bm_dayclosedate between '".$from."' and '".$to."'  ";
				  }
			}
			else
			{
				$cur=date("Y-m-d");
				$from=$cur;
				$to=$cur;
				$string.= " bm_dayclosedate between '".$from."' and '".$to."'   ";
			}
			$strings=$string;
			$gp=" group by bm_dayclosedate order by totamt DESC LIMIT 0,10";
			$string="";
			$string=$strings.$gp;
			if($_REQUEST['model']=="pie")
			{
				header("Content-type: image/png");
				$chart = new PieChart(600, 300);
				$dataSet = new XYDataSet();
				$data=array();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render();
				 }
			}elseif($_REQUEST['model']=="horz")
			{
				$chart = new HorizontalBarChart(600, 300);
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/horizontalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/horizontalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="vert")
			{
				$chart = new VerticalBarChart();
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/verticalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/verticalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="line")
			{//echo "select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string ";
				$chart = new LineChart();
				//$dataSet = new XYDataSet();
				$serie=array();
				$dataSet = new XYSeriesDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $strings group by bm_dayclosedate order by bm_dayclosedate DESC"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {$i=0;$serie = new XYDataSet();
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
							
							$serie->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*20));
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*30));
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*40));
							
						} 
						if(isset($_REQUEST['newsearch']))
					 $dataSet->addSerie($statusname, $serie);
				 else
					$dataSet->addSerie(converdate_small($from). " to " .converdate_small($to), $serie);
					
						
							unset($serie);
				 $chart->setDataSet($dataSet);
				 $chart->getPlot()->setGraphCaptionRatio(0.62);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/linechart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/linechart.png" />
				 <?php
			}
	}else if($_REQUEST['type']=="totitems")
	{/*  ################################################# Total Items######################################################### */
			$string="";
			$from="";
			$to="";
			$statusname="";
			if(isset($_REQUEST['set']))
			{
				if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
				  {
					  $from=converdate($_REQUEST['fromdt']);
					  $to=converdate($_REQUEST['todt']);
					  $string= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
				  {
					  $from=converdate($_REQUEST['fromdt']);
					  $to=date("Y-m-d");
					  $string= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
				  {
					  $from=date("Y-m-d");
					  $to=converdate($_REQUEST['todt']);
					  $string= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
				  {
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
				  }
				  //echo "SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string ";
			}else if(isset($_REQUEST['newsearch']))
			{
				$bydatz=$_REQUEST['paymenttyp'];
				  if($bydatz!="null")
				  {
					  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
					  if($bydatz=="Today")
					  {
						  $statusname="Today";
						  $string.="bm.bm_dayclosedate = (CURDATE( )) "; 
					  }else if($bydatz=="Yesterday")
					  {
						  $statusname="Yesterday";
						  $string.="bm.bm_dayclosedate = (CURDATE( ) - 1  ) ";
					  }else if($bydatz=="Last5days")
					  {
						  $statusname="Last 5 days";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
					  }elseif($bydatz=="Last10days")
					  {
						  $statusname="Last 10 days";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
					  }
					  elseif($bydatz=="Last15days")
					  {
						  $statusname="Today";
						  $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last20days")
					  {
						  $statusname="Last 20 days";
						  $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last25days")
					  {
						  $statusname="Last 25 days";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last30days")
					  {
						  $statusname="Last 30 days";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last1month")
					  {
						  $statusname="Last month";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last3months")
					  {
						  $statusname="Last 3 months";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last6months")
					  {
						  $statusname="Last 6 months";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last1year")
					  {
						  $statusname="Last year";
						  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
					  }
				  }
				  else
				  {
					  $statusname="Today";
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= "bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
				  }
			}
			else
			{
				$cur=date("Y-m-d");
				$from=$cur;
				$to=$cur;
				$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			}
			
			if($_REQUEST['model']=="pie")
			{
				header("Content-type: image/png");
				$chart = new PieChart(800, 500);
				$dataSet = new XYDataSet();
				$data=array();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string Group By mm.mr_itemshortcode order by bm.bm_dayclosedate DESC LIMIT 0,10"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['mr_itemshortcode'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render();
				 }
			}elseif($_REQUEST['model']=="horz")
			{
				$chart = new HorizontalBarChart(800, 500);
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string Group By mm.mr_itemshortcode order by bm.bm_dayclosedate DESC  LIMIT 0,10"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['mr_itemshortcode'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/horizontalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/horizontalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="vert")
			{
				$chart = new VerticalBarChart();
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string Group By mm.mr_itemshortcode order by bm.bm_dayclosedate DESC LIMIT 0,10"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['mr_itemshortcode'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/verticalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/verticalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="line")
			{
				$chart = new LineChart();
				//$dataSet = new XYDataSet();
				$serie=array();
				$dataSet = new XYSeriesDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string Group By mm.mr_itemshortcode order by bm.bm_dayclosedate DESC LIMIT 0,10"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{$i=0;
							$serie = new XYDataSet();
							$serie->addPoint(new Point("".($result_login['mr_itemshortcode'])."",$result_login['ct']));
							
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*20));
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*30));
							//$serie->addPoint(new Point("'".$result_login['bdate']."'",$result_login['totamt']*40));
							$dataSet->addSerie($i++, $serie);
							unset($serie);
						} 
				 $chart->setDataSet($dataSet);
				 $chart->getPlot()->setGraphCaptionRatio(0.62);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/linechart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/linechart.png" />
				 <?php
			}
	}else if($_REQUEST['type']=="itemeach")
	{/*  ################################################# Total Items each######################################################### */
			$string="";
			$from="";
			$to="";
			$statusname="";
			$itemid=$_REQUEST['itemid'];
		    $string1=" mm.mr_menuid='".$itemid."'  AND ";
			if(isset($_REQUEST['set']))
			{
				if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
				  {
					  $from=converdate($_REQUEST['fromdt']);
					  $to=converdate($_REQUEST['todt']);
					  $string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
				  {
					  $from=converdate($_REQUEST['fromdt']);
					  $to=date("Y-m-d");
					  $string.= "   bm.bm_dayclosedate  between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
				  {
					  $from=date("Y-m-d");
					  $to=converdate($_REQUEST['todt']);
					  $string.= "   bm.bm_dayclosedate  between '".$from."' and '".$to."' ";
				  }
				  else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
				  {
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= "   bm.bm_dayclosedate  between '".$from."' and '".$to."' ";
				  }
				  //echo "SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string ";
			}else if(isset($_REQUEST['newsearch']))
			{
				$bydatz=$_REQUEST['paymenttyp'];
				  if($bydatz!="null")
				  {
					  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
					  if($bydatz=="Today")
					  {
						  $statusname="Today";
						  $string.=" bm.bm_dayclosedate    = (CURDATE( )) "; 
					  }else if($bydatz=="Yesterday")
					  {
						  $statusname="Yesterday";
						  $string.=" bm.bm_dayclosedate    = (CURDATE( ) - 1  ) ";
					  }else if($bydatz=="Last5days")
					  {
						  $statusname="Last 5 days";
						  $string.="  bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
					  }elseif($bydatz=="Last10days")
					  {
						  $statusname="Last 10 days";
						  $string.="  bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
					  }
					  elseif($bydatz=="Last15days")
					  {
						  $statusname="Today";
						  $string.="   bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last20days")
					  {
						  $statusname="Last 20 days";
						  $string.="   bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last25days")
					  {
						  $statusname="Last 25 days";
						  $string.="   bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last30days")
					  {
						  $statusname="Last 30 days";
						  $string.="  bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last1month")
					  {
						  $statusname="Last month";
						  $string.="  bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  }
					  else if($bydatz=="Last3months")
					  {
						  $statusname="Last 3 months";
						  $string.="   bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last6months")
					  {
						  $statusname="Last 6 months";
						  $string.="  bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last1year")
					  {
						  $statusname="Last year";
						  $string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
					  }
				  }
				  else
				  {
					  $statusname="Today";
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= " bm.bm_dayclosedate   between '".$from."' and '".$to."'  ";
				  }
			}
			else
			{
				$cur=date("Y-m-d");
				$from=$cur;
				$to=$cur;
				$string= "   bm.bm_dayclosedate   between '".$from."' and '".$to."' ";
			}
			//$strings=$string;
			//$string=$string1.$strings." Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC";//ct,
			//$string1=$string1.$strings;
			if($_REQUEST['model']=="pie")
			{
				header("Content-type: image/png");
				$chart = new PieChart(800, 500);
				$dataSet = new XYDataSet();
				$data=array();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE mm.mr_menuid='".$itemid."'  AND   $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC"); 
				//echo "SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE mm.mr_menuid='".$itemid."'  AND   $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC";die();
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['bm_dayclosedate'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render();
				 }
			}elseif($_REQUEST['model']=="horz")
			{
				$chart = new HorizontalBarChart(800, 500);
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND  $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['bm_dayclosedate'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/horizontalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/horizontalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="vert")
			{
				$chart = new VerticalBarChart();
				$dataSet = new XYDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND  $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("".($result_login['bm_dayclosedate'])."",$result_login['ct']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Item Report ".$statusname);
				 else
					$chart->setTitle("Item Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/verticalchart.png");
				 }?>
				 <img alt="Vertical bars chart" src="libchart/verticalchart.png" />
				 <?php
			}elseif($_REQUEST['model']=="line")
			{
				$chart = new LineChart(900, 600);
				//$dataSet = new XYDataSet();
				
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate as bdate  FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND   $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC "); 
				$num_login   = mysqli_num_rows($sql_login);
				
				$sql_login1  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.tab_dayclosedate  as bdate FROM tbl_takeaway_billdetails as bd LEFT JOIN tbl_takeaway_billmaster as bm ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.tab_menuid WHERE  mm.mr_menuid='".$itemid."'  AND   $string Group By mm.mr_itemshortcode,bm.tab_dayclosedate  order by bm.tab_dayclosedate DESC "); 
				 $num_login1   = mysqli_num_rows($sql_login1);
				
				$st="";
				if($num_login>$num_login1)
				{
					$st=" LIMIT 0,".$num_login1;
				}else
				{
					$st=" LIMIT 0,".$num_login;
				}
				
				
				$dataSet = new XYSeriesDataSet();
				$serie = new XYDataSet();
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate as bdate  FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND  $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC $st"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {$i=0;
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
 							$serie->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['ct']));
						} 
				
					 $dataSet->addSerie("Dine In", $serie);
				  }
				  
					$serie2 = new XYDataSet();
				//echo "select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $strings_2 group by tab_dayclosedate order by tab_dayclosedate DESC limit 0,4";
				$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.tab_dayclosedate  as bdate FROM tbl_takeaway_billdetails as bd LEFT JOIN tbl_takeaway_billmaster as bm ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.tab_menuid WHERE  mm.mr_menuid='".$itemid."'  AND  $string Group By mm.mr_itemshortcode,bm.tab_dayclosedate  order by bm.tab_dayclosedate DESC $st"); 
				
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {$i=0;
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
 							$serie2->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['ct']));
						} 
				
					 $dataSet->addSerie("Take Away", $serie2);
				  }
						
							
				 $chart->setDataSet($dataSet);
				 $chart->getPlot()->setGraphCaptionRatio(0.62);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/linechart.png");
				?>
				 <img alt="Vertical bars chart" src="libchart/linechart.png" />
				 <?php
			}
	}else if($_REQUEST['type']=="compare")
	{/*  ################################################# comparing dine in/take away######################################################### */
			$string="";
			$string_2="";
			$from="";
			$to="";
			$statusname="";
			if(isset($_REQUEST['set']))
			{
				if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
				{
					$from=converdate($_REQUEST['fromdt']);
					$to=converdate($_REQUEST['todt']);
					$string= " bm_dayclosedate between '".$from."' and '".$to."' ";
					$string_2= " tab_dayclosedate between '".$from."' and '".$to."' ";
				}
				else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
				{
					$from=converdate($_REQUEST['fromdt']);
					$to=date("Y-m-d");
					$string= " bm_dayclosedate between '".$from."' and '".$to."' ";
					$string_2= " tab_dayclosedate between '".$from."' and '".$to."' ";
				}
				else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
				{
					$from=date("Y-m-d");
					$to=converdate($_REQUEST['todt']);
					$string= " bm_dayclosedate between '".$from."' and '".$to."' ";
					$string_2= " tab_dayclosedate between '".$from."' and '".$to."' ";
				}
			}else if(isset($_REQUEST['newsearch']))
			{
				$bydatz=$_REQUEST['paymenttyp'];
				  if($bydatz!="null")
				  {
					  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
					  if($bydatz=="Today")
					  {
						  $statusname="Today";
						  $string.="bm_dayclosedate = (CURDATE( )) "; 
						  $string_2.="tab_dayclosedate = (CURDATE( )) "; 
					  }else if($bydatz=="Yesterday")
					  {
						  $statusname="Yesterday";
						  $string.="bm_dayclosedate = (CURDATE( ) - 1  ) ";
						  $string_2.="tab_dayclosedate = (CURDATE( ) - 1  )  "; 
					  }else if($bydatz=="Last5days")
					  {
						  $statusname="Last 5 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )"; 
					  }elseif($bydatz=="Last10days")
					  {
						  $statusname="Last 10 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )"; 
					  }
					  elseif($bydatz=="Last15days")
					  {
						  $statusname="Today";
						  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )"; 
					  }
					  else if($bydatz=="Last20days")
					  {
						  $statusname="Last 20 days";
						  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
					  }
					  else if($bydatz=="Last25days")
					  {
						  $statusname="Last 25 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )  "; 
					  }
					  else if($bydatz=="Last30days")
					  {
						  $statusname="Last 30 days";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) "; 
					  }
					  else if($bydatz=="Last1month")
					  {
						  $statusname="Last month";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )"; 
					  }
					  else if($bydatz=="Last3months")
					  {
						  $statusname="Last 3 months";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )  ";  
					  }
					  else if($bydatz=="Last6months")
					  {
						  $statusname="Last 6 months";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";  
					  }
					  else if($bydatz=="Last1year")
					  {
						  $statusname="Last year";
						  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
						  $string_2.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )  "; 
					  }
				  }
				  else
				  {
					  $statusname="Today";
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= "bm_dayclosedate between '".$from."' and '".$to."'  ";
					  $string_2.="tab_dayclosedate between '".$from."' and '".$to."'   "; 
				  }
			}
			else
			{
				$cur=date("Y-m-d");
				$from=$cur;
				$to=$cur;
				$string= " bm_dayclosedate between '".$from."' and '".$to."'   ";
				$string_2.="tab_dayclosedate between '".$from."' and '".$to."'   ";
			}
			$strings=$string;
			$strings_2=$string_2;
			//$s=$string_2;
			$gp=" group by bm_dayclosedate order by totamt DESC";
			$gp2=" group by tab_dayclosedate order by tab_dayclosedate DESC";
			$string="";
			$string_2="";
			$string=$strings.$gp;
			$string_2=$strings_2.$gp2;
			
			$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
			$num_login   = mysqli_num_rows($sql_login);
			
			$sql_login1  =  mysqli_query($con,"select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $string_2 "); 
			$num_login1   = mysqli_num_rows($sql_login1);
			
			$st="";
			if($num_login>$num_login1)
			{
				$st=" LIMIT 0,".$num_login1;
			}else
			{
				$st=" LIMIT 0,".$num_login;
			}
			
			
			$gp=" group by bm_dayclosedate order by totamt DESC " .$st;
			$gp2=" group by tab_dayclosedate order by tab_dayclosedate DESC " .$st;
			$string=$strings.$gp;
			$string_2=$strings_2.$gp2;
			
			if($_REQUEST['model']=="pie")
			{
				//header("Content-type: image/png");
				//$chart = new PieChart(600, 300);
				$chart = new HorizontalBarChart(600, 600);
				$serie1 = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				$num_login   = mysqli_num_rows($sql_login);
				if($num_login)
				{
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $serie1->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 
				 }
				 $serie2 = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $string_2 "); 
				$num_login   = mysqli_num_rows($sql_login);
				if($num_login)
				{
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $serie2->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 
				 }
				 
				 $dataSet = new XYSeriesDataSet();
				$dataSet->addSerie("Dine In", $serie1);
				$dataSet->addSerie("Take Away", $serie2);
				$chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render("libchart/horcompareach.png");
				 ?>
				 <img alt="Vertical bars chart" src="libchart/horcompareach.png" />
				 <?php
				 
				 
			}elseif($_REQUEST['model']=="horz")
			{
				//header("Content-type: image/png");
				//$chart = new PieChart(600, 300);
				$chart = new VerticalBarChart(900, 600);
				$serie1 = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				$num_login   = mysqli_num_rows($sql_login);
				if($num_login)
				{
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $serie1->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 
				 }
				 $serie2 = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $string_2 "); 
				$num_login   = mysqli_num_rows($sql_login);
				if($num_login)
				{
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $serie2->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				 
				 }
				 
				 $dataSet = new XYSeriesDataSet();
				$dataSet->addSerie("Dine In", $serie1);
				$dataSet->addSerie("Take Away",$serie2);
				$chart->setDataSet($dataSet);
				$chart->getPlot()->setGraphCaptionRatio(0.65);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render("libchart/vercompareach.png");
				 ?>
				 <img alt="Vertical bars chart" src="libchart/vercompareach.png" />
				 <?php
				 
				 
			}elseif($_REQUEST['model']=="vert")
			{
				$chart = new LineChart(900, 600);
				//$dataSet = new XYDataSet();
				
				$dataSet = new XYSeriesDataSet();
				$serie = new XYDataSet();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {$i=0;
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
 							$serie->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				
					 $dataSet->addSerie("Dine In", $serie);
				  }
				  
					$serie2 = new XYDataSet();
				//echo "select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $strings_2 group by tab_dayclosedate order by tab_dayclosedate DESC limit 0,4";
				$sql_login  =  mysqli_query($con,"select  tab_dayclosedate as bdate,sum(tab_netamt) as totamt from tbl_takeaway_billmaster where $string_2"); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {$i=0;
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
 							$serie2->addPoint(new Point("".converdate_small($result_login['bdate'])."",$result_login['totamt']));
						} 
				
					 $dataSet->addSerie("Take Away", $serie2);
				  }
						
							
				 $chart->setDataSet($dataSet);
				 $chart->getPlot()->setGraphCaptionRatio(0.62);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/linechart.png");
				?>
				 <img alt="Vertical bars chart" src="libchart/linechart.png" />
				 <?php
			}
	}else if($_REQUEST['type']=="staffwise")
	{/*  ################################################# Staff wise ######################################################### */
			$string="";
			$string_2="";
			$from="";
			$to="";
			$statusname="";
			if(isset($_REQUEST['set']))
		{
			if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
			{
				$from=converdate($_REQUEST['fromdt']);
				$to=converdate($_REQUEST['todt']);
				$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
			{
				$from=converdate($_REQUEST['fromdt']);
				$to=date("Y-m-d");
				$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
			{
				$from=date("Y-m-d");
				$to=converdate($_REQUEST['todt']);
				$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
			{
				$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
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
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
					  $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
				  }else if($bydatz=="Yesterday")
				  {
					  $string.=" tm.bm_dayclosedate = CURDATE() - 1 ";
					   $string_2= " tm.tab_dayclosedate = CURDATE() - 1  ";
				  }else if($bydatz=="Last5days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last1month")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
				  }
				  else if($bydatz=="Last3months")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) "; 
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last6months")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )  "; 
				  }
				  else if($bydatz=="Last1year")
				  {
					  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
					   $string_2= " tm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				  }
			  }
			  else
			  {
				  $from=date("Y-m-d");
				  $to=date("Y-m-d");
				  $string.= " tm.bm_dayclosedate between '".$from."' and '".$to."'  ";
				   $string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
			  }
		}
		else
		{
			$cur=date("Y-m-d");
			$from=$cur;
			$to=$cur;
			$string= " tm.bm_dayclosedate between '".$from."' and '".$to."'   ";
			 $string_2= " tm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
			$finalstring="";
			$sql_login="";
			$v="";
			$stf="";$stfjoin="";
		  if($_REQUEST['modetype']=="dinein")
		  {
			  $stf="";$stfjoin="";
			  if(isset($_REQUEST['staffval']))
			  {
				  if($_REQUEST['staffval']!="")
					{
				  $stfjoin=" LEFT JOIN tbl_tableorder as tor ON tor.ter_billnumber=tm.bm_billno";
				  $stf=" tor.ter_staff=  '".$_REQUEST['staffval']."' AND ";
					}
			  }
			  $last=" GROUP BY tm.bm_dayclosedate ";
			  $finalstring=$stf.$string.$last;
			  $v="Select SUM(tm.bm_finaltotal) as amt,tm.bm_dayclosedate as dt From tbl_tablebillmaster as tm $stfjoin Where $finalstring ";
			  $sql_login  =  mysqli_query($con,"Select SUM(tm.bm_finaltotal) as amt,tm.bm_dayclosedate as dt From tbl_tablebillmaster as tm $stfjoin Where $finalstring ");
			  
		  }else
		  {
			  $stf="";$stfjoin="";
			  if(isset($_REQUEST['staffval']))
			  {
				  if($_REQUEST['staffval']!="")
					{
				  $stfjoin=" Inner Join tbl_staffmaster On tm.tab_assignedto = tbl_staffmaster.ser_staffid ";
				  $stf=" tm.tab_assignedto =  '".$_REQUEST['staffval']."' AND ";
					}
			  }
			  $last_2="  Group By tm.tab_dayclosedate";
			  $finalstring=$stf.$string_2.$last_2;
			  $v="Select sum(tm.tab_netamt) as amt,tm.tab_dayclosedate as dt From tbl_takeaway_billmaster as tm $stfjoin Where  $finalstring   ";
			  $sql_login  =  mysqli_query($con,"Select sum(tm.tab_netamt) as amt,tm.tab_dayclosedate as dt From tbl_takeaway_billmaster as tm $stfjoin Where  $finalstring "); 
			  
		  }
			//echo $v;
			if($_REQUEST['model']=="pie")
			{//echo "Select SUM(tm.bm_finaltotal) as amt,tm.bm_dayclosedate as dt From tbl_tablebillmaster as tm $stfjoin Where $finalstring ";
				//header("Content-type: image/png");
				$chart = new PieChart(800, 500);
				$dataSet = new XYDataSet();
				//$data=array();
				
				//$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE mm.mr_menuid='".$itemid."'  AND  bm.bm_dayclosedate $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC"); 
				 //$sql_login  =  mysqli_query($con,"Select SUM(tm.bm_finaltotal) as amt,tm.bm_dayclosedate as dt From tbl_tablebillmaster as tm $stfjoin Where $finalstring "); 
				  $num_login1   = mysqli_num_rows($sql_login);
				  if($num_login1)
				  {
					  while($result_login1  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("'".($result_login1['dt'])."'",$result_login1['amt']));
						 //$dataSet->addPoint(new Point('2015-08-22',175.50));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Staff Report ".$statusname);
				 else
					$chart->setTitle("Staff Report ".converdate_small($from). " to " .converdate_small($to));
				 $chart->render("libchart/piechart1.png");
				 ?>
				 <img alt="rtyrt" src="libchart/piechart1.png" />
				 <?php
				 }
			}else if($_REQUEST['model']=="horz")
			{
				$chart = new HorizontalBarChart(800, 500);
				$dataSet = new XYDataSet();
				//$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND bm.bm_dayclosedate $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("'".converdate_small($result_login['dt'])."'",$result_login['amt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Staff Report ".$statusname);
				 else
					$chart->setTitle("Staff Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/horizontalchart.png");
				?>
				 <img alt="Vertical bars chart" src="libchart/horizontalchart.png" />
				 <?php
				 }
			}else if($_REQUEST['model']=="vert")
			{
				$chart = new VerticalBarChart();
				$dataSet = new XYDataSet();
				//$sql_login  =  mysqli_query($con,"SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE  mm.mr_menuid='".$itemid."'  AND  bm.bm_dayclosedate $string Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by bm.bm_dayclosedate DESC "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("'".converdate_small($result_login['dt'])."'",$result_login['amt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Staff Report ".$statusname);
				 else
					$chart->setTitle("Staff Report ".converdate_small($from). " to " .converdate_small($to));
				$chart->render("libchart/verticalchart.png");
				?>
				 <img alt="Vertical bars chart" src="libchart/verticalchart.png" />
				 <?php
				 }
			}
	}
	
	 

