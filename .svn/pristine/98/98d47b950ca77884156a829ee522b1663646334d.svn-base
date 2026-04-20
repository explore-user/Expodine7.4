<link rel="shortcut icon" href="img/favicon.ico">
<?php

include("../database.class.php");
$database	= new Database();



?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Customer Display </title>
<link rel="shortcut icon" href="img/favicon.ico">

<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">


   <script src="../js/jquery-1.10.2.min.js"></script>  
    
   <script type="text/javascript">
            $(document).ready(function () {
                
             setInterval(function () {
                 
                 
             var sts=$('#sts').val();    
             
             var mode=$('#mode1').val();    
                 
            var data123="sts="+sts+"&mode1="+mode;
      
            $.ajax({
            type: "POST",
            url: "load_customer_display.php",
            data: data123,
            success: function(data) { 
                
               if ($.trim(data).indexOf("NO ORDERS FOUND") >= 0){
              
                   $('.take-away-quee-contant-cc').css({
                        'color': 'red',
                        'font-size': '30px',
                        'text-align': 'center',
                        'align-items': 'center',
                        'align-content': 'inherit'
                    });
                 
                    $('.take-away-quee-contant-cc').html($.trim(data));    
                
                  }else{ 
                      
                       $('.take-away-quee-contant-cc').css({
                        'color': 'red',
                        'font-size': '30px',
                        'text-align': 'center',
                        'align-items': 'center',
                        'align-content': 'baseline'
                    });
                      
                    $('.take-away-quee-contant-cc').html($.trim(data));
                    
                    
                 }
                
             }
             });
             
                 
                 
              
               
                }, 1000);
                
            });  
            
            
            
            function change_staus(bill,sts){
                
                $('#add_stock_pop').show();
                
                $('#add_stock_pop').attr('bill',bill);
                
                 if(sts=='Ready'){
                     
                     $('#ready_btn').addClass('disablegenerate');
                     
                 }else{
                    $('#ready_btn').removeClass('disablegenerate'); 
                     
                 }
                
                
                if(bill[0]=='T' || bill[0]=='H'){
                    
                    $('.del_btn_new').text('DELIVER'); 
                  
                }else{
                   $('.del_btn_new').text('SERVED');
                }
                
                
            }
            
            
           function ready(){
                
           var bill=   $('#add_stock_pop').attr('bill');  
           
           var data123="set=customer_status_ta&sts=Ready&bill="+bill;
      
            $.ajax({
            type: "POST",
            url: "../load_index.php",
            data: data123,
            success: function(data) {
                
                
                 $('#add_stock_pop').hide();
                $('#add_stock_pop').attr('bill','');
                
                
             }
             });
             
             
             
            }
            
            
           function deliver(){
                
           var bill=   $('#add_stock_pop').attr('bill');  
                
           var data123="set=customer_status_ta&sts=Delivered&bill="+bill;
      
            $.ajax({
            type: "POST",
              url: "../load_index.php",
            data: data123,
            success: function(data) {
                
                
                 $('#add_stock_pop').hide();
                $('#add_stock_pop').attr('bill','');
                
                
             }
             });
                
                
            }
            
        function view_sts(){
                
                 $('#mode1').show();
                
         }
            
         function mode_click(){
                
                 $('#mode1').hide();
                  $('#mode1').css('margin-left', '92%');
                   $('#mode1').css('margin-top', '0%');
     
            }
    
    
    </script>

</head>

<body>
 
    
    
     <style>
         .disablegenerate { pointer-events: none; opacity: 0.4; cursor:none;}
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:green;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="../img/black_cross.png" alt=""></div></a></div>
      
        
         <div class="stok_add_popup_cnt" id="admin_div">
            <span style="font-size: 17px; font-weight: bold; color: darkred; margin-bottom: 20px; display: inline-block; font-family: sans-serif;">MANAGE ORDER STATUS !</span> 
           
             <a  onclick="deliver();" href="#"><div class="stock_add_btn del_btn_new" style="width:40%;    margin-left: 45px;">DELIVER</div></a>
             
             <a id="ready_btn"  onclick="ready();" href="#"><div class="stock_add_btn" style="width:40%">READY</div></a>
        </div>
        
    </div>
   </div>
    
    
    
    <div class="container-fluid no-padding">
      <div class="middle_container">
      <div class="top_site_map_cc new-sitemap-cc" style="width:100%">
          
          <a href="../index.php" style="color: whitesmoke;float: left;border: solid;border-radius: 2px;text-decoration: none;background-color:#b30a0a"> <img src="../img/home_ico.png"> </a> 
          
        <span style="font-size: 26px"> ORDER STATUS </span>
          
          <div class="change_order_mode">
           <a  style=""> <img style="width: 21px;cursor: pointer" src="../img/take_away_btm_icon_6.png"> </a> 
           <select  id="mode1" style="border-radius: 0; padding: 2.5px 20px; border: 0;display: block;color:#242424">
               <option value="">ALL MODE</option>
                    <option value="TA">TA</option>
                    <option value="HD">HD</option> 
                      <option value="CS">CS</option> 
                     <option value="DI">DI</option>   
                </select>
           </div>
         
         <a  href="../ta_bill_history.php"   style="color: whitesmoke;float: right;border: solid;border-radius: 4px;text-decoration: none;background-color:#b30a0a;display: none">&nbsp; &nbsp;  TA BILL HISTORY &nbsp;  &nbsp; </a> 
          
           
      </div>
          
        <div class="take-away-quee-contant-cc">

            <span style="color:white;font-size: 20px;display: flex;width:100%;height:100%;align-items: center;justify-content: center;">LOADING ORDERS...</span>
            
        </div>
        
      </div>    
</div>


</body>
</html>
