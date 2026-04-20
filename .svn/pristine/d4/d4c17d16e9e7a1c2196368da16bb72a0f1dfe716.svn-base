<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();

if($_REQUEST['set']=="insert")
{
/*print_r( $_REQUEST['permisn']);
print_r( $_REQUEST['permisn_sub']);
echo $_REQUEST['stf'];*/

$mainmod=$_REQUEST['permisn'];
$submod=$_REQUEST['permisn_sub'];
$stf=$_REQUEST['stf'];


 $sql_submod  =  $database->mysqlQuery("DELETE  from tbl_usermodules where um_username='".$stf."'"); 

foreach( $mainmod as $key => $value){
	unset($mainarr);
	$mainarr=array();
	//`tbl_modulesubmaster`(`mser_submoduleid`, `mser_moduleid`, `mser_subname`, `mser_submodulelink`)
		$insertion['um_username'] =$stf;
        $insertion['um_moduleid'] =$value;
		$insertion['um_submoduleid'] ='1';
        $insertion['um_access'] ='Y';  
		 $sql=$database->check_duplicate_entry('tbl_usermodules',$insertion);
		 if($sql!=1)
		 {//27-58
			  //$database->mysqlQuery("insert into tbl_usermodules(`um_username`, `um_moduleid`, `um_submoduleid`, `um_access`) values('".$stf."','".$value."','1','Y')"); 
			  $insertid              			=  $database->insert('tbl_usermodules',$insertion); 
		 }
		 $sql_submod_load  =  $database->mysqlQuery("Select *  from tbl_modulesubmaster where mser_moduleid='".$value."'"); 
		$num_submod_load  = $database->mysqlNumRows($sql_submod_load);
		if($num_submod_load){
			while($result_submod_load  = $database->mysqlFetchArray($sql_submod_load)) 
				{
					$filter=explode(" ",$result_submod_load['mser_subname']);
					if($filter[0]=="Load")
					{
						$insertion['um_submoduleid'] =$result_submod_load['mser_submoduleid'];
						$sql2=$database->check_duplicate_entry('tbl_usermodules',$insertion);
						  if($sql2!=1)
						  {
					   $insertid              			=  $database->insert('tbl_usermodules',$insertion); 
						  }
					}
				}
		}
		 
		 /*for($i=27;$i<=58;$i++)
		 {
			 
				 if($i!="33")
				 {
			 	$insertion['um_submoduleid'] =$i;
				$sql2=$database->check_duplicate_entry('tbl_usermodules',$insertion);
			 		if($sql2!=1)
			 		{
			 	 $insertid              			=  $database->insert('tbl_usermodules',$insertion); 
				 	}
				 }
		 }*/
	
	
	
	 $sql_submod  =  $database->mysqlQuery("select * from tbl_modulesubmaster where mser_moduleid='".$value."'"); 
	  $num_submod   = $database->mysqlNumRows($sql_submod);
	  if($num_submod){
		  while($result_submod  = $database->mysqlFetchArray($sql_submod)) 
			{
				$mainarr[]=$result_submod['mser_submoduleid'];
			}
	  }
	  print_r($mainarr);
	  foreach( $submod as $keys => $values)
	  {
		  //`tbl_usermodules`(`um_username`, `um_moduleid`, `um_submoduleid`, `um_access`)
		  if(in_array($values,$mainarr))
		  {
			  $insertion_s['um_username'] =$stf;
			  $insertion_s['um_moduleid'] =$value;
			  $insertion_s['um_submoduleid'] =$values;
			  $insertion_s['um_access'] ='Y';  
			   $sql=$database->check_duplicate_entry('tbl_usermodules',$insertion_s);
			   if($sql!=1)
			   {
					// $database->mysqlQuery("insert into tbl_usermodules(`um_username`, `um_moduleid`, `um_submoduleid`, `um_access`) values('".$stf."','".$value."','".$values."','Y')");  
					$insertid              			=  $database->insert('tbl_usermodules',$insertion_s); 
			   }
	
			  
			
			
		  }
		
	  }
	  
	  
}

}else if($_REQUEST['set']=="load")
{
	
	?>
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
     <!-- check all check box starts  -->    
<script type="text/javascript">  
   // permisn permisn_sub
   $(document).ready(function() {
    $('.checkallchek').click(function(event) {  
        if(this.checked) { // check select status
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });       
        }
    });
    
});
 </script>
 <!-- check all check box starts  stfidsess -->     
     <input type="hidden" value="<?=$_REQUEST['stfid'] ?>" name="stf" id="stf" >
                                                            <input type="hidden" value="insert" name="set" id="set" >
                                                            
      <div   class="module_cat_head user_details_heading_check">
          <span><input type="checkbox" class="check_box_main checkallchek" ></span>
          <span style="font-size:15px;padding-left:5px">CHECK ALL</span>
         <span style="font-size: 21px;width: 50%;display: inline-block;text-align: right;text-transform: uppercase;font-weight:bold;color: darkred"> <?=$_REQUEST['stfid'] ?></span>
      </div>                                                      
                                                            
                                                            
                                                            <?php
															
                                         $sql_mainmod  =  $database->mysqlQuery("select * from tbl_modulemaster order by mer_modulename asc "); 
                                          $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
                                          if($num_mainmod){
											  while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
												{
													?>
<script type="text/javascript">
$(document).ready(function () {

    $(".topic<?=$result_mainmod['mer_moduleid']?>").click(function(){
      //alert("mm");  
      var is_checked=$(this).is(":checked");

       // $(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").prop("checked",is_checked);
		//alert("2");
    });
    $(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").click(function() {
     //  alert("kk");  
      var  is_checked=$(this).is(":checked");
        
        if($(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']:checked").length == 0)
			{
			   $(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",false); 
			}else
			{
				$(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",true);
			   
			}
    });
    
    
    
    $('#multi_check_<?=$result_mainmod['mer_moduleid']?>').click(function(){ 
    

    if($("#multi_check_<?=$result_mainmod['mer_moduleid']?>").prop('checked') == true){ 
        
      $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
          
        $(this).prop('checked',true);
    
   });
     
   }else{
       
        $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
            
        $(this).prop('checked',false);
       
        });
   
   }
     
    
});
    
    
    
});

</script>

                                                    <?php 
													$module=$database->show_usermodule_ful_details($result_mainmod['mer_moduleid'],$_REQUEST['stfid'] ); 
													$modulest=$module['um_access'];
													
													 if($result_mainmod['mer_modulename']=="User Permission" &&  $_REQUEST['stfid']=='admin'){
                                                                                                           $clas_edit='disablegenerate';
                                                                                                       }else{
                                                                                                            $clas_edit='';
                                                                                                       }
                                                                                                            
                                                     ?>
                                        
                                                            	<div class="<?=$clas_edit?> module_cat_head topic<?=$result_mainmod['mer_moduleid']?>">
                                                                	<span> <?php if($result_mainmod['mer_modulename']!="Home Page"){ ?> 
                                                                    	<input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn " <?php if($modulest!=""){ ?> checked="checked" <?php } ?> value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php }else { ?>
                                                                     <input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn "  checked  value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php } ?></span>
                                                                    <span style="font-weight:bold;text-transform: uppercase"><?=$result_mainmod['mer_modulename']?></span>
                                                                </div><!--mod_cat_head-->
                                             <div class="subtopic">
                                             <ul class="inputs-list<?=$result_mainmod['mer_moduleid']?>">
                                                <?php
					  $sql_submod  =  $database->mysqlQuery("select * from tbl_modulesubmaster where mser_moduleid='".$result_mainmod['mer_moduleid']."' order by mser_subname asc "); 
                                          $num_submod   = $database->mysqlNumRows($sql_submod);
                                          if($num_submod){
											  while($result_submod  = $database->mysqlFetchArray($sql_submod)) 
												{
													$submodule=$database->show_usersubmodule_ful_details($result_mainmod['mer_moduleid'],$_REQUEST['stfid'] ,$result_submod['mser_submoduleid']);
													$submodulest=$submodule['um_access'];
													$filter=explode(" ",$result_submod['mser_subname']);
													if($filter[0]!="Load"){
													if($result_submod['mser_subname']!="Default"){
                                                                                                            
                                                                                                        if($result_submod['mser_subname']=="User Permission Edit" && $_REQUEST['stfid']=='admin'){
                                                                                                           $clas_edit='disablegenerate';
                                                                                                       }else{
                                                                                                            $clas_edit='';
                                                                                                       }        
                                                                                                                
                                                                                                            
                                         ?>                
                                                               <li class="module_sub_category">
                                                                
                                                                	<input type="checkbox" class="<?=$clas_edit?> check_box_main permisn_sub permisn_sub1_<?=$result_mainmod['mer_moduleid']?>" <?php if($submodulest!=""){ ?> checked <?php } ?> value="<?=$result_submod['mser_submoduleid']?>"  name="permisn_sub[]" >
                                                                    <span><?=$result_submod['mser_subname']?></span>
                                                                <!--module_sub_category-->
                                                                </li>
                                                <?php }} } } ?> 
                                                </ul> 
                                                 </div>
                                                            
                                                           <?php } } ?>     
                                                           
                                                           
                                                           
                                                           
                                                           
                                                               
                                                                
                                                            </div>
                                                            <?php
	
}
else if( isset($_REQUEST['set_staff']) && $_REQUEST['set_staff']=="staff_inherit"){
    
    
    if($_REQUEST['mode']=='Staff_Permission'){
    
    
   $query3=$database->mysqlQuery("UPDATE  tbl_staffmaster  to1, tbl_staffmaster from1
    SET to1.ser_compl_mgmt=from1.ser_compl_mgmt,to1.ser_cancelpermission =from1.ser_cancelpermission, 
    to1.ser_discountpermission =from1.ser_discountpermission ,to1.ser_stockchng_permission =from1.ser_stockchng_permission, 
    to1.ser_cancelwithkey=from1.ser_cancelwithkey,to1.ser_discount_manual =from1.ser_discount_manual , 
    to1.ser_counter_enable_generate =from1.ser_counter_enable_generate, to1.ser_counter_enable_hold =from1.ser_counter_enable_hold, 
    to1.ser_dayclose_revert_permission=from1.ser_dayclose_revert_permission,to1.ser_permit_cash_drawer_open =from1.ser_permit_cash_drawer_open,
    to1.ser_kot_cancel_permission =from1.ser_kot_cancel_permission, 
    to1.ser_bill_settle_permission=from1.ser_bill_settle_permission,to1.ser_bill_cancel_permission =from1.ser_bill_cancel_permission,
    to1.ser_rate_edit =from1.ser_rate_edit, 
    to1.ser_counter_settle_permission=from1.ser_counter_settle_permission,to1.ser_dayclose_permission =from1.ser_dayclose_permission,
    to1.ser_shift_permission =from1.ser_shift_permission, to1.ser_release_login =from1.ser_release_login, to1.ser_bill_regen_per =from1.ser_bill_regen_per, 
    to1.ser_bill_reprint_per = from1.ser_bill_reprint_per, to1.ser_kot_reprint_per =from1.ser_kot_reprint_per,
    to1.ser_bill_settle_change_per =from1.ser_bill_settle_change_per, to1.ser_order_split_permission = from1.ser_order_split_permission,
    to1.ser_tip_edit_permission =from1.ser_tip_edit_permission ,to1.ser_bill_reset =from1.ser_bill_reset,to1.ser_credit_view=from1.ser_credit_view,
    to1.ser_comp_view=from1.ser_comp_view,to1.ser_credit_permission=from1.ser_credit_permission,
    to1.ser_comp_permission=from1.ser_comp_permission,to1.ser_bill_print_permission=from1.ser_bill_print_permission,
    to1.ser_bill_edit_permission=from1.ser_bill_edit_permission,to1.ser_change_table_permission=from1.ser_change_table_permission,
    to1.ser_advance_pay_permission=from1.ser_advance_pay_permission,to1.ser_counter_settle_permission=from1.ser_counter_settle_permission,
    to1.ser_reset_accounts=from1.ser_reset_accounts,to1.ser_online_order=from1.ser_online_order,
    
   to1.ser_inv_permission=from1.ser_inv_permission, to1.ser_physical_stock_permission=from1.ser_physical_stock_permission, 
   to1.ser_wastage_entry=from1.ser_wastage_entry, to1.ser_stock_entry=from1.ser_stock_entry,
   to1.ser_req=from1.ser_req, to1.ser_po=from1.ser_po, to1.ser_rps=from1.ser_rps,
   to1.ser_store_transfer=from1.ser_store_transfer, to1.ser_return_history=from1.ser_return_history, 
   to1.ser_inventory_reports=from1.ser_inventory_reports, to1.ser_purchase_return=from1.ser_purchase_return, 
   to1.ser_consumption=from1.ser_consumption, to1.ser_store_stock=from1.ser_store_stock,
   to1.ser_dashboard=from1.ser_dashboard, to1.ser_recipe=from1.ser_recipe, to1.ser_production=from1.ser_production,
   to1.ser_central_kitchen=from1.ser_central_kitchen,
   to1.ser_central_accept=from1.ser_central_accept, to1.ser_com_item=from1.ser_com_item, to1.ser_inv_check_all=from1.ser_inv_check_all,
   to1.ser_force_close=from1.ser_force_close, to1.ser_discount_after=from1.ser_discount_after, to1.ser_all_shift_closer=from1.ser_all_shift_closer, 
   to1.ser_item_discount_manual=from1.ser_item_discount_manual, to1.ser_indent=from1.ser_indent, to1.ser_delete_menu=from1.ser_delete_menu, 
   to1.ser_menu_unit_edit=from1.ser_menu_unit_edit, to1.ser_store_inv=from1.ser_store_inv,to1.ser_approve_cancel_inv=from1.ser_approve_cancel_inv,
   to1.ser_direct_transfer=from1.ser_direct_transfer, to1.ser_indent_accept=from1.ser_indent_accept,
   to1.ser_normal_transfer_accept=from1.ser_normal_transfer_accept, to1.ser_direct_transfer_accept=from1.ser_direct_transfer_accept
  
    WHERE from1.ser_staffid = '".$_REQUEST['from']."' and to1.ser_staffid ='".$_REQUEST['to']."' ");
   
   
    $query34=$database->mysqlQuery("UPDATE  tbl_logindetails  to1, tbl_logindetails from1
    SET to1.ls_restrict_login=from1.ls_restrict_login,to1.ls_applogin=from1.ls_applogin WHERE from1.ls_staffid = '".$_REQUEST['from']."' and to1.ls_staffid ='".$_REQUEST['to']."' ");
   
    
     $query343=$database->mysqlQuery("UPDATE tbl_staffmaster set ser_last_inherit_permision='".$_REQUEST['from']."' where  ser_staffid ='".$_REQUEST['to']."'");
    
    
    
    }else{
        
        ////user permission////
        
        $from_user1=	$_REQUEST['from'];
	$to_user1=$_REQUEST['to'];
        
        
        $sql_mainmod  =  $database->mysqlQuery("select ls_username  from tbl_logindetails where ls_staffid='$from_user1' "); 
        $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
        if($num_mainmod){
	while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
	{
            
            $from_user=$result_mainmod['ls_username'];
        }
        }
        
        
        $sql_mainmod3  =  $database->mysqlQuery("select ls_username  from tbl_logindetails where ls_staffid='$to_user1' "); 
        $num_mainmod3   = $database->mysqlNumRows($sql_mainmod3);
        if($num_mainmod3){
	while($result_mainmod3  = $database->mysqlFetchArray($sql_mainmod3)) 
	{
            
            $to_user=$result_mainmod3['ls_username'];
        }
        }
        
        
	if($to_user !="")
	{
                     
          $dlt_query=$database->mysqlQuery("DELETE FROM  tbl_usermodules WHERE um_username ='$to_user'"); 
      
          $insrt_query=$database->mysqlQuery("INSERT INTO tbl_usermodules(um_username, um_moduleid, um_submoduleid, um_access)"
          . " select '$to_user', um_moduleid, um_submoduleid, um_access from tbl_usermodules where um_username = '$from_user' ")	 ;
		
		 if($insrt_query)
		 {
		    echo 'ok';
		 }
	}
	else
	{
		   echo 'sorry';
	}
        
        
   $query343=$database->mysqlQuery("UPDATE tbl_staffmaster set ser_last_inherit_user_permision='$from_user1' where  ser_staffid ='$to_user1'");
    
    
        
        
    }
    
    
}
else if( isset($_REQUEST['set_staff_app']) && $_REQUEST['set_staff_app']=="staff_inherit_app"){
    
    
     $query3=$database->mysqlQuery("UPDATE  tbl_app_permissions  to1, tbl_app_permissions from1
     SET to1.tap_app_login=from1.tap_app_login , to1.tap_dinein_module=from1.tap_dinein_module ,  to1.tap_tahd_module=from1.tap_tahd_module , 
     to1.tap_cs_module=from1.tap_cs_module , to1.tap_item_cancel=from1.tap_item_cancel , to1.tap_bill_cancel=from1.tap_bill_cancel ,
     
     to1.tap_table_change=from1.tap_table_change, to1.tap_bill_reprint=from1.tap_bill_reprint, to1.tap_settle_dinein=from1.tap_settle_dinein, 
     to1.tap_settle_ta_hd=from1.tap_settle_ta_hd,to1.tap_settle_cs=from1.tap_settle_cs, to1.tap_shift=from1.tap_shift,
     to1.tap_discount=from1.tap_discount, to1.tap_regenerate=from1.tap_regenerate, to1.tap_complimentary=from1.tap_complimentary,
     to1.tap_tip=from1.tap_tip,to1.tap_hold=from1.tap_hold ,to1.tap_all_settle=from1.tap_all_settle
     WHERE from1.tap_staff_id = '".$_REQUEST['from']."' and to1.tap_staff_id ='".$_REQUEST['to']."' ");
    
    
     $query343=$database->mysqlQuery("UPDATE tbl_staffmaster set ser_last_inherit_app_permision='".$_REQUEST['from']."' "
     . " where  ser_staffid ='".$_REQUEST['to']."'");
    
    
     
}
else if( isset($_REQUEST['set']) && $_REQUEST['set']=="load_inherit"){
    
    
    $from='';
    
   
    
        $sql_mainmod  =  $database->mysqlQuery("select ser_last_inherit_permision,ser_last_inherit_user_permision,ser_last_inherit_app_permision"
                . "  from tbl_staffmaster where ser_staffid='".$_REQUEST['staff']."' "); 
        $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
        if($num_mainmod){
	while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
	{
            
           if($_REQUEST['mode']=='Staff_Permission'){ 
            $from=$result_mainmod['ser_last_inherit_permision'];
           }
           
          if($_REQUEST['mode']=='User_Permission'){ 
            $from=$result_mainmod['ser_last_inherit_user_permision'];
           }  
           
            if($_REQUEST['mode']=='app'){ 
            $from=$result_mainmod['ser_last_inherit_app_permision'];
           }
            
        }
        }
    
        echo $from;
        
}


?>