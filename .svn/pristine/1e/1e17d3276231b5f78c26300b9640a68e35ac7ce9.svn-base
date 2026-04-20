<?php 
include("..\DB/database.class.php"); // DB Connection class
$database	= new Database();
include ('dumper.php');
if(isset($_REQUEST['set_backup']) && ($_REQUEST['set_backup']=="backup_manual")) {
        $locationdb="";
        $db_name=DATABASE_NAME;
        $bckname='\backup'.date("Y-m-d-h-m-s").'.sql';
        
         $wloc=$_SERVER['DOCUMENT_ROOT'];
         
        $locationdb=$wloc.'/track/bkup'.$bckname;
        
          
        
}

try {
	$world_dumper = Shuttle_Dumper::create(array(
		'host' => HOST_NAME,
		'username' => USER_NAME,
		'password' => PASSWORD,
		'db_name' => $db_name,
	));
       
        
	// dump the database to gzipped file
	$world_dumper->dump($locationdb.'.gz');

	

} catch(Shuttle_Exception $e) {
	echo "Couldn't dump database: " . $e->getMessage();
}