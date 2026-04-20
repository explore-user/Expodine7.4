<?php
session_start();
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 
if($_REQUEST['value']=='dayclose')
{ 
    $denofinal=$_REQUEST['denofinal'];
    $cashfinal=$_REQUEST['cashfinal'];
    
    $deno1=array();
    $quant1=array();
    $tot1=array();
    
    $denomination=trim($_REQUEST['denomination'],',');
    $deno1=explode(',',$denomination);
    $denocount=count($deno1);
 
    $quantity=trim($_REQUEST['count'],',');
    $quant1=explode(',',$quantity);
   
    
    $total=trim($_REQUEST['total'],',');
    $tot1=explode(',',$total);
    
    $date=$_SESSION['date'];
    
    for($i=0;$i<$denocount;$i++)
    {
        $totaleach = $tot1[$i];
        $quanteach = $quant1[$i];
        $denoeach = $deno1[$i];
        $sqldeno=$database->mysqlQuery("SELECT dm_id FROM tbl_denomination_master WHERE dm_denomination='$denoeach'");
        $num_deno  = $database->mysqlNumRows($sqldeno);
        $result_deno  = $database->mysqlFetchArray($sqldeno);
        $denoid=$result_deno['dm_id'];
        
        $sqlupdatedeno=$database->mysqlQuery("SELECT dcd_deno_id FROM tbl_day_close_denomination where dcd_deno_id='$denoid' and dcd_day='".$_SESSION['date']."'");
        $num_updatedeno  = $database->mysqlNumRows($sqlupdatedeno);
        if($num_updatedeno)
        {
          $result_deno  = $database->mysqlFetchArray($sqlupdatedeno);
          $denoupdateid=$result_deno['dcd_deno_id']; 
          $sql1=$database->mysqlQuery("UPDATE tbl_day_close_denomination SET dcd_count='$quanteach',dcd_value='$totaleach' WHERE dcd_deno_id='$denoupdateid' and dcd_day='".$_SESSION['date']."'");
            
        }
        else
        {
            $sqldenoinsert=$database->mysqlQuery("INSERT INTO tbl_day_close_denomination(dcd_day, dcd_deno_id, dcd_count, dcd_value) VALUES ('$date','$denoid','$quanteach','$totaleach')");  
        }
    }
    $sql1=$database->mysqlQuery("UPDATE tbl_dayclose SET dc_close_total_deno=$cashfinal WHERE dc_day='".$_SESSION['date']."'");
}
?>

