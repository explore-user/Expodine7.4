<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=1;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_kotcountermaster WHERE kr_kotcode = '" .$_REQUEST['id']."'");
 header("location:kot_counter_master.php?msg=1");
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['kot']))
{
	$insertion['kr_kotname'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['kot']);
		$insertion['kr_branchid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['branch']);
			$insertion['kr_printerid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['printer']);
	
    $sql=$database->check_duplicate_entry('tbl_kotcountermaster',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_kotcountermaster',$insertion);
	
        }
	 header("location: kot_counter_master.php?msg=2");
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['kot1']))
{
	$id=$_REQUEST['kotid'];
	$kot=$_REQUEST['kot1'];
	$branch=$_REQUEST['branch1'];
$printer=$_REQUEST['printer1'];
$query3=$database->mysqlQuery("update tbl_kotcountermaster set kr_kotname='$kot', kr_branchid='$branch',kr_printerid='$printer' where kr_kotcode='$id'");
	
	header("location:kot_counter_master.php?msg=3");
}
$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Branch Master</title>
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
.contant_table_cc{height: 74vh;min-height: 474px;}

</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#kots').autocomplete({source:'autocomplete/find_keywords.php?type=kot_s', minLength:1});
			$('#branches').autocomplete({source:'autocomplete/find_keywords.php?type=branch_s', minLength:1});
			$('#printers').autocomplete({source:'autocomplete/find_keywords.php?type=printer_s', minLength:1});
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
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/kot_edit.php", {kot:menuid},
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
					<li><a style="cursor:pointer">Branch Master</a></li>
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
                  
                   
                   <div class="col-md-12 contant_table_cc">
                   <?php
				   //`tbl_branchmaster`(`be_branchid`, `be_branchname`, `be_address`, `be_city`, `be_state`, `be_country`, `be_lastsyncdate`, `be_headofficeid`, `be_floorcount`, `be_branchprefix`, `be_kotcount`, `be_tablecount`, `be_staffidcount`, `be_menumaincatcount`, `be_menusubcatcount`, `be_menucount`, `be_discountcount`, `be_vouchercount`, `be_corporatecount`, `be_printercount`, `be_inv_prodcatcount`, `be_inv_prodsubcatcount`, `be_inv_prodbrandcount`, `be_inv_prodcount`, `be_feedbackcount`)
				   $sql_login  =  $database->mysqlQuery("select * from `tbl_branchmaster`"); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
						while($result_login  = $database->mysqlFetchArray($sql_login)) 
						  {
						            
                                                          $branchname=$result_login['be_branchname'];
							  $address=$result_login['be_address'];
							  $city=$database->show_city_ful_details($result_login['be_city']);
							  $state= $database->show_state_ful_details($result_login['be_state']);
							  $country=$database->show_country_ful_details($result_login['be_country']);
							  $kotcount=$result_login['be_kotcount'];
							  $tablecount=$result_login['be_tablecount'];
							  $staffidcount=$result_login['be_staffidcount'];
							  $branchprefix=$result_login['be_branchprefix'];
							  $menumaincatcount=$result_login['be_menumaincatcount'];
							  $menusubcatcount=$result_login['be_menusubcatcount'];
							  $menucount=$result_login['be_menucount'];
							  $discountcount=$result_login['be_discountcount'];
							  $vouchercount=$result_login['be_vouchercount'];
							  $corporatecount=$result_login['be_corporatecount'];
							  $printercount=$result_login['be_printercount'];
							  $feedbackcount=$result_login['be_feedbackcount'];
							  
							  
							  
						  }
                                    	
					}
                                        
                                    ?>
                   <div style="text-align:center;font-size: 19px;height:40px;  float: left;width: 100%;background-color:#000;line-height: 40px;color:#fff">General</div>
                         <table class="popup_add_table brnach_ordering_tbl" width="100%" border="0" cellspacing="5">
                         	<tr>
                                <td><strong>Branch Name</strong></td>
                                <td ><?=$branchname?></td>
                                <td><strong>Address</strong></td>
                                <td><?=$address?></td>
                             </tr>
                             <tr>
                               <td><strong>Country</strong></td>
                               <td><?=$country['cy_countryname']?></td>
                               <td><strong>State</strong></td>
                               <td><?=$state['se_statename']?></td>
                            </tr>
                            <tr>
                               <td><strong>City</strong></td>
                               <td><?=$city['cy_cityname']?></td>
                               <td><strong>Feedback Count</strong></td>
                               <td><?=$feedbackcount?></td>
                            </tr>
                            <tr>
                                <td><strong>Kot Count</strong></td>
                                <td ><?=$kotcount?></td>
                                <td><strong>Table Count</strong></td>
                                <td><?=$tablecount?></td>
                             </tr>
                             <tr>
                               <td><strong>Staff Count</strong></td>
                               <td><?=$staffidcount?></td>
                               <td><strong>Branch Prefix</strong></td>
                               <td><?=$branchprefix?></td>
                            </tr>
                            <tr>
                               <td><strong>Main Category Count</strong></td>
                               <td><?=$menumaincatcount?></td>
                               <td><strong>Sub Category Count</strong></td>
                               <td><?=$menusubcatcount?></td>
                            </tr>
                            <tr>
                               <td><strong>Menu Count</strong></td>
                               <td><?=$menucount?></td>
                               <td><strong>Discount Count</strong></td>
                               <td><?=$discountcount?></td>
                            </tr>
                            <tr>
                               <td><strong>Voucher Count</strong></td>
                               <td><?=$vouchercount?></td>
                               <td><strong>Corporate Count</strong></td>
                               <td><?=$corporatecount?></td>
                            </tr>
                            <tr>
                               <td><strong>Printer Count</strong></td>
                               <td><?=$printercount?></td>
                               <td><strong></strong></td>
                               <td></td>
                            </tr>
                            </table>
                            
                             
                   </div>
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
		function validate_kot()
			{
			 if(validate_kotname())
				{
					if(validate_branch())
					{
						if(validate_printer())
						{
					document.kot_master.submit();
						}
					}
				}
			}
		function validate_kotname()   
			{
				if($("#kot").val()=="")
				{
					$("#kot_div").addClass("has-error");
						  document.kot_master.kot.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("kot").value;
						 $("#kot_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			
			function validate_branch()   
			{
				if($("#branch").val()=="")
				{
					$("#brnch_div").addClass("has-error");
				
						  document.kot_counter_master.branch.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("branch").value;
						 $("#brnch_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			
			
			function validate_printer()   
			{
				if($("#printer").val()=="")
				{
					$("#printer_div").addClass("has-error");
				<!--	add_new_dropdown2-->
						  document.kot_counter_master.printer.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("printer").value;
						 $("#printer_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			
			
			
			
			
	function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="kot_counter_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{
	var kot=$("#kots").val();
	if(kot=="")
	{
	kot="null";
	}
	var branch=$("#branches").val();
	if(branch=="")
	{
	branch="null";
	}
	var printer=$("#printers").val();
	if(printer=="")
	{
	printer="null";
	}
//alert(kot+branch+printer);
	  $.ajax({ 
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchkot&srchid="+kot+"&brnch="+branch+"&printer="+printer,
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