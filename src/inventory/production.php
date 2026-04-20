<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

$req_store='';


         
         $sql_login  =  $database->mysqlQuery("select tp_store from tbl_production where tp_set='N' "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $req_store=$result_login['tp_store'];
                  }
                  }
  


?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>Production </title>

    <!--Morris Chart CSS -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/custombox/css/custombox.css" rel="stylesheet">
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../css/jquery-ui-1.8.2.custom.css" />
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/css/content.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />




    <script src="assets/js/modernizr.min.js"></script>
    <style>
    .new_overlay {
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        position: fixed;
        z-index: 999;
        height: 100%;
    }

    .ui-autocomplete {
        z-index: 999999 !important;
        max-height: 400px;
        height: auto;
        overflow: scroll;
    }

    .quick_pop_printer_sec {
        width: 100%;
        height: 100%;
        float: left;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.7);
        left: 0;
        top: 0;
        z-index: 9999;
    }

    .quick_pop_printer {
        width: 350px;
        height: 600px;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        left: 0;
        right: 0;
        margin: auto;
        top: 0;
        bottom: 0;
        position: absolute;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 2fr;
        justify-content: center;
    }

    .quick_pop_printer_head {
        text-align: center;
        font-size: 20px;
        color: #818181;
        padding: 15px 0;
        font-weight: bold;
        text-transform: capitalize;
    }

    .quick_pop_printer_content {
        width: 100%;
        height: auto;
        padding: 15px;
        text-align: center;
    }
    </style>

    <style>
    .dataTables_length {
        display: none;
    }

    .dataTables_filter {
        display: none
    }

    div.dataTables_info {
        padding-top: 7px
    }

    div.dataTables_paginate ul.pagination {
        margin-top: 0 !important
    }

    .card-box {
        margin-bottom: 0
    }

    .content-page>.content {
        margin-bottom: 0
    }

    .nav>li>a {
        padding: 16px 15px;
    }

    .logo {
        padding: 15px;
    }

    .table>thead>tr>th {
        text-align: center;
        font-size: 14px
    }

    .table tr td {
        font-size: 14px
    }
    </style>

</head>


<body class="fixed-left">
    <input type="hidden" id="hidden_checker">
    <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu" />

    <input type="hidden" <?php if(isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!=''){ ?>
        value="<?=$_REQUEST['req_id']?>" <?php } ?> id="edit_id">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->

        <div <?php if(isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!=''){ ?> class="disablegenerate" <?php } ?>>
            <?php include( 'includes/header.php') ?>

        </div>

        <!-- Top Bar End -->
        <div class="loyalty_mgmt_head">
            <div class="">
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important; "
                    class="inv-req-btn1" href="#">PRODUCTION</a>

               <a class="inv-pro-btn1"
                    href="production_history.php">PH</a>


            </div>






        </div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <span id="load_error"
                    style="color: red;font-size: 10px;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;"></span>

                <div class="container" style="padding: 0.75; margin-bottom:1rem;">
                    <div class="inv-req-content" style="grid-template-rows: 0.1fr 0.1fr 1fr;">



                        <div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none;">
                            <div class="quick_pop_printer">
                                <div class="inv-Password">
                                    <div class="inv-password-img"><img style="" src="assets/images/logo_pass.png"
                                            alt=""></div>
                                    <div class="inv-password-msg"><span></span></div>
                                    <div class="inv-password-input">
                                        <div class="inv-password-input-icon"><i class="fa fa-unlock"
                                                aria-hidden="true"></i></div><input type="text">
                                        <div style="padding-top:2rem;" class="inv-password-input-icon"><i
                                                class="fa fa-long-arrow-left fa-lg" aria-hidden="true"></i></div>
                                    </div>
                                    <div class="inv-Password-numbers">
                                        <span>1</span>
                                        <span>2</span>
                                        <span>3</span>
                                        <span>4</span>
                                        <span>5</span>
                                        <span>6</span>
                                        <span>7</span>
                                        <span>8</span>
                                        <span>9</span>
                                        <span>0</span>
                                        <span class="inv-Password-clear" style="">Clear</span>
                                        <a class="inv-password-btn" href="">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex;flex-direction: column;gap: 1rem;">
                            <div class="req-form-head">
                                <h6 style="width: 3%;display: none">.</h6>
                                <h6 style="width: 12%;">Product</h6>
                                <h6 style="width: 12%;">Portion</h6>
                                <h6 style="width: 10rem;">Weight</h6>
                                <h6 style="width: 10rem;">Qty</h6>
                                <h6 style="width: 3rem;"></h6>
                            </div>

                            <div class="append_div_main inv-sub-form">
                                <div class="add_menu_row " id="second_div_main">

                                    <div class="inv-req-form" style="padding:1rem;">
                                        <span class="inv-req-sl"
                                            style="width: 3%; overflow:hidden;display: none"></span>

                                        <input onkeyup="clear_name();" onchange="clear_name();" autofocus
                                            placeholder="Product" id="product" class="product" type="text"
                                            style="width: 12%;">

                                        <select id="portion" style="width: 12%;">
                                     <option value="">Select</option>        
                           <?php 
                          $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                                                                                      while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                            {
                                               ?>                                  
                          <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname'].' ['.$result_kot['pm_id'].']'?></option>
                          <?php } } ?>
                                            
                                        </select>
                                        
                                        
                                        
                                        <input style="width: 10rem;" id="weight" onkeypress="return numdot(this,event);"
                                            placeholder="WEIGHT" type="text">

                                        <input style="width: 10rem;" id="qty" onkeypress="return numdot1(event);"
                                            placeholder="QTY" type="text">


                                        <a id="plusbtn" class="inv-req-btn"
                                            style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>

                                    </div>
                                </div>
                            </div>
                            <div class="inv-req-Submit">



                               
                                <a class="inv-submit-btn " style="display:none; margin-left:auto;" href="">Print</a>
                                <a class="inv-submit-btn " style="display:none;" href="">Back</a>
                                Items : <span id="rps_count">0</span>
                                <select id="store" style="display:block;font-weight: bold" <?php if($req_store!=''){ ?> class="disablegenerate"  <?php } ?>    >
                                    <option value="">Store</option>
                                    <?php  
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>

                                    <option <?php if($req_store==$result_fnctvenue['ti_id']){ ?> selected <?php } ?>
                                        value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?>
                                    </option>

                                    <?php } } ?>

                                </select>

                                
                                <input id="submit_req" type="text" readonly class="inv-submit-btn " value="PROCEED"
                                    style="margin-left:auto;cursor: pointer;border-bottom: none"
                                    onclick="submit_req();">



                            </div>

                        </div>
                    </div><!-- /.modal-content -->
                </div>

            </div><!-- /.modal -->



            <script>
            var resizefunc = [];
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


            <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>




            <script src="assets/pages/datatables.init.js"></script>
            <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>



            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>

            <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
            <script src="assets/pages/jquery.sweet-alert2.init.js"></script>

            <!-- Modal-Effect -->
            <script src="assets/plugins/custombox/js/custombox.min.js"></script>
            <script src="assets/plugins/custombox/js/legacy.min.js"></script>

            <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script>

            <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('keypress', function(e) {
                    if (e.which == 13) {

                        if ($('#qty').is(':focus')) {

                            $("#plusbtn").click();

                        } else if ($('#weight').is(':focus')) {

                            $("#plusbtn").click();
                        } else if ($('#submit_req').is(':focus')) {

                            submit_req();
                        }
                    }
                });


                $(document).on('keyup', function(e) {

                    if (e.which == 9) {
                        if ($('#store').is(':focus')) {

                            $('#store').css('border-bottom', '3px solid blue');
                        } else {

                            $('#store').css('border-bottom', 'none');
                        }
                    }

                });



                var datastring = "set=product_production_load"

                $.ajax({
                    type: "POST",
                    url: "load_inventory.php",
                    data: datastring,
                    success: function(data) {

                        var a = JSON.parse(data);

                        $("#product").val('');
                        $("#barcode").val('');
                        $("#qty").val('');
                        $("#brand").val('');
                        $("#rate_type").val('');
                        $("#unit_type").val('');
                        $("#weight").val('');

                        var s = 1;
                        $.each(a, function(i, record) {

                                                $("#second_div_main" +record.tp_id).empty();
                                                $("#second_div_main" +record.tp_id).hide();

                                                var sl = s++;
                                                $('#rps_count').text(sl);
                                                $('#hidden_checker').val(sl);


                                                var product = record.tp_name;
                                                var qty = record.tp_qty;


                                                if (record.tp_weight =='null' || record.tp_weight == '' || record.tp_weight == null) {
                                                    var weight = '';
                                                } else {
                                                    weight = record.tp_weight;
                                                }

                                                 if (record.tp_portion =='null' || record.tp_portion == '' || record.tp_portion == null) {
                                                    var portion = '';
                                                } else {
                                                    portion = record.tp_portion;
                                                }

                                                if ($('.append_div_main').find('#del_card' +record.tp_id).length === 0) {

                                                    $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main" +record.tp_id +"' >" +
                                                            "<div class='inv-req-form'>" +
                                                            "<span class='inv-req-sl sl_div'   style='width: 3%; overflow:hidden;display: none'></span>" +

                                                            "<input   id='product" +record.tp_id +"' value='" +product +"' readonly type='text' style='width: 12%;'>  " +

                                                            "<input   id='portion" +record.tp_id +"' value='" +portion +"' readonly type='text' style='width: 12%;'>  " +

                                                            " <input value='" +weight +"' readonly  onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight" +record.tp_id +"'  type='text'>" +

                                                            " <input value='" +qty +"'  readonly onkeypress='return numdot1(event);'  style='width: 10rem;' id='qty" +record.tp_id +"'  type='text'> " +

                                                            " <a class='inv-req-btn' id='del_card" +record.tp_id +"' name='del_card" +record.tp_id +"' onclick='delete_req(" +record.tp_id +")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>" +

                                                            "</div>" +
                                                            "</div>"
                                                        );

                                                }



                                            });


                    }
                });



                $("#plusbtn").click(function() {


                    var product = $('#product').val();
                    var product_id = $('#product').attr('menuid');
                    var barcode = $('#barcode').val();
                    var qty = parseFloat($('#qty').val());
                    var brand = $('#brand').val();

                    var rate_type = $('#product').attr('rt');
                    var unit_type = $('#product').attr('ut');
                   //  var store = $('#product').attr('st');
                     var store = $('#store').val();
                    var edit_id = $('#edit_id').val();

                    var weight = parseFloat($("#weight").val());

                  var portion_menu = $('#portion').val();

                    var datastring2 = "set=check_product_production&product="+product_id+"&portion="+portion_menu;

                    $.ajax({
                        type: "POST",
                        url: "load_inventory.php",
                        data: datastring2,
                        success: function(data) {

                            if ($.trim(data) == 'yes') {

                                if (product != '' && store!=''  && ( (portion_menu!='' && (unit_type=='Single' || unit_type=='Nos')) || portion_menu=='')  && (qty > '0' || weight > '0')) {

                                    var datastring = "set=add_product_production&product=" +
                                        product + "&barcode=" + barcode + "&weight=" +
                                        weight +
                                        "&qty=" + qty + "&brand=" + brand + "&product_id=" +
                                        product_id + "&unit_type=" + unit_type +
                                        "&rate_type=" + rate_type + "&edit_id=" + edit_id+"&store="+store+"&portion_menu="+portion_menu;

                                    $.ajax({
                                        type: "POST",
                                        url: "load_inventory.php",
                                        data: datastring,
                                        success: function(data) {




                                            var a = JSON.parse(data);

                                            $("#product").val('');
                                          $("#portion").val('');
                                            $("#qty").val('');
                                           
                                            $("#weight").val('');


                                            var s = 1;
                                            $.each(a, function(i, record) {

                                                $("#second_div_main" +record.tp_id).empty();
                                                $("#second_div_main" +record.tp_id).hide();

                                                var sl = s++;
                                                $('#rps_count').text(sl);
                                                $('#hidden_checker').val(sl);


                                                var product = record.tp_name;
                                                var qty = record.tp_qty;


                                                if (record.tp_weight =='null' || record.tp_weight == '' || record.tp_weight == null) {
                                                    var weight = '';
                                                } else {
                                                    weight = record.tp_weight;
                                                }

                                                 if (record.tp_portion =='null' || record.tp_portion == '' || record.tp_portion == null) {
                                                    var portion = '';
                                                } else {
                                                    portion = record.tp_portion;
                                                }


                                                if ($('.append_div_main').find('#del_card' +record.tp_id).length === 0) {

                                                    $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main" +record.tp_id +"' >" +
                                                            "<div class='inv-req-form'>" +
                                                            "<span class='inv-req-sl sl_div'   style='width: 3%; overflow:hidden;display: none'></span>" +

                                                            "<input   id='product" +record.tp_id +"' value='" +product +"' readonly type='text' style='width: 12%;'>  " +

                                                           "<input   id='portion" +record.tp_id +"' value='" +portion +"' readonly type='text' style='width: 12%;'>  " +

                                                            " <input value='" +weight +"' readonly  onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight" +record.tp_id +"'  type='text'>" +

                                                            " <input value='" +qty +"'  readonly onkeypress='return numdot1(event);'  style='width: 10rem;' id='qty" +record.tp_id +"'  type='text'> " +

                                                            " <a class='inv-req-btn' id='del_card" +record.tp_id +"' name='del_card" +record.tp_id +"' onclick='delete_req(" +record.tp_id +")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>" +

                                                            "</div>" +
                                                            "</div>"
                                                        );

                                                }



                                            });

                                            $("#product").focus();

                                        }

                                    });

                                }else {

                                    $('#load_error').show();

                                    if (qty == '' || qty == '0' || $.isNumeric(qty) ==false) {
                                        $('#load_error').text('ENTER QTY');
                                        $("#qty").focus();
                                    }


                                    if (weight == '' || weight == '0' || $.isNumeric(weight) == false) {
                                        $('#load_error').text('ENTER WEIGHT');
                                        $("#weight").focus();
                                    }
                                    
                                     if (portion_menu == '' &&  (unit_type=='Single' || unit_type=='Nos')) {
                                        $('#load_error').text('SELECT PORTION ');
                                        $("#product").focus();
                                    }


                                    if (product == '') {
                                        $('#load_error').text('ENTER PRODUCT');
                                        $("#product").focus();
                                    }


if (store == '') {
                                        $('#load_error').text('SELECT STORE');
                                        $("#product").focus();
                                    }

                                     $('#load_error').delay(1000).fadeOut('slow');

                                }


                            } else {

                                $('#load_error').show();

                                $('#load_error').text('PRODUCT ALREADY EXIST');
                                $("#product").focus();
                                $("#product").val('');
                                $("#barcode").val('');
                                $("#qty").val('');
                                $("#brand").val('');
                                $("#rate_type").val('');
                                $("#unit_type").val('');
                                $("#weight").val('');

                                $('#load_error').delay(1000).fadeOut('slow');

                            }

                        }



                    });

                });




                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({
                    keys: true
                });
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });

                var table = $('#datatable-levels').DataTable({
                    scrollY: "560px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });


                $('.close_pop_master').click(function() {
                    $('#mst_name').val('');
                    $('#mst_status').val('status');
                });



                $("#product").autocomplete({
                    minLength: 2,
                    source: "load_inventory.php?set=search_inventory_production",
                    focus: function(event, ui) {
                        $("#product").val(ui.item.label);

                        return false;
                    },

                    select: function(event, ui) {
                      
                        $("#product").val(ui.item.label);


                        $('#product').attr('menuid', ui.item.menuid);
                        
                         $('#product').attr('rt', ui.item.rate_type);
                         
                          $('#product').attr('ut', ui.item.base_unit);
                          
                           $('#product').attr('st', ui.item.store);


   if(ui.item.base_unit == 'Single') {
        $('#portion').attr('disabled', false);
   }else{
         $('#portion').attr('disabled', true);
        }



                        if (ui.item.base_unit == 'Nos' || ui.item.base_unit == 'Single') {

                            if (ui.item.rate_type != 'Packet') {
                                $('#weight').attr('readonly', true);
                            }
                            $('#qty').attr('readonly', false);
                            
                            $('#qty').val('1');
                             $('#weight').val('0');

                            if (ui.item.rate_type == 'Packet' && ui.item.base_unit == 'Nos') {

                                $('#weight').attr('readonly', true);
                                $('#weight').val(ui.item.weight);
                            }
                        } else {

                            $('#qty').attr('readonly', true);
                            $('#weight').attr('readonly', false);

                                  $('#qty').val('0');
                                $('#weight').val('1');
                            if (ui.item.rate_type == 'Packet' && (ui.item.base_unit == 'Nos' || ui.item.base_unit == 'KG' || ui.item.base_unit == 'LTR')) {

                                $('#weight').attr('readonly', true);
                                $('#qty').attr('readonly', false);
                                $('#qty').val('1');
                                $('#weight').val('0');
                                
                            }
                             

                        }


                        localStorage.name_length = $("#product").val().length;
                        

                        return false;

                    }

                });
 

            });

   function numdot1(e) {

                var charCode;

                if (e.keyCode > 0) {
                    charCode = e.which || e.keyCode;
                } else if (typeof(e.charCode) != "undefined") {
                    charCode = e.which || e.keyCode;
                }
                if (charCode == 43)
                    return true
                if (charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;


   }


    function numdot(item, evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode == 46) {
                    var regex = new RegExp(/\./g)
                    var count = $(item).val().match(regex).length;
                    if (count > 1) {
                        return false;
                    }
                }
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
   }

    function clear_name() {


                if ((localStorage.name_length != $('#product').val().length && localStorage.name_length > 0) || (
                        localStorage.barcode_length != $('#barcode').val().length && localStorage.barcode_length > 0)) {


                    $("#product").val('');
                    $("#barcode").val('');
                    $("#qty").val('');
                    $("#brand").val('');
                    $("#rate_type").val('');
                    $("#unit_type").val('');
                    $("#weight").val('');

                    localStorage.name_length = '0';
                    localStorage.barcode_length = '0';
                }

            }



            function delete_req(id) {
                var check = confirm("Confirm Delete ?");
                if (check == true) {
                    var data = "set=delete_production&id=" + id;

                    $.ajax({
                        type: "POST",
                        url: "load_inventory.php",
                        data: data,
                        success: function(data) {

                            $('#second_div_main' + id).remove();
                            location.reload();
                        }
                    });

                }
            }

            function edit_req_qty(id) {


                var check = confirm("Confirm Update ?");
                if (check == true) {


                    var qty = parseFloat($('#qty' + id).val());

                    var weight = parseFloat($('#weight' + id).val());

                    if (qty > '0' && weight > '0') {
                        var data = "set=update_req_qty&id=" + id + "&qty=" + qty + "&weight=" + weight;

                        $.ajax({
                            type: "POST",
                            url: "load_inventory.php",
                            data: data,
                            success: function(data) {

                                location.reload();

                            }
                        });

                    } else {

                        $('#load_error').show();

                        if (qty == '' || qty == '0') {
                            $('#load_error').text('ENTER VALID QTY');
                            $('#qty' + id).focus();
                        }


                        if (weight == '' || weight == '0') {
                            $('#load_error').text('ENTER VALID WEIGHT');
                            $('#weight' + id).focus();
                        }

                        $('#load_error').delay(1000).fadeOut('slow');

                    }



                }
            }




            function submit_req() {

                if ($('#hidden_checker').val() > 0) {



                    var edit_id = $('#edit_id').val();

                    var store = $('#store').val();
                    //alert(edit_id);
                  

                        $('#submit_req').hide();

                        $('#load_error').show();
                        $('#load_error').css('color', 'green');
                        $('#load_error').text('SUCCESSFULL');

                        $('#load_error').delay(1000).fadeOut('slow');

                        var data = "set=proceed_production&store=" + store + "&edit_id=" + edit_id;

                        $.ajax({
                            type: "POST",
                            url: "load_inventory.php",
                            data: data,
                            success: function(data) {

                                setInterval(function() {

                                    if (edit_id != '') {
                                        window.location.href = 'history.php';
                                    } else {
                                        window.location.href = 'store_stock.php';
                                    }


                                }, 500);

                            }
                        });

                    

                } else {

                    $('#load_error').show();
                    $('#load_error').css('color', 'red');
                    $('#load_error').text('ENTER PRODUCT DETAILS');

                    $('#load_error').delay(1000).fadeOut('slow');

                }

            }
            </script>

            <style>
            .dataTables_scrollBody {
                height: 460px !important;
            }

            .dataTables_scrollBody {
                height: 460px !important;
            }

            .swal2-modal .swal2-styled {
                padding: 6px 32px;
            }

            .modal-dialog {
                width: 450px !important;
                top: 30%;
            }

            .modal .modal-dialog .modal-content {
                padding: 15px;
            }

            .disablegenerate {
                pointer-events: none;
                opacity: 0.4;
                cursor: none;

            }
            </style>

</body>

</html>