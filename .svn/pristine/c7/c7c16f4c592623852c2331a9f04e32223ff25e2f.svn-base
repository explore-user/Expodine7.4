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
	/***************************************  Submit nutrition function starts **************************************  */
$("#submit_nutrition").click(function(){

		var  menuid =$("#nutrivalue").val();
	    var nutrition=$("#nutrition").val();
        var nutrival=$("#value").val();
	var nutrnstatus=$('#nutristatus');
      var alphanumers = /^[a-zA-Z0-9 ]+$/;   
 if(nutrition == "" && nutrival == "" )
{
		nutrnstatus.text('Plz add nutrition facts');
}
else if (!alphanumers.test($("#nutrition").val())){
nutrnstatus.text('Special charecter Not Allowed');
                 // alert("Special charecter Not Allowed.");
}

else if(nutrival =="")
{
	nutrnstatus.text('Plz add nutrition value');
      
}
else if (!alphanumers.test($("#value").val())){
nutrnstatus.text('Special charecter Not Allowed');
                 // alert("Special charecter Not Allowed.");
}
else if(nutrition == "")
{
	nutrnstatus.text('Plz add nutrition');
}


else
{
                        $.ajax({
                        type: "POST",
                        url: "load_divnutrition.php",
                        data: "value=addnutrition&mid="+menuid+"&nutritionname="+nutrition+"&nutritionvalue="+nutrival,
                        success: function(msg)
                        {
							$('#menunutrition').html(msg);
							nutrnstatus.text('');
						
                        }
                    });



}
	   });		
	/***************************************  Submit nutrition function ends **************************************  */
	/*************************************** Delete nutrition function starts **************************************  */
	   $(".tab_edt_btn3").click(function(e){
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
			url: "load_divnutrition.php",
			data: "value=delnutrition&mid="+idval+"&nid="+bcval,
			success: function(msg)
			{
					$('#menunutrition').html(msg);
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divnutrition.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menunutrition').html(msg);
			}
		});
	}
	   });
/***************************************Delete nutrition function ends**************************************  */	 
		});
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Menu Nutrition</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
<a href="#"><button class="md-close_pop">x</button></a>
                                                 <span class="col-sm-3 no-padding" style="display:inline-block;float:left;  margin:0 8px 3px 0;">
                                                         <input type="text" class="form-control nutrition" id="nutrition" name="nutrition" placeholder="Nutrition">
                                                    </span>
                                                   
                                                <span class="col-sm-3 no-padding" style="display:inline-block;float:left;">
                                                         <input type="text" class="form-control" id="value" name="value" placeholder="Value">
                                                    </span>
                                                   
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -5px 0;display: inline-block;float: left;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_nutrition" >GO</a></span>
                                                       <input type="hidden" name="nutrivalue" id="nutrivalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                                                   
                                                </span>
                                                
                                                       <span id="nutristatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>                
                                                    	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menunutrition"  >
                                                   <thead>
                                          <tr>
                                            <th>Nutrition</th>
                                           <th>Value</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
											  //`mrd_menuid`, `mrd_branch`, `mrd_status`
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menunutitionfacts where mnf_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
				
?>
    <tr>
            <td><?=$result_cat_s['mnf_nutrition']?></td>
            
            <td><?=$result_cat_s['mnf_value']?></td>
                 <td> <a class="tab_edt_btn3" href="#" id="m_<?=$result_cat_s['mnf_menuid']?>" pid="b_<?=$result_cat_s['mnf_nutrition']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
              
           <!-- <td width="10%"><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
        
          </tr>

  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>                                         