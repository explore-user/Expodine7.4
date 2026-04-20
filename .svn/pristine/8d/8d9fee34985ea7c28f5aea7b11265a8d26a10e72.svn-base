<?php
// include('includes/session.php');		
session_start();
include("database.class.php"); 
$database	= new Database();



?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Advance</title>
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
 <link href="loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
                
                
                
                
                $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
                
                 
             var to_acc=$('#to_src').val();
       var datastringnewcard="set=list_loan_adv&fromdt=&todt=&to_acc="+to_acc;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {   
        
        
        
         $('#load_journal_detail').html(data);
         
      }
         
          
       });     
                
       
    
    $( "#dat_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                endDate: '+0d',
               autoclose: true
           });
           
           
           
           $( "#dat_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                endDate: '+0d',
               autoclose: true
           });
    
        });          
      
      
      function datechange(){
      
      
      var fromdt=$('#dat_from').val(); 
       var todt=$('#dat_to').val(); 
       
    
       var to_acc=$('#to_src').val();
       
       var datastringnewcard="set=list_loan_adv&fromdt="+fromdt+"&todt="+todt+"&to_acc="+to_acc;
      // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
         $('#load_journal_detail').html(data);
           
        }
       });
        }
        function close_transfer(){
            $('.transfer_popup_sec').hide();
            
            $('#tr_amount').val('');
         $('#tr_to').val('');
        }
        
      function transfer_amount(typ,frm,v,t,amt,paid){
          
          if(amt==paid){
          
        $('#error_pop_v').show();
            
        $('#error_pop_v').text('ALREADY TRANSFERED');
        $('#amount').focus();
         $('#amount').val('');
        $('#error_pop_v').delay(2000).fadeOut('slow');
        
        }else{
         $('.transfer_popup_sec').show();
         
         $('#tr_amount').val(amt);
         $('#tr_to').val('');
         
          $('#tr_amount').attr('voucher',v);
           $('#tr_amount').attr('type',typ);
            $('#tr_amount').attr('from',frm);
      }
          
          
      }  
        
      function transfer_to(){
          
          var amt=$('#tr_amount').val();
           var to1=$('#tr_to').val();
           var vouch=$('#tr_amount').attr('voucher');
             var  type=     $('#tr_amount').attr('type');
            var from= $('#tr_amount').attr('from');
            var tr_remarks= $('#tr_remarks').val();
            
    if(to1!='' && tr_remarks!='' ){
         
        var data_v="set=transfer_advance_pay&to_acc="+to1+"&amount="+amt+"&vouch="+vouch+"&type="+type+"&from="+from+"&tr_remarks="+tr_remarks;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('TRANSFERRED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                           var page_check=$('#url_check').val();
      
      var ext1=page_check.split('src/');
      
            window.location.href=ext1[1];
                            
                        }, 500); 
                             
                             
                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        
        
         if(tr_remarks==''){
        $('#error_pop_v').text('ENTER PARTICULARS ');
        $('#tr_remarks').focus();
         }
        
         if(to1==''){
        $('#error_pop_v').text('SELECT TO ACC ');
        $('#tr_to').focus();
         }
         
         
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
           
          
      }  
        
        
    function pay_bal(vo,to1,fr){
        
        
        

        var data_v="set=check_bal_loan_adv&vouch="+vo;
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                if(msg>0)
                {       
                    $('#new_vouch_no').val(vo);
                    $('#new_vouch_no').prop('disabled',true);  
                     $('#balance').val($.trim(msg)); 
                     $('.printer_add_popup').addClass('md-show');
                }
                else{
                    $('#error_pop_v').show();
                        // $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('No balance to pay');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                }
               
            }
        });   
            $('.bal_div').show();
         
    }   
        
   function close_pop(){
      $('.printer_add_popup').removeClass('md-show');
    }
    
    
    
    
     function add_contra_voucher(){
        
  var cv_date=$('.cv_date').val();
  var cv_amount=$('#amount').val();
 
  var cv_trans=$('#trans').val();
  var cv_remarks=$('#remarks').val();
    var cv_type=$('#acc_type').val();     
     var cv_receive=$('#received').val();     
     
     var cv_type_loan=$('#loan_type').val();     
     
     var cv_type_adv=$('#advance_type').val();    
     
    
     if(cv_type_adv!=''){
         
        var  type_l=$('#advance_type').val();    
     }else{
         
         type_l=$('#loan_type').val();  
         
     }
     
     var type_of_pay=$('#pay_type').val(); 
    
    
    if(type_of_pay=='Pay'){
        
         var cv_from=$('#from_acc').val();
  var cv_to=$('#to_acc').val();
    }else{
        
          cv_from=$('#from_acc1').val();
   cv_to=$('#to_acc1').val();
    }
    
         
         var new_vouch_no=$('#new_vouch_no').val();
     
     
     
           
    if(cv_amount!='' && cv_date!='' && cv_from!='' && cv_to!='' && cv_remarks!='' && cv_type!='' &&  (cv_type_loan!='' || cv_type_adv!='') ){
         
        var data_v="set=pay_loan_adv_voucher&cv_date="+cv_date+"&cv_amount="+cv_amount+"&cv_from="+cv_from+"&cv_to="+cv_to+"&cv_trans="+cv_trans+
          "&cv_remarks="+cv_remarks+"&cv_type="+cv_type+"&cv_receive="+cv_receive+"&cv_tpe_l="+type_l+"&pay_type="+type_of_pay+"&new_vouch_no="+new_vouch_no;
    
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('PAID SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                           var page_check=$('#url_check').val();
      
      var ext1=page_check.split('src/');
      
            window.location.href=ext1[1];
                            
                        }, 500); 
                             
                             
                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        
        
         if(cv_remarks==''){
        $('#error_pop_v').text('ENTER PARTICULARS');
        $('#cv_remarks').focus();
         }
         
           if(cv_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#cv_amount').focus();
         }
         
         if(cv_type_adv=='' && cv_type=='Advance' ){
        $('#error_pop_v').text('SELECT ADVANCE TYPE ');
        $('#advance_type').focus();
         }
         
         if(cv_type_loan=='' && cv_type=='Loan' ){
        $('#error_pop_v').text('SELECT LOAN TYPE ');
        $('#loan_type').focus();
         }
         
         
         if(cv_type==''){
        $('#error_pop_v').text('SELECT VOUCHER TYPE ');
        $('#acc_type').focus();
         }
         
          if(cv_to==''){
        $('#error_pop_v').text('SELECT TO ACC ');
        $('#to_acc').focus();
         }
         
         if(cv_from==''){
        $('#error_pop_v').text('SELECT FROM ACC AMOUNT');
        $('#from_acc').focus();
         }
         
         if(cv_date==''){
        $('#error_pop_v').text('SELECT DATE');
        $('.cv_date').focus();
         }
         
         
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
        
    }
    
    // function pay_type_change()
    // {
    //     var pay_type=$('#pay_type').val();
    //     if(pay_type=='Pay')
    //     {
    //         $('#new_vouch_no').prop('disabled',false);            
    //         $('.bal_div').hide();       
    //     }
    //     else
    //     {
    //         $('#new_vouch_no').prop('disabled',true);               
    //         var vouch=$('#new_vouch_no').val();
    //         var data_v="set=check_bal_loan_adv&vouch="+vouch;
    //     $.ajax({
	// 		type: "POST",
	// 		url: "load_accounts_data.php",
	// 		data: data_v,
	// 		success: function(msg)
	// 		{
    //             $('#balance').val($.trim(msg)); 
    //         }
    //     });   
    //         $('.bal_div').show();
    //     }    
    //}
    
    
    function check_paid(){
        
        var pay_type=$('#pay_type').val();
        
        
        if(pay_type!='Pay'){
        var balance=parseFloat($('#balance').val().replace(',','')); 
        
        var paid=parseFloat($('#amount').val()); 
        //alert(balance);
       // alert(paid);
        
        if(paid > balance){
            $('#error_pop_v').show();
            
        $('#error_pop_v').text('INVALID AMOUNT');
        $('#amount').focus();
         $('#amount').val('');
        $('#error_pop_v').delay(2000).fadeOut('slow');
            
        }
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
.journal_opening_blc{width:auto;float:left;padding:10px;color:#fff;background-color:#4CAF50;font-size:16px;margin-bottom:10px}

</style>

<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">


</head>
<body>
    
  
    <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
      
    <input type="hidden" value="<?=$_REQUEST['to_acc']?>" id="to_src">
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu_account.php"; ?>
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
                     
                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <h3 class="ledger_head"> 
                                    
                                    
                                    <a href="loan_advance.php"><img src="img/thin_left_arrow_333.png" style="width: 13px;position: relative;top: -2px;"></a>
                                    <span style="padding-left:20px"><?php 
                                $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_ledger_master where tlm_id='".$_REQUEST['to_acc']."'  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {
                                                      
                                                      echo $result_kotlist['tlm_ledger_name'];
                                                  }
                                                  }
                                               ?></span>
                                </h3>
                                 
                                <div class="acc_add_box" style="width:20%;">
                             	      From
                                      <input autocomplete="off" type="text" class="form-control filte_new_box" onchange="return datechange();" id="dat_from"  placeholder="From">
                                </div>

                                <div class="acc_add_box" style="width:20%;">
                             	      To
                                    <input autocomplete="off" type="text" class="form-control filte_new_box" onchange="return datechange();" id="dat_to"  placeholder="To">
                                </div>
                                 
                              
                                
                                
                                <div style="margin-left:2%;width:12%;" class="search_btn_member_invoice filte_new_box_btn">
                                 
                                  
                                    
                                     </div>
                               <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

                            </div>  

                            <div class="ledger_list_sec">


                               
                                <div class="ledger_list_scr">

                                
                                    
                                    
                                    <div style="display:none" class="journal_opening_blc"> <strong id="open_bal"></strong></div>

                                    <div style="float: right; background-color: brown;display: none" class="journal_opening_blc"> <strong id="close_bal" >0</strong></div>

                                    <table >
                                        <thead>
                                            <tr>
                                                  <td style="width:5%">Action</td>  
                                               <td style="width:8%">Date</td>  
                                                <td style="width:7%">Voucher No</td>  
                                                <td style="width:5%">Type</td>  
                                                 <td style="width:10%">Account Name</td>
                                                  <td style="width:10%">To Acc</td>
                                                <td style="width:20%">Particular</td>
                                                 <td style="width:15%">Amount </td>
                                                 <td style="width:15%">Paid </td>
                                                 <td style="width:15%;display: none">Balance</td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id="load_journal_detail">
                                            
                                            
                                        

                                       
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


   <div  class="md-modal md-effect-16 printer_add_popup" id="modal-17" style="top:0;width:100%;height:100%">
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0"> PAY </h3>
                                <div onclick="close_pop();" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                    
                     <div class="col-md-4">
                     <div class="group" id="prn_div">   
                         <input type="text" class="cv_date" autocomplete="off"  id="datepicker" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Date</label>
                        </div>
                    </div>
                        
                        <div class="col-md-4" id="new_vouch_div" >
                     <div class="group" id="prn_div">   
                         <input type="text" class="" autocomplete="off"  id="new_vouch_no" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label style="top:-5px;color: #414141;font-size: 14px"  id="lab_grp">Voucher No</label>
                        </div>
                    </div>
                      
                        
                        <input type="hidden" class="cv_date" value="<?=$_REQUEST['acc_type']?>" autocomplete="off"  id="acc_type" >  
                         
                         
                        
                         <input type="hidden" class="" value="<?=$_REQUEST['acc_from']?>" autocomplete="off"  id="from_acc" > 
                          <input type="hidden" class="" value="<?=$_REQUEST['to_acc']?>" autocomplete="off"  id="to_acc" > 
                          
                           <input type="hidden" class="" value="<?=$_REQUEST['acc_from']?>" autocomplete="off"  id="to_acc1" > 
                            <input type="hidden" class="" value="<?=$_REQUEST['to_acc']?>" autocomplete="off"  id="from_acc1" > 
                        
                        
                          
                        
                        
                          <?php if($_REQUEST['acc_type']=='Loan'){ ?>
                         <input type="hidden" class="cv_date" value="<?=$_REQUEST['adv_type']?>" autocomplete="off"  id="loan_type" > 
                         
                         <input type="hidden" class="cv_date" value="" autocomplete="off"  id="advance_type" >  
                          <?php } else{ ?>
                         
                          <input type="hidden" class="cv_date" value="" autocomplete="off"  id="loan_type" > 
                         <input type="hidden" class="cv_date" value="<?=$_REQUEST['adv_type']?>" autocomplete="off"  id="advance_type" >  
                          
                             <?php } ?>
                        
                        <div class="col-md-4" style="display:none;">
                        <div class="group" id="prn_div">   
                          
                            <select class="add_printer_drop" id="pay_type" >
                                <!-- <option value=""> Pay Type</option> -->
                                 <option value="Repayment"> Repayment</option>
                                  <!-- <option value="Pay"> Pay</option> -->
                                 
                            </select>
                          
                          
                        </div>
                    </div>
                      
                    
                      
                         
                        
                         <div class="col-md-4 bal_div" style="display:none">
                        <div class="group" id="prn_div">   
                            <input type="text" readonly id="balance"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Balance</label>
                        </div>
                    </div>
                        
                        
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                            <input type="text" id="amount" onkeypress="return numdot(event);" onkeyup="check_paid();" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Amount</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="group" id="prn_div">   
                           <input type="text" id="trans"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Transaction Details</label>
                        </div>
                    </div>

                   
                        
                    <div class="col-md-12">
                        <div class="group" id="prn_div">   
                           <input type="text" id="remarks"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Particulars</label>
                        </div>
                    </div>

                  
                    </div>
                      
                    <a id='add_btn' onclick="return add_contra_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">PAY</button></a>
                    <a style="display: none " id='upd_btn' onclick="return update_contra_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>

                   

                </div>
                       
            </div>
</div>    




            <div class="md-overlay"></div><!-- the overlay element -->   




            <div class="transfer_popup_sec" style="display:none">
                 <div class="transfer_popup">
                 <div style="top: 6px; right: 7px;" class="md-close close_staff_pop" onclick="close_transfer();"><img src="img/black_cross.png"></div>
                     <div class="transfer_popup_head">Transfer</div>
                     <div class="transfer_pop_contantnt">
                     <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-top:10px;">
                    
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" class="" id="tr_amount" readonly>   
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label id="lab_grp" style="top:-5px;color: #414141;font-size: 14px">Amount</label>
                            </div>
                            </div>
                            <div class="col-md-8">
                            <div class="group" id="prn_div">   
                                <select name="" class="add_printer_drop" id="tr_to">
                                    <option value="">To Acc</option>
                                    
                                    <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Direct Expense' OR  tg.tlg_name='Indirect Expense' OR tlm_vendor_id!='')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {
                                                      ?>
                                        
                                        
                                          <option value="<?=$result_kotlist['tlm_id']?>"><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                                        
                                                      <?php 
                                                  }
                                                  }
                                                ?>
                                    
                                
                                </select>   
                                <span class="highlight"></span>
                                <span class="bar"></span>
                            </div>
                            </div>
                         
                         
                         <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" class="" id="tr_remarks">   
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label id="lab_grp" style="top:-5px;color: #414141;font-size: 14px">Particulars</label>
                            </div>
                            </div>
                         
                            
                        </div>
                        <div class="col-md-12">
                            <a onclick="transfer_to();" href="#" class="transfer_op_btn">TRANFSER</a>
                        </div>

                     </div>
                 </div>
            </div>

<style>
    .transfer_popup_sec{
        width: 100%;
    height: 100%;
    position: fixed;
    left: 0;
    top: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    }
    .transfer_popup{
        width: 450px;
    height: auto;
    position: absolute;
    padding-bottom:10px;
    left: 0px;
    right: 0px;
    margin: auto;
    top: 10%;
    background-color: white;
    padding: 15px;
    border-radius:5px;

    }
    .transfer_popup_head{
        width:100%;
        height:auto;
        float:left;
        font-size: 18px;
        line-height: 31px;
        text-align:center;
        font-family: Arial, Helvetica, sans-serif;
    }
    .transfer_op_btn{
        position: relative;
    top: 2px;
    float: right;
    right: 0;
    height: 36px;
    width: 80px;
    text-align: center;
    background-color: #f45936;
    border-radius: 10px;
    line-height: 36px;
    color: #fff !important;
    font-size: 16px;
    }
</style>
                 

<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>

<script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
