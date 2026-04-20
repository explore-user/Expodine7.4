<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['dscid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_discountmaster where ds_discountid='".$_SESSION['dscid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ds_discountname'];
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
<style>.navbar-inner{z-index: 999999 !important;}</style>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_discountmaster where ds_discountid='".$_SESSION['dscid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="discount_master.php"  method="post"  name="discount_masteredit">
                        	 <div class="first_form_contain">
                              <span id="disceditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Discount Name<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" tabindex="1" class="form-control discountnames" id="discountname1" name="discountname1"  placeholder="Discount Name" tabindex="0"  data-toggle="tooltip" title="Discount Name" value="<?=$result_login['ds_discountname']?>"></div>
                               </div>
                               
                               
                               <div class="first_form_contain">
                              <span id="disceditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Value</div>
                                
                                <div class="form_textbox_cc" id="valuepercnt_div1" >
                                <input tabindex="2" type="text" class="form-control valuepercnt1" id="valuepercnt1" name="valuepercnt1"  placeholder="No of visit" tabindex="0"  data-toggle="tooltip" title="No of visit" value="<?=$result_login['ds_discountof']?>"></div>
                               </div>
                               
                               
                                   <div class="first_form_contain">
                              <span id="disceditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Mode</div>
                                
                               	 <div class="form_textbox_cc" >
                                 
                                 
                                 
                                 
                                 <select tabindex="3" data-placeholder="Mode" name="mode"  id="mode" data-rel="chosen" title="Mode" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                      
                                         <optgroup label="Select Mode">
                                            <option value="V"  <?php if($result_login['ds_mode']=="V"){?> selected="selected"<?php } ?>>Value</option>
                                            <option value="P"<?php if($result_login['ds_mode']=="P"){?> selected="selected"<?php } ?>>%</option>
                                         </optgroup>
                                    	 </select>
                                 
                            </div>
                               </div>                               
 
                               <div class="first_form_contain" style="display:none">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="bch_divs">
                                  
                                
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Branch" id="branch1" name="branch1" data-rel="chosen" title="BranchName" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Branch">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  id="<?=$result_kot['be_branchid']?>" <?php if($result_kot['be_branchid']==$result_login['ds_branchid']) { ?> selected="selected" <?php } ?>><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                        
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                 	 <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc">
                                  <input  type="checkbox" value="<?=$result_login['ds_status']?>" tabindex="4" name="active1"  id="active1" data-toggle="tooltip" title="active" <?php if($result_login['ds_status']=="Active") { ?> checked <?php } ?> >
                               </div></div>
                                    
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Item Discount</div>
                               	 <div class="form_textbox_cc">
                                  <input type="checkbox" value="<?=$result_login['ds_item_discount']?>" tabindex="5" name="active_item1"  id="active_item1" data-toggle="tooltip" title="active" <?php if($result_login['ds_item_discount']=="Y") { ?> checked <?php } ?> >
                               </div></div>
                                    
                                    
                                 <input type="hidden" name="discountid" id="discountid" class="menuname" style="color:black" value="<?=$result_login['ds_discountid']?>">         
                                 
                                 <a tabindex="6"  href="#" class="entersubmit" onClick="update_discval()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">

    $("#discountname1").focus();

$('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function validate_discall()
{
	
	var discidchk=$("#discountid").val();
				 var ab=$(".discountnames").val().trim();
				 var br=$("#branch1").find('option:selected').attr('id');
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkdiscedit&discname="+ab+"&discidchk="+discidchk+"&branchhh="+br,
			success: function(data)
			{
			data=$.trim(data);

			var namechk=$('#disceditchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#discountname1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.discount_masteredit.submit();
			}
			}
		});
	
	
}


function update_discval()
			{
			 if(validate_discount1())
				{
                                     if(validate_value1())
		                  {
                                 
					
						if(validate_discall())
						{
						}
						
					//document.discount_masteredit.submit();
					
				
			     }
                            }
                           }
			function validate_discount1()   
			{
				if($(".discountnames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.discount_masteredit.discountname1.focus();
                                                 // alert("Enter Discount Name");
                                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Discount Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#discountname1").val())){
                                $("#menumaincategory_divs").addClass("has-error");
                               document.discount_masteredit.discountname1.focus();
                             // alert("Special charecter Not Allowed.");
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Charcters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                }
                                   else
					 {
                                               var a=document.getElementById("discountname1").value;
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
                        
                        function validate_value1()   
			{
                            
                            
                            if($("#valuepercnt1").val()=="")
		{
			
			$("#valuepercnt_div1").addClass("has-error");
				  //document.discount_master.valuepercnt1.focus();
                                 // alert("Enter Value");
                                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
				  return false;
		}
                 var alphanumers = /^[0-9 .]+$/;
                 if(!alphanumers.test($("#valuepercnt1").val())){
                 $("#valuepercnt_div1").addClass("has-error");
                 document.discount_masteredit.valuepercnt1.focus();
                           // alert("Enter Numeric Value.");
                           $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Numeric Value ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                            return false;
              }
              else if($("#valuepercnt1").val().split('.')[1] && $("#valuepercnt1").val().split('.')[1].length>3){
                  $("#valuepercnt_div1").addClass("has-error");
                    document.discount_master.valuepercnt.focus();
                  //  alert("MAX 3 DECIMAL POINTS ALLOWDED");
                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Max 3 Digits After point');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                    return false;
              }
              else if($("#valuepercnt1").val()>=100 && $("#mode").val()=='P'){
                    $("#valuepercnt_div1").addClass("has-error");
                    document.discount_master.valuepercnt.focus();
                   // alert("Enter Value Less than 100");
                   $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value Less than 100%');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                    return false;
              }
              
                  else
			 {
                             
                               var val = parseFloat($('#valuepercnt1').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#valuepercnt_div1").addClass("has-error");
					 document.discount_masteredit.valuepercnt1.focus();
                                        //alert("Does not start with zero.");
                                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Dont Start With Zero');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
					return false;
                                    }
			
				 var a=document.getElementById("valuepercnt1").value;
				 $("#valuepercnt_div1").removeClass("has-error");
				 $(this).addClass("has-success");
				
				 return true;
			 }
        	}
                        
                       
                    
                        
			 
                        
    $('#active_item1').click(function(){
        if($('#active_item1').prop('checked')){
            $('#mode').val('P');
            //$('#nwtype').attr('disabled', 'disabled');
        }else{
            $('#mode').val('');
         //$('#nwtype').removeAttr('disabled');
        }
    });
      
   $('#mode').change(function(){
       
      if($('#mode').val()!='P'){
         $('#active_item1').prop('checked',false); 
      }
       
   });
            </script>