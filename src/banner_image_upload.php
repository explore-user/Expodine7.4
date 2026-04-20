<?php
session_start();
//include('includes/session.php');		
include("database.class.php"); 
$database	= new Database();		
//error_reporting(0);
if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="delete_banner" )){
    
    unlink($_REQUEST['loc']);
    
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=="encrypt") 
{  
    $string=$_REQUEST['enc_data']; 
   
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

  
    $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    
    echo   $output;


}



 $loc=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 
 
 
 

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Setups</title>
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
 <script src="js/jquery-2.1.3.min.js"></script><!--jquery-1.10.2.min-->
<script src="master_style/js/modernizr.custom.js"></script>
<style>
.container{background-color:transparent;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 74vh;min-height: 474px;}
.md-content > div{overflow:auto}
.form_name_cc{font-size:13px;height:30px;line-height:30px;}
.first_form_contain{padding: 0.5%;margin-bottom: 0px;}
.md-modal{width:70%;min-width:800px;}
.md-content > div{max-height:550px;overflow:auto;padding-bottom:60px;}
.md-modal .form-control{ height: 33px;padding: 5px 12px;}
.popup_add_table tr:nth-child(even) {background: #E0E0E0;}
.popup_add_table td {height: 38px;font-size: 14px;border:solid 1px #ccc;}
.md-content .form_name_cc{text-align:left;line-height:22px;min-height:30px;height:auto}
.new{width:27px;height:27px;float:right}
.image-crop input[type="file"]{margin-top:0;}
.upld_img_sec{padding:10px;background-color:#fff;position:relative;margin-right:5px;overflow:hidden}
.upld_img_sec span{position:absolute;left:0;right:0;top:0;bottom:400px;width:40px;height:40px;background-color:#fff;border-radius:50%;margin:auto;text-align:center;line-height:40px;transition:0.2s ease}
.upld_img_sec span img{width:18px}
.upld_img_sec:hover span{bottom:0}
.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
</style>

</head>
<body id="loadfull" >
    <input type="hidden" id="page_url" value="<?=$loc?>">
    
<div class="olddiv "></div> 
<div class="container nopaddding" >
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">IMAGE UPLOAD SECTION </a></li>
				</ul>
			</div><!-- breadcrumbs -->
            
                <div class="content-sec">
                	<div style="padding: 2px;display: none" class="col-lg-12 col-md-12 main_cc load_cloud">
                     
                            <div style="min-height: inherit;height:auto; overflow: hidden; " class="branch_master_main_container">
                               
                                
                                
                                <div class="new_branch_main_setings_head" style="position:relative;">
                                    <div style="width: 10%;left:6px !important;" class="branch_next_btn_member_invoice"><a href="menu.php" >Back</a></div>  &nbsp;&nbsp;&nbsp;&nbsp;
                                    <div style="width: 13%;left:0px !important;margin-left: 150px" class="branch_next_btn_member_invoice"><a href=" https://app.bitly.com/Bk3c8gmGSaB/bitlinks/3p9ZGyE"  target="_blank"  > SHORTLINK URL</a></div>
                                    CLOUD SECTION :  <?=$_SESSION['firebase_id']?>
                                    <div style="width: 17%; right:11px !important;background-color: #78a039;height: 78%;border-radius: 4px;cursor: pointer" class="branch_next_btn_member_invoice"><a target="_blank" href="https://www.the-qrcode-generator.com">QR CODE GENERATION</a></div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<div style="display: none;width: 11%;right:6px !important;background-color: #78a039 !important;height: 78%;border-radius: 4px;cursor: pointer" class="branch_next_btn_member_invoice"><a  onclick="return loc_reload();" >PAGE RELOAD</a></div> </div>
                                
                                <form action="https://www.expodinereports.com/scan_order/banner_image_upload.php?branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>"  method="POST" enctype="multipart/form-data">
                                   
                                    <div class="image-crop" style="display:none" >
				<div class="bheader"><h2>  SCAN ORDER BANNER IMAGE UPLOAD </h2>
                                    <p style="color:red;font-size: 17px"> Use PNG Images - Max number of banner images is 3 [Min Width : 500px | Height : 500px] </p>
                                </div>
				<div class="bbody">
				<div><input name="image_file2" id="image_file2"  type="file"></div>

				<div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD BANNER" name="submit_scan"></div>
                               	
                                </div>
				</div>          
                                                         
                                </form>
                                
                                 
                  
                   
                   
                  <?php
                  
         
                  
                   
                 $dirname = "https://www.expodinereports.com/scan_order/images/banner_".$_SESSION['firebase_id'].'/';
                  
                 
                    
                 $dirname1 = "https://www.expodinereports.com/scan_order/images/".$_SESSION['firebase_id'].'_company_logo.png';
                 
                ?>
           
                
     <?php    $remoteFile = "https://www.expodinereports.com/scan_order/images/banner_".$_SESSION['firebase_id'].'/banner_1.png';

     $handle = @fopen($remoteFile, 'r');

      if($handle){  ?>
                        <div class="col-md-2 upld_img_sec" style="margin-top: 5px;display: none">
                            <img  style="width:100%" src="<?=$dirname?>banner_1.png" /><a href="https://www.expodinereports.com/scan_order/banner_image_upload.php?branchid=<?=$_SESSION['firebase_id']?>&image_name=banner_1.png&loc=<?=$loc?>" > <span style="padding:0px;cursor: pointer;" > <img src="img/delete-icon2.png" /> </span></a>
                         
                        </div>
                <?php } ?>
                                
                     <?php    $remoteFile1 = "https://www.expodinereports.com/scan_order/images/banner_".$_SESSION['firebase_id'].'/banner_2.png';

     $handle1 = @fopen($remoteFile1, 'r');

      if($handle1){  ?>          
                  <div class="col-md-2 upld_img_sec" style="margin-top: 5px;">
                      <img  style="width:100%" src="<?=$dirname?>banner_2.png" /> <a href="https://www.expodinereports.com/scan_order/banner_image_upload.php?branchid=<?=$_SESSION['firebase_id']?>&image_name=banner_2.png&loc=<?=$loc?>"  > <span style="padding:0px;cursor: pointer;"  > <img src="img/delete-icon2.png" /> </span></a>
                         
                        </div>
                                  <?php } ?>      
                                
                  <?php    $remoteFile2 = "https://www.expodinereports.com/scan_order/images/banner_".$_SESSION['firebase_id'].'/banner_3.png';

     $handle2 = @fopen($remoteFile2, 'r');

      if($handle2){  ?>
                       <div class="col-md-2 upld_img_sec" style="margin-top: 5px;">
                           <img  style="width:100%" src="<?=$dirname?>banner_3.png" /><a href="https://www.expodinereports.com/scan_order/banner_image_upload.php?branchid=<?=$_SESSION['firebase_id']?>&image_name=banner_3.png&loc=<?=$loc?>"   >  <span style="padding:0px;cursor: pointer;"  > <img src="img/delete-icon2.png" /> </span></a>
                         
                        </div>      
                                
                        <?php } ?>         
                                
                     <form action="https://www.expodinereports.com/scan_order/company_image_upload.php?branchid_default=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>"  method="POST" enctype="multipart/form-data">
                                   
                         <div class="image-crop" style="height:115px;display: none">
				<div class="bheader banner_upload">
                                   <p style="font-size: 17px; font-weight: bold; background-color: wheat;"> ITEM [ Location : Expodine - src - uploads - def_scan.png ]  </p>
                                </div>
				<div class="bbody">
				<div><input name="image_file_def" id="image_file_def"  type="file"></div>

				<div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD ITEM" name=""></div>
                               	
                                </div>
				</div>          
                                                         
                                </form>     
                                
                                
                                <form action="https://www.expodinereports.com/scan_order/company_image_upload.php?branchid_default_cat=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>"  method="POST" enctype="multipart/form-data">
                                   
                                  <div class="image-crop" style="height:115px;display: none">
				<div class="bheader banner_upload">
                                   <p style="font-size: 17px; font-weight: bold; background-color: wheat;"> CATEGORY [ Location : Expodine - src - uploads - category_ico.png ]  </p>
                                </div>
				<div class="bbody">
				<div><input name="image_file_def1" id="image_file_def1"  type="file"></div>

				<div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD CATEGORY" name=""></div>
                               	
                                </div>
				</div>          
                                                         
                                </form>     
                                
                                        
                        </div>
                            
                            
                           <form action="https://www.expodinereports.com/scan_order/company_image_upload.php?branchid=<?=$_SESSION['firebase_id']?>&loc=<?=$loc?>"  method="POST" enctype="multipart/form-data">
                                   
                                  <div class="image-crop" style="height:115px">
				<div class="bheader banner_upload">
                                   <p style="font-size: 17px; font-weight: bold; background-color: #957e55;color: black">COMPANY LOGO - Use PNG Images [Min Width : 120px | Height : 60px] </p>
                                </div>
				<div class="bbody">
				<div><input name="image_file3" id="image_file3"  type="file"></div>

				<div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD LOGO" name="submit_scan_company"></div>
                               	
                                </div>
				</div>          
                                                         
                                </form>  
                             <?php    $remoteFile23 = "https://www.expodinereports.com/scan_order/images/".$_SESSION['firebase_id'].'_company_logo.png';

                       $handle23 = @fopen($remoteFile23, 'r');

                       if($handle23){  ?>
                                <div class="col-md-2 upld_img_sec" style="margin-top: 5px;display: none">
                            <img  style="width:100%" src=<?=$dirname1?> /> 
                         
                        </div>  
                          <?php } ?>     
                            
                          
                 <div class="image-crop" style="height:210px;">
				<div class="bheader banner_upload">
                                   <p style="font-size: 17px; font-weight: bold; background-color: wheat;color: black">ADSR - QR MENU ENCRYPTION</p>
                                </div>
				<div class="bbody">
                                    <div> 
                                        <input value="<?=$_SESSION['firebase_id']?>" id="enc_data" type="text" placeholder="Enter Branch Id">
                                    
                                <select id="floor_di" style="width:150px;margin-top: -10px;margin-left: 20px;">
                                    <option value="">SELECT FLOOR</option>
                                <?php
                                $sql_tab = "select fr_floorid,fr_floorname from tbl_floormaster where fr_status='Active' ";
                                          $sql_menus = $database->mysqlQuery($sql_tab);
                                                 $num_menus = $database->mysqlNumRows($sql_menus);
                                                 if ($num_menus) {   
                                                     while ($result_menus = $database->mysqlFetchArray($sql_menus)) {

                                                  ?>

                                <option value="<?=$result_menus['fr_floorid']?>"> <?=$result_menus['fr_floorname']?></option>
                                
                                <?php


                                    } } 
                                    ?>
                              </select> 
                                    </div>
                                    
                                    <div onclick="encrypt_data();" style="display: table;"><input style="background-color: #6ea76e;color: black" class="upload_log_buton" type="submit" value="ENCRYPT BRANCH ID" name="submit_scan_company"> </div>
                                    
                                   

                                    <input  placeholder="Qr Menu Url" type="text" value="" style="width: 80%; margin-right: -28%;float: left;margin-left: 10px;padding-left: 5px;pointer-events: none;opacity: 0.5" readonly id="enc_data1"> <br>
                                
                                    <input placeholder="Adsr Api" type="text" value="" style="width: 80%;margin-top: 25px;margin-left: 10px;padding-left: 5px" readonly id="enc_data2">
                                </div>
				</div>                 
                       
                     </div>
                    
                    
                    <input type="hidden" value="https://www.expodinereports.com/scan_order/index.php?sc_br=" id="url_in" >
                     
                </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

<script type="text/javascript">
     $(document).ready(function () {
         
         
         
         
    var page_url=$('#page_url').val();
    
    var check=page_url.split('lock=');
    
    
    if(check[1]=='cloud'){
       
        $('#cloud_pop').show();
        $('#cloud_pass').focus();
    }else{
         $('.load_cloud').show();
    }
    
    
            });  
    
    
    function encrypt_data(){
               
var enc_data=$('#enc_data').val();

	                $.ajax({
			type: "POST",
			url: "banner_image_upload.php",
			data: "set=encrypt&enc_data="+enc_data,
			success: function(msg)
			{
                            
                        if($('#floor_di').val()!=''){
                            var floor_di='&floor='+$('#floor_di').val();
                        }else{
                            floor_di='';
                        }
                        
                            //$('#enc_data').val('')
                            var ss=$.trim(msg).split('<');
                           var url_in=$('#url_in').val();
                           
                            $('#enc_data1').val(url_in+ss[0]+floor_di);
                            
                            
                            var currentYear = new Date().getFullYear();
                            
                            
                             $('#enc_data2').val('https://www.expodinereports.com/adsr_api/adsr.php?sc_br='+ss[0]+'&from_dt='+currentYear+'-01-01&to_dt='+currentYear+'-12-12&outlet=test_adsr');
                            
                           //  location.reload();
                            
                        }
                    });
             }
    
    
    
    function delete_banner(loc){
         var confirm1=confirm("CONFIRM DELETE ?");
    if(confirm1===true){
         var datastring = "set=delete_banner&loc="+loc;
          
        $.ajax({
            type: "POST",
            url: "banner_image_upload.php",
           
            data: datastring,
            success: function (data)
            { 
             location.reload();
            }
        });
    }
    }
    
    
    
   $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 116) {
                event.preventDefault();
                return false;
            }
        });
        }); 
        
        
        function loc_reload(){
           
            location.reload(true);
        }
        
        
        
        function enter_cloud(){
            
              var cld=$('#cloud_pass').val();
              
              if(cld=='5555'){
                  
                  window.location.href='banner_image_upload.php';
              }else{
                   alert('Invalid Code');
                   $('#cloud_pass').val('');
                   $('#cloud_pass').focus();
              }
              
              
              
        }
        
</script>


<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<div style="display:none" class="confrmation_overlay_proce"></div>  


<div id="cloud_pop"  class="main_logout_popup_cc">

    <div class="main_logout_popup">
    <div>
      <h1 class="logout_contant_txt"> ENTER CLOUD CODE </h1>
      <input title="Hint: Number" type="password" maxlength="4" id="cloud_pass" autocomplete="off" autofocus value="">
       <div class="btn_logout_yes_no"><a onclick="return enter_cloud();" href="#" class="">GO</a></div>
       <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a   style="color:#AB2426 !important"  href="menu.php" class="">EXIT</a></div>
   </div>
   </div>
     </div>


</body>
</html>
