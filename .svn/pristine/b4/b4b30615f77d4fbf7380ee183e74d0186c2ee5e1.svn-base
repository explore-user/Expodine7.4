<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=22 ;
$username = $_SESSION['expodine_id'];
if(isset($_REQUEST['fd_reg_type'])) {
   
    $id = 'temp_' . $username;
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_function_details where fd_id='".trim($id)."'");

    $insertion['fd_id'] = $id;
    $insertion['fd_reg_type'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_reg_type']));
    $insertion['fd_date'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_date']));
    $insertion['fd_time'] = mysqli_real_escape_string($database->DatabaseLink, trim(date('H:i', strtotime($_REQUEST['fd_time']))));
    $insertion['fd_session'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_session']));
    $insertion['fd_function_type'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_function_type']));
    $insertion['fd_venue'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_venue']));
    $insertion['fd_billing_type'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_billing_type']));
    $insertion['fd_no_of_pax'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_no_of_pax']));
    if(trim($_REQUEST['advance'])){
    $insertion['fd_advance_given'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['advance']));
    }
    if(trim($_REQUEST['fd_billing_type'])==='Per Head')
    {
        $insertion['fd_per_head_cost'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_per_head_cost']));
    }else
    {
        $insertion['fd_per_head_cost'] = '0';
    }

    $insertion['fd_customer'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_customer']));
    $insertion['fd_email'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_email']));
    $insertion['fd_mobile_1'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_mobile_1']));
    $insertion['fd_mobile_2'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_mobile_2']));
    $insertion['fd_landline'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_landline']));
    $insertion['fd_contact_person'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_contact_person']));
    $insertion['fd_address'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_address']));
    $insertion['fd_remarks'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['fd_remarks']));
    $sql = $database->check_duplicate_entry('tbl_function_details', $insertion);
    if ($sql != 1) {
        $insertid = $database->insert('tbl_function_details', $insertion);
    }
    
    
    echo $id.",";
    
}

if(isset($_REQUEST['fdm_menu'])) {
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
        if ($num_fdtl > 0) {
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

if((isset($_REQUEST['type']) && $_REQUEST['type']=='delete') && isset($_REQUEST['slno']))
{
    $fdm_function_id= mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['id']));
    $fdm_slno= mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['slno']));

    $sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_function_details_menu where fdm_function_id='".$fdm_function_id."' and fdm_slno ='".$fdm_slno."'");
    echo 'ok';
}
if((isset($_REQUEST['loadtype']) && $_REQUEST['loadtype']=='tempview'))
{
    $arr = array();
    $sid = 'temp_'.$username;
	$u_id ='temp_'.$username;
	
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
             echo $type . "+" . date($date) . "+" . $tim . "+" . urlencode($session) . "+" . $fn_type . "+" . $venue . "+" . $billing_type . "+" . $paxes . "+" . $head . "+" . $customer . "+" . $email . "+" . $mobile1 . "+" . $mobile2 . "+" . $landiline . "+" . $contact_person . "+" . $address . "+" . $remarks .  "+" . $u_id ."+".$data."+".$sid.'+'.$totrate.'+'.$advance.'+';
         }
     }
	 else{
		 $msg = 'empty';
		 echo $msg.'+';
	 }
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

if(isset($_REQUEST['tempid']))
{
    $sql_cat_s =  $database->mysqlQuery("SET @tempid = " . "'" . trim($_REQUEST['tempid']) . "'");
    $sql_cat_p =  $database->mysqlQuery("SET @totalrate = " . "'" . trim($_REQUEST['totalrate']) . "'");
    $message = '';
    $sq = $database->mysqlQuery("CALL proc_function_register(@tempid,@totalrate,@message)");
    $rs = $database->mysqlQuery("SELECT @message AS message");
    while($row = mysqli_fetch_array($rs))
    {
        $s= $row['message'];
        echo $s.',';
    }
}

if(isset($_REQUEST['tempid']) && $_REQUEST['type']=='totalrateupdate')
{
     echo $_REQUEST['tempid'];

}

if((isset($_REQUEST['type']) && $_REQUEST['type']=='deletetemp') && isset($_REQUEST['temporaryid']))
{
      $id = 'temp_' . $username;
      $sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_function_details where fd_id='".trim($id)."'");
      $sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_function_details_menu where fdm_function_id='".trim($id)."'");
      echo 'ok';
}

/*if(isset($_REQUEST['type'])=='cleartemp')
{
    $sql_cat_s  =      $delete_tbl_fn = $database->mysqlQuery("DELETE  FROM tbl_function_details WHERE fd_id LIKE '%temp_%'");
}*/
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
<link href="css/textbox_eft.css" rel="stylesheet" />
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
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />

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
.main_banquet_form_textbox{position:relative;}
.searchlist{
	width: 97% !important;
    background: rgb(255, 255, 255);
    margin-top: 1px;
    float: left;
    display: block;
    position: absolute;
    top: 41px;
    z-index: 999;
    max-height: 300px;
    overflow: auto;
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
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{display:none;}

.banq_view_popup_container .main_banquet_form_textbox{font-size:20px;height:22px;}
.banq_view_popup_container .main_banquet_form_name {font-size: 14px;color: #858585;}
.banq_view_popup_container .main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:12px;}
.banq_view_popup_container .main_banquet_contant_left_main{    border-right: 1px #ccc solid;width:48%}
.banq_view_popup_container .main_banquet_contant_left{margin-bottom:12px;}
.banq_view_popup_container .main_banquet_contant_right_main{width:51%;}
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
					<li><a style="cursor:pointer">Banquet Registration</a></li>
                    <li style="float:right;"><a href="banquet_list.php" style="cursor:pointer;font-size:15px;"><i class="ti-arrow-right"></i> &nbsp; Banquet List</a></li>

				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                    <form id="form_banquet" name="form_banquet" method="post" action="">
                <input type="hidden" id="count" name="count" value="2">
                <input type="hidden" id="ftn_count" name="ftn_count">

                	<div class="main_banquet_contant_cc">
                    	<div class="main_banquet_contant_head">Banquet Registration/Preorder -<a href="#" onclick="tempclear()">Clear</a>
                        	<div class="bqt_total_rate_cc" id="totalrate">Total Rate:</div>
        </div>
                        <div class="main_banquet_contant">

                        <div class="main_banquet_contant_left_main">
<div  id="main_view" name="main_view">
                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Type <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<select class="main_banquet_form_textbox_input" name="bnpr" id="bnpr">
                                        	<option>Select</option>
                                        	<option value="Banquet">Banquet</option>
                                            <option  value="Preorder">Preorder</option>
                                        </select>
                                    </div>
                                </div>

                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Date of Function <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<input id="input_01" class="main_banquet_form_textbox_input datepicker" name="datez" type="text" placeholder="DD/MM/YY" autofocuss>

                                    </div>
                                </div>

                                <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Time <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input" type="time" name="tme" id="tme" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
<!--                                          <label class="label">HH:MM </label>-->
                                        </div>
                                    </div>
                               </div>
                               <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Session <span style="color: red"></span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input"  onKeyPress="return sessioncheck(event,this)"  type="text" name="ssn" id="ssn" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
                                          <label class="label"></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Function Type <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">

                                                <select class="main_banquet_form_textbox_input" name="ftype" id="ftype">
                                                    <option value="Select">Select</option>
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
                                	<div class="main_banquet_form_name">Venue <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">

                                    	<select class="main_banquet_form_textbox_input" name="venue" id="venue">
                                        	<option>Select</option>
                                            <?php
                                            $fnct_venue =  $database->mysqlQuery("select * from tbl_function_venue where fv_status='Active'");
                                            $num_fnctvenue  = $database->mysqlNumRows($fnct_venue);
                                            if($num_fnctvenue) {
                                            while ($result_fnctvenue = $database->mysqlFetchArray($fnct_venue)) {
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
                                	<div class="main_banquet_form_name">Billing Type <span style="color: red">*</span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<select class="main_banquet_form_textbox_input" name="btype" id="btype" onChange="return billtypechange(this.value);">
                                        	<option value="Per Head">Per Head</option>
                                            <option value="Per Dish">Per Dish</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="main_banquet_contant_left" style="width: 49%;margin-left: 1%;">
                                    <div class="main_banquet_form_box" style="width:47%;margin-left:2%">
                                        <div class="main_banquet_form_name">No of Pax <span style="color: red">*</span></div>
                                        <div class="main_banquet_form_textbox">
                                            <div class="group">
                                              <input class="input main_banquet_form_textbox_input" type="text" name="paxs" id="paxs" onKeyUp="return totalrateupdate();" onKeyPress="return fnpax();" required>
                                              <span class="highlight"></span>
                                              <span class="bar"></span>
                                              <label class="label">No of Pax</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main_banquet_form_box" style="width:47%;margin-left:1%;" id="perhead">
                                        <div class="main_banquet_form_name">Per head <span style="color: red">*</span></div>
                                        <div class="main_banquet_form_textbox">
                                            <div class="group">
                                              <input class="input main_banquet_form_textbox_input phed_txt" type="text" name="phed"  onkeyup="return totalrateupdate();"  id="phed" onKeyPress="return fnhead();" required >
                                              <span class="highlight"></span>
                                              <span class="bar"></span>
                                              <label class="label">Per head</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="main_banquet_form_box">
                                        <div class="main_banquet_form_name">Customer Name <span style="color: red">*</span></div>
                                        <div class="main_banquet_form_textbox">
                                            <div class="group">
                                              <input class="input main_banquet_form_textbox_input" type="text" name="namez" onKeyPress="return onlyAlphabets(event,this)" id="namez" required>
                                              <span class="highlight"></span>
                                              <span class="bar"></span>
                                              <label class="label">Customer Name</label>
                                            </div>
                                        </div>
                                    </div>


                                <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Email <span style="color: red"></span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input" type="text" name="e_mail" id="e_mail" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
                                          <label class="label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Mobile Number 1 <span style="color: red"></span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input" type="text" name="nums1" id="nums1" onKeyPress="return numonly();" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
                                          <label class="label">Mobile Number 1</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Mobile Number 2</div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input" type="text" name="nums2" id="nums2" onKeyPress="return numonly();" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
                                          <label class="label">Mobile Number 2</label>
                                        </div>
                                    </div>
                                </div>
                                   <div class="main_banquet_form_box">
                                            <div class="main_banquet_form_name">Landline Number</div>
                                            <div class="main_banquet_form_textbox">
                                                <div class="group">
                                                  <input class="input main_banquet_form_textbox_input" type="text" name="phn" id="phn" onKeyPress="return fnphn();" required>
                                                  <span class="highlight"></span>
                                                  <span class="bar"></span>
                                                  <label class="label">Landline Number</label>
                                                </div>
                                            </div>
                                        </div>

                            	<div class="main_banquet_form_box">
                                	<div class="main_banquet_form_name">Contact Person <span style="color: red"></span></div>
                                    <div class="main_banquet_form_textbox">
                                    	<div class="group">
                                          <input class="input main_banquet_form_textbox_input" type="text" onKeyPress="return onlyAlphabets(event,this)" name="c_prsn" id="c_prsn" required>
                                          <span class="highlight"></span>
                                          <span class="bar"></span>
                                          <label class="label">Contact Person</label>
                                        </div>
                                    </div>
                                </div>

                            <div class="main_banquet_contant_left" style="width:99%;">
                            <div class="main_banquet_form_box" >
                                	<div class="main_banquet_form_name">Advance Given</div>
                                    <div class="main_banquet_form_textbox">
                                    	<input class="main_banquet_form_textbox_input" placeholder="Advance Given" type="text" onKeyPress="return fnhead();" name="advancegiven" id="advancegiven">
                                    </div>
                                </div>
                           	</div>

                            <div class="main_banquet_contant_left" style="width:99%;">
                            <div class="main_banquet_form_box" >
                                	<div class="main_banquet_form_name">Address <span style="color: red">*</span></div>
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
							</div>
                       </div><!--main_banquet_contant_left_main-->
                       
                       <div class="col-md-12 no-padding btn_fixed_cc_bqt">
                      <div id="nextbtn">      <a href="#" onClick="return validate_banquet();"> <div  class="next_btn_banquet ">NEXT <span class="ti-arrow-right"></span></div> </a> </div>
                       </div>
                            
                       <div class="main_banquet_contant_right_main bnqt disabledview" id="bnqt_view" name="bnqt">

                      <div class="main_banquet_contant_left " style="width:99%;">
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
                                    	<input class="main_banquet_form_textbox_input" placeholder="Qty" type="text" name="qty" id="qty" onKeyPress="return ();" onKeyUp="return totalratechange();">
                                    </div>
                                </div>
                                <div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">
                                	<div style="font-size:14px;"  class="main_banquet_form_name">Unit Rate</div>
                                    <div  class="main_banquet_form_textbox">
                                    	<input class="main_banquet_form_textbox_input rate_txt" placeholder="Rate" type="text"  name="rte" id="rte" onKeyPress="return fnrte();" onKeyUp="return totalratechange();">
                                    </div>
                                </div>
                                <div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">
                                	<div  style="font-size:14px;" class="main_banquet_form_name">Total Rate</div>
                                    <div  class="main_banquet_form_textbox">
                                    	<input class="main_banquet_form_textbox_input disablefield" placeholder="Rate" type="text" name="trte" id="trte" onKeyPress="return fnrte();">
                                    </div>
                                </div>
                          <div style="margin-top: 32px" class="menut_add_bq_btn plusbtn" name="btn1" onClick="return addmenu()">+</div>
                             </div>
    <div id="test">
    </div>
						

                            </div>
                            
                             <div class="col-md-12 btn_fixed_cc_bqt disabledview" style="right: 0;width: 42%;" id="finalsubmit">
                                <a href="#"> <div class="banq_sub_btn" onClick="return submit_banquet();">SUBMIT</div> </a>
                              <!--  <a href="#"> <div class="banq_sub_btn banq_view_btn_1">VIEW</div> </a> -->
                                </div>


                            </div>
                        </div>
                        </form>
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>


<div class="banq_view_popup_container" style="display:none">
	<div class="banq_view_popup_container_head">View
    <div style="background-color:transparent;top:8px;right:10px;" class="md-close close_staff_pop close_banq_pop"><img src="img/cancel-icon.png" width="30px"></div>
    </div>
    <div class="banq_view_section_1">
    	
        <div class="main_banquet_contant_left_main">
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name"> Date of Function</div>
              <div class="main_banquet_form_textbox">10-JUN-2017</div>
          </div> 
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name"> Name</div>
              <div class="main_banquet_form_textbox">User</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name"> Email</div>
              <div class="main_banquet_form_textbox">Email@user.com</div>
          </div> 
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Mobile Number</div>
              <div class="main_banquet_form_textbox">9876543210</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">No of Pax</div>
              <div class="main_banquet_form_textbox">1000</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Session</div>
              <div class="main_banquet_form_textbox">Lorem</div>
          </div>
           <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Time</div>
              <div class="main_banquet_form_textbox">10:00 AM</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Phone Number</div>
              <div class="main_banquet_form_textbox">&nbsp;</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Contact Person</div>
              <div class="main_banquet_form_textbox">&nbsp;</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Location</div>
              <div class="main_banquet_form_textbox">Ipsum</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Function Type</div>
              <div class="main_banquet_form_textbox">Marriege</div>
          </div>
          <div class="main_banquet_form_box">
              <div class="main_banquet_form_name">Venue</div>
              <div class="main_banquet_form_textbox">&nbsp;</div>
          </div>
           <div class="main_banquet_form_box" style="width:99%">
              <div class="main_banquet_form_name">Address</div>
              <div class="main_banquet_form_textbox">&nbsp;</div>
          </div>
          <div class="main_banquet_form_box" style="width:99%">
              <div class="main_banquet_form_name">Remarks</div>
              <div class="main_banquet_form_textbox">&nbsp;</div>
          </div>
          
              
        </div>
        
        <div class="main_banquet_contant_right_main">
                                
                          <div class="main_banquet_contant_left" style="width:99%;">
                            
                            <div class="main_banquet_form_box" style="width:62%">
                                	<div class="main_banquet_form_name">Menu Name</div>
                                    <div class="main_banquet_form_textbox">PITA BREAD KHUBZ</div>
                                </div>
                             <div class="main_banquet_form_box" style="width:15%;margin-left:1%">
                                	<div class="main_banquet_form_name">Qty</div>
                                    <div class="main_banquet_form_textbox">200</div>
                                </div>
                                <div class="main_banquet_form_box" style="width:20%;margin-left:1%">
                                	<div class="main_banquet_form_name">Rate</div>
                                    <div class="main_banquet_form_box" style="font-size:18px;"><strong>1500</strong></div> 
                                </div>
                             </div><!--main_banquet_contant_right_main-->
                             
                             <div class="main_banquet_contant_left" style="width:99%;">
                            
                            <div class="main_banquet_form_box" style="width:62%">
                                    <div class="main_banquet_form_textbox">PITA BREAD KHUBZ</div>
                                </div>
                             <div class="main_banquet_form_box" style="width:15%;margin-left:1%">
                                    <div class="main_banquet_form_textbox">200</div>
                                </div>
                                <div class="main_banquet_form_box" style="width:20%;margin-left:1%">
                                	<div class="main_banquet_form_box" style="font-size:18px;"><strong>1500</strong></div>
                                </div> 
                                </div>
                             </div><!--main_banquet_contant_right_main-->
                                     
        
    </div>
</div><!--banq_view_popup_container-->

<div class="id_show_popup" id="success" style="display: none;">
	<div class="id_show_popup_contant" id="fid">
    <span style="width:100%;float:left;margin-top:5px;">Function Generated Successfully with ID <span id="ftnid"></span></span><br/>
        <br/>
    <a href="#"><span style="border-radius:10px;margin-right: 40%;" class="ok_btn">OK</span></a>
    </div>
    <div class="id_show_popup_overlay" ></div>
</div>


<div class="md-overlay"></div><!-- the overlay element  style="display:block;opacity: 1;"-->
 <div id="container_date"></div>
 
 
 
 
<!-- jQuery lib -->
<!-- dateDropper lib -->
<script src="js/picker.js"></script>
    <script src="js/picker.date.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

    <script type="text/javascript">

       // $('.datepicker').pickadate()
		$('.datepicker').pickadate({
		  // An integer (positive/negative) sets it relative to today.
		  min: true,
		  // `true` sets it to today. `false` removes any limits.
		  max: false
		});

$(".banq_view_btn_1").click(function(){
    	$(".banq_view_popup_container").css("display","block");
		$(".md-overlay").css("display","block");
		$(".md-overlay").css("opacity","1");
	});
	$(".close_banq_pop").click(function(){
    	$(".banq_view_popup_container").css("display","none");
		$(".md-overlay").css("display","none");
		$(".md-overlay").css("opacity","0");
	});
       /* $(document).ready(function()
        {
            $.ajax({
                type: "POST",
                url: "banquet_registration.php",
                data: "type=cleartemp",
                success: function (data)
                {
//                    alert(data);
                }
            });
        });*/

    </script>

<script type="text/javascript">

    $(".ok_btn").click(function()
    {
     $("#success").css('display','none');
        window.location.href = "banquet_list.php";
    });
     $(".plusbtn").click(function()
        {
           var bltype =  $("#bltype").val();
            var count = $('#count').val();
            var id = parseInt(count) - 1;
            var menu = $("#mname").val();
            var qty = $("#qty").val();
            var rate = $("#rte").val();
          
            if((rate>0 && bltype=='Per Dish') || bltype=='Per Head' ){
            
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

           /* if(qty == '')
            {
                alert("Enter Quantity !");
                $("#qty").removeClass('disablefield');
                $("#qty").focus();
                return false;
            }*/

             var numbers12 =  /^[0-9.]+$/;
            if(qty != '') {
                if (numbers12.test(qty) == false) {
                    alert('Characters Not Allowed !');
                    $("#qty").focus();
                    return false;
                }
            }
            if(bltype === 'Per Dish')
           {
           /* if ($("#rte").val() == '' ||$("#rte").val()=='undefined')
            {
                  alert("Enter Rate !");
                  $("#rte").focus();
                  return false;
            }*/

              /* var numbers = /^[0-9]+$/;
               if($("#rte").val() != '') {
                   if (numbers.test(rate) == false) {
                       alert('Characters Not Allowed !');
                       $("#rte").focus();
                       return false;
                   }
               }*/
}
            if(true)
            {
                 var btype = $("#bltype").val();
                 var count = $("#count").val();
                 var id = parseInt(count) - 1;
                 var menu = $("#mname").val();
                 var qty = $("#qty").val();
                 var rate = $("#rte").val();

                 if (rate == '') {
                 var menurate = '0.00';
                 }
                 else
                 {
                 var menurate = rate;
                 }
                 var totalrate = $("#trte").val();
                 if (totalrate == '') {
                 var trate = '0.00';
                 }
                 else
                 {
                 var trate = totalrate;
                 }
                 var datastring = "id="+$("#ftnc_id").val()+"&fdm_menu="+menu+"&fdm_qty="+qty+"&fdm_unit_rate="+menurate+"&fdm_total_rate="+trate;

                 $.ajax({
                 type: "POST",
                 url: "banquet_registration.php",
                 data: datastring,
                 success: function (data)
                 {
                     var arr = data.split("+");
                     var rate = arr[1];
                     if(bltype === 'Per Dish')
                     {
                         $('#totalrate').html('Total Rate:' + parseFloat(rate).toFixed(3));
                     }
                     var a=JSON.parse(arr[0]);/*alert(a[0].fdm_menu);*/
                     $("#mname").val('');
                     $("#qty").val('');
                     $("#rte").val('');
                     $("#trte").val('');
                     $.each(a, function(i, record) {
                         if($('.bnqt').find('#del_div' + record.fdm_slno).length === 0) {
                             $(".bnqt").append('<div class="main_banquet_contant_left" style="width:99%;"  id="del_div' + record.fdm_slno + '" name="del_div' + record.fdm_slno + '">' +
                                 '<div class="main_banquet_form_box" style="width:40%"><div  class="main_banquet_form_textbox">' +
                                 '<input class="main_banquet_form_textbox_input disablefield" placeholder="Menu Name" value = "' + record.fdm_menu + '" type="text" name="mname' + record.fdm_slno + '"  id="mname' + record.fdm_slno + '">' +
                                 '<div  style="width: 130%;background:#FFF;margin-top:1px;float:left;" class="searchlist" id="suggesstions' + record.fdm_slno + '">' + '</div>' + '</div>' + '</div>' +
                                 '<div class="main_banquet_form_box" style="width:12%;">' +
                                 '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_qty + '" placeholder="Qty" type="text" name="qty"  id="qty' + record.fdm_slno + '">' + '</div></div>' +
                                 '<div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' +
                                 '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input rate_txt disablefield" value = "' + record.fdm_unit_rate + '" placeholder="Rate" type="text" name="rte"  onkeyup="return totalratechange(' + record.fdm_slno + ')" id="rte' + record.fdm_slno + '">' + '</div></div><div class="main_banquet_form_box" style="width:18%;margin-left:0.5%">' + '<div  class="main_banquet_form_textbox"><input class="main_banquet_form_textbox_input disablefield" value = "' + record.fdm_total_rate + '" placeholder="Rate" type="text" name="trte" id="trte' + record.fdm_slno + '"></div></div><div style="background-color:transparent;" class="menut_add_bq_btn plusbtn" name="delete_btn" id="delete_btn' + record.fdm_slno + '" onclick="return delfn(' + record.fdm_slno + ');"><img width="27px" src="img/cancel-icon.png"></div></div>');
                         }
                     });
                 }
                 });

                if($("#bltype").val()==='Per Head')
                {
                    $("#rte").addClass('disablefield');
                }
//                $('#count').val(incrementcount);
            }
            }else{
            alert('Please Add Unit Rate');
            }
        });


        function delfn(count)
        {
            var check = confirm("Are you sure you want to Delete record?");
            if(check==true) {


                var datastring = "type=delete&id=" + $("#ftnc_id").val() + "&slno=" + count;
                $.ajax({
                    type: "POST",
                    url: "banquet_registration.php",
                    data: datastring,
                    success: function (data)
                    {
                        $("#del_div" + count).remove();
                    }
                });
            }
               return true;
        }

     function validate_banquet() {
         if (document.form_banquet.bnpr.value == 'Select') {
             alert("Select Type");
             document.form_banquet.bnpr.focus();
             return false;
         }

         if (document.form_banquet.datez.value == '') {
             alert("Select Date ");
             document.form_banquet.datez.focus();
             return false;
         }

         if (document.form_banquet.tme.value == '') {
             alert("Enter Time ");
             document.form_banquet.tme.focus();
             return false;
         }
         if (document.form_banquet.tme.value != '') {
             var timRegX = /^([01]\d|2[0-3]):?([0-5]\d)$/;

             if (timRegX.test(document.form_banquet.tme.value) == false) {
                 alert("Time Should Be In (HH:MM) Format ! ");
                 document.form_banquet.tme.focus();
                 return false;
             }
         }

//         if (document.form_banquet.ssn.value == '') {
//             alert("Enter Session !");
//             document.form_banquet.ssn.focus();
//             return false;
//         }

         if (document.form_banquet.ftype.value == 'Select') {
             alert("Select Function Type ");
             document.form_banquet.ftype.focus();
             return false;
         }
         if (document.form_banquet.venue.value == 'Select') {
             alert("Select Venue ");
             document.form_banquet.venue.focus();
             return false;
         }
         if (document.form_banquet.paxs.value == '') {
             alert("Enter No Of Pax ");
             document.form_banquet.paxs.focus();
             return false;
         }
       /*  if (document.form_banquet.paxs.value != '') {
             var numbers21 = /^[0-9 +]+$/;
             if (numbers21.test(document.form_banquet.paxs.value) == false) {
                 alert('Invalid No Of Pax...! Please Re-Enter !');
                 document.form_banquet.paxs.focus();
                 return false;
             }
         }*/
         if (document.form_banquet.btype.value == 'Per Head')
         {
             if (document.form_banquet.phed.value == '' || document.form_banquet.phed.value  =='null') {
                 alert("Enter Per Head ");
                 document.form_banquet.phed.focus();
                 return false;
             }
/*
             if (document.form_banquet.phed.value != '' || document.form_banquet.phed.value != '0') {
                 var numbers2 = /^[0-9]+$/;
                 if (document.form_banquet.phed.value != ' ') {
                     if (numbers2.test(document.form_banquet.phed.value) == false) {
                         alert('Charecters Not Allowed !');
                         document.form_banquet.phed.focus();
                         return false;
                     }
                 }
             }
*/
         }
         if (document.form_banquet.namez.value == '') {
             alert("Enter Your Name ");
             document.form_banquet.namez.focus();
             return false;
         }
         if (document.form_banquet.namez.value != '')
         {
             if (!/^[A-Za-z\s]+$/.test(document.form_banquet.namez.value)) {
                 alert("Invalid characters! Plaese Re-Enter Your Name !");
                 document.form_banquet.namez.focus();
                 return false;
             }
     }

//      if(document.form_banquet.e_mail.value == '')
//      {
//      alert("Enter Your E-mail !");
//      document.form_banquet.e_mail.focus();
//      return false;
//      }
      
//      if(document.form_banquet.e_mail.value != '')
//      {
//             var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
//
//             if (reg.test(document.form_banquet.e_mail.value) == false) {
//                 alert('Invalid email address! Please re-enter !');
//                 document.form_banquet.e_mail.focus();
//                 return false;
//             }
//      }
//      if(document.form_banquet.nums1.value == '')
//      {
//      alert("Enter Your Mobile Number !");
//      document.form_banquet.nums1.focus();
//      return false;
//      }
/*
      if(document.form_banquet.nums1.value != '') {
          var numbers22 = /^[0-9 +]+$/;
          if (numbers22.test(document.form_banquet.nums1.value) == false) {
              alert('Invalid Phone Number...! Please Re-Enter !');
              document.form_banquet.nums1.focus();
              return false;
          }
      }
*/

    /*  if(document.form_banquet.phn.value == '')
      {
      alert("Enter Your Phone Number !");
      document.form_banquet.phn.focus();
      return false;
      }*/
/*
      if(document.form_banquet.phn.value != '') {
             var numbers21 = /^[0-9 +]+$/;
             if (numbers21.test(document.form_banquet.phn.value) == false) {
                 alert('Invalid Phone Number...! Please Re-Enter !');
                 document.form_banquet.phn.focus();
                 return false;
             }
      }
*/

//      if(document.form_banquet.c_prsn.value == '')
//      {
//      alert("Enter Contact Person !");
//      document.form_banquet.c_prsn.focus();
//      return false;
//      }

/*
      if(document.form_banquet.advancegiven.value != '') {
             var numbers21 = /^[0-9 +]+$/;
             if (numbers21.test(document.form_banquet.advancegiven.value) == false) {
                 alert('Invalid Advance Given...! Please Re-Enter !');
                 document.form_banquet.advancegiven.focus();
                 return false;
             }
       }
*/

//      if(document.form_banquet.addr.value == '')
//      {
//      alert("Enter Your Address !");
//      document.form_banquet.addr.focus();
//      return false;
//      }

      var datastring = "fd_reg_type="+document.form_banquet.bnpr.value+"&fd_date="+formatDate(document.form_banquet.datez.value)+"&fd_time="+document.form_banquet.tme.value+"&fd_session="+encodeURIComponent(document.form_banquet.ssn.value)+"&fd_function_type="+document.form_banquet.ftype.value+"&fd_venue="+document.form_banquet.venue.value+"&fd_billing_type="+document.form_banquet.btype.value+"&fd_no_of_pax="+document.form_banquet.paxs.value+"&fd_per_head_cost="+document.form_banquet.phed.value+"&fd_customer="+document.form_banquet.namez.value+"&fd_email="+document.form_banquet.e_mail.value+"&fd_mobile_1="+document.form_banquet.nums1.value+"&fd_mobile_2="+document.form_banquet.nums2.value+"&fd_landline="+document.form_banquet.phn.value+"&fd_contact_person="+document.form_banquet.c_prsn.value+"&fd_address="+document.form_banquet.addr.value+"&fd_remarks="+document.form_banquet.rmrk.value+"&advance="+document.form_banquet.advancegiven.value;
      $.ajax({
      type: "POST",
      url: "banquet_registration.php",
      data: datastring,
      success: function(data)
      {
      var arr = data.split(",");
      if(document.form_banquet.btype.value==='Per Head')
      {
      $(".rate_txt").addClass("disablefield");
      }
      $("#bltype").val(document.form_banquet.btype.value);
      $("#ftnc_id").val(arr[0]);
      $("#bnqt_view").removeClass("disabledview");
      $("#finalsubmit").removeClass("disabledview");
      $("#main_view").addClass("disabledview");
      $("#nextbtn").addClass("disablefield");
      }
      });
      return true;
      }

     function billtypechange(val)
     {
         if(val==='Per Dish') {
             $("#phed").val('0');
             $("#phed").addClass("disablefield");
             $("#phed").val('');
              $('#phed').attr('tabindex', '-1');
               $(".rate_txt").removeClass("disablefield");
         }
         else
         {
             $("#phed").removeClass("disablefield");
             $(".rate_txt").addClass("disablefield");

         }
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

     function menunamechange(name)
     {
         $.ajax({
             type: "POST",
             url: "banquet_registration.php",
             data: 'searchterm=' + name,
             beforeSend: function () {
             },
             success: function (data) {

                 var arr = data.split(",");
                 $("#suggesstions").show();
                 $("#suggesstions").html(arr[0]);
             }
         });
//        });
         return true;
     }


     function selectname(selected_value)
     {
         $("#mname").val(selected_value);
         $("#suggesstions").hide();
     }

     $(document).click(function() {
         if( this.class != 'searchlist')
         {
             $(".searchlist").hide();
         }
     });

     function submit_banquet()
     {
        
         var rate = $("#totalrate").html();
         
         var arr = rate.split(':');
         
         if(arr[1]!=""){
             var rt=arr[1];
         }else{
             rt=0;  
         }
         
         
         var datastring = "tempid="+$("#ftnc_id").val()+'&totalrate='+rt;
         $.ajax({
             type: "POST",
             url: "banquet_registration.php",
             data: datastring,
             success: function(data)
             {
                 var arr = data.split(",");
                 if(arr[0]!='')
                 {
                     $("#success").css("display","block");
                     $("#ftnid").html(arr[0]);
                 }
            }
         });
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




     function fnpax(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
     }
     function normal(mydiv)
     {
//        mydiv.getElementsByTagName("p")[0].style.opacity="0.8";
         mydiv.getElementsByTagName("p")[0].style.backgroundColor= '#fff';
     }
     function hover(mydiv)
     {
//        mydiv.getElementsByTagName("p")[0].style.opacity="1.5";
         mydiv.getElementsByTagName("p")[0].style.backgroundColor= '#cccccc';
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
             if ((charCode ==32) || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                 return true;
             else
                 return false;
         }
         catch (err) {
             alert(err.Description);
         }
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

     function numonly(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
     }



     function fnpax(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode>46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

             return false;
         }
         return true;
     }

     function fnhead(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode>46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
             return false;

         }
         return true;
     }

     function fnphn(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode>46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

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

    function tempclear()
    {			
        var check = confirm("Are you sure you want to Delete Temp?");
        if(check==true) 
		{  
	      var datastring = "type=deletetemp&temporaryid=" + $("#ftnc_id").val() ;
                $.ajax({
                    type: "POST",
                    url: "banquet_registration.php",
                    data: datastring,
                    success: function (data)
                    {
                      // alert(data);
					  window.location.href = "banquet_registration.php";
                    }
                });
		}
		return true;
   }

     function totalratechange()
     {
         var qty = $("#qty").val();
         var  rate  = $("#rte").val();
         var totalrate = parseFloat(qty)*parseFloat(rate);
         if(!isNaN(totalrate))
         {
             $("#trte").val(totalrate);
         }
         else
         {
             $("#trte").val('0');
         }
     }

      function totalrateupdate()
      {

      var bltype = $("#btype").val();
          if(bltype === 'Per Head')
          {
              if(document.form_banquet.phed.value!='')
              {
                  var phd = document.form_banquet.phed.value;
              }
              else
              {
                  var phd ='0.00';
              }
              if(document.form_banquet.paxs.value!='')
              {
                  var pax = document.form_banquet.paxs.value;
              }
              else
              {
                  var pax = '0.00';
              }
              var tot = parseFloat(phd) * parseFloat(pax);
              $("#totalrate").html('Total Rate:' + tot.toFixed(3));
          }
          else{


          }
return true;
      }
	  
	  $(window).load(function()
	  {
		  var res = new Array();
		  $("#test").html('');
		    var datastring = "loadtype=tempview";

		    $.ajax({
                    type: "POST",
                    url: "banquet_registration.php",
                    data: datastring,
                    success: function (data)
                    {
                var res = data.split("+");
				if(res[0].trim() == 'empty')
				{
					
				}
				else{
					               /* if($.trim(res[0]) = 'empty')
				{
					alert('ok');
				}
				else{
					
if(res[0] != empty)
				{ */
                $('#bnpr option[value="'+$.trim(res[0])+'"]').prop('selected', true);
                $('#input_01').val(res[1]);
                $('#tme').val(res[2]);
                $('#ssn').val(decodeURIComponent(res[3]));
                $('#ftype option[value="'+$.trim(res[4])+'"]').prop('selected', true); //alert(res[5]);
                $('#venue option[value="'+$.trim(res[5])+'"]').prop('selected', true); //alert(res[6]);
                $('#btype option[value="'+$.trim(res[6])+'"]').prop('selected', true);
                $('#paxs').val(res[7]);
                $('#phed').val(res[8]);
                $('#namez').val(res[9]);
                $('#e_mail').val(res[10]);
                $('#nums1').val(res[11]);
                $('#nums2').val(res[12]);
                $('#phn').val(res[13]);
                $('#c_prsn').val(res[14]);
                $('#addr').val(res[15]);
                $('#rmrk').val(res[16]);
                $('#tmp_id').val(res[17]);
                $('#fdtl_id').val(res[19]);
                $('#totalrate').val(res[20]);
                $("#advancegiven").val(res[21]);
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
				}				
				}
				/*}*/
                });
	  });
</script>
</body>
</html>