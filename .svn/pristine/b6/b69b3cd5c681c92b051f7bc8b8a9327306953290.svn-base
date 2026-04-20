<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();


 $localIP = getHostByName(getHostName()); 

if(isset($_REQUEST['set']) && $_REQUEST['set']=='search_inventory_production')
  {
	$data = array();
	$name=($_REQUEST['term']);
        $weight=0; $qty=0;
        $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster left join tbl_menu_ingredient_detail on tbl_menu_ingredient_detail.tmi_menuid=tbl_menumaster.mr_menuid left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'  and mr_menuname LIKE '%".$name."%' group by mr_menuid  "); 
	
    
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                                if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                                  if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }
                                 
                                 
        $fnct_menu = $database->mysqlQuery("select ts_weight,ts_qty from tbl_store_stock where ts_product='".$result_login['mr_menuid']."' and (ts_qty>0 or ts_weight>0) ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $weight=$result_fnctvenue['ts_weight'];
                      $qty=$result_fnctvenue['ts_qty'];
                      
                  }
        }
        
                                 
                                 
				$data[] = array(
					  'label' => $result_login['mr_menuname'],
					  'menuid' => $result_login['mr_menuid'],
                                    
                                   
					  'rate_type' => $bu_name,
					   'base_unit' => $bu_name1,
                                              'barcode' => $barcode,
                                          'weight' => $weight,
                                        'qty' => $qty,
                                        'store' =>  $result_login['mr_inventory_kitchen']
                                          
			     );
			}
	  }
	  
	 
		echo json_encode($data);
	flush();
 
    
  }
  

  
if(isset($_REQUEST['set']) && $_REQUEST['set']=='search_product_inventory')
  {
	$data = array();
	$name=($_REQUEST['term']);
   
        $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'  and mr_menuname LIKE '%".$name."%'  "); 
	
    
    $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                                if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                                  if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }
                                 
        $weight=0; $qty=0;                         
        $fnct_menu = $database->mysqlQuery("select ts_weight,ts_qty from tbl_store_stock where ts_product='".$result_login['mr_menuid']."' and (ts_qty>0 or ts_weight>0) ");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $weight=$result_fnctvenue['ts_weight'];
                      $qty=$result_fnctvenue['ts_qty'];
                      
                  }
        }
        
                                 
                                 
				$data[] = array(
					  'label' => $result_login['mr_menuname'],
					  'menuid' => $result_login['mr_menuid'],
                                    
                                   
					  'rate_type' => $bu_name,
					   'base_unit' => $bu_name1,
                                              'barcode' => $barcode,
                                           'weight' => $weight,
                                         'qty' => $qty,
                                         'central_id' => $result_login['mr_central_id']
                                          
			     );
			}
	  }
	  
	 
		echo json_encode($data);
	flush();
 
    
  }
if(isset($_REQUEST['set'])&&($_REQUEST['set']=="search_barcode_inventory")){
    
   $bar=($_REQUEST['term']);
   $weight=0; $qty=0;
   $data= array();
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster left join tbl_base_unit_master on "
            . " tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'   and mr_raw_barcode like '%".$bar."%'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $menuid= $result_login['mr_menuid'];
                                $name= $result_login['mr_menuname'];
                                 $mr_rate_type= $result_login['mr_rate_type'];
                                 
                               if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                               if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }  
                                 
                                 
         $fnct_menu = $database->mysqlQuery("select ts_weight,ts_qty from tbl_store_stock where ts_product='".$result_login['mr_menuid']."' and (ts_qty>0 or ts_weight>0) ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $weight=$result_fnctvenue['ts_weight'];
                      $qty=$result_fnctvenue['ts_qty'];
                      
                  }
        }
                                 
                                
				$data[] = array(
					  'label' => $result_login['mr_menuname'],
					  'menuid' => $result_login['mr_menuid'],
                                    
                                   
					  'rate_type' => $bu_name,
					   'base_unit' => $bu_name1,
                                              'barcode' => $barcode,
                                         'weight' => $weight,
                                         'qty' => $qty,
                                         'central_id' => $result_login['mr_central_id']
                                          
			     );
			
	  
	   }
                  }
	 
		echo json_encode($data);
	flush();
        
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='search_product_inventory_store')
  {
	 
  
 	$data = array();
	$name=($_REQUEST['term']);
        $store=$_REQUEST['from_store'];
	
    $sql_login  =  $database->mysqlQuery("select *  from tbl_menumaster left join tbl_store_stock on tbl_store_stock.ts_product=tbl_menumaster.mr_menuid left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'  and mr_menuname LIKE '%".$name."%'  and tbl_store_stock.ts_product!='' and ts_store='$store' "); 
	
    //echo "select *  from tbl_menumaster left join tbl_store_stock on tbl_store_stock.ts_product=tbl_menumaster.mr_menuid left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
    //        . " where  mr_active ='Y' and mr_product_type!='Menu'  and mr_menuname LIKE '%".$name."%'  and tbl_store_stock.ts_product!='' and ts_store='$store' "; 
	
    $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                                if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                                  if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }
                                 
                                 
                                 if($result_login['mr_reorder_level']!=''){
                                  $reorder= $result_login['mr_reorder_level'];
                                 }else{
                                   $reorder='';
                                 }
                                 
                                 
                                  $stock='';
                                  if($result_login['ts_rate_type']!='Single'){
                                 
                                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single'){
                                     
                                  $stock= $result_login['ts_qty'];
                                  
                                 }else{
                                     
                                     
                                     if( $result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')){ 
                                       $stock= $result_login['ts_qty'];
                                     }else{
                                        $stock= $result_login['ts_weight']; 
                                     }
                                     
                                 } 
                                 
                                 }else{
                                     
                                      $stock= $result_login['ts_qty'];
                                      
                                 }
                                  
                                 
				$data[] = array(
					  'label' => $result_login['mr_menuname'],
					  'menuid' => $result_login['mr_menuid'],
                                    
                                   
					  'rate_type' => $bu_name,
					   'base_unit' => $bu_name1,
                                              'barcode' => $barcode,
                                      'reorder' => $reorder,
                                      'stock' => $stock,
                                    'rate' =>  $result_login['ts_unit_price'],
                                    'qty' =>  $result_login['ts_qty'],
                                    'weight' =>  $result_login['ts_weight'],
                                    'central_id' =>  $result_login['mr_central_id']
                                        
                                          
			     );
			}
	  }
	  
	 
		echo json_encode($data);
	flush();
 
    
  }
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=="search_batch_inventory_store")){
    
    $bar=($_REQUEST['term']);
    $store=$_REQUEST['from_store'];
    $data= array();
    
          $sql_login  =  $database->mysqlQuery("select tg_grn_id,tg_unit_rate from tbl_grn_order "
          . " where  tg_grn_id!=''   and tg_grn_id like '%".$bar."%' and tg_store='$store' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $tg_grn_id= $result_login['tg_grn_id'];
                                $rate= $result_login['tg_unit_rate'];
                                
                                 
                               
                                 
				$data[] = array(
					  'label' => $tg_grn_id,
					  'rate' => $rate
                                     
                                          
			     );
			
	  
	   }
                  }
	 
		echo json_encode($data);
	flush();
      
}
if(isset($_REQUEST['set'])&&($_REQUEST['set']=="search_barcode_inventory_store")){
    
    $bar=($_REQUEST['term']);
  $store=$_REQUEST['from_store'];
  
  $data= array();
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster left join tbl_store_stock on tbl_store_stock.ts_product=tbl_menumaster.mr_menuid left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'   and mr_raw_barcode like '%".$bar."%' and tbl_store_stock.ts_product!='' and ts_store='$store' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $menuid= $result_login['mr_menuid'];
                                $name= $result_login['mr_menuname'];
                                 $mr_rate_type= $result_login['mr_rate_type'];
                                 
                               if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                               if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }  
                                 
                                 if($result_login['mr_reorder_level']!=''){
                                  $reorder= $result_login['mr_reorder_level'];
                                 }else{
                                   $reorder='';
                                 }
                                 
                                 
                                  $stock='';
                                  if( $result_login['ts_rate_type']!='Single'){
                                 
                                 if($result_login['ts_unit']=='Nos'){
                                     
                                  $stock= $result_login['ts_qty'];
                                  
                                 }else{
                                     
                                    if( $result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')){ 
                                     $stock= $result_login['ts_qty'];
                                     }else{
                                        $stock= $result_login['ts_weight']; 
                                     }
                                 } 
                                 
                                 }else{
                                     
                                      $stock= $result_login['ts_qty'];
                                      
                                 }
                                 
                                 
				$data[] = array(
					  'label' => $result_login['mr_menuname'],
					  'menuid' => $result_login['mr_menuid'],
                                    
                                   
					  'rate_type' => $bu_name,
					   'base_unit' => $bu_name1,
                                              'barcode' => $barcode,
                                        'reorder' => $reorder,
                                      'stock' => $stock,
                                     'rate' =>  $result_login['ts_unit_price'],
                                      'qty' =>  $result_login['ts_qty'],
                                    'weight' =>  $result_login['ts_weight']  
                                          
			     );
			
	  
	   }
                  }
	 
		echo json_encode($data);
	flush();
      
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_production'){
   
         $row2=array();
         
         $inv_req='';
         
         
         if($_REQUEST['edit_id']!='' ){
             
             $req_id=$_REQUEST['edit_id'];
             
            }else{
         $sql_login  =  $database->mysqlQuery("select ti_production_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_production_id'];
                  }
                  }
                  
                  
                $req_id='Prd_'.$inv_req;  
         
            }
         
      
          
        	
        $insertion['tp_production_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tp_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tp_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tp_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
          
           $insertion['tp_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
            $insertion['tp_unit_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
          
          $insertion['tp_store']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
          
        if($_REQUEST['qty']!=''){
        $insertion['tp_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        }
       
        
         if($_REQUEST['weight']!=''){
        $insertion['tp_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
         if($_REQUEST['portion_menu']!='' && $_REQUEST['portion_menu']!='undefined'){
        $insertion['tp_portion']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['portion_menu']));
        
        }
        
         $insertion['tp_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
	
    $sql=$database->check_duplicate_entry('tbl_production',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_production',$insertion);   
        
       
        $fnct_menu = $database->mysqlQuery("select * from tbl_production where tp_set='N' group by tp_production_id,tp_product,tp_portion order by tp_id desc");
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
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_production_load'){
    
     $row2=array();
    $fnct_menu = $database->mysqlQuery("select * from tbl_production where tp_set='N' group by tp_production_id,tp_product,tp_portion order by tp_id desc");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_production'){
    
      $fnct_menu = $database->mysqlQuery("delete from  tbl_production where tp_id='".$_REQUEST['id']."' ");
}

 if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_req'){
   
         $row2=array();
         
         $inv_req='';
         
         
         if($_REQUEST['edit_id']!='' ){
             
             $req_id=$_REQUEST['edit_id'];
             
            }else{
         $sql_login  =  $database->mysqlQuery("select ti_requistion_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_requistion_id'];
                  }
                  }
                  
                  
                $req_id='Req_'.$inv_req;  
                
                
                  $req_id=  rand(100, 999999); 
         
            }
         
      
          
        	
         $insertion['tr_req_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tr_dayclosedate']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tr_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tr_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tr_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
        $insertion['tr_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
        $insertion['tr_unittype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        $insertion['tr_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        
        if($_REQUEST['brand']!=''){
        $insertion['tr_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
         if($_REQUEST['weight']!=''){
        $insertion['tr_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
         $insertion['tr_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
         
         $insertion['tr_ip']= mysqli_real_escape_string($database->DatabaseLink,trim($localIP));
         
           if($_REQUEST['central_id']!='' && $_REQUEST['central_id']!='undefined'){
        $insertion['tr_central_menu_id']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['central_id']));
        
        }
         
         
	
    $sql=$database->check_duplicate_entry('tbl_requisition',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_requisition',$insertion);   
        
       
        $fnct_menu = $database->mysqlQuery("select * from tbl_requisition where tr_set='N' and tr_ip='$localIP' group by tr_req_id,tr_product order by tr_id desc");
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

if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_req'){
    
      $fnct_menu = $database->mysqlQuery("delete from  tbl_requisition where tr_id='".$_REQUEST['id']."' ");
      
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_req_load'){
    
     $row2=array();
    $fnct_menu = $database->mysqlQuery("select * from tbl_requisition where tr_set='N' and  tr_ip='$localIP'  group by tr_req_id,tr_product  order by tr_id desc");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_req_all'){
    
    
    if($_REQUEST['type_central']=='Y'){
        $br=" tr_branchid='".$_SESSION['firebase_id']."' , ";
    }else{
        $br=" tr_branchid = NULL , ";
    }
    
    if($_REQUEST['type_central']=='Z'){
         $br1=" tr_central='N' , ";
        
         $br2=" tr_indent='Y' , ";
         
    }else{
          $br1=" tr_central='".$_REQUEST['type_central']."' , ";
        
          $br2=" tr_indent='N' , ";
    }
    
    
    if($_REQUEST['edit_id']=='' || $_REQUEST['edit_id']=='undefined' || $_REQUEST['edit_id']==' '){
        
    $sql_login  =  $database->mysqlQuery("select ti_requistion_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_requistion_id'];
                  }
                  }
                  
                  
                $req_id='R'.$inv_req;  
                
     
    }else{
        
          $req_id=$_REQUEST['edit_id'];
   
    }
    
     
    
     $fnct_menu99 = $database->mysqlQuery("select tr_ip from tbl_requisition where tr_req_id='$req_id' and tr_ip='$localIP' ");
        $num_fdtl99 = $database->mysqlNumRows($fnct_menu99);
        if ($num_fdtl99 > 0) { 
            
          $fnct_menu = $database->mysqlQuery("update  tbl_requisition set $br $br1 $br2 tr_set='Y',"
         . " tr_store='".$_REQUEST['store']."' where  tr_req_id='$req_id' and tr_ip='$localIP' ");
          
        }else{
          $fnct_menu = $database->mysqlQuery("update  tbl_requisition set $br $br1 $br2 tr_set='Y',"
         . " tr_store='".$_REQUEST['store']."',tr_req_id='$req_id' where  tr_set='N' and tr_ip='$localIP' ");
    
        }
        
        
        
     $fnct_menu881 = $database->mysqlQuery("delete from  tbl_requisition where tr_set='N' and tr_ip='$localIP' ");
    
    
      
      if($_REQUEST['edit_id']=='' || $_REQUEST['edit_id']=='undefined' || $_REQUEST['edit_id']==' '){
      $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_requistion_id=(ti_requistion_id+1) ");
      }
      
       
      
      
      
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_purchase'){
   
         $row2=array();
         
         $inv_req='';
         
         
         if($_REQUEST['edit_id']!='' ){
             
             $req_id=$_REQUEST['edit_id'];
             
            }else{
         $sql_login  =  $database->mysqlQuery("select ti_purchase_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_purchase_id'];
                  }
                  }
         
         $req_id='Pr_'.$inv_req;
         
          $req_id=  rand(100, 999999); 
         
            }
       
        $insertion['tp_purchase_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tp_dayclosedate']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tp_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tp_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tp_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
        $insertion['tp_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
        $insertion['tp_unittype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        $insertion['tp_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        
        if($_REQUEST['brand']!=''){
        $insertion['tp_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
        if($_REQUEST['weight']!=''){
        $insertion['tp_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
        
        $insertion['tp_ip']= mysqli_real_escape_string($database->DatabaseLink,trim($localIP));
        
        $insertion['tp_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
        
    $sql=$database->check_duplicate_entry('tbl_purchase_order',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_purchase_order',$insertion);   
       
       
        $fnct_menu = $database->mysqlQuery("select * from tbl_purchase_order where tp_set='N' and tp_ip='$localIP'  group by tp_purchase_id,tp_product order by tp_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
   }

}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_purchase'){
    
    
      $fnct_menu = $database->mysqlQuery("delete from  tbl_purchase_order where tp_id='".$_REQUEST['id']."' ");
      
      $fnct_menu = $database->mysqlQuery("select * from tbl_purchase_order where tp_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
             echo 'yes';
        }else{
             echo 'no';
       }
        
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_purchase_load'){
    
     $row2=array();
    $fnct_menu = $database->mysqlQuery("select * from tbl_purchase_order where tp_set='N' and tp_ip='$localIP' group by tp_purchase_id,tp_product order by tp_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_purchase_all'){
    
    
     if($_REQUEST['edit_id']=='' || $_REQUEST['edit_id']=='undefined' ||  $_REQUEST['edit_id']==' ' ||  $_REQUEST['edit_id']=='null'){
         
    $sql_login  =  $database->mysqlQuery("select ti_purchase_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_purchase_id'];
                  }
                  }
         
         $req_id='P'.$inv_req;
    
     }else{
         $req_id=$_REQUEST['edit_id'];
         
     }
    
        $fnct_menu99 = $database->mysqlQuery("select tp_ip from tbl_purchase_order where tp_purchase_id='$req_id' and tp_ip='$localIP' ");
        $num_fdtl99 = $database->mysqlNumRows($fnct_menu99);
        if ($num_fdtl99 > 0) { 
            
            $fnct_menu = $database->mysqlQuery("update tbl_purchase_order set tp_supplier='".$_REQUEST['supplier']."',"
            . "tp_store='".$_REQUEST['store']."',tp_set='Y' "
            . "  where  tp_purchase_id='$req_id' and tp_ip='$localIP' ");
          
        }else{
            
           $fnct_menu = $database->mysqlQuery("update tbl_purchase_order set tp_supplier='".$_REQUEST['supplier']."',"
                   . "tp_store='".$_REQUEST['store']."',tp_set='Y' ,tp_purchase_id='$req_id' "
                  . " where  tp_set='N' and tp_ip='$localIP' ");
    
        }
        
        
     $fnct_menu881 = $database->mysqlQuery("delete from  tbl_purchase_order where tp_set='N' and tp_ip='$localIP' ");
         
         
       if($_REQUEST['edit_id']=='' || $_REQUEST['edit_id']=='undefined' ){
          $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_purchase_id=(ti_purchase_id+1) ");
       }
      
}

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_history'){
    
    $string='';
    
   
    if($_REQUEST['id']!=''){
    $string.=" and tr_req_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
     if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
           $string.=" and tr_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string.=" and tr_status is null   "; 
         }
    
    }
    
    
    $string1='';
    
    if($_REQUEST['id']!=''){
    $string1.=" and tp_purchase_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string1.=" and tp_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string1.=" and tp_status is null   "; 
         }
    
    
    }
    
    
    
    $string2='';
    
    if($_REQUEST['id']!=''){
        
       $string2.=" and tg_grn_id like '%".$_REQUEST['id']."%'   ";
       
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
    $string2.=" and tg_status is null   "; 
         }
    
    
    }
   
    if($_REQUEST['supplier']!=''){
          $string.=" =*"; 
         
    $string1.=" and tp_supplier = '".$_REQUEST['supplier']."'   ";
    
    
     $string2.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
    }
    
    
    
     if($_REQUEST['inv']!=''){
        
    
     $string2.=" and tgs_invoice_no like '%".$_REQUEST['inv']."%'   ";
     
    }
    
    
    if($_REQUEST['staff']!=''){
        
      $string.=" and tr_login = '".$_REQUEST['staff']."'   ";
        $string1.=" and tp_login = '".$_REQUEST['staff']."'   ";  
        
     $string2.=" and tg_login = '".$_REQUEST['staff']."'   ";
     
    }
    
     if($_REQUEST['search_store']!=''){
        
      $string.=" and tr_store = '".$_REQUEST['search_store']."'   ";
        $string1.=" and tp_store = '".$_REQUEST['search_store']."'   ";  
        
     $string2.=" and tg_store = '".$_REQUEST['search_store']."'   ";
     
    }
    
    
    
    
    
    
        if($_REQUEST['inv_date']!="" && $_REQUEST['inv_date1']!="")
		{
                         $string2.= " and  tg_dayclosedate between '".$_REQUEST['inv_date']."' and '".$_REQUEST['inv_date1']."' ";
                        $string.= " and  tr_dayclosedate between '".$_REQUEST['inv_date']."' and '".$_REQUEST['inv_date1']."' ";
                        $string1.= " and  tp_dayclosedate between '".$_REQUEST['inv_date']."' and '".$_REQUEST['inv_date1']."' ";
		}
		else if($_REQUEST['inv_date']!="" && $_REQUEST['inv_date1']=="")
		{
			  $to=date("Y-m-d");
			
                          $string2.= " and  tg_dayclosedate between '".$_REQUEST['inv_date']."' and '".$to."' ";
                        $string.= " and  tr_dayclosedate between '".$_REQUEST['inv_date']."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$_REQUEST['inv_date']."' and '".$to."' ";
		}
		else if($_REQUEST['inv_date']=="" && $_REQUEST['inv_date1']!="")
		{
			$from=date("Y-m-d");
			
                         $string2.= " and  tg_dayclosedate between '".$from."' and '".$_REQUEST['inv_date1']."' ";
                         $string.= " and tr_dayclosedate between '".$from."' and '".$_REQUEST['inv_date1']."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$_REQUEST['inv_date1']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tr_dayclosedate between '".$from."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$to."' ";
                        $string2.= " and  tg_dayclosedate between '".$from."' and '".$to."' ";
                }
    
    
    
   
               if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tg_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                         $from=date("Y-m-d");
			 $to=date("Y-m-d");
			
                       //  $string2.= " and  tg_date between '".$from."' and '".$to."' ";
                }
                
                
           ?>

<table class="table table-bordered table-striped" >
  <thead>
     <tr>
      <th scope="col">Sl</th>
      <th scope="col">Action</th>
      <th scope="col">Type</th>
      <th scope="col">ID</th>
      <th scope="col">User</th>
      <th scope="col">Store</th>
      <th scope="col">Entry Date</th>
       
      <th scope="col">Supplier</th>
       <th scope="col">Invoice Date</th>
      <th style="display: none " scope="col">Tax </th>
      <th  style="display: none "scope="col">Total </th>
      <th scope="col">Invoice No</th>
      <th scope="col">Invoice Amount</th>
      <th style="display: none " scope="col">Return</th>
      <th scope="col">Items</th>
     
   
      <th title="Approved / Cancelled" scope="col">Approved By</th>
       <th scope="col">Remarks</th>
      <th scope="col">Ip</th>
       <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      

<?php
        
        $pagination=0;
        $recordcount="";
        if(isset($_REQUEST['pagination']))
        {
        $pagination= $_REQUEST['pagination'];
        $recordcount=$_REQUEST['recordcount'];

        }


    if($recordcount!=""){
          $i=$recordcount;
          
       }else{
           
          $i=0;
       }
    
    
   if($_REQUEST['type']=='all' || $_REQUEST['type']=='req'){
         
    
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_requisition.tr_store where tr_set='Y' $string group by tr_req_id  order by length(tr_req_id),tr_req_id  desc limit ". $pagination.",100 "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
                                                      
                                                      
                 $sql_kotlist1  =  $database->mysqlQuery("SELECT count(tr_product) as count from tbl_requisition where  tr_req_id = '".$result_kotlist['tr_req_id']."' "); 
 
                $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
					while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
					{                                                       
                                                     $count=   $result_kotlist1['count'];          
                                        } }                             
                                                      
                                                      
                                                      
        $i++;
                                                      
        $indent_status='N';                                     
        $sql_kotlist1p  =  $database->mysqlQuery("SELECT  tip_req_id from tbl_indent_partial where  tip_req_id = '".$result_kotlist['tr_req_id']."' "); 
 
        $num_kotlist1p  = $database->mysqlNumRows($sql_kotlist1p);
		if($num_kotlist1p){
                                            
                  $indent_status='Y';
                 
                 }else{
                                            
                  $indent_status='N';
                }
						                                      
                                                        
                                                     
              ?>
    
       <tr>
             <td><?=$i?></td>
    
             <td ><span class="td-flex">
              
             <a href="a4_print.php?type=print_req_order&id=<?=$result_kotlist['tr_req_id']?>&store=<?=$result_kotlist['ti_name']?>&date=<?=$result_kotlist['tr_dayclosedate']?>" title="A4 PRINT"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:black;cursor: pointer"></i></a>      
              
              
             <a onclick="view_req('<?=$result_kotlist['tr_req_id']?>','req','<?=$result_kotlist['ti_name']?>','');" title="View"><i class="fa fa-eye fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a>
              
              <?php  if( $_SESSION['ser_req']=='Y'){ ?>   
               
              <?php if($result_kotlist['tr_status'] =='' && $indent_status!='Y' ){ ?>
             
              <a onclick="edit_req('<?=$result_kotlist['tr_req_id']?>','req');" href="#"  title="Edit" ><i class="fa fa-edit fa-lg" aria-hidden="true" style="color:#548CFF;cursor: pointer"></i></a>
            
               <?php } ?>
              
              <?php  if( ($result_kotlist['tr_status']=='' && $result_kotlist['tr_status']!='Approved' && $result_kotlist['tr_status']!='Cancel') && $result_kotlist['tr_indent']!='Y' && $_SESSION['ser_approve_cancel_inv']=='Y'){ ?>
             
              <a onclick="approve_req('<?=$result_kotlist['tr_req_id']?>','Cancel','req');" title="Cancel" ><i class="fa fa-times fa-lg" aria-hidden="true" style="color:red;cursor: pointer"></i></a>
              
               <?php } ?>
              
             <?php  if( ($result_kotlist['tr_status']!='Cancel' && $result_kotlist['tr_status']!='Approved') && $result_kotlist['tr_indent']!='Y' && $_SESSION['ser_approve_cancel_inv']=='Y' ){ ?>
              
              <a onclick="approve_req('<?=$result_kotlist['tr_req_id']?>','Approved','req');" title="Approval"><i class="fa fa-check fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a>
               
               <?php } ?>
              
            <?php  if($result_kotlist['tr_indent']=='Y' && $result_kotlist['tr_indent_done']=='N' &&  $_SESSION['ser_indent']=='Y'){ ?>
              
              <a onclick="approve_indent('<?=$result_kotlist['tr_req_id']?>','<?=$result_kotlist['tr_store']?>');" title="Indent Transfer"><i class="fa fa-share-square-o " aria-hidden="true" style="color:#4c1c60;cursor: pointer;font-size: 18px"></i></a>
               
            <?php }  ?>
              
              
               <?php  if( $indent_status=='Y' &&  $_SESSION['ser_indent_accept']=='Y'){ 
              
              
                   
                $sql_kotlist1u  =  $database->mysqlQuery("SELECT tt_trn_id,tt_indent_accepted from tbl_store_transfer where  tt_indent = '".$result_kotlist['tr_req_id']."' and tt_indent_accepted!='Y' group by tt_trn_id "); 
 
                $num_kotlist1u  = $database->mysqlNumRows($sql_kotlist1u);
					if($num_kotlist1u){
						  while($result_kotlist1u  = $database->mysqlFetchArray($sql_kotlist1u)) 
							  {  
                                                      
                                                     
                                                      if($result_kotlist1u['tt_indent_accepted']!='Y'){
              ?>
              
              
              <a title="Accept Indent : "<?=$result_kotlist1u['tt_trn_id']?> onclick="accept_indent('<?=$result_kotlist1u['tt_trn_id']?>');" ><i class="fa fa-check-circle " aria-hidden="true" style="color:green;cursor: pointer;font-size: 18px"></i></a>
               
                                                      <?php } } } } } ?>
              
            
              
              
      </span></td>
      <td scope="row" style="text-align: center;">REQ</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tr_req_id']?></td>
         <td><?=$result_kotlist['tr_login']?></td> 
       <td title="><?=$result_kotlist['ti_name']?>"><?=$result_kotlist['ti_name']?></td>
      <td><?=$result_kotlist['tr_dayclosedate']?></td>
       <td></td>
      <td></td>
     
      <td style="display: none "></td>
      <td style="display: none "></td>
      <td></td>
      <td></td>
      <td style="display: none "></td>
      
      <td><?=$count?></td>
      
   
       
   
       
      <td title="<?=$result_kotlist['tr_status_login']?>"><?=$result_kotlist['tr_status_login']?></td>
      
       <?php if($result_kotlist['tr_central']=='Y'){ ?>
      <td style="color:#ef9595">Cloud Intent</td>
       <?php }else{ ?>
      
       <td></td>
       
     <?php } ?>
      
      
      <td style="font-size:8px !important;font-weight: bold"><?=$result_kotlist['tr_ip']?></td>
      
      
       <?php if($result_kotlist['tr_status']=='Approved'){ ?>
      
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
    <?php }else if($result_kotlist['tr_status']=='Cancel'){ ?>
      
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
    <?php }else{ ?>
      
       <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
       
     <?php } ?>
      
      
      <?php  if($result_kotlist['tr_status']=='Approved' && $_SESSION['ser_po']=='Y'  ){ ?>
       
      <td><button class="generate-btn" ><a onclick="po_entry('<?=$result_kotlist['tr_req_id']?>')" style="color:white" href="#" >PO</a></button></td>
        <?php }else{ ?>
      
          <td <?php  if($_SESSION['ser_po']=='N' ){ ?> title="NO PERMISSION" <?php } ?>><button  href="#" class="generate-btn">X</button></td> 
          
        <?php }  ?>
      
    </tr>

   <?php
      
      }  }
          
          
      
      }
       
       
     
    if($_REQUEST['type']=='all' || $_REQUEST['type']=='purchase'){
         
      
     
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_purchase_order.tp_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store where tp_set='Y' $string1 group by tp_purchase_id  order by length(tp_purchase_id),tp_purchase_id  desc limit ". $pagination.",100 "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
                                                                  
                                                                  
                                                                  
    $sql_kotlist1  =  $database->mysqlQuery("SELECT count(tp_product) as count from tbl_purchase_order where  tp_purchase_id = '".$result_kotlist['tp_purchase_id']."' "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
					while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
					{                                                       
                                              $count=   $result_kotlist1['count'];          
                                        } }                            
                                                                  
                 $i++                                                  
                                                      
      ?>
    
    <tr>
         <td scope="row" style="text-align: center;"><?=$i?></td>
         <td ><span class="td-flex">
           
              
           <a href="a4_print.php?type=print_purchase_order&id=<?=$result_kotlist['tp_purchase_id']?>&supplier=<?=$result_kotlist['v_name']?>&store=<?=$result_kotlist['ti_name']?>&date=<?=$result_kotlist['tp_dayclosedate']?>" title="A4 PRINT"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:black;cursor: pointer"></i></a>     &nbsp;   
              
           
           <?php if($result_kotlist['tp_status'] !='Cancel' ){ ?>
           <a href="#" onclick="mail_grn('<?=$result_kotlist['tp_purchase_id']?>','<?=$result_kotlist['v_name']?>','<?=$result_kotlist['ti_name']?>','<?=$result_kotlist['v_email']?>');" title="SEND PURCHASE ORDER MAIL TO SUPPLIER"> <i class="fa fa-envelope fa-lg" aria-hidden="true" style="color:black;cursor: pointer"></i></a>      &nbsp; 
           <?php } ?>
              
           <a onclick="view_req('<?=$result_kotlist['tp_purchase_id']?>','pur','<?=$result_kotlist['ti_name']?>','<?=$result_kotlist['v_name']?>');" title="View"><i class="fa fa-eye fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a>    &nbsp; 
              
        

           <?php  if( $_SESSION['ser_po']=='Y'){ ?>
           
          <?php if($result_kotlist['tp_status'] =='' ){ ?>
           
              <a onclick="edit_req('<?=$result_kotlist['tp_purchase_id']?>','pur');" href="#" ><i class="fa fa-edit fa-lg" aria-hidden="true" style="color:#548CFF;cursor: pointer"></i></a> &nbsp;  
              
           <?php } if(($result_kotlist['tp_status']==''  && $result_kotlist['tp_status']!='Cancel' && $result_kotlist['tp_status']!='Approved') && $_SESSION['ser_approve_cancel_inv']=='Y'){ ?>
             
              <a onclick="approve_req('<?=$result_kotlist['tp_purchase_id']?>','Cancel','pur');" title="Cancel" ><i class="fa fa-times fa-lg" aria-hidden="true" style="color:red;cursor: pointer"></i></a>   &nbsp; 
              
              
          <?php } if(($result_kotlist['tp_status']!='Cancel' && $result_kotlist['tp_status']!='Approved') && $_SESSION['ser_approve_cancel_inv']=='Y' ){ ?>
              
              <a onclick="approve_req('<?=$result_kotlist['tp_purchase_id']?>','Approved','pur');" title="Approval"><i class="fa fa-check fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a> &nbsp; 
               
          <?php } } ?>
             
     </span></td>
     
      <td scope="row" style="text-align: center;">PO</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tp_purchase_id']?></td>
        <td><?=$result_kotlist['tp_login']?></td> 
         <td title="<?=$result_kotlist['ti_name']?>"><?=$result_kotlist['ti_name']?></td>
      <td><?=$result_kotlist['tp_dayclosedate']?></td>
      
      <td title="<?=$result_kotlist['v_name']?>"><?=$result_kotlist['v_name']?></td>
      <td></td>
       <td style="display: none "></td>
      <td style="display: none "></td>
      <td></td>
      <td></td>
      <td style="display: none "> </td>
      <td><?=$count?></td>
      
    
      
       
      <td title="<?=$result_kotlist['tp_status_login']?>"><?=$result_kotlist['tp_status_login']?></td>
    
      <td></td>
       <td style="font-size:8px !important;font-weight: bold"><?=$result_kotlist['tp_ip']?></td>
       
        <?php if($result_kotlist['tp_status']=='Approved'){ ?>
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
     <?php }else if($result_kotlist['tp_status']=='Cancel'){ ?>
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
     <?php }else{ ?>
      <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
     <?php } ?>
       
      
      <?php  if($result_kotlist['tp_status']=='Approved' && $_SESSION['ser_stock_entry']=='Y' ){ ?>
      
      <td><button class="generate-btn" ><a style="color:white" onclick="grn_entry('<?=$result_kotlist['tp_purchase_id']?>')"  >S P</a></button></td>
      
        <?php }else{ ?>
      
      <td <?php  if($_SESSION['ser_stock_entry']=='N' ){ ?> title="NO PERMISSION" <?php } ?>  ><button  href="#" class="generate-btn">X</button></td> 
      
      <?php }  ?>
      
      
      
      </tr>

        <?php
        
      }  }
      
     }
       
       
       if($_REQUEST['type']=='all' || $_REQUEST['type']=='stock'){
         
           
          $whatsapp=''; 
           
   
       $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_grn_order left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2 group by tg_grn_id  order by length(tg_grn_id),tg_grn_id asc limit ". $pagination.",100 "); 
    
       $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){
		while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
		 {  
                                                                  
                                                                  
                                                                  
    $sql_kotlist1  =  $database->mysqlQuery("SELECT count(tg_product) as count from tbl_grn_order where  tg_grn_id = '".$result_kotlist['tg_grn_id']."' "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
					 while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
					 {    
                                                      
                                                     $count=   $result_kotlist1['count'];          
                                        } }        
                                        
                                        
          $ret=0;                                
          $sql_kotlist14  =  $database->mysqlQuery("SELECT sum(tpr_final) as tot from tbl_purchase_return where  tpr_grn = '".$result_kotlist['tg_grn_id']."' "); 
 
          $num_kotlist14  = $database->mysqlNumRows($sql_kotlist14);
					if($num_kotlist14){
						  while($result_kotlist14  = $database->mysqlFetchArray($sql_kotlist14)) 
							  {                                                       
                                                     $ret=   $result_kotlist14['tot'];          
                                        } }                                 
                       
                                        
  $allnum='';
  $sql_sms1 =  $database->mysqlQuery("Select be_sms_list,be_branchname from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
					{
                                  $allnum=$result_sms1['be_sms_list'];
                                  $branchname=$result_sms1['be_branchname'];
                                        }
                  }                               
                                                                   
                 $i++    
                                                       
      ?>
    <tr>
        
      <td scope="row" style="text-align: center;"><?=$i?></td>
      
          <td><span class="td-flex">
          
          <a href="a4_print.php?type=print_grn_order&id=<?=$result_kotlist['tg_grn_id']?>&supplier=<?=$result_kotlist['v_name']?>&store=<?=$result_kotlist['ti_name']?>&date=<?=$result_kotlist['tg_date']?>&inv=<?=$result_kotlist['tgs_invoice_no']?>&dayclose=<?=$result_kotlist['tg_dayclosedate']?>" title="A4 PRINT"><i class="fa fa-print fa-lg" aria-hidden="true" style="color:black;cursor: pointer"></i></a>   &nbsp; 
              
                
          <a style="display: none" target="_blank" href="https://api.whatsapp.com/send?phone=+91<?=$allnum?>&text=Branch : <?=$branchname?> | Grn Id :<?=$result_kotlist['tg_grn_id']?> | Supplier : <?=$result_kotlist['v_name']?> | Store : <?=$result_kotlist['ti_name']?> | Amount : <?=$result_kotlist['tg_grand_total']?>" title="WHATSAPP"><i class="fa fa-whatsapp fa-lg" aria-hidden="true" style="color:black;cursor: pointer"></i></a>     
               
            
          <a onclick="view_req('<?=$result_kotlist['tg_grn_id']?>','grn','<?=$result_kotlist['ti_name']?>','<?=$result_kotlist['v_name']?>');" title="View"><i class="fa fa-eye fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a>     &nbsp;
              
          
          <?php  if( $_SESSION['ser_stock_entry']=='Y'){ ?>
          
          <?php if($result_kotlist['tg_status'] =='' ){ ?>
          
              <a onclick="edit_req('<?=$result_kotlist['tg_grn_id']?>','grn');" href="#"  ><i class="fa fa-edit fa-lg" aria-hidden="true" style="color:#548CFF;cursor: pointer"></i></a> &nbsp; 
              
         <?php } if($result_kotlist['tg_status']!='Approved' && $result_kotlist['tg_status']!='Cancel' && $_SESSION['ser_approve_cancel_inv']=='Y'){ ?>
             
              <a onclick="approve_req('<?=$result_kotlist['tg_grn_id']?>','Cancel','grn');" title="Cancel" ><i class="fa fa-times fa-lg" aria-hidden="true" style="color:red;cursor: pointer"></i></a> &nbsp; 
              
              
         <?php } if($result_kotlist['tg_status']!='Cancel' && $result_kotlist['tg_status']!='Approved' && $_SESSION['ser_approve_cancel_inv']=='Y'){ ?>
              
              <a  onclick="approve_req('<?=$result_kotlist['tg_grn_id']?>','Approved','grn');" title="Approval"><i class="fa fa-check fa-lg" aria-hidden="true" style="color:green;cursor: pointer"></i></a> &nbsp; 
               
         <?php } } ?>
              
              
           <?php if($result_kotlist['tg_status'] =='Approved' && $_SESSION['ser_purchase_return']=='Y'){ ?>
              
            <a title="Purcahse Return" href="purchase_return.php?grn_id=<?=$result_kotlist['tg_grn_id']?>"  ><i class="fa fa-refresh fa-refresh" aria-hidden="true" style="color:#548CFF;cursor: pointer;font-size:15px"></i></a> &nbsp; 
              
           <?php } ?>
            
            
              
           <?php if( $_SESSION['ser_direct_transfer']=='Y' && $result_kotlist['tg_direct_transfer'] =='N' &&  $result_kotlist['tg_status'] =='Approved' && $result_kotlist['tg_status']!='Cancel'){ ?>
            
           <?php $sql_sms1 =  $database->mysqlQuery("Select tt_set from tbl_store_transfer where tt_set='N' "); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
            ?>
            <a style="display:block" title="Direct Store Transfer Not Possible" href="#" onclick="direct_no()"  ><i class="fa fa-random disablegenerate" aria-hidden="true" style="color:red;font-size: 18px"></i></a>
               
            <?php }else{ ?>
            
            <a style="display:block" title="Direct Store Transfer" href="store_transfer.php?direct_id=<?=$result_kotlist['tg_grn_id']?>&store_direct=<?=$result_kotlist['tg_store']?>" onclick="direct_transfer('<?=$result_kotlist['tg_grn_id']?>');" ><i class="fa fa-random" aria-hidden="true" style="color:darkred;cursor: pointer;font-size: 15px"></i></a>
              

            <?php } }else{ ?>
            
            <?php if($result_kotlist['tg_direct_accept']=='Y'){ ?>
            
            <a style="cursor: pointer;color: white;background-color: #a73333;border:solid 1px;border-radius: 4px;padding: 1px;font-size: 10px " title="Direct Transfer Done">DT</a>
            
            <?php } ?>
                 
            <?php } ?>
              
         <?php  if($result_kotlist['tg_direct_transfer']=='Y' && $result_kotlist['tg_direct_accept']=='N' && $_SESSION['ser_direct_transfer_accept']=='Y'){ ?> 
            
         <a onclick="accept_direct('<?=$result_kotlist['tg_grn_id']?>');" title="Direct Transfet Accept"><i class="fa fa-check-square-o  " aria-hidden="true" style="color:green;cursor: pointer;font-size: 15px;"></i></a>
       
         <?php } ?>
         
         
      </span> </td>
      
      <td scope="row" style="text-align: center;">STOCK PURCHASE</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tg_grn_id']?></td>
       <td title="<?=$result_kotlist['tg_login']?>"><?=$result_kotlist['tg_login']?></td>
         <td title="<?=$result_kotlist['ti_name']?>"><?=$result_kotlist['ti_name']?></td>
      <td><?=$result_kotlist['tg_dayclosedate']?></td>
     
     
      <td title="<?=$result_kotlist['v_name']?>"><?=$result_kotlist['v_name']?></td>
    <td style="font-size: 10px "> <?=$result_kotlist['tg_date']?></td>
       <td style="display: none "><?= number_format($result_kotlist['tg_tax_amount'],$_SESSION['be_decimal'])?></td>
      <td style="display: none "><?= number_format($result_kotlist['tg_final_total'],$_SESSION['be_decimal'])?></td>
      <td title="<?=$result_kotlist['tgs_invoice_no']?>"><?=$result_kotlist['tgs_invoice_no']?></td>
      <td><?=number_format($result_kotlist['tg_grand_total'],$_SESSION['be_decimal'])?></td>
      <td style="display: none "><?= number_format($ret,$_SESSION['be_decimal']) ?></td>
      <td><?=$count?></td>
      
      
      
     
       
      <td title="<?=$result_kotlist['tg_status_login']?>"><?=$result_kotlist['tg_status_login']?></td>
    
      <td style="cursor:pointer" title="<?=$result_kotlist['tgs_remarks']?>"> <?=  substr($result_kotlist['tgs_remarks'], 0,7)?></td>
      
      <td style="font-size:8px !important;font-weight: bold"><?=$result_kotlist['tg_ip']?></td>
      
      
      <?php if($result_kotlist['tg_status']=='Approved'){ ?>
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
      <?php }else if($result_kotlist['tg_status']=='Cancel'){ ?>
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
      <?php }else{ ?>
      <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
      <?php } ?>
       
      <td title="Completed"><i class="fa fa-check-square " aria-hidden="true" style="color:green;"></i></td>
    </tr>

      <?php
      
      }  }
      
      
       }
     ?>
     
     </tbody>
  
     </table>

   <div class="inv-pagination" style="bottom: 2rem !important  ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/100)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                       <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                       <?php $m=$m+100; } $m=$m-100;?>
                                       <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div> 
     
     <?php

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='approve_req'){
     
	$date=date('Y-m-d H:i:s');
    
      $fnct_menu = $database->mysqlQuery("update  tbl_requisition set tr_status_login='".$_SESSION['expodine_id']."',tr_status='".$_REQUEST['sts']."',tr_status_date='".$date."' where  tr_req_id='".$_REQUEST['id']."'  ");
        
      
      if($_REQUEST['sts']=='Approved'){
          
          
        $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_requisition where tr_req_id='".$_REQUEST['id']."' and tr_central='Y' and cloud_sync='N'  "); 
 
        $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){
            
          $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
          
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
     
    
      $sql_gen =  mysqli_query($localhost1,"INSERT INTO `tbl_requisition`(`branchid`,tr_id, `tr_req_id`, `tr_dayclosedate`, `tr_product`, `tr_name`,"
      . "`tr_rate_type`, `tr_barcode`, `tr_unittype`, `tr_weight`, `tr_qty`, `tr_brand`, `tr_set`, `tr_login`, `tr_status_login`, "
      . "`tr_status`, `tr_status_date`, `tr_store`, `cloud_sync`, `tr_branchid`, `tr_central`, `tr_central_accept`, `tr_indent`, `tr_indent_done`,tr_central_menu_id) VALUES"
              
     . " ('".$_SESSION['firebase_id']."','".$result_kotlist['tr_id']."','".$result_kotlist['tr_req_id']."','".$result_kotlist['tr_dayclosedate']."','".$result_kotlist['tr_product']."',"
       . "'".$result_kotlist['tr_name']."','".$result_kotlist['tr_rate_type']."',"
     . "'".$result_kotlist['tr_barcode']."','".$result_kotlist['tr_unittype']."','".$result_kotlist['tr_weight']."','".$result_kotlist['tr_qty']."','".$result_kotlist['tr_brand']."',"
     . " '".$result_kotlist['tr_set']."','".$result_kotlist['tr_login']."','".$result_kotlist['tr_status_login']."','".$result_kotlist['tr_status']."',"
     . "'".$result_kotlist['tr_status_date']."','".$result_kotlist['tr_store']."','Y','".$result_kotlist['tr_branchid']."',"
     . "'".$result_kotlist['tr_central']."','".$result_kotlist['tr_central_accept']."','".$result_kotlist['tr_indent']."','".$result_kotlist['tr_indent_done']."','".$result_kotlist['tr_central_menu_id']."') "); 
       
       
      }}
        
        
        $sql_kotlist  =  $database->mysqlQuery("update tbl_requisition set cloud_sync='Y' where tr_req_id='".$_REQUEST['id']."' and tr_central='Y'   ");
          
      }
      
      
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='approve_purchase'){
     
	$date=date('Y-m-d H:i:s');
    
      $fnct_menu = $database->mysqlQuery("update  tbl_purchase_order set tp_status_login='".$_SESSION['expodine_id']."',tp_status='".$_REQUEST['sts']."',tp_status_date='".$date."' where  tp_purchase_id='".$_REQUEST['id']."'  ");
        
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_req_qty'){
    
      $fnct_menu = $database->mysqlQuery("update  tbl_requisition set tr_qty='".$_REQUEST['qty']."',tr_weight='".$_REQUEST['weight']."'  where tr_id='".$_REQUEST['id']."' ");
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_partial_qty'){
    
    
//      $fnct_menu = $database->mysqlQuery("update  tbl_requisition set tr_partial_1='".$_REQUEST['partial']."' where tr_req_id='".$_REQUEST['indent_id']."' and tr_id='".$_REQUEST['id']."' and  tr_partial_1<=0  ");
//      
//      $fnct_menu = $database->mysqlQuery("update  tbl_requisition set tr_partial_2='".$_REQUEST['partial']."' where tr_req_id='".$_REQUEST['indent_id']."' and tr_id='".$_REQUEST['id']."' and  tr_partial_2<=0 and tr_partial_1>0 ");
//      
//      $fnct_menu = $database->mysqlQuery("update  tbl_requisition set tr_partial_3='".$_REQUEST['partial']."' where tr_req_id='".$_REQUEST['indent_id']."' and tr_id='".$_REQUEST['id']."' and  tr_partial_3<=0 and tr_partial_1>0 and  tr_partial_2>0 ");
//      
//      
    
    $date=date('Y-m-d H:i:s');
    
    
       $fnct_menu = $database->mysqlQuery("INSERT INTO `tbl_indent_partial`(`tip_req_id`, `tip_transfer_id`, `tip_qty_weight`, `tip_date`, `tip_menuid`,
           `tip_done`) VALUES ('".$_REQUEST['indent_id']."','0','".$_REQUEST['partial']."','$date','".$_REQUEST['product_indent']."','N')");
    
    
    
    
    
      
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_por_qty'){
    
    
      $fnct_menu = $database->mysqlQuery("update  tbl_purchase_order set tp_qty='".$_REQUEST['qty']."',tp_weight='".$_REQUEST['weight']."' where tp_id='".$_REQUEST['id']."' ");
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_req'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_requisition where tr_set='N' and tr_ip='$localIP' and tr_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_production'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_production where tp_set='N' and tp_product='".$_REQUEST['product']."' and tp_portion='".$_REQUEST['portion']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_por'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_purchase_order where tp_set='N' and  tp_ip='$localIP' and tp_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_phy_def'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_physical_default where tpf_product='".$_REQUEST['product']."' and tpf_store='".$_REQUEST['store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_phy'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_physical_stock where tps_set='N' and tps_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_consump'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_consumption where tc_set='N' and tc_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_wastage'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_wastage where tw_set='N' and tw_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_grn'){
    
    $fnct_menu = $database->mysqlQuery("select tg_product from tbl_grn_order where tg_set='N'  and tg_ip='$localIP' and  tg_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_batchno'){
    
    $fnct_menu = $database->mysqlQuery("select tg_batch_id from tbl_grn_order where tg_set='N'  and tg_ip='$localIP' and  tg_product='".$_REQUEST['product']."' and tg_batch_id='".$_REQUEST['batch_no']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_grn'){
   
         
         $row21=array();  
         $inv_req='';
         
         
         if($_REQUEST['edit_id']!='' ){
             
             $req_id=$_REQUEST['edit_id'];
             
         }else{
            
             
          $sql_login  =  $database->mysqlQuery("select ti_grn_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
		  { 
                      
                            $inv_req=$result_login['ti_grn_id'];
                  }
                  }
         
                  
                  
        $req_id='Grn_'.$inv_req; 
                 
       
        
          $req_id=  rand(100, 999999); 
        
        
       }
        
        
       
          $insertion['tg_grn_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tg_dayclosedate']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
          $insertion['tg_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tg_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
          $insertion['tg_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
            $insertion['tg_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
         
          if($_REQUEST['batch_no']!=''){
            $insertion['tg_batch_id']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['batch_no']));
         }
         
         
         
        $insertion['tg_unittype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        $insertion['tg_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        
        if($_REQUEST['brand']!=''){
          $insertion['tg_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
        if($_REQUEST['weight']!=''){
           $insertion['tg_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
         if($_REQUEST['unit_rate']!=''){					
           $insertion['tg_unit_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_rate']));
         }
         
          if($_REQUEST['total_rate']!=''){
             $insertion['tg_total_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['total_rate']));
          }
          
           if($_REQUEST['tax_percentage']!=''){
             $insertion['tg_tax_percent']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax_percentage']));
           }
           
            if($_REQUEST['tax_rate']!=''){
               $insertion['tg_tax_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax_rate']));
            }
            
         if($_REQUEST['final_rate']!=''){
                $insertion['tg_final_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['final_rate']));
         }
             
         if($_REQUEST['exp_date']!=''){
         
            $insertion['tg_expiry_date']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['exp_date']));
         }
              
         $insertion['tg_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
        
        
        $insertion['tg_ip']= mysqli_real_escape_string($database->DatabaseLink,trim($localIP));
            
    $sql=$database->check_duplicate_entry('tbl_grn_order',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_grn_order',$insertion);   
     
         
         $fnct_menu1 = $database->mysqlQuery("select * from tbl_grn_order where  tg_set='N' and tg_ip='$localIP'  order by tg_id desc ");
         $num_fdtl1 = $database->mysqlNumRows($fnct_menu1);
         if($num_fdtl1){
              while ($result_fnctvenue1 = $database->mysqlFetchArray($fnct_menu1))
              {
                      $row21[]=$result_fnctvenue1;
             }
          }
            
                 echo json_encode($row21);
      
        }
      
   
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_all_grn'){
    
     $row2=array();
     
     if($_REQUEST['grn_edit_id']!='' &&  $_REQUEST['grn_edit_id']!='undefined' && $_REQUEST['grn_edit_id']!=' ' && $_REQUEST['grn_edit_id']!='null'){
         
        $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where  tg_grn_id='".$_REQUEST['grn_edit_id']."'  order by tg_id desc ");
        
     }else{
         
         $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where tg_set='N' and tg_ip='$localIP'  order by tg_id desc "); 
         
    }
     
     
   
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
        
           
     echo json_encode($row2);
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_grn'){
    
    
    $grn_total=0; $grn_tax=0; $grn_total1=0; $grn_id='';
    
         $fnct_menu66 = $database->mysqlQuery("select * from tbl_grn_order where tg_set='N' and tg_ip='$localIP' ");
         $num_fdtl66 = $database->mysqlNumRows($fnct_menu66);
         
        if ($num_fdtl66 > 1 || $_REQUEST['edit_id']=='') {
            
        
    
     $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where  tg_id='".$_REQUEST['id']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  
                  $grn_total1=$result_fnctvenue['tg_final_rate'];
                  $grn_tax=$result_fnctvenue['tg_tax_rate'];
                  
                  
                  $grn_total=($grn_total1-$grn_tax);
                  
                  $grn_id=$result_fnctvenue['tg_grn_id'];
                  
               $fnct_menu1 = $database->mysqlQuery("update tbl_grn_summary set"
                . " tg_final_total=(tg_final_total-'".$grn_total."'),tg_tax_amount=(tg_tax_amount-'".$grn_tax."'),"
                . "tg_grand_total=(tg_final_total+tg_tax_amount+tgs_adjustment) where tgs_grn_id='".$result_fnctvenue['tg_grn_id']."' ");               
                  
                  
              }
        } 
    
   
       $fnct_menu1 = $database->mysqlQuery("delete from  tbl_grn_order where tg_id='".$_REQUEST['id']."' ");    
             
       $fnct_menu12 = $database->mysqlQuery("select * from tbl_grn_order where tg_set='N' ");
       $num_fdtl12 = $database->mysqlNumRows($fnct_menu12);
        if ($num_fdtl12 > 0) {
             echo 'yes';
        }else{
             echo 'no';
             
         $fnct_menu1 = $database->mysqlQuery("delete from  tbl_grn_summary where tgs_grn_id='".$grn_id."' ");       
              
       }
         
       
        }else{
            echo 'oneitem';
            
        }
       
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_grn_qty'){
   
    if($_REQUEST['tax_percentage']!=''){
        
        $tax="'".$_REQUEST['tax_percentage']."'";
        
    }else{
        $tax='NULL';
    }
    
    if($_REQUEST['tax_rate']!=''){
        
        $tax_rate="'".$_REQUEST['tax_rate']."'";
        
    }else{
        $tax_rate='NULL';
    }
    
    
    if($_REQUEST['exp_date']!=''){
        
        $exp_date="'".$_REQUEST['exp_date']."'";
        
    }else{
        $exp_date='NULL';
    }
    
    
   
        
   $fnct_menu = $database->mysqlQuery("update  tbl_grn_order set tg_qty='".$_REQUEST['qty']."',tg_weight='".$_REQUEST['weight']."',"
              . "tg_unit_rate='".$_REQUEST['unit_rate']."' ,	"
   . " tg_total_rate='".$_REQUEST['total_rate']."',tg_tax_percent=$tax,tg_tax_rate=$tax_rate,tg_expiry_date=$exp_date ,"
         . " tg_final_rate='".$_REQUEST['final_rate']."'"
              . " where tg_id='".$_REQUEST['id']."' ");
 
 
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_grn_all'){
    
    
    
    if($_REQUEST['edit_id']!='' && $_REQUEST['edit_id']!='undefined' && $_REQUEST['edit_id']!=' '){
        
        
      $grn_id=$_REQUEST['edit_id'];
      
    }else{
        
     $fnct_menu = $database->mysqlQuery("select tg_grn_id from tbl_grn_order where tg_set='N' and tg_ip='$localIP' group by tg_grn_id limit 1");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  
                  $grn_id=$result_fnctvenue['tg_grn_id'];
                  
              }
              }
              
    }        
           
              
        $fnct_menu = $database->mysqlQuery("select tgs_grn_id from tbl_grn_summary where tgs_grn_id='$grn_id' ");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            
            $fnct_menu = $database->mysqlQuery("update  tbl_grn_summary set tg_date='".$_REQUEST['purchase_date']."',"
                    . " tgs_adjustment='".$_REQUEST['adj']."', tg_final_total='".$_REQUEST['grn_tot']."', "
                    . "tg_tax='".$_REQUEST['tax_bottom']."',tgs_invoice_no='".$_REQUEST['invoice_no']."',"
                    . "tg_tax_amount='".$_REQUEST['tax_rate_bottom']."', tgs_remarks= '".$_REQUEST['remarks_grn_new']."', "
                    . " tg_grand_total=(tg_tax_amount+tg_final_total+tgs_adjustment) where "
                    . " tgs_grn_id='$grn_id' ");
            
    
            }else{
                
                
                
          $sql_login  =  $database->mysqlQuery("select ti_grn_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
	   while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   { 
                      
                            $inv_req=$result_login['ti_grn_id'];
          } }
              
           $grn_id='G'.$inv_req; 
            
            
            $fnct_menu = $database->mysqlQuery("INSERT INTO `tbl_grn_summary`(`tgs_grn_id`, `tg_final_total`, `tg_tax`, `tg_tax_amount`, "
                    . " `tg_grand_total`, `tg_date`,tgs_invoice_no,tgs_adjustment,tgs_ip,tgs_remarks) VALUES ('$grn_id','".$_REQUEST['grn_tot']."','".$_REQUEST['tax_bottom']."','".$_REQUEST['tax_rate_bottom']."',"
                    . " '".$_REQUEST['total_bottom']."','".$_REQUEST['purchase_date']."','".$_REQUEST['invoice_no']."','".$_REQUEST['adj']."','$localIP','".$_REQUEST['remarks_grn_new']."')");
             
            
            
             $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_grn_id=(ti_grn_id+1) ");
             
          }
          
            
         
       $fnct_menu99 = $database->mysqlQuery("select tg_grn_id from tbl_grn_order where tg_grn_id='$grn_id' and tg_ip='$localIP' ");
        $num_fdtl99 = $database->mysqlNumRows($fnct_menu99);
        if ($num_fdtl99 > 0) { 
          
          $fnct_menu991 = $database->mysqlQuery("update  tbl_grn_order set  tg_set='Y',tg_store='".$_REQUEST['store']."',tg_supplier='".$_REQUEST['supplier']."' where  tg_grn_id='$grn_id' and tg_ip='$localIP' ");
       
         
        }else{
              
          $fnct_menu8817 = $database->mysqlQuery("update tbl_grn_order set tg_batch_id='$grn_id'  where tg_batch_id is null and tg_set='N' and tg_ip='$localIP' ");
      
          $fnct_menu8813 = $database->mysqlQuery("update  tbl_grn_order set tg_grn_id='$grn_id', tg_set='Y',tg_store='".$_REQUEST['store']."',tg_supplier='".$_REQUEST['supplier']."' where tg_set='N' and tg_ip='$localIP' ");
        
         
          
        }
        
       
       $fnct_menu881 = $database->mysqlQuery("delete from  tbl_grn_order where tg_set='N' and tg_ip='$localIP' ");
         
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='approve_grn'){
     
	$date=date('Y-m-d H:i:s');
    
      $fnct_menu = $database->mysqlQuery("update  tbl_grn_order set tg_status_login='".$_SESSION['expodine_id']."',tg_status='".$_REQUEST['sts']."',tg_status_date='".$date."' where  tg_grn_id='".$_REQUEST['id']."'  ");
    
      
      
      if($_REQUEST['sts']=='Approved'){
      //////supplier voucher ////
      
        $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tbl_grn_order.tg_grn_id='".$_REQUEST['id']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
      
         $date=date('Y-m-d');
    
        $insertion['sv_vendor_id'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_supplier']);
        $insertion['sv_date'] 		               =  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']);
       
        $insertion['sv_invoice_no'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tgs_invoice_no']);
        $insertion['sv_invoice_amount'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_grand_total']);
        
        //$insertion['sv_from'] 		               =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_grand_total']);
        // $insertion['sv_trn_detail'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['v_trn_detail']); 
       // $insertion['sv_remarks'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['v_remarks']);
        
         $insertion['sv_paid_amount'] 		       =  mysqli_real_escape_string($database->DatabaseLink,0);
        
        $insertion['sv_entry_type'] 		       =  mysqli_real_escape_string($database->DatabaseLink,'Credit');
         
         $insertion['sv_entry_date'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$date);
         
         $insertion['sv_credit_amount'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_grand_total']);
       
         $insertion['sv_purchase_type'] 		       =  mysqli_real_escape_string($database->DatabaseLink,'Stock');
         
         $insertion['sv_discount'] 		       =  mysqli_real_escape_string($database->DatabaseLink,0);
            
          $insertion['sv_subtotal'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_final_total']);
           
          if($result_fnctvenue['tg_tax_amount']>0){
          $insertion['sv_tax'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue['tg_tax_amount']);
          }
            
           $insertion['sv_paid_fully'] 		       =  mysqli_real_escape_string($database->DatabaseLink,'N');
               
            $insertion['sv_type_pay'] 		       =  mysqli_real_escape_string($database->DatabaseLink,'First');  
             
        
         $entry_time=date('Y-m-d H:i:s'); 
         $insertion['sv_entry_time'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$entry_time); 
        
        $insertion['sv_login'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']); 
            
        $insertion['sv_from_inventory'] 		        =  mysqli_real_escape_string($database->DatabaseLink,'Y');     
            
        $sql=$database->check_duplicate_entry('tbl_supplier_voucher',$insertion);
	 if($sql!=1)
	 {
           $insertid =  $database->insert('tbl_supplier_voucher',$insertion);
         } 
       
        }}
        
      }
      
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_po'){
    
     
    $fnct_menu = $database->mysqlQuery("select * from tbl_purchase_order where tp_set='N'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
             echo 'no';
        }else{
            echo 'yes';
        }
     
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_grn'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where tg_set='N'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
             echo 'no';
        }else{
            echo 'yes';
        }
     
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_grn_all_from_purchase'){
    
     
    $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where tg_set='N' and tg_unit_rate IS NULL   ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
             echo 'no';
        }else{
            echo 'yes';
        }
     
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_store_stock1'){
     
   
    $string2='';
    
   
    if($_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
    }
    
    
     if($_REQUEST['barcode']!=''){
    $string2.=" and ts_barcode like '%".$_REQUEST['barcode']."%'   ";
    }
    
      if($_REQUEST['expiry']!=''){
    $string2.=" and ts_expiry = '".$_REQUEST['expiry']."'   ";
    }
    
     if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    if($_REQUEST['brand']!=''){
    $string2.=" and ts_brand = '".$_REQUEST['brand']."'   ";
    }
    
    
    $ord='';
     if($_REQUEST['stock_order']!=''){
         
         
    if($_REQUEST['stock_order']=='higherqty'){      
    $ord.=" order by ts_qty asc  ";
    }
    
     if($_REQUEST['stock_order']=='lowerqty'){      
    $ord.=" order by ts_qty desc  ";
    }
    
     if($_REQUEST['stock_order']=='higherwgt'){      
    $ord.=" order by ts_weight asc  ";
    }
    
     if($_REQUEST['stock_order']=='lowerwgt'){      
    $ord.=" order by ts_weight desc  ";
    }
    
    
    }else{
        $ord.=" order by mr_menuname asc";
    }
    
    
    
    
    
     if($_REQUEST['reorder']!=''){
         
         if($_REQUEST['reorder']=='nostock'){
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <='0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <='0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <='0') )";
        }
        
         if($_REQUEST['reorder']=='reorder'){
       $string2.=" and( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <= mr_reorder_level)  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <= mr_reorder_level )  or ( (ts_unit='KG'  || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <= mr_reorder_level) )";
        }
        
       
     }
    
     
       if($_REQUEST['store']!=''){
       $string2.=" and ts_store = '".$_REQUEST['store']."'   ";
        }
   
       if($_REQUEST['menu_type']!=''){
    $string2.=" and mr_product_type = '".$_REQUEST['menu_type']."'   ";
    }
    
      if($_REQUEST['rt']!=''){
    $string2.=" and ts_rate_type = '".$_REQUEST['rt']."'   ";
    }
    
          if($_REQUEST['ut']!=''){
    $string2.=" and ts_unit = '".$_REQUEST['ut']."'   ";
    }
        
        
		$tot_rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(ts_weight) as  weight ,sum(ts_qty) as  qty ,sum(ts_total) as  rate,ts_unit_price as  unit_rate,ts_weight as nrm_weight  from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product  $ord "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
				{  
                                    
                            $tot_rate=$tot_rate+ $result_kotlist['rate'];     
             
               }}
               
               $item_ct=0;
                $sql_kotlist5  =  $database->mysqlQuery("SELECT ts_weight from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product"); 
 
                    $num_kotlist  = $database->mysqlNumRows($sql_kotlist5);
					if($num_kotlist){ 
				while($result_kotlist99  = $database->mysqlFetchArray($sql_kotlist5)) 
				{  
                                   $item_ct++;
                                    
                                }
                                }

 echo number_format($tot_rate,$_SESSION['be_decimal']).'*'.$item_ct;
 
 
 
 
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_store_stock'){
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
      <tr>
      <th scope="col">Sl</th>
      <th scope="col">Product</th>
      <th scope="col">Type</th>
      <th scope="col">Barcode</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Category</th>
      <th scope="col">Weight</th>
      <th scope="col">Qty</th>
      <th scope="col">Unit</th>
      <th style="display:none" scope="col">Avg Rate</th>
        <th  scope="col">Unit Rate</th>
      <th style="display:none" scope="col">Weighted Avg Rate</th> 
      <th scope="col">Total</th>
      <th title="REORDER QTY-WEIGHT" scope="col">ReOrder</th>
      <th title="LAST ADDED PRODUCT EXPIRY DATE  " scope="col">Lst Exp</th>
      <th title="LAST ADDED PRODUCT GRN ID  " scope="col">Lst Grn </th>
      <th  title="LAST ADDED PRODUCT PURCHASE DATE " scope="col">Lst Pur</th>
      <th  title="STOCK CONVERTER" scope="col">Conv</th>
      <th  title="STOCK CONVERTER" scope="col">Cnt Id</th>
    </tr>
   </thead>
   <tbody>
       
  <?php
    
    
    
   $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }


    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
    }
   
    
     
    if($_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
    }
    
    
     if($_REQUEST['barcode']!=''){
    $string2.=" and ts_barcode like '%".$_REQUEST['barcode']."%'   ";
    }
    
      if($_REQUEST['expiry']!=''){
    $string2.=" and ts_expiry = '".$_REQUEST['expiry']."'   ";
    }
    
     if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    if($_REQUEST['brand']!=''){
    $string2.=" and ts_brand = '".$_REQUEST['brand']."'   ";
    }
    
    
     if($_REQUEST['reorder']!=''){
         
         if($_REQUEST['reorder']=='nostock'){
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <='0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <='0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <='0') )";
        }
        
         if($_REQUEST['reorder']=='reorder'){
       $string2.=" and( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <= mr_reorder_level)  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <= mr_reorder_level )  or ( (ts_unit='KG'  || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <= mr_reorder_level) )";
        }
        
       
     }
    
     
       if($_REQUEST['store']!=''){
       $string2.=" and ts_store = '".$_REQUEST['store']."'   ";
        }
   
        
        $ord='';
     if($_REQUEST['stock_order']!=''){
         
         
    if($_REQUEST['stock_order']=='higherqty'){      
    $ord.=" order by ts_qty desc  ";
    }
    
     if($_REQUEST['stock_order']=='lowerqty'){      
    $ord.=" order by ts_qty asc  ";
    }
    
     if($_REQUEST['stock_order']=='higherwgt'){      
    $ord.=" order by ts_weight desc  ";
    }
    
     if($_REQUEST['stock_order']=='lowerwgt'){      
    $ord.=" order by ts_weight asc  ";
    }
    
    
    }else{
        $ord.=" order by mr_menuname asc";
    }
    
        
    
    if($_REQUEST['menu_type']!=''){
    $string2.=" and mr_product_type = '".$_REQUEST['menu_type']."'   ";
    }
    
      if($_REQUEST['rt']!=''){
    $string2.=" and ts_rate_type = '".$_REQUEST['rt']."'   ";
    }
    
          if($_REQUEST['ut']!=''){
    $string2.=" and ts_unit = '".$_REQUEST['ut']."'   ";
    }
        
        
       // echo "SELECT *,sum(ts_weight) as  weight ,sum(ts_qty) as  qty ,sum(ts_total) as  rate,ts_unit_price as  unit_rate,ts_weight as nrm_weight  from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product  order by mr_menuname asc limit ". $pagination.",10 ";
        
                
		$weight=0; $qty=0; $rate=0; $unit_rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(ts_weight) as  weight ,sum(ts_qty) as  qty ,sum(ts_total) as  rate,ts_unit_price as  unit_rate,ts_weight as nrm_weight  from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product  $ord limit ". $pagination.",100 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
				{  
                                    
                       if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){
                           
                          if($result_kotlist['ts_rate_type']=='Packet' && $result_kotlist['ts_unit']=='Nos'){
                             $weight=  $result_kotlist['nrm_weight'];     
                          }else{
                              $weight= ''; 
                          }
                        
                         $qty= $result_kotlist['qty'];   
                        
                       }else{
                           
                           if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR')){
                           
                            $weight= $result_kotlist['nrm_weight'];
                            $qty= $result_kotlist['qty']; 
                           
                           }else{
                               
                               $weight= $result_kotlist['weight'];    
                               $qty= ''; 
                               
                           }
                           
                           
                       }
                        
                        
                          $rate= $result_kotlist['rate'];   
                          
                         $unit_rate= $result_kotlist['unit_rate'];               
                          
                                    $i++;
                                                  
                         ?>

               <tr>
                           <td><?=$i?></td>
                           <td title="MENUID : <?=$result_kotlist['mr_menuid']?>"><?=$result_kotlist['mr_menuname']?></td>
                            
                            <?php if($result_kotlist['mr_product_type']=='Raw'){ ?>
                            <td>RW</td>
                            <?php }else if($result_kotlist['mr_product_type']=='Finished'){ ?>
                            <td>FG</td>
                             
                             <?php } ?>
                            
                           <td><?=$result_kotlist['ts_barcode']?></td>
                           <td><?=$result_kotlist['ts_rate_type']?></td>
                          
                           <td title="<?=$result_kotlist['mmy_maincategoryname']?>"><?=$result_kotlist['mmy_maincategoryname']?></td>
                           <td><?=$weight?></td>
                           <td><?=$qty?></td>
                           <td><?=$result_kotlist['ts_unit']?></td>
                           
                          <?php  if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){ ?>
                         
                            <?php  if($rate>0 && $qty>0 ){ ?>
                            <td style="display:none"><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                             <?php }else {?>
                             <td style="display:none">0</td>
                            
                             <?php } ?>
                            
                           <?php }else{ ?>
                             
                            <?php  if($rate>0 && ($weight>0 || $qty>0 )){ ?>
                             
                             
                             <?php  if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR')){ ?>
                             <td style="display:none"><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                              <?php }else {?>
                            <td style="display:none"><?=number_format(($rate/$weight),$_SESSION['be_decimal'])?></td>
                              <?php } ?>
                             
                             
                              <?php }else {?>
                             <td style="display:none">0</td>
                              <?php } ?>
                             
                            <?php } ?>
                             
                            <td ><?=  number_format($unit_rate,$_SESSION['be_decimal'])?></td>
                             <td><?= number_format($rate,$_SESSION['be_decimal']) ?></td>
                             
                             
    <td 
    <?php if( ($result_kotlist['qty']<=$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_unit']=='Single' || $result_kotlist['ts_unit']=='Nos'))
    || ($result_kotlist['weight']<=$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_unit']!='Single' && $result_kotlist['ts_rate_type'] !='Packet' && $result_kotlist['ts_unit']!='Nos')) || ($result_kotlist['ts_qty']<=$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR'))) ){ ?>
    style="background-color: red;color: white ;cursor: pointer" title="Item Need To Be Ordered For Purchase"  <?php } ?> ><?=$result_kotlist['mr_reorder_level']?>
    </td>
                           
                          
                             <td title="Expiry Dates"  > <i style="float:left;cursor: pointer" onclick="expiry_date('<?=$result_kotlist['ts_product'] ?>');"  class="fa fa-calendar fa-lg" aria-hidden="true"></i> &nbsp; &nbsp; <?=$result_kotlist['ts_expiry']?></td>
                           
                           <td ><i style="float:left;cursor: pointer" onclick="grn_qty('<?=$result_kotlist['ts_product'] ?>');"  class="fa fa-list-alt fa-lg" aria-hidden="true"></i> &nbsp; &nbsp; <?=$result_kotlist['ts_last_grn']?>  </td>
                   
                           <?php  $last_pur_date='';
                            $sql_kotlist6  =  $database->mysqlQuery("SELECT tg_date  from tbl_grn_summary  where tgs_grn_id='".$result_kotlist['ts_last_grn']."'  "); 
 
                               $num_kotlist6  = $database->mysqlNumRows($sql_kotlist6);
				   if($num_kotlist6){ 
				while($result_kotlist6  = $database->mysqlFetchArray($sql_kotlist6)) 
				{  
                                   $last_pur_date= $result_kotlist6['tg_date'];
                                    
                                }
                                }
                           ?>
                           
                           <td  ><i style="float:left;cursor: pointer;" class="" aria-hidden="true"></i> &nbsp; &nbsp; <?=$last_pur_date?>  </td> 
                           
                           <td  onclick="conversion('<?=$result_kotlist['ts_product'] ?>','<?=$result_kotlist['ts_store'] ?>','<?=$result_kotlist['mr_menuname'] ?>','<?=$result_kotlist['ts_qty'] ?>','<?=$result_kotlist['ts_weight'] ?>','<?=$result_kotlist['ts_unit'] ?>','<?=$result_kotlist['ts_rate_type'] ?>')" style="cursor:pointer" ><span style="font-size: 7px;font-weight: bold;border: solid 1px ; border-radius: 5px;padding: 3px;color: darkred ">CONVERSION</span>   </td>   
              
                           <td  ><i style="float:left;cursor: pointer;" class="" aria-hidden="true"></i> &nbsp; &nbsp; <?=$result_kotlist['mr_central_id']?>  </td> 
     </tr>


<?php 
         }}

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 17px !important ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/100)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                           
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                       <a href="#"  class="inv-pagination-list"  value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+100; } $m=$m-100;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
}

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='add_update_store_stock'){
    
   $date=date('Y-m-d');
    
   $grn_di=$_REQUEST['grn_id'];
   $exp='';
   $date88=date('Y-m-d H:i:s'); 
       
   $menu_in==array();  $store_in==array();
       
   if($_REQUEST['sts']=='Approved'){
   
     
            $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_grn_order where tg_grn_id='$grn_di'  "); 
            $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	    if($num_kotlist){
            while ($result_fnctvenue = $database->mysqlFetchArray($sql_kotlist)){
              
               $menu_in[]=$result_fnctvenue['tg_product'];
               
               $store_in[]=$result_fnctvenue['tg_store'];
              
              if($result_fnctvenue['tg_expiry_date']!=''){
                       $exp="'".$result_fnctvenue['tg_expiry_date']."'";
              }else{
                       $exp='NULL';
              }
              
              
              if($result_fnctvenue['tg_barcode']!=''){
                  
                     $bar="'".$result_fnctvenue['tg_barcode']."'";
                     
              }else{
                       $bar='NULL';
              }
              
              
         $sql_kotlist3  =  $database->mysqlQuery("SELECT ts_product from tbl_store_stock  where ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."' and ts_updating='N'  "); 
         $num_kotlist3  = $database->mysqlNumRows($sql_kotlist3);
	 if($num_kotlist3>0){
             
               
         if($result_fnctvenue['tg_unittype']=='Nos' || $result_fnctvenue['tg_unittype']=='Single') {  
           
          $sql_login5  =  $database->mysqlQuery(" update tbl_store_stock set ts_expiry=$exp, ts_last_grn='$grn_di', ts_qty=ts_qty+'".$result_fnctvenue['tg_qty']."' "
          . " ,ts_total=ts_total+'".$result_fnctvenue['tg_final_rate']."',ts_unit_price=(ts_total/ts_qty),ts_barcode=$bar,ts_stock_update_date='".$date."' where ts_updating='N' and  ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."' ");        
           
      
        }else{
            
             if($result_fnctvenue['tg_rate_type']=='Packet' && ($result_fnctvenue['tg_unittype']=='KG' || $result_fnctvenue['tg_unittype']=='LTR')) {  
                 
              $sql_login5  =  $database->mysqlQuery(" update tbl_store_stock set ts_expiry=$exp, ts_last_grn='$grn_di', ts_qty=ts_qty+'".$result_fnctvenue['tg_qty']."' "
              . " ,ts_total=ts_total+'".$result_fnctvenue['tg_final_rate']."',ts_unit_price=(ts_total/ts_qty),ts_barcode=$bar,ts_stock_update_date='".$date."' where ts_updating='N' and  ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."' ");        
          
             }else{
                 
               echo   " update tbl_store_stock set ts_expiry=$exp, ts_last_grn='$grn_di', ts_weight=ts_weight+'".$result_fnctvenue['tg_weight']."' "
              . " ,ts_total=ts_total+'".$result_fnctvenue['tg_final_rate']."',ts_unit_price=(ts_total/ts_weight),ts_barcode=$bar,ts_stock_update_date='".$date."' where ts_updating='N' and  ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."' ";        
          
                 
                 $sql_login5  =  $database->mysqlQuery(" update tbl_store_stock set ts_expiry=$exp, ts_last_grn='$grn_di', ts_weight=ts_weight+'".$result_fnctvenue['tg_weight']."' "
              . " ,ts_total=ts_total+'".$result_fnctvenue['tg_final_rate']."',ts_unit_price=(ts_total/ts_weight),ts_barcode=$bar,ts_stock_update_date='".$date."' where ts_updating='N' and  ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."' ");        
          
            }
              
              
        }        
      
      
                   
           }else{ 
               
               
                if($result_fnctvenue['tg_unittype']=='Nos' || $result_fnctvenue['tg_unittype']=='Single') {  
                
            $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_expiry`, `ts_last_grn`,ts_rate_type,ts_store,ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
              SELECT   `tg_product`,  `tg_barcode`, `tg_qty`, tg_weight, `tg_unittype`,'0' ,tg_final_rate,'0',
             tg_expiry_date,'$grn_di',tg_rate_type,tg_store,(tg_final_rate/tg_qty),'".$date."',tg_tax_percent,tg_tax_rate  FROM tbl_grn_order where tg_grn_id='$grn_di' and tg_product='".$result_fnctvenue['tg_product']."' and tg_store='".$result_fnctvenue['tg_store']."'  group by tg_product,tg_store
                                
             "); 
                }else{
                    
                    
               if($result_fnctvenue['tg_rate_type']=='Packet' && ($result_fnctvenue['tg_unittype']=='KG' || $result_fnctvenue['tg_unittype']=='LTR')) {  
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_expiry`, `ts_last_grn`,ts_rate_type,ts_store,ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
              SELECT   `tg_product`,  `tg_barcode`, `tg_qty`, tg_weight, `tg_unittype`,'0' ,tg_final_rate,'0',
             tg_expiry_date,'$grn_di',tg_rate_type,tg_store,(tg_final_rate/tg_qty),'".$date."',tg_tax_percent,tg_tax_rate  FROM tbl_grn_order where tg_grn_id='$grn_di' and tg_product='".$result_fnctvenue['tg_product']."' and tg_store='".$result_fnctvenue['tg_store']."'  group by tg_product,tg_store
                                
             "); 
                   }else{
                       
                       
                        $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_expiry`, `ts_last_grn`,ts_rate_type,ts_store,ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
              SELECT   `tg_product`,  `tg_barcode`, `tg_qty`, tg_weight, `tg_unittype`,'0' ,tg_final_rate,'0',
             tg_expiry_date,'$grn_di',tg_rate_type,tg_store,(tg_final_rate/tg_weight),'".$date."',tg_tax_percent,tg_tax_rate  FROM tbl_grn_order where tg_grn_id='$grn_di' and tg_product='".$result_fnctvenue['tg_product']."' and tg_store='".$result_fnctvenue['tg_store']."'  group by tg_product,tg_store
                                
             "); 
                   }
                    
                    
                }
            
            
               
           }
           
           
           
     
      
      
      $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$result_fnctvenue['tg_product']."' and ts_store='".$result_fnctvenue['tg_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tg_product']."' and tmi_store='".$result_fnctvenue['tg_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tg_product']."' and tmi_store='".$result_fnctvenue['tg_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$result_fnctvenue['tg_product']."' and tmi_store='".$result_fnctvenue['tg_store']."'  ");                        
                    
                      }
                     
                 }
                 
               //recipe Food Cost update ///  
                 
           $ing_rate_changed='';  $main_menu=array();       $main_store=array();     
         $sql_login88  =  $database->mysqlQuery("select tmi_ing_rate,tmi_menuid,tmi_ing_menuid,tmi_store from tbl_menu_ingredient_detail where tmi_ing_menuid='".$result_fnctvenue['tg_product']."' and tmi_store='".$result_fnctvenue['tg_store']."' group by tmi_menuid "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                      $ing_rate_changed='Y';
                  }
                    //update////
                  
                  
                  $main_menu[]=$result_login881['tmi_menuid'];
                   $main_store[]=$result_login881['tmi_store'];
                  
              }}
                   
                  }
                  }
            
              
                 
          } }
                  
      
      
       }}
       
   for($jj=0;$jj<=count($menu_in);$jj++){   
       $sql_login50  =  $database->mysqlQuery(" update tbl_store_stock set  ts_updating='Y' where "
       . " ts_product='".$menu_in[$jj]."' and ts_store='".$store_in[$jj]."'  ");                      
   }  
       
       
       
       for($i=0;$i<=count($main_menu);$i++){
         $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'   "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."' ) "); 
                  }
              
         
                      
                 }}      
                      
              }
                 
                 ///end food cost///
       
       
       
       
      $sql_login5  =  $database->mysqlQuery(" update tbl_store_stock set  ts_updating='N'  "); 
      
}
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_transfer'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_store_transfer where tt_set='N' and tt_ip='$localIP' and tt_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_product_transfer_central'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_central_kitchen_transfer where tct_set='N' and tct_product='".$_REQUEST['product']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            echo 'no';
        }else{
            echo 'yes';
        }
        
       
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_transfer_central'){
   
         $row2=array();
         
         $inv_req='';
         $tot=0;

         
         
         
         $sql_login  =  $database->mysqlQuery("select ti_central_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_central_id'];
                  }
                  }
                  
                  
                $req_id='Cnt_'.$inv_req;  
         
               
                
        	
        $insertion['tct_central_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
        
        $date_cnt=date('Y-m-d H:i:s');
        
        $insertion['tct_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($date_cnt));
          
        $insertion['tct_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tct_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
        if($_REQUEST['barcode']!=''){
             
        $insertion['tct_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
        
         }
         
        $insertion['tct_unit_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        
        if($_REQUEST['qty']>0){
              
        $insertion['tct_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        
        }
        
        if($_REQUEST['central_id']>0){
              
        $insertion['tct_central_menu_id']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['central_id']));
        
        }
          
         
        
        if($_REQUEST['brand']!=''){
            
        $insertion['tct_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
         if($_REQUEST['weight']>0){
             
         $insertion['tct_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
         }
         
         
         if($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='Single' ){
      
          $insertion['tct_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']*$_REQUEST['rate']));
        
          $tot=($_REQUEST['qty']*$_REQUEST['rate']);
          
         }else{
             
            
           if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
                  
            $insertion['tct_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']*$_REQUEST['rate']));  
            $tot=($_REQUEST['qty']*$_REQUEST['rate']);
            
            
         }else{
                  
                   $insertion['tct_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']*$_REQUEST['rate']));  
                   $tot=($_REQUEST['weight']*$_REQUEST['rate']);
         }
            
         
        }
        
         
          $insertion['tct_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate']));
          
        
         $tot_tax=0; 
         $fnct_menu = $database->mysqlQuery("select ts_tax,ts_tx_amount from tbl_store_stock where ts_product='".$_REQUEST['product_id']."' and ts_store='".$_REQUEST['from_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) {
              while ($result_fnctvenue7 = $database->mysqlFetchArray($fnct_menu))
              {
                  
                  if($result_fnctvenue7['ts_tax']>0 && $result_fnctvenue7['ts_tax']!=''){
                      
                      $insertion['tct_tax']= mysqli_real_escape_string($database->DatabaseLink,trim($result_fnctvenue7['ts_tax']));
                      
                       $tot_tax=(($tot*$result_fnctvenue7['ts_tax'])/100);
                      
                        $insertion['tct_total_tax']= mysqli_real_escape_string($database->DatabaseLink,trim($tot_tax));
                    }
                        
                  }
            }
            
           
            $insertion['tct_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));  
            
            $insertion['tct_final_total']= mysqli_real_escape_string($database->DatabaseLink,trim($tot_tax+$tot));  
           
           
            $insertion['tct_local_branch']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['local_branch']));  
            
            
            $insertion['tct_local_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_store']));  
             
             
            $insertion['tct_to_branch']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['to_branch']));  
              
            $insertion['tct_to_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['to_store']));
           
            $insertion['tct_current_stock']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['current_stock']));
          
            $insertion['tct_type']= mysqli_real_escape_string($database->DatabaseLink,trim('Central'));
             
             $insertion['tct_mode']= mysqli_real_escape_string($database->DatabaseLink,trim('Transfer'));
	
    $sql=$database->check_duplicate_entry('tbl_central_kitchen_transfer',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_central_kitchen_transfer',$insertion);   
        
      
        $fnct_menu = $database->mysqlQuery("select * from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_central_kitchen_transfer.tct_product where tct_set='N' group by tct_central_id,tct_product order by tct_id desc ");
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
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_central_transfer_load'){
    
     $row2=array();
    
      $fnct_menu = $database->mysqlQuery("select * from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_central_kitchen_transfer.tct_product where tct_set='N' group by tct_central_id,tct_product order by tct_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_central_transfer_load_live'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
     $row2=array();
    
      $sql_gen =  mysqli_query($localhost1,"select * from tbl_cloud_store_transfer left join tbl_menumaster on "
              . "tbl_menumaster.mr_central_id=tbl_cloud_store_transfer.tct_prod_central_id where "
              . "tct_to_branch='".$_SESSION['firebase_id']."' and tct_trn_no='".$_REQUEST['cnt_id']."' "
              . "group by tct_prod_central_id,tct_product order by tct_prod_central_id desc"); 
       
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
		    while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
			{
                                   $row2[]=$result_fnctvenue;
     
                  }}
          
          echo json_encode($row2);
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_central_transfer_load_local'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
     $row2=array();
    
      $sql_gen =  mysqli_query($localhost1,"select * from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_central_id=tbl_central_kitchen_transfer.tct_central_menu_id where tct_to_branch='".$_SESSION['firebase_id']."' and tct_central_id='".$_REQUEST['cnt_id']."' group by tct_central_id,tct_product order by tct_id desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
			{
      $row2[]=$result_fnctvenue;
     
                  }}
          
          echo json_encode($row2);
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_central_id_menu_transfer'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
    
    $live_menu='';
    
    ///live////
    $sql_gen =  mysqli_query($localhost1,"select tct_prod_central_id,mr_menuname from tbl_cloud_store_transfer"
            . " left join tbl_menumaster on tbl_menumaster.mr_central_id=tbl_cloud_store_transfer.tct_prod_central_id "
            . " where tct_to_branch='".$_SESSION['firebase_id']."' and tct_trn_no='".$_REQUEST['cnt_id']."' "
            . " group by tct_prod_central_id,tct_product order by tct_prod_central_id desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
		  {
                      $live_menu.=$result_fnctvenue['mr_menuname']; 
                      
          ///local////                                
          $sql_login  =  $database->mysqlQuery("select mr_central_id from tbl_menumaster where "
          . " mr_central_id='".$result_fnctvenue['tct_prod_central_id']."'  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
              
                     
                  }else{
                      echo $live_menu.' , ';
                  }    
                      
                      
              
		 
     
          }}
        
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_central_id_menu_accept'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
    
    $live_menu='';
    
    ///live////
    $sql_gen =  mysqli_query($localhost1,"select mr_central_id,mr_menuid,mr_menuname from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_central_id=tbl_central_kitchen_transfer.tct_central_menu_id where tct_to_branch='".$_SESSION['firebase_id']."' and tct_central_id='".$_REQUEST['cnt_id']."' group by tct_central_id,tct_product order by tct_id desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
		  {
                      $live_menu.=$result_fnctvenue['mr_menuname']; 
                      
    ///local////                                
    $sql_login  =  $database->mysqlQuery("select mr_central_id from tbl_menumaster where  mr_central_id='".$result_fnctvenue['mr_central_id']."'  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
              
                     
                  }else{
                      echo $live_menu.' , ';
                  }    
                      
                      
              
		 
     
          }}
        
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_qty_weight_central_accept'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
    
     $date_cnt=date('Y-m-d H:i:s');
      $sql_gen =  mysqli_query($localhost1,"update tbl_central_kitchen_transfer set tct_edited_by='".$_SESSION['expodine_id']."' ,tct_edited_stage='Editing',tct_edited_time='$date_cnt', tct_edit_value='".$_REQUEST['edit_qty']."' where tct_local_branch='".$_REQUEST['main_branch']."' and  tct_to_branch='".$_REQUEST['local_branch']."' and tct_id='".$_REQUEST['cnt_id']."' "); 
       
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_transfer'){
   
         $row2=array();
         $inv_req='';
         $tot=0;
         
         
       if($_REQUEST['unit_type']=='Single' || $_REQUEST['unit_type']=='Nos'){
     
         $bal_batch=$_REQUEST['qty'];
         
         }else{
                  
                  
       if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){   
        
            $bal_batch=$_REQUEST['qty'];
           
        }else{
          
            $bal_batch=$_REQUEST['weight'];
            
          }
           
           
          }
         
         
  if($_REQUEST['bal_batch_stock']>0 && $_REQUEST['batch_id']!=''){
          
      
      
    $date_bt=date('Y-m-d');           
 $sql_login_batch  =  $database->mysqlQuery("INSERT INTO `tbl_batch_stock`(`tbs_menu`, `tbs_added`, `tbs_stock_set`, `tbs_batch_id`, `tbs_date`,tbs_ip)"
    . " VALUES ('".$_REQUEST['product_id']."','$bal_batch','N','".$_REQUEST['batch_id']."','$date_bt','$localIP') "); 
             
 }
         
         
         
         
          $sql_login  =  $database->mysqlQuery("select ti_transfer_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{  
                      $inv_req=$result_login['ti_transfer_id'];
                }
                }
                  
                  
          $req_id='Trn_'.$inv_req;  
          
          
          $req_id=  rand(100, 999999);  
         
          $insertion['tt_trn_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
         
          $insertion['tt_dayclosedate']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
          $insertion['tt_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tt_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
          $insertion['tt_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
          if($_REQUEST['barcode']!=''){
              
             $insertion['tt_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
          }
         
          $insertion['tt_unit_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        
          if($_REQUEST['qty']>0){
              
               $insertion['tt_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        
          }
        
          
         if($_REQUEST['batch_id']!=''){
              
             $insertion['tt_batch_id']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['batch_id']));
        
         }
          
        
         if($_REQUEST['brand']!=''){
             
             $insertion['tt_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
         }
        
         if($_REQUEST['weight']>0){
             $insertion['tt_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
         }
         
         if($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='Single' ){
      
            $insertion['tt_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']*$_REQUEST['rate']));
         
            $tot=($_REQUEST['qty']*$_REQUEST['rate']);
         }
         else{
            
         if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
                  
            $insertion['tt_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']*$_REQUEST['rate']));  
           
            $tot=($_REQUEST['qty']*$_REQUEST['rate']);
            
          }else{
                  
                   $insertion['tt_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']*$_REQUEST['rate']));  
                   
                   $tot=($_REQUEST['weight']*$_REQUEST['rate']);
          }
            
        }
        
           $insertion['tt_from_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_store']));
          
           $insertion['tt_to_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['to_store']));
           
           
          if($_REQUEST['current_stock']!=''){
               
             $insertion['tt_current_stock']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['current_stock']));
          }
           
          if($_REQUEST['reorder']!=''){
              
           $insertion['tt_reorder']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reorder']));
          }
          
          
          $insertion['tt_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate']));
          
          $insertion['tt_ip']= mysqli_real_escape_string($database->DatabaseLink,trim($localIP));
          
          $fnct_menu = $database->mysqlQuery("select ts_tax,ts_tx_amount from tbl_store_stock where ts_product='".$_REQUEST['product_id']."' and ts_store='".$_REQUEST['from_store']."' ");
          $num_fdtl = $database->mysqlNumRows($fnct_menu);
          if ($num_fdtl > 0) {
              while ($result_fnctvenue7 = $database->mysqlFetchArray($fnct_menu))
              {
                  
                if($result_fnctvenue7['ts_tax']>0 && $result_fnctvenue7['ts_tax']!=''){
                      
                        $insertion['tt_tax']= mysqli_real_escape_string($database->DatabaseLink,trim($result_fnctvenue7['ts_tax']));
                      
                        $tot_tax=($tot/(100+$result_fnctvenue7['ts_tax']))*$result_fnctvenue7['ts_tax'];
                      
                        $insertion['tt_tax_value']= mysqli_real_escape_string($database->DatabaseLink,trim($tot_tax));
                }
                        
            }
        }
          
        if($_REQUEST['indent_id']!='' && $_REQUEST['indent_id']!='undefined' && $_REQUEST['indent_id']!='null' && $_REQUEST['indent_id']!=' '){
           
              $insertion['tt_indent']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['indent_id'])); 
            
        } 
        
	
       $sql=$database->check_duplicate_entry('tbl_store_transfer',$insertion);
       if($sql!=1)
	{
        
	   $insertid              =  $database->insert('tbl_store_transfer',$insertion);   
        
      
        if($_REQUEST['direct_id']=='' && $_REQUEST['indent_id']=='' ){
           
        $fnct_menu = $database->mysqlQuery("select * from tbl_store_transfer where tt_set='N' and tt_ip='$localIP' group by tt_trn_id,tt_product order by tt_id desc ");
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
   
   
   if($_REQUEST['indent_id']!='' && $_REQUEST['indent_id']!='undefined' && $_REQUEST['indent_id']!='null' && $_REQUEST['indent_id']!=' '){
       
    $date=date('Y-m-d H:i:s');
    
    $fnct_menu = $database->mysqlQuery("INSERT INTO `tbl_indent_partial`(`tip_req_id`, `tip_transfer_id`, `tip_qty_weight`, `tip_date`, `tip_menuid`,
    `tip_done`) VALUES ('".$_REQUEST['indent_id']."','0','".$_REQUEST['partial']."','$date','".$_REQUEST['product_id']."','N')");
    
       
   }
   
   
   

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_transfer_load'){
    
     $row2=array();
    
     $fnct_menu = $database->mysqlQuery("select * from tbl_store_transfer where tt_set='N' and tt_ip='$localIP'"
     . " group by tt_trn_id,tt_product  order by tt_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='transfer_indent_product'){
    
     
         $qty_wgt_partial_old=0;     
         $fnct_menu5 = $database->mysqlQuery("select sum(tip_qty_weight) as old_qty_wgt from tbl_indent_partial where tip_done='Y' and tip_req_id='".$_REQUEST['indent_id']."' and tip_menuid='".$_REQUEST['prd_id']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
         if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              {
                  
                  $qty_wgt_partial_old=$result_fnctvenue5['old_qty_wgt'];
              }
              }
              
              
        $qty_wgt_partial=0;     
        $fnct_menu5 = $database->mysqlQuery("select tip_qty_weight from tbl_indent_partial where tip_done='N' and tip_req_id='".$_REQUEST['indent_id']."' and tip_menuid='".$_REQUEST['prd_id']."' ");
        $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) {
              while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu5))
              {
                  
                  $qty_wgt_partial=$result_fnctvenue55['tip_qty_weight'];
              }
              }
              
             
    
     $stock='';  
     $fnct_menu = $database->mysqlQuery("select * from tbl_store_stock where ts_product='".$_REQUEST['prd_id']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_login = $database->mysqlFetchArray($fnct_menu))
              {
                  
           
                  
                                  if( $result_login['ts_rate_type']!='Single'){
                                 
                                 if($result_login['ts_unit']=='Nos'){
                                     
                                  $stock= $result_login['ts_qty'];
                                  
                                 }else{
                                     
                                     
                                     if( $result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')){ 
                                     $stock= $result_login['ts_qty'];
                                     }else{
                                        $stock= $result_login['ts_weight']; 
                                     }
                                     
                                 } 
                                 
                                 }else{
                                     
                                      $stock= $result_login['ts_qty'];
                                      
                                 }
                                 
                      echo     $result_login['ts_reorder'].'*'.$stock.'*'.$result_login['ts_unit_price'].'*'.$qty_wgt_partial.'*'.$qty_wgt_partial_old;      
                                 
                                 
                  }
        }else{
            echo     '0*0*0*'.$qty_wgt_partial.'*'.$qty_wgt_partial_old;     
        }
        
               
        
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='transfer_direct_product'){
    
     
     $stock='';
     $fnct_menu = $database->mysqlQuery("select * from tbl_store_stock where ts_product='".$_REQUEST['prd_id']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_login = $database->mysqlFetchArray($fnct_menu))
              {
                  
                                  if( $result_login['ts_rate_type']!='Single'){
                                 
                                 if($result_login['ts_unit']=='Nos'){
                                     
                                  $stock= $result_login['ts_qty'];
                                  
                                 }else{
                                     
                                     
                                     if( $result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')){ 
                                     $stock= $result_login['ts_qty'];
                                     }else{
                                        $stock= $result_login['ts_weight']; 
                                     }
                                     
                                 } 
                                 
                                 }else{
                                     
                                      $stock= $result_login['ts_qty'];
                                      
                                 }
                                 
                      echo     $result_login['ts_reorder'].'*'.$stock.'*'.$result_login['ts_unit_price'];      
                                 
                                 
                  }
        }else{
            echo     '0*0*0';     
        }
        
               
        
    
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_transfer_load_direct'){
    
     $row2=array();
    
     $fnct_menu = $database->mysqlQuery("select * from tbl_grn_order where tg_grn_id='".$_REQUEST['id']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_transfer_load_indent'){
    
     $row2=array();
    
     $fnct_menu = $database->mysqlQuery("select * from tbl_requisition where tr_req_id='".$_REQUEST['id']."' order by tr_name asc");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_transfer'){
    
    $fnct_menu = $database->mysqlQuery("select tt_product,tt_batch_id from tbl_store_transfer where tt_id='".$_REQUEST['id']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                   
         $fnct_menu_bl = $database->mysqlQuery("delete from tbl_batch_stock where tbs_menu='".$result_fnctvenue['tt_product']."' and tbs_batch_id='".$result_fnctvenue['tt_batch_id']."' and tbs_stock_set='N' ");   
         
        }
        }
    
        
     $fnct_menu = $database->mysqlQuery("delete from tbl_store_transfer where tt_id='".$_REQUEST['id']."' ");
     
     
        
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_transfer_central'){
    
   
    
     $fnct_menu = $database->mysqlQuery("delete from tbl_central_kitchen_transfer where tct_id='".$_REQUEST['id']."' ");
        
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_transfer_qty'){
    
    
    if($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='Single'){
    
      $fnct_menu = $database->mysqlQuery("update  tbl_store_transfer set tt_qty='".$_REQUEST['qty']."',tt_weight='".$_REQUEST['weight']."',tt_total=(tt_rate*tt_qty),tt_tax_value=((tt_total*tt_tax)/100)  where tt_id='".$_REQUEST['id']."' ");

   }else{
       
      if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
       $fnct_menu = $database->mysqlQuery("update  tbl_store_transfer set tt_qty='".$_REQUEST['qty']."',tt_weight='".$_REQUEST['weight']."',tt_total=(tt_rate*tt_qty),tt_tax_value=((tt_total*tt_tax)/100)   where tt_id='".$_REQUEST['id']."' ");
      }else{
            $fnct_menu = $database->mysqlQuery("update  tbl_store_transfer set tt_qty='".$_REQUEST['qty']."',tt_weight='".$_REQUEST['weight']."',tt_total=(tt_rate*tt_weight),tt_tax_value=((tt_total*tt_tax)/100)   where tt_id='".$_REQUEST['id']."' ");
     
      }
   }

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_transfer_qty_central'){
    
    
    if($_REQUEST['unit_type']=='Nos' || $_REQUEST['unit_type']=='Single'){
    
      $fnct_menu = $database->mysqlQuery("update  tbl_central_kitchen_transfer set tct_qty='".$_REQUEST['qty']."',tct_weight='".$_REQUEST['weight']."',tct_total=(tct_rate*tct_qty),tct_total_tax=((tct_total*tct_tax)/100),tct_final_total=(tct_total+tct_total_tax)  where tct_id='".$_REQUEST['id']."' ");

   }else{
       
      if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
       $fnct_menu = $database->mysqlQuery("update  tbl_central_kitchen_transfer set tct_qty='".$_REQUEST['qty']."',tct_weight='".$_REQUEST['weight']."',tct_total=(tct_rate*tct_qty),tct_total_tax=((tct_total*tct_tax)/100),tct_final_total=(tct_total+tct_total_tax)   where tct_id='".$_REQUEST['id']."' ");
      }else{
            $fnct_menu = $database->mysqlQuery("update  tbl_central_kitchen_transfer set tct_qty='".$_REQUEST['qty']."',tct_weight='".$_REQUEST['weight']."',tct_total=(tct_rate*tct_weight),tct_total_tax=((tct_total*tct_tax)/100),tct_final_total=(tct_total+tct_total_tax)   where tct_id='".$_REQUEST['id']."' ");
     
      }
   }

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='transfer_partial_check'){
    
    
        $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
       
         
        $sql_gen =  mysqli_query($localhost1," SELECT tr.tr_central_partial 
        FROM tbl_cloud_store_transfer tc left join tbl_requisition tr on tc.tct_intent_id=tr.tr_req_id 
        WHERE tr.tr_central_partial = 'Y' and tr.branchid='".$_SESSION['firebase_id']."'"
        . " and tc.tct_trn_no='".$_REQUEST['cnt_id']."' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
                      echo 'yes';
                      
                   }else{
                       
                      echo 'no';
                  }
        
        

}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_transfer_all_central_check'){
    
    
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
         
         
         $sql_gen =  mysqli_query($localhost1," SELECT table_schema 
        FROM information_schema.tables
         WHERE table_schema = DATABASE()
        AND (table_name = 'tbl_central_kitchen_transfer' or  table_name = 'tbl_cloud_store_transfer') "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen>0)
		  {
                      echo 'yes';
                  }else{
                      echo 'no';
                  }
    
        }else{
           echo 'no';  
        }
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_transfer_all_central'){
    
    
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
     
         
              $fnct_menu = $database->mysqlQuery("select * from  tbl_central_kitchen_transfer where tct_set='N' group by tct_central_id,tct_product ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
       $sql_gen1 =  mysqli_query($localhost1,"INSERT INTO `tbl_central_kitchen_transfer`(`branchid`,tct_id, `tct_central_id`, `tct_product`, "
        . "`tct_rate_type`, `tct_unit_type`, `tct_qty`, `tct_weight`, `tct_rate`, `tct_total`, `tct_tax`, `tct_total_tax`, "
        . "`tct_final_total`, `tct_date`, `tct_login`, `tct_local_branch`, `tct_local_store`, `tct_to_branch`, `tct_to_store`, "
        . "`tct_set`, `cloud_sync`, `tct_barcode`, `tct_brand`, `tct_current_stock`, `tct_type`, `tct_mode`,tct_central_menu_id , "
               . " tct_from_store_name, tct_to_store_name, tct_from_branch_name, tct_to_branch_name,tct_edit_value,tct_reject_update "
        . " ) VALUES ('".$result_fnctvenue['tct_local_branch']."','".$result_fnctvenue['tct_id']."','".$result_fnctvenue['tct_central_id']."',"
        . " '".$result_fnctvenue['tct_product']."','".$result_fnctvenue['tct_rate_type']."','".$result_fnctvenue['tct_unit_type']."','".$result_fnctvenue['tct_qty']."',"
        . "'".$result_fnctvenue['tct_weight']."','".$result_fnctvenue['tct_rate']."','".$result_fnctvenue['tct_total']."','".$result_fnctvenue['tct_tax']."',"
        . "'".$result_fnctvenue['tct_total_tax']."','".$result_fnctvenue['tct_final_total']."','".$result_fnctvenue['tct_date']."','".$result_fnctvenue['tct_login']."',"
        . "'".$result_fnctvenue['tct_local_branch']."','".$result_fnctvenue['tct_local_store']."',"
        . "'".$result_fnctvenue['tct_to_branch']."','".$result_fnctvenue['tct_to_store']."','".$result_fnctvenue['tct_set']."','".$result_fnctvenue['cloud_sync']."',"
        . "'".$result_fnctvenue['tct_barcode']."','".$result_fnctvenue['tct_brand']."','".$result_fnctvenue['tct_current_stock']."',"
        . "'".$result_fnctvenue['tct_type']."','".$result_fnctvenue['tct_mode']."','".$result_fnctvenue['tct_central_menu_id']."','".$_REQUEST['local_store_name']."','".$_REQUEST['to_store_name']."','".$_REQUEST['local_branch_name']."','".$_REQUEST['to_branch_name']."','0','N')"); 
       
             ///stock_reduction_central////
       
        if($result_fnctvenue['tct_unit_type']=='Single' || $result_fnctvenue['tct_unit_type']=='Nos'){
     
         $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tct_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."'  ");
          
         }else{
                  
                  
       if($result_fnctvenue['tct_rate_type']=='Packet' && ($result_fnctvenue['tct_unit_type']=='KG' || $result_fnctvenue['tct_unit_type']=='LTR')){   
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tct_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."' ");           
           
        }else{
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue['tct_weight']."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."' ");           
            
          }
           
           
          }
       
       
              }
              }     
              
                    
     $fnct_menu = $database->mysqlQuery("update tbl_central_kitchen_transfer set tct_set='Y'  where tct_set='N'  ");
     
     
     
     
    $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_central_id=(ti_central_id+1) ");
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_transfer_all_central_accept_live'){
    
    
          $sql_login  =  $database->mysqlQuery("select ti_central_id from tbl_inv_settings limit 1  "); 
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
	  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	  { 
                      
                $inv_req=$result_login['ti_central_id'];
            }
            }
                  
                  
         $req_id='Cnt_'.$inv_req;  
    
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
         $req_id_in='';
         
         $tx_val=0; $tx_tot=0;
         $sql_gen =  mysqli_query($localhost1,"select * from  tbl_cloud_store_transfer where tct_trn_no='".$_REQUEST['cnt_id']."' "
         . " and  tct_to_branch='".$_REQUEST['branch']."'  "); 
       
	$num_gen  = mysqli_num_rows($sql_gen);
	if($num_gen)
	{
	while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
	{
                  
        $req_id_in=     $result_fnctvenue['tct_intent_id'];            
               
        if($result_fnctvenue['tct_tax_rate']>0){
           $tx_tot= $result_fnctvenue['tct_tax_rate'];
        }
        
        if($result_fnctvenue['tct_tax_value']>0){
           $tx_val= $result_fnctvenue['tct_tax_value'];
        }
        
        
        $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_central_kitchen_transfer`(tct_central_id,`tct_product`, "
        . "`tct_rate_type`, `tct_unit_type`, `tct_qty`, `tct_weight`, `tct_rate`, `tct_total`, `tct_tax`, `tct_total_tax`, "
        . "`tct_final_total`, `tct_date`, `tct_login`, `tct_local_branch`, `tct_local_store`, `tct_to_branch`, `tct_to_store`, "
        . "`tct_set`, `cloud_sync`, `tct_barcode`, `tct_brand`, `tct_current_stock`, `tct_type`, `tct_mode`,tc_receieved_id ,"
        . "tct_central_menu_id,tct_edit_value,tct_live_id,tct_live_or_local,tct_option "
        . " ) VALUES ('".$req_id."',"
        . " '".$result_fnctvenue['tct_product']."','".$result_fnctvenue['tct_rate_type']."','".$result_fnctvenue['tct_unit_type']."','".$result_fnctvenue['tct_quantity']."',"
        . "'".$result_fnctvenue['tct_weight']."','".$result_fnctvenue['tct_unit_rate']."','".$result_fnctvenue['tct_total_rate']."','".$tx_val."',"
        . "'".$tx_tot."','".$result_fnctvenue['tct_total_rate']."','".$result_fnctvenue['tct_created_date']."','".$result_fnctvenue['tct_created']."',"
        . "'".$result_fnctvenue['tct_from_branch']."','".$result_fnctvenue['tct_from_store']."',"
        . "'".$result_fnctvenue['tct_to_branch']."','".$result_fnctvenue['tct_to_store']."','Y','N',"
        . "'".$result_fnctvenue['tct_barcode']."','".$result_fnctvenue['tct_brand']."','0',"
        . "'Cloud','Accept','".$_SESSION['expodine_id']."','".$result_fnctvenue['tct_prod_central_id']."','0','".$result_fnctvenue['tct_trn_no']."','Live','".$result_fnctvenue['tct_partial_option']."')"); 
       
      
       ///stock_update_central////
       $tot_edit_val=0;
        $menu_central='';
        $fnct_menu67 = $database->mysqlQuery("select mr_menuid from tbl_menumaster where mr_central_id='".$result_fnctvenue['tct_prod_central_id']."'  ");
         $num_fdtl67 = $database->mysqlNumRows($fnct_menu67);
        if ($num_fdtl67){
              while ($result_fnctvenue67 = $database->mysqlFetchArray($fnct_menu67))
              {
                  
                  $menu_central=$result_fnctvenue67['mr_menuid'];
              }
              }
       
       
               
        $fnct_menu675 = $database->mysqlQuery("select ts_product from tbl_store_stock where ts_product='".$menu_central."' and ts_store='".$result_fnctvenue['tct_to_store']."'  ");
         $num_fdtl675 = $database->mysqlNumRows($fnct_menu675);
        if ($num_fdtl675){
              //update stock
       
            
            
          //  $tot_edit_val=($result_fnctvenue['tct_edit_value']*$result_fnctvenue['tct_rate']);
            
            
        if($result_fnctvenue['tct_unit_type']=='Single' || $result_fnctvenue['tct_unit_type']=='Nos'){
     
         $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue['tct_quantity']."') , ts_total=(ts_total+'".$result_fnctvenue['tct_total_rate']."'),ts_unit_price=(ts_total/ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$menu_central."' and ts_store='".$result_fnctvenue['tct_to_store']."'  ");
          
         }else{
                  
                  
       if($result_fnctvenue['tct_rate_type']=='Packet' && ($result_fnctvenue['tct_unit_type']=='KG' || $result_fnctvenue['tct_unit_type']=='LTR')){   
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".($result_fnctvenue['tct_qty'])."'),ts_total=(ts_total+'".($result_fnctvenue['tct_total_rate'])."') ,ts_unit_price=(ts_total/ts_qty),ts_average= (ts_total/ts_qty) where ts_product='".$menu_central."' and ts_store='".$result_fnctvenue['tct_to_store']."' ");           
           
        }else{
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".($result_fnctvenue['tct_weight'])."'),ts_total=(ts_total+'".($result_fnctvenue['tct_total_rate'])."') ,ts_unit_price=(ts_total/ts_weight),ts_average= (ts_total/ts_weight) where ts_product='".$menu_central."' and ts_store='".$result_fnctvenue['tct_to_store']."' ");           
            }
           
           
          }
          
        }else{
            
            //insert stock on accept///
            $date1=date('Y-m-d H:i:s');
            
            if( ($result_fnctvenue['tct_unit_type']=='Nos' || $result_fnctvenue['tct_unit_type']=='Single') || ($result_fnctvenue['tct_rate_type']=='Packet'  && ($result_fnctvenue['tct_unit_type']=='KG' || $result_fnctvenue['tct_unit_type']=='LTR'))){
                            
                        
                      $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                       . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`,ts_stock_update_date,ts_unit_price) "
                       . "  VALUES ('".$result_fnctvenue['tct_to_store']."','".$menu_central."','".$result_fnctvenue['tct_barcode']."','".($result_fnctvenue['tct_quantity'])."',"
                       . " '1','".$result_fnctvenue['tct_unit_type']."','".$result_fnctvenue['tct_rate_type']."',"
                       . " '".$result_fnctvenue['tct_unit_rate']."', ('".$result_fnctvenue['tct_unit_rate']."' * ('".$result_fnctvenue['tct_quantity']."')), "
                       . " '".$date1."','".$result_fnctvenue['tct_unit_rate']."') " );   
                  
                     
                      
            }else{
                            
                            
                            
                       $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                       . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`,ts_stock_update_date,ts_unit_price) "
                         
                       . " VALUES ('".$result_fnctvenue['tct_to_store']."','".$menu_central."','".$result_fnctvenue['tct_barcode']."','1',"
                       . " '".($result_fnctvenue['tct_weight'])."','".$result_fnctvenue['tct_unit_type']."','".$result_fnctvenue['tct_rate_type']."',"
                       . " '".$result_fnctvenue['tct_unit_rate']."',('".$result_fnctvenue['tct_unit_rate']."' * ('".$result_fnctvenue['tct_weight']."')), "
                         . " '".$date1."','".$result_fnctvenue['tct_unit_rate']."') " );   
                       
                      
           }
            
           }
       
       
          /////recipee update///
          
          $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$menu_central."' and ts_store='".$result_fnctvenue['tct_to_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$menu_central."' and tmi_store='".$result_fnctvenue['tct_to_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$menu_central."' and tmi_store='".$result_fnctvenue['tct_to_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$menu_central."' and tmi_store='".$result_fnctvenue['tct_to_store']."'  ");                        
                    
                      }
                     
                 }
  
  
          }}
          
          
          //recipe end///
          
          
          // Food Cost update transfer ///  
          
         $ing_rate_changed='';     $main_menu=array();   $main_store=array();
         $date88=date('Y-m-d H:i:s');        
         $sql_login88  =  $database->mysqlQuery("select tmi_store,tmi_menuid,tmi_ing_rate,tmi_ing_menuid from tbl_menu_ingredient_detail where tmi_ing_menuid='".$menu_central."' and tmi_store='".$result_fnctvenue['tct_to_store']."' group by tmi_menuid  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                       
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                    //update////
                      $ing_rate_changed='Y';
                  }
                  
                  
                   }}
                      
                      $main_menu[]=$result_login881['tmi_menuid'];
                      $main_store[]=$result_login881['tmi_store'];
                      
                  }
                  }
                  
                  
         for($i=0;$i<=count($main_menu);$i++){
                   
         $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'    "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."'  ) "); 
                 
                  }
                  
                       }}
              
                  }
                 
                 ///end food cost///
          
          
              } 
              }     
                  
              
              
     $date_rec=date('Y-m-d H:i:s');         
     $sql_gen1 =  mysqli_query($localhost1,"update tbl_cloud_store_transfer set tct_local_accepted='Y',tct_local_accepted_date='$date_rec' where tct_trn_no='".$_REQUEST['cnt_id']."' and  tct_to_branch='".$_REQUEST['branch']."'  ");
            
     $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_central_id=(ti_central_id+1) ");     
          
     
     if($_REQUEST['option']!='cancel'){
         
         $opt=$_REQUEST['option'];
         $stf=$_SESSION['expodine_id'];
         
         
         $remark=" $opt by $stf at $date_rec ";
         
         
         
       $sql_gen1 =  mysqli_query($localhost1,"update tbl_requisition set tr_partial_option='".$_REQUEST['option']."' "
       . " where tr_req_id='$req_id_in' and  branchid='".$_REQUEST['branch']."'  ");
       
       
        
          $sql_gen11 =  mysqli_query($localhost1,"update tbl_cloud_store_transfer set tct_partial_option='".$_REQUEST['option']."' , "
         . " tct_option_remarks='$remark'  where tct_trn_no='".$_REQUEST['cnt_id']."' and  tct_to_branch='".$_REQUEST['branch']."'  ");
        
       
     }
    
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='reject_central_data'){
    
     $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
    
    $date_rec=date('Y-m-d H:i:s');   
    
     $sql_gen1 =  mysqli_query($localhost1,"update tbl_central_kitchen_transfer set  tct_received='N', "
    . " tct_cancel_time='$date_rec',tc_cancel_login='".$_SESSION['expodine_id']."',tct_status_live='Cancelled',"
    . " tct_reject_reason='".$_REQUEST['reason_reject']."' where tct_central_id='".$_REQUEST['cnt_id']."' and tct_to_branch='".$_REQUEST['branch']."' ");
       
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='cancel_partial'){
    
     $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
    
     $sql_gen =  mysqli_query($localhost1,"select tct_intent_id from  tbl_cloud_store_transfer where tct_trn_no='".$_REQUEST['cnt_id']."' "
         . " and  tct_to_branch='".$_REQUEST['branch']."'  "); 
       
	$num_gen  = mysqli_num_rows($sql_gen);
	if($num_gen)
	{
	while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
	{
                  
        $req_id_in=     $result_fnctvenue['tct_intent_id'];            
               
        }}
     
     
     
     
    if($_REQUEST['option']!=''){
         
      
         $date_rec=date('Y-m-d H:i:s');  
         
         $opt=$_REQUEST['option'];
         $stf=$_SESSION['expodine_id'];
         
        $remark=" cancel by $stf at $date_rec "; 
        
       $sql_gen1 =  mysqli_query($localhost1,"update tbl_requisition set tr_partial_option='cancel' "
       . " where tr_req_id='$req_id_in' and  branchid='".$_REQUEST['branch']."'  ");
        
        $sql_gen11 =  mysqli_query($localhost1,"update tbl_cloud_store_transfer set tct_partial_option='cancel' , "
        . "  tct_option_remarks='$remark' where tct_trn_no='".$_REQUEST['cnt_id']."' and  tct_to_branch='".$_REQUEST['branch']."'  ");
        
       
       
       
     }
     
     
     
     
}



if(isset($_REQUEST['set']) && $_REQUEST['set']=='reject_central_transfer_data'){
    
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
    $date_rec=date('Y-m-d H:i:s');         
    
    $sql_gen1 =  mysqli_query($localhost1,"update tbl_cloud_store_transfer set  tct_rejected='Y', "
    . " tct_cancel_time='$date_rec',tc_cancel_login='".$_SESSION['expodine_id']."',tct_reject_reason='".$_REQUEST['reason_reject']."' "
    . " where tct_trn_no='".$_REQUEST['cnt_id']."' and  tct_to_branch='".$_REQUEST['branch']."'  ");
       
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_transfer_all'){
    
    
     //direct id/////
     if($_REQUEST['direct_id']!='' && $_REQUEST['direct_id']!='undefined' && $_REQUEST['direct_id']!='null'){
         
     $fnct_menu = $database->mysqlQuery("update tbl_grn_order set tg_direct_transfer='Y' where tg_grn_id='".$_REQUEST['direct_id']."' ");
     
     $fnct_menu6699 = $database->mysqlQuery("update tbl_store_transfer set tt_direct_grn='".$_REQUEST['direct_id']."' where tt_set='N' "); 
      
     }
     
     //////batch update////
     
     $fnct_menu_bl = $database->mysqlQuery("update tbl_batch_stock set tbs_stock_set='Y'  where tbs_ip='$localIP'  ");   
         
     //// batch end ////
     
     
     
     
     
     ///indent setup///
     
     if($_REQUEST['indent_id']!='' && $_REQUEST['indent_id']!='undefined' && $_REQUEST['indent_id']!='null'){
         
        $transer_id_req=0; 
        $fnct_menu67 = $database->mysqlQuery("select tt_trn_id from tbl_store_transfer where tt_indent='".$_REQUEST['indent_id']."' and tt_set='N' ");
        $num_fdtl67 = $database->mysqlNumRows($fnct_menu67);
        if ($num_fdtl67){
              while ($result_fnctvenue67 = $database->mysqlFetchArray($fnct_menu67))
              {
                  
                  $transer_id_req=$result_fnctvenue67['tt_trn_id'];
              }
              }
         
         
        $fnct_menu66 = $database->mysqlQuery("update tbl_store_transfer set tt_indent='".$_REQUEST['indent_id']."' where tt_set='N' "); 
        
        $fnct_menu667 = $database->mysqlQuery("update tbl_indent_partial set tip_done='Y',tip_transfer_id='$transer_id_req' where tip_req_id='".$_REQUEST['indent_id']."' and tip_done='N' "); 
        
        
        if($_REQUEST['indent_tot_qty']==0 || $_REQUEST['indent_tot_weight']==0){
            
             $fnct_menu50 = $database->mysqlQuery("update tbl_requisition set tr_indent_done='Y' where tr_req_id='".$_REQUEST['indent_id']."' "); 
            
        }
        
        
     }
     
     
       if($_REQUEST['indent_id']=='' &&  $_REQUEST['direct_id']==''){ 
           
          $fnct_menu66 = $database->mysqlQuery("update tbl_store_transfer set tt_normal='Y' where tt_set='N' ");  
           
       }
       
       
    $noraml='N';
     
     
   if($_REQUEST['indent_id']=='' &&  $_REQUEST['direct_id']=='' && $normal=='Y'){ 
    
       $date1=date('Y-m-d');
       $tot_with_tax=0;  $tot_with_tax=0;  $tot_new=0; $first_weight=0;
    
        $fnct_menu = $database->mysqlQuery("select * from tbl_store_transfer where tt_set='N' group by tt_trn_id,tt_product ");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
          while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
          {
                  
                  
                  
         $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
          if ($num_fdtl55) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu55))
              {
                   $first_weight=$result_fnctvenue55['ts_weight'];
                   
                   if($result_fnctvenue55['ts_expiry']!=''){
        
                          $expiry="'".$result_fnctvenue55['ts_expiry']."'";
        
                              }else{
                          $expiry='NULL';
                    }
                               
                               
                   if($result_fnctvenue55['ts_last_grn']!=''){
                        
                     $grn="'".$result_fnctvenue55['ts_last_grn']."'";
        
                  }else{
                      
                      $grn='NULL';
                  }
                               
               }
               }
                  
                   
                 
          
         $fnct_menu5 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_to_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu5))
              {
                 
                if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
                       
                     $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_weight='1', ts_stock_update_date='".$date1."', ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'),ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                  
                     
                     if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty)  "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
              
                     }else{
                     
                      if($result_fnctvenue['tt_rate_type']=='Packet' &&($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
                       
                        $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_stock_update_date='".$date1."', ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'), ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                       
                        
                         if($result_fnctvenue['tt_tax']>0){
                             
                    $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                    $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                        
                        
                      }else{
                         
                          $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty='1',ts_stock_update_date='".$date1."', ts_weight=(ts_weight+'".$result_fnctvenue['tt_weight']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."') , ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                         
                          
                           if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                          
                          
                     }
                          
                 }
                 
                 
                  if($result_fnctvenue55['ts_tax']>0) {
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*ts_tax)/100) "
                      . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");  
                   }
                    
         }
        
        }else{
           
              $fnct_menu56 = $database->mysqlQuery("select * from tbl_store_transfer where tt_from_store='".$result_fnctvenue['tt_from_store']."' and tt_product='".$result_fnctvenue['tt_product']."' ");
              $num_fdtl56 = $database->mysqlNumRows($fnct_menu56);
              if ($num_fdtl56) {   
                while ($result_fnctvenue556 = $database->mysqlFetchArray($fnct_menu56))
                {
                  if($result_fnctvenue556['tt_unit_type']=='Single' || $result_fnctvenue556['tt_unit_type']=='Nos'){
                      
                      $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                      
                  }else{
                      
                      
                       if($result_fnctvenue556['tt_rate_type']=='Packet' &&($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR')){
                      
                       $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                       
                       }else{
                           $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_weight']);
                           
                       }
                       
                  }
                   
          
                  
                  $tot_new=($result_fnctvenue556['tt_total']);
                   
                   if($result_fnctvenue['tt_tax']>0) {
                  
                       if( ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') ||  ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                       
                    $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                       }else{
                           
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                           
                       }
                       
                       
                       
                    
                    }else{
                       
                        if(  ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') || ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                            
                        
                      $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                        }else{
                            
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                       
                            
                        }
                        
                   }
                 
                 
                  }}
         
            
        }
        
        
  if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
      
     $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty) "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
     
     
     
      $fnct_menu5 = $database->mysqlQuery("select ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                     $tot_with_tax1=0;
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
       
                     if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                         }
                    
                    
                    }}
     
     }else{
         
         
       if( $result_fnctvenue['tt_rate_type']=='Packet' && ($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
           
      
      $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty)  "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
       }else{
           
            $update_from = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue['tt_weight']."'), ts_total=(ts_unit_price*ts_weight)  "
        . " ,ts_average=(ts_total/ts_weight) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
        
       }
      
      
      
     $fnct_menu5 = $database->mysqlQuery("select ts_rate_type,ts_unit,ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  $tot_with_tax1=0;
      //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                  
                  if( $result_fnctvenue78['ts_rate_type']=='Packet' && ($result_fnctvenue78['ts_unit']=='KG' || $result_fnctvenue78['ts_unit']=='LTR')){
                      
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                  }else{
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                 
                  }
        
                   if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                    }
                    
                    
                    
              }}
                    
                     
  }
  
  
  $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$result_fnctvenue['tt_product']."' and ts_store='".$result_fnctvenue['tt_to_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                    
                      }
                     
                 }
  
  
          }}
  
  
    //recipe Food Cost update transfer ///  
           $ing_rate_changed='';     $main_menu=array();   $main_store=array();
           $date88=date('Y-m-d H:i:s');        
         $sql_login88  =  $database->mysqlQuery("select tmi_store,tmi_menuid,tmi_ing_rate,tmi_ing_menuid from tbl_menu_ingredient_detail where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."' group by tmi_menuid  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                       
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                    //update////
                      $ing_rate_changed='Y';
                  }
                  
                  
                   }}
                      
                      $main_menu[]=$result_login881['tmi_menuid'];
                      $main_store[]=$result_login881['tmi_store'];
                      
                  }
                  }
                  
                  
          }
        } 
                  
                  for($i=0;$i<=count($main_menu);$i++){
                   
                       $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'    "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."'  ) "); 
                 
                  }
                  
                       }}
              
                  }
                 
                 ///end food cost///
  
     }
     
     
     
      $sql_login  =  $database->mysqlQuery("select ti_transfer_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{ 
                      
                      $inv_req=$result_login['ti_transfer_id'];
                }
                }
                  
                  
      $req_id='Trn_'.$inv_req;  
     
      $date=date('Y-m-d H:i:s');
      
      $fnct_menu = $database->mysqlQuery("update  tbl_store_transfer set tt_trn_id='$req_id', tt_set='Y',tt_from_store='".$_REQUEST['from_store']."', "
      . " tt_to_store='".$_REQUEST['to_store']."',tt_transfer_login='".$_SESSION['expodine_id']."',tt_transfer_date='$date' where  tt_set='N' and tt_ip='$localIP' ");
      
      $fnct_menu1 = $database->mysqlQuery("update  tbl_inv_settings set ti_transfer_id=(ti_transfer_id+1) ");
      
      $fnct_menu77 = $database->mysqlQuery("delete from tbl_store_transfer  where tt_set='N' and tt_ip='$localIP' ");
      
      
      if($_REQUEST['direct_id']!='' && $_REQUEST['direct_id']!=' ' && $_REQUEST['direct_id']!='undefined'){
           
        $fnct_menu77 = $database->mysqlQuery("update tbl_store_transfer set tt_set='Y' where tt_set='N' ");
     
      }
        
      
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer'){
        
    
    ?>

     <table class="table table-bordered table-striped">
     <thead>
     <tr> <th scope="col">Sl </th>
     <th scope="col">Actions </th>
     
     <th scope="col">Trn Id</th>
     <th scope="col">Date</th>
      <th scope="col">Type</th>
      <th scope="col">Indent Id</th>
      <th scope="col">Direct Id</th>
      <th scope="col">From Store</th>
      <th scope="col">To Store</th>
      <th scope="col">Status</th>
      <th scope="col">Staff</th>
      <th scope="col">Ip</th>
       <th scope="col">Total </th>
      

    </tr>
   </thead>
   <tbody>
       
  <?php
    
    
    
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }


    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
     
    if($_REQUEST['staff']!=''){
    $string2.=" and tt_transfer_login = '".$_REQUEST['staff']."'   ";
    }
    
     if($_REQUEST['from']!=''){
       $string2.=" and tt_from_store = '".$_REQUEST['from']."'   ";
    }
    
       if($_REQUEST['to']!=''){
       $string2.=" and tt_to_store = '".$_REQUEST['to']."'   ";
    }
    
    
     if($_REQUEST['type_transfer']!=''){
        
    if($_REQUEST['type_transfer']=='normal'){     
        
    $string2.=" and tt_normal= 'Y'   ";
    
    }else if($_REQUEST['type_transfer']=='indent'){
        
        $string2.=" and tt_indent != ''   ";
        
    }else if($_REQUEST['type_transfer']=='direct'){
        
        $string2.=" and tt_direct_grn != ''   ";
    }
    
    
    }
    
    
       if($_REQUEST['tran_id']!=''){
          $string2.=" and tt_trn_id like '%".$_REQUEST['tran_id']."%'   ";
        }
    
    
     if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and tt_dayclosedate between '".$from."' and '".$to."' ";
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and tt_dayclosedate between '".$from."' and '".$to."' ";
                         
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and tt_dayclosedate between '".$from."' and '".$to."' ";
                              
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and tt_dayclosedate between '".$from."' and '".$to."' ";
                              
                        }
   
              
		$weight=0; $qty=0; $rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tt_total) as total ,sum(tt_tax_value) as total_tax from tbl_store_transfer  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_transfer.tt_product  where tt_set='Y' and  tt_product !='' $string2 group by tt_trn_id  order by tt_id desc limit ". $pagination.",10 "); 
 
                $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){ 
		while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
		{  
                                    
                 $i++;
                                                  
           ?>

                             <tr>
                           <td><?=$i?></td>
                           
                           <td>
                               
                               <?php if($_SESSION['ser_normal_transfer_accept']=='Y' && $result_kotlist['tt_normal_accept']=='N' &&  $result_kotlist['tt_normal']=='Y'  ){ ?>
                               <a title="Accept Normal Store Transfer" onclick="accept_transfer('<?=$result_kotlist['tt_trn_id']?>')" style="font-size: 15px;cursor: pointer;color: green;font-size: 18px" class="fa fa-check-square-o " href="#" > </a>
                           
                               &nbsp;&nbsp;
                               
                               <?php } ?>
                               
                               <a title="A4 Print" style="font-size: 15px;cursor: pointer;font-size: 18px" class="fa fa-print" href="a4_print.php?type=transfer_print&id=<?=$result_kotlist['tt_trn_id']?>" > </a>
                           
                              
                           </td>
                           
                           <td title="View Items" onclick="show_transfer('<?=$result_kotlist['tt_trn_id']?>')">
                               <strong style="border:solid 1px darkred;padding: 3px;cursor: pointer">
                                 <?=$result_kotlist['tt_trn_id']?> 
                                </strong>
                           </td>
                               
                           
                           <td><?=$result_kotlist['tt_dayclosedate']?></td>
                           
                          <?php if($result_kotlist['tt_normal']=='Y'  ){ ?>
                                  
                           <td>Normal</td>
                           
                       <?php }else if($result_kotlist['tt_indent']!=''){ ?>     
                           
                           <td>Indent</td>
                           
                         <?php }else if($result_kotlist['tt_direct_grn']!=''){ ?>       
                           
                            <td>Direct</td>
                       <?php } ?>  
                           
                           
                           
                           <td><?=$result_kotlist['tt_indent']?></td>
                           
                             <td><?=$result_kotlist['tt_direct_grn']?></td>
                           <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tt_from_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              ?>
                         
                          <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tt_to_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              ?> 
                         <?php if($result_kotlist['tt_normal_accept']=='Y'){ ?>       
                             
                       <?php if($result_kotlist['tt_normal_accept']=='Y' &&  $result_kotlist['tt_normal']=='Y'  ){ ?>
                                  
                           <td>Accepted</td>
                       <?php }else{ ?>     
                            <td>Pending</td>
                           <?php } ?>       
                           
                         <?php }else if($result_kotlist['tt_direct_grn']!='' ) { ?>   
                           
                       <?php if($result_kotlist['tt_direct_grn']!='' &&  $result_kotlist['tt_direct_accept']=='Y'  ){ ?>
                                  
                           <td>Accepted</td>
                       <?php }else{ ?>     
                            <td>Pending</td>
                           <?php } ?>            
                           
                           
                         <?php }else if($result_kotlist['tt_indent']!='' ) { ?>      
                            
                          <?php if($result_kotlist['tt_indent']!='' &&  $result_kotlist['tt_indent_accepted']=='Y'  ){ ?>
                                  
                           <td>Accepted</td>
                       <?php }else{ ?>     
                            <td>Pending</td>
                            
                           <?php } ?>      
                            
                     <?php }else{ ?>      
                          <td>Pending</td>  
                        <?php } ?>            
                            
                        
                           <td><?=$result_kotlist['tt_transfer_login']?></td>
                           <td><?=$result_kotlist['tt_ip']?></td>
                           <td style="display:none"><?=number_format($result_kotlist['total_tax'],$_SESSION['be_decimal']) ?></td>
                           <td><?=number_format($result_kotlist['total'],$_SESSION['be_decimal']) ?></td>
                   
                           
</tr>


<?php 
                                        }}

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_physical_default'){
     $row2=array();
     $insertion['tpf_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
      $insertion['tpf_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
      
      if($_REQUEST['brand']!=''){
       $insertion['tpf_brand']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
      }
      
      if($_REQUEST['barcode']!=''){
        $insertion['tpf_barcode']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
      }
      
      $insertion['tpf_qty']=  mysqli_real_escape_string($database->DatabaseLink,trim('1'));
      $insertion['tpf_weight']=  mysqli_real_escape_string($database->DatabaseLink,trim('1'));
      $insertion['tpf_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
      $insertion['tpf_unit_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
         $insertion['tpf_store']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
            
      $sql=$database->check_duplicate_entry('tbl_physical_default',$insertion);
       if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_physical_default',$insertion);   
        }
        
       $fnct_menu = $database->mysqlQuery("select * from tbl_physical_default where tpf_store='".$_REQUEST['store']."' group by tpf_product order by tpf_id desc  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_physical_list_by_default'){
    
     $sql_login  =  $database->mysqlQuery("delete from  tbl_physical_stock where tps_set='N' "); 
    
   
         $row2=array();
         
         $inv_req='';

         $sql_login1  =  $database->mysqlQuery("select ti_physical_id from tbl_inv_settings limit 1  "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
                      
                      $inv_req=$result_login1['ti_physical_id'];
                  }
                  }
         
         $req_id='Ph_'.$inv_req;
          
         
         
          $sql_login  =  $database->mysqlQuery("select *  from tbl_physical_default where tpf_store='".$_REQUEST['store']."' "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
         
      
             $unit_price=0;	
            $fnct_menu4 = $database->mysqlQuery("select ts_unit_price from tbl_store_stock where ts_product='".$result_login['tpf_product']."' and ts_store='".$_REQUEST['tpf_store']."' ");
         $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if($num_fdtl4 > 0){
              while ($result_fnctvenue4 = $database->mysqlFetchArray($fnct_menu4))
              {
                  
                  
                   $unit_price=$result_fnctvenue4['ts_unit_price'];  
          }
        }
            
            
        $insertion['tps_phy_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tps_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tps_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_name']));
         
          $insertion['tps_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_product']));
         
         $insertion['tps_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_rate_type']));
       
         if($result_login['tpf_barcode']!=''){
        $insertion['tps_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_barcode']));
         }
         
        $insertion['tps_unittype']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_unit_type']));
        
        if($result_login['tpf_qty']!=''){
        $insertion['tps_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_qty']));
        }
        
        if($result_login['tpf_brand']!=''){
        $insertion['tps_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_brand']));
        
        }
        
        if($result_login['tpf_weight']!=''){
        $insertion['tps_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_weight']));
        
        }
        
          $insertion['tps_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price));
          
        if($result_login['tpf_unit_type']=='Single' || $result_login['tpf_unit_type']=='Nos'){
         
         
          $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$result_login['tpf_qty']));
        
         }else{
             
             
               if($result_login['tpf_rate_type']=='Packet' && ($result_login['tpf_unit_type']=='KG' || $result_login['tpf_unit_type']=='LTR')){
                   
             $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$result_login['tpf_qty']));
             
               }else{
                   $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$result_login['tpf_weight'])); 
               }
             
         }
        
        $insertion['tps_store']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login['tpf_store']));
        
     $insertion['tps_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
     
        
    $sql=$database->check_duplicate_entry('tbl_physical_stock',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_physical_stock',$insertion);   
        }

   
          }}
          
         $fnct_menu = $database->mysqlQuery("select * from tbl_physical_stock where tps_set='N' group by tps_phy_id,tps_product order by tps_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);  
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_physical'){
   
         $row2=array();
         
         $inv_req='';
         
         
//         if($_REQUEST['edit_id']!='' ){
//             
//             $req_id=$_REQUEST['edit_id'];
//             
//            }else{
         $sql_login  =  $database->mysqlQuery("select ti_physical_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_physical_id'];
                  }
                  }
         
         $req_id='Ph_'.$inv_req;
           // }
       
             $unit_price=0;	
            $fnct_menu4 = $database->mysqlQuery("select ts_unit_price from tbl_store_stock where ts_product='".$_REQUEST['product_id']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if($num_fdtl4 > 0){
              while ($result_fnctvenue4 = $database->mysqlFetchArray($fnct_menu4))
              {
                  
                  
                   $unit_price=$result_fnctvenue4['ts_unit_price'];  
          }
        }
            
            
        $insertion['tps_phy_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tps_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tps_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tps_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tps_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
        $insertion['tps_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
        $insertion['tps_unittype']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        if($_REQUEST['qty']!=''){
        $insertion['tps_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        }
        
        if($_REQUEST['brand']!=''){
        $insertion['tps_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
        if($_REQUEST['weight']!=''){
        $insertion['tps_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
          $insertion['tps_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price));
          
        if($_REQUEST['unit_type']=='Single' || $_REQUEST['unit_type']=='Nos'){
         
         
          $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
        
         }else{
             
             
               if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
                   
             $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
             
               }else{
                   $insertion['tps_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['weight'])); 
               }
             
         }
        
        
        $insertion['tps_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
        
     $insertion['tps_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
     
        
    $sql=$database->check_duplicate_entry('tbl_physical_stock',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_physical_stock',$insertion);   
       
       
        $fnct_menu = $database->mysqlQuery("select * from tbl_physical_stock where tps_set='N' group by tps_phy_id,tps_product order by tps_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
   }

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_consumption'){
   
         $row2=array();
         
         $inv_req='';
         
         
//         if($_REQUEST['edit_id']!='' ){
//             
//             $req_id=$_REQUEST['edit_id'];
//             
//            }else{
         $sql_login  =  $database->mysqlQuery("select ti_consumption_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_consumption_id'];
                  }
                  }
         
         $req_id='Con_'.$inv_req;
         //   }
       					
            $unit_price=0;	
            $fnct_menu4 = $database->mysqlQuery("select ts_unit_price from tbl_store_stock where ts_product='".$_REQUEST['product_id']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if($num_fdtl4 > 0){
              while ($result_fnctvenue4 = $database->mysqlFetchArray($fnct_menu4))
              {
                  
                  
                   $unit_price=$result_fnctvenue4['ts_unit_price'];  
          }
        }
            
            
            

        $insertion['tc_con_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tc_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tc_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tc_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tc_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
        $insertion['tc_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
        $insertion['tc_unit_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        
         $insertion['tc_balance']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['balance']));
         
        
        if($_REQUEST['qty']!=''){
        $insertion['tc_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        }
        
        if($_REQUEST['brand']!=''){
        $insertion['tc_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
          if($_REQUEST['current_stock']!=''){
        $insertion['tc_current_stock']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['current_stock']));
        
        }
        
        
        if($_REQUEST['weight']!=''){
        $insertion['tc_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
         $insertion['tc_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price));
         
         
         if($_REQUEST['unit_type']=='Single' || $_REQUEST['unit_type']=='Nos'){
         
         
          $insertion['tc_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
        
         }else{
             
              if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
             $insertion['tc_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
             
              }else{
                $insertion['tc_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['weight'])); 
              }
         }
         
        
        $insertion['tc_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
        
     $insertion['tc_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
     
        
    $sql=$database->check_duplicate_entry('tbl_consumption',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_consumption',$insertion);   
       
       
        $fnct_menu = $database->mysqlQuery("select * from tbl_consumption where tc_set='N' group by tc_con_id,tc_product order by tc_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
   }

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_product_wastage'){
   
         $row2=array();
         
         $inv_req='';
         
         
//         if($_REQUEST['edit_id']!='' ){
//             
//             $req_id=$_REQUEST['edit_id'];
//             
//            }else{
         $sql_login  =  $database->mysqlQuery("select ti_wastage_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_wastage_id'];
                  }
                  }
         
         $req_id='Was_'.$inv_req;
            //}
       					
            $unit_price=0;	
            $fnct_menu4 = $database->mysqlQuery("select ts_unit_price from tbl_store_stock where ts_product='".$_REQUEST['product_id']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if($num_fdtl4 > 0){
              while ($result_fnctvenue4 = $database->mysqlFetchArray($fnct_menu4))
              {
                  
                  
                   $unit_price=$result_fnctvenue4['ts_unit_price'];  
          }
        }
            
            
            

        $insertion['tw_wastage_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($req_id));
        
          $insertion['tw_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tw_name']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tw_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product_id']));
         
         $insertion['tw_rate_type']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
       
         if($_REQUEST['barcode']!=''){
        $insertion['tw_barcode']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['barcode']));
         }
         
        $insertion['tw_unit_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
        
        if($_REQUEST['qty']!=''){
        $insertion['tw_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
        }
        
        if($_REQUEST['brand']!=''){
        $insertion['tw_brand']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['brand']));
        
        }
        
          if($_REQUEST['current_stock']!=''){
        $insertion['tw_current_stock']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['current_stock']));
        
        }
        
        
        if($_REQUEST['weight']!=''){
        $insertion['tw_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
        
        }
        
         $insertion['tw_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price));
         
         
         if($_REQUEST['unit_type']=='Single' || $_REQUEST['unit_type']=='Nos'){
         
         
          $insertion['tw_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
        
         }else{
             
             if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit_type']=='KG' || $_REQUEST['unit_type']=='LTR')){
             
             $insertion['tw_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['qty']));
             
             }else{
                 $insertion['tw_total']= mysqli_real_escape_string($database->DatabaseLink,trim($unit_price*$_REQUEST['weight']));
             }
         }
        
        $insertion['tw_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
        
       $insertion['tw_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
     
       $insertion['tw_reason']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reason']));
       
    $sql=$database->check_duplicate_entry('tbl_wastage',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_wastage',$insertion);   
       
       //echo $insertid;
            
        $fnct_menu = $database->mysqlQuery("select * from tbl_wastage where tw_set='N' group by tw_wastage_id,tw_product order by tw_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
               }
        }
        
               
          echo json_encode($row2);
   }

}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_wastsage_load'){
   
         $row2=array();
         
         $fnct_menu = $database->mysqlQuery("select * from tbl_wastage where tw_set='N' group by tw_wastage_id ,tw_product order by tw_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        } 
        
               
          echo json_encode($row2);
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_physical_load_default'){
   
         $row2=array();
         
         $fnct_menu = $database->mysqlQuery("select * from tbl_physical_default where tpf_store='".$_REQUEST['store']."' group by tpf_product order by tpf_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
                  
                   echo json_encode($row2);
        }else{
            echo 'nodata';
        } 
        
               
         
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_physical_load'){
   
         $row2=array();
         
         $fnct_menu = $database->mysqlQuery("select * from tbl_physical_stock where tps_set='N' group by tps_phy_id ,tps_product order by tps_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        } 
        
               
          echo json_encode($row2);
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_consum_load'){
   
         $row2=array();
         
         $fnct_menu = $database->mysqlQuery("select * from tbl_consumption where tc_set='N' group by tc_con_id,tc_product order by tc_id desc ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        } 
        
               
          echo json_encode($row2);
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_physical_default'){
   
         $fnct_menu = $database->mysqlQuery("delete from tbl_physical_default where tpf_id='".$_REQUEST['id']."'  ");
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_physical'){
   
         $fnct_menu = $database->mysqlQuery("delete from tbl_physical_stock where tps_id='".$_REQUEST['id']."'  ");
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_consum'){
   
         $fnct_menu = $database->mysqlQuery("delete from tbl_consumption where tc_id='".$_REQUEST['id']."'  ");
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='delete_wastage'){
   
         $fnct_menu = $database->mysqlQuery("delete from tbl_wastage where tw_id='".$_REQUEST['id']."'  ");
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_physical_all'){
   
    
         
         $fnct_menu = $database->mysqlQuery("update tbl_physical_stock set  tps_set='Y',tps_store='".$_REQUEST['store']."'  where tps_set='N'  ");
         
         
         $sql_login  =  $database->mysqlQuery("update tbl_inv_settings set ti_physical_id=(ti_physical_id+1)  ");  
         
            
         
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='approve_physiacl_stock_last'){
   
    $date_app=date('Y-m-d');
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_physical_stock where tps_phy_id='".$_REQUEST['id']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
                  
         $fnct_menu5 = $database->mysqlQuery("select ts_weight,ts_qty from tbl_store_stock where ts_product='".$result_fnctvenue5['tps_product']."' and ts_store='".$_REQUEST['store']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if($num_fdtl5 > 0){
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu5))
              {
              
     $fnct_menu1 = $database->mysqlQuery("update tbl_physical_stock set tps_approved_by='".$_SESSION['expodine_id']."',tps_approve_date='$date_app', tps_store_qty='".$result_fnctvenue['ts_qty']."', tps_store_weight='".$result_fnctvenue['ts_weight']."'  where tps_product='".$result_fnctvenue5['tps_product']."'  and tps_phy_id='".$_REQUEST['id']."' ");
       
     }}
     
     
     
       if($result_fnctvenue5['tps_unittype']=='Single' || $result_fnctvenue5['tps_unittype']=='Nos'){
     
       $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty='".$result_fnctvenue5['tps_qty']."' , ts_total=(ts_unit_price*'".$result_fnctvenue5['tps_qty']."'),ts_average= (ts_total/'".$result_fnctvenue5['tps_qty']."')  where ts_product='".$result_fnctvenue5['tps_product']."' and ts_store='".$_REQUEST['store']."'  ");
    
              }else{
                  
                  
            if( $result_fnctvenue5['tps_rate_type']=='Packet' && ($result_fnctvenue5['tps_unittype']=='KG' || $result_fnctvenue5['tps_unittype']=='LTR')){    
                
           $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty='".$result_fnctvenue5['tps_qty']."' , ts_weight='".$result_fnctvenue5['tps_weight']."',ts_total=(ts_unit_price*'".$result_fnctvenue5['tps_qty']."') ,ts_average= (ts_total/'".$result_fnctvenue5['tps_qty']."') where ts_product='".$result_fnctvenue5['tps_product']."' and ts_store='".$_REQUEST['store']."' ");           
            }else{
                
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight='".$result_fnctvenue5['tps_weight']."',ts_total=(ts_unit_price*'".$result_fnctvenue5['tps_weight']."') ,ts_average= (ts_total/'".$result_fnctvenue5['tps_weight']."') where ts_product='".$result_fnctvenue5['tps_product']."' and ts_store='".$_REQUEST['store']."' ");               
          
            }
           
           
          }
       
      
        }}
        
              
         
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_wastage_all'){
   
    $fnct_menu = $database->mysqlQuery("select * from tbl_wastage where tw_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
                  
        
       if($result_fnctvenue5['tw_unit_type']=='Single' || $result_fnctvenue5['tw_unit_type']=='Nos'){
     
         $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tw_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue5['tw_product']."' and ts_store='".$_REQUEST['store']."'  ");
   
         }else{
                  
                  
          if( $result_fnctvenue5['tw_rate_type']=='Packet' && ($result_fnctvenue5['tw_unit_type']=='KG' || $result_fnctvenue5['tw_unit_type']=='LTR')){   
                  
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tw_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_fnctvenue5['tw_product']."' and ts_store='".$_REQUEST['store']."' ");           
           
           }else{
               
               $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue5['tw_weight']."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_fnctvenue5['tw_product']."' and ts_store='".$_REQUEST['store']."' ");           
            
           }
           
           
          }
       
      
        }}
        
        
        $fnct_menu = $database->mysqlQuery("update tbl_wastage set  tw_set='Y',tw_store='".$_REQUEST['store']."'  where tw_set='N'  ");
         
        $sql_login  =  $database->mysqlQuery("update tbl_inv_settings set ti_wastage_id=(ti_wastage_id+1)  ");  
           
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_consum_all'){
   
    $fnct_menu = $database->mysqlQuery("select * from tbl_consumption where tc_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
                  
        
         if($result_fnctvenue5['tc_unit_type']=='Single' || $result_fnctvenue5['tc_unit_type']=='Nos'){
     
         $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tc_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue5['tc_product']."' and ts_store='".$_REQUEST['store']."'  ");
   // echo "update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tc_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue5['tc_product']."' and ts_store='".$_REQUEST['store']."'  ";
              }else{
                  
                  if($result_fnctvenue5['tc_rate_type']=='Packet'  && ($result_fnctvenue5['tc_unit_type']=='KG' || $result_fnctvenue5['tc_unit_type']=='LTR')){
                 
                  
           $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tc_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_fnctvenue5['tc_product']."' and ts_store='".$_REQUEST['store']."' ");           
           
                   }else{
                       
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue5['tc_weight']."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_fnctvenue5['tc_product']."' and ts_store='".$_REQUEST['store']."' ");           
                   
                       
                   }
           
           
          }
       
      
        }}
        
        
        $fnct_menu = $database->mysqlQuery("update tbl_consumption set  tc_set='Y',tc_store='".$_REQUEST['store']."'  where tc_set='N'  ");
         
        $sql_login  =  $database->mysqlQuery("update tbl_inv_settings set ti_consumption_id=(ti_consumption_id+1)  ");  
           
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_physical_items'){
        
  ?>

<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Phy Id : <?=$_REQUEST['id']?> </div>
<div  style="overflow:auto; width:750px; height: 550px;" >

    <div class="inv-pr-drop" style="overflow:auto;">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
              <tr><th>Sl</th>
             <th >Product</th>
       <th >Real Weight</th>
      <th >Physical Weight</th>
      <th > Weight Diff</th>
       <th >Real Qty</th>
      <th >Physical Qty</th>
      <th > Qty Diff</th>
        <th >Rate</th>
        <th >Total</th>
            </tr>

              
            </thead>  
            
            <tbody >

<?php
                
                 $real_weight=''; $real_qty='';        
                        
		$weight=0; $qty=0; $rate=0; $total=0; $total1=0;
                
                //echo "SELECT *  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_phy_id ='".$_REQUEST['id']."'  group by tps_phy_id,tps_product  order by tps_phy_id,tps_product asc  ";
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tps_total) as tot  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_phy_id ='".$_REQUEST['id']."'  group by tps_phy_id,tps_product  order by tps_phy_id,tps_product asc  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    $total=$result_kotlist['tot'];
                                     $total1=$total1+$total;
                                                  
           ?>

                             <tr>
                           <td><?=$i++?></td>
                         
                            <td ><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td ><?=$result_kotlist['tps_store_weight']?></td>
                            <?php
                            $fnct_menu = $database->mysqlQuery("select sum(ts_weight) as tot_weight from tbl_store_stock where  ts_product='".$result_kotlist['tps_product']."' and  ts_store='".$result_kotlist['tps_store']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  
                  $real_weight=$result_fnctvenue['tot_weight'];
                  ?>
                             <td ><?=$result_fnctvenue['tot_weight']?></td>
                           <?php
                  
              }
              }else{
                  ?>
                             <td >0</td>
                           <?php
                  
              }
                         
               ?>     
              
                           <?php if($result_kotlist['tps_weight']>$result_kotlist['tps_store_weight']){ ?>
                           
                           <td  ><?=($result_kotlist['tps_weight']-$result_kotlist['tps_store_weight'])  ?> [EXCESS] </td>
                            
                           <?php } else if($result_kotlist['tps_weight']<$result_kotlist['tps_store_weight']){  ?>
                            
                             <td  ><?=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight'])?>  [Difference] </td>
                             
                            <?php }else{ ?>
                             
                              <td  >  [EQUAL] </td>
                              <?php }?>
                              
                              
                             <td ><?=$result_kotlist['tps_store_qty']?></td>
                             
                            <?php
                            $fnct_menu = $database->mysqlQuery("select sum(ts_qty) as tot_qty from tbl_store_stock where  ts_product='".$result_kotlist['tps_product']."' and  ts_store='".$result_kotlist['tps_store']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {  $real_qty=$result_fnctvenue['tot_qty'];
                  ?>
                             <td ><?=$result_fnctvenue['tot_qty']?></td>
                           <?php
                  
              }
              }else{
                  ?>
                             <td >0</td>
                           <?php
                  
              }
              ?>
                           
                            <?php if($result_kotlist['tps_qty']>$result_kotlist['tps_store_qty']){ ?>
                           
                           <td ><?=($result_kotlist['tps_qty']-$result_kotlist['tps_store_qty'])  ?> [EXCESS] </td>
                            
                           <?php } else if($result_kotlist['tps_qty']<$result_kotlist['tps_store_qty']){  ?>
                            
                             <td ><?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])?>  [Difference] </td>
                             
                            <?php }else{ ?>
                             
                              <td >  [EQUAL] </td>
                              <?php }?>
                     <td ><?=number_format($result_kotlist['tps_rate'],$_SESSION['be_decimal']) ?> </td>          
                  <td ><?= number_format($total,$_SESSION['be_decimal']) ?></td>             
                               
</tr>


<?php }} ?>
             

<tr>
    <td>Total</td>
    
    <td></td>
      <td></td>
        <td></td>
          <td></td>
            <td></td>
              <td></td>
                <td></td>
                  <td></td>
                 <td ><?= number_format($total1,$_SESSION['be_decimal'])  ?></td>             
    
    
</tr>


             
   </tbody> 
            
            
            
        </table>
        
       
    </div>

  
    </div>                               
                                
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_physical'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
      <th scope="col">Action</th>  
      <th scope="col">Phy Id</th>
      <th scope="col">Date</th>
      <th style="display:none" scope="col">Product</th>
       <th style="display:none" scope="col">Real Weight</th>
      <th style="display:none" scope="col">Physical Weight</th>
      <th style="display:none" scope="col"> Weight Diff</th>
       <th style="display:none" scope="col">Real Qty</th>
      <th style="display:none" scope="col">Physical Qty</th>
      <th  style="display:none" scope="col"> Qty Diff</th>
      
      <th scope="col">Store</th>
       <th scope="col">Staff </th>
        <th scope="col">Items </th>
     <th scope="col">Total </th>
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
    if($_REQUEST['staff']!=''){
    $string2.=" and tps_login = '".$_REQUEST['staff']."'   ";
    }
    
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and tps_phy_id like '%".$_REQUEST['search_id']."%'   ";
    }
    
     if($_REQUEST['store']!=''){
    $string2.=" and tps_store = '".$_REQUEST['store']."'   ";
    }
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and tps_date between '".$from."' and '".$to."' ";
                                  $string1.= " and ts_stock_update_date between '".$from."' and '".$to."' ";
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and tps_date between '".$from."' and '".$to."' ";
                         $string1.= " and ts_stock_update_date between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and tps_date between '".$from."' and '".$to."' ";
                              $string1.= " and ts_stock_update_date between '".$from."' and '".$to."' ";
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and tps_date between '".$from."' and '".$to."' ";
                              $string1.= " and ts_stock_update_date between '".$from."' and '".$to."' ";
                        }
                
                 $real_weight=''; $real_qty='';        
                        
		$weight=0; $qty=0; $rate=0;  $total1=0;  $total=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tps_total) as tot, count(tps_product) as prd  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_product !='' $string2 group by tps_phy_id  order by tps_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                     $total=$result_kotlist['tot'];
                                    $total1=$total1+$total;
                                    
                                    $i++;
                                                  
           ?>

                             <tr>
                           <td><?=$i?></td>
                           
                           
                           <?php if($result_kotlist['tps_approve_date']==''){ ?>
                           <td title="Approval" style="cursor: pointer " onclick="phy_approval('<?=$result_kotlist['tps_phy_id']?>','<?=$result_kotlist['tps_store']?>')"   ><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i></td>
                           
                           <?php } else{ ?>
                           <td title="Approval Done" style="cursor: pointer "   ><i class="fa fa-close fa-lg" aria-hidden="true"></i></td>
                                
                               
                         <?php }  ?>
                           
                           
                           <td  onclick="phy_items('<?=$result_kotlist['tps_phy_id']?>')" > <span style="border:solid 1px darkred;padding: 5px;cursor: pointer"> <?=$result_kotlist['tps_phy_id']?> </span> </td>
                            
                          
                           
                           <td><?=$result_kotlist['tps_date']?></td>
                           
                            <td style="display:none"><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td style="display:none"><?=$result_kotlist['tps_store_weight']?></td>
                            <?php
                            $fnct_menu = $database->mysqlQuery("select sum(ts_weight) as tot_weight from tbl_store_stock where  ts_product='".$result_kotlist['tps_product']."' and  ts_store='".$result_kotlist['tps_store']."' $string1 ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  
                  $real_weight=$result_fnctvenue['tot_weight'];
                  ?>
                             <td style="display:none"><?=$result_fnctvenue['tot_weight']?></td>
                           <?php
                  
              }
              }else{
                  ?>
                             <td style="display:none">0</td>
                           <?php
                  
              }
                         
               ?>     
              
                            
                          
                           
                           
                           
                           <?php if($result_kotlist['tps_weight']>$result_kotlist['tps_store_weight']){ ?>
                           
                           <td style="display:none" ><?=($result_kotlist['tps_weight']-$result_kotlist['tps_store_weight'])  ?> [EXCESS] </td>
                            
                           <?php } else if($result_kotlist['tps_weight']<$result_kotlist['tps_store_weight']){  ?>
                            
                             <td style="display:none" ><?=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight'])?>  [Difference] </td>
                             
                            <?php }else{ ?>
                             
                              <td style="display:none" >  [EQUAL] </td>
                              <?php }?>
                              
                              
                             <td style="display:none"><?=$result_kotlist['tps_store_qty']?></td>
                             
                            <?php
                            $fnct_menu = $database->mysqlQuery("select sum(ts_qty) as tot_qty from tbl_store_stock where  ts_product='".$result_kotlist['tps_product']."' and  ts_store='".$result_kotlist['tps_store']."' $string1 ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {  $real_qty=$result_fnctvenue['tot_qty'];
                  ?>
                             <td style="display:none"><?=$result_fnctvenue['tot_qty']?></td>
                           <?php
                  
              }
              }else{
                  ?>
                             <td style="display:none">0</td>
                           <?php
                  
              }
              ?>
                           
                           
                         
                           
                           
                            <?php if($result_kotlist['tps_qty']>$result_kotlist['tps_store_qty']){ ?>
                           
                           <td style="display:none"><?=($result_kotlist['tps_qty']-$result_kotlist['tps_store_qty'])  ?> [EXCESS] </td>
                            
                           <?php } else if($result_kotlist['tps_qty']<$result_kotlist['tps_store_qty']){  ?>
                            
                             <td style="display:none"><?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])?>  [Difference] </td>
                             
                            <?php }else{ ?>
                             
                              <td style="display:none">  [EQUAL] </td>
                              <?php }?>
                           
                           <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tps_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              
              ?>
                           <td><?=$result_kotlist['tps_login']?></td>
                            <td><?=$result_kotlist['prd']?></td>
               <td ><?=number_format($total,$_SESSION['be_decimal']) ?></td>               
</tr>


<?php 
                                        }
             ?>                           
                                        
                 <tr>
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
               <td style=""></td>
                <td style=""></td>
            <td style=""><?=number_format($total1,$_SESSION['be_decimal'])?></td>
                
        
        
        </tr>                            
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_central_history'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
      <th scope="col">Cnt Id</th>
      <th scope="col">Date</th>
      <th style="display:none" scope="col">Product</th>
       <th style="display:none" scope="col"> Weight</th>
      <th style="display:none" scope="col"> Qty</th>
       <th   scope="col"> From Branch</th>
      <th   scope="col"> From Store</th>
       <th   scope="col"> To Branch</th>
       <th   scope="col"> To Store</th>
      <th   scope="col"> Option</th>
    
        <th style="display:none" scope="col">Rate </th>
 <th scope="col">Total </th>
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
    if($_REQUEST['central_type']!=''){
    $string2.=" and tct_mode = '".$_REQUEST['central_type']."'   ";
    }
    
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and tct_central_id like '%".$_REQUEST['search_id']."%'   ";
    }
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and date(tct_date) between '".$from."' and '".$to."' ";
                                 
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and date(tct_date) between '".$from."' and '".$to."' ";
                        
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and date(tct_date) between '".$from."' and '".$to."' ";
                            
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and date(tct_date) between '".$from."' and '".$to."' ";
                             
                        }
                
                 $real_weight=''; $real_qty='';    $total=0;     $total1=0;     
                        
		$weight=0; $qty=0; $rate=0;
                
               $sql_kotlist  =  $database->mysqlQuery("SELECT  tct_option,mr_menuname,`tct_id`, `tct_central_id`, `tct_product`, `tct_rate_type`, `tct_unit_type`, 
                        `tct_qty`, `tct_weight`, `tct_rate`, `tct_total`, `tct_tax`, `tct_total_tax`,
                        `tct_final_total`, `tct_date`, `tct_login`, `tct_local_branch`, `tct_local_store`, 
                        `tct_to_branch`, `tct_to_store`, `tct_set`, `tct_barcode`, `tct_brand`, 
                        `tct_current_stock`, `tct_type`, `tct_mode`, `tct_received`, `tct_receive_time`, 
                        `tct_receive_login`, `tct_status_live`, `tct_cancel_time`, `tc_cancel_login`, 
                        `tc_receieved_id`, `tct_central_menu_id` FROM `tbl_central_kitchen_transfer` left join tbl_menumaster on tbl_menumaster.mr_central_id=tbl_central_kitchen_transfer.tct_central_menu_id where tct_product!=''  $string2 group by tct_central_id  order by tct_id desc limit ". $pagination.",10 "); 
              
                
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                    $total=$result_kotlist['tct_total'];
                                $total1=$total1+$total;    
                                    $i++;
                    
                                    
                                    
                                    
                                   
               ?>

                             <tr>
                           <td><?=$i?></td>
                           <td  onclick="phy_items('<?=$result_kotlist['tct_central_id']?>')" > <span style="border:solid 1px darkred;padding: 5px;cursor: pointer"> <?=$result_kotlist['tct_central_id']?> </span> </td>
                            
                           <td><?=$result_kotlist['tct_date']?></td>
                           
                            <td  style="display:none"><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td style="display:none" ><?=$result_kotlist['tct_weight']?></td>
                             
                             <td style="display:none" ><?=$result_kotlist['tct_qty']?></td>
                            
                             
                              <?php
                       
                       
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_MAIN);
   
        
            ///to branch///
                           
         $sql_gen =  mysqli_query($localhost1,"select branch_id,branch_name from tbl_branch where  branch_id ='".$result_kotlist['tct_local_branch']."'   "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue1  = mysqli_fetch_array($sql_gen)) 
			{
                  ?>
                             <td ><?=$result_fnctvenue1['branch_name']?></td>
               <?php
                  
              }
              }
                             
                             
                         
                           
        $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tct_local_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
               <?php
                  
              }
              }
              
              ?>
                             
                       <?php
                       
                       
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_MAIN);
   
        
            ///to branch///
                           
         $sql_gen =  mysqli_query($localhost1,"select branch_id,branch_name from tbl_branch where  branch_id ='".$result_kotlist['tct_to_branch']."'   "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue1  = mysqli_fetch_array($sql_gen)) 
			{
                  ?>
                             <td ><?=$result_fnctvenue1['branch_name']?></td>
               <?php
                  
              }
              }
              
               $localhost11=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
              //////to store//
               $sql_gen =  mysqli_query($localhost11,"select ti_name from tbl_inv_kitchen where ti_status='Y' and ti_id='".$result_kotlist['tct_to_store']."' and  branchid ='".$result_kotlist['tct_to_branch']."' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
			{
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
               <?php
                  
              }
              }
              
              ?>
                             
                             
                        
                           <td style="display:none"><?=$result_kotlist['tct_rate']?></td>
                          
                            <td><?=$result_kotlist['tct_option']?></td>
                             <td><?=$result_kotlist['tct_total']?></td>
                           
                             
</tr>


<?php 
       }
    ?>                                    
                                        
        <tr>
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style="display:none"></td>
            <td style="display:none"></td>
              <td style="display:none"></td>
               <td style=""></td>
                 <td style=""></td>
                  <td style=""></td>
                    <td style=""></td>
                <td ></td>
            <td style=""><?=number_format($total1,$_SESSION['be_decimal'])?></td>
            
        
        
        </tr>                                  
                                        
                                        
                                        
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_wastage'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
       
      <th scope="col">Was Id</th>
        <th scope="col">Was Central</th>   
      <th scope="col">Date</th>
      <th style="display:none" scope="col">Product</th>
       <th style="display:none" scope="col">Real Weight</th>
      <th style="display:none" scope="col"> Qty</th>
      <th style="display:none" scope="col"> Weight</th>
     <th scope="col">Store</th>
       <th scope="col">Staff </th>
        <th scope="col">Items </th>
 <th scope="col">Total </th>
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
    if($_REQUEST['staff']!=''){
    $string2.=" and tw_login = '".$_REQUEST['staff']."'   ";
    }
    
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and tw_wastage_id like '%".$_REQUEST['search_id']."%'   ";
    }
    
    
     if($_REQUEST['store']!=''){
    $string2.=" and tw_store = '".$_REQUEST['store']."'   ";
    }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and tw_date between '".$from."' and '".$to."' ";
                                 
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and tw_date between '".$from."' and '".$to."' ";
                        
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and tw_date between '".$from."' and '".$to."' ";
                            
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and tw_date between '".$from."' and '".$to."' ";
                             
                        }
                
                 $real_weight=''; $real_qty='';    $total=0;     $total1=0;     
                        
		$weight=0; $qty=0; $rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT count(tw_product) as prd,tw_central_return,tw_login,tw_weight,tw_qty,"
                        . "mr_menuname,tw_date, tw_wastage_id,tw_store,sum(tw_total) as tot  from tbl_wastage  left join tbl_menumaster on"
                        . " tbl_menumaster.mr_menuid=tbl_wastage.tw_product  where tw_set='Y' and  tw_product !='' $string2 "
                        . " group by tw_wastage_id  order by tw_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                    $total=$result_kotlist['tot'];
                                    $total1=$total1+$total;    
                                    $i++;
                                                  
               ?>

                    <tr>
                        
                    <td><?=$i?></td>
                           
                    
                           
                           
                           
                           <td  onclick="phy_items('<?=$result_kotlist['tw_wastage_id']?>')" > 
                               
                               
                                <span style="border:solid 1px darkred;padding: 5px;cursor: pointer"> <?=$result_kotlist['tw_wastage_id']?> </span> 
                               
                           </td>
                           
                            <?php if($result_kotlist['tw_central_return']!='Y'){ ?>
                           
                     <td style="cursor: pointer " title="RETURN TO CENTRAL " onclick="phy_items1('<?=$result_kotlist['tw_wastage_id']?>')" > 
                               
                         <span style="border:solid 1px ;padding: 2px;border-radius: 3px">Central Return</span>
                               
                     </td>
                     
                      <?php }else{ ?>
                     
                     <td style="color:#d12020;font-weight: bold">RETURNED TO CENTRAL</td>
                     
                      <?php }?>
                           
                           
                            
                           <td><?=$result_kotlist['tw_date']?></td>
                           
                            <td style="display:none"><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td style="display:none"><?=$result_kotlist['tw_qty']?></td>
                           
                              
                             <td style="display:none"><?=$result_kotlist['tw_weight']?></td>
                             
                            
                            
                           <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tw_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              
              ?>
                           <td><?=$result_kotlist['tw_login']?></td>
                           <td><?=$result_kotlist['prd']?></td>
                            <td><?=number_format($total,$_SESSION['be_decimal'])?></td>
                             
</tr>


<?php 
       }
    ?>                                    
                                        
        <tr>
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
              <td style=""></td>
            <td style=""><?=number_format($total1,$_SESSION['be_decimal'])?></td>
            
        
        
        </tr>                                  
                                        
                                        
                                        
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_production_history'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
      <th scope="col">Product</th>
      <th scope="col">Date</th>
     
      <th  scope="col"> Qty</th>
      <th scope="col"> Weight</th>
     <th scope="col">Store</th>
     
     <th scope="col">Staff </th>
       
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
    if($_REQUEST['staff']!=''){
    $string2.=" and tp_login = '".$_REQUEST['staff']."'   ";
    }
    
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['search_id']."%'   ";
    }
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and tp_date between '".$from."' and '".$to."' ";
                                 
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and tp_date between '".$from."' and '".$to."' ";
                        
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and tp_date between '".$from."' and '".$to."' ";
                            
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and tp_date between '".$from."' and '".$to."' ";
                             
                        }
                
                 $real_weight=''; $real_qty='';    $total=0;     $total1=0;     
                        
		$weight=0; $qty=0; $rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *  from tbl_production  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_production.tp_product  where tp_set='Y'  $string2  order by tp_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                   
                              
                                    $i++;
                                                  
               ?>

                             <tr>
                           <td><?=$i?></td>
                           <td  style="display:none" onclick="phy_items('')" > <span style="border:solid 1px darkred;padding: 5px;cursor: pointer">  </span> </td>
                             <td ><?=$result_kotlist['mr_menuname']?></td>
                           <td><?=$result_kotlist['tp_date']?></td>
                           
                            <td style="display:none"><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td ><?=$result_kotlist['tp_qty']?></td>
                           
                              
                             <td ><?=$result_kotlist['tp_weight']?></td>
                             
                            
                            
                           <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tp_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              
              ?>
                           <td><?=$result_kotlist['tp_login']?></td>
                         
                             
</tr>


<?php 
       }
    ?>                                    
                                        
<tr style="display:none">
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
              <td style=""></td>
            <td style=""><?=number_format(0,$_SESSION['be_decimal'])?></td>
            
        
        
        </tr>                                  
                                        
                                        
                                        
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_consum'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
      <th scope="col">Cons Id</th>
      <th scope="col">Date</th>
      <th style="display:none" scope="col">Product</th>
       <th style="display:none" scope="col">Real Weight</th>
      <th style="display:none" scope="col"> Qty</th>
      <th style="display:none" scope="col"> Weight</th>
     <th scope="col">Store</th>
       <th scope="col">Staff </th>
        <th scope="col">Items </th>
       
 <th scope="col">Total </th>
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
    $string2='';
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
    if($_REQUEST['staff']!=''){
    $string2.=" and tc_login = '".$_REQUEST['staff']."'   ";
    }
    
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and tc_con_id like '%".$_REQUEST['search_id']."%'   ";
    }
    
    
    if($_REQUEST['store']!=''){
    $string2.=" and tc_store = '".$_REQUEST['store']."'   ";
    }
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                                $string2.= " and tc_date between '".$from."' and '".$to."' ";
                                 
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                                $string2.= " and tc_date between '".$from."' and '".$to."' ";
                        
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                                $string2.= " and tc_date between '".$from."' and '".$to."' ";
                            
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string2.= " and tc_date between '".$from."' and '".$to."' ";
                             
                        }
                
                 $real_weight=''; $real_qty='';    $total=0;     $total1=0;     
                        
		$weight=0; $qty=0; $rate=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT count(tc_product) as prd,tc_login,tc_weight,tc_qty,mr_menuname,tc_date, tc_con_id,tc_store,sum(tc_total) as tot  from tbl_consumption  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_consumption.tc_product  where tc_set='Y' and  tc_product !='' $string2 group by tc_con_id  order by tc_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                    $total=$result_kotlist['tot'];
                                $total1=$total1+$total;    
                                    $i++;
                                                  
               ?>

                             <tr>
                           <td><?=$i?></td>
                           <td  onclick="phy_items('<?=$result_kotlist['tc_con_id']?>')" > <span style="border:solid 1px darkred;padding: 5px;cursor: pointer"> <?=$result_kotlist['tc_con_id']?> </span> </td>
                            
                           <td><?=$result_kotlist['tc_date']?></td>
                           
                            <td style="display:none"><?=$result_kotlist['mr_menuname']?></td>
                            
                             <td style="display:none"><?=$result_kotlist['tc_qty']?></td>
                           
                              
                             <td style="display:none"><?=$result_kotlist['tc_weight']?></td>
                             
                            
                            
                           <?php
                            $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tc_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
                           <?php
                  
              }
              }
              
              ?>
                           <td><?=$result_kotlist['tc_login']?></td>
                           <td><?=$result_kotlist['prd']?></td>
                            <td><?=number_format($total,$_SESSION['be_decimal'])?></td>
                             
</tr>


<?php 
       }
    ?>                                    
                                        
        <tr>
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
              <td style=""></td>
            <td style=""><?=number_format($total1,$_SESSION['be_decimal'])?></td>
            
        
        
        </tr>                                  
                                        
                                        
                                        
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_central_items'){
        
  ?>

<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Cnt Id : <?=$_REQUEST['id']?> </div>
<div  style="overflow:auto; width: 750px; height: 550px;" >

    <div class="inv-pr-drop">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
              <tr><th>Sl</th>
             <th >Product</th>
         <th > Qty</th>
        <th > Weight</th>
      <th > Rate</th>
        <th > Total</th>
            </tr>

              
            </thead>  
            
            <tbody >

<?php
                
                      
                        
		 $tot=0; $tot_new=0; $qty_new=0; $wgt_new=0;  $edit_val=1990;    
                
                //echo "SELECT *  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_phy_id ='".$_REQUEST['id']."'  group by tps_phy_id,tps_product  order by tps_phy_id,tps_product asc  ";
                $sql_kotlist  =  $database->mysqlQuery("SELECT tc.tct_edit_value, tc.tct_unit_type, tc.tct_rate_type, tc.tct_qty, tc.tct_weight,tm.mr_menuname"
                        . " , tc.tct_rate  from tbl_central_kitchen_transfer tc left join tbl_menumaster tm on tm.mr_central_id=tc.tct_central_menu_id   where tc.tct_set='Y' and  tc.tct_central_id ='".$_REQUEST['id']."'  group by tc.tct_product  order by tc.tct_product asc  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
				 {  
                               
                        $edit_val=$result_kotlist['tct_edit_value']; 
                        
       if($result_kotlist['tct_unit_type']=='Nos' || $result_kotlist['tct_unit_type']=='Single' ){
                          
                 $tot_new=($result_kotlist['tct_qty']-$result_kotlist['tct_edit_value'])* $result_kotlist['tct_rate'];        
                 $tot=     $tot +  $tot_new  ;     
                 $qty_new=($result_kotlist['tct_qty']-$result_kotlist['tct_edit_value']);
        }else{
            
          if($result_kotlist['tct_rate_type']=='Packet' && ($result_kotlist['tct_unit_type']=='LTR' || $result_kotlist['tct_unit_type']=='KG') ){
             
               $tot_new=($result_kotlist['tct_qty']-$result_kotlist['tct_edit_value'])*$result_kotlist['tct_rate'];    
               $tot=     $tot +  $tot_new;        
               $qty_new=($result_kotlist['tct_qty']-$result_kotlist['tct_edit_value']);
                
         }else{
                  $tot_new= (($result_kotlist['tct_weight']-$result_kotlist['tct_edit_value'])*$result_kotlist['tct_rate']);    
                  $tot=      $tot +  $tot_new  ;  
                  
                  $wgt_new= ($result_kotlist['tct_weight']-$result_kotlist['tct_edit_value']);
                 
         }
         
         
        }                 
                
           ?>

                            <tr>
                            <td><?=$i++?></td>
                         
                            <td><?=$result_kotlist['mr_menuname']?></td>
                            
                            <td><?=$qty_new?> </td>
                             
                            <td><?=$wgt_new?></td>
                            
                            <td><?=number_format( $result_kotlist['tct_rate'],$_SESSION['be_decimal'])?></td>
                            
                            <td><?=number_format( $tot_new,$_SESSION['be_decimal']) ?></td>
                             
                           </tr>


<?php }} ?>
                                            
            <tr>
                           <td>Total</td>
                         
                            <td ></td>
                            
                              
                             <td ></td>
                             
                            <td ></td>
                            <td ></td>
                            <td ><?=number_format( $tot,$_SESSION['be_decimal']) ?></td>
                               
           </tr> 
   </tbody> 
            
            
            
        </table>
        
       
    </div>

  
    </div>                               
                                
                                        
<?php
    
} 
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_wastage_items'){
        
  ?>

<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Was Id : <?=$_REQUEST['id']?> </div>
<div  style="overflow:auto; width: 750px; height: 550px;" >

    <div class="inv-pr-drop">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
              <tr><th>Sl</th>
             <th >Product</th>
                <th >Reason</th>
         <th > Qty</th>
        <th > Weight</th>
      <th > Rate</th>
        <th > Total</th>
            </tr>

              
            </thead>  
            
            <tbody >

<?php
                
                 $real_weight=''; $real_qty='';        
                        
		$weight=0; $qty=0; $rate=0; $tot=0;
                
                //echo "SELECT *  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_phy_id ='".$_REQUEST['id']."'  group by tps_phy_id,tps_product  order by tps_phy_id,tps_product asc  ";
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tw_total) as tot  from tbl_wastage  left join tbl_menumaster on "
                        . "tbl_menumaster.mr_menuid=tbl_wastage.tw_product  where tw_set='Y' and  tw_wastage_id ='".$_REQUEST['id']."'"
                        . " group by tw_wastage_id,tw_product  order by tw_wastage_id,tw_product asc  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    
                                   $tot=     $tot +  $result_kotlist['tot']  ;     
           ?>

                             <tr>
                           <td><?=$i++?></td>
                         
                           <td title="REF ID : <?=$result_kotlist['tw_product']?> & CNT ID: <?=$result_kotlist['tw_item_central_id']?> " > <i class="fa fa-info-circle"></i> &nbsp;&nbsp; <?=$result_kotlist['mr_menuname']?></td>
                            <td ><?=$result_kotlist['tw_reason']?></td>
                              
                             <td ><?=$result_kotlist['tw_qty']?></td>
                             
                            <td ><?=$result_kotlist['tw_weight']?></td>
                            <td ><?=number_format( $result_kotlist['tw_rate'],$_SESSION['be_decimal'])?></td>
                            <td ><?= number_format( $result_kotlist['tw_total'],$_SESSION['be_decimal']) ?></td>
                               
</tr>


<?php }} ?>
                                            
            <tr>
                           <td>Total</td>
                         
                            <td ></td>
                            
                             <td ></td> 
                             <td ></td>
                             
                            <td ></td>
                            <td ></td>
                            <td ><?=number_format( $tot,$_SESSION['be_decimal']) ?></td>
                               
</tr> 

            <select id="ret_reason1" style="display: none;margin-left: 450px;float: right;margin-top: 461px;position: absolute;border: solid 1px;padding: 1px;border-radius: 4px;cursor: pointer;height: 25px;">
                <option value="">Return Reason</option>
                <option value="Damage">Damage</option>
                <option value="Expired">Expired</option>
                <option value="Qty_Weight_Missmatch">Qty/Weight Missmatch</option>
                <option value="Wastage">Wastage</option>
                <option value="Others">Others</option>
            </select>

            <span id="ret_reason2"style="display: none;margin-left: 405px;float: right;margin-top: 461px;position: absolute;border: solid 1px;padding: 1px;border-radius: 4px;cursor: pointer;height: 25px;"><input id="ret_reason" type="text" maxlength="50" placeholder="Return Remarks"> </span>
                
            <span id="ret_id" onclick="return_to_central('<?=$_REQUEST['id']?>')" style="color:white;background-color: darkred;display: none;margin-left: 593px;float: right;margin-top: 461px;position: absolute;border: solid 1px;padding: 1px;border-radius: 4px;cursor: pointer">RETURN TO CENTRAL</span>

   </tbody> 
            
            
            
        </table>
        
       
    </div>

  
    </div>                               
                                
                                        
<?php
    
} 
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_consum_items'){
        
  ?>

<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Cons Id : <?=$_REQUEST['id']?> </div>
<div  style="overflow:auto; width: 750; height: 550px;" >

    <div class="inv-pr-drop">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
              <tr><th>Sl</th>
             <th >Product</th>
         <th > Qty</th>
        <th > Weight</th>
      <th > Rate</th>
        <th > Total</th>
            </tr>

              
            </thead>  
            
            <tbody >

<?php
                
                 $real_weight=''; $real_qty='';        
                        
		$weight=0; $qty=0; $rate=0; $tot=0;
                
                //echo "SELECT *  from tbl_physical_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_physical_stock.tps_product  where tps_set='Y' and  tps_phy_id ='".$_REQUEST['id']."'  group by tps_phy_id,tps_product  order by tps_phy_id,tps_product asc  ";
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tc_total) as tot  from tbl_consumption  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_consumption.tc_product  where tc_set='Y' and  tc_con_id ='".$_REQUEST['id']."'  group by tc_con_id,tc_product  order by tc_con_id,tc_product asc  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    
                                   $tot=     $tot +  $result_kotlist['tot']  ;     
           ?>

                             <tr>
                           <td><?=$i++?></td>
                         
                            <td ><?=$result_kotlist['mr_menuname']?></td>
                            
                              
                             <td ><?=$result_kotlist['tc_qty']?></td>
                             
                            <td ><?=$result_kotlist['tc_weight']?></td>
                            <td ><?=number_format( $result_kotlist['tc_rate'],$_SESSION['be_decimal']) ?></td>
                            <td ><?=number_format( $result_kotlist['tc_total'],$_SESSION['be_decimal']) ?></td>
                               
</tr>


<?php }} ?>
                                            
            <tr>
                           <td>Total</td>
                         
                            <td ></td>
                            
                              
                             <td ></td>
                             
                            <td ></td>
                            <td ></td>
                            <td ><?=number_format($tot,$_SESSION['be_decimal']) ?></td>
                               
</tr> 
   </tbody> 
            
            
            
        </table>
        
       
    </div>

  
    </div>                               
                                
                                        
<?php
    
} 
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_phy_qty'){
    
    if($_REQUEST['unit']=='Nos' || $_REQUEST['unit']=='Single' ){
      $fnct_menu = $database->mysqlQuery("update  tbl_physical_stock set tps_qty='".$_REQUEST['qty']."',tps_weight='".$_REQUEST['weight']."',tps_total=(tps_rate*tps_qty) where tps_id='".$_REQUEST['id']."' ");
 }else{
     
      if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit']=='LTR' || $_REQUEST['unit']=='KG') ){
     $fnct_menu = $database->mysqlQuery("update  tbl_physical_stock set tps_qty='".$_REQUEST['qty']."',tps_weight='".$_REQUEST['weight']."',tps_total=(tps_rate*tps_qty) where tps_id='".$_REQUEST['id']."' "); 
      }else{
        $fnct_menu = $database->mysqlQuery("update  tbl_physical_stock set tps_qty='".$_REQUEST['qty']."',tps_weight='".$_REQUEST['weight']."',tps_total=(tps_rate*tps_weight) where tps_id='".$_REQUEST['id']."' ");     
      }
     
 }
      
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_consum_qty'){
    
    if($_REQUEST['unit']=='Nos' || $_REQUEST['unit']=='Single' ){
    $fnct_menu = $database->mysqlQuery("update  tbl_consumption set tc_balance='".$_REQUEST['balance']."', tc_qty='".$_REQUEST['qty']."',tc_weight='".$_REQUEST['weight']."',tc_total=(tc_rate*tc_qty) where tc_id='".$_REQUEST['id']."' ");
    }else{
        
        if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit']=='LTR' || $_REQUEST['unit']=='KG') ){
       $fnct_menu = $database->mysqlQuery("update  tbl_consumption set tc_balance='".$_REQUEST['balance']."', tc_qty='".$_REQUEST['qty']."',tc_weight='".$_REQUEST['weight']."',tc_total=(tc_rate*tc_qty) where tc_id='".$_REQUEST['id']."' "); 
        }else{
          $fnct_menu = $database->mysqlQuery("update  tbl_consumption set tc_balance='".$_REQUEST['balance']."', tc_qty='".$_REQUEST['qty']."',tc_weight='".$_REQUEST['weight']."',tc_total=(tc_rate*tc_weight) where tc_id='".$_REQUEST['id']."' "); 
         
        }
       }
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='update_wastage_qty'){
    
    if($_REQUEST['unit']=='Nos' || $_REQUEST['unit']=='Single' ){
      $fnct_menu = $database->mysqlQuery("update  tbl_wastage set tw_qty='".$_REQUEST['qty']."',tw_weight='".$_REQUEST['weight']."',tw_total=(tw_rate*tw_qty) where tw_id='".$_REQUEST['id']."' ");
    } else{
         if($_REQUEST['rate_type']=='Packet' && ($_REQUEST['unit']=='LTR' || $_REQUEST['unit']=='KG') ){
       $fnct_menu = $database->mysqlQuery("update  tbl_wastage set tw_qty='".$_REQUEST['qty']."',tw_weight='".$_REQUEST['weight']."',tw_total=(tw_qty*tw_rate) where tw_id='".$_REQUEST['id']."' ");  
         }else{
            $fnct_menu = $database->mysqlQuery("update  tbl_wastage set tw_qty='".$_REQUEST['qty']."',tw_weight='".$_REQUEST['weight']."',tw_total=(tw_weight*tw_rate) where tw_id='".$_REQUEST['id']."' ");  
          
         }
       
         }
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_grn_invoice'){
    
    
        $fnct_menu = $database->mysqlQuery("select tgs_invoice_no from tbl_grn_summary left join tbl_grn_order "
        . " on tbl_grn_order.tg_grn_id=tbl_grn_summary.tgs_grn_id where "
        . " tbl_grn_summary.tgs_invoice_no='".$_REQUEST['invoice']."' and tbl_grn_order.tg_supplier='".$_REQUEST['supplier']."' "
        . " and tbl_grn_summary.tgs_grn_id !='".$_REQUEST['edit_id']."'  ");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
             echo 'no';
        }else{
            echo 'yes';
        }
     
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='purchase_return_store'){
    
   $actual_srore_qty=0; $actual_store_weight=0; 
    
   $sql_login  =  $database->mysqlQuery("select ts_rate_type,ts_unit,sum(ts_qty) as qty,sum(ts_weight) wt from tbl_store_stock where ts_product ='".$_REQUEST['product']."' "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ 
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single' ){
                      $actual_srore_qty=$result_login['qty'];
                      $actual_store_weight=0;
                       }else{
                           
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR') ){     
                          
                      $actual_store_weight=0;
                      
                      $actual_srore_qty=$result_login['qty'];
                      }else{
                          
                          $actual_store_weight=$result_login['wt'];
                      
                      $actual_srore_qty=0;
                          
                      }
                      
                       }
          } }
                  
 
$weight=0; $qty=0;$unittype='';$ratetype=''; $return_value_qty=0;$tax='';  $return_value_weight=0; $return_value1_qty=0; $return_value1_weight=0; $name5='';

if($_REQUEST['batch']!=''){
$sql_login  =  $database->mysqlQuery("select tg_name,tg_tax_percent,tg_rate_type,tg_unittype,tg_weight,tg_qty from tbl_grn_order where tg_grn_id='".$_REQUEST['grn']."' and   tg_product ='".$_REQUEST['product']."' and tg_batch_id='".$_REQUEST['batch']."'  "); 
}else{
    
   $sql_login  =  $database->mysqlQuery("select tg_name,tg_tax_percent,tg_rate_type,tg_unittype,tg_weight,tg_qty from tbl_grn_order where tg_grn_id='".$_REQUEST['grn']."' and   tg_product ='".$_REQUEST['product']."'  "); 
 
    
}        
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ 
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $weight=$result_login['tg_weight'];
                      $qty=$result_login['tg_qty']; 
                      $unittype=$result_login['tg_unittype']; 
                      $ratetype=$result_login['tg_rate_type']; 
                      
                      $tax=$result_login['tg_tax_percent']; 
                      $name5=$result_login['tg_name']; 
                      
                      if($unittype=='Nos' || $unittype=='Single' ){
                      
                        $return_value_qty= $qty;
                        $return_value_weight=0; 
                      
                      }else{
                          
                          if($ratetype=='Packet' && ($unittype=='Nos' || $unittype=='KG' || $unittype=='LTR') ){
                          
                          $return_value_qty=$qty;
                          $return_value_weight=0;
                          }else{
                              
                             $return_value_qty=0;
                          $return_value_weight=$weight; 
                              
                          }
                          
                          
                     }
                      
          } }
          
         $qty1=0;  $weight1=0;
         
   if($_REQUEST['batch']!=''){      
    $sql_login  =  $database->mysqlQuery("select * from tbl_purchase_return where tpr_grn='".$_REQUEST['grn']."' and  tpr_menu='".$_REQUEST['product']."' and tpr_set='Y' and tpr_batch='".$_REQUEST['batch']."'  "); 
   }else{
      $sql_login  =  $database->mysqlQuery("select * from tbl_purchase_return where tpr_grn='".$_REQUEST['grn']."' and  tpr_menu='".$_REQUEST['product']."' and tpr_set='Y'  "); 
   
       
   }      
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ 
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                       $weight1=$weight1+$result_login['tpr_weight'];
                      $qty1=$qty1+$result_login['tpr_qty']; 
                      $unittype1=$result_login['tpr_unit_type']; 
                      $ratetype1=$result_login['tpr_rate_type']; 
                      
                      $tax1=$result_login['tp_tax']; 
                      
                      if($unittype1=='Nos' || $unittype1=='Single' ){
                      
                         $return_value1_qty= $qty1;
       
                         $return_value1_weight=0; 
                     
                      }else{
                          
                          if($ratetype1=='Packet' && ($unittype=='Nos' || $unittype1=='KG' || $unittype1=='LTR')){ 
                              
                          $return_value1_qty=$qty1;
                          $return_value1_weight=0;
                          
                          }else{
                              
                          $return_value1_qty=0;
                          $return_value1_weight=$weight1;
                          
                          }
                          
                      }
                      
          } }
              
      $actual_return_qty=($return_value_qty-$return_value1_qty);
       
      $actual_return_weight=($return_value_weight-$return_value1_weight);
       
    ?>

<div style="padding :1px;padding-bottom: 10px;color:#394e6c" class="quick_pop_printer_head" id="menu_head" > <?=$name5?></div> <span id="error_rtn" style="color:red">.</span>

 <div style="padding :1px;padding-bottom: 10px;" class="quick_pop_printer_head" > Grn  Qty : [<?=($actual_return_qty)?>] | Wgt : [<?=($actual_return_weight)?>] </div>
 
  <div  class="quick_pop_printer_head" style="font-size:11px;color: darkred;padding :1px;display: none" > [  Store  Qty : <?=($actual_srore_qty)?> | Wgt : <?=($actual_store_weight)?> ]</div>        
  <div style="display:grid;grid-template-columns:1fr 1fr 0fr; ">
 
 <?php
 $sql_login5  =  $database->mysqlQuery("select ts_rate_type,ti_name,ts_store,ts_unit,sum(ts_qty) as qty,sum(ts_weight) wt from tbl_store_stock left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_store_stock.ts_store where ts_product ='".$_REQUEST['product']."' group by ts_store "); 
            
	  $num_login5   = $database->mysqlNumRows($sql_login5);
	  if($num_login5){ 
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{
                      
                       if($result_login5['ts_unit']=='Nos' || $result_login5['ts_unit']=='Single' ){
                         $actual_srore_qty5=$result_login5['qty'];
                         $actual_store_weight5=0;
                     
                       }else{
                           
                           if($result_login5['ts_rate_type']=='Packet' && ($result_login5['ts_unit']=='Nos' || $result_login5['ts_unit']=='KG' || $result_login5['ts_unit']=='LTR') ){ 
                               
                         $actual_store_weight5=0;
                         $actual_srore_qty5=$result_login5['qty'];
                           }else{
                               
                         $actual_store_weight5=$result_login5['wt'];
                         $actual_srore_qty5=0;
                           }
                         
                       }
                       
                      ?>
 
              <div class="quick_pop_printer_head" style="font-size:11px;color: darkred;padding :1px;padding-bottom: 10px;" >   <?=$result_login5['ti_name']?>  Qty : <?=($actual_srore_qty5)?> | Wgt : <?=($actual_store_weight5)?> </div>        
              
       <?php  } } ?>
     
    </div>       
  
 <div style="overflow-y: auto ">
 
 <div style="height:100px;">

    <input type="hidden" id="return_value_qty" value="<?=$actual_return_qty?>">
    <input type="hidden" id="return_value_weight" value="<?=$actual_return_weight?>">
    <?php
        
     $tax_r1='';
     $unit_r1='';
     $rate_r1='';
    
 //echo "select * from tbl_store_stock  left join  tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_store_stock.ts_store where tbl_store_stock.ts_product='".$_REQUEST['product']."' ";
 $sql_login1  =  $database->mysqlQuery("select * from tbl_store_stock  left join  tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_store_stock.ts_store  where tbl_store_stock.ts_product='".$_REQUEST['product']."' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      if($result_login1['ts_unit']=='Nos' || $result_login1['ts_unit']=='Single' ){
                      
                          $qt_wt_chk= $result_login1['ts_qty'];
                         
                          $qt_1=$result_login1['ts_qty'];
                         
                          $wt_1=0;
                          
                      }else{
                          
                           if( $result_login1['ts_rate_type']=='Packet'  && ($result_login1['ts_unit']=='Nos' || $result_login1['ts_unit']=='KG' || $result_login1['ts_unit']=='LTR') ){
                          
                          $qt_wt_chk=$result_login1['ts_qty'];
                          
                          $qt_1=$result_login1['ts_qty'];
                         
                          $wt_1=0;
                          
                           }else{
                               
                          $qt_wt_chk=$result_login1['ts_weight'];
                          
                          $qt_1=0;
                         
                          $wt_1=$result_login1['ts_weight'];
                          
                           }
                          
                          
                     }
           if($_REQUEST['batch']!=''){               
          $sql_login19  =  $database->mysqlQuery("select tg_unittype,tg_tax_percent,tg_unit_rate from tbl_grn_order where tg_product='".$_REQUEST['product']."' and tg_grn_id='".$_REQUEST['grn']."'  and tg_batch_id='".$_REQUEST['batch']."' "); 
           }else{
               
              $sql_login19  =  $database->mysqlQuery("select tg_unittype,tg_tax_percent,tg_unit_rate from tbl_grn_order where tg_product='".$_REQUEST['product']."' and tg_grn_id='".$_REQUEST['grn']."'   "); 
            
               
           }
	  $num_login19   = $database->mysqlNumRows($sql_login19);
	  if($num_login19){ 
		  while($result_login19  = $database->mysqlFetchArray($sql_login19)) 
			{
                      $tax_r1=$result_login19['tg_tax_percent'];
                       $unit_r1=$result_login19['tg_unittype'];
                        $rate_r1=$result_login19['tg_unit_rate'];
          } }
       ?>

    <div class="inv-pr-drop" style="display:flex; justify-content:center;align-items: center;">
             
     <select id="store" class="store" style="pointer-events: none ">
                
    <option value="<?=$result_login1['ti_id']?>"> <?=$result_login1['ti_name']?></option>
        
    </select>
        
        <?php  $wt=0; 
        
           if($_REQUEST['batch']!=''){       
        $sql_login12  =  $database->mysqlQuery("select * from tbl_purchase_return where tpr_menu='".$_REQUEST['product']."' and tpr_set='N' and tpr_grn='".$_REQUEST['grn']."' and tpr_store='".$result_login1['ti_id']."' and tpr_batch='".$_REQUEST['batch']."' "); 
         
        }else{
              $sql_login12  =  $database->mysqlQuery("select * from tbl_purchase_return where tpr_menu='".$_REQUEST['product']."' and tpr_set='N' and tpr_grn='".$_REQUEST['grn']."' and tpr_store='".$result_login1['ti_id']."'  "); 
           
           }
           
	  $num_login12   = $database->mysqlNumRows($sql_login12);
	  if($num_login12){ 
		  while($result_login12  = $database->mysqlFetchArray($sql_login12)) 
			{
                    
                      if($result_login12['tpr_unit_type']=='Nos' || $result_login12['tpr_unit_type']=='Single' ){
                      
                         $qt_wt= $result_login12['tpr_qty'];
                         
                         $qt_wt1=0;
                           if($result_login12['tpr_rate_type']=='Packet'){
                               
                               $wt=$result_login12['tpr_weight'];
                           }
                          
                      }else{
                          
                           if($result_login12['tpr_rate_type']=='Packet' && ($result_login12['tpr_unit_type']=='Nos' || $result_login12['tpr_unit_type']=='KG' || $result_login12['tpr_unit_type']=='LTR') ){
                         
                          $qt_wt=$result_login12['tpr_qty'];
                          $qt_wt1=0;
                          
                           }else{
                               
                          $qt_wt=0;
                          $qt_wt1=$result_login12['tpr_weight'];
                           }
                          
                      }
                      
         if($result_login12['tpr_store']==$result_login1['ti_id']){ ?>
        &nbsp; Qty :
        <input  style="margin-top: 2px;"  placeholder=" Qty" onclick="click_chk('<?=$result_login1['ti_id']?>')"  tax='<?=$tax_r1?>'  unit_type='<?=$unit_r1?>'   rate_type='<?=$result_login1['ts_rate_type']?>'  unit_rate='<?=$rate_r1?>' onkeypress="return numdot(this,event);" <?php if($result_login12['tpr_store']==$result_login1['ti_id']){ ?> value="<?=$qt_wt?>" <?php } ?>  id="qty_<?=$result_login12['tpr_store']?>"  type="text"  class="inv-pr-Value qty_1 qt_cls grn-input"  qty_all='<?=$actual_return_qty?>' weight_all='<?=$actual_return_weight?>' qt_st='<?=$qt_1?>' wt_st='<?=$wt_1?>'       onkeyup="check_qty('<?=$actual_return_qty?>','<?=$actual_return_weight?>','<?=$qt_1?>','<?=$wt_1?>','<?=$result_login1['ti_id']?>')" >
         &nbsp; Wgt : 
        <input  style="margin-top: 2px;"   placeholder=" Weight" tax='<?=$tax_r1?>'  onclick="click_chk_wt('<?=$result_login1['ti_id']?>')" unit_type='<?=$unit_r1?>'   rate_type='<?=$result_login1['ts_rate_type']?>'  unit_rate='<?=$rate_r1?>' onkeypress="return numdot(this,event);" <?php if($result_login12['tpr_store']==$result_login1['ti_id']){ ?> value="<?=$qt_wt1?>" <?php } ?>  id="weight_<?=$result_login12['tpr_store']?>" type="text"  class="inv-pr-Value weight_1 wt_cls grn-input"  qty_all='<?=$actual_return_qty?>' weight_all='<?=$actual_return_weight?>' qt_st='<?=$qt_1?>' wt_st='<?=$wt_1?>' onkeyup="check_qty('<?=$actual_return_qty?>','<?=$actual_return_weight?>','<?=$qt_1?>','<?=$wt_1?>','<?=$result_login1['ti_id']?>')" >    
             
        <?php } 
        
          } }else{ ?>
          &nbsp; Qty :
          <input  style="margin-top: 2px;" value="0"  placeholder="Qty" onclick="click_chk('<?=$result_login1['ti_id']?>')"   onkeypress="return numdot(this,event);" tax='<?=$tax_r1?>'   unit_type='<?=$unit_r1?>'   rate_type='<?=$result_login1['ts_rate_type']?>' id="qty_<?=$result_login1['ti_id']?>" unit_rate='<?=$rate_r1?>' type="text" class="inv-pr-Value qty_1 grn-input qt_cls" qty_all='<?=$actual_return_qty?>' weight_all='<?=$actual_return_weight?>' qt_st='<?=$qt_1?>' wt_st='<?=$wt_1?>' onkeyup="check_qty('<?=$actual_return_qty?>','<?=$actual_return_weight?>','<?=$qt_1?>','<?=$wt_1?>','<?=$result_login1['ti_id']?>')" >
        
          &nbsp; Wgt :
          <input  grn-input style="margin-top: 2px;" value="0" placeholder="Weight" onclick="click_chk_wt('<?=$result_login1['ti_id']?>')" onkeypress="return numdot(this,event);" tax='<?=$tax_r1?>'   unit_type='<?=$unit_r1?>'   rate_type='<?=$result_login1['ts_rate_type']?>' id="weight_<?=$result_login1['ti_id']?>" unit_rate='<?=$rate_r1?>' type="text"  class="inv-pr-Value weight_1 grn-input wt_cls" qty_all='<?=$actual_return_qty?>' weight_all='<?=$actual_return_weight?>' qt_st='<?=$qt_1?>' wt_st='<?=$wt_1?>' onkeyup="check_qty('<?=$actual_return_qty?>','<?=$actual_return_weight?>','<?=$qt_1?>','<?=$wt_1?>','<?=$result_login1['ti_id']?>')" >
        
         <?php } ?>
    </div>

    <?php  } }  ?>
         
    </div>
       </div>        
        <div class="quick_pop_printer_content " style="margin-top: auto;" >
     
       <div onclick="approve_submit('<?=$_REQUEST['grn']?>','<?=$_REQUEST['product']?>','<?=$_REQUEST['batch']?>');"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">SUBMIT</span></div>

       <div onclick="close_pop();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">CLOSE</span></div>        
       </div>

<?php
         
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='purchase_return_entry'){
    
           
         $sql_login  =  $database->mysqlQuery("select ti_return_id from tbl_inv_settings limit 1  "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      $inv_req=$result_login['ti_return_id'];
                  }
                  }
                  
                  
                  
          $return_id='Ret_'.$inv_req;  
          
          if($_REQUEST['batch']!=''){
          $sql_login55  =  $database->mysqlQuery("select tpr_return_id from tbl_purchase_return where tpr_set='N' and  tpr_store='".$_REQUEST['store']."' and tpr_menu='".$_REQUEST['product']."' and tpr_grn='".$_REQUEST['grn']."' and tpr_batch='".$_REQUEST['batch']."' "); 
          }else{
            $sql_login55  =  $database->mysqlQuery("select tpr_return_id from tbl_purchase_return where tpr_set='N' and  tpr_store='".$_REQUEST['store']."' and tpr_menu='".$_REQUEST['product']."' and tpr_grn='".$_REQUEST['grn']."' ");    
              
          }
	  $num_login55   = $database->mysqlNumRows($sql_login55);
	  if($num_login55){
              
             if($_REQUEST['batch']!=''){  
            $sql_login66  =  $database->mysqlQuery("update  tbl_purchase_return set tpr_final='".$_REQUEST['final']."'  ,tpp_tax_rate='".$_REQUEST['tax_rate']."'  , tp_tax='".$_REQUEST['tax']."'  , tpr_total='".$_REQUEST['total']."'  ,  tpr_rate='".$_REQUEST['rate']."'  , tpr_qty='".$_REQUEST['qty']."'  ,tpr_weight='".$_REQUEST['weight']."'    where tpr_store='".$_REQUEST['store']."' and tpr_menu='".$_REQUEST['product']."' and tpr_grn='".$_REQUEST['grn']."' and tpr_batch='".$_REQUEST['batch']."'  ");
              }else{
            $sql_login66  =  $database->mysqlQuery("update  tbl_purchase_return set tpr_final='".$_REQUEST['final']."'  ,tpp_tax_rate='".$_REQUEST['tax_rate']."'  , tp_tax='".$_REQUEST['tax']."'  , tpr_total='".$_REQUEST['total']."'  ,  tpr_rate='".$_REQUEST['rate']."'  , tpr_qty='".$_REQUEST['qty']."'  ,tpr_weight='".$_REQUEST['weight']."'    where tpr_store='".$_REQUEST['store']."' and tpr_menu='".$_REQUEST['product']."' and tpr_grn='".$_REQUEST['grn']."'  ");
              
          }
            
            
          }else{ 
    
         $insertion['tpr_store']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['store']));
         
         $insertion['tpr_return_id']= mysqli_real_escape_string($database->DatabaseLink,trim($return_id));
        
         $insertion['tpr_menu']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['product']));
         
          $insertion['tpr_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['total']));
          
          if($_REQUEST['batch']!=''){
          $insertion['tpr_batch']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['batch']));
          }
          
          if($_REQUEST['qty']!=''){
           $insertion['tpr_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
          }
          
         if($_REQUEST['weight']!=''){
         $insertion['tpr_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
         }
         
         $insertion['tpr_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate']));
        
         $insertion['tp_tax']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax']));
         
         $insertion['tpp_tax_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tax_rate']));
        
         $insertion['tpr_final']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['final']));
         
         $insertion['tpr_date']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
         $insertion['tpr_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
         
	 $insertion['tpr_grn']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['grn']));
           
         $insertion['tpr_unit_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['unit_type']));
            
         $insertion['tpr_rate_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_type']));
             
         $insertion['tpr_set']= mysqli_real_escape_string($database->DatabaseLink,'N');
         
    $sql=$database->check_duplicate_entry('tbl_purchase_return',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_purchase_return',$insertion);   
    
        }
        
   }
          
          
          
          
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_history_return'){
    
    
    $string='';
    
   
    if($_REQUEST['id']!=''){
    $string.=" and tpr_return_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['grn_id']!=''){
       $string.=" and tg_grn_id like '%".$_REQUEST['grn_id']."%'   ";
    }
    
    
     if($_REQUEST['supplier']!=''){
       $string.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
    }
    
     if($_REQUEST['staff']!=''){
       $string.=" and tpr_login = '".$_REQUEST['staff']."'   ";
    }
    
    
   
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  tpr_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                       
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  tpr_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and tpr_date between '".$from."' and '".$_REQUEST['todt']."' ";
                        
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tpr_date between '".$from."' and '".$to."' ";
                        
                }
                
           ?>

   <table class="table table-bordered table-striped" >
   <thead>
   <tr> <th scope="col">Sl</th>
     
   <th scope="col">RET ID</th>
   <th scope="col">Supplier</th>
   <th scope="col">Date</th>
   <th scope="col">Grn ID</th>
   <th scope="col">Remarks</th>
   <th scope="col">Return By</th>
   <th scope="col">Tax Amt </th>
   <th scope="col">Ret Amount</th>
   </tr>
   </thead>
   
  <tbody >
      
 
<?php
        
$pagination=0;
$recordcount="";
if(isset($_REQUEST['pagination']))
{
$pagination= $_REQUEST['pagination'];
$recordcount=$_REQUEST['recordcount'];

}


    if($recordcount!=""){
          $i=$recordcount;
      }else{
          $i=0;
    }
    
    
    $total1=0;  $total_tax=0; $sup='';  $total=0;    $total_tx=0;  
         
    $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tpr_final) as total,sum(tpp_tax_rate) as total_tax from tbl_purchase_return left join tbl_grn_order on tbl_grn_order.tg_grn_id=tbl_purchase_return.tpr_grn where tpr_set='Y' $string group by tpr_return_id  order by tpr_id desc limit ". $pagination.",10 "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                
   $sql_kotlist1  =  $database->mysqlQuery("SELECT v_name from  tbl_vendor_master where v_id= '".$result_kotlist['tg_supplier']."' "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                               $sup=$result_kotlist1['v_name'];    
                                        }}
                                                      
                                                      
                                                      $total=$result_kotlist['tpr_final'];
                                                     $total_tx=$result_kotlist['tpp_tax_rate'];  
                                                      
                                                      $i++;
                                                      ?>
<tr>
    <td><?=$i?></td>
      
    <td  onclick="return_details('<?=$result_kotlist['tpr_return_id']?>','<?=$sup?>')" > <span style="color:darkred;font-weight: bold;cursor: pointer;border: solid 1px;padding: 3px"><?=$result_kotlist['tpr_return_id']?></span></td>
      
     <td><?=$sup?></td>
   
      <td><?=$result_kotlist['tpr_date']?></td>
      <td><?=$result_kotlist['tpr_grn']?></td>
         <td><?=$result_kotlist['tpr_remarks']?></td>
           <td><?=$result_kotlist['tpr_login']?></td>
             <td><?=number_format($result_kotlist['tpp_tax_rate'],$_SESSION['be_decimal']) ?></td>
        <td><?=number_format($result_kotlist['tpr_final'],$_SESSION['be_decimal']) ?></td>
     
    </tr>

                                                   <?php
               $total1=$total1+$total;                                 
               $total_tax= $total_tax+$total_tx;                                   
      }  }else{
          
          ?>
          
    <tr style="color: red">
        <td></td>
        <td  ></td>
      <td></td>  
       <td></td>  
      <td>NO DATA</td>
        <td></td> 
        <td></td>
        
      <td></td>
         <td></td>
        
        
    </tr>
          
          <?php
      }
      
     ?>
<tr>
    <td style="font-weight:bold ">Total</td>
      
    <td  ></td>
      <td></td>
      <td></td>
         <td></td>
         <td></td>
           <td></td>
           <td style="font-weight:bold "><?=  number_format($total_tax,$_SESSION['be_decimal'])?></td>
         <td style="font-weight:bold "><?=  number_format($total1,$_SESSION['be_decimal'])?></td>
     
    </tr>
    
     
     </tbody>
  
  </table>

   <div class="inv-pagination" style="bottom: -10px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div> 
     
     <?php

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='purchase_return_detail'){
    
    ?>
<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Return Id : <?=$_REQUEST['id']?>   | Supplier : <?=$_REQUEST['sup']?></div>
<div  style="overflow:scroll; width: 750px; height: 550px;" >

    <div class="inv-pr-drop">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
              <tr><th>Product</th>
             <th>Return Qty</th>
              <th>Return Weight</th>
             
               <th>Store</th>
              <th>Date</th>
              <th>Batch</th>
               <th>Tax Amt</th>
               <th>Amount</th>
            </tr>

              
            </thead>  
            
            <tbody >
            
             
           <?php
        
             $total=0; $total_tax=0;
       $sql_login1  =  $database->mysqlQuery("select * from  tbl_purchase_return left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_return.tpr_menu left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_return.tpr_store where tpr_return_id='".$_REQUEST['id']."' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      
                        $total_tax=$total_tax+$result_login1['tpp_tax_rate'];
                        $total=$total+$result_login1['tpr_final'];
                      ?>
                
                 <tr>
                      
                      <td><?=$result_login1['mr_menuname']?></td>
                      <td><?=$result_login1['tpr_qty']?></td>
                      <td><?=$result_login1['tpr_weight']?></td>
                     
                      <td><?=$result_login1['ti_name']?></td>
                      <td><?=$result_login1['tpr_date']?></td>
                      <td><?=$result_login1['tpr_batch']?></td>
                      <td><?=number_format($result_login1['tpp_tax_rate'],$_SESSION['be_decimal']) ?></td>
                      <td><?=number_format($result_login1['tpr_final'],$_SESSION['be_decimal']) ?></td>
                      
                 </tr>
                
                
              <?php } } ?>
              
             
                 <tr>
                      
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                       <td></td>
                       <td><?=number_format($total_tax,$_SESSION['be_decimal'])?></td>
                      <td><?=number_format($total,$_SESSION['be_decimal'])?></td>
                      
                 </tr>
                  
            </tbody> 
            
        </table>
       
    </div>

    </div>
       
<?php
         
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_purchase_return'){
    
    $grn_id=$_REQUEST['grn_id'];
    
     
          $sql_login1  =  $database->mysqlQuery("select * from  tbl_purchase_return where tpr_grn='".$_REQUEST['grn_id']."' and tpr_set='N' "); 
          $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      
                     
           if($result_login1['tpr_unit_type']!='Single' && $result_login1['tpr_unit_type']!='Nos' ){
               
                 if( $result_login1['tpr_rate_type']=='Packet' && ($result_login1['tpr_unit_type']=='KG' || $result_login1['tpr_unit_type']==='LTR') ){
                $sql_login15 =  $database->mysqlQuery("update  tbl_store_stock set ts_qty=(ts_qty-'".$result_login1['tpr_qty']."') , ts_total=(ts_qty*ts_unit_price)  where ts_product='".$result_login1['tpr_menu']."' and ts_store='".$result_login1['tpr_store']."' ");         
                 }else{
                   $sql_login15 =  $database->mysqlQuery("update  tbl_store_stock set ts_weight=(ts_weight-'".$result_login1['tpr_weight']."') , ts_total=(ts_weight*ts_unit_price)  where ts_product='".$result_login1['tpr_menu']."' and ts_store='".$result_login1['tpr_store']."' ");         
                      
                 }
                
                //echo "update  tbl_store_stock set ts_weight=(ts_weight-'".$result_login1['tpr_weight']."')   where ts_product='".$result_login1['tpr_menu']."' and ts_store='".$result_login1['tpr_store']."' ";
            }else{
                
                $sql_login15 =  $database->mysqlQuery("update  tbl_store_stock set ts_qty=(ts_qty-'".$result_login1['tpr_qty']."') , ts_total=(ts_qty*ts_unit_price)   where ts_product='".$result_login1['tpr_menu']."' and ts_store='".$result_login1['tpr_store']."' ");                      
                //echo    "update  tbl_store_stock set ts_qty=(ts_qty-'".$result_login1['tpr_qty']."')   where ts_product='".$result_login1['tpr_menu']."' and ts_store='".$result_login1['tpr_store']."' ";
            }
                
                
                     
                  }
                  }
                  
                  
                  
             $ret_amount=0; $inv='';
       $sql_login17  =  $database->mysqlQuery("select sum(tpr_final) as final,tgs_invoice_no from  tbl_purchase_return left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_purchase_return.tpr_grn   where tpr_grn='".$_REQUEST['grn_id']."' and tpr_set='N'  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){ 
		  while($result_login17  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                      $ret_amount=$result_login17['final'];
                      $inv=$result_login17['tgs_invoice_no'];
                  }
                  }           
      
        $sql_login  =  $database->mysqlQuery("update tbl_supplier_voucher set sv_return_amount=(sv_return_amount+'".$ret_amount."')   where sv_type_pay='First' and  sv_invoice_no='$inv'  ");    
                  
                  
                  
      if($_REQUEST['remarks']!=''){
        
        $sql_login  =  $database->mysqlQuery("update tbl_purchase_return set tpr_set='Y',tpr_remarks='".$_REQUEST['remarks']."'  where tpr_set='N'  "); 
  
      }else{
        
        $sql_login  =  $database->mysqlQuery("update tbl_purchase_return set tpr_set='Y'  where tpr_set='N'  ");   
     }       
           
     $sql_login  =  $database->mysqlQuery("update  tbl_inv_settings set ti_return_id=(ti_return_id+1) "); 
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_history_items'){
    
    $id=$_REQUEST['id'];
    
    $mode=$_REQUEST['mode'];
    
 
    if($mode=='req'){
        
        
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_requisition left join tbl_menumaster on tbl_requisition.tr_product=tbl_menumaster.mr_menuid   where tbl_requisition.tr_req_id='".$id."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                      ?>

                <tr>
                       <td><?=$i++?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                      <td><?=$result_login1['tr_rate_type']?></td>
                      <td><?=$result_login1['tr_unittype']?></td>
                      <td><?=$result_login1['tr_qty']?></td>
                      <td><?=$result_login1['tr_weight']?></td>
                      
                        <td></td>
                          <td></td>
                          
                       <td></td>
                        <td></td> 
                      
                 </tr>

                      
                     <?php
                  }
                  }       
        ?>
     
  
   
 <?php       
        
    }
    
    if($mode=='pur'){
        
        
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_purchase_order left join tbl_menumaster on tbl_purchase_order.tp_product=tbl_menumaster.mr_menuid   where tbl_purchase_order.tp_purchase_id='".$id."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      ?>

                <tr>
                       <td><?=$i++?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                       <td><?=$result_login1['tp_rate_type']?></td>
                      <td><?=$result_login1['tp_unittype']?></td>
                      <td><?=$result_login1['tp_qty']?></td>
                      
                      <td><?=$result_login1['tp_weight']?></td>
                     <td></td>
                          <td></td>
                           
                        <td></td>
                       <td></td>
                 </tr>

                      
                     <?php
                  }
                  }       
        ?>
     
  
   
 <?php       
        
    }
    
    
     if($mode=='grn'){
        
        $tot=0; $tottx=0;
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_grn_order left join tbl_menumaster on tbl_grn_order.tg_product=tbl_menumaster.mr_menuid   where tbl_grn_order.tg_grn_id='".$id."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                      $tot=$tot+$result_login1['tg_final_rate'];
                        $tottx=$tottx+$result_login1['tg_tax_rate'];
                      ?>

                <tr>
                       <td><?=$i++?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                      <td><?=$result_login1['tg_rate_type']?></td>
                      <td><?=$result_login1['tg_unittype']?></td>
                      <td><?=$result_login1['tg_qty']?></td>
                      <td><?=$result_login1['tg_weight']?></td>
                     <td><?=number_format($result_login1['tg_unit_rate'],$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format($result_login1['tg_tax_rate'],$_SESSION['be_decimal']) ?></td>
                     <td><?=$result_login1['tg_batch_id']?></td>     
                     <td><?=number_format($result_login1['tg_final_rate'],$_SESSION['be_decimal']) ?></td>
                      
                 </tr>

                      
                     <?php
                  }
                  
                  ?>
                  
                  <tr>
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                         
                     <td></td>
                      <td></td>
                      
                      <td><?=number_format($tottx,$_SESSION['be_decimal']) ?></td>
                      <td></td>
                      <td><?=number_format($tot,$_SESSION['be_decimal']) ?></td>
                      
                 </tr>
                  
  <?php } ?>
     
  
   
 <?php       
        
  }
  
 }

if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_stock_expiry'){
    
    $id=$_REQUEST['product'];
    
        
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_grn_order  where tg_expiry_date!='' and tg_status='Approved' and tg_product='".$id."' group by tg_product,tg_expiry_date order by tg_expiry_date desc limit 5 "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      ?>

                    <tr>
                       
                      <td><?=$result_login1['tg_qty']?></td>
                      
                      <td><?=$result_login1['tg_weight']?></td>
                      
                      <?php if($result_login1['tg_expiry_date']!=''){ ?>
                      <td><?=$result_login1['tg_expiry_date']?></td>
                      <?php }else{ ?>
                      <td>No Date</td>
                      <?php }?>
                      
                 </tr>

                      
                     <?php
                  }
                  }       
    
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_stock_grn'){
    
    $id=$_REQUEST['product'];
    
        
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_grn_order  where  tg_status='Approved' and tg_product='".$id."' group by tg_product,tg_grn_id order by tg_grn_id desc limit 5 "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      ?>

                <tr>
                       
                      <td><?=$result_login1['tg_qty']?></td>
                      
                      <td><?=$result_login1['tg_weight']?></td>
                      
                     
                      <td><?=$result_login1['tg_grn_id']?></td>
                     
                      
                 </tr>

                      
                     <?php
                  }
                  }       
    
    
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=='store_load_transfer'){
    
  
    
    if($_REQUEST['mode']=='from'){
        
    ?>

    <select style="border-radius:6px;width: 100px;background-color:darkred;color:white;" onchange="store_to()"  id="to_store" >
    <option value="">To Store</option>
    <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' and ti_id!='".$_REQUEST['from']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option  value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
          <?php } } ?>
    
  </select>

                      
                     <?php
                  
                  
        }else{
            ?>
                 
                 <select style="border-radius:6px;width: 100px;background-color:darkred;color:white;" onchange="store_to()"  id="from_store" >
    <option value="">From Store</option>
      <?php 
    $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' and ti_id!='".$_REQUEST['to']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  ?>
              
    <option  value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
          <?php } } ?>
    
    </select>
            
         <?php   
        }
    
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_transfer_items'){
    
    ?>
<div onclick="close_pop()" style="position: absolute;right: 15px;top: 15px;cursor: pointer "><i class="fa fa-times-circle-o fa-2x" aria-hidden="true"></i></div>
<div class="quick_pop_printer_head" > Transfer Id : <?=$_REQUEST['id']?> </div>
<div  style="overflow:auto; width: 750px; height: 450px;" >

    <div class="inv-pr-drop">
             
        <table class="table table-bordered table-striped" >
            
            <thead>
               
              <tr>
                  <th>Product</th>
                  <th>Date</th>  
             <th>Transfer Qty</th>
              <th>Transfer Weight</th>
             
             
               <th>Rate </th>
               <th>Amount</th>
               
            </tr>

              
            </thead>  
            
            <tbody >
            
             
           <?php
       $total=0; $total_tx=0;
       $sql_login1  =  $database->mysqlQuery("select * from  tbl_store_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_transfer.tt_product left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_store_transfer.tt_from_store where tbl_store_transfer.tt_trn_id='".$_REQUEST['id']."' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      
                     $total=$total+$result_login1['tt_total'];
                       $total_tx=$total_tx+$result_login1['tt_tax_value'];
                      ?>
                
                 <tr>
                       <td><?=$result_login1['tt_dayclosedate']?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                      <td><?=$result_login1['tt_qty']?></td>
                      <td><?=$result_login1['tt_weight']?></td>
                     
                       <td><?=number_format($result_login1['tt_rate'],$_SESSION['be_decimal']) ?></td>
                       <td><?=number_format($result_login1['tt_total'],$_SESSION['be_decimal']) ?></td>
                      
                 </tr>
                
                
              <?php } } ?>
              
             <tr>
                      
                      <td>Total</td>
                      <td></td>
                     
                     
                      <td></td>
                      <td></td>
                       <td><?=  number_format($total_tx,$_SESSION['be_decimal'])?></td>
                      <td><?=  number_format($total,$_SESSION['be_decimal'])?></td>
                      
                 </tr>
              
                  
            </tbody> 
            
            
            
        </table>
        
       
       
                  
        
    </div>
    <?php if($_REQUEST['mode']=='accept'){ ?>
    
    <div onclick="approve_submit('<?=$_REQUEST['id']?>');" style="margin-top: 235px;margin-left: 310px"  class=" inv-popup-btn"><span id="submit_quick_print">ACCEPT</span></div>
       
    <?php } ?>
    </div>
       
<?php
         
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_user'){
    

     $sql_login1  =  $database->mysqlQuery("select ser_physical_stock_permission from  tbl_staffmaster where ser_physical_stock_permission='Y' and ser_authorisation_code='".$_REQUEST['pin']."' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
             echo  'yes' ;
           }else{
             echo 'no' ;  
          }
		  
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_user_wastage'){
    
     $sql_login1  =  $database->mysqlQuery("select ser_wastage_entry from  tbl_staffmaster where ser_wastage_entry='Y' and ser_authorisation_code='".$_REQUEST['pin']."' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
             echo  'yes' ;
           }else{
             echo 'no' ;  
          }
		  
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='clear_stock_all'){
      $sql_login1  =  $database->mysqlQuery("delete from tbl_grn_order where tg_set='N' "); 
     
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='return_store_check'){
    
     
     $sql_login1  =  $database->mysqlQuery("select ts_weight,ts_unit,ts_qty  from  tbl_store_stock  where ts_product='".$_REQUEST['product']."' and ts_store='".$_REQUEST['store']."'  "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      
                  if($result_login1['ts_unit'] || $result_login1['ts_unit']){
                      
                      echo $result_login1['ts_qty'];
                      
                  }else{
                      
                       echo $result_login1['ts_weight'];
                       
                  }
                  
          }}else{
              echo '0';
          }
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='clear_purchase_return'){
    
      $sql_login1  =  $database->mysqlQuery("delete from tbl_purchase_return where tpr_set='N' "); 
     
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='proceed_production'){
   
    $recip_yield='';
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_production where tp_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
              
                  
          $sql_login19  =  $database->mysqlQuery("select ts_qty from tbl_store_stock  where ts_product='".$result_fnctvenue5['tp_product']."' and ts_store='".$result_fnctvenue5['tp_store']."'  "); 
            
	  $num_login19   = $database->mysqlNumRows($sql_login19);
	  if($num_login19){ 
                  
                  
                  if($result_fnctvenue5['tp_qty']>0){
                      $fnct_menu27 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue5['tp_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue5['tp_product']."' and ts_store='".$result_fnctvenue5['tp_store']."'  ");
                  }
                  
                  if($result_fnctvenue5['tp_weight']>0){
                         $fnct_menu27 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$result_fnctvenue5['tp_weight']."') , ts_total=(ts_unit_price*ts_weight),ts_average= (ts_total/ts_weight)  where ts_product='".$result_fnctvenue5['tp_product']."' and ts_store='".$result_fnctvenue5['tp_store']."'  ");
                  } 
                  
          }else{
              
          $sql_login1  =  $database->mysqlQuery("select mr_menuid from tbl_menumaster  where mr_menuid='".$result_fnctvenue5['tp_product']."' and mr_product_type!='Menu' "); 
            
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
                
               $fnct_menu27 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_store`, `ts_product`,`ts_qty`,"
                       . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_unit_price`, `ts_total`,"
                       . "  ts_reorder "
                       . " ) VALUES ( "
                       . "  '".$result_fnctvenue5['tp_store']."' ,'".$result_fnctvenue5['tp_product']."','".$result_fnctvenue5['tp_qty']."',"
                       . " '".$result_fnctvenue5['tp_weight']."','".$result_fnctvenue5['tp_unit_type']."','".$result_fnctvenue5['tp_rate_type']."',"
                       . " '0','0','0','0')");
              
          }
               
            }
                  
                  
         if($result_fnctvenue5['tp_portion']!='' && $result_fnctvenue5['tp_portion']!='undefined' ){         
         $sql_login1  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail  where tmi_menuid='".$result_fnctvenue5['tp_product']."' and tmi_portion='".$result_fnctvenue5['tp_portion']."' "); 
         }else{
             
            $sql_login1  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail  where tmi_menuid='".$result_fnctvenue5['tp_product']."'  "); 
            
         }
         
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){ 
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{  
                      
               
                   if($result_fnctvenue5['tp_qty']>0){
                  $recip_yield_qty=($result_login1['tmi_ing_qty']/$result_login1['tmi_yield'])*$result_fnctvenue5['tp_qty'];     
                          
                  $recip_yield_wgt=  ($result_login1['tmi_weight']/$result_login1['tmi_yield'])*$result_fnctvenue5['tp_qty'];     
                   }
                   
                   
                    if($result_fnctvenue5['tp_weight']>0){
                  $recip_yield_qty=($result_login1['tmi_ing_qty']/$result_login1['tmi_yield'])*$result_fnctvenue5['tp_weight'];     
                          
                  $recip_yield_wgt=  ($result_login1['tmi_weight']/$result_login1['tmi_yield'])*$result_fnctvenue5['tp_weight'];     
                   }
        
       if($result_login1['tmi_ing_unit']=='Single' || $result_login1['tmi_ing_unit']=='Nos'){
     
         $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$recip_yield_qty."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login1['tmi_ing_menuid']."' and ts_store='".$result_login1['tmi_store']."'  ");
   // echo "update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tc_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue5['tc_product']."' and ts_store='".$_REQUEST['store']."'  ";
              }else{
                  
                  
               if( $result_login1['tmi_rate_type']=='Packet' && ($result_login1['tmi_ing_unit']=='KG' || $result_login1['tmi_ing_unit']=='Nos' || $result_login1['tmi_ing_unit']=='LTR')){   
                  
                   $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$recip_yield_qty."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_login1['tmi_ing_menuid']."' and ts_store='".$result_login1['tmi_store']."' ");           
           
               }else{
                   $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$recip_yield_wgt."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login1['tmi_ing_menuid']."' and ts_store='".$result_login1['tmi_store']."' ");           
            
               }
           
           
          }
       
          
          }}
          
      
        }}
        
        
        $fnct_menu = $database->mysqlQuery("update tbl_production set  tp_set='Y'  where tp_set='N'  ");
         
        $sql_login  =  $database->mysqlQuery("update tbl_inv_settings set ti_production_id=(ti_production_id+1)  ");  
           
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_conversion'){
   
          $insertion['tpc_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
          
          $insertion['tpc_from_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_menu']));
         
           $insertion['tpc_to_product']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['to_menu']));
          
          $insertion['tpc_from_store']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_store']));
           
          $insertion['tpc_to_store']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['to_store']));
          
         
          
           if($_REQUEST['qty']!=''){
            $insertion['tpc_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty']));
           }else{
             $insertion['tpc_qty']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
          }
       
        
         if($_REQUEST['weight']!=''){
          $insertion['tpc_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
         }else{
             $insertion['tpc_weight']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
         }
         
        
          $insertion['tpc_from_qty']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_qty']));
           
          $insertion['tpc_from_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['from_weight']));
         
         
          $insertion['tpc_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
	
    $sql=$database->check_duplicate_entry('tbl_product_conversion',$insertion);
    if($sql!=1)
	{
	    $insertid              =  $database->insert('tbl_product_conversion',$insertion);   
        
     }
   
   
    
   
   
    $fnct_menu = $database->mysqlQuery("select * from tbl_product_conversion where tpc_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
                
               $unit_rate_from=0;    
             ////from product///      
         $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue5['tpc_from_store']."'  and ts_product='".$result_fnctvenue5['tpc_from_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
         if ($num_fdtl55) {  
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu55))
              {
                   
                   $unit_rate_from=$result_fnctvenue55['ts_unit_price'];
                   
              if($result_fnctvenue55['ts_unit']=='Single' || $result_fnctvenue55['ts_unit']=='Nos'){
     
            $fnct_menu27 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tpc_from_qty']."') , ts_total=(ts_qty * ts_unit_price)   where ts_store='".$result_fnctvenue5['tpc_from_store']."'  and ts_product='".$result_fnctvenue5['tpc_from_product']."'   ");
  
           }else{
                  
           if( $result_fnctvenue55['ts_rate_type']=='Packet' && ($result_fnctvenue55['ts_unit']=='KG' || $result_fnctvenue55['ts_unit']=='LTR')){   
                  
               $fnct_menu28 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue5['tpc_from_qty']."'),ts_total=(ts_qty- * ts_unit_price) where ts_store='".$result_fnctvenue5['tpc_from_store']."'  and ts_product='".$result_fnctvenue5['tpc_from_product']."' ");           
          
          }else{
                   $fnct_menu29 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue5['tpc_from_weight']."'),ts_total=(ts_weight * ts_unit_price)   where ts_store='".$result_fnctvenue5['tpc_from_store']."'  and ts_product='".$result_fnctvenue5['tpc_from_product']."' ");           
           }
           
          }
          
        }}
        
        
          ////to product///   
      
        
        $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue5['tpc_to_store']."'  and ts_product='".$result_fnctvenue5['tpc_to_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
        if ($num_fdtl55) {   
          while ($result_fnctvenue551 = $database->mysqlFetchArray($fnct_menu55))
              {
              
              $qty_sum=0; $wgt_sum=0;
             // echo "select * from tbl_product_conversion where tpc_to_store='".$result_fnctvenue5['tpc_to_store']."'  and tpc_to_product='".$result_fnctvenue5['tpc_to_product']."' ";
         $fnct_menu559 = $database->mysqlQuery("select * from tbl_product_conversion where tpc_to_store='".$result_fnctvenue5['tpc_to_store']."'  and tpc_to_product='".$result_fnctvenue5['tpc_to_product']."' ");
         $num_fdtl559 = $database->mysqlNumRows($fnct_menu559);
        if ($num_fdtl559) {   
          while ($result_fnctvenue5519 = $database->mysqlFetchArray($fnct_menu559))
              {
              $qty_sum= $qty_sum+$result_fnctvenue5519['tpc_qty'];
              $wgt_sum= $wgt_sum+$result_fnctvenue5519['tpc_weight'];
              
        }}
        
           if($result_fnctvenue5['tpc_qty']>0){
                   
                   if($result_fnctvenue5['tpc_from_qty']>0){
                 
            $unt_to_update=( ( ($unit_rate_from*$result_fnctvenue5['tpc_from_qty'])+ $result_fnctvenue551['ts_total']) /  ($qty_sum));
               
                   }
                   
                    if($result_fnctvenue5['tpc_from_weight']>0){
                        
                        
              //echo   $unit_rate_from.'*'.$result_fnctvenue5['tpc_from_weight'].'*'.$result_fnctvenue551['ts_total'].'*'.$qty_sum ;       
                                      
            $unt_to_update=( ( ($unit_rate_from*$result_fnctvenue5['tpc_from_weight'])+ $result_fnctvenue551['ts_total']) /  ($qty_sum));
               
                   }
                
                     
               }
               
               
                if($result_fnctvenue5['tpc_weight']>0){
                    
                    if($result_fnctvenue5['tpc_from_weight']>0){
              $unt_to_update=( ( ($unit_rate_from*$result_fnctvenue5['tpc_from_weight'])+ $result_fnctvenue551['ts_total']) /  ($wgt_sum));
                    }
                    
                     if($result_fnctvenue5['tpc_from_qty']>0){
             $unt_to_update=( ( ($unit_rate_from*$result_fnctvenue5['tpc_from_qty'])+ $result_fnctvenue551['ts_total']) /  ($wgt_sum));
                    }
             
                      
               }
               
               
               
               
               
               
               
            
            if($result_fnctvenue551['ts_unit']=='Single' || $result_fnctvenue551['ts_unit']=='Nos'){
     
               $fnct_menu22 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue5['tpc_qty']."') ,ts_unit_price= '$unt_to_update', ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)   where ts_store='".$result_fnctvenue5['tpc_to_store']."'  and ts_product='".$result_fnctvenue5['tpc_to_product']."'   ");
   
           }else{
                  
             if($result_fnctvenue551['ts_rate_type']=='Packet' && ($result_fnctvenue551['ts_unit']=='KG' || $result_fnctvenue551['ts_unit']=='LTR')){   
                  
               $fnct_menu23 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue5['tpc_qty']."'),ts_unit_price= '$unt_to_update',ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) ,ts_unit_price= (ts_total/ts_qty)  where ts_store='".$result_fnctvenue5['tpc_to_store']."'  and ts_product='".$result_fnctvenue5['tpc_to_product']."' ");           
           
            }else{
               $fnct_menu24 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$result_fnctvenue5['tpc_weight']."'),ts_unit_price= '$unt_to_update',ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) ,ts_unit_price= (ts_total/ts_weight)  where ts_store='".$result_fnctvenue5['tpc_to_store']."'  and ts_product='".$result_fnctvenue5['tpc_to_product']."' ");           
            
            }
           
           }
          
        }}else{
            
        $fnct_menu = $database->mysqlQuery("select * from tbl_product_conversion left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_product_conversion.tpc_to_product "
                      . " left join tbl_base_unit_master on tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit where tbl_product_conversion.tpc_set='N' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if($num_fdtl > 0){
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              {
                  
                     if($result_fnctvenue5['mr_unit_type']!=''){
                                  $bu_name= $result_fnctvenue5['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_fnctvenue5['bu_name']!=''){
                                  $bu_name1= $result_fnctvenue5['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                  
               if($result_fnctvenue5['tpc_qty']>0){
                   
                   if($result_fnctvenue5['tpc_from_qty']>0){
                $new_unit_price=(($unit_rate_from*$result_fnctvenue5['tpc_from_qty'])/($result_fnctvenue5['tpc_qty']));
                   }
                   
                    if($result_fnctvenue5['tpc_from_weight']>0){
                $new_unit_price=(($unit_rate_from*$result_fnctvenue5['tpc_from_weight'])/($result_fnctvenue5['tpc_qty']));
                   }
                
                     $tot_in=($new_unit_price*$result_fnctvenue5['tpc_qty']);
                     
                     
               }
               
               
                if($result_fnctvenue5['tpc_weight']>0){
                    
                    if($result_fnctvenue5['tpc_from_weight']>0){
             $new_unit_price=(($unit_rate_from*$result_fnctvenue5['tpc_from_weight'])/($result_fnctvenue5['tpc_weight']));
                    }
                    
                     if($result_fnctvenue5['tpc_from_qty']>0){
             $new_unit_price=(($unit_rate_from*$result_fnctvenue5['tpc_from_qty'])/($result_fnctvenue5['tpc_weight']));
                    }
             
                       $tot_in=($new_unit_price*$result_fnctvenue5['tpc_weight']);
               }
               
                     
                         
              $fnct_menu27 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_store`, `ts_product`,`ts_qty`,"
                       . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_unit_price`, `ts_total`,"
                       . "  ts_reorder "
                       . " ) VALUES ( "
                       . "  '".$result_fnctvenue5['tpc_to_store']."' ,'".$result_fnctvenue5['tpc_to_product']."','".$result_fnctvenue5['tpc_qty']."',"
                       . " '".$result_fnctvenue5['tpc_weight']."','".$bu_name1."','".$bu_name."',"
                       . " '$new_unit_price','$new_unit_price','$tot_in','0')");
              
              }}
            
        }
        
        
       
      
        }}
   
   $fnct_menu = $database->mysqlQuery("update tbl_product_conversion set tpc_set='Y' where tpc_set='N' ");
   

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_conversion'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
      
      <th  scope="col">From Product</th>
      
      <th scope="col">To Product</th>
       <th  scope="col">From Store</th>
       <th scope="col">To Store </th>
       <th scope="col">From Qty</th>
     <th scope="col">From Weight</th>
        <th scope="col">Qty</th>
     <th scope="col">Weight</th>
     <th scope="col">Date</th>
     <th scope="col">Staff</th>
     
    </tr>
  </thead>
   <tbody>
       
  <?php
    
    
    $string1='';
   
    
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
   
    
      if($_REQUEST['search_id']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['search_id']."%'   ";
    }
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=$_REQUEST['todt'];
                               
                                  $string1.= " and tpc_date between '".$from."' and '".$to."' ";
                       
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$_REQUEST['fromdt'];
                                $to=date("Y-m-d");
                              
                         $string1.= " and tpc_date between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$_REQUEST['todt'];
                               
                              $string1.= " and tpc_date between '".$from."' and '".$to."' ";
                        }
                         else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
                        {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                               
                              $string1.= " and tpc_date between '".$from."' and '".$to."' ";
                        }
                
                 
                        
		
                $sql_kotlist  =  $database->mysqlQuery("SELECT *  from tbl_product_conversion   where tpc_id !=''  $string1  order by tpc_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			if($num_kotlist){ 
		while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			{  
                                    
                                    
                                    
                                    $i++;
                                                  
           ?>

                             <tr>
                           <td><?=$i?></td>
                           
                          
                           
                           
      <?php
         $fnct_menu = $database->mysqlQuery("select mr_menuname from tbl_menumaster where  mr_menuid='".$result_kotlist['tpc_from_product']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
           if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
        ?>
                       <td ><?=$result_fnctvenue['mr_menuname']?></td>
        <?php } } ?>
                  
              
              
                         
             <?php
         $fnct_menu = $database->mysqlQuery("select mr_menuname from tbl_menumaster where  mr_menuid='".$result_kotlist['tpc_to_product']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
           if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
        ?>
                       <td ><?=$result_fnctvenue['mr_menuname']?></td>
        <?php } } ?>       
              
                            
                          
                           
                           
                           
                          
                              
          <?php
        $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tpc_from_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
        <?php } } ?>
                  
             
              
             <?php
        $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tpc_to_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
        <?php } } ?> 
                             
                              <td><?=$result_kotlist['tpc_from_qty']?></td>
                             
                          <td><?=$result_kotlist['tpc_from_weight']?></td>  
                          
                          <td><?=$result_kotlist['tpc_qty']?></td>
                             
                          <td><?=$result_kotlist['tpc_weight']?></td>  
                          
                            <td><?=$result_kotlist['tpc_date']?></td>  
                             
                           <td><?=$result_kotlist['tpc_login']?></td>
                           
                 
</tr>


<?php 
        }
             ?>                           
                                        
<tr style="display:none">
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
               <td style=""></td>
                <td style=""></td>
            <td style=""><?=number_format(0,$_SESSION['be_decimal'])?></td>
                
        
        
        </tr>                            
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_monthly_stock'){
        
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
     <tr> <th scope="col">Sl </th>
     <th  scope="col"> Product</th>
       <th  scope="col">Store</th>
      <th scope="col">Qty</th>
     <th scope="col">Weight</th>
      <th scope="col">Unit</th>
       <th scope="col">Type</th>
     <th scope="col">Rate</th>
     <th scope="col">Total</th>
     
    </tr>
  </thead>
   <tbody>
       
  <?php
  
    $string1='';
   
   $pagination=0;
   $recordcount="";
   if(isset($_REQUEST['pagination']))
  {
   $pagination= $_REQUEST['pagination'];
   $recordcount=$_REQUEST['recordcount'];

  }

    if($recordcount!=""){
        $i=$recordcount;
    }else{
      $i=0;
     }
     
   if($_REQUEST['search_id']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['search_id']."%'   ";
    }
                    
        $string1.= " and tms_date = '".$_REQUEST['fromdt']."'  ";
           $tot=0;           
                $sql_kotlist  =  $database->mysqlQuery("SELECT *  from tbl_monthly_inventory_stock   where tms_id !=''  $string1  order by tms_id desc limit ". $pagination.",10 "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			if($num_kotlist){ 
		while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			{      
                          $i++;
                            $tot=$tot+$result_kotlist['tms_total'];                     
                     ?>

         <tr>
                                 
                           <td><?=$i?></td>
                              
      <?php
         $fnct_menu = $database->mysqlQuery("select mr_menuname from tbl_menumaster where  mr_menuid='".$result_kotlist['tms_product']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
           if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
        ?>
                       <td ><?=$result_fnctvenue['mr_menuname']?></td>
        <?php } } ?>
                  
                       
          <?php
        $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tms_store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  ?>
                             <td ><?=$result_fnctvenue['ti_name']?></td>
        <?php } } ?>
                  
                          <td><?=$result_kotlist['tms_qty']?></td>
                             
                          <td><?=$result_kotlist['tms_weight']?></td>  
                          
                            <td><?=$result_kotlist['tms_unit']?></td>  
                             
                           <td><?=$result_kotlist['tms_type']?></td>
                           
                             <td><?=$result_kotlist['tms_rate']?></td>  
                             
                           <td><?=$result_kotlist['tms_total']?></td>
                           
                 
</tr>


<?php 
        }
             ?>                           
                                        
<tr >
            <td style="">TOTAL</td>
         <td style=""></td>
          <td style=""></td>
           <td style=""></td>
            <td style=""></td>
               <td style=""></td>
                <td style=""></td>
                   <td style=""></td>
            <td style=""><?=number_format($tot,$_SESSION['be_decimal'])?></td>
                
        
        
        </tr>                            
                                        
                                        
               <?php                         
              }else{ ?>
                                            
<tr><td style="color:darkred">NO DATA</td></tr>  
                                            
                                            
                                          <?php  
                                        }

     ?>                                   
        </tbody>
  
  </table>                                 
     <div class="inv-pagination" style="bottom: 0px ">
                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                        $p=floor(($i/10)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+10; } $m=$m-10;?>
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>                                    
                                        
<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='set_monthly_store_stock'){
    
    $date_in=  date('Y-m-01');
    
    $today=    date('Y-m-d');
    
   if($date_in==$today){
    
    $sql_kotlist  =  $database->mysqlQuery("SELECT *  from tbl_store_stock group by ts_store,ts_product  ");
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			if($num_kotlist){ 
		while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			{  
                    
     $sql_kotlist2  =  $database->mysqlQuery("SELECT *  from tbl_monthly_inventory_stock where tms_store='".$result_kotlist['ts_store']."' and tms_product='".$result_kotlist['ts_product']."'  ");
 
                 $num_kotlist2  = $database->mysqlNumRows($sql_kotlist2);
		   if($num_kotlist2){ 
		
                        /////update////    
                            
                 $sql_kotlist667  =  $database->mysqlQuery(" update tbl_monthly_inventory_stock set tms_date='".$today."',"
                         . " tms_qty='".$result_kotlist['ts_qty']."',tms_weight='".$result_kotlist['ts_weight']."',"
                         . " tms_rate='".$result_kotlist['ts_unit_price']."',tms_total='".$result_kotlist['ts_total']."'"
                         . " where tms_store='".$result_kotlist['ts_store']."' and tms_product='".$result_kotlist['ts_product']."'  ");     
                       
                  }else{
                      
                    ////insert////
                    
                 $sql_kotlist66  =  $database->mysqlQuery("INSERT INTO `tbl_monthly_inventory_stock`(`tms_date`, `tms_store`,"
                   . " `tms_product`, `tms_qty`, `tms_weight`, `tms_unit`, `tms_type`, `tms_rate`, `tms_total`) VALUES "
                    . "('".$today."','".$result_kotlist['ts_store']."','".$result_kotlist['ts_product']."','".$result_kotlist['ts_qty']."',"
                    . " '".$result_kotlist['ts_weight']."','".$result_kotlist['ts_unit']."','".$result_kotlist['ts_rate_type']."',"
                    . " '".$result_kotlist['ts_unit_price']."',"
                    . " '".$result_kotlist['ts_total']."')");
                       
                }
                  
                    
      } }
    
   }
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='live_kitchen'){
    
    ?>

<select   id="to_store" style=" width: 100px;   " >
    <option value="">To Store</option>
  <?php 
  $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
   
         $sql_gen =  mysqli_query($localhost1,"select * from tbl_inv_kitchen where ti_status='Y' and branchid='".$_REQUEST['branch']."'  "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
			{
                  ?>
              
    <option  value="<?=$result_fnctvenue['ti_id']?>"><?=$result_fnctvenue['ti_name']?></option>
    
    <?php } } ?>
    
  </select>

<?php
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='send_grn_mail'){

    
    include('..\email\km_smtp_class.php');
require_once('..\Mailer\PHPMailerAutoload.php');
error_reporting(0);


$date=date('Y-m-d H:i:s');
        

   $msg_temp='';
   
   
  $msg_temp.= '<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;" colspan="17">
      
    
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>PURCHASE ORDER : '.  $_SESSION['s_branchname'].'</strong></th>
      </tr>
      
      <tr >
      <th style="font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Supplier : '. $_REQUEST['supplier'] .' | To Store :'. $_REQUEST['store'].'</th>
      </tr>
      
       <tr >
      <th style="font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Send By : '. $_SESSION['expodine_id'] .' | Date :'. $date.'</th>
      </tr>
      
   <tr >
    <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>ID : '.$_REQUEST['id'].'</strong></th>
      </tr>
    </thead>
    </table> 
    
<table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                               <td style="width:5%">Sl</td>
                                                <td style="width:30%">Item</td> 
                                                <td style="width:10%">Type</td>
                                                 <td style="width:10%">Unit </td>
                                                 <td style="width:10%">Qty</td>
                                                <td style="width:10%">Weight</td>
                                                
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                       </thead>
                                       <tbody>';
      
                               
       $sql_login17  =  $database->mysqlQuery("select * from  tbl_purchase_order left join tbl_menumaster on tbl_purchase_order.tp_product=tbl_menumaster.mr_menuid   where tbl_purchase_order.tp_purchase_id='".$_REQUEST['id']."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                   

                    $msg_temp.=   ' <tr>
                       <td>'.$i++.'</td>
                      <td>'.$result_login1['mr_menuname'].'</td>
                       <td>'.$result_login1['tp_rate_type'].'</td>
                      <td>'.$result_login1['tp_unittype'].'</td>
                      <td>'.$result_login1['tp_qty'].'</td>
                      
                      <td>'.$result_login1['tp_weight'].'</td>
                     
                 </tr>';


               } }
                
                
                $msg_temp.='</tbody>
              </table> '; 
   
    
$branchname=''; $allmail='';
$sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list,be_branchname from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
					{
                                  $allmail=$result_sms1['be_reportemail_list'];
                                  $branchname=$result_sms1['be_branchname'];
                                        }
                  } 
                         
                          

	 $sql_general = $database->mysqlQuery("Select * from tbl_generalsettings"); 
		  $num_general  = $database-> mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  =$database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			    =$result_general['be_mail_from'];
					}
		  }
                  

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
       
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = $branchname." - PURCHASE ORDER";
        $mail->Body = $msg_temp;
        $mail->addAttachment('');
       
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        
        $emls=explode(",",$_REQUEST['mail']);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($_REQUEST['mail']);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
             echo 'Message sent.';
        }
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='daily_food_cost'){
    
    
    
       $fnct_menu5 = $database->mysqlQuery("select sum(tfc_total) as cost,tfc_menu from tbl_food_cost "
       . " where date(tfc_date)='".$_SESSION['date']."' group by tfc_menu  ");
        $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
          if ($num_fdtl5 > 0){
           while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
            { 
               
               
        $fnct_menu50 = $database->mysqlQuery("select tdf_date from tbl_daily_food_cost "
        . " where tdf_date='".$_SESSION['date']."' order by tdf_date desc limit 1  ");
        
        $num_fdtl50 = $database->mysqlNumRows($fnct_menu5);
          if ($num_fdtl50 > 0){
              
               $fnct_menu50 = $database->mysqlQuery("update tbl_daily_food_cost set tdf_cost='".$result_fnctvenue5['cost']."' "
               . " where tdf_menu='".$result_fnctvenue5['tfc_menu']."' and tdf_date='".$_SESSION['date']."' "); 
               
          }else{
              
               $fnct_menu50 = $database->mysqlQuery("insert into tbl_daily_food_cost (tdf_menu,tdf_cost,tdf_date)"
               . " values('".$result_fnctvenue5['tfc_menu']."','".$result_fnctvenue5['cost']."','".$_SESSION['date']."')"); 
               
          }
               
          }}else{
                
                
                
         }
            
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='indnet_partial_completed'){
    
    
      $fnct_menu5 = $database->mysqlQuery("select tt_indent from tbl_store_transfer "
       . " where tt_indent='".$_REQUEST['indent_id']."' ");
        $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
          if ($num_fdtl5){
    
              echo 'yes';
              
          $fnct_menu50 = $database->mysqlQuery("update tbl_requisition set tr_indent_done='Y' where tr_req_id='".$_REQUEST['indent_id']."' ");
    
          }else{
              
              echo 'nodata';
              
          }
 
 
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_direct_accept'){
    
    $i=0; $total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_transfer.tt_product where  tt_direct_grn ='".$_REQUEST['req_id']."'  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
				{  
                                    
                                    $total=$total+$result_kotlist['tt_total'];
                                                  
           ?>

                           <tr>
                           <td><?=$i++?></td>
                         
                           <td ><?=$result_kotlist['mr_menuname']?></td>
                            
                           <td ><?=$result_kotlist['tt_weight']?></td> 
                            <td ><?=$result_kotlist['tt_qty']?></td>
                           <td ><?=$result_kotlist['tt_rate_type']?></td> 
                           <td ><?=$result_kotlist['tt_unit_type']?></td>
                           <td ><?=$result_kotlist['tt_rate']?></td>
                           <td ><?=$result_kotlist['tt_total']?></td>   
                           </tr>
        <?php
        
         } }
         
         ?>
         
         
        <tr>
                           <td>Total</td>
                         
                           <td ></td>
                            
                           <td ></td>
                           <td ></td> 
                           <td ></td> 
                           <td ></td>
                           <td ></td>
                           <td id="total_rew_indent" ><?=$total?></td>   
                           </tr>
        <?php  
                                                          
                                                          
  } 


if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_indent_accept'){
    
    $i=0; $total=0;
$sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer where  tt_trn_id ='".$_REQUEST['req_id']."' and tt_indent_accepted!='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $i=1;
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    $total=$total+$result_kotlist['tt_total'];
                                    
                                                  
           ?>

                             <tr>
                           <td><?=$i++?></td>
                         
                           <td ><?=$result_kotlist['tt_name']?></td>
                            
                          
                           <td ><?=$result_kotlist['tt_weight']?></td> 
                            <td ><?=$result_kotlist['tt_qty']?></td>
                           <td ><?=$result_kotlist['tt_rate_type']?></td> 
                           <td ><?=$result_kotlist['tt_unit_type']?></td>
                           <td ><?=$result_kotlist['tt_rate']?></td>
                           <td ><?=$result_kotlist['tt_total']?></td>   
                             </tr>
        <?php
        
         } }
         
         ?>
         
         
        <tr>
                           <td>Total</td>
                         
                           <td ></td>
                            
                           <td ></td>
                           <td ></td> 
                           <td ></td> 
                           <td ></td>
                           <td ></td>
                           <td id="total_rew_indent" ><?=$total?></td>   
                             </tr>
        <?php  
                                                          
                                                          
      }                                                    
  
 if(isset($_REQUEST['set']) && $_REQUEST['set']=='accept_direct_to_store'){
    
       $date1=date('Y-m-d');
       $tot_with_tax=0;  $tot_with_tax=0;  $tot_new=0; $first_weight=0;
    
       
       
       $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer where  tt_direct_grn ='".$_REQUEST['req_id']."'  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){
		while($result_fnctvenue  = $database->mysqlFetchArray($sql_kotlist)) 
		{  
                                    
                 
      
                  
         $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
          if ($num_fdtl55) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu55))
              {
                   $first_weight=$result_fnctvenue55['ts_weight'];
                   
                   if($result_fnctvenue55['ts_expiry']!=''){
        
                          $expiry="'".$result_fnctvenue55['ts_expiry']."'";
        
                              }else{
                          $expiry='NULL';
                    }
                               
                               
                   if($result_fnctvenue55['ts_last_grn']!=''){
                        
                     $grn="'".$result_fnctvenue55['ts_last_grn']."'";
        
                  }else{
                      
                      $grn='NULL';
                  }
                               
               }
               }
                  
                   
                 
          
         $fnct_menu5 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_to_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu5))
              {
                 
                if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
                       
                     $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_weight='1', ts_stock_update_date='".$date1."', ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'),ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                  
                     
                     if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty)  "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
              
                     }else{
                     
                      if($result_fnctvenue['tt_rate_type']=='Packet' &&($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
                       
                        $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_stock_update_date='".$date1."', ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'), ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                       
                        
                         if($result_fnctvenue['tt_tax']>0){
                             
                    $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                    $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                        
                        
                      }else{
                         
                          $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty='1',ts_stock_update_date='".$date1."', ts_weight=(ts_weight+'".$result_fnctvenue['tt_weight']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."') , ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                         
                          
                           if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                          
                          
                     }
                          
                 }
                 
                 
                  if($result_fnctvenue55['ts_tax']>0) {
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*ts_tax)/100) "
                      . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");  
                   }
                    
         }
        
        }else{
           
              $fnct_menu56 = $database->mysqlQuery("select * from tbl_store_transfer where tt_from_store='".$result_fnctvenue['tt_from_store']."' and tt_product='".$result_fnctvenue['tt_product']."' ");
              $num_fdtl56 = $database->mysqlNumRows($fnct_menu56);
              if ($num_fdtl56) {   
                while ($result_fnctvenue556 = $database->mysqlFetchArray($fnct_menu56))
                {
                  if($result_fnctvenue556['tt_unit_type']=='Single' || $result_fnctvenue556['tt_unit_type']=='Nos'){
                      
                      $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                      
                  }else{
                      
                      
                       if($result_fnctvenue556['tt_rate_type']=='Packet' &&($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR')){
                      
                       $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                       
                       }else{
                           $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_weight']);
                           
                       }
                       
                  }
                   
          
                  
                  $tot_new=($result_fnctvenue556['tt_total']);
                   
                   if($result_fnctvenue['tt_tax']>0) {
                  
                       if( ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') ||  ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                       
                    $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                       }else{
                           
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                           
                       }
                       
                       
                       
                    
                    }else{
                       
                        if(  ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') || ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                            
                        
                      $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                        }else{
                            
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                       
                            
                        }
                        
                   }
                 
                 
                  }}
         
            
        }
        
        
  if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
      
     $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty) "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
     
     
     
      $fnct_menu5 = $database->mysqlQuery("select ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                     $tot_with_tax1=0;
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
       
                     if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                         }
                    
                    
                    }}
     
     }else{
         
         
       if( $result_fnctvenue['tt_rate_type']=='Packet' && ($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
           
      
      $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty)  "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
       }else{
           
            $update_from = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue['tt_weight']."'), ts_total=(ts_unit_price*ts_weight)  "
        . " ,ts_average=(ts_total/ts_weight) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
        
       }
      
      
      
     $fnct_menu5 = $database->mysqlQuery("select ts_rate_type,ts_unit,ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  $tot_with_tax1=0;
      //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                  
                  if( $result_fnctvenue78['ts_rate_type']=='Packet' && ($result_fnctvenue78['ts_unit']=='KG' || $result_fnctvenue78['ts_unit']=='LTR')){
                      
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                  }else{
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                 
                  }
        
                   if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                    }
                    
                    
                    
              }}
                    
                     
  }
  
  
  $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$result_fnctvenue['tt_product']."' and ts_store='".$result_fnctvenue['tt_to_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                    
                      }
                     
                 }
  
  
          }}
  
  
    //recipe Food Cost update transfer ///  
           $ing_rate_changed='';     $main_menu=array();   $main_store=array();
           $date88=date('Y-m-d H:i:s');        
         $sql_login88  =  $database->mysqlQuery("select tmi_store,tmi_menuid,tmi_ing_rate,tmi_ing_menuid from tbl_menu_ingredient_detail where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."' group by tmi_menuid  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                       
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                    //update////
                      $ing_rate_changed='Y';
                  }
                  
                  
                   }}
                      
                      $main_menu[]=$result_login881['tmi_menuid'];
                      $main_store[]=$result_login881['tmi_store'];
                      
                  }
                  }
                  
                  
          }
        } 
                  
                  for($i=0;$i<=count($main_menu);$i++){
                   
                       $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'    "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."'  ) "); 
                 
                  }
                  
                       }}
              
                  }
                 
                 ///end food cost///
     
                  
     $date_in=date('Y-m-d H:i:s');                
     $sql_login880833  =  $database->mysqlQuery(" update  tbl_grn_order set tg_direct_accept='Y', "
     . " tg_accept_direct_time='$date_in',tg_accept_direct_by='".$_SESSION['expodine_id']."' where tg_grn_id='".$_REQUEST['req_id']."'   ");    
     
     
     $sql_login88003  =  $database->mysqlQuery(" update tbl_store_transfer set tt_direct_accept='Y',tt_direct_accept_by='".$_SESSION['expodine_id']."'  where tt_direct_grn='".$_REQUEST['req_id']."' ");
                  
     $sql_login8800  =  $database->mysqlQuery(" delete  from tbl_store_transfer  where tt_direct_grn !='".$_REQUEST['req_id']."' and tt_set='N' ");         
                  
  
   }        
      
   if(isset($_REQUEST['set']) && $_REQUEST['set']=='accept_normal_transfer_to_store'){
    
       $date1=date('Y-m-d');
       $tot_with_tax=0;  $tot_with_tax=0;  $tot_new=0; $first_weight=0;
    
       
       
       $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer where  tt_trn_id ='".$_REQUEST['id']."' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){
		while($result_fnctvenue  = $database->mysqlFetchArray($sql_kotlist)) 
		{  
                                    
                 
      
                  
         $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
          if ($num_fdtl55) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu55))
              {
                   $first_weight=$result_fnctvenue55['ts_weight'];
                   
                   if($result_fnctvenue55['ts_expiry']!=''){
        
                          $expiry="'".$result_fnctvenue55['ts_expiry']."'";
        
                              }else{
                          $expiry='NULL';
                    }
                               
                               
                   if($result_fnctvenue55['ts_last_grn']!=''){
                        
                     $grn="'".$result_fnctvenue55['ts_last_grn']."'";
        
                  }else{
                      
                      $grn='NULL';
                  }
                               
               }
               }
                  
                   
                 
          
         $fnct_menu5 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_to_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu5))
              {
                 
                if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
                       
                     $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_weight='1', ts_stock_update_date='".$date1."', ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'),ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                  
                     
                     if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty)  "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
              
                     }else{
                     
                      if($result_fnctvenue['tt_rate_type']=='Packet' &&($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
                       
                        $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_stock_update_date='".$date1."', ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'), ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                       
                        
                         if($result_fnctvenue['tt_tax']>0){
                             
                    $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                    $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                        
                        
                      }else{
                         
                          $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty='1',ts_stock_update_date='".$date1."', ts_weight=(ts_weight+'".$result_fnctvenue['tt_weight']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."') , ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                         
                          
                           if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                          
                          
                     }
                          
                 }
                 
                 
                  if($result_fnctvenue55['ts_tax']>0) {
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*ts_tax)/100) "
                      . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");  
                   }
                    
         }
        
        }else{
           
              $fnct_menu56 = $database->mysqlQuery("select * from tbl_store_transfer where tt_from_store='".$result_fnctvenue['tt_from_store']."' and tt_product='".$result_fnctvenue['tt_product']."' ");
              $num_fdtl56 = $database->mysqlNumRows($fnct_menu56);
              if ($num_fdtl56) {   
                while ($result_fnctvenue556 = $database->mysqlFetchArray($fnct_menu56))
                {
                  if($result_fnctvenue556['tt_unit_type']=='Single' || $result_fnctvenue556['tt_unit_type']=='Nos'){
                      
                      $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                      
                  }else{
                      
                      
                       if($result_fnctvenue556['tt_rate_type']=='Packet' &&($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR')){
                      
                       $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                       
                       }else{
                           $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_weight']);
                           
                       }
                       
                  }
                   
          
                  
                  $tot_new=($result_fnctvenue556['tt_total']);
                   
                   if($result_fnctvenue['tt_tax']>0) {
                  
                       if( ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') ||  ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                       
                    $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                       }else{
                           
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                           
                       }
                       
                       
                       
                    
                    }else{
                       
                        if(  ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') || ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                            
                        
                      $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                        }else{
                            
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                       
                            
                        }
                        
                   }
                 
                 
                  }}
         
            
        }
        
        
  if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
      
     $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty) "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
     
        //ts_average = CASE 
       //  WHEN (ts_qty - '".$result_fnctvenue['tt_qty']."') > 0 
      // THEN (ts_unit_price * (ts_qty - '".$result_fnctvenue['tt_qty']."')) / (ts_qty - '".$result_fnctvenue['tt_qty']."') 
     // ELSE 0 
    // END
     
      $fnct_menu5 = $database->mysqlQuery("select ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                     $tot_with_tax1=0;
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
       
                     if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                         }
                    
                    
                    }}
     
     }else{
         
         
       if( $result_fnctvenue['tt_rate_type']=='Packet' && ($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
           
      
      $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty)  "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
       }else{
           
            $update_from = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue['tt_weight']."'), ts_total=(ts_unit_price*ts_weight)  "
        . " ,ts_average=(ts_total/ts_weight) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
        
       }
      
       //ts_average = CASE 
      //  WHEN (ts_weight - '".$result_fnctvenue['tt_weight']."') > 0 
       // THEN (ts_unit_price * (ts_weight - '".$result_fnctvenue['tt_weight']."')) / (ts_weight - '".$result_fnctvenue['tt_weight']."') 
       // ELSE 0 
      // END
       
       
       
       //ts_average = CASE 
      //  WHEN (ts_qty - '".$result_fnctvenue['tt_qty']."') > 0 
       // THEN (ts_unit_price * (ts_qty - '".$result_fnctvenue['tt_qty']."')) / (ts_qty - '".$result_fnctvenue['tt_qty']."') 
       // ELSE 0 
      // END
       
       
      
      
     $fnct_menu5 = $database->mysqlQuery("select ts_rate_type,ts_unit,ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  $tot_with_tax1=0;
      //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                  
                  if( $result_fnctvenue78['ts_rate_type']=='Packet' && ($result_fnctvenue78['ts_unit']=='KG' || $result_fnctvenue78['ts_unit']=='LTR')){
                      
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                  }else{
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                 
                  }
        
                   if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                    }
                    
                    
                    
              }}
                    
                     
  }
  
  
  $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$result_fnctvenue['tt_product']."' and ts_store='".$result_fnctvenue['tt_to_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                    
                      }
                     
                 }
  
  
          }}
  
  
    //recipe Food Cost update transfer ///  
           $ing_rate_changed='';     $main_menu=array();   $main_store=array();
           $date88=date('Y-m-d H:i:s');        
         $sql_login88  =  $database->mysqlQuery("select tmi_store,tmi_menuid,tmi_ing_rate,tmi_ing_menuid from tbl_menu_ingredient_detail where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."' group by tmi_menuid  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                       
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                    //update////
                      $ing_rate_changed='Y';
                  }
                  
                  
                   }}
                      
                      $main_menu[]=$result_login881['tmi_menuid'];
                      $main_store[]=$result_login881['tmi_store'];
                      
                  }
                  }
                  
                  
          }
        } 
                  
                  for($i=0;$i<=count($main_menu);$i++){
                   
                       $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'    "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."'  ) "); 
                 
                  }
                  
                       }}
              
                  }
                 
                 ///end food cost///
            
     $date_in=date('Y-m-d H:i:s');                
     $sql_login8808  =  $database->mysqlQuery(" update  tbl_store_transfer set tt_normal_accept='Y', tt_set='Y', "
     . " tt_normal_accept_time='$date_in',tt_normal_accept_login='".$_SESSION['expodine_id']."' where tt_trn_id='".$_REQUEST['id']."'   ");          
                  
     $sql_login8800  =  $database->mysqlQuery(" delete  from tbl_store_transfer  where tt_trn_id !='".$_REQUEST['id']."' and tt_set='N' ");         
                  
  
   }  
   
if(isset($_REQUEST['set']) && $_REQUEST['set']=='accept_indent_to_store'){
    
       $date1=date('Y-m-d');
       $tot_with_tax=0;  $tot_with_tax=0;  $tot_new=0; $first_weight=0;
    
       
       
       $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer where  tt_trn_id ='".$_REQUEST['req_id']."' and  tt_indent_accepted!='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){
		while($result_fnctvenue  = $database->mysqlFetchArray($sql_kotlist)) 
		{  
                                    
                 
      
                  
         $fnct_menu55 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl55 = $database->mysqlNumRows($fnct_menu55);
          if ($num_fdtl55) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu55))
              {
                   $first_weight=$result_fnctvenue55['ts_weight'];
                   
                   if($result_fnctvenue55['ts_expiry']!=''){
        
                          $expiry="'".$result_fnctvenue55['ts_expiry']."'";
        
                              }else{
                          $expiry='NULL';
                    }
                               
                               
                   if($result_fnctvenue55['ts_last_grn']!=''){
                        
                     $grn="'".$result_fnctvenue55['ts_last_grn']."'";
        
                  }else{
                      
                      $grn='NULL';
                  }
                               
               }
               }
                  
                   
                 
          
         $fnct_menu5 = $database->mysqlQuery("select * from tbl_store_stock where ts_store='".$result_fnctvenue['tt_to_store']."'  and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5) {   
               while ($result_fnctvenue55 = $database->mysqlFetchArray($fnct_menu5))
              {
                 
                if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
                       
                     $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_weight='1', ts_stock_update_date='".$date1."', ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'),ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                  
                     
                     if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty)  "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
              
                     }else{
                     
                      if($result_fnctvenue['tt_rate_type']=='Packet' &&($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
                       
                        $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty=(ts_qty+'".$result_fnctvenue['tt_qty']."'),ts_stock_update_date='".$date1."', ts_total=(ts_total+'".$result_fnctvenue['tt_total']."'), ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                       
                        
                         if($result_fnctvenue['tt_tax']>0){
                             
                    $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                    $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_qty),ts_unit_price=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                        
                        
                      }else{
                         
                          $update_to= $database->mysqlQuery("update tbl_store_stock set ts_expiry=$expiry,ts_last_grn=$grn, ts_qty='1',ts_stock_update_date='".$date1."', ts_weight=(ts_weight+'".$result_fnctvenue['tt_weight']."'),ts_total=(ts_total+'".$result_fnctvenue['tt_total']."') , ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                         
                          
                           if($result_fnctvenue['tt_tax']>0){
                      $tot_with_tax1=(($result_fnctvenue55['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                   $tot_with_tax=$result_fnctvenue55['ts_total']+$tot_with_tax1;
                   
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total='$tot_with_tax',ts_average=(ts_total/ts_weight),ts_unit_price=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");   
                     
                     }
                          
                          
                     }
                          
                 }
                 
                 
                  if($result_fnctvenue55['ts_tax']>0) {
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*ts_tax)/100) "
                      . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");  
                   }
                    
         }
        
        }else{
           
              $fnct_menu56 = $database->mysqlQuery("select * from tbl_store_transfer where tt_from_store='".$result_fnctvenue['tt_from_store']."' and tt_product='".$result_fnctvenue['tt_product']."' ");
              $num_fdtl56 = $database->mysqlNumRows($fnct_menu56);
              if ($num_fdtl56) {   
                while ($result_fnctvenue556 = $database->mysqlFetchArray($fnct_menu56))
                {
                  if($result_fnctvenue556['tt_unit_type']=='Single' || $result_fnctvenue556['tt_unit_type']=='Nos'){
                      
                      $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                      
                  }else{
                      
                      
                       if($result_fnctvenue556['tt_rate_type']=='Packet' &&($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR')){
                      
                       $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_qty']);
                       
                       }else{
                           $avg=($result_fnctvenue556['tt_total']/$result_fnctvenue556['tt_weight']);
                           
                       }
                       
                  }
                   
          
                  
                  $tot_new=($result_fnctvenue556['tt_total']);
                   
                   if($result_fnctvenue['tt_tax']>0) {
                  
                       if( ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') ||  ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                       
                    $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                       }else{
                           
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                      . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price,ts_tax,ts_tx_amount) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                    . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                    . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."','".$result_fnctvenue['tt_tax']."','".$result_fnctvenue['tt_tax_value']."') " );   
       
                           
                       }
                       
                       
                       
                    
                    }else{
                       
                        if(  ($result_fnctvenue556['tt_unit_type']=='Nos' || $result_fnctvenue556['tt_unit_type']=='Single') || ($result_fnctvenue556['tt_rate_type']=='Packet'  && ($result_fnctvenue556['tt_unit_type']=='KG' || $result_fnctvenue556['tt_unit_type']=='LTR'))){
                            
                        
                      $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$first_weight."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                        }else{
                            
                            $fnct_menu51 = $database->mysqlQuery("INSERT INTO `tbl_store_stock`(ts_store, `ts_product`, `ts_barcode`, `ts_qty`,"
                         . " `ts_weight`, `ts_unit`, `ts_rate_type`, `ts_average`, `ts_total`, `ts_reorder`,ts_stock_update_date,ts_expiry,ts_last_grn,ts_unit_price) "
                         
                         . "VALUES ('".$result_fnctvenue556['tt_to_store']."','".$result_fnctvenue556['tt_product']."','".$result_fnctvenue556['tt_barcode']."','".$result_fnctvenue556['tt_qty']."',"
                       . " '".$result_fnctvenue556['tt_weight']."','".$result_fnctvenue556['tt_unit_type']."','".$result_fnctvenue556['tt_rate_type']."',"
                       . " '".$avg."', '".$tot_new."', "
                         . " '".$result_fnctvenue556['tt_reorder']."','".$date1."',$expiry,$grn,'".$result_fnctvenue556['tt_rate']."') " );   
                       
                            
                        }
                        
                   }
                 
                 
                  }}
         
            
        }
        
        
  if($result_fnctvenue['tt_unit_type']=='Single' || $result_fnctvenue['tt_unit_type']=='Nos'){
      
     $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty) "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
     
     
     
      $fnct_menu5 = $database->mysqlQuery("select ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                     $tot_with_tax1=0;
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_to_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
       
                     if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                         }
                    
                    
                    }}
     
     }else{
         
         
       if( $result_fnctvenue['tt_rate_type']=='Packet' && ($result_fnctvenue['tt_unit_type']=='KG' || $result_fnctvenue['tt_unit_type']=='LTR')){
           
      
      $update_from = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_fnctvenue['tt_qty']."'), ts_total=(ts_unit_price*ts_qty)  "
      . " ,ts_average=(ts_total/ts_qty) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
       }else{
           
            $update_from = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$result_fnctvenue['tt_weight']."'), ts_total=(ts_unit_price*ts_weight)  "
        . " ,ts_average=(ts_total/ts_weight) where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");    
        
       }
      
      
      
     $fnct_menu5 = $database->mysqlQuery("select ts_rate_type,ts_unit,ts_total,ts_tax from tbl_store_stock where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."' ");
         $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
        if ($num_fdtl5 > 0) { 
              while ($result_fnctvenue78 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  $tot_with_tax1=0;
      //$tot_with_tax1=(($result_fnctvenue78['ts_total']*$result_fnctvenue['tt_tax'])/100);
                   
                  
                  if( $result_fnctvenue78['ts_rate_type']=='Packet' && ($result_fnctvenue78['ts_unit']=='KG' || $result_fnctvenue78['ts_unit']=='LTR')){
                      
                    $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_qty) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                  }else{
                      
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_total=(ts_total+'".$tot_with_tax1."'),ts_average=(ts_total/ts_weight) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                 
                  }
        
                   if($result_fnctvenue78['ts_tax']>0) {
                      $update_to= $database->mysqlQuery("update tbl_store_stock set ts_tx_amount=((ts_total*'".$result_fnctvenue78['ts_tax']."')/100) "
                       . " where ts_store='".$result_fnctvenue['tt_from_store']."' and ts_product='".$result_fnctvenue['tt_product']."'  ");  
                    }
                    
                    
                    
              }}
                    
                     
  }
  
  
  $sql_login  =  $database->mysqlQuery("select ts_unit_price,ts_unit,ts_rate_type from tbl_store_stock where ts_product='".$result_fnctvenue['tt_product']."' and ts_store='".$result_fnctvenue['tt_to_store']."'   "); 
            
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      //recipe rate update ///
                 if($result_login['ts_unit']=='Nos' || $result_login['ts_unit']=='Single') {        
                            $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                      
                 }else{
                     
                      if($result_login['ts_rate_type']=='Packet' && ($result_login['ts_unit']=='KG' || $result_login['ts_unit']=='LTR')) { 
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_ing_qty) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                  
                      }else{
                           $sql_login65  =  $database->mysqlQuery(" update tbl_menu_ingredient_detail set  tmi_ing_rate='".$result_login['ts_unit_price']."',tmi_ing_total=(tmi_ing_rate*tmi_weight) where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."'  ");                        
                    
                      }
                     
                 }
  
  
          }}
  
  
    //recipe Food Cost update transfer ///  
           $ing_rate_changed='';     $main_menu=array();   $main_store=array();
           $date88=date('Y-m-d H:i:s');        
         $sql_login88  =  $database->mysqlQuery("select tmi_store,tmi_menuid,tmi_ing_rate,tmi_ing_menuid from tbl_menu_ingredient_detail where tmi_ing_menuid='".$result_fnctvenue['tt_product']."' and tmi_store='".$result_fnctvenue['tt_to_store']."' group by tmi_menuid  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login881  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                       
            $fnct_menu5 = $database->mysqlQuery("select tfc_rate from tbl_food_cost where tfc_menu='".$result_login881['tmi_menuid']."' and  tfc_ing_menu='".$result_login881['tmi_ing_menuid']."' group by tfc_menu ");
             $num_fdtl5 = $database->mysqlNumRows($fnct_menu5);
                if ($num_fdtl5 > 0) {
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu5))
              { 
                  
                  if($result_fnctvenue5['tfc_rate']!=$result_login881['tmi_ing_rate'] ){
                    //update////
                      $ing_rate_changed='Y';
                  }
                  
                  
                   }}
                      
                      $main_menu[]=$result_login881['tmi_menuid'];
                      $main_store[]=$result_login881['tmi_store'];
                      
                  }
                  }
                  
                  
          }
        } 
                  
                  for($i=0;$i<=count($main_menu);$i++){
                   
                       $sql_login88  =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$main_menu[$i]."' and tmi_store='".$main_store[$i]."'    "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
			{ 
                      
                  if($ing_rate_changed=='Y'){
                    $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_food_cost`(tfc_menu,tfc_portion,tfc_ing_menu, `tfc_qty`, `tfc_weight`, 
                      `tfc_rate`, `tfc_total`, `tfc_date`, `tfc_login`,tfc_di,tfc_ta,tfc_hd,tfc_cs,tfc_store,tfc_yield) VALUES ('".$result_login88['tmi_menuid']."','".$result_login88['tmi_portion']."',
                         '".$result_login88['tmi_ing_menuid']."', '".$result_login88['tmi_ing_qty']."', '".$result_login88['tmi_weight']."',
                    '".$result_login88['tmi_ing_rate']."','".$result_login88['tmi_ing_total']."','$date88','".$_SESSION['expodine_id']."',"
                     . "'".$result_login88['tmi_di']."','".$result_login88['tmi_ta']."','".$result_login88['tmi_hd']."','".$result_login88['tmi_cs']."','".$result_login88['tmi_store']."','".$result_login88['tmi_yield']."'  ) "); 
                 
                  }
                  
                       }}
              
                  }
                 
                 ///end food cost///
            
     $date_in=date('Y-m-d H:i:s');                
     $sql_login8808  =  $database->mysqlQuery(" update  tbl_store_transfer set tt_indent_accepted='Y', tt_set='Y', "
     . " tt_indent_accepted_time='$date_in',tt_indent_accepted_login='".$_SESSION['expodine_id']."' where tt_trn_id='".$_REQUEST['req_id']."'   ");          
                  
     $sql_login8800  =  $database->mysqlQuery(" delete  from tbl_store_transfer  where tt_trn_id !='".$_REQUEST['req_id']."' and tt_set='N' ");         
                  
  
   }    
     if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_store_accept_direct'){
       
        $sql_login88  =  $database->mysqlQuery("select ti_name from tbl_inv_kitchen left join tbl_store_transfer on"
        . " tbl_store_transfer.tt_from_store=tbl_inv_kitchen.ti_id  where tbl_store_transfer.tt_direct_grn='".$_REQUEST['req_id']."' limit 1 "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		   { 
                      echo $result_login88['ti_name'];
                      
                  }
                  }
                  
                
                  echo '*';
                  
           $sql_login88  =  $database->mysqlQuery("select ti_name from tbl_inv_kitchen left join tbl_store_transfer on"
        . " tbl_store_transfer.tt_to_store=tbl_inv_kitchen.ti_id  where tbl_store_transfer.tt_direct_grn='".$_REQUEST['req_id']."' limit 1 "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		   { 
                      echo $result_login88['ti_name'];
                      
                  }
                  }        
                  
       
       
   }   
   
   if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_store_accept'){
       
        $sql_login88  =  $database->mysqlQuery("select ti_name from tbl_inv_kitchen left join tbl_store_transfer on"
        . " tbl_store_transfer.tt_from_store=tbl_inv_kitchen.ti_id  where tbl_store_transfer.tt_trn_id='".$_REQUEST['req_id']."' limit 1 "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
		  while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		   { 
                      echo $result_login88['ti_name'];
                      
                  }
                  }
       
       
   }     
   if(isset($_REQUEST['set']) && $_REQUEST['set']=='send_indent'){
       
       
        $sql_login88  =  $database->mysqlQuery("select tt_set from  tbl_store_transfer where tt_set='N' " ); 
        
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              
           echo 'no';     
        }else{
            echo 'yes';
        }
       
       
   }
   
   if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_indent_transfer'){
       
       
         $sql_login88  =  $database->mysqlQuery("select tr_product,tr_rate_type,tr_unittype, tr_weight,tr_qty from tbl_requisition where tr_req_id='".$_REQUEST['req_id']."'  "); 
            
	  $num_login88   = $database->mysqlNumRows($sql_login88);
	  if($num_login88){
	      while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                
          $qty_weight=0;         
          
          
         $sql_login881  =  $database->mysqlQuery("select sum(tip_qty_weight) as tot from tbl_indent_partial where tip_req_id='".$_REQUEST['req_id']."' "
         . " and tip_menuid='".$result_login88['tr_product']."' and tip_done='Y' group by tip_req_id,tip_menuid "); 
            
	  $num_login881   = $database->mysqlNumRows($sql_login881);
	  if($num_login881){
	      while($result_login881  = $database->mysqlFetchArray($sql_login881)) 
		{ 
                  $qty_weight=$result_login881['tot'];
                  
              }
              }
                  
                   
                 if($result_login88['tr_unittype']=='Single' || $result_login88['tr_unittype']=='Nos'){
                      
                     
                     if($qty_weight==$result_login88['tr_qty']){
                         echo 'finish';
                     }else{
                         echo 'no';
                     }
                      
               }else{
                      
                      
                  if($result_login88['tr_rate_type']=='Packet' &&($result_login88['tr_unittype']=='KG' || $result_login88['tr_unittype']=='LTR')){
                      
                       if($qty_weight==$result_login88['tr_qty']){
                         echo 'finish';
                     }else{
                         echo 'no';
                     }
                       
                 }else{
                         
                  
                        if($qty_weight==$result_login88['tr_weight']){
                         echo 'finish';
                     }else{
                         echo 'no';
                     }   
                }
                       
                }
                      
                      
                      
                }
                }
       
       
       
       
   }
   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="load_batch_grn")){
    
     $store=$_REQUEST['from_store'];
     $menu=$_REQUEST['menuid'];
     
    ?>
                           
          <select onchange="batch_change();" id="batch_id1"  style="width: 100px;font-size: 11px;" >                      
          
              <option value="">Select Batch</option>                 
                             
    <?php
     $stock_added=0;
     
    
          $stock=0;
          $sql_login  =  $database->mysqlQuery("select tg_weight,tg_qty,tg_rate_type,tg_unittype,v_name,tg_grn_id,"
          . " tg_unit_rate,tg_batch_id from tbl_grn_order "
          . " left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier "
          . " where tg_product = '$menu' and tg_store='$store' order by tg_dayclosedate asc "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      if($result_login['tg_unittype']=='Nos' || $result_login['tg_unittype']=='Single') {        
                            $stock= $result_login['tg_qty'];                  
                      
                 }else{
                     
                      if($result_login['tg_rate_type']=='Packet' && ($result_login['tg_unittype']=='KG' || $result_login['tg_unittype']=='LTR')) { 
                            $stock= $result_login['tg_qty'];
                      }else{
                            $stock= $result_login['tg_weight'];
                      }
                     
                 }
   
                 
                 ///bal batch stock////
                 
       $sql_login1  =  $database->mysqlQuery("select sum(tbs_added) as stock from tbl_batch_stock where tbs_batch_id='".$result_login['tg_batch_id']."' "); 
       $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
                      
                          $stock_added=$result_login1['stock'];
                      
                  }
                  }
                 
                  if($stock_added>0){
                      
                      $bal_stock=($stock-$stock_added);
                  }else{
                      
                      $bal_stock=$stock;
                  }
                  
                      ?>
                             
          <option style="color:black;font-size: 11px;margin-top: 15px; <?php if($bal_stock<=0){?> font-weight:bold;pointer-events:none; color:red <?php } ?>" bal_stock="<?=$bal_stock?>" stock='<?=$stock?>' amt="<?=$result_login['tg_unit_rate']?>" b_id="<?=$result_login['tg_batch_id']?>" value="<?=$result_login['tg_unit_rate']?>"> Sup : <?=$result_login['v_name'].' &nbsp; | &nbsp; Bt No : '.$result_login['tg_batch_id'].' &nbsp;&nbsp; | &nbsp;  '.$_SESSION['base_currency'].' : '.$result_login['tg_unit_rate'].' &nbsp; | &nbsp; Purchased : '.$stock.' &nbsp; | &nbsp; Bal Stock : '.$bal_stock?></option>                 
                 
                             
            <?php } } ?>
                             
           </select>                    
<?php
                  
 }
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=="load_batch_grn2")){
    
   
     $store=$_REQUEST['from_store'];
     $menu=$_REQUEST['menuid'];
 ?>
 
     <ul class="nav" role="navigation">
    <li class="dropdown"> <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">Select Batches<b class="caret"></b></a>

    <ul class="dropdown-menu" role="menu" aria-labelledby="drop2">
          
      <?php
     $stock_added=0;
     
    
          $stock=0;
          $sql_login  =  $database->mysqlQuery("select tg_weight,tg_qty,tg_rate_type,tg_unittype,v_name,tg_grn_id,"
          . " tg_unit_rate,tg_batch_id from tbl_grn_order "
          . " left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier "
          . " where tg_product = '$menu' and tg_store='$store' order by tg_dayclosedate asc "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
                      if($result_login['tg_unittype']=='Nos' || $result_login['tg_unittype']=='Single') {        
                            $stock= $result_login['tg_qty'];                  
                      
                 }else{
                     
                      if($result_login['tg_rate_type']=='Packet' && ($result_login['tg_unittype']=='KG' || $result_login['tg_unittype']=='LTR')) { 
                            $stock= $result_login['tg_qty'];
                      }else{
                            $stock= $result_login['tg_weight'];
                      }
                     
                 }
  
        ///bal batch stock////
                  
       $sql_login1  =  $database->mysqlQuery("select sum(tbs_added) as stock from tbl_batch_stock where tbs_batch_id='".$result_login['tg_batch_id']."' "); 
       $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
                      
                          $stock_added=$result_login1['stock'];
                      
                  }
                  }
                 
                  if($stock_added>0){
                      
                      $bal_stock=($stock-$stock_added);
                  }else{
                      
                      $bal_stock=$stock;
                  }
                  
                      ?>     
      <li role="presentation" class="divider"></li>
      <li role="presentation"><a style="width:530px; color:black;font-size: 10px; <?php if($bal_stock<=0){?> font-weight:bold;pointer-events:none; color:red <?php } ?>" bal_stock="<?=$bal_stock?>" stock='<?=$stock?>' amt="<?=$result_login['tg_unit_rate']?>" b_id="<?=$result_login['tg_batch_id']?>" value="<?=$result_login['tg_unit_rate']?>" role="menuitem" tabindex="-1" href="#">
      Sup : <?=$result_login['v_name'].' &nbsp; | &nbsp; Bt No : '.$result_login['tg_batch_id'].' &nbsp;&nbsp; | &nbsp;  '.$_SESSION['base_currency'].' : '.$result_login['tg_unit_rate'].' &nbsp; | &nbsp; Purchased : '.$stock.' &nbsp; | &nbsp; Bal Stock : '.$bal_stock?> 
     <?php if($bal_stock>0){?>  
      <input bal_stock="<?=$bal_stock?>" stock='<?=$stock?>' amt="<?=$result_login['tg_unit_rate']?>" b_id="<?=$result_login['tg_batch_id']?>"  style="margin-left: 20px;width: 50px;" type="text" value='' placeholder="Value" onkeyup="check_ul_batch('<?=$result_login['tg_batch_id']?>')"  id="ul_batch_<?=$result_login['tg_batch_id']?>"/></a>
     <?php } ?> 
      </li>
           
          <?php }} ?>
           
    </ul>
  </li>
           
           
</ul>
           
           
  <?php }
  
  if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_wastage_to_central'){
    
      
        
  
         $stf=$_SESSION['expodine_id'];
         $date_rec=date('Y-m-d H:i:s'); 
         $rsn=$_REQUEST['reason'];
         
         $remark=" Return by $stf at $date_rec . Remarks : $rsn ";
   
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
         
        $was_id=1; 
        $sql_gen =  mysqli_query($localhost1,"select max(tcw_was_id) as was_id from tbl_cloud_wastage where tcw_branch='".$_SESSION['firebase_id']."' "); 
       
	$num_gen  = mysqli_num_rows($sql_gen);
	if($num_gen)
	{
	while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
	{
            
           $was_id= $result_fnctvenue['was_id']+1;
        }
        }
         
        $was_no='WAS_'.$was_id;
      
        
         $sql_login  =  $database->mysqlQuery("select * from tbl_wastage where tw_wastage_id='".$_REQUEST['id']."'  "); 
            
	 $num_login   = $database->mysqlNumRows($sql_login);
	 if($num_login){
	 while($result_login  = $database->mysqlFetchArray($sql_login)) 
	 { 
          
             
             
             
             
         $cnt_id=0;    
         $sql_login8  =  $database->mysqlQuery("select mr_central_id from tbl_menumaster where mr_menuid='".$result_login['tw_product']."'  "); 
            
	 $num_login8   = $database->mysqlNumRows($sql_login8);
	 if($num_login8){
	 while($result_login8  = $database->mysqlFetchArray($sql_login8)) 
	 { 
             
             $cnt_id=$result_login8['mr_central_id'];
         }
         }
             
    $sql_login44  =  $database->mysqlQuery("update tbl_wastage set tw_central_return='Y',tw_item_central_id='$cnt_id'  where  tw_wastage_id='".$_REQUEST['id']."' and tw_product='".$result_login['tw_product']."' ");    
         
    $sql_gen33 =  mysqli_query($localhost1," INSERT INTO `tbl_cloud_wastage`(`tcw_was_id`, `tcw_was_no`, `tcw_product`, `tcw_prod_central_id`,"
    . " `tcw_product_name`, `tcw_brand`, `tcw_barcode`, `tcw_rate_type`, `tcw_unit_type`, `tcw_weight`, `tcw_quantity`, `tcw_current_stock`,"
    . " `tcw_unit_rate`, `tcw_total`, `tcw_reason`, `tcw_branch`, `tcw_store`, `tcw_created_by`, `tcw_created_date`,"
    . " `tcw_confirm`, `tcw_log_branch`,tcw_from_local,tcw_remarks_local) VALUES ('$was_id','$was_no','".$result_login['tw_product']."','$cnt_id',"
    . " '".$result_login['tw_name']."','".$result_login['tw_brand']."','".$result_login['tw_barcode']."',"
    . " '".$result_login['tw_rate_type']."','".$result_login['tw_unit_type']."','".$result_login['tw_weight']."','".$result_login['tw_qty']."',"
    . " '".$result_login['tw_current_stock']."','".$result_login['tw_rate']."','".$result_login['tw_total']."','".$result_login['tw_reason']."',"
    . " '".$_SESSION['firebase_id']."','".$result_login['tw_store']."','".$_SESSION['expodine_id']."',"
    . " '$date_rec','Y','".$_SESSION['firebase_id']."','Y','$remark') "); 
       
	
        
         }
         }

}
  if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_barcode_plu')){
        
        
         $sql_general =  $database->mysqlQuery("Select mr_menuid from tbl_menumaster   where mr_plu='".$_REQUEST['plu']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					    
			echo 	$result_general['mr_menuid'];
                  }
                }
         
 }
 
 if(isset($_REQUEST['set'])&&($_REQUEST['set']=="search_barcode_plu")){
    
 
   $weight=0; $qty=0;
   $data= array();
    $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster left join tbl_base_unit_master on "
            . " tbl_base_unit_master.bu_id=tbl_menumaster.mr_base_unit"
            . " where  mr_active ='Y' and mr_product_type!='Menu'   and mr_plu = '".$_REQUEST['plu']."'   "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $menuid= $result_login['mr_menuid'];
                                $name= $result_login['mr_menuname'];
                                 $mr_rate_type= $result_login['mr_rate_type'];
                                 
                               if($result_login['mr_unit_type']!=''){
                                  $bu_name= $result_login['mr_unit_type'];
                                 }else{
                                     $bu_name='Single';
                                 }
                                 
                                 
                                 if($result_login['bu_name']!=''){
                                  $bu_name1= $result_login['bu_name'];
                                 }else{
                                     $bu_name1='Single';
                                 } 
                                 
                                 
                               if($result_login['mr_raw_barcode']!=''){
                                  $barcode= $result_login['mr_raw_barcode'];
                                 }else{
                                     $barcode='';
                                 }  
                                 
                                 
         $fnct_menu = $database->mysqlQuery("select ts_weight,ts_qty from tbl_store_stock where ts_product='".$result_login['mr_menuid']."' "
         . " and (ts_qty>0 or ts_weight>0) ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
            while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
            {
                      $weight=$result_fnctvenue['ts_weight'];
                      $qty=$result_fnctvenue['ts_qty'];
                      
            }
        }
                                 
                                
				       
	echo $result_login['mr_menuname'].'*'.$result_login['mr_menuid'].'*'.$bu_name.'*'.$bu_name1;
                                          
			  
			
	  
	   }
           }
	 
	
	   
}
 
 
 
?>
