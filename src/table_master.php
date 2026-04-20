<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=1;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
   $database->mysqlQuery("DELETE FROM tbl_tablemaster WHERE tr_tableid = '" .$_REQUEST['id']."'");

    if (!headers_sent())
    {    
        header('Location: table_master.php?msg=1');
        exit;
        
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="table_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=table_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['tablename']))
{
    
            $br="1";	
	    
	    $insertion['tr_branchid']= mysqli_real_escape_string($database->DatabaseLink,trim($br));
            $insertion['tr_floorid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['floorname']));
	    $insertion['tr_tableno'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tablename']));
            if($_REQUEST['timealloted']!=''){ 
            $insertion['tr_timealloted'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['timealloted']));
            }
            else{
               $insertion['tr_timealloted'] 		=  mysqli_real_escape_string($database->DatabaseLink,10); 
            }
            
            $sql=$database->check_duplicate_entry('tbl_tablemaster',$insertion);
            
	    $insertion['tr_maxchaircount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['maxchair']));
                  
	if(isset($_REQUEST['active']))
	{
	 		$insertion['tr_status'] 		=  'Active';
	}else
	{
	 		$insertion['tr_status'] 		=  'Non Active';
	}
	$insertion['tr_displayorder'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['order']));
   
	if($sql!=1)
	{
             
	$insertid              			=  $database->insert('tbl_tablemaster',$insertion);
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
       
        $database->updateexpodine_machines();     
    
        $lastid = '';
        $sql_login = $database->mysqlQuery("select tr_tableid from tbl_tablemaster where tr_tableno='" . $insertion['tr_tableno'] . "'  AND tr_branchid='" . $insertion['tr_branchid'] . "'");
        $num_login = $database->mysqlNumRows($sql_login);
        while ($result_login = $database->mysqlFetchArray($sql_login)) {
             $lastid = $result_login['tr_tableid'];
        }

	}
         
	
	if (!headers_sent())
        {    
        header('Location: table_master.php?msg=');
        exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="table_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=table_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['tablename1']))
{
	if(isset($_REQUEST['active1']))
	{
		$active='Active';
	}
        else 
        {
                $active='Non Active';
        }
        
	$id=$_REQUEST['tableid'];
	$tableno=trim($_REQUEST['tablename1']);
	$branch="1";
        $floor=trim($_REQUEST['floor1']);
	$maxchair=trim($_REQUEST['maxchair1']);
	$order1=trim($_REQUEST['order1']);
        if(trim($_REQUEST['timealloted1'])!=''){
        $time1=trim($_REQUEST['timealloted1']);
        }
        else{
           $time1=10;
        }
        
      $query3=$database->mysqlQuery("update tbl_tablemaster set tr_branchid='$branch', tr_floorid='$floor',  tr_status='$active',"
      . " tr_tableno='$tableno',tr_maxchaircount='$maxchair',tr_displayorder='$order1',tr_timealloted='$time1' where tr_tableid='$id'");
      
      $database->updateexpodine_machines(); 

       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
      
        if (!headers_sent())
        {    
            header("Location: table_master.php?msg=3&load_id=$id ");
            exit;
        }
        else
        {  
            
        echo '<script type="text/javascript">';
        echo 'window.location.href="table_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=table_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
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
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Table Master</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
 .ui-autocomplete{z-index:999999 !important;}
 .md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}



</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){ 
			$('#tables').autocomplete({source:'autocomplete/find_keywords.php?type=tables_t', minLength:1});
			$('#chairs').autocomplete({source:'autocomplete/find_keywords.php?type=chairs_t', minLength:1});
			$('#floors').autocomplete({source:'autocomplete/find_keywords.php?type=floors_t', minLength:1});
			$('#branchs').autocomplete({source:'autocomplete/find_keywords.php?type=branchs_t', minLength:1});
			$('#statuss').autocomplete({source:'autocomplete/find_keywords.php?type=statuss_t', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script>

$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
         
       $("#modal-17").removeClass('md-show');
    });

$(document).ready(function(){
    
   var url_check=$('#url_check').val();
    
   var new_id=url_check.split('load_id=');
  
   if(new_id[1]=='' || new_id[1]=='undefined' || new_id[1]==undefined ){
                localStorage.floors_ld = 'null';
                localStorage.branchs_ld = 'null';
                localStorage.chairs_ld = 'null';
                localStorage.statuss_ld = 'null';
                localStorage.tables_ld='null';
   }
   
   
    $('#ids_'+new_id[1]).addClass('table_active');
    
    
     if(localStorage.tables_ld !='' && localStorage.tables_ld !='null' )  {   
                    $('#tables').val(localStorage.tables_ld);
                
                 }else{
                 $('#tables').val('');  
                 }
                 
                 if(localStorage.tables_ld !='' && localStorage.tables_ld !='null' )  {   
                     $('#chairs').val(localStorage.chairs_ld);
                
                 }else{
                 $('#chairs').val('');
                 }
                 
        
                $('#floors').val( localStorage.floors_ld);
                 $('#branchs').val(localStorage.branchs_ld);
                   $('#statuss').val(localStorage.statuss_ld);
                 
                 
       if(localStorage.tables_ld !='null'  || localStorage.chairs_ld !='null' || localStorage.floors_ld !='null' ||  localStorage.branchs_ld !='null' ||  localStorage.statuss_ld !='null')      
                 
        {
            validateSearch();
            
        }
    
 
    
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
                        
			//$(this).parent().parent().addClass('table_active');
                        
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
        
        
  $('.ui-corner-all').click( function() {
	validateSearch();
   });

});
</script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
     }
     .navbar-inner{z-index: 999999 !important;}
</style>
</head>
<body>
     <input type="hidden"  id="order_check" >
      <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Table Master</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                        
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div><!--cc_new-->
                   
                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                                <span class="filte_new_text">Table Name</span>
                                <input autocomplete="off" autofocus type="text" class="form-control filte_new_box" id="tables" name="tables" placeholder="Table Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                            	<span class="filte_new_text">Max Chair Count</span>
                                <input  type="text" class="form-control filte_new_box" maxlength="2" id="chairs" name="chairs" autocomplete="off" placeholder="Max Chair Count" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                            	<span class="filte_new_text">Select Floor</span>
                                <select  class="add_text_box filte_new_box"  id="floors" name="floors" onChange="validateSearch()" >
                                 <option value="null">All</option>
                                 <?php
					$sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active'"); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{
	 				?>
                                         <option value="<?=$result_login['fr_floorname']?>"><?=$result_login['fr_floorname']?></option>
                                 <?php } } ?>
                                         
                                </select>
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                             	<span class="filte_new_text">Select Branch</span>
                                 <select  class="add_text_box filte_new_box"  id="branchs" name="branchs" onChange="validateSearch()">
                                 <option value="null" default>All</option>
                                 
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['be_branchname']?>"><?=$result_login['be_branchname']?></option>
                               <?php } } ?>	
                                </select>
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                            	<span class="filte_new_text">Select Status</span>
                                <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Active">Active</option>
                                <option value="Non Active">Non-Active</option>
                                </select>
                            </div>
                            
                         
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;display: none" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="table_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" id="add_table" class="md-trigger add_btn_2" data-modal="modal-17" onClick="tableclr()"></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th width="8%" >. SL</th>
                                <th>Table Name</th>
                             	<th> Chair Count</th>
                                 <th>Vaccant</th>
                                 <th>Floor</th>
       				 <th style="display:none">Branch</th>
                                 <th>Status</th> 
                                 <th>Display Order</th> 
                                 <th>Time Alloted</th>
                                 <td >Action</td>
                              </tr>
                             </thead>
                             
        <?php
        
        $fl_name='';
        $sql_tab_count= $database->mysqlQuery("SELECT COUNT(*) as numberoftables  FROM tbl_tablemaster");
        $result_tab_count   = $database->mysqlFetchArray($sql_tab_count);
        
	 $sql_login  =  $database->mysqlQuery("select * from tbl_tablemaster INNER JOIN tbl_branchmaster ON "
         . " tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON "
         . "tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid ORDER BY fr_floorname,tr_tableno+0 asc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                     
                      $i++;
                      
                     if($fl_name!=$result_login['fr_floorname']){ 
                         
                         $fl_name=$result_login['fr_floorname'];
                         
                         ?>
                         <tr>
                             <td style="font-weight:bold;color:darkred;text-transform: uppercase">FLOOR : <?=$result_login['fr_floorname']?></td>               
                                
                              </tr>
                         
                         <?php
                     }
                      
	 ?>
    				<tr id="ids_<?=$result_login['tr_tableid']?>"  class="select">
                                <td width="8%"><?=$i?></td>               
                                <td><?=$result_login['tr_tableno']?> </td>
                                <td><?=$result_login['tr_maxchaircount']?></td>
                                 <td><?=$result_login['tr_vaccantcount']?></td>
                                <td><?=$result_login['fr_floorname']?></td>
                                <td style="display:none"><?=$result_login['be_branchname']?></td>
                                <td><?=$result_login['tr_status']?></td>
                                 
                                <td><?=$result_login['tr_displayorder']?></td>
                                 <td><?=$result_login['tr_timealloted']?></td>
                                <td>
                                    
                                    <span style="position: relative; ">
                                     <a style="position: absolute; top:-9px; left:-18px;cursor: pointer" href="#" class="md-trigger_table" id="ids_<?=$result_login['tr_tableid']?>" ><img src="images/edit_page.PNG"></a>
                                     <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['tr_tableid']?>">
                                     <!--    <a href="#" onClick="delete_confirm('<?=$result_login['tr_tableid']?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                                   
                                     <?php if($result_login['tr_vaccantcount']==0 || $result_login['tr_vaccantcount']==''){ ?>
                                     <i title="FREE OR RELEASE THE TABLE FOR ORDERING" onclick="free_table('<?=$result_login['tr_tableid']?>')" style="cursor: pointer ;position: absolute; top:-4px; right:30px;" class="fa fa-unlock-alt"></i>
                                     <?php } ?>
                                     
                                     <a style="position: absolute; top:-14px; left:14px;cursor: pointer;display: block" href="qr_gen/index.php?id=<?=$result_login['tr_tableid']?>&floor=<?=$result_login['tr_floorid']?>&name=<?=$result_login['tr_tableno']?>" class="md-trigger_table" id="" ><img src="img/barcode.PNG"></a>
                                          
                                </span>
                                    
                                </td>
                              </tr>
                               
          <?php } } ?>
                              
                   </table>

                   </div>

				
                        <!--<div style="background-color:#fff;border:solid 1px #ccc" class="module_acces_head"><span>
                                  <ul style="margin-right:5px;" class="pagination">
                                <li>
                                  <a href="#" aria-label="Previous">
                                    <span aria-hidden="true">«</span>
                                  </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                  <a href="#" aria-label="Next">
                                    <span aria-hidden="true">»</span>
                                  </a>
                                </li>
                              </ul>
                                        </span></div>-->
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
        <div class="menu_total_showing_text"><?php  echo 'Showing ' .$result_tab_count['numberoftables'] .'  records';?></div>
	</div>
  
</div>
</div><!--container-->
</div>
 <div class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                              <form role="form" action="table_master.php"  method="post"  name="table_master">
                                <span id="tablechk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Table Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_div">
                                     <input type="text" autocomplete="off" class="form-control tablename" id="tablename" name="tablename"  placeholder="Table Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="Table No"  ></div>
                               </div>
                               	 <div class="first_form_contain">
                             	<div class="form_name_cc">Max Chair Count<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="chair_div">
                                     <input value="4" onkeypress="return numdot(event)" type="text"  class="form-control maxchair" maxlength="2" id="maxchair" name="maxchair"  placeholder="Max Chair Count" tabindex="2"  data-toggle="tooltip" title="Max Chair Count" ></div>
                               </div>
                                  <div class="first_form_contain">
                                 	<div class="form_name_cc">Floor<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="floor_div">
                                        <?php
                                         
					$sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster  where fr_status='Active'"); 
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){ 
											
                                        ?>
                                        <select onchange="dis_order_check()" data-placeholder="Enter Floor" id="floorname" name="floorname" data-rel="chosen" tabindex="3" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">SELECT FLOOR </option>
                                       
                                         <?php 
					 while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
					  {
					?>
                                           
                                        <option   value="<?=$result_kot['fr_floorid']?>" id="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                      
                                         <?php } ?> 
                                              
                                        
                                    	 </select>
                                         <?php } ?>
                                         
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                    <div style="display:none"class="first_form_contain">
                                 	<div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group" id="brofc_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Branch Name" id="branchofficename" name="branchofficename" tabindex="4" data-rel="chosen" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="BRANCH">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <?php /*?><option value="<?=$result_kot['be_branchid']?>"><?=$result_kot['be_branchname']?></option><?php */?>
                                                 <option value="<?=$result_kot['be_branchid']?>" id="<?=$result_kot['be_branchid']?>"><?=$result_kot['be_branchname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        <input checked type="checkbox" value="1" tabindex="5" name="active"  id="active" data-toggle="tooltip" title="Active">
                       
                    </label>
                </div>              
                               </div>
                                  </div>
                                   <div class="first_form_contain">
                             	<div class="form_name_cc">Table Order <span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc" id="order_div" >
                                    <input type="text" maxlength="3" onkeypress="return numdot(event)" class="form-control tablename" id="order" name="order"  placeholder="Order" tabindex="6"  data-toggle="tooltip" title="Order"  ></div>
                               </div>
                                  <div class="first_form_contain"  style="width:80% ">
                             	<div class="form_name_cc" style="width:35% ">Time alloted (Def:10 mins)</div>
                                <div class="form_textbox_cc" id="order_div" style="width:64% " >
                                    <input value="10" type="text" onkeypress="return numdot(event)" maxlength="3" class="form-control tablename" id="timealloted" name="timealloted"  placeholder="Time" tabindex="7"  data-toggle="tooltip" title="Order"  ></div>
                                  </div>
                                    <span style=" line-height: 40px;text-align: left;;width:20%;float:left;color:#000">mins</span>
                                  </form> 
                    </div>
                    			  <a  href="#" class="entersubmit" onClick="validate_tableval()" tabindex="8"><button class="md-save">Save</button></a>
                                   

                             
                            
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script>
//$(document).ready(function(){
//$('#floorname').change(function() {
//				alert('aa');
//				
//				 var cb=$(this).find('option:selected').attr('id');
//						 alert(cb);
//			});
//});
</script>
<script type="text/javascript">

	$('#add_table').click(function()
	{
		$('#tablename').focus();
	});
    
    $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
        
 function free_table(id)
{
        var confirm1=confirm(" FREE THE TABLE ?");
    if(confirm1===true){
    
	           $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=free_table&id="+id,
			success: function(msg)
			{
                           
                            if($.trim(msg)=='no'){
                                
                                alert('TABLE IS IN USE . PLEASE DONT CLEAR THE TABLE ');
                            }else{
                                
                                 alert('TABLE IS FREE TO USE');
                                location.reload();
                            }
                            
                        }
                        
        });
    }
}   

        
    
function tableclr()
{
	    document.getElementById('tablename').value = '';
	    document.getElementById('floorname').value='1';
            //  document.getElementById('maxchair').value='';
            document.getElementById('branchofficename').value='';
            document.getElementById('order').value='';
	    $('#tablechk').text('');
	    //$("input[type=checkbox]").each(function() { this.checked=false; });
	    $("#menumaincategory_div").removeClass("has-error");
	    $("#chair_div").removeClass("has-error");
	    $("#floor_div").removeClass("has-error");
	    $("#brofc_div").removeClass("has-error");
            $("#order_div").removeClass("has-error");
            dis_order_check();
                       
}


function dis_order_check()
{
     var flr= document.getElementById('floorname').value;
     $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=tb_order_dis&flr="+flr,
			success: function(msg)
			{
                            
                            //alert(msg);
                          $('#order').val(parseInt($.trim(msg))+1);
                          
                        }
                        });
    
    
}


function valitable()
{
	 var a=$("#tablename").val().trim();
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktable&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#tablechk');
				if(msg =="sorry")
					{
                                           
                         $('.alert_error_popup_all_in_one').show();      
                         $('.alert_error_popup_all_in_one').text('Already Exist');
                         $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
			  //namechk.text('Already exists');
			     $("#menumaincategory_div").addClass("has-error");
	  $("#tablename").focus();
					}
					else
					{
						namechk.text('');
						 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
					}
			}
		});
}

		function validate_tableval()
			{
			 if(validate_table())
				{
					if(validate_chair())
					{
						if(validate_floor())
						{
							 
                                                            if(validate_order())
							{
                                                           
						if (validateall())
						{
						
						}
							
                                                        }
					
                                                }
                                            }
				}
			}
			
		function validate_table()   
			{
				if($(".tablename").val()=="")
				{
					
					$("#menumaincategory_div").addClass("has-error");
						  document.table_master.tablename.focus();
                                                  //alert("Enter Table Name");
                                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Table Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
						  return false;
				}
                               
                               var alphanumers = /^[a-zA-Z0-9_]+$/;
                              if(!alphanumers.test($("#tablename").val())){
                              $("#menumaincategory_div").addClass("has-error");
                            document.table_master.tablename.focus();
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
                            
                 // alert("Special charecter Not Allowed.");
                   }  
        
                                    else
					 {
						 var a=document.getElementById("tablename").value;
						 $("#menumaincategory_div").removeClass("has-error");
					     $("#menumaincategory_div").addClass("has-success");
						 return true;
						 

					 }
			}
                    
			function validateall()
			{
			
				 var a=document.getElementById("tablename").value;
				// var b=document.getElementById("floorname").value;
				 var cb=$("#floorname").find('option:selected').attr('id');
				//document.getElementById("branchofficename").value;
				var c= $("#branchofficename").find('option:selected').attr('id');
                                
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktable&mid="+a+"&flor="+cb+"&brn=1",
			success: function(data)
			{
			data=$.trim(data);
		       // alert(data);
			var namechk=$('#tablechk');
                        //alert(data);
			if(data =="sorry")
			{
                            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Table Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
		// namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#tablename").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	//return true;
	  	document.table_master.submit();

			}
			}
		});
			}
                        
                        
			function validate_chair()   
			{
				if($("#maxchair").val()=="")
				{
					$("#chair_div").addClass("has-error");
						  document.table_master.maxchair.focus();
                                                  //alert("Max Chair Count");
                                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Max Chair Count');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
						  return false;
				}
                                
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#maxchair").val())){
                              $("#chair_div").addClass("has-error");
                           document.table_master.maxchair.focus();
                 // alert("Special charecter Not Allowed.");
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Characters Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
                   }  
                                
                               
                                    else
					 {
					     var a=document.getElementById("maxchair").value;
					     $("#chair_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
                                    }
			
                            
			function validate_floor()   
			{
				
				if($("#floorname").val()=="")
				{
					$("#floor_div").addClass("has-error");
						  document.table_master.floorname.focus();
                                                  //alert("Select Floor");
                                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Floor');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
						  return false;
				}
                                
//                                var alphanumers = /^[a-zA-Z0-9]+$/;
//                              if(!alphanumers.test($("#floorname").val())){
//                              $("#floor_div").addClass("has-error");
//                            document.table_master.floorname.focus();
////                  alert("Special charecter Not Allowed.");
//                   }  
                                    else
					 {
				             var a=document.getElementById("floorname").value;
					     $("#floor_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			        }
                        
			
                         
                               
                               
                        function validate_order()   
			{
				if($("#order").val()=="")
				{
                                    $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Table Order');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
					//alert('Enter Table Order');
					$("#order_div").addClass("has-error");
						  document.table_master.order.focus();
						  return false;
			}else{
                                    
                                    
                                         
                        var ord=$("#order").val();
                        
                         var flr=$("#floorname").val();
                                             
                        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checktable_order&ord="+ord+"&flr="+flr,
			success: function(data3)
			{ 
                           if($.trim(data3)=='ok'){ 
                              
				validateall();
                           }else{
                             
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Order Already Exist In Floor');
                        
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');   
                        return false;
                        
                        
                   
                                 }         
                                             
                            
                        }
                             });
                       }    
                                    
                                 
                         
	}       
                               
                               
                               
                               
                               
                               
                        
			
function delete_confirm(id)
{
	var check = confirm("Are you sure you want to Delete record?");
	if(check==true)
	{
		window.location="table_master.php?id="+id+"&delete=yes";
	}
}	



function numdot(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
            return false;
            return true;
          
  }
</script>
<script type="text/javascript">
function validateSearch()
{    
	 var tables=$("#tables").val();
  if(tables=="")
  {
	  tables="null";
  }
  var chairs=$("#chairs").val();
  if(chairs=="")
  {
	  chairs="null";
  }
   var floors=$("#floors").val();
  if(floors=="")
  {
	  floors="null";
  }
   var branchs=$("#branchs").val();
  if(branchs=="")
  {
	  branchs="null";
  }
  var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchtable&tables="+tables+"&chairs="+chairs+"&floors="+floors+"&branchs="+branchs+"&statuss="+statuss,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
                
                
                localStorage.tables_ld=tables;
                localStorage.chairs_ld=chairs;
                
               localStorage.floors_ld=floors;
                localStorage.branchs_ld=branchs;
                 localStorage.statuss_ld= statuss;    
                
                
}

</script>
<style>
	
	.menu_total_showing_text{background-color: #fff; width: auto;color: #333;position: absolute;bottom: 5px;font-size: 15px;font-weight:bold; height: 25px; width: 100%; padding-left: 10px;}
</style>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">


$(document).ready(function() {
   $("#listall").tablesorter();
}); 

$("#tables").focus();

</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>