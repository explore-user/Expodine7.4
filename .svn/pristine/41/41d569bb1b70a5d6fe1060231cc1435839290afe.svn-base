<?php

include('includes/session.php'); // Check session
include("database.class.php");   // DB Connection class
$database	= new Database();
$_SESSION['pagid']=65;
//error_reporting(0);

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['denom1']) && $_REQUEST['denom1']!=''  )
{
   
    if ($_FILES['image_file5']['tmp_name'] != "") { 
      
     $a=$_REQUEST['denom1'];
     $newname = $a.".png";
                    
     $maxDim = 200;            
     $file = $_FILES['image_file5']['tmp_name'];
     list($width, $height) = getimagesize($file);

     $ratio = $width/$height;
    if( $ratio > 1) {
        $new_width = $maxDim;
        $new_height = $maxDim/$ratio;
    } else {
        $new_width = $maxDim*$ratio;
        $new_height = $maxDim;
    }
     
    $src = imagecreatefromstring( file_get_contents( $_FILES['image_file5']['tmp_name'] ) );
    $dst = imagecreatetruecolor( $new_width, $new_height );
    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
    imagedestroy( $src );
    imagepng( $dst, $_FILES['image_file5']['tmp_name'] ); // adjust format as needed
    imagedestroy( $dst );
    
    $place_file = move_uploaded_file( $_FILES['image_file5']['tmp_name'], "uploads/online_logo/".$newname);
        
    }	
    
    if($_FILES['image_file5']['tmp_name']!=''){
        
       $img_online="uploads/online_logo/".$newname;
    
    }else{
        
       $img_online='';
        
    }
		$insertion['tol_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['denom1']));
                $insertion['tol_discount'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['dis1']));
                $insertion['tol_tax'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax1']));
                $insertion['tol_credit_settle'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['crd1']));
                $insertion['tol_logo_url'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($img_online));
                $insertion['tol_tax_value'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax_value']));
                $insertion['tol_urban_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['denom_urb']));
                $insertion['tol_local_order'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['local_order']));
                $insertion['tol_qr_order'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qr_order']));
                
         
                $sql=$database->check_duplicate_entry('tbl_online_order',$insertion);
                if($sql!=1)
                {
     
                $insertid              			=  $database->insert('tbl_online_order',$insertion);

                $online_id_comapny=0;
                $sql_desg_nos3="select tol_id from tbl_online_order where tol_name='".$_REQUEST['denom1']."' ";
                $sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
		$num_desg3  = $database->mysqlNumRows($sql_desg3);
		if($num_desg3)
		{
		  while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
		  {
                       $online_id_comapny=$result_desg3['tol_id'];
                  }}
              
                /////Company Adding////             
                $sts_cp='Y';
		$insertion1['ct_corporatename'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['denom1']));
                $insertion1['ct_status'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sts_cp));
                $insertion1['ct_online_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($online_id_comapny));
                
                $sql1=$database->check_duplicate_entry('tbl_corporatemaster',$insertion1);
                if($sql1!=1)
                {
     
	         $insertid1         =  $database->insert('tbl_corporatemaster',$insertion1);
             
                $corporate_id=0;
                $sql_desg_nos31="select ct_corporatecode from tbl_corporatemaster where ct_online_id='$online_id_comapny' ";
                $sql_desg31  =  $database->mysqlQuery($sql_desg_nos31); 
		$num_desg31  = $database->mysqlNumRows($sql_desg31);
		if($num_desg31)
		{
			while($result_desg31  = $database->mysqlFetchArray($sql_desg31)) 
			{
                           $corporate_id=$result_desg31['ct_corporatecode'];
                        }
                        }
                
                /////Credit Master Adding //////       
		$insertion12['crd_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,3);
                $insertion12['crd_branchid'] 		=  mysqli_real_escape_string($database->DatabaseLink,1);
                $insertion12['crd_totalamount'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);
                $insertion12['crd_corporateid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($corporate_id));
                $insertion12['crd_active'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Y');
                $insertion12['cloud_sync'] 		=  mysqli_real_escape_string($database->DatabaseLink,'N');
                
                $sql21=$database->check_duplicate_entry('tbl_credit_master',$insertion12);
                if($sql21!=1)
                {
                        $insertid12         =  $database->insert('tbl_credit_master',$insertion12);
                }

                }
        
	}
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        header('location:online_partners.php');     
         
}	

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['denomedit']) &&  $_REQUEST['denomedit']!='')
{
    
        if(isset($_REQUEST['activedenom'])){
            $chck="Y";
        }else {
            $chck="N";
        }

    if ($_FILES['image_file51']['tmp_name'] != "") { 
      
     $a=$_REQUEST['denomedit'];
     $newname = $a.".png";
                    
     $maxDim = 200;            
     $file = $_FILES['image_file51']['tmp_name'];
     list($width, $height) = getimagesize($file);

     $ratio = $width/$height;
     
    if( $ratio > 1) {
        $new_width = $maxDim;
        $new_height = $maxDim/$ratio;
    } else {
        $new_width = $maxDim*$ratio;
        $new_height = $maxDim;
    }
     
    $src = imagecreatefromstring( file_get_contents( $_FILES['image_file51']['tmp_name'] ) );
    $dst = imagecreatetruecolor( $new_width, $new_height );
    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
    imagedestroy( $src );
    imagepng( $dst, $_FILES['image_file51']['tmp_name'] ); // adjust format as needed
    imagedestroy( $dst );
    
    $place_file = move_uploaded_file( $_FILES['image_file51']['tmp_name'], "uploads/online_logo/".$newname);
        
    }	
    
    if($_FILES['image_file51']['tmp_name']!=''){
       $img_online="uploads/online_logo/".$newname;
    }else{
       $img_online=''; 
    }

         $result=$database->mysqlQuery("UPDATE  tbl_online_order  SET tol_qr_order='" .$_REQUEST['qr_order1']."', "
         . " tol_local_order='" .$_REQUEST['local_order1']."', tol_urban_name='" .$_REQUEST['denomedit_urb']."', "
         . " tol_name='" .$_REQUEST['denomedit']."',tol_discount='" .$_REQUEST['denomedit_ds']."',tol_tax='" .$_REQUEST['denomedit_tx']."',"
         . " tol_status='$chck', tol_credit_settle='" .$_REQUEST['denomedit_crd']."', tol_logo_url='".$img_online."',"
         . " tol_tax_value='".$_REQUEST['tax_value_edit']."'  where tol_id='".$_REQUEST['hideditdenom']."'");
 
         $result=$database->mysqlQuery("UPDATE  tbl_corporatemaster  SET  ct_corporatename='" .$_REQUEST['denomedit']."' ,"
         . " ct_status='$chck' where ct_online_id='".$_REQUEST['hideditdenom']."'  ");  

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
<title>Online Partners</title>
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
.table_report thead th, td{padding-left:8px !important;text-align:left !important}
.table_report td{text-align:left !important;padding-left:8px !important;}
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
        .disablegenerate { pointer-events: none; opacity: 0.9; cursor:none;}
        
</style>
</head>
<body>
    
    <input type="hidden" id="hidden_floorid"> 
    <div class="olddiv "></div> 
    <div id="blr" class="container nopaddding">
    <?php  include "includes/topbar_master.php"; ?>
    <?php include "includes/left_menu.php"; ?>
    <div class="mian">
	<div class="view-container">
		<div style=" top: 29px !important; "  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Denomination</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
                <div class="content-sec">
                   
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                            <h3 style="background: #fff;margin-bottom: 0;padding: 13px;font-weight: bold">ONLINE PARTNERS <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold ;border-radius: 3px" href="online_partners.php">REFRESH</a></h3>

                       <div class="cc_new_main">
                                           <div class="col-md-12 add_btn_cc_2">
                                               
                      <div class="btn_cc_2">
                         
                   		<a tittle="Add" href="#" id="add_online_partner" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead >
                              <tr>
                               <th style="height: 40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sl</th>
                                <th width="15%" >Name</th>
                                 <th  width="15%" >Urban Piper Name</th>
                                 <th >Local Order</th>
                                 <th >Online Order</th>
                                 <th >Qr Order</th>
                                 <th style="display:none" width="8%" >Discount</th>
                                  <th style="display:none">Onl Tax</th>
                                  <th style="display:none">Tax Value</th>
                                  <th >Credit Settle</th>
                                 <th width="8%" >Status</th>
                                 <th width="22%" style="min-width:100px">Action</th>
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
	  $sql_login  =  $database->mysqlQuery("select * from tbl_online_order"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tol_local_order']=="Y"){
                                    $local_one="Yes";
                                     $onl_one="No"; 
                                }  else {
                                    $local_one="No";
                                    $onl_one="Yes"; 
                                }	
		
                         if($result_login['tol_qr_order']=="Y"){
                                    $qr_one="Yes";
                                }  else {
                                        $qr_one="No";
                                }       
                                
                                
	 ?>
    						<tr >
                                                    <td><?=$sl++?></td>
                                                    <td style="font-weight:bold" width="15%" ><?=$result_login['tol_name']?></td>
                                                    <td  width="15%" ><?=$result_login['tol_urban_name']?></td>
                                                    <td  ><?=$local_one?></td>
                                                    <td  ><?=$onl_one?></td>
                                                    <td  ><?=$qr_one?></td>
                                                         
                                 <td style="display:none"  width="8%" ><?=$result_login['tol_discount']?></td>
                                
                                 <?php if($result_login['tol_tax']=="Y"){
                                        $sts123="Yes";
                                 }else{
                                        $sts123="No";
                                 }?>
                                
                                  <td style="display:none" ><?=$sts123 ?></td>
                                  
                                  <td style="display:none"><?=$result_login['tol_tax_value']?></td>
                                  
                                <?php if($result_login['tol_credit_settle']=="Y"){
                                    $sts1234="Yes";
                                    
                                }else{
                                    $sts1234="No";
                                }?>
                                  
                                 <td  ><?=$sts1234 ?></td>
                                 
                                <?php if($result_login['tol_status']=="Y"){
                                    $sts12="Active";
                                    
                                 }else{
                                        $sts12="Inactive";
                                }?>
                                
                                <td  width="8%" ><?=$sts12?></td>
                                  
                                  
                                  
    <td style="min-width: 100px "  width="22%" >
  &nbsp;
    <a title="Edit"  href="#" class="md-trigger editclick"    rsnid="<?=$result_login['tol_id']?>" ><img src="images/edit_page.PNG"></a>

    &nbsp;

    <a title="RATE COPY TO OTHER PARTNERS " style="margin-left: 0px " href="#" onclick="edit_rate_online('<?=$result_login['tol_id']?>');"   rate_id="<?=$result_login['tol_id']?>" ><img src="img/copy_ico.png"></a>
    &nbsp;&nbsp;

    <a title="TAX ADDING TO PARTNER" onclick="return floor_popup('<?=$result_login['tol_id']?>','<?=$result_login['tol_name']?>');" class="md-trigger" id="tax_popup_floor" href="#"><div class="action_button"><img width="25px" src="img/tax_icon.png"></div></a>


    <select onchange="change_rate_online('<?=$result_login['tol_id']?>')" id='drop_online<?=$result_login['tol_id']?>' style="margin: 10px;margin-left: 0px;display: none ">
    <option>Select Online</option>
    <?php
              $sql_login5  =  $database->mysqlQuery("select * from tbl_online_order where tol_status ='Y' and tol_id!='".$result_login['tol_id']."' "); 
              $num_login5   = $database->mysqlNumRows($sql_login5);
              if($num_login5){
                while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
                {
    ?>
                 <option nm="<?=$result_login5['tol_name']?>" value="<?=$result_login5['tol_id']?>"><?=$result_login5['tol_name']?></option>

     <?php } } ?>

     </select>


    &nbsp;&nbsp;

    <?php if($_SESSION['expodine_id']=='admin'){ ?>  

    <a title="RATE CHANGE . PLUS OR MINUS "  href="#" class=""    onclick="rate_change('<?=$result_login['tol_id']?>','<?=$result_login['tol_name']?>');"><img src="img/gnarate_bill.PNG"></a>   
 
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
</div>
</div>
    
<div class="md-modal md-effect-16" id="modal-17">
		<div class="md-content"  >
		<h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="online_partners.php"  method="post"  name="denomform" id='denomform' enctype="multipart/form-data"  >
                              
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                               
                               
                           <div class="first_form_contain">
                             	<div class="form_name_cc">Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input  type="text" class="form-control cancellation"  id="denom1" name="denom1"  placeholder="Name">
                                 </div>
                                </div>    
                               
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Urban Piper Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
               <select class="form-control cancellation" id="denom_urb" name="denom_urb" >      
                 <option  value="">Select</option>
                 <option selected  value="Takeaway">Takeaway</option>
                 <option value="zomato">zomato</option>
              
                <option   value="swiggy">swiggy </option>
                <option   value="ubereats">ubereats</option> 
                <option   value="scootsy">scootsy</option> 
                <option   value="dunzo">dunzo</option>
                <option   value="dotpe">dotpe</option>
                <option  value="foodpanda">foodpanda</option>
                <option   value="amazon">amazon</option>
                <option   value="swiggystore">swiggystore</option>
                <option  value="zomatomarket">zomatomarket</option>
                                     
                </select>          
                                     
                                 </div>
                                </div>
                                
                               
                               
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Local Order<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select class="form-control cancellation"  id="local_order" name="local_order"  >
                                          <option value='Y'>YES</option> 
                                            
                                             <option value='N'>NO</option>
                                     </select>
                                 </div>
                                </div>
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Qr Code Order<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select  class="form-control cancellation" id="qr_order" name="qr_order" onchange="qr_check();" >
                                         
                                             <option value='N'>NO</option>
                                              <option value='Y'>YES</option> 
                                     </select>
                                 </div>
                                </div>
                               
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Credit Settle<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select class="form-control cancellation"  id="crd1" name="crd1"  >
                                        
                                          <option value='N'>NO</option>
                                            <option value='Y'>YES</option>      
                                     </select>
                                 </div>
                                </div>
                               
                               
                                <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Discount(%)<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input onkeypress="return numdot(event)" maxlength="5" value="0" type="text" class="form-control cancellation"  id="dis1" name="dis1"  placeholder="%">
                                 </div>
                                </div>
                                     	 
                               <div class="first_form_contain" style="display:none" >
                             	<div class="form_name_cc">Online Tax<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select class="form-control cancellation"  id="tax1" name="tax1" style="pointer-events: none " >
                                       
                                          <option value='N'>NO</option>
                                            <option value='Y'>YES</option>       
                                     </select>
                                 </div>
                                </div>
                               
                               
                               
                               
                               <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Tax(%)<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input readonly  onkeypress="return numdot(event)" maxlength="5" value="0" type="text" class="form-control cancellation"  id="tax_value" name="tax_value"  placeholder="%">
                                 </div>
                                </div>
                               
                               
                               

                         <div class="first_form_contain">
                               <div class="form_name_cc"> Logo <span style="color:#F00"></span></div>
                               
                               <div  class="form_textbox_cc"> <input name="image_file5" id="image_file5" onchange="image_preview(this);" type="file">     </div>  
                               
                         </div>  
                                      
                         <div class="first_form_contain">
                         <div class="form_name_cc">&nbsp;</div>
                         <div  class="form_textbox_cc" style="height:auto">
                             <img style="width:150px;height: 100px;padding: 20px;padding-left: 0;padding-top: 0;display: none" id="blah" src="#" alt="Image" />
                             </div>
                        
                     </div>
                                 
                              
                           </form> 
                          </div>
                    </div>
                                    
                                   
                              <a  href="#" onClick="validate_cancel()" tabindex="3"><button class="md-save" >Save</button></a>
                             
				</div>
                </div>
		</div>
<!--//editdiv////-->

<div class="md-modal md-effect-16" id="modal-18" style="top:15%">
<div class="md-content edit_comp"  >
				
</div>
		</div>
<?php

?>
<div class="md-overlay"></div><!-- the overlay element -->


<div id="load_floor_tax_add" style="display:none">
            
            
</div>

<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script>
    
    function qr_check(){
          
           
          
            $.ajax({
                                type: "POST",
                                url: "load_takeaway.php",
                                data: "set=check_qr&flr=",
                                success: function (msg)
                                { 
                                  if($.trim(msg)=='sorry'){
                                 $("#qr_order").val('N');     
                                      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Qr Order Already Exist.Keep It As - No ');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                                  }
                                    
                                }
                            });
            
            
        }
    
    
    
    function change_rate_online(id1){
        
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM RATE COPY ?');
         
         $('#confirm_pop_all').attr('id1',id1);
         
    }
    
    function edit_rate_online(id){
        
        $("#drop_online"+id).show();
        
        var from= $("#drop_online"+id).val();
          
    }
    
    
    
    
  function numdot(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }
    
  function image_preview(input) { 
      var aa=$('#image_file5').val();
      
     
   var str2 = ".png";

   if(aa.includes(str2)){
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) { 
                      
              
                $('#blah').show();
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
        
        
        } else{
            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('PNG IMAGES ALLOWED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
            //alert('ONLY PNG IMAGES ALLOWED');
            $('#image_file5').val('');
            $('#blah').hide();
                $('#blah').attr('src', '');
        }
        
    }
    
    
    
    function     validate_cancel (){
        
        
        var nm=$("#denom1").val();
        
        if($("#denom1").val()!="")
        {
           if($("#denom_urb").val()!="")
        {  
            
            var dataString = 'set=check_online_name&name='+nm;
                        $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: dataString,
                        success: function(data) {
                           
                       if($.trim(data)=='yes'){
                         document.denomform.submit();   
                     }else{
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                       //  alert("Name Already Exist ");
                          $("#denom1").focus(); 
                     }
                       

                        }
                        });
            
              
                
                 }
        else{
            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Urban Pipe Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
            //alert("Enter Name ");
            $("#denom_urb").focus();
        }
                
        }
        else{
            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
            //alert("Enter Name ");
            $("#denom1").focus();
        }
    }
    
    
    
    //edit//
function     validate_editcancel (id){
    
    
    var nm1=$("#denomedit").val();
   
        if($("#denomedit").val()=="")
        {
                 //alert('Enter Name');
      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                 document.denomeditform.denomedit.focus();
        }
        else
        {
         var dataString = 'set=check_online_name&name='+nm1+"&nameid="+id;
                        $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: dataString,
                        success: function(data) {
                           
                       if($.trim(data)=='yes'){
                          document.denomeditform.submit();
                     }else{
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        // alert("Name Already Exist ");
                         document.denomeditform.denomedit.focus();
                     }
                       

                        }
                        });
       
    
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
               $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
       $("#modal-17").removeClass('md-show');
    });

  $("#add_online_partner").click(function()
  {
    $("#denom1").focus();
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
                        url: "online_partners_edit.php",
                        data: dataString,
                        success: function(data) {
                        $('.edit_comp').html(data);
                      $('#denomedit').attr('qr_id_flr',as);
                        }
                        });

                        });
                        
                        
function floor_popup(fid,fn){
    
    $('#load_floor_tax_add').show();
     
     $('#hidden_floorid').val(fid);
    var data="set_floor_list=floor_list&floor_id="+fid+"&floor_name="+fn;
    
       $.ajax({
       type: "POST",
       url: "load_takeaway.php",
       data: data,
       success: function(data)
       {
           
           $('#load_floor_tax_add').html(data);    
       }
   }); 
     
}
                  
    
function rate_change(id,name){
    
    
    $('#add_stock_pop').show();
    
     $('#add_stock_pop').attr('partner',id);
     
      $('#head_cng').text(name);
    
    $('#rate_cng').val(''); 
    
    $('#rate_cng').focus(); 
    
    
     $('#type_cng').val(''); 
     
      $('#plus_minus_cng').val(''); 
    
}    



 function confirm_yes_new(){
     
     var id1=$('#confirm_pop_all').attr('id1');
     
   
     if(id1!='' && id1!='undefined'  && id1!=undefined){
     
     var from= $("#drop_online"+id1).val();
     
     
        
        $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: "set=online_rate_change&curent_online=" + id1 + "&new_online=" + from,
                        success: function (msg)
                        {
                          // alert('Rate Copy Sucessfull');
                          $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Rate Copy Successfull');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                           $("#drop_online"+id1).hide();
                           
                           $('#confirm_pop_all').attr('id1','');
                        }
                    });
    
     
    }else{
     
     
      var partner=  $('#add_stock_pop').attr('partner'); 
   
   
    var rate_cng=  $('#rate_cng').val(); 
    
      var type_cng=  $('#type_cng').val(); 
      
        var plus_minus_cng=  $('#plus_minus_cng').val(); 
        
        
        if(rate_cng>0 && type_cng!='' && plus_minus_cng!=''){
            
            
              $('.alert_error_popup_all_in_one').show();
                               
                        $('.alert_error_popup_all_in_one').text('Rate CHANGED SUCESSFLUUY');
            
       var data="set=ta_rate_change&rate_cng="+rate_cng+"&type_cng="+type_cng+"&plus_minus_cng="+plus_minus_cng+"&id="+partner;
    
       $.ajax({
       type: "POST",
       url: "load_takeaway.php",
       data: data,
       success: function(data)
       {
                       
                            
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
          
          
      $('#add_stock_pop').hide();
    
      $('#rate_cng').val(''); 
    
     $('#type_cng').val(''); 
     
      $('#plus_minus_cng').val('');
          
          
       }
       }); 
            
            
        }else{
            
            
            
                         $('.alert_error_popup_all_in_one').show();
                         
                          if(plus_minus_cng<=0){           
                        $('.alert_error_popup_all_in_one').text('Select Method');
                            }
                            
                          if(type_cng<=0){           
                        $('.alert_error_popup_all_in_one').text('Select Type');
                            }
                         
                         
                         if(rate_cng<=0){           
                        $('.alert_error_popup_all_in_one').text('Enter Rate');
                         $('#rate_cng').focus(); 
                            }
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
            
        }
        
        
    }
        
        
     
     $('#confirm_pop_all').hide();
                
     $('#pop_head_com').text('');
 }


function go_rate_change(){
    
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('ALL ITEM RATES WILL BE CHANGED ?');
         
    
    
}
    
                        
</script>

 <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
            Rate Change : <span style="font-size:10px" id="head_cng"></span>
            <a href="online_partners.php" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt">
            
            <input style="width:60px"  maxlength="10" type="number" class="stock_add_txtbx" id="rate_cng" placeholder="RATE ">
            
            <select id="type_cng" class="stock_add_txtbx"  style="width:70px;margin-left: 5px">
                 <option value="">Type</option>
                <option value="percentage">%</option>
                <option value="amount">Value</option>      
            </select>
            
             <select id="plus_minus_cng" class="stock_add_txtbx"  style="width:75px;margin-left: 5px">
                  <option value="">Method</option>
                <option value="plus">+</option>
                <option value="minus">-</option>      
                    
            </select>
            
            
            
            
            <a  onclick="go_rate_change();" href="#"><div style="margin-top:5px"  class="stock_add_btn">GO</div></a>
            
          
        </div>
    </div>
   </div>



<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>