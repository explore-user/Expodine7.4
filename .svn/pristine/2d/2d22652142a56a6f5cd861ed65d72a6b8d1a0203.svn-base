<?php 
session_start();
//include('includes/session.php'); // Check session
error_reporting(0);
include("database.class.php");     // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=6;

 $sql_login_i  =  $database->mysqlQuery("insert into tbl_inv_kitchen(ti_name,ti_status,ti_type)values('Main Store','Y','main') "); 

 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master` (`u_id`, `u_name`, `cloud_sync`) VALUES('1', 'GM', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master` (`u_id`, `u_name`, `cloud_sync`) VALUES('2', 'KG', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master` (`u_id`, `u_name`, `cloud_sync`) VALUES('3', 'LTR', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master` (`u_id`, `u_name`, `cloud_sync`) VALUES('4', 'MLTR', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master` (`u_id`, `u_name`, `cloud_sync`) VALUES('5', 'Nos', 'N')");

 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_base_unit_master` (`bu_id`, `bu_name`, `cloud_sync`)VALUES('1', 'KG', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_base_unit_master` (`bu_id`, `bu_name`, `cloud_sync`) VALUES('2', 'LTR', 'N')");
 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_base_unit_master` (`bu_id`, `bu_name`, `cloud_sync`)VALUES('3', 'Nos', 'N')");

 $sql_login_dc  =  $database->mysqlQuery("INSERT INTO `tbl_unit_master_combination` (`um_first_id`, `um_second_id`, `cloud_sync`)VALUES('3','5', 'N')");
 
  /////menu main kitchen setup.///
 
 
          $sql_login5  =  $database->mysqlQuery("select mr_inventory_kitchen from tbl_menumaster where mr_inventory_kitchen!=''  "); 
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
	    
          }else{
            
              $sq=$database->mysqlQuery("UPDATE tbl_menumaster SET  mr_inventory_kitchen='1' ");
              
          }
 
 

?>
<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>ITEM MASTER</title>
<meta name="description" content="">
<link href="img/favicon.ico" rel="shortcut icon">
<link href="loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link href="css/timepicki.css" rel="stylesheet">
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
<link rel="stylesheet" href="css/tabs_cont_2.css">
<link rel="stylesheet" href="css/menu_new_22.css">

<style>
    .hover_ul:hover{
        background-color: lightskyblue;
    }
#container{overflow:auto !important; }
#ascrail2002{z-index: 9999999999999999999 !important;left:0px !important } 
.tabs li a{width:24.5% !important;  background-color: rgba(0, 0, 0, 0.8);  margin: 0 0.1%;}
.tabs li a:hover{background-color: rgb(163, 68, 0)}
.tabs li.current a{background-color:rgb(163, 68, 0)}
.md-content{display:inline-block;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{ height: 59vh;min-height: 360px;}

#left_table_scr_cc{height: 63vh;}
.text_displaying_contain{  padding-bottom: 0;margin-bottom:0;border-bottom:3px #fff solid;}
.cc_new{margin: 3px 0 0px 0;}
.master_page_tab_cc{min-height:533px;height: 85vh;}
.filter_main_head {width: 100%;height: 24px !important;line-height: 21px !important;font-size: 14px;}
.menu_view_tbl td{padding:0 !important}
.menu_view_pop_lable{width:90%}
.tab_text_box_cc{height:auto;min-height:32px;}
               /*pagination */
.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.new_print_loading_bill{width:100%;height:100%;position:absolute;top:0;left:0;background-color:rgba(0,0,0,0.7);text-align:center;z-index:9999999999999;padding-top:40vh;}
.new_print_loading_bill img {width:100px;}
#left_table_scr_cc{overflow:visible}
.timepicker_wrap{top: 40px !important;width: 120px;}
.time, .mins, .meridian {width: 33%;}
input.timepicki-input{height: 33px;}
.ti_tx, .mi_tx, .mer_tx{margin: 4px 0;}
.prev, .next{padding: 18px 14px;}
.arrow_top{transform: rotate(180deg);top: -10px;bottom: inherit;left: 40%}
.tab_edt_btn {margin-left: 2%;width: 25px;margin-right: 0}
	.tab_edt_btn:first-child{margin-left: 10px !important}
	.tablesorter thead{padding-right: 13px;}
        .text_displaying_contain{position:relative}
        .menu_total_showing_text{width: auto;color: #333;position: absolute;bottom: 0px;left: 10px;font-size: 15px;font-weight:bold}
	@media (max-width: 1160px){
		.tab_edt_btn {margin-left: 1%;width: 20px;margin-right: 0}
		.tab_edt_btn .fa {font-size: 20px;}
		.tab_edt_btn img{width: 23px;height: auto;}
	}
	@media (max-width: 1144px){
		.tab_edt_btn:first-child{margin-left: 3px !important}
	}
</style>
<style>
    .alert_error_popup_all_in_one_menu{
	width: 250px;
	height: 80px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        
	background-color: #ff0000;
	text-align: center;
	padding: 20px 40px;
	padding-top: 20px;
	z-index: 999999;
	color: #fff;
	font-size: 14px;;
	border-radius: 5px;
	font-family: sans-serif;
}
.alert_error_popup_all_in_one_menu:before{
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    background-color: rgb(0,0,0,0.4);
    content: '';
    z-index: -2;
}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
  <script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
 
  <script type="text/javascript" src="js/jquery-ui-1.10.4.js"></script>
<script>

$(document).on('keydown',function(e)
{
		if(e.keyCode == 27)
			//alert("hiiiii");
		$('.md-close').click();
});
    
 $('.btn_cc_2').click(function(){
    
        $('#menuname').focus();
});


$(document).ready(function(){
    
    
    
   var url_check=$('#url_check').val();
    
   var new_id=url_check.split('load_item=');
   
  
   if(new_id[1]=='menu_inv'){
       
        $('#modal-16').addClass('md-show');
   }
    
/*************************************** Popup function starts *************************************************  */
            
 $(".plusbtn").click(function()
  {
      
           var item_ing   =  $('#item_ing').val();
           var rate_ing   =  $('#rate_ing').val();
           
           var item_ing_menuid   =  $('#item_ing').attr('menuid');
           
           var qty_ing    =  $('#qty_ing').val(); 
           
           var type_ing   =  $('#type_ing').val(); 
           var base =$('#type_ing').attr('base'); 
            
           var rate_type_ing   =  $('#rate_type_ing').val(); 
            
           var weight_ing   =  $('#weight_ing').val(); 
           var waste_qty   =  $('#waste_qty').val(); 
           
           var waste_rate   =  $('#waste_rate').val(); 
               
               if(qty_ing>0){
                   
                var tot_ing    =  (rate_ing*qty_ing); 
                
            }else{
                
                 var tot_ing    =  (rate_ing*weight_ing); 
            }
            
            
    if($('#di_ing').prop('checked')){
        
       var di_ing='Y';
    }else{
       var di_ing='N';
    }
       
      if($('#ta_ing').prop('checked')){
          
       var ta_ing='Y';
    }else{
       var ta_ing='N';
    }  
       
     if($('#hd_ing').prop('checked')){
         
       var hd_ing='Y';
    }else{
       var hd_ing='N';
    }   
    
    if($('#cs_ing').prop('checked')){
        
       var cs_ing='Y';
     }else{
       var cs_ing='N';
    }   
       
          var menu_add_id=$('#ing_menu_name').attr('ing_menuid');
         
          var menu_portion=$('#portion_ing').val(); 
       
           var datastring = "item_ing="+item_ing+"&rate_ing="+rate_ing+"&tot_ing="+tot_ing+"&qty_ing="+qty_ing+"&type_ing="+type_ing+"&menu_add_id="+menu_add_id+
            "&rate_type_ing="+rate_type_ing+"&weight_ing="+weight_ing+"&waste_qty="+waste_qty+"&waste_rate="+waste_rate+"&di_ing="+di_ing+"&ta_ing="+ta_ing+"&hd_ing="+hd_ing+"&cs_ing="+cs_ing+"&item_ing_menuid="+item_ing_menuid+"&menu_portion="+menu_portion+"&base="+base;
            
            if(rate_ing!='' && item_ing!='' &&  rate_type_ing!='' &&  (qty_ing>0 || weight_ing>0)  ){
                  
                 $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 { 
                 
                 var datastring = "menuid_main="+menu_add_id+"&value=check_food_cost"
                 $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 { 
                       
                        var det=$.trim(data).split('*');
                       
                        var di_tot=det[1];  
                        var ta_tot=det[2];  
                        var hd_tot=det[3];  
                        var cs_tot=det[4];  
                        
                      $('#difc').text(di_tot);  $('#tafc').text(ta_tot);  $('#hdfc').text(hd_tot);  $('#csfc').text(cs_tot);
                      
                 }
                 }); 
                 
              var a=JSON.parse(data);
                   
              var decimal=$('#decimal').val();
                        
              $('#item_ing').val('');
              $('#rate_ing').val('');
              $('#tot_ing').val(''); 
              $('#qty_ing').val(''); 
              $('#type_ing').val(''); 
              $('#rate_type_ing').val(''); 
              
              $('#weight_ing').val(''); 
              $('#waste_qty').val(''); 
              $('#waste_rate').val(''); 
                    
                 $('#di_ing').prop('checked', true); 
                 $('#ta_ing').prop('checked', true); 
                 $('#hd_ing').prop('checked', true); 
                 $('#cs_ing').prop('checked', true); 
                 
                 
                    $.each(a, function(i, record) {
                        
                      
                     $("#second_div_main"+record.tmi_id).empty();
                     $("#second_div_main"+record.tmi_id).hide();
                     
                        
                  if(record.tmi_di=='Y'){
                      var checked_di='checked';
                      
                  }else{
                      var checked_di='';
                  }
                  
                  if(record.tmi_ta=='Y'){
                      var checked_ta='checked';
                      
                  }else{
                      var checked_ta='';
                  }
                  
                  if(record.tmi_hd=='Y'){
                      var checked_hd='checked';
                      
                  }else{
                      var checked_hd='';
                  }
                
                if(record.tmi_cs=='Y'){
                      var checked_cs='checked';
                      
                  }else{
                      var checked_cs='';
                  }
                  
              if($('.append_div_main').find('#del_card' + record.tmi_id).length === 0) {
                  
              $(".append_div_main").append("<div class='ingredient_popup_contant_row' id='second_div_main"+record.tmi_id+"'>"+
                     
                      "<div style='width:12%' class='ingredient_item_name'><input readonly value='" + record.tmi_ing_name + "'   id='item_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_qty'><input readonly value='" + record.tmi_portion + "'   class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_qty'><input readonly value='" + record.tmi_ing_unit + "'   id='type_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_portion'><input readonly value='" + record.tmi_rate_type + "'   id='rate_type_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_rate'><input readonly value='" + record.tmi_weight + "' maxlength='5' id='weight_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:8%' class='ingredient_item_rate'><input value='" + record.tmi_ing_qty + "' readonly  id='qty_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_ing_rate + "' readonly  id='rate_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_wastage_qty + "' readonly  id='waste_qty"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_wastage_rate + "' readonly  id='waste_rate"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:2%' class='ingredient_item_rate'><input   id='di_ing"+record.tmd_id+"'  "+checked_di +" class='ingredient_item_txtbox' disabled  type='checkbox'></div>"+
                      "<div style='width:2%' class='ingredient_item_rate'><input   id='ta_ing"+record.tmd_id+"' "+checked_ta +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                      "<div style='width:2%' class='ingredient_item_rate'><input   id='hd_ing"+record.tmd_id+"' "+checked_hd +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                      "<div style='width:2%' class='ingredient_item_rate'><input   id='cs_ing"+record.tmd_id+"' "+checked_cs +" class='ingredient_item_txtbox'disabled  type='checkbox'></div>"+
                      "<div style='margin-top:0px;width: 5%;height: 30px;line-height: 26px;margin-top: 2px;float: left'  id='del_card"+record.tmd_id+"' name='del_card"+record.tmi_id+"' class='menut_add_bq_btn' onclick='return deletecard("+record.tmi_id+","+record.tmi_menuid+");'><img width='20px' src='img/cancel-icon.png'></div>"+
                       "</div>"
                        
                        
              
                    );
                                 
                      }
                         
                     });
                     
                     
                 }
                 
                 });
                   
       }else{
                   
       $('#load_error_ing').show();
       
         
       if(rate_ing==''){
          
          $('#load_error_ing').text('ENTER ITEM RATE');
          $("#rate_ing").focus();
       }
       
       
        if((qty_ing=='' || qty_ing=='0') && $('#weight_ing').is('[readonly]')){
        
          $('#load_error_ing').text('ENTER VALID QTY');
          $("#qty_ing").focus();
        }
        
         if((weight_ing=='' || weight_ing=='0') && $('#qty_ing').is('[readonly]') ){
         
           $('#load_error_ing').text('ENTER VALID  WEIGHT');
           $("#weight_ing").focus();
         }
        
        
        
        if(rate_type_ing==''){
        
          $('#load_error_ing').text('ENTER VALID ITEM');
          $("#item_ing").focus();
        }
        
        
          if(item_ing<3){
          
          $('#load_error_ing').text('ENTER VALID ITEM NAME');
          $("#item_ing").focus();
        }
        
        $('#load_error_ing').delay(1500).fadeOut('slow');
                    
                   }
        });






//$('#mname').focus();

$( "#from_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
             $( "#to_date").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
    
$( "#bar_packing").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'dd-mm-yyyy',
               autoclose: true
           });
           
  $( "#bar_expiry").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'dd-mm-yyyy',
               autoclose: true
           });

$('.md-trigger_ratechange').click( function() { 
   
                                $("#menu_btn").hide();
				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                 $("#ratecategry").val("All");
				$("#menu_rate").show();
				$(".update_btn_menu").show();
			
				//$(".update_btn_menu").addClass("updat_btn_2")
				$('#takeaway_ratecopy').hide();

//takeaway_ratecopy


});

$('.rate_change_close').click( function() { 
	$('#takeaway_ratecopy').hide();
	$(".olddiv").removeClass("new_overlay");
});

$('.rate_change_sub').click( function() { 
	$('#takeaway_ratecopy').hide();
	$(".olddiv").removeClass("new_overlay");
});
$('.tax_change_sub').click( function() { 
	$('#addextratax').hide();
	$(".olddiv").removeClass("new_overlay");
});

$('.added_ok_btn').click( function() { 
	$('.inherit_added_popup').hide();
	$(".olddiv").removeClass("new_overlay");
        $('#addextratax').hide();
        location.reload();
});

$('.md-trigger_taratecopy').click( function() { 

//$("#menu_btn").hide();new
				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                $("#menu_rate").hide();
				$('#takeaway_ratecopy').show();
				$(".olddiv").addClass("new_overlay");


});



$('.md-trigger_rate').click( function() { 
    
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_rate.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
 	}); 
        
        

        
        
	$('.md-trigger_comb').click( function() { 
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_comb.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
        
	$('.md-trigger_image').click( function() { 
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_image.php", {menu:menuid},
				  function(data)
				  {
				     data=$.trim(data);
				     $('.mynewpopupload').html(data);
                                    
				  });  
	});
        
        
	$('.md-trigger_pref').click( function() { 
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_pref.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
        
        $('.menu-add-ons').click( function() { 
            
		          $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_addons.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
	$('.md-trigger_nutr').click( function() { 
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_nutr.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});

	$('.md-trigger_edit').click( function() { 
            
	    var id_str   =  $(this).attr("id");
            
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
                 
                 
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		$('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			
			  $.post("popup/menu_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
                                  
                                   
				  });  
	});
        
	$('.md-trigger_view').click( function() { 
	    var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  
			  $.post("popup/menu_view.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-close_pop').click( function() {  	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
	});
	
	

	
	/***************************************  Popup function starts *************************************************  */
	
	/***************************************  row click starts *************************************************  */
	$('.responstable tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		$('.responstable tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
		
    });
	/***************************************  row click starts *************************************************  */
		
    /****************************************** Tax start **********************************************************/


$('.md-trigger_tax').click( function() { 
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_tax.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});



$('.md-trigger_add_extax').click( function() { 


				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                $("#menu_rate").hide();
				$('#addextratax').show();
				$(".olddiv").addClass("new_overlay");
			

});


	$('#close_popup').click( function() { 
			$('.add_extra_tax_new_poppup').css("display","none");
			$(".olddiv").removeClass("new_overlay");
	});
        
     

    /******************************************Tax End *************************************************************/
    });
</script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
	new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
		type : 'cover'
	} );
</script> 
 <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check_cloud" >

<script type="text/javascript">
$(document).ready(function() {
    
   
    //menu image load///
    
    var cloud_pass=$('#url_check_cloud').val();
    
    if (window.location.href.indexOf('?menu_cloud=') > 0) {
     var new_id=cloud_pass.split('reload=');
    
    
   var mid_cloud=new_id[0].split('menu_cloud=');
     
  var cloud_id=mid_cloud[1].split('&');
    
   if(new_id[1]=='yes'){
       $('#hiddenmenuid').val(cloud_id[0]);
       $('.md-trigger_image').click();
       
   }
   
  
    }
    
    //end////
    
    
    
    
        if(localStorage.page1==''){
            localStorage.page1=1;
            
        }
        
        if(!localStorage.menuname){
           localStorage.menuname='null'; 
        }
        if(!localStorage.catname){
           localStorage.catname='null'; 
        }
        if(!localStorage.subcatname){
           localStorage.subcatname='null'; 
        }
        if(!localStorage.diet){
           localStorage.diet='null'; 
        }
        if(!localStorage.stat){
           localStorage.stat='null'; 
        }
        if(!localStorage.kitch){
           localStorage.kitch='null'; 
        }
        
        if(localStorage.menuname!='null'){
            $('#mname').val(localStorage.menuname);
        }
         if(localStorage.catname!='null'){
            $('#mcate').val(localStorage.catname);
        }
         if(localStorage.subcatname!='null'){
            $('#msubc').val(localStorage.subcatname);
        }
         if(localStorage.diet!='null'){
            $('#mdiet').val(localStorage.diet);
        }
         if(localStorage.stat!='null'){
            $('#mstatus').val(localStorage.stat);
        }
         if(localStorage.kitch!='null'){
            $('#kitchen').val(localStorage.kitch);
        }
           
        if(localStorage.image_see!='null'){
            $('#image_see').val(localStorage.image_see);
        }
        
        if(localStorage.excempt_sr!='null'){
            $('#excempt_sr').val(localStorage.excempt_sr);
        }
        
        if(localStorage.m_ref_cnt!='null'){
            $('#m_ref_cnt').val(localStorage.m_ref_cnt);
        }
        
        
        $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"page":localStorage.page1,"editing_slno":localStorage.editing_slno,"mname":localStorage.menuname,"mcate":localStorage.catname,"msubc":localStorage.subcatname,"mdiet":localStorage.diet,"mstatus":localStorage.stat,"kitchen":localStorage.kitch,"image_see":localStorage.image_see,"excempt_sr":localStorage.excempt_sr,"m_ref_cnt":localStorage.m_ref_cnt}, function(){ //get content from PHP page
                   location.hash='#ids_'+localStorage.editid;
        });
        
	
	//executes code below when user click on pagination links
	$("#menupage").on( "click", ".pagination a", function (e){
		e.preventDefault();
		
		var page = $(this).attr("data-page"); 
                localStorage.page1=page;
		$("#menupage").load("pagination_functions.php",{"value":'load_menupage',"page":page,"editing_slno":localStorage.editing_slno,"mname":localStorage.menuname,"mcate":localStorage.catname,"msubc":localStorage.subcatname,"mdiet":localStorage.diet,"mstatus":localStorage.stat,"kitchen":localStorage.kitch,"image_see":localStorage.image_see,"excempt_sr":localStorage.excempt_sr,"m_ref_cnt":localStorage.m_ref_cnt}, function(){ //get content from PHP page
			
		});
		
	});
});

</script>


<script>
  $(document).ready(function() {
     
  $("#mname").focus();
        
$(".left_table_scr_cc tbody tr").click(function() {
	history.pushState({}, '', 'menu.php' );
    $(this).addClass('table_active').siblings().removeClass("table_active");
});
});

</script>
<script>       
        
        
    
function search_ing(e){
    
       if (localStorage.name_length != $('#item_ing').val().length && localStorage.name_length > 0){
           
           
           $('#rate_ing').val('');
            $('#tot_ing').val(''); 
            $('#qty_ing').val(''); 
             $('#type_ing').val(''); 
            $('#rate_type_ing').val(''); 
             
           $('#weight_ing').val(''); 
            $('#waste_qty').val(''); 
           $('#waste_rate').val(''); 
            
            }
    
     var name=$('#item_ing').val();
     var store= $("#ing_menu_name").attr('ing_store_id');
  
     var data="set=searchname_recipe&name="+name+"&store="+store;
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: data,
        success: function(data)
        { 
             $('#name_load').show();
         
           $('#name_load').html(data);
           
           
        }
    });      
         
}


function  ing_click(n,id,unit,rt_type,rate,base){ 
   
   $('#item_ing').val(n);
   $('#item_ing').attr('menuid',id);
   localStorage.name_length = $("#item_ing").val().length;
              $('#rate_ing').val(rate);
              $('#tot_ing').val(); 
              $('#qty_ing').val(); 
              $('#type_ing').val(unit); 
               $('#rate_type_ing').val(rt_type); 
              
               $('#type_ing').attr('base',base); 
         $('#weight_ing').val(); 
         $('#waste_qty').val(); 
         $('#waste_rate').val(); 
       $('#rate_ing').attr('readonly', true);
   
         $('#name_load').hide();
    
    
                          if(base=='4' || rt_type=='Portion' ){
                                    
                                       if(unit!='Packet'){
                                        $('#weight_ing').attr('readonly', true);
                                          }
                                        $('#qty_ing').attr('readonly', false);
                                        
                                        
                                        if(unit=='Packet' && base=='3'){
                                        $('#weight_ing').attr('readonly', true);
                                           
                                        }
                                       
                                       }else{
                                    
                                          $('#qty_ing').attr('readonly', true);
                                          $('#weight_ing').attr('readonly', false);
                                          
                                        if(unit=='Packet' && (base=='1' || base=='2')){
                                          $('#qty_ing').attr('readonly', false);
                                          
                                        }
                                       
                                        if(unit=='Packet'  && (base=='1' || base=='2' || base=='3')){
                                         
                                           $('#weight_ing').attr('readonly', true);
                                          
                                        }
                                        
                                        
                                         if(unit=='Packet' && base=='3'){
                                          $('#qty_ing').attr('readonly', false);
                                          
                                        }
                                        
                                        if(unit=='Loose' && base=='3'){
                                          $('#qty_ing').attr('readonly', false);
                                          
                                        }
                                        
                                        
                                     }
    
}    
        
   function confirm_yes_new(){
       
       var status= $('#confirm_pop_all').attr('status');
       var id=  $('#confirm_pop_all').attr('id1');
    
       localStorage.editing_slno=$('#editing_slno_'+id).text();
        
        localStorage.page1=$('.pagination li.active').find('a').text();
        
        if(localStorage.page1==''){
            localStorage.page1=1;
        }
        var mname=$('#mname').val();
        if(mname==''){
            mname='null';
        }
        var mcate=$('#mcate').val();
        var msubc=$('#msubc').val();
        var mdiet=$('#mdiet').val();
        var mstatus=$('#mstatus').val();
        var kitchen=$('#kitchen').val();
         var image_see=$('#image_see').val();
        
  var excempt_sr=$("#excempt_sr").val();
  if(excempt_sr=="")
  {
	  excempt_sr="null";
          
  } 
  
  var m_ref_cnt=$("#m_ref_cnt").val();
  if(m_ref_cnt=="")
  {
	  m_ref_cnt="null";
          
  } 
  
	
       
		if(status=="ToYes")
		{
                    var dataString = "id="+id+"&delete=yes";
                        $.ajax({
                        type: "POST",
                        url: "menu.php",
                        data: dataString,
                        success: function(data1) {
                           $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"page":localStorage.page1,"editing_slno":localStorage.editing_slno,"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                   location.hash='#ids_'+id;
                            });
                            
                            
                            
                        }
                    });
		}else
		{
                    var dataString = "id="+id+"&delete=no";
                        $.ajax({
                        type: "POST",
                        url: "menu.php",
                        data: dataString,
                        success: function(data1) {
                            
                            $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"page":localStorage.page1,"editing_slno":localStorage.editing_slno,"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                location.hash = '#ids_'+id;   
                            });
                            
                            
                        }
                    });
		}
	 $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
       
   }      
        
        
function delete_confirm(status,id)
{
    
    $('#confirm_pop_all').show();
                
         $('#confirm_pop_all').attr('status',status);
         $('#confirm_pop_all').attr('id1',id);
    
                if(status=="ToYes")
		{
                        $('#pop_head_com').text('CONFIRM ACTIVE ?');
                }else{
                       $('#pop_head_com').text('CONFIRM INACTIVE ?');
                }
        
	//var check = confirm("Are you sure you want to Change Status?");
        
	
}
</script>
<!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
 <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<!--<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>-->
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE --> 	    
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
 
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
	.has-error{
   
	outline:none !important;
	} 
.form-control:focus	{}	
.has-error:focus{border:solid 1px #f00;
	box-shadow:0 0 3px #f00;
	-moz-box-shadow:0 0 3px #f00;
	-webkit-box-shadow:0 0 3px #f00;
	outline:none !important;
	} 	
</style>
</head>
<body>
    
  <input type="hidden" value="<?=$_SESSION['expodine_id']?>" id="login_id_menu">  
    
<?php

$_SESSION['menuidselect']="";

if(!isset($_SESSION['upload_id']))
{
$_SESSION['upload_id'] = $database->getEpoch();
}

$upload_id	= $_SESSION['upload_id'];


if(isset($_REQUEST['delete']))
{
         $id=$_REQUEST['id'];
	if($_REQUEST['delete']=="yes")
	{
		$database->mysqlQuery("UPDATE tbl_menumaster SET mr_active = 'Y' WHERE mr_menuid = '" .$_REQUEST['id']."'");
	}else
	{
		$database->mysqlQuery("UPDATE tbl_menumaster SET mr_active = 'N' WHERE mr_menuid = '" .$_REQUEST['id']."'");
	}
  
     $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
        
}

//////menu add new /////////

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['menuname']))
{
    
    
        $insertion['mr_menuname'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['menuname']));
         
	 $sql=$database->check_duplicate_entry('tbl_menumaster',$insertion);
	 
         if($_REQUEST['kotcounter']!='' && $_REQUEST['finished_good']!='Raw'){
             
	     $insertion['mr_kotcounter'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['kotcounter']));
         
         }else{
             
             $insertion['mr_kotcounter'] 		= '1';
             
         }
         
         
         if($_REQUEST['reorder_level']!='' ){
             
	    $insertion['mr_reorder_level'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reorder_level']));
         
         }
         
        if($_REQUEST['central_id']!='' ){
              
             
	    $insertion['mr_central_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['central_id']));
         
        }
         
        if($_REQUEST['purcahse_rate']!='' ){
             
	    $insertion['mr_purchase_price'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['purcahse_rate']));
         
        }
         
         
        if($_REQUEST['raw_barcode']!='' ){
             
	    $insertion['mr_raw_barcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['raw_barcode']));
         
        }
         
         if($_REQUEST['hsn_code']!='' ){
             
	    $insertion['mr_hsn'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['hsn_code']));
         
        }
        
        
         
        if(isset($_REQUEST['active']))
	{
            $sts_cld='Y';
	 	$insertion['mr_active'] 		=  'Y';
	}else
	{	 	 $sts_cld='N';
		$insertion['mr_active'] 		=  'N';
	}
	  if(isset($_REQUEST['stock']))
	{
	 	$insertion['mr_dailystock'] 		=  'Y';
	}else
	{	 	
		$insertion['mr_dailystock'] 		=  'N';
	}
	
        if(isset($_REQUEST['dynamicrate']))
	{   $dyn_cld='Y';
	 	$insertion['mr_manualrateentry'] 		=  'Y';
	}else
	{	 	$dyn_cld='N';
		$insertion['mr_manualrateentry'] 		=  'N';
	}
	if(isset($_REQUEST['stockinnumbrs']))
	{
	 	$insertion['mr_dailystock_in_number'] 		=  'Y';
	}else
	{	 	
		$insertion['mr_dailystock_in_number'] 		=  'N';
	}	
	
	if(isset($_REQUEST['showkod']))
	{
	 	$insertion['mr_show_in_kod'] 		=  'Y';
	}else
	{	 	
		$insertion['mr_show_in_kod'] 		=  'N';
	}	
        if(isset($_REQUEST['printin_kot']))
	{
	 	$insertion['mr_show_in_kot_print'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_show_in_kot_print'] 	=  'N';
	}
        
        if(isset($_REQUEST['barcode_in']))
	{
	 	$insertion['manual_barcode'] 	=  'Y';
	}else
	{	 	
		$insertion['manual_barcode'] 	=  'N';
	}
        
         if(isset($_REQUEST['ingredient_on']))
	{
	 	$insertion['mr_ingredient'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_ingredient'] 	=  'N';
	}
        
         if(isset($_REQUEST['qr_menu_set']))
	{
	 	$insertion['mr_qr_set'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_qr_set'] 	=  'N';
	}
        
        if(isset($_REQUEST['exc_disc']))
	{
	 	$insertion['mr_excempt_disc'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_excempt_disc'] 	=  'N';
	}
        
        
         if(isset($_REQUEST['stock_inv']))
	{
	 	$insertion['mr_stock_inventory'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_stock_inventory'] 	=  'N';
	}
        
        
         if(isset($_REQUEST['stock_in_out']))
	{
	 	$insertion['mr_stock_in_out'] 	=  'Y';
	}else
	{	 	
		$insertion['mr_stock_in_out'] 	=  'N';
	}
        
        
        if(isset($_REQUEST['finished_good']))
	{
	 	$insertion['mr_product_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['finished_good'])); 
	}
        
        
	if(isset($_REQUEST['excempt']))
	{
	 	$insertion['mr_excempt_tax'] =  'Y';
	}else
	{	 	
		$insertion['mr_excempt_tax'] =  'N';
	}	
	
	$insertion['mr_description'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['description']));
        
	$insertion['mr_diet'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['diet']));
	
	$insertion['mr_branchid']= $_SESSION['branchofid'];
	   
        $insertion['mr_inventory_kitchen'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['inv_kitchen']);           
      
        $insertion['mr_maincatid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['maincat']);
    
        $insertion['mr_prepmode'] 		=  trim(mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prepmode']));	
	
	if(trim($_REQUEST['subcat'] !=""))
	{
	   $insertion['mr_subcatid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['subcat']));
	}
        
	$insertion['mr_time_min'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['time']));
        
	$insertion['mr_itemshortcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['shortcode']));
        
        if($_REQUEST['item_shortcode']!=""){
           $insertion['mr_itemcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['item_shortcode']));
        }
        
        $insertion['mr_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['ratetype']));
        
	$insertion['mr_unit_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unittype']));
        
        if($_REQUEST['baseunit']!=''){
          $insertion['mr_base_unit'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['baseunit']));
	}
        
        if(isset($_REQUEST['addons']))
	{
	 	$insertion['mr_add_on'] =  'Y';
	}else
	{	 	
		$insertion['mr_add_on'] =  'N';
	}
        
        
        if($_REQUEST['plu_code']!=""){
             
             $insertion['mr_plu'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['plu_code']));
        }
        
        
         $insertion['mr_modifieduser'] 		=  'Local';
        
        if($sql!=1)
	{
            
            
	$insertid              			=  $database->insert('tbl_menumaster',$insertion);
	
	$database->updateexpodine_machines(); 

       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");   
        
        
        
        $lastid='';
	$sql_login  =  $database->mysqlQuery("select mr_menuid from tbl_menumaster where mr_menuname='".$insertion['mr_menuname']."' AND mr_itemshortcode='".$insertion['mr_itemshortcode']."' AND mr_prepmode='".$insertion['mr_prepmode']."'"); 
	
         $num_login   = $database->mysqlNumRows($sql_login);
	 while($result_login  = $database->mysqlFetchArray($sql_login)) 
	 {
		$lastid=$result_login['mr_menuid'];
                                  
                ?>
  
         <input type="hidden" id="new_menuid" value="<?=$lastid?>" >
        
         <?php
        
        }
      
        
        if($_SESSION['firebase_id']!=''){
        
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
            $desc=$_REQUEST['description'];
            $modifydate=date('Y-m-d H:i:s');
            $modify_user='Local';
            $rating=0;
            $sync_android='Y';
            $cloud_sync='Y';
            $item_code='';
            $addon      = 'N';
            $stock      = 'Y';
            $stock_no   = 'N';
            $show_kod   = 'Y';
            $excempt    = 'N';
            $kot_print  = 'Y';
            $barcode    = 'N';
            $ingredient = 'N';
            $replacer   = 'N';
           
            $tm_central_id='0';
             
            
              if($_REQUEST['subcat']!='' && $_REQUEST['subcat']!='0'){
                  
                  $subcat_id="'".$_REQUEST['subcat']."'";
             }else{
                 $subcat_id='NULL';
             }
             
             
              if($_REQUEST['inv_kitchen']!='' && $_REQUEST['inv_kitchen']!='0'){
                  
                  $store_id=$_REQUEST['inv_kitchen'];
             }else{
                 
                 $store_id='0';
             }
             
              if($_REQUEST['kotcounter']!='' && $_REQUEST['finished_good']!='Raw'){
                  
                  $counter=$_REQUEST['kotcounter'];
             }else{
                 
                 $counter='1';
             }
             
             if($_REQUEST['baseunit']!='' && $_REQUEST['baseunit']!=null){
                  
                  $baseunit="'".$_REQUEST['baseunit']."'";
             }else{
                 $baseunit='0';
             }
             
             
               //////////menu adding ////////////
             
              $localhost17=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
              
              if($_REQUEST['item_shortcode']!='' && $_REQUEST['item_shortcode']!='NULL' && $_REQUEST['item_shortcode']!='0' && $_REQUEST['item_shortcode']!=NULL){
                
               $sql_gen =  mysqli_query($localhost17,"INSERT INTO `tbl_menumaster`(branchid,mr_menuid,`mr_menuname`, `mr_maincatid`, `mr_subcatid`, "
             . " `mr_description`, `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`,"
             . " `mr_rating`, `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, `mr_itemcode`, "
             . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`, `mr_unit_type`,"
             . " `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`,`manual_barcode`,mr_ingredient,"
             . " mr_replacer,mr_central_id,mr_product_type,mr_inventory_kitchen,mr_delete_mode) "
                          
             . " VALUES ('".$_SESSION['firebase_id']."','$lastid', '".$_REQUEST['menuname']."',"
             . " '".$_REQUEST['maincat']."',$subcat_id,'".$desc."','General','10',"
             . " '$sts_cld', '$counter',"
             . " '".$modifydate."','".$modify_user."', '".$rating."','General', '1','".substr($_REQUEST['menuname'],0,25)."',"
             . " '".$stock."','$dyn_cld',"
             . " '".$_REQUEST['item_shortcode']."','".$stock_no."','".$sync_android."','".$show_kod."','".$excempt."','".$_REQUEST['ratetype']."',"
             . " '".$_REQUEST['unittype']."','$baseunit','".$addon."','".$kot_print."',"
             . " '".$cloud_sync."','".$barcode."','".$ingredient."','".$replacer."',$tm_central_id ,"
             . " '".$_REQUEST['finished_good']."','$store_id','N' ");
             
              
            }else{
                  
             $sql_gen =  mysqli_query($localhost17,"INSERT INTO `tbl_menumaster`(branchid,mr_menuid,`mr_menuname`, `mr_maincatid`, `mr_subcatid`, "
             . " `mr_description`, `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`,"
             . " `mr_rating`, `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, "
             . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`, `mr_unit_type`,"
             . " `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`,`manual_barcode`,"
             . " mr_ingredient,mr_replacer,mr_central_id,mr_product_type,mr_inventory_kitchen,mr_delete_mode) "
                          
             . " VALUES ('".$_SESSION['firebase_id']."','$lastid','".$_REQUEST['menuname']."',"
             . " '".$_REQUEST['maincat']."',$subcat_id,'".$desc."','General','10',"
             . " '$sts_cld', '$counter',"
             . " '".$modifydate."','".$modify_user."', '".$rating."','General', '1','".substr($_REQUEST['menuname'],0,25)."',"
             . " '".$stock."','$dyn_cld',"
             . "   '".$stock_no."','".$sync_android."','".$show_kod."','".$excempt."','".$_REQUEST['ratetype']."',"
             . " '".$_REQUEST['unittype']."','$baseunit','".$addon."','".$kot_print."',"
             . " '".$cloud_sync."','".$barcode."','".$ingredient."','".$replacer."',"
             . " $tm_central_id , '".$_REQUEST['finished_good']."','$store_id','N' )");
             
             
            }
            
         //////////menu adding Cloud ends ////////////////
      
        }
        }
      
      
      
     /////rate apply all ///
            
    if($_REQUEST['sale_rate_all']>0 && $_REQUEST['sale_rate_all']!=''){  
        
    $menu_baseunit_id       =0;
    $unit_type              ='';
    $unit_weight            =0;
    $portion                =0;
    $rate                   = $_REQUEST['sale_rate_all'];
    $unit_id                =0;
    $base_unit_id           =0;
    $menuid=$lastid;
    
    $barcode                = $_REQUEST['raw_barcode'];
    
    $rate_type='Portion';
    
    $portion            ='1';   
    
        $tax=0;
        $tax_amount=0;
        $final_rate=$_REQUEST['sale_rate_all'];
   
        $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','Rate : $rate ','".$_SESSION['expodine_id']."','Rate All From ADD','CS')");
    
        $database->mysqlQuery("SET @menuid      = " . "'" . $menuid . "'");
        $database->mysqlQuery("SET @ratetype    = " . "'" . $rate_type . "'");
        $database->mysqlQuery("SET @portion     = " . "'" . $portion . "'");
        $database->mysqlQuery("SET @unittype    = " . "'" . $unit_type . "'");
        $database->mysqlQuery("SET @unitweight  = " . "'" . $unit_weight . "'");
        $database->mysqlQuery("SET @unitid      = " . "'" . $unit_id . "'");
        $database->mysqlQuery("SET @baseunitid  = " . "'" . $base_unit_id . "'");
        $database->mysqlQuery("SET @rate        = " . "'" . $rate . "'");
        $database->mysqlQuery("SET @barcode     = " . "'" . $barcode . "'");
        
        $database->mysqlQuery("SET @tax_value     = " . "'" . $tax . "'");
         $database->mysqlQuery("SET @tax_amount     = " . "'" . $tax_amount . "'");
         $database->mysqlQuery("SET @final_rate     = " . "'" . $final_rate . "'");
        $Message='';

        $sq=$database->mysqlQuery("CALL proc_menu_rate_applyall(@menuid,@ratetype,@portion,@unittype,@unitweight,@unitid,@baseunitid,@barcode,@rate,@tax_value,@tax_amount,@final_rate,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));

        $rs = $database->mysqlQuery( 'SELECT @Message as Message' );
        while($row = mysqli_fetch_array($rs))
        {
        
        $Message=$row['Message'];

        
        }
        
  }
        
    ////////////////////////////////////end rate////////////
      
      
      
      
      
      
		  
      if (!headers_sent())
      {    
      
        exit;
        
      }else{
          
         if($_REQUEST['finished_good'] !='Raw' && $_REQUEST['sale_rate_all']=='' ){
          
         echo '<script type="text/javascript">';
         echo '$(document).ready(function(){';
                          
         echo "   $('.new_print_loading_bill').css('display','block');
               $('.responstable tr').removeClass('table_active');
               $('.responstable tr').addClass('table_active'); 
               $('.mynewpopupload').css('display','block'); 
               var new_menuid=$('#new_menuid').val();
              
               $('.olddiv').addClass('new_overlay'); 
                  $.ajax({
			type: 'POST',
			url: 'popup/menu_rate.php',
			data: 'menu='+new_menuid,
			success: function(data)
			{  
		        
			  data=$.trim(data);
                             
			  $('.mynewpopupload').html(data);
                          $('.new_print_loading_bill').css('display','none'); 
                          
                         
                          $('#dineinfloor').val('1'); 
                           
                                setTimeout(function(){
                                    $('#di_menu_rate').focus();
                                },1000); 


			}
		
                 });";
        
        echo '});';
        echo '</script>';
        echo '<noscript>';
        
        echo '</noscript>'; 
        
            }
          
       }
       }else{
            
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
        echo 'var nutstatus12=$("#nutstatus123");';
	echo 'nutstatus12.text("Already exists");';
	echo '});';
        echo '</script>';
	
	}
}




///menu update/////

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['menuname1']))
{
    
	$id=$_REQUEST['menuidnew'];
        
	$menu=trim($_REQUEST['menuname1']);
        
        $description=trim($_REQUEST['description1']);
        
        $diet=trim($_REQUEST['diet1']);
    
    
        if($_REQUEST['finished_edit']!='Raw'){
            
	    $kotcounter=trim($_REQUEST['kotcounter1']);
        
        }else{
            $kotcounter='1';
            
        }
        
        
         if($_REQUEST['reorder_level1']!=''){
            
	    $reorder_level=trim($_REQUEST['reorder_level1']);
        
        }else{
            $reorder_level='0';
            
        }
        
        
        if($_REQUEST['raw_barcode1']!=''){
            
	    $raw_barcode=trim($_REQUEST['raw_barcode1']);
        
        }else{
            $raw_barcode=NULL ;
            
        }
        
        
        
        if($_REQUEST['purcahse_rate1']!='Raw'){
            
	    $purcahse_rate=trim($_REQUEST['purcahse_rate1']);
        
        }else{
            $purcahse_rate='0';
            
        }
        
       
         if($_REQUEST['central_id1']!=''){
            
	    $central_id1=trim($_REQUEST['central_id1']);
        
        }else{
            $central_id1=null;
            
        }
           
        
	$maincat=trim($_REQUEST['maincat1']);
        
	$prepmode=trim($_REQUEST['prepmode1']);
        
	$time=trim($_REQUEST['time1']);
        
	$shortcode=trim($_REQUEST['shortcode1']);
    
        $item_shortcode=trim($_REQUEST['item_shortcode1']);
       
	$brid=$_SESSION['branchofid'];
        
	if(isset($_REQUEST['active1']))
	{
	     $active='Y';
	}else
	{	 	
	     $active='N';
	}
	
	
	 if(isset($_REQUEST['dynamicrate1']))
	{
	 	$dynamicrate1='Y';
	}else
	{	 	
	        $dynamicrate1='N';
	}
	
	
	if(isset($_REQUEST['stock1']))
	{
		$stock1='Y';
	}
	else
	{	 	
	       $stock1='N';
	}
        
	if(isset($_REQUEST['stockinnumbrs1']))
	{
		
	 	$stockinnumbrs1='Y';
	}
	else
	{	 	
	        $stockinnumbrs1='N';
	}
        
        
        if(isset($_REQUEST['showkod1']))
	{
		
	       $showkodedit='Y';
	}
	else
	{	 	
	       $showkodedit='N';
	}
        
           if(isset($_REQUEST['printin_kot1']))
	{
		
	 	  $printin_kot_edit='Y';
	}
	else
	{	 	
	          $printin_kot_edit='N';
	}
        
        if(isset($_REQUEST['barcode_edit']))
	{
		
	 	$barcode_edit='Y';
	}
	else
	{	 	
	        $barcode_edit='N';
	}
        
        
         if(isset($_REQUEST['qr_menu_edit']))
	{
		
	      $qr_menu_edit='Y';
	}
	else
	{	 	
	     $qr_menu_edit='N';
	}
        
        
         
         if(isset($_REQUEST['exc_disc_edit']))
	{
		
	     $exc_disc_edit='Y';
	}
	else
	{	 	
	     $exc_disc_edit='N';
	}
        
        
         if(isset($_REQUEST['stock_inv_edit']))
	{
		
	     $stock_inv_edit='Y';
	}
	else
	{	 	
	     $stock_inv_edit='N';
	}
        
          if(isset($_REQUEST['stock_in_out_edit']))
	{
		
	     $stock_in_out_edit='Y';
	}
	else
	{	 	
	     $stock_in_out_edit='N';
	}
        
        
        
         if(isset($_REQUEST['ingredient_edit']))
	{
		
	     $ing_edit='Y';
	}
	else
	{	 	
	     $ing_edit='N';
	}
        
        
         if(isset($_REQUEST['finished_edit']))
	{
		
	      $finished_edit=$_REQUEST['finished_edit'];
	}
	
        
        if(isset($_REQUEST['excempt1']))
	{
		
	     $excempt1='Y';
	}
	else
	{	 	
	     $excempt1='N';
	}
        
        
        if(isset($_REQUEST['addons1']))
	{
	    $addon='Y';
	}else
	{	 	
	    $addon='N';
	}
        
        
        ///menu log entry////
        
        $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
        VALUES ('$date_log_in','$id','Menu Updated','".$_SESSION['expodine_id']."','Master','Menu')");
        
        
        
        ///Inventorty store stock update////
        
        if($_REQUEST['ratetype']=='Portion'){
            
            $inv_rt='Single';
            $inv_ut='Single';
            
        }else{
            
            if($_REQUEST['unittype']=='Loose'){
                  $inv_rt='Loose';
                
            }else if($_REQUEST['unittype']=='Packet'){
                  $inv_rt='Packet';
            } 
            
           
            if($_REQUEST['baseunit']=='1'){
                  $inv_ut='KG';
                
            }else if($_REQUEST['baseunit']=='2'){
                  $inv_ut='LTR';
            } 
            else if($_REQUEST['baseunit']=='3'){
                  $inv_ut='Nos';
            } 
            
            
        }
        
       $query37=$database->mysqlQuery("update tbl_store_stock set ts_unit='$inv_ut' ,ts_rate_type='$inv_rt' where ts_product='".$id."' ");
        
       
      ///Inventorty store stock update ////
        
        
	if($_REQUEST['baseunit']!=''){
            
	if(trim($_REQUEST['subcat1']!=""))
	{   
            
        $subcat=trim($_REQUEST['subcat1']);
            
        if(trim($_REQUEST['item_shortcode1']!="")){
		 
        if($_REQUEST['plu_code1']!=""){
        
         $query3=$database->mysqlQuery("update tbl_menumaster set  mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                 . "mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."', "
                 . "mr_purchase_price='".$purcahse_rate."',mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                 . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                 . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',"
                 . "mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode='".$item_shortcode."',mr_active='".$active."',"
                 . "mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',"
                 . "mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',mr_excempt_tax='".$excempt1."',"
                 . "mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."',"
                 . " mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',mr_base_unit='".$_REQUEST['baseunit']."',"
                 . " mr_unit_type='".$_REQUEST['unittype']."',mr_hsn='".$_REQUEST['hsn_code1']."', "
                 . " mr_stock_in_out='$stock_in_out_edit',mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");
        
        }else{
                     
          $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                  . " mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                  . "mr_purchase_price='".$purcahse_rate."',mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                  . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                  . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',"
                  . "mr_itemcode='".$item_shortcode."',mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',"
                  . "mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',"
                  . "mr_show_in_kod='".$showkodedit."',mr_excempt_tax='".$excempt1."',mr_show_in_kot_print='".$printin_kot_edit."',"
                  . "manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',"
                  . "mr_rate_type='".$_REQUEST['ratetype']."',mr_base_unit='".$_REQUEST['baseunit']."',mr_unit_type='".$_REQUEST['unittype']."' "
                  . " ,mr_hsn='".$_REQUEST['hsn_code1']."', mr_stock_inventory='$stock_inv_edit',mr_stock_in_out='$stock_in_out_edit' where mr_menuid='".$id."'");        
                     
                     
         }
                 
                 
       }else {
            
       if($_REQUEST['plu_code1']!=""){
                
          $query3=$database->mysqlQuery("update  tbl_menumaster set mr_central_id='$central_id1', mr_excempt_disc='$exc_disc_edit',"
                  . "mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                  . "mr_purchase_price='".$purcahse_rate."',mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                  . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                  . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',"
                  . "mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,mr_active='".$active."',mr_add_on='".$addon."' ,"
                  . "mr_dailystock='".$stock1."',mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',"
                  . "mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',mr_excempt_tax='".$excempt1."' ,"
                  . "mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."',"
                  . " mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',mr_base_unit='".$_REQUEST['baseunit']."',"
                  . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."' , "
                  . " mr_stock_in_out='$stock_in_out_edit',mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");
         
            }else{
               
          $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',  mr_excempt_disc='$exc_disc_edit',"
                  . "mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                  . "mr_purchase_price='".$purcahse_rate."',mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                  . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                  . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',"
                  . "mr_itemcode=NULL,mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',mr_branchid='".$brid."',"
                  . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                  . "mr_excempt_tax='".$excempt1."' ,mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                  . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
                  . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_base_unit='".$_REQUEST['baseunit']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                  . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");      
                
            }
     
        }
            
            
        }
	else
	{
            
            if(trim($_REQUEST['item_shortcode1']!="")){
                 
            if($_REQUEST['plu_code1']!=""){  
                 
                 
            $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                    . " mr_qr_set='$qr_menu_edit',  mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."',"
                    . " mr_purchase_price='".$purcahse_rate."', mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                    . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                    . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_time_min='".$time."',"
                    . "mr_itemshortcode='".$shortcode."',mr_itemcode='".$item_shortcode."',mr_active='".$active."',mr_add_on='".$addon."',"
                    . "mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',"
                    . "mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',mr_excempt_tax='".$excempt1."',"
                    . "mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."', "
                    . "mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',mr_base_unit='".$_REQUEST['baseunit']."',"
                    . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."' , mr_stock_inventory='$stock_inv_edit' , "
                    . " mr_stock_in_out='$stock_in_out_edit' where mr_menuid='".$id."'");
             
            }else{
                     
            $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                    . " mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                    . "mr_purchase_price='".$purcahse_rate."',mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                    . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                    . "mr_prepmode='".$prepmode."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode='".$item_shortcode."',"
                    . "mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',"
                    . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                    . "mr_excempt_tax='".$excempt1."',mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                    . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
                    . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_base_unit='".$_REQUEST['baseunit']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                    . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'");   
             
            }
            
            
            
             }  else {
                 
                 
                  if($_REQUEST['plu_code1']!=""){  
                 
                 $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                         . " mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."', "
                         . "mr_purchase_price='".$purcahse_rate."',mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                         . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                         . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_time_min='".$time."',"
                         . "mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',"
                         . "mr_subcatid=NULL,mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',"
                         . "mr_show_in_kod='".$showkodedit."',mr_excempt_tax='".$excempt1."' ,mr_show_in_kot_print='".$printin_kot_edit."',"
                         . "manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',"
                         . "mr_rate_type='".$_REQUEST['ratetype']."',mr_base_unit='".$_REQUEST['baseunit']."',mr_unit_type='".$_REQUEST['unittype']."' "
                         . " ,mr_hsn='".$_REQUEST['hsn_code1']."', mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");
             
                 
                  }else{
                      
                      $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_excempt_disc='$exc_disc_edit',"
                              . "mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."', "
                              . "mr_purchase_price='".$purcahse_rate."',mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                              . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                              . "mr_prepmode='".$prepmode."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,"
                              . "mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',"
                              . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                              . "mr_excempt_tax='".$excempt1."' ,mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                              . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
                              . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_base_unit='".$_REQUEST['baseunit']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                              . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'");
                  }
                 
             }
             
              
		
	}
    }
    else{
        
        if(trim($_REQUEST['subcat1']!=""))
	{    
            
            $subcat=trim($_REQUEST['subcat1']);
            if(trim($_REQUEST['item_shortcode1']!="")){
		
                 if($_REQUEST['plu_code1']!=""){  
                
        $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit',mr_excempt_disc='$exc_disc_edit',"
                . " mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', mr_purchase_price='".$purcahse_rate."', "
                . "mr_plu='".$_REQUEST['plu_code1']."',mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',"
                . "mr_itemcode='".$item_shortcode."',mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',"
                . "mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',"
                . "mr_show_in_kod='".$showkodedit."',mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_excempt_tax='".$excempt1."',"
                . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_rate_type='".$_REQUEST['ratetype']."',mr_unit_type='".$_REQUEST['unittype']."'  , "
                . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");
                 }else{
                     
        $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1',mr_excempt_disc='$exc_disc_edit',"
                . " mr_qr_set='$qr_menu_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."', "
                . "mr_purchase_price='".$purcahse_rate."', mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',"
                . "mr_itemcode='".$item_shortcode."',mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',"
                . "mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',"
                . "mr_show_in_kod='".$showkodedit."',mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_excempt_tax='".$excempt1."',"
                . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_rate_type='".$_REQUEST['ratetype']."',mr_unit_type='".$_REQUEST['unittype']."' , "
                . " mr_stock_in_out='$stock_in_out_edit',mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'"); 
                 }
        
                 }
       else {
           
            if($_REQUEST['plu_code1']!=""){  
           
             $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit', mr_excempt_disc='$exc_disc_edit',"
             . " mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', mr_purchase_price='".$purcahse_rate."', "
             . "mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
             . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
             . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,"
             . "mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',mr_branchid='".$brid."',"
             . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
             . "mr_excempt_tax='".$excempt1."' ,mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
             . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
             . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."' , "
             . " mr_stock_in_out='$stock_in_out_edit',mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");
          
            }else{
                
     $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit', "
             . "mr_excempt_disc='$exc_disc_edit',mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
             . "mr_purchase_price='".$purcahse_rate."', mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
             . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
             . "mr_prepmode='".$prepmode."',mr_subcatid='".$subcat."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',"
             . "mr_itemcode=NULL,mr_active='".$active."',mr_add_on='".$addon."' ,mr_dailystock='".$stock1."',mr_branchid='".$brid."',"
             . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
             . "mr_excempt_tax='".$excempt1."' ,mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
             . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
             . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
             . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit' where mr_menuid='".$id."'");  
            }
     
     
       }
        }
	else
	{
             if(trim($_REQUEST['item_shortcode1']!="")){
                 
          if($_REQUEST['plu_code1']!=""){   
           $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit',"
                   . "mr_excempt_disc='$exc_disc_edit', mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                   . "mr_purchase_price='".$purcahse_rate."',mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                   . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                   . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_time_min='".$time."',"
                   . "mr_itemshortcode='".$shortcode."',mr_itemcode='".$item_shortcode."',mr_active='".$active."',mr_add_on='".$addon."',"
                   . "mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',"
                   . "mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                   . "mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',"
                   . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_excempt_tax='".$excempt1."',"
                   . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_rate_type='".$_REQUEST['ratetype']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                   . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'");
            
                 }else{
                     
          $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit',"
                  . "mr_excempt_disc='$exc_disc_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."',"
                  . " mr_purchase_price='".$purcahse_rate."', mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                  . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                  . "mr_prepmode='".$prepmode."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode='".$item_shortcode."',"
                  . "mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',"
                  . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                  . "mr_show_in_kot_print='".$printin_kot_edit."',manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."', "
                  . "mr_product_type='".$finished_edit."',mr_excempt_tax='".$excempt1."',mr_rate_type='".$_REQUEST['ratetype']."',"
                  . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."'  , "
                  . " mr_stock_in_out='$stock_in_out_edit',mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'"); 
                 }
            
            
             }  else {
                 
                  if($_REQUEST['plu_code1']!=""){   
                 
                 $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit', "
                         . "mr_excempt_disc='$exc_disc_edit',mr_raw_barcode='$raw_barcode',mr_reorder_level='".$reorder_level."', "
                         . "mr_purchase_price='".$purcahse_rate."',mr_plu='".$_REQUEST['plu_code1']."', mr_menuname='".$menu."',"
                         . "mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',mr_description='".$description."',mr_diet='".$diet."',"
                         . "mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',mr_prepmode='".$prepmode."',mr_time_min='".$time."',"
                         . "mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',"
                         . "mr_subcatid=NULL,mr_branchid='".$brid."',mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',"
                         . "mr_show_in_kod='".$showkodedit."',mr_show_in_kot_print='".$printin_kot_edit."',mr_excempt_tax='".$excempt1."' ,"
                         . "manual_barcode='".$barcode_edit."',mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',"
                         . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_rate_type='".$_REQUEST['ratetype']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                         . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'");
             
                  }else{
                      
                     $query3=$database->mysqlQuery("update tbl_menumaster set mr_central_id='$central_id1', mr_qr_set='$qr_menu_edit',"
                             . "mr_excempt_disc='$exc_disc_edit', mr_raw_barcode='$raw_barcode', mr_reorder_level='".$reorder_level."', "
                             . "mr_purchase_price='".$purcahse_rate."', mr_menuname='".$menu."',mr_inventory_kitchen='".$_REQUEST['inv_kitchen1']."',"
                             . "mr_description='".$description."',mr_diet='".$diet."',mr_kotcounter='".$kotcounter."',mr_maincatid='".$maincat."',"
                             . "mr_prepmode='".$prepmode."',mr_time_min='".$time."',mr_itemshortcode='".$shortcode."',mr_itemcode=NULL,"
                             . "mr_active='".$active."',mr_add_on='".$addon."',mr_dailystock='".$stock1."',mr_subcatid=NULL,mr_branchid='".$brid."',"
                             . "mr_manualrateentry='".$dynamicrate1."',mr_dailystock_in_number='".$stockinnumbrs1."',mr_show_in_kod='".$showkodedit."',"
                             . "mr_show_in_kot_print='".$printin_kot_edit."',mr_excempt_tax='".$excempt1."' ,manual_barcode='".$barcode_edit."',"
                             . "mr_ingredient='".$ing_edit."', mr_product_type='".$finished_edit."',mr_rate_type='".$_REQUEST['ratetype']."',"
                             . " mr_hsn='".$_REQUEST['hsn_code1']."',mr_unit_type='".$_REQUEST['unittype']."' ,"
                             . " mr_stock_in_out='$stock_in_out_edit', mr_stock_inventory='$stock_inv_edit'  where mr_menuid='".$id."'");  
                  }
             }
    }
    
    
    }
    
    
    $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' "); 
    
    
    ?>
        
  <script type="text/javascript">
   event.preventDefault() ;
  </script> 
  
    <?php  } ?>
  
  
  
    
 <script type="text/javascript">
 $(document).ready(function(){
     
    $('.added_ok_btn').click(function () { 
    $('.inherit_added_popup').css("display","none");
    $('.change_permission_overlay').css("display","none");
    
    });
    
 });
    
 </script>   
 
    
 <style>
      .change_permission_overlay{
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 width:100%;
	 height:100%;
	 top:0;
	 left:0;
	 z-index:999999;
	 display:none;
	 }
         
      .change_permission_content{
	width:100%;
	height:auto;
	float:left;
	padding:2%;
	}
      .change_permission_popup_btn{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	margin-top:-2px;
	}
        
     .change_permission_popup_btn .pop_btn_new_1 {
        width: 100px;
        height: 25px;
        line-height: 23px !important;
	}
      .change_permission_popup h3 {
        margin: 0;
        padding: 0.4em;
        text-align: center;
        font-size: 1.4em;
        font-weight: 300;
        opacity: 0.8;
        background: rgba(0,0,0,0.2);
        border-bottom: 1px #9A9898 solid;
        border-radius: 3px 3px 0 0;
        color:#000;
}
	
</style>

 <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id="decimal"  > 
 <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
 
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">

  <?php include "includes/topbar_master.php"; ?>
  <?php include "includes/left_menu.php"; ?>
    
  <div class="sitemap_cc">Item Master</div>
  <div class="mian">
	<div class="view-container">
		<div  style="top: 58px;" id="container">
        
        <div class="breadcrumbs">
        
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Item</a> </li>
                                       <span id="ratechange" class="load_error alertsmaster" style="color:#F00" ></span>  
				</ul>
            
                
	</div>
                    
             <div class="content-sec">
                
                
              
               <div class="main_cc">
                    <div class="cc_new_main">
                    	<div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                     <div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div>
                    
                    
                    
                    </div>
                     
                    	
                    </div>
                    <div class="col-lg-12 col-md-12 middle_container nopadding">
                    <div style="padding:0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                    <div class="col-lg-12 col-md-12 min-height nopadding">
                    <div class="text_displaying_contain">
                              
 				<div class="master_page_tab_cc">
                                <div class="menu_top_filter_left">
                                    
                                    <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:100% !important;">
                    	            <div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;margin-bottom:5px;width:17%">
                                    <p class="menu_filter_txt">Item Name</p>
                                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Item  Name"  autocomplete="off"  onkeyup="validateSearch()">
			            </div>
                                        
                           <div class="col-sm-2" style="padding-right: 5px;padding-left:5px;margin-bottom:5px;width:10%">
                           <p class="menu_filter_txt">Item Type </p>
                           <select class="add_text_box"  id="excempt_sr" name="excempt_sr" onChange="validateSearch()">
                               <option value="">All</option>  
                                     <option  value="Menu">Item</option>
                                 
                                      <?php if(in_array("inventory", $_SESSION['menuarray'])) { 
                                          
                                         if($_SESSION['s_inventory_staff_add']=='Y'){   
                                          
                                          ?>
                    
                                            <option value="Finished">Finished Good</option>
                                            <option value="Raw">Raw Material</option>
                                            
                                      <?php } } ?>  
                                            
                                      
                           </select>                                                 
                        </div>    
                                        
					<div class="col-sm-2" style="padding-right: 0px;padding-left:0px;margin-bottom:5px;width:9%">
                                        <p class="menu_filter_txt">Category</p>
                                       
                                        <select  class="add_text_box"  id="mcate" name="mcate" onChange="validateSearch()">
                                        <option value="null" default>Select Category</option>
                                                <?php
						$sql_login  =  $database->mysqlQuery("select distinct(mmy_maincategoryname) from tbl_menumaincategory where mmy_active='Y' order by mmy_displayorder "); 
						
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
						while($result_login  = $database->mysqlFetchArray($sql_login)) 
						    {
	 					?>
                                        <option value="<?=$result_login['mmy_maincategoryname']?>"><?=$result_login['mmy_maincategoryname']?></option>
                                        <?php } } ?>	
                                        <option value="null" default>All</option>
                                        </select>
					</div>
                                    <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:9%">
                                    <p class="menu_filter_txt">Sub Cat</p>
                                    <!-- <input type="text" class="form-control" id="msubc" name="msubc" placeholder="Subcategory" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()"> -->
                                    <select  class="add_text_box"  id="msubc" name="msubc" onChange="validateSearch()">
                                    <option value="null" default>Select Sub Cat</option>
                                 
                                    <?php
                                    $sql_login  =  $database->mysqlQuery("select distinct(msy_subcategoryname) from tbl_menusubcategory where msy_active='Y' "); 
				    $num_login   = $database->mysqlNumRows($sql_login);
				    if($num_login){
				    while($result_login  = $database->mysqlFetchArray($sql_login)) 
				    {
	 			     ?>
                                    <option value="<?=$result_login['msy_subcategoryname']?>"><?=$result_login['msy_subcategoryname']?></option>
                                    <?php } } ?>	
                                    <option value="null" default>All</option>
                                    </select>
				    </div>
					
                                   <div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;margin-bottom:5px;width:10%">
                                      <p class="menu_filter_txt">Ref/Cnt Id</p>
                                      <input  type="text" class="form-control" id="m_ref_cnt" name="m_ref_cnt" placeholder="Id"  autocomplete="off" readonly onclick="this.removeAttribute('readonly');" onkeyup="validateSearch()">
			              </div>      
                                        
                                        
                                        
                                <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:12%">
                                <p class="menu_filter_txt">Portion-Unit</p>
					
                                <select  class="add_text_box"  id="mdiet" name="mdiet" onChange="validateSearch()">
                                <option value="all">Select </option>
                                <option value="Portion">Portion</option>
                                <option value="Loose">Loose</option>
                                <option value="Packet">Packet</option>
                              
                                </select>
		                </div>
                                        
                            <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:10%">
                            <p class="menu_filter_txt">Status</p>
						 
                            <select  class="add_text_box"  id="mstatus" name="mstatus" onChange="validateSearch()">
                                <option value="null">Select Status</option>
                                <option value="Yes">Active</option>
                                <option value="No">Inactive</option>
                                <option value="S">Stock Out</option>
                                
                                 
                                </select>
			    </div>
                                                        
                       <div class="col-sm-2" style="padding-right: 5px;padding-left:5px;margin-bottom:5px;width:10%">
                           <p class="menu_filter_txt">Kitchen</p>
                           <select class="add_text_box"  id="kitchen" name="kitchen" onChange="validateSearch()">
                               <option value="null">Select Kitchen</option>
                                <?php
                                    $sql_kot_kitch  =  $database->mysqlQuery("SELECT `kr_kotcode`, `kr_kotname` FROM `tbl_kotcountermaster`"); 
				    $num_kot_kitch   = $database->mysqlNumRows($sql_kot_kitch);
				    if($num_kot_kitch){
				    while($result_kot_kitch  = $database->mysqlFetchArray($sql_kot_kitch)) 
				    {
	 			     ?>
                               <option value="<?=$result_kot_kitch['kr_kotcode']?>"><?=$result_kot_kitch['kr_kotname']?></option>
                                    <?php } } ?>                 
                           </select>                                                 
                        </div>
                                        
                                        
                           <div class="col-sm-2" style="padding-right: 5px;padding-left:5px;margin-bottom:5px;width:7%">
                           <p class="menu_filter_txt">Type </p>
                           <select class="add_text_box"  id="image_see" name="image_see" onChange="validateSearch()">
                               <option value="null">Select</option>
                                 <option value="Y">Dynamic</option>
                                 <option value="T"> Tax Excempt</option>
                                <option value="D"> Disc Excempt</option> 
                                <option value="B"> Barcode Item</option> 
                                <option value="R"> Recipe Item</option> 
                                <option value="K"> No Kot Print </option> 
                                 <option value="S"> Stock In Nos</option> 
                                 <option value="A">Addon Item</option>      
                                 <option value="Q">Qr Item</option> 
                                 <option value="KOD">Show Kod Item</option> 
                           </select>                                                 
                        </div>    
                                        
                                         
                                        

                        <div class="col-sm-2 nopadding" style="width:5%">
                         <p class="menu_filter_txt">&nbsp;</p>
			 <div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#" onClick="return clear_search()">CLEAR</a></div>
			</div> 
                                                    
		        </div>
                    
                    </div>
                    <div class="menu_top_filter_left new_btn_menu" >
                    
                          <div class="update_btn_menu" style="display:none;top:81px;right: 64px;cursor: pointer;border: solid 1px"></div>
                          <div id="menu_btn" class="form-group" style="width:99% !important;padding-bottom:3px;float: left;">
                          <!--<div style="width:10%;" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_rate" href="#">Rate </a></div>-->
                          <div style="width:10%;display: none" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_comb" href="#">Combination</a></div>
                          <div style="width:10%;" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_image" href="#">Image</a></div>
                          <div style="width:10%;" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_pref" href="#">Item Preference</a></div>
                          <div style="width:10%;display: none " class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_nutr" href="#">Nutrition</a></div>

                 
    

    <?php if($_SESSION['expodine_id']=='admin'){ ?>

     <div onclick="lock_click('rate_change');" style="width:10%;" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_ratechange1" href="#">Rate Change </a></div>         
                          
    <div onclick="lock_click('rate_copy');" style="width:12%;" class="col-sm-2 no-padding"><a class="menu_right_buttons   md-trigger_taratecopy1" href="#">Rate Copying </a></div>  
                         
                         
    <div onclick="lock_click('item_tax');" style="width:12%;" class="col-sm-2 no-padding"><a class="menu_right_buttons md-trigger_add_extax1" href="#">Add Item Tax </a></div> 
       
    
     <div style="width:10%;" onclick="lock_click('item_disc');" class="col-sm-2 no-padding"><a class="menu_right_buttons add_discount" href="#"> Discount   </a></div>   
    
    <?php } ?>        
                          
    <?php if($_SESSION['incl_bill_format']=='Y'){ ?>      
     
     <div onclick="incl_on()" style="width:5%;" class="col-sm-2 no-padding"><a class="menu_right_buttons" href="#">Incl</a></div>        
     
      <?php } ?>        
     
     
     
      <?php if(in_array("addons_master", $_SESSION['menusubarray'])) { ?> 
     
       <div style="width:7%;" class="col-sm-2 no-padding"><a class="menu_right_buttons menu-add-ons" href="#">Add-ons </a></div>  
       
      <?php } ?>                   
                           <?php if(in_array("inventory", $_SESSION['menuarray'])) {  ?>
                          <div style="width:8%;margin-left: 42px" class="col-sm-2 no-padding"><a style="background-color: #3b403f " class="menu_right_buttons" href="inventory/index.php">Inventory</a></div>  
                       <?php } ?>
                       
                       </div><!--form_group-->  
                            
                            <div id="menu_rate" class="col-md-12 no-padding" style="display:none;padding-top:2px">
                            	<div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                    				<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:13%">
										<input type="text" class="form-control newtxt" id="nwrate" name="nwrate" placeholder="Rate" onChange="validateDecimal()" >
									</div><!--col-sm-6-->
                                    <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                                        <select  class="add_text_box nwtype" id="nwtype" name="nwtype" onchange="check_type_rate_change();" >
                                            <option value="null">Select Type</option>
                                            <option value="%">%</option>
                                            <option value="Value">Value</option>
                                             
                                        </select>
									</div><!--col-sm-6-->
                                    <div class="col-sm-6 rate_single_new" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
										<select  class="add_text_box nwmode" id="nwmode" name=""  >
                                            <option value="null">Select mode</option>
                                            <option value="inc">+</option>
                                            <option value="dec">-</option>
                                             
                                        </select>
									</div><!--col-sm-6-->
                                 
                                    
                                                                        
                                        <div class="col-sm-6 rate_multi_new" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;display: none">
										<select  class="add_text_box nwmode1" id="nwmode1" name=""  >
                                            <option value="null">Select mode</option>
                                            <option value="inc">+</option>
                                            <option value="dec">-</option>
                                              <option value="multiply">*</option>
                                                <option value="divide">/</option>
                                        </select>
					</div>     
                                                                        
                                               
                                 <div class="col-sm-6" id="partner_div" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;display: none">
                                 	
                                  <div class="form-group" id="floorrate_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_online_order"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                                          ?>
                                        <select data-placeholder="Enter partner" id="partner_change" name="floorrate" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                         <optgroup label="Select Floor">
                                        <option value="All">All Partners</option>
                                       
                                         <?php 
						while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
						{
                                                    
						?>
                                           
                                            
                                              <option value="<?=$result_kot['tol_id']?>" id="<?=$result_kot['tol_id']?>"><?=$result_kot['tol_name']?></option>
                                  
                                              <?php } ?>
                                              
                                              
                                    </optgroup>
                                    </select>
                                      
                                    <?php } ?>
                                         
                                    </div>
                                   	    
                                    </div><!--first_form_contain-->                                    
                                                                        
                                                                        
                                                                        
                                                                        
                                    <div id="floor_div" class="col-sm-6" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                                 	
                                  <div class="form-group" id="floorrate_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                                          ?>
                                        <select data-placeholder="Enter Floor" id="floorrate" name="floorrate" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                         <optgroup label="Select Floor">
                                        <option value="All">All Floor</option>
                                       
                                         <?php 
						while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
						{
                                                    
						?>
                                           
                                            
                                              <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                  
                                              <?php } ?>
                                              
                                              
                                    </optgroup>
                                    </select>
                                      
                                    <?php } ?>
                                         
                                    </div>
                                   	    
                                    </div><!--first_form_contain-->
                                    
                                    
                                    
                                    
                                  <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                                 	
                                  <div class="form-group" >
                                        <?php
					$sql_kot  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_active='Y' order by mmy_displayorder "); 
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){
					
                                        ?>
                                        <select data-placeholder="Enter Category" id="ratecategry" name="categry" data-rel="chosen" title="Category" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                        <optgroup label="Select Category">
                                        <option value="All">All Category</option>
                                       
                                        <?php 
					while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
					{
					?>
                                         
                                            
                                        <option value="<?=$result_kot['mmy_maincategoryid']?>" id="<?=$result_kot['mmy_maincategoryid']?>"><?=$result_kot['mmy_maincategoryname']?></option>
                                         <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         
                                         </div>
                                   	    
                                    </div><!--first_form_contain-->
                                    
                                   <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:13%">
                                 	
                                  <div class="form-group" >
                                           
                                      <select onchange="module_rate_change()" data-placeholder="Enter Category" id="module" name="module" data-rel="chosen" title="Module" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                          <option value="null">Select Module</option>
                                            <option value="All">All</option>
                                            <option value="dine" id="dine">DINE IN</option>
                                            <option value="ta/hd" id="ta/hd">TAKE AWAY/HOME DELIVERY</option>
                                            <option value="cs" id="cs">COUNTER SALE</option>
                                 
                                         </optgroup>
                                    	 </select>
                                        
                                         
                                         </div>
                                   	    
                                    </div>
                                    
                                    
                                     
                        <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%;">
			<div style="margin-left:1%;" class="search_btn_member_invoice"><a href="#" onClick="validate_rates()"  >Submit</a></div>
			</div>
			</div>
                        </div><!--menu_rate-->
                        
                        
                        <div id="takeaway_ratecopy" class="col-md-12 no-padding" style="width: 560px;display:none;">
                            	<div class="form-group">
                    			
                                	<div class="rate_change_pop_head">RATE COPY</div>
                                    <div class="col-sm-12 no-padding">
                                        <div class="col-sm-3" style=""><p style="margin:0;line-height: 0;position: relative;top: -7px;left: -12px;"></p></div>
                                        <div class="col-sm-3" style=""><p style="margin:0;line-height: 0;position: relative;top: -7px;left: -12px;">From</p></div>
                                        <div class="col-sm-3" style=""><p style="margin:0;line-height: 0;position: relative;top: -7px;left: -12px;">Floor</p></div>
                                        <div class="col-sm-3" style=""><p style="margin:0;line-height: 0;position: relative;top: -7px;left: -12px;">To Online</p></div>
                                        
                                        <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;margin-bottom:15px;">
                                            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
                                             <input id="takeawaybutton1" type="radio" name="RadioGroup1" value="takeaway" onchange="validate_floorrate1()"></span>
                                            <span class="ratecopy_pop_text">Take Away</span></label>
                                        </div>
                                        
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;" id="mode_sel1_div">
                                            <select  style="width:95%" data-placeholder="From" id="mode_sel1"  class="form-control add_new_dropdown add_text_box">
                                                <option value="DI">Dine In</option>
                                                <option value="CS">Counter Sale</option>
                                            </select>    
                                            
                                        </div>  
                                        
                                         
                                        
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;">
                                        
                                      <div class="form-group" id="floorrate_div1">
                                             <?php
                                            
                                             $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
                                              $num_kot   = $database->mysqlNumRows($sql_kot);
                                              if($num_kot){
                                                
                                                ?>
                                            <select  style="width:95%" data-placeholder="Enter Floor" id="floorrate1" name="floorrate1" data-rel="chosen" title="Floor" data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                              <optgroup label="Select Floor">

                                           
                                             <?php 
                                        while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                            {
                                        ?>
                                               
                                              
                                                  <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                        <?php } ?> 
                                                  
                                             </optgroup>
                                             </select>
                                             <?php }?>
                                             
                                             </div>
                                             
                                          
                                       <input id="takeaway1" type="hidden" name="takeaway1" value="TA">
                                           
                                        </div>
                                        
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;" >
                                            <select  style="width:95%" data-placeholder="From" id="ta_to_ta"  class="form-control add_new_dropdown add_text_box">
                                               <?php 
                                                $sql_kot3  =  $database->mysqlQuery("select * from tbl_online_order where tol_status='Y'"); 
                                              $num_kot3   = $database->mysqlNumRows($sql_kot3);
                                              if($num_kot3){
                                            
                                            while($result_kot3  = $database->mysqlFetchArray($sql_kot3)) 
                                            { 
                                            ?>
                                                <option value="<?=$result_kot3['tol_id']?>"> <?=$result_kot3['tol_name']?> </option>
                                                
                                                <?php } } ?>
                                            </select>    
                                            
                                        </div>   
                                        
                                        
                                    </div>
                                     <div class="col-sm-12 no-padding">
                                        <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;margin-bottom:15px;">
                                            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
                                           <input id="countersalebutton1" type="radio" name="RadioGroup1" value="countersale" onchange="validate_floorrate2()"></span>
                                            <span class="ratecopy_pop_text">Counter Sale</span></label>
                                        </div>
                                         <div class="col-sm-3" style="padding:0; margin-bottom:5px;" id="mode_sel2_div">
                                            <select  style="width:95%" data-placeholder="From" id="mode_sel2" class="form-control add_new_dropdown add_text_box">
                                                <option value="DI">Dine In</option>
                                                <option value="TA">Take Away</option>
                                               
                                            </select>    
                                            
                                        </div>
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;">
                                      <div class="form-group " id="floorrate_div2">

                                          
                                            <?php
                                            
                                             $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
                                             $num_kot   = $database->mysqlNumRows($sql_kot);
                                             if($num_kot){
                                                
                                            ?>
                                            <select  style="width:95%" data-placeholder="Enter Floor" id="floorrate2" name="floorrate2" data-rel="chosen" title="Floor" data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                            <optgroup label="Select Floor">

                                           
                                          <?php 
                                          while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                            {
                                          ?>
                                           
                                         <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                        
                                             <?php } ?> 
                                                  
                                             </optgroup>
                                             </select>
                                          
                                          <?php } ?>
                                          
                                          
                                             </div>
                                             </div>
                                           
                                             <div class="col-sm-3" style="padding:0; margin-bottom:5px;" >
                                             <p style="margin:0;line-height: 0;position: relative;top: -7px;left: 0px;">From Online</p>
                                            <select  style="width:95%" data-placeholder="From" id="cs_to_ta"  class="form-control add_new_dropdown add_text_box">
                                               <?php 
                                                $sql_kot3  =  $database->mysqlQuery("select * from tbl_online_order where tol_status='Y'"); 
                                              $num_kot3   = $database->mysqlNumRows($sql_kot3);
                                              if($num_kot3){
                                            
                                            while($result_kot3  = $database->mysqlFetchArray($sql_kot3)) 
                                            { 
                                            ?>
                                                <option value="<?=$result_kot3['tol_id']?>"> <?=$result_kot3['tol_name']?> </option>
                                                
                                                <?php } } ?>
                                            </select>    
                                            
                                        </div>   

                                           
                                        <input id="countersale1" type="hidden" name="countersale1" value="CS">
                                        </div>
                                        

                                   
                                     <div class="col-sm-12 no-padding">
                                        <div class="col-sm-3" style="padding-right: 5px;padding-left: 5px;margin-bottom:15px;">
                                            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
                                            <input id="dineinbutton1" type="radio" name="RadioGroup1" value="dinein" onchange="validate_floorrate3()"></span>
                                            <span class="ratecopy_pop_text">Dine In</span></label>
                                        </div>
                                         <div class="col-sm-3" style="padding:0; margin-bottom:5px;" id="mode_sel3_div">
                                            <select  style="width:95%" data-placeholder="From" id="mode_sel3" class="form-control add_new_dropdown add_text_box">
                                                <option value="CS">Counter Sale</option>
                                                <option value="TA">Take Away</option>
                                            </select>    
                                            
                                        </div>
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;">
                                        <p style="margin:0;line-height: 0;position: relative;top: -7px;left: 0px;">To Floor</p>
                                      <div class="form-group" id="floorrate_div3">

                                          
                                            <?php
                                           
                                             $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
                                              $num_kot   = $database->mysqlNumRows($sql_kot);
                                              if($num_kot){
                                                 
                                            ?>
                                            <select  style="width:95%" data-placeholder="Enter Floor" id="floorrate3" name="floorrate3" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box">
                                              <optgroup label="Select Floor">

                                           
                                        <?php 
                                        while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                        {
                                        ?>
                                                    
                                       <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                      
                                        <?php } ?> 
                                                  
                                             </optgroup>
                                             </select>
                                          
                                       <?php } ?>
                                          
                                          
                                       </div>

                                           
                                        <input id="dinein1" type="hidden" name="dinein1" value="DI">
                                        </div>
                                        
                                        <div class="col-sm-3" style="padding:0; margin-bottom:5px;" >
                                             <p style="margin:0;line-height: 0;position: relative;top: -7px;left: 0px;">From Online</p>
                                            <select  style="width:95%" data-placeholder="From" id="di_to_ta"  class="form-control add_new_dropdown add_text_box">
                                               <?php 
                                                $sql_kot3  =  $database->mysqlQuery("select * from tbl_online_order where tol_status='Y'"); 
                                              $num_kot3   = $database->mysqlNumRows($sql_kot3);
                                              if($num_kot3){
                                            
                                            while($result_kot3  = $database->mysqlFetchArray($sql_kot3)) 
                                            { 
                                            ?>
                                                <option value="<?=$result_kot3['tol_id']?>"> <?=$result_kot3['tol_name']?> </option>
                                                
                                                <?php } } ?>
                                            </select>    
                                            
                                        </div>   
                                        
                                    </div>
                                    
                                     
                      <div class="col-sm-12" style="text-align:center;margin-bottom:5px;padding-top:6px;border-top:1px #ccc solid">
                      	  <div style="margin-left:1%;width:90px;float:none;display:inline-block" class="search_btn_member_invoice rate_change_close"><a href="#"  >Close</a></div>
                          <div style="margin-left:1%;width:90px;float:none;display:inline-block" class="search_btn_member_invoice rate_change_sub submitta change_permission_btn1"><a href="#" onClick="validate_rates1()"  >Submit</a></div>
                          <div style="margin-left:1%;width:90px;float:none;display:none" class="search_btn_member_invoice rate_change_sub submitcs change_permission_btn2"><a href="#" onClick="validate_rates2()"  >Submit</a></div>
                          <div style="margin-left:1%;width:90px;float:none;display:none" class="search_btn_member_invoice rate_change_sub submitrm change_permission_btn3"><a href="#" onClick="validate_rates3()"  >Submit</a></div>
                      </div>
			
                                </div>
                      
                       
             
                        </div>
                        
                    </div><!---menu_top_filter_left--->
                    <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                          
                   	<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-16" onClick="menuclr()" ></a>
                          
                     </div>  
                   </div>
                    <div id="menupage" class="menupage">
                              <div id="left_table_scr_cc"> 
                              <table class="responstable tablesorter" id="listall">
                              <thead>
                                  
                             <tr>
                                <th style="" width="3%">Sl No</th>
                                <th width="20%">Item</th>
                                <th width="7%">Type</th>
       				<th width="10%">Main Category</th>
                                <th width="10%">Sub Category</th>
                                <th width="10%"> Kitchen</th>
                                <th width="5%">Type</th>
                                <th width="6%">Ref Id</th>
                                <th width="5%">Cnt Id</th>
                                <th width="28%">Action</th>
                               
                                <th width="5%">Rate</th>
                                <th width="6%">Item Tax</th>
                              </tr>
                              </thead>
                          <tbody>
         <?php
                            
         
         
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON "
                 . " tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON "
                 . " tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid left join tbl_kotcountermaster on "
                 . " tbl_kotcountermaster.kr_kotcode=tbl_menumaster.mr_kotcounter where mr_product_type='Menu' and mr_delete_mode='N' "
                 . " group by mr_menuid  order by tbl_menumaster.mr_active desc  limit 30 "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$taxmenu_id = $result_login['mr_menuid'].'|'.$result_login['mr_menuname'];
				if($result_login['mr_active']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}
                                
                                if($result_login['mr_show_in_kod']=="Y")
				{
				
					$activekod="Yes";
				}else 
				{
					$activekod="No";
				}
                                
                                
				if(!isset($_REQUEST['id']))
				{
				  if($i==1)
				  {
					  $_SESSION['menuidselect']=$result_login['mr_menuid'];
				  }
				}
                                
                                 if($result_login['mr_rate_type']=="Portion")
				{
				
					$rt_type="Portion";
				}else 
				{
					$rt_type=$result_login['mr_unit_type'];
				}
                                
     $sql_kotlist1  =  $database->mysqlQuery("SELECT  ti_name from tbl_inv_kitchen where  ti_id = '".$result_login['mr_inventory_kitchen']."' "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
					while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
					{       
                                            
                                         $inv_name=   $result_kotlist1['ti_name'];
                                         
                                        } }      
                                
                                
                                     $itemotherlangname='';
                                     if($_SESSION['main_language']=='arabic')
					{
                                         
					$sql_othlamg  = $database->mysqlQuery("Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_login['mr_menuid']."' AND lm_language_id='2'"); 
					$num_othlamg  = mysqli_num_rows($sql_othlamg);
					if($num_othlamg)
					{
					while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
					{
					$itemotherlangname=$result_othlamg['lm_menu_print'];
					}
					}
                                        
					}   
                                        
                                  
                                        
                                         $itemotherlangname_cat='';
                                       if($_SESSION['main_language']=='arabic')
					{
                                         
					$sql_othlamg  = $database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_main left join tbl_languages on ls_id=mm_lang_id WHERE mm_categoryid='".$result_login['mr_maincatid']."' and ls_language='".$_SESSION['main_language']."' "); 
					$num_othlamg  = mysqli_num_rows($sql_othlamg);
					if($num_othlamg)
					{
					while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
					{
					$itemotherlangname_cat=$result_othlamg['mm_name'];
					}
					}
                                        
					}   
				
	                         ?>
                              
                              <tr id="ids_<?=$result_login['mr_menuid']?>" class="clicktoview <?php if($_SESSION['menuidselect']==$result_login['mr_menuid']){ ?> table_active <?php } ?> ">
                              <td width="3%" id="editing_slno_<?=$result_login['mr_menuid']?>"><?=$i?></td>
                              <td width="20%"><?=$result_login['mr_menuname']?> <?=$itemotherlangname?></td>
                              <td width="7%"><?=$result_login['mr_product_type']?></td>
                              <td width="10%"><?=$result_login['mmy_maincategoryname']?> <?=$itemotherlangname_cat?></td>
                              <td width="10%"><?=$result_login['msy_subcategoryname']?></td>
                              <td width="10%"><?=$result_login['kr_kotname']?></td>
                              <td width="5%"><?=$rt_type?></td>
                              <td width="6%"><?=$result_login['mr_menuid']?></td>
                              <td width="5%"><?=$result_login['mr_central_id']?></td>
                               
                              <td width="28%" style="text-align: left !important"> 
                                  
                                                    
                            <?php  if($active=="No") { ?>

                                  <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToYes','<?=$result_login['mr_menuid']?>')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"/></i></a>

                                  <a style="border: solid 1px;border-radius: 5px;padding: 2px;color: red;">INACTIVE</a>
                                                     
                            <?php }else if($active=="Yes") { ?>

                                   <a style="display: none" class="tab_edt_btn md-trigger_view" id="set_<?=$result_login['mr_menuid']?>" ><i class="icontick"><img src="img/icon-view.png" width="22px" height="22px"/></i></a>
                              
                                   <a  class="tab_edt_btn md-trigger_edit" id="set_<?=$result_login['mr_menuid']?>" ><i class="fa fa-edit"></i></a>
                                    
                                   <a  class="tab_edt_btn" href="#" onClick="delete_confirm('ToNo','<?=$result_login['mr_menuid']?>')"><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"/></i></a>
                                                     
                                                
                            <?php  if($result_login['mr_excempt_disc']=="N") { ?>
                                    
                                                     <a onclick="return discount_icon('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>');" class="tab_edt_btn discount_pop_btn" href="#"><i class="icontick"><img src="img/discount_ico.png" width="28px" height="25px"/></i></a>
                                                     <?php }else{ ?>
                                                     <a title="Can't add discount because it's discount excempt" class="tab_edt_btn discount_pop_btn" href="#"><i class="icontick"><img src="img/delete_btn_2.png" width="28px" height="25px"/></i></a>
                                                     <?php } ?>  
                                                     
                                                     
                                                     <?php  if($result_login['mr_ingredient']=="Y" && $_SESSION['ser_recipe']=='Y') { ?>
                                                     <a onclick="return ing_view('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>','<?=$result_login['mr_inventory_kitchen']?>','<?=$result_login['mr_rate_type']?>','<?=$inv_name?>');"   class="tab_edt_btn ingredient_btn"  style="margin-left:7px" href="#"><i class="icontick"><img src="img/ingredient_ico.png" width="24px" height="24px"/></i></a>
                                                     <?php } ?>
									
                                                     
                                                     <?php  if($result_login['mr_unit_type']!="Loose") { ?>
                                                     <a onclick="return barcode_view('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>');" title="Barcode Printing"  class="tab_edt_btn ingredient_btn"  style="margin-left:3px" href="#"><i class="icontick"><img src="img/barcode.png" width="30px" height="30px"/></i></a>
                                                     <?php } ?>
                                                        
                                                     <?php  if($_SESSION['ser_delete_menu']=='Y'){ ?>
                                                     <a onclick="return hide_view('<?=$result_login['mr_menuid']?>');"  title="ITEM DELETE" class="tab_edt_btn ingredient_btn"  ><i class="icontick"><img style="background-color: #c55b5b;border-radius: 20px;" src="img/black_cross.png" width="25px" height="25px"/></i></a>
                                                     <?php } ?>
                                                     
                                        <?php  if($result_login['mr_stock_in_out']=='Y'){ ?>
                                       
                                      <a id="gstk_<?=$result_login['mr_menuid']?>"  style="background: #648964;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;" onclick="return stock_view('<?=$result_login['mr_menuid']?>','N');"  title="ITEM STOCK IN " class="tab_edt_btn ingredient_btn"  >IN</a>
                                       <?php }else{ ?>
                                        
                                        <a id="rstk_<?=$result_login['mr_menuid']?>" style="background: #993d3d;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;"  onclick="return stock_view('<?=$result_login['mr_menuid']?>','Y');"  title="ITEM STOCK OUT" class="tab_edt_btn ingredient_btn"  >OUT</a>
                                     
                                       <?php } ?>
                                                     
                                                     
                                                     
                                                        
                                                    <?php } ?>
                                                          
                                                     </td>
                                                     
                                                     
                                                     
                                                     <td width="5%" <?php  if($active=="No") { ?> class='disable_cls_voucher'  <?php  } ?>>
                                                     <?php  if($result_login['mr_product_type']!="Raw") { ?>	
                                                     <a class="md-trigger_rate" id="set_<?=$result_login['mr_menuid']?>"><img src="img/rate.png">
                                                        
                                                     </a>
                                                         
                                                      <?php }else{ ?>
                                                      <a title="No Price  " class="" ><img src="img/black_cross.png"></a>
                                                      <?php } ?>
                                                    
                                                     </td>

                                                    <td width="6%" <?php  if($active=="No") { ?> class='disable_cls_voucher'  <?php  } ?> >
                                                        
                                                    <?php  if($result_login['mr_excempt_tax']=="N") { ?>
                                                    
                                                    <a class="md-trigger_tax" id="set_<?=$result_login['mr_menuid']?>"><img src="img/tax-icon.png"></a>
                                                    
                                                     <?php }else{ ?>
                                                     <a title="Can't add tax because it's tax excempt"><img src="img/delete_btn_2.png"></a>   
                                                     <?php } ?>  
                                                      </td>
                                                     
                              </tr>
                              
                              <?php $i++; } }else{$_SESSION['menuidselect']="0";} ?>
                              
                           </tbody>
                           </table>
                                           
                           
                       <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$_SESSION['menuidselect']?>">
                   </div><!--left_table_scr_cc-->
                   </div>
                   
                                            </div>    
                               <div class="menu_total_showing_text"></div>
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
                       
         <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
         
         <?php 	
	 $sql_login  =  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
	
	 $num_cat_s  = $database->mysqlNumRows($sql_login);
	
	if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
			{
			    $searchname=$result_cat_s['mr_menuname'];
			}
	} 
	else
	{
		            $searchname="";
	}
	  ?>
               
		</div>
	</div>
</div>
</div><!--container-->
</div>
</div>


<!--  add starts -->
<div class="md-modal md-effect-16" id="modal-16" style="width:830px;top:7%">
 	<form role="form"   method="post"  name="menu">
			<div class="md-content">
				<h3>ADD NEW </h3>
                 <div class="md-close close_staff_pop " tabindex="34"><img src="img/close_ico.png"></div>
				<div>
          
                     <div class="col-lg-12 col-md-12 no-padding">
                    	<table class="popup_add_table" width="100%" border="0" cellspacing="5">
                            
                            
                            
                            <tr>
                               <td style="width:15%;padding-left:4px;">Item Type<span style="color:#F00">*</span></td>
                               <td  id="insetmsg_diet">
                                  
                                    <select style="width:20%;margin-left: -20px" data-placeholder="Type"  name="finished_good"  id="finished_good" data-rel="chosen" tabindex="7" title="" left="." data-toggle="tooltip" class="form-control add_new_dropdown enter">
                                       
                                          <option  value="Menu">Item</option>
                                            <?php if(in_array("inventory", $_SESSION['menuarray'])) {
                                             if($_SESSION['s_inventory_staff_add']=='Y'){   
                                                
                                                ?>
                                            <option value="Finished">Finished Good</option>
                                            <option value="Raw">Raw Material</option>
                                            <?php } } ?>
                                    	 </select>
                                 </td>
                                 
                              </tr> 
                            
                              <tr>
                                <span id="menuchk" class="load_error alertsmaster" style="color:#F00" ></span>    
                                <td style="width:12%">Item Name<span style="color:#F00">*</span></td>
                                <td width="80%" id="insetmsg_menu">  <input style="margin-left: -22px;width: 60%" type="text" class="form-control menuname enter " id="menuname" name="menuname" autocomplete="off" onkeyup="return menu_enter();"  tabindex="1"  placeholder="Item / Menu"   data-toggle="tooltip" title="Menu"> </td>                                
                                                               
                               </tr>
                               
                        </table>
                        
                        <table class="popup_add_table" width="100%" border="0" cellspacing="5">
                           </tr>
                           <td width="13%"  style="text-align:left;">Item Code</td>
                           <td width="35%" id="item_shortcode_div"> <input type="text" class="form-control menuname enter" autocomplete="off" placeholder="Item Code" id="item_shortcode" tabindex="2"  name="item_shortcode" maxlength="8" onChange="valishortcode()"></td>
                           <td class="raw_hide_class" style="width:15%;padding-left:10px;">Name in Bill<span style="color:#F00">*</span></td>
                             <td class="raw_hide_class" id="insetmsg_sht">   <input type="text" autocomplete="off"  class="form-control shortcodename shortcode" maxlength="19" id="shortcode" name="shortcode" tabindex="3"  placeholder="Item Short Code"   data-toggle="tooltip" title="Item Short Code" ></td>
                             
                                </tr>
                                <tr>
                                <td class="raw_hide_class" style="text-align: left;">Kot Kitchen<span style="color:#F00">*</span></td>
                             <td class="raw_hide_class" id="insetmsg_kot">
                              <?php  $s1=1;
							 $sql_kot  =  $database->mysqlQuery("select * from tbl_kotcountermaster"); 
							  $num_kot   = $database->mysqlNumRows($sql_kot);
							  if($num_kot){
                    			 ?>
                                        <select data-placeholder="Enter Kitchen" id="kotcounter" name="kotcounter" data-rel="chosen" tabindex="4"  title="Kitchen" left="." data-toggle="tooltip" class="form-control add_new_dropdown enter">
                                        <option value="">Select Kitchen</option>
                                         <optgroup label="Kitchen">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
                                                                           
									?>
                                            <option <?php  $si_set=$s1++; if($si_set==1){ ?>  selected  <?php } ?> value="<?=$result_kot['kr_kotcode']?>"><?=$result_kot['kr_kotname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                </td>
                                <td  style="width:13%;text-align: left;padding-left:10px;"> Main Category<span style="color:#F00">*</span></td>
                                <td id="insetmsg_main" class="main_cat_type">
                                   <?php
						$sql_kot  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_active='Y' and mmy_inventory='N' "); 
						$num_kot   = $database->mysqlNumRows($sql_kot);
						 if($num_kot){
											 
                                    ?>
                                        <select data-placeholder="Enter Main Category" id="maincat" name="maincat" data-rel="chosen" tabindex="5" title="Menu Main Category" left="." data-toggle="tooltip" class="form-control add_new_dropdown enter">
                                        <option value="">Select Main Category</option>
                                         <optgroup label="Main Category">
                                         <?php 
									while($result_kot = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['mmy_maincategoryid']?>"><?=$result_kot['mmy_maincategoryname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                               
                                </td>
                                
                                </tr>
                                
                               
                                
                              <tr>
                                <td style="text-align: left;">Rate Type</td>
                                   <td id="insetmsg_ratetype">
                                       <select data-placeholder="" tabindex="10" class="form-control add_new_dropdown  portionunit_selection enter" name="ratetype" id="ratetype"  onchange="portionunit_selection(this.value)">
                                         <option value="Portion">Portion</option>
                                         <option value="Unit">Unit</option>
                                    	 </select>
                                                                         </td>
                                <td style="text-align: left;padding-left:10px;">Base Unit</td>
                                   <td id="insetmsg_baseunit">
                                       <select data-placeholder="" class="form-control add_new_dropdown baseunit_select enter" tabindex="11" name="baseunit" id="baseunitselect" onchange="baseunit_select()" style="width:100%">
                                         <option value="">Select Unit</option>
                                         <?php
                                         $sql_unit1  =  $database->mysqlQuery("select * from tbl_base_unit_master"); 
							  $num_unit1 = $database->mysqlNumRows($sql_unit1);
							  if($num_unit1){ 
                                                               while($result_unit1  = $database->mysqlFetchArray($sql_unit1)) {
                                                                   ?>
                                                                <option value="<?=$result_unit1['bu_id']?>"><?=$result_unit1['bu_name']?></option>
                                                          <?php
                                                            }
                                                          }
                                                          ?>
                                                                            
                                    	 </select>
                                </td>
                                 
                              </tr>
                              <tr>
                                  <td style="text-align: left;">Unit Type</td>
                                   <td id="insetmsg_unittype">
                                       <select data-placeholder="" class="form-control add_new_dropdown  unittype_selection enter" tabindex="12" id="unittype_selection" name="unittype" onchange="return unit_type_selection(this.value)"  >
                                           <option value="">Select Unit Type</option>
                                           <option value="Packet">Packet</option>
                                         <option value="Loose">Loose</option>
                                    	 </select>
                                    </td>
                                  
                                    <td id="" style="text-align: left;padding-left:10px;">Inventory Store <span id="inv_star" style="color:#F00;">*</span></td>
                                   <td id="insetmsg_inv">
                                       <select data-placeholder="" class="form-control add_new_dropdown enter" tabindex="13" name="inv_kitchen" id="inv_kitchen" >
                                         <option value="0">Select </option>
                                         <?php $s2=1;
                                         $sql_unit1  =  $database->mysqlQuery("select * from tbl_inv_kitchen"); 
							  $num_unit1 = $database->mysqlNumRows($sql_unit1);
							  if($num_unit1){ 
                                                               while($result_unit1  = $database->mysqlFetchArray($sql_unit1)) {
                                                                   ?>
                                                                <option <?php $si_set2=$s2++; if($si_set2==1){ ?>  selected  <?php } ?>  value="<?=$result_unit1['ti_id']?>"><?=$result_unit1['ti_name']?></option>
                                                              <?php
                                                                }
                                                          }
                                                          ?>
                                          
                                        
                                    	 </select>
                                </td>
                              </tr>
                                 
                             
                              <tr>
                                  
                                   <td style="text-align: left;">Sub Category</td>
                                   <td id="insetmsg_subc">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menusubcategory where msy_active='Y' "); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                                           ?>
                                       <select data-placeholder="Enter Sub Category" id="subcat" name="subcat" class="enter form-control"  data-rel="chosen" title="Menu Sub Category" tabindex="6" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select Sub Category</option>
                                         <optgroup label="Sub Category">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['msy_subcategoryid']?>"><?=$result_kot['msy_subcategoryname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                </td>
                                  
                                  
                                  
                                  
                                  
                               <td class="raw_hide_class"  style="width:15%;text-align: left;padding-left:10px;">PLU Code<span style="color:#F00"></span></td>
                                <td class="raw_hide_class" id="insetmsg_est">
                                    <input style="width: 100%;" type="text" class="form-control time enter" id="plu_code" maxlength="4" name="plu_code"  placeholder=" PLU CODE" tabindex="14" data-toggle="tooltip" title="ITEM PLU CODE"  value="">
                                </td>
                                
                                
                                
                              </tr>
                              
                              
                              <tr>
                                  
                                <td class="reorder_hide_class" style="text-align: left;display: none">Reorder Level<span style="color:#F00"></span></td>
                                <td class="reorder_hide_class" style="display: none" id="insetmsg_est">
                                    <input type="text" style="width: 100%;" class="form-control time enter" id="reorder_level"  name="reorder_level"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="">
                                </td>
                                  
                               <td class="purchase_hide_class" style="text-align: left;width: 12%;">Purchase Rate<span style="color:#F00"></span></td>
                                <td class="purchase_hide_class" style="" id="insetmsg_est">
                                    <input style="width: 100%;" type="text" class="form-control time enter" id="purcahse_rate"  name="purcahse_rate"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="">
                                </td>
								
							</tr>
                              
                              
                              <tr>
                                
                                 <td class=""  style="width:15%;text-align: left;padding-left:10px;">Central Id <span style="color:#F00"></span></td>
                                <td class="" style="" id="insetmsg_est">
                                    <input readonly style="width: 100%;" type="text" class="form-control time enter" id="central_id"  name="central_id"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="">
                                </td>
                                
                                
                                 <td class="raw_hide_class_barcode" style="text-align: left;display: none;"> Barcode <span style="color:#F00"></span></td>
                                <td class="raw_hide_class_barcode" style="display: none" id="insetmsg_est">
                                    <input style="width: 100%;"  type="text" class="form-control time enter" id="raw_barcode"  name="raw_barcode"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="">
                                </td>
                                
                              </tr>
                              
                              
                              
                              <tr>
                               
                                <td style="text-align: left;line-height: 35px;" colspan="2">
                                    <span class="chk_lable_pop" style="padding-left:0%">Active</span>
                                    <span style="position:relative;top:4px;" ><input type="checkbox" class="popup_chk_bx enter"  value="1" tabindex="16" name="active"  id="active" data-toggle="tooltip" title="Active" checked></span>
                                
                                    <span class="chk_lable_pop raw_hide_class" style="padding: 0 0 0 3%;">Dynamic rate</span>
                                    <span class="raw_hide_class" style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx enter"  value="1" tabindex="19" name="dynamicrate"  id="dynamicrate" data-toggle="tooltip" title="Stock"  ></span><br>
                                 
                                    <input name="sale_rate_all"  id="sale_rate_all" class="form-control raw_hide_class" style="margin-left: 183px;margin-top: -32px;width: 52%;" type="number" placeholder="Item Sale Rate For All Modules">
                                    
                                </td> 
                                    
                             </tr>
                              
                              </table>
                         <table class="popup_add_table" width="100%" border="0" cellspacing="5" >   
                               
                              
                              
                             <tr style="float:right;cursor: pointer;margin-top: -43px;" onclick="show_more()" id="show_more">
                                  <td style="color:#0e416c;border: solid 1px;background-color: darkred;border-radius: 5px;color: white;padding: 5px;height: 20px">More</td>
                                  
                              </tr>
                              
                             
                              <tr class="more_class" style="display:none">
                               
                                <td class="raw_hide_class" style="width:15%;padding-left:5px;">Diet<span style="color:#F00"></span></td>
                                <td class="raw_hide_class" id="insetmsg_diet">
                                  
                                    <select data-placeholder="Diet" name="diet"  id="diet" data-rel="chosen" tabindex="7" title="Diet" left="." data-toggle="tooltip" class="form-control add_new_dropdown enter">
                                        <option value=""></option>
                                         <optgroup label="Diet">
                                             <option selected="selected" value="General">General</option>
                                            <option value="Non Veg">Non Veg</option>
                                            <option value="Veg">Veg</option>
                                            
                                         </optgroup>
                                    	 </select>
                                </td>
                                 
                                
                                 <td class="raw_hide_class" style="width:15%;padding-left:17px;">HSN Code<span style="color:#F00"></span></td>
                                <td id="insetmsg_est">
                                    <input style="width:100%" type="text" class="form-control time enter" id="hsn_code" name="hsn_code"  placeholder="" tabindex="8" data-toggle="tooltip" title=""  >
                                </td>
                                
                                
                              </tr> 
                              
                              <tr  class="more_class raw_hide_class" style="display:none">
                               <td style="text-align: left;">Est Time [Min] <span style="color:#F00"></span></td>
                                <td id="insetmsg_est">
                                    <input style="width:100%" type="text" class="form-control time enter" id="time" name="time"  placeholder="Estimated Time(minutes)" tabindex="8" data-toggle="tooltip" title="Estimated Time(minutes)"  value="10">
                                </td>
                                
                                <td style="width:13%;padding-left:17px;">Prp Mode<span style="color:#F00"></span></td>
                                <td id="insetmsg_pre">  <select data-placeholder="Preparation Mode" name="prepmode"  id="prepmode" data-rel="chosen" tabindex="9" title="Preparation Mode" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Preparation Mode">
                                             <option  value="General" selected="selected">General</option>
                                            <option value="Fried">Fried</option>
                                            <option value="Oven">Oven</option>
                                            
                                         </optgroup>
                                    	 </select>
                                </td>
                                 </tr>
                              
                                 
                                  
                             <tr class="more_class raw_hide_class" style="display:none">
                                 
                                <td style="width:13%;margin-bottom: 50px">Description</td>
                                <td style="width:35%;margin-bottom: 50px" id="insetmsg_des">
                                  <textarea style="resize:none" class="form-control description enter" id="description" name="description"  placeholder="Detailed Description Of The Item " tabindex="15"  data-toggle="tooltip" title="Description" ></textarea>
                                </td>
                         </tr>
                         </table>
                         
                         <div class="raw_hide_class" style="position:absolute;bottom: -33px;right: -297px;">
                         <table class="popup_add_table" width="100%" border="0" cellspacing="5">   
                           <tr class="more_class" style="display:none">
                                   <td style="display:flex;">
                                    <span class="chk_lable_pop" style="padding-left:16.9%;">Add-ons</span>
                                    <span style="position:relative;top:0px;padding-right:0%" ><input style="margin-left: 5px;" type="checkbox" class="popup_chk_bx enter"  value="1" tabindex="17" name="addons"  id="addons" data-toggle="tooltip" title="addons" ></span>
                               
                                    <span class="chk_lable_pop" style="padding: 0 0 0 9.7%;">Stock</span>
                                    <span style="position:relative;top:0px;padding-right:0%"><input type="checkbox" style="margin-left: 5px;" class="popup_chk_bx enter"  value="1" tabindex="18" name="stock"  id="stock" data-toggle="tooltip" title="Stock" checked ></span>
                                
                                    
                                    <span class="chk_lable_pop" style="padding: 0 0 0 4.5%;"> Stock In Nos</span>
                                    <span style="position:relative;top:0px;padding-right:0%"><input type="checkbox" style="margin-left: 5px;" class="popup_chk_bx enter"  value="1" tabindex="20" name="stockinnumbrs"  id="stockinnumbrs" data-toggle="tooltip" title="Stock"  ></span>
                                  </td> 
                                    </tr>
                                  </table>   
                                <table class="popup_add_table" width="100%" border="0" cellspacing="5">        
                                    
                                     <tr class="more_class" style="display:none">
                                    <td style="display:flex;margin-top: -21px;">
                                    <span  class="chk_lable_pop" style=" padding: 0 0 0 0%;padding-left:13.8%;">Show In Kod</span>
                                    <span style="position:relative;top:0px;"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" value="1" tabindex="21" name="showkod"  id="showkod" data-toggle="tooltip" title="Show in Kod"  checked></span>
                                    
                                    <span  class="chk_lable_pop" style=" padding: 0 0 0 4.6%;">Excempt Tax</span>
                                    <span style="position:relative;top:0px;"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" value="1" tabindex="22" name="excempt"  id="excempt" data-toggle="tooltip" title="Show in Kod"  ></span> 
                                  
                                     <span  class="chk_lable_pop" style=" padding: 0 0 0 5.4%;">Print In Kot</span>
                                    <span style="position:relative;top:0px;"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" value="1" tabindex="23" name="printin_kot"  id="printin_kot" data-toggle="tooltip" title="Print in Kot" checked ></span> 
                                     </td> 
                                      </tr>
                                      
                                     </table> 
                             
                             
                                   <table class="popup_add_table" width="100%" border="0" cellspacing="5">    
                                          
                                   <tr class="more_class" style="display:none">
                                          
                                    <td style="display:flex;margin-top: -21px;">
                                        
                                     <span  class="chk_lable_pop" style=" padding: 0 0 0 0%;padding-left:17.3%;"> Barcode</span>
                                    <span style="position:relative;top:0px;"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" value="1" tabindex="24" name="barcode_in"  id="barcode_in" data-toggle="tooltip" title="Barcode Entering" ></span> 
                                    
                                    <span  class="chk_lable_pop" style=" padding: 0 0 0 5.3%;">Recipe Add</span>
                                    <span style="position:relative;top:0px;"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" value="1" tabindex="25" name="ingredient_on"  id="ingredient_on" data-toggle="tooltip" title="Recipes Adding " ></span> 
                                    
                                     <span   class="chk_lable_pop" style=" padding: 0 0 0 2%;display: none">Finished_Good</span>
                                    <span style="position:relative;top:0px;display: none"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;"  value="1" tabindex="26" name="finished_good12"  id="finished_good12" data-toggle="tooltip" title="Goods Type  " ></span> 
                                    
                                    <span   class="chk_lable_pop" style=" padding: 0 0 0 7.2%;display: block">Qr Menu</span>
                                    <span style="position:relative;top:0px;display: block"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;" checked  value="1" tabindex="26" name="qr_menu_set"  id="qr_menu_set" data-toggle="tooltip" title="Enable Qr Menu" ></span> 
                                    
                                    </td> 
                                    
                                    <td style="display:flex;margin-top: -21px;padding-top: 6px">
                                       
                                        <span   class="chk_lable_pop" style=" padding: 0 0 0 13.8%;display: block">Exc Discount</span>
                                    <span style="position:relative;top:0px;display: block"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;"   value="1" tabindex="26" name="exc_disc"  id="exc_disc" data-toggle="tooltip" title="Enable Disc Excempt" ></span> 
                                     
                                    <span   class="chk_lable_pop" style=" padding: 0 0 0 7%;display: block">Stock Inv</span>
                                    <span style="position:relative;top:0px;display: block"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;"   value="1" tabindex="26" name="stock_inv"  id="stock_inv" data-toggle="tooltip" title="Enable Stock Check From Inventory " ></span> 
                                     
                                     <span   class="chk_lable_pop" style=" padding: 0 0 0 4%;display: block">Stock In - Out</span>
                                     <span style="position:relative;top:0px;display: block"><input type="checkbox" class="popup_chk_bx enter" style="margin-left: 5px;"   value="1" checked tabindex="26" name="stock_in_out"  id="stock_in_out" data-toggle="tooltip" title="Enable Stock In Out Daily at Dayclose  " ></span> 
                                     
                                    
                                    
                                    </td> 
                                    
                                   
                                    
                                    </tr>
                              
                                 </table>
                             
                             
                         </div>
                             
                             
                         <table class="popup_add_table" width="100%" border="0" cellspacing="5" style="">  
                             <tbody style="display: inline-block;bottom: -60px;right: 0px;position: absolute; ">
                              <tr style="float:right;display: none;cursor: pointer;" onclick="show_less()" id="show_less">
                                  <td style="color:#0e416c;border: solid 1px;background-color: darkred;border-radius: 5px;color: white;padding: 5px;height: 20px">Less</td>
                                  
                              </tr>
                              </tbody>
                             </table>
                    </div>
				  <!--<a href="#"><button class="md-close newbut" tabindex="15">Close me</button></a>-->
					
   <span id="menustatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>  
   <a href="#" class="entersubmit enter" onClick="validate_registration()" tabindex="27"><span style="margin-top:20px" class="md-save newbut nexttorate" >Save & Proceed</span></a>
				</div>
			</div>
           
        </form>
		</div>



<div class="md-overlay"></div><!-- the overlay element -->

                         <div class="inherit_added_popup" style="height:auto">
                            <h3> Successfully Copied</h3>
                        <div class="change_permission_content">
                            <p class="inherit_added_text" style="font-size: 14px;height:auto;line-height: 20px;"></p>
                        </div>
                         <div class="change_permission_popup_btn">
                                            <a href="#"><div class="pop_btn_new_1 added_ok_btn">OK</div></a>
<!--                                    <a href="#"><div class="pop_btn_new_1 added_ok_btn">Cancel</div></a>-->
                         </div>

                    </div><!--inherit_added_popup-->
                        
                      <div class="change_permission_overlay"></div>  
                      
                      
                      
 
<!------*******add ex tax popup******------>
<div class="add_extra_tax_new_poppup" id="addextratax" style="display:none;">

	<div class="add_extra_tax_pop_head">Add Item Tax</div>
    
    <div class="col-sm-12  ex_tax_contant">
        <div class="col-sm-4" style="padding-right: 5px;padding-left: 0px;margin-bottom:15px;">
            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
             <input name="radio" type="radio" id="menucategory1" name="RadioGroup1" value="category" onchange="validate_categoryname1()"></span>
            <span class="ratecopy_pop_text">Item Category</span></label>
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
      	<div class="form-group" id="categoryname_div1">
            <?php
                                            
             $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaincategory"); 
              $num_kot   = $database->mysqlNumRows($sql_kot);
              if($num_kot){
                  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                ?>
            <select style="width:95%" class="form-control add_new_dropdown add_text_box" id="categoryname1" name="categoryname1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--               <option value="">--Select Category--</option>-->
<!--           <option value="All">All</option>-->
                                           
                     <?php 
                while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                    {
                ?>
                       <?php /*?> <option value="<?=$result_kot['fr_floorid']?>" ><?=$result_kot['fr_floorname']?></option><?php */?>

                          <option value="<?=$result_kot['mmy_maincategoryid']?>" id="m_<?=$result_kot['mmy_maincategoryid']?>"><?=$result_kot['mmy_maincategoryname']?></option>
                         <?php } ?> 

<!--                     </optgroup>-->
            </select>
            <?php } ?>
        </div>
          <input id="maincattaxname1" type="hidden" name="maincattaxname1" value="MC">
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
      	<div class="form-group" id="categorytax_div1">
            <?php $sql_kot  =  $database->mysqlQuery("select * from tbl_extra_tax_master where amc_item_tax='Y'"); 
                  $num_kot   = $database->mysqlNumRows($sql_kot);
                  if($num_kot){//$i=1;
                                                           if($result_kot['amc_unit']=='P'){
                                                                                $unit_show="%";
                                                                            }else{
                                                                                $unit_show="";
                                                                            }
                                                                            
                  ?>
            <select style="width:95%" class="form-control add_new_dropdown add_text_box"  id="categorytax1" name="categorytax1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--             <option value="All">All</option>-->
<!--            <option value="">--Select Tax--</option>-->
              <?php 
	           while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
			{
                           ?>
                         <option value="<?=$result_kot['amc_id']?>" id="<?=$result_kot['amc_id']?>"><?=$result_kot['amc_name']?> &nbsp;&nbsp; [<?=$result_kot['amc_value']?> <?=$unit_show?>]</option>
                            <?php } ?> 
                                </select>
                                  <?php } ?>
        </div>
        </div>
    </div><!--ex_tax_contant-->
    
    
    
    
     <div class="col-sm-12  ex_tax_contant">
        <div class="col-sm-4" style="padding-right: 5px;padding-left: 0px;margin-bottom:15px;">
            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
             <input name="radio" type="radio" id="subcategory1" name="RadioGroup1" value="subcategory" onchange="validate_subcategoryname()"></span>
            <span class="ratecopy_pop_text">Sub Category</span></label>
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
            <div class="form-group disabled_floor_cl" id="subcategoryname_div1">
              <?php
                                            
             $sql_kot  =  $database->mysqlQuery("select * from tbl_menusubcategory"); 
              $num_kot   = $database->mysqlNumRows($sql_kot);
              if($num_kot){
                  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                ?>  
            <select style="width:95%" class="form-control add_new_dropdown add_text_box" id="subcategoryname1" name="subcategoryname1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--             <option value="All">All</option>-->
<!--             <option value="">--Select Subcategory--</option>-->
                                        
                     <?php 
                while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                    {
                ?>
                       <?php /*?> <option value="<?=$result_kot['fr_floorid']?>" ><?=$result_kot['fr_floorname']?></option><?php */?>

                          <option value="<?=$result_kot['msy_subcategoryid']?>" id="<?=$result_kot['msy_subcategoryid']?>"><?=$result_kot['msy_subcategoryname']?></option>
                <?php } ?> 
            </select>
            <?php } ?>
        </div>
            <input id="subcattaxname1" type="hidden" name="subcattaxname1" value="SC">
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
      	<div class="form-group disabled_floor_cl" id="subcategorytax_div1" >
            <?php $sql_kot  =  $database->mysqlQuery("select * from tbl_extra_tax_master  where amc_item_tax='Y'"); 
                  $num_kot   = $database->mysqlNumRows($sql_kot);
                  if($num_kot){

                  ?>
            <select style="width:95%" class="form-control add_new_dropdown" id="subcategorytax1" name="subcategorytax1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--             <option value="All">All</option>-->
<!--              <option value="">--Select Tax--</option>-->
              <?php 
	           while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
			{
                       
                        if($result_kot['amc_unit']=='P'){
                                                                                $unit_show="%";
                                                                            }else{
                                                                                $unit_show="";
                                                                            }
                       
                           ?>
                         <option value="<?=$result_kot['amc_id']?>" id="<?=$result_kot['amc_id']?>"> <?=$result_kot['amc_name']?>  &nbsp;&nbsp; [<?=$result_kot['amc_value']?> <?=$unit_show?>]</option>
                            <?php } ?> 
                                </select>
                                  <?php } ?>
        </div>
        </div>
    </div><!--ex_tax_contant-->
    
    
    
    
    <div class="col-sm-12  ex_tax_contant">
        <div class="col-sm-4" style="padding-right: 5px;padding-left: 0px;margin-bottom:15px;">
            <label style="display:block;font-weight:200;"><span class="ratecopy_pop_checkbox">
             <input name="radio" type="radio" id="diet1" name="RadioGroup1" value="diet" onchange="validate_dietname()"></span>
            <span class="ratecopy_pop_text">Diet</span></label>
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
      	<div class="form-group disabled_floor_cl"  id="dietname_div1">
            <select style="width:95%" class="form-control add_new_dropdown" id="dietname1" name="dietname1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--             <option value="All">All</option>-->
<!--          <option value="">--Select Diet--</option>-->
             <!-- <optgroup label="Diet">-->
              <option value="General">General</option>
                <option value="Non Veg">Non Veg</option>
                <option value="Veg">Veg</option>
               
<!--             </optgroup>-->
            </select>
        </div>
             <input id="diettaxname1" type="hidden" name="diettaxname1" value="DT">
        </div>
        <div class="col-sm-4" style="padding:0; margin-bottom:5px;">
      	<div class="form-group disabled_floor_cl" id="diettax_div1">
             <?php $sql_kot  =  $database->mysqlQuery("select * from tbl_extra_tax_master  where amc_item_tax='Y'"); 
                  $num_kot   = $database->mysqlNumRows($sql_kot);
                  if($num_kot){

                  ?>
            <select style="width:95%" class="form-control add_new_dropdown" id="diettax1" name="diettax1" data-rel="chosen" title="Tax" left"." data-toggle="tooltip">
<!--             <option value="All">All</option>-->
<!--          <option value="">--Select Tax--</option>-->
               <?php 
	           while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                {
                        if($result_kot['amc_unit']=='P'){
                                                                                $unit_show="%";
                                                                            }else{
                                                                                $unit_show="";
                                                                            }
                       
                   ?>
                 <option value="<?=$result_kot['amc_id']?>" id="<?=$result_kot['amc_id']?>"><?=$result_kot['amc_name']?>&nbsp;&nbsp; [<?=$result_kot['amc_value']?> <?=$unit_show?>]</option>
                    <?php } ?> 
                        </select>
                          <?php } ?>
 
        </div>
        </div>
    </div><!--ex_tax_contant-->
    
    
    
    
    <div class="col-sm-12 extax_btn_cc">
         <div style="margin-left:1%;width:90px;float:none;display:inline-block" class="ex_tax_btn search_btn_member_invoice rate_change_close"><a id="close_popup" href="#"  >Close</a></div>
<!--		<a id="close_popup" href="#"><div class="ex_tax_btn">Close</div></a> -->
                <div style="margin-left:1%;width:90px;float:none;display:inline-block" class="ex_tax_btn search_btn_member_invoice tax_change_sub submitcat change_permission_btn1"><a href="#" onClick="validate_cattax()"  >Submit</a></div>
                          <div style="margin-left:1%;width:90px;float:none;display:none" class="ex_tax_btn search_btn_member_invoice tax_change_sub submitsubcat change_permission_btn2"><a href="#" onClick="validate_subcattax()"  >Submit</a></div>
                          <div style="margin-left:1%;width:90px;float:none;display:none" class="ex_tax_btn search_btn_member_invoice tax_change_sub submitdiet change_permission_btn3"><a href="#" onClick="validate_diettax()"  >Submit</a></div>
                          <div style="margin-left:1%;width:90px;float:none" class="ex_tax_btn search_btn_member_invoice tax_change_sub removeall change_permission_btn3"><a href="#" onClick="validate_removetax()"  >Remove</a></div>
                          
<!--        <a href="#"><div class="ex_tax_btn">Submit</div> </a> 	-->
    </div><!---btn--cc--->
    
</div>
<!------*******add ex tax popup******------>
                                    
                                    
                                    
<!------*******add discount popup******------>                             
                                    
<div id="load_discount_add">
    
</div>         
                                     
                                      
<!------*******add discount popup******------>    
    
   
  <div class="categ_discount_popup_cc" style="display: none">
        	<div class="discount_popup">
                <div class="discount_popup_head" >Category Discount <a href="#"><button class="md-close_pop discount_pop_close categ_discount_cls ">x</button></a></div>
        		<div class="discount_popup_conatant">
        			<div class="dicount_popup_add_sec">
        			
        				<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:14%;margin-bottom: 15px">
                             <p class="menu_filter_txt">Type</p>
                             <select class="form-control" id="category_type_ds" onchange="return change_cat(this.value);">
                                 <option value="">Select Type</option>
                                 <option value="main">Main Category</option>
                                  <option value="sub">Sub Category</option>
                                 
                               </select>
					     </div>
                                    
                                    
                                    
                                    <div id="null_div" class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:14%;margin-bottom: 15px;">
                                        <p class="menu_filter_txt"></p>
                                        <input type="text" readonly class="form-control" placeholder="None" >
                                      
                                        </div>    
                                            
                                            
                                            
                             <div id="main_cat_div" class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:14%;margin-bottom: 15px;display: none">
                             <p class="menu_filter_txt">Main Category</p>
                              <select class="form-control" id="maincat_ds">
                                  <?php
                                   $sql_kot1  =  $database->mysqlQuery("select * from tbl_menumaincategory"); 
              $num_kot1   = $database->mysqlNumRows($sql_kot1);
              if($num_kot1){
                      
                while($result_kot  = $database->mysqlFetchArray($sql_kot1)) 
                    {
                ?>
           
                                <option value="<?=$result_kot['mmy_maincategoryid']?>" id="m_<?=$result_kot['mmy_maincategoryid']?>"><?=$result_kot['mmy_maincategoryname']?></option>
              <?php } } ?>
                                 
                               </select>
					     </div>
                                    
                                    <div id="sub_cat_div" class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:14%;margin-bottom: 15px;display: none">
                             <p class="menu_filter_txt">Sub Category</p>
                              <select class="form-control" id="subcat_ds">
                                  <?php
                                   $sql_kot1  =  $database->mysqlQuery("select * from tbl_menusubcategory"); 
              $num_kot1   = $database->mysqlNumRows($sql_kot1);
              if($num_kot1){
                      
                while($result_kot  = $database->mysqlFetchArray($sql_kot1)) 
                    {
                ?>
           
                               <option value="<?=$result_kot['msy_subcategoryid']?>" id="<?=$result_kot['msy_subcategoryid']?>"><?=$result_kot['msy_subcategoryname']?></option>
              <?php } } ?>
                                 
                               </select>
					     </div>
					     <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:14%;margin-bottom: 15px">
                             <p class="menu_filter_txt">Discount</p>
                              <select class="form-control" id="discount_ds">
                                 <?php 
                       $sql_cat_s_dis  =  $database->mysqlQuery("select * from  tbl_discountmaster where ds_item_discount='Y' and ds_status='Active' ");

           $num_cat_s_dis  = $database->mysqlNumRows($sql_cat_s_dis);
	if($num_cat_s_dis){
		while($result_ds_view_dis  = $database->mysqlFetchArray($sql_cat_s_dis)) 
			{
                    
                    if($result_ds_view_dis['ds_mode']=='P'){
                        $mode='%';
                        }else{
                          $mode="";  
                        }
                    
                    
                    ?>
                              <option value="<?=$result_ds_view_dis['ds_discountid']?>"> <?=$result_ds_view_dis['ds_discountname']?>&nbsp;[<?=$result_ds_view_dis['ds_discountof']?>  <?=$mode?>]</option>
                              
        <?php } } ?>
                                
                               </select>
					     </div>
					     <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:10%;margin-bottom: 15px">
                             <p class="menu_filter_txt">Status</p>
                              <select class="form-control" id="status_dis">
                                 <option value="Y">Active</option>
                                 <option value="N">Inactive</option>
                               </select>
					     </div>
					    <div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:6%;margin-bottom: 15px">
                          <p class="menu_filter_txt">Dine In</p>
                          <input type="checkbox" class="checkbox_discount" id="di1">
					    </div>
					    
				     <div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 15px">
                          <p class="menu_filter_txt">Take Away</p>
                          <input type="checkbox" class="checkbox_discount" id="ta1">
					 </div>
				     <div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:6%;margin-bottom: 15px">
                          <p class="menu_filter_txt">CS</p>
                          <input type="checkbox" class="checkbox_discount" id="cs1">
					 </div>
                                    <div style="display: none ">
			<div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:10%;margin-bottom: 15px" >
                          <p class="menu_filter_txt">Date Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="d_limit" onchange="datechange();">
					 </div>
				     <div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 15px">
                          <p class="menu_filter_txt">Time Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="t_limit"  onchange="timechange();">
					 </div>
				     <div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 15px">
                          <p class="menu_filter_txt">Day Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="day_limit"  onchange="daychange();">
			</div>
                          </div>                     
			     
			     	<div class="col-sm-2" style="padding-right: 5px; padding-left: 0px; width: 14%; margin-bottom: 10px;display: none" id="from_div">
                          <p class="menu_filter_txt">From</p>
                          <input type="text" class="form-control" placeholder="From" id="from_date" data-provide="datepicker">
					   </div>
					  <div class="col-sm-2" style="padding-right: 5px; padding-left: 0px; width: 14%; margin-bottom: 10px;display: none" id="to_div">
                          <p class="menu_filter_txt">To</p>
                          <input type="text" class="form-control" placeholder="To" id="to_date" data-provide="datepicker">
					   </div>
					 <div class="col-sm-2" style="padding-right: 5px; padding-left: 0px; width: 14%;  margin-bottom: 10px;display: none" id="from_time_div">
                          <p class="menu_filter_txt">Start Time</p>
                          <input type="time" class="form-control" placeholder="Start Time" id="start_time" onchange="fromtime(this.value);">
                           <span id="display_timefrom" style="display:none"></span>
					   </div>
					   <div class="col-sm-2" style="padding-right: 5px; padding-left: 0px; width: 14%;  margin-bottom: 10px;display: none" id="to_time_div">
                          <p class="menu_filter_txt">End Time</p>
                          <input type="time" class="form-control" placeholder="End Time" id="end_time" onchange="totime(this.value);" >
                           <span id="display_timeto" style="display:none"></span>
					   </div>
					   <div class="col-sm-2" style="padding-right: 5px; padding-left: 0px; width: 13%; margin-bottom: 10px;display: none" id="day_div">
                          <p class="menu_filter_txt">Day</p>
                          <select class="form-control" id="day">
                               <option value="">Select</option>
                              <option value="Monday">Monday</option>
                               <option value="Tuesday">Tuesday</option>
                               <option value="Wednesday">Wednesday</option>
                               <option value="Thursday">Thursday</option>
                               <option value="Friday">Friday</option>
                               <option value="Saturday">Saturday</option>
                               <option value="Sunday">Sunday</option>
                              
                          </select>
					   </div>
				     
					     
        			</div>
        			
        			<div class="col-sm-12 extax_btn_cc" style="border: 0">
        			
         			
                                    <div style="" class="ex_tax_btn search_btn_member_invoice tax_change_sub  "><a href="#" onclick="return submit_all();" >Submit</a></div>
                         
					  <div class="ex_tax_btn search_btn_member_invoice tax_change_sub "><a href="#" onclick="return remove_all();">Remove</a></div>
                          
    				</div>
        			
				</div>
				 
	  		</div> 
  </div>                                                                                                                                                 
  
  

  <div class="ingredient_popup_cc" style="display:none">
 	
			<div class="ingredient_popup" style="width: 900px;height: 600px;top: 2%;">
          <div class="ingredient_popup_head">

              <div style="display:flex;">  <strong  id="load_error_ing" style="color:#d36c6c;float:left;margin-top: 0px;font-size: 15px;position: absolute" ></strong> <h3> RECIPES : <strong id="ing_menu_name" ></strong></h3><div class="ingredient_item_rate" style="width:20%;"> 
                     
                      <select id="portion_ing" class="ingredient_item_txtbox"  style="margin-left: -133px;width: 60%">
                         
                          <?php 
                          $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                                                                                      while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                            {
                                               ?>                                  
                          <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname'].' ['.$result_kot['pm_id'].']'?></option>
                          <?php } } ?>
                      </select>
                      
                      
                      <input style="margin-left: -29px;" onkeypress="return numonly9(this,event);" id="yield" value="1" class="ingredient_item_txtbox" placeholder="Yield [Nos]" type="text"></div></div> 
           
                      <div style="display:block" class="md-close close_staff_pop close_ingredient_popup1" tabindex="34"><img src="img/close_ico.png"></div>
          </div>
          <div class="ingredient_popup_contant">
               <div class="ingredient_item_head">
                  <div class="ingredient_item_name" style="width:12%; margin-left:0.5%;">ITEM </div>
                   <div class="ingredient_item_portion" style="width:6%;">. </div>
                  <div class="ingredient_item_portion" style="width:6%;">UNIT</div>
                  <div class="ingredient_item_portion" style="width:6%;">TYPE</div>
                  <div class="ingredient_item_qty" style="width:6%;">WEIGHT</div>
                  <div class="ingredient_item_qty" style="width:8%;">QTY</div>
                  <div class="ingredient_item_rate" style="width:10%;">RATE</div>
                  <div class="ingredient_item_rate" style="width:10%;">WST QTY</div>
                  <div class="ingredient_item_rate" style="width:10%; margin-left:0.5%;">WST RATE</div>
                  <div class="ingredient_item_rate" style="width:2%; margin-left:0%;">DI</div>
                  <div class="ingredient_item_rate" style="width:2%;">TA</div>
                  <div class="ingredient_item_rate" style="width:2%;">HD</div>
                  <div class="ingredient_item_rate" style="width:2%;">CS</div>
                  <div class="ingredient_item_rate" style="width:5%;"></div>
               </div>
               <div class="ingredient_popup_contant_row_cc" style="height: 450px;">
                   <div class="right_mn_section append_div_main" style="position:relative">
                  <div id="second_div_main" class="ingredient_popup_contant_row">
                      <div  class="ingredient_item_name" style="width:12%;"><input onkeyup="search_ing()"  id="item_ing" class="ingredient_item_txtbox" type="text"></div>
                      
                        <div id="name_load" class="customer_list_autoload" style="display:none;width: 30%; top: 32px;left: 0px">
                              <ul>
                               <li onclick="return ing_click();" style="cursor: pointer"> </li>
                             </ul>
                             </div>
                         
                      <div class="ingredient_item_qty"  style="width:6%;"><input readonly placeholder="Portion" class="ingredient_item_txtbox" type="text"></div>
                      
                       <div class="ingredient_item_qty"  style="width:6%;"><input readonly   id="type_ing" class="ingredient_item_txtbox" type="text"></div>
                       
                       <div class="ingredient_item_qty"  style="width:6%;"><input readonly   id="rate_type_ing" class="ingredient_item_txtbox" type="text"></div>
                      
                        <div class="ingredient_item_rate" style="width:6%;"><input onkeypress="return numdot_dot(this,event);"  onkeyup="calc_rate();" id="weight_ing" class="ingredient_item_txtbox" type="text"></div>
                       
                       
                      <div class="ingredient_item_qty"  style="width:8%;"><input onkeypress="return numdot_dot(this,event);" onkeyup="calc_rate();"  maxlength="3" id="qty_ing" class="ingredient_item_txtbox" type="text"></div>

                      <div class="ingredient_item_rate" style="width:10%;"><input onkeypress="return numdot_dot(this,event);"  onkeyup="calc_rate();" maxlength="5" id="rate_ing" class="ingredient_item_txtbox" type="text"></div>
                   
                      <div class="ingredient_item_rate" style="width:10%;"><input onkeypress="return numdot_dot(this,event);"  id="waste_qty" class="ingredient_item_txtbox" type="text"></div>
                      <div class="ingredient_item_rate" style="width:10%;"><input  onkeypress="return numdot_dot(this,event);" id="waste_rate" class="ingredient_item_txtbox" type="text"></div>
                      <div class="ingredient_item_rate" style="width:2%;"><input   id="di_ing" class="ingredient_item_txtbox" checked type="checkbox"></div>
                      <div class="ingredient_item_rate" style="width:2%;"><input   id="ta_ing" class="ingredient_item_txtbox" checked type="checkbox"></div>
                      <div class="ingredient_item_rate" style="width:2%;"><input   id="hd_ing" class="ingredient_item_txtbox" checked type="checkbox"></div>
                      <div class="ingredient_item_rate" style="width:2%;"><input   id="cs_ing" class="ingredient_item_txtbox" checked type="checkbox"></div>
                      <div class="plus_icon plusbtn" style="width:5%;">+</div>
                  </div>
                  </div>
              </div>
          </div>

          <div class="ingredient_popup_footer_row">
              
               <div style="display: flex;justify-content: space-between;align-items: center; font-size:16px;">
                   <div style="display: flex;justify-content: space-between;align-items: center;"><strong>DI FC :</strong> <span id="difc">0</span></div>
               <div style="display: flex;justify-content: space-between;align-items: center;"><strong>TA FC :</strong> <span id="tafc">0</span></div>
               <div style="display: flex;justify-content: space-between;align-items: center;"><strong>HD FC :</strong> <span id="hdfc">0</span></div>
               <div style="display: flex;justify-content: space-between;align-items: center;"><strong>CS FC :</strong> <span id="csfc">0</span></div>
              <div style="cursor:pointer" class="ingredient_popup_footer_btn close_ingredient_popup">SAVE & PROCEED </div>
              </div>
          </div>


       </div>

  </div>
                                                                                                                                                                                                                                                          
                                                                
                                                                                                                            

<script type="text/javascript" >
          $('.entersubmit').ready(function () {
   
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
    
    
    
	$(function(){
	    var menu=$('#menuidnew').val();
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadGalFile.php?upid=<?=$upload_id?>&menuid='+menu,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				/* if (! (ext && /^(jpg|png|jpeg|gif|bmp|tif)$/.test())){ 
                    // extension is not allowed 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					return false;
				}*/
				mestatus.html('<font color="#ff0000">Please wait...</font> <img src="resources/images/ajax-loader.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				//mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				var details	= response.split("|");
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
				} else{
					mestatus.text('Photo Uploaded Error!');
//					alert("File Uploaded Error!");
						//mestatus.text('Image uploaded successfully!');
				}
		$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+menu,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
			}
		});
	});
</script>
<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
 <script src="js/timepicki.js"></script>
 
<script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('#timepicker1').timepicki();
</script>
<script type="text/javascript">
    
    function hide_view(mid){
        
        
        var check = confirm(" WARNING : REMOVE ITEM FROM SOFTWARE . ONCE REMOVED CANT BE RESTORED? ");
	if(check==true)
	{
   
       var datastringnewcard="set=hide_menu&mid="+mid;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: datastringnewcard,
        success: function(data)
        {  
           
            var mname=$("#mname").val();
  if(mname=="")
  {
	  mname="null";     
  } 
  
  var mcate=$("#mcate").val();
  if(mcate=="")
  {
	  mcate="null";
          
  }

   var msubc=$("#msubc").val();
  if(msubc=="")
  {
	  msubc="null";
          
  }
   var mdiet=$("#mdiet").val();
  if(mdiet=="")
  {
	  mdiet="null";
          
  }
   var mstatus=$("#mstatus").val();
  if(mstatus=="")
  {
	  mstatus="null";
          
  }
  
    var kitchen=$("#kitchen").val();
  if(kitchen=="")
  {
	  kitchen="null";
          
  } 
  
   var image_see=$("#image_see").val();
  if(image_see=="")
  {
	  image_see="null";
          
  } 
  
  var excempt_sr=$("#excempt_sr").val();
  if(excempt_sr=="")
  {
	  excempt_sr="null";
          
  } 
  
  var m_ref_cnt=$("#m_ref_cnt").val();
  if(m_ref_cnt=="")
  {
	  m_ref_cnt="null";
          
  } 
  
  
  
        localStorage.menuname=mname;
        localStorage.catname=mcate;
        localStorage.subcatname=msubc;
        localStorage.diet=mdiet; 
        localStorage.stat=mstatus;
        localStorage.kitch=kitchen;
        localStorage.image_see=image_see;
        localStorage.excempt_sr=excempt_sr;
        localStorage.m_ref_cnt= m_ref_cnt;
        
       
        $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                 
           });                 
            
        }
       });
        
        
    }
    } 
    
    
    function show_more(){
        
          $('#show_more').hide();
            $('#show_less').show();
            
          $('.more_class').show();   
            
            
            if($('#finished_good').val()=='Raw'){ 
             $('.raw_hide_class').hide(); 
         }else{
            $('.raw_hide_class').show();  
         }
          
    }
    
    
    function show_less(){
        
        
         $('#show_less').hide();
            $('#show_more').show();
        
         $('.more_class').hide();
    }
    
   function check_type_rate_change(){
       
       
       var type=$('#nwtype').val();
      
       if(type=='%'){
           
          
           $('.rate_multi_new').hide();
            $('.rate_single_new').show();
            
       }
       else{
           $('.rate_single_new').hide();
            $('.rate_multi_new').show();
       
        }
       
     
   } 
    
    
function deletecard(e,m){

        var check = confirm(" REMOVE ? ");
	if(check==true)
	{
   
       var datastringnewcard="value=delcar&id="+e;
        $.ajax({
        type: "POST",
        url: "load_menu_ingredient.php",
        data: datastringnewcard,
        success: function(data)
        {  
            $('#second_div_main'+e).hide();
            $('#second_div_main'+e).remove();
             
            
        }
    });
    
     var datastring = "menuid_main="+m+"&value=check_food_cost"
                 $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 { 
                     
                       var det=$.trim(data).split('*');
                       
                     var di_tot=det[1];  
                      var ta_tot=det[2];  
                       var hd_tot=det[3];  
                        var cs_tot=det[4];  
                      $('#difc').text(di_tot);  $('#tafc').text(ta_tot);  $('#hdfc').text(hd_tot);  $('#csfc').text(cs_tot);
                      
                      
                      
                      
                 }
                 }); 
    
    
    
    }
}
    
	    function calc_rate(){
        
          var decimal=$('#decimal').val();
        
        var rt=$('#rate_ing').val();
          var qty=$('#qty_ing').val();
    
    var tot=rt*qty;
    
    $('#tot_ing').val(tot.toFixed(decimal));
    
    }
    
    
   function numonly9(item,evt)
    {
              
        
        
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)) {

            return false;

        }
          
        return true;
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
        
        
        
function menuclr()
{       
    
                show_less();
                document.getElementById('menuname').value = '';
         
                document.getElementById('menuname').focus();
        
                document.getElementById('shortcode').value = '';
                document.getElementById('item_shortcode').value = '';
		
		document.getElementById('maincat').value = '';
		document.getElementById('time').value = '10';
		document.getElementById('subcat').value = '';
		
		document.getElementById('description').value = '';
                
                document.getElementById('finished_good').value = 'Menu';
                document.getElementById('ratetype').value = 'Portion';
                document.getElementById('unittype_selection').value = '';
                document.getElementById('baseunitselect').value = '';
             
                 document.getElementById('plu_code').value = '';
                 document.getElementById('raw_barcode').value = '';
                 document.getElementById('reorder_level').value = '';
                 document.getElementById('purcahse_rate').value = '';
		
     	          $('#menuchk').text('');
		  $("#insetmsg_menu").removeClass("has-error");
		  $("#insetmsg_sht").removeClass("has-error");
                  $("#item_shortcode_div").removeClass("has-error");
                  
                    	        $("#insetmsg_kot").removeClass("has-error");
			        $("#insetmsg_main").removeClass("has-error");
				$("#insetmsg_diet").removeClass("has-error");
				$("#insetmsg_pre").removeClass("has-error"); 
				$("#insetmsg_est").removeClass("has-error");
				$("#insetmsg_des").removeClass("has-error");
                                          
                             $("#insetmsg_inv").removeClass("has-error");        
                             $("#insetmsg_inv").removeClass("has-success");               
                             $("#insetmsg_menu").removeClass("has-success");
		             $("#insetmsg_sht").removeClass("has-success");
                             $("#item_shortcode_div").removeClass("has-success");
                    	     $("#insetmsg_kot").removeClass("has-success");
			     $("#insetmsg_main").removeClass("has-success");
			     $("#insetmsg_diet").removeClass("has-success");
			     $("#insetmsg_pre").removeClass("has-success"); 
			     $("#insetmsg_est").removeClass("has-success");
			     $("#insetmsg_des").removeClass("has-success");
                                          
                                          
                             $("#dynamicrate").each(function() { this.checked=false; });
                             $("#stockinnumbrs").each(function() { this.checked=false; });
		             $("#insetmsg_subc").removeClass("has-error");
                          
    setTimeout(function(){
        $("#menuname").focus();
    },500);  

    $("#nwrate").focus();


    $document.ready(function()
    {
       $("#menuname").focus();
    });


}


$(".enter").keypress(function(event){
    
    if(event.keyCode==13){  
        validate_registration();
    }
    
});


function valimenu()
{ 
	 var a=$("#menuname").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkmenu&mid="+a,
			success: function(msg)
			{
			        msg=$.trim(msg);
				var namechk=$('#menuchk');
				if(msg =="sorry")
				{
                                            
			   namechk.text('Already Exist');
			   $("#insetmsg_menu").addClass("has-error");
	                   $("#menuname").focus();
                       
			    }
			    else
                            {  
                                            
                                             
                        var plu=$("#plu_code").val();
	
	                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkplu&mid="+plu,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#menuchk');
                               
				if(msg =="sorry")
					{
			 alert('PLU Already Exist');
			  
	                   $("#plu_code").focus();
                          
					}
					else
                                        
					{   
                                            
                                            
                                            
           var central_id=$("#central_id").val();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcentral&mid="+central_id,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#menuchk');
                               
				if(msg =="sorry" && central_id!='')
					{
                                            
			          alert('Central Kitchen Id Exist');
			  
	                           $("#central_id").focus();
                          
					}
					else
                                        
					{ 
                                            
                                            
                                                 $('.new_print_loading_bill').css('display','block'); 
						 namechk.text('');
						 $("#insetmsg_menu").removeClass("has-error");
                                                 $("#insetmsg_menu").addClass("has-success");
                                                 document.menu.submit();
                                                 $('.new_print_loading_bill').css('display','block'); 
                                                 return true;
                                                 
                                          }       
                                     }
		                     });             
                             }
                                                 
                                                 
                                                 
					
			}
		}); 
                                            
                        
					}
			}
		});
}

function validate_registration()
{
	if(validate_menu())
	{ 
		if(validate_shrtcode())
		{
                    if(validate_itemshrtcode())
		{
			if(validate_kot())
			{
				if(validate_mainct())
				{
					if(validate_diet())
					{
						if(validate_time())
						{ 
							if(validate_prepmode())
							{   
                                                            if(validate_unit_type()){
                                                                
                                                                if(validate_baeseunit()){
                                                                    
                                                                   if(validate_store()){ 
                                                                       
                                                                    if(valimenu())
                                                                    {

                                                                    }
                                                                }
                                                                
                                                                }        
                                                            }    
							
								
                                                            }
							}
						}
					}
				}
			}
		}
	}
}

function validate_menu()   
{
  if($("#menuname").val()=="")
  {
	  $("#insetmsg_menu").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	
	  document.menu.menuname.focus();
        //  alert("Enter Name");
          
          
           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Enter Name');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
  }
  
                 var alphanumers = /^[a-zA-Z0-9 _.]+$/;
                              if(!alphanumers.test($("#menuname").val())){
                              $("#insetmsg_menu").addClass("has-error");
                                document.menu.menuname.focus();
                       
                          
                          
                           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Special characters Not Allowed');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
                   } 
                else
   {
	   $("#insetmsg_menu").removeClass("has-error");
           $("#insetmsg_menu").addClass("has-success");
	
	   return true;
   }
   }

function validate_shrtcode()   
{
  if($("#shortcode").val()=="")
  {
	  $("#insetmsg_sht").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.shortcode.focus();
          alert("Enter Short Code");
	  return false;
  }
  
             var alphanumers = /^[a-zA-Z0-9 _.]+$/;
                              if(!alphanumers.test($("#shortcode").val())){
                              $("#insetmsg_sht").addClass("has-error");
                                document.menu.shortcode.focus();
                          alert("Special characters Not Allowed.");
                   }       
                else
        {
	   $("#insetmsg_sht").removeClass("has-error");
	   $("#insetmsg_sht").addClass("has-success");
	   return true;
        }
    }
    
   function validate_itemshrtcode()   
{
  if($("#item_shortcode").val()=="")
  {
//	  $("#item_shortcode_div").addClass("has-error");
//	  $('.has-error').css("border","none");
//	    $('.has-error').css("box-shadow","none");
//	  document.menu.item_shortcode.focus();
//          alert("Enter Item Code")
//	  return false;
     return true;
  }
  
             var alphanumers = /^[a-zA-Z0-9]+$/;
                              if(!alphanumers.test($("#item_shortcode").val())){
                              $("#item_shortcode_div").addClass("has-error");
                                document.menu.item_shortcode.focus();
                          alert("Special characters Not Allowed");
                   }       
                else
        {
	   $("#item_shortcode_div").removeClass("has-error");
	   $("#item_shortcode_div").addClass("has-success");
	   return true;
        }
    } 

function validate_store()   
{
   if($("#inv_kitchen").val()=="0" && $("#finished_good").val()!="Raw")
    { 
	  $("#insetmsg_inv").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.inv_kitchen.focus();
          //alert("Select Store");
          
          $(".alert_error_popup_all_in_one_menu").show();
          $(".alert_error_popup_all_in_one_menu").text('Select Store');
          $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
    }else
    {
	   $("#insetmsg_inv").removeClass("has-error");
	   $("#insetmsg_inv").addClass("has-success");
	   return true;
    }
   
 }     



function validate_kot()   
{
  if($("#kotcounter").val()=="" && $("#finished_good").val()!="Raw")
  { 
	  $("#insetmsg_kot").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.kotcounter.focus();
        //  alert("Select Kitchen");
          
          $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Kitchen');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
          
	  return false;
 }
//   var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                              if(!alphanumers.test($("#kotcounter").val())){
//                              $("#insetmsg_kot").addClass("has-error");
//                                document.menu.kotcounter.focus();
////                          alert("Special charecter Not Allowed.");
//                   } 
                              
                     else
                        {
	   $("#insetmsg_kot").removeClass("has-error");
	   $("#insetmsg_kot").addClass("has-success");
	   return true;
        }
    }     

function validate_mainct()   
{
  if($("#maincat").val()=="")
  {
	  $("#insetmsg_main").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.maincat.focus();
         // alert("Select Main Category");
          
          $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Main Category');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
          
	  return false;
  }
//                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                  if(!alphanumers.test($("#maincat").val())){
//                  $("#insetmsg_main").addClass("has-error");
//                   document.menu.maincat.focus();
//                          alert("Special charecter Not Allowed.");
//                   } 
        
                else
                   {
	   $("#insetmsg_main").removeClass("has-error");
	   $("#insetmsg_main").addClass("has-success");
	   return true;
        }

}
function validate_diet()   
{
  if($("#diet").val()=="")
  {
	  $("#insetmsg_diet").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.diet.focus();
          alert("Select Diet");
	  return false;
  }
      var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#diet").val())){
                  $("#insetmsg_diet").addClass("has-error");
                  document.menu.diet.focus();
                          alert("Special charactera Not Allowed.");
                   }
        
        else
   {
	   $("#insetmsg_diet").removeClass("has-error");
	   $("#insetmsg_diet").addClass("has-success");
	   return true;
   }
}//shortcode  kotcounter  maincat  subcat diet description time prepmode
function validate_des()   
{
  if($("#description").val()=="")
  {
	  $("#insetmsg_des").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.description.focus();
	  return false;
  }
  
//          var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                  if(!alphanumers.test($("#description").val())){
//                  $("#insetmsg_des").addClass("has-error");
//                   document.menu.description.focus();
////                          alert("Special charecter Not Allowed.");
//                   }
//        
        
        else
   {
	   $("#insetmsg_des").removeClass("has-error");
	   $("#insetmsg_des").addClass("has-success");
	   return true;
   }
}
function validate_time()   
{
  if($("#time").val()=="")
  {
	  $("#insetmsg_est").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.time.focus();
           alert("Enter Estimate Time");
	  return false;
  }
               var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#time").val())){
                  $("#insetmsg_est").addClass("has-error");
                  document.menu.time.focus();
                         alert("Special characters Not Allowed.");
                   } 
            else
        {
	   $("#insetmsg_est").removeClass("has-error");
	   $("#insetmsg_est").addClass("has-success");
	   return true;
        }
    }

function validate_prepmode()   
{
  if($("#prepmode").val()=="")
  {
	  $("#insetmsg_pre").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.prepmode.focus();
          alert("Select Preparation Mode");
	  return false;
  }
  
         var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#prepmode").val())){
                  $("#insetmsg_pre").addClass("has-error");
                 document.menu.prepmode.focus();
                          alert("Special characters Not Allowed.");
                   } 
        
        else
   {
	   $("#insetmsg_pre").removeClass("has-error");
	   $("#insetmsg_pre").addClass("has-success");
	   return true;
   }
}
function validate_baeseunit(){
    
    if($(".portionunit_selection").val()=="Unit")
  {     
        if($("#baseunitselect").val()==''){
        
	  $("#insetmsg_baseunit").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.baseunitselect.focus();
         // alert("Select Base Unit");
          
          $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Base Unit');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
          
	  return false;
      }
      else
   {
	   $("#insetmsg_baseunit").removeClass("has-error");
	   $("#insetmsg_baseunit").addClass("has-success");
	   return true;
   }
  }
  else{
      return true;
  }
    
}

function validate_unit_type(){
    
    if($(".portionunit_selection").val()=="Unit")
  {     
        if($("#unittype_selection").val()==''){
        
	  $("#insetmsg_unittype").addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.unittype_selection.focus();
         // alert("Select  Unit Type");
          
           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Unit Type ');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
      }
      else
   {
	   $("#insetmsg_unittype").removeClass("has-error");
	   $("#insetmsg_unittype").addClass("has-success");
	   return true;
   }
  }
  else{
      return true;
  }
    
}

function update_registration(id)
{
   
	if(validate_emenu(id))
	{ 
		if(validate_eshrtcode(id))
		{
			if(validate_ekot(id))
			{
				if(validate_emainct(id))
				{
					if(validate_ediet(id))
					{
						if(validate_etime(id))
						{ 
							if(validate_eprepmode(id))
							{ 
								/*if(validate_edes(id))
								{*/
                                  
									$("#menu_masteredit"+id).submit();
									//$('.md-close').click();
									
								/*}*/
							}
						}
					}
				}
			}
		}
	}
}

function validate_emenu(id)   
{
  if($("#menuname1"+id).val()=="")
  {
	  $("#insetmsg_emenu"+id).addClass("has-error");
	
	  $("#menuname1"+id).focus();
	  
	  return false;
  }else
   {
	   $("#insetmsg_emenu"+id).removeClass("has-error");
	   $("#insetmsg_emenu"+id).addClass("has-success");
	   return true;
   }
}
function validate_eshrtcode(id)   
{
  if($("#shortcode1"+id).val()=="")
  {
	  $("#insetmsg_esht"+id).addClass("has-error");
	
		
	  $("#shortcode1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_esht"+id).removeClass("has-error");
	   $("#insetmsg_esht"+id).addClass("has-success");
	   return true;
   }
}
function validate_ekot(id)   
{
  if($("#kotcounter1"+id).val()=="")
  {
	  $("#insetmsg_ekot"+id).addClass("has-error");
	 
	  $("#kotcounter1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_ekot"+id).removeClass("has-error");
	   $("#insetmsg_ekot"+id).addClass("has-success");
	   return true;
   }
}
function validate_emainct(id)   
{
  if($("#maincat1"+id).val()=="")
  {
	  $("#insetmsg_emain"+id).addClass("has-error");
	
	  $("#maincat1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_emain"+id).removeClass("has-error");
	   $("#insetmsg_emain"+id).addClass("has-success");
	   return true;
   }
}
function validate_ediet(id)   
{
  if($("#diet1"+id).val()=="")
  {
	  $("#insetmsg_ediet"+id).addClass("has-error");
	  
	  $("#diet1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_ediet"+id).removeClass("has-error");
	   $("#insetmsg_ediet"+id).addClass("has-success");
	   return true;
   }
}
function validate_edes(id)   
{
  if($("#description1"+id).val()=="")
  {
	  $("#insetmsg_edes"+id).addClass("has-error");
	  
	  $("#description1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_edes"+id).removeClass("has-error");
	   $("#insetmsg_edes"+id).addClass("has-success");
	   return true;
   }
}
function validate_etime(id)   
{
  if($("#time1"+id).val()=="")
  {
	  $("#insetmsg_eest"+id).addClass("has-error");
	
	  $("#time1"+id).focus();
	  return false;
  }
  else
   {
	   $("#insetmsg_eest"+id).removeClass("has-error");
	   $("#insetmsg_eest"+id).addClass("has-success");
	   return true;
   }
}
function validate_eprepmode(id)   
{
  if($("#prepmode1"+id).val()=="")
  {
	  $("#insetmsg_epre"+id).addClass("has-error");
	 
	  $("#prepmode1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_epre"+id).removeClass("has-error");
	   $("#insetmsg_epre"+id).addClass("has-success");
	   return true;
   }
}			
</script>
<script type="text/javascript">
        
        
        
        
   $("#finished_good").change(function(){
	
	  $("#menuname").focus();    
	  var type   =  $(this).val();
		
	if(type=='Menu'){
            
             $("#inv_star").show();
             $(".raw_hide_class").show();
             show_less();
               
             $(".reorder_hide_class").hide();    
             $(".purchase_hide_class").show();    
             $("#show_more").show();
             $(".raw_hide_class_barcode").hide(); 
             
                        $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check&type=menu",
			success: function(msg)
			{
                            $('.main_cat_type').html($.trim(msg));
                            
                        }
                    });
                    
            $("#purcahse_rate").val('');   
            
            $("#baseunitselect").css('width','294px');              
           $("#inv_kitchen").css('width','294px');  
            
              
        }else if(type=='Finished'){
            
             $("#inv_star").show();
             $(".raw_hide_class").show();
             
             show_less();
               
            $(".reorder_hide_class").show();    
            $(".purchase_hide_class").hide();  
            $(".raw_hide_class_barcode").show(); 
            $("#show_more").show();
                
                
               $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check&type=finished",
			success: function(msg)
			{
                            $('.main_cat_type').html($.trim(msg));
                            
                        }
                    });  
                    
              $("#purcahse_rate").val('');       
                
               $("#baseunitselect").css('width','100%');              
           $("#inv_kitchen").css('width','100%');   
                
                
               
         }else if(type=='Raw'){ 
             
             $("#inv_star").hide();
             $(".raw_hide_class").hide();
             show_less();
           
             $(".reorder_hide_class").show();    
             $(".purchase_hide_class").show(); 
             $(".raw_hide_class_barcode").show(); 
            
             $("#show_more").hide();
             
              $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check&type=raw",
			success: function(msg)
			{
                            $('.main_cat_type').html($.trim(msg));
                            
                        }
                    });
                    
                    
                    
           $("#baseunitselect").css('width','100%');              
           $("#inv_kitchen").css('width','100%');                  
                    
            
        }
	
   });     
        
        
        

$(".change_permission_btn1").click(function(){
	
	
	  var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	$('#floorrate1').val(selval);
	viewcity();

    $(".change_permission_overlay").show();
	$(".change_permission_popup").show();
	
	
	
	
});

$(".change_permission_btn2").click(function(){
	
	
	  var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	$('#floorrate2').val(selval);
	viewcity();

    $(".change_permission_overlay").show();
	$(".change_permission_popup").show();
	
	
	
	
});

$(".change_permission_btn3").click(function(){
	
	
	  var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	$('#floorrate3').val(selval);
	viewcity();

    $(".change_permission_overlay").show();
	$(".change_permission_popup").show();
	
	
	
	
});



function validate_floorrate()
{
	if($("#floorrate").val()=="")
  {
	 
	  $("#floorrate_div").addClass("has-error");
	 
	  $("#floorrate").focus();
	  return false;
  }else
   {
	   
	   $("#floorrate_div").removeClass("has-error");
	   $("#floorrate_div").addClass("has-success");
	   return true;
   }
}




function validate_floorrate1()
{
    //alert($("#floorrate1").val());
	if($("#floorrate1").val()=="")
  {
	 
	  $("#floorrate_div1").addClass("has-error");
	 
	  $("#floorrate1").focus();
	  return false;
  }else
   {
	   $('.submitta').css("display","inline-block");
           $('.submitcs').css("display","none");
            $('.submitrm').css("display","none");
	   $("#floorrate_div1").removeClass("has-error");
	   //$("#floorrate_div1").addClass("has-success");
	   return true;
   }
}

function validate_floorrate2()
{
	if($("#floorrate2").val()=="")
  {
	 
	  $("#floorrate_div2").addClass("has-error");
	 
	  $("#floorrate2").focus();
	  return false;
  }else
   {
	   $('.submitta').css("display","none");
           $('.submitcs').css("display","inline-block");
            $('.submitrm').css("display","none");
	   $("#floorrate_div2").removeClass("has-error");
	   $("#floorrate_div2").addClass("has-success");
	   return true;
   }
}

function validate_floorrate3()
{
	if($("#floorrate3").val()=="")
  {
	 
	  $("#floorrate_div3").addClass("has-error");
	 
	  $("#floorrate3").focus();
	  return false;
  }else
   {
	   $('.submitta').css("display","none");
           $('.submitcs').css("display","none");
            $('.submitrm').css("display","inline-block");
	   $("#floorrate_div3").removeClass("has-error");
	   $("#floorrate_div3").addClass("has-success");
	   return true;
   }
}

function validate_ratez()
{
	if($("#nwrate").val()=="")
  {
	 
	  $(".newtxt").addClass("has-error");
	
	  $("#nwrate").focus();
	  return false;
  }else
   {
	   
	   $(".newtxt").removeClass("has-error");
	   $(".newtxt").addClass("has-success");
	   return true;
   }
}

   function validateDecimal()    {
	   
	   id=$("#nwrate").val();
	  
        var RE =/^\d*\.?\d*$/;
        if(RE.test(id)){
			//alert('asasa');
           return true;
        }else{
			//alert('fl');
			 $(".newtxt").addClass("has-error");
			
	  $("#nwrate").focus();
           return false;
        }
    }

function validate_type()
{
	var a=$("#nwtype").val();
	
	if($("#nwtype").val()=="null")
  {
	 
	  $(".nwtype").addClass("has-error");
	 
	  $("#nwtype").focus();
	  return false;
  }else
   {
	
	   $(".nwtype").removeClass("has-error");
	   $(".nwtype").addClass("has-success");
	   return true;
   }
}
function validate_module()
{
	var a=$("#module").val();
	
	if($("#module").val()=="null")
  {
	 
	  $("#module").addClass("has-error");
	 
	  $("#module").focus();
	  return false;
  }else
   {
	
	   $(".module").removeClass("has-error");
	   $(".module").addClass("has-success");
	   return true;
   }
}

function validate_mode()
{
	
     var type=$("#nwtype").val();   
        
        
        if(type=='%'){
            
	if($("#nwmode").val()=="null")
  {
	
	  $(".nwmode").addClass("has-error");
	
	  $("#nwmode").focus();
	  return false;
  }else
   {
	   
	   $(".nwmode").removeClass("has-error");
	   $(".nwmode").addClass("has-success");
	   return true;
   }
   
        }else{
            
            
           if($("#nwmode1").val()=="null")
  {
	
	  $(".nwmode1").addClass("has-error");
	
	  $("#nwmode1").focus();
	  return false;
  }else
   {
	   
	   $(".nwmode1").removeClass("has-error");
	   $(".nwmode1").addClass("has-success");
	   return true;
   }
   
        }
   
   
}

function validate_rates()
{
	if(validate_ratez())
	{
            
	if(validateDecimal())
	{
            
	if(validate_type())
	{
		if(validate_mode())
		{
                    
		if(validate_floorrate())
		{ 
                    
                if(validate_module())
                {
                                    
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
		$("#menu_btn").show();
		var rate=$("#nwrate").val();
		var type=$("#nwtype").val();
                
                var mode; 
               
           if(type=='%'){
		 mode=$("#nwmode").val();
            }else{
                mode=$("#nwmode1").val();
           }
                
		var floorrate=$("#floorrate").val();
		var catrate=$("#ratecategry").val();
                var module=$("#module").val();
                
                var partner_change=$('#partner_change').val();
                
                             //	       alert(rate);
                             //        alert(type);
                             //        alert(mode);
                             //        alert(floorrate);
                             //        alert(catrate);
                             //        alert(module);
    
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=addratechange&rate="+rate+"&type="+type+"&mode="+mode+"&floorrate="+floorrate+"&catrate="+catrate+'&module='+module+"&partner_change="+partner_change,
			success: function(msg)
			{
                           
				msg=msg.trim();
			
				if(msg !="")
				{
					$('.update_btn_menu').hide();
					var ratechng=$('#ratechange');
					ratechng.text('Rate Changed Successfully');
                                        
                                         $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Rate Changed Successfully');
                                         $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
                                         
					 $(".load_error").delay(2000).fadeOut('slow');
                                         
                                          setInterval(function () {
                                              
                                            location.reload();
        
                                          }, 1000); 
			        }
				
		}
		});
                
                } }
             
		}
		}
	}
		
	}
}


function validate_rates1()
{   
   // var confirm1=confirm("Are you sure  you want to copy rate ?");
    //if(confirm1===true){
    
    $("#menu_rate").hide();
    $("#takeaway_ratecopy").hide();
    $("#menu_btn").show();
    var from_floor='';
    var mode_from=$('#mode_sel1').val();
    if(mode_from=='DI'){
       from_floor=$("#floorrate1").val();
    }
    var takeaway1=$("#takeaway1").val();
    
    var online=$("#ta_to_ta").val();
    
    //alert(from_floor+','+takeaway1+','+mode_from+','+online);
    $.ajax({
        type: "POST",
        url: "load_divcheckmenu.php",
        data: "value=addtakeawayratechange&floorrate="+from_floor+"&takeaway1="+takeaway1+"&mode_from="+mode_from+"&online="+online,

        success: function(msg)
        {
            msg=msg.trim();
         
            if(msg !="")
            {
                $('.inherit_added_popup').css("display","block");
                $('.change_permission_overlay').css("display","block");
                var ratechng=$('.inherit_added_text');                 
                 ratechng.html(msg);
            }
        }
    });
    $(".change_permission_overlay").hide();
    $(".change_permission_popup").hide();
   // }
}
 
function validate_rates2()
{       
  //  var confirm1=confirm("Are you sure  you want to copy rate ?");
    //if(confirm1===true){
        $("#menu_rate").hide();
        $("#takeaway_ratecopy").hide();
        $("#menu_btn").show();
        var from_floor='';
        var mode_from=$('#mode_sel2').val();
        if(mode_from=='DI'){
           from_floor=$("#floorrate2").val();
        }
        var countersale1=$("#countersale1").val();
        
        var online=$("#cs_to_ta").val();
        $.ajax({
            type: "POST",
            url: "load_divcheckmenu.php",
            data: "value=addcountersaleratechange&floorrate2="+from_floor+"&countersale1="+countersale1+"&mode_from="+mode_from+"&online="+online,

            success: function(msg)
            {
                msg=msg.trim();
                //alert(msg);
                if(msg !="")
                {
                    $('.inherit_added_popup').css("display","block");
                    $('.change_permission_overlay').css("display","block");
                    var ratechng=$('.inherit_added_text');                 
                     ratechng.html(msg);
                }
            }
        });
        $(".change_permission_overlay").hide();
        $(".change_permission_popup").hide(); 
    //}
}
function validate_rates3()
{       
    //var confirm1=confirm("Are you sure  you want to copy rate ?");
   // if(confirm1===true){    
        $("#menu_rate").hide();
        $("#takeaway_ratecopy").hide();
        $("#menu_btn").show();
        var from_floor='';
        var mode_from=$('#mode_sel3').val();
        from_floor=$("#floorrate3").val();
        
        var dinein1=$("#dinein1").val();
        var online=$("#di_to_ta").val();
        $.ajax({
            type: "POST",
            url: "load_divcheckmenu.php",
            data: "value=adddineinratechange&floorrate3="+from_floor+"&dinein1="+dinein1+"&mode_from="+mode_from+"&online="+online,

            success: function(msg)
            {
                msg=msg.trim();
                //alert(msg);
                if(msg !="")
                {
                    $('.inherit_added_popup').css("display","block");
                    $('.change_permission_overlay').css("display","block");
                    var ratechng=$('.inherit_added_text');                 
                    ratechng.html(msg);
                }
            }
        });
        $(".change_permission_overlay").hide();
        $(".change_permission_popup").hide();

   // }
 }                
                
 //////////////////////////////////////Extratax Start//////////////////////////////////////////////////////////////
 
 function validate_categoryname()
{
	if($("#categoryname1").val()=="")
  {
	 
	  $("#categoryname_div1").addClass("has-error");
	  $("#categoryname1").focus();
	  return false;
  }else
   {
	   $('.submitcat').css("display","inline-block");
           $('.submitsubcat').css("display","none");
            $('.submitdiet').css("display","none");
	   $("#categoryname_div1").removeClass("has-error");
	   $("#categoryname_div1").addClass("has-success");
	   return true;
   }
   if($("#categorytax1").val()=="")
  {
	 
	  $("#categorytax_div1").addClass("has-error");
	  $("#categorytax1").focus();
	  return false;
  }else
   {
	   $('.submitcat').css("display","inline-block");
           $('.submitsubcat').css("display","none");
            $('.submitdiet').css("display","none");
	   $("#categorytax_div1").removeClass("has-error");
	   $("#categorytax_div1").addClass("has-success");
	   return true;
   }
}


 function validate_cattax()
{

			if(validate_categoryname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
		//$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var categorytax1=$("#categorytax1").val();//id tax
                 // alert(categorytax1);
                var categoryname1=$("#categoryname1").val();//id catname
                 // alert(categoryname1);
                var maincattaxname1=$("#maincattaxname1").val();
               //alert(maincattaxname1);

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=addcattax&categorytax1="+categorytax1+"&maincattaxname1="+maincattaxname1+"&categoryname1="+categoryname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                 
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
                                 
//					$('.update_btn_menu').hide();
//					var ratechng=$('#ratechange');
//                                        ratechng.html(msg);
//					 $(".load_error").delay(2000).fadeOut('slow');
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	         $(".change_permission_popup").hide();
			}
                       
                   }
                   
    
    
    
    
    
    
   function validate_subcategoryname()
{
	if($("#subcategoryname1").val()=="")
  {
	 
	 $("#subcategoryname_div1").addClass("has-error");
	  $("#subcategoryname1").focus();
	  return false;
 }else
   {
	   $('.submitcat').css("display","none");
           $('.submitsubcat').css("display","inline-block");
            $('.submitdiet').css("display","none");
	   $("#subcategoryname_div1").removeClass("has-error");
	   $("#subcategoryname_div1").addClass("has-success");
	   return true;
   }
   
      if($("#subcategorytax1").val()=="")
  {
	 
	  $("#subcategorytax_div1").addClass("has-error");
	  $("#subcategorytax1").focus();
	  return false;
  }else
   {
	   $('.submitcat').css("display","none");
           $('.submitsubcat').css("display","inline-block");
            $('.submitdiet').css("display","none");
	   $("#subcategorytax_div1").removeClass("has-error");
	   $("#subcategorytax_div1").addClass("has-success");
	   return true;
   }
   
} 
    
       
       
       
       
    function validate_subcattax()
{

			if(validate_subcategoryname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
//		$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var subcategorytax1=$("#subcategorytax1").val();//id tax
                 // alert(subcategorytax1);
                var subcategoryname1=$("#subcategoryname1").val();//id subcatname
                //  alert(subcategoryname1);
                var subcattaxname1=$("#subcattaxname1").val();
                

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=addsubcattax&subcategorytax1="+subcategorytax1+"&subcategoryname1="+subcategoryname1+"&subcattaxname1="+subcattaxname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                    
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
                                 
//					$('.update_btn_menu').hide();
//					var ratechng=$('#ratechange');
//                                        ratechng.html(msg);
//					 $(".load_error").delay(2000).fadeOut('slow');
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	$(".change_permission_popup").hide();
			}
                       
                   }                
                   
      
      
      
    function validate_dietname()
{
	if($("#dietname1").val()=="")
  {
	 
	  $("#dietname_div1").addClass("has-error");
	  $("#dietname1").focus();
	  return false;
  }else
   {
	   $('.submitcat').css("display","none");
           $('.submitsubcat').css("display","none");
            $('.submitdiet').css("display","inline-block");
	   $("#dietname_div1").removeClass("has-error");
	   $("#dietname_div1").addClass("has-success");
	   return true;
   }
   if($("#diettax1").val()=="")
  {
	 
	  $("#diettax_div1").addClass("has-error");
	  $("#diettax1").focus();
	  return false;
  }else
   {
	   $('.submitcat').css("display","none");
           $('.submitsubcat').css("display","none");
            $('.submitdiet').css("display","inline-block");
	   $("#diettax_div1").removeClass("has-error");
	   $("#diettax_div1").addClass("has-success");
	   return true;
   }
}    
      
      
      
      
      
      
           
       function validate_diettax()
{

			if(validate_dietname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
//		$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var diettax1=$("#diettax1").val();//id tax
                  //alert(diettax1);
                var dietname1=$("#dietname1").val();//id dietname
                  //alert(dietname1);
                var diettaxname1=$("#diettaxname1").val();
               // alert(diettaxname1);

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=adddiettax&diettax1="+diettax1+"&dietname1="+dietname1+"&diettaxname1="+diettaxname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                    
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
                                 
//					$('.update_btn_menu').hide();
//					var ratechng=$('#ratechange');
//                                        ratechng.html(msg);
//					 $(".load_error").delay(2000).fadeOut('slow');
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	$(".change_permission_popup").hide();
			}
                       
                   }          
                   
                       
 //////////////////////////////////////////////////extra tax end/////////////////////////////////////////////////////
                
                
                
      function valishortcode()
      {
        if($("#item_shortcode").val()!="")
  {    
	var op=$("#item_shortcode").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checshortcode&mid1="+op,
			success: function(data)
			{
			data=$.trim(data);
			if(data =="sorry")
			{
	
                  $("#item_shortcode_div").addClass("has-error");	        
                  $("#item_shortcode").focus();
                alert('Item Code Already exists');
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#item_shortcode_div").removeClass("has-error");
	   $("#item_shortcode_div").addClass("has-success");

			}
			}
		}); 

  }
}             



function validateSearch()
{
  
  var mname=$("#mname").val();
  if(mname=="")
  {
	  mname="null";     
  } 
  
  var mcate=$("#mcate").val();
  if(mcate=="")
  {
	  mcate="null";
          
  }

   var msubc=$("#msubc").val();
  if(msubc=="")
  {
	  msubc="null";
          
  }
   var mdiet=$("#mdiet").val();
  if(mdiet=="")
  {
	  mdiet="null";
          
  }
   var mstatus=$("#mstatus").val();
  if(mstatus=="")
  {
	  mstatus="null";
          
  }
  
    var kitchen=$("#kitchen").val();
  if(kitchen=="")
  {
	  kitchen="null";
          
  } 
  
   var image_see=$("#image_see").val();
  if(image_see=="")
  {
	  image_see="null";
          
  } 
  
  var excempt_sr=$("#excempt_sr").val();
  if(excempt_sr=="")
  {
	  excempt_sr="null";
          
  } 
  
  var m_ref_cnt=$("#m_ref_cnt").val();
  if(m_ref_cnt=="")
  {
	  m_ref_cnt="null";
          
  } 
  
  
  
        localStorage.menuname=mname;
        localStorage.catname=mcate;
        localStorage.subcatname=msubc;
        localStorage.diet=mdiet; 
        localStorage.stat=mstatus;
        localStorage.kitch=kitchen;
        localStorage.image_see=image_see;
        localStorage.excempt_sr=excempt_sr;
        localStorage.m_ref_cnt= m_ref_cnt;
        
       
        $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                  //location.hash='#ids_'+localStorage.editid; 
           });                                   
}
</script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<script type="text/javascript">
	
		$(".update_btn_menu").click( function(){

			/*if($(".update_btn_menu").hasClass("updat_btn_2"))
			{
				$("#menu_btn").show();
				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");			
				$("#menu_rate").hide();
			$(".update_btn_menu").removeClass("updat_btn_2")
			}else
			{*/
				$("#menu_btn").show();
				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
				$("#floorrate1").val("All");

				$("#menu_rate").hide();
				$("#takeaway_ratecopy").hide();
				$('.update_btn_menu').hide();
				//$(".update_btn_menu").addClass("updat_btn_2")
			/*}*/

		});
		//$(".updat_btn_2").click( function(){
		//			$("#menu_btn").css('display','');
		//			});
		$(".search_btn_member_invoice").click( function(){
		//	$("#menu_btn").show();
			//$("#menu_rate").hide();
		});
	</script>	
    
<script>

//$("#nwrate").focus();

$(document).ready(function(){

    
     $( "#ds_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
             $( "#ds_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
    
           
                 $(".baseunit_select").prop("disabled", true);
                     $(".unittype_selection").prop("disabled", true);
                     $(".unittype_selection").val("");
                        
    
		$('#takeawaybutton1').on('change',function(){
			if ($('#takeawaybutton1').attr("checked", "checked")){
                            $("#mode_sel1").prop("disabled",false);
                            $("#mode_sel2").prop("disabled",true);
                            $("#mode_sel3").prop("disabled",true);
                            
                            
                            $("#cs_to_ta").prop("disabled",true);
                            $("#di_to_ta").prop("disabled",true);
                             $("#ta_to_ta").prop("disabled",false);
                            
                            
                            $("#mode_sel1").val("DI");
                            $("#mode_sel2").val("DI");
                            $("#mode_sel3").val("CS");
                            
                            $("#mode_sel1_div").addClass("has-success");
                            $("#mode_sel2_div").removeClass("has-success");
                            $("#mode_sel3_div").removeClass("has-success");
                            
                            $("#floorrate_div1").removeClass("has-success");
                            $("#floorrate_div2").removeClass("has-success");
                            $("#floorrate_div3").removeClass("has-success");
                            
                            $("#floorrate_div1").removeClass('disabled_floor_cl');
                            $("#floorrate_div2").addClass('disabled_floor_cl');
                            $("#floorrate_div3").addClass('disabled_floor_cl');
			}
		});
		$('#countersalebutton1').on('change',function(){
			if ($('#countersalebutton1').attr("checked", "checked")){
                            $("#mode_sel1").prop("disabled",true);
                            $("#mode_sel2").prop("disabled",false);
                            $("#mode_sel3").prop("disabled",true);
                            
                            $("#cs_to_ta").prop("disabled",true);
                            $("#di_to_ta").prop("disabled",true);
                             $("#ta_to_ta").prop("disabled",true);
                            
                            
                            
                            
                            $("#mode_sel1").val("DI");
                            $("#mode_sel2").val("DI");
                            $("#mode_sel3").val("CS");
                            
                            $("#mode_sel2_div").addClass("has-success");
                            $("#mode_sel1_div").removeClass("has-success");
                            $("#mode_sel3_div").removeClass("has-success");
                            
                            $("#floorrate_div1").removeClass("has-success");
                            $("#floorrate_div2").removeClass("has-success");
                            $("#floorrate_div3").removeClass("has-success");
                            
                            $("#floorrate_div1").addClass('disabled_floor_cl');
                            $("#floorrate_div2").removeClass('disabled_floor_cl');
                            $("#floorrate_div3").addClass('disabled_floor_cl');
			} 
		});
		$('#dineinbutton1').on('change',function(){
			if ($('#dineinbutton1').attr("checked", "checked")){
                            $("#mode_sel1").prop("disabled",true);
                            $("#mode_sel2").prop("disabled",true);
                            $("#mode_sel3").prop("disabled",false);
                            
                            $("#mode_sel1").val("DI");
                            $("#mode_sel2").val("DI");
                            $("#mode_sel3").val("CS");
                            
                            
                            $("#cs_to_ta").prop("disabled",true);
                            $("#di_to_ta").prop("disabled",true);
                             $("#ta_to_ta").prop("disabled",true);
                            
                            $("#mode_sel3_div").addClass("has-success");
                            $("#mode_sel1_div").removeClass("has-success");
                            $("#mode_sel2_div").removeClass("has-success");
                            
                            $("#floorrate_div1").removeClass("has-success");
                            $("#floorrate_div2").removeClass("has-success");
                            $("#floorrate_div3").removeClass("has-success");
                            
                            $("#floorrate_div1").addClass('disabled_floor_cl');
                            $("#floorrate_div2").addClass('disabled_floor_cl');
                            $("#floorrate_div3").removeClass('disabled_floor_cl');
			} 
		});
                
              $('#menucategory1').on('change',function(){
			if ($('#menucategory1').attr("checked", "checked")){
			$("#categoryname_div1").removeClass('disabled_floor_cl');
                        $("#categorytax_div1").removeClass('disabled_floor_cl');
			$("#subcategoryname_div1").addClass('disabled_floor_cl');
			$("#subcategorytax_div1").addClass('disabled_floor_cl');
                        $("#dietname_div1").addClass('disabled_floor_cl');
			$("#diettax_div1").addClass('disabled_floor_cl');
			} else {
				$("#categoryname_div1").addClass('disabled_floor_cl');
                                $("#categorytax_div1").addClass('disabled_floor_cl');
			}
		});  
                $('#subcategory1').on('change',function(){
			if ($('#subcategory1').attr("checked", "checked")){
			$("#categoryname_div1").addClass('disabled_floor_cl');
                        $("#categorytax_div1").addClass('disabled_floor_cl');
			$("#subcategoryname_div1").removeClass('disabled_floor_cl');
                        $("#subcategorytax_div1").removeClass('disabled_floor_cl');
			$("#dietname_div1").addClass('disabled_floor_cl');
                        $("#diettax_div1").addClass('disabled_floor_cl');
			} else {
				$("#subcategoryname_div1").addClass('disabled_floor_cl');
                                $("#subcategorytax_div1").addClass('disabled_floor_cl');
			}
		});
                
                $('#diet1').on('change',function(){
			if ($('#diet1').attr("checked", "checked")){
			$("#categoryname_div1").addClass('disabled_floor_cl');
                        $("#categorytax_div1").addClass('disabled_floor_cl');
			$("#subcategoryname_div1").addClass('disabled_floor_cl');
                        $("#subcategorytax_div1").addClass('disabled_floor_cl');
			$("#dietname_div1").removeClass('disabled_floor_cl');
                        $("#diettax_div1").removeClass('disabled_floor_cl');
			} else {
				$("#dietname_div1").addClass('disabled_floor_cl');
                                $("#diettax_div1").addClass('disabled_floor_cl');
			}
		});
           
	});
        $('#mode_sel1').change(function(){
            $("#mode_sel1_div").removeClass("has-success");
            
            if($('#mode_sel1').val()=='CS'){
               
                $("#floorrate_div1").addClass('disabled_floor_cl');
                $("#floorrate_div1").removeClass("has-success");
            }
            else if($('#mode_sel1').val()=='DI'){
                $("#floorrate_div1").removeClass('disabled_floor_cl');
                $("#floorrate_div1").addClass("has-success");
            }
        });
        $('#mode_sel2').change(function(){
            $("#mode_sel2_div").removeClass("has-success");
          if($('#mode_sel2').val()=='TA'){
                $("#floorrate_div2").addClass('disabled_floor_cl');
                 $("#floorrate_div2").removeClass("has-success");
                  $("#cs_to_ta").prop("disabled", false);
            }
            else if($('#mode_sel2').val()=='DI'){
                $("#mode_sel2_div").removeClass("has-success");
               $("#floorrate_div2").removeClass('disabled_floor_cl');
                 $("#floorrate_div2").addClass("has-success");
                 $("#cs_to_ta").prop("disabled", true);
            }
        });
        $('#mode_sel3').change(function(){
            
             if($('#mode_sel3').val()=='TA'){
           
             $("#di_to_ta").prop("disabled", false);
         }else{
             $("#di_to_ta").prop("disabled", true);
         }
             
             
        });
        
        function portionunit_selection(a)
        {
            //alert(a);
            if(a=='Unit')
            {
            $(".baseunit_select").prop("disabled", false);
            $(".unittype_selection").prop("disabled", false);
            
            $('#sale_rate_all').val('');
             $('#sale_rate_all').hide();
            
            }
            else if(a=='Portion')
            {
            $(".baseunit_select").prop("disabled", true);
            $(".unittype_selection").prop("disabled", true);
            
            $('#sale_rate_all').val('');
             $('#sale_rate_all').show();
            
            }

        }
        
        function unit_type_selection(unit_type){
            
            if(unit_type=='Loose'){
                $("#stockinnumbrs").attr("disabled",true);
            }
            else{
                $("#stockinnumbrs").attr("disabled",false);
            }
        }
        
        
        function discount_icon(m,n){
         
            
            var data="set_discount_list=discount_list&discount_name="+n+"&discount_id="+m;
         
        $.ajax({
        type: "POST",
        url: "menu_discount.php",
        data: data,
        success: function(data)
        {
            
            $('#load_discount_add').html(data);    
        }
    });
            
        }
	
        function validate_removetax(){
    
    
    
    if ($("#menucategory1").prop("checked")) {
  var menucat='Y';
}else{
     menucat='N';
}
    
     if ($("#subcategory1").prop("checked")) {
  var subcat='Y';
}else{
     subcat='N';
}  
    
       if ($("#diet1").prop("checked")) {
  var dietcat='Y';
}else{
    dietcat='N';
}  
    
    
    if(menucat=='Y'){
       if(validate_categoryname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
		//$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var categorytax1=$("#categorytax1").val();//id tax
                 // alert(categorytax1);
                var categoryname1=$("#categoryname1").val();//id catname
                 // alert(categoryname1);
                var maincattaxname1=$("#maincattaxname1").val();
                //alert(maincattaxname1);

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=removecattax&categorytax1="+categorytax1+"&maincattaxname1="+maincattaxname1+"&categoryname1="+categoryname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                 
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
                                 
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	         $(".change_permission_popup").hide();
			} 
    }
   
    if(subcat=='Y'){
        if(validate_subcategoryname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
//		$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var subcategorytax1=$("#subcategorytax1").val();//id tax
                 // alert(subcategorytax1);
                var subcategoryname1=$("#subcategoryname1").val();//id subcatname
                //  alert(subcategoryname1);
                var subcattaxname1=$("#subcattaxname1").val();
                //alert(maincattaxname1);

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=removesubcattax&subcategorytax1="+subcategorytax1+"&subcategoryname1="+subcategoryname1+"&subcattaxname1="+subcattaxname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                    
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	$(".change_permission_popup").hide();
			}
    }
    
    
    if(dietcat=='Y'){
        if(validate_dietname())
			{
                         
		$("#menu_rate").hide();
		$("#takeaway_ratecopy").hide();
//		$(".olddiv").romoveClass("new_overlay");
		$("#menu_btn").show();
		var diettax1=$("#diettax1").val();//id tax
                  //alert(diettax1);
                var dietname1=$("#dietname1").val();//id dietname
                  //alert(dietname1);
                var diettaxname1=$("#diettaxname1").val();
               // alert(diettaxname1);

				 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: "value=removediettax&diettax1="+diettax1+"&dietname1="+dietname1+"&diettaxname1="+diettaxname1,
			
                        success: function(msg)
			{
				msg=msg.trim();
		                //alert(msg);
				if(msg !="")
				{
                                    
                              $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
			
                                 
//					$('.update_btn_menu').hide();
//					var ratechng=$('#ratechange');
//                                        ratechng.html(msg);
//					 $(".load_error").delay(2000).fadeOut('slow');
						
				}
				
		   }
		});
                 $(".change_permission_overlay").hide();
	$(".change_permission_popup").hide();
			}
    }
    
    
}	
	
	$(".add_discount").click( function(){
		//$(".categ_discount_popup_cc").show();
	});
	$(".categ_discount_cls").click( function(){
		$(".categ_discount_popup_cc").hide();
	});
        
        function change_cat(cat){
        if(cat=='main'){
            
            $('#main_cat_div').show();
             $('#null_div').hide(); 
            
        }else{
            $('#main_cat_div').hide();  
        }
        if(cat=='sub'){
             $('#sub_cat_div').show();
              $('#null_div').hide(); 
         }else{
             $('#sub_cat_div').hide(); 
         }
     if(cat==""){
            $('#main_cat_div').hide();
             $('#sub_cat_div').hide ();
              $('#null_div').show(); 
        }
        
     }
     
     
        function datechange(){
 
       if(document.getElementById('d_limit').checked) {
            $('#from_div').show();
            $('#to_div').show ();
       }else{
       $('#from_div').hide();
       $('#to_div').hide ();
       }
  } 
  
        function timechange(){
      if(document.getElementById('t_limit').checked) {
            $('#from_time_div').show();
            $('#to_time_div').show ();
       }else{
       $('#from_time_div').hide();
       $('#to_time_div').hide ();
        }
  }  
  
        function daychange(){
            if(document.getElementById('day_limit').checked) {
                $('#day_div').show();
           
       }else{
       $('#day_div').hide();
      
         }
  }
        function submit_all(){
     
      if(document.getElementById('di1').checked) {
          var dine="Y";
      } else{
          dine="N";
      }
       
        if(document.getElementById('ta1').checked) {
          var ta="Y";
      } else{
          ta="N";
      }
      
       if(document.getElementById('cs1').checked) {
          var cs="Y";
      } else{
         cs="N"; 
      }
      
       if(document.getElementById('d_limit').checked) {
          var date="Y";
      } else{
          date="N";
      }
      
       if(document.getElementById('t_limit').checked) {
          var time="Y";
      } else{
          time="N";
      }
      
       if(document.getElementById('day_limit').checked) {
          var day="Y";
      } else{
          day="N";
      }
      
       
     var type=$('#category_type_ds').val();
     var maincat=$('#maincat_ds').val();
     var subcat=$('#subcat_ds').val();
     var status=$('#status_dis').val();
      var discountid=$('#discount_ds').val();
       
       
        var fromdate=$('#from_date').val();
        var todate=$('#to_date').val();
         var fromtime=$('#display_timeto').html();
          var totime=$('#display_timefrom').html();
         var day_in=$('#day').val();
       
     if(type!=""){
     if(type=='main'){
        
           var data="value=maincat_discount&maincat="+maincat+
                   "&subcat="+subcat+"&status="+status+"&discountid="+discountid+"&fromdate="+fromdate+"&todate="+todate+
                   "&fromtime="+fromtime+"&totime="+totime+"&day_in="+day_in+"&dine="+dine+"&ta="+ta+"&cs="+cs+"&date="+date+
                   "&time="+time+"&day="+day+"&mode=MC";
          
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: data,
			success: function(msg)
			{
				msg=msg.trim();
                                //alert(msg);
		                 if(msg !="")
				{
                                $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
				}
			}
		});
                 
    }
   
    
    
   
     if(type=='sub'){
         
          
         var data="value=subcat_discount&maincat="+maincat+
                   "&subcat="+subcat+"&status="+status+"&discountid="+discountid+"&fromdate="+fromdate+"&todate="+todate+
                   "&fromtime="+fromtime+"&totime="+totime+"&day_in="+day_in+"&dine="+dine+"&ta="+ta+"&cs="+cs+"&date="+date+
                   "&time="+time+"&day="+day+"&mode=SC";
          
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: data,
			success: function(msg)
			{
				msg=msg.trim();
                               // alert(data);
		                 if(msg !="")
				{
                                $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
				}
			}
		});
     }
 }
 else{
     alert('Select Type');
 }
  }
  
        function remove_all(){
      
      
      if(document.getElementById('di1').checked) {
          var dine="Y";
      } else{
          dine="N";
      }
       
        if(document.getElementById('ta1').checked) {
          var ta="Y";
      } else{
          ta="N";
      }
      
       if(document.getElementById('cs1').checked) {
          var cs="Y";
      } else{
         cs="N"; 
      }
      
       if(document.getElementById('d_limit').checked) {
          var date="Y";
      } else{
          date="N";
      }
      
       if(document.getElementById('t_limit').checked) {
          var time="Y";
      } else{
          time="N";
      }
      
       if(document.getElementById('day_limit').checked) {
          var day="Y";
      } else{
          day="N";
      }
      
       
     var type=$('#category_type_ds').val();
     var maincat=$('#maincat_ds').val();
     var subcat=$('#subcat_ds').val();
     var status=$('#status_dis').val();
      var discountid=$('#discount_ds').val();
       
       
        var fromdate=$('#from_date').val();
        var todate=$('#to_date').val();
         var fromtime=$('#display_timeto').html();
          var totime=$('#display_timefrom').html();
         var day_in=$('#day').val();
        
     if(type!=""){
     if(type=='main'){
           var data="value=remove_maincat_discount&maincat="+maincat+
                   "&subcat="+subcat+"&status="+status+"&discountid="+discountid+"&fromdate="+fromdate+"&todate="+todate+
                   "&fromtime="+fromtime+"&totime="+totime+"&day_in="+day_in+"&dine="+dine+"&ta="+ta+"&cs="+cs+"&date="+date+
                   "&time="+time+"&day="+day+"&mode=MC";
           
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: data,
			success: function(msg)
			{
				msg=msg.trim();
		                 if(msg !="")
				{
                                $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
				}
			}
		});
    }
     
     if(type=='sub'){
         var data="value=remove_subcat_discount&maincat="+maincat+
                   "&subcat="+subcat+"&status="+status+"&discountid="+discountid+"&fromdate="+fromdate+"&todate="+todate+
                   "&fromtime="+fromtime+"&totime="+totime+"&day_in="+day_in+"&dine="+dine+"&ta="+ta+"&cs="+cs+"&date="+date+
                   "&time="+time+"&day="+day+"&mode=SC";
          
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
                        data: data,
			success: function(msg)
			{
				msg=msg.trim();
		                 if(msg !="")
				{
                                $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              var ratechng=$('.inherit_added_text');                 
                               ratechng.html(msg);
			 
				}
			}
		});
     }
      
  }else{
      alert('Select Type');
  }
  }
  
        function fromtime(time) {

  //console.log(time);
  //alert(time.value);
  if (time.value !== "") {
    var hours = time.split(":")[0];
    var minutes = time.split(":")[1];
    var suffix = hours >= 12 ? "pm" : "am";
    hours = hours % 12 || 12;
    hours = hours < 10 ? "0" + hours : hours;

    var displayTime = hours + ":" + minutes + " " + suffix;
    document.getElementById("display_timefrom").innerHTML = displayTime;
    
  }
     }
     
        function totime(time1) {

  if (time1.value !== "") {
    var hours = time1.split(":")[0];
    var minutes = time1.split(":")[1];
    var suffix = hours >= 12 ? "pm" : "am";
    hours = hours % 12 || 12;
    hours = hours < 10 ? "0" + hours : hours;

    var displayTime = hours + ":" + minutes + " " + suffix;
    document.getElementById("display_timeto").innerHTML = displayTime;
  }               
   }
   
   
   function menu_enter(){
       
       var menuname_copy=$('#menuname').val();
      
      var menu=menuname_copy.substr(0, 17);
       $('#shortcode').val(menu);
       
   }
   
   
   
 function clear_search(){
      
  var mname='';
  if(mname=="")
  {
	  mname="null";
          
  } 
  
  var mcate='';
  if(mcate=="")
  {
	  mcate="null";
          
  }

   var msubc='';
  if(msubc=="")
  {
	  msubc="null";
          
  }
   var mdiet='';
  if(mdiet=="")
  {
	  mdiet="null";
          
  }
   var mstatus='';
  if(mstatus=="")
  {
	  mstatus="null";
          
  }
   var kitchen='';
  if(kitchen=="")
  {
	  kitchen="null";
          
  }
  
  
  
   var image_see='';
  if(image_see=="")
  {
	  image_see="null";
          
  } 
  
  var excempt_sr='';
  if(excempt_sr=="")
  {
	  excempt_sr="null";
          
  } 
  
   var m_ref_cnt='';
  if(m_ref_cnt=="")
  {
	m_ref_cnt="";
          
  } 
  
  
  
  
  
        localStorage.menuname=mname;
        localStorage.catname=mcate;
        localStorage.subcatname=msubc;
        localStorage.diet=mdiet; 
        localStorage.stat=mstatus;
        localStorage.kitch=kitchen;
        localStorage.image_see=image_see;
         localStorage.excempt_sr=excempt_sr;
         localStorage.m_ref_cnt=m_ref_cnt;
         
                           $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                  //location.hash='#ids_'+localStorage.editid; 
                            });
       
       
       
       
     
      $("#mstatus").val('null');
      $("#mdiet").val('all');
      $("#msubc").val('null');
      $("#mcate").val('null');
      $("#mname").val('');
      $("#kitchen").val('null');
      $("#image_see").val('null');
      $("#excempt_sr").val('');
      $("#m_ref_cnt").val('');
      
      validateSearch();
      
      
   }
   
   
 function ing_view(id,name,store,rt,inv){ 
   
       $("#ing_menu_name").html(name+' ['+inv+']');
      
       $("#ing_menu_name").attr('ing_menuid',id);
       
        $("#ing_menu_name").attr('ing_store_id',store);
      
       $(".ingredient_popup_cc").show();
       
       if(rt=='Portion'){
           
          $("#portion_ing").show(); 
           
       }else{
           
           $("#portion_ing").hide();
           
       }
       
       
       var datastring="value=load_ing_data&menu_id_ing="+id;
     
        $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 { 
               
               
                 var datastring = "menuid_main="+id+"&value=check_food_cost"
                 $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 { 
                       
                       var det=$.trim(data).split('*');
                      
                       
                     var di_tot=det[1];  
                      var ta_tot=det[2];  
                       var hd_tot=det[3];  
                        var cs_tot=det[4];  
                        $('#difc').text(di_tot);  $('#tafc').text(ta_tot);  $('#hdfc').text(hd_tot);  $('#csfc').text(cs_tot);
                 }
                 }); 
               
               
              var a=JSON.parse(data);
                   
              var decimal=$('#decimal').val();
                        
              $('#item_ing').val('');
              $('#rate_ing').val('');
              $('#tot_ing').val(''); 
              $('#qty_ing').val(''); 
              $('#type_ing').val(''); 
                    
                     var s=1;
                     $.each(a, function(i, record) {
                        
                      var sl=s++;  
                      
                     $("#second_div_main"+record.tmi_id).empty();
                     $("#second_div_main"+record.tmi_id).hide();
                        
                   
                  if(record.tmi_di=='Y'){
                      var checked_di='checked';
                      
                  }else{
                      var checked_di='';
                  }
                  
                  if(record.tmi_ta=='Y'){
                      var checked_ta='checked';
                      
                  }else{
                      var checked_ta='';
                  }
                  
                  if(record.tmi_hd=='Y'){
                      var checked_hd='checked';
                      
                  }else{
                      var checked_hd='';
                  }
                
                if(record.tmi_cs=='Y'){
                      var checked_cs='checked';
                      
                  }else{
                      var checked_cs='';
                  }
                  
                  
                  $('#yield').val(record.tmi_yield);
                  
              if($('.append_div_main').find('#del_card' + record.tmi_id).length === 0) {
                  
              $(".append_div_main").append("<div class='ingredient_popup_contant_row' id='second_div_main"+record.tmi_id+"'>"+
                     
                      "<div style='width:12%' class='ingredient_item_name'><input readonly value='" + record.tmi_ing_name + "'   id='item_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_qty'><input readonly value='" + record.tmi_portion + "'   class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_qty'><input readonly value='" + record.tmi_ing_unit + "'   id='type_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_portion'><input readonly value='" + record.tmi_rate_type + "'   id='rate_type_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:6%' class='ingredient_item_rate'><input readonly value='" + record.tmi_weight + "' maxlength='5' id='weight_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                      "<div style='width:8%' class='ingredient_item_rate'><input value='" + record.tmi_ing_qty + "' readonly  id='qty_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_ing_rate + "' readonly  id='rate_ing"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                        "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_wastage_qty + "' readonly  id='waste_qty"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                         "<div style='width:10%' class='ingredient_item_rate'><input value='" + record.tmi_wastage_rate + "' readonly  id='waste_rate"+record.tmi_id+"' class='ingredient_item_txtbox' type='text'></div>"+
                       "<div style='width:2%' class='ingredient_item_rate'><input   id='di_ing"+record.tmd_id+"'  "+checked_di +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                        "<div style='width:2%' class='ingredient_item_rate'><input   id='ta_ing"+record.tmd_id+"' "+checked_ta +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                    "<div style='width:2%' class='ingredient_item_rate'><input   id='hd_ing"+record.tmd_id+"' "+checked_hd +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                 "<div style='width:2%' class='ingredient_item_rate'><input   id='cs_ing"+record.tmd_id+"' "+checked_cs +" class='ingredient_item_txtbox' disabled type='checkbox'></div>"+
                "<div style='margin-top:0px;width: 5%;height: 30px;line-height: 26px;margin-top: 2px;float: left'  id='del_card"+record.tmd_id+"' name='del_card"+record.tmi_id+"' class='menut_add_bq_btn' onclick='return deletecard("+record.tmi_id+","+record.tmi_menuid+");'><img width='20px' src='img/cancel-icon.png'></div>"+
                       "</div>"
                        
            );
                                 
                  }
                         
                     });
                     
                     
                     }
                     });
       
       
 }  
   
   function barcode_view(id,name){
      $(".barcode_popup_cc_new").show();
       $("#bar_name_new").html(name);
      
       $("#bar_name_new").attr('bar_menuid',id);
     $("#bar_count").val('1');
  } 
 
 function barcode_print(){
      
      var mid= $("#bar_name_new").attr('bar_menuid');
      var count= $("#bar_count").val();
      
      var bar_packing=$("#bar_packing").val();
      
       var bar_expiry=$("#bar_expiry").val();
      
      if(count>0){
      
      window.location.href='barcode.php?menuid='+mid+'&count='+count+"&bar_packing="+bar_packing+"&bar_expiry="+bar_expiry;
     
        }else{
            
             $(".alert_error_popup_all_in_one_menu").show();
             $(".alert_error_popup_all_in_one_menu").text('ENTER VALID ROW COUNT');
             $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
            
        }
 } 
 
 
 
   function barcode_close(){ 
      $(".barcode_popup_cc_new").hide();
     $("#bar_count").val('1');
     $("#bar_packing").val('');
     $("#bar_expiry").val('');
    }
 
 
 function lock_click(type){
     
    $('#add_stock_pop').show();
      $('#code_change').val('');
    $('#code_change').focus();
    
     $('#add_stock_pop').attr('mode',type);
    
 }
 
 function go_lock(){
     
   if($('#code_change').val()=='555555'){
    
   var mode=  $('#add_stock_pop').attr('mode');
   
  
    if(mode=='item_disc'){
        $(".categ_discount_popup_cc").show(); 
    }
   
   
   if(mode=='rate_change'){
       
                                 $("#menu_btn").hide();
				$("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                 $("#ratecategry").val("All");
				$("#menu_rate").show();
				$(".update_btn_menu").show();
			
				$('#takeaway_ratecopy').hide();
            }
   
             if(mode=='rate_copy'){
                                $("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                $("#menu_rate").hide();
				$('#takeaway_ratecopy').show();
				$(".olddiv").addClass("new_overlay");
                                
                      $("input[name='RadioGroup1'][value='takeaway']").prop("checked", true);

            }
            
          if(mode=='item_tax'){
                                $("#nwrate").val("");
				$("#nwmode").val("null");
				$("#nwtype").val("null");
				$("#floorrate").val("All");
                                $("#menu_rate").hide();
				$('#addextratax').show();
				$(".olddiv").addClass("new_overlay");
            }
            
      $('#add_stock_pop').hide();
      $('#code_change').val('');
      
      
      
  }else{
        $(".alert_error_popup_all_in_one_menu").show();
             $(".alert_error_popup_all_in_one_menu").text('ENTER VALID CODE');
             $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
      $('#code_change').val('');
      $('#code_change').focus();
  }
   
 }
 
 $(".close_ingredient_popup1").click(function(){
     location.reload();
    });
 
 
    $(".close_ingredient_popup").click(function(){
     
              
              
          var menu= $("#ing_menu_name").attr('ing_menuid');
       
       var store= $("#ing_menu_name").attr('ing_store_id');
      
       var yield= $("#yield").val();
       
       if(yield>0){
       
       var datastring="value=update_ing_pop&menu="+menu+"&store="+store+"&yield="+yield;
      $(".ingredient_popup_cc").hide();
        $.ajax({
                 type: "POST",
                 url: "load_menu_ingredient.php",
                 data: datastring,
                 success: function (data)
                 {  
                     window.location.href='menu.php';     
                  $(".ingredient_popup_cc").hide();
                  $('#item_ing').val('');
                  $('#rate_ing').val('');
                  $('#tot_ing').val(''); 
                  $('#qty_ing').val(''); 
                  $('#type_ing').val(''); 
                 }
             });
         }else{
             
             $(".alert_error_popup_all_in_one_menu").show();
             $(".alert_error_popup_all_in_one_menu").text('ENTER VALID YIELD');
             $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
            
        }
            
      //location.reload();
    });


 
//function module_rate_change(){
//    
//    if($('#module').val()=='ta/hd'){ 
//        
//        $("#partner_div").show();
//         $("#floor_div").hide();
//    }else{
//        
//      $("#partner_div").hide();
//         $("#floor_div").show();
//    }
//    
//    
//    
//    
//}

function incl_on(){
    
    $('#incl_pop').show();
    
    $('#tax_incl_per').val('');
    $('#tax_incl_val').val('');
    
    $('#tax_incl_per').focus();
     
    $('#tax_incl_code').val(''); 
    
}

function go_incl(){
    
  var tax_percent=  $('#tax_incl_per').val();
   var tax_value= $('#tax_incl_val').val();
    
        
   if(tax_percent!='' && tax_value!='' ){  
       
       
        if($('#tax_incl_code').val()=='555555'){
        
    var datastring="set=update_incl_tax&tax_percent="+tax_percent+"&tax_value="+tax_value;
        
        $.ajax({
                 type: "POST",
                 url: "load_index.php",
                 data: datastring,
                 success: function (data)
                 {  
                     
                        $('#incl_pop').hide();
    
                        $('#tax_incl_per').val('');
                        $('#tax_incl_val').val('');
                        
                     alert('ALL ITEMS ARE NOW INCLUSIVE OF TAX ');
                        
                 }
             });
             
             
        }else{
            alert('ENTER VALID CODE');
        }
             
             
        }else{
            alert('ENTER VALID TAX VALUE AND PERCENTAGE');
        }
             
             
       
}




function stock_view(mid,stk){
    
     var datastring="set=update_stock_in_out_daily&menuid="+mid+"&sts="+stk;
        
        $.ajax({
                 type: "POST",
                 url: "load_index.php",
                 data: datastring,
                 success: function (data)
                 {  
                     
        localStorage.editing_slno=$('#editing_slno_'+mid).text();
        
        localStorage.page1=$('.pagination li.active').find('a').text();
        
        if(localStorage.page1==''){
            localStorage.page1=1;
        }
        var mname=$('#mname').val();
        if(mname==''){
            mname='null';
        }
        var mcate=$('#mcate').val();
        var msubc=$('#msubc').val();
        var mdiet=$('#mdiet').val();
        var mstatus=$('#mstatus').val();
        var kitchen=$('#kitchen').val();
        var image_see=$('#image_see').val();
        
        var excempt_sr=$("#excempt_sr").val();
        if(excempt_sr=="")
        {
                excempt_sr="null";

        } 

        var m_ref_cnt=$("#m_ref_cnt").val();
        if(m_ref_cnt=="")
        {
                m_ref_cnt="null";

        } 
  
                    
                           $("#menupage").load("pagination_functions.php",{"value":'load_menupage',"page":localStorage.page1,"editing_slno":localStorage.editing_slno,"mname":mname,"mcate":mcate,"msubc":msubc,"mdiet":mdiet,"mstatus":mstatus,"kitchen":kitchen,"image_see":image_see,"excempt_sr":excempt_sr,"m_ref_cnt":m_ref_cnt}, function(){ //get content from PHP page
                                  // location.hash='#ids_'+mid;
                                    
                            });
              
         }
    
        });
    
}
</script> 
<div style="display:none" class="new_print_loading_bill"><img src="img/ajax-loaders/ajax-loader.gif"></div> 


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
<strong class="alert_error_popup_all_in_one_menu" style="display: none"> </strong>


<div class="main_logout_popup_cc common_popup_all img_delete_pop" style="display:none;z-index: 99999">
        <div class="main_logout_popup">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">CONFIRM IMAGE DELETE ?</h1>
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="$('.common_popup_all').hide();" style="color:#AB2426 !important" href="#" class="">NO</a></div>
                <div class="btn_logout_yes_no"><a onclick="return delete_image_online();" href="#" class="">YES</a></div>
            </div>
       </div>
     </div>
	 
	 <style>
	 .barcode_popup_cc_new{
		 width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 999;
	 }
	 </style>
	 
	 <div class="barcode_popup_cc_new" style="display:none;">
 	
			<div class="ingredient_popup" style=" width: 310px; height: 265px;">
          <div class="ingredient_popup_head">
              <h3 id="bar_name_new"> Item Name</h3>
              <div onclick="barcode_close();" class="md-close close_staff_pop close_barcode_popup" tabindex="34"><img src="img/close_ico.png"></div>
          </div>
          <div class="ingredient_popup_contant">
              <p style="color: #b15d5d"> ***PACKING & EXPIRY NOT MANDATORY</p>
				<div class="ingredient_popup_contant_row" style="    margin: 20px 0;">
					<div class="ingredient_item_name"  style="width:100%">
					<div class="ingredient_item_name" style="width:100%">ROW COUNT </div>
                                        <input value="1" id="bar_count" style="width:100%" class="ingredient_item_txtbox" type="number">
                                        </div> <br>
                                    
                                    <div class="ingredient_item_name"  style="width:48%;padding-right: 2px">
					<div class="ingredient_item_name" style="width:100%">PACKING DATE </div>
                                        <input id="bar_packing" style="width:100%" class="ingredient_item_txtbox" type="text">
					</div>
                                        
                                         <div class="ingredient_item_name"  style="width:48%">
					<div class="ingredient_item_name" style="width:100%">EXPIRY DATE</div>
                                        <input  id="bar_expiry" style="width:100%" class="ingredient_item_txtbox" type="text">
					</div>  <br>
                                    
                                    
                                    
                                    <div onclick="barcode_print();" style="cursor:pointer;margin-top: 18px;" class="ingredient_popup_footer_btn close_ingredient_popup">PRINT</div>
				</div>

          <div class="ingredient_popup_footer_row">
               <strong id="load_error_ing" style="color:darkred;float:left;margin-top: 20px;font-size: 15px"></strong>
              
          </div>


       </div>

  </div>
  </div>
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
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt">
            
            <input  maxlength="6" type="password" class="stock_add_txtbx" id="code_change" placeholder="ENTER CODE ">
        <a  onclick="go_lock();" href="#"><div class="stock_add_btn">GO</div></a>
            
          
        </div>
    </div>
   </div>
      
         
  <div class="stok_add_popup_sec" style="display:none" id="incl_pop">    
      <div class="stok_add_popup" style="width:330px;height: 190px">
        <div class="stok_add_popup_hd">     INCLUSIVE RATE 
        <a href="#" onclick="$('#incl_pop').hide();"><div class="stok_add_popup_cls">
            <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt">
            
            <input  maxlength="7" type="number" class="stock_add_txtbx" id="tax_incl_per" placeholder="Tax Percentage To Reduce">
            
            <input style="margin-top: 2px;"  maxlength="7" type="number" class="stock_add_txtbx" id="tax_incl_val" placeholder="Tax Value">
            
            <input style="margin-top: 2px;"  maxlength="6" type="text" class="stock_add_txtbx" id="tax_incl_code" placeholder="ENTER ADMIN CODE">
            
            <a  onclick="go_incl();" href="#"><div class="stock_add_btn">APPLY TO ALL ITEMS</div></a>
            
          
        </div>
    </div>
   </div>
 
 
 
 
         
</body>
</html>