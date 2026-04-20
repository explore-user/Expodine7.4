  
  <?php $linkname	= basename($_SERVER['PHP_SELF']); ?>
  <div class="backto_table_select back_bill_his new_right_drop" >
                  <ul>
                    <li class="dropdown goto_backward_drop">
                      <a class="pusher" href="index.php" data-toggle="dropdown"><span></span> <span></span> <span></span></a>
                      <ul class="dropdown-menu right_drop_menu">
					<div class="right_quick_mn_head"><?=$_SESSION['home_menus']?></div>
    
                      <?php if(in_array("Home Page", $_SESSION['menumodarray'])) { ?>
                        <li><a class="<?php if($linkname=="index.php"){ ?>  active_right_mn <?php } ?>" href="index.php"><?=$_SESSION['home_home']?></a></li>
                        <?php } ?> 
                        
                        <?php if(in_array("table_selection", $_SESSION['menuarray'])) { ?>  
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> table_selection.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="table_selection.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_order']?></a></li>
                        <?php } ?> 
                        
                        <?php if(in_array("kot_checklist", $_SESSION['menuarray'])) { ?> 
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> kot_checklist.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="kot_checklist.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_kot']?></a></li>
                        <?php } ?>  
                        
                        <?php if((in_array("Completed Order", $_SESSION['menumodarray']))){ ?> 
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> completed_order.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="completed_order.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_completedorder']?></a></li>
                         <?php } ?> 
                         
                         <?php if(in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>   
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>payment_pending.php  <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="payment_pending.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_paymentpending']?></a></li>
                         <?php } ?> 
                         
                         <?php if(in_array("Credit Settlement", $_SESSION['menumodarray'])){ ?>   
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit.php  <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="credit.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_creditsettlement']?></a></li>
                         <?php } ?> 
                         
                        <?php if(in_array("admin_home", $_SESSION['menuarray'])) { ?>
                        <li><a href="admin_home.php" class="<?php if($linkname=="admin_home.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_administration']?></a></li>
                         <?php } ?> 
                         
                         <?php if(in_array("take_away", $_SESSION['menuarray'])) { ?> 
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> take_away.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="take_away.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_takeaway']?></a></li>
                         <?php } ?> 
                         
                        <?php if(in_array("inventory", $_SESSION['menuarray'])) { ?> 
                        <li><a href="<?=$_SESSION['s_invtorylink']?>index.php" ><?=$_SESSION['home_inventory']?></a></li>
                         <?php } ?> 
                         
                        <?php if(in_array("registration", $_SESSION['menuarray'])) { ?> 
                        <li><a href="registration.php" class="<?php if($linkname=="registration.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_registration']?></a></li>
                         <?php } ?> 
                        
                        <?php if(in_array('bill_history', $_SESSION['menufullarray'])) { ?>    
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> bill_history.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="bill_history.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_billhistory']?></a></li>
                         <?php } ?>
                         
                          <?php if(in_array('kot_history', $_SESSION['menufullarray'])) { ?>    
                        <li><a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> kot_history.php <?php }else {  ?>#<?php } ?>" class="<?php if($linkname=="kot_history.php"){ ?>  active_right_mn <?php } ?>"><?=$_SESSION['home_kothistory']?></a></li>
                         <?php } ?>
                      </ul>
                    </li>
              </ul>
              </div><!--backto_table_select-->
       
      <div class="new_right_menu_overlay"></div> 
              
   <style>
   /**drop**/
  .right_quick_mn_head{
	  width:100%;
	  height:33px;
	  float:left;
	  text-align:center;
	  font-size:14px;
	  color:#fff;
	  line-height:33px;
	  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif !important;
	  background-color:#B31700 ;
	  border-bottom: 2px solid #FF0C00;
	  } 
.pusher{
	padding-top:10px;
	}   
 .pusher span {
  width:20px;
  height: 2px;
  display: block;
  background: #FFF;
  margin: 0 0 4px 0;
}

.pusher span:last-child { margin: 0; }

.pusher.click span:nth-of-type(1) {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
  margin: 10px 0 0 0;
}

.pusher.click span:nth-of-type(2) { opacity: 0; }

.pusher.click span:nth-of-type(3) {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
  margin: -12px 0 0 0;
}
  
   
.new_right_drop{
	width:30px;
	height:30px;
	border-radius:50%;
	background-color:#f00;
	margin-right:4px !important;
	margin-left:5px;
	/*background-image: linear-gradient(bottom, rgb(156, 19, 0) 0%, rgb(197, 68, 19) 100%);
    background-image: -o-linear-gradient(bottom, rgb(156, 19, 0) 0%, rgb(197, 68, 19) 100%);
    background-image: -moz-linear-gradient(bottom, rgb(156, 19, 0) 0%, rgb(197, 68, 19) 100%);
    background-image: -webkit-linear-gradient(bottom, rgb(156, 19, 0) 0%, rgb(197, 68, 19) 100%);
    background-image: -ms-linear-gradient(bottom, rgb(156, 19, 0) 0%, rgb(197, 68, 19) 100%);
        background-image: -webkit-gradient( linear, left bottom, left top, color-stop(0, rgb(156, 19, 0)), color-stop(1, rgb(197, 68, 19)) );*/
	 position: relative;
    z-index: 99999999;
	}
.backto_table_select ul{
    margin: 0;
    padding: 0;

	}
.dropdown .show{
	width: 300px !important;
	position: absolute;
     left: -268px;
    top: 35px;
	}	
.goto_backward_drop{
	width:100%;
	 list-style: none;
	}	

.goto_backward_drop a {
  text-decoration: none;
  overflow: hidden;
  font-size: 14px !important;
  font-family: 'CALIBRI_0' !important;
      font-weight: normal !important;
	      letter-spacing: 0;
}
.goto_backward_drop .dropdown-menu{min-width:inherit;width:100%;}
.dropdown [data-toggle="dropdown"] {
  position: relative;
  display: block;
  color: white;
 /* background: #2980B9;
  -moz-box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
  -webkit-box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
  box-shadow: 0 1px 0 #409ad5 inset, 0 -1px 0 #20638f inset;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);*/
  padding: 5px;
      padding-top:6px;
}

.dropdown .icon-arrow {
  position: absolute;
  display: block;
  font-size: 0.7em;
  color: #fff;
	top: 0;
    right: 0;
    opacity: 1;
    width: 29%;
    height: 100%;
    text-align: center;
    line-height: 30px;
      border-left: 1px rgba(255, 255, 255, 0.2) solid;
}
.dropdown .icon-arrow.open {
  -moz-transform: rotate(-180deg);
  -ms-transform: rotate(-180deg);
  -webkit-transform: rotate(-180deg);
  transform: rotate(-180deg);
  -moz-transition: -moz-transform 0.6s;
  -o-transition: -o-transform 0.6s;
  -webkit-transition: -webkit-transform 0.6s;
  transition: transform 0.6s;
  border:0;
}
.dropdown .icon-arrow.close {
  -moz-transform: rotate(0deg);
  -ms-transform: rotate(0deg);
  -webkit-transform: rotate(0deg);
  transform: rotate(0deg);
  -moz-transition: -moz-transform 0.6s;
  -o-transition: -o-transform 0.6s;
  -webkit-transition: -webkit-transform 0.6s;
  transition: transform 0.6s;
}
.dropdown .icon-arrow:before {
  content: '\25BC';
}
.dropdown .dropdown-menu {
  max-height: 0;
  overflow: hidden;
  list-style: none;
  padding: 0;
  margin: 0;
   list-style: none;
}
.dropdown .dropdown-menu li {
  padding: 0;
  text-align:center;
   list-style: none;
}
.dropdown .dropdown-menu li a {
  display: block;
  color: #6f6f6f;
  background: #fff;
  -moz-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
  -webkit-box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
  box-shadow: 0 1px 0 white inset, 0 -1px 0 #d5d5d5 inset;
  text-shadow: 0 -1px 0 rgba(255, 255, 255, 0.3);
  padding: 10px 10px !important;
}
.dropdown .dropdown-menu li a:hover {
  background: #f6f6f6;
}
.dropdown .show, .dropdown .hide {
  -moz-transform-origin: 50% 0%;
  -ms-transform-origin: 50% 0%;
  -webkit-transform-origin: 50% 0%;
  transform-origin: 50% 0%;
}
.dropdown .show {
  display: block;
  max-height: 9999px;
/*  -moz-transform: scaleY(1);
  -ms-transform: scaleY(1);
  -webkit-transform: scaleY(1);
  transform: scaleY(1);*/
/*  animation: showAnimation 0.5s ease-in-out;
  -moz-animation: showAnimation 0.5s ease-in-out;
  -webkit-animation: showAnimation 0.5s ease-in-out;*/
  -moz-transition: max-height 1s ease-in-out;
  -o-transition: max-height 1s ease-in-out;
  -webkit-transition: max-height 1s ease-in-out;
  transition: max-height 1s ease-in-out;
}
.dropdown .hide {
  max-height: 0;
  display:none;
/*  -moz-transform: scaleY(0);
  -ms-transform: scaleY(0);
  -webkit-transform: scaleY(0);
  transform: scaleY(0);*/
  animation: hideAnimation 0.4s ease-out;
  -moz-animation: hideAnimation 0.4s ease-out;
  -webkit-animation: hideAnimation 0.4s ease-out;
  -moz-transition: max-height 0.6s ease-out;
  -o-transition: max-height 0.6s ease-out;
  -webkit-transition: max-height 0.6s ease-out;
  transition: max-height 0.6s ease-out;
}

@keyframes showAnimation {
  0% {
    -moz-transform: scaleY(0.1);
    -ms-transform: scaleY(0.1);
    -webkit-transform: scaleY(0.1);
    transform: scaleY(0.1);
  }
  40% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  100% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
}
@-moz-keyframes showAnimation {
  0% {
    -moz-transform: scaleY(0.1);
    -ms-transform: scaleY(0.1);
    -webkit-transform: scaleY(0.1);
    transform: scaleY(0.1);
  }
  40% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  100% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
}
@-webkit-keyframes showAnimation {
  0% {
    -moz-transform: scaleY(0.1);
    -ms-transform: scaleY(0.1);
    -webkit-transform: scaleY(0.1);
    transform: scaleY(0.1);
  }
  40% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.04);
    -ms-transform: scaleY(1.04);
    -webkit-transform: scaleY(1.04);
    transform: scaleY(1.04);
  }
  100% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
}
@keyframes hideAnimation {
  0% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(0);
    -ms-transform: scaleY(0);
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
  }
}
@-moz-keyframes hideAnimation {
  0% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(0);
    -ms-transform: scaleY(0);
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
  }
}
@-webkit-keyframes hideAnimation {
  0% {
    -moz-transform: scaleY(1);
    -ms-transform: scaleY(1);
    -webkit-transform: scaleY(1);
    transform: scaleY(1);
  }
  60% {
    -moz-transform: scaleY(0.98);
    -ms-transform: scaleY(0.98);
    -webkit-transform: scaleY(0.98);
    transform: scaleY(0.98);
  }
  80% {
    -moz-transform: scaleY(1.02);
    -ms-transform: scaleY(1.02);
    -webkit-transform: scaleY(1.02);
    transform: scaleY(1.02);
  }
  100% {
    -moz-transform: scaleY(0);
    -ms-transform: scaleY(0);
    -webkit-transform: scaleY(0);
    transform: scaleY(0);
  }
}
/*.back_bill_his {margin-right:8px !important;}*/
.active_right_mn{    background-color: #FDEEA2!important;
    color: #000 !important;
}
.goto_backward_drop .dropdown-menu:before {right: 60px;display:none}
.new_right_menu_overlay{
	width:100%;
	height:100%;
	float:left;
	position:fixed;
	background-color:rgba(0,0,0,0.8);
	top:0;
	left:0;
	z-index:9999999;
	display:none;
	}
.show_block{
	display: block;
	}	
	
/***end***/
   </style>           
              
              
			  
<script>
// Dropdown Menu
var dropdown = document.querySelectorAll('.dropdown');
var dropdownArray = Array.prototype.slice.call(dropdown,0);
dropdownArray.forEach(function(el){
	var button = el.querySelector('a[data-toggle="dropdown"]'),
			menu = el.querySelector('.dropdown-menu'),
			arrow = button.querySelector('i.icon-arrow');

	button.onclick = function(event) {
		if(!menu.hasClass('show')) {
			menu.classList.add('show');
			menu.classList.remove('hide');
			arrow.classList.add('open');
			arrow.classList.remove('close');
			event.preventDefault();
		}
		else {
			menu.classList.remove('show');
			menu.classList.add('hide');
			arrow.classList.remove('open');
			arrow.classList.add('close');
			event.preventDefault();
		}
	};
})
$(document).ready(function(){
$(document).on("click" ,function(event) {
	$('.right_drop_menu').removeClass('show');
	$('.right_drop_menu').addClass('hide');
	$('.new_right_menu_overlay').removeClass('show_block');
	
	
	/*var button = el.querySelector('a[data-toggle="dropdown"]'),
			menu = el.querySelector('.dropdown-menu'),
			arrow = button.querySelector('i.icon-arrow');
    menu.classList.remove('show');
			menu.classList.add('hide');
			arrow.classList.remove('open');
			arrow.classList.add('close');
			event.preventDefault();*/
});
});
Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
};

$(".pusher").on("click" ,function(event) {
	$('.new_right_menu_overlay').toggleClass('show_block');
});
</script>