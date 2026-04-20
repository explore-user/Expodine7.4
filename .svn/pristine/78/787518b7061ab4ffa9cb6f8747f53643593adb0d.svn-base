<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=3;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_vouchermaster WHERE vr_voucherid = '" .$_REQUEST['id']."'");
 //header("location:voucher_master.php?msg=1");
  	 if (!headers_sent())
    {    
        header('Location: voucher_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vouchername']))
{
    $br="1";
	$insertion['vr_voucherfrom']	=$database->convert_date($_REQUEST['voucherfrom']);
	$insertion['vr_voucherexpiry']	=$database->convert_date($_REQUEST['voucherexpiry']);
	$insertion['vr_vouchername'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['vouchername']);
	$insertion['vr_branchid']		= mysqli_real_escape_string($database->DatabaseLink,$br);
	$insertion['vr_vouchercost']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['vouchercost']);
	$insertion['vr_voucherholder']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucherholder']);
	$insertion['vr_holdercontact']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucherholdercontact']);
	if(isset($_REQUEST['active']))
	{
	 		$insertion['vr_active'] 		=  'Yes';
	}else
	{
	 		$insertion['vr_active'] 		=  'No';
	}
    $sql=$database->check_duplicate_entry('tbl_vouchermaster',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_vouchermaster',$insertion);
	$database->updateexpodine_machines(); 
        //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select vr_voucherid from tbl_vouchermaster where 	vr_vouchername='".$insertion['vr_vouchername']."'  AND vr_branchid='".$insertion['vr_branchid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['vr_voucherid'];
			}
//				  $doc = new DOMDocument();
//				 // $doc->formatOutput = true;
//				//$doc->preserveWhiteSpace = true;
//				  $doc->load($_SESSION['s_xmlfilelocation']);
//				  $main = $doc->getElementsByTagName( "voucher" );
//				  $main2 = $doc->getElementsByTagName( $lastid );
//				  if($main->length != 0 && $main2->length != 0) //already
//				  {  
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					   if($insertion['vr_vouchername']=='')
//					  {
//						 $child = $xml->voucher[0]->addChild($lastid," ");
//					  }else
//					  {
//						   $child = $xml->voucher[0]->addChild($lastid,$insertion['vr_vouchername']);
//					  }
//				  	 // $child = $xml->voucher[0]->addChild($lastid,$insertion['vr_vouchername']);
//					  $dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());
//					  $xml->asXML($_SESSION['s_xmlfilelocation']);
//				  }else // not exist
//				  {
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					  $eg=1;$ar=1;
//					  foreach ($xml->voucher as $lang) {
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
//					  $child = $xml->addChild("voucher");
//					  $child->addAttribute("lang", "english");
//					  }
//					  if($ar==1)
//					  {
//					  $child = $xml->addChild("voucher");
//					  $child->addAttribute("lang", "arabic");
//					  }
//					  
//					   if($insertion['vr_vouchername']=='')
//					  {
//						 $child = $xml->voucher[0]->addChild($lastid," ");
//					  }else
//					  {
//						   $child = $xml->voucher[0]->addChild($lastid,$insertion['vr_vouchername']);
//					  }
//					  
//					  $dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());
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
//			  if($worksheetTitle=="voucher")
//			  {
//				  $i=$highestRow + 1;
//				  $worksheet->setCellValue("A".$i, $lastid);
//				  $worksheet->setCellValue("B".$i, $insertion['vr_vouchername']);
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
        }
	// header("location: voucher_master.php?msg=2");
	 if (!headers_sent())
    {    
        header('Location: voucher_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vouchername1']))
    {
	if(isset($_REQUEST['active1']))
	{
		$active='Yes';
	}
else 
{
	$active='No';
}

	$id=$_REQUEST['voucherid'];
	//$voucherfrom=$database->convert_date($_REQUEST['voucherfrom1']);
//	$voucherexpiry=$database->convert_date($_REQUEST['voucherexpiry1']);
	$dateOb=$database->convert_date($_REQUEST['voucherfrom1']);	
	$newdate	= explode("-",$dateOb);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
	if(strlen($date) == '2') 
	{
		$voucherfrom		= $year."-".$month."-".$date;
	}
	else
	{
	$voucherfrom		= $date."-".$month."-".$year;
	}
	
	$dateObj=$database->convert_date($_REQUEST['voucherexpiry1']);	
	$newdate1	= explode("-",$dateObj);
	$date1		= $newdate1[0];
	$month1		= $newdate1[1];
	$year1		= $newdate1[2];
	if(strlen($date1) == '2') 
	{
		$voucherexpiry		= $year1."-".$month1."-".$date1;
	}
	else
	{
	$voucherexpiry		= $date1."-".$month1."-".$year1;
	}
	$voucher=$_REQUEST['vouchername1'];
    $branch="1";
	$cost=$_REQUEST['vouchercost1'];
	$holder=$_REQUEST['voucherholder1'];
	$contact=$_REQUEST['voucherholdercontact1'];
	$query3=$database->mysqlQuery("update tbl_vouchermaster set vr_vouchername='$voucher',vr_branchid='$branch', vr_active='$active',vr_vouchercost='$cost',vr_voucherholder='$holder',vr_holdercontact='$contact',vr_voucherexpiry='$voucherexpiry',vr_voucherfrom='$voucherfrom' where vr_voucherid='$id'");
	$database->updateexpodine_machines(); 
//update xml code starts
//		$doc = new DOMDocument();
//		$doc->load($_SESSION['s_xmlfilelocation']);
//		$items = $doc->getElementsByTagName( "voucher" );
//		  foreach($items as $item) { 
//			  if($item->childNodes->length) { 
//				  foreach($item->childNodes as $i) { 
//					  if($i->nodeName==$id)
//					  {
//						   $i->nodeValue=$voucher;
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
//			  if($worksheetTitle=="voucher")
//			  {
//						  for ($row = 1; $row <= $highestRow; ++ $row) {
//							  for ($col = 0; $col < $highestColumnIndex; ++ $col) {
//								  $cell = $worksheet->getCellByColumnAndRow($col, $row);
//								  $val = $cell->getValue();
//								  $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//								  if($val==$id)
//								  {
//									  $worksheet->setCellValue("B".$row, $voucher);
//								  }
//							  }
//						  }
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
		
//header("location: voucher_master.php?msg=3");
 if (!headers_sent())
    {    
        header('Location: voucher_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_master.php?msg=3" />';
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
<title>Voucher</title>
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
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/voucher_edit.php", {menu:menuid},
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
  $("#voucherfrom").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#voucherexpiry").datepicker({
      changeMonth: true,
      changeYear: true
    }); 
	$("#froms").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#expirys").datepicker({
      changeMonth: true,
      changeYear: true
    });
	/* auto complete */

	$('#vochrs').autocomplete({source:'autocomplete/find_keywords.php?type=vochrs_v', minLength:1});
	/*$('#froms').autocomplete({source:'autocomplete/find_keywords.php?type=froms_v', minLength:1});
	$('#expirys').autocomplete({source:'autocomplete/find_keywords.php?type=expirys_v', minLength:1});
	$('#costs').autocomplete({source:'autocomplete/find_keywords.php?type=costs_v', minLength:1});
	$('#holders').autocomplete({source:'autocomplete/find_keywords.php?type=holders_v', minLength:1});
	$('#contacts').autocomplete({source:'autocomplete/find_keywords.php?type=contacts_v', minLength:1});
	$('#branchs').autocomplete({source:'autocomplete/find_keywords.php?type=branchs_v', minLength:1});*/
	$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_v', minLength:1});
	
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
					<li><a style="cursor:pointer">Voucher</a></li>
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
                            	<span class="filte_new_text">Voucher Name</span>
                                <input type="text" class="form-control filte_new_box" id="vochrs" name="vochrs" placeholder="Voucher Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%">
                             	<span class="filte_new_text">From</span>
                                <input type="text" class="form-control filte_new_box" id="froms" name="froms" placeholder="From" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%">
                            	<span class="filte_new_text">Expiry</span>
                                <input type="text" class="form-control filte_new_box" id="expirys" name="expirys" placeholder="Expiry" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" onChange="validateSearch()">
                            </div>
                            <!-- <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                                <input type="text" class="form-control" id="costs" name="costs" placeholder="Cost" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                                <input type="text" class="form-control" id="holders" name="holders" placeholder="Holder" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                                <input type="text" class="form-control" id="contacts" name="contacts" placeholder="Contact" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                                <input type="text" class="form-control" id="branchs" name="branchs" placeholder="Branch" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>-->
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;">
                                <!--<input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                                <span class="filte_new_text">Select Active Status</span>
                                <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                            
                           
                            <div class="col-sm-2 nopadding" style="width:18% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="voucher_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="vouchmasterclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                 <th width="15%">Voucher Name</th>
       							 <th>From</th>
                                 <th>Expiry</th>
                                 <th>Cost</th>
       							 <th>Holder</th>
                                 <th>Contact</th>
                                 <th>Branch</th>
                                 <th>Active</th>
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
								 //`tbl_vouchermaster`(`vr_voucherid`, `vr_branchid`, `vr_vouchername`, `vr_voucherfrom`, `vr_voucherexpiry`, `vr_vouchercost`, `vr_voucherholder`, `vr_holdercontact`, `vr_active`)
	 $sql_login  =  $database->mysqlQuery("select * from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{/*
				if($result_login['vr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	*/
	 ?>
    						<tr id="ids_<?=$result_login['vr_voucherid']?>"  class="select">
                                 <td width="15%"><?=$result_login['vr_vouchername']?></td>
                                <td><?=$result_login['vr_voucherfrom']?></td>
                                <td><?=$result_login['vr_voucherexpiry']?></td>
                                <td><?=$result_login['vr_vouchercost']?></td>
                                <td><?=$result_login['vr_voucherholder']?></td>
                                <td><?=$result_login['vr_holdercontact']?></td>
                                <td><?=$result_login['be_branchname']?></td>
                                  <td><?=$result_login['vr_active']?></td>
                                <td>
                                <a href="#" class="md-trigger_vouc" id="ids_<?=$result_login['vr_voucherid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['vr_voucherid']?>">
                                 <!--<a href="#" onClick="delete_confirm('<?=$result_login['vr_voucherid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
 <div class="md-modal md-effect-16" id="modal-17" style="  width: 67% !important;">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="voucher_master.php"  method="post"  name="voucher_master">
                               <span id="voucherchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                              <div style="width:50%; float:left">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Voucher Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control vouchername" id="vouchername" name="vouchername"  placeholder="Voucher Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Voucher Name" ></div>
                               </div>
                               
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Voucher From<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vcfm_div">
                                <input type="text" class="form-control voucherfrom" id="voucherfrom" name="voucherfrom"  placeholder="Voucher From" tabindex="2"  data-toggle="tooltip" title="Voucher From" ></div>
                               </div>
                              
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Voucher Expiry<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vce_div">
                                <input type="text" class="form-control voucherexpiry" id="voucherexpiry" name="voucherexpiry"  placeholder="Voucher Expiry" tabindex="3"  data-toggle="tooltip" title="Voucher Expiry" ></div>
                               </div>
                               
                                  <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                 <div class="form_textbox_cc"  > <div class="form-group" id="brnch_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){ ?>
                                        <select data-placeholder="Enter Branch Name" id="branch" name="branch" data-rel="chosen" tabindex="4" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Branch">
                                         <?php  while($result_kot  = $database->mysqlFetchArray($sql_kot))  { ?>
                                            <option value="<?=$result_kot['be_branchid']?>"><?=$result_kot['be_branchname']?></option>
                                         <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                               </div>
                               </div>
                               
                                <div style="width:50%; float:left">
                                <div class="first_form_contain">
                                <span id="voucherchk1" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Cost<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vcct_div">
                                <input type="text" class="form-control vouchercost" id="vouchercost" name="vouchercost"  placeholder="Voucher Cost" tabindex="5"  data-toggle="tooltip" title="Voucher Cost" ></div>
                               </div>
                               
                                   <div class="first_form_contain">
                                       <span id="voucherchk3" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Holder<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vchld_div">
                                <input type="text" class="form-control voucherholder" id="voucherholder" name="voucherholder"  placeholder="Voucher Holder" tabindex="6"  data-toggle="tooltip" title="Voucher Holder" ></div>
                               </div>
                               
                                      <div class="first_form_contain">
                                    <span id="voucherchk2" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Holder Contact<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vccnt_div">
                                <input type="text" class="form-control voucherholdercontact" id="voucherholdercontact" name="voucherholdercontact"  placeholder="Voucher Holder Contact" tabindex="7"  data-toggle="tooltip" title="Voucher Holder Contact" ></div>
                               </div>
                               
                             <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                 	<div class="checkbox">
                                      <label>
                                          <input type="checkbox" value="1" tabindex="8" name="active"  id="active" data-toggle="tooltip" title="Active">
                                      </label>
               						 </div>              
                               	</div>
                                  </div>
                                  </div>
                                  </form> 
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_voch()" tabindex="9"><button class="md-save">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="10">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
    function vouchmasterclr()
{
	document.getElementById('vouchername').value = '';
      	document.getElementById('voucherfrom').value = '';
        document.getElementById('voucherexpiry').value = '';
      	document.getElementById('branch').value = '';
        document.getElementById('vouchercost').value = '';
        document.getElementById('voucherholder').value = '';
        document.getElementById('voucherholdercontact').value = '';
    	$("input[type=checkbox]").each(function() { this.checked=false; });
	
}    
        
        
function validate_all()
{
   
	var a=$("#vouchername").val().trim();
	 //var a=document.getElementById("corporatename").value;
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucher&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#voucherchk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#vouchername").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.voucher_master.submit();

			}
			}
		});

	
}
		function validate_voch()
			{//validate_voucherfrom validate_voucherexpiry validate_voucherbranch validate_vouchercost validate_voucherhld validate_vouchercn
			 if(validate_voucher())
				{
					if(validate_voucherfrom())
					{
						if(validate_voucherexpiry())
						{
						  
							  if(validate_vouchercost())
							  {
                                                             
							 	 if(validate_voucherhld())
								 {
							  		if(validate_vouchercnt())
									{
										if(validate_all())
			                                                             {
			                                                          
                                                                                }
										//document.voucher_master.submit();
									}
								 }
							  }
							
						}
					}
				}
			}
		function validate_voucher()   
			{
				if($(".vouchername").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
					document.voucher_master.vouchername.focus();
                                        alert("Enter Voucher Name");
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#vouchername").val())){
                                 $("#menumaincategory_div").addClass("has-error");
                                  document.voucher_master.vouchername.focus();
                                          alert("Special charecter Not Allowed.");
                              }
                               else
				 {
					 $("#menumaincategory_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}

		   function validate_voucherfrom()   
			{
				if($("#voucherfrom").val()=="")
				{
					$("#vcfm_div").addClass("has-error");
					document.voucher_master.voucherfrom.focus();
                                        alert("Select Voucher From Date");
					return false;
				}
                                var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#voucherfrom").val())){
                                 $("#vcfm_div").addClass("has-error");
                                 document.voucher_master.voucherfrom.focus();
                                            alert("Special charecter Not Allowed.");
                              }
                               else
				 {
					 $("#vcfm_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}

			function validate_voucherexpiry()   
			{
				if($("#voucherexpiry").val()=="")
				{
					$("#vce_div").addClass("has-error");
					document.voucher_master.voucherexpiry.focus();
                                        alert("Select Voucher Expiry Date");
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#voucherexpiry").val())){
                                 $("#vce_div").addClass("has-error");
                                 document.voucher_master.voucherexpiry.focus();
                                            alert("Special charecter Not Allowed.");
                              }
                               else
				 {
					 $("#vce_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}			
		
			
                        function validate_vouchercost()   
			{
			
                         if($("#vouchercost").val()=="")
				{
					$("#vcct_div").addClass("has-error");
					document.voucher_master.vouchercost.focus();
                                        alert("Enter Voucher Cost");
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9. ]+$/;
                                 if(!alphanumers.test($("#vouchercost").val())){
                                 $("#vcct_div").addClass("has-error");
                                 document.voucher_master.vouchercost.focus();
                                        alert("Special charecter Not Allowed.");
                              }
                               else
				 {
                                      // var namechk1=$('#voucherchk1');
                                      var val = parseFloat($('#vouchercost').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#vcct_div").addClass("has-error");
					document.voucher_master.vouchercost.focus();
                                        alert("Enter Numeric Value and Does not start with zero.");
//                                        namechk1.text('Does not start with zero');
					return false;
                                    }
					 var isvalid = $.isNumeric($("#vouchercost").val()) 
						if(isvalid)
						{
							 $("#vcct_div").removeClass("has-error");
							 $(this).addClass("has-success");
							 return true;
						}else
						{
							$("#vcct_div").addClass("has-error");
							document.voucher_master.vouchercost.focus();
							return false;
						}
				 }
                                
			}
                        
			// vcfm_div vce_div brnch_div vcct_div vchld_div vccnt_div
           //voucherfrom voucherexpiry branch vouchercost voucherholder voucherholdercontact
		   //validate_voucherfrom validate_voucherexpiry validate_voucherbranch validate_vouchercost validate_voucherhld validate_vouchercnt
			function validate_voucherhld()   
			{
				if($("#voucherholder").val()=="")
				{
					$("#vchld_div").addClass("has-error");
					document.voucher_master.voucherholder.focus();
                                        alert("Enter Voucher Holder");
					return false;
				}
                                var namechk3=$('#voucherchk3');
                                var alphanumers = /^[a-zA-Z ]+$/;
                                 if(!alphanumers.test($("#voucherholder").val())){
                                 $("#vchld_div").addClass("has-error");
                                 document.voucher_master.voucherholder.focus();
                                   alert("Special Charecter and Numeric value Not Allowed.");
//                                 namechk3.text('Please Enter Correct value');
					return false;
                                          
                              }
//                              var namechk3=$('#voucherchk3');
//                                      var val = parseFloat($('#voucherholder').val());
//                                  if (isNaN(val) || (val === 0))
//                                    {
//                                       $("#vchld_div").addClass("has-error");
//					document.voucher_master.voucherholder.focus();
//                                        namechk3.text('Please Enter Correct value');
//					return false;
//                                    }
                           else
				 {
					 $("#vchld_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
			function validate_vouchercnt()   
			{
				if($("#voucherholdercontact").val()=="")
				{
					$("#vccnt_div").addClass("has-error");
					document.voucher_master.voucherholdercontact.focus();
                                        alert("Enter Holder Contat");
					return false;
				}
                                var namechk2=$('#voucherchk2');
                                var alphanumers = /^[0-9 ]+$/;
                                 if(!alphanumers.test($("#voucherholdercontact").val())){
                                 $("#vccnt_div").addClass("has-error");
                                 document.voucher_master.voucherholdercontact.focus();
                                 alert("Please Enter Numeric value.");
//                                 namechk2.text('Please Enter Numeric value');
					return false;
                                           
                              }
//                               var namechk2=$('#voucherchk2');
//                                      var val = parseFloat($('#voucherholdercontact').val());
//                                  if (isNaN(val) || (val === 0))
//                                    {
//                                       $("#vccnt_div").addClass("has-error");
//					document.voucher_master.voucherholdercontact.focus();
//                                        namechk2.text('Does not start with zero');
//					return false;
//                                    }
                               else
				 {
					 $("#vccnt_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
function delete_confirm(id)
{
	
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="voucher_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{
 var vochrs=$("#vochrs").val();
  if(vochrs=="")
  {
	  vochrs="null";
  }
  var froms=$("#froms").val();
  if(froms=="")
  {
	  froms="null";
  }
   var expirys=$("#expirys").val();
  if(expirys=="")
  {
	  expirys="null";
  }
   var costs="null";
   var holders="null";
   var contacts="null";
   var branchs="null";
   //alert(froms+expirys);
 /* var costs=$("#costs").val();
  if(costs=="")
  {
	  costs="null";
  }
  var holders=$("#holders").val();
  if(holders=="")
  {
	  holders="null";
  }
   var contacts=$("#contacts").val();
  if(contacts=="")
  {
	  contacts="null";
  }
  var branchs=$("#branchs").val();
  if(branchs=="")
  {
	  branchs="null";
  }*/
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }//vochrs froms expirys costs holders contacts branchs statuss
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchvoucher&vochrs="+vochrs+"&froms="+froms+"&expirys="+expirys+"&costs="+costs+"&holders="+holders+"&contacts="+contacts+"&branchs="+branchs+"&statuss="+statuss,
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