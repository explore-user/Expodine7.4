
    <link rel="shortcut icon" href="img/favicon.ico">

    <?php
   
    $linkname	= basename($_SERVER['PHP_SELF']); 
       
    if($linkname=="index.php" &&  $_SESSION['s_phone_order_enable']=='Y' ){ ?>  
    <button  style="display: block;    position: absolute; 
    top: 11px;
    left: 159px;
    z-index: 99;
    border: 1px;
    border-radius: 5px;"  onclick="connectComet();">Connect Caller ID</button>
    <?php  } ?> 
    
    
   
  <script type="text/javascript">
    
  function getPhoneNumber(phone){
      
      $('.phone_in_one').show();
      $('.phone_in_one').attr('num',phone); 
      
      
      var phone=  phone.replace(/\s+/g, '');
      
      
              var  dataString1='set=load_name_by_phone&phone='+phone ;
              $.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString1,
		success: function(data) {
                   if($.trim(data)!='no'){
                          $('#load_num').text($.trim(data)); 
                    }else{
                          $('#load_num').text(phone); 
                    }
                } });
  }
     
  function cancel_call(){
      
          var  dataString1='phone_order_del=phone_order_del_ok' ;
             $.ajax({
		type: "POST",
		url: "take_away_.php",
		data: dataString1,
		success: function(data) {
                    $('.phone_in_one').hide();
                } });
   }
     
  function accept_call(){
      
           var phone= $('.phone_in_one').attr('num'); 
           
           phone=  phone.replace(/\s+/g, '');
           
           
           var  dataString1='phone_order='+phone ;
             $.ajax({
		type: "POST",
		url: "take_away_.php",
		data: dataString1,
		success: function(data) {
                    $('.phone_in_one').hide();
                    window.location.href='take_away_.php';
                    $('.phone_in_one').hide();
               } });
          
   }
   </script>
 
  

<strong  class="phone_in_one" style="display: none"> 
    <div>  CUSTOMER <span id="load_num" style="text-transform: uppercase " ></span> CALLING !   </div>
    <br>
 
    <a style="color: white;
    border-radius: 3px;
    border: solid 1px;
    text-align: center;padding: 10px;
    margin-right: 14px;font-size: 12px"  href="#" onclick="accept_call()"> &nbsp; ACCEPT  &nbsp;</a>

    <a style="color: white;
    border-radius: 3px; 
    border: solid 1px;
    text-align: center;padding: 10px;
    margin-right: 14px;font-size: 12px" href="#" onclick="cancel_call()"> &nbsp; REJECT &nbsp; </a>
     
</strong>

<style>
 .phone_in_one{
	width: 326px;
	height: 132px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        background-color:#447c76;
	text-align: center;
	padding: 20px 40px;
	padding-top: 20px;
	z-index: 99999;
	color: #fff;
	font-size: 14px;
	border-radius: 5px;
	font-family: sans-serif;
}
.phone_in_one:before{
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    background-color: rgb(0,0,0,0.4);
    content: '';
    z-index: -2;
}
</style>
 <script src="js/comet.js"></script>
 