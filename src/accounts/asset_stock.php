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
<title>Asset</title>
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
    .tax_add_btn{width:90%;background-color: #8a6602; margin: 0; line-height: 13px;  padding: 10px 15px; margin-top: 20px; float: left; color: #fff !important;text-align:center;margin-left:5%}
    #leftNavigation #new_tab_btn ul li {margin-top: 0px;height: 35px;padding: 0 !important; width: 100%; display: inherit !important;}
    #leftNavigation #new_tab_btn ul li a{font-size: 12px !important;background-color: transparent !important; color: #000;}
    #leftNavigation > #new_tab_btn ul { border-bottom: 2px #120811 solid; background-color: #fff; width: 96.5%; margin-left: 5px; overflow: hidden;}#leftNavigation > #new_tab_btn a {background-color: #891500;}
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
.ledger_list_scr{width:100%;height:auto;float:left;height:480px;float:left;margin-top:5px;}
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
.bottom_trn_add_row{width:100%;height:auto;float:left;padding:5px;background-color:#fff;border-top:3px #e5e5e5 solid}
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
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;">ASSET STOCK</h3>
                           
                           

                      </div>
                    </div>
           </div>
               
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                           
                            <div class="ledger_list_sec" style="position:relative">
                              <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Asset Name</label>
                                    <input autocomplete="off" type="text" id="asset_name" onkeyup="return search_stock_asset();" class="form-control filte_new_box search_name" >
                                    
                                </div>  
                                
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Asset Name</label>
                                   
                                    <select id="asset_cat" onchange="return search_stock_asset();" class="form-control filte_new_box search_name">
                                        <option value="">Select Category</option>
                                        
                                        
                                        <?php 
                            $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_asset_category  where tsc_status='Active' "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=0;
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { 
                                                      ?>
                                                  
                            <option value="<?=$result_kotlist['tsc_id']?>"><?=$result_kotlist['tsc_name']?></option>
                            
                            
                            <?php } }?>
                                        
                                    </select>
                                </div>  
                                   
                             
                                <div class="ledger_list_scr">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">#</td>
                                                
                                                <td style="width:20%">Asset Name</td>
                                               <td style="width:10%">Category</td>
                                                <td style="width:20%">Stock </td>
                                            </tr>
                                        </thead>
                                        <tbody id="load_asset_stock" >

                                            
                                        
                                            
                                        
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

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
    $(document).ready(function () {
        
 var datastringnewcard="set=search_asset_stock&cm_name=&cm_cat=";
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
         $('#load_asset_stock').html(data);
        }  
       });
   });
    
    
    function search_stock_asset(){
        
       var asset_name   =  $('#asset_name').val();
       var cm_cat=    $('#asset_cat').val();
       
        var datastringnewcard="set=search_asset_stock&cm_name="+asset_name+"&cm_cat="+cm_cat;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
         $('#load_asset_stock').html(data);
        }  
       });
        
    }
</script>





<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
