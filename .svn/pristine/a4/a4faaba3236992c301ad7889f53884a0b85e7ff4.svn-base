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

$sql_login  =  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mr_menuname'];
	  }			
} 
else
{
  $searchname="";
}
if(!isset($_SESSION['upload_id']))
{
$_SESSION['upload_id'] = $database->getEpoch();
}

$upload_id		= $_SESSION['upload_id'];
define ("MAXWIDTH","361");  
define ("MAXHEIGHT","125"); 

function make_thumb($img_name,$filename,$new_w,$new_h)
 {
 	//get image extension.
 	$ext=getExtension($img_name);
 	//creates the new image using the appropriate function from gd library
 	if(!strcasecmp("jpg",$ext) || !strcasecmp("jpeg",$ext))
 		$src_img=imagecreatefromjpeg($img_name);
  	if(!strcasecmp("png",$ext))
 		$src_img=imagecreatefrompng($img_name);
	if(!strcasecmp("gif",$ext))
 		$src_img=imagecreatefromgif($img_name);
 	 	//gets the dimmensions of the image
 	$old_x=imageSX($src_img);
 	$old_y=imageSY($src_img);

//thumb create using specific width and height starts here 
$thumb_w=$new_w;
$thumb_h=$new_h;
//thumb create using specific width and height ends here 
	// we create a new image with the new dimmensions
 	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	// resize the big image to the new created one
 	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
 	// output the created image to the file. Now we will have the thumbnail into the file named by $filename
 	if(!strcmp("png",$ext))
 		imagepng($dst_img,$filename); 
	else if(!strcmp("gif",$ext))
 		imagegif($dst_img,$filename); 
 	else
 		imagejpeg($dst_img,$filename); 
  	//destroys source and destination images. 
 	imagedestroy($dst_img); 
 	imagedestroy($src_img); 
 }

 // This function reads the extension of the file. 
 // It is used to determine if the file is an image by checking the extension. 
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
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
                 
               window.location.href='menu.php?#id_'+mid_1;            
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
	$(function(){
          
            
	    var menu=$('#menuidnew1').val();
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadGalFile.php?upid=<?=$upload_id?>&menuid='+menu,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(file)) {              
    				mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					$("#mestatus").delay(2000).fadeOut('slow');
					return false;            
    			}
				 /*if (! (ext && /^(jpg|png|jpeg|gif|bmp|tif)$/.test())){ 
                    // extension is not allowed 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					return false;
				}*/
				mestatus.html('<font color="#ff0000">Please wait...</font> <img src="img/ajax-loaders/ajax-loader-7.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				//mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				//alert(response);
				var details	= response.split("|");
                               
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
                                        
                                      
				} else{
					mestatus.text('Photo Uploaded Error!');
					alert("File Uploaded Error!");
					$("#mestatus").delay(2000).fadeOut('slow');
					//mestatus.text('Image uploaded successfully!');
				}
					$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=addimage&mid="+menu,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
			
    }
		});
                
                
                
                
                
   $("#sub").click(function(){
         
                        $('.alert_error_popup_all_in_one_menu').show();
                                    
                        $('.alert_error_popup_all_in_one_menu').text('UPLOADING IMAGE');
                        $('.alert_error_popup_all_in_one_menu').delay(3000).fadeOut('slow');
         
        $("form").each(function(){
        var fd = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "uploadGalFile.php?upid=<?=$upload_id?>&menuid=<?=$_SESSION['menuidselect']?>",
            data: fd,
            processData: false,
            contentType: false,
            success: function(data,status) {
               $('.upload_file_mn').val('');
               $('.upload_file_mn2').val('');
               //this will execute when form is submited without errors
           },
           error: function(data, status) {
               //this will execute when get any error
           },
       });
    });
});   



                
 });   
 
 
 function delete_image_online(){
       
            
           var id= $('.img_delete_pop').attr('mid');
       var img=  $('.img_delete_pop').attr('mid_img'); 
		$('.img_delete_pop').show(); 
                $('.alert_error_popup_all_in_one_menu').show();
                                    
                        $('.alert_error_popup_all_in_one_menu').text('DELETING  IMAGE');
                        $('.alert_error_popup_all_in_one_menu').delay(3000).fadeOut('slow');
		 $.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=delimage&mid="+img+"&mimg="+id,
			success: function(msg)
			{
						$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+id,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
                
                 $('#cloud_form_del').submit();
                
		   }
		});
	 
    
 
    }
 
 
         function del_image(id, img){
         
         $('.img_delete_pop').show();
         $('.img_delete_pop').attr('mid',id);
         $('.img_delete_pop').attr('mid_img',img);
         
          
          }
                
                
                
	

	</script>
<div class="md-content img_show" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Menu Image</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop" cld_id='<?=$_SESSION['menuidselect']?>'>x</button></a>
  <input type="hidden" name="upload_id" value="<?=$_SESSION['upload_id']?>" />  
   
  <span style="position:relative;display: none !important" id="me" class="styleall">Upload Image</span> <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span> 
     
  
  
  <form style="display:none" id="cloud_form1"  action="uploadGalFile.php?upid=<?=$upload_id?>&menuid=<?=$_SESSION['menuidselect']?>" enctype="multipart/form-data" method="post">
<div id="targetLayer">No Image</div>
<div style="float:right" id="uploadFormLayer">
    <input id="uploadfile" name="uploadfile" type="file" class="inputFile upload_file_mn2" /><br/>
<input   style="color:black" type="submit" value="UPLOAD" class="btnSubmit" />

</div> 
</form>
  
  <style>.upload_file_mn{float:left;background-color: #e8e8e8;  padding: 8px;  margin-top: -8px;  color: #242424 !important;}.upload_file_btn_mn{width: 120px; height: 35px; border: 0; color: #fff; background: #ff4141;  margin-top: -50px;  top: -20px; position: relative; border-radius: 5px;}</style>
 
  
  <?php
   
    ?>
  
  
  <form id="cloud_form1"  action="https://www.expodinereports.com/scan_order/image_upload.php?menuid=<?=$_SESSION['menuidselect']?>&branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>" enctype="multipart/form-data" method="post">
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
                                           <?php
                                        
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuimages where mes_menuid='".$_SESSION['menuidselect']."'");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
        <td><?php if($result_cat_s['mes_imagethumb']) { ?><a href="<?=$result_cat_s['mes_imagethumb']?>" class="preview">View</a><a><input style="display:none" placeholder="copy" name="userImage" type="file" value="<?=$result_cat_s['mes_imagethumb']?>" /></a> <?php }else{echo "
NULL";} ?></td>  
        <td> <a style="display:none" class="tab_edt_btn11" href="#" id="m_<?=$result_cat_s['mes_imagename']?>" menid="b_<?=$result_cat_s['mes_menuid']?>" ><i class="glyphicon glyphicon-trash"></i></a>
        
        <form id="cloud_form_del"  action="https://www.expodinereports.com/scan_order/image_upload.php?menuid=<?=$result_cat_s['mes_menuid']?>&branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>&thumb_loc=<?=$result_cat_s['mes_imagethumb']?>" enctype="multipart/form-data" method="post">

       <a href="#" onclick="return del_image('<?=$result_cat_s['mes_menuid']?>','<?=$result_cat_s['mes_imagename']?>')"  ><i class="glyphicon glyphicon-trash"></i> </a>

    </form>
        
        </td>
          </tr>
          
          
    
          
          
          
          
          
  <?php $k++;}} ?>
                                              </tbody>
                                    </table>	
                                    </div>
</div>