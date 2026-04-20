<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=6;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_ingredientmaster WHERE ir_ingredientid = '" .$_REQUEST['id']."'");
 header("location:ingredient_master.php?msg=1");
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ingredient']))
{
	$insertion['ir_ingredientname'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingredient']);
	$insertion['ir_headofficeid']=$_SESSION['headofid'];
    $sql=$database->check_duplicate_entry('tbl_ingredientmaster',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_ingredientmaster',$insertion);
	 $database->updateexpodine_machines(); 
        //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select ir_ingredientid from tbl_ingredientmaster where 	ir_ingredientname='".$insertion['ir_ingredientname']."'  AND 	ir_headofficeid='".$insertion['ir_headofficeid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['ir_ingredientid'];
			}
				  $doc = new DOMDocument();
				 // $doc->formatOutput = true;
				//$doc->preserveWhiteSpace = true;
				  $doc->load($_SESSION['s_xmlfilelocation']);
				  $main = $doc->getElementsByTagName( "ingredient" );
				  if($main->length != 0) //already
				  { 
					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
					  if($insertion['ir_ingredientname']=='')
					  {
						 $child = $xml->ingredient[0]->addChild("ir_".$lastid," ");
					  }else
					  {
						  $child = $xml->ingredient[0]->addChild("ir_".$lastid,$insertion['ir_ingredientname']);
					  }
				  	 // $child = $xml->ingredient[0]->addChild("ir_".$lastid,$insertion['ir_ingredientname']);
                                          $dom = new DOMDocument('1.0');
					  $dom->preserveWhiteSpace = false;
					  $dom->formatOutput = true;
					  $dom->loadXML($xml->asXML());
					  $xml = new SimpleXMLElement($dom->saveXML());
					  $xml->asXML($_SESSION['s_xmlfilelocation']);
				  }else // not exist
				  {
					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
					  $eg=1;$ar=1;
					  foreach ($xml->ingredient as $lang) {
						  if($lang["lang"]=="english")
						  {
							  $eg++;
						  }
						  if($lang["lang"]=="arabic")
						  {
							  $ar++; 
						  }
						  
					  }
					  if($eg==1)
					  {
					  $child = $xml->addChild("ingredient");
					  $child->addAttribute("lang", "english");
					  }
					  if($ar==1)
					  {
					 $child = $xml->addChild("ingredient");
					  $child->addAttribute("lang", "arabic");
					  }
					  if($insertion['ir_ingredientname']=='')
					  {
						 $child = $xml->ingredient[0]->addChild("ir_".$lastid," ");
					  }else
					  {
						  $child = $xml->ingredient[0]->addChild("ir_".$lastid,$insertion['ir_ingredientname']);
					  }
					  
					  
                      $dom = new DOMDocument('1.0');
					  $dom->preserveWhiteSpace = false;
					  $dom->formatOutput = true;
					  $dom->loadXML($xml->asXML());
					  $xml = new SimpleXMLElement($dom->saveXML());
					  $xml->asXML($_SESSION['s_xmlfilelocation']);
				  }
		//add xml code ends	
        }
	 header("location: ingredient_master.php?msg=2");
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ingredient1']))
{
	$id=$_REQUEST['ingredientid'];
	$ingredient=$_REQUEST['ingredient1'];
	
$query3=$database->mysqlQuery("update tbl_ingredientmaster set ir_ingredientname='$ingredient' where ir_ingredientid='$id'");
$database->updateexpodine_machines(); 
	//update xml code starts
		$doc = new DOMDocument();
		$doc->load($_SESSION['s_xmlfilelocation']);
		$items = $doc->getElementsByTagName( "ingredient" );
		  foreach($items as $item) { 
			  if($item->childNodes->length) { 
				  foreach($item->childNodes as $i) { 
					  if($i->nodeName==$id)
					  {
						   $i->nodeValue=$ingredient;
					  }
				  } 
			  } 
		  } 
	  $doc->save($_SESSION['s_xmlfilelocation']);
	//update xml code ends

    header("location: ingredient_master.php?msg=3");
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
<title>Ingredients</title>
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
			$('#ingrdnts').autocomplete({source:'autocomplete/find_keywords.php?type=ingrdnts_i', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){
	$('#ingrdnts').focus();
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
					<li><a style="cursor:pointer">Ingredient</a></li>
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
                           		<span class="filte_new_text">Ingredient Name</span>
                                <input type="text" class="form-control filte_new_box" id="ingrdnts" name="ingrdnts" placeholder="Ingredient Name" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="ingredient_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
<!--                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>-->
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th height="35px">Ingredient</th>
                               <!--  <td>Action</td>-->
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_ingredientmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['ir_ingredientid']?>"  class="select">
                                <td><?=$result_login['ir_ingredientname']?></td>
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
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="ingredient_master.php"  method="post"  name="ingredient_master">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Ingredient<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="ingredient_div">
                                <input type="text" class="form-control ingredientname" id="ingredient" name="ingredient"  placeholder="Ingredient" tabindex="0"  data-toggle="tooltip" title="Portion" ></div>
                               </div>
                                  </form> 
                    </div>
                       <a  href="#" onClick="validate_ingredient()"><button class="md-save">Save</button></a>
                             <a href="#"><button class="md-close">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
		function validate_ingredient()
			{
			 if(validate_ingredientname())
				{
					document.ingredient_master.submit();
				}
			}
		function validate_ingredientname()   
			{
				if($(".ingredientname").val()=="")
				{
					$("#ingredient_div").addClass("has-error");
						  document.ingredient_master.ingredient.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("ingredient").value;
						$("#ingredient_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="ingredient_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{//portionams shtcds
	var ingredient=$("#ingrdnts").val();
  if(ingredient=="")
  {
	  ingredient="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchingredient&ingredient="+ingredient,
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