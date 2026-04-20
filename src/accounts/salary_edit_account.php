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
 
 
 <link rel="stylesheet" href="../css/style_date.css">
  <link href="../loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
 
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
   $(document).ready(function ()
    { 
       var data_v="set=search_employee&fname=&fnum=&fdesg=";
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                      
                $('#load_vendor_data').html(msg);     
            }
            });     
       
             $("#e_dob").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
            $("#e_join").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
            $("#ev_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
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
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:3px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:400px;float:left;margin-top:5px;}
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
                        
                      <div style="margin-bottom:0;background: #fff;" class="cc_new">
                       	<div style="border: 0 !important " id="lista1" class="als-container">
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;border:solid 1px;padding: 5px;color:white;background-color: #3e1c2f">SALARY HISTORY  </h3>
                              
                           <div style="width: 120px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                               <a class="md-trigger"  style="background-color:#314b6b;margin:0;line-height: 32px;"  href="employees.php">GO BACK</a></div>
                           
                           
                             
                      </div>
                    </div>
           </div>
                
            

                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                              
                                <div class="acc_add_box" style="width:40%;">
                                    <label style="margin: 0;">Month</label>
                                    <select style="background-color: #e6e6e6" class="form-control filte_new_box" id="smonth"  >
                                         <option value="">Select Month</option>
                                         
                                        <option value="01">January</option>
                                         <option value="02">February</option>
                                            <option value="03">March</option>
                                               <option value="04">April</option>
                                                  <option value="05">May</option>
                                                  <option value="06">June</option>
                                                     <option value="07">July</option>
                                                     <option value="08">August</option>  
                                                     <option value="09">September</option> 
                                                     <option value="10">October</option>
                                                        <option value="11">November</option>
                                                          <option value="12">December</option>
                                                     
                                                     
                                                     
                                                  
                                               
                                    </select>
                                    
                                </div>
                                <div class="acc_add_box" style="width:40%;">
                                    <label style="margin: 0;">Year</label>
                                   <select style="background-color: #e6e6e6" class="form-control filte_new_box" id="syear"  >
                                        <option value="">Select Year</option>
                                        <?php 
                                         $starting_year  =date('Y', strtotime('-5 year'));
                                         $ending_year = date('Y', strtotime('+2 year'));
                                         $current_year = date('Y');
                                          for($starting_year; $starting_year <= $ending_year; $starting_year++) {
                                             echo '<option value="'.$starting_year.'"';
                                             if( $starting_year ==  $current_year ) {
                                                    //echo ' selected="selected"';
                                             }
                                             echo ' >'.$starting_year.'</option>';
                                         }      
                                     ?>                                          
                                    </select>
                                </div>
                                
                                 <div class="acc_add_box" style="width:20%;cursor: pointer">
                                    <label style="margin: 0;">.</label>
                                    <input onclick="edit_salary();" style="cursor: pointer;color:white;text-transform: uppercase;font-weight: bold;background-color: darkred" value="PROCEED " readonly type="text"  class="form-control filte_new_box "  >
                                </div>
                                                         
                        <div id="upd_div" style="display:none">

                                 <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Name</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Designation</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Salary</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:7%;cursor: pointer">
                                    <label style="margin: 0;">Work Days</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:7%;cursor: pointer">
                                    <label style="margin: 0;">LOP Days</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Extra Days</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Deduction</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Extra Pay</label>
                                 
                                </div>
                                <div class="acc_add_box" style="width:10%;cursor: pointer">
                                    <label style="margin: 0;">Net Salary</label>
                                 
                                </div>
                                    
                                    
                                    <div class="acc_add_box" style="width:8%;cursor: pointer">
                                    <label style="margin: 0;">Advance</label>
                                 
                                </div>
                                    
                                    <div class="acc_add_box" style="width:8%;cursor: pointer">
                                    <label style="margin: 0;">Paid</label>
                                 
                                </div>
                                    
                                 </div>
                                
                                <div id="load_salary">
                                    
                                </div>
                                
                                
                                
                                
                                    <div>
                                
                                 <div style="width: 5%;margin-top: 20px !important;height: 30px;margin: 0px;float: right " class="search_btn_member_invoice filte_new_box_btn upd_btn">
                                     <a onclick="update_salary();"  id="same_page" style="background-color:darkred;margin:0;line-height: 31px;display: none"  href="#">UPDATE</a>
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

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

</script>

<script type="text/javascript">
    
    
    
function edit_salary()
{       
    var syear=$('#syear').val();
    var smonth=$('#smonth').val();
  
    if(smonth!='' && syear!='')
    {      
      $('#upd_btn').show();
      $('#upd_div').show();
      
      var data_v="set=edit_salary&month="+smonth+"&year="+syear;       
        
            $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{ 
                $('#load_salary').html(msg);
                $('#same_page').show();
            }
            });
    }
    else
    {
       $('#error_pop_v').show();
       $('#error_pop_v').css('background-color', 'red');
       $('#error_pop_v').text('SELECT MONTH AND YEAR');
       $('#error_pop_v').delay(2000).fadeOut('slow');
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
    
    


function update_salary(){
 
  var syear=$('#syear').val();
  var smonth=$('#smonth').val();
  
   var split_order=new Array();
    $('.details_row_split').each(function(){
            var sname=$(this).find('.sname').attr('emp_id'); 
             var workday=$(this).find('.workday').val(); 
              var salary=$(this).find('.salary').val(); 
               var lop=$(this).find('.lop').val(); 
              var extraday=$(this).find('.extraday').val(); 
               var deduction=$(this).find('.deduction').val(); 
              var extrapay=$(this).find('.extrapay').val();  
              var netsalary=$(this).find('.netsalary').val(); 
      
      split_order.push({
         'sname':$.trim(sname),
         'salary':$.trim(salary),
          'workday':$.trim(workday),
          'lop':$.trim(lop),
           'extraday':$.trim(extraday),
            'deduction':$.trim(deduction),
             'extrapay':$.trim(extrapay),
              'netsalary':$.trim(netsalary)
              
      });
      
   
      
      if(netsalary=='' || netsalary=='0'){
          $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         $('#error_pop_v').text('ENTER NET SALARY OF ALL EMPLOYEES');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      exit;
      }
     
      
    });
  
         var split_all_json_detail= JSON.stringify(split_order);   
           
           
           
        //   alert(split_all_json_detail);
    
        if(smonth!="" && syear!=''){
        var data_v="set=update_employee_salary&all_staff_data="+split_all_json_detail+"&month="+smonth+"&year="+syear;
                
        
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
                            edit_salary(); 
                          //window.location.href='salary_edit_account.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
        
        
     }else{
                          $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         
                        
                     if(syear==''){
                        $('#error_pop_v').text('Select Year'); 
                        $('#syear').focus();
                     }
                         
                        if(smonth==''){
                         $('#error_pop_v').text('Select Month');
                         $('#smonth').focus();
                     }
                       
                         
                         
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                         exit;
      }
}










$('#sstaff').change(function () {
   
   var desg= $('option:selected', this).attr('desg');
   $('#sdesg').val(desg);
   
   
});



</script>


<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
