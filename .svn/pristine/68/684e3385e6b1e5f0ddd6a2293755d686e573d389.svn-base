<?php
//include('includes/session.php');		// Check session
//$database='';

//if((HOST_NAME))
//{
//include("database.class.php"); // DB Connection class
//$database	= new Database(); 		// Create a new instance
//}

class reportemail
{


//$_SESSION['type']="newentry";
function setbranch()
{
	if (!isset($_SESSION)) session_start();
	$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
	$branchname='';
 $sql_branch =  mysqli_query($con,"Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						echo $branchname=$result_branch['be_branchname'];
						
					}
		  }


}
function convert_date($date){
	
	$newdate	= explode("-",$date);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
	
	$c_date		= $year."-".$month."-".$date;
	return $c_date;
	
}

function fetchSingleAssocRow($qry)
	{
		if (!isset($_SESSION)) session_start();
	$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
		$row		=	array();
		$rs			=	mysqli_query($con,$qry);
		if($rs	===	FALSE)
			return $row;
				
		$row		=	mysqli_fetch_assoc($rs);
		mysqli_free_result($rs);
		return $row;	
	}

function show_tableorder_ful_details($id)
	{
		 $cqrycat	=	"SELECT * FROM tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn ON to1.ter_menuid=mn.mr_menuid  where ter_orderno='$id' "; 
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}










function ss()
{
	?>
    <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" >
    <?php  $this->setbranch();?>
    </page>
    <?php
}
function setreportsall($reportmnname)
{
	//error_reporting(0);
	//if (!isset($_SESSION)) session_start();
	$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
	$_SESSION['type']=$reportmnname;
	if($_SESSION['type']!='')
	{
?>


<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" >
<!--<table style="text-align: center;  background: #60497b;height:100px; width: 100%" align="center">
    <tr>
        <td style="width: 50%"><img src="images/since_pdf.jpg" alt="Since" width="50" /></td>
        <td style="width: 50%"><img src="images/logo_head.jpg" alt="Logo" width="150" /></td>
    </tr>
</table>-->
<br />
 <?php if($_SESSION['type']=="tot_sales") { 
   $reporthead="";
  if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 
 $servicetax_stats='N';
	 $sql_login  =  mysqli_query($con,"SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >'
<!--  <col style="width: 1%">-->
    <col style="width: 5%" class="col1">
    <col style="width: 10%">
    <col style="width: 13%">
    <col style="width:17%">
    <col style="width: 11%">
    <col style="width:10%">
    <col style="width: 11%">
    <col style="width: 11%">
    <col style="width:11%">
   
    
      <?php
  $string=" bm_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				
				
			
				
				
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		$st="";
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st.= "Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st.= "Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st.= "Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st.= "Last 30 days";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st.= "Today";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
				  $st.= "Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				    $st.= "Last 1 month";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		  $st.= "Last 90 days";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		 $st.= "Last 180 days";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			 $st.= "Last 365 days";
	}
$reporthead.=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 		
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
    
    
    ?>
    
    
    
    
    
    
      <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="10">Report - <?=$reporthead?></td>
  </tr>
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Slno</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Table</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sub Total</td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Service Tax</td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$srvtx=$srvtx + $result_login['bm_servicetax'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_tableno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_subtotal']?></td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_servicetax']?></td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_discountvalue']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
      <td style=" border: solid 1px #CCC;padding:3px;"></td>
     <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$subtotal?></td>
    <?php if($servicetax_stats=='Y'){ ?><td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$srvtx?></td><?php } ?>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
 if($_SESSION['type']=="kitchen_wise") { 
   $reporthead="";
  if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 
// $servicetax_stats='N';
//	 $sql_login  =  mysqli_query($con,"SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
//	  $num_login   = mysqli_num_rows($sql_login);
//	  if($num_login){
//		 $servicetax_stats='Y';
//	  }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >'
<!--  <col style="width: 1%">-->
    <col style="width: 5%" class="col1">
    <col style="width: 10%">
    <col style="width: 13%">
    <col style="width:17%">
    <col style="width: 11%">
    <col style="width:10%">
    <col style="width: 11%">
    <col style="width: 11%">
    <col style="width:11%">
   
    
      <?php
      
  $string=" o.ter_status='Closed' AND ";
  if($_SESSION['ktc']!=""){
      $string.=" m.mr_kotcounter='".$_SESSION['ktc']."' and ";
  }
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				
				
			
				
				
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" o.ter_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		$st="";
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st.= "Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st.= "Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st.= "Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st.= "Last 30 days";
	}
	
	else if($bydatz=="Today")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st.= "Today";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="o.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
				  $st.= "Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				    $st.= "Last 1 month";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		  $st.= "Last 90 days";
	}
else if($bydatz=="Last180days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		 $st.= "Last 180 days";
	}
else if($bydatz=="Last365days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			 $st.= "Last 365 days";
	}
$reporthead.=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead.="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 		
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
    
    
    ?>
    
    
    
    
    
    
      <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="10">Report - <?=$reporthead?></td>
  </tr>
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Slno</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Kitchen</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Item</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Quantity</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Total</td>
    
  </tr>
<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $qty = 0;
  $slno = 0;
  //----------
  include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
  $sql_ktc  =  $database->mysqlQuery("select distinct(m.mr_kotcounter),k.kr_kotname from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
inner join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter where $string
"); 
//echo "select distinct(m.mr_kotcounter),k.kr_kotname from tbl_tableorder o
//inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
//inner join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter where $string";
$num_ktc   = $database->mysqlNumRows($sql_ktc);
if($num_ktc){
  while($result_ktc  = $database->mysqlFetchArray($sql_ktc)) {
      $slno ++;
      ?>
   <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$slno?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_ktc['kr_kotname']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
   </tr>
      <?php
  //----------------
  
  
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string
group by o.ter_menuid");
//          echo "select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
//inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
//where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string
//group by o.ter_menuid";
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      $qty = $qty + $result_login['qty'];
			$subtotal=$subtotal + $result_login['tot'];
                                
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['qty']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tot']?></td>
    
  </tr>
  <?php $i++;} }
  }
}?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
      <td style=" border: solid 1px #CCC;padding:3px;"></td>
     <td style=" border: solid 1px #CCC;padding:3px;"><?=$qty?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$subtotal?></td>
   
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
  if($_SESSION['type']=="summary") { 

 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
	 
	 
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 $reporthead='';
 $servicetax_stats='N';
	 $sql_login  =  mysqli_query($con,"SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Summary</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px;" align="center" cellpadding="0"  >
    <col style="width: 50%" class="col1">
    <col style="width: 50%">
  
   
  <?php
  
  $string='';
  $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str="(sum(bm_amountpaid) - sum(bm_amountbalace))";
	$string2_str="  sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
		$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	//$string1 =$strings. " pym_code='cash'  AND ";
//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	

   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
	
	else
	{
		$bydatz=$_SESSION['hidbydate'];
		$st='';
			if($bydatz!="null")
			{
		//$search="";
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  $st= " Last 20 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $st= " Last 25 days ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  $st= " Last 30 days ";
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $st= " Today ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
					  $st= "  Yesterday ";
					  	$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $st= " Last 1 month ";
					  $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  $st= " Last 3 months ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  $st= " Last 6 months ";
					  	$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
					  $st= " Last 1 Year "; 
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				  }
				$reporthead=$st;
			}
			else
			{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
			}
	}
	?>
      <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="2">Report - <?=$reporthead?></td>
  </tr>
  <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center; font-size:12px" >Type</td>
     <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:12px" >Value</td>
  </tr>
  <?php
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  mysqli_query($con,"select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;text-align:justify;">Cash</td>
    <td style=" border: solid 1px #CCC;padding:3px;text-align:justify;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } }}
  
  
   $sql_login  =  mysqli_query($con,"select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
  
  <tr class="main" style="width:100px;">
    <td style=" border: solid 1px #CCC;padding:3px; width:300px;text-align:left;"><?="Credit / Debit card- ".$result_login['bank_name']?></td>
    <td style=" border: solid 1px #CCC;padding:3px; width:300px;text-align:left;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  
  <?php } }
  
  
  
  
  	
  
  
  
  
  
  
  
  /*
  	$sql_login1  =mysqli_query($con,"select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string  group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	      
	  $num_login1   =  mysqli_num_rows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = mysqli_fetch_array($sql_login1)) 
			{ 
			?>
            <tr class="main" style="width:100px">
            <td style=" border: solid 1px #CCC;padding:3px;"><?="Credit- ".$result_login1['bank_name']?></td>
            <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login1['tot'])?></td>
            </tr>
      
			
		<?php	}
	  }
  */
  
  
  
  
  $sql_login  =  mysqli_query($con,"select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;">Coupons</td>
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } } }
  
  $sql_login  =  mysqli_query($con,"select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;">Voucher</td>
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } } }
  
  $sql_login  =  mysqli_query($con,"select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;">Cheque</td>
    <td style=" border: solid 1px #CCC;padding:3px;text-align:left;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } } }
  
  
  
  		
			$sql_login  =  mysqli_query($con,"select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr  class="main" style="width:100px" >
          <td  style=" border: solid 1px #CCC;padding:3px;text-align:center;">Credits</td>
          <td style=" border: solid 1px #CCC;padding:3px;text-align:center;"><?=round($result_login['tot'])?></td>
         
            </tr> 
            <?php } }}
				
			$sql_login  =  mysqli_query($con,"select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr class="main" style="width:100px" >
          <td style=" border: solid 1px #CCC;padding:3px;text-align:left;">Complimentary</td>
          <td style=" border: solid 1px #CCC;padding:3px;text-align:left;"><?=round($result_login['tot'])?></td>
         
            </tr> 
            <?php } }}
  
  
  
  
  
  
  
  	 $qtycount=0;
		   $sql_login =   mysqli_query($con,"SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$qtycount=$qtycount + $result_login['ct'];
				
                
                
                
                
			}?>
            <tr class="main" style="width:100px">
                  <td style=" border: solid 1px #CCC;padding:3px 0px 0px 3px;text-align:left;">Total Pax</td>
                  <td style=" border: solid 1px #CCC;padding:3px 0px 0px 3px;text-align:left;"><?=$qtycount?></td>
                </tr><?php
	  }
			
 
			
			
			 ?>
                              
  
  
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($subtotal)?></td>
    
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
 
 if($_SESSION['type']=="bill_cancel")  { 
 
 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Bill Cancel Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Amount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Cancelled By</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Reason</td>
  </tr>
  <?php
  $string=" bm_status='Cancelled' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" b.bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;
  $paid=0;
  $bal=0;

       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"select DISTINCT b.bm_dayclosedate,b.bm_billno,b.ter_cancelledreason,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			/*$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];*/
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ser_firstname'].' '.$result_login['ser_lastname']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_cancelledreason']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
   
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
  if($_SESSION['type']=="kot_report")  { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">KOT Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 15%">
    <col style="width: 30%">
    <col style="width: 30%">
    <col style="width: 15%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">KOT No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Rate</td>
   
  </tr>
  <?php
  $string=" tor.ter_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tor.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tor.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;$old='';$new='';
       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"select tor.ter_kotno,tor.ter_dayclosedate,mm.mr_menuname,(tor.ter_rate * tor.ter_qty) as rate from tbl_tableorder as tor LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string order by tor.ter_dayclosedate,tor.ter_entrytime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['rate'];
			if($i==1)
				{
					$each=$each + $result_login['rate'];
					$old=$result_login['ter_kotno'];
					$new=$result_login['ter_kotno'];
					?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['ter_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_kotno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                    </tr>
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['ter_kotno'];
					if($new==$old)
					{$each=$each + $result_login['rate'];
						?>
                      <tr class="main" style="width:100px">
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                      </tr>
                      <?php
					}else
					{
						?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                    </tr>
                  <?php $each=0;
				  $each=$each + $result_login['rate'];
				   ?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['ter_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_kotno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                    </tr>
                  <?php
					}
				}
			
	 ?>
 
  <?php $i++;} 
  ?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                    </tr>
                  <?php
  } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
  if($_SESSION['type']=="bill_details")  { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Bill Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 30%">
    <col style="width: 30%">
    <col style="width: 10%">
     <col style="width: 10%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Rate</td>
   <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
  </tr>
  <?php
  $string=" bm.bm_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate=  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;$old='';$new='';
  $dsc=0;
 $dscfinal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno where $string order by bm.bm_dayclosedate,bm.bm_billtime"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
			if($i==1)
				{
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_billno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                    </tr>
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
						?>
                      <tr class="main" style="width:100px">
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      </tr>
                      <?php
					}else
					{
						?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
                    </tr>
                  <?php $each=0;$dsc=0;
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				  
				   ?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_billno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                       <td style=" border: solid 1px #CCC;padding:3px;"></td>
                    </tr>
                  <?php
					}
				}
			
	 ?>
 
  <?php $i++;} 
  ?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
                    </tr>
                  <?php
  } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
     <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$dscfinal?></td>
  </tr>
  
   <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">GRAND TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
     <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=($final-$dscfinal)?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
  if( $_SESSION['type']=="discount_report") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Discount Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 15%">
    <col style="width: 10%">
    <col style="width: 15%">
    <col style="width: 10%">
    <col style="width: 15%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sub Total</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
  <?php
  $string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND  ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;
  $paid=0;
  $bal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_subtotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_discountvalue']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }
 
  
  if( $_SESSION['type']=="type_pay") {   ?> 
 
 <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
     <?php
  
  $string="";
	$fields="";
	if($_SESSION['types']=="cash")
	{
		//$string = " bm_transactionid ='' and bm_couponcompany ='' and bm_voucherid ='' and bm_chequeno ='' and bm_chequebankname=''";
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = " bm_paymode='cash'";
		$fields="";
	}else if($_SESSION['types']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " bm_paymode='credit'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Transaction Amount</td>";
		
	}else if($_SESSION['types']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " bm_paymode='coupons'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Company</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Amount</td>";
	}else if($_SESSION['types']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " bm_paymode='voucher'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Voucher</td>";
	}else if($_SESSION['types']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " bm_paymode='cheque'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Cheque No</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Bank Name</td>";
	}
  
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else
		{
			
			
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";
	}
			
			
			
			
			
			
			
			
			
			
		
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
		}
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
     <?=$fields ?>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
 <?php
  $final=0;
  $paid=0;
  $bal=0;
  $coup=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  mysqli_query($con,"select * from tbl_tablebillmaster where $string"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    
     <?php
		 if($_SESSION['types']=="credit")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_transactionamount']?></td>
			<?php
			
		}else if($_SESSION['types']=="coupons")
		{ $coup=$coup + $result_login['bm_couponamt'];
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_couponcompany']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_couponamt']?></td>
			<?php
		}else if($_SESSION['types']=="voucher")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_voucherid']?></td>
			<?php
		}else if($_SESSION['types']=="cheque")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_chequeno']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_chequebankname']?></td>
			<?php
		}
		?>
    
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <?php
	   if($_SESSION['types']=="credit")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
		  
	  }else if($_SESSION['types']=="coupons")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="voucher")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="cheque")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }
	  ?>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
     <?php
	   if($_SESSION['types']=="credit")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
		  
	  }else if($_SESSION['types']=="coupons")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;"><?=$coup?></td>
		  <?php
	  }else if($_SESSION['types']=="voucher")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="cheque")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }
	  ?>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 
 
 
 <?php }
  if( $_SESSION['type']=="item")  {  
 
	$floor=$_SESSION['floorv'];
	
	?>
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
    
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 25%">
    <col style="width: 25%">
   
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Category</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Sub Category</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Dine In</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Take Away</td>
  </tr>
  
    <?php
	 $sql_cat  =  mysqli_query($con,"select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = mysqli_num_rows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = mysqli_fetch_array($sql_cat)) 
			{
				$j++;
				
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					?>
								  
                                  <tr>
                                  	<td colspan="1" style="text-align:left; border: solid 1px #CCC;padding:3px;"><strong><?=$menucat['mmy_maincategoryname']?></strong></td>
                                  	<td colspan="4" style="text-align:left; border: solid 1px #CCC;padding:3px; "></td>
                                  </tr>
                                  <?php
								  $sql_sub  =  mysqli_query($con,"select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = mysqli_num_rows($sql_sub);
				if($num_sub){$k=0;
					while($result_sub  = mysqli_fetch_array($sql_sub)) 
						{$k++; 
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
						 ?> 
                                 <tr>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$menusub['msy_subcategoryname']?></td>
                                    <td colspan="3" style="text-align:left;border: solid 1px #CCC;padding:3px;"> </td>
                                  </tr> 
                                  
                                  <?php
								
								  $sql_menulist_dine= "select mr_menuid,mr_menuname  from tbl_menumaster  WHERE  mr_active='Y' and  mr_maincatid='".$result_cat['catid']."' and mr_subcatid='".$result_sub['subid']."'  order by mr_subcatid ";
		
				$sql_menus  =  mysqli_query($con,$sql_menulist_dine); 
				$num_menus  = mysqli_num_rows($sql_menus);
				if($num_menus){$l=0;$old="";
					while($result_menus  = mysqli_fetch_array($sql_menus)) 
						{$l++; 
							//menuname
							  if($l==0)
							  {
								  $old=$result_menus['mr_menuname'];
								  $menuname=$result_menus['mr_menuname'];
							  }else if($l>0)
							  {
								  if($result_menus['mr_menuname']==$old)
								  {
									  $menuname="";
								  }else
								  {
									  $old=$result_menus['mr_menuname'];
									  $menuname=$result_menus['mr_menuname'];
								  }
							  }
						      //Dine Away
							  $dinein="";
							   $sql_menulist_din="SELECT mt.mmr_rate,pm.pm_portionname FROM tbl_menuratemaster as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mmr_portion WHERE mt.mmr_menuid='".$result_menus['mr_menuid']."'  and mt.mmr_floorid='".$floor."'";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_dn=mysqli_query($con,$sql_menulist_din); 
							  $num_dn  = mysqli_num_rows($sql_dn);$f=0;
								if($num_dn)
								{
									
									while($result_dn  = mysqli_fetch_array($sql_dn)) 
									{
										if($f==0)
										{
										$dinein=$result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}else
										{
											$dinein=$dinein." , ". $result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}
										$f++;
									}
								}else
								{
									$dinein="";
								}
							  
							  
							  //take away
							  
							  $sql_menulist_tak="SELECT mt.mta_rate,pm.pm_portionname FROM tbl_menuratetakeaway as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mta_portion WHERE mt.mta_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take=mysqli_query($con,$sql_menulist_tak); 
							  $num_take  = mysqli_num_rows($sql_take);
								if($num_take)
								{
									$tak_portion="";$tak_rate="";
									while($result_take  = mysqli_fetch_array($sql_take)) 
									{
									$takeaway=$result_take['mta_rate']."(".$result_take['pm_portionname'].")";
									}
								}else
								{
									$takeaway="N/A";
								}
								 //$result_menus['mmr_rate']."(".$result_menus['pm_portionname'].")"
								 if($dinein!=""){
						 ?>
                            <tr>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$menuname?> </td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$dinein?></td>
                                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$takeaway?></td>
                                  </tr>
                           <?php } ?>
                         <?php } } ?>    
                           
                <?php } } ?>
                                
                                 
                                  <?php
					
				}
			}
		}
	
	?>
     </table>
 
 <?php }
  if( $_SESSION['type']=="steward") {   ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Steward Report</td>
        </tr>
        
    </table>
    
    <?php
	$string="";
	$stw=$_SESSION['stwr'];
	 if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_REQUEST['from']);
			$to=$this->convert_date($_REQUEST['to']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_REQUEST['to']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}/*else if($_SESSION['fromdt']=="" && $_SESSION['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		} */
		
		else
		{
			
			
				$stewardbydate=$_REQUEST['hidstwbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		
		}
		
		
		
		
		
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Item</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
  </tr>
  
    <?php
 	  $sql_stw  =  mysqli_query($con,"Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{
				?>
  
 			 <tr>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
            </tr>
                                  <?php  }} ?>
                                  </table>
  
  
 
 <?php }
 
  if( $_SESSION['type']=="order")  { ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Item Ordered</td>
        </tr>
        
    </table>
      <?php
  $string="";
  $reporthead="";
  
    if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
/*  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
  */
  
  
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		$st= "";
			$orderbydate=$_REQUEST['hidbydate'];
	
			if($orderbydate!="null")
	{
		//$search="";
	
	if($orderbydate=="Last5days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st= "Last 5 days ";
	}elseif($orderbydate=="Last10days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st= "Last 10 days ";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st= "Last 15 days ";
	}
	else if($orderbydate=="Last20days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st= "Last 20 days ";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st= "Last 25 days ";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st= "Last 30 days ";
	}
	else if($orderbydate=="Today")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st= "Today ";
	}
	else if($orderbydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
				  $st= "Yesterday ";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
  $st= "Last 1 month ";
	}

	else if($orderbydate=="Last90days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	 $st= "Last 3 months ";
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		 $st= "Last 6 months ";
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		 $st= "Last 1 year ";
	}
	$reporthead=$st;

	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_tableorder.ter_dayclosedate   between '".$from."' and '".$to."' ";
	}
		
	} ?>
    
    
    
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 40%">
      <col style="width: 20%">
        <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="3">Report - <?=$reporthead?></td>
  </tr> 
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
   
  </tr>

    							  <tbody>
       <?php
	   
 	  $sql_stw  =  mysqli_query($con,"Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where tbl_tableorder.ter_qty<>'0' and tbl_tableorder.ter_status='Closed' AND   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{
				?>
                
        

                 <tr>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php }
  if($_SESSION['type']=="portion_order")   {   ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$_SESSION['s_portionname']?> Order Report</td>
        </tr>
        
    </table>
    
    <?php
	$string="";
	$prt=$_SESSION['prtn'];
	
	if($prt !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prt ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prt ."%'";
		}
	}
	
	
	
	 if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_REQUEST['from']);
			$to=$this->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}

		
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";	
			}
		}else 
		//if($_SESSION['fromdt']=="" && $_SESSION['todt']=="")
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}*/
			

			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
				
			}*/
			$prtn=$_REQUEST['prtn'];
			$portionbydate=$_REQUEST['hidportn'];
	
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	
	{
			if($string!="")
			{
		
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}

	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
		
			
			
			
			
			
			
			
			
			
			
			
			
		}
			
			
	}
	else
	{
		
	}
			
					
			
			
			
			
			
		} 
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Item</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;"><?=$_SESSION['s_portionname']?></td>
  </tr>
  
    <?php
 	  $sql_stw  =  mysqli_query($con,"Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid inner join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{
				?>
  
 			 <tr>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['pm_portionname']?></td>
            </tr>
                                  <?php  }} ?>
                                  </table>
  
  
 
 <?php }
 
   if( $_SESSION['type']=="type_order")  { ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Type of order</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 40%">
    <col style="width: 20%">
   
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
   
  </tr>
  <?php
  $string="";
  $ordertyp=$_SESSION['ordertyp'];
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['hidorderby'];
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
				  $string.="tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 
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
		
	
	} ?>
    							  <tbody>
       <?php
	  
 	  $sql_stw  =  mysqli_query($con,"Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordertyp."' Group By tbl_menumaster.mr_menuname  DESC"); 
	  $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{
				?>
                 <tr>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php } 
   if($_SESSION['type']=="cancel_history")   {
	 
	 
 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
	  ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Item Cancel Log</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
      <col style="width: 5%" class="col1">
      <col style="width: 10%">
      <col style="width: 10%">
      <col style="width: 10%">
      <col style="width:25%">
      <col style="width: 3%">
      <col style="width: 10%">
    <tr >    
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Slno</td>
<!--      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
       <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Order NO</td>-->
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">KOT No</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Qty</td>
        <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Staff name</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Cancelled Login</td>
        <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Reason for cancellation</td>
  </tr>
  <?php
  $string="";
  $ordertypebydate= $_SESSION['hidbydate'];
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		
	
	
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($ordertypebydate=="Yesterday")
			  {
				  $string.="ch.ch_dayclosedate   =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	
	} ?>
    							  <tbody>
       <?php
	  
 	  $sql_stw  =  mysqli_query($con,"Select  ch.ch_dayclosedate,ch.ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin where  $string "); 
	   // $sql_stw  =  mysqli_query($con,"Select ch.ch_dayclosedate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid where  $string");
       $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{$fuldet=$this->show_tableorder_ful_details($result_stw['ch_orderno']);
				?>
                 <tr>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?></td>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_stw['ch_dayclosedate'])?></td>
                   
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_orderno']?></td>
                          <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_kotno']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$fuldet['mr_menuname']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_cancelled_qty']?></td>
                  
                      <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ser_firstname']?></td>
                        <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ls_username']?></td>
                          <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_cancelledreason']?></td>
                    
                 
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php } 
   if($_SESSION['type']=="newentry")   {
	 
	///date(ly_entrydatetime) BETWEEN '2015-11-18' AND '2015-11-18' 
 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];

 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
	  ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Newly Entered Visitors</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
      <col style="width: 20%" class="col1">
      <col style="width: 20%">
      <col style="width: 60%">
     
    <tr >    
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Slno</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Name</td>
      
  </tr>
 <tbody>
 
  <?php
  $string="";
  $ordertyp=$_SESSION['hidbydate'];
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string= " date(ly_entrydatetime)  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " date(ly_entrydatetime)  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string= " date(ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$ordertyp;
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" date(ly_entrydatetime)  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($ordertypebydate=="Yesterday")
			  {
				  $string.="date(ly_entrydatetime)   =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" date(ly_entrydatetime)   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	
	} ?>
 
       <?php
	  //`tbl_loyalty_reg`(`ly_id`, `ly_firstname`, `ly_lastname`, `ly_mobileno`, `ly_emailid`, `ly_birthdaydate`, `ly_maritalstatus`, `ly_anniversarydate`, `ly_profession`, `ly_totalvisit`, `ly_mailreceive`, `ly_smsreceive`, `ly_entrydatetime`)
 	  $sql_stw  =  mysqli_query($con,"Select ly_firstname,ly_lastname,date(ly_entrydatetime) as dt FROM tbl_loyalty_reg WHERE  $string "); 
	  $num_stw   = mysqli_num_rows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = mysqli_fetch_array($sql_stw)) 
			{
				?>
                 <tr>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?></td>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$this->convert_date($result_stw['dt'])?></td>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ly_firstname']." ".$result_stw['ly_firstname']?></td>
                   
                     
                 
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php }
 
 if($_SESSION['type']=="summary_ham")
 {
 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
	 
	 
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 $reporthead='';

 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$this->setbranch();?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Summary</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 50%" class="col1">
    <col style="width: 50%">
  
   
  <?php
  
  
  	$strin="";
  	$strngs=" ter_status='Closed' AND ";
  $string='';
  $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str="(sum(bm_amountpaid) - sum(bm_amountbalace))";
	$string2_str="  sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
		$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	

   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";		
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$this->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
					$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$this->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to) ; 
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
					$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		
	
	else
	{
		$bydatz=$_SESSION['hidbydate'];
		$st='';
			if($bydatz!="null")
			{
		//$search="";
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
				$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";			
						
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";		
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  $st= " Last 20 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
						
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $st= " Last 25 days ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
					  $st= " Last 30 days ";
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $st= " Today ";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
						
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";	
						
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
					  $st= "  Yesterday ";
					  	$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  DAY AND CURDATE( )";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $st= " Last 1 month ";
					  $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  	$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  $st= " Last 3 months ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";	
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  $st= " Last 6 months ";
					  	$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";		
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
					  $st= " Last 1 Year "; 
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
					  	$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				  }
				$reporthead=$st;
			}
			else
			{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$this->convert_date($from)."- To ".$this->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			}
	}
	?>
      <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="2">Report - <?=$reporthead?></td>
  </tr>
  <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center; font-size:12px" >Type</td>
     <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:12px" >Value</td>
  </tr>
  <?php
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  mysqli_query($con,"select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Cash</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } }}
  
  
   $sql_login  =  mysqli_query($con,"select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?="Credit / Debit card- ".$result_login['bank_name']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } }
  
  
  
  	
  
  
  
  
  
  
  
  /*
  	$sql_login1  =mysqli_query($con,"select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string  group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	      
	  $num_login1   =  mysqli_num_rows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = mysqli_fetch_array($sql_login1)) 
			{ 
			?>
            <tr class="main" style="width:100px">
            <td style=" border: solid 1px #CCC;padding:3px;"><?="Credit- ".$result_login1['bank_name']?></td>
            <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login1['tot'])?></td>
            </tr>
      
			
		<?php	}
	  }
  */
  
  
  
  
  $sql_login  =  mysqli_query($con,"select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{$cmp='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cmp=$result_login['tot'];
				}else
				{
					$cmp="0.00";
				}
				
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Coupons</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($cmp)?> </td>
    
  </tr>
  <?php  } }
  
  $sql_login  =  mysqli_query($con,"select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{$cmp='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cmp=$result_login['tot'];
				}else
				{
					$cmp="0.00";
				}
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Voucher</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($cmp)?> </td>
    
  </tr>
  <?php  } }
  
  $sql_login  =  mysqli_query($con,"select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{$cmp='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cmp=$result_login['tot'];
				}else
				{
					$cmp="0.00";
				}
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Cheque</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($cmp)?> </td>
    
  </tr>
  <?php  } }
  
  
  
  		
			$sql_login  =  mysqli_query($con,"select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ $cmp='';
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$cmp=$result_login['tot'];
				}else
				{
					$cmp="0.00";
				}
			?>
          <tr  class="main" style="width:100px" >
          <td  style=" border: solid 1px #CCC;padding:3px;">Credits</td>
          <td style=" border: solid 1px #CCC;padding:3px;"><?=round($cmp)?></td>
         
            </tr> 
            <?php  }}
				
			$sql_login  =  mysqli_query($con,"select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ $cmp='';
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$cmp=$result_login['tot'];
				}else
				{
					$cmp="0.00";
				}
			?>
          <tr class="main" style="width:100px" >
          <td style=" border: solid 1px #CCC;padding:3px;">Complimentary</td>
          <td style=" border: solid 1px #CCC;padding:3px;"><?=round($cmp)?></td>
         
            </tr> 
            <?php  }}
  
  
  
  
  $sql_login  =  mysqli_query($con,"SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES' OR TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES' ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
			//$subtotal =$subtotal + $result_login['Total'];
			?>
          <tr class="main" style="width:100px" >
          <td style=" border: solid 1px #CCC;padding:3px;">Beverages</td>
          <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['Total'])?></td>
         
            </tr> 
            <?php } }}
			$sql_login  =  mysqli_query($con,"SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES' OR TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES' ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  =  mysqli_fetch_array($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
			//$subtotal =$subtotal + $result_login['Total'];
			?>
          <tr class="main" style="width:100px" >
          <td style=" border: solid 1px #CCC;padding:3px;">Food</td>
          <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['Total'])?></td>
         
            </tr> 
            <?php } }}
  
  
  
  
  
  
  
  
  
  	 $qtycount=0;
		   $sql_login =   mysqli_query($con,"SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$qtycount=$qtycount + $result_login['ct'];
				
                
                
                
                
			}?>
            <tr class="main" style="width:100px">
                  <td style=" border: solid 1px #CCC;padding:3px;">Total Pax</td>
                  <td style=" border: solid 1px #CCC;padding:3px;"><?=$qtycount?></td>
                </tr><?php
	  }
			
   	 $bilcount=0;
		   $sql_login =   mysqli_query($con,"SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$bilcount=$bilcount + $result_login['bills'];
				
                
                
                
                
			}?>
            <tr class="main" style="width:100px">
                  <td style=" border: solid 1px #CCC;padding:3px;">No.Of Invoices</td>
                  <td style=" border: solid 1px #CCC;padding:3px;"><?=$bilcount?></td>
                </tr><?php
	  }
		
		 $disct=0;
		   $sql_login =   mysqli_query($con,"SELECT sum(bm_discountvalue) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_login   =mysqli_num_rows($sql_login);
	  if($num_login){
		  while($result_login  = mysqli_fetch_array($sql_login)) 
			{
				$disct=$disct + $result_login['bills'];
				
                
                
                
                
			}?>
            <tr class="main" style="width:100px">
                  <td style=" border: solid 1px #CCC;padding:3px;">Total Discount</td>
                  <td style=" border: solid 1px #CCC;padding:3px;"><?=$disct?></td>
                </tr><?php
	  }	
			
			 ?>
                              
  
  
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($subtotal)?></td>
    
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php 
	
	
	
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 }
 
 
 
 
 
 
 
 ?>
 
 
 
 
 
 
<table style="text-align: center;  background: #900;width: 100%; font-size:8px; color:#FFF;" align="center">

    <tr>
        <td style="width:100%" >Mail</td>
    </tr>
</table>

</page>
<?php } } } ?>