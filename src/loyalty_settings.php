<?php
session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();


$_SESSION['pagid']=29;
if(!isset($_SESSION['page_id']))
{
	$_SESSION['page_id']='loadfull';
}

if($_SERVER['REQUEST_METHOD']=='POST' )
{
   
  $querylang=$database->mysqlQuery("update tbl_branch_settings_loyality set bl_branchid='1', bl_loyality_point='".$_REQUEST['ly_point']."',bl_loyality_cash='".$_REQUEST['ly_cash']."',bl_redemption_min_point='".$_REQUEST['ly_point_redem']."',bl_redemption_cash_value='".$_REQUEST['ly_cash_redem']."'");
  

   	if (!headers_sent())
    {    
        header('Location: loyalty_settings.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="loyalty_settings.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=loyalty_settings.php?msg=3" />';
        echo '</noscript>'; exit;
    }
//mine
}
$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
        
	}
}

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Loyalty</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/require_status_style.css">
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
.new{width:27px;height:27px;float:right}
.new-cl{height:auto !important;}
.add_new_dropdown{width: 90%;}
.breadcrumbs{margin-bottom:0}
.breadcrumbs > ul > li > a::before{display:none}
.breadcrumbs > ul > li > a{margin-right:0;}
.breadcrumbs > ul > li{ font-family: 'CALIBRI_0' !important;}
</style>

</head>
<body id="loadfull">
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>--</li>
					<li><a style="cursor:pointer">LOYALTY</a></li>
				<?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
                                </ul> 
			</div>
            <?php
                       $ly_point="";
                    $ly_point_cash="";
                    $ly_point_redem="";
                    $ly_point_redem_cash="";
            $sq_cloud=$database->mysqlQuery("select * from tbl_branch_settings_loyality");
            $nm_cloud= $database->mysqlNumRows($sq_cloud);
            if($nm_cloud){
		while($result_cloud  = $database->mysqlFetchArray($sq_cloud)) 
						  {
                    
                    $ly_point=$result_cloud['bl_loyality_point'];
                    $ly_point_cash=$result_cloud['bl_loyality_cash'];
                    $ly_point_redem=$result_cloud['bl_redemption_min_point'];
                    $ly_point_redem_cash=$result_cloud['bl_redemption_cash_value'];
                                        }
                }
            
                
					?>
            
                          <div class="content-sec">
                
                	<div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                     
                       <div class="branch_master_main_container">
                       	<div class="new_branch_main_setings_head" style="position:relative;">LOYALTY SETTINGS </div> 	
                              <form role="form" action="loyalty_settings.php"  method="post" id="branchset"  name="branch_settings_new">
                            
                       <div class="new_branch_contant_container div_new_13">
                               <div class="new_branch_sub_head printer_settings" id="view_printer"> Loyalty
                               <div class="brch_edit_btn edit_013"><img src="images/edit_btn.png"></div>
<!--                                <div class="close_branch_edit013"><img src="img/close_ico.png"></div>
                                 <div class="close_branch_save013"><img src="img/green_tick.png"></div>-->
                               
                               </div>
                           
                            	<div class="branch_contant_cc" >
                                	<div class="branch_inner_div">Loyalty Point<span>:</span></div>
                                    <div class="branch_inner_div_1"><?=$ly_point?></div>
                                </div><!--branch_contant_cc-->
                                 <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Loyalty Cash <span>:</span></div>
                                    <div class="branch_inner_div_1"><?=$ly_point_cash?></div>
                                </div><!--brch_right_mrg-->
                                 <div class="branch_contant_cc ">
                                	<div class="branch_inner_div">Loyalty Redemption Point<span>:</span></div>
                                    <div class="branch_inner_div_1"><?=$ly_point_redem?></div>
                                </div><!--brch_right_mrg-->
                                 <div class="branch_contant_cc brch_right_mrg">
                                	<div class="branch_inner_div">Loyalty Redemption Cash<span>:</span></div>
                                    <div class="branch_inner_div_1"><?=$ly_point_redem_cash?></div>
                                </div>
                                
                                </div>
                                
                                
                                <div class="new_branch_contant_container branch_edit_div13" style="display:none">
                               <div class="new_branch_sub_head">Printer Settings
                              <div class="brch_edit_btn edit_13" ><img src="images/edit_btn.png"></div>
                                <div class="close_btn_brch close_branch_edit13" style="    width: 27px;    height: 27px;    float: right;"><img src="img/close_ico.png"></div>
                                 <div class="save_btn_brch close_branch_save13" style="    width: 27px;    height: 27px;    float: right;"><img src="img/green_tick.png"></div>
                              <!--  <div class="close_branch_edit010"><img src="img/close_ico.png"></div>
                                 <div class="close_branch_save010"><img src="img/green_tick.png"></div>-->
                               
                               </div>
                            	
                                        <div class="branch_contant_cc">
                                	<div class="branch_inner_div">Loyalty Point<span>:</span></div>
            
  	
                                        <div class="branch_inner_div_1"><input type="text" value="<?=$ly_point?>" id="ly_point" name="ly_point" onkeypress="return numdot(event);" class="new_branch_txtbox"></div>          
            
                                </div>
                                  
                                <div class="branch_contant_cc brch_right_mrg" >
                                	<div class="branch_inner_div">Loyalty Cash<span>:</span></div>
            
  	
                      <div class="branch_inner_div_1"><input type="text" value="<?=$ly_point_cash?>" id="ly_cash" onkeypress="return numdot(event);" name="ly_cash" class="new_branch_txtbox"></div>   
                                </div>
                                    
                                <div class="branch_contant_cc" >
                                	<div class="branch_inner_div">Loyalty Redemption Point<span>:</span></div>
            
                      <div class="branch_inner_div_1"><input type="text" value="<?=$ly_point_redem?>" id="ly_point_redem" onkeypress="return numdot(event);" name="ly_point_redem" class="new_branch_txtbox"></div>   
                                </div>
                                    
                                <div class="branch_contant_cc brch_right_mrg" >
                                	<div class="branch_inner_div">Loyalty Redemption Cash<span>:</span></div>
            
  	
                      <div class="branch_inner_div_1"><input type="text" value="<?=$ly_point_redem_cash?>" id="ly_cash_redem" onkeypress="return numdot(event);" name="ly_cash_redem" class="new_branch_txtbox"></div>   
                                </div>
                                
                                
                                </div>
               
                                 </form>
                                </div>
                          
                            
                       </div>
                       
                </div>
		</div>
	</div>
</div>

</div>
 

<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>



$(".printer_settings .edit_013").click(function(){
	
		location.hash='#view_printer';
		$.post("load_branchsettings.php", {set:"page",pageid: "view_printer"});
		$(".div_new_0").css("display","block");
		$(".div_new_1").css("display","block");
		$(".div_new_2").css("display","block");
		$(".div_new_3").css("display","block");
		$(".div_new_4").css("display","block");
		$(".div_new_5").css("display","block");
		$(".div_new_6").css("display","block");
		$(".div_new_7").css("display","block");
		$(".div_new_8").css("display","block");
		$(".div_new_9").css("display","block");
		$(".div_new_10").css("display","block");
		$(".div_new_11").css("display","block");
                $(".div_new_12").css("display","block");
                $(".div_new_13").css("display","none");
		$(".branch_edit_div1").css("display","none");
		$(".branch_edit_div").css("display","none");
		$(".branch_edit_div2").css("display","none");
		$(".branch_edit_div3").css("display","none");
		$(".branch_edit_div4").css("display","none");
		$(".branch_edit_div5").css("display","none");
		$(".branch_edit_div6").css("display","none");
		$(".branch_edit_div7").css("display","none");
		$(".branch_edit_div8").css("display","none");
		$(".branch_edit_div9").css("display","none");
		$(".branch_edit_div10").css("display","none");
                $(".branch_edit_div11").css("display","none");
                $(".branch_edit_div12").css("display","none");
                $(".branch_edit_div13").css("display","block");
		$(".close_branch_edit07").css("display","none");
		$(".edit_07").css("display","block");
		$(".close_branch_edit").css("display","none");
		$(".close_branch_edit02").css("display","none");
		$(".close_branch_edit01").css("display","none");
		$(".close_branch_edit03").css("display","none");
		$(".close_branch_edit04").css("display","none");
		$(".close_branch_edit05").css("display","none");
                $(".close_branch_edit06").css("display","none");
                $(".close_branch_edit07").css("display","none");
		$(".close_branch_edit08").css("display","none");
		$(".close_branch_edit09").css("display","none");
		$(".close_branch_edit010").css("display","none");
		$(".close_branch_edit011").css("display","none");
                $(".close_branch_edit12").css("display","none");
                $(".close_branch_edit013").css("display","block");
		$(".close_branch_save").css("display","none");
		$(".close_branch_save07").css("display","none");
		$(".close_branch_save02").css("display","none");
		$(".close_branch_save01").css("display","none");
		$(".close_branch_save03").css("display","none");
		$(".close_branch_save04").css("display","none");
		$(".close_branch_save06").css("display","none");
		$(".close_branch_save05").css("display","none");
		$(".close_branch_save08").css("display","none");
		$(".close_branch_save09").css("display","none");
		$(".close_branch_save010").css("display","none");
		$(".close_branch_save011").css("display","none");
                $(".close_branch_save12").css("display","none");
                $(".close_branch_save013").css("display","block");
		$(".edit_012").css("display","block");
		$(".edit_02").css("display","block");	 
		$(".edit_0").css("display","block");
		$(".edit_01").css("display","block");
		$(".edit_03").css("display","block");
		$(".edit_04").css("display","block");
		$(".edit_06").css("display","block");
		$(".edit_05").css("display","block");
		$(".edit_08").css("display","block");
		$(".edit_09").css("display","block");
		$(".edit_010").css("display","block");
		$(".edit_011").css("display","block");
                $(".edit_012").css("display","block");
                $(".edit_13").css("display","none");
});


$(".close_branch_edit13").click(function(){
    $(".branch_edit_div13").css("display","none");
	$(" .printer_settings .close_branch_edit13").css("display","none");
	$(".edit_013").css("display","block");
	$(" .printer_settings .close_branch_save013").css("display","none");
	$(".div_new_13").css("display","block");
});
$(" .close_branch_save13").click(function(){
	document.branch_settings_new.submit();
	document.branch_settings_new1.submit();
});





//-------------smsEmail settings end
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



function numdot(e) {     
   
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

</script>
<script type="text/javascript" src="js/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />

</body>
</html>