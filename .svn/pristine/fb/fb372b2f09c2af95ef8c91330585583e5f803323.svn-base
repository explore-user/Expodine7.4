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
<title>Employee Voucher</title>
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
    .alert_popup_sec_cc{width:100%;height:100%;position:absolute;left:0;background-color:rgba(0,0,0,0.5) !important;top:0;z-index:999}
    .alert_popup{width:310px;height:140px;position:absolute;left:0;right:0;top:0;bottom:0;margin:auto;background-color:#fff;border-radius:10px}
    .alert_popup_contant{width:100%;height:auto;float:left;padding:10px;color:#242424;font-size:22px;text-align:center;padding-top:30px;}
    .alert_popup_contant_btn{width:100px;height:32px;display:inline-block;margin-top:30px;background-color:#c41515;color:#fff;line-height:35px;font-size:14px;opacity:0.8}
    .alert_popup_contant_btn.yes{background-color:#0d9613;margin-left:10px}
    .alert_popup_contant_btn:hover{opacity:1}
    .row_active_vendor{background-color: lightpink}
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
    <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
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
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;font-weight: bold">EMPLOYEE VOUCHERS</h3>
                              
                               
                           <div style="width: 120px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                               
                               
                               
                               <a  id="same_page" style="background-color:#314b6b;margin:0;line-height: 32px;"  href="employees.php">GO BACK</a>
                               <a  id="pl_page" style="background-color:#314b6b;margin:0;line-height: 32px;display: none"  href="load_ledger_sheet.php?redirect=redirect_account&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>">GO BACK</a>
                        </div>
                      </div>
                    </div>
           </div>
                
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                              
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Employee Name</label>
                                    <input type="text" class="form-control filte_new_box" id="search_name" onkeyup="search_vendor();" name="" >
                                </div>
                                <?php if (isset($_GET['from']))
                                {
                                    $fdate = $_GET['from'];
                                }else{
                                    $fdate=date('Y-m-d');
                                }
                                
                                if (isset($_GET['to']))
                                {
                                    $tdate = $_GET['to'];
                                }else{
                                    $tdate=date('Y-m-d');
                                }
                                ?>
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">From Date</label>
                                    <input type="text" autocomplete="off" value=<?=$fdate;?> class="form-control filte_new_box" id="search_date" onchange="datechange();" name="">
                                </div>
                                
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">To Date</label>
                                    <input type="text" autocomplete="off"  value=<?=$tdate;?>  class="form-control filte_new_box" id="search_date_to" onchange="datechange();" name="">
                                </div>
                                
                                 <div style="width: 100px;margin-top: 20px !important;height: 30px;margin: 8px 10px" class="search_btn_member_invoice filte_new_box_btn">
                                     <a  id="same_page" style="background-color:darkred;margin:0;line-height: 32px;"  href="employee_voucher.php">RESET</a>
                                 </div>
                                <!-- <div style="margin-left:2%;width: 18%;" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn_ledger"  style="margin-top:0"  href="#">Filter</a>
                            </div>   -->

                            <div class="ledger_list_sec" style="position:relative">
                             
                                <div class="ledger_list_scr">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">SL</td>
                                                 <td style="width:10%">Action</td>
                                                   <td style="min-width:100px">Date</td>
                                                <td style="width:20%"> Name</td>
                                                <td style="width:10%">Amount</td>
                                                <td style="width:10%"> Type</td>
                                               <td style="width:10%">From</td>
                                                <td style="width:40%">Approval</td>
                                                 <td style="width:20%">Entry Date</td>
                                                 <td style="width:20%">Month</td>
                                                 <td style="width:20%">Year</td>
                                                  <td style="width:20%">Particulars</td>
                                              
                                            </tr>
                                        </thead>
                                        <tbody id="load_vendor_data">
                                        
                                     </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="show_text"></div>
                                <div id="show_pagination"></div>
                        </div>
 
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->

<div  class="md-modal md-effect-16 printer_add_popup emp_vouch" id="modal-18" style="top:0;width:100%;height:100%">
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 style="margin-bottom:0">   VOUCHER </h3>
                                <div onclick="close_pop();" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                        <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="ev_name" disabled style="color:darkred;font-weight: bold" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Employee Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="ev_id" disabled style="color:darkred;font-weight: bold" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Employee Id</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="group" id="prn_div">      
                            <select class="add_printer_drop" id="ev_dept" disabled style="color:darkred;font-weight: bold"> 
                              <option value="">Select Department</option>
                               <option value="Restaurant">Restaurant</option>
                                <option value="Store">Store</option>
                                 <option value="Transportation">Transportation</option>
                                   <option value="Cleaning">Cleaning</option>
                                </select>
                            </div>
                        </div>
                            
                             <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="ev_date" autocomplete="off"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Date</label>
                            </div>
                        </div>
                            
                            
                        <div class="col-md-4">
                        <div class="group" id="prn_div">      
                            <select disabled class="add_printer_drop" id="ev_salary_type"> 
                                    <option value=""> Pay Type</option>
                                    <option value="Salary"> Salary</option>
                                    <option value="Advance">Advance</option>
                                </select>
                            </div>
                        </div>
                            
                            
                            <div class="col-md-4">
                        <div class="group" id="prn_div">      
                            <select disabled class="add_printer_drop" id="ev_month"> 
                                   <option value="">Select Month</option>
                                         
                                        <option value="01">January</option>
                                         <option value="02">Febraury</option>
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
                        </div>
                            
                            
                            
                            <div class="col-md-4">
                        <div class="group" id="prn_div">      
                            <select disabled class="add_printer_drop" id="ev_year"> 
                                 
                                         <option value="">Select Year</option>
                                         
                                         
                                        <?php 
                                         $starting_year  =date('Y', strtotime('-0 year'));
 $ending_year = date('Y', strtotime('+15 year'));
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
                        </div>
                            
                            
                       
                        <div class="col-md-4">
                        <div class="group" id="prn_div">      
                               
                            
                            <input type="text" id="ev_amount" readonly onkeypress="return numdot(event);" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                           
                              <label style="top:-5px;color: #414141;font-size: 14px"  id="lab_grp">Amount Paid</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="group" id="prn_div">      
                                
                            
                            <select class="add_printer_drop" id="ev_from"> 
                             <option value="">Fom Acc</option>
                             <?php 
                  $sql_kotlist  =  $database->mysqlQuery("SELECT tlm_id,tlm_ledger_name from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR tg.tlg_name='Bank Accounts')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {
                                                      ?>
                                        
                                        
                                          <option value="<?=$result_kotlist['tlm_id'] ?> "><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                                        
                                                      <?php 
                                                  }
                                                  }
                                                ?>
                          </select>
                            
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">      
                                
                                
                                <input type="text" id="ev_approved_by"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Approved By</label>
                            </div>
                        </div>
                      
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                            <input type="text" id="ev_tran"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">TRN Details</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="group" id="prn_div">   
                            <input type="text" id="ev_remark"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp">Particulars</label>
                            </div>
                        </div>
                            <a onclick="return update_employee_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>

                        </div>
                </div>

    </div>

</div>


  <div class="md-overlay"></div>               
                 
  <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>
    
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js"></script>



<script type="text/javascript">
    //calender//
            $(document).ready(function () {
                search_vendor();
                
                var url_check=$('#url_check').val();
                var firstParameterValue = getFirstParameter(url_check);
   //var new_id=url_check.split('redirect=');
   
 
   if(firstParameterValue=='profit_loss'){
    
       $('#same_page').hide();
       $('#pl_page').show();
   }else{
       $('#pl_page').hide();
         $('#same_page').show();
     }         
                
         $( "#ev_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
           $( "#search_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
            });
           
           
            $( "#search_date_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
            });
           
           
           
           
  // $('#date_voucher').datepicker('setStartDate', new Date());
        
   
             
        });   
        
function getFirstParameter(url) {
  var queryString = url.split('?')[1]; // Extract the query string from the URL
  var ampersandExists = checkAmpersandExist(url);
  if(ampersandExists==true){
  var parameters = queryString.split('&'); // Split the query string into individual parameters

  if (parameters.length > 0) {
    var firstParameter = parameters[0].split('=')[1]; // Get the value of the first parameter
    return decodeURIComponent(firstParameter); // Decode the parameter value if needed
  }
  }
  return null; // Return null if there are no parameters
}

function checkAmpersandExist(url) {
  return url.indexOf('&') !== -1;
}
  

    
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
    
    
function search_vendor(n)
{
    var v_name=$('#search_name').val();
    var fdate=$('#search_date').val();
    var search_date_to=$('#search_date_to').val();
  
    var data_v="set=search_employee_voucher&fname="+v_name+"&fromdt="+fdate+"&todt="+search_date_to;

//     if($('#search_date').val()!='' && $('#search_date_to').val()!=''){
//       $('.confrmation_overlay_proce').css('display','block');
//       $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />'); 
//    }
    if(!n){
            n=1;
        }
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php?page="+n,
			data: data_v,
            dataType: 'json',
			success: function(msg)
			{                
            $('#load_vendor_data').html(msg.data);  
            $('#show_text').html(msg.show);
            $('#show_pagination').html(msg.pagination); 
            $('.confrmation_overlay_proce').css('display','none');  
            }
        }); 
}

function datechange()
{
    if($('#search_date').val()!='' && $('#search_date_to').val()!='')
    {
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />'); 
      search_vendor();
    }
}
function close_pop()
{
   // window.location.href='employee_voucher.php';
   $('.emp_vouch').removeClass('md-show');
}


function edit_voucher_employee(vid,nm)
{    
    $('.emp_vouch').addClass('md-show');
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_employee_voucher&edit_id="+vid,
			success: function(msg)
			{
                var ed1=$.trim(msg);
                var ed=ed1.split('*');
                         
  $('#ev_name').attr('voucher_update_id',vid);
  $('#ev_name').val(nm);
  $('#ev_id').val(ed[0]);
  $('#ev_dept').val(ed[1]);
  $('#ev_salary_type').val(ed[2]);
  $('#ev_date').val(ed[3]);
  $('#ev_amount').val(ed[4]);
  $('#ev_from').val(ed[5]);
  $('#ev_approved_by').val(ed[6]);
  $('#ev_tran').val(ed[7]);
  $('#ev_remark').val(ed[8]);
  $('#ev_month').val(ed[9]);
  $('#ev_year').val(ed[10]);   
            }
        });
       
}


function update_employee_voucher()
{
  var ev_emp_id=$('#ev_id').val();
  var ev_dept=$('#ev_dept').val();
  var ev_pay_type=$('#ev_salary_type').val();
  var ev_date=$('#ev_date').val();
  var ev_amount=$('#ev_amount').val();
  var ev_from=$('#ev_from').val();
  var ev_approved=$('#ev_approved_by').val();
  var ev_tran=$('#ev_tran').val();
  var ev_remarks=$('#ev_remark').val();
  var ev_month=$('#ev_month').val();
  var ev_year=$('#ev_year').val();
  var update_id=$('#ev_name').attr('voucher_update_id');
 
    if(ev_pay_type!='' && ev_date!='' && ev_amount!='' && ev_from!='' && ev_month!=''  && ev_year!='' && ev_remarks!='' ){
        
        var data_v="set=update_employee_voucher&ev_emp_id="+ev_emp_id+"&ev_dept="+ev_dept+"&ev_pay_type="+ev_pay_type+
                "&ev_date="+ev_date+"&ev_amount="+ev_amount+"&ev_from="+ev_from+
                "&ev_approved="+ev_approved+"&ev_tran="+ev_tran+"&ev_remarks="+ev_remarks+"&update_id="+update_id+"&ev_month="+ev_month+"&ev_year="+ev_year;
                
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
                        $('.emp_vouch').removeClass('md-show');
                        search_vendor();   

                        $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+ev_date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+ev_date,
                success: function(msg)
                {
                                 
                }
                });    
                }
                });

                         //setTimeout(function(){ 
                         // window.location.href='employee_voucher.php';
                       
                         //search_vendor();
                         // }, 500);   
                        }
                    });
    }else{
        $('#error_pop_v').show(); 
        if(ev_remarks==''){
        $('#error_pop_v').text('ENTER PARTICULARS ');
        $('#ev_remark').focus();
         }
        if(ev_from==''){
        $('#error_pop_v').text('SELECT FROM ACC ');
        $('#ev_from').focus();
         }
         if(ev_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#ev_amount').focus();
         }       
         if(ev_year==''){
        $('#error_pop_v').text('SELECT YEAR');
        $('#ev_year').focus();
         }
          if(ev_month==''){
        $('#error_pop_v').text('SELECT MONTH ');
        $('#ev_month').focus();
         }
        if(ev_pay_type==''){
        $('#error_pop_v').text('SELECT PAY TYPE ');
        $('#ev_salary_type').focus();
         }
         if(ev_date==''){
        $('#error_pop_v').text('SELECT DATE');
        $('#ev_date').focus();
         }
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
}


function delete_employee_voucher(vid){
     
      var confirm1=confirm(" DELETE VOUCHER ?");
      if(confirm1===true){
          $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         $('#error_pop_v').text('DELETING');
                         $('#error_pop_v').delay(5000).fadeOut('slow');
      $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=delete_employee_voucher&vid="+vid,
			success: function(msg)
			{
                search_vendor();
            }
            });
                }
}
</script>
<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>

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
