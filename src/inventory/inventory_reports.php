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

        <title>Reports </title>

        <!--Morris Chart CSS -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/custombox/css/custombox.css" rel="stylesheet">
         <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        

		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/css/content.css" rel="stylesheet" type="text/css" />
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
            <div class="loyalty_mgmt_head"><div class=""> <span classs="" style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(223deg, #ffffff, #ffffff)!important;padding: 0.7rem;">REPORT MASTER</span> 
                    
                    
                    </div></div>

          
            
            
            <div class="content-page">
               
                <div class="content">
                	
                    <div class="container" style="overflow:auto;" >
<div class="inv-req-content">


<div class="inv-req-history" >
 <span id="load_error" style="color:darkred;font-size: 10px;float: right;margin-right:77px;margin-top: -25px;font-weight: bold" ></span>

  <div class="history-filter">
      
       <select onchange="report_type();"  id="report_type" >
    
    <option style="background-color: darkred;color: white" value="">Select Report Type</option>
    
     <option value="store_stock_report">Store Stock Report</option>
     <option value="grn_report">R-P-S Report</option>
      <option value="req_report">Requisition/Purchase Report</option>
     <option value="grn_item_report">Grn Item Wise Report</option>
     <option value="transfer_report">Store Transfer Report</option>
     <option value="physical_stock_report">Physical Stock Report</option>
      <option value="sales_reduce">Item Sales / Stock Report</option>
      <option value="purchase_return">Purchase Return Report</option>
      <option value="consumption_report">Consumption Report</option>
       <option value="wastage_report">Wastage Report</option>
     <option value="production_report">Production Report</option>
      <option value="conversion_report">Conversion Report</option>
       <option value="food_cost_report">Food Cost Report</option>
        <option value="central_report">Central Transfer Report</option>
        <option value="supplier_report">Supplier Purchase Report</option>
          <option value="expiry_report">Item Expiry Report</option>
       </select>
      
   
     <select onchange="search_history();"  id="bydate"  style="display:none">
     <option value="">Normal Stock</option>
  
     <option value="three">Stock In Last 3 Months</option>
     
      </select>
      
      <select onchange="search_history();"  id="entry_type"  style="display:none">
     <option value="all">Select Type</option>
  
     <option value="req">Requisition</option>
     <option value="purchase">Purchase Order</option>
        <option value="stock">Stock Purchase</option>
     
      </select>
      
      
    <select onchange="search_history();"  id="status_search" style="display: none " >
    <option value="All">Select Status</option>
    <option value="">Pending</option>
    <option value="Approved">Approved</option>
    <option value="Cancel">Cancelled</option>
    </select>
      
    <select onchange="search_history();"  id="status_expiry" style="display: none " >
   
    <option style="color:red"  value="expired">Expired</option>
    
    <option style="color:red"  value="expiry7">Expired 7 Days Ago</option>
    <option style="color:red"  value="expiry15">Expired 15 Days Ago</option>
    
    <option style="color:orange" value="nearing7">Expiring In 7 Days </option>
    <option style="color:orange"  value="nearing15">Expiring In 15 Days </option>
    <option style="color:green"  value="not_expired">Not Expired</option>
    </select>
      
      
     <select onchange="search_history();"  id="req_po"  style="display:none">
   
     <option value="req">Requisition</option>
     <option value="purchase">Purchase Order</option>
     
      </select>
      
      
     <select onchange="search_history();"  id="stock_check"  style="display:none">
     <option value="">Select Stock Type</option>
     <option value="in"> Stock Available</option>
     <option value="out">Out Of Stock</option>
      <option value="reorder">Reorder</option>
      </select>
      
      <select onchange="search_history();"  id="indent_type"  style="display:none">
     <option value="all">Select Type</option>
     <option value="normal">Requisition</option>
     <option value="indent">Indent</option>
     
     <?php if($_SESSION['ser_central_kitchen']=='Y'){ ?>
     <option value="central">Central Requisition</option>
     <?php } ?>
      </select>
      
      
     <select onchange="search_history();"  id="type_view"  style="display:none">
     <option value="">Select Type</option>
     <option value="summmary">Direct Sale</option>
     <option value="detailed">Recipe</option>
    
      </select>
      
      
       <select onchange="search_history();"  id="recipe_type"  style="display:none">
    
     <option value="">Sales Reduction</option>
     <option value="recipe">Recipe</option>
      <option value="stock">Stock Detail</option>
    
      </select>
      
      
      <input onkeyup="search_history();" placeholder="Product Name" id="product"  style="display:none"  type="text" > 
      
      <input onkeyup="search_history();" placeholder="Search Id" id="id"  style="display:none"  type="text" > 
      
    
      
       <input onkeyup="search_history();" placeholder="To Product" id="product1"  style="display:none"  type="text" > 
       
      <input onkeyup="search_history();" placeholder="Barcode" id="barcode" style="display:none"  type="text" > 
 
      
      
      <select id="central_type" onchange="search_history();" style="display:none">
         
          <option value="Transfer">Transfer</option>
          <option value="Accept">Accept</option>
      </select>
      
      
     <select onchange="search_history();"  id="category" style="display:none">
    
     <option value="">All Category</option>
    
     <?php
     $sql_kotlist  =  $database->mysqlQuery("SELECT mmy_maincategoryid,mmy_maincategoryname from tbl_menumaincategory  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['mmy_maincategoryid']?>"><?=$result_kotlist['mmy_maincategoryname']?></option>  
         <?php
                  }
              }
         ?>                    
  </select>
      
      
     <select onchange="search_history();"  id="store" style="display: none ">
       <option value="">All Store</option>  
      <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_inv_kitchen where ti_status='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ti_id']?>"><?=$result_kotlist['ti_name']?></option>  
       <?php
                                }
                                }
            ?>                    
          
  </select>
      
      <select onchange="search_history();"  id="from_store" style="display: none ">
       <option value="">From Store</option>  
      <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_inv_kitchen where ti_status='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ti_id']?>"><?=$result_kotlist['ti_name']?></option>  
       <?php
                                }
                                }
            ?>                    
          
  </select>
      
      <select onchange="search_history();"  id="to_store" style="display: none ">
       <option value="">To Store</option>  
      <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_inv_kitchen where ti_status='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ti_id']?>"><?=$result_kotlist['ti_name']?></option>  
       <?php
                                }
                                }
            ?>                    
          
  </select>
        
      
      <select onchange="search_history();"  id="supplier" style="display: none ">
       <option value="" >All Supplier</option>  
      <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_vendor_master where v_active='Y' order by v_name asc "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['v_id']?>"><?=$result_kotlist['v_name']?></option>  
       <?php
                                }
                                }
       ?>                    
          
    </select>
      
      
       <select onchange="search_history();"  id="login_staff" style="display: none ">
       <option value="" >User</option>  
      <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_logindetails  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ls_username']?>"><?=$result_kotlist['ls_username']?></option>  
       <?php
                                }
                                }
       ?>                    
          
    </select>
      
      
      <input value="<?=date('Y-m-d')?>" onchange="search_history();" placeholder="From" id="fromdt"  style="display:none"  type="text" > 
       
       <input value="<?=date('Y-m-d')?>" onchange="search_history();" placeholder="To"   id="todt"    style="display:none"  type="text" > 
      
      
       <select id="asc_desc" onchange="search_history();" style="display:none">
            <option value="">Sort by </option>
            <option value="ascq">Lower Qty</option>
            <option value="descq">Higher Qty</option>
             <option value="ascw">Lower Weight</option>
             <option value="descw">Higher Weight</option>
       </select>
       
       
   <span onclick="excel_download()" class="excel_download_btn" style="display: none;right: 0px;float: right;cursor: pointer;font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;padding: 3px;background-color: darkred;color: white">Excel</span> 
  
   </div>
 
   <div style="overflow-y: auto;height: 75vh;position: relative" id="load_store_stock">

   <span style="color:darkred;font-weight: bold">  &nbsp;&nbsp;&nbsp;&nbsp; [ NO RECORDS TO DISPLAY ] </span>
       
   </div>
    
</div>
	</div>
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

        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
         <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert2.init.js"></script>
        
        <!-- Modal-Effect -->
        <script src="assets/plugins/custombox/js/custombox.min.js"></script>
        <script src="assets/plugins/custombox/js/legacy.min.js"></script>
       <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> 
        
			<script type="text/javascript">
    $(document).ready(function () {
        
         $( "#fromdt").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
           
        $( "#todt").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
           
           
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
        
        
  $('#report_type').change(function(){
      
      
   var tdate = new Date();
   var dd = tdate.getDate();
   var MM = tdate.getMonth(); 
   var yyyy = tdate.getFullYear(); 
   var currentDate= yyyy + "-" +( MM+1) + "-" + dd;
    
           
     $('#entry_type').val('all');
   
     $('#status_search').val('All');
   
     $('#id').val('');
   
     $('#fromdt').val(currentDate);
   
     $('#todt').val(currentDate);
     
    $('#product').val('');
   
    $('#barcode').val('');
   
    $('#expiry').val('');
   
    $('#reorder').val('');
    
    $('#brand').val('');
    
    $('#category').val('');
    
    $('#store').val('');
   
    $('#supplier').val('');
    
    $('#type_view').val('');
   
    $('#central_type').val('Transfer');
    
    $('#recipe_type').val('');
   
    $('#stock_check').val('');
   
    $('#asc_desc').val('');
    
     $('#indent_type').val('all');
    
           
       }); 
        
        
       
    });
    TableManageButtons.init();

     function report_type(){
         
         if($('#status_search').val()!='' && $('#status_search').val()!=undefined){
        var status_search=$('#status_search').val();
    }else{
        var status_search='';
    }
    
    
    if($('#entry_type').val()!='' && $('#entry_type').val()!=undefined){
        var type=$('#entry_type').val();
    }else{
        var type='';
    }
          
          if($('#id').val()!='' && $('#id').val()!=undefined){
        var id=$('#id').val();
    }else{
        var id='';
    }
         
         if($('#fromdt').val()!='' && $('#fromdt').val()!=undefined){
        var fromdt=$('#fromdt').val();
    }else{
        var fromdt='';
    }
         
         if($('#todt').val()!='' && $('#todt').val()!=undefined){
        var todt=$('#todt').val();
    }else{
        var todt='';
    }
    
         
      if($('#product').val()!='' && $('#product').val()!=undefined){
        var product=$('#product').val();
    }else{
        var product='';
    }
      
      if($('#barcode').val()!='' && $('#barcode').val()!=undefined){
        var barcode=$('#barcode').val();
    }else{
        var barcode='';
    }
      
     if($('#expiry').val()!='' && $('#expiry').val()!=undefined){
        var expiry=$('#expiry').val();
    }else{
        var expiry='';
    }
    
     if($('#reorder').val()!='' && $('#reorder').val()!=undefined){
        var reorder=$('#reorder').val();
    }else{
        var reorder='';
    }
     
    if($('#brand').val()!='' && $('#brand').val()!=undefined){
        var brand=$('#brand').val();
    }else{
        var brand='';
    }
     
     
     if($('#category').val()!='' && $('#category').val()!=undefined){
        var category=$('#category').val();
    }else{
        var category='';
    }
     
     if($('#store').val()!='' && $('#store').val()!=undefined){
        var store=$('#store').val();
    }else{
        var store='';
    }   
         
       if($('#supplier').val()!='' && $('#supplier').val()!=undefined){
        var supplier=$('#supplier').val();
    }else{
        var supplier='';
    }     
         
       if($('#type_view').val()!='' && $('#type_view').val()!=undefined){
        var type_view=$('#type_view').val();
    }else{
        var type_view='';
    }
      
          
       if($('#central_type').val()!='' && $('#central_type').val()!=undefined){
        var central_type=$('#central_type').val();
    }else{
        var central_type='';
    } 
       
       
        if($('#stock_check').val()!='' && $('#stock_check').val()!=undefined){
        var stock_check=$('#stock_check').val();
    }else{
        var stock_check='';
    } 
       
        if($('#asc_desc').val()!='' && $('#asc_desc').val()!=undefined){
        var asc_desc=$('#asc_desc').val();
    }else{
        var asc_desc='';
    } 
    
     
        if($('#from_store').val()!='' && $('#from_store').val()!=undefined){
        var from_store=$('#from_store').val();
    }else{
        var from_store='';
    } 
    
     
     if($('#to_store').val()!='' && $('#to_store').val()!=undefined){
        var to_store=$('#to_store').val();
    }else{
        var to_store='';
    } 
    
    
    if($('#status_expiry').val()!='' && $('#status_expiry').val()!=undefined){
        var status_expiry=$('#status_expiry').val();
    }else{
        var status_expiry='';
    } 
    
    
    
    
    
    var recipe_type=$('#recipe_type').val();   
         
         
     var report_type=$('#report_type').val();
     
         
     var product1=$('#product1').val();
     
     
     
     if(report_type=='sales_reduce'){
         $('#recipe_type').show();
     }else{
         $('#recipe_type').hide(); 
     }
     
     
     
     
     
      if(report_type=='store_stock_report'){
     
        $('#stock_check').show();
         $('#bydate').show();
        
      }else{
          
           $('#stock_check').hide();
            $('#bydate').hide();
      }
      
      
       if(report_type=='wastage_report' || report_type=='consumption_report' || report_type=='grn_item_report'){
     
        $('#asc_desc').show();
      }else{
          
           $('#asc_desc').hide();
      }
      
      
     
     
      if(report_type=='expiry_report'){
     
        $('#status_expiry').show();
      }else{
          
           $('#status_expiry').hide();
      }
      
      
       if(report_type=='transfer_report'){
           
            $('#from_store').show();
     
            $('#to_store').show();
          
          $('#indent_type').show();
          
          
       }else{
             $('#from_store').hide();
     
             $('#to_store').hide();
             
               $('#indent_type').hide();
       }
       
       
       if(report_type=='req_report'){
           
          
          $('#indent_type').show();
           $('#req_po').show();
           $('#login_staff').show(); 
          
       }else{
               $('#req_po').hide();
            $('#indent_type').hide();
               $('#login_staff').hide(); 
       }
       
       
       
       
       if(report_type=='conversion_report'){
           
       $('#from_store').show();
         $('#product1').show();
        
       }else{
             $('#from_store').hide();
            $('#product1').hide();
              
       }
      
          
    if(report_type=='store_stock_report'){
              
    $('#product').show();
     
    $('#barcode').show();
     
    $('#expiry').show();
    
    $('#stock_check').show();
      
    $('#category').show();
    
    $('#store').show();
    
      $('#type_view').hide();
    
    $('.excel_download_btn').show();
   $('#status_search').hide();
      
       $('#id').hide();
       
        $('#fromdt').hide();
        
         $('#todt').hide();
        
      $('#entry_type').hide();
      
       $('#supplier').hide();
       $('#central_type').hide();
     fromdt=''; todt='';
     
       $('#bydate').show();
      var bydate= $('#bydate').val();
     
    var data="set=load_store_stock&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&stock_check="+stock_check+"&bydate="+bydate
    //  alert(data);  
            $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        { 
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='central_report'){
              
   $('#product').hide();
      
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').hide();
    
    $('#store').hide();
     $('#type_view').hide();
     $('#entry_type').hide();
     
      $('#status_search').hide();
      
       $('#id').show();
       
        $('#fromdt').show();
        
         $('#todt').show();
         $('#supplier').hide();
          $('#central_type').show();
      $('.excel_download_btn').show();
    var data="set=central_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&central_type="+central_type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }
    else if(report_type=='supplier_report'){
              
   $('#product').hide();
      
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').hide();
    
    $('#store').hide();
     $('#type_view').hide();
     $('#entry_type').hide();
     
      $('#status_search').hide();
      
       $('#id').hide();
       
        $('#fromdt').show();
        
         $('#todt').show();
         $('#supplier').show();
          $('#central_type').hide();
      $('.excel_download_btn').show();
      
    var data="set=supplier_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }
    else if(report_type=='grn_report'){
              
   $('#product').hide();
      
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').hide();
    
    $('#store').hide();
     $('#type_view').hide();
     $('#entry_type').show();
     
      $('#status_search').show();
      
       $('#id').show();
       
        $('#fromdt').show();
        
         $('#todt').show();
         $('#supplier').show();
          $('#central_type').hide();
      $('.excel_download_btn').show();
      
    var data="set=load_grn&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='req_report'){
        
      $('.excel_download_btn').show();
        
      $('#product').show();
         
      $('#type_view').hide();
     
      $('#stock_check').hide();
     
      $('#barcode').hide();
     
      $('#expiry').hide();
     
      $('#category').show();
    
      $('#store').show();
    
      $('#status_search').hide();
     
      $('#id').show();
      $('#supplier').hide();
      $('#fromdt').show();
        
      $('#todt').show();
         
      $('#central_type').hide();
         
      $('#entry_type').hide();
      
      var  indent_type= $('#indent_type').val();
        
      var  req_po=$('#req_po').val();
       
        
      var login_staff=$('#login_staff').val(); 
      
      var data="set=req_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&indent_type="+indent_type+"&req_po="+req_po+"&login_staff="+login_staff
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
            $('#load_store_stock').html($.trim(data));
         
        }
      });
    
    
    }  else if(report_type=='expiry_report'){
        
        $('.excel_download_btn').show();
        
         $('#product').show();
         
       $('#type_view').hide();
     
     $('#stock_check').hide();
     
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').show();
    
    $('#store').hide();
    
      $('#status_search').hide();
      
       $('#id').show();
        $('#supplier').show();
        $('#fromdt').hide();
        
         $('#todt').hide();
         $('#central_type').hide();
      $('#entry_type').hide();
      
    var data="set=expiry_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&asc_desc="+asc_desc+"&status_expiry="+status_expiry
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='grn_item_report'){
        
        $('.excel_download_btn').show();
         $('#product').show();
       $('#type_view').hide();
     
     $('#stock_check').hide();
     
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').show();
    
    $('#store').hide();
    
      $('#status_search').show();
      
       $('#id').show();
        $('#supplier').show();
        $('#fromdt').show();
        
         $('#todt').show();
         $('#central_type').hide();
      $('#entry_type').hide();
      
    var data="set=load_grn_item&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&asc_desc="+asc_desc
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='food_cost_report'){
        
        $('.excel_download_btn').show();
         $('#product').show();
      
      $('#type_view').show();
    $('#barcode').hide();
      $('#central_type').hide();
    $('#expiry').hide();
     
    $('#category').show();
    
    $('#store').show();
    
      $('#status_search').hide();
      
       $('#id').hide();
        $('#supplier').hide();
        $('#fromdt').show();
        
         $('#todt').show();
        
      $('#entry_type').hide();
      
    var data="set=food_cost_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&type_view="+type_view
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }
    else if(report_type=='transfer_report'){
        
     $('#central_type').hide();
     $('.excel_download_btn').show();
       $('#from_store').show();  
     $('#product').show();
     
      $('#supplier').hide();
      
     $('#barcode').hide();
     
     $('#expiry').hide();
     
     $('#category').hide();
    
     $('#store').hide();
    
     $('#status_search').hide();
      
     $('#id').show();
     
     $('#type_view').hide();
        
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
     
    var  indent_type= $('#indent_type').val();
      
    var data="set=transfer_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&from_store="+from_store+"&to_store="+to_store+"&indent_type="+indent_type
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='physical_stock_report'){
         $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#product').hide();
     
     $('#barcode').hide();
     
     $('#expiry').hide();
      $('#type_view').hide();
     $('#category').hide();
     $('#supplier').hide();
     $('#store').show();
    
     $('#status_search').hide();
      
     $('#id').show();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
    var data="set=physical_stock_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&store="+store
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='consumption_report'){
         $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#product').show();
      $('#type_view').hide();
     $('#barcode').hide();
     
     $('#expiry').hide();
     
     $('#category').hide();
     $('#supplier').hide();
     $('#store').show();
    
     $('#status_search').hide();
      
     $('#id').show();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
    var data="set=consumption_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&asc_desc="+asc_desc
     // alert(data);  
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='wastage_report'){
         $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#product').show();
      $('#type_view').hide();
     $('#barcode').hide();
     
     $('#expiry').hide();
     
     $('#category').hide();
     $('#supplier').hide();
     $('#store').hide();
    
     $('#status_search').hide();
      
     $('#id').show();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
    var data="set=wastage_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&asc_desc="+asc_desc
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }
    else if(report_type=='sales_reduce'){
         $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#barcode').hide();
      $('#type_view').hide();
     $('#expiry').hide();
      $('#supplier').hide();
     $('#category').hide();
    
     $('#store').show();
    
     $('#status_search').hide();
      
     $('#id').hide();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
     
      $('#product').show();
     
     
      
    var data="set=sales_reduce&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&product="+product+"&recipe_type="+recipe_type
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='purchase_return'){
        
     $('#central_type').hide();
     $('.excel_download_btn').show();
     $('#type_view').hide();
     $('#product').show();
     $('#supplier').hide();
     $('#barcode').hide();
     
     $('#expiry').hide();
     
     $('#category').hide();
    
     $('#store').hide();
    
     $('#status_search').hide();
      
     $('#id').show();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
      var data="set=purchase_return&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='production_report'){
         $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#product').show();
      $('#supplier').hide();
     $('#barcode').hide();
      $('#type_view').hide();
     $('#expiry').hide();
     
     $('#category').hide();
    
     $('#store').show();
    
     $('#status_search').hide();
      
     $('#id').show();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
    var data="set=production_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type=='conversion_report'){
        
     $('#central_type').hide();
     $('.excel_download_btn').show();
        
     $('#product').hide();
     
     $('#supplier').hide();
     $('#barcode').hide();
     $('#type_view').hide();
     $('#expiry').hide();
     
     $('#category').hide();
    
     $('#store').hide();
    
     $('#status_search').hide();
      
     $('#id').hide();
       
     $('#fromdt').show();
        
     $('#todt').show();
        
     $('#entry_type').hide();
      
    var data="set=conversion_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&product1="+product1+"&from_store="+from_store+"&to_store="+from_store+"&to_store="+to_store
        
        $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }else if(report_type==''){
         $('#central_type').hide();
         $('#supplier').hide();
        $('#product').hide();
      $('#type_view').hide();
    $('#barcode').hide();
     
    $('#expiry').hide();
     
    $('#category').hide();
    
    $('#store').hide();
    
      $('#status_search').hide();
      
       $('#id').hide();
       
        $('#fromdt').hide();
        
         $('#todt').hide();
        
      $('#entry_type').hide();
      
        $('.excel_download_btn').hide();
         $('#load_store_stock').css("color", "darkred");
         $('#load_store_stock').css("font-weight", "bold"); 
         $('#load_store_stock').html(' &nbsp;&nbsp;&nbsp;&nbsp;[ NO RECORDS TO DISPLAY ]');
           $('#stock_check').hide();
    }
          
         
     }
     
     
     
  function excel_download(){
      
     
    if($('#entry_type').val()!='' && $('#entry_type').val()!=undefined){
        var type=$('#entry_type').val();
    }else{
        var type='';
    }
     
     
     if($('#status_search').val()!='' && $('#status_search').val()!=undefined){
        var status_search=$('#status_search').val();
    }else{
        var status_search='';
    }
    
          
    if($('#id').val()!='' && $('#id').val()!=undefined){
        var id=$('#id').val();
    }else{
        var id='';
    }
     
     
    if($('#fromdt').val()!='' && $('#fromdt').val()!=undefined){
        var fromdt=$('#fromdt').val();
    }else{
        var fromdt='';
    }
         
    if($('#todt').val()!='' && $('#todt').val()!=undefined){
        var todt=$('#todt').val();
    }else{
        var todt='';
    }
    
     
     
    if($('#product').val()!='' && $('#product').val()!=undefined){
        var product=$('#product').val();
    }else{
        var product='';
    }
      
      
    if($('#barcode').val()!='' && $('#barcode').val()!=undefined){
        var barcode=$('#barcode').val();
    }else{
        var barcode='';
    }
      
      
    if($('#expiry').val()!='' && $('#expiry').val()!=undefined){
        var expiry=$('#expiry').val();
    }else{
        var expiry='';
    }
    
    
    if($('#reorder').val()!='' && $('#reorder').val()!=undefined){
        var reorder=$('#reorder').val();
    }else{
        var reorder='';
    }
     
     
    if($('#brand').val()!='' && $('#brand').val()!=undefined){
        var brand=$('#brand').val();
    }else{
        var brand='';
    }
     
     
    if($('#category').val()!='' && $('#category').val()!=undefined){
        var category=$('#category').val();
    }else{
        var category='';
    }
     
     
    if($('#store').val()!='' && $('#store').val()!=undefined){
        var store=$('#store').val();
    }else{
        var store='';
    }
    
    
    if($('#supplier').val()!='' && $('#supplier').val()!=undefined){
        var supplier=$('#supplier').val();
    }else{
        var supplier='';
    }
    
    
    if($('#type_view').val()!='' && $('#type_view').val()!=undefined){
        var type_view=$('#type_view').val();
    }else{
        var type_view='';
    }
    
    
    if($('#central_type').val()!='' && $('#central_type').val()!=undefined){
        var central_type=$('#central_type').val();
    }else{
        var central_type='';
    }
    
    
    if($('#stock_check').val()!='' && $('#stock_check').val()!=undefined){
        var stock_check=$('#stock_check').val();
    }else{
        var stock_check='';
    }
    
    
    if($('#asc_desc').val()!='' && $('#asc_desc').val()!=undefined){
        var asc_desc=$('#asc_desc').val();
    }else{
        var asc_desc='';
    }
    
    
    if($('#from_store').val()!='' && $('#from_store').val()!=undefined){
        var from_store=$('#from_store').val();
    }else{
        var from_store='';
    } 
    
     
    if($('#to_store').val()!='' && $('#to_store').val()!=undefined){
        var to_store=$('#to_store').val();
    }else{
        var to_store='';
    } 
    
   var report_type=$('#report_type').val();
   
   var recipe_type=$('#recipe_type').val();
  
  
   if(report_type=='store_stock_report'){
      
      fromdt="";  todt='';
   }
  
     var  req_po=$('#req_po').val();
  
     var  indent_type= $('#indent_type').val();
  
     var login_staff=$('#login_staff').val(); 
  
     var status_expiry=$('#status_expiry').val(); 
     
   var bydate= $('#bydate').val();
  
  
     var data="set="+report_type+"&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+
     "&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+
     "&type_view="+type_view+"&central_type="+central_type+"&recipe_type="+recipe_type+"&stock_check="+stock_check+"&asc_desc="+asc_desc+
     "&from_store="+from_store+"&to_store="+to_store+"&indent_type="+indent_type+"&req_po="+req_po+"&login_staff="+login_staff+
     "&status_expiry="+status_expiry+"&bydate="+bydate
      
        $.ajax({
        type: "POST",
        url: "inventory_excel.php",
        data: data,
        success: function(data)
        {
           
           window.location.href="inventory_excel.php?set="+report_type+"&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+
           "&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+
           "&type="+type+"&supplier="+supplier+"&type_view="+type_view+"&central_type="+central_type+"&recipe_type="+recipe_type+
           "&stock_check="+stock_check+"&asc_desc="+asc_desc+"&from_store="+from_store+"&to_store="+to_store+"&indent_type="+indent_type+
           "&req_po="+req_po+"&login_staff="+login_staff+"&status_expiry="+status_expiry+"&bydate="+bydate
         
        }
       }); 
    
          
  }   
     
     
     
 function search_history(){
     
     
    if($('#entry_type').val()!='' && $('#entry_type').val()!=undefined){
        var type=$('#entry_type').val();
    }else{
        var type='';
    }
    
    
     if($('#status_search').val()!='' && $('#status_search').val()!=undefined){
        var status_search=$('#status_search').val();
    }else{
        var status_search='';
    }
          
          if($('#id').val()!='' && $('#id').val()!=undefined){
        var id=$('#id').val();
    }else{
        var id='';
    }
     
       if($('#fromdt').val()!='' && $('#fromdt').val()!=undefined){
        var fromdt=$('#fromdt').val();
    }else{
        var fromdt='';
    }
         
         if($('#todt').val()!='' && $('#todt').val()!=undefined){
        var todt=$('#todt').val();
    }else{
        var todt='';
    }
    
         
      if($('#product').val()!='' && $('#product').val()!=undefined){
        var product=$('#product').val();
    }else{
        var product='';
    }
      
      if($('#barcode').val()!='' && $('#barcode').val()!=undefined){
        var barcode=$('#barcode').val();
    }else{
        var barcode='';
    }
      
     if($('#expiry').val()!='' && $('#expiry').val()!=undefined){
        var expiry=$('#expiry').val();
    }else{
        var expiry='';
    }
    
     if($('#reorder').val()!='' && $('#reorder').val()!=undefined){
        var reorder=$('#reorder').val();
    }else{
        var reorder='';
    }
     
    if($('#brand').val()!='' && $('#brand').val()!=undefined){
        var brand=$('#brand').val();
    }else{
        var brand='';
    }
     
     
     if($('#category').val()!='' && $('#category').val()!=undefined){
        var category=$('#category').val();
    }else{
        var category='';
    }
     
     if($('#store').val()!='' && $('#store').val()!=undefined){
        var store=$('#store').val();
    }else{
        var store='';
    }   
    
     if($('#supplier').val()!='' && $('#supplier').val()!=undefined){
        var supplier=$('#supplier').val();
    }else{
        var supplier='';
    }
    
    
    if($('#type_view').val()!='' && $('#type_view').val()!=undefined){
        var type_view=$('#type_view').val();
    }else{
        var type_view='';
    }
    
    
    var report_type=$('#report_type').val();
    
    var product1=$('#product1').val();
   
   
   if($('#central_type').val()!='' && $('#central_type').val()!=undefined){
        var central_type=$('#central_type').val();
    }else{
        var central_type='';
    }
     var recipe_type=$('#recipe_type').val();
   
   
   if($('#stock_check').val()!='' && $('#stock_check').val()!=undefined){
        var stock_check=$('#stock_check').val();
    }else{
        var stock_check='';
    } 
   
   if($('#asc_desc').val()!='' && $('#asc_desc').val()!=undefined){
        var asc_desc=$('#asc_desc').val();
    }else{
        var asc_desc='';
    } 
   
    if($('#from_store').val()!='' && $('#from_store').val()!=undefined){
        var from_store=$('#from_store').val();
    }else{
        var from_store='';
    } 
    
     
     if($('#to_store').val()!='' && $('#to_store').val()!=undefined){
        var to_store=$('#to_store').val();
    }else{
        var to_store='';
    } 
   
   
    if($('#status_expiry').val()!='' && $('#status_expiry').val()!=undefined){
        var status_expiry=$('#status_expiry').val();
    }else{
        var status_expiry='';
    } 
   
   
   
    var  indent_type= $('#indent_type').val();
   
   if(fromdt!='' && todt!=''){
       
       $('.confrmation_overlay_proce').css('display','block');
     $('.confrmation_overlay_proce').html('<img style="margin-top: 269px;margin-right: 180px;" src="../img/ajax-loaders/fetch.gif" />');
   
   if(report_type=='store_stock_report'){
       
       fromdt=''; todt='';
       
       var bydate= $('#bydate').val();
       
    var data="set=load_store_stock&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&stock_check="+stock_check+"&bydate="+bydate
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
           $('.confrmation_overlay_proce').css('display','none');
        }
    });
    }else if(report_type=='central_report'){
        
         var data="set=central_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&central_type="+central_type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }
    else if(report_type=='grn_report'){
        
         var data="set=load_grn&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }else if(report_type=='supplier_report'){
        
         var data="set=supplier_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }else if(report_type=='grn_item_report'){
       
         var data="set=load_grn_item&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&asc_desc="+asc_desc
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    } 
    else if(report_type=='expiry_report'){
       
         var data="set=expiry_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&asc_desc="+asc_desc+"&status_expiry="+status_expiry
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }   
    else if(report_type=='req_report'){
        
          var  req_po=$('#req_po').val();
       
       var login_staff=$('#login_staff').val(); 
       
         var data="set=req_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&supplier="+supplier+"&stock_check="+stock_check+"&indent_type="+indent_type+"&req_po="+req_po+"&login_staff="+login_staff
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }   
     else if(report_type=='transfer_report'){
       
         var data="set=transfer_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&from_store="+from_store+"&to_store="+to_store+"&indent_type="+indent_type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }           
    else if(report_type=='physical_stock_report'){
       
         var data="set=physical_stock_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&store="+store
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }  else if(report_type=='consumption_report'){
       
         var data="set=consumption_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&asc_desc="+asc_desc
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }else if(report_type=='food_cost_report'){
       
         var data="set=food_cost_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&type_view="+type_view
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }
    else if(report_type=='production_report'){
       
         var data="set=production_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    } 
     else if(report_type=='conversion_report'){
       
         var data="set=conversion_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&product1="+product1+"&from_store="+from_store+"&to_store="+from_store+"&to_store="+to_store
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    } 
    else if(report_type=='wastage_report'){
       
         var data="set=wastage_report&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&asc_desc="+asc_desc
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
          $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }      
    else if(report_type=='sales_reduce'){
       
         var data="set=sales_reduce&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type+"&recipe_type="+recipe_type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
           $('.confrmation_overlay_proce').css('display','none');
        }
    });
        
    }         
    else if(report_type=='purchase_return'){
       
         var data="set=purchase_return&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&id="+id+"&type="+type
             $.ajax({
        type: "POST",
        url: "load_report_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
           $('.confrmation_overlay_proce').css('display','none');
           
        }
    });
        
   }   
    
    }
    
    
    
 }
 
 
 
 function item_view(grn){
     
     
      $('.item_pop').show();
        
      var data="set=load_history_items&id="+grn+"&mode=grn";
           
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data1)
        {   
           
         $('.load_items').html($.trim(data1));
          
        }
    });
        
    } 
     
     function close_req1(){
         
          $('.item_pop').hide();
     }
    
</script>

	<style>
            .dataTables_scrollBody{height:460px !important;}
		.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}
		.modal-dialog{width:450px !important;top: 30%;}.modal .modal-dialog .modal-content{padding: 15px;}
               
        </style>

<style>
    
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:350px;height:150px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute; display: grid;grid-template-columns: 1fr;grid-template-rows: 2fr;justify-content: center;}  
 .quick_pop_printer_head{text-align:center;font-size:20px;color:#818181;padding:15px 0;font-weight:bold; text-transform:capitalize;}   
 .quick_pop_printer_content{width:100%;height:auto;padding:15px;text-align:center;}      
</style>
<div class="quick_pop_printer_sec bill_quick_div item_pop" style="display:none;">
    <div class="quick_pop_printer" style="grid-template-rows:0fr;padding: 1rem;width: 750px;height: 550px;cursor: pointer">
    <div style="display: flex;justify-content: space-between;align-items: center;">
        <div class="quick_pop_printer_head" > Items </div>
        <span onclick="close_req1()" style=""><img src="../images/black_cross.png"></span>
        </div>
        <div class="" style="overflow-y:auto;">
                  
            <table class="blueTable table table-bordered table-striped">
<thead>
<tr>
<th>Sl</th>
<th>Name</th>
<th>Type</th>
<th>Unit</th>
<th>Qty</th>
<th>Weight</th>
<th>Rate</th>
<th>Tax</th>
<th>Batch</th>
<th>Total</th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan="4">
<div class="links"></div>
</td>
</tr>
</tfoot>
<tbody class="load_items">


</tbody>
</table>
                  
                 
                  
             </div>
        
        
    </div>
    
   
      <div>
      </div>
</div>

<div style="display:none" class="confrmation_overlay_proce"></div>
<style>
      .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
    </style>

    </body>

</html>

