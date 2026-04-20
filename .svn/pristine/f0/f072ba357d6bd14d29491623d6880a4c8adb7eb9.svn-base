<?php

class install_dbconnection
{
	var		$HostName;
	var		$UserName;
	var		$PassWord;
	var		$DatabaseName;
	var $last_query;
        var $last_error;

	var $dbconn;
	//function __construct($hostName = $_SESSION['install_hostname'] , $userName = $_SESSION['install_username'] , $password = $_SESSION['install_password'] , $databaseName = $_SESSION['db_skip'])
	 function __construct ($hostName = HOST_NAME_INSTALL, $userName = USER_NAME_INSTALL, $password = PASSWORD_INSTALL, $databaseName = DATABASE_NAME_INSTALL)
	{

		 $this->HostName		=	$hostName;
		$this->UserName			=	$userName;
		$this->PassWord			=	$password;
		$this->DatabaseName		=	$databaseName;
		$this->dbconn		=	mysqli_connect($this->HostName, $this->UserName, $this->PassWord,$this->DatabaseName) or die(mysql_error());
		mysqli_set_charset($this->dbconn,"utf8");
		mysqli_query($this->dbconn,"SET NAMES 'utf-8'");
		//$this->DatabaseLink		=	mysqli_connect("192.168.1.117", "sample", "123456","expodine_branch1") or die(mysql_error());
		//mysql_select_db($this->DatabaseName,$this->DatabaseLink); 
		//or die("<h3>Error on Server. Please Try Once Again...Thank You!!!<h2><hr>")
	}
	function throw_ex($er){  
	  throw new Exception($er);  
	}
	function check_duplicate_entry($table, $data)
   {
           if (empty($data))
           {
         $this->last_error = "You must pass an array to the duplicate_array() function." ;
         return false;
           }
     
      $sql = "SELECT * FROM $table WHERE ";
   // $sql = "UPDATE ". $table ." SET ";
        foreach( $data as $field => $value )
        {
            
            $updates[] = "`$field` = '$value'";
        }
        $sql .= implode(' and ', $updates);
        
    // echo $sql;die();
      return $this->duplicate_sql($sql );
      
   }
    function duplicate_sql($sql) {

    $this->last_query = $sql;
     
      $r = mysqli_query($this->dbconn,$sql);
      if (!$r) {
         $this->last_error = mysqli_connect_error ();
         return false;
      }
     
      $rows = mysqli_num_rows($r);
      //if ($rows == 0) return true;  // no rows were updated
     // else
	   return $rows;
   }
  function insert( $table, $data)
    {
       
        //Make sure the array isn't empty
        if( empty( $data ) )
        {
            return false;
        }
        
      $sql = "INSERT INTO ". $table;  
		
        $fields = array();
        $values = array();
        foreach( $data as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        

     $sql .= $fields .' VALUES '. $values;
    //return $sql;
      
       
     return $this->insert_sql($sql);

    }
    


   function insert_sql($sql) {
       
      $this->last_query = $sql;
     
      $r = $this->mysqlQuery($sql);
      if (!$r) {
         $this->last_error = mysqli_connect_error ();
         return false;
      }
     
      $id = $this->mysqlInsertId();
      if ($id == 0) return true;
      else return $id;
   }
   function mysqlQuery($qry)
	{	
		$rs		=	mysqli_query($this->dbconn,$qry);
		return $rs;
		
		echo mysql_error();
	}
	function mysqlInsertId()
	{
		$id	=	mysqli_insert_id($this->dbconn);
		return $id;
	}
}
?>