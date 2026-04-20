<?php
include('includes/session.php');		
//session_start();
include("database.class.php"); 
$database	= new Database();


 $sql_login  =  $database->mysqlQuery("insert into tbl_inv_kitchen(ti_name,ti_status,ti_type)values('Main Store','Y','main') "); 


?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Inventory</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
            $(document).ready(function () {
            
  $("#datepickerfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
     changeYear: true,
	  maxDate: "+0D "
    });
    
        });          
        
        
 function confirm_yes_new(){
     
     var mode= $('#confirm_pop_all').attr('mode'); 
     
     if(mode=='stock'){
     $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "set=update_inv_stock",
			success: function(msg)
			{
                        $('#error_pop').show();
                         
                        $('#error_pop').text('ITEM STOCK TO ZERO FOR ALL ITEMS UPDATED');
                        $('#error_pop').delay(3000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='inv_kitchen.php';
                            
                        }, 1000); 
                             
                        }
                    });
                    
        }
        
      if(mode=='store'){
          
            $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "set=update_inv_kitchen_mmenu",
			success: function(msg)
			{
                            
                        $('#error_pop').show();
                         
                        $('#error_pop').text('KITCHEN-STORE UPDATED AS MAIN STORE FOR ALL ITEMS');
                        $('#error_pop').delay(3000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='inv_kitchen.php';
                            
                        }, 2000); 
                             
                        }
                    });
          
          
      }   
        
     
     $('#confirm_pop_all').hide();
                
     $('#pop_head_com').text('');
 }
        
        function sync_stock_update(){
          
          $('#confirm_pop_all').show();
           $('#confirm_pop_all').attr('mode','stock');       
         $('#pop_head_com').text(' SET INVENTORY ITEMS STOCK TO ZERO FOR ITEMS IN STORE STOCK  ?');
        
    }
        
        
       function sync_kitchen_update(){
           
           $('#confirm_pop_all').show();
                
         $('#pop_head_com').text(' SET KITCHEN-STORE UPDATED AS MAIN STORE FOR ALL ITEMS  ?');
           
           $('#confirm_pop_all').attr('mode','store'); 
           
        
    }
        
function kitchen_update(){
    
       var type=$('#type').val();
      var name=$('#name').val();
      var status=$('#status').val();
       var id=$('#name').attr('kitchen');
       
      
       
      if(name!='' && type!=''){
     $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "set=update_inv_kitchen&name="+name+"&status="+status+"&id="+id+"&type="+type,
			success: function(msg)
			{
                        $('#error_pop').show();
                         
                        $('#error_pop').text('KITCHEN-STORE UPDATED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='inv_kitchen.php';
                            
                        }, 500); 
                             
                        }
                    });
                    
                    }else{
                        
                         $('#error_pop').show();
                        if(type==''){
                         $('#error_pop').text('SELECT STORE');
                       $('#type').focus(); 
                         }
                         
                         if(name==''){
                         $('#error_pop').text('ADD NAME');
                       $('#name').focus(); 
                         }
                       $('#error_pop').delay(2000).fadeOut('slow');
                       
                    }                    
           
}


function kitchen_add(){
    
      var type=$('#type').val();
      var name=$('#name').val();
      var status=$('#status').val();
      
      if(name!='' && type!=''){
     $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "set=add_inv_kitchen&name="+name+"&status="+status+"&type="+type,
			success: function(msg)
			{
                        $('#error_pop').show();
                         
                        $('#error_pop').text('KITCHEN-STORE ADDED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                          window.location.href='inv_kitchen.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                    
                    }else{
                        
                         $('#error_pop').show();
                         if(type==''){
                         $('#error_pop').text('SELECT STORE');
                       $('#type').focus(); 
                         }
                         
                         if(name==''){
                         $('#error_pop').text('ADD NAME');
                       $('#name').focus(); 
                         }
                       
                       $('#error_pop').delay(2000).fadeOut('slow');
                       
                    }                    
             
}


function edit_kitchen(i,n,s,t){
    
  $('#name').attr('kitchen',i);
        $('#name').val(n);
       
       $('#status').val(s);
       
       $('#type').val(t); 
       
        $('#add_btn').hide();
          $('#upd_btn').show();
         $('#upd_btn').css('background-color', '#c58f2e');  
        $('#name').focus();
        
}

function barcode_update(){
  $('#add_stock_pop1').show(); 
}


function go_barcode(){
    
    
     var from=$('#from_br').val();
     
      var to=$('#to_br').val();
      
      if(from==to){
          
         
          
          $('#error_pop').show();
                         
                        $('#error_pop').text('FROM AND TO CANT BE SAME');
                        $('#error_pop').delay(2000).fadeOut('slow');
          
          
      }else{
          
                        $('#error_pop').show();
                         
                        $('#error_pop').text('COPYING');
                        $('#error_pop').delay(10000).fadeOut('slow');
          
          $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=barcode_copy&from="+from+"&to="+to,
			success: function(msg)
			{
                           
                          
                            
                             $('#error_pop').show();
                         
                        $('#error_pop').text('SUCESSFULLY COPIED');
                        $('#error_pop').delay(2000).fadeOut('slow');
          
                            
                            location.reload();
                        }
                    });
          
      }
    
}

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
.ledger_list_scr{width:100%;height:auto;float:left;height:63vh;float:left;margin-top:5px;}
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
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">


</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer"></a></li>
                      <?php if(isset($_REQUEST['msg'])){ ?>
                        <div class="load_error alertsmasters"><?=$alert?></div>
                        <script >
                       $(".load_error").delay(2000).fadeOut('slow');
                        </script>
                        <?php } ?>
				</ul>
            </div><!-- breadcrumbs -->


           
                
            

                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div><!--cc_new-->

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <h3 class="ledger_head">INVENTORY KITCHEN - STORE   <span id="error_ledger" style="float:right;color:black;display: none;font-size: 20px;background-color: #ff4229;border-radius: 5px "></span></h3>

                                
                                
                                <div class="acc_add_box" style="width:14%;">
                             	   
                                    <input type="text" class="form-control filte_new_box"  id="name" name="name" placeholder="Name">
                                </div>
                                
                                 <div class="acc_add_box bank_cash_div" style="width:15%;display: block">
                             	    
                                    <select id="type" class="form-control filte_new_box">
                                         
                                       
                                         <option value="sub">Sub Store</option>
                                    </select>
                                </div>
                                
                                <div class="acc_add_box bank_cash_div" style="width:10%;display: block">
                             	    
                                    <select id="status" class="form-control filte_new_box">
                                        <option value="Y">Active</option>
                                         <option value="N">Inactive</option>
                                    </select>
                                </div>
                                
                                
                                
                                <div style="margin-left:2%;width: 18%;" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn" onclick="return kitchen_add();" style="margin-top:0;cursor: pointer;width: 34px;"  >ADD</a>
                                <a id="upd_btn" onclick="return kitchen_update();" style="margin-top:0;display: none;width: 42px; "  href="#">UPDATE</a>
                                
                                 <?php  if($_SESSION['expodine_id']=='admin'){  ?>
                                
                                <a title="All Items store will be set as main store" onclick="return sync_kitchen_update();" style="top: 20px;float: right;right: 125px;padding: 3px;position: absolute "  href="#">SYNC AS MAIN </a>
                              
                                
                               <a title="All Item Stock will be set to zero " onclick="return sync_stock_update();" style="top: 20px;float: right;right: 225px;padding: 3px;position: absolute;background-color: darkred;color: white;font-weight: bold "  href="#">SET STOCK 0</a>
                              
                               
                               <a title="All Items Barcode Copier " onclick="return barcode_update();" style="top: 20px;float: right;right: 310px;padding: 3px;position: absolute;background-color: darkred;color: white;font-weight: bold "  href="#">COPY BARCODE</a>
                              
                               
                               
                                 <?php } ?>
                                
                                
                              <a  style="top: 20px;float: right;right: 12px;padding: 3px;position: absolute;background-color: #598562 "  href="inventory/index.php">GO TO INVENTORY </a>
                              
                              
                              
                                </div>
                                
                                
                                
                                
                            </div>  

                            
                       
                            
                            <div class="ledger_list_sec" style="position:relative">
                                <!-- <h3 style="font-size:18px" class="ledger_head"> &nbsp;</h3> -->
                                <div style="position:absolute;width: 120px;right:9px;top:3px;height: 33px;float: left" class="search_btn_member_invoice filte_new_box_btn">
                                   
                                    <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;display: none" onclick="return pop_on();" href="#">ADD PAYMENT</a></div>
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">SL</td>
                                                <td style="width:30%"> Name</td>
                                                <td style="width:30%"> Type</td>
                                                <td style="width:30%"> Status</td>
                                                   <td style="width:30%"> Action</td>
                                            </tr>
                                        </thead>
                                        <tbody id="load_acc_new">
                                 <?php $i=1;
	 $sql_login  =  $database->mysqlQuery("select * from tbl_inv_kitchen"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			
	 ?> 
                                            <tr>
                                                
                                                <td style="width:5%"><?=$i++?></td>
                                                <td style="width:30%"><?=$result_login['ti_name']?></td>
                                                  <td style="width:30%"><?=$result_login['ti_type']?></td>
                                                 <td style="width:30%"><?=$result_login['ti_status']?></td>
                                                 <td ><a onclick="edit_kitchen('<?=$result_login['ti_id']?>','<?=$result_login['ti_name']?>','<?=$result_login['ti_status']?>','<?=$result_login['ti_type']?>')" style="width:30%;cursor: pointer;color:black;<?php if($result_login['ti_type']=='main'){ ?> pointer-events:none <?php  } ?> ">  <?php if($result_login['ti_type']!='main'){ ?>  <i class="fa fa-edit"></i>  <?php  }else{ ?> <i class="fa fa-close"></i>  <?php  } ?> </a>  </td>
                                            </tr>
                                            
                                            
          <?php }  } ?>   
                                            
                                            
                                        
                                     </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
 
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->


      
            <div class="md-overlay"></div><!-- the overlay element -->                       
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

            
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>


 <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
 <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop1">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#add_stock_pop1').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt" id="cus_div">
            <span style="font-size:10px;font-weight: bold;color: darkred">SELECT FROM AND TO SECTION ? </span> 
            <br> 
            &nbsp;  From  &nbsp;<select id="from_br">
                <option value="item">Item Raw Barcode</option>
                <option value="rate">Rate Master Barcode</option>
            </select> 
            <br>  <br>
            &nbsp;   To &nbsp; <select style="margin-left: 10px;" id="to_br">
                <option value="item">Item Raw Barcode</option>
                <option value="rate">Rate Master Barcode</option>
            </select> 
            
        <a  onclick="go_barcode();" href="#"><div style="width:24%" class="stock_add_btn">GO</div></a>
            
        </div>
        
        
        
    </div>
   </div>


</body>
</html>
