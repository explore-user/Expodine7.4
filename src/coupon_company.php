<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=3;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_couponcompany WHERE cy_companyname = '" .$_REQUEST['id']."'");
// header("location:coupon_company.php?msg=1");
if (!headers_sent())
    {    
        header('Location: coupon_company.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="coupon_company.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=coupon_company.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['company']))
{
	
	$insertion['cy_companyname'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['company']);
    $insertion['cy_startdate']=$database->convert_date($_REQUEST['startdate']);
	
	if(isset($_REQUEST['active']))
	{
	 		$insertion['cy_active'] 		=  'Yes';
	}else
	{
	 		$insertion['cy_active'] 		=  'No';
	}
	$lastid='';
	//$insertion['cy_active']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['active']);
    $sql=$database->check_duplicate_entry('tbl_couponcompany',$insertion);
	 if($sql!=1)
	{
		 $sql_login  =  $database->mysqlQuery("select max(cy_coupid) as maxid  from tbl_couponcompany "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['maxid'] + 1;
			}
	  }else
	  {
		  $lastid=1;
	  }
	$insertion['cy_coupid'] 		= 	$lastid;
	$insertid              			=  $database->insert('tbl_couponcompany',$insertion);
	$database->updateexpodine_machines(); 
	 //add xml code starts
	 // $lastid=$insertion['cy_companyname'];
	/* $sql_login  =  $database->mysqlQuery("select cy_companyname from tbl_couponcompany where 	cy_companyname='".$insertion['cy_companyname']."'  AND vr_branchid='".$insertion['vr_branchid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['cy_companyname'];
			}*/
//				  $doc = new DOMDocument();
//				 // $doc->formatOutput = true;
//				//$doc->preserveWhiteSpace = true;
//				  $doc->load($_SESSION['s_xmlfilelocation']);
//				  $main = $doc->getElementsByTagName( "coupon" );
//				  $main2 = $doc->getElementsByTagName( "coup_".$lastid );
//				  if($main->length != 0 && $main2->length != 0) //already
//				  {  
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					   if($insertion['cy_companyname']=='')
//					  {
//				  	  	 $child = $xml->coupon[0]->addChild("coup_".$lastid," ");
//					  }else
//					  {
//						 $child = $xml->coupon[0]->addChild("coup_".$lastid,$insertion['cy_companyname']);
//					  }
//				  	//  $child = $xml->coupon[0]->addChild("coup_".$lastid,$insertion['cy_companyname']);
//					  /*$dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());*/
//					  $xml->asXML($_SESSION['s_xmlfilelocation']);
//				  }else // not exist
//				  {
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					  $eg=1;$ar=1;
//					  foreach ($xml->coupon as $lang) {
//						  if($lang["lang"]=="english")
//						  {
//							  $eg++;
//						  }
//						  if($lang["lang"]=="arabic")
//						  {
//							  $ar++; 
//						  }
//						  
//					  }
//					  if($eg==1)
//					  {
//					  $child = $xml->addChild("coupon");
//					  $child->addAttribute("lang", "english");
//					  }
//					  if($ar==1)
//					  {
//					 $child = $xml->addChild("coupon");
//					  $child->addAttribute("lang", "arabic");
//					  }
//					  
//					   if($insertion['cy_companyname']=='')
//					  {
//				  	  	 $child = $xml->coupon[0]->addChild("coup_".$lastid," ");
//					  }else
//					  {
//						 $child = $xml->coupon[0]->addChild("coup_".$lastid,$insertion['cy_companyname']);
//					  }
//					 // $child = $xml->coupon[0]->addChild("coup_".$lastid,$insertion['cy_companyname']);
//					 /* $dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());*/
//					  $xml->asXML($_SESSION['s_xmlfilelocation']);
//				  }
//		//add xml code ends
//        //excel code starts
//		$inputFileType = 'Excel5';
//		$inputFileName = $_SESSION['s_excelfilelocation'];
//		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
//		$objPHPExcel = $objReader->load($inputFileName);
//		
//		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
//			  $worksheetTitle     = $worksheet->getTitle();
//			  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
//			  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
//			  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
//			  if($worksheetTitle=="coupon")
//			  {
//				  $i=$highestRow + 1;
//				  $worksheet->setCellValue("A".$i, $lastid);
//				  $worksheet->setCellValue("B".$i, $insertion['cy_companyname']);
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
	
	//if($insertid=="")
//	 {
//		
//	
	?>
   <!-- <script>
	
	 $("#cpnedt").css("display","block");
	 </script>-->
     <?php
//   if(isset($_REQUEST['active']))
//	{
//	 	$actv		=  'Yes';
//	}else
//	{
//	 		$actv 		=  'No';
//	}
//	
//	$cmpny=$_REQUEST['company'];
//	$strt=$database->convert_date($_REQUEST['startdate']);
//	$query300=$database->mysqlQuery("update tbl_couponcompany set cy_active='$actv',cy_startdate='$strt' where cy_companyname='$cmpny'");
//	 if (!headers_sent())
//    {    
//        header('Location: coupon_company.php?msg=3');
//        exit;
//        }
//    else
//        {  
//        echo '<script type="text/javascript">';
//        echo 'window.location.href="coupon_company.php?msg=3";';
//        echo '<script>';
//        echo '<noscript>';
//        echo '<meta http-equiv="refresh" content="0;url=coupon_company.php?msg=3" />';
//        echo '</noscript>'; exit;
//    }
//		 
//	 }
//	 else
//	 {
		 
		 if (!headers_sent())
    {    
        header('Location: coupon_company.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="coupon_company.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=coupon_company.php?msg=2" />';
        echo '</noscript>'; exit;
    }
	 //}
	 }

	 //header("location: coupon_company.php?msg=2");
	
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['company1']))
{
	$id=$_REQUEST['compid'];
   // $date=$database->convert_date($_REQUEST['startdate1']);
	$dateOb=$database->convert_date($_REQUEST['startdate1']);	
	$newdate	= explode("-",$dateOb);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
	if(strlen($date) == '2') 
	{
		$dob11		= $year."-".$month."-".$date;
	}
	else
	{
	$dob11		= $date."-".$month."-".$year;
	}
	
	
	if(isset($_REQUEST['active1']))
	{
		$active='Yes';
	}
else 
{
	$active='No';
}
	$query3=$database->mysqlQuery("update tbl_couponcompany set cy_active='$active',cy_startdate='$dob11' where cy_companyname='$id'");
	//header("location: coupon_company.php?msg=3");
	
	$database->updateexpodine_machines(); 
	//update xml code starts
//		$doc = new DOMDocument();
//		$doc->load($_SESSION['s_xmlfilelocation']);
//		$items = $doc->getElementsByTagName( "coupon" );
//		  foreach($items as $item) { 
//			  if($item->childNodes->length) { 
//				  foreach($item->childNodes as $i) { 
//					  if($i->nodeName=="coup_".$id)
//					  {
//						   $i->nodeValue=$id;
//					  }
//				  } 
//			  } 
//		  } 
//	  $doc->save($_SESSION['s_xmlfilelocation']);
//	//update xml code ends	
//	//excel code starts
//		$inputFileType = 'Excel5';
//		$inputFileName = $_SESSION['s_excelfilelocation'];
//		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
//		$objPHPExcel = $objReader->load($inputFileName);
//		
//		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
//			  $worksheetTitle     = $worksheet->getTitle();
//			  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
//			  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
//			  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
//			  if($worksheetTitle=="coupon")
//			  {
//						  for ($row = 1; $row <= $highestRow; ++ $row) {
//							  for ($col = 0; $col < $highestColumnIndex; ++ $col) {
//								  $cell = $worksheet->getCellByColumnAndRow($col, $row);
//								  $val = $cell->getValue();
//								  $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//								  if($val==$id)
//								  {
//									  $worksheet->setCellValue("B".$row, $id);
//								  }
//							  }
//						  }
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
	if (!headers_sent())
    {    
        header('Location: coupon_company.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="coupon_company.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=coupon_company.php?msg=3" />';
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
<title>Coupon</title>
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
<script>

	$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
    $("#modal-17").removeClass('md-show');
    });


$(document).ready(function(){
$("#companys").focus();

	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_coup').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/coupon_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
 <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
    <script>
 $(document).ready(function() {
	  /* date picker */
  $("#startdate").datepicker({
      changeMonth: true,
      changeYear: true
    });
     $("#startdate1").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$("#startds").datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	/* auto complete */
  // companys     startds  statuss 
	$('#companys').autocomplete({source:'autocomplete/find_keywords.php?type=companys_c', minLength:1});
	$('#startds').autocomplete({source:'autocomplete/find_keywords.php?type=startds_c', minLength:1});
	$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_c', minLength:1});
	
	
	$('.ui-autocomplete').click( function() {
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
					<li><a style="cursor:pointer">Coupon</a></li>
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
                           		<span class="filte_new_text">Coupon Name</span>
                                <input type="text" class="form-control filte_new_box" id="companys" name="companys" placeholder="Coupon Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                <span class="filte_new_text">Start Date</span>
                                <input type="text" class="form-control filte_new_box" id="startds" name="startds" placeholder="Start Date" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                 <span class="filte_new_text">Select Active Status</span>
                                 <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                           
                  
                           
                            <div class="col-sm-2 nopadding" style="width:24.66666% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="coupon_company.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="cupncmpnyclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                 <th>Coupon Name</th>
       				<th>Start Date</th>
                                 <th>Active</th>   
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_couponcompany"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
	 ?>
    						<tr id="ids_<?=$result_login['cy_companyname']?>"  class="select">
                                <td><?=$result_login['cy_companyname']?></td>
                                <td><?=$result_login['cy_startdate']?></td>
                                  <td><?=$result_login['cy_active']?></td>
                                <td>
                                <a href="#" class="md-trigger_coup" id="ids_<?=$result_login['cy_companyname']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['cy_companyname']?>">
                           <!--      <a href="#" onClick="delete_confirm('<?=$result_login['cy_companyname']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
 <div class="md-modal md-effect-16" id="modal-17" >
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="coupon_company.php"  method="post"  name="coupon_company">
                                 <span id="cmpnychk" class="load_error alertsmaster" style="color:#F00" ></span>
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Coupon Name</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control companyname" id="company" name="company"  placeholder="Coupon Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Company Name"  ></div>
                               </div>
                                    	 <div class="first_form_contain">
                             	<div class="form_name_cc">Start Date</div>
                               	 <div class="form_textbox_cc" id="st_div">
                                <input type="text" class="form-control startdate" id="startdate" name="startdate"  placeholder="Start Date" tabindex="2"  data-toggle="tooltip" title="Start Date" ></div>
                               </div>
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" tabindex="3" name="active"  id="active" data-toggle="tooltip" title="Active">
                    </label>
                </div>              
                               </div>
                                  </div>
                                  <div id="cpnedt" style="display:none">
                                    <a href="#" onClick="update_confirm('1')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                    </div>
                                  </form> 
                    </div>
                                  
                             <a href="#"><button class="md-close" tabindex="5">Close</button></a>
                             
                               <a  href="#" class="entersubmit" onClick="validate_coupn()" tabindex="4"><button class="md-save">Save</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">

$(".add_btn_2").click(function()
{

	//alert("hiii");
$("#company").focus();
});
	
        $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function cupncmpnyclr()
{
	$("input[type=checkbox]").each(function() { this.checked=false; });
	document.getElementById('company').value = '';
		document.getElementById('startdate').value = '';
     	$('#cmpnychk').text('');
		$("#menumaincategory_div").removeClass("has-error");
	
}

function validate_all()
{
		 var a=$("#company").val().trim();
		
		var b=$("#startdate").val().trim();
	
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcmpny&mid="+a+"&strtdate="+b,
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#cmpnychk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		 $("#cpnedt").css("display","block");
		// $('.mynewpopupload').css("display","block"); 
		   $("#menumaincategory_div").addClass("has-error");
	  $("#company").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	 // 	document.coupon_company.submit();

			}
			}
		});
	
	
	
}
		function validate_coupn()
			{
			 if(validate_company())
				{
					if(validate_strt())
					{
					/*	if(validate_all())
						{
						}*/
				document.coupon_company.submit();
					}
				}
			}
		function validate_company()   
			{
				if($(".companyname").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
						  document.coupon_company.company.focus();
                                                  alert("Enter Company Name");
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#company").val())){
                                 $("#menumaincategory_div").addClass("has-error");
                                  document.coupon_company.company.focus();
                                           alert("Special charecter Not Allowed.");
                              }
                                  else
					 {
						 var a=document.getElementById("company").value;
						 $("#menumaincategory_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			} 
			function validate_strt()   
			{
				if($("#startdate").val()=="")
				{
					$("#st_div").addClass("has-error");
						  document.coupon_company.startdate.focus();
                                                  alert("Select Start Date");
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#startdate").val())){
                                 $("#st_div").addClass("has-error");
                                 document.coupon_company.startdate.focus();
                                           alert("Special charecter Not Allowed.");
                              }
                                else
					 {
						 $("#st_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="coupon_company.php?id="+id+"&delete=yes";
	}
}
function update_confirm(id)
{
	var check = confirm("Are you sure you want to update the start date?");
	if(check==true)
	{
		window.location="coupon_company.php?id="+id+"&update=yes";
	}
}		
</script>
<script type="text/javascript">
function validateSearch()
{// companys     startds  statuss 
var companys=$("#companys").val();
  if(companys=="")
  {
	  companys="null";
  }
  var startds=$("#startds").val();
  if(startds=="")
  {
	  startds="null";
  }
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }	
    $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchcompany&companys="+companys+"&startds="+startds+"&statuss="+statuss,
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