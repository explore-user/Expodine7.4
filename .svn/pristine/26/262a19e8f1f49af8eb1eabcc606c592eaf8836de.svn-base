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
			
				$cur=$_SESSION['date'];//date("Y-m-d");
				$to=$cur;
				//$from=date($_SESSION['date'], strtotime('-1 days'));//$cur;
				$from1 = strtotime("-1 days", strtotime($_SESSION['date']));
				$from=date("Y-m-d", $from1);
				 $string= " bm_dayclosedate between '".$from."' and '".$to."'  group by bm_dayclosedate order by totamt DESC ";
			
			
			
				header("Content-type: image/png");
				$chart = new PieChart(500, 300);
				$dataSet = new XYDataSet();
				$data=array();
				$sql_login  =  mysqli_query($con,"select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
				  $num_login   = mysqli_num_rows($sql_login);
				  if($num_login)
				  {
					  while($result_login  = mysqli_fetch_array($sql_login)) 
						{
						 $dataSet->addPoint(new Point("'".converdate_small($result_login['bdate'])."'",$result_login['totamt']));
						} 
				 $chart->setDataSet($dataSet);
				 if(isset($_REQUEST['newsearch']))
					 $chart->setTitle("Total Sales ".$statusname);
				 else
					$chart->setTitle("Total Sales ".$from. " to " .$to);
				 $chart->render();
				 }
			