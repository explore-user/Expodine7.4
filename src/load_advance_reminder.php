<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();

$_SESSION['pagid']=54;

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
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.table_report thead th{padding-left:20px !important;}
.table_report thead td{padding-left:20px !important;}


.table_report td{text-align:left !important;padding-left:10px !important;}
.table_report td.feedbackdisplay{text-align:center !important;}
.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
.color_date{background-color: lightgray}


/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
 
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 30%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
      width: 300px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  
  opacity: 1;
}

[data-tooltip] {
    position: relative;
    z-index: 2;
    cursor: pointer;
}
[data-tooltip]:before { position: absolute;bottom: 40px;top: inherit;left: -107px;background-color: rgba(88, 88, 88, 0.9);}
	[data-tooltip]:after {position: absolute;bottom: 40px;	}
        

</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
			$('#feedbackqstn').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackqstn_q', minLength:1});
			$('#activesrch').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackstatus_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){
	
	
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
</style>
</head>
<body>
    
    <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" > 
    
     <div style="display:none" class="confrmation_overlay_proce"></div>  
    
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
					<li><a style="cursor:pointer">Reminder</a></li>
           
            <div class="load_error_adv">/div>
			
				</ul>
            
                
			</div>
           
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                        
<!--                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
                <?php // include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div>-->
                   
                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                  <strong onclick="view_pop();" style="font-size:20px;color: #A91400;float: left;width: 100%;background-color: #e2e2e2;text-align: center;color: black;padding: 15px">
                                  REMINDER DELIVERY :
                                  <span id="bydate_show"> IN COMING 7 DAYS</span>
                                  </strong>
                               
                           <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:65%">
                               <br>
                               <strong> SEARCH BY </strong>  
                            
                               <br>
                               
                               <input  onkeyup="name_change();" style="float:left;width: 25%;margin-top: 10px;cursor: pointer" type="text" class="form-control filte_new_box" id="name_num"  placeholder="Name-Number" >
                                
                               <input readonly="" onchange="from_change();" style="    margin-left: 15px;float:left;width: 20%;margin-top: 10px;cursor: pointer" type="text" class="form-control filte_new_box" id="date_from"  placeholder="Delivery From" >
                                
                               <input readonly="" onchange="to_change();"   style="float:left;width: 20%;margin-left: 3%;margin-top: 10px;cursor: pointer" type="text" class="form-control filte_new_box" id="date_to" placeholder="Delivery To">
                               
                               
                               <select onchange="return bydate_of();" id="bydate" class="form-control filte_new_box"  style="float:left;width: 25%;margin-left: 3%;margin-top: 10px" >
                                   <option value="">Select</option>
                                   <option value="today">Today</option>
                                   <option selected value="week">In 7 Days</option>
                                    <option value="15days">In 15 Days</option>
                                    <option value="month">In 30 Days</option>
                                    <option value="three_month">In 90 Days </option>
                                    <option value="last_60"> << Last 60 Days >> </option>
                                       
                               </select>
                               
                            </div>
                                 
                                   <div class=" filte_new_box_btn" style="width:120px;float:right;margin-top: 30px;margin-right: 10px">
                                       <a  style="background-color: darkred" href="advance_pay_bill.php"> BACK </a> 
                             
                                  </div>
                                  
                                  
                        </div>
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
<!--                      <div class="btn_cc_2">
                         
                      </div>  -->
                   </div>
                   <div class="col-md-12 contant_table_cc" id="listall_adv">
                        
                           
                     
                   </div>
                     
                    </div>
                </div>
		</div>
	</div>
</div>
</div>
</div>
 
   <div class="menu_list_added_popup_cc" style="display:none" id="menu_detail_popup">
    <div class="menu_list_added_popup">
        <div class="menu_list_added_popup_head">ITEM DETAILS</div>
        <div class="menu_listcontant_tble_sec" id="load_menu_data">

        

        </div>
        <div class="col-lg-12 col-md-12 text-center pop_ftr_btn_sec">
            <a onclick="close_view_pop();"  href="#"><button tabindex="4"> CLOSE </button></a>
        </div>
    </div> 
</div>
    
    <div id="delivery_status_pop" class="main_logout_popup_cc">

     <div class="main_logout_popup" style="height:290px">
         
    <div>
        <h1 style="    margin: 13px 0;" class="logout_contant_txt"> PAYMENT</h1>
      
      <div style="width:100%">
          
          <div class="col-md-4" style="padding-left:5px;padding-right:5px;"><label>TOTAL</label><input class="form-control filte_new_box" id="subtotal" type="text" readonly ></div>
     
          <div class="col-md-4" style="padding-left:0px;padding-right:5px;"><label>ADVANCE PAID</label><input class="form-control filte_new_box" readonly id="amount_paid_old" type="text" ></div>
    
          <div class="col-md-4" style="padding-left:0px;padding-right:5px;"><label>BALANCE: <span style="color:darkred" id="bal_show"></span> </label> <input onkeyup="pay_balance_calc();" id="balance_pay" class="form-control filte_new_box" type="text"  ></div>
     
          <div class="col-md-4" style="padding-left:0px;padding-right:5px;"><label>PAY TYPE <span style="color:darkred" id="bal_show"></span> </label> 
          
                                 <select  class="form-control " id="mode_of_pay" style="width:98px">
                                         <option value="CASH">CASH</option>
                                         <option value="CARD">CARD/UPI</option>
                                        
                                </select>
           </div>
           
           
          <div class="col-md-5" style="padding-left:0px;padding-right:5px;"><label>BANK <span style="color:darkred" id="bal_show"></span> </label>  
              <select  class="form-control " id="bank" style="display:none">
                                         <option value="">SELECT BANK</option>
                                        <?php
                                        
                                        $sql_ds_nos = "select * from tbl_bankmaster where bm_active='Y' ";
                                        $sql_ds = $database->mysqlQuery($sql_ds_nos);
                                        $num_ds = $database->mysqlNumRows($sql_ds);
                                        if ($num_ds) {
                                        while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                                        ?>    
                                        <option value="<?= $result_ds['bm_id']?>"><?= $result_ds['bm_name']?></option>
                                        <?php } }  ?>
                                     </select>
              
               <select  class="form-control " id="bank1" style="pointer-events:none;opacity: 0.5">
                <option value="">SELECT BANK</option>
                </select> 
              
           </div>
           
       </div>
     
      
      
      
      
      
      </div>
      
        <div  class="col-md-12" style="font-size:18px;padding: 10px 0">DELIVERED :  <input data-tooltip="** NOTE : DELIVERY STATUS CAN ONLY BE CHANGED IF PAID AMOUNT IS EQUAL TO TOTAL **" id="delivery_status_check" style="width:18px;height:15px;" type="checkbox" > </div>
     
     
        <div class="btn_logout_yes_no" style="margin-top: 25px;"><a onclick="return pop_yes();" href="#" class="">PAY</a></div>
       
       <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a  style="color:#AB2426 !important"  href="load_advance_reminder.php" class="">EXIT</a></div>
   
    </div>
         <span style="color:darkred;font-size: 12px;margin-top: 5px;float: left;width: 100%;display: none"> [ NOTE : DELIVERY STATUS CAN ONLY BE CHANGED IF PAID AMOUNT IS  GREATER THAN OR EQUAL TO SUBTOTAL ]</span>
   </div>
     </div>
    
    <input id="decimal" value="<?=$_SESSION['be_decimal']?>" type="hidden">
    
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script type="text/javascript">
    
    
   function  pay_balance_calc(){
           
     var sub1=  $('#subtotal').val();
      var adv1=  $('#amount_paid_old').val();
      
       var bal=  $('#balance_pay').val();
       
      var sub =sub1.replace(',','');
      var adv =adv1.replace(',','');
      
      var pb=(sub-adv).toFixed(3);
      
      if(bal==pb){
          $('#delivery_status_check').prop('disabled',false);
      }else{
          $('#delivery_status_check').prop('disabled',true);
          $('#delivery_status_check').prop('checked', false);
      }
      
     
     if(bal>pb){
          $('#balance_pay').val('');
     } 
      
      
     
   }
    
    
    
     function pop_yes(){
         
       var id =  $('#delivery_status_pop').attr('del_id');
       
       var bal=0;
       
      
       
       if($('#balance_pay').is(':disabled')){
           bal=0;  
       }else{
           bal=$('#balance_pay').val();
           
       }
       
       
        var bal_rem=parseFloat($('#bal_show').text())-parseFloat(bal);
       
     if($("#delivery_status_check").is(':checked'))
       {
           var sts='Y';
       }
      else
      {
           sts='N';
      }
      
      var mode= $('#mode_of_pay').val();
      
      var bank=$('#bank').val();
       
       if(mode=='CASH' || (mode=='CARD' && bank!='')){
       
      
        $.post("load_advance_pay.php", {value:'delivery_status',id:id,bal:bal,status:sts,mode:mode,bank:bank,bal_rem:bal_rem},
                                               
            function(data)
            { 
                
                 location.reload();  
              
            });
            
            
        }else{
            
           alert('SELECT BANK');
            
        }
        
     }
     
     
    function delivery_status(id,sb,tot,check){
       
         $('#delivery_status_pop').show();
        
         $('#delivery_status_pop').attr('del_id',id);
         
         var sub22 =sb.replace(',','');
         var adv22 =tot.replace(',','');
         var pb22=(sub22-adv22);
      
         var decimal=$('#decimal').val();
         
         if(pb22>0){
            $('#bal_show').text(pb22.toFixed(decimal));
         }else{
            $('#bal_show').text('PAID'); 
         }
         
       $('#subtotal').val(sb);
       $('#amount_paid_old').val(tot);
       
         $('#balance_pay').focus();
         $('#balance_pay').val('');
         
        if(check=='NO'){
      
             $('#balance_pay').prop('disabled',true);
             $('#delivery_status_check').prop('disabled',false);
          
          
        }else{
            $('#balance_pay').prop('disabled',false);
            $('#delivery_status_check').prop('disabled',true);
        }
        
    }
    
    
    function close_view_pop(){
        $('#menu_detail_popup').hide();
    }
    
    
    
    function reprint(id){
        
        var check = confirm("RE-PRINT RECEIPT ?");
	if(check==true)
	{
          var Bill_print = "Advance_pay";
          $.post("printercheck_1.php", {type:Bill_print},
                                               
            function(data)
            { 
            data=$.trim(data); 
       
            if(data =='')
            {    
            
            
            
        setTimeout(function(){
                               $('.confrmation_overlay_proce').css('display','block');
		             $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                
                           $('.confrmation_overlay_proce').fadeOut(1000);
                        
                         }, 1000);
        $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=reprint_advance&id_reprint="+id,
			success: function(msg)
			{ 
                            
              
                        }
                    });
                    
                   }else{
         alert('Printer Not Available ')    
         location.reload();
        }
     });         
                    
                    
                    
                    }
    }
    
    
    function view_order(mi){
        $('#menu_detail_popup').show();
        
        
         $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=load_menu_details&id_load="+mi,
			success: function(msg)
			{ 
                            
                                      $('#load_menu_data').html(msg)
                        }
                    });
        
        
    }
    
    
    
    
    
    
    
    function bydate_of(){
        
        
        $('#date_from').val('');
       $('#date_to').val('');
        
        var bydate=$('#bydate').val();
        
        if($('#bydate').val()=='week' || $('#bydate').val()==''){
            $('#bydate_show').text('In 7 Days');
        }
        
        if($('#bydate').val()=='today'){
            $('#bydate_show').text('Today');
        }
        
         if($('#bydate').val()=='15days'){
            $('#bydate_show').text('In 15 Days');
        }
        
         if($('#bydate').val()=='month'){
            $('#bydate_show').text('In 30 Days');
        }
        
        
        if($('#bydate').val()=='three_month'){
            $('#bydate_show').text('In 90 Days');
        }
        
        
         if($('#bydate').val()=='last_60'){
            $('#bydate_show').text('Last 60 Days');
        }
         var name=$('#name_num').val(); 
         $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_reminder&bydate="+bydate+"&from_date=&to_date=&name="+name,
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                            
                          
                            
                        }
                    });
         
    }
    
    
   function to_change(){
       $('#bydate').val('');
        
       var from=$('#date_from').val();
       var to=$('#date_to').val();
       
         var dis=from+' - '+to;
       
        $('#bydate_show').text(dis);
         var name=$('#name_num').val(); 
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_reminder&to_date="+to+"&from_date="+from+"&bydate=&name="+name,
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                            
                          
                            
                        }
                    });
   }
   
   function from_change(){
       
       $('#bydate').val('');
         
          
       var from=$('#date_from').val();
       var to=$('#date_to').val();
       
       var dis=from+' - '+to;
       
        $('#bydate_show').text(dis);
     var name=$('#name_num').val(); 
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_reminder&to_date="+to+"&from_date="+from+"&bydate=&name="+name,
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                           
                        }
                    });
   }
   

 function name_change(){
       
       
       var bydate= $('#bydate').val();  
          
       var from=$('#date_from').val();
       var to=$('#date_to').val();
       
       var name=$('#name_num').val();  
       
       var dis=from+' - '+to;
       
        $('#bydate_show').text(dis);
    
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_reminder&to_date="+to+"&from_date="+from+"&bydate="+bydate+"&name="+name,
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                           
                        }
                    });
   }

</script>


<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    
    
$(document).ready(function() {
    
    
    var url_check=$('#url_check').val();
   
    var new_id=url_check.split('set=');

    if(new_id[1]=='load_today'){
        
     $('#bydate').val('today');
        
      setTimeout(function(){   
        bydate_of();
        }, 500);
        
    }
    
    
                       
  $('#mode_of_pay').change(function(){
    
    if($('#mode_of_pay').val()=='CARD'){
        
          $('#bank').show();
          $('#bank1').hide();
    }else{
            
          $('#bank1').show();
          $('#bank').hide();
          
          $('#bank').val('');
          
    }
    
      
   });                
                       
                       
       
                     $.ajax({
			type: "POST",
			url: "load_advance_pay.php",
			data: "value=search_date_reminder&bydate=week&from_date=&to_date=&name=",
			success: function(msg)
			{ 
                            $('#listall_adv').html(msg);
                        }
                    });
                    
   
   $("#listall").tablesorter();
   
 
   
   
   $( "#date_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
               
           });
   
    $( "#date_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
           
  $('#date_to').datepicker('setStartDate', new Date());
   $('#date_from').datepicker('setStartDate', new Date());
   
   

   
   
}); 



    
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>