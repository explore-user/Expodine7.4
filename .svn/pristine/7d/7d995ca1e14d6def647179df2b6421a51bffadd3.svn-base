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

        <title>Inventory </title>

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
            <div class="loyalty_mgmt_head"><div class="">

                    <a   class="inv-req-btn1"  href="physical_stock.php">BACK</a>
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important;" class="inv-pro-btn1 " href="#">PHYSICAL STOCK HISTORY</a>

                    
                </div></div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                	
                    <div class="container" style="overflow:auto;" >
<div class="inv-req-content">

<!-- <div class="inv-req-head">
    <h2>Requisition history</h2>
</div> -->
<div class="inv-req-history" >
 <span id="load_error" style="color:darkred;font-size: 10px;float: right;margin-right:77px;margin-top: -25px;font-weight: bold" ></span>

  <div class="history-filter">

 <input autocomplete="off" onkeyup="search_history();" placeholder="Id" id="search_id" type="text" style=""> 
 
      <input autocomplete="off" onchange="search_history();" placeholder="From" id="datepicker" type="text" style=""> 
  
      <input autocomplete="off" onchange="search_history();" placeholder="To" id="datepicker1" type="text" style=""> 
  
      <select onchange="search_history();"  id="staff" style="display:block">
       
       <option value="">Staff</option>  
       
       <?php 
    $fnct_menu = $database->mysqlQuery("select ls_username from tbl_logindetails  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
              
    <option  value="<?=$result_fnctvenue['ls_username']?>"><?=$result_fnctvenue['ls_username']?></option>
    
    <?php } } ?>
       
       
     </select>
      
      <select onchange="search_history();"  id="store" style="display:block">
       
       <option value="">Store</option>  
       
       <?php 
    $fnct_menu = $database->mysqlQuery("select ti_name,ti_id from tbl_inv_kitchen where ti_status='Y'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
              
    <option  value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
       
       
     </select>
  
  
  </div>
<div style="overflow-y: auto;height: 75vh;position: relative" id="load_history">

  
  </table>
  

</div>
    
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
       <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> 
        
			<script type="text/javascript">
    $(document).ready(function () {
        
        
        $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
        
        
         $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
           
     
        var data="set=load_transfer_physical&id=&fromdt=&todt=&staff=&search_id=&store="
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_history').html($.trim(data));
         
        }
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
        
        
       
      
       
    });
    TableManageButtons.init();


function phy_approval(id,store){
    
     var confirm1=confirm(" APPROVE PHYSICAL STOCK ENTRY ?");
    if(confirm1===true){
      var data123="set=approve_physiacl_stock_last&id="+id+"&store="+store;
      
       $.ajax({
            type: "POST",
            url: "load_inventory.php",
            data: data123,
            success: function(data) {
               
              location.reload();
            
             }
        });
   }     
    
}


    function pagination(p,q)
 {
     var s=$('#recordcount').val();

     if(q==1)
     {
     var m= q;
     var j=parseInt(q)+6;
     }
     else if(q==2)
     {
     var m= parseInt(q)-1;
     var j=parseInt(q)+5;
     }
     else if(q==3)
     {
       var m= parseInt(q)-2;
       var j= parseInt(q)+4;
     }
     else 
     {
       var m= parseInt(q)-3;
       var j= parseInt(q)+3;
     }

    
     var o=0;
     var w=0;
      var n=0;
     
    for(w=1;w<=m;w++)
     {
         
         $('#pagi'+w).hide();
     } 
     for(n=m;n<=j;n++)
     {
         
         $('#pagi'+n).show();
     } 
     for(o=j;o<=s;o++)
     {
         
         $('#pagi'+o).hide();
     } 
     
     var recordcount=parseInt(p);
  
     var id=$('#searchid').val();
     
     var type=$('#type').val();
     
     var fromdt=$('#datepicker').val();
     
     var todt=$('#datepicker1').val();
     
     var staff=$('#staff').val();
     
      var search_id=$('#search_id').val();
      
      var store=$('#store').val();
   
              var data="set=load_transfer_physical&id="+id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&pagination="+p+"&recordcount="+recordcount+"&staff="+staff+"&search_id="+search_id+"&store="+store
        
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_history').html($.trim(data));
          
        }
    });
    
 } 
     
    function phy_items(id){
        
        $('.item_pop').show();
        
         var data="set=load_transfer_physical_items&id="+id
             
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_items').html($.trim(data));
          
        }
    });
        
    } 
     
     function close_pop(){
         
          $('.item_pop').hide();
     }
     
     
 function search_history(){
     
     var id=$('#searchid').val();
     
     var type=$('#type').val();
     
     var fromdt=$('#datepicker').val();
     
     var todt=$('#datepicker1').val();
     
   var staff=$('#staff').val();
   
   var store=$('#store').val();
   
    var search_id=$('#search_id').val();
    
              var data="set=load_transfer_physical&id="+id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&staff="+staff+"&search_id="+search_id+"&store="+store
             
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_history').html($.trim(data));
          
        }
    });
            
        
  }
   
  
  
   function close_req(){
     
    $('.approve_pop').hide();
    
      $('.approve_pop').attr('req_id','')
   

            
        
  }
  
  
  function approve_req(req,sts,typ){
     
    $('.approve_pop').show();
    
      $('.approve_pop').attr('req_id',req);
   
     $('.approve_pop').attr('status',sts);
            
        $('.approve_pop').attr('type',typ);
  }
  
  function approve_submit_req(){
     
     var req =$('.approve_pop').attr('req_id');
     
     var sts= $('.approve_pop').attr('status');
     var status_search=$('#status_search').val();
     
     if(sts=='Cancel'){
         $('#load_error').show();
         $('#load_error').css('color','red');
       $('#load_error').text('CANCEL SUCCESSFULL');
      
        $('#load_error').delay(1000).fadeOut('slow');
     }else{
         $('#load_error').show();
         $('#load_error').css('color','green');
       $('#load_error').text('APPROVAL SUCCESSFULL');
      
        $('#load_error').delay(1000).fadeOut('slow');
         
     }
     
    var type= $('.approve_pop').attr('type');
     
      
      if(type=='req'){
     var data="set=approve_req&id="+req+"&sts="+sts
             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           $('.approve_pop').hide();
    
      $('.approve_pop').attr('req_id','')
      
      $('.approve_pop').attr('status','');
            
        $('.approve_pop').attr('type','');
        
        
        var type='req'; 
        var data="set=load_history&id=&type="+type+"&fromdt=&todt=&status_search="+status_search
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_history').html($.trim(data));
         
        }
    });
    
          
        }
    });
            
        }else if(type=='pur'){
            
            var data="set=approve_purchase&id="+req+"&sts="+sts
            $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          $('.approve_pop').hide();
    
      $('.approve_pop').attr('req_id','');
      
      $('.approve_pop').attr('status','');
            
        $('.approve_pop').attr('type','');
      
       var type='purchase'; 
        var data="set=load_history&id=&type="+type+"&fromdt=&todt=&status_search="+status_search
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_history').html($.trim(data));
         
        }
    });
      
        }
          });
            
        }
  }
  
  
  
  
  
</script>

	<style>.dataTables_scrollBody{height:460px !important;}
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

<div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none">
    <div class="quick_pop_printer">
        <div class="quick_pop_printer_head" > Confirm </div>
          
        <div class="quick_pop_printer_content ">
                  
            <div onclick="approve_submit_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">SUBMIT</span></div>
                  
                  <div onclick="close_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>

<div class="quick_pop_printer_sec bill_quick_div item_pop" style="display:none">
    <div class="quick_pop_printer" style="width:750px; height: 550px;">

        <div id="load_items"></div>
    </div>
    
    
</div>	



    </body>

</html>

