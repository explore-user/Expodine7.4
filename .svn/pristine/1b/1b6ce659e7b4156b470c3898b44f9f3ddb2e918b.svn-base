<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['vocid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_vouchermaster where vr_voucherid='".$_SESSION['vocid']."'");

$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['vr_vouchername'];
                         
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
	 $("#voucherfrom1").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$("#voucherexpiry1").datepicker({
      changeMonth: true,
      changeYear: true
    });	
 });
 
</script>
<div class="md-content" style="position:fixed;width:67%;left:17%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_vouchermaster where vr_voucherid='".$_SESSION['vocid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>   
                           <form role="form" action="voucher_master.php"  method="post"  name="voucher_masteredit">
                            <div style="width:50%; float:left">
                        	 <div class="first_form_contain">
                              <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control vouchernames" id="vouchername1" name="vouchername1"  placeholder="Voucher Name" tabindex="0"  data-toggle="tooltip" title="Voucher Name" value="<?=$result_login['vr_vouchername']?>"></div>
                               </div>
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Voucher From<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vcfm_divs">
                                <input type="text" class="form-control vouchernames" id="voucherfrom1" name="voucherfrom1"  placeholder="Voucher From" tabindex="0"  data-toggle="tooltip" title="Voucher From" value="<?=$result_login['vr_voucherfrom']?>"></div>
                               </div>
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Voucher Expiry<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vce_divs">
                                <input type="text" class="form-control vouchernames" id="voucherexpiry1" name="voucherexpiry1"  placeholder="Voucher Expiry" tabindex="0"  data-toggle="tooltip" title="Voucher Expiry" value="<?=$result_login['vr_voucherexpiry']?>"></div>
                               </div>
                                <div class="first_form_contain" style="display: none">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="brnch_divs">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){ ?>
                                        <select data-placeholder="Enter Branch" id="branch1" name="branch1" data-rel="chosen" title="BranchName" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Branch">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>" <?php if($result_kot['be_branchid']==$result_login['vr_branchid']) { ?> selected="selected" <?php } ?>><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                        
                                         </div>
                                   	    </div><!--form_textbox_cc--->
                                    </div><!--first_form_contain-->
                               </div>
                               
                                <div style="width:50%; float:left">
                               	 <div class="first_form_contain">
                                     <span id="vouchereditchk1" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Cost<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vcct_divs">
                                <input type="text" class="form-control vouchercosts" id="vouchercost1" name="vouchercost1"  placeholder="Voucher Cost" tabindex="0"  data-toggle="tooltip" title="Voucher Cost" value="<?=$result_login['vr_vouchercost']?>"></div>
                               </div>
                               	 <div class="first_form_contain">
                                     <span id="vouchereditchk3" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher Holder<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vchld_divs">
                                <input type="text" class="form-control voucherholders" id="voucherholder1" name="voucherholder1"  placeholder="Voucher Holder" tabindex="0"  data-toggle="tooltip" title="Voucher Holder" value="<?=$result_login['vr_voucherholder']?>"></div>
                               </div>
                               	 <div class="first_form_contain">
                                      <span id="vouchereditchk2" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Holder Contact<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="vccnt_divs">
                                <input type="text" class="form-control voucherholdercontacts" id="voucherholdercontact1" name="voucherholdercontact1"  placeholder="Voucher Holder Contact" tabindex="0"  data-toggle="tooltip" title="Voucher Holder Contact" value="<?=$result_login['vr_holdercontact']?>"></div>
                               </div>
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['vr_active']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['vr_active']=="Yes") { ?> checked <?php } ?> >
                               </div></div>
                               </div>
                               
                                 <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vr_voucherid']?>">         
                               
                             
                                 
                                 <a  href="#" class="entersubmit"  onClick="update_voceval()"><span class="md-save newbut">Update</span></a>
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
function validate_voucherall()
			{
				//alert('a');
				var voucheridchk=$("#voucherid").val();
			
				 var ab=$("#vouchername1").val().trim();
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucheredit&vouchername="+ab+"&voucheridchk="+voucheridchk,
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
document.voucher_masteredit.submit();
			}
			}
		});
			
			}

function update_voceval()
			{
			if(validate_voucher1())
				{
					if(validate_voucherfrom())
					{
						if(validate_voucherexpiry())
						{
						
							  if(validate_vouchercost())
							  {
							 	 if(validate_voucherhld())
								 {
							  		if(validate_vouchercnt())
									{
										if(validate_voucherall())
										{
										}
									//	document.voucher_masteredit.submit();
									}
								 }
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
						  document.voucher_masteredit.vouchername1.focus();
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#vouchername1").val())){
                                 $("#menumaincategory_divs").addClass("has-error");
                                  document.voucher_masteredit.vouchername1.focus();
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
			function validate_voucherfrom()   
			{
				if($("#voucherfrom1").val()=="")
				{
					$("#vcfm_divs").addClass("has-error");
					document.voucher_masteredit.voucherfrom1.focus();
					return false;
				}
                                var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#voucherfrom1").val())){
                                 $("#vcfm_divs").addClass("has-error");
                                  document.voucher_masteredit.voucherfrom1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                               else
				 {
					 $("#vcfm_divs").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
			function validate_voucherexpiry()   
			{
				if($("#voucherexpiry1").val()=="")
				{
					$("#vce_divs").addClass("has-error");
					document.voucher_masteredit.voucherexpiry1.focus();
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#voucherexpiry1").val())){
                                 $("#vce_divs").addClass("has-error");
                                  document.voucher_masteredit.voucherexpiry1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                                 else
				 {
					 $("#vce_divs").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}			
			
			function validate_vouchercost()   
			{
				if($("#vouchercost1").val()=="")
				{
					$("#vcct_divs").addClass("has-error");
					document.voucher_masteredit.vouchercost1.focus();
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9. ]+$/;
                                 if(!alphanumers.test($("#vouchercost1").val())){
                                 $("#vcct_divs").addClass("has-error");
                                  document.voucher_masteredit.vouchercost1.focus();
                //                            alert("Special charecter Not Allowed.");
                              }
                                 else
				 {
                                      var namechk1=$('#vouchereditchk1');
                                      var val = parseFloat($('#vouchercost1').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#vcct_divs").addClass("has-error");
					document.voucher_masteredit.vouchercost1.focus();
                                        alert("Does not start with zero.")
//                                        namechk1.text('Does not start with zero');
					return false;
                                    }
					 var isvalid = $.isNumeric($("#vouchercost1").val()) 
						if(isvalid)
						{
							 $("#vcct_divs").removeClass("has-error");
							 $(this).addClass("has-success");
							 return true;
						}else
						{
							$("#vcct_divs").addClass("has-error");
							document.voucher_masteredit.vouchercost1.focus();
							return false;
						}
				 }
			}
			// vcfm_div vce_div brnch_div vcct_div vchld_div vccnt_div
           //voucherfrom voucherexpiry branch vouchercost voucherholder voucherholdercontact
		   //validate_voucherfrom validate_voucherexpiry validate_voucherbranch validate_vouchercost validate_voucherhld validate_vouchercnt
			function validate_voucherhld()   
			{
				if($("#voucherholder1").val()=="")
				{
					$("#vchld_divs").addClass("has-error");
					document.voucher_masteredit.voucherholder1.focus();
					return false;
				}
                                 var namechk3=$('#vouchereditchk3');
                                var alphanumers = /^[a-zA-Z ]+$/;
                                 if(!alphanumers.test($("#voucherholder1").val())){
                                 $("#vchld_divs").addClass("has-error");
                                document.voucher_masteredit.voucherholder1.focus();
                                   alert("Please Enter Correct value.");
//                                 namechk3.text('Please Enter Correct value');
					return false;
                                          
                              }
                              
                                 else
				 {
					 $("#vchld_divs").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
			function validate_vouchercnt()   
			{
				if($("#voucherholdercontact1").val()=="")
				{
					$("#vccnt_divs").addClass("has-error");
					document.voucher_masteredit.voucherholdercontact1.focus();
					return false;
				}
                                  var namechk2=$('#vouchereditchk2');
                                var alphanumers = /^[0-9 ]+$/;
                                 if(!alphanumers.test($("#voucherholdercontact1").val())){
                                 $("#vccnt_divs").addClass("has-error");
                                 document.voucher_masteredit.voucherholder1.focus();
                                 alert("Please Enter Numeric value.");
//                                 namechk2.text('Please Enter Numeric value');
					return false;
                                           
                              }
                               else
				 {
					 $("#vccnt_divs").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
            
            </script>