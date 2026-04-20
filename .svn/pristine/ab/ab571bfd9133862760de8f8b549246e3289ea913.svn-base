<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=6;
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['addon1']))
{
	
	$insertion['ma_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['addon1']);

    $sql=$database->check_duplicate_entry('tbl_menu_addon_master',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_menu_addon_master',$insertion);
	$database->updateexpodine_machines(); 
        //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select ma_id from tbl_preferencemaster where 	ma_name='".$insertion['ma_name']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['ma_id'];
			}
//				  $doc = new DOMDocument('1.0');
//				 // $doc->formatOutput = true;
//				//$doc->preserveWhiteSpace = true;
//				  $doc->load($_SESSION['s_xmlfilelocation']);
//				  $main = $doc->getElementsByTagName( "preference" );
//				 $main2 = $doc->getElementsByTagName( "pmr_".$lastid );
//				  if($main->length != 0 && $main2->length != 0) //already
//				  { 
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					  if($insertion['pmr_name']=='')
//					  {
//						 $child = $xml->preference[0]->addChild("pmr_".$lastid," ");
//					  }else
//					  {
//						   $child = $xml->preference[0]->addChild("pmr_".$lastid,$insertion['pmr_name']);
//					  }
//				  	 // $child = $xml->preference[0]->addChild("pmr_".$lastid,$insertion['pmr_name']);
//					  $xml->preserveWhiteSpace = false;
//					   $xml->formatOutput = true;
//					  $dom = new DOMDocument('1.0');
//					  $dom->preserveWhiteSpace = false;
//					  $dom->formatOutput = true;
//					  $dom->loadXML($xml->asXML());
//					  $xml = new SimpleXMLElement($dom->saveXML());
//					  $xml->asXML($_SESSION['s_xmlfilelocation']);
//				  }else // not exist
//				  {
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					   $eg=1;$ar=1;
//					  foreach ($xml->preference as $lang) {
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
//					  $child = $xml->addChild("preference");
//					  $child->addAttribute("lang", "english");
//					  }
//					  if($ar==1)
//					  {
//					  $child = $xml->addChild("preference");
//					  $child->addAttribute("lang", "arabic");
//					  }
//					   if($insertion['pmr_name']=='')
//					  {
//						 $child = $xml->preference[0]->addChild("pmr_".$lastid," ");
//					  }else
//					  {
//						   $child = $xml->preference[0]->addChild("pmr_".$lastid,$insertion['pmr_name']);
//					  }
//					  
//					  
//					  
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
//		//excel code starts
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
//			  if($worksheetTitle=="preference")
//			  {
//				  $i=$highestRow + 1;
//				  $worksheet->setCellValue("A".$i, $lastid);
//				  $worksheet->setCellValue("B".$i, $insertion['pmr_name']);
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
        }
	
//header("location: preference_master.php?msg=2");
	 if (!headers_sent())
    {    
        header('Location: addons_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="addons_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=addons_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['addon2']))
{
	$id=$_REQUEST['addonid'];
	$preference12=$_REQUEST['addon2'];
       if(isset($_REQUEST['addactive'])){
    $chck="Y";
}  else {
    $chck="N";
}
	
$query3=$database->mysqlQuery("update tbl_menu_addon_master set ma_name='$preference12',ma_active='$chck'  where ma_id='$id'");
$database->updateexpodine_machines(); 
//update xml code starts
//		$doc = new DOMDocument();
//		$doc->load($_SESSION['s_xmlfilelocation']);
//		$items = $doc->getElementsByTagName( "preference" );
//		  foreach($items as $item) { 
//			  if($item->childNodes->length) { 
//				  foreach($item->childNodes as $i) { 
//					  if($i->nodeName=="pmr_".$id)
//					  {
//						   $i->nodeValue=$preference12;
//					  }
//				  } 
//			  } 
//		  } 
//	  $doc->save($_SESSION['s_xmlfilelocation']);
//	//update xml code ends
//	
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
//			  if($worksheetTitle=="preference")
//			  {
//						  for ($row = 1; $row <= $highestRow; ++ $row) {
//							  for ($col = 0; $col < $highestColumnIndex; ++ $col) {
//								  $cell = $worksheet->getCellByColumnAndRow($col, $row);
//								  $val = $cell->getValue();
//								  $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
//								  if($val==$id)
//								  {
//									  $worksheet->setCellValue("B".$row, $preference12);
//								  }
//							  }
//						  }
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
		
//header("location: preference_master.php?msg=3");
	 if (!headers_sent())
    {    
        header('Location: addons_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="addons_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=addons_master.php?msg=3" />';
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
	else if($_REQUEST['msg']=="5")
	{
	$alert="Already existing...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Addons</title>
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
			$('#pref').autocomplete({source:'autocomplete/find_keywords.php?type=pref_c', minLength:1});
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
	$('.md-trigger_prfrnc').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("load_addon_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Addons</a></li>
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
                           		<span class="filte_new_text">Addon</span>
                                <input type="text" class="form-control filte_new_box" id="addon" name="addon" placeholder="Addons" onKeyUp="validateSearch()">
                            </div>
                            
                          
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="addons_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testpref()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th height="35px">Addons</th>
                                 <td>Status</td>
                                 <td>Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menu_addon_master"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			
                      if($result_login['ma_active']=="Y"){
                          $sts="Active";
                      }else{
                          $sts="Inactive";
                      }
                      
	 ?>
    						<tr id="ids_<?=$result_login['ma_id']?>"  class="select">
                                <td><?=$result_login['ma_name']?></td>
                                  <td><?=$sts?></td>
                                
                             
                                <td>
                                 <a href="#" class="md-trigger_prfrnc" id="ids_<?=$result_login['ma_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ma_id']?>">
                                   <!--  <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ir_ingredientid']?>">
                                 <a href="#" onClick="delete_confirm('<?=$result_login['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
 <div style="width:550px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="addons_master.php"  method="post"  name="preference_master">
                        	 <div class="first_form_contain">
                              <span id="prefstatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Addons<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="preference_div">
                                     <input type="text" class="form-control preferencename" id="addon1" name="addon1"  placeholder="Addon" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Preference" onChange="valipref()" ></div>
                               </div>
                                  </form> 
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_preference()" tabindex="2"><button class="md-save">Save</button></a>
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
 $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function valipref()
{
	 var a=$("#preference1").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprefrnc&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#prefstatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			     $("#preference_div").addClass("has-error");
	  $("#preference1").focus();
					}
					else
					{
						namechk.text('');
						 $("#preference_div").removeClass("has-error");
	   $("#preference_div").addClass("has-success");
					}
			}
		});
}
		function validate_preference()
			{
			 if(validate_preferencename())
				{
					//document.preference_master.submit();
				}
			}
		function validate_preferencename()   
			{
				if($(".preferencename").val()=="")
				{
					$("#preference_div").addClass("has-error");
						  document.preference_master.addon1.focus();
                                                  alert("Enter addon");
						  return false;
				}
                                
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#preference1").val())){
                              $("#preference_div").addClass("has-error");
                               document.preference_master.addon1.focus();
                          alert("Special character Not Allowed.");
                   } 
                                  else
					 {
						 var a=document.getElementById("addon1").value;
						/*$("#preference_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;*/
							 
						   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=addonadd&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#prefstatus1234');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#preference_div").addClass("has-error");
	  $("#addon1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#preference_div").removeClass("has-error");
	   $("#preference_div").addClass("has-success");
	
	  //	alert('aa');
	document.preference_master.submit();
			}
			}
		}); 
					 }
                                     }
                                 
			
				
			
			
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="addons_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function testpref()
{
		document.getElementById('preference1').value = '';
	$("#prefstatus1234").text("");
	
}


function validateSearch()
{//portionams shtcds
	var preference11=$("#addon").val();
  if(preference11=="")
  {
	  preference11="null";
  }
  
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchaddon&preference="+preference11,
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