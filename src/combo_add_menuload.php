<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
//$value		= $_REQUEST['value'];
include("api_multiplelanguage_link.php");
$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
error_reporting(0); 
 

$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnameonly')
  {
	 
 
 		/* **************************************Search menu name****************************************************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
      // print($_SESSION['floorid']);
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid  WHERE tbl_menumaster.mr_menuname LIKE '".$name."%'    and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and mc.mmy_active='Y' group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	 //echo "select * from tbl_menumaster LEFT JOIN tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid WHERE (tbl_menumaster.mr_menuname	 LIKE '".$name."%'  )   and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"; 
         $num_login   = $database->mysqlNumRows($sql_login);
        
	  if($num_login){  
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                       $portnstock1 = "N";
                                           $sql_menuportion11 = "SELECT * from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions11 = $database->mysqlQuery($sql_menuportion11);
                                            $num_portions11 = $database->mysqlNumRows($sql_portions11);
                                            if ($num_portions11) {
                                                $portnstock1 = "Y";
                                                //$catid['portion']='Y';
                                            } 
                                            
                      
                      
                      
                      
				$sts='';
				if($portnstock1=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  
	  
	  
	  
	
		echo json_encode($data);
	flush();
 
    
  }
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='menu_label_load')  {
   
                                    $sql_menu_labels_display =  $database->mysqlQuery("select * from tbl_combo_menu_labels order by cml_id asc "); 
                                    //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                                    $num_menu_labels_display  = $database->mysqlNumRows($sql_menu_labels_display);
                                    if($num_menu_labels_display){$i=0;
                                        while($result_menu_labels_display=$database->mysqlFetchArray($sql_menu_labels_display)){
                                            $i++;
                                            ?>
                                <tr id="" class="">
                                    <td width="5%"><?=$i?></td>
                                    <td><?=$result_menu_labels_display['cml_label']?></td>
                                    <td width="13%">
                                    <a class="tbl_del_combo" onclick="return label_delete(<?=$result_menu_labels_display['cml_id']?>)" id="<?=$result_menu_labels_display['cml_id']?>" href="#"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php
                                    }} ?>
                                
   
 <?php
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='menu_first_load'){
    $onload_row_pack_id= $_REQUEST['onload_row_pack_id'];
    $onload_combo_id=$_REQUEST['onload_combo_id'];
    $onload_combo_type=$_REQUEST['onload_combo_type'];
    $sql_combo_menu_display =  $database->mysqlQuery("select cpm.*,mm.mr_menuname,cml.cml_label,cml.cml_id from tbl_combo_pack_menus cpm 
                                                     left join tbl_menumaster mm on mm.mr_menuid=cpm.cpm_menu_id 
                                                     left join tbl_combo_menu_labels cml on cml.cml_id=cpm.cpm_menu_type_label_id
                                                    where cpm_combo_pack_id='".$onload_row_pack_id."' and cpm_combo_id='".$onload_combo_id."' order by cpm_id asc "); 
//                                    echo "select cpm.*,mm.mr_menuname,cml.cml_label from tbl_combo_pack_menus cpm 
//                                                     left join tbl_menumaster mm on mm.mr_menuid=cpm.cpm_menu_id 
//                                                     left join tbl_combo_menu_labels cml on cml.cml_id=cpm.cpm_menu_type_label_id
//                                                    where cpm_combo_pack_id='".$onload_row_pack_id."' and cpm_combo_id='".$onload_combo_id."'";
                                    $num_combo_menu_display  = $database->mysqlNumRows($sql_combo_menu_display);
                                    if($num_combo_menu_display){$i=0;
                                        while($result_combo_menu_display=$database->mysqlFetchArray($sql_combo_menu_display)){
                                            $i++;
                                   
                                        ?>
                                          
                                        <tr id="each_menu_row_<?=$result_combo_menu_display['cpm_id']?>" >
                                           <td><?=$i?></td>
                                           <td class="combo_menu_column" id="<?=$result_combo_menu_display['cpm_menu_id']?>"><?=$result_combo_menu_display['mr_menuname']?></td>
                                           <?php if($onload_combo_type==3){
                                            ?>
                                           <td class="combo_menu_type_column" ><?=$result_combo_menu_display['cpm_menu_sale_type']?></td>
                                           <td  class="combo_menu_option_column" id="<?=$result_combo_menu_display['cml_id']?>"><?=$result_combo_menu_display['cml_label']?></td>
                                           <?php } if($onload_combo_type==2 || $onload_combo_type==3){
                                            ?>
                                           <td  class="combo_menu_qty_column"><?=$result_combo_menu_display['cpm_menu_qty']?></td>
                                            <?php } ?>
                                           <td><?php if($result_combo_menu_display['cpm_menu_active']=='Y'){ echo 'YES';}else { echo 'NO';}?></td>
                                           <td >
                                               <a href="#" class="md-trigger_prfrnc" onclick="return combo_menu_edit(<?=$result_combo_menu_display['cpm_id']?>)" ><img src="images/edit_page.PNG"></a>
                                               <a class="tbl_del_combo" onclick="return combo_menu_delete(<?=$result_combo_menu_display['cpm_id']?>)" href ><i class="glyphicon glyphicon-trash"></i></a>
                                               <?php if($result_combo_menu_display['cpm_menu_active']=='Y'){ ?>
                                                <a class="tab_edt_btn" onclick="return combo_menu_status_change('N',<?=$result_combo_menu_display['cpm_id']?>)"  href ><i class="icontick"><img src="img/red_cross.png" width="23px" height="23px"></i></a>
                                                <?php } if($result_combo_menu_display['cpm_menu_active']=='N'){ ?>
                                                <a class="tab_edt_btn" onclick="return combo_menu_status_change('Y',<?=$result_combo_menu_display['cpm_id']?>)"  href ><i class="icontick"><img src="img/green_tick.png" width="23px" height="23px"></i></a>
                                                <?php }?>
                                           </td>
                                         </tr>
<?php 
 }}
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='option_div_refresh'){
    ?>

                                <option value=''>Select option Label</option>
                                    <?php
                                    $sql_combo_menu_labels =  $database->mysqlQuery("select * from tbl_combo_menu_labels where cml_active='Y' order cml_id asc "); 
                                    //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                                    $num_combo_menu_labels  = $database->mysqlNumRows($sql_combo_menu_labels);
                                    if($num_combo_menu_labels){$i=0;
                                        while($result_combo_menu_labels=$database->mysqlFetchArray($sql_combo_menu_labels)){
                                        ?>
                                            <option value="<?=$result_combo_menu_labels['cml_id']?>"><?=$result_combo_menu_labels['cml_label']?></option>
                                        <?php
                                        }
                                    }
                                            
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_rate_addpopup'){
    $combo_pack_id=$_REQUEST['combo_pack_id'];
    $mode=$_REQUEST['mode'];
    $dine_in_flr_name='';
    $dine_in_query='';

?>

     <span id="home" class="current" style="display: block;">
            <span class="tab_sub_head rate-popup-head" style="">
               <span class="form-group" style="width:90% !important;">
                    <?php if($mode=='DI') { ?>
                  <span class="col-sm-3 tab_text_box_cc no-padding" id="floor_selection_span" style="display:block;float:left;    width: 20% !important;">
                     <select data-placeholder="Enter Area" id="dineinfloor" name="dineinfloor" data-rel="chosen" title=""  data-toggle="tooltip" class="form-control add_new_dropdown dineinselect" data-original-title="">
                        <option value="">--Select Area--</option>
                        <?php
                            $sql_floor_display =  $database->mysqlQuery("SELECT `fr_floorid`,`fr_floorname` FROM `tbl_floormaster` WHERE `fr_status`='Active' order by fr_floorid asc "); 
                            $num_floor_display  = $database->mysqlNumRows($sql_floor_display);
                            if($num_floor_display){$i=0;
                            while($result_floor_display=$database->mysqlFetchArray($sql_floor_display)){
                            $i++;
                        ?>
                                <option value="<?=$result_floor_display['fr_floorid']?>"><?=$result_floor_display['fr_floorname']?></option>
                        <?php
                            }}
                        ?>
                     </select>
                  </span>
                    <?php } ?>
                  
                   <?php if($mode=='TA') { ?>
                   <span class="col-sm-3 tab_text_box_cc no-padding" id="ta_online_div" style="display:block;float:left;    width: 20% !important;">
                     <select data-placeholder="" id="ta_online" name="ta_online" data-rel="chosen" title=""  data-toggle="tooltip" class="form-control add_new_dropdown" data-original-title="">
                        <option value="">-Select Online-</option>
                        <?php
                            $sql_floor_display1 =  $database->mysqlQuery("SELECT * FROM `tbl_online_order` WHERE `tol_status`='Y' "); 
                            $num_floor_display1  = $database->mysqlNumRows($sql_floor_display1);
                            if($num_floor_display1){$i=0;
                            while($result_floor_display1=$database->mysqlFetchArray($sql_floor_display1)){
                            $i++;
                        ?>
                                <option value="<?=$result_floor_display1['tol_id']?>"><?=$result_floor_display1['tol_name']?></option>
                        <?php
                            }}
                        ?>
                     </select>
                  </span>
                    <?php } ?>
                   
                   
                   
                 
                  <span class="col-sm-3 tab_text_box_cc  no-padding" id="diratespan" style="display:inline-block;float:left;width:23% !important">
                  <input type="text" class="form-control" value="" id="dineinrate" name="dineinrate" placeholder="Rate">
                  </span>  
                    <?php
                        $sql_combo_pack_check =  $database->mysqlQuery("SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."'"); 
                        $num_combo_pack_check  = $database->mysqlNumRows($sql_combo_pack_check);
                        if(!$num_combo_pack_check){ ?>
                        <span class="col-sm-3 tab_text_box_cc  no-padding" id="apply_all_span" style="display:inline-block;float:left;width:18% !important">
                           <label style="color: #000"><input style="position: relative;top: 2px;" id="apply_all" type="checkbox"> Apply for All </label>
                       </span>
                        <?php } ?>
               </span>
               <span class="col-sm-1 nopadding" style="  margin:0px 0 -6px 0;display: inline-block;float: left;">
               <span class="search_btn_member_invoice" style="margin-left:0"><a href="#" onclick="return rate_add()" id="rate_add_btn" style="display:block;">ADD</a></span>
                               
               </span>
               <span id="status" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;"></span>  
            </span>
            <!---->
            <span class="tab_table_cont_cc">
               <table class="responstable" id="dinein">
                  <thead>
                     <tr>
                        <?php if($mode=='DI') {
                         $dine_in_query=" left join tbl_floormaster on fr_floorid=cpr_floor_id ";
                         $dine_in_flr_name=" ,fr_floorname "
                         ?>
                        <th>
                           Floor
                        </th>
                         <?php } ?>
                        
                         <?php if($mode=='TA') {
                         $ta_in_query=" left join tbl_online_order on tol_id=cpr_online_id ";
                         $ta_in_flr_name=" ,tol_name "
                         ?>
                        <th>
                          Online
                        </th>
                         <?php } ?>
                        
                        <th>Rate</th>
                        <th>Edit</th>
                     </tr>
                  </thead>
                  <tbody>
                        <?php
                            $sql_rate_display =  $database->mysqlQuery("SELECT cpr_online_id ,`cpr_id`, `cpr_combo_pack_id`, `cpr_combo_id`, `cpr_floor_id`, `cpr_mode`, `cpr_rate` $dine_in_flr_name $ta_in_flr_name FROM `tbl_combo_pack_rates` $dine_in_query $ta_in_query WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_mode`='".$mode."' order by cpr_id asc "); 
                            
//echo "SELECT `cpr_id`, `cpr_combo_pack_id`, `cpr_combo_id`, `cpr_floor_id`, `cpr_mode`, `cpr_rate` $dine_in_flr_name $ta_in_flr_name FROM `tbl_combo_pack_rates` $dine_in_query $ta_in_query WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_mode`='".$mode."' order by cpr_id asc ";
//echo " SELECT `cpr_id`, `cpr_combo_pack_id`, `cpr_combo_id`, `cpr_floor_id`, `cpr_mode`, `cpr_rate` $dine_in_flr_name FROM `tbl_combo_pack_rates` $dine_in_query WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_mode`='".$mode."' order by cpr_id asc ";
                            $num_rate_display  = $database->mysqlNumRows($sql_rate_display);
                            if($num_rate_display){$i=0;
                            while($result_rate_display=$database->mysqlFetchArray($sql_rate_display)){
                            $i++;
                        ?>
                     <tr>
                        <?php if($mode=='DI') { ?> <td><?=$result_rate_display['fr_floorname']?></td><?php } ?>
                         <?php if($mode=='TA') { ?> <td><?=$result_rate_display['tol_name']?></td><?php } ?>
                        <td><?=$result_rate_display['cpr_rate']?></td>
                        <td> 
                            <a class="tab_edt_btn5 rate_delete_btn" href="#" onclick=" return delete_combo_rate(<?=$result_rate_display['cpr_id']?>)" ><i class="glyphicon glyphicon-trash"></i></a>
                            <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" onclick=" return edit_combo_rate('<?=$result_rate_display["cpr_id"]?>','<?=$result_rate_display["cpr_rate"]?>','<?=$result_rate_display["cpr_floor_id"]?>','<?=$result_rate_display["cpr_online_id"]?>')" href="#"><i class="fa fa-edit"></i></a>
                            <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate" href="#"><i class="fa fa-edit"></i></a>
                        </td>
                     </tr>
                        <?php 
                        }}
                        ?>
                     
                  </tbody>
               </table>
            </span>
            <!--tab_table_cont_cc-->
         </span>
<?php
}

  ?>

