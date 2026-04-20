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
<title>Take Away</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<!--<link rel="stylesheet" type="text/css" href="css/popup/master_pop_default.css" />
<link rel="stylesheet" type="text/css" href="css/master_pop_component.css" />-->
<!--<link href="css/whitebg/take_away.css" rel="stylesheet" type="text/css">-->
<script src="js/jquery-1.10.2.min.js"></script>

<!--<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>-->
<!--ESC Key press starts-->
    <script type="text/javascript">
	$(document).ready(function() 
	{
		document.onkeydown = function(evt) {
			evt = evt || window.event;
			if (evt.keyCode == 27) {
				$('.new_alert_cc').css('display','none');
			}
		};
		
		
		
		 $(".selectallit").on('click', function() {//input:checkbox
				  var $box = $(this);
				  if ($box.is(":checked")) {
								$('.selecteachrowtopack').addClass('tka_kottable_selected')  
				  }else
				  {
					  $('.selecteachrowtopack').removeClass('tka_kottable_selected') 
				  }
				 
				});
	});
	</script>
      <!--ESC Key press ends-->

<style>
body{font-family:inherit}
.md-content h3{font-size: 1.4em;}.md-content button{font-size:0.8em;}
.md-content{background: #E4E4E4;}
.left_contant_container {height: 84.2vh}	
.new_right_drop{margin-top:-8px;}
.take_botom_button{width: 32%;margin-left: 1%;padding-right:0;height: 35px;line-height:35px;border-radius: 5px;}
.take_botom_button a{line-height:35px;font-size:15px;padding-right:0;}
.take_away_kot_bottom_inform_cc, .take_kot_top_site_map_cc, .take_kot_left_contant_container{height: 40px;}
</style>

</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
    <?php include"includes/topbar_takeaway.php"; ?>
      <div class="middle_container take_away_kot_middle_cc">
      <div class="top_site_map_cc take_kot_top_site_map_cc">
      			<a href="counter_sales.php"><div class="bill_his_back_btn"><?=$_SESSION['backta']?></div></a>
            	<ul>
					<!--<li><a href="index.php" title=""><span class="home_icon"></span>\</a></li>-->
					<li><a title=""><?=$_SESSION['kotlistta']?></a></li>
				</ul>
                 <!-- <div class="back_btn"><a href="take_away.php">Back</a></div>-->
                <div class="top_al_search_cc">
                <span class="top_al_search_name ta_errormsgkot" style="width:50%;  margin-left: -84%;  color: #F70E0E;"></span>
                	<!--<span class="top_al_search_name"> </span>-->
                    <span><input class="search" placeholder="<?=$_SESSION['searchbill']?>" name="search" id="search" type="text" ></span>
                </div>
               
            </div>
      		<div style="  min-height: 555px;overflow:auto" class="left_contant_container take_kot_left_contant_container" >
            <div id="cs_listallorders" >
            <?php
			$curdate=date("Y-m-d");
			// $sql_menulist= "Select distinct(tab_billno),tab_time,tab_customermobile,tab_customername,tab_hdcustomerid ,tab_status,tab_kotno,	tab_mode From tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' And tab_kotno != '' And (tab_status='KOT_Generated' OR tab_status='Processing' OR tab_status='Ready')   order by tab_status ASC ";//order by tab_time DESC
			$sql_menulist= "Select tb.tab_billno,tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' And (tb.tab_status='KOT_Generated' OR tb.tab_status='Processing' OR tb.tab_status='Ready') AND tb.tab_mode = 'CS' order by tb.tab_status ASC ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// take_active
							?>
                <div class="take_kot_detail_cc"> <!--if(!is_null($result_menus['tab_hdcustomerid']))-->
                    <div class="take_away_list_cc  <?php if(($result_menus['tab_mode'])=="HD"){ ?>home_dlvry <?php } if(($result_menus['tab_mode'])=="CS"){ ?> countersales <?php } ?> takeawaykoteachclick" bilno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>"><!--take_active-->
                        <!--take_order_item_name-->
                        <div class="take_list_oder_num"><?=$result_menus['tab_billno']?></div>
                        <div class="take_oder_odred_name"><span>Customer</span> :<?=$result_menus['tac_customername']?></div>
                        <div class="take_oder_odred_name"><span>Mobile No</span> : <?=$result_menus['tac_contactno']?>l</div>
                         <div class="take_oder_odred_name"><span>Time</span> : <?=date("h:i:s a",strtotime($result_menus['tab_time'])) ?></div>
                         <div class="take_oder_odred_name"><span>Status</span> : <?=$result_menus['tab_status'] ?></div>
                    </div><!--take_away_list_cc-->
                	 <a class="print_kot" > <div class="take_order_item_name cs_printkoteach" billno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>"><img src="img/printer.png"></div></a>
                </div>
               
              
                <?php }}else
		 {
			 echo "<span style='color: #F00E0E;'> Nothing to display </span>";
		 } ?>
               </div>
               
               <div class="take_away_bottom_inform_cc take_away_kot_bottom_inform_cc">
               		
                   
                    <div class="take_away_bottom_inform">
                    	<div style="background-color:#993" class="tka_inform_color"></div>
                        <div class="tka_inform_text"><?=$_SESSION['home_headcounter'] ?></div>
                    </div>
               </div><!--take_away_bottom_inform_cc-->
                
                
            </div><!--left_contant_container-->
        
        <div class="right_order_inform right_calc_cc take_detail_right_cc take_kot_right_order_inform">
        	<div style="min-height: 595px;" class="right_main_cc">
            	<div class="top_head">Details</div>
                <div class="take_oder_right_detail">
                	<div style="border-bottom: 1px solid rgba(255,255,255,0.1);min-height:240px;" class="take_right_inform_cc">
                        <div class="take_oder_odred_name"><span><?=$_SESSION['ordernota']?>  </span>  <span id="ta_loadtakbill"></span></div>
                        <div class="take_oder_odred_name"><span>KOT <?=$_SESSION['numta']?> </span> <span id="ta_loadtakkotl"></span></div>
                        <div class="take_kot_list_cc">
                        	<div class="take_kot_list_head">Order List <span class="takeaway_kot_odr_list_chk"><input type="checkbox" class="selectallit"> </span></div>
                            	<div class="tka_kot_order_list_oontainer " id="ta_listcontainer">
                                
                                
                             	</div>
                         </div><!--take_kot_list_cc-->
                     </div><!--take_right_inform_cc-->
                    
                     	
                        <div style="background-color: rgba(158, 158, 158, 0.9)" class="take_botom_button"><a  href="#" class="ta_assignpackedtotr" status="Processing"><?=$_SESSION['proccsta']?></a></div>
                        <div style="background-color:rgba(60, 154, 76, 0.7)" class="take_botom_button"><a  href="#" class="ta_assignpackedtotr" status="Ready"><?=$_SESSION['readyta']?></a></div>
                        <div style="background-color: rgba(245, 109, 0, 0.4);" class="take_botom_button"><a  href="#" class="ta_assignpackedtotr" status="Packed"><?=$_SESSION['packedta']?></a></div>
                </div><!--take_oder_right_detail-->
            </div><!--right_main_cc--->
        </div><!---right_order_inform-->
        
        
        
      </div><!--middle_container-->          
</div>
<!-- ************************************************* manage popup starts  ************************************************** -->
<div style="position:fixed;width:100%;left:30%;top:7%;z-index:99999;" class="mynewpopupload1"  ></div>
<!-- ************************************************* manage popup ends  ******************************************************* -->    

<div class="new_alert_cc" >
	<div class="confirm_detail_con_pop"></div> 
    
</div> 


                
<div class="md-overlay"></div><!-- the overlay element -->


<script src="js/countersale_list.js"></script>
<script src="js/counter_sale_print.js"></script>
<script src="js/takeawaykot_each.js" ></script>
<?php // include "includes/top_main_menu.php"; ?>  

</body>

</html>