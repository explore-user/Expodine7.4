<?php
//include('includes/session.php');	
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashborad</title>
    <link href="css/style_admin.css" rel="stylesheet" />
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/cssCharts.css">
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
    <link rel="stylesheet" href="css/style_admin_hm_style.css">
    <link rel="stylesheet" href="css/mg-space.css">
     <script src="js/jquery-1.10.2.min.js"></script>
<style>
@media (min-width: 1200px) {
.lg-2{width: 12.5% !important;}
}
@media (min-width: 900px) {
.sm-3{width: 14.2%;}
.mg-space{min-height: 125px !important;height:auto !important;}
}

</style>  
</head>
<body class="mg-space-multiple">
 <div  id="container">
	  <?php include "includes/topbar.php"; ?>
  </div> <!--container-->
  
  <div style="width:100%" class="top_site_map_cc ">
     <div class="billgeneration_head">Dashboard</div>
   </div>
<div id="content">
         
         <div class="vert mg-space-init4">
                
                <div class="mg-rows">
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Menu Master" class="mg-trigger"><img class="img-responsive" src="images/ad_menu_master.jpg" alt="">
                        <div class="admin_main_ico_text">Menu Masters</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Master Tables" class="mg-trigger"><img class="img-responsive" src="images/ad_master_tables.jpg" alt="">
                        <div class="admin_main_ico_text">Master Tables</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="General Settings" class="mg-trigger"><img class="img-responsive" src="images/ad_general_setttigs.jpg" alt="">
                        <div class="admin_main_ico_text">General Settings</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Reports" class="mg-trigger"><img class="img-responsive" src="images/ad_report.jpg" alt="">
                        <div class="admin_main_ico_text">Reports</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="User Permission" class="mg-trigger"><img class="img-responsive" src="images/ad_user_permi.jpg" alt="">
                        <div class="admin_main_ico_text">User Permission</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Voucher Payment" class="mg-trigger"><img class="img-responsive" src="images/ad_voucher.jpg" alt="">
                        <div class="admin_main_ico_text">Voucher Payment</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Email Report" class="mg-trigger"><img class="img-responsive" src="images/ad_mail_report.jpg" alt="">
                        <div class="admin_main_ico_text">Email Report</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Change Password" class="mg-trigger"><img class="img-responsive" src="images/ad_change_pass.jpg" alt="">
                        <div class="admin_main_ico_text">Change Password</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="SMS Report" class="mg-trigger"><img class="img-responsive" src="images/ad_sms_report.jpg" alt="">
                        <div class="admin_main_ico_text">SMS Report</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Xml Report" class="mg-trigger"><img class="img-responsive" src="images/ad_xml_report.jpg" alt="">
                        <div class="admin_main_ico_text">Xml Report</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="Inventory" class="mg-trigger"><img class="img-responsive" src="images/ad_inventory.jpg" alt="">
                        <div class="admin_main_ico_text">Inventory</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="" class=""><img class="img-responsive" src="images/ad_home.jpg" alt="">
                        <div class="admin_main_ico_text">Home</div></a>
                    </div>
                    
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="SMS Report" class=""><img class="img-responsive" src="images/ad_sms_report.jpg" alt="">
                        <div class="admin_main_ico_text">SMS Report</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="" class=""><img class="img-responsive" src="images/ad_xml_report.jpg" alt="">
                        <div class="admin_main_ico_text">Xml Report</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="" class=""><img class="img-responsive" src="images/ad_inventory.jpg" alt="">
                        <div class="admin_main_ico_text">Inventory</div></a>
                    </div>
                    <div class="xs-6 sm-3 lg-2 box_new_padd">
                        <a href="#" title="" class=""><img class="img-responsive" src="images/ad_home.jpg" alt="">
                        <div class="admin_main_ico_text">Home</div></a>
                    </div>
                    
                    
                </div>
                <div class="mg-targets ">
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Category</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                   <a href="#"> <img src="images/itares-menu-icon.png" alt="">
                                    <span>Sub Category</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Portion</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>ingredient</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Preference</span></a>
                                </div>
                                 <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Menu</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Country</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>City</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>State</span></a>
                                </div>
                                
                               
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                   <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="row-flex">
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                                <div class="xs-6 sm-3 lg-2 demo-item sub_menu_img_bx">
                                    <a href="#"><img src="images/itares-menu-icon.png" alt="">
                                    <span>Lorem ipsum dolor sit amet.</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>   
         
        </div>
   
    <script src="js/jquery.mg-space.js"></script>
    <script src="js/app_admin_home.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
</body>
</html>


