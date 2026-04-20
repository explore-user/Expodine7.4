<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=3;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_corporatemaster WHERE ct_corporatecode = '" .$_REQUEST['id']."'");
// header("location:corporate_discount.php?msg=1");
  if (!headers_sent())
    {    
        header('Location: corporate_discount.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="corporate_discount.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=corporate_discount.php?msg=1" />';
        echo '</noscript>'; exit;
    }

}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['corporatename']))
{
    
    
	$insertion['ct_corporatename'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['corporatename']));
	
        if($_REQUEST['credit_partner']!=''){
            $insertion['ct_online_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['credit_partner'])); 
        }
        
        $sql=$database->check_duplicate_entry('tbl_corporatemaster',$insertion);
	 if($sql!=1)
	{
             
	$insertid              			=  $database->insert('tbl_corporatemaster',$insertion);
	$database->updateexpodine_machines(); 
	
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	 $lastid='';
	 $sql_login  =  $database->mysqlQuery("select ct_corporatecode from tbl_corporatemaster where "
         . "	ct_corporatename='".$insertion['ct_corporatename']."' "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['ct_corporatecode'];
			}

                        
                        
        ///company credit master adding/////
                        
        $insertion4['crd_branchid'] 		=  '1';
		
	$insertion4['crd_active'] 		=  'Y';
	
	$insertion4['crd_type'] 		=  '3';	
                        
	$insertion4['crd_totalamount'] =		0;
		
        $insertion4['crd_corporateid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($lastid));              
               		
        $sql5=$database->check_duplicate_entry('tbl_credit_master',$insertion);
   
	 if($sql5!=1)
	{
	   $insertid4   =  $database->insert('tbl_credit_master',$insertion4);          
                       
        }
	 
        
         /////company ledger/////
        
           $cr='20';
           $company_acc='';
           $sql_kot  =  $database->mysqlQuery("select ct_corporatename from tbl_corporatemaster where ct_corporatecode='$lastid' "); 
	   $num_kot   = $database->mysqlNumRows($sql_kot);
	   if($num_kot){
	   while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
	   {
               $company_acc=$result_kot['ct_corporatename'];
           }}
           
      $insertion1['tlm_company_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['company']));
      $insertion1['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($company_acc));
      $insertion1['tlm_group'] 		        =  mysqli_real_escape_string($database->DatabaseLink,trim($cr));
       	
       $sql1=$database->check_duplicate_entry('tbl_ledger_master',$insertion1);
  
	 if($sql1!=1)
	{
	$insertid1   =  $database->insert('tbl_ledger_master',$insertion1);
        } 
            
        //end/////  
        
        
        
        
        
	if (!headers_sent())
        {    
                header('Location: corporate_discount.php?msg=2');
                exit;
        }else{  
            
                echo '<script type="text/javascript">';
                echo 'window.location.href="corporate_discount.php?msg=2";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=corporate_discount.php?msg=2" />';
                echo '</noscript>'; exit;
        }

}

}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['corporatename1']))
{
	$id=$_REQUEST['corporatecode'];
	$discount=trim($_REQUEST['discount1']);
	$corporatename=trim($_REQUEST['corporatename1']);
        
        $query3=$database->mysqlQuery("update tbl_corporatemaster set ct_corporatename='$corporatename' where ct_corporatecode='$id'");


        $query34=$database->mysqlQuery("update tbl_ledger_master set tlm_ledger_name='$corporatename' where tlm_company_id='$id'");

        $database->updateexpodine_machines(); 

        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");

	if (!headers_sent())
        {    
        header('Location: corporate_discount.php?msg=3');
        exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="corporate_discount.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=corporate_discount.php?msg=3" />';
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
<title>Company</title>
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
		jQuery(document).ready(function(){
			$('#coprnames').autocomplete({source:'autocomplete/find_keywords.php?type=coprnames_s', minLength:1});
			$('#corpdiscs').autocomplete({source:'autocomplete/find_keywords.php?type=corpdiscs_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script> 

	

	$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
    $("#modal-17").removeClass('md-show');
    });


$(document).ready(function(){
$("#coprnames").focus();

	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_corp').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/corp_edit.php", {menu:menuid},
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
					<li><a style="cursor:pointer">Corporate</a></li>
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
                           		<span class="filte_new_text">Corporate Name</span>
                                <input type="text" class="form-control filte_new_box" id="coprnames" name="coprnames" placeholder="Corporate Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Corporate Discount</span>
                                <input type="text" class="form-control filte_new_box" id="corpdiscs" name="corpdiscs" placeholder="Corporate Discount" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="corporate_discount.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="corporateclr()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                 <th>Corporate Name</th>
       							
                                 <td >Action</td>
                              </tr>
                             </thead>
                                 <?php
								 
	 $sql_login  =  $database->mysqlQuery("select * from tbl_corporatemaster where ct_status='Y' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){  
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
    						<tr id="ids_<?=$result_login['ct_corporatecode']?>"  class="select">
                                <td><?=$result_login['ct_corporatename']?></td>
                               
                                
                                <?php if($result_login['ct_online_id'] == 0 ){ ?>
                                <td>
                                <a href="#" class="md-trigger_corp" id="ids_<?=$result_login['ct_corporatecode']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ct_corporatecode']?>">
                               <!--  <a href="#" onClick="delete_confirm('<?=$result_login['ct_corporatecode']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                                </td>
                                
                                <?php } else{ ?>
                                <td title="EDIT POSSIBLE ONLY FROM ONLINE PARTNER SECTION" style="color: red;font-weight: bold ;cursor: pointer"> ACCESS DENIED </td> 
                                <?php } ?>
                                
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
                              <form role="form" action="corporate_discount.php"  method="post"  name="corporate_discount">
                                <span id="corpchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Corporate Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" class="form-control corporatename" id="corporatename" name="corporatename"  placeholder="Corporate Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="CorporateName" ></div>
                               </div>
                               
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Credit Partner<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     
                                     
                                     <select class="form-control" id="credit_partner" name="credit_partner">
                                             <option value="">Select</option>
                                             
                                              <?php
								 
	  $sql_login  =  $database->mysqlQuery("select * from tbl_online_order where tol_status='Y' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){  
		  while($result_login5  = $database->mysqlFetchArray($sql_login)) 
			{
                      ?>
                       <option value="<?=$result_login5['tol_id']?>"><?=$result_login5['tol_name']?></option>
                      
                      <?php
                  }
                  }
                        ?>                     
                                     </select>
                                     
                                     
                                     
                               </div>
                                
                                
                                 
                                  </form> 
                    </div>
                    </div>                
                             <a href="#"><button class="md-close" tabindex="4">Close</button></a>
                             
                              <a  href="#" class="entersubmit" onClick="validate_corpd()" tabindex="3"><button class="md-save">Save</button></a>
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">

$(".add_btn_2").click(function()
{

	//alert("hiii");
$("#corporatename").focus();
});

    $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function validate_all()
{
	 //var a=document.getElementById("corporatename").value;
		var a=$("#corporatename").val().trim();

			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcorporate&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#corpchk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#corporatename").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.corporate_discount.submit();

			}
			}
		});

	
}
function corporateclr()
{
	document.getElementById('corporatename').value = '';
        document.getElementById('corporatediscountname').value = '';
     	$('#corpchk').text('');
		$("#menumaincategory_div").removeClass("has-error");
                $("#disc_div").removeClass("has-error");
}


function validate_corpd()
	{
	 if(validate_corporate())
		{
			
				if(validate_all())
			{
			}
				
			//document.corporate_discount.submit();
			
		}
	}
function validate_corporate()   
	{
		if($(".corporatename").val()=="")
		{
			$("#menumaincategory_div").addClass("has-error");
			document.corporate_discount.corporatename.focus();
                        alert("Enter Corporate Name");
			return false;
		}
                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                 if(!alphanumers.test($("#corporatename").val())){
                 $("#menumaincategory_div").addClass("has-error");
                  document.corporate_discount.corporatename.focus();
                  alert("Special charecter Not Allowed.");
              }
                      else
			 {
				var a=document.getElementById("corporatename").value;
				$("#menumaincategory_div").removeClass("has-error");
				$(this).addClass("has-success");
				return true;
			 }
	}
	
function delete_confirm(id)
{
	
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="corporate_discount.php?id="+id+"&delete=yes";
	}
}	
</script>
<script type="text/javascript">
function validateSearch()
{
  var coprnames=$("#coprnames").val();
  if(coprnames=="")
  {
	  coprnames="null";
  }
  var corpdiscs=$("#corpdiscs").val();
  if(corpdiscs=="")
  {
	  corpdiscs="null";
  }
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=searchcorporate&coprnames="+coprnames+"&corpdiscs="+corpdiscs,
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