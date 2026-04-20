<?php
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
session_start();
$_SESSION['pagid']=26;
?>



<?php





if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['function_name']))
{
    $insertion['fec_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['function_name']));
    $insertion['fec_cost']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['function_cost']));
    $insertion['fec_unit']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_function']));

    $sql=$database->check_duplicate_entry('tbl_function_extra_costs
',$insertion);
    if($sql != 1)
    {
        $insertid              			=  $database->insert('tbl_function_extra_costs',$insertion);
    }

}

if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['value']))
{
    $sid = $_REQUEST['value'];



    $edit_query = $database->mysqlQuery("SELECT * FROM `tbl_function_extra_costs` WHERE fec_id = $sid ");
    $functionedit_extracostmaster = $database->mysqlFetchArray($edit_query);

    $fn_types = $functionedit_extracostmaster['fec_name'];
    $fn_cost = $functionedit_extracostmaster['fec_cost'];
    $fn_unit = $functionedit_extracostmaster['fec_unit']; echo $fn_types.",".$fn_cost.",".$fn_unit.",";

}

if($_SERVER["REQUEST_METHOD"]=='POST' && isset($_REQUEST['functionedit_name']))
{

    $function_editname=$_REQUEST['functionedit_name'];
    $function_editcost=$_REQUEST['functionedit_cost']; //echo $function_editstatus;
    $function_editunit=$_REQUEST['editunit_function'];
    $update_id=$_REQUEST['update_id'];// echo $update_id;

    $sqlupdate = $database->mysqlQuery("UPDATE tbl_function_extra_costs SET fec_name='$function_editname',fec_cost='$function_editcost',fec_unit='$function_editunit' WHERE fec_id='$update_id'");
    //echo "UPDATE tbl_function_extra_costs SET fec_name='$function_editname',fec_cost='$function_editcost',fec_unit='$function_editunit' WHERE fec_id='$update_id'";
}


?>


<!doctype html>
<html ng-app="website">
<head>
    <meta charset="utf-8">
    <title>Extra Cost</title>
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
		.contant_table_cc{height: 89vh;}
	.tablesorter tbody{height: 83vh;}
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
                        <li><a style="cursor:pointer">Function Extra Cost Master</a></li>
                    </ul>
                </div><!-- breadcrumbs -->
                <div class="content-sec">
                    <div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                        <div class="cc_new_main">
                            <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                            </div><!--cc_new-->

                            <div class="col-md-12 add_btn_cc_2">
                                <div class="btn_cc_2">
                                    <a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="clrkot()" ></a>
                                </div>
                            </div>
                            <div class="col-md-12 contant_table_cc">
                                <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Extra Cost</th>
                                        <th>Unit</th>

                                        <td >Action </td>
                                    </tr>
                                    </thead>
                                    <?php

                                    $select_query = $database->mysqlQuery("select * from tbl_function_extra_costs");
                                    $function_extracost = $database->mysqlNumRows($select_query);

                                    if($function_extracost)
                                    {
                                        while($function_result  = $database->mysqlFetchArray($select_query))
                                        {
                                            $id = $function_result['fec_id'];
                                            $cost = $function_result['fec_name'];
                                            $unit = $function_result['fec_unit'];


                                            ?>
                                            <tr class="select">
                                                <td><?= $function_result['fec_name'] ?></td>
                                                <td><?=$function_result['fec_cost']?></td>
                                                <td><?php if($unit=='P'){
                                                        echo "Percentage";
                                                    }else{
                                                        echo "Value";
                                                    }
                                                    ?></td>


                                                <td>
                                                    <a href="#" id="editing_function" name="editing_function" class="md-trigger_cat" onclick="show_edit(<?=$id?>);"><img src="images/edit_page.PNG"></a>
                                                    <!-- <a href="#" onclick="return delete_confirm("+$id+")" id="del_function" name="del_function" class="md-trigger_cat" ><img src="img/delete_btn_2.png"></a>-->
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

<!-- Add function master popup -->

<div style="width:500px;" class="md-modal md-effect-16" id="modal-17">
    <div class="md-content" id="edit_function">
        <h3>Add New</h3>
        <div>
            <div class="col-lg-12 col-md-12 no-padding">
                <form name="form_ftype" id="form_ftype" method="post" action="">


                    <div class="first_form_contain">
                        <div class="form_name_cc">Name<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="text" name="function_name" id="function_name" class="form-control kotname"  placeholder="Name" ></div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Cost<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="text" name="function_cost" id="function_cost" class="form-control kotname"  placeholder="0.00" ></div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Unit<span style="color:#F00">*</span></div>
                        <div class="form_textbox_cc"  > <div class="form-group">
                                <select class="form-control add_new_dropdown2" name="unit_function" id="unit_function">
                                    <option value="Select">Select</option>
                                    <option value="P">Percentage</option>
                                    <option value="V">Value</option>
                                </select>
                            </div>
                        </div><!--form_textbox_cc-->
                    </div><!--first_form_contain-->
                    <!--first_form_contain-->
                </form>
            </div>
            <a class="entersubmit1" ><button class="md-save" tabindex="3" name="submit_ftype" id="submit_ftype" onclick="return function_type();">Save</button></a>
            <a href="#"><button class="md-close" tabindex="4">Close me!</button></a>
        </div>
    </div>
</div>

<!-- Edit function master popup-->

<div style="width:500px" class="md-modal md-effect-16" id="modal_editfunction">
    <div class="md-content" id="edits_function">
        <h3>Edit Page</h3>
        <div>
            <div class="col-lg-12 col-md-12 no-padding">
                <form name="formedit_ftype" id="formedit_ftype" method="post" action="">
                    <div class="first_form_contain">
                        <div class="form_name_cc">Name<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="hidden" id="update_id" name="update_id" >
                            <input type="text" name="functionedit_name" id="functionedit_name" class="form-control kotname" value=""></div>
                    </div>

                    <div class="first_form_contain">
                        <div class="form_name_cc">Cost<span style="color:#F00">*</span></div>

                        <div class="form_textbox_cc" id="kot_div">
                            <input type="text" name="functionedit_cost" id="functionedit_cost" class="form-control kotname" value=""></div>
                    </div>


                    <div class="first_form_contain">
                        <div class="form_name_cc">Unit<span style="color:#F00">*</span></div>
                        <div class="form_textbox_cc"  > <div class="form-group">
                                <select class="form-control add_new_dropdown2" name="editunit_function" id="editunit_function">
                                    <option value="P">Percentage</option>
                                    <option value="V">Value</option>
                                </select>
                            </div>
                        </div><!--form_textbox_cc-->
                    </div><!--first_form_contain-->
                    <!--first_form_contain-->
                </form>
            </div>
            <a class="entersubmit1" ><button class="md-save" tabindex="3" name="submitedit_ftype" id="submitedit_ftype" onclick="return functionedit_type();">Update</button></a>
            <a href="function_extracost_master.php"><button class="md-close" tabindex="4">Close me!</button></a>
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
            url: "function_extracost_master.php",
            data: "value="+id,
            success: function(data)
            {
                var res = data.split(",");
                //alert(res);


                $('#update_id').val(id);
                $('#modal_editfunction').val();
                $('#functionedit_name').val(res[0]);
                $('#functionedit_cost').val(res[1]);
                $('#editunit_function option[value="' + res[2] + '"]').prop('selected', true);

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




    function function_type()
    {
        if(document.form_ftype.function_name.value == '')
        {
            alert("Enter Name");
            document.form_ftype.function_name.focus();
            return false;
        }

        if(document.form_ftype.function_cost.value == '')
        {
            alert("Enter Your Extra Cost");
            document.form_ftype.function_cost.focus();
            return false;
        }

        var numbers1 =  /^[0-9 .]+$/;
        if(numbers1.test( document.form_ftype.function_cost.value)== false)
        {
            alert('Charecters Not Allowed !');
            document.form_ftype.function_cost.focus();
            return false;
        }


        if(document.form_ftype.unit_function.value == 'Select')
        {
            alert("Select Unit");
            document.form_ftype.unit_function.focus();
            return false;
        }

        document.form_ftype.submit();

    }


    function functionedit_type()
    {

        if(document.formedit_ftype.functionedit_name.value == '')
        {
            alert("Enter Name");
            document.formedit_ftype.functionedit_name.focus();
            return false;
        }

        if(document.formedit_ftype.functionedit_cost.value == '')
        {
            alert("Enter Cost");
            document.formedit_ftype.functionedit_cost.focus();
            return false;
        }

        document.formedit_ftype.submit();
    }




</script>

</body>
</html>

