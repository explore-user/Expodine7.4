
<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

 $ename_edit= "";
 $edecp_edit="";
 $estatus_edit="";
 $estart_edit="";
 $estop_edit="";
 $etype_edit="";
 $edit_button="insert";
 $eredempoint_edit="";
 $eredemcash_edit="";
 $ebillamount="";
if(isset($_REQUEST['earn_update_id']) && $_REQUEST['earn_update_id']!=""){
 
$loy_qry1_upd = $database->mysqlQuery("select * from tbl_loyalty_rules where lr_id='".$_REQUEST['earn_update_id']."' ");
    $num_loy1_upd = $database->mysqlNumRows($loy_qry1_upd);
     if($num_loy1_upd)
     {
         while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1_upd))
         {
             $lr_id=$_REQUEST['earn_update_id'];
             
             $ename_edit=  $loyalty_listing_edit['lr_name'];
             $edecp_edit=  $loyalty_listing_edit['lr_description'];
             $estatus_edit=      $loyalty_listing_edit['lr_active'];
             $estart_edit=      $loyalty_listing_edit['lr_start_at'];
             $estop_edit=       $loyalty_listing_edit['lr_end_at'];
             $etype_edit=       $loyalty_listing_edit['lr_type'];
              $eredempoint_edit=       $loyalty_listing_edit['lr_redemption_min_point'];
             $eredemcash_edit=       $loyalty_listing_edit['lr_redemption_cash_value'];
            $ebillamount=       $loyalty_listing_edit['lr_bill_amount'];
              $edit_button="update";
         }
         }
                

}



if(isset($_REQUEST['set_add_rules'])&&($_REQUEST['set_add_rules']=="add_rules")){
    
             $ename= $_REQUEST['ename'];
             $edescp= $_REQUEST['edesc'];
             $estatus=$_REQUEST['estatus'];
             
             if($_REQUEST['estart']!=""){
             $estart= $_REQUEST['estart'];
             }else{
                $estart='1001-01-01';   
             }
             if($_REQUEST['estop']!=""){
             $estop=$_REQUEST['estop'];
             } else{
                $estop='1001-01-01';   
             }
             
             $type= $_REQUEST['etype'];
             
             if($_REQUEST['erpoint']!=""){
             $eredem_point=$_REQUEST['erpoint'];
             }else{
               $eredem_point=0;  
             }
             if($_REQUEST['ercash']!=""){
             $eredem_cash= $_REQUEST['ercash'];    
             }else{
               $eredem_cash=0;  
             }
             
             if($_REQUEST['ebillamount']!=""){
             $ebill_amount= $_REQUEST['ebillamount'];    
             }else{
               $ebill_amount=0;  
             }
               $insertion['lr_bill_amount'] = mysqli_real_escape_string($database->DatabaseLink,trim($ebill_amount)); 
        $insertion['lr_redemption_min_point'] = mysqli_real_escape_string($database->DatabaseLink,trim($eredem_point)); 
        $insertion['lr_redemption_cash_value'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($eredem_cash));         
        $insertion['lr_name'] = mysqli_real_escape_string($database->DatabaseLink,trim($ename)); 
        $insertion['lr_description'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($edescp)); 
        $insertion['lr_active']=  mysqli_real_escape_string($database->DatabaseLink,trim($estatus)); 
        $insertion['lr_start_at']=  mysqli_real_escape_string($database->DatabaseLink,trim($estart));
        $insertion['lr_end_at']=  mysqli_real_escape_string($database->DatabaseLink,trim($estop));
        $insertion['lr_type']= mysqli_real_escape_string($database->DatabaseLink,trim($type));
       
	$insertid      =  $database->insert('tbl_loyalty_rules',$insertion); 
       
}

if(isset($_REQUEST['set_update_rules'])&&($_REQUEST['set_update_rules']=="update_rules")){
            
             $ename1= $_REQUEST['ename1'];
             $edesc1= $_REQUEST['edesc1'];
             $estatus1=$_REQUEST['estatus1'];
             $estart1= $_REQUEST['estart1'];
             $estop1=$_REQUEST['estop1'];
             $etype1= $_REQUEST['etype1'];
             $earn_up_id=$_REQUEST['earn_up_id'];
	   $eredem_point1=$_REQUEST['erpoint1'];
              $eredem_cash1= $_REQUEST['ercash1'];   
              $ebillamount1= $_REQUEST['ebillamount1'];   
              
             $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_loyalty_rules SET lr_name='".$ename1."',lr_description='".$edesc1."'"
             . ",lr_active='".$estatus1."',
                     lr_start_at='".$estart1."',
                     lr_end_at='".$estop1."',lr_type='".$etype1."',lr_redemption_min_point='".$eredem_point1."',lr_redemption_cash_value='".$eredem_cash1."',lr_bill_amount='".$ebillamount1."'  where lr_id='".$earn_up_id."'");
      
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
                    		Add Earning Points Rules
                            <a href="earning-points-rules.php"><div class="top-head-add-btn"><span class="ti-arrow-left"></span> BACK</div></a>
                    </div>
                    <div class="container">
                      
                        <div class="card-box table-responsive">
                        	<div class="registration-main-container inner-textbox-effect">
                            
                            	<div class="col-md-4">
                                    <div class="group">
                                        <input id="earn_name" required="" name="" type="text" value="<?=$ename_edit?>">
                                        <label>Name</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="earn_descp" required="" name="" type="text" value="<?=$edecp_edit?>">
                                        <label>Description</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="group">
                                        <input id="earn_red_point" required="" name="" type="text" value="<?=$eredempoint_edit?>">
                                        <label>Redemption Min Point</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="group">
                                        <input id="earn_red_cash" required="" name="" type="text" value="<?=$eredemcash_edit?>">
                                        <label>Redemption Cash Value</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                    <div class="col-md-4">
                                    <div class="group">
                                        <input id="earn_billamount" required="" name="" type="text" value="<?=$ebillamount?>">
                                        <label>Bill Amount</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                       <select class="select-registration" id="earn_status" >
                                          
                                            <option value="Y" <?php if($estatus_edit=='Y') { ?> selected <?php } ?> >Active</option>
                                             <option value="N" <?php if($estatus_edit=='N') { ?> selected <?php } ?> >Inactive</option>
                                        </select>
                                     </div>                       
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="datepicker" required="" name="" type="text" value="<?=$estart_edit?>">
                                        <label>Start AT</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                        <input id="datepicker1" required="" name="" type="text" value="<?=$estop_edit?>">
                                        <label>End AT</label>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group">
                                       <select class="select-registration" id="earn_type" >
                                           <option value="0">Select Type</option>
                                             <?php
                               
     $loy_qry_type = $database->mysqlQuery("select * from tbl_loyalty_rules_type where lrt_active='Y'");
       $num_loy_type = $database->mysqlNumRows($loy_qry_type);
     if($num_loy_type)
      {
         while($loyalty_listing_type = $database->mysqlFetchArray($loy_qry_type))
         {
                                ?>
                                 <option value="<?=$loyalty_listing_type['lrt_id']?>"  <?php if($etype_edit==$loyalty_listing_type['lrt_id']) { ?> selected <?php } ?>   > <?=$loyalty_listing_type['lrt_name']?>  </option>           
     <?php } }  ?>
                                        </select>
                                     </div>
                                </div>
                                
                                
                                
                                 
                                  <div class="col-md-12 col-xs-12">
                                        <?php if($edit_button=='insert'){ ?>
                                      <a href="#"><div class="submit-form-btn" onclick="return submit_earn_rule();">SUBMIT</div></a>
                                       <?php } else if ($edit_button=='update') { ?>
                                       <a href="#"><div class="submit-form-btn" onclick="return update_rules('<?=$lr_id?>');">Update</div></a>
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
            
            
            function submit_earn_rule(){
                
                   var ename=$('#earn_name').val();
                   var edesc=$('#earn_descp').val();
                   var estatus=$('#earn_status').val();
                   var estart=$('#datepicker').val();
                    var estop=$('#datepicker1').val();
                   var etype=$('#earn_type').val();
                   var ercash=$('#earn_red_cash').val();
                   var erpoint=$('#earn_red_point').val();
                    var ebillamount=$('#earn_billamount').val();
                
                  
                  
                  if(ename!="" )   {       
         var data="set_add_rules=add_rules&ename="+ename+"&edesc="+edesc+"&estatus="+estatus+"&estart="+estart+"&estop="+estop+"&etype="+etype+"&ercash="+ercash+"&erpoint="+erpoint+"&ebillamount="+ebillamount;
   
        $.ajax({
        type: "POST",
        url: "add-earning-point-level.php",
        data: data,
        success: function(data)
        {
               $('#earn_name').val('');
               $('#earn_descp').val('');
               $('#earn_status').val('status');
               $('#datepicker').val('');
               $('#datepicker1').val('');
               $('#earn_type').val('type');
              $("#success_show").show();
               var success_show=$('#success_show');
	       success_show.text('Added Successfully !');	
	       $("#success_show").delay(1000).fadeOut('slow');
               $('#earn_red_cash').val('');
               $('#earn_red_point').val('');
               $('#earn_billamount').val('');
               setTimeout(function(){ window.location.href="earning-points-rules.php"; }, 1000);
        }
    });
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Enter Name');	
	       $("#error_show").delay(1000).fadeOut('slow');
      
    }
    
    } 
      
      
       function update_rules(id){
             
                   var ename1=$('#earn_name').val();
                   var edesc1=$('#earn_descp').val();
                   var estatus1=$('#earn_status').val();
                   var estart1=$('#datepicker').val();
                    var estop1=$('#datepicker1').val();
                   var etype1=$('#earn_type').val();
               var ercash1=$('#earn_red_cash').val();
                   var erpoint1=$('#earn_red_point').val();
                    var ebillamount1=$('#earn_billamount').val();
               
                  if(ename1!="" )   {       
         var data="set_update_rules=update_rules&ename1="+ename1+"&edesc1="+edesc1+"&estatus1="+estatus1+"&estart1="+estart1+"&estop1="+estop1+"&etype1="+etype1+"&earn_up_id="+id+"&ercash1="+ercash1+"&erpoint1="+erpoint1+"&ebillamount1="+ebillamount1;
        
        $.ajax({
        type: "POST",
        url: "add-earning-point-level.php",
        data: data,
        success: function(data)
        {
            
               var success_show=$('#success_show');
	       success_show.text('Update Successfull !');	
	       $("#success_show").delay(1000).fadeOut('slow');
                setTimeout(function(){ window.location.href="earning-points-rules.php"; }, 1000);
        }
    });
    }else{
               $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Enter Name !');	
	       $("#error_show").delay(1000).fadeOut('slow');
               $('#earn_name').focus();
               
      
    }
    
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

<script>

       $(function() {
           $('#earn_name').focus();
           
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
           
       });
       

         
     
       
   </script>



    </body>

</html>