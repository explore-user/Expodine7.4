<?php

session_start();
//error_reporting(0);
include("database.class.php"); 
$database	= new Database();
if(isset($_REQUEST['set_add_load'])&& ($_REQUEST['set_add_load']=='add_load')){
    
    
                                
                       $sql_cat_s  =  $database->mysqlQuery("select * from  tbl_menu_discount left join tbl_discountmaster on ds_discountid= md_discount where md_menuid='".$_REQUEST['menu_ds_id']."'");

           $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){
		while($result_ds_view  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
               
			                                      
							 <tr>
							 <td><?=$result_ds_view['ds_discountname']?></td>
							 <td><?=$result_ds_view['md_di_active']?></td>
							  <td><?=$result_ds_view['md_ta_active']?></td>
							  <td><?=$result_ds_view['md_cs_active']?></td>
                                                           <td><?=$result_ds_view['md_date_limit']?></td><!--
-->							  <td><?=$result_ds_view['md_from_date']?></td><!--
-->							  <td><?=$result_ds_view['md_to_date']?></td><!--
							 
-->							    <td><?=$result_ds_view['md_time_limit']?></td><!--
-->							  <td><?=$result_ds_view['md_from_time']?></td><!--
-->							  <td><?=$result_ds_view['md_to_time']?></td><!--
                                                          
                                                          <td><?//=$result_ds_view['md_day_limit']?></td>
							  <td><?//=$result_ds_view['md_day']?></td>-->
                                                           <td><?=$result_ds_view['md_active']?></td>
							<td> 
								
								<a onclick="return edit_discount('<?=$result_ds_view['md_discount']?>','<?=$result_ds_view['md_di_active']?>','<?=$result_ds_view['md_ta_active']?>','<?=$result_ds_view['md_cs_active']?>','<?=$result_ds_view['md_date_limit']?>','<?=$result_ds_view['md_from_date']?>','<?=$result_ds_view['md_to_date']?>','<?=$result_ds_view['md_active']?>','<?=$result_ds_view['md_slno']?>','<?=$result_ds_view['md_time_limit']?>','<?=$result_ds_view['md_day_limit']?>','<?=$result_ds_view['md_from_time']?>','<?=$result_ds_view['md_to_time']?>','<?=$result_ds_view['md_day']?>');" style="font-size: 18px;padding-left: 10px;display: inline-block ;"  href="#"><i class="fa fa-edit"></i></a>
								
							</td>
						  </tr>
<?php } } }?>
    
    

