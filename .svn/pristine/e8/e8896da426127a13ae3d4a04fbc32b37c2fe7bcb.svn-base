<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['coupid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_couponcompany where cy_companyname='".$_SESSION['coupid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['cy_companyname'];
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

    <script>
 $(document).ready(function() {
     $("#startdate1").datepicker({
      changeMonth: true,
      changeYear: true
    });
 }); 
    
    </script>
<div class="md-content" style="position:fixed;width:50%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_couponcompany where cy_companyname='".$_SESSION['coupid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>   
                           <form role="form" action="coupon_company.php"  method="post"  name="coupon_companyedit">
                        	 <div class="first_form_contain">
                               <span id="cmpnychk1" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Coupon Name</div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control companynames" id="company1" name="company1"  placeholder="Company Name" tabindex="0"  data-toggle="tooltip" title="Company Name" readonly value="<?=$result_login['cy_companyname']?>"></div>
                               </div>
                               	 <div class="first_form_contain">
                             	<div class="form_name_cc">Start Date</div>
                                  	 <div class="form_textbox_cc" id="coup_divs">
                                <input type="text" class="form-control startdate" id="startdate1" name="startdate1"  placeholder="Start Date" tabindex="0"  data-toggle="tooltip" title="Start Date" value="<?=$result_login['cy_startdate']?>"></div>
                             
                               </div>
                               
                               
                                      
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                                
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['cy_active']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['cy_active']=="Yes") { ?> checked <?php } ?> >
                               </div></div>
                        
                               
                               
                                 <input type="hidden" name="compid" id="compid" class="menuname" style="color:black" value="<?=$result_login['cy_companyname']?>">         
                               
                             
                                  </form>
                                   <a  href="#" class="entersubmit"  onClick="update_coupval()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
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
            
   $('.md-close_pop').click();
    });

function validate_all()
{
	 var a=$("#company1").val().trim();
		var cid=$("#compid").val().trim();
		var b=$("#startdate1").val().trim();
	
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcmpnyedit&mid1="+a+"&strtdate1="+b+"&cid="+cid,
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#cmpnychk1');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#company1").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  	document.coupon_companyedit.submit();

			}
			}
		});
	
}
function update_coupval()
			{
			 if(validate_company1())
				{
					if(validate_cupst1())
					{
						
					document.coupon_companyedit.submit();
					}
				}
			}
			
			function validate_company1()   
			{
				if($(".companynames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.coupon_companyedit.company1.focus();
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#company1").val())){
                                 $("#menumaincategory_divs").addClass("has-error");
                                  document.coupon_companyedit.company1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                                   else
					 {
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
			function validate_cupst1()   
			{
				if($("#startdate1").val()=="")
				{
					$("#coup_divs").addClass("has-error");
						  document.coupon_companyedit.startdate1.focus();
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#startdate1").val())){
                                 $("#coup_divs").addClass("has-error");
                                  document.coupon_companyedit.startdate1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                                 else
					 {
						$("#coup_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
            
            </script>