<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

if(isset($_REQUEST['set_group_update'])&&($_REQUEST['set_group_update']=="group_update")){
    
       $name=$_REQUEST['name']; 
   
       $id=$_REQUEST['id']; 
       $status=$_REQUEST['status']; 
       
    $sql_smsattemt_updation1  =  $database->mysqlQuery("UPDATE tbl_loyalty_campaign_group SET gp_groupname='".$name."',gp_status='".$status."',gp_value='".$_REQUEST['value']."' where gp_id='".$id."'");
             
    
}
 

if(isset($_REQUEST['set_group_delete'])&&($_REQUEST['set_group_delete']=="group_delete")){
    $c_id=$_REQUEST['c_id'];
    $database->mysqlQuery("DELETE FROM tbl_loyalty_campaign_group WHERE gp_id = '" .$c_id."'");
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
                  
<!--                                            <a href="#"><div style="width:150px;background-color: darkred" class="top-head-add-btn"><span class="ti-arrow-left"></span>SEND CAMPAIGN</div></a>-->
                    </div>
                    <div class="container">



                    <div class="page_head_detl_sec">
                        <h2> <a href="reward_campaigns.php"><div style="float:left" class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a> Manage Groups </h2>
                        
                     </div>

                        
                      
                        
                        <div class="card-box table-responsive">
                        	
							
                       		<table id="campagn-table" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                    <th style="min-width:100px;">Action</th>
                                    <th style="min-width:150px;"> Name</th>
                                   <th style="min-width:150px;"> Value</th>
                                    <th style="min-width:100px;">Status</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                     
                                             <?php
                               
     $loy_qry_reward = $database->mysqlQuery("select * from tbl_loyalty_campaign_group");
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
         {
                                ?>
                                     <tr>
                                 	<td  style="min-width:100px;">
                                            <a href="#" title="View Details"  onclick=" return view_reward('<?=$loyalty_listing_reward['gp_id']?>')" class="action-btn"><span class="ti-eye"></span></a>
                                            <a href="#" title="Edit"  onclick=" return edit_reward('<?=$loyalty_listing_reward['gp_groupname']?>','<?=$loyalty_listing_reward['gp_id']?>','<?=$loyalty_listing_reward['gp_status']?>','<?=$loyalty_listing_reward['gp_value']?>')"  data-toggle="modal" data-target="#send-mail-popup" class="action-btn"><span class="ti-pencil"></span></a>
                                                <a href="#" title="Delete" onclick=" return delete_reward('<?=$loyalty_listing_reward['gp_id']?>')" class="action-btn"><span class="ti-trash"></span></a>
                                 	</td>
					<td  style="min-width:150px;"><?=$loyalty_listing_reward['gp_groupname']?></td>
                                        <td  style="min-width:150px;"><?=$loyalty_listing_reward['gp_value']?></td>
                                	<td  style="min-width:150px;"><?=$loyalty_listing_reward['gp_status']?></td>
                                	
     <?php } } ?>
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
        
        
        <div id="send-mail-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog sms_popup_close" >
								<div class="modal-content ac_popup" style="background-color: #f4f8fb;">
									<div class="modal-body" style="text-align: center;padding: 0">
										<h4>  UPDATE GROUP</h4>
                                            
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0;background-color: #f4f8fb;">
                                       
                                       <div class="col-md-12">
											<div class="group">
                                                                                            <input id="groupname1" required="" name="" type="text" value="">
												<label>Group Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                             <div class="col-md-12">
											<div class="group">
                                                                                            <input id="groupvalue1" required="" name="" type="text" value="">
												<label>Offer Value</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            
                                                                            
                                      
                                                                             <div class="col-md-6">
                                                                           <div class="group">
                                                                               <select id="status1" class="select-registration" >
                                                                                                          <option value="Y">Active</option>
                                                                                                          <option value="N">Inactive</option>
                                                                                                      </select>
												
												
											 </div>
                                                                                  </div>
                                                                            
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
									<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                                                                        <button id="upd_id" onclick="update_group();"  style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> Update</button>
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
        
    });
	
	
    TableManageButtons.init();


function view_reward(p){
 
 var data="group_id="+p;
        $.ajax({
        type: "POST",
        url: "group_view.php",
        data: data,
        success: function(data)
        {
           window.location.href="group_view.php";
           
        }
    }); 
 
}

function delete_reward(i){
     var check = confirm("Are you sure you want to Delete ?");
	if(check==true)
	{
   var data="set_group_delete=group_delete&c_id="+i;
        $.ajax({
        type: "POST",
        url: "loyalty_groups.php",
        data: data,
        success: function(data)
        {
           location.reload();
           
        }
    }); 
        }
}


function edit_reward(n,i,s,v){
    
    
    $('#groupname1').val(n);
     $('#status1').val(s);
       $('#groupvalue1').val(v);
     
    $('#upd_id').attr('update_id',i);
   
}

function update_group(){
    
    var name= $('#groupname1').val();
     var value= $('#groupvalue1').val();
    var status=$('#status1').val();
    var id= $('#upd_id').attr('update_id');
        if(name!="" && value!=''){
     var data="set_group_update=group_update&name="+name+"&status="+status+"&id="+id+"&value="+value;
    
        $.ajax({
        type: "POST",
        url: "loyalty_groups.php",
        data: data,
        success: function(data)
        {
           location.reload();
           
        }
    }); 
    }else{
         if(name=="" ){
        $('#groupname1').focus();
    }else if(value==''){
        $('#groupvalue1').focus(); 
    }
        
        
    }
    
    
    
}


</script>
		

<style>.dataTables_scrollBody{height:400px !important;}.modal .modal-dialog .modal-content{padding: 15px 7px}
			.modal .modal-dialog .modal-content .group{margin-bottom: 25px;}.modal-dialog{width:500px !important;top: 10%;}
                        .new_print_loading_bill_sms{width:100%;height:80%;position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.8);text-align:center;z-index:9999999999999;top: 20%}
                        .new_print_loading_bill_sms img {width:200px;}
		</style>


    </body>

</html>