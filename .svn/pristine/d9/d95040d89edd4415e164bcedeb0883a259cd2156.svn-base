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
          <link rel="stylesheet" href="../css/jquery-ui-1.8.2.custom.css" /> 
       
        <script src="assets/js/modernizr.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script> 
		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}</style>

    </head>

    <body class="fixed-left">
        
        <input type="hidden" id="focusedtext">
        
        <input type="hidden" id="hidden_checker">
        
        <input type="hidden" value="" id="edit_id">
        
        <div id="wrapper">

             <div>
            <?php include( 'includes/header.php') ?>
            
            </div>
           
            <div class="loyalty_mgmt_head">
            <div class="" >
                <a style="background-image: linear-gradient( 223deg , #06376a, #8ab796)!important;" class="inv-pro-btn1"  href="physical_stock.php">BACK</a>   
        
                
                <a onclick="default_load();" style="background-image: linear-gradient( 223deg , #45974c, #8ab796)!important;" class="inv-pro-btn1"  href="#">ADD TO PHYSICAL STOCK LIST</a>   
        
                
            </div>
               
                 
            </div>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 10px;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;" ></span>  
                	
                    <div class="container" style="padding: 0.75; margin-bottom:1rem;" >
                    <div class="inv-req-content" style="grid-template-rows: 0.1fr 0.1fr 1fr;">


<div class="req-form-head">
<h6 style="width: 12%;">Product</h6>

<h6 style="width: 12%;">Barcode</h6>
<h6 style="width: 12rem;">QTY Type</h6>
<h6 style="width: 12%;">Brand</h6>
<h6 style="width: 10rem;">Unit</h6>
<h6 style="width: 2rem;">.</h6>
</div>

<div class="append_div_main inv-sub-form" style="position:relative">
         <div class="add_menu_row " id="second_div_main">
             
<div class="inv-req-form">
    
    <input onkeyup="clear_name();"  onchange="clear_name();"  autofocus placeholder="Product" id="product"   type="text" style="width: 12%;">  
     
    <input onkeyup="clear_name();"  onchange="clear_name();"  id="barcode"  placeholder="Barcode" type="text" style="width: 12%;">
    
    
    <input style="width: 12rem;" readonly placeholder="Qty Type" id="rate_type" type="text">
    
    <input placeholder="Brand" id="brand" type="text" style="width: 12%;">
    
    <input style="width: 10rem;" id="unit_type" readonly placeholder="Unit" type="text">
    
    
     <a id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
    
</div>
</div>
</div>


<div class="inv-req-Submit">
    
  Items : <span id="rps_count">0</span>
  <select id="store" onchange="store_wise()">
      <option value="">Store</option>
    <?php 
  $store_on='';
   $fnct_menu1 = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' order by ti_id asc ");
         $num_fdtl1 = $database->mysqlNumRows($fnct_menu1);
        if ($num_fdtl1 > 0) {
              while ($result_fnctvenue1 = $database->mysqlFetchArray($fnct_menu1))
              {
               
                 ?> 
      
      <option value="<?=$result_fnctvenue1['ti_id']?>"><?=$result_fnctvenue1['ti_name']?></option>
      
           <?php
              }
              }
    
    ?>
    </select>

<input id="submit_req" type="text" readonly class="inv-submit-btn " value="ADD DEFAULT" style="margin-left:auto;cursor: pointer;border-bottom: none;display: none"  onclick="submit_req();" >


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


    <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script> 
        
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
        
 $(document).on('keypress',function(e) {
    if(e.which == 13) {
       
    
        if ($('#qty').is(':focus')) {
            
         $("#plusbtn").click();
    }else if($('#weight').is(':focus')){
               
           $("#plusbtn").click();
        
   
           }else if($('#submit_req').is(':focus')){
               
          submit_req();
        }else if($('#pin').is(':focus')){
             submit_phy();
        }
          
        }
});


$(document).on('keyup',function(e) {
    if(e.which == 9) {
     if ($('#store').is(':focus')) { 
         
         $('#store').css('border-bottom','3px solid blue');
         
         
           }else if($('#supplier').is(':focus')) { 
               
                $('#supplier').css('border-bottom','3px solid blue');
              
           }else{
                $('#store').css('border-bottom','none');
                 $('#supplier').css('border-bottom','none');
           }
    
    }
});





  
    
   $("#plusbtn").click(function()
        {    
          
         
           var product   =  $('#product').val();
           var product_id   =  $('#product').attr('menuid');
           var barcode   =  $('#barcode').val();
          
           var brand    =  $('#brand').val(); 
           
           var rate_type    =  $('#rate_type').val(); 
            var unit_type    =  $('#unit_type').val(); 
            
            
            var edit_id=$('#edit_id').val();
            var store=$('#store').val();
           var datastring2 = "set=check_product_phy_def&product="+product_id+"&store="+store;
         
          $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
          if($.trim(data)=='yes'){
              
              
              if(store!=''){
          
           var datastring = "set=add_product_physical_default&product="+product+"&barcode="+barcode
                 +"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type+"&edit_id="+edit_id+"&store="+store;
        
            if(product!=''){
                  
                  
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                    var a=JSON.parse(data);
                   
                     $("#product").val('');
                     $("#barcode").val('');
                    
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     
                     var s=1;
                     $.each(a, function(i, record) {
                        
                        $("#second_div_main"+record.tpf_id).empty() ;
                         $("#second_div_main"+record.tpf_id).hide() ;
                        
                     var sl=s++;
                   $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                    var product=record.tpf_name;
                  
                    
                    if(record.tpf_brand=='null' || record.tpf_brand=='' || record.tpf_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tpf_brand;
                    }
                    
                    
                    if(record.tpf_barcode=='null' || record.tpf_barcode=='' || record.tpf_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tpf_barcode;
                    }
                    
                    
                    
                     var  rate_type=record.tpf_rate_type;
                     
                     var  unit_type=record.tpf_unit_type;
                     
        if($('.append_div_main').find('#del_card' + record.tpf_id).length === 0) {
              $(".append_div_main").append(" <div class='add_menu_row hai' id='second_div_main"+record.tpf_id+"' >"+
  "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tpf_id+"' value='" + product + "' readonly type='text' style='width: 12%;'>  "+
   
   " <input id='barcode"+record.tpf_id+"' value='" + barcode + "' readonly  type='text' style='width: 12%;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tpf_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tpf_id+"' readonly type='text' style='width: 12%;'>"+
    
   " <input value='" + unit_type + "' style='width: 10rem;' id='unit_type"+record.tpf_id+"' readonly type='text'>"+
   
   
    " <a class='inv-req-btn' id='del_card"+record.tpf_id+"' name='del_card"+record.tpf_id+"' onclick='delete_req("+record.tpf_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                                 
                         }
                         

                         
                     });
                     $('#product').focus();
                    
                 }
                 
                 });
                   
                   }else{
                   
       $('#load_error').show();
        
        
          if(product==''){
       $('#load_error').text('ENTER PRODUCT');
       $("#product").focus();
        }
        
        $('#load_error').delay(1000).fadeOut('slow');
                    
       }
       
       }else{
       $('#load_error').show();
       
       $('#load_error').text(' SELECT STORE');
       $('#load_error').delay(1000).fadeOut('slow');
       }
                   
             }else{
                   
       $('#load_error').show();
       
       $('#load_error').text(' PRODUCT ALREADY EXIST');
       $("#product").focus();
         $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
                     
        $('#load_error').delay(1000).fadeOut('slow');
                    
                   }    
                   
              }    
                   
                   
                   
        });            
                   
                   
                   
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
        
        
        $('.close_pop_master').click(function(){
           $('#mst_name').val('');
           $('#mst_status').val('status');
        });
            
      
       $("#product").autocomplete({
                            minLength: 1,
                            source:       function(request, response) {
              $.getJSON(
                "load_inventory.php?set=search_product_inventory",
                        { term:request.term, from_store:$('#store').val() }, 
                           response
                                 );
                          },
                            focus: function (event, ui) {
                                $("#product").val(ui.item.label);
                               
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                    $("#brand").focus(); 
                                $("#product").val(ui.item.label);
                                $('#product').attr('menuid',ui.item.menuid);
                                
                                $('#rate_type').val(ui.item.rate_type);
                                $('#unit_type').val(ui.item.base_unit);
                                $('#barcode').val(ui.item.barcode);

                                localStorage.name_length= $("#product").val().length;
                                return false;
                                
                            }

                        });
                        
                        
      
       $("#barcode").autocomplete({
                            minLength: 1,
                           source:       function(request, response) {
              $.getJSON(
                "load_inventory.php?set=search_barcode_inventory",
                        { term:request.term, from_store:$('#store').val() }, 
                           response
                                 );
                          },
                         
                                select: function (event, ui) {
                                     $("#brand").focus();
				$("#product").val(ui.item.label);
                                 $('#product').attr('menuid',ui.item.menuid);
                                
                                $("#valueofsearch_menu").val('');
                           
       $('#rate_type').val(ui.item.rate_type);
       $('#unit_type').val(ui.item.base_unit);
        $('#barcode').val(ui.item.barcode);
        
        $('#product').attr('menuid',ui.item.menuid);  
        
        localStorage.barcode_length= $("#barcode").val().length;
                                return false;
                                
                            }

                        });
         
    });
 
function clear_name(){
     
     
     
      if((localStorage.name_length !=$('#product').val().length && localStorage.name_length >0) || (localStorage.barcode_length !=$('#barcode').val().length && localStorage.barcode_length >0)){
        
          
          $("#product").val('');
                     $("#barcode").val('');
                   
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                   
          
          localStorage.name_length='0';
          localStorage.barcode_length='0';
        }
      
 }


function numdot(item,evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}  
 

     
 function delete_req(id){
     
         $('#load_error').show();
        $('#load_error').css('color','green');
       $('#load_error').text('LOADING TO PHYSICAL STOCK');
               
        $('#load_error').delay(1000).fadeOut('slow');
     
     
        var data="set=delete_physical_default&id="+id;
         
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {     
           
                            setTimeout(function () {
                            location.reload();
                            }, 500);  
        }
    });
            
        
  }
  
  function store_wise(){
 
                        
            var store=$('#store').val();
          var datastring = "set=product_physical_load_default&store="+store
          
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 {
                     
                     if($.trim(data)!='nodata'){
                 
                $(".hai").html('');
             $(".hai").empty();
                $(".hai").remove();
                 
                 
                  $('.add_menu_row'+store).show();
                  
                  
                 
                    var a=JSON.parse(data);
                   
                     $("#product").val('');
                     $("#barcode").val('');
                   
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                      
                    
                     var s=1;
                     $.each(a, function(i, record) {
                        
                     var sl=s++;
                    $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                    var product=record.tpf_name;
                 
                    
                    if(record.tpf_brand=='null' || record.tpf_brand=='' || record.tpf_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tpf_brand;
                    }
                    
                    if(record.tpf_barcode=='null' || record.tpf_barcode=='' || record.tpf_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tpf_barcode;
                    }
                    
                     var  rate_type=record.tpf_rate_type;
                     var  unit_type=record.tpf_unit_type;
                    
              if($('.append_div_main').find('#del_card' + record.tpf_id).length === 0) {
                  
              $(".append_div_main").append(" <div class='add_menu_row hai' id='second_div_main"+record.tpf_id+"' >"+
 "<div class='inv-req-form '>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tpf_id+"' value='" + product + "' readonly type='text' style='width: 12%;'>  "+
   
   " <input id='barcode"+record.tpf_id+"' value='" + barcode + "' readonly  type='text' style='width: 12%;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tpf_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tpf_id+"' readonly type='text' style='width: 12%;'>"+
    
   " <input value='" + unit_type + "'  style='width: 10rem;' id='unit_type"+record.tpf_id+"' readonly type='text'>"+
   
   
    " <a class='inv-req-btn' onclick='delete_req("+record.tpf_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
   "</div>"+
    "</div>"
                    );
                                 
                         }
                         

                         
        });
                     
   }else{
   
     $('#load_error').show();
        $('#load_error').css('color','green');
       $('#load_error').text('NO DATA');
               
        $('#load_error').delay(1000).fadeOut('slow');
     
     
     $(".hai").html('');
    $(".hai").empty();
    $(".hai").remove();
   }
   
   
  }  
  });
                   
}        

function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
       
       var store=$('#store').val();
        var ct=$('#rps_count').text();

       if(ct>0 ){
    
        $('#load_error').show();
        $('#load_error').css('color','green');
       $('#load_error').text('LOADING TO PHYSICAL STOCK');
               
        $('#load_error').delay(1000).fadeOut('slow');
        
     var datastring = "set=add_physical_list_by_default&store="+store
          
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 {
                    
                  setInterval(function () {
           
                    window.location.href='physical_stock.php';  
          
                }, 1000); 
                    
               }
              });
    
    
        }else{
            
            
          if(ct=='' || ct=='0'){
            $('#load_error').show();
        $('#load_error').css('color','green');
       $('#load_error').text('NO ITEM SFOUND');
               
        $('#load_error').delay(1000).fadeOut('slow'); 
            }
            
        }
        
        
       
       }

function default_load(){


          $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM UPDATE');
        
      
        $('#confirm_pop_all').attr('mode','edit');
    
               
       
    
}
    
</script>

	<style>
        .dataTables_scrollBody{height:460px !important;}
		.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}
		.modal-dialog{width:450px !important;top: 30%;}.modal .modal-dialog .modal-content{padding: 15px;}
               .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .ui-autocomplete{z-index:999999 !important;max-height: 400px;height: auto; overflow: scroll;}  
        </style>
 <style>
.new_overlay{
	 width:100%;
	 height:80%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
.ui-autocomplete{z-index:999999 !important;max-height: 400px;height: auto; overflow: scroll;}      
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:350px;height:380px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute; display: grid;grid-template-columns: 1fr;grid-template-rows: 2fr;justify-content: center;}  
 .quick_pop_printer_head{text-align:center;font-size:20px;color:#818181;padding:15px 0;font-weight:bold; text-transform:capitalize;}   
 .quick_pop_printer_content{width:100%;height:auto;padding:15px;text-align:center;}      
</style>
    
    </body>
</html>