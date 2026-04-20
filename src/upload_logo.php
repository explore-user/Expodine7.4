<?php
session_start();
//include('includes/session.php');		
include("database.class.php"); 
$database	= new Database();	

error_reporting(0);

require_once('Mailer/PHPMailerAutoload.php');

if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_footer'){
    
     unlink('img/print-logo/print_logo_bottom.png');
     
    
    
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_logo'){
    
     unlink('img/print-logo/print_logo.png');
     
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='branch_update'){
    
    
  $fnct_menu5 = $database->mysqlQuery("update tbl_branchmaster set be_branchname='".$_REQUEST['branch']."'   ");
    
  $allmail    ='rijas@exploreitsolutions.com,hevit@exploreitsolutions.com';
  
    $date=date('y-m-d H:i:s');
  
  	 $sql_general = $database->mysqlQuery("Select * from tbl_generalsettings"); 
		  $num_general  = $database-> mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  =$database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			        =$result_general['be_mail_from'];
					}
		  }

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
        
        
        $string =' BRANCH NAME IS RENAMED FROM '. $_SESSION['s_branchname'].' TO '.$_REQUEST['branch']; 
        
        $mailtext_o = stripslashes($string);
	$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		  
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        
        $mail->Subject = " LOGO & BRANCH NAME MAIL RESPONSE : ". $_SESSION['s_branchname']. ' '.$date ;
       
        $mail->Body = $mailtext;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
         $emls=explode(",",$allmail);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		   $mail->AddAddress($allmail);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }
        
        
        if (!$mail->send()) {
                        //////////apache/////
              
            $to = $allmail;
            
           
            $subject = " LOGO & BRANCH NAME MAIL RESPONSE : ". $_SESSION['s_branchname']. ' '.$date ;
            $message = ' BRANCH NAME IS RENAMED FROM '. $_SESSION['s_branchname'].' TO  '.$_REQUEST['branch']; 
           

            $headers = "From: <from@gmail.com>";

           mail($to,$subject,$message, $headers);
   
        } 
  
  
  
}

$be_branchname='';
$fnct_menu5 = $database->mysqlQuery("select be_branchname from tbl_branchmaster ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              {
                  
                  $be_branchname=$result_fnctvenue5['be_branchname'];
              }
              }
              




?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Logo</title>
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
</style>

</head>
<body id="loadfull">
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">IMAGE UPLOAD SECTION</a></li>
				</ul>
			</div><!-- breadcrumbs -->
            
                <div class="content-sec">
                	<div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                     
                     	<div class="branch_master_main_container">
                        	<div class="new_branch_main_setings_head" style="position:relative;">
                                    <div style="width: 10%;left:6px !important;" class="branch_next_btn_member_invoice">
                                        <a href="branch_settings.php" >Back</a></div> IMAGE UPLOAD SECTION </div>
                                <form action="upload_logo.php" method="POST" enctype="multipart/form-data">
                                   
                             
                          <div style="width:100%">           
                                    
                        <div class="image-crop" style="width:49%">
			<div class="bheader"><h2>  PRINT & REPORT LOGO </h2>
                          <p style="color:red"> Upload logo with size of 351px X 351px {PNG ONLY}</p>
                                <?php
                          $filename3 = 'img/print-logo/print_logo.png';

                          if (file_exists($filename3)) { ?>    
                                        <div class="up_load">                        
                                <div class="uploaded_image" style="position:relative;"><img src="img/print-logo/print_logo.png"></div>	
                                 <div   onclick="delete_logo();" style="cursor: pointer; margin-bottom: 10px;" ><img  src="img/delete-icon2.png"></div> 
                                 </div> 
                          <?php } ?>
                                </div>
			<div class="bbody">
			<div><input name="image_file2" id="image_file2" onChange="fileSelectHandler()" type="file"></div>

			<div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD" name="submit2"></div>
                                 
                       </div>
			</div>
                                
                                    
                                
                     <div class="image-crop"  style="width:50%;margin-left: 2px">
			<div class="bheader"><h2> BILL PRINT FOOTER LOGO  </h2>
                       <p style="color:red"> Upload logo with size of 351px X 351px {PNG ONLY}</p>
                       <div class="up_load">
                      <?php
                      $filename = 'img/print-logo/print_logo_bottom.png';

                      if (file_exists($filename)) { ?>
                                                             
                      <div class="uploaded_image" style="position:relative;"><img src="img/print-logo/print_logo_bottom.png"></div>
                      <div   onclick="delete_footer();" style="margin-bottom: 10px; cursor: pointer;" ><img  src="img/delete-icon2.png"></div> 
                   
                        <?php } ?>  
                                </div>
			<div class="bbody">
			<div><input name="image_file3" id="image_file3" onChange="fileSelectHandler()" type="file"></div>
                     <div style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="UPLOAD" name="submit3"></div>
                       
                    </div>
                                                             
                   </div>
                        
                    </div>
                                    
                      </div>                     
                                
                                </form>         
                                       <div class="image-crop" style="width:99%;margin-left: 2px">
					<div class="bheader"><h2>BRANCH NAME </h2>
                                        <p style="color:red"> </p>
                                         <div class="up_load">
                                
                    
                                         </div>
					<div class="bbody">
					<div>
                                            
                                            
                                            <input type="text" style="width: 500px;font-weight: bold;text-align: center;"  id="branch" value="<?=$be_branchname?>" ></div>

                                            <div onclick="branchname()" style="display: table;"><input class="upload_log_buton entersubmit" type="submit" value="Submit" ></div>
                                                                        
                                      </div>
                                                              
					</div>
                                     
                                      </div>
                            
                     </div>
                </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

<script type="text/javascript">
    
   $('.entersubmit').ready(function () {
    
     $("input:text").keypress(function(event) {
         
            if (event.keyCode == 116) {
                event.preventDefault();
                return false;
            }
            
            });
   }); 
        
        
        function delete_footer(){
            
            var confirm1=confirm("CONFIRM DELETE ?");
    if(confirm1===true){
         var datastring = "set=delete_footer";
          
        $.ajax({
            type: "POST",
            url: "upload_logo.php",
           
            data: datastring,
            success: function (data)
            { 
           window.location.href='dont_delete.php?logo_upload=logo_upload';   
                
          //   location.reload();
            }
        });
    }
            
        }
        
        
         function delete_logo(){
            
            var confirm1=confirm("CONFIRM DELETE ?");
    if(confirm1===true){
         var datastring = "set=delete_logo";
          
        $.ajax({
            type: "POST",
            url: "upload_logo.php",
           
            data: datastring,
            success: function (data)
            { 
           window.location.href='dont_delete.php?logo_upload=logo_upload';   
                
          //   location.reload();
            }
        });
    }
            
        }
        
        
         function branchname(){
            
            var confirm1=confirm("UPDATE BRANCH NAME ?");
          if(confirm1===true){
              
         var branch=$('#branch').val();
            
           if (/^[a-zA-Z0-9_\- ]+$/.test(branch)) {
            
         var datastring = "set=branch_update&branch="+branch;
          
        $.ajax({
            type: "POST",
            url: "upload_logo.php",
           
            data: datastring,
            success: function (data)
            { 
                alert('UPDATED');
                window.location.href='dont_delete.php?logo_upload=logo_upload';   
                
            }
        });
        
        
            }else{
                  alert("SPECIAL CHARACTERS NOT ALLOWED");
     
                  return false; // stop here
                
            }
            
    }
            
        }
        
</script>
<?php 


/////////////// print logo start////

$target_dir = "img/print-logo/";

$target_file = $target_dir ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit2"])) { 
    
      if ($_FILES['image_file2']['tmp_name'] != "") { 
        $maxfilesize = 4109212; 

        if($_FILES['image_file2']['size'] > $maxfilesize ) { 
                    
                      echo '<script type="text/javascript">alert("ERROR: Your image was too large, please try again.");</script>';       
                     unlink($_FILES['image_file2']['tmp_name']); 

        } else if (!preg_match("/\.(png)$/i", $_FILES['image_file2']['name'] ) ) {
                   
                     echo '<script type="text/javascript">alert("ERROR: Sorry, only  PNG files are allowed.");</script>';        
                     unlink($_FILES['image_file2']['tmp_name']); 
        } 
        else { 
                    $newname = "print_logo.png";
                    $place_file = move_uploaded_file( $_FILES['image_file2']['tmp_name'], "img/print-logo/".$newname);
                    $newname1 = "reportlogo.png";
                    copy("img/print-logo/".$newname,"img/report-logo/".$newname1);
                   
                   
        }
    }
    
     echo "<meta http-equiv='refresh' content='0'>";
     header("location:dont_delete.php?print_logo=print_logo");
     exit;
}




/////////////// print logo bottom start////////

$target_dir = "img/print-logo/";

$target_file = $target_dir ;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit3"])) { 
    
      if ($_FILES['image_file3']['tmp_name'] != "") {  
        $maxfilesize = 4109212; 

        if($_FILES['image_file3']['size'] > $maxfilesize ) { 
//                   
                      echo '<script type="text/javascript">alert("ERROR: Your image was too large, please try again.");</script>';       
                     unlink($_FILES['image_file3']['tmp_name']); 

        } else if (!preg_match("/\.(png)$/i", $_FILES['image_file3']['name'] ) ) {
//                   
                     echo '<script type="text/javascript">alert("ERROR: Sorry, only  PNG files are allowed.");</script>';        
                     unlink($_FILES['image_file3']['tmp_name']); 
        } 
        else { 
                    $newname = "print_logo_bottom.png";
                    $place_file = move_uploaded_file( $_FILES['image_file3']['tmp_name'], "img/print-logo/".$newname);
                 
                    
        }
         
    }
   
    
   echo "<meta http-equiv='refresh' content='0'>";
    header("Location: dont_delete.php?print_logo=print_logo");
    exit;
}


?>
 

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

</body>
</html>