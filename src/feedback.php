<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=4;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_feedbackmaster SET  fbm_active='Y' WHERE fbm_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_feedbackmaster SET  fbm_active='N' WHERE fbm_id = '" .$_REQUEST['id']."'");
	}
	// header("location:feedback.php?msg=3");
		 if (!headers_sent())
    {    
        header('Location: feedback.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="feedback.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=feedback.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['feedback']))
{
	$insertion['fbm_question'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['feedback']);
	if(isset($_REQUEST['active']))
	{
	 $insertion['fbm_active'] 		=  'Y';
	}else
	{
	 $insertion['fbm_active'] 		=  'N';
	}
    $sql=$database->check_duplicate_entry('tbl_feedbackmaster',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_feedbackmaster',$insertion);
	$database->updateexpodine_machines(); 
	 //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select fbm_id from tbl_feedbackmaster where 	fbm_question='".$insertion['fbm_question']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['fbm_id'];
			}
//				  $doc = new DOMDocument();
//				 // $doc->formatOutput = true;
//				//$doc->preserveWhiteSpace = true;
//				  $doc->load($_SESSION['s_xmlfilelocation']);
//				  $main = $doc->getElementsByTagName( "feedback" );
//				  $main2 = $doc->getElementsByTagName( $lastid );
//				  if($main->length != 0 && $main2->length != 0) //already
//				  {  
//					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
//					  if($insertion['fbm_question']=='')
//					  {
//						 $child = $xml->feedback[0]->addChild($lastid," ");
//					  }else
//					  {
//						   $child = $xml->feedback[0]->addChild($lastid,$insertion['fbm_question']);
//					  }
//					  
//				  	  //$child = $xml->feedback[0]->addChild($lastid,$insertion['fbm_question']);
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
//					  foreach ($xml->feedback as $lang) {
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
//					 $child = $xml->addChild("feedback");
//					  $child->addAttribute("lang", "english");
//					  }
//					  if($ar==1)
//					  {
//					 $child = $xml->addChild("feedback");
//					  $child->addAttribute("lang", "arabic");
//					  }
//					  if($insertion['fbm_question']=='')
//					  {
//						 $child = $xml->feedback[0]->addChild($lastid," ");
//					  }else
//					  {
//						   $child = $xml->feedback[0]->addChild($lastid,$insertion['fbm_question']);
//					  }
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
//         //excel code starts
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
//			  if($worksheetTitle=="feedback")
//			  {
//				  $i=$highestRow + 1;
//				  $worksheet->setCellValue("A".$i, $lastid);
//				  $worksheet->setCellValue("B".$i, $insertion['fbm_question']);
//			  }
//		}
//	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
//	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
        }
	// header("location:feedback.php?msg=2");
	 if (!headers_sent())
    {    
        header('Location: feedback.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="feedback.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=feedback.php?msg=2" />';
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
<title>Feedback</title>
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
.table_report thead th, td{padding-left:20px !important;}
.table_report td{text-align:left !important;padding-left:20px !important;}
.table_report td.feedbackdisplay{text-align:center !important;}
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
			$('#feedbackqstn').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackqstn_q', minLength:1});
			$('#activesrch').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackstatus_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>

		$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
   $("#modal-17").removeClass('md-show');
//$(".close_staff_pop").click();
    });



$(document).ready(function(){

$("#feedbackqstn").focus();

	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_ing').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/ingredient_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
	
$('.status_sel').click( function() { 

			var statuss="";
		  var ss=($(this).val());
		  if(ss=="Yes")
		  {
			  statuss="Y";
		  }else
		  {
			  statuss="null";
		  }
			 /*$('.status_sel:checked').prop("checked", false);
			 $(this).prop("checked", true);*/
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
					<li><a style="cursor:pointer">Feedback</a></li>
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
                           		<span class="filte_new_text">Question</span>
                                <input type="text" class="form-control filte_new_box" id="feedbackqstn" name="feedbackqstn" placeholder="Question" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                                 <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                           <!--   <label>
                            	  <input type="checkbox" name="RadioGroup1" value="Yes" id="activesel"  class="status_sel"  >
                            	 Active</label>-->
                                 <span class="filte_new_text">Select Status</span>
                                  <select  class="add_text_box filte_new_box"  id="activesrch" name="activesrch" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Y">Yes</option>
                                <option value="N">No</option>
                                </select>
                            </div>
                     <!--   <input type="checkbox" value="1" tabindex="5" name="activesrch"  id="activesrch" data-toggle="tooltip" title="Active" nKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()" >
                   -->
                           <!-- <label>
                            	  <input type="checkbox" name="RadioGroup1" value="noen" id="nonesel"  class="status_sel" style="display:none" >
                            	 </label>-->
                            
                          
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;display: none" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="feedback.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="feedbkclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th height="35px">Question</th>
                                <th width="10%">Status</th>
                                 <td width="10%">Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_feedbackmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			if($result_login['fbm_active']=="Y")
				{
					$active="Active";
				}else 
				{
					$active="Inactive";
				}		
				
	 ?>
    						<tr id="ids_<?=$result_login['fbm_id']?>"  class="select">
                                <td><?=$result_login['fbm_question']?></td>
                                  <td width="10%"><?=$active?></td>
                                  <td width="10%">
                               <?php if($result_login['fbm_active']=="Y"){ ?>  
                                 <a title="Active" style="cursor:pointer;background-color: limegreen;height: 24px;display: inline-block;border-radius: 50%;" onClick="delete_confirm('ToNo','<?=$result_login['fbm_id']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                 <a title="Inactive" style="cursor:pointer;background-color: red;height: 24px;display: inline-block;border-radius: 50%;" onClick="delete_confirm('ToYes','<?=$result_login['fbm_id']?>')"  > <img src="img/black_tick.png" width="25px" height="25px"></a>
                                 <?php } ?>
                                  
                                  <a style="cursor:pointer"  onClick="edit_confirm('<?=$result_login['fbm_id']?>','<?=$result_login['fbm_question']?>')"  > <img src="images/edit_page.png" width="25px" height="25px"></a>
                                  
                                 </td>
                               <!-- <td>
                                 <a href="#" class="md-trigger_ing" id="ids_<?=$result_login['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ir_ingredientid']?>">
                                 <a href="#" onClick="delete_confirm('<?=$result_login['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
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
				<h3 id='head_pop'>ADD NEW</h3>
				<div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="feedback.php"  method="post"  name="feedback">
                              
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Question<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control feedback" id="feedback" name="feedback"  placeholder="Question" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Question" ></div>
                               </div>
                                                <div class="first_form_contain active_div">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" tabindex="2" name="active"  id="active" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                               
                                  </form> 
                    </div>
                      

                             
                              <a id='add_btn' href="#" onClick="validate_feedback()" tabindex="3"><button class="md-save">Save</button></a>
                              
                              <a style="display:none" id='upd_btn' href="#" onClick="update_feed();" tabindex="3"><button class="">Update</button></a>
                               
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
function feedbkclr()
{
	document.getElementById('feedback').value = '';
     	$('#feedbkchk').text('');
		$("#feedback_div").removeClass("has-error");
                $("input[type=checkbox]").each(function() { this.checked=false; });
}
function validate_all()
{
	
				 var a=$("#feedback").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkfeedback&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#feedbkchk');
			if(data=="sorry")
			{
		// namechk.text('Already exists');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					$("#menumaincategory_div").addClass("has-error");
		   $("#feedback_div").addClass("has-error");
	  $("#feedback").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#feedback_div").removeClass("has-error");
	   $("#feedback_div").addClass("has-success");
	  	document.feedback.submit();

			}
			}
		});
}
		function validate_feedback()
			{
			 if(validate_question())
				{
					if(validate_all())
					{
					}
					 
					
				//	document.feedback.submit();
			
				}
			}
		function validate_question()   
			{
				if($(".feedback").val()=="")
				{
					$("#feedback_div").addClass("has-error");
						  document.feedback.feedback.focus();
                                                 // alert("Enter Question");
                                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Feedabck Question');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					$("#menumaincategory_div").addClass("has-error");
						  return false;
				}else
					 {
						 var a=document.getElementById("feedback").value;
						$("#feedback_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
			
	function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="feedback.php?id="+id+"&delete=yes";
		}else
		{window.location="feedback.php?id="+id+"&delete=no";
		}
	}
	
}	
			
			

</script>
<script type="text/javascript">
function validateSearch()
{//portionams shtcds
	var question=$("#feedbackqstn").val();
  if(question=="")
  {
	  question="null";
  }
  var activesrch=$("#activesrch").val();
  if(activesrch=="")
  {
	  activesrch="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchfeedback&question="+question+"&statuss="+activesrch,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}



function edit_confirm(id,qs){
    $('#modal-17').addClass('md-show');
    $('#head_pop').text('UPDATE');
    
    $('#feedback').val(qs);
     $('.active_div').hide();
    
    
    $('#add_btn').hide();
    $('#upd_btn').show();
    $('#feedback').attr('f_id',id);
   
    
}


function update_feed(){
    
    var qs=$('#feedback').val();
    
    var id=$('#feedback').attr('f_id');
    
    if( $('#feedback').val()!=''){
     $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "value=update_feedback&question="+qs+"&id="+id,
			success: function(msg)
			{
				location.reload();
			}
		});  
            }else{
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Feedabck Question');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					$("#menumaincategory_div").addClass("has-error");
            }
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