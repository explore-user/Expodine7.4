<?php
error_reporting(0);
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['staffid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid='".$_SESSION['staffid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ser_firstname'];
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
		   $('.mynewpopupload').empty();
    }
/***************************************  Popup function starts *************************************************  */
</script>

    <script>

$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
        //alert("hi");    
        $('.md-close_pop').click();
    });

       
    $("#firstname1").focus();
    $(document).ready(function() {
    $("#dob1").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#dateofjoin1").datepicker({
      changeMonth: true,
      changeYear: true
    });
 });
</script>
<script>
$(document).ready(function(){
	var mode=$('#hidemode').val();
	
	if(mode =="B")
	{
	$('#modehead_div').css("display","none");
    $('#modebranch_div').css("display","block");
    $('#mod_br').css("display", "block");
    $('#mod_hd').css("display","none");
	}
	else
	{
   $('#modehead_div').css("display","block");
   $('#modebranch_div').css("display","none");
   $('#mod_br').css("display", "none");
   $('#mod_hd').css("display","block");
	}
        
        
$('#designation1').change(function(){
    
    
      $('#confirmcode1').prop('readonly', false); 
      $('#authcode1').prop('readonly', false);
           
        var  codeauth1=$(this).find('option:selected').attr('authcodeshow1'); 
        if(codeauth1=="N"){

           $('#authcode1').prop('readonly', true);
           $('#authcode1').val("");
        }
  
    var  codeauth3=$(this).find('option:selected').attr('authcodeshow3');
    
    if(codeauth3=="N"){
      
          $('#confirmcode1').prop('readonly', true);
     
          $('#authcode1').val("");
    }
  
  
    var optionSelected = $(this).find('option:selected').attr('title');
  
	$('#hidloginstatus1').val(optionSelected);
	$('#hidloginstatus22').val(optionSelected);

	if(optionSelected=="Yes")
	{
		
		$('#forloginonly1').css("display", "block");
                 $('#username1').val($('#firstname1').val());
	}else
	{        $('#username1').val('');
		$('#forloginonly1').css("display", "none");
	}
});


$('#modebranch').click(function() {
        if ($(this).is(':checked')) {
			var a=$(this).val();
		//	alert(a)
			if(a =="B")
	{
	$('#modehead_div').css("display","none");
    $('#modebranch_div').css("display","block");
    $('#mod_br').css("display", "block");
    $('#mod_hd').css("display","none");
	}
	else
	{
   $('#modehead_div').css("display","block");
   $('#modebranch_div').css("display","none");
   $('#mod_br').css("display", "none");
   $('#mod_hd').css("display","block");
	}
		//alert(a);
      // put your code here and your alert
   }
});

$('#modehead').click(function() {
        if ($(this).is(':checked')) {
			var a=$(this).val();
			//alert(a);
			if(a =="H")
			{
				$("#mod_br").css("display","none");
				$('#modebranch_div').css("display","none");
				$('#modehead_div').css("display","block");
				$('#mod_hd').css("display","block");
			}
			else
			{
				$('#mod_br').css("display","block");
				$('#modebranch_div').css("display","block");
				$('#modehead_div').css("display","none");
				$('#mod_hd').css("display","none");
			}
		//alert(a);
      // put your code here and your alert
   }
});





 });
</script>
<style>.navbar-inner{z-index: 999999 !important;}</style>
<div class="md-content" style="position:absolute;width:640px;left:0;margin-top: 8%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong> - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?> [<?=$_SESSION['staffid']?>]</span></div> 
 <a  onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster left JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid  left join tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid left join tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid  WHERE ser_staffid='".$_SESSION['staffid']."'"); 
	 //echo "select * from tbl_staffmaster left JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid left join tbl_city ON tbl_staffmaster.ser_city= tbl_city.cy_cityid left join tbl_country ON tbl_staffmaster.ser_country=tbl_country.cy_countyid left join tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid left join tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid left join tbl_state ON tbl_staffmaster.ser_state= tbl_state.se_stateid WHERE ser_staffid='".$_SESSION['staffid']."'"; 
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="staff_master.php"  method="post"  name="staff_masteredit" >
                           
                            <div class=" content hideContent" style="height:176px">
                           <input type="hidden" name="staffid" id="staffid" class="menuname" style="color:black" value="<?=$result_login['ser_staffid']?>">      
                           
                           
                         <table class="geogrph_table">
                              <tr class="first_form_contain">
                              <td><div class="form_name_cc">First Name<span style="color:#F00">*</span></div></td>
                              <td><div class="form_textbox_cc" id="staff_div1">
                                      <input
                                      <?php if($result_login['ser_staffid']==1){ ?> readonly <?php } 
                                      else if($result_login['ser_staffid']==2){ ?> readonly <?php } 
                                     else if($result_login['ser_staffid']==3){ ?> readonly <?php } 
                                     else if($result_login['ser_staffid']==4){ ?> readonly <?php } ?>
                                   type="text" class="form-control firstname" id="firstname1" name="firstname1" onkeyup="return set_username()" onchange="return set_username()" autofocus="autofocus" tabindex="1"  placeholder="First Name" tabindex="1"  data-toggle="tooltip" title="First Name" value="<?=$result_login['ser_firstname']?>" ></div></td>
                               
                                   <td style="display: none " ><div class="form_name_cc">Last Name</div> </td>
                              <td style="display: none "><div class="form_textbox_cc" id="lastname_div">
                                <input type="text" class="form-control lastname" id="lastname1" name="lastname1" tabindex="2"  placeholder="Last Name" tabindex="2"  data-toggle="tooltip" title="Last Name" value="<?=$result_login['ser_lastname']?>"></div>
                              </td>
                             
                               <td><div class="form_name_cc">Floor</div></td>
                                  <td><div class="form_textbox_cc"  > <div class="form-group" id="branch_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Select Floor" id="floorsel1" name="floorsel1" tabindex="8" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">All</option>
                                         <optgroup label="Floor">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['fr_floorid']?>" <?php if($result_kot['fr_floorid']==$result_login['ser_defaultfloor']) { ?> selected="selected" <?php } ?>><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                            </td>
                              
                              
                               </tr>
                               
                               
                               
                          <tr class="first_form_contain">
                          
                           <td><div class="form_name_cc">Gender<span style="color:#F00">*</span></div></td>
                               	<td> <div class="form_textbox_cc" id="gender_div1">
                                 <select data-placeholder="Gender" name="gender1"  id="gender1" data-rel="chosen" tabindex="3" title="Gender" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                      
                                         <optgroup label="Gender">
                                            <option value="Male"  <?php if($result_login['ser_gender']=="Male"){?> selected="selected"<?php } ?>>Male</option>
                                            <option value="Female"<?php if($result_login['ser_gender']=="Female"){?> selected="selected"<?php } ?>>Female</option>
                                         </optgroup>
                                    	 </select></div></td>  
                                         
                                 <td>  	<div class="form_name_cc">
                                   Department <span style="color:#F00">*</span></div></td>
                                <td>  <div class="form_textbox_cc"  > <div class="form-group" id="department_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_departmentmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Department Name" id="department1" name="department1" tabindex="4" data-rel="chosen" title="Department Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="DEPARTMENT">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                      <option value="<?=$result_kot['der_departmentid']?>" <?php if($result_kot['der_departmentid']==$result_login['ser_department']) { ?> selected="selected" <?php } ?>><?=$result_kot['der_departmentname']?>  </option>
                                           
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc--></td>
                                        
                                        </tr>
                                        
                                        <tr class="first_form_contain">
                                        
                                 <td>     	<div class="form_name_cc">
                                       Designation <span style="color:#F00">*</span></div></td>
                      <td>            <div class="form_textbox_cc"  > <div class="form-group" id="designation_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_designationmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Designation" id="designation1" name="designation1" tabindex="5" data-rel="chosen" title="Designation" left"." data-toggle="tooltip" class="form-control add_new_dropdown" onChange="check_desg()">
                                        <option value=""></option>
                                         <optgroup label="Designation">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                        <option value="<?=$result_kot['dr_designationid']?>"  title="<?=$result_kot['dr_login']?>"        <?php if($result_kot['dr_designationid']==$result_login['ser_designation']) { ?> selected="selected" <?php } ?>authcodeshow1="<?=$result_kot['dr_authorisation_code']?>" authcodeshow3="<?=$result_kot['dr_takeorder']?>"><?=$result_kot['dr_designationname']?>  </option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         <?php 
										 $drlogin='';
										 $sql_kot1  =  $database->mysqlQuery("select * from tbl_designationmaster where dr_designationid='".$result_login['ser_designation']."'"); 
										  $num_kot1   = $database->mysqlNumRows($sql_kot1);
										  if($num_kot1)
										  {
											  while($result_kot1  = $database->mysqlFetchArray($sql_kot1)) 
										{ 
										$drlogin=$result_kot1['dr_login'];
										}}?>
                                         
                                         <input type="hidden" name="hidloginstatus1" id="hidloginstatus1" value="<?=$drlogin?>">
                                          <input type="hidden" name="hidloginstatus12" id="hidloginstatus22" value="<?=$drlogin?>">
                                         
                                         </div>
                                   	    </div><!--form_textbox_cc-->  </td>
                                        <td>   	<div class="form_name_cc">Employee Status <span style="color:#F00">*</span></div></td>
                               	 <td><div class="form_textbox_cc" id="employeestatus_div1">
                                  <select data-placeholder="Employee status" name="employeestatus1"  id="employeestatus1" tabindex="6" data-rel="chosen" title="Employeestatus" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                       
                                         <optgroup label="Employee Status">
                                            <option value="Active" <?php if($result_login['ser_employeestatus']=="Active"){?> selected="selected"<?php } ?>>Active</option>
                                            <option value="Terminated" <?php if($result_login['ser_employeestatus']=="Terminated"){?> selected="selected"<?php } ?>>Terminated</option>
                                            <option value="Suspended" <?php if($result_login['ser_employeestatus']=="Suspended"){?> selected="selected"<?php } ?>>Suspended</option>
                                            <option value="Inactive" <?php if($result_login['ser_employeestatus']=="Inactive"){?> selected="selected"<?php } ?>>Inactive</option>
                                         </optgroup>
                                    	 </select></div>    
                                        </td>
                               </tr> 
                               
                               
                               
                                
                              <tr class="first_form_contain">
                                   <td style="display:none"  ><div class="form_name_cc" id="mod_br" style="display:none">Branch<span style="color:#F00">*</span></div>
                                 <div class="form_name_cc" id="mod_hd" style="display:none">Head Office<span style="color:#F00">*</span></div></td>
                                  <td style="display:none"  ><div class="form_textbox_cc" id="modebranch_div" style="display:none"  > <div class="form-group" id="branchs_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Branch" id="branchname" name="branchname" data-rel="chosen" tabindex="7" title="Branch" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                       <!-- <option value=""></option>-->
                                         <optgroup label="Branch">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  <?php if($result_kot['be_branchid']==$result_login['ser_branchofficeid']) { ?> selected="selected" disabled="disabled"<?php } ?>     ><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                        
                                        
                                        <div class="form_textbox_cc" id="modehead_div" style="display:none"  > <div class="form-group" id="head_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_headoffice"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter headoffice" id="headofficename" name="headofficename" tabindex="8" data-rel="chosen" title="Headoffice" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                       <!-- <option value=""></option>-->
                                         <optgroup label="Headoffice">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['he_officeid']?>" <?php if($result_kot['he_officeid']==$result_login['ser_headofficeid']) { ?> selected="selected" disabled="disabled" <?php } ?>><?=$result_kot['he_officename']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                        
                                        
                                        
                                        
                                        
                            </td> 
                            
                             <td style="display: none "><div class="form_name_cc">Mobile</div></td>
                              <td style="display: none "><div class="form_textbox_cc" id="mobile_div1">
                                      <input type="text" class="form-control mobileno" id="mobileno1" name="mobileno1" tabindex="9"  placeholder="Mobile No" tabindex="0"  data-toggle="tooltip" title="Mobile No" value="<?=$result_login['ser_mobileno']?>" onchange="validate_mobile1()"></div>
                              </td>
                            
                            
                            
                            <td style="display:none"><div class="form_name_cc">Email</div></td>
                              <td style="display:none"><div class="form_textbox_cc" id="email_div">
                                <input type="text" class="form-control email" id="email1" name="email1"  placeholder="Email" tabindex="7"  data-toggle="tooltip" title="Email" value="<?=$result_login['ser_email']?>" onChange="emailvalidation(this.value);"></div>
                              </td>
                              
                              
                           
                            
                            
                              <td><div class="form_name_cc">Inventory Store</div></td>
                                  <td><div class="form_textbox_cc"  > <div class="form-group" id="branch_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Select Floor" id="store_sel1" name="store_sel1" tabindex="8" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Store</option>
                                         
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ti_id']?>" <?php if($result_kot['ti_id']==$result_login['ser_store_inv']) { ?> selected="selected" <?php } ?>><?=$result_kot['ti_name']?></option>
                                    <?php } ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                            </td>
                            
                            
                               </tr>
                               
                               
                                <tr class="first_form_contain">
                                
                                
                            	<td style="display:none"><div class="form_name_cc">Branch<span style="color:#F00">*</span> </div></td>
                                  <td style="display:none"><div class="form_textbox_cc"  > <div class="form-group" id="branch_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Branch" id="branch1" name="branch1" tabindex="22" data-rel="chosen" title="Branch" left"." data-toggle="tooltip" class="form-control add_new_dropdown" disabled="disabled">
                                       <option value=""></option>
                                         <optgroup label="Branch">
                                   
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                      <option value="<?=$result_kot['be_branchid']?>" <?php if($result_kot['be_branchid']==$result_login['ser_branchofficeid']) { ?> selected="selected" disabled="disabled" <?php } ?>><?=$result_kot['be_branchname']?>  </option>
                                             </optgroup>
                                   
                                    <?php } ?> 
                                     
                                    	 </select>
                                         <?php } ?>
                                         
                                         </div>
                                   	    </div>
                            </td>
                            
                            
                            
                          
                            
                            
                                 
                              
                            
                                      <td style="display: none "><div class="form_name_cc">Salary</div></td>
                              <td style="display: none "><div class="form_textbox_cc" id="salary_div1">
                                      <input type="text" class="form-control salary1" id="salary1" name="salary1" tabindex="10"  placeholder=" " tabindex="0"  data-toggle="tooltip" title=" No" value="<?=$result_login['ser_salary']?>" onchange="()" onkeypress="return numdot(event);" ></div></td> 
                                      
                                    <td style="display: none "> 	<div class="form_name_cc">ID No</div></td>
                                
                               <td style="display: none ">	 <div class="form_textbox_cc" id="menumaincategory_div">
                                <input type="text" class="form-control idno" id="idno1" name="idno1"  placeholder="ID No" tabindex="17"  data-toggle="tooltip" title="ID No"  value="<?=$result_login['ser_idno']?>" ></div></td>
                                
                                      
                               </tr>
                               
                               <tr>
                                     <td><div class="form_name_cc">Mode</div></td>
                                 <td>
                                 
                                 	<div class="branch_floor_select_cc">
                                    	<div class="floor_checkbox_cc">
                                   

                                        	
                                            <div class="check_box_cc">
                                               <input type="hidden" name="hidemode" id="hidemode" value="<?=$result_login['ser_mode']?>">
                                            <?php if($result_login['ser_mode']=="B"){?> 
                                          <div style="width:auto;" class="floor_checkbox_name stafff_branch_view_add">Branch</div>  <?php } else{?>
                                          
                                          <div  style="width:auto;margin-left: 13px;" class="floor_checkbox_name stafff_branch_view_add">Head Office</div> <?php }?> 
                                        </div>
                                        
                                          <!-- <div  style="text-align:right" class="floor_checkbox_name">Head Office</div>-->
                                       <!-- <div class="floor_checkbox_cc">
                                        	<div class="floor_checkbox_name">Haedoffice</div>
                                            <div class="check_box_cc"><input type="radio"  name="headchk" id="headchk" value="h"></div>
                                        </div>-->
                                    
                                    </div><!---branch_floor_select_cc--->
                                    </div>
                                 
                                 </td>
                               </tr>
                               
                               
                                
                              <tr class="first_form_contain">
                              
                              
                               <td><div class="form_name_cc">Alt No</div></td>
                              <td><div class="form_textbox_cc" id="alternate_div">
                                <input type="text" class="form-control alternateno" id="alternateno1" name="alternateno1" tabindex="11"  placeholder="Alternate No" tabindex="0"  data-toggle="tooltip" title="Alternate No" value="<?=$result_login['ser_alternateno']?>" ></div></td>
                                 
                              
                               <td><div class="form_name_cc">Remarks</div></td>
                              <td><div class="form_textbox_cc" id="remarks_div">
                                <input type="text" class="form-control remarks" id="remarks1" name="remarks1"  placeholder="Remarks" tabindex="12"  data-toggle="tooltip" title="Remarks" value="<?=$result_login['ser_remarks']?>" ></div></td> 
                              </tr>
                              
                              <tr class="first_form_contain">
                              
                              
                                     <td><div class="form_name_cc">DOB</div></td>       
                                  <td> 	 <div class="form_textbox_cc" id="dob_div1">
                                <input type="text" class="form-control dateofbirth" id="dob1" name="dob1"  placeholder="Date Of Birth" tabindex="13"  data-toggle="tooltip" title="Date Of Birth" value="<?=$result_login['ser_dob']?>" ></div></td>     
                              <td>  <div class="form_name_cc">Join </div></td>
                               	 <td><div class="form_textbox_cc" id="doj_div1">
                                <input type="text" class="form-control dateofjoin" id="dateofjoin1" name="dateofjoin1"  placeholder="Date Of Join" tabindex="14"  data-toggle="tooltip" title="Date Of Join" value="<?=$result_login['ser_dateofjoin']?>" ></div> </td>
                                
                              </tr>
                              
                                <td><div class="form_name_cc">Address1 </div></td>       
                                  <td> 	 <div class="form_textbox_cc" id="address11_div1">
                                <input type="text" class="form-control address11" id="address11" name="address11"  placeholder="Address1" tabindex="15"  data-toggle="tooltip" title="Address1" value="<?=$result_login['ser_address1']?>" ></div></td>  
                                 
                              <td><div class="form_name_cc">Address2</div></td>
                              <td><div class="form_textbox_cc" id="address22_div1">
                                <input type="text" class="form-control address22" id="address22" name="address22"  placeholder="Address2" tabindex="16"  data-toggle="tooltip" title="Address2" value="<?=$result_login['ser_address2']?>"></div></td>
                                
                                
                               </tr>  
                               <tr class="first_form_contain">
                                
                             <td> 	<div class="form_name_cc">ID No</div></td>
                                
                               <td>	 <div class="form_textbox_cc" id="menumaincategory_div">
                                <input type="text" class="form-control idno" id="idno1" name="idno1"  placeholder="ID No" tabindex="17"  data-toggle="tooltip" title="ID No"  value="<?=$result_login['ser_idno']?>" ></div></td>
                             
                            <td><div class="form_name_cc">ID Type</div></td>
                               <td>	 <div class="form_textbox_cc" id="menumaincategory_div">
                                <input type="text" class="form-control idtype" id="idtype1" name="idtype1"  placeholder="ID Type" tabindex="18"  data-toggle="tooltip" title="ID Type" value="<?=$result_login['ser_idtype']?>" ></div></td>
                                
                                   </tr>  
                                   
                                <tr>        
                                   
                                
                                
                                
                               </tr>  
                               <tr class="first_form_contain">
                                
                            
                              </tr>
                              
                               
                             
                            
                            
                             <tr>
                               

                               
                               </tr>
                            
                              
                                </table>  
                                </div>
                                
                               <div class="show-more" style="display:none">
                                    <a style="color:#0087f3;float: right;margin-right:5px;font-size:15px;" href="#">Show more</a>
                                </div>

                                <div <?php if ($result_login['dr_login']=='No'){ ?>style="display:none" <?php } else { ?> style="display:block" <?php } ?> id="forloginonly1">
                     <strong class="staff_add_pop_sec_head" style="color:#000;">Login Details</strong>
                 <?php      
				 $sql  =  $database->mysqlQuery("select * FROM tbl_logindetails WHERE ls_staffid='".$_SESSION['staffid']."'"); 
	  $num  = $database->mysqlNumRows($sql);
	
	  if($num){
		  while($result_user  = $database->mysqlFetchArray($sql)) 
			{
	 ?>
                     <table class="geogrph_table">
                     <tr class="first_form_contain">
                     <input type="hidden" id="user12" name="user12" value="ys" />
                            <td> <div class="form_name_cc">User Name</div></td>
                             <td>  	 <div class="form_textbox_cc" id="username_div1">
                                <input type="text" class="form-control username12" id="username1" name="username1"  placeholder="User Name" tabindex="19"  data-toggle="tooltip" title="User Name" value="<?=$result_user['ls_username']?>" readonly="readonly" ></div></td>

                               
                            
                             <td>  	 <div class="form_textbox_cc" id="username_div12">
                                <input type="text" class="form-control username12" id="username12" name="username12"  placeholder="User Name" tabindex="19"  data-toggle="tooltip" title="User Name"  value="<?=$result_user['ls_username']?>"   style="display:none"></div></td>
                              
                                 
                                 <td><div class="form_name_cc">Auth.code</div></td>
                              <td><div class="form_textbox_cc confirm_code_staff_n" id="authcode1_div">
                                      <input type="password" class="form-control email" id="authcode1" name="authcode1"   placeholder="Authorisation code"  onkeypress="return numonly1();"  tabindex="20" maxlength="4" data-toggle="tooltip" title="Authorisation code" onchange="validate_authcode1()" value="<?=$result_login['ser_authorisation_code']?>"  <?=$result_login['dr_authorisation_code']=='N' ? 'readonly':''?>  >
                                  </div>
                                 <div  class="confirm_code_staff_eye"><a href="#" onmouseup="mouseoverPass3();"  onmousedown="mouseoutPass3();"><i class="fa fa-eye"></i></a></div> 
                              </td>	
                         
<!--                               	<td> <div class="form_textbox_cc" id="password_div12">
                                <input type="password" class="form-control password12" id="password12" name="password12"  placeholder="Password" tabindex="31"  data-toggle="tooltip" title="Password" value="<?=$result_user['ls_password']?>" style="display:none" ></div></td>
                            
                               	 <td><div class="form_textbox_cc" id="confpassword_div12">
									<input type="password" class="form-control confirmpassword12" id="confirmpassword12" name="confirmpassword12"  placeholder="Confirm Password" tabindex="32"  data-toggle="tooltip" title="Confirm Password" value="<?=$result_user['ls_password']?>" style="display:none" >  
                               </div></td>-->
                               

                                  <td> 	</td>
                               
                               
                               
                               
                               
                               </tr>  
                              <!-- <tr style="height:auto !important" class="first_form_contain">
                               </tr>-->
                               </table>
                                 <?php }}
								 else
								 {?>
								  <table class="geogrph_table">
                     <tr class="first_form_contain">
                  
                  <input type="hidden" id="user12" name="user12" value="noe" />
                            <td > <div class="form_name_cc">User Name</div></td>
                             <td width="21%">  	 <div class="form_textbox_cc" id="username_div12">
                                <input type="text" class="form-control username12" id="username12" name="username12"  placeholder="User Name" tabindex="19"  data-toggle="tooltip" title="User Name" ></div></td>
                              
                              	
                                

                                 <td><div class="form_name_cc">Auth.code</div></td>
                              <td><div class="form_textbox_cc confirm_code_staff_n" id="authcode1_div">
                                      <input type="password" class="form-control email" id="authcode1" name="authcode1"   placeholder="Authorisation code"  onkeypress="return numonly1();"  tabindex="20" maxlength="4" data-toggle="tooltip" title="Authorisation code" onchange="validate_authcode1()" value="<?=$result_login['ser_authorisation_code']?>"  <?=$result_login['dr_authorisation_code']=='N' ? 'readonly':''?> autocomplete="off" >
                                  </div>
                                 <div  class="confirm_code_staff_eye"><a href="#" onmouseup="mouseoverPass3();"  onmousedown="mouseoutPass3();"><i class="fa fa-eye"></i></a></div> 
                              </td>
                              
                              
                              </tr>

<!--                               <tr class="first_form_contain">
                            
                             	<td><div class="form_name_cc">AppLogin</div>
                                 <div class="form_textbox_cc" id="menumaincategory_div12">
                                 	<div class="checkbox">
                    <label>
                        <input type="checkbox" value="1"  name="chkapplogin12"  id="chkapplogin12" data-toggle="tooltip" title="AppLogin" tabindex="37">
                    </label>
                </div>              
                               </div>
                                </td>
                                
                               <td>	</td>
                               <td><div class="form_name_cc">Cancel With key </div>
                                <div class="form_textbox_cc" >
                                <input type="checkbox" value="Y"  name="cancelwithkey1"  id="cancelwithkey1" data-toggle="tooltip" title="active"  checked tabindex="38"></div>
                               </td>       
                                  <td> 	</td>
                               
                               </tr>-->
                               </table>
							<?php	 }
								   ?>
                                  </div>
                           <a  href="#" class="entersubmit"  onClick="update_registration() " tabindex="39"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script>


   function update_registration()
	{
	 if(validate_firstname1())
		{
			
			if(validate_gender1())
			{
					
					  
			
			if(validate_department1())
			{
										
			if(validate_designation1())
			{
												
			if(validate_employeestatus1())
			{
												
													
			if($('#email1').val()!="")
			{ 
																			
			if(emailvalidation($('#email1').val()))
			{	
																				
			}
			}
			
			if($("#hidloginstatus22").val() =="Yes")
	                {
                            
			if(validate_username12())																		
			{
                          if(validate_authcode1())																		
			{  

			  document.staff_masteredit.submit();
						
                        }
			}
			}else
			{
                            
                         document.staff_masteredit.submit();
                         
			}
													
			}
												  
		                }
				}
				}
				}
   }

function validate_firstname1()   
			{
				
				if($("#firstname1").val()=="")
				{
					$("#staff_div1").addClass("has-error");
						  document.staff_masteredit.firstname1.focus();
                                                 // alert("Enter First Name.");
                                                 $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Enter First Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#firstname1").val())){
                              $("#staff_div1").addClass("has-error");
                             document.staff_masteredit.firstname1.focus();
                          //alert("Special charecter Not Allowed.");
                          $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('No Special Characters');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                           }   
                               else
					 {
						 var a=document.getElementById("firstname1").value;
						$("#staff_div1").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
	function validate_state1()   
			{
				if($("#state1").val()=="" || $("#state1").val()==null )
				{
					$("#state_div1").addClass("has-error");
						  document.staff_masteredit.state1.focus();
                                                  alert("Select State.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#state1").val())){
                                   $("#state_div1").addClass("has-error");
                                  document.staff_masteredit.state1.focus();
                         alert("Special charecter Not Allowed.");
                           } 
                                else
					 {
						$("#state_div1").removeClass("has-error");
							$("#state_div1").addClass("has-success");
							 return true;
					 }
			}
	function validate_gender1()   
			{
				if($("#gender1").val()=="")
				{
					$("#gender_div1").addClass("has-error");
						  document.staff_masteredit.gender1.focus();
                                                  alert("Select Gender.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#gender1").val())){
                                   $("#gender_div1").addClass("has-error");
                                 document.staff_masteredit.gender1.focus();
                          alert("Special charecter Not Allowed.");
                           } 
                                   else
					 {
						 var a=document.getElementById("gender1").value;
						 $("#gender_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_country1()   
			{
				if($("#country1").val()=="")
				{
					$("#country_div1").addClass("has-error");
						  document.staff_masteredit.country1.focus();
                                                  alert("Select Country.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#country1").val())){
                                   $("#country_div1").addClass("has-error");
                                   document.staff_masteredit.country1.focus();
                                alert("Special charecter Not Allowed.");
                           } 
                                else
					 {
						 var a=document.getElementById("country1").value;
						 $("#country_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
		function validate_city1()   
			{
				if($("#city1").val()=="")
				{
					$("#city_div1").addClass("has-error");
						  document.staff_masteredit.city1.focus();
                                                   alert("Select City.");
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#city1").val())){
                                   $("#city_div1").addClass("has-error");
                                   document.staff_masteredit.city1.focus();
                                alert("Special charecter Not Allowed.");
                           } 
                                   else
					 {
						 var a=document.getElementById("city1").value;
						 $("#city_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}		
			
			function validate_mobile1()   
			{
//				if($("#mobileno1").val()=="")
//				{
//					$("#mobile_div1").addClass("has-error");
//						  document.staff_masteredit.mobileno1.focus();
//						  return false;
//				}
                                   var alphanumers = /^[0-9 ]+$/;
                                   if(!alphanumers.test($("#mobileno1").val())){
                                   $("#mobile_div1").addClass("has-error");
                                   document.staff_masteredit.mobileno1.focus();
                                // alert("Special charecter Not Allowed.");
                                alert("Enter Valid Numbers.");
                               
                                      } 
        
                                       else
					 {
						 
						if (IsNumeric($("#mobileno1").val()))
						{
						 var a=document.getElementById("mobileno").value;
						 $("#mobile_div1").removeClass("has-error");
					     $('#mobile_div1').addClass("has-success");
						 return true;
						}
						else
						{
							$("#mobile_div1").addClass("has-error");
						     document.staff_masteredit.mobileno1.focus();
							alert('Please enter a valid mobile no')
							return false;
						}
						// var a=document.getElementById("mobileno1").value;
//						 $("mobile_div1").removeClass("has-error");
//					     $(this).addClass("has-success");
//						 return true;
					 }
                                         
    }     
                   
	   function validate_confirmcode1()   
	{
                                        $("#confirmcode_div").removeClass("has-error");
                                         var cnfcode2=$("#confirmcode1").val();			
                                       var alphanumers = /^[0-9]+$/;
                                       if(cnfcode2 != ''){
                                                 if(!alphanumers.test(cnfcode2) || cnfcode2.length<4){
                                                      alert("Enter Valid 4  Digit Number");
                                                      $("#confirmcode_div").addClass("has-error");
                                                       $("#confirmcode_div").focus();
                                                 }
                                                 else
	                      {
		 var a1=document.getElementById("confirmcode1").value;
					 
	                               $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkpin&mid="+a1,
			success: function(data)
			{
			data=$.trim(data);
	
			if(data =="yes")
			{
                                                                                           alert("confirm code already exists !");
                                                                                           $("#confirmcode_div").addClass("has-error");
                                                       $("#confirmcode_div").focus();   
                                                           return  false;
                                                                      }
                                                       }

                                    });
                             }
                                       }

                                 }
        
           function validate_authcode1()   
	  {
                                       $("#authcode1_div").removeClass("has-error");
                                       var cnfcode3=$("#authcode1").val();			
                                       var alphanumers = /^[0-9]+$/;
                                       if(cnfcode3 != ''){
                                           
                                          
                                                 if(!alphanumers.test(cnfcode3) || cnfcode3.length<4){
                                                     
                                                      $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Enter Valid 4 Digit Authorisation Code ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                                     // alert("Enter Valid 4 Digit Number");
                                                      $("#authcode1_div").addClass("has-error");
                                                      $("#authcode1_div").focus();
                                                     
                                                     
                        }
                        else
	                {
                            
		        var a2=document.getElementById("authcode1").value;
                        
                         var stf=document.getElementById("staffid").value;
					 
	                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkpin2&mid="+a2+"&stf="+stf,
			success: function(data)
			{
			data=$.trim(data);
	
			if(data =="yes")
			{      
                            
                        $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Authorisation code already exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                                    //  alert("Authorisation code already exist");
                                                       $("#authcode1_div").addClass("has-error");
                                                       $("#authcode1_div").focus();   
                                                       return  true;
                        }else{
                            
                            document.staff_masteredit.submit();
                        }
                       }

                       });
                             }
                             }else{
                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Authorisation code invalid');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                                     //   alert("Enter Authorisation Code");
                                                       $("#authcode1_div").addClass("has-error");
                                                       $("#authcode1_div").focus();   
                                                       return  false;
                             }

                             }
        
		function validate_dob1()   
			{
				if($("#dob1").val()=="")
				{
					          $("#dob_div1").addClass("has-error");
						  document.staff_masteredit.dob1.focus();
                                                  alert("Enter Date of Birth.");
						  return false;
				}
                                
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#dob1").val())){
                                   $("#dob_div1").addClass("has-error");
                                   document.staff_masteredit.dob1.focus();
                                      alert("Special charecter Not Allowed.");
                                      }
                                    else
					 {
						 var a=document.getElementById("dob1").value;
						 $("dob_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}		
			function validate_doj1()   
			{
				if($("#dateofjoin1").val()=="")
				{
					$("#doj_div1").addClass("has-error");
						  document.staff_masteredit.dateofjoin1.focus();
                                                  alert("Enter Date of Join.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#dateofjoin1").val())){
                                   $("#doj_div1").addClass("has-error");
                                   document.staff_masteredit.dateofjoin1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                else
					 {
						 var a=document.getElementById("dateofjoin1").value;
						 $("doj_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}		
			
			function validate_nationality1()   
			{
				if($("#nationality1").val()=="")
				{
					$("#nationality_div1").addClass("has-error");
						  document.staff_masteredit.nationality1.focus();
                                                  alert("Select Nationality.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#nationality1").val())){
                                   $("#nationality_div1").addClass("has-error");
                                   document.staff_masteredit.nationality1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                               else
					 {
						 var a=document.getElementById("nationality1").value;
						 $("nationality_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
			function validate_address1()   
			{
				if($("#address11").val()=="")
				{
					$("#address11_div1").addClass("has-error");
						  document.staff_masteredit.address11.focus();
                                                   alert("Enter Address1.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#address11").val())){
                                   $("#address11_div1").addClass("has-error");
                                   document.staff_masteredit.address11.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                   else
					 {
						 var a=document.getElementById("address11").value;
						 $("address11_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	

				function validate_department1()   
			{
				if($("#department1").val()=="")
				{
					$("#department_div1").addClass("has-error");
						  document.staff_masteredit.department1.focus();
                                                  //alert("Select Department.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Department');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#department1").val())){
                                   $("#department_div1").addClass("has-error");
                                   document.staff_masteredit.department1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                 else
					 {
						 var a=document.getElementById("department1").value;
						 $("department_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
		function validate_designation1()   
			{
				if($("#designation1").val()=="")
				{
					$("#designation_div1").addClass("has-error");
						  document.staff_masteredit.designation1.focus();
                                                  //alert("Select Designation.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Designation');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#designation1").val())){
                                   $("#designation_div1").addClass("has-error");
                                   document.staff_masteredit.designation1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                 else
					 {
						 var a=document.getElementById("designation1").value;
						 $("designation_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
			function validate_employeestatus1()   
			{
				if($("#employeestatus1").val()=="")
				{
					$("#employeestatus_div1").addClass("has-error");
						  document.staff_masteredit.employeestatus1.focus();
                                                  // alert("Select Employeestatus.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Employee Status');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#employeestatus1").val())){
                                   $("#employeestatus_div1").addClass("has-error");
                                   document.staff_masteredit.employeestatus1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                else
					 {
						 var a=document.getElementById("employeestatus1").value;
						 $("employeestatus_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
			function validate_branch1()   
			{
				if($("#branch1").val()=="")
				{
					$("#branch_div1").addClass("has-error");
						  document.staff_masteredit.branch1.focus();
                                                  alert("Select branch.");
						  return false;
				}
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#branch1").val())){
                                   $("#branch_div1").addClass("has-error");
                                   document.staff_masteredit.branch1.focus();
                                 alert("Special charecter Not Allowed.");
                                      }
                                 else
					 {
						 var a=document.getElementById("branch1").value;
						 $("branch_div1").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}	
function viewstate(val)
{
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadcity&stateid="+val,
		  success: function(msg)
		  {
			  $('#city1').html(msg);
		  }
	  }); 
} 
function viewcountry(val)
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
function IsNumeric(strString)
{
  var strValidChars = "0123456789-+(). ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 var a= strString.length;
 
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }

  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}
function emailvalidation(entered) {
    var email = entered;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(entered)) 
	{
    $("#email_div1").addClass("has-error");
	document.staff_masteredit.email1.focus();
	return false;
 	}else
	{
		 $("#email_div1").removeClass("has-error");
		 return true;
	}
}	
function set_username(){
  var login_permission =  $('#designation1').find('option:selected').attr('title');
  if(login_permission=="Yes")
	{
            $('#username1').val($('#firstname1').val());
	}
}

function validate_username12()   
			{
				if($(".username12").val()=="")
				{
					$("#username_div12").addClass("has-error");
						  document.staff_masteredit.username12.focus();
                                                  alert("Enter Username.");
						  return false;
				}else
					 {
						 var a=document.getElementById("username12").value;
						 $("#username_div12").removeClass("has-error");
						  $("#username_div1").removeClass("has-error");
						   $("#username_div1").addClass("success");
					     $("#username_div12").addClass("has-success");
						 return true;
					 }
			
			}	
			function validate_password12()   
			{
				
				if($(".password12").val()=="")
				{
					$("#password_div12").addClass("has-error");
						  document.staff_masteredit.password12.focus();
                                                   alert("Enter Password.");
						  return false;
				}else
					 {
						 var a=document.getElementById("password12").value;
						 $("#password_div12").removeClass("has-error");
					     $(this).addClass("has-success");
						 
						 return true;
					 }
			}	
			function validate_confirmpassword12()   
			{
				if($(".confirmpassword12").val()=="")
				{
					$("#confpassword_div12").addClass("has-error");
						  document.staff_masteredit.confirmpassword12.focus();
                                                  alert("Enter Confirm Password.");
						  return false;
				}else
					 {
						 var a=document.getElementById("confirmpassword12").value;
						 if(checkn_change('confpassword_div12','confirmpassword12'))
						 {
						 $("#confpassword_div12").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
						 }
						 else
						 {
//					$("#confpassword_div12").addClass("has-error");
//						  document.staff_masteredit.confirmpassword12.focus();
                                             alert("Password not Matching.");
						  return false;
						 }
					 }
			
			}	
			
	function checkn_change(divid,controlid)
{
	if(document.getElementById(controlid).value=="")
	{
		$("#"+divid).addClass("has-error");
		$("#"+divid).removeClass("has-success");
	}else
	{
	$("#"+divid).removeClass("has-error");
	$("#"+divid).addClass("has-success");
	}
	if(divid=='confpassword_div12')
	{
		if(document.getElementById("password12").value!="")
		  {
			  if(document.getElementById("password12").value!=document.getElementById("confirmpassword12").value)
			  {
				   $("#confpassword_div12").addClass("has-error");
				  $("#confpassword_div12").addClass("has-feedback");
				/*  $("#sp_confp").css("display", "block");
				  $("#sp_confp").removeClass("glyphicon-ok");
				  $("#sp_confp").addClass("glyphicon-remove")*/;
			  		document.staff_masteredit.confirmpassword12.focus();
			  		return false;
			  }else
			  {
				  $("#confpassword_div12").removeClass("has-error");
				  $("#confpassword_div12").addClass("has-success");
				  $("#confpassword_div12").addClass("has-feedback");
//				  $("#sp_confp").css("display", "block");
//				  $("#sp_confp").removeClass("glyphicon-remove");
//				  $("#sp_confp").addClass("glyphicon-ok");
				  $("#password_div12").addClass("has-success");
				  $("#password_div12").addClass("has-feedback");
				 // $("#sp_pas").css("display", "block");
//				  $("#sp_pas").removeClass("glyphicon-remove");
//				  $("#sp_pas").addClass("glyphicon-ok");
			  		return true;
			  }
			  
		  }else
		  {
			  $("#password_div12").addClass("has-error");
			  document.staff_masteredit.password12.focus();
			  return false;
		  }
	}
	
}			
			
			
			
</script>

<script type="text/javascript">
$(".show-more a").on("click", function() {
    var $this = $(this); 
    var $content = $this.parent().prev("div.content");
    var linkText = $this.text().toUpperCase();    
    
    if(linkText === "SHOW MORE"){
        linkText = "Show less";
        $content.switchClass("hideContent", "showContent", 400);
    } else {
        linkText = "Show more";
        $content.switchClass("showContent", "hideContent", 400);
    };

    $this.text(linkText);
});

//eyeclick//
function mouseoverPass2(obj) {
  var obj = document.getElementById('confirmcode1');
  obj.type = "password";

}
function mouseoutPass2(obj) {
  var obj = document.getElementById('confirmcode1');
  obj.type = "text";
   
}

function mouseoverPass3(obj) {
  var obj = document.getElementById('authcode1');
  obj.type = "password";

}
function mouseoutPass3(obj) {
  var obj = document.getElementById('authcode1');
  obj.type = "text";
   
}
//numbereonly//
function numonly1(evt)
{
evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
   
        return false;
      
    }
    return true;
}




</script>