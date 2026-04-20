<?php
include('../includes/session.php');		
//session_start();
include("../database.class.php"); 
$database	= new Database();

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Accounts</title>
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
 <script src="../js/jquery-1.10.2.min.js"></script>
<script src="../master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
</style>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>

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
                     
                        

                        <div class="col-md-12" style="padding:0 1px;">
                            <div class="ledger_head_sec" style="">  
                                <h3 class="ledger_head">DAYWISE OPEN - CLOSE BALANCE ENTRY <span id="error_ledger" style="float:right;color:black;display: none;font-size: 20px;background-color: #ff4229;border-radius: 5px "></span></h3>

                                <div style="display:none">
                                
                                <div class="acc_add_box" style="width:20%;">
                             	    
                                    <select id="open_ledger" class="form-control filte_new_box" onchange="change_open_close();" >
                                        <option value="">Select Ledger Account </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_ledger_name from tbl_ledger_master   "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlm_id']?>"><?=$result_login['tlm_ledger_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                             	   
                                    <input  value="<?php echo date('Y-m-d'); ?>" autocomplete="off" onchange="change_open_close();" type="text" class="form-control filte_new_box datepicker1" id="open_date" name="" placeholder="Date">
                                </div>
                                
                                <div class="acc_add_box" style="width:15%;">
                             	
                                    
                                    <input type="text" readonly  class="form-control filte_new_box" onkeypress="return numdot_dot(this,event);" id="open_bal" name="" placeholder="Opening Balance ">
                                </div>
                            
                                
                                <div class="acc_add_box" style="width:15%;">
                             	   
                                    <input type="text"   class="form-control filte_new_box" readonly onkeypress="return numdot_dot(this,event);"  id="close_bal" name="" placeholder="Closing Balance ">
                                </div>
                                    
                                <div style="margin-left:2%;width:auto" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn_ledger" onclick="return ledger_add();" style="margin-top:0;cursor: pointer;width: 50px "  >ADD</a>
                                <a id="upd_btn_ledger" onclick="return ledger_update();" style="margin-top:0;display: none;width: 80px "  href="#">UPDATE</a>
                                 
                            </div> 
                           
                            <div style="margin-left:2%;width:10%;" class="search_btn_member_invoice filte_new_box_btn">
                                
                                <a   style="margin-top:0;display: block;width: 80px ;background-color: #9c5858"  href="open_close_account.php">REFRESH</a>
                            </div>
                                 </div>   
                            
                             <div class="ledger_head_sec" style="">  
                                 
                                <h3 class="ledger_head">SEARCH   <span id="error_ledger" style="float:right;color:black;display: none;font-size: 20px;background-color: #ff4229;border-radius: 5px "></span></h3>

                                <div class="acc_add_box" style="width:20%;">
                             	    
                                    <select id="s_ledger" class="form-control filte_new_box" onchange="search_data();" >
                                        <option value=""> Ledger Account </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_ledger_name from tbl_ledger_master   "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlm_id']?>"><?=$result_login['tlm_ledger_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                <?php  $date = date('Y-m-d'); ?>
                                <div class="acc_add_box" style="width:20%;">
                             	   
                                    <input   type="text" class="form-control filte_new_box " value=<?=$date;?>  onchange="datechange()" id="s_date" name="" placeholder="Start Date">
                                </div>
                                     
                                <div class="acc_add_box" style="width:20%;">
                             	   
                                    <input  type="text" class="form-control filte_new_box " value=<?=$date;?>   onchange="datechange()" id="e_date" name="" placeholder="End Date">
                                </div>

                            </div> 
                            <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="today">
                            <div class="ledger_list_sec" style="position:relative">
                                <h3 style="font-size:18px" class="ledger_head"> &nbsp;</h3>
                                <div style="position:absolute;width: 120px;right:9px;top:3px;height: 33px;float: left" class="search_btn_member_invoice filte_new_box_btn">
                                   
                                    <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;display: none" onclick="return pop_on();" href="#">ADD PAYMENT</a></div>
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                <td style="width:5%">SL</td>
                                                 <td style="width:30%">Ledger Acc</td>
                                                <td style="width:30%">Date</td>
                                                <td style="width:20%">Open Bal</td>
                                                <td style="width:20%">Close Bal</td>
                                               
                                                 <!-- <td style="min-width:80px;width:25%">Edit</td> -->
                                            </tr>
                                        </thead>
                                        <tbody id="load_data">
                                     </tbody>
                                    </table>
                                </div>
                               
                            </div>
                            <div>
                            <div id="show_text"></div>
                            <div id="show_pagination" style="position: absolute;bottom: 11px;right: 6px;"></div>
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
            
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
 <!-- <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>            -->
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>

<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
    search_data(); 

    $(".datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
            });

    $("#s_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
            });

    $("#e_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
            });

   $("#listall").tablesorter();
   
}); 


//jQuery(document).ready(function(){
            
            // setTimeout(function()
            // { 
     var today = $("#today").val();                              
             $.ajax({
                      type: "POST",
                      url: "load_ledger.php",
                      data: "set=open_ledger_daywise&date="+today,
                      success: function(msg1)
                      {                                   
           $.ajax({
                      type: "POST",
                      url: "load_ledger.php",
                      data: "set=close_ledger_daywise&date="+today,
                      success: function(msg)
                      {                                   
                }
                });    
            }
              });
              //}, 5000);     	
             // });   

        
function ledger_update(){
    
     var date=$('#open_date').val();
      var open=$('#open_bal').val().replace(',','');
      var close=$('#close_bal').val().replace(',','');
      var ledger=$('#open_ledger').val();
      
      var id =$('#upd_btn_ledger').attr('grp_id_upd_ledger');
      
      if(date!='' && open!='' && close!='' && ledger!='' ){
        
        
      $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=update_openclose_acc&date="+date+"&open="+open+"&close="+close+"&ledger="+ledger+"&upd_id="+id,
			success: function(msg)
			{
                        $('#error_pop').show();
                         
                        $('#error_pop').text(' UPDATED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='open_close_account.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                    
                    
                }else{
                    
                       
                    $('#error_pop').show();
                    
                     if(ledger==''){
                       $('#error_pop').text('Select Staff ');
                       $('#open_ledger').focus();
                    }

                 if(close==''){
                       $('#error_pop').text('Enter Closing Balance ');
                       $('#close_bal').focus();
                 }
                 
                 if(open==''){
                      $('#error_pop').text('Enter Opeing Balance ');
                      $('#open_bal').focus();
                 }
                 
                if(date==''){
                     $('#error_pop').text('Select Date');
                     $('#open_date').focus();
                 }
                 
                      $('#error_pop').delay(2000).fadeOut('slow');
                } 
}

function ledger_add(){
    
     var date=$('#open_date').val();
      var open=$('#open_bal').val().replace(',','');
      var close=$('#close_bal').val().replace(',','');
      var ledger=$('#open_ledger').val();
      
      if(date!='' && open!='' && close!='' && ledger!='' ){
     $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=add_openclose_acc&date="+date+"&open="+open+"&close="+close+"&ledger="+ledger,
			success: function(msg)
			{    
                        $('#error_pop').show();                       
                        $('#error_pop').text('ADDED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='open_close_account.php';                           
                        }, 500);  
                        }
                    });

                }else{
                    
                    $('#error_pop').show();
                    
                     if(ledger==''){
                       $('#error_pop').text('Select Ledger Account ');
                       $('#open_ledger').focus();
                    }
                 if(close==''){
                       $('#error_pop').text('Enter Closing Balance ');
                       $('#close_bal').focus();
                 }
                 
                 if(open==''){
                      $('#error_pop').text('Enter Opening Balance ');
                      $('#open_bal').focus();
                 }
                 
                if(date==''){
                     $('#error_pop').text('Select Date');
                     $('#open_date').focus();
                 }
                 
                      $('#error_pop').delay(2000).fadeOut('slow');
                }
}

function numdot_dot(item,evt) {
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
function edit_ledger(id){
  
      $('#add_btn_ledger').hide();
       $('#upd_btn_ledger').show();
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_openclose_acc&edit_id="+id,
			success: function(msg)
			{                            
               var sel=$.trim(msg).split('*');            
       $('#open_date').val(sel[1]);
       $('#open_bal').val(sel[2]);      
       $('#close_bal').val(sel[3]);     
        $('#open_ledger').val(sel[4]);
        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=opening_balance_calculation&ledger="+sel[4]+"&date="+sel[1]+"&open="+sel[2],
			success: function(msg)
			{
                           $('#close_bal').val($.trim(msg));
                            
                        }
                    });
                        }
                        });
        $('#open_date').prop('disabled',true);      
          $('#upd_btn_ledger').attr('grp_id_upd_ledger', id);
    
}


function search_data(n)
{
    var ledger=$('#s_ledger').val();
    var date=$('#s_date').val(); 
    var e_date=$('#e_date').val();

    // if($('#s_date').val()!='' && $('#e_date').val()!=''){
    //   $('.confrmation_overlay_proce').css('display','block');
    //   $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />'); 
    //     }

        if(!n)
        {
            n=1;
        }
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php?page="+n,
            dataType: 'json',
			data: "set=list_open_close_bal&ledger="+ledger+"&date="+date+"&e_date="+e_date,
			success: function(msg)
			{
                $('#load_data').html(msg.data);
                $('#show_text').html(msg.show);
                $('#show_pagination').html(msg.pagination); 
                $('.confrmation_overlay_proce').css('display','none');      
            }
        });
}

function datechange()
{
     if($('#s_date').val()!='' && $('#e_date').val()!=''){
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />'); 
      search_data();
        } 
}
function change_open_close(){

     var ledger=$('#open_ledger').val();
     var date=$('#open_date').val();
     var upd=  $('#upd_btn_ledger').attr('grp_id_upd_ledger');
     
     var open=$('#open_bal').val();
      
       if(upd !='' && upd !='undefined' && upd !=undefined ){
           
             
       $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=opening_balance_calculation&ledger="+ledger+"&date="+date+"&open="+open,
			success: function(msg)
			{
                          
                           $('#close_bal').val($.trim(msg).replace(',',''));
                            
                        }
                    });
     $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=opening_balance_calculation1&ledger="+ledger+"&date="+date,
			success: function(msg)
			{                      
                        }
                    });
           
       }else{
                 
       $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_open_close_entry&ledger="+ledger+"&date="+date,
			success: function(msg)
			{
                            
                        if($.trim(msg)=='ok'){

     $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=opening_balance_calculation1&ledger="+ledger+"&date="+date,
			success: function(msg)
			{
                           $('#open_bal').val($.trim(msg).replace(',',''));
                           var open1=$.trim(msg);                          
           $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=opening_balance_calculation&ledger="+ledger+"&date="+date+"&open="+open1,
			success: function(msg)
			{
                           $('#close_bal').val($.trim(msg).replace(',',''));                          
                        }
                    });              
                        }
                    });
        }else{        
                        $('.alert_error_popup_all_in_one').show();                                  
                        $('.alert_error_popup_all_in_one').text('DATA ALREADY EXIST ON DATE .  EDIT DETAILS');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');        
        }   
                         }
                    });
                }
}
</script>
<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>

<div style="display:none" class="confrmation_overlay_proce"></div>
<style>
      .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
    </style>

</body>
</html>
