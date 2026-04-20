<?php
session_start();
include("DB/database.class.php"); // DB Connection class
$database	= new Database();

if(isset($_REQUEST['set'])&&($_REQUEST['set']=="check_login")){
    
    $pinok='';
     $loy_qry = $database->mysqlQuery("select l_secure_code from tbl_track_l ");
     $num_loy = $database->mysqlNumRows($loy_qry);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry))
         {
             
             $pinok=$loyalty_listing['l_secure_code'];
          
         }
         }
     $encrypt = sha1($_REQUEST['pin']);
 // echo $encrypt;
  
     if($pinok==$encrypt){
         echo 'ok';
           $loy_qry34 = $database->mysqlQuery("update tbl_track_l set l_logged_status='Y' "); 
     }   else{
         echo 'no';
     } 
         
}
else if(isset($_REQUEST['set'])&&($_REQUEST['set']=="get_reducable_amount")){

$database->mysqlQuery("SET @fromdate = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['datefrom']) . "'");
$database->mysqlQuery("SET @todate  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['dateto']) . "'");

$database->mysqlQuery("SET @MODE = " . "'" . mysqli_real_escape_string($database->DatabaseLink,"T") . "'");


$sq=$database->mysqlQuery("CALL proc_track_r(@fromdate,@todate,@MODE,@Max_Value)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
$rs = $database->mysqlQuery( 'SELECT @Max_Value as m_value' );

while($row = mysqli_fetch_array($rs))
{
$mesg=$row['m_value'];
echo $mesg.',';
}




$database->mysqlQuery("SET @fromdate = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['datefrom']) . "'");
$database->mysqlQuery("SET @todate  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['dateto']) . "'");

$database->mysqlQuery("SET @MODE = " . "'" . mysqli_real_escape_string($database->DatabaseLink,"M") . "'");


$sq=$database->mysqlQuery("CALL proc_track_r(@fromdate,@todate,@MODE,@Max_Value)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
$rs = $database->mysqlQuery( 'SELECT @Max_Value as m_value1' );

while($row = mysqli_fetch_array($rs))
{
$mesg1=$row['m_value1'];
echo $mesg1;
}




}

 else if(isset($_REQUEST['set'])&&($_REQUEST['set']=="amount_reduce")){
   
      $datefrom=$_REQUEST['datefrom'];
      $dateto=$_REQUEST['dateto'];
	
      $reduceval=$_REQUEST['reduceval'];
	
			$database->mysqlQuery("SET @fromdate = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$datefrom) . "'");
			$database->mysqlQuery("SET @todate = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dateto) . "'");
			$database->mysqlQuery("SET @r_amount = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$reduceval) . "'");
			$database->mysqlQuery("SET @mode = " . "'" . mysqli_real_escape_string($database->DatabaseLink,"R") . "'");
		$sq=$database->mysqlQuery("CALL proc_track_r_bill(@fromdate,@todate,@r_amount,@mode,@Total_value,@Max_Value,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			
			
		$rs = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
		
		  $msg=$row['message'];
	        }
	
	echo $msg;
 }

?>