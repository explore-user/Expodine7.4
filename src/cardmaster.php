 <?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=19;



if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['compedit'])   )
{
if(isset($_REQUEST['activecomp'])){
    $chck="Y";
}  else {
    $chck="N";
}

        $result=$database->mysqlQuery("UPDATE  tbl_cardmaster SET  crd_name='" .$_REQUEST['compedit']."', crd_active='$chck'  "
        . " where crd_id='".$_REQUEST['hideditcomp']."'");
     

      $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");

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
<title>Card Master</title>
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
.table_report td{text-align:center !important;padding-left:20px !important;}
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
					<li><a style="cursor:pointer">Cardmaster</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                    
                    
                    <div id="lista1" class="als-container" style="padding-top:5px">
				<div class="als-viewport" style="width:100% !important;">
					<?php//  include "includes/page_top.php"; ?>
                                    <ul class="als-wrapper">
                   
                  <?php if( in_array("bank_master", $_SESSION['menusubarray'])  ) { ?>                         
                                        
                                        <li class="als-item"><a href="bank_master.php" class="new_tab_btn <?php if($linkname=="bank_master.php"){ ?> active_btn_1 <?php } ?>">BANK MASTER</a></li>
                                 
                <?php } ?>
                
                 <li class="als-item"><a href="cardmaster.php" class="new_tab_btn <?php if($linkname=="cardmaster.php"){ ?> active_btn_1 <?php } ?>">CARD MASTER</a></li>
                                 
                
              
                                    
                                    </ul>
                                    
				</div>
			</div>
                    
                    
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                            <h3 style="background: #fff;margin-bottom: 0;padding: 13px;display: none">MULTIPLE CARD MASTER<a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold " href="cardmaster.php">RESET</a></h3>
                       <div class="cc_new_main">

                                           <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th  > Id</th>
                                <th  height="30">Customer Card Name</th>
<!--                                 <th  height="30">Card Image url</th>-->
                                 <th >Status</th>
                                 <th >Action</th>
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
	 $sql_login  =  $database->mysqlQuery("select * from tbl_cardmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
					
				
	 ?>
    						<tr >
                                                    <td        ><?=$sl++?></td>
                                <td ><?=$result_login['crd_name']?></td>
<!--                                <td  ><?//=$result_login['crd_imageurl']?></td>-->
                                <?php if($result_login['crd_active']=="Y"){
                                    $sts12="Active";
                                }  else {
                                        $sts12="Inactive";
                                }
                                ?>
                                
                                  <td   ><?=$sts12?></td>
                                  <td  >
<!--                                      editclick-->
<a  href="#" class="md-trigger editclick"    rsnid="<?=$result_login['crd_id']?>"><img src="images/edit_page.PNG"></a>
                                  
                
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
			<div class="md-content"  style="float: left;width: 100%;">
				<h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="cardmaster.php"  method="post"  name="compform" enctype="multipart/form-data" >
                              
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Card name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation"  id="comp1" name="comp1"  placeholder="name"></div>
                                                                  	
                                     	 
                               </div>
                               
                                <div class="image-crop" style="border-bottom:0">
<!--				<div class="form_name_cc">Card Image Url<span style="color:#F00">*</span></div>-->
<!--                                  <div ><input name="image_file5" id="image_file5" onChange="fileSelectHandler()" type="file"></div>-->
                                     <div style="display:inline;width:100%;padding:5px 0">
                                     <input style="border: 0;height: 36px;font-size: 17px;margin-right: 5px;cursor: pointer" class="upload_log_buton companylogo entersubmit enter" onClick="validate_cancel()"  value="Submit" name="submit5">
                                    </div>                           
                               </div>
<!--                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox"   value="Y" tabindex="2" name="activecomp"  id="activecomp" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                       </div>
                                </div>-->
                              
                                  </form> 
                    </div>
                                    
<!--                                    <a name="submit5" href="#" onClick="validate_cancel()" tabindex="3"><button name="submit5" class="md-save" >Save</button> </a>-->
                            
                             
				</div>
                </div>
		</div>
<!--//editdiv////-->

                <div class="md-modal md-effect-16" id="modal-18">
<div class="md-content edit_comp"  >
				
</div>
		</div>
<?php
//$target_dir = "uploads/cards/";
////$target_file = $target_dir . basename($_FILES["image_file1"]["name"]);
//$target_file = $target_dir;
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit5"])) {
    
//    if ($_FILES['image_file5']['tmp_name'] != "") { 
//        $maxfilesize = 6000; 
//
//        if($_FILES['image_file5']['size'] > $maxfilesize ) { 
//                   // $error_msg = '<font color="black">ERROR: Your image was too large, please try again.</font>';
//                    echo '<script type="text/javascript">alert("ERROR: Your image was too large, please try again.");</script>';
//                    unlink($_FILES['image_file1']['tmp_name']); 
//
//        } else if (!preg_match("/\.(png)$/i", $_FILES['image_file5']['name'] ) ) {
//                    //$error_msg = '<font color="#FF0000">ERROR: Sorry, only  PNG files are allowed.</font>';
//                   echo '<script type="text/javascript">alert("ERROR: Sorry, only  PNG files are allowed.");</script>';
//                    unlink($_FILES['image_file5']['tmp_name']); 
//        } 
//        else { 
//            $a=$_REQUEST['comp1'];
//                    $newname = $a.".png";
//                    
//                   
//$file = $_FILES['image_file5']['tmp_name'];
//list($width, $height) = getimagesize($file);
//
//if($width > "37" || $height > "20") {
//   echo '<script type="text/javascript">alert("Error : Image size must be 37 x 20 pixels.");</script>';
//  
//}else{
                    
                    
                    
                    
                  //  $place_file = move_uploaded_file( $_FILES['image_file5']['tmp_name'], "uploads/cards/".$newname);
   if($_REQUEST['comp1']!=''){
         $newname="null";
                    $insertion['crd_imageurl'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($newname));
                     $insertion['crd_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['comp1']));
                     
                     $sql=$database->check_duplicate_entry('tbl_cardmaster',$insertion);
           if($sql!=1)
	  {
	   $insertid              			=  $database->insert('tbl_cardmaster',$insertion);
       
	  }
                    
	echo '<script>window.location.href = "cardmaster.php";</script>';
    }    
         

//        }
//    } 
//    } 
  
}
?>
<input type="hidden" name="urlid" value="<?=$newname?>">
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script>
    function     validate_cancel (){
        if($("#comp1").val()=="")
        {
                // alert('Enter the name !');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.compform.comp1.focus();
        }else
        {
        document.compform.submit();
    }
    }
    
    //edit//
function     validate_editcancel (){
        if($("#compedit").val()=="")
        {
                // alert('Enter the name !');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.compeditform.compedit.focus();
        }else
        {
        document.compeditform.submit();
    }
    }
    
    
    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

            $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
     $("#modal-17").removeClass('md-show');
    });


$(".enter").keypress(function(event){
    if(event.keyCode==13){
        validate_cancel();
    }
});


 $('.btn_cc_2').click(function(){
     //alert( "clicked" );
    $('#comp1').focus();
});


$(document).ready(function() {
   $("#listall").tablesorter();
}); 


$(".editclick").click(function(){
    
    $("#modal-18").addClass('md-show');
 var as=$(this).attr('rsnid');


                        var dataString = 'id='+as;
                        $.ajax({
                        type: "POST",
                        url: "load_cardmaster.php",
                        data: dataString,
                        success: function(data) {
                        $('.edit_comp').html(data);

                        }
                        });

                        });
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
</body>
</html>