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
   /*********************************** submit ingredient function starts *******************************************  */
    $("#submit_ingredient").click(function(){
		var  menuid =$("#ingrvalue").val();
		var  ingredientid =$("#ingredient").val();

		
var ingrstatus=$('#ingstatus');
		if(ingredientid =="" || ingredientid==undefined )
		{
		ingrstatus.text('Plz add ingredients');
		}
		else
		{
		 $.ajax({
                        type: "POST",
                        url: "load_divingredient.php",
                        data: "value=addingredient&ingrid="+ingredientid+"&menuid="+menuid,
                        success: function(msg)
                        {
							ingrstatus.text('');
							$('#menuingredient').html(msg);
									
							
                        }
                    });
					
					
					
					
		}
     
	   });	      
/*************************************** submit ingredient function starts*********************************************  */	
	  $(".tab_edt_btn4").click(function(e){
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
			url: "load_divingredient.php",
			data: "value=delingredient&mid="+idval+"&ingid="+bcval,
			success: function(msg)
			{
					$('#menuingredient').html(msg);
					
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divingredient.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menuingredient').html(msg);
			}
		});
	}
	   });
/*************************************** Delete ingredient function ends *****************************************  */
	
		});
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Menu Ingredient</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop">x</button></a>
                                              <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;">
                                              
                                              
                                                    <input type="hidden" name="ingrvalue" id="ingrvalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                                                   <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_ingredientmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Ingredient" id="ingredient" name="ingredient" data-rel="chosen" title="Ingredient" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">--Ingredient--</option>
                                       
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ir_ingredientid']?>"><?=$result_kot['ir_ingredientname']?></option>
                                    <?php } ?> 
                                       
                                    	 </select>
                                         <?php } ?>             
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_ingredient">GO</a></span>
                                                </span>
                                                      <span id="ingstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menuingredient"  >
                                                   <thead>
                                          <tr>
                                            <th>Ingredients</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuingredients where ms_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$ingredient_name=$database->show_ingredient_ful_details($result_cat_s['ms_ingridentid']);
?>
    <tr>
            <td><?=$ingredient_name['ir_ingredientname']?></td>
                 <td> <a class="tab_edt_btn4" href="#" id="m_<?=$result_cat_s['ms_menuid']?>" pid="b_<?=$result_cat_s['ms_ingridentid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>