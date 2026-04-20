<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_store_stock'){
    
    
    ////normal///////
    if($_REQUEST['bydate']==''){
    
  ?>

<table class="table table-bordered table-striped">
  <thead>
      <tr>
     <th scope="col">Sl</th>
    
    <th scope="col">Product</th>
      <th scope="col">Barcode</th>
      <th scope="col">Rate Type</th>
      
      <th scope="col">Category</th>
      <th scope="col">Weight</th>
      <th scope="col">Qty</th>
      <th scope="col">Unit</th>
       <th scope="col">Re-order Level</th>
      <th scope="col">Unit Rate</th>
      <th scope="col">Total Rate</th>
     
      <th scope="col">Expiry Date</th>
      
      <th style="display:none" scope="col">Last GRN ID</th>
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
   
                
		$weight=0; $qty=0; $rate=0; $total=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(ts_weight) as  weight ,sum(ts_qty) as  qty ,sum(ts_total) as  rate, ts_weight as nrm_weight from tbl_store_stock  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by ts_product  order by mr_menuname asc  "); 
 
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
                                    
                                    $i++;
                    $total=$total+ $rate;                           
           ?>

                             <tr>
                           <td><?=$i?></td>
                            <td><?=$result_kotlist['mr_menuname']?></td>
                           <td><?=$result_kotlist['ts_barcode']?></td>
                           <td><?=$result_kotlist['ts_rate_type']?></td>
                          
                           <td><?=$result_kotlist['mmy_maincategoryname']?></td>
                           <td><?=$weight?></td>
                           <td><?=$qty?></td>
                           <td><?=$result_kotlist['ts_unit']?></td>
                           
                            <td <?php if( ($result_kotlist['ts_qty']<$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_unit']=='Single' || $result_kotlist['ts_unit']=='Nos')) || ($result_kotlist['ts_weight']<$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_unit']!='Single' && $result_kotlist['ts_rate_type']!='Packet' && $result_kotlist['ts_unit']!='Nos')) || ($result_kotlist['ts_qty']<$result_kotlist['mr_reorder_level'] && ($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR'))) ){ ?> style="cursor: pointer;color: red" title="Item Need To Be Ordered For Purchase"  <?php } ?> ><?=$result_kotlist['mr_reorder_level']?></td>
                           
                          
                           
                           
                          <?php  if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){ ?>
                          
                            <?php  if($rate>0 && $qty>0){ ?>
                             <td><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                             <?php }else {?>
                             <td></td>
                            
                             <?php } ?>
                            
                           <?php }else{ ?>
                             
                             <?php  if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR') ){ ?> 
                             
                              <?php  if($rate>0 && $qty>0){ ?>
                            <td><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                            
                            <?php }else{ ?>
                                <td></td>
                              <?php } ?>
                                
                              <?php } else  {?>
                            
                             <?php  if($rate>0 && $weight>0  ){ ?>
                             <td><?=number_format(($rate/$weight),$_SESSION['be_decimal'])?></td>
                             <?php }else{ ?>
                                <td></td>
                              <?php } ?>
                             
                                <?php } } ?>
                            
                            
                             <td><?= number_format($rate,$_SESSION['be_decimal']) ?></td>
                             
                            
                             <td title="Expiry Dates"  > <i style="float:left;cursor: pointer;display: none" onclick="expiry_date('<?=$result_kotlist['ts_product'] ?>');"  class="fa fa-calendar fa-lg" aria-hidden="true"></i> &nbsp; &nbsp; <?=$result_kotlist['ts_expiry']?></td>
                           
                             <td style="display:none"><i style="float:left;cursor: pointer;display: none" onclick="grn_qty('<?=$result_kotlist['ts_product'] ?>');"  class="fa fa-list-alt fa-lg" aria-hidden="true"></i> &nbsp; &nbsp; <?=$result_kotlist['ts_last_grn']?>  </td>
                   
                           
</tr>


<?php 
    }}

     ?>  


<tr>
      <td scope="row" style="text-align: center;">Items: <?=$i?> </td>
     
      <td scope="row" style="text-align: center;"></td>
      
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
       <td></td>
      <td>Total</td>
      <td><?= number_format($total,$_SESSION['be_decimal'])  ?></td>
      <td></td>
     
      <td style="display:none"></td>
      </tr>

     </tbody>
  
  </table>                                 
                                 
                                        
<?php
}else{
    
    //////////////daywise//////
    
    ?>

<table class="table table-bordered table-striped">
  <thead>
      <tr>
     <th scope="col">Sl</th>
    <th scope="col">Date</th>
    <th scope="col">Product</th>
     
      <th scope="col">Rate Type</th>
      
      <th scope="col">Category</th>
      <th scope="col">Weight</th>
      <th scope="col">Qty</th>
      <th scope="col">Unit</th>
      <th scope="col">Unit Rate</th>
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
   
                
		$weight=0; $qty=0; $rate=0; $total=0;
                $sql_kotlist  =  $database->mysqlQuery("SELECT *,sum(tis_weight) as  weight ,sum(tis_qty) as  qty ,sum(tis_total) as  rate, tis_weight as nrm_weight from tbl_store_stock left join tbl_inv_daily_store_stock on tbl_inv_daily_store_stock.tis_product=tbl_store_stock.ts_product  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_stock.ts_product left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid where ts_product !='' $string2 group by tis_product,tis_date  order by tis_date,mr_menuname asc  "); 
 
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
                                    
                                    $i++;
                    $total=$total+ $rate;                           
           ?>

                             <tr>
                           <td><?=$i?></td>
                           <td><?=$result_kotlist['tis_date']?></td>
                            <td><?=$result_kotlist['mr_menuname']?></td>
                         
                           <td><?=$result_kotlist['ts_rate_type']?></td>
                          
                           <td><?=$result_kotlist['mmy_maincategoryname']?></td>
                           <td><?=$weight?></td>
                           <td><?=$qty?></td>
                           <td><?=$result_kotlist['ts_unit']?></td>
                           
                          <?php  if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){ ?>
                          
                            <?php  if($rate>0){ ?>
                             <td><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                             <?php }else {?>
                             <td></td>
                            
                             <?php } ?>
                            
                           <?php }else{ ?>
                             
                            <?php  if($rate>0 ){ ?>
                             
                             
                             <?php  if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR') ){ ?> 
                             
                            <td><?=number_format(($rate/$qty),$_SESSION['be_decimal'])?></td>
                             <?php }else {?>
                             <td><?=number_format(($rate/$weight),$_SESSION['be_decimal'])?></td>
                              <?php } ?>
                            
                            
                              <?php }else{ ?>
                                <td></td>
                              <?php } ?>
                             
                            <?php } ?>
                            
                             <td><?= number_format($rate,$_SESSION['be_decimal']) ?></td>
                             
                             
                           
</tr>


<?php 
    }}

     ?>  


<tr>
       <td scope="row" style="text-align: center;">Total </td>
     
      <td scope="row" style="text-align: center;">Items: [<?=$i?>]</td>
      
      <td></td>
      <td></td>
      <td></td>
       <td></td>
      <td></td>
      <td></td>
        <td></td>
      <td><?= number_format($total,$_SESSION['be_decimal'])  ?></td>
    
    </tr>

        </tbody>
  
  </table>                                 
                                 
                                        
<?php 
    
   
    
}

}if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='supplier_report'){
    
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
                
                
           ?>

<table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
     
      <th scope="col">Invoice No</th>
       <th scope="col">Grn No</th>
      <th scope="col">Date</th>
      <th scope="col">Supplier</th>
      <th scope="col">Address</th>
     
      <th scope="col">Gst/Trn No</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Tax Amount</th>
      <th scope="col">Total</th>
     
    </tr>
  </thead>
<tbody >
      

    <?php

    $i=0;
    $total=0; $sub_total=0;  $tax_total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT tg_grn_id,tg_supplier,gst,v_address,v_name, tg_date,tgs_invoice_no,tg_final_total as sub_tot,"
    . "tg_grand_total as tot,tg_tax_amount as tax_tot from tbl_grn_order left join tbl_vendor_master on "
            . " tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store"
            . " left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2 "
            . " group by tg_supplier,tg_date,tgs_invoice_no  order by tg_supplier desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
		if($num_kotlist){ 
		  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
			{  
                           $total=$total+$result_kotlist['tot'];  
                           $sub_total=$sub_total+$result_kotlist['sub_tot'];  
                           $tax_total=$tax_total+$result_kotlist['tax_tot'];  
     $i++                                                  
                                                      
      ?>
    <tr>
         <td scope="row" style="text-align: center;"><?=$i?></td>
     
         <td  scope="row" style="text-align: center;"><span style="text-align: center;border: solid 1px;border-radius: 5px;padding: 4px;cursor: pointer" onclick="item_view('<?=$result_kotlist['tg_grn_id']?>')"> <?=$result_kotlist['tgs_invoice_no']?> </span></td>
       <td><?=$result_kotlist['tg_grn_id']?></td>
      <td><?=$result_kotlist['tg_date']?></td>
      <td><?=$result_kotlist['v_name']?></td>
     
      <td><?=$result_kotlist['v_address']?></td>
      <td><?=$result_kotlist['gst']?></td>
      
      <td><?= number_format($result_kotlist['sub_tot'],$_SESSION['be_decimal'])  ?></td>
    <td><?= number_format($result_kotlist['tax_tot'],$_SESSION['be_decimal'])  ?></td>
    <td><?= number_format($result_kotlist['tot'],$_SESSION['be_decimal'])  ?></td>
    </tr>

        <?php
        
        }  ?>
         <tr>
       <td scope="row" style="text-align: center;">Total</td>
     
      <td scope="row" style="text-align: center;"></td>
      
      <td></td>
      <td></td>
     
      <td></td>
      <td></td>
        <td></td>
      <td><?= number_format($sub_total,$_SESSION['be_decimal'])  ?></td>
    <td><?= number_format($tax_total,$_SESSION['be_decimal'])  ?></td>
    <td><?= number_format($total,$_SESSION['be_decimal'])  ?></td>
    </tr>
        
                <?php }else{
          
          ?>
          
    <tr style="color: red;display:none"><td>NO DATA</td></tr>
          
     <?php
      }
       
     ?>
     
     </tbody>
  
  </table>

 <?php

}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_grn'){
    
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
    $string2='';
    
    $string1='';
    
    if($_REQUEST['id']!=''){
    $string1.=" and tp_purchase_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
     if($_REQUEST['supplier']!=''){
          $string.=" =*"; 
         
    $string1.=" and tp_supplier = '".$_REQUEST['supplier']."'   ";
    
    
     $string2.=" and tg_supplier = '".$_REQUEST['supplier']."'   ";
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
                
                
           ?>

<table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
     
      <th scope="col">Type</th>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Supplier</th>
      <th scope="col">Store</th>
      <th scope="col">Total Amt</th>
      <th scope="col">INV No</th>
      <th scope="col">INV Amt</th>
      <th scope="col">RET Amt</th>
      <th scope="col">Items</th>
      <th scope="col">Status</th>
      <th scope="col">Appr/Cancl By</th>
    
    </tr>
  </thead>
<tbody >
      

<?php

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
                                                      ?>
<tr>
    <td><?=$i?></td>
     
      <td scope="row" style="text-align: center;">Requisition</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tr_req_id']?></td>
      <td><?=$result_kotlist['tr_dayclosedate']?></td>
      <td></td>
      <td><?=$result_kotlist['ti_name']?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=$count?></td>
      
      <?php if($result_kotlist['tr_status']=='Approved'){ ?>
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
      <?php }else if($result_kotlist['tr_status']=='Cancel'){ ?>
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
       <?php }else{ ?>
      <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
        <?php } ?>
       
       
      <td><?=$result_kotlist['tr_status_login']?></td>
      
      
      
    </tr>

                                                   <?php
      }  }else{
          
          ?>
          
    <tr style="color: red;display:none"><td>NO DATA</td></tr>
          
          <?php
      }
      
      
      
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
                                                                  
                 $i++                                                  
                                                      
      ?>
    <tr>
         <td scope="row" style="text-align: center;"><?=$i?></td>
      
      <td scope="row" style="text-align: center;">Purchase Order</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tp_purchase_id']?></td>
      <td><?=$result_kotlist['tp_dayclosedate']?></td>
      <td><?=$result_kotlist['v_name']?></td>
      <td><?=$result_kotlist['ti_name']?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=$count?></td>
     <?php if($result_kotlist['tp_status']=='Approved'){ ?>
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
      <?php }else if($result_kotlist['tp_status']=='Cancel'){ ?>
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
       <?php }else{ ?>
      <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
        <?php } ?>
      <td><?=$result_kotlist['tp_status_login']?></td>
    
      
      
      
      
      
      
      
    </tr>

                                                   <?php
      }  }else{
          
          ?>
          
    <tr style="color: red;display:none"><td>NO DATA</td></tr>
          
          <?php
      }
      
      
      
      
       }
       
       
       if($_REQUEST['type']=='all' || $_REQUEST['type']=='stock'){
        
      
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
                                        
                                                                   
                 $i++                                                  
                                                      
      ?>
    <tr>
         <td scope="row" style="text-align: center;"><?=$i?></td>
     
      <td scope="row" style="text-align: center;">Stock Purchase</td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tg_grn_id']?></td>
      <td><?=$result_kotlist['tg_date']?></td>
      <td><?=$result_kotlist['v_name']?></td>
      <td><?=$result_kotlist['ti_name']?></td>
      <td><?= number_format($result_kotlist['tg_final_total'],$_SESSION['be_decimal'])  ?></td>
      <td><?=$result_kotlist['tgs_invoice_no']?></td>
      <td><?=number_format($result_kotlist['tg_grand_total'],$_SESSION['be_decimal']) ?></td>
      <td><?= number_format($ret,$_SESSION['be_decimal'])  ?></td>
      <td><?=$count?></td>
     <?php if($result_kotlist['tg_status']=='Approved'){ ?>
      <td><a title="Approved" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:green;"></i></a></td>
      <?php }else if($result_kotlist['tg_status']=='Cancel'){ ?>
      <td><a title="Cancelled" href="#"><i class="fa fa-times-circle-o  fa-lg" aria-hidden="true" style="color:red;"></i></a></td>
       <?php }else{ ?>
      <td><a  title="Pending" href="#"><i class="fa fa-check-circle fa-lg" aria-hidden="true" style="color:orange;"></i></a></td>
        <?php } ?>
      <td><?=$result_kotlist['tg_status_login']?></td>
    
     
    </tr>

                                                   <?php
      }  }else{
          
          ?>
          
    <tr style="color: red;display:none"><td>NO DATA</td></tr>
          
          <?php
      }
      
      
      
      
       }
     ?>
     
     </tbody>
  
  </table>

   
     
     <?php

}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='central_report'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col">Id</th>  
     <th scope="col">Product</th>
      <th scope="col">Date</th>
       <th scope="col">Store</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
     
     
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    
   
    $i=1; $total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_central_kitchen_transfer left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_central_kitchen_transfer.tct_product $string_store  where tct_set='Y' $string2   order by tct_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tct_total'];
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tct_central_id']?></td>
      <td><?=$result_kotlist['mr_menuname']?></td>
      <td><?=$result_kotlist['tct_date']?></td>
      <td><?=$result_kotlist['ti_name']?></td>
       <td><?=$result_kotlist['tct_rate_type']?></td>
      <td><?=$result_kotlist['tct_unit_type']?></td>
      <td><?=$result_kotlist['tct_qty']?></td>
      <td><?=$result_kotlist['tct_weight']?></td>
      <td><?=number_format($result_kotlist['tct_rate'],$_SESSION['be_decimal'])  ?></td>
      <td><?=number_format( $result_kotlist['tct_total'],$_SESSION['be_decimal'])?></td>
      
        </tr>
    
                                                      
       <?php
          }
          }
       ?>                                        
                                                  
            <tr>
      <td scope="row" style="text-align: center;">Total</td>
     
      <td class="td-overflow-hidden"></td>
       <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
     
      <td><?=number_format($total,$_SESSION['be_decimal']) ?></td>
     
    </tr>                                      
       <?php
}

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='req_report'){
    
    if($_REQUEST['req_po']=='req'){
    ?>
    <table class="table table-bordered" >
        
        
    <thead>
     <tr> <th scope="col">Sl</th>
      <th scope="col">Req Id</th>  
      <th scope="col">Product</th>
      <th scope="col">Category</th>
      <th scope="col">Barcode</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Date</th>
      <th scope="col">Store</th>  
      <th scope="col">Type</th>  
       <th scope="col">Login</th>  
    </tr>
  </thead>
<tbody >
    
    <?php
    
    $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tr_req_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
            $string2.=" and tr_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tr_status is null   "; 
         }
    
    
    }
    
   
    
    if($_REQUEST['product']!=''){
    $string2.=" and tr_name like '%".$_REQUEST['product']."%'   ";
    }
    
      if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    
     if($_REQUEST['stock_check']!=''){
         
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    
    }
    
    
     if($_REQUEST['login_staff']!=''){
         
     $string2.=" and tr_login = '".$_REQUEST['login_staff']."'   ";
    
    }
    
     if($_REQUEST['store']!=''){
         
     $string2.=" and tr_store = '".$_REQUEST['store']."'   ";
    
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
                
    
    $tot_all=0;  $i=1;         
    $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_requisition.tr_product "
            . "  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_inv_kitchen on "
            . "  tbl_inv_kitchen.ti_id=tbl_requisition.tr_store  where"
            . "  tr_set='Y' $string2  group by tr_req_id order by tr_id desc  "); 
 
     $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                                                      ?>
                                                      
    <tr style="    color: #cb4b00 !important;font-weight: bold;">
      <td scope="row" style="text-align: center;"><?=$i++?>.</td>
      <td colspan="3"></td>
      <td colspan="3" class="td-overflow-hidden">Date: <?=$result_kotlist1['tr_dayclosedate']?> &nbsp;&nbsp; | &nbsp; &nbsp; Id: <?=$result_kotlist1['tr_req_id']?></td>
        <td></td>
       <td></td>
      <td></td>
        <td></td> 
       <td></td>
       <td></td>
    </tr> 
                                                      
                                                      
                                              <?php        
                                                             
                
                
    
    
    $ii=1; $total=0; 
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_requisition left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_requisition.tr_product  left join tbl_menumaincategory"
            . " on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_requisition.tr_store"
            . " where tr_req_id='".$result_kotlist1['tr_req_id']."' and"
            . "  tr_set='Y' $string2   order by tr_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                    
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;font-size: 8px !important"><?=$ii++?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tr_req_id']?></td>
      <td><?=$result_kotlist['tr_name']?></td>
      <td><?=$result_kotlist['mmy_maincategoryname']?></td>
      <td><?=$result_kotlist['tr_barcode']?></td>
      <td><?=$result_kotlist['tr_rate_type']?></td>
      <td><?=$result_kotlist['tr_unittype']?></td>
      <td><?=$result_kotlist['tr_qty']?></td>
      <td><?=$result_kotlist['tr_weight']?></td>
     
       <td><?=$result_kotlist['tr_dayclosedate']?></td>
      
         <td><?=$result_kotlist['ti_name']?></td>
         
       <?php if($result_kotlist['tr_indent']=='Y' ){ ?>
           
          <td>Indent</td>  
          
       <?php }else if($result_kotlist['tr_central']=='Y'){ ?>
       
           <td>Central</td>
           
       <?php }else if($result_kotlist['tr_indent']=='N' && $result_kotlist['tr_central']=='N'){ ?>
       
            <td>Normal</td>
            
       <?php } ?>
            
            
        <td><?=$result_kotlist['tr_login']?></td>    
       
     </tr>
    
    
    
                                                      
       <?php
       
        } }
          
          
        } }
      
        
        
    }else{
        
        ?>
    <table class="table table-bordered" >
        
        
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col">Purchase Id</th>  
     <th scope="col">Product</th>
       <th scope="col">Category</th>
      <th scope="col">Barcode</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
    
        <th scope="col">Date</th>
      <th scope="col">Store</th>  
       <th scope="col">Supplier</th>  
       <th scope="col">Login</th>    
    </tr>
  </thead>
<tbody >
    
    <?php
    
    $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tp_purchase_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
    if($_REQUEST['status_search']!='All'){
       
         if($_REQUEST['status_search']!=''){
            $string2.=" and tp_status ='".$_REQUEST['status_search']."'   ";
         }else{
            $string2.=" and tp_status is null   "; 
         }
    
    
    }
    
   
    
    if($_REQUEST['product']!=''){
    $string2.=" and tp_name like '%".$_REQUEST['product']."%'   ";
    }
    
      if($_REQUEST['category']!=''){
    $string2.=" and mr_maincatid = '".$_REQUEST['category']."'   ";
    }
    
    
     if($_REQUEST['stock_check']!=''){
         
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
                
    
    $tot_all=0;  $i=1;         
    $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_order.tp_product "
            . "  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_inv_kitchen on "
            . "  tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store  where"
            . "  tp_set='Y' $string2  group by tp_purchase_id order by tp_id desc  "); 
 
     $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                                                      ?>
                                                      
    <tr style="    color: #cb4b00 !important;font-weight: bold;">
      <td scope="row" style="text-align: center;"><?=$i++?>.</td>
      <td colspan="3">Date: <?=$result_kotlist1['tp_dayclosedate']?></td>
      <td colspan="3" class="td-overflow-hidden">Id: <?=$result_kotlist1['tp_purchase_id']?></td>
        <td></td>
       <td></td>
      <td></td>
        <td></td> 
      <td></td>
       <td></td>
    </tr> 
                                                      
                                                      
                                              <?php        
                                                             
                
                
    
    
    $ii=1; $total=0; 
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_purchase_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_purchase_order.tp_product  left join tbl_menumaincategory"
            . " on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_purchase_order.tp_store"
            . " left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_purchase_order.tp_supplier where tp_purchase_id='".$result_kotlist1['tp_purchase_id']."' and"
            . "  tp_set='Y' $string2   order by tp_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                    
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$ii++?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tp_purchase_id']?></td>
      <td><?=$result_kotlist['tp_name']?></td>
      <td><?=$result_kotlist['mmy_maincategoryname']?></td>
      <td><?=$result_kotlist['tp_barcode']?></td>
      <td><?=$result_kotlist['tp_rate_type']?></td>
      <td><?=$result_kotlist['tp_unittype']?></td>
      <td><?=$result_kotlist['tp_qty']?></td>
      <td><?=$result_kotlist['tp_weight']?></td>
     
       <td><?=$result_kotlist['tp_dayclosedate']?></td>
      
         <td><?=$result_kotlist['ti_name']?></td>
           
           
        <td><?=$result_kotlist['v_name']?></td>
        <td><?=$result_kotlist['tp_login']?></td>
    </tr>
    
    
    
                                                      
       <?php
       
        } }
          
          
        } }
        
        
        
        
    }
        
        
        
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='expiry_report'){
    
    
    ?>
    <table class="table table-bordered" >
        
        
    <thead>
     <tr> <th scope="col">Sl</th>
      <th scope="col">Inv Date</th>
       <th scope="col">Supplier</th>
      <th scope="col">Grn Id</th>  
      <th scope="col">Product</th>
      <th scope="col">Category</th>
      <th scope="col">Expiry Date</th>
      <th scope="col">Type</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Final Total</th>
         
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
        ?>    
                                                      
    
      <tr>
      <td scope="row" style="text-align: center;font-size: 8px !important"><?=$ii++?></td>
      <td><?=$result_kotlist['tg_date']?></td>
      <td><?=$result_kotlist['v_name']?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tg_grn_id']?></td>
      <td><?=$result_kotlist['tg_name']?></td>
      <td><?=$result_kotlist['mmy_maincategoryname']?></td>
      <td style="color:#d73232;"><?=$result_kotlist['tg_expiry_date']?></td>
       <td><?=$type?></td>
      <td><?=$result_kotlist['tg_rate_type']?></td>
      <td><?=$result_kotlist['tg_unittype']?></td>
      <td><?=$result_kotlist['tg_qty']?></td>
      <td><?=$result_kotlist['tg_weight']?></td>
      <td><?=number_format($result_kotlist['tg_unit_rate'],$_SESSION['be_decimal'])  ?></td>
      
      <td><?=number_format($result_kotlist['tg_final_rate'],$_SESSION['be_decimal']) ?></td>
      
     </tr>
    
                                                      
     <?php } } ?>      
                                         
      <tr>
      <td scope="row" style="text-align: center;color: black"> </td>
     
      <td class="td-overflow-hidden"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
       <td></td>
      <td>Final Total</td>
     <td style="color: black"><?=number_format($total,$_SESSION['be_decimal']) ?></td>
     
    </tr>     
    
   <?php
 
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='load_grn_item'){
    
    
    ?>
    <table class="table table-bordered" >
        
        
    <thead>
      <tr> <th scope="col">Sl</th>
      <th scope="col">Grn Id</th>  
      <th scope="col">Product</th>
      <th scope="col">Category</th>
      <th scope="col">Barcode</th>
      <th scope="col">Batch No</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
      <th scope="col">Tax</th>
     
       <th scope="col">Entry Date</th>
       <th scope="col">Supplier</th>
       <th scope="col">Final Total</th>
         
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    
       $tot_all=0;  $i=1;         
    $sql_kotlist1  =  $database->mysqlQuery("SELECT *,sum(tg_final_rate) as tot_grn from tbl_grn_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_grn_order.tg_product  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_set='Y' $string2  group by tg_grn_id $string22  "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                                                      ?>
                                                      
    <tr style="    color: #c16643 !important;font-weight: bold;">
      <td scope="row" style="text-align: center;"><?=$i++?>.</td>
      <td colspan="3">Date: <?=$result_kotlist1['tg_date']?></td>
      <td colspan="3" class="td-overflow-hidden">Id: <?=$result_kotlist1['tg_grn_id']?></td>
       <td colspan="3"> Sup: <?=$result_kotlist1['v_name']?></td>
       <td></td>
      <td></td>
        <td></td> 
      <td colspan="3" style="text-align: right "> Total : <?=number_format($result_kotlist1['tot_grn'],$_SESSION['be_decimal']) ?></td>
      
    </tr> 
                                                      
                                                      
                                              <?php        
                                                             
                
                
   
    $ii=1; $total=0; 
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_grn_order left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_grn_order.tg_product  left join tbl_menumaincategory on tbl_menumaincategory.mmy_maincategoryid=tbl_menumaster.mr_maincatid left join tbl_vendor_master on tbl_vendor_master.v_id=tbl_grn_order.tg_supplier left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_grn_order.tg_store left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id where tg_grn_id='".$result_kotlist1['tg_grn_id']."' and  tg_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tg_final_rate'];
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;font-size: 8px !important"><?=$ii++?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tg_grn_id']?></td>
      <td><?=$result_kotlist['tg_name']?></td>
      <td><?=$result_kotlist['mmy_maincategoryname']?></td>
      <td><?=$result_kotlist['tg_barcode']?></td>
       <td><?=$result_kotlist['tg_batch_id']?></td>
      <td><?=$result_kotlist['tg_rate_type']?></td>
      <td><?=$result_kotlist['tg_unittype']?></td>
      <td><?=$result_kotlist['tg_qty']?></td>
      <td><?=$result_kotlist['tg_weight']?></td>
      <td><?=number_format($result_kotlist['tg_unit_rate'],$_SESSION['be_decimal'])  ?></td>
      <td><?=number_format( $result_kotlist['tg_total_rate'],$_SESSION['be_decimal'])?></td>
      <td><?=number_format($result_kotlist['tg_tax_rate'],$_SESSION['be_decimal']) ?></td>
     
       <td><?=$result_kotlist['tg_dayclosedate']?></td>
        <td><?=$result_kotlist['v_name']?></td>
       <td><?=number_format($result_kotlist['tg_final_rate'],$_SESSION['be_decimal']) ?></td>
    </tr>
    
                                                      
       <?php
       
          } }
          
          
          $tot_all=$tot_all+$total;
          
          
        } }
         
       ?>      
                                         
            <tr>
      <td scope="row" style="text-align: center;color: black"> </td>
     
      <td class="td-overflow-hidden"></td>
       <td></td>
        <td></td>
          <td></td>
      <td></td>
      <td></td>
      <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
       <td></td>
        <td>Final Total</td>
        <td style="color: black"><?=number_format($tot_all,$_SESSION['be_decimal']) ?></td>
     
    </tr>                                      
       <?php
}

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='transfer_report'){
    
?>
    <table class="table table-bordered" >
    <thead>
    <tr> <th scope="col">Sl</th>
     <th scope="col">Id</th>  
         <th scope="col">Indent Id</th>  
           <th scope="col">Direct Id</th>  
         
     <th scope="col">Product</th>
      
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
      <th scope="col">From Store</th>
      <th scope="col">To Store</th>
       <th scope="col">Transfer By</th>
        <th scope="col">Accept By</th>
        <th scope="col">Batch No</th>
       
      
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    
    
     if($_REQUEST['product']!=''){
    $string2.=" and tt_name like '%".$_REQUEST['product']."%'   ";
    }
    
    
     if($_REQUEST['from_store']!=''){
    $string2.=" and tt_from_store = '".$_REQUEST['from_store']."'   ";
    }
    
    
     if($_REQUEST['to_store']!=''){
    $string2.=" and tt_to_store = '".$_REQUEST['to_store']."'   ";
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
    
    
    $i=1;$total1=0;
    $sql_kotlist1  =  $database->mysqlQuery("SELECT tt_dayclosedate,tt_trn_id,tt_total,sum(tt_total) as tot_trn from tbl_store_transfer   where tt_set='Y' $string2 group by tt_trn_id  order by tt_id desc  "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
		if($num_kotlist1){ 
		while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
		{           
     ?>
    
    <tr style="color:darked;font-weight: bold;">
    <td  scope="row" style="text-align: center;"><?=$i++?>.</td>
    <td colspan="3">Date:<?=$result_kotlist1['tt_dayclosedate']?></td>
    <td colspan="3" class="td-overflow-hidden">ID:<?=$result_kotlist1['tt_trn_id']?></td>
    <td></td>
    <td></td>
              
          
      <td></td>
     <td></td>
      <td></td> 
      <td></td>
      <td colspan="3" style="text-align: right ">Total:<?=number_format($result_kotlist1['tot_trn'],$_SESSION['be_decimal']) ?></td>  
     <tr>
      
      
   <?php
   
    $ii=1;$total=0;
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_store_transfer   where  tt_trn_id='".$result_kotlist1['tt_trn_id']."' and  tt_set='Y' $string2   order by tt_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tt_total'];
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$ii++?></td>
     
      <td class="td-overflow-hidden"><?=$result_kotlist['tt_trn_id']?></td>
       <td><?=$result_kotlist['tt_indent']?></td>
       <td><?=$result_kotlist['tt_direct_grn']?></td>
       
       <td><?=$result_kotlist['tt_name']?></td>
        
       <td><?=$result_kotlist['tt_rate_type']?></td>
       <td><?=$result_kotlist['tt_unit_type']?></td>
       <td><?=$result_kotlist['tt_qty']?></td>
       <td><?=$result_kotlist['tt_weight']?></td>
       <td><?=number_format($result_kotlist['tt_rate'],$_SESSION['be_decimal']) ?></td>
       <td><?=number_format($result_kotlist['tt_total'],$_SESSION['be_decimal']) ?></td>
      
      <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tt_from_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
      
      
      <?php
      $sql_kotlistt  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tt_to_store']."'   "); 
 
    $num_kotlistt  = $database->mysqlNumRows($sql_kotlistt);
					if($num_kotlistt){ 
						  while($result_kotlistt  = $database->mysqlFetchArray($sql_kotlistt)) 
							  {  
                                                      ?>
      <td><?=$result_kotlistt['ti_name']?></td>
     
    
       <?php } } ?>
      
      
       <td><?=$result_kotlist['tt_transfer_login']?></td>
       
       
       
       <?php if($result_kotlist['tt_normal']=='Y'  ){ ?>
                                  
          <td><?=$result_kotlist['tt_normal_accept_login']?></td>                
                           
       <?php }else if($result_kotlist['tt_direct_grn']!=''){ ?>
                         
           <td><?=$result_kotlist['tt_direct_accept_by']?></td> 
           
       <?php } else if($result_kotlist['tt_indent']!='' ){ ?>
       
            <td><?=$result_kotlist['tt_indent_accepted_login']?></td>    
        <?php } ?>      
       
     
                                  
          <td><?=$result_kotlist['tt_batch_id']?></td>                
                           
      
      
      
    </tr>
    
                                                      
            <?php
             }
             }
            
             
               $total1=$total1+$total;
             
               }}
            ?>
    
    
    <tr>
        
      <td scope="row" style="text-align: center;color:black">Total</td>
     
      <td class="td-overflow-hidden"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
       <td></td>
      <td></td>
       <td></td>
       <td></td>
      <td></td>
       <td></td>
      <td style="color:black"><?=number_format($total1,$_SESSION['be_decimal']) ?></td>
     
    </tr>                 
    
 <?php
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='physical_stock_report'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col">Date</th>
      <th scope="col">Id</th>  
     <th scope="col">Product</th>
      
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
        <th scope="col">Real Qty</th>
      <th scope="col">Phy Qty</th>
      
      <th scope="col">Real Weight</th>
      <th scope="col">Phy Weight</th>
      
      
       <th scope="col">Difference</th>
       
       <th scope="col">Diff Value</th>
      <th scope="col">Store</th>
     
      
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    
    
   
    $i=1;$total=0;
  
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_physical_stock   where tps_set='Y' $string2   order by tps_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                     
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
      <td><?=$result_kotlist['tps_date']?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tps_phy_id']?></td>
       <td><?=$result_kotlist['tps_name']?></td>
        
      <td><?=$result_kotlist['tps_rate_type']?></td>
      <td><?=$result_kotlist['tps_unittype']?></td>
      
      <td><?=$result_kotlist['tps_store_qty']?></td>
        <td><?=$result_kotlist['tps_qty']?></td>
        
      <td><?=$result_kotlist['tps_store_weight']?></td>
       <td><?=$result_kotlist['tps_weight']?></td>
      
       
      <?php  if($result_kotlist['tps_unittype']=='Single' || $result_kotlist['tps_unittype']=='Nos'){ ?>
     
      <td> Qty: <?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])?> </td>
             
       <?php }else{ 
                  
                  
            if( $result_kotlist['tps_rate_type']=='Packet' && ($result_kotlist['tps_unittype']=='KG' || $result_kotlist['tps_unittype']=='LTR')){     ?>
         
                 <td> Qty: <?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])?> </td>
                
          <?php  }else{ ?>
              <td> Wgt: <?=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight'])?> </td>    
           
       <?php } } ?>
          
              
     <?php  if($result_kotlist['tps_unittype']=='Single' || $result_kotlist['tps_unittype']=='Nos'){ ?>
     
      <td> <?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])?> </td>
             
       <?php }else{ 
                  
                  
            if( $result_kotlist['tps_rate_type']=='Packet' && ($result_kotlist['tps_unittype']=='KG' || $result_kotlist['tps_unittype']=='LTR')){     ?>
         
                 <td>  <?=($result_kotlist['tps_store_qty']-$result_kotlist['tps_qty'])*$result_kotlist['tps_rate']?> </td>
                
          <?php  }else{ ?>
              <td> <?=($result_kotlist['tps_store_weight']-$result_kotlist['tps_weight'])*$result_kotlist['tps_rate']?> </td>    
           
       <?php } } ?>
              
              
         
      <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tps_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
      
    </tr>
    
                                                      
            <?php
             }
             }
        
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='sales_reduce'){
    
    
   /////sales reduce////// 
    
 if($_REQUEST['recipe_type']==''){
        
    ?>
    
    <table class="table table-bordered table-striped" >
    <thead>
                         <tr >
                                        <th >Sl no</th>                                       
                                        <th >Category</th>
					<th >Sub category</th>
                                        <th >Item</th>
                                        <th >Unit Type</th>
                                        <th >Rate</th>
                                        <th >Portion - Weight</th>
                                        <th >Qty</th>
                                        <th >Total</th>
                                    </tr>
            </thead>
<tbody >
    
    <?php
    
        $string="";
        $stringta="";
       
	$string.=" bm.bm_status = 'Closed'";
        $stringta.=" bm.tab_status = 'Closed'";
    
    if($_REQUEST['product']!=''){
        
           $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
    }
    
    
    
    if($_REQUEST['store']!=''){
        
           $string.= " and mm.mr_inventory_kitchen = '".$_REQUEST['store']."' ";
            $stringta.= " and mm.mr_inventory_kitchen = '".$_REQUEST['store']."' ";
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
    
       $i=0;$p=0;$old_cat=""; $old_menu='';$unit_type='';
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
                                        where   mm.mr_product_type='Finished' and bd.bd_count_combo_ordering is NULL and $string  
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
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuid "); 
 
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
                                   
                                   echo '<script>
                                       
                                   
                                        document.getElementById("'.$t.'").style.display="none";
                                      
                                        </script>';
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
                                                     
                 ?>    
                   
              <tr id="<?=$i?>">
                    <td ><?=$p?></td>
                    <td ><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td ><?=strtoupper($subcatname)?></td>
                    <td ><?=substr(strtoupper($menuname),0,25)?></td>
                     <td ><?=$unit_type?></td>
                      <td ><?=number_format($result_stw['rt'],$_SESSION['be_decimal']) ?></td>
                    <td ><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td ><?=$qty?></td>
                    
                    <td ><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></td>
                </tr>        
    
                                                      
            <?php
             }
                 } 
             ?>
                
                
                
                 <tr>
		<td style="width:5%" colspan="1" style="text-align:center"><strong>Total</strong></td>
                <td style="width:12%"></td>
                <td style="width:12%"></td>
                <td style="width:22%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"><strong></strong> </td>
                <td style="width:5%"><strong></strong></td>
                
                <td style="width:10%"><strong><?= number_format(str_replace(',','',$final),$_SESSION['be_decimal'])?></strong></td>
            </tr>
                 
           <?php      
           
}else if($_REQUEST['recipe_type']=='recipe'){
    
    
    //recipe wise///
    
    ?>
    <table class="table table-bordered table-striped" >
        <thead>
                         <tr >
                                        <th >Sl no</th>                                       
                                        <th >Category</th>
					<th >Item</th>
                                        <th >Recipes</th>
                                        <th >Unit Type</th>
                                         <th >Rate</th>
                                        <th >Rate Type</th>
                                        <th >Qty</th>
                                         <th >Weight</th>
                                        <th >Total</th>
                                    </tr>
            </thead>
<tbody >
    
    <?php
    
        $string="";
        $stringta="";
       
	$string.=" bm.bm_status = 'Closed'";
        $stringta.=" bm.tab_status = 'Closed'";
    
    if($_REQUEST['product']!=''){
        
           $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['product']."%'";
    }
    
     if($_REQUEST['store']!=''){
        
           $string.= " and mm.mr_inventory_kitchen = '".$_REQUEST['store']."' ";
            $stringta.= " and mm.mr_inventory_kitchen = '".$_REQUEST['store']."' ";
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
    
       $i=0;$p=0;$old_cat=""; $old_menu='';$unit_type='';
       $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
       $weight=0;$unit='';$weight_loose=0;$loose_total=0;
       $qty_final=0; $qty_final_ta=0; $qty_final_cs=0;    $final=0;
         
       $final_rec=0; $final_rec1=0;
               
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
                                        where   mm.mr_product_type='Finished' and bd.bd_count_combo_ordering is NULL and $string  
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
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuname asc "); 
 
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
                                   
                                   echo '<script>
                                       
                                   
                                        document.getElementById("'.$t.'").style.display="none";
                                      
                                        </script>';
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
                                                     
                 ?>    
                   
              <tr id="<?=$i?>">
                    <td ><?=$p?></td>
                    <td ><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                   
                    <td ><?=substr(strtoupper($menuname),0,25)?></td>
                    
                     <td ></td>
                     <td ><?=$unit_type?></td>
                      <td ><?=number_format($result_stw['rt'],$_SESSION['be_decimal']) ?></td>
                    <td ><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td ><?=$qty?></td>
                     <td ></td>
                     <td style="display:block" ><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></td>
              </tr>        
    
                                                      
            <?php
            
            
            $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_menu_ingredient_detail  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_menu_ingredient_detail.tmi_store  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_menu_ingredient_detail.tmi_ing_menuid  where tbl_menu_ingredient_detail.tmi_menuid='".$result_stw['menuid']."'   order by mr_menuname desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      $final_rec=($result_kotlist['tmi_ing_total']*$qty);
                                                      
                                                      $final_rec1=$final_rec1+$final_rec;
                                                      ?>
                <tr>
		<td style="width:5%" colspan="1"></td>
                <td style="width:12%"></td>
                <td style="width:12%"></td>
                <td style="width:22%"><?=$result_kotlist['mr_menuname']?></td>
                <td style="width:10%"><?=$result_kotlist['tmi_ing_unit']?></td>
                <td style="width:10%"><?=$result_kotlist['tmi_ing_total']?></td>
                <td style="width:10%"><?=$result_kotlist['tmi_rate_type']?> </td>
                <td style="width:5%"><?=$result_kotlist['tmi_ing_qty']?></td>
                <td style="width:5%"><?=$result_kotlist['tmi_weight']?></td>
                <td><strong><?= number_format(str_replace(',','',$final_rec),$_SESSION['be_decimal'])?></strong></td>
            </tr>
                                                      
                                                   <?php   
                                                  }
                                                  }
            
            
            
            
            
             }
                 } 
                 
                 $prf=0;
                 
                 $prf=($total-$final_rec1);
                 
                 
             ?>
                
                
                
                 <tr>
		<td style="width:5%;text-align:center" colspan="1" ><strong>Recipe Total</strong></td>
                <td style="width:12%"></td>
                <td style="width:12%"></td>
                <td style="width:22%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"></td>
                <td style="width:10%"><strong style="color:#708f70">Profit: <?=$prf?></strong> </td>
                <td style="width:5%"><strong></strong></td>
                  <td style="width:5%"><strong></strong></td>
                <td style="width:10%"> <strong><?= number_format(str_replace(',','',$final_rec1),$_SESSION['be_decimal'])?></strong></td>
            </tr>
                 
           <?php  
    
}
 else if($_REQUEST['recipe_type']=='stock'){
    
    
    //stock wise///
    
    ?>
    <table class="table table-bordered table-striped" >
        <thead>
                         <tr >
                                        <th >Date</th>   
                                        
                                        <th >Category</th>
					<th >Item</th>
                                        <th >Type</th>
                                        <th >Opening Stock</th>
                                        <th >Purchase</th>
                                         <th >Sales Qty/Wgt</th>
                                        <th >Transfer</th>
                                        <th >Consumption</th>
                                         <th >Recipe</th>
                                         <th >Physical +</th>
                                        <th >Physical -</th>
                                         <th >Return</th>
                                          <th >Wastage</th>
                                         <th >Closing Stock</th>
                                         <th >Stock + </th>
                                         <th >Stock -</th>
                                        
                                        
                                    </tr>
            </thead>
<tbody >
    
    <?php
    
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
            
     
    ?>    
                   
              <tr>
                    <td ><?=$result_stw['dayclose']?></td>
                    <td ><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td ><?=substr(strtoupper($menuname),0,25)?></td>
                    
                    <td ><?=$unittype.$unit_weight?></td> 
                    
                    <td ><?=($openstock+$sales_reduce+$consumption+$return+$wastage)?></td>
                    <td ><?=$purchase?></td>
                    <td ><?=$sales_reduce?></td>
                    <td ><?=$transfer?></td>
                    <td ><?=$consumption?></td>
                    <td ><?=$recipe*$qty?></td>
                    <td ><?=$physical_plus?></td>
                    <td ><?=$physical_minus?></td>
                    <td ><?=$return?></td>
                      <td ><?=$wastage?></td>
                    <td ><?=$openstock?></td>
                    <td ><?=($purchase)?></td>
                    <td ><?=($sales_reduce+$consumption+$return+$wastage)?></td>
              </tr>        
    
                                                      
        <?php
                 
                 
       } }     
}          
           
        
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='purchase_return'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
         <th scope="col">Date</th>
      <th scope="col">Ret Id</th>  
        <th scope="col">Grn Id</th>  
     <th scope="col">Product</th>
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
      <th scope="col">Tax</th>
      <th scope="col">Final Total</th>
     <th scope="col">Store</th>
    
    </tr>
  </thead>
<tbody >
    
    <?php
    
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tpr_return_id like '%".$_REQUEST['id']."%'   ";
    }
    
    
      if($_REQUEST['product']!=''){
    $string2.=" and mr_menuname like '%".$_REQUEST['product']."%'   ";
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
                                                           ?>    
                                                      
    
    
      <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
       <td><?=$result_kotlist['tpr_date']?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tpr_return_id']?></td>
     
      <td><?=$result_kotlist['tpr_grn']?></td>
        <td><?=$result_kotlist['mr_menuname']?></td>
      <td><?=$result_kotlist['tpr_rate_type']?></td>
      <td><?=$result_kotlist['tpr_unit_type']?></td>
      <td><?=$result_kotlist['tpr_qty']?></td>
      <td><?=$result_kotlist['tpr_weight']?></td>
      <td><?=number_format($result_kotlist['tpr_rate'],$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($result_kotlist['tpr_total'],$_SESSION['be_decimal']) ?></td>
       <td><?=number_format($result_kotlist['tpp_tax_rate'],$_SESSION['be_decimal']) ?></td>
        <td><?=number_format($result_kotlist['tpr_final'],$_SESSION['be_decimal']) ?></td>
        <td><?=$result_kotlist['ti_name']?></td>
        
      
       
    </tr>
    
                                                      
       <?php
          }
          }
       ?>                                        
                                                  
            <tr>
      <td scope="row" style="text-align: center;">Total</td>
     
      <td class="td-overflow-hidden"></td>
       <td></td>
        <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
     <td></td> 
      <td><?=number_format($total,$_SESSION['be_decimal']) ?></td>
     <td></td>
       
    </tr>                                      
       <?php
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='consumption_report'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col">Id</th>  
     <th scope="col">Product</th>
      
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
      <th scope="col"> Store</th>
      <th scope="col"> Date</th>
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_consumption   where tc_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tc_total'];
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
     
      <td class="td-overflow-hidden"><?=$result_kotlist['tc_con_id']?></td>
       <td><?=$result_kotlist['tc_name']?></td>
        
      <td><?=$result_kotlist['tc_rate_type']?></td>
      <td><?=$result_kotlist['tc_unit_type']?></td>
      <td><?=$result_kotlist['tc_qty']?></td>
      <td><?=$result_kotlist['tc_weight']?></td>
      <td><?=number_format($result_kotlist['tc_rate'],$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($result_kotlist['tc_total'],$_SESSION['be_decimal']) ?></td>
      
      <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tc_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
      <td><?=$result_kotlist['tc_date']?></td>
    </tr>
    
                                                      
      <?php
        }
          }
            
       ?>
    
    
    <tr>
      <td scope="row" style="text-align: center;">Total</td>
     
      <td class="td-overflow-hidden"></td>
       <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=  number_format($total,$_SESSION['be_decimal'])?></td>
     <td></td>
      <td></td>
     
     
    </tr>                 
    
 <?php
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='wastage_report'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col">Id</th>  
     <th scope="col">Product</th>
      
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col">Rate</th>
      <th scope="col">Total</th>
      <th scope="col"> Store</th>
      <th scope="col"> Date</th>
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_wastage  where tw_set='Y' $string2   $string22  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      $total=$total+$result_kotlist['tw_total'];
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
     
      <td class="td-overflow-hidden"><?=$result_kotlist['tw_wastage_id']?></td>
       <td><?=$result_kotlist['tw_name']?></td>
        
      <td><?=$result_kotlist['tw_rate_type']?></td>
      <td><?=$result_kotlist['tw_unit_type']?></td>
      <td><?=$result_kotlist['tw_qty']?></td>
      <td><?=$result_kotlist['tw_weight']?></td>
      <td><?=number_format($result_kotlist['tw_rate'],$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($result_kotlist['tw_total'],$_SESSION['be_decimal']) ?></td>
      
      <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tw_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
      <td><?=$result_kotlist['tw_date']?></td>
    </tr>
    
                                                      
      <?php
        }
          }
            
       ?>
    
    
    <tr>
      <td scope="row" style="text-align: center;">Total</td>
     
      <td class="td-overflow-hidden"></td>
       <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=  number_format($total,$_SESSION['be_decimal'])?></td>
     <td></td>
      <td></td>
     
     
    </tr>                 
    
 <?php
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='production_report'){
    
    
    ?>
    <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
         <th scope="col"> Date</th>
      <th scope="col">Id</th>  
     <th scope="col">Product</th>
      
      <th scope="col">Rate Type</th>
      <th scope="col">Unit</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
      <th scope="col"> Store</th>
      <th scope="col"> Cost</th>
    </tr>
  </thead>
<tbody >
    
    <?php
    
   $string2='';
    
    if($_REQUEST['id']!=''){
    $string2.=" and tp_production_id like '%".$_REQUEST['id']."%'   ";
    }
    
    if($_REQUEST['product']!=''){
    $string2.=" and tp_name like '%".$_REQUEST['product']."%'   ";
    }
    
    
     if($_REQUEST['store']!=''){
    $string2.=" and tp_store = '".$_REQUEST['store']."'   ";
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
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_production  where tp_set='Y' $string2   order by tp_id desc  "); 
 
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                                      
                                                      
                                                           ?>    
                                                      
    
    
     <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
      <td><?=$result_kotlist['tp_date']?></td>
      <td class="td-overflow-hidden"><?=$result_kotlist['tp_production_id']?></td>
       <td><?=$result_kotlist['tp_name']?></td>
        
      <td><?=$result_kotlist['tp_rate_type']?></td>
      <td><?=$result_kotlist['tp_unit_type']?></td>
      <td><?=$result_kotlist['tp_qty']?></td>
      <td><?=$result_kotlist['tp_weight']?></td>
     
      <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tp_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
      
      <?php
      $tot_cost=0;
     $sql_kotlistf1  =  $database->mysqlQuery("SELECT sum(tmi_ing_total) as tot from tbl_menu_ingredient_detail  where tmi_menuid='".$result_kotlist['tp_product']."'   "); 
 
    $num_kotlistf1  = $database->mysqlNumRows($sql_kotlistf1);
					if($num_kotlistf1){ 
						  while($result_kotlistf1  = $database->mysqlFetchArray($sql_kotlistf1)) 
							  {  
                                              $tot_cost= $result_kotlistf1['tot'];       
                                        }}
                                                      ?>
                                      
      
     <?php  if($result_kotlist['tp_unit_type']=='Single' || $result_kotlist['tp_unit_type']=='Nos'){ ?>
     
      <td> <?=($tot_cost*$result_kotlist['tp_qty'])?> </td>
             
       <?php }else{ 
                  
                  
            if( $result_kotlist['tp_rate_type']=='Packet' && ($result_kotlist['tp_unit_type']=='KG' || $result_kotlist['tp_unit_type']=='LTR')){     ?>
         
                 <td><?=($tot_cost*$result_kotlist['tp_qty'])?> </td>
                
          <?php  }else{ ?>
              <td>  <?=($tot_cost*$result_kotlist['tp_weight'])?> </td>    
           
       <?php } } ?> 
      
      
     
      
     
      
      
     
    </tr>
    
                                                      
      <?php
        }
          }
            
       ?>
    
 <?php
}

if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='conversion_report'){  ?>
    
    
   
   <table class="table table-bordered table-striped" >
  <thead>
    <tr> <th scope="col">Sl</th>
      <th scope="col"> Date</th>  
     <th scope="col">From Product</th>
       <th scope="col">To Product</th>
     
      <th scope="col">From Store</th>
       <th scope="col">To Store</th>
       
        <th scope="col">Qty</th>
      <th scope="col">Weight</th>
    
         <th scope="col"> Staff</th>
    </tr>
  </thead>
<tbody >
    
    <?php
    
   $lft='';
   $string2='';
    
    if($_REQUEST['from_store']!=''){
         $string2.=" and tbl_product_conversion.tpc_from_store = '".$_REQUEST['from_store']."'   ";
    }
    
    
    
     if($_REQUEST['product1']!=''){
         
         $lft.=" left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_product_conversion.tpc_to_product     ";
         
         $string2.=" and tbl_menumaster.mr_menuname like  '%".$_REQUEST['product1']."%'   ";
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
    
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_product_conversion $lft  where tpc_set='Y' $string2 order by tpc_id asc  "); 
     $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){ 
	  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
		{  
                                                      
              ?>    
            
      <tr>
      <td scope="row" style="text-align: center;"><?=$i++?></td>
      <td><?=$result_kotlist['tpc_date']?></td>
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
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tpc_from_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf['ti_name']?></td>
      
      <?php } } ?>
      
       <?php
      $sql_kotlistf  =  $database->mysqlQuery("SELECT ti_name from tbl_inv_kitchen   where ti_id='".$result_kotlist['tpc_to_store']."'   "); 
 
    $num_kotlistf  = $database->mysqlNumRows($sql_kotlistf);
					if($num_kotlistf){ 
						  while($result_kotlistf5  = $database->mysqlFetchArray($sql_kotlistf)) 
							  {  
                                                      ?>
                                                  
      <td><?=$result_kotlistf5['ti_name']?></td>
      
      <?php } } ?>
      
       <td><?=$result_kotlist['tpc_qty']?></td>
       <td><?=$result_kotlist['tpc_weight']?></td>
      
      
     
       <td><?=$result_kotlist['tpc_login']?></td>
    </tr>
    
                                                      
  <?php
      }
      
     }
            
   ?>
    
 <?php
 
}
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='food_cost_report'){
    
    if($_REQUEST['type_view']=='detailed'){
        
    ?>
    
    <table class="table table-bordered table-striped" >
        
    <thead>
      <tr> <th scope="col">Sl</th>
      <th scope="col">Store</th>
      <th scope="col">Date</th>
      <th scope="col">Item Name</th>
      <th scope="col">Portion</th>
      <th scope="col">Yield</th>
      <th scope="col">Rate</th>
      <th scope="col">Qty</th>
      <th scope="col">Weight</th>
       
     <th scope="col">DI Cost</th>
     <th scope="col">TA Cost</th>
     <th scope="col">HD Cost</th>
     <th scope="col">CS Cost</th>
    
    </tr>
    
  </thead>
  <tbody >
    
    <?php
    
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
    $sql_kotlist1  =  $database->mysqlQuery("SELECT * from tbl_food_cost  left join tbl_inv_kitchen on tbl_inv_kitchen.ti_id=tbl_food_cost.tfc_store  left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_food_cost.tfc_menu  left join tbl_portionmaster on tbl_portionmaster.pm_id=tbl_food_cost.tfc_portion  where tfc_date !='' $string2 group by  tfc_menu,tfc_portion,tfc_date order by tfc_date desc  "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){ 
						  while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
							  {  
                                                      
                                 ?>
    <tr>
       <td scope="row" style="text-align: center;"><?=$i++?></td>
       <td style="font-weight:bold"><?=$result_kotlist1['ti_name']?></td>
        
       <td style="font-weight:bold"><?=$result_kotlist1['tfc_date']?></td>
       <td style="font-weight:bold"><?=$result_kotlist1['mr_menuname']?></td>
      <td style="font-weight:bold"><?=$result_kotlist1['pm_portionname']?></td>
      <td style="font-weight:bold"><?=$result_kotlist1['tfc_yield']?></td>
      <td></td>
      
      <td></td>
        <td></td>
       
       <td></td>
        <td></td>
          <td></td>
        <td></td>
     
      
    </tr>
    
    <?php
                                                      
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
                                                       
        ?>    
           
      <tr>
      <td scope="row" style="text-align: center;font-size: 10px;color: darkgray"><?=$ii++?>.</td>
      <td>' '</td>
        
       <td>' '</td>
       <td> *<?=$result_kotlist['mr_menuname']?></td>
      <td> </td>
        <td></td>
       <td> <?=$result_kotlist['tfc_rate']?></td>
       
      <td><?=$result_kotlist['tfc_qty']?></td>
      <td><?=$result_kotlist['tfc_weight']?></td>
     
      <td><?=number_format($di,$_SESSION['be_decimal']) ?></td>
      
       <td><?=number_format($ta,$_SESSION['be_decimal']) ?></td>
       <td><?=number_format($hd,$_SESSION['be_decimal']) ?></td>
       <td><?=number_format($cs,$_SESSION['be_decimal']) ?></td>
        
     </tr>
                                                 
       <?php
       
                  } }
       ?>                                        
                                                  
    <tr >
      <td scope="row" style="text-align: center;">Total</td>
     
      <td class="td-overflow-hidden"></td>
        <td></td>
        <td></td>
        <td> </td>
        <td></td>
        <td></td>
      <td></td>
      <td></td>
      <td><?=number_format($di1,$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($ta1,$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($hd1,$_SESSION['be_decimal']) ?></td>
      <td><?=number_format($cs1,$_SESSION['be_decimal']) ?></td>
      
      </tr> 
       
  <?php } }
          
  }else{
         
   /////////////summary/////////////////
        
  ?>
       
    <table class="table table-bordered table-striped" >
    <thead>
    <tr>
         <th scope="col">Sl</th>
         <th scope="col">Date</th>
         <th scope="col">Category</th> 
<!--         <th scope="col">Sub Category</th> -->
         <th scope="col">Item Name</th> 
         <th scope="col">Unit Type</th> 
         <th scope="col">Portion/Unit</th> 
         <th scope="col">Store</th>
         <th scope="col">Qty</th> 
         
         
         <th scope="col">Cost/Unit</th>
         <th scope="col">Total Cost</th>
         <th scope="col">Rate/Unit</th>
         <th scope="col">Sales Total</th>
         <th scope="col">Profit</th>
     
     
    </tr>
  </thead>
<tbody >
    
    <?php
    
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
    
            $i=1;  $tot_sale=0;    $tot_cost=0; $tot_profit=0; $tot_sale1=0;    $tot_cost1=0; $tot_profit1=0;
    
            $qty=0;  $rate=0;  
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
                                        
                                        select mm.mr_inventory_kitchen as store,mc.mmy_maincategoryname as maincategory, 
                                        sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
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
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id,bd.tab_base_unit_id,bd.tab_unit_weight,bm.tab_dayclosedate
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuid  ");
            
                $num_kotlist12  = $database->mysqlNumRows($sql_kotlist12);
	        if($num_kotlist12){ 
		while($result_kotlist12  = $database->mysqlFetchArray($sql_kotlist12)) 
		{  
                    
                  $qty=$result_kotlist12['qty_all'];
                    
                  $rate=$result_kotlist12['rt'];
                    
                  $tot_sale= $result_kotlist12['total'];
               
                  $tot_cost= $result_kotlist12['costall'];
                  
                  $tot_profit=($tot_sale-$tot_cost);    
                  
                  $tot_sale1= $tot_sale1+$tot_sale;
               
                  $tot_cost1= $tot_cost1+$tot_cost;
                  
                  $tot_profit1=$tot_profit1+$tot_profit;
                  
                 ?>
         <tr>
         <td scope="row" style="text-align: center;"><?=$i++?></td>
         <td style=""><?=$result_kotlist12['dayclose']?></td>
         <td style="font-weight:bold"><?=$result_kotlist12['maincategory']?></td>
         <td style="font-weight:bold;display: none"><?=$result_kotlist12['subcategory']?></td>
         
        <td style="font-weight:bold"><?=$result_kotlist12['menuname']?></td>
       
        <td style=""><?=$result_kotlist12['unit_type']?></td>
         
        <td style=""><?=$result_kotlist12['portionname'].$result_kotlist12['baseunitname']?></td>
       
         <?php
          
         $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist12['store']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
         if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                  
              ?>
        
              <td><?=$result_fnctvenue['ti_name']?></td>
                       
             <?php } }else{ ?> 
              
             <td></td> 
             
             <?php } ?>     
             
        
       <td style=""><?=$qty?></td>
       
       <td><?=number_format(($result_kotlist12['costall']/$qty),$_SESSION['be_decimal'])?></td>
          
       <td style=""><?=number_format($result_kotlist12['costall'],$_SESSION['be_decimal']) ?></td>
       <td style=""><?=number_format($rate,$_SESSION['be_decimal'])?></td>
       <td style=""><?=number_format($tot_sale,$_SESSION['be_decimal'])?></td>
       <td style=""><?=number_format(($tot_sale-$tot_cost),$_SESSION['be_decimal'])?></td>
       </tr>
                                            
      <?php } } ?>
         
         <tr>
         <td scope="row" style="text-align: center;">Total</td>
         <td style=""></td>
         <td style="font-weight:bold"></td>
         <td style="font-weight:bold"></td>
         
       <td style="font-weight:bold;display: none"></td>
       
       <td style=""></td>
        
       <td style=""></td>
       
       <td style=""></td>
       <td style=""></td>
        
       <td></td>
          
       <td style=""><?=number_format($tot_cost1,$_SESSION['be_decimal'])?></td>
       <td style=""></td>
       <td style=""><?=number_format($tot_sale1,$_SESSION['be_decimal'])?></td>
       <td style=""><?=number_format($tot_profit1,$_SESSION['be_decimal'])?></td>
       </tr>
       
       <?php 
          
  }
       
       
}
?>