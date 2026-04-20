<?php

/*include("../database.class.php"); // DB Connection class
$database = new Database(); 
$_SESSION['install_username']=$username;
	$_SESSION['install_password']=$password;
	$_SESSION['install_hostname']=$servername;
	$_SESSION['install_dbname']=$dbname;
*/
session_start();

error_reporting(0);
//ini_set('max_execution_time', 1800); 
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';


if(isset($_REQUEST['db'])) 
{
	
	$_SESSION["db_skip"]=$_REQUEST['db'];
	/*if(isset($_REQUEST['status']))
	{
		if($_REQUEST['status']==1)
		{
		$_SESSION['execute_btn_chk']=1;
		}else if($_REQUEST['status']==2)
		{
		$_SESSION['excel_btn_chk']=1;
		}
	}*/
	header("Location: step-second.php");
}else
{
	
	$_SESSION["db_skip"]=$_SESSION['install_dbname'];
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['branchname'])!=""){
/*if($_REQUEST['honame']!="" && $_REQUEST['hoaddress']!="" && $_REQUEST['corpname']!="" && $_REQUEST['headprefix']!="" && $_REQUEST['branchname']!="" && $_REQUEST['address']!="" && $_REQUEST['branchprefix']!="" && $_REQUEST['androidapkname']!=""&& $_REQUEST['androidapkcode']!=""){*/
if($_REQUEST['branchname']!="" && $_REQUEST['address']!="" && $_REQUEST['expoversion']!="" && $_REQUEST['androidapkname']!=""&& $_REQUEST['androidapkcode']!=""){  

$conn_skip = new mysqli($_SESSION['install_hostname'], $_SESSION['install_username'], $_SESSION['install_password']);
	mysqli_select_db($conn_skip,$_SESSION["db_skip"]);  
    /*$honame = $_REQUEST['honame'];
    $hoaddress = $_REQUEST['hoaddress'];
    $corpname = $_REQUEST['corpname'];
    $headprefix = $_REQUEST['headprefix'];*/
    $branchname = $_REQUEST['branchname'];
    $address = $_REQUEST['address'];
    //$branchprefix = $_REQUEST['branchprefix'];
    $expoversion = $_REQUEST['expoversion'];
    $androidapkname = $_REQUEST['androidapkname'];
    $androidapkcode = $_REQUEST['androidapkcode'];
	
	$_SESSION['branchname_install']=$branchname;
	$_SESSION['address_install']=$address;
	$_SESSION['expoversion_install']=$expoversion;
	$_SESSION['androidapkname_install']=$androidapkname;
	$_SESSION['androidapkcode_install']=$androidapkcode;
	
    $message = "";
   // branchname address  version_code  apk_version_name  apk_version_code Message
    /*$conn_skip->query("SET @head_office_name = " . "'" . mysqli_real_escape_string($conn_skip,$honame) . "'");
    $conn_skip->query("SET @hoaddress = " . "'" . mysqli_real_escape_string($conn_skip,$hoaddress) . "'");
    $conn_skip->query("SET @corpname = " . "'" . mysqli_real_escape_string($conn_skip,$corpname) . "'");
    $conn_skip->query("SET @headprefix = " . "'" . mysqli_real_escape_string($conn_skip,$headprefix) . "'");*/
    $conn_skip->query("SET @branchname = " . "'" . mysqli_real_escape_string($conn_skip,$branchname) . "'");
    $conn_skip->query("SET @address = " . "'" . mysqli_real_escape_string($conn_skip,$address) . "'");
   // $conn_skip->query("SET @branchprefix = " . "'" . mysqli_real_escape_string($conn_skip,$branchprefix) . "'");
    $conn_skip->query("SET @version_code = " . "'" . mysqli_real_escape_string($conn_skip,$expoversion) . "'");
    $conn_skip->query("SET @apk_version_name = " . "'" . mysqli_real_escape_string($conn_skip,$androidapkname) . "'");
    $conn_skip->query("SET @apk_version_code = " . "'" . mysqli_real_escape_string($conn_skip,$androidapkcode) . "'");
    
    $sq=$conn_skip->query("CALL  proc_inital_setup(@branchname,@address,@version_code,@apk_version_name,@apk_version_code,@Message)");
    //echo "CALL  proc_inital_setup(@head_office_name,@hoaddress,@corpname,@headprefix,@branchname,@address,@branchprefix,@androidapkname,@androidapkcode,@message)";exit();
    $rs = $conn_skip->query( 'SELECT @Message AS Message' );
    while($row = mysqli_fetch_array($rs))
    {
	$msg= $row['Message'];
        echo '<script language="javascript">';
       // echo "if(!alert('Database refreshed')) document.location = 'step-second.php?db='".$_SESSION["db_skip"]."';";
	   echo ' $(".branchconfig").css("display","none");
	  $(".loading_popup_overlay").css("display","none");';
	  echo "if(!alert('Database refreshed')) document.location = 'step-second.php?db='".$_SESSION["db_skip"]."'&status=1";
        echo '</script>';
        
        
    }
    
    
}else{
    
    echo '<script language="javascript">';
    echo 'alert("All fields must be filled")';
    echo '</script>';
    //$msg= "All fields must be filled";
}
}


//excel upload
define("HOST_NAME_INSTALL",$_SESSION['install_hostname']);
define("USER_NAME_INSTALL",$_SESSION['install_username']);
define("PASSWORD_INSTALL",$_SESSION['install_password']);
define("DATABASE_NAME_INSTALL",$_SESSION['db_skip']);
include("install_db.class.php"); // DB Connection class
$database_install = new install_dbconnection();

 /*$dbconn;
$this->dbconn = mysqli_connect($_SESSION['install_hostname'], $_SESSION['install_username'], $_SESSION['install_password'],$_SESSION["db_skip"]);
	mysqli_select_db($this->dbconn,$_SESSION["db_skip"]);*/
 
	

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['typeofupload']!=""){
	
	
	
	
	
		if ( $_FILES['excel_upload_install']['tmp_name'])
		  {
			
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
                        if($_FILES['excel_upload_install']['tmp_name']){
                            $file=$_FILES["excel_upload_install"]["name"];
                    
                        move_uploaded_file($_FILES['excel_upload_install']['tmp_name'], "menu_upload/".$file);
                        $file1="menu_upload/".$file;
                            
                            
                            $excel->read($file1);
                            /*unlink($_SESSION['s_excelfilelocation']);
                            $uploadfile=$_SESSION['s_excelfilelocation'];
                            move_uploaded_file($_FILES['excel_upload_install']['tmp_name'], $uploadfile);*/
                        }
                       
                     
			$sheet=$excel->sheets[1];
			$x = 2;$itemshortcode='';
                        
                      
			while($x <= $sheet['numRows']) {
                            
                            if(($sheet['cells'][$x][1]!='')) {
                                //echo $x;
				  //$y = 1;
				  $id='';$kotname='';
				  //while($y <= $sheet['numCols']) {
                                
					  if(isset($sheet['cells'][$x][1]))
					  {
						  $insertion['CATEGORY'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][1]));
					  }
					  if(isset($sheet['cells'][$x][2]))
					  {
						  $insertion['SUB_CATEGORY'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][2]));
					  }
                                                                                                                                                                            else {
                                                                                                                                                                                                  $insertion['SUB_CATEGORY'] ="";
                                                                                                                                                                           }
					  if(isset($sheet['cells'][$x][3]))
					  {
						  $insertion['MENU_NAME'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][3]));
                                                  $insertion['ITEM_SHORTCODE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim(substr($sheet['cells'][$x][3],0,16)));
                                                  
                                          }
					  if(isset($sheet['cells'][$x][4]))
					  {  
                                         
						  $insertion['MENU_CODE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][4]));
					  
                                                  
                                          }
					  if(isset($sheet['cells'][$x][5]))
					  {
						  $insertion['KOT_KITCHEN'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][5]));
					  }
					  if(isset($sheet['cells'][$x][6]))
					  {
						  $insertion['DIET'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][6]));
					  }
					  if(isset($sheet['cells'][$x][7]))
					  {
						  $insertion['DESCRIPTION'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][7]));
					  }
                                         /* if($_REQUEST['typeofupload']=="excel"){
                                              
					  if(isset($sheet['cells'][$x][8]))
					  {
						  $insertion['UNIT'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][8]));
					  }
                                            
					  //echo $sheet['cells'][$x][9];
                                          if(isset($sheet['cells'][$x][9]))
					  {
						  $insertion['RATE_1'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][9]));
					  }
                                          
					  if(isset($sheet['cells'][$x][10]))
					  {
						  $insertion['RATE_2'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][10]));
						  $kotname=$sheet['cells'][$x][10];
					  }
					  if(isset($sheet['cells'][$x][11]))
					  {
						  $insertion['RATE_3'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][11]));
					  }
					  if(isset($sheet['cells'][$x][12]))
					  {
						  $insertion['RATE_4'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][12]));
					  }
					  if(isset($sheet['cells'][$x][13]))
					  {
						  $insertion['RATE_5'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][13]));
					  }
					  if(isset($sheet['cells'][$x][14]))
					  {
						  $insertion['RATE_6'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][14]));
					  }
					  if(isset($sheet['cells'][$x][15]))
					  {
						  $insertion['DYNAMIC_RATE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][15]));
					  }
					  if(isset($sheet['cells'][$x][16]))
					  {
						  $insertion['DAILY_STOCK'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][16]));
					  }
					  if(isset($sheet['cells'][$x][17]))
					  {
						  $insertion['STOCK_IN_NUMBERS'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][17]));
					  }
					  if(isset($sheet['cells'][$x][18]))
					  {
						  $insertion['ESTIMATED_TIME'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][18]));
					  }
					  if(isset($sheet['cells'][$x][19]))
					  {
						  $insertion['PREPARATION_MODE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][19]));
					  }
                                          $insertion['TYPE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim('Portion'));
                                        }
                                          else if($_REQUEST['typeofupload']=="excel_gram"){*/
                                            
                                            
                                            if(isset($sheet['cells'][$x][8]))
                                            {
						  $insertion['TYPE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][8]));
                                            }
                                            
                                            if(isset($sheet['cells'][$x][9]))
                                            {
						  $insertion['UNIT'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][9]));
                                            }
                                            if(isset($sheet['cells'][$x][10]))
                                            {
						  $insertion['WEIGHT'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][10]));
                                            }
                                            //echo $sheet['cells'][$x][9];
                                            if(isset($sheet['cells'][$x][11]))
                                            {
						  $insertion['RATE_1'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][11]));
                                            }
                                            if(isset($sheet['cells'][$x][12]))
                                            {
						  $insertion['RATE_2'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][12]));
						  $kotname=$sheet['cells'][$x][12];
                                            }
                                            if(isset($sheet['cells'][$x][13]))
                                            {
						  $insertion['RATE_3'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][13]));
                                            }
                                            if(isset($sheet['cells'][$x][14]))
                                            {
						  $insertion['RATE_4'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][14]));
                                            }
                                            if(isset($sheet['cells'][$x][15]))
                                            {
						  $insertion['RATE_5'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][15]));
                                            }
                                            if(isset($sheet['cells'][$x][16]))
                                            {
						  $insertion['RATE_6'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][16]));
                                            }
                                            if(isset($sheet['cells'][$x][17]))
                                            {
						  $insertion['DYNAMIC_RATE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][17]));
                                            }
                                            if(isset($sheet['cells'][$x][18]))
                                            {
						  $insertion['DAILY_STOCK'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][18]));
                                            }
                                            if(isset($sheet['cells'][$x][19]))
                                            {
						  $insertion['STOCK_IN_NUMBERS'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][19]));
                                            }
                                            if(isset($sheet['cells'][$x][20]))
                                            {
						  $insertion['ESTIMATED_TIME'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][20]));
                                            }
                                            if(isset($sheet['cells'][$x][21]))
                                            {
						  $insertion['PREPARATION_MODE'] 		=  mysqli_real_escape_string($database_install->dbconn,trim($sheet['cells'][$x][21]));
                                            }
                                           
                                           // }   
                                              
                                            //print_r($insertion);
                                          $sql=$database_install->check_duplicate_entry('tbl_menu_import',$insertion);
					  if($sql!=1)
					  {
					  $insertid       =  $database_install->insert('tbl_menu_import',$insertion);
                                         // echo $insertid;
					  }
					//$y++;
				  //} 
                            }	 
			   $x++;
                          
                        
                    }
			
			//procedure calling b4 b9
			$sheet=$excel->sheets[0];
	/*echo $sheet['cells'][4][2];
	echo $sheet['cells'][5][2];
	echo $sheet['cells'][6][2];
	echo $sheet['cells'][7][2];
	echo $sheet['cells'][8][2];
	echo $sheet['cells'][9][2];*/
			
			try {
			$database_install->mysqlQuery("SET @RATE_1_FOR = " . "'" . mysqli_real_escape_string($database_install->dbconn, $sheet['cells'][4][2]) . "'");
			$database_install->mysqlQuery("SET @RATE_2_FOR = " . "'" . mysqli_real_escape_string($database_install->dbconn,$sheet['cells'][5][2]) . "'");
			$database_install->mysqlQuery("SET @RATE_3_FOR = " . "'" . mysqli_real_escape_string($database_install->dbconn, $sheet['cells'][6][2]) . "'");
			$database_install->mysqlQuery("SET @RATE_4_FOR = " . "'" . mysqli_real_escape_string($database_install->dbconn,$sheet['cells'][7][2]) . "'");
			$database_install->mysqlQuery("SET @RATE_5_FOR = " . "'" . mysqli_real_escape_string($database_install->dbconn,$sheet['cells'][8][2]) . "'");
			$database_install->mysqlQuery("SET @Message = " . "''");
			$sq=$database_install->mysqlQuery("CALL proc_menu_import(@Message,@RATE_1_FOR,@RATE_2_FOR,@RATE_3_FOR,@RATE_4_FOR,@RATE_5_FOR)") or $database_install->throw_ex(mysqli_error($database_install->dbconn));
			
			$returnmsg="";
			if (!headers_sent())
    {    
      // header('Location: step-second.php?db='.$_SESSION["db_skip"]);
		
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo ' $(".excelconfig").css("display","none");
	  $(".loading_popup_overlay").css("display","none");';
	//  echo "if(!alert('Database refreshed')) document.location = 'step-second.php?db='".$_SESSION["db_skip"]."'&status=2";
        echo '</script>';
        echo '<noscript>';
        //echo '<meta http-equiv="refresh" content="0;url='step-second.php?db='".$_SESSION["db_skip"]."'&status=2" />';
        echo '</noscript>'; exit;
    }	
		   
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg;exit();
	  }
		
			
		  }
		  
	 
//exit();

	
	
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
MAKE FRESH DATABASE (OPTIONAL)</div>

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
                           <input id="valid_name" onkeyup="valid_name()" style="height: 40px;" type="text" class="form-control" placeholder="Branch Name *" name="branchname" value="<?=$_SESSION['branchname_install']?>">
                            <div class="field_erro_txt" id ="er_branchname"></div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Address</div>
                           <textarea id="valid_addr" onkeyup="valid_addr()"  style="float:left; height:100px" class="form-control" placeholder="Address" rows="5" name="address"><?=$_SESSION['address_install']?></textarea>
                            <div class="field_erro_txt" id ="er_address"></div>
                            </div>
                            
                            
                            <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Branch Prefix</div>
                           <div class="field_erro_txt" id ="er_branchprefix"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Branch Prefix *" name="branchprefix">
                            </div>-->
                            
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Expodine version</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Expodine version *" name="expoversion" value="<?=$_SESSION['expoversion_install']?>">
                            <div class="field_erro_txt" id ="er_expoversion"></div>
                            </div>
                            
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Apk Version  Name</div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Android Apk Name *" name="androidapkname" value="<?=$_SESSION['androidapkname_install']?>">
                            <div class="field_erro_txt" id ="er_androidapkname"></div>
                            </div>
                            
                            
                                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container">Apk Version  Code</div>
                           <div class="field_erro_txt" id ="er_androidapkcode"></div>
                            <input style="height: 40px;" type="text" class="form-control" placeholder="Android Apk Code *" name="androidapkcode" value="<?=$_SESSION['androidapkcode_install']?>">
                            </div>
                            
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                           <div class="main_name_container"></div>
                           
                           <a  class="button_bottom"  role="button" id="btn_execute" name="btn_execute" style="width: 180px;">EXECUTE & PROCEED</a> 
                            <!--<a  class="button_bottom" href="../index.php" role="button" onclick="#" style="margin-left:15px;width: 160px;background-color:#ca2d2d !important;">SKIP & PROCEED </a>-->
                            </div>
                           </form>
                            <form enctype="multipart/form-data"   method="post" name="submitxmlform" id="submitxmlform">
                            <input type="hidden" name="typeofupload" id="typeofupload" >
                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                            
                            <table class="excel_upload_table">
                                <tbody>
                                    <tr id="">
                                        <td>Excel Upload </td>
                                        <td><input type="file" name="excel_upload_install" id="excel_upload_install"><br>
                                         <div class="load_error1" style="display:none; color:red;line-height: 30px;">Upload Format error.(.xls)</div>
                                        </td>
                                        <td>
                                         
                           <a class="button_xlmudpdates" id="excel_upload" onclick="submitupload('excel_upload')">Submit Excel</a>
                           
                           </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            
           
           
                        </div>
                                 
                                 
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                 <a  class="button_bottom" href="../index.php" role="button" onclick="#" style="margin-left:15px;width: 160px;background-color:#ca2d2d !important;float:right">LOGIN </a>
                            </div>
                     
                        
                     </form>  
    <div class="loading_popup_overlay" style="display:none"></div>                 
       <div class="loading_popup branchconfig" style="display:none">
    	<!--<div class="language_close_btn"></div>-->
    	 <div class="loading_popup_headiing">Expodine</div>
          <div class="loading_popup_headiing_text">DataBase configuration processing....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        	<img src="images/processing.gif">
         </div>
        <div class="loading_popup_headiing_text" style="margin-top: 8px;">Please wait....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        </div>
        </div>
        
        <div class="loading_popup excelconfig" style="display:none">
    	<!--<div class="language_close_btn"></div>-->
    	 <div class="loading_popup_headiing">Expodine</div>
          <div class="loading_popup_headiing_text">Excel importing....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        	<img src="images/processing.gif">
         </div>
        <div class="loading_popup_headiing_text" style="margin-top: 8px;">Please wait....</div>
        <div class="loading_popup_area" style="margin-bottom: 8px;">
        </div>
        </div>
                     
                     
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
    
    $("#valid_name").on("keyup", function () {
       $(this).val($(this).val().replace(/[^a-zA-Z0-9 ]/g, ""));
    });

    
    $("#valid_addr").on("keyup", function () {
         $(this).val($(this).val().replace(/[^a-zA-Z0-9 ,]/g, ""));
    });
    
    
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
           
 //loading_popup_overlay
	  $(".branchconfig").css("display","block");
	  $(".loading_popup_overlay").css("display","block");
       document.frm_step2.submit();
      
       //alert("The paragraph was clicked.");
      //$("#frm_step1").submit();
});    
    
});
   
function submitupload(typeval)
{   
    //alert('ggg');
   // $("#excel_portion").css('pointer-events','none');
   // $("#excel_upload").css('pointer-events','none');
	
        if(typeval=="excel_upload")
	{//alert('2');
            
		if (hasExtension('excel_upload_install', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);
                         $("#excel_gram").css('pointer-events','none');
			document.submitxmlform.submit();
		}else
		{       $("#excel_upload").css('pointer-events','inherit');
                    
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
	
	
	 $(".excelconfig").css("display","block");
	  $(".loading_popup_overlay").css("display","block");
        
}
function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}





</script>
