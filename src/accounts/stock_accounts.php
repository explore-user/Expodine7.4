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
<script type="text/javascript">
    //calender//
            $(document).ready(function () {
             
             
    
        });          
        
        
     



function ledger_update(){
    
      var date=$('#stock_date').val();
      var open=$('#stock_open').val();
      var close=$('#stock_close').val();
      var staff=$('#stock_staff').val();
      
      var id =$('#upd_btn_ledger').attr('grp_id_upd_ledger');
      
      if(date!='' && open!='' && close!='' && staff!='' ){
        
        
      $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=update_stock_acc&date="+date+"&open="+open+"&close="+close+"&staff="+staff+"&upd_id="+id,
			success: function(msg)
			{
                        $('#error_pop').show();
                         
                        $('#error_pop').text('STOCK VALUE UPDATED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='stock_accounts.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                    
                    
                }else{
                    
                       
                    $('#error_pop').show();
                    
                     if(staff==''){
                       $('#error_pop').text('Select Staff ');
                       $('#stock_staff').focus();
                    }
                    
                    
                 if(close==''){
                       $('#error_pop').text('Enter Close value As Zero or Greater Than Zero ');
                       $('#stock_close').focus();
                 }
                 
                 if(open==''){
                      $('#error_pop').text('Enter Open value As Zero or Greater Than Zero ');
                      $('#stock_open').focus();
                 }
                 
                if(date==''){
                     $('#error_pop').text('Select Date');
                     $('#stock_date').focus();
                 }
                 
                      $('#error_pop').delay(2000).fadeOut('slow');
                }
      
      
    
}

function ledger_add(){
    
     var date=$('#stock_date').val();
      var open=$('#stock_open').val();
      var close=$('#stock_close').val();
      var staff=$('#stock_staff').val();
      
      if(date!='' && open!='' && close!='' && staff!='' ){
          
          
            $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_stock_date&date="+date,
			success: function(msg3)
			{
                            
                           
          if($.trim(msg3)!='no'){
          
     $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=add_stock_acc&date="+date+"&open="+open+"&close="+close+"&staff="+staff,
			success: function(msg)
			{
                            
                            
                        $('#error_pop').show();
                         
                        $('#error_pop').text('STOCK VALUE ADDED');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                          window.location.href='stock_accounts.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                    
                    
                        }else{
                            
                        $('#error_pop').show();
                    
                       $('#error_pop').text('STOCK VALUE ADDED FOR SELECTED DATE ALREADY');
                       $('#stock_staff').focus();
                    
                        $('#error_pop').delay(2000).fadeOut('slow');
                        
                        }
                        
                        
                     }
                    });
                    
                    
                    
                    
                }else{
                    
                    $('#error_pop').show();
                    
                     if(staff==''){
                       $('#error_pop').text('Select Staff ');
                       $('#stock_staff').focus();
                    }
                    
                    
                 if(close==''){
                       $('#error_pop').text('Enter Close value As Zero or Greater Than Zero ');
                       $('#stock_close').focus();
                 }
                 
                 if(open==''){
                      $('#error_pop').text('Enter Open value As Zero or Greater Than Zero ');
                      $('#stock_open').focus();
                 }
                 
                if(date==''){
                     $('#error_pop').text('Select Date');
                     $('#stock_date').focus();
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
			data: "set=edit_stock_acc&edit_id="+id,
			success: function(msg)
			{
                            
               var sel=$.trim(msg).split('*');          
    
       $('#stock_date').val(sel[1]);
       $('#stock_open').val(sel[2]);
       
       $('#stock_close').val(sel[3]);
       
        $('#stock_staff').val(sel[4]);
        
        
                        }
                        });
       
       
          $('#upd_btn_ledger').attr('grp_id_upd_ledger', id);
                    
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
                                <h3 class="ledger_head">DAYWISE STOCK VALUE  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 20px;background-color: #ff4229;border-radius: 5px "></span></h3>

                                <div class="acc_add_box" style="width:20%;">
                             	   
                                    <input type="text" class="form-control filte_new_box datepicker1" id="stock_date"  autocomplete="off" name="" placeholder="Date">
                                </div>
                                
                                <?php 
                                $open='';
                                $sql_login  =  $database->mysqlQuery("select tas_open_stock_value from tbl_account_stock where tas_open_stock_value >0  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if(!$num_login){
					$open='ok';
                                        }else{
                                            $open='notok';
                                        }
                                            ?>   
                                <div class="acc_add_box" style="width:15%;">
                             	   
                                    <input  type="text" value="0" class="form-control filte_new_box" onkeypress="return numdot_dot(this,event);" id="stock_open" name="" placeholder="Opening Stock Value">
                                </div>
                            
					
                                
                                
                                <div class="acc_add_box" style="width:15%;">
                             	   
                                    <input type="text"  class="form-control filte_new_box" onkeypress="return numdot_dot(this,event);"  id="stock_close" name="" placeholder="Closing Stock Value">
                                </div>
                                     
                                
                                <div class="acc_add_box" style="width:20%;">
                             	    
                                    <select id="stock_staff" class="form-control filte_new_box">
                                        <option value="">Select Staff </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['ser_firstname']?>"><?=$result_login['ser_firstname'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                
                                
                                
                                
                                
                                <div style="margin-left:2%;width: 18%;" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn_ledger" onclick="return ledger_add();" style="margin-top:0;cursor: pointer"  >ADD</a>
                                <a id="upd_btn_ledger" onclick="return ledger_update();" style="margin-top:0;display: none "  href="#">UPDATE</a></div>
                                
                                
                                
                                
                            </div> 
                            
                            
                             <!-- <strong style="top:20px" > Sales : <span id="sale_show">0.000 </span>  </strong> |
                                  <strong style="top:20px">Stock Purchase : <span id="stock_purcahse_show">0.000 </span> </strong>  -->

                            <div class="ledger_list_sec" style="position:relative">
                                <h3 style="font-size:18px" class="ledger_head"> &nbsp;</h3>
                                <div style="position:absolute;width: 120px;right:9px;top:3px;height: 33px;float: left" class="search_btn_member_invoice filte_new_box_btn">
                                   
                                    <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;display: none" onclick="return pop_on();" href="#">ADD PAYMENT</a></div>
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style="min-width:5px;max-width:5px;">SL</td>
                                                <td style="min-width:30px;max-width:30px;">Date</td>
                                                <td style="min-width:30px;max-width:30px;">Opening Stock Value</td>
                                                  <td style="min-width:20px;max-width:20px;">Closing Stock Value</td>
                                                <td style="min-width:20px;max-width:20px;">Staff</td>
                                                 <td style="min-width:20px;max-width:20px;">Edit</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                            $i=0;
                                          $sql_login  =  $database->mysqlQuery("select tas_id,tas_date,tas_open_stock_value,tas_close_stock_value,tas_login from tbl_account_stock order by tas_date asc "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ $i++;?>   
                                        <tr>
                                            <td style="min-width:5px;max-width:5px;"><?=$i?></td>
                                            <td style="min-width:30px;max-width:30px;text-transform: uppercase"><?=$result_login['tas_date']?></td>
                                            <td style="min-width:30px;max-width:30px;text-transform: uppercase"><?=$result_login['tas_open_stock_value']?></td>
                                             <td style="min-width:20px;max-width:20px;text-transform: uppercase"><?=$result_login['tas_close_stock_value']?></td>
                                             <td style="min-width:20px;max-width:20px;text-transform: uppercase"><?=$result_login['tas_login']?></td>
                                             
                                            <td  onclick="edit_ledger('<?=$result_login['tas_id']?>');" style="min-width:20px;max-width:20px;"><a href="#" > <div class="action_button printer_delete"><i class="glyphicon glyphicon-pencil"></i></div></a></td>
                                        </tr>
                                        
                                        
                                        <?php } } ?> 
                                            
                                            
                                            
                                            
                                        
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

 <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>           
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>

<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
    
    
    
    
    $( ".datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
           });
    
    
   $("#listall").tablesorter();
   
    
}); 


// function show_sale_stock(){ was calling on date change
    
    
//     var date=$('#stock_date').val();
    
//     var datastring = 'set=check_stock_concept&date='+date;
//        $.ajax({
//                 type: "POST",
//                 url: "load_accounts_data.php",
//                 data: datastring,
//                 success: function (data)
//                 {
                    
//                   var ed=$.trim(data).split('*');
                 
//                   $('#sale_show').text(ed[0]);
//                    $('#stock_purcahse_show').text(ed[1]);
//                 }
//        });
    
// }


</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
