<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['staffid']=$_REQUEST['staff'];
$sql_login  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid='".$_SESSION['staffid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ser_firstname'];
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
<style>
.mynewpopupload{left:0 !important;position: absolute !important;}
</style>

<div class="md-content" style="position:absolute;width:640px;left:15%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>View</strong> - <span style="font-size: 15px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
   $login="";$cancelkey=''; $code='';
	 $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster left JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid  "
                 . "left join tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid "
                 . "left join tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid "
                 . " WHERE ser_staffid='".$_SESSION['staffid']."'"); 
	 //echo "select * from tbl_staffmaster left JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid left join tbl_city ON tbl_staffmaster.ser_city= tbl_city.cy_cityid left join tbl_country ON tbl_staffmaster.ser_country=tbl_country.cy_countyid left join tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid left join tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid left join tbl_state ON tbl_staffmaster.ser_state= tbl_state.se_stateid WHERE ser_staffid='".$_SESSION['staffid']."'"; 
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
					
				$code=$result_login['ser_authorisation_code'];
				$login=$result_login['dr_login'];
	 ?>
     
     					<div class=" content hideContent">
                         <table class="geogrph_table staff_view_tbl" style="color:#000">
                               <tr class="first_form_contain">
                               <td width="12%"><strong>First Name :</strong></td>
                               <td width="15%"><span class="menu_view_pop_lable"><?= $result_login['ser_firstname']?></span></td>
                               <td width="12%"><strong>Last Name :</strong> </td>
                               <td width="15%"><span class="menu_view_pop_lable"><?=$result_login['ser_lastname']?></span></td>
                           </tr>
                           <tr class="first_form_contain">
                              	<td width="12%"><strong>Gender :</strong></td>
                               	<td width="15%"><span class="menu_view_pop_lable"><?=$result_login['ser_gender']?></span>
                                 <td><strong>Department : </strong></td>
                                 <td><span class="menu_view_pop_lable"><?=$result_login['der_departmentname']?></span></td>
                              </tr>   
                              <tr class="first_form_contain">
                                <td><strong>Designation :</strong> </td>
                      			<td><span class="menu_view_pop_lable"><?=$result_login['dr_designationname']?></span></td>
                                 <input type="hidden" name="hidloginstatus" id="hidloginstatus" >
                                  <td><strong>Employee Status :</strong></td>
                               	 <td><span class="menu_view_pop_lable"><?= $result_login['ser_employeestatus']?></span></td>
                           
                           </tr>
                           		
                           <tr class="first_form_contain">
                           		
                                 <?php if ($result_login['ser_mode'] =='B')
							   {?>
                               	<td><strong>Branch :</strong></td>
								    <td><span class="menu_view_pop_lable"><?=$result_login['be_branchname']?></span></td> 
							 <?php  }
							 else
							 {?>
							 <td><strong>Head office :</strong></td>
							 <td><span class="menu_view_pop_lable"><?=$result_login['he_officename']?></span></td>
                             
                             
                             <?php }
							   
							  ?>
                              <td><strong>Floor :</strong></td>
								<?php 
                                $floor='';
                                if(!is_null($result_login['ser_defaultfloor'])){
                                    
                                    $flrnm=$database->show_floor_ful_details($result_login['ser_defaultfloor']);
                                    $floor=$flrnm['fr_floorname'];
                                }
                                
                                 ?>
                                <td><span class="menu_view_pop_lable"><?=$floor?></span></td>
                                
                           </tr>
                           
                           <tr class="first_form_contain">
                               <td><strong>Mobile No :</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['ser_mobileno']?></span></td>
                               <td><strong>Alternate No :</strong></td>
                              <td><span class="menu_view_pop_lable"><?=$result_login['ser_alternateno']?></span></td>
                           </tr>
                           <tr class="first_form_contain">       
                               <td><strong>Address1 :</strong></td>       
                               <td><span class="menu_view_pop_lable"><?=$result_login['ser_address1']?></span></td> 
                               <td><strong>Address2 :</strong></td>
                              	<td><span class="menu_view_pop_lable"><?=$result_login['ser_address2']?></span></td>
                           </tr>
                           <tr class="first_form_contain">     
                              	<td><strong>ID No :</strong></td>
                                 <td><span class="menu_view_pop_lable"><?=$result_login['ser_idno']?></span></td>
                                 <td><strong>ID Type :</strong></td>
                            	<td><span class="menu_view_pop_lable"><?=$result_login['ser_idtype']?></span></td>
                           </tr>
                            <tr class="first_form_contain">  
                               <td><strong>Email :</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['ser_email']?></span></td>
                               <td><strong>Date Of Birth :</strong></td>       
                               <td><span class="menu_view_pop_lable"><?=$result_login['ser_dob']?></span></td> 
                           </tr>
                           <tr class="first_form_contain">       
                               <td><strong>Date Of Join :</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['ser_dateofjoin']?></span></td>
                               <td><strong>Remarks : </strong></td>
                              	<td><span class="menu_view_pop_lable"><?=$result_login['ser_remarks']?></span></td> 
                            </tr>
                           
                           
                           
                               </table>  
                               </div> 
                               
                               <div class="show-more">
                                    <a style="color:#0087f3;float: right;margin-right:5px;font-size:15px;" href="#">Show more</a>
                                </div> 
                               
 <?php
 $cancelkey=$result_login['ser_cancelwithkey'];
  }} ?>
 <?php 
 if ($login=='Yes'){ ?>
   
                                <div>
  <strong style="color:#000;width:100%;height:30px;float:left;background-color:#333;color:#fff;line-height:30px;font-family: 'yu_gothicregular';">Login Details</strong>
                 <?php      
				 $sql  =  $database->mysqlQuery("select * FROM tbl_logindetails WHERE ls_staffid='".$_REQUEST['staff']."'"); 
	  $num  = $database->mysqlNumRows($sql);
	  if($num){
		  while($result_user  = $database->mysqlFetchArray($sql)) 
			{
	 ?>
                     <table class="geogrph_table staff_view_tbl" style="color:#000">
                     <tr class="first_form_contain" style="color:#000">
                            <td style="width: 12%;"><strong>User Name :</strong></td>
                             <td style=" width: 15%;"><span class="menu_view_pop_lable"><?=$result_user['ls_username']?></span></td>
                              <td style=" width: 15%;"><span class="menu_view_pop_lable"><?=$code?></span></td>
<!--                           	<td style="width: 12%;"><strong>App Login :</strong></td>
                               <td style="width: 15%;"><span class="menu_view_pop_lable"><?=$result_user['ls_applogin']?></span></td>-->
<!--                             	<td style="width:12%"><strong>Cancel with Key :</strong></td>
                                <td style="width:15%"><span class="menu_view_pop_lable"><?=$cancelkey?></span></td>-->
                               </tr>  
                       </table>
                       <?php }} ?>
                       </div>
                       <?php } ?> 
                     
                                            </div>


<script type="text/javascript">
$(".show-more a").on("click", function() {
    var $this = $(this); 
    var $content = $this.parent().prev("div.content");
    var linkText = $this.text().toUpperCase();    
    
    if(linkText === "SHOW MORE"){
        linkText = "Show less";
        $content.switchClass("hideContent", "showContent", 400);
    } else {
        linkText = "Show more";
        $content.switchClass("showContent", "hideContent", 400);
    };

    $this.text(linkText);
});
</script>