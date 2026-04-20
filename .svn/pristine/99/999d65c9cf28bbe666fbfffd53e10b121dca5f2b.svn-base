<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

 $localIP = getHostByName(getHostName()); 

$pur_store='';  $pur_supplier=''; $pur_editid='';

if(isset($_REQUEST['pur_id'])&&($_REQUEST['pur_id'] !="")){
   
  $pur_editid=$_REQUEST['pur_id'];
  
  $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_purchase_order SET tp_set='N',tp_ip='$localIP' where tp_purchase_id='".$_REQUEST['pur_id']."'");

         
   $sql_smsattemt_updation55  =  $database->mysqlQuery("delete from tbl_purchase_order where tp_set='N' and tp_ip='$localIP' and tp_purchase_id!='".$_REQUEST['req_id']."'");

  
  
         $sql_login  =  $database->mysqlQuery("select tp_store,tp_supplier from tbl_purchase_order where tp_purchase_id='".$_REQUEST['pur_id']."' order by tp_id desc "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $pur_store=$result_login['tp_store'];
                       $pur_supplier=$result_login['tp_supplier'];
                      
                      
                  }
                  }
  
}


$req_po_chk='';
if(isset($_REQUEST['req_po'])&&($_REQUEST['req_po'] !="")){
   
    $req_po_chk=$_REQUEST['req_po'];
    
    
  $sql_login  =  $database->mysqlQuery("select ti_purchase_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_purchase_id'];
                  }
                  }
         
         $req_id='Pr_'.$inv_req;
         
         $req_id=  rand(100, 999999); 
         
         
         
          
         $sql_login51  =  $database->mysqlQuery("select tp_purchase_id from tbl_purchase_order where tp_set='N' "); 
            
	  $num_login51   = $database->mysqlNumRows($sql_login51);
	  if(!$num_login51){
         
         
         $sql_login5  =  $database->mysqlQuery(" INSERT INTO `tbl_purchase_order`(`tp_purchase_id`, `tp_dayclosedate`, `tp_product`,
             `tp_name`, `tp_rate_type`, `tp_barcode`, `tp_unittype`, `tp_qty`, `tp_brand`, `tp_set`,
             `tp_login`, `tp_store`,`tp_weight`,tp_ip)
             

             SELECT  '$req_id' , '".$_SESSION['date']."', `tr_product`, `tr_name`, `tr_rate_type`, `tr_barcode`, `tr_unittype`, `tr_qty`, 
                                 `tr_brand`,'N' ,'".$_SESSION['expodine_id']."', `tr_store`,`tr_weight`,'$localIP'
                                FROM tbl_requisition
                         where tr_req_id='".$_REQUEST['req_po']."'   "); 
         
          }
         
         $sql_login5  =  $database->mysqlQuery("select tr_store from tbl_requisition where tr_req_id='".$_REQUEST['req_po']."' order by tr_id desc "); 
            
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{ 
                      
                      $pur_store=$result_login5['tr_store'];
                       
                  }
                  } 
	 
  
}



?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>PO </title>

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
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
  <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script> 
		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}</style>

    </head>


    <body class="fixed-left">
        
        
         <input type="hidden"  value="<?=$_REQUEST['from']?>" id="from_flt" >
          <input type="hidden"  value="<?=$_REQUEST['to']?>" id="to_flt" >
          <input type="hidden"  value="<?=$_REQUEST['status']?>" id="status_flt">
          <input type="hidden"  value="<?=$_REQUEST['search_id']?>" id="id_flt" >
          <input type="hidden"  value="<?=$_REQUEST['type']?>" id="type_flt" >
    
        
        
        <input type="hidden" id="hidden_checker">
        
        <input type="hidden" value="<?=$pur_editid?>" id="edit_id">
        
         <input type="hidden" value="<?=$req_po_chk?>" id="req_add_id">
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
           <div <?php if((isset($_REQUEST['pur_id'])&& $_REQUEST['pur_id']!='') || $req_po_chk!=''){ ?> class="disablegenerate" <?php } ?> >
            <?php include( 'includes/header.php') ?>
            
            </div>
            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head">
            <div class="" >
                
                
                 <?php  if( $_SESSION['ser_req']=='Y'){ ?> 
                <a   class="inv-req-btn1 <?php if((isset($_REQUEST['pur_id'])&& $_REQUEST['pur_id']!='') || $req_po_chk!=''){ ?> disablegenerate <?php }?>"  href="requistion.php">REQ</a>
                 <?php  }  ?> 
                
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important;" class="inv-pro-btn1 " href="#">Purchase Order</a>
               
                
          </div>
                
               
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 10px;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;" ></span>	

                    <div class="container" style="padding: 0.75; margin-bottom:1rem;" >
                    <div class="inv-req-content" style="grid-template-rows: 0.1fr 0.1fr 1fr;">
                    <div style="display: flex;flex-direction: column;gap: 1rem;">

<div class="req-form-head">
<h6 style="width: 3%;display: none">Sl</h6>
<h6 style="width: 12%;">Product</h6>
<h6 style="width: 12%;">Barcode</h6>
<h6 style="width: 12rem;">QTY Type</h6>
<h6 style="width: 12%;">Brand</h6>
<h6 style="width: 10rem;">Unit</h6>
<h6 style="width: 10rem;">Weight</h6>
<h6 style="width: 10rem;">QTY</h6>
<h6 style="width: 3rem;"></h6>
</div>

<div class="append_div_main inv-sub-form" style="position:relative">
         <div class="add_menu_row " id="second_div_main">
             
<div class="inv-req-form" >
    <span class="inv-req-sl" style="width: 3%; overflow:hidden;display: none">#</span>
    
    <input onkeyup="clear_name();"  onchange="clear_name();"  autofocus placeholder="Product" id="product"   type="text" style="width: 12%;">  
     
    <input onkeyup="clear_name();"  onchange="clear_name();"  id="barcode"  placeholder="Barcode" type="text" style="width: 12%;">
    
    
    <input style="width: 12rem;" readonly placeholder="Qty Type" id="rate_type" type="text">
    
    <input placeholder="Brand" id="brand" type="text" style="width: 12%;">
    
    <input style="width: 10rem;" id="unit_type" readonly placeholder="Unit" type="text">
    
    <input style="width: 10rem;" id="weight" onkeypress='return numdot(this,event);'  placeholder="WEIGHT" type="text">
    
     <input style="width: 10rem;" id="qty" onkeypress="return numdot1(event);"  placeholder="QTY" type="text">
    
     <a id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
    
</div>
</div>
</div>


<div class="inv-req-Submit">
Items : <span id="rps_count">0</span> 

    <select  id="supplier">
    <option value="">Supplier</option>
    
    <?php  
    $fnct_menu = $database->mysqlQuery("select * from tbl_vendor_master where v_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option <?php if($pur_supplier==$result_fnctvenue['v_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['v_id']?>"><?=$result_fnctvenue['v_name']?></option>
    
    <?php } } ?>
    
  </select>

  <select  id="store" style="">
    <option value="">Store</option>
  <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option <?php if($pur_store==$result_fnctvenue['ti_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>

 <?php if(($pur_store=='' && $pur_editid!='')){ ?>
    
    <a class="inv-submit-btn " href="history.php">Exit</a>

  <?php }  ?>  
    
     <?php if(isset($_REQUEST['req_po'])&&($_REQUEST['req_po'] !="")){  ?>
    
    <a class="inv-submit-btn " href="history.php?set=clear_all_po">Back</a>

  <?php }  ?> 
   
    
<input id="submit_req" type="text" readonly class="inv-submit-btn " value="Submit" style="margin-left:auto;cursor: pointer;border-bottom: none"  onclick="submit_req();" >





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
           }
           else if($('#weight').is(':focus')){
               
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
         
         
           }else if($('#supplier').is(':focus')) { 
               
                $('#supplier').css('border-bottom','3px solid blue');
              
           }else{
                $('#store').css('border-bottom','none');
                 $('#supplier').css('border-bottom','none');
           }
    
    }
});



          var datastring = "set=product_purchase_load"
          
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
                      $('#rps_count').text(sl); 
                   $('#hidden_checker').val(sl);
                   
                    var product=record.tp_name;
                    var  qty=record.tp_qty;
                    
                    if(record.tp_brand=='null' || record.tp_brand=='' || record.tp_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tp_brand;
                    }
                    
                    
                    if(record.tp_barcode=='null' || record.tp_barcode=='' || record.tp_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tp_barcode;
                    }
                    
                     if(record.tp_weight=='null' || record.tp_weight=='' || record.tp_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tp_weight;
                    } 
                    
                     var  rate_type=record.tp_rate_type;
                     var  unit_type=record.tp_unittype;
                         
                 if(unit_type=='Nos' || unit_type=='Single' ){ 
                        if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                        }
                       var chk_qty='';
                         }else{
                                if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                                }
                               chk_weight='';
                         }   
                         
                          if(rate_type=='Packet' &&  weight>0  && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                                         
                                         // var chk_weight = 'readonly' ;
                                        
                                        }
                 
                         
              if($('.append_div_main').find('#del_card' + record.tp_id).length === 0) {
                  
              $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tp_id+"' >"+
 "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display: none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tp_id+"' value='" + product + "' readonly type='text' style='width: 12%;'>  "+
   
  
   
   " <input id='barcode"+record.tp_id+"' value='" + barcode + "' readonly  type='text' style='width: 12%;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tp_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tp_id+"' readonly type='text' style='width: 12%;'>"+
    
   " <input value='" + unit_type + "' style='width: 10rem;'    id='unit_type"+record.tp_id+"' readonly type='text'>"+
   
    " <input value='" + weight + "'  "+chk_weight +"   onkeypress='return numdot(this,event);'   style='width: 10rem;' id='weight"+record.tp_id+"'  type='text'>"+
    
    " <input value='" + qty + "'  "+chk_qty +"  onkeypress='return numdot1(event);'  style='width: 10rem;' id='qty"+record.tp_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_por_qty("+record.tp_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' onclick='delete_req("+record.tp_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
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
           var qty        =  parseInt($('#qty').val()); 
           var brand    =  $('#brand').val(); 
           
           var rate_type    =  $('#rate_type').val(); 
            var unit_type    =  $('#unit_type').val(); 
            
            
            var edit_id=$('#edit_id').val();
            
             var weight= parseFloat($("#weight").val());
          
          
           var datastring2 = "set=check_product_por&product="+product_id;
         
          $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
          if($.trim(data)=='yes'){
          
          
           var datastring = "set=add_product_purchase&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type+"&edit_id="+edit_id;
        
            if(product!='' && qty > '0' && weight >'0' ){
                  
                  
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
                      
                      
                  $('#store').val(''); 
                 $('#supplier').val(''); 
            
                     var s=1;
                     $.each(a, function(i, record) {
                        
                        $("#second_div_main"+record.tp_id).empty() ;
                         $("#second_div_main"+record.tp_id).hide() ;
                        
                         
                     var sl=s++;
                      $('#rps_count').text(sl);
                   $('#hidden_checker').val(sl);
                   
                    var product=record.tp_name;
                    var  qty=record.tp_qty;
                    
                    if(record.tp_brand=='null' || record.tp_brand=='' || record.tp_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tp_brand;
                    }
                    
                    
                    if(record.tp_barcode=='null' || record.tp_barcode=='' || record.tp_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tp_barcode;
                    }
                    
                    if(record.tp_weight=='null' || record.tp_weight=='' || record.tp_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tp_weight;
                    } 
                    
                     var  rate_type=record.tp_rate_type;
                     var  unit_type=record.tp_unittype;
                         
                         if(unit_type=='Nos' || unit_type=='Single' ){ 
                                if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                       var chk_qty='';
                                }
                         }else{
                                if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                                }
                               chk_weight='';
                         }   
                        
                          if(rate_type=='Packet' &&  weight>0  && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                                         
                                         // var chk_weight = 'readonly' ;
                                        
                                        }
                 
                 
        if($('.append_div_main').find('#del_card' + record.tp_id).length === 0) {
              $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tp_id+"' >"+
  "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display: none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tp_id+"' value='" + product + "' readonly type='text' style='width: 12%;'>  "+
   
   " <input id='barcode"+record.tp_id+"' value='" + barcode + "' readonly  type='text' style='width: 12%;'>"+
   
    "<input value='" + rate_type + "' style='width: 12rem;' readonly id='rate_type"+record.tp_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tp_id+"' readonly type='text' style='width: 12%;'>"+
    
   " <input value='" + unit_type + "' style='width: 10rem;' id='unit_type"+record.tp_id+"' readonly type='text'>"+
   
   " <input value='" + weight + "'   "+chk_weight +"  onkeypress='return numdot(this,event);'   style='width: 10rem;' id='weight"+record.tp_id+"'  type='text'>"+
    
    " <input value='" + qty + "'    "+chk_qty +"  onkeypress='return numdot1(event);'   style='width: 10rem;' id='qty"+record.tp_id+"'  type='text'> <a title='Qty Update Button' style='margin-left:-45px' onclick='edit_por_qty("+record.tp_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' id='del_card"+record.tp_id+"' name='del_card"+record.tp_id+"' onclick='delete_req("+record.tp_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
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
       
    
       
       
        if(qty=='' || qty=='0' ||  $.isNumeric(qty)==false){
       $('#load_error').text('ENTER QTY');
        $("#qty").focus();
        }
        
          if(weight=='' || weight=='0' ||  $.isNumeric(weight)==false){
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
                            source: "load_inventory.php?set=search_product_inventory",
                            focus: function (event, ui) {
                                $("#product").val(ui.item.label);
                               
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    $("#brand").focus(); 
                                $("#product").val(ui.item.label);
                                
                                //$('#product').blur();
                               
				 $('#qty').val('1');	
                                  $('#weight').val('1.000');	
                                $('#rate_type').val(ui.item.rate_type);
                                $('#unit_type').val(ui.item.base_unit);
                                $('#barcode').val(ui.item.barcode);

                                $('#product').attr('menuid',ui.item.menuid);  
                                  if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                       if(ui.item.rate_type!='Packet'){
                                        $('#weight').attr('readonly', true);
                                          }
                                        $('#qty').attr('readonly', false);
                                       
                                      if(ui.item.rate_type=='Packet' &&  ui.item.weight>0  && ui.item.base_unit=='Nos'){
                                        
                                           $('#weight').attr('readonly', true);
                                          $('#weight').val(ui.item.weight);
                                        }  
                                       
                                }else{
                                    
                                    
                                     $('#qty').attr('readonly', true);
                                          $('#weight').attr('readonly', false);
                                          
                                        if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                          $('#qty').attr('readonly', false);
                                        }
                                        
                                        
                                         if(ui.item.rate_type=='Packet' &&  ui.item.weight>0  && (ui.item.base_unit=='Nos' || ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                        
                                           $('#weight').attr('readonly', true);
                                          $('#weight').val(ui.item.weight);
                                        }
                                        
                                }
                                
                                localStorage.name_length= $("#product").val().length;
                                return false;
                                
                            }

                        });
                        
                        
      
       $("#barcode").autocomplete({
                            minLength: 1,
                            source: "load_inventory.php?set=search_barcode_inventory",
                            focus: function (event, ui) {
                                $("#barcode").val(ui.item.barcode);
                                $("#valueofsearch_menu").val(ui.item.menuid);
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                              },
                         
                                select: function (event, ui) {
                                     $("#brand").focus();
				$("#product").val(ui.item.label);
                                
                                 $('#qty').val('1');
                                $("#valueofsearch_menu").val('');
                              $('#weight').val('1.000');	
				  if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                      
                                        if(ui.item.rate_type!='Packet'){
                                        $('#weight').attr('readonly', true);
                                          }
                                        $('#qty').attr('readonly', false);
                                       if(ui.item.rate_type=='Packet' &&  ui.item.weight>0  && ui.item.base_unit=='Nos'){
                                        
                                           $('#weight').attr('readonly', true);
                                          $('#weight').val(ui.item.weight);
                                        }  
                                }else{
                                    
                                      $('#qty').attr('readonly', true);
                                          $('#weight').attr('readonly', false);
                                          
                                        if(ui.item.rate_type=='Packet' && (ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                          $('#qty').attr('readonly', false);
                                        }
                                        
                                         if(ui.item.rate_type=='Packet' &&  ui.item.weight>0  && (ui.item.base_unit=='Nos' ||  ui.item.base_unit=='KG' || ui.item.base_unit=='LTR')){
                                         
                                           $('#weight').attr('readonly', true);
                                          $('#weight').val(ui.item.weight);
                                        }
                                        
                                }
                                	
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
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
          
          localStorage.name_length='0';
          localStorage.barcode_length='0';
        }
      
 }

function numdot1(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
          
        }

function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
      var id= $('#confirm_pop_all').attr('edit_id'); 
      
      
      var qty=  parseFloat($('#qty'+id).val());
           
            var weight=  parseFloat($('#weight'+id).val());
            
             if(qty>'0' && weight>'0' ){
          var data="set=update_por_qty&id="+id+"&qty="+qty+"&weight="+weight;
            
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
        
         if(qty=='' || qty=='0'){
       $('#load_error').text('ENTER VALID QTY');
       $('#qty'+id).focus();
         }
         
         
         if(weight=='' || weight=='0'){
       $('#load_error').text('ENTER VALID WEIGHT');
        $('#weight'+id).focus();
         }
      
        $('#load_error').delay(1000).fadeOut('slow');
          
            }
    
            
      
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
         
        var req_add_id=$('#req_add_id').val();
            
            
        var data="set=delete_purchase&id="+id+"&req_add_id="+req_add_id;
         
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
          setTimeout(function () {
              
        if(req_add_id!=''){
                
        if($.trim(data)=='yes'){
                   
           location.reload(); 
           
           
       }else{
           
           window.location.href='history.php';
       }
           
        }else{
       
           location.reload(); 
           
        }
           
         }, 500);     
           
           
        }
    });
            
        
        
        
  }
  
  
  function submit_req(){
      
         if( $('#hidden_checker').val()>0){  
        
         var store    =  $('#store').val(); 
            var supplier    =  $('#supplier').val(); 
            
             var edit_id =  $('#edit_id').val();
             
             
       var data="set=add_purchase_all&store="+store+"&supplier="+supplier+"&edit_id="+edit_id;
           
          if(store!='' && supplier!=''){ 
              
               $('#submit_req').hide();
              
              
              $('#load_error').show();
         $('#load_error').css('color','green');
       $('#load_error').text('PURCHASE ORDER SUCCESSFULL');
      
        $('#load_error').delay(3000).fadeOut('slow');
           
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
           setInterval(function () {
           
         
           
           if(edit_id!=''){
               var search_id=$('#id_flt').val();
     
     var status=$('#status_flt').val();
     
     var from=$('#from_flt').val();
     
     var to=$('#to_flt').val();
     
      var type=$('#type_flt').val();
              
           window.location.href="history.php?from="+from+"&to="+to+"&type="+type+"&status="+status+"&search_id="+search_id+"&filter=ok";
          }else{
              window.location.href='purchase_order.php';  
           }
          
           }, 500); 
           
           
        }
    });
    
        }else{
            
           $('#load_error').show();
           
           if(supplier==''){
       $('#load_error').text('SELECT SUUPLIER ');
        $('#supplier').focus();
         }
   
   
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

    </body>

</html>