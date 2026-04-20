<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

 $grn_final_tot=0;
 $grn_tax=0;
 $grn_tax_tot=0;
 $grn_grand_tot=0;    
 $grn_invoice='';
 $remarks='';
 
 $localIP = getHostByName(getHostName()); 
 
$grn_store=''; $grn_supplier=''; $grn_id=''; $grn_adj='';  
$pr_date='';   $grn_tot=0; $grn_sum_id='';$sub=0; $grn_batch='';


 if(isset($_REQUEST['grn_id'])&&($_REQUEST['grn_id'] !="")){
    
   
     $date=date('Y-m-d H:i:s');
     
     $grn_id=$_REQUEST['grn_id'];
     
     
  
     $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_grn_order SET tg_set='N',tg_ip='$localIP'  where tg_grn_id='".$_REQUEST['grn_id']."' ");
     
     $sql_smsattemt_updation7  =  $database->mysqlQuery("UPDATE tbl_grn_summary SET tgs_edit_login='".$_SESSION['expodine_id']."', tgs_edited_time='$date', tgs_ip='$localIP'  where tgs_grn_id='".$_REQUEST['grn_id']."'  ");
 
         
     $sql_login = $database->mysqlQuery("select tg_supplier,tg_store,tg_batch_id from tbl_grn_order where tg_grn_id='".$_REQUEST['grn_id']."' order by tg_id desc"); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $grn_store=$result_login['tg_store'];
                      
                      $grn_supplier=$result_login['tg_supplier'];
                       
                       $grn_batch=$result_login['tg_batch_id'];
                      
                  } }
  




          $sql_login  =  $database->mysqlQuery("select sum(tg_final_rate) as final,sum(tg_total_rate) as sub,sum(tg_tax_rate) as tax,tg_grn_id  "
          . " from tbl_grn_order where tg_set='N' and tg_grn_id='".$_REQUEST['grn_id']."'  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      $grn_tax_tot=$result_login['tax'];
                     
                      $grn_sum_id=$result_login['tg_grn_id'];
                      $grn_grand_tot=$result_login['final'];
                      $sub=$result_login['sub'];
                      
                      
                  } }
                  
              
          $sql_login  =  $database->mysqlQuery("SELECT  *  FROM `tbl_grn_summary` WHERE tgs_grn_id ='$grn_sum_id'  "); 
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $grn_final_tot=$result_login['tg_final_total'];
                      
                      $grn_tax=$result_login['tg_tax'];
                      
                      $grn_grand_tot=$result_login['tg_grand_total'];
                      
                      $grn_invoice=$result_login['tgs_invoice_no'];
                      
                      $grn_adj=$result_login['tgs_adjustment'];
                       
                      $pr_date=$result_login['tg_date'];
                      
                      $remarks=$result_login['tgs_remarks'];
                      
                      
                     
                      
          } }
                               


}



$grn_po_chk='';
if(isset($_REQUEST['grn_po'])&&($_REQUEST['grn_po'] !="")){
   
    $grn_po_chk=$_REQUEST['grn_po'];
    
    
  $sql_login  =  $database->mysqlQuery("select ti_grn_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_grn_id'];
                  }
                  }
         
         $grn_id_new='Grn_'.$inv_req;
         
           $grn_id_new=  rand(100, 999999); 
         
       $sql_login51  =  $database->mysqlQuery("select tg_grn_id from tbl_grn_order where tg_set='N' "); 
            
	  $num_login51   = $database->mysqlNumRows($sql_login51);
	  if(!$num_login51){
         
         $sql_login5  =  $database->mysqlQuery(" INSERT INTO `tbl_grn_order`(`tg_grn_id`, `tg_dayclosedate`, `tg_product`, `tg_name`,
             `tg_rate_type`, `tg_barcode`, `tg_unittype`, `tg_weight`, `tg_qty`,  
              `tg_brand`, `tg_supplier`, `tg_store`, `tg_set`, `tg_login` ,tg_ip
                    )
             
             SELECT  '$grn_id_new' , '".$_SESSION['date']."', `tp_product`, `tp_name`, `tp_rate_type`, `tp_barcode`, `tp_unittype`, `tp_weight`,`tp_qty`, 
                                 `tp_brand`, `tp_supplier`,`tp_store`, 'N' ,'".$_SESSION['expodine_id']."' ,'$localIP' 
                                FROM tbl_purchase_order
                         where tp_purchase_id='".$grn_po_chk."' "); 
         
          }
         
         $sql_login5  =  $database->mysqlQuery("select tp_store,tp_supplier from tbl_purchase_order where tp_purchase_id='".$grn_po_chk."' order by tp_id desc "); 
            
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{ 
                      
                       $grn_store=$result_login5['tp_store'];
                       $grn_supplier=$result_login5['tp_supplier'];
                       
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

        <title>Purchase </title>

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

    </head>


    
    <body class="fixed-left">
        
        
          <input type="hidden"  value="<?=$_REQUEST['from']?>" id="from_flt" >
          <input type="hidden"  value="<?=$_REQUEST['to']?>" id="to_flt" >
          <input type="hidden"  value="<?=$_REQUEST['status']?>" id="status_flt">
          <input type="hidden"  value="<?=$_REQUEST['search_id']?>" id="id_flt" >
          <input type="hidden"  value="<?=$_REQUEST['type']?>" id="type_flt" >
          
        
        <input type="hidden" id="hidden_checker">
       <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />  
        
        <input type="hidden"  value="<?=$grn_id?>" id="edit_id" >
        
        <input type="hidden" value="<?=$grn_po_chk?>" id="req_add_id">
        
        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            
            <div id="hd_div" <?php if((isset($grn_id) && $grn_id!='') || $grn_po_chk!=''){ ?> class="disablegenerate" <?php } ?> >   
            <?php include( 'includes/header.php') ?>
             </div>
            
            <!-- Top Bar End -->

            <div class="loyalty_mgmt_head"><div class=""><span classs="" style="font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(223deg, #ffffff, #ffffff)!important;padding: 0.7rem;">STOCK PURCAHSE</span>   &nbsp;&nbsp;&nbsp; <span style="font-size:12px;font-weight: bold"> IP : <?=$localIP?> </span> </div>
             
            

                 
                 </div>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                <span id="load_error" style="color: red;font-size: 10px;position: absolute;top: 18px;right: 10px;font-weight: bold;z-index: 999;display: none;" ></span>
                	
                    <div class="container" style="padding: 0.75; margin-bottom:1rem !important;" >

<div class="inv-req-content" style="overflow:auto;" >
<div style="    display: flex;flex-direction: column;gap: 1rem;height: 87vh;">
<div class="req-form-head" style="padding-left: 0.5rem; padding-right: 0.5rem;">
<h6 style="width: 4rem;display: none">Sl</h6>
<h6 style="width: 10rem;cursor: pointer" onclick="cursor_loader('P');">Product</h6>

<h6 style="width: 10rem;cursor: pointer" onclick="cursor_loader('B');">Barcode</h6>
<h6 style="width: 6rem;">Batch No</h6>

<h6 style="width: 5rem;">Rate Type</h6>
<h6 style="width: 8rem;">Brand</h6>
<h6 style="width: 6rem;">Unit</h6>

<h6 style="width: 5rem;">Qty</h6>
<h6 style="width: 5rem;">Weight</h6>
<h6 style="width: 10rem;">Exp Date</h6>
<h6  style="width: 7rem;">Unit Rate</h6>
<h6 style="width: 7rem;">Total</h6>
<h6 style="width: 5rem;">Tax %</h6>
<h6  style="width: 5rem;">Tax Rate</h6>
<h6 style="width: 8rem;">Final Rate</h6>
<?php if( ($grn_id=='' && $grn_po_chk=='') ){ ?>
<h6 onclick="clear_all();" style="width: 3rem;color:red !important" class="delete-all"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></h6>
<?php }else{ ?>
 <h6  style="width: 3rem;color:black !important" class=""></h6>   
<?php } ?> 
</div>


    <div class="append_div_main" style="position:relative; display: flex;flex-direction: column;gap: 1rem;overflow: auto;">
         <div class="add_menu_row " id="second_div_main">
    
<div class="inv-req-form" style="padding-left: 0.5rem; padding-right: 0.5rem;">
    
    <span class="inv-req-sl" style="width: 4rem;display: none">#</span>
    
    <input onkeyup="clear_name();" onchange="clear_name();" placeholder="Product" id="product" type="text" style="width: 10rem;">  
     
    <input onkeyup="clear_name1();" onchange="barcode_entry();" placeholder="Barcode" id="barcode" type="text" style="width: 10rem;">
    
    
    <input  placeholder="Batch No" id="batch_no" type="text" style="width: 6rem;">
      
    
    <input placeholder="Qty Type" readonly id="rate_type" type="text" style="width: 5rem;">
    
    <input placeholder="Brand" id="brand" type="text" style="width: 8rem;">
    
    <input style="width: 6rem;" id="unit_type" readonly placeholder="Unit" type="text">

   
    
    <input style="width: 5rem;" onkeyup="unit_rate_calc();"  id="qty" placeholder="QTY" onkeypress="return numdot1(event);"  type="text">
    
     <input style="width: 5rem;" onkeyup="unit_rate_calc();" id="weight" placeholder="Weight" onkeypress="return numdot(this,event);"  type="text">

     <input class="exp_date1" placeholder="Exp Date" id="exp_date" type="text"  style="width: 10rem;">
    
    <input style="width: 7rem;"  id="unit_rate" onkeyup="unit_rate_calc();" onkeypress="return numdot(this,event);"  placeholder="Unit Rate" type="text">
    
    <input style="width: 7rem;" onkeyup="total_to_unit()" id="total_rate" onkeypress="return numdot(this,event);"  placeholder="Ttl Rate" type="text">
    
    <input style="width: 5rem;" onkeyup="unit_tax_calc();"  id="tax_percentage" onkeypress="return numdot(this,event);"  placeholder="Tax %" type="text">
    
    <input style="width: 5rem;" readonly id="tax_rate"  onkeypress="return numdot(this,event);"  placeholder="Tax Rate" type="text">
    
    <input style="width: 8rem;" readonly  id="final_rate" onkeypress="return numdot(this,event);"  placeholder="Final Rate" type="text">
    
    <a id="plusbtn" class="inv-req-btn" href="#" style="width: 3rem;background-image: linear-gradient( 223deg,#3e7f31, #60a950)!important;color: #fff;cursor: pointer">+</a>
    
    
  </div>
    
    
   </div> 
    
   </div> 
    
  <div class="inv-req-Submit" style="margin-top:auto;">

   <div>
   <p style="margin-bottom:0rem;display: block;width:10rem;" ><span ><?php if($grn_id!=''){ ?>   Id : <?=$grn_id?>  <?php } ?></span><span style="color:darkred;"></span></p> 
   <span style="display:flex;"> <span>Items:</span><span id="rps_count">0</span> </span> 
   </div>

   <input style="width:8rem;" value="<?=$pr_date?>" type="text" readonly id="purchase_date" placeholder="Purchase Date">
   
   <select  id="supplier">
    <option value="">Supplier</option>
    
    <?php  
    $fnct_menu = $database->mysqlQuery("select * from tbl_vendor_master where v_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option <?php if($grn_supplier==$result_fnctvenue['v_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['v_id']?>"><?=$result_fnctvenue['v_name']?></option>
    
    <?php } } ?>
    
  </select>
  
    <input  style="width: 8rem;" value="<?=$grn_invoice?>"  id="invoice_no" placeholder="Invoice No" type="text">
    
    
    
    <input type="hidden" value="<?=$grn_grand_tot?>" id="grn_tot" >
    
    
    <input readonly  style="width: 8rem;" value="<?=$sub?>"  id="subtotal_bottom" placeholder="Subtotal" type="text">
    
    <input maxlength="7" value="<?=$grn_tax?>" onkeyup="bottom_tax_calc();"  onkeypress="return numdot(this,event);" id="tax_bottom" style="width: 8rem; margin-left:auto;display: none" placeholder="Tax %" type="text">
   
    
    <input readonly style="width: 6rem;" value="<?=$grn_tax_tot?>" id="tax_rate_bottom" placeholder="Tax Rate" type="text">
    
    <input maxlength="8" style="width: 6rem;" value="<?=$grn_adj?>" id="adjustment"   onkeyup="bottom_adj_calc();"  placeholder="Adjustment" type="text">
    
    
    <input readonly style="width: 8rem;" value="<?=$grn_grand_tot?>"  id="total_bottom" placeholder="Total Rate" type="text">

    
     <input  style="width: 8rem;" value="<?=$remarks?>"  id="remarks_grn_new" placeholder="Remarks" type="text">                    
    
    
<select  id="store"  >
   
  <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' order by ti_id asc  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option <?php if($grn_store==$result_fnctvenue['ti_id']){ ?> selected <?php } ?> value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>



  <?php if($grn_store=='' && $grn_id!='' ){ ?>
    
     <a style="display: none " class="inv-submit-btn " href="history.php">Exit</a>

  <?php }  ?> 

    
    <?php if(isset($_REQUEST['grn_po'])&&($_REQUEST['grn_po'] !="")){  ?>
    
    <a class="inv-submit-btn " href="history.php?set=clear_all_grn">Exit</a>

    <?php }  ?> 
    
    

   
<input id="submit_grn" type="text" readonly class="inv-submit-btn "  value="Submit" style="margin-left:auto;cursor: pointer;border-bottom: none"  onclick="submit_grn();" >

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
        
        setTimeout(function () {
       
     
        if(localStorage.focuser=='Product'){
            
         $("#product").focus();
       
       }else{
           
             $("#barcode").focus();
       }
        
        }, 500); 
        
        
   $('#invoice_no').keypress(function (e) {
            
    var allowedChars = new RegExp("^[-a-zA-Z0-9\- ._ /]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (allowedChars.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
    
   }).keyup(function() {
    
    var forbiddenChars = new RegExp("[^-a-zA-Z0-9\- ._ /]", 'g');
    if (forbiddenChars.test($(this).val())) {
        $(this).val($(this).val().replace(forbiddenChars, ''));
    }
    
   });
        
        
        
  $(document).on('keypress',function(e) {
      
        if(e.which == 13) {
       
        if ($('#qty').is(':focus')) {
            
              $("#plusbtn").click();
   
           }else if($('#unit_rate').is(':focus')){
               
          $("#plusbtn").click();
           }
           else if($('#tax_percentage').is(':focus')){
               
          $("#plusbtn").click();
           }else if($('#weight').is(':focus')){
               
         $("#plusbtn").click();
        }
        else if($('#total_rate').is(':focus')){
               
         $("#plusbtn").click();
        }
           else if($('#submit_grn').is(':focus')){
               
          submit_grn();
        }
  }
});


$(document).on('keyup',function(e) {
    
    if(e.which == 9) {
     if ($('#supplier').is(':focus')) { 
         
         $('#supplier').css('border-bottom','3px solid blue');
         
          }else if ($('#store').is(':focus')) { 
               
                $('#store').css('border-bottom','none');
            $('#store').css('border-bottom','3px solid blue');
         
           }else{
               $('#supplier').css('border-bottom','none');
                $('#store').css('border-bottom','none');
           }
    }
    
});
        
        

        
         $(".exp_date11").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
                todayHighlight: true
          });
        
        
         $(".exp_date1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
                todayHighlight: true
           });
        
        $( "#purchase_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
                todayHighlight: true,  
                endDate: "today"
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
        
        
        $("#product").autocomplete({
                            minLength: 2,
                            source: "load_inventory.php?set=search_product_inventory",
                            focus: function (event, ui) {
                                
                                $("#product").val(ui.item.label);
                               
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    
                                $("#brand").focus() ;
                                $("#product").val(ui.item.label);
                                
                                $('#qty').val('1');
                                $('#unit_rate').val('0');
                                 $('#weight').val('1.000');	
                               
                               
                                $('#rate_type').val(ui.item.rate_type);
                                $('#unit_type').val(ui.item.base_unit);
                                
                                $('#barcode').prop('disabled',true);
                               
                                $('#barcode').val(ui.item.barcode);

                                $('#product').attr('menuid',ui.item.menuid);   
                                
                               
                                   
                                if(ui.item.base_unit=='Nos' || ui.item.base_unit=='Single' ){
                                    
                                       if(ui.item.rate_type!='Packet'){
                                        $('#weight').attr('readonly', true);
                                          }
                                          
                                        $('#qty').attr('readonly', false);
                                        
                                        
                                        if(ui.item.rate_type=='Packet' && ui.item.base_unit=='Nos' && ui.item.weight>0  ){
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
                                  localStorage.barcode_length= $("#barcode").val().length;
                                  
                                return false;
                             
                            }

                        });
                        
                        
      
       $("#barcode").autocomplete({
           
                            minLength: 1,
                            source: "load_inventory.php?set=search_barcode_inventory",
                            focus: function (event, ui) {
                                $("#barcode").val(ui.item.label);
                                $("#valueofsearch_menu").val(ui.item.menuid);
                                var menunames = $("#valueofsearch_menu").val();
                                return false;
                              },
                         
                                select: function (event, ui) {
                                    $("#brand").focus() ;
				$("#product").val(ui.item.label);
                                  $('#qty').val('1');
                                 $('#unit_rate').val('0');
                                $("#valueofsearch_menu").val('');
                               
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
                                       
                                        if(ui.item.rate_type=='Packet' && ui.item.base_unit=='Nos' && ui.item.weight>0  ){
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
        
          $('#barcode').prop('disabled',true);
        
        localStorage.barcode_length= $("#barcode").val().length;
        localStorage.name_length= $("#product").val().length;
                                return false;
                                
                            }

                        });
                        
                        
                        
                        
                        
        var grn_edit_id=$('#edit_id').val();
       
        var datastring2 = "set=load_all_grn&grn_edit_id="+grn_edit_id;
         
          $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                  
                   
           var total_rate= $("#total_rate").val();
           var tax_percentage= $("#tax_percentage").val();
           var tax_rate= $("#tax_rate").val();
           var final_rate= $("#final_rate").val();
         
         
          var fin_tot=0;
         var sub_tot=0;
          var tax_tot=0;
          
                    var a=JSON.parse(data);
                   
                     $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
                     
          $("#exp_date").val('');
          $("#unit_rate").val('');
          $("#total_rate").val('');
           $("#tax_percentage").val('');
           $("#tax_rate").val('');
          $("#final_rate").val('');
         
         
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
                     var batch_no=record.tg_batch_id;
                     
                     
                    
             if(record.tg_expiry_date=='null' || record.tg_expiry_date=='' || record.tg_expiry_date==null){
                         var  exp_date= '';
                    }else{
                      exp_date=record.tg_expiry_date;
                    }
                    
         
         if(record.tg_unit_rate=='null' || record.tg_unit_rate=='' || record.tg_unit_rate==null){
                         var  unit_rate= '';
                    }else{
                      unit_rate=record.tg_unit_rate;
                    }
                    
         
         if(record.tg_total_rate=='null' || record.tg_total_rate=='' || record.tg_total_rate==null){
                         var  total_rate= '0';
                    }else{
                      total_rate=record.tg_total_rate;
                    }
                    
             if(record.tg_tax_percent=='null' || record.tg_tax_percent=='' || record.tg_tax_percent==null){
                         var  tax_percentage= '';
                    }else{
                      tax_percentage=record.tg_tax_percent;
                    }   
                    
                    
              if(record.tg_tax_rate=='null' || record.tg_tax_rate=='' || record.tg_tax_rate==null){
                         var  tax_rate= '';
                    }else{
                      tax_rate=record.tg_tax_rate;
                    }   
                          
         if(record.tg_final_rate=='null' || record.tg_final_rate=='' || record.tg_final_rate==null){
                         var  final_rate= '0';
                    }else{
                      final_rate=record.tg_final_rate;
                    }   
                          
           
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
                         
                         
                fin_tot=parseFloat(fin_tot)+parseFloat(final_rate);
            
            sub_tot=parseFloat(sub_tot)+parseFloat(total_rate);
            
           if(tax_rate>0){
             tax_tot=parseFloat(tax_tot)+parseFloat(tax_rate);
           }
             
          
          
         
           $('#subtotal_bottom').val(sub_tot.toFixed(3));
           
            $('#tax_rate_bottom').val(tax_tot.toFixed(3));         
                         
                          
            var adj2=$("#adjustment").val();
            var all_tot=fin_tot+parseFloat(adj2);
            
         
            if(adj2!=''){
             $('#total_bottom').val(all_tot.toFixed(3));
            }else{
               $('#total_bottom').val(fin_tot.toFixed(3));  
            }
           
                 
                 if(rate_type=='Packet' &&  weight>0  && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                                         
                                        //  var chk_weight = 'readonly' ;
                                        
                }
                 
                 
     if($('.append_div_main').find('#del_card' + record.tg_id).length === 0){
                  
     $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tg_id+"' >"+
     "<div class='inv-req-form'>"+
    "<span class='inv-req-sl' style='width: 4rem; overflow:hidden;display: none'>"+sl+"</span>"+
    
    "<input title='" + product + "'  id='product"+record.tg_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tg_id+"' value='" + barcode + "' readonly  type='text' style='width: 10rem;'>"+
   
    " <input value='" + batch_no + "' style='width: 6rem;' id='batch_no"+record.tg_id+"' readonly type='text'>"+
   
    "<input value='" + rate_type + "' style='width: 5rem;' readonly id='rate_type"+record.tg_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tg_id+"' readonly type='text' style='width:8rem ;'>"+
    
   " <input value='" + unit_type + "' style='width: 6rem;' id='unit_type"+record.tg_id+"' readonly type='text'>"+
    
    " <input value='" + qty + "'  "+chk_qty +"   onkeypress='return numdot1(event);'  onkeyup='unit_rate_calc1("+record.tg_id+")'; style='width: 5rem;' id='qty"+record.tg_id+"'  type='text'> <a title='Qty Update Button' style='margin-left:-27px;display:none' onclick='edit_grn_qty("+record.tg_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
     " <input value='" + weight + "'   "+chk_weight+"   onkeypress='return numdot(this,event);'    onkeyup='unit_rate_calc1("+record.tg_id+")';  style='width: 5rem;' id='weight"+record.tg_id+"'  type='text'>"+
    
      " <input class='exp_date11' data-provide='datepicker' data-date-format='yyyy-mm-dd' data-date-autoclose='true' value='" + exp_date + "'  style='width: 10rem;' id='exp_date"+record.tg_id+"'  type='text'>"+
        " <input value='" + unit_rate + "'  onkeypress='return numdot(this,event);'     onkeyup='unit_rate_calc1("+record.tg_id+")';  style='width: 7rem;' id='unit_rate"+record.tg_id+"'  type='text'>"+
          " <input value='" + total_rate + "' onkeyup='total_to_unit1("+record.tg_id+")' style='width: 7rem;' id='total_rate"+record.tg_id+"'  type='text'>"+
            " <input value='" + tax_percentage + "'  onkeypress='return numdot(this,event);'    onkeyup='unit_tax_calc1("+record.tg_id+")';  style='width: 5rem;' id='tax_percentage"+record.tg_id+"'  type='text'>"+
              " <input value='" + tax_rate + "'   readonly style='width: 5rem;' id='tax_rate"+record.tg_id+"'  type='text'>"+
                " <input value='" + final_rate + "' readonly style='width: 8rem;' id='final_rate"+record.tg_id+"'  type='text'>"+
    
    "<a title='Qty Update Button' style='margin-left:-21px' onclick='edit_grn_qty("+record.tg_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    " <a class='inv-req-btn' id='del_card"+record.tg_id+"' name='del_card"+record.tg_id+"' onclick='delete_grn("+record.tg_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                   
                         }
                         

                         
                     });
                     
                      $("#product").focus();
                    
                 }
                 
                 });                
                        
                        
       
            
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
            
           var weight= $("#weight").val();
         
           var exp_date= $("#exp_date").val();
           var unit_rate= parseFloat($("#unit_rate").val());
           var total_rate= $("#total_rate").val();
           var tax_percentage= $("#tax_percentage").val();
           var tax_rate= $("#tax_rate").val();
           var final_rate= $("#final_rate").val();
         
           var batch_no=$('#batch_no').val();
         
           var fin_tot=0;
           var sub_tot=0;
           var tax_tot=0;
          
           var datastring2 = "set=check_product_grn&product="+product_id;
         
          $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
          if($.trim(data)=='yes' || batch_no!=''){
              
           var datastring2 = "set=check_product_batchno&product="+product_id+"&batch_no="+batch_no;
         
                $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring2,
                 success: function (data)
                 { 
                    
            if($.trim(data)=='yes'){   
              
         
            if(product!='' &&  qty > '0' && unit_rate > '0' && weight >'0'){
                  
                  var datastring = "set=add_product_grn&product="+product+"&barcode="+barcode+"&weight="+weight
                   +"&qty="+qty+"&brand="+brand+"&product_id="+product_id+"&unit_type="+unit_type+"&rate_type="+rate_type+"&edit_id="+edit_id
                   +"&exp_date="+exp_date+"&unit_rate="+unit_rate+"&total_rate="+total_rate+"&tax_percentage="+tax_percentage
                   +"&tax_rate="+tax_rate+"&final_rate="+final_rate+"&batch_no="+batch_no;
       
                 $.ajax({
                 type: "POST",
                 url: "load_inventory.php",
                 data: datastring,
                 success: function (data)
                 { 
                     
                
                  
                    var a=JSON.parse(data);
                     $('#batch_no').val('');
                     $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
                     
          $("#exp_date").val('');
          $("#unit_rate").val('');
          $("#total_rate").val('');
          $("#tax_percentage").val('');
          $("#tax_rate").val('');
          $("#final_rate").val('');
         
         
                     var s=1;
                     $.each(a, function(i, record) {
                       
                       
                       
                    $("#second_div_main"+record.tg_id).empty();
                     $("#second_div_main"+record.tg_id).hide();
                       
                     var sl=s++;
                     
                   $('#hidden_checker').val(sl);
                    $('#rps_count').text(sl); 
                    var product=record.tg_name;
                    var  qty=record.tg_qty;
                    
                    
                    var batch_no=record.tg_batch_id;
                    
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
                    
                    					
           if(record.tg_expiry_date=='null' || record.tg_expiry_date=='' || record.tg_expiry_date==null){
                         var  exp_date= '';
                    }else{
                      exp_date=record.tg_expiry_date;
                    }
                    
         
         if(record.tg_unit_rate=='null' || record.tg_unit_rate=='' || record.tg_unit_rate==null){
                         var  unit_rate= '';
                    }else{
                      unit_rate=record.tg_unit_rate;
                    }
                    
         
         if(record.tg_total_rate=='null' || record.tg_total_rate=='' || record.tg_total_rate==null){
                         var  total_rate= '0';
                    }else{
                      total_rate=record.tg_total_rate;
                    }
                    
             if(record.tg_tax_percent=='null' || record.tg_tax_percent=='' || record.tg_tax_percent==null){
                         var  tax_percentage= '';
                    }else{
                      tax_percentage=record.tg_tax_percent;
                    }   
                    
                    
              if(record.tg_tax_rate=='null' || record.tg_tax_rate=='' || record.tg_tax_rate==null){
                         var  tax_rate= '';
                    }else{
                      tax_rate=record.tg_tax_rate;
                    }   
                          
         if(record.tg_final_rate=='null' || record.tg_final_rate=='' || record.tg_final_rate==null){
                         var  final_rate= '';
                    }else{
                      final_rate=record.tg_final_rate;
                    }  
                    
                    
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
                         
                    
            fin_tot=parseFloat(fin_tot)+parseFloat(final_rate);
            
            sub_tot=parseFloat(sub_tot)+parseFloat(total_rate);
            
           if(tax_rate>0){
             tax_tot=parseFloat(tax_tot)+parseFloat(tax_rate);
           }
             
          
           $('#subtotal_bottom').val(sub_tot.toFixed(3));
           
            $('#tax_rate_bottom').val(tax_tot.toFixed(3));
            
            var adj2=$("#adjustment").val();
            var all_tot=fin_tot+parseFloat(adj2);
            
          
            if(adj2!=''){
                
             $('#total_bottom').val(all_tot.toFixed(3));
             
            }else{
                
               $('#total_bottom').val(fin_tot.toFixed(3)); 
               
            }
               
               if(rate_type=='Packet' &&  weight>0  && (unit_type=='Nos' || unit_type=='KG' || unit_type=='LTR')){
                                         
                              // var chk_weight = 'readonly';
                                        
               }
                 
               
                     
       if($('.append_div_main').find('#del_card' + record.tg_id).length === 0) {
                  
      $(".append_div_main").append(" <div class='add_menu_row ' id='second_div_main"+record.tg_id+"' >"+
     "<div class='inv-req-form'>"+
     "<span class='inv-req-sl' style='width: 4rem; overflow:hidden;display: none'>"+sl+"</span>"+
    
    "<input title='" + product + "'   id='product"+record.tg_id+"' value='" + product + "' readonly type='text' style='width: 10rem;'>  "+
   
   " <input id='barcode"+record.tg_id+"' value='" + barcode + "' readonly  type='text' style='width: 10rem;'>"+
   
    " <input value='" + batch_no + "' style='width: 6rem;' id='batch_no"+record.tg_id+"' readonly type='text'>"+
   
    "<input value='" + rate_type + "' style='width: 5rem;' readonly id='rate_type"+record.tg_id+"' type='text'>"+
    
    "<input value='" + brand + "'  id='brand"+record.tg_id+"' readonly type='text' style='width: 8rem;'>"+
    
   " <input value='" + unit_type + "' style='width: 6rem;' id='unit_type"+record.tg_id+"' readonly type='text'>"+
    
    " <input value='" + qty + "'   onkeypress='return numdot1(event);'  "+chk_qty +"  onkeyup='unit_rate_calc1("+record.tg_id+")';  style='width: 5rem;' id='qty"+record.tg_id+"'  type='text'> <a title='Qty Update Button' style='margin-left:-27px;display:none' onclick='edit_grn_qty("+record.tg_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    
     " <input value='" + weight + "'   onkeypress='return numdot(this,event);'  "+chk_weight +"  onkeyup='unit_rate_calc1("+record.tg_id+")';  style='width: 5rem;' id='weight"+record.tg_id+"'  type='text'>"+
    
      " <input class='exp_date11' data-provide='datepicker' data-date-format='yyyy-mm-dd' data-date-autoclose='true' value='" + exp_date + "'  style='width: 10rem;' id='exp_date"+record.tg_id+"'  type='text'>"+
        " <input value='" + unit_rate + "'  onkeypress='return numdot(this,event);'   onkeyup='unit_rate_calc1("+record.tg_id+")'; style='width: 7rem;' id='unit_rate"+record.tg_id+"'  type='text'>"+
          " <input value='" + total_rate + "' onkeyup='total_to_unit1("+record.tg_id+")' style='width: 7rem;' id='total_rate"+record.tg_id+"'  type='text'>"+
            " <input value='" + tax_percentage + "'   onkeypress='return numdot(this,event);'  onkeyup='unit_tax_calc1("+record.tg_id+")'; style='width: 5rem;' id='tax_percentage"+record.tg_id+"'  type='text'>"+
              " <input value='" + tax_rate + "' readonly style='width: 5rem;' id='tax_rate"+record.tg_id+"'  type='text'>"+
                " <input value='" + final_rate + "' readonly style='width: 8rem;' id='final_rate"+record.tg_id+"'  type='text'>"+
    
    "<a title='Qty Update Button' style='margin-left:-27px' onclick='edit_grn_qty("+record.tg_id+")'  ><i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;cursor: pointer'></i></a>"+
    " <a class='inv-req-btn' id='del_card"+record.tg_id+"' name='del_card"+record.tg_id+"' onclick='delete_grn("+record.tg_id+")'  style='width: 3rem;background-image: linear-gradient( 223deg,#cc1d35, #ff3a55)!important;color: #fff;cursor: pointer'>x</a>"+
    
    "</div>"+
    "</div>"
                    );
                   
                         }
                         

                         
                     });
                     
                      $("#product").focus();
                        $('#product').val('');
                 }
                 
                 });
                   
                   }else{
                   
       $('#load_error').show();
       
        if(unit_rate=='' || unit_rate=='0'){
       $('#load_error').text('ENTER UNIT RATE');
        $("#unit_rate").focus();
        }
        
       
       
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
       
       $('#load_error').text('BATCH NO ALREADY EXIST FOR PRODUCT');
       $("#batch_no").focus();
       $("#batch_no").val('');
       
        $('#load_error').delay(1000).fadeOut('slow');
                    
                   }    
                   
              }    
                    
        });  
        
                   
                   
                   
                   
                   
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
                     $("#exp_date").val('');
          $("#unit_rate").val('');
          $("#total_rate").val('');
           $("#tax_percentage").val('');
           $("#tax_rate").val('');
          $("#final_rate").val('');
        $('#load_error').delay(1000).fadeOut('slow');
                    
                   }    
                   
              }    
                    
        });  
        
        
        
                   
        }); 
       
    });
    
    
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
    
    function bottom_adj_calc(){  
    
          var adjustment = $("#adjustment").val();
          
           var grn_tot1=parseFloat($('#subtotal_bottom').val());
           var tax_tot=parseFloat($('#tax_rate_bottom').val());
           
         if(adjustment=='' && tax_tot>0 ) {
             
              $("#total_bottom").val((grn_tot1+tax_tot).toFixed(3));   
             
          }else if(adjustment=='' && (tax_tot<=0 || tax_tot=='' )){
              $("#total_bottom").val(grn_tot1.toFixed(3));    
          }
           
         
         if(tax_tot>0){
           var grn_tot=(grn_tot1+tax_tot);
         }else{
            grn_tot=grn_tot1;
        }
         
          if(adjustment.charAt(0)!= '+' && adjustment.charAt(0)!= '-' ){
              
              $("#adjustment").val('');
               $('#load_error').show();
       
                $('#load_error').text('ENTER PLUS OR MINUS  FIRST ');
     
               $('#load_error').delay(1000).fadeOut('slow');
         }
          
          
     
         
          if(adjustment.charAt(0)=='+'){
              
           var adj=  parseFloat($('#adjustment').val().replace('+','')); 
              
            var tot=grn_tot+adj;
          
         
            if(adjustment.charAt(1)!= '' ){
              
          $("#total_bottom").val('');
         $("#total_bottom").val(tot.toFixed(3));   
         
          }else{
              
            $("#total_bottom").val('');
            $("#total_bottom").val($('#grn_tot').val());
              
        }
         
        }else if(adjustment.charAt(0)=='-'){
            
              var adj=  parseFloat($('#adjustment').val().replace('-','')); 
            var tot=grn_tot-adj;
            
            
            if(adj>grn_tot){
                
             $("#adjustment").val('');
               $('#load_error').show();
               $("#total_bottom").val('');
                $('#load_error').text('ADJ VALUE MUST BE LESS THAN TOTAL');
     
               $('#load_error').delay(1000).fadeOut('slow');
               
            }
                
                
            
            
         if(adjustment.charAt(1)!= '' ){
              
          $("#total_bottom").val('');
         $("#total_bottom").val(tot.toFixed(3));   
         
          }else{
              
            $("#total_bottom").val('');
            $("#total_bottom").val($('#grn_tot').val());
              
         }
            
            
           }
             
    }
    
    
    
    function bottom_tax_calc(){
    
        var total_bottom= parseFloat($("#total_bottom").val());
       
          var tax_bottom= parseFloat($("#tax_bottom").val());
          
           var grn_tot=parseFloat($('#grn_tot').val());
          
          var tot=(grn_tot*tax_bottom)/100;
          
         
          if(tax_bottom >'0' &&  tax_bottom!= '' ){
          $("#total_bottom").val('');
         $("#total_bottom").val((grn_tot+tot).toFixed(3))   
         $("#tax_rate_bottom").val(tot.toFixed(3))    
       
          }else{
              
           $("#tax_rate_bottom").val('');
            $("#total_bottom").val('');
            $("#total_bottom").val($('#grn_tot').val())  ;
              
          }
    
    }
    
     function total_to_unit(){
     
         var qty        =  parseInt($('#qty').val()); 
          
         var rate_type    =  $('#rate_type').val(); 
         var unit_type    =  $('#unit_type').val();
            
         var weight= $("#weight").val();
         
         var total_rate= parseFloat($("#total_rate").val());
         
         if(rate_type=='Loose'){
             
             
          if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#unit_rate").val((total_rate/qty));
          
           $("#final_rate").val(total_rate);
           
             }else{
                 
                 $("#unit_rate").val((total_rate/weight));
          
                 $("#final_rate").val(total_rate);
           
            }
           
       }else if(rate_type=='Packet'){
           
         if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#unit_rate").val((total_rate/qty));
          
           $("#final_rate").val(total_rate);
           
             }else{
                 
                 $("#unit_rate").val((total_rate/qty));
          
                 $("#final_rate").val(total_rate);
           
            }
           
           
        }else if(rate_type=='Single'){
           
           var unit_rate= parseFloat($("#unit_rate").val());
          
          $("#unit_rate").val((total_rate/qty));
          
           $("#final_rate").val(total_rate);
           
        } 
           
           
            $("#tax_percentage").val('');
           $("#tax_rate").val('');
    }
    
    function total_to_unit1(id){
        
         var qty        =  parseInt($('#qty'+id).val()); 
          
         var rate_type    =  $('#rate_type'+id).val(); 
          var unit_type    =  $('#unit_type'+id).val();
            
            
         var weight= $("#weight"+id).val();
         
          var total_rate= parseFloat($("#total_rate"+id).val());
          
        
           if(rate_type=='Loose'){
             
          if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#unit_rate"+id).val((total_rate/qty));
          
           $("#final_rate"+id).val(total_rate);
           
             }else{
                 
                 $("#unit_rate"+id).val((total_rate/weight));
          
                 $("#final_rate"+id).val(total_rate);
           
            }
           
           }else if(rate_type=='Packet'){
           
           if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#unit_rate"+id).val((total_rate/qty));
          
           $("#final_rate"+id).val(total_rate);
           
             }else{
                 
                 $("#unit_rate"+id).val((total_rate/qty));
          
                 $("#final_rate"+id).val(total_rate);
           
            }
           
        }else if(rate_type=='Single'){
           
         
           $("#unit_rate"+id).val((total_rate/qty)); 
          
           $("#final_rate"+id).val(total_rate);
           
        }
        
        
    }
    
    
     function unit_rate_calc1(id){
     
         var qty        =  parseInt($('#qty'+id).val()); 
          
         var rate_type    =  $('#rate_type'+id).val(); 
          var unit_type    =  $('#unit_type'+id).val();
            
            
         var weight= $("#weight"+id).val();
         
          var unit_rate= parseFloat($("#unit_rate"+id).val());
          
        
           if(rate_type=='Loose'){
             
          if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#total_rate"+id).val((qty*unit_rate));
          
           $("#final_rate"+id).val((qty*unit_rate));
           
             }else{
                 
                 $("#total_rate"+id).val((weight*unit_rate));
          
                 $("#final_rate"+id).val((weight*unit_rate));
           
            }
           
           }else if(rate_type=='Packet'){
           
           if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#total_rate"+id).val((qty*unit_rate));
          
           $("#final_rate"+id).val((qty*unit_rate));
           
             }else{
                 
                 $("#total_rate"+id).val((qty*unit_rate));
          
                 $("#final_rate"+id).val((qty*unit_rate));
           
            }
           
        }else if(rate_type=='Single'){
           
         
           $("#total_rate"+id).val((qty*unit_rate));
          
           $("#final_rate"+id).val((qty*unit_rate));
           
        }
          
          
            $("#tax_percentage"+id).val('');
            $("#tax_rate"+id).val('');
   }



function unit_tax_calc1(id){
         
        $("#final_rate"+id).val('');
     
         var qty        =  $('#qty'+id).val(); 
          
         var rate_type    =  $('#rate_type'+id).val(); 
         var unit_type    =  $('#unit_type'+id).val();
            
         
        var unit_rate= parseFloat($("#unit_rate"+id).val());
          
        var total_rate= parseFloat($("#total_rate"+id).val());
           
        var percent=    $("#tax_percentage"+id).val();
        
        var tax_amt=((total_rate*percent)/100);
        
        
           $("#tax_rate"+id).val(tax_amt);
           
          $("#final_rate"+id).val((tax_amt+total_rate)); 
           
    }


     function unit_rate_calc(){
     
         var qty        =  parseInt($('#qty').val()); 
          
         var rate_type    =  $('#rate_type').val(); 
         var unit_type    =  $('#unit_type').val();
            
         var weight= $("#weight").val();
         
         var unit_rate= parseFloat($("#unit_rate").val());
         
         if(rate_type=='Loose'){
             
             
          if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#total_rate").val((qty*unit_rate));
          
           $("#final_rate").val((qty*unit_rate));
           
             }else{
                 
                 $("#total_rate").val((weight*unit_rate));
          
                 $("#final_rate").val((weight*unit_rate));
           
            }
           
       }else if(rate_type=='Packet'){
           
         if(unit_type=='Nos' || unit_type=='Single'){
                 
          $("#total_rate").val((qty*unit_rate));
          
           $("#final_rate").val((qty*unit_rate));
           
             }else{
                 
                 $("#total_rate").val((qty*unit_rate));
          
                 $("#final_rate").val((qty*unit_rate));
           
            }
           
           
        }else if(rate_type=='Single'){
           
           var unit_rate= parseFloat($("#unit_rate").val());
          
          $("#total_rate").val((qty*unit_rate));
          
           $("#final_rate").val((qty*unit_rate));
           
        } 
           
           
            $("#tax_percentage").val('');
           $("#tax_rate").val('');
    }
     
     
     function unit_tax_calc(){
         
          $("#final_rate").val('');
     
          var qty        =  $('#qty').val(); 
          
          var rate_type    =  $('#rate_type').val(); 
          
          var unit_type    =  $('#unit_type').val();
            
            
          var unit_rate= parseFloat($("#unit_rate").val());
          
          var total_rate= parseFloat($("#total_rate").val());
           
          var percent=    $("#tax_percentage").val();
        
          var tax_amt=((total_rate*percent)/100);
        
          $("#tax_rate").val(tax_amt);
           
          $("#final_rate").val((tax_amt+total_rate)); 
           
    }
    
   function cursor_loader(mode_in){
       
      
       if(mode_in=='P'){
           
         localStorage.focuser='Product';
       
     
       }else{
           
          
           localStorage.focuser='Barcode'; 
       }
       
         location.reload();
       
    }
    
    
     
 function barcode_entry(){
      
      
               var barcode = $("#barcode").val();
        
               var br_code=barcode.split('#');
                 
               if(br_code[1]!='' && br_code[1]!=undefined ){
               
               var new_menu1=br_code[0].substr(0,4);
              
              // var new_menu=  parseInt(new_menu1, 10);
               
               var weight_in=br_code[1].substr(0,5);
               
               var new_weight=(weight_in*1/1000);
              
              
           
               var dataString23 = 'set=search_barcode_plu&plu='+new_menu1;
				
                            $.ajax({
				type: "POST",
				url: "load_inventory.php",
				data: dataString23,
				success: function(data23) { 
                                    
                    var det= $.trim(data23).split('*');               
                                    
                                    
                  var menuid=det[1];
                      
               
                 $("#unit_rate").focus() ;
		 $("#product").val(det[0]);
                 $('#qty').val('1');
                 
                 $('#unit_rate').val('1');
                  $('#total_rate').val('1');
                  $('#final_rate').val('1');
                               
        $('#weight').val(new_weight);		
        $('#rate_type').val(det[2]);
        $('#unit_type').val(det[3]);
       // $('#barcode').val(barcode);
        
        $('#product').attr('menuid',menuid);  
      
       $('#batch_no').val('');
      
       $("#plusbtn").click();      
      
        setTimeout(function () {
       
        $('#barcode').focus();
        }, 500);    
       
        $('#qty').attr('readonly', true);
                                         
       // $('#weight').attr('readonly', true);
             
         //$('#barcode').prop('disabled',true);
        
        localStorage.barcode_length= $("#barcode").val().length;
        localStorage.name_length= $("#product").val().length;
        return false;
               
        
               
               
            
               
               
         }
         
        }); 
        
        
        
        }
        
   }
 
 
 
 
 
 
   function clear_name(){
     
      if((localStorage.name_length !=$('#product').val().length && localStorage.name_length >0) || (localStorage.barcode_length !=$('#barcode').val().length && localStorage.barcode_length >0)){
        
          
          $("#product").val('');
                     $("#barcode").val('');
                     $("#qty").val('');
                     $("#brand").val('');
                     $("#rate_type").val('');
                     $("#unit_type").val('');
                     $("#weight").val('');
          $("#exp_date").val('');
          $("#unit_rate").val('');
          $("#total_rate").val('');
           $("#tax_percentage").val('');
           $("#tax_rate").val('');
          $("#final_rate").val('');
          
          localStorage.name_length='0';
          localStorage.barcode_length='0';
        }
        
        $('#barcode').prop('disabled',false);
        $('#product').prop('disabled',false);
       
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
    if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode==189) {
        return false;
    }
    return true;
} 
  
  
   
     
     
     
 function delete_grn(id){
     
    
           
        var edit_id= $('#edit_id').val();  
           
        var req_add_id=$('#req_add_id').val();
          
        var data="set=delete_grn&id="+id+"&edit_id="+edit_id;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
         if($.trim(data)!='oneitem'){ 
             
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('DELETED');
         $('#load_error').delay(1000).fadeOut('slow'); 
             
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
            
        }else{
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('CANT DELETE ALL ITEMS . PLEASE CANCEL PURCHASE GRN FROM RPS HISTORY');
      
        $('#load_error').delay(2500).fadeOut('slow'); 
        }
         
        
       }
      });
            
    
  }
  
  function edit_grn_qty(id){
      
          $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM UPDATE');
        
      
        $('#confirm_pop_all').attr('mode','edit');
    
          $('#confirm_pop_all').attr('edit_id',id); 
     
        $('#hd_div').removeClass('disablegenerate');
     
       setTimeout(function () {
         
          $('#hd_div').addClass('disablegenerate');
        
        }, 2500); 
        
  
     
  }
  
  
  function isNumeric(n) {
      
    return !isNaN(parseFloat(n)) && isFinite(n);
    
   }
  
  
  function submit_grn(){
      
      if( $('#hidden_checker').val()>0){  
          
          
        var edit_id =  $('#edit_id').val(); 
          
        var purchase_date=$('#purchase_date').val(); 
          
        var store=$('#store').val();
        
        var supplier=$('#supplier').val();
         
        var invoice_no=$('#invoice_no').val();
         
         
        var remarks_grn_new=$('#remarks_grn_new').val();
         
        var adj_chk=$('#adjustment').val();  
          
        if(isNumeric(adj_chk) || adj_chk=='') {
            
             var adj1='ok';
            
        }else{ 
                  
               var adj1='notok';
        }
         
          
        if(store!='' && supplier!='' && invoice_no!='' && purchase_date!='' && adj1=='ok' ){
            
        var data1="set=add_grn_all_from_purchase";
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data1,
        success: function(data2)
        {
            if($.trim(data2)=='yes'){
                
        var data1="set=check_grn_invoice&invoice="+invoice_no+"&edit_id="+edit_id+"&supplier="+supplier;
            
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data1,
        success: function(data22)
        {
            
        if($.trim(data22)=='yes'){    
                
        var total_bottom= parseFloat($("#total_bottom").val());
       
        var tax_bottom1= parseFloat($("#tax_bottom").val());
          
        var grn_tot=parseFloat($('#subtotal_bottom').val());
          
        var tax_rate_bottom1= $("#tax_rate_bottom").val();
        
        
        if(tax_rate_bottom1==''){
            
           var tax_rate_bottom='0';
           
        }else{
           var tax_rate_bottom=tax_rate_bottom1;   
            
        }
        
        if(tax_bottom1==''){
            
           var tax_bottom='0';
           
        }else{
           var tax_bottom=tax_bottom1;   
            
        }
        
        var adjustment=$('#adjustment').val();  
            
        if(adjustment==''){
                
          var adj='0';
         
        }else{
                
          var adj=adjustment;   
        
        }
            
         
       $('#submit_grn').hide();
             
       var data="set=add_grn_all&store="+store+"&supplier="+supplier+"&total_bottom="+total_bottom+"&tax_bottom="+tax_bottom+"&grn_tot="+grn_tot+
        "&tax_rate_bottom="+tax_rate_bottom+"&invoice_no="+invoice_no+"&adj="+adj+"&purchase_date="+purchase_date+"&edit_id="+edit_id+
        "&remarks_grn_new="+remarks_grn_new;
       
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
         
         $('#load_error').show();
         $('#load_error').css('color','green');
       
        if(edit_id!=''){ 
            $('#load_error').text('STOCK UPDATE SUCCESSFULL'); 
         }else{
            $('#load_error').text('STOCK ENTRY SUCCESSFULL');
        }
       
      
        $('#load_error').delay(1000).fadeOut('slow');
           setInterval(function () {
          
          if(edit_id!=''){
              
       var search_id=$('#id_flt').val();
      
       var status=$('#status_flt').val();
     
       var from=$('#from_flt').val();
     
       var to=$('#to_flt').val();
     
       var type=$('#type_flt').val();
              
           window.location.href="history.php?from="+from+"&to="+to+"&type="+type+"&status="+status+"&search_id="+search_id+"&filter=ok";
              
              
          }else{
               window.location.href='stock_entry.php';  
               
          }
              
        
            }, 500); 
           
        }
    });
    
    
     }else{
                
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('INVOICE NO EXIST');
      
          $('#load_error').delay(1000).fadeOut('slow'); 
      }
    
     }
    });
    
    
    
    
       }else{
                
         $('#load_error').show();
         $('#load_error').css('color','red');
         $('#load_error').text('ENTER ALL PRODUCTS UNIT RATE');
         $('#load_error').delay(1000).fadeOut('slow'); 
         
        }
    
     }
    });
    
    
        } else{
            
            $('#load_error').show();
         $('#load_error').css('color','red');
         
         if(adj1=='notok'){
       $('#load_error').text('ENTER ADJUSTMENT VALUE CORRECTLY');
           $('#store').focus();
         }
         
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
      
          if(purchase_date==''){
       $('#load_error').text('SELECT DATE');
       $('#purchase_date').focus();
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
    
    
    function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
       if(mode=='edit'){
           
          var id = $('#confirm_pop_all').attr('edit_id'); 
           
           var qty=  parseFloat($('#qty'+id).val());
           
          var weight= parseFloat($("#weight"+id).val());
         
          var unit_rate= $("#unit_rate"+id).val();
          var total_rate= $("#total_rate"+id).val();
          var tax_percentage= $("#tax_percentage"+id).val();
          var tax_rate= $("#tax_rate"+id).val();
          var final_rate= $("#final_rate"+id).val();
           
          var exp_date= $("#exp_date"+id).val();
            
         if(unit_rate>'0' && qty>'0' && weight>'0'  ){
            
          var data="set=update_grn_qty&id="+id+"&qty="+qty+"&weight="+weight+"&unit_rate="+unit_rate+"&total_rate="+total_rate
          +"&tax_percentage="+tax_percentage+"&tax_rate="+tax_rate+"&final_rate="+final_rate+"&exp_date="+exp_date;
          
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
         
         if(unit_rate<='0' || unit_rate=='' ){
            $('#load_error').text('ENTER UNIT PRICE');
            $("#unit_rate"+id).focus();
         }
         
         if(qty<='0' || qty=='' ){
              $('#load_error').text('ENTER QTY');
              $("#qty"+id).focus();
         }
         
         
          if(weight<='0' || weight=='' ){
             $('#load_error').text('ENTER WEIGHT');
             $("#weight"+id).focus();
         }
      
        $('#load_error').delay(1000).fadeOut('slow');
    }
           
       }else{
       
            var data1="set=clear_stock_all";

             $.ajax({
             type: "POST",
             url: "load_inventory.php",
             data: data1,
             success: function(data2)
             {
               location.reload();  
           }
           });
    
      }
    
    
}
    
    function clear_all(){
        
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM CLEAR ALL?');
        
        
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