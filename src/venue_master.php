<?php
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
session_start();
$_SESSION['pagid']=25;
?>

<?php



if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['venue_name']))
{
    $insertion['fv_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['venue_name']));
    $insertion['fv_status']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['select_venue']));

    $sql=$database->check_duplicate_entry('tbl_function_venue',$insertion);
    if($sql != 1)
    {
        $insertid              			=  $database->insert('tbl_function_venue',$insertion);
    }

}


if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['value']))
{
    $sid = $_REQUEST['value'];



    $edit_query = $database->mysqlQuery("SELECT * FROM `tbl_function_venue` WHERE fv_id = $sid ");
    $functionedit_master = $database->mysqlFetchArray($edit_query);

    $fn_types = $functionedit_master['fv_name'];
    $fn_status = $functionedit_master['fv_status']; echo $fn_types.",".$fn_status.",";

}

if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['functionedit_name']))
{

    $function_edittype=$_REQUEST['functionedit_name'];
    $function_editstatus=$_REQUEST['editstatus_function'];
    $update_id=$_REQUEST['update_id'];// echo $update_id;

    $sqlupdate = $database->mysqlQuery("UPDATE tbl_function_venue SET fv_name='$function_edittype',fv_status='$function_editstatus' WHERE fv_id='$update_id'");
   // echo "UPDATE tbl_function_venue SET fv_name='$function_edittype',fv_status='$function_editstatus' WHERE fv_id='$update_id'";
}



?>



<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Venue</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
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
.ui-autocomplete{z-index:999999 !important;}</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			$('#kots').autocomplete({source:'autocomplete/find_keywords.php?type=kot_s', minLength:1});
			$('#branches').autocomplete({source:'autocomplete/find_keywords.php?type=branch_s', minLength:1});
			$('#printers').autocomplete({source:'autocomplete/find_keywords.php?type=printer_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
	.contant_table_cc{height: 90vh;}
	.tablesorter tbody{height: 84vh;}
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
					<li><a style="cursor:pointer">Venue Master</a></li>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="cc_new_main">
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	
                   </div>

                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="clrkot()" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Venue</th>
                                <th>Status</th>
                             
                                 <td >Action</td>
                              </tr>
                             </thead>
                           <?php
                           $select_query = $database->mysqlQuery("select * from tbl_function_venue");
                           $venue_master = $database->mysqlNumRows($select_query);

                           if($venue_master)
                           {
                           while($function_result  = $database->mysqlFetchArray($select_query))
                           {
                           $id = $function_result['fv_id'];


                           ?>
    						<tr class="select">
                                <td><?= $function_result['fv_name'] ?></td>
                                <td><?=$function_result['fv_status']?></td>
                               
                                <td>
                                 <a href="#" id="delete_venue" name="delete_venue" onclick="return show_edit(<?=$id?>);" class="md-trigger_cat" ><img src="images/edit_page.PNG"></a>

                                </td>
                              </tr>
                            <?php } } ?>
                        </table>
                   </div>
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 <div style="width:500px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form name="venue_form" id="venue_form" method="post" action="">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Venue<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="kot_div">
                                     <input type="text" class="form-control kotname"  placeholder="Function" id="venue_name" name="venue_name"></div>
                               </div>
                                 
                                   <div class="first_form_contain">
                                 	<div class="form_name_cc">Status<span style="color:#F00">*</span></div>
                                  <div class="form_textbox_cc"  > <div class="form-group">
                                         <select class="form-control add_new_dropdown2" name="select_venue" id="select_venue">
                                         	<option value="Select">Select</option>
                                         	<option value="Active">Active</option>
                                         	<option value="InActive">InActive</option>
                                         </select>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain-->
                                      <!--first_form_contain-->
                                  </form> 
                    </div>
                                    <a  href="#" id="venue_submit" name="venue_submit" class="entersubmit1" onclick="return validate_venue();"><button class="md-save" tabindex="3">Save</button></a>
                             <a href="#"><button class="md-close" tabindex="4">Close me!</button></a>
				</div>
                </div>
		</div>


<!-- Edit venue master  -->

<div style="width:500px" class="md-modal md-effect-16" id="modal_editfunction">
    <div class="md-content" id="edits_function">
        <h3>Edit Page</h3>
        <div>
            <div class="col-lg-12 col-md-12 no-padding">
                <form name="formedit_ftype" id="formedit_ftype" method="post" action="">
                    <div class="first_form_contain">
                        <div class="form_name_cc">Venue<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="hidden" id="update_id" name="update_id" >
                            <input type="text" name="functionedit_name" id="functionedit_name" class="form-control kotname" value=""></div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Status<span style="color:#F00">*</span></div>
                        <div class="form_textbox_cc"  > <div class="form-group">
                                <select class="form-control add_new_dropdown2" name="editstatus_function" id="editstatus_function">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
                            </div>
                        </div><!--form_textbox_cc-->
                    </div><!--first_form_contain-->
                    <!--first_form_contain-->
                </form>
            </div>
            <a class="entersubmit1" ><button class="md-save" tabindex="3" name="submitedit_ftype" id="submitedit_ftype" onclick="return functionedit_type();">Update</button></a>
            <a href="venue_master.php"><button class="md-close" tabindex="4">Close me!</button></a>
        </div>
    </div>
</div>


<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>



<script>
    /*$("#editing_function").click(function () {
     alert('sdf');
     $("#modal_editfunction").addClass("md-show");*/

    function show_edit(id)
    {
        $("#modal_editfunction").addClass("md-show");

        $.ajax({
            type: "POST",
            url: "venue_master.php",
            data: "value="+id,
            success: function(data)
            {
                var res = data.split(",");


                $('#update_id').val(id);
                $('#modal_editfunction').val();
                $('#functionedit_name').val(res[0]);
                $('#editstatus_function option[value="' + res[1] + '"]').prop('selected', true);

//
            },
            error:function(error)
            {
                alert("error !");
            }

        });
        return true;

    }
</script>

<script>

    function validate_venue()
    {
        if(document.venue_form.venue_name.value== '')
        {
            alert("Enter Venue");
            document.venue_form.venue_name.focus();
            return false;
        }

        if(document.venue_form.select_venue.value== 'Select')
        {
            alert("Select Status");
            document.venue_form.select_venue.focus();
            return false;
        }
        document.venue_form.submit();
    }




    function functionedit_type()
    {

        if(document.formedit_ftype.functionedit_name.value == '')
        {
            alert("Enter Function Type");
            document.formedit_ftype.functionedit_name.focus();
            return false;
        }

        document.formedit_ftype.submit();
    }

</script>

</body>
</html>