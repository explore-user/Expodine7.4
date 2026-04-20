<?php

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
#leftNavigation #new_tab_btn ul li a.active_btn_3{    background-color: #465738 !important;color:#fff}


</style>

  <aside>
    <section>
		<div class="nav">
	
	<nav class="menu">
     <ul id="leftNavigation" class="parent-menu">
			<li>
				<a title="HOME" href="index.php"><span class="icon_side_mn"><img src="img/dashboard_mn_ico.png" /></span><span><?=$_SESSION['dashbord_lm']?></span></a>
				
			</li>
 		
                        <li ><a title="Accounts Head" href="ledger.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> ACCOUNTS HEAD</span></a></li>
                       
                        <?php  if(in_array("accounts_name", $_SESSION['menusubarray'])) { ?>    		
                        <li ><a title="Accounts Name" href="accounts_name.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span>  ACCOUNTS NAME </span> </a></li>
                        <?php } ?> 		
                        
                        
                          <?php  if(in_array("open_close_account", $_SESSION['menusubarray'])) { ?>  
                        <li ><a style="" title="Balance" href="open_close_account.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> OPEN - CLOSE BALANCE    </span></a></li>
                       <?php } ?> 	
                        
                        
                          <?php  if(in_array("stock_accounts", $_SESSION['menusubarray'])) { ?>  
                        <li ><a style="" title="Stock" href="stock_accounts.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> STOCK VALUE  </span></a></li>
                         <?php } ?> 	
                        
                         <?php  if(in_array("journals", $_SESSION['menusubarray'])) { ?>  
                        <li ><a title="Ledger" href="journals.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> LEDGER </span></a></li>
                         <?php } ?> 	
                        
                         <?php  if(in_array("Credit Master", $_SESSION['menumodarray'])) { ?>  
                        <li ><a title="Sundry Debtors" href="credit.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span>SUNDRY DEBTORS </span></a></li>
                        <?php } ?> 
                        
                        <?php  if(in_array("supplier", $_SESSION['menusubarray'])){ ?>  
                        <li ><a title="Supplier Master" href="supplier.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> SUPPLIER MASTER </span></a></li>
                         <?php } ?> 
                        
                         <?php  if(in_array("employees", $_SESSION['menusubarray'])) { ?>  
                        <li ><a title="Employee Master" href="employees.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span>  EMPLOYEE MASTER </span></a></li>
                         <?php } ?> 
                        
                         <?php  if(in_array("expense_voucher", $_SESSION['menusubarray'])) { ?>  
                        <li><a title="Expense Voucher" href="expense_voucher.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> EXPENSE VOUCHER </span></a></li>
                        <?php } ?> 
                        
                        <?php  if(in_array("contra_voucher", $_SESSION['menusubarray'])) { ?>  
                        <li ><a title="Contra Voucher" href="contra_voucher.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span>  CONTRA VOUCHER </span></a></li>
                        <?php } ?> 
                        
                         <?php  if(in_array("asset_master", $_SESSION['menusubarray'])) { ?>  
                        <li onclick="assset_click();" id="new_tab_btn"><a title="Fixed Asset" href="asset_master.php" ><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> FIXED ASSET   <span style="float:right;margin-top:6px" class="caret" ></span> </span></a>
                            <ul id="open_div">
												<li><a href="asset_master.php">Asset Category & Master</a></li>
												<li><a href="asset_purchase_voucher.php">Asset Purchase & Voucher</a></li>
												<li><a href="asset_invoice.php">Asset Invoice</a></li>
												<li><a href="asset_stock.php">Asset Stock</a></li>
											</ul>
					</li>
                               <?php } ?>          
                                        
                                       
                                   <?php  if(in_array("receipts", $_SESSION['menusubarray'])) { ?>  
                                         <li ><a style="" title="Receipts" href="receipts.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> Receipts </span></a></li>
                                       <?php } ?>   
                                         
                                          <?php  if(in_array("load_ledger_sheet", $_SESSION['menusubarray'])) { ?>  
                                         <li ><a title="Balancesheet & Profit-Loss" href="load_ledger_sheet.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span>  BAL SHEET -  PROFIT & LOSS  </span></a></li>
                                       <?php } ?> 
                                         
                                         
                                         <li ><a style="pointer-events: none ;display: none" title="Loan" href="loans.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> LOAN & ADVANCE </span></a></li>
                                       
                                         
                                         <li ><a style="pointer-events: none; display: none" title="Receipts" href="receipts.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> RECEIPTS  </span></a></li>
                                        
                                         
                                          <?php  if(in_array("loan_advance", $_SESSION['menusubarray'])) { ?>  
                                         <li ><a style="" title="Loans & Advance" href="loan_advance.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> LOANS  & ADVANCE  </span></a></li>
                                         <?php } ?> 
                                         
                                         
                                          <?php  if(in_array("daybook", $_SESSION['menusubarray'])) { ?>  
                                         <li ><a style="" title="Day Book" href="daybook.php" id="new_tab_btn"><span class="icon_side_mn"> <img src="img/report_mn_ico.png" /></span><span> DAY BOOK  </span></a></li>
                                          <?php } ?> 
                                         
									  
		</ul>


	</nav>
</div>
</section>

	</aside>
 
<script src="master_style/js/menu/app.js"></script>   

<script>
for (var i = 0; i < document.links.length; i++) {
if (document.links[i].href == document.URL) {
document.links[i].className = 'active_btn_3';
}
}


 
</script>
<script type="text/javascript">
// 	jQuery(document).ready(function(){
            
//   setTimeout(function()
//   {                               
//    $.ajax({
// 			type: "POST",
// 			url: "load_ledger.php",
// 			data: "set=open_ledger_daywise",
// 			success: function(msg1)
// 			{
                           
//  $.ajax({
// 			type: "POST",
// 			url: "load_ledger.php",
// 			data: "set=close_ledger_daywise",
// 			success: function(msg)
// 			{
                         
//       }
//       });    
//   }
//     });
//     }, 5000);    
            
            
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
		
		
	//});


function assset_click(){
            
if ($('#open_div').css('display') == 'block') {
    $('#open_div').hide();
}else{
   $('#open_div').show();
}
           //  $('#open_div').hide();
          }
</script>	
 
