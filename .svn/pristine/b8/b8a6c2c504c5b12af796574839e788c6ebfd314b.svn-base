<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');  // Check session
include("database.class.php"); // DB Connection class
$database = new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");

include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

if (!isset($_SESSION['timeopen'])) {
    header("location:index.php?msg=1");
}
error_reporting(0);
$_SESSION['mykot'] = "";
unset($_SESSION['ajaxtablesel']);
unset($_SESSION['ajaxprefsel']);
if (!isset($_SESSION['orderbyvalue'])) {
    $_SESSION['orderby'] = "NEW";
    $_SESSION['orderbyvalue'] = "new";
}
unset($_SESSION['floorid_ser']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>KOT</title>
        <link rel="shortcut icon" href="img/favicon.ico">
            <link href="css/menu_master_style.css" rel="stylesheet">
                <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
                    <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
                    <link rel="stylesheet" href="css/kot_new.css">
                        <link rel="stylesheet" media="screen, projection" href="css/fancySelect.css">
                            <link rel="stylesheet" type="text/css" href="javascript/demo.css" />
                            <link rel="stylesheet" type="text/css" href="onload_effect/css/normalize.css" />
                            <link rel="stylesheet" type="text/css" href="onload_effect/css/demo.css" />
                            <link rel="stylesheet" type="text/css" href="onload_effect/css/component.css" />
                            <link rel="stylesheet" type="text/css" href="assets/animate.css" />
                            <link rel="stylesheet" href="assets/new/styles.css" />


                            <script src="js/jquery-1.10.2.min.js"></script>
                            <script src="mn/js/modernizr.custom.js"></script>
                            <script src="js/jquery.nicescroll.min.js"></script>
                            <script>!window.jQuery && document.write(unescape('%3Cscript src="javascript/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>
                            <script src="javascript/demo_kot.js"></script>
                            <script src="javascript/modernizr.custom.34807.js"></script>
                            <script> if (!Modernizr.csstransforms3d)
                                    document.getElementById('information').style.display = 'block';</script>
                            <script src="table/js/toucheffects.js"></script>
                            <script src="js/classie.js"></script>

                            <script src="assets/new/html5shiv.js"></script>
                            <script src="assets/new/rlaccordion.js"></script>
                            <script src="assets/new/scripts.js"></script>
                            <script src="js/dynamic.js"></script> 
                            <script src="js/kot_chklist.js"></script> 

                            <script>


                                $(document).ready(function () {
                                    window.onload = function () {

                                        $('.md-close_pop').click(function () {
                                            $(".olddiv").removeClass("new_overlay");
                                            $('.mynewpopupload').css("display", "none");
                                        });


                                        $("#boxscrol_right1").empty();
                                    }
                                    var nice = $("html").niceScroll();  // The document page (body)
                                    $("#div1").html($("#div1").html() + ' ' + nice.version);
                                    $("#boxscroll").niceScroll({cursorcolor: "#F00", cursoropacitymax: 0.7, touchbehavior: true, boxzoom: false});

                                });

                            </script>

                            <script src="js/fancySelect.js"></script>
                            <script>
                                $(document).ready(function () {
                                    setInterval(function () {
                                        var v = $('#order_number_view').text();
                                        var kotn = (v.substring(1));
                                        var sln = new Array();
                                        if ($('.toserve').hasClass("tr_color_3"))
                                        {
                                            var selected_activities = $('.toserve');
                                            selected_activities.each(function () {
                                                if ($(this).hasClass("tr_color_3"))
                                                {
                                                    var sl = $(this).attr("slno");
                                                    var slval = sl.split("_");
                                                    var slvalue = slval[1];
                                                    if (slvalue != 'undefined' && slvalue != '' && slvalue != null) {
                                                        sln.push(slvalue);
                                                    }
                                                } else
                                                {
                                                    sln = "";
                                                    sln.clear();
                                                }
                                            });
                                        }
                                        if ($('.each_order_sel div').hasClass('order_active'))
                                        {//alert("ref");
                                            $('#setallkot').load('load_div.php?set=setmykot&kot=' + kotn + "&sln=" + sln);
                                        } else
                                        {

                                            $('#order_number_view').text("");
                                            $('#floor_number_view').text("");
                                            $('#tablenumber_view').text("");
                                            $('#setallkot').load('load_div.php?set=setmykot&kot=' + kotn + '&nosl=0');
                                        }
                                        $('#boxscrol2').load('load_kot.php');
                                    }, 3000); // the "3000" 
                                });
                            </script>
                            <script src="js/jquery.jcountdown1.3.min.js" type="text/javascript"></script>


                            <style>
                                body{background-image: url(img/Dark-Blurred-Blue.jpg) !important;background-repeat: round;background-attachment: fixed;-webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important;background-size: cover !important;}
                                p#time{color:#000;text-align: center;}
                                p#time span{display:inline;color:#0C0;font-size:0.8em;}
                                @-moz-document url-prefix() { .kot_right_table_head  table {width:97% !important;} }	
                                .top_site_map_cc {margin-bottom:8px !important;box-shadow: 0px 0px 5px;position: relative;z-index: 9;height: 35px;  
                                                  background-color: rgba(255,255,255,0.1);}
                                .kot_center_cont {height:91.5vh;min-height:695px;padding-top:0;background-color:transparent;}
                                .main-wrapper{min-height:500px;height:80.5vh;padding-bottom:0;height: 74.5vh;}
                                .right_list_bottom_cc{bottom:0}
                                .kot_right_cc {height: 653px;min-height: 87.5vh;}
								.kot_recent_left_cc_1{    height: 82vh;}
                            </style>

                            </head>

                            <body>

                                <div class="nopaddding" id="container">
<?php include "includes/topbar.php"; ?>
                                </div> <!--container-->



                                <!--<div class="sitemap_cc"></div>-->

                                <div class="kot_center_cont">

                                    <div style="width:100%" class="top_site_map_cc ">

                                        <div class="billgeneration_head"><?= $_SESSION['kot_check_list'] ?></div>
                                        <a href="table_selection.php"><div class="bill_his_back_btn">Back</div></a>
                                        <div class="error_feed"></div>

<?php include"includes/new_right_menu.php"; ?>   
                                        <div class="top_al_search_cc loaderror" ></div>
                                        <!-- <div class="top_al_search_cc">
                                                  <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                                         </div>-->
                                    </div>


                                    <div class="col-md-7 kot_left_cc nopaddding">
                                        <div class="kot_list_head"> <span id="totalkotct"> </span> : <span><?= $_SESSION['kot_orders'] ?> <span id="type"><?= $_SESSION['sort'][$_SESSION['orderby']]?></span>

                                            </span>
                                            <div class="kot_sorting_1">
                                                <select style="float:right" id="menu" onchange="sortbyvalues(this.value)">
                                                    <option value=""><?= $_SESSION['kot_sort_by'] ?></option>
                                                    <option value="new"><?=$_SESSION['sort']['NEW']// $_SESSION['kot_new'] ?></option>
                                                    <option value="kot"><?= $_SESSION['sort']['KOT']//$_SESSION['kot_select_kot'] ?></option>
                                                    <option value="pending"><?= $_SESSION['sort']['PENDING DISH']//$_SESSION['kot_pending_dish'] ?> </option>
                                                    <!-- <option value="dine">Dine In Time</option>-->
                                                    <option value="area"><?= $_SESSION['sort']['AREA']//$_SESSION['kot_area'] ?></option>
                                                    <option value="est"><?= $_SESSION['sort']['ESTIMATE TIME']//$_SESSION['kot_estimate_time'] ?></option>
                                                </select>
                                            </div>
                                            <!-- <div class="kot_sorting_text">Sort By</div>-->
                                        </div><!--kot_list_head-->

                                        <div id="boxscrol2"  class="kot_recent_left_cc_1">
                                            <!--left_sorting_cc-->

                                            <?php
                                            if (isset($_REQUEST['orderby'])) {//pending dine area est
                                                if ($_REQUEST['orderby'] == "new") {

                                                    $_SESSION['orderby'] = "NEW";
                                                    $_SESSION['orderbyvalue'] = "new";
                                                } else if ($_REQUEST['orderby'] == "kot") {

                                                    $_SESSION['orderby'] = "KOT";
                                                    $_SESSION['orderbyvalue'] = "kot";
                                                } else if ($_REQUEST['orderby'] == "pending") {

                                                    $_SESSION['orderby'] = "PENDING DISH";
                                                    $_SESSION['orderbyvalue'] = "pending";
                                                } else if ($_REQUEST['orderby'] == "dine") {
                                                    $_SESSION['orderby'] = "DINE IN";
                                                    $_SESSION['orderbyvalue'] = "dine";
                                                } else if ($_REQUEST['orderby'] == "area") {

                                                    $_SESSION['orderby'] = "AREA";
                                                    $_SESSION['orderbyvalue'] = "area";
                                                } else if ($_REQUEST['orderby'] == "est") {

                                                    $_SESSION['orderby'] = "ESTIMATE TIME";
                                                    $_SESSION['orderbyvalue'] = "est";
                                                }
                                            } else {
                                                $orderby = "";
                                            }
                                            ?>
                                            <!--left_sorting_cc-->
                                   <!--<script src="js/jquery.backTop.min.js"></script>
                                           <script>
                                               $(document).ready( function() {
                                                   $('#backTop').backTop({
                                                       'position' : 1600,
                                                       'speed' : 500,
                                                       'color' : 'red',
                                                   });
                                               });
                                           </script> -->  
                                            <!--left_sorting_cc-->
                                            <?php
                                            $array_kot = array();
                                            $array_ord = array();
                                            $curdt = date("Y-m-d");
                                            if ($_SESSION['orderbyvalue'] == "new") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served' 
                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    $l = 1;
                                                    $myarr = array();
                                                    $s = 1;
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {
                                                        $sql_dinin = $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='" . $array_ord[$number] . "' ");
                                                        $num_dinin = $database->mysqlNumRows($sql_dinin);
                                                        $time_dine = 0;
                                                        $noofpsns = 0;
                                                        if ($num_dinin) {
                                                            while ($result_dinin = $database->mysqlFetchArray($sql_dinin)) {
                                                                $time_dine = $result_dinin['ts_dineintime'];
                                                                $date = date($time_dine);
                                                                $time_dinevalue = date("h:i:s", strtotime($date));
                                                            }
                                                        }
                                                        $sql_est = $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='" . $value . "' and ter_dayclosedate='" . $_SESSION['date'] . "' ");
                                                        $num_est = $database->mysqlNumRows($sql_est);
                                                        if ($num_est) {
                                                            while ($result_est = $database->mysqlFetchArray($sql_est)) {
                                                                $esttime = $result_est['esttime'];
                                                            }
                                                        }
                                                        $sql_entry = $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='" . $value . "' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "'");
                                                        $num_entry = $database->mysqlNumRows($sql_entry);
                                                        if ($num_entry) {
                                                            while ($result_entry = $database->mysqlFetchArray($sql_entry)) {
                                                                $entry = $result_entry['tm'];
                                                            }
                                                        } else {
                                                            $entry = "";
                                                        }
                                                        /*  to calculate new    */
                                                        $m = 0;
                                                        $ss = $_SESSION['date'] . " " . $entry; //date("Y-m-d")
                                                        $date2 = strtotime($ss);
                                                        $date1 = time();
                                                        $subTime = $date1 - $date2;
                                                        $m = ($subTime / 60) % 60;
                                                        $date = $_SESSION['date'] . " " . date("H:i:s"); //date("Y-m-d H:i:s");										
                                                        $currentDate = strtotime($date);
                                                        $ss = $_SESSION['date'] . " " . $entry; //"2015-04-29 2:00:15"; date("Y-m-d")
                                                        if ($entry != "") {//echo $ss;
                                                            $ss = date("Y-m-d H:i:s", strtotime($ss));
                                                            $date2 = strtotime($ss);

                                                            $dt = $currentDate - $date2;
                                                            $s = strtotime($dt);
                                                            $dt = ($dt / 60) % 60;
                                                            $k = $esttime - $dt;
                                                            if ($k < 0) {
                                                                $k = 0;
                                                            }
                                                        } else {
                                                            $k = 0;
                                                        }
                                                        $myarr[] = $k;
                                                        if (in_array($k, $myarr)) {
                                                            $v = $k . $s++;
                                                            if (in_array($v, $myarr)) {
                                                                $s++;
                                                            } else {
                                                                $myarr[] = $v;
                                                                $array_kot[$v] = $result_order_tab['ter_kotno'];
                                                                $array_ord[$v] = $result_order_tab['ter_orderno'];
                                                            }
                                                        } else {
                                                            $array_kot[$k] = $result_order_tab['ter_kotno'];
                                                            $array_ord[$k] = $result_order_tab['ter_orderno'];
                                                        }
                                                        $l++;
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                            } else if ($_SESSION['orderbyvalue'] == "kot") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed'  and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served' 
                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {
                                                        $array_kot[] = $result_order_tab['ter_kotno'];
                                                        $array_ord[] = $result_order_tab['ter_orderno'];
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                            } else if ($_SESSION['orderbyvalue'] == "pending") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served'

                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    $l = 1;
                                                    $myarr = array();
                                                    $k = 1;
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {

                                                        $sql_dish_count = $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='" . $result_order_tab['ter_kotno'] . "' and (ter_status='Opened' or ter_status='Served' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "' ");
                                                        $num_dish_count = $database->mysqlNumRows($sql_dish_count);

                                                        $sql_pedng_count = $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='" . $result_order_tab['ter_kotno'] . "' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "'");
                                                        $num_pedng_count = $database->mysqlNumRows($sql_pedng_count);

                                                        //$pend=$num_dish_count - $num_pedng_count;
                                                        $myarr[] = $num_pedng_count;
                                                        if (in_array($num_pedng_count, $myarr)) {
                                                            $v = $num_pedng_count . $k++;
                                                            if (in_array($v, $myarr)) {
                                                                $k++;
                                                            } else {
                                                                $myarr[] = $v;
                                                                $array_kot[$v] = $result_order_tab['ter_kotno'];
                                                                $array_ord[$v] = $result_order_tab['ter_orderno'];
                                                            }
                                                        } else {
                                                            $array_kot[$num_pedng_count] = $result_order_tab['ter_kotno'];
                                                            $array_ord[$num_pedng_count] = $result_order_tab['ter_orderno'];
                                                        }


                                                        $l++;
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                            } else if ($_SESSION['orderbyvalue'] == "dine") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served'
                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    $l = 1;
                                                    $myarr = array();
                                                    $k = 1;
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {
                                                        $sql_dinin = $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='" . $result_order_tab['ter_orderno'] . "' ");
                                                        $num_dinin = $database->mysqlNumRows($sql_dinin);
                                                        $time_dine = 0;
                                                        $noofpsns = 0;
                                                        if ($num_dinin) {
                                                            while ($result_dinin = $database->mysqlFetchArray($sql_dinin)) {
                                                                $time_dine = $result_dinin['ts_dineintime'];
                                                                $date = date($time_dine);
                                                                $time_dinevalue = date("h:i:s", strtotime($date));
                                                                $d = strtotime($date);
                                                                $array_kot[$d] = $result_order_tab['ter_kotno'];
                                                                $array_ord[$d] = $result_order_tab['ter_orderno'];
                                                            }
                                                        }
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                            } else if ($_SESSION['orderbyvalue'] == "area") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served'
                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    $l = 1;
                                                    $myarr1 = array();
                                                    $k = 1;
                                                    $srr = array();
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {
                                                        $sql_tablnames = $database->mysqlQuery("select tm.tr_tableno as ord,fm.fr_floorname as fmname  from tbl_tabledetails as td LEFT JOIN tbl_tablemaster as tm on tm.tr_tableid=td.ts_tableid LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=tm.tr_floorid where td.ts_orderno='" . $result_order_tab['ter_orderno'] . "' ");
                                                        $num_tablnames = $database->mysqlNumRows($sql_tablnames);
                                                        if ($num_tablnames) {
                                                            while ($result_tablnames = $database->mysqlFetchArray($sql_tablnames)) {
                                                                if (!in_array($result_order_tab['ter_kotno'], $srr)) {
                                                                    $srr[] = $result_order_tab['ter_kotno'];
                                                                    $floorname = $result_tablnames['fmname'];
                                                                    $myarr1[] = $floorname;
                                                                    if (in_array($floorname, $myarr1)) {
                                                                        $v = $floorname . $k++;
                                                                        if (in_array($v, $myarr1)) {
                                                                            $k++;
                                                                        } else {
                                                                            $myarr1[] = $v;
                                                                            $array_kot[$v] = $result_order_tab['ter_kotno'];
                                                                            $array_ord[$v] = $result_order_tab['ter_orderno'];
                                                                        }
                                                                    } else {
                                                                        $array_kot[$floorname] = $result_order_tab['ter_kotno'];
                                                                        $array_ord[$floorname] = $result_order_tab['ter_orderno'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                            } else if ($_SESSION['orderbyvalue'] == "est") {
                                                $sql_order_tab = $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='" . $_SESSION['date'] . "' order by ter_entrytime DESC"); //or ter_status='Served'
                                                $num_tab = $database->mysqlNumRows($sql_order_tab);
                                                if ($num_tab) {
                                                    $l = 1;
                                                    while ($result_order_tab = $database->mysqlFetchArray($sql_order_tab)) {

                                                        $sql_est = $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='" . $result_order_tab['ter_kotno'] . "' ");
                                                        $num_est = $database->mysqlNumRows($sql_est);
                                                        if ($num_est) {
                                                            while ($result_est = $database->mysqlFetchArray($sql_est)) {
                                                                $esttime = $result_est['esttime'];
                                                            }
                                                        }
                                                        $sql_entry = $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='" . $result_order_tab['ter_kotno'] . "' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "'");
                                                        $num_entry = $database->mysqlNumRows($sql_entry);
                                                        if ($num_entry) {
                                                            while ($result_entry = $database->mysqlFetchArray($sql_entry)) {
                                                                $entry = $result_entry['tm'];
                                                            }
                                                        }
                                                        /*  to calculate new    */
                                                        $m = 0;
                                                        $ss = $_SESSION['date'] . " " . $entry; //date("Y-m-d")
                                                        if ($entry != "") {//echo $ss;
                                                            $ss = date("Y-m-d H:i:s", strtotime($ss));
                                                        }
                                                        $date2 = strtotime($ss);
                                                        $date1 = time();
                                                        $subTime = $date1 - $date2;
                                                        $m = ($subTime / 60) % 60;
                                                        $date = $_SESSION['date'] . " " . date("H:i:s"); //date("Y-m-d H:i:s");										
                                                        $currentDate = strtotime($date);

                                                        $ss = $_SESSION['date'] . " " . $entry; //"2015-04-29 2:00:15";date("Y-m-d")
                                                        $date2 = strtotime($ss);

                                                        $dt = $currentDate - $date2;
                                                        $s = strtotime($dt);
                                                        $dt = ($dt / 60) % 60;
                                                        $k = $esttime - $dt;
                                                        if ($k < 0) {
                                                            $k = 0;
                                                        }
                                                        $array_kot[$k . "" . $l] = $result_order_tab['ter_kotno'];
                                                        $array_ord[$k . "" . $l] = $result_order_tab['ter_orderno'];
                                                        $l++;
                                                    }
                                                }
                                                ksort($array_kot);
                                                ksort($array_ord);
                                                //	print_r($array_kot);	  
                                            }
                                            $f = 0;
                                            $count = count($array_kot);
                                            ?>
                                            <script>
                                                $(document).ready(function () {
                                                    $('#totalkotct').text(<?= $count ?>);
                                                });
                                            </script>  
                                            <?php
                                            foreach ($array_kot as $number => $value) {
                                                $sql_tablnames = $database->mysqlQuery("select tm.tr_tableno as ord,fm.fr_floorname as fmname,fm.fr_floorid,td.ts_tableid  from tbl_tabledetails as td LEFT JOIN tbl_tablemaster as tm on tm.tr_tableid=td.ts_tableid LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=tm.tr_floorid where td.ts_orderno='" . $array_ord[$number] . "' ");
                                                $num_tablnames = $database->mysqlNumRows($sql_tablnames);
                                                if ($num_tablnames) {
                                                    $h = 0;
                                                    while ($result_tablnames = $database->mysqlFetchArray($sql_tablnames)) {
                                                        $prf = $database->show_tabledetails_total($array_ord[$number], $result_tablnames['ts_tableid']);
                                                        $floorname=$result_tablnames['fmname'];
                                                        
                                                        if($_SESSION['main_language']!='english'){
                
                                                        $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_tablnames['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");

                                                        //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                        $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                         if($num_arabfloor){
                                                            while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                        $floor_name=$result_arabfloor['f_floor_name'];

                                                        }}}
                                                        $table_name=$result_tablnames['ord'];
                                                        
//                                                        $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                                        $response_table['messages'] = stream_get_contents($fptable);
//                                                        //var_dump($response_table['messages']);
//                                                        $resu_table= json_decode($response_table['messages'],true);
//                                                        //var_dump($resu_table['table_id'][0]);
//                                                        $table_count=count($resu_table['table_id']);
//                                                        // echo $table_count;
//                                                        for($t=0;$t<$table_count;$t++){
//                                                        if($result_tablnames['ts_tableid']==$resu_table['table_id'][$t])
//                                                        {
//                                                            $table_name=$resu_table['table_name'][$t];
//                                                        }
//                                                        }
                                                        
                                                        
                                                        
                                                        if ($h == 0) {
                                                            $tablename = $table_name  . " (" . $prf['ts_tableidprefix'] . ")";//$result_tablnames['ord']
                                                        } else {
                                                            $tablename = $tablename . "," . $table_name . " (" . $prf['ts_tableidprefix'] . ")";
                                                        }
                                                        //$floorname = $_SESSION[$result_tablnames['fr_floorid']]['floormaster'];//$result_tablnames['fmname'];
                                                        
//                                                        $floorname="";
//                                                        $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                                        //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//                                                        $response_floor['messages'] = stream_get_contents($fpfloor);
//                                                        //echo  $response['messages'];
//                                                        $resu_floor= json_decode($response_floor['messages'],true);
//                                                        //var_dump($resu_floor);
//                                                        $floor_count=count($resu_floor);
//                                                        for($f=0;$f<$floor_count;$f++)
//                                                        {
//                                                            if($result_tablnames['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                            $floorname=$resu_floor['floor_name'][$f];
//                                                        }  
//                                    
//                                                        }
                                                        
                                                        
                                                        
                                                        $h++;
                                                    }
                                                }
                                                $sql_dish_count = $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='" . $value . "' and (ter_status='Opened' or ter_status='Served' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "'");
                                                $num_dish_count = $database->mysqlNumRows($sql_dish_count);

                                                $sql_pedng_count = $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='" . $value . "' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "'");
                                                $num_pedng_count = $database->mysqlNumRows($sql_pedng_count);
                                                $pend = $num_dish_count - $num_pedng_count;
                                                $sql_dinin = $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='" . $array_ord[$number] . "' ");
                                                $num_dinin = $database->mysqlNumRows($sql_dinin);
                                                $time_dine = 0;
                                                $noofpsns = 0;
                                                if ($num_dinin) {
                                                    while ($result_dinin = $database->mysqlFetchArray($sql_dinin)) {
                                                        $time_dine = $result_dinin['ts_dineintime'];
                                                        $date = date($time_dine);
                                                        $time_dinevalue = date("h:i:s", strtotime($date));
                                                    }
                                                }
                                                $sql_est = $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='" . $value . "' and ter_dayclosedate='" . $_SESSION['date'] . "' ");
                                                $num_est = $database->mysqlNumRows($sql_est);
                                                if ($num_est) {
                                                    while ($result_est = $database->mysqlFetchArray($sql_est)) {
                                                        $esttime = $result_est['esttime'];
                                                    }
                                                }
                                                //echo "select max(ter_entrytime) as tm from tbl_tableorder where ter_tableid='".$result_table_sel['tr_tableid']."' and ter_status='Opened'";
                                                $sql_entry = $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='" . $value . "' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='" . $_SESSION['date'] . "' ");
                                                $num_entry = $database->mysqlNumRows($sql_entry);
                                                if ($num_entry) {
                                                    while ($result_entry = $database->mysqlFetchArray($sql_entry)) {
                                                        $entry = $result_entry['tm'];
                                                        //$entime=$result_entry['ter_entrytime'];
                                                    }
                                                } else {
                                                    $entry = "";
                                                }
                                                /*  to calculate new    */
                                                $m = 0;
                                                $ss = $_SESSION['date'] . " " . $entry; //date("Y-m-d")
                                                $date2 = strtotime($ss);
                                                $date1 = time();
                                                $subTime = $date1 - $date2;
                                                $m = ($subTime / 60) % 60;
                                                $date = $_SESSION['date'] . " " . date("H:i:s"); //date("Y-m-d H:i:s");										
                                                $currentDate = strtotime($date);
                                                $ss = $_SESSION['date'] . " " . $entry; //"2015-04-29 2:00:15";date("Y-m-d")
                                                if ($entry != "") {//echo $ss;
                                                    $ss = date("Y-m-d H:i:s", strtotime($ss));
                                                    $date2 = strtotime($ss);

                                                    $dt = $currentDate - $date2;
                                                    $s = strtotime($dt);
                                                    $dt = ($dt / 60) % 60;
                                                    $k = $esttime - $dt;
                                                    if ($k < 0) {
                                                        $k = 0;
                                                    }
                                                } else {
                                                    $k = 0;
                                                }
                                                ?>
                                                <span  id="<?= $k ?>"> 
                                                    <a href="#"  class="each_order_sel " myorder="ord_<?= $array_ord[$number] ?>" mykot="kt_<?= $value ?>"> 
                                                        <div class="kot_list_item <?php if ($_SESSION['mykot'] == $value) { ?> order_active <?php } ?> myid<?= $array_ord[$number] ?> <?php if (($k == 0 || $k < 0) && $num_pedng_count >= 1) { ?> odr_2nd_active <?php } ?>  <?php if ($k != 0 && $k <= 5) { ?>blink_me <?php } ?>">
                                                <?php if ($subTime <= 500) { ?>
                                                                <div class="kot_new_notification"><?=$_SESSION['kot_new']?></div>
                                                <?php } ?>
                                                            <div class="kot_list_order_head"><?=$_SESSION['kot_kot_no']?> - <?= $value ?></div>
                                                            <div class="kot_list_item_head">
                                                                <span id="setfloor_<?= $array_ord[$number] ?>"><?= $floorname ?></span>
                                                                <!--Table- --><span id="settable_<?= $array_ord[$number] ?>"><?= $tablename ?></span></div>
                                                            <span class="table_detail_kot">
                                                                <span><?=$_SESSION['menu_order_selected_dinein']?> - <?= $time_dinevalue ?></span>
                                                                <span><?=$_SESSION['kot_est_timeleft']?> - <p id="timese<?= $f ?>" style="display:block !important"><?= $k ?></p></span>
                                                            </span><!--table_detail_kot-->
                                                            <div class="total_cont_cc_kot">
                                                                <span><?=$_SESSION['kot_total_count']?> - <?= $num_dish_count ?></span>
                                                                <span><?=$_SESSION['kot_pending_dish']?> - <?= $num_pedng_count ?></span>
                                                            </div><!--total_cont_cc_kot-->
                                                        </div><!--kot_list_item-->
                                                    </a>
                                                </span>
                                                <?php $f++;
                                            }// } ?>
                                            <a id="backTop"><?=$_SESSION['kot_backtop']?></a> 

                                        </div><!--kot_recent_left_cc_1-->  
                                        <input type="hidden" name="kot" id="kotmsg1" value="<?= $_SESSION['kot_error_iten_serve'] ?>">
                                            <input type="hidden" name="kot" id="kotmsg2" value="<?= $_SESSION['kot_error_update_ready'] ?>"...>
                                            <input type="hidden" name="kot" id="kotmsg3" value="<?= $_SESSION['kot_error_click_item'] ?>">
                                                <div  class="right_list_botoom_inform_cc kot_left_inform_cc">
                                                    <div  class="kot_inform_main">
                                                        <div style="background-color:rgb(208, 28, 28)" class="inform_color"></div>
                                                        <div class="inform_name_txt">0 <?= $_SESSION['kot_est_time'] ?></div>
                                                    </div><!--kot_inform_main-->
                                                    <div class="kot_inform_main">
                                                        <div style="background-color:#fff" class="inform_color"></div>
                                                        <div class="inform_name_txt"><?= $_SESSION['kot_new'] ?> </div>
                                                    </div>
                                                </div><!--kot_inform_main-->
                                                <!--Pending_item End-->
                                                </div><!--kot_left_cc-->
                                                <div class="col-md-5 kot_right_cc nopaddding">
                                                    <div style="text-align:left;padding-left:8px;" class="right_list_head"><?= $_SESSION['kot_table_details'] ?>
                                                        <div class="loaderror"  style="display:none"></div>	
                                                    </div>
                                                    <div class="right_changing_div_1">
                                                        <div >
                                                            <main  class="main-wrapper">	
                                                                <div >
                                                                    <div class="h3_old_style">
                                                                        <div style="border:0" class="right_table_inform_div" ><?= $_SESSION['kot_kot_no'] ?> <span id="order_number_view"></span></div>
                                                                        <div class="right_table_inform_div" > <?= $_SESSION['kot_area'] ?> <span id="floor_number_view"></span> </div>
                                                                        <div class="right_table_inform_div" ><?= $_SESSION['kot_table_no'] ?><span id="tablenumber_view"></span></div></div>

                                                                    <div id="acc_1">
                                                                        <span id="setallkot">
                                                                            <span id="boxscrol_right1" class="kot_right_table">

                                                                                <table class="scroll" width="100%" border="0" cellspacing="0">
                                                                                    <thead style="background-color: #333;">
                                                                                        <tr>
                                                                                            <th width="10%"><?= $_SESSION['kot_slno'] ?></th>
                                                                                            <th width="60%"><?= $_SESSION['kot_dish_name'] ?></td>
                                                                                                <th width="20%">Unit</th>
                                                                                                <th width="10%"><?= $_SESSION['kot_qty'] ?></th>
                                                                                                <th width="20%"><input title="Select All" id="selecctall" class="chekbx" type="checkbox"></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                </table>
                                                                            </span> </span>
                                                                    </div>
                                                                </div><!-- end of second -->
                                                            </main><!-- end of main-wrapper -->
                                                        </div>
                                                        <!--kot_right_table-->
                                                        <div class="right_list_bottom_cc">
                                                            <div class="right_list_botoom_inform_cc">
                                                                <div  class="kot_inform_main">
                                                                    <div style="background-color:#D0531C" class="inform_color"></div>
                                                                    <div class="inform_name_txt"><?= $_SESSION['kot_ready'] ?></div>
                                                                </div><!--kot_inform_main-->
                                                                <div class="kot_inform_main">
                                                                    <div style="background-color:#339D80" class="inform_color"></div>
                                                                    <div class="inform_name_txt"><?= $_SESSION['kot_served'] ?></div>
                                                                </div><!--kot_inform_main-->
                                                                <!--<div class="kot_inform_main">
                                                                        <div class="inform_color"></div>
                                                                    <div class="inform_name_txt">Printed</div>
                                                                </div>--><!--kot_inform_main-->
                                                            </div><!--right_list_botoom_inform_cc-->
                                                            <div   class="kot_sub_button"> 
                                                                <div id="btn_01" class="kot_pri_btn" style="width:32% !important;float:left">
                                                                    <a href="#" class="print_kot" ><?= $_SESSION['kot_print_button'] ?></a>
                                                                </div>
                                                                <div id="btn_1" class="kot_sub_btn" style="width:33% !important;float:left">
                                                                    <a  href="#" id="readytoserve" ><?= $_SESSION['kot_ready_button'] ?></a>
                                                                </div>
                                                                <div id="btn_1" class="kot_sub_btn" style="width:35% !important;float:left">
                                                                    <a  href="#" id="kotserveditems" ><?= $_SESSION['kot_served_button'] ?></a>
                                                                </div>

                                                            </div>
                                                        </div><!--right_list_bottom_cc-->
                                                    </div><!--right_changing_div_1-->  
                                                </div><!--kot_right_print_section-->
                                                </div><!--right_changing_div_2-->  
                                                </div><!--kot_right_cc-->
                                                </div><!--kot_center_cont-->





                                                <script src="js/jquery.backTop.min.js"></script>
                                                <script>
                                                $(document).ready(function () {
                                                    $('#backTop').backTop({
                                                        'position': 1600,
                                                        'speed': 500,
                                                        'color': 'red',
                                                    });
                                                });
                                                </script> 
                                                <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                                                <script src="js/jquery.cookie.js"></script> 
                                                <script src="js/load_kot_chk.js"></script>

                                                <script type="text/javascript">
                                                // Change the selector if needed
                                                var $table = $('table.scroll'),
                                                        $bodyCells = $table.find('tbody tr:first').children(),
                                                        colWidth;
                                                // Adjust the width of thead cells when window resizes
                                                $(window).resize(function () {
                                                    // Get the tbody columns width array
                                                    colWidth = $bodyCells.map(function () {
                                                        return $(this).width();
                                                    }).get();

                                                    // Set the width of thead columns
                                                    $table.find('thead tr').children().each(function (i, v) {
                                                        $(v).width(colWidth[i]);
                                                    });
                                                }).resize(); // Trigger resize handler
                                                </script>
                                                </body>
                                                </html>
