<?php
//include('../includes/session.php');
session_start();		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['vochid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_voucherhead where vh_id='".$_SESSION['vochid']."'");

$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['vh_vouchername'];
                         
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
<div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
                  <div>
                     <?php
                         $sql_login  =  $database->mysqlQuery("select * from tbl_voucherhead INNER JOIN tbl_branchmaster ON tbl_voucherhead.vh_branchid=tbl_branchmaster.be_branchid and vh_id='".$_SESSION['vochid']."'"); 
                          $num_login   = $database->mysqlNumRows($sql_login);
                          if($num_login){
                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                        {
                         ?>
                         <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:10px;">
                        <form role="form" action="voucher_head.php"  method="post"  name="voucher_headedit">
<!--                            <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vh_id']?>">       -->
                                <div class="first_form_contain">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Name<span style="color:#F00">*</span></div>
                               	<div class="form_textbox_cc" id="menumaincategory_divs">
                            <input type="text" class="form-control vouchernames" id="vouchername1" name="vouchername1"  placeholder="Voucher Name" tabindex="0"  data-toggle="tooltip" title="Voucher Name" value="<?=$result_login['vh_vouchername']?>"></div>
                               </div>
                           
                           
                                
                           
                           
                           
                           
	                        <!--first_form_contain-->
                                          	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	<div class="form_textbox_cc">
                                    <input type="checkbox" value="<?=$result_login['vh_active']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['vh_active']=="Y") { ?> checked <?php } ?> >
<!--                                    <label><input name="No" type="checkbox">&nbsp; No</label>-->
                                </div></div>
                              
                                <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vh_id']?>">        
                         </div>
                      <a  href="#" class="entersubmit"  onClick="update_voceval()"><span class="md-save newbut">Update</span></a>
                        </form>  
                                <?php }} ?>
</div>
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
//function validate_voucherall()
//			{
//				//alert('a');
//				var voucheridchk=$("#voucherid").val();
//			
//				 var ab=$("#vouchername1").val().trim();
//				
//			$.ajax({
//			type: "POST",
//			url: "load_divcheckmenu.php",
//			data: "value=checkvoucherheadedit&vouchername1="+ab+"&voucheridchk="+voucheridchk,
//			success: function(data)
//			{
//			data=$.trim(data);
//	//alert(data);
//			var namechk=$('#vouchereditchk');
//			if(data =="sorry")
//			{
//		 namechk.text('Already exists');
//		   $("#menumaincategory_divs").addClass("has-error");
//	  $("#vouchername1").focus();
//
//	return false;
//			}
//			else
//			{
//			
//		namechk.text('');
//		 $("#menumaincategory_divs").removeClass("has-error");
//	   $("#menumaincategory_divs").addClass("has-success");
//	  // return true;
//document.voucher_headedit.submit();
//			}
//			}
//		});
//			
//			}



function validate_voucherall()
			{
				//alert('a');
				var voucheridchk=$("#voucherid").val();
			
				 var ab=$("#vouchername1").val().trim();
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucherheadedit&vouchername="+ab+"&voucheridchk="+voucheridchk,
			success: function(data)
			{
			data=$.trim(data);
	//alert(data);
			var namechk=$('#vouchereditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#vouchername1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.voucher_headedit.submit();
			}
			}
		});
			
			}







function update_voceval()
			{
			if(validate_voucher1())
				{
				if(validate_voucherall())
				{
                                    if(validate_type())
				{
                                    if(validate_voucherbranch())
                                   {
                                     
                                   }
				}
                            }					
			     }
			}
			
			
			
			function validate_voucher1()   
			{
				if($(".vouchernames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.voucher_headedit.vouchername1.focus();
						  return false;
				}
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#vouchername1").val())){
                                 $("#menumaincategory_divs").addClass("has-error");
                                document.voucher_headedit.vouchername1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                          else
					 {
						 var a=document.getElementById("vouchername1").value;
						 
						
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
                        
                        	function validate_type()   
			{
				if($("#type1").val()=="")
				{
					$("#type_divs").addClass("has-error");
						  document.voucher_headedit.type1.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("type1").value;
						 
						
						$("#type_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
                        
                        
                        
                        
                        	function validate_voucherbranch()   
			{
				if($("#branch1").val()=="")
				{
					$("#brnch_divs").addClass("has-error");
					document.voucher_headedit.branch1.focus();
					return false;
				}else
				 {
					 $("#brnch_divs").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
		
	  
            
            </script>