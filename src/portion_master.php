<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=6;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_portionmaster WHERE pm_id = '" .$_REQUEST['id']."'");
 //header("location:portion_master.php?msg=1");
 		 if (!headers_sent())
    {    
        header('Location: portion_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="portion_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=portion_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['portion']))
{
	$insertion['pm_portionname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['portion']));
	$insertion['pm_portionshortcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['shortcode']));
    $sql=$database->check_duplicate_entry('tbl_portionmaster',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_portionmaster',$insertion);
	 $database->updateexpodine_machines(); 
         //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select pm_id from tbl_portionmaster where 	pm_portionname='".$insertion['pm_portionname']."'  AND pm_portionshortcode='".$insertion['pm_portionshortcode']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['pm_id'];
			}
//				  $doc = new DOMDocument();
//				  $doc->load($_SESSION['s_xmlfilelocation']);
//				  $main = $doc->getElementsByTagName( "portion" );
//				  $main2 = $doc->getElementsByTagName( "pm_".$lastid );
//				  $main3 = $doc->getElementsByTagName( "short_pm_".$lastid );
//				  if($main->length != 0 && $main2->length != 0 && $main3->length != 0) //already
//				  { 
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//				  	   if($insertion['pm_portionname']=='')
//					  {
//						 $child = $xml->portion[0]->addChild("pm_".$lastid," ");
//					  }else
//					  {
//						  $child = $xml->portion[0]->addChild("pm_".$lastid,$insertion['pm_portionname']);
//					  }
//					  
//					   if($insertion['pm_portionshortcode']=='')
//					  {
//						 $child = $xml->portion[0]->addChild("short_pm_".$lastid," ");
//					  }else
//					  {
//						  $child = $xml->portion[0]->addChild("short_pm_".$lastid,$insertion['pm_portionshortcode']);
//					  }
//                      $dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());
//					  $xml->asXML($_SESSION['s_xmlfilelocation']);
//				  }else // not exist
//				  {
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					   $eg=1;$ar=1;
//					  foreach ($xml->portion as $lang) {
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
//					  $child = $xml->addChild("portion");
//					  $child->addAttribute("lang", "english");
//					  }
//					  if($ar==1)
//					  {
//					  $child = $xml->addChild("portion");
//					  $child->addAttribute("lang", "arabic");
//					  }
//					  
//					   if($insertion['pm_portionname']=='')
//					  {
//						 $child = $xml->portion[0]->addChild("pm_".$lastid," ");
//					  }else
//					  {
//						  $child = $xml->portion[0]->addChild("pm_".$lastid,$insertion['pm_portionname']);
//					  }
//					  
//					   if($insertion['pm_portionshortcode']=='')
//					  {
//						 $child = $xml->portion[0]->addChild("short_pm_".$lastid," ");
//					  }else
//					  {
//						  $child = $xml->portion[0]->addChild("short_pm_".$lastid,$insertion['pm_portionshortcode']);
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
//		
//		 //excel code starts
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
//			  if($worksheetTitle=="portion")
//			  {
//				  $i=$highestRow + 1;
//				  $worksheet->setCellValue("A".$i, $lastid);
//				  $worksheet->setCellValue("B".$i, $insertion['pm_portionname']);
//				  $worksheet->setCellValue("D".$i, $insertion['pm_portionshortcode']);
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
		
        }
	// header("location: portion_master.php?msg=2");
 if (!headers_sent())
    {    
        header('Location: portion_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="portion_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=portion_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }

}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['portion1']))
{
	$id=$_REQUEST['portionid'];
	$portion=trim($_REQUEST['portion1']);
	echo $portion;
	die();
	$shortcode=trim($_REQUEST['shortcode1']);
$query3=$database->mysqlQuery("update tbl_portionmaster set pm_portionname='$portion',pm_portionshortcode='$shortcode' where pm_id='$id'");
$database->updateexpodine_machines(); 
//update xml code starts
		$doc = new DOMDocument();
		$doc->load($_SESSION['s_xmlfilelocation']);
		$items = $doc->getElementsByTagName( "portion" );
		  foreach($items as $item) { 
			  if($item->childNodes->length) { 
				  foreach($item->childNodes as $i) { 
					  if($i->nodeName==$id)
					  {
						   $i->nodeValue=$portion;
					  }
                                          if($i->nodeName==$id)
					  {
						   $i->nodeValue=$shortcode;
					  }
				  } 
			  } 
		  } 
	  $doc->save($_SESSION['s_xmlfilelocation']);
	//update xml code ends
	
	//excel code starts
		$inputFileType = 'Excel5';
		$inputFileName = $_SESSION['s_excelfilelocation'];
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			  $worksheetTitle     = $worksheet->getTitle();
			  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
			  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			  if($worksheetTitle=="portion")
			  {
						  for ($row = 1; $row <= $highestRow; ++ $row) {
							  for ($col = 0; $col < $highestColumnIndex; ++ $col) {
								  $cell = $worksheet->getCellByColumnAndRow($col, $row);
								  $val = $cell->getValue();
								  $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
								  if($val==$id)
								  {
									  $worksheet->setCellValue("B".$row, $portion);
									  $worksheet->setCellValue("D".$row, $shortcode);
								  }
							  }
						  }
			  }
		}
	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends	
		
	//header("location: portion_master.php?msg=3");
	 if (!headers_sent())
    {    
        header('Location: portion_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="portion_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=portion_master.php?msg=3" />';
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
<title>Portion</title>
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
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
			$('#portionams').autocomplete({source:'autocomplete/find_keywords.php?type=portionams_p', minLength:1});
			$('#shtcds').autocomplete({source:'autocomplete/find_keywords.php?type=shtcds_p', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
	
$(document).ready(function(){

	$("#portionams").focus();
	
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_port').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/portion_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer"><?=$_SESSION['s_portionname']?></a></li>
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
                            	<span class="filte_new_text"><?=$_SESSION['s_portionname']?> Name</span>
                                <input type="text" class="form-control filte_new_box" id="portionams" name="discounts" placeholder="<?=$_SESSION['s_portionname']?> Name" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Shortcode</span>
                                <input type="text" class="form-control filte_new_box" id="shtcds" name="shtcds" placeholder="Shortcode" onKeyUp="validateSearch()">
                            </div>
                          
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="portion_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                   <?php if($_SESSION['expodine_id']=="admin"){ ?>
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testclr()" ></a>
                      </div>  
                      <?php } ?>
                     
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr style="height: 35px;">
                                <th width="50%"><?=$_SESSION['s_portionname']?> Name</th>
                                <th width="50%">Short Code</th>
                                 <th width="50%">View In Kot</th>
                                  <th width="50%">View In Bill</th>
                                 <!--<td>Action</td>-->
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
	 ?>
    						<tr id="ids_<?=$result_login['pm_id']?>"  class="select">
                                <td><?=$result_login['pm_portionname']?></td>
                                <td><?=$result_login['pm_portionshortcode']?></td>
<!--                                <td>
                                 <a href="#" class="md-trigger_port" id="ids_<?=$result_login['pm_id']?>" ><img src="images/edit_page.PNG"></a>
                                </td>-->
                                
                                
                                <td> 
                                    <select <?php if($result_login['pm_viewinkot']=='Y'){ ?> style="color:green" <?php }else{ ?> style="color:red"  <?php } ?> id="view_kot<?=$result_login['pm_id']?>" onchange="view_type('<?=$result_login['pm_id']?>','KOT')">
                                  
                                        
                                        <option  value="Y"  <?php if($result_login['pm_viewinkot']=='Y'){ ?> selected <?php } ?> >YES</option> 
                                        <option value="N"  <?php if($result_login['pm_viewinkot']=='N'){ ?> selected  <?php } ?>>NO</option>  
                                    </select>
                                </td> 
                                 
                                 <td>
                                    
                                  <select <?php if($result_login['pm_viewinbill']=='Y'){ ?> style="color:green" <?php }else{ ?> style="color:red"  <?php } ?>  id="view_bill<?=$result_login['pm_id']?>" onchange="view_type('<?=$result_login['pm_id']?>','BILL')">
                                  
                                        
                                      <option  value="Y"  <?php if($result_login['pm_viewinbill']=='Y'){ ?> selected  <?php } ?> >YES</option> 
                                      <option value="N"  <?php if($result_login['pm_viewinbill']=='N'){ ?> selected  <?php } ?>>NO</option>  
                                        
                                    </select>
                                 </td> 
                                
                              </tr>
                               <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['pm_id']?>">
                               
                                  
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
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="portion_master.php"  method="post"  name="portion_master">
                                <span id="portionstatus1234" class="load_error alertsmaster" style="color:#F00" ></span>   
                        	 <div class="first_form_contain">
                             
                             	<div class="form_name_cc"><?=$_SESSION['s_portionname']?> Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                 
                                     <input  type="text" class="form-control portionname" id="portion" name="portion"  placeholder="<?=$_SESSION['s_portionname']?>" tabindex="1" autofocus  data-toggle="tooltip" title="<?=$_SESSION['s_portionname']?>" onChange="portionchk()" ></div>
                               </div>
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Short Code<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="shortcode_div">
                                     <input type="text" maxlength="1" class="form-control shortcode" id="shortcode" name="shortcode"  placeholder="Short Code" tabindex="2"  data-toggle="tooltip" title="Short Code" ></div>
                               </div>
                                  </form> 
                    </div>
                                    <a  href="#" onClick="validate_portionval()" tabindex="3"><button class="md-save">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="4">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">

function view_type(id,type){
    
      $('.alert_error_popup_all_in_one').show();
                                    
      $('.alert_error_popup_all_in_one').text('STATUS CHANGED');
      $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
                        
    
    var view_kot=$('#view_kot'+id).val();
    
    var view_bill=$('#view_bill'+id).val();
  
    $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=view_change&id="+id+"&type="+type+"&view_bill="+view_bill+"&view_kot="+view_kot,
			success: function(msg)
			{ 
                           
                        
                   setTimeout(function(){ 
          
                  window.location.href="portion_master.php";
           
                  }, 1000);
                        }
                       });
                   
    
}


function testclr()
{
	
	document.getElementById('portion').value = '';

	document.getElementById('shortcode').value = '';
	//$('#active').val('');
	$('#portionstatus1234').text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
}


function portionchk()
{
	$('#portionstatus1234').text('');
	 var a=$("#portion").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkportion&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#portionstatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			    $("#menumaincategory_div").addClass("has-error");
	  $("#portion").focus();
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



		function validate_portionval()
			{
			 if(validate_portion())
				{
				//	 if(validate_shortcode())
				//{
					
					//document.portion_master.submit();
				//}
				}
			}
		function validate_portion()   
			{
				if($(".portionname").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
						  document.portion_master.portion.focus();
                                                  alert("Enter Portion")
						  return false;
				}
                                
                                        var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                          if(!alphanumers.test($("#portion").val())){
                                       $("#menumaincategory_div").addClass("has-error");
                                         document.portion_master.portion.focus();
                                        alert(" Special charecter Not Allowed.");
                                        }
                                      else
					 {
						 var ab=document.getElementById("portion").value;
						/*$("#menumaincategory_div").removeClass("has-error");
						$(this).addClass("has-success");*/
						
						    $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkportion&mid="+ab,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#portionstatus1234');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#portion").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	if(validate_shortcode())
	{
	
	  //	alert('aa');
	document.portion_master.submit();
	}
			}
			}
		}); 
						
						//return true;
					 }
			}
			
				function validate_shortcode()   
			{
				if($("#shortcode").val()=="")
				{
					
					$("#shortcode_div").addClass("has-error");
						  document.portion_master.shortcode.focus();
                                                  alert("Enter Short Code");
						  return false;
				}
                                
                                       var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                          if(!alphanumers.test($("#shortcode").val())){
                                       $("#shortcode_div").addClass("has-error");
                                        document.portion_master.shortcode.focus();
                                      alert(" Special charecter Not Allowed.");
                                        }
                                       else
					 {
						 
						 
						 var a=document.getElementById("shortcode").value;
						 var b=a.length;
						if(b <=1)
						{
						$("#shortcode_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						}
						
						else
						{
							$("#shortcode_div").addClass("has-error");
						  document.portion_master.shortcode.focus();
                                                  alert("Enter a value")
						  return false;
						}
					 }
			}
			
			
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="portion_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{//portionams shtcds
	var portionams=$("#portionams").val();
  if(portionams=="")
  {
	  portionams="null";
  }
  var shtcds=$("#shtcds").val();
  if(shtcds=="")
  {
	  shtcds="null";
  }
  
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchportion&portionams="+portionams+"&shtcds="+shtcds,
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