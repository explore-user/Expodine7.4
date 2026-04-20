<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
//include("database.class.php"); // DB Connection class
//$database	= new Database();
/*$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;
*/
  ob_start();
	session_start();
$con=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
	include('email/km_smtp_class.php');
          require_once('Mailer/PHPMailerAutoload.php');
	include("emailpdfpages.php");
	$reportemail	= new reportemail();
	//window.location="reports_emailpage.php?mail="+vv+"&datefrom="+datefrom+"&dateto="+dateto+"&bydate="+bydate+"&reports="+ids;
	$rptsub="";
  $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
  $_SESSION['ktc']=$_REQUEST['kitchen'];

	if($_REQUEST['from']!= "" &&  $_REQUEST['to'] !="" )
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
         $_SESSION['todt']=$_REQUEST['to'];
		 $rptsub.=" from ".$_SESSION['fromdt']." to ".$_SESSION['todt']."";
	}
	else if($_REQUEST['from']!= "" &&  $_REQUEST['to'] =="")
	{
		$_SESSION['fromdt']=$_REQUEST['from'];
		
		 $rptsub.=" from ".$_SESSION['fromdt']."";
		
	}
		else if($_REQUEST['from']== "" &&  $_REQUEST['to'] !="")
		{$_SESSION['todt']=$_REQUEST['to'];
		$rptsub.=" till ".$_SESSION['todt']."";
		}
	else if($_REQUEST['from']== "" &&  $_REQUEST['to'] =="")
	{ $rptsub.=" for ".$_SESSION['hidbydate']."";
	}
	
/* $_SESSION['fromdt']=$_REQUEST['from'];
 $_SESSION['todt']=$_REQUEST['to'];*/
 $reports=explode(",",$_REQUEST['reports']);

 //$names='';
//print_r($reports);die();
    $ct=count($reports);
 
 //echo $reports[0];
// die();
 //$_SESSION['reports']=$_REQUEST['reports'];
 // $content0='';
// $content1='';
//  $content2='';
//   $content3='';
//    $content4=''; 
//	$content5='';
//	 $content6='';
for($i=0;$i<$ct;$i++)
{${'content' . $i}="";
}
for($i=0;$i<$ct;$i++)
{ $_SESSION['type']=trim($reports[$i]);
if($reports[$i]!='')
	$reportemail->setreportsall($reports[$i]);
  // //header("location:emailpdfpages.php?type=".$reports[$i]."&from=".$_REQUEST['from']."&to=".$_REQUEST['to']."&hidbydate=".$_REQUEST['hidbydate']);
    ${'content' . $i} = ob_get_clean();
	//$content1 = ob_get_clean();
	//unset($_SESSION['type']);
}
$names=array();
    // convert in PDF
   
    require_once(dirname(__FILE__).'/htmltppdf/html2pdf.class.php');
	
    try
    {
        
//      $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
		for($i=0;$i<$ct;$i++)
		{
			
			$html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML(${'content' . $i}, isset($_GET['vuehtml']));
		$names[$i]=$reports[$i].".pdf";//.date("Y-m-d").".pdf";
		
		if($reports[$i] =="cancel_history")
		{
			$names[$i]="Item_cancel_log.pdf";
		}
		
		///echo $names[$i];
	//	die();
		$html2pdf->Output($names[$i],'FD');
		}
		for($i=0;$i<$ct;$i++)
		{
		//$html2pdf->Output($names[$i],'FD');
		}
		 //$html2pdf->writeHTML($content1, isset($_GET['vuehtml']));
		//$names="1234.pdf";
		
        
		 
		   $be_mail_server		="";
		   $be_mail_port		="";
		   $be_mail_emailid		="";
		   $be_mail_password	="";
		   $be_mail_secure		="";
		   $be_mail_from='';
		   $branchname='';
		   
		   $sql_flor="Select be_branchname from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'";
		   $sql_flors  =  mysqli_query($con,$sql_flor); 
			$num_flor  = mysqli_num_rows($sql_flors);
			if($num_flor){	
			while($result_flor  = mysqli_fetch_array($sql_flors)) 
					{
						$branchname=$result_flor['be_branchname'];
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
		  
		$emailto= $_REQUEST['mail'];
		/*$maillist1='';
		$maillist2='';
		$eml1=explode(",",$emailto);
		$counts=$eml1;
		if($counts==1)
		{
			$maillist1=$emailto;
		}else
		{
			for($i=0;$i<=$counts;$i++)
			{
				if($i==0)
				{
					$maillist1=$eml1[$i];
				}else
				{
					$maillist2=$maillist2." <".$eml1[$i].">";
				}
			}
		}*/
		$string="Please find the attachment for the report";
		$mailtext_o = stripslashes($string);
		$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		
                
                
                  $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = $branchname;
        $mail->Body = $mailtext;
        $reportname='';
		  for($i=0;$i<$ct;$i++)
		  {
			//$names[$i]
			  $mail->addAttachment($names[$i]);
			  if($names[$i]=="summary".".pdf")     // if($names[$i]=="summary".date("Y-m-d").".pdf")
			  {
			  	$reportname="Summary ".$rptsub.".pdf";
					//$reportname="Summary For ".date("d-m-Y").".pdf";
			  }else  if($names[$i]=="newentry".".pdf") // if($names[$i]=="newentry".date("Y-m-d").".pdf")
			  {
			  	$reportname="New Entry ".$rptsub.".pdf";//  	$reportname="New Entry For ".date("d-m-M").".pdf";
			  }else  if($names[$i]=="bill_cancel".".pdf")//else  if($names[$i]=="bill_cancel".date("Y-m-d").".pdf")
			  {
			  	$reportname="Bill Cancel ".$rptsub.".pdf";//  	$reportname="Bill Cancel For ".date("d-m-Y").".pdf";
			  }
			  else  if($names[$i]=="order".".pdf")//	  else  if($names[$i]=="order".date("Y-m-d").".pdf")
			  {
			  	$reportname="Item Order Summary ".$rptsub.".pdf";//	$reportname="Item Order Summary For ".date("d-m-Y").".pdf";
			  }
			  else if($names[$i]=="tot_sales".".pdf")
			  {
				 	$reportname="Total sales ".$rptsub.".pdf"; 
			  }
			  else if($names[$i]=="Item_cancel_log".".pdf")
			  {
			 $reportname="Item Cancel Log " . $rptsub.".pdf";
		
			
			  }
			  else if($names[$i]=="summary_ham".".pdf")
			  {
				 	 $reportname="Summary " . $rptsub.".pdf"; 
			  }
                          else if($names[$i]=="kitchen_wise".".pdf")
			  {
				 	 $reportname="Kitchen " . $rptsub.".pdf"; 
			  }
			  
		  }	
         
        
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
		
		
		/*email sending ends*/
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
	
	
	
	
	
