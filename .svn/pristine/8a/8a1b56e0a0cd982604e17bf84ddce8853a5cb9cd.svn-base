	<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['catid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_maincategoryid='".$_SESSION['catid']."'"); 
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
		$('#menumaincategory1').focus();
	   // var menu=$('#menuidnew1').val();
		var btnUpload=$('#me1');
	
		var mestatus=$('#mestatus1');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadCategory.php?upid=<?=$upload_id?>',
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
				$('#catimage1').val(a);
			
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
					 $.post("load_divmaster.php", {value:"imageload",name:a},
				  function(data)
				  {
				  data=$.trim(data);
				  //alert('b');
				  $('#categryimg1').css("display","none");
				  $('#categryimg2').css("display","block");
				  $('#categryimg2').html(data);
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
		//alert(idval+mdval)
		 $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=imagedelete&image="+idval+"&menu="+mdval,
			success: function(msg)
			{
				 $('#categryimg1').css("display","none");
				$('#categryimg2').css("display","none");
				$('#categryimg2').empty();
				$('#categryimg1').empty();
					
		   }
		});
	 
    }
		});
	/***************************************  Delete menu images function ends *************************************************  */
		
		
	});

	</script>



<div class="md-content" style="position:fixed;width:50%;left:25%;top:5%;z-index:99999;"><!--1sttab-->
    <div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?> &nbsp; &nbsp; &nbsp; [Ref Id : <?=$_REQUEST['menu']?> ]</span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_maincategoryid='".$_REQUEST['menu']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="category_master.php"  method="post"  name="category_masteredit">
                                 
                           
                        	 <div class="first_form_contain">
                             
                             	<div class="form_name_cc">Category Name<span style="color:#F00">*</span></div>
                               <span id="catchk" class="load_error alertsmaster" style="color:#F00" ></span>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control categorynames" id="menumaincategory1" name="menumaincategory1"  placeholder="Category Name" tabindex="0"  data-toggle="tooltip" title="Category Name" value="<?=$result_login['mmy_maincategoryname']?>" onchange="valicat1('<?=$result_login['mmy_maincategoryid']?>')"></div>
                               </div>
                               	 <div class="first_form_contain">
                             	<div class="form_name_cc">Display Order</div>
                                  	 <div class="form_textbox_cc" id="dispalyorder1_div">
                                <input type="text" class="form-control displayorders" id="displayorder1" name="displayorder1"  placeholder="Display Order" tabindex="0"  data-toggle="tooltip" title="Display Order" value="<?=$result_login['mmy_displayorder']?>"></div>
                               </div>
                                
                               <div class="first_form_contain">
                                    <span id="catchk1" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Order of Print</div>
                                  	 <div class="form_textbox_cc" id="orderprint1_div">
                                             <input type="text" class="form-control orderprints" id="orderprint1" name="orderprint1"  placeholder="Order of Print" tabindex="0"  data-toggle="tooltip" title="Print Order" value="<?=$result_login['mmy_orderof_print']?>" onchange="valiorderprint1('<?=$result_login['mmy_maincategoryid']?>')"></div>
                               </div>
                              
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Category Image</div>
                                  
                                <span style="position:relative;" id="me1" class="styleall">Upload Image</span> <span id="mestatus1" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span> 
                                   <input type="hidden" class="form-control" id="catimage1" name="catimage1"   >
                               
                               </div>
                               
                               
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['mmy_active']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['mmy_active']=="Y") { ?> checked <?php } ?> >
                               </div></div>
                               
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Inventory</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['mmy_inventory']?>" tabindex="5" name="inventory1"  id="inventory1" data-toggle="tooltip" title="" <?php if($result_login['mmy_inventory']=="Y") { ?> checked <?php } ?> >
                               </div></div>
                               
                                <div id="categryimg1" class="upload_view_img" <?php if(is_null($result_login['mmy_imagename']) || $result_login['mmy_imagename']===''){ ?> style="display:none"<?php }else{ ?>style="display:block" <?php } ?>>
                               <img src="<?=$result_login['mmy_imagename']?>" width="100px" height="100px" />
                               <a class="tab_edt_btn11" href="#" id="m_<?=trim($result_login['mmy_imagename'])?>" menid="b_<?=$result_login['mmy_maincategoryid']?>" ><i class="glyphicon glyphicon-trash"></i></a>
                               </div>
                               
                               <div id="categryimg2" class="upload_view_img" style="display:none"></div>
                                 <input type="hidden" name="catid" id="catid" class="menuname" style="color:black" value="<?=$result_login['mmy_maincategoryid']?>">         
                                 <a  href="#" class="entersubmit"  onClick="update_category()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">

		$(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)
			//alert("hiiiii");
		$('.md-close_pop').click();
	});
    
       $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
    
    
      function valiorderprint1(id)
      {
         
	var id2=id;
       
	var op1=$("#orderprint1").val().trim();
                
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkodprintedit&orderprint="+op1+"&opid="+id2,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#catchk1');
			if(data =="sorry")
			{
                            
		// namechk.text('Order of Print Already exists');
                 alert('Order of Print Already exists');
                  $("#orderprint1_div").addClass("has-error");	        
                  $("#orderprint1").focus();
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#orderprint1_div").removeClass("has-error");
	   $("#orderprint1_div").addClass("has-success");
	  	//alert('aa');
			}
			}
		}); 

                      
}  
   
function valicat1(id)
           {
		
			  $('#catchk').text('');
			var id1=id;
                        
		
	        var ab=$(".categorynames").val().trim();
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcatedit&catid="+ab+"&catidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk=$('#catchk');
			if(data =="sorry")
			{
		 catchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();
//return false;
	
			}
			else
			{
				//alert('aa');
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	 // return true;
			}
			}
		});
			}
                        
                        
			/*else
			{
				$("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();
			}*/
}

 function update_category()
	{
	if(validate_dorder1())	
	{
            if(validate_orderprint1())	
	{
            
	 if(validate_menumaincategory1())
         {	
			
            }	
        }	
    	
		}
	}
	function validate_menumaincategory1()   
	{
            var id=$("#catid").val();
          // alert(id);
		if($(".categorynames").val()=="")
		{
			
			$("#menumaincategory_divs").addClass("has-error");
				  document.category_masteredit.menumaincategory1.focus();
                                  alert("Enter Category Name");
				  return false;
		}

                      var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#menumaincategory1").val())){
                              $("#menumaincategory_divs").addClass("has-error");
                            document.category_masteredit.menumaincategory1.focus();
                          alert("Special charecter Not Allowed.");
                   }
        
                        else
			 {
					var id1=id;
					//alert(id1);
	        var ab=$(".categorynames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcatedit&catid="+ab+"&catidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk=$('#catchk');
			if(data =="sorry")
			{
		 catchk.text('Category Name Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();

	return false;
			}
			else
			{
			
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	
	  //	alert('aa');
	  document.category_masteredit.submit();
			}
			}
		}); 
				 
				 
				 
            }	 
				 
				 
				 
				 
				 
//				 var a=document.getElementById("menumaincategory1").value;
//				 //alert(a);
//				$("#menumaincategory_divs").removeClass("has-error");
//					$(this).addClass("has-success");
//					 return true;
			 }
                         
                         
            function validate_dorder1()
                        {
                            if ($("#displayorder1").val() == "")
                            {
                                $("#dispalyorder1_div").addClass("has-error");
                                document.category_masteredit.displayorder1.focus();
                                alert("Enter Display Order");
                                return false;
                            } 
                           
                          var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#displayorder1").val())){
                       $("#dispalyorder1_div").addClass("has-error");
                        document.category_masteredit.displayorder1.focus();
                  alert("Special charecter Not Allowed.");
                        }
                            else
                            {
                                var isvalid = $.isNumeric($("#displayorder1").val())
                                if (isvalid)
                                {
                                    
                                    
                                    
                                    $("#dispalyorder1_div").removeClass("has-error");
                                    $(this).addClass("has-success");
                                    return true;
                                    
                                    
                                } else
                                {
                                    $("#dispalyorder1_div").addClass("has-error");
                                    document.category_masteredit.displayorder1.focus();
                                    alert("Enter Numeric Value");
                                    return false;
                                }
                            }
                        
                    } 
                    
                    
                    function validate_orderprint1()
                        {
                             var id=$("#catid").val();
                             //alert(id);
                            if ($("#orderprint1").val() == "")
                            {
                                $("#orderprint1_div").addClass("has-error");
                                document.category_masteredit.orderprint1.focus();
                                alert("Enter Order of Print");
                                return false;
                            } 
                           
                          var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#orderprint1").val())){
                       $("#orderprint1_div").addClass("has-error");
                        document.category_masteredit.orderprint1.focus();
                  alert(" Special charecter Not Allowed.");
                        }
                            else
                            {
                                var isvalid = $.isNumeric($("#orderprint1").val())
                                if (isvalid)
                                {
                                    $("#orderprint1_div").removeClass("has-error");
                                    $(this).addClass("has-success");
                                    return true;
                                } else
                                {
                                   
                                    $("#orderprint1_div").addClass("has-error");
                                    document.category_masteredit.orderprint1.focus();
                                     alert("Enter Numeric Value");
                                    return false;

                                var id2=id;
       
	                  var op1=$("#orderprint1").val().trim();
                
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkodprintedit&orderprint="+op1+"&opid="+id2,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#catchk1');
			if(data =="sorry")
			{
                            
		// namechk.text('Order of Print Already exists');
                 alert('Order of Print Already exists');
                  $("#orderprint1_div").addClass("has-error");	        
                  $("#orderprint1").focus();
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#orderprint1_div").removeClass("has-error");
	   $("#orderprint1_div").addClass("has-success");
	  	//alert('aa');
			}
			}
		}); 

                  
                                }
                            }
                        
                    }  
            function valicat1(){        
	var id1=id;
					//alert(id1);
	        var ab=$(".categorynames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcatedit&catid="+ab+"&catidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk=$('#catchk');
			if(data =="sorry")
			{
		 catchk.text('Category Name Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();

	return false;
			}
			else
			{
			
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	
	  //	alert('aa');
	  
			}
			}
		});
            }
	</script>