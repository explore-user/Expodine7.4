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

$('#preference').focus();
          
$('.md-close_pop').click( function() {  	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
	});
	/***************************************  Popup function starts *************************************************  */
/*************************************** submit preference function starts *************************************************  */	
  $("#submit_preference").click(function(){
		var  menuid =$("#prefvalue").val();
		
		var  preferenceid =$("#preference").val();
		
		var prefrncstatus=$('#prefstatus');
		if(preferenceid =='' || preferenceid == undefined)
		{
		prefrncstatus.text('Plz add preference');
		}
		else
		{
		 $.ajax({
                        type: "POST",
                        url: "load_divpreference.php",
                        data: "value=addpreference&prefid="+preferenceid+"&menuid="+menuid,
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
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divpreference.php",
			data: "value=delpreference&mid="+idval+"&prefrncid="+bcval,
			success: function(msg)
			{
					$('#menupreference').html(msg);
		   }
		});
			$.ajax({
			type: "POST",
			url: "load_divpreference.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menupreference').html(msg);
			}
		});
    }
		});
/*************************************** Delete preference function ends *************************************************  */	 
		});
</script>

<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
  
<div  class="dfineheading"> <strong>Menu Preference</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop">x</button></a>
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;">
                                                          <input type="hidden" name="prefvalue" id="prefvalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_preferencemaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Preference" id="preference" name="preference" data-rel="chosen" title="Preference" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">--Preference--</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pmr_id']?>"><?=$result_kot['pmr_name']?></option>
                                    <?php } ?> 
                                      
                                    	 </select>
                                         <?php } ?>                     
                                                                             
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_preference">GO</a></span>
                                                  </span>
                                                  <span id="prefstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>           
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menupreference"  >
                                                   <thead>
                                          <tr>
                                            <th>Preference</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuprefmaster where mpr_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
						$menu_name=$database->show_prefernce_ful_details($result_cat_s['mpr_prefeernce']);
?>
    <tr>
            <td><?=$menu_name['pmr_name']?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['mpr_menuid']?>" pid="b_<?=$result_cat_s['mpr_prefeernce']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                 </div>
                                                
                                              
                                                
                                                
                                                
                                                
                                                
                                                
    