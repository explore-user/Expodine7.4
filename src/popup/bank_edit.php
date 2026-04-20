<?php
session_start();
//include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['bankid']=$_REQUEST['bank'];
$sql_login  =  $database->mysqlQuery("select * from tbl_bankmaster where bm_id='".$_SESSION['bankid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['bm_name'];
	  }			
} 
else
{
  $searchname="";
}


	  
	  
	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */   



    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $('.md-close_pop').click();
    });
            
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
		
	/***************************************  Popup function starts *************************************************  */


	$("#bankaname1").focus();

	$(".enter").keypress(function(event){
    if(event.keyCode==13){
      update_bank();
    }
});

	 $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function valicat1(id)
           {
		
			  $('#catchk').text('');
			var id1=id;
		
	        var ab=$(".banknames").val().trim();
			
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkbankedit&catid="+ab+"&catidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk=$('#catchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// catchk.text('Already exists');
		   $("#bank_divs").addClass("has-error");
	  $("#bankaname1").focus();
//return false;
	
			}
			else
			{
				//alert('aa');
		catchk.text('');
		 $("#bank_divs").removeClass("has-error");
	   $("#bank_divs").addClass("has-success");
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



	
	
	
	
	
 function update_bank()
	{
		
	 if(validate_menumaincategory1())
		{
			
		}
	}
	
	function validate_menumaincategory1()   
	{
		var id=$("#catid").val();
	    
		if($(".banknames").val()=="")
		{
			$("#bank_divs").addClass("has-error");
				  //document.bank_masteredit.bankname1.focus();
                                  //alert("Enter Bank Name");
                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Bank Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
				  return false;
		}
                
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#bankaname1").val())){
                              $("#bank_divs").addClass("has-error");
                         document.bank_masteredit.bankaname1.focus();
                 // alert("Special charecter Not Allowed.");
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
                 else
			 {
					var id1=id;
					//alert(id1);
	        var ab=$(".banknames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkbankedit&catid="+ab+"&catidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk=$('#catchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// catchk.text('Already exists');
		   $("#bank_divs").addClass("has-error");
	  $("#bankname1").focus();

	return false;
			}
			else
			{
			
		catchk.text('');
		 $("#bank_divs").removeClass("has-error");
	   $("#bank_divs").addClass("has-success");
	
	  //	alert('aa');
	  document.bank_masteredit.submit();
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
	}
	
</script>
 <link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
       <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
      <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
     <script src="tooltip/main.js" type="text/javascript"></script>
<div class="md-content" style="position:fixed;width:50%;left:25%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_bankmaster where bm_id='".$_REQUEST['bank']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="bank_master.php"  method="post"  name="bank_masteredit">
                                 
                           
                        	 <div class="first_form_contain">
                             
                             	<div class="form_name_cc">Bank Name<span style="color:#F00">*</span></div>
                               <span id="catchk" class="load_error alertsmaster" style="color:#F00" ></span>
                               	 <div class="form_textbox_cc" id="bank_divs">
                                <input type="text" class="form-control banknames" id="bankaname1" name="bankaname1"  placeholder="Bank Name" tabindex="1"  data-toggle="tooltip" title="Bank Name" value="<?=$result_login['bm_name']?>" onchange="valicat1('<?=$result_login['bm_id']?>')"></div>
                               </div>
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['bm_active']?>" tabindex="2" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['bm_active']=="Y") { ?> checked <?php } ?> >
                               </div></div>
                               
                               
                                <?php  if($_SESSION['accounts_section']=='Y') { ?>  
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Bank Acc<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="bank_div">
                                
                               
                                     <select class="form-control" id="bank_acc" name="bank_acc1" tabindex="3">
                            <option value="">Select</option>
                            <?php 
                            $sql_login1  =  $database->mysqlQuery("select * from tbl_ledger_master where tlm_type='Bank_account' "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      ?>
                  
                            <option <?php if($result_login1['tlm_id']==$result_login['bm_account']){ ?> selected <?php } ?>  value="<?=$result_login1['tlm_id']?>"><?=$result_login1['tlm_ledger_name']?></option>
                             
                             <?php } } ?>
                        </select >
                         </div>
                               </div> 
                                <?php } ?>   
                               
                        <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Lukado<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="bank_div">
                                     <select class="form-control" id="lukado1" name="lukado1" tabindex="3" style="pointer-events: none">
                          
                        
                            <option <?php if($result_login['bm_lukado']=='N'){ ?> selected <?php } ?>  value="N"> NO</option>
                             <option <?php if($result_login['bm_lukado']=='Y'){ ?> selected <?php } ?>  value="Y"> YES</option>
                             
                           
                        </select >
                                 
                                 </div>
                               </div> 
                               
                               
                               
                               
                                 <input type="hidden" name="catid" id="catid" class="menuname" style="color:black" value="<?=$result_login['bm_id']?>">         
                                 	<a class="entersubmit enter" tabindex="4" onclick="update_bank()"><span class="md-save newbut">Update</span></a>
                                    
                                  </form>  
 <?php }} ?>
                                            </div>
