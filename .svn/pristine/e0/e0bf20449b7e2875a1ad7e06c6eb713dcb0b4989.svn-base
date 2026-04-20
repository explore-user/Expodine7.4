<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Take Away - Staff Assign</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="mn/js/modernizr.custom.js"></script>

<script src="js/staff_assign.js"></script>
<style>
body{font-family:inherit;background-image: url(img/take_away_bg.jpg) !important;}
.left_contant_container {height: auto;padding-bottom:0}
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.new_right_drop{margin-top:-8px;}
.discount_text_box{height:30px;line-height:24px;}
.top_container{background-color: rgb(4, 29, 51);}
.top_site_map_cc{background-color: rgb(0, 28, 53);}
.take_staff_view_head{background-color: rgb(35, 89, 115);margin-bottom:2px;}
.cont_staf_view_list{background-color: rgb(16, 51, 68);}
.take_staff_view_cont_cc{background-color: #e2e2e2;height: 335px;min-height: 81vh;padding-top:0;}
.take_staff_view_cc{margin-top: 3px;margin-bottom:0;}.staf_view_list_hd{line-height:40px;}
 .confrmation_overlay{width:100%;height:100%;position:fixed;z-index:999;background-color:rgba(0,0,0,0.8);top:0;}
</style>

</head>

<body>
<div class="container-fluid no-padding">
     <?php include"includes/topbar_takeaway.php"; ?>
 <input type="hidden" name="hidcompmangauth" id="hidcompmangauth" value="<?=$_SESSION['s_compl_manage_auth']?>">

      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
          <a href="take_away_.php"><div class="backto_table_select" style="float:left;width: 130px">
                     <div class="backtable_ico"></div>
                     <div style="width: 100px;" class="tableselect_text">TAKEAWAY </div>
           		 </div></a>
          
          <a href="staff_assign_detail.php" ><div class="backto_table_select" style="float:left;width: 130px;background-color:lightseagreen;margin-left: 25px;">
                     
                     <div style="width: 130px;;color: black" class="tableselect_text12">ASSIGNED ORDERS</div>
           		 </div></a>
          <?php if($_SESSION['online_order_on']=='Y'){ ?>
          <a href="customer_display/qr_order_history.php" ><div class="backto_table_select" style="float:left;width: 130px;background-color:lightsalmon;margin-left: 25px;">
                     
                     <div style="color: black;width: 130px;" class="tableselect_text12">QR ORDERS</div>
           		 </div></a>
          <?php } ?>
          
          
          <ul style="padding-left: 26% ">
					<!--<li><a href="index.php" title=""><span class="home_icon"></span>\</a></li>-->
					<li><a title=""> STAFF ASSIGNING SECTION</a></li>
				</ul>
                
                <div class="top_al_search_cc loaderror" ></div>
               <!-- <div class="top_al_search_cc">
                	 <span style="width: 80%;float: right;"><input class="search" placeholder="Search Code" name="search" type="text"></span>
                </div>-->
            </div>
      		<div style="  min-height:auto;width:100%" class="left_contant_container">
             <style>.staff_ass_left_mob{height: 30px}</style>
            
                <div class="take_staff_view_cc" style="width:60%">
                	<div class="take_staff_view_head">
                    	<div style="background-color:#235973" class="staf_view_hd_num"></div>
                        <div style="width:70%" class="staf_view_list_hd">B I L L S</div>
                        <div class="staff_ass_multisel_chkbox">
                        	<input style="float: right;margin: 8%;" name="" type="checkbox" class="count_check_all" value="">
                        </div>
                    </div><!--take_staff_view_head-->
                    <div class="take_staff_view_cont_cc">
                    	<div class="staff_ass_left_detail_head">
                        	<div style="width:5%;" class="staff_ass_left_mob">SL No</div>
                                <div style="width:15%;" class="staff_ass_left_mob">Bill No</div>
                        	<div style="width:10%;" class="staff_ass_left_mob">Qr Order</div>
                            <div style="width:10%;" class="staff_ass_left_mob">Order Time</div>
                            <div style="width:10%;" class="staff_ass_left_mob"> Qty</div>
                            <div style="width:10%;" class="staff_ass_left_mob">Location</div>
                            <div style="width:15%;" class="staff_ass_left_mob">Name</div>
                             <div style="width:10%;" class="staff_ass_left_mob">Details</div>
                        </div><!--staff_ass_left_detail_head-->
                        
                        <div class="staff_ass_left_detail_main" id="hdbill">
                            
                        </div><!--staff_ass_left_detail_main-->
                        
                        <div class="staff_ass_right_sub_btn_cc" style="bottom:15px !important" id="bottom_report">
                       
                        </div><!--staff_ass_right_sub_btn_cc-->
                        
                        
                    </div><!--take_staff_view_cont_cc-->
                    
                </div><!--take_staff_view_cc-->
                
                
                <!--take_staff_view_cont_cc-->
                  
                  
                  
                  
                  <div class="take_staff_view_cc" style="width:37.5%">
                	<div class="take_staff_view_head">
                    	<div style="  background-color:#235973;" class="staf_view_hd_num"></div>
                        <div class="staf_view_list_hd">S T A F F S </div>
                    </div><!--take_staff_view_head-->
                    <div class="take_staff_view_cont_cc">
                    	<!--<div class="staff_sign_right_staff_time div_dsb">
                        	<div class="staff_sign_right_staff_time_txt">Estimated Delivery Time</div>
                            <input class="est_time_textbox" placeholder="Delivery Time" name="" type="text">&nbsp;<span>min</span>
                        </div>-->
                        
                        <div class="staff_sign_right_staff_name_cc" id="staffs">
                        
                        	
                            
                            
                        </div>
                        <div class="staff_odr_detail_bill_cc_head">ASSIGNED ORDERS</div>
                        <div class="staff_odr_detail_bill_cc" id="billby_staff">
                        
                               
                          
                        </div>
                        <div class="staff_ass_right_sub_btn_cc" style="bottom:15px !important">
                        	<a id="assign_confirm" class="abc confirm_desable_btn" href="#"><div class="staff_ass_right_conf_btn">Confirm</div></a>
                            <!--<a href="#"><div class="staff_ass_right_conf_btn"><img width="20px" src="img/close_ico.png"> Cancel</div></a>-->
                        </div>
                    </div><!--take_staff_view_cont_cc-->
                    <!--take_staff_view_cont_cc-->
                </div><!--take_staff_view_cc-->
            	
                
                
                
            </div><!--left_contant_container-->
    
        
        
        
      </div><!--middle_container-->          
</div><!--container_fluide-->

<div style="display:none;" class="confrmation_overlay"></div>

<div class="staff_asign__odr_details_pop">
    <div class="take_staff_view_cc" style="width:100%;margin:0" id="bill_details_popup">
                	
                    
                    
                    
                    
                    
                    <!--take_staff_view_cc-->
                  </div>
</div>



<div class="staff_ass_confirm_pop_time_cc">
	<div class="take_staff_view_head">
        <div style="background-color:#235973;float: right;width: 10%;margin-top: -2px;" class="staf_view_hd_num">
        <a id="time_pop_close" href="#"><img src="img/close_ico.png"></a></div>
        <div style="width:90%;" class="staf_view_list_hd">Select Delivery Time</div>
    </div><!--take_staff_view_head-->
    <div class="staf_delvr_time_cont">
        <a href="#"><div class="staf_delvr_time_box staf_delvr_time_box_act" time="0">No Time</div></a>
    	<a href="#"><div class="staf_delvr_time_box" time="10">10-min</div></a>
        <a href="#"><div class="staf_delvr_time_box" time="20">20-min</div></a>
        <a href="#"><div class="staf_delvr_time_box" time="30">30-min</div></a>
        <a href="#"><div class="staf_delvr_time_box" time="45">45-min</div></a>
        <a href="#"><div class="staf_delvr_time_box" time="60">1-hr</div></a>
        <a href="#"><div class="staf_delvr_time_box" time="120">2-hr</div></a>
    </div>
    <div class="staff_ass_right_sub_btn_cc" style="position:static;background-color:transparent;">
         <a id="assign_confirm_time_popup" href="#"><div class="staff_ass_right_conf_btn">Submit</div></a>
         <!--<a href="#"><div style="float:left;margin-left:5px;" class="staff_ass_right_conf_btn">Skip</div></a>-->
    </div>
	
</div><!--staff_ass_confirm_pop_time_cc-->


<input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >


 <!--<script src="js/takeaway_staff.js"></script>-->
   <!--<script src="js/takeaway_biilsubmn.js"></script>-->
  <script type="text/javascript">

$(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
        $(".staff_ass_confirm_pop_time_cc").css("display","none");
        $(".confrmation_overlay").css("display","none");
    }
});
      
$(document).ready(function()
{
   var qr_order='';
    var url_check=$('#url_check').val();
    
   var new_id=url_check.split('qr_order_id=');
 
    if(new_id[1]!='' && new_id[1]!='undefined' && new_id[1]!=undefined ){
        
          qr_order=new_id[1];
        
    }
    
    
    
    
    var bills = "";
    var dataString = 'value=hdbill&bills='+bills+"&qr_order="+qr_order;
    $.ajax({
        type: "POST",
        url: "load_staff_assign.php",
        data: dataString,
        success: function(data) {
            $('#hdbill').html(data);
        }
    });
    var auto_refresh = setInterval(
    function ()
    {
        //---------
        var selected_orders = $('.staff_ass_left_detail_cc_act');
        var bills = new Array();
        var billno;
        selected_orders.each(function(){
            billno   =  $(this).attr("billno");
            if(billno!='undefined' && billno!='' && billno!=null){
                bills.push(billno);
            }
         });
        //-------
        var dataString = 'value=hdbill&bills='+bills+"&qr_order="+qr_order ;
           $.ajax({
               type: "POST",
               url: "load_staff_assign.php",
               data: dataString,
               success: function(data) {
                   $('#hdbill').html(data);
                   var bills = $("#bills").val();
//                   alert(bills);
                   var temp = bills.split(",");
                   for (a in temp ) {
                     $("#"+temp[a]+"").addClass('staff_ass_left_detail_cc_act');
                   }
                   
               }
           });
    
    }, 50000); // refresh every 10000 milliseconds

    
    
    //LOAD STAFF
    var staffid = "";
    var dataString = 'value=load_staff&staff='+staffid ;
    $.ajax({
        type: "POST",
        url: "load_staff_assign.php",
        data: dataString,
        success: function(data) {
            $('#staffs').html(data);
            
        }
    });
    
    //---------
    var auto_refresh = setInterval(
    function ()
    {
        //---------
        var staffid = $('.staff_sign_right_staff_name_box_act').attr('id');
       //alert(staffid);
        var dataString = 'value=load_staff&staff='+staffid ;
        $.ajax({
            type: "POST",
            url: "load_staff_assign.php",
            data: dataString,
            success: function(data) {
                $('#staffs').html(data);
                var staffid = $('#staff').val();
                $('#'+staffid+'').addClass('staff_sign_right_staff_name_box_act');
//                alert(staffid);
                

            }
        });
        //-------
       
    
    }, 5000); // refresh every 10000 milliseconds
   //LOAD bottom report
    var dataString = 'value=load_bottom_report' ;
    $.ajax({
        type: "POST",
        url: "load_staff_assign.php",
        timeout: 2000,
        data: dataString,
        success: function(data) {
            $('#bottom_report').html(data);
        }
        
    });
    //---------
    var auto_refresh = setInterval(
    function ()
    {
    $('#bottom_report').load('load_staff_assign.php?value=load_bottom_report').fadeIn(1);
    }, 20000); // refresh every 20000 milliseconds
    
    
    
    
    
   
   
   
    
            
});

//check box check starts
    $(".count_check_all").on('click', function() {//input:checkbox    alert("hihi");
        var $box = $(this);
        if ($box.is(":checked")) {
            $('.staff_ass_left_detail_main_select').addClass('staff_ass_left_detail_cc_act');  
        }else
        {
            $('.staff_ass_left_detail_main_select').removeClass('staff_ass_left_detail_cc_act'); 
        }

    });
//check box check ends

  </script>
 
 
 
</body>

</html>