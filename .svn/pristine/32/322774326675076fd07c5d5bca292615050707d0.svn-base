<?php
//include('includes/session.php');	// Check session
session_start();

include("database.class.php"); // DB Connection class
$database	= new Database();

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['rptname'])  )
{

$insertion['rm_reportid']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rptid']));
$insertion['rm_reportname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rptname']));	
$insertion['rm_posprintofanother'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['toprint']));			
		
	if(isset($_REQUEST['chkactive']))
	{
	 $insertion['rm_reportview'] 		=  'Y';
	}else
	{
	 $insertion['rm_reportview'] 		=  'N';
	}
		
		if(isset($_REQUEST['chkactive']))
	{
	 $insertion['rm_reportview'] 		=  'Y';
	}else
	{
	 $insertion['rm_reportview'] 		=  'N';
	}
	if(isset($_REQUEST['chkprinta4']))
	{
	 $insertion['rm_reportview'] 		=  'Y';
	}else
	{
	 $insertion['rm_reportview'] 		=  'N';
	}
	if(isset($_REQUEST['chkemail']))
	{
	 $insertion['rm_reportview'] 		=  'Y';
	}else
	{
	 $insertion['rm_reportview'] 		=  'N';
	}
	if(isset($_REQUEST['chkdayclosemail']))
	{
	 $insertion['rm_dayclosemail'] 		=  'Y';
	}else
	{
	 $insertion['rm_dayclosemail'] 		=  'N';
	}
		
		if(isset($_REQUEST['chkdaycloseprint']))
	{
	 $insertion['rm_daycloseprint'] 		=  'Y';
	}else
	{
	 $insertion['rm_daycloseprint'] 		=  'N';
	}
	
		 $insertid              			=  $database->insert('tbl_reportmaster',$insertion);
	//$insertid              			=  $database->insert('tbl_loyalty_reg',$insertion);
	
	 if (!headers_sent())
    {    
        header('Location: report_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="report_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=report_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['reportnamez']))
{

	$reptid=$_REQUEST['reptid'];
	$reportid=$_REQUEST['reportid'];
	$reptname=$_REQUEST['reportnamez'];
	$toprnt=$_REQUEST['toprintreport'];
	if(isset($_REQUEST['active1']))
	{
		$active='Y';
	}
  else 
   {
	$active='N';
    }
	
		if(isset($_REQUEST['printa4s']))
	{
		$printa4s='Y';
	}
  else 
   {
	$printa4s='N';
    }
	
	if(isset($_REQUEST['emails']))
	{
		$emails='Y';
	}
  else 
   {
	$emails='N';
    }
	if(isset($_REQUEST['dayclosemail1']))
	{
		$dayclosemail1='Y';
	}
  else 
   {
	$dayclosemail1='N';
    }
	if(isset($_REQUEST['daycloseprint1']))
	{
		$daycloseprint1='Y';
	}
  else 
   {
	$daycloseprint1='N';
    }
	
	$query3=$database->mysqlQuery("update tbl_reportmaster set  rm_dayclosemail='$dayclosemail1',  rm_daycloseprint='$daycloseprint1',rm_email='$emails',rm_posprintofanother='$toprnt',rm_printa4='$printa4s',rm_reportid='$reportid',rm_reportname='$reptname',rm_reportview='$active' where rm_id='$reptid'");

	   if (!headers_sent())
    {    
        header('Location: report_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="report_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=report_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }

	
}


if(isset($_REQUEST['delete']))
{
    $id=$_REQUEST['id'];
	if($_REQUEST['delete']=="yes")
	{
		$database->mysqlQuery("UPDATE tbl_reportmaster SET rm_reportview = 'Y' WHERE rm_id = '" .$_REQUEST['id']."'");
	}else
	{
		$database->mysqlQuery("UPDATE tbl_reportmaster SET rm_reportview = 'N' WHERE rm_id = '" .$_REQUEST['id']."'");
	}
  // header("location:menu.php");
 	 if (!headers_sent())
    {    
        header('Location: report_master.php');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="report_master.php";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=report_master.php" />';
        echo '</noscript>'; exit;
    }
}








?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Reports</title>
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
 
 <script>
$(document).ready(function(){
	$('.tablesorter tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_edit').click( function() { 
	
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.tablesorter tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			
			
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			
			  $.post("popup/report_master_edit.php", {rm_id:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				 
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	
	
		$('.md-trigger_view').click( function() { 
	
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.tablesorter tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			
			
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			
			  $.post("popup/reportmaster_view.php", {rm_id:menuid},
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
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
 .ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{float:left;min-height:400px;}
.menu_filter_txt{line-height:11px;color:#000;padding-top: 0;height: 15px;}
.filter_main_head{color: #fff;text-align: center;float:left;width:100%;line-height: 25px;}
.responstable th, .responstable td { padding: 0 !important;height: 30px;font-size: 12.5px;line-height: 18px;color: #000;}
.responstable th{color:#fff;}
.master_page_tab_cc {min-height:490px;height:79vh;}
.menu_top_filter_left .form-control { height:30px;line-height:30px;border-radius: 5px;}
.add_text_box {height: 30px;line-height: 30px;padding: 0;padding-left: 5px;}
.search_btn_member_invoice a{line-height:29px;}
.tab_edt_btn{top: 4px;position: relative;}
.md-content .form-control{height: 30px;border-radius:3px;padding: 0;padding-left: 10px;border:solid 1px #ccc;box-shadow:none}
.pop_wdth{width:95%;}
.md-content a .newbut{padding: 0.3em 2.2em;margin: 3px -7px;text-transform:capitalize}
 </style>

</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
    <div class="view-container">
        <div style="top: 58px;" id="container">

            <div class="breadcrumbs">
				
                <ul>
                    <li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
                    <li><a style="cursor:pointer">Report master</a>
                    </li>
                    <span id="ratechange" class="load_error alertsmaster" style="color:#F00"></span>
                </ul>

            </div>
            <!-- breadcrumbs -->
            <div class="content-sec">


                <!-- box head -->
                
                <div class="col-lg-12 col-md-12 middle_container nopadding">
                    <div style="padding:0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--left_container-->
                        <div class="col-lg-12 col-md-12 min-height nopadding">
                            <div class="text_displaying_contain" style="padding: 0.4%;padding-bottom:0">
                                <div class="filter_main_head">
                                <div class="col-sm-2 nopadding" style="width:10%">
                                     <div style="margin-left:2%;" class="search_btn_member_invoice"><a style="line-height: 25px;margin-bottom: 4px;
background-color: #D85A00;" href="#" class="md-trigger" data-modal="modal-16" >Add</a></div>
                                </div>
                                Report Master</div>
                                <div class="master_page_tab_cc">
                                    <div class="menu_top_filter_left" style="width:100%">
                                        <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:17%">
                                                <p class="menu_filter_txt">Report Name</p>
                                                <input type="text" class="form-control" id="reportname" name="reportname" placeholder="Report Name" >
                                            </div>
                                       
                                            <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:14%">
                                                <p class="menu_filter_txt">Status</p>
                                                <select class="add_text_box" id="mstatus" name="mstatus" >
                                                    <option value="null">Select Active Status</option>
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                    <option value="null">All</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2 nopadding" style="width:10%">
                                                <p class="menu_filter_txt">&nbsp;</p>
                                                <div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#" onClick="validateSearch()">Search</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--form_group-->


                                    </div>
                                 
                                    <div class="col-md-12 add_btn_cc_2">
                                     <!--   <div class="btn_cc_2">
                                            <a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-16" onclick="menuclr()"></a>
                                        </div>-->
                                    </div>
                                    <div id="left_table_scr_cc">
                                        <table class="responstable tablesorter" id="listall">
                                        
                                        
                                            <thead>
                                                <tr>
                                                    <th width="5%" class="header">Sl No</th>
                                                    <th width="15%" class="header">Report ID</th>
                                                    <th width="15%" class="header">Report Name</th>
                                                    <th width="8%" >Active</th>
                                                    <th width="13%" class="header">To Print</th>
                                                     <th width="8%" class="header">Print A4</th>
                                                    <th width="8%" class="header">Email</th>
                                                       <th width="10%" class="header">DayClose Mail</th>
                                                       <th width="10%" class="header">DayClose Print</th>
                                                    <th class="header">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                         $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
				if($result_login['rm_reportview']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				
					if($result_login['rm_printa4']=="Y")
				{
				
					$a4="Yes";
				}else 
				{
					$a4="No";
				}	
				
					if($result_login['rm_dayclosemail']=="Y")
				{
				
					$dayclosemail="Yes";
				}else 
				{
					$dayclosemail="No";
				}	
				
					if($result_login['rm_daycloseprint']=="Y")
				{
				
					$daycloseprint="Yes";
				}else 
				{
					$daycloseprint="No";
				}	
				if($result_login['rm_email']=="Y")
				{
				
					$email="Yes";
				}else 
				{
					$email="No";
				}	
				
				
	 ?>
                              <tr  class="clicktoview"  id="ids_<?=$result_login['rm_id']?>" >
                              <td width="5%"><?=$i?></td>
                                <td width="15%"><?=$result_login['rm_reportid']?></td>
                                <td width="15%"><?=$result_login['rm_reportname']?></td>
                                <td width="8%"><?=$active?></td>
                                <td width="13%"><?=$result_login['rm_posprintofanother']?></td>
                                 <td width="8%"><?=$a4?></td>
                                             <td width="8%"><?=$email?></td>                                              
                                  <td width="10%"><?=$dayclosemail?></td>
                                
                                  <td width="10%"><?=$daycloseprint?></td>
                                   <td> 
                                                    <a class="tab_edt_btn md-trigger_view" id="ids_<?=$result_login['rm_id']?>" ><i class="icontick">
                                                    	<img src="img/icon-view.png" width="22px" height="22px"></i>
                                                     </a>
                                                        <a class="tab_edt_btn md-trigger_edit " id="ids_<?=$result_login['rm_id']?>"><i class="fa fa-edit"></i></a>
                                                          <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['rm_id']?>">
                                                          
                                                          
                                    <?php  if($active=="Yes") { ?>

                                                     <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToNo','<?=$result_login['rm_id']?>')"><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"/></i></a>

                                                     <?php }else if($active=="No") { ?>

                                                     <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToYes','<?=$result_login['rm_id']?>')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"/></i></a>


                                                     <?php } ?>                         
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                    <!--    <a class="tab_edt_btn" href="#"><i class="icontick">
                                                          <img src="img/green_tick.png" width="25px" height="25px"></i>
                                                      </a>-->
                                                    </td>
                                            
                                            
                                            
                                                </tr>
                                              <?php  $i++;}
											  
											  }?>
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--left_table_scr_cc-->
                                </div>
                            </div>
                            <!--form_contain_cc-->
                        </div>
                    </div>
                    <!--left_container-->
                </div>
            </div>
        </div>
    </div>
    <!--container-->
</div><!--container-->
</div>


 <div class="md-modal md-effect-16" id="modal-16" style="width:700px;">
 
  	<form role="form" action="report_master.php"  method="post"  name="report_master">
	<div class="md-content">
		<h3>Add New </h3>
		<div style="padding-bottom: 3px;">
    <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:5px;">
        <span id="menuchk" class="load_error alertsmaster" style="color:#F00"></span>
        

        <table class="popup_add_table" width="100%" border="0" cellspacing="5">

            <tbody>
                <tr>
                    <td>
                    	<div class="popup_txt" id="rptid_div">Report ID</div>
                        <input type="text" class="form-control pop_wdth" placeholder="Report ID" name="rptid" id="rptid" >
                    </td>
                    <td>
                    	<div class="popup_txt" id="rptname_div">Report Name</div>
                        <input type="text" class="form-control pop_wdth" placeholder="Report Name" id="rptname" name="rptname" >
                    </td>
                    <td>
                    	<div class="popup_txt" id="toprint_div">To Print</div>
                        <input type="text" class="form-control pop_wdth" placeholder="To Print" id="toprint" name="toprint" >
                    </td>
                    </tr>
                    <tr>
                    <td colspan="3"><span class="chk_lable_pop" style="padding-left:0">Active</span>
                        <span style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx" id="chkactive" name="chkactive" ></span>
                        <span class="chk_lable_pop">Print A4</span>
                        <span style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx" id="chkprinta4" name="chkprinta4" ></span>
                        <span class="chk_lable_pop">Email</span>
                        <span style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx" id="chkemail" name="chkemail"></span>
                        <span class="chk_lable_pop">Dayclose mail</span>
                        <span style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx" id="chkdayclosemail" name="chkdayclosemail"></span>
                        <span class="chk_lable_pop">Dayclose print</span>
                        <span style="position:relative;top:4px;"><input type="checkbox" class="popup_chk_bx" id="chkdaycloseprint" name="chkdaycloseprint"></span>
                    </td>
                </tr>

            </tbody>
        </table>
        
    </div>
    <a href="#"><span class="md-close newbut">Close</span></a>

    <span id="menustatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;"></span>
    <a onClick="validate_registration()"><span class="md-save newbut" >Save</span></a>
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

<script>

function validate_registration()
{
	if(validate_reportid())
	{
		if(validate_reportname())
		{
		if(validate_toprint())
		{
	document.report_master.submit();
		}
		}
	}
	
	
}
function validate_reportid()
{
	if($("#rptid").val()=="")
				{
					$("#rptid_div").addClass("has-error");
						  document.report_master.rptid.focus();
						  return false;
				}else
					 {
						
						 $("#rptid_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
	
}
function validate_reportname()
{
	
	if($("#rptname").val()=="")
				{
					
					$("#rptname_div").addClass("has-error");
						  document.report_master.rptname.focus();
						  return false;
				}else
					 {
						
						 $("#rptname_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
	
	
}
function validate_toprint()
{if($("#toprint").val()=="")
				{
					$("#toprint_div").addClass("has-error");
						  document.report_master.toprint.focus();
						  return false;
				}else
					 {
						
						 $("#toprint_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
	

}
</script>

 <script>       
 

	 
	 
	 
 function validateSearch()
{    
	 var rpt=$("#reportname").val();
  if(rpt=="")
  {
	  rpt="null";
  }
  
  var statuss=$("#mstatus").val();
  
  if(statuss=="")
  {
	  statuss="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchreportmaster&rpt="+rpt+"&statuss="+statuss,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}
	 
	 
	 
	 

 
 
 
 
 
 
 
 
function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="report_master.php?id="+id+"&delete=yes";
		}else
		{window.location="report_master.php?id="+id+"&delete=no";
		}
	}
}
</script>


</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>

</body>
</html>