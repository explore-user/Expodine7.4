<?php    

error_reporting(0);

include('../includes/session.php');		
include("../database.class.php");
$database	= new Database();


$sql_login  =  $database->mysqlQuery("SELECT bsc_cloud_branchid FROM tbl_branch_settings_cloud"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $branch_id	=$result_cat_s['bsc_cloud_branchid'];
	  }			
} 

    $floor=$_REQUEST['floor'];
    $table=$_REQUEST['id'];
    
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $output = base64_encode( openssl_encrypt( $branch_id, $encrypt_method, $key, 0, $iv ) );
    
    $string="https://www.expodinereports.com/scan_order/index.php?sc_br=$output&tb=$table&flr=$floor"; 
    
    
    
    
     $api_short=''; $api_token='';
     $loy_qry16 = $database->mysqlQuery("select shortlink_api,shortlink_token  from  tbl_generalsettings ");
   
     $num_loy6 = $database->mysqlNumRows($loy_qry16);
     if($num_loy6)
     {
      while($loyalty_listing6 = $database->mysqlFetchArray($loy_qry16))
      {
          
         $api_short=$loyalty_listing6['shortlink_api'];
         $api_token=$loyalty_listing6['shortlink_token'];
             
     }}
     
     
    if($api_short!=''){
         
     $longUrl=$string;
 
    $data = [
        "long_url" => $longUrl,
    ];

    $ch = curl_init($api_short);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $api_token,
        "Content-Type: application/json",
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        
        $responseData = json_decode($response, true);
        //$string= $responseData['link']; // Shortened URL
        
    } else {
        
         echo "Error: Unable to shorten URL. HTTP Code " . $httpCode;
         header('Location:index.php');
    }
         
    }
    
    
    echo "<h1> QR : ".$_REQUEST['name']."</h1><hr/>";
    
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
       // echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
    //display generated file
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
        //config form
        echo '<form action="index.php" method="post">
        QR Link :&nbsp;<input style="width: 53%;font-size:10px;font-weight:bold" name="data" value="'.(isset($string)?htmlspecialchars($string):'PHP QR Code :)').'" />&nbsp;
        ECC:&nbsp;<select name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option selected value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
        Size:&nbsp;<select name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;
        <input style="background-color:green;color:white" type="submit" value="GENERATE">
    
    &nbsp; &nbsp; &nbsp;
     <a style="border:solid 1px;border-radius:5px;padding:2px;background-color:darkred;color:white" href="../table_master.php" >BACK </a>
     &nbsp; &nbsp;
    <a style="border:solid 1px;border-radius:5px;padding:2px;background-color:darkred;color:white" target="_blank" href="'.(isset($string)?htmlspecialchars($string):'PHP QR Code :)').'" >LINK </a>

    </form><hr/>';
        
    // benchmark
    //QRtools::timeBenchmark();    

    