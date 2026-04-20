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
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/custombox/css/custombox.css" rel="stylesheet">
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

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}</style>

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
                    		 POINT TRANSFER 
							    
                    </div>
                    <div class="container">

                       <div class="listting-top-filter-section">
                        	<div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Search From</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Name" onKeyUp="return from_search();" id="from_search">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Search To</div>
                                    <input type="text" class="list-filter-textbox" placeholder="Name"  onkeyup="return from_search();" id="to_search">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">From Date</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Date" onKeyUp="return date_search();" id="datepicker">
                                </div>
                            </div>
                           <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">To Date</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Date" onKeyUp="return date_search();" id="datepicker1">
                                </div>
                            </div>
                          
                        </div>
                        <div class="card-box table-responsive">
                        
                        	<table id="datatable-levels" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                      <th>Sl.No</th>
                                    <th style="min-width: 120px">From</th>
                                    <th style="min-width: 220px">To</th>
                                     <th style="min-width: 60px">Points Transfered</th>
                                    <th style="min-width:100px">Reason</th>
                                    <th style="min-width: 100px">Secret Key</th>
                                    <th style="min-width: 100px"> Date</th>
                                   

                                </tr>
                                </thead>


                                <tbody id="point_all">
                                          <?php
                               
     $loy_qry_level = $database->mysqlQuery("select *,t2.ly_firstname as toname,tl.ly_firstname as fromname from tbl_loyalty_point_transfers tpf left join tbl_loyalty_reg tl on tl.ly_id=tpf.lpt_from_id left join tbl_loyalty_reg t2 on t2.ly_id=tpf.lpt_to_id ");
     $num_loy_level = $database->mysqlNumRows($loy_qry_level);
     if($num_loy_level)
     {$i=0;
         while($loyalty_listing_level = $database->mysqlFetchArray($loy_qry_level))
         {
         
                      $i++;
                                ?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$loyalty_listing_level['fromname']?></td>
                                    <td><?=$loyalty_listing_level['toname']?></td>
                                   
                                    <td><?=$loyalty_listing_level['lpt_points']?></td>
                                    <td><?=$loyalty_listing_level['lpt_reason']?></td>
                                    <td><?=$loyalty_listing_level['lpt_secret_key']?></td>
                                    <td><?=$loyalty_listing_level['lpt_date']?></td>
                                    
                                    
                                </tr>
                             <?php } } ?>    
                                </tbody>
                            </table>
                        
                        
                        </div>



                    </div> 

                </div>


            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
       
  
						


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
        
         <!-- Sweet-Alert  -->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert2.init.js"></script>
        
        <script src="assets/plugins/custombox/js/custombox.min.js"></script>
        <script src="assets/plugins/custombox/js/legacy.min.js"></script>
        
			<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
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
        
        $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
           
           
        $('#datepicker').change(function() {
        var from=$('#from_search').val();
        var to=$('#to_search').val();
       var from_dt=$('#datepicker').val();
        var to_dt=$('#datepicker1').val();
        
         var data="set_point=point_search&from="+from+"&to="+to+"&from_dt="+from_dt+"&to_dt="+to_dt;
                //  alert(data);
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          
          $('#point_all').html(data);
        }
    });
    
    });
      
      
      $('#datepicker1').change(function() {
        var from=$('#from_search').val();
        var to=$('#to_search').val();
       var from_dt=$('#datepicker').val();
        var to_dt=$('#datepicker1').val();
        
         var data="set_point=point_search&from="+from+"&to="+to+"&from_dt="+from_dt+"&to_dt="+to_dt;
                //  alert(data);
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          
          $('#point_all').html(data);
        }
    });
    
    });
        
    });
    TableManageButtons.init();
    	
    function  from_search(){
        var from=$('#from_search').val();
        var to=$('#to_search').val();
       var from_dt=$('#datepicker').val();
        var to_dt=$('#datepicker1').val();
        
         var data="set_point=point_search&from="+from+"&to="+to+"&from_dt="+from_dt+"&to_dt="+to_dt;
                //  alert(data);
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          
          $('#point_all').html(data);
        }
    });
    }   
    
    
      
</script>
		<style>.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}.modal-dialog{width: 220px !important;top: 30%;}</style>
	




    </body>

</html>