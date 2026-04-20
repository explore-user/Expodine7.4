<?php
include('includes/session.php');		// Check session
//session_start();

include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=10;

if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
   if($_REQUEST['delete']=="yes")
       {
		$result=$database->mysqlQuery("UPDATE  tbl_voucherhead SET  vh_active='Y' WHERE vh_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_voucherhead SET  vh_active='N' WHERE vh_id = '" .$_REQUEST['id']."'");
	}
  
// $database->mysqlQuery("DELETE FROM tbl_voucherhead WHERE vh_id = '" .$_REQUEST['id']."'");
 //header("location:voucher_master.php?msg=1");
  	 if (!headers_sent())
    {    
        header('Location: voucher_head.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_head.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_head.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vouchername'])){
        $insertion['vh_vouchername'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['vouchername']);
	$insertion['vh_branchid']		= $_SESSION['branchofid'];
        //$insertion['vh_type']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']);
         
        if(isset($_REQUEST['active']))
	{
	 		$insertion['vh_active'] 		=  'Y';
	}else
	{
	 		$insertion['vh_active'] 		=  'N';
	}
//        $insertion['vh_branchid']=$_SESSION['branchofid'];
        $sql=$database->check_duplicate_entry('tbl_voucherhead',$insertion);
	 if($sql!=1){
             $insertid              			=  $database->insert('tbl_voucherhead',$insertion);
         }
         // header("location: voucher_master.php?msg=2");
	 if (!headers_sent())
    {    
        header('Location: voucher_head.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_head.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_head.php?msg=2" />';
        echo '</noscript>'; exit;
    }
        
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vouchername1']))
{
    if(isset($_REQUEST['active1']))
	{
		$active='Y';
	}
        else 
         {
	$active='N';
        }
        $id=$_REQUEST['voucherid'];
//        $brid=$_SESSION['branchofid'];
        //$branch=$_REQUEST['branch1'];
        $voucher=$_REQUEST['vouchername1'];
       // $type=$_REQUEST['type1'];
        $query3=$database->mysqlQuery("update tbl_voucherhead set vh_vouchername='$voucher', vh_active='$active' where vh_id='$id'");

        //header("location: voucher_head.php?msg=3");
 if (!headers_sent())
    {    
        header('Location: voucher_head.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_head.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_head.php?msg=3" />';
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
<title>Head</title>
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
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<style>
    
 
    
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 79vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.md-content .first_form_contain {margin-top: 6px;}
.table_report thead th{height:25px;}
.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
/*.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;max-width:inherit;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
.tablesorter tr{display:block;}
.tablesorter tbody{overflow:visible !important}*/
</style>
<!--<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
                        $.post("popup/voucherhead_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	
});
</script>-->
<script type="text/javascript">
$(document).ready(function() {
	$("#voucher" ).load( "pagination_functions.php?value=load_voucherhead"); //load initial records
	
	//executes code below when user click on pagination links
	$("#voucher").on( "click", ".pagination a", function (e){
		e.preventDefault();
		//$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
		$("#voucher").load("pagination_functions.php",{"value":'load_voucherhead',"page":page}, function(){ //get content from PHP page
			//$(".loading-div").hide(); //once done, hide loading element
		});
		
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
         /*pagination */
/* .pagination>li>a, .pagination>li>span{
color: #000; box-shadow: 0px 0px 5px #ccc; background-color: #FFEFDDrgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}      */
         
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
					<li><a style="cursor:pointer">Voucher Head</a></li>
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
                       
                     <div style="  border: 0px #B6B6B6 solid;" class="cc_new">
                       	<div  id="lista1" class="als-container">
                            <div class="pagination_voucher" id="paginationvhead" style="height: 36px ">
                            <a class="md-trigger" data-modal="modal-17" href="#" onClick="voucherheadclr()"><div class="voucher_bill_add_btn">Add</div></a>
                <nav style="margin:2px 3px 0 0;float:right;">
               <span style="     position: relative;top: 7px !important;margin-right: 490px;color: white;float: left;"> VOUCHER HEADS  </span>               
                             <a href="voucher_payment.php" style='background-color:darkred;color: white;margin-left: -35px;border: 1px solid;border-radius: 3px;margin-top: 0px;position: absolute;padding: 2px '>BACK</a>        
                                 
<!--                                 <ul style="margin:0;" class="pagination">
                                   <li>
                                      <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                      </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                      <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                      </a>
                                    </li>
                                  </ul>-->
                                  
                                </nav>
                            </div>
                        </div>
                     </div>
            
                   </div><!--cc_new-->
                   
<div class="col-md-12 contant_table_cc" id="voucher">
  <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="listall">
    <thead>
        <tr>
            <th width="15%" class="header">Action</th>
            <th width="50%" class="header">Voucher Head</th>
           
            <th width="20%" class="header">Branch</th>
            <th width="15%" class="header">Active</th>
          
       
        </tr>
    </thead>

    <tbody>
 
    <?php
    $sql_login  =  $database->mysqlQuery("select * from tbl_voucherhead LEFT JOIN tbl_branchmaster ON tbl_voucherhead.vh_branchid=tbl_branchmaster.be_branchid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      if($result_login['vh_active']=="Y")
				{
					$active="Yes";
				}else
				{
					$active="No";
				}
                      
                      ?>
       <tr id="ids_<?=$result_login['vh_id']?>"  class="select">
            <td width="15%">
                <a href="#" class="md-trigger_vouc" id="ids_<?=$result_login['vh_id']?>"><img src="images/edit_page.PNG"></a>
                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['vh_id']?>">


                          <?php 
                          if($result_login['vh_active']=="Y"){
                              ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_login['vh_id']?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_login['vh_id']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } ?> 


<!--               <a href="#" class="md-trigger_vouc"><img src="img/delete_btn_2.png"></a>-->
            </td>
            <td  width="50%"><?=$result_login['vh_vouchername']?></td>
          
            <td width="20%"><?=$_SESSION['s_branchname']?></td>
            <td width="15%"><?=$active?></td>
               
        </tr>
            <?php }     } ?>
    </tbody>
 
   </table>
    
</div>

            </div><!--main_cc-->
            </div><!--main content-sec-->
            </div>
	</div>
    </div>
</div><!--container-->
 <div style="width:500px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                        <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:10px;">
                        <form role="form" action="voucher_head.php"  method="post"  name="voucher_head">
                        	<div  class="first_form_contain">
                             	   <div class="form_name_cc">Voucher Head </div>
                               	<div class="form_textbox_cc" id="menumaincategory_div">
                                    <input type="text" name="vouchername" id="vouchername" class="form-control vouchername" tabindex="1" autofocus placeholder="Voucher Name">
                                 </div>
                               </div>
                            
<!--                                <div class="first_form_contain">
                                     <div class="form_name_cc">Type<span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc"  > <div class="form-group" id="type_div">
                                    <select data-placeholder="Type" id="type" name="type" data-rel="chosen" tabindex="2" title="Type" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
                                        <option value=""></option>
                                        <optgroup label="Type">
                                        </optgroup>
                                        <option value=Credit>Credit</option>
                                        <option value=Expense>Expense</option>    
                                    </select>
                                    </div>
                                </div>form_textbox_cc
                                </div>-->
                            
                               
 
                               
                             <!--   <div  class="first_form_contain" style="margin-top:0">
                            	<div class="form_name_cc">Active </div>
                               	 <div class="form_textbox_cc">
                                 	<label><input name="yes"  type="checkbox">&nbsp; Yes</label> &nbsp;&nbsp;
                                    <label><input name="No" type="checkbox">&nbsp; No</label>
                                 </div>-->

                    <label>
                        <input type="hidden" value="2" tabindex="5" name="active"  id="active" data-toggle="tooltip" title="Active">
                        
                    </label>
                               </div>
                                   
<!--                               </form>-->
                    </div>
                                <a  href="#" class="entersubmit" onClick="validate_vouc()" tabindex="4"><span class="md-save newbut">Save</span></a>
<!--                       <a href="#"><button class="md-close newbut" tabindex="5">Close me!</button></a>-->
                    </form>
                            <a href="#"><button class="md-close newbut" tabindex="5">Close me!</button></a>
				</div>
                               
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
<script type="text/javascript">
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="voucher_head.php?id="+id+"&delete=yes";
		}else
		{window.location="voucher_head.php?id="+id+"&delete=no";
		}
	}
	
}  
    function voucherheadclr()
{
	document.getElementById('vouchername').value = '';
	document.getElementById('type').value = '';
        document.getElementById('branch').value = '';
     	$('#voucherchk').text('');
		$("#menumaincategory_div").removeClass("has-error");
                $("#brnch_div").removeClass("has-error");
                $("#type_div").removeClass("has-error");
} 
    
   
    function validate_all()
{
	var a=$("#vouchername").val().trim();
	 //var a=document.getElementById("corporatename").value;
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucherhead&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#voucherchk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#vouchername").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.voucher_head.submit();

			}
			}
		});

	
}
    
    
function validate_vouc()
			{
			 if(validate_voucher())
				{
                              
                                    if(validate_all())
							{

				}
                            }
                        }
			
                    
                        
                  function validate_voucher()   
			{
				if($(".vouchername").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
					document.voucher_head.vouchername.focus();
                                        alert("Enter Voucher Name");
					return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#vouchername").val())){
                                 $("#menumaincategory_div").addClass("has-error");
                                 document.voucher_head.vouchername.focus();
                                           alert("Special charecter Not Allowed.");
                              }
                                else
				 {
					 $("#menumaincategory_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                     
                        
                     

          
 </script>
                
                