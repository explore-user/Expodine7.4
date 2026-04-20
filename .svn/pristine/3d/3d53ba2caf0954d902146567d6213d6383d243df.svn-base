<?php


if($_REQUEST['set']=='checkrootuser')
 {
	 $dbname = $_REQUEST['dbname'];
	 $typelike=$_REQUEST['typelike'];
	
		$servername = "localhost";
	  $username = "root";
	  $password = "explore";
		
	
	 
	 $conn_chk = new mysqli($servername, $username, $password);
		mysqli_select_db($conn_chk,$dbname);
		$chkrows=mysqli_query($conn_chk,"select * from mysql.user where `Host` = 'localhost' and `User` = '%'");
		$numros  = mysqli_num_rows($chkrows);
		$totalnos=floor($numros);
		if($totalnos==0){
			$msg="ADD ROOT USER BEFORE PROCEEDING";
			?>
           
        <div class="loading_popup_headiing_text">ADD ROOT USER BEFORE PROCEEDING</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        	<!--<img src="images/processing.gif">-->
         </div>
        
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        <script>
		  $("#loading_popup_ok_click1").click(function(){
	  
	   $(".loading_popup").css("display","none");
	  $(".loading_popup_overlay").css("display","none");
	
 }); 
		</script>
            <div class="loading_popup_area"><a href="#" class="loading_popup_ok_btn  " id="loading_popup_ok_click1">OK</a></div>
            <?php
			exit;
		}else
		{?>
			
			
        <div class="loading_popup_headiing_text">DataBase Importing....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        	<img src="images/processing.gif">
         </div>
        <div class="loading_popup_headiing_text" style="margin-top: 8px;">Please wait....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
			
		<?php }
		
		?>
        
        <?php
 }
?>