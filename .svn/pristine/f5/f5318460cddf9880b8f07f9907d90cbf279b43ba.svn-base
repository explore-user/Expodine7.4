<?php
$_SESSION['wateralertcount']=0;
$_SESSION['billalertcount']=0;
$_SESSION['sterdalertcount']=0;
$_SESSION['uraban_order_count']=0;
$_SESSION['qr_order_count']=0;
$_SESSION['inv_central_count']=0;


 if($_SESSION['s_phone_order_enable']=='Y'){ 
    require 'comet.php';
 }
 
?> 

<link rel="stylesheet" href="../master_style/themify-icons.css" type="text/css" />

<div class="notification_contain">
			<div class="notification_1">
			<a class="notificationLink" title="">
                    	<?php //if($_SESSION['sterdalertcount']!=0) { ?>
                            <span style="background-color: #e58c3f" class="notify_color_ico" id="all_notify" ><?php { echo ($_SESSION['billalertcount']+$_SESSION['uraban_order_count']+$_SESSION['qr_order_count']+$_SESSION['inv_central_count']); } ?></span>
                        <?php //} ?>
                    	<span class="notify_ico"><img src="img/notification_icon.png"></span>
                        <div class="disarw "></div>
                    </a>
   </div>

				<div class="notification_li">
					<div class="notificationContainer" style="top:21px">
					<div class="notificationTitle">New Notifications</div>
						<div class="notificationsBody notifications " >
                                        
			     <?php if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?>	
                                                    <a onclick="urban_go();"  href="#"><div class="notificationsrow">
                                                                <div class="notifications_lst_head">Online Order : <span  id="urban_count"><?php if(isset($_SESSION['uraban_order_count'])){echo $_SESSION['uraban_order_count'];} ?> </span></div>	
                                                                <div style="display:none" class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
			    <?php } ?>
                                                    
                                                    

                            <?php  if($_SESSION['qr_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?>
                               
                                                    
                                                        <a onclick="qr_go();"  href="#"><div class="notificationsrow">
								<div style="background-color:#7bdccf" class="notifications_lst_head">Qr Order : <span  id="qr_count"><?php if(isset($_SESSION['qr_order_count'])){echo $_SESSION['qr_order_count'];} ?></span></div>	
								<div style="display:none" class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>                
                                                    
                              <?php } ?>
                                     
                              <?php if($_SESSION['com_alerts']=='Y'){ ?> 
                                                    
                              <?php if(in_array("steward", $_SESSION['menusubarray'])) { ?>
							<a href="#"><div class="notificationsrow">
								<div style="background-color:#a1dc7b" class="notifications_lst_head">Steward : <span  id="stewrdrefreshcount"><?php if(isset($_SESSION['billalertcount'])){ echo $_SESSION['billalertcount']; } ?></span></div>	
								<div style="display:none" class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
			      <?php } ?>
                                                    
                              <?php if(in_array("bill", $_SESSION['menusubarray'])) {  ?>  

							<a href="#"><div class="notificationsrow">
								<div style="background-color:#ffc107" class="notifications_lst_head">Bill Alert : <span  id="billrefreshcount"><?php if(isset($_SESSION['billalertcount'])){ echo $_SESSION['billalertcount']; } ?></span></div>	
								<div style="display:none"  class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
                             <?php } ?>
                                                    
                              <?php } ?>                      
                                                    
                                                
                                 <?php if($_SESSION['ser_central_accept']=='Y'){  ?>
                               
                                                    
                                                   <a href="#"><div class="notificationsrow" style="display: flex;gap:10px">
                                                      <div style="background-color:#b10000" class="notifications_lst_head">Central Kitchen : <span  id="central_count"><?php if(isset($_SESSION['inv_central_count'])){ echo $_SESSION['inv_central_count'];} ?></span> </div>	
                                                              
                                                      <span> <img style="width: 20px;border: solid 1px;padding: 1px;" src="img/pInfo.png " title="Pending Data" onclick="load_central_accept();" >   </span>
                                                                
                                                     <span> <img style="width: 20px;border: solid 1px;padding: 1px;margin-left: 20px;" title="History" onclick="load_central_history();"  src="img/phistory.png " >  </span>
                                                                
                                                      <span style="display: none ;position: absolute;height: 96px;width: 260px;background-color: lightgray;flex-direction: column;bottom: -49%;left: -1px;font-size: 14px;overflow: auto;color:#555;" id="load_central" >
                                                                    
                                                    </span>
                                                                
                                                        <div style="display:none" class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
						</div></a>                
                                                    
                                 <?php } ?>              
                                                    
                                                    
					</div>
					</div>
					</div>
	            
</div>

 <div class="btn-group pull-right">
                <button class="btn_1 btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="hidden-sm hidden-xs cahier_txt"><?=$_SESSION['designtnname']?></span><br />
                                        <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs user-name-top"> <?=$_SESSION['expodine_id'] ?></span>
                                       
                    <?php $linkname	= basename($_SERVER['PHP_SELF']); ?>
            	 <?php  if($linkname!="menu_order.php" && $linkname!="order_split.php"){ ?> 
                    <span class="caret"></span>
                     <?php } ?>
                </button>

  <?php   if($linkname!="menu_order.php" && $linkname!="order_split.php"){ ?>  
   <ul class="dropdown-menu logout_drop">
<!--            <li><a style="text-align: left !important;font-size: 13px !important;" id="change_pass" href="#"><i class="ti-settings"></i> <span style="margin-left:5%">Change Password</span></a></li>-->
          <li><a class="langage_btn" style="text-align: left !important;font-size: 13px !important;" href="#"><i class="ti-world"></i> <span style="margin-left:5%">Change Language</span></a></li>
           <li><a style="text-align: left !important;cursor:pointer;font-size: 13px !important;" onClick="confirmation()" ><i class="ti-lock"></i> <span style="margin-left:5%">Logout</span></a></li>
   </ul>
    <?php } ?>
</div>

<!-- <div class="quick_navigation_section" >
                        
              <?php if(in_array("dinein", $_SESSION['menuarray'])) {    ?>
    
                       <div onclick="go_click('DI');" class="quick_navigation_nav_1 <?php if(basename($_SERVER['PHP_SELF'])=='table_selection.php'){ ?> qc_nav_act <?php } ?>">
                           <a href="#">
                           <div class="quick_navigation_nav_ico"><img src="img/mn_dn.png"></div>
                           <div class="quick_navigation_nav_text">DI</div>
                            </a>
                       </div>
              <?php } ?>
                       
              <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
    
           <div onclick="go_click('TA');" class="quick_navigation_nav_1 <?php if(basename($_SERVER['PHP_SELF'])=='take_away_.php'){ ?> qc_nav_act <?php } ?>">
                            <a href="#">
                           <div class="quick_navigation_nav_ico"><img src="img/mn_ta.png"></div>
                           <div class="quick_navigation_nav_text">TA</div>
                            </a>
                       </div>
              <?php } ?>
                       
             <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
    
                       <div  onclick="go_click('CS');" class="quick_navigation_nav_1 <?php if(basename($_SERVER['PHP_SELF'])=='counter_sales.php'){ ?> qc_nav_act <?php } ?>">
                           <a href="#">
                           <div class="quick_navigation_nav_ico"><img src="img/mn_cs.png"></div>
                           <div class="quick_navigation_nav_text">CS</div>
                           </a>
                       </div>
                       
             <?php } ?>
    
           <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?> 
                         <div onclick="go_click('BR');" class="quick_navigation_nav_1 <?php if(basename($_SERVER['PHP_SELF'])=='branch_settings.php'){ ?> qc_nav_act <?php } ?>">
                           <a href="#">
                           <div class="quick_navigation_nav_ico"><img src="img/setting_ico.png"></div>
                           <div class="quick_navigation_nav_text">Set</div>
                           </a>
                       </div>
    
                <?php } ?>
    
                       <div onclick="go_click('TR');" class="quick_navigation_nav_1 <?php if(basename($_SERVER['PHP_SELF'])=='troubleshoot.php'){ ?> qc_nav_act <?php } ?>">
                           <a href="#">
                           <div class="quick_navigation_nav_ico"><img src="img/trblshoot.png"></div>
                           <div class="quick_navigation_nav_text">Tro</div>
                           </a>
                       </div>
                       
                       
 </div> -->

	<div class="change_language_popup">
    	<div class="language_close_btn"></div>
    	<div class="select_language_headiing">Change Language</div>
        <div class="select_language_headiing_text"></div>
        
        <div class="change_language_btn" style="margin-bottom: 8px;">
        	<select class="change_language_btn_select langselchng" id="sellang"  >
            	
                <?php
			   $sql_login  =  $database->mysqlQuery("select ls_language from tbl_languages"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
					  ?>
                <option value="<?=$result_login['ls_language']?>" <?php if($_SESSION['main_language']==$result_login['ls_language']){ ?> selected="selected" <?php } ?> > <?=ucfirst($result_login['ls_language'])?></option>
              <?php } } ?>
                
            </select>
            
        </div>
        
         <div class="change_language_btn"><a href="#" class="change_language_ok_btn selectlanguagetotal ">Ok</a></div>
    
    </div>
    
<div class="language_overlay"></div>

<?php

///////// *********  payment overdue popup in clients *******/////
$pay_overdue='';
$sql_table_pt23="SELECT payment_overdue FROM tbl_version ";
		$sql_pt23  =  $database->mysqlQuery($sql_table_pt23); 
		$num_pt23  = $database->mysqlNumRows($sql_pt23);
		if($num_pt23){
			while($result_pt23  = $database->mysqlFetchArray($sql_pt23)) 
				{
					
				   $pay_overdue	 =$result_pt23['payment_overdue'];
				}
		}
                
 if($pay_overdue=='Y'){
     
     include_once 'overdue.php';

 } 

////*********payment alert end************* ///

 $time_base=  array();
 $sql_sms_show_t  =  $database->mysqlQuery("select tsr_time from tbl_sms_time_settings "); 
                    $num_sms_show_t  = $database->mysqlNumRows($sql_sms_show_t);
                    if($num_sms_show_t){ 
                        while($result_sms_show_t  = $database->mysqlFetchArray($sql_sms_show_t)) 
                        {
                            $time_base1=explode(':',$result_sms_show_t['tsr_time']);
                            $time_base[]=$time_base1[0].":".$time_base1[1];
                        }
                    } 
    
         $tm_ar=implode(',',$time_base);           
      
  ?>


<input type="hidden" value="<?=$_SESSION['be_kot_miss_check']?>" id="kot_miss_check" >

<input type="hidden" value="<?=$_SESSION['staff_online_order_permission']?>" id="staff_online_permission" >

<input type="hidden" value="<?=$_SESSION['cloud_menu_change']?>" id="cloud_menu_change" >

<input type="hidden" value="<?=$_SESSION['cloud_update_data_on']?>" id="cloud_sync_onoff" >

<input type="hidden" value="<?=$_SESSION["archive_enabled"]?>" id="archieve_onoff" >

<input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" >

<input type="hidden" value="<?=$_SESSION['s_daily_stock_concept']?>" id="stock_onoff" >

<input type="hidden" value="<?=date('Y-m-d');?>" id='fromdt'>

<input type="hidden" value="<?=date('Y-m-d');?>" id='todt'>

<input type="hidden" id="urban_on" value="<?=$_SESSION['urban_db_set']?>" >

<input type="hidden" id="qr_on" value="<?=$_SESSION['qr_db_set']?>" >

<input type="hidden" id="online_order_on" value="<?=$_SESSION['online_order_on']?>" >

<input type="hidden" id="relogin_code" value="<?=$_SESSION['inv_code']?>" >
 
<input type="hidden" id="central_kitchen_on" value="<?=$_SESSION['ser_central_kitchen']?>" >


<style>
    .alert_error_session{
	width: 250px;
	height: 230px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        
	background-color: #aafff7;
	text-align: center;
	padding: 20px 40px;
	padding-top: 20px;
	z-index: 99999;
	color: #fff;
	font-size: 14px;
	border-radius: 5px;
	font-family: sans-serif;
}
.alert_error_session:before{
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    background-color: rgb(0,0,0,0.8);
    content: '';
    z-index: -2;
}
</style> 
<strong  class="alert_error_session" style="display: none"> </strong>


 <style>
     
     
     
     
    .alert_error_popup_all_in_one{
	width: 250px;
	height: 80px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        
	background-color: #ff0000;
	text-align: center;
	padding: 20px 40px;
	padding-top: 20px;
	z-index: 99999;
	color: #fff;
	font-size: 14px;
	border-radius: 5px;
	font-family: sans-serif;
}
.alert_error_popup_all_in_one:before{
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

<strong id="alert_error_popup_all_in_one" class="alert_error_popup_all_in_one" style="display: none"> </strong>
 
     <input type="hidden" value="<?=$tm_ar?>" id="set_time"> 
     <input type="hidden" value="<?=$_SESSION['be_timely_sms_enable']?>" id="timely_enable"> 
     <input type="hidden" value="<?=$_SESSION['s_data_save']?>" id="save_data"> 
     
     <input type="hidden" value="<?=$_SESSION['com_alerts']?>" id="com_alerts">
     
     <!-- <input type="hidden" value="<?=$_SESSION['ser_central_accept']?>" id="central_accept_onoff" > -->
     
    
     
<script>

$(document).ready(function(){
    
    
      /////logout on dayclose for all users /////
     $.post("../load_index.php", {set:'check_day_logout'},
		function(data35)
		{ 
		     var data=data35.trim();
                  
		   if(data=="dayclosed1")
		   { 
                       $('.alert_error_session').css('display','block');
                                                                    
                       $('.alert_error_session').text('SALE ALREADY CLOSED . ');
                                                                    
                      setTimeout(function(){
                           
                        $('.alert_error_session').css('display','none'); 
                        
                          window.location.href ="../logout.php";   
                      
                     }, 2000);
                  }
    });
    
    
    ///page auto session refresh load///
    var url_check=$('#url_check').val();
    
    if(url_check.includes("consolidatedreport.php") || url_check.includes("journals-details.php") || url_check.includes("voucher_view.php") || url_check.includes("employee_voucher.php") || url_check.includes("expense_voucher.php") || url_check.includes("load_ledger_sheet.php") || url_check.includes("daybook.php") ){
       
   }else{
       
       setInterval(function() {
        
        window.location.href= window.location.href;
          
      }, 300000);
      
   }
    ///page auto session refresh load ends///
    
    
     setInterval(function() {
      if($('#relogin_code').val()!='' && $('#relogin_code').val()!='undefined' && $('#relogin_code').val()!=undefined){
          
        localStorage.pin_relogin=$('#relogin_code').val();   
        
             }
      }, 500); 
       
    
$(".language_close_btn").click(function(e){
	  e.preventDefault();
	 $(".change_language_popup").css("display","none");
	  $(".language_overlay").css("display","none");
  });
  
  $(".langage_btn").click(function(){
	  $(".change_language_popup").css("display","block");
	  $(".language_overlay").css("display","block");
  });
  
  
  $(".selectlanguagetotal").click(function(){
     
	 var lg= $("#sellang").val();
       
	  if(lg!="Change")
	 {
		   $("#hidlanguage").val(lg);
		   $.post("../load_index.php", {value:'set_language',lang:lg},
                 
		  function(data)
		  {
		  data=$.trim(data);
			
		  });
		   lg = lg.charAt(0).toUpperCase() + lg.slice(1);
		   $(".langage_btn").html(lg);
                   
	 }else
	 {
            $(".langage_btn").html("Select Language"); 
	 }
	 
	   $(".change_language_popup").css("display","none");
	  $(".language_overlay").css("display","none");
      
     $('#lgpop').show();   
    
  });



  var timely_enable=$('#timely_enable').val();
      if(timely_enable=="Y"){
          
   setInterval(function() {
        
        var time_in=$('#set_time').val();
        var dt = new Date();
        
        if(dt.getHours()<10){
            var h="0";
        }else{
            h="";
        }
        
        if(dt.getMinutes()<10){
            var h1="0";
        }else{
            h1="";
        }
        
        var cur_time=h+dt.getHours() + ":" + h1+dt.getMinutes();
        
        var sp_t=time_in.split(',');
        for(var i=0;i<sp_t.length;i++){
    
     
       if(sp_t[i]==cur_time){
             
       var data="set_msg=timely_msg&msg_time="+sp_t[i];
     
       $.ajax({
        type: "POST",
        url: "timely_sms_report.php",
        data: data,
        success: function(data3)
        {  
           
        }
    });
    
     var data1="set_msg=timely_msg&msg_time="+sp_t[i];
      
       $.ajax({
        type: "POST",
        url: "timely_email_report.php",
        data: data1,
        success: function(data2)
        {  
          
        }
    });
    
         
          }
          
          }
      
      
       }, 15000);
       
       }
       
  
 });
 
 
 
 function close_central(){
    $('#load_central').hide();
                           
     $('#load_central').html('');
 }
 
 
 function load_central_history(){
      
       window.parent.location.href ="inventory/central_history.php";
 }


 function urban_go(){
   window.parent.location.href ="customer_display/online_order_screen.php";
 }
 
 
 function qr_go(){
   window.parent.location.href ="customer_display/qr_order_screen.php";
 }




 function central_go(id){
    
    var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "inventory/load_inventory.php",
        data: data,
        success: function(data)
        { 
           
    if($.trim(data)=='yes'){
     window.parent.location.href ="inventory/central_accept.php?cnt_id="+id;
   
    }else{
          
      alert('CHECK INTERNET & SYNC CENTRAL KITCHEN');
     
    }
    
    
     }
    });
   
}


 function load_central_accept(){
     
      $('#load_central').css('display','flex');
                           
      $('#load_central').html('Loading Data...');
                            
      $.ajax({
			type: "POST",
			url: "../load_index.php",
			data: "set=check_central_accept",
			success: function(msg)
			{
                           //$('#load_central').show();
                           
                            $('#load_central').html($.trim(msg));
                        }
                    });
     
    }
    
</script>

 <div  class="del_contain_pop" id="lgpop" style="display:none" >
      
  <div class="delete_con_pop" style="width:300px;height:135px">
    <span>Language Changed Successfully </span>
    <a href="../index.php" style="cursor:pointer;margin-top:26px" ck="ok" id="btn1" class="banq_print_view_btn_1" >OK</a> 
 </div>
     
 </div> 

 <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >

 <div style="display:none" class="change_password_popup">
       <h3>Change Password</h3>
       <form name="top"  role="form" action="load_divmaster.php"  method="post" >
           
       <?php
	  
	  $sql_login  =  $database->mysqlQuery("select ls_password from tbl_logindetails where ls_username='".$_SESSION['expodine_id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		 {
			   $pswrd=$result_login['ls_password'];
			
                 ?>
       <input type="hidden" name="oldpass" id="oldpass" class="menuname" style="color:black" value="<?=$pswrd?>">
    	 <?php }} ?>
       
    <div class="change_popup_content">
    
    	<div class="edit_menu_label" id="old_div" >
                 <div class="label_main_member_edit">Old Password <span style="color:#F00">*</span></div>
                   <input class="form-control_main"  placeholder="Old Password" type="password" name="old" id="old" value="" onchange="old_pswrdcheck()" >
         </div><!---edit_menu_label-->
         <div class="edit_menu_label" id="new_password_div" >
                 <div class="label_main_member_edit">New Password <span style="color:#F00">*</span></div>
                   <input class="form-control_main"  placeholder="New Password" type="password" value="" id="new" name="new" onchange="checkn_change('new_password_div','new')">
         </div>
         <div class="edit_menu_label" id="confpassword_div" >
                 <div class="label_main_member_edit">Confirm Password <span style="color:#F00">*</span></div>
                   <input class="form-control_main"  placeholder="Confirm Password" type="password" value="" name="confirmps" id="confirmps" onChange="checkn_change('confpassword_div','confirmps')">
         
         </div>
         <div class="change_pass_pop_btn">
             <input type="hidden" name="userid" id="userid" class="menuname" style="color:black" value="<?=$_SESSION['expodine_id']?>">        
                        
         		<a href="#" onclick="validate_submit()"> <div class="pop_btn_new_1">Save</div></a>
                <a id="cancel_change_pass" href="#"><div class="pop_btn_new_1">Cancel</div></a>
         </div>
         
    </div>
    </form>
 </div>
 
 <div class="change_pass_overlay"></div>
 
 <div>
     
   <?php if($_SESSION['com_alerts']=='Y'){ ?>
    <audio id="chatAudio"><source src="notify.ogg" type="audio/ogg"></audio>
   <?php }  ?>
          
  <?php  if($_SESSION['online_order_on']=='Y'){ ?>
  <audio id="urbanAudio"><source src="urban.ogg" type="audio/ogg"></audio>
  <?php } ?>
  
   <!-- <?php // if($_SESSION['ser_central_accept']=='Y'){ ?>
  <audio id="centralAudio"><source src="central.ogg" type="audio/ogg"></audio>
  <?php// } ?> -->
 
  </div>
 
 
 <div  class="online_order_popup_secg master_pop_new" style="display:none">

   <div class="online_order_popupg">
       <div class="online_order_popup_headg"> <a style="    border: solid 1px black;padding: 2px;    border-radius: 5px;" href="../index.php"> <img style="margin-top: -8px;margin-left: 5px;" src="img/home_ico_1.png"> </a> &nbsp; &nbsp;  QUICK NAVIGATIONS
             <a  onclick="close_master();" href="#"><div  class="online_order_popup_clsg"><img style="background-color: #d74949;width: 104%;border-radius: 31px;" src="img/black_cross.png" alt=""></div></a>
         </div>   
       
     <div class="online_order_popup_contantg" >
         
     <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?>     
     <a href="branch_settings.php"><div class="online_order_boxg"><span style="display:block"><img src="img/settings.png" /></span>GENERAL SETTINGS</div></a>
      <?php } ?> 
     
     <?php   if(in_array("staff_master", $_SESSION['menusubarray'])) { ?>       
     <a href="staff_master.php"><div class="online_order_boxg"><span style="display:block"><img src="img/staff.png" /></span>STAFF MASTER</div></a>
       <?php } ?> 
     
     <?php if(in_array("table_master", $_SESSION['menusubarray'])) { ?>       
     <a href="table_master.php"><div class="online_order_boxg"><span style="display:block"><img src="img/chair.png" /></span>TABLE MASTER</div></a>
     <?php } ?> 
     
     
      <?php if(in_array("Menu Masters", $_SESSION['menumodarray']) && (in_array("menu", $_SESSION['menusubarray']))) { ?> 	
     <a href="menu.php"><div class="online_order_boxg"><span style="display:block"><img src="img/menu.png" /></span>ITEM MASTER</div></a>
      <?php } ?> 
     
     <?php if(in_array("Consolidated Reports", $_SESSION['menumodarray'])) { ?> 
     <a href="consolidatedreport.php"><div class="online_order_boxg"><span style="display:block"><img src="img/report.png" /></span>REPORTS</div></a>
     <?php } ?> 
     
    <?php if(in_array('printer_master', $_SESSION['menufullarray'])) { ?>
     <a href="printer_master.php"><div class="online_order_boxg"><span style="display:block"><img src="img/printer1.png" /></span>PRINTER MASTER</div></a>
     <?php } ?> 
     
      <?php if(in_array("inventory", $_SESSION['menuarray'])) {  ?> 
     <a href="inventory/index.php"><div class="online_order_boxg"><span style="display:block"><img src="img/inventory.png" /></span>INVENTORY</div></a>
        <?php } ?> 
     
     <?php  if(in_array("CONSOLIDATED KOT HISTORY", $_SESSION['menumodarray']) ) { ?>  
     <a href="cons_kot_history.php"><div class="online_order_boxg"><span style="display:block"><img src="img/kot.png" /></span>KOT HISTORY</div></a>
      <?php } ?> 
     
     <?php if(in_array("registration", $_SESSION['menuarray'])) { ?> 
     <a href="loyalty/index.php"><div class="online_order_boxg"><span style="display:block"><img src="img/loyality.png" /></span>LOYALTY</div></a>
     <?php } ?> 
     
     
     </div> 
            
   </div>                                                     

</div>
 
 <style>
    .online_order_btng{
    width: 110px;
    height: 38px;
    color: #000;
    text-align: center;
   float:left;
   line-height: 36px;
    background-color: #f90;
    text-transform: uppercase;
    border-radius: 7px;
    margin-right:10px;
    margin-top:1px;
    font-size:12px;    
    font-weight: bold;
}

.online_order_popup_secg{
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    position: fixed;
    top: 0;
    z-index: 999999999999;
}
.online_order_popupg{
    position: fixed;
    height: auto;
    max-width:510px;
    width: 95%;
    background-color: #f4f4f4;
    color: #000;
    text-transform: none;
    top: 10%;
    text-align: center;
    padding-top: 10px;
    right: 0;
    left: 0;
    font-weight: bold;
    font-size: 15px;
    margin: auto;
    border-radius: 5px;
    padding-bottom:20px
}
.online_order_popup_headg{
    width:100%;
    height:auto;
    text-align:center;
    padding:10px 0;
    color:#242424;
    font-size:18px;
    float:left;
    position:relative;
}
.online_order_popup_clsg{
    width:30px;
    height:30px;
    position:absolute;
    right:5px;
    top:5px;
}
.online_order_popup_clsg img{width:100%}
.online_order_popup_contantg{
    width:100%;
    height:auto;
    float:left;
    padding:20px;
}
.online_order_boxg{
    width:29%;
    padding:20px 10px;
    background-color:#274b4e;
    border:solid 1px #ccc;
    font-size:13px;
    float:left;
    text-transform:uppercase;
    margin:10px;
    box-shadow: 3px 3px 10px #bfbfbf;
    border-radius: 5px;
    color: #c5c5be;
    height: 110px;
}
     
 </style>
 
 <style>
 aside{z-index:0 !important}
 .tab_table_cont_cc{z-index:0 !important}
 .add_btn_cc_2{z-index:1 !important}
 .incread_disable{z-index:1 !important}
 .change_pass_overlay{
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 width:100%;
	 height:100%;
	 top:0;
	 left:0;
	 z-index:999999;
	 display:none;
	 }
 .change_password_popup{
    width: 550px;
    height: 315px;
	 margin:auto;
	 position:fixed;
	 left:0;
	 right:0;
	 top:20%;
	 background-color:#fff;
	 z-index:9999999;
	 display:none;
	 }
.change_password_popup h3 {
    margin: 0;
    padding: 0.4em;
    text-align: center;
    font-size: 1.4em;
    font-weight: 300;
    opacity: 0.8;
    background: rgba(0,0,0,0.2);
    border-bottom: 1px #9A9898 solid;
    border-radius: 3px 3px 0 0;
	color:#000;
}
.change_popup_content{
	width:100%;
	height:auto;
	float:left;
	padding:2%;
	}
.label_main_member_edit {
    width: 100% !important;
    line-height: 25px !important;
    font-family: 'Arimo';
    font-size: 14px;
    color: #333;
    padding-left: 5px;
    padding-top: 4px;
}
.edit_menu_label {
    width: 100%;
    height: auto;
    float: left;
    margin-bottom: 10px;
}
.form-control_main {
    display: block;
    width: 100%;
    float: left;
    height: 34px;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 12px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;

}	
.change_pass_pop_btn{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	margin-top:-2px;
	}

.pop_btn_new_1 {
       width: 130px;
    height: 37px;
    display: inline-block;
    margin: auto;
    background-color: #891500;
    color: #fff;
    text-align: center;
    line-height: 36px;
    font-size: 17px;
    border-radius: 5px;
    margin: 1%;
    cursor: pointer;
}	

.logout_drop{padding-bottom:0}
.logout_drop li{text-align:left !important}
.logout_drop a{border-bottom:1px #ccc solid;height:35px !important;line-height:31px !important;font-size:13px !important;font-family:Arial, Helvetica, sans-serif}
.logout_drop  {
    top: auto !important;
    bottom:auto !important;
}
.logout_drop:before {
    top: -7px !important;
    bottom: auto;
    border: 0 !important;
    z-index: -1;
}
.has-error input{color:#FF0500;border-color:#FF0500;background-color:#f2dede;outline:#F00;}

.del_contain_pop{
	width:130%;
	height:120%;
	background-color:rgba(0,0,0,0.6);
	position:fixed;
	top:0;
	  z-index:999999999999;
	    display:none;

	}
.delete_con_pop{
	 position:fixed;
	 height:60px;
	 width:40%;
	 background-color:#fff;
	  color:#000;
	  text-transform:none;
	 /* margin-top: -32px;*/
	  top: 50%;
	  text-align: center;
	  padding-top: 10px;
	  right:0;
	  left:0;
	  font-weight: bold;
	  font-size:15px;
	  margin:auto;
	    border-radius: 5px;
	  border: solid 1px #07bf29;
	  }
.delete_con_pop a{
	  color: #FFF;
  background-color: #C73500;
  display: inline-block;
padding: 9px 22px;
  border-radius: 7px;
}
.delete_con_pop a:hover{background-color:#F00;color:#fff}  
 </style>
 
<script src="../js/crptmd5.js"></script> 
<script>
$("#change_pass").click(function(){
    $(".change_pass_overlay").show();
    $(".change_password_popup").show();
	
});

$("#cancel_change_pass").click(function(){
    $(".change_pass_overlay").hide();
    $(".change_password_popup").hide();
});

function old_pswrdcheck()
{

		var old=CryptoJS.MD5($('#old').val());
		
		var oldpaswrd=$('#oldpass').val();

	if(old != oldpaswrd)
	{
		 $("#old_div").addClass("has-error");
				     document.top.old.focus();
			  return false;
	}
	else
	{
		 $("#old_div").removeClass("has-error");
				  $("#old_div").addClass("has-success");
				  return true;
		
	}
}

function checkn_change(divid,controlid)
{
  if(document.getElementById(controlid).value=="")
	{
		$("#"+divid).addClass("has-error");
		$("#"+divid).removeClass("has-success");
	}else
	{
		
	$("#"+divid).removeClass("has-error");
	$("#"+divid).addClass("has-success");
	}
        
	if(divid=='confpassword_div')
	{
		
		if(document.getElementById("new").value!="")
		  {
			  if(document.getElementById("new").value!=document.getElementById("confirmps").value)
			  {
				   $("#confpassword_div").addClass("has-error");
			  	   document.top.confirmps.focus();
			  	   return false;
			  }else
			  {
				  $("#confpassword_div").removeClass("has-error");
				  $("#confpassword_div").addClass("has-success");
				  if($("#new_password_div").hasClass("has-error"))
			       {
			          $("#new_password_div").removeClass("has-error");
			       }
				  $("#new_password_div").addClass("has-success");
			
			  	  return true;
			  }
			  
		  }else
		  {
			  $("#new_password_div").addClass("has-error");
			  document.top.new.focus();
			
		  }
	}
	else
	{
	     if(document.getElementById("new").value!="")
		  {
			  
			  if(document.getElementById("confirmps").value!="")
		          {
			  
			  if(document.getElementById("new").value!=document.getElementById("confirmps").value)
			  {
				   $("#new_password_div").addClass("has-error");
			  	   document.top.new.focus();
			  	   return false;
			  }else
			  {
                              
			      $("#confpassword_div").removeClass("has-error");
			      $("#confpassword_div").addClass("has-success");
                                  
			      if(("#new_password_div").hasClass("has-error"))
			      {
			       $("#new_password_div").removeClass("has-error");
			      }
				  $("#new_password_div").addClass("has-success");
			
			  	return true;
			  }
			  
		  }
		  else
		  {
			   $("#confpassword_div").addClass("has-error");
			   document.top.confirmps.focus();
		  }
			  
		  }else
		  {
			  $("#new_password_div").addClass("has-error");
			  document.top.new.focus();
			
		  }
		
	}
	
}


function validate_submit()
{
	
	if(old_pswrdcheck() )
	{
	
       if(($('#new_password_div').hasClass("has-success")))
			
	  {
                            
	  if( ($('#confpassword_div').hasClass("has-success")))
	   {
				
	   var userid=$('#userid').val();
	 

		var nw=$('#new').val();
	
	   
			  $.post("load_divmaster.php", {value:'chng_paswrd',userid:userid,nw:nw},
				  function(data)
				  {
                                      
				  data=$.trim(data);
			
				  });  
				  
				   $(".change_pass_overlay").hide();
	                           $(".change_password_popup").hide();
	}
	}
	}
}

</script>



<script type="text/javascript" >
$(document).ready(function()
{
    
$(".billarertcall").click(function()
{	
	
   $(".disarw_1").removeClass('btm_arrow');
        $(".disarw").removeClass('btm_arrow');
	$(".disarw_2").toggleClass('btm_arrow');
	
	window.parent.$('a iframe').addClass('loadzindex');
	$(".class").css("z-index",'99999');
	$(".notificationContainer_2").fadeToggle(300);
	$(".notification_count").fadeOut("slow");
	$(".notificationContainer_1").hide();
	$(".notificationContainer").hide();
	
	return false;

});




$(".notificationLink").click(function()
{
	$(".disarw_1").removeClass('btm_arrow');
	$(".disarw_2").removeClass('btm_arrow');
	$(".disarw").toggleClass('btm_arrow');
	
	window.parent.$('a iframe').addClass('loadzindex');
	$(".class").css("z-index",'99999');
	$(".notificationContainer").fadeToggle(300);
	$(".notification_count").fadeOut("slow");
	$(".notificationContainer_1").hide();
	$(".notificationContainer_2").hide();
	
	return false;
});


$(".notificationContainer_1").click(function()
{

return false
});


$(".notificationLink_1").click(function()
{
	window.parent.$('a iframe').addClass('loadzindex');
	$(".class").css("z-index",'99999');
	$(".disarw_1").toggleClass('btm_arrow');
	$(".disarw").removeClass('btm_arrow');
	$(".disarw_2").removeClass('btm_arrow');
	
$(".notificationContainer_1").fadeToggle(300);

$(".notificationContainer").hide();
$(".notificationContainer_2").hide();
return false;
});



$(document).click(function()
{
    
window.parent.$('a iframe').removeClass('loadzindex');
$(".notificationContainer_1").hide();
$(".notificationContainer").hide();
$(".notificationContainer_2").hide();
$(".disarw_1").removeClass('btm_arrow');
$(".disarw_2").removeClass('btm_arrow');
$(".disarw").removeClass('btm_arrow');

});

$(".notificationContainer_1").click(function()

{
return false
});
$(".notificationContainer_2").click(function()

{
return false
});

$(".notificationContainer").click(function()

{
return false
});

});

function close_master(){
      $('.master_pop_new').hide();
       $(".language_overlay").css("display","none");
}

function go_click(mode){
    
    if(mode=='DI'){
    
        window.location.replace('table_selection.php');
    }
    
    if(mode=='TA'){
        
           window.location.replace('take_away_.php');
    }
    
     if(mode=='CS'){
       
         window.location.replace('counter_sales.php');
    }
    
     if(mode=='BR'){
        
          $('.master_pop_new').show();
          $(".language_overlay").css("display","block");
    }
    
     if(mode=='TR'){
         
        window.location.replace('troubleshoot.php');
    }
     
}
</script>