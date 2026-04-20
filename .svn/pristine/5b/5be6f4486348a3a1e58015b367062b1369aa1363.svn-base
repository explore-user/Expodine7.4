<?php
session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Settings</title>
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
 <script src="js/jquery-2.1.3.min.js"></script><!--jquery-1.10.2.min-->
<script src="master_style/js/modernizr.custom.js"></script>
<style>
.container{background-color:transparent;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 74vh;min-height: 474px;}
.md-content > div{overflow:auto}
.form_name_cc{font-size:13px;height:30px;line-height:30px;}
.first_form_contain{padding: 0.5%;margin-bottom: 0px;}
.md-modal{width:70%;min-width:800px;}
.md-content > div{max-height:550px;overflow:auto;padding-bottom:60px;}
.md-modal .form-control{ height: 33px;padding: 5px 12px;}
.popup_add_table tr:nth-child(even) {background: #E0E0E0;}
.popup_add_table td {height: 38px;font-size: 14px;border:solid 1px #ccc;}
.md-content .form_name_cc{text-align:left;line-height:22px;min-height:30px;height:auto}

</style>

</head>
<body>
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Branch Master</a></li>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       
                       <div class="branch_master_main_container">
                       		<div class="new_branch_setings_head">General Settings</div>
                            
                            <div class="new_branch_sub_head">Branch 
                            	<div class="brch_edit_btn edit_0"><img src="images/edit_btn.png"></div>
                                <div class="close_branch_edit"><img src="img/close_ico.png"></div>
                                 <div class="close_branch_save"><img src="img/green_tick.png"></div>
                            </div>
                            <div class="new_branch_contant_container div_new_0" >
                            
                            	<div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Phone <span>:</span></div>
                                    <div class="branch_inner_div_1">9876543210</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Phone<span>:</span></div>
                                    <div class="branch_inner_div_1">123456789</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div id="auto_height" class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div id="auto_height_div" class="branch_inner_div_1">SERVICE TAX- AAIFH6398ASD001,TIN - 32110972233</div>
                                </div><!--brch_right_mrg-->
                                
                            </div><!--new_branch_contant_container-->
                            
                            <div class="new_branch_contant_container branch_edit_div" style="display:none;">
                            
                            	<div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1"><input type="text" value="Explore IT Solutions" class="new_branch_txtbox"></div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1"><input type="text" value="Explore IT Solutions" class="new_branch_txtbox"></div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Phone <span>:</span></div>
                                    <div class="branch_inner_div_1"><input type="text" value="987654321" class="new_branch_txtbox"></div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Phone<span>:</span></div>
                                    <div class="branch_inner_div_1"><input type="text" value="123456789" class="new_branch_txtbox"></div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">
                                    	<div class="active_chk_box"><input name="" type="checkbox" value=""> Yes</div>
                                        <div class="active_chk_box"><input name="" type="checkbox" value=""> No</div>
                                    </div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">
                                    	<div class="active_chk_box"><input name="" type="checkbox" value=""> Yes</div>
                                        <div class="active_chk_box"><input name="" type="checkbox" value=""> No</div>
                                    </div>
                                </div><!--brch_right_mrg-->
                                
                            </div><!--new_branch_contant_container-->
                            
                            <div class="new_branch_sub_head">Branch</div>
                            <div class="new_branch_contant_container">
                            
                            	<div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Phone <span>:</span></div>
                                    <div class="branch_inner_div_1">9876543210</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Phone<span>:</span></div>
                                    <div class="branch_inner_div_1">123456789</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                
                            </div><!--new_branch_contant_container-->
                            
                            <div class="new_branch_sub_head">Branch</div>
                            <div class="new_branch_contant_container">
                            
                            	<div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Phone <span>:</span></div>
                                    <div class="branch_inner_div_1">9876543210</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Phone<span>:</span></div>
                                    <div class="branch_inner_div_1">123456789</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Phone <span>:</span></div>
                                    <div class="branch_inner_div_1">9876543210</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Phone<span>:</span></div>
                                    <div class="branch_inner_div_1">123456789</div>
                                </div><!--brch_right_mrg-->
                                <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Branch Name <span>:</span></div>
                                    <div class="branch_inner_div_1">Explore IT Solutions</div>
                                </div><!--branch_contant_cc-->
                                <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Complementary management authentication  <span>:</span></div>
                                    <div class="branch_inner_div_1">Y</div>
                                </div><!--brch_right_mrg-->
                                
                                
                            </div><!--new_branch_contant_container-->
                            
                       </div>
                       
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
 
 
 


<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
$(".edit_0").click(function(){
    $(".div_new_0").css("display","none");
	 $(".branch_edit_div").css("display","block");
	 $(".close_branch_edit").css("display","block");
	 $(".edit_0").css("display","none");
	 $(".close_branch_save").css("display","block");
});

$(".close_branch_edit").click(function(){
    $(".branch_edit_div").css("display","none");
	$(".div_new_0").css("display","block");
	$(".close_branch_edit").css("display","none");
	$(".edit_0").css("display","block");
	$(".close_branch_save").css("display","none");
});
/*$(".close_branch_save").click(function(){
	alert("hii");
});	*/

var maxHeight = 0;

$('.branch_inner_div_1').each(function(index){
if ($(this).height() > maxHeight)
{
maxHeight = $(this).height();
}
});

$('.branch_inner_div').height(maxHeight);

$('.branch_inner_div').each(function(index){
if ($(this).height() > maxHeight)
{
maxHeight = $(this).height();
}
});

$('.branch_inner_div_1').height(maxHeight);

</script>

</body>
</html>