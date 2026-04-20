<?php //include('includes/session.php'); // Check session
//error_reporting(0);
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
?>
<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Combo</title>
<meta name="description" content="">
<link href="img/favicon.ico" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<link rel="stylesheet" href="css/tabs_cont_2.css">
<link rel="stylesheet" href="css/menu_new_22.css">
<style>
#container{overflow:auto !important; }
#ascrail2002{z-index: 9999999999999999999 !important;left:0px !important } 
.tabs li a{width: 49.8% !important;  background-color: rgba(0, 0, 0, 0.8);  margin: 0 0.1%;}
.tabs li a:hover{background-color: rgb(163, 68, 0)}
.tabs li.current a{background-color:rgb(163, 68, 0)}
.md-content{display:inline-block;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{height: 65vh;min-height:410px;}
.text_displaying_contain{  padding-bottom: 0;}
.cc_new{margin: 3px 0 0px 0;}
.master_page_tab_cc{min-height: 400px;height: 78.5vh;overflow:hidden;}
#left_table_scr_cc{min-height: 400px;height: 73vh;}
.tablesorter thead th{border-top:0;}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
  <script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){ //mname mcate msubc mdiet mstatus
			/*$('#mname').autocomplete({source:'autocomplete/find_keywords.php?type=mname_m', minLength:1});
			$('#mcate').autocomplete({source:'autocomplete/find_keywords.php?type=mcate_m', minLength:1});
			$('#msubc').autocomplete({source:'autocomplete/find_keywords.php?type=msubc_m', minLength:1});
			$('#mdiet').autocomplete({source:'autocomplete/find_keywords.php?type=mdiet_m', minLength:1});
			$('#mstatus').autocomplete({source:'autocomplete/find_keywords.php?type=mstatus_m', minLength:1});*/
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />

<!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
 <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<!--<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>-->
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE --> 	    
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
	.has-error{border:solid 1px #f00;
	box-shadow:0 0 3px #f00;
	-moz-box-shadow:0 0 3px #f00;
	-webkit-box-shadow:0 0 3px #f00;
	outline:none !important;
	} 
.form-control:focus	{}	
.has-error:focus{border:solid 1px #f00;
	box-shadow:0 0 3px #f00;
	-moz-box-shadow:0 0 3px #f00;
	-webkit-box-shadow:0 0 3px #f00;
	outline:none !important;
	} 	
.md-content > div{padding:0px 10px 4px 5px;}
</style>
</head>
<body>

<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">

<?php include "includes/topbar_master.php"; ?>
  <?php include "includes/left_menu.php"; ?>
  <div class="sitemap_cc">Menu Combo</div>
<div class="mian">
	<div class="view-container">
		<div  style="top: 58px;" id="container">
        
        <div class="breadcrumbs">
        
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Menu</a></li>
                    <span id="ratechange" class="load_error alertsmaster" style="color:#F00" ></span>  
				</ul>
            
                
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                
               <!-- box head -->
               <div class="main_cc">
                    <div class="cc_new_main">
                    	<div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                     <div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div><!--cc_new-->
                    
                    </div>
                     
                    </div>
                	<div class="col-lg-12 col-md-12 middle_container nopadding">
                    	<div style="padding:0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!--left_container-->
                        	<div class="col-lg-12 col-md-12 min-height nopadding">
                            	<div class="text_displaying_contain">
                                <div class="filter_main_head">Filter By</div>
 										<div class="master_page_tab_cc">
                                        	<div class="menu_top_filter_left" style="border-bottom: 3px #BEBEBE solid !important;">
                                                 <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                                <div class="col-sm-5" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width: 35%;">
                                                    <p class="menu_filter_txt">Combo Name</p>
                                                    <input style="height: 30px;" type="text" class="form-control" placeholder="Combo Name">
                                                </div>
                                              <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width: 17%;">
                                                    <p class="menu_filter_txt">Status</p>
                                                    <select class="add_text_box" name="mstatus">
                                                        <option value="null">Select Active Status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="null">All</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2 nopadding" style="width:10%">
                                                    <p class="menu_filter_txt">&nbsp;</p>
                                                    <div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#">Search</a>
                                                    </div>
                                                </div>
                                </div><!--form_group-->
                    
                    
                    
                    	
                    </div><!---menu_top_filter_left--->
                    
                    <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-16" onClick="menuclr()" ></a>
                      </div>  
                   </div>
                   			<div class="col-lg-7 col-md-7 no-padding">
                                       <div id="left_table_scr_cc" style="border-right: 4px solid #333;"> 
                                            <table class="responstable tablesorter" id="listall">
                                               <thead>
                                                  <tr>
                                                    <th width="12%">Sl No</th>
                                                    <th width="40%">Combo</th>
                                                     <th width="10%">Active</th>
                                                   <th width="10%">Action</th>
                                                  </tr>
                                              </thead>
                                      		<tbody>
                                            	<tr class="table_active">
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr>
                                                      <tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%">
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr><tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">Combo - 1</td>
                                                       <td width="10%">Yes</td>
                                                       <td width="10%"> 
                                                             <a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a>
                                                             <a class="tab_edt_btn" href="#" onclick="delete_confirm('ToNo','HAM-MENU10')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                        
                                                       </td>
                                                      </tr>
                                            </tbody>
                                          </table>
                   					</div><!--left_table_scr_cc-->
                                </div><!--col-->
                                
                                <div class="col-lg-5 col-md-5 no-padding">
                                       <div id="left_table_scr_cc"> 
                                       		<!--<div class="mn_combo_right_head">Combo - 1</div>-->
                                              <div id="left_table_scr_cc"> 
                                            <table class="responstable tablesorter" id="listall">
                                               <thead>
                                                  <tr>
                                                    <th width="12%">Sl No</th>
                                                    <th width="40%">Menu</th>
                                                     <th width="10%">Qty</th>
                                                  </tr>
                                              </thead>
                                      		<tbody>
                                            	<tr>
                                                      <td width="12%">1</td>
                                                        <td width="40%">MINCED CHICKEN CANAPE</td>
                                                       <td width="10%">3</td>
                                                  </tr>
                                                  <tr>
                                                      <td width="12%">2</td>
                                                        <td width="40%">CHICKEN SHASLIK</td>
                                                       <td width="10%">1</td>
                                                  </tr>
                                                  <tr>
                                                      <td width="12%">3</td>
                                                        <td width="40%">CHIMICHURI PRAWNS</td>
                                                       <td width="10%">1</td>
                                                  </tr>
                                               </tbody>
                                               </table>
                                       </div>
                                 </div><!--col-->
                                       
                                 </div>    
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
					
		</div>
	</div>
</div>
</div><!--container-->
</div>
</div>
</div>
<!--  add starts -->
<div class="md-modal md-effect-16" id="modal-16" style="width:900px;top:10%;">
 	<form role="form" action="menu.php"  method="post"  name="menu">
			<div style="width:900px;" class="md-content">
				<h3>Add New Combo</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom: 5px;">
                    	
                        <div class="col-lg-7 col-md-7 no-padding">
                        	<div class="combo_mn_srch_head">
                            	<input type="text" class="mn_combo_serch_box" placeholder="Search">
                                <a href="#" class="mn_combo_seach_btn"></a>
                            </div><!--combo_mn_srch_head-->
                            <div class="combo_menu_list_cc">
                            	 <table class="responstable tablesorter" id="listall">
                                    <thead>
                                       	<tr>
                                        	<th width="70%">Menu Name</th>
                                            <th width="15%">Qty</th>
                                            <th width="15%">Add</th>
										</tr>
                                   </thead>
                          			<tbody style="height:auto;min-height:418px;">
                                    	<tr class="table_active"> 
                                        	<td width="70%">CHIMICHURI PRAWNS</td>
                                            <td width="15%"><input type="text" class="combo_qty_txtbox" placeholder="Qty"></td>
                                            <td width="15%"><span class="add_combo"><img src="img/add_to.png"></span></td>
                                        </tr>
                                        <tr>
                                        	<td width="70%">DFISH VEG MINI ROLLS</td>
                                            <td width="15%"><input type="text" class="combo_qty_txtbox" placeholder="Qty"></td>
                                            <td width="15%"><span class="add_combo"><img src="img/add_to.png"></span></td>
                                        </tr>
                                        <tr>
                                        	<td width="70%">BAKED VEGETABLE</td>
                                            <td width="15%"><input type="text" class="combo_qty_txtbox" placeholder="Qty"></td>
                                            <td width="15%"><span class="add_combo"><img src="img/add_to.png"></span></td>
                                        </tr>
                                        <tr>
                                        	<td width="70%">CHICKEN SUI MUI</td>
                                            <td width="15%"><input type="text" class="combo_qty_txtbox" placeholder="Qty"></td>
                                            <td width="15%"><span class="add_combo"><img src="img/add_to.png"></span></td>
                                        </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div><!--1-->
                        <div class="col-lg-5 col-md-5 no-padding">
                        	<div style="border-left:none;" class="combo_mn_srch_head">
                            	<div class="combo_txt_head">Items in Combo</div>
                            </div><!--combo_mn_srch_head-->
                            <div class="combo_menu_list_cc">
                            	 <table class="responstable tablesorter" id="listall">
                                    <thead>
                                       	<tr>
                                        	<th width="70%">Menu Name</th>
                                            <th width="15%">Qty</th>
                                            <th width="15%">Del</th>
										</tr>
                                   </thead>
                          			<tbody style="height:auto;min-height:418px;">
                                    	<tr>
                                        	<td width="70%">BAKED VEGETABLE</td>
                                            <td width="15%"><input type="text" class="combo_qty_txtbox" value="2"></td>
                                            <td width="15%"><span class="add_combo"><img src="img/black_cross.png"></span></td>
                                        </tr>
                                    </tbody>
                                </table>    
                            </div>
                        </div><!--2-->
                        
                         
                    </div>
				  <a href="#"><span class="md-close newbut">Close me</span></a>
                  <a onClick="validate_registration()"><span class="md-save newbut">Save</span></a>
				</div>
			</div>
            </form>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>