<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }
$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;

?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Report</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/website.css" rel="stylesheet" type="text/css">
<link href="css/graph_style.css" rel="stylesheet" type="text/css">
<link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
<script src="js/graph/jquery-2.1.1.js"></script>
<script src="js/graph/app.js"></script>
<script src="js/FileSaver.js"></script>
<script src="js/html2canvas.js"></script>
 <script src="js/canvas-toBlob.js"></script>
 <script src="js/jspdf.debug.js"></script>
 <script>
$(function() { 
			
    $(".myreportprint").click(function() { 
	$('.myreportemaildiv').css("display","none");
	$('.myreportprintdiv').css("display","none");
        html2canvas($(".left_contant_container"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                //document.body.appendChild(canvas);
               /* canvas.toBlob(function(blob) {
					saveAs(blob, "Report.png"); 
					
				});*/
				var imgData = canvas.toDataURL('image/png');              
			    var doc = new jsPDF('l', 'px', 'a4', false);
			    doc.setFontSize(40);
			    doc.setDrawColor(0);
			    doc.text(35, 35, "Report");
				doc.addImage(imgData, 'PNG', 50, 50, 550, 300, undefined, true);
                doc.save('sample-file.pdf');
				$('.myreportemaildiv').css("display","block");
				$('.myreportprintdiv').css("display","block");
				//uploadToServer(dataURItoBlob(imgData));
            }
        });
    });
	
	$(".myreportemail").click(function() { 
	$('.myreportemaildiv').css("display","none");
	$('.myreportprintdiv').css("display","none");
        html2canvas($(".left_contant_container"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                //document.body.appendChild(canvas);
               /* canvas.toBlob(function(blob) {
					saveAs(blob, "Report.png"); 
					
				});*/
				var imgData = canvas.toDataURL('image/png');              
			   /* var doc = new jsPDF('l', 'px', 'a4', false);
			    doc.setFontSize(40);
			    doc.setDrawColor(0);
			    doc.text(35, 35, "Report");
				doc.addImage(imgData, 'PNG', 50, 50, 550, 300, undefined, true);
                doc.save('sample-file.pdf');*/
				$('.myreportemaildiv').css("display","block");
				$('.myreportprintdiv').css("display","block");
				uploadToServer(dataURItoBlob(imgData));
            }
        });
    });
	
	
	
var uploadToServer = function( newFile) {
		var formData = new FormData();  
		formData.append('file', newFile); 
		//submit formData using $.ajax			
		$.ajax({
			url: 'analytics_email.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				//console.log(data);
				$(".loaderror").css("display","block");
				//$(".loaderror").addClass("popup_validate");
				$(".loaderror").text(data);
				$('.loaderror').delay(2000).fadeOut('slow');
			}
		});	
	}
}); 
function dataURItoBlob(dataURI) {

		// convert base64 to raw binary data held in a string
		// doesn't handle URLEncoded DataURIs
		var byteString;
		if (dataURI.split(',')[0].indexOf('base64') >= 0)
			byteString = atob(dataURI.split(',')[1]);
		else
			byteString = unescape(dataURI.split(',')[1]);

		// separate out the mime component
		var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0]

		// write the bytes of the string to an ArrayBuffer
		var ab = new ArrayBuffer(byteString.length);
		var ia = new Uint8Array(ab);
		for (var i = 0; i < byteString.length; i++) {
			ia[i] = byteString.charCodeAt(i);
		}

		//Passing an ArrayBuffer to the Blob constructor appears to be deprecated, 
		//so convert ArrayBuffer to DataView
		var dataView = new DataView(ab);
		var blob = new Blob([dataView], {type: mimeString});

		return blob;
	}
     
</script>


<style>
body{font-family:inherit;/*overflow:hidden;*/background-color:#d7dce3 !important;background-image:none !important}
.left_contant_container {height: 80vh;padding-bottom:15px;background-color: #d7dce3 !important;}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.billgeneration_head{font-size:20px;}
.task-graph > ul > li{width:25%}
</style>

</head>

<body>

<div class="container-fluid no-padding">
   <?php include "includes/topbar.php"; ?>
      <div class="middle_container">
      
      <div style="width:100%;background-color:#fff;" class="top_site_map_cc ">
        <div style="width:100%;text-align:center;color:#000;" class="billgeneration_head">
        <div style="color:#F00;float:left;display:none;width:30%" class="loaderror"></div>
        <div >
        Report
        </div>
        
        	<span class="pie_select_bydate">
            	
                <div class="date_sel_grp_contain">
                    <input type="hidden" name="monthval"  id="monthval" value="<?=date("M")?>"> 
                    <select class="date_sel_grp" name="selectreportype" id="selectreportype" style="display:none">
                        <option value="m">Monthly</option>
                        <option value="d" selected>Day</option>
                        <option value="w">Week</option>
                    </select>
                </div>
            </span>
        </div>
      </div>
            
                <div style="min-height:480px;width:100%" class="left_contant_container">
                     <div class="report_graph_container">
                     		
                        <div class="col-lg-7 col-md-7 col-sm-12 no-padding">
                        
                        <div class="anylst_report_container">
                            
                            	<div class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Total Sale</div>
                                        <?php
										$sql_menulists="SELECT (sum(bm_finaltotal)) as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate  ='".$_SESSION['date']."'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalsale"></span></div>   
                                </div><!--anylst_report_main-->
                                
                                <div class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Cash</div>
                                        <?php
										// select  (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  bm_status='Closed' AND  ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  bm_dayclosedate between '2016-02-01' and '2016-02-27'  order by bm_dayclosedate,bm_billtime ASC
										//$sql_menulists="select (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot from tbl_tablebillmaster where  bm_status='Closed' AND bm_dayclosedate  ='".$_SESSION['date']."'";
										$sql_menulists="select  (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  bm_status='Closed' AND  ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   )  AND bm_dayclosedate ='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalcashsale"></span></div> 
                                
                                </div><!--anylst_report_main-->
                                <div class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Card Pay</div>
                                        <?php
										$sql_menulists="select  (sum(bm_transactionamount))  as tot from tbl_tablebillmaster  where bm_dayclosedate ='".$_SESSION['date']."'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalcardsale"></span></div> 
                                </div><!--anylst_report_main-->
                                
                                <div class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Credit Sale</div>
                                         <?php
										$sql_menulists="select  sum(c.cd_amount)  as tot from tbl_tablebillmaster b left join tbl_paymentmode p on b.bm_paymode=p.pym_id left join tbl_credit_details c on b.bm_billno = c.cd_billno where  b.bm_status='Closed' AND  p.pym_code='credit_person' AND b.bm_dayclosedate ='".$_SESSION['date']."'"
;
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalcreditsale"></span></div> 
                                </div><!--anylst_report_main-->
                                
                                
                                <div style="border-bottom:0;padding-top:5px;" class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Complimentery</div>
                                         <?php
										$sql_menulists="select  (sum(bm_finaltotal))  as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  bm_status='Closed' AND  pym_code='complimentary'  AND bm_dayclosedate ='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalcompsale"></span></div> 
                                </div><!--anylst_report_main-->
                                
                                <div style="border-bottom:0;padding-top:5px;" class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Total Bills</div>
                                        <?php
										$sql_menulists="select  (count(bm_billno))  as tot from tbl_tablebillmaster   where  bm_status='Closed'   AND bm_dayclosedate ='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                         <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline totalbills"></span></div> 
                                </div><!--anylst_report_main-->
                                
                                <div style="border-bottom:0;padding-top:5px;" class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Bills Cancelled</div>
                                         <?php
										$sql_menulists="select (count(bm_billno))  as tot from tbl_tablebillmaster  where (bm_status='Cancelled' or bm_status='Cancelled for Split') AND bm_dayclosedate ='".$_SESSION['date']."'"  ;
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline billsacancld"></span></div> 
                                </div><!--anylst_report_main-->
                                
                                <div style="border-bottom:0;padding-top:5px;" class="anylst_report_main">
                                	<div class="anyls_report_center_cc">
                                		<div class="anylst_report_main_head">Item Cancelled</div>
                                         <?php
										$sql_menulists="select (count(bm.bm_billno)) as tot from tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno where bd.bd_cancelled='Y' AND bm.bm_dayclosedate='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                    	<div class="anylst_report_main_detail"><?=round($result_menuss['tot'],2)?></div>
                                        <?php }} ?>
                                     </div>
                                     <div class="anyls_report_graph_cc"><span class="sparkline itemcanceld"></span></div> 
                                </div><!--anylst_report_main-->
                            
                            </div><!--anylst_report_container-->  
                        
                        	<div style="padding-right: 10px;" class="col-md-4 sm_graph_detail">
							<div style="padding-left:0;" class="widget white">
										<div class="balance-widget">
                                        	  <h3>No of bills generated</h3>
                                        <div style="margin-top:20px;padding-right: 10px;" class="task-graph">
                                        <span id="visits" class="sparkline"></span>
                                            <ul>
                                             <?php
											 //(count(distinct(bm_billno)))   and td.bd_type='Dinein'   LEFT JOIN  tbl_tablebilldetails as td ON tm.bm_billno=td.bd_billno
										$sql_menulists="select  ((count((bm_billno))))  as tot from tbl_tablebillmaster as tm    where  tm.bm_status='Closed'   AND tm.bm_dayclosedate ='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                                <li>DI<span><?=round($result_menuss['tot'],2)?></span></li>
                                                <?php } } ?>
                                                <?php
										$sql_menulists="select  ((count((tab_billno))))  as tot from tbl_takeaway_billmaster    where  tab_status='Delivered'   AND tab_dayclosedate ='".$_SESSION['date']."' and tab_hd='N'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                                <li>TA<span><?=round($result_menuss['tot'],2)?></span></li>
                                                <?php } } ?>
                                                <?php
										$sql_menulists="select  ((count((tab_billno))))  as tot from tbl_takeaway_billmaster    where  tab_status='Delivered'   AND tab_dayclosedate ='".$_SESSION['date']."' and tab_hd='Y'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                                <li>HO<span><?=round($result_menuss['tot'],2)?></span></li>
                                                 <?php } } ?>
                                            </ul>
                                        </div>  
												
											</div>
										</div><!-- Balance Widget -->
									</div>
                                    <div style="padding-left:0;padding-right: 10px;" class="col-md-4 sm_graph_detail">
                                    	<div class="widget white">
										<div class="balance-widget">
											<h3>5 Best selling item-Dine in</h3>
                                             <?php //count((bd.bd_menuid))
										$sql_menulists="SELECT mn.mr_menuname,sum((bd.bd_qty)) as ct FROM `tbl_tablebilldetails` as bd left join tbl_tablebillmaster as bm ON bm.bm_billno=bd.bd_billno LEFt JOIN tbl_menumaster as mn ON mn.mr_menuid=bd.bd_menuid where bm.bm_status='Closed' AND bm.bm_dayclosedate='".$_SESSION['date']."' AND bd.bd_cancelled='N' group by bd.bd_menuid ORDER BY ct DESC LIMIT 0,5";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	$i=1;
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
											<h2><i><strong><?=$i++;?></strong>. <?=$result_menuss['mr_menuname']?> -<strong><?=$result_menuss['ct']?></strong></i></h2>
                                            <?php } } ?>
										</div><!-- Balance Widget -->
									</div>
                                    </div>
                                    
                                     <div style="padding-left:0;" class="col-md-4 sm_graph_detail">
                                    	<div class="widget white">
										<div class="balance-widget">
											<h3>Steward / Staff</h3>
                                            
                                            <div class="staff_report_cc">
                                            <?php //count((bd.bd_menuid))
										$sql_menulists="select sm.ser_firstname,sum(to1.ter_rate * to1.ter_qty) as amount from tbl_tablebillmaster as bm   LEFT JOIN tbl_tableorder as to1 ON bm.bm_billno=to1.ter_billnumber   LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=to1.ter_staff
 WHERE to1.ter_cancel='N' and to1.ter_qty >0 and bm.bm_status='Closed'  and bm.bm_dayclosedate ='".$_SESSION['date']."' GROUP BY sm.ser_staffid ORDER BY amount DESC";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	$i=1;
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                                <h2><i><strong><?=$i++;?></strong>. <?=$result_menuss['ser_firstname']?> -<strong><?=$result_menuss['amount']?></strong></i></h2>
                                                
                                                 <?php } } ?>
                                               </div>  
										</div><!-- Balance Widget -->
									</div>
                                    </div>
                                    
                                
						
                        
                         <div class="graph_container">
                         
                         <div class="widget white">
                              <div class="visitor-chart">
                                  <span>TOTAL Bills-<?=date("M")?></span>
                                   <?php
								   $month=date("m");
									$sql_menulists="select  (count(bm_billno))  as tot from tbl_tablebillmaster   where  bm_status='Closed'   AND  MONTH(bm_dayclosedate)='".$month."'";
									$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
									$num_menuss  = $database->mysqlNumRows($sql_menuss);
									if($num_menuss){	
									while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
											{	
											?>
                                  <h3><?=round($result_menuss['tot'],2)?></h3>
                                  <?php } }?>
                                  <ul>
                                      <li class="all">DI</li>
                                      <li class="mob">TA</li>
                                  </ul>
                                  <div id="flot-sp1ine" style="height:31vh;min-height:180px;"></div>
                                  <div style="padding: 0px 5px 5px 5px;" class="widget white">
                          <div class="mini-stats-sec">
                              <div class="row">	
                              <?php for($i=0;$i<=31;$i++)
									{ ?>
                                  <!--<div class="graph_bottom_detail">
                                      <div class="quick-stats">
                                          <h4><?=$i?></h4>
                                          <p>1/11/2015</p>
                                      </div>
                                  </div>-->
                                 <?php } ?>
                                 
										
										
									</div>
								</div>
							</div>
									</div>
								</div>
                         </div>
                        
						</div><!--col-7-->
                        
                        
                         <div class="col-lg-5 col-md-5 col-sm-12 no-padding">
                         
                         	<div class="pie_chart_container" style="position:relative">
                            	<div class="widget white no-gape">
								<h2 style="border-bottom:1px #e8ecec solid;padding-bottom:10px;" class="widget-title">
                                <?php
										$sql_menulists="SELECT (sum(bm_finaltotal))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate ='".$_SESSION['date']."'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                	Sale OF The Day - <strong>( <?=round($result_menuss['tot'],2)?> )</strong>
                                    <?php } } ?>
                                    </h2>
								<ul class="pie_detail_cl">
                                      <li class="all">DI</li>
                                      <li class="ta">TA</li>
                                      <li class="ho">Ho</li>
                                  </ul>
								<div class="widget-content">
									<div class="task-graph">
										<div class="task-graph-chart" style="min-height:195px;">
											<span class="sparkpie" id="pie-task">1,1,2</span>
                                            <?php
										$sql_menulists="SELECT (sum(bm_finaltotal))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate ='".$_SESSION['date']."'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
											<i>Total Sales - <strong>Rs. <?=round($result_menuss['tot'],2)?></strong></i>
                                            <?php } } ?>
                                            
                                            <?php
										$sql_menulists="SELECT fm.fr_floorname,sum(tm.bm_finaltotal) as tot FROM tbl_tablebillmaster as tm LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=tm.bm_floorid   where tm.bm_status='Closed' AND tm.bm_dayclosedate ='".$_SESSION['date']."' GROUP BY fm.fr_floorname";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                            <i><?=$result_menuss['fr_floorname']?> - <strong>Rs. <?=round($result_menuss['tot'],2)?></strong></i>
                                           <!-- <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>
                                            <i>  <strong></strong></i>-->
                                            <?php } } ?>
                                            
										</div>
										<ul style="margin-top:35px;width:100%;position: absolute;bottom:15px;left: -8px;">
                                        <?php
										$sql_menulists="select  ((sum((bm_finaltotal))))  as tot from tbl_tablebillmaster as tm    where  tm.bm_status='Closed'   AND tm.bm_dayclosedate ='".$_SESSION['date']."' ";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
											<li>Dine In<span><?=round($result_menuss['tot'],2)?></span></li>
                                            <?php } } ?>
                                            
                                            <?php
										$sql_menulists="select  ((sum((tab_netamt))))  as tot from tbl_takeaway_billmaster    where  tab_status='Delivered'   AND tab_dayclosedate ='".$_SESSION['date']."' and tab_hd='N'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
											<li>Take Away<span><?=round($result_menuss['tot'],2)?></span></li>
                                            <?php } } ?>
                                            
                                            <?php
										$sql_menulists="select  ((sum((tab_netamt))))  as tot from tbl_takeaway_billmaster    where  tab_status='Delivered'   AND tab_dayclosedate ='".$_SESSION['date']."' and tab_hd='Y'";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
											<li>Home Delivery<span><?=round($result_menuss['tot'],2)?></span></li>
                                            <?php } } ?>
                                            <li>Counter Sales<span>415</span></li>
										</ul>
									</div>
								</div>
							</div>
                            </div>
                            	
                                <div class="left_graphp_detail">
                                    <div class="col-md-6 no-padding">
                                        <div class="earning-stats stats">
                                            <i class="glyphicon glyphicon-signal red"></i>
                                            <span>LAST WEEK SALES</span>
                                            <?php
											//SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot,bm_dayclosedate FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('2016-02-05', INTERVAL 1 WEEK) group by bm_dayclosedate
										$sql_menulists="SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('".$_SESSION['date']."', INTERVAL 1 WEEK)";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                            <h3><?=round($result_menuss['tot'],2)?></h3>
                                            <?php } } ?>
                                            <div class="progress">
                                                <div style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar red">
                                                </div>
                                            </div>
                                            <?php
											//SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot,bm_dayclosedate FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('2016-02-05', INTERVAL 1 WEEK) group by bm_dayclosedate
										$sql_menulists="SELECT (count(bm_billno))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('".$_SESSION['date']."', INTERVAL 1 WEEK)";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                            <p>TOTAL : <?=round($result_menuss['tot'],2)?> Bills</p>
                                            <?php } } ?>
                                        </div><!-- Earning Stats -->
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="earning-stats stats">
                                            <i class="glyphicon glyphicon-signal green"></i>
                                            <span>LAST MONTH SALES</span>
                                            <?php
											//SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot,bm_dayclosedate FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('2016-02-05', INTERVAL 1 WEEK) group by bm_dayclosedate
										$sql_menulists="SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('".$_SESSION['date']."', INTERVAL 1 MONTH)";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                            <h3><?=round($result_menuss['tot'],2)?></h3>
                                             <?php } } ?>
                                            <div class="progress">
                                                <div style="width: 100%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar green">
                                                </div>
                                            </div>
                                             <?php
											//SELECT (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot,bm_dayclosedate FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('2016-02-05', INTERVAL 1 WEEK) group by bm_dayclosedate
										$sql_menulists="SELECT (count(bm_billno))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND bm_dayclosedate > DATE_SUB('".$_SESSION['date']."', INTERVAL 1 MONTH)";
										$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
										$num_menuss  = $database->mysqlNumRows($sql_menuss);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
												{	
												?>
                                            <p>TOTAL : <?=round($result_menuss['tot'],2)?> Bills</p>
                                            <?php } } ?>
                                        </div><!-- Earning Stats -->
                                    </div>
                            		</div><!--/left_graphp_detail-->
                                    
                                    <div class="report_send_btn_cc">
                                    	<div class="col-md-6 no-padding myreportemaildiv">
                                        	<a style="width:100%" href="#" title="" class="icon-btn myreportemail"><i class="glyphicon glyphicon-send red"></i> Send Mail</a>
                                        </div>
                                        <div class="col-md-6 myreportprintdiv" style="padding-right:0">
                                        	<a style="width:95%" href="#" title="" class="icon-btn myreportprint"><i class="glyphicon glyphicon-floppy-save red"></i>PDF Report</a>
                                        </div>
                                    </div><!--report_send_btn_cc-->
                            	
                         </div> <!--col-6-->  
                         
                         
                            
                     </div><!--report_graph_container--> 
                </div><!--take_staff_view_cc-->
                
          </div><!--left_contant_container-->

      </div><!--middle_container-->          
</div><!--container_fluide-->

	

<script type="text/javascript">
	jQuery(document).ready(function(){
	//**** New Order ****//
	$(function() {
	$("#new-orders").sparkline([4,5,6,7,6,5,4,3,3,4], {
	type: 'bar',
	height: '40px',
	barSpacing:2,
	barWidth: 5,
	barColor: '#806fff',
	negBarColor: '#806fff'});
	});
	
	//**** My Balance ****//
	$(function() {
	$("#my-balance").sparkline([4,5,6,7,8,6,5,6,7,4], {
	type: 'bar',
	height: '40px',
	barSpacing:2,
	barWidth: 5,
	barColor: '#6d6d6d',
	negBarColor: '#6d6d6d'});
	});
	
	//**** My Orders ****//
	$(function() {
	$("#my-orders").sparkline([4,5,6,7,8,7,6,5,5,6,7,8,7,5,7,5,6,7,8,7,6,5,7,8,7,5,7,5,6,7,6], {
	type: 'bar',
	height: '40px',
	barSpacing:2,
	barWidth: 5,
	barColor: '#fff',
	negBarColor: '#fff'});
	});
	
	//**** Visitor Sparkline ****//
	$("#visitors").sparkline([1,5,2,7,9,6,7,11,9,13,12,15,14,18], {
    type: 'line',
    width: '260px',
    height: '75px',
    lineColor: '#a1a8b3',
    fillColor: '#646a75',
    spotColor: '#a1a8b3',
    minSpotColor: '#a1a8b3',
    maxSpotColor: '#a1a8b3',
    highlightSpotColor: '#a1a8b3',
    highlightLineColor: '#949aa5'});
	
	//**** Visits Sparkline ****//
	var noofbills=new Array();
	var month=$('#monthval').val();
	var report=$('#selectreportype').val();
	var data=null;
	   data = {
		"set": "load_noofbills",
		"report":report
	  };
	  data = $(this).serialize() + "&" + $.param(data);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data,
			success: function(data) { 
				var res=data.trim();
				$.each($.parseJSON(res), function(k, v) {
				  noofbills.push(v);
				});
				$("#visits").sparkline(noofbills, {
				type: 'line',
				width: '100%',
				height: '20px',
				lineColor: '#556b8d',
				fillColor: '#eef0f3',
				spotColor: '#556b8d',
				minSpotColor: '#556b8d',
				maxSpotColor: '#556b8d',
				highlightSpotColor: '#556b8d',
				highlightLineColor: '#556b8d'});
				
			}
	});

		//**** sale Sparkline ****//
		
	var firstarray=new Array();
	var report=$('#selectreportype').val();
	var data2=null;
	   data2 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"totalsale"
	  };
	  data2 = $(this).serialize() + "&" + $.param(data2);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data2,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray.push(v);
				});	
				
			  $(".totalsale").sparkline(firstarray, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});	
	var firstarray1=new Array();
	var report=$('#selectreportype').val();
	var data3=null;
	   data3 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"cashsale"
	  };
	  data3 = $(this).serialize() + "&" + $.param(data3);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data3 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray1.push(v);
				});	//alert(firstarray1);
				
			  $(".totalcashsale").sparkline(firstarray1, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});	
	
	var firstarray2=new Array();
	var report=$('#selectreportype').val();
	var data4=null;
	   data4 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"cardsale"
	  };
	  data4 = $(this).serialize() + "&" + $.param(data4);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data4 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray2.push(v);
				});	//alert(firstarray2);
				
			  $(".totalcardsale").sparkline(firstarray2, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	var firstarray3=new Array();
	var report=$('#selectreportype').val();
	var data5=null;
	   data5 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"creditsale"
	  };
	  data5 = $(this).serialize() + "&" + $.param(data5);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data5 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray3.push(v);
				});	//alert(firstarray3);
				
			  $(".totalcreditsale").sparkline(firstarray3, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	var firstarray4=new Array();
	var report=$('#selectreportype').val();
	var data6=null;
	   data6 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"compsale"
	  };
	  data6 = $(this).serialize() + "&" + $.param(data6);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data6 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray4.push(v);
				});	//alert(firstarray3);
				
			  $(".totalcompsale").sparkline(firstarray4, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	var firstarray5=new Array();
	var report=$('#selectreportype').val();
	var data7=null;
	   data7 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"totalbills"
	  };
	  data7 = $(this).serialize() + "&" + $.param(data7);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data7 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray5.push(v);
				});	//alert(firstarray3);
				
			  $(".totalbills").sparkline(firstarray5, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	var firstarray6=new Array();
	var report=$('#selectreportype').val();
	var data8=null;
	   data8 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"totalbillscancled"
	  };
	  data8 = $(this).serialize() + "&" + $.param(data8);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data8 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray6.push(v);
				});	//alert(firstarray3);
				
			  $(".billsacancld").sparkline(firstarray6, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	var firstarray7=new Array();
	var report=$('#selectreportype').val();
	var data9=null;
	   data9 = {
		"set": "load_totalsalemonthly",
		"report":report,
		"type":"totalitemcancled"
	  };
	  data9 = $(this).serialize() + "&" + $.param(data9);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data9 ,
			success: function(data) { 
				var res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
				 	firstarray7.push(v);
				});	//alert(firstarray3);
				
			  $(".itemcanceld").sparkline(firstarray7, {
			  type: 'line',
			  width: '99%',
			  height: '42px',
			  lineColor: '#F5351B',
			  fillColor: '#FFCAC3',
			  spotColor: '#556b8d',
			  minSpotColor: '#F5351B',
			  maxSpotColor: '#F5351B',
			  highlightSpotColor: '#556b8d',
			  highlightLineColor: '#556b8d'});
					
			}
	});
	
	//**** Page Views Sparkline ****//
	$("#page-views").sparkline([2,7,7,11,9,13,12,5,7], {
    type: 'line',
    width: '85px',
    height: '40px',
    lineColor: '#6fa3e2',
    fillColor: '#edf3fb',
    spotColor: '#6fa3e2',
    minSpotColor: '#6fa3e2',
    maxSpotColor: '#6fa3e2',
    highlightSpotColor: '#6fa3e2',
    highlightLineColor: '#6fa3e2'});
	
	//**** Pages Sparkline ****//
	$("#pages").sparkline([6,4,7,2,9,8,2,5,4], {
    type: 'line',
    width: '85px',
    height: '40px',
    lineColor: '#a6b0c2',
    fillColor: '#f6f7f9',
    spotColor: '#a6b0c2',
    minSpotColor: '#a6b0c2',
    maxSpotColor: '#a6b0c2',
    highlightSpotColor: '#a6b0c2',
    highlightLineColor: '#a6b0c2'});
	
	//**** Time Average Sparkline ****//
	$("#time").sparkline([7,3,5,7,8,9,3,5,6], {
    type: 'line',
    width: '85px',
    height: '40px',
    lineColor: '#85c744',
    fillColor: '#f3f9ec',
    spotColor: '#85c744',
    minSpotColor: '#85c744',
    maxSpotColor: '#85c744',
    highlightSpotColor: '#85c744',
    highlightLineColor: '#85c744'});
	
	//**** Return Sparkline ****//
	$("#return").sparkline([7,5,2,6,7,8,5,8,7], {
    type: 'line',
    width: '85px',
    height: '40px',
    lineColor: '#f2af4f',
    fillColor: '#fdf5ea',
    spotColor: '#f2af4f',
    minSpotColor: '#f2af4f',
    maxSpotColor: '#f2af4f',
    highlightSpotColor: '#f2af4f',
    highlightLineColor: '#f2af4f'});
	
	//**** Bounce rate Sparkline ****//
	$("#bounce").sparkline([4,6,7,8,3,5,8,6,5], {
    type: 'line',
    width: '85px',
    height: '40px',
    lineColor: '#e74c3c',
    fillColor: '#fdedeb',
    spotColor: '#e74c3c',
    minSpotColor: '#e74c3c',
    maxSpotColor: '#e74c3c',
    highlightSpotColor: '#e74c3c',
    highlightLineColor: '#e74c3c'});
	
	//**** Minimize Widget ****//	
	$(".hide-btn").click( function(){
		$(this).parent().next(".widget-content").slideToggle();
	});
	
	//**** Close Widget Area ****//	
	$(".close-sec").click( function(){
		$(this).parent().parent().slideToggle();
	});
	
	//**** Random Number ****//
	random_num( 'random', 2000, 3 );
			
	//**** Support Ticket ****//
	$('#ticket-scroll').enscroll({
	showOnHover: true,
	verticalTrackClass: 'track3',
	easingDuration:100,
	verticalHandleClass: 'handle3'
	});	
	
	//**** User Comments ****//
	$('#comment-scroll').enscroll({
	showOnHover: true,
	verticalTrackClass: 'track3',
	easingDuration:100,
	verticalHandleClass: 'handle3'
	});	
	
	//**** User Comments ****//
	$('#forum-scroll').enscroll({
	showOnHover: true,
	verticalTrackClass: 'track3',
	easingDuration:100,
	verticalHandleClass: 'handle3'
	});	
	
	
	//**** Task Pie Chart ****//
	var noofbills_s=new Array();
	var month=$('#monthval').val();
	var report=$('#selectreportype').val();
	var data=null;
	   data = {
		"set": "load_piechart",
		"report":report
	  };
	  data = $(this).serialize() + "&" + $.param(data);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data,
			success: function(data) { 
				var res=data.trim();
				$.each($.parseJSON(res), function(k, v) {
				  noofbills_s.push(v);
				});//alert(noofbills_s)
				$("#pie-task").sparkline(noofbills_s, {
				type: 'pie',
				width: '200',
				height: '200',
				sliceColors: ['#8878ff','#363b46','#bbbbbb']});
				//8878ff blue dine
				//363b46 black ta
				//bbbbbb ash home
				
			}
	});
	
	
	
	
			
	//**** Ticker ****//
	$(function(){
	$('#ticker').vTicker({ 
	speed: 500,
	pause: 3000,
	animation: 'fade',
	mousePause: false,
	showItems: 1
	});
	});

	//**** Flot Spline ****//
	
	
	
	
	$(function(){
		
	var res;//var d0,d00;
	var firstarray=new Array();
	var newstring=new Array();
	var month=$('#monthval').val();
	var report=$('#selectreportype').val();
	var data=null;
	   data = {
		"set": "load_monthlybill_dine",
		"report":report
	  };
	  data = $(this).serialize() + "&" + $.param(data);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data,
			success: function(data) { 
				res=data.trim();
				$.each($.parseJSON(res), function(k, v) {
					var parsedTest ;
					parsedTest = v;
				 	firstarray.push(parsedTest);
				});
	var 	 d0 = [
	[1,firstarray[0]],[2,firstarray[1]],[3,firstarray[2]],[4,firstarray[3]],[5,firstarray[4]],[6,firstarray[5]],[7,firstarray[6]],[8,firstarray[7]],[9,firstarray[8]],[10,firstarray[9]],[11,firstarray[10]],[12,firstarray[11]],[13,firstarray[12]],[14,firstarray[13]],[15,firstarray[14]],[16,firstarray[15]],[17,firstarray[16]],[18,firstarray[17]],[19,firstarray[18]],[20,firstarray[19]],[21,firstarray[20]],[22,firstarray[21]],[23,firstarray[22]],[24,firstarray[23]],[25,firstarray[24]],[26,firstarray[25]],[27,firstarray[26]],[28,firstarray[27]],[29,firstarray[28]],[30,firstarray[29]],[31,firstarray[30]]
	];
	
	
	
	var res2;
	var firstarray2=new Array();
	var data2=null;
	   data2 = {
		"set": "load_monthlybill_ta",
		"report":report
	  };
	  data2 = $(this).serialize() + "&" + $.param(data2);//alert(data);
	   $.ajax({
			type: "POST",
			dataType: "text",
			url: "load_mainreport.php", 
			data: data2,
			success: function(data) { 
				res2=data.trim();
				$.each($.parseJSON(res2), function(k, v) {
					var parsedTest ;
					parsedTest = v;
				 	firstarray2.push(parsedTest);
				});
	
	
	
				var  d00 = [
				 [1,firstarray2[0]],[2,firstarray2[1]],[3,firstarray2[2]],[4,firstarray2[3]],[5,firstarray2[4]],[6,firstarray2[5]],[7,firstarray2[6]],[8,firstarray2[7]],[9,firstarray2[8]],[10,firstarray2[9]],[11,firstarray2[10]],[12,firstarray2[11]],[13,firstarray2[12]],[14,firstarray2[13]],[15,firstarray2[14]],[16,firstarray2[15]],[17,firstarray2[16]],[18,firstarray2[17]],[19,firstarray2[18]],[20,firstarray2[19]],[21,firstarray2[20]],[22,firstarray2[21]],[23,firstarray2[22]],[24,firstarray2[23]],[25,firstarray2[24]],[26,firstarray2[25]],[27,firstarray2[26]],[28,firstarray2[27]],[29,firstarray2[28]],[30,firstarray2[29]],[31,firstarray2[30]]
					
				];
				/*var d0 = [
	[0,0],[1,0],[2,1],[3,2],[4,15],[5,5],[6,12],[7,10],[8,55],[9,13],[10,25],[11,10],[12,12],[13,6],[14,2],[15,0],[16,0]
	];*/
	/*var d00 = [
	[0,0],[1,0],[2,1],[3,0],[4,1],[5,0],[6,2],[7,0],[8,3],[9,1],[10,0],[11,1],[12,0],[13,2],[14,1],[15,0],[16,0]
	];*/
				
				
				$("#flot-sp1ine").length && $.plot($("#flot-sp1ine"), [
				d0, d00
				],
				{
				series: {
				lines: {
				show: false
				},
				splines: {
				show: true,
				tension: 0.4,
				lineWidth: 1,
				fill: 0.8
				},
				points: {
				radius: 0,
				show: true
				},
				shadowSize: 2
				},
				grid: {
				hoverable: true,
				clickable: true,
				tickColor: "#d9dee9",
				borderWidth: 1,
				color: '#cec8ff'
				},
				colors: ["#8878ff", "#6f7685"],
				xaxis:{
				},
				yaxis: {
				ticks: 5
				},
				tooltip: true,
				tooltipOpts: {
				content: " %x --> %y",
				defaultTheme: false,
				shifts: {
				x: 1,
				y: 31
				}
				}
				}
				);
			}
	
			});
	
			}
			
	});
	
	
		
	/*var d0 = [
	[0,0],[1,0],[2,1],[3,2],[4,15],[5,5],[6,12],[7,10],[8,55],[9,13],[10,25],[11,10],[12,12],[13,6],[14,2],[15,0],[16,0]
	];*/
	/*var d00 = [
	[0,0],[1,0],[2,1],[3,0],[4,1],[5,0],[6,2],[7,0],[8,3],[9,1],[10,0],[11,1],[12,0],[13,2],[14,1],[15,0],[16,0]
	];*/
	
	
		
	});
	
	//**** Earning Flot Chart ****//
	var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var d1 = [];var d2=[];
	for (var i = 0; i <= 11; i += 1) {
	d1.push([i, parseInt((Math.floor(Math.random() * (1 + 20 - 10))) + 10)]);
	d2.push([i, parseInt((Math.floor(Math.random() * (1 + 30 - 5))) + 20)]);
	}
	$("#flot-1ine").length && $.plot($("#flot-1ine"), [{
	data: [d1,d2]
	}], 
	{ 
	series: {
	lines: {
	show: true,
	lineWidth: 1,
	fill: true,
	fillColor: {
	colors: [{
	opacity: 0.3
	}, {
	opacity: 0.3
	}]
	}
	},
	points: {
	radius: 3,
	show: true
	},
	grow: {
	active: true,
	steps: 50
	},
	shadowSize: 2
	},
	grid: {
	hoverable: true,
	clickable: true,
	tickColor: "#f0f0f0",
	borderWidth: 1,
	color: '#eeeeee'
	},
	colors: ["#9e9e9e","#6f7685"],
	xaxis:{
	},
	yaxis: {
	ticks: 5
	},
	tooltip: true,
	tooltipOpts: {
	content: "chart: %x.1 is %y.4",
	defaultTheme: false,
	shifts: {
	x: 0,
	y: 20
	}
	}
	}
	);
});	
</script>   
</body>

</html>