<?php
//include('includes/session.php');		
session_start();
include("../database.class.php"); 
$database	= new Database();

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Asset</title>
<meta name="description" content="">
<link href="../images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="../master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="../css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="../master_style/website.css" type="text/css">
<link rel="stylesheet" href="../master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="../css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="../master_style/demo.css">	
<link rel="stylesheet" href="../master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="../master_style/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/component.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/component.css" />
 <link href="../master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="../css/als_demo.css" />
 
  <link rel="stylesheet" href="../css/style_date.css">
  <link href="../loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
 
 
 <script src="../js/jquery-1.10.2.min.js"></script>
<script src="../master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
    .table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
    #leftNavigation #new_tab_btn ul li {margin-top: 0px;height: 35px;padding: 0 !important; width: 100%; display: inherit !important;}
    #leftNavigation #new_tab_btn ul li a{font-size: 12px !important;background-color: transparent !important; color: #000;}
    #leftNavigation > #new_tab_btn ul { border-bottom: 2px #120811 solid; background-color: #fff; width: 96.5%; margin-left: 5px; overflow: hidden;}#leftNavigation > #new_tab_btn a {background-color: #891500;}
</style>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
            $(document).ready(function () {
             
             
    var data_v="set=search_asset_category&c_name=";
    
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                            
                        $('#load_data_asset').html(msg);
                             
                        }
                    });    
                    
                    
                    
          var data_vm="set=search_asset_master&cm_name=";
    
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_vm,
			success: function(msg)
			{
                            
                        $('#load_asset_master').html(msg);
                             
                        }
                    });              
                    
                    
             
        });          
        
      

</script>



<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:450px;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">


</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu_account.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="../index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Accounts</a></li>
                     
				</ul>
            </div><!-- breadcrumbs -->

            
            
 
            <div class="col-md-12">
                        
                    

           </div>
               
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                              
                             
                              

                            <div class="ledger_list_sec" style="position:relative;padding: 0 5px;">
                             
                             <div class="col-md-6" style="padding-left:0;border-right:2px #e5e5e5 solid">

                             <div style="margin-bottom:0;background: #fff;" class="cc_new">
                                        <div style="border: 0 !important " id="lista1" class="als-container">
                                            <h3 style="float: left;margin-top: 10px;margin-left: 0px;">ASSET CATEGORY</h3>
                                        <div style="width: 140px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                                        <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;" onclick="popup()"  href="#">ADD ASSET CATEGORY</a></div>
                                        
                                    </div>
                                    </div>
                             
                                    <div class="acc_add_box" style="width:40%;">
                                    <label style="margin: 0;">Category Name</label>
                                    <input type="text" class="form-control filte_new_box" id="c_name_src" onkeyup="return search_asset_cat();" >
                                </div>

                                <div class="ledger_list_scr">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">#</td>
                                                 <td style="width:10%">Action</td>
                                                 <td style="width:30%">Category</td>
                                                  <td style="width:5%">Order</td>
                                                <td style="width:15%">Status</td>
                                            </tr>
                                        </thead>
                                        <tbody id="load_data_asset" >
                                        
                                             
                                            
                                        
                                     </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="col-md-6" style="padding-right:0">

                                <div style="margin-bottom:0;background: #fff;" class="cc_new">
                                        <div style="border: 0 !important " id="lista1" class="als-container">
                                            <h3 style="float: left;margin-top: 10px;margin-left: 10px;">ASSET MASTER</h3>
                                        <div style="width: 140px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                                        <a class="md-trigger" data-modal="modal-18" style="background-color:#314b6b;margin:0;line-height: 32px;"  href="#" onclick="popup()">ADD ASSET MASTER</a></div>
                                        
                                    </div>
                                </div>

                                <div class="acc_add_box" style="width:40%;">
                                    <label style="margin: 0;">Asset Name</label>
                                    <input type="text" class="form-control filte_new_box" id="cm_name_src" onkeyup="return search_asset_master();" >
                                </div>
                               
                             
                                <div class="ledger_list_scr">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">#</td>
                                                 <td style="width:10%">Action</td>
                                                <td style="width:17%">Asset Name</td>
                                                <td style="width:18%">Category</td>
                                                <td style="width:5%">Depreciation</td>
                                                <td style="width:10%">Status</td>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="load_asset_master" >
                                        
                                            
                                        
                                     </tbody>
                                    </table>
                                </div>
                            </div>



                            </div>


                            



                        </div>
 
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->








<div  class="md-modal md-effect-16 printer_add_popup cat_pop" id="modal-17" style="top:0;width:100%;height:100%">
			<div style="width:600px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0"> ADD ASSET CATEGORY</h3>
                                <div href="" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                    
                     <div class="col-md-4">
                     <div class="group" >   
                         <input type="text" placeholder="" id="c_name">   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label >Asset Category</label>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="group">   
                            <input type="text" maxlength="3" id="c_order" onkeypress="return numdot(event);">   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Display Order</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="group" id="">   
                        <select class="add_printer_drop" id="c_status"> 
                            <option value="">Select</option>
                            <option value="Active">Active </option>
                            <option value="Inactive">Inactive </option>
                        </select>
                        <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Status</label>
                        </div>
                    </div>

                    
                  
                  
                    </div>
                      
                    <a id='add_btn' onclick="return add_asset_category();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                    <a style="display: none " id='upd_btn' onclick="return update_asset_category();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>

                   

                </div>
                       
            </div>
</div>   

<div  class="md-modal md-effect-16 printer_add_popup master_pop" id="modal-18" style="top:0;width:100%;height:100%">
			<div style="width:600px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop1" style="margin-bottom:0"> Add ASSET MASTER </h3>
                                <div href="" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                    
                     <div class="col-md-4">
                     <div class="group" >   
                         <input type="text" placeholder="" id="cm_name">   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label >Asset Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="group" id="">   
                        <select class="add_printer_drop" id="cm_asset_cat"> 
                            <option value="">Select</option>
                            
                            <?php 
                            $sql_kotlist  =  $database->mysqlQuery("SELECT tsc_id,tsc_name from tbl_asset_category  where tsc_status='Active' "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=0;
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { ?>                                                 
                            <option value="<?=$result_kotlist['tsc_id']?>"><?=$result_kotlist['tsc_name']?></option>
                            <?php } }?>
                        </select>
                        <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Asset Category</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                    <div class="group" id="">   
                        <select class="add_printer_drop" id="cm_status"> 
                           <option value="">Select</option>
                            <option value="Active ">Active </option>
                            <option value="Inactive ">Inactive </option>
                        </select>
                        <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Status</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                     <div class="group" >   
                         <input type="text" placeholder="" id="cm_dep" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label >Depreciation %</label>
                        </div>
                    </div>
                    
                    
                    
                  

                    
                  
                  
                    </div>
                      
                    <a id='add_btn1' onclick="return add_asset_master();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                    <a style="display: none " id='upd_btn1' onclick="return update_asset_master();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>

                   

                </div>
                       
            </div>
</div>   



            <div class="md-overlay"></div><!-- the overlay element -->                       
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

</script>

<script type="text/javascript">
  function numdot(e) {     
   
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
    
    function close_pop(){
        window.location.href='contra_voucher.php';
    }
    
function popup()
{
    $("#cm_name").val('');
    $("#cm_asset_cat").val('');
    $("#cm_status").val('');
    $("#cm_dep").val('');
    $("#c_name").val();
    $("#c_order").val('');
    $("#c_status").val('');
    $('#head_pop').text('ADD ASSET CATEGORY ');
    $('#head_pop1').text('ADD ASSET MASTER ');
    $('#add_btn1').show();
    $('#upd_btn1').hide();
    $('#add_btn').show();
    $('#upd_btn').hide();
}
    
    function add_asset_category(){ 
        
  var c_name=$('#c_name').val();
  var c_order=$('#c_order').val();
  var c_status=$('#c_status').val();
  
           
    if(c_name!='' && c_order!=''  ){
        
        var data_v="set=set_asset_cat_check&c_name="+c_name;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg1)
			{
       if($.trim(msg1) !='no'){
        
        var data_v="set=add_asset_category&c_name="+c_name+"&c_order="+c_order+"&c_status="+c_status;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('ADDED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                          window.location.href='asset_master.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                    
        }else{
            $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         $('#error_pop_v').text('NAME ALREADY EXIST');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
             $('#c_name').focus();
        }
         }
                    });
        
    }else{
        
        $('#error_pop_v').show();
        
          if(c_order==''){
        $('#error_pop_v').text('ENTER ORDER ');
        $('#c_order').focus();
         }
         
         if(c_name==''){
        $('#error_pop_v').text('ENTER NAME');
        $('#c_name').focus();
         }
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
        
    }
    
   function search_asset_cat(){
       
       var c_name=$('#c_name_src').val();
       
       
       var data_v="set=search_asset_category&c_name="+c_name;
    
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                            
                        $('#load_data_asset').html(msg);
                             
                        }
                    });     
   } 
    
  
    
    function edit_asset_cat(vid){
        
        
        $('#add_btn').hide();
        $('#upd_btn').show();
        
    
    $('.cat_pop').addClass('md-show');
    $('#head_pop').text('UPDATE ASSET CATEGORY ');
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_asset_cat&edit_id="+vid,
			success: function(msg)
			{
                          
                       var ed1=$.trim(msg);
                       
                       var ed=ed1.split('*');
                         
  $('#c_name').attr('voucher_update_id',vid);
  $('#c_name').val(ed[0]);
 
  $('#c_order').val(ed[1]);
  $('#c_status').val(ed[2]);
       
                        }
       });
       
}

function update_asset_category(){
     
     
  var c_name=$('#c_name').val();
  var c_order=$('#c_order').val();
  var c_status=$('#c_status').val();
  
  
    var update_id=$('#c_name').attr('voucher_update_id');
           
    if(c_name!='' && c_order!='' ){
        
        
         var data_v="set=set_asset_cat_check_update&c_name="+c_name+"&update_id="+update_id;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg1)
			{
       if($.trim(msg1) !='no'){
        
        var data_v="set=update_asset_category&c_name="+c_name+"&c_order="+c_order+"&c_status="+c_status+"&update_id="+update_id;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('UPDATED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                         window.location.href='asset_master.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
        }else{
            $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         $('#error_pop_v').text('NAME ALREADY EXIST');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
            $('#c_name').focus();
        }
                        }
                    });
        
    }else{
        
        $('#error_pop_v').show();
        
        
         
        if(c_order==''){
        $('#error_pop_v').text('ENTER ORDER ');
        $('#c_order').focus();
         }
         
         if(c_name==''){
        $('#error_pop_v').text('ENTER NAME');
        $('#c_name').focus();
         }
         
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
     
    }

function search_asset_master(){
       
       var cm_name=$('#cm_name_src').val();
       
       
       var data_v="set=search_asset_master&cm_name="+cm_name;
    
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                            
                        $('#load_asset_master').html(msg);
                             
                        }
                    });     
   } 

function add_asset_master(){
  var cm_name=$('#cm_name').val();
  var cm_cat=$('#cm_asset_cat').val();
  var cm_status=$('#cm_status').val();
   var cm_dep=$('#cm_dep').val();
           
    if(cm_name!='' && cm_cat!='' ){
        
        var data_v="set=add_asset_master&cm_name="+cm_name+"&cm_cat="+cm_cat+"&cm_status="+cm_status+"&cm_dep="+cm_dep;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('ADDED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                          window.location.href='asset_master.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        
          if(cm_cat==''){
        $('#error_pop_v').text('SELECT CATEGORY  ');
        $('#cm_asset_cat').focus();
         }
         
         if(cm_name==''){
        $('#error_pop_v').text('ENTER NAME');
        $('#cm_name').focus();
         }
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
        
}


function edit_asset_master(vid1){
    $('#add_btn1').hide();
        $('#upd_btn1').show();
        
    
    $('.master_pop').addClass('md-show');
    $('#head_pop1').text('UPDATE ASSET MASTER ');
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_asset_master&edit_id="+vid1,
			success: function(msg)
			{
                          
                       var ed1=$.trim(msg);
                       
                       var ed=ed1.split('*');
                         
  $('#cm_name').attr('voucher_update_id1',vid1);
  $('#cm_name').val(ed[0]);
 
  $('#cm_asset_cat').val(ed[1]);
  $('#cm_status').val(ed[2]);
   $('#cm_dep').val(ed[3]);
       
                        }
       });
}

function update_asset_master(){
     
     
  var c_name=$('#cm_name').val();
  var c_cat=$('#cm_asset_cat').val();
  var c_status=$('#cm_status').val();
  var c_dep=$('#cm_dep').val();
  
  
    var update_id=$('#cm_name').attr('voucher_update_id1');
           
    if(c_name!='' && c_cat!='' ){
        
        var data_v="set=update_asset_master&c_name="+c_name+"&c_cat="+c_cat+"&c_status="+c_status+"&update_id="+update_id+"&c_dep="+c_dep;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{ 
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('UPDATED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                        window.location.href='asset_master.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        
        
         
        if(c_cat==''){
        $('#error_pop_v').text('SELECT CATEGORY ');
        $('#cm_asset_cat').focus();
         }
         
         if(c_name==''){
        $('#error_pop_v').text('ENTER NAME');
        $('#c_name').focus();
         }
         
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
     
    }

    </script>




<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
