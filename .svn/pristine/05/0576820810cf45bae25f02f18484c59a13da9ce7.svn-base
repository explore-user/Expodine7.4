 <?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=13;

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['denom1'])   )
{
    if(isset($_REQUEST['activedenom'])){
        $act="Y";
    }
 else {
        $act="N";
    }
	
		$insertion['dm_denomination'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['denom1']));
                if($_REQUEST['displayorder']!=""){
                $insertion['dm_display_order'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['displayorder']));
             
                }else{
                    $ord="0";
                     $insertion['dm_display_order'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($ord));
                }
         
     $sql=$database->check_duplicate_entry('tbl_denomination_master',$insertion);
        if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_denomination_master',$insertion);
	}
}	

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['denomedit'])   )
{
if(isset($_REQUEST['activedenom'])){
    $chck="Y";
}  else {
    $chck="N";
}

$result=$database->mysqlQuery("UPDATE  tbl_denomination_master SET  dm_denomination='" .$_REQUEST['denomedit']."', dm_active='$chck',dm_display_order='" .$_REQUEST['displayedit']."'  where dm_id='".$_REQUEST['hideditdenom']."'");
     
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
<title>Denomination</title>
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

    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
.contant_table_cc{height: 92vh}	
	.tablesorter tbody{height: 86vh}
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
					<li><a style="cursor:pointer">Denomination</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                        <h3 style="display: none;background: #fff;margin-bottom: 0;padding: 13px;">DENOMINATIONS  <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;border-radius: 3px " href="denomination.php">REFRESH</a></h3>
                   

                       <div class="cc_new_main">

                           <div id="lista1" class="als-container" style="padding-top: 5px ">
				<div class="als-viewport" style="width:100% !important;">
					<?php//  include "includes/page_top.php"; ?>
                                    <ul class="als-wrapper">
                                    
                                        <li class="als-item"><a href="currencymaster.php" class="new_tab_btn <?php if($linkname=="currencymaster.php"){ ?> active_btn_1 <?php } ?>">CURRENCY MASTER</a></li>
                                 
                <?php if( in_array("denomination", $_SESSION['menusubarray'])  ) { ?> 
                
                <li class="als-item"><a href="denomination.php" class="new_tab_btn <?php if($linkname=="denomination.php"){ ?> active_btn_1 <?php } ?>">DENOMINATIONS</a></li>
                                 
                
                <?php } ?>
                                    
                                    </ul>
                                    
				</div>
			</div> 
                           
                           
                           
                      <div class="col-md-12 add_btn_cc_2" style="padding-top: 10px;">
                      <div class="btn_cc_2">
                   	<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th  style="height:30px" > Id</th>
                                <th >Denomination</th>
                                 <th >Display Order</th>
                                 <th >Status</th>
                                 <th >Action</th>
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
	 $sql_login  =  $database->mysqlQuery("select * from tbl_denomination_master"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
					
				
	 ?>
    						<tr >
                                                    <td><?=$sl++?></td>
                                <td  ><?=$result_login['dm_denomination']?></td>
                                 <td  ><?=$result_login['dm_display_order']?></td>
                                <?php if($result_login['dm_active']=="Y"){
                                    $sts12="Active";
                                }  else {
                                        $sts12="Inactive";
                                }
                                ?>
                                
                                  <td ><?=$sts12?></td>
                                  <td >
<!--                                      editclick-->
<a  href="#" class="md-trigger editclick"    rsnid="<?=$result_login['dm_id']?>"><img src="images/edit_page.PNG"></a>
                                  
                
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
<div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content"  >
				<h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="denomination.php"  method="post"  name="denomform"  >
                              
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                               
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Denomination<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" onkeypress="return numdot(this,event);" tabindex="1 " id="denom1" name="denom1"  placeholder="">
                                 </div>
                                </div>
                                
                                <div class="first_form_contain">	
                                <div   class="form_name_cc">Display Order<span style="color:#F00">*</span></div>
                                      <div class="form_textbox_cc" id="feedback_div">
                                     
                                      <input type="text" tabindex="2" class="form-control cancellation" id="displayorder" onkeypress="return numdot(this,event);"  name="displayorder"  placeholder="">
                                 </div> 
                                </div>
                                     	 
                               </div>

                              
                                  </form> 
                    </div>
                                    
                                   

                              <a  href="#" onClick="validate_cancel()" tabindex="3"><button class="md-save" >Save</button></a>
                             
				</div>
                </div>
		</div>
<!--//editdiv////-->

                <div class="md-modal md-effect-16" id="modal-18">
<div class="md-content edit_comp"  >
				
</div>
		</div>
<?php

?>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script>

 $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
   $("#modal-17").removeClass('md-show');
//$(".close_staff_pop").click();
    });


$(".add_btn_2").click(function()
{
    $("#denom1").focus();
});

    function     validate_cancel (){
        if($("#denom1").val()!="")
        {
                var alphanumers = /^[0-9 .]+$/;
                                   if(!alphanumers.test($("#denom1").val())){
                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Valid Numbers');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        $("#denom1").focus();
                                //alert("Enter Valid Numbers.");
                                 document.denomform.denom1.focus();
                                      } 
            
             else
        {
             if($("#displayorder").val()!=""){
        document.denomform.submit();
    }else{
        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Order');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        // alert("Enter Order ");
         $("#displayorder").focus();
    }
    }
      
               
        }
        else{
             $("#denom1").focus();
            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Denomination');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
           // alert("denomination field can't  be empty ! ");
        }
    }
    
    //edit//
function     validate_editcancel (){
        if($("#denomedit").val()=="")
        {
                 //alert('Enter the value !');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.denomeditform.denomedit.focus();
        }
        else
        {
            if($('#displayedit').val()!=""){
        document.denomeditform.submit();
    }else{
       // alert("Enter order");
       $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Order');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
    }
    }
    
    
    
  function numdot(item,evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
    

    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 


$(".editclick").click(function(){
    
    $("#modal-18").addClass('md-show');
var as=$(this).attr('rsnid');


                        var dataString = 'id='+as;
                        $.ajax({
                        type: "POST",
                        url: "denomination_edit.php",
                        data: dataString,
                        success: function(data) {
                        $('.edit_comp').html(data);

                        }
                        });

                        });
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>