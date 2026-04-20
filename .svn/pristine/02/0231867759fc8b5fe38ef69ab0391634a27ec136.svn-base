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
$("#menu").focus();

$(document).ready(function(){
/*************************************** Popup function starts *************************************************  */           
$('.md-close_pop').click( function() {  	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			   $('.mynewpopupload').empty();
	});
	/***************************************  Popup function starts *************************************************  */
	/*************************************** submit combination function starts *************************************************  */
   $("#combi").click(function(){
		var  menuid =$("#combivalue").val();
		var  combinationid =$("#menu").val();
		var combstatus=$('#combistatus');
		if(combinationid == "")
		{
				combstatus.text('Plz add combination');
		}
       else
	   {
		 $.ajax({
                        type: "POST",
                        url: "load_divcombination.php",
                        data: "value=addcombination&combid="+combinationid+"&menuid="+menuid,
                        success: function(msg)
                        {
								combstatus.text('');
							$('#menucombination').html(msg);
							
                        }
                    });
	   }
	   });	 
	/*************************************** submit combination function ends *************************************************  */
	$(".tab_edt_btn1").click(function(e){
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
			url: "load_divcombination.php",
			data: "value=delcombination&mid="+idval+"&combnid="+bcval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divcombination.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#menucombination').html(msg);
			}
		});
		   }
		});
    }
		});
		});
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Menu Combination</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#"><button class="md-close_pop">x</button></a>
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;">
                                                      <input type="hidden" name="combivalue" id="combivalue" value="<?=$_SESSION['menuidselect']?>" />                                            
                                             <?php
											 
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaster where mr_menuid <> '".$_SESSION['menuidselect']."' "); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Combination" id="menu" name="menu" data-rel="chosen" title="Combination" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">--Combination--</option>
                                        
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
                                                    <span class="search_btn_member_invoice"><a href="#" id="combi">GO</a></span>
                                                  </span>
                                                <span id="combistatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>  
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menucombination"  >
                                                   <thead>
                                          <tr>
                                            <th>Combination</th>
                                            <th>Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
											
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menucombination where mn_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
					$menu_name=$database->show_menu_ful_details($result_cat_s['mn_menucombid']);
?>
    <tr>
            <td><?=$menu_name['mr_menuname']?></td>
            
                 <td> <a class="tab_edt_btn1" href="#" id="m_<?=$result_cat_s['mn_menuid']?>" pid="b_<?=$result_cat_s['mn_menucombid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
           
                   <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>