<?php //session_start();
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include("database_inv.class.php"); 
$database_inv	= new Database_inv();

if(!isset($_SESSION['upload_id']))
{
$_SESSION['upload_id'] = $database->getEpoch();
}

$upload_id		= $_SESSION['upload_id'];
define ("MAXWIDTH","361");  
define ("MAXHEIGHT","125"); 
function make_thumb($img_name,$filename,$new_w,$new_h)
 {
 	//get image extension.
 	$ext=getExtension($img_name);
 	//creates the new image using the appropriate function from gd library
 	if(!strcasecmp("jpg",$ext) || !strcasecmp("jpeg",$ext))
 		$src_img=imagecreatefromjpeg($img_name);
  	if(!strcasecmp("png",$ext))
 		$src_img=imagecreatefrompng($img_name);
	if(!strcasecmp("gif",$ext))
 		$src_img=imagecreatefromgif($img_name);
 	 	//gets the dimmensions of the image
 	$old_x=imageSX($src_img);
 	$old_y=imageSY($src_img);

//thumb create using specific width and height starts here 
$thumb_w=$new_w;
$thumb_h=$new_h;
//thumb create using specific width and height ends here 
	// we create a new image with the new dimmensions
 	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	// resize the big image to the new created one
 	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
 	// output the created image to the file. Now we will have the thumbnail into the file named by $filename
 	if(!strcmp("png",$ext))
 		imagepng($dst_img,$filename); 
	else if(!strcmp("gif",$ext))
 		imagegif($dst_img,$filename); 
 	else
 		imagejpeg($dst_img,$filename); 
  	//destroys source and destination images. 
 	imagedestroy($dst_img); 
 	imagedestroy($src_img); 
 }

 // This function reads the extension of the file. 
 // It is used to determine if the file is an image by checking the extension. 
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Recipe</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <link href="css/custom.css" rel="stylesheet">

 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
	.responstable th, .responstable td{padding: 0.3em !important;} 
	.filte_new_text{overflow:hidden}
	.menu_top_filter_left{border:0;margin:0}
	.filte_new_text{text-align:left}

</style>

<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
       <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE --> 	    
 <script type="text/javascript" >
	

	</script>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Food & Recipe </a></li>
				</ul>
                <div class="rate_showing_text">ALL RATES SHOWN ARE IN LOCAL CURRENCY</div>
			</div><!-- breadcrumbs -->
                <div style="padding:0px;" class="content-sec">
                
                	<div style="padding:0px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main_cc">

					
                        
                        <div class="food_recipe_content_cc" style="min-height:650px;">
                        
                        	<div class="food_menuname_select_cc">
                                <div class="food_menu_select_textbox_cc">
                                    <input type="text" name="menuname" id="menuname" class="food_menu_select" placeholder="Select Menu" readonly>
                                    <div class="food_menu_view_btn"><a class="md-trigger" data-modal="modal-17" href="#"><img src="img/search_ico.jpg"></a></div>
                                   
                                    <input type="hidden" name="menuidselected" id="menuidselected" >
                                </div>
                                 <span id="errortotally" style="float: right;color: #F00;padding-top: 8px;padding-right: 42px;   font-weight: bold;font-size: 16px;"> </span>
                        	</div><!--menuname_select_cc-->
                        
                        	<div class="food_top_tab_menu_cc">
                            	<div class="food_tab_btn food_tab_act" id="recipeingredient"><a href="#">Recipe & Ingredients</a></div>
                                <div class="food_tab_btn" id="recipemaking"><a href="#">Recipe Making</a></div>
                                <div class="food_tab_btn" id="imagegalley"><a href="#">Menu Image Gallery</a></div>
                                
                            </div>
                       <!--  ***************** Starts receipe $ ingreidients********************************** -->   
                       <div id="viewrecipeingredient" > 
                        <div class="food_top_calculation_cc" >
                        
                        	<div class="col-lg-4 col-md-4 col-sm-12 no-padding food_calcul_cc projectcaltotal">
                            	<div class="food_calc_in_cc">
                                	<div class="food_project_calc_head">Project Calculator</div>
                                    <div class="food_box_full_cc">
                                    	<div style="width:30%" class="food_calc_textbx_div">
                                        	<span>Sell PP</span>
                                           <span> <input name="sell" type="text" class="food_calc_text" placeholder="Sell"> %</span>
                                        </div>
                                        <div style="width:68%" class="food_calc_textbx_div">
                                        	<span>Orginal Cost-(CP)</span>
                                           <span  style="width: 100%;"> <input name="pc_cost" id="pc_cost"  style="width: 100%;" type="text" class="food_calc_text" placeholder="Cost"  readonly></span>
                                        </div>
                                    </div><!---food_box_full_cc--->
                                     <div style="border:0;    margin-bottom: 0;" class="food_box_full_cc">
                                     	<div style="width:40%" class="food_calc_textbx_div">Cost based on sel PP</div>
                                        <div style="width:35%" class="food_calc_textbx_div"> <input name="based" style="width: 100%;" type="text" class="food_calc_text" placeholder="Cost Based PP" readonly></div>
                                        <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">SET</a></div>
                                     </div><!---food_box_full_cc--->
                                </div><!--food_calc_in_cc-->
                            </div><!--food_calcul_cc-->
                            <div class="col-lg-4 col-md-4 col-sm-12 no-padding food_calcul_cc servingcoutset">
                            	<div class="food_calc_in_cc">
                                	<div class="food_project_calc_head">Serving Count & Calculator</div>
                                     <div style="margin-top:5px;margin-bottom: 0;border: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                                     	<div style="width:25%" class="food_calc_textbx_div">Serving</div>
                                        <div style="width:45%" class="food_calc_textbx_div"> <input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Serving"></div>
                                    	<div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">SET</a></div>
                                     </div><!---food_box_full_cc--->
                                     <div class="food_box_full_cc food_sec_cal_head">Export</div>
                                     <div style="margin-top:3px;border:0;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                                     	<!--<div style="width:25%" class="food_calc_textbx_div">New Serving</div>-->
                                        <div style="width:45%" class="food_calc_textbx_div"> <input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Export"></div>
                                    	<div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">PDF</a></div>
                                        <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">Excel</a></div>
                                     </div><!---food_box_full_cc--->
                                </div>
                            </div><!--food_calcul_cc-->
                            <div class="col-lg-4 col-md-4 col-sm-12 no-padding food_calcul_cc totalcostloading">
                            	<div class="food_calc_in_cc">
                                	<div class="food_project_calc_head">Total</div>
                                      <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                                     	<div style="width:55%" class="food_calc_textbx_div">Total Cost</div>
                                        <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Total Cost" readonly></div>
                                       </div><!---food_box_full_cc--->
                                       <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                                     	<div style="width:55%" class="food_calc_textbx_div">Wastage Cost</div>
                                        <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Wastage Cost" readonly></div>
                                       </div><!---food_box_full_cc--->
                                       <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;border:0" class="food_box_full_cc">
                                     	<div style="width:55%" class="food_calc_textbx_div">Final Cost</div>
                                        <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Final Cost" readonly></div>
                                       </div><!---food_box_full_cc--->
                                    
                                </div>
                            </div><!--food_calcul_cc-->
                            
                        </div><!---food_top_calculation_cc--->
                       <div id="addingredientswholediv" style="display:block">
                        <div class="food_incrient_add_contain">
                            <span>Add Ingredients</span>
                        </div><!---food_incrient_add_contain--->
                        
                        <div class="food_incrient_add_form_cc">
                        	<div class="incread_disable checkenable"></div>
                        	<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:23.5%">
                            <span class="filte_new_text">Item</span>
                               <div style="margin:0;width:100%" class="food_menu_select_textbox_cc">
                                    <input type="text" name="ingname" id="ingname" class="food_menu_select" placeholder="Select Ingredient" style="width: 78%;" readonly>
                                    <input type="hidden" name="ingidselected" id="ingidselected" >
                                    <div style="width: 20%;" class="food_menu_view_btn"><a class="md-trigger" data-modal="modal-18" href="#"><img src="img/search_ico.jpg"></a></div>
                                </div>
                            </div><!---col-sm-2--->
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">QTY</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="QTY" name="qtyingr" id="qtyingr">
                            </div><!---col-sm-2--->
                              <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Unit</span>
                            <div id="listunitcost">
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Unit" name="uniting" id="uniting" disabled >
                                     <option value="null" default>Select Unit</option>
                                 <?php
									 $sql_login  =  $database_inv->mysqlQuery("select * from inv_tbl_unitmaster"); 
									  $num_login   = $database_inv->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database_inv->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['um_id']?>"><?=$result_login['um_name']?></option>
                               <?php } } ?>	
                                </select>
                                </div>
                            </div><!---col-sm-2--->
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Unit Cost</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="Unit Cost" name="unitcost" id="unitcost" readonly>
                            </div><!---col-sm-2--->
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Total Cost</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="Cost" name="costingr" id="costingr" readonly>
                            </div><!---col-sm-2--->
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Wastage %</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="Wastage %" name="wastingr" id="wastingr">
                            </div><!---col-sm-2--->
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                            <span class="filte_new_text">Wastage Cost</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="Wastage Cost" name="wastcostingr" id="wastcostingr" readonly>
                            </div><!---col-sm-2--->
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Total</span>
                                <input type="text" class="form-control food_increant_txtbox"  placeholder="Total" name="totalcostingr" id="totalcostingr" readonly>
                            </div><!---col-sm-2--->
                            
                             <div class="col-sm-2" style="width: 4%;margin-top: 20px;padding:0">
                             	<div class="food_incread_add_ico"><a href="#" id="submitingrvalues">+</a></div>
                             </div><!---col-sm-2--->
                        </div><!--food_incrient_add_form_cc-->
                        </div>  <!-- add ends-->
                        
                        
                        
                        
                        <div id="editingredientswholediv" style="display:none">
                      
                        </div><!--edit ends-->
                        
                       
                        <div class="food_increant_table_container">
                     <table class="responstable tablesorter">
                        <thead>
                         	 <tr>
                                <th width="5%" class="header">Delete</th>
                                <th width="5%" class="header">Edit</th>
                                <th width="20%" class="header">Item</th>
       							<th width="10%" class="header">Unit</th>
                                <th width="10%" class="header">Unit Cost</th>
                                 <th width="10%" class="header">Total Cost</th>
                                 <th width="10%" class="header">Wastage%</th>
                                 <th width="10%" class="header">Wastage Cost</th>
                                 <th width="10%" class="header">Total Cost</th>
                              </tr>
                            </thead>
                        <tbody style="min-height:250px;height:39vh;">
                         <?php
						 //`fc_recipe_details`(`fc_menuid`, `fc_slno`, `fc_ingredientid`, `fc_ing_unit`, `fc_ing_unitcost`, `fc_ing_totalcost`, `fc_wastage_percentage`, `fc_wastage_cost`, `fc_totalcost`) 
						 // `tbl_menumaster`(`mr_menuid`, `mr_menuname`, `mr_maincatid`, `mr_subcatid`, `mr_description`, `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`, `mr_rating`, `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`)
						 //`inv_tbl_productmaster`(`prm_productid`, `prm_productname`, `prm_productcat`, `prm_productdsubcat`, `prm_productdbrand`, `prm_productdunit`, `prm_productdminstock`, `prm_productdmaxstock`, `prm_productdredorderlevel`, `prm_productrate`, `prm_branchid`, `prm_active`, `prm_ratemodifieddate`)
						  //`inv_tbl_unitmaster`(`um_id`, `um_name`, `um_symbol`) 
					  /* $sql_login  =  $database->mysqlQuery("select * from fc_recipe_details fd LEFT JOIN tbl_menumaster as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN inv_tbl_productmaster as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN inv_tbl_unitmaster as um ON fd.fc_ing_unit=um.um_id"); 
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
							while($result_login  = $database->mysqlFetchArray($sql_login)) 
							  {*/
							  ?>
                          <!-- <tr>
                              <td width="5%"><a class="tab_edt_btn md-trigger_edit food_item_del"><i class="fa fa-trash"></i></a></td>
                              <td width="5%"><a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a></td>
                              <td width="20%"><?=$result_login['prm_productname']?></td>
                              <td width="10%"><?=$result_login['um_name']?></td>
                              <td width="10%"><?=$result_login['fc_ing_unitcost']?></td>
                              <td width="10%"><?=$result_login['fc_ing_totalcost']?></td>
                              <td width="10%"><?=$result_login['fc_wastage_percentage']?>%</td>
                             <td width="10%"><?=$result_login['fc_wastage_cost']?></td>
                             <td width="10%"><?=$result_login['fc_totalcost']?></td>
                          </tr>  -->
                      <?php //} } ?>                          
                      </tbody>
                      </table>
                        </div><!---food_increant_table_container--->
                   
                   
                   </div> <!--  ***************** Ends receipe $ ingreidients********************************** --> 
                   
                   <!--  ***************** starts receipe making********************************** --> 
                    <div class="food_top_calculation_cc" id="viewrecipemaking">
                    
                   <div class="prepration_cc"> 
                   	 <div class="food_recipie_2ndtab_container">
                       <div class="preparation_text"><span>Preparation Method..</span></div>
                        <span id="loadprepmeth">
                        	<textarea class="preparation_textarea" rows="17" cols="90" name="prepmethod" id="prepmethod"></textarea>
                        </span>
                       </div> 
                    </div>
                    
                    <div style="width:180px;" class="food_calc_textbx_div food_save_btn"><a class="food_set_btn savepreparationmethod" href="#">Save</a></div>
                    </div>
                    <!--  ***************** ends receipe making********************************** --> 
                    
                    <!--  ***************** starts image gallery********************************** --> 
                     <div class="food_top_calculation_cc" id="viewimagegallery">
                     <div class="food_calc_textbx_div food_add_image_btn">
                        <!--<input name="" class="food_img_uploder" type="file">-->
                        <a style="position:relative;width:300px !important;padding-left:2% !important;padding-right:2% !important;background-size: 36px !important;height: 45px;background-position: 5% 50% !important;line-height:25px !important;margin-left:1%;background-color: #f5f5f5 !important;" id="me" class="styleall food_set_btn ">
                        Add image</a>
                        <!--<span style="position:relative;" id="me" class="styleall food_set_btn">Upload Image</span> -->
                        <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span> 
                        <input type="hidden" name="upload_id" id="upload_id" value="<?=$_SESSION['upload_id']?>" />  
                     	<!--food_set_btn-->
                        </br></br>
                        <div>
                       <!-- <img src="img/416_1zinc.jpg" width="100" height="100" >-->
                        </div>
                     </div>
                     
                     
                     
                       	<div class="food_image_view_cc" id="loadfullimages">  
                        
                           <!--<div class="food_image_thumb">
                               <div class="food_cost_image"><img src="img/416_1zinc.jpg" width="100" height="100" ></div>
                               <a class="food_image_delete"></a>
                           </div>-->
                          
                           
                       	</div><!--food_image_view_cc-->
                     </div>
                     <!--  ***************** ends image gallery********************************** --> 
                   
                       
                   </div><!--food_recipe_content_cc---> 
                       
               	    </div><!--main_cc-->
                 
		</div><!---content-sec--->
	</div><!--#container-->
</div><!---view-container--->
</div><!--mian-->
</div><!---container nopaddding--->

<!--  ***************************************** menu load starts  ************************************************ -->
<div style="width:70%;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3 style="background: #fff;color: #000;opacity:1">
                <div class="popup_foodcost_error_contain"><span style="float:left; color:#F00;display:none" class="loaderrormenu"></span></div>
                Select Menu Item
            <a  href="#"><button class="md-close food_pop_close_btn"><img src="img/close_ico.png"></button></a>
            <a  href="#" class="selectmenuitemcheck"><button class="md-save food_pop_close_btn"><img src="img/check_mark-wht.png"></button></a>
                </h3>
				<div style="padding:0px;">
                <div style="width:100%;" class="menu_top_filter_left">
                         <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                    	<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px">
                        	<span class="filte_new_text">Menu Name</span>
							<input type="text" class="form-control add_text_box" name="mname" id="mname" placeholder="Menu Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
						</div>
						<div class="col-sm-2" style="padding-right: 0px;padding-left:0px;margin-bottom:5px">
                       		   <span class="filte_new_text">Category</span><!--mcate msubc mdiet-->
                              <select class="add_text_box" name="mcate" id="mcate" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                                   <option value="null" default>Select Category</option>
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(mmy_maincategoryname) from tbl_menumaincategory"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['mmy_maincategoryname']?>"><?=$result_login['mmy_maincategoryname']?></option>
                               <?php } } ?>	
                                <option value="null" default>All</option>
                                </select>
						</div>
                        <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                                 <span class="filte_new_text">Sub Category</span>
                                 <select class="add_text_box" name="msubc" id="msubc" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                                 <option value="null" default="">Select Sub Category</option>
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(msy_subcategoryname) from tbl_menusubcategory"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['msy_subcategoryname']?>"><?=$result_login['msy_subcategoryname']?></option>
                               <?php } } ?>	
                                <option value="null" default>All</option>
                                </select>
						</div>
					
                   <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                         <span class="filte_new_text">Diet</span>
                         <select class="add_text_box" name="mdiet" id="mdiet" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                                <option value="null">Select Diet</option>
                                <option value="General">General</option>
                                <option value="Veg">Veg</option>
                                <option value="Non-Veg">Non-Veg</option>
                                 <option value="null">All</option>	
                                </select>
						</div>
                       <!-- <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                        	<span class="filte_new_text">Status</span>
                            <select class="add_text_box">
                                <option value="null">Select Active Status</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                 <option value="null">All</option>	
                                </select>
						</div>-->
                        
                        <div class="col-sm-2 nopadding">
							<div style="margin-left:2%;margin-top:21px;" class="search_btn_member_invoice"><a href="#" onClick="reloadall()">Reload</a></div>
						</div>
					</div><!--form_group-->
                    	
                    </div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    <div id="listmenuitems" >
                    <table class="responstable tablesorter" id="listmenuitems">
                        <thead>
                          <tr>
                                <th class="header">Sl No</th>
                                <th class="header">Menu</th>
       							 <th class="header">Main Category</th>
                                  <th class="header">Sub Category</th>
                                 <th class="header">Diet</th>
                              </tr>
                                  </thead>
                          <tbody>
                          
                          <!--<tr class="food_table_active">-->
                          <?php
						  $sql_table_sels  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid"); 
						  $num_table  = $database->mysqlNumRows($sql_table_sels);
						  if($num_table){$i=1;
								while($result_table_sel  = $database->mysqlFetchArray($sql_table_sels)) 
									{
						  ?>
                          
                        	<tr id="ids_<?=$result_table_sel['mr_menuid']?>" name="<?=$result_table_sel['mr_menuname']?>" class="clicktoselect">
                              <td><?=$i++;?></td>
                                <td><?=$result_table_sel['mr_menuname']?></td>
                                <td><?=$result_table_sel['mmy_maincategoryname']?></td>
                                <td><?=$result_table_sel['msy_subcategoryname']?></td>
                                <td><?=$result_table_sel['mr_diet']?></td>
                              </tr>
                              
                              <?php } }?>
                            
                          
                                       </tbody>
                                                </table>
                                                </div>
                               
                    </div><!----div--->
                     
				</div>
                </div>
		</div>
  <!--  ***************************************** menu load ends  ************************************************ -->  
  
  
  
   <!--  ***************************************** Ingredient load starts  ************************************************ --> 
    <div style="width:70%;" class="md-modal md-effect-16" id="modal-18">
			<div class="md-content">
				<h3 style="background: #fff;color: #000;opacity:1">
               <div class="popup_foodcost_error_contain"> <span style="float:left; color:#F00;display:none;font-size:17px; font-weight:bold;" class="loaderrormenu_ing"></span></div>
                Select Item
            <a  href="#"><button class="md-close food_pop_close_btn"><img src="img/close_ico.png"></button></a>
            <a  href="#" class="selectitemname"><button class="md-save food_pop_close_btn"><img src="img/check_mark-wht.png"></button></a>
                </h3>
				<div style="padding:0px;">
                <div style="width:100%;" class="menu_top_filter_left">
                         <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                    	<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px">
                        	<span class="filte_new_text">Ingredient Name</span>
							<input type="text" class="form-control add_text_box" name="ing_name" id="ing_name" placeholder="Ingredient Name" onKeyPress="validateSearch_ing()" onKeyDown="validateSearch_ing()" onKeyUp="validateSearch_ing()">
						</div>
						<div class="col-sm-2" style="padding-right: 0px;padding-left:0px;margin-bottom:5px">
                       		   <span class="filte_new_text">Category</span>
                              <select class="add_text_box" name="ing_cat" id="ing_cat" onKeyPress="validateSearch_ing()" onKeyDown="validateSearch_ing()" onKeyUp="validateSearch_ing()" onChange="validateSearch_ing()">
                                 <option value="null" default="">Select Category</option>
                                   <?php
								   //`inv_tbl_productcatmaster`(`pcm_prodcatid`, `pcm_prodcatname`, `pcm_active`, `pcm_branchid`)
									 $sql_login  =  $database_inv->mysqlQuery("select distinct(pcm_prodcatname) from inv_tbl_productcatmaster"); 
									  $num_login   = $database_inv->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database_inv->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['pcm_prodcatname']?>"><?=$result_login['pcm_prodcatname']?></option>
                               <?php } } ?>	
                                <option value="null" default>All</option>
                                </select>
						</div>
                        <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                                 <span class="filte_new_text">Sub Category</span>
                                 <select class="add_text_box" name="ing_sub" id="ing_sub" onKeyPress="validateSearch_ing()" onKeyDown="validateSearch_ing()" onKeyUp="validateSearch_ing()" onChange="validateSearch_ing()">
                                 <option value="null" default="">Select Sub Category</option>
                                 <?php
								 // `inv_tbl_productsubcatmaster`(`pscm_prodsubcatid`, `pscm_prodsubcatname`, `pscm_prodcatid`, `pscm_active`) 
									 $sql_login  =  $database_inv->mysqlQuery("select distinct(pscm_prodsubcatname) from inv_tbl_productsubcatmaster"); 
									  $num_login   = $database_inv->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database_inv->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['pscm_prodsubcatname']?>"><?=$result_login['pscm_prodsubcatname']?></option>
                               <?php } } ?>	
                                <option value="null" default>All</option>
                                </select>
						</div>
                        <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                                 <span class="filte_new_text">Brand</span>
                                 <select class="add_text_box" name="ing_bd" id="ing_bd" onKeyPress="validateSearch_ing()" onKeyDown="validateSearch_ing()" onKeyUp="validateSearch_ing()" onChange="validateSearch_ing()">
                                 <option value="null" default="">Select Brand</option>
                                 <?php
								 //`inv_tbl_brandmaster`(`brm_brandid`, `brm_brandname`, `brm_active`)
									 $sql_login  =  $database_inv->mysqlQuery("select distinct(brm_brandname) from inv_tbl_brandmaster"); 
									  $num_login   = $database_inv->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database_inv->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['brm_brandname']?>"><?=$result_login['brm_brandname']?></option>
                               <?php } } ?>	
                                <option value="null" default>All</option>
                                </select>
						</div>
                 
                        <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px">
                        	<span class="filte_new_text">Status</span>
                            <select class="add_text_box" name="ing_st" id="ing_st" onKeyPress="validateSearch_ing()" onKeyDown="validateSearch_ing()" onKeyUp="validateSearch_ing()" onChange="validateSearch_ing()">
                                <option value="null">Select Status</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                 <option value="null">All</option>	
                                </select>
						</div>
                        
                        <div class="col-sm-2 nopadding">
							<div style="margin-left:2%;margin-top:21px;" class="search_btn_member_invoice"><a href="#" onClick="reloadall_ing()">Reload</a></div>
						</div>
					</div><!--form_group-->
                    	
                    </div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    <input type="hidden" name="hiduniting" id="hiduniting" >
                    <div id="listingredientsstotal" >
                    <table class="responstable tablesorter" id="listingredientss">
                        <thead>
                          <tr>
                                <th class="header">Sl No</th>
                                <th class="header">Ingredient name</th>
       							 <th class="header">Main Category</th>
                                  <th class="header">Sub Category</th>
                                 <th class="header">Brand</th>
                                 <th class="header">Unit</th>
                                 <th class="header">Rate</th>
                                 <th class="header">Status</th>
                              </tr>
                                  </thead>
                          <tbody>
                          
                          <!--<tr class="food_table_active">-->
                          <?php
						  //`inv_tbl_productmaster`(`prm_productid`, `prm_productname`, `prm_productcat`, `prm_productdsubcat`, `prm_productdbrand`, `prm_productdunit`, `prm_productdminstock`, `prm_productdmaxstock`, `prm_productdredorderlevel`, `prm_productrate`, `prm_branchid`, `prm_active`, `prm_ratemodifieddate`)
						  //`inv_tbl_productcatmaster`(`pcm_prodcatid`, `pcm_prodcatname`, `pcm_active`, `pcm_branchid`)
						  // `inv_tbl_productsubcatmaster`(`pscm_prodsubcatid`, `pscm_prodsubcatname`, `pscm_prodcatid`, `pscm_active`) 
						  //`inv_tbl_brandmaster`(`brm_brandid`, `brm_brandname`, `brm_active`)
						  //`inv_tbl_unitmaster`(`um_id`, `um_name`, `um_symbol`) 
						  $sql_table_sel  =  $database_inv->mysqlQuery("select * from inv_tbl_productmaster as pm LEFT JOIN inv_tbl_productcatmaster as pc ON pm.prm_productcat=pc.pcm_prodcatid LEFT JOIN inv_tbl_productsubcatmaster as ps ON pm.prm_productdsubcat=ps.pscm_prodsubcatid LEFT JOIN inv_tbl_brandmaster as bm ON pm.prm_productdbrand=bm.brm_brandid LEFT JOIN inv_tbl_unitmaster as um ON pm.prm_productdunit=um.um_id"); 
						  $num_table  = $database_inv->mysqlNumRows($sql_table_sel);
						  if($num_table){$i=1;
								while($result_table_sel  = $database_inv->mysqlFetchArray($sql_table_sel)) 
									{
										if($result_table_sel['prm_active']=='Y')
										{
											$sts="Yes";
										}else
										{
											$sts="No";
										}
						  ?>
                          
                        	<tr id="ids_<?=$result_table_sel['prm_productid']?>" name="<?=$result_table_sel['prm_productname']?>" unit="<?=$result_table_sel['prm_productdunit'] ?>" unitcost="<?=$result_table_sel['prm_productrate'] ?>" rate="<?=$result_table_sel['prm_productrate'] ?>" class="clicktoselect_ing">
                              <td><?=$i++;?></td>
                                <td><?=$result_table_sel['prm_productname']?></td>
                                <td><?=$result_table_sel['pcm_prodcatname']?></td>
                                <td><?=$result_table_sel['pscm_prodsubcatname']?></td>
                                <td><?=$result_table_sel['brm_brandname']?></td>
                                <td><?=$result_table_sel['um_name']?></td>
                                <td><?=$result_table_sel['prm_productrate']?></td>
                                <td><?=$result_table_sel['prm_active']?></td>
                              </tr>
                              
                              <?php } }?>
                            
                          
                                       </tbody>
                                                </table>
                                                </div>
                               
                    </div><!----div--->
                     
				</div>
                </div>
		</div>
    <!--  ***************************************** Ingredient load ends  ************************************************ --> 
<input type="hidden" name="hidmenuingr_ck" id="hidmenuingr_ck" >
<input type="hidden" name="hidslnoingr_ck" id="hidslnoingr_ck" >
<input type="hidden" name="hidingringr_ck" id="hidingringr_ck" >        
<div class="md-overlay"></div><!-- the overlay element -->
 <div style="display:none" class="index_popup_1 closeoneclass">
 	<div class="index_popup_contant">Are you Sure you Want to Delete</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel">Cancel</a></div>
    </div>
 </div>
 
<input type="hidden" name="hidimagedel" id="hidimagedel" >  
 <div style="display:none" class="index_popup_del closeoneclass">
 	<div class="index_popup_contant">Are you Sure you Want to Delete</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok_del">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel_del">Cancel</a></div>
    </div>
 </div>
 
 <div style="display:none" class="confrmation_overlay"></div>


<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/ecmascript">
	$(document).ready(function() { 
 /*$(".food_item_del").click(function() {
    $(".index_popup_1").show();
	$(".confrmation_overlay").show();
 });
 
  $(".btn_index_popup").click(function() {
    $(".index_popup_2").hide();
	$(".index_popup_1").hide();
	$(".confrmation_overlay").hide();
 });*/
 
	});
</script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/foodcosting_menupopup.js"></script>
<script type="text/javascript" src="js/foodcosting_main.js"></script>
<script type="text/javascript" src="js/foodcosting_ingrdpopup.js"></script>
<script type="text/javascript" id="js">
 

</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>