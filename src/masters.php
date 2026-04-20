<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Expdine</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<!-- Fonts -->	
<link rel="shortcut icon" href="img/favicon.ico">
<!-- Styles -->

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
<!-- <link rel="stylesheet" href="css/website.css" type="text/css">-->
<!-- <link rel="stylesheet" href="css/normal_1.css" type="text/css">-->
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } </style>
</head>
<body>
<div id="blr" class="container nopaddding">

  
  <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a href="#" id="trigger" class="menu-trigger"></a>
                 <span class="toggle-menu purple"><i class="ti-menu"></i></span>
            <a class="navbar-brand" href="#"> <img alt=""  src="img/logo20.png"  class="hidden-xs logo_cc"/></a>
	
            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn_1 btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Admin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <!--<li><a href="#">Profile</a></li>-->
                    <li class="divider"></li>
                    <li><a onClick="confirmation()" style="cursor:pointer">Logout</a></li>
                </ul>
            </div><!--btn-group-->
              <div  class="notification_contain">
              	<div class="notification_1">
                	<a href="#" title="">
                    	<span class="notify_color_ico">8</span>
                    	<span class="notify_ico"><img src="img/bill_ico.png"></span>
                    </a>
                </div><!--notification_1-->
                <div class="notification_1">
                	<a class="notificationLink" title="">
                    	<span class="notify_color_ico">10</span>
                    	<span class="notify_ico"><img src="img/steward_ico.png"></span>
                    </a>
                </div><!--notification_1-->
                <div class="notification_1">
                	<a class="notificationLink_1" title="">
                    	<span class="notify_color_ico">2</span>
                    	<span class="notify_ico"><img src="img/water_ico.png"></span>
                    </a>
                </div><!--notification_1-->
                 <div class="notification_1">
                	<a title="">
                    	<span class="notify_color_ico">1</span>
                    	<span class="notify_ico"><img src="img/kot_order_ico.png"></span>
                    </a>
                </div><!--notification_1-->
                
<script type="text/javascript" >
$(document).ready(function()
{
	
	$('.class').click(function()
{
alert("hiii");
//$(".popup_1").load("ptest.php");

$.ajax({
	   type: "POST",
	   url: "ptest.php",

	   data: "page=1",
	   success: function(msg)
	   {
		   //alert(msg);
$('.popup_1').html(msg);
		  
	   }
   });

});
	
	
	
$(".notificationLink").click(function()
{
$(".notificationContainer").fadeToggle(300);
$(".notification_count").fadeOut("slow");
$(".notificationContainer_1").hide();
return false;
});

//Document Click
$(document).click(function()
{
});
//Popup Click
$(".notificationContainer_1").click(function()
{
return false
});

$(".notificationLink_1").click(function()
{
$(".notificationContainer_1").fadeToggle(300);
//$(".notify_color_ico").hide("slow");
$(".notificationContainer").hide();
return false;
});

//Document Click
$(document).click(function()
{
$(".notificationContainer_1").hide();
$(".notificationContainer").hide();

});


//Popup Click
$(".notificationContainer_1").click(function()

{
return false
});
$(".notificationContainer").click(function()

{
return false
});

});

//function blinker() {
//    $('.notify_color_ico').fadeOut(300);
//    $('.notify_color_ico').fadeIn(300);
//}
//
//setInterval(blinker, 800);

</script>
                

<div class="notification_li">
<div class="notificationContainer">
<div class="notificationTitle">You Have 10 New Notifications</div>
<div class="notificationsBody notifications popup_1" >
	<a href="#" class="class"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
   <a href="#"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
   <a href="#"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
     <a href="#"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
     <a href="#"><div class="notification_cont_list notiify_list_visited">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
     <a href="#"><div class="notification_cont_list notiify_list_visited">
    	<div class="noti_stewrd_name">Steward - <span>Stewrad Name</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Table - <span>20</span></div>
        <div class="nitify_time">Time : <span>02:10 AM </span></div>
    </div></a><!--notification_cont_list--->
    
<!--<a style="color:#000" href="#" class="submit">submit</a>-->
<!--<div class="notificationFooter"></div>-->
</div>
</div><!--notification_li-->

<div class="notification_li">
<div class="notificationContainer_1">
<div class="notificationTitle">You Have 2 New Notifications</div>
<div class="notificationsBody notifications">
  <a href="#"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Table - <span>57</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Steward - <span>Steward Name</span></div>
        <div class="nitify_time">Time : <span>05:10 AM </span></div>
    </div></a><!--notification_cont_list--->
    <a href="#"><div class="notification_cont_list">
    	<div class="noti_stewrd_name">Table - <span>57</span></div><!--noti_stewrd_name-->
        <div class="nitify_table_no">Steward - <span>Steward Name</span></div>
        <div class="nitify_time">Time : <span>05:10 AM </span></div>
    </div></a><!--notification_cont_list--->
<!--<a style="color:#000" href="#" class="submit">submit</a>-->
<!--<div class="notificationFooter"></div>-->
</div>
</div><!--notification_li-->

 
              </div><!--notification_contain-->
              
           
  </div><!--navbar-inner-->
  </div><!--navbar-default--> 
 </div> <!--container-->
 </div>
  
  <aside>
    <section>
		<div class="nav">
	
	<nav class="menu">
     <ul id="leftNavigation" class="parent-menu">
			<li>
				<a title=""><i class="ti-desktop"></i><span>Administration</span></a>
				<ul>
					<li><a href="#" title="">Dashboard 1</a></li>
					<li><a href="#" title="">Dashboard 2</a></li>
					<li><a href="#">Dashboard 3</a></li>
				</ul>
			</li>
			<li><a  href="#"> <i class="ti-anchor"></i><span>User Settings</span></a></li>
			<li>
				<a title=""><i class="ti-mobile"></i><span>Front Office </span></a>
				<ul>
					<li><a href="user_details.html">Blank</a></li>
					<li><a href="#">Horizontal Menu</a></li>
					<li><a href="#">Light Menu</a></li>
				</ul>
			</li>
			<li>
				<a title=""><i class="ti-email"></i><span>Guest Management </span></a>
				<ul>
					<li><a href="#">Inbox</a></li>
					<li><a href="#">Compose Email</a></li>
				</ul>
			</li>
			<li>
				<a href="#" title=""><i class="ti-bolt"></i><span>Room Management </span></a>
			</li>
			<li>
				<a title=""><i class="ti-paint-roller"></i><span>House keeping </span></a>
				<ul>
					<li><a href="#">Font Awesome</a></li>
					<li><a href="#">Line Icons</a></li>
				</ul>
			</li>
			<li>
				<a href="#/charts/rich-charts"><i class="ti-pie-chart"></i><span>H R managment</span></a>
			</li>
			
			
			<li><a href="#" title=""><i class="ti-rocket"></i><span>Marketting</span></a></li>
          
            
            
		</ul>


	</nav>
</div>

	</aside>
    
      <?php /*?><?php include "includes/topbar_master.php"; ?>
  
   <?php include "includes/left_menu.php"; ?><?php */?>

<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
		
        
			<div class="breadcrumbs">
				<ul>
					<li><a href="#/dashboard" title=""><i class="ti-home"></i></a>/</li>
					<li><a title="">Dashboard</a></li>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
  
           				
                       <div class="cc_new">

                       	<div id="lista1" class="als-container">
				<span class="als-prev"><img src="images/thin_left_arrow_333.png" alt="prev" title="previous" /></span>
				<div class="als-viewport">
					<ul class="als-wrapper">
						<li class="als-item"><a href="#" class="new_tab_btn">Menu 1</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 2</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 3</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 4</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn active_btn_1">Menu 5</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 6</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 7</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 8</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 9</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 10</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 11</a></li>
                        <li class="als-item"><a href="#" class="new_tab_btn">Menu 12</a></li>
                        
						
                       
					</ul>
				</div>
				<span class="als-next"><img src="images/thin_right_arrow_333.png" alt="next" title="next" /></span>
			</div>
                   </div><!--cc_new-->
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   
                   <div class="col-md-12 contant_table_cc">
                   		
                        <table class="table_report scroll"  width="100%" border="0" cellspacing="5">
                            <thead>
                              <tr>
                                <td>Head 1</td>
                                <td>Head 2</td>
                                <td>Head 3</td>
                                 <td width="20">Action</td>
                              </tr>
                             </thead>
                             <tbody id="">
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                               <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                               <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                               <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                 <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr><tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                               <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr><tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                               <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>Text 01</td>
                                <td>Text 02</td>
                                <td>Text 03</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                                
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                               <td >
                                	<a href="#"><div class="action_button"><img src="images/edit_page.PNG"></div></a>
                                    <a href="#"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
                              </tr>
                              
                             </tbody> 
                        </table>
                   </div>
                        <div style="background-color:#fff;border:solid 1px #ccc" class="module_acces_head"><span>
                                  <ul style="margin-right:5px;" class="pagination">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                  </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                  </a>
                                </li>
                              </ul>
                                        </span></div>
                        
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>

<!--Dock-->
<!--
<div id="dock-wrapper">
    <div class="dock">
      <div class="dock-front">
    	    <img src="images/arrow-up.png" alt="Arrow Up" id="arrow-up" />
      </div>
      <div class="dock-top">
    	    <img src="images/arrow-down.png" alt="Arrow Down" id="arrow-down" />
      </div>
    </div>
    <div class="item">
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
        <a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    </div>
  </div>-->
<!--/Dock-->
</div><!--container-->
<div class="md-modal md-effect-16" id="modal-16">
			<div class="md-content">
				<h3>Add New </h3>
				<div>
				
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<table class="popup_add_table" width="100%" border="0" cellspacing="5">
                              <tr>
                                <td>Menu Name</td>
                                <td><input name="name" class="add_text_box" placeholder="Item Name" type="text"></td>
                                <td>Short Key</td>
                                <td><input name="name" class="add_text_box" placeholder="Item Name" type="text"></td>
                              </tr>
                              <tr>
                                <td>Menu Main Category</td>
                                <td><Select name="name" class="add_text_box">
                                		<option>Menu Main Category</option>
                                        <option>Menu Main Category</option>
                                	</Select>
                                </td>
                                <td>Menu Sub Category</td>
                                <td><Select name="name" class="add_text_box">
                                		<option>Menu Main Category</option>
                                        <option>Menu Main Category</option>
                                	</Select></td>
                              </tr>
                               <tr>
                                <td>Diet</td>
                                <td><Select name="name" class="add_text_box">
                                		<option>Diet</option>
                                        <option>Menu Main Category</option>
                                	</Select>
                                </td>
                                <td>KOT</td>
                                <td><Select name="name" class="add_text_box">
                                		<option>Kot</option>
                                        <option>Menu Main Category</option>
                                	</Select></td>
                              </tr>
                               <tr>
                                <td>Time</td>
                                <td><input name="name" class="add_text_box" placeholder="Item Name" type="text">
                                </td>
                                <td>Preperation Mode</td>
                                <td><Select name="name" class="add_text_box">
                                		<option>Preperation Mode</option>
                                        <option>Menu Main Category</option>
                                	</Select></td>
                              </tr>
                              <tr>
                                <td>Description</td>
                                <td colspan="3"><textarea name="name" class="add_textarea_box" placeholder="Description"></textarea>
                                </td>
                              </tr>
                              <tr>
                               
                                <td style="text-align:center" colspan="4">Active &nbsp; <span><input type="checkbox" class="popup_chk_bx" ></span></td>
                              </tr>
                            </table>

                    </div>
				
					<a  href="#"><button class="md-save">Save</button></a>
                    <a href="#"><button class="md-close">Close me!</button></a>
				</div>
			</div>
		</div>
        
 <div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Menu 1 View</h3>
				<div>
				
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<table class="popup_add_table view_tab" width="100%" border="0" cellspacing="5">
                              <tr>
                                <td width="22%">Menu Name</td>
                                <td><span class="text_box_entred_view">Tea</span></td>
                                <td width="22%">Short Key</td>
                                <td><span class="text_box_entred_view">TEA</span></td>
                              </tr>
                              <tr>
                                <td>Menu Main Category</td>
                                <td><span class="text_box_entred_view">Beverages</span></td>
                                <td>Menu Sub Category</td>
                                <td><span class="text_box_entred_view">Indian</span></td>
                              </tr>
                               <tr>
                                <td>Diet</td>
                                <td><span class="text_box_entred_view">Veg</span></td>
                                <td>KOT</td>
                                <td><span class="text_box_entred_view">Main Kiychen</span></td>
                              </tr>
                               <tr>
                                <td>Time</td>
                                <td><span class="text_box_entred_view">5</span></td>
                                <td>Preperation Mode</td>
                                <td><span class="text_box_entred_view">General</span></td>
                              </tr>
                              <tr>
                                <td>Description</td>
                                <td colspan="3"><span class="text_box_entred_view_dis">Plain/masala/ginger/cardamom</span></td>
                              </tr>
                              <tr>
                               
                                <td style="text-align:center" colspan="4"><strong>Active</strong> &nbsp; <span>Yes</span></td>
                              </tr>
                            </table>

                    </div>
				
					<!--<a  href="#"><button class="md-save">Save</button></a>-->
                    <a href="#"><button class="md-close">Close me!</button></a>
				</div>
			</div>
		</div>
               
<div class="md-overlay"></div><!-- the overlay element -->


<!--<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>-->

<script src="master_style/menu/js/app.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="master_style/js/menu/app.js"></script>
<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="javascript/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>

<script type="text/javascript" src="js/app.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 8,
					scrolling_items: 2,
					orientation: "horizontal",
					circular: "no",
					autoscroll: "no",
					interval: 5000,
					speed: 500,
					easing: "linear",
					direction: "left",
					start_from: 9
				});
				
		/*$(document).ready(function() 
		
		{
        if (lista1 === 0) {
            $('.als-prev').hide();
            $('.als-next').show();
        } else if (index === $.fn.horizon.defaults.limit - 1) {
            $('.als-prev').show();
            $('.als-next').hide();
        } else {
            $('.als-prev').show();
            $('.als-prev').show();
        }
    });*/
			
				
			});
		</script>
<script>
$(document).ready(function() {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
})();
</script>


<script src="js/jquery.nicescroll.min.js"></script>
   <script>
  $(document).ready(function() {
	        $(".md-trigger").click(function () {
                $("#blr").addClass("blr");
			});
			 $(".md-close").click(function () {
                $("#blr").removeClass("blr");
			});
			// $(".md-overlay").click(function () {
//                $("#blr").removeClass("blr");
//			});
  document.documentElement.style.overflow = 'hidden';
	var nice = $("html").niceScroll({horizrailenabled:false});  // The document page (body)
	$("#div1").html($("#div1").html()+' '+nice.version);
    $("#container").niceScroll({touchbehavior:true}); // First scrollable DIV text_displaying_contain 
	 $("#guest_scroll").niceScroll({touchbehavior:true});
	  $(".menu").niceScroll({touchbehavior:true});
	   $(".text_displaying_contain").niceScroll({touchbehavior:true,horizrailenabled:false});
	    $("#tabs").niceScroll({touchbehavior:true});
		$("#content>div").niceScroll({touchbehavior:true,horizrailenabled:false});
		$("#left_table_scr_cc").niceScroll({touchbehavior:true,horizrailenabled:false});
	
  });


</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		//**** Bootstrap Tooltip ****//	
		$("body").tooltip({ selector: '[data-toggle=tooltip]' });
		
		//**** Slide Panel Toggle ***//
		$(".slide-panel-btn").click( function(){
		$(".slide-panel-btn").toggleClass('active');
		$(".slide-panel").toggleClass('active');
		});
		
		$(".content-sec").click( function(){
		$(".slide-panel").removeClass('active');
		});
		
		//**** Slide Panel Toggle ***//
		/*$(".toggle-menu").click( function(){
		$("body").toggleClass('min-nav');
		});*/
		
		//**** User Comments ****//
		$('#panel-scroll').enscroll({
		showOnHover: true,
		verticalTrackClass: 'track3',
		easingDuration:100,
		verticalHandleClass: 'handle3'
		});	
		
		/* Copyright (c) 2013 ; Licensed  */
		$(document).ready(function(){
		//Sort by first name
		$(function() {
		$.fn.sortList = function() {
		var mylist = $(this);
		var listitems = $('li', mylist).get();
		listitems.sort(function(a, b) {
		var compA = $(a).text().toUpperCase();
		var compB = $(b).text().toUpperCase();
		return (compA < compB) ? -1 : 1;
		});
		$.each(listitems, function(i, itm) {
		mylist.append(itm);
		});
		}
		});

		//Sort by last name
		$(function() {
		$.fn.sortListLast = function() {
		var mylist = $(this);
		var listitems = $('li', mylist).get();
		listitems.sort(function(a, b) {
		var compA = $('.last-name', a).text().toUpperCase();
		var compB = $('.last-name', b).text().toUpperCase();
		return (compA < compB) ? -1 : 1;
		});
		$.each(listitems, function(i, itm) {
		mylist.append(itm);
		});
		}
		});

		//Search filter
		(function ($) {
		// custom css expression for a case-insensitive contains()
		jQuery.expr[':'].Contains = function(a,i,m){
		return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
		};


		function listFilter(searchDir, list) { 
		var form = $("<form>").attr({"class":"filterform","action":"#"}),
		input = $("<input>").attr({"class":"filterinput","type":"text","placeholder":"Live Search Mails"});
		$(form).append(input).appendTo(searchDir);

		$(input)
		.change( function () {
		var filter = $(this).val();
		if(filter) {
		$(list).find("li:not(:Contains(" + filter + "))").slideUp();
		$(list).find("li:Contains(" + filter + ")").slideDown();
		} else {
		$(list).find("li").slideDown();
		}
		return false;
		})
		.keyup( function () {
		$(this).change();
		});
		}


		//Slide Panel Search Email
		$(function () {
		listFilter($("#searchMail"), $("#mail-list"));
		});

		}(jQuery));

		});
		
	});
</script>	




<!-- Script -->

</body>
</html>