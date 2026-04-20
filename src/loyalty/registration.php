
<?php
error_reporting(0);
session_start();
include("..\database.class.php"); 
$database	= new Database();
require_once('..\Mailer/PHPMailerAutoload.php');

 $first_name_edit="";
 $last_name_edit=  "";
 $phone_edit=    "";  
 $email_edit=  "";    
 $bday_edit=    "";    
 $marital_edit=    ""; 
 $prof_edit=      "";
 $tot_visi_edit=  ""; 
 $staus_edit=  "";
 $entry_edit= "";
 $anvy_edit="";
 $edit_button="insert";
 $email_sts_edit="";
 $sms_sts__edit="";
 $status_edit="";
 $gender_edit="";
 
 
if(isset($_REQUEST['loyalty_id']) && $_REQUEST['loyalty_id']!=""){
 
$loy_qry1 = $database->mysqlQuery("select * from tbl_loyalty_reg where ly_id='".$_REQUEST['loyalty_id']."' ");
    $num_loy1 = $database->mysqlNumRows($loy_qry1);
     if($num_loy1)
     {
         while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1))
         {
             $ly_id=$_REQUEST['loyalty_id'];
             $first_name_edit=  $loyalty_listing_edit['ly_firstname'];
             $last_name_edit=  $loyalty_listing_edit['ly_lastname'];
             $phone_edit=      $loyalty_listing_edit['ly_mobileno'];
             $email_edit=      $loyalty_listing_edit['ly_emailid'];
             $bday_edit=       $loyalty_listing_edit['ly_birthdaydate'];
             $marital_edit=    $loyalty_listing_edit['ly_maritalstatus'];
             $prof_edit=       $loyalty_listing_edit['ly_profession'];
             $tot_visi_edit=   $loyalty_listing_edit['ly_totalvisit'];
             $status_edit=      $loyalty_listing_edit['ly_status'];
              $sms_sts__edit=      $loyalty_listing_edit['ly_smsreceive'];
              $email_sts_edit=      $loyalty_listing_edit['ly_mailreceive'];
              $entry_edit=      $loyalty_listing_edit['ly_entry_from'];
              $anvy_edit=      $loyalty_listing_edit['ly_anniversarydate'];
              $edit_button="update";
              $gender_edit=      $loyalty_listing_edit['ly_gender'];
         }
         }
                

}

if(isset($_REQUEST['set_update'])&&($_REQUEST['set_update']=="update_loyalty")){
            
             $fname1= $_REQUEST['fname1'];
             $lname1= $_REQUEST['lname1'];
             $email1=$_REQUEST['email1'];
            
             $phone1= $_REQUEST['phone1'];
             $marital1=$_REQUEST['marital1'];
            
              $profssion1= $_REQUEST['prof1'];
             $chk_mail1=$_REQUEST['chk_mail1'];
             $chk_sms1= $_REQUEST['chk_sms1'];
              $chk_sts1= $_REQUEST['chk_sts1'];
             $loy_id=$_REQUEST['ly_id'];
          
	    
             $gender1 = $_REQUEST['gender1'];
	
	      // $aniversary1	=  $_REQUEST['anvy1'];
               
               if($_REQUEST['anvy1']!=""){
                   $aniversary1=$_REQUEST['anvy1'];   ;
               }else{
                 $aniversary1	= '1001-01-01'; 
               }
               
               if($_REQUEST['bday1']!=""){
                    $bday1= $_REQUEST['bday1'];
               }else{
                  $bday1='1001-01-01';  
               }
               
               
                if(isset($_REQUEST['gst_loy']) && $_REQUEST['gst_loy']!=""){
                    $gst= $_REQUEST['gst_loy'];
               }else{
                  $gst='';  
               }
               
               
              
               
               
               
                 if($phone1!='undefined' && $phone1!=undefined){
               
                 if(isset($_REQUEST['phone1'])){
                     
                    $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_customer_table='".$_REQUEST['tables']."', ly_customer_floor='".$_REQUEST['current_floor']."' , ly_default='Y' ,ly_totalvisit=ly_totalvisit+0 where ly_id='".$loy_id."' ");  
                    
                    if($_REQUEST['mode_loy']!='DI'){
                   // $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_default='N'  where ly_id !='".$loy_id."' and ly_module!='DI' ");  
                    }
                 }
                 
                 
            $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_firstname='".$fname1."',ly_lastname='".$lname1."'"
             . ",ly_mobileno='".$phone1."',
                     ly_emailid='".$email1."',
                     ly_birthdaydate='".$bday1."',ly_maritalstatus='".$marital1."',ly_anniversarydate='".$aniversary1."',ly_profession='".$profssion1."',
                     ly_mailreceive='".$chk_mail1."',ly_smsreceive='".$chk_sms1."',
                     ly_status='".$chk_sts1."',ly_gender='".$gender1."',ly_gst='".$gst."',ly_module='".$_REQUEST['mode_loy']."'"
                    . "  where ly_id='".$loy_id."'");
      
                 }
            
            
           $query13=$database->mysqlQuery(" update tbl_ledger_master set tlm_ledger_name='".$fname1."' where tlm_guest_id='".$loy_id."'");  
            
            
}

if(isset($_REQUEST['set_add'])&&($_REQUEST['set_add']=="add_loyalty")){
    
             $branchid="1";
             $fname= $_REQUEST['fname'];
             $lname= $_REQUEST['lname'];
             $email=$_REQUEST['email'];
             $phone= $_REQUEST['phone'];
             $marital=$_REQUEST['marital'];
             $profssion= $_REQUEST['prof'];
             $chk_mail=$_REQUEST['chk_mail'];
             $chk_sms= $_REQUEST['chk_sms'];
             $ly_entry_from= "Loyalty";
             $sts="Active";
             $bday_add=$_REQUEST['bday'];
             $inv_add= $_REQUEST['anvy'];
             $gender= $_REQUEST['gender'];
             $voucher="1";
             $point="0";
             $visit="0";
             $entrytime= date('Y-m-d H:i:s');
             
             
             
             
             
              if(isset($_REQUEST['mode_loy']) && $_REQUEST['mode_loy']!=""){
        $insertion['ly_module'] = mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['mode_loy'])); 
           
        
         $insertion['ly_default'] = mysqli_real_escape_string($database->DatabaseLink,trim('Y')); 
              }
            
              
              if(isset($_REQUEST['gst_loy']) && $_REQUEST['gst_loy']!=""){
        $insertion['ly_gst'] = mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['gst_loy'])); 
             }
              
             
             if(isset($_REQUEST['tables']) && $_REQUEST['tables']!=""){
        $insertion['ly_customer_table'] = mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tables'])); 
             }
            
             if(isset($_REQUEST['current_floor']) && $_REQUEST['current_floor']!=""){
        $insertion['ly_customer_floor'] = mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['current_floor'])); 
             }
            
             
             
             if($inv_add!=""){
        $insertion['ly_anniversarydate'] = mysqli_real_escape_string($database->DatabaseLink,trim($inv_add)); 
             }
             
             if($bday_add!=""){
        $insertion['ly_birthdaydate'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($bday_add)); 
             }
             
        $insertion['ly_entry_from']=  mysqli_real_escape_string($database->DatabaseLink,trim($ly_entry_from)); 
        
        $insertion['ly_branchid']=  mysqli_real_escape_string($database->DatabaseLink,trim($branchid));
        
        if($fname!=""){
        $insertion['ly_firstname']=  mysqli_real_escape_string($database->DatabaseLink,trim($fname));
        }
        
        if($lname!=""){
        $insertion['ly_lastname']= mysqli_real_escape_string($database->DatabaseLink,trim($lname));
        }
        
        $insertion['ly_mobileno']= mysqli_real_escape_string($database->DatabaseLink,trim($phone));
        
        if($email!=""){
	$insertion['ly_emailid']= mysqli_real_escape_string($database->DatabaseLink,trim($email));
        }
        
        if($marital!=""){
        $insertion['ly_maritalstatus']= mysqli_real_escape_string($database->DatabaseLink,trim($marital));
        }
        
        if($profssion!=""){
            $insertion['ly_profession']= mysqli_real_escape_string($database->DatabaseLink,trim($profssion));
        }
        
	$insertion['ly_mailreceive']=  mysqli_real_escape_string($database->DatabaseLink,trim($chk_mail));
        $insertion['ly_smsreceive']= mysqli_real_escape_string($database->DatabaseLink,trim($chk_sms));
        $insertion['ly_status']= mysqli_real_escape_string($database->DatabaseLink,trim($sts));
        $insertion['ly_gender']= mysqli_real_escape_string($database->DatabaseLink,trim($gender));
        $insertion['ly_voucher_count']= mysqli_real_escape_string($database->DatabaseLink,trim($voucher));
        $insertion['ly_points']= mysqli_real_escape_string($database->DatabaseLink,trim($point));
        $insertion['ly_totalvisit']= mysqli_real_escape_string($database->DatabaseLink,trim($visit));
        
        
        if($_SESSION['date']!=''){
        $insertion['ly_loy_dayclose']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
        }else{
            $dy_in=date('Y-m-d');
            $insertion['ly_loy_dayclose']=mysqli_real_escape_string($database->DatabaseLink,trim($dy_in)); 
        }
        
        
        if($_SESSION['login_staff_id_expodine']!=''){
        $insertion['ly_loy_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['login_staff_id_expodine']));
        }else{
           $insertion['ly_loy_login']='1';  
        }
        
        
        if($entrytime!=""){
        $insertion['ly_entrydatetime']= mysqli_real_escape_string($database->DatabaseLink,trim($entrytime));
        }
        
        
         $sql=$database->check_duplicate_entry('tbl_loyalty_reg',$insertion);
	 if($sql!=1)
	{
             
            if($phone!='undefined' ){
	         $insertid      =  $database->insert('tbl_loyalty_reg',$insertion);
               
            }
            
          //  echo $insertid;
        
         if(isset($_REQUEST['mode_loy']) && $_REQUEST['mode_loy']!="DI"){
        
          // $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_default='N'  where ly_mobileno !='".$phone."' and ly_module!='DI' ");  
         }
         
         
        
        if($insertion['ly_smsreceive']=='Y'){
            
         $message= $fname."*".$_SESSION['s_branchname'];
                 
         $number=  $insertion['ly_mobileno']; 
             
         $print=$database->dynamic_sms_api($number,$message);
      
         }
         
     
         
         
         
        if($insertion['ly_mailreceive']=='Y'){
          
         $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			         =$result_general['be_mail_from'];
					}
		  }
                  
		$emailto= $insertion['ly_emailid'];
		
		$string="Dear ".$fname.",\n\n".$_SESSION['be_loyality_reg_msg']."";
		
		$mailtext_o = stripslashes($string);
		$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		
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
       
         $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE";
        $mail->Body = $mailtext;
         
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $emls=explode(",",$emailto);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($emailto);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message sent.';
          
        }
            
            
        }
}
   
}

?>


<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title> Loyalty</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
 


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                 
                    	
                          
               
                	<div class="top-head-section">
                            

                            
                            
                    </div>
                    
                    <div class="container">

                    <div class="page_head_detl_sec">
                        <h2>
                            <a href="listing.php"><div style="float:left" class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a> Registration</h2>
                            <a href="../table_selection.php"><div style="width: 150px;background-color: #cc863d;float:right
" class="top-head-add-btn"><span class="ti-arrow-left"></span> Table Selection</div></a>

                          </div>


                        <div class="card-box table-responsive">

                       

                        	<div class="registration-main-container inner-textbox-effect">
                                  

     <div style="display:none" class="new_print_loading_bill_sms"  ><img src="assets/images/submit.gif"></div> 
 
                                    
                            	<div class="col-md-4">
                                    <div class="group">
                                        <input  onkeypress="return alpha_name(event)" id="firstname" required="" name="" type="text" value="<?=$first_name_edit?>">
                                        <label>First Name</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input  onkeypress="return alpha_name(event)" id="lastname" required="" name="" type="text" value="<?=$last_name_edit?>">
                                        <label>Last Name</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                               <div class="col-md-4">
                                    <div class="group">
                                        <select class="select-registration" id="gender"> 
                                            <option value="M" <?php if($gender_edit=='M') { ?> selected <?php } ?> >Male</option>
                                            <option value="F" <?php if($gender_edit=='F') { ?> selected <?php } ?> >Female</option>
                                        </select>
                                     </div>
                                </div>
     
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="email" required="" name="" type="text" value="<?=$email_edit?>">
                                        <label>Email</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="phone" required="" onkeypress="return numdot(event);" name="" type="text" value="<?=$phone_edit?>">
                                        <label>Phone  Number*</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        
                                        <input id="datepicker" class="bday" required="" name="bday"  data-provide="datepicker" type="text" value="<?=$bday_edit?>">
                                        <label>Birthday</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <select class="select-registration" id="marital"> 
                                            <option value="single" <?php if($marital_edit=='single') { ?> selected <?php } ?> >Single</option>
                                            <option value="married" <?php if($marital_edit=='married') { ?> selected <?php } ?> >Married</option>
                                        </select>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="datepicker1"  data-provide="datepicker" class="anniversary" value="<?=$anvy_edit?>" required="" name="anniversary" type="text">
                                        <label>Anniversary</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                
     
                                <div class="col-md-4">
                                    <div class="group">
                                        <select class="select-registration" id="profession"> 
                                <option  value='' >SELECT PROFESSION</option>            
                                            <?php
                                            $loy_qry1 = $database->mysqlQuery("select * from tbl_profession_master  ");
    $num_loy1 = $database->mysqlNumRows($loy_qry1);
     if($num_loy1)
     {
         while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1))
         {
             
            if($loyalty_listing_edit['pr_name']==$prof_edit) {
                ?>
       
        <option selected='selected' value='<?=$prof_edit?>' ><?=$prof_edit?></option>
                                            <?php 
    }
    else
    {
        
        ?>
                                            
        <option value=<?=$loyalty_listing_edit['pr_name']?> ><?=$loyalty_listing_edit['pr_name']?> </option>
         <?php
    }                     
                            
                                          
             
         }
         }
            ?>                                
                                            
                                        </select>
                                     </div>
                                </div>
     
     
                                    <div class="col-md-4">
                                    <div class="group">
                                        <input id="entryfrom" name="" value="Loyalty" readonly type="text">
                                        <label></label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                    <?php  if ($edit_button!='update') { ?>   
                                <div class="col-md-2 col-xs-6 ">
                                    <div class="checkbox checkbox-primary check-box-add">
                                          <input id="checkbox_mail" <?php if($email_sts_edit=='Y'){?> checked <?php } ?> type="checkbox">
                                          <label for="checkbox2">
                                              Mail Receive
                                          </label>
                                      </div>
                                 </div> 
                                 <div class="col-md-2 col-xs-6">
                                    <div class="checkbox checkbox-primary check-box-add">
                                          <input id="checkbox_sms"  <?php if($sms_sts__edit=='Y'){?> checked <?php } ?>  type="checkbox">
                                          <label for="checkbox2">
                                              SMS Receive
                                          </label>
                                      </div>
                                 </div> 
                                    <?php } ?>
                                    
                                    <?php  if ($edit_button=='update') { ?>
                                    <div class="col-md-2 col-xs-6">
                                    <div class="checkbox checkbox-primary check-box-add">
                                        <input id="checkbox_status" <?php if($status_edit=='Active'){?> checked <?php } ?>   type="checkbox">
                                          <label for="checkbox2">
                                              Status
                                          </label>
                                      </div>
                                 </div> 
                                  <?php } ?>
                                  <div class="col-md-12 col-xs-12">
                                      <?php if($edit_button=='insert'){ ?>
                                      <a href="#"><div class="submit-form-btn" onclick="return submit_loyalty(event);">SUBMIT</div></a>
                                      <?php } else if ($edit_button=='update') { ?>
                                      
                                       <a href="#"><div class="submit-form-btn" onclick="return update_loyalty('<?=$ly_id?>');">Update</div></a>
                                      <?php } ?>
                                      <strong id="error_show" style="float: right;color: red;margin: 8px 20px 0 0"></strong>
                                       <strong id="success_show" style="float: right;color: limegreen;margin: 8px 20px 0 0"></strong>
                                  </div>
                                
                                
                            </div>
                        </div><!--card-box table-responsive-->
                      
                    </div> <!-- container -->

                </div> <!-- content -->


            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
            
            
            function submit_loyalty(event){
               event.stopImmediatePropagation();  
                   var fname=$('#firstname').val();
                   var lname=$('#lastname').val();
                   var phone=$('#phone').val();
                   var bday=$('.bday').val();
                    var email=$('#email').val();
                   var marital=$('#marital').val();
                   var anvy=$('.anniversary').val();
                   var prof=$('#profession').val();
                   var gender=$('#gender').val();
             
                  
                    var chk_mail;
                   if($("#checkbox_mail").is(':checked'))
					  {
                                  chk_mail='Y';              
                                          }else{
                              chk_mail='N';
                            }
                            
                   var chk_sms;
                   if($("#checkbox_sms").is(':checked'))
					  {
                                  chk_sms='Y';              
                                          }else{
                              chk_sms='N';
                            }
                            
                    var len=$('#phone').val().length;
                    
                 
                 $.ajax({
			type: "POST",
			url: "../load_divcheckmenu.php",
			data: "value=mobileadd_loyalty&mid="+phone,
			success: function(msg)
			{
			msg=$.trim(msg);
				
				if(msg =="sorry")
					{
                                            
		$("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Number Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#phone').focus();	    
					}
					else
					{
                 
                  $.ajax({
			type: "POST",
			url: "../load_divcheckmenu.php",
			data: "value=mailadd_loyalty&mid="+email,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
				
			if(msg1 =="sorry" && email!='')
			{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#email').focus();	    
					}
					else
					{
                 var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

   

                  if(phone!="" && len>='2' && fname!="") {   
                      
                    
                           
         var data="set_add=add_loyalty&fname="+fname+"&lname="+lname+"&email="+email+"&bday="+bday+"&phone="+phone+"&marital="+marital+"&anvy="+anvy+"&prof="+prof+"&chk_mail="+chk_mail+"&chk_sms="+chk_sms+"&gender="+gender;
        
        $('.new_print_loading_bill_sms').show();  
        $.ajax({
        type: "POST",
        url: "registration.php",
        data: data,
        success: function(data)
        {      $('#gender').val('M');
               $('#firstname').val('');
               $('#lastname').val('');
               $('#phone').val('');
               $('.bday').val('');
               $('#email').val('');
               $('#marital').val('single');
               $('.anniversary').val('');
               $('#profession').val('');
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
                                        
//               $("#success_show").show();
//               var success_show=$('#success_show');
//	       success_show.text('Registration Successfull !');	
//	       $("#success_show").delay(3000).fadeOut('slow');
                  setTimeout(function(){ window.location.href="listing.php"; }, 1000);
              
        }
    });
    
    
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	      
               if($('#phone').val()==""){
                    error_show.text('Enter Number');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#phone').focus();
               }
               else if($('#firstname').val()==""){
                    error_show.text('Enter Name');	
	       $("#error_show").delay(2000).fadeOut('slow');
                $('#firstname').focus();
               }else if($('#phone').val()!="" && len<2){
                $('#phone').focus(); 
                 error_show.text('Enter Valid Number');	
            }
               
    }
    
            
     }
        }
    });
            }
        }
    });
    
    
    } 
    
    
   function update_loyalty(id){
             
                   var fname1=$('#firstname').val();
                   var lname1=$('#lastname').val();
                   var phone1=$('#phone').val();
                   var bday1=$('.bday').val();
                    var email1=$('#email').val();
                   var marital1=$('#marital').val();
                   var anvy1=$('.anniversary').val();
                   var prof1=$('#profession').val();
                  var gender1=$('#gender').val();
                   
                      var chk_mail1;
                   if($("#checkbox_mail").is(':checked'))
					  {
                                  chk_mail1='Y';              
                                          }else{
                                chk_mail1='N';
                              }
                            
                   var chk_sms1;
                   if($("#checkbox_sms").is(':checked'))
					  {
                                  chk_sms1='Y';              
                                          }else{
                              chk_sms1='N';
                            }
                            
                            
                            var chk_sts1;
                   if($("#checkbox_status").is(':checked'))
					  {
                                  chk_sts1='Active';              
                                          }else{
                              chk_sts1='Inactive';
                            }
                            
                            
                    var len=$('#phone').val().length;
                  
                  $.ajax({
			type: "POST",
			url: "../load_divcheckmenu.php",
			data: "value=mobileadd_loyalty_edit&mid="+phone1+"&ly_id="+id,
			success: function(msg)
			{
			msg=$.trim(msg);
				
				if(msg =="sorry" && phone1!='')
					{
                                            
		$("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Number Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#phone').focus();	    
					}
					else
					{
                 
                  $.ajax({
			type: "POST",
			url: "../load_divcheckmenu.php",
			data: "value=mailadd_loyalty_edit&mid="+email1+"&ly_id="+id,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
				
			if(msg1 =="sorry" && email1!='')
			{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#email').focus();	    
					}
					else
					{
                  
                  
                  
                  var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/; 
                  
                  if(phone1!="" && len>='2' && fname1!="" )   {      
                      
                      
                      
                      
         var data="set_update=update_loyalty&fname1="+fname1+"&lname1="+lname1+"&email1="+email1+"&bday1="+bday1+"&phone1="+phone1+"&marital1="+marital1+"&anvy1="+anvy1+"&prof1="+prof1+"&chk_mail1="+chk_mail1+"&chk_sms1="+chk_sms1+"&chk_sts1="+chk_sts1+"&ly_id="+id+"&gender1="+gender1;
         
        $.ajax({
        type: "POST",
        url: "registration.php",
        data: data,
        success: function(data)
        {
          
               var success_show=$('#success_show');
	       success_show.text('Updated Successfully !');	
	       $("#success_show").delay(3000).fadeOut('slow');
               setTimeout(function(){  window.location.href="listing.php"; }, 1000); 
        }
    });
    
   
    
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	     
               if( $('#phone').val()==""){
                $('#phone').focus();
                error_show.text('Enter Number');	
	        $("#error_show").delay(2000).fadeOut('slow');
            }else if($('#firstname').val()==""){
                $('#firstname').focus();  
                error_show.text('Enter Name');	
	        $("#error_show").delay(2000).fadeOut('slow');
             } else if( $('#phone').val().length<2){
                 $('#phone').focus();  
                 error_show.text('Enter Valid  Number');	
	         $("#error_show").delay(2000).fadeOut('slow');
             }
            
    }
    
        }
        }
    });
            }
        }
    });
   }
    
    
    
    
                     
    function numdot(e) {     
   
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }                 
                     
           
    function alpha_name(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    }        
            
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        
       

<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

<script>

       $(function() {
           $('#firstname').focus();
           
           $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
       });
       

         
     
       
   </script>

   <style>
       .new_print_loading_bill_sms{width:100%;height:100%;position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.8);text-align:center;z-index:9999999999999;padding-top: 20vh}
        .new_print_loading_bill_sms img {width:200px;}
   </style>

    </body>

</html>