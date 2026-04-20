<?php
include('../includes/session.php');	
//session_start();
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['menuidselect']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select mr_menuname,mr_maincatid from tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['mr_menuname'];
                          $cat_src=$result_cat_s['mr_maincatid'];
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
			  $('.mynewpopupload').empty();
		}
/***************************************  Popup function starts *************************************************  */
</script>
<input type="hidden" id="search_menu_id" value="<?=$_REQUEST['menu']?>">

<input type="hidden" id="search_cat_id" value="<?=$cat_src?>">


<div class="md-content " style="position:fixed;width:800px;left:20%;top:2%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong> - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?>&nbsp;&nbsp;&nbsp;  &nbsp;[ REF ID : <?=$_REQUEST['menu']?> ]</span></div> 
<a onclick="test()"><button class="md-close_pop">x</button></a>
 
<?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid WHERE  tbl_menumaster.mr_menuid='".$_REQUEST['menu']."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
				/*echo $result_login['mr_diet'];	*/
	 ?>                                             
     
         <form role="form"   method="post" action=""  name="menu_masteredit<?=$result_login['mr_menuid']?>" id="menu_masteredit<?=$result_login['mr_menuid']?>">
			<div class="md-content">
				
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<table class="popup_add_table" width="100%" border="0" cellspacing="5" style="margin-bottom: -6px !important;">
                            
                            
                            
                           <tr>
                               <td style="width:15%;padding-left:4px;">Item Type<span style="color:#F00">*</span></td>
                               <td  id="insetmsg_diet">
                                  
                                   <select  style="width:20%;margin-left: -20px" data-placeholder="Type"  name="finished_edit"  id="finished_edit" data-rel="chosen" tabindex="7" title="" left="." data-toggle="tooltip" class="form-control add_new_dropdown enter">
                                       
                                          <option  <?php if($result_login['mr_product_type']=="Menu") { ?> selected="selected" <?php } ?>  value="Menu">Menu</option>
                                          
                                            <?php if(in_array("inventory", $_SESSION['menuarray'])) {    ?>
                                            <option  <?php if($result_login['mr_product_type']=="Finished") { ?> selected="selected" <?php } ?> value="Finished">Finished Good</option>
                                            <option  <?php if($result_login['mr_product_type']=="Raw") { ?> selected="selected" <?php } ?> value="Raw">Raw Material</option>
                                              <?php } ?>  
                                            
                                    	 </select>
                                 </td>
                                 
                              </tr>  
                            
                            
                              <tr>
                                <span id="menuchk" class="load_error alertsmaster" style="color:#F00" ></span>    
                                <td style="width:12%;padding-left:4px;">Item Name<span style="color:#F00">*</span></td>
                                <td width="80%"  id="insetmsg_emenu<?=$result_login['mr_menuid']?>">
                                    <input style="margin-left: -22px;width: 60%" type="text" autocomplete="off" class="form-control menunames enter" id="menuname1<?=$result_login['mr_menuid']?>" name="menuname1" onkeyup="return menu_enter_edit('<?=$result_login['mr_menuid']?>');"  placeholder="Menu" tabindex="1"  data-toggle="tooltip" title="Menu" value="<?=$result_login['mr_menuname']?>" autofocus="" > </td>
                                
                                <span id="menuchk1" class="load_error alertsmaster" style="color:#F00" ></span> 
                                
                             </tr>
                         </table>
                         <table class="popup_add_table" width="100%" border="0" cellspacing="5" style="margin-bottom: -6px !important;">
                         	<tr>
                            <td class="raw_hide_class1"  width="13%" style="text-align:left;padding-right:3px;">Item Code</td>
                                 <td class="raw_hide_class1" width="35%" id="item_shortcode1_div<?=$result_login['mr_menuid']?>"> 
                                     
                                    <input type="text" tabindex="2" class="form-control menuname enter" placeholder="Item Code - HSN" id="item_shortcode1<?=$result_login['mr_menuid']?>" name="item_shortcode1" value="<?=$result_login['mr_itemcode']?>" onchange="validitemcode1('<?=$result_login['mr_menuid']?>')" maxlength="8">
                                 </td>
                              
                                 
                                   
                                 <td class="raw_hide_class1" style="padding-left:10px;" width="15%">Name in Bill<span style="color:#F00">*</span></td>
                                 <td class="raw_hide_class1" id="insetmsg_esht<?=$result_login['mr_menuid']?>"><input maxlength="19" type="text" class="form-control shortcodename1" id="shortcode1<?=$result_login['mr_menuid']?>" name="shortcode1"  placeholder="Menu Short Code" tabindex="3" maxlength="25"  data-toggle="tooltip" title="Menu Short Code" value="<?=$result_login['mr_itemshortcode']?>"  ></td>
                                  
                             </tr>
                             <tr>
                                 
                              
                             <td class="raw_hide_class1" style="text-align:left">Kot Kitchen<span style="color:#F00">*</span></td>
                                <td class="raw_hide_class1" id="insetmsg_ekot<?=$result_login['mr_menuid']?>">
                             <?php
							 $sql_kot  =  $database->mysqlQuery("select * from tbl_kotcountermaster"); 
							  $num_kot   = $database->mysqlNumRows($sql_kot);
							  if($num_kot){
							?>
                                    <select data-placeholder="Enter Kitchen" id="kotcounter1<?=$result_login['mr_menuid']?>" class="enter  form-control" name="kotcounter1" data-rel="chosen" tabindex="4" title="Kitchen" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Kitchen">
				     		<?php
							while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
								{
									?>
                                  <option value="<?=$result_kot['kr_kotcode']?>" <?php if($result_kot['kr_kotcode']==$result_login['mr_kotcounter']) { ?> selected="selected" <?php } ?>><?=$result_kot['kr_kotname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>    
                             </td>
                             
                             <td style="padding-left:10px;">Main Category<span style="color:#F00">*</span></td>
                             
                             <td id="insetmsg_emain<?=$result_login['mr_menuid']?>"  class="main_cat_type<?=$result_login['mr_menuid']?>" >
                              <?php
							 $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaincategory where mmy_active='Y' and and mmy_inventory='N'  "); 
							  $num_kot   = $database->mysqlNumRows($sql_kot);
							  if($num_kot){
							?>
                                 <select onchange="change_cat();" data-placeholder="Select Main Category"  id="maincat1<?=$result_login['mr_menuid']?>" name="maincat1" class="enter form-control maincat_edit" data-rel="chosen" tabindex="5" title="Menu Main Category" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select Category</option>
                                         <optgroup label="Menu Main Category">
				   				<?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
											?>
                                            <option value="<?=$result_kot['mmy_maincategoryid']?>" <?php if($result_kot['mmy_maincategoryid']==$result_login['mr_maincatid']) { ?> selected="selected" <?php } ?>><?=$result_kot['mmy_maincategoryname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>    
                              </td>
                            
                             
                          </tr>
                          
                              <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$result_login['mr_menuid']?>" /> 
                           
                             <tr>
                                 <td style="text-align: left;">Rate Type <?php  if($_SESSION['ser_menu_unit_edit']=='N'){ ?> &nbsp;<i class="fa fa-user" style="cursor:pointer;border:solid 1px red" title="NO PERMISSION TO CHANGE UNIT/PORTION/BASEUNIT">  </i> <?php } ?> </td>
                                    <td id="insetmsg_ratetype">
                                        
                                       <select <?php  if($_SESSION['ser_menu_unit_edit']!='Y'){ ?>  style="pointer-events: none " <?php } ?>  data-placeholder="" tabindex="10" class="form-control add_new_dropdown  portionunit_selection enter" id="ratetype<?=$result_login['mr_menuid']?>" name="ratetype"  onchange="portionunit_selection(this.value)" >
                                         <option value="Portion" <?php if($result_login['mr_rate_type']=='Portion') { ?> selected="selected" <?php } ?>>Portion</option>
                                         <option value="Unit" <?php if($result_login['mr_rate_type']=='Unit') { ?> selected="selected" <?php } ?>>Unit</option>
                                       </select>
                                   </td>
                                <td style="text-align: left;padding-left:10px;">Base Unit</td>
                                   <td id="insetmsg_baseunit<?=$result_login['mr_menuid']?>">
                                       <select <?php  if($_SESSION['ser_menu_unit_edit']!='Y'){ ?> style="pointer-events: none " <?php } ?>  data-placeholder="" tabindex="11" class="form-control add_new_dropdown baseunit_select enter" name="baseunit" id="baseunitselect<?=$result_login['mr_menuid']?>" onchange="baseunit_select()">
                                         <option value="">Select Unit</option>
                                         <?php
                                         $sql_unit1  =  $database->mysqlQuery("select * from tbl_base_unit_master"); 
							  $num_unit1   = $database->mysqlNumRows($sql_unit1);
							  if($num_unit1){ 
                                                               while($result_unit1  = $database->mysqlFetchArray($sql_unit1)) {
                                                                   ?>
                                                                   
                                                          
                                                                    <option value="<?=$result_unit1['bu_id']?>" <?php if($result_unit1['bu_id']==$result_login['mr_base_unit']) { ?> selected="selected" <?php } ?>><?=$result_unit1['bu_name']?></option>
                                                                   
                                         <?php
                                            }
                                            }
                                        ?>
                                    	 </select>
                                </td>
                                 
                              </tr>
                              
                                                     <tr>
                                  <td style="text-align: left;">Unit Type</td>
                                   <td id="insetmsg_unittype<?=$result_login['mr_menuid']?>">
                                       <select <?php  if($_SESSION['ser_menu_unit_edit']!='Y'){ ?> style="pointer-events: none " <?php } ?>  data-placeholder="" tabindex="12" class="form-control add_new_dropdown  unittype_selection unt enter" id="unittype_selection" name="unittype" onchange=" return unit_type_selection(this.value)"   >
                                           <option value="">Select Unit Type</option>
                                         <option value="Packet" <?php if($result_login['mr_unit_type']=='Packet'){ ?> selected <?php }?>>Packet</option>
                                         <option value="Loose" <?php if($result_login['mr_unit_type']=='Loose'){ ?> selected <?php }?>>Loose</option>
                                    	 </select>
                                    </td>
                                  
                                   <td style="text-align: left;padding-left:8.5px;">Inventory Store <span id="inv_star1" style="color:#F00;display: none">*</span></td>
                                   <td >
                                       <select data-placeholder="" tabindex="13" class="form-control add_new_dropdown enter" name="inv_kitchen1" id="inv_kitchen1" >
                                         <option value="0">Select </option>
                                         <?php
                                         $sql_unit1  =  $database->mysqlQuery("select * from tbl_inv_kitchen"); 
							  $num_unit1   = $database->mysqlNumRows($sql_unit1);
							  if($num_unit1){ 
                                                               while($result_unit1  = $database->mysqlFetchArray($sql_unit1)) {
                                                                   ?>
                                                                   
                                                          
                                                                    <option value="<?=$result_unit1['ti_id']?>" <?php if($result_unit1['ti_id']==$result_login['mr_inventory_kitchen']) { ?> selected="selected" <?php } ?>><?=$result_unit1['ti_name']?></option>
                                                                   
                                         <?php
                                            }
                                            }
                                        ?>
                                    	 </select>
                                </td>
                              </tr>
                              
                              <tr>
                               
                                
                                <td style="text-align:left">Sub Category</td>
                          <td id="insetmsg_esub<?=$result_login['mr_menuid']?>">
                           <?php
						   $sql_kot  =  $database->mysqlQuery("select * from tbl_menusubcategory"); 
							$num_kot   = $database->mysqlNumRows($sql_kot);
							if($num_kot){
							?>
                              <select data-placeholder="Enter Sub Category" id="subcat1<?=$result_login['mr_menuid']?>" name="subcat1" data-rel="chosen" tabindex="6" class="enter form-control" title="Menu Sub Category" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select sub category</option>
                                         <optgroup label="Menu Sub Category">
				   	<?php
					  while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
						  {
							  ?>
                                            <option value="<?=$result_kot['msy_subcategoryid']?>" <?php if($result_kot['msy_subcategoryid']==$result_login['mr_subcatid']) { ?> selected="selected" <?php } ?>><?=$result_kot['msy_subcategoryname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>    
                          </td>
                               
                               <td class="raw_hide_class1" style="text-align: left;">PLU Code<span style="color:#F00"></span></td>
                                <td class="raw_hide_class1" id="insetmsg_est">
                                    <input style="width: 100%;" type="text" class="form-control time enter" id="plu_code1" name="plu_code1"  placeholder=" PLU CODE" tabindex="14" data-toggle="tooltip" maxlength="4" title="ITEM PLU CODE"  value="<?=$result_login['mr_plu']?>">
                                </td> 
                                
                                
                              </tr>
                              
                              
                               <tr>
                                  
                                <td class="reorder_hide_class1" style="text-align: left;display: none">Reorder Level<span style="color:#F00"></span></td>
                                <td class="reorder_hide_class1" style="display: none" id="insetmsg_est">
                                    <input style="width: 100%;" type="text" class="form-control time enter" id="reorder_level1"  name="reorder_level1"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="<?=$result_login['mr_reorder_level']?>">
                                </td>
                                  
                               <td class="purchase_hide_class1" style="text-align: left;display: none">Purchase Rate<span style="color:#F00"></span></td>
                                <td class="purchase_hide_class1" style="display: none" id="insetmsg_est">
                                    <input style="width: 100%;"  type="text" class="form-control time enter" id="purcahse_rate1"  name="purcahse_rate1"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="<?=$result_login['mr_purchase_price']?>">
                                </td>
                                
                                <td class="" style="text-align: left;">Central Id<span style="color:#F00"></span></td>
                                <td class="" id="insetmsg_est">
                                    <input readonly style="width: 100%;"  type="text" class="form-control time enter" id="central_id1"  name="central_id1"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="<?=$result_login['mr_central_id']?>">
                                </td>
                                
                                
                                 <td class="raw_hide_class1_barcode" style="text-align: left;display: none"> Barcode <span style="color:#F00"></span></td>
                                <td class="raw_hide_class1_barcode" style="display: none" id="insetmsg_est">
                                    <input style="width: 75%;"  type="text" class="form-control time enter" id="raw_barcode1"  name="raw_barcode1"  placeholder="" tabindex="14" data-toggle="tooltip" title=""  value="<?=$result_login['mr_raw_barcode']?>">
                                </td>
                                
                                
                              </tr>
                              
                              
                              
                              <tr>
                              <td style="text-align:left;line-height: 35px;" colspan="2">
                            <span class="chk_lable_pop" style="padding-left:3px">Active</span>
                            <span style="position:relative;top:4px;"><input type="checkbox" class="enter" value="<?=$result_login['mr_active']?>" tabindex="16" name="active1"  id="active1<?=$result_login['mr_menuid']?>" data-toggle="tooltip" title="active" <?php if($result_login['mr_active']=="Y") { ?> checked <?php } ?> ></span>
                                
                            
                             <span style="padding: 0 3px 0 3%;" class="chk_lable_pop raw_hide_class1">Dynamic rate</span>
                            
                            <span class="raw_hide_class1" style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_manualrateentry']?>" tabindex="18" name="dynamicrate1"  id="dynamicrate1<?=$result_login['mr_manualrateentry']?>" data-toggle="tooltip" title="Dynamic rate" <?php if($result_login['mr_manualrateentry']=="Y") { ?> checked <?php } ?> ></span>
                              
                              
                            
                              </tr>
                              
                               <tr style="float:right;cursor: pointer;margin-top: -37px;margin-right: -680px" onclick="show_more1()" id="show_more1">
                                  
                               <td style="color:#0e416c;border: solid 1px;background-color: darkred;border-radius: 5px;color: white;padding: 5px;height: 20px">More</td>   
                              </tr>
                              
                              
                            </table>
                        
                        
                        
                        
                         
                        <table class="popup_add_table raw_hide_class1" width="100%" border="0" cellspacing="5" style="margin-bottom:-21px" style="margin-bottom: -6px !important;"> 
                          <tr class="more_class1" style="display:none" >
                              <td style="padding-left:7px;width: 100px">
                             Diet<span style="color:#F00"></span>
                             </td>
                             <td id="insetmsg_ediet<?=$result_login['mr_menuid']?>">
                                 <select  style="width: 33%;" data-placeholder="Diet" name="diet1" tabindex="7"  id="diet1<?=$result_login['mr_menuid']?>" class="enter form-control" data-rel="chosen" title="Diet" left>
                                      <option value=""></option>
                                         <optgroup label="Diet">
                                            <option value="Non Veg" <?php if($result_login['mr_diet']=="Non Veg") { ?> selected="selected" <?php } ?>>Non Veg</option>

                                            <option value="Veg" <?php if($result_login['mr_diet']=="Veg") { ?> selected="selected" <?php } ?>>Veg</option>
                                            <option value="General" <?php if($result_login['mr_diet']=="General") { ?> selected="selected" <?php } ?>>General</option>
                                         </optgroup>
                                    	 </select>
                             </td>
                             
                          <td style="text-align:left;width: 100px;padding-left: 9px">
                           HSN Code <span style="color:#F00"></span>
                           </td>
                           
                           <td id="insetmsg_eest<?=$result_login['mr_menuid']?>">
                               <input style="width:100%"  type="text" class="form-control time enter" id="hsn_code1<?=$result_login['mr_menuid']?>" name="hsn_code1"  placeholder="" tabindex="8"  data-toggle="tooltip" title="" value="<?=$result_login['mr_hsn']?>"  >
                           </td> 
                             
                              
                          </tr>
                             <tr class="more_class1" style="display:none">
                             <td style="text-align:left;width: 100px">
                            Est Time [Min] <span style="color:#F00"></span>
                           </td>
                           
                           <td id="insetmsg_eest<?=$result_login['mr_menuid']?>">
                             <input  type="text" class="form-control time enter" id="time1<?=$result_login['mr_menuid']?>" name="time1"  placeholder="Estimated Time(minutes)" tabindex="8"  data-toggle="tooltip" title="Estimated Time(minutes)" value="<?=$result_login['mr_time_min']?>"  >
                           </td> 
                             <td style="padding-left:10px;padding-bottom: 36px;width: 248px">Prp Mode<span style="color:#F00"></span></td>
                             <td id="insetmsg_epre<?=$result_login['mr_menuid']?>" >
                                 <select class="form-control time enter" style="margin-bottom: 26px;width: 100%" data-placeholder="Preparation Mode" name="prepmode1" tabindex="9"  id="prepmode1<?=$result_login['mr_menuid']?>" data-rel="chosen" title="Preparation Mode" left>
                                        <option value=""></option>
                                         <optgroup label="Preparation Mode">
                                            <option value="Fried" <?php if($result_login['mr_prepmode']=="Fried") { ?> selected="selected" <?php } ?>>Fried</option>

                                            <option value="Oven" <?php if($result_login['mr_prepmode']=="Oven") { ?> selected="selected" <?php } ?>>Oven</option>
                                            <option value="General" <?php if($result_login['mr_prepmode']=="General") { ?> selected="selected" <?php } ?>>General</option>
                                         </optgroup>
                                    	 </select>
                             </td> 
                              </tr>
                             
                            </table>
                        
                        
                         
                              
                        <table class="popup_add_table raw_hide_class1" width="100%" border="0" cellspacing="5" style="height:35px !important" style="margin-bottom: -6px !important;"> 
                          <tr class="more_class1" style="display:none"> 
                              
                          <td style="width:13%">Description<span style="color:#F00">*</span> 
                             </td>
                             <td width="35%" id="insetmsg_edes<?=$result_login['mr_menuid']?>"> 
                                <textarea class="form-control description enter"  id="description1<?=$result_login['mr_menuid']?>" name="description1"  placeholder="Detail Description Of  Item" tabindex="15"  data-toggle="tooltip" title="Description"  ><?=$result_login['mr_description']?></textarea>
                             </td>
                          
                          <td style="text-align:left;line-height: 25px;" colspan="2">
                              <input type="hidden" name="menuidnew" id="menuidnew" value="<?=$result_login['mr_menuid']?>" /> 
                              
                                <span style="padding: 0 3px 0 24.7%;" class="chk_lable_pop">Add-ons</span>
                                <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_add_on']?>" tabindex="17" name="addons1"  id="dynamicrate1<?=$result_login['mr_add_on']?>" data-toggle="tooltip" title="addons" <?php if($result_login['mr_add_on']=="Y") { ?> checked <?php } ?> ></span>
                            
                             
                           
                              
                              <span style="padding-left:3.4%" class="chk_lable_pop">Stock in No's</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_dailystock_in_number']?>" tabindex="19" name="stockinnumbrs1" class="stockinnumbrs1"  id="stockinnumbrs1<?=$result_login['mr_dailystock_in_number']?>" data-toggle="tooltip" title="Dynamic rate" <?php if($result_login['mr_dailystock_in_number']=="Y") { ?> checked <?php } ?> ></span>
                             
                              <span style="padding: 0 3px 0 11.8%;" class="chk_lable_pop">Stock</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_dailystock']?>" tabindex="20" name="stock1"  id="stock1<?=$result_login['mr_menuid']?>" data-toggle="tooltip" title="stock1" <?php if($result_login['mr_dailystock']=="Y") { ?> checked <?php } ?> ></span>
                              <br />
                              <span style="padding: 0 3px 0 18.3%;" class="chk_lable_pop">Show in Kod</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_show_in_kod']?>" tabindex="21" name="showkod1"  id="showkod1<?=$result_login['mr_show_in_kod']?>" data-toggle="tooltip" title="Dynamic rate" <?php if($result_login['mr_show_in_kod']=="Y") { ?> checked <?php } ?> ></span>
                            
                             <span style="padding: 0 4px 0 4%;" class="chk_lable_pop"> Excempt Tax</span>
                            
                             <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_excempt_tax']?>" tabindex="22" name="excempt1"  id="excempt1<?=$result_login['mr_excempt_tax']?>" data-toggle="tooltip" title="Exemp rate" <?php if($result_login['mr_excempt_tax']=="Y") { ?> checked <?php } ?> ></span>
                             
                              
                              <span style="padding: 0 3px 0 3%;" class="chk_lable_pop">  Print in Kot</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter" value="<?=$result_login['mr_show_in_kot_print']?>" tabindex="23" name="printin_kot1"  id="printin_kot1<?=$result_login['mr_show_in_kot_print']?>" data-toggle="tooltip" title=" Print in Kot" <?php if($result_login['mr_show_in_kot_print']=="Y") { ?> checked <?php } ?> ></span>
                              <br />
                              
                               <span style="padding: 0 3px 0 24.2%;" class="chk_lable_pop">  Barcode</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['manual_barcode']?>" tabindex="24" name="barcode_edit"  id="barcode_edit<?=$result_login['manual_barcode']?>" data-toggle="tooltip" title=" Barcode Entering" <?php if($result_login['manual_barcode']=="Y") { ?> checked <?php } ?> ></span>
                              
                              <span style="padding: 0 3px 0 7%;" class="chk_lable_pop"> Recipe Add</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_ingredient']?>" tabindex="25" name="ingredient_edit"  id="ingredient_edit<?=$result_login['mr_ingredient']?>" data-toggle="tooltip" title=" Recipes Adding" <?php if($result_login['mr_ingredient']=="Y") { ?> checked <?php } ?> ></span>
                              
                              
                               <span style="padding: 0 3px 0 3%;display: none" class="chk_lable_pop"> Finished_Good</span>
                            
                              <span style="position:relative;top:4px;display: none"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_product_type']?>" tabindex="26" name="finished_edit12"  id="finished_edit12<?=$result_login['mr_product_type']?>" data-toggle="tooltip" title=" Finished Good Adding" <?php if($result_login['mr_product_type']=="FG") { ?> checked <?php } ?> ></span>
                          
                              
                              <span style="padding: 0 3px 0 6.3%;" class="chk_lable_pop">Qr Menu</span>
                            
                              <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_qr_set']?>"  tabindex="26" name="qr_menu_edit"  id="qr_menu_edit<?=$result_login['mr_qr_set']?>" data-toggle="tooltip" title="Enable Qr Item" <?php if($result_login['mr_qr_set']=="Y") { ?> checked <?php } ?> ></span>
                            
                              <br />
                                &nbsp;  &nbsp;  &nbsp; 
                               <span style="padding: 0 3px 0 12.6%;" class="chk_lable_pop">Exc Discount</span>
                            
                           <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_excempt_disc']?>"  tabindex="26" name="exc_disc_edit"  id="exc_disc_edit<?=$result_login['mr_excempt_disc']?>" data-toggle="tooltip" title="Enable Exc Discount Item" <?php if($result_login['mr_excempt_disc']=="Y") { ?> checked <?php } ?> ></span>
                            
                           <span style="padding: 0 3px 0 9.7%;" class="chk_lable_pop">Stock Inv</span>
                            
                           <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_stock_inventory']?>"  tabindex="26" name="stock_inv_edit"  id="stock_inv_edit<?=$result_login['mr_stock_inventory']?>" data-toggle="tooltip" title="Enable Stock Inventory Check" <?php if($result_login['mr_stock_inventory']=="Y") { ?> checked <?php } ?> ></span>
                            
                           
                           <span style="padding: 0 3px 0 1.5%;" class="chk_lable_pop">Stock In-Out </span>
                            
                           <span style="position:relative;top:4px;"> <input type="checkbox" class="enter"  value="<?=$result_login['mr_stock_in_out']?>"  tabindex="26" name="stock_in_out_edit"  id="stock_in_out_edit<?=$result_login['mr_stock_in_out']?>" data-toggle="tooltip" title="Enable Stock In Out on dayclose" <?php if($result_login['mr_stock_in_out']=="Y") { ?> checked <?php } ?> ></span>
                            
                           
                           
                             </td>
                             
                             
                             </tr>
                             
                            </table>
                        
                        
                      
                        
                        <table class="popup_add_table" width="100%" border="0" cellspacing="5" style="margin-bottom: -6px !important;">  
                         
                            <tbody style="bottom: -40px;right: 0px;position: absolute;margin-bottom: 0px;display: inline-block">
                            <tr style="float:right;display: none;cursor: pointer;" onclick="show_less1()" id="show_less1">
                               <td style="color:#0e416c;border: solid 1px;background-color: darkred;border-radius: 5px;color: white;padding: 5px;height: 20px">Less</td>  
                              </tr>
                              </tbody>
                             </table>
                        
                        
                             </div>
                                    <input type="hidden" id="mr_mn_id" name="mr_menuid" value="<?=$result_login['mr_menuid']?>">
                                    <a tabindex="27" class="entersubmit enter"  onClick="update_registration('<?=$result_login['mr_menuid']?>')"><span class="md-save newbut" >Update</span></a>
                  
                             </div>
			</div>
                            </form>
            <?php } } ?>  
            </div>  
            <script type="text/javascript">
$(document).ready(function(){
    
    
    
	  var type   = $("#finished_edit").val();
		
              var cat=  $('#search_cat_id').val();
          
        var menu=$('#search_menu_id').val();
        
       
	if(type=='Menu'){
            $("#inv_star1").show();
             $(".raw_hide_class1").show();
               show_less1();
               
              $(".reorder_hide_class1").hide();    
            $(".purchase_hide_class1").show();   
               $(".raw_hide_class1_barcode").hide(); 
             $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=menu&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
                    });
               
            
        }else if(type=='Finished'){
            
            $("#inv_star1").show();
             $(".raw_hide_class1").show();
               show_less1();
               
                $(".reorder_hide_class1").show();    
            $(".purchase_hide_class1").hide(); 
               $(".raw_hide_class1_barcode").show(); 
             $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=finished&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                           
                            
                            
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
                    });
            
        }else if(type=='Raw'){
            $("#inv_star1").hide();
             $(".raw_hide_class1").hide();
           show_less1();
              $(".raw_hide_class1_barcode").show(); 
            $(".reorder_hide_class1").show();    
            $(".purchase_hide_class1").show(); 
            
              $("#show_more1").hide();
             $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=Raw&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
                    });
            
            
        }
	});
        
        
    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $('.md-close_pop').click();
    
    
    });
    
    
   
    
    
    
    
    $("#finished_edit").change(function(){
	
	 var menu=$('#search_menu_id').val();
         
	  var type   =  $(this).val();
          
          
          var cat=  $('#search_cat_id').val();
          
        
		
	if(type=='Menu'){
            $("#inv_star1").show();
             $(".raw_hide_class1").show();
               show_less1();
                $(".reorder_hide_class1").hide();    
            $(".purchase_hide_class1").show(); 
             $(".raw_hide_class1_barcode").hide(); 
            
             $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=menu&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
                    });
            
        }else if(type=='Finished'){
           
              $("#inv_star1").show();
             $(".raw_hide_class1").show();
               show_less1();
               
              $(".reorder_hide_class1").show();    
              $(".purchase_hide_class1").hide();  
              $(".raw_hide_class1_barcode").show(); 
              $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=finished&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                           
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
            });
               
        }else if(type=='Raw'){ 
             $("#inv_star1").hide();
             $(".raw_hide_class1").hide();
           show_less1();
             $(".reorder_hide_class1").show();    
            $(".purchase_hide_class1").show(); 
               $(".raw_hide_class1_barcode").show(); 
             $("#show_more1").hide();
             
         
             $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=menu_type_check_edit&type=Raw&cat="+cat+"&menu="+menu,
			success: function(msg)
			{
                            $('.main_cat_type'+menu).html($.trim(msg));
                            
                        }
                    });
        }
	
   });     
    
                            
              $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
    setTimeout(function(){
      $("#menuname1100").focus();
      },0);  
        
     $(".enter").keypress(function(event){
    if(event.keyCode==13){
        var mr_mn_id=$("#mr_mn_id").val();
        update_registration(mr_mn_id);
    }
    });   
        
        
      
        
        
        
    function show_more1(){
        
          $('#show_more1').hide();
          $('#show_less1').show();
       
          $('.more_class1').show();   
          
        if($('#finished_edit').val()=='Raw'){ 
             $('.raw_hide_class1').hide(); 
         }else{
               $('.raw_hide_class1').show();  
         }
          
    }
    
    
    function show_less1(){
        $('#show_less1').hide();
            $('#show_more1').show();
        
         $('.more_class1').hide();
    } 
        
        
        
      
        
        
      function validitemcode1(id)
       { 
         if($("#item_shortcode1"+id).val()!="")
      {
	var id1=id;

        var ts1=$("#item_shortcode1"+id).val().trim();
                
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkitemcodedit&shortcode="+ts1+"&tsid="+id1,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#menuchk1');
			if(data =="sorry")
			{
                            
		// namechk.text('Order of Print Already exists');
                 alert('Item Code Already exists');
                  $("#item_shortcode1_div"+id).addClass("has-error");	        
                  $("#item_shortcode1_div"+id).focus();
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#item_shortcode1_div"+id).removeClass("has-error");
	   $("#item_shortcode1_div"+id).addClass("has-success");
	  	//alert('aa');
			}
			}
		}); 

        }                   
}  
        
                
                
	function valimenu1(id)
           {
			var id1=id;
	        var ab=$(".menunames").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkmenuedit&menid="+ab+"&idnew="+id1,
			success: function(data)
			{
			data=$.trim(data);
			/*alert(data);*/
			var menuchk=$('#menuchk');
			if(data =="sorry")
			{
		   menuchk.text('Already exists');
		   $("#insetmsg_emenu"+id).addClass("has-error");
	           $("#menuname1"+id).focus();
	
			}
			else
			{
                            
                         var plu=$("#plu_code1").val();
	
	                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkplu_edit&mid1="+plu+"&id1="+id1,
			success: function(msg)
			{ 
			msg=$.trim(msg);
				 var namechk=$('#menuchk');
                               
				if(msg =="sorry")
					{
			alert('PLU Already exists');
			  
	                   $("#plu_code1").focus();
                          
					}
					else
                                        
					{
                                            
                              var central_id1=$("#central_id1").val();
	
	                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcentral_edit&mid1="+central_id1+"&id1="+id1,
			success: function(msg)
			{ 
			msg=$.trim(msg);
				 var namechk=$('#menuchk');
                               
				if(msg =="sorry" && central_id1!='' )
					{
			 alert('Central Kitchen Id Exist');
			  
	                   $("#central_id1").focus();
                          
					}
					else
                                        
					{                  
                                            
              menuchk.text('');
	   $("#insetmsg_emenu"+id).removeClass("has-error");
	   $("#insetmsg_emenu"+id).addClass("has-success");
	   $("#menu_masteredit"+id).submit();
           localStorage.menuname=$('#mname').val();
           localStorage.catname=$('#mcate').val();
           localStorage.subcatname=$('#msubc').val();
           localStorage.diet=$('#mdiet').val();
           localStorage.stat=$('#mstatus').val();
           
                                        }
                                    } });
           
           
           
           
           
		}
		}
		});    
                            
           
			}
			}
		});
}

function update_registration(id)
{  

	if(validate_emenu(id))
	{ 
		if(validate_eshrtcode(id))
		{
                    if(validate_eitemshrtcode(id))
		{
			if(validate_ekot(id))
			{
				if(validate_emainct(id))
				{
					if(validate_ediet(id))
					{
						if(validate_etime(id))
						{ 
							if(validate_eprepmode(id))
							{ 
                                                            if(validate_unit_type(id)){
                                                                
                                                                if(validate_baeseunit(id)){
                                                                    
                                                                
                                                                     if(validate_estore(id)){
                                                                         
                                                                    if(valimenu1(id))
                                                                    {

                                                                    }
                                                                }  
                                                                
                                                            }
                                                            } 
								/*if(validate_edes(id))
								{*/
									//$("#menu_masteredit"+id).submit();
									//$('.md-close').click();
                                                                    		
								/*}*/
                                                            }
							}
						}
					}
				}
			}
		}
	}
}

function validate_emenu(id)   
{
  if($("#menuname1"+id).val()=="")
  {
	  $("#insetmsg_emenu"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#menuname1"+id).focus();
          //alert("Enter Menu Name");
          
           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Enter Name');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
  }
  
                 var alphanumers = /^[a-zA-Z0-9 _.]+$/;
                  if(!alphanumers.test($("#menuname1"+id).val())){
                  $("#insetmsg_emenu"+id).addClass("has-error");
                   $("#menuname1"+id).focus();
                          alert("Special character Not Allowed.");
                   }
        
        else
   {
	   $("#insetmsg_emenu"+id).removeClass("has-error");
	   $("#insetmsg_emenu"+id).addClass("has-success");
	   return true;
    }
   }

function validate_eshrtcode(id)   
{
  if($("#shortcode1"+id).val()=="")
  {
	  $("#insetmsg_esht"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	     $('.has-error').css("webkit-box-shadow","none");
	      $("#shortcode1"+id).focus();
              alert("Enter Short Code");
              
	  return false;
  }

  
            var alphanumers = /^[a-zA-Z0-9 _.]+$/;
                  if(!alphanumers.test($("#shortcode1"+id).val())){
                  $("#insetmsg_esht"+id).addClass("has-error");
                   $("#shortcode1"+id).focus();
                          alert("Special charecter Not Allowed.");
                   }
        
        else
   {
	   $("#insetmsg_esht"+id).removeClass("has-error");
	   $("#insetmsg_esht"+id).addClass("has-success");
	   return true;
    }
   }
   
   function validate_eitemshrtcode(id)   
{
   // var id=$("#menuidnew").val();
if($("#item_shortcode1"+id).val()=="")
  {
//	  $("#item_shortcode1_div"+id).addClass("has-error");
//	   $('.has-error').css("border","none");
//	    $('.has-error').css("box-shadow","none");
//	     $('.has-error').css("webkit-box-shadow","none");
//	      $("#item_shortcode1"+id).focus();
//              alert("Enter Item Code");
//	  return false;
 return true;
        }
  
            var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#item_shortcode1"+id).val())){
                  $("#item_shortcode1_div"+id).addClass("has-error");
                   $("#item_shortcode1"+id).focus();
                          alert("Special charecter Not Allowed.");
                   }
        
        else
   {
	   $("#item_shortcode1_div"+id).removeClass("has-error");
	   $("#item_shortcode1_div"+id).addClass("has-success");
	   return true;

          var id1=id;

        var ts1=$("#item_shortcode1"+id).val().trim();
                
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkitemcodedit&shortcode="+ts1+"&tsid="+id1,
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#menuchk1');
			if(data =="sorry")
			{
                            
		
                 alert('Item Code Already exists');
                  $("#item_shortcode1_div"+id).addClass("has-error");	        
                  $("#item_shortcode1_div"+id).focus();
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#item_shortcode1_div"+id).removeClass("has-error");
	   $("#item_shortcode1_div"+id).addClass("has-success");
	  	//alert('aa');
			}
			}
		}); 


    }
}

function validate_ekot(id)   
{
  if($("#kotcounter1"+id).val()=="" && $("#finished_edit").val()!="Raw")
  {
	  $("#insetmsg_ekot"+id).addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#kotcounter1"+id).focus();
          //alert("Select Kitchen");
          
           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Kitchen ');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
  }
       
//       var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                  if(!alphanumers.test($("#kotcounter1"+id).val())){
//                  $("#insetmsg_ekot"+id).addClass("has-error");
//                  $("#kotcounter1"+id).focus();
////                          alert("Special charecter Not Allowed.");
//                   }
        
        else
   {
	   $("#insetmsg_ekot"+id).removeClass("has-error");
	   $("#insetmsg_ekot"+id).addClass("has-success");
	   return true;
    }
   }
   
   function validate_estore(id)   
{
  if($("#inv_kitchen1").val()=="0" && $("#finished_edit").val()!="Raw")
  {
	  //$("#insetmsg_ekot"+id).addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#inv_kitchen1").focus();
         // alert("Select Store");
          
           $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Store ');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
  }else
   {
	   $("#insetmsg_ekot"+id).removeClass("has-error");
	   $("#insetmsg_ekot"+id).addClass("has-success");
	   return true;
    }
   }
   

function validate_emainct(id)   
{  
    
   
  if($("#maincat1"+id).val()=="")
  {
	  $("#insetmsg_emain"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#maincat1"+id).focus();
        //  alert("Select Main Category");
          
          $(".alert_error_popup_all_in_one_menu").show();
           $(".alert_error_popup_all_in_one_menu").text('Select Main Category');
           $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
  }else
   {
	   $("#insetmsg_emain"+id).removeClass("has-error");
	   $("#insetmsg_emain"+id).addClass("has-success");
	   return true;
    }
  }

function validate_ediet(id)   
{
  if($("#diet1"+id).val()=="")
  {
	  $("#insetmsg_ediet"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#diet1"+id).focus();
          alert("Edit Diet");
	  return false;
  }
                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#diet1"+id).val())){
                  $("#insetmsg_ediet"+id).addClass("has-error");
                 $("#diet1"+id).focus();
                          alert("Special charecter Not Allowed.");
                   }
        
        else
   {
	   $("#insetmsg_ediet"+id).removeClass("has-error");
	   $("#insetmsg_ediet"+id).addClass("has-success");
	   return true;
    }
   }

function validate_edes(id)   
{
  if($("#description1"+id).val()=="")
  {
	  $("#insetmsg_edes"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#description1"+id).focus();
	  return false;
  }else
   {
	   $("#insetmsg_edes"+id).removeClass("has-error");
	   $("#insetmsg_edes"+id).addClass("has-success");
	   return true;
   }
}
//insetmsg_emenu insetmsg_esht insetmsg_ekot insetmsg_emain insetmsg_esub insetmsg_ediet insetmsg_eest insetmsg_epre
//menuname1 shortcode1 kotcounter1 maincat1 subcat1 diet1 time1 prepmode1
//  

function validate_etime(id)   
{
  if($("#time1"+id).val()=="")
  {
	  $("#insetmsg_eest"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#time1"+id).focus();
          alert("Enter Estimated Time");
	  return false;
  }
        
           var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#time1"+id).val())){
                  $("#insetmsg_eest"+id).addClass("has-error");
                $("#time1"+id).focus();
                          alert("Special charecter Not Allowed.");
                   }
        else
    {
	   $("#insetmsg_eest"+id).removeClass("has-error");
	   $("#insetmsg_eest"+id).addClass("has-success");
	   return true;
    }
  }

function validate_eprepmode(id)   
{
  if($("#prepmode1"+id).val()=="")
  {
	  $("#insetmsg_epre"+id).addClass("has-error");
	   $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
		$('.has-error').css("webkit-box-shadow","none");
	  $("#prepmode1"+id).focus();
          alert("Select Preparation Mode");
	  return false;
  }
  
         var alphanumers = /^[a-zA-Z0-9 ]+$/;
                  if(!alphanumers.test($("#prepmode1"+id).val())){
                  $("#insetmsg_eest"+id).addClass("has-error");
                $("#insetmsg_epre"+id).focus();
                          alert("Special charecter Not Allowed.");
                   }
        
        else
   {
	   $("#insetmsg_epre"+id).removeClass("has-error");
	   $("#insetmsg_epre"+id).addClass("has-success");
	   return true;
   }
}

function portionunit_selection(a)
        {
            //alert(a);
            if(a=='Unit')
            {
            $(".baseunit_select").prop("disabled", false); 
            $(".unittype_selection").prop("disabled", false); 
            }
            else if(a=='Portion')
            { 
             $(".baseunit_select").val("");
             $(".unittype_selection").val("");
             $(".baseunit_select").prop("disabled", true);
             $(".unittype_selection").prop("disabled", true);
            }

        }
function unit_type_selection(unit_type){
            //alert(unit_type);
            if(unit_type.trim()=='Loose'){
                $(".stockinnumbrs1").attr("checked",false);
                $(".stockinnumbrs1").attr("disabled",true);
            }
            else{
                $(".stockinnumbrs1").attr("disabled",false);
            }
        }
function validate_baeseunit(id){
    
    if($("#ratetype"+id).val()=="Unit")
  {     
        if($("#baseunitselect"+id).val()==''){
            
         var feildid="baseunitselect"+id;
         
         
	  $("#insetmsg_baseunit"+id).addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
            $("#baseunitselect"+id).focus();
	  //document.menu.feildid.focus();
        //  alert("Select Base Unit");
          
          $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Base Unit ');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
          
	  return false;
      }
      else
   {
	   $("#insetmsg_baseunit"+id).removeClass("has-error");
	   $("#insetmsg_baseunit"+id).addClass("has-success");
	   return true;
   }
  }
  else{
      return true;
  }
    
}
function validate_unit_type(id){
    
    if($("#ratetype"+id).val()=="Unit")
  {     
        //alert($(".unt").val());
        if($(".unt").val()==''){
        
	  $("#insetmsg_unittype"+id).addClass("has-error");
	  $('.has-error').css("border","none");
	    $('.has-error').css("box-shadow","none");
	  document.menu.unittype_selection.focus();
        //  alert("Select  Unit Type");
          
          $(".alert_error_popup_all_in_one_menu").show();
                                          $(".alert_error_popup_all_in_one_menu").text('Select Unit Type ');
                                         $(".alert_error_popup_all_in_one_menu").delay(500).fadeOut('slow');
          
	  return false;
      }
      else
   {
	   $("#insetmsg_unittype"+id).removeClass("has-error");
	   $("#insetmsg_unittype"+id).addClass("has-success");
	   return true;
   }
  }
  else{
      return true;
  }
    
}


$(document).ready(function(){
    
                 //alert($('#ratetype'+$('#search_menu_id').val())); 
                if($('#ratetype'+$('#search_menu_id').val()).val()=='Portion'){
                        
                     $(".baseunit_select").prop("disabled", true); 
                     $(".unittype_selection").prop("disabled", true);
                     $(".unittype_selection").val("");
                 }
                 else{
                     
                     $(".baseunit_select").prop("disabled", false); 
                     $(".unittype_selection").prop("disabled", false);
                     
                 }
                 
                 //alert($('.unt').val());
                 if($('.unt').val()=='Loose'){
                     //alert('2');
                     $(".stockinnumbrs1").attr("checked",false);
                    $(".stockinnumbrs1").attr("disabled",true);
                }
                else{
                    $(".stockinnumbrs1").attr("disabled",false);
                }
                 
            });
            
            
     function menu_enter_edit(i){
        var menu_edit_copy= $("#menuname1"+i).val();
        
          var menu=menu_edit_copy.substr(0, 19);
          
        $("#shortcode1"+i).val(menu);
     }       
            
</script>

