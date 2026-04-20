
<SCRIPT TYPE="text/javascript">
$(document).bind("contextmenu", function (e) {
        e.preventDefault();
       // alert("Right Click is Disabled");
    });
</SCRIPT>
<script>
/*try{
//window.setInterval($('#topbarload').location.refresh(), 300);
//window.setInterval($('#printercheck').location.refresh(), 300);
}catch(e){
    if(e){
    }
}
*/
/*$(document).ready(function() {
  setInterval(function() {
	 $('#topbarload').load('includes/iframeload.php');
  }, 3000); // the "3000" 
});*/

</script>

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













<div style="z-index:999999999" class="olddiv1 "></div> 
<div class="navbar navbar-default logout-dropdown" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a href="#" id="trigger" class="menu-trigger"></a>

               <!-- <span class="toggle-menu purple"><i class="ti-menu"></i></span>-->
<?php 

$linkname	= trim(basename($_SERVER['PHP_SELF']));
$goto='';
if($linkname!="menu_order.php" && $linkname!="order_split.php"){
$goto="index.php";
}
else
{$goto="#"; }
 ?>
                  <input type="hidden" id="logid" value="<?=$_SESSION['expodine_id']?>" >
             <a style="margin-top: -1px !important;margin-left: 0.5% !important;left: 0 !important;" class="navbar-brand header_logo" href="<?=$goto?>"> <img alt=""  src="img/logo20.png"  class="hidden-xs logo_cc"/></a>
            
            <!--hotel logo--->
            	<?php include "includes/logo.php"; ?>
            <!--/logo hotel--->
	    <?php include "includes/page_shortcuts.php"; ?>

            <!-- user dropdown starts -->
            
             <?php include "includes/topbar_dropdown.php"; ?> 
           <!-- <div class="btn-group pull-right">
                <button class="btn_1 btn-default dropdown-toggle" data-toggle="dropdown">

					<span class="hidden-sm hidden-xs cahier_txt"><?=$_SESSION['designtnname']?></span><br />
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?=$_SESSION['expodine_id'] ?></span>
 			<?php //$linkname	= basename($_SERVER['PHP_SELF']); ?>
             <?php  //if($linkname!="menu_order.php"){ ?> 
                    <span class="caret"></span>
                     <?php //} ?>
                </button>
               <?php   //if($linkname!="menu_order.php"){ ?>  
                <ul class="dropdown-menu">
                    <!--<li><a href="#">Profile</a></li>-->
                    <!--<li><a onClick="confirmation()" style="cursor:pointer">Logout</a></li>
                </ul>
                <?php //} ?>
            </div>--><!--btn-group-->
          <!-- <iframe src="includes/printercheck.php" name="printercheck" id="printercheck"></iframe>-->
                    
                    <?php if($linkname!="order_split.php"){ ?>
            <a class="new_iframe " style="display:none">
              <iframe src="includes/iframeload.php" name="topbarload" id="topbarload"></iframe><!--navbar-default--> 
              </a>
                    <?php } ?>
                    
              <?php //if($_SESSION['s_printst']=="Y") { ?><!--kot refreshing code-->
              <!--<iframe src="includes/checkkotload.php" name="kotcheck" id="kotcheck"></iframe>-->
              <?php //} ?>
            <!--<?php /*?><?php if(in_array("Manage Stock", $_SESSION['menumodarray'])) { ?> 	
              <a class="manage" href="#"><div class="top_mange_btn_cc">
              		<div class="top_mange_btn_img"><img src="img/manage_icon.png" /></div>
                    <div class="top_mange_btn_txt"><?=$_SESSION['header_manage']?></div>
              </div></a><!--top_mange_btn_cc-->
              <?php } ?><?php */?>-->
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
	function confirmation()
	{   
            $('#logout_pop').show();
	}
        
        
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