<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
//include 'excel_reader.php';     // include the class
//error_reporting(0);
require_once 'excel_reader.php'; 
$_SESSION['langauage_upload']="arabic";
$_SESSION['pagid']=1;
$ful= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$link=basename($_SERVER['PHP_SELF']);
$finallink=explode($link,$ful);



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
        
    
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['typeofupload']))
{
	$type=$_REQUEST['typeofupload'];
	if($type=="kot")
	{
		if ( $_FILES['kotcounter_upload']['tmp_name'] )
		  {
			 // echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['kotcounter_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['kotcounter_upload']['tmp_name'], $uploadfile);
			
			
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->kotcounter[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("kotcounter");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[0],$type) .'<br/>';  
		  }
	}else if($type=="cat")
	{
		if ( $_FILES['category_upload']['tmp_name'] )
		  {
			// echo $_FILES['category_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['category_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['category_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->category[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("category");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[1],$type) .'<br/>'; 
		  }

	} else if($type=="subcat")
	{
		if ( $_FILES['subcategory_upload']['tmp_name'] )
		  {
			// echo $_FILES['category_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['subcategory_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['subcategory_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->subcategory[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("subcategory");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[2],$type) .'<br/>'; 
		  }

	}
        else if($type=="portion")
	{
		if ( $_FILES['portion_upload']['tmp_name'] )
		  {
			// echo $_FILES['category_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['portion_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['portion_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->portion[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("portion");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[3],$type) .'<br/>'; 
		  }

	} else if($type=="menu")
	{
		if ( $_FILES['menu_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['menu_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['menu_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->menu[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("menu");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[4],$type) .'<br/>'; 
			
			//die();
		  }
	} 
        
        
        else if($type=="floor")
	{
		if ( $_FILES['floor_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['floor_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['floor_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->floormaster[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("floormaster");
			$child->addAttribute("lang", "arabic");
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[5],$type) .'<br/>'; 
			//die();
		  }
	} 
        else if($type=="table")
	{
		if ( $_FILES['table_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['table_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['table_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->tablemaster[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("tablemaster");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[6],$type) .'<br/>'; 
			//die();
		  }
	} 
         else if($type=="pref")
	{
		if ( $_FILES['pref_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['pref_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['pref_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->preference[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("preference");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[7],$type) .'<br/>'; 
			//die();
		  }
	} 
        else if($type=="staff")
	{
		if ( $_FILES['staff_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['staff_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['staff_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->staffmaster[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("staffmaster");
			$child->addAttribute("lang", "arabic");
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[8],$type) .'<br/>'; 
			//die();
		  }
	} 
        
        else if($type=="discount")
	{
		if ( $_FILES['discount_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['discount_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['discount_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->discount[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("discount");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[9],$type) .'<br/>'; 
			//die();
		  }
	} 
        else if($type=="corp")
	{
		if ( $_FILES['corp_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['corp_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['corp_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->corporate[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("corporate");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[10],$type) .'<br/>'; 
			//die();
		  }
	} 
        else if($type=="voucher")
	{
		if ( $_FILES['voucher_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['voucher_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['voucher_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->voucher[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("voucher");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[11],$type) .'<br/>'; 
			//die();
		  }
	} 
	
         else if($type=="bank")
	{
		if ( $_FILES['bank_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['bank_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['bank_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->bankmaster[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("bankmaster");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[12],$type) .'<br/>'; 
			//die();
		  }
	} 
        
        else if($type=="feedback")
	{
		if ( $_FILES['feedback_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['feedback_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['feedback_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->feedback[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("feedback");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[13],$type) .'<br/>'; 
			//die();
		  }
	} 
        else if($type=="branch")
	{
		if ( $_FILES['branch_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['branch_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['branch_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->branchmaster[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("branchmaster");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[14],$type) .'<br/>'; 
			//die();
		  }
	} 
        
        else if($type=="department")
	{
		if ( $_FILES['department_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['department_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['department_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->department[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("department");
			$child->addAttribute("lang", "arabic");
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[15],$type) .'<br/>'; 
			//die();
		  }
	}
        
        else if($type=="designation")
	{
		if ( $_FILES['designation_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['designation_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['designation_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->designation[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("designation");
			$child->addAttribute("lang", "arabic");
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[16],$type) .'<br/>'; 
			//die();
		  }
	}
        else if($type=="nutrition")
	{
		if ( $_FILES['nutrition_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['nutrition_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['nutrition_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->nutrition[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("nutrition");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[17],$type) .'<br/>'; 
			//die();
		  }
	} else if($type=="ing")
	{
		if ( $_FILES['ing_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['ing_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['ing_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->ingredient[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("ingredient");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[18],$type) .'<br/>'; 
			//die();
		  }
	}  else if($type=="coupon")
	{
		if ( $_FILES['coupon_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['coupon_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['coupon_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->coupon[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("coupon");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[19],$type) .'<br/>'; 
			//die();
		  }
	}  else if($type=="payment")
	{
		if ( $_FILES['payment_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['payment_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['payment_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->paymentmode[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("paymentmode");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$database->sheetData($excel->sheets[20],$type) .'<br/>'; 
			//die();
		  }
	}  else if($type=="credit")
	{
		if ( $_FILES['credit_upload']['tmp_name'] )
		  {
			// echo $_FILES['kotcounter_upload']['name']; 
			$excel = new PhpExcelReader;
			$excel->setOutputEncoding('UTF-8');
			$excel->read($_FILES['credit_upload']['tmp_name']);
			unlink($_SESSION['s_excelfilelocation']);
			$uploadfile=$_SESSION['s_excelfilelocation'];
			move_uploaded_file($_FILES['credit_upload']['tmp_name'], $uploadfile);
			//delete all details
			$data = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			if($_SESSION['langauage_upload']=="arabic")
			{
			unset($data->credittypes[1]);
			}
			$data->asXML($_SESSION['s_xmlfilelocation']);
			//add 
			 $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
			$child = $xml->addChild("credittypes");
			$child->addAttribute("lang", "arabic");
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml->asXML($_SESSION['s_xmlfilelocation']);
			$database->sheetData($excel->sheets[21],$type) .'<br/>'; 
			//die();
		  }
	} 
  
	 if (!headers_sent())
    {    
        header('Location: xml_updates.php?msg=4');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="xml_updates.php?msg=4";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=xml_updates.php?msg=4" />';
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
	$alert="XML Updated...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Expodine</title>
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
				<ul style="width:60%;">
					<li><a href="admin_home.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">XML uploads</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php }else { ?>
            <div class="load_error1" style="display:none; color:red;line-height: 30px;">Upload Format error.(.csv)</div>
            <?php } ?>
				</ul>
                <div style="float:right;margin: 3px;" class="button_xlmudpdates"><a href="<?=$finallink[0]?>xmlupdate.xls" style="color:#FFF">Download</a></div>
                <div style="float:right;margin: 3px;" class="button_xlmudpdates"><a href="#" style="color:#FFF">Sync XML</a></div>
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
                   <form enctype="multipart/form-data"  action="xml_updates.php" method="post" name="submitxmldetails" id="submitxmldetails">
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
                                <td>KOT Counter</td>
                                <td><input type="file" name="kotcounter_upload"  id="kotcounter_upload"/></td>
                                <td><a class="button_xlmudpdates view_frmt" href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('kot')">Submit</a></td>
                              </tr>
                              
                              <tr id=""  class="select">
                                <td>Category</td>
                                <td><input type="file" name="category_upload"  id="category_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtcat"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('cat')">Submit</a></td>
                              </tr>
                              
                              <tr id=""  class="select">
                                <td>Subcategory</td>
                                <td><input type="file" name="subcategory_upload"  id="subcategory_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtscat"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('subcat')">Submit</a></td>
                              </tr>

                              <tr id=""  class="select">
                                <td>Portion</td>
                                <td><input type="file" name="portion_upload"  id="portion_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtpm"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('portion')">Submit</a></td>
                              </tr>
                              
                               <tr id=""  class="select">
                                <td>Menu</td>
                                <td><input type="file" name="menu_upload"  id="menu_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtmenu"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('menu')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Nutrition</td>
                                <td><input type="file" name="nutrition_upload"  id="nutrition_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtnutr"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('nutrition')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>preference</td>
                                <td><input type="file" name="pref_upload"  id="pref_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtpref"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('pref')">Submit</a></td>
                              </tr>
                               <tr id=""  class="select">
                                <td>Ingredient</td>
                                <td><input type="file" name="ing_upload"  id="ing_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmting"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('ing')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Floor Master</td>
                                <td><input type="file" name="floor_upload"  id="floor_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtfloor"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('floor')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Table Master</td>
                                <td><input type="file" name="table_upload"  id="table_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmttable"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('table')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Bank Master</td>
                                <td><input type="file" name="bank_upload"  id="bank_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtbank"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('bank')">Submit</a></td>
                              </tr>
                              
                              <tr id=""  class="select">
                                <td>Staff</td>
                                <td><input type="file" name="staff_upload"  id="staff_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtstaff"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('staff')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Department</td>
                                <td><input type="file" name="department_upload"  id="department_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtdepmt"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('department')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Designation</td>
                                <td><input type="file" name="designation_upload"  id="designation_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtdesign"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('designation')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Discount</td>
                                <td><input type="file" name="discount_upload"  id="discount_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtdisc"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('discount')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Corporate</td>
                                <td><input type="file" name="corp_upload"  id="corp_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtcorp"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('corp')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Voucher</td>
                                <td><input type="file" name="voucher_upload"  id="voucher_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtvouch"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('voucher')">Submit</a></td>
                              </tr>
                              <tr id=""  class="select">
                                <td>Feedback</td>
                                <td><input type="file" name="feedback_upload"  id="feedback_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtfeed"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('feedback')">Submit</a></td>
                              </tr>
                              <!--<tr id=""  class="select">
                                <td>Branch Master</td>
                                <td><input type="file" name="branch_upload"  id="branch_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtbranch"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('branch')">Submit</a></td>
                              </tr>-->
                              <tr id=""  class="select">
                                <td>Coupon Company</td>
                                <td><input type="file" name="coupon_upload"  id="coupon_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtcoup"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('coupon')">Submit</a></td>
                              </tr>
                              
                              <tr id=""  class="select">
                                <td>Payment Mode</td>
                                <td><input type="file" name="payment_upload"  id="payment_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtpymtm"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('payment')">Submit</a></td>
                              </tr>
                              
                              <tr id=""  class="select">
                                <td>Credit Types</td>
                                <td><input type="file" name="credit_upload"  id="credit_upload"/></td>
                                <td><a  class="button_xlmudpdates view_frmtcrdt"  href="#">View Format</a>  <a  class="button_xlmudpdates"  href="#" onClick="submitupload('credit')">Submit</a></td>
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

<!--category-->


    <div class="view_formatcat_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Category Id</strong></td>
                <td style="text-align:center" width="70%">Category Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Category Eng Name</strong></td>
                <td style="text-align:center" width="70%">Category Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Category Arb Name</strong></td>
                <td style="text-align:center" width="70%">Category Arb Name</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->

  

<!--sub category-->


    <div class="view_formatscat_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Subcategory Id</strong></td>
                <td style="text-align:center" width="70%">Subcategory Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Subcategory Eng Name</strong></td>
                <td style="text-align:center" width="70%">Subcategory Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Subcategory Arb Name</strong></td>
                <td style="text-align:center" width="70%">Subcategory Arb Name</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->

<!--menu-->


    <div class="view_formatmenu_popup" style="display:none">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Menu Id</strong></td>
                <td style="text-align:center" width="70%">Menu Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng Name</strong></td>
                <td style="text-align:center" width="70%">Menu Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb Name</strong></td>
                <td style="text-align:center" width="70%">Menu Arb Name</td>
              </tr>
               <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng </strong></td>
                <td style="text-align:center" width="70%">Menu ShortCode</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb </strong></td>
                <td style="text-align:center" width="70%">Menu ShortCode</td>
              </tr>
               <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng </strong></td>
                <td style="text-align:center" width="70%">Menu Item ShortCode</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb </strong></td>
                <td style="text-align:center" width="70%">Menu Item ShortCode</td>
              </tr>
              <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng </strong></td>
                <td style="text-align:center" width="70%">Menu Description </td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb </strong></td>
                <td style="text-align:center" width="70%">Menu Description</td>
              </tr>
              <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng </strong></td>
                <td style="text-align:center" width="70%">Menu Diet </td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb </strong></td>
                <td style="text-align:center" width="70%">Menu Diet</td>
              </tr>
               <tr>
              	<td width="30%"  scope="col"><strong>Menu Eng </strong></td>
                <td style="text-align:center" width="70%">Menu Preparation Mode </td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Menu Arb </strong></td>
                <td style="text-align:center" width="70%">Menu Preparation Mode</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->

  

<!--portion-->


    <div class="view_formatpm_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Portion Id</strong></td>
                <td style="text-align:center" width="70%">Portion Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Portion Eng Name</strong></td>
                <td style="text-align:center" width="70%">Portion Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Portion Arb Name</strong></td>
                <td style="text-align:center" width="70%">Portion Arb Name</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->



<div class="view_formatfloor_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Floor Id</strong></td>
                <td style="text-align:center" width="70%">Floor Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Floor Eng Name</strong></td>
                <td style="text-align:center" width="70%">Floor Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Floor Arb Name</strong></td>
                <td style="text-align:center" width="70%">Floor Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->
 
<!--table-->


<div class="view_formattable_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Table Id</strong></td>
                <td style="text-align:center" width="70%">Table Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Table Eng Name</strong></td>
                <td style="text-align:center" width="70%">Table Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Table Arb Name</strong></td>
                <td style="text-align:center" width="70%">Table Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--Bank Master-->


<div class="view_formatbank_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Bank Id</strong></td>
                <td style="text-align:center" width="70%">Bank Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Bank Eng Name</strong></td>
                <td style="text-align:center" width="70%">Bank Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Bank Arb Name</strong></td>
                <td style="text-align:center" width="70%">Bank Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->
 
<!--Preference-->


<div class="view_formatpref_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Preference Id</strong></td>
                <td style="text-align:center" width="70%">Preference Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Preference Eng Name</strong></td>
                <td style="text-align:center" width="70%">Preference Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Preference Arb Name</strong></td>
                <td style="text-align:center" width="70%">Preference Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--Staff-->


<div class="view_formatstaff_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Staff Id</strong></td>
                <td style="text-align:center" width="70%">Staff Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Staff Eng Name</strong></td>
                <td style="text-align:center" width="70%">Staff Eng Name - First Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Staff Arb Name</strong></td>
                <td style="text-align:center" width="70%">Staff Arb Name  - First Name</td>
              </tr>
              <tr>
              	<td width="30%"  scope="col"><strong>Staff Eng Name</strong></td>
                <td style="text-align:center" width="70%">Staff Eng Name - Last Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Staff Arb Name</strong></td>
                <td style="text-align:center" width="70%">Staff Arb Name  - Last Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--Department-->


    <div class="view_formatdepmt_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Department Id</strong></td>
                <td style="text-align:center" width="70%">Department Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Department Eng Name</strong></td>
                <td style="text-align:center" width="70%">Department Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Department Arb Name</strong></td>
                <td style="text-align:center" width="70%">Department Arb Name</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->

<!--Designation-->


    <div class="view_formatdesign_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Designation Id</strong></td>
                <td style="text-align:center" width="70%">Designation Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Designation Eng Name</strong></td>
                <td style="text-align:center" width="70%">Designation Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Designation Arb Name</strong></td>
                <td style="text-align:center" width="70%">Designation Arb Name</td>
              </tr>
            </table>
        </div>
    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popupcat-->

<!--Discount-->


<div class="view_formatdisc_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Discount Id</strong></td>
                <td style="text-align:center" width="70%">Discount Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Discount Eng Name</strong></td>
                <td style="text-align:center" width="70%">Discount Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Discount Arb Name</strong></td>
                <td style="text-align:center" width="70%">Discount Arb Name</td>
              </tr>
            </table>
        </div>
        </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--Corporate-->


<div class="view_formatcorp_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Corporate Id</strong></td>
                <td style="text-align:center" width="70%">Corporate Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Corporate Eng Name</strong></td>
                <td style="text-align:center" width="70%">Corporate Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Corporate Arb Name</strong></td>
                <td style="text-align:center" width="70%">Corporate Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--voucher-->


<div class="view_formatvouch_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Voucher Id</strong></td>
                <td style="text-align:center" width="70%">Voucher Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Voucher Eng Name</strong></td>
                <td style="text-align:center" width="70%">Voucher Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Voucher Arb Name</strong></td>
                <td style="text-align:center" width="70%">Voucher Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--Feedback-->


<div class="view_formatfeed_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Feedback Id</strong></td>
                <td style="text-align:center" width="70%">Feedback Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Feedback Eng Name</strong></td>
                <td style="text-align:center" width="70%">Feedback Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Feedback Arb Name</strong></td>
                <td style="text-align:center" width="70%">Feedback Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!-- General Settings-->


<div class="view_formatbranch_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Branch Id</strong></td>
                <td style="text-align:center" width="70%">Branch Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Branch Eng Name</strong></td>
                <td style="text-align:center" width="70%">Branch Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Branch Arb Name</strong></td>
                <td style="text-align:center" width="70%">Branch Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!-- Nutrition-->


<div class="view_formatnutr_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Nutrition Id</strong></td>
                <td style="text-align:center" width="70%">Nutrition Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Nutrition Eng Name</strong></td>
                <td style="text-align:center" width="70%">Nutrition Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Nutrition Arb Name</strong></td>
                <td style="text-align:center" width="70%">Nutrition Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->


<!--ingredient-->
<div class="view_formating_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Ingredient Id</strong></td>
                <td style="text-align:center" width="70%">Ingredient Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Ingredient Eng Name</strong></td>
                <td style="text-align:center" width="70%">Ingredient Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Ingredient Arb Name</strong></td>
                <td style="text-align:center" width="70%">Ingredient Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->


<!--coupon-->
<div class="view_formatcoup_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Coupon Id</strong></td>
                <td style="text-align:center" width="70%">Coupon Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Coupon Eng Name</strong></td>
                <td style="text-align:center" width="70%">Coupon Eng Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Coupon Arb Name</strong></td>
                <td style="text-align:center" width="70%">Coupon Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->
<!--coupon-->
<div class="view_formatpaymnt_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
              <tr>
              	<td width="30%" scope="col"><strong>Payment mode Id</strong></td>
                <td style="text-align:center" width="70%">Payment mode Id</td>
              </tr> 
             <!-- <tr>
              	<td width="30%"  scope="col"><strong>Payment mode Code</strong></td>
                <td style="text-align:center" width="70%">Payment mode Code</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Payment mode Arb Code</strong></td>
                <td style="text-align:center" width="70%">Payment mode Arb Code</td>
              </tr>-->
               <tr>
              	<td width="30%"  scope="col"><strong>Payment mode Name</strong></td>
                <td style="text-align:center" width="70%">Payment mode Name</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Payment mode Arb Name</strong></td>
                <td style="text-align:center" width="70%">Payment mode Arb Name</td>
              </tr>
            </table>
        </div>

    </div><!--view_popup_contant_cc-->
    <div class="view_pop_bottom_btn_contain">
    		<a class="view_po_close_btn" href="#">Close</a>
    </div>
</div><!--view_format_popup-->

<!--coupon-->
<div class="view_formatcrdt_popup">
	<div class="view_pop_head">View format</div>
    <div class="view_popup_contant_cc">
    	
        <div class="view_popup_table_contant">
        	<table width="100%" border="0">
               <tr>
              	<td width="30%" scope="col"><strong>Credit Type Id</strong></td>
                <td style="text-align:center" width="70%">Credit Type Id</td>
              </tr> 
              <tr>
              	<td width="30%"  scope="col"><strong>Credit Type </strong></td>
                <td style="text-align:center" width="70%">Credit Type </td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Credit Type Arb </strong></td>
                <td style="text-align:center" width="70%">Credit Type Arb </td>
              </tr>
               <tr>
              	<td width="30%"  scope="col"><strong>Credit Type Label</strong></td>
                <td style="text-align:center" width="70%">Credit Type Label</td>
              </tr> 
              <tr>
             	 <td width="30%"  scope="col"><strong>Credit Type Arb Label</strong></td>
                <td style="text-align:center" width="70%">Credit Type Arb Label</td>
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
	$(".view_frmt").click(function(){
		$(".view_format_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_format_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtcat").click(function(){
		$(".view_formatcat_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatcat_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtscat").click(function(){
		$(".view_formatscat_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatscat_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>

<script type="text/javascript">
	$(".view_frmtpm").click(function(){
		$(".view_formatpm_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatpm_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>

<script type="text/javascript">
	$(".view_frmtmenu").click(function(){
		$(".view_formatmenu_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatmenu_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtfloor").click(function(){
		$(".view_formatfloor_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatfloor_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmttable").click(function(){
		$(".view_formattable_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formattable_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtpref").click(function(){
		$(".view_formatpref_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatpref_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtstaff").click(function(){
		$(".view_formatstaff_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatstaff_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtdisc").click(function(){
		$(".view_formatdisc_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatdisc_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtcorp").click(function(){
		$(".view_formatcorp_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatcorp_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtvouch").click(function(){
		$(".view_formatvouch_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatvouch_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtbank").click(function(){
		$(".view_formatbank_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatbank_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtfeed").click(function(){
		$(".view_formatfeed_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatfeed_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtbranch").click(function(){
		$(".view_formatbranch_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatbranch_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtdepmt").click(function(){
		$(".view_formatdepmt_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatdepmt_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtdesign").click(function(){
		$(".view_formatdesign_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatdesign_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtnutr").click(function(){
		$(".view_formatnutr_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatnutr_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmting").click(function(){
		$(".view_formating_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formating_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtcoup").click(function(){
		$(".view_formatcoup_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatcoup_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtpymtm").click(function(){
		$(".view_formatpaymnt_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatpaymnt_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>
<script type="text/javascript">
	$(".view_frmtcrdt").click(function(){
		$(".view_formatcrdt_popup").css("display","block");
		$(".new_overlay_1").css("display","block");
	});
	$(".view_po_close_btn").click(function(){
		$(".view_formatcrdt_popup").css("display","none");
		$(".new_overlay_1").css("display","none");
	});
</script>


<script type="text/javascript">
function submitupload(typeval)
{
	if(typeval=="kot")
	{
		if (hasExtension('kotcounter_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}else if(typeval=="cat")
	{
		if (hasExtension('category_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}

	}else  if(typeval=="subcat")
	{
        if (hasExtension('subcategory_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}else  if(typeval=="menu")
	{
        if (hasExtension('menu_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="portion")
	{
        if (hasExtension('portion_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        
        else  if(typeval=="floor")
	{
        if (hasExtension('floor_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="table")
	{
        if (hasExtension('table_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="bank")
	{
        if (hasExtension('bank_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        
        else  if(typeval=="feedback")
	{
        if (hasExtension('feedback_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="pref")
	{
        if (hasExtension('pref_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="staff")
	{
        if (hasExtension('staff_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="discount")
	{
        if (hasExtension('discount_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="corp")
	{
        if (hasExtension('corp_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="voucher")
	{
        if (hasExtension('voucher_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="branch")
	{
        if (hasExtension('branch_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="department")
	{
        if (hasExtension('department_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
     else  if(typeval=="designation")
	{
        if (hasExtension('designation_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	}
        else  if(typeval=="nutrition")
	{
        if (hasExtension('nutrition_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	} else  if(typeval=="coupon")
	{
        if (hasExtension('coupon_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	} else  if(typeval=="payment")
	{
        if (hasExtension('payment_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
	} else  if(typeval=="credit")
	{
        if (hasExtension('credit_upload', ['.xls']) )
		{
			 $("#typeofupload").val(typeval);	
			document.submitxmldetails.submit();
		}else
		{
			$(".load_error1").css("display","block");
			$(".load_error1").html("File not supported");
			$(".load_error1").delay(2000).fadeOut('slow');	
		}
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