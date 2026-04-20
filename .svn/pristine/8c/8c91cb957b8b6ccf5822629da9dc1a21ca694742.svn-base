<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=5;
if(isset($_REQUEST['delete']))
{
  $id=$_REQUEST['id'];
  $database->mysqlQuery("DELETE FROM tbl_city WHERE cy_cityid = '" .$_REQUEST['id']."'");
 // header("location:city_master.php?msg=1");
  if (!headers_sent())
    {    
        header('Location: city_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="city_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=city_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }

}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['city']))
{
	$insertion['cy_cityname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['city']));
    $insertion['cy_stateid']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['state']));
	 $insertion['cy_countryid']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['country']));
	//print_r($insertion); die();
    $sql=$database->check_duplicate_entry('tbl_city',$insertion);
    if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_city',$insertion);
//	header("location:city_master.php?msg=2");
	}
	if (!headers_sent())
    {    
        header('Location: city_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="city_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=city_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
	 
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['city1']))
{
	$id=$_REQUEST['cityid'];
	$city=trim($_REQUEST['city1']);
    $state=trim($_REQUEST['state1']);
$country=trim($_REQUEST['country1']);
$query3=$database->mysqlQuery("update tbl_city set cy_cityname='$city', cy_stateid='$state',cy_countryid='$country' where cy_cityid='$id'");
	//header("location: city_master.php?msg=3");
	if (!headers_sent())
    {    
        header('Location: city_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="city_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=city_master.php?msg=3" />';
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
<title>City</title>
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
			$('#citys').autocomplete({source:'autocomplete/find_keywords.php?type=city_s', minLength:1});
			$('#countrys').autocomplete({source:'autocomplete/find_keywords.php?type=countrys_s', minLength:1});
			$('#states').autocomplete({source:'autocomplete/find_keywords.php?type=state_s', minLength:1});
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
			  $.post("popup/city_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">City</a></li>
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
                            	<span class="filte_new_text">City</span>
                                <input type="text" class="form-control filte_new_box" id="citys" name="citys" placeholder="City" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Country</span>
                                <input type="text" class="form-control filte_new_box" id="countrys" name="countrys" placeholder="Country" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                            	<span class="filte_new_text">State</span>
                                <input type="text" class="form-control filte_new_box" id="states" name="states" placeholder="State" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="city_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="cityclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>City</th>
                                <th>Country</th>
                                <th>State</th>
                                <td>Action</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_city LEFT JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid LEFT JOIN tbl_country ON  tbl_city.cy_countryid=tbl_country.cy_countyid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['cy_cityid']?>"  class="select">
                                <td><?=$result_login['cy_cityname']?></td>
                                <td><?=$result_login['cy_countryname']?></td>
                                <td><?=$result_login['se_statename']?></td>
                                
                                <td>
                                 <a href="#" class="md-trigger_cat" id="ids_<?=$result_login['cy_cityid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['cy_cityid']?>">
                               <!--  <a href="#" onClick="delete_confirm('<?=$result_login['cy_cityid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
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
                <div class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="city_master.php"  method="post"  name="city_master">
                        	 
                               <div class="first_form_contain">
                                 	<div class="form_name_cc">Country<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group statename" id="country_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_country"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){  ?>
                                        <select data-placeholder="Enter State Name" id="country" name="country" tabindex="2" data-rel="chosen" title="Country Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown" onChange="viewstate(this.value)">
                                        <option value=""></option>
                                         <optgroup label="COUNTRY">
                                         <?php while($result_kot  = $database->mysqlFetchArray($sql_kot)) 	{ ?>
                                            <option value="<?=$result_kot['cy_countyid']?>" id="<?=$result_kot['cy_countyid']?>" ><?=$result_kot['cy_countryname']?></option>
                                          <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain--> 
                            <div class="first_form_contain">
                                 	<div class="form_name_cc">State<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group statename" id="state_div">
                                  <select data-placeholder="Enter State Name" id="state" name="state" data-rel="chosen" tabindex="3" title="State Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="STATE">
                                         </optgroup>
                                    	 </select>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain--> 
                                    
                                    <div class="first_form_contain">
                                <span id="citytatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">City<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="city_div">
                                     <input type="text" class="form-control cityname" id="city" name="city"  placeholder="City Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="City Name"  ></div>
                               </div>    
                                  </form> 
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_city()"><button class="md-save" tabindex="4">Save</button></a>
                             <!--<a href="#"><button class="md-close" tabindex="5">Close me!</button></a>-->
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>-->
<!--<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>
<script type="text/javascript" src="js/app.js"></script>-->
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
function cityclr()
{
	document.getElementById('city').value = '';
	document.getElementById('country').value = '';
	document.getElementById('state').value = '';
	//$('#active').val('');
	$('#citytatus1234').text('');
		 $("#city_div").removeClass("has-error");
	 //  $("#city_div").addClass("has-success");
	   $("#country_div").removeClass("has-error");
	 //  $("#country_div").addClass("has-success");
	    $("#state_div").removeClass("has-error");
	 //  $("#state_div").addClass("has-success"); 
}



function valicity()
{
	 var a=$("#city").val().trim();
	var b=$("#country").find('option:selected').attr('id');
	var c=$("#state").find('option:selected').attr('id');
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcity&mid="+a+"&cntryid="+b+"&state="+c,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#citytatus1234');
				if(msg =="sorry")
					{
                                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already exists');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					$("#menumaincategory_div").addClass("has-error");
			//  namechk.text('Already exists');
			     $("#city_div").addClass("has-error");
	  $("#city").focus();
					}
					else
					{
						namechk.text('');
						 $("#city_div").removeClass("has-error");
	   $("#city_div").addClass("has-success");
	   	document.city_master.submit();
					}
			}
		});
}

		function validate_city()
			{
			 if(validate_cityname())
				{
					if(validate_country())
					{
						if(validate_state())
						{
							if(valicity())
							{
							}
						//document.city_master.submit();
						}
					}
				}
			}
		function validate_cityname()   
			{
				if($(".cityname").val()=="")
				{
					$("#city_div").addClass("has-error");
					document.city_master.city.focus();
                                        //alert("Enter City");
                                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter City Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					return false;
				}
                                 var alphanumers = /^[a-zA-Z ]+$/;
                              if(!alphanumers.test($("#city").val())){
                              $("#city_div").addClass("has-error");
                             document.city_master.city.focus();
                             //alert("Numeric value and Special Charecter Not Allowed.");
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Numeric value and Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
//                          alert("Special charecter Not Allowed.");
                   }  
        
                                    else
					 {
						 var a=document.getElementById("city").value;						 
							  $("#city_div").removeClass("has-error");
					     	  $(this).addClass("has-success");
						 	  return true;
						/*$("#menumaincategory_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;*/
							 
					 }
                                     }
                              
			
		function validate_state()   
			{
				if($("#state").val()=="" || $("#state").val()==null)
				{
					$("#state_div").addClass("has-error");
						  document.city_master.state.focus();
                                                 // alert("Select State");
                                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select State');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
        
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#state").val())){
                              $("#state_div").addClass("has-error");
                              document.city_master.state.focus();
//                          alert("Special charecter Not Allowed.");
                   }  
        
        
        
                                     else
					 {
						
						$("#state_div").removeClass("has-error");
							$("#state_div").addClass("has-success");
							 return true;
					 }
                                     }
                                 	
			function validate_country()   
			{
				if($("#country").val()=="")
				{
					$("#country_div").addClass("has-error");
						  document.city_master.country.focus();
                                                          //alert("Select Country");
                                                           $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Country');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                    var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#country").val())){
                              $("#country_div").addClass("has-error");
                             document.city_master.country.focus();
//                          alert("Special charecter Not Allowed.");
                   }  
        
                                  else
					 {
						
						$("#country_div").removeClass("has-error");
							$("#country_div").addClass("has-success");
							 return true;
					 }
                                     }
                                
	function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="city_master.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{
  var city=$("#citys").val();
  if(city=="")
  {
	  city="null";
  }
  var state=$("#states").val();
  if(state=="")
  {
	  state="null";
  }
   var country=$("#countrys").val();
  if(country=="")
  {
	  country="null";
  }
  
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=searchcity&srchid="+city+"&stateid="+state+"&countryid="+country,
		  success: function(msg)
		  {
			  $('#listall').html(msg);
		  }
	  });  
}
function viewstate(val)
{
	//alert(val);
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadstate&stateid="+val,
		  success: function(msg)
		  {
			  $('#state').html(msg);
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