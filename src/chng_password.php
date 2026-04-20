<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();

if($_SERVER['REQUEST_METHOD']=='POST')
{
 $id=$_REQUEST['userid'];


$encrypted_password=md5($_REQUEST['newpassword']);


$query3=$database->mysqlQuery("update `tbl_logindetails` set ls_password='$encrypted_password' where ls_username='$id'");   
//header("location: chng_password.php?msg=3");

 if (!headers_sent())
    {    
        header('Location: chng_password.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="chng_password.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=chng_password.php?msg=3" />';
        echo '</noscript>'; exit;
    }
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
<title>Password</title>
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
.tablesorter tbody{min-height:430px;    height: 74vh;}
.contant_table_cc{
	  height: 80vh;
  min-height:460px;
	}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){ 
			$('#usernames').autocomplete({source:'autocomplete/find_keywords.php?type=usernames_u', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_u', minLength:1});
			
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
	$('.md-trigger_pas').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/chng_password_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Change Password</a></li>
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

                       <div class="cc_new">
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                            <span class="filte_new_text">Username</span>
                                <input type="text" class="form-control filte_new_box" id="usernames" name="usernames" placeholder="Username" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                              <!--  <input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                              <span class="filte_new_text">Select Active Status</span>
                                <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                          
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="chng_password.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>User Name</th>
                                 <th>Active</th>
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_logindetails"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['ls_status']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
	 ?>
    						<tr id="ids_<?=$result_login['ls_username']?>"  class="select">
                                <td><?=$result_login['ls_username']?></td>
                                <td><?=$active?></td>
                                <td>
                                 <a href="#" class="md-trigger_pas" id="ids_<?=$result_login['ls_username']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ls_username']?>">
                                </td>
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
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/crptmd5.js"></script>
<script type="text/javascript">
function validateSearch()
{//statuss usernames
 var usernames=$("#usernames").val();
  if(usernames=="")
  {
	  usernames="null";
  }
	 var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
  
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchuser&usernames="+usernames+"&statuss="+statuss,
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