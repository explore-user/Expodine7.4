<?php
//include('includes/session.php');		
session_start();
include("database.class.php"); 
$database	= new Database();
error_reporting(0);



if($_REQUEST['set']=="suball") {
    
    $inv= 'temp_' . rand(5, 999999);
    $functionid=$_REQUEST['funid'];
    $totalcost=$_REQUEST['totalvalue'];
    $exttotcost=$_REQUEST['extotalcst'];
    $disctotvalcost=$_REQUEST['disctotval1'];
    $disamtt12=$_REQUEST['discamtt'];
    $grt12=$_REQUEST['grtcost'];
    $mode=$_REQUEST['mode'];
    $bp11=$_REQUEST['balp'];
   
    $insertion['fi_invoice_no'] = $inv;
    $insertion['fi_function_id'] = $functionid;
    $insertion['fi_total_extra_cost'] = $exttotcost;
    $insertion['fi_total_cost'] =$totalcost;
    $insertion['fi_total_discount'] =$disctotvalcost;
    $insertion['fi_total_final_rate'] =$grt12;
    $insertion['fi_discount_amount'] =$disamtt12;
    $insertion['fi_paid_by_mode'] =$mode;
    $insertion['fi_balance_amt'] =$bp11;
      
    $insertid = $database->insert('tbl_function_invoice', $insertion);
    
     $stss=$_REQUEST['sts'];
     $insertion23['fd_status'] = $stss;
     $querylang=$database->mysqlQuery("update tbl_function_details set fd_status='".$stss."' where fd_id='".$functionid."'");
    
    
    
        //second table//
    
       $cs1=$_REQUEST['cosspc']; 
       $cs2=  explode(',', $cs1);
       $r1=$_REQUEST['rofid'];
       $r2=explode(',', $r1);
       $i2=$_REQUEST['idf6'];
       $i3=  explode(",", $i2);
       
       
     for($i=0;$i<count($cs2);$i++){
         
         $insert['fi_invoice_no'] = $inv;
             
         $insert['fi_extra_cost'] =$cs2[$i];
         $insert['fi_extra_rate'] =$r2[$i];
         $insert['fi_extra_id'] =$i3[$i];
         $insertnid= $database->insert('tbl_function_invoice_extras', $insert);
         
     }
     
       
    $sql_cat_s =  $database->mysqlQuery("SET @tempid = " . "'" .$inv. "'");
   
    $message = '';
    $sq = $database->mysqlQuery("CALL proc_function_invoice(@tempid,@message)");
    $rs = $database->mysqlQuery("SELECT @message AS message");
    while($row = mysqli_fetch_array($rs))
    {
        $s= $row['message'];
        echo $s.',';
    }
    }





         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         $sql_gen =  mysqli_query($localhost,"select * from tbl_branchmaster"); 
         
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_invoice6  = mysqli_fetch_array($sql_gen)) 
					{
                                       $brname=$result_invoice6['be_branchname'];
                                       $address=$result_invoice6['be_address'];
                                       $nm=$result_invoice6['be_phone'];
                                       
                                        }
                                }





         $total1="";
         $date="";
         $idbq=$_REQUEST['id'];
         $time="";
         $name="";
         $type="";
         $phone ="";    
         $pax ="";   
         $menu ="";  
         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         $sql_invoice =  mysqli_query($localhost,"select *,ft_name,fv_name from   tbl_function_details tf left join tbl_function_type tft on tf.fd_function_type=tft.ft_id left join tbl_function_venue tv on tv.fv_id=tf.fd_venue where fd_id='".$idbq."'"); 
         
		  $num_invoice  = mysqli_num_rows($sql_invoice);
		  if($num_invoice)
		  {
				while($result_invoice  = mysqli_fetch_array($sql_invoice)) 
				 {
                                    
                                      $perhead=$result_invoice['fd_per_head_cost'];
                                      $phone=$result_invoice['fd_mobile_1'];	
				      $funid=$result_invoice['fd_id'];	
                                      $date=$result_invoice['fd_date'];
                                      $time=  $result_invoice['fd_time']; 
                                      $name=  $result_invoice['fd_customer'];   
                                      $type=$result_invoice['ft_name']; 
                                      $session=$result_invoice['fd_session'];
                                      $venue=$result_invoice['fv_name'];
                                      $billtype=$result_invoice['fd_billing_type'];
                                      $total1=$result_invoice['fd_total_rate'];
                                      $advgiv=$result_invoice['fd_advance_given'];
                                    
				}
		  }
                   
                  
          if(isset($_REQUEST['id1'])){
              
                                 $exid=$_REQUEST['id1'];
                                 $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
                 $sql_invoice3 =  mysqli_query($localhost,"select * from tbl_function_extra_costs where fec_id='".$exid."'");
              
        
		  $num_invoice3  = mysqli_num_rows($sql_invoice3);
		  if($num_invoice3)
		  {
				while($result_invoice3  = mysqli_fetch_array($sql_invoice3)) 
					{
                                
                                    $cost=$result_invoice3['fec_cost'];
                                    $perunit=$result_invoice3['fec_unit'];
                            }
                  }echo $cost.','.$perunit.',';
         }      


?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Banquet</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
<link rel="stylesheet" type="text/css" media="screen" href="css/bqt_print_view_page.css" />

 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
</style>

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
    min-height: 380px;
    height: 72vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
		.bnq_dtail_table th, td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table th, td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.banq_inv_right_table th{
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
.banq_gen_invoice_right_table_cc .banq_left_mn_detail_contant_bdy {
    min-height: 423px;
    height: 68.5vh;
}
.form-control{height: 35px !important;}
.form_name_cc{height: 36px !important;}
.md-content button{    margin: 8px 0;}
.del_contain_pop{
	width:130%;
	height:120%;
	background-color:rgba(0,0,0,0.6);
	position:fixed;
	top:0;
	  z-index:999999999999;
	    display:none;

	}
.delete_con_pop{
	 position:fixed;
	 height:60px;
	 width:40%;
	 background-color:#fff;
	  color:#000;
	  text-transform:none;
	 /* margin-top: -32px;*/
	  top: 50%;
	  text-align: center;
	  padding-top: 10px;
	  right:0;
	  left:0;
	  font-weight: bold;
	  font-size:15px;
	  margin:auto;
	    border-radius: 5px;
	  border: solid 1px #07bf29;
	  }
.delete_con_pop a{
	  color: #FFF;
  background-color: #C73500;
  display: inline-block;
padding: 9px 22px;
  border-radius: 7px;
}
.delete_con_pop a:hover{background-color:#F00;color:#fff}  
</style>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?> 

<!--    <input type="hidden" name="sts" id="sts"  value>-->
    <input type="hidden" name="fnid" id="fnid" value="<?=$funid?>" >
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Banquet Gnenerate Invoice</a></li>
                    <li style="float:right;"><a href="banquet_list.php" style="cursor:pointer;font-size:15px;"><i class="ti-arrow-left"></i> &nbsp; Banquet List</a></li>
            
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="main_banquet_contant_cc" style="background-color:transparent">
                     <div class="banquet_invoice_detail_cc">
                     	  <div class="banquet_invoice_detail_text">
                        	<span> Date : <strong><?=$date?></strong> </span>
                            <span> Time : <strong></strong><?=$time?> </span>
                            <span> Session : <strong></strong><?=$session?> </span>
                            <span>  Type : <strong><?=$type?></strong> </span>
                            <span> Venue : <strong></strong><?=$venue?></span>
                             <span> Customer Name : <strong></strong><?=$name?></span>
                            <span> Billing Type : <strong></strong><?=$billtype?> </span>
                            
                        </div>
                     </div>
                    		
                            <div class="banq_gen_invoice_left">
                            	<div class="banq_left_mn_detail">
                                	<div class="banq_left_mn_detail_head">
                               		 <table class="bnq_dtail_table">
                                    	<tr>
                                        	<th width="70%">Menu Name</th>
                                            <th width="10%">Qty</th>
                                            <th width="10%">Unit Rate</th>
                                              <th width="10%">Total</th>
                                        </tr>
                                    </table>
                                    </div>
                                    <div class="banq_left_mn_detail_contant_bdy"> 
                                	<table class="bnq_dtail_table">
                                       
                                            <?php
                                            $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         $sql_invoice1 =  mysqli_query($localhost,"select fdm_menu,fdm_qty,fdm_unit_rate,fdm_total_rate  from   tbl_function_details_menu"
                 . " where fdm_function_id='".$idbq."'"); 
         //echo "select * from   tbl_function_details where fd_id='".$_SESSION['bid']."'";
		  $num_invoice1  = mysqli_num_rows($sql_invoice1);
		  if($num_invoice1)
		  {
				while($result_invoice1  = mysqli_fetch_array($sql_invoice1)) 
					{
						
                                   
                                     $menu=$result_invoice1['fdm_menu']; 
                                     $qty=$result_invoice1['fdm_qty'];
                                     $unit=$result_invoice1['fdm_unit_rate'];
                                     $total=$result_invoice1['fdm_total_rate'];        
                                     ?>
                                        <tr>
                                        	<td width="70%"><?=$menu?></td>
                                            <td width="10%"><?=$qty?></td>
                                            <td width="10%"><strong><?= number_format($unit,$_SESSION['be_decimal'])?></strong></td>
                                             <td width="10%"><strong><?= number_format($total,$_SESSION['be_decimal']) ?></strong></td>
                                             </tr>
                                            <?php
					}
		  }
                                            ?>
                                       
                                         
                                    </table>
                                    </div> 
                                    
                                    <?php
                                 $ad_ok=number_format($advgiv,$_SESSION['be_decimal']);
                                 $ad_ok1=str_replace(',','',$ad_ok);
                                    
                                 
                                 $item_ok=number_format($total1,$_SESSION['be_decimal']);
                                 $item_ok1=str_replace(',','',$item_ok);
                                 
                                 
                                 $tt=$total1-$advgiv; 
                                 
                                 $bal_ok=number_format($tt,$_SESSION['be_decimal']);
                                 $bal_ok1=str_replace(',','',$bal_ok);
                                 
                                    ?>
                                    
                                    
                                    <div class="banq_left_mn_detail_contant_tbl_tax_cc">
                                        <div class="banq_left_mn_detail_tbl_tax">
                                        <span class="discount_txt_cc">
                                            <span>Discount :</span><input type="text" name="discount" id="discount" value="" onkeyup="dis_input();" autocomplete="off">&nbsp;	%
                                            <a href="#" onclick="discountadd()"><div class="discount_txt_sub_btn dis_only">Submit</div></a>
                                            <a  href="#" onclick="discount_clear()"><div style="display:none" class="discount_txt_sub_btn dis_clear">Clear</div></a>
                                        </span>
                                        Total Item Rate :<strong id="tot1" name="tot1" ><?= $item_ok1 ?></strong></div>
                                        <div class="banq_left_mn_detail_tbl_tax">Extras :<strong id="extratot">0</strong> </div>
                                        <div class="banq_left_mn_detail_tbl_tax">
                                            <span style="float: left">Advance Given : <strong id="advgiven"><?=$ad_ok1?></strong></span>
                                            Discount <strong id="distot">0</strong><span>% :</span><span id="per">0</span> 
                                        </div>
                                                  <?php ?>
                                        <div class="banq_left_mn_detail_tbl_tax">
                                            <span style="float: left">Balance To be paid : <strong ><u id="balancepay"><?=$bal_ok1?></u></strong></span>
                                            Net Amount :<strong id="grt"><?=$item_ok1?></strong>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            
                           
                        <div class="banq_gen_invoice_right">
                            	<div class="banq_generate_inv_right_head">
                                	Extras
                                	<div class="banq_generate_inv_right_head_btn_cc">
                                            <a href="#" class="md-trigger" data-modal="modal-17"><div class="banq_generate_inv_right_head_btn" onClick="clearall()">+</div></a>
                                    </div>
                                </div>
                                <div class="banq_gen_invoice_right_table_cc">
                                	<div class="banq_left_mn_detail_head">
                               		 <table class="banq_inv_right_table">
                                    	<tbody><tr>
                                        	<th width="30%">Name</th>
                                            <th width="20%">Cost</th>
                                              <th width="20%">Unit</th>
                                                <th width="20%">Rate</th>
                                            <th width="10%">Action</th>
                                            
                                        </tr>
                                    </tbody></table>
                                    </div>
                                    <div class="banq_left_mn_detail_contant_bdy"> 
                                	<table class="banq_inv_right_table">
                                        <tbody id="extradetl">
                                    </tbody></table>
                                    </div> 
                                    
                            </div>
                        </div>
                        
                        <div class="banq_gen_invoice_bottom_button_contain">
                        	<div style="width:90px;" class="banq_bottom_left_bill_details_cc">
                            	<div class="banq_bottom_left_bill_textbox_name" style="width: 83%">Credit</div>
                                <input  class="banq_chk_box" name="modecash" id="credit1"  type="checkbox" value="Credit">
                            </div>
                            <div style="width:80px;" class="banq_bottom_left_bill_details_cc">
                            	<div class="banq_bottom_left_bill_textbox_name" style="width: 83%">Cash</div>
                                <input  class="banq_chk_box" name="modecash" id="cash1"  type="checkbox" value="Cash">
                            </div>
                            <a href="#" <?php if($date!=""){?> class="subclick"<?php } ?>><div class="banq_sub_btn">SUBMIT</div></a>
<!--                            
                        </div><!--banq_gen_invoice_bottom_button_contain-->
                        
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

    <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id="decimal" >
<input type="hidden" value="<?=$funid?>" id="idofbill">
<div style="width:500px;" class="md-modal md-effect-16" id="modal-17">
    <div class="md-content" id="edit_function">
        <h3>Add Extras</h3>
        <div>
            <div class="col-lg-12 col-md-12 no-padding">
                <form >
                         
                    <input type="hidden" value="1" id="plusid">
                     <input type="hidden" value="0" id="ratehid">
                    
                    <div class="first_form_contain">
                        <div class="form_name_cc">Name<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <select class="form-control add_new_dropdown2"  id="nameextra" onChange="extra(this.value);">
                                  <option value="">Select</option>
                            <?php
                                             
                            
                            
                          $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
           $sql_invoice2 =  mysqli_query($localhost,"select * from tbl_function_extra_costs");
              
        
		  $num_invoice2  = mysqli_num_rows($sql_invoice2);
		  if($num_invoice2)
		  {
				while($result_invoice2  = mysqli_fetch_array($sql_invoice2)) 
					{
                                    $fid=$result_invoice2['fec_id'];
                                    $fname=$result_invoice2['fec_name'];
                                    
                                    ?>
                                        
                                    
                                  <option  value="<?=$fid?>"><?=$fname?></option>
                                   
                           
                            <?php
                                       
                                }
                            }
                         ?>
                            </select> 
                          </div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Cost<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="text" class="form-control kotname"  placeholder="0.00" readonly id="costextra"></div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Unit<span style="color:#F00">*</span></div>
                        <div class="form_textbox_cc"  > <div class="form-group">
                                <input type="text" class="form-control kotname"  placeholder="0.00" id="unitextra" readonly ></div>
                            </div>
                        </div><!--form_textbox_cc-->
                        </form>
                    </div><!--first_form_contain-->
                    <!--first_form_contain-->
                
            </div>
        <a href="#" id="showex"><button class="md-save">Submit</button></a>
            <a href="#"><button class="md-close" >Close</button></a>
        </div>
    
</div>

<div class="md-overlay"></div><!-- the overlay element  style="display:block;opacity: 1;"-->
</div>
 <div id="container_date"></div>
 
 
  <div  class="del_contain_pop" >
      
      <div class="delete_con_pop" style="width:300px;height:135px"><span>Invoice Generated Successfully with ID -</span> <div id="msginvoice"></div> <a href="invoice_preview.php" target="_blank" style="cursor:pointer;margin-top:26px" ck="ok" class="banq_print_view_btn_1" >Print</a> <a href="#" style="cursor:pointer;margin-top:26px;margin-left:10px" id="closepopid">Close </a></div>
</div> 
 
 
<script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/crptmd5.js"></script>
<script type="text/javascript">
	$('.datepicker').pickadate()
        $('#discount').val(0);
	$('#discount').focus();
        
        
	$(".banq_print_view_btn_1").click(function(){
//    	$(".banq_view_popup_container").css("display","block");
		$(".del_contain_pop").css("display","block");
//		$(".md-overlay").css("opacity","1");
                $('.del_contain_pop').css("display","none");
                 var gr11=$('#grt').text();
                 //$('#grtt1').text(gr11);
                 var mn=$('#msginvoice').html();
                 //$('#billnm').text(mn);
                 var idfftt=$('#fnid').val();
                 //alert(mn);
                 var bpt=$('#balancepay').html();
                 //alert(bpt);
                 var datastring1="value=inv&idinbq="+idfftt+"&gr11="+gr11+"&bpt="+bpt;
                 $.ajax({
                type: "POST",
                url: "invoice_preview.php",
                data: datastring1,
                success: function (data) {
                   //alert(data); 
                }
           
           
        });
               var datastring1="value=inv1&gr11="+gr11+"&bpt="+bpt;
               //alert(datastring1);
                 $.ajax({
                type: "POST",
                url: "banquet_list.php",
                data: datastring1,
                success: function (data) {
                   //alert(data); 
                }
           
           
        });  
                 
          $(".del_contain_pop").css("display","block");  
          window.location.href='banquet_list.php';
          
          
	});
        
	$(".close_banq_pop").click(function(){
    	$(".banq_view_popup_container").css("display","none");
		$(".md-overlay").css("display","none");
		$(".md-overlay").css("opacity","0");
	});
        
      $(".print_in_a4").click(function(){  
          var divContents = $("#popdivprint").html();
            var printWindow = window.open('', '', 'height=1000,width=1000');
            printWindow.document.write('<html><head><title></title>');
            printWindow.document.write('</head><body >');
          
             printWindow.document.write(divContents);
       
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
         
      });
      
      
       $(".print_in_th").click(function(){  
           
           var branch=$('#branchname1').text();
           var adr=$('#address1').text();
           var phn=$('#phn1').text();
           var fid=$('#idofbill').val();
           var bp=$('#balancepay').text();
         
          // alert(fid);
           var datastring="set=thermal_invoice&branch="+branch+"&adr="+adr+"&phn="+phn+"&fid="+fid+"&bp="+bp;
           $.ajax({
                type: "POST",
                url: "print_details.php",
                data: datastring,
                success: function (data) {
                   //alert(data); 
                }
           
           
        });
           window.location.href='banquet_list.php';
       });
       
      
        
        
        
        
        
      function extra(val){

    $.ajax({
        type: "POST",
        url: "banquet_invoice.php",
        data: "id1="+val,
        success: function(result)
        {
          var arr = result.split(',');
          $("#costextra").val(arr[0]);
         $("#unitextra").val(arr[1]);

         
        }
    });
 

      }
        
   
     
</script>
<script>
    
   $('#showex').click(function(){
     var id_chk=$('#nameextra').val();
      if(id_chk!=""){
    var hidid=$('#plusid').val();
    var decimal=$('#decimal').val();
  
               var tot=$('#tot1').text();
             
               var fn=$('#nameextra option:selected').text();
             var idf1=$('#nameextra').val();
             
               var cs=parseFloat($('#costextra').val());
               var un=$('#unitextra').val();
               var ds_per= $('#per').text();
               
               var tot_all=tot-ds_per;
                     
                var rt=(cs*tot_all)/100;
                
                
               if(un=='P')
               {
                   un='%';
               }else
               
               if(un=='%'){
               rt=rt;
               }else
           {
             rt=cs;
           }
            var ext =$('#ratehid').val();
           
      if(cs>0){
          var cs1=cs.toFixed(decimal);
          var rt1=rt.toFixed(decimal);
       
               $("#extradetl").append('<tr class="extratotal" id="deleteall' + hidid +'">'+
                   '<td width="30%">'+fn+'</td>'+
                   '<td id="costone" width="20%">'+cs1+'</td>'+
                   '<td width="20%">'+un+'</td>'+
                   '<td width="20%" id="hai">'+rt1+'</td>'+
                   '<td width="10%">'+ '<a href="#" onclick="del23('+rt1+','+hidid+');">'+'<img src="img/black_cross.png" width="25px" height="25px">'+'</a>'+'</td>'+
                   '<input type="hidden" id="idof" value="'+idf1+'" >'+
                  '</tr>');
            
      }
      var rtall= parseFloat(ext)+parseFloat(rt);
        $("#ratehid").val(rtall);
    var test = parseInt(hidid)+1;
   $("#plusid").val(test);
   
   var rhd=parseFloat($("#ratehid").val());
  
  
   $('#extratot').text(rhd.toFixed(decimal));
    var tot123=$('#tot1').text();
    var extrat=$('#extratot').text();
    var ds23=$('#distot').text();
     var bp= $('#advgiven').text();
    
      if(ds23=="" || ds23==0){
       var grtot=parseFloat(tot123)+parseFloat(extrat);
        $('#grt').text(grtot.toFixed(decimal));
        var bp1=grtot-bp;
        var bp2=bp1.toFixed(decimal);
        
        $('#balancepay').text(bp2);
        
   }else
   {
      var grtot=parseFloat(tot123)+parseFloat(extrat);
      var netds=grtot-(parseFloat(tot123)*parseFloat(ds23))/100;
     $('#grt').text(netds.toFixed(decimal));
     var bp1=netds-bp;
      var bp2=bp1.toFixed(decimal);
        $('#balancepay').text(bp2);
      
   }
      
    var per124=(ds23*parseFloat(tot123))/100;
    $('#per').text(per124.toFixed(decimal));
    
   
   
    $("#modal-17").removeClass('md-show');

 

if( $('#per').text()>0){
       $('#discount').prop('readonly',true);
        $('.dis_only').hide();
        $('.dis_clear').hide();
         $('#discount').hide();
   }
   
   }else{
   
   alert('Select Extras');
   }
    });
  
  
  
  
  
  function clearall(){
     $('#unitextra').val("");
   $('#costextra').val("");
   $('#nameextra').val("");  
  }
  
  
  
  
  function del23(count,id)
  { 
       var decimal=$('#decimal').val();
      var gt=$('#grt').text();
      var rate =$("#ratehid").val()
      var extt=$('#extratot').text();
      var rtt=$('#hai').text();
      var min=parseFloat(rate)-parseFloat(count);
    
      var totdel=$('#tot1').text();
      
      var min1=parseFloat(gt)-parseFloat(count);
      var check = confirm("Are you sure you want to Delete record?");
      if(check==true)
      {
          $("#deleteall" + id).remove();
           $('#extratot').text(min.toFixed(decimal));
          $('#grt').text(min1.toFixed(3));
      }
      $("#ratehid").val(min);
      
      var tot123=$('#tot1').text();
    var extrat=$('#extratot').text();
    var ds23=$('#distot').text();
     var bp= $('#advgiven').text();
    
      if(ds23==""){
       var grtot=parseFloat(tot123)+parseFloat(extrat);
        $('#grt').text(grtot.toFixed(decimal));
        var bp1=parseFloat(grtot)-parseFloat(bp);
        $('#balancepay').text(bp1.toFixed(decimal));
   }else
   {
      var grtot=parseFloat(tot123)+parseFloat(extrat);
      var netds=grtot-(parseFloat(tot123)*parseFloat(ds23))/100;
     $('#grt').text(netds.toFixed(decimal));
     
      var bp1=parseFloat(netds)-parseFloat(bp);
        $('#balancepay').text(bp1.toFixed(decimal));
      
   }
     var per124=(ds23*parseFloat(tot123))/100;
    $('#per').text(per124); 
      
      
       if($('#extratot').text()==0){
           $('#costextra').val(0);
           $('.dis_only').show();
            $('.dis_clear').hide();
             $('#discount').show();
           $('#discount').prop('readonly',false);
      }
      
  }
    
    
    
    
    function dis_input(){
        var max=100;
         var ds=$('#discount').val();
         var pr= $('#per').text();
         if(pr>0){
             $('#discount').val(''); 
             $('.dis_clear').show();
              $('.dis_only').hide();
              
             alert('Please Clear Added Discount First ');  
         }
         
         
         if(ds>=max){
            $('#discount').val(''); 
             alert('Invalid Discount Percentage');
         }
    }
    
    
    
    
    
      
    function discountadd(){
       var ds_permision= parseFloat($('#extratot').text());
    if(ds_permision==0){
         var decimal=$('#decimal').val();
       var ds=$('#discount').val();
       var tot1231=$('#tot1').text();
      var extrat1=$('#extratot').text();
      var grtot1=parseFloat(tot1231);
       $('#distot').text(ds);
          var totds=$('#grt').text();

       var per1=(ds*grtot1)/100;
        $('#per').text(per1.toFixed(decimal));
        
        var bp= $('#advgiven').text();
  
     
               var tot=$('#tot1').text();
             var cs=$('#costextra').val();
               var un=$('#unitextra').val();
               var ds_per= $('#per').text();
               var tot_all=tot-ds_per;
                var rt= (cs*tot_all)/100;
             
                if(un=='P')
               {
                   un='%';
               }else
               
               if(un=='%'){
               rt=rt;
               }else
           {
             rt=cs;  
           }
          if(rt!=""){
       
       //  $('#extratot').text(rt);
    }else{
        rt=0;
     $('#extratot').text(0);
    }
   
     if(ds>0){
       $('.dis_clear').show();
        $('.dis_only').hide();
         $('#discount').hide();
       
   }
        var ds24=$('#distot').text();
      if(ds24=="" || ds==0){
       var grtot1=parseFloat(tot1231)+parseFloat(extrat1);
        $('#grt').text(grtot1.toFixed(decimal));
        var bp1= parseFloat(grtot1)-parseFloat(bp);
        
        $('#balancepay').text(bp1.toFixed(decimal)); 
        
   }else
   {
      var grtot=parseFloat(tot1231)+parseFloat(extrat1);
      var netds1=grtot-(parseFloat(tot1231)*parseFloat(ds24))/100;
    
     $('#grt').text(netds1.toFixed(decimal));
      var bp1=parseFloat(netds1)-parseFloat(bp);
        $('#balancepay').text(bp1.toFixed(decimal)); 
   }
       $('#discount').val("");
       
    }else{
      alert('Remove Extras to apply discount !');  
    }
    }
    
   
   
   function discount_clear(){
        var decimal=$('#decimal').val();
        $('.dis_clear').hide();
        $('.dis_only').show(); 
        $('#per').text(0);
        $('#distot').text(0);
         $('#discount').show();
        
       var tot1231=$('#tot1').text();
      var extrat1=$('#extratot').text();
         var bp= $('#advgiven').text();
         
        var grtot1=parseFloat(tot1231)+parseFloat(extrat1);
         $('#grt').text(grtot1.toFixed(decimal));
         
        var  cl_ad=parseFloat(grtot1)-parseFloat(bp);
         $('#balancepay').text(cl_ad.toFixed(decimal)); 
   }
   
   
   
   
   
  $('.subclick').click(function(){
        var decimal=$('#decimal').val();
       var arr= new Array();
     $('.extratotal').each(function(){
       var costofall=$(this).find('#costone').html();  
       arr.push(costofall);
    });   
    var costofid=arr.join(",");
     
     
     var arr1= new Array();
     $('.extratotal').each(function(){
       var rateofall=$(this).find('#hai').html();  
       arr1.push(rateofall);
    });   
    var rtid=arr1.join(",");
    
    var arr2= new Array();
     $('.extratotal').each(function(){
       var idf4=$(this).find('#idof').val();  
       arr2.push(idf4);
    });   
    var idf3=arr2.join(",");
   
  var status="Invoiced";
  
    
       var fnid=$('#fnid').val();
       var totalall=$('#tot1').text();
       var extotalcost=$('#extratot').text();
       var disctotval=$('#distot').text();
       var grtotalcost=$('#grt').text();
       var balpay1=$('#balancepay').text();
       //alert(balpay1);
         var mode = [];
            $.each($("input[name='modecash']:checked"), function(){            
                mode.push($(this).val());
            });
       //alert(mode);
    //alert(credit);
       var disamt=$('#per').text();
       if(mode!=""){
      var datastring ="set=suball&funid="+fnid+"&totalvalue="+totalall+"&extotalcst="+extotalcost+"&disctotval1="+disctotval+"&grtcost="+grtotalcost+"&discamtt="+disamt+"&cosspc="+costofid+"&rofid="+rtid+"&idf6="+idf3+"&mode="+mode+"&sts="+status+"&balp="+balpay1;
            $.ajax({
                type: "POST",
                url: "banquet_invoice.php",
                data: datastring,
                success: function (data) {
                    //alert(data);
                    var arr = data.split(",");
                 if(arr[0]!='')
                 {
                   
                     $("#msginvoice").html(arr[0]);
                 }
                }
            });
        }
       if(mode==""){
           alert('Select payment mode');
            $('.del_contain_pop').css("display","none");
        }else{
        $('.del_contain_pop').css("display","block");
    }
   });
   
$('#closepopid').click(function(){
    window.location.href='banquet_list.php';
});

   


        $(document).ready(function(){
            $('#cash1').click(function() {
            var checkedBox = $(this).attr("checked");
                if (checkedBox === true) {
                    $("#credit1").attr('checked', false);
                } else {
                    $("#credit1").removeAttr('checked');                    
                }
            });
        });

        $(document).ready(function(){
            $('#credit1').click(function() {
            var checkedBox = $(this).attr("checked");
                if (checkedBox === true) {
                    $("#cash1").attr('checked', false);                     
                } else {
                    $("#cash1").removeAttr('checked');                       
                }
            });
        });
   
    
    </script>
    
</body>
</html>