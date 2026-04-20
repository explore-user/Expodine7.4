<?php 

//error_reporting(0);
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=30;

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['amcname']))
{
	
	$insertion['amc_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['amcname']));
        $insertion['amc_value']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['amcvalue']));
        $insertion['amc_label']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['amclabel']));
	$insertion['amc_symbol']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['amcsymbol']));
        $insertion['amc_unit']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        if(isset($_REQUEST['amcactive']))
	{
	 		$insertion['amc_active'] 		=  'Y';
	}else
	{	 	
		$insertion['amc_active'] 		=  'N';
	}
        
        if(isset($_REQUEST['tax_active']))
	{
	 		$insertion['amc_item_tax'] 		=  'Y';
	}else
	{	 	
		$insertion['amc_item_tax'] 		=  'N';
	}
        
         if(isset($_REQUEST['tax_cs']))
	{
	 		$insertion['amc_enable_cs'] 		=  'Y';
	}else
	{	 	
		$insertion['amc_enable_cs'] 		=  'N';
	}
        
         if(isset($_REQUEST['tax_ta']))
	{
	 		$insertion['amc_enable_ta'] 		=  'Y';
	}else
	{	 	
		$insertion['amc_enable_ta'] 		=  'N';
	}
        
         if(isset($_REQUEST['tax_hd']))
	{
	 		$insertion['amc_enable_hd'] 		=  'Y';
	}else
	{	 	
		$insertion['amc_enable_hd'] 		=  'N';
	}
        
        
   
	$insertid              			=  $database->insert('tbl_extra_tax_master',$insertion);
        
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
    if (!headers_sent())
    {    
        header('Location: extra_tax.php?msg=2');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="extra_tax.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=extra_tax.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['amcname1']))
{
        if(isset($_REQUEST['amcactive1']))
	{
		$active='Y';
	}
        else 
         {
            
	       $active='N';
        }
         if(isset($_REQUEST['tax_active1']))
	{
		$active_tax='Y';
	}
        else 
        {
	   $active_tax='N';
        }
        
          if(isset($_REQUEST['tax_cs1']))
	{
		$active_tax_cs='Y';
	}
        else 
         {
	       $active_tax_cs='N';
        }
        
          if(isset($_REQUEST['tax_ta1']))
	{
	         $active_tax_ta='Y';
	}
        else 
         {
	       $active_tax_ta='N';
        }
        
        if(isset($_REQUEST['tax_hd1']))
	{
		$active_tax_hd='Y';
	}
        else 
         {
	        $active_tax_hd='N';
        }
        
        
        $unit=$_REQUEST['unit_type_edit'];
        $id=$_REQUEST['amcid1'];
        $taxlabel=$_REQUEST['amclabel1'];
        $taxname=$_REQUEST['amcname1'];
        $taxvalue=$_REQUEST['amcvalue1'];
        $taxsymbol=$_REQUEST['amcsymbol1'];
        
        
                $query3=$database->mysqlQuery("update tbl_extra_tax_master set amc_name='$taxname',amc_value='$taxvalue',amc_label='$taxlabel',"
                . " amc_active='$active',amc_symbol='$taxsymbol',amc_unit='$unit',amc_item_tax='$active_tax',amc_enable_cs='$active_tax_cs',"
                . " amc_enable_ta='$active_tax_ta',amc_enable_hd='$active_tax_hd' where amc_id='$id'");
                
            $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
                
                

 if (!headers_sent())
    {    
        header('Location: extra_tax.php?msg=3');
        exit;
   }
   else
   {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="extra_tax.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=extra_tax.php?msg=3" />';
        echo '</noscript>'; exit;
    }
        
        
   }

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
<!DOCTYPE html>
<html><head>
<meta charset="utf-8">
<title>Tax</title>
<meta name="description" content="">
<link href="img/favicon.ico" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
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
<link rel="stylesheet" href="css/tabs_cont_2.css">
<link rel="stylesheet" href="css/menu_new_22.css">
<style>
#container{overflow:auto !important; }
#ascrail2002{z-index: 9999999999999999999 !important;left:0px !important } 
.tabs li a{width: 49.8% !important;  background-color: rgba(0, 0, 0, 0.8);  margin: 0 0.1%;}
.tabs li a:hover{background-color: rgb(163, 68, 0)}
.tabs li.current a{background-color:rgb(163, 68, 0)}
.md-content{display:inline-block;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{height: 65vh;min-height:410px;}
.text_displaying_contain{  padding-bottom: 0;margin-bottom:0;}
.master_page_tab_cc{min-height: 400px;height: 75vh;overflow:hidden;}
#left_table_scr_cc{min-height: 400px;height: 71vh;}
.tablesorter thead th{border-top:0;}
.master_page_tab_cc {height: 91vh;}
#left_table_scr_cc{height: 81vh;}
.tablesorter tbody {height: 75vh;}
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
.navbar-inner{z-index: 999999 !important;}
</style>
<script src="js/jquery-1.10.2.min.js"></script>

  <script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
<script>

	$(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)
		
		  $("#modal-16").removeClass('md-show');
	});




$(document).ready(function(){


	
	$(".enter").keypress(function(event){
		alert("hiiii");

    if(event.keyCode==13){
     validate_registration();
    }
	});

	$("#extrataxs").focus();

	$("#add_tax_master").click(function()
	{
		$("#amcname").focus();
	});

	$('.md-trigger_tax').click( function() {
		
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/extra_tax_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){ //mname mcate msubc mdiet mstatus
		$('#extrataxs').autocomplete({source:'autocomplete/find_keywords.php?type=extrataxs_e', minLength:1});
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

});
</script>
<!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
 <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<!--<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>-->
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE --> 	    
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
	.has-error{border:solid 1px #f00;
	box-shadow:0 0 3px #f00;
	-moz-box-shadow:0 0 3px #f00;
	-webkit-box-shadow:0 0 3px #f00;
	outline:none !important;
	} 
.form-control:focus	{}	
.has-error:focus{border:solid 1px #f00;
	box-shadow:0 0 3px #f00;
	-moz-box-shadow:0 0 3px #f00;
	-webkit-box-shadow:0 0 3px #f00;
	outline:none !important;
	} 	
.md-content > div{padding:0px 10px 4px 5px;}
</style>
</head>
<body>

<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">

<?php include "includes/topbar_master.php"; ?>
  <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div  style="top: 58px;" id="container">
        
        <div class="breadcrumbs">
        
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer"> TAX MASTER</a></li>
                                        <?php if(isset($_REQUEST['msg'])){ ?>
                                        <div class="load_error alertsmasters"><?=$alert?></div>
			                <script >
                                        $(".load_error").delay(2000).fadeOut('slow');
                                       </script>
                                       <?php } ?>
                    <span id="ratechange" class="load_error alertsmaster" style="color:#F00" ></span>  
				</ul>
            
                
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                
                 <!-- box head -->
                 <div class="main_cc">
                   
                   <h3 style="background: #fff;margin-bottom: 0;padding: 13px;">TAX MASTER
                       
                        <a style="display: none;float:right;border: solid 2px;font-size: 15px;padding: 3px;font-weight: bold;border-radius: 5px " href="extra_tax.php">REFRESH</a>
                       
                        <?php if(in_array("floor_master", $_SESSION['menusubarray'])) { ?>  
                        <a style="display: none;float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;margin-right: 30px;border-radius: 5px  " href="floor_master.php">APPLY TO FLOOR</a>
                        
                        <?php }  if(in_array("online_partners", $_SESSION['menusubarray'])) { ?>  
                        
                        <a style="display: none;float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;;margin-right: 30px;border-radius: 5px  " href="online_partners.php">APPLY TO ONLINE PARTNER</a>
                       
                        <?php } ?>  
                      
                   
                   </h3>
                    <div class="cc_new_main">
                        
<!--                    	<div style="">
                     <div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?//php  include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div>cc_new-->
                    
                    </div>
                     
                    </div>
                	<div class="col-lg-12 col-md-12 middle_container nopadding">
                    	<div style="padding:0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!--left_container-->
                        	<div class="col-lg-12 col-md-12 min-height nopadding">
                            	<div class="text_displaying_contain">
 										<div class="master_page_tab_cc">
                                        	<div class="menu_top_filter_left" style="border-bottom: 3px #BEBEBE solid !important;">
                                                 <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                                <div class="col-sm-5" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width: 23%;">
                                                    <p class="menu_filter_txt">Name</p>
                                                    <input onclick="this.removeAttribute('readonly')" readonly style="height: 30px;" type="text" tabindex="1" name="extrataxs" id="extrataxs" class="form-control" placeholder="Name" onKeyUp="validateSearch()">
                                                </div>
                                                     
                                                     <div class="col-sm-5" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width: 15%;">
                                                     <p class="menu_filter_txt">Item Tax</p>
                                                     <select tabindex="2" id="tax_type" name="unit_type_edit" class="form-control" onchange="validate_tax()">
                                                          <option value="" >Select</option>
                                                          <option value="Y" >Active</option>
                                                          <option value="N">Inactive</option>
                                                           </select>
                                                    
                                                        </div>
                                              
                                                <div class="col-sm-2 nopadding" style="width:10%">
                                                    <p class="menu_filter_txt">&nbsp;</p>
<!--                                                    <div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#">Search</a>
                                                    </div>-->
                                                </div>
                                </div><!--form_group-->
                    
                    
                    
                    	
                    </div><!---menu_top_filter_left--->
                    
                    <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_tax_master" class="md-trigger add_btn_2" data-modal="modal-16" onClick="taxclr()" ></a>
                      </div>  
                   </div>
                   			<div class="col-lg-12 col-md-12 no-padding">
                                       <div id="left_table_scr_cc" > 
                                            <table class="responstable tablesorter table_report" id="listall">
                                               <thead>
                                                  <tr>
                                                    <th width="10%">Action</th>
                                                    <th width="5%">SL </th>
                                                    <th width="17%">Name</th>
                                                    <th width="8%">Unit</th>
                                                     <th width="10%">Item Tax </th>
                                                      <th width="10%">Value</th>
                                                      <th width="10%">Label</th>
                                                     <th width="10%">Active</th>
                                                   <th width="4%">Sign</th>
                                                    <th width="5%">CS </th>
                                                     <th width="5%">TA </th>
                                                      <th width="5%">HD </th>
                                                        <th width="10%">Action </th>
                                                  </tr>
                                              </thead>                                    		
                                              
                                             <?php
                                             
	 $sql_login  =  $database->mysqlQuery("select * from tbl_extra_tax_master"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      if($result_login['amc_active']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}
                                
                        if($result_login['amc_enable_cs']=="Y")
				{
				
					$activecs="Yes";
				}else 
				{
					$activecs="No";
				}
                                
                                  if($result_login['amc_enable_ta']=="Y")
				{
				
					$activeta="Yes";
				}else 
				{
					$activeta="No";
				}
                                
                                  if($result_login['amc_enable_hd']=="Y")
				{
				
					$activehd="Yes";
				}else 
				{
					$activehd="No";
				}
                                
	             ?>
    				<tr id="ids_<?=$result_login['amc_id']?>"  class="select">
                                <td  width="10%"><a href="#" class="tab_edt_btn md-trigger_tax" id="ids_<?=$result_login['amc_id']?>" ><i class="fa fa-edit"></i></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['amc_id']?>">
                                </td>
                                <td width="5%"><?=$i++?></td>
                                <td width="17%"><?=$result_login['amc_name']?></td>
                                <td width="8%"><?=$result_login['amc_unit']?></td>
                                <td width="10%"><?=$result_login['amc_item_tax']?></td>
                                <td width="10%"><?=$result_login['amc_value']?></td>
                                <td width="10%"><?=$result_login['amc_label']?></td>
                                <td width="10%"><?=$active?></td>
                                <td width="4%"><?=$result_login['amc_symbol']?></td>
                                
                                <td width="5%"><?=$activecs?></td>
                                <td width="5%"><?=$activeta?></td>
                                <td width="5%"><?=$activehd?></td>
                                <td  width="10%">
                                    
                                <?php if($result_login['amc_item_tax']!='Y' && $_SESSION['expodine_id']=='admin'){ ?>    
                                    
                                    <a style="margin-bottom: 8px;font-weight: bold;
                                       border:solid 1px;width: 25px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn" onclick="tax_apply('<?=$result_login['amc_id']?>','DI','<?=$result_login['amc_name']?>')" >
                                DI</a>
                                    
                                <a style="font-weight: bold;margin-bottom: 8px;border:solid 1px;width: 25px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn " onclick="tax_apply('<?=$result_login['amc_id']?>','TA','<?=$result_login['amc_name']?>')" >
                                TA</a>   
                                    
                                <?php }else{ ?>  
                                    
                                    <span title="ITEM TAX NOT POSSIBLE . ADMIN ONLY PRIVELEGE" style="font-weight: bold;margin-bottom: 8px;border:solid 1px;width: 56px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn " >
                                  X</span>
                                    
                                    
                                 <?php } ?>    
                                    
                                </td>
                              </tr>
                               
                              <?php } } ?>  
                                              
                                          </table>
                   					</div><!--left_table_scr_cc-->
                                </div><!--col-->
                                
                                    
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
					
		</div>
	</div>
</div>
</div><!--container-->
</div>
</div>
</div>
<!--  add starts -->
<div class="md-modal md-effect-16" id="modal-16" style="width:600px;top:10%;">
 	<form role="form" action="extra_tax.php"  method="post"  name="extra_tax">
			<div style="width:600px;" class="md-content">
				<h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
                                <span style="float: left;width: 100%;height: 20px"><strong style="color:red" id="error_msg_tax"></strong></span> 
				<div>
                    <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom: 5px;">
                    	<span id="extrastatus" class="load_error alertsmaster" style="color:#F00" ></span>
                       	<div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc" >Name <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcname_div">
                                 <input onkeyup="tax_in()" type="text" tabindex="1" class="form-control amcname" autofocus placeholder="Name" id="amcname" name="amcname"></div>
                        </div>
                        <div class="first_form_contain" style="width:49%;margin-left:1%">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Value  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcvalue_div">
                                 <input  tabindex="2" type="text" onkeypress="return numdot(event);" class="form-control" placeholder="Value" id="amcvalue" name="amcvalue"></div>
                        </div>
                         <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Label  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amclabel_div">
                                 <input tabindex="3" type="text" class="form-control" placeholder="Label" id="amclabel" name="amclabel"></div>
                        </div>
                    <label>
                        <input type="hidden" value="2" tabindex="5" name="amcactive"  id="amcactive" data-toggle="tooltip" title="Active">
                        
                    </label>
                        
                        
                        <div class="first_form_contain" style="width:49%;margin-left:">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Unit  <span style="color:#F00"> *</span></div>
                             <div class="form_textbox_cc" id="amcsymbol_div">
                                 <select tabindex="4" id="unit_type" name="unit_type" class="form-control">
                                     <option value="P">%</option>
                                     <option value="V">V</option>
                                 </select></div>
                        </div>
                       
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Item Tax   <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input tabindex="5" type="checkbox" value=""  name="tax_active"  id="tax_active" data-toggle="tooltip" title="active" onclick="return taxchange();" >
                        </div>
                        </div>
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">CS   <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input checked tabindex="6" type="checkbox" value=""  name="tax_cs"  id="tax_cs" data-toggle="tooltip" title="active"  >
                        </div>
                        </div>
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">TA   <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input checked tabindex="7" type="checkbox" value=""  name="tax_ta"  id="tax_ta" data-toggle="tooltip" title="active"  >
                        </div>
                        </div>
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">HD<span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input checked tabindex="8" type="checkbox" value=""  name="tax_hd"  id="tax_hd" data-toggle="tooltip" title="active"  >
                        </div>
                        </div>
                        <div class="first_form_contain" style="width:49%;display:none" id="amcsymbol_div_1" >
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Symbol  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcsymbol_div" >
                                 <input type="text" class="form-control" placeholder="Sybmol" onkeyup="symbol_in();" id="amcsymbol" name="amcsymbol" autocomplete="off"  onchange="valisymbol()"></div>
                        </div>
                        
                    </div>
                  <a href="#" class="enter" onClick="validate_registration()" tabindex="9"><span class="md-save newbut">Save</span></a>
                              
				</div>
                </div>
			
            </form>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<script type="text/javascript">

function tax_in(){
    
    $('#amclabel').val($('#amcname').val());
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



  function numdot(item,evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 


function symbol_in(){

var syb= $("#amcsymbol").val();
if(syb=='<'|| syb=='>' || syb=='"' || syb=="'" ){
    $("#amcsymbol").val('');
       $('#error_msg_tax').css("display", "block");
	$('#error_msg_tax').text('This symbol cant be added');	
	$("#error_msg_tax").delay(1500).fadeOut('slow');
}

}

function taxclr()
{
	//$("input[type=checkbox]").each(function() { this.checked=false; });
	        document.getElementById('amcname').value = '';
		document.getElementById('amclabel').value = '';
                document.getElementById('amcvalue').value = '';
		document.getElementById('amcsymbol').value = '';
                $('#extrastatus').text('');
		$("#amcname_div").removeClass("has-error");
		$("#amclabel_div").removeClass("has-error");
                $("#amcvalue").removeClass("has-error");
                $("#amcsymbol").removeClass("has-error");
			    
}
    function validate_all()
{
	var ab=$("#amcname").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkextra&mid="+ab,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#extrastatus');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Tax Name Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
		// namechk.text('Tax Name Already exists');
	          $("#amcname_div").addClass("has-error");
	        $("#amcname").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
	   $("#amcname_div").removeClass("has-error");
	   $("#amcname_div").addClass("has-success");
	document.extra_tax.submit();
			}
			}
		}); 

	
}

function validate_registration()
			{
                            if(validate_name())
				  {
                            
                                    
                            
                                       if(validate_value())
				  {
                                     
                                      if(validate_lable())
				{
                                 
                                    if(validate_all())
				{
                                }
                               
			
                                    
                              }
                             }
					
		          }
                      }


function validate_name()   
			{
				if($(".amcname").val()=="")
				{
					$("#amcname_div").addClass("has-error");
				
						  document.extra_tax.amcname.focus();
                                                //  alert("Enter Name");
                                                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                             
                                      else
					 {
						 var a=document.getElementById("amcname").value;
						 $("#amcname_div").removeClass("has-error");
					          $(this).addClass("has-success");
						 return true;
					 }
                                     }
                                     
                                     
          function validate_value()
                        {
                            if ($("#amcvalue").val() == "")
                            {
                                $("#amcvalue_div").addClass("has-error");
                                document.extra_tax.amcvalue.focus();
                               // alert("Enter Value")
                               $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            } 
                           
                         
                            else
                                {
                                    
                                    return true;
                                }
                            
                        
                    }
                    
                 function validate_lable()   
			{ if ($("#amclabel").val() == "")
                            {
                                $("#amclabel_div").addClass("has-error");
                                document.extra_tax.amclabel.focus();
                               // alert("Enter Label")
                               $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Label');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            } 
                           
                         
                            else
                                {
			 return true;	  
                                 }
                             }        
                           function validate_symbol()   
			{ 
                             return true;
				
                                     }  
                                     
                                     
     function valisymbol()
      {
          
         
          
	if ($("#amcsymbol").val() == "<" || $("#amcsymbol").val() == ">" || $("#amcsymbol").val() == "!" || $("#amcsymbol").val() == "'" || $("#amcsymbol").val() == '"')
                            {  //alert('This symbol Cant be used');
                                // $("#amcsymbol").focus();
						
					return false;
                                     }else{
						 return true;
                                     }
	
                               
      }                                    


function validateSearch()
{//Extra Tax 
	 var extrataxs=$("#extrataxs").val();
          var tax_type=$("#tax_type").val();
  if(extrataxs=="")
  {
	  extrataxs="null";
  }
  if(tax_type=="")
  {
	  tax_type="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchextratax&extrataxs="+extrataxs+"&tax_type="+tax_type,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}


function validate_tax()
{//Extra Tax 
     var extrataxs=$("#extrataxs").val();
	 var tax_type=$("#tax_type").val();
  if(extrataxs=="")
  {
	  extrataxs="null";
  }
  if(tax_type=="")
  {
	  tax_type="null";
  }

	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchextratax&extrataxs="+extrataxs+"&tax_type="+tax_type,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}

function taxchange(){
    
    var sts=$('#tax_active').val();
   
    
    if(document.getElementById('tax_active').checked) {
   $('#amcsymbol_div_1').show();
} else {
  $('#amcsymbol_div_1').hide();
}
    
    
}


function tax_apply(id,mode,name){
    
    $('#add_stock_pop').show(); 
    
   
    
    
    $('#add_stock_pop').attr('tax_id',id);
    
    $('#head_tax').text(name);
    
    if(mode=='DI'){
        
         $('#add_stock_pop').addClass('disablegenerate'); 
        
        $('#di_div').show();  
        $('#ta_div').hide();  
        
        var data="set=check_tax_apply&taxid="+id+"&mode=DI";
     
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: data,
        success: function(data)
        {
          
            
           $(".floors").prop("checked", false); 
           
           var str = $.trim(data);

           var arr = str.split(",");

          $.each(arr, function(index, value){
              
               $("#floors_"+value).prop("checked", true);
          });
          
           $('#add_stock_pop').removeClass('disablegenerate'); 
          
          
        }
        });
        
        
    }else{
        
         $('#add_stock_pop').addClass('disablegenerate'); 
        
        $('#ta_div').show();  
        $('#di_div').hide();  
        
        var data="set=check_tax_apply&taxid="+id+"&mode=TA";
     
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: data,
        success: function(data)
        {
           
           $(".partners").prop("checked", false); 
           
           var str = $.trim(data);

           var arr = str.split(",");

          $.each(arr, function(index, value){
              
               $("#partners_"+value).prop("checked", true);
          });
          
            $('#add_stock_pop').removeClass('disablegenerate'); 
            
        }
        });
         
    }
     
}


function go_tax(mode){ 
  
    var taxid= $('#add_stock_pop').attr('tax_id');
    
    if(mode=='DI'){
      
    var checkedCount = $(".floors:checked").length;

    if(checkedCount != 0){
      
    $(".floors:checked").each(function(){
        
     var floor= $(this).val();  
    
            $('.alert_error_popup_all_in_one').show();
                                    
            $('.alert_error_popup_all_in_one').text('TAX APPLIED');
            $('.alert_error_popup_all_in_one').delay(1500).fadeOut('slow');
            
        var data="set_floor_add_new=floor_add_new&floor_id_add="+floor+"&floor_tax_add="+taxid;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_add.php",
        data: data,
        success: function(data)
        {
            setTimeout(function(){

             location.reload();

            }, 1200); 
       
        }
    
     }); 
     
    
     
     });
     
      }else{
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('SELECT FLOORS');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
     }
    
     
     }
        
       if(mode=='TA'){
           
    var checkedCount1 = $(".partners:checked").length;

    if(checkedCount1 != 0){
      
    $(".partners:checked").each(function(){
        
     var partners= $(this).val();    
           
            $('.alert_error_popup_all_in_one').show();
                                    
            $('.alert_error_popup_all_in_one').text('TAX APPLIED');
            $('.alert_error_popup_all_in_one').delay(1500).fadeOut('slow');
            
        var data="set_floor_add_new=floor_add_new&floor_id_add="+partners+"&floor_tax_add="+taxid;
     
        $.ajax({
        type: "POST",
        url: "load_takeaway.php",
        data: data,
        success: function(data)
        {
           setTimeout(function(){
         
                location.reload();

          }, 1200); 
        }
        }); 
          
          });
     
      }else{
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('SELECT PARTNERS');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
     }
     
    }  
        
        
      
}


</script>


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>


<style>
    .disablegenerate { pointer-events: none; opacity: 0.9; cursor:none;}
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:350px;height:390px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd"> <span id="head_tax"></span> 
        <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        
        <div class="stok_add_popup_cnt" id="di_div" style="display:none">
            <span style="font-size:15px;font-weight: bold;color: darkred">DINE IN FLOORS</span> <br>
            
           <?php $sql_login = $database->mysqlQuery("select * from tbl_floormaster ");
            $num_login = $database->mysqlNumRows($sql_login);
            if ($num_login) {
                while ($result_login = $database->mysqlFetchArray($sql_login)) { 
            
            
            ?>
            
            
         <?=$result_login['fr_floorname'] ?>  <input value="<?=$result_login['fr_floorid']?>" style="width:15px;height: 13px" type="checkbox" class="stock_add_txtbx floors" id="floors_<?=$result_login['fr_floorid']?>" > <br>
            
            <?php  } } ?>
            
         <a style="margin-top: 155px;" onclick="go_tax('DI');" href="#"><div style="margin-top: 155px;" class="stock_add_btn">APPLY</div></a>
            
        </div>
        
          <div class="stok_add_popup_cnt" id="ta_div" style="display:none">
              <span style="font-size:15px;font-weight: bold;color: darkred">TAKEAWAY PARTNERS</span> <br>
            <?php $sql_login = $database->mysqlQuery("select * from tbl_online_order  ");
            $num_login = $database->mysqlNumRows($sql_login);
            if ($num_login) {
                while ($result_login = $database->mysqlFetchArray($sql_login)) { ?>
            
              <?= $result_login['tol_name'] ?>  <input value="<?=$result_login['tol_id']?>" style="width:15px;height: 13px" type="checkbox" class="stock_add_txtbx partners" id="partners_<?=$result_login['tol_id']?>" > <br>
            
            <?php } } ?>
            
         <a style="margin-top: 135px;"  onclick="go_tax('TA');" href="#"><div style="margin-top: 135px;" class="stock_add_btn">APPLY</div></a>
            
        </div>
        
        
        
    </div>
   </div>



</body>
</html>