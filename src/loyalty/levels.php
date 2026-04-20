<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

if(isset($_REQUEST['set_status']) && $_REQUEST['set_status']="status_change"){
    
     $sql_active_change  =  $database->mysqlQuery("UPDATE tbl_loyalty_levels SET ll_active='". $_REQUEST['status']."' where ll_id='". $_REQUEST['change_id']."'"); 
}


if(isset($_REQUEST['set_delete_levels'])&&($_REQUEST['set_delete_levels']=="delete_levels")){
    $level_id_del=$_REQUEST['level_id'];
    $database->mysqlQuery("DELETE FROM tbl_loyalty_levels WHERE ll_id = '" .$level_id_del."'");
     
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
                    		 Levels 
							    <a href="add-level.php"><div class="top-head-add-btn">+ADD</div></a>
                    </div>
                    <div class="container">

                       
                        <div class="card-box table-responsive">
                        
                        	<table id="datatable-levels" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                      <th>Actions</th>
                                    <th style="min-width: 120px">Name</th>
                                    <th style="min-width: 220px">Description</th>
                                     <th style="min-width: 60px">Active</th>
                                    <th style="min-width:100px">Condition Value</th>
                                    <th style="min-width: 100px">Reward Name</th>
                                    <th style="min-width: 100px">Reward Code</th>
                                    <th style="min-width: 80px">Reward Value</th>
                                    <th style="min-width: 100px">Min Order Value</th>
                                    <th style="min-width: 100px">Customers</th>
<!--                                 <th style="min-width: 100px">Special Rewards</th>-->
                                  
                                </tr>
                                </thead>


                                <tbody>
                                          <?php
                               
     $loy_qry_level = $database->mysqlQuery("select * from tbl_loyalty_levels");
     $num_loy_level = $database->mysqlNumRows($loy_qry_level);
     if($num_loy_level)
     {
         while($loyalty_listing_level = $database->mysqlFetchArray($loy_qry_level))
         {
         
                      $level_id=$loyalty_listing_level['ll_id'];
                                ?>
                                <tr>
                                    <td>
                                    	<a href="add-level.php?level_update_id=<?=$loyalty_listing_level['ll_id']?>" class="action-btn"><span class="ti-pencil"></span></a>
                                        <a href="#" onclick="return delete_levels('<?=$loyalty_listing_level['ll_id']?>');" class="action-btn"><span class="ti-trash"></span></a>
                                    	
                                    </td>
                                    <td><?=$loyalty_listing_level['ll_name']?></td>
                                    <td><?=$loyalty_listing_level['ll_description']?></td>
                                    <td><a data-toggle="modal" data-target="#change-status-pop" class="level-active-btn active_click" level_id="<?=$level_id?>" ><?php if($loyalty_listing_level['ll_active']=="Y") { ?> Active <?php } else { ?> Inactive <?php } ?></a></td>
                                    <td><?=$loyalty_listing_level['ll_condition_value']?></td>
                                    <td><?=$loyalty_listing_level['ll_reward_name']?></td>
                                    <td><?=$loyalty_listing_level['ll_reward_code']?></td>
                                    <td><?=$loyalty_listing_level['ll_reward_value']?></td>
                                    <td><?=$loyalty_listing_level['ll_minorder_value']?></td>
                                    <td><?=$loyalty_listing_level['ll_customers']?></td>
<!--                                    <td> <?//=$loyalty_listing_level['ll_special_rewards']?></td>-->
                                    
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
        <!-- END wrapper -->
  <div id="change-status-pop" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="text-align: center;padding: 0">
										<h4>Change status ?</h4>

									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
										<button type="button" class="btn btn-primary waves-effect waves-light" id="change_id" onclick="return change_status();"  > Change</button>
										<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                                                                                <input type="hidden" id="hidden_status">
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
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
        
        
         $('.active_click').click(function(){
            
               var id1=$(this).attr('level_id');
               var sts=$(this).text();
             
              $('#change_id').val(id1);
              $('#hidden_status').val(sts)
    }); 
        
        
    });
    TableManageButtons.init();
    
 function delete_levels(ll){
     var check = confirm("Are you sure you want to Delete ?");
	if(check==true)
	{
            var data="set_delete_levels=delete_levels&level_id="+ll;
            
        $.ajax({
        type: "POST",
        url: "levels.php",
        data: data,
        success: function(data)
        {
         
           location.reload();
        }
    });
            
        }
  }				
			


 function change_status(){
          var new_id= $('#change_id').val();
         var new_sts= $.trim($('#hidden_status').val());
        
           var status;
        if(new_sts=='Active'){
          status='N';  
        }else{
           status='Y';    
        }
     
          var data="set_status=status_change&change_id="+new_id+"&status="+status;
         
        $.ajax({
        type: "POST",
        url: "levels.php",
        data: data,
        success: function(data)
        { 
          location.reload();
        
       
           
         
        }
    });
         
      
      }
      
</script>
		<style>.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}.modal-dialog{width: 220px !important;top: 30%;}</style>
	




    </body>

</html>