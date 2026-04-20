<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance



 if($_REQUEST['set']=='page')
 { 
$_SESSION['page_id']=$_REQUEST['pageid'];

 }else if($_REQUEST['set']=='assign')
 { 
echo $_SESSION['page_id'];

 } 