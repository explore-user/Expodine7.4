<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  if(isset($_REQUEST['set']) && $_REQUEST['set']== "store_stock_report")
    {	
      
       if($_REQUEST['bydate']==''){
      
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
    
    
     if($_REQUEST['reorder']!=''){
       $string2.=" and mr_reorder_level = '".$_REQUEST['reorder']."'   ";
     }
    
     
       if($_REQUEST['store']!=''){
       $string2.=" and ts_store = '".$_REQUEST['store']."'   ";
        }
        
        
        if($_REQUEST['stock_check']!=''){
             
         if($_REQUEST['stock_check']=='in'){
                 
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight >'0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty >'0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty >'0') )";
           
         }
             
        if($_REQUEST['stock_check']=='out'){
                  
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <='0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <='0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <='0') )";
        
        }
              
        if($_REQUEST['stock_check']=='reorder'){
             
          $string2.=" and( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <= mr_reorder_level)  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <= mr_reorder_level )  or ( (ts_unit='KG'  || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <= mr_reorder_level) )";
       
        }
       
       
        }
   
                
	  $weight=0; $qty=0; $rate=0; $rate1=0;
	
            $data=array();
            $data1=array();
            $xlsRow=1;
            
           $sql_login_combo  =  $database->mysqlQuery("SELECT *,sum(ts_weight) as  weight ,sum(ts_qty) as  qty ,sum(ts_total) as  rate , ts_weight as nrm_weight from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product  order by mr_menuname asc" );

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=1;
		  while($result_kotlist  = $database->mysqlFetchArray($sql_login_combo)) 
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
                          $rate1=$rate1+$rate;
                                  
                                  
                          $data['Sl No']=$t++;
                          $data['Product']=$result_kotlist['mr_menuname'];
                          $data['Barcode']=$result_kotlist['ts_barcode'];
                          $data['Rate Type']=$result_kotlist['ts_rate_type'];
                          $data['Category']=$result_kotlist['mmy_maincategoryname'];
                          $data['Weight']=$weight;
                          $data['Qty']=$qty;
                          $data['Unit']=$result_kotlist['ts_unit'];
                           $data['Re-order Level']=$result_kotlist['mr_reorder_level'];
                          if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){ 
                               
                          if($rate>0 &&  $qty>0){ 
                                $data['Unit Rate']=($rate/$qty);
                             }else {
                                $data['Unit Rate']='';
                            
                             } 
                            
                            }else{ 
                             
                           
                            
                            if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR') ){
                            
                                if($rate>0 &&  $qty>0){
                                $data['Unit Rate']=($rate/$qty);
                                
                                 }else {
                                  
                             $data['Unit Rate']='';
                              } 
                                
                               }else {
                                   
                               if($rate>0 &&  $weight>0){     
                                   
                             $data['Unit Rate']=($rate/$weight);
                              }else {
                                  
                             $data['Unit Rate']='';
                              } 
                              } 
                              
                              
                              
                             
                              
                              
                             
                             } 
                          
                       
                          $data['Total Rate']=number_format($rate,$_SESSION['be_decimal']) ;
                         
                          $data['Expiry Date']=$result_kotlist['ts_expiry'];
                      //    $data['Last GRN ID']=$result_kotlist['ts_last_grn'];
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                         
                          }}
                        
                        
                           $data['Sl No']='';
                          $data['Product']='';
                          $data['Barcode']='';
                          $data['Rate Type']='';
                          $data['Category']='';
                          $data['Weight']='';
                          $data['Qty']='';
                          $data['Unit']='';
                           $data['Re-order Level']='';
                           $data['Unit Rate']='Total' ;
                          $data['Total Rate']=number_format($rate1,$_SESSION['be_decimal']) ;
                        
                         
                          $data['Expiry Date']='';
                        //  $data['Last GRN ID']='';
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++; 
                          
                          
                          
                          
    }else{
     ///////////////daywise////////
        
        
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
    
    
     if($_REQUEST['reorder']!=''){
       $string2.=" and mr_reorder_level = '".$_REQUEST['reorder']."'   ";
     }
    
     
       if($_REQUEST['store']!=''){
       $string2.=" and ts_store = '".$_REQUEST['store']."'   ";
        }
        
        
        if($_REQUEST['stock_check']!=''){
             
         if($_REQUEST['stock_check']=='in'){
                 
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight >'0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty >'0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty >'0') )";
           
         }
             
        if($_REQUEST['stock_check']=='out'){
                  
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <='0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <='0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <='0') )";
        
        }
              
        if($_REQUEST['stock_check']=='reorder'){
             
          $string2.=" and( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <= mr_reorder_level)  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <= mr_reorder_level )  or ( (ts_unit='KG'  || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <= mr_reorder_level) )";
       
        }
       
       
        }
   
                
	  $weight=0; $qty=0; $rate=0; $rate1=0;
	
            $data=array();
            $data1=array();
            $xlsRow=1;
            
           $sql_login_combo  =  $database->mysqlQuery("SELECT *,sum(tis_weight) as  weight ,sum(tis_qty) as  qty ,sum(tis_total) as  rate , tis_weight as nrm_weight from tbl_store_stock left join tbl_inv_daily_store_stock on tbl_inv_daily_store_stock.tis_product=tbl_store_stock.ts_product  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by tis_product,tis_date  order by tis_date,mr_menuname asc" );

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=1;
		  while($result_kotlist  = $database->mysqlFetchArray($sql_login_combo)) 
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
                          $rate1=$rate1+$rate;
                                  
                                  
                          $data['Sl No']=$t++;
                            $data['Date']=$result_kotlist['tis_date'];
                          $data['Product']=$result_kotlist['mr_menuname'];
                         
                          $data['Rate Type']=$result_kotlist['ts_rate_type'];
                          $data['Category']=$result_kotlist['mmy_maincategoryname'];
                          $data['Weight']=$weight;
                          $data['Qty']=$qty;
                          $data['Unit']=$result_kotlist['ts_unit'];
                          
                          if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){ 
                               
                          if($rate>0){ 
                                $data['Unit Rate']=($rate/$qty);
                             }else {
                                $data['Unit Rate']='';
                            
                             } 
                            
                            }else{ 
                             
                            if($rate>0 ){
                            
                                if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR') ){
                              $data['Unit Rate']=($rate/$qty);
                               }else {
                             $data['Unit Rate']=($rate/$weight);
                              } 
                              
                              
                              
                              }else {
                             $data['Unit Rate']='';
                              } 
                              
                              
                             
                             } 
                          
                       
                          $data['Total Rate']=number_format($rate,$_SESSION['be_decimal']) ;
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                         
                          }}
                        
                        
                           $data['Sl No']='Total';
                          $data['Date']='';
                          $data['Product']='';
                          $data['Rate Type']='';
                          $data['Category']='';
                          $data['Weight']='';
                          $data['Qty']='';
                          $data['Unit']='';
                          
                           $data['Unit Rate']='' ;
                          $data['Total Rate']=number_format($rate1,$_SESSION['be_decimal']) ;
                        
                         
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++; 
        
        
        
    }

  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Store_Stock_Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) && $_REQUEST['set']== "central_report")
    {	
        
     
    $string2='';
    $string_store='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tct_central_id like '%".$_REQUEST['id']."%'   ";
    }
    
    if($_REQUEST['central_type']!=''){
    $string2.=" and tct_mode = '".$_REQUEST['central_type']."'   ";
    }
    
    
    if($_REQUEST['central_type']=='Transfer'){
    $string_store.=" left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_central_kitchen_transfer.tct_local_store   ";
    }
    
    if($_REQUEST['central_type']=='Accept'){
    $string_store.=" left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_central_kitchen_transfer.tct_to_store   ";
    }
   
                
	  if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  date(tct_date) between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  date(tct_date) between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  date(tct_date) between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  date(tct_date) between '".$from."' and '".$to."' ";
                }
    
   
     $total=0;
	
            $data=array();
            $data1=array();
            $xlsRow=1;
            
           $sql_login_combo  =  $database->mysqlQuery("SELECT * from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_central_kitchen_transfer.tct_product $string_store  where tct_set='Y' $string2   order by tct_id desc  " );

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=1;
		  while($result_kotlist  = $database->mysqlFetchArray($sql_login_combo)) 
			{
                        
                   
                         
                        
                          $total=$total+ $result_kotlist['tct_total']; 
                          
                          $data['Sl No']=$t++;
                           $data['Id']=$result_kotlist['tct_central_id'];
                          $data['Product']=$result_kotlist['mr_menuname'];
                          $data['Date']=$result_kotlist['tct_date'];
                           $data['Store']=$result_kotlist['ti_name'];
                          $data['Rate Type']=$result_kotlist['tct_rate_type'];
                           $data['Unit']=$result_kotlist['tct_unit_type'];
                        $data['Qty']=$result_kotlist['tct_qty'];
                          $data['Weight']=$result_kotlist['tct_weight'];
                           $data['Rate']=number_format($result_kotlist['tct_rate'],$_SESSION['be_decimal']) ;
                          $data['Total ']=number_format($result_kotlist['tct_total'],$_SESSION['be_decimal']) ;
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                         
                        }}

                        
                           $data['Sl No']='Total';
                           $data['Id']='';
                          $data['Product']='';
                          $data['Date']='';
                           $data['Store']='';
                          $data['Rate Type']='';
                           $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                           $data['Rate']='' ;
                          $data['Total ']=number_format($total,$_SESSION['be_decimal']) ;
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;                    
                        
      
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Central_Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='expiry_report'){
    
   
    
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
    $string2.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
    }
    
    if($_REQUEST['product']!=''){
    $string2.=" and tg_name like '%".$_REQUEST['product']."%'   ";
    }
    
      if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    
     if($_REQUEST['stock_check']!=''){
         
         
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    
    
    
    }
    
    
     $string22='';
//     if($_REQUEST['asc_desc']!=''){
//         
//             if($_REQUEST['asc_desc']=='ascq'){
//                         
//                  $string22.=" order by tg_qty asc  ";               
//              }
//              
//               if($_REQUEST['asc_desc']=='descq'){
//                         
//                  $string22.=" order by tg_qty desc  ";               
//              }
//              
//               if($_REQUEST['asc_desc']=='ascw'){
//                         
//                  $string22.=" order by tg_weight asc  ";               
//              }
//              
//               if($_REQUEST['asc_desc']=='descw'){
//                         
//                  $string22.=" order by tg_weight desc  ";               
//              }
//        }else{
//            
//           $string22.=' order by tg_id desc  ';   
//            
//        }
    
    
     $type='';
   if($_REQUEST['status_expiry']!=''){
       
       
       if($_REQUEST['status_expiry']=='not_expired'){   
          $string2.=" and tg_expiry_date > NOW()   ";
         $type='Not Expired';
       }
    
       
        if($_REQUEST['status_expiry']=='expired'){   
          $string2.=" and tg_expiry_date <= NOW()   ";
            $type='Expired';
       }
    
       
       if($_REQUEST['status_expiry']=='expiry7'){   
          $string2.=" and tg_expiry_date  between CURDATE( ) - INTERVAL 7  DAY AND CURDATE( )  ";
     $type='Expired 7 days Ago';
       }
       
       
       if($_REQUEST['status_expiry']=='expiry15'){   
          $string2.=" and tg_expiry_date  between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )   ";
     $type='Expired 15 days Ago';
       }
       
       
        if($_REQUEST['status_expiry']=='nearing7'){   
            
             $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 6 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string2.=" and tg_expiry_date between '".$cr_new."' and '".$cr7_new."'  ";
            
         $type='Expiring In 7 days ';
    
       }
       
       
       if($_REQUEST['status_expiry']=='nearing15'){   
         $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 14 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string2.=" and tg_expiry_date between '".$cr_new."' and '".$cr7_new."'  ";
            
          $type='Expiring In 15 days ';
       }
       
       
       $string22.=' order by tg_expiry_date asc  ';   
    
    
    
    }else{
        
        $string22.=' order by tg_id desc  ';    
    }
    
    
        
        
        
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                       //  $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          //$string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                       //  $string2.= " and  tg_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                   //  $string2.= " and  tg_date between '".$from."' and '".$to."' ";
                }
        
               $data=array();
            $data1=array();
           
   
    $ii=1; $total=0; 
    $sql_kotlist =  $database->mysqlQuery("SELECT * from tbl_grn_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_grn_order.tg_product "
     . " left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_vendor_master on "
     . "tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join "
     . "tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_grn_id!='' and  tg_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){ 
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
         
            $total=$total+$result_kotlist['tg_final_rate'];
            
            
                          $data['Sl']=$ii++;
                          $data['Inv Date']=$result_kotlist['tg_date'];
                           $data['Supplier']=$result_kotlist['v_name'];
                          $data['Grn Id']=$result_kotlist['tg_grn_id'];
                         
                          $data['Product']=$result_kotlist['tg_name'];
                           $data['Category']=$result_kotlist['mmy_maincategoryname'];
                          $data['Expiry Date']=$result_kotlist['tg_expiry_date'];
                           $data['Type ']=$type;
                          $data['Rate Type ']=$result_kotlist['tg_rate_type'] ;
                          $data['Unit']=$result_kotlist['tg_unittype'] ;
                          $data['Qty']=$result_kotlist['tg_qty'] ;
                          $data['Weight']=$result_kotlist['tg_weight'] ;
                          $data['Rate']=$result_kotlist['tg_unit_rate'] ;
                          $data['Total']=$result_kotlist['tg_final_rate'] ;
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                       
         } }  
                                         
     
    
  
   
                           $data['Sl']='';
                          $data['Inv Date']='';
                           $data['Supplier']='';
                          $data['Grn Id']='';
                         
                          $data['Product']='';
                           $data['Category']='';
                          $data['Expiry Date']='';
                          $data['Rate Type ']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='FINAL TOTAL';
                          $data['Total']=$total ;
                         
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                         
     
      $date=  date('Y-m-d H:i:s');   
        
  $filename = "Expiry Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
 else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='supplier_report'){
    
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
               $string2.=" and tg_supplier ='".$_REQUEST['supplier']."'   ";
         }
    
    
   
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and tr_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  tg_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tr_dayclosedate between '".$from."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$to."' ";
                     $string2.= " and  tg_date between '".$from."' and '".$to."' ";
                }
              
                
               $data=array();
            $data1=array();
            $xlsRow=1;  
          $i=0;      
                          
        $total=0; $sub_total=0;  $tax_total=0;
        $sql_kotlist  =  $database->mysqlQuery("SELECT tg_grn_id,gst,v_address,v_name, tg_date,tgs_invoice_no,tg_final_total as sub_tot,"
                . " tg_grand_total as tot,tg_tax_amount as tax_tot from tbl_grn_order left join tbl_vendor_master on "
                . " tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store "
                . " left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2 "
                . " group by tg_supplier,tg_date,tgs_invoice_no  order by tg_supplier desc  "); 
 
        $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){ 
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
            
                           $total=$total+$result_kotlist['tot'];  
                           $sub_total=$sub_total+$result_kotlist['sub_tot'];  
                           $tax_total=$tax_total+$result_kotlist['tax_tot'];  
                                                                   
                           $i++ ;                                                 
                        
                          $data['Sl']=$i;
                          $data['Invoice No']=$result_kotlist['tgs_invoice_no'];
                          $data['Grn No']=$result_kotlist['tg_grn_id'];
                          $data['Date']=$result_kotlist['tg_date'];
                         
                          $data['Supplier']=$result_kotlist['v_name'];
                          $data['Addres']=$result_kotlist['v_address'];
                          $data['Gst No']=$result_kotlist['gst'];
                          $data['Sub Total ']=number_format($result_kotlist['sub_tot'],$_SESSION['be_decimal']) ;
                          $data['Tax Amount']=number_format($result_kotlist['tax_tot'],$_SESSION['be_decimal']) ;
                          $data['Total']=number_format($result_kotlist['tot'],$_SESSION['be_decimal']) ;
                         
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
                         
                         
     
      }  }
      
                         $data['Sl']="TOTAL";
                          $data['Invoice No']='';
                           $data['Grn No']='';
                          $data['Date']='';
                         
                          $data['Supplier']='';
                           $data['Addres']='';
                          $data['Gst No']='';
                          $data['Sub Total ']=number_format($sub_total,$_SESSION['be_decimal']) ;
                          $data['Tax Amount']=number_format($tax_total,$_SESSION['be_decimal']) ;
                          $data['Total']=number_format($total,$_SESSION['be_decimal']) ;
                         
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;       
    
     
      $date=  date('Y-m-d H:i:s');   
        
  $filename = "Supplier Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
 else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='grn_report'){
    
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
     $string2='';
    
     if($_REQUEST['supplier']!=''){
          $string.=" =*"; 
         
    $string1.=" and tp_supplier = '".$_REQUEST['supplier']."'   ";
    
    
     $string2.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
    }
    
    
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
   
   
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        $string1.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                          $string2.= " and  tg_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and tr_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
                         $string2.= " and  tg_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tr_dayclosedate between '".$from."' and '".$to."' ";
                         $string1.= " and  tp_dayclosedate between '".$from."' and '".$to."' ";
                     $string2.= " and  tg_date between '".$from."' and '".$to."' ";
                }
              
                
               $data=array();
            $data1=array();
            $xlsRow=1;  
          $i=0;      
                          
     if($_REQUEST['type']=='all' || $_REQUEST['type']=='req'){
         
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_requisition.tr_store where tr_set='Y' $string group by tr_req_id  order by tr_id desc  "); 
 
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
                                                      
                                                      
                          $data['Sl']=$i;
                          $data['Mode']='Requisition';
                          $data['Id']=$result_kotlist['tr_req_id'];
                          $data['Date']=$result_kotlist['tr_dayclosedate'];
                          $data['Supplier']='';
                          $data['Store']=$result_kotlist['ti_name'];
                          $data['Total Amt']='';
                          $data['Inv No']='';
                          $data['Inv Amt']='';
                          $data['Ret Amt']='';
                          $data['Items']=$count;
                          
                          if($result_kotlist['tr_status']=='Approved'){ 
                          $data['Status']='Approved';
                          }else if($result_kotlist['tr_status']=='Cancel'){ 
                              
                               $data['Status']='Cancelled';
                          } else{
                              $data['Status']='Pending';
                          } 
                              
                          $data['Approved / Cancelled By']=$result_kotlist['tr_status_login'];
                        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                                   
                                                    
      }  }
      
      
      
       }
     
      if($_REQUEST['type']=='all' || $_REQUEST['type']=='purchase'){
         
         
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_purchase_order.tp_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store where tp_set='Y' $string1 group by tp_purchase_id  order by tp_id desc  "); 
 
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
                                                                  
                 $i++ ;                                               
               
                         
                          $data['Sl']=$i;
                          $data['Mode']='Purchase Order';
                          $data['Id']=$result_kotlist['tp_purchase_id'];
                          $data['Date']=$result_kotlist['tp_dayclosedate'];
                          $data['Supplier']=$result_kotlist['v_name'];
                          $data['Store']=$result_kotlist['ti_name'];
                          $data['Total Amt']='';
                          $data['Inv No']='';
                          $data['Inv Amt']='';
                          $data['Ret Amt']='';
                          $data['Items']=$count;
                          
                          if($result_kotlist['tp_status']=='Approved'){ 
                          $data['Status']='Approved';
                          }else if($result_kotlist['tp_status']=='Cancel'){ 
                              
                               $data['Status']='Cancelled';
                          } else{
                              $data['Status']='Pending';
                          } 
                              
                          $data['Approved / Cancelled By']=$result_kotlist['tp_status_login'];
                        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;     
                         
                         
                         
      
      }  }
      
      
       }
       
       
       if($_REQUEST['type']=='all' || $_REQUEST['type']=='stock'){
         //$i=0;
      
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_grn_order left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2 group by tg_grn_id  order by tg_id desc  "); 
 
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
                                        
                                                                   
                 $i++ ;                                                 
                        
                           $data['Sl']=$i;
                          $data['Mode']='Stock Purchase';
                          $data['Id']=$result_kotlist['tg_grn_id'];
                          $data['Date']=$result_kotlist['tg_date'];
                          $data['Supplier']=$result_kotlist['v_name'];
                          $data['Store']=$result_kotlist['ti_name'];
                          $data['Total Amt']=number_format($result_kotlist['tg_final_total'],$_SESSION['be_decimal']) ;
                          $data['Inv No']=$result_kotlist['tgs_invoice_no'];
                          $data['Inv Amt']=number_format($result_kotlist['tg_grand_total'],$_SESSION['be_decimal']) ;
                          $data['Ret Amt']=number_format($ret,$_SESSION['be_decimal']) ; 
                          $data['Items']=$count;
                          
                          if($result_kotlist['tg_status']=='Approved'){ 
                          $data['Status']='Approved';
                          }else if($result_kotlist['tg_status']=='Cancel'){ 
                              
                               $data['Status']='Cancelled';
                          } else{
                              $data['Status']='Pending';
                          } 
                              
                          $data['Approved / Cancelled By']=$result_kotlist['tg_status_login'];
                        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
                         
                         
     
      }  }
      
       }
    
     
      $date=  date('Y-m-d H:i:s');   
        
  $filename = "RPS Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='req_report'){
    
    
 if($_REQUEST['req_po']=='req'){
    
    $string2='';
    
     if($_REQUEST['id']!=''){
       $string2.=" and tr_req_id like '%".$_REQUEST['id']."%'   ";
     }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    if($_REQUEST['product']!=''){
    $string2.=" and tr_name like '%".$_REQUEST['product']."%'   ";
    }
    
     
     if($_REQUEST['login_staff']!=''){
         
     $string2.=" and tr_login = '".$_REQUEST['login_staff']."'   ";
    
    }
    
     if($_REQUEST['store']!=''){
         
     $string2.=" and tr_store = '".$_REQUEST['store']."'   ";
    
    }
    
    
    if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    if($_REQUEST['indent_type']=='indent' ){
           
          $string2.=" and tr_indent = 'Y'   ";
          
       }else if($_REQUEST['indent_type']=='central'){ 
       
          $string2.=" and tr_central = 'Y'   ";
           
      }else if($_REQUEST['indent_type']=='normal'){ 
       
          
          $string2.=" and tr_central = 'N'  and tr_indent='N'  ";   
          
      }
    
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tr_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                       
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tr_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tr_dayclosedate between '".$from."' and '".$to."' ";
                }
    
     $data=array();
     $data1=array();
     $xlsRow=1;  
         
     
     $i=1;$total1=0;
     $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_requisition.tr_product "
            . "  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_inv_kitchen on "
            . "  tbl_inv_kitchen.ti_id=tbl_requisition.tr_store  where"
            . "  tr_set='Y' $string2  group by tr_req_id order by tr_id desc  "); 
     
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
	if($num_kotlist1){ 
	while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
	{  
                          $data['Sl']=$i++;
                        
                          $data['Grn Id']='Date:'.$result_kotlist1['tr_dayclosedate'];
                          $data['Product']='Id:'.$result_kotlist1['tr_req_id'];
                         
                          $data['Barcode']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                         
                          
                          $data['Date']='';
                          $data['Store']='';
                          $data['Type']='';
                          $data['Login']='';
                             
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
            
            
            
            
    
    $ii=1;$total=0;
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_requisition.tr_product  left join tbl_menumaincategory"
            . " on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_requisition.tr_store"
            . " where tr_req_id='".$result_kotlist1['tr_req_id']."' and"
            . "  tr_set='Y' $string2   order by tr_id desc  "); 
     
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                             
                                          
    
                          $data['Sl']=$ii++;
                          $data['Grn Id']=$result_kotlist['tr_req_id'];
                          $data['Product']=$result_kotlist['tr_name'];
                          $data['Barcode']=$result_kotlist['tr_barcode'];
                          $data['Rate Type']=$result_kotlist['tr_rate_type'];
                          $data['Unit']=$result_kotlist['tr_unittype'];
                          $data['Qty']=$result_kotlist['tr_qty'];
                          $data['Weight']=$result_kotlist['tr_weight'];
                          
                          
                           $data['Date']=$result_kotlist['tr_dayclosedate'];
                           $data['Store']=$result_kotlist['ti_name'];
                        
                           
                            
                            
                          if($result_kotlist['tr_indent']=='Y' ){ 
           
          $data['Type']='Indent';
          
                          }else if($result_kotlist['tr_central']=='Y'){ 
       
           $data['Type']='Central';
           
                         }else if($result_kotlist['tr_indent']=='N' && $result_kotlist['tr_central']=='N'){ 
       
            $data['Type']='Normal';
            
                          } 
                            
                     $data['Login']=$result_kotlist['tr_login'];          
                            
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
      
                                                  }
                                                  }
                                                  
                                        }}
                                        
    }else{
        
        
        
        $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tp_purchase_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    if($_REQUEST['product']!=''){
    $string2.=" and tp_name like '%".$_REQUEST['product']."%'   ";
    }
    
     
    
    
    if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    
    
     if($_REQUEST['login_staff']!=''){
         
     $string2.=" and tp_login = '".$_REQUEST['login_staff']."'   ";
    
    }
    
    
     if($_REQUEST['store']!=''){
         
     $string2.=" and tp_store = '".$_REQUEST['store']."'   ";
    
    }
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tp_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                       
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tp_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tp_dayclosedate between '".$from."' and '".$to."' ";
                }
    
     $data=array();
            $data1=array();
            $xlsRow=1;  
                
          
            
    $i=1;$total1=0;
     $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_order.tp_product "
            . "  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_inv_kitchen on "
            . "  tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store  where"
            . "  tp_set='Y' $string2  group by tp_purchase_id order by tp_id desc  "); 
     
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                      $data['Sl']=$i++;
                        
                          $data['Grn Id']='Date:'.$result_kotlist1['tp_dayclosedate'];
                          $data['Product']='Id:'.$result_kotlist1['tp_purchase_id'];
                         
                          $data['Barcode']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                         
                          
                           $data['Date']='';
                            $data['Store']='';
                            $data['Supplier']='';
                               $data['Login']='';
                             
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
            
            
            
            
    
    $ii=1;$total=0;
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_order.tp_product  left join tbl_menumaincategory"
            . " on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store"
            . " left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_purchase_order.tp_supplier where tp_purchase_id='".$result_kotlist1['tp_purchase_id']."' and"
            . "  tp_set='Y' $string2   order by tp_id desc  "); 
     
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                             
                                          
    
                          $data['Sl']=$ii++;
                          $data['Grn Id']=$result_kotlist['tp_purchase_id'];
                          $data['Product']=$result_kotlist['tp_name'];
                          $data['Barcode']=$result_kotlist['tp_barcode'];
                          $data['Rate Type']=$result_kotlist['tp_rate_type'];
                          $data['Unit']=$result_kotlist['tp_unittype'];
                          $data['Qty']=$result_kotlist['tp_qty'];
                          $data['Weight']=$result_kotlist['tp_weight'];
                          
                          
                           $data['Date']=$result_kotlist['tp_dayclosedate'];
                           $data['Store']=$result_kotlist['ti_name'];
                           
                           
                             $data['Supplier']=$result_kotlist['v_name'];
                               $data['Login']=$result_kotlist['tp_login'];
                         
                            
                            
                            
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
      
                                                  }
                                                  }
                                                  
                                        }}
        
        
        
        
    }                               
                                              
                                                  
                                                  
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Requisition_Purchase Report".$date.".xls";
  
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='grn_item_report'){
    
    
                          
   
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
    
    if($_REQUEST['product']!=''){
    $string2.=" and tg_name like '%".$_REQUEST['product']."%'   ";
    }
    
      if($_REQUEST['supplier']!=''){
    $string2.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
    }
    
    
    if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    
    
     $string22='';
     if($_REQUEST['asc_desc']!=''){
         
             if($_REQUEST['asc_desc']=='ascq'){
                         
                  $string22.=" order by tg_qty asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descq'){
                         
                  $string22.=" order by tg_qty desc  ";               
              }
              
               if($_REQUEST['asc_desc']=='ascw'){
                         
                  $string22.=" order by tg_weight asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descw'){
                         
                  $string22.=" order by tg_weight desc  ";               
              }
        }else{
            
           $string22.=' order by tg_id desc  ';   
            
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
			
                     $string2.= " and  tg_date between '".$from."' and '".$to."' ";
                }
    
     $data=array();
            $data1=array();
            $xlsRow=1;  
                
            
            
             $i=1;$total1=0;
    $sql_kotlist1  =  $database->mysqlQuery("SELECT *,sum(tg_final_rate) as tot_grn from tbl_grn_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_grn_order.tg_product  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2  group by tg_grn_id $string22 "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                          $data['Sl']=$i++;
                        
                          $data['Grn Id']='Date:'.$result_kotlist1['tg_date'];
                          $data['Product']='Id:'.$result_kotlist1['tg_grn_id'];
                         
                          $data['Barcode']='Supplier:'.$result_kotlist1['v_name'];
                          $data['Batch No ']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']='';
                          $data['Tax']=''; 
                          
                          $data['Entry Date']='';
                          $data['Supplier']='';
                          $data['Final Total']='Total:'.number_format($result_kotlist1['tot_grn'],$_SESSION['be_decimal']) ;  
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
            
            
            
            
    
    $ii=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_grn_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_grn_order.tg_product  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_grn_id='".$result_kotlist1['tg_grn_id']."' and  tg_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                             
                                              $total=$total+$result_kotlist['tg_final_rate'];        
    
                          $data['Sl']=$ii++;
                          $data['Grn Id']=$result_kotlist['tg_grn_id'];
                          $data['Product']=$result_kotlist['tg_name'];
                          $data['Barcode']=$result_kotlist['tg_barcode'];
                          $data['Batch No']=$result_kotlist['tg_batch_id'];
                          $data['Rate Type']=$result_kotlist['tg_rate_type'];
                          $data['Unit']=$result_kotlist['tg_unittype'];
                          $data['Qty']=$result_kotlist['tg_qty'];
                          $data['Weight']=$result_kotlist['tg_weight'];
                          $data['Rate']=number_format($result_kotlist['tg_unit_rate'],$_SESSION['be_decimal']) ;
                          $data['Total']=number_format($result_kotlist['tg_total_rate'],$_SESSION['be_decimal']) ;
                          $data['Tax']=number_format($result_kotlist['tg_tax_rate'],$_SESSION['be_decimal']) ; 
                          
                           $data['Entry Date']=$result_kotlist['tg_dayclosedate'];
                           $data['Supplier']=$result_kotlist['v_name'];
                          $data['Final Total']=number_format($result_kotlist['tg_final_rate'],$_SESSION['be_decimal']) ;  
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;        
      
                                                  }
                                                  }
                                             $total1=$total1+$total;           
                                        }}
                                        
                                        
                          $data['Sl']='Total';
                          $data['Grn Id']='';
                          $data['Product']='';
                          $data['Barcode']='';
                          $data['Barcode']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']='';
                          
                          $data['Tax']='';
                          $data['Entry Date']='';
                          $data['Supplier']='';
                          $data['Final Total']=number_format($total1,$_SESSION['be_decimal']) ;  
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;                                
                                                  
                                                  
    $date=  date('Y-m-d H:i:s');   
        
  $filename = "Grn Item Wise Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='transfer_report'){
                          
    
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tt_trn_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    
     if($_REQUEST['from_store']!=''){
    $string2.=" and tt_from_store = '".$_REQUEST['from_store']."'   ";
    }
    
    
     if($_REQUEST['to_store']!=''){
    $string2.=" and tt_to_store = '".$_REQUEST['to_store']."'   ";
    }
    
    
     if($_REQUEST['product']!=''){
    $string2.=" and tt_name like '%".$_REQUEST['product']."%'   ";
    }
    
    
    
     if($_REQUEST['indent_type']!=''){
        
    if($_REQUEST['indent_type']=='normal'){     
        
    $string2.=" and tt_indent is null and tt_transfer_from_central= 'N'   ";
    
    }else if($_REQUEST['indent_type']=='indent'){
        
        $string2.=" and tt_indent != ''   ";
        
    }else if($_REQUEST['indent_type']=='central'){
        
        $string2.=" and tt_transfer_from_central = 'Y'   ";
    }
    
    
    }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tt_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tt_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tt_dayclosedate between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tt_dayclosedate between '".$from."' and '".$to."' ";
                }
    
    
     $data=array();
     $data1=array();
     $xlsRow=1; 
     
    $i=1;$total1=0;
    $sql_kotlist1  =  $database->mysqlQuery("SELECT tt_dayclosedate,tt_trn_id,tt_total,sum(tt_total) as tot_trn from tbl_store_transfer   where tt_set='Y' $string2  group by tt_trn_id order by tt_id desc  "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                                                      
                          $data['Sl']=$i++;
                          $data['Id']='Date:'.$result_kotlist1['tt_dayclosedate'];
                          $data['Indent Id']='';
                          $data['Direct Id']='';
                          $data['Product']='Id:'.$result_kotlist1['tt_trn_id'];
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']='';
                          $data['From Store']='';
                          $data['To Store']='';
                          $data['Transfer By']='';
                          $data['Accept By']='';
                          $data['Batch No']='Total:'.$result_kotlist1['tot_trn'];
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;   
     
    $ii=1;$total=0;
  
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer   where tt_trn_id ='".$result_kotlist1['tt_trn_id']."' and   tt_set='Y' $string2   order by tt_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tt_total'];
                                                      
                                                      
                                                      
                          $data['Sl']=$ii++;
                          $data['Id']=$result_kotlist['tt_trn_id'];
                          $data['Indent Id']=$result_kotlist['tt_indent'];
                          $data['Direct Id']=$result_kotlist['tt_direct_grn'];
                          $data['Product']=$result_kotlist['tt_name'];
                          $data['Rate Type']=$result_kotlist['tt_rate_type'];
                          $data['Unit']=$result_kotlist['tt_unit_type'];
                          $data['Qty']=$result_kotlist['tt_qty'];
                          $data['Weight']=$result_kotlist['tt_weight'];
                          $data['Rate']=number_format( $result_kotlist['tt_rate'],$_SESSION['be_decimal']) ;  
                          $data['Total']=number_format(  $result_kotlist['tt_total'],$_SESSION['be_decimal']) ;  
                        
                                                      
            
    $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen  where ti_id='".$result_kotlist['tt_from_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
		if($num_kotlistf){ 
		while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
			{  
                                                   
                          $data['From Store']=$result_kotlistf['ti_name'];
      
      } }
      
      
      
      
    $sql_kotlistt  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tt_to_store']."'   "); 
 
    $num_kotlistt  = $database->mysqlNumRows($sql_kotlistt);
					if($num_kotlistt){ 
						  while($result_kotlistt  = $database->mysqlFetchArray($sql_kotlistt)) 
							  {  
                                                    
     $data['To Store']=$result_kotlistt['ti_name'];
     
    
       } } 
      
       
         $data['Transfer By']=$result_kotlist['tt_transfer_login'];
                          
                          
         if($result_kotlist['tt_normal']=='Y'  ){
                                  
         $data['Accept By']=$result_kotlist['tt_normal_accept_login'];         
                           
        }else if($result_kotlist['tt_direct_grn']!=''){ 
                         
          $data['Accept By']= $result_kotlist['tt_direct_accept_by'];
           
        } else if($result_kotlist['tt_indent']!='' ){
       
         $data['Accept By']=  $result_kotlist['tt_indent_accepted_login'];
        }
                          
             
        $data['Batch No']=$result_kotlist['tt_batch_id'];
                        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;       
      
    
    
                                                      
           
             }
             }
            
             $total1=$total1+$total;
                                        }}
                          $data['Sl']='Total';
                          $data['Id']='';
                          $data['Indent Id']='';
                          $data['Direct Id']='';
                          $data['Product']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']= '';   
                          
                          $data['From Store']='';
                          $data['To Store']='';
                          $data['Transfer By']='';
                          $data['Accept By']='';
                          
                          $data['Batch No']=number_format($total1,$_SESSION['be_decimal']);
                        
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;      
                          
                          
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Store Transfer Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='physical_stock_report'){
    
    
                                
                          
    
    
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tps_phy_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    
     if($_REQUEST['store']!=''){
                $string2.=" and tps_store ='".$_REQUEST['store']."'   ";
         }else{
            $string2.=" "; 
         }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tps_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tps_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tps_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tps_date between '".$from."' and '".$to."' ";
                }
    
    
     $data=array();
     $data1=array();
     $xlsRow=1; 
     
    $i=1;$total=0;
  
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_physical_stock   where tps_set='Y' $string2   order by tps_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                          $data['Sl']=$i++;
                          $data['Date']=$result_kotlist['tps_date'];
                          $data['Id']=$result_kotlist['tps_phy_id'];
                          $data['Product']=$result_kotlist['tps_name'];
                          $data['Rate Type']=$result_kotlist['tps_rate_type'];
                          $data['Unit']=$result_kotlist['tps_unittype'];
                          $data['Real Qty']=$result_kotlist['tps_store_qty'];
                          $data['Phy Qty']=$result_kotlist['tps_qty'];
                          $data['Real Weight']=$result_kotlist['tps_store_weight'];
                          $data['Phy Weight']=$result_kotlist['tps_weight'];
                          
                          
       if($result_kotlist['tps_unittype']=='Single' || $result_kotlist['tps_unittype']=='Nos'){ 
     
       $data['Difference']=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty']);
             
      }else{ 
                  
                  
      if( $result_kotlist['tps_rate_type']=='Packet' && ($result_kotlist['tps_unittype']=='KG' || $result_kotlist['tps_unittype']=='LTR')){   
         
     $data['Difference']=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty']);
                
           }else{ 
           $data['Difference']=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight']);
           
       } } 
               
       
       if($result_kotlist['tps_unittype']=='Single' || $result_kotlist['tps_unittype']=='Nos'){ 
     
       $data['Difference Value']=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])*$result_kotlist['tps_rate'];
             
      }else{ 
                  
                  
      if( $result_kotlist['tps_rate_type']=='Packet' && ($result_kotlist['tps_unittype']=='KG' || $result_kotlist['tps_unittype']=='LTR')){   
         
     $data['Difference Value']=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])*$result_kotlist['tps_rate'];
                
           }else{ 
           $data['Difference Value']=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight'])*$result_kotlist['tps_rate'];
           
       } } 
       
                                                           
    $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tps_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
		if($num_kotlistf){ 
		while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
		{  
                                                   
             $data['Store']=$result_kotlistf['ti_name'];
      
       } }
      
      
      array_push($data1,$data);
      unset($data);
      $xlsRow++;
     
   }
   }
             
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Physical Stock Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='sales_reduce'){
    
    if($_REQUEST['recipe_type']==''){
    
    
     $data=array();
     $data1=array();
     $xlsRow=1; 
                    
        $string="";
        $stringta="";
       
	$string.=" bm.bm_status = 'Closed'";
        $stringta.=" bm.tab_status = 'Closed'";
    
    if($_REQUEST['product']!=''){
        
           $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
    }
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$_REQUEST['fromdt'];
		    $to=$_REQUEST['todt'];
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                   
                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$_REQUEST['fromdt'];
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     	
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$_REQUEST['todt'];
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     
                }else{
                      $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
    
       $i=0;$p=0;$old_cat=""; $old_menu='';$unit_type=''; $item1='';
       $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
       $weight=0;$unit='';$weight_loose=0;$loose_total=0;
       $qty_final=0; $qty_final_ta=0; $qty_final_cs=0;    $final=0;
         
    $sql_kotlist  =  $database->mysqlQuery("select rt,maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,
        unitid,unitname,baseunitid,baseunitname,sum(qty_all)as qty_all,sum(total)as total , dayclose
          from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,
          bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all , 
                                        sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where mm.mr_product_type='Finished' and  bd.bd_count_combo_ordering is NULL and $string  
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight
                                            
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate as rt, sum(bd.tab_qty) as qty_all ,
                                        sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where  mm.mr_product_type='Finished' and bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD','CS')   and $stringta 
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by dayclose,maincategory,menuid "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_stw  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                            $i++; $p++;
                            if($result_stw['maincategory']!=$old_cat){
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                                $catname='.'; 
                            }
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_all'];
                            
                            $qty_all=$qty;
                            
                            $weight=$result_stw['weight'];
                            
                            if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty='0';
                             
                            }else{
                              $qty=$result_stw['qty_all'];
                            }
                            
                            if($result_stw['portionid']!=''){
                                $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            }
                            else{
                                  $unit_type=$result_stw['unit_type'] ;
                                if($result_stw['unitid']!=''){
                                    $unit=$result_stw['unitname'] ;
                                  
                                }
                                else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            if($unit_type=='Loose'){
                                
                                    $catname=$result_stw['maincategory'];            
                                    
                                if($result_stw['menuid']==$old_menu){
                                
                                
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty_all);
                                   
                                   $t=$i-1;
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                    unset($data1[$t-1]);
                                  
                                   $p=$p-1;
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$qty_all;
                                    $loose_total=$result_stw['total'];
                                    
                                    
                                    
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='0';
                                
                            }
                                     
                                                      
                                                      
                        $final=$final+$total;
                     $qty_final=$qty_final+$qty;
                     $qty_final_ta=$qty_final_ta+$qty_ta;
                     $qty_final_cs=$qty_final_cs+$qty_cs;
                        
                        
               $tt_qty=0;         
              $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;
                      
              if($weight != ''){ 
                  $pt= number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;
                  
              } else { 
                  $pt= $unit; 
                  
              }
              
             
                                
                           $data['Sl']=$p;
                          $data['Category']=substr(strtoupper($catname),0,20);
                          $data['Sub category']=strtoupper($subcatname);
                          $data['Item']=substr(strtoupper($menuname),0,25);
                          $data['Unit']=$unit_type;
                          $data['Rate']=number_format($result_stw['rt'],$_SESSION['be_decimal']) ;   
                          $data['Portion - Weight']= $pt;
                          $data['Qty']=$qty;
                          $data['Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                 array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
              
      
             }
                 } 
                 
                 
                 
                 
                             $data['Sl']='Total';
                          $data['Category']='';
                          $data['Sub category']='';
                          $data['Item']='';
                          $data['Unit']='';
                           $data['Rate']='';
                          $data['Portion - Weight']='';
                          $data['Qty']='';
                           $data['Total']=number_format(str_replace(',','',$final),$_SESSION['be_decimal']);
                             array_push($data1,$data);
                          unset($data);
                          
                         // $xlsRow++;
      
      
    
}else if($_REQUEST['recipe_type']=='recipe'){

    ///recipee wise///
    
    
      $data=array();
     $data1=array();
     $xlsRow=1; 
                    
        $string="";
        $stringta="";
       
	$string.=" bm.bm_status = 'Closed'";
        $stringta.=" bm.tab_status = 'Closed'";
    
    if($_REQUEST['product']!=''){
        
           $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
    }
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$_REQUEST['fromdt'];
		    $to=$_REQUEST['todt'];
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                   
                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$_REQUEST['fromdt'];
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     	
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$_REQUEST['todt'];
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     
                }else{
                      $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
    
       $i=0;$p=0;$old_cat=""; $old_menu='';$unit_type=''; $item1='';
       $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
       $weight=0;$unit='';$weight_loose=0;$loose_total=0;
       $qty_final=0; $qty_final_ta=0; $qty_final_cs=0;    $final=0; $final_rec=0; $final_rec1=0;
         
    $sql_kotlist  =  $database->mysqlQuery("select rt,maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,
        unitid,unitname,baseunitid,baseunitname,sum(qty_all)as qty_all,sum(total)as total , dayclose
          from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,
          bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all , 
                                        sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where mm.mr_product_type='Finished' and  bd.bd_count_combo_ordering is NULL and $string  
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight
                                            
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate as rt, sum(bd.tab_qty) as qty_all ,
                                        sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where  mm.mr_product_type='Finished' and bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD','CS')   and $stringta 
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by dayclose,maincategory,menuid "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_stw  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                            $i++; $p++;
                            if($result_stw['maincategory']!=$old_cat){
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                                $catname='.'; 
                            }
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_all'];
                            
                            $qty_all=$qty;
                            
                            $weight=$result_stw['weight'];
                            
                            if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty='0';
                             
                            }else{
                              $qty=$result_stw['qty_all'];
                            }
                            
                            if($result_stw['portionid']!=''){
                                $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            }
                            else{
                                  $unit_type=$result_stw['unit_type'] ;
                                if($result_stw['unitid']!=''){
                                    $unit=$result_stw['unitname'] ;
                                  
                                }
                                else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            if($unit_type=='Loose'){
                                
                                    $catname=$result_stw['maincategory'];            
                                    
                                if($result_stw['menuid']==$old_menu){
                                
                                
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty_all);
                                   
                                   $t=$i-1;
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                    unset($data1[$t-1]);
                                  
                                   $p=$p-1;
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$qty_all;
                                    $loose_total=$result_stw['total'];
                                    
                                    
                                    
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='0';
                                
                            }
                                     
                                                      
                                                      
                        $final=$final+$total;
                     $qty_final=$qty_final+$qty;
                     $qty_final_ta=$qty_final_ta+$qty_ta;
                     $qty_final_cs=$qty_final_cs+$qty_cs;
                        
                        
               $tt_qty=0;         
              $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;
                      
              if($weight != ''){ 
                  $pt= number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;
                  
              } else { 
                  $pt= $unit; 
                  
              }
              
             
                                
                           $data['Sl']=$p;
                          $data['Category']=substr(strtoupper($catname),0,20);
                          
                          $data['Item']=substr(strtoupper($menuname),0,25);
                           $data['Recipes']='';
                          $data['Unit']=$unit_type;
                          $data['Rate']=number_format($result_stw['rt'],$_SESSION['be_decimal']) ;   
                          $data['Rate Type']= $pt;
                          $data['Qty']=$qty;
                           $data['Weight']='';
                          $data['Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                 array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                          
                          
                          
                  $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_menu_ingredient_detail  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_menu_ingredient_detail.tmi_store  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_menu_ingredient_detail.tmi_ing_menuid  where tbl_menu_ingredient_detail.tmi_menuid='".$result_stw['menuid']."'   order by mr_menuname desc  "); 
 
                  $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			if($num_kotlist){ 
			while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			{  
                            
                          $final_rec=($result_kotlist['tmi_ing_total']*$qty);
                          $final_rec1=$final_rec1+$final_rec;
                         
                          $data['Sl']='';
                          $data['Category']='';
                         
                          $data['Item']='';
                          $data['Recipes']=$result_kotlist['mr_menuname'];
                          $data['Unit']=$result_kotlist['tmi_ing_unit'];
                          $data['Rate']=number_format($result_kotlist['tmi_ing_total'],$_SESSION['be_decimal']) ;   
                          $data['Rate Type']= $result_kotlist['tmi_rate_type'];
                          $data['Qty']=$result_kotlist['tmi_ing_qty'];
                          $data['Weight']=$result_kotlist['tmi_weight'];
                          $data['Total']=number_format(str_replace(',','',$final_rec),$_SESSION['be_decimal']);
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                          
                        }}
                          
              
      
             }
                 } 
                 
                 
                   $prf=0;
                 
                          $prf=($total-$final_rec1);
                 
                          $data['Sl']='Recipe Total';
                          $data['Category']='';
                         
                          $data['Item']='';
                          $data['Recipes']='';
                          $data['Unit']='';
                          $data['Rate']=$prf;
                          $data['Rate Type']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Total']=number_format(str_replace(',','',$final_rec1),$_SESSION['be_decimal']);
                          array_push($data1,$data);
                          unset($data);
                          
                         // $xlsRow++;
    
    


}else if($_REQUEST['recipe_type']=='stock'){
           

 //stock wise///
    
        $string="";
        $stringta="";
       
	$string.=" bm.bm_status = 'Closed'";
        $stringta.=" bm.tab_status = 'Closed'";
    
    if($_REQUEST['product']!=''){
        
           $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
    }
    
     if($_REQUEST['store']!=''){
        
         $string.= " and bd.bd_staff_store = '".$_REQUEST['store']."' ";
         $stringta.= " and bd.tab_staff_store = '".$_REQUEST['store']."' ";
    }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$_REQUEST['fromdt'];
		    $to=$_REQUEST['todt'];
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                   
                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$_REQUEST['fromdt'];
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     	
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$_REQUEST['todt'];
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     
                }else{
                      $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
    
       $old_cat=""; $old_menu='';$unit_type='';
       $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;
       $weight=0;$unit='';$weight_loose=0;$loose_total=0;
       
     $data=array();
     $data1=array();
     $xlsRow=1; 
       $final_rec=0; $final_rec1=0;
               
       $sql_kotlist  =  $database->mysqlQuery("select rt,maincategory,menuid,menuname, rate_type,unit_type,portionid,weight,
        unitid,baseunitid,sum(qty_all)as qty_all, dayclose
        from (select mc.mmy_maincategoryname as maincategory, 
        bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,
        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,
        bd.bd_base_unit_id as baseunitid, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all , 
        sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
        FROM tbl_tablebilldetails bd left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
        where   (mm.mr_product_type='Finished' or mm.mr_product_type='Raw') and bd.bd_count_combo_ordering is NULL and $string  
        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight
                                            
        union all 
                                        
        select mc.mmy_maincategoryname as maincategory,bd.tab_menuid as menuid,
        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,
        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,
        bd.tab_base_unit_id as baseunitid, bd.tab_rate as rt, sum(bd.tab_qty) as qty_all ,
        sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
        FROM tbl_takeaway_billdetails bd left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
        where  (mm.mr_product_type='Finished' or mm.mr_product_type='Raw') and bd.tab_count_combo_ordering is NULL   and $stringta 
        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        
        )x group by menuid,portionid,unitid,baseunitid,dayclose order by dayclose,maincategory,menuname asc "); 
 
      
                            $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			    if($num_kotlist){ 
			    while($result_stw  = $database->mysqlFetchArray($sql_kotlist)) 
			    {  
                           
                            
                            
                                $catname=$result_stw['maincategory'];
                          
                          
                            $menuname=$result_stw['menuname'];
                          
                            $qty=$result_stw['qty_all'];
                            
                            $weight=$result_stw['weight'];
                      
                            if($result_stw['portionid']!=''){
                                $weight='0';
                             
                            }
                           
                            if($result_stw['unit_type']=='Loose'){
                                
                                 
                                if($result_stw['menuid']==$old_menu){
                                
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty);
                                  
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$qty;
                                  
                                }
                                
                                $weight=$weight_loose;
                               
                            }
                                
             
                    if($result_stw['unit_type']!='Loose' && $result_stw['unit_type']!='Packet'){         
                        
                        $sales_reduce=$qty;
                        
                    }else{
                         
                       if($result_stw['unitid']!='5' && $result_stw['baseunitid']!='3'){     
                           $sales_reduce=$weight;
                       }else{
                            $sales_reduce=$qty;
                       }
                       
                       
                    }
                     
                if($result_stw['weight']>0){    
                $unit_weight='['.$result_stw['weight'].']';
                }else{
                 $unit_weight='';   
                }
                
                    
                    
                    
      $stringopen='';       
      
     if($_REQUEST['store']!=''){
           $stringopen.= " and ts_store= '".$_REQUEST['store']."' ";
           
    }                        
                                                      
                      
   $openstock='0';                          
   $sql_kotlist1  =  $database->mysqlQuery("SELECT ts_rate_type,ts_unit,sum(ts_qty) as qty, sum(ts_weight) as weight from tbl_store_stock where ts_product='".$result_stw['menuid']."' $stringopen  "); 
   $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
   if($num_kotlist1){  $openstock='0';     
    while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist1)) 
	{  
        
             
               if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){
                           
                            $openstock= $result_kotlist['qty']; 
                        
                       }else{
                           
                           if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR')){
                           
                              $openstock= $result_kotlist['qty']; 
                           
                           }else{
                              
                              $openstock= $result_kotlist['weight'];    
                               
                           }
                           
                       }
                       
                       
               if($openstock=='' || $openstock==NULL){
              
             $openstock=0; 
          }         
                       
                       
              
    } }                   
                            
           
    
    $stringpur='';                        
     if($_REQUEST['store']!=''){
           $stringpur.= " and tg_store= '".$_REQUEST['store']."' ";
           
    }    
    
    
   $purchase='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tg_rate_type,tg_unittype,sum(tg_qty) as qty, sum(tg_weight) as weight from tbl_grn_order where "
   . " tg_product='".$result_stw['menuid']."' and  tg_dayclosedate ='".$result_stw['dayclose']."' $stringpur "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){   $purchase='0';    
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tg_unittype']=='Nos' || $result_kotlist11['tg_unittype']=='Single'){
                           
                            $purchase= $result_kotlist11['qty']; 
                        
                       }else{
                           
          if($result_kotlist11['tg_rate_type']=='Packet' && ($result_kotlist11['tg_unittype']=='KG' || $result_kotlist11['tg_unittype']=='LTR')){
                           
                              $purchase= $result_kotlist11['qty']; 
                           
          }else{
                              
                              $purchase= $result_kotlist11['weight'];    
                               
          }
                           
          }
          
          if($purchase=='' || $purchase==NULL){
              
             $purchase=0; 
          }
          
          
    }
    }
    
    
    
    $stringtran='';                        
     if($_REQUEST['store']!=''){
           $stringtran.= " and tt_from_store= '".$_REQUEST['store']."' ";
           
    }  
    
   $transfer='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tt_rate_type,tt_unit_type,sum(tt_qty) as qty, sum(tt_weight) as weight from tbl_store_transfer where "
   . " tt_product='".$result_stw['menuid']."' and  tt_dayclosedate ='".$result_stw['dayclose']."' $stringtran "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){ 
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tt_unit_type']=='Nos' || $result_kotlist11['tt_unit_type']=='Single'){
                           
                            $transfer= $result_kotlist11['qty']; 
                        
                       }else{
                           
          if($result_kotlist11['tt_rate_type']=='Packet' && ($result_kotlist11['tt_unit_type']=='KG' || $result_kotlist11['tt_unit_type']=='LTR')){
                           
                              $transfer= $result_kotlist11['qty']; 
                           
          }else{
                              
                              $transfer= $result_kotlist11['weight'];    
                               
          }
                           
    }
     if($transfer=='' || $transfer==NULL){
              
             $transfer=0; 
          }
    
    
    }
    }
    
    
    $stringcons='';                        
     if($_REQUEST['store']!=''){
           $stringcons.= " and tc_store= '".$_REQUEST['store']."' ";
           
    }  
    
   $consumption='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tc_rate_type,tc_unit_type,sum(tc_qty) as qty, sum(tc_weight) as weight from tbl_consumption where "
   . " tc_product='".$result_stw['menuid']."' and  tc_date ='".$result_stw['dayclose']."' $stringcons "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){ 
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tc_unit_type']=='Nos' || $result_kotlist11['tc_unit_type']=='Single'){
                           
                            $consumption= $result_kotlist11['qty']; 
                        
                       }else{
                           
          if($result_kotlist11['tc_rate_type']=='Packet' && ($result_kotlist11['tc_unit_type']=='KG' || $result_kotlist11['tc_unit_type']=='LTR')){
                           
                              $consumption= $result_kotlist11['qty']; 
                           
          }else{
                              
                              $consumption= $result_kotlist11['weight'];    
                               
          }
                           
    }
    
     if($consumption=='' || $consumption==NULL){
              
             $consumption=0; 
          }
          
    
    
    }
    }
    
    
     $stringret='';                        
     if($_REQUEST['store']!=''){
           $stringret.= " and tpr_store= '".$_REQUEST['store']."' ";
           
    }  
    
    $return='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tpr_rate_type,tpr_unit_type,sum(tpr_qty) as qty, sum(tpr_weight) as weight from tbl_purchase_return where "
   . " tpr_menu='".$result_stw['menuid']."' and  tpr_date ='".$result_stw['dayclose']."' $stringret "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){ 
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tpr_unit_type']=='Nos' || $result_kotlist11['tpr_unit_type']=='Single'){
                           
                            $return= $result_kotlist11['qty']; 
                        
                       }else{
                           
          if($result_kotlist11['tpr_rate_type']=='Packet' && ($result_kotlist11['tpr_unit_type']=='KG' || $result_kotlist11['tpr_unit_type']=='LTR')){
                           
                              $return= $result_kotlist11['qty']; 
                           
          }else{
                              
                              $return= $result_kotlist11['weight'];    
                               
          }
          
          
          
                           
    }
    
    
    if($return=='' || $return==NULL){
              
             $return=0; 
          }
    
    
    
    }
    }
    
    
    
     $stringphy='';                        
     if($_REQUEST['store']!=''){
           $stringphy.= " and tps_store= '".$_REQUEST['store']."' ";
           
    }  
    
   $physical='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tps_rate_type,tps_unittype,sum(tps_qty) as qty, sum(tps_weight) as weight, "
   . "sum(tps_store_qty) as store_qty, sum(tps_store_weight) as store_weight from tbl_physical_stock where "
   . " tps_product='".$result_stw['menuid']."' and  tps_date ='".$result_stw['dayclose']."' $stringphy "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){ 
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tps_unittype']=='Nos' || $result_kotlist11['tps_unittype']=='Single'){
                           
                            $physical= ($result_kotlist11['qty']-$result_kotlist11['store_qty']); 
                        
          }else{
                           
          if($result_kotlist11['tps_rate_type']=='Packet' && ($result_kotlist11['tps_unittype']=='KG' || $result_kotlist11['tps_unittype']=='LTR')){
                           
                             $physical= ($result_kotlist11['store_qty']-$result_kotlist11['qty']); 
                           
          }else{
                              
                            $physical= ($result_kotlist11['weight']-$result_kotlist11['store_weight']); 
                               
          }
        
        }
    
     if($physical=='' || $physical==NULL){
              
             $physical=0; 
             $physical_plus='0'; 
             $physical_minus='0'; 
             
      }
          
         
      
       if($physical>0){
              
             $physical_plus=$physical; 
             $physical_minus='0'; 
       }
      
      
       if($physical<0){
              
             $physical_minus=  substr($physical, 1,50); 
             $physical_plus='0'; 
      }
      
      
          
          
       
    }
    }
    
    
    
     $stringwas='';                        
     if($_REQUEST['store']!=''){
           $stringwas.= " and tw_store= '".$_REQUEST['store']."' ";
           
    }  
    
   $wastage='0';                          
   $sql_kotlist11  =  $database->mysqlQuery("SELECT tw_rate_type,tw_unit_type,sum(tw_qty) as qty, sum(tw_weight) as weight from tbl_wastage where "
   . " tw_product='".$result_stw['menuid']."' and  tw_date ='".$result_stw['dayclose']."' $stringwas "); 
   
   $num_kotlist11  = $database->mysqlNumRows($sql_kotlist11);
   if($num_kotlist11){ 
    while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist11)) 
	{  
        
         if($result_kotlist11['tw_unit_type']=='Nos' || $result_kotlist11['tw_unit_type']=='Single'){
                           
                            $wastage= $result_kotlist11['qty']; 
                        
                       }else{
                           
          if($result_kotlist11['tw_rate_type']=='Packet' && ($result_kotlist11['tw_unit_type']=='KG' || $result_kotlist11['tw_unit_type']=='LTR')){
                           
                              $wastage= $result_kotlist11['qty']; 
                           
          }else{
                              
                              $wastage= $result_kotlist11['weight'];    
                               
          }
                           
    }
    
     if($wastage=='' || $wastage==NULL){
              
             $wastage=0; 
          }
          
    
    
    }
    }
    
    
     $stringrec='';                        
     if($_REQUEST['store']!=''){
         
           $stringrec.= " and tmi_store= '".$_REQUEST['store']."' ";
           
    }  
    
    
    $recipe=0;
    
     $sql_kotlist55  =  $database->mysqlQuery(" SELECT * from tbl_menu_ingredient_detail  left join tbl_inv_kitchen on "
             . " tbl_inv_kitchen.ti_id=tbl_menu_ingredient_detail.tmi_store  left join tbl_menumaster on "
             . " tbl_menumaster.mr_menuid=tbl_menu_ingredient_detail.tmi_ing_menuid  where "
             . " tbl_menu_ingredient_detail.tmi_menuid='".$result_stw['menuid']."' and "
             . " tbl_menu_ingredient_detail.tmi_ing_dayclosedate='".$result_stw['dayclose']."' $stringrec "
             . " order by mr_menuname desc "); 
 
    $num_kotlist55 = $database->mysqlNumRows($sql_kotlist55);
	if($num_kotlist55){ 
	while($result_kotlist11  = $database->mysqlFetchArray($sql_kotlist55)) 
	{  
                                                      
                                                      
             if($result_kotlist11['tmi_ing_unit']=='Nos' || $result_kotlist11['tmi_ing_unit']=='Single'){
                           
             $recipe= $result_kotlist11['tmi_ing_qty']; 
                        
             }else{
                           
            if($result_kotlist11['tmi_rate_type']=='Packet' && ($result_kotlist11['tmi_ing_unit']=='KG' || $result_kotlist11['tmi_ing_unit']=='LTR')){
                           
                $recipe= $result_kotlist11['tmi_ing_qty']; 
                           
          }else{
                              
                $recipe= $result_kotlist11['tmi_weight'];    
                               
          }
               
          
         
          }                          
                                                      
            if($recipe=='' || $recipe==NULL){
              
             $recipe=0; 
          }                                          
                                                   
     }
     }
    
     
     
     if($result_stw['unit_type']!=''){
    
         $unittype=$result_stw['unit_type'];
         
     }else{
         $unittype='Portion';
     }
        
     
      
     
       
                   
            $data['Date']=$result_stw['dayclose'];
           $data['Category']=substr(strtoupper($catname),0,20);
             $data['Item']=substr(strtoupper($menuname),0,25);
                    
                $data['Type']=$unittype.$unit_weight;
                    
                  $data['Opening Stock']=($openstock+$sales_reduce+$consumption+$return+$wastage);
                  $data['Purchase']=$purchase;
                  $data['Sales']=$sales_reduce;
                  $data['Transfer']=$transfer;
                  $data['Consumption']=$consumption;
                  $data['Recipe']=$recipe*$qty;
                      $data['Physical+']=$physical_plus;
                     $data['Physical-']=$physical_minus;
                     $data['Return']=$return;
                      $data['Wastage']=$wastage;
                    $data['Closing Stock']=$openstock;
                     $data['Stock+']=($purchase);
                     $data['Stock-']=($sales_reduce+$consumption+$return+$wastage);
                
    
              array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                                                 
                 
       } }     
    
               
               
 }               
             
  $date=  date('Y-m-d H:i:s');   
        
  $filename = " Sales Reduction Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='purchase_return'){
    
      $data=array();
     $data1=array();
     $xlsRow=1; 
     
   
    
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tpr_return_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tpr_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tpr_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tpr_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tpr_date between '".$from."' and '".$to."' ";
                }
    
    
    
    $i=1; $total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_purchase_return  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_return.tpr_store  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_return.tpr_menu  where tpr_set='Y' $string2   order by tpr_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tpr_final'];
                                                      
                                                      
                          $data['Sl']=$i++;
                            $data['Date']=$result_kotlist['tpr_date'];
                          $data['Ret Id']=$result_kotlist['tpr_return_id'];
                           $data['Grn Id']=$result_kotlist['tpr_grn'];
                          $data['Product']=$result_kotlist['mr_menuname'];
                          $data['Rate Type']=$result_kotlist['tpr_rate_type'];
                          $data['Unit']=$result_kotlist['tpr_unit_type'];
                          $data['Qty']=$result_kotlist['tpr_qty'];
                          $data['Weight']=$result_kotlist['tpr_weight'];
                           $data['Rate']=number_format($result_kotlist['tpr_rate'],$_SESSION['be_decimal']) ;
                           $data['Total']=number_format($result_kotlist['tpr_total'],$_SESSION['be_decimal']) ; 
                           $data['Tax']=number_format($result_kotlist['tpp_tax_rate'],$_SESSION['be_decimal']) ;  
                         
                           $data['Final Total']=number_format(str_replace(',','',$result_kotlist['tpr_final']),$_SESSION['be_decimal']);
                            $data['Store']=$result_kotlist['ti_name'];
                          
                             array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                                                           
    
                                                      
      
          }
          }
                                              
                                                  
                           $data['Sl']='Total';
                            $data['Date']='';
                          $data['Ret Id']='';
                           $data['Grn Id']='';
                          $data['Product']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                           $data['Rate']='';
                           $data['Total']='';
                           $data['Tax']='';
                         
                           $data['Final Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                            $data['Store']='';
                           
                             array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;                   
      
       $date=  date('Y-m-d H:i:s');   
        
  $filename = " Purcahse Return Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='consumption_report'){
    
        $data=array();
     $data1=array();
     $xlsRow=1; 
     
     
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tc_con_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    
      if($_REQUEST['product']!=''){
    $string2.=" and tc_name like '%".$_REQUEST['product']."%'   ";
    }
    
    if($_REQUEST['store']!=''){
    $string2.=" and tc_store = '".$_REQUEST['store']."'   ";
    }
    
    
      $string22='';
     if($_REQUEST['asc_desc']!=''){
         
             if($_REQUEST['asc_desc']=='ascq'){
                         
                  $string22.=" order by tc_qty asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descq'){
                         
                  $string22.=" order by tc_qty desc  ";               
              }
              
               if($_REQUEST['asc_desc']=='ascw'){
                         
                  $string22.=" order by tc_weight asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descw'){
                         
                  $string22.=" order by tc_weight desc  ";               
              }
        }else{
            
           $string22.=' order by tc_id desc  ';   
            
        }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tc_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tc_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tc_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tc_date between '".$from."' and '".$to."' ";
                }
    
    
   
    $i=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_consumption   where tc_set='Y' $string2   $string22 "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tc_total'];
                                                      
                                          $data['Sl']=$i++;
                          $data['Id']=$result_kotlist['tc_con_id'];
                          $data['Product']=$result_kotlist['tc_name'];
                          $data['Rate Type']=$result_kotlist['tc_rate_type'];
                          $data['Unit']=$result_kotlist['tc_unit_type'];
                          $data['Qty']=$result_kotlist['tc_qty'];
                          $data['Weight']=$result_kotlist['tc_weight'];
                           $data['Rate']=number_format($result_kotlist['tc_rate'],$_SESSION['be_decimal']) ;
                           $data['Total']= number_format($result_kotlist['tc_total'],$_SESSION['be_decimal']) ;
                                      
                                                      
                                                      
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tc_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                   
                                                  
     $data['Store']=$result_kotlistf['ti_name'];
      
      } } 
      
      
      
      
     
                          $data['Date']=$result_kotlist['tc_date'];
                             array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;   
      
        }
          }
            
          
          
                         $data['Sl']='Total';
                          $data['Id']='';
                          $data['Product']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']=number_format($total,$_SESSION['be_decimal']);
                          $data['Store']='';
                          $data['Date']='';
          
       array_push($data1,$data);
                          unset($data);
                          
                        
 
 $date=  date('Y-m-d H:i:s');   
        
  $filename = " Consumption Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='conversion_report'){
    
        $data=array();
     $data1=array();
     $xlsRow=1; 
     
     
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tp_production_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    
    
               if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tpc_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tpc_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tpc_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tpc_date between '".$from."' and '".$to."' ";
                }
    
    
   
    $i=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_product_conversion   where tpc_set='Y' $string2   order by tpc_id asc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                           
                                                      
                          $data['Sl']=$i++;
                          
                         $fnct_menu = $database->mysqlQuery("select mr_menuname from tbl_menumaster where  mr_menuid='".$result_kotlist['tpc_from_product']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
           if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
        
                  $data['From Product']=$result_fnctvenue['mr_menuname'];
           } } 
           
           
            $fnct_menu = $database->mysqlQuery("select mr_menuname from tbl_menumaster where  mr_menuid='".$result_kotlist['tpc_to_product']."'  ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
           if ($num_fdtl > 0) { 
              while ($result_fnctvenue5 = $database->mysqlFetchArray($fnct_menu))
              { 
        
                  $data['To Product']=$result_fnctvenue5['mr_menuname'];
           } } 
           
           
           
           $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tpc_from_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf6  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                    
                                                  
  $data['From Store']=$result_kotlistf6['ti_name'];
      
     } }
            
     
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tpc_to_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf7  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                    
                                                  
  $data['To Store']=$result_kotlistf7['ti_name'];
      
     } }
                         
                          $data['Qty']=$result_kotlist['tpc_qty'];
                          $data['Weight']=$result_kotlist['tpc_weight'];
                          
                                      
                                                      
                                                      
              
      
        $data['Date']=$result_kotlist['tpc_date'];
        
          $data['Staff']=$result_kotlist['tpc_login'];
        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;   
      
        }
          }
         
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Conversion Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='production_report'){
    
        $data=array();
     $data1=array();
     $xlsRow=1; 
     
     
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tp_production_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
      if($_REQUEST['product']!=''){
    $string2.=" and tp_name like '%".$_REQUEST['product']."%'   ";
    }
    
               if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tp_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tp_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tp_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tp_date between '".$from."' and '".$to."' ";
                }
    
    
   
    $i=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_production   where tp_set='Y' $string2   order by tp_id asc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                           
                                                      
                          $data['Sl']=$i++;
                           $data['Date']=$result_kotlist['tp_date'];
                          $data['Id']=$result_kotlist['tp_production_id'];
                          $data['Product']=$result_kotlist['tp_name'];
                          $data['Rate Type']=$result_kotlist['tp_rate_type'];
                          $data['Unit']=$result_kotlist['tp_unit_type'];
                          $data['Qty']=$result_kotlist['tp_qty'];
                          $data['Weight']=$result_kotlist['tp_weight'];
                          
                                      
                                                      
                                                      
               $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tp_store']."'   "); 
                 $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
		   if($num_kotlistf){ 
			while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
			 {  
                            $data['Store']=$result_kotlistf['ti_name'];
      
                         } } 
      
       
      $tot_cost=0;
     $sql_kotlistf1  =  $database->mysqlQuery("SELECT sum(tmi_ing_total) as tot from tbl_menu_ingredient_detail  where tmi_menuid='".$result_kotlist['tp_product']."'   "); 
 
    $num_kotlistf1  = $database->mysqlNumRows($sql_kotlistf1);
					if($num_kotlistf1){ 
						  while($result_kotlistf1  = $database->mysqlFetchArray($sql_kotlistf1)) 
							  {  
                                              $tot_cost= $result_kotlistf1['tot'];       
                                        }}
                         
                         
      if($result_kotlist['tp_unit_type']=='Single' || $result_kotlist['tp_unit_type']=='Nos'){
     
       $data['Cost']=($tot_cost*$result_kotlist['tp_qty']);
             
       }else{ 
                  
                  
            if( $result_kotlist['tp_rate_type']=='Packet' && ($result_kotlist['tp_unit_type']=='KG' || $result_kotlist['tp_unit_type']=='LTR')){     
         
              $data['Cost'] =($tot_cost*$result_kotlist['tp_qty']);
                
           }else{
            $data['Cost']= ($tot_cost*$result_kotlist['tp_weight']);
           
      } } 
                         
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;   
      
        }
          }
            
 $date=  date('Y-m-d H:i:s');   
        
  $filename = " Production Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='wastage_report'){
    
        $data=array();
     $data1=array();
     $xlsRow=1; 
     
     
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tw_wastage_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
    $string2.=" and tg_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tg_status is null   "; 
         }
    
    
    }
    
    
    if($_REQUEST['product']!=''){
    $string2.=" and tw_name like '%".$_REQUEST['product']."%'   ";
    }
    
    
    
     $string22='';
     if($_REQUEST['asc_desc']!=''){
         
             if($_REQUEST['asc_desc']=='ascq'){
                         
                  $string22.=" order by tw_qty asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descq'){
                         
                  $string22.=" order by tw_qty desc  ";               
              }
              
               if($_REQUEST['asc_desc']=='ascw'){
                         
                  $string22.=" order by tw_weight asc  ";               
              }
              
               if($_REQUEST['asc_desc']=='descw'){
                         
                  $string22.=" order by tw_weight desc  ";               
              }
        }else{
            
           $string22.=' order by tw_id desc  ';   
            
        }
    
               if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  tw_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  tw_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  tw_date between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  tw_date between '".$from."' and '".$to."' ";
                }
    
    
   
    $i=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_wastage   where tw_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                           $total=$total+$result_kotlist['tw_total'];
                                                      
                          $data['Sl']=$i++;
                          $data['Id']=$result_kotlist['tw_wastage_id'];
                          $data['Product']=$result_kotlist['tw_name'];
                          $data['Rate Type']=$result_kotlist['tw_rate_type'];
                          $data['Unit']=$result_kotlist['tw_unit_type'];
                          $data['Qty']=$result_kotlist['tw_qty'];
                          $data['Weight']=$result_kotlist['tw_weight'];
                          $data['Rate']=number_format($result_kotlist['tw_rate'],$_SESSION['be_decimal']) ; 
                          $data['Total']=number_format( $result_kotlist['tw_total'],$_SESSION['be_decimal']) ; 
                                      
                                                      
                                                      
               $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tw_store']."'   "); 
                 $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
		   if($num_kotlistf){ 
			while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
			 {  
                            $data['Store']=$result_kotlistf['ti_name'];
      
                         } } 
      
        $data['Date']=$result_kotlist['tw_date'];
        
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;   
      
        }
          }
            
          
          
                          $data['Sl']='Total';
                          $data['Id']='';
                          $data['Product']='';
                          $data['Rate Type']='';
                          $data['Unit']='';
                          $data['Qty']='';
                          $data['Weight']='';
                          $data['Rate']='';
                          $data['Total']=number_format($total,$_SESSION['be_decimal']);
                          $data['Store']='';
                          $data['Date']='';
          
       array_push($data1,$data);
       unset($data);
                          
                        
 
 $date=  date('Y-m-d H:i:s');   
        
  $filename = " Wastage Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) && $_REQUEST['set']== "default_excel")
    {	
    
    
        $data=array();
        $data1=array();
        
        $sql_kotlist  =  $database->mysqlQuery("select ti_name,kr_kotname,mmy_maincategoryname,mr_purchase_price,mr_central_id,
             mr_raw_barcode,mr_reorder_level,mr_rate_type,mr_menuname,mr_product_type, `ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_last_grn`,ts_rate_type,ts_store,
                ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount  from tbl_store_stock
                ts  left join tbl_menumaster tm on tm.mr_menuid=ts.ts_product 
                left join tbl_menumaincategory  mm on tm.mr_maincatid=mm.mmy_maincategoryid 
                left join tbl_kotcountermaster km on tm.mr_kotcounter=km.kr_kotcode 
                left join tbl_inv_kitchen ti on tm.mr_inventory_kitchen=ti.ti_id where ts.ts_store='".$_REQUEST['store']."' "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){ $i=1;
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{
    
                
            
                          $data['Serial Number']=$i++;
                          $data['Type [Eg: Raw, Finished , Menu]']=$result_kotlist['mr_product_type'];
                          $data['Name of the Product']=$result_kotlist['mr_menuname'];
                          $data['Weight Of Product In Digits [Eg:12.500]']=$result_kotlist['ts_weight'];
                          $data['Quantity Of Product In Digits [Eg:10]']=$result_kotlist['ts_qty'];
                          $data['Type of Rate [Eg: Portion , Unit]']=$result_kotlist['mr_rate_type'];
                          $data['Type of Base Unit [Eg: Loose , Packet]']=$result_kotlist['ts_rate_type'];
                          $data['Type of Unit [Eg: Single , KG , LTR , Nos]']=$result_kotlist['ts_unit'];
                          $data['Select Store Name From Inventory Store']=$result_kotlist['ti_name'];
                          $data['Select Categoty Name From Main Categoty']=$result_kotlist['mmy_maincategoryname'];
                          $data['Select Kitchen Name From Kot Counter']=$result_kotlist['kr_kotname'];
                          $data['Product Barcode']=$result_kotlist['mr_raw_barcode'];
                          $data['Product Reordering Count']=$result_kotlist['mr_reorder_level'];
                          $data['Central Kitchen Id For Store Transfer']=$result_kotlist['mr_central_id'];
                          $data['Product Purchasing Rate']=$result_kotlist['mr_purchase_price'];
                         
                          array_push($data1,$data);
                          unset($data);
                              
                              }
                              
        }else{
           
                          $data['Serial Number']='';
                          $data['Type [Eg: Raw, Finished , Menu]']='';
                          $data['Name of the Product']='';
                          $data['Weight Of Product In Digits [Eg:12.500]']='';
                          $data['Quantity Of Product In Digits [Eg:10]']='';
                          $data['Type of Rate [Eg: Portion , Unit]']='';
                          $data['Type of Base Unit [Eg: Loose , Packet]']='';
                          $data['Type of Unit [Eg: Single , KG , LTR , Nos]']='';
                          $data['Select Store Name From Inventory Store']='';
                          $data['Select Categoty Name From Main Categoty']='';
                          $data['Select Kitchen Name From Kot Counter']='';
                          $data['Product Barcode']='';
                          $data['Product Reordering Count']='';
                          $data['Central Kitchen Id For Store Transfer']='';
                          $data['Product Purchasing Rate']='';
                         
                          array_push($data1,$data);
                          unset($data);
          
       }
                              
                              
                              
                              
                              
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "INVENTORY SAMPLE SHEET".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) && $_REQUEST['set']== "download_physical_excel")
  {	
        
	  
    
    $string2='';
      
    if(isset($_REQUEST['product']) &&  $_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
    }
    
    
     if(isset($_REQUEST['barcode']) && $_REQUEST['barcode']!=''){
    $string2.=" and ts_barcode like '%".$_REQUEST['barcode']."%'   ";
    }
    
      if(isset($_REQUEST['expiry']) && $_REQUEST['expiry']!=''){
    $string2.=" and ts_expiry = '".$_REQUEST['expiry']."'   ";
    }
    
     if(isset($_REQUEST['category']) && $_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    if(isset($_REQUEST['brand']) && $_REQUEST['brand']!=''){
    $string2.=" and ts_brand = '".$_REQUEST['brand']."'   ";
    }
    
    
     if(isset($_REQUEST['reorder']) && $_REQUEST['reorder']!=''){
       $string2.=" and mr_reorder_level = '".$_REQUEST['reorder']."'   ";
     }
    
     
       if(isset($_REQUEST['store']) && $_REQUEST['store']!=''){
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
        
        
        
        if(isset($_REQUEST['stock_check']) && $_REQUEST['stock_check']!=''){
             
         if($_REQUEST['stock_check']=='in'){
                 
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight >'0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty >'0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty >'0') )";
           
         }
             
        if($_REQUEST['stock_check']=='out'){
                  
         $string2.=" and ( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <='0')  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <='0' )  or ( (ts_unit='KG' || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <='0') )";
        
        }
              
        if($_REQUEST['stock_check']=='reorder'){
             
          $string2.=" and( ((ts_unit='KG' || ts_unit='LTR') && ts_weight <= mr_reorder_level)  or  ( (ts_unit='Nos' || ts_unit='Single') && ts_qty <= mr_reorder_level )  or ( (ts_unit='KG'  || ts_unit='LTR'  || ts_unit='Nos') && ts_rate_type='Packet' && ts_qty <= mr_reorder_level) )";
       
        }
       
       
        }
    
	
            $data=array();
            $data1=array();
            $xlsRow=1;
            $weight='';
           $sql_login_combo  =  $database->mysqlQuery("SELECT *  from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2   group by mmy_maincategoryname,ts_product  order by mmy_maincategoryname,mr_menuname asc" );

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=1;
		  while($result_kotlist  = $database->mysqlFetchArray($sql_login_combo)) 
			{
                        
                   
                           
                         if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR') ){    
                         $weight= $result_kotlist['ts_weight']; 
                         }else{
                            $weight= '';     
                         }
                        
                        
                          $data['Sl No']=$t++;
                          $data['Product']=$result_kotlist['mr_menuname'];
                         
                          $data['Category']=$result_kotlist['mmy_maincategoryname'];
                          $data['Qty Type']=$result_kotlist['ts_rate_type'];
                          $data['Unit']=$result_kotlist['ts_unit'];
                          $data['Weight']=$weight;
                          $data['Qty']='';
                         
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                         
                        }}

      
  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Stock_Entry_Sheet".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='food_cost_report'){
    
    
    if($_REQUEST['type_view']=='detailed'){
    
 $data=array();
            $data1=array();
            $xlsRow=1;
    
   $string2='';
    
    if($_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
    }
    
    
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  date(tfc_date) between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  date(tfc_date) between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			
                         $string2.= " and  date(tfc_date) between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			
                     $string2.= " and  date(tfc_date) between '".$from."' and '".$to."' ";
                }
    
   
    
    $i=1; 
    $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_food_cost  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_food_cost.tfc_store  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_food_cost.tfc_menu left join tbl_portionmaster on tbl_portionmaster.pm_id=tbl_food_cost.tfc_portion  where tfc_date !='' $string2 group by  tfc_menu,tfc_portion,tfc_date order by tfc_date desc  "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                               
       $data['Sl No']=$i++;
      $data['Store']=$result_kotlist1['ti_name'];
        
        $data['Date']=$result_kotlist1['tfc_date'];
         $data['Product']=$result_kotlist1['mr_menuname'];
       $data['Portion']=$result_kotlist1['pm_portionname'];
          $data['Yield']=$result_kotlist1['tfc_yield'];
       $data['Rate']='';
      
     $data['Qty']='';
      $data['Weight']='';
     
      
        $data['DI Cost']='';
         $data['TA Cost']='';
       $data['HD Cost']='';
        
      $data['CS Cost']='';
       
    
               array_push($data1,$data);
                 unset($data);
                          
                $xlsRow++;
                          
                          
                          
                   $ii=1;  $di=0; $ta=0; $hd=0; $cs=0;  
                   
                   $total=0; 
                   
                   $di1=0; $ta1=0; $hd1=0; $cs1=0;   
                   
                   $sql_kotlist  =  $database->mysqlQuery("SELECT *  from tbl_food_cost  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_food_cost.tfc_ing_menu  where tfc_date !='' and tbl_food_cost.tfc_menu='".$result_kotlist1['tfc_menu']."' and  tbl_food_cost.tfc_date='".$result_kotlist1['tfc_date']."'    "); 
 
                   $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
			if($num_kotlist){ 
			  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			    {                                     
                                                      
                  if($result_kotlist['tfc_di']=='Y'){
                    
                    $di=$result_kotlist['tfc_total'];
                    $di1=$di1+$result_kotlist['tfc_total'];
                  }  
                  
                  if($result_kotlist['tfc_ta']=='Y'){
                    $ta=$result_kotlist['tfc_total'];
                   $ta1=$ta1+$result_kotlist['tfc_total'];
                 } 
                
                  if($result_kotlist['tfc_hd']=='Y'){
                    $hd=$result_kotlist['tfc_total'];
                  $hd1=$hd1+$result_kotlist['tfc_total'];
                 }  
                
                 if($result_kotlist['tfc_cs']=='Y'){
                   $cs=$result_kotlist['tfc_total'];
                  $cs1=$cs1+$result_kotlist['tfc_total']; 
                 }  
                 
                 $total=$total+$result_kotlist['tfc_total'];                                     
              
                 
                 
       $data['Sl No']=$ii++;
      $data['Store']='';
        
        $data['Date']='';
         $data['Product']='*'.$result_kotlist['mr_menuname'];
        $data['Product']='';
        $data['Portion']='';
         $data['Yield']='';
       $data['Rate']=$result_kotlist['tfc_rate'];
      
     $data['Qty']=$result_kotlist['tfc_qty'];
      $data['Weight']=$result_kotlist['tfc_weight'];
      
        $data['DI Cost']=number_format($di,$_SESSION['be_decimal']);
         $data['TA Cost']=number_format($ta,$_SESSION['be_decimal']);
       $data['HD Cost']=number_format($hd,$_SESSION['be_decimal']);
        
      $data['CS Cost']=number_format($cs,$_SESSION['be_decimal']);
       
    
               array_push($data1,$data);
                 unset($data);
                 
                 
        
                  } }
                  
                  
          $data['Sl No']='Total';
          $data['Store']='';
        
        $data['Date']='';
         $data['Product']='';
       $data['Portion']='';
       $data['Yield']='';
       $data['Rate']='';
      
     $data['Qty']='';
      $data['Weight']='';
       
        $data['DI Cost']=number_format($di1,$_SESSION['be_decimal']);
         $data['TA Cost']=number_format($ta1,$_SESSION['be_decimal']);
       $data['HD Cost']=number_format($hd1,$_SESSION['be_decimal']);
        
      $data['CS Cost']=number_format($cs1,$_SESSION['be_decimal']);
       
    
               array_push($data1,$data);
                 unset($data);
                
          }
          }
       
}else{
    ///summary////
    
    
    $data=array();
    $data1=array();
    $xlsRow=1;
    
  
   $string2='';
   $string='';
   $stringta='';
   $string.=" bm.bm_status = 'Closed'";
   $stringta.=" bm.tab_status = 'Closed'";
    
   
   
    if($_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
    }
    
    
      if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			
                         $string2.= " and  date(tfc_date) between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                          $string.= " and bm.bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."'  ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			
                          $string2.= " and  date(tfc_date) between '".$_REQUEST['fromdt']."' and '".$to."' ";
                           $string.= " and bm.bm_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$_REQUEST['fromdt']."' and '".$to."'  ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			 $string.= " and bm.bm_dayclosedate between '".$from."' and '".$_REQUEST['todt']."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$_REQUEST['todt']."'  ";
                         $string2.= " and  date(tfc_date) between '".$from."' and '".$_REQUEST['todt']."' ";
		}else{
                    
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			 $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $string2.= " and  date(tfc_date) between '".$from."' and '".$to."' ";
                }
    
   
    
    $i=1;  $tot_sale=0;    $tot_cost=0; $tot_profit=0;
    
      $tot_sale1=0;    $tot_cost1=0; $tot_profit1=0;              
                    
             $qty=0;   $rate=0;
            $sql_kotlist12  =  $database->mysqlQuery("select rt,maincategory,subcategory,menuid,menuname, rate_type, dayclose , sum(cost) as costall,
            unit_type,portionid,portionname,weight,unitid,unitname,baseunitid,baseunitname,sum(qty_all)as qty_all,sum(total)as total,store
               
            from (select mm.mr_inventory_kitchen as store,mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,
            bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all , 
                                        sum(bd.bd_amount) as total, sum(bd.bd_cost) as cost,bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where  mm.mr_product_type='Finished' 
                                        and bd.bd_count_combo_ordering is NULL and $string  
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight,bm.bm_dayclosedate
                                            
                                        union all 
                                        
                                        select mm.mr_inventory_kitchen as store,mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate as rt, sum(bd.tab_qty) as qty_all ,
                                        sum(bd.tab_amount) as total , sum(bd.tab_cost) as cost, bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where  mm.mr_product_type='Finished'
                                        and bd.tab_count_combo_ordering is NULL 
                                        and bm.tab_mode IN ('TA','HD','CS')   and $stringta 
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight ,bm.tab_dayclosedate
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuid  ");
            
        $num_kotlist12  = $database->mysqlNumRows($sql_kotlist12);
	if($num_kotlist12){ 
		while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist12)) 
		{  
                    
                   $qty=$result_kotlist1['qty_all'];
                    
                    $rate=$result_kotlist1['rt'];
                    
                  $tot_sale= $result_kotlist1['total'];
               
                  $tot_cost= $result_kotlist1['costall'];
                  
                  $tot_profit=($tot_sale-$tot_cost);    
                  
                  
                  $tot_sale1= $tot_sale1+$tot_sale;
               
                  $tot_cost1= $tot_cost1+$tot_cost;
                  
                  $tot_profit1=$tot_profit1+$tot_profit;
                                                      
                               
       $data['Sl No']=$i++;
       $data['Date']=$result_kotlist1['dayclose'];
      
       $data['Category']=$result_kotlist1['maincategory'];
       $data['Sub Category']=$result_kotlist1['subcategory'];
       $data['Product']=$result_kotlist1['menuname'];
         
        $data['Unit ']=$result_kotlist1['unit_type'];
        $data['Portion/Unit']=$result_kotlist1['portionname'].$result_kotlist1['baseunitname'];
        
         $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist1['store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
        $data['Store']=$result_fnctvenue['ti_name'];
        }}
        
        $data['Qty']=$qty;
        $data['Cost/Unit']=number_format(($result_kotlist1['costall']/$qty),$_SESSION['be_decimal']);
        $data['Total Cost']=number_format($result_kotlist1['costall'],$_SESSION['be_decimal']);
        $data['Rate/Unit']=$rate;
        $data['Sales Total']=$tot_sale;
        $data['Profit']=($tot_sale-$tot_cost);
    
               array_push($data1,$data);
               unset($data);
                          
               $xlsRow++;
                          
                   
        } }
        
        
       $data['Sl No']='Total';
       $data['Date']='';
      
       $data['Category']='';
       $data['Sub Category']='';
       $data['Product']='';
         
        $data['Unit ']='';
        $data['Portion/Unit']='';
        $data['Store']='';
        $data['Qty']='';
        $data['Cost/Unit']='';
        $data['Total Cost']=number_format($tot_cost1,$_SESSION['be_decimal']);
        $data['Rate/Unit']='';
        $data['Sales Total']=number_format($tot_sale1,$_SESSION['be_decimal']);
        $data['Profit']=number_format($tot_profit1,$_SESSION['be_decimal']);
    
               array_push($data1,$data);
               unset($data);
                          
               $xlsRow++;
                          
         
}



  $date=  date('Y-m-d H:i:s');   
        
  $filename = "Food Cost Report".$date.".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
?>