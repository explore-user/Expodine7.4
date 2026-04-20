<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['subcatid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_menusubcategory where msy_subcategoryid='".$_SESSION['subcatid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['msy_subcategoryname'];
	  }			
} 
else
{
  $searchname="";
}
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
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_menusubcategory where msy_subcategoryid='".$_SESSION['subcatid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="sub_category_master.php"  method="post"  name="sub_category_masteredit">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Sub Category Name<span style="color:#F00">*</span></div>
                                  <span id="subeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control subcategorynames" id="subcategory1" name="subcategory1"  placeholder="Sub Category Name" tabindex="0"  data-toggle="tooltip" title="Sub Category Name" value="<?=$result_login['msy_subcategoryname']?>" onchange="valisubcat1('<?=$result_login['msy_subcategoryid']?>')"></div>
                               </div>
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Display Order<span style="color:#F00"></span></div>
                                  <span id="subeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control subcategorynames" id="dis_order1" name="dis_order1"  placeholder="dis_order1" tabindex="0"  data-toggle="tooltip" title="Sub Category Name" value="<?=$result_login['msy_sub_displayorder']?>" ></div>
                               </div>
                               
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['msy_active']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['msy_active']=="Y") { ?> checked <?php } ?> >
                               </div></div>
                                 <input type="hidden" name="subcatid" id="subcatid" class="menuname" style="color:black" value="<?=$result_login['msy_subcategoryid']?>">         
                                 <a  href="#" class="entersubmit"  onClick="update_subcategory()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
	$('#subcategory1').focus();
    
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });

      $(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)
			//alert("hiiiii");
		$('.md-close_pop').click();
	});
    
    
function valisubcat1(id)
           {
			  $('#subeditchk').text('');
			var id1=id;
	        var ab=$(".subcategorynames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checksubcatedit&subcatid="+ab+"&subcatidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			
			var catchk=$('#subeditchk');
			if(data =="sorry")
			{
		 catchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();
         return false;
	
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
 function update_subcategory()
	{
	 if(validate_menusubcategory1())
		{
		
                          //document.sub_category_masteredit.submit();
		}
	}
	function validate_menusubcategory1()   
	{
		var id=$("#subcatid").val();
		if($(".subcategorynames").val()=="")
		{
			
			$("#menumaincategory_divs").addClass("has-error");
				  	  document.sub_category_masteredit.subcategory1.focus();
                                           alert("Enter Sub Category Name")
				  return false;
		}
                
                            var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#subcategory1").val())){
                              $("#menumaincategory_divs").addClass("has-error");
                           document.sub_category_masteredit.subcategory1.focus();
                          alert("Special charecter Not Allowed.");
                   }
        
                      else
			 {
					var id1=id;
					//alert(id1);
	        var ab=$(".subcategorynames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checksubcatedit&subcatid="+ab+"&subcatidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var subeditchk=$('#subeditchk');
			if(data =="sorry")
			{
		 subeditchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#subcategory1").focus();

	return false;
			}
			else
			{
			
		subeditchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	
	  //	alert('aa');
	  document.sub_category_masteredit.submit();
			}
			
                     }
		}); 
				 
				 
				 
				 
				 
				 
				 
				 
				/* 
				 var a=document.getElementById("menumaincategory1").value;
				 //alert(a);
				$("#menumaincategory_divs").removeClass("has-error");
					$(this).addClass("has-success");
					 return true;*/
			 }
	
		
		
                     
		
		
		
		
		
		
		
		
		
		
		
		
	/*	if($(".subcategorynames").val()=="")
		{
			$("#menumaincategory_divs").addClass("has-error");
				  document.sub_category_masteredit.subcategory1.focus();
				  return false;
		}else
			 {
				 var a=document.getElementById("subcategory1").value;*/
			//	$("#menumaincategory_divs").removeClass("has-error");
				//	$(this).addClass("has-success");
				//	 return true;
				
				
				
				
				
			// }
	}
	</script>