<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();


$grn_invoice='';
$grn_supplier='';
$grn_id=''; 
$grn_store=''; 
$grn_date='';

 $grn_qty_type='';
 $grn_brand='';
 $grn_qty='';
 $grn_weight='';
 $grn_unit_type='';
 $grn_unit_price='';
 $grn_total_rate='';
 $grn_tax='';
 $grn_final='';
 $grn_tax_amt=''; 
 $grn_tax_tot=''; 
 $grn_final_tot='';
$adj='';
$grand='';
if(isset($_REQUEST['grn_id'])&&($_REQUEST['grn_id'] !="")){
    
  $grn_id=$_REQUEST['grn_id'];
  
 
         $sql_login  =  $database->mysqlQuery("select *,sum(tg_total_rate) as sub,sum(tg_tax_rate) as tax,tgs_adjustment as adj,tg_grand_total as grand, tg_final_rate as final from tbl_grn_order tg left join tbl_vendor_master tv on tv.v_id=tg.tg_supplier left join  tbl_grn_summary tgs on tg.tg_grn_id=tgs.tgs_grn_id where tg.tg_grn_id='".$_REQUEST['grn_id']."'  order by tg.tg_id desc  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                        
                       $grn_supplier=$result_login['v_name'];
                       $grn_invoice=$result_login['tgs_invoice_no'];
                       $grn_store=$result_login['tg_store'];
                       $grn_date=$result_login['tg_date'];
                       
                       $grn_subtotal=$result_login['sub'];
                      $grn_tax_tot=$result_login['tax'];
                       $grn_final_tot=$result_login['final'];
                      
                       
                       $adj=$result_login['adj'];
                       $grand=$result_login['grand'];
                  }
                  }
                  
                  
        $ret_amt=0;  $grn_remark='';
         $sql_login6  =  $database->mysqlQuery("select sum(tpr_final) as final,tpr_remarks from tbl_purchase_return where tpr_grn='".$_REQUEST['grn_id']."' and tpr_set='N'  "); 
            
	  $num_login6   = $database->mysqlNumRows($sql_login6);
	  if($num_login6){
		  while($result_login6  = $database->mysqlFetchArray($sql_login6)) 
			{ 
                      
                         $grn_remark=$result_login6['tpr_remarks'];
                         
                       $ret_amt=$result_login6['final'];
                       
          }}
                  
                  
  
}





?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">
  
        <title>Return </title>

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

	<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}</style>
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
 .quick_pop_printer{padding: 3px;width:610px;height:200px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute;display: flex;flex-direction: column;justify-content: start;}  
 .quick_pop_printer_head{text-align:center;font-size:20px;color:#818181;padding:15px 0;font-weight:bold; text-transform:capitalize;}   
 .quick_pop_printer_content{width:100%;height:auto;padding:15px;text-align:center;}      
</style>
    </head>


    <body class="fixed-left">
 <input type="hidden" id="hidden_checker">
       <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />  
        
        <input type="hidden"  value="<?=$grn_id?>" id="grn_id" >
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            
          <div >             
            <?php include( 'includes/header.php') ?>
             </div>
            
            <!-- Top Bar End -->

            <div class="loyalty_mgmt_head"><div class=""><span classs="" style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(223deg, #ffffff, #ffffff)!important;padding: 0.7rem;">PURCHASE RETURN</span> </div>
            
            
            <span id="load_error" style="color:red;font-size: 10px;float: right;margin-right: -355px;margin-top: -20px;font-weight: bold" ></span>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                	
                    <div class="container" style="padding: 0.75; margin-bottom:1rem !important;" >
<div class="inv-req-content" style="overflow:auto;" >
<div style="display: flex;flex-direction: column;gap: 1rem;height: 87vh;">
<div class="inv-top-details" style="padding-left: 0.5rem; padding-right: 0.5rem;">
<p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#777;text-overflow:hidden; margin:0px !important;">Supplier Name : <span style="color:#fbaea4;"><?=$grn_supplier?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#777;text-overflow:hidden; margin:0px !important;">GRN ID : <span style="color:#fbaea4;"><?=$grn_id?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#777;text-overflow:hidden; margin:0px !important;">INV Status : <span style="color:#fbaea4;">Paid/NOT</span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#777;text-overflow:hidden; margin:0px !important;">INV No : <span style="color:#fbaea4;"><?=$grn_invoice?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#777;text-overflow:hidden; margin:0px !important;">INV Date : <span style="color:#fbaea4;"><?=$grn_date?></span></p>
   
   <input style="width:100%; grid-column: 1/-2;" value="<?=$grn_remark?>" onkeyup="unit_rate_calc();"  id="remarks" placeholder="Remarks"   type="text">

   <input id="" type="text" readonly class="inv-submit-btn " value="CLEAR ALL " style="cursor: pointer;border-bottom: none;width: 95px"  onclick="clear_all_return();" >

   
</div>


<div class="req-form-head" style="margin-top: 0rem;">
<h6 style="width: 10rem;">Product</h6>

<h6 style="width: 10rem;">Barcode</h6>
<h6 style="width: 5rem;">Qty Type</h6>
<h6 style="width: 8rem;">Brand</h6>
<h6 style="width: 5rem;">Unit</h6>
<h6 style="width: 5rem;">Weight</h6>
<h6 style="width: 5rem;">Qty</h6>
<h6  style="width: 7rem;">Unit Rate</h6>
<h6 style="width: 7rem;">Total</h6>
<h6 style="width: 5rem;">Tax %</h6>
<h6  style="width: 5rem;">Tax Rate</h6>
<h6 style="width: 8rem;">Final Rate</h6>
<h6 style="width: 3rem;"></h6>
</div>

    
    
    
    <div class="append_div_main" style="position:relative; display: flex;flex-direction: column;gap: 1rem;overflow: auto;">
         <div class="add_menu_row " id="second_div_main" style="position:relative; display: flex;flex-direction: column;gap: 1rem;overflow: auto;">
    
     <?php
    
     $sql_login  =  $database->mysqlQuery("select * from tbl_grn_order where tg_grn_id='".$_REQUEST['grn_id']."'  order by tg_id desc  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $grn_qty_type=$result_login['tg_rate_type'];
                       $grn_brand=$result_login['tg_brand'];
                       $grn_qty=$result_login['tg_qty'];
                       $grn_weight=$result_login['tg_weight'];
                       $grn_unit_type=$result_login['tg_unittype'];
                       $grn_unit_price=$result_login['tg_unit_rate'];
                       $grn_total_rate=$result_login['tg_total_rate'];
                       $grn_tax=$result_login['tg_tax_percent'];
                       $grn_final=$result_login['tg_final_rate'];
                       $grn_tax_amt=$result_login['tg_tax_rate'];
             ?>         
             
             <div class="inv-req-form <?php if($ret_amt==$grn_final_tot){ ?> disablegenerate5  <?php } ?>" style="padding-left: 0.5rem; padding-right: 0.5rem;">
    
    
    <input readonly  value="<?=$result_login['tg_name']?>" placeholder="Product" id="product" type="text" style="width: 10rem;">  
     
    
    <input value="<?=$result_login['tg_barcode']?>" readonly  placeholder="Barcode" id="barcode" type="text" style="width: 10rem;">
      
    
    <input readonly value="<?=$grn_qty_type?>" placeholder="Qty Type"  id="rate_type" type="text" style="width: 5rem;">
    
    <input readonly  value="<?=$grn_brand?>" placeholder="Brand" id="brand" type="text" style="width: 8rem;">
    
    <input readonly value="<?=$grn_unit_type?>" style="width: 5rem;" id="unit_type"  placeholder="Unit" type="text">

    <input readonly value="<?=$grn_weight?>" style="width: 5rem;" onkeyup="unit_rate_calc();" id="weight" placeholder="Weight"   type="text">
    
    <input readonly value="<?=$grn_qty?>" style="width: 5rem;" onkeyup="unit_rate_calc();"  id="qty" placeholder="Qty"   type="text">

    
    <input value="<?=$grn_unit_price?>" style="width: 7rem;" readonly  id="unit_rate" onkeyup="unit_rate_calc();" onkeypress="return numdot(this,event);"  placeholder="Unit Rate" type="text">
    
    <input value="<?=$grn_total_rate?>" style="width: 7rem;" readonly id="total_rate" onkeypress="return numdot(this,event);"  placeholder="Ttl Rate" type="text">
    
    <input  value="<?=$grn_tax?>" style="width: 5rem;" readonly onkeyup="unit_tax_calc();"  id="tax_percentage" onkeypress="return numdot(this,event);"  placeholder="Tax %" type="text">
    
    <input value="<?=$grn_tax_amt?>" style="width: 5rem;" readonly id="tax_rate"  onkeypress="return numdot(this,event);"  placeholder="Tax Rate" type="text">
    
    <input value="<?=$grn_final?>" style="width: 8rem;" readonly id="final_rate" onkeypress="return numdot(this,event);"  placeholder="Final Rate" type="text">  

    <a onclick="qty_add_pop('<?=$grn_id?>','<?=$result_login['tg_product']?>','<?=$result_login['tg_name']?>','<?=$result_login['tg_batch_id']?>');" id="plusbtn" class="inv-req-btn"  style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer"><i class="fa fa-retweet" aria-hidden="true"></i></a>
    
</div>
     <?php } } ?> 
   </div> 
    
   </div>
    
   
    
    
<div class="inv-req-Submit" style="margin-top:auto;">


   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;">Return : <span style="color:darkred;" id="ret_amt"><?=$ret_amt?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;"> | Sub Total : <span style="color:darkred;"><?=$grn_subtotal?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;"> | Tax Amt : <span style="color:darkred;"><?=$grn_tax_tot?></span></p>
   
    <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;"> | Adj : <span style="color:darkred;"><?=$adj?></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;"> | INV Amt : <span style="color:darkred;"><?=$grand?></span></p>
   <p style="    font-size: 1.4rem;
font-family: 'Inter', sans-serif;
font-weight: 500;
color:#4e4c4c;text-overflow:hidden; margin:0px !important;"> | Disc Amt : <span style="color:darkred;">0</span></p>

   
   <?php if($ret_amt==$grn_final_tot){ echo ' [FULLY RETURNED] '; } ?>
   
   
    <?php if($ret_amt==$grn_final_tot){   ?>
        
    <a class="inv-submit-btn " href="history.php">Exit</a>
    
   <?php } ?>
   
    
    
 
<input id="submit_grn" type="text" readonly class="inv-submit-btn " value="RETURN" style="margin-left:auto;cursor: pointer;border-bottom: none"  onclick="purchase_return();" >

</div>
	
</div>
                              
							</div>
<!--********************************** POP UP **********************************-->
<div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none">
    
    <div class="quick_pop_printer quick_pop_pr" id="load_store_grn" style="height: 350px;width: 600px" >
        
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
       

        
        
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
         <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert2.init.js"></script>
        
        <!-- Modal-Effect -->
        <script src="assets/plugins/custombox/js/custombox.min.js"></script>
        <script src="assets/plugins/custombox/js/legacy.min.js"></script>
              <script type="text/javascript" src="../js/jquery-ui-1.10.4.js"></script> 
         <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script type="text/javascript">
    $(document).ready(function () {
        
        localStorage.wgt=0;
        localStorage.wgt1=0;
     
         $( ".exp_date11").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
        
        
         $( ".exp_date1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
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
    
    function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
     var data="set=clear_purchase_return";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            $('#load_error').show();
         $('#load_error').css('color','green');
       $('#load_error').text('CLEARED');
      
        $('#load_error').delay(1000).fadeOut('slow');
           setInterval(function () {
               
             location.reload();
           
          }, 500); 
           
        }
    });
      
      
    }
    
    
    function clear_all_return(){
        
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CLEAR ALL PURCHASE RETURN ENTRIES');
        
      
        $('#confirm_pop_all').attr('mode','edit');
    
        
        
    }
    
    
    function click_chk(str){
        
        $('#qty_'+str).select();  
    }
    
    function click_chk_wt(str){
        
        $('#weight_'+str).select();  
    }
    
    
    
  function approve_submit(g,p,bt){
        
    var  qty=0;
        
    var weight=0;
        
       
    $('.store').each(function(){
      
    var store = this.value;
    var store_nm=$(this).children("option").text();
    
   var rate_type=$('#qty_'+store).attr('rate_type');
    var unit_type=$('#qty_'+store).attr('unit_type');
   
    var rate=$('#qty_'+store).attr('unit_rate');
   
   if(unit_type=='Single' || unit_type=='Nos'){
       
   var qty= $('#qty_'+store).val();
   
     var weight=0;    
  
     var total=(rate*qty);
   
   }else{
       
      if(rate_type=='Packet' && (unit_type=='KG' || unit_type=='LTR')){ 
          
        var qty=$('#qty_'+store).val();
   
        var  weight= 0;
         
        var total=(rate*qty);
    }else{
        
         var qty= 0;
   
        var  weight= $('#weight_'+store).val();
         
        var total=(rate*weight);
    }
        
   }
   
   
   var tax=$('#qty_'+store).attr('tax');
   
   if(tax!='' && tax>'0'){
       
   var tax_rate=(total*tax)/100;
     var final=(total+tax_rate)
  
   }else{
        var final=total;
        
       var tax='0'; 
      var tax_rate='0';  
   }
    
 
    if( ((unit_type=='Single' || unit_type=='Nos')  && qty>0 ) || (weight>0  && (unit_type!='Single' || unit_type!='Nos')) || (qty>0 && rate_type=='Packet'  && (unit_type=='KG' || unit_type=='LTR')) ){
   
       $('#ret_amt').text(final);
      
       var data1="set=purchase_return_entry&grn="+g+"&product="+p+"&store="+store+"&qty="+qty+"&rate="+rate+"&final="+final+"&tax="+tax+
               "&tax_rate="+tax_rate+"&weight="+weight+"&total="+total+"&rate_type="+rate_type+"&unit_type="+unit_type+"&batch="+bt
      
       
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data1,
        success: function(data2)
        {
           location.reload();
           $(".approve_pop").hide() ;
        }
         });
     
      }else{
          
         $('#error_rtn').show();
         $('#error_rtn').css('color','red');
         $('#error_rtn').text('INVALID RETURN VALUE FOR - '+store_nm);
      
         $('#error_rtn').delay(1000).fadeOut('slow');
            
      }
     
     }); 
        
    }
    
    
    
    function check_qty(qty_all,weight_all,qt_st,wt_st,store){
        
       ///qty calc/// 
       
     var qty = 0;
     $('.qt_cls').each(function(){
       
       if(this.value!=''){
         
      qty += parseFloat(this.value);
    
       }else{
        $(this).val('0');
       }
       
      
     if( parseFloat(qty)>parseFloat(qty_all)){
       
     
      
       $('#error_rtn').show();
         $('#error_rtn').css('color','red');
         $('#error_rtn').text('INVALID QTY .MAX GRN QTY IS '+qty_all);
      
        $('#error_rtn').delay(1000).fadeOut('slow');
      
      
      $(this).val('0');
        
    }
     });
     
     $('#qty_'+store).each(function(){
   
    if( parseFloat(this.value)>parseFloat(qt_st)){
       
     
        
        $('#error_rtn').show();
         $('#error_rtn').css('color','red');
         $('#error_rtn').text('INVALID QTY .MAX STORE QTY IS '+qt_st);
      
        $('#error_rtn').delay(1000).fadeOut('slow');
        
      $(this).val('0');
        
    }
         
    });
    
    
    ///weight calc///
    
    var wgt=0;
   
    $('.wt_cls').each(function(){
        
        if(this.value!=''){
           wgt += parseFloat(this.value);
           
          }else{
            $(this).val('0');
        }
        
        
       
       
        if( parseFloat(wgt)>parseFloat(weight_all)){
       
       
        
         $('#error_rtn').show();
         $('#error_rtn').css('color','red');
         $('#error_rtn').text('INVALID WEIGHT .MAX GRN WEIGHT IS '+weight_all);
      
        $('#error_rtn').delay(1000).fadeOut('slow');
        
        
        
       $(this).val('0');
       }
    
      });
      
        $('#weight_'+store).each(function(){
      if(parseFloat(this.value)>parseFloat(wt_st)){
       
         $('#error_rtn').show();
         $('#error_rtn').css('color','red');
         $('#error_rtn').text('INVALID WEIGHT .MAX STORE WEIGHT IS '+wt_st);
      
        $('#error_rtn').delay(1000).fadeOut('slow');
        
        
        $(this).val('0');
      }
        
       
    });
      
    }
    
    
    
    function qty_add_pop(grn,p,n,batch){ 
        
      $(".approve_pop").show();
    
      $(".approve_pop").attr('grn_id',grn);
      $(".approve_pop").attr('product_id',p);
     
      $("#menu_head").text(n); 
     
      var data1="set=purchase_return_store&grn="+grn+"&product="+p+"&batch="+batch
      $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data1,
        success: function(data2)
        {
            $('#load_store_grn').html($.trim(data2));
            
            
        }
     });
     
    }
    
    
    
     function close_pop(){ 
    $(".approve_pop").hide() ;
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
  

  
  
  
  
  function purchase_return(){
     
        var store=$('#store').val();
        
         var supplier=$('#supplier').val();
         
         var invoice_no=$('#invoice_no').val();
        
        var grn_id=$('#grn_id').val();
        
        
        var remarks=$('#remarks').val();
        
        
        
        if(store!='' && supplier!='' && invoice_no!='' & grn_id!=''){
            
       var data="set=add_purchase_return&store="+store+"&supplier="+supplier+"&grn_id="+grn_id+"&remarks="+remarks;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            $('#load_error').show();
         $('#load_error').css('color','green');
       $('#load_error').text('RETURN SUCCESSFULL');
      
        $('#load_error').delay(1000).fadeOut('slow');
           setInterval(function () {
               
              window.location.href='history.php';  
           
          }, 500); 
           
        }
    });
      
    
        } else{
            
            $('#load_error').show();
         $('#load_error').css('color','red');
         
           if(store==''){
       $('#load_error').text('SELECT STORE');
           $('#store').focus();
         }
          
         if(invoice_no==''){
       $('#load_error').text('ENTER INVOICE NO');
       $('#invoice_no').focus();
         }
         
         
         if(supplier==''){
       $('#load_error').text('SELECT SUPPLIER');
       $('#supplier').focus();
         }
      
         if(grn_id==''){
       $('#load_error').text('NO GRN ID FOUND ');
       $('#grn_id').focus();
         }
      
      
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
    
       
      
    }
  
</script>

	<style>.dataTables_scrollBody{height:460px !important;}
		.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}
		.modal-dialog{width:450px !important;top: 30%;}.modal .modal-dialog .modal-content{padding: 15px;}
               .ui-autocomplete{z-index:999999 !important;max-height: 400px;height: auto; overflow: scroll;} 
               .disablegenerate
         {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        </style>


    </body>

</html>