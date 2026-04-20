<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
 $bilno=$_REQUEST['bilno'];

	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv1").removeClass("new_overlay"); 
			  $('.mynewpopupload1').css("display","none");
		}
	/***************************************  Popup function starts *************************************************  */
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;"><!--1sttab-->
<h3 class="order_list_head">Ordered Items
	   <a href="#" onclick="test()"><button class="md-close_pop order_list_close">X</button></a>
</h3>
				<div>
                
                	<div class="take_order_list_view_cc">
                    <?php
					 $sql_menulist= "Select tbl_takeaway_billdetails.tab_qty,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_slno,tbl_menumaster.mr_itemshortcode,tbl_portionmaster.pm_portionshortcode,tbl_takeaway_billdetails.tab_status,tbl_takeaway_billdetails.tab_amount From tbl_menumaster Inner Join tbl_takeaway_billdetails On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_portionmaster.pm_id =tbl_takeaway_billdetails.tab_portion Where tbl_takeaway_billdetails.tab_billno = '".$bilno."' AND (tbl_takeaway_billdetails.tab_status='Packed')  order by tab_slno DESC ";
	$sql_menus  =  $database->mysqlQuery($sql_menulist); 
	$num_menus  = $database->mysqlNumRows($sql_menus);
	if($num_menus){$i=1;
		while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
			{
				if($result_menus['tab_preferencetext']!="")
				{
					$pref="(".$result_menus['tab_preferencetext'].")";
				}else
				{
					$pref="";
				}
				?>
                    	<div class="take_pop_order_item">
                        	<div class="take_popup_quantity"><?=$i++; ?></div>
                        	<div class="take_pop_dish_name"><?=$result_menus['mr_itemshortcode'].$pref?></div>
                            <div class="take_popup_quantity"><?=$result_menus['tab_qty']?></div>
                            <div class="take_popup_quantity"><?=$result_menus['pm_portionshortcode']?></div>
                            <div class="take_popup_quantity"><?=$result_menus['tab_amount']?></div>
                            
                        </div><!--take_pop_order_item -->
                      <?php } } ?>
                        
                    </div><!--take_order_list_view_cc-->
                </div><!--div-->
               <!-- <a href="#"><button class="md-close">Close</button></a>-->
             
                                            </div>
