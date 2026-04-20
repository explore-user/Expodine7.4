<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();


 

if(isset($_REQUEST['group_id'])){
    
  $_SESSION['group_id']=$_REQUEST['group_id'];
   
}

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
                     Group Details &nbsp;&nbsp;
                    <a href="loyalty_groups.php"><div class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a>&nbsp;&nbsp;
<!--                                            <a href="#"><div style="width:150px;background-color: darkred" class="top-head-add-btn"><span class="ti-arrow-left"></span>SEND CAMPAIGN</div></a>-->
                    </div>
                    <div class="container">

                        <div class="card-box table-responsive">
                        	
				  <div class="modal-content inner-textbox-effect hid_tab" style="border: 0;background-color: #f4f8fb;">
                     <div class="col-md-12" style="padding:0">
                        <div class="campign-filter-popup">
                            
                             <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                        <input type="text" class="list-filter-textbox" autofocus placeholder="Search Name" onkeyup="return name_search('<?= $_SESSION['group_id']?>');" onfocus=" name_search('<?= $_SESSION['group_id']?>')" onclick=" name_search('<?= $_SESSION['group_id']?>')" id="name_search">
                                    </div>
                                </div>
                            <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                            <input type="text" class="list-filter-textbox" placeholder="Number" onkeyup="return number_search('<?= $_SESSION['group_id']?>');" onfocus=" number_search('<?= $_SESSION['group_id']?>')" onclick=" number_search('<?= $_SESSION['group_id']?>')"  id="number_search">
                                    </div>
                                </div>
                             <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                            <input type="text" class="list-filter-textbox" placeholder="Mail" onkeyup="return mail_search('<?= $_SESSION['group_id']?>');" onfocus="mail_search('<?= $_SESSION['group_id']?>')" onclick="mail_search('<?= $_SESSION['group_id']?>')" id="mail_search">
                                    </div>
                                </div>
                         </div>
                         
                         
                         
                         
                     </div>
                     
                    
                  </div>			
                       		<table id="campagn-table" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                      <th style="min-width:100px;">Sl</th>
                                    <th style="min-width:100px;">Name </th>
                                    <th style="min-width:150px;">Number</th>
                                   
                                    <th style="min-width:100px;">Mail</th>
                                    
                                </tr>
                                </thead>
                                
                                <tbody id="load_group_view">
                                     
          	
                                 </tbody> 
                                
                                </table>
                        	
                        </div><!--card-box table-responsive-->



                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

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

<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
 
        
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="loyalty_js/loy.js"></script>
        
        
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
        
        $('#cmp_pop_tbl').DataTable({
			scrollY: "300px",
            scrollX: false,
            scrollCollapse: false,
            "searching": false,
            "paging":false,
            "ordering": false,
            "info":     false,
            "lengthChange": false,
		});
        
        
        
        		
        
    });
	
	
    TableManageButtons.init();


function name_search(i){
    
       var name_camp=$('#name_search').val();
   
        var data="set_group_view=group_view&groupid="+i+"&name_camp="+name_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
           $('#load_group_view').html(data);
        }
    }); 
    
}


function mail_search(s){
    
       
     var mail_camp=$('#mail_search').val();
        var data="set_group_view=group_view&groupid="+s+"&mail_camp="+mail_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
           $('#load_group_view').html(data);
        }
    }); 
    
}



function number_search(t){
    
        var number_camp=$('#number_search').val();
   
        var data="set_group_view=group_view&groupid="+t+"&number_camp="+number_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
           $('#load_group_view').html(data);
        }
    }); 
    
}

</script>
		

<style>.dataTables_scrollBody{height:400px !important;}.modal .modal-dialog .modal-content{padding: 15px 7px}
			.modal .modal-dialog .modal-content .group{margin-bottom: 25px;}.modal-dialog{width:500px !important;top: 10%;}
                        .new_print_loading_bill_sms{width:100%;height:80%;position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.8);text-align:center;z-index:9999999999999;top: 20%}
                        .new_print_loading_bill_sms img {width:200px;}
		</style>


    </body>

</html>