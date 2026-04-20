<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=11;

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['cancellation1'])   )
{
//    if(isset($_REQUEST['active'])){
//        $act="Y";
//    }
// else {
//        $act="N";
//    }
	
		$insertion['cr_reason'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['cancellation1']));
                //$insertion['cr_active'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($act));
	
         
$sql=$database->check_duplicate_entry('tbl_cancellation_reasons',$insertion);
 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_cancellation_reasons',$insertion);
	}
}	

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['cancellation1edit'])   )
{
if(isset($_REQUEST['activeedit'])){
    $chck="Y";
}  else {
    $chck="N";
}

$result=$database->mysqlQuery("UPDATE  tbl_cancellation_reasons SET  cr_reason='" .$_REQUEST['cancellation1edit']."', cr_active='$chck'  where cr_id='".$_REQUEST['hidedit']."'");
     
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
<title>Cancellation</title>
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
					<li><a style="cursor:pointer">Cancellation</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                    
                    
                    
                    
                    <div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                        
                        <div style="  border: 1px #B6B6B6 solid;direction" class="cc_new">
                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important;">
					<?php//  include "includes/page_top.php"; ?>
                                    <ul class="als-wrapper">
                                    
                <li class="als-item"><a href="cancellation.php" class="new_tab_btn <?php if($linkname=="cancellation.php"){ ?> active_btn_1 <?php } ?>"> BILL - KOT CANCEL REASON</a></li>
                                 
                <?php if( in_array("complimentary_reason", $_SESSION['menusubarray'])  ) { ?> 
                
                <li class="als-item"><a href="complimentary_reason.php" class="new_tab_btn <?php if($linkname=="complimentary_reason.php"){ ?> active_btn_1 <?php } ?>">COMPLIMENTARY BILL REASON</a></li>
                                 
                
                <?php } ?>
                
                
                 <?php if( in_array("regeneration", $_SESSION['menusubarray'])  ) { ?> 
                
                <li class="als-item"><a href="regeneration.php" class="new_tab_btn <?php if($linkname=="regeneration.php"){ ?> active_btn_1 <?php } ?>">REGENERATION BILL REASON</a></li>
                                 
                
                <?php } ?>
                            
                    </ul>
                                    
				</div>
			</div>
                   </div><!--cc_new-->
                        
                        
                    
                        <h3 style="background: #fff;margin-bottom: 0;padding: 13px;e">BILL - KOT CANCEL REASONS<a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;border-radius: 3px " href="cancellation.php">REFRESH</a></h3>

                       <div class="cc_new_main">

                                           <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_canc_reason" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th width="10%" > Id</th>
                                <th  height="30">Reason</th>
                                
                                 <th width="10%">Status</th>
                                 <th width="10%">Action</th>
                              </tr>
                             </thead>
                             
                                 <?php
                                 $slno=1;
	 $sql_login  =  $database->mysqlQuery("select * from tbl_cancellation_reasons"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
				
	 ?>
    						<tr >
                                                    <td          width="10%"><?=$slno++?></td>
                                <td  width="70%"><?=$result_login['cr_reason']?></td>
                                
                                <?php if($result_login['cr_active']=="Y"){
                                    $sts123="Active";
                                }  else {
                                        $sts123="Inactive";
                                }
                                ?>
                                  <td   width="10%"><?=$sts123?></td>
                                  <td     width="10%">
<!--                                      editclick-->
 <a  href="#" class="md-trigger editclick"    rsnid="<?=$result_login['cr_id']?>"><img src="images/edit_page.PNG"></a>
                                  
                
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
                        <form role="form" action="cancellation.php"  method="post"  name="cancellationform"  >
                              
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Reason<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="1" class="form-control cancellation" id="cancellation1" name="cancellation1"  placeholder="Cancellation Reason"></div>
                                                                  	
                                     	 
                               </div>
<!--                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox"   value="Y" tabindex="2" name="active"  id="active" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                       </div>
                                </div>-->
                              
                                  </form> 
                    </div>
                                    
                                   

                             
                              <a  href="#" onClick="validate_cancel()" tabindex="2"><button class="md-save" >Save</button></a>
                             
				</div>
                </div>
		</div>
<!--//editdiv////-->

                <div class="md-modal md-effect-16" id="modal-18">
<div class="md-content edit_cancel"  >
				
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


  

    function     validate_cancel (){
        if($("#cancellation1").val()=="")
        {
                // alert('Enter the reason !');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Reason');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.cancellationform.cancellation1.focus();
        }else
        {
        document.cancellationform.submit();
    }
    }
    
    //edit//
function     validate_editcancel (){
        if($("#cancellation1edit").val()=="")
        {
                 //alert('Enter the reason !');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Reason');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.cancellationformedit.cancellation1edit.focus();
        }else
        {
        document.cancellationformedit.submit();
    }
    }
    
    
    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

    $(".add_btn_2").click(function()
    {
    //   alert("hiihi");
    $("#cancellation1").focus();
    });


        $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
       $("#modal-17").removeClass('md-show');
    });

        $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
       $("#modal-18").removeClass('md-show');
    });


$(document).ready(function() {
    
   $("#listall").tablesorter();

     $("#add_canc_reason").click(function()
    {
        ("#cancellation1").focus();
    });

}); 



$(".editclick").click(function(){
    
    $("#modal-18").addClass('md-show');
var as=$(this).attr('rsnid');


                        var dataString = 'id='+as;
                        $.ajax({
                        type: "POST",
                        url: "load_canceledit.php",
                        data: dataString,
                        success: function(data) {
                        $('.edit_cancel').html(data);

                        }
                        });

                        });
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>