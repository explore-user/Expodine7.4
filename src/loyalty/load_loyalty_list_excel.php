<?php

include("..\database.class.php"); 
$database	= new Database(); 		
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
 
  
            
            
  if($_REQUEST['type']=="loyalty_listing")
{
     
     $string="";
    $name='';
    $email='';
    $phone='';
    if($_REQUEST['name']!="" || $_REQUEST['email']!="" || $_REQUEST['number']!=""){
         $string.='where ';
           $string.='ly_branchid="1" ';
    }
           $email=  trim($_REQUEST['email']);
           $name=  trim($_REQUEST['name']);
           $phone=  trim($_REQUEST['number']);
             
             
          if($_REQUEST['name']!=""){
             if(strlen($_REQUEST['name'])>2){
          $string.=" and  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%')  ";
          }
          }
          
        if($_REQUEST['email']!=""){
             if(strlen($_REQUEST['email'])>2){
         $string.=" and ly_emailid LIKE '%".$email."%' ";
          }
        }
       if($_REQUEST['number']!=""){
               if(strlen($_REQUEST['number'])>2){
         $string.=" and ly_mobileno LIKE '%".$phone."%' ";
          }
       }
       
       
       $data=array();
        $data1=array();
        $a=array();
        $sql_login  =  $database->mysqlQuery("show columns from tbl_loyalty_reg");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $a[]=$result_login['Field'];
        }
        }
       
       $sql_login1  =  $database->mysqlQuery("select * from tbl_loyalty_reg $string ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
            foreach($a as $val){
               
                //echo $bb;
                $data[$val]=$result_login1[$val];
               }
                array_push($data1,$data);
		unset($data);
            }      
       }
       
        $filename = "loyalty.xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
       
       
   
                         
}
            
            
  ?>