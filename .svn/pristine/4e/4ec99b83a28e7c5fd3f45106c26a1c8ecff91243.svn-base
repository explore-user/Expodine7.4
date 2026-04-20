
<?php 

         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

         $lock_crm='N'; 
        
         $sql_gen =  mysqli_query($localhost,"select payment_overdue_date,overdue_crm,lock_crm from tbl_generalsettings"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
		  while($result_desg13  = mysqli_fetch_array($sql_gen)) 
		  {
                    $lock_crm=$result_desg13['lock_crm'];
            
                  }  }     

 if($lock_crm=='N'){                 
                  
 ?>

 <div id="paymentOverlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.90);z-index:9999999999;display:flex;align-items:center;justify-content:center;">

  <div style="background:#ffffff;padding:30px 40px;border-radius:10px;text-align:center;max-width:420px;width:90%;box-shadow:0 10px 40px rgba(0,0,0,0.3);font-family:Arial, sans-serif;">
    <h2 style="margin:0 0 10px;color:#d32f2f;">
      Payment Overdue 
    </h2>

    <p style="font-size:16px;margin:0 0 20px;color:#333;">
      Please clear your outstanding payment to avoid uninterrupted services.
    </p>

    <button style="background:darkred;color:#fff;border:none;padding:12px 25px;font-size:16px;border-radius:6px;cursor:pointer;">
     CONTACT SOFTWARE SUPPORT +919895313434 | +917994051951
    </button>
    
    
   </div>

  </div>

 <script>
     
    setTimeout(function () {
    var overlay = document.getElementById('paymentOverlay');
    if (overlay) {
      overlay.style.display = 'none';
      document.body.style.overflow = 'auto';
    }
    }, 5000);
  
</script>  


 <?php }else{ ?>
     
    <div id="paymentOverlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.90);z-index:9999999999;display:flex;align-items:center;justify-content:center;">

    <div style="background:#ffffff;padding:30px 40px;border-radius:10px;text-align:center;max-width:420px;width:90%;box-shadow:0 10px 40px rgba(0,0,0,0.3);font-family:Arial, sans-serif;">
    <h2 style="margin:0 0 10px;color:#d32f2f;">
      SOFTWARE LOCKED 
    </h2>

    <p style="font-size:16px;margin:0 0 20px;color:#333;">
      Please clear your outstanding payment to unlock software.
    </p>

    <button style="background:red;color:#fff;border:none;padding:12px 25px;font-size:16px;border-radius:6px;cursor:pointer;">
     CONTACT SOFTWARE SUPPORT +919895313434 | +917994051951
    </button>
    <br><br>
    <a href="logout.php" style="background:darkred;color:#fff;border:none;padding:8px 15px;font-size:15px;border-radius:6px;cursor:pointer;margin-top: 35px;text-decoration: none"> LOGOUT </a>
    
   </div>

  </div>


<script>
document.addEventListener("keydown", function(e) {

    // F12
    if (e.keyCode == 123) {
        e.preventDefault();
        return false;
    }

    // Ctrl+Shift+I / Ctrl+Shift+J / Ctrl+Shift+C
    if (e.ctrlKey && e.shiftKey && 
       (e.keyCode == 73 || e.keyCode == 74 || e.keyCode == 67)) {
        e.preventDefault();
        return false;
    }

    // Ctrl+U (view source)
    if (e.ctrlKey && e.keyCode == 85) {
        e.preventDefault();
        return false;
    }
});
</script>

     
 <?php }  ?>


  