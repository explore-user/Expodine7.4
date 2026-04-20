<?php

//include("../database.class.php"); // DB Connection class
//$database = new Database(); 
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if($_REQUEST['honame']!="" && $_REQUEST['hoaddress']!="" && $_REQUEST['corpname']!="" && $_REQUEST['headprefix']!="" && $_REQUEST['branchname']!="" && $_REQUEST['address']!="" && $_REQUEST['branchprefix']!="" && $_REQUEST['androidapkname']!=""&& $_REQUEST['androidapkcode']!=""){
    
    $honame = $_REQUEST['honame'];
    $hoaddress = $_REQUEST['hoaddress'];
    $corpname = $_REQUEST['corpname'];
    $headprefix = $_REQUEST['headprefix'];
    $branchname = $_REQUEST['branchname'];
    $address = $_REQUEST['address'];
    $branchprefix = $_REQUEST['branchprefix'];
    $expoversion = $_REQUEST['expoversion'];
    $androidapkname = $_REQUEST['androidapkname'];
    $androidapkcode = $_REQUEST['androidapkcode'];
    $message = "";
    
    $database->mysqlQuery("SET @head_office_name = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$honame) . "'");
    $database->mysqlQuery("SET @hoaddress = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$hoaddress) . "'");
    $database->mysqlQuery("SET @corpname = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$corpname) . "'");
    $database->mysqlQuery("SET @headprefix = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$headprefix) . "'");
    $database->mysqlQuery("SET @branchname = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$branchname) . "'");
    $database->mysqlQuery("SET @address = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$address) . "'");
    $database->mysqlQuery("SET @branchprefix = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$branchprefix) . "'");
    $database->mysqlQuery("SET @expoversion = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$expoversion) . "'");
    $database->mysqlQuery("SET @androidapkname = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$androidapkname) . "'");
    $database->mysqlQuery("SET @androidapkcode = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$androidapkcode) . "'");
    
    $sq=$database->mysqlQuery("CALL  proc_inital_setup(@head_office_name,@hoaddress,@corpname,@headprefix,@branchname,@address,@branchprefix,@expoversion,@androidapkname,@androidapkcode,@message)");
    //echo "CALL  proc_inital_setup(@head_office_name,@hoaddress,@corpname,@headprefix,@branchname,@address,@branchprefix,@androidapkname,@androidapkcode,@message)";exit();
    $rs = $database->mysqlQuery( 'SELECT @message AS message' );
    while($row = mysqli_fetch_array($rs))
    {
	$msg= $row['message'];
        echo '<script language="javascript">';
        echo "if(!alert('Database refreshed')) document.location = '../index.php';";
        echo '</script>';
        
        
    }
    
    
}else{
    
    echo '<script language="javascript">';
    echo 'alert("All fields must be filled")';
    echo '</script>';
    //$msg= "All fields must be filled";
}
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> POS Installation</title>

<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<script src="../js/jquery-1.10.2.min.js"></script>  
<style>.form-group { margin-bottom: 25px;}</style>
</head>

<body>

<div class="main_header_wrapper">
   
      <div class="container-fluid">
      <div class="container">
      
       
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top_phno_container">
       <div class="navbar-brand_main"><img src="images/logo.png"></div>
      
        	
         </div>
        <!-- Brand and toggle get grouped for better mobile display -->
 </div>
 
 </div>
 </div>
         
        
         <div class="container">
        <div class="row">
        
      
        
         <div class="col-lg-12 keyftur_head" style="color:#525252;font-size:33px; margin:0px 0px 15px 0px;margin-top:15px;">
<span>Installation Options - STEP 2</span></div>

  <div class="col-lg-12 keyftur_head_first" style="color:#f5351b;font-size:21px; margin:0px 0px 0px 0px;padding-top:0px;padding-bottom:10px;">
MAKE FRESH DATABASE (OPTIONAL) - Database Name</div>

        <div class="main_container" style="padding-bottom:20px;">
        
        
            
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style=" height:auto;margin-top:20px;">
            	
               		<form name="frm_step2" method="post" action="">
            			
                        
                            
                            <!--<label><?= ($msg!="")? $msg : "" ?></label>
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Head office name</div>
                           <div class="field_erro_txt" id ="er_honame"></div>
                           <input style="height: 40px;" type="text" class="form-control" placeholder="Head office name*" id="honame" name="honame" required>
                            </div>-->
                            
                            
                           <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Head Office Address</div>
                           <div class="field_erro_txt" id ="er_hoaddress"></div>
                           <textarea style="float:left; height:100px" class="form-control" placeholder="Head Office Address" rows="5" name="hoaddress"></textarea>
                            </div>
                            
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Corporate Name</div>
                           <div class="field_erro_txt" id ="er_corpname"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Corporate Name *" name="corpname">
                            </div>
                            
                            
                              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Head Prefix</div>
                           <div class="field_erro_txt" id ="er_headprefix"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Head Prefix *" name="headprefix">
                            </div>-->
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Branch Name</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Branch Name *" name="branchname">
                            <div class="field_erro_txt" id ="er_branchname"></div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Address</div>
                            <textarea style="float:left; height:100px" class="form-control" placeholder="Address" rows="5" name="address"></textarea>
                            <div class="field_erro_txt" id ="er_address"></div>
                            </div>
                            
                            
                            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Branch Prefix</div>
                           <div class="field_erro_txt" id ="er_branchprefix"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Branch Prefix *" name="branchprefix">
                            </div>-->
                            
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Expodine version</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Expodine version *" name="expoversion">
                            <div class="field_erro_txt" id ="er_expoversion"></div>
                            </div>
                            
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Apk Version  Name</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Android Apk Name *" name="androidapkname">
                            <div class="field_erro_txt" id ="er_androidapkname"></div>
                            </div>
                            
                            
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Apk Version  Code</div>
                           <div class="field_erro_txt" id ="er_androidapkcode"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Android Apk Code *" name="androidapkcode">
                            </div>
                            
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container"></div>
                           <a  class="button_bottom"  role="button" id="btn_execute" name="btn_execute" style="width: 180px;">EXECUTE & PROCEED</a>  
                            </div> 
                        
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                            
                            <table class="excel_upload_table">
                                <tbody>
                                    <tr id="">
                                        <td>Excel Upload - <strong style="text-decoration:underline">GRAM</strong></td>
                                        <td><input type="file" name="excel_upload_gram" id="excel_upload_gram"></td>
                                        <td><a class="button_xlmudpdates" id="excel_gram" href="#" onclick="submitupload('excel_gram')">Submit Excel</a> </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                                 
                                 
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                 <a  class="button_bottom" href="../index.php" role="button" onclick="#" style="margin-left:15px;width: 160px;background-color:#ca2d2d !important;float:right">LOGIN </a>
                            </div>
                            
                          
                     
                        
                     </form>   
                     
                        </div>

                        </div>
  </div></div>
 
  
 
  <div class="container-fluid" style="background:#262626; min-height:55px;text-align:center;width:100%;">
          <div class="container foot_last">
        Explore IT Solutions. All Rights Reserved. Privacy Policy | Terms of Use
         </div>
     </div>


</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
$("#btn_execute").click(function(){
    
    /*if( document.frm_step2.honame.value == "" )
         {
            //alert( "Please provide your Database name!" );
            document.getElementById('er_honame').innerHTML="Please provide your Database name!";
            document.frm_step2.honame.focus() ;
            return false;
            
         }*/
         /*if( document.frm_step2.hoaddress.value == "" )
         {
            //alert( "Please provide your host name!" );
           document.getElementById('er_hoaddress').innerHTML="Please provide your host name!";
           document.frm_step2.hoaddress.focus() ;
            return false;
         }
         if( document.frm_step2.corpname.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_corpname').innerHTML="Please provide your user name!";
            document.frm_step2.corpname.focus() ;
            return false;
         }
         if( document.frm_step2.headprefix.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_headprefix').innerHTML="Please provide your user name!";
            document.frm_step2.headprefix.focus() ;
            return false;
         }*/
         if( document.frm_step2.branchname.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_branchname').innerHTML="Please provide your branch name!";
            document.frm_step2.branchname.focus() ;
            return false;
         }
          if( document.frm_step2.address.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_address').innerHTML="Please provide your address!";
            document.frm_step2.address.focus() ;
            return false;
         }
         /* if( document.frm_step2.branchprefix.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_branchprefix').innerHTML="Please provide your user name!";
            document.frm_step2.branchprefix.focus() ;
            return false;
         }*/
              if( document.frm_step2.expoversion.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_expoversion').innerHTML="Please provide your expodive version!";
            document.frm_step2.expoversion.focus() ;
            return false;
         }
              if( document.frm_step2.androidapkname.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_androidapkname').innerHTML="Please provide your apk version name!";
            document.frm_step2.androidapkname.focus() ;
            return false;
         }
              if( document.frm_step2.androidapkcode.value == "" )
         {
            //alert( "Please provide your user name!" );
            document.getElementById('er_androidapkcode').innerHTML="Please provide your apk version code!";
            document.frm_step2.androidapkcode.focus() ;
            return false;
         }
           

       document.frm_step2.submit();
      
       //alert("The paragraph was clicked.");
      //$("#frm_step1").submit();
});    
    
});
   

</script>
