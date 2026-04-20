<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=2;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_departmentmaster WHERE der_departmentid = '" .$_REQUEST['id']."'");
// header("location:department_master.php?msg=1");
  	 if (!headers_sent())
    {    
        header('Location: department_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="department_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=department_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['department']))
{
 	$insertion['der_departmentname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['department']));
	$insertion['der_branch']='1';
          $sql=$database->check_duplicate_entry('tbl_departmentmaster',$insertion);
	
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_departmentmaster',$insertion);
	 $database->updateexpodine_machines(); 
        
	  $lastid='';
	
			
        }
	
		 if (!headers_sent())
    {    
        header('Location: department_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="department_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=department_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }

}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['department1']))
{
	$id=$_REQUEST['departmentid'];
	$department=trim($_REQUEST['department1']);
	
$query3=$database->mysqlQuery("update tbl_departmentmaster set der_departmentname='$department' where der_departmentid='$id'");
$database->updateexpodine_machines(); 	

	  if (!headers_sent())
    {    
        header('Location: department_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="department_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=department_master.php?msg=3" />';
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
<title>Department</title>
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
.ui-autocomplete{z-index:999999 !important;}</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#depts').autocomplete({source:'autocomplete/find_keywords.php?type=depts_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script>



$(document).ready(function(){

		$("#depts").focus();

	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
    
    
	$('.md-trigger_dept').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/dept_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Department Master</a></li>
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
                           <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                           <span class="filte_new_text">Department Name</span>
                                <input type="text" class="form-control filte_new_box" id="depts" name="depts" placeholder="Department Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="department_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   <?php //if($_SESSION['headofid'] !="")
				  { ?>
                   <div class="col-md-12 add_btn_cc_2" style="display:block;">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="deptclr()" ></a>
                      </div>  
                   </div>
                   <?php }?>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Department</th> 
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_departmentmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['der_departmentid']?>"  class="select">
                                 <td><?=$result_login['der_departmentname']?></td>
                                <td>
                                 <a href="#" class="md-trigger_dept" id="ids_<?=$result_login['der_departmentid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['der_departmentid']?>">
                              <!--   <a href="#" onClick="delete_confirm('<?=$result_login['der_departmentid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
 <div style="width:500px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="department_master.php"  method="post"  name="department_master">
                               <span id="deptchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Department<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control departmentname" id="department" name="department"  placeholder="Department" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Department" ></div>
                               </div>
                                  </form> 
                    </div>
                                    <a  href="#" class="entersubmit1" onClick="validate_deptval()" tabindex="2"><button class="md-save">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="3">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
//     $('.entersubmit').ready(function () {
//    
//        $("input:text").keypress(function(event) {
//            if (event.keyCode == 13) {
//                event.preventDefault();
//                return false;
//            }
//        });
//        });
function deptclr()
{
document.getElementById('department').value = '';

	 //var a=$("#department").val().trim();
     	$('#deptchk').text('');
		$("#menumaincategory_div").removeClass("has-error");
}

function validate_all()
{
	// var a=document.getElementById("department").value;
		 var a=$("#department").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkdept&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#deptchk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#department").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.department_master.submit();

			}
			}
		});
}
	


function validate_deptval()
	{
	 if(validate_department())
		{
			if(validate_all())
			{
			//document.department_master.submit();
			}
		}
	}
function validate_department()   
	{
		if($(".departmentname").val()=="")
		{
			$("#menumaincategory_div").addClass("has-error");
				  document.department_master.department.focus();
                                  alert("Enter Department");
				  return false;
		}
                              var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#department").val())){
                              $("#menumaincategory_div").addClass("has-error");
                             document.department_master.department.focus();
                          alert("Special charecter Not Allowed.");
                           }   
                 else
			 {
				 var a=document.getElementById("department").value;
				$("#menumaincategory_div").removeClass("has-error");
					$(this).addClass("has-success");
					 return true;
			 }
	}
	
			
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="department_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>
<script type="text/javascript">
function validateSearch()
{
	 var depts=$("#depts").val();
  if(depts=="")
  {
	  depts="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchdepartment&depts="+depts,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>