<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=4;
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Feedback</title>
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
<style>
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 67vh;}
.tablesorter tbody{min-height: 395px;height: 60vh;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
		//	$('#feedbackqstn').autocomplete({source:'autocomplete/find_keywords.php?type=feedback_q', minLength:1});
//			$('#orderid').autocomplete({source:'autocomplete/find_keywords.php?type=order_i', minLength:1});
			$('#tableno').autocomplete({source:'autocomplete/find_keywords.php?type=table_n', minLength:1});
			<!--$('#rate').autocomplete({source:'autocomplete/find_keywords.php?type=rate_f', minLength:1});-->
			
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_ing').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/ingredient_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
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
					<li><a style="cursor:pointer">Feedback Rating</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
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
                   
                       <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                              <div class="col-sm-2 filte_new_text" style="line-height:40px; width:10%">Table No</div>
                           <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                                <input type="text" class="form-control" id="tableno" name="tableno" placeholder="Table No" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice"><a href="feedback_rating.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
    <!--               <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                           <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                <input type="text" class="form-control" id="ingrdnts" name="ingrdnts" placeholder="Ingredient Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            
                          
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice"><a href="ingredient_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                  <!--  </div>-->
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<!--<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>-->
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th height="35px">Question</th>
                                  <th height="35px">Rate</th>
                                    <th height="35px">Order ID</th>
                                      <th height="35px">Table No</th>
                                        <th height="35px">Entry time</th> 
                               <!--  <td>Action</td>-->
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_feedbackrating LEFT JOIN tbl_feedbackmaster ON tbl_feedbackrating.fbr_fbm_id=tbl_feedbackmaster.fbm_id LEFT JOIN tbl_tablemaster ON tbl_feedbackrating.fbr_table=tbl_tablemaster.tr_tableid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['fbr_id']?>"  class="select">
                             <td><?=$result_login['fbm_question']?></td>
                             <td><?=$result_login['fbr_rate']?></td>
                             <td><?=$result_login['fbr_orderid']?></td>
                             <td><?=$result_login['tr_tableno']?></td>
                              <td><?=$result_login['fbr_entrytime']?></td>
                               <!-- <td>
                                 <a href="#" class="md-trigger_ing" id="ids_<?=$result_login['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ir_ingredientid']?>">
                                 <a href="#" onClick="delete_confirm('<?=$result_login['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
                              </tr>
                               
                              <?php } } ?>
                        </table>
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 <!--<div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="ingredient_master.php"  method="post"  name="ingredient_master">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Ingredient<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="ingredient_div">
                                <input type="text" class="form-control ingredientname" id="ingredient" name="ingredient"  placeholder="Ingredient" tabindex="0"  data-toggle="tooltip" title="Portion" ></div>
                               </div>
                                  </form> 
                    </div>
                       <a  href="#" onClick="validate_ingredient()"><button class="md-save">Save</button></a>
                             <a href="#"><button class="md-close">Close me!</button></a>
				</div>
                </div>
		</div>-->
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
function validateSearch()
{//portionams shtcds
  var tableno=$("#tableno").val();
  if(tableno=="")
  {
	  tableno="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchfeedbackrating&tableno="+tableno,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}
</script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>
<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>