<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title> Loyalty</title>

        <!--Morris Chart CSS -->
        
         <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        

		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center}</style>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                	<div class="top-head-section">
                    		 Transactions 
                           <!-- <a href="registration.php"><div class="top-head-add-btn">+ADD</div></a>-->
                    </div>
                    <div class="container">

                        <div class="listting-top-filter-section">
                        	<div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">From</div>
                                        <input type="text" class="list-filter-textbox" data-provide="datepicker" id="datepicker" placeholder="From">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">To</div>
                                    <input type="text" data-provide="datepicker" id="datepicker-1" class="list-filter-textbox" placeholder="To">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Name</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Name" >
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Phone</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Phone" >
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Customer ID</div>
                                        <input type="text" class="list-filter-textbox" placeholder="ID" >
                                </div>
                            </div>
<!--                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Birthday</div>
                                    <input data-provide="datepicker" id="datepicker" type="text" class="list-filter-textbox" placeholder="Birthday">
                                </div>
                            </div>-->
                           <a href="#"> <div class="submit-button-filter">SUBMIT</div></a>
                        </div><!--listting-top-filter-section-->
                        <div class="card-box table-responsive">
                        
                        	<div class="dt-buttons btn-group" style="margin-bottom:8px;">
                            	
                                <a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons"><span>Excel</span></a>
                                <a class="btn btn-default buttons-pdf buttons-html5 btn-sm" tabindex="0" aria-controls="datatable-buttons"><span>PDF</span></a>
                                <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons"><span>Print</span></a>
                            </div>
                            
                        	<table id="" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Bill</th>
                                    <th>Total Amount</th>
                                    <th>Total Loyality</th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr class="date-table-tra">
                                	<td colspan="5">21/12/2017</td>
                                </tr>
                                <tr>
                                    <td>#ID1236554</td>
                                    <td>Edinburgh</td>
                                    <td>123</td>
                                    <td>610</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>#ID1236554</td>
                                    <td>Edinburgh</td>
                                    <td>123</td>
                                    <td>610</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>#ID1236554</td>
                                    <td>Edinburgh</td>
                                    <td>123</td>
                                    <td>610</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>#ID1236554</td>
                                    <td>Edinburgh</td>
                                    <td>123</td>
                                    <td>610</td>
                                    <td>25</td>
                                </tr>
                                
                                <tr class="total-section-trans">
                                    <td style="text-align:right" colspan="4"><strong>TOTAL</strong></td>
                                    
                                    <td><strong>1205/-</strong></td>
                                </tr>
                                
                                <tr class="date-table-tra">
                                	<td colspan="5">21/12/2017</td>
                                </tr>
                                <tr>
                                    <td>#ID1236554</td>
                                    <td>Edinburgh</td>
                                    <td>123</td>
                                    <td>610</td>
                                    <td>25</td>
                                </tr>
                                
                                </tbody>
                            </table>
                        
                        
                        
                        </div><!--card-box table-responsive-->



                    </div> <!-- container -->

                </div> <!-- content -->


            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->



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

<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
 
        
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        
        
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        
        <script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        
		$('#datatable-buttons').DataTable({
			"columnDefs": [ {
      "targets"  : 'no-sort',
      "orderable": false,
      "order": []
    }]
		});
		
					
        
    });
	
	
    TableManageButtons.init();

</script>
		




    </body>

</html>