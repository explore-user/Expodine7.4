<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['menuidselect']=$_REQUEST['menu'];


$rt='';
$sql_login  =  $database->mysqlQuery("select mr_menuname,mr_menuid,mr_rate_type from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mr_menuname'];
                          $searchmenu_id=$result_cat_s['mr_menuid'];
                          $rt=$result_cat_s['mr_rate_type'];
	  }			
} 
else
{
  $searchname="";
}
?>


<script>
$(document).ready(function(){
   
/*************************************** Popup function starts *************************************************  */           
$('.md-close_pop').click( function() {  	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
	});
	/***************************************  Popup function starts *************************************************  */
/*************************************** submit preference function starts *************************************************  */	
  $("#submit_addons").click(function(){
		var  menuid =$("#addon").val();
		
		var  addon_menuid =$("#addons-menu").val();
		
		var addonstatus=$('#addonstatus');
		if(addon_menuid =='' || addon_menuid == undefined)
		{
		addonstatus.text('Plz select add-on menu');
		}
		else
		{
		 $.ajax({
                        type: "POST",
                        url: "load_divaddons.php",
                        data: "value=add-addon&addon_menuid="+addon_menuid+"&menuid="+menuid,
                        success: function(msg)
                        {
								addonstatus.text('');
							$('#menuaddontable').html(msg);
							
                        }
                    });
		}
	   });	      	
/*************************************** submit preference function ends *************************************************  */
/*************************************** Delete preference function starts *************************************************  */
	 $(".tab_edt_btn2").unbind().click(function(e){
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var mainmenu=$('#addon').val();
		 $.ajax({
			type: "POST",
			url: "load_divaddons.php",
			data: "value=deladdon&mid="+mainmenu+"&addon_menuid="+idval,
			success: function(msg)
			{
					$('#menuaddontable').html(msg);
		   }
		});
			$.ajax({
			type: "POST",
			url: "load_divaddons.php",
			data: "value=loadbranch&mid="+mainmenu,
			success: function(msg)
			{
				$('#menuaddontable').html(msg);
			}
		});
                
                 $('.addon_error').show();
                  
      $('.addon_error').text('REMOVED');
      $('.addon_error').delay(1000).fadeOut('slow');
                
   // }
		});
/*************************************** Delete preference function ends *************************************************  */	 
		});
</script>

<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
  
<div  class="dfineheading"> <strong>Menu Add-ons</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop">x</button></a>
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;">
                                                          <input type="hidden" name="addon" id="addon" value="<?=$_SESSION['menuidselect']?>" />                    
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select mr_menuname, mr_menuid from tbl_menumaster where mr_add_on='Y' and mr_active='Y' "); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select <?php if($rt!='Portion'){ ?> style="pointer-events: none;opacity: 0.5;" <?php } ?> data-placeholder="Enter Add-ons" id="addons-menu" name="addons-menu" data-rel="chosen" title="addons-menu" left-data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">--Add-ons--</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['mr_menuid']?>"><?=$result_kot['mr_menuname']?></option>
                                    <?php } ?> 
                                      
                                    	 </select>
                                         <?php } ?>                     
                                                                             
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                 <span <?php if($rt!='Portion'){ ?> style="pointer-events: none;opacity: 0.5;" <?php } ?> class="search_btn_member_invoice"><a href="#" id="submit_addons">GO</a></span> 
                                                  </span>
 <span class="addon_error" style="color:red"></span>
 
                                                  <span id="addonstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>           
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menuaddontable"  >
                                                   <thead>
                                          <tr>
                                            <th>Add-On</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
                                           
                     
                                           
$sql_cat_s  =  $database->mysqlQuery("select ma_addon_menuid, mr_menuid,mr_menuname from tbl_menu_addons left join tbl_menumaster on mr_menuid=ma_addon_menuid where  ma_menuid='".$_SESSION['menuidselect']."' "); 
//echo "select ma_addon_menuid from tbl_menu_addons where ma_menuid='".$_SESSION['menuidselect']."'";
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                            $menu_name=$result_cat_s['mr_menuname'];
?>                          
    <tr>
            <td><?=$menu_name?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['ma_addon_menuid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   
          </tr>
  <?php $k++;}} ?><input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
    </tbody>
    </table>
    </span>  <!--tab_table_cont_cc-->  
    </div>
                                                
                                              
                                                
                                                
                                                
                                                
                                                
                                                
    