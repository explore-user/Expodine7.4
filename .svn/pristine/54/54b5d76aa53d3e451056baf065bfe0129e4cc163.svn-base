<?php
include('../includes/session.php');		// Check session
//session_start();
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['menuidselect']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mr_menuname'];
	  }			
} 
else
{
  $searchname="";
}

?>
<script>

</script>
<div class="md-content" style="position:fixed;width:760px;left:20%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>View</strong> - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
<a href="#"><button class="md-close_pop" onclick="return popupclose()">x</button></a>
 
<?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid WHERE  tbl_menumaster.mr_menuid='".$_REQUEST['menu']."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				if($result_login['mr_dailystock']=="Y")
				{
					$stock="Yes";
				}else 
				{
					$stock="No";
				}	
					if($result_login['mr_manualrateentry']=="Y")
				{
					$dynamic="Yes";
				}else 
				{
					$dynamic="No";
				}	
				if($result_login['mr_dailystock_in_number']=="Y")
				{
					$stknms="Yes";
				}else 
				{
					$stknms="No";
				}	
				if($result_login['mr_show_in_kod']=="Y")
				{
				
					$activekod="Yes";
				}else 
				{
					$activekod="No";
				}
                                if($result_login['mr_excempt_tax']=="Y")
				{
				
					$excempt="Yes";
				}else 
				{
					$excempt="No";
				}
				
				
				$sql_kot  =  $database->show_kotcounter_ful($result_login['mr_kotcounter']);
				$catname  =  $database->show_category_view_details($result_login['mr_maincatid']);
				$subname  =  $database->show_subcategory_view_details($result_login['mr_subcatid']);
	 ?>                                             
     
         
			<div class="md-content">
				
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    	
                         <table class="popup_add_table menu_view_tbl" width="100%" border="0" cellspacing="5">
                         	<tr>
                                <td width="20%"><strong>Short Code</strong></td>
                                <td width="30%"><span class="menu_view_pop_lable"><?=$result_login['mr_itemshortcode']?></span></td>
                                <td width="20%"><strong>Kitchen</strong></td>
                                <td width="30%"><span class="menu_view_pop_lable"><?=$sql_kot['kr_kotname'];?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Main Category</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$catname['mmy_maincategoryname']?></span></td>
                               <td><strong>Sub Category</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$subname['msy_subcategoryname']?></span></td>
                            </tr>
                            <tr>
                               <td><strong>Diet</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['mr_diet']?></span></td>
                               <td><strong>Estimated Time(minutes)</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['mr_time_min']?></span></td> 
                             </tr>
                             <tr>
                             	<td><strong>Preparation Mode</strong></td>
                                <td><span class="menu_view_pop_lable"><?=$result_login['mr_prepmode']?></span></td>
                             	<td colspan="2"><strong style="padding-left:0" class="">Active</strong><span class="menu_pop_check_box" style="position:relative;top:0px;margin-top: 10px"><?=$active?></span></
                               <strong class=""><strong>Stock</strong></strong><span style="position:relative;top:0px;margin-top: 10px" class="menu_pop_check_box"><?=$stock?></span>
                               <strong class="">Dynamic rate</strong><span style="position:relative;top:0px;margin-top: 12px" class="menu_pop_check_box"><?=$dynamic?></span>
                                <strong class="">Show in Kod</strong><span style="position:relative;top:0px;margin-top: 12px" class="menu_pop_check_box"><?=$activekod?></span>
                                <strong class="">Tax Excempt</strong><span style="position:relative;top:0px;margin-top: 12px" class="menu_pop_check_box"><?=$excempt?></span></td>
                             </tr>
                             
                             <tr>
                               <td><strong>Stock in No's</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$stknms?></span></td>
                               <td><strong>Item code</strong></td>
                               <td><span class="menu_view_pop_lable"><?=$result_login['mr_itemcode']?></span></td> 
                             </tr>
                             
                            </table>
                         <table class="popup_add_table menu_view_tbl" width="100%" border="0" cellspacing="5"> 
                          
                              <tr>
                             <td style="width:19%"><strong>Description</strong></td>
                             <td><span style="height: auto;width:100%; line-height: 23px;padding-right:3px;min-height:30px;" class="menu_view_pop_lable"><?=$result_login['mr_description']?></span></td>
                             
                             </tr>
                            </table>
                           
                             </div>
                             
                            
                             </div>
			</div>
            <?php } } ?>  
            </div>  
<script>
          
/*************************************** Popup function starts *************************************************  */           
function popupclose() {  	//alert('1');
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
	};
/***************************************  Popup function starts *************************************************  */

</script>