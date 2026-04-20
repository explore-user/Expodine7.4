
<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();



 $lname_edit= "";
 $ldecp_edit="";
 $cnd_edit="";
 $rwd_edit="";
 $rwc_edit="";
 $rwv_edit="";
 $min_val_edit="";
 $lcust_edit="";
 $l_act_edit="";
 $edit_button="insert";
 
if(isset($_REQUEST['level_update_id']) && $_REQUEST['level_update_id']!=""){
 
  $loy_qry1_upd = $database->mysqlQuery("select * from tbl_loyalty_levels where ll_id='".$_REQUEST['level_update_id']."' ");
    $num_loy1_upd = $database->mysqlNumRows($loy_qry1_upd);
     if($num_loy1_upd)
     {
         while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1_upd))
         {
             $ll_id=$_REQUEST['level_update_id'];
             
             $lname_edit=  $loyalty_listing_edit['ll_name'];
             $ldecp_edit=  $loyalty_listing_edit['ll_description'];
             $cnd_edit=      $loyalty_listing_edit['ll_condition_value'];
             $rwd_edit=      $loyalty_listing_edit['ll_reward_name'];
             $rwc_edit=       $loyalty_listing_edit['ll_reward_code'];
             $rwv_edit=       $loyalty_listing_edit['ll_reward_value'];
              $min_val_edit=      $loyalty_listing_edit['ll_minorder_value'];
             $lcust_edit=       $loyalty_listing_edit['ll_customers'];
             $l_act_edit=       $loyalty_listing_edit['ll_active'];
            
              $edit_button="update";
         }
         }
                

}


if(isset($_REQUEST['set_update_levels'])&&($_REQUEST['set_update_levels']=="update_levels")){
   
             $lname1= $_REQUEST['lname1'];
             $ldesc1= $_REQUEST['ldesc1'];
             
             if($_REQUEST['lcondition_value1']!=""){
             $lcondition_value1=$_REQUEST['lcondition_value1'];
             }else{
                 $lcondition_value1=0;
             }
             
             $lreward_name1= $_REQUEST['lreward_name1'];
             
             if($_REQUEST['lreward_code1']!=""){
             $lreward_code1=$_REQUEST['lreward_code1'];
             }else{
                 $lreward_code1=0;
             }
             
             if($_REQUEST['lreward_value1']!=""){
             $lreward_value1= $_REQUEST['lreward_value1'];
             }else{
                $lreward_value1=0; 
             }
             
             if($_REQUEST['lminvalue1']!=""){
             $lminvalue1= $_REQUEST['lminvalue1'];
             }else{
                $lminvalue1=0; 
             }
             
             if($_REQUEST['lcustomer1']!=""){
             $lcustomer1=$_REQUEST['lcustomer1'];
             }else{
                $lcustomer1=0; 
             }
             
             $lstatus1= $_REQUEST['lstatus1'];
             
             $level_new_id=$_REQUEST['level_new_id'];
             
             
             
               $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_levels SET ll_name='".$lname1."',ll_description='".$ldesc1."',ll_condition_value='".$lcondition_value1."',"
                       . "ll_reward_name='".$lreward_name1."',ll_reward_code='".$lreward_code1."',ll_reward_value='".$lreward_value1."',"
                       . "ll_minorder_value='".$lminvalue1."',ll_customers='".$lcustomer1."',ll_active='".$lstatus1."' where ll_id='".$level_new_id."' ");
         
                 
}




if(isset($_REQUEST['set_add_levels'])&&($_REQUEST['set_add_levels']=="add_levels")){
   
             $lname= $_REQUEST['lname'];
             $ldesc= $_REQUEST['ldesc'];
             $lcondition_value=$_REQUEST['lcondition_value'];
             $lreward_name= $_REQUEST['lreward_name'];
             $lreward_code=$_REQUEST['lreward_code'];
             $lreward_value= $_REQUEST['lreward_value'];
             $lminvalue= $_REQUEST['lminvalue'];
             $lcustomer=$_REQUEST['lcustomer'];
             $lstatus= $_REQUEST['lstatus'];
             
        $insertion['ll_name'] = mysqli_real_escape_string($database->DatabaseLink,trim($lname)); 
        
        $insertion['ll_description'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($ldesc)); 
        
        if($lcondition_value!=""){
        $insertion['ll_condition_value']=  mysqli_real_escape_string($database->DatabaseLink,trim($lcondition_value)); 
        }
        
        $insertion['ll_reward_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($lreward_name));
           if($lreward_code){
        $insertion['ll_reward_code']=  mysqli_real_escape_string($database->DatabaseLink,trim($lreward_code));
           }
           
              if($lreward_value){ 
        $insertion['ll_reward_value']= mysqli_real_escape_string($database->DatabaseLink,trim($lreward_value));
              }
              if($lminvalue){ 
        $insertion['ll_minorder_value']=  mysqli_real_escape_string($database->DatabaseLink,trim($lminvalue));
              }
          if($lcustomer){      
        $insertion['ll_customers']=  mysqli_real_escape_string($database->DatabaseLink,trim($lcustomer));
          }
          
        $insertion['ll_active']= mysqli_real_escape_string($database->DatabaseLink,trim($lstatus));
         
	$insertid      =  $database->insert('tbl_loyalty_levels',$insertion); 
       
}










?>


<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>Loyalty</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

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

        <script src="assets/js/modernizr.min.js"></script>
 


    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->




            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                	<div class="top-head-section">
                    		Add Levels
                            <a href="levels.php"><div class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a>
                    </div>
                    <div class="container">

                        <div class="card-box table-responsive">
                        	<div class="registration-main-container inner-textbox-effect">

                            	<div class="col-md-4">
                                    <div class="group">
                                        <input id="level_name" required="" name="" type="text" value="<?=$lname_edit?>">
                                        <label>Name</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="level_description" required="" name="" type="text" value="<?=$ldecp_edit?>">
                                        <label>Description</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="level_conditionvalue" onkeypress="return numdot(event);" required="" name="" type="text" value="<?=$cnd_edit?>">
                                        <label>Condition value</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input  required="" name="" type="text" id="level_rewardname" value="<?=$rwd_edit?>">
                                        <label>Reward Name</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input  required="" name=""   type="text" id="level_rewardcode" value="<?=$rwc_edit?>">
                                        <label>Reward Code</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="group">
                                       <input  required="" name="" onkeypress="return numdot(event);"  type="text" id="level_rewardvalue" value="<?=$rwv_edit?>">
                                        <label>Reward Value</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input  required="" name="" onkeypress="return numdot(event);"  type="text" id="level_minvalue" value="<?=$min_val_edit?>">
                                        <label>Min Order Value</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input  required="" name="" onkeypress="return numdot(event);"  type="text" id="level_customer"value="<?=$lcust_edit?>" >
                                        <label>Customers</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                       <select class="select-registration" id="level_status" > 
                                          
                                            <option value="Y" <?php if($l_act_edit=='Y') { ?> selected <?php } ?> >Active</option>
                                             <option value="N" <?php if($l_act_edit=='N') { ?> selected <?php } ?> >Inactive</option>
                                        </select>
                                     </div>
                                </div>
                                
                                 
                                  
                                 <div class="col-md-12 col-xs-12">
                                        <?php if($edit_button=='insert'){ ?>
                                      <a href="#"><div class="submit-form-btn" onclick="return submit_levels();">SUBMIT</div></a>
                                       <?php } else if ($edit_button=='update') { ?>
                                       <a href="#"><div class="submit-form-btn" onclick="return update_levels('<?=$ll_id?>');">Update</div></a>
                                       <?php } ?>
                                      <strong id="error_show" style="float: right;color: red;margin: 8px 20px 0 0"></strong>
                                       <strong id="success_show" style="float: right;color: limegreen;margin: 8px 20px 0 0"></strong>
                                  </div>
                                
                            </div>
                        </div><!--card-box table-responsive-->
                      
                    </div> <!-- container -->

                </div> <!-- content -->


            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
            
            
  function submit_levels(){
                
                   var lname=$('#level_name').val();
                   var ldesc=$('#level_description').val();
                   var lcondition_value=$('#level_conditionvalue').val();
                   var lreward_name=$('#level_rewardname').val();
                   var lreward_code=$('#level_rewardcode').val();
                   var  lreward_value=$('#level_rewardvalue').val();
                   
                   var lminvalue=$('#level_minvalue').val();
                   var lcustomer=$('#level_customer').val();
                   var lstatus=$('#level_status').val();
                  
                  
                  if(lname!="" ) {       
         var data="set_add_levels=add_levels&lname="+lname+"&ldesc="+ldesc+"&lcondition_value="+lcondition_value+"&lreward_name="+lreward_name+"&lreward_code="+lreward_code+"&lreward_value="+lreward_value+"&lminvalue="+lminvalue+"&lcustomer="+lcustomer+"&lstatus="+lstatus;
     
        $.ajax({
        type: "POST",
        url: "add-level.php",
        data: data,
        success: function(data)
        {
              $('#level_name').val('');
              $('#level_description').val('');
              $('#level_conditionvalue').val('');
              $('#level_rewardname').val('');
              $('#level_rewardcode').val('');
              $('#level_rewardvalue').val('');
                   
              $('#level_minvalue').val('');
              $('#level_customer').val('');
              $('#level_status').val('status');
              
               var success_show=$('#success_show');
	       success_show.text('Added Successfully !');	
	       $("#success_show").delay(1000).fadeOut('slow');
                setTimeout(function(){ window.location.href="levels.php"; }, 1000);
        }
    });
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Enter Name');	
	       $("#error_show").delay(1000).fadeOut('slow');
      
    }
    
    }
                     
    
     function update_levels(id){
                
                   var lname1=$('#level_name').val();
                   var ldesc1=$('#level_description').val();
                   var lcondition_value1=$('#level_conditionvalue').val();
                   var lreward_name1=$('#level_rewardname').val();
                   var lreward_code1=$('#level_rewardcode').val();
                   var  lreward_value1=$('#level_rewardvalue').val();
                   
                   var lminvalue1=$('#level_minvalue').val();
                   var lcustomer1=$('#level_customer').val();
                   var lstatus1=$('#level_status').val();
                  
                  
                  
                  if(lname1!="" )   {       
         var data="set_update_levels=update_levels&lname1="+lname1+"&ldesc1="+ldesc1+"&lcondition_value1="+lcondition_value1+"&lreward_name1="+lreward_name1+"&lreward_code1="+lreward_code1+"&lreward_value1="+lreward_value1+"&lminvalue1="+lminvalue1+"&lcustomer1="+lcustomer1+"&lstatus1="+lstatus1+"&level_new_id="+id;
       
        $.ajax({
        type: "POST",
        url: "add-level.php",
        data: data,
        success: function(data)
        {
             
               var success_show=$('#success_show');
	       success_show.text('Updated Successfully !');	
	       $("#success_show").delay(1000).fadeOut('slow');
               setTimeout(function(){ window.location.href="levels.php"; }, 1000);
               
        }
    });
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Enter Name');	
	       $("#error_show").delay(1000).fadeOut('slow');
      
    }
    
    }
    
    
    
        function numdot(e) {     
   
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 46)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }      
            
            
        </script>

        <!-- jQuery  -->
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
        
       

<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>





    </body>

</html>