<?php session_start(); 
include("../database.class.php"); // DB Connection class
$database	= new Database();

?>

<style>

	
html{
	  overflow: visible;
 /* height: 100vh;*/
	}
body{
	/*  height: 100vh;*/
 
  background-color: transparent !important;
	}		
.loadzindex
{
	z-index:99999 !important;
}
.notification_contain{margin-right:120px !important}

</style>

<link  href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="../btn/default.css" />
<script src="../js/jquery-1.10.2.min.js"></script>
 <script>
  $(document).ready(function() {
	$('.class').click(function()
{
 var tbl   =  $(this).attr("tbl");
 var tbl1	  =	 tbl.split("_");
 var tablenam       =  tbl1[1];
 
 var tim   =  $(this).attr("tim");
 var tim1	  =	 tim.split("_");
 var timealert       =  tim1[1];
 
  var not   =  $(this).attr("not");
 var not1	  =	 not.split("_");
 var notalert       =  not1[1];

$.ajax({
	   type: "POST",
	   url: "../autoload_menu.php",

	   data: "set=insert&tabl="+tablenam+"&time="+timealert+"&not="+notalert,
	   success: function(msg)
	   {
		   if(notalert=="10")
		   {
				$('.popup_1').html(msg);
		   }else if(notalert=="9")
		   {
			   $('.pop_water').html(msg);
		   }else if(notalert=="8")
		   {
			   $('.pop_bil').html(msg);
			   window.parent.location="../payment_pending.php"; 
		   }
		   return false;
	   }
   });

});



	
	$.post("../autoload_menu.php", {set:'autoload'},
					function(data)
					{
					data=$.trim(data);
					});
                                        
                                        
                                        
                                        
       var com_alerts=$('#com_alerts').val();
       
                           
            if(com_alerts=='Y'){     
                
                
                $.post("../autoload_menu.php", {set:'copyfolders'},
					function(data)
					{//$('#chatAudio')[1].play();alert("h");
					data=$.trim(data);

					});
                
    $.post("../autoload_menu.php", {set:'stewrdalertrefresh'},
					function(data)
					{
					data=$.trim(data);
					$('#stewrdrefreshcount').html(data);
					$('#stwnot').html(data);
														  
					});
                                        
	$.post("../autoload_menu.php", {set:'wateralertrefresh'},
					function(data)
					{
					data=$.trim(data);
					$('#waterrefreshcount').html(data);	
					$('#wtnot').html(data);									  
					});	
	$.post("../autoload_menu.php", {set:'billalertrefresh'},
					function(data)
					{
                                            
					data=$.trim(data);
					$('#billrefreshcount').html(data);	
					$('#blnot').html(data);									  
					});	
                                        
                                        
	/*$.post("../autoload_menu.php", {set:'kotalertrefresh'},
					function(data)
					{
					data=$.trim(data);
					$('#kotrefreshcount').html(data);	
					$('#ktnot').html(data);									  
					});	*/
	
    }
	  
  setInterval(function() {
      	
                  if(com_alerts=='Y'){        
                      
                      
                            
$.post("../autoload_menu.php", {set:'copyfolders'},
					function(data)
					{//$('#chatAudio')[1].play();alert("h");
					data=$.trim(data);

					});
                                        
    $.post("../autoload_menu.php", {set:'stewrdalertrefresh'},
					function(data)
					{//$('#chatAudio')[1].play();alert("h");
					data=$.trim(data);
					
					
					if($('#soundnotify').val()=="Y")
					{
						if(data>0)
						{
							 $('#chatAudio')[0].play();
						}
					}
					$('#stewrdrefreshcount').html(data);
					$('#stwnot').html(data);
														  
					});	
	$.post("../autoload_menu.php", {set:'wateralertrefresh'},
					function(data)
					{
					data=$.trim(data);
					if($('#soundnotify').val()=="Y")
					{
						if(data>0)
						{
							 $('#chatAudio')[0].play();
						}
					}
					$('#waterrefreshcount').html(data);	
					$('#wtnot').html(data);									  
					});	
	$.post("../autoload_menu.php", {set:'billalertrefresh'},
					function(data)
					{
					data=$.trim(data);//alert(data)
					if($('#soundnotify').val()=="Y")
					{
						if(data>0)
						{
							 $('#chatAudio')[0].play();
						}
					}
                                        //alert('2');
					$('#billrefreshcount').html(data);	
					$('#blnot').html(data);									  
					});	
	/*$.post("../autoload_menu.php", {set:'kotalertrefresh'},
					function(data)
					{
					data=$.trim(data);
					$('#kotrefreshcount').html(data);	
					$('#ktnot').html(data);									  
					});	*/
	/* $.post("../autoload_menu.php", {set:'autoload'},
					function(data)
					{
					data=$.trim(data);
					});*/	  
		$.post("../autoload_menu.php", {set:'autorefreshalerts',not:'10'},
					function(data)
					{
					data=$.trim(data);
					$('.popup_1').html(data);							  
					});	
			$.post("../autoload_menu.php", {set:'autorefreshalerts',not:'9'},
					function(data)
					{
					data=$.trim(data);
					$('.pop_water').html(data);							  
					});	
					$.post("../autoload_menu.php", {set:'autorefreshalerts',not:'8'},
					function(data)
					{
					data=$.trim(data);
					$('.pop_bil').html(data);							  
					});	
					
    }	
		}, 20000); 
                
               
                
});
</script>


<input type="hidden" value="<?=$_SESSION['com_alerts'] ?>" id="com_alerts" >


<div class="notification_contain">
			<div class="notification_1">
			<a class="notificationLink" title="">
                    	<?php //if($_SESSION['sterdalertcount']!=0) { ?>
                    	<span class="notify_color_ico" id="stewrdrefreshcount"><?php if(isset($_SESSION['billalertcount'])){ echo $_SESSION['billalertcount']; } ?></span>
                        <?php //} ?>
                    	<span class="notify_ico"><img src="../img/notification_icon.png"></span>
                        <div class="disarw "></div>
                    </a>
                </div>


				<div class="notification_li">
					<div class="notificationContainer" style="top:37px">
					<div class="notificationTitle">New Notifications</div>
						<div class="notificationsBody notifications " >
								
							<a href="#"><div class="notificationsrow">
								<div class="notifications_lst_head">QR Order</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
							<a href="#"><div class="notificationsrow">
								<div class="notifications_lst_head">QR Order</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
							<a href="#"><div class="notificationsrow">
								<div style="background-color:#a1dc7b" class="notifications_lst_head">Steward</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
							<a href="#"><div class="notificationsrow">
								<div style="background-color:#7bdccf" class="notifications_lst_head">Online Order</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>

							<a href="#"><div class="notificationsrow">
								<div style="background-color:#7bdccf" class="notifications_lst_head">Online Order</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>
							<a href="#"><div class="notificationsrow">
								<div style="background-color:#7bdccf" class="notifications_lst_head">Online Order</div>	
								<div class="notifications_lst_txt">New notification - 12:35 pm / 13-08-21</div>
							</div></a>

						</div>
					</div>
					</div>
				
                
</div>



<div  class="notification_contain" style="display:none">
            
                 <?php if(in_array("bill", $_SESSION['menusubarray'])) { ?>
              	<div class="notification_1">
                	<a  class="billarertcall" >
                    	<span class="notify_color_ico" id="billrefreshcount"><?php if(isset($_SESSION['billalertcount'])){ echo $_SESSION['billalertcount']; } ?></span>
                    	<span class="notify_ico"><img src="../img/bill_ico.png"></span>
 					<div class="disarw_2 "></div>
                    </a>
                </div>
                <?php } ?>
                <?php if(in_array("steward", $_SESSION['menusubarray'])) {  ?>  
                <div class="notification_1">
                	<a class="notificationLink" title="">
                    	<?php //if($_SESSION['sterdalertcount']!=0) { ?>
                    	<span class="notify_color_ico" id="stewrdrefreshcount"><?php if(isset($_SESSION['billalertcount'])){ echo $_SESSION['billalertcount']; } ?></span>
                        <?php //} ?>
                    	<span class="notify_ico"><img src="../img/steward_ico.png"></span>
                        <div class="disarw "></div>
                    </a>
                </div>
                
                
                <?php } ?>
                
                 
<script type="text/javascript" >
$(document).ready(function()
{


	
$(".billarertcall").click(function()
{	
	
   $(".disarw_1").removeClass('btm_arrow');
   $(".disarw").removeClass('btm_arrow');
	$(".disarw_2").toggleClass('btm_arrow');
	//$($topLevel).addClass('123');
	window.parent.$('a iframe').addClass('loadzindex');
	$(".class").css("z-index",'99999');
	$(".notificationContainer_2").fadeToggle(300);
	$(".notification_count").fadeOut("slow");
	$(".notificationContainer_1").hide();
	$(".notificationContainer").hide();
	//$("iframe").click();
	return false;

});
$(".kotarertcall").click(function()
{	
	$.ajax({
	   type: "POST",
	   url: "../autoload_menu.php",
	   data: "set=kotaretupdate",
	   success: function(msg)
	   {
		   window.parent.location="../kot_checklist.php";
	   }
   });

});


$(".notificationLink").click(function()
{
	
	$(".disarw_1").removeClass('btm_arrow');
	$(".disarw_2").removeClass('btm_arrow');
	$(".disarw").toggleClass('btm_arrow');
	//$($topLevel).addClass('123');
	window.parent.$('a iframe').addClass('loadzindex');
	$(".class").css("z-index",'99999');
	$(".notificationContainer").fadeToggle(300);
	$(".notification_count").fadeOut("slow");
	$(".notificationContainer_1").hide();
	$(".notificationContainer_2").hide();
	//$("iframe").click();
	return false;
});

//Popup Click
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
	//$("iframe").css('height','600vh');
$(".notificationContainer_1").fadeToggle(300);
//$(".notify_color_ico").hide("slow");
$(".notificationContainer").hide();
$(".notificationContainer_2").hide();
return false;
});

//Document Click
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


//Popup Click
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

function urban_go(){
   window.parent.location.href ="../customer_display/online_order_screen.php";
}
function qr_go(){
   window.parent.location.href ="../customer_display/qr_order_screen.php";
}
</script>
                
 <input type="hidden" name="soundnotify" id="soundnotify" value="<?=$_SESSION['s_sound_notification'] ?>" />
<div class="notification_li">
<div class="notificationContainer" style="top:37px">
<div class="notificationTitle">Steward- <span id="stwnot"><?=$_SESSION['sterdalertcount']?></span> New Notifications</div>
<div class="notificationsBody notifications popup_1" >
<?php
$curdt=date("Y-m-d");
 $sql_stwrd  =  $database->mysqlQuery("Select tbl_notifications.tbl_notificationtype,tbl_tablemaster.tr_tableno,tbl_tablemaster.tr_tableid, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime, tds.ts_tableidprefix as prefix From tbl_notifications left Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid left Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid left Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid left join tbl_tabledetails tds on tds.ts_tableid=tbl_notifications.tbl_tableid Where tbl_modulesubmaster.mser_submodulelink = 'steward' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							  $rd=0;
							  if($result_stwrd['tbl_readby']!="")
							  {
								 $timestamp = strtotime($result_stwrd['tbl_readtime']);
								 $_5minuteslater = time() + 5 * 60;//< time()-300 
								 $totalval= $_5minuteslater - $timestamp;
								 if($totalval<1000)
								 {
									 $rd=0;
								 }else
								  {
									 $rd=1; 
								  }
							  }
							  ?>
    <?php if($rd==0){ ?>
	<a href="#" <?php if($result_stwrd['tbl_readby']==""){ ?>class="class" tbl="tbl_<?=$result_stwrd['tr_tableid']?>" tim="tm_<?=$result_stwrd['tbl_inserttime']?>" not="not_<?=$result_stwrd['tbl_notificationtype']?>" <?php } ?>>
    <div class="notification_cont_list <?php if($result_stwrd['tbl_readby']!=""){ ?> notiify_list_visited <?php } ?>">
        <div class="nitify_table_no">Table- <span><?=$result_stwrd['tr_tableno']?><?php if($result_stwrd['prefix']!=''){ echo '('.$result_stwrd['prefix'].')';} ?></span></div>
        <div class="nitify_time">Time : <span><?=date("h:i A",strtotime($result_stwrd['tbl_inserttime']));?> </span></div>
        <?php if($result_stwrd['tbl_readby']!=""){ ?> 
        	<div class="noti_stewrd_name">Steward - <span><?=$result_stwrd['tbl_readby']?></span> 
            <div class="nitify_time">Read : <span><?=date("h:i A",strtotime($result_stwrd['tbl_readtime']));?> </span></div>
            </div> 
            
		<?php } ?>
    </div></a><!--notification_cont_list--->
    <?php } ?>
  
    
    <?php } } ?>

</div>
</div>

<div class="notificationContainer_1">
<div class="notificationTitle">Water- <span id="wtnot"><?=$_SESSION['wateralertcount']?></span> New Notifications</div>
<div class="notificationsBody notifications pop_water">
 <?php
$curdt=date("Y-m-d");
 $sql_stwrd  =  $database->mysqlQuery("Select tbl_notifications.tbl_notificationtype,tbl_tablemaster.tr_tableno,tbl_tablemaster.tr_tableid, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid  Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = 'water' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							  $rd=0;
							  if($result_stwrd['tbl_readby']!="")
							  {
								 $timestamp = strtotime($result_stwrd['tbl_readtime']);
								 $_5minuteslater = time() + 5 * 60;//< time()-300 
								 $totalval= $_5minuteslater - $timestamp;
								 if($totalval<1000)
								 {
									 $rd=0;
								 }else
								  {
									 $rd=1; 
								  }
							  }
							  ?>
    <?php if($rd==0){ ?>
	<a href="#" <?php if($result_stwrd['tbl_readby']==""){ ?>class="class" tbl="tbl_<?=$result_stwrd['tr_tableid']?>" tim="tm_<?=$result_stwrd['tbl_inserttime']?>" not="not_<?=$result_stwrd['tbl_notificationtype']?>" <?php } ?>>
    <div class="notification_cont_list <?php if($result_stwrd['tbl_readby']!=""){ ?> notiify_list_visited <?php } ?>">
        <div class="nitify_table_no"> Table- <span><?=$result_stwrd['tr_tableno']?></span></div>
        <div class="nitify_time">Time : <span><?=date("h:i A",strtotime($result_stwrd['tbl_inserttime']));?> </span></div>
        <?php if($result_stwrd['tbl_readby']!=""){ ?> 
        	<div class="noti_stewrd_name">Steward - <span><?=$result_stwrd['tbl_readby']?></span> 
            <div class="nitify_time">Read : <span><?=date("h:i A",strtotime($result_stwrd['tbl_readtime']));?> </span></div>
            </div> 
            
		<?php } ?>
    </div></a>
    <?php } ?>
  
    
    <?php } } ?>

</div>
</div>
   
              
          <div class="notificationContainer_2"   >
<div class="notificationTitle">Bill- <span id="blnot"><?=$_SESSION['billalertcount']?></span> New Notifications</div>
<div class="notificationsBody notifications pop_bil">
 <?php
$curdt=date("Y-m-d");
 //$sql_stwrd  =  $database->mysqlQuery("Select tbl_notifications.tbl_notificationtype,tbl_tablemaster.tr_tableno,tbl_tablemaster.tr_tableid, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = 'water' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc");
 $sql_stwrd  =  $database->mysqlQuery("Select b.bm_tableno as tabname,n.tbl_insertdate, n.tbl_inserttime, b.bm_billno,b.bm_finaltotal, n.tbl_read, n.tbl_readby, n.tbl_readdate, n.tbl_readtime,n.tbl_notificationtype,n.tbl_tableid,t.tr_tableno as tableno1,tds.ts_tableidprefix as prefix from tbl_notifications n left Join tbl_tablemaster t On t.tr_tableid = n.tbl_tableid left Join tbl_modulesubmaster ms On n.tbl_notificationtype = ms.mser_submoduleid left Join tbl_modulemaster m On ms.mser_moduleid = m.mer_moduleid left join tbl_tablebillmaster b ON b.bm_billno = n.tbl_billno left join tbl_tabledetails tds on tds.ts_tableid=n.tbl_tableid where ms.mser_submodulelink = 'bill' And n.tbl_insertdate = '".$curdt."' Order By n.tbl_inserttime desc" );
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							  $rd=0;
							  if($result_stwrd['tbl_readby']!="")
							  {
								 $timestamp = strtotime($result_stwrd['tbl_readtime']);
								 $_5minuteslater = time() + 5 * 60;//< time()-300 
								 $totalval= $_5minuteslater - $timestamp;
								 if($totalval<1000)
								 {
									 $rd=0;
								 }else
								  {
									 $rd=1; 
								  }
							  }
							  //BILL NO,  FLOOR,     TABLE, TIME,AMOUNT 
							  ?>
    <?php if($rd==0){ ?>
	<a href="#" <?php if($result_stwrd['tbl_readby']==""){ ?>class="class"  tbl="tbl_<?=$result_stwrd['tbl_tableid']?>" tim="tm_<?=$result_stwrd['tbl_inserttime']?>" not="not_<?=$result_stwrd['tbl_notificationtype']?>" <?php } ?>> <!--tbl="tbl_<?$result_stwrd['tr_tableid']?>"-->
    <div class="notification_cont_list <?php if($result_stwrd['tbl_readby']!=""){ ?> notiify_list_visited <?php } ?>">
       
        <div class="nitify_table_no notif_bill_table">Table- <span><span><?php if ($result_stwrd['tabname']!='') {
        	 echo $result_stwrd['tabname'];} else { echo $result_stwrd['tableno1']; if($result_stwrd['prefix']!=''){ echo '('.$result_stwrd['prefix'].')';}}?></span></div>
        
         <div class="nitify_time notif_bill_time">Time : <span><?=date("h:i A",strtotime($result_stwrd['tbl_inserttime']));?> </span></div>
         <?php
    if($result_stwrd['bm_billno']!=""){

    ?>
         <span class="notif_bill_no">Bill No-<?=$result_stwrd['bm_billno']?></span>
        
        <span class="notif_bill_amount">Amount - <?=$result_stwrd['bm_finaltotal']?></span>
         
        
        <?php } else { ?>
        <span  style="color: red">BILL ALERT</span>
        <?php }
         if($result_stwrd['tbl_readby']!=""){ ?> 
        	<div  class="noti_stewrd_name notif_bill_read_cc">Steward - <span><?=$result_stwrd['tbl_readby']?></span> 
            <div class="nitify_time notif_bill_read_time">Read : <span><?=date("h:i A",strtotime($result_stwrd['tbl_readtime']));?> </span></div>
            </div> 
            
		<?php } ?>
    </div></a><!--notification_cont_list--->
    <?php } ?>
  
    
    <?php } } ?>

</div>
</div>   
              
        
           
  </div>
  </div>
<input type="hidden" id="urban_on" value="<?=$_SESSION['urban_db_set']?>" >
<input type="hidden" id="qr_on" value="<?=$_SESSION['qr_db_set']?>" >

<input type="hidden" id="online_order_on" value="<?=$_SESSION['online_order_on']?>" >
  