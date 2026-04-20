<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

error_reporting(0);

if (isset($_REQUEST['set'])&&($_REQUEST['set']=="loyalty_list_bill")){
    $_SESSION['loy_name']=$_REQUEST['name'];
    $_SESSION['loy_cust_id'] =$_REQUEST['loy_id_list'];
    
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
        
       <script type="text/javascript" src="searcher/jquery/jquery-1.11.0.min"></script>
        <script type="text/javascript" src="searcher/jquery-autocomplete.js"></script>
        
        <script src="assets/js/modernizr.min.js"></script>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0;}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}
	.action-btn {width: 18px;height: 23px;display: inline-block;margin-right: 5px;font-size: 17px;color: #666 !important;}
			.listting-top-filter-section{padding: 9px; min-height: 580px;max-height: 580px;border-radius: 5px;overflow-x: hidden}
			.listting-top-filter-section_head{width: 100%;height: auto;float: left;padding: 10px 0;background-color: #f9f9f9;padding-left:10px;color: #333;text-transform: uppercase}.filter-textbox-cc{margin-bottom: 8px}
	.side-menu{display: none}.content-page{margin-left: 0 !important;width: 100%}.open-left{display: none}
        .dataTables_scrollHeadInner{width: 100% !important}.dataTables_scrollHeadInner table{width: 100% !important}.table-striped{width: 100% !important}
           .loyalty_icon{width: 100%;height: auto;float: left;}.lyt_lft_img{width: 100%;height: auto;float: left;text-align: center;margin-top: -10px}.lyt_lft_img img{width: 80px}
              .lyt_ttl_txt{width: 100%;height: auto;float: left;padding: 2%;border: solid 1px #f4f4f4;margin-bottom: 5px;    font-size: 13px;color: #333;} 
            .widget_clr{    background-color: #c53825 !important;color: #666;}
            .val_top{font-size: 17px;}.val_txt_top{font-size: 12px;text-transform: uppercase;}.phno_lyt{font-size: 13px;padding: 2px 0;top: 5px;position: relative;width: 100%;    display: inline-block;text-align: left;    padding-left: 13px;}.detail_sec{background-color: #f4f8fb;padding-bottom: 9px}
            .fav_tbl td{font-size: 14px;text-align: left;}.phno_lyt span{font-weight: bold}
            .back_pg_btn{position: absolute;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(0,0,0,0.1);
    padding-top: 8px;
    text-align: center;
    color: #000;}
                </style>

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper" style="overflow:auto">

            <!-- Top Bar Start -->
             <?php include( 'includes/header.php') ?>
            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    
                	<div class="top-head-section">
                    		 
                          
                            <strong style="color:limegreen" id="msg_show"></strong>
                    </div>
                    <div class="container load_to_redeem_pop">
                  
                       <div class="col-md-3 col-sm-3 col-xs-12 no-padding">
                       <!--<div class="listting-top-filter-section_head">Customer Details</div>-->
                        <div class="listting-top-filter-section">
                        
     <div class="loyalty_icon">
     <?php
    
    $billnos=  array();                      
    $loy_qry112 = $database->mysqlQuery("select lob_billno from tbl_loyalty_pointadd_bill  where lob_loyalty_customer ='".$_SESSION['loy_cust_id']."' and lob_mode='DI' ");
    $num_loy12 = $database->mysqlNumRows($loy_qry112);
     if($num_loy12)
     {
         while($loyalty_listing21 = $database->mysqlFetchArray($loy_qry112))
         {
          
           $billnos[]="'".$loyalty_listing21['lob_billno']."'";
             
     }
     }   
     
    $allbill=implode(',',$billnos);
    if($allbill==""){
        $allbill='null';
    }
    
    $billnos1=  array();                      
    $loy_qry1121 = $database->mysqlQuery("select lob_billno from tbl_loyalty_pointadd_bill  where lob_loyalty_customer ='".$_SESSION['loy_cust_id']."' and lob_mode!='DI' ");
    $num_loy121 = $database->mysqlNumRows($loy_qry1121);
     if($num_loy121)
     {
         while($loyalty_listing211 = $database->mysqlFetchArray($loy_qry1121))
         {
          
           $billnos1[]="'".$loyalty_listing211['lob_billno']."'";
             
     }
     }   
     
     $allbill1=implode(',',$billnos1);
    if($allbill1==""){
        $allbill1='null';
    }
                
     $all_menu_combo=  array();  
    
    $loy_qry11223 = $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bd.bd_billno in ($allbill) and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno in ($allbill) and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_billno in ($allbill1) and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno in ($allbill1) and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id )
                                                    x group by x.menuid order by qty desc LIMIT 0,5");
    
    
    $num_loy12223 = $database->mysqlNumRows($loy_qry11223);
     if($num_loy12223)
     {
         while($loyalty_listing2123 = $database->mysqlFetchArray($loy_qry11223))
         {
          $all_menu_combo[]= $loyalty_listing2123['menu']." ";  
             
     }
      $all_menu_combo_show=implode(',',$all_menu_combo); 
     } 
     
     
    $loy_qry12 = $database->mysqlQuery("select tl.ly_firstname,tl.ly_lastname,tl.ly_emailid,tlp.lob_billno,tl.ly_entrydatetime,tl.ly_mobileno,tl.ly_totalvisit,tl.ly_points,sum(tlp.lob_bill_amount) as tot_bill_amount from tbl_loyalty_reg tl left join tbl_loyalty_pointadd_bill tlp on tlp.lob_loyalty_customer=tl.ly_id  where ly_id='".$_SESSION['loy_cust_id']."'");
    $num_loy2 = $database->mysqlNumRows($loy_qry12);
     if($num_loy2)
     {
         while($loyalty_listing2 = $database->mysqlFetchArray($loy_qry12))
         {
           $total_points=$loyalty_listing2['ly_points'];
           $tot_amount_tillnow=number_format($loyalty_listing2['tot_bill_amount'],$_SESSION['be_decimal']);
           $visit=$loyalty_listing2['ly_totalvisit'];
           $num=$loyalty_listing2['ly_mobileno'];
           $joined=$loyalty_listing2['ly_entrydatetime'];
           $mail=$loyalty_listing2['ly_emailid'];
           $name_all=$loyalty_listing2['ly_firstname'].' '.$loyalty_listing2['ly_lastname'];
         }
         }
               
        ?>
         
         
                                <div class="card-box ">
                                    <a href="listing.php"><span class="back_pg_btn ti-arrow-left"></span></a>
                                    <a href="javascript:;" class="center-block text-center text-dark">
                                        <img title="<?=$_SESSION['loy_name']?>"  onmouseover="return cus_detail();" src="../img/loyalty_icon.jpg" class="thumb-lg img-thumbnail img-circle" alt="">
                                        <div class="h5 m-b-0"><strong style="font-size:17px;color:#000"><?=$name_all?> </strong></div>
                                       
                                    </a>
                                    
                                </div>
         
         
            <div class="detail_sec">
                 <span class="phno_lyt" style="text-transform:uppercase"> <i class="fa fa-phone"></i>  :    <span><?=$num?> </span> </span><br>
                 <span class="phno_lyt" style="text-transform:uppercase"> <i class="fa fa-envelope"></i>  : <span><?=$mail?>  </span> </span><br>
                 <span class="phno_lyt" style="text-transform:uppercase"> <i class="fa fa-user-plus"></i> : <span><?=$joined?>  </span> </span>
             </div>
         
                            <div class="card-box" style="margin-top:5px;padding: 3px;">
									<div class="bar-widget">
										<div class="table-box" style="height:auto">
											<div class="table-detail"  style="width: 10%;">
												<div class="iconbox bg-purple">
													<i class="fa fa-user-o"></i>
												</div>
											</div>

											<div class="table-detail">
											   <h4 class="m-t-0 m-b-0 val_top"><b><?=$visit?></b></h4>
											   <h5 class="text-muted m-b-0 m-t-0 val_txt_top">NO OF VISITS</h5>
											</div>
                                            

										</div>
									</div>
								</div>
         
                                <div class="card-box" style="padding: 7px;">
									<div class="bar-widget">
										<div class="table-box" style="height:auto">
											<div class="table-detail"  style="width: 10%;">
												<div class="iconbox bg-danger">
													<i class="fa fa-star-o"></i>
												</div>
											</div>

											<div class="table-detail">
											   <h4 class="m-t-0 m-b-0 val_top"><b><?=$total_points?></b></h4>
											   <h5 class="text-muted m-b-0 m-t-0 val_txt_top">TOTAL POINTS</h5>
											</div>
                                            

										</div>
									</div>
								</div>
         
                            <div class="card-box"  style="padding: 7px;">
									<div class="bar-widget">
										<div class="table-box" style="height:auto">
											<div class="table-detail" style="width: 10%;">
												<div class="iconbox bg-custom">
													<i class="fa fa-exchange"></i>
												</div>
											</div>

											<div class="table-detail">
											   <h4 class="m-t-0 m-b-0 val_top"><b><?=$tot_amount_tillnow?></b></h4>
											   <h5 class="text-muted m-b-0 m-t-0 val_txt_top">AMOUNT SPEND</h5>
											</div>
                                           

										</div>
									</div>
								</div>
         
                            <div class="row">
                            <div class="panel panel-color panel-custom col-sm-12 no-padding" style="margin-top:10px;    margin-bottom: 0;">
									<!-- Default panel contents -->
									<div class="panel-heading widget_clr" style="padding: 5px 10px !important;">
										<h3 class="panel-title">Favourite  5 Items </h3>
									</div>
									
									<!-- Table -->
									<table class="table fav_tbl">
										<tbody>
											
                                                                                            <?php
                                                                                            
                                                                                            $fav_1=explode(',',$all_menu_combo_show);
                                                                                          for($i=0;$i<count($fav_1);$i++){
                                                                                            ?>
                                                                                            <tr>
												<td><i class="fa  fa-dot-circle-o"> <?=$fav_1[$i]?></i>  </td>
                                                                                                </tr>
                                                                                          <?php } ?>
											
											
										</tbody>
									</table>
								</div>
                                
                                </div>
                               
                            </div>
                            
                        </div>
                        
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12" style="padding-right: 0">
                        
                        <div class="card-box table-responsive" style="">
                            
                            <form enctype="multipart/form-data"   method="post" name="submitxmldetails" id="submitxmldetails">
                            <input type="hidden" name="typeofupload" id="typeofupload"  value="">
                            <div class="dt-buttons btn-group" style="margin-bottom:8px;width:100%">
                            	
                            
                             <div class="col-sm-3">
                                	<div class="table-filter-text">Bill No</div>
                                        <input type="text" class="list-filter-textbox" placeholder="" onKeyUp="return billno_search('<?=$_SESSION['loy_cust_id']?>');" id="billno" >
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="table-filter-text">From Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="" onkeyup="return from_search('<?=$_SESSION['loy_cust_id']?>');" onchange="return from_search('<?=$_SESSION['loy_cust_id']?>');" id="datepicker">
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="table-filter-text">To Date</div>
                                	<div class="table-filter-text"> </div>
                                        <input type="text" class="list-filter-textbox" placeholder="" onkeyup="return to_search('<?=$_SESSION['loy_cust_id']?>');"  onchange="return to_search('<?=$_SESSION['loy_cust_id']?>');" id="datepicker1">
                                </div>
                                
                            </div>
                             </form>
                            
                        	<table id="registration-fixed-col" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                <tr> 
                                      <th style="width:100px;">DATE</th>
                                    <th style="width:120px;">BILL NO</th>
                                   
                                   <th style="width:120px;">SUBTOTAL AMOUNT </th>
                                    <th style="width:100px;"> REDEEM PTS</th>
                                    <th style="width:100px;">ADDED PTS</th>
                                    <th style="width:120px;">REDEEM AMOUNT</th>
                                      <th style="width:120px;">FINAL TOTAL</th>
                                   
                                   
                                </tr>
                                </thead>

                                <tbody id="bill_list_show">
     <?php
                               
     $tot_redeem="";
     $tot_red_amount="";
     $tot_add_point="";
     $loy_qry1 = $database->mysqlQuery("select * from tbl_loyalty_pointadd_bill where lob_loyalty_customer='".$_SESSION['loy_cust_id']."' limit 15");
   
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
         {
             $tot_redeem=$tot_redeem+$loyalty_listing['lob_point_redeem'];
             $tot_red_amount=$tot_red_amount+$loyalty_listing['lob_redeem_amount'];
             $tot_add_point=$tot_add_point+$loyalty_listing['lob_point_add'];
             $bill_amt=$bill_amt+str_replace(',','',$loyalty_listing['lob_bill_amount']);
             $after_redeem=str_replace(',','',$loyalty_listing['lob_bill_amount'])-str_replace(',','',$loyalty_listing['lob_redeem_amount']);
             $after_redeem_tot=$after_redeem_tot+$after_redeem;
             
                                ?>
                                <tr>
                                    <td  style="width:100px;font-size: 11px"><?=$loyalty_listing['lob_date']?></td>
                                    <td  style="width:120px;font-size: 11px"> <a style="border:solid 1px;cursor: pointer;padding: 3px;background-color: whitesmoke"  onclick="billview('<?=$loyalty_listing['lob_billno']?>','<?=$loyalty_listing['lob_date']?>');" > <?=$loyalty_listing['lob_billno']?> </a></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($loyalty_listing['lob_bill_amount'],$_SESSION['be_decimal'])?> </td>
                                    <td  style="width:100px;font-size: 11px"><?=number_format($loyalty_listing['lob_point_redeem'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:100px;font-size: 11px"><?=number_format($loyalty_listing['lob_point_add'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($loyalty_listing['lob_redeem_amount'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($after_redeem,$_SESSION['be_decimal'])?></td>
                                   
                                   
                                </tr>
                                     <?php
                                      }
                                     ?>
                                     <tr>
                                         <td style="width: 120px;font-weight: bold;font-size: 11px">Total</td>
                                         <td style="width: 120px;font-size: 11px"><?=number_format($bill_amt,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 100px;font-weight: bold;font-size: 11px"><?=$tot_redeem?> </td>
                                        <td style="width: 100px;font-weight: bold;font-size: 11px"><?=$tot_add_point?></td>
                                        <td style="width: 120px;font-weight: bold;font-size: 11px"><?=number_format($tot_red_amount,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 120px;font-size: 11px"><?=number_format($after_redeem_tot,$_SESSION['be_decimal'])?></td>
                                         <td style="width: 100px;font-size: 11px"></td>
                                     
                                     </tr>
                                     
                               <?php
                                        
                               }else{ 
                                 ?>
                                     
                                     <tr>
                                         <td style="width: 190px"></td>
                                         <td style="width: 65px"></td>
                                        <td style="width: 150px;color:red"> No Records</td>
                                        <td style="width: 100px"></td>
                                        <td style="width: 130px"></td>
                                        <td style="width: 120px"></td>
                                        <td style="width: 120px"></td>
                                     
                                     </tr>
                                     
                                     <?php }  ?>
                                
                        </tbody>
                        </table>
                        
                        </div>

                        </div> 

                        </div> 

                        </div>

                        </div>
        			

     <div class="redeem-bll-popup-sec" style="display:none">
                                                     
     </div>                                            
            
        <script>
            var resizefunc = [];
        </script>

       
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

        
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
        
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
             
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
           
                $('#billno').focus();
                $('#datatable').dataTable();
				
//           var table = $('#registration-fixed-col').DataTable({
//           scrollY: "500px",
//            scrollX: true,
//            scrollCollapse: true,
//            paging: true,
//            "ordering": false
//           
//        });
//        
//        var table = $('#popup-table-nn').DataTable({
//            scrollY: "360px",
//            scrollX: false,
//            scrollCollapse: true,
//            paging: false,
//           
//        });
        
	});
 TableManageButtons.init();             
       
  
function billview(b,d){
    $('.redeem-bll-popup-sec').show(500);
     
     var data="set=bill_view_all&billno_loyalty="+b+"&date_bill="+d;
    
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
         $('.redeem-bll-popup-sec').html(data);
        }
    });
  
}

function close_list(){
    $('.redeem-bll-popup-sec').hide();
}

 function  billno_search(i){
       
          var bill=$('#billno').val();
     
         var data="set_search_bill=search_billno&billno="+bill+"&loyid="+i;
         
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#bill_list_show').html(data);
        }
    });
   
    } 
    
   function  from_search(i){
       
          var bill=$('#billno').val();
          var from=$('#datepicker').val();
          var to=$('#datepicker1').val();
     
         var data="set_search_bill=search_billno&billno="+bill+"&loyid="+i+"&from="+from+"&to="+to;
        
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#bill_list_show').html(data);
        }
    });
   
    }   
    
    function  to_search(i){
       
          var bill=$('#billno').val();
          var from=$('#datepicker').val();
          var to=$('#datepicker1').val();
     
        var data="set_search_bill=search_billno&billno="+bill+"&loyid="+i+"&from="+from+"&to="+to;
         
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#bill_list_show').html(data);
        }
    });
   
    } 
    
 </script>
        
		<style>.dataTables_scrollBody{height:403px !important;}.modal .modal-dialog .modal-content{padding: 15px 7px}
			.modal .modal-dialog .modal-content .group{margin-bottom: 16px;}.modal-dialog{width:500px !important;top: 10%;}
                        .new_print_loading_bill_sms{width:100%;height:80%;position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.8);text-align:center;z-index:9999999999999;top: 20%}
                        .new_print_loading_bill_sms img {width:200px;}
		</style>

    </body>

</html>