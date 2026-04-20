<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

if(isset($_REQUEST['set_reward_update'])&&($_REQUEST['set_reward_update']=="reward_update")){
    
   $name=$_REQUEST['name']; 
    $from=$_REQUEST['from']; 
     $to=$_REQUEST['to']; 
      $id=$_REQUEST['id']; 
       $status=$_REQUEST['status']; 
        $condent=$_REQUEST['condent']; 
       
    
    $sql_smsattemt_updation1  =  $database->mysqlQuery("UPDATE tbl_loyalty_campaign SET lc_name='".$name."',lc_from='".$from."',lc_to='".$to."',lc_active='".$status."',lc_condent='".$condent."' where lc_id='".$id."'");
             
    
}
 

if(isset($_REQUEST['set_reward_delete'])&&($_REQUEST['set_reward_delete']=="reward_delete")){
    $c_id=$_REQUEST['c_id'];
    $database->mysqlQuery("DELETE FROM tbl_loyalty_campaign WHERE lc_id = '" .$c_id."'");
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
 <script src="loyalty_js/loy.js"></script>
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
                        <h2><a href="reward_campaigns.php"><div style="float:left" class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a> Manage Campaigns </h2>
                        
                     </div>

                        
                      
                        
                        <div class="card-box table-responsive">
                        	
							
                       		<table id="campagn-table" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                    <th style="min-width:100px;">Action</th>
                                    <th style="min-width:150px;"> Name</th>
                                    <th style="min-width:100px;">Valid From</th>
                                    <th style="min-width:100px;">Valid To</th>
                                    <th style="min-width:100px;">Content</th>
                                    <th style="min-width:100px;">Status</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                     
                                             <?php
                               
     $loy_qry_reward = $database->mysqlQuery("select * from tbl_loyalty_campaign");
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
         {
                                ?>
                                     <tr>
                                 	<td  style="min-width:100px;">
                                            <a href="view_campaign_deatil.php?cmp_id=<?=$loyalty_listing_reward['lc_id']?>" title="View Details"   class="action-btn"><span class="ti-eye"></span></a>
                                            <a href="#" data-toggle="modal" data-target="#send-campign-popup" onclick="return condent_setting('<?=$loyalty_listing_reward['lc_condent']?>','<?=$loyalty_listing_reward['lc_name']?>','<?=$loyalty_listing_reward['lc_id']?>','<?=$loyalty_listing_reward['lc_from']?>','<?=$loyalty_listing_reward['lc_to']?>');"  class="action-btn"><span class="fa fa-send"></span></a>
                                 		<a href="#"   onclick=" return edit_reward('<?=$loyalty_listing_reward['lc_name']?>','<?=$loyalty_listing_reward['lc_from']?>','<?=$loyalty_listing_reward['lc_to']?>','<?=$loyalty_listing_reward['lc_id']?>','<?=$loyalty_listing_reward['lc_active']?>','<?=$loyalty_listing_reward['lc_condent']?>')"  data-toggle="modal" data-target="#send-mail-popup" class="action-btn"><span class="ti-pencil"></span></a>
                                                <a href="#" onclick=" return delete_reward('<?=$loyalty_listing_reward['lc_id']?>')" class="action-btn"><span class="ti-trash"></span></a>
                                 	</td>
					<td  style="min-width:150px;"><?=$loyalty_listing_reward['lc_name']?></td>
                                	<td  style="min-width:150px;"><?=$loyalty_listing_reward['lc_from']?></td>
                                	<td  style="min-width:150px;"><?=$loyalty_listing_reward['lc_to']?></td>
                                        <td  style="min-width:150px;"><?=$loyalty_listing_reward['lc_condent']?></td>
                                        <td  style="min-width:150px;"><?=$loyalty_listing_reward['lc_active']?></td>
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
										<h4>  UPDATE CAMPAIGN</h4>
                                            
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0;background-color: #f4f8fb;">
                                       
                                       <div class="col-md-12">
											<div class="group">
                                                                                            <input id="c_name1" required="" name="" type="text" value="">
												<label>Campaign Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            
                                                                  <div class="col-md-12">
											<div class="group">
                                                                                            <textarea placeholder="About Campaign" maxlength="160" style="height:80px;width: 100%;resize: none" id="c_condent1" required=""></textarea>
												
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>           
                                                                            
                                                                            
                                        <div class="col-md-6">
											<div class="group">
												<input id="datepicker" required="" onchange="date_from_valid(event);" name="" type="text" value="">
												<label>From</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                                   <div class="col-md-6">
											<div class="group">
												<input id="datepicker1" required="" name=""  onchange="date_to_valid(event);" type="text" value="">
												<label>To</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
                                                                                                  
										</div>  
                                                                             <div class="col-md-6">
                                                                           <div class="group">
                                                                               <select id="status" class="select-registration" >
                                                                                                          <option value="Y">Active</option>
                                                                                                          <option value="N">Inactive</option>
                                                                                                      </select>
												
												
											 </div>
                                                                                  </div>
                                                                            
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
									<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                                                                        <button id="upd_id" onclick="update_reward();"  style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> Update</button>
									</div>
                                    
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
                                                        
						</div><!-- /.modal -->
        
        
        <div id="send-campign-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <input type="hidden" id="reward_condent" >   
            <input type="hidden" id="campaign_id" >
             <input type="hidden" id="from_date_coupon" >
              <input type="hidden" id="to_date_coupon" >
            
            <div class="modal-dialog sms_popup_close" style="width: 550px !important; top: 4%;">
                <div style="top:0;height: 100%;padding-top: 30%;display: none" class="new_print_loading_bill_sms"><img src="assets/images/sending.gif"></div>
               <div class="modal-content ac_popup" style="background-color: #f4f8fb;height: 540px">
                  <div class="modal-body" style="text-align: center;padding: 0">
                      <h4>
                           <select onchange="add_to_group();" id="check_group" style="background-color:#907320 !important;float: left" class="btn btn-default buttons-csv buttons-html5 btn-sm">
                               <option value="">Select Group</option>
                                <?php  
                                $loy_qry = $database->mysqlQuery("select * from tbl_loyalty_campaign_group where gp_status='Y' ");
                    $num_loy = $database->mysqlNumRows($loy_qry);
                    if($num_loy)
                    {
                    while($loyalty_listing = $database->mysqlFetchArray($loy_qry))
                    {
                          ?>     
                                <option value="<?=$loyalty_listing['gp_id']?>"> <?=$loyalty_listing['gp_groupname']?> </option>
                    <?php }} ?>
                            </select>
                          
                          
                          <span id="reward_name_set"></span>
                           <label  style="float:right;"><a style="background-color: #907320  !important;margin-left:5px;border:0 !important"  class="btn btn-primary waves-effect waves-light"><input class="camp_chk smson" style="top:-2px" type="checkbox"> SMS</a></label>
                         
                           <label style="float:right;"><a style="background-color: #907320  !important;border:0 !important"  class="btn btn-primary waves-effect waves-light"><input style="top:-2px" class="camp_chk mailon" type="checkbox"> MAIL</a></label>
                      </h4>
                     
                  </div>
                  <div class="modal-content inner-textbox-effect hid_tab" style="border: 0;background-color: #f4f8fb;">
                     <div class="col-md-12" style="padding:0">
<!--                        <div class="campign-filter-popup view_search">
                            
                             <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                        <input type="text" class="list-filter-textbox" autofocus placeholder="Name" onkeyup="return name_search();" onfocus=" name_search()" onclick=" name_search()" id="name_search">
                                    </div>
                                </div>
                            <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                            <input type="text" class="list-filter-textbox" placeholder="Number" onkeyup="return number_search();" onfocus=" number_search()" onclick=" number_search()"  id="number_search">
                                    </div>
                                </div>
                             <div class="col-md-4" style="padding-left:0">
                                    <div class="filter-textbox-cc">
                                        <div class="table-filter-text"></div>
                                            <input type="text" class="list-filter-textbox" placeholder="Mail" onkeyup="return mail_search();" onfocus="mail_search()" onclick="mail_search()" id="mail_search">
                                    </div>
                                </div>
                         </div>-->
                         
                         <div class="campign-filter-table-sec">
                            <table id="cmp_pop_tbl"  class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                    <th style="min-width:150px;max-width:50px;">
                                        <span id="view_tick">
<!--                                        <input id="check_all" class="camp_chk" type="checkbox">-->
                                        </span>
                                        Name
                                    </th>
                                    <th style="min-width:100px;"> Mobile</th>
                                    <th style="min-width:150px;"> Email</th>
                                </tr>
                                </thead>
                                 <tbody id="load_camp_msg">
                                     
                                 </tbody>
                           </table>
                             
                         </div>
                         
                         
                     </div>
                     
                    
                  </div>
                  <div class="modal-footer" style="border: 0;text-align: center;">
                     
                     <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
                     <button id="upd_id" onclick="send_reward();" style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> Send</button>
                  <span style="width: 100%;float: left;height: 20px;margin-top: 5px"> <span id="error_msg" style="display:none;color:red;"></span></span>
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            
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


function delete_reward(i){
     var check = confirm("Are you sure you want to Delete ?");
	if(check==true)
	{
   var data="set_reward_delete=reward_delete&c_id="+i;
        $.ajax({
        type: "POST",
        url: "manage_campaign.php",
        data: data,
        success: function(data)
        {
           location.reload();
           
        }
    }); 
        }
}


function edit_reward(n,f,t,i,s,c){
    
    
    $('#c_name1').val(n);
     $('#c_condent1').val(c);
     $('#datepicker').val(f);
      $('#datepicker1').val(t);
    $('#upd_id').attr('update_id',i);
    $('#status').val(s);
}

function update_reward(){
    
    var name= $('#c_name1').val();
   var from= $('#datepicker').val();
    var to=  $('#datepicker1').val();
    var id= $('#upd_id').attr('update_id');
    var status=$('#status').val();
    var condent=$('#c_condent1').val();
    
     if(name!="" && from!="" && to!="" && condent!='' ){
     var data="set_reward_update=reward_update&name="+name+"&from="+from+"&to="+to+"&id="+id+"&status="+status+"&condent="+condent;
    
        $.ajax({
        type: "POST",
        url: "manage_campaign.php",
        data: data,
        success: function(data)
        {
           location.reload();
           
        }
    }); 
    
        }
        else{
     
        if(name==''){
             $('#c_name1').focus();
        }    
       else if(condent==''){
             $('#c_condent1').focus();
        }  
     else  if(from==''){
             $('#datepicker').focus();
        }   
        
       else if(to==''){
             $('#datepicker1').focus();
        }   
        
        
        
    }
    
}





function name_search(){
    
        var name_camp=$('#name_search').val();
   
        var data="set_camp_msg=msg_camp&name_camp="+name_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
          // $('#load_camp_msg').html(data);
        }
    }); 
    
}


function mail_search(){
    
        var mail_camp=$('#mail_search').val();
   
        var data="set_camp_msg=msg_camp&mail_camp="+mail_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
           //$('#load_camp_msg').html(data);
        }
    }); 
    
}



function number_search(){
    
        var number_camp=$('#number_search').val();
   
        var data="set_camp_msg=msg_camp&number_camp="+number_camp;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
           //$('#load_camp_msg').html(data);
        }
    }); 
    
}

function condent_setting(cd,nm,i,f,t){
   $('#reward_condent').val(cd);
    $('#reward_name_set').html(nm);
    $('#campaign_id').val(i);
     $('#from_date_coupon').val(f);
      $('#to_date_coupon').val(t);
   
   }
   
   
   
   
   
   function date_to_valid(e){
   
   
   var from =$('#datepicker').val();
    var to =$('#datepicker1').val();
    
    if(from==''){
     
       alert('Select From Date First');
        $('#datepicker1').val('')  ;
        $('#datepicker1').focus()  ;
    }
   
   if(Date.parse(from) > Date.parse(to)){
   alert("Invalid Date Range");
     $('#datepicker1').val('')  ;
       $('#datepicker1').focus()  ;
}
  
}


function date_from_valid(e){
   
   
   var from =$('#datepicker').val();
    var to =$('#datepicker1').val();
    
    if(from==''){
     $('#datepicker1').val('');
           
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