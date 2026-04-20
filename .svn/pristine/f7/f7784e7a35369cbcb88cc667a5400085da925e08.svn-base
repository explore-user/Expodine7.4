<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
//include 'excel_reader.php';     // include the class
error_reporting(0);
//ini_set('max_execution_time', 1800); 
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['langauage_upload']="arabic";
$_SESSION['pagid']=1;
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_kotcountermaster WHERE kr_kotcode = '" .$_REQUEST['id']."'");
 //header("location:kot_counter_master.php?msg=1");
	 if (!headers_sent())
    {    
        header('Location: kot_counter_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="kot_counter_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=kot_counter_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }

//category
   $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_menumaincategory WHERE 	mmy_maincategoryid = '" .$_REQUEST['id']."'");
 //header("location:category_master.php?msg=1");
	 if (!headers_sent())
    {    
        header('Location: category_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="category_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=category_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }

//    subcategory
    $id=$_REQUEST['id'];
if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menusubcategory SET  msy_active='Y' WHERE msy_subcategoryid = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_menusubcategory SET  msy_active='N' WHERE msy_subcategoryid = '" .$_REQUEST['id']."'");
	}
	//header("location:sub_category_master.php?msg=3");
	 if (!headers_sent())
    {    
        header('Location: sub_category_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="sub_category_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=sub_category_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
    
     $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_portionmaster WHERE pm_id = '" .$_REQUEST['id']."'");
 //header("location:portion_master.php?msg=1");
 		 if (!headers_sent())
    {    
        header('Location: portion_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="portion_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=portion_master.php?msg=1" />';
        echo '</noscript>'; exit;
    }
      
   
    $id=$_REQUEST['id'];
	if($_REQUEST['delete']=="yes")
	{
		$database->mysqlQuery("UPDATE tbl_menumaster SET mr_active = 'Y' WHERE mr_menuid = '" .$_REQUEST['id']."'");
	}else
	{
		$database->mysqlQuery("UPDATE tbl_menumaster SET mr_active = 'N' WHERE mr_menuid = '" .$_REQUEST['id']."'");
	}
  // header("location:menu.php");
 	 if (!headers_sent())
    {    
        header('Location: menu.php');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="menu.php";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=menu.php" />';
        echo '</noscript>'; exit;
    }
        
    //portion
    $id=$_REQUEST['id'];
 $database->mysqlQuery("DELETE FROM tbl_portionmaster WHERE pm_id = '" .$_REQUEST['id']."'");
 //header("location:portion_master.php?msg=1");
 		 if (!headers_sent())
    {    
        header('Location: portion_master.php?msg=1');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="portion_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=portion_master.php?msg=1" />';
        echo '</noscript>'; exit;
       }
    
  }
        
    
if($_SERVER['REQUEST_METHOD']=='POST' && ($_REQUEST['typeofupload']=="excel" || $_REQUEST['typeofupload']=='excel_gram'))
{
	
	
		if ( $_FILES['excel_upload']['tmp_name'] || $_FILES['excel_upload_gram']['tmp_name'] )
		  {
			
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
                        if($_FILES['excel_upload']['tmp_name']){
                            $excel->read($_FILES['excel_upload']['tmp_name']);
                            unlink($_SESSION['s_excelfilelocation']);
                            $uploadfile=$_SESSION['s_excelfilelocation'];
                            move_uploaded_file($_FILES['excel_upload']['tmp_name'], $uploadfile);
                        }
                        else if($_FILES['excel_upload_gram']['tmp_name']){
                            $excel->read($_FILES['excel_upload_gram']['tmp_name']);
                            unlink($_SESSION['s_excelfilelocation']);
                            $uploadfile=$_SESSION['s_excelfilelocation'];
                            move_uploaded_file($_FILES['excel_upload_gram']['tmp_name'], $uploadfile);
                        }
			$sheet=$excel->sheets[1];
			$x = 2;$itemshortcode='';
			while($x <= $sheet['numRows']) {
                            
                            if($sheet['cells'][$x][1]!=''){
                                //echo $x;
				  //$y = 1;
				  $id='';$kotname='';
				  //while($y <= $sheet['numCols']) {
					  if($sheet['cells'][$x][1])
					  {
						  $insertion['CATEGORY'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][1]));
					  }
					  if($sheet['cells'][$x][2])
					  {
						  $insertion['SUB_CATEGORY'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][2]));
					  }
                                                                                                                                                                            else {
                                                                                                                                                                                                  $insertion['SUB_CATEGORY'] ="";
                                                                                                                                                                           }
					  if($sheet['cells'][$x][3])
					  {
						  $insertion['MENU_NAME'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][3]));
                                                  $insertion['ITEM_SHORTCODE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim(substr($sheet['cells'][$x][3],0,16)));
                                                  
                                          }
					  if($sheet['cells'][$x][4])
					  {  
                                         
						  $insertion['MENU_CODE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][4]));
					  
                                                  
                                          }
					  if($sheet['cells'][$x][5])
					  {
						  $insertion['KOT_KITCHEN'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][5]));
					  }
					  if($sheet['cells'][$x][6])
					  {
						  $insertion['DIET'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][6]));
					  }
					  if($sheet['cells'][$x][7])
					  {
						  $insertion['DESCRIPTION'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][7]));
					  }
                                          if($_REQUEST['typeofupload']=="excel"){
                                              
					  if($sheet['cells'][$x][8])
					  {
						  $insertion['UNIT'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][8]));
					  }
                                            
					  //echo $sheet['cells'][$x][9];
                                          if($sheet['cells'][$x][9])
					  {
						  $insertion['RATE_1'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][9]));
					  }
                                          
					  if($sheet['cells'][$x][10])
					  {
						  $insertion['RATE_2'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][10]));
						  $kotname=$sheet['cells'][$x][10];
					  }
					  if($sheet['cells'][$x][11])
					  {
						  $insertion['RATE_3'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][11]));
					  }
					  if($sheet['cells'][$x][12])
					  {
						  $insertion['RATE_4'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][12]));
					  }
					  if($sheet['cells'][$x][13])
					  {
						  $insertion['RATE_5'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][13]));
					  }
					  if($sheet['cells'][$x][14])
					  {
						  $insertion['RATE_6'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][14]));
					  }
					  if($sheet['cells'][$x][15])
					  {
						  $insertion['DYNAMIC_RATE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][15]));
					  }
					  if($sheet['cells'][$x][16])
					  {
						  $insertion['DAILY_STOCK'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][16]));
					  }
					  if($sheet['cells'][$x][17])
					  {
						  $insertion['STOCK_IN_NUMBERS'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][17]));
					  }
					  if($sheet['cells'][$x][18])
					  {
						  $insertion['ESTIMATED_TIME'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][18]));
					  }
					  if($sheet['cells'][$x][19])
					  {
						  $insertion['PREPARATION_MODE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][19]));
					  }
                                          $insertion['TYPE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim('Portion'));
                                        }
                                          else if($_REQUEST['typeofupload']=="excel_gram"){
                                            
                                            
                                            if($sheet['cells'][$x][8])
                                            {
						  $insertion['TYPE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][8]));
                                            }
                                            
                                            if($sheet['cells'][$x][9])
                                            {
						  $insertion['UNIT'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][9]));
                                            }
                                            if($sheet['cells'][$x][10])
                                            {
						  $insertion['WEIGHT'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][10]));
                                            }
                                            //echo $sheet['cells'][$x][9];
                                            if($sheet['cells'][$x][11])
                                            {
						  $insertion['RATE_1'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][11]));
                                            }
                                            if($sheet['cells'][$x][12])
                                            {
						  $insertion['RATE_2'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][12]));
						  $kotname=$sheet['cells'][$x][12];
                                            }
                                            if($sheet['cells'][$x][13])
                                            {
						  $insertion['RATE_3'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][13]));
                                            }
                                            if($sheet['cells'][$x][14])
                                            {
						  $insertion['RATE_4'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][14]));
                                            }
                                            if($sheet['cells'][$x][15])
                                            {
						  $insertion['RATE_5'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][15]));
                                            }
                                            if($sheet['cells'][$x][16])
                                            {
						  $insertion['RATE_6'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][16]));
                                            }
                                            if($sheet['cells'][$x][17])
                                            {
						  $insertion['DYNAMIC_RATE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][17]));
                                            }
                                            if($sheet['cells'][$x][18])
                                            {
						  $insertion['DAILY_STOCK'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][18]));
                                            }
                                            if($sheet['cells'][$x][19])
                                            {
						  $insertion['STOCK_IN_NUMBERS'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][19]));
                                            }
                                            if($sheet['cells'][$x][20])
                                            {
						  $insertion['ESTIMATED_TIME'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][20]));
                                            }
                                            if($sheet['cells'][$x][21])
                                            {
						  $insertion['PREPARATION_MODE'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][21]));
                                            }
                                           
                                            }   
                                              
                                            //print_r($insertion);
                                          $sql=$database->check_duplicate_entry('tbl_menu_import',$insertion);
					  if($sql!=1)
					  {
					  $insertid       =  $database->insert('tbl_menu_import',$insertion);
                                          //echo $insertid;
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
			$database->mysqlQuery("SET @RATE_1_FOR = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $sheet['cells'][4][2]) . "'");
			$database->mysqlQuery("SET @RATE_2_FOR = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$sheet['cells'][5][2]) . "'");
			$database->mysqlQuery("SET @RATE_3_FOR = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $sheet['cells'][6][2]) . "'");
			$database->mysqlQuery("SET @RATE_4_FOR = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$sheet['cells'][7][2]) . "'");
			$database->mysqlQuery("SET @RATE_5_FOR = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$sheet['cells'][8][2]) . "'");
			$database->mysqlQuery("SET @Message = " . "''");
			$sq=$database->mysqlQuery("CALL proc_menu_import(@Message,@RATE_1_FOR,@RATE_2_FOR,@RATE_3_FOR,@RATE_4_FOR,@RATE_5_FOR)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			
			$returnmsg="";
		   
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg;exit();
	  }
			
			
		  }
		  
	 if (!headers_sent())
    {    
        header('Location: excel_updates.php?msg=4');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="excel_updates.php?msg=4";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=excel_updates.php?msg=4" />';
        echo '</noscript>'; exit;
    }
//exit();
}
if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload']=="convert")
{
	//from table to excel and xml
			 $tablename=array();
			$tablename[0]="tbl_kotcountermaster";
			$tablename[1]="tbl_menumaincategory";
			$tablename[2]="tbl_menusubcategory";
			$tablename[3]="tbl_portionmaster";
			$tablename[4]="tbl_preferencemaster";
			$tablename[5]="tbl_departmentmaster";
			$tablename[6]="tbl_designationmaster";
			$tablename[7]="tbl_staffmaster";
			$tablename[8]="tbl_floormaster";
			$tablename[9]="tbl_paymentmode";
			$tablename[10]="tbl_credit_types";
			$tablename[11]="tbl_tablemaster";
			$tablename[12]="tbl_discountmaster";
			$tablename[13]="tbl_corporatemaster";
			$tablename[14]="tbl_vouchermaster";
			$tablename[15]="tbl_bankmaster";
			$tablename[16]="tbl_feedbackmaster";
			$tablename[17]="tbl_menunutitionfacts";
			$tablename[18]="tbl_ingredientmaster";
			$tablename[19]="tbl_couponcompany";
			$tablename[20]="tbl_menumaster";
			
			$tagnames[0]="kotcounter";
			$tagnames[1]="category";
			$tagnames[2]="subcategory";
			$tagnames[3]="portion";
			$tagnames[4]="preference";
			$tagnames[5]="department";
			$tagnames[6]="designation";
			$tagnames[7]="staffmaster";
			$tagnames[8]="floormaster";
			$tagnames[9]="paymentmode";
			$tagnames[10]="credittypes";
			$tagnames[11]="tablemaster";
			$tagnames[12]="discount";
			$tagnames[13]="corporate";
			$tagnames[14]="voucher";
			$tagnames[15]="bankmaster";
			$tagnames[16]="feedback";
			$tagnames[17]="nutrition";
			$tagnames[18]="ingredient";
			$tagnames[19]="coupon";
			$tagnames[20]="menu";
		
			
			$fieldnames[0][0]="kr_kotcode";
			$fieldnames[0][1]="kr_kotname";
			
			$fieldnames[1][0]="mmy_maincategoryid";
			$fieldnames[1][1]="mmy_maincategoryname";
			
			$fieldnames[2][0]="msy_subcategoryid";
			$fieldnames[2][1]="msy_subcategoryname";
			
			$fieldnames[3][0]="pm_id";
			$fieldnames[3][1]="pm_portionname";
			$fieldnames[3][2]="pm_portionshortcode";
			
			
			$fieldnames[4][0]="pmr_id";
			$fieldnames[4][1]="pmr_name";
			
			$fieldnames[5][0]="der_departmentid";
			$fieldnames[5][1]="der_departmentname";
			
			$fieldnames[6][0]="dr_designationid";
			$fieldnames[6][1]="dr_designationname";
			
			$fieldnames[7][0]="ser_staffid";
			$fieldnames[7][1]="ser_firstname";
			$fieldnames[7][2]="ser_lastname";
			
			$fieldnames[8][0]="fr_floorid";
			$fieldnames[8][1]="fr_floorname";
		
			$fieldnames[9][0]="pym_id";
			$fieldnames[9][1]="pym_code";
			$fieldnames[9][2]="pym_name";
			
			$fieldnames[10][0]="ct_creditid";
			$fieldnames[10][1]="ct_credit_type";
			$fieldnames[10][2]="ct_labels";
			
			$fieldnames[11][0]="tr_tableid";
			$fieldnames[11][1]="tr_tableno";
			
			$fieldnames[12][0]="ds_discountid";
			$fieldnames[12][1]="ds_discountname";
			
			$fieldnames[13][0]="ct_corporatecode";
			$fieldnames[13][1]="ct_corporatename";
			
			$fieldnames[14][0]="vr_voucherid";
			$fieldnames[14][1]="vr_vouchername";
			
			$fieldnames[15][0]="bm_id";
			$fieldnames[15][1]="bm_name";
			
			$fieldnames[16][0]="fbm_id";
			$fieldnames[16][1]="fbm_question";
			
			$fieldnames[17][0]="mnf_menuid";
			$fieldnames[17][1]="mnf_nutrition";
			
			$fieldnames[18][0]="ir_ingredientid";
			$fieldnames[18][1]="ir_ingredientname";
			
			$fieldnames[19][0]="cy_coupid";
			$fieldnames[19][1]="cy_companyname";
			
			$fieldnames[20][0]="mr_menuid";
			$fieldnames[20][1]="mr_menuname";
			$fieldnames[20][2]="mr_itemshortcode";
			$fieldnames[20][3]="mr_itemcode";
			$fieldnames[20][4]="mr_description";
			$fieldnames[20][5]="mr_diet";
			$fieldnames[20][6]="mr_prepmode";
			
			

			
			$count_val=count($tablename);
			for($i=0;$i<=$count_val;$i++){//echo $tablename[$i];
				  $sql_login  =  $database->mysqlQuery("select * from $tablename[$i]"); 
				  $num_login   = $database->mysqlNumRows($sql_login); 
				  while($result_login  = $database->mysqlFetchArray($sql_login)) 
				  {
					  $lastid=$result_login[$fieldnames[$i][0]];
					 // $kotname=$result_login[$fieldnames[$i][1]];
					  $doc = new DOMDocument();
					  $doc->load($_SESSION['s_xmlfilelocation']);
					  $main = $doc->getElementsByTagName( $tagnames[$i] );
					  $main2 = $doc->getElementsByTagName( $lastid );
					  if($main->length != 0 && $main2->length != 0) //already
					  { $database->updateexpodine_machines(); 
						  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
						  //category subcategory subcategory portion menu preference
						   if($tagnames[$i]=="kotcounter")
						  {//echo $result_login[$fieldnames[$i][1]];die();
						  		//$child = $xml->kotcounter[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								 if($result_login[$fieldnames[$i][1]]=='')
								  {
									 $child = $xml->kotcounter[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->kotcounter[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
					  
								
						  }else if($tagnames[$i]=="category")
						  {
						  		//$child = $xml->category[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->category[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->category[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="subcategory")
						  {
						  		//$child = $xml->subcategory[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->subcategory[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->subcategory[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="portion")
						  {
						  		//$child = $xml->portion[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->portion[0]->addChild("pm_".$lastid," ");
								  }else
								  {
									   $child = $xml->portion[0]->addChild("pm_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->portion[0]->addChild("short_pm_".$lastid," ");
								  }else
								  {
									   $child = $xml->portion[0]->addChild("short_pm_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
						  }else if($tagnames[$i]=="preference")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->preference[0]->addChild("pmr_".$lastid," ");
								  }else
								  {
									   $child = $xml->preference[0]->addChild("pmr_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="department")  
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->department[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->department[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="designation")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->designation[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->designation[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="staffmaster")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->staffmaster[0]->addChild("First_".$lastid," ");
								  }else
								  {
									   $child = $xml->staffmaster[0]->addChild("First_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->staffmaster[0]->addChild("Last_".$lastid," ");
								  }else
								  {
									  $child = $xml->staffmaster[0]->addChild("Last_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
								
						  }else if($tagnames[$i]=="floormaster")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->floormaster[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->floormaster[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="paymentmode") 
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								//$child = $xml->paymentmode[0]->addChild("pcode_".$lastid,$result_login[$fieldnames[$i][1]]);
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->paymentmode[0]->addChild("pname_".$lastid," ");
								  }else
								  {
									 $child = $xml->paymentmode[0]->addChild("pname_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
						  }else if($tagnames[$i]=="credittypes")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->credittypes[0]->addChild("ctype_".$lastid," ");
								  }else
								  {
									  $child = $xml->credittypes[0]->addChild("ctype_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->credittypes[0]->addChild("clabel_".$lastid," ");
								  }else
								  {
									  $child = $xml->credittypes[0]->addChild("clabel_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								

								
						  }else if($tagnames[$i]=="tablemaster") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->tablemaster[0]->addChild($lastid," ");
								  }else
								  {
									 $child = $xml->tablemaster[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="discount") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->discount[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->discount[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="corporate") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->corporate[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->corporate[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="voucher") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->voucher[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->voucher[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="bankmaster") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->bankmaster[0]->addChild("bm_".$lastid," ");
								  }else
								  {
									  $child = $xml->bankmaster[0]->addChild("bm_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="feedback") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->feedback[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->feedback[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="nutrition") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->nutrition[0]->addChild("nutr_".$lastid," ");
								  }else
								  {
									  $child = $xml->nutrition[0]->addChild("nutr_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="ingredient") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->ingredient[0]->addChild("ir_".$lastid," ");
								  }else
								  {
									  $child = $xml->ingredient[0]->addChild("ir_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="coupon") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->coupon[0]->addChild("coup_".$lastid," ");
								  }else
								  {
									  $child = $xml->coupon[0]->addChild("coup_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="menu")
						  {
						  		//$child = $xml->menu[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->menu[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->menu[0]->addChild("shortc_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("shortc_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
								if($result_login[$fieldnames[$i][3]]=='')
								  {
									$child = $xml->menu[0]->addChild("itemc_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("itemc_".$lastid,$result_login[$fieldnames[$i][3]]);
								  }
								
								if($result_login[$fieldnames[$i][4]]=='')
								  {
									$child = $xml->menu[0]->addChild("desc_".$lastid," ");
								  }else
								  {
									 $child = $xml->menu[0]->addChild("desc_".$lastid,$result_login[$fieldnames[$i][4]]);
								  }
								
								if($result_login[$fieldnames[$i][5]]=='')
								  {
									$child = $xml->menu[0]->addChild("diet_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("diet_".$lastid,$result_login[$fieldnames[$i][5]]);
								  }
								
								if($result_login[$fieldnames[$i][6]]=='')
								  {
									$child = $xml->menu[0]->addChild("prep_".$lastid," ");
								  }else
								  {
									 $child = $xml->menu[0]->addChild("prep_".$lastid,$result_login[$fieldnames[$i][6]]);
								  }
								
								$dom = new DOMDocument('1.0');
								$dom->preserveWhiteSpace = false;
								$dom->formatOutput = true;
								$dom->loadXML($xml->asXML());
								$xml = new SimpleXMLElement($dom->saveXML());
								
						  }
						  
						 /* $dom = new DOMDocument('1.0');
						  $dom->preserveWhiteSpace = false;
						  $dom->formatOutput = true;
						  $dom->loadXML($xml->asXML());
						  $xml = new SimpleXMLElement($dom->saveXML());*/
						  $xml->asXML($_SESSION['s_xmlfilelocation']);
					  }else // not exist
					  {$database->updateexpodine_machines(); 
						  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
						  $eg=1;$ar=1;
						  foreach ($xml->$tagnames[$i] as $lang) {
							  if($lang["lang"]=="english")
							  {
								  $eg++;
							  }
							  if($lang["lang"]=="arabic")
							  {
								  $ar++; 
							  }							  
						  }
						  if($eg==1)
						  {
						  $child = $xml->addChild($tagnames[$i]);
						  $child->addAttribute("lang", "english");
						  }
						  if($ar==1)
						  {
						  $child = $xml->addChild($tagnames[$i]);
						  $child->addAttribute("lang", "arabic");
						  }	
						  //$child = $xml->kotcounter[0]->addChild($lastid,$kotname);
						  if($tagnames[$i]=="kotcounter")
						  {//echo $result_login[$fieldnames[$i][1]];die();
						  		//$child = $xml->kotcounter[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								 if($result_login[$fieldnames[$i][1]]=='')
								  {
									 $child = $xml->kotcounter[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->kotcounter[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
					  
								
						  }else if($tagnames[$i]=="category")
						  {
						  		//$child = $xml->category[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->category[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->category[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="subcategory")
						  {
						  		//$child = $xml->subcategory[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->subcategory[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->subcategory[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="portion")
						  {
						  		//$child = $xml->portion[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->portion[0]->addChild("pm_".$lastid," ");
								  }else
								  {
									   $child = $xml->portion[0]->addChild("pm_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->portion[0]->addChild("short_pm_".$lastid," ");
								  }else
								  {
									   $child = $xml->portion[0]->addChild("short_pm_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
						  }else if($tagnames[$i]=="preference")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->preference[0]->addChild("pmr_".$lastid," ");
								  }else
								  {
									   $child = $xml->preference[0]->addChild("pmr_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="department")  
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->department[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->department[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="designation")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->designation[0]->addChild($lastid," ");
								  }else
								  {
									   $child = $xml->designation[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="staffmaster")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->staffmaster[0]->addChild("First_".$lastid," ");
								  }else
								  {
									   $child = $xml->staffmaster[0]->addChild("First_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->staffmaster[0]->addChild("Last_".$lastid," ");
								  }else
								  {
									  $child = $xml->staffmaster[0]->addChild("Last_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
								
						  }else if($tagnames[$i]=="floormaster")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->floormaster[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->floormaster[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="paymentmode") 
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								//$child = $xml->paymentmode[0]->addChild("pcode_".$lastid,$result_login[$fieldnames[$i][1]]);
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->paymentmode[0]->addChild("pname_".$lastid," ");
								  }else
								  {
									 $child = $xml->paymentmode[0]->addChild("pname_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
						  }else if($tagnames[$i]=="credittypes")
						  {
						  		//$child = $xml->preference[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->credittypes[0]->addChild("ctype_".$lastid," ");
								  }else
								  {
									  $child = $xml->credittypes[0]->addChild("ctype_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->credittypes[0]->addChild("clabel_".$lastid," ");
								  }else
								  {
									  $child = $xml->credittypes[0]->addChild("clabel_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								

								
						  }else if($tagnames[$i]=="tablemaster") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->tablemaster[0]->addChild($lastid," ");
								  }else
								  {
									 $child = $xml->tablemaster[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="discount") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->discount[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->discount[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="corporate") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->corporate[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->corporate[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="voucher") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->voucher[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->voucher[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="bankmaster") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->bankmaster[0]->addChild("bm_".$lastid," ");
								  }else
								  {
									  $child = $xml->bankmaster[0]->addChild("bm_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="feedback") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->feedback[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->feedback[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="nutrition") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->nutrition[0]->addChild("nutr_".$lastid," ");
								  }else
								  {
									  $child = $xml->nutrition[0]->addChild("nutr_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="ingredient") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->ingredient[0]->addChild("ir_".$lastid," ");
								  }else
								  {
									  $child = $xml->ingredient[0]->addChild("ir_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="coupon") 
						  {
							  if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->coupon[0]->addChild("coup_".$lastid," ");
								  }else
								  {
									  $child = $xml->coupon[0]->addChild("coup_".$lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
						  }else if($tagnames[$i]=="menu")
						  {
						  		//$child = $xml->menu[0]->addChild($lastid,$result_login[$fieldnames[$i][0]]);
								if($result_login[$fieldnames[$i][1]]=='')
								  {
									$child = $xml->menu[0]->addChild($lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild($lastid,$result_login[$fieldnames[$i][1]]);
								  }
								
								if($result_login[$fieldnames[$i][2]]=='')
								  {
									$child = $xml->menu[0]->addChild("shortc_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("shortc_".$lastid,$result_login[$fieldnames[$i][2]]);
								  }
								
								if($result_login[$fieldnames[$i][3]]=='')
								  {
									$child = $xml->menu[0]->addChild("itemc_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("itemc_".$lastid,$result_login[$fieldnames[$i][3]]);
								  }
								
								if($result_login[$fieldnames[$i][4]]=='')
								  {
									$child = $xml->menu[0]->addChild("desc_".$lastid," ");
								  }else
								  {
									 $child = $xml->menu[0]->addChild("desc_".$lastid,$result_login[$fieldnames[$i][4]]);
								  }
								
								if($result_login[$fieldnames[$i][5]]=='')
								  {
									$child = $xml->menu[0]->addChild("diet_".$lastid," ");
								  }else
								  {
									  $child = $xml->menu[0]->addChild("diet_".$lastid,$result_login[$fieldnames[$i][5]]);
								  }
								
								if($result_login[$fieldnames[$i][6]]=='')
								  {
									$child = $xml->menu[0]->addChild("prep_".$lastid," ");
								  }else
								  {
									 $child = $xml->menu[0]->addChild("prep_".$lastid,$result_login[$fieldnames[$i][6]]);
								  }
								
								$dom = new DOMDocument('1.0');
								$dom->preserveWhiteSpace = false;
								$dom->formatOutput = true;
								$dom->loadXML($xml->asXML());
								$xml = new SimpleXMLElement($dom->saveXML());
								
						  }
						  /*$dom = new DOMDocument('1.0');
						  $dom->preserveWhiteSpace = false;
						  $dom->formatOutput = true;
						  $dom->loadXML($xml->asXML());
						  $xml = new SimpleXMLElement($dom->saveXML());*/
						  $xml->asXML($_SESSION['s_xmlfilelocation']);
					  }
			  //add xml code ends	
			  
						//excel code starts
						$inputFileType = 'Excel5';
						$inputFileName = $_SESSION['s_excelfilelocation'];
						$objReader = PHPExcel_IOFactory::createReader($inputFileType);
						$objPHPExcel = $objReader->load($inputFileName);
						
						foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
							  $worksheetTitle     = $worksheet->getTitle();
							  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
							  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
							  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
							  /*if($worksheetTitle=="kotcounter")
							  {
								  $i=$highestRow + 1;
								  $worksheet->setCellValue("A".$i, $lastid);
								  $worksheet->setCellValue("B".$i, $kotname);
							  }*/
							  $j=$highestRow + 1;
							  if($tagnames[$i]=="kotcounter" && $worksheetTitle=="kotcounter")
							  {
								  $worksheet->setCellValue("A".$j, $lastid);
								  $worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
									
							  }else if($tagnames[$i]=="category" && $worksheetTitle=="category")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								    $worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="subcategory" && $worksheetTitle=="subcategory")
							  {
								  $worksheet->setCellValue("A".$j, $lastid);
								  $worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="portion" && $worksheetTitle=="portion" )
							  {
								  $worksheet->setCellValue("A".$j, $lastid);
								  $worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
								  $worksheet->setCellValue("D".$j, $result_login[$fieldnames[$i][2]]);
							  }else if($tagnames[$i]=="menu" && $worksheetTitle=="menu")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
								 	$worksheet->setCellValue("D".$j, $result_login[$fieldnames[$i][2]]);
								    $worksheet->setCellValue("F".$j, $result_login[$fieldnames[$i][3]]);
								    $worksheet->setCellValue("H".$j, $result_login[$fieldnames[$i][4]]);
								    $worksheet->setCellValue("J".$j, $result_login[$fieldnames[$i][5]]);
								    $worksheet->setCellValue("L".$j, $result_login[$fieldnames[$i][6]]);
							  }else if($tagnames[$i]=="preference" && $worksheetTitle=="preference")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);   
							  }else if($tagnames[$i]=="department" && $worksheetTitle=="department")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="designation" && $worksheetTitle=="designation")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="floormaster" && $worksheetTitle=="floormaster")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="staffmaster" && $worksheetTitle=="staffmaster")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
								  	$worksheet->setCellValue("D".$j, $result_login[$fieldnames[$i][2]]);
							  }else if($tagnames[$i]=="paymentmode" && $worksheetTitle=="paymentmode")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	//$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][2]]);
							  }else if($tagnames[$i]=="credittypes" && $worksheetTitle=="credittypes")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
								  	$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
								  	$worksheet->setCellValue("D".$j, $result_login[$fieldnames[$i][2]]);
							  }else if($tagnames[$i]=="tablemaster" && $worksheetTitle=="tablemaster")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="discount" && $worksheetTitle=="discount")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="corporate" && $worksheetTitle=="corporate")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="voucher" && $worksheetTitle=="voucher")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="bankmaster" && $worksheetTitle=="bankmaster")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="feedback" && $worksheetTitle=="feedback")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="nutrition" && $worksheetTitle=="nutrition")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="ingredient" && $worksheetTitle=="ingredient")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }else if($tagnames[$i]=="coupon" && $worksheetTitle=="coupon")
							  {
									$worksheet->setCellValue("A".$j, $lastid);
									$worksheet->setCellValue("B".$j, $result_login[$fieldnames[$i][1]]);
							  }
						}
					  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
					  $xlsx->save($_SESSION['s_excelfilelocation']);
						//excel code ends	
				  } 
			
			}
			 if (!headers_sent())
    {    
        header('Location: excel_updates.php?msg=5');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="excel_updates.php?msg=5";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=excel_updates.php?msg=5" />';
        echo '</noscript>'; exit;
    }
}
$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}else if($_REQUEST['msg']=="4")
	{
	$alert="Excel Uploaded...";
	}else if($_REQUEST['msg']=="5")
	{
	$alert="Convertion Completed...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Excel</title>
<meta name="description" content="">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
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
        
        
        <script>
            $(document).ready(function(){
            $('.table_report tr').click(function() {
            var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
         });
            $('.md-trigger_cat').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	        $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		$('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/kot_edit.php", {kot:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
        $('.ui-corner-all').click( function() {
	validateSearch();
	});
      });  
      
    </script>
    
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 top:0;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:9999999;
	 height: 100%;
	 }
.contant_table_cc{height:83vh;}
.tablesorter tbody{height:76vh;}
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
					<li><a style="cursor:pointer">Excel uploads</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php }else { ?>
            <div class="load_error1" style="display:none; color:red;line-height: 30px;">Upload Format error.(.xls)</div>
            <?php } ?>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="cc_new_main">
                       <div style="  border: 1px #B6B6B6 solid;display:none;" class="cc_new">
                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  //include "includes/page_top.php"; ?>
				</div>
			</div>
                   </div><!--cc_new-->
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; float:left">
                        
                             <!--<div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Kot name</span>
                              <input type="text" class="form-control filte_new_box" id="kots" name="kots" placeholder="Kot name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                             	<span class="filte_new_text">Select Branch</span>
                                 <select  class="add_text_box filte_new_box"  id="branches" name="branches" onChange="validateSearch()">
                                 <option value="null" default>All</option>
                                 
                                 <?php
									 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_printersettings ON tbl_kotcountermaster.kr_printerid=tbl_printersettings.pr_id"); 
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login)) 
											{
	 										?>
                                <option value="<?=$result_login['be_branchname']?>"><?=$result_login['be_branchname']?></option>
                               <?php } } ?>	
                             
                                </select>
                            </div>
                           
                           
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="kot_counter_master.php" >Reset</a></div>
                            </div>
                        </div>--><!--form_group-->
                    	
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <!--<div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="clrkot()" ></a>
                      </div>  -->
                   </div>
                   <div class="col-md-12 contant_table_cc">
                   <form enctype="multipart/form-data"  action="excel_updates.php" method="post" name="submitxmldetails" id="submitxmldetails">
                   <input type="hidden" name="typeofupload" id="typeofupload" >
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Sections</th>
                                <th>File</th>
                             
                                 <td >Action</td>
                              </tr>
                             </thead>
                                
    						<tr id=""  class="select">
                                                    <td>Excel Upload - <strong style="text-decoration:underline">PORTION</strong></td>
                                <td><input type="file" name="excel_upload"  id="excel_upload"/></td>
                                <td><a  class="button_xlmudpdates" id="excel_portion" href="#" onClick="submitupload('excel')">Submit Excel</a> </td>
                              </tr>
                              <tr id=""  class="select">
                                                    <td>Excel Upload - <strong style="text-decoration:underline">GRAM</strong></td>
                                <td><input type="file" name="excel_upload_gram"  id="excel_upload_gram"/></td>
                                <td><a  class="button_xlmudpdates" id="excel_gram"  href="#" onClick="submitupload('excel_gram')">Submit Excel</a> </td>
                              </tr>
                              
                             
                                                         

                        </table>
                        </form>
                   </div>
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>

<div class="new_overlay_1"></div>

<div class="view_format_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>KOT Id</strong></td>
                <td style="text-align:center" width="70%">KOT Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>KOT Eng Name</strong></td>
                <td style="text-align:center" width="70%">KOT Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>KOT Arb Name</strong></td>
                <td style="text-align:center" width="70%">KOT Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->





<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>-->
<!--<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>
<script type="text/javascript" src="js/app.js"></script>-->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<!--<script type="text/javascript">

			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 8,
					scrolling_items: 2,
					orientation: "horizontal",
					circular: "no",
					autoscroll: "no",
					interval: 5000,
					speed: 500,
					easing: "linear",
					direction: "left",
					start_from: 9
				});
			});
		</script>
-->




<script type="text/javascript">
function submitupload(typeval)
{   
    //alert('ggg');
    $("#excel_portion").css('pointer-events','none');
    $("#excel_gram").css('pointer-events','none');
	if(typeval=="excel")
	{
		if (hasExtension('excel_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);
                         //$("#excel_portion").css('pointer-events','none');
			document.submitxmldetails.submit();
		}else
		{        $("#excel_portion").css('pointer-events','inherit');
                    $("#excel_gram").css('pointer-events','inherit');
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        if(typeval=="excel_gram")
	{//alert('2');
            
		if (hasExtension('excel_upload_gram', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);
                         $("#excel_gram").css('pointer-events','none');
			document.submitxmldetails.submit();
		}else
		{       $("#excel_gram").css('pointer-events','inherit');
                    $("#excel_portion").css('pointer-events','inherit');
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else if(typeval=="convert")
	{
		
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		
	}
}
function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
}

function validate_all()
			{
			var a=$("#kot").val().trim();
			//	 var a=document.getElementById("kot").value;
				
				// var b=document.getElementById("floorname").value;
				var cb= $("#branch").find('option:selected').attr('id');
				
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkot&mid="+a+"&brch="+cb,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#kotstatus1234');
			if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#kot_div").addClass("has-error");
	  $("#kot").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#kot_div").removeClass("has-error");
	   $("#kot_div").addClass("has-success");
	  	document.kot_master.submit();

			}
			}
		});
			}

function valikot()
{
	 var a=$("#kot").val().trim();

	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkkot&mid="+a,
			success: function(msg)
			{
			msg=$.trim(msg);
			
				 var namechk=$('#kotstatus1234');
				if(msg =="sorry")
					{
			  namechk.text('Already exists');
			     $("#kot_div").addClass("has-error");
	  $("#state").focus();
					}
					else
					{
						namechk.text('');
						 $("#kot_div").removeClass("has-error");
	   $("#kot_div").addClass("has-success");
					}
			}
		});
            }
            

function clrkot()
{
	document.getElementById('kot').value = '';
      	document.getElementById('branch').value = '';
    	document.getElementById('printer').value = '';
     	$('#kotstatus1234').text('');
		$("#kot_div").removeClass("has-error");
	    $("#brnch_div").removeClass("has-error");
	    $("#printer_div").removeClass("has-error");
	}
          
        
		function validate_kot()
			{
			 if(validate_kotname())
				{
					if(validate_branch())
					{
						if(validate_all())
						{
				/*	document.kot_master.submit();*/
						}
					}
				}
                                
			}
                        
                        
		function validate_kotname()   
			{
				if($("#kot").val()=="")
				{
					$("#kot_div").addClass("has-error");
						  document.kot_master.kot.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("kot").value;
						 $("#kot_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
						
					 }
			}
                        			
			function validate_branch()   
			{
				if($("#branch").val()=="")
				{
					$("#brnch_div").addClass("has-error");
				
						  document.kot_counter_master.branch.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("branch").value;
						 $("#brnch_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			
			
			function validate_printer()   
			{
				if($("#printer").val()=="")
				{
					$("#printer_div").addClass("has-error");
				<!--	add_new_dropdown2-->
						  document.kot_counter_master.printer.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("printer").value;
						 $("#printer_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
                       
//                       <script type="text/javascript">
function validateSearch()
{
	var kot=$("#kots").val();
	if(kot=="")
	{
	kot="null";
	}
	var branch=$("#branches").val();
	if(branch=="")
	{
	branch="null";
	}
	/*var printer=$("#printers").val();
	if(printer=="")
	{
	printer="null";
	}*/
//alert(kot+branch+printer);
//+"&printer="+printer
	  $.ajax({ 
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchkot&srchid="+kot+"&brnch="+branch,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});  
}
</script>



<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<!--<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter(); 
});  
</script>-->

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>