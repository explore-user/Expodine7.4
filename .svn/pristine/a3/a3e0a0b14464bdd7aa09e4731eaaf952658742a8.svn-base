<?php session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include("database_inv.class.php"); 
$database_inv	= new Database_inv();

$branchname='';
$address='';
 $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $address=$result_branch['be_address'];
						
					}
		  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
</head>
<body style="background:none;overflow:scroll !important">
<!-- main header -->
<div style="width:1000px;margin:0 auto">

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">
                
                
                
  <!-- <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
      <tbody>
          <tr> 
          <td id="printbutton"> <input type="submit" value="Print" class="print_button_main" onclick="return print_page()" /></td>
          </tr>
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
      </tbody>
  </table>-->
                
                
                
                
                
                
                

 <?php if($_REQUEST['value']=="exporttopdf") { 
 
 
 
 $exportingnos =$_REQUEST['exportingnos'];
 $menuname=$database->show_menu_wholeful_details($_REQUEST['menuid']);
 $reporthead = "Food Quantity - " . $menuname['mr_menuname'];
	  
		
 ?>  
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">
       <img width="80px" src="img/huamuglogo-x-500x400.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr bgcolor="#000000">
      <th style="font-size:18px; " colspan="6"><strong><?=$reporthead?></strong></th>
      </tr>

      
    </thead>
    </table>
   <table class="table table-bordered table-font user_shadow" >
    <thead>
        
        <tr bgcolor="#000000">
        <th style="font-size:20px; "><strong>Sl No</strong></th>
        <th style="font-size:20px; "><strong>Item Name</strong></th>
        <th style="font-size:20px; "><strong>Unit Qty</strong></th>
        <th style="font-size:20px; "><strong>New Qty</strong></th>
        <th style="font-size:20px; "><strong>Unit</strong></th>
      </tr>
    </thead>
    <tbody>
  <?php
  
  $db1=DATABASE_NAME.".fc_recipe_details";
 $db2=INV_DATABASE_NAME.".inv_tbl_productmaster";
 $db3=INV_DATABASE_NAME.".inv_tbl_unitmaster";
  $db4=DATABASE_NAME.".tbl_menumaster";
		  
 $sql_login  =  $database->mysqlQuery("select * from $db1 fd LEFT JOIN $db4 as mr ON fd.fc_menuid=mr.mr_menuid LEFT JOIN $db2 as pm ON fd.fc_ingredientid=pm.prm_productid LEFT JOIN $db3 as um ON fd.fc_ing_unit=um.um_id WHERE fc_menuid ='".$_REQUEST['menuid']."'"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){$i=1;
			while($result_login  = $database->mysqlFetchArray($sql_login)) 
			  {	
			  $qt=$exportingnos * $result_login['fc_qty'];
			   ?>
     
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$result_login['prm_productname']?></td>
                             <td><?=$result_login['fc_qty']?></td>
                             <td><?=round(($qt),2)?></td>
                             <td><?=$result_login['um_name']?></td>
                             
                              </tr> 
                              <?php $i++;} } ?>
                         
                           </tbody>
                            </table>


<?php }

?>

				</div>
		</div>
        <!-- Bottom TABLE -->
    </div>
  </div></div>
				
							<!--[if !IE]>end section content bottom<![endif]-->
							

</body>
</html>

<script type="text/javascript">
function print_page()
{
  document.getElementById("printbutton").style.display = "none";	
  window.print();
}
</script>
