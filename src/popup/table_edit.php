<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['tableid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid and tr_tableid='".$_SESSION['tableid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['tr_tableno'];
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
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid and tr_tableid='".$_SESSION['tableid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="table_master.php"  method="post"  name="table_masteredit">
                        	 <div class="first_form_contain">
                               <span id="tableeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Table Name<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control tablenames" id="tablename1" name="tablename1"  placeholder="Table Name" tabindex="1"  data-toggle="tooltip" title="Table Name" value="<?=$result_login['tr_tableno']?>" ></div>
                               </div>
                               	 <div class="first_form_contain">
                             	<div class="form_name_cc">Max Chair Count<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="maxchair_divs">
                                     <input type="text" maxlength="2" class="form-control MaxChair" id="maxchair1" name="maxchair1"  placeholder="Max Chair Count" tabindex="2"  data-toggle="tooltip" title="Max Chair Count" value="<?=$result_login['tr_maxchaircount']?>"></div>
                               </div>
                                   <div class="first_form_contain">
                                 	<div class="form_name_cc">Floor<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="floor_divs">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster  where fr_status='Active'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Floor" id="floor1" tabindex="3" name="floor1" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">SELECT FLOOR</option>
                                         <optgroup label="Floor">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"  <?php if($result_kot['fr_floorid']==$result_login['tr_floorid']) { ?> selected="selected" <?php } ?>><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                          
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                    <div style="display:none" class="first_form_contain">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="brofc_divs">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Branch Name" id="branchofficename1" name="branchofficename1" data-rel="chosen" title="BranchName" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="BRANCH">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  id="<?=$result_kot['be_branchid']?>"  <?php if($result_kot['be_branchid']==$result_login['tr_branchid']) { ?> selected="selected" <?php } ?>><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                    	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_divs">
 <input type="checkbox" value="<?=$result_login['tr_status']?>" tabindex="4" name="active1"  id="active1" data-toggle="tooltip" title="Status" <?php if($result_login['tr_status']=="Active") { ?> checked <?php } ?> ></div>
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Table Order <span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="order_div1" >
                                     <input type="text" maxlength="3"  class="form-control tablename" id="order2" name="order1"  placeholder="Order" tabindex="5"  data-toggle="tooltip" title="Order" value="<?=$result_login['tr_displayorder']?>" ></div>
                               </div>
                                        <div class="first_form_contain" style="width:80% ">
                             	<div  class="form_name_cc" style="width:35% ">Time alloted</div>
                               	 <div class="form_textbox_cc" style="width:64% ">
                                <input type="text" class="form-control tablename" id="timealloted1" name="timealloted1"  placeholder="Time" tabindex="6"  data-toggle="tooltip" title="Order" value="<?=$result_login['tr_timealloted']?>" ></div>
                               </div>
                                        <span style=" line-height: 40px;text-align: left;;width:20%;float:left;color:#000">mins</span>
                                 <input type="hidden" name="tableid" id="tableid" class="menuname" style="color:black" value="<?=$result_login['tr_tableid']?>">        
                                 
                                  	<div class="full_width_new">
                                            <a  href="#" class="entersubmit" tabindex="7"  onClick="update_tableval()"><span class="md-save newbut">Update</span></a>
                                    </div>
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

	$('#tablename1').focus();
	
    $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
    
function valitable1(id)
{  $('#tableeditchk').text('');
			var id1=id;
	        var ab=$(".tablenames").val().trim();
			//alert(ab);
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktabledit&tablename="+ab+"&tableidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
		
			var catchk=$('#tableeditchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Already Exist');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
		 //catchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#tablename1").focus();
//return false;
			}
			else
			{
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	 // return true;
			}
			}
		});
			}
	
}
function update_tableval()
			{
			 if(validate_table1())
				{
					if(validate_chair1())
					{
						if(validate_floor())
						{
							
						if(validate_order())
							{
						if(validate_taball())
						{	
						
							
						}
                                            }
						
						}
					}
				}
			}
			function validate_taball()
			{
				 var tabid=$("#tableid").val();
				
				 var tb=document.getElementById("tablename1").value;
				
				// var b=document.getElementById("floorname").value;
				 var fr=$("#floor1").find('option:selected').attr('id');
				
				//document.getElementById("branchofficename").value;
				var bo= $("#branchofficename1").find('option:selected').attr('id');
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktableedit&tid="+tb+"&flr="+fr+"&brnch="+bo+"&tabid="+tabid,
			success: function(data)
			{
			data=$.trim(data);
	
			var namechk=$('#tableeditchk');
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Already Exist');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
		 //namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#tablename1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.table_masteredit.submit();
			}
			}
		});
			
			}
			
			function validate_table1()   
			{
				
				if($(".tablenames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.table_masteredit.tablename1.focus();
                                                 // alert("Enter Table Name")
                                                 $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Enter Table Name');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
						  return false;
				}
                                  var alphanumers = /^[a-zA-Z0-9_]+$/;
                              if(!alphanumers.test($("#tablename1").val())){
                              $("#menumaincategory_divs").addClass("has-error");
                          document.table_masteredit.tablename1.focus();
                  //alert("Special charecter Not Allowed.");
                  $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
                   }  
        
                              else
					 {
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
							 
	/*					 var id1=id;
	        var ab=$(".tablenames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktableedit&tablename="+ab+"&tableidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
		
			var catchk1=$('#tableeditchk');
			if(data =="sorry")
			{
				
		 catchk1.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#tablename1").focus();

	return false;
			}
			else
			{
		catchk1.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	//  document.state_masteredit.submit();
return true;	  
			}
			}
		}); */	 
					 }
			       }
                        
				function validate_chair1()   
			{
				if($("#maxchair1").val()=="")
				{
					$("#maxchair_divs").addClass("has-error");
						  document.table_masteredit.maxchair1.focus();
                                                  //alert("Enter Max Chair Count");
                                                  $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Enter Max Chair Count');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
						  return false;
				}
                                              var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#maxchair1").val())){
                              $("#maxchair_divs").addClass("has-error");
                          document.table_masteredit.maxchair1.focus();
                 // alert("Special charecter Not Allowed.");
                 $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
                   }  
        
                                 else
					 {
						$("#maxchair_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			         }	
                           
                    
            function validate_floor()   
			{
				if($("#floor1").val()=="")
				{
					$("#floor_divs").addClass("has-error");
						  document.table_masteredit.floor1.focus();
                                                 // alert("Select Floor");
                                                 $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Select Floor');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
						  return false;
				}
                                
//                                 var alphanumers = /^[a-zA-Z0-9]+$/;
//                              if(!alphanumers.test($("#floor1").val())){
//                              $("#floor_divs").addClass("has-error");
//                          document.table_masteredit.floor1.focus();
////                  alert("Special charecter Not Allowed.");
//                   }  
                                   else
					 {
						 $("#floor_divs").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			           }
                               
			
                        function validate_order()   
			{
				if($("#order2").val()=="")
				{
					//alert('Enter Table Order');
                                        $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Enter Table Order');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow'); 
					$("#order_div1").addClass("has-error");
						  document.table_masteredit.order2.focus();
						  return false;
				}else{
                                    
                                    
                                         
                        var ord=$("#order2").val();
                        var tb=$("#tableid").val(); 
                         var flr=$("#floor1").val();
                         
                        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktable_order_edit&ord="+ord+"&edit_id="+tb+"&flr="+flr,
			success: function(data3)
			{ 
                           if($.trim(data3)=='ok'){ 
                              
				validate_taball();
                           }else{
                             
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Order Already Exist In Floor');
                        
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
                        return false;
                        
                          }         
                                             
                            
                        }
                             });
                       }    
                                   
                              
			}
                              
            </script>