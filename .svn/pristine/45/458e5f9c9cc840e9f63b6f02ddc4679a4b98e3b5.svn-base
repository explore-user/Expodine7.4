<?php
session_start();
include("database.class.php"); 
$database	= new Database();

if(isset($_REQUEST['item_ing']) && $_REQUEST['item_ing']!='')
{ 
        $row2=array();
	$insertion['tmi_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menu_add_id']);
        
        $insertion['tmi_ing_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['item_ing_menuid']);
        
        $insertion['tmi_ing_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['item_ing']);
        
        if($_REQUEST['qty_ing']>0){
        $insertion['tmi_ing_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['qty_ing']);
        }else{
          $insertion['tmi_ing_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
        }
        
        
        if($_REQUEST['rate_type_ing']=='Portion'){
            
            $unit_in='Single';
            
            $rt='Single';
        }else{
            $unit_in='';
            
             $fnct_menu = $database->mysqlQuery("select bu_name from tbl_base_unit_master where bu_id='".$_REQUEST['base']."'  ");
          $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $unit_in=$result_fnctvenue['bu_name'];
                  }
           }
             
             
             $rt=$_REQUEST['type_ing'];
        }
        
        
          $insertion['tmi_ing_unit'] 		=  mysqli_real_escape_string($database->DatabaseLink,$unit_in);
        
          
          $insertion['tmi_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$rt);
          
        
        
          
        $insertion['tmi_ing_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['rate_ing']);
        $insertion['tmi_ing_total'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['tot_ing']);
        
        
        $date_in=date('Y-m-d H:i:s');
        $insertion['tmi_ing_dayclosedate']      =  mysqli_real_escape_string($database->DatabaseLink,$date_in);
        
    	
 
          
          
           if($_REQUEST['weight_ing']>0){
             $insertion['tmi_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['weight_ing']);
           }else{
          $insertion['tmi_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
        }
           
            if($_REQUEST['waste_qty']>0){
              $insertion['tmi_wastage_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['waste_qty']);
            }else{
          $insertion['tmi_wastage_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
        }
          
           if($_REQUEST['waste_rate']>0){
            $insertion['tmi_wastage_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['waste_rate']);
           }else{
          $insertion['tmi_wastage_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,0);   
        }
          
           
          $insertion['tmi_di'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['di_ing']);
          $insertion['tmi_ta'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ta_ing']);
          $insertion['tmi_hd'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['hd_ing']);
          $insertion['tmi_cs'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['cs_ing']);
          
          if($_REQUEST['menu_portion']!='' && $_REQUEST['menu_portion']!='undefined' ){
             $insertion['tmi_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menu_portion']);
          }
          
          
        $sql=$database->check_duplicate_entry('tbl_menu_ingredient_detail',$insertion);
	 if($sql!=1)
	 {
	  $insertid =  $database->insert('tbl_menu_ingredient_detail',$insertion);
        
         
          
          $fnct_menu = $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$_REQUEST['menu_add_id']."' and tmi_ing_name='".$_REQUEST['item_ing']."' ");
          $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
           }
            
          echo json_encode($row2);
          
         }        
           
}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='delcar'){
    
  $fnct_menu = $database->mysqlQuery("Delete from tbl_menu_ingredient_detail where tmi_id='".$_REQUEST['id']."'");
    
}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='load_ing_data'){
    
 $fnct_menu = $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$_REQUEST['menu_id_ing']."'  ");
       
 $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
            
          echo json_encode($row2);
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='check_food_cost'){
    
  $di=0; $ta=0; $hd=0; $cs=0;
  $fnct_menu = $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$_REQUEST['menuid_main']."'  ");
       
  $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      
                if($result_fnctvenue['tmi_di']=='Y'){
                    
                    $di=$di+$result_fnctvenue['tmi_ing_total'];
                   
                 }  
                  
                 if($result_fnctvenue['tmi_ta']=='Y'){
                    $ta=$ta+$result_fnctvenue['tmi_ing_total'];
                   
                } 
                
                 if($result_fnctvenue['tmi_hd']=='Y'){
                    $hd=$hd+$result_fnctvenue['tmi_ing_total'];
                  
                }  
                
                 if($result_fnctvenue['tmi_cs']=='Y'){
                   $cs=$cs+$result_fnctvenue['tmi_ing_total'];
                   
                }  
                  
                  
                  }
                  
        }
            
    echo '*'.number_format($di,$_SESSION['be_decimal']).'*'.number_format($ta,$_SESSION['be_decimal']).'*'.number_format($hd,$_SESSION['be_decimal']).'*'.number_format($cs,$_SESSION['be_decimal']); 
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='update_ing_pop'){
    $yield=0;
    
    if($_REQUEST['yield']!=''){
        
        $yield=$_REQUEST['yield'];
        
    }else{
        
        $yield=0;
    }
        
     $date_in=date('Y-m-d H:i:s');
    
 $fnct_menu5 = $database->mysqlQuery("update tbl_menu_ingredient_detail set tmi_store='".$_REQUEST['store']."' ,tmi_yield='".$yield."',tmi_ing_dayclosedate='$date_in'  where tmi_menuid='".$_REQUEST['menu']."'  ");
      
 
 
  $date=date('Y-m-d H:i:s');
  $ing_rate_changed='';
  $fnct_menu = $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$_REQUEST['menu']."'  ");
  $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  
                  
                 $fnct_menu5 = $database->mysqlQuery("select * from tbl_food_cost where tfc_menu='".$_REQUEST['menu']."' and  tfc_ing_menu='".$result_fnctvenue['tmi_ing_menuid']."' group by tfc_menu,tfc_ing_menu,tfc_date order by tfc_id desc limit 1 ");
       $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
          if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if(($result_fnctvenue5['tfc_rate']!=$result_fnctvenue['tmi_ing_rate']) || ($result_fnctvenue5['tfc_qty']!=$result_fnctvenue['tmi_ing_qty']) || ($result_fnctvenue5['tfc_weight']!=$result_fnctvenue['tmi_weight']) ){
                   //update////
                      
                      $ing_rate_changed='Y';
                  }
                  
                  if($ing_rate_changed=='Y'){
                      $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_fnctvenue['tmi_menuid']."','".$result_fnctvenue['tmi_portion']."',
                     '".$result_fnctvenue['tmi_ing_menuid']."', '".$result_fnctvenue['tmi_ing_qty']."', '".$result_fnctvenue['tmi_weight']."',
                    '".$result_fnctvenue['tmi_ing_rate']."','".$result_fnctvenue['tmi_ing_total']."','$date','".$_SESSION['expodine_id']."',"
                    . "'".$result_fnctvenue['tmi_di']."','".$result_fnctvenue['tmi_ta']."','".$result_fnctvenue['tmi_hd']."','".$result_fnctvenue['tmi_cs']."','".$result_fnctvenue['tmi_store']."','".$result_fnctvenue['tmi_yield']."' ) "); 
                  }
              
          }}else{
                 //first////
              
               $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_fnctvenue['tmi_menuid']."','".$result_fnctvenue['tmi_portion']."',
                         '".$result_fnctvenue['tmi_ing_menuid']."', '".$result_fnctvenue['tmi_ing_qty']."', '".$result_fnctvenue['tmi_weight']."',
                    '".$result_fnctvenue['tmi_ing_rate']."','".$result_fnctvenue['tmi_ing_total']."','$date','".$_SESSION['expodine_id']."' ,"
            . "'".$result_fnctvenue['tmi_di']."','".$result_fnctvenue['tmi_ta']."','".$result_fnctvenue['tmi_hd']."','".$result_fnctvenue['tmi_cs']."','".$result_fnctvenue['tmi_store']."','".$result_fnctvenue['tmi_yield']."' ) "); 
               
              
               
          }
                  
                  
          } }
              
              
 
 
}
?>