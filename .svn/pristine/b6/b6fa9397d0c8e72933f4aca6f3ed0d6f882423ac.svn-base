<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();



if(isset($_REQUEST['set_delete_rules_master'])&&($_REQUEST['set_delete_rules_master']=="delete_rules_master")){
      $mst_id_del=$_REQUEST['master_id'];
    $database->mysqlQuery("DELETE FROM tbl_loyalty_rules_type WHERE lrt_id = '" .$mst_id_del."'");
     
}

if(isset($_REQUEST['set_update_master1'])&&($_REQUEST['set_update_master1']=="update_master1")){
   
             $mname1= $_REQUEST['mname1'];
             $msts1= $_REQUEST['mstatus1'];
             $mid1=$_REQUEST['up_id'];
           
               $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_rules_type SET lrt_name='".$mname1."',lrt_active='".$msts1."' where lrt_id='".$mid1."'");


}
if(isset($_REQUEST['set_add_master'])&&($_REQUEST['set_add_master']=="add_master")){
   
             $mname= $_REQUEST['mname'];
             $mstatus= $_REQUEST['mstatus'];
            
        $insertion['lrt_name'] = mysqli_real_escape_string($database->DatabaseLink,trim($mname)); 
        $insertion['lrt_active']= mysqli_real_escape_string($database->DatabaseLink,trim($mstatus)); 
        
	$insertid      =  $database->insert('tbl_loyalty_rules_type',$insertion); 
       
}




  $lr_status_edit="";
  $lr_name_edit="";
  $edit_button="insert";
 
if(isset($_REQUEST['set_edit_master']) && $_REQUEST['set_edit_master']=="edit_rules_master"){
 
  $loy_qry1_upd = $database->mysqlQuery("select * from tbl_loyalty_rules_type where lrt_id='".$_REQUEST['edit_master_id']."' ");
    $num_loy1_upd = $database->mysqlNumRows($loy_qry1_upd);
     if($num_loy1_upd)
     {
         while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1_upd))
         {
             $lrt_id=$_REQUEST['edit_master_id'];
             
             $lr_name_edit=  $loyalty_listing_edit['lrt_name'];
             $lr_status_edit=  $loyalty_listing_edit['lrt_active'];
             
              $edit_button="update";
              echo $lr_name_edit."*".$lr_status_edit;
         }
         
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
                    		  Earning points master  
							    <a data-toggle="modal" data-target="#earing-point-master-add" href="#"><div class="top-head-add-btn">+ADD</div></a>
                    </div>
                    <div class="container">

                       
                        <div class="card-box table-responsive">
                        
                        	<table id="datatable-levels" class="table table-striped table-bordered">
                                <thead>
                                    
                                    
                                <tr>
                                    <th>Name</th>
                                    <th >Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody id="list_view_rules">
                                     <?php
                               
     $loy_qry_rules = $database->mysqlQuery("select * from tbl_loyalty_rules_type");
     $num_loy_rules = $database->mysqlNumRows($loy_qry_rules);
     if($num_loy_rules)
     {
         while($loyalty_listing_rules = $database->mysqlFetchArray($loy_qry_rules))
         {
         
                      $mst_id=$loyalty_listing_rules['lrt_id'];
                                ?>
                                <tr>
                                    <td > <?=$loyalty_listing_rules['lrt_name']?></td> 
                                    
                                    <td><?=$loyalty_listing_rules['lrt_active']?></td>  
                                    <td>
                                    	<a data-toggle="modal" data-target="#earing-point-master-add" onclick="return edit_master('<?=$loyalty_listing_rules['lrt_id']?>');"  href="#" class="action-btn" ><span class="ti-pencil"></span></a>
                                        <a href="#" class="action-btn" onclick="return delete_rules('<?=$loyalty_listing_rules['lrt_id']?>');" ><span class="ti-trash"></span></a>
                                    	
                                    </td>
                                </tr>
     <?php } } ?>
                                </tbody>
                            </table>
                        
                        
                        </div><!--card-box table-responsive-->

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>


        </div>
   
        <div id="earing-point-master-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content ac_popup">
									<div class="modal-body" style="text-align: center;padding: 0">
                                                                           
										<h4 style="margin-bottom: 15px" id="head_option_new">  ADD  </h4>
                                                                                
									<div class="modal-content inner-textbox-effect" style="display: inline-block;border: 0;padding: 0;width: 100%">
										<div class="col-md-6">
											<div class="group" style="margin-bottom: 0">
												<input id="mst_name" required="" name="" type="text" >
												<label>Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
										<div class="col-md-6">
											<div class="group" style="margin-bottom: 0">
												<select class="select-registration" id="mst_status">
												  
												    <option value="Y">Active</option>
                                                                                                    <option value="N" >Inactive</option>
												</select>
											 </div>
										</div>
										
									</div>
									
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
                                                                        
										<button type="button" class="btn btn-primary waves-effect waves-light" id="submit_master"  onclick="return submit_rules_master();" > Submit</button>
                                                                               
										<button type="button" class="btn btn-default waves-effect close_pop_master" data-dismiss="modal" >Close</button>
                                                                                <input type="hidden" id="hidden_id">
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
        
         <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert2.init.js"></script>
        
        <!-- Modal-Effect -->
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
        
        
        $('.close_pop_master').click(function(){
           $('#mst_name').val('');
           $('#mst_status').val('status');
        });
            
      
       
    });
    TableManageButtons.init();

     
 function delete_rules(lrm){
     var check = confirm("Are you sure you want to Delete ?");
	if(check==true)
	{
            var data="set_delete_rules_master=delete_rules_master&master_id="+lrm;
            
        $.ajax({
        type: "POST",
        url: "earning-points-master.php",
        data: data,
        success: function(data)
        {
         
           location.reload();
        }
    });
            
        }
  }
  
  
  function edit_master(em){
   
            var data="set_edit_master=edit_rules_master&edit_master_id="+em;
            
        $.ajax({
        type: "POST",
        url: "earning-points-master.php",
        data: data,
        success: function(data)
        {
            var data1=data.split('*');
             var b=data1[1].split('<');
           $('#mst_name').val(data1[0]);
           $('#mst_status').val(b[0]);
           $('#submit_master').val('update');
           $('#hidden_id').val(em);
           $('#head_option_new').text('UPDATE');
        
        }
    });
            
       
  }
  
  
    function submit_rules_master(){
                
       var sts=  $('#submit_master').val();         
       if(sts!="update"){
                   var mname=$('#mst_name').val();
                   var mstatus=$('#mst_status').val();
                  
                  
                  
                  if(mname!="" )   {       
         var data="set_add_master=add_master&mname="+mname+"&mstatus="+mstatus;
       
        $.ajax({
        type: "POST",
        url: "earning-points-master.php",
        data: data,
        success: function(data)
        {
             
         location.reload();      
        }
    });
    }else{
              
	       $('#mst_name').focus();
      
    }
    
    }else{
        
                   var mname1=$('#mst_name').val();
                   var mstatus1=$('#mst_status').val();
                  var up_id= $('#hidden_id').val();
                  
                  
                  if(mname1!="" )   {       
         var data="set_update_master1=update_master1&mname1="+mname1+"&mstatus1="+mstatus1+"&up_id="+up_id;
       
        $.ajax({
        type: "POST",
        url: "earning-points-master.php",
        data: data,
        success: function(data)
        {
             
         location.reload();      
        }
    });
    }else{
              
	       $('#mst_name').focus();
      
    }
        
        
        
    }
  
    }
  
</script>

	<style>.dataTables_scrollBody{height:460px !important;}
		.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}
		.modal-dialog{width:450px !important;top: 30%;}.modal .modal-dialog .modal-content{padding: 15px;}
               
        </style>


    </body>

</html>