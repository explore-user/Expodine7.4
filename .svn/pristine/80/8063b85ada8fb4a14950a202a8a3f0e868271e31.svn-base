<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();

  $date_now=date("Y-m-d H-i-s");

  error_reporting(0);
  
  
  
    $sqldenoinsert7=$database->mysqlQuery("Delete from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno is NULL ");  
       
    $sqldenoinsert15=$database->mysqlQuery("Delete from tbl_tablebillmaster where bm_dayclosedate='".$_SESSION['date']."' and bm_billno is NULL ");  
       
    $sqldenoinsert14=$database->mysqlQuery("Delete from tbl_tablebilldetails where bd_dayclose_in='".$_SESSION['date']."' and bd_billno is NULL "); 
      
    $sqldenoinsert5=$database->mysqlQuery("Delete from tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."' and tab_billno is NULL "); 
      
    $sqldenoinsert95=$database->mysqlQuery("Delete from tbl_takeaway_billdetails where tab_dayclose_in='".$_SESSION['date']."' and tab_billno is NULL "); 
  
  
  
    /////dummy table order delete start////
    
          $order_no1='';
          $sql_login00 = $database->mysqlQuery("select ter_orderno from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and "
          . "  ter_billnumber is null limit 10"); 
	  $num_login000   = $database->mysqlNumRows($sql_login00);
	  if($num_login000){
	  while($result_login00  = $database->mysqlFetchArray($sql_login00)) 
	  {
              
              
              
          $order_no1=$result_login00['ter_orderno'];
                       
          $sql_login44 = $database->mysqlQuery("select ts_orderno from tbl_tabledetails where ts_orderno='$order_no1' "); 
	  $num_login8944   = $database->mysqlNumRows($sql_login44);
	  if($num_login8944){
              
          }else{
              
               $sql_module_ord44 =  $database->mysqlQuery("delete FROM tbl_tableorder  where ter_dayclosedate='".$_SESSION['date']."'
               and  ter_orderno= '$order_no1'  and   ter_billnumber is null  " );
              
          }
            
          
          
        }
        }
    
  
  
  
  if(isset($_REQUEST['value']) && $_REQUEST['value']=='mail_analytic'){
      
      
        include('email/km_smtp_class.php');
        require_once('Mailer/PHPMailerAutoload.php');
        
           $loc='';
           $sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list,be_barcode_location from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
			    {
                                 $allmail=$result_sms1['be_reportemail_list'];
                                 
                                 $loc=$result_sms1['be_barcode_location'];
                            }
                  } 
                                              
	 $sql_general = $database->mysqlQuery("Select be_mail_server,be_mail_port,be_mail_emailid,be_mail_password,
         be_mail_secure,be_mail_from from tbl_generalsettings"); 
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
                  
         $string="Please check attached file.".$_REQUEST['mail_name'];
		
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
        
        $mail->Subject = "Analytic Report ".$_SESSION['date'];
        
        $mail->Body = $mailtext;
         
        
        
        
          $dddd=$loc;
        
          //  $dddd="C:\\Users\\explore10\\Downloads\\";
        
          $an_name=$_REQUEST['mail_name'];
        
          $name_analytic=trim($dddd).$an_name;
        
        
         $mail->addAttachment($name_analytic);
          
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
 $msg_temp='';           
$from_name='Expodine';
$from_mail='noreply@gmaiil.com';
$filename1 = $name_analytic;

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
$nmessage .= "Content-Disposition: attachment; filename=\"".$name_analytic."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";
            
             $subject = "Analytic Report ".$_SESSION['date'];
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="lib/rickshaw/rickshaw.min.css" rel="stylesheet">  
    <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/anlytic.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <title>Analytics Report</title>
    <style>.rickshaw_graph img{width: 100%}.highcharts-button{display: none !important}.highcharts-legend{display: none}
        .highcharts-credits{display: none;pointer-events: none}.navbar{border: 0;background-color: #000;background-image: none !important;}.logout-dropdown.navbar{margin-bottom: 7px}
        .download_send_btn{width: 35px; position: fixed;right: 10px;bottom: 20px;z-index: 999;transition:all 0.2s ease;padding: 0;
    background: transparent; border: 0;}.download_send_btn img{width:100%}.download_send_btn:hover{right:15px;}
   
        @media (max-width:1050px){
     .online_sale_font{
  font-size: 8px
       }
    }
    
        </style>
</head>

<body>
    <input type="hidden" value="<?=$date_now?>" id="time_now" >
<input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" >
<a href="#" id="foo1"><div style="bottom: 70px;" class="download_send_btn"><img src="img/send_mail_btn.png"></div></a>
<button  class="download_send_btn" id="foo"><img src="img/save_ico.png"></button>

<?php include "includes/topbar.php"; ?>
<span id="error_div" style="color:greenyellow;position: absolute;z-index: 9;top: 10px;left: 148px;display: none "></span>
<div class="br-pagebody mg-t-0"  id="my-node">
    
    
           
        <div class="contant-section-home" >
    <div class="dashboard-firs-section" >

    <div class="dashboard-firs-bx_sec" >

            <div class="col-md-5 col-xl-5">
                                                <!-- table card start -->
                                                <div class="card table-card">
                                                    <div class="">
                                                        <div class="row-table">
                                                            <div class="col-sm-6 card-block-big br">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span >CASH </span>
                                                                         <h5 id="cash_value">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                               <?php
                                                                             
           $bankdi=0;
           $sql_login_loy12  =  $database->mysqlQuery("select sum(card) as card from( select sum(bm.bm_transactionamount) as card 
                                            FROM tbl_tablebillmaster bm 
                                            left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
                                             left join tbl_bankmaster bk on bk.bm_id=bm.bm_transcbank 
                                            where bk.bm_name like '%bank%' and  bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' union all
                                            select  sum(tbm.tab_transactionamount) as card FROM tbl_takeaway_billmaster tbm 
                                            left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
                                            left join tbl_bankmaster bk on bk.bm_id=tbm.tab_transcbank 
                                            where bk.bm_name like '%bank%' and tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' )x "); 
           $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	   if($num_login_loy12){ 
           while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
	    {  	 
              $bankdi=  $result_login_loy12['card'];
          } }
             
          
          $upidi=0;
           $sql_login_loy121  =  $database->mysqlQuery("select sum(card) as card from( select sum(bm.bm_transactionamount) as card 
                                            FROM tbl_tablebillmaster bm 
                                            left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
                                             left join tbl_bankmaster bk on bk.bm_id=bm.bm_transcbank 
                                            where bk.bm_name like '%upi%' and  bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' union all
                                            select  sum(tbm.tab_transactionamount) as card FROM tbl_takeaway_billmaster tbm 
                                            left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
                                            left join tbl_bankmaster bk on bk.bm_id=tbm.tab_transcbank 
                                            where bk.bm_name like '%upi%' and tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' )x "); 
           $num_login_loy121   = $database->mysqlNumRows($sql_login_loy121);
	   if($num_login_loy121){ 
           while($result_login_loy121 = $database->mysqlFetchArray($sql_login_loy121)) 
	    {  	 
              $upidi=  $result_login_loy121['card'];
          } }
            ?>  
                                                            
                                                            <div title="BANK: <?=$bankdi?> | UPI: <?=$upidi?>" class="col-sm-6 card-block-big" style="cursor: pointer;position: relative ;bottom: -13px;left: 3px;">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center" style="margin-top: -22px;">
                                                                        <span>CARD</span>
                                                                         <h5 id="card_value">0.00</h5>
                                                                         
                                                                             
                                                                         <span  style="position: absolute;bottom: -11px;left: 0px; ">         
                                                                         <h3 style="font-size:8px;font-weight: bold;display: inline-block" id="bank_sep">Bank:<?=$bankdi?> | </h3>   
                                                                         
                                                                         <h3 style="font-size:8px;font-weight: bold;display: inline-block" id="bank_sep1">Upi:<?=$upidi?></h3>              
                                                                         </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="row-table">
                                                            <div class="col-sm-6 card-block-big br">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>CREDIT</span>
                                                                         <h5 id="credit_person_value">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 card-block-big">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>COMPLIMENTORY</span>
                                                                         <h5 id="complimentary_value">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                  


                                                </div>
                                                <!-- table card end -->
                                            </div>
    
    <div class="col-md-5 col-xl-5" style="margin-left: -13px;">
                                                <!-- table card start -->
                                                <div class="card table-card">
                                                    <div class="">
                                                        <div class="row-table">
                                                            <div class="col-sm-6 card-block-big br">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>AVG CST/PER</span>
                                                                         <h5 id="avg_cost">000.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 card-block-big">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>BILL CANCELED</span>
                                                                         <h5 id="bills_cancelled">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="row-table">
                                                            <div class="col-sm-6 card-block-big br">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>ITEM CANCELED</span>
                                                                         <h5 id="items_cancelled">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 card-block-big">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>TOTAL PAX</span>
                                                                         <h5 id="pax">0.00</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- table card end -->
                                            </div>



                                            <div class="col-md-2 col-xl-2" style="margin-left: -13px;">
                                                <!-- table card start -->
                                                <div class="card table-card" style="width: 123%;">
                                                    
                                                    <div class="">
                                                        <div class="row-table" style="display: block;">
                                                            <div class="card-block-big" style="width:100%;float:left;border-bottom: 1px solid #ddd;">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>EXPENSE</span>
                                                                        
                                                                      <?php
                                                                          
                ////accc////
                  
               $tot_exp=0; 
             
                  $expense_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(ev_amount) as expense FROM tbl_expense_voucher where ev_date= '".$_SESSION['date']."' "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $expense_voucher=  $result_login_loy12['expense'];
                    
                      
          }
          }   
           
          $supplier_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(sv_paid_amount) as expense1 FROM tbl_supplier_voucher where sv_date= '".$_SESSION['date']."' "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $supplier_voucher=  $result_login_loy12['expense1'];                  
                      
          }
          }   
          
           $employee_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(ev_amount) as expense2 FROM tbl_employee_voucher where ev_date= '".$_SESSION['date']."' "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $employee_voucher=  $result_login_loy12['expense2'];                              
          }
          }
        ///acc end//
        ///purchase//  
          $purchase=0;
          $sql_login_loy126  =  $database->mysqlQuery("SELECT sum(tg_grand_total) as stock_value from tbl_grn_summary where tg_date= '".$_SESSION['date']."'    "); 
       
	  $num_login_loy126   = $database->mysqlNumRows($sql_login_loy126);
	  if($num_login_loy126){ 
         
		  while($result_login_loy126 = $database->mysqlFetchArray($sql_login_loy126)) 
			{   
                     $purchase=  $result_login_loy126['stock_value'];         
          }
          }
          
          //end///
          
           ?>                                                                    
                                                                         <h5 id=""><?=number_format(($employee_voucher+$expense_voucher+$supplier_voucher),$_SESSION['be_decimal'])?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-block-big" style="width:100%;float:left;border-bottom: 1px solid #ddd;">
                                                                <div class="row">
                                                                    <div class="col-sm-12 text-center">
                                                                        <span>STOCK PURCHASE</span>
                                                                         <h5 id=""><?=number_format($purchase,$_SESSION['be_decimal'])?></h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- table card end -->
                                            </div>
</div>
        <div class="total_sales_box" style="width:27%;margin-bottom: 1%">
        <div class="total_sales_box_left">
            <div class="ttl_left_head left_ttl_sl_act sale_and_bills" id="ttl_sale_tab" action="sales">TTL SALES</div>
            <div class="ttl_left_head sale_and_bills" id="ttl_bill_tab" action="bills">TTL BILLS</div>
            <div class="ttl_left_img"><img src="images/graph.png"> </div>
        </div>
        <div class="main_ttl_bill_count_sec">
           
                <div class="card-header"><h5 class="sale_heading"> 
                        <div id="sale_heading" style="font-size:12px;" >Total Sales</div>
                        
                    <span id="pending_sale_head" style="font-size:12px;">Pending Sales</span>
                </h5>
                    <div class="date_selection_projection" style="display:none">
                            <select id="ttl_sale_selected_day">
                                <option id="today">TODAY</option>
                                <option>YESTERDAY</option>
                                <option>LAST 7 DAYS</option>
                                <option>LAST 30 DAYS</option>
                             </select>
                         </div>
            </div>
                <div class="main_ttl_bill_count_text">
                    <div id="total_sale" style="float:left; font-size:16px;"> 0.00 </div>
                    <span id="pending_sale_amount" style="font-size:16px;">0.00</span>
                     
                    
                </div>
                <div class="main_ttl_bill_count_text" id="total_bill" style="display:none">0</div>
          
            <div class="main_ttl_bill_splited_area">
                <div class="main_ttl_bill_splited_area_head">DI</div>
                <div class="main_ttl_bill_splited_area_contant" id="di_total">0.00</div>
                <div class="main_ttl_bill_splited_area_contant" id="di_total_bill" style="display:none">0</div>
            </div> 
                
            <div class="main_ttl_bill_splited_area">
                <div class="main_ttl_bill_splited_area_head">TA</div>
                <div class="main_ttl_bill_splited_area_contant" id="ta_total">0.00</div>
                <div class="main_ttl_bill_splited_area_contant" id="ta_total_bill" style="display:none">0</div>
            </div> 
                
            <div class="main_ttl_bill_splited_area">
                <div class="main_ttl_bill_splited_area_head">HD</div>
                <div class="main_ttl_bill_splited_area_contant" id="hd_total">0.00</div>
                <div class="main_ttl_bill_splited_area_contant" id="hd_total_bill" style="display:none">0</div>
            </div> 
                
            <div class="main_ttl_bill_splited_area">
                <div class="main_ttl_bill_splited_area_head">CS</div>
                <div class="main_ttl_bill_splited_area_contant" id="cs_total">0.00</div>
                <div class="main_ttl_bill_splited_area_contant" id="cs_total_bill" style="display:none">0</div>
            </div> 
                
           <span id="pend_view_all" style="display: none;font-size: 8px;font-weight: bold;color: black;text-align: center;"></span>     
               
        </div>
        </div>
<!--        //online sale div///-->
        
        
<div class="total_sales_box2" style="margin-bottom: 1% ">

        <div class="main_ttl_bill_count_sec2">
           
                <div class="card-header"><h5 class="sale_heading"> 
                     
                        <div title="Online Order Sales" id="sale_heading" style="color:#b75b68" >PARTNER SALES<a href="" style="position: absolute;top: -43px;right: 204px;font-weight: 500;letter-spacing: 0.5px;color: white;background-color: #820000;border: none;border-radius: 3px;padding: 5px;margin-left: -1px;border-bottom: solid 2px #fff;display: none">Graph</a></div> 
                   
                    </h5>
                    
                         </div>           
            </div>
            <div class="table-wrapper-scroll-y my-custom-scrollbar">

          <table class="table table-bordered table-striped mb-0" style="font-size:12px;">
                    
          <tbody class="online_sale_font">
   
        
        <?php 

        $stringstat='';
        
            $stringstat.=" tol_status='Y' and  tab_status='Closed' and tab_complimentary!='Y'  AND tab_payment_settled='Y'"
            . " AND tab_dayclosedate = '".$_SESSION['date']."' ";   
           
          $sql_loginta32  =  $database->mysqlQuery("select tol_local_order,tol_name,sum(tab_netamt) as tot FROM tbl_takeaway_billmaster "
                  . " left join tbl_online_order "
          . " on tol_id=tab_food_partner  where $stringstat  group by tab_food_partner "); 
  
	  $num_loginta32   = $database->mysqlNumRows($sql_loginta32);
	  if($num_loginta32){
		  while($result_loginta32  = $database->mysqlFetchArray($sql_loginta32)) 
			{
                      
                      if($result_loginta32['tol_local_order']=='N'){
                          
                          $type='[Online]';
                                  
                      }else{
                          
                          $type=''; ;
                      }
                      
                      ?>
    
      <tr style="font-size:10px;font-weight: bold">
          <th scope="row"><?=$result_loginta32['tol_name']?> <?=$type?></th>

          <td ><?=number_format($result_loginta32['tot'],$_SESSION['be_decimal'])?></td>
          

          </tr> 
          
          <?php
                        
          } }else{ 
              
              
              ?>
    
     <tr>
                <th scope="row" >NO DATA</th>
        
                
          <td></td>
          
          
          
          </tr> 
    
    
     <?php
                        
          } 
              
              
              ?>
    
  </tbody>
</table>

</div>
 </div>
        
        </div>
        
<!--        ///end///-->
        

        <div class="dashboard-firs-section-sec-row">
         <div class="col-sm-12">
            <div class="left_lst_sev_sales_grp" style="overflow:hidden; height: 215px;">
                <div class="card border-0">
                <div class="card-header">
                <h5>Steward Perfomance <a style="margin-left:20px;border:solid 1px;padding:2px;border-radius:3px;display: none" href="future.php?set=sale">PREDICTION</a></h5>
                                 <div class="date_selection_projection" style="display:none">
                                    <select id="steward_selected_day">
                                        <option id="today">TODAY</option>
                                        <option>YESTERDAY</option>
                                        <option>LAST 7 DAYS</option>
                                        <option>LAST 30 DAYS</option>
                                     </select>
                                 </div>
                            </div>
                            
                           <div class="card-block">
                                <div style="    margin-top: -53px;height: 300px;float: left;width: 100%;z-index: -1; position: relative; margin-left: -21px;" id="stackedchart" class="nvd-chart"></div>

            </div>
                        </div>
            </div><!--left_lst_sev_sales_grp-->

            <div class="most_sale_box" style="margin-left: 1%;width: 32%">
                <div class="card-header" style="height: 40px;">
                          <h5>5 Best selling 
                              
                        <span style="font-size:10px;color:darkred;font-weight: bold">   &nbsp; &nbsp; Dayclose :  <?=$_SESSION['date']?></span>         
                              
                             </h5>
                     </div>
                    <div class="most_sale_lsit_head">
                        <span>Item Name</span>
                        <span class="most_sale_lsit_rt">Total</span>
                        <span class="most_sale_lsit_rt">Qty</span>
                    </div>
                <div class="best_sale_lsit">               
                    
                </div>                                              
                    
                 </div>
                 <div class="most_sale_box" style="margin-left: 14px;width: 33%">
                    <div class="card-header" style="height: 40px;">
                          <h5>5 Most Rev Gen 
              <span style="font-size:10px;color:darkred;font-weight: bold">  &nbsp;  Today : <?=date('Y-m-d H:i:s')?></span> 
               </h5>
                    </div>
                    <div class="most_sale_lsit_head">
                        <span>Item Name</span>
                        <span class="most_sale_lsit_rt">Total</span>
                        <span class="most_sale_lsit_rt">Qty</span>
                    </div>
                    <div class="most_revenue_lsit">                 
                        
                    </div>    
                </div>



               <div class="most_sale_box" style="margin-left: 10px;width: 40%;display: none">
                    <div class="card-header">
                          <h5>FLOOR SALES <strong style="font-size:9px;color: black"> [<?php echo date('Y-m-d'); ?>]</strong></h5>
                    </div>
                    <div class="most_sale_lsit_head">
                        <span>Floor</span>
                        <span class="most_sale_lsit_rt">Total</span>
                       
                    </div>
                   
                        
           <?php 

           $stringstat1='';
        
//            $stringstat1.=" fr_status='Active' and  bm_status='Closed' and bm_complimentary!='Y'  "
//            . " AND bm_dayclosedate = '".$_SESSION['date']."' ";   
//           
//          $sql_loginta32  =  $database->mysqlQuery("select fr_floorname,sum(bm_finaltotal) as tot FROM tbl_tablebillmaster "
//                  . " left join tbl_floormaster "
//          . " on fr_floorid=bm_floorid  where $stringstat1  group by bm_floorid "); 
//  
//	  $num_loginta32   = $database->mysqlNumRows($sql_loginta32);
//	  if($num_loginta32){
//		  while($result_loginta32  = $database->mysqlFetchArray($sql_loginta32)) 
//			{
                      ?>
                       <div class="">    
                           <span style="margin-left: 7px;"><?//=$result_loginta32['fr_floorname']?></span>
                         
                         <span style="margin-right: 18px;" class="most_sale_lsit_rt"><?//=number_format($result_loginta32['tot'],$_SESSION['be_decimal'])?></span>
                       </div>    
                      <?php
                 // } 
         //               
          //}
          ?>
                        
                    </div>    
                </div>



             
            
             
           </div>
        </div>
        
    </div>
    
    <div class="dashboard-sec-right-section" style="min-height: inherit;display:none">
    
        <div class="card border-0">
                    
            
          </div>
        
    </div>
    
<div class="footer_section_grph" style="width:99%;padding-top: 20px; border-top: 2px solid #333;padding-top: 15px;">
        <div class="card anlytics_bottom_graph">
            <h5 class="steward_head">TODAY'S HOURLY SALES </h5>
            <div class="card-block">
            <div id="weakly_new" style="width: 100%; height:200px; margin: -25px auto"></div>
            </div>
       </div>
    </div>

    <div class="footer_section_grph " style="width:99%;margin-top: 30px;border-top: 2px solid #333;padding-top: 15px">
       <div class="card anlytics_bottom_graph">
           <h5 class="steward_head">SALES COMPARISON</h5>
           
           <div style="width: 37%;margin-left: 300px;height: 10%;margin-top: -23px">
              
               FROM : 
               <input value="<?=date('Y-m-01')?>" type="date" id="sale_from" onchange="sales_compare();" style="height: 25px" onfocus="(this.type='date')">
               
               
               &nbsp;&nbsp;   TO : 
               <input  value="<?=date('Y-m-30')?>" type="date" id="sale_to" onchange="sales_compare();" style="height: 25px " onfocus="(this.type='date')">
          </div> 
           
           
           
           
            <div class="card-block sale_compare_class">
            <div id="sale_compare" style="width: 100%; height:200px; margin: 0 auto"></div>
            </div>
       </div>
    </div>
    
    
    
    
    <div class="footer_section_grph " style="width:99%;margin-top: 25px; border-top: 2px solid #333;padding-top: 15px;">
       <div class="card anlytics_bottom_graph">
            <h5 class="steward_head">SALES-COST-PROFIT</h5>
             <div style="width: 37%;margin-left: 300px;height: 10%;margin-top: -23px">
              
               FROM : 
               <input value="<?=date('Y-m-01')?>" type="date" id="cost_from" onchange="cost_compare();" style="height: 25px" onfocus="(this.type='date')">
               
               
               &nbsp;&nbsp;   TO : 
               <input value="<?=date('Y-m-30')?>" type="date" id="cost_to" onchange="cost_compare();" style="height: 25px " onfocus="(this.type='date')">
          </div> 
            
            <div class="card-block cost_profit_class" >
            <div id="profit_new" style="width: 100%; height:200px; margin: 0 auto"></div>
            </div>
       </div>
    </div>
    
    
     <div class="center_mostsale_total_area" style="position:relative;display:none;top:36px">
                
                 <div class="center_pro_section">
                     <div class="card-header" style="    padding: 8px 0 6px 8px;">
                         <h5>SALES - COST  </h5>
                         
                       </div>
                     
                    <div class="projection_chert_sec">
                        
                         <div id="curve_chart" style="width: 100%; height: 200px;float:left"></div>
                        
                     </div>
                 
                 </div>
                 
             </div>

    </div>
         
        </div>
    
    <script src="lib/jquery.js"></script>
     <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/analytics.js"></script>
    
    <script src="js/dom-to-image.min.js"></script>
<script src="js/FileSaver.min.js"></script>

    <script type="text/javascript" src="lib/charts/loader.js"></script>
 
     <script type="text/javascript"> 
         
         cost_compare();
         
   function cost_compare(){
      
      var cost_from=$('#cost_from').val();
      
      var cost_to=$('#cost_to').val();
      
     
      
      if(cost_from!='' && cost_to!=''){
          
          google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawStacked22);

    function drawStacked22() {
      
      var dataString = 'value=foodcost&from='+cost_from+'&to='+cost_to;
        
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) { 
                 var parsed_data='';
                parsed_data=JSON.parse(data1);
                if(parsed_data!=''){
                   
                   $('.cost_profit_class').show();
                   
               }else{
                   
                    $('.cost_profit_class').hide();
                    
                    
               }
               var hourly_arr =[
                           ['Date', 'Sales','Cost' ,'Amount'],
                       ];
                
              for(var st=0;st<parsed_data["FOOD_COST"].length;st++){ 
                  
                      var date=parsed_data['FOOD_COST'][st].Date;
                      var sale=parsed_data['FOOD_COST'][st].Sale;
                      var cost=parsed_data['FOOD_COST'][st].Cost;
                      var profit=parsed_data['FOOD_COST'][st].Profit;   
                   
                   if(sale>cost){
                       
                        var type='[P]' ;   
                        var clr='green';
                   }else{
                       
                       var type='[L]' ;   
                         var clr='red';
                   }
                   
                     hourly_arr.push([date+type,Number(sale),Number(cost),Number(profit)]);
                       
            }
        
      var data = google.visualization.arrayToDataTable(hourly_arr);
       
        var options = {
          title : '',
          vAxis: {title: 'Amount'},
          hAxis: {title: 'Date'},
          
          seriesType: 'bars',
          series: {4: {type: 'line'},
            0:{color:'olive'},
            1:{color:'darkred'},
            2:{color:clr},
          }
        };
      
      var chart = new google.visualization.ColumnChart(document.getElementById('profit_new'));
      chart.draw(data, options);
  
        }
            });
    } 
      }
    
  }
  </script>
    
     
     
    <script type="text/javascript"> 
        sales_compare();
   function sales_compare(){
      
      var sale_from=$('#sale_from').val();
      
      var sale_to=$('#sale_to').val();
      
     
      
      if(sale_from!='' && sale_to!=''){
          
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawStacked11);

    function drawStacked11() {
    
      var dataString = 'value=sales_comparison&from='+sale_from+"&to="+sale_to;
        
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) { 
                var parsed_data='';
                parsed_data=JSON.parse(data1);
               
               if(parsed_data!=''){
                   
                   $('.sale_compare_class').show();
                   
               }else{
                   
                    $('.sale_compare_class').hide();
               }
               
                
               
               
               
               var hourly_arr =[
                           ['Date', 'Sales'],
                       ];
                
              for(var st=0;st<parsed_data["FOOD_COST"].length;st++){ 
                  
                
                  
                      var date=parsed_data['FOOD_COST'][st].Date;
                      var sale=parsed_data['FOOD_COST'][st].Sale;
                      
                     hourly_arr.push([date,Number(sale)]);
                       
            }
        
      var data = google.visualization.arrayToDataTable(hourly_arr);
       var options =  {
  title: '',
  hAxis: {title: ' Date'},
  vAxis: {title: 'Total Sales '},
  
  legend: 'none'
  
};
        
      
      var chart = new google.visualization.LineChart(document.getElementById('sale_compare'));
      chart.draw(data, options);
  
        }
            });
    } 
    
    }
      
      
   }
    
     </script>
    
    <script type="text/javascript">
        
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawStacked);

    function drawStacked() {
      
      var dataString = 'value=foodcost&from=&to';
        
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) { 
                var parsed_data='';
                parsed_data=JSON.parse(data1);
                
                if(parsed_data!=''){
                   
                   $('.cost_profit_class').show();
                   
               }else{
                   
                    $('.cost_profit_class').hide();
               }
                
               var hourly_arr =[
                           ['Date', 'Sales','Cost' ,'Amount'],
                       ];
                
              for(var st=0;st<parsed_data["FOOD_COST"].length;st++){ 
                  
                      var date=parsed_data['FOOD_COST'][st].Date;
                      var sale=parsed_data['FOOD_COST'][st].Sale;
                      var cost=parsed_data['FOOD_COST'][st].Cost;
                      var profit=parsed_data['FOOD_COST'][st].Profit;   
                   
                   if(sale>cost){
                       
                        var type='[P]' ;   
                        var clr='green';
                   }else{
                       
                       var type='[L]' ;   
                         var clr='red';
                   }
                   
                     hourly_arr.push([date+type,Number(sale),Number(cost),Number(profit)]);
                       
            }
        
      var data = google.visualization.arrayToDataTable(hourly_arr);
       
        var options = {
          title : '',
          vAxis: {title: 'Amount'},
          hAxis: {title: 'Date'},
          
          seriesType: 'bars',
          series: {4: {type: 'line'},
            0:{color:'olive'},
            1:{color:'darkred'},
            2:{color:clr},
          }
        };
      
      var chart = new google.visualization.ColumnChart(document.getElementById('profit_new'));
      chart.draw(data, options);
  
        }
            });
    } 
        
        
   </script>      
        
   
  <script type="text/javascript">
        
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawStacked1);

    function drawStacked1() { 
     
      var dataString = 'value=sales_comparison&from=&to=';
        
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) {
                
                var parsed_data='';
                parsed_data=JSON.parse(data1);
                 if(parsed_data!=''){
                   
                   $('.sale_compare_class').show();
                   
               }else{
                   
                    $('.sale_compare_class').hide();
               }
               var hourly_arr =[
                           ['Date', 'Sales'],
                       ];
                
               
              for(var st=0;st<parsed_data["FOOD_COST"].length;st++){ 
                  
                      var date=parsed_data['FOOD_COST'][st].Date;
                      var sale=parsed_data['FOOD_COST'][st].Sale;
                      
                     hourly_arr.push([date,Number(sale)]);
                       
            }
        
      var data = google.visualization.arrayToDataTable(hourly_arr);
       var options =  {
  title: '',
  hAxis: {title: ' Date'},
  vAxis: {title: 'Total Sales '},
  
  legend: 'none'
  
};
        
      
      var chart = new google.visualization.LineChart(document.getElementById('sale_compare'));
      chart.draw(data, options);
  
        }
            });
    } 
        
        
   </script>    



<script>

 $(document).ready(function () {
      
      
      
      ////cloud check////
   
   var cloud_api_on=$('#cloud_api_on').val();
  
   
    if(cloud_api_on=='Y'){ 
   
       setTimeout(function(){  
        
         $.post("test2.php", {set:'test_api_service_fast'},function(data){ });
      
       }, 1000);   
      
    }
      
     ////////end//////////
     
 

   $('#foo').click(function() {
     
     var time_now=$('#time_now').val();
     domtoimage.toBlob(document.getElementById('my-node'))
     .then(function(blob) {
     window.saveAs(blob, time_now+'.jpeg');
      
    });
    
                      $('#error_div').show();
                      $('#error_div').text('< < < DOWNLOADING > > >');
                      $('#error_div').delay(3500).fadeOut('slow');
                      
                         setTimeout(function(){
                             
                           location.reload();
                            
                        }, 3500); 
    
                     
});


$('#foo1').click(function() {
    
     var time_now1=$('#time_now').val();
    //var time_now1='analytics';
     
                     $('#error_div').show();
                     $('#error_div').text(' SENDING MAIL ');
                     $('#error_div').delay(7500).fadeOut('slow');
                      
      domtoimage.toBlob(document.getElementById('my-node'))
     .then(function(blob) {
     window.saveAs(blob, time_now1+'.jpeg');
     
      });
      var dd= time_now1+'.jpeg';
      
      
      setTimeout(function(){
                      
       var data1="value=mail_analytic&mail_name="+dd;

       $.ajax({
        type: "POST",
        url: "analytics.php",
        data: data1,
        success: function(data2)
        { 
         
          location.reload();
          
        }
        });
    
       }, 6000); 
    
});




 });





</script>
 
</body>
    

</html>