<?php
ob_start();
session_start();
if (isset($_REQUEST['value'])  && $_REQUEST['value']=='full_load') {
     
?>
 <link rel="shortcut icon" href="img/favicon.ico">
    <title> PRINTER STATUS</title>

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
       <a style="width: 175px;background-color: darkred;color: white;border: solid 1px;border-radius: 5px;padding: 5px;
          margin-top: 17px;margin-right: 57%;display: inline-block;float: right" href="troubleshoot.php"> GO TO TROUBLESHOOT </a>
         
         <?php if(in_array('printer_master', $_SESSION['menufullarray'])) { ?>   
       <a style="top: -20px;background-color: darkred;color: white;border: solid 1px;border-radius: 5px;padding: 5px;
          margin-top: -32px;margin-right: 29%;display: inline-block;float: right" href="printer_master.php"> GO TO PRINTER MASTER</a>
      </div>
         <?php } ?> 
    
    </div>
    
    
    


             <div class="require_right_table_cc" style="margin-top: 50px;width: 50%;margin-left: 24%;">
            
                 <table class="require_right_table" width="100%" border="0" style="margin-bottom: 10px;">
                  <thead >
                   <tr>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="5%" scope="col">Sl</th>
                    <th style="background-color: #6d4242 ;text-align: center;color: white" width="32%" scope="col">Printer Name</th>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Type</th>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="16%" scope="col">Printer Ip</th>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="14%" scope="col"> Cover</th>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Paper </th>
                    <th style="background-color: #6d4242;text-align: center;color: white " width="10%" scope="col">Online</th>
                  </tr>
                 </thead>
                 
           <tbody> 
                     
       
         <?php
         
         //error_reporting(0);
         include("database.class.php");
         $con=mysqli_connect(HOST_NAME,USER_NAME, PASSWORD, DATABASE_NAME);
         $a="select pr_printername,pr_printerip,pr_usbprinterip,pr_defaultusb from tbl_printersettings where "
         . " pr_enable='Y' group by pr_printerip,pr_defaultusb" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
         {
            if($row['pr_defaultusb']!="Y"){ 
          
                $prip= $row['pr_printerip'];
                $pr="lan";
            }  
            else
            {   $prip= $row['pr_usbprinterip']; 
                $pr="usb";
            }
       
                exec("ping -n 1 -w 500 ".$prip, $output, $result);
            
                                     if ($result != 0)
                                     {
                                         $st='<span class="red-skin"><i class="fa fa-times"></i></span>';
                                         $paperend = 'Unknown';
                                         $coveropen = 'Unknown';
                                         
                                      }else{
                                          
                                         $st='<span class="green-skin"><i class="fa fa-check"></i></span>';
                                         $paperend = 'Unknown';
                                         $coveropen = 'Unknown';
                                      
                                      }
    
                ?>
                
               
               <tr style="text-transform: uppercase;font-weight: bold">
                    <td style="text-align: center;color: black "><?=$slno++?></td>
                    <td style="text-align: center;color: black "><?php  if($pr=='usb'){ ?> <img title="USB PRINTER" style="width: 35px;height: 25px;cursor: pointer " src="img/usb.png">  <?php  } ?><?php echo $row['pr_printername']; ?></td>
                    <td style="text-align: center;color: black "><?=$pr?> </td>
                    <td style="text-align: center;color: black "> <?=$prip?> </td>
                    <td style="text-align: center;color: black "><?=$coveropen?> </td>
                    <td style="text-align: center;color: black "><?=$paperend?> </td>
                    <td style="text-align: center;color: black "> <?=$st?> </td>
                  </tr>
                  
                  <?php } ?>
                  
                </tbody>
                </table>
                
                </div>
<?php header("Refresh: 3; url=load_printerstatus.php?value=full_load"); } ?>
       

