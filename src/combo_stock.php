<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$combo_stock_id='';
$combo_stock_status='';
$combo_stock_number=0;
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Combo</title>
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
    .filte_new_box{height: 30px !important;}.search_btn_member_invoice a{line-height: 31px;}.table_report td strong{font-size: 16px}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
    .combo-stock-head{
        padding: 0 1%; width: 100%;height: auto;float: left;
        text-align:center;background-color: white;font-size:18px;font-weight: bold;padding-bottom: 5px;    padding-top: 6px; line-height: 30px;
    }   
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         .tbl_del_combo i {
    color: #000000;
    font-size: 20px;
    top: 6px;
    margin-left: 3%;
}
.icontick{top: -3px;}
.tab_edt_btn {padding: 5px 4px !important;}
 /*pagination */
.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.menu_total_showing_text{width: auto;color: #333;position: absolute;bottom: 5px;left: 10px;font-size: 15px;font-weight:bold}
.combo_edit {
    font-size:20px !important;
    padding: 0 2px;
        color: #B22512;
}
.combo_update{
     font-size:20px !important;
    padding: 0 2px;
        color: #0d503e;
}
.tablesorter tbody{height: 64vh}
    .combo-stock-search{width: 200px;height: auto;float: right;margin-right: 10px;position: relative}
    .contant_table_cc{height: 77vh}
</style>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/combo.js"></script>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; 
  include "includes/left_menu.php";
  if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_combo_stock'){
    $combo_stock_id=$_REQUEST['combo_stock_id'];
    $combo_stock_status=$_REQUEST['combo_stock_status'];
    $combo_stock_number=$_REQUEST['combo_stock_number'];
    $sql_combo_status_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`='".$combo_stock_number."',`cs_stock_status`='".$combo_stock_status."',`cs_stock_date`='".$_SESSION['date']."',`cs_last_updated`=NOW() WHERE `cs_id`='".$combo_stock_id."'");
    
    echo "@@@Combo Stock Successfully Updated...@@@";    
  }
?>
    
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Base Unit Master</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(1000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                        
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                <?php  include "includes/page_top.php"; ?>
                            </div>
                        </div>
                   </div><!--cc_new-->
                  
                   
                  
                   <span class="combo-stock-head" >
                        <div style="width: 30px;height:30px;border-radius:50%;margin-left:0;" class="search_btn_member_invoice filte_new_box_btn" style="cursor:pointer"><a href="combo.php" type="submit" name="combo_stock_btn" style="background-color: transparent;margin-top:0;line-height: 28px;" ><img src="images/thin_left_arrow_333.png"> </a></div>
                        <span style="float:left">Combo Stock Table</span>
                       <div style="width: 30px;height:30px;border-radius:50%;margin-left:0;float:right" class="search_btn_member_invoice filte_new_box_btn" style="cursor:pointer"><a href="combo_stock.php" type="submit" name="combo_stock_btn" style="background-color: transparent;margin-top:0;line-height: 28px;" ><img src="img/refresh.png"> </a></div>
                       <div class="combo-stock-search">
                           <span style="position: absolute; left: -50px;font-size: 13px;">Search :</span>
                            <input type="text" class="form-control filte_new_box " placeholder="Search Combo Name" name="combo_name" id="combo_name" onkeyup=" return combo_stock_search(this.value)"autocomplete="off">
                       </div>
                      
                           
                   </span>
                           
                   <div class="col-md-12 contant_table_cc stock_table">
                        <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Action</th>
                                <th width="10%">Sl No</th>
                                <th height="35px" class="header">Combo Pack</th>
                                <th height="35px" class="header">Stock Number</th>
                                <th height="35px" class="header">Stock Status</th>
                                <th height="35px" class="header">Stock Date</th>
                                
                              </tr>
                             </thead>
                             <tbody id="stock_table_content">
                                 <?php 
                                    $sql_combo_stock =  $database->mysqlQuery("select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
                                                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
                                                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id
                                                                                order by cn.cn_id, cp.cp_id asc ");
//                                    echo "select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
//                                                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
//                                                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id
//                                                                                order by cn.cn_id, cp.cp_id asc";
                                    $num_combo_stock  = $database->mysqlNumRows($sql_combo_stock);
                                        if($num_combo_stock){$i=0;
                                            while($result_combo_stock  = $database->mysqlFetchArray($sql_combo_stock)){
                                                $i++;
                                    ?>
                             <tr id="focusid_<?=$result_combo_stock['cs_id']?>" class="select" combo_id>
                                <td id="edit_stock_<?=$result_combo_stock['cs_id']?>"><i class="fa fa-edit combo_edit" id="combo_edit_<?=$result_combo_stock['cs_id']?>" style='cursor: pointer' onClick='return combo_edit_stock("<?=$result_combo_stock['cs_id']?>")'></i><i class="fa fa-save combo_update" id="combo_update_<?=$result_combo_stock['cs_id']?>" style='cursor: pointer;display:none' onClick='return combo_update_stock("<?=$result_combo_stock['cs_id']?>")'></i></td>
                                <td width="10%" id="editing_slno_<?=$result_combo_stock['cs_id']?>"><?=$i?></td>
                                <td><strong class="stock_id" id="stock_id_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cn_name'].' '.$result_combo_stock['cp_pack_name']?></strong></td>
                                <td class="stock_number"><span class="stock_number_diplay" id="stock_number_diplay_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cs_stock_number']?></span><input type="text" style="display:none"  class="stock_number_edit" id="stock_number_edit_<?=$result_combo_stock['cs_id']?>" onkeypress="return numdot(event)"></td>
                                <td class="stock_status" id="stock_status_<?=$result_combo_stock['cs_id']?>"><?php if($result_combo_stock['cs_stock_status']=='Y'){ echo 'In Stock';}else { echo 'Out of Stock';}?></td>
                                <td class="stock_date" id="stock_date_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cs_stock_date']?></td>
                               
                            </tr>
                                <?php
                                    }}
                                ?>
                             
                            </tbody>
                       </table>
                      
                   </div>
                     <div class="menu_total_showing_text"></div>
                    </div><!--main_cc-->
                   
                </div><!--main content-sec-->
                 
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
<script>
    $(document).ready(function(){
        if(localStorage.page==''){
            localStorage.page=1;
        }
       $(".stock_table").load("pagination_functions.php?value=load_combo_stock&page="+localStorage.page);
       $(".stock_table").on( "click", ".pagination a", function (e){
                
                e.preventDefault();
		//$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
                localStorage.page=page;
		$(".stock_table").load("pagination_functions.php",{"value":'load_combo_stock',"page":page,}, function(){ //get content from PHP page
			//$(".loading-div").hide(); //once done, hide loading element
		});
		
	});
       
    });
     
    
    function combo_edit_stock(stock_id){
        
        $('.stock_number_edit').hide();
        $('.combo_update').hide();
        $('.combo_edit').show();
        $('.stock_number_diplay').show();
        $('#combo_edit_'+stock_id).hide();
        $('#stock_number_diplay_'+stock_id).hide();
        $('#combo_update_'+stock_id).show();
        $('#stock_number_edit_'+stock_id).show();
        $('#stock_number_edit_'+stock_id).val($('#stock_number_diplay_'+stock_id).text());
        $('#stock_number_edit_'+stock_id).focus();
        localStorage.editing_slno=$('#editing_slno_'+stock_id).text();
        localStorage.combo_search=$('#combo_name').val();
    }
    function combo_update_stock(stock_id){
        var stock_status='';
        var combo_stock_number=$('#stock_number_edit_'+stock_id).val();
        if(combo_stock_number>0){
           stock_status='Y'; 
        }else{
            stock_status='N'; 
        }
        
        var dataString = 'set=update_combo_stock&combo_stock_id='+stock_id+'&combo_stock_status='+stock_status+"&combo_stock_number="+combo_stock_number;
        $.ajax({
            type: "POST",
            url: "combo_stock.php",
            data: dataString,
            success: function(data) {

                $('#combo_update_'+stock_id).hide();
                $('#stock_number_edit_'+stock_id).hide();
                $('#combo_edit_'+stock_id).show();
                $('#stock_number_diplay_'+stock_id).show();
                data=data.split('@@@');

                        if(localStorage.page==''){
                            localStorage.page=1;
                        }
                        $(".stock_table").load("pagination_functions.php",{"value":'load_combo_stock',"page":localStorage.page,"editing_slno":localStorage.editing_slno,"combo_name":localStorage.combo_search,}, function(){ //get content from PHP page
                           
                           location.hash = '#focusid_'+stock_id;
                                  
                        });
                            
                          
                        $('#combo_stock_alert').css('display','block');
                        $('#combo_stock_alert').text(data[1]);
                        $('#combo_stock_alert').delay(2000).fadeOut('slow');

                
            }   
                
        });
        
    }
    function combo_stock_search(combo_name){
        
            $(".stock_table").load("pagination_functions.php?value=load_combo_stock&combo_name="+combo_name);
        
        
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
    
</script>    




</body>
</html>