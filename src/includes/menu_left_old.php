<div class="nopaddding" id="container">
 </div> <!--container-->
<div class="container">
			<!-- Push Wrapper -->
			<div class="mp-pusher" id="mp-pusher">

				<!-- mp-menu -->
				<nav id="mp-menu" class="mp-menu">
					<div class="mp-level">
						<h2 class="icon icon-world">Our Menus</h2>
						<ul>
                        	<li><a class="icon icon-photo" href="index.php">Dashboard</a></li>
                            <?php if(in_array("Menu Masters", $_SESSION['menumodarray'])) { ?> 	
                           		<?php if(in_array("category_master", $_SESSION['menusubarray'])) { ?> 
                            		<li><a class="icon icon-photo" href="category_master.php">Menu Master</a></li>
                           		<?php } else if(in_array("sub_category_master", $_SESSION['menusubarray'])) { ?> 
                            		<li><a class="icon icon-photo" href="sub_category_master.php">Menu Master</a></li>
                           		<?php } else  if(in_array("menu", $_SESSION['menusubarray'])) { ?> 
                            		<li><a class="icon icon-photo" href="menu.php">Menu Master</a></li>
                           		<?php } else if(in_array("ingredient_master", $_SESSION['menusubarray'])) { ?>   
                                     <li><a class="icon icon-photo" href="ingredient_master.php">Menu Master</a></li>
                                 <?php } else if(in_array("portion_master", $_SESSION['menusubarray'])) { ?>    
                                     <li><a class="icon icon-photo" href="portion_master.php">Menu Master</a></li>
                                <?php } ?>      
                                 
                            <?php } ?>
                            
                             <?php if(in_array("Master Tables", $_SESSION['menumodarray'])) { ?> 	
							<li class="icon icon-arrow-left">
								<a class="icon icon-news" href="#">Master Tables</a>
								<div class="mp-level">
									<h2 class="icon icon-news">Master Tables</h2>
									<a class="mp-back" href="#">back</a>
									<ul>
                                    <!-- --------------------- Geographical masters------------------->
								<?php if(in_array("country_master", $_SESSION['menusubarray'])) { ?> 
                                <li><a href="country_master.php">Geographical</a></li>
                                 <?php } else if(in_array("state_master", $_SESSION['menusubarray'])) { ?>   
                                <li><a href="state_master.php">Geographical</a></li>
                                 <?php } else if(in_array("city_master", $_SESSION['menusubarray'])) { ?>    
                                <li><a href="city_master.php">Geographical</a></li>
                                 <?php } ?> 
                                  
                                   <!-- --------------------- Basic Data------------------->
								 <?php if(in_array("kot_counter_master", $_SESSION['menusubarray'])) { ?> 
                                  <li><a href="kot_counter_master.php">Basic Data</a></li>
                                   <?php } else if(in_array("floor_master", $_SESSION['menusubarray'])) { ?>  
                                  <li><a href="floor_master.php">Basic Data</a></li>
                                  <?php } else if(in_array("table_master", $_SESSION['menusubarray'])) { ?>   
                                  <li><a href="table_master.php">Basic Data</a></li>
                                   <?php } else  if(in_array("printer_master", $_SESSION['menusubarray'])) { ?> 
                                  <li><a href="printer_master.php">Basic Data</a></li>
                                  <?php } ?>  
                                          
                                    <!-- --------------------- Staff master------------------->          
               					  <?php if(in_array("department_master", $_SESSION['menusubarray'])) { ?>         
                                      <li><a href="department_master.php">Staff master</a></li>
                                  <?php } else  if(in_array("designation_master", $_SESSION['menusubarray'])) { ?>    
                                         <li><a href="designation_master.php">Staff master</a></li>
                                    <?php }else  if(in_array("staff_master", $_SESSION['menusubarray'])) { ?>   
                                         <li><a href="staff_master.php">Staff master</a></li>
                                  <?php } ?> 
                                                   
                              
                                  <!-- --------------------- Discount master------------------->    
                                <?php if(in_array("discount_master", $_SESSION['menusubarray'])) { ?>   
                                            <li><a href="discount_master.php">Discount</a></li>
                                 <?php } else if(in_array("corporate_discount", $_SESSION['menusubarray'])) { ?>
                                            <li><a href="corporate_discount.php">Discount</a></li>  
                                  <?php } else if(in_array("voucher_master", $_SESSION['menusubarray'])) { ?>       
                                            <li><a href="voucher_master.php">Discount </a></li>
                                 <?php } else if(in_array("coupon_company", $_SESSION['menusubarray'])) { ?> 
                                        <li><a href="coupon_company.php">Discount </a></li>
                                 <?php } ?>
                                            
									</ul>
								</div>
							</li>
                            <?php } ?>
                       <?php if(in_array("Reports", $_SESSION['menumodarray'])) { ?>
                       <li><a class="icon icon-photo" href="report.php">Reports</a></li>
						 <?php } ?>
                         
                          <?php if(in_array("User Permission", $_SESSION['menumodarray'])) { ?> 	
                            	<li><a class="icon icon-photo" href="user_permission.php">User Permission</a></li>
                           <?php } ?>
                           
                            <?php if(in_array("Attendance", $_SESSION['menumodarray'])) { ?> 	
                                <li><a class="icon icon-photo" href="attendence_staff.php">Attendance</a></li>
                             <?php } ?>
                             
                             <?php if(in_array("Change Password", $_SESSION['menumodarray'])) { ?> 	    
							   <li><a class="icon icon-photo" href="chng_password.php">Change password</a></li>
                               <?php } ?>
						</ul>
							
					</div>
				</nav>
				<!-- /mp-menu -->

				<div class="scroller"><!-- this is for emulating position fixed of the nav -->
					<div class="scroller-inner">
						<!-- Top Navigation -->
						
						<div class="content clearfix">
                        </div>
					</div><!-- /scroller-inner -->
				</div><!-- /scroller -->

			</div><!-- /pusher -->
		</div>      