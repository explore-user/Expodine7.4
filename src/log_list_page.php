<?php
   error_reporting(0);
   include("database.class.php");
         
   $con=mysqli_connect(HOST_NAME,USER_NAME, PASSWORD, DATABASE_NAME);
?>
 <link rel="shortcut icon" href="img/favicon.ico">
    <title> LOGS</title>

 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/require_status_style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <div >
        
       <div class="col-lg-12" style="">
            
        <a href="index.php"><img style="width: 140px;margin-top: 4px;" src="img/logo20.png"></a>
          </div>
        
        <div class="col-lg-12" style="">
       <a style="background-color: darkred;color: white;border: solid 1px;border-radius: 5px;padding: 5px;margin-top: 17px;margin-right: 97%;display: inline-block;float: right" href="troubleshoot.php"> BACK </a>
         </div>
    
    </div>
    
    
     

               <!--///common////-->
               <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    <th style="background-color: #6d4242;text-align: center;color: white;  min-width: 100px; " width="5%" scope="col">Date</th>
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Common Logs</th>
                     
                    <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th>
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_common_logs_all" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 200px;"><?=$row['tcl_date']?></td>
                    <td style="text-align: center;color: black "><?=$row['tcl_data'] ?></td>
                    <td style="text-align: center;color: black "><?=$row['tcl_type']?> </td>
                    
                  </tr>
                  
                  <?php } ?>
                  
                 </tbody>
                </table>

                </div>
    
    
    
    
             <!--///branch Settings////-->
              <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    
                    <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">General Settings Logs</th>
                      <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_general_settings_log" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['tg_date_time']?></td>
                    <td style="text-align: center;color: black "><?=$row['tg_message'] ?></td>
                    <td style="text-align: center;color: black ">Settings</td>
                  </tr>
                  <?php } ?>
                 </tbody>
                </table>

                </div>
    
             
             
             
             <!--///menu Settings////-->
              <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    
                    <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Menu Logs</th>
                      <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_menu_log" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['tml_date']?></td>
                    <td style="text-align: center;color: black "><?=$row['tml_data'].' ['.$row['tml_menu'].']. By '.$row['tml_staff'].' For Module : '.$row['tml_mode']?></td>
                    <td style="text-align: center;color: black "><?=$row['tml_type']?></td>
                  </tr>
                  <?php } ?>
                 </tbody>
                </table>

                </div>
             
             
             <!--///prinrer Settings////-->
              <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    
                    <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Printer Logs</th>
                      <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_printersettings_log" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['l_date_time']?></td>
                    <td style="text-align: center;color: black "><?=$row['l_log']?></td>
                    <td style="text-align: center;color: black ">Printing</td>
                  </tr>
                  <?php } ?>
                 </tbody>
                </table>

                </div>
             
             
             <!--///regen Settings////-->
              <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    
                    <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Regenerate Logs</th>
                      <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_regenrate_log" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['re_datetime']?></td>
                    <td style="text-align: center;color: black "><?=$row['re_billno'].' . Regen by '.$row['re_loginid'].'. Ord : '.$row['re_order_no']?></td>
                    <td style="text-align: center;color: black ">Regenerate</td>
                  </tr>
                  <?php } ?>
                 </tbody>
                </table>

                </div>
             
              <!--///staff Settings////-->
              <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead >
                  <tr>
                    
                    <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                    <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Staff Master Logs</th>
                      <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                 </thead>
           <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_staffmaster_logs" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['date_time']?></td>
                    <td style="text-align: center;color: black "><?=$row['message']?></td>
                    <td style="text-align: center;color: black ">Staff</td>
                  </tr>
                  <?php } ?>
                 </tbody>
                </table>

                </div>
    
               
               <!--///revert Settings////-->
               <div class="require_right_table_cc" style="margin-top: 5px;width: 100%;margin-left: 0%;">
          
            	<table class="require_right_table" width="100%" border="0">
                 <thead>
                  <tr>
                    
                   <th style="background-color: #6d4242;text-align: center;color: white;min-width: 100px; " width="10%" scope="col">Date</th>
                    
                   <th style="background-color: #6d4242 ;text-align: center;color: #ff3e3e" width="32%" scope="col">Revert Logs</th>
                   <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th> 
                  </tr>
                </thead>
                
         <tbody> 
              
         <?php
        
         $a="SELECT * FROM tbl_dayclose_revert_log" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
         ?>
                
                  <tr>
                    <td style="text-align: center;color: black;   min-width: 100px; "><?=$row['td_date_time']?></td>
                    <td style="text-align: center;color: black ">Revert By : <?=$row['td_reverted_by']?></td>
                    <td style="text-align: center;color: black ">Revert</td>
                  </tr>
                  
                  <?php } ?>
                 </tbody>
                </table>

                </div> 
              
<?php 

 ?>
       

