<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['floorid']=$_REQUEST['floor'];
$sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_floorid='".$_SESSION['floorid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['fr_floorname'];
			  
	  }			
} 
else
{
  $searchname="";
}



         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         
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
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_floorid='".$_REQUEST['floor']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      $extratax=$result_login['fr_enable_extra_tax'];
                      
                      $qr_code=$result_login['fr_qr_order'];
	 ?>
                           <form role="form" action="floor_master.php"  method="post"  name="floor_masteredit">
                        	 <div class="first_form_contain">
                              <span id="flooreditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Floor - Section<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="floor_div1">
                                     <input type="text" class="form-control floornames" id="floor1" name="floor1"  placeholder="Floor" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title=" Name" value="<?=$result_login['fr_floorname']?>"></div>
                               </div>
                               
                               <div class="first_form_contain">
                              <span id="flooreditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Display Order<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="floor_div1">
                                     <input type="text" maxlength="3" onkeypress="return numonly();" class="form-control floornames" id="floor_order1" name="floor_order1"  placeholder="Floor Order" tabindex="2"   data-toggle="tooltip" title=" Order" value="<?=$result_login['fr_order_display']?>"></div>
                               </div>
                               
                               
                               <div style="display:none" class="first_form_contain">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="branch_div1">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select be_branchid,be_branchname from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Branch Name" id="branch1" name="branch1" data-rel="chosen" tabindex="3" title="BranchName" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="BRANCH">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  id="<?=$result_kot['be_branchid']?>" <?php if($result_kot['be_branchid']==$result_login['fr_branchid']) { ?> selected="selected" <?php } ?>><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                     
                             	
                               <div class="first_form_contain" style="display:none">
                                <div class="form_name_cc">Enable Extra Tax</div>
                                <div class="form_textbox_cc">
                                	<select data-placeholder="Extax" id="extax1" tabindex="3" name="extax1" data-rel="chosen" title="Tax"  left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="Yes"  <?php if($extratax =="Y") echo "selected";?>>YES</option>
                                        <option value="No" <?php if($extratax =="N") echo "selected";?>>NO</option>
                                    </select>
                                 </div>
                            </div>
                             <?php ?>
                               
                                    
                                    
                              <div class="first_form_contain">
                                <div class="form_name_cc">Qr Code</div>
                                <div class="form_textbox_cc">
                                	<select data-placeholder="" onchange="qr_check();" id="qr_code1" name="qr_code1" tabindex="4" data-rel="chosen" title="Tax"  left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        
                                        <option value="N"   <?php if($qr_code =="N") echo "selected";?>>NO</option>
                                            <option value="Y"  <?php if($qr_code =="Y") echo "selected";?>>YES</option>
                                    </select>
                                 </div>
                            </div>
                               
                                    
                                         <div class="first_form_contain">
                                    	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div1">
 <input type="checkbox" value="<?=$result_login['fr_status']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="Status" <?php if($result_login['fr_status']=="Active") { ?> checked <?php } ?> ></div>
                               </div>
                                 <input type="hidden" name="floorid" id="floorid" class="menuname" style="color:black" value="<?=$result_login['fr_floorid']?>">        
                                 <a  href="#" class="entersubmit"  onClick="update_floor()" tabindex="6"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
	
    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $('.md-close_pop').click();
    });

  $("#floor1").focus();
    
    $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
         function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }
        
        function qr_check(){
           var flr=  $('#floor1').attr('qr_id_flr');
           
          
            $.ajax({
                                type: "POST",
                                url: "load_divcheckmenu.php",
                                data: "value=check_qr&flr="+flr,
                                success: function (msg)
                                {
                                  if($.trim(msg)=='sorry'){
                                 $("#qr_code1").val('N');     
                                      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Qr Order Already Exist .Keep It No');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                                  }
                                    
                                }
                            });
            
            
        }
        
function valifloor1(id)
{
	  $('#flooreditchk').text('');
			var id1=id;
		
	        var ab=$(".floornames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkflooredit&floorname="+ab+"&flooridchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			var catchk=$('#flooreditchk');
			if(data =="sorry")
			{
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		 //catchk.text('Already exists');
		   $("#floor_div1").addClass("has-error");
	  $("#floor1").focus();
//return false;
			}
			else
			{
		catchk.text('');
		 $("#floor_div1").removeClass("has-error");
	   $("#floor_div1").addClass("has-success");
	 // return true;
			}
			}
		});
			}
	
	
	
	
}


function validate_floorall()
			{
				//alert('a');
				var flooridchk=$("#floorid").val();
			//	alert(flooridchk);
				
				 var flr=document.getElementById("floor1").value;
			//	 alert(flr);
				
				// var b=document.getElementById("floorname").value;
				 var br=$("#branch1").find('option:selected').attr('id');
				//alert(br);
				//document.getElementById("branchofficename").value;
				
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkflooredit&flooridchk="+flooridchk+"&br="+br+"&floorname="+flr,
			success: function(data)
			{
			data=$.trim(data);
//	alert(data);
			var namechk=$('#flooreditchk');
			if(data =="sorry")
			{
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
		// namechk.text('Already exists');
		   $("#floor_div1").addClass("has-error");
	  $("#floor1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#floor_div1").removeClass("has-error");
	   $("#floor_div1").addClass("has-success");
	  // return true;
document.floor_masteredit.submit();
			}
			}
		});
			
			}

    function update_floor()
	{
	 if(validate_floorname1())
		{
		if(validate_floor_order1()){	
                            if(validate_floorall())
                            {
                                //  document.floor_masteredit.submit();
                            }
                }	
			 
		}
	}
        
        
        function validate_floor_order1()
                        {
                            
                        if ($("#floor_order1").val() == "")
                            {
                                //$("#floor_div").addClass("has-error");
                                //document.floor_master.floor.focus();
                              //  alert("Enter Floor Name");
                              $("#floor_order1").focus();
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Floor Order');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            }   else{
                                  return true;
                            }     
                        
                        }
        
    function validate_floorname1()   
	{
		
		var id=$("#floorid").val();
		if($(".floornames").val()=="")
		{
			$("#floor_div1").addClass("has-error");
				  document.floor_masteredit.floor1.focus();
                                  //alert("Enter Floor Name");
                                   $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Floor Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
				  return false;
		}
                
                       var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#floor1").val())){
                       $("#floor_div1").addClass("has-error");
                      document.floor_masteredit.floor1.focus();
                 // alert("Special charecter Not Allowed.");
                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }       
        
                     else
			 {
				 var a=document.getElementById("floor1").value;
				 //alert(a);
				$("#floor_div1").removeClass("has-error");
					$(this).addClass("has-success");
					 return true;
			 }
	
    }
 
	
	</script>