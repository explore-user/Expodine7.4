<?php session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance

include("database_inv.class.php"); 
$database_inv	= new Database_inv();


if($_REQUEST['value']=="searchmenu"){
 /* ******************************************** Menu master ******************************************************* */
		////mname mcate msubc mdiet mstatus
	$mname	= $_REQUEST['mname'];
	$mcate=$_REQUEST['mcate'];
	$msubc=$_REQUEST['msubc'];
	$mdiet=$_REQUEST['mdiet'];
	//$mstatus=$_REQUEST['mstatus'];
	$search="";
	if($mname!="null")
	{
		if($search!="")
		{
			$search.=" and  mr_menuname LIKE  '%" . $mname ."%'";
		}else
		{
			$search.=" mr_menuname LIKE  '%" . $mname ."%'";
		}
	}
	if($mcate!="null")
	{
		if($search!="")
		{
			$search.=" and  mmy_maincategoryname LIKE  '%" . $mcate ."%'";
		}else
		{
			$search.=" mmy_maincategoryname LIKE  '%" . $mcate ."%'";
		}
	}
	if($msubc!="null")
	{
		if($search!="")
		{
			$search.=" and  msy_subcategoryname LIKE  '%" . $msubc ."%'";
		}else
		{
			$search.=" msy_subcategoryname LIKE  '%" . $msubc ."%'";
		}
	}
	if($mdiet!="null")
	{
		if($search!="")
		{
			$search.=" and  mr_diet LIKE  '%" . $mdiet ."%'";
		}else
		{
			$search.=" mr_diet LIKE  '%" . $mdiet ."%'";
		}
	}
	
	/*if($mstatus!="null")
	{
		$sr="";
	$type=strtolower($mstatus);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	
		if($search!="")
		{
			$search.=" and  mr_active LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" mr_active LIKE  '%" . $sr ."%'";
		}
	}*/
?>
 <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/foodcosting_menupopup.js"></script>
<!-- <script>
$(document).ready(function(){
	
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});
</script>-->

   <table class="responstable table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" >          
 <thead>
 <tr>
    <th class="header">Sl No</th>
    <th class="header">Menu</th>
     <th class="header">Main Category</th>
      <th class="header">Sub Category</th>
     <th class="header">Diet</th>
  </tr>
   </thead>
     <tbody >                                           
  <?php  
  if($search!="")
  {
	  $search="where $search";
  }  
 
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menumaster INNER JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid  LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid  $search");

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					/*if($result_cat_s['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['mr_menuid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}*/  
?>
    	<tr id="ids_<?=$result_cat_s['mr_menuid']?>" name="<?=$result_cat_s['mr_menuname']?>" class="clicktoselect">
                              <td><?=$i++;?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['mr_menuname'],$mname)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['mmy_maincategoryname'],$mcate)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['msy_subcategoryname'],$msubc)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['mr_diet'],$mdiet)?></td>
                              </tr>
  <?php $k++;$i++; }} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
     <?php }else if($_REQUEST['value']=="loadfulllist"){
 /* ******************************************** Menu list ******************************************************* */
		
?>
 <script src="js/jquery-1.10.2.min.js"></script>
   <script src="js/foodcosting_menupopup.js"></script>

   <table class="responstable table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" >          
 <thead>
 <tr>
    <th class="header">Sl No</th>
    <th class="header">Menu</th>
     <th class="header">Main Category</th>
      <th class="header">Sub Category</th>
     <th class="header">Diet</th>
  </tr>
   </thead>
     <tbody >                                           
  <?php  
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menumaster INNER JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid  LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid ");

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					/*if($result_cat_s['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['mr_menuid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}*/  
?>
    	<tr id="ids_<?=$result_cat_s['mr_menuid']?>" name="<?=$result_cat_s['mr_menuname']?>" class="clicktoselect">
                              <td><?=$i++;?></td>
                                <td><?=$result_cat_s['mr_menuname']?></td>
                                <td><?=$result_cat_s['mmy_maincategoryname']?></td>
                                <td><?=$result_cat_s['msy_subcategoryname']?></td>
                                <td><?=$result_cat_s['mr_diet']?></td>
                              </tr>
  <?php $k++;$i++; }} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
     <?php }else if($_REQUEST['value']=="searchmenu_ing"){
 /* ******************************************** ingredient master ******************************************************* */
		//ing_name ing_cat ing_sub ing_bd ing_st
	$ing_name	= $_REQUEST['ing_name'];
	$ing_cat	=$_REQUEST['ing_cat'];
	$ing_sub	=$_REQUEST['ing_sub'];
	$ing_bd		=$_REQUEST['ing_bd'];
	$ing_st		=$_REQUEST['ing_st'];
	$search="";
	if($ing_name!="null")
	{
		if($search!="")
		{
			$search.=" and  prm_productname LIKE  '%" . $ing_name ."%'";
		}else
		{
			$search.=" prm_productname LIKE  '%" . $ing_name ."%'";
		}
	}
	if($ing_cat!="null")
	{
		if($search!="")
		{
			$search.=" and  pcm_prodcatname LIKE  '%" . $ing_cat ."%'";
		}else
		{
			$search.=" pcm_prodcatname LIKE  '%" . $ing_cat ."%'";
		}
	}
	if($ing_sub!="null")
	{
		if($search!="")
		{
			$search.=" and  pscm_prodsubcatname LIKE  '%" . $ing_sub ."%'";
		}else
		{
			$search.=" pscm_prodsubcatname LIKE  '%" . $ing_sub ."%'";
		}
	}
	if($ing_bd!="null")
	{
		if($search!="")
		{
			$search.=" and  brm_brandname LIKE  '%" . $ing_bd ."%'";
		}else
		{
			$search.=" brm_brandname LIKE  '%" . $ing_bd ."%'";
		}
	}
	
	if($ing_st!="null")
	{
		$sr="";
	$type=strtolower($ing_st);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	
		if($search!="")
		{
			$search.=" and  prm_active LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" prm_active LIKE  '%" . $sr ."%'";
		}
	}
?>
 <script src="js/jquery-1.10.2.min.js"></script>
   <script src="js/foodcosting_ingrdpopup.js"></script>
<!-- <script>
$(document).ready(function(){
	
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});
</script>-->

   <table class="responstable table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" >          
 <thead>
 <tr>
     <th class="header">Sl No</th>
      <th class="header">Ingredient name</th>
       <th class="header">Main Category</th>
        <th class="header">Sub Category</th>
       <th class="header">Brand</th>
       <th class="header">Unit</th>
        <th class="header">Rate</th>
       <th class="header">Status</th>
  </tr>
   </thead>
     <tbody >                                           
  <?php  
  if($search!="")
  {
	  $search="where $search";
  } 
   $db1=INV_DATABASE_NAME.".inv_tbl_productmaster";
   $db2=INV_DATABASE_NAME.".inv_tbl_productcatmaster";
   $db3=INV_DATABASE_NAME.".inv_tbl_productsubcatmaster";
	$db4=INV_DATABASE_NAME.".inv_tbl_brandmaster";
	$db5=INV_DATABASE_NAME.".inv_tbl_unitmaster";
 
$sql_cat_s  =  $database_inv->mysqlQuery("select * from $db1 as pm LEFT JOIN $db2 as pc ON pm.prm_productcat=pc.pcm_prodcatid LEFT JOIN $db3 as ps ON pm.prm_productdsubcat=ps.pscm_prodsubcatid LEFT JOIN $db4 as bm ON pm.prm_productdbrand=bm.brm_brandid LEFT JOIN $db5 as um ON pm.prm_productdunit=um.um_id  $search");

$num_cat_s  = $database_inv->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database_inv->mysqlFetchArray($sql_cat_s)) 
			{
					if($result_cat_s['prm_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				/*if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['mr_menuid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}  *///ing_name ing_cat ing_sub ing_bd ing_st
?>
    	<tr id="ids_<?=$result_cat_s['prm_productid']?>" name="<?=$result_cat_s['prm_productname']?>" unit="<?=$result_cat_s['prm_productdunit'] ?>"  unitcost="<?=$result_cat_s['prm_productrate'] ?>" rate="<?=$result_cat_s['prm_productrate'] ?>" class="clicktoselect_ing">
                              <td><?=$i++;?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['prm_productname'],$ing_name)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['pcm_prodcatname'],$ing_cat)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['pscm_prodsubcatname'],$ing_sub)?></td>
                                <td><?=$database->highlightkeyword($result_cat_s['brm_brandname'],$ing_bd)?></td>
                                <td><?=$result_cat_s['um_name']?></td>
                                <td><?=$result_cat_s['prm_productrate']?></td>
                                <td><?=$database->highlightkeyword($active,$ing_st)?></td>
                              </tr>
  <?php $k++;$i++; }} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
     <?php }else if($_REQUEST['value']=="loadfulllist_ing"){
 /* ******************************************** Menu list ******************************************************* */
		
?>
 <script src="js/jquery-1.10.2.min.js"></script>
   <script src="js/foodcosting_ingrdpopup.js"></script>

   <table class="responstable tablesorter" id="listingredientss">
                        <thead>
                          <tr>
                                <th class="header">Sl No</th>
                                <th class="header">Ingredient name</th>
       							 <th class="header">Main Category</th>
                                  <th class="header">Sub Category</th>
                                 <th class="header">Brand</th>
                                 <th class="header">Unit</th>
                                 <th class="header">Rate</th>
                                 <th class="header">Status</th>
                              </tr>
                                  </thead>
                          <tbody>
                          
                          <!--<tr class="food_table_active">-->
                          <?php
						  //`inv_tbl_productmaster`(`prm_productid`, `prm_productname`, `prm_productcat`, `prm_productdsubcat`, `prm_productdbrand`, `prm_productdunit`, `prm_productdminstock`, `prm_productdmaxstock`, `prm_productdredorderlevel`, `prm_productrate`, `prm_branchid`, `prm_active`, `prm_ratemodifieddate`)
						  //`inv_tbl_productcatmaster`(`pcm_prodcatid`, `pcm_prodcatname`, `pcm_active`, `pcm_branchid`)
						  // `inv_tbl_productsubcatmaster`(`pscm_prodsubcatid`, `pscm_prodsubcatname`, `pscm_prodcatid`, `pscm_active`) 
						  //`inv_tbl_brandmaster`(`brm_brandid`, `brm_brandname`, `brm_active`)
						  
						 $db1=INV_DATABASE_NAME.".inv_tbl_productmaster";
						 $db2=INV_DATABASE_NAME.".inv_tbl_productcatmaster";
						 $db3=INV_DATABASE_NAME.".inv_tbl_productsubcatmaster";
						 $db4=INV_DATABASE_NAME.".inv_tbl_brandmaster";
						 $db5=INV_DATABASE_NAME.".inv_tbl_unitmaster";
						 
						  $sql_table_sel  =  $database_inv->mysqlQuery("select * from $db1 as pm LEFT JOIN $db2 as pc ON pm.prm_productcat=pc.pcm_prodcatid LEFT JOIN $db3 as ps ON pm.prm_productdsubcat=ps.pscm_prodsubcatid LEFT JOIN $db4 as bm ON pm.prm_productdbrand=bm.brm_brandid LEFT JOIN $db5 as um ON pm.prm_productdunit=um.um_id"); 
						  $num_table  = $database_inv->mysqlNumRows($sql_table_sel);
						  if($num_table){$i=1;
								while($result_table_sel  = $database_inv->mysqlFetchArray($sql_table_sel)) 
									{
										if($result_table_sel['prm_active']=='Y')
										{
											$sts="Yes";
										}else
										{
											$sts="No";
										}
						  ?>
                          
                        	<tr id="ids_<?=$result_table_sel['prm_productid']?>" name="<?=$result_table_sel['prm_productname']?>" unit="<?=$result_table_sel['prm_productdunit'] ?>"  unitcost="<?=$result_table_sel['prm_productrate'] ?>" rate="<?=$result_table_sel['prm_productrate'] ?>"  class="clicktoselect_ing">
                              <td><?=$i++;?></td>
                                <td><?=$result_table_sel['prm_productname']?></td>
                                <td><?=$result_table_sel['pcm_prodcatname']?></td>
                                <td><?=$result_table_sel['pscm_prodsubcatname']?></td>
                                <td><?=$result_table_sel['brm_brandname']?></td>
                                <td><?=$result_table_sel['um_name']?></td>
                                <td><?=$result_table_sel['prm_productrate']?></td>
                                <td><?=$result_table_sel['prm_active']?></td>
                              </tr>
                              
                              <?php } } else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
                            
                          
                                       </tbody>
                                                </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
     <?php }else if($_REQUEST['value']=="submitingredients"){
		 
		 /******************************* submit values********************************************/
		 //`fc_recipe_details`(`fc_menuid`, `fc_slno`, `fc_ingredientid`, `fc_ing_unit`, `fc_ing_unitcost`, `fc_ing_totalcost`, `fc_wastage_percentage`, `fc_wastage_cost`, `fc_totalcost`)
		 //&value=submitingredients&menuidselected=KBP-MENU10&ingidselected=BFC-P1&qtyingr=1&uniting=1&unitcost=25.20&costingr=25.20&wastingr=5&wastcostingr=1.26&totalcostingr=23.94
	$insertion['fc_menuid']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuidselected']);
	$insertion['fc_ingredientid']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingidselected']);
	
	
	 $sql=$database->check_duplicate_entry('fc_recipe_details',$insertion);
	 if($sql!=1)
	  {
		  $insertion['fc_ing_unit']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['uniting']);
		  $insertion['fc_qty']			    = mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['qtyingr']);
		  $insertion['fc_ing_unitcost']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unitcost']);
		  $insertion['fc_ing_totalcost']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['costingr']);
		  $insertion['fc_wastage_percentage']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastingr']);
		  $insertion['fc_wastage_cost']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastcostingr']);
		  $insertion['fc_totalcost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['totalcostingr']);
	
	  	  $insertid              			=  $database->insert('fc_recipe_details',$insertion);
	  	  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		 
	 }else if($_REQUEST['value']=="listallingredients"){
		
		
		 /******************************* submit values********************************************/
		?>
        <table class="responstable tablesorter">
                        <thead>
                         	 <tr>
                                <th width="5%" class="header">Delete</th>
                                <th width="5%" class="header">Edit</th>
                                <th width="20%" class="header">Item</th>
                                <th width="10%" class="header">Qty</th>
       							<th width="10%" class="header">Unit</th>
                                <th width="10%" class="header">Unit Cost</th>
                                 <th width="10%" class="header">Total Cost</th>
                                 <th width="10%" class="header">Wastage%</th>
                                 <th width="10%" class="header">Wastage Cost</th>
                                 <th width="10%" class="header">Total Cost</th>
                              </tr>
                            </thead>
                        <tbody style="min-height:250px;height:39vh;">
                         <?php
						 $db1=DATABASE_NAME.".fc_recipe_details";
						 $db2=INV_DATABASE_NAME.".inv_tbl_productmaster";
						 $db3=INV_DATABASE_NAME.".inv_tbl_unitmaster";
						  $db4=DATABASE_NAME.".tbl_menumaster";
						//`fc_recipe_details`(`fc_menuid`, `fc_slno`, `fc_ingredientid`, `fc_ing_unit`, `fc_ing_unitcost`, `fc_ing_totalcost`, `fc_wastage_percentage`, `fc_wastage_cost`, `fc_totalcost`) 
					  // $sql_login  =  $database->mysqlQuery("select * from fc_recipe_details fd LEFT JOIN tbl_menumaster as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN inv_tbl_productmaster as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN inv_tbl_unitmaster as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'"); 
					  //echo "select * from $db1 fd LEFT JOIN tbl_menumaster as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'";
					   $sql_login  =  $database->mysqlQuery("select * from $db1 fd LEFT JOIN $db4 as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'"); 
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
							while($result_login  = $database->mysqlFetchArray($sql_login)) 
							  {
							  ?>
                           <tr>
                              <td width="5%"><a class="tab_edt_btn md-trigger_edit food_item_del" menu="<?=$result_login['fc_menuid']?>" slno="<?=$result_login['fc_slno']?>" ingr="<?=$result_login['fc_ingredientid']?>" ><i class="fa fa-trash"></i></a></td>
                              <td width="5%"><a class="tab_edt_btn md-trigger_edit editeachbuttoncheck" menu="<?=$result_login['fc_menuid']?>" slno="<?=$result_login['fc_slno']?>" ingr="<?=$result_login['fc_ingredientid']?>"><i class="fa fa-edit"></i></a></td>
                              <td width="20%"><?=$result_login['prm_productname']?></td>
                               <td width="10%"><?=$result_login['fc_qty']?></td>
                              <td width="10%"><?=$result_login['um_name']?></td>
                              <td width="10%"><?=$result_login['fc_ing_unitcost']?></td>
                              <td width="10%"><?=$result_login['fc_ing_totalcost']?></td>
                              <td width="10%"><?=$result_login['fc_wastage_percentage']?>%</td>
                             <td width="10%"><?=$result_login['fc_wastage_cost']?></td>
                             <td width="10%"><?=$result_login['fc_totalcost']?></td>
                          </tr>  
                      <?php } }else { ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>                          
                      </tbody>
                      </table>
                      <script type="text/javascript" src="js/foodcosting_del.js"></script>
        <?php
		 
	 }else if($_REQUEST['value']=="deleteeachitemingr"){
	$sql_login  =  $database->mysqlQuery("DELETE  from fc_recipe_details  WHERE fc_menuid ='".$_REQUEST['menu']."' and fc_slno ='".$_REQUEST['slno']."' and fc_ingredientid ='".$_REQUEST['ingr']."'"); 
	if(	$sql_login)
	{
		echo "ok";
	}else
	{
		echo "sorry";
	}
	 }else if($_REQUEST['value']=="editeachitemingr"){
		$db1=DATABASE_NAME.".fc_recipe_details";
	   $db2=INV_DATABASE_NAME.".inv_tbl_productmaster";
	   $db3=INV_DATABASE_NAME.".inv_tbl_unitmaster";
		$db4=DATABASE_NAME.".tbl_menumaster";
		
		//select * from $db1 fd LEFT JOIN tbl_menumaster as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'				 
	$sql_login  =  $database->mysqlQuery("select * from $db1 fd LEFT JOIN $db4 as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menu']."'  and fc_slno ='".$_REQUEST['slno']."' and fc_ingredientid ='".$_REQUEST['ingr']."'"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {	 //`fc_recipe_details`(`fc_menuid`, `fc_slno`, `fc_ingredientid`, `fc_qty`, `fc_ing_unit`, `fc_ing_unitcost`, `fc_ing_totalcost`, `fc_wastage_percentage`, `fc_wastage_cost`, `fc_totalcost`)
		?>
		
            <div class="food_incrient_add_contain">
            <div class="close_edit_food_cost" style="float:right"><a href="#" class="closeeditingr"></a></div>
                <span style="width:90%;">Edit Ingredients <!--<a href="#" class="closeeditingr">close</a>--></span>
                
            </div><!---food_incrient_add_contain--->
            
            <div class="food_incrient_add_form_cc">
                <!--<div class="incread_disable checkenable"></div>-->
                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:23.5%">
                <span class="filte_new_text">Item</span>
                   <div style="margin:0;width:100%" class="food_menu_select_textbox_cc">
                        <input type="text" name="ingname_edit" id="ingname_edit" class="food_menu_select" placeholder="Select Ingredient" style="width: 78%;" readonly value="<?=$result_login['prm_productname']?>">
                        <input type="hidden" name="ingidselected_edit" id="ingidselected_edit"  value="<?=$result_login['fc_ingredientid']?>">
                        <input type="hidden" name="ingidslno_edit" id="ingidslno_edit" value="<?=$result_login['fc_slno']?>">
                        <div style="width: 20%;" class="food_menu_view_btn"><a class="md-trigger" data-modal="modal-18" href="#"><img src="img/search_ico.jpg"></a></div>
                    </div>
                </div><!---col-sm-2--->
                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">QTY</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="QTY" name="qtyingr_edit" id="qtyingr_edit" value="<?=$result_login['fc_qty']?>">
                </div><!---col-sm-2--->
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">Unit</span>
                <div id="listunitcost">
                    <select type="text" class="form-control food_increant_txtbox"  placeholder="Unit" name="uniting_edit" id="uniting_edit" disabled >
                         <option value="null" default>Select Unit</option>
                     <?php
					 $db2=INV_DATABASE_NAME.".inv_tbl_unitmaster";
					 
                         $sql_login2  =  $database_inv->mysqlQuery("select * from $db2"); 
                          $num_login2   = $database_inv->mysqlNumRows($sql_login2);
                          if($num_login2){
                              while($result_login2  = $database_inv->mysqlFetchArray($sql_login2)) 
                                {
                                ?>
                    <option value="<?=$result_login2['um_id']?>"  <?php if($result_login2['um_id']==$result_login['fc_ing_unit']){ ?> selected="selected" <?php } ?>><?=$result_login2['um_name']?></option>
                   <?php } } ?>	
                    </select>
                    </div>
                </div><!---col-sm-2--->
                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">Unit Cost</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="Unit Cost" name="unitcost_edit" id="unitcost_edit" readonly value="<?=$result_login['fc_ing_unitcost']?>">
                </div><!---col-sm-2--->
                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">Total Cost</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="Cost" name="costingr_edit" id="costingr_edit" readonly value="<?=$result_login['fc_ing_totalcost']?>">
                </div><!---col-sm-2--->
                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">Wastage %</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="Wastage %" name="wastingr_edit" id="wastingr_edit" value="<?=$result_login['fc_wastage_percentage']?>">
                </div><!---col-sm-2--->
                 <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                <span class="filte_new_text">Wastage Cost</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="Wastage Cost" name="wastcostingr_edit" id="wastcostingr_edit" readonly value="<?=$result_login['fc_wastage_cost']?>">
                </div><!---col-sm-2--->
                 <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                <span class="filte_new_text">Total</span>
                    <input type="text" class="form-control food_increant_txtbox"  placeholder="Total" name="totalcostingr_edit" id="totalcostingr_edit" readonly value="<?=$result_login['fc_totalcost']?>">
                </div><!---col-sm-2--->
              
                 <div class="col-sm-2" style="width: 4%;margin-top: 20px;padding:0">
                    <div class="food_incread_add_ico"><a href="#" id="editingrvalues"><img src="img/update.png"></a></div>
                 </div><!---col-sm-2--->
            </div><!--food_incrient_add_form_cc-->
            <script src="master_style/js/modalEffects.js"></script>
             <script src="js/foodcosting_edit.js"></script>
            <?php
		  } }
		 
	 }else if($_REQUEST['value']=="editingredients"){
		 
		 /******************************* submit values********************************************/
		 //`fc_recipe_details`(`fc_menuid`, `fc_slno`, `fc_ingredientid`, `fc_ing_unit`, `fc_ing_unitcost`, `fc_ing_totalcost`, `fc_wastage_percentage`, `fc_wastage_cost`, `fc_totalcost`)
		 //&value=editingredients&menuidselected=KBP-MENU10&ingidselected=BFC-P1&qtyingr=1&uniting=1&unitcost=25.20&costingr=25.20&wastingr=5&wastcostingr=1.26&totalcostingr=23.94&ingidslno_edit
	//$insertion['fc_menuid']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuidselected']);
	//$insertion['fc_ingredientid']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingidselected']);
	
	$sql_login  =  $database->mysqlQuery("select * from fc_recipe_details  WHERE fc_menuid ='".$_REQUEST['menuidselected']."' AND fc_ingredientid='".$_REQUEST['ingidselected']."' AND fc_slno='".$_REQUEST['ingidslno_edit']."'"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	{
		$condition						= 'fc_menuid=\''.$_REQUEST['menuidselected'].'\' AND fc_ingredientid=\''.$_REQUEST['ingidselected'].'\' AND fc_slno=\''.$_REQUEST['ingidslno_edit'].'\' ';
	 //$sql=$database->check_duplicate_entry('fc_recipe_details',$insertion);
		 //if($sql!=1)
		  //{
			  $insertion['fc_ing_unit']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['uniting']);
			  $insertion['fc_qty']			    	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['qtyingr']);
			  $insertion['fc_ing_unitcost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unitcost']);
			  $insertion['fc_ing_totalcost']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['costingr']);
			  $insertion['fc_wastage_percentage']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastingr']);
			  $insertion['fc_wastage_cost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastcostingr']);
			  $insertion['fc_totalcost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['totalcostingr']);
		
			 // $insertid              			=  $database->insert('fc_recipe_details',$insertion);
			  $insertid              			=  $database->update('fc_recipe_details',$insertion,$condition); 
			  echo "ok";
	  }else
	  {
		  $sql_login  =  $database->mysqlQuery("select * from fc_recipe_details  WHERE fc_menuid ='".$_REQUEST['menuidselected']."' AND fc_ingredientid='".$_REQUEST['ingidselected']."' AND fc_slno<>'".$_REQUEST['ingidslno_edit']."'"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
			  echo "sorry";
		  }else
		  {
			  $condition						= 'fc_menuid=\''.$_REQUEST['menuidselected'].'\'  AND fc_slno=\''.$_REQUEST['ingidslno_edit'].'\' ';
	 //$sql=$database->check_duplicate_entry('fc_recipe_details',$insertion);
		 //if($sql!=1)
		  //{
			  $insertion['fc_ingredientid']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingidselected']);
			  $insertion['fc_ing_unit']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['uniting']);
			  $insertion['fc_qty']			    	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['qtyingr']);
			  $insertion['fc_ing_unitcost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unitcost']);
			  $insertion['fc_ing_totalcost']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['costingr']);
			  $insertion['fc_wastage_percentage']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastingr']);
			  $insertion['fc_wastage_cost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['wastcostingr']);
			  $insertion['fc_totalcost']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['totalcostingr']);
		
			 // $insertid              			=  $database->insert('fc_recipe_details',$insertion);
			  $insertid              			=  $database->update('fc_recipe_details',$insertion,$condition); 
			  echo "ok";
		  }
		
		  
	  }
		 
	 }else if($_REQUEST['value']=="submitpreparationmeth"){
		
		/******************************* Preparation Method values********************************************/
		//`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`) 
		$insertion['fcm_menuid']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuidselected']);
	 $sql=$database->check_duplicate_entry('fc_recipe_master',$insertion);
	 if($sql!=1)
	  {
		  $insertion['fcm_preparationmethod']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prepmethod']);
	  	  $insertid              			=  $database->insert('fc_recipe_master',$insertion);
	  	  echo "added";
	  }else
	  {
		  $condition						= 'fcm_menuid=\''.$_REQUEST['menuidselected'].'\' ';
		  $insertion['fcm_preparationmethod']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prepmethod']);
		  $insertid              			=  $database->update('fc_recipe_master',$insertion,$condition); 
		  echo "updated";
	  } 
	 // echo $insertion['fc_ingredientid'];
	 }else if($_REQUEST['value']=="listprepmethod"){
		 
		 $sql_login  =  $database->mysqlQuery("select fcm_preparationmethod from fc_recipe_master  WHERE fcm_menuid ='".$_REQUEST['menuid']."'  "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
		 ?>
         <textarea class="preparation_textarea" rows="17" cols="90" name="prepmethod" id="prepmethod"><?=$result_login['fcm_preparationmethod']?></textarea>
         <?php
		  }
		  }else
		  {
			  ?>  <textarea class="preparation_textarea" rows="17" cols="90" name="prepmethod" id="prepmethod"></textarea><?php
		  }
	 }else if($_REQUEST['value']=="totalcostlisting"){
		 //`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`)
		 $sql_login  =  $database->mysqlQuery("select `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost` from fc_recipe_master  WHERE fcm_menuid ='".$_REQUEST['menuid']."'  "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
			  
		 ?>
         <div class="food_calc_in_cc">
            <div class="food_project_calc_head">Total</div>
              <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Total Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Total Cost" value="<?=$result_login['fcm_total_makingcost']?>" readonly></div>
               </div><!---food_box_full_cc--->
               <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Wastage Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Wastage Cost" value="<?=$result_login['fcm_total_wastagecost']?>" readonly></div>
               </div><!---food_box_full_cc--->
               <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;border:0" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Final Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Final Cost" value="<?=$result_login['fcm_total_finalcost']?>" readonly></div>
               </div><!---food_box_full_cc--->
            
        </div>
        
         <?php
		  }
		  }else
		  {
			   ?>
         <div class="food_calc_in_cc">
            <div class="food_project_calc_head">Total</div>
              <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Total Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Total Cost"  readonly></div>
               </div><!---food_box_full_cc--->
               <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Wastage Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Wastage Cost"  readonly></div>
               </div><!---food_box_full_cc--->
               <div style="margin-top:0px;margin-bottom: 0;padding: 2px 0 0 0;border:0" class="food_box_full_cc">
                <div style="width:55%" class="food_calc_textbx_div">Final Cost</div>
                <div style="width:40%" class="food_calc_textbx_div"><input name="sell" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Final Cost" readonly></div>
               </div><!---food_box_full_cc--->
            
        </div>
     
         <?php
		  }
	 }else if($_REQUEST['value']=="projectcalculator"){
		 //`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`)
		 $sql_login  =  $database->mysqlQuery("select `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP` from fc_recipe_master  WHERE fcm_menuid ='".$_REQUEST['menuid']."'  "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
			  
		 ?>
        <div class="food_calc_in_cc">
          <div class="food_project_calc_head">Project Calculator</div>
          <div class="food_box_full_cc">
              <div style="width:30%" class="food_calc_textbx_div">
                  <span>Sell PP</span>
                 <span> <input name="sellpp"  id="sellpp" type="text" class="form-control food_calc_text" placeholder="Sell" value="<?=$result_login['fcm_sell_pp']?>"> %</span>
              </div>
              <div style="width:68%" class="food_calc_textbx_div">
                  <span>Orginal Cost-(CP)</span>
                 <span  style="width: 100%;"> <input name="pc_cost" id="pc_cost"  style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Cost"  value="<?=$result_login['fcm_total_finalcost']?>" readonly></span>
              </div>
          </div><!---food_box_full_cc--->
           <div style="border:0;    margin-bottom: 0;" class="food_box_full_cc">
              <div style="width:40%" class="food_calc_textbx_div">Cost based on sel PP</div>
              <div style="width:35%" class="food_calc_textbx_div"> <input name="basedpccost" id="basedpccost" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Cost Based PP" value="<?=$result_login['fcm_cost_sel_PP']?>" readonly></div>
               <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn sellppsave" href="#">SET</a></div>
           </div><!---food_box_full_cc--->
      </div>
      <script src="js/foodcosting_prjtcalc.js"></script>  
         <?php
		  }
		  }else
		  {
			   ?>
         <div class="food_calc_in_cc">
          <div class="food_project_calc_head">Project Calculator</div>
          <div class="food_box_full_cc">
              <div style="width:30%" class="food_calc_textbx_div">
                  <span>Sell PP</span>
                 <span> <input name="sell" type="text" class="form-control food_calc_text" placeholder="Sell"> %</span>
              </div>
              <div style="width:68%" class="food_calc_textbx_div">
                  <span>Orginal Cost-(CP)</span>
                 <span  style="width: 100%;"> <input name="pc_cost" id="pc_cost"  style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Cost"  readonly></span>
              </div>
          </div><!---food_box_full_cc--->
           <div style="border:0;    margin-bottom: 0;" class="food_box_full_cc">
              <div style="width:40%" class="food_calc_textbx_div">Cost based on sel PP</div>
              <div style="width:35%" class="food_calc_textbx_div"> <input name="based" style="width: 100%;" type="text" class="form-control food_calc_text" placeholder="Cost Based PP" readonly></div>
              <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">SET</a></div>
           </div><!---food_box_full_cc--->
      </div>
     
         <?php
		  }
	 }else if($_REQUEST['value']=="servingcoutsetcalc"){
		 //`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`)
		 $sql_login  =  $database->mysqlQuery("select fcm_serving from fc_recipe_master  WHERE fcm_menuid ='".$_REQUEST['menuid']."'  "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
			  
		 ?>
       <div class="food_calc_in_cc">
          <div class="food_project_calc_head">Serving Count & Calculator</div>
           <div style="margin-top:5px;margin-bottom: 0;border: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
              <div style="width:25%" class="food_calc_textbx_div">Serving</div>
              <div style="width:45%" class="food_calc_textbx_div"> <input name="servingfirst" id="servingfirst" style="width: 100%;" type="text" class="food_calc_text" placeholder="Serving" value="<?=$result_login['fcm_serving']?>"></div>
              <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn setservingcount" href="#">SET</a></div>
           </div><!---food_box_full_cc--->
           <div class="food_box_full_cc food_sec_cal_head">Export</div>
           <div style="margin-top:3px;border:0;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
             <!-- <div style="width:25%" class="food_calc_textbx_div">New Serving</div>-->
              <div style="width:45%" class="food_calc_textbx_div"> <input name="exportingnos" id="exportingnos" style="width: 100%;" type="text" class="food_calc_text" placeholder="Export"></div>
              <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn exporttopdf" href="#">PDF</a></div>
              <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn exporttoexcel" href="#">Excel</a></div>
           </div><!---food_box_full_cc--->
      </div>
         <script src="js/foodcosting_servect.js"></script>  
         <?php
		  }
		  }else
		  {
			   ?>
         <div class="food_calc_in_cc">
            <div class="food_project_calc_head">Serving Count & Calculator</div>
             <div style="margin-top:5px;margin-bottom: 0;border: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
                <div style="width:25%" class="food_calc_textbx_div">Serving</div>
                <div style="width:45%" class="food_calc_textbx_div"> <input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Serving"></div>
                <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn" href="#">SET</a></div>
             </div><!---food_box_full_cc--->
             <div class="food_box_full_cc food_sec_cal_head">Export</div>
             <div style="margin-top:3px;border:0;margin-bottom: 0;padding: 2px 0 0 0;" class="food_box_full_cc">
               <!-- <div style="width:25%" class="food_calc_textbx_div">New Serving</div>-->
                <div style="width:45%" class="food_calc_textbx_div"> <input name="sell" style="width: 100%;" type="text" class="food_calc_text" placeholder="Export"></div>
                <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn " href="#">PDF</a></div>
                <div style="width:25%" class="food_calc_textbx_div"><a class="food_set_btn " href="#">Excel</a></div>
             </div><!---food_box_full_cc--->
        </div>
     
         <?php
		  }
	 }else if($_REQUEST['value']=="submitservingcount"){
		
		/******************************* Preparation Method values********************************************/
		//`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`) 
		$insertion['fcm_menuid']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuidselected']);
	 $sql=$database->check_duplicate_entry('fc_recipe_master',$insertion);
	 if($sql!=1)
	  {
		  $insertion['fcm_serving']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['servingfirst']);
	  	  $insertid              			=  $database->insert('fc_recipe_master',$insertion);
	  	  echo "added";
	  }else
	  {
		  $condition						= 'fcm_menuid=\''.$_REQUEST['menuidselected'].'\' ';
		  $insertion['fcm_serving']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['servingfirst']);
		  $insertid              			=  $database->update('fc_recipe_master',$insertion,$condition); 
		  echo "updated";
	  } 
	 // echo $insertion['fc_ingredientid'];
	 }else if($_REQUEST['value']=="submitsellpp"){
		
		/******************************* Preparation Method values********************************************/
		//`fc_recipe_master`(`fcm_menuid`, `fcm_total_makingcost`, `fcm_total_wastagecost`, `fcm_total_finalcost`, `fcm_sell_pp`, `fcm_cost_sel_PP`, `fcm_serving`, `fcm_preparationmethod`) sellpp basedpccost
		$insertion['fcm_menuid']				= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuidselected']);
	 $sql=$database->check_duplicate_entry('fc_recipe_master',$insertion);
	 if($sql!=1)
	  {
		  $insertion['fcm_sell_pp']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['sellpp']);
		  $insertion['fcm_cost_sel_PP']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['basedpccost']);
	  	  $insertid              			=  $database->insert('fc_recipe_master',$insertion);
	  	  echo "added";
	  }else
	  {
		  $condition						= 'fcm_menuid=\''.$_REQUEST['menuidselected'].'\' ';
		  $insertion['fcm_sell_pp']			= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['sellpp']);
		  $insertion['fcm_cost_sel_PP']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['basedpccost']);
		  $insertid              			=  $database->update('fc_recipe_master',$insertion,$condition); 
		  echo "updated";
	  } 
	 // echo $insertion['fc_ingredientid'];
	 }else if($_REQUEST['value']=="loadimagestotal"){
		 //`tbl_menuimages`(`mes_imagename`, `mes_imagethumb`, `mes_menuid`)
		 $sql_login  =  $database->mysqlQuery("select * from tbl_menuimages  WHERE mes_menuid ='".$_REQUEST['menuid']."'  "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
			  
		 ?>
      <div class="food_image_thumb">
           <div class="food_cost_image"><img src="<?=$result_login['mes_imagethumb']?>" width="100" height="100" ></div>
           <a class="tab_edt_btn11 food_image_delete" href="#" id="m_<?=$result_login['mes_menuid']?>" imgid="m_<?=$result_login['mes_imagename']?>"></a>
       </div>
         <?php
		  }
		  }else
		  {
			  echo "Nothing to display";
		  } 
		  
		  ?>
          <script src="js/foodcosting_delimage.js"></script>  
          <?php
	 }else if($_REQUEST['value']=="exporttoexcel"){
		$data=array();
		$data1=array();
		$xlsRow=1;  
		$exportingnos =$_REQUEST['exportingnos'];
		
		 $db1=DATABASE_NAME.".fc_recipe_details";
		 $db2=INV_DATABASE_NAME.".inv_tbl_productmaster";
		 $db3=INV_DATABASE_NAME.".inv_tbl_unitmaster";
		  $db4=DATABASE_NAME.".tbl_menumaster";
						  
	   $sql_login  =  $database->mysqlQuery("select * from $db1 fd LEFT JOIN $db4 as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){
			while($result_login  = $database->mysqlFetchArray($sql_login)) 
			  {
				  $data['Sl No']		=$xlsRow;
				  $data['Item Name']	=$result_login['prm_productname'];
				  $data['Unit Qty']		=$result_login['fc_qty'];
				  $data['New Qty']		=round($exportingnos * $result_login['fc_qty'],2);
				  $data['Unit']			=$result_login['um_name'];
				  array_push($data1,$data);
				  unset($data);
				  $xlsRow++; 			  
			  }
		}
		$menuname=$database->show_menu_wholeful_details($_REQUEST['menuid']);
		 $filename = "Food Quantity - " . $menuname['mr_menuname'] . ".xls";
		  header("Content-Disposition: attachment; filename=\"$filename\"");
		  header("Content-Type: application/vnd.ms-excel");
		
		  $flag = false;
		  foreach($data1 as $row) {
			if(!$flag) {
			  echo implode("\t", array_keys($row)) . "\n";
			  $flag = true;
			}
			array_walk($row, 'cleanData');
			echo implode("\t", array_values($row)) . "\n";
		  }
		  unset($data);
		  unset($data1);
		  exit;
		
		
 
	 }
	 
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
?>
 