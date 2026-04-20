<?php
session_start();
include("..\database.class.php"); 
$database	= new Database();

//error_reporting(0);

        $loyalty_count="";
$loyalty_id_reg="";
if(isset($_REQUEST['loyalty_id'])&&($_REQUEST['loyalty_id']!="")){
    
    $loyalty_id_reg=$_REQUEST['loyalty_id'];
    $loyalty_count=$_REQUEST['loyalty_count'];
   
    
    $_SESSION['loy_vch_id']=$loyalty_id_reg;
        }

        
  
if(isset($_REQUEST['set_update_sts']) && $_REQUEST['set_update_sts']=="voucher_update_sts"){
 
         $id=$_REQUEST['sts_id'];
             $sts=$_REQUEST['sts'];
         
     $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_voucher SET vr_active='".$sts."' where vr_voucherid='".$id."'");   
        
}



  
if(isset($_REQUEST['set_voucher'])&&($_REQUEST['set_voucher']=="voucher_add")){
    
    
    
//     $loy_qry_vc = $database->mysqlQuery("select bsc_cloud_groupid from tbl_branch_settings_cloud");
//    $num_loy_vc = $database->mysqlNumRows($loy_qry_vc);
//     if($num_loy_vc)
//     {
//         while($loyalty_group_vc = $database->mysqlFetchArray($loy_qry_vc))
//         {
//             
//           $groupid=$loyalty_group_vc['bsc_cloud_groupid'];  
//         }
//         }
//        
        
         
         
         
$loyalty_count_add=$_REQUEST['vloy_count'];    
$loyalty_id_add=$_REQUEST['vloy_id'];    

if($loyalty_count_add==""){
    $loyalty_count_add=0;
}

$vname=$_REQUEST['vname'];
$vfrom=$_REQUEST['vfrom'];
$vto=$_REQUEST['vto'];
$vcost=$_REQUEST['vcost'];
$vunit=$_REQUEST['vunit'];
$vholder=$_REQUEST['vholder'];
$vstatus=$_REQUEST['vstatus'];
$voucherid= 'VCH-'.$loyalty_id_add."-".$loyalty_count_add;
$new_count=$loyalty_count_add+1;

        $insertion['vr_voucherid'] = mysqli_real_escape_string($database->DatabaseLink,trim($voucherid)); 
        $insertion['vr_vouchername'] = mysqli_real_escape_string($database->DatabaseLink,trim($vname)); 
        $insertion['vr_voucherfrom'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($vfrom)); 
        $insertion['vr_voucherexpiry']=  mysqli_real_escape_string($database->DatabaseLink,trim($vto)); 
        $insertion['vr_vouchercost']=  mysqli_real_escape_string($database->DatabaseLink,trim($vcost));
        $insertion['vr_vouchercost_unit']=  mysqli_real_escape_string($database->DatabaseLink,trim($vunit));
        $insertion['vr_voucherholder']= mysqli_real_escape_string($database->DatabaseLink,trim($loyalty_id_add));
        $insertion['vr_active']= mysqli_real_escape_string($database->DatabaseLink,trim($vstatus));
	
    
	$insertid      =  $database->insert('tbl_loyalty_voucher',$insertion); 
        
        
        
          $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_voucher_count='".$new_count."' where ly_id='".$loyalty_id_add."'");
          echo $new_count;  
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
        
       <script type="text/javascript" src="searcher/jquery/jquery-1.11.0.min"></script>
        <script type="text/javascript" src="searcher/jquery-autocomplete.js"></script>
        
        <script src="assets/js/modernizr.min.js"></script>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}
	.action-btn {width: 19px;height: 23px;display: inline-block;margin-right: 5px;font-size: 17px;color: #666 !important;}
	</style>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    
                	<!--<div class="top-head-section">
                    		Registration Listing
                            <a href="registration.php"><div class="top-head-add-btn">+ADD</div></a>
                            <strong style="color:limegreen" id="msg_show"></strong>
                    </div>-->
                    
                    <div class="container">
                        <input type="hidden" value="<?=$loyalty_id_reg?>" count='<?=$loyalty_count?>'  id='hidden_loyal_id' >
                         <input type="hidden"    id='edit_id_voucher' >
                            
                        <div class="listting-top-filter-section">
                          
                        	<div class="col-md-2" style="padding-left:0" id="vouchername_div">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Voucher Name</div>
                                        <input type="text" class="list-filter-textbox" autocomplete="off"  placeholder="Voucher Name" id="vouchername" >
                                </div>
                            </div>
                           
                            <div class="col-md-2" style="padding-left:0;width: 10%" id="datepicker_div">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">From</div>
                                    <input type="text" class="list-filter-textbox" autocomplete="off" placeholder="From" onchange="date_from_valid(event);" id="datepicker" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0;width: 10%" id="datepicker1_div">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">To</div>
                                        <input type="text" autocomplete="off" class="list-filter-textbox" placeholder="To" onchange="date_to_valid(event);" id="datepicker1" data-provide="datepicker" >
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0;width: 13%" id="cost_div">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Cost</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Cost" id="cost" >
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:0;width: 8%" id="unit_div" >
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Unit</div>
                                        <select class="list-filter-textbox" id="unit">
                                             <option value="V">V</option>
                                            <option value="P">%</option>
                                           
                                        </select>
                                </div>
                            </div>
<!--                            <div class="col-md-2" style="padding-left:0">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Holder Name</div>
                                        <input type="text" class="list-filter-textbox" placeholder="Holder Name" id="holder">
                                </div>
                            </div>-->
                            <div class="col-md-2" style="padding-left:0;width: 10%" id="status_div">
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Status</div>
                                        <select class="list-filter-textbox" id="status">
                                            
                                            <option value="Y">Active</option>
                                            <option value="N">Inactive</option>
                                        </select>
                                </div>
                            </div>
                         
                            <a id="add_div" href="#" onclick="return add_voucher();"> <div class="submit-button-filter">+ADD</div></a>
                            <a id="update_div" style="display:none" href="#" onclick="return update_voucher();"> <div class="submit-button-filter">UPDATE</div></a>
                            <a href="listing.php"> <div class="submit-button-filter"   style="background-color:darkseagreen;float: right" > <i class="fa fa-users"></i> BACK </div></a>
                          
                        </div>
                        <div class="card-box table-responsive">
                            
                        	<table id="vouvher_table" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                    <th style="min-width:80px;">Action</th>
                                    <th style="min-width:120px;">Voucher Id</th>
                                   	<th style="min-width:210px;">Voucher Name </th>
                                    <th style="min-width:100px;"> From</th>
                                    <th style="min-width:100px;">To</th>
                                    <th style="min-width:100px;">Cost</th>
                                    <th style="min-width:80px;">Unit</th>
                                    <th style="min-width:120px;">Holder Name</th>
                                    <th style="min-width:9px;">Status</th>
                                  
                                </tr>
                                </thead>


                                <tbody >
                               
                                     <?php
                               
     $loy_qry = $database->mysqlQuery("select *,tr.ly_firstname from tbl_loyalty_voucher tv left join tbl_loyalty_reg tr on tr.ly_id=tv.vr_voucherholder where tv.vr_voucherholder='". $_SESSION['loy_vch_id']."'");
    $num_loy = $database->mysqlNumRows($loy_qry);
     if($num_loy)
     {$i=0;
         while($loyalty_voucher = $database->mysqlFetchArray($loy_qry))
         {$i++;
                                ?> 
                                    
                                    
                                <tr>
                                    <td style="min-width:80px;">
                                        <a href="#" onclick="return edit_voucher('<?=$loyalty_voucher['vr_voucherid']?>');" class="action-btn"><span class="ti-pencil"></span></a>
                                    	
                                    </td>
                                    <td style="min-width:120px;"><?=$loyalty_voucher['vr_voucherid']?></td>
                                    <td style="min-width:210px;"><?=$loyalty_voucher['vr_vouchername']?></td>
                                    <td style="min-width:100px;"><?=$loyalty_voucher['vr_voucherfrom']?></td>
                                    <td style="min-width:100px;"><?=$loyalty_voucher['vr_voucherexpiry']?></td>
                                    <td style="min-width:100px;"><?=$loyalty_voucher['vr_vouchercost']?></td>
                                    <td style="min-width:80px;"><?=$loyalty_voucher['vr_vouchercost_unit']?></td>
                                    <td style="min-width:110px;"><?=$loyalty_voucher['ly_firstname']?></td>
                                    <td style="min-width:90px;"><?=$loyalty_voucher['vr_active']?></td>
                                    
                                </tr>
     <?php } } ?>
                                </tbody>
                            </table>
                        
                        </div>

                    </div> 

                </div> 

            </div>

        </div>
        
        
        
        
						

		
					
						
       
        <script>
            var resizefunc = [];
        </script>

       
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
        
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
        
        
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        
        
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        
        <script type="text/javascript">
            
            
             $(function() {
           $('#vouchername').focus();
           
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
            
           var table = $('#vouvher_table').DataTable({
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            
        });

        function add_voucher(){
            
            var hid_loyal_id=$('#hidden_loyal_id').val();
            var hid_count=$('#hidden_loyal_id').attr('count');
          
            
           var vname=$('#vouchername').val();
           var vfrom=$('#datepicker').val();
           var vto=$('#datepicker1').val();
           var vcost=$('#cost').val();
           var vunit=$('#unit').val();
           
           var vstatus=$('#status').val();
          
           if(vcost!="" && vname!="" && vfrom!=""  && vto!="" ){
            var data="set_voucher=voucher_add&vname="+vname+"&vfrom="+vfrom+"&vto="+vto+"&vcost="+vcost+"&vunit="+vunit+"&vstatus="+vstatus+"&vloy_id="+hid_loyal_id+"&vloy_count="+hid_count;
           
          
        $.ajax({
        type: "POST",
        url: "loyalty_voucher_generate.php",
        data: data,
        success: function(data)
        {  
            
           
            alert('Voucher Added Sucessfully');
           
           window.location.href='listing.php';
        }
    });
    }else{
        alert('Please Enter Details ');
    }
        }
        
        
function edit_voucher(v){
    $('#vouchername_div').hide();
    $('#datepicker_div').hide();
    $('#datepicker1_div').hide();
    $('#unit_div').hide();
    $('#cost_div').hide();
    $('#add_div').hide();
    $('#update_div').show();
    
   $('#edit_id_voucher').val(v);
   
}


function update_voucher(){
    
    var sts=$('#status').val();
        var id= $('#edit_id_voucher').val();
     var data="set_update_sts=voucher_update_sts&sts="+sts+"&sts_id="+id;
 
           
        $.ajax({
        type: "POST",
        url: "loyalty_voucher_generate.php",
        data: data,
        success: function(data)
        {  
           
           location.reload();
        }
    });
    
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
			.modal .modal-dialog .modal-content .group{margin-bottom: 16px;}.modal-dialog{width:500px !important;top: 10%;}
                     
		</style>

    </body>

</html>