<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=27;


if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['value'])) {
    $sid = $_REQUEST['value'];


    $er = '';
    if (isset($_REQUEST['id'])) {
        $er = $_GET['id'];
        echo $er;

        $delete_tbl_fn = $database->mysqlQuery("DELETE FROM tbl_function_details WHERE fd_id='" . $er . "'");
        $delete_tbl_fn_mn = $database->mysqlQuery("DELETE FROM tbl_function_details_menu WHERE fdm_function_id='" . $er . "'");
        header('Location: banquet_list.php');
        /* $ff = $database->mysqlQuery("DELETE FROM tbl_kotcountermaster WHERE kr_kotcode = '" .$_REQUEST['id']."'");*/

    }
}
?>
<!doctype html>
<html ng-app="website">
<head>
    <meta charset="utf-8">
    <title>Reminders</title>
    <meta name="description" content="">
    <link href="images/favicon.png" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/default.date.css">
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
    </style>

    <style>
        .new_overlay{
            width:100%;
            height:100%;
            background-color:rgba(0,0,0,0.8);
            position:fixed;
            z-index:999;
            height: 100%;
        }
        #left_table_scr_cc {
            width: 100%;
            min-height: 380px;
            height: 78vh;}
        .main_banquet_contant_head{background-color:#fff}
        .responstable th, .responstable td{padding:5px;}
        .main_banquet_form_name{padding-top:0}
        .main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
        .menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
        ::-webkit-scrollbar{height:20px;}
        .bnq_dtail_table td{
            line-height:25px !important;
            font-size:14px !important;
            color:#333;
            padding:5px;
            border:solid 1px #ccc;
            text-align:center;
            min-width:inherit !important;
        }
        .bnq_dtail_table th{
            line-height:25px !important;
            font-size:14px !important;
            color:#333;
            padding:5px;
            border:solid 1px #ccc;
            text-align:center;
            min-width:inherit !important;
            background-color:#000;
            color:#fff;
            border:0;
            font-family:Arial, Helvetica, sans-serif
        }
        .banq_inv_right_table td{
            line-height:17px;
            font-size:13px;
            color:#333;
            padding:3px;
            border:solid 1px #ccc;
            text-align:center;
            min-width:inherit;
        }
        .banq_inv_right_table th{
            line-height:17px;
            font-size:13px;
            color:#333;
            padding:3px;
            border:solid 1px #ccc;
            text-align:center;
            min-width:inherit;
            background-color: #b25c03;
            color:#fff;
            border:0;
        }
        .main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
        .main_banquet_form_box{margin-bottom:7px}
    </style>



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
                        <li><a style="cursor:pointer">Reminder</a></li>
                        <li style="float:right;"><a href="banquet_registration.php" style="cursor:pointer;font-size:15px;"><i class="ti-arrow-left"></i> &nbsp; Banquet Register</a></li>
                    </ul>
                </div><!-- breadcrumbs -->
                <div class="content-sec">

                    <div class="main_banquet_contant_cc">

                        <div class="main_banquet_contant_head">
                            <span style="margin: 10px 0;">Filter by</span>

                        	<span style="width:13%">
                            	<div class="main_banquet_form_box">
                                    <div class="main_banquet_form_name"> From</div>
                                    <div class="main_banquet_form_textbox">
                                        <input id="datepickerfrom"  name="datepickerfrom" class="main_banquet_form_textbox_input datepicker" type="text" placeholder="DD/MM/YY" autofocuss>


                                    </div>
                                </div>
                             </span>
                             <span style="width:13%">
                            	<div class="main_banquet_form_box">
                                    <div class="main_banquet_form_name"> To</div>
                                    <div class="main_banquet_form_textbox">
                                        <input id="datepickerto" name="datepickerto" class="main_banquet_form_textbox_input datepicker"  type="text" placeholder="DD/MM/YY" autofocuss>

                                    </div>
                                </div>
                             </span>

                            <span style="width:70px"><div style="width:100%" class="menut_add_bq_btn" id="filtering_bnqt" name="filtering_bnqt" onclick="return filter_dates();">Submit</div></span>

                        </div>
                        <div class="main_banquet_contant" style="padding-top:0" id="del_ff">
                            <div id="left_table_scr_cc">
                                <table class="responstable">
                                    <thead>
                                    <tr>
                                        <th width="5%">Function Date</th>
                                        <th width="8%">Name </th>
                                        <th width="18%">Email </th>
                                        <th width="25%">contact</th>
                                        <th width="10%">Function Type</th>

                                    </tr>
                                    </thead>
                                    <tbody id="table_idz">
                                    <?php
                                    $sql_login  =  $database->mysqlQuery("select a.*,b.ft_name,c.fv_name from tbl_function_details a LEFT JOIN tbl_function_type b ON a.fd_function_type=b.ft_id LEFT JOIN tbl_function_venue c ON a.fd_venue=c.fv_id where fd_id NOT LIKE '%temp_%' and fd_status != 'Cancelled' ORDER BY fd_id ASC ");
                                    //echo "select * from tbl_function_details  LEFT JOIN  tbl_function_type ON tbl_function_details.fd_id=tbl_function_type.ft_id LEFT JOIN tbl_function_venue ON tbl_function_details.fd_id=tbl_function_venue.fv_id";
                                    $num_login   = $database->mysqlNumRows($sql_login);
                                    if($num_login){
                                        while($result_login  = $database->mysqlFetchArray($sql_login))
                                        {
                                            $id = $result_login['fd_id']; //echo $id;
                                            $date = $result_login['fd_date'];
                                            $dates = date('d-m-Y',strtotime($date));
                                            ?>
                                            <tr>
                                                <td><?=$dates?></td>
                                                <td><?=$result_login['fd_customer']?></td>
                                                <td><?=$result_login['fd_email']?></td>
                                                <td><?=$result_login['fd_mobile_1']?></td>
                                                <td><?=$result_login['ft_name']?></td>


                                            </tr>

                                        <?php } } ?>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--container-->
</div>

<!---banquet_listting_edit_popup-->

<div class="md-overlay"></div><!-- the overlay element -->
<div id="container_date"></div>
<script src="js/picker.js"></script>
<script src="js/picker.date.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/crptmd5.js"></script>
<script type="text/javascript">

    $('.datepicker').pickadate()

</script>
<script>


</script>

<script>
    function filter_dates()
    {
        var from_date = $("#datepickerfrom").val();
        var to_date = $("#datepickerto").val();

        var datastring = "datefrom="+$("#datepickerfrom").val()+"&dateto="+$("#datepickerto").val();
        $.ajax({
            type: "POST",
            url: "reminderload_filter.php",
            data: datastring,
            success: function (data)
            {
                var arr = data.split("+");
                var a=JSON.parse(arr[0]);
                $("#table_idz").html('');
               $.each(a, function(i,record) {

                    $("#table_idz").append('<tr>'+
                   '<td>'+record.fd_date+'</td>'+
                   '<td>'+record.fd_customer+'</td>'+
                   '<td>'+record.fd_email+'</td>'+
                   '<td>'+record.fd_mobile_1+'</td>'+'' +
                   '<td>'+record.ft_name +'</td>'+'</tr>');

                });
            }
        });

        return true;
    }
</script>


</body>
</html>