<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['menuidselect']=$_REQUEST['menu'];

?>
 <input type="hidden" name="menuidnew1" id="menuidnew1" value="<?=$_SESSION['menuidselect']?>" /> 
 
 <input type="hidden" id="cloud_id" value="<?=$_SESSION['firebase_id']?>" >
<?php

 $loc=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$_SESSION['cloud_thumb']='';

$sql_login  =  $database->mysqlQuery("select mmy_maincategoryname from tbl_menumaincategory where mmy_maincategoryid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mmy_maincategoryname'];
	  }			
} 
else
{
  $searchname="";
}

	  ?>
 <style>
.menu_upload_img{width:100%;}
.menu_upload_img td, th{max-width:0px;}
 </style> 
<script>
$(document).ready(function(){
/*************************************** Popup function starts *************************************************  */           
$('.md-close_pop').click( function() {  
    
    
    var mid_1=$(this).attr('cld_id');
    
   
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
                 
               window.location.href='category_master.php';            
	});
	/***************************************  Popup function ends *************************************************  */
	/***************************************  Delete menu images function starts *************************************************  */
		 $(".tab_edt_btn11").click(function(e){
			 
	var check = confirm("Are you sure you want to Delete this record?");
	
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var md_str   =  $(this).attr("menid");
		  var md_arr	  =	 md_str.split("_");
		  var mdval       =  md_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=delimage&mid="+idval+"&mimg="+mdval,
			success: function(msg)
			{
						$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+mdval,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
                
                 
                
		   }
		});
	 
    }
		});
	/***************************************  Delete menu images function ends *************************************************  */
	
		});
</script>
  <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
       <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE --> 	    
 <script type="text/javascript" >
	
 
         function del_image(id){
         
          
                $('.alert_error_popup_all_in_one_menu').show();
                                    
                        $('.alert_error_popup_all_in_one_menu').text('DELETING  IMAGE');
                        $('.alert_error_popup_all_in_one_menu').delay(3000).fadeOut('slow');
            $('#cloud_form_del').submit();
          }
                
                
                
	

	</script>
<div class="md-content img_show" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Category Image</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop" cld_id='<?=$_SESSION['menuidselect']?>'>x</button></a>
  <input type="hidden" name="upload_id" value="<?=$_SESSION['upload_id']?>" />  
   
  <span style="position:relative;display: none !important" id="me" class="styleall">Upload Image</span> <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span> 
     
  
  
  
  
  <style>.upload_file_mn{float:left;background-color: #e8e8e8;  padding: 8px;  margin-top: -8px;  color: #242424 !important;}.upload_file_btn_mn{width: 120px; height: 35px; border: 0; color: #fff; background: #ff4141;  margin-top: -50px;  top: -20px; position: relative; border-radius: 5px;}</style>
 
  
  <?php
   
    ?>
  
  
  <form id="cloud_form1"  action="https://www.expodinereports.com/scan_order/cat_upload.php?catid=<?=$_SESSION['menuidselect']?>&branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>" enctype="multipart/form-data" method="post">
<div id="targetLayer">No Image</div>
<div style="float:left;width:100%;padding-left:20px" id="uploadFormLayer">
<input id="uploadfile" name="uploadfile" type="file" class="inputFile upload_file_mn" /><br/>
<input id="sub" type="submit" value="UPLOAD" class="btnSubmit upload_file_btn_mn" />
<p style="color:red" >[PNG AND JPG IMAGES ALLOWED]</p>
</div>

</form>
  
 
  
  
  <div class="branch_listing_table load_tables2" id="menuimage1" style="display:block !important">
                            	<table  class="menu_upload_img">
                                <thead>
                                          <tr>
                                            <th>Image</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          

    <tr>
        <td>
            
            
       <?php 
       
       $qr_branch=''; $qr_db='';

$sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
 }
}




$ct=0;

$localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

$cat_loc='';
$sql_gen =  mysqli_query($localhost3,"select mmy_qr_image from tbl_menumaincategory  where  mmy_maincategoryid='".$_SESSION["menuidselect"]."' and  branchid='$qr_branch' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                    $cat_loc=$result_cat_s_tc['mmy_qr_image'];
                                    
                                }
                                }
       
       ?>
            
            
            
            <img src='https://www.expodinereports.com/scan_order/<?=$cat_loc?>' >
            
        <form id="cloud_form_del"  action="https://www.expodinereports.com/scan_order/cat_upload.php?catid=<?=$_SESSION["menuidselect"]?>&branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>&thumb_loc=<?=$cat_loc?>" enctype="multipart/form-data" method="post">

       <a href="#" onclick="return del_image('<?=$_SESSION["menuidselect"]?>')"  ><i class="glyphicon glyphicon-trash"></i> </a>

    </form>
        </td>  
        
          </tr>
          
 
                                              </tbody>
                                    </table>	
                                    </div>
</div>