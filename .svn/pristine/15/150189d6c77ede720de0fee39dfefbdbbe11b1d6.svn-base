<?php

$linkname	= trim(basename($_SERVER['PHP_SELF']));
$_SESSION['menuarray']=array();
$_SESSION['menumodarray']=array();
$_SESSION['menusubarray']=array();
$_SESSION['menufullarray']=array();

  $sql_login  =  $database->mysqlQuery("Select tbl_modulemaster.mer_modulename, tbl_modulesubmaster.mser_subname, tbl_modulemaster.mer_modulelink, "
        . " tbl_modulesubmaster.mser_submodulelink, tbl_usermodules.um_access,  tbl_usermodules.um_username From tbl_usermodules Inner Join "
        . " tbl_modulesubmaster On tbl_modulesubmaster.mser_submoduleid = tbl_usermodules.um_submoduleid Inner Join tbl_modulemaster On "
        . " tbl_modulemaster.mer_moduleid = tbl_usermodules.um_moduleid Where tbl_usermodules.um_username = '".$_SESSION['expodine_id']."' "
        . " order by   tbl_modulemaster.mer_modulename"); 
$num_login   = $database->mysqlNumRows($sql_login);
if($num_login)
{
  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	  {
		   $_SESSION['menuarray'][]=$result_login['mer_modulelink'];
		   $_SESSION['menumodarray'][]=$result_login['mer_modulename'];
		   $_SESSION['menusubarray'][]=$result_login['mser_submodulelink'];
		   if($result_login['mser_submodulelink']!="")
		   $_SESSION['menufullarray'][]=$result_login['mser_submodulelink'];
		   if($result_login['mer_modulelink']!="")
		   $_SESSION['menufullarray'][]=$result_login['mer_modulelink'];
	  }
}

?>
<!-- ********************  Basic data starts**********  -->

<?php if($_SESSION['pagid']==1) { ?>


<ul class="als-wrapper">
	
    <?php   if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?>   
    	<li class="als-item"><a href="kot_counter_master.php" class="new_tab_btn <?php if($linkname=="kot_counter_master.php"){ ?> active_btn_1 <?php } ?>">KOT Counter</a></li>
    <?php }  if(in_array("floor_master", $_SESSION['menusubarray'])) { ?>  
   	 	<li class="als-item"><a href="floor_master.php" class="new_tab_btn <?php if($linkname=="floor_master.php"){ ?> active_btn_1 <?php } ?>">Floor Master</a></li>
    <?php }  if(in_array("table_master", $_SESSION['menusubarray'])) { ?>       
    	<li class="als-item"><a href="table_master.php" class="new_tab_btn <?php if($linkname=="table_master.php"){ ?> active_btn_1 <?php } ?>">Table Master</a></li>
   <!--<?php /*?> <?php }  if(in_array("printer_master", $_SESSION['menusubarray'])) { ?> 
    	<li class="als-item"><a href="printer_master.php" class="new_tab_btn <?php if($linkname=="printer_master.php"){ ?> active_btn_1 <?php } ?>">Printer Master</a></li><?php */?>-->
    <?php } // if(in_array("printer_type_master", $_SESSION['menusubarray'])) { ?> 
    	<!--<li class="als-item"><a href="printer_type_master.php" class="new_tab_btn <?php if($linkname=="printer_type_master.php"){ ?> active_btn_1 <?php } ?>">Printer Type master</a></li>-->
    <?php // } 
	 if(in_array("branch_master", $_SESSION['menusubarray'])) { ?> 
        <li style="display:none" class="als-item"><a href="branch_master.php" class="new_tab_btn <?php if($linkname=="branch_master.php"){ ?> active_btn_1 <?php } ?>">Branch Master</a></li>
    <?php } if(in_array("report_master", $_SESSION['menusubarray'])) { ?> 
    	<li class="als-item"><a href="report_master.php" class="new_tab_btn <?php if($linkname=="report_master.php"){ ?> active_btn_1 <?php } ?>">Report Master</a></li>
   <?php /*?> <?php }?><?php */?>
    
    <?php } if(in_array("bank_master", $_SESSION['menusubarray'])) { ?> 
        <li style="display:none" class="als-item"><a href="bank_master.php" class="new_tab_btn <?php if($linkname=="bank_master.php"){ ?> active_btn_1 <?php } ?>">Bank Master</a></li>
    <?php }?>
    
         <?php  if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?> 
    	<li class="als-item"><a href="inv_kitchen.php" class="new_tab_btn <?php if($linkname=="inv_kitchen.php"){ ?> active_btn_1 <?php } ?>">INV - KITCHEN</a></li>
    <?php }?>
       
</ul>

<?php } ?> 

<!-- **********  Basic data ends*******************  -->


<!-- *************  Staff starts***************  -->


<?php if($_SESSION['pagid']==2) { ?> 

<ul class="als-wrapper">
 <?php   if(in_array("staff_master", $_SESSION['menusubarray'])) { ?>
		<li class="als-item"><a href="staff_master.php" class="new_tab_btn <?php if($linkname=="staff_master.php"){ ?> active_btn_1 <?php } ?>">Staff</a></li>
   
	 <?php } if(in_array("department_master", $_SESSION['menusubarray'])) { ?>     
		<li class="als-item"><a href="department_master.php" class="new_tab_btn <?php if($linkname=="department_master.php"){ ?> active_btn_1 <?php } ?>">Department</a></li>
     <?php }  if(in_array("designation_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="designation_master.php" class="new_tab_btn <?php if($linkname=="designation_master.php"){ ?> active_btn_1 <?php } ?>">Designation</a></li>
    <?php }?>
</ul>          
<?php } ?> 

<!-- ***************  Staff ends *******************  -->

<!-- ************  Discount starts*************************  -->


<?php if($_SESSION['pagid']==3) { ?> 

<ul class="als-wrapper">
	 <?php if(in_array("discount_master", $_SESSION['menusubarray'])) { ?>     
		<li class="als-item"><a href="discount_master.php" class="new_tab_btn <?php if($linkname=="discount_master.php"){ ?> active_btn_1 <?php } ?>">Discount</a></li>
     <?php }  if(in_array("corporate_discount", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="corporate_discount.php" class="new_tab_btn <?php if($linkname=="corporate_discount.php"){ ?> active_btn_1 <?php } ?>">Company</a></li>
     <?php }   ?>
<!--		<li class="als-item"><a href="voucher_master.php" class="new_tab_btn <?php //if($linkname=="voucher_master.php"){ ?> active_btn_1 <?php //} ?>">Voucher</a></li>-->
     <?php  if(in_array("coupon_company", $_SESSION['menusubarray'])) { ?>
		<li class="als-item"><a href="coupon_company.php" class="new_tab_btn <?php if($linkname=="coupon_company.php"){ ?> active_btn_1 <?php } ?>">Coupon</a></li>
     <?php } ?>
</ul>          

<?php } ?> 

<!-- ****************  Staff ends *********************  -->

<!-- **************  Feedback starts***********************  -->


<?php if($_SESSION['pagid']==4) { ?> 

<ul class="als-wrapper">
	 <?php if(in_array("Feedback", $_SESSION['menumodarray'])) { ?>     
		<li class="als-item"><a href="feedback.php" class="new_tab_btn <?php if($linkname=="feedback.php"){ ?> active_btn_1 <?php } ?>">Feedback</a></li>
     <?php }  if(in_array("feedback_rating", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="feedback_rating.php" class="new_tab_btn <?php if($linkname=="feedback_rating.php"){ ?> active_btn_1 <?php } ?>">Rating</a></li>
     <?php }  ?>
</ul>          
<?php } ?> 

<!-- ***************  Feedback ends *******************  -->

<!-- ***************  Geographical starts**************  -->



<?php if($_SESSION['pagid']==5) { ?> 
<ul class="als-wrapper">
	 <?php if(in_array("country_master", $_SESSION['menusubarray'])) { ?>     
		<li class="als-item"><a href="country_master.php" class="new_tab_btn <?php if($linkname=="country_master.php"){ ?> active_btn_1 <?php } ?>">Country</a></li>
     <?php }  if(in_array("state_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="state_master.php" class="new_tab_btn <?php if($linkname=="state_master.php"){ ?> active_btn_1 <?php } ?>">State</a></li>
     <?php }  if(in_array("city_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="city_master.php" class="new_tab_btn <?php if($linkname=="city_master.php"){ ?> active_btn_1 <?php } ?>">City</a></li>
     <?php }  ?>
</ul>          
<?php } ?> 

<!-- **************  Geographical ends **************  -->

<!-- **************  Menu masters starts**********  -->

<?php if($_SESSION['pagid']==6) { ?> 

<ul class="als-wrapper">
 <?php  if(in_array("menu", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="menu.php" class="new_tab_btn <?php if($linkname=="menu.php"){ ?> active_btn_1 <?php } ?>">ITEM</a></li>
     <?php } if(in_array("combo", $_SESSION['menusubarray'])) { ?>            
    <li class="als-item"><a href="combo.php" class="new_tab_btn <?php if($linkname=="combo.php" ||$linkname=="combo-add.php" ||$linkname=="combo_stock.php"){ ?> active_btn_1 <?php } ?>">COMBO</a></li>
	 <?php } if(in_array("category_master", $_SESSION['menusubarray'])) { ?>     
		<li class="als-item"><a href="category_master.php" class="new_tab_btn <?php if($linkname=="category_master.php"){ ?> active_btn_1 <?php } ?>">MAIN CATEGORY</a></li>
     <?php }  if(in_array("sub_category_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="sub_category_master.php" class="new_tab_btn <?php if($linkname=="sub_category_master.php"){ ?> active_btn_1 <?php } ?>">SUB CATEGORY</a></li>
     <?php }  if(in_array("portion_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="portion_master.php" class="new_tab_btn <?php if($linkname=="portion_master.php"){ ?> active_btn_1 <?php } ?>">PORTIONS</a></li>
     <?php }  if(in_array("ingredient_master", $_SESSION['menusubarray'])) { ?> 
                <li style="display:none !important" class="als-item"><a href="ingredient_master.php" class="new_tab_btn <?php if($linkname=="ingredient_master.php"){ ?> active_btn_1 <?php } ?>">INGREDIENT</a></li>
     <?php }  if(in_array("preference_master", $_SESSION['menusubarray'])) { ?> 
		<li class="als-item"><a href="preference_master.php" class="new_tab_btn <?php if($linkname=="preference_master.php"){ ?> active_btn_1 <?php } ?>">PREFERENCES</a></li>
    
     <?php  } ?>
    
       
     <?php   if(in_array("unit_master", $_SESSION['menusubarray'])) { ?>   
     <li class="als-item"><a href="unit_master.php" class="new_tab_btn <?php if($linkname=="unit_master.php" || $linkname=="base_unit_master.php" ){ ?> active_btn_1 <?php } ?>">UNIT MASTERS</a></li>
     <?php }   if(in_array("base_unit_master", $_SESSION['menusubarray'])) { ?>
     <li style="display:none !important"  class="als-item"><a href="base_unit_master.php" class="new_tab_btn <?php if($linkname=="base_unit_master.php"){ ?> active_btn_1 <?php } ?>">BASE UNIT MASTER</a></li>
     <?php } ?>
    
     
     <?php if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?>
     
     <li class="als-item"><a href="kot_counter_master.php" class="new_tab_btn <?php if($linkname=="kot_counter_master.php"){ ?> active_btn_1 <?php } ?>">KOT COUNTER</a></li> 
    
     <?php } ?>
     
     
     
     
     
     <?php if($_SESSION['expodine_id']=='admin'){ ?>
     <li class="als-item"><a href="banner_image_upload.php?lock=cloud" class="new_tab_btn <?php if($linkname=="banner_image_upload.php"){ ?> active_btn_1 <?php } ?>">CLOUD SETTINGS</a></li> 
    
     <?php } ?> 
     
     
      <?php if($_SESSION['expodine_id']=='admin'){ ?>
     
     <li class="als-item"><a style="pointer-events: none " href="item_config.php" class="new_tab_btn <?php if($linkname=="item_config.php"){ ?> active_btn_1 <?php } ?>">ITEM CONFIG</a></li> 
    
     <?php } ?> 
     
</ul>  

<?php } ?> 

<!-- ***************  Menu masters ends ****************  -->

<!-- *************** Printer masters starts***************-->

<?php if($_SESSION['pagid']==8) { ?> 

<ul class="als-wrapper">
 <?php  if(in_array("printer_master", $_SESSION['menusubarray'])) { ?>     
		<li class="als-item"><a href="printer_master.php" class="new_tab_btn <?php if($linkname=="printer_master.php"){ ?> active_btn_1 <?php } ?>">Printer Master</a></li>
     <?php } if(in_array("printer_type_master", $_SESSION['menusubarray'])) { ?> 
    	<li class="als-item"><a href="printer_type_master.php" class="new_tab_btn <?php if($linkname=="printer_type_master.php"){ ?> active_btn_1 <?php } ?>">Printer Type</a></li>
    <?php }   ?>
        
  <li class="als-item"><a href="load_printerstatus.php?value=full_load" class="new_tab_btn">Printer Status</a></li>
     
        &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
      <strong class="load_error_del" style="color:red;font-size: 20px;float: right;margin: 10px 10px 0 0" ></strong>  
     
</ul>     

<?php } ?> 

<!-- ***************  printer masters ends **************-->

