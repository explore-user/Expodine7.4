<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=6;

if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menusubcategory SET  msy_active='Y' WHERE msy_subcategoryid = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menusubcategory SET  msy_active='N' WHERE msy_subcategoryid = '" .$_REQUEST['id']."'");
	}
	
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
    if (!headers_sent())
    {    
        header('Location: sub_category_master.php?msg=3');
        exit;
    }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sub_category_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sub_category_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
	
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['subcategory']))
{
	 $insertion['msy_subcategoryname'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['subcategory']));
	if(isset($_REQUEST['active']))
	{
	 	 $insertion['msy_active'] 		=  'Y';
	}else
	{
	 	 $insertion['msy_active'] 		=  'N';
	}
        
        if($_REQUEST['dis_order']!=""){
            
        $insertion['msy_sub_displayorder']=$_REQUEST['dis_order'];
        
        }
        
	$insertion['msy_branchid']=$_SESSION['branchofid'];
		
        $sql=$database->check_duplicate_entry('tbl_menusubcategory',$insertion);
	
	 if($sql!=1)
	{
             
	 $insertid              			=  $database->insert('tbl_menusubcategory',$insertion);
         $database->updateexpodine_machines(); 
	
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
         
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select msy_subcategoryid from tbl_menusubcategory where 	msy_subcategoryname='".$insertion['msy_subcategoryname']."'  AND msy_branchid='".$insertion['msy_branchid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['msy_subcategoryid'];
			}

         }
         
    if (!headers_sent())
    {    
        header('Location: sub_category_master.php?msg=2');
        exit;
    }
    else
    {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sub_category_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sub_category_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
	
	
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['subcategory1']))
{
	if(isset($_REQUEST['active1']))
	{
		$active='Y';
		
	}
    else 
    {
            $active='N';
    }       
    if($_REQUEST['dis_order1']!=""){
            $dis_order1=$_REQUEST['dis_order1'];
    }else{
       $dis_order1="1"; 
    }
    
    
	$id=$_REQUEST['subcatid'];
	$subcat=trim($_REQUEST['subcategory1']);
	$brid=$_SESSION['branchofid'];
        
        $query3=$database->mysqlQuery("update tbl_menusubcategory set msy_sub_displayorder='".$dis_order1."',msy_subcategoryname='".$subcat."', "
                . " msy_active='".$active."',msy_branchid='".$brid."' where msy_subcategoryid='".$id."'");
        
	$database->updateexpodine_machines(); 

         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        

if (!headers_sent())
    {    
        header('Location: sub_category_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sub_category_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sub_category_master.php?msg=3" />';
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
<title>Sub Category</title>
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
		jQuery(document).ready(function(){ //  subcatnams statuss subcatnams_su statuss_su
			$('#subcatnams').autocomplete({source:'autocomplete/find_keywords.php?type=subcatnams_su', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_su', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
    
  
$(document).ready(function(){
      $('#subcatnams').focus();
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
			  $.post("popup/subcategory_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Sub Category</a></li>
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
                            	<span class="filte_new_text">Sub Category Name</span>
                                <input type="text" class="form-control filte_new_box" id="subcatnams" name="subcatnams" placeholder="Sub category Name" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                <!--<input type="text" class="form-control" id="statuss" name="statuss" placeholder="Status" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">-->
                                <span class="filte_new_text">Select Active Status</span>
                                 <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                       
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="sub_category_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_sub_cat" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th width="25%">Sub Category Name</th>
                                 <th width="25%">Display order</th>
                                <th width="25%">Active</th>
                                 <td width="25%">Action</td>
                              </tr>
                             </thead>
          <?php
	  $sql_login  =  $database->mysqlQuery("select * from tbl_menusubcategory where msy_delete_mode='N' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['msy_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
	 ?>
    				<tr id="ids_<?=$result_login['msy_subcategoryid']?>"  class="select">
                                <td><?=$result_login['msy_subcategoryname']?></td>
                                 <td><?=$result_login['msy_sub_displayorder']?></td>
                                <td><?=$active?></td>
                                <td>
                                 <a href="#" class="md-trigger_cat" id="ids_<?=$result_login['msy_subcategoryid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['msy_subcategoryid']?>">
                              <!--   <a href="#" onClick="delete_confirm('<?=$result_login['msy_subcategoryid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                              
                                 <?php if($result_login['msy_active']=="Y"){ ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_login['msy_subcategoryid']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_login['msy_subcategoryid']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
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
 <div style="width:600px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="sub_category_master.php"  method="post"  name="sub_category_master">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Sub Category Name<span style="color:#F00">*</span></div>
                                 <span id="subcatstatus1234" class="load_error alertsmaster" style="color:#F00" ></span>  
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control subcategoryname" id="subcategory" name="subcategory"  placeholder="Sub Category Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Sub Category Name" onChange="valisubcat()" >
                                
                                
                                </div>
                               </div>
                                  <div class="first_form_contain">
                             	<div class="form_name_cc">Display Order<span style="color:#F00"></span></div>
                                 <span id="subcatstatus1234" class="load_error alertsmaster" style="color:#F00" ></span>  
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control subcategoryname" id="dis_order" name="dis_order"  placeholder=" Display order" tabindex="1"   data-toggle="tooltip" title="Sub Category Name"  >
                                
                                
                                </div>
                               </div>
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div1">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox" value="1" tabindex="5" name="active"  id="active" data-toggle="tooltip" title="Active">
                    </label>
                </div>              
                                </div>
                                  </div>
                                  </form> 
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_subcategory()"><button class="md-save" tabindex="6">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="7">Close me!</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
	$('#add_sub_cat').click(function()
	{
		$('#subcategory').focus();
	});
	
  $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function testclr()
{
	
	document.getElementById('subcategory').value = '';
	$('#subcatstatus1234').text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	$("input[type=checkbox]").each(function() { this.checked=false; });
}
		function validate_subcategory()
			{
			 if(validate_menusubcategory())
				{
					
				}
			}
		function validate_menusubcategory()   
			{
				if($(".subcategoryname").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
						  document.sub_category_master.subcategory.focus();
                                                  alert("Enter Sub Category Name")
						  return false;
				}
                        var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#subcategory").val())){
                              $("#menumaincategory_div").addClass("has-error");
                            document.sub_category_master.subcategory.focus();
                          alert("Special charecter Not Allowed.");
                   }

                                else
					 {
						 var a=document.getElementById("subcategory").value;
						 
						/* $("#menumaincategory_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;*/
						 
						   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checksubcat&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#subcatstatus1234');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#subcategory").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	  //	alert('aa');
	document.sub_category_master.submit();
			}
			}
		}); 
						 
                               }		
                            }
			
function confirm_yes_new(){
    
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
         
       var mode= $('#confirm_pop_all').attr('mode'); 
      
      var id= $('#confirm_pop_all').attr('edit_id'); 
      
        var status= $('#confirm_pop_all').attr('status'); 
        
        if(status=="ToYes")
		{
		window.location="sub_category_master.php?id="+id+"&delete=yes";
		}else
		{window.location="sub_category_master.php?id="+id+"&delete=no";
		}
	
        
        
    }
	
	function delete_confirm(status,id)
{
    $('#confirm_pop_all').show();
                
    $('#pop_head_com').text('CONFIRM STATUS CHANGE');
        
      
        $('#confirm_pop_all').attr('mode','edit');
    
          $('#confirm_pop_all').attr('edit_id',id); 
    
    $('#confirm_pop_all').attr('status',status); 
    
}
	
</script>
<script type="text/javascript">
function valisubcat()
{
	 var a=$("#subcategory").val().trim();
	
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checksubcat&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#subcatstatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			     $("#menumaincategory_div").addClass("has-error");
	  $("#category").focus();
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


function validateSearch()
{// subcatnams statuss 
	 var subcatnams=$("#subcatnams").val();
  if(subcatnams=="")
  {
	  subcatnams="null";
  }
  var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
  
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchsubcategory&subcatnams="+subcatnams+"&statuss="+statuss,
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

$(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)

		  $("#modal-17").removeClass('md-show');
	});
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>