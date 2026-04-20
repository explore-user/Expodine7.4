<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

      $localIP = getHostByName(getHostName()); 

      $trn_store_from=''; $trn_store_to='';
      $sql_login  =  $database->mysqlQuery("select tt_from_store,tt_to_store from tbl_store_transfer where tt_set='N' and tt_ip='$localIP' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
      if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	 { 
            
           $trn_store_from=$result_login['tt_from_store'];
           $trn_store_to=$result_login['tt_to_store'];
        }
        }
  
        
    $indent_status='N';                 
    if(isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') {               
                                        
       $sql_kotlist1p  =  $database->mysqlQuery("SELECT  tip_req_id from tbl_indent_partial where  tip_req_id = '".$_REQUEST['indent_id']."' and tip_done='N' "); 
       $num_kotlist1p  = $database->mysqlNumRows($sql_kotlist1p);
		if($num_kotlist1p){
                                            
                   $indent_status='Y';
                 
                 }else{
                                            
                  $indent_status='N';
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

        <title>Transfer </title>

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
        
        <input type="hidden" value="<?=$indent_status?>" id="indent_doing">
        
        
        
        <input type="hidden" id="indent_store" value="<?= $_REQUEST['indent_store']?>">
        
        <?php if( isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') { ?>
         <input type="hidden" id="indent_id" value="<?= $_REQUEST['indent_id']?>">  
        <?php }else{ ?>
         <input type="hidden" id="indent_id" value="">  
        <?php } ?>
         
        
         
          <?php if( isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='') { ?>
         <input type="hidden" id="direct_id" value="<?= $_REQUEST['direct_id']?>">  
        <?php }else{ ?>
         <input type="hidden" id="direct_id" value="">  
           <?php } ?>
         
        
        
         <input type="hidden" id="store_direct" value="<?=$_REQUEST['store_direct']?>">  
        
        <input type="hidden" id="hidden_checker">
        <input type="hidden" id="hidden_checker1" value="1">
       <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />  
        
        <input type="hidden"  value=""  id="edit_id" >
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            
            <div <?php if( (isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!='') || (isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='') || (isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') ){ $bb='disablegenerate';?> class="disablegenerate" <?php } ?> >
            <?php include( 'includes/header.php') ?>
            
            </div>

            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head">
            <div class="" >
                
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important; "  class="inv-req-btn1" href="#">STORE TRANSFER</a>
               
                
                <a class="inv-pro-btn1 <?=$bb?>"  href="transfer_history.php">TRH</a>
               
                <?php  if(isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!=''){ ?>
                
                &nbsp; &nbsp; &nbsp;
                <a class="" style="font-size: 10px;font-weight: bold;color: black;border: solid 1px ;padding: 3px;border-radius: 4px "  href="#">DIRECT TRANSFER</a>
                
                <?php } ?>
                
                
                 <?php  if(isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!=''){ ?>
                
                &nbsp; &nbsp; &nbsp;
                <a class="" style="font-size: 8px;font-weight: bold;color: black;border: solid 1px ;padding: 3px;border-radius: 4px "  href="#">INDENT TRANSFER &nbsp; | &nbsp; <?=$_REQUEST['indent_id']?> </a>
                
               
                
                <?php } ?>
                
                
                <!-- <a style="float:right;margin-right:-424px;margin-top: -8px;font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff); "  class="inv-req-btn1" href="transfer_history.php"> TRANSFER HISTORY</a> -->

                
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


                        
 <div class="req-form-head" style="margin-top: 0px ">
<h6 style="width: 10rem;">Product</h6>

<h6 style="width: 8rem;">Barcode</h6>
<h6 style="width: 8rem;">Qty Type</h6>
<h6 style="width: 8rem;">Brand</h6>
<h6 style="width: 8rem;">Unit</h6>

<?php if( (isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!='') || (isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='') || (isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') ){ ?>

<?php }else{ ?>
<h6 style="width: 8rem;">Batch</h6>


<?php } ?>

<h6 id="bt_stock_hd" style="width: 6rem;display: none">Bt Stock</h6>

<h6 style="width: 8rem;">Rate</h6>

<h6 style="width: 10rem;">Weight</h6>
<h6 style="width: 7rem;">Qty</h6>
<h6 style="width: 7rem;">Stock </h6>

<h6 style="width: 7rem;display: none">Reorder</h6>
 
<?php if( isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') { ?>
   
   <h6 style="width: 7rem;">Balance Qty/Wgt</h6>
   <h6 style="width: 7rem;">Transfer Qty/Wgt</h6>
<?php } ?>
   


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
    
    
 <?php if( (isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!='') || (isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='') || (isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') ){ ?>

<?php }else{ ?>
   <div id="load_in_batch" >
     
     <input style="width: 8rem;"  readonly placeholder="Select Batch" type="text">
   
     </div>

<?php } ?>
     
    <input style="width: 6rem;display:none" id="batch_stock" value="0" readonly placeholder="Batch Stock" type="hidden"> 
    
    <input style="width: 8rem;" id="unit_rate" readonly placeholder="Rate" type="text">
    
    <input style="width: 10rem;" id="weight" onkeyup="valid_weight_qty();" onkeypress="return numdot(this,event);"  placeholder="WEIGHT" type="text">
    
     <input style="width: 7rem;"  id="qty" onkeyup="valid_weight_qty();"  onkeypress="return numdot(this,event);"  placeholder="QTY" type="text">
     
     <input style="width: 7rem;" readonly  id="current_stock" onkeypress="return numdot(this,event);"  placeholder="STOCK " type="text">
     
     <input style="width: 7rem;display: none" readonly id="reorder" onkeypress="return numdot(this,event);"  placeholder="REORDER" type="text">
     
     <?php if( isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') { ?>
    
      <input style="width: 7rem;" readonly placeholder="Balance" value="0" type="text">
     <input style="width: 7rem;" readonly placeholder="Partial" value="0" type="text">
     
      <?php } ?>
     
      <?php if( (isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='')  || (isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') ) { ?>
   
     <a style="width: 3rem;" ></a>
     
      <?php }else{ ?>
     
     <a id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
       <?php } ?>
     
</div>
</div>
</div>
<div class="inv-req-Submit" style="margin-top:auto;">
    
Items : <span id="rps_count">0</span>
    
<span id="from_div">
<select  onchange="store_from()"  id="from_store"  style=" border-radius:6px;width: 100px;background-color:darkred;color:white; <?php if($trn_store_from!=''){?> pointer-events: none;width:100px; <?php } ?>  " >
    <option value="">From Store</option>
  <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
              
    <option <?php if( $trn_store_from==$result_fnctvenue['ti_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>
</span>


 <span id="to_div" style="">
<select onchange="store_to()"  onclick="check_direct_prd();"   id="to_store" style="border-radius:6px; width: 100px;background-color:darkred;color:white; <?php if($trn_store_to!=''){?> pointer-events: none;width:100px; <?php } ?>  " >
    <option value="">To Store</option>
  <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option <?php if($trn_store_to==$result_fnctvenue['ti_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>
  </span>



<p style="margin-bottom:0rem;display: block" ><?php if(isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!=''){ ?>  Req Id : <?=$_REQUEST['req_id']?>  <?php } ?><span style="color:darkred;"></span></p>
<a class="inv-submit-btn " style="display:none; margin-left:auto;" href="">Print</a>
<a class="inv-submit-btn "  style="display:none;" href="">Back</a>




  <?php if( (isset($_REQUEST['direct_id']) && $_REQUEST['direct_id']!='')  ) { ?>
   
 <input type="text" readonly class="inv-submit-btn " value="BACK" style="margin-left:auto;cursor: pointer;border-bottom: none;" onclick="direct_go()">

  <?php } ?>
 
 <?php if( (isset($_REQUEST['indent_id']) && $_REQUEST['indent_id']!='') ) { ?>
   
 <input type="text" readonly class="inv-submit-btn " value="BACK" style="margin-left:auto;cursor: pointer;border-bottom: none;" onclick="direct_go()">

<?php } ?>

<input  id="submit_req" type="text" readonly class="inv-submit-btn " value="Submit" style="cursor: pointer;border-bottom: none; margin-left:auto;"  onclick="submit_req();" >

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
        
          var indent_id1=$('#indent_id').val();
          
          var direct_id1=$('#direct_id').val();
        if(direct_id1!='' || indent_id1){
        
         $('.store_first_pop').hide(); 
         $('#from_store_first').val(''); 
         $('#to_store_first').val(''); 
        }
        
        
        
         //////////////Indent load  transfer///////////////////// 
         
         var indent_id=$('#indent_id').val();
         
         var indent_store=$('#indent_store').val();
        
         if(indent_id!='' && indent_id!='undefined' && indent_id!=' '){
             
             
                var datastring = "set=product_transfer_load_indent&id="+indent_id
          
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
                   
                    var product=record.tr_name; 
                    var  qty=record.tr_qty;
                    
                    if(record.tr_brand=='null' || record.tr_brand=='' || record.tr_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tr_brand;
                    }
                    
                    
                    if(record.tr_barcode=='null' || record.tr_barcode=='' || record.tr_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tr_barcode;
                    }
                    
                    if(record.tr_weight=='null' || record.tr_weight=='' || record.tr_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tr_weight;
                    } 
                    
                     var  rate_type=record.tr_rate_type;
                     var  unit_type=record.tr_unittype;
                    
                       if(unit_type=='Nos' || unit_type=='Single' ){ 
                            if(rate_type!='Packet'){
                       var chk_weight = 'readonly' ;
                       
                            }
                            
                       var chk_weight = 'readonly' ;
                       
                       var chk_qty='';
                       var stock_d=qty;
                       
                         }else{
                             
                        if(rate_type!='Packet'){
                            
                             chk_qty=  'readonly' ;
                        }
                              
                        chk_weight='';
                        var stock_d=weight;  
                        if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                          chk_weight='readonly';
                          var stock_d=qty; 
                        }
                                        
                                        
                                        
                       } 
                         
                         
                     $('#from_store').prop('disabled',true);
               
                     $('#from_store').val(indent_store);
                     
                      var  to_store=record.tr_store;
                      $('#to_store').prop('disabled',true);
                      $('#to_store').val(to_store);
                      
                var datastring = "set=transfer_indent_product&prd_id="+record.tr_product+"&store="+indent_store+"&indent_id="+indent_id;
          
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                    
                    
                     
                     var dt=$.trim(data).split('*');
                     
                     
                     var now_wty_wgt=dt[3];
                     
                     var  reorder=dt[0];
                     var  current_stock=dt[1];
                   
                     var  rate=dt[2];
                     
                     if(dt[3]!=''){
                        var partial_wgt_qty=dt[3];
                     }else{
                        var partial_wgt_qty=0;      
                     }
                     
                     
                     if(dt[4]!=''){
                        var partial_wgt_qty_old=dt[4];
                     }else{
                       var partial_wgt_qty_old=0;
                     }
                     
                  
                     if(parseFloat(stock_d)>parseFloat(current_stock)){
                   
                      $('#hidden_checker1').val('0');
                      
                    }
                 
              var  qty1=qty;    
               
              var weight1=weight;
                     
              var balancep=0;
              
              if(partial_wgt_qty_old>0 || partial_wgt_qty>0){
                  
                  if(unit_type=='Single' || unit_type=='Nos' ){
                                     
                     var balancep=qty-(parseFloat(partial_wgt_qty_old)+parseFloat(partial_wgt_qty));
                      var qty1=parseFloat(partial_wgt_qty);  
                      
                      if(qty1<=0){
                          var qty1= balancep; 
                      }
                      
                  }else{
                                     
                                     
                 if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){ 
                    
                       var balancep=qty-(parseFloat(partial_wgt_qty_old)+parseFloat(partial_wgt_qty));
                       var qty1=parseFloat(partial_wgt_qty);    
                       
                       
                        if(qty1<=0){
                          var qty1= balancep; 
                        }
                       
                 }else{
                     
                     var balancep=weight-(parseFloat(partial_wgt_qty_old)+parseFloat(partial_wgt_qty));   
                       
                       
                     var weight1=parseFloat(partial_wgt_qty);     
                     
                      if(weight1<=0){
                          var weight1= balancep; 
                      }
                                      
                 }
                  
                 }  
              }     
              
           
               if(partial_wgt_qty==0){
                   
                  if(current_stock>0){  
                      
                   
                    if(unit_type=='Single' || unit_type=='Nos' ){
                                     
                     partial_wgt_qty=qty1;
                    
                  }else{
                                     
                                     
                 if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){ 
                    
                       partial_wgt_qty=qty1; 
                       
                 }else{
                     
                     partial_wgt_qty=weight1;        
                 }
                  
                 }
             } 
               }
               
                if(now_wty_wgt>0){
                    
                    var str="style='margin-left:-45px;display:none'";
                    var str1="readonly";
                }else{
                    var   str="style='margin-left:-45px;display:none'"; 
                    var str1="";
                }
               
               
               
                var no_stk='';
                if(current_stock<=0){
                    
                 if(unit_type=='Single' || unit_type=='Nos' ){
                                     
                     qty1=0;
                     weight1=1; 
                     
                     var bl_to=(qty-partial_wgt_qty_old);
                     
                  }else{
                                     
                   if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){ 
                    
                          qty1=0;
                          weight1=1; 
                          var bl_to=(qty-partial_wgt_qty_old);
                 }else{
                        qty1=1;
                        weight1=0; 
                        var bl_to=(weight-partial_wgt_qty_old);
                 }
                 }  
                     var str="style='margin-left:-45px;display:none'";
                     var str1="readonly";
                     partial_wgt_qty=0;
                     var no_stk=bl_to+' Pending';
                     
                }
                
                
    if(parseFloat(current_stock)< parseFloat(partial_wgt_qty)){
                     
                     if(unit_type=='Single' || unit_type=='Nos' ){
                         
                     var bl_to=(qty-partial_wgt_qty_old);        
                     qty1=current_stock;
                     weight1=1; 
                     
                  }else{
                                     
                 if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){ 
                     
                       var bl_to=(qty-partial_wgt_qty_old);
                       qty1=current_stock;
                       weight1=1; 
                       
                 }else{
                     
                      qty1=1;
                      weight1=current_stock; 
                      var bl_to=(weight-partial_wgt_qty_old);
                 }
                 }  
                     var str="style='margin-left:-45px;display:none'";
                     //var str1="readonly";
                     partial_wgt_qty=current_stock;
                     var no_stk=bl_to+' Pending';
                     
                }
                 
    if($('.append_div_main').find('#del_card'+record.tr_id).length === 0) {
                  
    $(".append_div_main").append(" <div class='add_menu_row indent_row' id_dr='" + record.tr_id + "'  id='second_div_main"+record.tr_id+"' >"+
    "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tr_id+"' menuid='" + record.tr_product + "' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tr_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tr_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tr_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tr_id+"' readonly type='text'>"+
   
    "<input value='" + rate + "'  id='unit_rate"+record.tr_id+"' readonly type='text' style='width: 8rem;'>"+
   
    " <input wgt_p='" + weight1 + "' class='tot_weight' value='" + weight1 + "'  "+chk_weight +" readonly  onkeyup='valid_weight_qty1("+record.tr_id+");' onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tr_id+"'  type='text'>"+
    
    " <input qty_p='" + qty1 + "' class='tot_qty' value='" + qty1 + "' "+chk_qty +"  readonly    onkeyup='valid_weight_qty1("+record.tr_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tr_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "'  readonly style='width: 7rem;color:red;font-weight:bold' id='current_stock"+record.tr_id+"'  type='text'>"+
    
     " <input value='" + reorder + "' readonly  style='width: 7rem;display:none'  id='reorder"+record.tr_id+"'  type='text'>"+
     
     " <input value='"+balancep+"' class='tot_bal_indent'  readonly  style='width: 7rem;' id='balancep"+record.tr_id+"'  type='text'>"+ 
     
     " <input value='"+partial_wgt_qty+"' "+str1+" class='bal_indent' indent_new='"+indent_id+"' product_indent='"+record.tr_product+"'  onkeyup='valid_partial("+record.tr_id+");'   style='width: 7rem;margin-right:10px' id='partial"+record.tr_id+"'  type='text'>"+
      
    
     " <a title='Qty-Wgt Update Button' " +str +" onclick='edit_partial_qty(" +record.tr_id +")'  >"+
     "  <i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer;margin-left:15px'></i></a>"+
    
        
     " <a  style='width: 3rem;font-size:9px;color:red;'>" +no_stk +"</a>"+
    
    "</div>"+
    "</div>"
    );
    
    } 
                         
    }   });
                         
    });
                     
                     
    }   });
             
             
             
    }
        
        
  ///////////////////////////Direct load Transfer///////////////////////////////////
        
        var direct_id=$('#direct_id').val();
        
        var store_direct=$('#store_direct').val();
        
        if(direct_id!='' && direct_id!='undefined' && direct_id!=' '){
            
            
           var datastring = "set=product_transfer_load_direct&id="+direct_id
          
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
                   
                    var product=record.tg_name; 
                    var  qty=record.tg_qty;
                    
                    if(record.tg_brand=='null' || record.tg_brand=='' || record.tg_brand==null ){
                       var  brand= '';
                    }else{
                      brand=record.tg_brand;
                    }
                    
                    
                    if(record.tg_barcode=='null' || record.tg_barcode=='' || record.tg_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tg_barcode;
                    }
                    
                    if(record.tg_weight=='null' || record.tg_weight=='' || record.tg_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tg_weight;
                    } 
                    
                     var  rate_type=record.tg_rate_type;
                     var  unit_type=record.tg_unittype;
                    
                    
                       if(unit_type=='Nos' || unit_type=='Single' ){ 
                           
                            if(rate_type!='Packet'){
                              var chk_weight = 'readonly' ;
                       
                            }
                            
                            
                        var chk_weight = 'readonly' ;
                        var chk_qty='';
                        var stock_d=qty;
                         }else{
                             
                         if(rate_type!='Packet'){
                             chk_qty=  'readonly' ;
                         }
                             
                         chk_weight='';
                         var stock_d=weight;  
                         if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                           chk_weight='readonly';
                           var stock_d=qty; 
                         }
                                         
                         }   
                         
                     $('#from_store').prop('disabled',true);
                  
                     $('#from_store').val(store_direct);
                     
                     
                     var  rate=record.tg_unit_rate;
                   
                 var datastring = "set=transfer_direct_product&prd_id="+record.tg_product+"&store="+store_direct;
          
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                     var dt=$.trim(data).split('*');
                    
                  
                     var  reorder=dt[0];
                     var  current_stock=dt[1];
                   
                      //var  rate=dt[2];
                   
                     if(parseFloat(stock_d)>parseFloat(current_stock)){
                   
                      $('#hidden_checker1').val('0');
                      
                    }
                     
    if($('.append_div_main').find('#del_card'+record.tg_id).length === 0) {
                  
    $(".append_div_main").append(" <div class='add_menu_row direct_row' id_dr='" + record.tg_id + "'  id='second_div_main"+record.tg_id+"' >"+
            
    "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tg_id+"' menuid='" + record.tg_product + "' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tg_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tg_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tg_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tg_id+"' readonly type='text'>"+
   
    "<input value='" + rate + "'  id='unit_rate"+record.tg_id+"' readonly type='text' style='width: 8rem;'>"+
   
    " <input value='" + weight + "'  "+chk_weight +" readonly  onkeyup='valid_weight_qty1("+record.tg_id+");' onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tg_id+"'  type='text'>"+
    
    " <input value='" + qty + "' "+chk_qty +"  readonly    onkeyup='valid_weight_qty1("+record.tg_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tg_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;' id='current_stock"+record.tg_id+"'  type='text'>"+
    
     " <input value='" + reorder + "' readonly  style='width: 7rem;display:none' id='reorder"+record.tg_id+"'  type='text'>"+
    
     " <a  style='width: 3rem;'></a>"+
    
    "</div>"+
    "</div>"
    );
                                 
    } 
                         
    } });
                         
    });
                     
                     
    }   });
            
   }
        
        
    
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

  //////////normal transfer load//////

        var datastring = "set=product_transfer_load"
          
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
                     $("#batch_id").val('');
                    
                     var s=1;
                     $.each(a, function(i, record) {
                        
                     var sl=s++;
                     
                     $('#hidden_checker').val(sl);
                     $('#rps_count').text(sl); 
                   
                    var product=record.tt_name;
                    var  qty=record.tt_qty;
                    
                    if(record.tt_brand=='null' || record.tt_brand=='' || record.tt_brand==null ){
                         var  brand= '';
                    }else{
                      brand=record.tt_brand;
                    }
                    
                    
                    if(record.tt_barcode=='null' || record.tt_barcode=='' || record.tt_barcode==null){
                         var  barcode= '';
                    }else{
                      barcode=record.tt_barcode;
                    }
                    
                    if(record.tt_weight=='null' || record.tt_weight=='' || record.tt_weight==null){
                         var  weight= '';
                    }else{
                      weight=record.tt_weight;
                    } 
                    
                    
                      if(record.tt_batch_id=='null' || record.tt_batch_id=='' || record.tt_batch_id==null){
                           var  batch_id= '';
                    }else{
                            batch_id=record.tt_batch_id;
                    } 
                    
                  
                    
                     var  rate_type=record.tt_rate_type;
                     var  unit_type=record.tt_unit_type;
                    
                     var  reorder=record.tt_reorder;
                     var  current_stock=record.tt_current_stock;
                     
                     var  rate=record.tt_rate;
                      
                     //var  batch_id=record.tt_batch_id;
                      
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
                         
                      
              if(batch_id!='null' && batch_id!='' &&  batch_id!=null && batch_id!=undefined && batch_id!='undefined'){
                  
               var styl="style='margin-left:-45px;padding-left: 3px;display:none'";
               
               var   styl1='readonly';
              }else{
                 var styl="style='margin-left:-45px;padding-left: 3px'";  
                  var   styl1='';
              }
                         
                         
     $('#from_store').prop('disabled',true);
     $('#to_store').prop('disabled',true);
                 
     if($('.append_div_main').find('#del_card'+record.tt_id).length === 0) {
                  
     $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tt_id+"' >"+
     "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
    "<input   id='product"+record.tt_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tt_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tt_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tt_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tt_id+"' readonly type='text'>"+
   
   " <input value='" + batch_id + "' style='width: 8rem;' id='batch_id"+record.tt_id+"' readonly type='text'>"+
   
    "<input value='" + rate + "'  id='unit_rate"+record.tt_id+"' readonly type='text' style='width: 8rem;'>"+
   
    " <input value='" + weight + "'  "+chk_weight +" "+styl1 +" onkeyup='valid_weight_qty1("+record.tt_id+");' onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tt_id+"'  type='text'>"+
    
    " <input value='" + qty + "' "+chk_qty +"   "+styl1 +"   onkeyup='valid_weight_qty1("+record.tt_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tt_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;' id='current_stock"+record.tt_id+"'  type='text'>"+
    
     " <input value='" + reorder + "' readonly  style='width: 7rem;display:none' id='reorder"+record.tt_id+"'  type='text'><a title='Qty Update Button' "+styl +"  onclick='edit_req_qty("+record.tt_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    " <a class='inv-req-btn' id='del_card"+record.tt_id+"' name='del_card"+record.tt_id+"' onclick='delete_req("+record.tt_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
    
     );
                                 
     } 
                         

                         
    });
                     
                     
    } });
                   
            
    
   $("#plusbtn").click(function()
    {    
          
           var product   =  $('#product').val();
           var product_id   =  $('#product').attr('menuid');
           var barcode  =  $('#barcode').val();
           var qty      =  $('#qty').val(); 
           var brand    =  $('#brand').val(); 
           
           var rate_type  =  $('#rate_type').val();
           
           var unit_type  =  $('#unit_type').val();
            
           var edit_id =  $('#edit_id').val();
            
           var weight=  $("#weight").val();
         
           var from_store=$('#from_store').val();
           
           var to_store=$('#to_store').val();
          
           var current_stock= $("#current_stock").val();
         
            var reorder=  $("#reorder").val();
            
            var rate=  $("#unit_rate").val();
           
            var batch_id = $("#unit_rate").attr('batch_new');
             
             
             if(batch_id=='undefined' || batch_id==undefined){
                 
                 batch_id='';
             }
             
             
            var bal_batch_stock=$('#batch_stock').val();
            
                 var datastring2 = "set=check_product_transfer&product="+product_id;
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
            if($.trim(data)=='yes' || batch_id!=''){
        
        
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
        
        
        if(product!='' && qty > '0' && weight >'0' && from_store!='' && to_store!='' && (from_store != to_store) ){
              
                  var datastring = "set=add_product_transfer&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type+"&edit_id="+edit_id+
                   "&current_stock="+current_stock+"&reorder="+reorder+"&from_store="+from_store+"&to_store="+to_store+"&rate="+rate
                   +"&indent_id=&direct_id=&batch_id="+batch_id+"&bal_batch_stock="+bal_batch_stock;
         
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
                     $("#batch_id").val('');  
                     $("#batch_id1").val('');  
                         
                    var s=1;
                    $.each(a, function(i, record) {
                       
                    $("#second_div_main"+record.tt_id).empty() ;
                    $("#second_div_main"+record.tt_id).hide() ;
                       
                    var sl=s++;
                    $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                   	
                    var product=record.tt_name;
                    
                    var  qty=record.tt_qty;
                    
                    if(record.tt_brand=='null' || record.tt_brand=='' || record.tt_brand==null ){
                           var  brand= '';
                    }else{
                           brand=record.tt_brand;
                    }
                    
                    
                    if(record.tt_barcode=='null' || record.tt_barcode=='' || record.tt_barcode==null){
                           var  barcode= '';
                    }else{
                           barcode=record.tt_barcode;
                    }
                    
                    if(record.tt_weight=='null' || record.tt_weight=='' || record.tt_weight==null){
                           var  weight= '';
                    }else{
                            weight=record.tt_weight;
                    } 
                    
                    
                     if(record.tt_batch_id=='null' || record.tt_batch_id=='' || record.tt_batch_id==null){
                           var  batch_id= '';
                    }else{
                            batch_id=record.tt_batch_id;
                    } 
                    
                    
                    
                     // var  batch_id=record.tt_batch_id;
                    
                     var  rate_type=record.tt_rate_type;
                     var  unit_type=record.tt_unit_type;
                    
                      var  rate=record.tt_rate;
                      
                     var  reorder=record.tt_reorder;
                     var  current_stock=record.tt_current_stock;
                 
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
                   
                   
                    if(batch_id!='null' && batch_id!='' &&  batch_id!=null && batch_id!=undefined && batch_id!='undefined'){
                  
               var styl="style='margin-left:-45px;padding-left: 3px;display:none'";
               
               var   styl1='readonly';
              }else{
                 var styl="style='margin-left:-45px;padding-left: 3px'";  
                  var   styl1='';
              }
                   
                   
                 
  if($('.append_div_main').find('#del_card'+record.tt_id).length === 0) {
                  
      $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tt_id+"' >"+
              
      "<div class='inv-req-form'>"+
      
      "<span class='inv-req-sl' style='width: 3%; overflow:hidden;display:none'>"+sl+"</span>"+
    
     "<input   id='product"+record.tt_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
     " <input id='barcode"+record.tt_id+"' value='" + barcode + "' readonly  type='text' style='width: 8rem;'>"+
   
    "<input value='" + rate_type + "' style='width: 8rem;' readonly id='rate_type"+record.tt_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tt_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 8rem;' id='unit_type"+record.tt_id+"' readonly type='text'>"+
   
   
     " <input value='" + batch_id + "' style='width: 8rem;' id='batch_id"+record.tt_id+"' readonly type='text'>"+
   
    "<input value='" + rate + "'  id='unit_rate"+record.tt_id+"' readonly type='text' style='width: 8rem;'>"+
    
    " <input value='" + weight + "'  "+chk_weight +"   "+styl1 +" onkeyup='valid_weight_qty1("+record.tt_id+");'  onkeypress='return numdot(this,event);'  style='width: 10rem;' id='weight"+record.tt_id+"'  type='text'>"+
    
    " <input value='" + qty + "'    "+chk_qty +" "+styl1 +" onkeyup='valid_weight_qty1("+record.tt_id+");'  onkeypress='return numdot(this,event);'   style='width: 7rem;' id='qty"+record.tt_id+"'  type='text'> "+
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;' id='current_stock"+record.tt_id+"'  type='text'>"+
    
     " <input value='" + reorder + "' readonly  style='width: 7rem;display :none' id='reorder"+record.tt_id+"'  type='text'><a title='Qty Update Button' "+styl +" onclick='edit_req_qty("+record.tt_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
    
    " <a class='inv-req-btn' id='del_card"+record.tt_id+"' name='del_card"+record.tt_id+"' onclick='delete_req("+record.tt_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                   
                   
                    $('#from_store').prop('disabled',true);
                    $('#to_store').prop('disabled',true);
                   
                    }
                         

                         
                   });
                     
                   $("#product").focus();
                   $('#product').val('');
                      
                 }
                 
                 });
                   
      }else{
                   
         $('#load_error').show();
       
        if(to_store==from_store ){
         $('#load_error').text('FROM & TO CANT BE SAME');
         $("#to_store").focus();
        }
       
       if(to_store=='' ){
         $('#load_error').text('SELECT TO STORE');
         $("#to_store").focus();
      }
       

       if(from_store=='' ){
          $('#load_error').text('SELECT FROM STORE ');
          $("#from_store").focus();
      }
       
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
              source:  function(request, response) {
              $.getJSON( "load_inventory.php?set=search_product_inventory_store",
                         { term:request.term, from_store:$('#from_store').val() }, 
                            response
                         );
              },
              focus: function (event, ui) { 
                                $("#product").val(ui.item.label);
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                var from_store=$('#from_store').val(); 
                                var to_store=$('#to_store').val(); 
                                  
                                if(from_store !='' && to_store!=''){
                                      
                                $("#brand").val('') ; 
                                $("#brand").focus() ;
                                $("#product").val(ui.item.label);
                                
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
                                  
                                  batch_load();
                                  
                                  localStorage.name_length= $("#product").val().length;
                                  localStorage.barcode_length= $("#barcode").val().length;
                                  return false;
                             
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
                        
                        
                        
  $("#batch_id").autocomplete({
                        minLength: 1,
                        source: function(request, response) {
                        $.getJSON(
                        "load_inventory.php?set=search_batch_inventory_store",
                        { term:request.term, from_store:$('#from_store').val() }, 
                            response
                        );
                        },
                            focus: function (event, ui) {
                                
                                $("#batch_id").val(ui.item.label);
                             
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                  var from_store=$('#from_store').val(); 
                                  var to_store=$('#to_store').val(); 
                                  
        if(from_store !='' && to_store!=''){ 
                                     
         $('#unit_rate').val(ui.item.rate);
         $('#from_store').prop('disabled', true);
         $('#to_store').prop('disabled', true);
           
         return false;
          
       }else{
            
         $("#batch_id").val('');   
         $("#batch_id").focus(); 
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
                                  
                                  if(from_store !='' && to_store!=''){
                                      
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
                                  
        localStorage.barcode_length= $("#barcode").val().length;
        localStorage.name_length= $("#product").val().length;
        return false;
         
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
      
      
 function valid_partial(id){
    
      var rate_type    =  $('#rate_type'+id).val(); 
      var unit_type    =  $('#unit_type'+id).val();
    
      var weight= parseFloat($('#weight'+id).attr('wgt_p'));
        
      var qty= parseFloat($('#qty'+id).attr('qty_p'));
    
      var stock= parseFloat($('#current_stock'+id).val());
        
      // var qty= parseFloat($('#qty'+id).val());
    
      var bal =   $('#balancep'+id).val();
      
      var partial= parseFloat($('#partial'+id).val());
    
   
    if( (stock>partial) && stock>0 ) {
    
    if(isNaN(partial) || partial==0 || partial=='' || partial==' '){
       
        if(unit_type=='Nos' || unit_type=='Single'){
            
              $('#qty'+id).val(qty)  ;
              $('#balancep'+id).val(qty);
        }else{
            
          if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
              
                $('#qty'+id).val(qty)   
                $('#balancep'+id).val(qty);
                
            }else{
                
                  $('#weight'+id).val(weight)  
                  $('#balancep'+id).val(weight);
            }
      }
      
      if(isNaN(partial) || partial==0 || partial=='' || partial==' '){
           
            if(unit_type=='Nos' || unit_type=='Single'){
                
               $('#qty'+id).val(0)  ;
               $('#balancep'+id).val(qty);
      }else{
            
          if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
              
                 $('#qty'+id).val(0)   
                $('#balancep'+id).val(qty);
                
            }else{
                
                  $('#weight'+id).val(0)  
                  $('#balancep'+id).val(weight);
            }
      }
     }
      
      
        
    }else{
   
     setTimeout(function(){
        
     if(unit_type=='Nos' || unit_type=='Single'){
         
         if($('#qty'+id).val()>0 && partial<=qty){
        
         if(partial<=0){
           $('#qty'+id).val(qty);  
           $('#balancep'+id).val(0);
         }else{
           $('#qty'+id).val(partial);
           $('#balancep'+id).val(qty-partial);
         }
         
     }else{
         
         $('#partial'+id).val('0');
         $('#load_error').css('display','block');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
         $('#qty'+id).val(qty);   
         $('#balancep'+id).val(qty); 
        
         
     }
     
     }else{
             
        if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){  
           
           if($('#qty'+id).val()>0 && partial<=qty){
   
         if(partial<=0){
            $('#qty'+id).val(qty)  ;  
            $('#balancep'+id).val(0);
         }else{
           $('#qty'+id).val(partial);
           $('#balancep'+id).val(qty-partial);
         }
       }else{
           
          $('#partial'+id).val('0');
          $('#load_error').css('display','block');
          $('#load_error').text('INVALID QTY');
          $('#load_error').delay(1500).fadeOut('slow');
          $('#qty'+id).val(qty);   
          $('#balancep'+id).val(qty); 
      }
             
      }else{
           
          if($('#weight'+id).val()>0 && partial<=weight){  
           
         if(partial<=0){
           $('#weight'+id).val(weight); 
            $('#balancep'+id).val(0);
         }else{
           $('#weight'+id).val(partial);
           $('#balancep'+id).val(weight-partial);
         }
          
          }else{
              
         $('#weight'+id).val(weight);   
         $('#balancep'+id).val(weight);   
         $('#partial'+id).val('0');
         $('#load_error').css('display','block');
         $('#load_error').text('INVALID WEIGHT');
         $('#load_error').delay(1500).fadeOut('slow');
        
      }
          
          
      }
       
  }
  
  
  
  }, 500); 
    
  }
  
  
    }else{
        
         $('#partial'+id).val('');
         $('#load_error').css('display','block');
         $('#load_error').text('NO STOCK IN STORE ');
         $('#load_error').delay(1500).fadeOut('slow');
     
      if(unit_type=='Nos' || unit_type=='Single'){
          
              $('#qty'+id).val(qty)  ;
              $('#balancep'+id).val(qty);
        }else{
            
          if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
              
                $('#qty'+id).val(qty)   
                $('#balancep'+id).val(qty);
                
            }else{
                 $('#weight'+id).val(weight)  
                 $('#balancep'+id).val(weight);
           }
        }
     
    }
  
  
  
      
 }   
    
    
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
    
    
  function store_to1(){
        
      var to=$('#to_store').val();
    
      var data="set=store_load_transfer&to="+to+"&mode=to";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
           $('#from_div').html(data);
        
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
      
      
   function batch_load(){
          
        var menuid=  $('#product').attr('menuid');   
         
        var from_store=$('#from_store').val();   
         
        if(menuid!='' && menuid!='undefined' && menuid!=undefined){
           
        var data4="set=load_batch_grn&from_store="+from_store+"&menuid="+menuid;
        
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data4,
        success: function(data)
        {
            
          $('#load_in_batch').html(data);
        
        }
        });
        
        
        }else{
         $('#load_error').show();
         $('#load_error').css('color','red');
         
         $('#load_error').text('SELECT ITEM ');
                
         $('#load_error').delay(1500).fadeOut('slow'); 
         
        }
           
    }
      
      
      
      
      
     
      
     function valid_weight_qty(){
   
         var weight= parseFloat($('#weight').val());
        
         var qty= parseFloat($('#qty').val());
         
         var stock=parseFloat($('#current_stock').val());
         
         var rate_type    =  $('#rate_type').val(); 
         
         var unit_type    =  $('#unit_type').val();
         
         var bal_batch_stock=$('#batch_stock').val();
            
        if(unit_type=='Nos' || unit_type=='Single'){
         
         
         if(qty>stock){
             
         $('#qty').val('');
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVALID QTY');
         $('#load_error').delay(1500).fadeOut('slow');
             
         }
         
        
         if($('#batch_id1').val()!=''){
             
          if(qty>bal_batch_stock){
             
         $('#qty').val('');
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('BATCH STOCK IS LESS');
         $('#load_error').delay(1500).fadeOut('slow');
             
         }
         
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
         
           if($('#batch_id1').val()!=''){
          if(qty>bal_batch_stock){
             
         $('#qty').val('');
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('BATCH STOCK IS LESS');
         $('#load_error').delay(1500).fadeOut('slow');
             
         }
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
         
           if($('#batch_id1').val()!=''){
          if(weight>bal_batch_stock){
             
         $('#weight').val('');
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('BATCH STOCK IS LESS');
         $('#load_error').delay(1500).fadeOut('slow');
             
         }
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
         $('#load_error').text('SELECT FROM STORE FIRST');
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
            
             $("#batch_id").val(''); 
             $("#batch_id1").val(''); 
             $("#unit_rate").val(''); 
             
            
          localStorage.name_length='0';
          localStorage.barcode_length='0';
          
          $('#from_store').prop('disabled', false);
          $('#to_store').prop('disabled', false);
          
        }
      
 }
     
     
     
 function delete_req(id){
     
     $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('DELETED');
         $('#load_error').delay(1000).fadeOut('slow'); 
            
        var data="set=delete_transfer&id="+id;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
            $('#second_div_main'+id).remove();
          setTimeout(function () {
                            location.reload();
                            }, 500); 
        }
    });
            
      
  }
  
  function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
      var id= $('#confirm_pop_all').attr('edit_id'); 
      
      if(mode=='partial'){
      
       var qty = parseFloat($('#qty' + id).val());

                      var weight = parseFloat($('#weight' + id).val());
                    
                      var partial = parseFloat($('#partial' + id).val());
                       
                      var  indent_id=$('#partial' + id).attr('indent_new');
                      
                      var product_indent=$('#partial' + id).attr('product_indent');
                      
                      var stock= parseFloat($('#current_stock' + id).val());
                       
             if ( qty > '0' && weight > '0' && partial>'0') {
                 
               var data = "set=update_partial_qty&id=" + id + "&qty=" + qty + "&weight=" + weight+"&partial="+partial+"&indent_id="+indent_id+"&product_indent="+product_indent;

                        $.ajax({
                            type: "POST",
                            url: "load_inventory.php",
                            data: data,
                            success: function(data) {

                                location.reload();

                            }
                        });

            }else {

                        $('#load_error').show();
                        
                        if (partial == '' || partial == '0') {
                            $('#load_error').text('ENTER VALID PARTIAL QTY/WGT');
                            $('#qty' + id).focus();
                        }

                        if (qty == '' || qty == '0') {
                            $('#load_error').text('ENTER VALID QTY');
                            $('#qty' + id).focus();
                        }


                        if (weight == '' || weight == '0') {
                            $('#load_error').text('ENTER VALID WEIGHT');
                            $('#weight' + id).focus();
                        }

                        $('#load_error').delay(1000).fadeOut('slow');

            }
      
        }
        
        
       if(mode=='edit'){
           
           var qty=  $('#qty'+id).val();
           
           var weight=  $('#weight'+id).val();
           
           var unit_type=  $('#unit_type'+id).val();
           
           var rate_type=  $('#rate_type'+id).val(); 
             
        if(qty>'0' && weight>'0'){
            
          var data="set=update_transfer_qty&id="+id+"&qty="+qty+"&weight="+weight+"&unit_type="+unit_type+"&rate_type="+rate_type;
            
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
        
        
        
    }
  
  
   function edit_partial_qty(id) {


          $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM UPDATE');
        
        $('#confirm_pop_all').attr('mode','partial');
    
          $('#confirm_pop_all').attr('edit_id',id); 
         

  }

  
  function edit_req_qty(id){
      
      
        $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM UPDATE');
        
        $('#confirm_pop_all').attr('mode','edit');
    
         $('#confirm_pop_all').attr('edit_id',id); 
              
       
  }
  
  
  
  
  function submit_req(){
      
      $("#submit_req").css("pointer-events", "none"); 
      $('#submit_req').addClass('disablegenerate');
     
      if( $('#hidden_checker').val()>0){  
          
        var from_store=$('#from_store').val();
        
        var to_store=$('#to_store').val();
         
        var direct_id=$('#direct_id').val();
            
        var indent_id=$('#indent_id').val();
        
        var bal_indent=0;
        
         $('.bal_indent').each(function(){   
             
            bal_indent +=   parseFloat($(this).val());
              
            $('#indent_id').attr('bal',bal_indent); 
             
        });
          
          
          var tot_bal_indent=0;
          
           $('.tot_bal_indent').each(function(){   
             
             tot_bal_indent +=   parseFloat($(this).val());
              
             $('#indent_id').attr('tot_bal',tot_bal_indent); 
             
          });
          
          
           var tot_qty=0;
           
           $('.tot_qty').each(function(){   
             
               tot_qty +=   parseFloat($(this).val());
              
             $('#indent_id').attr('tot_qty',tot_qty); 
             
          });
          
          
          var tot_weight=0;
          
           $('.tot_weight').each(function(){   
             
             tot_weight +=   parseFloat($(this).val());
              
             $('#indent_id').attr('tot_weight',tot_weight); 
             
          });
        
        
        var indent_qty_in=$('#indent_id').attr('bal'); 
        
        var indent_bal_in_tot=$('#indent_id').attr('tot_bal'); 
         
        var indent_tot_weight=$('#indent_id').attr('tot_weight'); 
          
        var indent_tot_qty=$('#indent_id').attr('tot_qty'); 
         
        var indent_doing=$('#indent_doing').val();
     
      if(from_store!='' && to_store!='' && (to_store!=from_store) && (indent_id=='' || (indent_id!='' && indent_qty_in>0) )){ 
            
            
      if(direct_id!='' && direct_id!=' ' && direct_id!='undefined' && direct_id!='null' ){
           
                
            $('.direct_row').each(function(){   
                
             var id_dr= $(this).attr('id_dr');
             
             var product   =  $('#product'+id_dr).val();
             var product_id   =  $('#product'+id_dr).attr('menuid');
             var barcode   =  $('#barcode'+id_dr).val();
             var qty        =  $('#qty'+id_dr).val(); 
             var brand    =  $('#brand'+id_dr).val(); 
           
            var rate_type    =  $('#rate_type'+id_dr).val(); 
            var unit_type    =  $('#unit_type'+id_dr).val();
            
            var edit_id = '';
            
            var weight=  $("#weight"+id_dr).val();
         
            var from_store=$('#from_store').val();
            
            var to_store=$('#to_store').val();
          
            var current_stock= $("#current_stock"+id_dr).val();
         
            var reorder=  $("#reorder"+id_dr).val();
            
            var rate=  $("#unit_rate"+id_dr).val();
            
            var partial=  $("#partial"+id_dr).val();
                
            var datastring = "set=add_product_transfer&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type
                   +"&edit_id="+edit_id+"&current_stock="+current_stock+"&reorder="+reorder+"&from_store="+from_store
                   +"&to_store="+to_store+"&rate="+rate+"&indent_id=&partial=&indent_tot_qty=&indent_tot_weight=&direct_id="+direct_id;
    
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                  
                 }
                 });
        
        
              
        
              });
              
              
            }
           
           
      if(indent_id!='' && indent_id!=' ' && indent_id!='undefined' && indent_id!='null' ){
                
            $('.indent_row').each(function(){
                
             var id_dr= $(this).attr('id_dr');
             
             var product   =  $('#product'+id_dr).val();
             var product_id   =  $('#product'+id_dr).attr('menuid');
             var barcode   =  $('#barcode'+id_dr).val();
             var qty        =  $('#qty'+id_dr).val(); 
             var brand    =  $('#brand'+id_dr).val(); 
           
            var rate_type    =  $('#rate_type'+id_dr).val(); 
            var unit_type    =  $('#unit_type'+id_dr).val();
            
            var edit_id = '';
            
            var weight=  $("#weight"+id_dr).val();
         
            var from_store=$('#from_store').val();
            
            var to_store=$('#to_store').val();
          
            var current_stock= $("#current_stock"+id_dr).val();
         
            var reorder=  $("#reorder"+id_dr).val();
            
            var rate=  $("#unit_rate"+id_dr).val();
            
              var partial=  $("#partial"+id_dr).val();
             
            var datastring = "set=add_product_transfer&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type
                   +"&edit_id="+edit_id+"&current_stock="+current_stock+"&reorder="+reorder+"&from_store="+from_store
                   +"&to_store="+to_store+"&rate="+rate+"&indent_id="+indent_id+"&partial="+partial
                   +"&indent_tot_qty="+indent_tot_qty+"&indent_tot_weight="+indent_tot_weight;
    
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                  
                  
                 }
                 });
        
        
              
        
              });
               
          }
         
        
        $('#load_error').show();
        $('#load_error').css('color','green');
        $('#load_error').text('PLEASE WAIT');
        $('#load_error').delay(1000).fadeOut('slow');
        
       setTimeout(function(){
     
       var data="set=add_transfer_all&from_store="+from_store+"&to_store="+to_store+"&direct_id="+direct_id+"&indent_id="+indent_id+
       "&indent_bal_in_tot="+indent_bal_in_tot+"&indent_tot_qty="+indent_tot_qty+"&indent_tot_weight="+indent_tot_weight;
      
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
            
        $('#from_store').val('');
        $('#load_error').show();
        $('#load_error').css('color','green');
        $('#load_error').text('SUCCESSFULL');
      
        $('#load_error').delay(1000).fadeOut('slow');
                
           var edit_id =  $('#edit_id').val();
           
           if(direct_id!='' || indent_id!=''){    
                
            $('#direct_id').val('');
            
            $('#indent_id').val('');
                
                
             window.location.href='history.php';
              
           }else{ 
           
           if(edit_id!=''){
               
             window.location.href='transfer_history.php';
              
           }else{
               
              window.location.href='store_transfer.php';  
              
           }
           
        }
          
           
        }
    });
    
         }, 1500); 
        
    
    }else{
           
         $('#load_error').show();
         $('#load_error').css('color','red');
         
         

          if(indent_qty_in<=0){
              
               $('#load_error').text('PLEASE ENTER TRANSFER QTY-WEIGHT');
               $('#to_store').focus();
         }
         
         if(to_store==from_store){
             $('#load_error').text('FROM & TO STORE CANT BE SAME');
             $('#to_store').focus();
        }
         
         
         if(to_store==''){
            $('#load_error').text('SELECT TO STORE');
            $('#to_store').focus();
        }
         
         if(from_store==''){
                $('#load_error').text('SELECT FROM STORE');
                $('#from_store').focus();
        }
            
            
        $('#load_error').delay(1000).fadeOut('slow');
         $('#submit_req').removeClass('disablegenerate');  
        $("#submit_req").css("pointer-events", "inherit"); 
        
        }
    
         }else{
            
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('ENTER PRODUCT DETAILS');
      
        $('#load_error').delay(1000).fadeOut('slow');
        $('#submit_req').removeClass('disablegenerate');  
        $("#submit_req").css("pointer-events", "inherit"); 
        
        }
      
    }
    
    function direct_go(){
        
         window.location.href='history.php';
    }
    
    
   function batch_change(){
       
     var amt = $('#batch_id1').find('option:selected').attr('amt');
    
     var b_id= $('#batch_id1').find('option:selected').attr('b_id');
     
     var stock= $('#batch_id1').find('option:selected').attr('stock');
   
    var bal_stock= $('#batch_id1').find('option:selected').attr('bal_stock');
   
    var rate_type    =  $('#rate_type').val(); 
    var unit_type    =  $('#unit_type').val();
   
   
      $('#unit_rate').val(amt);
      $("#unit_rate").attr('batch_new',b_id);  
      $("#unit_rate").attr('stock',stock);  
        
        
         if(unit_type=='Nos' || unit_type=='Single'){
          
              $('#qty').val('')  ;
             
        }else{
            
          if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
              
                 $('#qty').val('')  ;
                
            }else{
                 $('#weight').val('')  
                
           }
        }
        
          
       if(amt>0){   
        // $('#bt_stock_hd').show();
        // $('#batch_stock').show();
         $('#batch_stock').val(bal_stock); 
         
      
       }else{
        //  $('#bt_stock_hd').hide();
        //  $('#batch_stock').hide();
            $('#batch_stock').val(0);  
        }
    } 
   
   
 
    function check_ul_batch(bt){
       
    var amt = $('#ul_batch_'+bt).attr('amt');
    
    var b_id= $('#ul_batch_'+bt).attr('b_id');
     
    var stock= $('#ul_batch_'+bt).attr('stock');
   
    var bal_stock= $('#ul_batch_'+bt).attr('bal_stock');
   
    var rate_type    =  $('#rate_type').val(); 
    
    var unit_type    =  $('#unit_type').val();
    
    var ul_batch    =  $('#ul_batch_'+bt).val();
   
   $('#unit_rate').val(amt);
   $("#unit_rate").attr('batch_new',b_id);  
   $("#unit_rate").attr('stock',stock);  
        
       
    if(unit_type=='Nos' || unit_type=='Single'){
          
              $('#qty').val('')  ;
             
   }else{
            
          if(rate_type=='Packet' && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
              
                 $('#qty').val('')  ;
                
            }else{
                 $('#weight').val('')  
                
           }
   }
        
        if(ul_batch>bal_stock){
            
         $('#ul_batch_'+bt).val('');
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('BATCH STOCK IS LESS');
      
        $('#load_error').delay(1000).fadeOut('slow');
            
        }
        
          
       if(amt>0){   
        // $('#bt_stock_hd').show();
        // $('#batch_stock').show();
         $('#batch_stock').val(bal_stock); 
         
      
       }else{
        //  $('#bt_stock_hd').hide();
        //  $('#batch_stock').hide();
            $('#batch_stock').val(0);  
        }
    } 
   
   
   
   function close_store_fisrt(){
       
       $('.store_first_pop').hide(); 
         $('#from_store_first').val(''); 
           $('#to_store_first').val(''); 
   }
   
   
   
 function approve_first_store(){
     
     
    var from= $('#from_store_first').val(); 
     var to=      $('#to_store_first').val(); 
     
     
     if(from!='' && to!=''){
     $('#from_store').val(from); 
     
      $('#to_store').val(to); 
     
      $('.store_first_pop').hide(); 
      $('#from_store_first').val(''); 
      $('#to_store_first').val(''); 
      
        }else{
            
          $('#ind_error').show();
          $('#ind_error').css('color','darkred');
          $('#ind_error').text('SELECT FROM STORE & TO STORE');
      
          $('#ind_error').delay(1000).fadeOut('slow'); 
          
        }
     
   }
     
   
   
    
    function setup_store(){
     
     
    var from= $('#from_store_first').val(); 
     var to=      $('#to_store_first').val(); 
     
     
     
     if(from==to){
           $('#from_store_first').val('');   
           $('#to_store_first').val('');  
        
          
          $('#ind_error').show();
         $('#ind_error').css('color','red');
         $('#ind_error').text('BOTH STORE CANT BE SAME');
      
        $('#ind_error').delay(1000).fadeOut('slow');
          
          
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
        </style>

        
        <div class="quick_pop_printer_sec bill_quick_div store_first_pop" <?php if($trn_store_from!=''){?> style="display:none" <?php }else{ ?> style="display:block" <?php } ?>  >
        <div class="quick_pop_printer" style="height:200px">
        <div class="quick_pop_printer_head" > SELECT STORES </div>
        
        <span style="position: relative;display: flex;flex-direction: column;justify-content: center;align-items: center; ">
            
        <span style="font-size: 10px;font-weight: bold;    position: absolute;top: -20px;" id="ind_error"></span>
        
        <select onchange="setup_store()" style="width: 120px;border: solid 1px;border-radius: 4px;font-size: 16px;color: black" id="from_store_first" >
            
        <option style="font-weight:bold;" value="">From Store </option>    
            
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
        </select> <br>
        
        <select onchange="setup_store()"  style="width: 120px;border: solid 1px;border-radius: 4px;font-size: 16px;color: black" id="to_store_first" >
            
        <option style="font-weight:bold;" value="">To Store</option>    
            
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
                  
            <div onclick="approve_first_store();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">PROCEED</span></div>
                  
             <div onclick="close_store_fisrt();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
         </div>
    </div>
      <div>
      </div>
</div>     
        
        
    </body>

</html>