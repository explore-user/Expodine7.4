<?php
// include('includes/session.php');		
session_start();
include("../database.class.php"); 
$database	= new Database();

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Ledger</title>
<meta name="description" content="">
<link href="../images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="../img/favicon.ico">
<link rel="stylesheet" href="../master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="../css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="../master_style/website.css" type="text/css">
<link rel="stylesheet" href="../master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="../css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="../master_style/demo.css">	
<link rel="stylesheet" href="../master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="../master_style/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/component.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/component.css" />
 <link href="../master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="../css/als_demo.css" />
 <script src="../js/jquery-1.10.2.min.js"></script>
<script src="../master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
        .table_active{
	background-color:rgb(255, 229, 199) !important;
	}
</style>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:63vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">


</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu_account.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="../index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">LEDGERS</a></li>
                      <?php if(isset($_REQUEST['msg'])){ ?>
                        <div class="load_error alertsmasters"><?=$alert?></div>
                        <script >
                       $(".load_error").delay(2000).fadeOut('slow');
                        </script>
                        <?php } ?>
				</ul>
            </div><!-- breadcrumbs -->


            
                
            

                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <h3 class="ledger_head">LEDGERS</h3>
                                 
                                <div class="acc_add_box" style="width:20%;">
                                    .
                             	   <input placeholder="ACCOUNT NAME" type="text" id="account_name" class="form-control filte_new_box" onkeyup="return check_account();" > 
<!--                                    <input type="text" class="form-control filte_new_box" id="group"  placeholder="">-->
                                   <select style="display:none" id="account_name" class="form-control filte_new_box" onchange="return check_account();" >
                                        <option value="">Select Account </option>
                <?php                                      
                   $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_ledger_name from tbl_ledger_master left join tbl_ledger_group on tlg_id=tlm_group "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlm_id']?>"><?=$result_login['tlm_ledger_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                 
                              
                                <div class="acc_add_box" style="width:20%;">
                             	   .
                                   
                                   <input placeholder="GROUP NAME" type="text" id="ledger_group" class="form-control filte_new_box" onkeyup="return check_account();" >
                                   
                                   
                                   <select style="display:none" id="ledger_group" class="form-control filte_new_box" onchange="return check_account();">
                                        <option value="">Select Group </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select tlg_id,tlg_name from tbl_ledger_group where tlg_status='Y' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlg_id']?>"><?=$result_login['tlg_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                  
                                  
                                  
                                    
                                </div>
                                
                                <div class="acc_add_box" style="width:20%;">
                                   .
                                   <select  id="ledger_acc_type" class="form-control filte_new_box" onchange="return check_account();">
                                        <option value="">Select Type </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select distinct(tlm_type) as typ from tbl_ledger_master "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['typ']?>"><?=$result_login['typ'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>

                                    
                                </div>

                        
                                
                                
                                <div style="margin-left:2%;width:12%;" class="search_btn_member_invoice filte_new_box_btn">
                                 
                                    <a href="journals.php" id="add_btn"  style="margin-top:18px;cursor: pointer;" >REFRESH</a>
                                    
                                     </div>
                                     
                                     <input type="hidden" value="<?php echo date('Y-m-d'); ?>" id="today">
                               <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

                            </div>  

<div class="ledger_list_sec">
    <div class="ledger_list_scr">
        <table class="table_report acc_table_scroll" >
            <thead>
                <tr>
                   <td style="width:10%">SL</td>
                   <td style="width:30%">Accounts</td>
                   <td style="width:18%">Groups </td>
                   <td style="width:18%">Ledgers</td>                                                                                             
                </tr>
            </thead>
        <tbody id="load_journal">                                       
          <?php                           
          $i=0;
          $sql_login = $database->mysqlQuery("select tlm_id,tlm_ledger_name,tlg_name,tlm_group,tlm_vendor_id,tlm_staff_id,tlm_type 
                                              from tbl_ledger_master tm 
                                              left join tbl_ledger_group tg on tg.tlg_id=tm.tlm_group 
                                              where tm.tlm_id!='' order by tm.tlm_ledger_name asc  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{ $i++;?>   
                                        <tr>
                                            <td style="width:10%;text-transform: uppercase"><?=$i?></td>
                                            <td style="width:30%;text-transform: uppercase"><?=$result_login['tlm_ledger_name']?></td>
                                            <td style="width:18%;text-transform: uppercase"><?=$result_login['tlg_name']?></td>
                                            <td style="width:18%;text-transform: uppercase;cursor: pointer"><a style="width:auto;padding:5px; background-color: #a91400; color: #ffffff;" 
                                            onclick="return goto_detail('<?=$result_login['tlm_ledger_name']?>','<?=$result_login['tlm_id']?>',
                                            '<?=$result_login['tlm_group']?>','<?=$result_login['tlm_vendor_id']?>','<?=$result_login['tlm_staff_id']?>',
                                            '<?=$result_login['tlm_type']?>');">LEDGERS</a></td>
                                        </tr>                               
                                        <?php
                                        } } ?>

                                     </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                                         
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->


               
            <div class="md-overlay"></div><!-- the overlay element -->   


                 

<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>

<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>


<script type="text/javascript">
    //calender//
$(document).ready(function () 
{                           
  check_account();      
             
  $("#datepickerfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
     changeYear: true,
	  maxDate: "+0D "
    });    

    var today = $("#today").val();
    $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+today,
                success: function(msg1)
                {
                                     
           $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+today,
                success: function(msg)
                {
                                   
                }
                });    
            }
              });

      });        
        

    
    function check_account()
    {
       var acc=$('#account_name').val();
       var grp=$('#ledger_group').val();
       var type=$('#ledger_acc_type').val();
       
       var datastringnewcard="set=list_journal&acc="+acc+"&grp="+grp+"&typ="+type;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {              
         $('#load_journal').html(data);
        }  
       });        
    }
    
    
    function goto_detail(n,a,g,v,s,t){
        
      window.location.href='journals-details.php?acc_name='+n+'&acc='+a+'&grp='+g+"&vendor="+v+"&staff="+s+"&acc_type="+t;  
        
    }
   
 </script>   
    

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
