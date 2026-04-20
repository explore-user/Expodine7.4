



<SCRIPT TYPE="text/javascript">
$(document).bind("contextmenu", function (e) {
        e.preventDefault();
       // alert("Right Click is Disabled");
    });
</SCRIPT>



 <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a href="#" id="trigger" class="menu-trigger"></a>
                 <span class="toggle-menu purple"><i class="ti-menu"></i></span>
            <a  style="margin-top: 2px !important;margin-left: 0px !important;left: 0 !important;" class="navbar-brand header_logo" href="index.php"> <img alt=""  src="img/logo20.png"  class="hidden-xs logo_cc"/></a>
            
            <!--hotel logo--->
            	<?php include "includes/logo.php"; ?>
            <!--/logo hotel--->
	<?php //include "includes/page_shortcuts.php"; ?>
            <!-- user dropdown starts -->

        
            
               
               <?php include "includes/topbar_dropdown.php"; ?> 
                
            
     <!-- <a class="new_iframe " >
              <iframe src="includes/iframeload.php" name="topbarload" id="topbarload"></iframe><!--navbar-default--> 
              </a>
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
        
	 
  $(document).ready(function() {
      
     
                    
	    setInterval(function() {

$.post("autoload_menu.php", {set:'copyfolders'},
					function(data)
					{//$('#chatAudio')[1].play();alert("h");
					data=$.trim(data);

					});	
                                        
                                         
                                        
					}, 20000);
                                        
                                        
            $(document).on('keypress',function(e) {
    if(e.which == 13) {
       
    
        if($('.logout_main_popup_for_all').is(':visible')){
            pop_logout_yes();
            
           
        }
        
        }
});                            
                                        
	  });
	</script>
<style>
.cahier_txt{ top: -5px; }
</style>


<style>
iframe{
	  overflow: visible;
    height: 0px;
	  min-height: 50px;
    position: absolute;
	right:0;
    width:50%;
    /*z-index: 9999;*/
    border: 0;
	}
.loadzindex
{
	z-index:99999 !important;
	height:80vh;
	min-height:600px;
}

.sidebar-toggle{padding: 17px 20px 17px 22px;}
.right_staf_selection_cc{min-height:600px;height:80vh !important;}
	

</style>

