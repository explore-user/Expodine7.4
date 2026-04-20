<?php
error_reporting(0);
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  
    $database	= new Database();
   
}
    //include('email/km_smtp_class.php');
    require_once('Mailer/PHPMailerAutoload.php');

$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

$branchname='';

$start_date = date("Y-m-01", strtotime("first day of last month"));
$end_date = date("Y-m-t", strtotime("last day of last month"));

if(isset($_REQUEST['set_msg'])&& $_REQUEST['set_msg']=="monthly_msg" ){
    
          $sql_login  =  $database->mysqlQuery("select bm_dayclosedate from tbl_tablebillmaster where bm_dayclosedate"
          . " between '$start_date' and '$end_date' and  bm_status='Closed' "); 

	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  $sql_loginta  =  $database->mysqlQuery("select tab_dayclosedate from tbl_takeaway_billmaster where tab_dayclosedate"
          . " between '$start_date' and '$end_date' and  tab_status='Closed' "); 

	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
       
	  if($num_login || $num_loginta)
	  {
              
                  $sql_branch1 =  $database->mysqlQuery("Select dc_monthy_send  from tbl_dayclose where dc_day ='".$_SESSION['date']."' "
                  . " and dc_monthy_send='Y' "); 
		  $num_branch1  = $database->mysqlNumRows($sql_branch1);
		  if($num_branch1 || $_SESSION['date']=='')
		  {  
                  
                      
                  }else{
                   
                 $sql_sms_updation  =  $database->mysqlQuery("Update  tbl_dayclose set dc_monthy_send='Y' where "
                 . " dc_day ='".$_SESSION['date']."' ");
             
                  $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address from tbl_branchmaster"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
			while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
			{
                                    
			  $branchname=$result_branch['be_branchname'];
                           $addr=$result_branch['be_address'];                	
			}
		  }
                 
        $return='';
        $left='';
        $tot_fin=0; $tot_exc=0;      
            
        $smstext1= " Sales Date :  From ". $start_date ." To ". $end_date.' [Excluding Complimentary Bills]';
           
            
            
                                        $bilno= array(
					new bilno($smstext1,''),
                                        );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                        }
                                          
        $return.="\r\n";  $return.="\r\n";  $return.="\r\n";
	
	$string="";
    
        $stringtx_ta= "  ";
        $stringtx_di= "  ";
    
        $stringta="";
        $string_combo='';
        $mode='';
        $string.=" bm.bm_status = 'Closed' and bm.bm_complimentary!='Y' ";
        $stringta.=" bm.tab_status = 'Closed' and bm.tab_complimentary!='Y' ";
                                        
        $string.= " and bm.bm_dayclosedate between '".$start_date."' and '".$end_date."'  ";
        $stringta.= " and bm.tab_dayclosedate between '".$start_date."' and '".$end_date."'  ";
        $string_combo.= " cbd.cbd_dayclosedate between '".$start_date."' and '".$end_date."'  ";
           
        $stringtx_ta.= " and tketm.tbet_daycolse between '".$start_date."' and '".$end_date."'  ";
        $stringtx_di.= " and betm.bet_dayclose between '".$start_date."' and '".$end_date."'  ";
    
                            $mn_ct=11;
                            $tax_name=array();
                            $tax_id=array();
                            $tx_num=0;
                            
                            $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y'  "); 
                            $num_login   = $database->mysqlNumRows($sql_login);
                            if($num_login){ 
                             while($result_login=$database->mysqlFetchArray($sql_login)){
                                 
                                  $tax_name[]=$result_login['amc_name'];
                                  $tax_id[]=$result_login['amc_id'];
                                  $tx_num++;
                            }} 
                              
                        $menulist= array(
                            new itemordered("Sl","Date","Bill","Subtotal","Tax","Total",'Discount','Roundoff','Cash','Card','Credit'),
			);
			           					
                        foreach($menulist as $menulist) {
                        $return .=$left.($menulist);
                        $return.="\r\n";

                        }
                        
                        $return.="-----------------------------------------------------------------------------------------------------------------------------------------------------";
          
                        $return.="\r\n";
         
    $final=0;
    $paid=0;
    $bal=0; 
    $dsc=0;
    $subtotal=0; $i=1;
    $tax_value=array(); $crd=0; $sum_non_tax2=0; $tax_new=0;
  
    $tot_roff=0; $tot_exempt=0;
  
        $sql_login = $database->mysqlQuery("select tm,paymode,card,cash,credit,billno,taxamt,uae_subtotal,exempt,rounoff,
        subtotal,discount,final ,paid, balance,dayclosedate from 
        (select bm_roundoff_value as rounoff,bm_tax_exempt as exempt,bm_paymode as paymode,bm_billtime as tm,
        bm_transactionamount as card,(bm_amountpaid-bm_amountbalace) as cash ,
        (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,bm_billno as billno, 
        bm_subtotal as  subtotal,  bm_discountvalue as discount,bm_finaltotal as final, (bm_total - bm_subtotal_final ) as taxamt ,
        bm_amountpaid as paid,   bm_amountbalace as balance ,bm.bm_dayclosedate as dayclosedate,bm_taxable_amount as uae_subtotal
        from tbl_tablebillmaster bm  
        where  $string  
        union all
        select tab_roundoff_value as rounoff,tab_tax_exempt as exempt,tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,
        (tab_amountpaid-tab_amountbalace) as cash , 
        (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,  tab_billno as billno, 
        tab_subtotal as subtotal,tab_discountvalue as discount,tab_netamt as final,  (tab_total - tab_subtotal_final) as taxamt ,
        tab_amountpaid as paid,   tab_amountbalace as  balance,bm.tab_dayclosedate as dayclosedate ,tab_taxable_amount as uae_subtotal
        from tbl_takeaway_billmaster
        bm where  $stringta  )s
        group by billno,dayclosedate order by dayclosedate ,tm ASC ");   
  
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=0; 
          
	  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   {
              
            $f++;
            $i++;
            
            $tax_new=$tax_new + $result_login['taxamt'];
            
            if($_SESSION['uae_tax_enable']=='Y'){ 
                
                 $subtotal=$subtotal + $result_login['uae_subtotal'];   
                
                 $sub=number_format($result_login['uae_subtotal'],$_SESSION['be_decimal']);
                 
            }else{
                
                 $subtotal=$subtotal + $result_login['subtotal'];
                 
                 $sub=    number_format($result_login['subtotal'],$_SESSION['be_decimal']);
            }
            
            $dsc=$dsc + $result_login['discount'];
            
	    $final=$final + $result_login['final'];
	    $paid=$paid +$result_login['cash'];
            
            if($result_login['paymode']=='6'){
		$bal=$bal + $result_login['credit'];
            }
            
             $crd=$crd + $result_login['card'];    
             
             $tot_roff=$tot_roff+$result_login['rounoff'];   
           
              $menulist= array(
                            new itemordered($i,$database->convert_date($result_login['dayclosedate']),$result_login['billno'],number_format($sub,$_SESSION['be_decimal']),number_format($result_login['taxamt'],$_SESSION['be_decimal']),
                            number_format($result_login['final'],$_SESSION['be_decimal']),number_format($result_login['discount'],$_SESSION['be_decimal']),
                            number_format($result_login['rounoff'],$_SESSION['be_decimal']), 
                            number_format($result_login['cash'],$_SESSION['be_decimal']),number_format($result_login['card'],$_SESSION['be_decimal']),
                            number_format($result_login['credit'],$_SESSION['be_decimal']))
			);
			           					
                        foreach($menulist as $menulist) {
                        $return .=$left.($menulist);
                        $return.="\r\n";

                        }
                           
                        
  } } 
  
  $return.="-----------------------------------------------------------------------------------------------------------------------------------------------------";
                                                    
  $return.="\r\n";
  
    $menulist= array(
                            new itemordered('Total','','', number_format($subtotal,$_SESSION['be_decimal']), number_format($tax_new,$_SESSION['be_decimal']),
                            number_format($final,$_SESSION['be_decimal']),number_format($dsc,$_SESSION['be_decimal']),number_format($tot_roff,$_SESSION['be_decimal']),
                            number_format($paid,$_SESSION['be_decimal']),number_format($crd,$_SESSION['be_decimal']),number_format($bal,$_SESSION['be_decimal']))
			);
			           					
                        foreach($menulist as $menulist) {
                        $return .=$left.($menulist);
                        $return.="\r\n";

                        }
   
 $return.="-----------------------------------------------------------------------------------------------------------------------------------------------------";
                                                   
 $return.="\r\n";

$folder = '..\util\Monthly_Email/';
if (!is_dir($folder))
mkdir($folder, 0777, true);
chmod($folder, 0777);

$date = date('m-d-Y-H-i-s', time()); 

$filename =$folder."Report ".$_SESSION['date'];

$handle = fopen($filename.'.txt','w+');
fwrite($handle,$return);
fclose($handle);

$msg_temp='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report Mailer</title>
<style>
@media (max-width: 500px) {

}
</style>
</head>

<body style="background-color:#fff;margin:0;padding:0; text-align: center;">

<div style="height:auto;margin:auto;width:800px;display:inline-block;border:solid 1px #e2e2e2; margin-top: 20px;background-color:#f5f5f5">

<span style="width:770px;float:left;color:#908e8e;font-size:14px;margin-bottom:0px;margin-top:5px;text-align:left;padding:15px;font-family: sans-serif;line-height:22px;"> 
  <strong style="color:#333;margin-bottom: 4px;float: left; width: 100%">Dear Customer,</strong><br>
     We are happy to serve you with our automated e-report facility of Monthly sales summary of your outlet. 
 
</span>

	<div style="width:800px;height:auto;min-height:80px;float:left;background-color:#fff;box-shadow:0px 0px 15px #666;border-bottom:3px solid #ed1e26;">
    	 <div style="width:270px;height:auto;float:left;margin:10px 5px 0 0;">
         	<a href="#"><img src="https://www.expodine.com/images/logo.png" /></a>
         </div>
         <div style="width:300px;height:auto;float:right;margin:10px 0 0 5px;text-align:right">
         <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 24px;">Branch</span>
         	<a href="#" style="color: #313131;font-size: 17px;padding-top: 0px;display: inline-block;padding-right: 10px;text-decoration: none; text-transform: uppercase;    width: 100%; text-align: center;font-family: sans-serif;">'.$branchname.'</a>
      <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 2px;">'.$addr.'</span>    
  </div>
  </div>	
    


  <div style="width:800px;height:auto;float:left;text-align:center;padding:2% 0;font-family:Arial, Helvetica, sans-serif;padding-top:3%;">
  
    	<span style="width:800px;float:left;color:rgb(82, 82, 82);font-size:17px;margin-bottom:5px;"> MONTHLY EMAIL REPORT </span>
        <strong style="color:#464646;font-size:18px;">'.$smstext1.'</span></strong>
  </div>
 
       <div style="width:800px;height:auto;float:left;padding:2% 0;">
 
 	<div class="left" style="width:800px;height:auto;float:left;">
    
        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 0">
        	<span style="color:#727272;font-size:14px;line-height:26px;">TOTAL [ Excl Tax ]</span><br />
            <strong style="color:#222222;font-size:20px;">'.number_format($subtotal,$_SESSION['be_decimal']).' </strong>
        </div>
        
        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 0">
        	<span style="color:#727272;font-size:14px;line-height:26px;">Tax</span><br />
            <strong style="color:#222222;font-size:20px;">'.(number_format($final,$_SESSION['be_decimal'])-number_format($subtotal,$_SESSION['be_decimal'])).' </strong>
        </div>

        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:14px;line-height:26px;">TOTAL SALE</span><br />
            <strong style="color:#222222;font-size:20px;">'.number_format($final,$_SESSION['be_decimal']).'</strong>
        </div>
          
    </div>
    
    <div class="right" style="width:320px;height:auto;float:left;display:none">
    	<div style="width:313px;height:253px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;margin-left:2%;">
        	<div style="width:300px;height:213px;float:left;padding:2%;text-align:center">
                
            	<div style="width: 20px;height: 213px;background-color: #4d5360;float: left;margin-left: 42px;"></div>
                
            </div>
            
        </div>
    </div>
    
 </div>
 
  <a href="https://chart.googleapis.com/chart"></a>

   <div style="width:800px;height:auto;float:left;padding:2% 0;padding-top:0px">
 	<table width="800px" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;vertical-align:middle;border:1px #e5e5e5 solid;box-shadow:2px 5px 10px #ccc">
    	
        <tbody>
        
        </tbody>
    </table>
    
    
    <div style="width:800px;height:360px;float:left;margin-top:2%;background-color:#fff;box-shadow:2px 5px 10px #ccc;display:none">
    	<div style="width:800px;height:45px;line-height: 45px;font-size:17px;padding-left:20px;font-family:Arial, Helvetica, sans-serif">SALES REPORT</div>
        <div style="width:800px;height:320px;float:left;text-align:center"><img width="100%" src="" /></div>
    </div>
    
     <div style="width:780px;height:auto;float:left;margin-top:12px;background-color: #333;padding:0 10px">
     	<p style="font-family:Arial, Helvetica, sans-serif;color:#a5a5a5;line-height:25px;margin-bottom: 2px;text-align:center;  margin-top: 7px">
        
        E : <a style="color:#a5a5a5;text-decoration:none" target="_blank" href="mailto:info@expodine.com">info@expodine.com </a> |
         W : <a style="color:#a5a5a5;;text-decoration:none" target="_blank" href="http://www.expodine.com/"> www.expodine.com</a> |
         T : +91 9895 31 3434
       <span style="width:780px;height:auto;float:left;padding-bottom: 7px;"> © Expodine. All right reserved</span>
	</p>
        
     </div>
    
 </div>
    
</div>

</body>
</html> ';

                  $sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list,be_branchname from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
			 {
                                  $allmail=$result_sms1['be_reportemail_list'];
                                   
                                   $branchname=$result_sms1['be_branchname'];
                                  
                    }
                    } 
                   
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
						 $be_mail_from			    =$result_general['be_mail_from'];
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
       
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = $branchname."  - Monthly Email Report ".$_SESSION['date'];
        $mail->Body = $msg_temp;
        $mail->addAttachment($filename.'.txt');
        $mail->addBCC('info@expodine.com');
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
            
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            
 ///apache mail start ////       
            
$from_name='Expodine';
$from_mail='noreply@gmaiil.com';
$filename1 = $filename.'.txt';

$eol = "\r\n";
$mailto = $allmail;

$replyto='noreply@gmaiil.com';
$file = $filename1;
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$file_name = basename($file);

// header
$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";


// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/html; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $msg_temp."\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename1."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";
            
            $subject = $branchname." - MONTHLY SALES REPORT-".$_SESSION['date'];
            //$message = $msg_temp; 

            if(mail($mailto,$subject,$nmessage, $header)) {
                
                echo "Success";
                
            } else {
                
                echo "Error";
            }  
            
    ///apache mail end ////
             
    } else {
        
          echo 'Message sent.';
          
    }           
	
    }
        
        
 } }	
    
 class report_headnew{
     private $slno;
    

    public function __construct($slno='') {
        $this -> slno =$slno;
        
    }

    public function __toString() {
        $leftCols =70;
	
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                
        return "$left\n";
    }
 }

class itemordered {
    private $main;
    private $item;
    private $unit;
    private $wdi;
    private $wta;
    private $qty;
    private $unitprice;
    private $total;
    private $total1;
    private $total2;
    private $total3;
    
    public function __construct($main = '', $item = '',$unit='',$wdi='',$wta='',$qty='',$unitprice='',$total='',$total1='',$total2='',$total3='') {
        $this -> main = $main;
        $this -> item = $item;
        $this -> unit = $unit;
        $this -> wdi = $wdi;
        $this -> wta = $wta;
        $this -> qty = $qty;
        $this -> unitprice = $unitprice;
        $this -> total = $total;
          $this -> total1 = $total1;
            $this -> total2 = $total2;
              $this -> total3 = $total3;
      
	
    }

    public function __toString() {
        $leftCols =5;
	$leftCols1 =12;
        $leftCols2=12;
        $leftCols3 =10;
	$leftCols4 =10;
        $rightCols2 =10;
        $rightCols3=10;
	$rightCols4=10;	
        $rightCols41=10;	
        $rightCols42=10;	
        $rightCols43=10;	
		
                $left = str_pad($this -> main, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> item, $leftCols1,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> unit, $leftCols2,' ', STR_PAD_BOTH) ;
                $left3 = str_pad($this -> wdi, $leftCols3,' ', STR_PAD_BOTH) ;
		$left4 = str_pad($this -> wta, $leftCols4,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> qty, $rightCols2,' ', STR_PAD_BOTH) ;
		$right3 = str_pad($this -> unitprice, $rightCols3,' ', STR_PAD_LEFT) ;
                $right4 = str_pad($this -> total, $rightCols4,' ', STR_PAD_LEFT) ;
                $right41 = str_pad($this -> total1, $rightCols41,' ', STR_PAD_LEFT) ;
                $right42 = str_pad($this -> total2, $rightCols42,' ', STR_PAD_LEFT) ;
                $right43 = str_pad($this -> total3, $rightCols43,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$left2$left3$left4$right2$right3$right4$right41$right42$right43\n";
    }
}
class regenerate {
    private $slno;
    private $kot;
    private $product;
    private $qty;
    private $staff;
    private $login;
    private $amt;

    public function __construct($slno='',$kot = '',$product = '', $qty = '', $staff = '',$login='',$amt='') {
        $this -> slno =$slno;
        $this -> kot = $kot;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
        $this -> amt = $amt;
    }

    public function __toString() {
        $leftCols =10;
	$leftCols1 =17;
        $leftCols2 =10;
        $rightCols =23;
	$rightCols1 =12;
        $rightCols2 =12;
        $rightCols3 =10;
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $rightCols1,' ', STR_PAD_LEFT) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_LEFT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
                $right3 = str_pad($this -> amt, $rightCols3,' ', STR_PAD_LEFT) ;
        return "$left$left1$left2$right$right1$right2$right3\n";
    }
}
class cat_wise {
    private $product;
    private $qty;
    private $rate;
    private $amount;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
    }

    public function __toString() {
        $leftCols =10;
	$leftCols1 =35;
        $rightCols =10;
	$rightCols1 =15;
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}
class bilno {
    private $name;
    private $price;

    public function __construct($name = '', $price = '') {
        $this -> name = $name;
        $this -> price = $price;
    }

    public function __toString() {
        $leftCols = 40;//32-ojin    33-bbq
        $rightCols = 30;//10-ojin   13-bbq
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class menulist {
    private $product;
    private $qty;
    private $rate;
	private $amount;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	$this -> amount = $amount;
    }

    public function __toString() {
        $leftCols =10;
	$leftCols1 =20;
        $rightCols =20;
	$rightCols1 =20;
	
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}
class cancel_history {
    private $slno;
    private $kot;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$kot = '',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> kot = $kot;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols =5;
	$leftCols1 =5;
        $leftCols2 =25;
        $rightCols =15;
	$rightCols1 =20;
        $rightCols2 =15;
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $rightCols1,' ', STR_PAD_RIGHT) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left1$left2$right$right1$right2\n";
    }
}
class credit_details {
    private $slno;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols =5;
	$leftCols2 =20;
        $rightCols =15;
	$rightCols1 =15;
        $rightCols2 =15;
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_LEFT) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left2$right$right1$right2\n";
    }
}

class expense {
    private $product;
    private $qty;
    private $rate;
 
    public function __construct($product = '', $qty = '', $rate = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	
    }

  public function __toString() {
        $leftCols =20;
	$leftCols2 =10;
        $rightCols =15;
	
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		
        return "$left$left2$right\n";
    }
}
?>
