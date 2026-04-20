<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();
if(isset($_REQUEST['set_reward_add'])&&($_REQUEST['set_reward_add']=="reward_add")){
    
            
             $cname=$_REQUEST['c_name'];
             $from= $_REQUEST['from'];
             $to=$_REQUEST['to'];
             $condent=$_REQUEST['condent'];
             
        $insertion['lc_name'] = mysqli_real_escape_string($database->DatabaseLink,trim($cname)); 
        $insertion['lc_from'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($from)); 
        $insertion['lc_to']=  mysqli_real_escape_string($database->DatabaseLink,trim($to)); 
        $insertion['lc_condent']=  mysqli_real_escape_string($database->DatabaseLink,trim($condent)); 
        
	$insertid      =  $database->insert('tbl_loyalty_campaign',$insertion); 
  
}


if(isset($_REQUEST['set_group_add'])&&($_REQUEST['set_group_add']=="group_add")){
    
            
       $groupname=$_REQUEST['groupname'];
            
        $insertion['gp_groupname'] = mysqli_real_escape_string($database->DatabaseLink,trim($groupname)); 
        
        if($_REQUEST['groupvalue']!=""){
         $insertion['gp_value'] = mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['groupvalue'])); 
        }
        
        
	$insertid      =  $database->insert('tbl_loyalty_campaign_group',$insertion); 
  
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
                    		 Reward Campaigns 
                           <!-- <a href="registration.php"><div class="top-head-add-btn">+ADD</div></a>-->
                    </div>
                    <div class="container">

                        
                        	<a href="#" data-toggle="modal" data-target="#send-mail-popup" ><div class="campaign_box_cc campaign_box_clr1">
                        		<div class="campaign_box_ico"><i class="fa fa-plus" aria-hidden="true"></i></div>
                        		<div class="campaign_box_head">Create<br> Campaign</div>
                        	</div></a>
                        
                        
                        	<a href="manage_campaign.php"><div class="campaign_box_cc campaign_box_clr2">
                        		<div class="campaign_box_ico"><i class="fa fa-cog" aria-hidden="true"></i></div>
                        		<div class="campaign_box_head">Manage<br> Campaign</div>
                        	</div></a>
                        
                        <a href="#" data-toggle="modal" data-target="#create-group-popup" >
                        	<div class="campaign_box_cc campaign_box_clr3">
                        		<div class="campaign_box_ico"><i class="fa fa-calendar-o" aria-hidden="true"></i></div>
                        		<div class="campaign_box_head">Create<br> Groups</div>
                        	</div>
                        </a>
                        <a href="loyalty_groups.php">
                        	<div class="campaign_box_cc campaign_box_clr4">
                        		<div class="campaign_box_ico"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        		<div class="campaign_box_head">Manage <br>Groups</div>
                        	</div>
                        </a>
                        
                        <!--<div class="card-box table-responsive"></div>--><!--card-box table-responsive-->



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
										<h4>  CREATE CAMPAIGN</h4>
                                            
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0;background-color: #f4f8fb;">
                                       
                                                                               <div class="col-md-12">
											<div class="group">
												<input id="c_name" required="" name="" type="text" value="">
												<label>Campaign Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            
                                                                             <div class="col-md-12">
											<div class="group">
                                                                                            <textarea placeholder="About Campaign" maxlength="160" style="height:80px;width: 100%;resize: none" onkeyup="valid_condent(event);" id="c_condent" required=""></textarea>
												
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            
                                                                            
                                                                            
                                                                            
                                        <div class="col-md-6">
											<div class="group">
                                                                                            <input  required="" name="" type="text" id="datepicker_new"  onchange="date_from_valid(event);" data-provide="datepicker" >
												<label>From</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                          <div class="col-md-6">
											<div class="group">
                                                                                            <input  required="" name="" type="text" id="datepicker_new1"  onchange="date_to_valid(event);" data-provide="datepicker" >
												<label>To</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>                                
                                                                           
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
									<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                                                                        <button onclick="return submit_reward();" style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> CREATE</button>
									</div>
                                    
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
                                                        
						</div><!-- /.modal -->
                                                
                                                
                                                
                                                <div id="create-group-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog sms_popup_close" >
								<div class="modal-content ac_popup" style="background-color: #f4f8fb;">
									<div class="modal-body" style="text-align: center;padding: 0">
										<h4>  CREATE GROUP</h4>
                                            
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0;background-color: #f4f8fb;">
                                       
                                                                               <div class="col-md-12">
											<div class="group">
                                                                                            <input id="group_name" required="" name="" type="text" value="">
												<label>Group Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                             <div class="col-md-12">
											<div class="group">
                                                                                            <input id="group_value" required="" name="" type="text" onkeypress="return numdot(event);" value="">
												<label>Offer Value in Percentage (%)</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            
<!--                                                                             <div class="col-md-12">
											<div class="group">
                                                                                            <textarea placeholder="About Campaign" style="height:80px;width: 100%;resize: none" id="c_condent" required=""></textarea>
												
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            -->
                                                                            
                                                                            
                                                                            
<!--                                        <div class="col-md-6">
											<div class="group">
												<input  required="" name="" type="text" id="datepicker_new" data-provide="datepicker" >
												<label>From</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                          <div class="col-md-6">
											<div class="group">
												<input  required="" name="" type="text" id="datepicker_new1" data-provide="datepicker" >
												<label>To</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>                                -->
                                                                           
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
									<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                                                                        <button onclick="return submit_group();" style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> CREATE</button>
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
		
					
        $( "#datepicker_new").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#datepicker_new1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
        $('#datepicker_new').datepicker('setStartDate', new Date());   
        
           $('#datepicker_new1').datepicker('setStartDate', new Date());   
           
    });
	
	
    TableManageButtons.init();

function submit_reward(){
   
    
  var c_name=$('#c_name').val();  
   var from=$('#datepicker_new').val();  
    var to=$('#datepicker_new1').val();  
    
      var condent=$('#c_condent').val();  
    
    if(c_name!="" && from!="" && to!="" && condent!='' ){
      var data="set_reward_add=reward_add&c_name="+c_name+"&from="+from+"&to="+to+"&condent="+condent;
        $.ajax({
        type: "POST",
        url: "reward_campaigns.php",
        data: data,
        success: function(data)
        {
           window.location.href="reward_campaigns.php";
           
        }
    });
    }else{
     
        if(c_name==''){
             $('#c_name').focus();
        }    
       else if(condent==''){
             $('#c_condent').focus();
        }  
     else  if(from==''){
             $('#datepicker_new').focus();
        }   
        
       else if(to==''){
             $('#datepicker_new1').focus();
        }   
        
        
        
    }
}


function submit_group(){
    
     var groupname=$('#group_name').val();  
     var groupvalue= $('#group_value').val();  
     
     if(groupname!="" && groupvalue!=''){
      var data="set_group_add=group_add&groupname="+groupname+"&groupvalue="+groupvalue;
    
            $.ajax({
        type: "POST",
        url: "reward_campaigns.php",
        data: data,
        success: function(data)
        {
           window.location.href="reward_campaigns.php";
           
        }
    });
    }else{
         if(groupname=="" ){
        $('#group_name').focus();
    }else if(groupvalue==''){
        $('#group_value').focus(); 
    }
        
        
    }
     
}

function numdot(e) {     
   
            var charCode;
 
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43 || charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }


function date_to_valid(e){
   
   
   var from =$('#datepicker_new').val();
    var to =$('#datepicker_new1').val();
    
    if(from==''){
     
       alert('Select From Date First');
        $('#datepicker_new1').val('')  ;
        $('#datepicker_new1').focus()  ;
    }
   
   
   if(Date.parse(from) > Date.parse(to)){
   alert("Invalid Date Range");
     $('#datepicker_new1').val('')  ;
       $('#datepicker_new1').focus()  ;
}
   
   
}



function date_from_valid(e){
   
   
   var from =$('#datepicker_new').val();
    var to =$('#datepicker_new1').val();
    
    if(from==''){
     $('#datepicker_new1').val('');
     
       
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