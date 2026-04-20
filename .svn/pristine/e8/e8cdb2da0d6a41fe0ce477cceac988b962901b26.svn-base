<?php

session_start();

include("database.class.php"); 
$database	= new Database();


?>

<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Item Detail</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
.searchlist{
	width: 96% !important;background: #f2f2f2  !important; position: absolute !important;top: 55px;z-index: 9999;padding-left: 1%;max-height:350px;overflow:auto}
</style>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
        min-height: 330px;
    height: 66vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
	.bnq_dtail_table td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.main_banquet_contant table td{min-height:40px !important;}
.banq_inv_right_table th{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
	.main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
	.main_banquet_form_box{margin-bottom:7px}
	.als-item a{padding: 0 10px;}
        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .als-wrapper{
         overflow-y: hidden;
         margin: 0px auto;
        height: 50px;
        white-space: nowrap;
        }
        #lista1 .als-item{    display: inline-block;float: none; height: 30px;}
        .als-wrapper::-webkit-scrollbar {
            height: 14px;
        }
        .als-container{border-bottom: 3px solid #191919 !important;}
</style>

 

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
					<li><a style="cursor:pointer">Multi Language</a></li>
            		
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="mlt_language_contant_cc">
                    
                    	
                        <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                
                                <ul class="als-wrapper">
                                      
                                    <li class="als-item"><a href="menu.php" class="new_tab_btn active_btn_1">Back</a></li>
                                    
                                </ul>
             
            
                    </div>
                        </div>
                   </div>
                   
                   		<div class="main_banquet_contant_head" style="line-height: 13px;">
                        	
                            <div class="main_banquet_form_box" style="width: 100%">
                                <div class="main_banquet_form_textbox" style="width: 26%;padding-left: 0">
                                    <span style="width: 100%;padding-bottom: 7px;">ITEM NAME</span>
                                        
                                    <input type="text" placeholder="" id="item_name" autofocus onkeyup="search()"> 
                                  </div>   
                                
                                
                         <div class="main_banquet_form_textbox" style="width: 20%;padding-right: 8px">         
                                 <span style="width: 20%;padding-bottom: 7px;">CATEGORY</span>   
                                 <select  class="form-control " id="item_cat" onchange="search()">
                                              <option value="">All</option>
                                                <?php  
                        $sql_login_ct  =  $database->mysqlQuery("select mmy_maincategoryid,mmy_maincategoryname from tbl_menumaincategory where mmy_active='Y'"); 
						$num_login_ct   = $database->mysqlNumRows($sql_login_ct);
						if($num_login_ct){
                                                    while($result_login_ct  = $database->mysqlFetchArray($sql_login_ct)) 
                                                    { ?>
                                                  <option value="<?=$result_login_ct['mmy_maincategoryid']?>"><?=$result_login_ct['mmy_maincategoryname']?></option>
                                                <?php }} ?>
                                            </select>  
                                    
                                    
                           </div>
                                
                             
                                
                           <div class="main_banquet_form_textbox" style="width: 20%;padding-left: 0">         
                                 <span style="width: 20%;padding-bottom: 7px;">TYPE</span>   
                                 <select  class="form-control " id="item_type" onchange="search()">
                                              <option value="">All</option>
                                               <option value="Single">SINGLE</option>
                                               <option value="Loose">LOOSE</option>
                                                <option value="Packet">PACKET</option>
                                               
                                            </select>  
                                    
                                    
                                    </div>     
                                
                                
                                
    <button style="width: 130px;padding: 15px 7px;font-size: 13px;float: right;margin-left: 2%" type="submit" onclick="item_price()">ITEM PRICE CHANGE</button>                             
                                
    <button style="width: 130px;padding: 15px 7px;font-size: 13px;float: right;margin-left: 2%" type="submit" onclick="item_tax()">ITEM TAX</button> 
    
    
    
                                  
                                </div>

                        </div>
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                                    <div id="left_table_scr_cc" style="overflow:initial ">
                                        
                                        <input type="checkbox" id="multi_check" style="    margin-top: 9px;margin-left: 25px;position: absolute;">
                                   <table class="responstable" >  
                                       
                                       
                                   </table>
                                    </div>

                            </div>

                            
                        </div>
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

   

<!---banquet_listting_edit_popup-->
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
  
    search();
   
   
    function item_price(){
       
       
        var ids=new Array(); 
			var selected_activities =$("[name='selectbills[]']:checked");
                        
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("menuid");
                          
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  } 
                          
                       });
       
       
      
       $('#item_price_pop').show();
       
       $('#item_price_pop').attr('menuid',ids);
       
       
   }
   
   
   function item_tax(){
       
       
        var ids=new Array(); 
			var selected_activities =$("[name='selectbills[]']:checked");
                        
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("menuid");
                          
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  } 
                          
                       });
       
       
      
       $('#item_tax_pop').show();
       
       $('#item_tax_pop').attr('menuid',ids);
       
       
   }
   
   
   function go_item_tax(){
       
       
       var menuid= $('#item_tax_pop').attr('menuid');
       
                        var taxes=new Array(); 
			var selected_activities =$("[name='etax_type[]']:checked");
                        
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("taxes");
                          
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				taxes.push(id_str);
			  } 
                          
                       });
       
       
       if(menuid !='' && taxes!=''){
           
       
        var data_in="set=set_item_tax&menuid="+menuid+"&taxes="+taxes
       
			$.ajax({
			type: "POST",
			url: "load_index.php",
			data: data_in,
			success: function(data)
			{
                          alert('ITEM TAX ADDED');
                          
			 location.reload();
                        
                        }
                        });
       
      
    }else{
        
        alert('SELECT ITEMS AND TAXES');
    }
       
   }
   
   
   
   
   
   function search(){
       
       
       var name=$('#item_name').val();
       
       var cat=$('#item_cat').val();
       
       
       var item_type=$('#item_type').val();
       
       var data_in="set=search_config&name="+name+"&cat="+cat+"&item_type="+item_type
       
			$.ajax({
			type: "POST",
			url: "load_index.php",
			data: data_in,
			success: function(data)
			{
                           
			  $('.responstable').html(data);
                        
                        
                        }
                        });
       
       
       
       
   } 
    
    
    
    
    
    
    
$('#menu_to_excel').click(function(){
    
    window.location="";
    
});



 $('#multi_check').click(function(){ 

    if($("#multi_check").prop('checked') == true){
        
      $('.selectbillsck').each(function(){
        $(this).prop('checked',true);
    
   });
     
   }else{
       
        $('.selectbillsck').each(function(){
            
        $(this).prop('checked',false);
       
        });
   
   }
     
    
});

</script>

 <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:450px;height:265px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
 
      <!-- /////////////ITEM TAX////////////-->
 
 
    <div class="stok_add_popup_sec" style="display:none" id="item_tax_pop" >    
        <div class="stok_add_popup" >
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#item_tax_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt" id="cus_div" style="display:block">
            <span style="font-size:13px;font-weight: bold;color: darkred"> Select The Item Taxes ?</span> 
          <?php
         $fnct_menu = $database->mysqlQuery("select * from tbl_extra_tax_master  where  amc_item_tax='Y' and amc_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
              ?>
            <br> <input type="checkbox" id="etax_type" name="etax_type[]" taxes="<?=$result_fnctvenue['amc_id']?>" ><span style="color:black;"> <?=$result_fnctvenue['amc_name']?> </span> 
             <?php } }else{ ?> 
            <br> <span style="color:red;font-weight: bold"> NO ITEM TAX FOUND</span>
            <?php } ?> 
             <a  onclick="go_item_tax();" href="#"><div class="stock_add_btn">GO</div></a>
        </div>
        
    </div>
   </div>
 
  <!-- /////////////ITEM PRICE CHANGE////////////-->
 
  <div class="stok_add_popup_sec" style="display:none" id="item_price_pop" >    
    <div class="stok_add_popup" style="height:500px;top: 10%;">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#item_price_pop').hide();"><div class="stok_add_popup_cls">
        <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt" id="cus_div" style="height: 450px;overflow-y: scroll;display: block;">
        <span style="font-size:13px;font-weight: bold;color: darkred"> ITEM PRICE CHANGES</span> 
            
            
           <br>  <br> DINE IN SECTION 
            
         <?php
         
         $fnct_menu = $database->mysqlQuery("select fr_floorname,fr_floorid from tbl_floormaster");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) {
         while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
          { 
            ?>
           
            <br> <input type="checkbox" id="floor_type" name="floor_type[]" taxes="<?=$result_fnctvenue['fr_floorid']?>" ><span style="color:darkred;"> <?=$result_fnctvenue['fr_floorname']?> </span> 
            
           <?php } }else{ ?> 
            
           <br> <span style="color:red;font-weight: bold"> NO FLOOR FOUND</span>
            
          <?php } ?> 
            
            
        <br>  <br> TAKEAWAY SECTION
            
         <?php
            
         $fnct_menu = $database->mysqlQuery("select tol_name,tol_id from tbl_online_order");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  
              ?>
            
            <br> <input type="checkbox" id="online_type" name="online_type[]" taxes="<?=$result_fnctvenue['tol_id']?>" ><span style="color:darkred;"> <?=$result_fnctvenue['tol_name']?> </span> 
           
            <?php } }else{ ?> 
            
            <br> <span style="color:red;font-weight: bold"> NO PARTNER FOUND</span>
            
            <?php } ?> 
            
            
            <br>  <br> <input type="checkbox" placeholder=""> COUNTER SALE SECTION
            
            <br>  <br> <input type="text" placeholder="Value" style="float: right;margin-top: -200px;width: 75px;">
            
            <br>  <br>
             
            <select id="type_method" style="float: right;margin-top: -170px;width: 75px;height: 25px;">
                 <option>%</option>
                 <option>V</option>
                
            </select>
            
         <br> <br>
         
         <select id="type_price" style="float: right;margin-top: -150px;width: 75px;height: 25px;">
                 <option>+</option>
                 <option>-</option>
                
        </select>
            
        <a style="float: right;margin-top: -115px;width: 83px;" onclick="go_item_price();" href="#"><div class="stock_add_btn">GO</div></a>
             
        </div>
        
    </div>
   </div>
 
</body>
</html>