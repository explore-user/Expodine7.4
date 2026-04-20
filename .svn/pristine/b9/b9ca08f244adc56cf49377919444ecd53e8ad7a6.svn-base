<?php
//include('../includes/session.php');		// Check session
session_start();
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
/*************************************** Popup function starts *************************************************  */           
function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
/***************************************  Popup function ends *************************************************  */
/*************************************** submit dinein rate function starts *************************************************  */
$(document).ready(function(){
    $("#taxsubmit").click(function(){
	  var  menuid =$("#taxvalue").val();
	  var taxname=$("#extrataxname").val();
		 $.ajax({
                        type: "POST",
                        url: "load_extra_tax.php",
                        data: "value=addtax&mid="+menuid+"&taxname="+taxname,
                        success: function(msg)
                        {
                            //alert(msg);
                            msg=$.trim(msg);
						
			$('#menutax').html(msg);
                         
                        }
                    });

	   });
           
  
           
        $(".tab_edt_btn15").click(function(e){
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
        
             $(".alert_error_popup_all_in_one_menu").show();
             $(".alert_error_popup_all_in_one_menu").text('DELETED');
             $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("frid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		  var pn_str= $(this).attr("pid");
		  var pn_arr	  =	 pn_str.split("_");
		  var pnval       =  pn_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_extra_tax.php",
			data: "value=deletetax&mid="+idval+"&taxid="+bcval+"&slno="+pnval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_extra_tax.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#menutax').html(msg);
			}
		});
		   }
		});
		//}
		});  
                
                });
           
</script>

<script src="master_style/js/basicTabs-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#tabwrap').basicTabs();
		
	});
	</script>
    
   

<div class="md-content" style="position:fixed;width:570px;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Item Tax</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
    <div class="tab_sub_head" style="margin-top:0;    padding: 5px 0px 2px 0px;">
	
		<span class="col-sm-6 tab_text_box_cc no-padding" style="display:inline-block;float:left;    width: 50% !important;">
			<?php $sql_kot  =  $database->mysqlQuery("select * from tbl_extra_tax_master where amc_item_tax='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                                                                                      
                                                                                  ?>
                    <select class="form-control add_new_dropdown dineinselect" id="extrataxname"  name="extrataxname" data-rel="chosen" title="" left"." data-toggle="tooltip" c>
			 <option value="">--Select Tax--</option>	
                        <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
                                                                            
                                                                            if($result_kot['amc_unit']=='P'){
                                                                                $unit_show="%";
                                                                            }else{
                                                                                $unit_show="";
                                                                            }
                                                                            
                                                                      	?>
                                              
                        <option value="<?=$result_kot['amc_id']?>"><?=$result_kot['amc_name']?> &nbsp;&nbsp; [<?=$result_kot['amc_value']?> <?=$unit_show?>]</option>
                                    <?php } ?> 
                                 
                                    	 </select>
                                    
                                         <?php } else{ ?>
                    <div style="color:red">No Item Tax Available !</div>                            
                                         <?php } ?>
		</span>
		<span class="col-sm-2 nopadding" style="  margin: 1px 0 -6px 0;display: inline-block;float: left;">
			<span class="search_btn_member_invoice">
                            <a href="#"  style="display:block" id="taxsubmit">Submit</a>
			</span>
			 <input type="hidden" name="taxvalue" id="taxvalue" value="<?=$_SESSION['menuidselect']?>" /> 
			</span>
		</div>
        <span class="tab_table_cont_cc" style="height: 47vh;min-height: 280px;">
            
		<table style="border: 1px solid #ccc;" class="responstable" id="menutax">
		<thead>
			<tr>
				<th width="15%">Sl No</th>
				<th>TAX</th>
				<th width="15%">Delete</th>
			</tr>
		</thead>
		<tbody>
                     <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_tax_master  where mtm_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                                        
					$tax_name=$database->show_tax_ful_details($result_cat_s['mtm_tax_id']);
?>
			<tr>
				<td width="15%"><?=$i++?></td>
				<td><?=$tax_name['amc_name']?></td>
                                <td width="15%"><a class="tab_edt_btn15" href="#" id="m_<?=$result_cat_s['mtm_menuid']?> " frid="b_<?=$result_cat_s['mtm_tax_id']?>" pid="p_<?=$result_cat_s['mtm_slno']?>"><img src="img/delete_btn_2.png"></a></td>
                          <?php $k++;}} ?>
				</tbody>
			</table>
		</span>
       
    
</div>                                     
</div>
        
        
        
