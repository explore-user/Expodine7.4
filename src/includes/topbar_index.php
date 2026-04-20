


<div class="navbar navbar-default" role="navigation" style="min-height:40px;margin-bottom:10px;">

        <div class="navbar-inner" style="    height: 43px;">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <!--<a href="#" id="trigger" class="menu-trigger"></a>
                 <span class="toggle-menu purple"><i class="ti-menu"></i></span>-->
            <a style="margin-top: -3px !important;margin-left: -5px !important;;left: 0 !important;width:130px" class="navbar-brand header_logo" href="index.php"> <img alt="" style="width:100%;height:auto"  src="img/logo20.png"  class="hidden-xs "/></a>
			<!--hotel logo--->
            	<?php include "includes/logo.php"; ?>
            <!--/logo hotel--->
    
            <!-- user dropdown starts -->
           <?php include "includes/topbar_dropdown.php"; ?> <!--btn-group-->
              <!--navbar-default--> 
 </div> <!--container-->
 </div>



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
	{    
            localStorage.pin_relogin='';
            
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

});
</script>