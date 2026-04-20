<!-- <script src="js/jquery-1.10.2.min.js"></script>-->
  <script type="text/javascript">
   $(document).ready(function() {
	   
	   
		$('.md-trigger_rate').click( function() { 
	
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_rate.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	


	$('.md-trigger_comb').click( function() { 
	//alert("hiii")
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_comb.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-trigger_image').click( function() { 
	//alert("hiii")
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_image.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-trigger_pref').click( function() { 
	//alert("hiii")
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_pref.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-trigger_nutr').click( function() { 
	//alert("hiii")
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_nutr.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-trigger_ingr').click( function() { 
	//alert("hiii")
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_ingr.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-close_pop').click( function() {  	
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
	});   
	   /***************************************  row click starts *************************************************  */
    $('.scroll tbody tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		$('.scroll tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
		/***************************************  row click ends *************************************************  */
		
		$('.viewpage').css("display", "none");	
		$(".addnewdiv").css("display", "none");
		$(".load_divview"+selval).css("display", "block");
		$('.delbutton').css("display", "block");	
		$('.editbutton').css("display", "block");	
		$('.savebutton').css("display", "none");	
    });
	 $('.addbtn').click(function() {
		$('.viewpage').css("display", "none");	
		$('.editpage').css("display", "none");
		$('.savebutton').css("display", "block");		
		 $('.addnewdiv').css("display", "block");	
		 });
	
<?php  if(isset($_REQUEST['edit'])){ ?>
		$('.viewpage').css("display", "none");	
		$('.addnewdiv').css("display", "none");
		$('.editpage').css("display", "block");
<?php } ?>
});
   </script>
   
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include('includes/master_settings.php');
require_once("includes/title_settings.php");
include('includes/menu_settings.php');
if($_REQUEST['value']=="searchcategory"){
	/* ******************************************** Category master ******************************************************* */
	$categrys	= $_REQUEST['categrys'];
	$displys= $_REQUEST['displys'];
	$statuss= $_REQUEST['statuss'];
	$search="";
        
        
        if($_REQUEST['inv_search']!="null")
	{
		if($search!="")
		{
			$search.=" and  mmy_inventory =  '".$_REQUEST['inv_search']."'";
		}else
		{
			$search.=" mmy_inventory =  '".$_REQUEST['inv_search']."'";
		}
	}
        
        
	if($categrys!="null")
	{
		if($search!="")
		{
			$search.=" and  mmy_maincategoryname LIKE  '%" . $categrys ."%'";
		}else
		{
			$search.=" mmy_maincategoryname LIKE  '%" . $categrys ."%'";
		}
	}
	if($displys!="null")
	{
		if($search!="")
		{
			$search.=" and  mmy_displayorder LIKE  '%" . $displys ."%'";
		}else
		{
			$search.=" mmy_displayorder LIKE  '%" . $displys ."%'";
		}
	}
	if($statuss!="null")
	{
		$sr="";
	$type=strtolower($statuss);
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
			$search.=" and  mmy_active LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" mmy_active LIKE  '%" . $sr ."%'";
		}
	}
	
?>
 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/category_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});

function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="category_master.php?id="+id+"&delete=yes";
		}else
		{window.location="category_master.php?id="+id+"&delete=no";
		}
	}
	
}	
</script>
   <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">        
 <thead>
 <tr>
    <td width="20%">Category Name</td>
    <td >Display Order</td>
      <td >Print Order</td>
    <td style="display:none" >Active</td>
     <td >Inventory</td>
     <td >Action</td>
     <td >Qr Image</td>
      <td >KOT Printer</td>
       <td >Addons</td>
     <td >Preference</td>
  </tr>
   </thead>
     <tbody >  
         
  <?php

  if($search!="")
  {
	  $search="where mmy_delete_mode='N' and  $search";
  }else{
      
          $search="where mmy_delete_mode='N' ";
  }

    $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menumaincategory $search ORDER BY LPAD(lower(mmy_displayorder), 10,0) ASC");
    $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){ $k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if($result_cat_s['mmy_active']=="Y")
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
					  $_SESSION['menuidselect']=$result_cat_s['mmy_maincategoryid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
                                
                                
                  if($result_cat_s['mmy_inventory']=="Y")
				{
					$inv="Yes";
				}else 
				{
					$inv="No";
				}	               
                                
      ?>
         
   	<tr id="ids_<?=$result_cat_s['mmy_maincategoryid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['mmy_maincategoryid']){ ?> table_active <?php } ?> ">
         <td width="20%"><?=$database->highlightkeyword($result_cat_s['mmy_maincategoryname'],$categrys)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['mmy_displayorder'],$displys)?></td>
         <td ><?=$result_cat_s['mmy_orderof_print']?></td>
         <td style="display:none"><?=$database->highlightkeyword($active,$statuss)?></td>
         
         <td >
                                  
             <?=$inv?>
        </td>
         
          <td >
         <a href="#" class="md-trigger_cat" id="ids_<?=$result_cat_s['mmy_maincategoryid']?>" ><img src="images/edit_page.PNG"></a>
             <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['mmy_maincategoryid']?>">
       <!--  <a href="#" onClick="delete_confirm('<?=$result_cat_s['mmy_maincategoryid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
         <?php if($result_cat_s['mmy_active']=="Y"){ ?>  
             <a title="Active" onClick="delete_confirm('ToNo','<?=$result_cat_s['mmy_maincategoryid']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
            <a title="Inactive" onClick="delete_confirm('ToYes','<?=$result_cat_s['mmy_maincategoryid']?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a>
                                 <?php } ?>       
       
                                </td>
                                
                       <td>
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black " href="#" onclick="cat_image('<?=$result_cat_s['mmy_maincategoryid']?>')">Qr Image</a>
                              </td>     
                              
                              
                               <td >
                                  
                                                
    <select onchange="kitchen_printer('<?=$result_cat_s['mmy_maincategoryid']?>')" id='kitchen_printer_<?=$result_cat_s['mmy_maincategoryid']?>' style="width: 80px;font-size: 10px;font-weight: bold ">
    <option> * Kitchen Printer</option>
    <?php
    $sql_login5  =  $database->mysqlQuery("select kr_kotcode,kr_kotname from tbl_kotcountermaster "); 
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
	    while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{
    ?>
             <option <?php if($result_login5['kr_kotcode']== $result_cat_s['last_printer_kitchen']){ ?> selected <?php } ?> nm="<?=$result_login5['kr_kotname']?>" value="<?=$result_login5['kr_kotcode']?>"><?=$result_login5['kr_kotname']?></option>
     
          <?php } } ?>
    
 </select>
                                   
                                   
                                
                                </td>
                                
                                
                        <td >
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black ;border-radius: 5px" href="#" onclick="cat_addon('<?=$result_cat_s['mmy_maincategoryid']?>')">Addon</a>
                              </td>
                              
                              <td >
                                  
                                    <a style="border:solid 1px ;padding: 3px;color: black;border-radius: 5px " href="#" onclick="cat_pref('<?=$result_cat_s['mmy_maincategoryid']?>')">Pref</a>
                              </td>         
                                
                                
                                
          </tr>
  <?php $k++;}} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
 else if($_REQUEST['value']=="searchsubcategory"){
     
	 /* ************************* Sub Category master *************** */ 
	// subcatnams statuss 
	$subcatnams= $_REQUEST['subcatnams'];
	$statuss= $_REQUEST['statuss'];
	$search="";
        
	if($subcatnams!="null")
	{
		if($search!="")
		{
			$search.=" and  msy_subcategoryname LIKE  '%" . $subcatnams ."%'";
		}else
		{
			 $search.=" msy_subcategoryname LIKE  '%" . $subcatnams ."%'";
		}
	}
	if($statuss!="null")
	{
		$sr="";
	$type=strtolower($statuss);
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
			$search.=" and  msy_active LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" msy_active LIKE  '%" .$sr ."%'";
		}
	}
	
?>
<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/subcategory_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});

function delete_confirm3(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="sub_category_master.php?id="+id+"&delete=yes";
		}else
		{window.location="sub_category_master.php?id="+id+"&delete=no";
		}
	}
	
}

</script>
   <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">        
 <thead>
 <tr>
     <th>Sub Category Name</th>
    <th>Active</th>
     <td >Action</td>
  </tr>
   </thead>
     <tbody >                                           
   <?php
   if($search!="")
  {
	  $search="where  msy_delete_mode='N' and  $search";
  }else{
      
          $search="where  msy_delete_mode='N' ";
      
  }

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menusubcategory $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if($result_cat_s['msy_active']=="Y")
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
					  $_SESSION['menuidselect']=$result_cat_s['msy_subcategoryid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
         	<tr id="ids_<?=$result_cat_s['msy_subcategoryid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['msy_subcategoryid']){ ?> table_active <?php } ?> ">
          <td><?=$database->highlightkeyword($result_cat_s['msy_subcategoryname'],$subcatnams)?></td>
            <td><?=$database->highlightkeyword($active,$statuss)?></td>
            <td> 
             <a href="#" class="md-trigger_cat" id="ids_<?=$result_cat_s['msy_subcategoryid']?>" ><img src="images/edit_page.PNG"></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['msy_subcategoryid']?>">
             <!--<a href="#" onClick="delete_confirm('<?=$result_cat_s['msy_subcategoryid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                <?php if($result_cat_s['msy_active']=="Y"){ ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_cat_s['msy_subcategoryid']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_cat_s['msy_subcategoryid']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } ?>       
             
            </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
   else if($_REQUEST['value']=="searchextratax"){
	/* ******************************************** Extra Tax ******************************************************* */
	$extrataxs	= $_REQUEST['extrataxs'];
        $tax_type=  $_REQUEST['tax_type'];
        
	$search="";
	if($extrataxs!="null")
	{
		if($search!="")
		{
			$search.=" and  amc_name LIKE  '%" . $extrataxs ."%'";
		}else
		{
			$search.=" amc_name LIKE  '%" . $extrataxs ."%'";
		}
	}
        
        
        
        if($tax_type!="null")
	{
		if($search!="")
		{
			$search.=" and  amc_item_tax ='$tax_type'";
		}else
		{
			$search.=" amc_item_tax ='$tax_type'";
		}
	}
        
        
        
        ?>
	<script src="js/jquery-1.10.2.min.js"></script>
        <script>
$(document).ready(function(){
	$('.md-trigger_tax').click( function() {
		
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/extra_tax_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
<table class="responstable tablesorter table_report" id="listall">
   <thead>
      <tr>
                                                    <th width="10%">Action</th>
                                                    <th width="5%">Sl No</th>
                                                    <th width="17%">Name</th>
                                                    <th width="8%">Unit</th>
                                                     <th width="10%">Item Tax </th>
                                                      <th width="10%">Value</th>
                                                      <th width="10%">Label</th>
                                                     <th width="10%">Active</th>
                                                   <th width="7%">Symbol</th>
                                                    <th width="4%">CS </th>
                                                     <th width="4%">TA </th>
                                                      <th width="4%">HD </th>
                                                       <th width="10%">Action</th>
                                                  </tr>
    </thead>   
    <tbody>
        
  <?php
   if($search!="")
    {
	  $search="where $search";
    }
  	
        $sql_cat_s  =  $database->mysqlQuery("select * from tbl_extra_tax_master $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
                           
                     if($result_cat_s['amc_enable_cs']=="Y")
				{
				
					$activecs="Yes";
				}else 
				{
					$activecs="No";
				}
                                
                                  if($result_cat_s['amc_enable_ta']=="Y")
				{
				
					$activeta="Yes";
				}else 
				{
					$activeta="No";
				}
                                
                                  if($result_cat_s['amc_enable_hd']=="Y")
				{
				
					$activehd="Yes";
				}else 
				{
					$activehd="No";
				}
                    
                    
                    
                    
                    
                    
                    
				if($result_cat_s['amc_active']=="Y")
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
					  $_SESSION['menuidselect']=$result_cat_s['amc_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
    <tr id="ids_<?=$result_cat_s['amc_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['amc_id']){ ?> table_active <?php } ?> ">
        <td width="10%"> 
             <a href="#" class="tab_edt_btn md-trigger_tax" id="ids_<?=$result_cat_s['amc_id']?>" ><i class="fa fa-edit"></i></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['amc_id']?>">       
             
        </td>
<!--         <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$_SESSION['menuidselect']?>">-->
            <td width="5%"><?=$i?></td>
            <td width="17%"><?=$database->highlightkeyword($result_cat_s['amc_name'],$extrataxs)?></td>
             <td width="8%"><?=$result_cat_s['amc_unit']?></td>
              <td width="10%"><?=$result_cat_s['amc_item_tax']?></td>
             <td width="10%"><?=$result_cat_s['amc_value']?></td>
                                <td width="10%"><?=$result_cat_s['amc_label']?></td>
                               <td width="10%"><?=$active?></td>
                                <td width="7%"><?=$result_cat_s['amc_symbol']?></td>
                                 <td width="4%"><?=$activecs?></td>
                                <td width="4%"><?=$activeta?></td>
                                <td width="4%"><?=$activehd?></td>
                                <td  width="10%">
                                    
                                <?php if($result_cat_s['amc_item_tax']!='Y' && $_SESSION['expodine_id']=='admin'){ ?>    
                                    
                                <a style="margin-bottom: 8px;font-weight: bold;
                                border:solid 1px;width: 25px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn" onclick="tax_apply('<?=$result_cat_s['amc_id']?>','DI','<?=$result_cat_s['amc_name']?>')" >
                                DI</a>
                                    
                                <a style="font-weight: bold;margin-bottom: 8px;border:solid 1px;width: 25px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn " onclick="tax_apply('<?=$result_cat_s['amc_id']?>','TA','<?=$result_cat_s['amc_name']?>')" >
                                TA</a>   
                                    
                                <?php }else{ ?>  
                                    
                               <span title="ITEM TAX NOT POSSIBLE . ADMIN ONLY PRIVELEGE" style="font-weight: bold;margin-bottom: 8px;border:solid 1px;width: 56px;border-radius: 3px;line-height: 22px;" href="#" class="tab_edt_btn " >X</span>
                                    
                                <?php } ?>    
                                    
                                </td>
            
          </tr>
  <?php $k++;$i++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
</table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
	 else if($_REQUEST['value']=="searchfloor")
	 { 	
	 /* ******************************************** Floor master ******************************************************* */
		$floor	= $_REQUEST['floorid'];
		$branch= $_REQUEST['branchid'];
		$status= $_REQUEST['statuss'];
		$search="";
	if($floor!="null")
	{
		if($search!="")
		{
			$search.=" and  fr_floorname LIKE  '%" . $floor ."%'";
		}else
		{
			$search.=" fr_floorname LIKE  '%" . $floor ."%'";
		}
	}
	if($branch!="null")
	{
		if($search!="")
		{
			$search.=" and  be_branchname LIKE  '%" . $branch ."%'";
		}else
		{
			$search.=" be_branchname LIKE  '%" . $branch ."%'";
		}
	}
	if($status!="null")
	{
		if($search!="")
		{
			$search.=" and  fr_status =  '" . $status ."'";
		}else
		{
			$search.=" fr_status =  '" . $status ."'";
		}
	}
	?>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_flr').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/floor_edit.php", {floor:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>

 <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1"> 
 <thead>
 <tr>
    <th>Floor</th>
    <th>Branch</th>
  
  
   
    <th>Status</th>
   
    <td>Action</td>
  </tr>
   </thead>
     <tbody >                                           
                                            
  <?php	
if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['fr_floorid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
         	<tr id="ids_<?=$result_cat_s['fr_floorid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['fr_floorid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['fr_floorname'],$floor)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['be_branchname'],$branch)?></td>
        
         <td><?=$database->highlightkeyword($result_cat_s['fr_status'],$status)?></td>
         
         <td>
         <a href="#" class="md-trigger_flr" id="ids_<?=$result_cat_s['fr_floorid']?>" ><img src="images/edit_page.PNG"></a>
             <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['fr_floorid']?>">
             
             
              <a class="flor_copy_btn" style="position:relative" title="Copy" href="#" id="ids_<?=$result_cat_s['fr_floorid']?>"><div   class="action_button"><img src="img/copy_ico.png"></div>  </a> 
              <a onclick="return floor_popup('<?=$result_cat_s['fr_floorid']?>','<?=$result_cat_s['fr_floorname']?>');" class="md-trigger" id="tax_popup_floor" href="#"><div class="action_button"><img width="25px" src="img/tax_icon.png"></div></a>
                                 	<div  class="floor_copy florrval<?=$result_cat_s['fr_floorid']?>" >
                                          <?php /*?>  <select style="width:70%;float:left;margin:3px 0 0 3px;" class="filte_new_box">
                                            	<option>Floor</option>
                                                <option>Floor</option>
                                            </select><?php */?>
                                                <div class="form_textbox_cc"  > 
                                                <div class="form-group" id="floorrate_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster where fr_floorid<>'".$result_cat_s['fr_floorid']."'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     						?>
                                        <select data-placeholder="Enter Floor" id="floorrate<?=$result_cat_s['fr_floorid']?>" name="floorrate" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" style="margin:3px 0 0 3px;" class="filte_new_box">
                                        <option value="">--From Floor--</option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                           <?php /*?> <option value="<?=$result_kot['fr_floorid']?>" ><?=$result_kot['fr_floorname']?></option><?php */?>
                                              <option value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                            
                                    <a href="#"> <span class="ok_btn" id="ids_<?=$result_cat_s['fr_floorid']?>" > OK </span> </a>      
                                    </div><!--floor_copy-->
             
             
             
             
             
             
             
       <!--  <a href="#" onClick="delete_confirm('<?=$result_cat_s['fr_floorid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                                </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
<script type="text/javascript">
	
		$(".flor_copy_btn").click( function(){ 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		
		$(".floor_copy").removeClass("copy_flor_cc");
		//$(".florrval"+selval).css('display','block');
			$(".florrval"+selval).addClass("copy_flor_cc");
			//$(".flor_copy_btn").show();
		});
		
		$(".ok_btn").click( function(){ 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	//	 alert(selval);
		var floorrate=$("#floorrate"+selval).val();
		//alert(floorrate);
		if(floorrate!="")
		{
			
	
		$(".florrval"+selval).removeClass("copy_flor_cc");
		//$(".florrval"+selval).css('display','none');
	
		 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=addfloorrate&new_floorid="+selval+"&floorid="+floorrate,
			success: function(msg)
			{
				msg=msg.trim();
				//alert(msg);
				$('#ratechng').css("display","block");
			var ratechng1=$('#ratechng');
			ratechng1.text('Rate changed successfully!!');
					 $(".load_error").delay(2000).fadeOut('slow');
		   }
		});
		}else
		{
		//	alert("select floor");
			$('#ratechng').css("display","block");
			var ratechng=$('#ratechng');
			ratechng.text('Select floor!!');
			$(".load_error").delay(2000).fadeOut('slow');
		}
		});
		

	</script>	

     <?php } 
	else if($_REQUEST['value']=="searchmenu"){
 /* ******************************************** Menu master ******************************************************* */
		////mname mcate msubc mdiet mstatus
	$mname	= $_REQUEST['mname'];
	$mcate=$_REQUEST['mcate'];
	$msubc=$_REQUEST['msubc'];
	$mdiet=$_REQUEST['mdiet'];
	$mstatus=$_REQUEST['mstatus'];
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
			$search.=" and  mr_diet LIKE  '" . $mdiet ."%'";
		}else
		{
			$search.=" mr_diet LIKE  '" . $mdiet ."%'";
		}
	}
	
	if($mstatus!="null")
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
	}
?>
 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
$(document).ready(function(){
	$('.responstable tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		$('.responstable tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
		
    });
	$('.md-trigger_edit').click( function() { 
	    var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
                          localStorage.editid=menuid;
                          
                          localStorage.editing_slno=$('#editing_slno_'+menuid).text();
			  $.post("popup/menu_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.md-trigger_view').click( function() { 
	    var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  
			  $.post("popup/menu_view.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
        
        $('.md-trigger_rate').click( function() { 
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_rate.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
        $('.md-trigger_tax').click( function() { 
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_tax.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
        
        
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});
</script>
   <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
 <thead>
 <tr>
  <th width="3%">Sl No</th>
  <th width="20%">Menu</th>
  <th width="10%">Main Category</th>
  <th  width="10%">Sub Category</th>
  <th width="10%">Diet</th>
  <th width="5%">Active</th>
  <th width="8%">Show KOD</th>
  <th width="12%">Action</th>
  <th width="5%">Rate</th>
  <th width="6%">Item Tax</th>
  </tr>
   </thead>
     <tbody >                                           
  <?php  
  if($search!="")
  {
	  $search="where $search";
  }  
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menumaster INNER JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid  LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid  $search LIMIT 0,30");

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if($result_cat_s['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
                                	if($result_cat_s['mr_show_in_kod']=="Y")
				{
					$activekod1="Yes";
				}else 
				{
					$activekod1="No";
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
				}
?>
    	<tr id="ids_<?=$result_cat_s['mr_menuid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['mr_menuid']){ ?> table_active <?php } ?> ">
         <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$_SESSION['menuidselect']?>">
            <td width="3%" id="editing_slno_<?=$result_login['mr_menuid']?>"><?=$i?></td>
         <td width="20%"><?=$database->highlightkeyword($result_cat_s['mr_menuname'],$mname)?></td>
         <td width="10%"><?=$database->highlightkeyword($result_cat_s['mmy_maincategoryname'],$mcate)?></td>
         <td  width="10%"><?=$database->highlightkeyword($result_cat_s['msy_subcategoryname'],$msubc)?></td>
         <td width="10%"><?=$database->highlightkeyword($result_cat_s['mr_diet'],$mdiet)?></td>
         <td width="5%"><?=$database->highlightkeyword($active,$mstatus)?></td>
           <td width="8%"><?=$database->highlightkeyword($activekod1,$mstatus)?></td>
           
          <td  width="12%" style="text-align: left !important"> <a class="tab_edt_btn md-trigger_view" id="set_<?=$result_cat_s['mr_menuid']?>" ><i class="icontick"><img src="img/icon-view.png" width="22px" height="22px"/></i></a>
            <a  class="tab_edt_btn md-trigger_edit" id="set_<?=$result_cat_s['mr_menuid']?>" ><i class="fa fa-edit"></i></a>
           <?php  if($active=="Yes") { ?>
           

           <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToNo','<?=$result_cat_s['mr_menuid']?>')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"/></i></a>

           <?php }else if($active=="No") { ?>

           <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToYes','<?=$result_cat_s['mr_menuid']?>')"><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"/></i></a>

           <?php } ?>
           <a onclick="return discount_icon('<?=$result_cat_s['mr_menuid']?>','<?=$result_cat_s['mr_menuname']?>');" class="tab_edt_btn discount_pop_btn" href="#"><i class="icontick"><img src="img/discount_ico.png" width="28px" height="25px"/></i></a>
           </td>
           <td width="5%">
           <a class="md-trigger_rate" id="set_<?=$result_cat_s['mr_menuid']?>"><img src="img/rate.png"></a></td>
           <td width="6%"><a class="md-trigger_tax" id="set_<?=$result_cat_s['mr_menuid']?>"><img src="img/tax-icon.png"></a></td>
          </tr>
  <?php $k++;$i++; }} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
	else if($_REQUEST['value']=="searchcountry"){
		/* ******************************************** Country master ******************************************************* */
		$search="";
	 $country	= $_REQUEST['country'];
	 $nationality= $_REQUEST['nationality'];
	 $currency	= $_REQUEST['currency'];
	if($country!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_countryname LIKE  '%" . $country ."%'";
		}else
		{
			$search.=" cy_countryname LIKE  '%" . $country ."%'";
		}
	}
	if($nationality!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_nationality LIKE  '%" . $nationality ."%'";
		}else
		{
			$search.=" cy_nationality LIKE  '%" . $nationality ."%'";
		}
	}
	if($currency!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_currencycode LIKE  '%" . $currency ."%'";
		}else
		{
			$search.=" cy_currencycode LIKE  '%" . $currency ."%'";
		}
	}
?>
<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_country').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/country_edit.php", {menu:menuid},
				  function(data)
				  {
					
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
 <thead>
 <tr>
    <th>Country</th>
   
    <td>Action</td>
  </tr>
   </thead>
     <tbody >                                           
  <?php
  if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_country $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['cy_countyid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
         <tr id="ids_<?=$result_cat_s['cy_countyid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['cy_countyid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['cy_countryname'],$country)?></td>
         
          <td >
          <a href="#" class="md-trigger_country" id="ids_<?=$result_cat_s['cy_countyid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['cy_countyid']?>">
           <a style="display:none" href="#" onClick="delete_confirm('<?=$result_cat_s['cy_countyid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>

     <?php }
	 else if($_REQUEST['value']=="searchstate"){
		 /* ******************************************** state master ******************************************************* */
	$state	= $_REQUEST['srchid'];
	$country= $_REQUEST['countryid'];
	$search="";
	if($country!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_countryname LIKE  '%" . $country ."%'";
		}else
		{
			$search.=" cy_countryname LIKE  '%" . $country ."%'";
		}
	}
	if($state!="null")
	{
		if($search!="")
		{
			$search.=" and  se_statename LIKE  '%" . $state ."%'";
		}else
		{
			$search.=" se_statename LIKE  '%" . $state ."%'";
		}
	}
	?>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script>

$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_state').click( function() { 

		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 	
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  
			  $.post("popup/state_edit.php", {state:menuid},
				  function(data)
				  {
					
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
 <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">              
 <thead>
 <tr>
    <th>State</th>
    <th >Country</th>
     <td>Action</td>
  </tr>
   </thead>
     <tbody >                                           
  <?php
  if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_state INNER JOIN tbl_country ON tbl_state.se_countryid=tbl_country.cy_countyid  $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['se_stateid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
   	<tr id="ids_<?=$result_cat_s['se_stateid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['se_stateid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['se_statename'],$state)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['cy_countryname'],$country)?></td>
          <td >
                <a href="#" class="md-trigger_state" id="ids_<?=$result_cat_s['se_stateid']?>" ><img src="images/edit_page.PNG"></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['se_stateid']?>">
                <a href="#" onClick="delete_confirm('<?=$result_cat_s['se_stateid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>

     <?php }
	else if($_REQUEST['value']=="searchcity"){
		/* ******************************************** city master ******************************************************* */
	$city	= $_REQUEST['srchid'];
	$state= $_REQUEST['stateid'];
	$country= $_REQUEST['countryid'];
	$search="";
	if($city!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_cityname LIKE  '%" . $city ."%'";
		}else
		{
			$search.=" cy_cityname LIKE  '%" . $city ."%'";
		}
	}
	if($state!="null")
	{
		if($search!="")
		{
			$search.=" and  se_statename LIKE  '%" . $state ."%'";
		}else
		{
			$search.=" se_statename LIKE  '%" . $state ."%'";
		}
	}
	if($country!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_countryname LIKE  '%" . $country ."%'";
		}else
		{
			$search.=" cy_countryname LIKE  '%" . $country ."%'";
		}
	}
	?>
    <script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/city_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
 <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">           
 <thead>
 <tr>
    <th>City</th>
    <th>Country</th>
    <th>State</th>
    <td>Action</td>
  </tr>
   </thead>
     <tbody >                                           
 <?php
  if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from  tbl_city INNER JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid LEFT JOIN tbl_country ON  tbl_city.cy_countryid=tbl_country.cy_countyid $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['cy_cityid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
    	<tr id="ids_<?=$result_cat_s['cy_cityid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['cy_cityid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['cy_cityname'],$city)?></td>
          <td><?=$database->highlightkeyword($result_cat_s['cy_countryname'],$country)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['se_statename'],$state)?></td>
         <td>
           <a href="#" class="md-trigger_cat" id="ids_<?=$result_cat_s['cy_cityid']?>" ><img src="images/edit_page.PNG"></a>
               <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['cy_cityid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['cy_cityid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
          </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
	else if($_REQUEST['value']=="searchdepartment"){
		 /* ******************************************** Department master ******************************************************* */
	$depts	= $_REQUEST['depts'];
	$search="";
	if($depts!="null")
	{
		if($search!="")
		{
			$search.=" and  der_departmentname LIKE  '%" . $depts ."%'";
		}else
		{
			$search.=" der_departmentname LIKE  '%" . $depts ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_dept').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/dept_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th>Department</th>
      <td >Action</td>
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_departmentmaster $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['der_departmentid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['der_departmentid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['der_departmentid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['der_departmentname'],$depts)?></td>
          <td>
           <a href="#" class="md-trigger_dept" id="ids_<?=$result_cat_s['der_departmentid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['der_departmentid']?>">
           <a style="display: none " href="#" onClick="delete_confirm('<?=$result_cat_s['der_departmentid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	else if($_REQUEST['value']=="searchdesignation"){
		 /* ******************************************** Designation master ******************************************************* */
	$search="";	  
	$desgs	= $_REQUEST['desgs'];
	$logins= $_REQUEST['logins'];
	if($desgs!="null")
	{
		if($search!="")
		{
			$search.=" and  dr_designationname LIKE  '%" . $desgs ."%'";
		}else
		{
			$search.=" dr_designationname LIKE  '%" . $desgs ."%'";
		}
	}
	if($logins!="null")
	{
		if($search!="")
		{
			$search.=" and  dr_login LIKE  '%" . $logins ."%'";
		}else
		{
			$search.=" dr_login LIKE  '%" . $logins ."%'";
		}
	}
	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_desg').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/desg_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
    <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
 <thead>
 <tr>
    <th>Designation</th>
   <th>Login</th>
    <td >Take Order</td>
  </tr>
   </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_designationmaster $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['dr_designationid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				} 
?>
 
   	<tr id="ids_<?=$result_cat_s['dr_designationid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['dr_designationid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['dr_designationname'],$desgs)?></td>
        <td><?=$database->highlightkeyword($result_cat_s['dr_login'],$logins)?></td>
         <td id="take_order_div<?=$result_cat_s['dr_designationid']?>">
        <?=$database->highlightkeyword($result_cat_s['dr_takeorder'],$logins)?>
              <span class="edit_ord" onclick="change_take_order('<?=$result_cat_s['dr_designationid']?>');" style="border:solid 2px;float:right;margin-right: 8px;cursor: pointer;background-color: darkslategray;color: white"> &nbsp;&nbsp; Edit &nbsp;&nbsp; </span>
           </td>
           <td style="display:none" id="edit_order<?=$result_cat_s['dr_designationid']?>">
                                      <select id="change_order" onchange="change_select_order('<?=$result_cat_s['dr_designationid']?>');" >
                                          
                                         <?php if($result_cat_s['dr_takeorder']=='Y') {?>
                                          <option value="Y" selected >Yes</option> 
                                          <option value="N"  >No</option> 
                        <?php } else{ ?>
                                          
                                          <option value="Y"  >Yes</option> 
                                          <option value="N" selected >No</option> 
                        <?php } ?>
                                     
                                       
                                      </select>
                                  </td>
           
           
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
  <?php } 
	
else if($_REQUEST['value']=="searchtable"){
            
            
		
	$tables	= $_REQUEST['tables'];
	$chairs= $_REQUEST['chairs'];
	$floors	= $_REQUEST['floors'];
	$branchs= $_REQUEST['branchs'];
	$statuss	= $_REQUEST['statuss'];
	$search="";
	if($tables!="null")
	{
		if($search!="")
		{
			$search.=" and  tr_tableno LIKE  '%" . $tables ."%'";
		}else
		{
			$search.=" tr_tableno LIKE  '%" . $tables ."%'";
		}
	}
	if($chairs!="null")
	{
		if($search!="")
		{
			$search.=" and  tr_maxchaircount LIKE  '%" . $chairs ."%'";
		}else
		{
			$search.=" tr_maxchaircount LIKE  '%" . $chairs ."%'";
		}
	}
	if($floors!="null")
	{
		if($search!="")
		{
			$search.=" and  fr_floorname LIKE  '" . $floors ."%'";
		}else
		{
			$search.=" fr_floorname LIKE  '" . $floors ."%'";
		}
	}if($branchs!="null")
	{
		if($search!="")
		{
			$search.=" and  be_branchname LIKE  '%" . $branchs ."%'";
		}else
		{
			$search.=" be_branchname LIKE  '%" . $branchs ."%'";
		}
	}
        
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  tr_status='".$statuss."'";
		}else
		{
			$search.=" tr_status='".$statuss."'";
		}
	}

?>

<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
     var url_check=$('#url_check').val();
    
   var new_id=url_check.split('load_id=');
   
   
    $('#ids_'+new_id[1]).addClass('table_active');
    
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_table').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/table_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1" style="margin-bottom:20px;">            
 <thead>
 <tr>
      <th width="8%" >. SL</th>
    <th>Table Name</th>
    <th>Chair Count</th>
      <th>Vaccant</th>
    <th>Floor</th>
    <th style="display:none">Branch</th>
    <th>Status</th>
     <th>Display Order</th> 
      <th>Time Alloted</th>
    <td>Action</td>
    
  </tr>
   </thead>
     <tbody >                                           
<?php
 if($search!="")
  {
	  $search="where $search";
  }
  
  
$fl_name='';
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_tablemaster INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid"
        . " INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid   $search ORDER BY fr_floorname,tr_tableno+0 asc");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0; $i=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{ $i++;
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['tr_tableid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
                                
                                
                             if($fl_name!=$result_cat_s['fr_floorname']){ 
                         
                         $fl_name=$result_cat_s['fr_floorname'];
                         
                         ?>
                         <tr>
                             <td style="font-weight:bold;color:darkred;text-transform: uppercase">FLOOR : <?=$result_cat_s['fr_floorname']?></td>               
                                
                              </tr>
                         
                         <?php
                     }    
                                
?>
         	<tr id="ids_<?=$result_cat_s['tr_tableid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['tr_tableid']){ ?>  <?php } ?> ">
        <td width="8%"><?=$i?></td>   
                    <td><?=$database->highlightkeyword($result_cat_s['tr_tableno'],$tables)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['tr_maxchaircount'],$chairs)?></td>
          
           <td><?=$database->highlightkeyword($result_cat_s['tr_vaccantcount'],$floors)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['fr_floorname'],$floors)?></td>
         <td style="display:none"><?=$database->highlightkeyword($result_cat_s['be_branchname'],$branchs)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['tr_status'],$statuss)?></td>
          <td><?=$result_cat_s['tr_displayorder']?></td>
         <td><?=$result_cat_s['tr_timealloted']?></td>
         <td >
             <span style="position: relative; ">
               <a style="position: absolute; top:-9px; left:-18px;cursor: pointer"  href="#" class="md-trigger_table" id="ids_<?=$result_cat_s['tr_tableid']?>" ><img src="images/edit_page.PNG"></a>
                   <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['tr_tableid']?>">
               <a href="#" onClick="delete_confirm('<?=$result_cat_s['tr_tableid']?>')"> <div class="action_button" style="display: none;" ><img src="images/delete-table.png"></div></a>
        
               <?php if($result_cat_s['tr_vaccantcount']==0 || $result_cat_s['tr_vaccantcount']==''){ ?>
               <i onclick="free_table('<?=$result_cat_s['tr_tableid']?>')" style="cursor: pointer;position: absolute; top:-4px; right:30px;" class="fa fa-unlock-alt"></i>    
               <?php } ?>
             </span>
             
             
               <a style=" margin-top:-14px; margin-left:70px;cursor: pointer;display: block" href="qr_gen/index.php?id=<?=$result_cat_s['tr_tableid']?>&floor=<?=$result_cat_s['tr_floorid']?>&name=<?=$result_cat_s['tr_tableno']?>" class="md-trigger_table" id="" ><img src="img/barcode.PNG"></a>
                                      
             
         </td
         
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>

     <?php } 
	else if($_REQUEST['value']=="searchportion"){
		 /* ******************************************** Portion master ******************************************************* */
		////portionams shtcds
	$portionams= $_REQUEST['portionams'];
		$shtcds= $_REQUEST['shtcds'];
		$search="";
	if($portionams!="null")
	{
		if($search!="")
		{
			$search.=" and  pm_portionname LIKE  '%" . $portionams ."%'";
		}else
		{
			$search.=" pm_portionname LIKE  '%" . $portionams ."%'";
		}
	}
	if($shtcds!="null")
	{
		if($search!="")
		{
			$search.=" and  pm_portionshortcode LIKE  '%" . $shtcds ."%'";
		}else
		{
			$search.=" pm_portionshortcode LIKE  '%" . $shtcds ."%'";
		}
	}

?>
 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_port').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/portion_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});
</script>

 <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">         
 <thead>
 <tr>
  <th><?=$_SESSION['s_portionname']?> Name</th>
  <th>Short Code</th>
  
</tr>
   </thead>
     <tbody >                                           
  <?php
  if($search!="")
  {
	  $search="where $search";
  }

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_portionmaster $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['pm_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
      	<tr id="ids_<?=$result_cat_s['pm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['pm_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['pm_portionname'],$portionams)?></td>
        <td><?=$database->highlightkeyword($result_cat_s['pm_portionshortcode'],$shtcds)?></td>
        <td style="display: none ">
         <a href="#" class="md-trigger_port" id="ids_<?=$result_cat_s['pm_id']?>" ><img src="images/edit_page.PNG"></a>
         <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['pm_id']?>">
         <a href="#" onClick="delete_confirm('<?=$result_cat_s['pm_id']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
        </td>
        
        <td> 
                                    <select <?php if($result_cat_s['pm_viewinkot']=='Y'){ ?> style="color:green" <?php }else{ ?> style="color:red"  <?php } ?> id="view_kot<?=$result_cat_s['pm_id']?>" onchange="view_type('<?=$result_cat_s['pm_id']?>','KOT')">
                                  
                                        
                                        <option  value="Y"  <?php if($result_cat_s['pm_viewinkot']=='Y'){ ?> selected <?php } ?> >YES</option> 
                                        <option value="N"  <?php if($result_cat_s['pm_viewinkot']=='N'){ ?> selected  <?php } ?>>NO</option>  
                                    </select>
                                </td> 
                                 
                                 <td>
                                    
                                  <select <?php if($result_cat_s['pm_viewinbill']=='Y'){ ?> style="color:green" <?php }else{ ?> style="color:red"  <?php } ?>  id="view_bill<?=$result_cat_s['pm_id']?>" onchange="view_type('<?=$result_cat_s['pm_id']?>','BILL')">
                                  
                                        
                                      <option  value="Y"  <?php if($result_cat_s['pm_viewinbill']=='Y'){ ?> selected  <?php } ?> >YES</option> 
                                      <option value="N"  <?php if($result_cat_s['pm_viewinbill']=='N'){ ?> selected  <?php } ?>>NO</option>  
                                        
                                    </select>
                                 </td> 
        
        
          </tr>

  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>     
<?php }
	 
else if($_REQUEST['value']=="searchkot"){
	/* ******************************************** Kot Counter Master ******************************************************* */
	$kot	= $_REQUEST['srchid'];
	$brnch  =$_REQUEST['brnch'];
	//$printer=$_REQUEST['printer'];
	$search="";
	if($kot!="null")
	{
		if($search!="")
		{
			$search.=" and  kr_kotname LIKE  '%" . $kot ."%'";
		}else
		{
			$search.=" kr_kotname LIKE  '%" . $kot ."%'";
		}
	}
	if($brnch!="null")
	{
		if($search!="")
		{
			$search.=" and  be_branchname LIKE  '%" . $brnch ."%'";
		}else
		{
			$search.=" be_branchname LIKE  '%" . $brnch ."%'";
		}
	}
/*	if($printer!="null")
	{
		if($search!="")
		{
			$search.=" and  pr_printername LIKE  '%" . $printer ."%'";
		}else
		{
			$search.=" pr_printername LIKE  '%" . $printer ."%'";
		}
	}*/
	?>
    <script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/kot_edit.php", {kot:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">        
 <thead>
 <tr>
    <th>KOT</th>
   <th>Branch</th>
  
   <td >Action</td>
  </tr>
   </thead>
     <tbody >                                           
     <?php
 if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_kotcountermaster LEFT JOIN  tbl_branchmaster ON tbl_kotcountermaster.kr_branchid= tbl_branchmaster.be_branchid  $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['kr_kotcode'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?> 
	<tr id="ids_<?=$result_cat_s['kr_kotcode']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['kr_kotcode']){ ?> table_active <?php } ?> ">
         
         <td><?=$database->highlightkeyword($result_cat_s['kr_kotname'],$kot)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['be_branchname'],$brnch)?></td>
     
          <td>
             <a href="#" class="md-trigger_cat" id="ids_<?=$result_cat_s['kr_kotcode']?>" ><img src="images/edit_page.PNG"></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['kr_kotcode']?>">
                 <a style="display:none" href="#" onClick="delete_confirm('<?=$result_cat_s['kr_kotcode']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
            </td>
          
          </tr>

  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>

    </tbody>
    </table>
  <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>  
 <?php }
	else if($_REQUEST['value']=="searchingredient"){
		 /* ******************************************** Ingredient master ******************************************************* */
	$ingredient	= $_REQUEST['ingredient'];
	$search="";
	if($ingredient!="null")
	{
		if($search!="")
		{
			$search.=" and  ir_ingredientname LIKE  '%" . $ingredient ."%'";
		}else
		{
			$search.=" ir_ingredientname LIKE  '%" . $ingredient ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_ing').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/ingredient_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">Ingredient</th>
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_ingredientmaster $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ir_ingredientid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['ir_ingredientid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ir_ingredientid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['ir_ingredientname'],$ingredient)?></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	 
	else if($_REQUEST['value']=="searchdiscount"){
	 /* ******************************************** Discount master ******************************************************* */
		 $discounts	= $_REQUEST['discounts'];
		$branchs= $_REQUEST['branchs'];
		$statuss= $_REQUEST['statuss'];
		$search="";
	if($discounts!="null")
	{
		if($search!="")
		{
			$search.=" and  ds_discountname LIKE  '%" . $discounts ."%'";
		}else
		{
			$search.=" ds_discountname LIKE  '%" . $discounts ."%'";
		}
	}
	if($branchs!="null")
	{
		if($search!="")
		{
			$search.=" and  be_branchname LIKE  '%" . $branchs ."%'";
		}else
		{
			$search.=" be_branchname LIKE  '%" . $branchs ."%'";
		}
	}
	
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  ds_status LIKE  '" . $statuss ."%'";
		}else
		{
			$search.=" ds_status LIKE  '" . $statuss ."%'";
		}
	}
?>
 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_disc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/disc_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
	
});
</script>
    <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">        
       <thead>
       <tr>
          <th>Discount Name</th>
          <th>Value</th> 
          <th>Mode</th>
         
              
              
            <th>Item Discount</th> 
         <th>Branch</th>
         <th>Status</th> 
         <td >Action</td>
        </tr>
         </thead>
     <tbody >                                           
  <?php
if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ds_discountid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
                             $mdd='';
				$modee=$result_cat_s['ds_mode'];
				if($modee =='P')
				{
					$mdd='%';
				}
				else
				{
					$mdd='Value';
				}   
                                
                    if($result_cat_s['ds_item_discount']=='Y'){
                           $item_discount="Yes";
                       } else{
                             $item_discount="No";
                       }               
                                
?>
<tr id="ids_<?=$result_cat_s['ds_discountid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ds_discountid']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['ds_discountname'],$discounts)?></td>
         <td><?=number_format($result_cat_s['ds_discountof'],$_SESSION['be_decimal'])?></td>
            
            <td><?=$mdd?></td>
        
            <td><?=$item_discount?></td>
         <td><?=$database->highlightkeyword($result_cat_s['be_branchname'],$branchs)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['ds_status'],$statuss)?></td>
        <td>  
            <a href="#" class="md-trigger_disc" id="ids_<?=$result_cat_s['ds_discountid']?>" ><img src="images/edit_page.PNG"></a>
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ds_discountid']?>">
            <!-- <a href="#" onClick="delete_confirm('<?=$result_cat_s['ds_discountid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
            </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
 <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>    
 <?php }
	 else if($_REQUEST['value']=="searchcorporate"){
		  /* ******************************************** Corporate discount master ******************************************************* */
	//coprnames  corpdiscs
	$coprnames	= $_REQUEST['coprnames'];
	$corpdiscs= $_REQUEST['corpdiscs'];
	$search="";
	if($coprnames!="null")
	{
		if($search!="")
		{
			$search.=" and  ct_corporatename LIKE  '%" . $coprnames ."%'";
		}else
		{
			$search.=" ct_corporatename LIKE  '%" . $coprnames ."%'";
		}
	}
	if($corpdiscs!="null")
	{
		if($search!="")
		{
			$search.=" and  ct_corporatediscount LIKE  '%" . $corpdiscs ."%'";
		}else
		{
			$search.=" ct_corporatediscount LIKE  '%" . $corpdiscs ."%'";
		}
	}
	
?>
<script src="js/jquery-1.10.2.min.js"></script>
<script> 
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_corp').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/corp_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">         
     <thead>
     <tr>
        <th>Corporate Name</th>
         <th  style="display: none ">Corporate Discount</th>
         <td >Action</td>
      </tr>
       </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_corporatemaster $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ct_corporatecode'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['ct_corporatecode']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ct_corporatecode']){ ?> table_active <?php } ?> ">
       <td><?=$database->highlightkeyword($result_cat_s['ct_corporatename'],$coprnames)?></td>
       <td style="display: none "><?=$database->highlightkeyword($result_cat_s['ct_corporatediscount'],$corpdiscs)?></td>
         <?php if($result_cat_s['ct_online_id'] == 0 ){ ?>
        <td>
        <a href="#" class="md-trigger_corp" id="ids_<?=$result_cat_s['ct_corporatecode']?>" ><img src="images/edit_page.PNG"></a>
        <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ct_corporatecode']?>">
        <!--<a href="#" onClick="delete_confirm('<?=$result_cat_s['ct_corporatecode']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
        </td>
          <?php } else{ ?>
                                <td title="EDIT POSSIBLE ONLY FROM ONLINE PARTNER SECTION" style="color: red;font-weight: bold ;cursor: pointer"> ACCESS DENIED </td> 
                                <?php } ?>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
 <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>    
     <?php }
	else if($_REQUEST['value']=="searchvoucher"){
	 /* ******************************************** voucher master ******************************************************* */	
	 $vochrs	= $_REQUEST['vochrs'];
		$froms= $_REQUEST['froms'];
		$expirys= $_REQUEST['expirys'];
		$costs	= $_REQUEST['costs'];
		$holders= $_REQUEST['holders'];
		$contacts= $_REQUEST['contacts'];
		$branchs= $_REQUEST['branchs'];
		$statuss= $_REQUEST['statuss'];
		$search="";
	if($vochrs!="null")
	{
		if($search!="")
		{
			$search.=" and  vr_vouchername LIKE  '%" . $vochrs ."%'";
		}else
		{
			$search.=" vr_vouchername LIKE  '%" . $vochrs ."%'";
		}
	}
	if($froms!="null")
	{
		$dt=explode("-",$froms);
		$froms=$dt[2]."-".$dt[1]."-".$dt[0];
		if($search!="")
		{
			$search.=" and  vr_voucherfrom LIKE  '%" . $froms ."%'";
		}else
		{
			$search.=" vr_voucherfrom LIKE  '%" . $froms ."%'";
		}
	}
	
	if($expirys!="null")
	{
		$dt=explode("-",$expirys);
		$expirys=$dt[2]."-".$dt[1]."-".$dt[0];
		if($search!="")
		{
			$search.=" and  vr_voucherexpiry LIKE  '%" . $expirys ."%'";
		}else
		{
			$search.=" vr_voucherexpiry LIKE  '%" . $expirys ."%'";
		}
	}
	if($costs!="null")
	{
		if($search!="")
		{
			$search.=" and  vr_vouchercost LIKE  '%" . $costs ."%'";
		}else
		{
			$search.=" vr_vouchercost LIKE  '%" . $costs ."%'";
		}
	}
	if($holders!="null")
	{
		if($search!="")
		{
			$search.=" and  vr_voucherholder LIKE  '%" . $holders ."%'";
		}else
		{
			$search.=" vr_voucherholder LIKE  '%" . $holders ."%'";
		}
	}
	if($contacts!="null")
	{
		if($search!="")
		{
			$search.=" and  vr_holdercontact LIKE  '%" . $contacts ."%'";
		}else
		{
			$search.=" vr_holdercontact LIKE  '%" . $contacts ."%'";
		}
	}
	if($branchs!="null")
	{
		if($search!="")
		{
			$search.=" and  be_branchname LIKE  '%" . $branchs ."%'";
		}else
		{
			$search.=" be_branchname LIKE  '%" . $branchs ."%'";
		}
	}
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  vr_active LIKE  '%" . $statuss ."%'";
		}else
		{
			$search.=" vr_active LIKE  '%" . $statuss ."%'";
		}
	}
	
?>
 <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/voucher_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	
});
</script>
<table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">      
     <thead>
     <tr>
       <th>Voucher Name</th>
       <th>From</th>
       <th>Expiry</th>
       <th>Cost</th>
       <th>Holder</th>
       <th>Contact</th>
       <th>Branch</th>
       <th>Active</th>
       <td >Action</td>
       
      </tr>
       </thead>
     <tbody >                                           
     <?php
	 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid   $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['vr_voucherid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
	<tr id="ids_<?=$result_cat_s['vr_voucherid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['vr_voucherid']){ ?> table_active <?php } ?> ">
      <td><?=$database->highlightkeyword($result_cat_s['vr_vouchername'],$vochrs)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['vr_voucherfrom'],$froms)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['vr_voucherexpiry'],$expirys)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['vr_vouchercost'],$costs)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['vr_voucherholder'],$holders)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['vr_holdercontact'],$contacts)?></td>
      <td><?=$database->highlightkeyword($result_cat_s['be_branchname'],$branchs)?></td>
       <td><?=$database->highlightkeyword($result_cat_s['vr_active'],$statuss)?></td>
      <td>
      <a href="#" class="md-trigger_vouc" id="ids_<?=$result_cat_s['vr_voucherid']?>" ><img src="images/edit_page.PNG"></a>
       <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['vr_voucherid']?>">
       <a href="#" onClick="delete_confirm('<?=$result_cat_s['vr_voucherid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
      </td>
          </tr>

  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
   <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
	 
	else if($_REQUEST['value']=="searchcompany"){
		 /* ******************************************** Coupon company master ******************************************************* */
	 $companys	= $_REQUEST['companys'];
	$startds= $_REQUEST['startds'];
	$statuss= $_REQUEST['statuss'];
	$search="";
	if($companys!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_companyname LIKE  '%" . $companys ."%'";
		}else
		{
			$search.=" cy_companyname LIKE  '%" . $companys ."%'";
		}
	}
	if($startds!="null")
	{
		$dt=explode("-",$startds);
		$startds=$dt[2]."-".$dt[1]."-".$dt[0];
		if($search!="")
		{
			$search.=" and  cy_startdate LIKE  '%" . $startds ."%'";
		}else
		{
			$search.=" cy_startdate LIKE  '%" . $startds ."%'";
		}
	}
	
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  cy_active LIKE  '%" . $statuss ."%'";
		}else
		{
			$search.=" cy_active LIKE  '%" . $statuss ."%'";
		}
	}
?>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_coup').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/coupon_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
 <thead>
 <tr>
    <th>Company Name</th>
     <th>Start Date</th>
     <th>Active</th>   
     <td >Action</td>
  </tr>
   </thead>
     <tbody >                                           
<?php
if($search!="")
  {
	  $search="where $search";
  }

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_couponcompany $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['cy_companyname'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  <tr id="ids_<?=$result_cat_s['cy_companyname']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['cy_companyname']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['cy_companyname'],$companys)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['cy_startdate'],$startds)?></td>
         <td><?=$database->highlightkeyword($result_cat_s['cy_active'],$statuss)?></td>
         <td>
          <a href="#" class="md-trigger_coup" id="ids_<?=$result_cat_s['cy_companyname']?>" ><img src="images/edit_page.PNG"></a>
          <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['cy_companyname']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['cy_companyname']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
         </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
      <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php }
	else if($_REQUEST['value']=="searchuser"){
	/* ******************************************** change password ******************************************************* */
	//statuss usernames
	$usernames= $_REQUEST['usernames'];
	$statuss= $_REQUEST['statuss'];
	$search="";
	if($usernames!="null")
	{
		if($search!="")
		{
			$search.=" and  ls_username LIKE  '%" . $usernames ."%'";
		}else
		{
			$search.=" ls_username LIKE  '%" . $usernames ."%'";
		}
	}
	if($statuss!="null")
	{
		$sr="";
	$type=strtolower($statuss);
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
			$search.=" and  ls_status LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" ls_status LIKE  '%" .$sr ."%'";
		}
	}
?>
<script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_pas').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/chng_password_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});
</script>
<table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">            
 <thead>
 <tr>
  <th>User Name</th>
   <th>Active</th>
   <td >Action</td>
  </tr>
   </thead>
     <tbody >                                           
<?php
 if($search!="")
  {
	  $search="where $search";
  }											  
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_logindetails $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ls_username'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
				if($result_cat_s['ls_status']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}	
?>
     <tr id="ids_<?=$result_cat_s['ls_username']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ls_username']){ ?> table_active <?php } ?> ">
 	<td><?=$database->highlightkeyword($result_cat_s['ls_username'],$usernames)?></td>
    <td><?=$database->highlightkeyword($active,$statuss)?></td>
    <td>
     <a href="#" class="md-trigger_pas" id="ids_<?=$result_cat_s['ls_username']?>" ><img src="images/edit_page.PNG"></a>
     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ls_username']?>">
    </td>         
 </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
 <?php } 
else if($_REQUEST['value']=="searchprint"){
    
    
		
	$pnames	= $_REQUEST['pnames'];
	$pips= $_REQUEST['pips'];
	$pports	= $_REQUEST['pports'];
	$ptypes= $_REQUEST['ptypes'];
	$pbranchs	= $_REQUEST['pbranchs'];
	$search="";
        
	if($pnames!="null" && $pnames!='')
	{
		if($search!="")
		{
			$search.=" and  (pr_printername LIKE  '%" . $pnames ."%' OR pr_usbprinter LIKE '%".$pnames ."%')";
		}else
		{
			$search.=" (pr_printername LIKE  '%" . $pnames ."%' OR pr_usbprinter LIKE '%".$pnames ."%')";
		}
	}
	if($pips!="null" && $pips!='')
	{
		if($search!="")
		{
			$search.=" and  (pr_printerip LIKE  '%" . $pips ."%' OR pr_usbprinterip LIKE '%".$pips."%')";
		}else
		{
			$search.=" (pr_printerip LIKE  '%" . $pips ."%' OR pr_usbprinterip LIKE '%".$pips."%')";
		}
	}
	
	if($pports!="null" && $pports!='')
	{
		if($search!="")
		{
			$search.=" and  pr_printerport LIKE '%" .$pports."%' ";
		}else
		{
			$search.=" pr_printerport LIKE '%" .$pports."%' ";
		}
	}
	if($ptypes!="null" && $ptypes!='')
	{
		if($search!="")
		{
			$search.=" and  pr_printertype =  '" . $ptypes ."'";
		}else
		{
			$search.=" pr_printertype =  '" . $ptypes ."'";
		}
	}
	if($pbranchs!="null" && $pbranchs!='')
	{
		if($search!="")
		{
			$search.=" and  pr_kotcode =  '" . $pbranchs ."'";
		}else
		{
			$search.=" pr_kotcode =  '" . $pbranchs ."'";
		}
	}
        
        
        if($_REQUEST['lan_usb_type']!="null" && $_REQUEST['lan_usb_type']!='')
	{
		if($search!="")
		{
			$search.=" and  pr_defaultusb =  '" . $_REQUEST['lan_usb_type'] ."'";
		}else
		{
			$search.=" pr_defaultusb =  '" . $_REQUEST['lan_usb_type'] ."'";
		}
	}
        
        
	  if($_REQUEST['on_off_type']!="null" && $_REQUEST['on_off_type']!="")
	{
		if($search!="")
		{
			$search.=" and  pr_enable =  '" . $_REQUEST['on_off_type'] ."'";
		}else
		{
			$search.=" pr_enable =  '" . $_REQUEST['on_off_type'] ."'";
		}
	}
        
        
          if($_REQUEST['module_type']!="null" && $_REQUEST['module_type']!="")
	{
		if($search!="")
		{
                    
                     if($_REQUEST['module_type']=='di'){
                    
			$search.=" and  pr_printertype = '1' or pr_printertype = '2' or pr_printertype = '6'  ";
                        
                     }
                     
                     if($_REQUEST['module_type']=='ta'){
                    
			$search.=" and  pr_printertype = '5' or pr_printertype = '4' or pr_printertype = '7'  ";
                        
                     }
                     
                     if($_REQUEST['module_type']=='cs'){
                    
			$search.=" and  pr_printertype = '11' or pr_printertype = '4' or pr_printertype = '7'  ";
                        
                     }
                        
		}else
		{
			
                    if($_REQUEST['module_type']=='di'){
                    
			$search.="   pr_printertype = '1' or pr_printertype = '2' or pr_printertype = '6'  ";
                        
                     }
                     
                     if($_REQUEST['module_type']=='ta'){
                    
			$search.="   pr_printertype = '5' or pr_printertype = '4' or pr_printertype = '7'  ";
                        
                     }
                     
                     if($_REQUEST['module_type']=='cs'){
                    
			$search.="   pr_printertype = '11' or pr_printertype = '4' or pr_printertype = '7'  ";
                        
                     }
                        
                    
                    
                    
		}
	}
        
        
        
	?>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script>
	$(document).ready(function(){
            
            
           $('#ids_<?=$_REQUEST['prn_id_new']?>').addClass('table_active'); 
            
            
            
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_print').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/printer_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
                
                $('.popup_print_ip').click( function() { 
//                    
			var id_str   =  $(this).attr("id");
                        var print_data = id_str.split('|');
                        $("#prid1").val(print_data[0]);
                        $("#printer_name").html(print_data[1]);
                        $("#printer_ip").html(print_data[2]);
                        var ac=$("#prid1").val().trim();
                       // alert(ac);
                     // alert(deltid);

   
                         $.ajax({
       			type: "POST",
			url: "load_printipsettings.php",
			data: "value=&mid="+ac,
			success: function(data)
			{
			//msg=$.trim(msg);
                        data=$.trim(data);
                       //alert(data);
                       $('#printeriptable').html(data);
			
      
			}
			
		});
                  
	});
                
	});
	</script>
     
     <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
          <thead>
         <tr>
                                  <th style="min-width: 25px;" >Sl</th>
                               <td style="min-width: 158px;">Action</td>
                                <th style="min-width:155px;">Printer Name</th>
       				<th style="min-width: 95px;">USB IP</th>
                                 <th style="min-width: 65px;">Share Name</th>
                                 <th style="min-width: 105px;">LAN IP</th>
                                 <th style="min-width: 45px;"> USB</th> 
                                 <th style="min-width: 113px;">Type</th>
                                 <th style="min-width: 80px;">Floor</th>
                                 <th style="min-width: 100px;">KOT</th>
                                 
                                   <th style="min-width: 45px;">Port</th>
                                  <th style="min-width: 45px;">Count</th>
<!--                                 <th >Branch</th> -->
<!--                                 <th style="min-width: 45px;">Status</th> -->
                                 <th style="min-width: 69px;">Style</th> 
                                
                              </tr>
         </thead>
     <tbody>   
         
         
      <?php
	  if($search!="")
	  {
		  $search="where $search";
	  }
	
	$i=0;
        
       
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON "
                . " tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON "
                . " tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON "
                . " tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON "
                . " tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode LEFT JOIN tbl_printer_styles ON "
                . " tbl_printersettings.pr_style=tbl_printer_styles.ps_id $search order by tbl_printersettings.pr_printername,tbl_printersettings.pr_enable desc");
                         

	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
                                $st='';  $i++;
                                
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['pr_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
                        
                        
                                $printer_id = $result_cat_s['pr_id'].'|'.$result_cat_s['pr_printername'].'|'.$result_cat_s['pr_printerip'];
				if($result_cat_s['pr_enable']=='Y')
				{
					$st="ON";
				}else
				{
					$st="OFF";
				}
                                
                                
	 ?>
                        
                        
                        
              <tr id="ids_<?=$result_cat_s['pr_id']?>" class="select clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['pr_id']){ ?>  <?php } ?> ">          
                        
<!--     <tr id="ids_<?=$result_cat_s['pr_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['pr_id']){ ?> table_active <?php } ?> ">     -->
         <td style="min-width: 25px;"><?=$i?></td>
                            <td style="min-width: 158px;">
                                 <a  style="margin: 0 1%;" href="#" class="md-trigger_print" id="ids_<?=$result_cat_s['pr_id']?>" ><img src="images/edit_page.PNG"></a>
                                <a  style="margin: 0 1%;<?php if($st=="OFF"){ ?> pointer-events:none;opacity: 0.4;cursor: none; <?php } ?>" href="#" class="testmyprinter" all_detail="<?=$result_cat_s['pr_printername'].'*'.$result_cat_s['pr_printerip'].'*'.$result_cat_s['pr_printerport'].'*'.$result_cat_s['pr_usbprinterip'].'*'.$result_cat_s['pr_usbprinter']?>"    id="<?=$result_cat_s['pr_id']?>" ip="<?=$result_cat_s['pr_printerip']?>" type="<?=$result_cat_s['pr_printertype']?>" usb_lan="<?=$result_cat_s['pr_defaultusb']?>" ><img src="img/printer_new.png"></a>
                                 <a  style="margin: 0 1%;<?php if($st=="OFF"){ ?> pointer-events:none;opacity: 0.4;cursor: none;<?php } ?>" class="popup_print_ip" href="#" onClick="ipclr()" printer_name="" id="<?=$printer_id?>"> <div class="action_button"><img src="img/ip_adress.png"></div></a>
                              
                                 
                                 <a   href="#" onClick="printer_delete('<?=$result_cat_s['pr_id']?>')"> <div class="action_button printer_delete"><i class="glyphicon glyphicon-trash"></i></div></a>
                                 
                                 <?php  if($result_cat_s['pr_enable']=='Y'){ ?>
                                       
                                       <a  style="cursor: pointer;background: #648964;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;" onclick="return print_on_off('<?=$result_cat_s['pr_id']?>','N');"  title="PRINTER ON " class="tab_edt_btn ingredient_btn"  >ON</a>
                                       <?php }else{ ?>
                                        
                                        <a style="cursor: pointer;background: #993d3d;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;"  onclick="return print_on_off('<?=$result_cat_s['pr_id']?>','Y');"  title="PRINTER OFF" class="tab_edt_btn ingredient_btn"  >OFF</a>
                                     
                                       <?php } ?>
                                 
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['pr_id']?>">
                                 
                               
                            </td>  
                  
                            <td title="<?=$result_cat_s['pr_printername']?>" style="min-width:155px;font-weight: bold;text-transform: uppercase"><?=$database->highlightkeyword(substr($result_cat_s['pr_printername'],0,25),$pnames)?> <?php  if($result_cat_s['pr_defaultusb']=='Y'){ ?> <img title="USB PRINTER" style="cursor: pointer;width: 30px;height: 25px " src="img/usb.png">  <?php  } ?></td>
                                <td style="min-width: 95px;"><?=$database->highlightkeyword($result_cat_s['pr_usbprinterip'],$pips)?></td>
                                <td style="min-width: 65px;"><?=$database->highlightkeyword($result_cat_s['pr_usbprinter'],$pnames)?></td>
                                <td style="min-width: 105px;"><?=$database->highlightkeyword($result_cat_s['pr_printerip'],$pips)?></td>
                                 <td  <?php  if($result_cat_s['pr_defaultusb']=='Y'){ ?> style="min-width: 45px;color: black;font-weight: bold" <?php }else{ ?> style="min-width: 45px;color:black;font-weight: bold"  <?php } ?>><?=$result_cat_s['pr_defaultusb']?></td>
                               
                                <td style="min-width: 113px;"><?=$database->highlightkeyword($result_cat_s['pt_typename'],$ptypes)?></td>
                               <?php if($result_cat_s['fr_floorname']!=''){ ?>
                                <td title="<?=$result_cat_s['fr_floorname']?>" style="min-width: 80px;"><?=substr($result_cat_s['fr_floorname'],0,10)?></td>
                                <?php }else{ ?>
                                
                                 <td title="NO FLOOR" style="min-width: 80px;">***</td>
                                <?php }?>
                                
                                 
                                   <?php if($result_cat_s['kr_kotname']!=''){ ?>
                                <td title="<?=$result_cat_s['kr_kotname']?>" style="min-width: 100px;cursor: pointer"><?=substr($result_cat_s['kr_kotname'],0,15)?></td>
                              <?php }else{ ?>
                                
                                 <td title="NO KOT" style="min-width: 100px;">***</td>
                                <?php }?>
                                 
                                  <td style="min-width: 45px;"><?=$database->highlightkeyword($result_cat_s['pr_printerport'],$pports)?></td>
                                 
                                <td  style="min-width: 45px;"><?=$result_cat_s['pr_printcount']?></td>
<!--                                <td><?//=$database->highlightkeyword($result_cat_s['be_branchname'],$pbranchs)?></td>-->
<!--                                <td  style="min-width: 45px;"><?//=$st?></td>-->
                                <td  style="min-width: 69px;"><?=$result_cat_s['ps_name']?></td>
       
          </tr>
  <?php $k++;}}else{ ?> 
   
  
  
                                  <td style="min-width: 25px;" ></td>
                               <td style="min-width: 158px;"></td>
                                <td style="min-width:155px;"> </td>
       				<td style="min-width: 95px;"> </td>
                                 <td style="min-width: 65px;"> </td>
                                 <td style="min-width: 105px;font-weight: bold">NO DATA</td>
                                 <td style="min-width: 45px;"> </td>
                                 <td style="min-width: 113px;"></td>
                                 <td style="min-width: 80px;"></td>
                                 <td style="min-width: 100px;"></td>
                                  <td style="min-width: 45px;"> </td> 
                                  <td style="min-width: 45px;"></td>

                                 <td style="min-width: 69px;"></td> 
  
    
        <?php } ?>
 
    </tbody>
    </table>
        
        
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" id="js">
    $(document).ready(function() {
       $("#listall1").tablesorter();
    }); 
    
    
    function ipclr()
{	document.getElementById('prmachineip').value = '';

     	$('#pridchk').text('');
	$("#prmachineip_divs").removeClass("has-error");
}

$('.popup_print_ip').click(function () {
	$(".popup_print_ip_cc").css("display","block");
	$(".new_overlay_print").css("display","block");
	});
$('.ip_popup_close_button').click(function () {
	$(".popup_print_ip_cc").css("display","none");
	$(".new_overlay_print").css("display","none");
	});
        
        
  $(document).ready(function() {
//testmyprinter
$('.testmyprinter').click(function () {
   
	 var id_str       =  $(this).attr("id");
	var ip=      $(this).attr("ip");
	var type1=$(this).attr('type');
var usb_lan=$(this).attr('usb_lan');

 var all= $(this).attr("all_detail");
           var test_print  = "test_print";
            $.post("printercheck_1.php", {type:test_print,test_ip:ip,type1:type1,usb_lan:usb_lan},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            
            if(data !='ok')
            {
                $(".new_overlay_print").css("display","block");
                  $(".popup_alert_box_new").css("display","block");
		  $(".popup_alert_box_new").text(data);
		  
               setInterval(function () {
               $(".new_overlay_print").css("display","none");
                  $(".popup_alert_box_new").css("display","none");
                }, 2000);
              // alert(data);
             //  location.reload();
              return false;
	
            }else{
                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=testprinter&printerid="+id_str+"&all="+all,
			success: function(msg)
			{
			msg=$.trim(msg);
			
		  $(".load_error_del").css("display","inline-block");
		  $(".load_error_del").text("TEST COPY PRINTED");
		  $('.load_error_del').delay(1500).fadeOut('slow');
			}
			
		}); 
            }
        });

	});

});

</script>
     <?php } 
	 
	 else if($_REQUEST['value']=="searchbranchhistory")
	 {
		/* ******************************************** Staff Master ******************************************************* */
	
	$branch= $_REQUEST['branch'];
	$search="";
	if($branch!="null")
	{
		
			$search.=" be_branchname LIKE  '%" . $branch ."%' ";
			
		
	}

	
	
	?>
    <!--<script src="js/jquery-1.10.2.min.js"></script>-->
    <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});

	});
	

	</script>
     <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
     <thead>
     <tr>
        <th width="15%" class="header">Branch</th>
                            <th width="10%" class="header">Sl No</th>
                            <th class="header">Message</th>
                            <th width="25%" class="header">Date & Time</th>
      </tr>
       </thead>
     <tbody >                                           
      <?php
	 
	  
	if($search !="")
	{
		$search="where $search";
	}
	
	
/*echo "select * from tbl_branch_settings_history left join  tbl_branchmaster on tbl_branch_settings_history.bsh_branchid=tbl_branchmaster.be_branchid $search";
die();*/
		$sql_cat_s  =  $database->mysqlQuery("select * from tbl_branch_settings_history left join  tbl_branchmaster on tbl_branch_settings_history.bsh_branchid=tbl_branchmaster.be_branchid $search ");
		/*echo "select * from tbl_staffmaster LEFT JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid LEFT JOIN tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid LEFT JOIN tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid  $search";
		die(); */

	
	/*echo "select s.*,d.der_departmentname,de.dr_designationname from tbl_staffmaster s
LEFT JOIN tbl_departmentmaster d ON s.ser_department = d.der_departmentid 
LEFT JOIN tbl_designationmaster de ON s.ser_designation = de.dr_designationid,tbl_branchmaster b where s.ser_branchofficeid = b.be_branchid  and s.ser_branchofficeid='".$_SESSION['branchofid']."' $search";
die(); */
	
	
//echo "select * from tbl_staffmaster LEFT JOIN tbl_branchmaster ON tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid LEFT JOIN tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid LEFT JOIN tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid $search";
//die();
	
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
			/*	if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ser_staffid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}*/
?>
     <tr id="ids_<?=$result_cat_s['bsh_branchid']?>"  class="clicktoview  ">     
   <?php /*?>  <?php if($_SESSION['menuidselect']==$result_cat_s['ser_staffid']){ ?> table_active <?php } ?><?php */?>
         <td  width="15%"><?=$database->highlightkeyword($result_cat_s['be_branchname'],$branch)?></td>
          <td  width="10%" ><?=$result_cat_s['bsh_slno']?></td>
          <td><?=$result_cat_s['bsh_message']?></td>
          <td width="25%"><?=$result_cat_s['bsh_datetime']?></td>
       
		      
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>

    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" id="js">
    $(document).ready(function() {
       $("#listall1").tablesorter();
    }); 
    </script>
     <?php 
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
else if($_REQUEST['value']=="searchstaff"){
		/* ******************************************** Staff Master ******************************************************* */
	$staff	= $_REQUEST['staff'];
	$departmnt= $_REQUEST['departmnt'];
	$desgnation	= $_REQUEST['desgnation'];
	$emplystatus= $_REQUEST['emplystatus'];
	$search="";
	if($staff!="null")
	{
		if($search!="")
		{
			$search.=" and  ser_firstname LIKE  '%" . $staff ."%' OR ser_lastname LIKE  '%" . $staff ."%' ";
			
		}else
		{
			$search.=" ser_firstname LIKE  '%" . $staff ."%'  OR ser_lastname LIKE  '%" . $staff ."%'  ";
			
		}
	}
	if($departmnt!="null")
	{
		if($search!="")
		{
			$search.=" and der_departmentname LIKE  '%" . $departmnt ."%'";
		}else
		{
			$search.=" der_departmentname LIKE  '%" . $departmnt ."%'";
		}
	}
	if($desgnation!="null")
	{
		if($search!="")
		{
			$search.=" and  dr_designationname  = '" . $desgnation ."'";
		}else
		{
			$search.=" dr_designationname =  '" . $desgnation ."'";
		}
	}
	if($emplystatus!="null")
	{
		if($search!="")
		{
			$search.=" and  ser_employeestatus= '" . $emplystatus ."'";
		}else
		{
			$search.=" ser_employeestatus =  '" . $emplystatus ."'";
			
			
		}
	}
	
	
	?>
    <!--<script src="js/jquery-1.10.2.min.js"></script>-->
    <script>
	$(document).ready(function(){
            var url_check=$('#url_check').val();
    
   var new_id=url_check.split('staff_id=');
   
   
    $('#ids_'+new_id[1]).addClass('table_active');
        //  $('#ids_<?//=$_REQUEST['prn_id_new']?>').addClass('table_active'); 
            
            
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_stf').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/staff_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
			$('.md-button').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var staffid=$('#hiddenmenuid').val();
			  $.post("popup/staff_view.php", {staff:staffid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	});
	
	function delete_confirm1(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="staff_master.php?id="+id+"&delete=yes";
		}else
		{window.location="staff_master.php?id="+id+"&delete=no";
		}
	}
	
}	
	</script>
     <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">          
     <thead>
     <tr>
        <th>Staff Name</th>
         <th>Department</th>
         <th>Designation</th>
         <th style="display:none"> Status</th>
          <th>Login Status</th>
             <th>Login ID</th>
         <td style="min-width:223px;width:28%">Action</td>
      </tr>
       </thead>
     <tbody >                                           
      <?php
	  if($search!="")
	  {
		  if($_SESSION['branchofid'] !="")
		  {
		      $search=" and $search";
		  }
		  else
		  {
		     $search=" where tbl_designationmaster.dr_designationname !=''    $search";
		  }
	  }
          
          
          
                               $addmn_string=''; $del='';
                               $addmn_string1='';
                                 if($_SESSION['expodine_id'] !='admin'){   
                                     
                                     $addmn_string.=" and tbl_designationmaster.dr_designationname<>'Super Admin' ";
                                     
                                      $addmn_string1.=" and de.dr_designationname<>'Super Admin' ";
                                      
                                      $del.=" and S.ser_delete_mode='N' ";   
                                      
                                      
                                 }else{
                                     
                                    $addmn_string.="  ";  
                                    
                                     $addmn_string1.="  ";  
                                     
                                      $del.=" ";  
                                 }
	  
	
	
	if($_SESSION['branchofid'] !="")
	{
	    $sql_cat_s=$database->mysqlQuery("select s.*,tbl_logindetails.ls_username,tbl_logindetails.ls_login_status,
             tbl_logindetails.ls_restrict_login,d.der_departmentname,
             de.dr_designationname from tbl_staffmaster s
             LEFT JOIN tbl_departmentmaster d ON s.ser_department = d.der_departmentid left join tbl_logindetails  on 
             tbl_logindetails.ls_staffid=s.ser_staffid
             LEFT JOIN tbl_designationmaster de ON s.ser_designation = de.dr_designationid,tbl_branchmaster b 
             where s.ser_branchofficeid = b.be_branchid 
             and s.ser_branchofficeid='".$_SESSION['branchofid']."' $addmn_string1 $del  $search  order by s.ser_firstname asc");
	}
	else
	{
		$sql_cat_s  =  $database->mysqlQuery("select * from tbl_staffmaster LEFT JOIN tbl_branchmaster ON"
                        . " tbl_staffmaster.ser_branchofficeid=tbl_branchmaster.be_branchid LEFT JOIN tbl_departmentmaster ON"
                        . " tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid LEFT JOIN tbl_designationmaster ON "
                        . " tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid left join tbl_logindetails  on"
                        . " tbl_logindetails.ls_staffid=tbl_staffmaster.ser_staffid  $search $addmn_string $del order by"
                        . " tbl_staffmaster.ser_firstname asc");
		
	}
	

	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ser_staffid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
                                
                                
                     if($result_cat_s['ls_login_status']=="Y"){
                          $login=" IN";
                       }else {
                        $login=" OUT" ;
                      }

                     if($result_cat_s['ls_login_status']==""){
                         $login="NO LOGIN" ;
                     }
                     
                 if($result_cat_s['ls_username']!=""){
                      $user_login=$result_cat_s['ls_username'];
                     }else{
                       $user_login ='[X]'; 
                     }    
                     
?>
     <tr id="ids_<?=$result_cat_s['ser_staffid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ser_staffid']){ ?>  <?php } ?> ">     
         <td><?=$database->highlightkeyword($result_cat_s['ser_firstname']." ".$result_cat_s['ser_lastname'],$staff)?></td>
          <td><?=$database->highlightkeyword($result_cat_s['der_departmentname'],$departmnt)?></td>
          <td><?=$database->highlightkeyword($result_cat_s['dr_designationname'],$desgnation)?></td>
          <td style="display:none"><?=$database->highlightkeyword($result_cat_s['ser_employeestatus'],$emplystatus)?></td>
       <td>  <?=$login?> &nbsp; <?php if($_SESSION['ser_release_login']=="Y" && $result_cat_s['ls_login_status']!="" && $result_cat_s['ls_login_status']=="Y" && $result_cat_s['ls_restrict_login']=="Y" ){ ?>
        
           <span onclick="return release_login('<?=$result_cat_s['ser_staffid']?>');"   class="staff_permission_btn stfid" stf="<?=$result_cat_s['ser_staffid']?>" 
          style="float:right;background-color:#A91400;cursor: pointer;margin-right: 3px;">Release</span>  &nbsp; &nbsp; <?php } ?> </td>
	
       <td style="text-align: left;padding-left: 5px;font-size: 12px " title="Login name and staff id"> <?//=$user_login?> ID  &nbsp; :  &nbsp; <?=$result_cat_s['ser_staffid']?> </td>
                                   
                                     
       
       
       <td style="min-width:223px;width:28%">
       
           
           <?php if(trim($_SESSION['expodine_id']) =='admin' && $result_cat_s['ser_delete_mode']=='N' && ($result_cat_s['ser_staffid']!='1' && $result_cat_s['ser_staffid']!='2' && $result_cat_s['ser_staffid']!='3' && $result_cat_s['ser_staffid']!='4')){  ?>      
           
           <a title="DELETE" style="margin: 0 1%;"  class="tab_edt_btn " href="#" onclick="delete_staff('<?=$result_cat_s['ser_staffid']?>')"><i class="fa fa-close"></i></a>
    
             <?php }else{ ?> 
           
           
           <?php if(trim($_SESSION['expodine_id']) == 'admin' && $result_cat_s['ser_delete_mode']=='Y'){ ?>
                                     
            <a title="RESTORE" style="margin: 0 1%;color: green" onclick="restore_staff('<?=$result_cat_s['ser_staffid']?>')"  class="tab_edt_btn " href="#" ><i class="fa fa-refresh"></i></a>
                                     
            <?php }else{ ?>
            
            <a title="CANT DELETE THIS STAFF" style="margin: 0 1%;opacity: 0.5"  class="tab_edt_btn " href="#" ><i class="fa fa-close"></i></a>
                                     
            <?php }  } ?> 
            
            
            
                                     
       <?php if($_SESSION['s_inventory_staff_add']=='Y'){  ?>    
           
        <a onClick="store_add('<?=$result_cat_s['ser_staffid']?>')" title="Invenetoy stores" style="margin: 0 1%;"  class="tab_edt_btn md-button" href="#" ><i class="fa fa-shopping-cart "></i></a>    
        
       <?php } ?>      
        
      <a style="margin: 0 2%;display: none" class="tab_edt_btn md-button" href="#" id="ids_<?=$result_cat_s['ser_staffid']?>"><i class="fa fa-eye"></i></a>   
      
      <a  style="display: none;color:black;top: 2px;position: relative;margin: 0 2% 0 2%;" class="tab_edt_btn " href="staff_salary_detail.php?staff_id=<?=$result_cat_s['ser_staffid']?>" ><i style="font-size: 20px" class="fa fa-dollar"></i></a>
	   
	  <a style="margin: 0 2%;" href="#" class="md-trigger_stf" id="ids_<?=$result_cat_s['ser_staffid']?>" ><img src="images/edit_page.PNG"></a>
          
         
          <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ser_staffid']?>">
          
      
       
       <?php if($result_cat_s['ser_employeestatus']=="Active"){ ?>  
				
	<a style="border: solid limegreen 4px; width: 22px; height: 22px;border-radius: 50%;    margin: 0 2%;"  onClick="delete_confirm1('ToNo','<?=$result_cat_s['ser_staffid']?>')"  > <img style="position: relative;    top: -1px;" src="img/black_tick.png" width="18px" height="18px"></a>
        <?php } else{ ?>
        <a style="border:solid red 4px; width: 22px; height: 22px;border-radius: 50%;margin: 0 2%; "  onClick="delete_confirm1('ToYes','<?=$result_cat_s['ser_staffid']?>')"  > <img style="position: relative;    top: -1px;" src="img/black_cross.png" width="18px" height="18px"></a>
         <?php } ?>
        
           <a tyle="margin: 0 2%;" class="md-permission" href="permissions.php?id=<?=$result_cat_s['ser_staffid']?>" id="ids_<?=$result_cat_s['ser_staffid']?>"><span class="staff_permission_btn">Permission</span></a>
            
       <a  style="margin: 0 1%;display: none" class="md-permission" href="permissions_app.php?id=<?=$result_cat_s['ser_staffid']?>" id="ids_<?=$result_cat_s['ser_staffid']?>"><span style="background-color: #910202 " class="staff_permission_btn">App</span></a>

       </td>          
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>

    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" id="js">
    $(document).ready(function() {
       $("#listall1").tablesorter();
    }); 
    </script>
     <?php } 
	else if($_REQUEST['value']=="searchfeedback"){
		 /* ******************************************** Feedback master ******************************************************* */
	$question	= $_REQUEST['question'];
	$statuss	=$_REQUEST['statuss'];
	
	
	$search="";
	if($question!="null")
	{
		if($search!="")
		{
			$search.=" and  fbm_question LIKE  '%" . $question ."%'";
		}else
		{
			$search.=" fbm_question LIKE  '%" . $question ."%'";
		}
	}
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  fbm_active='".$statuss."'";
		}else
		{
			$search.=" fbm_active='".$statuss."'";
		}
	}
	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_ing').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/ingredient_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
  <tr>
                                <th height="35px">Question</th>
                                <th width="10%">Status</th>
                                 <td width="10%">Action</td>
                              </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_feedbackmaster $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if($result_cat_s['fbm_active']=="Y")
				{
					$active="Active";
				}else 
				{
					$active="Inactive";
				}
				if($statuss=="Y")
				{
					$statuss1="Yes";
				}else  if($statuss=="N")
				{
					$statuss1="No";
				}else
				{
					$statuss1="null";
				}
				
				
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['fbm_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['fbm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['fbm_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['fbm_question'],$question)?></td>
           <td width="10%"><?=$database->highlightkeyword($active,$statuss1)?></td>
      <td width="10%">
                               <?php if($result_cat_s['fbm_active']=="Y"){ ?>  
                                <a title="Active" style="cursor:pointer;background-color: limegreen;height: 24px;display: inline-block;border-radius: 50%;" onClick="delete_confirm('ToNo','<?=$result_cat_s['fbm_id']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                 <a title="Inactive" style="cursor:pointer;background-color: red;height: 24px;display: inline-block;border-radius: 50%;" onClick="delete_confirm('ToYes','<?=$result_cat_s['fbm_id']?>')"  > <img src="img/black_tick.png" width="25px" height="25px"></a>
                                 <?php } ?>
                                 
                         <a style="cursor:pointer"  onClick="edit_confirm('<?=$result_cat_s['fbm_id']?>','<?=$result_cat_s['fbm_question']?>')"  > <img src="images/edit_page.png" width="25px" height="25px"></a>         
                                 
                                 </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" class="feedbackdisplay" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	 
	 
	 else if($_REQUEST['value']=="searchfeedbackrating"){
		 /* ******************************************** Feedback Rating ******************************************************* */

	$tableno=$_REQUEST['tableno'];
	$search="";
	if($tableno!="null")
	{
		if($search!="")
		{
			$search.=" and  tr_tableno LIKE  '%" . $tableno ."%'";
		}else
		{
			$search.=" tr_tableno LIKE  '%" . $tableno ."%'";
		}
	}
	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_ing').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/ingredient_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">Question</th>
        <th height="35px">Rate</th>
                                    <th height="35px">Order ID</th>
                                      <th height="35px">Table No</th>
                                        <th height="35px">Entry time</th> 
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
	 // echo $search;
//	  die();
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_feedbackrating LEFT JOIN tbl_feedbackmaster ON tbl_feedbackrating.fbr_fbm_id=tbl_feedbackmaster.fbm_id LEFT JOIN tbl_tablemaster ON tbl_feedbackrating.fbr_table= tbl_tablemaster.tr_tableid  $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
				
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['fbr_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['fbr_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['fbr_id']){ ?> table_active <?php } ?> ">
         <td><?=$result_cat_s['fbm_question']?></td>
            <td><?=$result_cat_s['fbr_rate']?></td>
                             <td><?=$result_cat_s['fbr_orderid']?></td>
                             <td><?=$database->highlightkeyword($result_cat_s['tr_tableno'],$tableno)?></td>
                              <td><?=$result_cat_s['fbr_entrytime']?></td>
       
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	else if($_REQUEST['value']=="searchpreference"){
		 /* ******************************************** Preference master ******************************************************* */
	$preference	= $_REQUEST['preference'];
	$search="";
	if($preference!="null")
	{
		if($search!="")
		{
			$search.=" and  pmr_name LIKE  '%" . $preference ."%'";
		}else
		{
			$search.=" pmr_name LIKE  '%" . $preference ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_prfrnc').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/preference_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">Preference</th>
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_preferencemaster $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['pmr_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['pmr_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['pmr_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['pmr_name'],$preference)?></td>
         <td> <a href="#" class="md-trigger_prfrnc" id="ids_<?=$result_cat_s['pmr_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['pmr_id']?>"></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	 
	else if($_REQUEST['value']=="searchaddon"){
		 /* ******************************************** Preference master ******************************************************* */
	$preference	= $_REQUEST['preference'];
	$search="";
	if($preference!="null")
	{
		if($search!="")
		{
			$search.=" and  ma_name LIKE  '%" . $preference ."%'";
		}else
		{
			$search.=" ma_name LIKE  '%" . $preference ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_prfrnc').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("load_addon_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">Preference</th>
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_addon_master $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['ma_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['ma_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['ma_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['ma_name'],$preference)?></td>
         <td> <a href="#" class="md-trigger_prfrnc" id="ids_<?=$result_cat_s['ma_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ma_id']?>"></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
     
     else if($_REQUEST['value']=="searchunit"){
		 /* ******************************************** Preference master ******************************************************* */
	$preference	= $_REQUEST['preference'];
	$search="";
	if($preference!="null")
	{
		if($search!="")
		{
			$search.=" and  u_name LIKE  '%" . $preference ."%'";
		}else
		{
			$search.=" u_name LIKE  '%" . $preference ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_prfrnc').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("load_unitmaster_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">unit</th>
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_unit_master $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['u_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['u_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['u_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['u_name'],$preference)?></td>
         <td> <a href="#" class="md-trigger_prfrnc" id="ids_<?=$result_cat_s['u_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['u_id']?>"></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
     
      else if($_REQUEST['value']=="searchbaseunit"){
		 /* ******************************************** Preference master ******************************************************* */
	$preference	= $_REQUEST['preference'];
	$search="";
	if($preference!="null")
	{
		if($search!="")
		{
			$search.=" and  bu_name LIKE  '%" . $preference ."%'";
		}else
		{
			$search.=" bu_name LIKE  '%" . $preference ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_prfrnc').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("load_base_unitmaster.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">unit</th>
  <!--    <td >Action</td>-->
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search="where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_base_unit_master $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['bu_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['bu_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['bu_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['bu_name'],$preference)?></td>
         <td> <a href="#" class="md-trigger_prfrnc" id="ids_<?=$result_cat_s['bu_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['bu_id']?>"></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?//=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?//=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?//=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	 
	 else if($_REQUEST['value']== "searchbnk")
	 {
		 
	/* ******************************************** Category master ******************************************************* */
	$bankz	= $_REQUEST['bank'];
	$statuss= $_REQUEST['statuss'];
	$search="";
	if($bankz!="null")
	{
		if($search!="")
		{
			$search.=" and  bm_name LIKE  '%" . $bankz ."%'";
		}else
		{
			$search.=" bm_name LIKE  '%" . $bankz ."%'";
		}
	}

	if($statuss!="null")
	{
		$sr="";
	$type=strtolower($statuss);
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
			$search.=" and  bm_active LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" bm_active LIKE  '%" . $sr ."%'";
		}
	}
	
?>
 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/bank_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
});

function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="bank_master.php?id="+id+"&delete=yes";
		}else
		{window.location="bank_master.php?id="+id+"&delete=no";
		}
	}
	
}	
</script>
   <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">        
 <thead>
 <tr>
    <td>Bank Name</td>
    <td >Active</td>
     <td >Action</td>
  </tr>
   </thead>
     <tbody >                                           
<?php
if($search!="")
  {
	  $search="where $search";
  }

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_bankmaster $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if($result_cat_s['bm_active']=="Y")
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
					  $_SESSION['menuidselect']=$result_cat_s['bm_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
   	<tr id="ids_<?=$result_cat_s['bm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['bm_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['bm_name'],$bankz)?></td>
       
         <td><?=$database->highlightkeyword($active,$statuss)?></td>
          <td >
         <a href="#" class="md-trigger_cat" id="ids_<?=$result_cat_s['bm_id']?>" ><img src="images/edit_page.PNG"></a>
             <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['bm_id']?>">
       <!--  <a href="#" onClick="delete_confirm('<?=$result_cat_s['bm_id']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
         <?php if($result_cat_s['bm_active']=="Y"){ ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_cat_s['bm_id']?>')"  > <img src="img/black_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_cat_s['bm_id']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } ?>       
       
                                </td>
          </tr>
  <?php $k++;}} else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php 
		 
		 
		 
		 
		 
	 }
	 
	/* ******************************************** Auto load state and city ******************************************************* */ 
	 else if($_REQUEST['value']=="loadstate"){ 
		 $sql_kot  =  $database->mysqlQuery("select * from tbl_state where se_countryid='".$_REQUEST['stateid']."'"); 
		  $num_kot   = $database->mysqlNumRows($sql_kot);
		  if($num_kot){  ?>
		  <option value="">Select State</option>
         
		 <?php while($result_kot  = $database->mysqlFetchArray($sql_kot)) 	{ ?>
			<option value="<?=$result_kot['se_stateid']?>"  id="<?=$result_kot['se_stateid']?>"><?=$result_kot['se_statename']?></option>
		  <?php } ?> 
          </optgroup>
		 
		 <?php } ?>
	     <?php }
             else if($_REQUEST['value']=="loadcity"){ 
		 $sql_kot  =  $database->mysqlQuery("select * from tbl_city where  cy_stateid='".$_REQUEST['cityid']."'"); 
		/* cy_countryid='".$_REQUEST['countryid']."' AND*/
		  $num_kot   = $database->mysqlNumRows($sql_kot);
		  if($num_kot){  ?>
		  <option value="">Select City</option>
         
		 <?php while($result_kot  = $database->mysqlFetchArray($sql_kot)) 	{ ?>
			<option value="<?=$result_kot['cy_cityid']?>"><?=$result_kot['cy_cityname']?></option>
		  <?php } ?> 
          </optgroup>
		 
		 <?php } ?>
         
     <?php } 	
     ////-------------menu item load starts
      else if($_REQUEST['value']=="loadmenuitem"){ 
//                    if($_REQUEST['kitchenid']==""){
//                        $sql_kot  =  $database->mysqlQuery("select m.mr_menuid,m.mr_menuname from tbl_menumaster m "); 
//                    }else{
		 $sql_kot  =  $database->mysqlQuery("select m.mr_menuid,m.mr_menuname from tbl_menumaster m where m.mr_kotcounter = '".$_REQUEST['kitchenid']."'"); 
                   // }
		  $num_kot   = $database->mysqlNumRows($sql_kot);
		  if($num_kot){  ?>
		  <option value="">All</option>
         
		 <?php while($result_kot  = $database->mysqlFetchArray($sql_kot)) 	{ ?>
			<option value="<?=$result_kot['mr_menuid']?>"  id="<?=$result_kot['mr_menuid']?>"><?=$result_kot['mr_menuname']?></option>
		  <?php } ?> 
          </optgroup>
		 
		 <?php } ?>
	     <?php }
     ////-------------menu item load end
	 /* ******************************************** Image load category ******************************************************* */ 
	 else if($_REQUEST['value']=="imageload"){ 
	 if(isset($_REQUEST['name']))
	 {
	 	 $name=$_REQUEST['name'];?>
        <img src="<?=trim($name)?>" width="100px" height="100px" />
     <a class="tab_edt_btn11" href="#" id="m_<?=trim($name)?>"  ><i class="glyphicon glyphicon-trash"></i></a>
        <?php
	 }else
	 {
		 $name="";
		 echo "";
	 }
	 ?>
     <script>
	$(document).ready(function(){
	/*****************************  Delete menu images function starts *************************************  */
		 $(".tab_edt_btn11").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=imagedelete&image="+idval,
			success: function(msg)
			{
				$('#categryimg').css("display","none");
				$('#categryimg1').css("display","none");
				$('#categryimg2').css("display","none");
			
		   }
		});
	 
    }
		});
	/***************************************  Delete menu images function ends *************************************************  */
	});
	</script>
     
     <?php
	 }
	  else if($_REQUEST['value']=="imagedelete"){ 
		  if(isset($_REQUEST['menu']))
		  {
			 $menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menu']);
			 $imgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['image']);
			$thumb="";
			unlink($imgid);
			$sql_img=$database->mysqlQuery("Select mmy_imagename from tbl_menumaincategory where mmy_imagename ='".$imgid."' "); 
			while($result_cat_s  = $database->mysqlFetchArray($sql_img)) 
				  {
					  $thumb=$result_cat_s['mmy_imagename'];
				  }
				  if($thumb!=""){
				  unlink($thumb); }
			$sql_cat_s  =  $database->mysqlQuery("update  tbl_menumaincategory set  mmy_imagename ='' where mmy_maincategoryid='".$menuid ."' "); 
		  }else
		  {
			  $imgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['image']);
			  $imgids=preg_replace("@\n@","",$imgid);//str_replace("\n","",$imgid);//trim($imgid);
			  unlink($imgids); 
			  $sql_cat_s  =  $database->mysqlQuery("update  tbl_menumaincategory set  mmy_imagename ='' where mmy_imagename='".$imgid ."' ");
			 // echo $imgids;
		  }
	 }
	 
	 
	 
	  else if($_REQUEST['value']=="flagimgload"){ 
	 if(isset($_REQUEST['name']))
	 {
	 	 $name=$_REQUEST['name'];?>
        <img src="<?=trim($name)?>" width="100px" height="100px" />
     <a class="tab_edt_btn12" href="#" id="m_<?=trim($name)?>"  ><i class="glyphicon glyphicon-trash"></i></a>
        <?php
	 }else
	 {
		 $name="";
		 echo "";
	 }
	 ?>
	 
	     <script>
	$(document).ready(function(){
	/*****************************  Delete menu images function starts *************************************  */
		 $(".tab_edt_btn12").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=flgimagedelete&fgimage="+idval,
			success: function(msg)
			{
				$('#flagimg').css("display","none");
				$('#flagimg1').css("display","none");
				$('#flagimg2').css("display","none");
			
		   }
		});
	 
    }
		});
	/***************************************  Delete menu images function ends *************************************************  */
	});
	</script>
     
     <?php
	 }
	  else if($_REQUEST['value']=="flgimagedelete"){ 
		  if(isset($_REQUEST['menu']))
		  {
			 $menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menu']);
			 $imgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['image']);
			$thumb="";
			unlink($imgid);
			$sql_img=$database->mysqlQuery("Select cy_flagimage from tbl_country where cy_flagimage ='".$imgid."' "); 
			while($result_cat_s  = $database->mysqlFetchArray($sql_img)) 
				  {
					  $thumb=$result_cat_s['cy_flagimage'];
				  }
				  if($thumb!=""){
				  unlink($thumb); }
			$sql_cat_s  =  $database->mysqlQuery("update  tbl_country set  cy_flagimage ='' where cy_countyid='".$menuid ."' "); 
		  }else
		  {
			  $imgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['fgimage']);
			  $imgids=preg_replace("@\n@","",$imgid);//str_replace("\n","",$imgid);//trim($imgid);
			  unlink($imgids); 
			  $sql_cat_s  =  $database->mysqlQuery("update tbl_country set cy_flagimage ='' where cy_flagimage='".$imgid ."' ");
			 // echo $imgids;
		  }
	 }
	  
	  
	  
	  else if($_REQUEST['value']=="searchprintertype"){
		 /* ******************************************** Preference master ******************************************************* */
	$ptype	= $_REQUEST['ptype'];
	$search="";
	if($ptype!="null")
	{
		if($search!="")
		{
			$search.=" and  pt_typename LIKE  '%" . $ptype ."%'";
		}else
		{
			$search.=" pt_typename LIKE  '%" . $ptype ."%'";
		}
	}

	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_printtype').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/printer_type_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">       
   <thead>
   <tr>
      <th  height="35px">Printer Type</th>
 <td >Action</td>
    </tr>
    </thead>
     <tbody >                                           
 <?php
 if($search!="")
  {
	  $search=" where $search";
  }
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_printertype $search");
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['pt_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
  	<tr id="ids_<?=$result_cat_s['pt_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['pt_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['pt_typename'],$ptype)?></td>
         <td> <a href="#" class="md-trigger_printtype" id="ids_<?=$result_cat_s['pt_id']?>" ><img src="images/edit_page.PNG"></a>
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['pt_id']?>"></td>
      <!--    <td>
           <a href="#" class="md-trigger_ing" id="ids_<?=$result_cat_s['ir_ingredientid']?>" ><img src="images/edit_page.PNG"></a>
           <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['ir_ingredientid']?>">
           <a href="#" onClick="delete_confirm('<?=$result_cat_s['ir_ingredientid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>
                                </td>-->
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>
     <?php } 
	 
	 
	 else if($_REQUEST['value']=="searchreport")
	  	{
	 /* ******************************************** Floor master ******************************************************* */
		 $reportid	= $_REQUEST['reportid'];
		
		$search="";
	if($reportid!="null")
	{
		if($search!="")
		{
			$search.=" and  rm_reportname LIKE  '%" . $reportid ."%'";
		}else
		{
			$search.=" rm_reportname LIKE  '%" . $reportid ."%'";
		}
	}
	
	
	
	

	
	?>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_flr').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/report_edit.php", {report:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>

  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1"> 
 <thead>
 <tr>
        <td>Report Name</td>
                                <td>Report View</td>
                                <td>Report Print_A4</td>
                                <td>Email</td>
                                 <td>Action</td>
  </tr>
   </thead>
     <tbody >                                           
                                            
  <?php	
if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_reportmaster  $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['rm_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
         	<tr id="ids_<?=$result_cat_s['rm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['rm_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['rm_reportname'],$reportid)?></td>
         <td><?=$result_cat_s['rm_reportview']?></td>
         <td><?=$result_cat_s['rm_printa4']?></td>
         <td><?=$result_cat_s['rm_email']?></td>
      
        
         <td>
         <a href="#" class="md-trigger_flr" id="ids_<?=$result_cat_s['rm_id']?>" ><img src="images/edit_page.PNG"></a>
             <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['rm_id']?>">
      
                                </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>

     <?php 
	 }
	  
		 /* ******************************************** Credit master ******************************************************* */
	 
	 else if($_REQUEST['value']=="searchcredit")
	 {
		$search=""; 
	$type	= $_REQUEST['type'];
	$rum	=$_REQUEST['rum'];
	$stf	=$_REQUEST['stf'];
	$cmp	=$_REQUEST['cmp'];
	$gst	=$_REQUEST['gst'];
	$statuss=$_REQUEST['status'];
	
	//echo $type;
	if($type!="null")
	{
		if($search!="")
		{
			$search.="   c.crd_type =  '" . $type ."'";
		}else
		{
			$search.="  c.crd_type =  '" . $type ."'";
		}
	}else{
            $search.=" c.crd_type !='' ";
        }
	if($rum!="null")
	{
		if($search!="")
		{
			$search.="";
		}else
		{
			$search.="";
		}
	}
	
	if($stf!="null")
	{
		if($search!="")
		{
			$search.="  and  c.crd_staffid='".$stf."'";
		}else
		{
			$search.=" c.crd_staffid='".$stf."'";
		}
	}
	if($cmp!="null")
	{
		if($search!="")
		{
			$search.=" and  c.crd_corporateid='".$cmp."'";
		}else
		{
			$search.=" c.crd_corporateid='".$cmp."'";
		}
	}
	if($gst!="null")
	{
		if($search!="")
		{
			$search.="  and c.crd_guestid='".$gst."'";
		}else
		{
			$search.=" c.crd_guestid='".$gst."'";
		}
	}
	
	if($statuss!="null")
	{
		if($search!="")
		{
			$search.=" and  c.crd_active='".$statuss."'";
		}else
		{
			$search.=" c.crd_active='".$statuss."'";
		}
	}
	
	
	
	
	
	?>
     <script src="js/jquery-1.10.2.min.js"></script>
     <script>
	$(document).ready(function(){
		$('.table_report tr').click(function() {
			var id_str   =  $(this).attr("id");
			 var id_arr	  =	 id_str.split("_");
			 var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).addClass('table_active');
			$('#hiddenmenuid').val(selval);
		});
		$('.md-trigger_ing').click( function() { 
				var id_str   =  $(this).attr("id");
				var id_arr	  =	 id_str.split("_");
				var selval       =  id_arr[1];
				$('.table_report tr').removeClass('table_active');
				$(this).parent().parent().addClass('table_active');
				$('#hiddenmenuid').val(selval);
				$('.mynewpopupload').css("display","block"); 
				$(".olddiv").addClass("new_overlay");
				var menuid=$('#hiddenmenuid').val();
				  $.post("popup/ingredient_edit.php", {menu:menuid},
					  function(data)
					  {
					  data=$.trim(data);
					  
					  $('.mynewpopupload').html(data);
					  });  
		});
		$('.ui-corner-all').click( function() {
		validateSearch();
		});
	});
	</script>
  <table class="responstable tablesorter" id="listall">
                        <thead>
                         	 <tr>
                               
                                <th width="10%" class="header">Type</th>
       				<th width="10%" class="header">Credit To</th>
                                <th width="10%" class="header">Amount</th>
                                 <th width="10%" class="header">Active</th>
                               </tr>
                            </thead>
      <tbody style="height:7vh">                                           
 <?php
 if($search!="")
  {
	  $search="where c.crd_totalamount>=0 and  $search";
  }
  else{
      $search="where c.crd_totalamount>0 ";
  }
  
  
  //echo "select * from tbl_credit_master left join tbl_credit_types on tbl_credit_master.crd_type=tbl_credit_types.ct_creditid left join tbl_roommaster on tbl_credit_master.crd_roomid=tbl_roommaster.rm_roomid left join tbl_staffmaster on tbl_credit_master.crd_staffid=tbl_staffmaster.ser_staffid left join tbl_corporatemaster on  tbl_credit_master.crd_corporateid=tbl_corporatemaster.ct_corporatecode left join tbl_loyalty_reg on tbl_credit_master.crd_guestid=tbl_loyalty_reg.ly_id $search";
 
	//$sql_cat_s  =  $database->mysqlQuery("select * from tbl_credit_master left join tbl_credit_types on tbl_credit_master.crd_type=tbl_credit_types.ct_creditid left join tbl_roommaster on tbl_credit_master.crd_roomid=tbl_roommaster.rm_roomid left join tbl_staffmaster on tbl_credit_master.crd_staffid=tbl_staffmaster.ser_staffid left join tbl_corporatemaster on  tbl_credit_master.crd_corporateid=tbl_corporatemaster.ct_corporatecode left join tbl_loyalty_reg on tbl_credit_master.crd_guestid=tbl_loyalty_reg.ly_id $search");
	$sql_cat_s  =  $database->mysqlQuery("select ct.ct_credit_type as type,cm.ct_corporatename as company_name,l.ly_mobileno,l.ly_firstname as guest_name,concat(s.ser_firstname,'',s.ser_lastname) as staff_name,
r.rm_roomno as room_name,c.crd_totalamount as total_amount,c.crd_active as active,c.crd_roomid,c.crd_staffid,c.crd_corporateid,c.crd_guestid,c.crd_id from tbl_credit_master c 
left join tbl_credit_types ct ON ct.ct_creditid = c.crd_type
left join tbl_corporatemaster cm ON cm.ct_corporatecode = c.crd_corporateid
left join tbl_loyalty_reg l ON l.ly_id = c.crd_guestid
left join tbl_staffmaster s ON s.ser_staffid = c.crd_staffid
left join tbl_roommaster r ON r.rm_roomid = c.crd_roomid $search");


	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
		/*	if($result_cat_s['crd_active']=="Y")
				{
					$active="Yes";
					
				}else 
				{
					$active="No";
				}	
				if($result_cat_s['crd_roomid'] !="")
				{
					$party=$result_cat_s['rm_roomno'];
				}
				else if($result_cat_s['crd_staffid']!="")
				{
					$party=$result_cat_s['ser_firstname'];
			}
			else if($result_cat_s['crd_corporateid']!="")
			{
				$party=$result_cat_s['ct_corporatename'];
			}
			else
			{
				$party=$result_cat_s['ly_firstname'];
			}*/
				if($result_cat_s['active']=="Y")
				{
					$active="YES";
					
				}else 
				{
					$active="NO";
				}
                                $party="";
				if($result_cat_s['crd_roomid'] !="")
				{
					$party=$result_cat_s['room_name'];
				}
				else if($result_cat_s['crd_staffid']!="")
				{
					$party=$result_cat_s['staff_name'];
				}
				else if($result_cat_s['crd_corporateid']!="")
				{
					$party=$result_cat_s['company_name'];
				}
				else if($result_cat_s['crd_guestid']!="")
				{
					$party=$result_cat_s['guest_name'].' - '.$result_cat_s['ly_mobileno'];
				}
				$name='';
				if(($result_cat_s['type'])=="By Staff")
				{
					$name="By Staff";
				}else if($result_cat_s['type']=="By Room")
				{
					$name=$result_cat_s['room_name'];
				}else if($result_cat_s['type']=="By Company")
				{
					$name="By Company";
				}else if($result_cat_s['type']=="By Guest")
				{
					//$staff=$database->show_masterloyality_details($result_cat_s['crd_guestid']);
					$name="By Guest";
				}
		/*		if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					  $_SESSION['menuidselect']=$result_cat_s['fbm_id'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}*/
?>
  	<?php /*?><tr id="ids_<?=$result_cat_s['fbm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['fbm_id']){ ?> table_active <?php } ?> ">
         <td><?=$database->highlightkeyword($result_cat_s['fbm_question'],$question)?></td>
           <td><?=$database->highlightkeyword($active,$statuss1)?></td>
          </tr><?php */?>
          
          
          
    						<tr id="ids_<?=$result_cat_s['crd_id']?>"  class="select">
                     <!--          	<td width="5%"><a href="#" class="tab_edt_btn md-trigger_edit" id="ids_<?=$result_cat_s['crd_id']?>"><i class="fa fa-edit"></i></a>   </td>-->
                                <td width="10%"  ><?=$name?></td>
                                <td width="10%" ><?=$party?></td>
                                <td width="10%" ><?=$result_cat_s['total_amount']?></td>
                                 <td width="10%" >
            <?php if($result_cat_s['active']=="Y"){ ?>  
                                 <a   data-modal-id="popup1"  class="active_btn_pop" href="#" id="ids_<?=$result_cat_s['crd_id']?>" title="ToNo" > <?=$active?></a>
                                 <?php } else{ ?>
                                  <a   data-modal-id="popup1"  class="active_btn_pop" href="#" id="ids_<?=$result_cat_s['crd_id']?>" title="ToYes" ><?=$active?></a>
                                 <?php } ?>  

   </td>
                               
          
          
          
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold;color: red">No records to Display !</td><?php }  ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>


<script>
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('.active_btn_pop').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
		var id_str   =  $(this).attr("id");
	 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		
		var title=$(this).attr("title");
		
		
		$('#hidcancel').val(selval);
$('#hidcanc').val(title);	
		
		
		
		
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();
 
});
</script>
<script>
function validate_sv(id,status)
{
var a=	$('#hidcancel').val();
	var b=$('#hidcanc').val();
	 	if(b=="ToYes")
		{
		window.location="credit_master.php?id="+a+"&delete=yes";
		}else
		{window.location="credit_master.php?id="+a+"&delete=no";
		}
		
		
		$('#hidcancel').val("");
		$('#hidcanc').val("");
}

</script>

     <?php 
	 }
	 else if($_REQUEST['value']=="searchreportmaster")
	 {
		 
		/* ******************************************** Table master ******************************************************* */
	$rpt	= $_REQUEST['rpt'];
	$status= $_REQUEST['statuss'];
	
	$search="";
	if($rpt!="null")
	{
		if($search!="")
		{
			$search.=" and  rm_reportname LIKE  '%" . $rpt ."%'";
		}else
		{
			$search.=" rm_reportname LIKE  '%" . $rpt ."%'";
		}
	}
	if($status!="null")
	{
		if($search!="")
		{
			$search.=" and  rm_reportview LIKE  '%" . $status ."%'";
		}else
		{
			$search.=" rm_reportview LIKE  '%" . $status ."%'";
		}
	}

?>
 <script src="js/jquery-1.10.2.min.js"></script>
<script>
$(document).ready(function(){
	$('.tablesorter tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.tablesorter tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_edit').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.tablesorter tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/report_master_edit.php", {rm_id:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
				  
				  
				  
				  
	});
	
			$('.md-trigger_view').click( function() { 
	
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.tablesorter tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			
			
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			
			  $.post("popup/reportmaster_view.php", {rm_id:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				 
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	
	$('.ui-corner-all').click( function() {
	validateSearch();
	});

	
	
});
</script>
  <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall1">            
 <thead>
 <tr>
 <th width="5%" class="header" >Sl No</th>
 <th width="15%" class="header">Report ID</th>
  
    <th width="15%" class="header">Report Name</th>
    <th width="8%" class="header">Active</th>
    <th width="13%" class="header">To Print</th>
    <th width="8%" class="header">Print A4</th>
    <th width="8%" class="header">Email</th>
    <th width="10%" class="header">DayClose Mail</th>
    <th width="10%" class="header">DayClose Print</th>
  
    <th  class="header">Action</th>
  </tr>
   </thead>
     <tbody >                                           
<?php
 if($search!="")
  {
	  $search="where $search";
  }
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_reportmaster  $search");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
$_SESSION['menuidselect']='';
	if($num_cat_s){$k=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if(!isset($_REQUEST['id']))
				{
				  if($k==0)
				  {
					   $_SESSION['menuidselect']=$result_cat_s['rm_id'];
					
				  }
				}else
				{
					 $_SESSION['menuidselect']=$_REQUEST['id'];
					
				}
				
				
		if($result_cat_s['rm_reportview']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
				
					if($result_cat_s['rm_printa4']=="Y")
				{
				
					$a4="Yes";
				}else 
				{
					$a4="No";
				}	
				
					if($result_cat_s['rm_dayclosemail']=="Y")
				{
				
					$dayclosemail="Yes";
				}else 
				{
					$dayclosemail="No";
				}	
				
					if($result_cat_s['rm_daycloseprint']=="Y")
				{
				
					$daycloseprint="Yes";
				}else 
				{
					$daycloseprint="No";
				}	
				if($result_cat_s['rm_email']=="Y")
				{
				
					$email="Yes";
				}else 
				{
					$email="No";
				}			
				
?>
         	<tr id="ids_<?=$result_cat_s['rm_id']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['rm_id']){ ?> table_active <?php } ?> ">
               <td width="5%"><?=$k?></td>
             <td width="15%"><?=$result_cat_s['rm_reportid']?></td>
       
         <td width="15%"><?=$database->highlightkeyword($result_cat_s['rm_reportname'],$rpt)?></td>
         <td width="8%"><?=$database->highlightkeyword($active,$status)?></td>
         <td width="13%"><?=$result_cat_s['rm_posprintofanother']?></td>
         <td width="8%"><?=$a4?></td>
           <td width="8%"><?=$email?></td>
             <td width="10%"><?=$dayclosemail?></td>
               <td width="10%"><?=$daycloseprint?></td>
         
               <td> 
                                                    <a class="tab_edt_btn md-trigger_view" id="ids_<?=$result_cat_s['rm_id']?>" ><i class="icontick">
                                                    	<img src="img/icon-view.png" width="22px" height="22px"></i>
                                                     </a>
                                                        <a class="tab_edt_btn md-trigger_edit " id="ids_<?=$result_cat_s['rm_id']?>"><i class="fa fa-edit"></i></a>
                                                          <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['rm_id']?>">
                                                          
                                                          
                                    <?php  if($active=="Yes") { ?>

                                                     <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToNo','<?=$result_cat_s['rm_id']?>')"><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"/></i></a>

                                                     <?php }else if($active=="No") { ?>

                                                     <a class="tab_edt_btn" href="#" onClick="delete_confirm('ToYes','<?=$result_cat_s['rm_id']?>')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"/></i></a>


                                                     <?php } ?>                         
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                          
                                                    <!--    <a class="tab_edt_btn" href="#"><i class="icontick">
                                                          <img src="img/green_tick.png" width="25px" height="25px"></i>
                                                      </a>-->
                                                    </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold">No records to display</td><?php } ?>
    </tbody>
    </table>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 
</script>

     <?php 
	 }
	 
	else if($_REQUEST['value']=="chng_paswrd")
	{
		$usrid=$_REQUEST['userid'];
		
		$encrypted_password=md5($_REQUEST['nw']);
        //echo "update `tbl_logindetails` set ls_password='$encrypted_password' where ls_username='$usrid'";
        //die();
        $query3=$database->mysqlQuery("update `tbl_logindetails` set ls_password='$encrypted_password' where ls_username='$usrid'"); 
                /*	  $num_login   = $database->mysqlNumRows($query3);
                  if($num_login){*/
                          echo "ok";
                 /* }
                  else
                  {
                          echo "sorry";
                  }*/
			
	}
	
else if($_REQUEST['value']=="loaduser")
{
	$userid=$_REQUEST['id'];
	$qury=$database->mysqlQuery("select distinct(ls_username) from tbl_logindetails where ls_username <>'$userid'"); 
	
		  $num_rslt  = $database->mysqlNumRows($qury);
		  if($num_rslt){  ?>
		  <option value="">Select User</option>
         
		 <?php while($result_kot  = $database->mysqlFetchArray($qury)) 	{ ?>
			<option value="<?=$result_kot['ls_username']?>"><?=$result_kot['ls_username']?></option>
		  <?php } ?> 
          </optgroup>
		 
	<?php }
}

 ?>