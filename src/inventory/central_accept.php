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

        <title>Central</title>

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
        
        <input type="hidden" id="local_branch" value="<?=$_SESSION['firebase_id']?>">  
        
        <input type="hidden" id="cnt_id" value="<?=$_REQUEST['cnt_id']?>">  
        
         <input type="hidden" id="store_direct" value="<?=$_REQUEST['store_direct']?>">  
         
        <input type="hidden" id="hidden_checker">
        <input type="hidden" id="hidden_checker1" value="1">
       <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />  
        
        <input type="hidden"  value="<?=$_REQUEST['cnt_id']?>"  id="accept_id"  >
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            
            <div <?php if(isset($_REQUEST['cnt_id']) && $_REQUEST['cnt_id']!=''){ ?> class="disablegenerate" <?php } ?> >
            <?php include( 'includes/header.php') ?>
            
            </div>

            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head">
            <div class="" >
                
                <a style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient( 223deg, #ffffff, #ffffff)!important; "  class="inv-req-btn1" href="#">CENTRAL KITCHEN TRANSFER</a>
               <?php if(!isset($_REQUEST['cnt_id']) && $_REQUEST['cnt_id']==''){ ?>
                <a  class="inv-pro-btn1"  href="#">CRH</a>
                <?php } ?>
                
              </div>
                   
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 0.7vw;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;width:350px" ></span> 
                    <div class="container" style="padding: 0.75; margin-bottom:1rem;" >

                    <div class="inv-req-content" style="overflow:auto;">


                    <div style="display: flex;flex-direction: column;gap: 1rem;height: 87vh;">
                  


<div class="req-form-head">
<h6 style="width: 10rem;">Product</h6>

<h6 style="width: 8rem;">Barcode</h6>
<h6 style="width: 8rem;">Qty Type</h6>
<h6 style="width: 8rem;">Brand</h6>
<h6 style="width: 8rem;">Unit</h6>
<h6 style="width: 8rem;">Rate</h6>
<h6 style="width: 10rem;">Weight</h6>
<h6 style="width: 7rem;">Qty</h6>
<h6 style="width: 7rem;display: none">Current Stock </h6>
<h6 style="width: 7rem;display: none">Reorder</h6>
<h6 style="width: 5rem;">Edit</h6>
</div>
<div class="append_div_main " style="position:relative;display: flex;flex-direction: column;gap: 1rem;">
         <div class="add_menu_row " id="second_div_main">
             
             <div class="inv-req-form" style="display:none">

    
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
     
      <input style="width: 3rem;"  id="edit_qty" onkeyup="check_weight_qty();"  onkeypress="return numdot(this,event);"  placeholder="" type="text">
     
</div>
</div>
</div>
<div class="inv-req-Submit" style="margin-top:auto;">
    
Items : <span id="rps_count">0</span>
    
<p style="margin-bottom:0rem;display: block" ><?php if(isset($_REQUEST['req_id'])&& $_REQUEST['req_id']!=''){ ?>  Req Id : <?=$_REQUEST['req_id']?>  <?php } ?><span style="color:darkred;"></span></p>
<a class="inv-submit-btn " style="display:none; margin-left:auto;" href="">Print</a>

 <?php if(isset($_REQUEST['cnt_id']) && $_REQUEST['cnt_id']!=''){ ?>
<a class="inv-submit-btn "  href="../index.php">EXIT</a>
      <?php } ?>


<span id="from_div">

    From Store :  <span id="from_store_name" style="color:darkred"> </span> <input  type="hidden"  readonly style="width: 20px;" id='from_store' >
  
</span>



<span>
    
    From Branch : <span id="from_branch_name"  style="color:darkred"> </span> <input type="hidden" readonly style="width: 60px;" id='from_branch'>

</span>




<span id="to_kitchen"> To Store:
<select onchange="store_to()"  id="to_store" style=" width: 100px;color:darkred"   >
    <option value="">To Store</option>
  
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

 
<input id="submit_req" type="text" readonly class="inv-submit-btn " value="ACCEPT" style="cursor: pointer;border-bottom: none;background-image: linear-gradient( 223deg , #6ce78c, #245a32)!important"  onclick="submit_req();" >

<input id="submit_req1" type="text" readonly class="inv-submit-btn " value="REJECT" style="cursor: pointer;border-bottom: none;background-image: linear-gradient( 223deg , #7c2723, #a93030)!important;"  onclick="cancel_pop();" >



<div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none;">
    <div class="quick_pop_printer"  style="height:185px" >
 <div class="inv-Password">
     <div  onclick="close_pop()" class="inv-password-img"> <span style="position: absolute;top:5px;left: 120px;" id="load_error1"></span>  <i style="padding: 6px;margin-left: 303px;margin-top: 10px;cursor: pointer;" class="fa fa-close" aria-hidden="true"></i></div>
     <div class="inv-password-msg" style="font-weight:bold;font-size: 15px;margin-top: -33px;"><span>REJECT REASON</span></div>
<div style="width:100%" class="inv-password-input">
    
    <select style="width:49%" id="reason_reject">
         <option value="">SELECT REASON</option>
        <option value="Qty_weight_missmatch">Qty/Weight Missmatch</option>
         <option value="Damage">Damage</option>
          <option value="Wastage">Wastage</option>
           <option value="Expired">Expired</option>
           <option value="Others">Others</option>
    </select>
    
    
    </div>
        
       
<div class="inv-Password-numbers" style="cursor:pointer">
   
    <a style="margin-top: 30px " class="inv-password-btn" href="#" onclick="cancel_req()">REJECT</a>
</div>
</div>
    </div></div>



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

var cnt_id= $("#cnt_id").val();

        var datastring = "set=product_central_transfer_load_local&cnt_id="+cnt_id
          
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
                    
                    
                    if(record.tct_edit_value=='null' || record.tct_edit_value=='' || record.tct_edit_value==null){
                         var  ed_qt_wt= '';
                    }else{
                      ed_qt_wt=record.tct_edit_value;
                    } 
                     
                     
                      var  rate=record.tct_rate;
                      
                  
                     $('#from_branch_name').text(record.tct_from_branch_name);
                      $('#from_store_name').text(record.tct_from_store_name);
                     
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
                      $('#to_branch').prop('disabled',true);    
                  $('#from_store').prop('disabled',true);
                  $('#to_store').prop('disabled',true); 
                 
                  $('#from_store').val(record.tct_local_store);
                  $('#to_store').val(record.tct_to_store);
                  $('#from_branch').val(record.tct_local_branch);
                 
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
    
     " <input value='" + current_stock + "' readonly style='width: 7rem;display: none' id='current_stock"+record.tct_id+"'  type='text'><a title='Qty Update Button' style='margin-left:-45px' onclick='edit_req_qty("+record.tct_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer;display:none'></i></a>"+
    
    
    " <input value='" + ed_qt_wt + "' style='width: 5rem;' id='edit_qty"+record.tct_id+"' onkeyup='check_weight_qty("+record.tct_id+");'  onkeypress='return numdot(this,event);'   type='text'><a title='Qty Update Button' style='margin-left:-25px' onclick='edit_weight_qty("+record.tct_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer;border:solid 1px;padding :3px;border-radius:3px;margin-left: 7px;'></i></a>"+
     
    
    " <a class='inv-req-btn' id='del_card"+record.tct_id+"' name='del_card"+record.tct_id+"' onclick='delete_req("+record.tct_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer;display:none'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                                 
                         } 
                         

                         
        });
                     
                     
           }   });
                   
            
        
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
            
      
       
       
    
      });
     
     
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

function close_pop(){
    
     $('.approve_pop').hide();
     
     $('#reason_reject').val('');
}


     function cancel_pop(){
         
          $('.approve_pop').show();
    }
     
     
function cancel_req(){
    var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
           
        if($.trim(data)=='yes'){
    
   var reason_reject= $('#reason_reject').val();
   
   if(reason_reject!=''){
     
         var branch=$('#local_branch').val();
         
         var cnt_id=$('#cnt_id').val();
        
        if(cnt_id!='' && branch!=''){
             $('#submit_req').addClass('disablegenerate'); 
           $('#submit_req1').addClass('disablegenerate'); 
           
       var data="set=reject_central_data&cnt_id="+cnt_id+"&branch="+branch+"&reason_reject="+reason_reject;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
             $('.approve_pop').hide();
     
         $('#reason_reject').val('');
     
        $('#load_error').show();
        $('#load_error').css('color','red');
        $('#load_error').text('REJECTED');
      
        $('#load_error').delay(1000).fadeOut('slow');
            
               
             window.location.href='../index.php';
              
        }
    });
  
            }
            
        }else{
           
        alert('SELECT REASON FOR REJECTION');
      
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
          
         var branch=$('#local_branch').val();
         
         var cnt_id=$('#cnt_id').val();
        
        if(cnt_id!='' && branch!=''){
            
            
             var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
           
        if($.trim(data)=='yes'){
            
            
            
        var data="set=check_central_id_menu_accept&cnt_id="+cnt_id;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {  
           
        if($.trim(data)==''){
            
             $('#submit_req').addClass('disablegenerate'); 
           $('#submit_req1').addClass('disablegenerate'); 
       var data="set=add_transfer_all_central_accept&cnt_id="+cnt_id+"&branch="+branch;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
            
        $('#load_error').show();
        $('#load_error').css('color','green');
        $('#load_error').text('ACCEPTING STOCK TO STORE');
      
        $('#load_error').delay(3000).fadeOut('slow');
              
          window.location.href='../index.php';
              
        }
       });
       
       }else{
                
        $('#load_error').show();
        $('#load_error').css('color','red');
        $('#load_error').text('CENTRAL ID MISSMATCH FOR : '+$.trim(data));
      
        $('#load_error').delay(1500).fadeOut('slow');
        
        }
       
        }
       });
       
       
        }else{
                
        $('#load_error').show();
        $('#load_error').css('color','red');
        $('#load_error').text('CHECK INTERNET & SYNC CENTRAL KITCHEN');
      
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
       
        }
       });
    
    
    
    
    
        }else{
            
          $('#load_error').show();
          $('#load_error').css('color','red');
         
          $('#load_error').text('ENTER DATA');
      
          $('#load_error').delay(1000).fadeOut('slow');
        
        }
    
         }else{
            
       $('#load_error').show();
       $('#load_error').css('color','red');
       $('#load_error').text('ENTER PRODUCT DETAILS');
      
       $('#load_error').delay(1000).fadeOut('slow');
        
        }
      
    }
    
    function edit_weight_qty(id){
        
        
         var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
           
        if($.trim(data)=='yes'){
        
                 var edit_qty=parseFloat($("#edit_qty"+id).val());
                 
                   var local_branch=$("#local_branch").val();
                   
                   var main_branch=$("#from_branch").val();
                    
                    
       if(local_branch!='' && edit_qty!=''){
            
      
        
       var data="set=update_qty_weight_central_accept&cnt_id="+id+"&local_branch="+local_branch+"&main_branch="+main_branch+"&edit_qty="+edit_qty;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
            
            
        $('#load_error').show();
        $('#load_error').css('color','green');
        $('#load_error').text('UPDATED');
      
        $('#load_error').delay(3000).fadeOut('slow');
              
          location.reload();
              
        }
       });
    
        }else{
            
          $('#load_error').show();
          $('#load_error').css('color','red');
         $("#edit_qty"+id).focus();
          $('#load_error').text('ENTER WEIGHT-QTY');
      
          $('#load_error').delay(1000).fadeOut('slow');
        
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
    
  function check_weight_qty(id){
      
                var edit_qty=parseFloat($("#edit_qty"+id).val());
                    
                 var  qty=  parseFloat($("#qty"+id).val());
                   
                  var rt=   $("#rate_type"+id).val();
                  var ut=   $("#unit_type"+id).val();
                  var wgt=   parseFloat($("#weight"+id).val());
                     
                       
          if(ut=='Nos' || ut=='Single'){              
              if(edit_qty>qty || edit_qty==0){
                  $("#edit_qty"+id).val('');
                   $('#load_error').show();
          $('#load_error').css('color','red');
         
          $('#load_error').text('INVALID QTY');
      
          $('#load_error').delay(1000).fadeOut('slow');
              }
          }else{
              
              if(rt=='Packet' && (ut=='Nos' || ut=='KG' || ut=='LTR')){  
                  if(edit_qty>qty || edit_qty==0){
                  $("#edit_qty"+id).val('');
                   $('#load_error').show();
          $('#load_error').css('color','red');
         
          $('#load_error').text('INVALID QTY');
      
          $('#load_error').delay(1000).fadeOut('slow');
              }
            }else{
                if(edit_qty>wgt || edit_qty==0){
                  $("#edit_qty"+id).val('');
                   $('#load_error').show();
          $('#load_error').css('color','red');
         
          $('#load_error').text('INVALID WEIGHT');
      
          $('#load_error').delay(1000).fadeOut('slow');
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
        </style>

    </body>

</html>