<?php



if(isset($_REQUEST['ipvalue'] ) && ($_REQUEST['ipvalue']!="" )){
$prip=$_REQUEST['ipvalue'];
 exec("ping -n 4 -w 1 ".$prip, $output, $result);
             
                                   if ($result !== 0)
                                    {
                                      echo '<p style="color:red"> <span id="showmsg" class="red-skin"><i class="fa fa-times"></i></span>Bad Network Connection</p>';
                                     
                                      }
                                   else{
                                          echo '<p style="color:green"><span  id="showmsg" class="green-skin"><i class="fa fa-check"></i></span>Connection Ok</p>';
                                      
                                   }
                                   
}


?>
    