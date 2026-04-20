<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['countryid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select cy_countryname from tbl_country where cy_countyid='".$_SESSION['countryid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['cy_countryname'];
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
	  


	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
	/***************************************  Popup function starts *************************************************  */
</script>
 <link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
       <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
      <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
     <script src="tooltip/main.js" type="text/javascript"></script>
      <script type="text/javascript" >
	$(function(){
	   // var menu=$('#menuidnew1').val();
		var btnUpload=$('#me1');
	
		var mestatus=$('#mestatus1');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadFlag.php?upid=<?=$upload_id?>',
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
				var a=details[1];
				$('#flaggimage1').val(a);
			
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
					 $.post("load_divmaster.php", {value:"flagimgload",name:a},
				  function(data)
				  {
				  data=$.trim(data);
				  //alert('b');
				  $('#flagimg1').css("display","none");
				  $('#flagimg2').css("display","block");
				  $('#flagimg2').html(data);
				  }); 
				} else{
					mestatus.text('Photo Uploaded Error!');
					alert("File Uploaded Error!");
					$("#mestatus").delay(2000).fadeOut('slow');
					//mestatus.text('Image uploaded successfully!');
				}
				
				
				
				
			//		$.ajax({
//			type: "POST",
//			url: "load_divimage.php",
//			data: "value=addimage&mid="+menu,
//			success: function(msg)
//			{
//				$('#menuimage1').html(msg);
//			}
//		});
			}
		});
		/*****************************  Delete menu images function starts *************************************  */
		 $(".tab_edt_btn12").click(function(e){
			 
	var check = confirm("Are you sure you want to Delete this record?");
	
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var md_str   =  $(this).attr("menid");
		  var md_arr	  =	 md_str.split("_");
		  var mdval       =  md_arr[1];
		//alert(idval+mdval)
		 $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=flgimagedelete&image="+idval+"&menu="+mdval,
			success: function(msg)
			{
				 $('#flagimg1').css("display","none");
				$('#flagimg2').css("display","none");
				$('#flagimg2').empty();
				$('#flagimg1').empty();
					
		   }
		});
	 
    }
		});
	/***************************************  Delete menu images function ends *************************************************  */
		
		
	});
	</script>


<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading">  <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_country where cy_countyid='".$_SESSION['countryid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="country_master.php"  method="post"  name="country_masteredit">
                           <input type="hidden" name="countryid" id="countryid" class="menuname" style="color:black" value="<?=$result_login['cy_countyid']?>">       
                          
                        	 <div class="first_form_contain">
                                 <span id="countryeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Country<span style="color:#F00">*</span></div>
                             
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control countrynames" id="country1" name="country1"  placeholder="Country" tabindex="0"  data-toggle="tooltip" title="Country1" value="<?=$result_login['cy_countryname']?>"></div>
                               </div>
                          
                          
                               
                               <a  href="#" class="entersubmit" onClick="update_registration()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script>
    
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function valicountry1(id)
           {
			   
			  $('#countryeditchk').text('');
			var id1=id;
	        var ab=$(".countrynames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcountryedit&countryid="+ab+"&countryidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			
			var catchk=$('#countryeditchk');
			if(data =="sorry")
			{
		// catchk.text('Already exists');
                 $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#country1").focus();
//return false;
	
			}
			else
			{
				
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	 // return true;
			}
			}
		});
			}

}
   function update_registration()
	{
           
	 if(validate_country1())
		{
    	//document.country_masteredit.submit();
		}
	
    }
	function validate_country1()   
	{
		
			var id=$("#countryid").val();
		if($(".countrynames").val()=="")
		{
		 $("#menumaincategory_divs").addClass("has-error");
		 document.country_masteredit.country1.focus();
                 //alert("Enter Country")
                  $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Enter Country Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 return false;
		}
                
                   var alphanumers = /^[a-zA-Z ]+$/;
                              if(!alphanumers.test($("#country1").val())){
                              $("#menumaincategory_divs").addClass("has-error");
                               document.country_masteredit.country1.focus();
                               //alert("Numeric value and Special Character Not Allowed.");
                               
                                $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Numeric value and Special Character Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
                  else
		 {
		 var a=document.getElementById("country1").value;
	/*	 $("#menumaincategory_divs").removeClass("has-error");
		 $(this).addClass("has-success");
		 return true;*/
		 
		 var id1=id;
					//alert(id1);
	        var ab=$(".countrynames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcountryedit&countryid="+ab+"&countryidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk1=$('#countryeditchk');
			if(data =="sorry")
			{
		 //catchk1.text('Already exists');
                  $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#country1").focus();

	return false;
			}
			else
			{
			
		catchk1.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	
	  //	alert('aa');
	  document.country_masteredit.submit();
			}
			}
		}); 
				 
		 
		 
		 }
             }
             
             
            
             
            
	</script>
	
	