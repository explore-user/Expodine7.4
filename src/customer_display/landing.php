<?php
session_start();
                            include("../database.class.php");
$database	= new Database();
?>
<link rel="shortcut icon" href="img/favicon.ico">

<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ORDER </title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">
<style>
    .confrmation_overlay_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
        display: none;
        text-align:center;
	padding-top:150px
}

.confrmation_overlay_auth img{
    
    width:100px;
    height:100px;
   
}
.acc_table_scroll tbody {height: 56vh;}
</style>

   <script src="../js/jquery-1.10.2.min.js"></script>  
    
   <script>
   
   function go_to(mode){
       
       if(mode=='Urban'){
           
           $('.cancel_reason_popup_sec').hide();  
           $('.main_loader_sec').show();    
           
           window.location.href='online_order_screen.php';
       }else{
            $('.cancel_reason_popup_sec').hide();  
           $('.main_loader_sec').show();    
            window.location.href='qr_order_screen.php';
       }
       
   }
   
   
   </script>

</head>

<body>
 
    
    




 



    <div class="cancel_reason_popup_sec" >
   <div class="cancel_reason_popup">
      <div class="cancel_reason_popup_head">
       ONLINE
          <a  href="../index.php"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>
      </div>
      <div class="cancel_reason_popup_cnt">
          <div class="reson_select_drp">
              
          </div>
      </div>
       <div class="reson_select_sec_btn_row">
           
           
           <?php $qr_db=''; $urban_db='';
           $sql_login  =  $database->mysqlQuery("select be_qrcode_db,be_store_db from tbl_branchmaster  "); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $qr_db=$result_cat_s_tc['be_qrcode_db'];
                          $urban_db=$result_cat_s_tc['be_store_db'];
                          
                          
                          
	  }			
} 


              if($qr_db!=''){
           ?>
           
           <div onclick="go_to('Qr')" style="background-color: darkred "  class="reson_sub_btn">QR CODE</div>
          
           <?php
              }
           
           if($urban_db!=''){
           ?>
           
           <div  onclick="go_to('Urban')" class="reson_sub_btn">ONLINE ORDER</div>
           
           <?php } ?>
           
           
      </div>
   </div>
</div>



<div style="display:none" class="confrmation_overlay_auth"></div>

 <div class="main_loader_sec" style="display: none;width: 100%;height:100%;position: fixed;left:0;top:0;background-color:rgba(0,0,0,0.5);z-index: 999;text-align:center;padding-top:20%">
        <img src="img/loader.gif" style="width: 150px;" alt="">
  </div>

</body>
</html>
<!-- <meta http-equiv="refresh" content="2">-->