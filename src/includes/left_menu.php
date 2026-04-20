<?php
$linkname	= trim(basename($_SERVER['PHP_SELF']));

if(!isset($_SESSION['pagid']) || ($linkname=="user_permission.php" ||  $linkname=="attendence_staff.php" || $linkname=="chng_password.php"))
$_SESSION['pagid']="";
$_SESSION['menuarray']=array();
$_SESSION['menumodarray']=array();
$_SESSION['menusubarray']=array();
$_SESSION['menufullarray']=array();

$sql_login  =  $database->mysqlQuery("Select tbl_modulemaster.mer_modulename, tbl_modulesubmaster.mser_subname, tbl_modulemaster.mer_modulelink, tbl_modulesubmaster.mser_submodulelink, tbl_usermodules.um_access,  tbl_usermodules.um_username From tbl_usermodules Inner Join tbl_modulesubmaster On tbl_modulesubmaster.mser_submoduleid = tbl_usermodules.um_submoduleid Inner Join tbl_modulemaster On tbl_modulemaster.mer_moduleid = tbl_usermodules.um_moduleid Where tbl_usermodules.um_username = '".$_SESSION['expodine_id']."' order by   tbl_modulemaster.mer_modulename"); 
$num_login   = $database->mysqlNumRows($sql_login);
if($num_login)
{
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	  {
		   $_SESSION['menuarray'][]=$result_login['mer_modulelink'];
		   $_SESSION['menumodarray'][]=$result_login['mer_modulename'];
		   $_SESSION['menusubarray'][]=$result_login['mser_submodulelink'];
		   if($result_login['mser_submodulelink']!="")
		   $_SESSION['menufullarray'][]=$result_login['mser_submodulelink'];
		   if($result_login['mer_modulelink']!="")
		   $_SESSION['menufullarray'][]=$result_login['mer_modulelink'];
	  }
}
?>
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" />
<link href="master_style/app.css" rel="stylesheet" type="text/css">
<!--<link href="css/app.css" rel="stylesheet" type="text/css">-->
<style>.menu-trigger{display:none;}.main_contant_container{width:100% !important;}.min-nav .main_contant_container{  width:99% !important;}
#leftNavigation li ul li a{text-align:left;border:0;}#leftNavigation li ul li a:hover{color:#ccc;}


</style>

  <aside>
    <section>
		<div class="nav">
	
	<nav class="menu">
     <ul id="leftNavigation" class="parent-menu">
			<li>
				<a title="" href="index.php"><span class="icon_side_mn"><img src="img/dashboard_mn_ico.png" /></span><span><?=$_SESSION['dashbord_lm']?></span></a>
				
			</li>
 		<?php if(in_array("Menu Masters", $_SESSION['menumodarray'])) { ?> 		
			<li  <?php if($_SESSION['pagid']==6){ ?>class="active" <?php } ?>>
                <?php if(in_array("menu", $_SESSION['menusubarray'])) { ?> 
                    <a href="menu.php" title=""><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
                <?php }else if(in_array("category_master", $_SESSION['menusubarray'])) { ?> 
               		<a href="category_master.php" title=""><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
               <?php }else if(in_array("sub_category_master", $_SESSION['menusubarray'])) { ?> 
                    <a href="sub_category_master.php" title=""><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
                <?php }else if(in_array("ingredient_master", $_SESSION['menusubarray'])) { ?>       
                      <a href="ingredient_master.php"><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
                <?php } else if(in_array("portion_master", $_SESSION['menusubarray'])) { ?>       
                      <a href="portion_master.php"><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
                <?php }else if(in_array("preference_master", $_SESSION['menusubarray'])) { ?>       
                      <a href="preference_master.php"><span class="icon_side_mn"><img src="img/mn_master_mn_ico.png" /></span><span><?=$_SESSION['menumaster_lm']?></span></a>
                <?php } ?> 
			</li>
 		<?php } ?>  
         <?php if(in_array("Master Tables", $_SESSION['menumodarray'])) { ?> 	         
			<li style="cursor:pointer" <?php if($linkname=="country_master.php" || $linkname=="state_master.php" || $linkname=="city_master.php" || $linkname=="kot_counter_master.php" || $linkname=="floor_master.php" || $linkname=="table_master.php" ||  $linkname=="department_master.php" || $linkname=="designation_master.php" || $linkname=="staff_master.php" || $linkname=="discount_master.php" || $linkname=="corporate_discount.php" || $linkname=="voucher_master.php" || $linkname=="coupon_company.php"  || $linkname=="feedback.php" || $linkname=="branch_master.php" || $linkname=="feedback_rating.php" ||  $linkname=="bank_master.php"  ||  $linkname=="cancellation.php"  ||  $linkname=="complimentary_reason.php"||  $linkname=="denomination.php" ||  $linkname=="regeneration.php" ||  $linkname=="expodine_machines.php" ||  $linkname=="report_masternew.php" ||  $linkname=="currencymaster.php" ||  $linkname=="conversionrate.php" ||  $linkname=="cardmaster.php"  ||  $linkname=="extra_tax.php" || $linkname=="online_partners.php" ) { ?>class="active" <?php } ?> >
                 <!-- $linkname=="branch_settings_new.php"     -->    
           
				<a title=""><span class="icon_side_mn"><img src="img/master_table_mn_ico.png" /></span><span><?=$_SESSION['mastertable_lm']?></span></a>
				<ul>
               
                <!-- --------------------- Geographical masters------------------->
                <?php if(in_array("country_master", $_SESSION['menusubarray'])) { ?> 
                      <li><a href="country_master.php" <?php if($_SESSION['pagid']==5) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> > COUNTRY - STATE - CITY </a></li>
                <?php } else if(in_array("state_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="state_master.php" <?php if($_SESSION['pagid']==5) { ?> style="    background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>> <?=$_SESSION['geo_lm']?> </a></li>
                <?php } else if(in_array("city_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="city_master.php" <?php if($_SESSION['pagid']==5) { ?> style="    background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> > <?=$_SESSION['geo_lm']?> </a></li>
                <?php } ?>   
                 
                  <!-- --------------------- Basic data------------------->
                  
                  
                  
                  
                <?php  if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="kot_counter_master.php" <?php if($_SESSION['pagid']==1) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['table_lm']?></a></li>
                <?php } else if(in_array("floor_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="floor_master.php" <?php if($_SESSION['pagid']==1) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['table_lm']?> </a></li>
                <?php } else if(in_array("table_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="table_master.php" <?php if($_SESSION['pagid']==1) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['table_lm']?></a></li>
                
                <?php } 
                
		else if(in_array("kot_counter_master", $_SESSION['menusubarray']) || in_array("floor_master", $_SESSION['menusubarray'])  || in_array("table_master", $_SESSION['menusubarray']) ) { ?> 
                <li><a href="branch_master.php" <?php if($_SESSION['pagid']==1) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['table_lm']?></a></li>
                <?php } 
				
		else if(in_array("bank_master5", $_SESSION['menusubarray'])) { ?> 
                <li><a href="bank_master.php" <?php if($_SESSION['pagid']==19) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['table_lm']?></a></li>
				
		<?php } ?> 
                  
                  <!-- --------------------- Staff master------------------->   
                  
                  <?php   if(in_array("staff_master", $_SESSION['menusubarray'])) { ?>       
                  <li><a  href="staff_master.php" <?php if($_SESSION['pagid']==2) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>> <?=$_SESSION['staff_lm']?>  </a></li>
                  <?php } else if(in_array("department_master", $_SESSION['menusubarray'])) { ?>           
                      <li><a href="department_master.php" <?php if($_SESSION['pagid']==2) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['staff_lm']?> </a></li>
                  <?php } else if(in_array("designation_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="designation_master.php" <?php if($_SESSION['pagid']==2) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?=$_SESSION['staff_lm']?> </a></li>
               
                  <?php } ?>  
                    
                      
                <?php if(in_array("online_partners", $_SESSION['menusubarray'])) { ?> 
                 <li><a   href="online_partners.php" <?php if($_SESSION['pagid']==65) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> >Online Partners</a></li>
                
                <?php } ?> 
                   
                 
                  <?php if(in_array("extra_tax", $_SESSION['menusubarray'])) { ?> 
                 <li><a   href="extra_tax.php" <?php if($_SESSION['pagid']==30) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?= $_SESSION['tax_lm']?></a></li>
                
                <?php } ?>
                 
                 
                 <?php if( in_array("cardmaster", $_SESSION['menusubarray']) || in_array("bank_master", $_SESSION['menusubarray'])    ) { ?> 
                
                 <li><a   href="bank_master.php" <?php if($_SESSION['pagid']==19) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?=$_SESSION['card_lm']?></a></li>
                
                <?php } ?>
                 
                   <!-- --------------------- Discount master------------------->      
                   
                <?php if(in_array("discount_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="discount_master.php" <?php if($_SESSION['pagid']==3) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?= $_SESSION['discount_lm']?>-Company-Coupon </a></li>
                <?php } else if(in_array("corporate_discount", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="corporate_discount.php" <?php if($_SESSION['pagid']==3) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Corporate </a></li>  
                <?php }else if(in_array("voucher_master", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="voucher_master.php" <?php if($_SESSION['pagid']==3) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Voucher </a></li>
                <?php } else if(in_array("coupon_company", $_SESSION['menusubarray'])) { ?>       
                      <li><a href="coupon_company.php" <?php if($_SESSION['pagid']==3) { ?> style="  background-color: rgba(245, 53, 27, 1) !important;color: #000;" <?php } ?>>Coupon </a></li>
                <?php } ?> 
                 
                <!-- --------------------- Feedback master------------------->  
                  <?php  
				 // print_r($_SESSION['menusubarray']);
				  if(in_array("Feedback", $_SESSION['menumodarray'])) { ?>       
<!--                      <li><a href="feedback.php" <?php if($_SESSION['pagid']==4) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><?= $_SESSION['feed_lm']?> - Rating</a></li>
                <?php } else if(in_array("feedback_rating", $_SESSION['menusubarray'])) { ?>       -->
<!--                      <li><a href="feedback_rating.php" <?php if($_SESSION['pagid']==4) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Feedback </a></li>
                <?php } ?>    -->
                      
                <?php if(in_array("denomination", $_SESSION['menusubarray'])) { ?> 
<!--                 <li><a   href="denomination.php" <?php if($_SESSION['pagid']==13) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?= $_SESSION['denom_lm']?></a></li>-->
                
                <?php } ?>
                 <!-- --------------------- cancellation------------------->  
              

                <?php if(in_array("cancellation", $_SESSION['menusubarray']) || in_array("complimentary_reason", $_SESSION['menusubarray'])  ||  in_array("regeneration", $_SESSION['menusubarray'])) { ?> 
                 <li><a   href="cancellation.php" <?php if($_SESSION['pagid']==11) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> > Authorization  <?=$_SESSION['reason_lm']?> <?//=//$_SESSION['cancel_lm']?></a></li>
                
                <?php } ?>   
                 
                 <?php if(in_array("complimentary_reason", $_SESSION['menusubarray'])) { ?> 
<!--                 <li><a   href="complimentary_reason.php" <?php if($_SESSION['pagid']==12) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> > <?=$_SESSION['reason_lm']?> <?=$_SESSION['comp_lm']?></a></li>
                -->
                <?php } ?>   
                 
                
                 <?php if(in_array("regeneration", $_SESSION['menusubarray'])) { ?> 
<!--                 <li><a   href="regeneration.php" <?php if($_SESSION['pagid']==14) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> > <?=$_SESSION['reason_lm']?> <?=$_SESSION['reg_lm']?></a></li>
                -->
                <?php } ?>
                 
                 
                 
                 
                  <?php if(in_array("expodine_machines", $_SESSION['menusubarray'])) { ?> 
                 <li><a   href="expodine_machines.php" <?php if($_SESSION['pagid']==15) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> >APP <?=$_SESSION['machine_lm']?></a></li>
                
                <?php } ?>
                 
                 <?php if(in_array("report_masternew", $_SESSION['menusubarray'])&&($_SESSION['designtnname']=='Super Admin')) { ?> 
<!--                 <li><a   href="report_masternew.php" <?php if($_SESSION['pagid']==16) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?=$_SESSION['report_lm']?></a></li>
                -->
                <?php } ?>
                 
                  <?php if(in_array("currencymaster", $_SESSION['menusubarray'])  || in_array("denomination", $_SESSION['menusubarray'])    ) { ?> 
                 <li><a   href="currencymaster.php" <?php if($_SESSION['pagid']==17) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?= $_SESSION['currency_lm']?> - <?= $_SESSION['denom_lm']?></a></li>
                
                <?php } ?>
                 
                 <?php if(in_array("conversionrate", $_SESSION['menusubarray'])) { ?> 
<!--                 <li style="display:none"><a href="conversionrate.php" <?php if($_SESSION['pagid']==18) { ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?> ><?=$_SESSION['currency_convo_lm']?></a></li>
                -->
                <?php } ?>
                 
                 
                 
				</ul>
			</li>
          <?php } ?>    
          
             
            <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?> 	
			<li <?php if($linkname=="branch_settings.php" ){ ?>class="active" <?php } ?>>
				<a href="branch_settings.php?from=direct" title=""><span class="icon_side_mn"><img src="img/general_set_mn_ico.png" /></span><span><?=$_SESSION['general_settings_lm']?></span></a>
			</li>
            <?php } ?> 
            
            	 <?php if(in_array('printer_master', $_SESSION['menufullarray'])) { ?>
			<li <?php if($linkname=="printer_master.php" || $linkname=="printer_type_master.php" ){ ?>class="active" <?php } ?>>
				<a href="printer_master.php" title=""><span class="icon_side_mn"><img src="img/printer_master_mn_ico.png" /></span><span><?=$_SESSION['printer_master_lm']?></span></a>
			</li>
            
             <?php } ?> 
            
        
       <?php if(in_array("voucher_head1", $_SESSION['menusubarray'])) { ?> 
                        <li <?php if($linkname=="voucher_head.php" ){ ?>class="active" <?php } ?>>
      <a href="voucher_head.php" title=""><span class="icon_side_mn"><img src="img/printer_master_mn_ico.png" /></span><span>Voucher Head</span></a>
          </li>            
              
       <?php } if(in_array("voucher_payment55", $_SESSION['menusubarray'])) { ?>       
               
             <li <?php if($linkname=="voucher_payment.php" ){ ?>class="active" <?php } ?>>
      <a href="voucher_payment.php" title=""><span class="icon_side_mn"><img src="img/clc-btn.png" /></span><span><?=$_SESSION['payment_pending_voucher']?></span></a>
          </li>      
          <?php } ?>
          
                 
                      
       
           <li <?php if($linkname=="faq/" ){ ?>class="active" <?php } ?>>
      <a href="faq/" title=""><span class="icon_side_mn"><img src="img/voucher_ico.png" /></span><span><?=$_SESSION['faq_ar_eng']?></span></a>
          </li>  
          
          
        
        
        
        <?php
      
  $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc++; } }
      
  
   $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='CR'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_cr=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_cr++; } }
  
  
   $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='BQ' "); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_bq=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_bq++; } }
  
   $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='DI'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_di=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_di++; } }
  
        $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='DI'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_di=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_di++; } }
  
  $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='TA'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_ta=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_ta++; } }
  
  $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='HD'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_hd=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_hd++; } }
  
  
  $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='CS'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_cs=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_cs++; } }
  
  $sql_login  =  $database->mysqlQuery("Select * from tbl_reportmaster where rm_reporttype='OL'"); 
  $num_login   = $database->mysqlNumRows($sql_login);
  if($num_login) 
  { $rpc_ol=0;
   while($result_login  = $database->mysqlFetchArray($sql_login)) 
  { $rpc_ol++; } }
  
        ?>
                
            
        <!-- --------------------- Reports section------------------->
         <?php if(in_array("Reports", $_SESSION['menumodarray']) || in_array("Analytics Report", $_SESSION['menumodarray']) || in_array("Take Away Reports", $_SESSION['menumodarray'])||in_array("Consolidated Reports", $_SESSION['menumodarray'])|| in_array("Banquet Reports", $_SESSION['menumodarray']) || in_array("Dayclose Settings", $_SESSION['menumodarray']) || in_array("online_order_report", $_SESSION['menumodarray']) ) { ?> 	         
           <li style="cursor:pointer" <?php if($_SESSION['pagid']==7) { ?>class="active" <?php } ?> >
                            <a title=""><span class="icon_side_mn"><img src="img/report_mn_ico.png" /></span><span><?=$_SESSION['reports_lm']?> <strong style="display: none;border: 1px solid;border-radius: 2px;font-size: 11px;padding: 3px;position: absolute;right: 6px;font-weight: bold "><?=($rpc+1)?></strong>  </span></a>
		  <ul>
                                    
		  <?php if(in_array("dinein", $_SESSION['menuarray'])) { ?> 
                   <li><a href="report.php" <?php if($linkname=="report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Dine In <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 2px;position: absolute;right: 4px;font-size: 11px; "><?=$rpc_di?></strong></a></li>	 
                  <?php } ?> 
                   
                  <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?> 
                   <li><a href="counter_sale_report.php" <?php if($linkname=="counter_sale_report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Counter Sales <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; "><?=$rpc_cs?></strong></a></li>	 	 
                  <?php } ?>
                  
                    <?php if(in_array("Take Away Report", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="ta_report.php" <?php if($linkname=="ta_report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Take Away <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; "><?=$rpc_ta?></strong></a></li>	 	 
                  <?php } ?> 
                   <?php if(in_array("Home Delivery Report", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="hd_report.php" <?php if($linkname=="hd_report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Home Delivery <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; "><?=$rpc_hd?></strong></a></li>	 	 
                  <?php } ?> 
                   
                   <?php if(in_array("Consolidated Reports", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="consolidatedreport.php" <?php if($linkname=="consolidatedreport.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Consolidated <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;font-size: 11px;padding: 2px;position: absolute;right: 4px; "><?=$rpc_cr?></strong></a></li>	 	 
                  <?php } ?>
                  <?php if(in_array("Banquet Report", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="banquet_report.php" <?php if($linkname=="banquet_report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Banquet <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; "><?=$rpc_bq?></strong></a></li>	 	 
                
                     <?php } ?>
                   
                 
                   
                    <?php if(in_array("Analytics Report", $_SESSION['menumodarray'])) { ?> 
                    <li><a href="online_order_report.php" <?php if($linkname=="online_order_report.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>ONLINE ORDER <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; "><?=$rpc_ol?></strong></a></li>	 	    
                    <?php } ?>
                    
                   <?php if(in_array("Online Integration", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="analytics.php" <?php if($linkname=="analytics.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Analytics <?=$_SESSION['reports_lm']?> <strong style="border: 1px solid;border-radius: 2px;padding: 4px;position: absolute;right: 4px; ">1</strong></a></li>	 	 
                  <?php } ?>
                    
                   <?php if(in_array("Dayclose Settings", $_SESSION['menumodarray'])) { ?> 
                   <li><a href="dayclose_report_settings.php" <?php if($linkname=="dayclose_report_settings.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Report settings <strong style="border: 1px solid;border-radius: 2px;padding-right: 3px;padding-left: 3px;;position: absolute;right: 4px; ">Total : <?=($rpc+1)?></strong></a></li>	 	 
                  <?php } ?>
                    
                
            </ul>
            <?php } ?>
                                
       
           <?php if(in_array("User Permission", $_SESSION['menumodarray'])) { ?> 	
			<li <?php if($linkname=="user_permission.php" ){ ?>class="active" <?php } ?>>
				<a href="user_permission.php" title=""><span class="icon_side_mn"><img src="img/user_per_mn_ico.png" /></span><span><?=$_SESSION['user_per_lm']?></span></a>
			</li>
            <?php } ?> 
                        
               <?php  if(in_array("Vouchers5", $_SESSION['menumodarray']) ) { ?>
                        <li id="vouch_div_left" <?php if($_SESSION['pagid']==10) { ?>class="active" <?php } ?> >   
            
<!--            <li <?php if($linkname=="voucher_head.php" ){ ?>class="active" <?php } ?>>-->
				<a href="#" title=""><span class="icon_side_mn"><img src="img/voucher_ico.png" /></span><span><?=$_SESSION['voucher_lm']?></span></a>
                <ul>
                <?php if(in_array("voucher_payment", $_SESSION['menusubarray'])){ ?>
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> voucher_payment.php <?php }else {  ?> index.php?msg=1; <?php } ?>" <?php if($linkname=="voucher_payment.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>> Voucher Entry</a></li>
                        <?php } ?>
                        <?php if(in_array("voucher_head", $_SESSION['menusubarray'])){ ?>
                    <li><a href="voucher_head.php" <?php if($linkname=="voucher_head.php" ) { ?> style=" background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>>Voucher Head</a></li>
                    <?php } ?>
                   
                    
                    
                </ul>
                
			</li>
            <?php }else{ ?>
                        
             <?php  if(in_array("Ledger", $_SESSION['menumodarray']) ) { ?>              
                        
                        <li style="display:none">
                        <a href="accounts/ledger.php" title=""><span class="icon_side_mn"><img src="img/voucher_ico.png" /></span><span><?=$_SESSION['ledger']?></span></a>
           </li>
            <?php } ?>
           
               <?php } ?>
          
           <?php if(in_array("SendEmail", $_SESSION['menumodarray'])) { ?> 		
            <li <?php if($linkname=="email_report.php" ){ ?>class="active" <?php } ?>>
				<a href="email_report.php" title=""><span class="icon_side_mn"><img src="img/email_report_mn_ico.png" /></span> <span>Email Reports</span></a>
			</li>
             <?php } ?>
             
             
             

           
			<?php if(in_array("Change Password", $_SESSION['menumodarray'])) { ?> 		
            <li <?php if($linkname=="chng_password.php" ){ ?>class="active" <?php } ?>>
				<a href="chng_password.php" title=""><span class="icon_side_mn"><img src="img/change_pass_mn_ico.png" /></span> <span>Change Password </span></a>
			</li>
             <?php } ?> 
             

            

			
			
                        <?php if(in_array("Day Close Details", $_SESSION['menumodarray'])) { ?> 		
            <li <?php if($linkname=="dayclosedetails.php" && $_SESSION['pagid']==20 ){ ?> class="active" <?php } ?>>
				<a href="dayclosedetails.php" title=""><span class="icon_side_mn"><img src="img/btn_arrow_ico.png" /></span> <span><?=$_SESSION['dayclose_lm']?></span></a>
			</li>
             <?php } ?> 
               <?php if(in_array("Shift Details", $_SESSION['menumodarray'])) { ?> 		
            <li <?php if($linkname=="shiftdetails.php" && $_SESSION['pagid']==28 ){ ?> class="active" <?php } ?>>
                <a href="shiftdetails.php" title=""><span class="icon_side_mn"><img src="img/steward_ico.png" /></span> <span> &nbsp;  <?=$_SESSION['shift_lm']?> </span></a>
			</li>
             <?php } ?> 
                        
                <?php if(in_array("Stock Master", $_SESSION['menumodarray'])) { ?> 		
            <li  <?php if($linkname=="stock_master.php" && $_SESSION['pagid']==21 ){ ?>class="active" <?php } ?>>
				<a href="stock_master.php" title=""><span class="icon_side_mn"><img src="img/star-off.png" /></span> <span><?=$_SESSION['stock_lm']?></span></a>
			</li>
             <?php } ?>          
             
                      
                 
             <?php if(in_array("Banquet", $_SESSION['menumodarray'])) { ?> 
            <li <?php if($linkname=="banquet_list.php" || $linkname=="banquet_registration.php" || $linkname=="function_master.php" ||  $linkname=="venue_master.php" ||$linkname=="function_extracost_master.php" ||$linkname=="reminders.php" ){ ?>class="active" <?php } ?> >
				<a href="#" class="bottom_menu_clk" title=""><span class="icon_side_mn"><img src="img/banquet-icon.png" /></span><span><?=$_SESSION['banquet_lm']?></span></a>
                
                                
                            
                                <ul>
                     <?php if(in_array("banquet_registration", $_SESSION['menusubarray'])) { ?> 
                	<li <?php if($linkname=="banquet_registration.php" && $_SESSION['pagid']==22 ){ ?> style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><a href=" <?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> banquet_registration.php  <?php }else {  ?> index.php?msg=1' <?php } ?> ">Registration</a></li>
                         <?php } ?>    
                        <?php if(in_array("banquet_list", $_SESSION['menusubarray'])) { ?> 
                    <li <?php if($linkname=="banquet_list.php" && $_SESSION['pagid']==23 ){ ?>style="background-color: rgba(169, 169, 169, 1) !important;color: #000;"<?php } ?>><a href="banquet_list.php">List</a></li>
                    <?php } ?>  
                     <?php if(in_array("function_master", $_SESSION['menusubarray'])) { ?> 
                    <li <?php if($linkname=="function_master.php" && $_SESSION['pagid']==24 ){ ?>style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><a href="function_master.php">Function Master</a></li>
                         <?php } ?>  
                     <?php if(in_array("venue_master", $_SESSION['menusubarray'])) { ?> 
                    <li <?php if($linkname=="venue_master.php" && $_SESSION['pagid']==25 ){ ?>style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><a href="venue_master.php">Venue Master</a></li>
                     <?php } ?>  
                    <?php if(in_array("function_extracost_master", $_SESSION['menusubarray'])) { ?> 
                    <li <?php if($linkname=="function_extracost_master.php" && $_SESSION['pagid']==26 ){ ?>style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><a href="function_extracost_master.php">Extra Cost Master</a></li>
                      <?php } ?>  
                    
                    <?php if(in_array("reminders", $_SESSION['menusubarray'])) { ?> 
                    <li <?php if($linkname=="reminders.php" && $_SESSION['pagid']==27 ){ ?>style="background-color: rgba(169, 169, 169, 1) !important;color: #000;" <?php } ?>><a href="reminders.php">Reminders</a></li>
                      <?php } ?> 
                    
                    
                    
                </ul>
                                 
			</li>
             <?php } ?> 
                        
                        
                        
                        
                        <?php if(in_array("Multi Language", $_SESSION['menumodarray'])) { ?>  
                 <li <?php if($linkname=="multi_language.php" ){ ?>class="active" <?php } ?>>
				<a href="multi_language.php" title=""><span class="icon_side_mn"><img src="img/lang_mn_ico.png" /></span><span><?=$_SESSION['multi_lm']?></span></a>
			</li>        
                        <?php } ?>   
                        
                        
                        
               <?php if(in_array("Database Backup", $_SESSION['menumodarray'])) { ?> 	
            <li <?php if($linkname=="database_backup.php" ){ ?>class="active" <?php } ?>>
				<a href="database_backup.php" title=""><span class="icon_side_mn"><img src="img/back_iconday.png" /></span><span> &nbsp;<?=$_SESSION['db_back_lm']?> </span></a>
			</li>
              <?php } ?> 
                        
                <?php if(in_array("Menu Upload", $_SESSION['menumodarray'])) { ?> 	
            <li <?php if($linkname=="menu_uploads.php" ){ ?>class="active" <?php } ?>>
				<a href="menu_uploads.php" title=""><span class="icon_side_mn"><img src="img/update.png" /></span><span><?=$_SESSION['menu_lm']?> </span></a>
			</li>
              <?php } ?>        
                        
                        
                        
                  <li style="display:none" <?php if($linkname=="troubleshoot.php" ){ ?> class="active" <?php } ?>>
				<a href="troubleshoot.php" title="">&nbsp<span class="icon_side_mn"><img src="img/floors_icon.png" /></span><span><?=$_SESSION['trouble_lm']?></span></a>
		  </li>
            
                  <li <?php if($linkname=="firebase_setting.php" ){ ?> class="active" <?php } ?>>
				<a href="firebase_setting.php" title="">&nbsp<span class="icon_side_mn"><img src="img/sms_mn_ico.png" /></span><span><?=$_SESSION['notification_lm']?></span></a>
		 </li>
                        
          
            
		</ul>


	</nav>
</div>
</section>

	</aside>
    
<!--<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>-->

<!--<script src="master_style/menu/js/app.js"></script> -->
<!--<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>-->
<script src="master_style/js/menu/app.js"></script>   


<script type="text/javascript">
	jQuery(document).ready(function(){
		//**** Bootstrap Tooltip ****//	
		$("body").tooltip({ selector: '[data-toggle=tooltip]' });
		
		//**** Slide Panel Toggle ***//
		$(".slide-panel-btn").click( function(){
		$(".slide-panel-btn").toggleClass('active');
		$(".slide-panel").toggleClass('active');
		});
		
		$(".content-sec").click( function(){
		$(".slide-panel").removeClass('active');
		});
		
		//**** Slide Panel Toggle ***//
		/*$(".toggle-menu").click( function(){
		$("body").toggleClass('min-nav');
		});*/
		
		//**** User Comments ****//
		/*$('#panel-scroll').enscroll({
		showOnHover: true,
		verticalTrackClass: 'track3',
		easingDuration:100,
		verticalHandleClass: 'handle3'
		});	*/
		
		/* Copyright (c) 2013 ; Licensed  */
		
		
	});


	
</script>	
 
