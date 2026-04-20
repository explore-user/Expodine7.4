<?php
//include('../includes/session.php');
session_start();		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['vocpaymntid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id where vp_id='".$_SESSION['vocpaymntid']."'");

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

<script type="text/javascript">
            $(document).ready(function () {
       
                $("#paymentmode1").change(function () {
                var aat1 = ($(this).val());
                if (aat1 == "Cheque") {
                   $('#chequeleafno1').prop('readonly', false); 
                      $('#chequebank1').prop('readonly', false); 
                         $('#chequebranch1').prop('readonly', false); 
                       $(".cheque_ccedit").show();
                       $('.cheque_cashedit').css("display", "none");

                    }
                    if (aat1 == "Cash") {
                       $("#chequebranch1").val("");
                       $("#chequebank1").val("");
                        $("#chequeleafno1").val("");
                      $('.cheque_cashedit').css("display", "block");
                      $('.cheque_ccedit').css("display", "none");
                    }
                    
                    if (aat1 == "Card") {
                        $("#chequebranch1").val("");
                       $("#chequebank1").val("");
                        $("#chequeleafno1").val("");
                      $('.cheque_cashedit').css("display", "block");
                      $('.cheque_ccedit').css("display", "none");
                    }

                    });
            });


</script>


<div class="md-content" style="position:fixed;width:60%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Change Type  </strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button style="width: 50px;" class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment INNER JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id and vp_id='".$_SESSION['vocpaymntid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                   <form role="form" style="padding:10px" action="voucher_payment.php"  method="post"  name="voucher_paymentedit">
                            <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vp_id']?>">       
                        	<input type="hidden" class="form-control vouchernames" id="date1"  placeholder="Date" tabindex="0"  data-toggle="tooltip" title="Date" value="<?=$result_login['vp_date']?>">

                                   <div class="first_form_contain" style="width:49%">
                                   <div class="form_name_cc">Voucher Head<span style="color:#F00">*</span></div>
                                   <div class="form_textbox_cc" id="menumaincategory_divs" > <div class="form-group" id="voucher_divs">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_voucherhead where vh_active='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                                                                                             ?>
                                           <select data-placeholder="Enter Voucher Name" id="vhid1change" name="vhid1change" data-rel="chosen" tabindex="1" autofocus="autofocus" title="Voucher Name" left"." data-toggle="tooltip" class="form-control vhid1 add_new_dropdown">
<!--                                <option value=""></option>-->
                                <optgroup label="Voucher Head">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                               <option value="<?=$result_kot['vh_id']?>"  id="<?=$result_kot['vh_id']?>" <?php if($result_kot['vh_id']==$result_login['vp_vhid']) { ?> selected="selected" <?php } ?>><?=$result_kot['vh_vouchername']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                </div>
                                </div>
                                <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Type</div>
                               	<div class="form_textbox_cc" id="paymentmode_divs">
                                    <select class="form-control" name="type2" id="type2" data-rel="chosen" title="Type" tabindex="2" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
<!--                                            <option value=""></option>-->
                                        <option value="Expense" <?=($result_login['vp_type']=='Expense'? 'selected':'')?>>Expense</option>
                                   	<option value="Income"  <?=($result_login['vp_type']=='Income'? 'selected':'')?>>Income</option>
                                        	<option value="Credit Income"  <?=($result_login['vp_type']=='Credit Income'? 'selected':'')?>>Credit Income</option>
                                                	<option value="Credit Expense"  <?=($result_login['vp_type']=='Credit Expense'? 'selected':'')?>>Credit Expense</option>
                               	    </select>
                               </div>
                            </div>
                                <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Mode of Payment</div>
                               	<div class="form_textbox_cc" id="paymentmode_divs">
                                    <select class="form-control" name="paymentmode1" id="paymentmode1" data-rel="chosen" title="Type" tabindex="2" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
<!--                                            <option value=""></option>-->
                                            <option value="Cash" <?=($result_login['vp_paymentmode']=='Cash'? 'selected':'')?>>Cash</option>
                                   	<option value="Card"  <?=($result_login['vp_paymentmode']=='Card'? 'selected':'')?>>Card</option>
                                        <option value="Cheque"  <?=($result_login['vp_paymentmode']=='Cheque'? 'selected':'')?>>Cheque</option>
                               	    </select>
                               </div>
                            </div>
                                <!--cheque-->
                                <div class="cheque_ccedit" style="display:block">
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Bank Name</div>
                               	<div class="form_textbox_cc" id="chequebank_divs">
                            <input type="text" class="form-control" id="chequebank1" name="chequebank1"  placeholder="Cheque Bank Name" tabindex="3"  data-toggle="tooltip" title="Cheque Bank Name" value="<?=$result_login['vp_chequebank']?>"  <?=$result_login['vp_paymentmode']=='Cash' ? 'readonly':''?>>
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Branch Name</div>
                               	<div class="form_textbox_cc" id="chequebranch_divs">
                            <input type="text" class="form-control" id="chequebranch1" name="chequebranch1"  placeholder="Cheque Branch Name" tabindex="4"  data-toggle="tooltip" title="Cheque Branch Name" value="<?=$result_login['vp_chequebranch']?>"  <?=$result_login['vp_paymentmode']=='Cash' ? 'readonly':''?>>
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Leaf Number</div>
                               	<div class="form_textbox_cc" id="chequeleafno_divs">
                            <input type="text" class="form-control" id="chequeleafno1" name="chequeleafno1"  placeholder="Cheque Leaf Number " tabindex="5"  data-toggle="tooltip" title="Cheque Leaf Number" value="<?=$result_login['vp_chequeleafno']?>"  <?=$result_login['vp_paymentmode']=='Cash' ? 'readonly':''?>>
                                </div>
                               </div>
                            </div>
                            <!--cheque end -->   
                            
                            <!--cash-->
                            <div class="cheque_cashedit" style="display:none">
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Bank Name</div>
                               	<div class="form_textbox_cc" id="chequebank_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequebank11" name="chequebank1"  placeholder="Cheque Bank Name" tabindex="6"  data-toggle="tooltip" title="Cheque Bank Name" value="">
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Branch Name</div>
                               	<div class="form_textbox_cc" id="chequebranch_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequebranch11" name="chequebranch1"  placeholder="Cheque Branch Name" tabindex="7"  data-toggle="tooltip" title="Cheque Branch Name" value=""  >
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Leaf Number</div>
                               	<div class="form_textbox_cc" id="chequeleafno_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequeleafno11" name="chequeleafno1"  placeholder="Cheque Leaf Number " tabindex="8"  data-toggle="tooltip" title="Cheque Leaf Number" value="">
                                </div>
                               </div>
                            </div>
                            <!-- cash end -->
                            

                           <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Amount</div>
                               	<div class="form_textbox_cc" id="amount_divs">
                            <input type="text" class="form-control" id="amount1" name="amount1"  placeholder="Amount" tabindex="9"  data-toggle="tooltip" title="Amount" value="<?=$result_login['vp_amount']?>">
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Paid To</div>
                               	<div class="form_textbox_cc" id="paidto_divs">
                            <input type="text" class="form-control" id="paidto1" name="paidto1"  placeholder="Paid To" tabindex="10"  data-toggle="tooltip" title="Paid To" value="<?=$result_login['vp_paidto']?>">
                                </div>
                               </div>
                            
                             <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Received by</div>
                               	<div class="form_textbox_cc" id="receivedby_divs">
                            <input type="text" class="form-control" id="receivedby1" name="receivedby1"  placeholder="Received by" tabindex="11"  data-toggle="tooltip" title="Received by" value="<?=$result_login['vp_receivedby']?>">
                                </div>
                               </div>
                            
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Voucher/Bill no</div>
                               	<div class="form_textbox_cc" id="receivedby_divs">
                            <input type="text" class="form-control" id="voucherbillno1" name="voucherbillno1"  placeholder="Voucheer no" tabindex="11"  data-toggle="tooltip" title="Received by" value="<?=$result_login['vp_voucherno']?>">
                                </div>
                               </div>
                               <input type="hidden" name="branch" id="branch" value="<?=$_SESSION['branchofid']?>">
                              
                                <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vp_id']?>">        
                              <div class="first_form_contain" style="width:100%">
                               	<a  href="#" class="entersubmit"  onClick="update_voceval()" tabindex="12"><span class="md-save newbut">Submit</span></a>
                              </div>
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
			
				 var ab=$("#vhid1change").val().trim();
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucherpaymentedit&vhid1="+ab+"&voucheridchk="+voucheridchk,
			success: function(data)
			{
			data=$.trim(data);
	//alert(data);
			var namechk=$('#vouchereditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#vhid1change").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.voucher_paymentedit.submit();
			}
			}
		});
			
			}

function update_voceval()
			{
//			if(validate_voucher1())
//				{
                                    if(validate_paidto())
				{
//                                    if(validate_chequebank())
//				{
//                                    if(validate_chequebranch())
//				{
                                    if(validate_receivedby())
				{
				
                                    if(validate_amount())
				{
                                   
//                                        if(validate_vhid()){
                                            if(validate_voucherall())
				{
                                            
                                        }
 //                                   }
                                   
                                 } 
				 }
//                                }
//                               }
                                }
//			     }
			}
			
			
			
//			function validate_voucher1()   
//			{
//				if($(".vhid1").val()=="")
//				{
//					$("#menumaincategory_divs").addClass("has-error");
//						  document.voucher_paymentedit.vhid1.focus();
//						  return false;
//				}else
//					 {
//						 var a=document.getElementById("vhid1").value;
//						 
//						
//						$("#menumaincategory_divs").removeClass("has-error");
//							$(this).addClass("has-success");
//							 return true;
//						
//					 }
//			}

//                      function validate_voucher1()   
//			{
//				if($(".vhid1").val()=="")
//				{
//					$("#menumaincategory_divs").addClass("has-error");
//					document.voucher_paymentedit.vhid1.focus();
//                                        alert("Select Voucher Head");
//					return false;
//				}
//                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                                 if(!alphanumers.test($("#vhid1").val())){
//                                 $("#menumaincategory_divs").addClass("has-error");
//                                document.voucher_paymentedit.vhid1.focus();
//                                 alert("Special charecter Not Allowed.");
//                              }
//                                   else
//				 {
//					 $("#menumaincategory_divs").removeClass("has-error");
//					 $(this).addClass("has-success");
//					 return true;
//				 }
//			}

                        
                       function validate_paidto()   
			{
				if($("#paidto1").val()=="")
				{
					$("#paidto_divs").addClass("has-error");
						  document.voucher_paymentedit.paidto1.focus();
                                                  alert("Enter Paid To");
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#paidto1").val())){
                                 $("#paidto_divs").addClass("has-error");
                                   document.voucher_paymentedit.paidto1.focus();
                                            alert("Special charecter Not Allowed.");
                              }
                                    else
					 {
						 var a=document.getElementById("paidto1").value;
						 
						
						$("#paidto_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
                        
                        
                        function validate_chequebank()   
			{
				if($("#chequebank1").val()=="")
				{
					$("#chequebank_divs").addClass("has-error");
						  document.voucher_paymentedit.chequebank1.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("chequebank1").value;
						 
						
						$("#chequebank_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
                        
                        
                        
                        function validate_chequebranch()   
			{
				if($("#chequebranch1").val()=="")
				{
					$("#chequebranch_divs").addClass("has-error");
						  document.voucher_paymentedit.chequebranch1.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("chequebranch1").value;
						 
						
						$("#chequebranch_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
                        
                        
                        function validate_receivedby()   
			{
				if($("#receivedby1").val()=="")
				{
					$("#receivedby_divs").addClass("has-error");
						  document.voucher_paymentedit.receivedby1.focus();
                                                  alert("Enter Received by");
						  return false;
				}
                                
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#receivedby1").val())){
                                 $("#receivedby_divs").addClass("has-error");
                                  document.voucher_paymentedit.receivedby1.focus();
                                  alert("Special charecter Not Allowed.");
                              }
                                   else
					 {
						 var a=document.getElementById("receivedby1").value;
						 
						
						$("#receivedby_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
              
                        
              
                        
                        function validate_amount()   
			{
				if($("#amount1").val()=="")
				{
					$("#amount_divs").addClass("has-error");
					document.voucher_paymentedit.amount1.focus();
                                        alert("Enter Amount");
					return false;
				}
//                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                                 if(!alphanumers.test($("#amount1").val())){
//                                 $("#amount_divs").addClass("has-error");
//                                  document.voucher_paymentedit.amount1.focus();
//                //                            alert("Special charecter Not Allowed.");
//                              }
                                 var val = parseFloat($('#amount1').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#amount_divs").addClass("has-error");
					document.voucher_paymentedit.amount1.focus();
                                         alert("Enter Numeric Value and Does not start with zero.");
//                                        namechk1.text('Does not start with zero');
					return false;
                                    }
                              else
				 {
					 var isvalid = $.isNumeric($("#amount1").val()) 
						if(isvalid)
						{
							 $("#amount_divs").removeClass("has-error");
							 $(this).addClass("has-success");
							 return true;
						}else
						{
							$("#amount_divs").addClass("has-error");
							document.voucher_paymentedit.amount1.focus();
                                                        alert("Enter Numeric Value and Does not start with zero.");
							return false;
						}
				 }
			}
		
	  
            
            </script>


