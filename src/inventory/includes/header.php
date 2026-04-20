

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="../index.php" class="logo"><img  style="width:150px" src="../img/logo20.png"></a>
                        <!-- Image Logo here -->
                        <!--<a href="index.html" class="logo">-->
                            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                        <!--</a>-->
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                          
                            
                            <span style="display:none;" class="home_ico"><a title="Home" href="index.php"><i class="fa fa-home"></i></a></span>
          
                            <ul class="nav navbar-nav navbar-right pull-right">
                                
                                
                                

                            </ul>
                        </div>
                       
                    </div>
                </div>
            </div>
            
            
            <?php
                     
                        if(!isset($_SESSION['expodine_id']))
                       { 
  
	                   //  header('location:/../login.php?msg=ses');
                            
                             echo "<script type='text/javascript'>alert('SESSION OUT');  window.location.href='../index.php'; </script>";
	
       
                       }
                        
                        $linkname	= basename($_SERVER['PHP_SELF']); 
                        
                        ?>
           

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                            
                             
                            <li class="has_sub">
                                <a href="index.php" class="waves-effect"><i class="fa fa-home"></i> <span style="font-size: 12px;"> DASHBOARD </span> <!--<span class="menu-arrow"></span>--></a>
<!--                                <ul class="list-unstyled">
                                    <li><a href="listing.php">Listing</a></li>
                                </ul>-->
                            </li>
                            
                            
                            <?php  if( $_SESSION['ser_store_stock']=='Y'){ ?> 
                            
                             <li class="has_sub">
                                <a href="store_stock.php" class="waves-effect"><i class="fa fa-tachometer"></i> <span style="font-size: 12px;"> STORE STOCK </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                            <?php } ?>  
                            
                            
                            <?php if($linkname !='purchase_order.php' && $_SESSION['ser_req']=='Y'){ ?> 
                            
                           <li class="has_sub">
                                <a href="requistion.php" class="waves-effect"><i class="fa fa-cart-arrow-down"></i> <span style="font-size: 12px;"> REQ &nbsp;&nbsp; - &nbsp;&nbsp; PO </span> <!--<span class="menu-arrow"></span>--></a>

                            </li>
                            
                            
                        <?php }else if( ($linkname=='purchase_order.php' && $_SESSION['ser_po']=='Y') || ($linkname !='purchase_order.php' && $_SESSION['ser_req']=='N' && $_SESSION['ser_po']=='Y')){ ?>
                            
                             
                             <li class="has_sub">
                                 
                                <a href="purchase_order.php" class="waves-effect"><i class="fa fa-cart-arrow-down"></i> <span style="font-size: 12px;"> REQ &nbsp;&nbsp; - &nbsp;&nbsp; PO </span> <!--<span class="menu-arrow"></span>--></a>

                            </li>
                             <?php } ?>  
                            
                            
                            
                             <?php  if( $_SESSION['ser_stock_entry']=='Y'){ ?>
                              <li class="has_sub">
                                <a href="stock_entry.php" class="waves-effect"><i class="fa fa-archive"></i> <span style="font-size: 12px;"> STOCK PURCHASE  </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                              </li>
                              <?php } ?>   
                            
                            <?php  if( $_SESSION['ser_rps']=='Y'){ ?>
                             <li class="has_sub">
                                <a href="history.php" class="waves-effect"><i class="fa fa-history"></i> <span style="font-size: 12px;"> R-P-S  HISTORY</span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <?php } ?>   
                            
                             <?php  if( $_SESSION['ser_store_transfer']=='Y'){ ?>
                            <li class="has_sub">
                                <a href="store_transfer.php" class="waves-effect"><i class="fa fa-copy"></i> <span style="font-size: 12px;"> STORE TRANSFER</span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                              <?php } ?>   
                            
                            
                             <?php  if( $_SESSION['ser_consumption']=='Y'){ ?>
                              <li class="has_sub" style="display: block">
                                <a href="consumption.php" class="waves-effect"><i class="fa fa-recycle"></i> <span style="font-size: 12px;"> CONSUMPTION </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <?php } ?>   
                            
                            
                             <?php  if( $_SESSION['ser_wastage_entry']=='Y'){ ?>
                              <li class="has_sub" style="display: block">
                                <a href="wastage.php" class="waves-effect"><i class="fa fa-bitbucket"></i> <span style="font-size: 12px;"> WASTAGE </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <?php } ?>   
                            
                           
                             <?php  if( $_SESSION['ser_physical_stock_permission']=='Y'){ ?>
                             <li class="has_sub">
                                <a href="physical_stock.php" class="waves-effect"><i class="fa fa-database"></i> <span style="font-size: 12px;"> PHYSICAL STOCK </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <?php } ?>   
                            
                             <?php  if( $_SESSION['ser_return_history']=='Y'){ ?>
                            <li class="has_sub" style="display: block">
                                <a href="purchase_return_history.php" class="waves-effect"><i class="fa fa-download"></i> <span style="font-size: 12px;">  PURCHASE RETURN </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <?php } ?>   
                            
                            
                            
                            
                            <?php  if( $_SESSION['ser_inventory_reports']=='Y'){ ?>
                             <li class="has_sub" style="display: block">
                                <a href="inventory_reports.php" class="waves-effect"><i class="fa fa-list-alt"></i> <span style="font-size: 12px;"> REPORTS </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                            <?php } ?>   
                            
                            
                             <?php  if($_SESSION['ser_central_kitchen']=='Y' ){ ?>
                             <li class="has_sub" style="display: block">
                                <a href="central_history.php" class="waves-effect"><i class="fa fa-cloud-upload"></i> <span style="font-size: 12px;"> CENTRAL KITCHEN </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                            <?php } ?>  
                            
                            
                            <li class="has_sub" style="display: block">
                                <a href="#" class="waves-effect"><i class="fa fa-list-ul "></i> <span style="font-size: 12px;"> MASTERS </span> <!--<span class="menu-arrow"></span>--></a>
                                     
                                <ul id="open_div" style="">
                                    
                                     <?php if(in_array("Menu Masters", $_SESSION['menumodarray']) && (in_array("menu", $_SESSION['menusubarray']))) { ?> 
                                    <li><a style="background-color: #c35f51;font-size: 10px;color: white;margin-bottom: 2px;" href="../menu.php">PRODUCT MASTER</a></li>
					  <?php } ?> 
                                    
                                    
                                    
                                     <?php  if(in_array("supplier", $_SESSION['menusubarray'])){ ?>  
                                    <li><a style="background-color: #c35f51;font-size: 10px;color: white;margin-bottom: 2px;" href="../accounts/supplier.php">SUPPLIER MASTER</a></li>
					 <?php } ?> 
                                    
                                    
                                       <?php  if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?> 
                                    <li><a style="background-color: #c35f51;font-size: 10px;color: white" href="../inv_kitchen.php">INV STORE-KITCHEN</a></li>
					 <?php } ?> 
                                    
                                    
				</ul>
                                
                                
                            </li>
                            
                            
                            
                            
                            
                            <li  class="has_sub" style="display: block">
                                <a   class="waves-effect"><i class="fa fa-clock-o"></i> <span onMouseOver="this.style.color='white'" onMouseOut="this.style.color='black'"  style="font-size: 9px;font-weight: bold;border: solid 1px ;padding: 4px;color: black;border-radius: 5px">Date: <?=$_SESSION['date']?> | Staff: <?=substr($_SESSION['expodine_id'],0,10)?></span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>
                             <li  class="has_sub" style="display: none">
                                <a   class="waves-effect"><i class="fa fa-user"></i> <span onMouseOver="this.style.color='white'" onMouseOut="this.style.color='black'"  style="font-size: 10px;font-weight: bold;border: solid 1px ;padding: 4px;color: #996363;border-radius: 5px"></span> <!--<span class="menu-arrow"></span>--></a>
                                     
                            </li>

                            
                            
                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
       
            <!-- Left Sidebar End -->
<input type="hidden" id="central_kitchen_on" value="<?=$_SESSION['ser_central_kitchen']?>" >

<input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" >


  <style>
.stck_add_btn5{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec5{width:100%;height:100%;position:fixed;left:0;top:0;z-index:999999;background-color:rgba(0,0,0,0.9)}
.stok_add_popup5{width:350px;height:185px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd5{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt5{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx5{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn5{width:45%;float:right;height:35px;text-align:center;line-height:35px;background-color:darkred;color:#fff;border-radius:5px;margin-top: 5px;font-size: 10px;font-weight: bold}
.stok_add_popup_cls5{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
<!--   ///common alert popup/////-->
  <div class="stok_add_popup_sec5" style="display:none" id="confirm_pop_all">    
      <div class="stok_add_popup5" style="width:375px;height: 140px">
          <div class="stok_add_popup_cnt5">
              <span id="pop_head_com" style="margin-top: 10px;font-size:15px;font-weight: bold;color: black;width: 100% !important;position: absolute;text-align: center">CONFIRM ? </span> 
           
            <a  onclick="confirm_yes_new();" href="#"><div class="stock_add_btn5" style="width:48%;margin-top: 58px;font-size: 15px;margin-left: 12px">YES</div></a>
            <a  onclick="$('#confirm_pop_all').hide();" href="#"><div class="stock_add_btn5" style="width:48%;margin-top: 58px;font-size: 15px">NO</div></a>
        </div>
        
    </div>
   </div>

<script>


$(document).ready(function(){
    
    var cloud_api_on= $('#cloud_api_on').val();
    
     
    
    
var central_kitchen_on=$('#central_kitchen_on').val();

if(central_kitchen_on=='Y'){
    
     setTimeout(function(){ 
         
          $.post("../autoload_menu.php", {set:'central_accept_reject'},
	function(data)
	{ 
                                      
         });
         
       }, 3500); 
    
    
    
    
setInterval(function() {
         
   $.post("../autoload_menu.php", {set:'central_accept_reject'},
	function(data)
	{
                                      
         });

}, 10000);    

}
 
 
  });
  
  </script>