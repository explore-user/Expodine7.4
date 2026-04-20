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

        <title>Central </title>

        <!--Morris Chart CSS -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/custombox/css/custombox.css" rel="stylesheet">
         <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        
    <link rel="stylesheet" href="../css/jquery-ui-1.8.2.custom.css" /> 
		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/css/content.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        
    

        <script src="assets/js/modernizr.min.js"></script>
        <style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
.ui-autocomplete{z-index:999999 !important;max-height: 400px;height: auto; overflow: scroll;}      
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:350px;height:600px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute; display: grid;grid-template-columns: 1fr;grid-template-rows: 2fr;justify-content: center;}  
 .quick_pop_printer_head{text-align:center;font-size:20px;color:#818181;padding:15px 0;font-weight:bold; text-transform:capitalize;}   
 .quick_pop_printer_content{width:100%;height:auto;padding:15px;text-align:center;}      
</style>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}</style>

    </head>


    <body class="fixed-left">
        
         <input type="hidden" id="local_branch_name" value="<?=$_SESSION['s_branchname']?>"> 
        
        <input type="hidden" id="local_branch" value="<?=$_SESSION['firebase_id']?>">  
        
        <input type="hidden" id="direct_id" value="<?=$_REQUEST['direct_id']?>">  
        
         <input type="hidden" id="store_direct" value="<?=$_REQUEST['store_direct']?>">  
        
        <input type="hidden" id="hidden_checker">
        <input type="hidden" id="hidden_checker1" value="1">
       <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />  
        
        <input type="hidden"  value=""  id="edit_id" >
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            
            <div <?php if(isset($_REQUEST['req_id']) && $_REQUEST['req_id']!=''){ ?> class="disablegenerate" <?php } ?> >
            <?php include( 'includes/header.php') ?>
            
            </div>

            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head">
            <div class="" >
                
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important; "  class="inv-req-btn1" href="#">CENTRAL KITCHEN TRANSFER</a>
                <a  class="inv-pro-btn1"  href="central_history.php">CRH</a>
               
          </div>
                   
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 0.7vw;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;" ></span> 
                    <div class="container" style="padding: 0.75; margin-bottom:1rem;" >

                    <div class="inv-req-content" style="overflow:auto;">


                    <div style="display: flex;flex-direction: column;gap: 1rem;height: 87vh;">
                    <div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none;">
    <div class="quick_pop_printer">
<div class="inv-Password">
  <div class="inv-password-img"><img style="" src="assets/images/logo_pass.png" alt=""></div>
  <div class="inv-password-msg"><span></span></div>
<div class="inv-password-input"><div class="inv-password-input-icon" ><i class="fa fa-unlock" aria-hidden="true"></i></div><input type="text"><div style="padding-top:2rem;" class="inv-password-input-icon"><i class="fa fa-long-arrow-left fa-lg" aria-hidden="true"></i></div></div>
<div class="inv-Password-numbers">
  <span>1</span>
  <span>2</span>
  <span>3</span>
  <span>4</span>
  <span>5</span>
  <span>6</span>
  <span>7</span>
  <span>8</span>
  <span>9</span>
  <span>0</span>
  <span class="inv-Password-clear" style="">Clear</span>
  <a  class="inv-password-btn" href="">Login</a>
</div>
</div>
    </div></div>


<div class="req-form-head">
<h6 style="width: 10rem;">Product</h6>

<h6 style="width: 8rem;">Barcode</h6>
<h6 style="width: 8rem;">Qty Type</h6>
<h6 style="width: 8rem;">Brand</h6>
<h6 style="width: 8rem;">Unit</h6>
<h6 style="width: 8rem;">Rate</h6>
<h6 style="width: 10rem;">Weight</h6>
<h6 style="width: 7rem;">Qty</h6>
<h6 style="width: 7rem;">Current Stock </h6>
<h6 style="width: 7rem;display: none">Reorder</h6>
<h6 style="width: 3rem;"></h6>
</div>
<div class="append_div_main " style="position:relative;display: flex;flex-direction: column;gap: 1rem;">
         <div class="add_menu_row " id="second_div_main">
             
<div class="inv-req-form">

    
    <input onkeyup="clear_name();"  onchange="clear_name();"  autofocus placeholder="Product" id="product" class="product"   type="text" style="width: 10rem;">  
    

    
    <input onkeyup="clear_name();" onchange="clear_name();" id="barcode"  placeholder="Barcode" type="text" style="width: 8rem;">
    
    
    <input style="width: 8rem;" readonly placeholder="Qty Type" id="rate_type" type="text">
    
    <input placeholder="Brand" id="brand" type="text" style="width: 8rem;">
    
    <input style="width: 8rem;" id="unit_type" readonly placeholder="Unit" type="text">
    
    <input style="width: 8rem;" id="unit_rate" readonly placeholder="Rate" type="text">
    
    <input style="width: 10rem;" id="weight" onkeyup="valid_weight_qty();" onkeypress="return numdot(this,event);"  placeholder="WEIGHT" type="text">
    
     <input style="width: 7rem;"  id="qty" onkeyup="valid_weight_qty();"  onkeypress="return numdot(this,event);"  placeholder="QTY" type="text">
     
     <input style="width: 7rem;" readonly  id="current_stock" onkeypress="return numdot(this,event);"  placeholder="CURRENT STOCK " type="text">
     
     <input style="width: 7rem;display: none" readonly id="reorder" onkeypress="return numdot(this,event);"  placeholder="REORDER LEVEL" type="text">
     
      <?php if(isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!=''){ ?>
   
      <?php }else{ ?>
     
     <a id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
       <?php } ?>
     
</div>
</div>
</div>
<div class="inv-req-Submit" style="margin-top:auto;">
    
Items : <span id="rps_count">0</span>
    
<p style="margin-bottom:0rem;display: block" ><?php if(isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!=''){ ?>  Req Id : <?=$_REQUEST['req_id']?>  <?php } ?><span style="color:darkred;"></span></p>
<a class="inv-submit-btn " style="display:none; margin-left:auto;" href="">Print</a>
<a class="inv-submit-btn "  style="display:none;" href="">Back</a>

<span id="from_div">
<select  onchange="store_from()"  id="from_store"  style=" width: 100px; " >
    <option value="">From Store</option>
  <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
              
    <option  value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>
</span>



<span>
<select onchange="store_to()"  id="to_branch" style=" width: 100px;  " >
    <option value="">To Branch</option>
  <?php 
  $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_MAIN);
    $sql_gen =  mysqli_query($localhost1,"select branch_id,branch_name from tbl_branch where  branch_id !='".$_SESSION['firebase_id']."' and  branch_group='".$_SESSION['kitchen_main_group_id']."' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
		    while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
			{
                  ?>
              
    <option  value="<?=$result_fnctvenue['branch_id']?>"><?=$result_fnctvenue['branch_name']?></option>
    
    <?php } } ?>
    
  </select>
</span>




<span id="to_kitchen" style="display:none">

</span>

 
<input id="submit_req" type="text" readonly class="inv-submit-btn " value="Submit" style="cursor: pointer;border-bottom: none;"  onclick="submit_req();" >



</div>

</div>
								</div><!-- /.modal-content -->
							</div>

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
        
        <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script> 
       
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
        }
  }
});


$(document).on('keyup',function(e) {
    
    if(e.which == 9) {
     if ($('#store').is(':focus')) { 
         
         $('#store').css('border-bottom','3px solid blue');
           }else{
               
                $('#store').css('border-bottom','none');
           }
    }
    
});



        var datastring = "set=product_central_transfer_load"
          
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
                      $("#current_stock").val('');
                       $("#reorder").val('');
                         $("#unit_rate").val('');
                     var s=1;
                     $.each(a, function(i, record) {
                        
                     var sl=s++;
                     
                     $('#hidden_checker').val(sl);
                   $('#rps_count').text(sl); 
                 
                    $("#to_branch").val(record.tct_to_branch);
                   
                    store_to();
                    $('#to_branch').prop('disabled',true);
                   
                    $('#to_store').show();
                      $('#from_store').val(record.tct_local_store);
                   
                     setInterval(function () {
                     $("#to_store").val(record.tct_to_store);
                      $('#to_store').prop('disabled',true);
                 },500);
                 
                    var product=record.mr_menuname;
                    var  qty=record.tct_qty;
                    
                    if(record.tct_brand=='null' || record.tct_brand=='' || record.tct_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tct_brand;
                    }
                    
                    
                    if(record.tct_barcode=='null' || record.tct_barcode=='' || record.tct_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tct_barcode;
                    }
                    
                    if(record.tct_weight=='null' || record.tct_weight=='' || record.tct_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tct_weight;
                    } 
                    
                     var  rate_type=record.tct_rate_type;
                     var  unit_type=record.tct_unit_type;
                    
                    
                   
                     if(record.tct_current_stock=='null' || record.tct_current_stock=='' || record.tct_current_stock==null){
                         var  current_stock= '';
                    }else{
                      current_stock=record.tct_current_stock;
                    } 
                     
                      var  rate=record.tct_rate;
                      
                      
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
                         
                  $('#from_store').prop('disabled',true);
                  $('#to_store').prop('disabled',true);
                 
              if($('.append_div_main').find('#del_card'+record.tct_id).length === 0) {
                  
              $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tct_id+"' >"+
     "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tct_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tct_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tct_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tct_id+"' readonly type='text' style='width: 8rem;'>"+
    
    
     
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tct_id+"' readonly type='text'>"+
   
   
    "<input value='" + rate + "'  id='unit_rate"+record.tct_id+"' readonly type='text' style='width: 8rem;'>"+
   
    
    " <input value='" + weight + "'  "+chk_weight +"  onkeyup='valid_weight_qty1("+record.tct_id+");' onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tct_id+"'  type='text'>"+
    
    " <input value='" + qty + "' "+chk_qty +"      onkeyup='valid_weight_qty1("+record.tct_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tct_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;' id='current_stock"+record.tct_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_req_qty("+record.tct_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    
    " <a class='inv-req-btn' id='del_card"+record.tct_id+"' name='del_card"+record.tct_id+"' onclick='delete_req("+record.tct_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
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
            
            var edit_id =  $('#edit_id').val();
            
         var weight=  $("#weight").val();
         
         var from_store=$('#from_store').val();
          var to_store=$('#to_store').val();
          
         var current_stock= $("#current_stock").val();
         
            var reorder=  $("#reorder").val();
            
            
           var rate=  $("#unit_rate").val();
           
            var local_branch=  $("#local_branch").val();
            
             var to_branch=  $("#to_branch").val();
           
           
          var datastring2 = "set=check_product_transfer_central&product="+product_id;
         
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
        
         var central_id=  $("#product").attr('central_id');
         
            if(product!='' && qty > '0' && weight >'0' && from_store!='' && to_store!='' ){
              
                  var datastring = "set=add_product_transfer_central&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type
                   +"&edit_id="+edit_id+"&current_stock="+current_stock+"&reorder="+reorder+"&from_store="+from_store
                   +"&to_store="+to_store+"&rate="+rate+"&local_branch="+local_branch+"&to_branch="+to_branch+"&central_id="+central_id;
         
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                   
                 
                   $('#from_store').prop('disabled',true);
                  $('#to_store').prop('disabled',true);
                  
                    var a=JSON.parse(data);
                   
                  
                     $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
                      $("#current_stock").val('');
                       $("#reorder").val('');
                         $("#unit_rate").val('');
                     var s=1;
                     $.each(a, function(i, record) {
                       
                       $("#second_div_main"+record.tct_id).empty() ;
                         $("#second_div_main"+record.tct_id).hide() ;
                       
                     var sl=s++;
                   $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                   	
                        $("#to_branch").val(record.tct_to_branch);
                   
                    store_to();
                    $('#to_branch').prop('disabled',true);
                   
                    $('#to_store').show();
                     $('#from_store').val(record.tct_local_store);
                   
                     setInterval(function () {
                     $("#to_store").val(record.tct_to_store);
                      $('#to_store').prop('disabled',true);
                 },500);
                        
                        
                    var product=record.mr_menuname;
                    var  qty=record.tct_qty;
                    
                    if(record.tct_brand=='null' || record.tct_brand=='' || record.tct_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tct_brand;
                    }
                    
                    
                    if(record.tct_barcode=='null' || record.tct_barcode=='' || record.tct_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tct_barcode;
                    }
                    
                    if(record.tct_weight=='null' || record.tct_weight=='' || record.tct_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tct_weight;
                    } 
                    
                     if(record.tct_current_stock=='null' || record.tct_current_stock=='' || record.tct_current_stock==null){
                         var  current_stock= '';
                    }else{
                      current_stock=record.tct_current_stock;
                    } 
                    
                    
                     var  rate_type=record.tct_rate_type;
                     var  unit_type=record.tct_unit_type;
                    
                      var  rate=record.tct_rate;
                      
                   
                 
                 if(unit_type=='Nos' || unit_type=='Single' ){ 
                      if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                   }
                       var chk_qty='';
                        var chk_weight = 'readonly' ;
                         }else{
                              if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                              }
                              
                              
                               chk_weight='';
                               
                               if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){
                                          chk_weight='readonly';
                                           
                                        }
                               
                         }   
                         
                
                 
                 
              if($('.append_div_main').find('#del_card'+record.tct_id).length === 0) {
                  
      $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tct_id+"' >"+
     "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tct_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tct_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tct_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tct_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tct_id+"' readonly type='text'>"+
   
    "<input value='" + rate + "'  id='unit_rate"+record.tct_id+"' readonly type='text' style='width: 8rem;'>"+
    
    " <input value='" + weight + "'  "+chk_weight +" onkeyup='valid_weight_qty1("+record.tct_id+");'  onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tct_id+"'  type='text'>"+
    
    " <input value='" + qty + "'    "+chk_qty +" onkeyup='valid_weight_qty1("+record.tct_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tct_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;' id='current_stock"+record.tct_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_req_qty("+record.tct_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' id='del_card"+record.tct_id+"' name='del_card"+record.tct_id+"' onclick='delete_req("+record.tct_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                   
                   
                    $('#from_store').prop('disabled',true);
                  $('#to_store').prop('disabled',true);
                   
                         }
                         

                         
                     });
                     
                      $("#product").focus();
                    
                 }
                 
                 });
                   
                   }else{
                   
       $('#load_error').show();
       
       
       
       if(to_store=='' ){
       $('#load_error').text('SELECT TO STORE');
        $("#to_store").focus();
        }
       

       if(from_store=='' ){
       $('#load_error').text('SELECT FROM STORE ');
        $("#from_store").focus();
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
        if(qty=='' || qty=='0' || qty=='00' ){
        $('#load_error').text('ENTER QTY');
        $("#qty").focus();
        }
        
       
         if(weight=='' || weight=='0'  || weight=='00' ){
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
       
       $('#load_error').text('PRODUCT ALREADY EXIST');
       $("#product").focus();
       $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
                      $("#unit_rate").val('');
                     $("#current_stock").val('');
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
                         { term:request.term, from_store:$('#from_store').val() }, 
                            response
                                 );
                          },
                            
                           // source: "load_inventory.php?set=search_product_inventory",
                            focus: function (event, ui) {
                                $("#product").val(ui.item.label);
                               
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                  
                                  var from_store=$('#from_store').val(); 
                                  var to_store=$('#to_store').val(); 
                                 
                                  if(from_store !='' && to_store!=''){
                                      
                                   
                                  if(ui.item.central_id !='' && ui.item.central_id!='undefined' && ui.item.central_id!=null){     
                                      
                                    $("#brand").val('') ; 
                                $("#brand").focus() ;
                                $("#product").val(ui.item.label);
                                
                                 $("#product").attr('central_id',ui.item.central_id);
                                
                                $('#qty').val('');
                                $('#weight').val('');	
                               
                                $('#rate_type').val(ui.item.rate_type);
                                $('#unit_type').val(ui.item.base_unit);
                                $('#barcode').val(ui.item.barcode);
                                
                                  $('#reorder').val(ui.item.reorder);
                                  
                                  $('#current_stock').val(ui.item.stock);

                                $('#product').attr('menuid',ui.item.menuid);   
                                
                               
                                 $('#unit_rate').val(ui.item.rate);
                                 
                             if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                      if(ui.item.rate_type!='Packet'){ 
                                        $('#weight').attr('readonly', true);
                                          } 
                                        $('#qty').attr('readonly', false);
                                        $('#weight').val('1');	
                                          $('#qty').val('1');
                                          
                                      if(ui.item.rate_type=='Packet'){
                                          $('#weight').attr('readonly', true);
                                            $('#weight').val(ui.item.weight);
                                        }
                                             
                                          
                                }else{
                                    
                                      $('#qty').val('1');
                                       $('#weight').val('1');	
                                       $('#weight').attr('readonly', false);
                                        if(ui.item.rate_type!='Packet'){
                                       $('#qty').attr('readonly', true);
                                        }
                                        
                                         if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                          $('#weight').attr('readonly', true);
                                            $('#weight').val(ui.item.weight);
                                        }
                                        
                                        
                                }
                                
                                 $('#from_store').prop('disabled', true);
                                  $('#to_store').prop('disabled', true);
                                 $('#to_branch').prop('disabled', true);
                                 
                                 localStorage.name_length= $("#product").val().length;
                                  localStorage.barcode_length= $("#barcode").val().length;
                                  
                                return false;
                                
                                
                        }else{
             
         $("#product").val('');   
         $("#product").focus(); 
         $('#load_error').show();
         $('#load_error').css('color','red');
          $('#load_error').css('fontSize','0.7vw');
         $('#load_error').text('ADD CENTRAL KITCHEN ID IN MENUMASTER & MAKE SURE ID IS SAME FOR MENU IN TO BRANCH ');
         
         $('#load_error').delay(4000).fadeOut('slow');
              return false;           
         }         
                                
                                
                             
         }else{
             
         $("#product").val('');   
         $("#product").focus(); 
         $('#load_error').show();
         $('#load_error').css('color','red');
         
          if(to_store==''){
         $('#load_error').text('SELECT TO STORE');
         }
         
         
         if(from_store==''){
         $('#load_error').text('SELECT FROM STORE');
         }
         
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
                        { term:request.term, from_store:$('#from_store').val() }, 
                           response
                                 );
                          },
                            focus: function (event, ui) {
                                $("#barcode").val(ui.item.label);
                                $("#valueofsearch_menu").val(ui.item.menuid);
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                 var from_store=$('#from_store').val(); 
                                  var to_store=$('#to_store').val(); 
                                  $("#product").attr('central_id',ui.item.central_id);
                                  if(from_store !='' && to_store!=''){
                                      
                                    if(ui.item.central_id !='' && ui.item.central_id!='undefined' && ui.item.central_id!=null){       
                                      
                                      
                                      $("#brand").val('') ; 
                                    $("#brand").focus() ;
				$("#product").val(ui.item.label);
                                  $('#qty').val('');
                                
                                $("#valueofsearch_menu").val('');
                                $('#weight').val('');	
                                
				$('#reorder').val(ui.item.reorder);
                                   $('#unit_rate').val(ui.item.rate);
                                $('#current_stock').val(ui.item.stock);
                                  
                                  
                         if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                      if(ui.item.rate_type!='Packet'){
                                        $('#weight').attr('readonly', true);
                                          }
                                        $('#qty').attr('readonly', false);
                                         $('#qty').val('1');
                                           $('#weight').val('1');
                                           
                                            if(ui.item.rate_type=='Packet'){
                                          $('#weight').attr('readonly', true);
                                            $('#weight').val(ui.item.weight);
                                        }
                                }else{
                                      $('#qty').val('1');
                                        $('#weight').val('1');
                                       $('#weight').attr('readonly', false);
                                        if(ui.item.rate_type!='Packet'){
                                       $('#qty').attr('readonly', true);
                                        }
                                        
                                         if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                          $('#weight').attr('readonly', true);
                                            $('#weight').val(ui.item.weight);
                                        }
                                        
                                }
                                
                                  
                                  
       $('#rate_type').val(ui.item.rate_type);
       $('#unit_type').val(ui.item.base_unit);
        $('#barcode').val(ui.item.barcode);
        
        $('#product').attr('menuid',ui.item.menuid);  
        
        $('#from_store').prop('disabled', true);
                                  $('#to_store').prop('disabled', true);
                                 $('#to_branch').prop('disabled', true);
                                  
        localStorage.barcode_length= $("#barcode").val().length;
        localStorage.name_length= $("#product").val().length;
                                return false;
                                
                                
                  }else{
             
         $("#product").val('');   
         $("#product").focus(); 
         $('#load_error').show();
         $('#load_error').css('color','red');
          $('#load_error').css('fontSize','10px');
         $('#load_error').text('ADD CENTRAL KITCHEN ID IN MENUMASTER & MAKE SURE ID IS SAME FOR MENU IN TO BRANCH ');
         
         $('#load_error').delay(4000).fadeOut('slow');
              return false;           
         }                        
                                
                                
          }else{
            
         $("#barcode").val('');   
         $("#barcode").focus(); 
         $('#load_error').show();
         $('#load_error').css('color','red');
         if(to_store==''){
         $('#load_error').text('SELECT TO STORE');
     }
         
         
         if(from_store==''){
         $('#load_error').text('SELECT FROM STORE');
     }
         $('#load_error').delay(1500).fadeOut('slow');
              return false;                  
          }
                            }

                        });
       
    
      });
      
      
     function check_direct_prd(){
     
     var hidden_checker1=$('#hidden_checker1').val();
    
   
     if(hidden_checker1=='0'){
         $('#to_store').val('');
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('CURRENT STOCK IS LESS');
         $('#load_error').delay(1500).fadeOut('slow');
        }
        
        
     
    }
      
      
      
    function store_from(){
    var from=$('#from_store').val();
    
    var data="set=store_load_transfer&from="+from+"&mode=from";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          $('#to_div').html(data);
        
        }
    });
    
    }
    
    
    function store_to(){
        
    var branch=$('#to_branch').val();

     if(branch==''){
        
        $('#to_kitchen').hide();
             
          $('#to_kitchen').html('');
          
          $('#to_store').val('');
          
      }
    
    
    var data="set=live_kitchen&branch="+branch;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
             $('#to_kitchen').show();
             
            $('#to_kitchen').html(data);
        
        }
    });
    
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
            // $('#weight'+id).val('');
              $('#qty'+id).val('');
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

 function clear_name(){
     
     if($('#from_store').val()==''){
         
         $('#product').val('');
         $('#barcode').val('')
         
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('SELECT FROM STORE');
         $('#load_error').delay(1000).fadeOut('slow');
      }
   
     
      if($('#to_store').val()==''){
         
         $('#product').val('');
         $('#barcode').val('')
         
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('SELECT TO STORE ');
         $('#load_error').delay(1000).fadeOut('slow');
      }
      
      
      if($('#to_branch').val()==''){
         
         $('#product').val('');
         $('#barcode').val('')
         
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('SELECT TO BRANCH ');
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
           $("#reorder").val('');
            $("#current_stock").val('');
            
          localStorage.name_length='0';
          localStorage.barcode_length='0';
          
          $('#from_store').prop('disabled', false);
           $('#to_store').prop('disabled', false);
        }
      
 }
     
     
     
 function delete_req(id){
     var check = confirm("Confirm Delete ?");
	if(check==true)
	{
          var data="set=delete_transfer_central&id="+id;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
             
        //  $('#second_div_main'+id).remove();
         location.reload(); 
        }
    });
            
        }
  }
  
  function edit_req_qty(id){
      
      
       var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
           
        if($.trim(data)=='yes'){
      
      
     var check = confirm("Confirm Update ?");
	if(check==true)
	{
            
            
           var qty=  $('#qty'+id).val();
           
           var weight=  $('#weight'+id).val();
           
           var unit_type=  $('#unit_type'+id).val();
             var rate_type=  $('#rate_type'+id).val(); 
             
            if(qty>'0' && weight>'0'){
            
          var data="set=update_transfer_qty_central&id="+id+"&qty="+qty+"&weight="+weight+"&unit_type="+unit_type+"&rate_type="+rate_type;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
          location.reload();
           
        }
          });
    
    
            }else{
                
       $('#load_error').show();
        $('#load_error').css('color','red');
         
       
       if(qty=='' || qty=='0' ){
       $('#load_error').text('ENTER QTY ');
       $('#qty'+id).focus();
        }
         
         if(weight=='' || weight=='0'){
       $('#load_error').text('ENTER WEIGHT');
        $('#weight'+id).focus();
         }
            
            
        $('#load_error').delay(1000).fadeOut('slow');
            }
            
        }
        
        
        
        }else{
                
        $('#load_error').show();
        $('#load_error').css('color','red');
        $('#load_error').text('CHECK INTERNET & SYNC CENTRAL KITCHEN');
      
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
       
    }
       });
        
        
        
        
  }
  
  
  
  
  function submit_req(){
    
      
      if( $('#hidden_checker').val()>0){  
          
          
          var local_branch_name=$('#local_branch_name').val(); 
          
          var to_branch_name=$( "#to_branch option:selected" ).text();
          
          var local_store_name=$('#from_store option:selected').text(); 
          
          var to_store_name=$('#to_store option:selected').text(); 
          
         var from_store=$('#from_store').val();
         var to_store=$('#to_store').val();
         
         var direct_id=$('#direct_id').val();
        
        if(from_store!='' && to_store!=''){
            
             var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
        if($.trim(data)=='yes'){
                
       $('#submit_req').addClass('disablegenerate'); 
            
       var data="set=add_transfer_all_central&from_store="+from_store+"&to_store="+to_store+"&direct_id="+direct_id+"&local_branch_name="+local_branch_name+"&to_branch_name="+to_branch_name+"&local_store_name="+local_store_name+"&to_store_name="+to_store_name;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
        $('#load_error').show();
        $('#load_error').css('color','green');
        $('#load_error').text(' TRANSFERING STOCK TO OUTLET ');
      
        $('#load_error').delay(1000).fadeOut('slow');
            
           var edit_id =  $('#edit_id').val();
           
           if(edit_id!=''){
               
             window.location.href='transfer_history.php';
              
           }else{
               
              window.location.href='central_kitchen.php';  
              
           }
              
        
        }
    });
    
        }else{
                
        $('#load_error').show();
        $('#load_error').css('color','red');
        $('#load_error').text('CHECK INTERNET & SYNC THE CENTRAL KITCHEN  TO CLOUD FIRST');
      
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
    
    
     }
    });
    
    
    
        }else{
            
            $('#load_error').show();
         $('#load_error').css('color','red');
         
         if(to_store==''){
       $('#load_error').text('SELECT TO STORE');
       $('#to_store').focus();
            }
         
         if(from_store==''){
       $('#load_error').text('SELECT FROM STORE');
       $('#from_store').focus();
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
    
    
    function direct_go(){
        
         window.location.href='history.php';
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
        </style>

    </body>

</html>