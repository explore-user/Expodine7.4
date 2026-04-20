<?php

include('includes/session.php');    // Check session
include("database.class.php");     // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=19;

if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
   if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_bankmaster SET  bm_active='Y' WHERE bm_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_bankmaster SET  bm_active='N' WHERE bm_id = '" .$_REQUEST['id']."'");
	}
	        
	 	 if (!headers_sent())
        {    
        header('Location: bank_master.php?msg=3');
        exit;
        }
         else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="bank_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=bank_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['bank']))
{
	
	$insertion['bm_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bank']));
        
        if($_REQUEST['bank_acc']!=''){
           $insertion['bm_account'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bank_acc']));
        }
        
         if($_REQUEST['lukado']!=''){
           $insertion['bm_lukado'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lukado']));
         }
        
        
	if(isset($_REQUEST['active']))
	{
	   $insertion['bm_active'] 		=  'Y';
	}else
	{
	   $insertion['bm_active'] 		=  'N';
	}

     $sql=$database->check_duplicate_entry('tbl_bankmaster',$insertion);
     if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_bankmaster',$insertion);
	$database->updateexpodine_machines(); 
       
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	  $lastid='';
	  $sql_login  =  $database->mysqlQuery("select bm_id from tbl_bankmaster where 	bm_name='".$insertion['bm_name']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['bm_id'];
			}

		
        }
        
	
    if (!headers_sent())
    {    
        header('Location: bank_master.php?msg=2');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="bank_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=bank_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['bankaname1']))
{
	if(isset($_REQUEST['active1']))
	{
		$active='Y';
	}
        else 
        {
                $active='N';
        }
	
 $id=$_REQUEST['catid'];
	
 $cat=trim($_REQUEST['bankaname1']);

 $luk=$_REQUEST['lukado1'];
 
 
 if($_REQUEST['bank_acc1']!=''){
     
     $query4=$database->mysqlQuery("update tbl_bankmaster set bm_lukado='$luk', bm_name='$cat',bm_account='".$_REQUEST['bank_acc1']."',"
             . " bm_active='$active' where bm_id='$id'");
 }else{
     
    $query4=$database->mysqlQuery("update tbl_bankmaster set bm_lukado='$luk', bm_name='$cat', bm_active='$active' where bm_id='$id'"); 
 }


  $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
 
	$database->updateexpodine_machines(); 
        

	 if (!headers_sent())
    {    
        header('Location: bank_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="bank_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=bank_master.php?msg=3" />';
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
<title>Bank Master</title>
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
#container{overflow:auto !important}
.ui-autocomplete{z-index:999999 !important;}
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#categrys').autocomplete({source:'autocomplete/find_keywords.php?type=categrys_c', minLength:1});
			$('#displys').autocomplete({source:'autocomplete/find_keywords.php?type=displys_c', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_cm', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){

	$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
         $("#modal-17").removeClass('md-show');
    });
    
	$("#bnks").focus();

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
			  $.post("popup/bank_edit.php", {bank:menuid},
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
					<li><a href="admin_home.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Bank</a></li>
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
                       <div style="  border: 1px #B6B6B6 solid;direction" class="cc_new">
                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important;">
					<?php//  include "includes/page_top.php"; ?>
                                    <ul class="als-wrapper">
                                    
                                        <li class="als-item"><a href="bank_master.php" class="new_tab_btn <?php if($linkname=="bank_master.php"){ ?> active_btn_1 <?php } ?>">BANK MASTER</a></li>
                                 
                <?php if( in_array("cardmaster", $_SESSION['menusubarray'])  ) { ?> 
                
                                        <li class="als-item"><a href="cardmaster.php" class="new_tab_btn <?php if($linkname=="cardmaster.php"){ ?> active_btn_1 <?php } ?>">CARD MASTER</a></li>
                                 
                
                <?php } ?>
                                    
                                    </ul>
                                    
				</div>
			</div>
                   </div><!--cc_new-->
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                           <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                           		<span class="filte_new_text">Bank - Upi Name</span>
                                <input type="text" class="form-control filte_new_box" id="bnks" name="bnks" placeholder="Bank - Upi Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                               <!-- <input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                               	<span class="filte_new_text">Select Active Status</span>
                                 <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                   <option value="null">All</option>	
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                               
                                </select>
                            </div>
                            
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="bank_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_bank" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Bank - UPI Name</th>
                                <th >Active</th>
                                 <td >Action</td>
                              </tr>
                             </thead>
          <?php
	  $sql_login  =  $database->mysqlQuery("select * from tbl_bankmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['bm_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
                                
	 ?>
    				<tr id="ids_<?=$result_login['bm_id']?>"  class="select">
                                <td ><?=$result_login['bm_name']?></td>
                                <td ><?=$active?></td>
                                <td >
                                 <a href="#" class="md-trigger_cat" id="ids_<?=$result_login['bm_id']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['bm_id']?>">
                                     
       
                                 <?php if($result_login['bm_active']=="Y"){ ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_login['bm_id']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_login['bm_id']?>')"  > <img src="img/black_tick.png" width="25px" height="25px"></a>
                                 <?php } ?>                              
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
 <div style="width:500px;"  class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>ADD NEW</h3>
				<div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="bank_master.php"  method="post"  name="bank_master">
                                <span id="catstatus1234" class="load_error alertsmaster" style="color:#F00" ></span>   
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Bank Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="bank_div">
                                <input type="text" class="form-control bankname" id="bank" name="bank"  placeholder="Bank Name" tabindex="1"  data-toggle="tooltip" title="Bank Name" onChange="valicat()" >
                                </div>
                               </div>
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input checked type="checkbox" value="1" tabindex="2" name="active"  id="active" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                                
                                
                                
                                
                             <?php  if($_SESSION['accounts_section']=='Y') { ?>      
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Bank Acc<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="bank_div">
                                
                               
                                     <select class="form-control" tabindex="3" id="bank_acc" name="bank_acc">
                            <option value="">Select</option>
                            <?php 
                            $sql_login  =  $database->mysqlQuery("select * from tbl_ledger_master where tlm_type='Bank_account' "); 
                            $num_login   = $database->mysqlNumRows($sql_login);
                            if($num_login){
                              while($result_login  = $database->mysqlFetchArray($sql_login)) 
                              {
                      ?>
                  
                             <option value="<?=$result_login['tlm_id']?>"><?=$result_login['tlm_ledger_name']?></option>
                             
                             <?php } } ?>
                        </select >
                                 
                                 </div>
                               </div> 
                                
                             <?php  } ?>     
                                
                                <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">LUKADO<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="bank_div">
                                
                               
                            <select class="form-control" tabindex="3" id="lukado" name="lukado">
                            <option value="N">NO</option>
                            
                            <?php 
          $sql_login  =  $database->mysqlQuery("select bm_lukado from tbl_bankmaster where bm_lukado='Y' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if(!$num_login){ ?>
                            <option value="Y">YES</option>
                            
                        <?php }  ?>      
                        </select >
                                 
                                 </div>
                               </div> 
                                
                                
                                  </form> 
                    </div>
                                   

                             
                              <a  href="#" class="entersubmit" tabindex="4" onClick="validate_bank()"><button class="md-save">Save</button></a>
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
		function validate_bank()
			{
				if($(".bankname").val()=="")
				{
					$("#bank_div").addClass("has-error");
					document.bank_master.bank.focus();
                                       // alert("Enter Bank Name");
                                       $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Bank Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					return false;
                                        
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#bank").val())){
                              $("#bank_div").addClass("has-error");
                         document.bank_master.bank.focus();
                  //alert("Special charecter Not Allowed.");
                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
                              
        
                                 else
					 {
						 var ab=document.getElementById("bank").value.trim();						 
						 
							 /* $("#menumaincategory_div").removeClass("has-error");
					     	  $(this).addClass("has-success");
						 	  return true;*/
							   //
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkbank&mid="+ab,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#catstatus1234');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 //namechk.text('Already exists');
		   $("#bank_div").addClass("has-error");
	  $("#bank").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#bank_div").removeClass("has-error");
	   $("#bank_div").addClass("has-success");
	
	  //	alert('aa');
	document.bank_master.submit();
			}
			}
		}); 
						
					 }
			
			         }
                        
  function confirm_yes_new(){
      
      
         var status=  $('#confirm_pop_all').attr('status');
         var id =   $('#confirm_pop_all').attr('id_new');
        
             
       
                if(status=="ToYes")
		{
		   window.location="bank_master.php?id="+id+"&delete=yes";
                   
		}else
		{ 
                    window.location="bank_master.php?id="+id+"&delete=no";
		}
      
       
         
        
      
  }
  
  
   function delete_confirm(status,id)
  {
      
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CHANGE STATUS ?');
         
         $('#confirm_pop_all').attr('status',status);
         $('#confirm_pop_all').attr('id_new',id);
      
  }	
</script>
<script type="text/javascript">
function testclr()
{
	
	document.getElementById('bank').value = '';
	
	$('#catstatus1234').text('');
	$("#bank_div").removeClass("has-error");
	
	//$("input[type=checkbox]").each(function() { this.checked=false; });
}


function valicat()
{
	 var a=$("#bank").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkbank&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#catstatus1234');
				if(msg =="sorry")
					{
                                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
			  //namechk.text('Already exists');
			    $("#bank_div").addClass("has-error");
	  $("#bank").focus();
					}
					else
					{
						namechk.text('');
						 $("#bank_div").removeClass("has-error");
	   $("#bank_div").addClass("has-success");
					}
			}
		});
}

function validateSearch()
{//categrys displys statuss 
	 var bank=$("#bnks").val();
  if(bank=="")
  {
	  bank="null";
  }
 
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchbnk&bank="+bank+"&statuss="+statuss,
			success: function(msg)
			{
			 $('#listall').html(msg);
			}
		});  
}
</script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">


$("#add_bank").click(function()
{
$("#bank").focus();
});

$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>