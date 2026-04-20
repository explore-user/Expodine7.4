<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['cityid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select cy_cityname from tbl_city where cy_cityid='".$_SESSION['cityid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['cy_cityname'];
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
	 $sql_login  =  $database->mysqlQuery("select * from tbl_city INNER JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid and cy_cityid='".$_SESSION['cityid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="city_master.php"  method="post"  name="city_masteredit">
                           <input type="hidden" name="cityid" id="cityid" class="menuname" style="color:black" value="<?=$result_login['cy_cityid']?>">       
                        	 
                               
                                <div class="first_form_contain">
                                 	<div class="form_name_cc">Country<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group statename" id="country_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_country"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){  ?>
                                        <select data-placeholder="Enter State Name" id="country1" name="country1" data-rel="chosen" title="Country Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown" onChange="viewstate(this.value)">
                                        <option value=""></option>
                                         <optgroup label="COUNTRY">
                                         <?php while($result_kot  = $database->mysqlFetchArray($sql_kot)) 	{ ?>
                                            <option value="<?=$result_kot['cy_countyid']?>" id="<?=$result_kot['cy_countyid']?>" <?php if($result_kot['cy_countyid']==$result_login['cy_countryid']){ ?> selected="selected" <?php } ?>><?=$result_kot['cy_countryname']?></option>
                                          <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain--> 
                                    
                                    
                               
                               
	             <div class="first_form_contain">
                                 	<div class="form_name_cc">State<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="state_div1">
                                  <select data-placeholder="Enter State Name" id="state1" name="state1" data-rel="chosen" title="State Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="STATE">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_state where se_countryid='".$result_login['cy_countryid']."'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['se_stateid']?>" id="<?=$result_kot['se_stateid']?>" <?php if($result_kot['se_stateid']==$result_login['cy_stateid']) { ?> selected="selected" <?php } ?>><?=$result_kot['se_statename']?></option>
                                    <?php } ?> 
                                         
                                    	
                                         <?php } ?>
                                         </optgroup>
                                          </select>
                                     <input type="hidden" name="stateid" id="stateid" class="menuname" style="color:black" value="<?=$result_login['se_stateid']?>">               
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                    
                                    <div class="first_form_contain">
                              <span id="cityeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">City<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="city_div1">
                              <input type="text" class="form-control citynames" id="city1" name="city1"  placeholder="City" tabindex="0"  data-toggle="tooltip" title="City" value="<?=$result_login['cy_cityname']?>" ></div>
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
//valicity1
function valicity1()
           {
			   
			  $('#cityeditchk').text('');
			
			var id=$("#cityid").val();
	        var ab=$("#city1").val().trim();
			var b=$("#country1").find('option:selected').attr('id');
	var c=$("#state1").find('option:selected').attr('id');
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcityedit&cityname="+ab+"&cityidchk="+id+"&country="+b+"&state="+c,
			success: function(data)
			{
			data=$.trim(data);
			var catchk=$('#cityeditchk');
			if(data =="sorry")
			{
		// catchk.text('Already exists');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#city_div1").addClass("has-error");
	  $("#city1").focus();
//return false;
			}
			else
			{
		catchk.text('');
		 $("#city_div1").removeClass("has-error");
	   $("#city_div1").addClass("has-success");
	  document.city_masteredit.submit();
			}
			}
		});
			}
}
   function update_registration()
	{
	 if(validate_city1())
		{
			if(validate_country1())
				{
				  if(validate_state1())
				  {
					  if(valicity1())
					  {
					  }
			 		// document.city_masteredit.submit();
				  }
				}
		}
	}
	function validate_city1()   
	{
		var id=$("#cityid").val();
		if($("#city1").val()=="")
		{
		 $("#city_div1").addClass("has-error");
		 document.city_masteredit.city1.focus();
                 //alert("Enter City");
                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter City Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 return false;
		}
                
                var alphanumers = /^[a-zA-Z ]+$/;
                              if(!alphanumers.test($("#city1").val())){
                              $("#city_div1").addClass("has-error");
                             document.city_masteredit.city1.focus();
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Numeric value and Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                            // alert("Numeric value and Special Charecter Not Allowed.");
//                          alert("Special charecter Not Allowed.");
                   }  
        
               else
		 {
		 $("#city_div1").removeClass("has-error");
		 $("#city_div1").addClass("has-success");
		 return true;
		 
		 }
             }
        
	function validate_country1()   
			{
				
				if($("#country1").val()=="")
				{
					$("#country_div").addClass("has-error");
						  document.city_masteredit.country1.focus();
                                                  //alert("Select Country");
                                                   $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Country');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
        
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#country1").val())){
                              $("#country_div").addClass("has-error");
                            document.city_masteredit.country1.focus();
//                          alert("Special charecter Not Allowed.");
                   }
        
                                     else
					 {
						
						$("#country_div").removeClass("has-error");
							$("#country_div").addClass("has-success");
							 return true;
					 }
                                     }		
                                
	function validate_state1()   
			{
				if($("#state1").val()==""  || $("#state1").val()==null)
				{
					$("#state_div1").addClass("has-error");
						  document.city_masteredit.state1.focus();
                                                  //alert("Select State");
                                                   $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select State');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#state1").val())){
                              $("#state_div1").addClass("has-error");
                           document.city_masteredit.state1.focus();
//                          alert("Special charecter Not Allowed.");
                   }
        
                                    else
					 {
						$("#state_div1").removeClass("has-error");
							$("#state_div1").addClass("has-success");
							 return true;
					 }
                                     }		
                                
function viewstate(val)
{
	
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadstate&stateid="+val,
		  success: function(msg)
		  {
			  $('#state1').html(msg);
		  }
	  }); 
}

	</script>