<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=8;
$printer_id='';


       $sql_login  =  $database->mysqlQuery("select * from tbl_printertype where pr_printertype='8' "); 
       $num_login   = $database->mysqlNumRows($sql_login);
       if($num_login){
           
       }else{

	$insertion['pr_printername'] 	=  mysqli_real_escape_string($database->DatabaseLink,'SHIFT PRINT');
        
	$insertion['pr_branchid']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['branchofid']));
        
        $insertion['pr_printertype']= mysqli_real_escape_string($database->DatabaseLink,'8');
     
        $insertion['pr_floorid'] =  mysqli_real_escape_string($database->DatabaseLink,'1');
        
	$insertion['pr_style'] 	=  mysqli_real_escape_string($database->DatabaseLink,'1');
	
	$sql=$database->check_duplicate_entry('tbl_printersettings',$insertion);
	 
	$insertion['pr_printerip'] =  mysqli_real_escape_string($database->DatabaseLink,'192.168.0.169');
        
	$insertion['pr_printerport'] 	=  mysqli_real_escape_string($database->DatabaseLink,'9100');
        
        
        $insertion['pr_usbprinterip'] 	=  mysqli_real_escape_string($database->DatabaseLink,'127.0.0.1');
        
	$insertion['pr_usbprinter'] 	=  mysqli_real_escape_string($database->DatabaseLink,'BILL');
        
        $stus='Y'; 
               
        $usbdflt='N';
               
	$insertion['pr_printcount'] 	=  mysqli_real_escape_string($database->DatabaseLink,'1');
        
	$insertion['pr_enable']=$stus;
        
        $insertion['pr_defaultusb']=$usbdflt;
        
	 if($sql!=1)
	{
	   $insertid     =  $database->insert('tbl_printersettings',$insertion);
	
           
           $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
         
        }


       }




if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
  
   $database->mysqlQuery("DELETE FROM tbl_printersettings_ip WHERE pr_id = '" .$_REQUEST['id']."'");
 
   $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
   
   
     if (!headers_sent())
    {    
        header('Location: printer_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="printer_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=printer_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }

}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='printer_delete'){
    
        $printer_id=$_REQUEST['printer_id'];
        
        $sql_printer_delete =  $database->mysqlQuery("DELETE FROM `tbl_printersettings` WHERE `pr_id`='".$printer_id."' ");
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
      $detail="  PRINTER DELETE BY  ".$_SESSION['expodine_id']." of ID:$printer_id ";      
      $c_date=date('Y-m-d');               
      $sql_login_LOG  =  $database->mysqlQuery("INSERT INTO `tbl_common_logs_all`(`tcl_date`, `tcl_data`, `tcl_type`) "
      . " VALUES ('$c_date','$detail','PRINTER DELETE')");         
         
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='print_on_off'){
    
        $printer_id=$_REQUEST['printer_id'];
        
        $sql_printer_delete =  $database->mysqlQuery("update `tbl_printersettings` set pr_enable='".$_REQUEST['sts']."' WHERE `pr_id`='".$printer_id."' ");
        
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
         
      $detail="  PRINTER (ID:$printer_id) STATUS AS ".$_REQUEST['sts']." BY  ".$_SESSION['expodine_id']."   ";   
      
      $c_date=date('Y-m-d');               
      $sql_login_LOG  =  $database->mysqlQuery("INSERT INTO `tbl_common_logs_all`(`tcl_date`, `tcl_data`, `tcl_type`) "
      . " VALUES ('$c_date','$detail','PRINTER UPDATE STATUS')");         
         
        
}

////////////////////////ADD PRINTER///////////////////


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['prnname']))
{
   
	$insertion['pr_printername'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['prnname']));
        
	$insertion['pr_branchid']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['branchofid']));
        $insertion['pr_printertype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lanfor']));
     
	if($_REQUEST['lantype']=='DI')
            $insertion['pr_floorid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lanfloor']));
        
        if(trim($_REQUEST['lanstyle'] !=""))
	{
	$insertion['pr_style'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lanstyle']));
	}
        
        if(trim($_REQUEST['lankot'] !=""))
	{
	$insertion['pr_kotcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lankot']));
	}
	
	$sql=$database->check_duplicate_entry('tbl_printersettings',$insertion);
	 
	$insertion['pr_printerip'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lanip']));
	$insertion['pr_printerport'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lanport']));
               
        $stus='Y'; 
        $usbdflt='N';
               
	$insertion['pr_printcount'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['lancount']));
	$insertion['pr_enable']=$stus;
        $insertion['pr_defaultusb']=$usbdflt;
        
	 if($sql!=1)
	{
	   $insertid              			=  $database->insert('tbl_printersettings',$insertion);
        
           $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	}
	if (!headers_sent())
       {    
          header('Location: printer_master.php?msg=2');
          exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="printer_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=printer_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['usbprnname']))
{
    
	$insertion['pr_printername'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbprnname']));
	$insertion['pr_branchid']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['branchofid']));
        $insertion['pr_printertype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbfor']));
     
	if($_REQUEST['usbtype']=='DI')
            
            $insertion['pr_floorid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbfloor']));
	
        if(trim($_REQUEST['usbstyle'] !=""))
	{
	$insertion['pr_style'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbstyle']));
	}
        
        if(trim($_REQUEST['usbkot'] !=""))
	{
	$insertion['pr_kotcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbkot']));
	}
	
	$sql=$database->check_duplicate_entry('tbl_printersettings',$insertion);
	 
	$insertion['pr_usbprinterip'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbip']));
	$insertion['pr_usbprinter'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbname']));
        $stus='Y';
        $usbdflt='Y';
	$insertion['pr_printcount'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbcount']));
	$insertion['pr_enable']=$stus;
	$insertion['pr_defaultusb']=$usbdflt;
	 if($sql!=1)
	{
	    $insertid              			=  $database->insert('tbl_printersettings',$insertion);
           
            $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
           
           
	}
        
       if (!headers_sent())
       {    
         header('Location: printer_master.php?msg=2');
         exit;
        }
      else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="printer_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=printer_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}


if(isset($_REQUEST['set_print']) && $_REQUEST['set_print']=="printer_upate_new" )
{
      
    
    if($_REQUEST['lantypeedit']=='TA'){
       $prfloor=NULL; 
    }else{
        $prfloor=$_REQUEST['lanflooredit']; 
    }
 
    $prfor=$_REQUEST['lanforedit']; 

    $prname=$_REQUEST['lannameedit'];
    $prlanip=$_REQUEST['lanipedit']; 
    $prusbip=$_REQUEST['usbipedit'];

    $prcount=$_REQUEST['lancountedit']; 
    $prstyle=$_REQUEST['lanstyleedit']; 
    $prusbname=$_REQUEST['usbipedit1'];
    $prdft=$_REQUEST['hidddftusb'];

    $prenb=$_REQUEST['status1'];


    if($_REQUEST['lanportedit']!=''){
        $prport=$_REQUEST['lanportedit'];  
    }else{
        $prport=9100;  
    }
 
 
   if($_REQUEST['lantypeedit']=='TA'){
      
               $sql_query_check = "update tbl_printersettings set pr_printername='$prname',pr_printerip='$prlanip',pr_printerport='$prport',"
               . " pr_usbprinterip='$prusbip',pr_branchid='".$_SESSION['branchofid']."',pr_printertype='$prfor',pr_floorid=NULL,"
               . " pr_usbprinter='$prusbname',pr_defaultusb='$prdft',pr_enable='$prenb',pr_printcount='$prcount',pr_style='$prstyle'";
       
    }else{
             
                $prfloor=$_REQUEST['lanflooredit']; 
        
                $sql_query_check = "update tbl_printersettings set pr_printername='$prname',pr_printerip='$prlanip',pr_printerport='$prport',"
                . " pr_usbprinterip='$prusbip',pr_branchid='".$_SESSION['branchofid']."',pr_printertype='$prfor',pr_floorid= '$prfloor',"
                . " pr_usbprinter='$prusbname',pr_defaultusb='$prdft',pr_enable='$prenb',pr_printcount='$prcount',pr_style='$prstyle'";
    }
 
 
 
    if($_REQUEST['hiddlan']=== "Y"){
     
           $sql_query_check = $sql_query_check. " ,pr_kotcode='".$_REQUEST['lankotedit']."' where pr_id='".$_SESSION['printerid']."'";
          
     }else {
         
           $sql_query_check = $sql_query_check. " ,pr_kotcode=NULL where pr_id='".$_SESSION['printerid']."'";
     }

           $query3=$database->mysqlQuery($sql_query_check); 
 
           
      $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' "); 
         
   
      $detail="  PRINTER UPDATE BY  ".$_SESSION['expodine_id']." of (ID: ".$_SESSION['printerid'].") ";      
      $c_date=date('Y-m-d');               
      $sql_login_LOG  =  $database->mysqlQuery("INSERT INTO `tbl_common_logs_all`(`tcl_date`, `tcl_data`, `tcl_type`) "
      . " VALUES ('$c_date','$detail','PRINTER UPDATE')");    
   
           
}


//////////////machine ip///////////////

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['prmachineip'])){
  
        $insertion['pr_id'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prid1']);
	$insertion['pr_machine_ip']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prmachineip']);
        
        $sql=$database->check_duplicate_entry('tbl_printersettings_ip',$insertion);
	 if($sql!=1){
             $insertid              			=  $database->insert('tbl_printersettings_ip',$insertion);
         
            $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
         }
        
       if (!headers_sent())
        {    
         header('Location: printer_master.php?msg=2');
         exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="#";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta  content="0;url=printer_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
        
}

///////////////machine ip end//////////////

$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Printer Master</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}.tablesorter tbody{float:left;}
.ui-autocomplete{z-index:999999 !important;}
.first_form_contain{margin-bottom:0px;}
.contant_table_cc {overflow:auto;}
.tablesorter tr{display:inherit !important;width:auto;}
.tablesorter tbody{display:inherit !important;float:inherit !important;overflow:visible;}
.contant_table_cc th{min-width:125px;max-width:inherit !important}
.contant_table_cc td{min-width:125px;max-width:inherit;height: 31px;}
.first_form_contain{width:50%;}
.md-content{width:750px !important;}
.table_active{float:left;}
.has-error{border:  solid 1px #f00;outline: none}
.action_button i{color: #333; font-size: 18px;top: 6px;}
.action_button{margin-right: 0}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#pnames').autocomplete({source:'autocomplete/find_keywords.php?type=pname_s', minLength:1});
			$('#pips').autocomplete({source:'autocomplete/find_keywords.php?type=pip_s', minLength:1});
			$('#pports').autocomplete({source:'autocomplete/find_keywords.php?type=pport_s', minLength:1});
			$('#ptypes').autocomplete({source:'autocomplete/find_keywords.php?type=ptype_s', minLength:1});
			$('#pbranchs').autocomplete({source:'autocomplete/find_keywords.php?type=pbranch_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 
<script>
  

   
$(document).ready(function(){
    
   $("#pnames").focus();  
   var url      = window.location.href; 
   var hsh=url.split('*');
   location.hash='#ids_'+hsh[1];
  
   $('#ids_'+hsh[1]).addClass('table_active');
  
  if(hsh[1]>0){
      
   var kt=hsh[7].split('#');
  
  
      $('#ptypes').val(hsh[2]);
      if(hsh[3]!="null"){
       $('#pnames').val(hsh[3]);
        } 
         if(hsh[4]!="null"){
       $('#pips').val(hsh[4]);
         }
          if(hsh[5]!="null"){
       $('#pports').val(hsh[5]);
          }
       $('#pbranch_kot').val(hsh[6]);
       
       $('#lan_usb_type').val(kt[0])
 
   
    if(hsh[2]!='null' || hsh[3]!="null" || hsh[4]!="null" || hsh[5]!="null" || kt[0]!="null" || hsh[6]!="null"){ 
        
    var data3="value=searchprint&pnames="+hsh[3]+"&pips="+hsh[4]+"&pports="+hsh[5]+"&ptypes="+hsh[2]+"&pbranchs="+hsh[6]+"&lan_usb_type="+kt[0]+"&prn_id_new="+hsh[1];
    
    $.ajax({ 
        type: "POST",
        url: "load_divmaster.php",
        data: data3,
        success: function(msg)
        {
           
                $('#listall').html(msg);

        }
		});  
            }
        }
        
        
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_print').click( function() { 
            
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
                       
			  $.post("popup/printer_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
                                  var type = $('#hiddfloor').val();
                                  if(type==''){
                                      $('#lanflooredit').hide();
                                  }
				  });  
                     
	});
        
       
        	$('.popup_print_ip').click( function() { 
//                    
			var id_str   =  $(this).attr("id");
                        var print_data = id_str.split('|');
                        $("#prid1").val(print_data[0]);
                        $("#printer_name").html(print_data[1]);
                        $("#printer_ip").html(print_data[2]);
                        var ac=$("#prid1").val().trim();
                       // alert(ac);
                     // alert(deltid);

   
                         $.ajax({
       			type: "POST",
			url: "load_printipsettings.php",
			data: "value=&mid="+ac,
			success: function(data)
			{
			//msg=$.trim(msg);
                        data=$.trim(data);
                       //alert(data);
                       $('#printeriptable').html(data);
			
      
			}
			
		});
                  
	});

   
        	
        
        
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
        
        
     
});
</script>




<script>
$(document).ready(function(){
    
    
    
    
    
$('#type').change(function(){
    var optionSelected = $(this).find('option:selected').attr('title1');
      var flooroption = $(this).find('option:selected').attr('title2');
    //this will show the value of the atribute of that option.
	$('#hidkotstatus').val(optionSelected);
	if(optionSelected=="Y")
	{
		$('#forloginonly').css("display", "block");
                
	}else
	{
		$('#forloginonly').css("display", "none");
                
                
	}
//        var flooroption = $(this).find('option:selected').attr('title');
        $('#hidfloorvisible').val(flooroption);
        if(flooroption=="Y")
        {
            $('#floorname').css("display", "block");
        }else
        {
            $('#floorname').css("display", "none");
            document.getElementById('floor').value = '';
        }
});

$('#defaultusb').click(function (e) {
		if($("#defaultusb").is(':checked'))
		{
			$('.usbstatus').css('display','block');
			$('.lanstatus').css('display','none');
		}
		else
		{
			$('.usbstatus').css('display','none');
			$('.lanstatus').css('display','block');
			
		}
	});


 });
 </script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:600px;height:280px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute}  
 .quick_pop_printer_head{width:100%;height:auto;float:left;text-align:center;font-size:20px;color:#333;padding:15px 0;font-weight:bold}   
 .quick_pop_printer_content{width:100%;height:auto;float:left;padding:15px;}      
</style>
</head>
<body>
<div class="olddiv "></div> 


<div class="quick_pop_printer_sec" style="display:none">
    <div class="quick_pop_printer">
        <div class="quick_pop_printer_head">QUICK RESET &nbsp;&nbsp;&nbsp; [ SYSTEM IP : <?php $localIP = getHostByName(getHostName()); echo $localIP; ?> ]
            <div id="quick_close" style="top: 7px;right: 10px;" class="close_staff_pop"><img width="25px" src="img/black_cross.png"></div>
        </div>
              <div class="quick_pop_printer_content">
                   
                    <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                         <span class="filte_new_text">TYPE </span>
                         <select onclick="change_type();"  id="pr_type_quick" class="add_text_box filte_new_box ui-autocomplete-input">
                               <option value="">Type</option>
                                 <option value="lan">LAN</option>
                                 <option value="usb">USB</option>                   
                                </select>
                            </div>
                  
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                       <span style="font-size: 15px;" class="filte_new_text">IP</span>
                       <input type="text" class="form-control filte_new_box ui-autocomplete-input" id="pr_ip_quick"  placeholder="Printer IP"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                  </div>
                  
                   <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                       <span style="font-size: 15px;" class="filte_new_text">PORT</span>
                       <input type="text" class="form-control filte_new_box ui-autocomplete-input" id="pr_port_quick"      placeholder=" PORT"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    </div>
                  
                   <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                         <span class="filte_new_text">Style </span>
                         <select id="pr_style_quick" class="add_text_box filte_new_box ui-autocomplete-input">
                             
                                 <option value="1">style 1</option>
                                 <option value="2">style 2</option>    
                                 <option value="3">style 3</option>    
                                 <option value="4">style 4</option>    
                         </select>
                   </div>
                  
                    <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                       <span style="font-size: 15px;" class="filte_new_text">CODE</span>
                       <input type="password" class="form-control filte_new_box ui-autocomplete-input" id="pr_password_quick" maxlength="6"   placeholder=""  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    </div>
                  
                  
                  <div style="margin-left:1%;width: 20%;" class="search_btn_member_invoice filte_new_box_btn"><a id="submit_quick" href="#">RESET</a></div>
                  
                  
                  <br><br>
                  
                  
                  
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:37%">
                       <span style="font-size: 15px;" class="filte_new_text">PRINTER IP</span>
                       <input type="text" class="form-control filte_new_box ui-autocomplete-input" id="ip_on_off"   placeholder=" IP"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    </div>
                  
                     <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                         <span class="filte_new_text">TYPE </span>
                         <select id="type_on_off" class="add_text_box filte_new_box ui-autocomplete-input">
                             
                                 <option value="lan">LAN</option>
                                 <option value="usb">USB</option>    
                                   
                                </select>
                         </div>
                  
                  
                   <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                         <span class="filte_new_text">On -Off </span>
                         <select id="sts_on_off" class="add_text_box filte_new_box ui-autocomplete-input">
                             
                                 <option value="Y">ON</option>
                                 <option value="N">OFF</option>    
                                 
                                </select>
                         </div>
                  
                  
                  
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                       <span style="font-size: 15px;" class="filte_new_text">CODE</span>
                       <input type="password" class="form-control filte_new_box ui-autocomplete-input" id="password_on_off" maxlength="6"   placeholder=""  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                  </div>
                  
                  
                  
                  
                  <div style="margin-left:1%;width: 20%;" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #4a7847 " id="submit_on_off" href="#">ON-OFF</a></div>
                  
                  <br><br>
                    
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:27%">
                       <span style="font-size: 15px;" class="filte_new_text">PRINTER IP FROM</span>
                       <input type="text" class="form-control filte_new_box ui-autocomplete-input" id="ip_from"   placeholder=" IP"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    </div>
                  
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                       <span style="font-size: 15px;" class="filte_new_text">PRINTER IP TO</span>
                       <input type="text" class="form-control filte_new_box ui-autocomplete-input" id="ip_to"   placeholder=" IP"  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                    </div>
                  
                     <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                         <span class="filte_new_text">TYPE </span>
                         <select id="type_change" class="add_text_box filte_new_box ui-autocomplete-input">
                             
                                 <option value="lan">LAN</option>
                                 <option value="usb">USB</option>    
                                   
                                </select>
                         </div>
                  
                  
                  <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                       <span style="font-size: 15px;" class="filte_new_text">CODE</span>
                       <input type="password" class="form-control filte_new_box ui-autocomplete-input" id="password_change" maxlength="6"   placeholder=""  autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                  </div>
                  
                  
                  
                  
                  <div style="margin-left:1%;width: 20%;" class="search_btn_member_invoice filte_new_box_btn"><a  style="background-color: #477378 "  id="submit_change" href="#">IP CHANGE</a></div>
                  
                  
                  
                  
                  <strong style="width:100%;float:left;color:darkred;display: none " id="error_quick" ></strong>
               </div>
    </div>
<div>
        
      </div>
    
</div>





<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Printer Master</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php }else{ ?>
             <div class="load_error alertsmasters"></div>
            <?php } ?>
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                        
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
                                    
				    <?php  include "includes/page_top.php"; ?>
                                    
                                  
                                  </div>
                  
            <?php if($_SESSION['expodine_id']=='admin') { ?>     
                            
            <span style="display: none;cursor: pointer;font-size: 15px;padding: 4px;border: solid 2px lightgrey;position: fixed;margin-left: 333px;margin-top: -35px;font-weight: bold;border-radius: 3px;">
                                 
                <?php
                $sql_billhis="select be_printall  from tbl_branchmaster ";
		$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
		$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
		if($num_billhistory)
		{
			while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
                            
                            $be_printall=$result_billhistory['be_printall'];
                        }
                        }
                              ?>
                               
                <input style="display: none;cursor: pointer;  accent-color: #8b7f7f;"  <?php if($be_printall=='Y'){ ?> checked <?php } ?> type="checkbox" id="print_all_on_off"> PRINT ALL
               
                
            </span> 
                            
                            
                  <?php  if($be_printall=='Y'){ ?>
                                       
                                       <a  style="position: absolute;margin-left: 333px;margin-top: 12px;cursor: pointer;background: #648964;width: 85px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;" onclick="return print_all_on_off('N');"  title="PRINTER ON " class="tab_edt_btn ingredient_btn"  >PRINT ALL ON</a>
                                       <?php }else{ ?>
                                        
                                        <a style="position: absolute;margin-left: 333px;margin-top: 12px;cursor: pointer;background: #993d3d;width: 85px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;"  onclick="return print_all_on_off('Y');"  title="PRINTER OFF" class="tab_edt_btn ingredient_btn"  >PRINT ALL OFF</a>
                                     
                                       <?php } ?>           
                            
                            
                      
              <span title="VIEW LOGO" onclick="$('#qrModal').show();" style="border: solid 2px lightgrey;border-radius: 4px;
              font-size: 15px;padding-left: 8px;padding-right: 8px;position: fixed;margin-left: 425px;
              margin-top: -30px;font-weight: bold;cursor: pointer">
                               
           <i class="fa fa-eye "></i>             
           </span>                 
                            
            <?php } ?>                
                                
                            
            <?php 
            
            $iplock_consolidate='';
            $iplock_kot='';
         
            
            $sq_lang=$database->mysqlQuery("select * from tbl_branch_settings_printer");
            $nm_lang= $database->mysqlNumRows($sq_lang);
            if($nm_lang){
		while($result_lang  = $database->mysqlFetchArray($sq_lang)) 
		{
                    
                    $iplock_consolidate=$result_lang['bp_consolidate_kot_iplock'];
                    $iplock_kot=$result_lang['bp_kot_iplock'];
                    
                    
                }
                }              
                            
               ?>    
                            
                             
                            
               <?php if($_SESSION['billip']=='Y'){ ?>   
                            
                <span style="font-size: 9px;padding: 1px;border: solid 1px green;position: fixed;margin-left: 467px;margin-top: -29px;font-weight: bold;border-radius: 3px;">
                  BILL IP LOCK ON 
                </span>      
                            
                  <?php } ?>   
                            
                            
                   <?php if($iplock_kot=='Y'){ ?>   
                            
                <span style="font-size: 9px;padding: 1px;border: solid 1px green;position: fixed;margin-left: 542px;margin-top: -29px;font-weight: bold;border-radius: 3px;">
                  KOT IP LOCK ON 
                </span>      
                            
                  <?php } ?>            
                            
                   <?php if($iplock_consolidate=='Y'){ ?>   
                            
                <span style="font-size: 9px;padding: 1px;border: solid 1px green;position: fixed;margin-left: 615px;margin-top: -29px;font-weight: bold;border-radius: 3px;">
                  CONS IP LOCK ON 
                </span>      
                            
                  <?php } ?>     
                            
                            
                  
                            
                          
		   </div>
                           
                   </div>
                   
                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                 
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                             	<span class="filte_new_text">Name</span>
                                <input autocomplete="off" type="text" class="form-control filte_new_box" id="pnames" name="pnames" placeholder="Printer Name" onKeyUp="validateSearch()">
                            </div>
                                 
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:11%">
                             	<span class="filte_new_text">IP</span>
                                <input autocomplete="off" type="text" class="form-control filte_new_box" id="pips" name="pips" placeholder="Printer IP"  onKeyUp="validateSearch()">
                            </div>
                                 
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%;display: none">
                            	<span class="filte_new_text">Port</span>
                                <input type="text" class="form-control filte_new_box" id="pports" name="pports" placeholder="Port"  onKeyUp="validateSearch()">
                            </div>
                                 
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                               	<span class="filte_new_text">Printer Type</span>
                                 <select  class="add_text_box filte_new_box"  id="ptypes" name="ptypes" onChange="validateSearch()">
                                 <option value="null" default>ALL</option>
                                 
                                 <?php
					$sql_login  =  $database->mysqlQuery("select * from tbl_printertype "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{
	 				?>
                                 
                                       <option value="<?=$result_login['pt_id']?>"><?=$result_login['pt_typename']?></option>
                                
                                       <?php } } ?>	
                                       
                            </select>
                            </div>
                                 
                               <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:8%">
                               	<span class="filte_new_text">Module</span>
                                <select  class="add_text_box filte_new_box"  id="module_type" name="module_type" onChange="validateSearch()">
                                 <option value="null" default>ALL</option>
                                 <option value="di" >DI</option>	
                                 <option value="ta" >TA-HD</option>	
                                    <option value="cs" >CS</option>	
                                </select>
                            </div>  
                                 
                                 
                                 
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                            <span class="filte_new_text">Kitchen</span>
                            <select  class="add_text_box filte_new_box"  id="pbranch_kot" name="pbranch_kot" onChange="validateSearch()">
                            <option value="null" default>ALL</option>
                                 
                            <?php
					$sql_login  =  $database->mysqlQuery("select kr_kotname,kr_kotcode from tbl_kotcountermaster "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{
	 				?>
                            
                                <option value="<?=$result_login['kr_kotcode']?>"><?=$result_login['kr_kotname']?></option>
                                
                               <?php } } ?>
                                
                            </select>
                                
                            </div>
                                 
                                 <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:9%">
                               	<span class="filte_new_text">USB - LAN</span>
                                <select  class="add_text_box filte_new_box"  id="lan_usb_type" name="lan_usb_type" onChange="validateSearch()">
                                 <option value="null" default>ALL</option>
                                 <option value="N" default>LAN</option>	
                                 <option value="Y" default>USB</option>	
                                </select>
                            </div>
                                 
                                 
                                <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:8%">
                               	<span class="filte_new_text">ON - OFF</span>
                                <select  class="add_text_box filte_new_box"  id="on_off_type" name="on_off_type" onChange="validateSearch()">
                                 
                                 <option value="null" default>ALL</option>
                                 <option value="Y" >ON</option>	
                                 <option value="N" >OFF</option>	
                                 
                                </select>
                                
                                  </div>  
                           
                           
                            <div class="col-sm-4 nopadding" style="width: 24.666667% !important;">
<!--                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>-->
                                <div style="margin-left:2%;width: 17%;font-size: 10px" class="search_btn_member_invoice filte_new_box_btn"><a href="printer_master.php" >RESET</a></div>
                                
                                <?php if($_SESSION['expodine_id']=='admin') { ?>
                              
                                <div  style="margin-left:2%;width: 41%;font-size: 10px" class="search_btn_member_invoice filte_new_box_btn"><a id="quick_click" href="#" >DEVELOPER TOOL</a></div>
                               
                                 <?php } ?>
                               
                                
                                <?php if($_SESSION['be_kot_miss_check']=='Y'){ ?>
                                
                                <div  onclick="kot_miss_ok();" style="margin-left:1%;width: 17%;font-size: 9px;text-decoration: none;" class="search_btn_member_invoice filte_new_box_btn"><a id="" href="#">DI KOT</a></div>
                  
                                <?php } ?>
                                
                                 <?php if($_SESSION['be_kot_miss_check_ta']=='Y'){ ?>
                                
                                <div onclick="kot_miss_ok_ta();" style="margin-left:1%;width: 17%;font-size: 9px;text-decoration: none;" class="search_btn_member_invoice filte_new_box_btn"><a id="" href="#">TA KOT</a></div>
                  
                                <?php } ?>
                                
                                
                               
                            </div>
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="printclr()" ></a>
                      </div>  
                   </div>
                   
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th style="min-width: 25px;" >Sl</th>
                               <td style="min-width: 158px;">Action</td>
                                <th style="min-width:155px;">Printer Name</th>
       				<th style="min-width: 95px;">USB IP</th>
                                 <th style="min-width: 65px;">Share Name</th>
                                 <th style="min-width: 105px;">LAN IP</th>
                                  <th style="min-width: 45px;"> USB</th> 
                                 <th style="min-width: 113px;">Type</th>
                                 <th style="min-width: 80px;">Floor</th>
                                 <th style="min-width: 100px;">KOT</th>
                                 <th style="min-width: 45px;">Port</th>
                                 
                                  <th style="min-width: 45px;">Count</th>
<!--                                 <th >Branch</th> -->
<!--                                 <th style="min-width: 45px;">Status</th> -->
                                 <th style="min-width: 69px;">Style</th> 
                                
                              </tr>
                             </thead>
                             
         <?php
	 $i=0;					
	 $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON "
                 . " tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON "
                 . " tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON "
                 . " tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON "
                 . " tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode LEFT JOIN tbl_printer_styles ON "
                 . " tbl_printersettings.pr_style=tbl_printer_styles.ps_id order by tbl_printersettings.pr_printername,tbl_printersettings.pr_enable desc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                        $st=''; $i++;
                        
                        $printer_id = $result_login['pr_id'].'|'.$result_login['pr_printername'].'|'.$result_login['pr_printerip'];
                        
				if($result_login['pr_enable']=='Y')
				{
					$st="ON";
				}else
				{
					$st="OFF";
				}
	 ?>
                             
    				<tr id="ids_<?=$result_login['pr_id']?>"  class="select printer_position_<?=$result_login['pr_id']?>">
                                    
                                 <td style="min-width: 25px;"><?=$i?></td>
                                 
                                 <td style="min-width: 158px;">
                                  <a   style="margin: 0 1%;" href="#" class="md-trigger_print" id="ids_<?=$result_login['pr_id']?>" ><img src="images/edit_page.PNG"></a>
                                  <a style="margin: 0 1%;<?php if($st=="OFF"){ ?> pointer-events: none;opacity: 0.4;cursor: none; <?php } ?>" href="#" class="testmyprinter"  all_detail="<?=$result_login['pr_printername'].'*'.$result_login['pr_printerip'].'*'.$result_login['pr_printerport'].'*'.$result_login['pr_usbprinterip'].'*'.$result_login['pr_usbprinter']?>"   id="<?=$result_login['pr_id']?>" type="<?=$result_login['pr_printertype']?>"  ip="<?=$result_login['pr_printerip']?>" usb_lan="<?=$result_login['pr_defaultusb']?>" ><img src="img/printer_new.png"></a>
                                  <a title="IP LOCK" style="margin: 0 1%;<?php if($st=="OFF"){ ?> pointer-events:none;opacity: 0.4;cursor: none; <?php } ?>" class="popup_print_ip" href="#" onClick="ipclr()" printer_name="" id="<?=$printer_id?>"> <div class="action_button"><img src="img/ip_adress.png"></div></a>
                                  <a  href="#" onClick="printer_delete('<?=$result_login['pr_id']?>')"> <div class="action_button printer_delete"><i class="glyphicon glyphicon-trash"></i></div></a>
                                
                                  <?php  if($result_login['pr_enable']=='Y'){ ?>
                                       
                                       <a  style="cursor: pointer;background: #648964;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;" onclick="return print_on_off('<?=$result_login['pr_id']?>','N');"  title="PRINTER ON " class="tab_edt_btn ingredient_btn"  >ON</a>
                                       <?php }else{ ?>
                                        
                                        <a style="cursor: pointer;background: #993d3d;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;"  onclick="return print_on_off('<?=$result_login['pr_id']?>','Y');"  title="PRINTER OFF" class="tab_edt_btn ingredient_btn"  >OFF</a>
                                     
                                       <?php } ?>
                                 
                                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['pr_id']?>">
                               
                                
                                </td>
                               
 
 
 
                                <td title="<?=$result_login['pr_printername']?>" style="min-width:155px;cursor: pointer;font-weight: bold;text-transform: uppercase"><?=substr($result_login['pr_printername'],0,25)?> <?php  if($result_login['pr_defaultusb']=='Y'){ ?> <img title="USB PRINTER" style="width: 35px;height: 25px;cursor: pointer " src="img/usb.png">  <?php  } ?></td>
                                <td style="min-width: 95px;"><?=$result_login['pr_usbprinterip']?></td>
                                <td style="min-width: 65px;"><?=$result_login['pr_usbprinter']?></td>
                                <td style="min-width: 105px;"><?=$result_login['pr_printerip']?></td>
                                <td <?php  if($result_login['pr_defaultusb']=='Y'){ ?> style="min-width: 45px;color: black;font-weight: bold" <?php }else{ ?> style="min-width: 45px;color:black;font-weight: bold"  <?php } ?> ><?=$result_login['pr_defaultusb']?></td>
                               
                                <td style="min-width: 113px;"><?=$result_login['pt_typename']?></td>
                                
                                <?php if($result_login['fr_floorname']!=''){ ?>
                                <td title="<?=$result_login['fr_floorname']?>" style="min-width: 80px;"><?=substr($result_login['fr_floorname'],0,10)?></td>
                                <?php }else{ ?>
                                
                                 <td title="NO FLOOR" style="min-width: 80px;">***</td>
                                <?php }?>
                                
                                 
                                   <?php if($result_login['kr_kotname']!=''){ ?>
                                <td title="<?=$result_login['kr_kotname']?>" style="min-width: 100px;cursor: pointer"><?=substr($result_login['kr_kotname'],0,15)?></td>
                              <?php }else{ ?>
                                
                                 <td title="NO KOT" style="min-width: 100px;">***</td>
                                <?php }?>
                                
                                
                               
                                 <td style="min-width: 45px;"><?=$result_login['pr_printerport']?></td>
                                
                                <td style="min-width: 45px;"><?=$result_login['pr_printcount']?></td>
<!--                                <td><?//=$result_login['be_branchname']?></td>-->
<!--                                <td style="min-width: 45px;"><?//=$st?></td>-->
                                <td style="min-width: 69px;"><?=$result_login['ps_name']?></td>
<!--                                <td></td>-->
                                
                              </tr>
                               
                              <?php } } ?>
                        </table>
                   </div>
                      
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 <div style="width:500px;top: 3%;position:absolute;margin:auto;left:0;right:0" class="md-modal md-effect-16 printer_add_popup" id="modal-17">
			<div style="width: 100% !important;" class="md-content">
				<h3>Add New Printer</h3>
                                <div style="background-color:transparent;top: 3px;" onclick="clearall()" class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				<div>
                                    
                   <div class="alert_error_prn" style="color: darkred;font-weight: bold;position: fixed;float: left;width: 100%"></div>                 
                    <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:5px;">
                    
                        <div id="aaa" class="printer_mode_select">
                    	<ul>
                            <form>
                                
                          <li style="text-align:right">
                              <input type="radio" id="f-option" name="selector" checked value="lan" >
                            <label for="f-option">LAN</label>
                            
                            <div style="left: 90px;" class="check"></div>
                          </li>
                          
                          <li>
                              <input type="radio" id="s-option" name="selector" value="usb">
                            <label for="s-option">USB</label>
                            
                            <div class="check"><div class="inside"></div></div>
                          </li>
                          
                            </form>
                        </ul>
                    </div><!--printer_mode_select-->
                    
                    <div class="printer_add_text_boxes_cc" id="lan">
                        <form  name="printer_div" action="printer_master.php" method="post" id="lanform">
                              <div class="group" id="">      
                          <select class="add_printer_drop" id="lantype" name="lantype">
                              <option value="DI">Dine In</option>
                               
                              <option value="TA">TA/CS</option> 
                                                                                                                            1</option>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            <div class="group" id="lanfloor_div">      
                          <select class="add_printer_drop " id="lanfloor" name="lanfloor">
                              <option value>Floor*</option>
                                <?php
			          $sql_flr  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' and fr_status='Active' order by fr_floorid"); 
				  $num_flr   = $database->mysqlNumRows($sql_flr);
				  if($num_flr){
                                     while($result_flr  = $database->mysqlFetchArray($sql_flr)) {
                                       ?>
                              <option value="<?=$result_flr['fr_floorid']?>"><?=$result_flr['fr_floorname']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                                  
                          
                                                                                                                                      1</option>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                      
                        <div class="group" id="lanfor_div">      
                            <select class="add_printer_drop" id="lanfor" name="lanfor">
                                <option value>For<span style="color:#F00">*</span></option>
                           <?php
			          $sql_prnttype  =  $database->mysqlQuery("select * from tbl_printertype"); 
				  $num_prnttype   = $database->mysqlNumRows($sql_prnttype);
				  if($num_prnttype){
                                     while($result_prnttype  = $database->mysqlFetchArray($sql_prnttype)) {
                                       ?>
                              <option value="<?=$result_prnttype['pt_id']?>"><?=$result_prnttype['pt_typename']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            <div class="group" id="lankot_div" style="display:none">      
                                  
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_kotcountermaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter KOT" id="lankot" name="lankot" data-rel="chosen" tabindex="9" title="KOT" left"." data-toggle="tooltip" class="add_printer_drop">
                                        
                                        
                                         <option value="" selected>Kot Type*</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['kr_kotcode']?>" id="<?=$result_kot['kr_kotcode']?>"><?=$result_kot['kr_kotname']?></option>
                                    <?php } ?> 
                                       
                                    	 </select>
                                         <?php } ?>
                                         
                                         
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        <div class="group" id="prn_div">      
                            <input type="text" id="prnname" name="prnname"  required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Printer Name<span style="color:#F00">*</span></label>
                        </div>
                        <div class="group" id="lanip_div">      
                            <input type="text" id="lanip" name="lanip" value="192.168.0.0" onkeypress="return numonly(this.evt)" required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>LAN Ip<span style="color:#F00">*</span></label>
                        </div>
                        <div class="group" id="lanport_div">      
                            <input type="text" id="lanport" value="9100" name ="lanport" onkeypress="return numonly(this.evt)" required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>LAN Port<span style="color:#F00">*</span></label>
                        </div>
                        <div class="group" id="lancount_div">      
                            <input type="text"  id="lancount" value="1" name="lancount" onkeypress="return numonly(this.evt)" required>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Count<span style="color:#F00">*</span></label>
                        </div>
                        
                        <div class="group" id="lanstyle_div" >      
                            <select class="add_printer_drop" id="lanstyle" name="lanstyle">
                                <option value>Style<span style="color:#F00">*</span></option>
                              <?php
			          $sql_prntstyle  =  $database->mysqlQuery("select * from tbl_printer_styles"); 
				  $num_prntstyle   = $database->mysqlNumRows($sql_prntstyle);
				  if($num_prntstyle){
                                     while($result_prntstyle  = $database->mysqlFetchArray($sql_prntstyle)) {
                                       ?>
                              <option <?php  if($result_prntstyle['ps_id']=='1'){?> selected <?php } ?> value="<?=$result_prntstyle['ps_id']?>"><?=$result_prntstyle['ps_name']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        
                        
                      </form>
                    </div>
                    
                     <div class="printer_add_text_boxes_cc" id="usb">
                         <form name="printerusb_div" action="printer_master.php" method="post"  id="usbform"  >
                             <div class="group" id="">      
                          <select class="add_printer_drop" id="usbtype" name="usbtype">
                              <option value="DI">Dine In</option>
                               
                              <option value="TA">TA/CS</option> 
                                                                                                                            1</option>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        <div class="group" id="usbfloor_div">      
                            <select class="add_printer_drop" name="usbfloor" id="usbfloor" >
                                <option value>Floor*</option>
                               <?php
			          $sql_flr  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' and fr_status='Active' order by fr_floorid"); 
				  $num_flr   = $database->mysqlNumRows($sql_flr);
				  if($num_flr){
                                     while($result_flr  = $database->mysqlFetchArray($sql_flr)) {
                                       ?>
                              <option value="<?=$result_flr['fr_floorid']?>"><?=$result_flr['fr_floorname']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                                  
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            <div class="group" id="usbfor_div">      
                            <select class="add_printer_drop" name="usbfor" id="usbfor">
                                <option value>For*</option>
                                   <?php
			          $sql_prnttype  =  $database->mysqlQuery("select * from tbl_printertype"); 
				  $num_prnttype   = $database->mysqlNumRows($sql_prnttype);
				  if($num_prnttype){
                                     while($result_prnttype  = $database->mysqlFetchArray($sql_prnttype)) {
                                       ?>
                              <option value="<?=$result_prnttype['pt_id']?>"><?=$result_prnttype['pt_typename']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            <div class="group" id="usbkot_div" style="display:none">      
                                  
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_kotcountermaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter KOT" id="usbkot" name="usbkot" data-rel="chosen" tabindex="9" title="KOT" left"." data-toggle="tooltip" class="add_printer_drop">
                                        
                                        
                                         <option value>Kot Type*</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['kr_kotcode']?>" id="<?=$result_kot['kr_kotcode']?>"><?=$result_kot['kr_kotname']?></option>
                                    <?php } ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                         
                                         
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            <div class="group" id="usbprnname_div">      
                            <input type="text" required name="usbprnname" id="usbprnname">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Printer Name<span style="color:#F00">*</span></label>
                        </div>
                            <div class="group" id="usbip_div">       
                                <input type="text" required value="127.0.0.1" name="usbip" id="usbip" onkeypress="return numonly(this.evt)">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>USB Ip<span style="color:#F00">*</span></label>
                        </div>
                            <div class="group" id="usbname_div">      
                                <input type="text" required value="BILL" name="usbname" id="usbname">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>USB Name<span style="color:#F00">*</span></label>
                        </div>
                            <div class="group" id="usbcount_div">      
                                <input type="text" required name="usbcount" value="1" id="usbcount" onkeypress="return numonly(this.evt)">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Count<span style="color:#F00">*</span></label>
                        </div>
                        
                            <div class="group" id="usbstyle_div">      
                            <select class="add_printer_drop" name="usbstyle" id="usbstyle">
                                <option value>Style*</option>
                                  <?php
			          $sql_prntstyle  =  $database->mysqlQuery("select * from tbl_printer_styles"); 
				  $num_prntstyle   = $database->mysqlNumRows($sql_prntstyle);
				  if($num_prntstyle){
                                     while($result_prntstyle  = $database->mysqlFetchArray($sql_prntstyle)) {
                                       ?>
                                <option <?php  if($result_prntstyle['ps_id']=='1'){?> selected <?php } ?> value="<?=$result_prntstyle['ps_id']?>"><?=$result_prntstyle['ps_name']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        
                        
                      </form>
                    </div>
                    
                    
                    
<!--                   <div class="priner_add_status_checkbox_cc" >
                     
                       <label>Status <input type="checkbox" class="ios-switch" /></label>
                   </div> -->
                    <script>
                    
                       // lanusb
        $("#aaa input[name='selector']").click(function(){
    
     
    if($('input:radio[name=selector]:checked').val() == "usb"){
          $("#lan").hide();
       $("#usb").show();
       $("#btn_usb").show();
             $("#btn_lan").hide();
             $("#print_usb").show();
             $("#print_lan").hide();
      
        //$('#select-table > .roomNumber').attr('enabled',false);
    }
    else if($('input:radio[name=selector]:checked').val() == "lan"){
          $("#usb").hide();
         $("#lan").show();
          $("#btn_lan").show();
       $("#btn_usb").hide();
       $("#print_usb").hide();
       $("#print_lan").show();
        //$('#select-table > .roomNumber').attr('enabled',false);
    }
    
});
        //clearall
        function clearall()
{
 $('#prnname').val(""); 
 $('#lanfloor').val("");
 $('#lanfor').val(""); 
 $('#lancount').val("");
 $('#lanip').val(""); 
 $('#lanstyle').val("");
 $('#lanport').val("");
 //usb
 $('#usbprnname').val(""); 
 $('#usbfloor').val("");
 $('#usbfor').val(""); 
 $('#usbcount').val("");
 $('#usbip').val(""); 
 $('#usbstyle').val("");
 //$('#usbport').val("");
 
}


$(document).ready(function() {
    
    
    
  $('#lanfor').on('change', function() {
       
       
    if (this.value == '1'){
         
        $("#lankot_div").show();
        
        $("#prnname").val('Dine In Kot'); 
     
    }else if(this.value == '4')
    {
        $("#lankot_div").show();
        
        $("#prnname").val('TA Kot'); 
       
    }else if(this.value == '2')
    {
        $("#prnname").val('Dine In Bill Print'); 
       
    }
    else if(this.value == '5')
    {
        $("#prnname").val('TA HD Bill Print'); 
       
    }
    else if(this.value == '6')
    {
        $("#prnname").val('Dine In Consolidate Print'); 
       
    }
     else if(this.value == '7')
    {
        $("#prnname").val('TA HD Consolidate Print'); 
       
    }
    else if(this.value == '3')
    {
        $("#prnname").val('Report Print'); 
       
    }
    else if(this.value == '11')
    {
        $("#prnname").val('Bill Print CS'); 
       
    }
     else if(this.value == '11')
    {
        $("#prnname").val('Bill Print CS'); 
       
    }
    else if(this.value == '8')
    {
        $("#prnname").val('Shift Print'); 
       
    }
    else{
        
        $("#lankot_div").hide();
    }
      
    });
   
   
   
    $('#lantype').on('change', function() {
                
                var type = $('#lantype').val();
                
                if(type!='DI')
                {
                    $('#lanfloor_div').hide();
                   
                }else{
                    $('#lanfloor_div').show();
                }
                
    });
            
});

$(document).ready(function(){
    
    
    
    $('#usbfor').on('change', function() {
        
      if ( this.value == '1'){
          
        $("#usbkot_div").show();
         
          $("#usbprnname").val('Dine In Kot'); 
      }
      else if(this.value == '4')
     {
        $("#usbkot_div").show();
        
         $("#usbprnname").val('Ta Kot'); 
        
      }else if(this.value == '2')
    {
        $("#usbprnname").val('Dine In Bill Print'); 
       
    }
    else if(this.value == '5')
    {
        $("#usbprnname").val('TA HD Bill Print'); 
       
    }
    else if(this.value == '6')
    {
        $("#usbprnname").val('Dine In Consolidate Print'); 
       
    }
     else if(this.value == '7')
    {
        $("#usbprnname").val('TA HD Consolidate Print'); 
       
    }
    else if(this.value == '3')
    {
        $("#usbprnname").val('Report Print'); 
       
    }
    else if(this.value == '11')
    {
        $("#usbprnname").val('Bill Print CS'); 
       
    }
     else if(this.value == '11')
    {
        $("#usbprnname").val('Bill Print CS'); 
       
    }
    else if(this.value == '8')
    {
        $("#usbprnname").val('Shift Print'); 
       
    }else
      {
        $("#usbkot_div").hide();
        
      }
      
  });
    
    
    
    $('#usbtype').on('change', function() {
        
                var type = $('#usbtype').val();
                if(type!='DI')
                {
                    $('#usbfloor_div').hide();
                }else{
                    $('#usbfloor_div').show();
                }
                });
});


function change_type(){
    
    var typ=$('#pr_type_quick').val(); 
    
    if(typ=='lan'){
        
         $('#pr_ip_quick').val('192.168.0.163');
          $('#pr_port_quick').val('9100');
          
    }else if(typ=='usb'){
        
         $('#pr_ip_quick').val('127.0.0.1');
         $('#pr_port_quick').val('BILL');
         
    }else{
        
         $('#pr_ip_quick').val('');
          $('#pr_port_quick').val('');
    }
    
    
}


 </script>
                    
              
    </div>
                                      
                       <a id="btn_lan" href="#" onClick="validate_printervallan()" tabindex="14"><button style="position:relative;top:2px;" class="md-save">Save</button></a>
                       <a id="btn_usb" href="#"  onClick="validate_printervalusb()" tabindex="14"><button style="position:relative;top:2px;" class="md-save">Save</button></a>
                       <a id="print_lan" tittle="Test Print" class="printcheck test_new_print myprint" href="#" ><img style="width:30px" src="img/printer.png"></a>
                       <a id="print_usb" tittle="Test Print" class="printcheck test_new_print myprint" href="#" ><img style="width:30px" src="img/printer.png"></a>
                       
                       
    </div>
                               
    </div>
     
    </div>

  
<div class="md-overlay"></div><!-- the overlay element -->
    <div class="popup_print_ip_cc">
       
    	<div class="popup_print_ip_head">
            
            <div style="width:74%" class="ip_pop_head_text_cc">
                
          <div style="width:40%;" class="ip_pop_head_text"><i title="IP Locks means a printer is locked to a computer . Only print comes in printer
          when print is pressed from added Computer Ip. We can enable Ip Lock for bill, kot , consolidate kot in general settings" style="padding: 3px;
          border: solid 1px;    border-radius: 15px;cursor: pointer " class="fa fa-info"> </i> &nbsp; IP Lock Printer : </div> 
                
           <?php
	  $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                             $printername=$result_login['pr_printername'];
                      
                        }}?>
            
            
                <div style="width:50%;text-align:left" class="ip_pop_head_text" id="printer_name"><strong> <?=$printername?></strong></div>
                
                <?php // } } ?>
                
                <span class="error_lck" style="color:red"></span>   
                
            </div>
            
            
            
            <div class="ip_pop_head_text_cc" style="width: 26%;">
                
            <div style="width:15%" class="ip_pop_head_text"> Ip :</div>
          <?php
	  $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
          
                      $printerip=$result_login['pr_printerip'];
                        }}?>
                <div style="width: 50%;font-size: 11px" class="ip_pop_head_text" id="printer_ip"><strong><?=$printerip?></strong></div>
          <?php // } } ?>
            </div>
            
        </div>
        
        
        <div class="popup_print_ip_contant">
            
           <form role="form"  action="printer_master.php"  method="post"   name="printermasterip">

        	<div class="ip_popup_add_cc">
                    <div class="ip_pop_textbox_cc" id="prmachineip_divs">
                        <input class="ip_pop_textbox prmachineip" id="prmachineip" placeholder="Add new System ip from where print come to this printer " name="prmachineip" type="text">
                </div>
                    <div id="printip_div">
                                <input type="hidden" value="<?=$result_login['pr_id']?>" tabindex="5" name="prid1"  id="prid1" data-toggle="tooltip" title="prid">
                    </div>
                    
              
                <div class="ip_pop_textbox_sub_btn">
                    <a  href="#"  class="printsubmit"><span>Submit</span></a>
                </div>
            </div>
           </form> 
     
            
            <div class="ip_pop_cont_table_cc" id="machineip">
   
            </div>  
            
     
            
        </div><!--popup_print_ip_contant-->
        <div class="popup_print_ip_bottom_btn_cc">
         <a  class="ip_popup_close_button" href="#" ><button style="width:120px;font-size:15px;border-radius:10px;padding: 0.3em 1.2em;"class="md-save">Close</button></a>
<!--         <a  href="#" ><button style="width:120px;font-size:15px;border-radius:10px;padding: 0.3em 1.2em;" class="md-save">Save</button></a>-->
        </div>
          
    </div><!--popup_print_ip_cc-->
    
    
    <div class="popup_alert_box_new" style="border-radius: 10px;color: black;text-transform: uppercase ">
       
    </div>
    
    
<div class="new_overlay_print"></div>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
    
     $('#submit_quick').click(function () {
  
         var ip=$('#pr_ip_quick').val();
         var port=$('#pr_port_quick').val();
         var type=$('#pr_type_quick').val();
         var style=$('#pr_style_quick').val();
         var password=$('#pr_password_quick').val();
         
         if (!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip)))
		{

		 $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID IP");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  exit();
		}
         
        
         if(port==''){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID PORT");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  exit();
         }
         if(type==''){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID TYPE");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  exit();
         }
         if(style==''){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID STYLE");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  exit();
         }
         
         if(password!='555555'){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("  INVALID  CODE");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  $('#pr_password_quick').val('');
                  $('#pr_password_quick').focus();
                  exit();
         }
         
         
          $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=quick_rest&ip="+ip+"&port="+port+"&type="+type+"&style="+style,
			success: function(msg)
			{
                            
                   $("#error_quick").css("display","inline-block");
		  $("#error_quick").text(" PRINTER MASTER UPDATED ");
		  $('#error_quick').delay(1500).fadeOut('slow');
                        
                          setTimeout(function(){
                           location.reload();
                            
                        }, 1000); 
                        
                        
                        }
         
           });
         
         
         
    });
    
    
    
    
    $('#submit_change').click(function () {
  
         var ip=$('#ip_from').val();
          var ip1=$('#ip_to').val();
         var type=$('#type_change').val();
        
         var password=$('#password_change').val();
         
         if (!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip)))
		{

		 $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID IP FROM");
		  $('#error_quick').delay(1500).fadeOut('slow');
                $('#ip_from').focus();
                exit();
                 
		}
         
         if (!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip1)))
		{

		 $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID IP TO");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  ('#ip_to').focus();
                  exit();
                  
		}
         
         
         if(password!='555555'){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("  INVALID  CODE");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  $('#password_change').val('');
                  $('#password_change').focus();
                  exit();
         }
         
         
          $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=quick_rest_change&ip="+ip+"&ip1="+ip1+"&type="+type,
			success: function(msg)
			{
                            
                   $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("CHANGED");
		  $('#error_quick').delay(1500).fadeOut('slow');
                        
                          setTimeout(function(){
                           location.reload();
                            
                        }, 1000); 
                        
                        
                        }
         
           });
         
         
         
    });
    
    $('#submit_on_off').click(function () {
  
         var ip=$('#ip_on_off').val();
         var type=$('#type_on_off').val();
         var sts=$('#sts_on_off').val();
         var password=$('#password_on_off').val();
         
         if (!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip)))
		{

		 $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("INVALID IP");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  exit();
		}
         
         if(password!='555555'){
             
                  $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("  INVALID  CODE");
		  $('#error_quick').delay(1500).fadeOut('slow');
                  $('#password_on_off').val('');
                  $('#password_on_off').focus();
                  exit();
         }
         
         
          $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=quick_rest_on_off&ip="+ip+"&sts="+sts+"&type="+type,
			success: function(msg)
			{
                            
                   $("#error_quick").css("display","inline-block");
		  $("#error_quick").text("UPDATED");
		  $('#error_quick').delay(1500).fadeOut('slow');
                        
                          setTimeout(function(){
                           location.reload();
                            
                        }, 1000); 
                        
                        
                        }
         
           });
         
         
         
    });
    
    
    
    
    
    $('#quick_click').click(function () {
    $(".quick_pop_printer_sec").css("display","block");
     $("#pr_ip_quick").focus();
    });
    
     $('#quick_close').click(function () {
    $(".quick_pop_printer_sec").css("display","none");
    });
    
    
$('.popup_print_ip').click(function () {
	$(".popup_print_ip_cc").css("display","block");
	$(".new_overlay_print").css("display","block");
	});
$('.ip_popup_close_button').click(function () {
	$(".popup_print_ip_cc").css("display","none");
	$(".new_overlay_print").css("display","none");
	});

 $(document).ready(function() {
//testmyprinter
$('.testmyprinter').click(function () {
   
	 var id_str       =  $(this).attr("id");
	var ip=      $(this).attr("ip");
  var type1= $(this).attr("type");
  
  var all= $(this).attr("all_detail");
  
  
  var usb_lan=$(this).attr('usb_lan');
  

           var test_print  = "test_print";
            $.post("printercheck_1.php", {type:test_print,test_ip:ip,type1:type1,usb_lan:usb_lan},
                                               
            function(data)
            { 
            data=$.trim(data); 
         
           
            if(data !="ok")
            { 
                  $(".new_overlay_print").css("display","block");
                  $(".popup_alert_box_new").css("display","block");
		  $(".popup_alert_box_new").text(data);
		  
               setInterval(function () {
               location.reload();
                }, 1000);
                
               //alert(data);
	     // location.reload();
              return false;
            }else{
                $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=testprinter&printerid="+id_str+"&all="+all,
			success: function(msg)
			{
                           
			msg=$.trim(msg);
			
		  $(".load_error_del").css("display","inline-block");
		  $(".load_error_del").text("TEST COPY PRINTED");
		  $('.load_error_del').delay(1500).fadeOut('slow');
                
                 
                
			
			}
			
		}); 
            }
        });

	});
        
        
        
   $('#print_all_on_off').click(function () {  
       
       var sts;
       
         if($(this).is(':checked')){
             var con1="  ALL PRINTERS ON";
             
             sts='Y';
         }else{
            var con1="  ALL PRINTERS OFF";
            
             sts='N';
         }
             
      //  if(confirm1===true){
       
       
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=all_printer_on_off&sts="+sts,
                        
			success: function(data)
			{
                            
                             $(".load_error_del").css("display","inline-block");
		  $(".load_error_del").text(con1);
		  $('.load_error_del').delay(1500).fadeOut('slow');
                            
                           setTimeout(function () {
                            location.reload();
                            }, 1000); 
                            
                        }
                    });
             //   }
   });  
        
       
//testprinter
 $('.myprint').click(function () {
    
     if($('input:radio[name=selector]:checked').val() == "lan"){
      var ip      =  $('#lanip').val();
      var port      =  $('#lanport').val();
       var name      =  $('#prnname').val();
   }
    else if($('input:radio[name=selector]:checked').val() == "usb"){
        var ip      =  $('#usbip').val();
      var port      =     $('#usbname').val();
       var name      =  $('#usbprnname').val();
    }
    
    var mode=$('input:radio[name=selector]:checked').val();
   
	 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=print_lan&ip="+ip+"&port="+port+"&name="+name+"&mode="+mode,
                        
			success: function(data)
			{
			
			if(data.trim()=='sorry'){
                           
                            
                              $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Printer Not Ready');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                        
                            
                            
                            
                        }else
                        {
                             $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Printer Set');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                        }
                        
			}
			
		});
	 
 });
});

 

    $('.printsubmit').click(function () {
        
     var printip=  $("#prmachineip")
     
     $("#prmachineip_divs").removeClass("has-error");
     
     if($("#prmachineip").val()=="")
				{
					//$("#prmachineip_divs").addClass("has-error");
					//document.printer_master.prmachineip.focus();
                                       
                                        
                                        
                                        $('.error_lck').show();
                            
                        $('.error_lck').text('Enter Ip');
                        $('.error_lck').delay(2500).fadeOut('slow');
                                        
					return false;
				}

     
     
     var ipad=$("#prmachineip").val();
     
	   if (!(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipad)))
		{

			$("#prmachineip_divs").addClass("has-error");
                          
                         alert("Enter Valid IP Address");
			 return true;
		}
     

    
	var a=$("#prid1").val().trim();
        var b=$("#prmachineip").val().trim();
       	
			$.ajax({
			type: "POST",
			url: "load_printipsettings.php",
			data: "value=checkprinterip&mid="+a+"&mid1="+b,
			success: function(data)
			{
                        data=$.trim(data);
		      
                       if(data!="sorry")
			{
                        
                $('#machineip').html(data);
                       
                $("#prmachineip").val("");

               	return false;
			}
			else
			{

	  	document.printermasterip.submit();

			}
			}
		});

  });
        

    $('.printsubmit').ready(function () {
    
	var a=$("#prid1").val().trim();
        var b=$("#prmachineip").val().trim();
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
    });
	
        
        
			$.ajax({
			type: "POST",
			url: "load_printipsettings.php",
			data: "value=checkprinterip&mid="+a+"&mid1="+b,
			success: function(data)
			{
			data=$.trim(data);
		     
                       if(data!="sorry")
			{
                         data=$.trim(data);
                           
               $('#machineip').html(data);
		
                $("#prmachineip").val("");
		
	       return false;
			}
			else
			{
		namechk.text('');

	  	document.printermasterip.submit();

			}
			}
		});

	});

        // Machine ip end//


        function valiprintername()
        {
	      var a=$("#printername").val().trim();
	
	       $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprintername&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
				 var namechk=$('#printerchk');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			     $("#menumaincategory_div").addClass("has-error");
	  $("#printername").focus();
	  return false;
					}
					else
					{
						namechk.text('');
						 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	   return true;
					}
			}
		});
}



function print_all_on_off(sts) {  
       
       var sts;
       
         if(sts=='Y'){
             var con1="  ALL PRINTERS ON";
             
             sts='Y';
         }else{
            var con1="  ALL PRINTERS OFF";
            
             sts='N';
         }
             
      //  if(confirm1===true){
       
       
        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=all_printer_on_off&sts="+sts,
                        
			success: function(data)
			{
                            
                             $(".load_error_del").css("display","inline-block");
		  $(".load_error_del").text(con1);
		  $('.load_error_del').delay(1500).fadeOut('slow');
                            
                           setTimeout(function () {
                            location.reload();
                            }, 1000); 
                            
                        }
                    });
             //   }
   }


  function printclr()
  {
    $('#usb').hide();
    $('#lan').show(); 
    $("#btn_lan").show();
    $("#btn_usb").hide();
    $("#print_usb").hide();
    $("#print_lan").show();
	document.getElementById('printername').value = '';
      	document.getElementById('ip').value = '';
    	document.getElementById('port').value = '';
			document.getElementById('type').value = '';
			document.getElementById('branch').value = '';
					document.getElementById('floor').value = '';
					document.getElementById('kot').value = '';
                                        document.getElementById('usbname').value = '';
                                        document.getElementById('usbip').value = '';
                                        document.getElementById('prcount').value = '';
                                        document.getElementById('prstyle').value = '';
     	    $('#printerchk').text('');
	    $("#menumaincategory_div").removeClass("has-error");
	    $("#branch_div").removeClass("has-error");
	    $("#type_div").removeClass("has-error");
		  $("#ipdiv").removeClass("has-error");
		    $("#portdiv").removeClass("has-error");
			$("#floor_div").removeClass("has-error");
				$("#kot_div").removeClass("has-error");
                                $("#usbnamediv").removeClass("has-error");
                                 $("#usbipdiv").removeClass("has-error");
                                  $("#ipdiv").removeClass("has-error");
                                  $("#stylediv").removeClass("has-error");
			$("#defaultusb").each(function() { this.checked=false; });
                        $("#printerstsuts").each(function() { this.checked=false; });
}


//////machineip//////

    function ipclr()
    {
            document.getElementById('prmachineip').value = '';

            $('#pridchk').text('');
            $("#prmachineip_divs").removeClass("has-error");


    }

//////machineip//////

  function validate_all1()
			{
                            
			var a=$("#ip").val().trim();
			var b=$("#port").val().trim();
			var cb= $("#branch").find('option:selected').attr('id');
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprinter&mid="+a+"&port="+b+"&brnch="+cb,
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#printerchk');
			if(data=="sorry")
			{
		   namechk.text('Already exists');
		   $("#ipdiv").addClass("has-error");
	           $("#ip").focus();
	           return false;
			}
			else
			{
		 namechk.text('');
		 $("#ipdiv").removeClass("has-error");
	         $("#ipdiv").addClass("has-success");
	  	 document.printer_master.submit();

			}
			}
		});
	}
			
			
			
	function validate_all()
	 {
				 var a=$("#type").find('option:selected').attr('id');
			
				  var b=$("#floor").find('option:selected').attr('id');
				
				  var brnch=$("#branch").find('option:selected').attr('id');
			
			          var cb= $("#kot").val();//.find('option:selected').attr('id');
		
		                   var printername=$("#printername").val().trim();
		
	if(cb !='')
	{
		
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprinterkot&typeid="+a+"&flr="+b+"&kot="+cb+"&printername="+printername+"&brnch="+brnch,
			success: function(data)
			{
			data=$.trim(data);

			var namechk=$('#printerchk');
			if(data=="sorry")
			{
		     namechk.text('Already exists');
		 
	             return false;
			}
			else
			{
		namechk.text('');
	
	  	document.printer_master.submit();
			}
			}
		});
	}
	else
	{
	
		$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprinter&typeid="+a+"&flr="+b+"&printername="+printername+"&brnch="+brnch,
			success: function(data)
			{
			data=$.trim(data);
		
			var namechk=$('#printerchk');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		 
	         return false;
			}
			else
			{
		namechk.text('');
		
	  	document.printer_master.submit();
			}
			}
		});
		
	}
    }		
	 
/// namevalidation

   function validate_printervallan()
	{
             if(validate_lanfloor())
                   {
                         if(validate_lanfor())
                         
                       {
                             if(validate_lankot())
                         
                       { 
                        
	        if(validate_lanprintername())
		{
                   
                 if(validate_lanip())
                 {
                    
                  if(validate_lanport())   
                  {
                  if(validate_lancount())  
                  {
                    if(validate_lanstyle())
                     {
                        if(validate_lanip_duplicate())
                        {
                           
                           
                        }
                       }   
                     }     
                   }
                  }
                  }
                 }
                }
            }
    }
        
            
                function validate_printervalusb()
	        {
                    
                if(validate_usbfloor())
                {
               
                    if(validate_usbfor())
                {
                    if(validate_usbkot())
                {
	        if(validate_usbprnname())
		{
                 if(validate_usbip())
                 {
                  if(validate_usbname())   
                  {
                  if(validate_usbcount())  
                  {
                  
                     
                    if(validate_usbstyle())
                      {
                          
                          $(".new_overlay_print").css("display","block");
                          $(".popup_alert_box_new").css("display","block");
                          $(".popup_alert_box_new").text('PRINTER ADDED SUCCESSFULLY');
                          $(".printer_add_popup").css("display","none");
                          
                          
                 setInterval(function () {
                    document.getElementById("usbform").submit();  
                }, 1000);  
                          
                          
                          
                                
                      }
                    }
                   }
                  }
                  }
                }
                }
            }
            
            } 
         
         
     function validate_lanprintername()   
	{
                                if($("#prnname").val()=="")
				{
					$("#prn_div").addClass("has-error");
                                       
                                       $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Printer Name ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
						  document.printer_master.prnname.focus();
                                                 
						  return false;
				}

                                else
					 {
				 var a=document.getElementById("prnname").value;
				 $("#prn_div").removeClass("has-error");
			         $(this).addClass("has-success");
				 return true;
				}
        }
        
        
	
	
	//validatelanip
	
	function validate_lanip() 
	  {            
		  var ipad=$("#lanip").val();
                  
                  
	   if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipad))
		{
			$("#lanip_div").removeClass("has-error");
			 return true;
			
		}else
		{
			$("#lanip_div").addClass("has-error");
                      //  alert("Enter Valid IP Address");
                      $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Valid Ip ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
			 document.printer_master.lanip.focus();
                         
			 return false;
		}
	  } 
	
        function validate_lanip_duplicate() 
	  {            
		  var ipad=$("#lanip").val();
                  var printer_floorid=$('#lanfloor').val();
                  var printer_type=$('#lanfor').val();
                  var kot_counter=$('#lankot').val();
                  var data1 ='';
			
			
                               $.post("load_divcheckmenu.php",{value:'check_ip_lan',lanip:ipad,printer_floorid:printer_floorid,printer_type:printer_type,kot_counter:kot_counter},
                                function(data)
                                    {
                                       data1=$.trim(data);
                                        //alert(data);
                                        if(data1 =="yes")
                                        {
                                            $("#lanip_div").addClass("has-error");
                                           // alert("This ip already exsist in this kitchen !");
                                           $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('IP Exist In Kitchen ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                                            document.printer_master.lanip.focus();
                                            return false;
                                        }
                                        else if(data1 =="no"){
                                            
                                           $("#lanip_div").removeClass("has-error");
                                           
                                           
                  $(".new_overlay_print").css("display","block");
                  $(".popup_alert_box_new").css("display","block");
		  $(".popup_alert_box_new").text('PRINTER ADDED SUCCESSFULLY');
		    $(".printer_add_popup").css("display","none");
                    
               setInterval(function () {
                    document.getElementById("lanform").submit();
             
                }, 1000);
                                          
                   }
                                  

                   });
                       
                } 
	 
          //validatelanport
	 function validate_lanport()   
	  {
              var lanport=$("#lanport").val();
		  if(lanport=="")
		  {
		        $("#lanport_div").addClass("has-error");
                          
                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Lan Port  ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
			document.printer_master.lanport.focus();
                                   
					return false;
		  }
                             var alphanumers = /^[0-9]+$/;
                              if(!alphanumers.test($("#lanport").val())) {
                              $("#lanport_div").addClass("has-error");
                             
                             $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Valid Port  ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                             document.printer_master.lanport.focus();
                        
                   }  
                  else
			   {
                               if(lanport.length < 2)
                               {
                                
			  $("#lanport_div").addClass("has-error");
                            
                            $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Valid Port ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.lanport.focus();
                                   
					return false;
                               }
				  else{
                                      $("#lanport_div").removeClass("has-error");
                                 
				   $(this).addClass("has-success");
				   return true;
                                    }
			   }
	  }
          
          //validatelancount
	  function validate_lancount()   
	  {
		  if($("#lancount").val()=="")
		  {
			  $("#lancount_div").addClass("has-error");
                            
                            $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Count ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.lancount.focus();
                                      
					return false;
		  }
                  
                   var alphanumers = /^[0-9]+$/;
                              if(!alphanumers.test($("#lancount").val())) {
                              $("#lancount_div").addClass("has-error");
                            
                            $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Count ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                             document.printer_master.lancount.focus();
                         }
        
        else
			   {
				   $("#lancount_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
	  function validate_lanfloor()   
	  {
              var type = $('#lantype').val();
              
              
                  
		  if($("#lanfloor").val()==""&&type=='DI')
		  {
                      
                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Floor ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                          
			  $("#lanfloor_div").addClass("has-error");
                           
					document.printer_master.lanfloor.focus();
                                    
                                        return false;
		  }
           
                  else
			   {
                               
				   $("#lanfloor_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
                       
	  }
         
          function validate_lanfor()   
	  {
		  if($("#lanfor").val()=="")
		  {
			  $("#lanfor_div").addClass("has-error");
                          $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Printer For ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                         
					document.printer_master.lanfor.focus();
                                        return false;
		  }
                  else
			   {
				   $("#lanfor_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
           
           function validate_lankot()   
	  {
              if($("#lanfor").val()=="1" || $("#lanfor").val()=="4" )
              {
		  if($("#lankot").val()=="")
		  {
			  $("#lankot_div").addClass("has-error");
                           
                           $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select  Kot Type ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.lankot.focus();
                                        return false;
		  }
                  else {
                        $("#lankot_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
                      return true;
                  }
              }
                  else
			   {
				   $("#lankot_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
				   return true;
			   }
                       
	  }
           
          
          function validate_lanstyle()   
	  {
		  if($("#lanstyle").val()=="")
		  {
			  $("#lanstyle_div").addClass("has-error");
                         
                          $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Style ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.lanstyle.focus();
                                       
                                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Style ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					return false;
		  }else
			   {
				   $("#lanstyle_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
          
         
          
          function validate_usbprnname()   
	{
          
                         if($("#usbprnname").val()=="")
				{
					$("#usbprnname_div").addClass("has-error");
                                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Printer Name ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                                      
						  document.printer_master.usbprnname.focus();
                                                 
						  return false;
				}
 
                                else
					 {
				 var a=document.getElementById("usbprnname").value;
				 $("#usbprnname_div").removeClass("has-error");
			         $(this).addClass("has-success");
				 return true;
					 }
        }
        
        
	
	
	//validatelanip
	
	function validate_usbip() 
	  {
		  var ipad=$("#usbip").val();
	   if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipad))
		{
			$("#usbip_div").removeClass("has-error");
			return (true);
			
		}else
		{
			$("#usbip_div").addClass("has-error");
                      
                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Valid Ip');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                        
			 document.printer_master.usbip.focus();
                         
			 return false;
		}
	  } 
	 
	 
        //validatelanport
	  function validate_usbname()   
	  {
            if($("#usbname").val()=="")
				{
					$("#usbname_div").addClass("has-error");
                                        
                                        $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Name ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
						  document.printer_master.usbname.focus();
                                                 
						  return false;
				}

                                else
					 {
				 var a=document.getElementById("usbname").value;
				 $("#usbname_div").removeClass("has-error");
			         $(this).addClass("has-success");
				 return true;
					 }   
	  }
          
          
          //validatelancount
	  function validate_usbcount()   
	  {
		  if($("#usbcount").val()=="")
		  {
			  $("#usbcount_div").addClass("has-error");
                          
                           $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Count ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.usbcount.focus();
                                      
					return false;
		  }
                  
                   var alphanumers = /^[0-9]+$/;
                              if(!alphanumers.test($("#usbcount").val())) {
                              $("#usbcount_div").addClass("has-error");
                              $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Enter Count ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                             document.printer_master.usbcount.focus();
                         }
        
        else
			   {
				   $("#usbcount_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
	  function validate_usbfloor()   
	  {
               var type = $('#usbtype').val();
		  if($("#usbfloor").val()==""&&type=='DI')
		  {
                        $('.alert_error_prn').show();
                                    
                        $('.alert_error_prn').text('Select Floor ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
                          
			  $("#usbfloor_div").addClass("has-error");
                           
					document.printer_master.usbfloor.focus();
                                    
                                        return false;
		  }
                  else
			   {
				   $("#usbfloor_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
          function validate_usbfor()   
	  {
		  if($("#usbfor").val()=="")
		  {
			  $("#usbfor_div").addClass("has-error");
                           
                           $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Printer For ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.usbfor.focus();
                                        return false;
		  }
                  else
			   {
				   $("#usbfor_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
           function validate_usbkot()   
	  {
              if($("#usbfor").val()=="1" || $("#usbfor").val()=="4" )
              {
		  if($("#usbkot").val()=="")
		  {
			  $("#usbkot_div").addClass("has-error");
                        
                         $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select  Kot Type ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.usbkot.focus();
                                        return false;
		  }
                  else {
                        $("#usbkot_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
                      return true;
                  }
              }
                  else
			   {
				   $("#usbkot_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
				   return true;
			   }
                       
	  }
         
          function validate_usbstyle()   
	  {
		  if($("#usbstyle").val()=="")
		  {
			  $("#usbstyle_div").addClass("has-error");
                        
                          $('.alert_error_prn').show();
                            
                        $('.alert_error_prn').text('Select Style ');
                        $('.alert_error_prn').delay(1000).fadeOut('slow');
					document.printer_master.usbstyle.focus();
                                      
					return false;
		  }else
			   {
				   $("#usbstyle_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
          
          
          
			
			
function delete_confirm(id)
{
   // var check = confirm("Are you sure you want to Delete record?");
    var deltid= id;
    var a=$("#prid1").val().trim();
      //alert(a);
    //alert(deltid);

   
     $.ajax({
       			type: "POST",
			url: "load_printipsettings.php",
			data: "value="+deltid+"&mid="+a,
			success: function(data)
			{
			//msg=$.trim(msg);
                        data=$.trim(data);
                       //alert(data);
                       $('#printeriptable').html(data);
			
      
			}
			
		});
	
}
 function numonly(evt)
    { 
        evt = (evt) ? evt : window.event;
        
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        //alert(charCode);
        if ((charCode >47 && charCode< 58 )|| charCode==46){
            
            return true;

        }
        else{
            
        return false;
    }
    }       
    
     
     function confirm_yes_new(){
           
        var printer_id= $('#confirm_pop_all').attr('printer_id');
       
       
        var dataString = 'set=printer_delete&printer_id='+printer_id;
        $.ajax({
            type: "POST",
            url: "printer_master.php",
            data: dataString,
            success: function(data) {
                
                  $(".load_error_del").css("display","inline-block");
		  $(".load_error_del").text("PRINTER DELETED");
		  $('.load_error_del').delay(2000).fadeOut('slow');
                
                 setTimeout(function() {
                     
                     
				location.reload();
				   }, 1000);
                  
            }
        });
       
           
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
    }
    
function printer_delete(printer_id){
    
          $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM DELETE ?');
         
         $('#confirm_pop_all').attr('printer_id',printer_id);
         
   
    
}



function print_on_off(id,sts){
    
     var dataString = 'set=print_on_off&printer_id='+id+"&sts="+sts;
        $.ajax({
            type: "POST",
            url: "printer_master.php",
            data: dataString,
            success: function(data) {
                
                validateSearch();
            }
        });
    
}


function kot_miss_ok(){
    
    
    var confirm1=confirm(" CONFIRM ALL KOT'S MISSED ARE PRINTED IN DINE IN ?");
           
        if(confirm1===true){
    
        var data1167="set=check_missed_kot_set_ok";
        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: data1167,
        success: function(data2)
        {  
            alert('DONE');
            location.reload();
        }
       });
   }
    
}


function kot_miss_ok_ta(){
    
    
    var confirm1=confirm(" CONFIRM ALL KOT'S MISSED ARE PRINTED IN TA HD CS?");
           
        if(confirm1===true){
    
        var data1167="set=check_missed_kot_set_ta_ok";
        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: data1167,
        success: function(data2)
        {  
            alert('DONE');
            location.reload();
        }
       });
   }
    
}

</script>
<script type="text/javascript">
function validateSearch()
{// pnames pips pports ptypes pbranchs
  var pnames=$("#pnames").val();
  if(pnames=="")
  {
	  pnames="null";
  }
  var pips=$("#pips").val();
  if(pips=="")
  {
	  pips="null";
  }
   var pports=$("#pports").val();
  if(pports=="")
  {
	  pports="null";
  }
  var ptypes=$("#ptypes").val();
  if(ptypes=="")
  {
	  ptypes="null";
  }
   var pbranchs=$("#pbranch_kot").val();
  if(pbranchs=="")
  {
	  pbranchs="null";
  }
  
   var lan_usb_type=$("#lan_usb_type").val();
  if(lan_usb_type=="")
  {
	  lan_usb_type="null";
  }
  
  
  
  var on_off_type=$('#on_off_type').val();
  if(on_off_type=="")
  {
	  on_off_type="null";
  }
  
   var module_type=$('#module_type').val();
  if(module_type=="")
  {
	  module_type="null";
  }
  
  
	  $.ajax({ 
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchprint&pnames="+pnames+"&pips="+pips+"&pports="+pports+"&ptypes="+ptypes+"&pbranchs="+pbranchs+
                                "&lan_usb_type="+lan_usb_type+"&on_off_type="+on_off_type+"&module_type="+module_type,
			success: function(msg)
			{
			
				$('#listall').html(msg);
			   
			}
		});  

}


$(".flor_copy_btn").click( function(){ 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		
		$(".floor_copy").removeClass("copy_flor_cc");
		//$(".florrval"+selval).css('display','block');
			$(".florrval"+selval).addClass("copy_flor_cc");
			//$(".flor_copy_btn").show();
		});
		
		$(".ok_btn").click( function(){ 
		
		var printercopy=$("#printercopy").val();
		if(printercopy!="")
		{
			var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		$(".florrval"+selval).removeClass("copy_flor_cc");
		//$(".florrval"+selval).css('display','none');
	
		 $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=addprintercopy&new_printerid="+printercopy+"&printerid="+selval,
			success: function(msg)
			{
				msg=msg.trim();
			alert(msg);
			/*	$('#ratechng').css("display","block");
			var ratechng1=$('#ratechng');
			ratechng1.text('Rate changed successfully!!');
					 $(".load_error").delay(2000).fadeOut('slow');*/
					
				
		   }
		});
		}else
		{
                    
		     alert("select Printer");
		
					
		}
		
		
		
		
		});


// JS is only used to add the <div>s
var switches = document.querySelectorAll('input[type="checkbox"].ios-switch');

for (var i=0, sw; sw = switches[i++]; ) {
	var div = document.createElement('div');
	div.className = 'switch';
	sw.parentNode.insertBefore(div, sw.nextSibling);
}

		
		
</script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>
 <div class="qr-overlay" id="qrModal" style="display:none">
  <div class="qr-box">
      <h3 style="font-weight: bold;font-family: 'FontAwesome'; ">PRINT LOGO</h3>
    
      <img  src="img/print-logo/print_logo.png" alt="QR Code">
   <h4 style="font-weight: bold;font-family:monospace;color: darkred;font-size: 12px; ">(Size : 351x351 pixels |  png file) </h4>
    <button class="close-btn66" onclick="document.getElementById('qrModal').style.display='none'">&times;</button>
  </div>
</div>

<style>
/* Overlay background */
.qr-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

/* QR box */
.qr-box {
  position: relative;
  background: #fff;
  padding: 20px 25px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
  min-width: 200px;
}

/* Heading */
.qr-box h3 {
  margin: 0 0 15px 0;
  font-size: 18px;
  color: #333;
}

/* QR image */
.qr-box img {
  width: 150px;
  height: 150px;
  object-fit: contain;
}

/* Close button */
.close-btn66 {
  position: absolute;
  top: 4px;
  right: -14px;
  border: none;
  background: transparent;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  color: #888;
  transition: color 0.2s;
}


</style>
<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>