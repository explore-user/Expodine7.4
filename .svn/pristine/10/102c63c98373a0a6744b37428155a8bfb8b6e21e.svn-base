
<SCRIPT TYPE="text/javascript">
$(document).bind("contextmenu", function (e) {
        e.preventDefault();
       // alert("Right Click is Disabled");
    });
</SCRIPT>
<style>
/*.top_mange_btn_cc{top: 18px;}
.company_logo_cc{ top: 10px;}*/
.cd-nav-trigger{box-shadow: none;-moz-box-shadow: none;}
</style>
  <div class="top_container">
        <div class="logo_container">
           <a href="index.php"> <div class="logo"><img src="img/logo20.png"></div></a>
        </div><!--logo_conrtainer-->
        <!--<?php /*?> <?php if(in_array("Manage Stock", $_SESSION['menumodarray'])) { ?> 	
              <a class="manage" href="#"><div class="top_mange_btn_cc">
              		<div class="top_mange_btn_img"><img src="img/manage_icon.png" /></div>
                    <div class="top_mange_btn_txt">Stock</div>
              </div></a><!--top_mange_btn_cc-->
              <?php } ?><?php */?>-->
              
           <!--hotel logo--->
            	<?php include "includes/logo.php"; ?>
            <!--/logo hotel--->
              
             <?php include "includes/page_shortcuts.php"; ?> 
             
        <div class="user_logout_cc">
        <!--<a onClick="confirmation()" style="cursor:pointer">
        	<span style="top:6px" class="top_logout_ico"></span>
            <div class="user_name"><?=$_SESSION['expodine_id'] ?></div>
        </a>-->
        
        <?php include "includes/topbar_dropdown.php"; ?> 
            <!--<div class="logout_arrow"></div> -->
            
        </div><!---user_logout_cc--->

        <!-- <span class="new_iframe take_away_top_ico"><iframe src="includes/iframeload.php" name="topbarload" id="topbarload"></iframe></span> -->
       
       </div><!--top_container-->
        <?php include "includes/takeaway_top_new_right_menu.php"; ?> 
       
       
       <div id="logout_pop" class="main_logout_popup_cc logout_main_popup_for_all">

    <div class="main_logout_popup">
    <div>
      <h1 class="logout_contant_txt"> LOGOUT FROM EXPODINE ?</h1>
       
       <div class="btn_logout_yes_no"><a onclick="return pop_logout_yes();" href="#" class="">YES</a></div>
       <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="return pop_logout_no();" style="color:#AB2426 !important"  href="#" class="">NO</a></div>
   </div>
   </div>
     </div>



       
       
  <script>
	function pop_logout_yes()
	{      localStorage.pin_relogin='';
	  var logid=$('#logid').val();       
          var datastring="setid=loginid&logid="+logid;
  
       $.ajax({
        type: "POST",
        url: "login.php",
        data: datastring,
        success: function(data)
        {  
          
        }
    });
	window.location="logout.php";
         }   
                 
                 
	
        
        
        function confirmation()
	{   
            $('#logout_pop').show();
	}
        
          
        function pop_logout_no()
	{     
	 $('#logout_pop').hide();
        }
        
	</script>      
  <script>


 $(document).ready(function()
 
{
    
    
   
    
    
    
            $(document).on('keypress',function(e) {
    if(e.which == 13) {
       
    
        if($('.logout_main_popup_for_all').is(':visible')){
            pop_logout_yes();
            
           
        }
        
        }
}); 
    
/*$("#topbarload").click(function()
{
	alert("g");
});
*/
$('.manage').click( function() { 
	$('.mynewpopupload1').css("display","block"); 
			  $(".olddiv1").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/stock.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload1').html(data);
				  });  
	});
        
        
});


	

</script>
<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999999999;" class="mynewpopupload1"  ></div> 




