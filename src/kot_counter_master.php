<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=1;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_kotcountermaster WHERE kr_kotcode = '" .$_REQUEST['id']."'");
 //header("location:kot_counter_master.php?msg=1");
	 if (!headers_sent())
    {    
        header('Location: kot_counter_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="kot_counter_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=kot_counter_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['kot']))
{
    
        $br="1";
	$insertion['kr_kotname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['kot']));
	$insertion['kr_branchid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($br));
	
		
        $sql=$database->check_duplicate_entry('tbl_kotcountermaster',$insertion);
	
	if($sql!=1)
	{
	  $insertid              			=  $database->insert('tbl_kotcountermaster',$insertion);
	  $database->updateexpodine_machines(); 
	 
           $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
          
	 $lastid='';
	 $sql_login  =  $database->mysqlQuery("select kr_kotcode from tbl_kotcountermaster where "
         . " kr_kotname='".$insertion['kr_kotname']."'  AND kr_branchid='".$insertion['kr_branchid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['kr_kotcode'];
			}

	 }
	
   if (!headers_sent())
    {    
        header('Location: kot_counter_master.php?msg=2');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="kot_counter_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=kot_counter_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }

}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['kot1']))
{
	$id=$_REQUEST['kotid'];
	$kot=trim($_REQUEST['kot1']);
	$branch="1";

	$query3=$database->mysqlQuery("update tbl_kotcountermaster set kr_kotname='$kot', kr_branchid='$branch' where kr_kotcode='$id'");
	$database->updateexpodine_machines(); 

         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
       if (!headers_sent())
       {    
         header('Location: kot_counter_master.php?msg=3');
         exit;
       }
       else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="kot_counter_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=kot_counter_master.php?msg=3" />';
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
<title>KOT</title>
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
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 

	$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
        	//alert("hi");
            
       $("#modal-17").removeClass('md-show');
    });

		jQuery(document).ready(function(){
			$('#kots').autocomplete({source:'autocomplete/find_keywords.php?type=kot_s', minLength:1});
			$('#branches').autocomplete({source:'autocomplete/find_keywords.php?type=branch_s', minLength:1});
			$('#printers').autocomplete({source:'autocomplete/find_keywords.php?type=printer_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script>
$(document).ready(function(){

		$("#kots").focus();

		$("#add_kot").click(function()
		{
			$("#kot").focus();
		});

  

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
					<li><a style="cursor:pointer">KOT Counter</a></li>
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
                             	<span class="filte_new_text">Kot name</span>
                              <input type="text" class="form-control filte_new_box" id="kots" name="kots" placeholder="Kot name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Select Branch</span>
                                 <select  class="add_text_box filte_new_box"  id="branches" name="branches" onChange="validateSearch()">
                                 <option value="null" default>All</option>
                                 
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_printersettings ON tbl_kotcountermaster.kr_printerid=tbl_printersettings.pr_id"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['be_branchname']?>"><?=$result_login['be_branchname']?></option>
                               <?php } } ?>	
                             
                                </select>
                            </div>
                            <!--<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                            	<span class="filte_new_text">Printer Name</span>
                                <input type="text" class="form-control filte_new_box" id="printers" name="printers" placeholder="Printer name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>-->
                            
                           
                            <div class="col-sm-2 nopadding" style="width: 40.666667% !important;">
                                <div style="margin-left:2%; width: 30%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;display: block" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #135e6a;color: white" href="menu.php" >ITEM MASTER </a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" id="add_kot" data-modal="modal-17" onClick="clrkot()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>KOT</th>
                                <th>Branch</th>
                             
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['kr_kotcode']?>"  class="select">
                                <td><?=$result_login['kr_kotname']?></td>
                                <td><?=$result_login['be_branchname']?></td>
                               
                                <td>
                                 <a href="#" class="md-trigger_cat" id="ids_<?=$result_login['kr_kotcode']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['kr_kotcode']?>">
                               <!--  <a href="#" onClick="delete_confirm('<?=$result_login['kr_kotcode']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
				<h3>ADD NEW</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="kot_counter_master.php"  method="post"  name="kot_master">
                            <span id="kotstatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                               
                             	<div class="form_name_cc">KOT<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="kot_div">
                                     <input type="text" class="form-control kotname" id="kot" name="kot"  placeholder="KOT" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="KOT" ></div>
                               </div>
                                 
                                   <div style="display:none" class="first_form_contain">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="brnch_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                          <select  data-placeholder="Enter Branch Name" id="branch" name="branch" data-rel="chosen" tabindex="2" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
                                        <option value=""></option>
                                         <optgroup label="BRANCH">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>" id="<?=$result_kot['be_branchid']?>"><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                      <!--first_form_contain-->
                                  </form> 
                    </div>
					<div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>       
                             
                             <a  href="#" class="entersubmit1" onClick="validate_kot()" ><button class="md-save" tabindex="3">Save</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>-->
<!--<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>
<script type="text/javascript" src="js/app.js"></script>-->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<!--<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 8,
					scrolling_items: 2,
					orientation: "horizontal",
					circular: "no",
					autoscroll: "no",
					interval: 5000,
					speed: 500,
					easing: "linear",
					direction: "left",
					start_from: 9
				});
			});
		</script>
-->
<script type="text/javascript">
//$('.entersubmit').ready(function () {
//    
//        $("input:text").keypress(function(event) {
//            if (event.keyCode == 13) {
//                event.preventDefault();
//                return false;
//            }
//        });
//        });
function validate_all()
			{
			var a=$("#kot").val().trim();
			
				//var cb= $("#branch").find('option:selected').attr('id');
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkot&mid="+a+"&brch=1",
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#kotstatus1234');
			if(data=="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
		// namechk.text('Already exists');
		   $("#kot_div").addClass("has-error");
	  $("#kot").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#kot_div").removeClass("has-error");
	   $("#kot_div").addClass("has-success");
	  	document.kot_master.submit();

			}
			}
		});
			}

function valikot()
{
	 var a=$("#kot").val().trim();

	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkot&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
			
				 var namechk=$('#kotstatus1234');
				if(msg =="sorry")
					{
                                            
                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');          
                                            
                                            
			 // namechk.text('Already exists');
			     $("#kot_div").addClass("has-error");
	  $("#state").focus();
					}
					else
					{
						namechk.text('');
						 $("#kot_div").removeClass("has-error");
	   $("#kot_div").addClass("has-success");
					}
			}
		});
}


function clrkot()
{
		document.getElementById('kot').value = '';
      	document.getElementById('branch').value = '';
    	document.getElementById('printer').value = '';
     	$('#kotstatus1234').text('');
		$("#kot_div").removeClass("has-error");
	    $("#brnch_div").removeClass("has-error");
	    $("#printer_div").removeClass("has-error");
	}
		function validate_kot()
			{
			 if(validate_kotname())
				{
					
						if(validate_all())
						{
				
						}
					
				}
			}
		function validate_kotname()   
			{
				if($("#kot").val()=="")
				{
					$("#kot_div").addClass("has-error");
						  document.kot_master.kot.focus();
                                                 // alert("Enter KOT");
                                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Kot Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
                          var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#kot").val())){
                          $("#kot_div").addClass("has-error");
                          document.kot_master.kot.focus();
                 // alert("Special charecter Not Allowed.");
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
        
                                      else
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
				
						 // document.kot_counter_master.branch.focus();
                                                  alert("Select Branch");
						  return false;
				}
                              var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#branch").val())){
                              $("#brnch_div").addClass("has-error");
                            document.kot_counter_master.branch.focus();
                //  alert("Special charecter Not Allowed.");
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
                                      else
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
	/*var printer=$("#printers").val();
	if(printer=="")
	{
	printer="null";
	}*/
//alert(kot+branch+printer);
//+"&printer="+printer
	  $.ajax({ 
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchkot&srchid="+kot+"&brnch="+branch,
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