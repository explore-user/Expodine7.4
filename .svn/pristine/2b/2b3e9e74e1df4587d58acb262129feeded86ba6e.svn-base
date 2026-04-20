<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='Y' WHERE mk_menuid = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menustock SET  mk_stock='N' WHERE mk_menuid = '" .$_REQUEST['id']."'");
	}
	// header("location:stock.php?msg=3");
}



$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}
?>
<style>
.md-content1{border:0 !important}
.btn{border:0 !important}
.updatestock{
	width: 40px;
    height: 37px;
        float: none !important;
    display: inline-block !important;
    background-image: url(img/update.png);
    background-repeat: no-repeat;
    background-position: center;
	position:relative !important ;
	cursor:pointer;
  right: 0px;
    left: 0;
    margin: auto;
	background-position: 10px !important;
	}
.filter_cont_tbl tbody{min-height:inherit !important;height:auto !important;overflow:inherit !important}
.filter_cont_list_cc{min-height:400px !important;}	
.manage_pop_table_contant_scroll{ min-height: 370px;}
</style>

<link href="css/mange_pop_stl.css" rel="stylesheet" />
<script>
function validateSearch_stock()
{
  var menu=$("#mname").val();
  if(menu=="")
  {
	  menu="null";
  }
   var mstatus=$("#mstatus").val();
  if(mstatus=="")
  {
	  mstatus="null";
  }
   var catname=$("#catname").val();
   if(catname=="")
  {
	  catname="null";
  }
  var subcatname=$("#subcatname").val();
  //subcatname=="" || 

   if(subcatname=="" || subcatname==undefined)
  {
	 
	  subcatname="NULL";
  }
	  $.ajax({
			type: "POST",
			url: "load_divstock.php",
			data: "value=searchactivemenu&menu="+menu+"&mstatus="+mstatus+"&catname="+catname+"&subcatname="+subcatname,
			success: function(msg)
			{
				$('#stock').html(msg);
			}
		});  
}

</script>
<?php
$date=$_SESSION['date'];//date('Y-m-d');
						   		
$sql_menulist  =  ("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid WHERE mk_date='$date'"); // and tbl_menumaster.mr_dailystock<>'N'
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo '$(".updatestock").css("display","block")';
	echo '});';
	echo '</script>';
	
}else
{	
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo '$(".updatestock").css("display","block")';
	echo '});';
	echo '</script>';
}

?>
<style>
.popup_filter_cc{margin-top:3px;margin-bottom: 5px;width: 20%;margin-right: 0;}
.form-control{height:30px;line-height:30px;padding:0;padding-left:5px;}
.mange_filter_cc{height:auto;float:left;}
.pop_filter_btn{height:30px;line-height:30px;}
.filter_cont_tbl tbody td{font-size:12px; height: 30px;}
.filter_cont_list_cc{padding:0}
.filter_cont_tbl thead td{height:30px;}
.md-close_pop_new{width: 40px;height: 37px;float: right;background-image: url(img/close_ico.png);background-repeat: no-repeat;background-position: center;position:absolute;cursor:pointer;right: 0px;top: 0px;}
.pop_filter_btn{color: #fff !important;font-size: 16px;}
</style>

<div class="md-content1" style="position:fixed;width:750px;left:0;top:3% !important;z-index:9999999999999 !important;right:0;margin:auto;"><!--1sttab-->
<div class="container-fluid" style="margin-top: 20px;">
	<div style="background-color:#fff;" class="row">
     <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
		   
        	<div class="mang_pop_head"><?=$_SESSION['header_stock_management']?><a class="md-close_pop_new" style="display:block"></a></div>
            <div class="mange_filter_cc">
                     <div class="popup_filter_cc">
                    	<div class="filte_new_text"><?=$_SESSION['header_category']?></div>
                        <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaincategory"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select  id="catname" name="catname"   class="form-control add_new_dropdown" onchange="validateSearch_stock()">
                                        <option value=""><?=$_SESSION['header_all']?></option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['mmy_maincategoryname']?>"><?=$_SESSION[$result_kot['mmy_maincategoryid']]['category'] //$result_kot['mmy_maincategoryname']?></option>
                                    <?php } ?> 
                                        
                                    	 </select>
                                         <?php } ?>         
                    </div>
                    <div class="popup_filter_cc">
                    	<div class="filte_new_text"><?=$_SESSION['header_sub_category']?></div>
                        <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menusubcategory"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select  id="subcatname" name="subcatname"   class="form-control add_new_dropdown" onchange="validateSearch_stock()">
                                        <option value=""><?=$_SESSION['header_all']?></option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['msy_subcategoryname']?>"><?=$_SESSION[$result_kot['msy_subcategoryid']]['subcategory'] //$result_kot['msy_subcategoryname']?></option>
                                    <?php } ?> 
                                        
                                    	 </select>
                                         <?php } ?>         
                    </div>
                    
                 	<div class="popup_filter_cc">
                    	<div class="filte_new_text"><?=$_SESSION['header_menu_name']?></div>
                        <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select  id="mname" name="mname"   class="form-control add_new_dropdown" onchange="validateSearch_stock()">
                                        <option value=""><?=$_SESSION['header_all']?></option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['mr_menuname']?>"><?=$_SESSION[$result_kot['mr_menuid']]['menu']//$result_kot['mr_menuname']?></option>
                                    <?php } ?> 
                                        
                                    	 </select>
                                         <?php } ?>         
                    </div>
                    <div class="popup_filter_cc">
                    	<div class="filte_new_text"><?=$_SESSION['header_select_status']?></div>
                       			<select class="form-control popop_txt_bx" id="mstatus" name="mstatus" onchange="validateSearch_stock()">
                                   <option value="null"><?=$_SESSION['header_all']?></option>	
                                    <option value="yes"><?=$_SESSION['header_yes']?></option>
                                    <option value="no"><?=$_SESSION['header_no']?></option>
                               
                                </select>
                    </div>
                    <div style="width: 12%;" class="popup_filter_cc">
                    	<div class="filte_new_text"></div>
                        <a style="width: 100%;" href="#" class="pop_filter_btn" onclick="validateSearch_stock()"><?=$_SESSION['header_search']?></a>
                    </div>
                       
		  
                    
                </div><!--mange_filter_cc-->
                
                <div class="filter_cont_list_cc">
                	<div class="manage_pop_table_head">
                    	<table width="100%" border="0" class="filter_cont_tbl" cellspacing="0">
                          <thead>
                            <tr>
                              <td ><?=$_SESSION['header_menu']?></td>
                              <td width="25%"><?=$_SESSION['header_category']?></td>
                              <td width="20%"><?=$_SESSION['header_sub_category']?></td>
                              <td width="10%"><?=$_SESSION['header_status']?></td>
                            </tr>
                          </thead> 
                        </table>
                    </div><!--manage_pop_table_head-->
                    	<div class="manage_pop_table_contant_scroll"  id="stock">
                		<table width="100%" border="0" class="filter_cont_tbl" cellspacing="0" >
                        
                           <tbody>
                           <?php
						   $date=$_SESSION['date'];//date('Y-m-d');
						   		
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menustock LEFT JOIN tbl_menumaster ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid WHERE tbl_menustock.mk_date='$date'  and tbl_menumaster.mr_dailystock_in_number = 'N' "); //and tbl_menumaster.mr_dailystock<>'N'
//order by tbl_menumaster.mr_dailystock DESC


//echo "select * from tbl_menucombination where mn_menuid='".$_SESSION['menuidselect']."'";
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
                           <tr <?php if($result_cat_s['mr_dailystock']=="N"){ ?> bgcolor="#B1B1B1"<?php } ?>   >
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
                            
                              <?php $k++;}} ?>
                          
                           </tbody>
                          </table>
					</div><!--manage_pop_table_contant_scroll-->
                </div><!--filter_cont_list_cc-->
              
				<div style="width: 100%;text-align:center;  text-align: center;background-color: #ccc;display: inline-block;" class="">
					<a style="    padding: 10px 2% 2px 6px;margin-bottom: 5px;margin-top: 5px;font-size: 15px;text-align: right;height: 40px !important;width: 20% !important;" class="btn btn-primary btn-block md-close_pop updatestock"><?=$_SESSION['header_update']?></a>
				</div>
		
	</div>
</div>
</div>
 <script>
 $(document).ready(function()
{
$('.md-close_pop_new').click( function() {  	
			  $('.mynewpopupload1').css("display","none");
			  $(".olddiv1").removeClass("new_overlay"); 
			 
	});	
//	$('.updatestock').click( function() {  	
//			  $.ajax({
//			type: "POST",
//			url: "load_divstock.php",
//			data: "value=updatestock",
//			success: function(msg)
//			{
//				$('#stock').html(msg);
//				//$(".updatestock").css("display","none")
//		   }
//		}); 
//			 
//	});
});
function delete_confirm(status,id)
{
	var stats="null";
	var catg="null";
	var subc="null";
	var mnu="null";
	var check = confirm("<?=$_SESSION['header_error_change_status']?>?");
	
	if(check==true)
	{
		var statu=status;
		var idval=id; 
		$.ajax({
			type: "POST",
			url: "load_divstock.php",
			data: "value=updatetronly&menuid="+idval+"&status="+statu+"&stats="+stats+"&catg="+catg+"&subc="+subc+"&mnu="+mnu,
			success: function(msg)
			{//delstatus
			//alert(msg);
				$('#stock').html(msg);
		   }
		});
	}
	
}	
</script>