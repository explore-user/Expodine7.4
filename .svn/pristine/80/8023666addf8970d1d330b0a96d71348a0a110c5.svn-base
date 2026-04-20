<!DOCTYPE html>
<?php
session_start();
include("..\database.class.php"); 
$database	= new Database();

 //  include('../email/km_smtp_class.php');
 // require_once('../Mailer/PHPMailerAutoload.php');
 //error_reporting(0);


$date_st=date('d');

if($date_st=='01'){
    
   $sql_login  =  $database->mysqlQuery(" update tbl_store_stock set ts_last_qty_on_1st=ts_qty ,ts_last_weight_on_1st=ts_weight Where ts_store!='' and (ts_last_qty_on_1st!=ts_qty or ts_last_weight_on_1st!=ts_weight)  ");  

}



?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>Inventory </title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">
    <link href="assets/css/content.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/jquery-ui-1.8.2.custom.css" />
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script>
    <script src="assets/js/modernizr.min.js"></script>


    <style>
    .widget-style-2 i {
        padding: 20px 20px;
    }

    .bx-clr1 i {
        background: #ff8761 !important;
        color: #fff !important
    }

    .bx-clr2 i {
        background: #57bdde !important;
        color: #fff !important
    }

    .bx-clr3 i {
        background: #b198dc !important;
        color: #fff !important
    }

    .bx-clr4 i {
        background: #6dc7be !important;
        color: #fff !important
    }

    .widget-panel {
        padding: 20px 20px;
    }

    .widget-chart ul li {
        width: 24%;
    }

    .content-page>.content {
        margin-bottom: 8px
    }

    .inner-textbox-effect .checkbox-primary input:focus~label,
    input:valid~label {
        top: 0;
        font-size: 12px;
    }

    .send_greeting_btn {
        background-color: #57bdde;
        font-weight: 600;
        letter-spacing: 0.05em;
        padding: 0.5% 2%;
        color: #fff;
        border-radius: 3px;
        font-size: 13px;
    }

    .card-box .nicescroll {
        overflow: hidden
    }

    .widget-panel {
        min-height: 100px
    }

    .loyalty_mgmt_head {
        width: 200px;
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        top: 13px;
        z-index: 9999;
        color: #000;
        font-size: 18px;
    }
    </style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <?php include( 'includes/header.php') ?>
        <!-- Top Bar End -->
        <div class="loyalty_mgmt_head">
            <div class=""><span classs=""
                    style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 2rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(121deg, #ff833e, #653eff)!important;padding: 0.7rem;position: fixed;margin-top: -0.75rem;text-transform: capitalize;font-weight: 700;-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Inventory</span>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <div class="inv-dash-content">
                        <div class="inv-total-product">
                            <div style="display: flex;justify-content: space-between;margin-bottom:1rem;">

                                <h2 style="margin-bottom:1rem;">Product Details</h2>
                            </div>
                            <div class="inv-fin-raw" id="product_details">
                            </div>
                            <!-- <img style="width: 10rem;height: 10rem;opacity: 75%; margin-right: 1.5rem;margin-top: -5rem;z-index: -1;" src="assets/img/empty_cart.svg" alt=""> -->
                            <?php $query = $database->mysqlQuery("SELECT ti_id,ti_name,ti_type FROM `tbl_inv_kitchen` WHERE ti_status='Y' ORDER BY ti_type"); ?>
                            <div style="display: flex;justify-content: space-between;margin-top: 1rem;margin-bottom: 0.5rem;">
                                <h2>Stock Details</h2>
                                <select style="margin-top: -4px; width:25% ; display:none;" name="store" id="store"
                                    onchange="stock_details()">
                                    <?php while($row = mysqli_fetch_array($query)){ ?>
                                    <option value="<?=$row['ti_id']?>"><?=$row['ti_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="inv-fin-raw" id="stock_details">
                            </div>
                          </div>
                        <div class="inv-alert" style="display:none;">

                            <?php $query = $database->mysqlQuery("SELECT ti_id,ti_name,ti_type FROM `tbl_inv_kitchen` WHERE ti_status='Y' ORDER BY ti_type"); ?>
                            <div style="display: flex;justify-content: space-between;margin-bottom:1rem;">
                                <h2>Stock Details</h2>
                                <select style="margin-top: -4px; width:25% ; display:none;" name="store" id="store"
                                    onchange="stock_details()">
                                    <?php while($row = mysqli_fetch_array($query)){ ?>
                                    <option value="<?=$row['ti_id']?>"><?=$row['ti_name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="inv-fin-raw" id="stock_details">
                            </div>
                            <!-- <img style="width: 10rem;height: 10rem;margin-top: -5rem;z-index: -1;opacity: 75%;margin-right: 1.5rem;" src="assets/img/person_cart.svg" alt=""> -->
                        </div>


                        <div class="inv-chart-big">
                            <h4>Profit Details <span id="no_datas" style="color: red;"></span></h4>
                            <div id="profit_chart" style=""></div>
                        </div>
                        <div class="inv-chart">
                            <h4>Food Cost Chart</h4>
                            <div id="food_cost_chart" style="height:158px;"></div>
                        </div>
                        <div class="inv-table">
                            <h4>Purchase Details</h4>
                            <div style="overflow: auto; height: 17rem;" id="purchase_data">

                            </div>
                        </div>


                        <div class="inv-table inv-table1">
                            <h4 style="display:flex;">History <span
                                    style="margin-left:auto; padding-right:1rem;"><?php echo date('F Y');?> </span></h4>
                            <div style="overflow: auto; height: 17rem;" id="history_table">

                            </div>
                        </div>

                    </div>
                </div>


            </div>


        </div>
        <!-- END wrapper -->

        <script>
        // setInterval(stock_details, 7000);
        // setInterval(product_details, 7000);
        // setInterval(purchase_details, 7000);

        product_details();

        purchase_details();

        stock_details();
        history_table();
        profit_chart();

        food_cost_chart();
        
        function reorder_nav(){
            
            window.location.href='store_stock.php?from_id=dash';
            
        }
        
        

        function purchase_details(date) {

            var set = 'get_purchase_data';
            $.ajax({
                url: "load_index.php",
                type: "POST",
                data: {
                    'set': set,
                    'date': date
                },
                success: function(data2) {
                    //console.log(data2);
                    $('#purchase_data').html(data2);
                    stock_details();

                }
            });
        }


        function history_table() {
            var set = 'history_table';
            $.ajax({
                url: 'load_index.php',
                type: 'POST',
                data: {
                    'set': set
                },
                success: function(history) {

                    //  console.log(history);
                    $('#history_table').html(history);
                }
            })
        }

        function product_details(date) {
            var set = "product_details";
            $.ajax({
                url: "load_index.php",
                type: "POST",
                data: {
                    'set': set,
                    'date': date
                },
                success: function(data1) {
                    $('#product_details').html(data1);
                }
            });
        }

        function stock_details(date) {
            var store = $("#store").val();

            var set = "stock_details";
            $.ajax({
                url: 'load_index.php',
                type: 'POST',
                data: {
                    'set': set,
                    'date': date,
                    'store': store
                },
                success: function(data2) {
                    console.log(data2);

                    $('#stock_details').html(data2);
                }

            })
        }



        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(profit_chart);



        function profit_chart() {
            var set = 'profit_chart';
            $.ajax({
                url: "load_index.php",
                type: "POST",
                data: {
                    set: set
                },
                dataType: "JSON",
                success: function(datas) {

                    //         if(datas.length<=1)
                    // {

                    //   $("#no_datas").html(" * No Results Found");
                    // }
                    // else
                    // {
                    //      $("#no_data").html("");
                    // }
                    //dynamic code begin
                    var gdata = [
                        ['Date', 'Sales', 'Expense', 'Profit/Loss', {
                            role: 'style'
                        }]
                    ];
                    //  var total_count=0;
                    for (var st = 0; st < datas.length; st++) {
                        var date = datas[st].date;
                        var total = datas[st].total;
                        var expense = datas[st].expense;
                        var loss = datas[st].loss;
                        gdata.push([date, parseFloat(total), parseFloat(expense), parseFloat(loss),
                            'stroke-color: #000; stroke-width: 0; '
                        ]);
                    }
                    var data = google.visualization.arrayToDataTable(gdata);
                    //dynamic code end

                    var options = {
                        //title: 'Monthly Installations',
                        hAxis: {
                            title: 'Date',
                            titleTextStyle: {
                                color: '#333'
                            }
                        },
                        // vAxis: {title: 'Profit',minValue: 1},
                        // bar: {groupWidth: "30%"},
                        legend: {
                            position: "top"
                        },
                        //legend: { position: "absalute" },


                        colors: ['#6c87ec', '#65C18C', '#e1335f'],
                        backgroundColor: {
                            fill: 'transparent'
                        },
                    };


                    var chart = new google.visualization.ColumnChart(document.getElementById(
                        'profit_chart'));
                    chart.draw(data, options);
                },
                error: function(data) {
                    console.log(data);
                }
            });

        }

        google.charts.setOnLoadCallback(food_cost_chart);

        function food_cost_chart() {
            var set = 'food_cost_chart';
            $.ajax({
                url: 'load_index.php',
                type: 'POST',
                data: {
                    set: set
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    var gdata = [
                        ['Month', 'Food Cost', {
                            role: 'style'
                        }]
                    ];

                    for (var st = 0; st < data.length; st++) {
                        var month = data[st].month;
                        var fc = data[st].food_cost;
                        gdata.push([month, parseFloat(fc), 'stroke-color: #000; stroke-width: 0; ']);
                    }

                    console.log(gdata);
                    var data = google.visualization.arrayToDataTable(gdata);

                    var options = {

                        hAxis: {
                            title: 'Months',
                            titleTextStyle: {
                                color: '#333'
                            }
                        },
                        vAxis: {
                            title: 'Food Cost %',
                            minValue: 0
                        },
                        legend: {
                            position: "top"
                        },
                        colors: ['#6c87ec'],
                        backgroundColor: {
                            fill: 'transparent'
                        },
                    };
                    var chart = new google.visualization.AreaChart(document.getElementById(
                        'food_cost_chart'));
                    chart.draw(data, options);
                },
                error: function(data) {
                    // console.log(data);
                }
            });

        }

        var resizefunc = [];

        window.onload = function() {

            var dataString = 'set_point_dashboard=dashboard_show';
            $.ajax({
                type: "POST",
                url: "load_index.php",
                data: dataString,
                success: function(data) {
                    $('#point_show').html(data);

                }
            });


            //  $('#bday1').click(function() {

            //         var checkedBox = $(this).attr("checked");
            //             if (checkedBox === true) {



            //                 $("#anvy1").attr('checked', false);
            //             } else {
            //                 $('#anniversary').hide();
            //                   $('#birthday').show();
            //                 $("#anvy1").removeAttr('checked');                    
            //             }
            //         });

            // $('#anvy1').click(function() {

            // var checkedBox = $(this).attr("checked");
            //     if (checkedBox === true) {


            //         $("#bday1").attr('checked', false);                     
            //     } else {
            //         $('#anniversary').show();
            //           $('#birthday').hide();
            //         $("#bday1").removeAttr('checked');                       
            //     }
            // });



        }
        var auto_refresh = setInterval(
            function() {
                var dataString = 'set_point_dashboard=dashboard_show';
                $.ajax({
                    type: "POST",
                    url: "load_index.php",
                    data: dataString,
                    success: function(data) {
                        $('#point_show').html(data);

                    }
                });
            }, 7000);



        //   function list_loyalty_bill(i){


        //      var data="set=loyalty_list_bill&loy_id_list="+i;

        //         $.ajax({
        //         type: "POST",
        //         url: "customer_detail.php",
        //         data: data,
        //         success: function(data)
        //         {
        //           window.location.href="customer_detail.php";

        //         }
        //     });

        // }      

        // function greetings(){

        //      if(document.getElementById('bday1').checked) {

        //           var b_number=$('#number_b').attr('num_b');
        //            var b_mail=$('#number_b').attr('mail_b');

        //          if(b_number!="" || b_mail!=""){

        //          var data="sms_text_bday=sms_bday&b_number="+b_number+"&type=bday";

        //         $.ajax({
        //         type: "POST",
        //         url: "index.php",
        //         data: data,
        //         success: function(data)
        //         {
        //           alert('Message sent');

        //         }
        //     }); 

        //     var data="mail_text_bday=mail_bday&b_mail="+b_mail+"&type=bday";

        //         $.ajax({
        //         type: "POST",
        //         url: "index.php",
        //         data: data,
        //         success: function(data)
        //         {

        //         alert('Mail sent');
        //         }
        //     });

        //     }else{
        //         alert('No Data Found');
        //     }
        // }

        //    if(document.getElementById('anvy1').checked) {

        //    var a_number=$('#number_a').attr('num_a');
        //    var a_mail=$('#number_a').attr('mail_a');
        //     if(a_number!="" || a_mail!=""){
        //   var data="sms_text_bday=sms_bday&b_number="+a_number+"&type=anvy";

        //         $.ajax({
        //         type: "POST",
        //         url: "index.php",
        //         data: data,
        //         success: function(data)
        //         {

        //        alert('Mesaage sent');
        //         }
        //     }); 

        //      var data="mail_text_bday=mail_bday&b_mail="+a_mail+"&type=anvy";

        //         $.ajax({
        //         type: "POST",
        //         url: "index.php",
        //         data: data,
        //         success: function(data)
        //         {

        //         alert('Mail sent');
        //         }
        //     }); 


        // }else{
        //       alert('No Data Found') ;
        //    }
        //    }

        // }  
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <!--  <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script>  -->




</body>

</html>