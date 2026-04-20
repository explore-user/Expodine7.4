<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') {
	
}else
{
	//header("location:index.php?msg=2");
	header("location:packingcounter.php");
}
if(!isset($_SESSION['kotcounterselected']))
{
	
	/*$sql_login  =  $database->mysqlQuery("select * from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LIMIT 0,1"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  {
			  $_SESSION['kotcounterselected']=$result_login['kr_kotcode'];
			  $_SESSION['kotcounterselected_name']=$result_login['kr_kotname'];
		  }
	}*/
}
/*$_SESSION['kotcounterselected']="HAM-CT-1";
	$_SESSION['kotcounterselected_name']="MAIN KITCHEN";
*/
$sql_menu_image="select be_kod_image from tbl_branchmaster";
            $sql_menuimage  =  $database->mysqlQuery($sql_menu_image); 
		$num_menuimage  = $database->mysqlNumRows($sql_menuimage);
		if($num_menuimage){
                    $result_menuimage  = $database->mysqlFetchArray($sql_menuimage); 
                   $imagepermission=$result_menuimage['be_kod_image'];
                    
                }


$counters=array();
if(isset($_SESSION['kotcounterselected']))
{
	if($_SESSION['kotcounterselected']=="ALL")
	{
		array_push($counters, $_SESSION['kotcounterselected']);
	}else
	{
		
	 $counters=explode(",",$_SESSION['kotcounterselected']);
	}
	
}else
{
	$_SESSION['kotcounterselected']="ALL";
	$_SESSION['kotcounterselected_name']="ALL";
	array_push($counters, $_SESSION['kotcounterselected']);
}
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Packing Counter</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/kod_screen_1.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/packing_counter.js"></script> 
<!-- <script>
$(document).ready(function() {
   var pageHeight = $("body").height();
   pageHeight -=100; // Whatever the height of your footer is. Make sure to subtract that out
   $(".left_bill_history_contain").css("min-height", pageHeight + "px");
});
</script>-->
<script>
$(document).ready(function(){
/***************************************  autorefresh starts ******************************************************************  */
	 setInterval(function() { 
	 var seltd=$('#countrseltd').val();
 $('.load_colum_dinein').load('load_kod_screen.php?value=loadkodscreen&set=dine&counter='+seltd+'&pagename=packing');
 $('.load_colum_takeaway').load('load_kod_screen.php?value=loadkodscreen&set=ta&counter='+seltd+'&pagename=packing');
	}, 3000); 
}); 
</script>
</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
<input type="hidden" name="screentype" id="screentype" value="screen_multi" >
     <?php /*?><?php include"includes/topbar.php"; ?><?php */?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
      	<a style="text-decoration:none;" href="index.php"><div class="sitemap_logo_cc"><img src="img/logo20.png"></div></a>
		  <?php include"includes/new_right_menu.php"; ?> 
          <?php include "includes/page_shortcuts.php"; ?>
           <div class="bill_history_head">Packing Counter</div>
           <div class="kod_list_information">
           		<div class="kod_information_contain">
                	<div class="information_ico"><img src="img/process-ico-1.png"></div>
                    <div class="information_text">Processing</div>
                </div><!--kod_information_contain-->
                <!--<div class="kod_information_contain">
                	<div class="information_ico"><img src="img/pending-icon-1.png"></div>
                    <div class="information_text">Pending</div>
                </div>--><!--kod_information_contain-->
                <div class="kod_information_contain">
                	<div class="information_ico"><img src="img/served-icon.png"></div>
                    <div class="information_text">Ready</div>
                </div><!--kod_information_contain-->
           </div>
      </div>
                      
      		<div style="width:100%" class="left_contant_container">
            
            <div class="top_counter_sel_contain">
            	<div class="kod_split_head take_away_txt_clr">
                	<div class="kod_top_counter_head_txt">Take Away
                    	<!--<span class="kod_sub_counter_list">( <?$_SESSION['kotcounterselected_name']?> )</span>-->
                    </div>
                    
                </div>
                <div class="counter_select_contain" style="width:78%;">
                	<div class="multi_selector_kod">
                        <div style="width:100%;" class="kod_multi_selectbox">
                        	
                             <div class="table_floor_select_btn table_floor_select_btn_act" title="ALL"><a href="#" >ALL</a></div>
                            
                            <?php   $sql_login  =  $database->mysqlQuery("select * from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid "); 
											  $num_login   = $database->mysqlNumRows($sql_login);
											  if($num_login){
												  while($result_login  = $database->mysqlFetchArray($sql_login)) 
													{ ?>
                            
                            
                           <div class="table_floor_select_btn " title="<?=$result_login['kr_kotcode']?>"><a href="#" ><?=$result_login['kr_kotname']?></a></div>
                           
                            <?php  } } ?>
                          
                        </div>
                        <!--<div class="kod_multisel_name"><a href="#" class="selectcounterseach">OK</a></div>-->
                    </div>
                </div><!--select-->
                
                <div style="float:right" class="kod_split_head take_away_txt_clr dine_in_txt_clr" >
                	<div style="float:right;" class="kod_top_counter_head_txt">Dine In</div>
                </div>
                
            </div><!--top_counter_sel_contain-->
            	
            <div class="left_bill_history_contain">
                	
		<div class="load_colum_takeaway" id="columns">
            <input type="hidden" name="countrseltd" id="countrseltd" value="<?=$_SESSION['kotcounterselected']?>">
                      <?php
			foreach( $counters as $number => $value)
 			{
			 $sql_menulist='';
			 if($value=="ALL")
			 {
				 $sql_menulist= "Select distinct(bm.tab_kotno) as kotno,bm.tab_billno as blno,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And (  bd.tab_status='Ready')    order by bm.tab_time DESC ";
			 }else
			 {
			 $sql_menulist= "Select distinct(bm.tab_kotno) as kotno,bm.tab_billno as blno,bm.tab_time as biltime,mn.mr_time_min as menutime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And (  bd.tab_status='Ready') AND km.kr_kotcode='".$value."'   order by bm.tab_time DESC ";
			 }
			
			 	$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){ $dishtime="";
                                                $current_time="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// take_active
                                                        $menutime[]=$result_menus['menutime'];
                                                        $max_time=max($menutime);
                                                    $dishtime = date('Y-m-d h:i a',strtotime("+".$max_time." minutes", strtotime($result_menus['biltime'])));
                                                    $current_time=date('Y-m-d h:i a');
                                            ?>
                <div class="pin" <?php if($dishtime<$current_time){ ?> style="background-color:#ff8181"<?php }else{  }?>>
                  <div class="kod_detail_number" >
                      <div class="kod_number_box"><?=$result_menus['kotno']?></div>
<!--                      <div class="kod_number_box"><?=$result_menus['blno']?></div>-->
                      <div class="time_kod_cc"><?=date("h:i a",strtotime($result_menus['biltime'])) ?></div>
                   </div>
                   
                   <?php
				   $sql_menulist1='';
				 
				   $sql_menulist1= "Select tb.tab_qty as qty,mi.mes_imagethumb as image,tb.tab_preferencetext as pref,tb.tab_slno,mn.mr_menuname as menuname,po.pm_portionshortcode as portion,tb.tab_status  as status  From tbl_menumaster as mn Inner Join tbl_takeaway_billdetails as tb On tb.tab_menuid = mn.mr_menuid Inner Join tbl_portionmaster as po On po.pm_id =tb.tab_portion LEFT JOIN tbl_menuimages mi on mi.mes_menuid=mn.mr_menuid Where tb.tab_billno = '".$result_menus['blno']."'  AND   mn.mr_kotcounter= '".$result_menus['kotcod']."'  AND (  tb.tab_status='Ready' )  order by tab_slno DESC ";//
			
	$sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	$num_menus1  = $database->mysqlNumRows($sql_menus1);
	if($num_menus1){$i=1;$pref='';
		while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			{
				
					 /* if($result_menus1['pref']!="")
					  {
						  $pref="(".$result_menus1['pref'].")";
					  }else
					  {
						  $pref="";
					  }*/
			   
					
					?>
                    <div class="kod_list_item">
                        <?php if($imagepermission=='Y'){ ?>
                        <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php }else { }?>
                     <h1><span><?=$result_menus1['qty']?></span> <span>(<?=$result_menus1['portion']?>)</span> * <span><?=$result_menus1['menuname']?></span>
                     	<div class="kod_order_status">
                       
						<?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='KOT_Generated'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Processing'){ ?><img src="img/process-ico.png"> <?php } ?>
                        
                        </div>
                     </h1>
                     <!-- <p><?$pref?></p>-->
                    </div>
                    
                    <?php } } ?>
                   
                   
                   <!--<div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/pending-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/served-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/process-ico.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>-->
                    
                </div>
                <?php } }  ?>
  
                
                <?php } ?>
                
              
                 
                
        
        
	</div>


                </div><!--left_bill_history_contain-->
                
                
                
                
                 <div class="left_bill_history_contain">
                	
                    <div class="load_colum_dinein" id="columns">
                    		
            <?php
			foreach( $counters as $number => $value)
 			{
			 $sql_menulist='';
			 if($value=="ALL")
			 {
				 $sql_menulist="select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Ready' and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0'  group by tos.ter_kotno order by tos.ter_kotno DESC";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
			 }else
			 {
				  $sql_menulist="select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Ready' and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0'  AND km.kr_kotcode='".$value."'  group by tos.ter_kotno order by tos.ter_kotno DESC";
			 }
				
			
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){  $dishtime="";
                                                 $current_time="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// take_active
                                                    $staff=$result_menus['staff'];
                                                       if(strlen($staff)>12){
                                                           $staff=substr($staff,0,9);
                                                           }
                                            
                                            ?>
                <div class="pin"  <?php if($dishtime<$current_time){ ?> style="background-color:#ff8181"<?php }else{  }?>>
                  <div class="kod_detail_number">
                      <div class="kod_number_box"><?=$result_menus['kotno']?></div>
                      <div class="kod_table_number_steward"><span>Table: <?=$result_menus['tbl']?>(<?=$result_menus['prefix']?>)</span> | <span>Steward: <?=$staff?></span></div>
                      <div class="time_kod_cc"><?=date("h:i a",strtotime($result_menus['biltime'])) ?></div>
                   </div>
                   
                   <?php
				   $sql_menulist1='';
				 
				  $sql_menulist1="select mi.mes_imagethumb as image,tor.ter_qty as qty,tor.ter_preference as per1,tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tpr.pm_portionshortcode as portion,tor.ter_status as status from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tmr.mr_menuid   where  tor.ter_kotno='".$result_menus['kotno']."' and tor.ter_dayclosedate='".$_SESSION['date']."'  AND   tmr.mr_kotcounter= '".$result_menus['kotcod']."' order by ter_slno DESC ";
			 
	$sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	$num_menus1  = $database->mysqlNumRows($sql_menus1);
	if($num_menus1){$i=1;$pref='';
		while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			{
				
				 /*if($result_menus1['per1'])
							{
								$pf=$database->show_prefernce_ful_details($result_menus1['per1']);
								$pref=$pf['pmr_name'];
							}else
							{
								$pref="";
							}
							if($result_menus1['per2'])
							{
								if($pref!="")
								{
									$pref=$pref ." , " .$result_menus1['per2'];
								}else
								{
									$pref=$result_menus1['per2'];
								}
							}else
							{
								
							}*/
				
			
				
				
					
					?>
                    <div class="kod_list_item">
                        <?php if($imagepermission=='Y'){ ?>
                        <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php }else { }?>
                     <h1><span><?=$result_menus1['qty']?></span> <span>(<?=$result_menus1['portion']?>)</span> * <span><?=$result_menus1['menuname']?></span>
                     	<div class="kod_order_status">
                        
                        <?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Added'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Opened'){ ?><img src="img/process-ico.png"> <?php } ?>
                       
                        </div>
                         <p><?=$pref?></p>
                     </h1>
                     <!-- -->
                    </div>
                    
                    <?php } } ?>
                   
                   
                   <!--<div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/pending-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/served-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/process-ico.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>-->
                    
                </div>
                <?php } }  } ?>
                    </div> <!--load_colum-->       
                
             </div><!--left_bill_history_contain-->    
                
            
           
            </div><!--left_contant_container-->
          
      </div><!--middle_container-->          
</div><!--container_fluide-->



 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
<script>
$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});
</script>

    


</body>

</html>