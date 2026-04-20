<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['menuidselect']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mr_menuname'];
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
  $("#submit_preference").click(function(){
      
		var  menuid =$("#addonvalue").val();
		
		var  addonid =$("#addonchange").val();
		var addonrate=$("#addonrate").val();
//                alert(addonid);
  //             alert(addonrate);
//                alert(menuid);
		var prefrncstatus=$('#prefstatus');
		if(addonid =='' || addonrate=='')
		{
		prefrncstatus.text('......Enter Fill Data');
		}
		else
		{$("#addonrate").val('');
		 $.ajax({
                        type: "POST",
                        url: "load_div_addon.php",
                        data: "value=addonadding&adid="+addonid+"&menuid="+menuid+"&addonrate="+addonrate,
                        success: function(msg)
                        {
								prefrncstatus.text('');
							$('#menupreference').html(msg);
							
                        }
                    });
		}
	   });	      	
/*************************************** submit preference function ends *************************************************  */
/*************************************** Delete preference function starts *************************************************  */
	 $(".tab_edt_btn2").click(function(e){
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
                 
		 $.ajax({
			type: "POST",
			url: "load_div_addon.php",
			data: "value=deladdon&mid="+idval+"&prefrncid="+bcval,
			success: function(msg)
			{
					$('#menupreference').html(msg);
		   }
		});
			$.ajax({
			type: "POST",
			url: "load_div_addon.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menupreference').html(msg);
			}
		});
                
                 $('.addon_error').show();
             
      $('.addon_error').text('REMOVED');
      $('.addon_error').delay(1000).fadeOut('slow');
  //  }
		});
/*************************************** Delete preference function ends *************************************************  */	 
		});
                
    function addonshift(){
        $(".refsp").load(location.href + " .refsp");
    }     
    
    
    function numonly(evt)
    { 
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }  
    
</script>
<style>
    ::-webkit-input-placeholder { /* Chrome */
  color: black;
  font-weight: bold;
}
    
</style>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
  
<div  class="dfineheading"> <strong>Menu Addons</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop">x</button></a>
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;">
                                                          <input type="hidden" name="addonvalue" id="addonvalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menu_addon_master where ma_active='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                                          <select data-placeholder="Enter Addons" id="addonchange" name="addonchange" data-rel="chosen" title="Preference" onchange="return addonshift();" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">--Addons--</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ma_id']?>"><?=$result_kot['ma_name']?></option>
                                    <?php } ?> 
                                      
                                    	 </select>
                                                          
                                                                   
                                         <?php } ?>                     
                                                                             
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 6px 0;display: inline-block;float: left;">
                                                 <input type="text" id="addonrate" name="addonrate"  placeholder="Enter Rate" style="color: #000 ;height: 30px;padding-left: 5px" onkeypress="return numonly()" required>   
                                                  <span class="search_btn_member_invoice" style="margin-left: 140px;margin-top:-29px "><a href="#" id="submit_preference">GO</a></span>
                                                  </span>
                                                  <span id="prefstatus" style="padding-left:20px;margin-right:2px ;text-align: right; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>           
                                                	<span class="tab_table_cont_cc ">
                                                 <table class="responstable" id="menupreference" >
                                                   <thead>
                                          <tr>
                                            <th>Addon</th>
                                              <th>Rate</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_addon_rate  where mar_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
						$menu_name=$database->show_addon_ful_details($result_cat_s['mar_addon_id']);
?>
    <tr>
            <td><?=$menu_name['ma_name']?></td>
             <td><?=$result_cat_s['mar_rate']?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['mar_menuid']?>" pid="b_<?=$result_cat_s['mar_addon_id']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                 </div>
                                                
                                              
                                                
                                                
                                                
                                                
                                                
                                                
    