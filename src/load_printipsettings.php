       
<?php
//error_reporting(0);
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 
 if($_REQUEST['value']=="checkmenu12345")
	 {
		$test= $_REQUEST['mid12345'];
	
	 $sql_login  =  $database->mysqlQuery("select (mr_menuname) from tbl_menumaster where mr_menuname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         

        else if($_REQUEST['value']=="checkprinterip")
	 {             

	$printer= $_REQUEST['mid'];
          
        $insertion['pr_id'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['pr_machine_ip']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid1']);
        
        $sql=$database->check_duplicate_entry('tbl_printersettings_ip',$insertion);
	 if($sql!=1){
             $insertid              			=  $database->insert('tbl_printersettings_ip',$insertion);
         ?>
<script>	
	document.getElementById("prmachineip").value = "";
	</script>
             
    <?php     }

        else
	 {
		   ?>
         <span id="pridchk" class="load_error alertsmaster" style="color:#F00" ></span>
<!--		       <span id="pridchk" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      -->
             <script type="text/javascript">
			  var pridchk=$('#pridchk');
			  pridchk.text('Already exists');
			 </script>  
                      <?php
	 }
        
    
         } 
               

    
if (isset($_REQUEST['value']))
	 {  
            
	$database->mysqlQuery("DELETE FROM tbl_printersettings_ip WHERE pr_machine_ip = '" .$_REQUEST['value']."' and pr_id='".$_REQUEST['mid']."'");
            ?> 

            <table width="100%" border="0" id="printeriptable">
              <?php   

                $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings_ip where pr_id='".$_REQUEST['mid']."'"); 
	        $num_login   = $database->mysqlNumRows($sql_login);
	        if($num_login){
	        while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{

                      ?>  
                 <tr>
                  <td><?=$result_login['pr_machine_ip']?></td>
                <td style="text-align: center;"> <a href="#"  id="<?=$result_login['pr_machine_ip']?>"  onclick="delete_confirm('<?=$result_login['pr_machine_ip']?>')" > <div class="action_button"><img src="img/delete_btn_2.png"></div></a></td>
              </tr>

                <?php  } } ?>
              </table>
        
        
      <?php   } ?>


     
      
             
                   