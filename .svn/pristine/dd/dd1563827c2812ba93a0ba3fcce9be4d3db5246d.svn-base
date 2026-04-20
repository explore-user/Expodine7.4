<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Take Away</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/master_pop_default.css" />
<link rel="stylesheet" type="text/css" href="css/master_pop_component.css" />
<!--<link href="css/whitebg/take_away.css" rel="stylesheet" type="text/css">-->
<script src="js/jquery-1.10.2.min.js"></script>
<style>
body{font-family:inherit}
.md-content h3{font-size: 1.4em;}.md-content button{font-size:0.8em;}
.md-content{background: #E4E4E4;}
.left_contant_container {height: 84.2vh}	
.new_right_drop{margin-top:-8px;}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
    <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container">
      <div class="top_site_map_cc ">
            	<ul>
					<!--<li><a href="index.php" title=""><span class="home_icon"></span>\</a></li>-->
					<li><a title="">Listing Home Delivery</a></li>
				</ul>
                  <div class="back_btn"><a href="take_away.php">Back</a></div>
                <div class="top_al_search_cc">
                	<!--<span class="top_al_search_name"> </span>-->
                    <span><input class="search" placeholder="Search " name="search" id="search" type="text"></span>
                </div>
               
            </div>
      		<div style="  min-height: 555px;overflow:auto" class="left_contant_container" >
            <div id="ta_listallorders_list">
            <?php
			$curdate=date("Y-m-d");
			$sql_menulist= "Select distinct(tb.tab_billno),tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno  From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' And tb.tab_kotno != '' And (  tb.tab_status='Packed') AND tb.tab_mode='HD' order by tb.tab_time ASC ";
			
			 // $sql_menulist= "Select distinct(tab_billno),tab_time,tab_customermobile,tab_customername,tab_hdcustomerid ,tab_status,tab_kotno From tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' And tab_kotno != '' And tab_status='Packed' And tab_hdcustomerid IS NOT NULL  order by tab_time DESC ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// 
							?>
           <div class="take_kot_detail_cc">                  
            	<div class="take_away_list_cc  home_dlvry   takeawaykoteachclick_home" bilno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>" cutomerid="<?=$result_menus['tab_hdcustomerid']?>"><!--take_active-->
                    <!--<div class="take_order_item_name"><img src="img/printer.png"></div>--><!--take_order_item_name-->
                	<div class="take_list_oder_num"><?=$result_menus['tab_billno']?></div>
                    <div class="take_oder_odred_name"><span>Customer</span> :<?=$result_menus['tac_customername']?></div>
                    <div class="take_oder_odred_name"><span>Mobile No</span> : <?=$result_menus['tac_contactno']?>l</div>
                     <div class="take_oder_odred_name"><span>Time</span> : <?=date("h:i:s a",strtotime($result_menus['tab_time'])) ?></div>
                     <div class="take_oder_odred_name"><span>Status</span> : <?=$result_menus['tab_status'] ?></div>
                </div><!--take_away_list_cc-->
        <!-- <a class="print_kot ta_printbillhdeach" > <div class="take_order_item_name"><img src="img/printer.png"></div></a>-->
        </div>         
                <?php }} else
		 {
			 echo "<span style='color: #F00E0E;'> Nothing to display </span>";
		 } ?>
               </div>
             
                
                
            </div><!--left_contant_container-->
        
        <div class="right_order_inform right_calc_cc take_detail_right_cc">
        	<div style="min-height: 595px;" class="right_main_cc">
            	<div class="top_head">Details</div>
                <div class="take_oder_right_detail">
                	<div style="border-bottom: 1px solid rgba(255,255,255,0.1);min-height:240px;" class="take_right_inform_cc">
                        <div class="take_oder_odred_name"><span>Order No </span>  <span id="ta_loadtakbill"></span></div>
                        <div class="take_oder_odred_name"><span>KOT No </span> <span id="ta_loadtakkotl"></span></div>
                        <div id="ta_loadsutomerdetails">
                           <!-- <div class="take_oder_odred_name"><span>Customer Name</span> : Ebin</div>
                            <div style="height:auto;" class="take_oder_odred_name"><span>Address</span>:
                                <div class="take_oder_address_view">Customer Ad<br>
                                West Hill<br>
                                Calicut
                                </div>
                            </div>
                             <div class="take_oder_odred_name"><span>Landmark</span> : Westhill Hotel</div>
                             <div class="take_oder_odred_name"><span>Mobile</span> : 9876543210</div>-->
                         </div>
                     </div><!--take_right_inform_cc-->
                     
                     	<div style="height:auto;" class="take_right_inform_cc order_items_contain " >
                        	<div class="take_pop_show_btn viewall" style="display:none"><a  class="md-trigger_taload "  href="#">+ View Orders</a></div>
                        </div><!--take_right_inform_cc-->
                        <div id="home_delivery"  style="border-bottom: 1px solid rgba(255,255,255,0.1);height:100px;margin-top:3%;display:none" class="take_right_inform_cc viewall">
                     	<div class="take_oder_odred_name"><span>Assign</span> :
                        	 <div class="take_oder_address_view">
                             <select class="take_assign_drop" name="asignedstaff"  id="asignedstaff">
                               <option value="">Select Staff</option>
             <?php
		    $sql_ds_nos="select ser_staffid,ser_firstname from tbl_staffmaster where ser_designation='".$_SESSION['desgn_deliveryboy']."' AND  ser_employeestatus='Active'";
			$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
			$num_ds = $database->mysqlNumRows($sql_ds);
			if($num_ds){ 
			 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
					{ ?>
					<option  value="<?=$result_ds['ser_staffid']?>"><?=$result_ds['ser_firstname']?></option>
				<?php } }  ?>
                             </select></div>
                        </div><!--take_oder_odred_name-->
                        <div class="take_oder_odred_name"><span>Est. Time</span> :
                        	<div class="take_oder_address_view"> <input class="take_assign_drop" value="30" type="text" style="width: 73%;" name="assignedtime"  id="assignedtime">Min</div>
                        </div><!--take_oder_odred_name-->
                     </div><!--take_right_inform_cc-->
                        <div class="take_botom_button viewall" style="display:none"><a  href="#" id="ta_assigntoadelboy">Submit</a></div>
                </div><!--take_oder_right_detail-->
            </div><!--right_main_cc--->
        </div><!---right_order_inform-->
        
        
        
      </div><!--middle_container-->          
</div>




              
<div class="md-overlay"></div><!-- the overlay element -->
<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* --> 

<script src="js/takeaway_list_hd.js"></script>
<script src="js/takeaway_print.js"></script>
<script src="js/takeawaykot_each.js" ></script>
<?php //include "includes/top_main_menu.php"; ?>  
<script src="js/master_classie.js"></script>
<script src="js/master_modalEffects.js"></script>
<!--<script type="text/javascript">

$(".home_dlvry").click (function ()
{
	$("#home_delivery").css("display","block");
	//take_away_list_cc
	});
$(".take_away_list_cc").click (function ()
{
	$("#home_delivery").css("display","none");
	//take_away_list_cc
	});	
</script>
-->
</body>

</html>