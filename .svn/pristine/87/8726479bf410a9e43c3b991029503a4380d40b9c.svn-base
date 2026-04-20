<?php
session_start();
//include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['report_master_id']=$_REQUEST['rm_id'];
$sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where rm_id='".$_SESSION['report_master_id']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['rm_reportname'];
	  }			
} 
else
{
  $searchname="";
}
	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
			 
		}
	/***************************************  Popup function starts *************************************************  */
</script>
<div class="md-content" style="position:fixed;width:79%;left:15%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>View</strong> - <span style="font-size: 15px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
   $login="";$cancelkey='';
	 $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster  where rm_id='".$_SESSION['report_master_id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['rm_reportview'] =='Y')
				{$active='Yes';
				}
				else
				{
					$active='No';
				}
				 if($result_login['rm_printa4']=="Y")
				 {
					 $printa4='Yes';
				 }
				 else
				 {
					 $printa4='No'; 
				 }
				 if($result_login['rm_email']=="Y") {
					 $email='Yes';
				 }
				 else
				 {
				 $email='No';	 
				 }
				 
				 if($result_login['rm_dayclosemail']=="Y") {
					 $dayclosemail='Yes';
				 }
				 else
				 {
					  $dayclosemail='No';	 
				 }
				 
				  if($result_login['rm_daycloseprint']=="Y") {
					 $dayclosemail='Yes';
				 }
				 else
				 {
					  $dayclosemail='No';	 
				 }
			if($result_login['rm_daycloseprint']=="Y") {
				
				$daycloseprint='Yes';
			}
			else
			{
					$daycloseprint='No';
			}
				 
				 
				
			
	 ?>
                         <table class="geogrph_table staff_view_tbl" style="color:#000">
                              <tr class="first_form_contain">
                              <td><strong>Report ID :</strong></td>
                              <td><?= $result_login['rm_reportid']?> </td>
                                 <td><strong>Report Name :</strong> </td>
                              <td><?=$result_login['rm_reportname']?></td>
                              <td><strong>To Print :</strong></td>
                               	<td><?=$result_login['rm_posprintofanother']?>
                               </tr>
                                <tr class="first_form_contain">
                                    <td><strong>Active : </strong></td>
                               	<td><?=$active?></td>
                                
                            <td><strong>Print A4 :</strong> </td>
                               	<td><?=$printa4?></td>    
                                
                               <td><strong>Email :</strong> </td>
                               	<td><?=$email?></td>
                              </tr>
                              <tr class="first_form_contain">
                               <td><strong>Dayclose mail:</td>
                              <td><?=$dayclosemail?></td>
                           
                                 <td><strong>Dayclose print :</td>
                              <td><?=$daycloseprint?></td>
                               </tr>
                          
                               </table>    
                               
 <?php
// $cancelkey=$result_login['ser_cancelwithkey'];
  }} ?>

                     
                                            </div>

