<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=3;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_discountmaster WHERE ds_discountid = '" .$_REQUEST['id']."'");
 //header("location:discount_master.php?msg=1");
   if (!headers_sent())
    {    
        header('Location: discount_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="discount_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=discount_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['discount']))
{  $br="1";
	$insertion['ds_discountname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['discount']));
	$insertion['ds_branchid']=  mysqli_real_escape_string($database->DatabaseLink,trim($br));
	 $sql=$database->check_duplicate_entry('tbl_discountmaster',$insertion);
	if(isset($_REQUEST['active']))
	{
	 		$insertion['ds_status'] 		=  'Active';
	}else
	{
	 		$insertion['ds_status'] 		=  'Inactive';
	}//valuepercnt noofvisit
        
        
        
        if(isset($_REQUEST['active_item']))
	{
	 		$insertion['ds_item_discount'] 		=  'Y';
	}else
	{
	 		$insertion['ds_item_discount'] 		=  'N';
	}
        
        
        $insertion['ds_discountof'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['valuepercnt']));
   	$insertion['ds_mode']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['nwtype']));
   
	if($sql!=1)
	{
	   $insertid              			=  $database->insert('tbl_discountmaster',$insertion);
	   $database->updateexpodine_machines(); 
           
          $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
           
	  $lastid='';
	  $sql_login  =  $database->mysqlQuery("select ds_discountid from tbl_discountmaster where "
          . " ds_discountname='".$insertion['ds_discountname']."'  AND ds_branchid='".$insertion['ds_branchid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['ds_discountid'];
			}

        }
        
	header("location: discount_master.php?msg=2");
	if (!headers_sent())
        {    
        header('Location: discount_master.php?msg=2');
        exit;
        }
    else
    { 
        
        echo '<script type="text/javascript">';
        echo 'window.location.href="discount_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=discount_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
	
}


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['discountname1']))
{
	if(isset($_REQUEST['active1']))
	{
		$active='Active';
		
	}
        else 
        {
                $active='Inactive';
        }

        if(isset($_REQUEST['active_item1']))
	{
	 		$item_dis=  'Y';
	}else
	{
	 		$item_dis=  'N';
	}



	$id=$_REQUEST['discountid'];
	$discount=trim($_REQUEST['discountname1']);
        $branch="1";
	$ds_percent 		=  trim($_REQUEST['valuepercnt1']);
        $ds_noofvisit		=  trim($_REQUEST['noofvisit1']);
   
        $ds_md=trim($_REQUEST['mode']);
        
        $query3=$database->mysqlQuery("update tbl_discountmaster set ds_discountname='$discount',ds_branchid='$branch',"
        . " ds_status='$active',ds_discountof='$ds_percent',ds_item_discount='$item_dis',ds_mode='$ds_md' where ds_discountid='$id'");
        $database->updateexpodine_machines(); 

        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	if (!headers_sent())
        {    
        header('Location: discount_master.php?msg=3');
        exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="discount_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=discount_master.php?msg=3" />';
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
<title>Discount</title>
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
		jQuery(document).ready(function(){
			$('#discounts').autocomplete({source:'autocomplete/find_keywords.php?type=discounts_s', minLength:1});
			$('#branchs').autocomplete({source:'autocomplete/find_keywords.php?type=branchs_s', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
	<script>

$(document).ready(function(){
	$("#discounts").focus();
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_disc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/disc_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Discount</a></li>
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
                           	<span class="filte_new_text">Discount Name</span>
                                <input type="text" class="form-control filte_new_box" id="discounts" name="discounts" placeholder="Discount Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                               <span class="filte_new_text">Select Branch</span>
                                 <select  class="add_text_box filte_new_box"  id="branchs" name="branchs" onChange="validateSearch()">
                                 <option value="null" default>All</option>
                                 
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['be_branchname']?>"><?=$result_login['be_branchname']?></option>
                               <?php } } ?>	
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                <span class="filte_new_text">Select Status</span>
                                <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;display: none" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="discount_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_discount" class="md-trigger add_btn_2" data-modal="modal-17" onClick="discountclr()"></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                 <th>Discount Name</th>
       							
                                 <th>Value</th> 
                                 <th>Mode</th>
                                 <th>Item Discount</th> 
                                
                                 <th>Status</th> 
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$mdd='';
				$modee=$result_login['ds_mode'];
				if($modee =='P')
				{
					$mdd='%';
				}
				else
				{
					$mdd='Value';
				}
                                
                       if($result_login['ds_item_discount']=='Y'){
                           $item_discount="Yes";
                       } else{
                             $item_discount="No";
                       }        
                                
				
	 ?>
        <tr id="ids_<?=$result_login['ds_discountid']?>"  class="select">
            <td><?=$result_login['ds_discountname']?></td>
            <td><?=number_format($result_login['ds_discountof'],$_SESSION['be_decimal'])?></td>
            
            <td><?=$mdd?></td>
            
            
            
            <td><?=$item_discount?></td>
           
            <td><?=$result_login['ds_status']?></td>
            <td>
            <a href="#" class="md-trigger_disc" id="ids_<?=$result_login['ds_discountid']?>" ><img src="images/edit_page.PNG"></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ds_discountid']?>">
            <!--    <a href="#" onClick="delete_confirm('<?=$result_login['ds_discountid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
 <div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>ADD DISCOUNT</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="discount_master.php"  method="post"  name="discount_master">
                                <span id="discountchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Discount Name<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control discountname" id="discount" name="discount"  placeholder="Discount Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Discount Name" ></div>
                               </div>
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Value</div>
                                
                                <div class="form_textbox_cc" id="valuepercnt_div">
                                <input type="text" class="form-control valuepercnt" id="valuepercnt" name="valuepercnt"  placeholder="Value" tabindex="2"  data-toggle="tooltip" title="Value" ></div>
                               </div>
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Mode</div>
                                
                               	 <div class="form_textbox_cc" >
                                      <select data-placeholder="Enter Branch Name" id="nwtype" name="nwtype" tabindex="3" data-rel="chosen" title="BranchName" left"." data-toggle="tooltip" class="form-control add_new_dropdown add_text_box nwtype">
<!--                               	<select  class="add_text_box nwtype" id="nwtype" name="nwtype" tabindex="3" >-->
                                            <option value="">Select Mode</option>
                                            <option value="V">Value</option>
                                            <option selected value="P">%</option>
                                             
                                        </select>
                                
                                
                                </div>
                               </div>
                               
                              
                               
                               
                                <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                 <div class="form_textbox_cc" > <div class="form-group" id="bch_div">
                                  
                                
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Branch Name" id="branch" name="branch" data-rel="chosen" tabindex="5" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Branch">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  id="<?=$result_kot['be_branchid']?>" ><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                               
                               </div>
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                                
                               	 <div class="form_textbox_cc" id="active_div">
                  <div>
                    <!--   <label class="control-label" for="selectError">Active</label>-->
                    <label>
                        <input checked class="checkbox" type="checkbox" value="" tabindex="6" name="active"  id="active" data-toggle="tooltip" title="Active">
                    </label>
                  </div>              
                               </div>
                                    
                                  </div>
                                
                                
                                
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Item Discount</div>
                                
                               	 <div class="form_textbox_cc" id="active_item_div">
                                 	<div class="checkbox">
             <!--   <label class="control-label" for="selectError">Active</label>-->
                    <label>
                        <input type="checkbox" value="1" tabindex="7" name="active_item"  id="active_item" data-toggle="tooltip" title="">
                       
                    </label>
                </div>              
                               </div>
                                    
                                  </div>
                                
                                  </form> 
                    </div>
                                  
                             
                               <a  href="#" class="entersubmit" onClick="validate_disc()" tabindex="7"><button class="md-save">Save</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">

	$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
    $("#modal-17").removeClass('md-show');
    });

	$("#add_discount").click(function()
	{
		$("#discount").focus();
	});

 $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function discountclr()
{
	document.getElementById('discount').value = '';
      	document.getElementById('branch').value = '';
        document.getElementById('valuepercnt').value = '';
      //	document.getElementById('nwtype').value = '';
        document.getElementById('noofvisit').value = '';
    	//$("input[type=checkbox]").each(function() { this.checked=false; });
	
}
function validate_all()
{
		 var a=$("#discount").val().trim();
		var cb= $("#branch").find('option:selected').attr('id');
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkdiscount&mid="+a+"&brch="+cb,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#discountchk');
			if(data=="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#discount").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.discount_master.submit();
			}
			}
		});
	
}

function validate_disc()
	{
	 if(validate_discount())
		{
                    if(validate_value())
		{
                 	
					if(validate_all())
						{
						}
		
                       
                   
		}
            }
        }
function validate_discount()   
	{
		if($(".discountname").val()=="")
		{
			
			$("#menumaincategory_div").addClass("has-error");
				  document.discount_master.discount.focus();
                                 // alert("Enter Discount Name");
                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Discount Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
				  return false;
		}
                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                 if(!alphanumers.test($("#discount").val())){
                 $("#menumaincategory_div").addClass("has-error");
                  document.discount_master.discount.focus();
                           // alert("Special charecter Not Allowed.");
                           $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              }
                  else
			 {
			
				 var a=document.getElementById("discount").value;
				 $("#menumaincategory_div").removeClass("has-error");
				 $(this).addClass("has-success");
				
				 return true;
			 }
	}
        
        function validate_value()   
			{
                            
                            
                if($("#valuepercnt").val()=="")
		{   
			
			$("#valuepercnt_div").addClass("has-error");
				  document.discount_master.valuepercnt.focus();
                                  //alert("Enter Value");
                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
				  return false;
		}
                 var alphanumers = /^[0-9 .]+$/;
                 if(!alphanumers.test($("#valuepercnt").val())){
                 $("#valuepercnt_div").addClass("has-error");
                  document.discount_master.valuepercnt.focus();
                 // alert("Enter Numeric Value.");
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Numeric Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
              }
              else if($("#valuepercnt").val().split('.')[1] && $("#valuepercnt").val().split('.')[1].length>3){
                  $("#valuepercnt_div").addClass("has-error");
                    document.discount_master.valuepercnt.focus();
                    //alert("MAX 3 DECIMAL POINTS ALLOWDED");
                    $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('MAX 3 Digits  After Point');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                    
                    return false;
              }
              else if($("#valuepercnt").val()>=100 && $("#nwtype").val()=='P'){
                    $("#valuepercnt_div").addClass("has-error");
                    document.discount_master.valuepercnt.focus();
                    //alert("Enter Value Less than 100");
                    $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value Less than 100%');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                    return false;
              }
                  else{
                  
                  
                                      var val = parseFloat($('#valuepercnt').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#valuepercnt_div").addClass("has-error");
					 document.discount_master.valuepercnt.focus();
                                       // alert("Does not start with zero.");   
                                       $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Dont Start With Zero');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					return false;
                                    }
			 else{
			
				 var a=document.getElementById("valuepercnt").value;
				 $("#valuepercnt_div").removeClass("has-error");
				 $(this).addClass("has-success");
				
				 return true;
			 }
        	}
                        
}           
                        

        
	
			
			
function delete_confirm(id)
{
	
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="discount_master.php?id="+id+"&delete=yes";
	}
}
$('#active_item').click(function(){
    if($('#active_item').prop('checked')){
        $('#nwtype').val('P');
        //$('#nwtype').attr('disabled', 'disabled');
    }else{
        $('#nwtype').val('null');
         //$('#nwtype').removeAttr('disabled');
    }
    
   });
      
   $('#nwtype').change(function(){
       
      if($('#nwtype').val()!='P'){
         $('#active_item').prop('checked',false); 
      }
       
   });
</script>
<script type="text/javascript">
function validateSearch()
{
  var discounts=$("#discounts").val();
  if(discounts=="")
  {
	  discounts="null";
  }
  var branchs=$("#branchs").val();
  if(branchs=="")
  {
	  branchs="null";
  }
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }

	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchdiscount&discounts="+discounts+"&branchs="+branchs+"&statuss="+statuss,
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