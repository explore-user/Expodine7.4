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

        <title>Consumption </title>

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
                

                
                 <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important; "  class="inv-req-btn1" href="#">CONSUMPTION</a>
                <a class="inv-pro-btn1"  href="consumption_history.php">CSH</a>
                

              
          </div>
  
                
            </div>

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 10px;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;" ></span>  
                	
                    <div class="container" style="padding: 0.75; margin-bottom:1rem !important;" >
                    <div class="inv-req-content" style="overflow:auto;">
<div style="display: flex;flex-direction: column;gap: 1rem; height: 87vh;">
<div class="req-form-head" style="padding-left: 0.5rem; padding-right: 0.5rem;">
<h6 style="width: 10rem;">Product</h6>

<h6 style="width: 10rem;">Barcode</h6>
<h6 style="width: 12rem;">QTY Type</h6>
<h6 style="width: 10rem;">Brand</h6>
<h6 style="width: 10rem;">Unit</h6>
<h6 style="width: 10rem;">Balance</h6>
<h6 style="width: 10rem;">Weight</h6>
<h6 style="width: 10rem;">QTY</h6>
<h6 style="width: 10rem;">STOCK</h6>
<h6 style="width: 3rem;"></h6>
</div>

<div class="append_div_main" style="position:relative; display: flex;flex-direction: column;gap: 1rem;overflow: auto;">
         <div class="add_menu_row " id="second_div_main">
             
<div class="inv-req-form" style="padding-left: 0.5rem; padding-right: 0.5rem;">
    
    <input onkeyup="clear_name();"  onchange="clear_name();"  autofocus placeholder="Product" id="product"   type="text" style="width: 10rem;">  
     
    <input onkeyup="clear_name();"  onchange="clear_name();"  id="barcode"  placeholder="Barcode" type="text" style="width: 10rem;">
    
    
    <input style="width: 12rem;" readonly placeholder="Qty Type" id="rate_type" type="text">
    
    <input placeholder="Brand" id="brand" type="text" style="width: 10rem;">
    
    <input style="width: 10rem;" id="unit_type" readonly placeholder="Unit" type="text">
    
    <input style="width: 10rem;" id="balance" onkeyup="valid_balance();" onkeypress="return numdot(this,event);"  placeholder="BALANCE" type="text">
    
    <input readonly style="width: 10rem;" id="weight" onkeyup="valid_weight_qty();" onkeypress="return numdot(this,event);"  placeholder="WEIGHT" type="text">
    
    <input readonly style="width: 10rem;" id="qty" onkeyup="valid_weight_qty();" onkeypress="return numdot(this,event);"  placeholder="QTY" type="text">
     
      <input style="width: 10rem;" readonly  id="current_stock" onkeypress="return numdot(this,event);"  placeholder="CURRENT STOCK " type="text">
     
     <a id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
    
</div>
</div>
</div>


<div class="inv-req-Submit" style="margin-top:auto;">
    <div class="inv-vendor1" style="display:none">
    <select  id="supplier">
    <option value="">Supplier</option>
    
    <?php  
    $fnct_menu = $database->mysqlQuery("select * from tbl_vendor_master where v_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option  value="<?=$result_fnctvenue['v_id']?>"><?=$result_fnctvenue['v_name']?></option>
    
    <?php } } ?>
    
  </select>
         
  </div>
  Items : <span id="rps_count">0</span>
    
    <?php 
  $store_on='';
   $fnct_menu1 = $database->mysqlQuery("select tc_store from tbl_consumption where tc_set='N' ");
         $num_fdtl1 = $database->mysqlNumRows($fnct_menu1);
        if ($num_fdtl1 > 0) {
              while ($result_fnctvenue1 = $database->mysqlFetchArray($fnct_menu1))
              {
                  $store_on=$result_fnctvenue1['tc_store'];
                  
              }
              }
    
    ?>
    
    <select onchange="store_check()"  id="store" <?php if($store_on!=''){ ?> style="pointer-events: none "   <?php } ?>>
    <option value="">Select Store</option>
  <?php 
  
   
  
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option  <?php if($store_on==$result_fnctvenue['ti_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>

    

<input id="submit_req" type="text" readonly class="inv-submit-btn " value="Submit" style="margin-left:auto;cursor: pointer;border-bottom: none"  onclick="submit_req();" >


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
        
   
           }
           else if($('#balance').is(':focus')){
               
           $("#plusbtn").click();
        
   
           }
            else if($('#submit_req').is(':focus')){
               
          submit_req();
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


 $('.calc').click( function(event) { 
          
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
		var focused=$('#focusedtext').val();
                var calval=($(this).text());
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
	
	});




          var datastring = "set=product_consum_load"
          
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                    var a=JSON.parse(data);
                   
                     $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                       $("#weight").val('');
                     
                     var s=1;
                     $.each(a, function(i, record) {
                        
                     var sl=s++;
                   $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                    var product=record.tc_name;
                    var  qty=record.tc_qty;
                    
                    if(record.tc_brand=='null' || record.tc_brand=='' || record.tc_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tc_brand;
                    }
                    
                    
                    if(record.tc_barcode=='null' || record.tc_barcode=='' || record.tc_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tc_barcode;
                    }
                    
                     if(record.tc_weight=='null' || record.tc_weight=='' || record.tc_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tc_weight;
                    } 
                    
                     var  rate_type=record.tc_rate_type;
                     var  unit_type=record.tc_unit_type;
                     
                          if(record.tc_balance=='null' || record.tc_balance=='' || record.tc_balance==null){
                         var  balance= '';
                    }else{
                      balance=record.tc_balance;
                    } 
                    
                      if(unit_type=='Nos' || unit_type=='Single' ){ 
                          
                          if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                          }
                           var chk_weight = 'readonly' ;
                       var chk_qty='';
                         }else{
                             if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                         }
                               chk_weight='';
                               if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){
                                          chk_weight='readonly';
                                           
                                        }
                         }                
                                      
                   var  current_stock=record.tc_current_stock;
                  
              if($('.append_div_main').find('#del_card' + record.tc_id).length === 0) {
                  
              $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tc_id+"' >"+
    "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tc_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tc_id+"' value='" + barcode + "' readonly  type='text' style='width: 10rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tc_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tc_id+"' readonly type='text' style='width: 10rem;'>"+
    
   " <input value='" + unit_type + "'  style='width: 10rem;' id='unit_type"+record.tc_id+"' readonly type='text'>"+
   
   
    " <input value='" + balance + "'  onkeyup='valid_balance1("+record.tc_id+");' onkeypress='return numdot(this,event);'    style='width: 10rem;' id='balance"+record.tc_id+"'  type='text'>"+
   
    " <input readonly value='" + weight + "'  "+chk_weight +"  onkeyup='valid_weight_qty1("+record.tc_id+");' onkeypress='return numdot(this,event);'    style='width: 10rem;' id='weight"+record.tc_id+"'  type='text'>"+
    
    " <input readonly value='" + qty + "'   "+chk_qty +"   onkeyup='valid_weight_qty1("+record.tc_id+");'  onkeypress='return numdot(this,event);'   style='width: 10rem;' id='qty"+record.tc_id+"'  type='text'>"+
    
     " <input value='" + current_stock + "' readonly style='width: 10rem;' id='current_stock"+record.tc_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_por_qty("+record.tc_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' onclick='delete_req("+record.tc_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
   "</div>"+
    "</div>"
             );
                                 
      }
                         

                         
        });
                     
                     
           }   });
                   
            
    
   $("#plusbtn").click(function()
    {    
          
         
           var product   =  $('#product').val();
           var product_id   =  $('#product').attr('menuid');
           var barcode   =  $('#barcode').val();
           var qty        =  $('#qty').val(); 
           var brand    =  $('#brand').val(); 
           
           var rate_type    =  $('#rate_type').val(); 
            var unit_type    =  $('#unit_type').val(); 
            
            
            var edit_id=$('#edit_id').val();
            
             var weight= $("#weight").val();
           var current_stock= $("#current_stock").val();
             
          var store= $("#store").val();
          
           var datastring2 = "set=check_product_consump&product="+product_id;
         
          $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
          if($.trim(data)=='yes'){
          
          
          
          
              
              
     if( parseFloat(qty) > parseFloat(current_stock)  && (unit_type=='Nos' || unit_type=='Single')){
         
         $('#load_error').show();
         $('#load_error').text(' INVALID QTY');
         $("#qty").focus();
         $("#qty").val('');
         $('#load_error').delay(1000).fadeOut('slow');        
         exit;
         return false;  
                
       }
                                     
       if(rate_type=='Packet' && parseFloat(qty) > parseFloat(current_stock)  && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                                            
         $('#load_error').show();
         $('#load_error').text(' INVALID QTY');
         $("#qty").focus();
         $("#qty").val('');
         $('#load_error').delay(1000).fadeOut('slow');        
                exit;
                return false;
                                            
        }
                  
                  
         if(rate_type=='Loose' && parseFloat(weight) > parseFloat(current_stock)  && (unit_type=='KG' || unit_type=='LTR')){ 
             
         $('#load_error').show();
         $('#load_error').text(' INVALID WEIGHT');
         $("#weight").focus();
         $("#weight").val('');
         $('#load_error').delay(1000).fadeOut('slow');        
         exit;
         return false;    
         
        }
                                            
           var balance=$('#balance').val();    
                 
           var datastring = "set=add_product_consumption&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type+"&edit_id="+edit_id+"&store="+store+"&current_stock="+current_stock+"&balance="+balance;
        
            if(product!='' && qty >= '0' && weight >='0' && store!='' && balance!=''  ){
                  
                  
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                    var a=JSON.parse(data);
                   
                     $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                      $("#weight").val('');
                      
                     $('#store').prop('disabled',true);   
                 // $('#store').val(''); 
                 $('#supplier').val(''); 
            
                     var s=1;
                    $.each(a, function(i, record) {
                        
                        
                         $("#second_div_main"+record.tc_id).empty();
                         $("#second_div_main"+record.tc_id).hide();
                        
                        
                     var sl=s++;
                   $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                    var product=record.tc_name;
                    var  qty=record.tc_qty;
                    
                    if(record.tc_brand=='null' || record.tc_brand=='' || record.tc_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tc_brand;
                    }
                    
                    
                    if(record.tc_barcode=='null' || record.tc_barcode=='' || record.tc_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tc_barcode;
                    }
                    
                     if(record.tc_weight=='null' || record.tc_weight=='' || record.tc_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tc_weight;
                    } 
                    
                    if(record.tc_balance=='null' || record.tc_balance=='' || record.tc_balance==null){
                         var  balance= '';
                    }else{
                      balance=record.tc_balance;
                    } 
                    
                     var  rate_type=record.tc_rate_type;
                     var  unit_type=record.tc_unit_type;
                     
                         
                      if(unit_type=='Nos' || unit_type=='Single' ){ 
                          
                          if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                          }
                           var chk_weight = 'readonly' ;
                       var chk_qty='';
                         }else{
                             if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                         }
                               chk_weight='';
                               if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){
                                          chk_weight='readonly';
                                           
                                        }
                         }                
                                      
                   var  current_stock=record.tc_current_stock;
                    location.reload();
              if($('.append_div_main').find('#del_card' + record.tc_id).length === 0) {
                  
              $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tc_id+"' >"+
    "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tc_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tc_id+"' value='" + barcode + "' readonly  type='text' style='width: 10rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tc_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tc_id+"' readonly type='text' style='width: 10rem;'>"+
    
   " <input value='" + unit_type + "'  style='width: 10rem;' id='unit_type"+record.tc_id+"' readonly type='text'>"+
   
    " <input  value='" + balance + "'    onkeyup='valid_balance1("+record.tc_id+");' onkeypress='return numdot(this,event);'    style='width: 10rem;' id='balance"+record.tc_id+"'  type='text'>"+
   
    " <input readonly value='" + weight + "'  "+chk_weight +"   onkeyup='valid_weight_qty1("+record.tc_id+");' onkeypress='return numdot(this,event);'    style='width: 10rem;' id='weight"+record.tc_id+"'  type='text'>"+
    
    " <input readonly value='" + qty + "'   "+chk_qty +"  onkeyup='valid_weight_qty1("+record.tc_id+");'  onkeypress='return numdot(this,event);'   style='width: 10rem;' id='qty"+record.tc_id+"'  type='text'>"+
    
     " <input value='" + current_stock + "' readonly style='width: 10rem;' id='current_stock"+record.tc_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_por_qty("+record.tc_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' onclick='delete_req("+record.tc_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
   "</div>"+
    "</div>"
                    );
                                 
                         }
                         

                         
        });
                     $('#product').focus();
                        $('#product').val('');
                 }
                 
                 });
                   
                   }else{
                   
       $('#load_error').show();
        if(store=='' ){
       $('#load_error').text('SELECT STORE');
        $("#store").focus();
        }
       
//        if(qty>current_stock){
//       $('#load_error').text('INVALID QTY');
//        $("#qty").focus();
//        }
        
        
//        if(weight>current_stock ){
//       $('#load_error').text('INVALID WEIGHT');
//        $("#weight").focus();
//        }
//       
       
       
        if(qty=='' || qty=='0'){
       $('#load_error').text('ENTER QTY');
        $("#qty").focus();
        }
        
          if(weight=='' || weight=='0'){
       $('#load_error').text('ENTER WEIGHT');
        $("#weight").focus();
        }
        
        
        
        
        
          if(product==''){
       $('#load_error').text('ENTER PRODUCT');
       $("#product").focus();
        }
        
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
                            minLength: 2,
                            source:       function(request, response) {
              $.getJSON(
                "load_inventory.php?set=search_product_inventory_store",
                        { term:request.term, from_store:$('#store').val() }, 
                           response
                                 );
                          },
                            focus: function (event, ui) {
                                $("#product").val(ui.item.label);
                               
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                     var from_store=$('#store').val(); 
                                  
                                  if(from_store !=''){
                                    
                                    
                                    $("#brand").focus(); 
                                $("#product").val(ui.item.label);
                                
                                //$('#product').blur();
                               
				// $('#qty').val('1');	
                               //   $('#weight').val('1.000');	
                                $('#rate_type').val(ui.item.rate_type);
                                $('#unit_type').val(ui.item.base_unit);
                                $('#barcode').val(ui.item.barcode);

                                $('#product').attr('menuid',ui.item.menuid);  
                                  if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                       if(ui.item.rate_type!='Packet'){
                                        $('#weight').attr('readonly', true);
                                          }
                                      //  $('#qty').attr('readonly', false);
                                       
                                        if(ui.item.rate_type=='Packet'){
                                          $('#weight').attr('readonly', true);
                                           // $('#weight').val(ui.item.weight);
                                        }
                                       
                                }else{
                                    
                                  
                                       $('#qty').attr('readonly', true);
                                    //      $('#weight').attr('readonly', false);
                                          
                                        if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                    //      $('#qty').attr('readonly', false);
                                        }
                                        
                                         if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                          $('#weight').attr('readonly', true);
                                            //$('#weight').val(ui.item.weight);
                                        }
                                        
                                }
                                
                                 $('#current_stock').val(ui.item.stock);
                                
                                
                                localStorage.name_length= $("#product").val().length;
                                return false;
                                
                                
                               }else{
             
         $("#product").val('');   
         $("#product").focus(); 
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('SELECT STORE FIRST');
         $('#load_error').delay(1500).fadeOut('slow');
              return false;           
          } 
                                
                            }

                        });
                        
                        
      
       $("#barcode").autocomplete({
                            minLength: 1,
                           source:       function(request, response) {
              $.getJSON(
                "load_inventory.php?set=search_barcode_inventory_store",
                        { term:request.term, from_store:$('#store').val() }, 
                           response
                                 );
                          },
                         
                                select: function (event, ui) {
                                     $("#brand").focus();
				$("#product").val(ui.item.label);
                                
                                // $('#qty').val('1');
                                $("#valueofsearch_menu").val('');
                             // $('#weight').val('1.000');	
				  if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                     if(ui.item.rate_type!='Packet'){
                                       // $('#weight').attr('readonly', true);
                                          }
                                        //$('#qty').attr('readonly', false);
                                        
                                         if(ui.item.rate_type=='Packet'){
                                         // $('#weight').attr('readonly', true);
                                        //    $('#weight').val(ui.item.weight);
                                        }
                                       
                                }else{
                                    
                                       // $('#qty').attr('readonly', true);
                                         // $('#weight').attr('readonly', false);
                                          
                                        if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                        //  $('#qty').attr('readonly', false);
                                        }
                                        
                                         if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                         // $('#weight').attr('readonly', true);
                                         //   $('#weight').val(ui.item.weight);
                                        }
                                }
                                
                                
                              $('#current_stock').val(ui.item.stock);   	
       $('#rate_type').val(ui.item.rate_type);
       $('#unit_type').val(ui.item.base_unit);
        $('#barcode').val(ui.item.barcode);
        
        $('#product').attr('menuid',ui.item.menuid);  
        
        localStorage.barcode_length= $("#barcode").val().length;
                                return false;
                                
                            }

                        });
      
      
       
    });
 function valid_balance1(id){
    
                    
                 var qty=   parseFloat($("#qty"+id).val());
                  
                  var  rate_type = $("#rate_type"+id).val();
                var unit_type=     $("#unit_type"+id).val();
                 var  weight=   parseFloat($("#weight"+id).val());
                 
                 var stock= parseFloat($("#current_stock"+id).val());
                 
            var bal=  parseFloat($("#balance"+id).val());    
 
        
         
          if(bal==0 || bal=='0' || bal=='0.00' ||  bal=='0.000' ){
         var consumption=stock; 
           }else{
            var consumption=(stock-bal);  
        }
         
         
         if(bal>stock){
              $('#qty'+id).val('');
             $("#weight"+id).val('');
             $("#balance"+id).val('');
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID BALANCE');
         $('#load_error').delay(1500).fadeOut('slow');
        }else{
         
         
 
    if(unit_type=='Nos' || unit_type=='Single'){
         
         if(qty>stock){
             
             $('#qty'+id).val('');
             
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
              $('#qty'+id).val(consumption);   
               $('#weight'+id).val('1');
            }
            
         
       }else{
              
              if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){  
             
         if(qty>stock){
           
         $('#qty'+id).val('');
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
                 $('#qty'+id).val(consumption);   
                  $('#weight'+id).val('1');
            }
            
               }else{
              
               $('#qty'+id).val('');
              if(weight>stock){
             $('#weight'+id).val('');
            $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID WEIGHT');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
                 $('#weight'+id).val(consumption);   
                 $('#qty'+id).val('1');
            }
            
               }
            
              
        }
        
    }
        
    }
 
 function valid_balance(){
    
                    
                 var qty=   parseFloat($("#qty").val());
                  
                  var  rate_type = $("#rate_type").val();
                var unit_type=     $("#unit_type").val();
                 var  weight=   parseFloat($("#weight").val());
                 
                 var stock= parseFloat($("#current_stock").val());
                 
            var bal=  parseFloat($("#balance").val());    
 
           if(bal==0 || bal=='0' || bal=='0.00' ||  bal=='0.000' ){
              var consumption=stock; 
           }else{
            var consumption=(stock-bal);  
        }
         
         
         if(bal>stock){
              $('#qty').val('');
             $("#weight").val('');
             $("#balance").val('');
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID BALANCE');
         $('#load_error').delay(1500).fadeOut('slow');
        }else{
         
          
         
 
    if(unit_type=='Nos' || unit_type=='Single'){
         
         if(qty>stock){
             
             $('#qty').val('');
             
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
              $('#qty').val(consumption);   
               $('#weight').val('1');
            }
            
            
            
         
       }else{
              
              if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){  
             
         if(qty>stock){
           
         $('#qty').val('');
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
                 $('#qty').val(consumption);   
                  $('#weight').val('1');
            }
            
               }else{
              
               $('#qty').val('');
              if(weight>stock){
             $('#weight').val('');
            $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID WEIGHT');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }else{
                 $('#weight').val(consumption);   
                 $('#qty').val('1');
            }
            
               }
            
              
        }
        
        
          
        
        
    }
        
    }
 
 
 
 
function clear_name(){
     
     if($('#store').val()==''){
         
         $('#product').val('');
         $('#barcode').val('')
         
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('SELECT  STORE FIRST');
         $('#load_error').delay(1000).fadeOut('slow');
      }
     
      if((localStorage.name_length !=$('#product').val().length && localStorage.name_length >0) || (localStorage.barcode_length !=$('#barcode').val().length && localStorage.barcode_length >0)){
        
          
          $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
          
          localStorage.name_length='0';
          localStorage.barcode_length='0';
        }
      
 }

  function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
      var id= $('#confirm_pop_all').attr('edit_id'); 
      
      var qty=  $('#qty'+id).val();
           
            var weight=  $('#weight'+id).val();
            
             var unit=  $('#unit_type'+id).val();
            
             var rate_type=  $('#rate_type'+id).val(); 
             
             var balance=$('#balance'+id).val(); 
             
            
          var data="set=update_consum_qty&id="+id+"&qty="+qty+"&weight="+weight+"&unit="+unit+"&rate_type="+rate_type+"&balance="+balance;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          location.reload();
           
        }
    });
      
      
      
    }



function edit_por_qty(id){
    
      $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM UPDATE');
        
      
        $('#confirm_pop_all').attr('mode','edit');
    
          $('#confirm_pop_all').attr('edit_id',id); 
          
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
         $('#load_error').css('color','red');
         $('#load_error').text('DELETED');
         $('#load_error').delay(1000).fadeOut('slow');  
            
        var data="set=delete_consum&id="+id;
         
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
  
  function close_pop(){
        $('.approve_pop').hide();
      
    }
  
  
  function submit_req(){
      
      // $('.approve_pop').show();
      //$('#pin').focus();
     
         if( $('#hidden_checker').val()>0){  
        
         var store    =  $('#store').val(); 
           
         var data="set=add_consum_all&store="+store;
           
          if(store!='' ){ 
              
              $('#load_error').show();
         $('#load_error').css('color','green');
       $('#load_error').text('SUCCESSFULL');
      
        $('#load_error').delay(3000).fadeOut('slow');
           
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
           setInterval(function () {
           
              window.location.href='consumption.php';  
          
           }, 500); 
           
           
        }
    });
    
        }else{
            
           $('#load_error').show();
           
      if(store==''){
        $('#load_error').text('SELECT STORE');
        $('#store').focus();
      }
         
        $('#load_error').delay(1000).fadeOut('slow'); 
        
        }
        
        
         }else{ 
             
              $('#load_error').show();
         $('#load_error').css('color','red');
       $('#load_error').text('ENTER PRODUCT DETAILS');
      
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
        
        
      
    }
    
    
    function submit_phy11(){
        
        
        var pin=$('#pin').val();
        
        if(pin!=''){
            
            
        var data="set=check_user&pin="+pin;
         
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {     
            
         if($.trim(data)=='yes'){
        
         if( $('#hidden_checker').val()>0){  
        
         var store    =  $('#store').val(); 
           
         var data="set=add_consum_all&store="+store;
           
          if(store!='' ){ 
              
              $('#load_error1').show();
         $('#load_error1').css('color','green');
       $('#load_error1').text('SUCCESSFULL');
      
        $('#load_error1').delay(3000).fadeOut('slow');
           
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
           setInterval(function () {
           
              window.location.href='physical_stock.php';  
          
           }, 500); 
           
           
        }
    });
    
        }else{
            
           $('#load_error1').show();
           
      if(store==''){
        $('#load_error1').text('SELECT STORE');
        $('#store').focus();
      }
         
        $('#load_error1').delay(1000).fadeOut('slow'); 
        
        }
        
        
         }else{
             
              $('#load_error1').show();
         $('#load_error1').css('color','red');
       $('#load_error1').text('ENTER PRODUCT DETAILS');
      
        $('#load_error1').delay(1000).fadeOut('slow');
        
        }
        
        
         }else{
             
              $('#load_error1').show();
         $('#load_error1').css('color','red');
       $('#load_error1').text('NO PERMISSION');
      
        $('#load_error1').delay(1000).fadeOut('slow');
        
        }
        
        
          }
        });
        
        
        
         }else{
             
              $('#load_error1').show();
         $('#load_error1').css('color','red');
       $('#load_error1').text('ENTER PIN');
      
        $('#load_error1').delay(1000).fadeOut('slow');
        
        }
        
        
    }
    
    
     function valid_weight_qty1(id){
   
        var weight= parseFloat($('#weight'+id).val());
        
         var qty= parseFloat($('#qty'+id).val());
         
         var stock=parseFloat($('#current_stock'+id).val());
         
        var rate_type    =  $('#rate_type'+id).val(); 
            var unit_type    =  $('#unit_type'+id).val();
            
            
          if(unit_type=='Nos' || unit_type=='Single'){
         
         if(qty>stock){
             $('#qty'+id).val('');
             
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
         
          }else{
              
              if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){  
             
              if(qty>stock){
            // $('#weight').val('');
               $('#qty').val('');
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
               }else{
              
               $('#qty'+id).val('1');
              if(weight>stock){
             $('#weight'+id).val('');
             
              
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID WEIGHT');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
               }
            
              
        }
            
         
        
        
   
    }
      function store_check(){
        
     if($('#product').val()!=''){ 
         $('#product').val('')
         
         $('#rate_type').val('');
          $('#unit_type').val('');
           $('#current_stock').val('');
          $('#qty').val('');
               $('#weight').val('');
                 $('#balance').val('');
         $('#brand').val(''); 
           $('#barcode').val(''); 
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('RE ENTER PRODUCT DETAILS ');
         $('#load_error').delay(1500).fadeOut('slow');
         
     }
        
  }
      
     function valid_weight_qty(){
   
        var weight= parseFloat($('#weight').val());
        
         var qty= parseFloat($('#qty').val());
         
         var stock=parseFloat($('#current_stock').val());
         
        var rate_type    =  $('#rate_type').val(); 
            var unit_type    =  $('#unit_type').val();
            
            
          if(unit_type=='Nos' || unit_type=='Single'){
         
         if(qty>stock){
             $('#qty').val('');
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
         
          }else{
              
              if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){  
             
              if(qty>stock){
            // $('#weight').val('');
               $('#qty').val('');
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
               }else{
              
               $('#qty').val('1');
              if(weight>stock){
             $('#weight').val('');
             
              
             $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID WEIGHT');
         $('#load_error').delay(1500).fadeOut('slow');
             
            }
            
               }
            
              
        }
       
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
    
    <div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none;">
    <div class="quick_pop_printer">
 <div class="inv-Password">
     <div  onclick="close_pop()" class="inv-password-img"> <span style="position:absolute;top:5px;left: 120px;" id="load_error1"></span>  <i style="padding: 6px;margin-left: 303px;margin-top: 10px;cursor: pointer;" class="fa fa-close" aria-hidden="true"></i></div>
  <div class="inv-password-msg"><span>AUTHORIZATION</span></div>
<div class="inv-password-input"><div class="inv-password-input-icon" ><i class="fa fa-unlock" aria-hidden="true"></i></div>
    <input maxlength="4" onkeypress='return numdot(this,event);' id="pin" type="text"><div style="padding-top:2rem;" class="inv-password-input-icon">
     <i class="fa fa-long-arrow-left fa-lg" aria-hidden="true">  </i></div></div>
        
       
<div class="inv-Password-numbers" style="cursor:pointer">
    <span class="calc">1</span>
  <span class="calc">2</span>
  <span class="calc">3</span>
  <span class="calc">4</span>
  <span class="calc">5</span>
  <span class="calc">6</span>
  <span class="calc">7</span>
  <span class="calc">8</span>
  <span class="calc">9</span>
  <span class="calc">0</span>
  <span class="inv-Password-clear calc" style="">Clear</span>
  <a  class="inv-password-btn" href="#" onclick="submit_phy()">Proceed</a>
</div>
</div>
    </div></div>
    
    </body>
</html>