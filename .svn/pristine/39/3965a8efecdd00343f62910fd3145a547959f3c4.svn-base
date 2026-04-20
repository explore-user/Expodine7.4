<?php
//include('../includes/session.php');
session_start();		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['vochapvid']=$_REQUEST['menu'];



$sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid where vp_id='".$_SESSION['vochapvid']."'");
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
<div  class="dfineheading"> <strong>Approve</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button style="width: 50px;" class="md-close_pop">x</button></a>
 <?php
  $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment INNER JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id and vp_id='".$_SESSION['vochapvid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
               <form role="form" action="voucher_payment.php"  method="post"  name="voucher_paymentapprove">
                 <input type="hidden" class="form-control vouchernames" name="vhid21" id="vhid21"  placeholder="Approvedby" tabindex="0"  data-toggle="tooltip" title="Approvedby" value="<?=$_SESSION['expodine_id']?>">
                              
                              
                        <input type="hidden" class="form-control vouchernames" id="date12"  placeholder="Date" tabindex="0"  data-toggle="tooltip" title="Date" value="<?=$result_login['vp_approveddate']?>">
                        <div class="first_form_contain">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Remarks</div>
                               	<div class="form_textbox_cc" id="menumaincategory_divs">
                            <input type="text" class="form-control remarks" to_dt="<?=$_REQUEST['to']?>"  fr_dt="<?=$_REQUEST['fr']?>" vp_new_id="<?=$result_login['vp_id']?>" id="vhid2" name="vhid2"  placeholder="Remarks" tabindex="0"  data-toggle="tooltip" title="Remarks" value="<?=$result_login['vp_remarks']?>">
                                </div>
                        </div>
                        
                      
               <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vp_id']?>"> 
               
               <?php 
//               if($result_login['vp_status']=="Added"){ 
                   
//               }
?>  
<!--               <a  onClick="delete_confirm1('ToNo','<?=$result_login['vp_id']?>')"  ></a>-->
                               <?php // } else{ ?>
<!--               <a  onClick="delete_confirm('ToYes','<?=$result_login['vp_id']?>')"  ></a>-->
                        <?php //  } ?> 
               
                       
               	<a  href="#"  onClick="approve_vouch()"><span class="md-save newbut">Approve</span></a>
<!--                 <a href="#"><button class="md-close newbut">Close me!</button></a>-->
               </form>
                <?php }} ?>
     
</div>

<script type="text/javascript">
 
function voucherapproveclr()
{
	document.getElementById('vhid2').value = '';
     	    $('#voucherchk').text('');
	$("#menumaincategory_divs").removeClass("has-error");
               
} 
    
    
    
function validate_approveall()
			{
                       
//document.voucher_paymentapprove.submit();


			}
			
			
			
                        
                        
                      function approve_vouch()
			{			
                         var from= $(".remarks").attr('fr_dt');
                   var to =$(".remarks").attr('to_dt');
                            
			
				var voucheridchk=$(".remarks").attr('vp_new_id');
			
                          
                           var rmk= $(".remarks").val();
                         
                          $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=approve_voucher_new&rmk="+rmk+"&voucherid="+voucheridchk,
			success: function(data)
			{
                          
                          
                           setInterval(function () {
                       window.location.href='voucher_payment.php?set=load_date&from='+from+'&to='+to

    }, 500);
                            
                        }
                    }) ;           
 
                     
                }    
                        
                        
   </script>                  