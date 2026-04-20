<?php 

  session_start();
include("database.class.php"); 
$database	= new Database();

?>
<html>
    
 <body>
        
 <?php
 $type='';
  $sql_login5  =  $database->mysqlQuery("select be_barcode_printer_type from  tbl_branchmaster   "); 
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{ 
                      
                      $type=$result_login5['be_barcode_printer_type'];
                  }
                  }
       
       
       
       $count='';
       
       $count=$_REQUEST['count'];
       
       
       

       
       
  if($type=='BOXP'){ 
   
   for($i=0;$i<$count;$i++){
       
       
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                    
    ?>
        
        
<div>
    
<xpml><page quantity='0' pitch='25.0 mm'></xpml>^XA
^SZ2^JMA
^MCY^PMN
^PW604^MTT
^JZY
^LH0,0^LRN
^XZ
<xpml></page></xpml><xpml><page quantity='0' pitch='25.0 mm'></xpml><xpml></page></xpml><xpml><page quantity='1' pitch='25.0 mm'></xpml>^XA
^FT100,19
^CI0
^A0N,25,34^FD<?=$_SESSION['s_branchname']?>^FS
^FT402,19
^A0N,25,34^FD<?=$_SESSION['s_branchname']?>^FS
^FT13,45
^A0N,23,25^FD<?=$result_login['mr_menuname']?>^FS
^FT315,45
^A0N,23,25^FD<?=$result_login['mr_menuname']?>^FS
^FT12,153
^A0N,25,28^FDMRP: Rs. <?=$result_login['mrc_rate']?>^FS
^FT314,153
^A0N,25,28^FDMRP: Rs. <?=$result_login['mrc_rate']?>^FS
^FO13,52
^BY2^BCN,50,N,N^FD>;<?=$result_login['mrc_barcode']?>^FS
^FT40,121
^A0N,20,27^FD<?=$result_login['mrc_barcode']?>^FS
^FO315,52
^BCN,50,N,N^FD>;<?=$result_login['mrc_barcode']?>^FS
^FT342,121
^A0N,20,27^FD<?=$result_login['mrc_barcode']?>^FS
^FT25,170
^A0N,14,19^FD(Incl of all Taxes)^FS
^FT327,170
^A0N,14,19^FD(Incl of all Taxes)^FS
^FT244,174
^A0B,20,22^FDPKD: <?=$_REQUEST['bar_packing']?>^FS
^FT546,174
^A0B,20,22^FDPKD: <?=$_REQUEST['bar_packing']?>^FS
^FT277,174
^A0B,20,22^FDEXP: <?=$_REQUEST['bar_expiry']?>^FS
^FT579,174
^A0B,20,22^FDEXP: <?=$_REQUEST['bar_expiry']?>^FS
^PQ1,0,1,Y
^XZ
<xpml></page></xpml><xpml><end/></xpml>
    
</div>
          
          
   <?php } }
   }     
          
   }else if($type=='ZEBRA'){ 
   
  for($i=0;$i<$count;$i++){
       
       
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                    
    ?>
        
        
<div>
    
<xpml><page quantity='0' pitch='25.0 mm'></xpml>^XA
~TA000
~JSN
^LT0
^MNW
^MTT
^PON
^PMN
^LH0,0
^JMA
^PR6,6
~SD15
^JUS
^LRN
^CI27
^PA0,1,1,0
^XZ
##                            ^XA
^MMT
^PW448
^LL304
^LS0
^FT95,62^A0N,54,53^FH\^CI28^FD<?=$_SESSION['s_branchname']?>^FS^CI27
^BY3,3,40^FT74,124^BCN,,Y,N
^FH\^FD>;<?=$result_login['mrc_barcode']?>^FS
^FT70,190^A0N,34,33^FH\^CI28^FD<?=$result_login['mr_menuname']?> ^FS^CI27
^FT4,232^A0N,23,20^FH\^CI28^FDP : <?=$_REQUEST['bar_packing']?>                                E : <?=$_REQUEST['bar_expiry']?>^FS^CI27
^FT131,282^A0N,34,35^FH\^CI28^FDKWD : <?=$result_login['mrc_rate']?>^FS^CI27
^PQ1,0,1,Y
^XZ
<xpml></page></xpml><xpml><end/></xpml>
    
</div>
          
          
   <?php } }
   }   
   
 
 }else if($type=='TSC'){ 
   
   for($i=0;$i<$count;$i++){
       
       
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                    
    ?>
        
        
<div>
<xpml><page quantity='0' pitch='40.0 mm'></xpml> <br>
SIZE 57.5 mm, 40 mm <br>
DIRECTION 0,0 <br>
REFERENCE 0,0 <br>
OFFSET 0 mm <br>
SET PEEL OFF <br>
SET CUTTER OFF <br>
SET PARTIAL_CUTTER OFF <br>
<xpml></page></xpml><xpml><page quantity='1' pitch='40.0 mm'></xpml> <br>
SET TEAR ON  <br>
CLS <br>
CODEPAGE 1252 <br>
TEXT 341,308,"0",180,13,10,"<?=$_SESSION['s_branchname']?>" <br>
TEXT 429,270,"0",180,12,6,"<?=$result_login['mr_menuname']?>" <br>
TEXT 437,78,"0",180,14,6,"Net.Wt. Including Package" <br>
TEXT 301,54,"0",180,6,6,"PKD Dt :<?=$_REQUEST['bar_packing']?>" <br>
TEXT 445,141,"0",180,12,8,"Unit Price" <br>
TEXT 253,140,"0",180,9,10,"QTY" <br>
TEXT 141,141,"0",180,11,8,"Total Price" <br>
BARCODE 453,255,"39",78,0,180,3,8,"<?=$result_login['mrc_barcode']?>" <br>
TEXT 261,172,"0",180,6,6,"<?=$result_login['mrc_barcode']?>" <br>
TEXT 405,109,"0",180,6,9,"<?=$result_login['mrc_rate']?>" <br>
TEXT 253,117,"0",180,7,9,"1" <br>
TEXT 85,109,"0",180,9,9,"<?=$result_login['mrc_rate']?>" <br>
TEXT 381,30,"0",180,7,5,"Best before 45 days from Pkd. date." <br>
PRINT 1,1
<xpml></page></xpml><xpml><end/></xpml>
</div>
          
          
   <?php } }
          
          
   }
   
 }else if($type=='TSC1'){
        
   for($i=0;$i<$count;$i++){
       
       
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                    
    ?>
        
 <div>  
 SIZE 80.5 mm, 40 mm <br>
DIRECTION 0,0 <br>
REFERENCE 0,0 <br>
OFFSET 0 mm <br>
SET PEEL OFF <br>
SET CUTTER OFF <br>
SET PARTIAL_CUTTER OFF <br>
SET TEAR ON <br>
CLS <br>
CODEPAGE 1252 <br>   


TEXT 555,301,"ROMAN.TTF",180,1,14,"<?=$_SESSION['s_branchname']?>"<br>
TEXT 622,240,"ROMAN.TTF",180,1,10,"<?=$result_login['mr_menuname']?>"<br>
BARCODE 622,191,"128",66,0,180,2,4,"<?=$result_login['mrc_barcode']?>"<br>
TEXT 595,119,"ROMAN.TTF",180,1,9,"<?=$result_login['mrc_barcode']?>"<br>
TEXT 626,77,"ROMAN.TTF",180,1,12,"MRP : <?=$result_login['mrc_rate']?>"<br>
TEXT 381,63,"ROMAN.TTF",90,1,8,"PKD DT:<?=$_REQUEST['bar_packing']?>"<br>
TEXT 351,62,"ROMAN.TTF",90,1,8,"EXP DT:<?=$_REQUEST['bar_expiry']?>" <br>
TEXT 577,30,"ROMAN.TTF",180,1,7,"<?=$_SESSION['fsaai']?>" <br>


TEXT 233,301,"ROMAN.TTF",180,1,14,"<?=$_SESSION['s_branchname']?>" <br>
TEXT 300,240,"ROMAN.TTF",180,1,10,"<?=$result_login['mr_menuname']?>" <br>
BARCODE 300,191,"128",66,0,180,2,4,"<?=$result_login['mrc_barcode']?>" <br>
TEXT 273,119,"ROMAN.TTF",180,1,9,"<?=$result_login['mrc_barcode']?>" <br>
TEXT 304,77,"ROMAN.TTF",180,1,12,"MRP : <?=$result_login['mrc_rate']?>" <br>
TEXT 59,63,"ROMAN.TTF",90,1,8,"PKD DT:<?=$_REQUEST['bar_packing']?>"<br>
TEXT 29,62,"ROMAN.TTF",90,1,8,"EXP DT:<?=$_REQUEST['bar_expiry']?>" <br>
TEXT 255,30,"ROMAN.TTF",180,1,7,"<?=$_SESSION['fsaai']?>" <br>


PRINT 1,1 
</div>
       
  <?php } }
          
          
   }
   
 }else if($type=='HONEYWELL'){
       
        for($i=0;$i<$count;$i++){
        
          $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                   
        
                   
    ?>
      <div>     
       
       SETUP"Printing,Media,Start Adjust,-136" <br>
SETUP"Printing,Media,Stop Adjust,0" <br>
SETUP"Printing,Print Quality,Print Speed,75" <br>
SETUP"Printing,Print Quality,Darkness,75" <br>
SETUP"Printing,Print Area,Media Width,812" <br>
SYSVAR(57)=0 <br>
CLL <br>
NASC 8 <br>
OPTIMIZE "BATCH" ON <br>
qXPos% = 85 <br>

PP72+qXPos%,187:AN7:FT "CG Triumvirate Condensed Bold",8,0,99:PT "<?=$_SESSION['s_branchname']?>" <br>
PP70+qXPos%,148:BARSET "CODE128",2,2,2,34:PB "<?=$result_login['mrc_barcode']?>" <br>
PP70+qXPos%,116:FT "CG Triumvirate Condensed Bold",7,0,99:PT "<?=$result_login['mrc_barcode']?>" <br>
PP29+qXPos%,96:FT "CG Triumvirate Condensed Bold",7,0,99:PT "<?=$result_login['mr_menuname']?>" <br>
PP29+qXPos%,76:FT "CG Triumvirate Condensed Bold",8,0,99:PT "Sale Rate:<?=$result_login['mrc_rate']?>" <br>
PP150+qXPos%,56:FT "CG Triumvirate Condensed Bold",7,0,99:PT "EXP:<?=date('m/d/y', strtotime($_REQUEST['bar_expiry']))?>" <br>
PP29+qXPos%,56:FT "CG Triumvirate Condensed Bold",7,0,99:PT "PKD:<?=date('m/d/y', strtotime($_REQUEST['bar_packing']))?>" <br>


qXPos% = 400 <br>


PP72+qXPos%,187:AN7:FT "CG Triumvirate Condensed Bold",8,0,99:PT "<?=$_SESSION['s_branchname']?>" <br>
PP70+qXPos%,148:BARSET "CODE128",2,2,2,34:PB "<?=$result_login['mrc_barcode']?>" <br>
PP70+qXPos%,116:FT "CG Triumvirate Condensed Bold",7,0,99:PT "<?=$result_login['mrc_barcode']?>" <br>
PP29+qXPos%,96:FT "CG Triumvirate Condensed Bold",7,0,99:PT "<?=$result_login['mr_menuname']?>" <br>
PP29+qXPos%,76:FT "CG Triumvirate Condensed Bold",8,0,99:PT "Sale Rate:<?=$result_login['mrc_rate']?>" <br>
PP150+qXPos%,56:FT "CG Triumvirate Condensed Bold",7,0,99:PT "EXP:<?=date('m/d/y', strtotime($_REQUEST['bar_expiry']))?>" <br>
PP29+qXPos%,56:FT "CG Triumvirate Condensed Bold",7,0,99:PT "PKD:<?=date('m/d/y', strtotime($_REQUEST['bar_packing']))?>" <br>


LAYOUT RUN "" <br>
PF1 <br>
    </div> 
 <?php } }


   } 
            
 }  
          
 else if($type=='IMPACT'){
       
       for($i=0;$i<$count;$i++){
        
       $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster tm left join tbl_menurate_counter mr on mr.mrc_menuid=tm.mr_menuid  where tm.mr_active='Y' and tm.mr_menuid='".$_REQUEST['menuid']."' and mr.mrc_portion='1'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                   
        
                   
    ?>
  <div>     
       
  ^XA
^SZ2^JMA
^MCY^PMN
^PW779
^JZY
^LH0,0^LRN
^XZ
^XA
^FT12,36
^CI0
^A0N,25,34^FD<?=$_SESSION['s_branchname']?>^FS
^FT402,36
^A0N,25,34^FD<?=$_SESSION['s_branchname']?>^FS
^FT12,69
^A0N,20,27^FD<?=$result_login['mr_menuname']?>^FS
^FT402,69
^A0N,20,27^FD<?=$result_login['mr_menuname']?>^FS
^FO14,84
^BY2^BCN,89,N,N^FD>;1234>6#>5567890^FS
^FT38,198
^A0N,28,38^FD<?=$result_login['mrc_barcode']?>^FS
^FO404,84
^BCN,89,N,N^FD>;1234>6#>5567890^FS
^FT428,198
^A0N,28,38^FD<?=$result_login['mrc_barcode']?>^FS
^FT11,260
^A0N,34,38^FDMRP: <?=$result_login['mrc_rate']?>^FS
^FT401,260
^A0N,34,38^FDMRP: <?=$result_login['mrc_rate']?>^FS
^FT314,266
^A0B,23,18^FDPKD DT:<?=$_REQUEST['bar_packing']?>^FS
^FT704,266
^A0B,23,18^FDPKD DT:<?=$_REQUEST['bar_packing']?>^FS
^FT350,266
^A0B,23,18^FDEXP DT:<?=$_REQUEST['bar_expiry']?>^FS
^FT740,266
^A0B,23,18^FDEXP DT:<?=$_REQUEST['bar_expiry']?>^FS
^FT71,295
^A0N,20,27^FDFSSAI:<?=$_SESSION['fsaai']?>^FS
^FT461,295
^A0N,20,27^FDFSSAI:<?=$_SESSION['fsaai']?>^FS
^PQ1,0,1,Y
^XZ



  </div> 
     
  <?php } }


   } 
            
 } 
 
 ?>

  <style>
    .alert_error_popup_all_in_one_menu{
	width: 250px;
	height: 100px;
	position: fixed;
	right: 0px;
        left:0px;
	bottom: 0px;
        top:0px;
        margin: auto;
        
	background-color: #ff0000;
	text-align: center;
	padding: 20px 20px;
	padding-top: 40px;
	z-index: 999999;
	color: #fff;
	font-size: 14px;;
	border-radius: 5px;
	font-family: sans-serif;
}
.alert_error_popup_all_in_one_menu:before{
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0px;
    top: 0px;
    background-color: rgb(0,0,0,.9);
    content: '';
    z-index: -2;
}
.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
        left: 0;
		}
</style>
    </body>
    <strong class="alert_error_popup_all_in_one_menu" style="display: none"> 
      
        
        <a style="border:solid 1px;color: white;padding:15px;text-decoration: none;border-radius: 5px" href="menu.php" id="printbutton" >
            <img style="    position: relative;top: 4px;" src="img/back_ico.png"> 
            EXIT BARCODE PRINTING 
        </a>
    </strong>
      <div style="display:none" class="confrmation_overlay_proce"></div>  
    
     <script src="js/jquery-1.10.2.min.js"></script>
    <script>

 $(document).ready(function () {
     
    $('.confrmation_overlay_proce').show();
     
    window.print();
               
    $('.alert_error_popup_all_in_one_menu').show();   
                  
     
 });
 
 function print_page()
{ 
  //document.getElementById("printbutton").style.display = "none";	
  
}
 
 </script>
    
</html>

