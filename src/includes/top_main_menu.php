<?php
$linkname	= basename($_SERVER['PHP_SELF']);

?>
 <link rel="stylesheet" href="css/meterial.css">
 <div id="top_menu_overlay" class=""></div>
 <div id="cd-nav">
		<a href="#" class="cd-nav-trigger">Menu<span></span></a>

		<nav id="cd-main-nav">
			<ul>
                <li>
                    <a href="index.php" title="">Home</a>
                </li>
                <?php if($linkname=='table_selection.php' || $linkname=='menu_order.php' || $linkname=='kot_checklist.php' || $linkname=='bill_generation_screen1.php' || $linkname=='bill_generation_screen2.php' || $linkname=='bill_generation_screen3.php') { ?>
					<?php if(in_array("table_selection", $_SESSION['menuarray'])) { ?> 
                    <li>
                        <a  href="table_selection.php" <?php if($linkname=='table_selection.php'){ ?>class="top_menu_active" <?php } ?> title="">Order</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array("kot_checklist", $_SESSION['menuarray'])) { ?>  
                    <li>
                        <a href="kot_checklist.php" <?php if($linkname=='kot_checklist.php'){ ?>class="top_menu_active" <?php } ?> title="">kot</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array("bill_generation_screen1", $_SESSION['menuarray'])) { ?> 
                    <li>
                        <a href="bill_generation_screen1.php" <?php if($linkname=='bill_generation_screen1.php'){ ?>class="top_menu_active" <?php } ?> title="">Bill Generation</a>
                    </li>
                    <?php } ?>
                <?php } ?>
                <?php if($linkname=='take_away.php' || $linkname=='take_away_kot.php' || $linkname=='take_away_list.php' || $linkname=='take_away_list_bill.php' || $linkname=='take_away_staff.php' || $linkname=='take_away_search.php' ) { ?>
                	<?php if(in_array("take_away", $_SESSION['menuarray'])) { ?>
                    <li>
                        <a href="take_away.php" <?php if($linkname=='take_away.php'){ ?>class="top_menu_active" <?php } ?> title="">TA - Order</a>
                    </li>
                    <?php } ?>
                    <?php if(in_array("take_away_kot", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="take_away_kot.php" <?php if($linkname=='take_away_kot.php'){ ?>class="top_menu_active" <?php } ?> title="" >TA - KOT</a>
                    </li>
                    <?php } ?>
                     <?php if(in_array("take_away_search", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="take_away_search.php" <?php if($linkname=='take_away_search.php'){ ?>class="top_menu_active" <?php } ?> title="" >TA - Search</a>
                    </li>
                    <?php } ?>
                     <?php if(in_array("take_away_list_bill", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="take_away_list_bill.php" <?php if($linkname=='take_away_list_bill.php'){ ?>class="top_menu_active" <?php } ?> title="">TA - Bill</a>
                    </li>
                    <?php } ?>
                     <?php if(in_array("take_away_list", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="take_away_list.php" <?php if($linkname=='take_away_list.php'){ ?>class="top_menu_active" <?php } ?> title="">TA - Staff Assign</a>
                    </li>
                    <?php } ?>
                     <?php if(in_array("take_away_staff", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="take_away_staff.php" <?php if($linkname=='take_away_staff.php'){ ?>class="top_menu_active" <?php } ?> title="">TA - Staff Bill</a>
                    </li>
                    <?php } ?>
                    
                     <?php if(in_array("ta_bill_history", $_SESSION['menusubarray'])) { ?>
                    <li>
                        <a href="ta_bill_history.php" <?php if($linkname=='ta_bill_history.php'){ ?>class="top_menu_active" <?php } ?> title="">TA - Bill History</a>
                    </li>
                    <?php } ?>
                    
                <?php } ?>
			</ul>
		</nav>
	</div>
   <script type="text/javascript" src="js/metirial.js"></script>  