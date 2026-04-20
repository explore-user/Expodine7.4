<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();


if(isset($_REQUEST['set']) && $_REQUEST['set']=='clear_all_po'){
    
    
     $fnct_menu = $database->mysqlQuery("delete  from tbl_purchase_order where tp_set='N' ");
    
    
}



if(isset($_REQUEST['set']) && $_REQUEST['set']=='clear_all_grn'){
    
    
     $fnct_menu = $database->mysqlQuery("delete  from tbl_grn_order where tg_set='N' ");
    
    
}


?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>History </title>

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
        
        
        <input type="hidden"  value="<?=$_REQUEST['from']?>" id="from_flt" >
          <input type="hidden"  value="<?=$_REQUEST['to']?>" id="to_flt" >
          <input type="hidden"  value="<?=$_REQUEST['status']?>" id="status_flt">
          <input type="hidden"  value="<?=$_REQUEST['search_id']?>" id="id_flt" >
          <input type="hidden"  value="<?=$_REQUEST['type']?>" id="type_flt" >
            <input type="hidden"  value="<?=$_REQUEST['filter']?>" id="filter_flt" >

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head"><div class=""><span classs="" style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(223deg, #ffffff, #ffffff)!important;padding: 0.7rem;">R-P-S  HISTORY</span>  <span id="load_error" style="color:darkred;font-size: 10px;float: right;margin-right:-404px;margin-top: 0px;font-weight: bold" ></span> </div></div>

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
 

  <div class="history-filter">
      
    <input onkeyup="search_history();" placeholder="Search Id" id="searchid"   type="text" style=""> 
      
    <input onkeyup="search_history();" placeholder="Inv No" id="search_invno"   type="text" style=""> 
        
    <input autocomplete="off"  onchange="search_history();" placeholder="Entry From  " id="datepicker2" type="text" style=""> 
    
    <input autocomplete="off" onchange="search_history();" placeholder="Entry To " id="inv_date1" type="text" style=""> 
 
   <select onchange="search_history();"  id="type" style="font-size:10px ">
    <option value="all">Select RPS</option>  
     
    <option value="req">Requisition</option>
    <option value="purchase">Purchase Order</option>
    <option value="stock">Stock Purchase </option>
   
  </select>
     
    <select onchange="search_history();"  id="supplier" style="font-size:10px " >
     <option value="" >Select Supplier</option>  
     <?php
            
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_vendor_master where v_active='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['v_id']?>"><?=$result_kotlist['v_name']?></option>  
       
       <?php } } ?>                    
          
    </select>
    
    
     <select onchange="search_history();"  id="search_store" style="font-size:10px " >
     <option value="" >Select Store</option>  
     <?php
            
    $fnct_menu = $database->mysqlQuery("select ti_id,ti_name from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
        <option value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
                           <?php
                  
              }
              }
              ?>
          
    </select>
    
    
    
    <select style="font-size:10px" onchange="search_history();"  id="staff" >
        <option  value="" >Select User</option>  
    <?php
            
     $sql_kotlist  =  $database->mysqlQuery("SELECT ser_firstname from  tbl_staffmaster where ser_employeestatus='Active' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ser_firstname']?>"><?=$result_kotlist['ser_firstname']?></option>  
       <?php
          }
          }
       ?>                    
          
    </select>
    
    
      
   <select onchange="search_history();"  id="status_search" style="font-size:10px ">
       
    <option value="All">Select Status</option>  
    <option value="">Pending</option>
    <option value="Approved">Approved</option>
    <option value="Cancel">Cancelled</option>
    
   </select>
  
      <input autocomplete="off" onchange="search_history();" placeholder=" Invoice From" id="datepicker" type="text" style="font-size:8px "> 
  
      <input autocomplete="off" onchange="search_history();" placeholder="Invoice To" id="datepicker1" type="text" style="font-size:8px "> 
  
      <a style="border:solid 1px ;padding: 3px;height: 19px;margin-top: 5px;border-radius: 5px;font-size: 9px" href="history.php">RESET</a>
  
  
      <div style="font-size: 10px;  font-size: 10px; display: flex; flex-direction: column;">
        
        <span><a style="display: flex; gap: 0.5rem;" title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i> Approved</a></span> 
     
        <span><a style="display: flex; gap: 0.5rem;" title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i> Cancelled</a></span>
     
        <span><a style="display: flex; gap: 0.5rem;"  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i> Pending</a></span>
       
      </div>
  
  </div>
    
    
    
    
<div style="overflow-y: auto;height: 75vh;position: relative" id="load_history">

  

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
     
        
			<script type="text/javascript">
    $(document).ready(function () {
        
        
         var type=$('#type').val(); 
        var data="set=load_history&id=&type="+type+"&fromdt=&todt=&status_search=All&supplier=&inv=&inv_date=&inv_date1=&staff=&search_store="
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_history').html($.trim(data));
         
        }
    });
        
        
       //////filter search////// 
        
       if($('#filter_flt').val()=='ok'){
           
    var search_id=$('#id_flt').val();
     
     var status=$('#status_flt').val();
     
     var from=$('#from_flt').val();
     
     var to=$('#to_flt').val();
     
      var type=$('#type_flt').val();
      
    $('#searchid').val(search_id);
     
   $('#type').val(type);
     
   $('#datepicker').val(from);
     
    $('#datepicker1').val(to);
     
  $('#status_search').val(status);
   
   var supplier=$('#supplier').val();
   
   var inv=$('#search_invno').val();
   
   var inv_date=$('#datepicker2').val();
   
    var inv_date1=$('#inv_date1').val(); 
    
    var staff=$('#staff').val();
    
    var search_store=$('#search_store').val();
         
        var data="set=load_history&id="+search_id+"&type="+type+"&fromdt="+from+"&todt="+to+"&status_search="+status+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
      
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
        
        //////filter search end //////  
        
        
        $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
        
        
         $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
           
      $( "#datepicker2").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
           
           
            $( "#inv_date1").datepicker({
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
        
        
       
      
       
    });
    TableManageButtons.init();

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
     
     var status_search=$('#status_search').val();
   
    var supplier=$('#supplier').val();
    
    
     var inv=$('#search_invno').val();
     
     
     var inv_date=$('#datepicker2').val();
     
     
      var inv_date1=$('#inv_date1').val(); 
        
     var staff=$('#staff').val();
     
       var search_store=$('#search_store').val();
     
              var data="set=load_history&id="+id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&pagination="+p+"&recordcount="+recordcount+"&status_search="+status_search+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
        
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
   function grn_entry(id){
      
      var data="set=check_grn&id="+id;             
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
          
         if($.trim(data)=='yes'){
             
             window.location.href='stock_entry.php?grn_po='+id;
        
             
         $('#load_error').show();
         $('#load_error').css('color','red');
        $('#load_error').text('');
      
        $('#load_error').delay(1000).fadeOut('slow');
         }
          
        }
    });
      
  }   
  
  function close_indent(){
      
      $('.indent_pop').hide(); 
      $('#indent_from_store').val('');
       $('.indent_accept_pop').hide(); 
      
  }
  
    function close_direct(){
      
      $('.direct_accept_pop').hide(); 
    
      
  }
  
  
  function approve_indent_transfer(){
         
       var id =  $('.indent_pop').attr('req_id');
       var indent_store =   $('#indent_from_store').val();
        
       var to_store = $('.indent_pop').attr('to_store');
           
       if($('#indent_from_store').val()!=''){
               
       if(to_store!=indent_store){  
               
               
        var data="set=send_indent&id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          if($.trim(data)=='yes'){
                
          $('.indent_pop').hide(); 
            
            
           window.location.href='store_transfer.php?indent_id='+id+'&indent_store='+indent_store 
            
            }else{
                $('#ind_error').show();
         
         $('#ind_error').css('color','red');
         $('#ind_error').text(' PLEASE CLEAR NORMAL STORE TRANSFER ENTRIES');
      
         $('#ind_error').delay(2000).fadeOut('slow');
            }
         
        }
    });
          }else{
               
         $('#ind_error').show();
         
         $('#ind_error').css('color','red');
         $('#ind_error').text(' FROM STORE & TO STORE CANT BE SAME');
      
         $('#ind_error').delay(2000).fadeOut('slow');
           }     
               
               
               
           }else{
               
         $('#ind_error').show();
         $('#ind_error').css('z-index','9999999');
         $('#ind_error').css('color','red');
         $('#ind_error').text('SELECT FROM STORE');
      
         $('#ind_error').delay(2000).fadeOut('slow');
           }
           
           
     }
     
  
  
     
         
    

     
     
     
      function approve_indent(id,to_store){
         
       var data="set=check_indent_transfer&req_id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          var str1=$.trim(data);
         
          
       
       if (str1.indexOf("no") >= 0){
           
            $('.indent_pop').attr('req_id',id);
            $('.indent_pop').attr('to_store',to_store);
             $('.indent_pop').show(); 
         

                }else{
          
          
            $('#load_error').show();
         $('#load_error').css('color','green');
        $('#load_error').text('TRANSFER IS ALREADY COMPLETED');
      
        $('#load_error').delay(2000).fadeOut('slow');
        }
            
            
            
      }
      });
           
     }
     
     function accept_direct(id){
         
         
           $('.direct_accept_pop').show();
           $('.direct_accept_pop').attr('req_id',id);
           
           
        var data="set=load_direct_accept&req_id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_direct_accept').html(data);
         
        var data="set=load_store_accept_direct&req_id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           var sp=$.trim(data).split('*');
           
         $('#direct_accept_store').text(sp[0]+' To :'+sp[1]+'   ['+id+']');
         
        }
        
    });
         
         
        }
    });
           
           
     }
     
     
     
      function accept_indent(id){
         
         
           $('.indent_accept_pop').show();
           $('.indent_accept_pop').attr('req_id',id);
           
           
        var data="set=load_indent_accept&req_id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_indent_accept').html(data);
         
        var data="set=load_store_accept&req_id="+id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
         $('#indent_accept_store').text($.trim(data)+' ['+id+']');
         
        }
        
    });
         
         
        }
    });
           
           
     }
     
     
     function accept_direct_transfer(){
         
           $('.direct_accept_pop').hide();
           
         var req_id=$('.direct_accept_pop').attr('req_id');
        
         var data="set=accept_direct_to_store&req_id="+req_id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
             $('.direct_accept_pop').hide();
             $('.direct_accept_pop').attr('req_id','');
           
             location.reload();
           
        }
      });
         
         
       
     }
     
     
     function accept_indent_transfer(){
         
           $('.indent_accept_pop').hide();
           
         if($('#total_rew_indent').text()>0){
         
         var req_id=$('.indent_accept_pop').attr('req_id');
        
         var data="set=accept_indent_to_store&req_id="+req_id;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
             $('.indent_accept_pop').hide();
             $('.indent_accept_pop').attr('req_id','');
           
             location.reload();
           
        }
      });
         
         
        }else{
             $('#ind_error1').show();
         $('#ind_error1').css('z-index','9999999');
         $('#ind_error1').css('color','red');
         $('#ind_error1').text('NO ITEMS FOUND');
      
         $('#ind_error1').delay(2000).fadeOut('slow');
        }
     }
     
     
     
      function mail_grn(id,s,st,mail){
          
        var confirm1=confirm(" PURCHASE ORDER LIST WILL BE SEND TO SUPPLIER VIA MAIL ?");
        if(confirm1===true){
          
          $('#load_error').show();
          $('#load_error').css('color','darkred');
          $('#load_error').text('SENDING MAIL . PLEASE WAIT ');
      
          $('#load_error').delay(5000).fadeOut('slow');
      
        var data="set=send_grn_mail&id="+id+"&supplier="+s+"&store="+st+"&mail="+mail;             
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
         $('#load_error').show();
         $('#load_error').css('color','Green');
         $('#load_error').text('MAIL SENT');
      
         $('#load_error').delay(2000).fadeOut('slow');
            
         
        }
        });
    
        }
      
  }    
     
  function po_entry(id){
      
      
      var data="set=check_po&id="+id;             
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
          
         if($.trim(data)=='yes'){
             
             window.location.href='purchase_order.php?req_po='+id;
         }else{
             
              $('#load_error').show();
         $('#load_error').css('color','red');
       $('#load_error').text('PLEASE CLEAR PURCHASE ORDER FIRST');
      
        $('#load_error').delay(1000).fadeOut('slow');
         }
          
        }
    });
      
  }   
     
 function search_history(){
     
     var id=$('#searchid').val();
     
     var type=$('#type').val();
     
     var fromdt=$('#datepicker').val();
     
     var todt=$('#datepicker1').val();
     
      var supplier=$('#supplier').val();
     
   var status_search=$('#status_search').val();
   
    var inv=$('#search_invno').val();
    
     var inv_date=$('#datepicker2').val();
     
       var inv_date1=$('#inv_date1').val(); 
       
       var search_store=$('#search_store').val();
        
     var staff=$('#staff').val();
     
       var data="set=load_history&id="+id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
             
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
  
  
     function close_req1(){
     
    $('.item_pop').hide();
         
        
  }
  
  
  function edit_req(id,mode){
      
     var search_id=$('#searchid').val();
     
     var status=$('#status_search').val();
     
     var from=$('#datepicker').val();
     
     var to=$('#datepicker1').val();
     
      var type=$('#type').val();
      
      if(mode=='req'){
           window.location.href='requistion.php?req_id='+id+"&from="+from+"&to="+to+"&type="+type+"&status="+status+"&search_id="+search_id+"&filter=ok";
      }
      
      
      if(mode=='pur'){
            window.location.href='purchase_order.php?pur_id='+id+"&from="+from+"&to="+to+"&type="+type+"&status="+status+"&search_id="+search_id+"&filter=ok";
      }
      
      
      if(mode=='grn'){
            window.location.href='stock_entry.php?grn_id='+id+"&from="+from+"&to="+to+"&type="+type+"&status="+status+"&search_id="+search_id+"&filter=ok";
      }
      
  }
  
  function view_req(id,mode,store,sup){
     
    $('.item_pop').show();
    var dt='Id:'+id+' | Store:'+store+' | Sup:'+sup;
   
    $('#pop_detail').text(dt);
        var data="set=load_history_items&id="+id+"&mode="+mode
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('.load_items').html($.trim(data));
         
        }
    });
    
    
     
  }
  
  
  
  
  
  function approve_req(req,sts,typ){
     
    $('.approve_pop').show();
    
      $('.approve_pop').attr('req_id',req);
   
     $('.approve_pop').attr('status',sts);
            
        $('.approve_pop').attr('type',typ);
        
        if(typ=='req'){
            if(sts=='Cancel'){
        $('.head_type_grn').text(' CANCEL REQUISITION ');
    }else{
       $('.head_type_grn').text('APPROVE REQUISITION ');  
    }
        }else if(typ=='pur'){
             if(sts=='Cancel'){
        $('.head_type_grn').text(' CANCEL PURCHASE ');
    }else{
             $('.head_type_grn').text('APPROVE PURCHASE');
         }
        }else{
            
             if(sts=='Cancel'){
        $('.head_type_grn').text(' CANCEL STOCK PURCHASE ');
    }else{
             $('.head_type_grn').text('APPROVE STOCK PURCHASE');
         }
        }
        
        
        
  }
  
  
  function approve_submit_req(){
     
     var req =$('.approve_pop').attr('req_id');
     
     var sts= $('.approve_pop').attr('status');
     
      var status_id=$('#searchid').val();
     
     var status_search=$('#status_search').val();
     
     var fromdt=$('#datepicker').val();
     
     var todt=$('#datepicker1').val();
     
     var supplier=$('#supplier').val();
     
     
    var inv=$('#search_invno').val();
    
    var inv_date=$('#datepicker2').val();
     
    var inv_date1=$('#inv_date1').val(); 
        
    var staff=$('#staff').val();
     
     if(sts=='Cancel'){
         
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('CANCELLED');
         $('#load_error').delay(1000).fadeOut('slow');
         
     }else{
         
         $('#load_error').show();
         $('#load_error').css('color','green');
         $('#load_error').text('APPROVED');
         $('#load_error').delay(1000).fadeOut('slow');
         
     }
     
     
      var type= $('.approve_pop').attr('type');
     
        var search_store=$('#search_store').val();
        
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
        
        
       // var type='req'; 
        
        //$('#type').val('req');
        
        
         var type=$('#type').val();
         
        var data="set=load_history&id="+status_id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
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
      
     //   var type='purchase'; 
       // $('#type').val('purchase');
         var type=$('#type').val();
        
        var data="set=load_history&id="+status_id+"&type="+type+"&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
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
            
    }else if(type=='grn'){
            
            
      $('.approve_pop').hide();
    
      $('.approve_pop').attr('req_id','');
      
      $('.approve_pop').attr('status','');
            
      $('.approve_pop').attr('type','');
            
        var data="set=approve_grn&id="+req+"&sts="+sts
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          
      
       // var type='grn'; 
       //  $('#type').val('grn');
          var type=$('#type').val();
          
        var data="set=load_history&id="+status_id+"&type=stock&fromdt="+fromdt+"&todt="+todt+"&status_search="+status_search+"&supplier="+supplier+"&inv="+inv+"&inv_date="+inv_date+"&inv_date1="+inv_date1+"&staff="+staff+"&search_store="+search_store
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
        $('#load_history').html($.trim(data));
            
        var data="set=add_update_store_stock&grn_id="+req+"&sts="+sts;
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
        }
        
        });
           
           
           
         
        }
        });
      
        }
        });
            
        }
        
        
  }
  
   function direct_no(){
       
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('PLEASE CLEAR DATA IN STORE TRANSFER FIRST');
         $('#load_error').delay(2000).fadeOut('slow');
       
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
        <div class="quick_pop_printer_head  head_type_grn" >  </div>
          
        <div class="quick_pop_printer_content ">
                  
            <div onclick="approve_submit_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">APPROVE</span></div>
                  
                  <div onclick="close_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>


<div class="quick_pop_printer_sec bill_quick_div indent_pop" style="display:none">
    <div class="quick_pop_printer">
        <div class="quick_pop_printer_head" > INDENT TRANSFER </div>
        
        <span style="position: relative;display: flex;flex-direction: column;justify-content: center;align-items: center; ">
            
        <span style="font-size: 10px;font-weight: bold;    position: absolute;top: -15px;" id="ind_error"></span>
        
        <select style="width: 160px;border: solid 3px;border-radius: 4px;font-size: 16px;color: black" id="indent_from_store" >
            
        <option style="font-weight:bold;" value="">FROM STORE</option>    
            
        <?php
         $fnct_menu = $database->mysqlQuery("select ti_id,ti_name from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
        <option value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
                           <?php
                  
              }
              }
              ?> 
        </select>
        </span>  
        
        <div class="quick_pop_printer_content ">
                  
            <div onclick="approve_indent_transfer();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">TRANSFER</span></div>
                  
             <div onclick="close_indent();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>


<div class="quick_pop_printer_sec bill_quick_div indent_accept_pop" style="display:none">
    <div class="quick_pop_printer" style="width: 700px;height: 550px ">
        <div class="quick_pop_printer_head" > INDENT ACCEPT FROM : <span style="text-transform: uppercase " id="indent_accept_store"></span> </div>
        
        <span style="position: relative;display: flex;flex-direction: column;justify-content: center;align-items: center; ">
            
        <span style="font-size: 10px;font-weight: bold;    position: absolute;top: -15px;" id="ind_error1"></span>
        
        </span>
        
          <div style="overflow:auto;height: 415px">
             
        <table class="table table-bordered table-striped" >
            
         <thead>
        <tr><th>Sl</th>
       <th >Product</th>
       <th > Weight</th>
      <th > Qty</th>
       <th > Type</th>
       <th > Unit</th>
      <th > Rate</th>
      
      <th >Total</th>
       </tr>

              
        </thead>  
            
            <tbody  id="load_indent_accept" >
                
                
            </tbody>
        </table>  
        </div>
        
        <div class="quick_pop_printer_content ">
                  
            <div onclick="accept_indent_transfer();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">ACCEPT</span></div>
                  
             <div onclick="close_indent();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>


<div class="quick_pop_printer_sec bill_quick_div direct_accept_pop" style="display:none">
    <div class="quick_pop_printer" style="width: 700px;height: 550px ">
        <div class="quick_pop_printer_head" style="font-size:12px" > DIRECT TRANSFER ACCEPT FROM : <span style="text-transform: uppercase;font-size: 12px " id="direct_accept_store"></span> </div>
        
        <span style="position: relative;display: flex;flex-direction: column;justify-content: center;align-items: center; ">
            
        <span style="font-size: 10px;font-weight: bold;    position: absolute;top: -15px;" id="ind_error2"></span>
        
        </span>
        
          <div style="overflow:auto;height: 415px">
             
        <table class="table table-bordered table-striped" >
            
         <thead>
        <tr><th>Sl</th>
       <th >Product</th>
       <th > Weight</th>
      <th > Qty</th>
       <th > Type</th>
       <th > Unit</th>
      <th > Rate</th>
      
      <th >Total</th>
       </tr>

              
        </thead>  
            
            <tbody  id="load_direct_accept" >
                
                
            </tbody>
        </table>  
        </div>
        
        <div class="quick_pop_printer_content ">
                  
            <div onclick="accept_direct_transfer();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">ACCEPT</span></div>
                  
             <div onclick="close_direct();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>

<div class="quick_pop_printer_sec bill_quick_div item_pop" style="display:none;">
    <div class="quick_pop_printer" style="grid-template-rows:0fr;padding: 1rem;width: 750px;height: 550px;cursor: pointer">
    <div style="display: flex;justify-content: space-between;align-items: center;">
        <div class="quick_pop_printer_head" > Items  </div> <span id="pop_detail"></span>
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




    </body>
    

</html>