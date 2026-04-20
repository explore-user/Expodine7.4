<?php
  
include('includes/session.php');  // Check session
include("database.class.php");   // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=6;

if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
   
   if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menumaincategory SET  mmy_active='Y' WHERE mmy_maincategoryid = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menumaincategory SET  mmy_active='N' WHERE mmy_maincategoryid = '" .$_REQUEST['id']."'");
	}
        
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
	
    if (!headers_sent())
    {    
        header('Location: category_master.php?msg=3');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="category_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=category_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['category']))
{
	
	$insertion['mmy_maincategoryname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['category']));
        $insertion['mmy_displayorder']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['displayorder']));
        $insertion['mmy_orderof_print']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['orderprint']));
	$insertion['mmy_imagename']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['catimage']));
	
	
	if(isset($_REQUEST['inventory']))
	{
	 $insertion['mmy_inventory'] 		=  'Y';
	}else
	{
	 $insertion['mmy_inventory'] 		=  'N';
	}
        
        
        if(isset($_REQUEST['active']))
	{
	 $insertion['mmy_active'] 		=  'Y';
	}else
	{
	 $insertion['mmy_active'] 		=  'N';
	}
        
        
	$insertion['mmy_branchid']=$_SESSION['branchofid'];
        $sql=$database->check_duplicate_entry('tbl_menumaincategory',$insertion);
        if($sql!=1)
	{
            
	$insertid              			=  $database->insert('tbl_menumaincategory',$insertion);
	$database->updateexpodine_machines(); 
      
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	 $lastid='';
	 $sql_login  =  $database->mysqlQuery("select mmy_maincategoryid from tbl_menumaincategory where "
         . "	mmy_maincategoryname='".$insertion['mmy_maincategoryname']."'  AND mmy_branchid='".$insertion['mmy_branchid']."'"); 
         
         
         
	 $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['mmy_maincategoryid'];
			}

        }
	
	if (!headers_sent())
        {    
        header('Location: category_master.php?msg=2');
        exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="category_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=category_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['menumaincategory1']))
{
	if(isset($_REQUEST['active1']))
	{
		$active='Y';
	}
        else 
        {
                $active='N';
        }


   if(isset($_REQUEST['inventory1']))
   {
	$inv='Y';
    }
    else 
   {
	$inv='N';
   }
	
	$id=$_REQUEST['catid'];
	$brid=$_SESSION['branchofid'];
	$cat=trim($_REQUEST['menumaincategory1']);
        $display=trim($_REQUEST['displayorder1']);
        $orderprint=($_REQUEST['orderprint1']);
	$categoryimage=trim($_REQUEST['catimage1']);
	if($categoryimage !="")
	{
	$img="";
	$sql_img=$database->mysqlQuery("Select mmy_imagename from tbl_menumaincategory where mmy_maincategoryid ='".$id."' "); //selecting image to be deleted from folder uploads
	while($result_cat_s  = $database->mysqlFetchArray($sql_img)) 
		  {
			  $img=$result_cat_s['mmy_imagename'];
		  }
		
		 if($img !="")
		 {
		 $t=trim($img);
		  unlink($t);
		 }
       $sql_cat_s  =  $database->mysqlQuery("Delete mmy_imagename  from tbl_menumaincategory where mmy_maincategoryid ='".$id."' "); 
        
       $query3=$database->mysqlQuery("update tbl_menumaincategory set mmy_inventory='$inv', mmy_maincategoryname='$cat',mmy_displayorder='$display',"
       . " mmy_active='$active',mmy_imagename='$categoryimage',mmy_branchid='$brid', mmy_orderof_print='$orderprint' where mmy_maincategoryid='$id'");
       
	}
	else
	{
		 $query4=$database->mysqlQuery("update tbl_menumaincategory set mmy_inventory='$inv',mmy_maincategoryname='$cat',"
                 . " mmy_displayorder='$display', mmy_active='$active',mmy_branchid='$brid', mmy_orderof_print='$orderprint' where"
                 . "  mmy_maincategoryid='$id'");
	}
        
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
       $database->updateexpodine_machines();  
  
    if(!headers_sent())
    {    
        header('Location: category_master.php?msg=3');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="category_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=category_master.php?msg=3" />';
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

if(!isset($_SESSION['upload_id']))
{
$_SESSION['upload_id'] = $database->getEpoch();
}
$upload_id		= $_SESSION['upload_id'];

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Category</title>
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
#container{overflow:auto !important}
.ui-autocomplete{z-index:999999 !important;}</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#categrys').autocomplete({source:'autocomplete/find_keywords.php?type=categrys_c', minLength:1});
			$('#displys').autocomplete({source:'autocomplete/find_keywords.php?type=displys_c', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_cm', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script> 
    
   //setTimeout(function(){
    // $(".cat").focus();
  //},0); 
  
  //$("#add_cat").click(function(){
     // alert("hiii");
 // });
 //$("input:text:visible:first").focus();
  
  //$('#cat').on('click',functiion(){
    //  $('.form-group input[type="text']').attr('autofocus','true');
  //});

$(document).ready(function(){

    $("#add_cat").click(function(){
     $(".cat").focus();
  });

$(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)
			//alert("hiiiii");
		//$('.md-close').click();
		  $("#modal-17").removeClass('md-show');
	});
    



    $("#categrys").focus();
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
			  $.post("popup/category_edit.php", {menu:menuid},
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
    <link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
    <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
      <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
     <script src="tooltip/main.js" type="text/javascript"></script>
      <script type="text/javascript" >
	$(function(){
	   // var menu=$('#menuidnew1').val();
		var btnUpload=$('#me');
	
		var mestatus=$('#mestatus');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadCategory.php?upid=<?=$upload_id?>',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(file)) {              
    				mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					$("#mestatus").delay(2000).fadeOut('slow');
					return false;            
    			}
				 /*if (! (ext && /^(jpg|png|jpeg|gif|bmp|tif)$/.test())){ 
                    // extension is not allowed 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					return false;
				}*/
				mestatus.html('<font color="#ff0000">Please wait...</font> <img src="img/ajax-loaders/ajax-loader-7.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				//mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				//alert(response);
				var details	= response.split("|");
				var a=details[1];
			
				$('#catimage').val(a);
			//categryimg
			
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
					 $.post("load_divmaster.php", {value:"imageload",name:a},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('#categryimg').css("display","block");
				  $('#categryimg').html(data);
				  }); 
					
				} else{
					mestatus.text('Photo Uploaded Error!');
					alert("File Uploaded Error!");
					$("#mestatus").delay(2000).fadeOut('slow');
					
				}
				
				
				
				
//		$.ajax({
//			type: "POST",
//			url: "load_divimage.php",
//			data: "value=addimage&mid="+menu,
//			success: function(msg)
//			{
//				$('#menuimage1').html(msg);
//			}
//		});
			}
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
					<li><a style="cursor:pointer">Category</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec category_master_page">
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
                           		<span class="filte_new_text">Category Name</span>
                                        <input type="text" tabindex="1" class="form-control filte_new_box" id="categrys" name="categrys" placeholder="Category Name" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                             	<span class="filte_new_text">Display</span>
                                <input type="text" tabindex="2" class="form-control filte_new_box" id="displys" name="displys" placeholder="Display Order" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                               <!-- <input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                               	<span class="filte_new_text">Select Status</span>
                                <select class="add_text_box filte_new_box" tabindex="3"  id="statuss" name="statuss" onChange="validateSearch()">
                                
                                   <option value="null">All</option>                                	
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                
                                </select>
                            </div>
                                 
                                 
                                 <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                               <!-- <input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                               	<span class="filte_new_text">Inventory</span>
                                <select class="add_text_box filte_new_box" tabindex="3"  id="inv_search" name="inv_search" onChange="validateSearch()">
                                
                                   <option value="null">All</option>                                	
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                
                                </select>
                            </div>
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667%">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();" tabindex="4">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a tabindex="5" href="category_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_cat" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                               <td width="20%">Category Name</td>
    <td >Display Order</td>
     <td >Print Order</td>
     <td style="display:none">Active</td>
     <td >Inventory</td>
     <td >Action</td>
     <td >Qr Image</td>
     <td >KOT Printer</td>
     <td >Addons</td>
     <td >Preference</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_delete_mode='N' ORDER BY LPAD(lower(mmy_displayorder), 10,0) ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['mmy_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
                                
                                if($result_login['mmy_inventory']=="Y")
				{
					$inv="Yes";
				}else 
				{
					$inv="No";
				}	
                                
                                
	 ?>
    				<tr id="ids_<?=$result_login['mmy_maincategoryid']?>"  class="select">
                                <td  width="20%" ><?=$result_login['mmy_maincategoryname']?></td>
                                <td ><?=$result_login['mmy_displayorder']?></td>
                                <td ><?=$result_login['mmy_orderof_print']?></td>
                                <td style="display:none"><?=$active?></td>
                                
                                <td>
                                  
                                 <?=$inv?>
                              </td>
                                
                                <td >
                                 <a href="#" class="md-trigger_cat" id="ids_<?=$result_login['mmy_maincategoryid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['mmy_maincategoryid']?>">
                                     
       
                                 <?php if($result_login['mmy_active']=="Y"){ ?>  
                                     <a  title="Active" onClick="delete_confirm('ToNo','<?=$result_login['mmy_maincategoryid']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a title="Inactive" onClick="delete_confirm('ToYes','<?=$result_login['mmy_maincategoryid']?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a>
                                 <?php } ?>                              
                                </td>
                                
                                
                                
                                
                                
                                
                                <td >
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black;border-radius: 5px " href="#" onclick="cat_image('<?=$result_login['mmy_maincategoryid']?>')">Qr Image</a>
                              </td>
                                
                                <td >
                                  
                                                
    <select onchange="kitchen_printer('<?=$result_login['mmy_maincategoryid']?>')" id='kitchen_printer_<?=$result_login['mmy_maincategoryid']?>' style="width: 80px;font-size: 10px;font-weight: bold ">
    <option> *  Kitchen Printer</option>
    <?php
    $sql_login5  =  $database->mysqlQuery("select kr_kotcode,kr_kotname from tbl_kotcountermaster "); 
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
	    while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{
    ?>
    <option <?php if($result_login5['kr_kotcode']== $result_login['last_printer_kitchen']){ ?> selected <?php } ?> nm="<?=$result_login5['kr_kotname']?>" value="<?=$result_login5['kr_kotcode']?>"><?=$result_login5['kr_kotname']?></option>
     
          <?php } } ?>
    
 </select>
                                
                                </td>
                                
                             <td >
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black ;border-radius: 5px" href="#" onclick="cat_addon('<?=$result_login['mmy_maincategoryid']?>')">Addon</a>
                              </td>
                              
                              <td >
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black;border-radius: 5px " href="#" onclick="cat_pref('<?=$result_login['mmy_maincategoryid']?>')">Pref</a>
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
                              <form role="form" action="category_master.php"  method="post"  name="category_master">
                                <span id="catstatus1234" class="load_error alertsmaster" style="color:#F00" ></span>   
                        	 <div class="first_form_contain">
                              
                             	<div class="form_name_cc">Category Name<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                   
                                     <input type="text" class="form-control categoryname cat enter" id="category" autofocus="" name="category"  placeholder="Category Name" tabindex="1"  data-toggle="tooltip" title="Category Name" onChange="valicat()" >
                               
                                </div>
                               
                               </div>
                                    	 <div class="first_form_contain">
                             	<div class="form_name_cc">Display Order</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                     <input type="text"   readonly class="form-control displayorder enter " id="displayorder" name="displayorder"  placeholder="Display Order" tabindex="2"  data-toggle="tooltip" title="Display Order"  ></div>
                               </div>
                                  
                                   	 <div class="first_form_contain">
                             	<div class="form_name_cc">Order of Print</div>
                               	 <div class="form_textbox_cc" id="orderprint_div">
                                     <input type="text" value="1" class="form-control orderprint enter" id="orderprint" name="orderprint"  placeholder="Order of Print" tabindex="3"  data-toggle="tooltip" title="Order of Print" onChange="valiorderprint()" ></div>
                               </div>
                                 <span id="catstatus12345" class="load_error alertsmaster" style="color:#F00" ></span>
                                    <div class="first_form_contain">
                             	<div class="form_name_cc">Category Image</div>
                               <!--	 <div class="form_textbox_cc" id="categoryimage_div">-->
                               <span style="position:relative;" id="me" class="styleall">Upload Image</span> <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;"></span> 
                                
                                  <input type="hidden" class="form-control" id="catimage" name="catimage" >
                              <!--  </div>-->
                                </div>
                               
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <div class="checkbox" style="margin-top:0px">
                    <label>
                        <input style="position: relative " type="checkbox" checked value="1" tabindex="5" name="active"  id="active" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                                 
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Inventory</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                         <div class="checkbox">
                              <label>
                        <input type="checkbox" value="1" tabindex="5" name="inventory"  id="inventory" data-toggle="tooltip" title="">
                       
                         </label>
                      </div>              
                       </div>
                                </div>  
                                 
                                <div class="upload_view_img" id="categryimg">
                                
                                 <!--<img src="uploads/CategoryImage/PACK100720151253034865.jpg" width="100px" height="100px" />-->
                                 </div>
                              
                                  </form> 
                    </div>
                                    <a id="save_cat"  href="#" class="entersubmit enter" onClick="validate_category()" ><button class="md-save" tabindex="6">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="7">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
    
     function cat_image(cat) { 
         
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/cat_upload.php", {menu:cat},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	}
        
        
       $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
     
     function kitchen_printer(cat){
         
         
         
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM PRINTER CHANGE');
        
      
        $('#confirm_pop_all').attr('mode','kitchen');
    
          $('#confirm_pop_all').attr('cat',cat); 
           
        
     }
        
    
    function validate_all()
    {  
        $('#save_cat').css('pointer-events','none');
	var ab=$("#category").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcat&mid="+ab,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#catstatus1234');
			if(data =="sorry")
			{
		 namechk.text('Category Name Already exists');
	          $("#menumaincategory_div").addClass("has-error");
	        $("#category").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
	   $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	document.category_master.submit();
        $('#save_cat').css('pointer-events','inherit');
			}
			}
		}); 

	
}
    
    
    
      function valiorderprint()
      {
	var op=$("#orderprint").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkorderprint&mid1="+op,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#catstatus12345');
			if(data =="sorry")
			{
		// namechk.text('Already exists');
                  $("#orderprint_div").addClass("has-error");	        
                  $("#orderprint").focus();
                alert('Order of Print Already exists');
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#orderprint_div").removeClass("has-error");
	   $("#orderprint_div").addClass("has-success");
//	  	alert('aa');

			}
			}
		}); 

	
} 
    
    
    
    
    
    
    
		function validate_category()
			{
                            if(validate_menumaincategory())
				{
                                    
                            if(validate_dorder())
				  {
                                       if(validate_orderprint())
				  {
                                     
                                      if(validate_all())
				{  
                                }  
			
                                    
                              }
                             }
					
		          }
                      }
		function validate_menumaincategory()   
			{
                           	if($(".categoryname").val()=="")
		                  {
			
			$("#menumaincategory_div").addClass("has-error");
				  document.category_master.category.focus();
                                  alert("Enter Category Name")
				  return false;
		             } 
                            
                            
                            var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#category").val())){
                              $("#menumaincategory_div").addClass("has-error");
                            document.category_master.category.focus();
                         alert("Special charecter Not Allowed.");
                   }
                        
                                else 
					 {
//						 var ab=document.getElementById("category").value.trim();						 
						 
							  $("#menumaincategory_div").removeClass("has-error");
					     	  $(this).addClass("has-success");
						 	  return true;
							  
							  
							   
//	        $.ajax({
//			type: "POST",
//			url: "load_divcheckmenu.php",
//			data: "value=checkcat&mid="+ab,
//			success: function(data)
//			{
//			data=$.trim(data);
//	//	alert(data);
//			var namechk=$('#catstatus1234');
//			if(data =="sorry")
//			{
//		 namechk.text('Already exists');
//                $("#menumaincategory_div").addClass("has-error");
//	        $("#category").focus();
//
//	return false;
//			}
//			else
//			{
//			
//		namechk.text('');
//	   $("#menumaincategory_div").removeClass("has-error");
//	   $("#menumaincategory_div").addClass("has-success");
//	
//	  //	alert('aa');
//	document.category_master.submit();
//			}
//			}
//		}); 
						
					 }
                                     }         
			
                        function validate_dorder()
                        {
                            if ($("#displayorder").val() == "")
                            {
                                $("#menumaincategory_divs").addClass("has-error");
                                document.category_master.displayorder.focus();
                                alert("Enter Display Order")
                                return false;
                            } 
                           
                             var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#displayorder").val())){
                       $("#menumaincategory_divs").addClass("has-error");
                        document.category_master.displayorder.focus();
                  alert("Special charecter Not Allowed.");
                        }
                            else
                            {
                                var isvalid = $.isNumeric($("#displayorder").val())
                                if (isvalid)
                                {
                                    $("#menumaincategory_divs").removeClass("has-error");
                                    $(this).addClass("has-success");
                                    return true;
                                } else
                                {
                                    $("#menumaincategory_divs").addClass("has-error");
                                    document.category_master.displayorder.focus();
                                    alert("Enter Numeric Value");
                                    return false;
                                }
                            }
                        
                    }
                    
                    
                    function validate_orderprint()   
			{
			
                        if ($(".orderprint").val() == "")
                            {
                                $("#orderprint_div").addClass("has-error");
                                document.category_master.orderprint.focus();
                                alert("Enter Order of Print");
                                return false;
                            } 
                           
                             var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#orderprint").val())){
                       $("#orderprint_div").addClass("has-error");
                        document.category_master.orderprint.focus();
                 alert("Special charecter Not Allowed.");
                        }
                            else
                            {
                                var isvalid = $.isNumeric($(".orderprint").val())
                                if (isvalid)
                                {
                                    $("#orderprint_div").removeClass("has-error");
                                    $(this).addClass("has-success");
                                    return true;
                                } else
                                {
                                    $("#orderprint_div").addClass("has-error");
                                    document.category_master.orderprint.focus();
                                    alert("Enter Numeric Value");
                                    return false;
                                  // var op=document.getElementById("orderprint").value.trim();


//    $.ajax({
//			type: "POST",
//			url: "load_divcheckmenu.php",
//			data: "value=checkorderprint&mid1="+op,
//			success: function(data)
//			{
//			data=$.trim(data);
//	//	alert(data);
//			var namechk=$('#catstatus1234');
//			if(data =="sorry")
//			{
//		 namechk.text('Already exists');
//                $("#orderprint_div").addClass("has-error");
//	        $("#orderprint").focus();
//
//	return false;
//			}
//			else
//			{
//			
//		namechk.text('');
//	   $("#orderprint_div").removeClass("has-error");
//	   $("#orderprint_div").addClass("has-success");
//	
//	  //	alert('aa');
//	document.category_master.submit();
//			}
//			}
//		});

                               }
                            }
			} 
                    
             
    
    function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
      var id= $('#confirm_pop_all').attr('id1'); 
    
    var  status=$('#confirm_pop_all').attr('status'); 
    
    
    if(mode=='status'){
               if(status=="ToYes")
		{
		    window.location="category_master.php?id="+id+"&delete=yes";
		}else
		{
                    window.location="category_master.php?id="+id+"&delete=no";
		}
      }else{
          
           
          var cat= $('#confirm_pop_all').attr('cat'); 
         
         var kitchen =$("#kitchen_printer_"+cat).val();
         
  
         
         $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=change_kitchen_printer&kitchen="+kitchen+"&cat="+cat,
			success: function(data)
			{
                          
			$('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('KOT KITCHEN UPDATED FOR ALL ITEMS IN THIS CATEGORY ');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                        
                           setTimeout(function () {
                            location.reload();
                            }, 2000);  
                  }
                 });

          
      }
       
    }
    
    
     function delete_confirm(status,id)
     {
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM STATUS CHANGE');
        
      
         $('#confirm_pop_all').attr('mode','status');
    
         $('#confirm_pop_all').attr('id1',id); 
         $('#confirm_pop_all').attr('status',status); 
        	
	
  }	
</script>
<script type="text/javascript">
function testclr()
{
	
	document.getElementById('category').value = '';
	document.getElementById('displayorder').value = '0';
        document.getElementById('orderprint').value = '1';
	//document.getElementById('active').value = '';
	//$('#active').val('');
	$('#catstatus1234').text('');
		 $("#menumaincategory_div").removeClass("has-error");
                  $("#displayorder_divs").removeClass("has-error");
                  $("#orderprint_div").removeClass("has-error");
	  // $("#menumaincategory_div").addClass("has-success");
	//$("input[type=checkbox]").each(function() { this.checked=false; });
}


function valicat()
{
	 var a=$("#category").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcat&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#catstatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Category Name Already exists');
			    $("#menumaincategory_div").addClass("has-error");
	  $("#category").focus();
					}
					else
					{
						namechk.text('');
						 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
					}
			}
		});
}



function validateSearch()
{//categrys displys statuss 
	 var categrys=$("#categrys").val();
  if(categrys=="")
  {
	  categrys="null";
  }
  var displys=$("#displys").val();
  if(displys=="")
  {
	  displys="null";
  }
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
  
   var inv_search=$("#inv_search").val();
  if(inv_search=="")
  {
	  inv_search="null";
  }
  
  
  
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchcategory&categrys="+categrys+"&displys="+displys+"&statuss="+statuss+"&inv_search="+inv_search,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}

function cat_pref(id){
      
      $('#store_staff').attr('cat_id',id);
       
        
     $('.store_pop').show();
      
     var datarp="set=load_pref&cat_id="+id;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
     
          $('#store_staff').html($.trim(data));
    
      }
      });
        
  }  
  
 function pref_set(){
      
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/pls_wait.gif" />'); 
      
         $('.md-overlay').css("display","block");                
                       
      
      var cat_id= $('#store_staff').attr('cat_id');
      
      var stores=$('.stores_all').val();
        
        
        var ids=new Array();
        var selected_activities =$("[name='stores_all[]']:checked");
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("store");
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
     	
			});
        
        
       var ids1=new Array();
        
       var $checks = $('.stores_all');  
        
          var unchecked = $checks.not(':checked').map(function () {
          ids1.push(this.value);   
       }).get();
      
     
     $('.store_pop').show();
      
     var datarp="set=set_cat_pref&cat_id="+cat_id+"&pref_in="+ids+"&pref_out="+ids1;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
            location.reload();
      }
      });
        
  }     
  
  
  
  function cat_addon(id){
      
      $('#store_staff1').attr('addon_id',id);
       
        
     $('.store_pop1').show();
      
     var datarp="set=load_addon_cat&cat_id="+id;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
     
          $('#store_staff1').html($.trim(data));
    
      }
      });
        
  }  
  
 function addon_set(){
      
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/pls_wait.gif" />'); 
      
         $('.md-overlay').css("display","block");                
                       
      
      var cat_id= $('#store_staff1').attr('addon_id');
      
      var stores=$('.stores_all1').val();
        
        
        var ids=new Array();
        var selected_activities =$("[name='stores_all1[]']:checked");
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("store");
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
     	
			});
        
        
       var ids1=new Array();
        
       var $checks = $('.stores_all1');  
        
          var unchecked = $checks.not(':checked').map(function () {
          ids1.push(this.value);   
       }).get();
      
     
     $('.store_pop1').show();
      
     var datarp="set=set_cat_addon&cat_id="+cat_id+"&pref_in="+ids+"&pref_out="+ids1;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
            location.reload();
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


<div class="main_logout_popup_cc store_pop" style="display:none;">
    <div class="main_logout_popup" style="width: 750px !important;height: 350px !important">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">Select Category Items Preferences ?</h1>
                
                <div id="store_staff">
            
                    
                </div>
                
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 3px;"><a onclick="$('.store_pop').hide();" style="color:#AB2426 !important" href="#" class="">Exit</a></div>
                <div class="btn_logout_yes_no" style=" margin-top: 75px !important;"><a onclick="return pref_set();" href="#" class="">Submit</a></div>
            </div>
       </div>
     </div>


<div class="main_logout_popup_cc store_pop1" style="display:none;">
    <div class="main_logout_popup" style="width: 750px !important;height: 350px !important">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">Select Category Items Addons ?</h1>
                
                <div id="store_staff1">
            
                    
                </div>
                
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 3px;"><a onclick="$('.store_pop1').hide();" style="color:#AB2426 !important" href="#" class="">Exit</a></div>
                <div class="btn_logout_yes_no" style=" margin-top: 75px !important;"><a onclick="return addon_set();" href="#" class="">Submit</a></div>
            </div>
       </div>
     </div>

<div style="display:none" class="confrmation_overlay_proce"></div>
<style>
      .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
    </style>

</body>
</html>