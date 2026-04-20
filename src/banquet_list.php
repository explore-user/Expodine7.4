<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=23;
//session_start();
//   $grt11="";
//    $bpt="";
//if(isset($_REQUEST['value'])&&($_REQUEST['value']=="inv1")){
// //$idin1=$_REQUEST['idinbq'];
//    //$_SESSION['idofbq']=$_REQUEST['idinbq'];
//     
//    
//   $grt11=$_REQUEST['gr11'];
//     $bpt=$_REQUEST['bpt'];
// 
// echo $grt11;
// }

if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['value']))
{
    $arr = array();
    $sid = $_REQUEST['value'];
    $u_id = 'temp_' . rand(5, 999999);
    $temp_query = $database->mysqlQuery("INSERT INTO `tbl_function_details`
(`fd_id`, `fd_reg_type`, `fd_date`, `fd_time`, `fd_session`, `fd_function_type`, `fd_venue`, `fd_billing_type`, `fd_no_of_pax`, `fd_per_head_cost`, `fd_customer`,
 `fd_email`, `fd_mobile_1`, `fd_mobile_2`, `fd_landline`, `fd_contact_person`, `fd_address`, `fd_remarks`, `fd_total_rate`)
 select '$u_id', `fd_reg_type`, `fd_date`, `fd_time`, `fd_session`, `fd_function_type`, `fd_venue`, `fd_billing_type`, `fd_no_of_pax`, `fd_per_head_cost`, `fd_customer`,
 `fd_email`, `fd_mobile_1`, `fd_mobile_2`, `fd_landline`, `fd_contact_person`, `fd_address`, `fd_remarks`, `fd_total_rate`
 from tbl_function_details
 where `fd_id`='$sid'");

  $temp1_query = $database->mysqlQuery("INSERT INTO `tbl_function_details_menu`
(`fdm_function_id`, `fdm_slno`, `fdm_menu`, `fdm_qty`, `fdm_unit_rate`, `fdm_total_rate`)
 select '$u_id',`fdm_slno`, `fdm_menu`, `fdm_qty`, `fdm_unit_rate`, `fdm_total_rate` from tbl_function_details_menu
 where `fdm_function_id`='$sid'");

    $menuqry = $database->mysqlQuery("select * from tbl_function_details_menu WHERE fdm_function_id = '".$sid."'");
    $num_menu = $database->mysqlNumRows($menuqry);

    if($num_menu)
    {
        while ($menulisting = $database->mysqlFetchArray($menuqry))
        {
              $arr[] =  $menulisting;
        }
    }
    $data =  json_encode($arr);

    $edit_query = $database->mysqlQuery("select * from tbl_function_details WHERE fd_id = '".$sid."'");
    $num_editfntc = $database->mysqlNumRows($edit_query);
     if($num_editfntc)
     {
         while ($banquet_listing = $database->mysqlFetchArray($edit_query))
         {
             $id = $banquet_listing['fd_id'];
             $type = $banquet_listing['fd_reg_type'];
             $date = $banquet_listing['fd_date'];
             $timestam = $banquet_listing['fd_time'];
             $tim = date('H:i', strtotime($timestam));
             $session = $banquet_listing['fd_session'];
             $fn_type = $banquet_listing['fd_function_type'];
             $venue = $banquet_listing['fd_venue'];
             $billing_type = $banquet_listing['fd_billing_type'];
             $paxes = $banquet_listing['fd_no_of_pax'];
             $head = $banquet_listing['fd_per_head_cost'];
             $customer = $banquet_listing['fd_customer'];
             $email = $banquet_listing['fd_email'];
             $mobile1 = $banquet_listing['fd_mobile_1'];
             $mobile2 = $banquet_listing['fd_mobile_2'];
             $landiline = $banquet_listing['fd_landline'];
             $contact_person = $banquet_listing['fd_contact_person'];
             $advance = $banquet_listing['fd_advance_given'];
             $address = $banquet_listing['fd_address'];
             $remarks = $banquet_listing['fd_remarks'];
             $totrate = $banquet_listing['fd_total_rate'];
             echo $type . "+" . date($date) . "+" . $tim . "+" . urlencode($session) . "+" . $fn_type . "+" . $venue . "+" . $billing_type . "+" . $paxes . "+" . $head . "+" . $customer . "+" . $email . "+" . $mobile1 . "+" . $mobile2 . "+" . $landiline . "+" . $contact_person . "+" . $address . "+" . $remarks . "+" . $u_id . "+".$data."+".$sid.'+'.$totrate.'+'.$advance.'+';
         }
     }
}
if(isset($_REQUEST['id']))
{
    $er = $_GET['id'];
    $delete_tbl_fn = $database->mysqlQuery("DELETE FROM tbl_function_details WHERE fd_id='".$er."'");
    $delete_tbl_fn_mn = $database->mysqlQuery("DELETE FROM tbl_function_details_menu WHERE fdm_function_id='".$er."'");
    header('Location: banquet_list.php');
   /* $ff = $database->mysqlQuery("DELETE FROM tbl_kotcountermaster WHERE kr_kotcode = '" .$_REQUEST['id']."'");*/
}
if(isset($_REQUEST['tempdeleteid']))
{
    $delete_tbl_fn = $database->mysqlQuery("DELETE FROM tbl_function_details WHERE fd_id='".$_REQUEST['tempdeleteid']."'");
    $delete_tbl_fn_mn = $database->mysqlQuery("DELETE FROM tbl_function_details_menu WHERE fdm_function_id='".$_REQUEST['tempdeleteid']."'");
}

if((isset($_REQUEST['type']) && $_REQUEST['type']=='delete') && isset($_REQUEST['slno']))
{
    $fdm_function_id= mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['id']));
    $fdm_slno= mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['slno']));

    $sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_function_details_menu where fdm_function_id='".$fdm_function_id."' and fdm_slno ='".$fdm_slno."'");
    echo 'ok';
}
if(isset($_REQUEST['fdm_menu']))
{
    $row2 = array();
    $result = array();
    $insertion['fdm_function_id'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['id']));
    $insertion['fdm_menu'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fdm_menu']));
    $insertion['fdm_qty'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fdm_qty']));
    $insertion['fdm_unit_rate'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fdm_unit_rate']));
    $insertion['fdm_total_rate'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fdm_total_rate']));
    $sql = $database->check_duplicate_entry('tbl_function_details_menu', $insertion);
    if ($sql != 1)
    {
        $insertid = $database->insert('tbl_function_details_menu', $insertion);
        $fnct_menu = $database->mysqlQuery("select * from tbl_function_details_menu where fdm_function_id='" . trim($_REQUEST['id']) ."'");
        $fnct_menu = $database->mysqlQuery("select * from tbl_function_details_menu where fdm_function_id='" . trim($_REQUEST['id']) ."'");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0)
        {
            while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
            {
                $row2[]=$result_fnctvenue;
            }
        }
    }
    $fnct_rate = $database->mysqlQuery("select sum(fdm_total_rate) as rate from tbl_function_details_menu where fdm_function_id='" . trim($_REQUEST['id']) ."'");
    $num_rate = $database->mysqlNumRows($fnct_rate);
    if ($num_rate > 0) {
        while ($result_data= $database->mysqlFetchArray($fnct_rate))
        {
            $rate = $result_data['rate'];
        }
    }
    echo json_encode($row2).'+'.$rate.'+';
}


if(!empty($_POST["searchterm"]))
{
    $fnct_type =  $database->mysqlQuery("SELECT * FROM tbl_menumaster WHERE mr_menuname like '" . $_POST["searchterm"] . "%' ORDER BY mr_menuname");
    $num_fnctntype  = $database->mysqlNumRows($fnct_type);
    if($num_fnctntype)
    {
        ?>
        <div id="name-list">

            <?php
            while ($result_fncttype = $database->mysqlFetchArray($fnct_type))
            {
                ?>
                <div onMouseOut="normal(this);" onMouseOver="hover(this);"  onClick="selectname('<?php echo $result_fncttype["mr_menuname"]; ?>');" id="search_<?php echo $result_fncttype["mr_menuname"]; ?>"><p><?php echo $result_fncttype["mr_menuname"]; ?></p></div>
                <?php
            }
            ?>
        </div>,
        <?php
    }
}

if(isset($_REQUEST['type'])&& ($_REQUEST['type']==='edit'))
{
    if($_REQUEST['fd_billing_type'] == 'Per Head')
    {
        $totalrate = $_REQUEST['fd_no_of_pax']*$_REQUEST['fd_per_head_cost'];
    }
    else if($_REQUEST['fd_billing_type'] =='Per Dish'){
        $fnct_rate = $database->mysqlQuery("select sum(fdm_total_rate) as rate from tbl_function_details_menu where fdm_function_id='" . trim($_REQUEST['tempid']) . "'");
        $num_rate = $database->mysqlNumRows($fnct_rate);
        if ($num_rate > 0) {
            while ($result_data = $database->mysqlFetchArray($fnct_rate)) {
                $totalrate = $result_data['rate'];
            }
        }
    }
    $update_ftn = $database->mysqlQuery("update tbl_function_details set fd_reg_type='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_reg_type']))."',fd_date='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_date']))."',
    fd_time='". mysqli_real_escape_string($database->DatabaseLink, trim(date('H:i', strtotime($_REQUEST['fd_time']))))."',fd_session='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_session']))."',fd_function_type='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_function_type']))."',
    fd_venue='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_venue']))."',fd_billing_type	='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_billing_type']))."',
    fd_no_of_pax='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_no_of_pax']))."',fd_per_head_cost='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_per_head_cost']))."',
    fd_customer='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_customer']))."',fd_email='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_email']))."',
    fd_mobile_1='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_mobile_1']))."',fd_mobile_2='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_mobile_2']))."',
    fd_landline='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_landline']))."',fd_contact_person='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_contact_person']))."',
    fd_address='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_address']))."',
    fd_advance_given='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['advance']))."',
    fd_remarks='".mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_remarks']))."',
    fd_total_rate='".mysqli_real_escape_string($database->DatabaseLink,trim($totalrate))."' where fd_id='".trim($_REQUEST['tempid'])."'");

    $oldid = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['updateid']));
    $newid = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['tempid']));
    $delete_tbl_fn = $database->mysqlQuery("DELETE  FROM tbl_function_details WHERE fd_id='".$oldid."'");
    $delete_tbl_fn_mn = $database->mysqlQuery("DELETE  FROM tbl_function_details_menu WHERE fdm_function_id='".$oldid."'");
    $update_ftn = $database->mysqlQuery("UPDATE tbl_function_details SET  fd_id = '".$oldid."' WHERE fd_id='".$newid."'");
    $update_ftnn = $database->mysqlQuery("UPDATE tbl_function_details_menu SET  fdm_function_id = '".$oldid."' WHERE fdm_function_id='".$newid."'");
    $message = 'edited successfully'.',';
}
if(isset($_REQUEST['tempid'])&&($_REQUEST['type']==='checkperdish'))
{
    $sql_cat_s  =  $database->mysqlQuery("SELECT * from tbl_function_details_menu where fdm_function_id='".trim($_REQUEST['tempid'])."' and fdm_unit_rate='0'");
    $numperdish = $database->mysqlNumRows($sql_cat_s);
    echo $numperdish.',';
}

if(isset($_REQUEST['cancelid']))
{
    $update_ftn = $database->mysqlQuery("UPDATE tbl_function_details SET  fd_status = 'Cancelled' WHERE fd_id='".trim($_REQUEST['cancelid'])."'");
    $message = 'cancelled'.',';
    echo $message;

}

$item_per_page = 20;


$page_number ='';
if(isset($_GET["page"])){
    $page_number = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
    $page_number = 1; //if there's no page number, set it to 1
}

$results2 = $database->mysqlQuery("select a.*,b.ft_name,c.fv_name from tbl_function_details a LEFT JOIN tbl_function_type b ON a.fd_function_type=b.ft_id LEFT JOIN tbl_function_venue c ON a.fd_venue=c.fv_id where fd_id NOT LIKE '%temp_%' ORDER BY fd_id ASC");

$num_results2  = $database->mysqlNumRows($results2);
$get_total_rows =$num_results2;
$total_pages = ceil($get_total_rows/$item_per_page);
$page_position = (($page_number-1) * $item_per_page);
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
.searchlist{
	width: 96% !important;background: #f2f2f2  !important; position: absolute !important;top: 55px;z-index: 9999;padding-left: 1%;max-height:350px;overflow:auto}
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
    width: 99.9%;
        min-height: 300px;
    height: 78.5vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
	.bnq_dtail_table td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.banq_inv_right_table th{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
	.main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
	.main_banquet_form_box{margin-bottom:7px}
</style>

    <style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
        aside { width: 238px !important}
        .min-nav aside {width: 60px !important;}
        .ui-autocomplete{z-index:999999 !important;}
        .tablesorter tbody{min-height:420px;}
        .contant_table_cc{
            height: 65vh;
            min-height:460px;
        }
        .disabledview
        {
            pointer-events: none;
            opacity: 0.4;
        }
        .disablefield {
            pointer-events: none;
            opacity: 0.8;
            mouse-hover:cross;
        }

        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
.menut_add_bq_btn{margin-top:2px;}
    </style>

</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Banquet List</a></li>
            		<li style="float:right;"><a href="banquet_registration.php" style="cursor:pointer;font-size:15px;"><i class="ti-arrow-left"></i> &nbsp; Banquet Register</a></li>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="main_banquet_contant_cc">
                    
                    	<div class="main_banquet_contant_head">
                        	<span style="margin: 10px 0;">Filter by</span>
                            <form id="form_fltr" name="form_fltr" method="post" action="">

                        	<span style="width:13%">
                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name"> From</div>
                                    <div class="main_banquet_form_textbox">
                                    	<input id="datepickerfrom"  name="datepickerfrom" class="main_banquet_form_textbox_input datepicker" type="text" placeholder="DD/MM/YY" autofocuss>


                                    </div>
                                </div>
                             </span>
                             <span style="width:13%">
                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name"> To</div>
                                    <div class="main_banquet_form_textbox">
                                    	<input id="datepickerto" name="datepickerto" class="main_banquet_form_textbox_input datepicker"  type="text" placeholder="DD/MM/YY" autofocuss>
                                        
                                    </div>
                                </div>
                             </span>
                             <span style="width:13%">
                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Banquet/Preorder</div>
                                    <div class="main_banquet_form_textbox">
                                    	<select class="main_banquet_form_textbox_input" name="fltr_bnqt_pre" id="fltr_bnqt_pre">
                                        	<option value="All">All</option>
                                        	<option value="Banquet">Banquet</option>
                                            <option value="Preorder">Preorder</option>
                                        </select>

                                    </div>
                                </div>
                             </span>
                             <span style="width:13%">
                             <div class="main_banquet_form_box">
                                    <div class="main_banquet_form_name"> Function Type</div>
                                    <div class="main_banquet_form_textbox">
                                        <select class="main_banquet_form_textbox_input" id="fltr_ftype" name="fltr_ftype">

                                            <option value="Select">Select</option>
                                            <?php
                                            $ftype_query = $database->mysqlQuery("select ft_id,ft_name from tbl_function_type where ft_status = 'Active'");
                                            $fetch_ftype = $database->mysqlNumRows($ftype_query);
                                            if($fetch_ftype){
                                                while($result_fetch  = $database->mysqlFetchArray($ftype_query)){
                                                    ?>
                                                    <option value="<?=$result_fetch['ft_id']?>"><?=$result_fetch['ft_name'];?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
                             </div>
                             </span>
                             <span style="width:13%">
                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Customer Name</div>
                                    <div class="main_banquet_form_textbox">
                                    	<input name="fltr_nme" id="fltr_nme" class="main_banquet_form_textbox_input " type="text" placeholder="Name">
                                    </div>
                                </div>
                             </span>
                             <span style="width:70px;margin-top: 20px;"><div style="width:100%" class="menut_add_bq_btn" id="filtering_bnqt" name="filtering_bnqt" onClick="return filterbanquetlist();">Search</div></span>
                            </form>
                        </div>
                        	<div class="main_banquet_contant" style="padding-top:0" id="del_ff">
                            		<div id="left_table_scr_cc">
                                    <table class="responstable">  
                                        <thead>
                                         <tr>
                                         	<th >Action</th>
                                         	<th width="5%">Function ID</th>
                                             <th width="5%">Type</th>
                                             <th width="5%">Date of Function</th>
                                             <th width="8%">Customer </th>
                                             <th width="5%">Invoice No</th>
                                             <th width="5%">Time</th>
                                            <th width="25%">Phone Number</th>
                                            <th width="18%">Email </th>
                                            <th width="18%">Contact Person  </th>
                                            <th width="5%">Mobile Number </th>
                                            <th width="9%">Session</th>
                                             <th width="10%">Function Type</th>
                                             <th width="9%">Venue</th>
                                             <th width="9%">Billing Type</th>
                                            <th width="10%">No of Pax</th>
                                            <th width="10%">Per Head Cost</th>
                                             <th width="9%">Address</th>
                                            <th style="min-width:500px;">Remarks</th>
                                            <th style="min-width:500px;">Status</th>
                                            <th width="9%">Total</th>
                                            <th width="9%">Advance Given</th>
                                              </tr>
                                        </thead>
                                        <tbody id="listdata">
                                        <?php
                                        $sql_login  =  $database->mysqlQuery("select a.*,b.ft_name,c.fv_name from tbl_function_details a LEFT JOIN tbl_function_type b ON a.fd_function_type=b.ft_id LEFT JOIN tbl_function_venue c ON a.fd_venue=c.fv_id where fd_id NOT LIKE '%temp_%' and fd_status='Open' or fd_status='Invoiced' or fd_status='Cancelled' ORDER BY fd_id DESC LIMIT $page_position, $item_per_page");
                                         $num_login   = $database->mysqlNumRows($sql_login);
                                        $i=$page_position + 1;
                                        if($num_login){
                                        $i=1;
                                            while($result_login  = $database->mysqlFetchArray($sql_login))
                                            {
                                                $id = $result_login['fd_id'];
                                                $timestamp = $result_login['fd_time'];
                                                $timez = date('H:i',strtotime($timestamp));
                                                ?>
                                                <tr>
                                                <td>
                                                     <a href="#" name="print_list" id="print_list" class="md-trigger_cat edit_list" onClick="return fn_printlist('<?=$id?>');"><img src="img/printer_new.PNG"></a>
                                                    <a href="#" name="edit_list" id="edit_list" class="md-trigger_cat edit_list <?php if($result_login['fd_status']=='Invoiced' || $result_login['fd_status']=='Cancelled'){ echo "disablegenerate"; } ?>" onClick="return fn_editlist('<?=$id?>');"><img src="images/edit_page.PNG"></a>
                                                    <a href="#" id="delete_list" onClick="return cancelstatus('<?=$id?>');" name="delete_list" <?php if($result_login['fd_status']=='Invoiced' || $result_login['fd_status']=='Cancelled'){ echo "class=disablegenerate"; } ?>><img src="img/black_cross.png" width="25px" height="25px"></a>
                                                    <span <?php if($result_login['fd_status']=='Invoiced' || $result_login['fd_status']=='Cancelled'){ echo 'class="disablegenerate"'; }?>><a href="banquet_invoice.php?id=<?=$id?>"><span class="banq_view_btn">Generate</span></a></span>
                                                </td>
                                                <td><?=$result_login['fd_id']?></td>
                                                <td><?=$result_login['fd_reg_type']?></td>
                                                <td><?=date('d-m-Y',strtotime($result_login['fd_date']))?></td>
                                               <td><?=$result_login['fd_customer']?></td>
                                                    <?php
                                         $sqllogin  =  $database->mysqlQuery("select *  from tbl_function_invoice where  fi_function_id='".$id."'");
                                         $numlogin   = $database->mysqlNumRows($sqllogin);
                                                    if($numlogin){

                                                    while($resultlogin  = $database->mysqlFetchArray($sqllogin))
                                                    {
                                                    $idd = $resultlogin['fi_invoice_no'];
                                                    $idf=$resultlogin['fi_function_id'];

?>
                                                <td><u><a href="invoice_preview.php?value=inv&idinbq=<?=$idf?>&dup=(Duplicate Copy)" target="_blank"><?php echo $resultlogin['fi_invoice_no']; ?></a></u></td>
<?php

}

}
else{
?>
                                                    <td></td>

<?php

}
 ?>
                                                    <td><?=$timez?></td>
                                                    <td><?=$result_login['fd_landline']?></td>
                                                    <td><?=$result_login['fd_email']?></td>
                                                    <td><?=$result_login['fd_contact_person']?></td>
                                                    <td><?=$result_login['fd_mobile_1']?></td>
                                                    <td><?=$result_login['fd_session']?></td>
                                                    <td><?=$result_login['ft_name']?></td>
                                                    <td><?=$result_login['fv_name']?></td>
                                                    <td><?=$result_login['fd_billing_type']?></td>
                                                    <td><?=$result_login['fd_no_of_pax']?></td>
                                                    <td><?= number_format($result_login['fd_per_head_cost'],$_SESSION['be_decimal'])?></td>
                                                    <td><?=$result_login['fd_address']?></td>
                                                    <td><?=$result_login['fd_remarks']?></td>
                                                    <td><?=$result_login['fd_status']?></td>
                                                    <td><?= number_format($result_login['fd_total_rate'],$_SESSION['be_decimal'])?></td>
                                                    <td><?=number_format($result_login['fd_advance_given'],$_SESSION['be_decimal'])?></td>
                                                    </tr>

                                             </tr>
                                            <?php
                                               $i++;
                                               }
                                             } ?>
                                         </tbody>
                                      </table>
                                    </div>

                                    <div class="page-nation pull-right bqlist_pagination" id="pagination">
                                        <?php
                                        if($total_pages > 0 && $total_pages != 1 && $page_number <= $total_pages) {
                                            echo '<ul class="pagination pagination-large">';
                                            $right_links = $page_number + 2;
                                            $previous = $page_number - 2;
                                            $next = $page_number + 1;
                                            $first_link = true;

                                            if ($page_number > 1) {
                                                $previous_link = ($previous == 0) ? 1 : $previous;
                                                echo '<li><a href="banquet_list.php?page=1" data-page="' . $previous_link . '" title="Previous">&laquo;</a></li>';
                                                for ($i = ($page_number - 2); $i < $page_number; $i++) { //Create left-hand side links
                                                    if ($i > 0) {
                                                        echo '<li><a href="banquet_list.php?page='.$i.'" data-page="' . $i . '" title="Page' . $i . '">' . $i . '</a></li>';
                                                    }
                                                }
                                                $first_link = false;
                                            }

                                            if ($first_link) { //if current active page is first link
                                                echo '<li class="first active"><a href="#">' . $page_number . '</a></li>';
                                            } elseif ($page_number == $total_pages) { //if it's the last active link
                                                echo '<li class="last active"><a href="#">' . $page_number . '</a></li>';
                                            } else { //regular current link
                                                echo '<li class="active"><a href="#">' . $page_number . '</a></li>';
                                            }

                                            for ($i = $page_number + 1; $i < $right_links; $i++) { //create right-hand side links
                                                if ($i <= $total_pages) {
                                                    echo '<li><a href="banquet_list.php?page='.$i.'" data-page="' . $i . '" title="Page ' . $i . '">' . $i . '</a></li>';
                                                }
                                            }
                                            if ($page_number < $total_pages) {
                                                $next_link = ($i > $total_pages) ? $total_pages : $i;
                                                echo '<li><a href="banquet_list.php?page='.$next_link.'" data-page="' . $next_link . '" title="Next">&raquo;</a></li>'; //next link
                                                echo '<li class="last"><a href="banquet_list.php?page='.$total_pages.'" data-page="' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
                                            }
                                            echo '</ul>';
                                        }
                                            ?>

                                        <!--   <li data-page="1" class="disabled"><span>«</span></li>
                                          <li><a href="#">2</a></li>
                                           <li><a href="#">3</a></li>
                                           <li><a href="#">4</a></li>
                                           <li><a rel="next" href="#">Next</a></li>-->
                                </div>

                            </div>

                            
                        </div>
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

<div class="banquet_listting_edit_popup" id="modal_editfunction">
<div class="banq_view_popup_container_head">EDIT
    <div style="background-color:transparent;top:8px;right:10px;"  id="closebanquet" class="md-close close_staff_pop close_banq_pop"><img src="img/cancel-icon.png" width="30px"></div>
    </div>

    <form id="form_edit" name="form_edit" method="post" action="">

        <input type="hidden" id="count" name="count" value="2">
        <input type="hidden" id="ftn_count" name="ftn_count">
        <input type="hidden" id="totalrate" name="totalrate">

	<div class="banquet_list_edit_pop_contant">
    	<div class="main_banquet_contant_left_main">
    <div class="main_banquet_form_box" id="main_view" name="main_view">
        <div class="main_banquet_form_name">Type</div>
        <div class="main_banquet_form_textbox">
            <input type="hidden" name="update_id" id="update_id">
            <select class="main_banquet_form_textbox_input" name="bnpres" id="bnpres">
                <option value="Banquet">Banquet</option>
                <option value="Preorder">Preorder</option>
            </select>
        </div>
    </div>
    
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name"> Date of Function</div>
        <div class="main_banquet_form_textbox">
            <input id="datez" class="main_banquet_form_textbox_input datepicker" name="datez" type="text" placeholder="DD/MM/YY" autofocuss>
            
        </div>
    </div>
    
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Time </div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="time" name="tme" id="tme" required>
            </div>
        </div>
   </div>
   <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Session</div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="text" onKeyPress="return sessioncheck(event,this)" name="ssn" id="ssn" required>
            </div>
        </div>
    </div>
    
    
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Function Type </div>
        <div class="main_banquet_form_textbox">
            <select class="main_banquet_form_textbox_input" name="ftype" id="ftype">
               <?php
                $fnct_type =  $database->mysqlQuery("select * from tbl_function_type where ft_status='Active'");
                $num_fnctntype  = $database->mysqlNumRows($fnct_type);
                if($num_fnctntype) {
                while ($result_fncttype = $database->mysqlFetchArray($fnct_type)) {
                ?>
                <option value="<?= $result_fncttype['ft_id'] ?>"><?= $result_fncttype['ft_name'] ?></option>
                <?php
                }
                }
                ?>
            </select>
        </div>
    </div>
    
    
     <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Venue </div>
        <div class="main_banquet_form_textbox">
            <select class="main_banquet_form_textbox_input" name="vtype" id="vtype">
                <?php
                         $fnct_venue =  $database->mysqlQuery("select * from tbl_function_venue where fv_status='Active'");
                         $num_fnctvenue  = $database->mysqlNumRows($fnct_venue);
                         if($num_fnctvenue)
                         {
                         while ($result_fnctvenue = $database->mysqlFetchArray($fnct_venue))
                         {
                         ?>
                              <option value="<?= $result_fnctvenue['fv_id'] ?>"><?= $result_fnctvenue['fv_name'] ?></option>
                                <?php
                                   }
                                  }
                                 ?>

            </select>
        </div>
    </div>
        
        
        <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Billing Type</div>
        <div class="main_banquet_form_textbox">
            <select class="main_banquet_form_textbox_input disablefield" name="btype" id="btype" onChange="return billtypechange(this.value)">
                <option value="Per Head">Per Head</option>
                <option value="Per Dish">Per Dish</option>
            </select>
        </div>
    </div>
    
    <div class="main_banquet_contant_left" style="width: 49%;margin-left: 1%;">
        <div class="main_banquet_form_box" style="width:47%;margin-left:2%">
            <div class="main_banquet_form_name">No of Pax </div>
            <div class="main_banquet_form_textbox">
                <div class="group">      
                  <input class="input main_banquet_form_textbox_input" type="text" name="paxes" id="paxes" onKeyUp="return totalrateupdate();" onKeyPress="return fnpax();" required>
                </div>
            </div>
        </div>
        <div class="main_banquet_form_box" style="width:47%;margin-left:1%">
            <div class="main_banquet_form_name">Per head</div>
            <div class="main_banquet_form_textbox">
                <div class="group">      
                  <input class="input main_banquet_form_textbox_input" type="text" name="phed" id="phed" onKeyPress="return fnqty();  " required >
                </div>
            </div>
        </div>
    </div>
    
    <div class="main_banquet_form_box">
            <div class="main_banquet_form_name">Customer Name</div>
            <div class="main_banquet_form_textbox">
                <div class="group">      
                  <input class="input main_banquet_form_textbox_input" type="text" name="cs_name" id="cs_name" onKeyPress="return onlyAlphabets(event,this);" required>
                </div>
            </div>
        </div>
    
    
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Email</div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="text" name="e_mail" id="e_mail" required>
            </div>
        </div>
    </div>
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Mobile Number 1</div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="text" name="mobile_num1" id="mobile_num1" onKeyPress="return numonly();" required>
            </div>
        </div>
    </div>
    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Mobile Number 2</div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="text" name="mobile_num2" id="mobile_num2" onKeyPress="return numonly2();" required>
            </div>
        </div>
    </div>
    
       <div class="main_banquet_form_box">
                <div class="main_banquet_form_name">Landline Number</div>
                <div class="main_banquet_form_textbox">
                    <div class="group">      
                      <input class="input main_banquet_form_textbox_input" type="text" name="lanphn" id="lanphn" onKeyPress="return fnphn();" required>
                    </div>
                </div>
            </div>

    <div class="main_banquet_form_box">
        <div class="main_banquet_form_name">Contact Person</div>
        <div class="main_banquet_form_textbox">
            <div class="group">      
              <input class="input main_banquet_form_textbox_input" type="text" name="c_prsn" id="c_prsn" onKeyPress="return onlyAlphabets(event,this);" required>
            </div>
        </div>
    </div>
    
    
    

<div class="main_banquet_contant_left" style="width:99%;">
<div class="main_banquet_form_box" >
        <div class="main_banquet_form_name">Advance Given</div>
        <div class="main_banquet_form_textbox">
            <input class="main_banquet_form_textbox_input" placeholder="Advance Given" type="text" name="advgvn" id="advgvn">
        </div>
    </div>
</div>

            <div class="main_banquet_contant_left" style="width:99%;">
<div class="main_banquet_form_box" >
        <div class="main_banquet_form_name">Address</div>
        <div class="main_banquet_form_textbox">
            <input class="main_banquet_form_textbox_input" placeholder="Address" type="text" name="addr" id="addr">
        </div>
    </div>
</div>

<div class="main_banquet_contant_left" style="width:99%;">
<div class="main_banquet_form_box">
        <div  class="main_banquet_form_name">Remarks</div>
        <div style="margin-bottom:0" class="main_banquet_form_textbox">
            <textarea class="main_banquet_form_textbox_input remarks_txt" placeholder="Remarks" name="rmrk" id="rmrk"></textarea>
        </div>
    </div>
 </div>
            <!--<a href="#" onClick="return validate_banquet(<?/*=$u_id*/?>);"> <div class="next_btn_banquet">NEXT <span class="ti-arrow-right"></span></div> </a>-->
</div><!--main_banquet_contant_left_main-->
<div class="main_banquet_contant_right_main bnqt " id="bnqt_view" name="bnqt"> <!---disbled_div-->
<div class="main_banquet_contant_left testing" style="width:99%;">

    <input type="hidden" name="ftnc_id" id="ftnc_id">
    <input type="hidden" name="bltype" id="bltype">

<div class="main_banquet_form_box" style="width:40%">
        <div  style="font-size:14px;" class="main_banquet_form_name">Item Name</div>
        <div  class="main_banquet_form_textbox">
          <input class="main_banquet_form_textbox_input" placeholder="Item Name" type="text" name="mname" id="mname" onKeyUp="return menunamechange(this.value);">
          <div class="searchlist" style="width: 130%;background:#FFF;margin-top:1px;float:left;" id="suggesstions" onMouseOut="mouseoutfnctn(this);"></div>
        </div>
    </div>
 <div class="main_banquet_form_box" style="width:12%">
        <div style="font-size:14px;" class="main_banquet_form_name">Qty</div>
        <div  class="main_banquet_form_textbox">
            <input class="main_banquet_form_textbox_input" placeholder="Qty" type="text" name="qty" id="qty" onKeyPress="return fnqty();" onKeyUp="return totalratechange();">
        </div>
    </div>
    <div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">
        <div style="font-size:14px;"  class="main_banquet_form_name">Unit Rate</div>
        <div  class="main_banquet_form_textbox">
            <input class="main_banquet_form_textbox_input rate_txt" placeholder="Rate" type="text" name="rte" id="rte" onKeyPress="return fnrte();" onKeyUp="return totalratechange();">
        </div>
    </div>
    <div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">
        <div  style="font-size:14px;" class="main_banquet_form_name">Total Rate</div>
        <div  class="main_banquet_form_textbox">
            <input class="main_banquet_form_textbox_input disablefield"  placeholder="Rate" type="text" name="trte" id="trte" onKeyPress="return fnrte();">
        </div>
    </div>

<div style="margin-top:22px" class="menut_add_bq_btn plusbtn" name="btn1">+</div>
 </div>
    <div id="test">
    </div>
</div>
        <div class="col-md-12 " style="background-color:#fff" id="finalsubmit">
            <input type="hidden" id="tmp_id" name="tmp_id">
            <input type="hidden" id="fdtl_id" name="fdtl_id">
            <a href="#"><div class="banq_sub_btn" onClick="return submit_banquet();">SUBMIT</div> </a>
            <!--  <a href="#"> <div class="banq_sub_btn banq_view_btn_1">VIEW</div> </a> -->
        </div>
    </div>
    </form>
</div><!---banquet_listting_edit_popup-->
<div class="md-overlay"></div><!-- the overlay element -->
 <div id="container_date"></div>
<script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/crptmd5.js"></script>
<script type="text/javascript">
        $('.datepicker').pickadate();
    $(document).ready(function()
    {
        var  monthsArray = [];
        monthsArray[0] = 'January';
        monthsArray[1] = 'February';
        monthsArray[2] = 'March';
        monthsArray[3] = 'April';
        monthsArray[4] = 'May';
        monthsArray[5] = 'June';
        monthsArray[6] = 'July';
        monthsArray[7] = 'August';
        monthsArray[8] = 'September';
        monthsArray[9] = 'October';
        monthsArray[10] = 'November';
        monthsArray[11] = 'December';

        var date = new Date();
        var curdate = (date.getDate()+' '+(monthsArray[date.getMonth()]) + ',' +date.getFullYear());
        //$("#datepickerto").val(curdate);
        date.setDate(date.getDate() - 30);
        var nd = new Date(date);
        var prevdate = (nd.getDate()+' '+(monthsArray[nd.getMonth()]) + ',' +nd.getFullYear());
        //$("#datepickerfrom ").val(prevdate);
    });

    </script>
<script>
    function filtering_fun()
    {
       var datepickerfrom = $("#datepickerfrom").val();
       var datepickerto = $("#datepickerto").val();
       var fltr_bnqt_pre = $("#fltr_bnqt_pre").val();
       var fltr_phn = $("#fltr_phn").val();
       var fltr_nme = $("#fltr_nme").val();
       var fltr_ftype = $("#fltr_ftype").val();

       var datastring = "datefrom="+$("#datepickerfrom").val()+"&dateto"+$("#datepickerto").val()+"&bnquet_filter"+$("#fltr_bnqt_pre").val()+"&filter_phone"+$("#fltr_phn").val()+"&filter_name"+$("#fltr_nme").val()+"&filter_ftype"+$("#fltr_ftype").val();
        //alert(datastring);
        $.ajax({
            type: "POST",
            url: "filtering_banquet.php",
           // url: "banquet_list.php",
            data: datastring,
            success: function (data)
            {
//                alert("sdf");
            }
        });

        return true;
    }



</script>


<script type="text/javascript">

    $(".plusbtn").click(function()
    {
        var count = $('#count').val();
        var id = parseInt(count) - 1;
        var menu = $("#mname").val();
        var qty = $("#qty").val();
        var rate = $("#rte").val();
        var btype = $("#btype").val();
        
        if( (rate!="" && btype=='Per Dish' ) || btype=='Per Head' ){
        
        if (rate == '')
        {
            var menurate = '0.00';
        }
        else
        {
            var menurate = rate;
        }
        var totalrate = $("#trte").val();
        if (totalrate == '')
        {
            var trate = '0.00';
        }
        else
        {
            var trate = totalrate;
        }

        if(menu == '')
        {
            alert("Enter Menu Name !");
            $("#mname").focus();
            $("#qty").removeClass('disablefield');
            return false;
        }
/*
        if(qty == '')
        {
            alert("Enter Quantity !");
            $("#qty").removeClass('disablefield');
            $("#qty").focus();
            return false;
        } */

       /* var numbers12 =  /^[0-9 .]+$/;
        if(qty != '') {
            if (numbers12.test(qty) == false) {
                alert('Characters Not Allowedee !');
                $("#qty").focus();
                return false;
            }
        }*/

        if(btype === 'Per Dish')
        {
          /*  if ($("#rte").val() == '' ||$("#rte").val()=='undefined')
            {
                alert("Enter Rate !");
                $("#rte").focus();
                return false;
            }
*/
           /* var numbers = /^[0-9]+$/;
            if($("#rte").val() != '') {
                if (numbers.test(rate) == false) {
                    alert('Charecters Not Allowed !');
                    $("#rte").focus();
                    return false;
                }
            }*/
        }

        if(true)
        {
            var btype = $("#btype").val();
            var count = $("#count").val();
            var id = parseInt(count) - 1;
            var menu = $("#mname").val();
            var qty = $("#qty").val();
            var rate = $("#rte").val();

            if (rate == '')
            {
                var menurate = '0.00';
            }
            else
            {
                var menurate = rate;
            }
            var totalrate = $("#trte").val();
            if (totalrate == '')
            {
                var trate = '0.00';
            }
            else
            {
                var trate = totalrate;
            }

            var datastring = "id="+$("#tmp_id").val()+"&fdm_menu="+menu+"&fdm_qty="+qty+"&fdm_unit_rate="+menurate+"&fdm_total_rate="+trate;

            $.ajax({
                type: "POST",
                url: "banquet_registration.php",
                data: datastring,
                success: function (data)
                {
                    var arr = data.split("+");
                    var a=JSON.parse(arr[0]);
                    $("#mname").val('');
                    $("#qty").val('');
                    $("#rte").val('');
                    $("#trte").val('');
                    var rate = arr[1];
                    if(btype === 'Per Dish')
                    {
                        $('#totalrate').html(parseFloat(rate).toFixed(3));
                    }
                    $.each(a, function(i, record)
                    {
                        if($('.bnqt').find('#del_div' + record.fdm_slno).length === 0)
                        {
                            $(".bnqt").append('<div class="main_banquet_contant_left" style="width:99%;"  id="del_div' + record.fdm_slno + '" name="del_div' + record.fdm_slno + '">' +
                                '<div class="main_banquet_form_box" style="width:40%"><div  class="main_banquet_form_textbox">' +
                                '<input class="main_banquet_form_textbox_input disablefield" placeholder="Menu Name" value = "' + record.fdm_menu + '" type="text" name="mname' + record.fdm_slno + '"  id="mname' + record.fdm_slno + '">' +
                                '<div  style="width: 130%;background:#FFF;margin-top:1px;float:left;" class="searchlist" id="suggesstions' + record.fdm_slno + '">' + '</div>' + '</div>' + '</div>' +
                                '<div class="main_banquet_form_box" style="width:12%;">' +
                                '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_qty + '" placeholder="Qty" type="text" name="qty"  id="qty' + record.fdm_slno + '">' + '</div></div>' +
                                '<div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' +
                                '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input rate_txt disablefield" value = "' + record.fdm_unit_rate + '" placeholder="Rate" type="text" name="rte"  onkeyup="return totalratechange(' + record.fdm_slno + ')" id="rte' + record.fdm_slno + '">' + '</div></div><div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' + '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_total_rate + '" placeholder="Rate" type="text" name="trte" id="trte' + record.fdm_slno + '"></div></div><div style="background-color:transparent;" class="menut_add_bq_btn plusbtn" name="delete_btn" id="delete_btn' + record.fdm_slno + '" onclick="return delfn(' + record.fdm_slno + ');"><img width="27px"  src="img/cancel-icon.png"></div></div>');
                        }
                    });
                }
            });

            if($("#btype").val()==='Per Head')
            {
                $("#rte" + count).addClass('disablefield');
            }

        }

        var btype = $("#btype").val();
        /*if(btype==='Per Dish')
        {
            var datastring = "tempid="+$("#tmp_id").val()+"&type=checkperdish";

            $.ajax({
                type: "POST",
                url: "banquet_list.php",
                data: datastring,
                success: function (data)
                {
                    var arr = data.split(",");
                    if(arr[0]>0)
                    {
                        alert('Rate Not Entered for Menus');
                        return false;
                    }
                }
            });
        }*/
}else{
alert('Please Add Unit Rate');
}
    });




    function fn_editlist(id)
    {
            $('#phed').removeClass('disablefield');
            $(".rate_txt").removeClass('disablefield');
            $(".banquet_listting_edit_popup").css("display","block");
            $(".md-overlay").css("display","block");
            $(".md-overlay").css("opacity","1");

            $(".close_banq_pop").click(function(){
                window.location.href = "banquet_list.php";
              /*  $(".test1").html('');
            $(".banquet_listting_edit_popup").css("display","none");
            $(".md-overlay").css("display","none");
            $(".md-overlay").css("opacity","0");*/
            });
        $.ajax({
            type: "POST",
            url: "banquet_list.php",
            data: "value="+id,
            success: function(data)
            {
                var res = data.split("+");
                $('#update_id').val(id);
                $('.banquet_listting_edit_popup').val();
                $('#bnpres option[value="'+$.trim(res[0])+'"]').prop('selected', true);
                $('#datez').val(res[1]);
                $('#tme').val(res[2]);
                $('#ssn').val(decodeURIComponent(res[3]));
                $('#ftype option[value="'+$.trim(res[4])+'"]').prop('selected', true); //alert(res[5]);
                $('#vtype option[value="'+$.trim(res[5])+'"]').prop('selected', true); //alert(res[6]);
                $('#btype option[value="'+$.trim(res[6])+'"]').prop('selected', true);
                $('#paxes').val(res[7]);
                $('#phed').val(res[8]);
                $('#cs_name').val(res[9]);
                $('#e_mail').val(res[10]);
                $('#mobile_num1').val(res[11]);
                $('#mobile_num2').val(res[12]);
                $('#lanphn').val(res[13]);
                $('#c_prsn').val(res[14]);
                $('#addr').val(res[15]);
                $('#rmrk').val(res[16]);
                $('#tmp_id').val(res[17]);
                $('#fdtl_id').val(res[19]);
                $('#totalrate').val(res[20]);
                $("#advgvn").val(res[21]);
                if(res[6] === 'Per Dish')
                {
                    $('#phed').addClass('disablefield');
                }
                var a=JSON.parse(res[18]);
                $.each(a, function(i, record)
                {
                   $("#test").append('<div class="main_banquet_contant_left test1" style="width:99%;"  id="del_div' + record.fdm_slno + '" name="del_div' + record.fdm_slno + '">' +
                     '<div class="main_banquet_form_box" style="width:40%">'+'<div  class="main_banquet_form_textbox">' +
                     '<input class="main_banquet_form_textbox_input disablefield" placeholder="Menu Name" value = "' + record.fdm_menu + '" type="text" name="mname' + record.fdm_slno + '"  id="mname' + record.fdm_slno + '">' +
                     '<div  style="width: 130%;background:#FFF;margin-top:1px;float:left;" class="searchlist" id="suggesstions' + record.fdm_slno + '">' + '</div>' + '</div>' + '</div>' +
                     '<div class="main_banquet_form_box" style="width:12%;">' +
                     '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_qty + '" placeholder="Qty" type="text" name="qty"  id="qty' + record.fdm_slno + '">' + '</div></div>' +
                     '<div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' +
                     '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input rate_txt disablefield" value = "' + record.fdm_unit_rate + '" placeholder="Rate" type="text" name="rte"  onkeyup="return totalratechange(' + record.fdm_slno + ')" id="rte' + record.fdm_slno + '">' + '</div>'+'</div>'+'<div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' + '<div  class="main_banquet_form_textbox">'+'<input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_total_rate + '" placeholder="Rate" type="text" name="trte" id="trte' + record.fdm_slno + '">'+'</div>'+'</div>'+'<div style="background-color:transparent;" class="menut_add_bq_btn plusbtn" name="delete_btn" id="delete_btn' + record.fdm_slno + '" onclick="return delfn(' + record.fdm_slno + ');">'+'<img width="26px" src="img/cancel-icon.png">'+'</div>'+'</div>');
                });
                if(res[6] == 'Per Head')
                {
                    $(".rate_txt").addClass('disablefield');
                }
            },
            error:function(error)
            {
                alert("error !");
            }

        });
        return false;
    }
    
    function fn_printlist(id)
    {
        //alert(id);
        window.open("print_function_list.php?functionid="+id)
//        $.ajax({
//            type: "POST",
//            url: "banquet_list.php",
//            data: "value="+id,
//            
//        return true;
    }
    
    
    
    function submit_banquet() {

        if (document.form_edit.bnpres.value == 'Select') {
            alert("Select Banquet/Preorder !");
            document.form_edit.bnpres.focus();
            return false;
        }
        if (document.form_edit.datez.value == 'Select') {
            alert("Select date !");
            document.form_edit.datez.focus();
            return false;
        }

        if (document.form_edit.tme.value == '') {
            alert("Select Time");
            document.form_edit.tme.focus();
            return false;
        }

        var timRegX = /^([01]\d|2[0-3]):?([0-5]\d)$/;

        if (timRegX.test(document.form_edit.tme.value) == false) {
            alert("Time Should Be In (HH:MM) Format ! ");
            document.form_edit.tme.focus();
            return false;
        }

        if (document.form_edit.ssn.value == '') {
            alert("Enter Session");
            document.form_edit.ssn.focus();
            return false;
        }
        if(document.form_edit.ftype.value == 'Select')
        {
            alert("Select Function Type !");
            document.form_edit.ftype.focus();
            return false;
        }
        if(document.form_edit.vtype.value == 'Select')
        {
            alert("Enter Your Venue !");
            document.form_edit.vtype.focus();
            return false;
        }
        if (document.form_edit.paxes.value == '') {
            alert("Enter No Of Pax");
            document.form_edit.paxes.focus();
            return false;
        }
       /* if (document.form_edit.paxes.value != '') {
            var numbers1 = /^[0-9]+$/;
            if (numbers1.test(document.form_edit.paxes.value) == false)
            {
                alert('Characters Not Allowed !');
                document.form_edit.paxes.focus();
                return false;
            }
        }*/
        var btype = $("#btype").val();
        if (btype === 'Per Head')
        {
            if (document.form_edit.phed.value == '' || document.form_edit.phed.value == '0') {
                alert("Enter Per Head");
                document.form_edit.phed.focus();
                return false;
            }
          /*  if (document.form_edit.phed.value != '' || document.form_edit.phed.value != '0') {
                var numbers1 = /^[0-9]+$/;
                if (numbers1.test(document.form_edit.phed.value) == false) {
                    alert('Characters Not Allowed !');
                    document.form_edit.phed.focus();
                    return false;
                }
            }*/
        }
        if (document.form_edit.cs_name.value == '') {
            alert("Enter Customer Name");
            document.form_edit.cs_name.focus();
            return false;
        }

//        if (document.form_edit.e_mail.value == '') {
//            alert("Enter Your E-mail !");
//            document.form_edit.e_mail.focus();
//            return false;
//        }
//      if (document.form_edit.e_mail.value != '') {
//
//            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//
//            if (reg.test(document.form_edit.e_mail.value) == false) {
//                alert('Invalid email address! Please re-enter !');
//                document.form_edit.e_mail.focus();
//                return false;
//            }
//        }

//        if (document.form_edit.mobile_num1.value == '') {
//            alert("Enter Mobile Number!");
//            document.form_edit.mobile_num1.focus();
//            return false;
//        }

       /* if (document.form_edit.lanphn.value == '') {
            alert("Enter Land phone Number!");
            document.form_edit.lanphn.focus();
            return false;
        }*/
       /* if(document.form_edit.lanphn.value != '') {
            var numbers21 = /^[0-9 +]+$/;
            if (numbers21.test(document.form_edit.lanphn.value) == false) {
                alert('Invalid Phone Number...! Please Re-Enter !');
                document.form_edit.lanphn.focus();
                return false;
            }
        }
*/
//        if (document.form_edit.c_prsn.value == '') {
//            alert("Enter Name!");
//            document.form_edit.c_prsn.focus();
//            return false;
//        }

        var btype = $("#btype").val();
/*        if (btype === 'Per Dish') {
            var datastring = "tempid=" + $("#tmp_id").val() + "&type=checkperdish";

            $.ajax({
                type: "POST",
                url: "banquet_list.php",
                data: datastring,
                success: function (data) {
                    var arr = data.split(",");
                    if (arr[0] > 0) {
                        alert('Rate Not Entered for Menus');
                        return false;
                    }
                    else {
                        var datastring = "type=edit&tempid=" + $("#tmp_id").val() + "&updateid=" + $("#fdtl_id").val() + "&fd_reg_type=" + document.form_edit.bnpres.value + "&fd_date=" + formatDate(document.form_edit.datez.value) + "&fd_time=" + document.form_edit.tme.value + "&fd_session=" + document.form_edit.ssn.value + "&fd_function_type=" + document.form_edit.ftype.value + "&fd_venue=" + document.form_edit.vtype.value + "&fd_billing_type=" + document.form_edit.btype.value + "&fd_no_of_pax=" + document.form_edit.paxes.value + "&fd_per_head_cost=" + document.form_edit.phed.value + "&fd_customer=" + document.form_edit.cs_name.value + "&fd_email=" + document.form_edit.e_mail.value + "&fd_mobile_1=" + document.form_edit.mobile_num1.value + "&fd_mobile_2=" + document.form_edit.mobile_num2.value + "&fd_landline=" + document.form_edit.lanphn.value + "&fd_contact_person=" + document.form_edit.c_prsn.value + "&fd_address=" + document.form_edit.addr.value + "&fd_remarks=" + document.form_edit.rmrk.value;

                        $.ajax({

                            type: "POST",
                            url: "banquet_list.php",
                            data: datastring,
                            success: function (data) {
                                var arr = data.split(",");
                                window.location.reload();

                            }
                        });
                    }
                }
            });
      }*/
//   else {
            var datastring = "type=edit&tempid=" + $("#tmp_id").val() + "&updateid=" + $("#fdtl_id").val() + "&fd_reg_type=" + document.form_edit.bnpres.value + "&fd_date=" + formatDate(document.form_edit.datez.value) + "&fd_time=" + document.form_edit.tme.value + "&fd_session=" + encodeURIComponent(document.form_edit.ssn.value) + "&fd_function_type=" + document.form_edit.ftype.value + "&fd_venue=" + document.form_edit.vtype.value + "&fd_billing_type=" + document.form_edit.btype.value + "&fd_no_of_pax=" + document.form_edit.paxes.value + "&fd_per_head_cost=" + document.form_edit.phed.value + "&fd_customer=" + document.form_edit.cs_name.value + "&fd_email=" + document.form_edit.e_mail.value + "&fd_mobile_1=" + document.form_edit.mobile_num1.value + "&fd_mobile_2=" + document.form_edit.mobile_num2.value + "&fd_landline=" + document.form_edit.lanphn.value + "&fd_contact_person=" + document.form_edit.c_prsn.value + "&fd_address=" + document.form_edit.addr.value + "&fd_remarks=" + document.form_edit.rmrk.value+"&totalrate="+$('#totalrate').val()+"&advance="+$('#advgvn').val();

            $.ajax({

                type: "POST",
                url: "banquet_list.php",
                data: datastring,
                success: function (data) {
                    var arr = data.split(",");
                    window.location.reload();

                }
            });
//    }
        return true;
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }
    function onlyAlphabets(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if ((charCode ==32) ||(charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                return true;
            else
                return false;
        }
        catch (err) {
            alert(err.Description);
        }
    }

/*    function billtypechange(val)
    {
        alert('ok');
        if(val=='Per Dish')
        {
            $("#phed").val('0');
            $("#phed").addClass("disablefield");
            $(".rate_txt").removeClass("disablefield");
        }
        else
        {
            $("#phed").removeClass("disablefield");
            $(".rate_txt").addClass("disablefield");
            $(".").addClass("disablefield");
        }
    }*/


    function  fnpax(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }

    function fnhead(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }


    function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }

    function numonly2(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }

    function fnphn(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }

    function fnqty(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode>46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }


    function fnrte(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode>46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function menunamechange(name)
    {
        $.ajax({
            type: "POST",
            url: "banquet_list.php",
            data: 'searchterm=' + name,
            beforeSend: function () {
            },
            success: function (data) {
                var arr = data.split(",");
                $("#suggesstions").show();
                $("#suggesstions").html(arr[0]);
            }
        });
        return true;
    }

    function selectname(selected_value)
    {
        $("#mname").val(selected_value);
        $("#suggesstions").hide();
    }

    function delfn(count)
    {
        var check = confirm("Are you sure you want to Delete record?");
        if(check==true)
        {
            var datastring = "type=delete&id=" + $("#tmp_id").val() + "&slno=" + count;
            $.ajax({
                type: "POST",
                url: "banquet_list.php",
                data: datastring,
                success: function (data)
                {
                    $("#del_div" + count).remove();
                }
            });
        }
        return true;
    }

    function totalratechange()
    {            var qty = $("#qty").val();
        var  rate  = $("#rte").val();
        var totalrate = parseFloat(qty)*parseFloat(rate);
        if(!isNaN(totalrate))
        {
            $("#trte").val(totalrate);
        }
    }

    function totalrateupdate()
    {
        var bltype = $("#btype").val();
        if(bltype === 'Per Head')
        {
            if(document.form_edit.phed.value!='')
            {
                var phd = document.form_edit.phed.value;
            }
            else
            {
                var phd ='0.00';
            }
            if(document.form_edit.paxes.value!='')
            {
                var pax = document.form_edit.paxes.value;
            }
            else
            {
                var pax = '0.00';
            }
            var tot = parseFloat(phd) * parseFloat(pax);
            $("#totalrate").html(tot.toFixed(3));
        }
        return true;
    }

    function filterbanquetlist()
    {
        var from_date = $("#datepickerfrom").val();
        var to_date = $("#datepickerto").val();
        /*if(from_date=='')
        {
            alert("Select From Date !");
            document.form_fltr.datepickerfrom.focus();
            return false;
        }
        if(to_date=='')
        {
            alert("Select To Date !");
            document.form_fltr.datepickerto.focus();
            return false;
        }*/

        if($("#fltr_bnqt_pre").val()=='')
        {
           var banquet  ='null';
        }
        else
        {
            var banquet  = $("#fltr_bnqt_pre").val();
        }

        if($("#fltr_ftype").val()=='')
        {
           var fltype  ='null';
        }
        else
        {
            var fltype  = $("#fltr_ftype").val();
        }

        if($("#fltr_nme").val()=='')
        {
           var flname  ='null';
        }
        else
        {
            var flname  = $("#fltr_nme").val();
        }

        if(true)
        {
            var datastring = "type=filter&datefrom=" + formatDate($("#datepickerfrom").val()) + "&dateto=" +formatDate($("#datepickerto").val()) + "&banquetorder=" + banquet + "&ftype=" + fltype + "&name=" + flname;

            $.ajax({
                type: "POST",
                url: "banquet_filter.php",
                data: datastring,
                success: function (data) {
//                    alert(data);
                    var arr = data.split("+");//alert(arr[0]);
                    $("#listdata").html('');
                    $("#listdata").html(decodeURIComponent(arr[0]));
                }
            });
        }
        return true;
    }
function cancelstatus(id)
{
    var check = confirm("Are you sure you want to Cancel record?");
    if(check==true)
    {
        var datastring = "cancelid="+id;
        $.ajax({
            type: "POST",
            url: "banquet_list.php",
            data: datastring,
            success: function (data)
            {
//                    alert(data);
                    window.location.reload();
            }
        });
    }
    return true;
}

    function sessioncheck(e, t)
    {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else { return true; }
            if ((charCode ==43) ||(charCode ==44) || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                return true;
            else
                return false;
        }
        catch (err) {
            alert(err.Description);
        }
    }
	
	$("#closebanquet").click(function()
	{
		 var datastring = "tempdeleteid="+$("#tmp_id").val();
        $.ajax({
            type: "POST",
            url: "banquet_list.php",
            data: datastring,
            success: function (data)
            {
				//alert($("#tmp_id").val());
                    window.location.reload();
            }
        });
	});

</script>
</body>
</html>