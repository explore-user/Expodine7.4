<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=5;
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['country']))
{
	$insertion['cy_countryname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['country']));
	
    $sql=$database->check_duplicate_entry('tbl_country',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_country',$insertion);
	 }
	
		 if (!headers_sent())
    {    
        header('Location: country_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="country_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=country_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if(isset($_REQUEST['delete']))
{
    $id=$_REQUEST['id'];
	//$database->mysqlQuery("DELETE FROM tbl_menumaster WHERE mr_menuid = '" .$_REQUEST['id']."'");
	$database->mysqlQuery("DELETE FROM tbl_country WHERE cy_countyid ='" .$_REQUEST['id']."'");
	//header("location:country_master.php?msg=1");
	 if (!headers_sent())
    {    
        header('Location: country_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="country_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=country_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['country1']))
{
	$id=trim($_REQUEST['countryid']);
	$country=trim($_REQUEST['country1']);
	
	
	$query3=$database->mysqlQuery("update tbl_country set cy_countryname='$country' where cy_countyid='$id'");
	
	
//$query3=$database->mysqlQuery("update tbl_country set cy_countryname='$country',cy_nationality='$nationality',cy_currencycode='$currencycode' ,cy_conversionrate='$coversionrate' where cy_countyid='$id'");
	//header("location:country_master.php?msg=3");
	 if (!headers_sent())
    {    
        header('Location: country_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="country_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=country_master.php?msg=3" />';
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
<title>Country</title>
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
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#countrys').autocomplete({source:'autocomplete/find_keywords.php?type=country', minLength:1});
			$('#nationalitys').autocomplete({source:'autocomplete/find_keywords.php?type=nationality', minLength:1});
			$('#currencys').autocomplete({source:'autocomplete/find_keywords.php?type=currency', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script>

$(".add_btn_2").click(function()
{
	$("#country").focus();
});

$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_country').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/country_edit.php", {menu:menuid},
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
				action: 'uploadFlag.php?upid=<?=$upload_id?>',
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
			//	mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				//alert(response);
				var details	= response.split("|");
				var a=details[1];
				
				$('#flagimage').val(a);

				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
					 $.post("load_divmaster.php", {value:"flagimgload",name:a},
				  function(data)
				  {
				  data=$.trim(data);
			//	 alert(data);
				  $('#flagimg').css("display","block");
				  $('#flagimg').html(data);
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
					<li><a style="cursor:pointer">Country</a></li>
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
            </div>
            <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                      <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                            	<span class="filte_new_text">Country</span>
                                <input autofocus="" type="text" class="form-control filte_new_box" id="countrys" name="countrys" placeholder="Country" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%;display: none">
                            	<span class="filte_new_text">Nationality</span>
                                <input type="text" class="form-control filte_new_box" id="nationalitys" name="nationalitys" placeholder="Nationality" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%;display: none">
                            	<span class="filte_new_text">Currency Code</span>
                                <input type="text" class="form-control filte_new_box" id="currencys" name="currencys" placeholder="Currency Code" onKeyPress="validateSearch()"onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;display: none" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="country_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   </div><!--cc_new-->
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="countryclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Country</th>
                                
                                 <td>Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_country"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
 
    				<tr id="ids_<?=$result_login['cy_countyid']?>" >
                                <td><?=$result_login['cy_countryname']?></td>
                                  
                                  <td >
                                	<a href="#" class="md-trigger_country" id="ids_<?=$result_login['cy_countyid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['cy_countyid']?>">
                                 <!--   <a href="#" onClick="delete_confirm('<?=$result_login['cy_countyid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                                </td>
                              </tr>
                                   
                              <?php } } ?>
                        </table>
                   </div>
                        <!--<div style="background-color:#fff;border:solid 1px #ccc" class="module_acces_head"><span>
                                  <ul style="margin-right:5px;" class="pagination">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                  </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                  </a>
                                </li>
                              </ul>
                                        </span></div>-->
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
 <div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>ADD COUNTRY</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="country_master.php"  method="post"  name="country_master">
                        	 <div class="first_form_contain">
                               <span id="countrystatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Country<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control countryname" id="country" name="country"  placeholder="Country" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Country"></div>
                               </div>
                                  <div class="first_form_contain" style="display:none">	
                               	<div class="form_name_cc">Nationality</div>
                                  	 <div class="form_textbox_cc" id="menumaincategory_div12">
                                <input type="text" class="form-control nationality" id="nationality" name="nationality"  placeholder="Nationality" tabindex="2"  data-toggle="tooltip" title="Nationality" ></div>
                                </div>
                                 <div class="first_form_contain" style="display:none">	
                              	<div class="form_name_cc">Currency Code</div>
                                  	 <div class="form_textbox_cc" id="menumaincategory_div123">
                                <input type="text" class="form-control currencycode" id="currencycode" name="currencycode"  placeholder="Currency code" tabindex="3"  data-toggle="tooltip" title="Currency Code" ></div>
                                </div>
                                 <div class="first_form_contain" style="display:none">	
                              	<div class="form_name_cc">Conversion Rate</div>
                                  	 <div class="form_textbox_cc" id="conversionrate_div">
                                <input type="text" class="form-control conversionrate" id="conversionrate" name="conversionrate"  placeholder="Conversion Rate" tabindex="4"  data-toggle="tooltip" title="Conversion Rate" ></div>
                                </div>
                                 <!--<div class="first_form_contain">
                             	<div class="form_name_cc">Flag Image</div>
                              
                                <span style="position:relative;" id="me" class="styleall">Upload Image</span> <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span> 
                                
                                  <input type="hidden" class="form-control" id="flagimage" name="flagimage" >
                             
                              
                                </div>-->
                                 <div class="upload_view_img" id="flagimg">
                                 </div>
                                </form> 
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_registration()"><button class="md-save" tabindex="5">Save</button></a>
                            <!-- <a href="#"><button class="md-close" tabindex="6">Close me!</button></a>-->
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>-->
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
		</script>-->
  
    
    
        
        
        
<script type="text/javascript">
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function valicountry()
{
	 var a=$("#country").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcountry&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#countrystatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			     $("#menumaincategory_div").addClass("has-error");
	  $("#country").focus();
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




		function validate_registration()
			{
                            
			 if(validate_country())
				{
                                 
                                
				}
			
                    }
		function validate_country()   
			{
				if($(".countryname").val()=="")
				{
                                    
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Country Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					$("#menumaincategory_div").addClass("has-error");
                                        
						  document.country_master.focus();
                                                 // alert("Enter Country");
                                                   $(".countryname").focus();
						  return false;
				}
                               var alphanumers = /^[a-zA-Z ]+$/;
                              if(!alphanumers.test($("#country").val())){
                              $("#menumaincategory_div").addClass("has-error");
                                document.country_master.focus();
                                $(".countryname").focus();
                                
                                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Numeric value and Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                
                                
                             //alert("Numeric value and Special Charecter Not Allowed.");
                          }  
        
                                        else
					 {
						 var a=document.getElementById("country").value;
						/*$("#menumaincategory_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;*/
								   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcountry&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#countrystatus1234');
			if(data =="sorry")
			{
                             $(".countryname").focus();
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exists');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#country").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	  //	alert('aa');
	document.country_master.submit();
			}
			}
		});  
							 
							 
							 
							 
					 }
                                   }
                                   
                      
                     
			</script>
 <script>   
 function countryclr()
 {
	  document.getElementById('country').value = '';
	   document.getElementById('nationality').value = '';
	    document.getElementById('currencycode').value = '';
		 document.getElementById('conversionrate').value = '';
      $('#countrystatus1234').text('');
		 $("#menumaincategory_div").removeClass("has-error");
 }
     
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	
	if(check==true)
	{
		window.location="country_master.php?id="+id+"&delete=yes";
	}
}
</script>
<script type="text/javascript">
			function validateSearch()
			{
				var country=$("#countrys").val();
				if(country=="")
				{
					country="null";
				}
				var nationality=$("#nationalitys").val();
				if(nationality=="")
				{
					nationality="null";
				}
				var currency=$("#currencys").val();
				if(currency=="")
				{
					currency="null";
				}
				//alert(country+nationality+currency)
                                
                               if(country.length>2){ 
                                
				  $.ajax({
                        type: "POST",
                        url: "load_divmaster.php",
                        data: "value=searchcountry&country="+country+"&nationality="+nationality+"&currency="+currency,
                        success: function(msg)
                        {
							$('#listall').html(msg);
                        }
                    }); 
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