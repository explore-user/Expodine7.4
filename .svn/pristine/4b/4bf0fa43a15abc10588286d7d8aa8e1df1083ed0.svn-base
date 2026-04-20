<?php
	if(isset($_FILES['file'])) {
		$file_name=date("jmYhis").rand(991,9999);
		if(move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/reports/".$file_name.".png")) {
			
			//email
			ob_start();
			session_start();
			$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
			include('email/km_smtp_class.php');
                        require_once('Mailer/PHPMailerAutoload.php');
			include("emailpdfpages.php");
			$reportemail	= new reportemail();
			require_once(dirname(__FILE__).'/htmltppdf/html2pdf.class.php');
			try
    		{
			$be_mail_server		="";
		   $be_mail_port		="";
		   $be_mail_emailid		="";
		   $be_mail_password	="";
		   $be_mail_secure		="";
		   $be_mail_from='';
		   $branchname='';
		   $emailslisting='';
		   
        	$html2pdf = new HTML2PDF('P', 'A4', 'fr');
			 $sql_flor="Select be_branchname,be_reportemail_list,be_email from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'";
		   $sql_flors  =  mysqli_query($con,$sql_flor); 
			$num_flor  = mysqli_num_rows($sql_flors);
			if($num_flor){	
			while($result_flor  = mysqli_fetch_array($sql_flors)) 
					{
						$branchname=$result_flor['be_branchname'];
						$emailslisting=$result_flor['be_reportemail_list'];
						
					}
			}
			$sql_general =  mysqli_query($con,"Select * from tbl_generalsettings "); 
			$num_general  =  mysqli_num_rows($sql_general);
			if($num_general)
			{
				  while($result_general  = mysqli_fetch_array($sql_general)) 
					  {
						   $be_mail_server			=$result_general['be_mail_server'];
						   $be_mail_port				=$result_general['be_mail_port'];
						   $be_mail_emailid			=$result_general['be_mail_emailid'];
						   $be_mail_password			=$result_general['be_mail_password'];
						   $be_mail_secure			=$result_general['be_mail_secure'];
						   $be_mail_from			    =$result_general['be_mail_from'];
					  }
			}
                        
                  $string="Please find the attachment for the report";
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
        $mail->Subject = "EXPODINE ";
        $mail->Body = $mailtext;
          $mail->addAttachment("uploads/reports/".$file_name.".png");
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        
        $emls=explode(",",$emailslisting);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($emailslisting);
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
                        
                     
			
			} catch(HTML2PDF_exception $e) {
			  echo $e;
			  exit;
		  }
			
			unlink("uploads/reports/".$file_name.".png");
		} else {
			echo 'Fail';
		}
	} 
?>