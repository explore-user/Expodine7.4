<?php

session_start([
  'cookie_lifetime' => 604800,
]);



if(!isset($_SESSION['expodine_id']))
 { 
          
	// echo "<script type='text/javascript'> window.onload = function() {  $('.alert_error_session').show();  $('.alert_error_session').text('SESSION TIMED OUT');  setInterval(function() { window.location.href='logout.php';  }, 5000);  }   </script>";
       
     echo "<script type='text/javascript'>  window.onload = function() {  $('.alert_error_session').show(); $('.alert_error_button_logout').show(); $('.alert_error_session').text('SESSION RELOADING AUTOMATICALLY');  setInterval(function() { window.location.href='test2.php?set=relogin_session&pin='+localStorage.pin_relogin;  }, 1000);  }   </script>";
    
   }else{
    
	$linkname	= basename($_SERVER['PHP_SELF']);
	$lk=explode(".",$linkname);
	$userlink=$lk[0];
	$chklog=0;
	
  if(!in_array($userlink, $_SESSION['menufullarray'])) 
  { 
      
      if($userlink!='index1'){
	 echo "<script type='text/javascript'> window.onload = function() { $('.alert_error_session').show();  $('.alert_error_button_logout').show();  $('.alert_error_session').text('USER PERMISSION DENIED.PLEASE ASSIGN PERMISSIONS FOR STAFF');  setInterval(function() { window.location.href='index.php';  }, 2000);  }   </script>";	   
      }
  } 
	  
   }
   

?>
 
   