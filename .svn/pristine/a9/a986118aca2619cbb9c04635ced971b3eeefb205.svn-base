<?php

session_start();
include("database.class.php"); 
$database	= new Database();

function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['langauage_upload']="arabic";
$_SESSION['pagid']=1;
$s="";

 if(isset($_REQUEST['push_urban_menu']) && $_REQUEST['push_urban_menu']=='go'){
    
        $date=date('Y-m-d H:i:s');
        $name='';   $cat=''; $partner_urb='';  $partner='';
        $localhost=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN); 
         
        $sql_login2  =  $database->mysqlQuery("select tol_id from tbl_online_order where tol_local_order ='N' and"
        . " (tol_urban_name='swiggy' or tol_urban_name='zomato')  limit 1 ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
              $partner=$result_login2['tol_id'];
        }
        }
        
       
       $diet='4'; $category='';
       $sql_login1  =  $database->mysqlQuery("select mr.mr_diet,mr.mr_menuid,mr.mr_maincatid, mr.mr_menuname,mc.mmy_maincategoryname,"
       . "  mt.mta_rate from tbl_menuratetakeaway mt inner join tbl_menumaster mr on mr.mr_menuid=mt.mta_menuid "
       . "  left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mr.mr_maincatid"
       . "  where mta_food_partner='".$partner."' and mr_rate_type='Portion' and mr_delete_mode='N'  and mta_portion='1' and mta_rate >0 "
       . "  order by mr.mr_menuname,mt.mta_food_partner asc ");
       
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
                
                
                $category=$result_login1['mmy_maincategoryname'];
                $name=$result_login1['mr_menuname'];
                $menuid=$result_login1['mr_menuid'];
               
                $cat=$result_login1['mr_maincatid'];
                 
                $rate=$result_login1['mta_rate'];
                 
                if($result_login1['mr_diet']=='Veg'){
                     $diet='1';
                }else if($result_login1['mr_diet']=='Non Veg'){
                     $diet='2'; 
                }else{
                     $diet='4';
                }
          
                
                $sql_gen2 =  mysqli_query($localhost,"select tc_ref_id from  tbl_category  where tc_ref_id='".$cat."' "); 
                  $num_gen2  = mysqli_num_rows($sql_gen2);
		  if(!$num_gen2)
		  {       
                        
             $log_data_print=mysqli_query($localhost,"INSERT INTO tbl_category(`tc_cat`, `tc_ref_id`, `tc_description`, `tc_sort`, `tc_active`, "
             . " `tc_store`, `tc_date`) "
             
             . " VALUES ('".$category."','".$cat."','".$category."',(SELECT COALESCE(MAX(t2.tc_sort), 0) + 1 
                 FROM tbl_category t2), 'true','".$_SESSION['be_store_id']."','".$date."')");  
                        
                        
                  }    
                
          
        $row2=array();
         
        $newname=$_SESSION['be_store_id'].'_'.$menuid.".png";
        
        $prt='"zomato","swiggy"';
         
        $dl='"delivery"';
         
        $loc='https://www.expodinereports.com/urban_piper/images/items_'.$_SESSION['be_store_id'].'/'.$newname;
        
        $sql_gen5 =  mysqli_query($localhost,"select tm_ref_id from tbl_item where  tm_ref_id='$menuid' "); 
      
	$num_gen  = mysqli_num_rows($sql_gen5);
	if($num_gen)
	{
        
        $log_data_print=mysqli_query($localhost,"update  tbl_item set  tm_item='$name', tm_ref_id='$menuid',"
        . " `tm_available`='true', `tm_ref_title`='$name', "
        . " `tm_desc`='".strtolower($name)."_', `tm_sold_store`='true', `tm_markup_price`='$rate', "
        . " `tm_price`='$rate', `tm_weight`='0', `tm_stock`='-1',"
        . " `tm_recommend`='true', `tm_food_type`='$diet', "
        . " `tm_category`='$cat',`tm_fulfillment`='$dl',`tm_image_url`='".$loc."',"
        . " `tm_platforms`='$prt',`tm_view`='Y' where tm_ref_id='$menuid' ");
            
        
        
        }else{
                  
            $log_data_print=mysqli_query($localhost,"INSERT INTO `tbl_item`(`tm_store`, `tm_item`, `tm_ref_id`, `tm_available`, `tm_ref_title`, "
             . " `tm_desc`, `tm_sold_store`, `tm_markup_price`, `tm_price`, `tm_weight`, `tm_stock`, `tm_recommend`, `tm_food_type`, "
             . " `tm_category`,`tm_fulfillment`,`tm_image_url`,`tm_platforms`,`tm_date`,`tm_sort`,`tm_view`,tm_status_item)"
             
           . " VALUES ('".$_SESSION['be_store_id']."','$name','$menuid','true',"
           . " '$name','".strtolower($name)."_','true','$rate','$rate',"
           . " '0','-1','true','$diet' ,'$cat','$dl','".$loc."','$prt','".$date."',(SELECT COALESCE(MAX(t2.tm_sort), 0) + 1 
               FROM tbl_item t2),'Y','disable' )");     
     
           
        $menu='"'.$menuid.'"';
                
        $log_data_print8=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='CGST'  ");
             
        $log_data_print9=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='SGST'  ");
        
        }
        
        
        }}
      header('location:dont_delete.php?excel_red=yes');
 }


 if(isset($_REQUEST['download_rate_barcode']) && $_REQUEST['download_rate_barcode']=='download_barcode_rate'){
        
        $data=array();
        $data1=array();
                                        
        $i=1;
        $sql_login1  =  $database->mysqlQuery("select mt.mrc_menu_final_amount,mr.mr_plu, mr.mr_menuname,mt.mrc_rate,mr.mr_menuid"
                . " from tbl_menurate_counter mt inner join tbl_menumaster mr on mr.mr_menuid=mt.mrc_menuid where"
                . " mr.mr_delete_mode='N' and mt.mrc_unit_type='Loose'  order by mr.mr_plu asc ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
          
                  $data['Sl No']=$i++;
                  $data['PLU']=$result_login1['mr_plu'];
                  $data['ITEM CODE']=$result_login1['mr_menuid'];
                  $data['NAME']=$result_login1['mr_menuname'];
                  
                  if($result_login1['mrc_menu_final_amount']>0){
                  $data['PRICE']=$result_login1['mrc_menu_final_amount'];
                  }else{
                    $data['PRICE']=$result_login1['mrc_rate'];  
                  }
                  $data['UNIT']='1';
               
                array_push($data1,$data);
		unset($data);
        }}
       
       
                 
        $filename = "PLU.xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");


  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  
  

  $source = $_REQUEST['dw'];
  $destination = $_REQUEST['jh']; 

  if (!file_exists($source)) {
    echo "Source file not found!";
    exit;
}

if (!is_dir(dirname($destination))) {
    mkdir(dirname($destination), 0777, true);  // create folder if missing
}

if (copy($source, $destination)) {
    echo "File copied successfully!";
} else {
    echo "Failed to copy file.";
}

  exit;
 
// Redirect after 3 seconds
header("Refresh:1; url=menu_uploads.php");
//header('Location:menu_uploads.php');
  
  
 }

 if(isset($_REQUEST['download_rate_urban']) && $_REQUEST['download_rate_urban']=='download_uraban_rate'){
        
        $data=array();
        $data1=array();
        
        $string='';
        $partner='';
        $sql_login2  =  $database->mysqlQuery("select tol_id from tbl_online_order where tol_local_order ='N' and tol_urban_name='".$_REQUEST['urban_partner']."' limit 1 ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
              $partner=$result_login2['tol_id'];
        }
        }
        
       
       $string.=" where mta_food_partner='".$partner."' and mr_rate_type='Portion' and mr_delete_mode='N'  and mta_portion='1' and mta_rate >0 ";
        
       $i=1;
       $sql_login1  =  $database->mysqlQuery("select mr.mr_diet,mr.mr_menuid,mc.mmy_maincategoryid,mc.mmy_maincategoryname, mr.mr_menuname,"
               . " tp.tol_name,mt.mta_rate from tbl_menuratetakeaway mt inner join tbl_menumaster mr on mr.mr_menuid=mt.mta_menuid "
               . " left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mr.mr_maincatid left join tbl_online_order tp on "
               . " tp.tol_id=mt.mta_food_partner $string order by mr.mr_menuname,mt.mta_food_partner asc ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
          
                
                $data['Sl No']=$i++;
              
                $data['Menu']=$result_login1['mr_menuname'];
                $data['Menu_id']=$result_login1['mr_menuid'];
               
                $data['Category']=$result_login1['mmy_maincategoryname'];
                $data['Category_Id']=$result_login1['mmy_maincategoryid'];
                 
                $data['Online']=$result_login1['tol_name'];
               
                $data['Rate']=$result_login1['mta_rate'];
                 
                if($result_login1['mr_diet']=='Veg'){
                     $data['Diet']='1';
                }else if($result_login1['mr_diet']=='Non Veg'){
                     $data['Diet']='2'; 
                }else{
                     $data['Diet']='4';
                }
                  
      
       array_push($data1,$data);
		unset($data);
        }}
       
                 
        $filename = "menu_urban" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
   unset($data);
   unset($data1);
   exit;
 }

  ///simple  download////
 
  if(isset($_REQUEST['load_simple_menu']))
  {
   
        $data=array();
        $data1=array();
        
        $a=array();
        
        $sql_login1  =  $database->mysqlQuery("select mr_itemcode,mr_menuid,mr_product_type,mr_unit_type,"
        . " mr_rate_type,mr_menuname,mmy_maincategoryname,kr_kotname "
        . " from tbl_menumaster left join tbl_kotcountermaster on kr_kotcode=mr_kotcounter "
        . " left join tbl_menumaincategory on mmy_maincategoryid=mr_maincatid "
        . "  where mr_delete_mode='N' group by mr_menuid"
        . " order by mr_menuname asc   ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
                
                
                $data['Item Type']=$result_login1['mr_product_type'];
                $data['Item ID [ KEEP EMPTY FOR NEWLY ADDING ITEMS ]']=$result_login1['mr_menuid'];
                $data['Item Name']=$result_login1['mr_menuname'];
                $data['Item Category  [ CATEGORY NAME TO WHICH THE ITEM SHOULD BE ADDED & SEEN]']=$result_login1['mmy_maincategoryname'];
                $data['Item Counter [ COUNTER NAME TO WHICH THE ITEM IS PRINTED ] ']=$result_login1['kr_kotname'];
                
                
                 
                if($result_login1['mr_unit_type']!=''){
                   $data['Item RateType [Eg: Single,Loose,Packet]']=$result_login1['mr_unit_type'];
                }else{
                    $data['Item RateType [Eg: Single,Loose,Packet]']='Single'; 
                }
                
                
         $sql_login11  =  $database->mysqlQuery("select mrc_barcode,u_name,bu_name,mrc_unit_weight,mrc_rate"
        . " from tbl_menurate_counter  inner join"
        . " tbl_menumaster on mr_menuid=mrc_menuid "
        ."  left join  tbl_unit_master  on u_id=mrc_unit_id
            left join tbl_base_unit_master bum on bu_id=mrc_base_unit_id "
         . "  where  mr_menuid='".$result_login1['mr_menuid']."' ");
     
        $num_login11   = $database->mysqlNumRows($sql_login11);
	if($num_login11){
            while($result_login11  = $database->mysqlFetchArray($sql_login11)){
                
                
                
                $data['Barcode']=$result_login11['mrc_barcode']; 
                
                $data['Base Unit [ Eg : KG , LTR , Nos ]']=$result_login11['bu_name']; 
                
                $data['Unit [ Eg : KG , LTR , Nos , GM , MLTR ] [ ** FOR PACKET ITEMS] ']=$result_login11['u_name']; 
                
                $data['Weight [ SELLING WEIGHT ]']=$result_login11['mrc_unit_weight']; 
                
                $data['Rate For All Module (CS RATE IS SHOWN HERE) ']=$result_login11['mrc_rate']; 
                
        }}else{
            
                $data['Barcode']=''; 
                
                $data['Base Unit [ Eg : KG , LTR , Nos ]']=''; 
                
                $data['Unit [ Eg : KG , LTR , Nos , GM , MLTR ] [ ** FOR PACKET ITEMS ] ']=''; 
                
                $data['Weight [ SELLING WEIGHT ]']=''; 
                
                $data['Rate For All Modules']=''; 
            
        }
        
        
         $data['Item Code [ CODE TO SEARCH ITEM OR PLU VALUE ] ']=$result_login1['mr_itemcode'];
                 
                array_push($data1,$data);
	        unset($data);
          } 
        }
       
       
        
        
        $filename = "Simple_item_download_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
    
}
 
  ///simple  upload////

  if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload_simple']=="upload")
    {
       
        if ( $_FILES['excel_upload_simple']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload_simple"]["name"];
                        move_uploaded_file($_FILES['excel_upload_simple']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                
                            $y++;  
                             }
                             
   
                           
        if($data[1]!=''){
            
           
        $category='';                       
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[3]' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
            
            if($data[0]=='Raw'){
                
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[3]','Y','1','Y' )" );
            }else{
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[3]','Y','1','N' )");
             }
             
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[3]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
        }
        
         
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[4]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
                    . " `kr_branchid` ) VALUES ('$data[4]','1' )");
             
            
            
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[4]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
          }
        }
        
        
      }
        
           
       $inv='NULL';                        
       
       $mod_date=date("Y-m-d H:i:s");  
       
       if($data[7]!=''){
        $base_unit='NULL';     
         $sql_login2  =  $database->mysqlQuery("select  bu_id from tbl_base_unit_master where bu_name='$data[7]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $base_unit="'".$result_login2['bu_id']."'";
        }
        }
        
        }else{
          $base_unit='NULL';  
       }
       
       
       
        if($data[8]!=''){
          
        $unit_id='NULL';     
        $sql_login2  =  $database->mysqlQuery("select  u_id from tbl_unit_master where u_name='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $unit_id="'".$result_login2['u_id']."'";
        }
        }
          
          
        }else{
          $unit_id='NULL';  
       }
       
        if($data[6]!=''){
           
              $item_pr_barcode="'".$data[6]."'";     
       }else{
              $item_pr_barcode='NULL';
       }    
       
       
        if($data[11]!=''){
           
              $item_code="'".$data[11]."'";     
       }else{
              $item_code='NULL';
       }    
       
       
        if($data[5]=='Single'){
           
              $rate_type='Portion';     
              
              $portion='1';
              
       }else{
              $rate_type='Unit';
              
              $portion='NULL';  
       }    
       
       
      if($data[5]=='Single'){
           
              $unit_type='NULL';     
       }else{
              $unit_type="'".$data[5]."'";     
       }    
               
       
       if($data[9]>0){
       $weight=$data[9];
       }else{
          $weight=0;  
       }     
       
       
           if($data[10]>0){
             
          $item_rate_new=$data[10];
   
          $item_rate_new1=$data[10];
           
          $item_rate_new2=$data[10];
          
        }else{
             
          $item_rate_new=0;
   
          $item_rate_new1=0;
           
          $item_rate_new2=0;
          
        }
       
      $shortcode=  substr($data[2], 0,25);
       
       
        ///menu update///
      
         $sql_login55  =  $database->mysqlQuery(" UPDATE `tbl_menumaster` SET `mr_menuname`='$data[2]',`mr_maincatid`='$category',
         `mr_diet`='General',`mr_time_min`='10',`mr_active`='Y',`mr_kotcounter`='$kitchen',
         `mr_modifieddate`='$mod_date',`mr_prepmode`='General',`mr_branchid`='1',`mr_rate_type`='$rate_type',
         `mr_unit_type`='$unit_type',`mr_base_unit`=$base_unit,`cloud_sync`='N',`mr_product_type`='$data[0]',
          mr_raw_barcode=$item_pr_barcode,mr_itemcode=$item_code,mr_itemshortcode='$shortcode' WHERE mr_menuid='$data[1]' ");
   
        
        ///rate update /////
         $menuid=$data[1];
         
          $sql_login287  =  $database->mysqlQuery(" delete from  tbl_menurate_counter where mrc_menuid='$menuid' ");
          
          $sql_login288  =  $database->mysqlQuery(" delete from  tbl_menuratetakeaway where mta_menuid='$menuid' ");
          
          $sql_login289  =  $database->mysqlQuery(" delete from  tbl_menuratemaster where mmr_menuid='$menuid' ");
          
            
            
            $sql_login28  =  $database->mysqlQuery(" INSERT INTO `tbl_menurate_counter` (`mrc_menuid`, `mrc_rate_type`, `mrc_portion`,
            `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_branchid`, `mrc_rate`, `mrc_default`,
            `mrc_android_sync`, `mrc_barcode`, `cloud_sync`, `mrc_menu_tax_amount`, `mrc_menu_final_amount`, `mrc_menu_tax_value`) VALUES
            ('$menuid','$rate_type',$portion, $unit_type, '$weight',$unit_id,$base_unit,1, '$item_rate_new', 'N','N',"
            . " $item_pr_barcode, 'N','0.000','$item_rate_new','0.000')");
      
            
        $sql_login288  =  $database->mysqlQuery("select  tol_id from tbl_online_order where tol_status='Y' ");
        $num_login288   = $database->mysqlNumRows($sql_login288);
	if($num_login288){
        while($result_login288  = $database->mysqlFetchArray($sql_login288)){
                
                 $sql_login281  =  $database->mysqlQuery("INSERT INTO `tbl_menuratetakeaway`(`mta_menuid`, 
                 `mta_rate_type`, `mta_portion`, `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_branchid`, 
                 `mta_rate`, `mta_default`, `mta_barcode`, `cloud_sync`, `mta_food_partner`, `mta_menu_tax_amount`,
                 `mta_menu_final_amount`, `mta_menu_tax_value`) VALUES
                ('$menuid', '$rate_type', $portion, $unit_type, '$weight', $unit_id, $base_unit, 1, '$item_rate_new1', 'N',$item_pr_barcode,"
                . " 'N','".$result_login288['tol_id']."', '0.000','$item_rate_new1', '0.000')");
        }}
         
         
        $sql_login289  =  $database->mysqlQuery("select  fr_floorid from tbl_floormaster where fr_status='Active' ");
        $num_login289   = $database->mysqlNumRows($sql_login289);
	if($num_login289){
        while($result_login289  = $database->mysqlFetchArray($sql_login289)){
                
            $sql_login2811  =  $database->mysqlQuery(" INSERT INTO `tbl_menuratemaster`(`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,
            `mmr_portion`, `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`, `mmr_default`,
            `mmr_barcode`, `mmr_android_sync`, `cloud_sync`, `mmr_menu_tax_amount`, `mmr_menu_final_amount`, `mmr_menu_tax_value`) VALUES
            ( '$menuid','".$result_login289['fr_floorid']."','$rate_type', $portion, $unit_type, '$weight', $unit_id, $base_unit, "
            . " '$item_rate_new2', 'N',$item_pr_barcode,'N','N', '0.000', '$item_rate_new2', '0.000')");
            
        }}
         
         
         
         
         
         
         
    }else{
     
        if($data[2]!=''){
 
        //////////menu adding/////////
          
        $category='';                       
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[3]' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
            
            if($data[0]=='Raw'){
                
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
            . "`mmy_active`, `mmy_branchid`, `mmy_inventory`) VALUES ('$data[3]','Y','1','Y' )" );
            
            }else{
                
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`, `mmy_inventory`) VALUES ('$data[3]','Y','1','N' )");
             }
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[3]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
             
        }
                       
           
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[4]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
        while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        
        }else{
            
        $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
        . " `kr_branchid` ) VALUES ('$data[4]','1' )");
            
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[4]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        }
        
        }
        
        
       $inv='null';                        
         
       $mod_date=date("Y-m-d H:i:s");  
       
       if($data[7]!=''){
           
        $base_unit='NULL';     
        $sql_login2  =  $database->mysqlQuery("select  bu_id from tbl_base_unit_master where bu_name='$data[7]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $base_unit="'".$result_login2['bu_id']."'";
        }
        }
          
          
        }else{
          $base_unit='NULL';  
       }
       
       
       if($data[8]!=''){
          
        $unit_id='NULL';     
        $sql_login2  =  $database->mysqlQuery("select  u_id from tbl_unit_master where u_name='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $unit_id="'".$result_login2['u_id']."'";
        }
        }
          
          
        }else{
          $unit_id='NULL';  
       }
         
      
       if($data[6]!=''){
           
          $item_pr_barcode="'".$data[6]."'";     
       }else{
          $item_pr_barcode='NULL';
       }    
       
       if($data[10]>0){
             
          $item_rate_new=$data[10];
   
          $item_rate_new1=$data[10];
           
          $item_rate_new2=$data[10];
          
        }else{
             
          $item_rate_new=0;
   
          $item_rate_new1=0;
           
          $item_rate_new2=0;
          
        }
       
      $shortcode=  substr($data[2], 0,25);
      
      if($data[5]=='Single'){
           
              $rate_type='Portion';     
              
              $portion='1';
              
       }else{
              $rate_type='Unit';
              
              $portion='NULL';  
       }    
       
       
      if($data[5]=='Single'){
           
              $unit_type='NULL';     
       }else{
              $unit_type="'".$data[5]."'";     
       }    
               
       
       if($data[9]>0){
       $weight=$data[9];
       }else{
          $weight=0;  
       }                          
            
        
            
       
                                      $sql_insert="INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`, "
                                    . " `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`,"
                                    . " `mr_prepmode`, `mr_branchid`,  "
                                    . " `mr_unit_type`, `mr_base_unit`, `cloud_sync`,"
                                    . " `mr_product_type`, `mr_raw_barcode`,mr_itemshortcode,mr_rate_type,mr_inventory_kitchen) "
                                    
                                    . " VALUES ('$data[2]','$category','General',"
                                    . " '10','Y','$kitchen','$mod_date','General','1',"
                                    . " $unit_type,$base_unit,'N','$data[0]', $item_pr_barcode,'$shortcode','$rate_type','1')"; 
                            
                     
        $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));
                                 
          
        $menuid='';  
        $sql_login28  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[2]' ");
        $num_login28   = $database->mysqlNumRows($sql_login28);
	if($num_login28){
        while($result_login28  = $database->mysqlFetchArray($sql_login28)){
                
            $menuid=$result_login28['mr_menuid'];
            
            $sql_login28  =  $database->mysqlQuery(" INSERT INTO `tbl_menurate_counter` (`mrc_menuid`, `mrc_rate_type`, `mrc_portion`,
            `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_branchid`, `mrc_rate`, `mrc_default`,
            `mrc_android_sync`, `mrc_barcode`, `cloud_sync`, `mrc_menu_tax_amount`, `mrc_menu_final_amount`, `mrc_menu_tax_value`) VALUES
            ('$menuid','$rate_type',$portion, $unit_type, '$weight',$unit_id,$base_unit,1, '$item_rate_new', 'N','N',"
            . " $item_pr_barcode, 'N','0.000','$item_rate_new','0.000')");
      
            
        $sql_login288  =  $database->mysqlQuery("select  tol_id from tbl_online_order where tol_status='Y' ");
        $num_login288   = $database->mysqlNumRows($sql_login288);
	if($num_login288){
        while($result_login288  = $database->mysqlFetchArray($sql_login288)){
                
                 $sql_login281  =  $database->mysqlQuery("INSERT INTO `tbl_menuratetakeaway`(`mta_menuid`, 
                 `mta_rate_type`, `mta_portion`, `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_branchid`, 
                 `mta_rate`, `mta_default`, `mta_barcode`, `cloud_sync`, `mta_food_partner`, `mta_menu_tax_amount`,
                 `mta_menu_final_amount`, `mta_menu_tax_value`) VALUES
                ('$menuid', '$rate_type', $portion, $unit_type, '$weight', $unit_id, $base_unit, 1, '$item_rate_new1', 'N',$item_pr_barcode,"
                . " 'N','".$result_login288['tol_id']."', '0.000','$item_rate_new1', '0.000')");
        }}
         
         
        $sql_login289  =  $database->mysqlQuery("select  fr_floorid from tbl_floormaster where fr_status='Active' ");
        $num_login289   = $database->mysqlNumRows($sql_login289);
	if($num_login289){
        while($result_login289  = $database->mysqlFetchArray($sql_login289)){
                
            $sql_login2811  =  $database->mysqlQuery(" INSERT INTO `tbl_menuratemaster`(`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,
            `mmr_portion`, `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`, `mmr_default`,
            `mmr_barcode`, `mmr_android_sync`, `cloud_sync`, `mmr_menu_tax_amount`, `mmr_menu_final_amount`, `mmr_menu_tax_value`) VALUES
            ( '$menuid','".$result_login289['fr_floorid']."','$rate_type', $portion, $unit_type, '$weight', $unit_id, $base_unit, "
            . " '$item_rate_new2', 'N',$item_pr_barcode,'N','N', '0.000', '$item_rate_new2', '0.000')");
            
        }}
        
         
    } }
      
        }    
                            
    }
        
    
    
    
    
    unset($data);
    $x++;
                  
                            
    } }    
    
     header('location:dont_delete.php?excel_red=yes');
 }

 
///download recipe//// 
 if(isset($_REQUEST['load_rate_recipe']))
{
    if($_REQUEST['load_rate_recipe']=='download_recipe'){
        
        $data=array();
        $data1=array();
        
        $a=array();
        
        $sql_login  =  $database->mysqlQuery("show columns from tbl_menu_ingredient_detail");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $a[]=$result_login['Field'];
        }
        }
       
        
       
        
        $sql_login1  =  $database->mysqlQuery("select *,tm.mr_menuname from tbl_menu_ingredient_detail ti left join "
        . " tbl_menumaster tm on tm.mr_menuid=ti.tmi_menuid  where tm.mr_delete_mode='N' "
        . " group by ti.tmi_menuid,ti.tmi_ing_menuid order by tm.mr_menuname asc  ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
                
            foreach($a as $val){
                
                 $data['Menu']=$result_login1['mr_menuname'];
                 
                 $data[$val]=$result_login1[$val];
                
               }
               
                array_push($data1,$data);
		unset($data);
            } 
            
       }else{
           
        $sql_login5  =  $database->mysqlQuery("show columns from tbl_menu_ingredient_detail");
        $num_login5   = $database->mysqlNumRows($sql_login5);
	if($num_login5){
            while($result_login5  = $database->mysqlFetchArray($sql_login5)){
            $data[]=$result_login5['Field'];
        }
        }
       
                array_push($data1,$data);
		unset($data);
          
       }
       
        $filename = "Recipe_download_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
    }
}
 
 

   ///upload_recipe////
  if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload_recipe']=="upload_recipe")
    {
       
        if ( $_FILES['excel_upload_recipe']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload_recipe"]["name"];
                        move_uploaded_file($_FILES['excel_upload_recipe']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                
                               $y++;  
                             }
                           
                             if($data[8]==''){
                                 $unit_id='null';
                             }else{
                                 $unit_id= "'$data[8]'";
                             }
                             
                        
                             
                             
        $insertion['tmi_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[2]);
        
        $insertion['tmi_ing_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[3]);
        
        $insertion['tmi_ing_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[4]);
        
        if($data[5]>0){
            
          $insertion['tmi_ing_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[5]);
        
        }else{
            
          $insertion['tmi_ing_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
        }
        
        
        $insertion['tmi_ing_unit'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[6]);
        
        $insertion['tmi_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[7]);
          
        $insertion['tmi_ing_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[8]);
        
        $insertion['tmi_ing_total'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[9]);
        
        $date_in=date('Y-m-d H:i:s');
        
        $insertion['tmi_ing_dayclosedate']      =  mysqli_real_escape_string($database->DatabaseLink,$date_in);
        
        
           if($data[11]>0){
             $insertion['tmi_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[11]);
           }else{
             $insertion['tmi_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
           }
           
            if($data[12]>0){
              $insertion['tmi_wastage_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[12]);
            }else{
               $insertion['tmi_wastage_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
            }
          
           if($data[13]>0){
            $insertion['tmi_wastage_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[13]);
           }else{
             $insertion['tmi_wastage_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
          }
          
           
          $insertion['tmi_di'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[14]);
          
          $insertion['tmi_ta'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[15]);
          
          $insertion['tmi_hd'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[16]);
          
          $insertion['tmi_cs'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[17]);     
          
          $insertion['tmi_store'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[18]);   
          
          $insertion['tmi_store'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[19]); 
          
          $insertion['cloud_sync'] 		=  mysqli_real_escape_string($database->DatabaseLink,'N');   
          
         $insertion['tmi_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$data[21]);
          
          
          
        $sql=$database->check_duplicate_entry('tbl_menu_ingredient_detail',$insertion);
	 if($sql!=1)
	 {
	  $insertid =  $database->insert('tbl_menu_ingredient_detail',$insertion);
                             
         }             
          
        unset($data);
        $x++;
 
                       
                            
    } }    
           
     header('location:dont_delete.php?excel_red=yes');
 }



 
//cs rate////
if(isset($_REQUEST['load_rate_cs']))
{
    if($_REQUEST['load_rate_cs']=='download_rate_cs'){
        
        $data=array();
        $data1=array();
        
        
       
        $sql_login1  =  $database->mysqlQuery("select mr_product_type,mrc_id,mrc_menuid,mrc_rate_type,mrc_portion,mrc_unit_type,mrc_unit_weight,mrc_unit_id, "
        . " mrc_base_unit_id,mrc_rate,mrc_barcode,mr_menuname,kr_kotname,mmy_maincategoryname from tbl_menurate_counter  inner join"
        . " tbl_menumaster on mr_menuid=mrc_menuid  left join tbl_kotcountermaster on kr_kotcode=mr_kotcounter left join tbl_menumaincategory"
        . " on mmy_maincategoryid=mr_maincatid where mr_delete_mode='N' group by mrc_menuid,mrc_portion,mrc_unit_id,mrc_base_unit_id,mrc_unit_weight"
        . " order by mr_menuname,mrc_portion asc  ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
           
                
                
                 $data['Menu Name']=$result_login1['mr_menuname'];
                 $data['Category']=$result_login1['mmy_maincategoryname'];
                 $data['Kitchen']=$result_login1['kr_kotname'];
                 $data['mrc_id [DONT ADD FOR NEW ITEM] ']=$result_login1['mrc_id'];
                 $data['mrc_menuid [DONT ADD FOR NEW ITEM] ']=$result_login1['mrc_menuid'];
                 $data['mrc_rate_type [EG : Unit , Portion] ']=$result_login1['mrc_rate_type'];
                 $data['mrc_portion [EG : 1 for Single , 2 for Half] ']=$result_login1['mrc_portion'];
                 $data['mrc_unit_type [EG : Empty for Portion , Loose , Packet ] ']=$result_login1['mrc_unit_type'];
                 $data['mrc_unit_weight [EG : 1.500 for loose items ] ']=$result_login1['mrc_unit_weight'];
                 $data['mrc_unit_id [EG : 1:GM, 2:KG , 3:LTR , 4:MLTR , 5:Nos ] ']=$result_login1['mrc_unit_id'];
                 $data['mrc_base_unit_id [EG : 1:KG , 2:LTR , 3:Nos ] ']=$result_login1['mrc_base_unit_id'];
                 $data['mrc_rate [EG : Selling Rate ] ']=$result_login1['mrc_rate'];
                 $data['mrc_barcode [EG : Barcode of Item ] ']=$result_login1['mrc_barcode'];
                 $data['mr_product_type [EG : Menu,Finished,Raw ] ']=$result_login1['mr_product_type'];
                 
               
               
                array_push($data1,$data);
		unset($data);
            }      
       }
       
        $filename = "menumaster_rate_cs" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
    }
}




if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload_cs']=="upload_rate_cs")
    {
       
        $sq = $database->mysqlQuery("Truncate tbl_menu_rate_cs_upload");
        if ( $_FILES['excel_upload_rate_cs']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload_rate_cs"]["name"];
                        move_uploaded_file($_FILES['excel_upload_rate_cs']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                
                                 $y++;  
                             }
                           
                             
                           $menuname=$data[0];  
                           
                           
        $category_name=$data[1];  
                           
                           
       
           
        $category=''; 
        
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
                
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
              
        $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
        . " `mmy_active`, `mmy_branchid`,`mmy_inventory`) VALUES ('$category_name','Y','1','N' )");
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
        }
                        
           
        
        
        
        $kitchen_name=$data[2];  
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
          . " `kr_branchid` ) VALUES ('$kitchen_name','1' )");
             
         $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
         $num_login2   = $database->mysqlNumRows($sql_login2);
	 if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
          }
        }
        
        
      }
                             
                          
                           $mrc_id= $data[3];
                           
                           $menuid=$data[4];
                           
                           $rate_type=$data[5];
                           
                           if($data[6]==''){
                               
                                 $portion='null';
                            }else{
                                 $portion=  "'$data[6]'";
                           }
                          
                            if($data[7]==''){
                                 $unit_type='null';
                            }else{
                               $unit_type=  "'$data[7]'";
                           } 
                           
                            if($data[8]==''){
                                 $unit_weight='0';
                            }else{
                                 $unit_weight=  "'$data[8]'";
                            } 
                          
                          
                           if($data[9]==''){
                                 $unit_id='null';
                             }else{
                                 $unit_id= "'$data[9]'";
                             }
                             
                             if($data[10]==''){
                                 $base_unit_id='null';
                             }else{
                                $base_unit_id=  "'$data[10]'";
                            } 
                             
                             
                          if($data[11]>0){   
                             $rate= "'$data[11]'";
                          }else{
                              $rate='0';
                          }
                          
                          if($data[12]!=''){
                              $barcode= "'$data[12]'";
                          }else{
                             $barcode= 'null'; 
                          }
                         
                         $type=$data[13];
                          
        if($mrc_id!='' && $menuid!=''){   
                          
                             $sql_iupdate_ta_mn=$database->mysqlQuery("UPDATE tbl_menumaster set  mr_maincatid='$category' , "
                             . " mr_kotcounter='$kitchen',mr_menuname='$menuname' where mr_menuid='$menuid'   ");  
                          
                              $sql_iupdate_ta_rate=$database->mysqlQuery("UPDATE tbl_menurate_counter "
                              . " mrc_rate_type='$rate_type',mrc_portion=$portion , "
                              . " mrc_unit_type=$unit_type,mrc_unit_weight=$unit_weight, "
                              . " mrc_unit_id=$unit_id,mrc_base_unit_id=$base_unit_id, "
                              . " mrc_rate=$rate, mrc_menu_final_amount=$rate ,  "
                              . " mrc_barcode=$barcode WHERE mrc_id='$mrc_id'  ");          
                            
        }else{
                        
                       $modifydate=date('Y-m-d H:i:s');
                       $modify_user='Admin';
                       $shortcode=  substr($menuname, 0,19);
                          
                       $sql_iupdate_ta_rate=$database->mysqlQuery("INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`,  "
                                    . " `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`,"
                                    . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `mr_inventory_kitchen`, "
                                    . " `mr_raw_barcode`) "
                                    
                                    . " VALUES ('$menuname','$category',"
                                    . " 'General','10','Y','$kitchen','$modifydate','0',"
                                    . " 'General','1','$shortcode','Y','N',"
                                    . " 'N','Y','Y','N','$rate_type',"
                                    . " '$unit_type',$base_unit_id,'N','Y','N','N',"
                                    . " 'N','N','$type','1',"
                                    . " '$barcode') "); 
                       
                          
         $lastid='';
         $sql_login  =  $database->mysqlQuery("select mr_menuid from tbl_menumaster where mr_menuname='$menuname' "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login){
	 while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   {
               
		$lastid=$result_login['mr_menuid'];
                  
          }
         }
          
         $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menurate_counter (`mrc_menuid`,  `mrc_rate_type`,"
         . " `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_rate`,"
         . " `mrc_default`, `mrc_barcode`,mrc_branchid,mrc_portion,mrc_menu_final_amount) "
         . "  VALUES('$lastid','$rate_type',"
         . "  $unit_type,$unit_weight,$unit_id , "
         . "  $base_unit_id,$rate,'Y',$barcode,'1',$portion,$rate) "); 
                           
       }
    
       
       
        unset($data);
        $x++;
                            
        } }    
           
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
    $sq=mysqli_query($con,"CALL proc_dailymenustock");
    
    
     header('location:dont_delete.php?excel_red=yes');
    
    
 }

//ta-hd rate////
 
if(isset($_REQUEST['load_rate_ta']))
{
    if($_REQUEST['load_rate_ta']=='download_rate_ta'){
        
        $data=array();
        $data1=array();
        
        $string='';
        $string.=" where mr_delete_mode='N' ";
        
        if(isset($_REQUEST['online_sel']) && $_REQUEST['online_sel']!=''){
            
          $string.="  and  mta_food_partner='".$_REQUEST['online_sel']."' ";
          
        }
       
       $sql_login1  =  $database->mysqlQuery("select mr_product_type,mta_rate_type,mta_menuid,mta_id,kr_kotname,mr_menuname,mmy_maincategoryname,"
               . " tol_name,mta_portion,mta_unit_weight,mta_unit_type,mta_barcode,mta_rate,mta_base_unit_id,mta_unit_id from tbl_menuratetakeaway"
               . "  inner join tbl_menumaster on mr_menuid=mta_menuid  left join tbl_portionmaster on pm_id=mta_portion left join tbl_menumaincategory"
                  . " on mmy_maincategoryid=mr_maincatid "
               . "  left join tbl_online_order on tol_id=mta_food_partner left join tbl_kotcountermaster on kr_kotcode=mr_kotcounter"
               . "  $string order by mr_menuname,mta_food_partner,mta_portion asc ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
          
                
                $data['Menu Name']=$result_login1['mr_menuname'];
                $data['Category']=$result_login1['mmy_maincategoryname'];
                $data['Kitchen']=$result_login1['kr_kotname'];
               
                 $data['mta_id [DONT ADD FOR NEW ITEM] ']=$result_login1['mta_id'];
                 $data['mta_menuid [DONT ADD FOR NEW ITEM] ']=$result_login1['mta_menuid'];
                 $data['mta_rate_type [EG : Unit , Portion] ']=$result_login1['mta_rate_type'];
                 $data['mta_portion [EG : 1 for Single , 2 for Half] ']=$result_login1['mta_portion'];
                 $data['mta_unit_type [EG : Empty for Portion , Loose , Packet ] ']=$result_login1['mta_unit_type'];
                 $data['mta_unit_weight [EG : 1.500 for loose items ] ']=$result_login1['mta_unit_weight'];
                 $data['mta_unit_id [EG : 1:GM, 2:KG , 3:LTR , 4:MLTR , 5:Nos ] ']=$result_login1['mta_unit_id'];
                 $data['mta_base_unit_id [EG : 1:KG , 2:LTR , 3:Nos ] ']=$result_login1['mta_base_unit_id'];
                 $data['mta_rate [EG : Selling Rate ] ']=$result_login1['mta_rate'];
                 $data['mta_barcode [EG : Barcode of Item ] ']=$result_login1['mta_barcode'];
                 $data['mr_product_type [EG : Menu,Finished,Raw ] ']=$result_login1['mr_product_type'];
                  $data['Online Partner']=$result_login1['tol_name'];
               
                array_push($data1,$data);
		unset($data);
            }      
       }
       
        $filename = "menumaster_rate_ta_hd" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
    }
}




if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload_ta']=="upload_rate_ta")
    {
       
        $sq = $database->mysqlQuery("Truncate tbl_menu_rate_ta_upload");
        if ( $_FILES['excel_upload_rate_ta']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload_rate_ta"]["name"];
                        move_uploaded_file($_FILES['excel_upload_rate_ta']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                            $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                

                                         $y++;  
                                     }
                          
                             
                        
         $menuname=$data[0];  
                           
                           
        $category_name=$data[1];  
               
        $category=''; 
        
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
                
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
              
        $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
        . " `mmy_active`, `mmy_branchid`,`mmy_inventory`) VALUES ('$category_name','Y','1','N' )");
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
        }
                        
           
        
        
        
        $kitchen_name=$data[2];  
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
          . " `kr_branchid` ) VALUES ('$kitchen_name','1' )");
             
         $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
         $num_login2   = $database->mysqlNumRows($sql_login2);
	 if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
          }
        }
        
        
      }
                             
                          
                           $mrc_id= $data[3];
                           
                           $menuid=$data[4];
                           
                           $rate_type=$data[5];
                           
                           if($data[6]==''){
                               
                                 $portion='null';
                            }else{
                                 $portion=  "'$data[6]'";
                           }
                          
                            if($data[7]==''){
                                 $unit_type='null';
                            }else{
                               $unit_type=  "'$data[7]'";
                           } 
                           
                            if($data[8]==''){
                                 $unit_weight='0';
                            }else{
                                 $unit_weight=  "'$data[8]'";
                            } 
                          
                          
                           if($data[9]==''){
                                 $unit_id='null';
                             }else{
                                 $unit_id= "'$data[9]'";
                             }
                             
                             if($data[10]==''){
                                 $base_unit_id='null';
                             }else{
                                $base_unit_id=  "'$data[10]'";
                            } 
                             
                             
                          if($data[11]>0){   
                             $rate= "'$data[11]'";
                          }else{
                              $rate='0';
                          }
                          
                          if($data[12]!=''){
                              $barcode= "'$data[12]'";
                          }else{
                             $barcode= 'null'; 
                          }
                         
                         $type=$data[13];
                         
                         $online_partner_name=$data[14];
                         
                         
        $online_partner='';                        
        $sql_login2  =  $database->mysqlQuery("select  tol_id from tbl_online_order where tol_name='$online_partner_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $online_partner=$result_login2['tol_id'];
        }
        }else{
            
            
           if($online_partner_name!=''){
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_online_order`( `tol_name`, "
          . " `tol_urban_name`,tol_local_order,tol_tax ) VALUES ('$online_partner_name','Takeaway','Y','N' )");
             
           }
          
         $sql_login2  =  $database->mysqlQuery("select  tol_id from tbl_online_order where tol_name='$online_partner_name' ");
         $num_login2   = $database->mysqlNumRows($sql_login2);
	 if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $online_partner=$result_login2['tol_id'];
          }
        }
        
        
      }
                         
                         
                          
        if($mrc_id!='' && $menuid!=''){   
                          
                             $sql_iupdate_ta_mn=$database->mysqlQuery("UPDATE tbl_menumaster set  mr_maincatid='$category' , "
                             . " mr_kotcounter='$kitchen',mr_menuname='$menuname' where mr_menuid='$menuid'   ");  
                          
                              $sql_iupdate_ta_rate=$database->mysqlQuery("UPDATE tbl_menuratetakeaway "
                              . " mta_rate_type='$rate_type',mta_portion=$portion , "
                              . " mta_unit_type=$unit_type,mta_unit_weight=$unit_weight, "
                              . " mta_unit_id=$unit_id,mta_base_unit_id=$base_unit_id, "
                              . " mta_rate=$rate,  mta_menu_final_amount=$rate , "
                              . " mta_barcode=$barcode WHERE mta_id='$mrc_id' and mta_food_partner='$online_partner' ");          
                            
        }else{
                        
                       $modifydate=date('Y-m-d H:i:s');
                       $modify_user='Admin';
                       $shortcode=  substr($menuname, 0,19);
                          
                       $sql_iupdate_ta_rate=$database->mysqlQuery("INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`,  "
                                    . " `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`,"
                                    . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `mr_inventory_kitchen`, "
                                    . " `mr_raw_barcode`) "
                                    
                                    . " VALUES ('$menuname','$category',"
                                    . " 'General','10','Y','$kitchen','$modifydate','0',"
                                    . " 'General','1','$shortcode','Y','N',"
                                    . " 'N','Y','Y','N','$rate_type',"
                                    . " '$unit_type',$base_unit_id,'N','Y','N','N',"
                                    . " 'N','N','$type','1',"
                                    . " '$barcode') "); 
                       
                          
         $lastid='';
         $sql_login  =  $database->mysqlQuery("select mr_menuid from tbl_menumaster where mr_menuname='$menuname' "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login){
	 while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   {
               
		$lastid=$result_login['mr_menuid'];
                  
          }
         }
          
         $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratetakeaway (`mta_menuid`,  `mta_rate_type`,"
         . " `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_rate`,"
         . " `mta_default`, `mta_barcode`,mta_branchid,mta_portion,mta_menu_final_amount,mta_food_partner) "
         . "  VALUES('$lastid','$rate_type',"
         . "  $unit_type,$unit_weight,$unit_id , "
         . "  $base_unit_id,$rate,'Y',$barcode,'1',$portion,$rate,'$online_partner') "); 
                     
         
        
         
         
       }
    
       
       
        unset($data);
        $x++;
           
                      
           } }    
           
     $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
     $sq=mysqli_query($con,"CALL proc_dailymenustock");
     
      header('location:dont_delete.php?excel_red=yes');
     
    }

    
//dinein rate////
    
if(isset($_REQUEST['load_rate']))
{
    if($_REQUEST['load_rate']=='download_rate'){
        
        $data=array();
        $data1=array();
        
        
        $string='';
        
        $string.=" where mr_delete_mode='N'  ";
        
        if($_REQUEST['floor_sel']!=''){
            
          $string.=" and  mmr_floorid='".$_REQUEST['floor_sel']."' ";
        }
       
       $sql_login1  =  $database->mysqlQuery("select mmr_portion,mmr_rate_type,mmr_menuid,mmr_id,kr_kotname,mmy_maincategoryname,mmr_barcode,"
               . " mmr_unit_type,mr_menuname,fr_floorname ,mmr_unit_weight,mmr_unit_id,mmr_base_unit_id,mmr_rate,mr_product_type from tbl_menuratemaster "
               . " inner join tbl_menumaster on mr_menuid=mmr_menuid left join tbl_floormaster on fr_floorid=mmr_floorid left join "
               . " tbl_portionmaster on pm_id=mmr_portion left join tbl_kotcountermaster on kr_kotcode=mr_kotcounter"
               . " left join tbl_menumaincategory on mmy_maincategoryid=mr_maincatid $string order by mr_menuname,mmr_floorid,mmr_portion asc");
       
     
       
       $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
           
                
                $data['Menu Name']=$result_login1['mr_menuname'];
                $data['Category']=$result_login1['mmy_maincategoryname'];
                $data['Kitchen']=$result_login1['kr_kotname'];
               
                 $data['mmr_id [DONT ADD FOR NEW ITEM] ']=$result_login1['mmr_id'];
                 $data['mmr_menuid [DONT ADD FOR NEW ITEM] ']=$result_login1['mmr_menuid'];
                 $data['mmr_rate_type [EG : Unit , Portion] ']=$result_login1['mmr_rate_type'];
                 $data['mmr_portion [EG : 1 for Single , 2 for Half] ']=$result_login1['mmr_portion'];
                 $data['mmr_unit_type [EG : Empty for Portion , Loose , Packet ] ']=$result_login1['mmr_unit_type'];
                 $data['mmr_unit_weight [EG : 1.500 for loose items ] ']=$result_login1['mmr_unit_weight'];
                 $data['mmr_unit_id [EG : 1:GM, 2:KG , 3:LTR , 4:MLTR , 5:Nos ] ']=$result_login1['mmr_unit_id'];
                 $data['mmr_base_unit_id [EG : 1:KG , 2:LTR , 3:Nos ] ']=$result_login1['mmr_base_unit_id'];
                 $data['mmr_rate [EG : Selling Rate ] ']=$result_login1['mmr_rate'];
                 $data['mmr_barcode [EG : Barcode of Item ] ']=$result_login1['mmr_barcode'];
                 $data['mr_product_type [EG : Menu,Finished,Raw ] ']=$result_login1['mr_product_type'];
                 $data['Floor Name']=$result_login1['fr_floorname'];
                
                
               
                array_push($data1,$data);
		unset($data);
            }      
       }
       
       
       
       
        $filename = "menumaster_rate_dine" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
    }
}




if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload_di']=="upload_rate")
    {
       
        $sq = $database->mysqlQuery("Truncate tbl_menu_rate_di_upload");
        if ( $_FILES['excel_upload_rate_di']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload_rate_di"]["name"];
                        move_uploaded_file($_FILES['excel_upload_rate_di']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                

                                 $y++;  
                             }
                         
                             
                             $menuname=$data[0];  
                           
                           
        $category_name=$data[1];  
               
        $category=''; 
        
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
                
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
              
        $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
        . " `mmy_active`, `mmy_branchid`,`mmy_inventory`) VALUES ('$category_name','Y','1','N' )");
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$category_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
        }
                        
           
        
        
        
        $kitchen_name=$data[2];  
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
          . " `kr_branchid` ) VALUES ('$kitchen_name','1' )");
             
         $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$kitchen_name' ");
         $num_login2   = $database->mysqlNumRows($sql_login2);
	 if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
          }
        }
        
        
      }
                             
                          
                           $mrc_id= $data[3];
                           
                           $menuid=$data[4];
                           
                           $rate_type=$data[5];
                           
                           if($data[6]==''){
                               
                                 $portion='null';
                            }else{
                                 $portion=  "'$data[6]'";
                           }
                          
                            if($data[7]==''){
                                 $unit_type='null';
                            }else{
                               $unit_type=  "'$data[7]'";
                           } 
                           
                            if($data[8]==''){
                                 $unit_weight='0';
                            }else{
                                 $unit_weight=  "'$data[8]'";
                            } 
                          
                          
                           if($data[9]==''){
                                 $unit_id='null';
                             }else{
                                 $unit_id= "'$data[9]'";
                             }
                             
                             if($data[10]==''){
                                 $base_unit_id='null';
                             }else{
                                $base_unit_id=  "'$data[10]'";
                            } 
                             
                             
                          if($data[11]>0){   
                             $rate= "'$data[11]'";
                          }else{
                              $rate='0';
                          }
                          
                          if($data[12]!=''){
                              $barcode= "'$data[12]'";
                          }else{
                             $barcode= 'null'; 
                          }
                         
                         $type=$data[13];
                         
                         $online_partner_name=$data[14];
                         
                         
        $online_partner='';                        
        $sql_login2  =  $database->mysqlQuery("select  fr_floorid from tbl_floormaster where fr_floorname='$online_partner_name' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $online_partner=$result_login2['fr_floorid'];
        }
        }else{
            
            
           if($online_partner_name!=''){
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_floormaster`( `fr_floorname`, "
          . " `fr_status`,fr_branchid ) VALUES ('$online_partner_name','Active','1' )");
             
           }
          
         $sql_login2  =  $database->mysqlQuery("select  fr_floorid from tbl_floormaster where fr_floorname='$online_partner_name' ");
         $num_login2   = $database->mysqlNumRows($sql_login2);
	 if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $online_partner=$result_login2['fr_floorid'];
          }
        }
        
        
      }
                         
                         
                          
        if($mrc_id!='' && $menuid!=''){   
                          
                             $sql_iupdate_ta_mn=$database->mysqlQuery("UPDATE tbl_menumaster set  mr_maincatid='$category' , "
                             . " mr_kotcounter='$kitchen',mr_menuname='$menuname' where mr_menuid='$menuid'   ");  
                          
                              $sql_iupdate_ta_rate=$database->mysqlQuery("UPDATE tbl_menuratemaster "
                              . " mmr_rate_type='$rate_type',mmr_portion=$portion , "
                              . " mmr_unit_type=$unit_type,mmr_unit_weight=$unit_weight, "
                              . " mmr_unit_id=$unit_id,mmr_base_unit_id=$base_unit_id, "
                              . " mmr_rate=$rate, mmr_menu_final_amount=$rate , "
                              . " mmr_barcode=$barcode WHERE mmr_id='$mrc_id' and mmr_floorid='$online_partner' ");          
                            
        }else{
                        
                       $modifydate=date('Y-m-d H:i:s');
                       $modify_user='Admin';
                       $shortcode=  substr($menuname, 0,19);
                          
                       $sql_iupdate_ta_rate=$database->mysqlQuery("INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`,  "
                                    . " `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`,"
                                    . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `mr_inventory_kitchen`, "
                                    . " `mr_raw_barcode`) "
                                    
                                    . " VALUES ('$menuname','$category',"
                                    . " 'General','10','Y','$kitchen','$modifydate','0',"
                                    . " 'General','1','$shortcode','Y','N',"
                                    . " 'N','Y','Y','N','$rate_type',"
                                    . " '$unit_type',$base_unit_id,'N','Y','N','N',"
                                    . " 'N','N','$type','1',"
                                    . " '$barcode') "); 
                       
                          
         $lastid='';
         $sql_login  =  $database->mysqlQuery("select mr_menuid from tbl_menumaster where mr_menuname='$menuname' "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
         if($num_login){
	 while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   {
               
		$lastid=$result_login['mr_menuid'];
                  
          }
         }
          
         $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratemaster (`mmr_menuid`,  `mmr_rate_type`,"
         . " `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`,"
         . " `mmr_default`, `mmr_barcode`,mmr_portion,mmr_menu_final_amount,mmr_floorid) "
         . "  VALUES('$lastid','$rate_type',"
         . "  $unit_type,$unit_weight,$unit_id , "
         . "  $base_unit_id,$rate,'Y',$barcode,$portion,$rate,'$online_partner') "); 
                     
         
        
       
         
       }
                             
                            
                            unset($data);
                            $x++;
 
                             
                      
                            
           } }    
           
           
         $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         $sq=mysqli_query($con,"CALL proc_dailymenustock");
         
         
          header('location:dont_delete.php?excel_red=yes');
         
    }


//// full menus download////
    
if(isset($_REQUEST['load']))
{
    if($_REQUEST['load']=='download'){
        
        $data=array();
        $data1=array();
        $a=array();
        
        $sql_login  =  $database->mysqlQuery("show columns from tbl_menumaster");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $a[]=$result_login['Field'];
        }
        }
        
        $string1='';
        $string='';
        
         if(isset($_REQUEST['menu_sel']) && $_REQUEST['menu_sel']!=''){
             
             $string.=" where mr_delete_mode='N' and  mr_product_type='".$_REQUEST['menu_sel']."' ";
        }else{
             $string.=" where mr_delete_mode='N' ";
        }
        
        
        
        
        if(isset($_REQUEST['exist_new']) && $_REQUEST['exist_new']=='new'){
            
             $string.=" and  mr_rate_type='Portion' ";
            
             $string1.=" limit 1 ";
             
        }else{
             $string1.=" ";
        }
        
        
       
       $sql_login1  =  $database->mysqlQuery("select *,mmy_maincategoryname as mr_maincatid,msy_subcategoryname as mr_subcatid, "
               . " kr_kotname as mr_kotcounter,ti_name as mr_inventory_kitchen from tbl_menumaster left join tbl_menumaincategory "
               . " on mmy_maincategoryid=mr_maincatid left join tbl_menusubcategory on msy_subcategoryid=mr_subcatid left join"
               . " tbl_kotcountermaster on kr_kotcode=mr_kotcounter left join tbl_inv_kitchen on ti_id=mr_inventory_kitchen $string $string1");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
            foreach($a as $val){
               
                $data[$val]=$result_login1[$val];
                
        }
               
               
                        
        $sql_login  =  $database->mysqlQuery("select  mrc_rate from tbl_menurate_counter where mrc_menuid='".$result_login1['mr_menuid']."' limit 1 ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
          
        
                   $data['Rate CS']=$result_login['mrc_rate'];
               
        }}else{
                   $data['Rate CS']='0';  
        }   
        
        
        $sql_login  =  $database->mysqlQuery("select  mta_rate from tbl_menuratetakeaway where mta_menuid='".$result_login1['mr_menuid']."' limit 1 ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
          
        
               $data['Rate TA']=$result_login['mta_rate'];
               
        }}else{
            
          $data['Rate TA']='0';  
          
        }   
        
        
       $sql_login  =  $database->mysqlQuery("select  mmr_rate from tbl_menuratemaster where mmr_menuid='".$result_login1['mr_menuid']."' limit 1 ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
          
        
               $data['Rate DI']=$result_login['mmr_rate'];
               
        }}else{
          $data['Rate DI']='0';  
        }    
        
        
               
                array_push($data1,$data);
		unset($data);
        }    
            
       }else{
           
           foreach($a as $val){
               
                $data[$val]='';
          }
               
                array_push($data1,$data);
		unset($data);
       }
       
        $filename = "menumaster" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
    }
}

//// full menus upload////

 if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload']=="upload")
    {
       
        if ($_FILES['excel_upload']['name'] )
		{
            
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload"]["name"];
                        move_uploaded_file($_FILES['excel_upload']['tmp_name'], "../util/Menu_upload/".$file);
                        $file1="../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                

                                 $y++;  
                             }
                             
      ///menu existing check for adding///    
                             
       if($data[0]!=''){
           
        $category='';                       
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[2]' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
            
            if($data[31]=='Raw'){
                
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[2]','Y','1','Y' )" );
            }else{
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[2]','Y','1','N' )");
             }
             
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[2]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
        }
        
         
        $sub_category='';                        
        $sql_login1  =  $database->mysqlQuery("select  msy_subcategoryid from tbl_menusubcategory where msy_subcategoryname='$data[3]' ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
            $sub_category=$result_login1['msy_subcategoryid'];
        }
        }else{
            
            
        if($data[3]!=''){
                
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menusubcategory`( `msy_subcategoryname`, "
          . " `msy_active`, `msy_branchid` ) VALUES ('$data[3]','Y','1' )");
             
            
            
        $sql_login2  =  $database->mysqlQuery("select  msy_subcategoryid from tbl_menusubcategory where msy_subcategoryname='$data[3]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $sub_category=$result_login2['msy_subcategoryid'];
        }
        }
            }
        
        
        }
        
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
             $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
          $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
                    . " `kr_branchid` ) VALUES ('$data[8]','1' )");
             
            
            
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
          }
        }
        
        
      }
        
        
        
           
        $inv='NULL';                        
        $sql_login17  =  $database->mysqlQuery("select  ti_id from tbl_inv_kitchen where ti_name='$data[33]' ");
        $num_login17   = $database->mysqlNumRows($sql_login17);
	if($num_login17){
            while($result_login17  = $database->mysqlFetchArray($sql_login17)){
            $inv=$result_login17['ti_id'];
        }
        }
        
                                 
       $mod_date=date("Y-m-d H:i:s");  
       
       
       if($data[24]!=''){
           
         $base_unit="'".$data[24]."'";  
       }else{
          $base_unit='NULL';  
       }
         
       
       if($data[17]!=''){
           
         $itemcode="'".$data[17]."'";      
       }else{
          $itemcode='NULL';  
       }    
       
       
       if($data[38]!=''){
           
         $item_pr_rate=$data[38];       
       }else{
          $item_pr_rate='0';   
       }    
       
       
        if($data[39]!=''){
           
         $item_pr_barcode="'".$data[39]."'";     
       }else{
          $item_pr_barcode='NULL';
       }    
       
       
       if($data[37]!=''){
           
         $item_pr_reorder=$data[37];     
       }else{
          $item_pr_reorder='0';
       }    
       
        if($data[42]!=''){
           
         $item_central_id=$data[42];     
       }else{
          $item_central_id='NULL';
       }    
       
       
       
    $pkd1 = str_replace('/','-',$data[34]);
    $pkd = date("Y-m-d", strtotime($pkd1));
    
    $exp1 = str_replace('/','-',$data[35]);
    $exp = date("Y-m-d", strtotime($exp1));
              
    if($sub_category!=''){
        
                $sql_login55  =  $database->mysqlQuery(" UPDATE `tbl_menumaster` SET `mr_menuname`='$data[1]',`mr_maincatid`='$category',`mr_subcatid`='$sub_category',
                                         `mr_description`='$data[4]',`mr_diet`='$data[5]',
                                         `mr_time_min`='$data[6]',`mr_active`='$data[7]',`mr_kotcounter`='$kitchen',
                                         `mr_modifieddate`='$mod_date',`mr_modifieduser`='$data[10]',`mr_rating`='$data[11]',
                                         `mr_prepmode`='$data[12]',`mr_branchid`='$data[13]',`mr_itemshortcode`='$data[14]',
                                         `mr_dailystock`='$data[15]',`mr_manualrateentry`='$data[16]',`mr_itemcode`=$itemcode,
                                         `mr_dailystock_in_number`='$data[18]',`mr_android_sync`='$data[19]',
                                         `mr_show_in_kod`='$data[20]',`mr_excempt_tax`='$data[21]',`mr_rate_type`='$data[22]',
                                         `mr_unit_type`='$data[23]',`mr_base_unit`=$base_unit,`mr_add_on`='$data[25]',`mr_show_in_kot_print`='$data[26]',
                                         `cloud_sync`='$data[27]',`manual_barcode`='$data[28]',`mr_ingredient`='$data[29]',`mr_replacer`='$data[30]',
                                         `mr_product_type`='$data[31]',`inv_pdt_id`='$data[32]',`mr_inventory_kitchen`='$inv',`mr_pkd_date`='$pkd',
                                         `mr_exp_date`='$exp',`mr_plu`='$data[36]',`mr_reorder_level`='$item_pr_reorder',"
                  . " `mr_purchase_price`='$item_pr_rate',mr_raw_barcode=$item_pr_barcode,mr_central_id=$item_central_id WHERE mr_menuid='$data[0]' ");
    }else{
        
         $sql_login55  =  $database->mysqlQuery(" UPDATE `tbl_menumaster` SET `mr_menuname`='$data[1]',`mr_maincatid`='$category',
                                         `mr_description`='$data[4]',`mr_diet`='$data[5]',
                                         `mr_time_min`='$data[6]',`mr_active`='$data[7]',`mr_kotcounter`='$kitchen',
                                         `mr_modifieddate`='$mod_date',`mr_modifieduser`='$data[10]',`mr_rating`='$data[11]',
                                         `mr_prepmode`='$data[12]',`mr_branchid`='$data[13]',`mr_itemshortcode`='$data[14]',
                                         `mr_dailystock`='$data[15]',`mr_manualrateentry`='$data[16]',`mr_itemcode`=$itemcode,
                                         `mr_dailystock_in_number`='$data[18]',`mr_android_sync`='$data[19]',
                                         `mr_show_in_kod`='$data[20]',`mr_excempt_tax`='$data[21]',`mr_rate_type`='$data[22]',
                                         `mr_unit_type`='$data[23]',`mr_base_unit`=$base_unit,`mr_add_on`='$data[25]',`mr_show_in_kot_print`='$data[26]',
                                         `cloud_sync`='$data[27]',`manual_barcode`='$data[28]',`mr_ingredient`='$data[29]',`mr_replacer`='$data[30]',
                                         `mr_product_type`='$data[31]',`inv_pdt_id`='$data[32]',`mr_inventory_kitchen`='$inv',`mr_pkd_date`='$pkd',
                                         `mr_exp_date`='$exp',`mr_plu`='$data[36]',`mr_reorder_level`='$item_pr_reorder',"
                 . " `mr_purchase_price`='$item_pr_rate',mr_raw_barcode=$item_pr_barcode,mr_central_id=$item_central_id WHERE mr_menuid='$data[0]' ");
   
         
        
        
    }
        
 }else{
     
 
        //////////menu adding/////////
          
        $category='';                       
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[2]' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
            
            if($data[31]=='Raw'){
                
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[2]','Y','1','Y' )" );
            }else{
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[2]','Y','1','N' )");
             }
            
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[2]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
            
            
        }
                       
           
        $sub_category='NULL';  
        
        $sql_login1  =  $database->mysqlQuery("select  msy_subcategoryid from tbl_menusubcategory where msy_subcategoryname='$data[3]' ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
            while($result_login1  = $database->mysqlFetchArray($sql_login1)){
            $sub_category=$result_login1['msy_subcategoryid'];
        }
        }else{
            if($data[3]!=''){
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menusubcategory`( `msy_subcategoryname`, "
                    . "`msy_active`, `msy_branchid` ) VALUES ('$data[3]','Y','1' )");
             
            
            
        $sql_login2  =  $database->mysqlQuery("select  msy_subcategoryid from tbl_menusubcategory where msy_subcategoryname='$data[3]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $sub_category=$result_login2['msy_subcategoryid'];
        }
        }
        
            }
        
        }
        
        
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
                    . " `kr_branchid` ) VALUES ('$data[8]','1' )");
             
            
            
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[8]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        }
        
        }
        
        
         $inv='null';                        
        $sql_login17  =  $database->mysqlQuery("select  ti_id from tbl_inv_kitchen where ti_name='$data[33]' ");
        $num_login17   = $database->mysqlNumRows($sql_login17);
	if($num_login17){
            while($result_login17  = $database->mysqlFetchArray($sql_login17)){
            $inv=$result_login17['ti_id'];
        }
        }
            
        
       $mod_date=date("Y-m-d H:i:s");  
       
       if($data[24]!=''){
           
          $base_unit="'".$data[24]."'";  
       }else{
          $base_unit='NULL';  
       }
         
       
       if($data[17]!=''){
           
          $itemcode="'".$data[17]."'";      
       }else{
          $itemcode='NULL';  
       }    
       
     
       if($data[38]!=''){
           
          $item_pr_rate=$data[38];       
       }else{
          $item_pr_rate='0';   
       }    
       
       
       if($data[39]!=''){
           
          $item_pr_barcode="'".$data[39]."'";     
       }else{
          $item_pr_barcode='NULL';
       }    
       
       
        if($data[37]!=''){
           
          $item_pr_reorder=$data[37];     
       }else{
          $item_pr_reorder='0';
       }    
       
       
       if($data[42]!=''){
           
          $item_central_id="'".$data[42]."'";        
       }else{
          $item_central_id='NULL';
       }    
       
        if($data[43]!=''){
           
          $item_excempt_id="'".$data[43]."'";     
       }else{
          $item_excempt_id='NULL';
       }    
       
       
        if($data[44]!=''){
           
          $item_rate_new=$data[44];     
       }else{
          $item_rate_new='0';
       }    
       
        if($data[45]!=''){
           
          $item_rate_new1=$data[45];     
       }else{
          $item_rate_new1='0';
       }    
       
       
        if($data[46]!=''){
           
          $item_rate_new2=$data[46];     
       }else{
          $item_rate_new2='0';
       }    
       
    $pkd1 = str_replace('/','-',$data[34]);
    $pkd = date("Y-m-d", strtotime($pkd1));
    
    $exp1 = str_replace('/','-',$data[35]);
    $exp = date("Y-m-d", strtotime($exp1));
    
      
     if($sub_category!=''){
                                 
                            $sql_insert="INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`, `mr_subcatid`, `mr_description`, "
                                    . "`mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, `mr_itemcode`, "
                                    . "`mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `inv_pdt_id`, `mr_inventory_kitchen`, `mr_pkd_date`, "
                                    . "`mr_exp_date`, `mr_plu`, `mr_reorder_level`, `mr_purchase_price`,`mr_raw_barcode`,`mr_central_id`,mr_excempt_disc) "
                                    
                                    . "VALUES ('$data[1]','$category','$sub_category','$data[4]',"
                                    . "'$data[5]','$data[6]','$data[7]','$kitchen','$mod_date','$data[10]','$data[11]',"
                                    . "'$data[12]','$data[13]','$data[14]','$data[15]','$data[16]',$itemcode,"
                                    . "'$data[18]','$data[19]','$data[20]','$data[21]','$data[22]',"
                                    . "'$data[23]',$base_unit,'$data[25]','$data[26]','$data[27]','$data[28]',"
                                    . "'$data[29]','$data[30]','$data[31]','$data[32]',$inv,'$pkd',"
                                    . "'$exp','$data[36]','$item_pr_reorder','$item_pr_rate',$item_pr_barcode,$item_central_id,$item_excempt_id )"; 
                            
                            
                          
                            
                            $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));

                             }else{
                                 
                                 $sql_insert="INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`,  `mr_description`, "
                                    . "`mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, `mr_itemcode`, "
                                    . "`mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `inv_pdt_id`, `mr_inventory_kitchen`, `mr_pkd_date`, "
                                    . "`mr_exp_date`, `mr_plu`, `mr_reorder_level`, `mr_purchase_price`,`mr_raw_barcode`,`mr_central_id`,mr_excempt_disc) "
                                    
                                    . "VALUES ('$data[1]','$category','$data[4]',"
                                    . "'$data[5]','$data[6]','$data[7]','$kitchen','$mod_date','$data[10]','$data[11]',"
                                    . "'$data[12]','$data[13]','$data[14]','$data[15]','$data[16]',$itemcode,"
                                    . "'$data[18]','$data[19]','$data[20]','$data[21]','$data[22]',"
                                    . "'$data[23]',$base_unit,'$data[25]','$data[26]','$data[27]','$data[28]',"
                                    . "'$data[29]','$data[30]','$data[31]','$data[32]',$inv,'$pkd',"
                                    . "'$exp','$data[36]','$item_pr_reorder','$item_pr_rate',$item_pr_barcode,$item_central_id,$item_excempt_id)"; 
                            
                     
                                 
                                 
                                 
                                 
                            $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));
                                 
          }
          
        $menuid='';  
        $sql_login28  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[1]' ");
        $num_login28   = $database->mysqlNumRows($sql_login28);
	if($num_login28){
            while($result_login28  = $database->mysqlFetchArray($sql_login28)){
                
            $menuid=$result_login28['mr_menuid'];
            
            $sql_login28  =  $database->mysqlQuery(" INSERT INTO `tbl_menurate_counter` (`mrc_menuid`, `mrc_rate_type`, `mrc_portion`,
                `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_branchid`, `mrc_rate`, `mrc_default`,
                `mrc_android_sync`, `mrc_barcode`, `cloud_sync`, `mrc_menu_tax_amount`, `mrc_menu_final_amount`, `mrc_menu_tax_value`) VALUES
              ('$menuid', 'Portion', 1, NULL, '0.00000', NULL, NULL, 1, $item_rate_new, 'N', 'N',$item_pr_barcode, 'N', '0.000', '$item_rate_new', '0.000')");
      
          
        $sql_login288  =  $database->mysqlQuery("select  tol_id from tbl_online_order where tol_status='Y' ");
        $num_login288   = $database->mysqlNumRows($sql_login288);
	if($num_login288){
            while($result_login288  = $database->mysqlFetchArray($sql_login288)){
                
             $sql_login281  =  $database->mysqlQuery("INSERT INTO `tbl_menuratetakeaway`(`mta_menuid`, 
                 `mta_rate_type`, `mta_portion`, `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_branchid`, 
                 `mta_rate`, `mta_default`, `mta_barcode`, `cloud_sync`, `mta_food_partner`, `mta_menu_tax_amount`,
                 `mta_menu_final_amount`, `mta_menu_tax_value`) VALUES
                ('$menuid', 'Portion', 1, NULL, '0.00000', NULL, NULL, 1, $item_rate_new1, 'N',$item_pr_barcode, 'N','".$result_login288['tol_id']."', '0.000',"
                     . " '$item_rate_new1', '0.000')");
        }}
         
             
        
         $sql_login289  =  $database->mysqlQuery("select  fr_floorid from tbl_floormaster where fr_status='Active' ");
        $num_login289   = $database->mysqlNumRows($sql_login289);
	if($num_login289){
            while($result_login289  = $database->mysqlFetchArray($sql_login289)){
              $sql_login2811  =  $database->mysqlQuery(" INSERT INTO `tbl_menuratemaster`(`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,
                  `mmr_portion`, `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`, `mmr_default`,
                  `mmr_barcode`, `mmr_android_sync`, `cloud_sync`, `mmr_menu_tax_amount`, `mmr_menu_final_amount`, `mmr_menu_tax_value`) VALUES
                ('$menuid','".$result_login289['fr_floorid']."','Portion', 1, NULL, '0.00000', NULL, NULL, $item_rate_new2, 'N',$item_pr_barcode, 'N','N' , "
                      . " '0.000', '$item_rate_new2', '0.000')");
        }}
        
         
            }
        }
          
          
       
                            
                            
       }
                          
               unset($data);
               $x++;

       }
                    
                    
       }
                            
         header('location:dont_delete.php?excel_red=yes');
    }

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Uploads</title>
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
.ui-autocomplete{z-index:999999 !important;}
.popup_upload_msg{position: absolute;width: 250px;height:30px;margin: auto;left: 0;right: 0;top: 0;bottom: 0;color: #f00;font-size: 18px}
.border_blink {
border: 1px solid rgb(255, 0, 0);
border: 3px solid rgba(255, 0, 0, 1);
-webkit-background-clip: padding-box; /* for Safari */
background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
 -webkit-animation: underBlink 1s infinite;
 -moz-animation:    underBlink 1s infinite;
 -o-animation:      underBlink 1s infinite;
 animation:         underBlink 1s infinite;
}

@-webkit-keyframes underBlink {
 0%   { border: 3px solid rgba(255, 0, 0, .2); }
 100% { border: 3px solid rgba(255, 0, 0, .9); }
}
@-moz-keyframes underBlink {
 0%   { border: 3px solid rgba(255, 0, 0, .2); }
 100% { border: 3px solid rgba(255, 0, 0, .9); }
}

@keyframes underBlink {
 0%   { border: 3px solid rgba(255, 0, 0, .2); }
 100% { border: 3px solid rgba(255, 0, 0, .9); }
}


</style>
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
         
        
      $('.alert_error_popup_all_in_one').show();
                                    
      $('.alert_error_popup_all_in_one').text('READ WARNINGS BEFORE UPLOADING ');
       
      $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');  
                
                
//    var ctrlKeyDown = false;
//    $(document).on("keydown", keydown);
//       
//    function keydown(e) { 
//
//    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
//        // Pressing F5 or Ctrl+R
//        e.preventDefault();
//    } else if ((e.which || e.keyCode) == 17) {
//        // Pressing  only Ctrl
//        ctrlKeyDown = true;
//    }
//   };     
//                
                
                
                
                
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
.contant_table_cc{height:89vh;}
.tablesorter tbody{height:81vh;}
 .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
	display:none;
		}
    .button_xlmudpdates{display: inline-flex;}
</style>
</head>
<body style="overflow-x: hidden">
    
    <div class=" confrmation_overlay_proce" id="sms_email_loader">
        
    </div>
    
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
                        
                             
                    	
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <!--<div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="clrkot()" ></a>
                      </div>  -->
                   </div>
                    <div class="col-md-12 contant_table_cc">
                     <form enctype="multipart/form-data"   method="post" name="submitxmldetails" id="submitxmldetails">
                     <input type="hidden" name="typeofupload" id="typeofupload" >
                      <input type="hidden" name="typeofupload_di" id="typeofupload_di" >
                      <input type="hidden" name="typeofupload_ta" id="typeofupload_ta" >
                      <input type="hidden" name="typeofupload_cs" id="typeofupload_cs" >
                       <input type="hidden" name="typeofupload_recipe" id="typeofupload_recipe" >
                       <input type="hidden" name="typeofupload_simple" id="typeofupload_simple" >
                       
                      <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            
                            <thead >
                              <tr>
                              <th>DOWNLOAD</th>
                              <th>SELECT EXCEL FILE</th>
                             
                              <th>WARNINGS</th>
                              </tr>
                             </thead>
                                
        <tr id=""  class="select" style="display:none">
        <td>
            
        <a style="width:40%;float: left;font-size: 11px" class="button_xlmudpdates"  href="#" onClick="menusubmit('download')">Item-Finished-Raw  </a>
                                    
                                    
                                        <select style="width:23%;    font-size: 9px;" id="menu_sel">
                                        <option value="" >All TYPE</option>
                                        
                                        <option value="Menu" >Item</option>                     
                                        <option value="Finished" >Finished</option>                     
                                        <option value="Raw" >Raw</option>                     
      
                                        </select>
                                    
                                       <select style="width:28%;    font-size: 9px;" id="exist_new">
                                       <option value="new" >NEW ITEMS</option>
                                        
                                       <option value="existing" >EXISTING</option>                     
                                           
                                       </select>
        </td>
                                  
                                    
                                    
                                   
                                <td > 
                                 <br>  <br> 
                                <input style="display:block;color:transparent;padding-left: 3px;"  type="file" name="excel_upload" id="excel_upload" accept= application/vnd.ms-excel  onchange="menusubmit('upload')" />
                                
                                <label style="position: relative;top: -20px;margin-left: 83px;color: darkred;text-decoration: underline;font-size: 12px;font-style: italic" for="img"> Drag & Drop Item Excel File </label>
      
                                
                                </td>
                                <td > 
                                    <a style="width:55%;display:none;margin-left: 79px;font-size: 10px" class="button_xlmudpdates"  href="#" onClick="menusubmit('upload')">Item - Finished - Raw </a>
                                
                                
                                
       
                                
                                
                                
                                </td>
        </tr>
               
        
        <tr id=""  class="select">
            
        <td><a style="width:52%;float: left;" class="button_xlmudpdates"  href="#" onClick="simple_dw_up('download')">Simple Item Download </a></td>
        <td><input type="file" name="excel_upload_simple"  accept= application/vnd.ms-excel id="excel_upload_simple"  onchange="simple_dw_up('upload')" style="color:transparent;padding-left: 3px"/>
           <label style="position: relative;top: -20px;margin-left: 95px;color: darkred;text-decoration: underline;font-size: 11px;font-style: italic" for="img"> Drag & Drop Simple Excel File </label>
        </td>
        <td>
            <a style="width:40%;display: none" class="button_xlmudpdates"  href="#" onClick="simple_dw_up('upload')">Simple Item Upload  </a>
        
        
         <div class="notebox border_blink" id="notebox" style="text-align: center;height: 47px;display:block;color:darkred;font-size:10px;font-weight: bold;bottom:-3px;left:2px;position:relative;width: 228px;display: inline-block;margin-bottom: 10px">
         WARNING : Remove All Empty Row Above Heading & Keep 'Item Id' Empty For New Items In All Excel
  
                            
                </div> 
        
        </td>
        
        </tr>
        
        
        
        
        
                              
        <tr></tr>
                              
       <tr id=""  class="select">
              
        <td>
             
        <a style="width:52%" class="button_xlmudpdates"  href="#" onClick="menu_rate('download_rate')">Rate Download DI </a>
                                    
        <select style="width:44%;" id="floor_sel">
        <option value="" >Select Floor</option>
        <?php
        $sql_login  =  $database->mysqlQuery(" select * from tbl_floormaster where fr_status='Active '");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
                                        ?>
        <option value="<?=$result_login['fr_floorid']?>" ><?=$result_login['fr_floorname']?></option>                     
                                        
        <?php } } ?>
                                        
         </select>
         </td>
                                
        <td><input type="file" name="excel_upload_rate_di" accept= application/vnd.ms-excel id="excel_upload_rate_di" onchange="menu_rate('upload_rate')" style="color:transparent;padding-left: 3px"/>
        
         <label style="position: relative;top: -20px;margin-left: 95px;color: darkred;text-decoration: underline;font-size: 11px;font-style: italic" for="img"> Drag & Drop DI Excel File </label>
      
        
        </td>
        
       <td>
           <a style="width:40%;display: none" class="button_xlmudpdates"  href="#" onClick="menu_rate('upload_rate')">Rate Update DI </a>
       
          <div class="notebox border_blink" id="notebox" style="display:block;color:darkred;font-size:10px;bottom:0px;left:2px;position:relative;width: 228px;display: inline-block;margin-bottom: 10px;font-weight: bold">
              &nbsp;  NOTE: &nbsp; HEADING SHOULD BE THE FIRST ROW IN ALL EXCEL UPLOAD
         
           </div>  
           
           
           
       </td>
       
       </tr>
                                 
                              
       <tr></tr>
       
        <tr id=""  class="select">
            
        <td><a style="width:52%" class="button_xlmudpdates"  href="#" onClick="menu_rate_ta('download_rate_ta')">Rate Download TA </a>
                                    
          <select style="width:44%;" id="online_sel" >
           <option value="" >Select Partner</option>
           <?php
          $sql_login  =  $database->mysqlQuery(" select * from tbl_online_order	 where tol_status='Y '");
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
          while($result_login  = $database->mysqlFetchArray($sql_login)){
          ?>
           
           <option value="<?=$result_login['tol_id']?>" ><?=$result_login['tol_name']?></option>                     
                                        
          <?php } } ?>
           
          </select>
        </td>
        
        <td><input type="file" name="excel_upload_rate_ta" accept= application/vnd.ms-excel id="excel_upload_rate_ta" onchange="menu_rate_ta('upload_rate_ta')" style="color:transparent;padding-left: 3px"/>
            <label style="position: relative;top: -20px;margin-left: 95px;color: darkred;text-decoration: underline;font-size: 11px;font-style: italic" for="img"> Drag & Drop TA Excel File </label>
        </td>
       
        <td >
            <a style="width:40%;display: none" class="button_xlmudpdates"  href="#" onClick="menu_rate_ta('upload_rate_ta')">Rate Update TA-HD </a>
        
        <div class="notebox border_blink" id="notebox" style="text-align: center;height: 47px;display:block;color:darkred;font-size:10px;font-weight: bold;bottom:0px;left:2px;position:relative;width: 228px;display: inline-block;margin-bottom: 10px">
   &nbsp; WARNING : &nbsp;&nbsp; DO NOT RENAME EXCEL FILE  . DON'T EDIT SAME EXCEL FILE AFTER UPLOADING
  
                            
                </div> 
        
        
        </td>
       
        </tr>
                              
                            <tr></tr>
                              
                            <tr id=""  class="select">
                                <td><a style="width:52%;float: left;" class="button_xlmudpdates"  href="#" onClick="menu_rate_cs('download_rate_cs')">Rate Download CS </a></td>
                                <td><input onchange="menu_rate_cs('upload_rate_cs')" type="file" name="excel_upload_rate_cs"  accept= application/vnd.ms-excel id="excel_upload_rate_cs" style="color:transparent;padding-left: 3px"/>
                                   <label style="position: relative;top: -20px;margin-left: 95px;color: darkred;text-decoration: underline;font-size: 11px;font-style: italic" for="img"> Drag & Drop CS Excel File </label>
                                </td>
                                <td>
                                    <a style="width:40%;display: none" class="button_xlmudpdates"  href="#" onClick="menu_rate_cs('upload_rate_cs')">Rate Update CS </a>
                                
                                <div class="notebox border_blink" id="notebox" style="display:block;color:darkred;font-size:10px;bottom:0px;left:2px;position:relative;width: 228px;display: inline-block;margin-bottom: 10px;font-weight: bold">
    &nbsp;   NOTE : &nbsp;&nbsp; Before Uploading Excel File - SAVE AS EXCEL WORKBOOK 97-2003 xls.
  
                            
                </div> 
                                
                                
                                </td>
                            </tr>
                              
                              
                             
                              
                              
       
        
        
        <tr id=""  class="select">
            
        <td><a style="width:52%;float: left;" class="button_xlmudpdates"  href="#" onClick="recipe_dw_up('download_recipe')">Recipe Download </a></td>
        <td><input type="file" name="excel_upload_recipe"  accept= application/vnd.ms-excel id="excel_upload_recipe" onchange="recipe_dw_up('upload_recipe')" style="color:transparent;padding-left: 3px"/>
            <label style="position: relative;top: -20px;margin-left: 95px;color: darkred;text-decoration: underline;font-size: 11px;font-style: italic" for="img"> Drag & Drop Recipe Excel File </label>
        </td>
        <td><a style="width:40%;display: none" class="button_xlmudpdates"  href="#" onClick="recipe_dw_up('upload_recipe')">Recipe Upload  </a></td>
        
        </tr>
        
                  
        
        
        
         <tr style="height:70px" class="select">
                                
        <td><a  onClick="menu_rate_barcode('download_barcode')" style="float: left;width:92%;height: 40px;font-size: 9px;padding: 8px;background-color: darkred;color: white;cursor: pointer;font-weight: bold" class="button_xlmudpdates"   > DOWNLOAD BARCODE PLU [4 Digit Plu # 5 Digit Weight] </a></td>
                                
                                
        <td>
            
            <a  onClick="menu_rate_urban('download_urban')" style="margin-left: 0px;width:45%;height: 40px;font-size: 9px;padding: 8px;background-color: darkred;color: white;cursor: pointer;font-weight: bold;" class="button_xlmudpdates"   > DOWNLOAD URBAN PIPER  </a>
        
         <select id="urban_partner">
         <option value="" >SELECT PARTNER</option>
         
        <?php 
         
        $sql_login2  =  $database->mysqlQuery("select tol_id,tol_name,tol_urban_name from tbl_online_order where tol_local_order ='N'  ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
        while($result_login2  = $database->mysqlFetchArray($sql_login2)){
        ?>
                                        
        <option value="<?=$result_login2['tol_urban_name']?>" ><?=$result_login2['tol_urban_name']?></option>                 
                                        
        <?php } } ?>
                                        
        </select>  
        
        
        </td>
                          
         <td>
             
           <?php  if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?>
            <a  onClick="push_rate_urban()" style="margin-left: 0px;width:50%;height: 40px;font-size: 9px;padding: 8px;background-color: darkred;color: white;cursor: pointer;font-weight: bold;" class="button_xlmudpdates"   > PUSH URBAN PIPER MENU </a>
           <?php } ?>
            
        </td>
        
                              
        </tr>
                               
                              
                        </table>
                        </form>
                       
                       
                       <input type="hidden" id="alertmessage" value="<?=$s?>">
                       
                       <div class="popup_upload_msg" id="popup_upload_msg">
                           
                            <?=$s?>
                        </div>
                       
                      
                   </div>
                   
                   
                    </div><!--main_cc-->
                    
                </div><!--main content-sec-->
		</div>
                        
	</div>
            
</div>
    
</div><!--container-->

</div>
     

<div class="new_overlay_1"></div>


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


<script type="text/javascript">
   
function push_rate_urban(){
    
    $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
     window.location="menu_uploads.php?push_urban_menu=go";   
    
    
    
}




function menusubmit(typeval)
{

if(typeval=='download'){
    
    var menu_sel=$('#menu_sel').val();
    
    var exist_new=$('#exist_new').val();


  if(exist_new=='new'){
      alert('COPY PASTE THE EXAMPLE MENU PROVIDED AND CHANGE DETAILS');
      
  }else{
      alert('ENTER NEW ITEM DETAILS IN THE LAST OF EXCEL SHEET OR UPDATE THE DATA'); 
  }
  

 if(menu_sel==''){
 
  window.location="menu_uploads.php?load="+typeval+"&exist_new="+exist_new;
  
  }else{
     
   window.location="menu_uploads.php?load="+typeval+"&menu_sel="+menu_sel+"&exist_new="+exist_new;       
   $('#menu_sel').val('');
   
  }
    
    
 
  }
  else if(typeval=='upload'){
      
      
     var ee=$('#excel_upload').val();
     var check = confirm("Are you sure you added empty row above heading and kept mr_menuid empty for new items added ?");
	if(check==true)
	{
     if(ee!=''){
         
     $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />');   
     
        $("#typeofupload").val(typeval);	
	document.submitxmldetails.submit();
        }else{
        alert('Select Excel File');
        
    }
    }
    
}

}

function menu_rate_urban(id){

var urban_partner=$('#urban_partner').val();

if(urban_partner!=''){
 window.location="menu_uploads.php?download_rate_urban=download_uraban_rate&urban_partner="+urban_partner;   
 }else{
  //   alert('Select Online Partner')
     
      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select Online Partner');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
     
     $('#urban_partner').focus();
        }



}


function menu_rate_barcode(id){

                      
$('#add_stock_pop').show();


 //window.location="menu_uploads.php?download_rate_barcode=download_barcode_rate";   

}
  
  function go_excel(){
      
      
      var dw=$('#dw_loc').val();
      
        var jh=$('#jh_loc').val();
      
      
      window.location="menu_uploads.php?download_rate_barcode=download_barcode_rate&dw="+dw+"&jh="+jh;   
      $('#add_stock_pop').hide();
  }
  
  
            
function menu_rate(typeval)
{
//alert(typeval);

var floor_sel=$('#floor_sel').val();

if(typeval=='download_rate'){
 
 
 if(floor_sel==''){
  window.location="menu_uploads.php?load_rate="+typeval+"&floor_sel=";    
 }
 else{
   window.location="menu_uploads.php?load_rate="+typeval+"&floor_sel="+floor_sel;    
   $('#floor_sel').val('');
 }
  
  
  }
  else if(typeval=='upload_rate'){
      
      
      var ee=$('#excel_upload_rate_di').val();
      
      var str2 = "rate_dine";
if(ee.indexOf(str2) != -1){
      
   
         $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
        $("#typeofupload_di").val(typeval);	
	document.submitxmldetails.submit();
        
     }else{
    
    alert('INCORRECT FILE FOR DINEIN');
    
    }
    
    
}
}



function menu_rate_ta(typeval)
{
//alert(typeval);
if(typeval=='download_rate_ta'){
    
 var online_sel=$('#online_sel').val();

 if(online_sel==''){
 
  window.location="menu_uploads.php?load_rate_ta="+typeval;    
 } else{
   window.location="menu_uploads.php?load_rate_ta="+typeval+"&online_sel="+online_sel;    
   $('#online_sel').val('');
  }
  
  
  }
  else if(typeval=='upload_rate_ta'){
      var ee=$('#excel_upload_rate_ta').val();
      
     
var str2 = "rate_ta_hd";
if(ee.indexOf(str2) != -1){
   

      
    
         $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
        $("#typeofupload_ta").val(typeval);	
	document.submitxmldetails.submit();
       
    
    }else{
    
    alert('INCORRECT FILE FOR TA HD');
    
    }
    
    
}




}

function menu_rate_cs(typeval)
{
//alert(typeval);
if(typeval=='download_rate_cs'){
 
  window.location="menu_uploads.php?load_rate_cs="+typeval;    
  }
  else if(typeval=='upload_rate_cs'){
      
      
      var ee=$('#excel_upload_rate_cs').val();
      
       var str2 = "rate_cs";
if(ee.indexOf(str2) != -1){
    
     $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
     $("#typeofupload_cs").val(typeval);
        
    document.submitxmldetails.submit();
  
    }else{
        alert('INCORRECT FILE FOR CS');
    }
     
}

}


function recipe_dw_up(typeval)
{

if(typeval=='download_recipe'){
 
  window.location="menu_uploads.php?load_rate_recipe="+typeval;    
  }
  else if(typeval=='upload_recipe'){
      
      
      var ee=$('#excel_upload_recipe').val();
      
    
       
  if(ee!= ''){
    
     $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
     $("#typeofupload_recipe").val(typeval);
        
    document.submitxmldetails.submit();
  
    }else{
        alert('UPLOAD FILE');
    }
     
}


}

function simple_dw_up(typeval)
{

if(typeval=='download'){
 
  window.location="menu_uploads.php?load_simple_menu="+typeval;    
  }
  else if(typeval=='upload'){
      
      
      var ee=$('#excel_upload_simple').val();
      
    
       
  if(ee!= ''){
    
     $('.confrmation_overlay_proce').css('display','block');
     $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
     $("#typeofupload_simple").val(typeval);
        
     document.submitxmldetails.submit();
  
    }else{
        alert('UPLOAD FILE');
    }
     
}


}





</script>



<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<!--<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter(); 
});  
</script>-->

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>


<style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:465px;height:180px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
      
    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd">  
        <a href="#" onclick="$('#add_stock_pop').hide();"><div class="stok_add_popup_cls">
                <img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt" id="cus_div">
            
            <span style="font-size:10px;font-weight: bold;color: darkred">  ENTER DOWNLOAD LOCATION AND JHMA LOCATION </span> 
            
            <input value="C:\Users\explore10\Downloads\PLU.xls" type="text" class="stock_add_txtbx" id="dw_loc" placeholder="DOWNLOADS LOCATION ">
            
            <input  value="D:\Jhma\PLU.xls" style="margin-top: 2px; " type="text" class="stock_add_txtbx" id="jh_loc" placeholder="JHMA LOCATION ">
              
            
            
             <a  onclick="go_excel();" href="#"><div class="stock_add_btn">GO</div></a>
            
        </div>
        
    </div>
   </div>


</body>
</html>

<?php

  class credit_details {
    private $slno;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols =5;
	$leftCols2 =20;
        $rightCols =15;
	$rightCols1 =15;
        $rightCols2 =15;
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_LEFT) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left2$right$right1$right2\n";
    }
}

?>