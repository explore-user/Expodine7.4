<?php
session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['head']))
{
	$insertion['sr_salevalue'] =  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['head']));
	$insertion['sms_text'] =  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['sms_text']));
    $sql=$database->check_duplicate_entry('tbl_sms_report_slab',$insertion);
	 if($sql!=1)
	{
	$insertid=  $database->insert('tbl_sms_report_slab',$insertion);
	 }
	// header("location:country_master.php?msg=2");
	
		 if (!headers_sent())
    {    
        header('Location: sms_report.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sms_report.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sms_report.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if(isset($_REQUEST['id']))
{
    $id=$_REQUEST['id'];
	//$database->mysqlQuery("DELETE FROM tbl_menumaster WHERE mr_menuid = '" .$_REQUEST['id']."'");
	$database->mysqlQuery("DELETE FROM tbl_sms_report_slab WHERE sr_id ='" .$_REQUEST['id']."'");
	//header("location:country_master.php?msg=1");
	 if (!headers_sent())
    {    
        header('Location: sms_report.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sms_report.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sms_report.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['head11']))
{
	$id_sms=trim($_REQUEST['headid']);
	$head_sms=trim($_REQUEST['head11']);
	$sms=trim($_REQUEST['sms_text']);
	
		$query3=$database->mysqlQuery("update tbl_sms_report_slab set sr_salevalue='$head_sms',sms_text='$sms' where sr_id='$id_sms'");
	
	
//$query3=$database->mysqlQuery("update tbl_country set cy_countryname='$country',cy_nationality='$nationality',cy_currencycode='$currencycode' ,cy_conversionrate='$coversionrate' where cy_countyid='$id'");
	//header("location:country_master.php?msg=3");
	 if (!headers_sent())
    {    
        header('Location: sms_report.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sms_report.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sms_report.php?msg=3" />';
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
<title>Sms</title>
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
<style>
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:455px; height:70vh;}
.contant_table_cc{
	  height:75vh;
  min-height:490px;
	}
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
.md-trigger_pas{margin-left:3%;}	 
.tablesorter thead th{height:30px}
.table_report td{height:30px;vertical-align:middle;}
.chk_12{float:none !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	
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
	$('.md-trigger_pas').click( function() { 
	//alert('ok');
		var id_str   =  $(this).attr("id");
		//alert(id_str);
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		
		$('.mynewpopupload').css("display","block");
			
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  
			  $.post("popup/sms_edit.php",{menu:menuid},
				  
				  function(data)
				  {
				
				  data=$.trim(data);
				  //alert(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	
});
</script>
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
					<li><a href="admin_home.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">SMS Report</a></li>
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

                       <div class="cc_new">
                   <div style="background:#fff; width:100%;height:40px;margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6 solid;float:left">
                      <a href="#"><div class="add_btn_sms_report add_popup" data-model="add_content">Add</div> </a>
                    </div>
                   
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th width="10%">Head</th>
                                 <th width="20%">Head</th>
								  <th width="20%">Message</th>
                                 <th width="15%">Action</th>
                              </tr>
                             </thead>
                               
                               <tbody>
                              <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_sms_report_slab order by sr_salevalue ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
							  
                               <tr class="" id="ids_<?=$result_login['sr_id']?>">
							   
                                <td width="10%"><input class="chk_12" name="check" type="checkbox" value="Y"<?php echo ($result_login['sr_active']=='Y' ? 'checked' : '');?>></td>
                                <td width="20%"><?=$result_login['sr_salevalue'];?></td>
								<td width="20%"><?=$result_login['sms_text'];?></td>
                                <td width="15%">
								<input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['sr_id']?>">
                                 <a href="#" class="md-trigger_pas" id="ids_<?=$result_login['sr_id']?>"><img src="images/edit_page.PNG"></a> 
                                 <a href="sms_report.php?id=<?=$result_login['sr_id']?>"  onClick="return confirm('Are you sure you wish to delete this Record?');" name="md-trigger_pas1"><img src="img/delete_btn_2.png"></a>
                                </td>
                                </td>
                              </tr>
                               
	  <?php }}?>          
                               
                                  </tbody>
                        </table>
                   </div>
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
<div class="sms_popup_overlay"></div><!-- the overlay element -->

<div class="sms_popup_add_cc" id="add_content" >
	<div class="content" >
	<div class="sms_pop_head">Add
    	<div class="sms_pop_clos"><img src="img/black_cross.png"></div>
    </div>
	 <form role="form" action="sms_report.php"  method="post" name="sms_report">
    <div class="sms_pop_contant_cc">
	
    	<div class="sms_pop_textbox_lable">Head</div>
    	<div class="sms_pop_textbox_cc" id="menumaincategory_div">
		<span id="countrystatus1234" class="load_error alertsmaster" style="color:#F00" ></span>
		
        	<input name="head" class="sms_pop_textbox" type="text" id="head">
        </div>
        <div class="sms_pop_textbox_lable">Message</div>
    	<div class="sms_pop_textbox_cc" id="menumaincategory_divs">
		<span id="message_status" class="load_error alertsmaster" style="color:#F00" ></span>
		
        	<textarea style="height:auto;" type="text" name="sms_text" id="sms_text" class="sms_pop_textbox smses" ></textarea>
        </div>
	
    </div>
	
	 </form>
    	<a href="#" onClick=" return validate_registration()"><button class="md-save" style="float:right;margin-top:10px;margin-right: 22px;">Submit</button></a>
   
    </div>
</div>
<script type="text/javascript">

function validate_sms()
{
	//alert("sms1");
	 var a=document.getElementById("head").value;
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvalue1&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var namechk=$('#countrystatus1234');
			if(data =="sorry")
			{
				//alert("sms_sorry");
		 namechk.text('Value Less Than Maximum Entered Value');
		   $("#menumaincategory_div").addClass("has-error");
			$("#head").focus();
			return false;
		
	
			}
			else
			{
		//alert("sms-ok");
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	  //	alert('aa');
	 document.sms_report.submit();
	  return true;
			}					 
			}
			});				
}
	function validate_registration()
			{
			
			 if(validate_value())
				{
				//validate_sms();
				}
		
			}
		function validate_value()   
			{
					
				if($("#head").val()=="")
				{
							
					$("#menumaincategory_div").addClass("has-error");
						  document.sms_report.focus();
						//return false;
				}else
					 {
						// alert("value-not-empty");
						 var a=document.getElementById("head").value;
						/*$("#menumaincategory_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;*/
							 
								   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvalue&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var namechk=$('#countrystatus1234');
			if(data =="sorry")
			{
				//alert("value-sorry");
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	 
	//validate_sms();	
	
			}
			else
			{
		//alert("value-ok");
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	 $("#head").focus();
	 validate_sms();
	//document.sms_report.submit();
	
			}
			}
		});  

		}
	}
			
		
		
			$(function(){

  $('#head').keypress(function(e) {
	if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
	e.preventDefault();
  });

});
</script>

<script>
$(".add_popup").click(function(){
    $(".sms_popup_add_cc").css("display","block");
	$(".sms_popup_overlay").css("display","block");
});

$(".sms_pop_clos").click(function(){
    $(".sms_popup_add_cc").css("display","none");
	$(".sms_popup_overlay").css("display","none");
});

</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>