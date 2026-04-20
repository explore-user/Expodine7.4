
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEWARD APP DOWNLOAD </title>

    <style>
        body{
            background: url(../img/qr_app_bg.jpg) !important;
height: 100%;
        }
        
        .app_heading_sec{width:100%;float:left;text-align:center;font-size:30px;font-family:sans-serif;color:#242424;margin-top:20px}
        .app_heading_sec_span{width:100%;float:left;text-align:center;font-size:15px;font-family:sans-serif;color:darkred;font-weight: bold}
        .app_home_ico{width:40px;height:40px;position:absolute;border-radius:50%;background-color:#e6e6e6;text-align:center;line-height:48px;left:10px}
        .app_download_btn{width:120px;height:45px;border-radius:60px;background-color:#fff;color:#242424;border:0;    box-shadow: 0px 8px 10px rgb(0 0 0 / 13%);display:inline-block;cursor:pointer;margin-top:20px;margin-left:-35px}
        .app_flwdt{width:100%;float:left;text-align:center;margin-top:20px}
    </style>
</head>
<body>

    
  <div class="app_flwdt"><img style="width:150px" class="phn_vcr_img" src="../img/app_dwd_ico.png" alt=""></div> 

<?php    

       $localIP = getHostByName(getHostName());   

    //echo ' <a class="app_home_ico" href="../index.php"><img src="../img/home_ico_1.png"></a>'; 
    echo "<h1 class='app_heading_sec'>DOWNLOAD STEWARD APP </h1> <span style='font-size:11px' class='app_heading_sec_span'>LINK : http://$localIP:8021/Dropbox/expodine/util/APP/Expodine.apk</span>";
    
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
       
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
           
    //display generated file
    echo '<span style="margin-top:20px" class="app_flwdt"><img class="im_new"  src="'.$PNG_WEB_DIR.basename($filename).'" /></span><span class="app_heading_sec_span im_new">Scan QR Code</span>';  
    $localIP = getHostByName(getHostName());
    //config form
    echo '<form style="text-align:center" action="index.php?load=reload" method="post">
      &nbsp;<input style="display:none" name="data" value="http://'.$localIP.':8021/Dropbox/expodine/util/APP/Expodine.apk" />&nbsp;
     &nbsp;<select style="display:none" name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>&nbsp;
      &nbsp;<select style="display:none" name="size">';
        
    for($i=1;$i<=10;$i++)
        echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;
        <input class="app_download_btn" onclick="sub();" type="submit"  value="GENERATE QR"></form>';
        
    // benchmark
    //QRtools::timeBenchmark();    
?>
<input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
 <script src="../js/jquery-1.10.2.min.js"></script>  
<script type="text/javascript">
    $(document).ready(function () { 
        
         var url_check=$('#url_check').val();
       
        
        var new_id=url_check.split('load=');
       
        if(new_id[1]!='' && new_id[1]!='undefined' && new_id[1]!=undefined ){
        $('.im_new').show();
         $('.phn_vcr_img').hide(); 
        
        
        
    }else{
        $('.im_new').hide();
         $('.phn_vcr_img').show(); 
    }
    });

    
            

    </script>

        
</body>
</html>