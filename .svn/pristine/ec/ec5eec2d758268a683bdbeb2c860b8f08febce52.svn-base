<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['stateid']=$_REQUEST['state'];
$sql_login  =  $database->mysqlQuery("select se_statename from tbl_state where se_stateid='".$_SESSION['stateid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['se_statename'];
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
<div  class="dfineheading">  <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_state INNER JOIN tbl_country ON tbl_state.se_countryid=tbl_country.cy_countyid and se_stateid='".$_SESSION['stateid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="state_master.php"  method="post"  name="state_masteredit">
                           <input type="hidden" name="stateid" id="stateid" class="menuname" style="color:black" value="<?=$result_login['se_stateid']?>">       
                        	 
	             <div class="first_form_contain">
                                 	<div class="form_name_cc">Country<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="country_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_country"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Country Name" id="country1" name="country1" data-rel="chosen" title="Country Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="COUNTRY">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['cy_countyid']?>" id="<?=$result_kot['cy_countyid']?>"  <?php if($result_kot['cy_countyid']==$result_login['se_countryid']) { ?> selected="selected" <?php } ?>><?=$result_kot['cy_countryname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                     <input type="hidden" name="stateid" id="stateid" class="menuname" style="color:black" value="<?=$result_login['se_stateid']?>">               
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                    
                                    <div class="first_form_contain">
                              <span id="stateeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">State<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="state_div1">
                                <input type="text" class="form-control statenames" id="state1" name="state1"  placeholder="State" tabindex="0"  data-toggle="tooltip" title="State" value="<?=$result_login['se_statename']?>" ></div>
                               </div>
                             
                                    <a  href="#" class="entersubmit"  onClick="update_registration()"><span class="md-save newbut">Update</span></a>
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
    
function validate_stateall()
{ 
  $('#stateeditchk').text('');
 var ab=$("#state1").val().trim();
 var cntry1=$("#country1").find('option:selected').attr('id');
	var stateidchk=$("#stateid").val();

			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkstateedit&statename="+ab+"&stateidchk="+stateidchk,
			success: function(data)
			{
			data=$.trim(data);
	
			var namechk=$('#stateeditchk');
			if(data =="sorry")
			{
		// namechk.text('Already exists');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#state_div1").addClass("has-error");
	  $("#state1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#state_div1").removeClass("has-error");
	   $("#state_div1").addClass("has-success");
	  // return true;
document.state_masteredit.submit();
			}
			}
		});
}
function valistate1(id)
           {
			  $('#stateeditchk').text('');
			var id1=id;
		
	        var ab=$(".statenames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkstateedit&statename="+ab+"&stateidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
		
			var catchk=$('#stateeditchk');
			if(data =="sorry")
			{
		// catchk.text('Already exists');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#state_div1").addClass("has-error");
	  $("#state1").focus();
//return false;
			}
			else
			{
		catchk.text('');
		 $("#state_div1").removeClass("has-error");
	   $("#state_div1").addClass("has-success");
	 // return true;
			}
			}
		});
			}
}
   function update_registration()
	{
	 if(validate_state11())
		{
			if(validate_country1())
			{
				if(validate_stateall())
				{
				}
				
    	<!---->document.state_masteredit.submit();
			}
		}
	}
	function validate_state11()   
	{
		var id=$("#stateid").val();
		if($("#state1").val()=="")
		{
		 $("#state_div1").addClass("has-error");
		 document.state_masteredit.state1.focus();
                // alert("Enter State");
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter State Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 return false;
		}
                           var alphanumers = /^[a-zA-Z ]+$/;
                              if(!alphanumers.test($("#state1").val())){
                              $("#state_div1").addClass("has-error");
                               document.state_masteredit.state1.focus();
                               //alert("Numeric value and Special Charecter Not Allowed.");
                               $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Numeric value and Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   } 
        
                else
		 {
		 $("#state_div1").removeClass("has-error");
		 $("#state_div1").addClass("has-success");
		 return true;
		 
		 }
             }
        
	function validate_country1()   
			{
				if($("#country1").val()=="")
				{
					$("#country_div1").addClass("has-error");
						  document.state_masteredit.country1.focus();
                                                //  alert("Select Country");
                                                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Country');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
                                          var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#country1").val())){
                              $("#country_div1").addClass("has-error");
                               document.state_masteredit.country1.focus();
//                          alert("Special charecter Not Allowed.");
                    
                            }
                                     else
					 {
						$("#country_div1").removeClass("has-error");
						$("#country_div1").addClass("has-success");
					    return true;
					 }
                                     }
                     
	</script>