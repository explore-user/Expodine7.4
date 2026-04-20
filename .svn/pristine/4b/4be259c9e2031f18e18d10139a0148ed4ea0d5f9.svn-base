<?php
include('includes/session.php'); // Check session
//session_start();
include("database.class.php"); // DB Connection class

$database	= new Database();

if($_SERVER['REQUEST_METHOD']=='POST' )
{
	//$insertion['ls_username'] 		=  $_REQUEST['modtype'];
	 $mod 		=  $_REQUEST['modtype'];
	if($mod=="main1" && $_REQUEST['mainmoduletext']!="")
	{
		 $insertion['mer_modulename'] =$_REQUEST['mainmoduletext']; 
		 $insertion['mer_modulelink'] =$_REQUEST['linkname']; 
		 $sql=$database->check_duplicate_entry('tbl_modulemaster',$insertion);
		 if($sql!=1)
		 { //echo "ok";die();
			 $insertid              			=  $database->insert('tbl_modulemaster',$insertion);
			if (!headers_sent())
			{    
				header('Location: user_permission.php?msg=2');
				exit;
				}
			else
				{  
				$msg="yes";
				echo '<script type="text/javascript">';
				echo "alert('$msg')";
				echo 'window.location.href="user_permission.php?msg=2";';
				echo '</script>';
				echo '<noscript>';
				echo '<meta http-equiv="refresh" content="0;url=user_permission.php?msg=2" />';
				echo '</noscript>'; exit;
			}
		 
		 }  
		 
	}else if($mod=="sub1" && $_REQUEST['submodule']!="")
	{
		$insertion['mser_moduleid'] =$_REQUEST['mainmodule'];
		$insertion['mser_subname'] =$_REQUEST['submodule'];
		$insertion['mser_submodulelink'] =$_REQUEST['sublinkname']; 
		$sqlchk=$database->check_duplicate_entry('tbl_modulesubmaster',$insertion1);
		if($sqlchknw!=1)
		 {//echo "ok";die();
			$insertid              			=  $database->insert('tbl_modulesubmaster',$insertion);
			if (!headers_sent())
			{    
				header('Location: user_permission.php');
				exit;
			}
			else
			{  
				echo '<script type="text/javascript">';
				echo 'window.location.href="user_permission.php"';
				echo '</script>';
				echo '<noscript>';
				echo '<meta http-equiv="refresh" content="0;url=user_permission.php" />';
				echo '</noscript>'; exit;
			}
		 }   
	}

}


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
<title>User Permission</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<!-- Fonts -->	
<link rel="shortcut icon" href="img/favicon.ico">
<!-- Styles -->
<link href="css/bootstrap-combined.min.css" rel="stylesheet">
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
 

<style>#ascrail2001{z-index: 9999999999999999999 !important;left:0px !important } 
.responstable th {background-color: #ad1c1c;}
#left_table_scr_cc {min-height: 500px;height: 72.5vh}
.tab_table_cont_cc {height: 72vh;min-height: 500px;position:relative;}
.md-content{display:inline-block;}
.md-content button{position:relative !important}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
</style>
<!--<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>
-->
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	  $('.ediprv').click(function () { 
	   $('.disablelook').removeClass('disable_user_detail');
	  $('#addnewmod').css("display","none");
	  	$('#editprevg').css("display","block");
     });
	 
	  $('.canclpriv').click(function () { 
	  $('.disablelook').addClass('disable_user_detail');
	  $('#addnewmod').css("display","block");
	  	$('#editprevg').css("display","none");
		
     });
	 
	
	 
	  $('.added_ok_btn').click(function () { 
	  $('.inherit_added_popup').css("display","none");
	  $('.change_permission_overlay').css("display","none");
     });
	 
	 
	 

	 
 	}); 
 </script>
    <!-- Privlg ends-->
    
    
    
  <!-- Privlg to staff starts  -->
<script type="text/javascript">
$(document).ready(function(){
    
  $('.setprivil').click(function () {
	
	   $('.disablelook').addClass('disable_user_detail');
	   $('#addnewmod').css("display","block");
	   $('#editprevg').css("display","none");
	  var id_str   =  $(this).attr("stfid");
	  var id_arr	  =	 id_str.split("_");
	  var selval       =  id_arr[1]; 
	  //window.location="user_permission.php?stfid="+selval+"&set=load";
	  $('.setprivil').removeClass('table_active');
	  $(this).addClass('table_active');
	 /// setprivil table_active 
	   var data = {
					"set": "load",
					"stfid" :  selval
				  };
	data = $(this).serialize() + "&" + $.param(data);
	  
	  
	   $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
					
			$('#loadfulldata').html(data);
                     
                    }
                });
	  
	  
	   
	   });
	 
 	}); 
 </script>
    <!-- Privlg to staff ends-->


  <!-- submit privilege starts  -->    
<script type="text/javascript">
$(document).ready(function(){
    
    
    
$('.okprivl').click(function() {
    
    $('#overlay').fadeIn();

                //permisn permisn_sub
                 $('.disablelook').addClass('disable_user_detail');
                                $('#addnewmod').css("display","block");
                                $('#editprevg').css("display","none");
                 var data = $("form").serialize(); 
                //alert(data);
                $.ajax({
                    url: "load_permission.php", // link of your "whatever" php
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, // all data will be passed here
                    success: function(data){ 
                       // alert(data) // The data that is echoed from the ajax.php
                       
                        setTimeout(function () {
                              $('#overlay').fadeOut();
                        }, 1000); // 5 seconds
                       
                       
                    }
                });
});
}); 
</script>
 <!-- submit privilege starts  -->        
   
   
  <!-- check all check box starts  -->    
<script type="text/javascript">  
   // permisn permisn_sub
   $(document).ready(function() {
    $('.checkallchek').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });       
        }
    });
    
});
 </script>
 <!-- check all check box starts  -->        
    
    <script>
$(document).ready(function(){
	
	$('.md-trigger_perm').click( function() {
            
            
            $('.alert_error_popup_all_in_one').show();
            
            $('#password_admin').focus();
            
            	    
	});
	
        
       $('#proceed_admin').click( function() {
           
           var pass= $('#password_admin').val();
            
		if(pass=='5555'){
                    
                 $('.alert_error_popup_all_in_one').hide();  
                 
			  $.post("popup/permission_add.php", 
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });
				   
			$(".olddiv").addClass("new_overlay");
                        
                    }else{
                        
                        alert('INVALID CODE') ;
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
</style>
  
</head>
<body>
    
    <div id="overlay">
    <div class="loader-box">
        <div class="spinner"></div>
        <p style="color:white">Setting Permissions...</p>
    </div>
    </div>
    <style>
        #overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    display: none;
    z-index: 9999;
}

.loader-box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #fff;
    border-top: 5px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 10px;
}

@keyframes spin {
    100% { transform: rotate(360deg); }
}
    </style>
    
    
  <strong id="alert_error_popup_all_in_one" class="alert_error_popup_all_in_one" style="display: none;    height: 135px;">
   AUTHORIZATION
      <input style="color:black;margin-top: 5px;" type="password" id="password_admin" maxlength="4" placeholder="Enter Your Code" > <br>
      
      <a href="#" id="proceed_admin" style="color:white;top: 85px;right:125px;position: absolute;border: solid 1px;border-radius: 4px;padding: 2px">Proceed</a>
      
      <a href="user_permission.php" style="color:white;top: 85px;right:64px;position: absolute;border: solid 1px;border-radius: 4px;padding: 2px">Close</a>
  </strong>    
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>

<div class="mian">
	<div class="view-container">
		<div id="container">
		
			
                <div class="content-sec">
                
           <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
                
               <!-- box head -->
               <div class="table_main_heading">
                    	<!--<a href="#"><div class="user_detail_del_btn">Delete</div></a>-->
                    USER PERMISSION
                    <!--<a href="#"><div class="user_detail_add_btn" style="float:right">EDIT</div></a>-->
                      <div style="width:110px;position: absolute;right: 8px;top: -15px;" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #7abd7a;font-size: 14px;height: 30px;line-height: 30px;color:black;font-weight: bold" href="staff_master.php" >STAFF MASTER</a></div>
                    </div>
                    
               <!-- end box head -->
                	<div class="col-lg-12 col-md-12 middle_container nopadding">
                    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 left_container">
                        	<div class="col-lg-12 col-md-12 min-height nopadding">
                            	<div class="text_displaying_contain">
 										<div class="master_page_tab_cc">
                                        	<div style="background:#E5E5E5; width:99.8%; height:auto; overflow:auto; margin:1px;">
                                            <span class="tab_menu_head">
                                           		<!--<a class="md-trigger" data-modal="modal-16" href="#"><div class="user_detail_add_btn">ADD</div></a>-->
                                               		<span>USER LIST</span>
                                               </span><!--tab_menu_head-->
                     
                    	
                    </div><!--div-->
                                       <div id="left_table_scr_cc"> 
                                                <table class="responstable">
                                                  
                                                  <tr>
                                                    <!--<th>Staff Id</th>-->
                                                    <th>Staff name</th>
                                                    <th>Username</th>
                                                    <th>Designation</th>
                                                    <th>Status</th>
                                                   <!-- <th width="20%">Action</th>-->
                                                  </tr>
<?php
//`tbl_staffmaster`(`ser_staffid`, `ser_firstname`, `ser_lastname`, `ser_gender`, `ser_designation`, `ser_department`, `ser_dob`, `ser_address1`, `ser_address2`, `ser_city`, `ser_state`, `ser_country`, `ser_dateofjoin`, `ser_mobileno`, `ser_alternateno`, `ser_nationality`, `ser_email`, `ser_employeestatus`, `ser_remarks`, `ser_idtype`, `ser_idno`, `ser_headofficeid`, `ser_branchofficeid`)
// `tbl_logindetails`(`ls_username`, `ls_password`, `ls_branchid`, `ls_headofficeid`, `ls_applogin`, `ls_staffid`)
//$sql_login  =  $database->mysqlQuery("select * from tbl_logindetails LEFT JOIN tbl_staffmaster ON tbl_logindetails.ls_staffid=tbl_staffmaster.ser_staffid "); 

if($_SESSION['designtnname'] !="Super Admin")
{
$sql_login  =  $database->mysqlQuery("Select tbl_designationmaster.dr_designationname,tbl_staffmaster.ser_firstname,tbl_staffmaster.ser_lastname,tbl_logindetails.ls_username,tbl_staffmaster.ser_employeestatus,tbl_logindetails.ls_branchid,tbl_logindetails.ls_applogin,tbl_staffmaster.ser_staffid From tbl_designationmaster Inner Join tbl_staffmaster On tbl_staffmaster.ser_designation = tbl_designationmaster.dr_designationid Inner Join tbl_logindetails On tbl_logindetails.ls_staffid =tbl_staffmaster.ser_staffid WHERE  tbl_staffmaster.ser_employeestatus='Active' AND tbl_designationmaster.dr_designationname <>'Super Admin' ");
}
else
{
	
	$sql_login  =  $database->mysqlQuery("Select tbl_designationmaster.dr_designationname,tbl_staffmaster.ser_firstname,tbl_staffmaster.ser_lastname,tbl_logindetails.ls_username,tbl_staffmaster.ser_employeestatus,tbl_logindetails.ls_branchid,tbl_logindetails.ls_applogin,tbl_staffmaster.ser_staffid From tbl_designationmaster Inner Join tbl_staffmaster On tbl_staffmaster.ser_designation = tbl_designationmaster.dr_designationid Inner Join tbl_logindetails On tbl_logindetails.ls_staffid =tbl_staffmaster.ser_staffid WHERE  tbl_staffmaster.ser_employeestatus='Active' ");
	
}

 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {	$i=0;	
	    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['ls_branchid']!="")
				{
					$type="branch";
				}else  if($result_login['ls_headofficeid']!="")
				{
					$type="headoffice";
				}
					
					
			if($result_login['ls_applogin']=="Y")
				{
						$applogin="Yes";
				}else 
				{
						$applogin="No";
				}
				if(!isset($_REQUEST['stfid']))
				{
					if($i==0)
					{
					$_SESSION['stfidsess']=$result_login['ls_username'];
					}
				}else
				{
					$_SESSION['stfidsess']=$_REQUEST['stfid'];
				}
				
?>                                               
                                                  <tr class="setprivil  <?php if($_SESSION['stfidsess']==$result_login['ls_username']){ ?> table_active  <?php } ?>" stfid="sf_<?=$result_login['ls_username'] ?>" > <!--table_row_active-->
                                                   <!-- <td><?$result_login['ser_staffid'] ?></td>-->
                                                    <td><a class="change_permission_btn" id="ids_<?=$result_login['ls_username']?>">
                                                            
                                                            
                                                        <?php if($result_login['ls_username']!='admin'){ ?>    <div class="permission_change_user"><img src="img/user_per_mn_ico.png"></span></div> <?php } ?>
                                                            
                                                        </a><input type="hidden" name="hiduser" id="hiduser">     <?=$result_login['ser_firstname']." ".$result_login['ser_lastname'] ?>
                                               <!--     
                                                    <a class="floor_permission" >
                                                    	<div class="permission_change_user" style="line-height:inherit;margin-left:2%">
                                                        	<img style="width:100%" src="img/floors_icon.png">
                                                        </div></a>-->
                                                    
                                                    
                                                    </td>
                                                    <td><?=$result_login['ls_username'] ?></td>
                                                    <td><?=$result_login['dr_designationname'] ?></td>
                                                    <td><?=$result_login['ser_employeestatus'] ?></td>
                                                    
                                                
                                                    
                                                      <!--<td>
                                                      <a class="tab_edt_btn" href="#"><i class="fa fa-eye"></i></a>
                                                      <a class="tab_edt_btn" href="#" ><i class="fa fa-edit"></i></a>
                                                      <a class="tab_edt_btn" href="#" ><i class="glyphicon glyphicon-trash"></i></a>
                                                      </td>-->
  <?php $i++;} } ?>     </tr>
                                                  
                                                  
                                                  
                                                </table>
                                                </div><!--left_table_scr_cc-->
                                            </div>    
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
                        
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 left_container">
                        	<div class="col-lg-12 col-md-12 min-height nopadding">
                            	<div class="text_displaying_contain">
									<div class="master_page_tab_cc">
                                    
                                               <span style="  margin: 1px;width: 99.8%;" class="tab_menu_head">
                                               <?php if(in_array("User_permission_edit", $_SESSION['menusubarray'])) { ?>  
                                                <div id="addnewmod" style="display:block;float:left">
                                                <a class="pull-left ediprv"  href="#" style="cursor:pointer" ><div class="user_detail_add_btn">Edit Privileges</div></a>
                                                
                                                 </div>
                                                 <?php } ?>
                                                 <div id="editprevg" style="display:none;float:left;">
                                                    <a class=" pull-right okprivl" id=""   style="margin-left:10px;cursor:pointer"><div class="user_detail_add_btn">OK</div></a>
                                                    <a class=" pull-right canclpriv"  style="cursor:pointer"><div class="user_detail_add_btn">Cancel</div></a>
                                                    
                                                    </div>
                                                  
                                               		<span>MODULE ACCESS </span>
                                                   
                                                   <?php //if($_SESSION['s_userpermissionadd']=="Y") { ?>
                                                    <a class="md-trigger_perm pull-right"  href="#" ><div class="user_detail_add_btn">ADD</div></a>
                                                    <?php //} ?>
                                                   
                                                    
                                                   
                                               </span><!--tab_menu_head-->
                                               <!---->
                                                   
                    
												<span class="tab_table_cont_cc">
                                                <div class="disablelook disable_user_detail">
                                                <form>		
                                                        <div class="module_check_box_cc">
                                                        	<div class="main_text_cc" id="loadfulldata">
                                                            <input type="hidden" value="<?=$_SESSION['stfidsess'] ?>" name="stf" id="stf" >
                                                            <input type="hidden" value="insert" name="set" id="set" >
                                                            <div   class="module_cat_head user_details_heading_check">
                                                                	<span><input type="checkbox" class="check_box_main checkallchek" ></span>
                                                                    <span style="font-size:15px;padding-left:5px">CHECK ALL</span>
                                                                   <span style="font-size: 21px;width: 50%;display: inline-block;text-align: right;text-transform: uppercase;font-weight:bold;color: darkred"> <?=$_SESSION['stfidsess'] ?></span>
                                                                </div>
                                                            
                                                            
                                                            
                                         <?php
															
                                          $sql_mainmod  =  $database->mysqlQuery("select * from tbl_modulemaster order by mer_modulename asc "); 
                                          $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
                                          if($num_mainmod){
					  while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
					  {
					   ?>
<script type="text/javascript">
$(document).ready(function () {
    
    
    
    

    $(".topic<?=$result_mainmod['mer_moduleid']?>").click(function(){
      //alert("mm");  
      var is_checked=$(this).is(":checked");

       // $(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").prop("checked",is_checked);
		//alert("2");
    });
    $(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']").click(function() {
     //  alert("kk");  
      var  is_checked=$(this).is(":checked");
        
        if($(".inputs-list<?=$result_mainmod['mer_moduleid']?> > li > input[type='checkbox']:checked").length == 0)
			{
			   $(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",false); 
			}else
			{
				$(".topic<?=$result_mainmod['mer_moduleid']?> input[type='checkbox']").prop("checked",true);
			   
			}
    });
    
    
    
    $('#multi_check_<?=$result_mainmod['mer_moduleid']?>').click(function(){ 
    

    if($("#multi_check_<?=$result_mainmod['mer_moduleid']?>").prop('checked') == true){ 
        
      $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
          
        $(this).prop('checked',true);
    
   });
     
   }else{
       
        $('.permisn_sub1_<?=$result_mainmod['mer_moduleid']?>').each(function(){
            
        $(this).prop('checked',false);
       
        });
   
   }
     
    
});
    
    
    
    
    
});

</script>

                                                    <?php 
													$module=$database->show_usermodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess']); 
													$modulest=$module['um_access'];
													if($result_mainmod['mer_modulename']!="Admin Home"){
                                                                                                            
                                                                                                       if($result_mainmod['mer_modulename']=="User Permission" && $_SESSION['stfidsess']=='admin'){
                                                                                                           $clas_edit='disablegenerate';
                                                                                                       }else{
                                                                                                            $clas_edit='';
                                                                                                       }
                                                                                                            
                                                                                       ?>
                                       

                                                            	<div class="<?=$clas_edit?> module_cat_head topic<?=$result_mainmod['mer_moduleid']?>">
                                                                	<span>
                                                                    <?php 
																	
									if($result_mainmod['mer_modulename']!="Home Page"){ ?> 
                                                                            <input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn " <?php if($modulest!=""){ ?> checked="checked" <?php } ?> value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php }else { ?>
                                                                     <input id="multi_check_<?=$result_mainmod['mer_moduleid']?>" type="checkbox" class="check_box_main permisn "  checked  value="<?=$result_mainmod['mer_moduleid']?>"  name="permisn[]"  >
                                                                     <?php } ?>
                                                                    </span>
                                                                    <span style="font-weight:bold;text-transform: uppercase"><?=$result_mainmod['mer_modulename']?></span>
                                                                </div>
                                                                <?php } ?>
                                             <div class="subtopic">
                                             <ul class="inputs-list<?=$result_mainmod['mer_moduleid']?>">
                                                <?php
					  $sql_submod  =  $database->mysqlQuery("select * from tbl_modulesubmaster where mser_moduleid='".$result_mainmod['mer_moduleid']."' order by mser_subname asc "); 
                                          $num_submod   = $database->mysqlNumRows($sql_submod);
                                          if($num_submod){
											  while($result_submod  = $database->mysqlFetchArray($sql_submod)) 
												{
													$submodule=$database->show_usersubmodule_ful_details($result_mainmod['mer_moduleid'],$_SESSION['stfidsess'],$result_submod['mser_submoduleid']);
													$submodulest=$submodule['um_access'];
													$filter=explode(" ",$result_submod['mser_subname']);
													if($filter[0]!="Load"){
													if($result_submod['mser_subname']!="Default"){
                                                                                                            
                                                                                                     if($result_submod['mser_subname']=="User Permission Edit" && $_SESSION['stfidsess']=='admin'){
                                                                                                           $clas_edit='disablegenerate';
                                                                                                       }else{
                                                                                                            $clas_edit='';
                                                                                                       }        
                                                                                                            
                                                                                                            
                                         ?>                
                                                               <li class="module_sub_category">
                                                                
                                                                	<input type="checkbox" class="<?=$clas_edit?> check_box_main permisn_sub permisn_sub1_<?=$result_mainmod['mer_moduleid']?>" <?php if($submodulest!=""){ ?> checked <?php } ?> value="<?=$result_submod['mser_submoduleid']?>"  name="permisn_sub[]" >
                                                                    <span><?=$result_submod['mser_subname']?></span>
                                                                <!--module_sub_category-->
                                                                </li>
                                                <?php  }}} } ?> 
                                                </ul> 
                                                 </div>
                                                            
                                                           <?php } } ?>     
                                                           
                                                           
                                                           
                                                           
                                                           
                                                               
                                                                
                                                            </div><!--main_text_cc-->
                                                        </div><!--module_check_box_cc-->
                                                </form>
                                                </div>
                                               	
                                                </span>  <!--tab_table_cont_cc-->                                              
                                                   
                                           
                                    
                                    </div>
                                           	    
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
                       
                    </div><!--middle_container-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>

<!--Dock-->
<!--
<div id="dock-wrapper">
    <div class="dock">
      <div class="dock-front">
    	    <img src="images/arrow-up.png" alt="Arrow Up" id="arrow-up" />
      </div>
      <div class="dock-top">
    	    <img src="images/arrow-down.png" alt="Arrow Down" id="arrow-down" />
      </div>
    </div>
    <div class="item">
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
        <a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    	<a href="#"><img src="images/launcher-pro.png" width="60" /></a>
    </div>
  </div>-->
<!--/Dock-->
</div><!--container-->

        
               
<div class="md-overlay"></div><!-- the overlay element -->


 <div class="change_permission_popup">
 	<h3>Inherit User Rights</h3>
    <div class="change_permission_content">
    
    	<div class="edit_menu_label_permission" >
                 <div class="label_main_member_edit">From</div>
                 
                 
                  <select class="form-control_main"  placeholder="User Name"  id="usernm" name="usernm" >
                   <option value=""></option>
                                         <optgroup label="User_name">
                                         </optgroup>
                                    	 </select>
                  </select>
         </div><!---edit_menu_label-->
    
           <div class="change_permission_popup_btn">
         		<a href="#"><div class="pop_btn_new_1 inherit_ok_bt" id="ok"  onClick="validate_permisn()"  >OK</div></a>
                <a href="#"><div class="pop_btn_new_1" id="canc">Cancel</div></a>
         </div>
         
         
         
    </div><!--change_popup_content-->
 </div><!--change_password_popup-->
 
 
<div class="inherit_added_popup">
	<h3> Successfully Added</h3>
    <div class="change_permission_content">
    	<p class="inherit_added_text">Inherited successfully</p>
    </div>
     <div style="display:none" class="change_permission_popup_btn">
         <a  href="#"><div class="pop_btn_new_1 added_ok_btn">OK</div></a>
                <a href="#"><div class="pop_btn_new_1 added_ok_btn">Cancel</div></a>
     </div>
    
</div><!--inherit_added_popup-->

<div class="floor_permission_popup">
	<h3>Floor Permission</h3>
    <div class="floor_permission_pop_contant">
    	<table width="100%" border="0">
          <tr>
            <th width="60%" scope="col">Floor</th>
            <th width="10%" scope="col">Yes</th>
             <th width="10%" scope="col">No</th>
          </tr>
          <tr>
            <td>A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
          <tr>
            <td>None A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
          <tr>
            <td>A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
           <tr>
            <td>A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
          <tr>
            <td>None A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
          <tr>
            <td>A/C</td>
            <td><input name="" type="checkbox" value=""></td>
            <td><input name="" type="checkbox" value=""></td>
          </tr>
        </table>

    </div>
    <div class="change_permission_popup_btn" style="margin-top:10px;">
                 <a href="#"><div class="pop_btn_new_1 close_pop" >Cancel</div></a>
                 <a href="#"><div class="pop_btn_new_1 close_pop" >Submit</div></a>

         </div>

</div><!--floor_permission_popup-->

 
<div class="change_permission_overlay"></div>
<style>
    .disablegenerate { pointer-events: none; opacity: 0.4; cursor:none;}
 .change_permission_popup{
    width:350px;
    height:120px;
	 margin:auto;
	 position:fixed;
	 left:0;
	 right:0;
	 top:20%;
	 background-color:#fff;
	 z-index:9999999;
	 display:none;
	 }
.change_permission_popup h3 {
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
.change_permission_content{
	width:100%;
	height:auto;
	float:left;
	padding:2%;
	}
	
.edit_menu_label_permission .label_main_member_edit {
    width:15% !important;
    line-height: 25px !important;
    font-family: 'Arimo';
    font-size: 14px;
    color: #333;
    padding-left: 5px;
    padding-top: 4px;
	float:left;
}
.edit_menu_label_permission {
    width: 100%;
    height: auto;
    float: left;
    margin-bottom: 10px;
}
.edit_menu_label_permission .form-control_main {
    display: block;
    width:83%;
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
.change_permission_popup_btn{
	width:100%;
	height:40px;
	float:left;
	text-align:center;
	margin-top:-2px;
	}


.pop_btn_new_1 {
    width: 130px;
    height: 30px;
    display: inline-block;
    margin: auto;
    background-color: #891500;
    color: #fff;
    text-align: center;
    line-height: 30px;
    font-size: 16px;
    border-radius: 5px;
    margin: 1%;
    cursor: pointer;
	transition:all 0.2s ease;
}
.pop_btn_new_1:hover{
	background-color:#333
	}	

.change_permission_popup_btn .pop_btn_new_1 {
    width: 100px;
    height: 25px;
    line-height: 23px !important;
	}
	
 .change_permission_overlay{
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 width:100%;
	 height:100%;
	 top:0;
	 left:0;
	 z-index:999999;
	 display:none;
	 }	
	.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{
    width:100px;
    height:100px;
    margin:300px;
}
</style>


<!--<script src="master_style/menu/js/app.js"></script>-->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script src="master_style/js/menu/app.js"></script>-->

<!--<script>!window.jQuery && document.write(unescape('%3Cscript src="javascript/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>-->
<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>

<script type="text/javascript" src="js/app.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
$(document).ready(function() {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    
    $('#tabs a').click(function(e) {
        //e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
})();
</script>

<!--
<script src="js/jquery.nicescroll.min.js"></script>-->
   <script>
  $(document).ready(function() {
	        $(".md-trigger").click(function () {
                $("#blr").addClass("blr");
			});
			 $(".md-close").click(function () {
                $("#blr").removeClass("blr");
			});
			// $(".md-overlay").click(function () {
//                $("#blr").removeClass("blr");
//			});
  document.documentElement.style.overflow = 'hidden';
	var nice = $("html").niceScroll({horizrailenabled:false});  // The document page (body)
	$("#div1").html($("#div1").html()+' '+nice.version);
    //$("#container").niceScroll({touchbehavior:true}); // First scrollable DIV text_displaying_contain  
	 $("#guest_scroll").niceScroll({touchbehavior:true});
	  $(".menu").niceScroll({touchbehavior:true,horizrailenabled:false});
	   $(".text_displaying_contain").niceScroll({horizrailenabled:false});
	    $("#tabs").niceScroll({touchbehavior:true});
		$("#content>div").niceScroll({touchbehavior:true,horizrailenabled:false});
		$("#left_table_scr_cc").niceScroll({touchbehavior:true,horizrailenabled:false});
		$(".tab_table_cont_cc").niceScroll({horizrailenabled:false});
$(".menu").mouseover(function() {
  $(".menu").getNiceScroll().resize();
});

	 
	
  });


</script>



<script type="text/javascript">

function validate_modules()
{
	document.userpermission.submit();
}

</script>

<script>
$(".change_permission_btn").click(function(){
	
	
	  var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	$('#hiduser').val(selval);
	viewcity();

    $(".change_permission_overlay").show();
	$(".change_permission_popup").show();
	
	
	
	
});

$("#canc").click(function(){
	
	
	
	/*$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loaduser&id="+a,
		  success: function(msg)
		  {
			 $('#usernm').html(msg);
		  }
	  }); 
	*/
	
	
    $(".change_permission_overlay").hide();
	$(".change_permission_popup").hide();
});


function validate_permisn()
{
    
       $('.confrmation_overlay_proce').css('display','block');
	$('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
                     
	var a=$('#hiduser').val();
	var b=$('#usernm').val();
	
	$.ajax({
		  type: "POST",
		  url: "load_divcheckmenu.php",
		  data: "value=loaduser_permsn&frm="+a+"&to="+b,
		  success: function(msg)
		  {
			
			  msg=$.trim(msg); 
			  if(msg == "ok")
			  {
			      $('.inherit_added_popup').css("display","block");
	                      $('.change_permission_overlay').css("display","block");
                              
                               setTimeout(function () {
                                   location.reload();
                                }, 1500);
			  }
			  else
			  {
				  
			  }
			//  alert(msg);
			// $('#usernm').html(msg);
		  }
	  }); 
	
		
  $(".change_permission_overlay").hide();
    $(".change_permission_popup").hide();
	
	
}

   
function viewcity()
{
	var a=$('#hiduser').val();
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loaduser&id="+a,
		  success: function(msg)
		  {
			 $('#usernm').html(msg);
		  }
	  }); 
} 
</script>
<!-- Script -->

<script type="text/javascript">
$(".floor_permission").click(function(){
    $(".floor_permission_popup").css("display","block");
	$(".change_permission_overlay").css("display","block");	
});

$(".close_pop").click(function(){
    $(".floor_permission_popup").css("display","none");
	$(".change_permission_overlay").css("display","none");
});
</script>


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
<div style="display:none" class="confrmation_overlay_proce"></div>
</body>
</html>