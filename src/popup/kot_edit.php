<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['kotid']=$_REQUEST['kot'];
$sql_login  =  $database->mysqlQuery("select kr_kotname from tbl_kotcountermaster where kr_kotcode='".$_SESSION['kotid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['kr_kotname'];
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
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_kotcountermaster INNER JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid and kr_kotcode='".$_SESSION['kotid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="kot_counter_master.php"  method="post"  name="kot_masteredit">
                           <input type="hidden" name="kotid" id="kotid" class="menuname" style="color:black" value="<?=$result_login['kr_kotcode']?>">       
                        	 <div class="first_form_contain">
                                <span id="koteditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">KOT<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="kot_div1">
                              <input type="text" class="form-control kotnames" id="kot1" name="kot1"  placeholder="KOT" tabindex="0"  data-toggle="tooltip" title="KOT" value="<?=$result_login['kr_kotname']?>" ></div>
                               </div>
                           <div style="display:none" class="first_form_contain">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="branch_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Branch Name" id="branch1" name="branch1" data-rel="chosen" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="BRANCH">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  id="<?=$result_kot['be_branchid']?>" <?php if($result_kot['be_branchid']==$result_login['kr_branchid']) { ?> selected="selected" <?php } ?>><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                              <!--first_form_contain-->
                                           <input type="hidden" name="kotid" id="kotid" class="menuname" style="color:black" value="<?=$result_login['kr_kotcode']?>">        
                             
                                           <a  href="#" class="entersubmit"  onClick="update_registration()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script>
	$("#kot1").focus();

	
    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $('.md-close_pop').click();
    });

 $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });



function validate_kotall()
			{
				//alert('a');
				var kotidchk=$("#kotid").val();
			//	alert(flooridchk);
				 var ab=$(".kotnames").val().trim();
				
			//	 alert(flr);
				
				// var b=document.getElementById("floorname").value;
				 var br=$("#branch1").find('option:selected').attr('id');
				//alert(br);
				//document.getElementById("branchofficename").value;
				
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkotedit&kotname="+ab+"&kotidchk="+kotidchk+"&brn="+br,
			success: function(data)
			{
			data=$.trim(data);
	//alert(data);
			var namechk=$('#koteditchk');
			if(data =="sorry")
			{
		// namechk.text('Already exists');
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		   $("#kot_div1").addClass("has-error");
	  $("#kot1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#kot_div1").removeClass("has-error");
	   $("#kot_div1").addClass("has-success");
	  // return true;
document.kot_masteredit.submit();
			}
			}
		});
			
			}

function valikot1(id)
{
	 $('#koteditchk').text('');
			var id1=id;
		
	        var ab=$(".kotnames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkotedit&kotname="+ab+"&kotidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
		
			var catchk=$('#koteditchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 //catchk.text('Already exists');
		   $("#kot_div1").addClass("has-error");
	  $("#kot1").focus();
//return false;
			}
			else
			{
		catchk.text('');
		 $("#kot_div1").removeClass("has-error");
	   $("#kot_div1").addClass("has-success");
	 // return true;
			}
			}
		});
			}
}


   function update_registration()
	{
	 if(validate_kotcounter())
		{
			
				if(validate_kotall())
				{
    /*	document.kot_masteredit.submit();*/
				}
			
		}
	}
	function validate_kotcounter()   
	{
		var id=$("#kotid").val();
		if($("#kot1").val()=="")
		{
		 $("#kot_div1").addClass("has-error");
		 document.kot_masteredit.kot1.focus();
                // alert("Enter KOT");
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Kot Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 return false;
		}
                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#kot1").val())){
                          $("#kot_div1").addClass("has-error");
                           document.kot_masteredit.kot1.focus();
                 // alert("Special charecter Not Allowed.");
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }  
        
               else
		 {
		 $("#kot_div1").removeClass("has-error");
		 $("#kot_div1").addClass("has-success");
		 return true;
		 }
             }
        
	
                             
			function validate_printersettings()   
	{
		if($("#printer1").val()=="")
		{
		 $("#printer_div1").addClass("has-error");
		 document.kot_masteredit.printer1.focus();
		 return false;
		}else
		 {
		 $("#printer_div1").removeClass("has-error");
		 $("#printer_div1").addClass("has-success");
		 return true;
		 }
	}
			
			
			
	</script>