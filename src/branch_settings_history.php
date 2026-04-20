<?php
session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Settings</title>
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
 <link rel="stylesheet" href="css/menu_new_22.css">
 <script src="js/jquery-2.1.3.min.js"></script><!--jquery-1.10.2.min-->
<script src="master_style/js/modernizr.custom.js"></script>
<style>
.container{background-color:transparent;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 74vh;min-height: 474px;}
.md-content > div{overflow:auto}
.form_name_cc{font-size:13px;height:30px;line-height:30px;}
.first_form_contain{padding: 0.5%;margin-bottom: 0px;}
.md-modal{width:70%;min-width:800px;}
.md-content > div{max-height:550px;overflow:auto;padding-bottom:60px;}
.md-modal .form-control{ height: 33px;padding: 5px 12px;}
.popup_add_table tr:nth-child(even) {background: #E0E0E0;}
.popup_add_table td {height: 38px;font-size: 14px;border:solid 1px #ccc;}
.md-content .form_name_cc{text-align:left;line-height:22px;min-height:30px;height:auto}
.menu_top_filter_left{padding:0}
.tablesorter tbody{min-height: 390px;}
</style>

</head>
<body>
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Branch Settings History</a></li>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       
                        <div class="branch_master_main_container">
                       		<div  class="new_branch_setings_head">General Settings History</div>
                            
                            <div class="menu_top_filter_left" >
                            <div class="filter_main_head">Filter By</div>
                         <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                    	
						<div class="col-sm-2" style="padding-right: 0px;padding-left:0px;margin-bottom:5px;width:15%">
                         <p class="menu_filter_txt">Branch</p>
                              <select class="add_text_box" id="branch" name="branch">  
                               <!--  <option>Select</option>
                                 <option value="">All</option>
                                 <option value="">All</option>
                                 <option value="">All</option>-->
                                  <option value="null" default>All</option>
                                 
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_branchmaster "); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['be_branchname']?>"><?=$result_login['be_branchname']?></option>
                               <?php } } ?>	
                             
                                 
                                 
                              </select>
						</div>
                        
                        
                        <div class="col-sm-2 nopadding" style="width:10%">
                         <p class="menu_filter_txt">&nbsp;</p>
							<div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#" onClick="validateSearch()">Search</a></div>
						</div>
					</div><!--form_group-->
                    <div style="border-top:5px #B5B5B5  solid;float:left;width:100%;padding-top:5px;">
                    <table class="responstable tablesorter" id="listall">
                    <thead>
                        <tr>
                            <th width="15%" class="header">Branch</th>
                            <th width="10%" class="header">Sl No</th>
                            <th class="header">Message</th>
                            <th width="25%" class="header">Date & Time</th>
                        </tr>
                    </thead>
                   <?php $sql_login  =  $database->mysqlQuery("select * from tbl_branch_settings_history left join  tbl_branchmaster on tbl_branch_settings_history.bsh_branchid=tbl_branchmaster.be_branchid ");
				    $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{?>
				<tr id="ids_<?=$result_login['bsh_branchid']?>"  >
                
                       <td width="15%"><?=$result_login['be_branchname']?></td>
                                 <td width="10%"><?=$result_login['bsh_slno']?></td>
                                   <td><?=$result_login['bsh_message']?></td>
                                     <td width="25%"><?=$result_login['bsh_datetime']?></td>
				</tr>
				
				
		<?php	}
			
			
			
			
	  }
				   ?>
                   </table> 
                   </div>
                    
                    	
                    </div>
                            
                         </div><!--branch_master_main_container-->   
                       
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
 
 
 

<style>.responstable th, .responstable td{height:25px;}</style>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>

function validateSearch()
{
	
	 var branch=$("#branch").val();
	
	if(branch =="")
	{
		branch="null";
	}
	
      $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchbranchhistory&branch="+branch,
			success: function(msg)
			{
				msg=msg.trim();
				//alert(msg);
				$('#listall').html(msg);
			}
		});  
	 
	
}








$(".edit_0").click(function(){
    $(".div_new_0").css("display","none");
	 $(".branch_edit_div").css("display","block");
	 $(".close_branch_edit").css("display","block");
	 $(".edit_0").css("display","none");
	 $(".close_branch_save").css("display","block");
});

$(".close_branch_edit").click(function(){
    $(".branch_edit_div").css("display","none");
	$(".div_new_0").css("display","block");
	$(".close_branch_edit").css("display","none");
	$(".edit_0").css("display","block");
	$(".close_branch_save").css("display","none");
});
/*$(".close_branch_save").click(function(){
	alert("hii");
});	*/

var maxHeight = 0;

$('.branch_inner_div_1').each(function(index){
if ($(this).height() > maxHeight)
{
maxHeight = $(this).height();
}
});

$('.branch_inner_div').height(maxHeight);

$('.branch_inner_div').each(function(index){
if ($(this).height() > maxHeight)
{
maxHeight = $(this).height();
}
});

$('.branch_inner_div_1').height(maxHeight);

</script>

</body>
</html>