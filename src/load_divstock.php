<?php
include('includes/session.php');	  // Check session
include("database.class.php");           // DB Connection class
$database	= new Database(); 	// Create a new instance
if($_REQUEST['value']=="delstatus"){   //old copy not working- working copy below updatetronly
	/* ******************************************** Load stock div  ******************************************************* */
	  $menuid	= $_REQUEST['menuid'];
	  
	$status= $_REQUEST['status'];
	$stats=trim($_REQUEST['stats']);
	 $catg=trim($_REQUEST['catg']);
	$subc=trim($_REQUEST['subc']);
	$mnu=trim($_REQUEST['mnu']);
	
	if($_REQUEST['status']=="ToYes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='Y' WHERE mk_menuid = '" .$_REQUEST['menuid']."'");
		
		
		
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='N' WHERE mk_menuid = '" .$_REQUEST['menuid']."'");
	}
	
	
	$search="";
	if($catg !="null")
	{
		if($search!="")
		{
			$search.=" and  tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $catg ."%'";
		}else
		{
			$search.=" tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $catg ."%'";
		}
	}
	if($subc !="null")
	{
		if($search!="")
		{
			$search.=" and  tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $subc ."%'";
		}else
		{
			$search.=" tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $subc ."%'";
		}
	}
	if($mnu	!="null")
	{
		if($search!="")
		{
			$search.=" and  mr_menuname	 LIKE  '%" . $mnu ."%'";
		}else
		{
			$search.=" mr_menuname	 LIKE  '%" . $mnu ."%'";
		}
	}
	if($stats!="null")
	{
		$sr="";
	$type=strtolower($stats);
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
			$search.=" and  mk_stock LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" mk_stock LIKE  '%" .$sr ."%'";
		}
	}
	
?>
<script>
function delete_confirm12(status,id,ct,sb,mnu,stats)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		
		
		
		var statu=status;
		var idval=id; 
		var cat=ct;
		var subct=sb;
		var stats=stats;
		var mnu=mnu;
		$.ajax({
			type: "POST",
			url: "load_divstock.php",
			
	//data: "value=delstatus&menuid="+idval+"&status="+statu+"&catg="+cat+"&subc="+subct+"&mnu="+mnu+"&stats="+stats,
	data: "value=updatetronly&menuid="+idval+"&status="+statu+"&catg="+cat+"&subc="+subct+"&mnu="+mnu+"&stats="+stats,
			/*data: "value=delstatus&menuid="+idval+"&status="+statu,*/
			success: function(msg)
			{//alert(msg);
				$('#stock').html(msg);
		   }
		});
	}
	
}	
</script>




<!--<div class="manage_pop_table_head">
                    	<table width="100%" border="0" class="filter_cont_tbl" cellspacing="0" >
                          <thead>
                            <tr>
                              <td >Menu</td>
                              <td>Category</td>
                              <td>Sub category</td>
                              <td>Status</td>
                            </tr>
                          </thead> 
                        </table>
                    </div>--><!--manage_pop_table_head-->
                    
         <div class="manage_pop_table_contant_scroll" id="stock">


 <table class="table_report scroll tablesorter filter_cont_tbl"  width="100%" border="0" cellspacing="5">        
                                       
<?php

  if($search!="")
  {
	  $search="where $search";
  }

 $date=$_SESSION['date'];//date('Y-m-d');
/* echo "select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and mk_date='$date' order by tbl_menumaster.mr_dailystock DESC";
die();*/ 
//echo "select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and mk_date='$date' order by tbl_menumaster.mr_dailystock DESC" ; //and tbl_menumaster.mr_dailystock<>'N'

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and tbl_menustock.mk_date='$date'  and tbl_menumaster.mr_dailystock_in_number = 'N' "); //and tbl_menumaster.mr_dailystock<>'N'
//order by tbl_menumaster.mr_dailystock DESC

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
	
	while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
                           <tr <?php if($result_cat_s['mr_dailystock']=="N"){ ?> bgcolor="#B1B1B1"<?php } ?>>
                              <td><?=$_SESSION[$result_cat_s['mr_menuid']]['menu']//$result_cat_s['mr_menuname']?></td>
                              <td width="25%"><?=$_SESSION[$result_cat_s['mmy_maincategoryid']]['category'] //$result_cat_s['mmy_maincategoryname']?></td>
                              <td width="20%"><?php if($result_cat_s['msy_subcategoryid']!=""){echo $_SESSION[$result_cat_s['msy_subcategoryid']]['subcategory'];} //$result_cat_s['msy_subcategoryname']?></td>
                                <td width="10%"> 
								<?php if($result_cat_s['mr_dailystock']=="Y"){ ?>
									<?php if($result_cat_s['mk_stock']=="Y"){ ?>  
                                <a  onClick="delete_confirm12('ToNo','<?=$result_cat_s['mk_menuid']?>','<?=$catg?>','<?=$subc?>','<?=$mnu?>','<?=$stats?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                     <?php } else{ ?>
                              <a  onClick="delete_confirm12('ToYes','<?=$result_cat_s['mk_menuid']?>','<?=$catg?>','<?=$subc?>','<?=$mnu?>','<?=$stats?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a></td>
                                     <?php } ?> 
                                 <?php } else { ?>
                                <img src="img/green_tick.png" width="25px" height="25px">
                                    
                                 <?php } ?>  
                                 </tr>
                                   <?php $k++;}} else{ ?> <td colspan="4" style="font-weight:bold"><?=$_SESSION['credit_settlement_error_record_display']?></td><?php }?>
                                
    </tbody>
    </table>

</div>
   <?php } else if($_REQUEST['value']=="searchactivemenu"){
	 /* ******************************************** Sub Category master ******************************************************* */ 
	// subcatnams statuss 
	$searchmenu= $_REQUEST['menu'];
	$statuss= $_REQUEST['mstatus'];
	$cat=$_REQUEST['catname'];

	
	$sub=$_REQUEST['subcatname']; 
	
	$search="";
	if($cat !="null")
	{
		if($search!="")
		{
			$search.=" and  tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $cat ."%'";
		}else
		{
			$search.=" tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $cat ."%'";
		}
	}
	if($sub !="NULL")
	{
		if($search!="")
		{
			$search.=" and  tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $sub ."%'";
		}else
		{
			$search.=" tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $sub ."%'";
		}
	}
	if($searchmenu!="null")
	{
		if($search!="")
		{
			$search.=" and  mr_menuname	 LIKE  '%" . $searchmenu ."%'";
		}else
		{
			$search.=" mr_menuname	 LIKE  '%" . $searchmenu ."%'";
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
			$search.=" and  mk_stock LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" mk_stock LIKE  '%" .$sr ."%'";
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
    <table class="table_report scroll tablesorter filter_cont_tbl"  width="100%" border="0" cellspacing="5">         
<!-- <thead>
 <tr>
     <td style="color:#FFF">Menu</th>
      <td style="color:#FFF">Category</td>
    <td style="color:#FFF">Sub category</td>
    <td style="color:#FFF">Status</th>
  </tr>
   </thead>-->
     <tbody >                                           
   <?php
   if($search!="")
  {
	  $search="where $search";
  }
   $date=$_SESSION['date'];//date('Y-m-d');

$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search and tbl_menustock.mk_date='$date'  and tbl_menumaster.mr_dailystock_in_number = 'N' order by tbl_menumaster.mr_dailystock DESC");//and tbl_menumaster.mr_dailystock<>'N'


$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				if($result_cat_s['mk_stock']=="Y")
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
					  $_SESSION['menuidselect']=$result_cat_s['mk_menuid'];
				  }
				}else
				{
					$_SESSION['menuidselect']=$_REQUEST['id'];
				}
?>
         	<tr id="ids_<?=$result_cat_s['mr_menuid']?>"  class="clicktoview <?php if($_SESSION['menuidselect']==$result_cat_s['mk_menuid']){ ?> table_active <?php } ?>"  <?php if($result_cat_s['mr_dailystock']=="N"){ ?> bgcolor="#B1B1B1"<?php } ?>>
          <td><?=$_SESSION[$result_cat_s['mr_menuid']]['menu']////$database->highlightkeyword($result_cat_s['mr_menuname'],$searchmenu)?></td>
           <td width="25%"><?=$_SESSION[$result_cat_s['mmy_maincategoryid']]['category'] //$database->highlightkeyword($result_cat_s['mmy_maincategoryname'],$cat)?></td>
          <td width="20%"><?php if($result_cat_s['msy_subcategoryid']!=""){echo $_SESSION[$result_cat_s['msy_subcategoryid']]['subcategory'];} //$database->highlightkeyword($result_cat_s['msy_subcategoryname'],$sub)?></td>
            <td width="10%"> 
       
                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_cat_s['mk_menuid']?>">
                
                 
             <!--<a href="#" onClick="delete_confirm('<?=$result_cat_s['mk_menuid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
             <?php if($result_cat_s['mr_dailystock']=="Y"){ ?>
                <?php if($result_cat_s['mk_stock']=="Y"){ ?>  
                       <a  onClick="delete_confirm1('ToNo','<?=$result_cat_s['mk_menuid']?>','<?=$cat?>','<?=$sub?>','<?=$searchmenu?>','<?=$statuss?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                       <?php } else{ ?>
                        <a  onClick="delete_confirm1('ToYes','<?=$result_cat_s['mk_menuid']?>','<?=$cat?>','<?=$sub?>','<?=$searchmenu?>','<?=$statuss?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a>
                       <?php } ?> 
		   <?php } else { ?>
           <img src="img/green_tick.png" width="25px" height="25px">
           <?php } ?>      
             
            </td>
          </tr>
  <?php $k++;}}else{ ?> <td colspan="4" style="font-weight:bold"><?=$_SESSION['credit_settlement_error_record_display']?></td><?php } ?>
    </tbody>
    </table>
     <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall1").tablesorter();
}); 

function delete_confirm1(status,id,ct,sb,mnu,stats)
{

	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		var statu=status;
		var idval=id; 
		var cat=ct;
		var subct=sb;
		var stats=stats;
	var mnu=mnu;
		//alert(status+"********"+id+"**********"+ct+"********"+sb+"********"+mnu+"********"+stats)
		$.ajax({
			type: "POST",
			url: "load_divstock.php",
			data: "value=updatetronly&menuid="+idval+"&status="+statu+"&catg="+cat+"&subc="+subct+"&mnu="+mnu+"&stats="+stats,
			success: function(msg)
			{//delstatus
			//alert(msg)
				$('#stock').html(msg);
		   }
		});
	}
	
}	



</script>
     <?php }else if($_REQUEST['value']=="updatestock"){
	 /* ******************************************** Load menu stock master ******************************************************* */
	 $database->mysqlQuery("SET @entrydate 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']) . "'");
	
	$sq=$database->mysqlQuery("CALL  proc_dailymenustock(@entrydate)");
	?>

 <table class="table_report scroll tablesorter filter_cont_tbl"  width="100%" border="0" cellspacing="5">        

     <tbody >                                           
<?php

 $date=$_SESSION['date'];//date('Y-m-d');
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid WHERE tbl_menustock.mk_date='$date'  and tbl_menumaster.mr_dailystock_in_number = 'N' order by tbl_menumaster.mr_dailystock DESC"); //and tbl_menumaster.mr_dailystock<>'N'

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
	
	while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
                           <tr <?php if($result_cat_s['mr_dailystock']=="N"){ ?> bgcolor="#B1B1B1"<?php } ?>>
                              <td><?=$_SESSION[$result_cat_s['mr_menuid']]['menu']//$result_cat_s['mr_menuname']?></td>
                                <td width="25%"><?=$_SESSION[$result_cat_s['mmy_maincategoryid']]['category'] //$result_cat_s['mmy_maincategoryname']?></td>
                              <td width="20%"><?php if($result_cat_s['msy_subcategoryid']!=""){echo $_SESSION[$result_cat_s['msy_subcategoryid']]['subcategory'];} //$result_cat_s['msy_subcategoryname']?></td>
                                <td width="10%"> 
								<?php if($result_cat_s['mr_dailystock']=="Y"){ ?>
									  <?php if($result_cat_s['mk_stock']=="Y"){ ?>  
                                  <a  onClick="delete_confirm('ToNo','<?=$result_cat_s['mk_menuid']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                       <?php } else{ ?>
                                <a  onClick="delete_confirm('ToYes','<?=$result_cat_s['mk_menuid']?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a></td>
                                       <?php } ?>  
                                  <?php } else { ?>
                             <img src="img/green_tick.png" width="25px" height="25px">
                             <?php } ?>          
                                 </tr>
                                   <?php $k++;}} else{ ?> <td colspan="4" style="font-weight:bold"><?=$_SESSION['credit_settlement_error_record_display']?></td><?php }?>
                                
    </tbody>
    </table> <?php
	 }
	else if($_REQUEST['value']=="updatetronly"){
		
	/* ******************************************** Load stock div  ******************************************************* */
	  $menuid	= $_REQUEST['menuid'];
	  
	$status= $_REQUEST['status'];
	$stats=trim($_REQUEST['stats']);
	 $catg=trim($_REQUEST['catg']);
	$subc=trim($_REQUEST['subc']);
	$mnu=trim($_REQUEST['mnu']);
	
	if($_REQUEST['status']=="ToYes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='Y' WHERE mk_menuid = '" .$_REQUEST['menuid']."'");
		
		
		
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='N' WHERE mk_menuid = '" .$_REQUEST['menuid']."'");
	}
	
	
	
	
	
	
	
	
	
	
	$search="";
	if($catg !="null")
	{
		if($search!="")
		{
			$search.=" and  tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $catg ."%'";
		}else
		{
			$search.=" tbl_menumaincategory.mmy_maincategoryname  LIKE  '%" . $catg ."%'";
		}
	}
	if($subc !="null" && ($subc!='NULL'))
	{
		if($search!="")
		{
			$search.=" and  tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $subc ."%'";
		}else
		{
			$search.=" tbl_menusubcategory.msy_subcategoryname  LIKE  '%" . $subc ."%'";
		}
	}
	if($mnu	!="null" )
	{
		if($search!="")
		{
			$search.=" and  mr_menuname	 LIKE  '%" . $mnu ."%'";
		}else
		{
			$search.=" mr_menuname	 LIKE  '%" . $mnu ."%'";
		}
	}
	if($stats!="null")
	{
		$sr="";
	$type=strtolower($stats);
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
			$search.=" and  mk_stock LIKE  '%" . $sr ."%'";
		}else
		{
			$search.=" mk_stock LIKE  '%" .$sr ."%'";
		}
	}
	
?>
<script>
function delete_confirm12(status,id,ct,sb,mnu,stats)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		
		
		
		var statu=status;
		var idval=id; 
		var cat=ct;
		var subct=sb;
		var stats=stats;
		var mnu=mnu;
		$.ajax({
			type: "POST",
			url: "load_divstock.php",
			
	//data: "value=delstatus&menuid="+idval+"&status="+statu+"&catg="+cat+"&subc="+subct+"&mnu="+mnu+"&stats="+stats,
	data: "value=updatetronly&menuid="+idval+"&status="+statu+"&catg="+cat+"&subc="+subct+"&mnu="+mnu+"&stats="+stats,
			/*data: "value=delstatus&menuid="+idval+"&status="+statu,*/
			success: function(msg)
			{//alert(msg);
				$('#stock').html(msg);
		   }
		});
	}
	
}	
</script>
  <table class="table_report scroll tablesorter filter_cont_tbl"  width="100%" border="0" cellspacing="5">                          
                                       
<?php

  if($search!="")
  {
	  $search="where $search";
  }

 $date=$_SESSION['date'];//date('Y-m-d');
/* echo "select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and mk_date='$date' order by tbl_menumaster.mr_dailystock DESC";
die();*/ 
//echo "select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and mk_date='$date' order by tbl_menumaster.mr_dailystock DESC" ; //and tbl_menumaster.mr_dailystock<>'N'
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $search  and tbl_menustock.mk_date='$date'  and tbl_menumaster.mr_dailystock_in_number = 'N' "); //and tbl_menumaster.mr_dailystock<>'N'
//order by tbl_menumaster.mr_dailystock DESC
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
	
	while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
                           <tr <?php if($result_cat_s['mr_dailystock']=="N"){ ?> bgcolor="#B1B1B1"<?php } ?>>
                              <td><?=$_SESSION[$result_cat_s['mr_menuid']]['menu']//$result_cat_s['mr_menuname']?></td>
                              <td width="25%"><?=$_SESSION[$result_cat_s['mmy_maincategoryid']]['category'] //$result_cat_s['mmy_maincategoryname']?></td>
                              <td width="20%"><?php if($result_cat_s['msy_subcategoryid']!=""){echo $_SESSION[$result_cat_s['msy_subcategoryid']]['subcategory'];} //$result_cat_s['msy_subcategoryname']?></td>
                                <td width="10%"> 
								<?php if($result_cat_s['mr_dailystock']=="Y"){ ?>
									<?php if($result_cat_s['mk_stock']=="Y"){ ?>  
                                <a  onClick="delete_confirm12('ToNo','<?=$result_cat_s['mk_menuid']?>','<?=$catg?>','<?=$subc?>','<?=$mnu?>','<?=$stats?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                     <?php } else{ ?>
                              <a  onClick="delete_confirm12('ToYes','<?=$result_cat_s['mk_menuid']?>','<?=$catg?>','<?=$subc?>','<?=$mnu?>','<?=$stats?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a></td>
                                     <?php } ?> 
                                 <?php } else { ?>
                                <img src="img/green_tick.png" width="25px" height="25px">
                                    
                                 <?php } ?>  
                                 </tr>
                                   <?php $k++;}}  ?>
                                
  </tbody>
    </table>

   <?php 
		
	}
	 
	 ?>
    