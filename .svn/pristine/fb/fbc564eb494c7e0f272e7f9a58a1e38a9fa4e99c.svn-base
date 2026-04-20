<?php
session_start();
include("..\database.class.php"); 
$database	= new Database();
/**************Purchase table *************/
if(isset($_REQUEST['set']) && $_REQUEST['set']=='get_purchase_data'){ 

	if(isset($_REQUEST['date']))
	{
		$date =$_REQUEST['date'];
	}
	else
	{
		$date=$_SESSION['date'];
	}
$purchase_history = $database->mysqlQuery("SELECT a.tg_grn_id,c.tg_grand_total as total,a.tg_supplier,b.v_name FROM `tbl_grn_order` as a LEFT JOIN tbl_vendor_master as b on a.tg_supplier=b.v_id LEFT JOIN tbl_grn_summary as c ON a.tg_grn_id=c.tgs_grn_id WHERE a.tg_dayclosedate='".$date."' AND a.tg_status='Approved' GROUP BY a.tg_grn_id ORDER BY total DESC LIMIT 15");
$num_purchase = $database->mysqlNumRows($purchase_history);
	?>
    
   <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">Supplier Name</th>
      <th scope="col">Purchase AMT</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
    if($num_purchase){

       while($purchase=$database->mysqlFetchArray($purchase_history)) 
      { ?>
     
    <tr>
      <td scope="row" style="text-align: center;"><?=$purchase['v_name'];?></td>
      <td><?=$purchase['total'];?></td>
    </tr>
<?php }}
else{ ?>

      <tr>
      <td scope="row" style="text-align: center;" colspan="2">No Results Found</td>

    </tr>

<?php } ?>
  </tbody>
</table>
     
<?php }



/*********PRODUCT DETAILS***************/
if(isset($_REQUEST['set']) && $_REQUEST['set']=='product_details')
{

	if(isset($_REQUEST['date']))
	{
		$date =$_REQUEST['date'];
	}
	else
	{
		$date=$_SESSION['date'];
	}

	    $sql_finished  =  $database->mysqlQuery("SELECT SUM(CASE WHEN mr_product_type ='Finished' THEN 1 ELSE 0 END) as finished,SUM(CASE WHEN mr_product_type='Raw' THEN 1 ELSE 0 END) as raw FROM tbl_menumaster WHERE date(mr_modifieddate)<='".$date."'"); 
     $result_finished  = $database->mysqlFetchArray($sql_finished); 

     $week = date('Y-m-d',strtotime("+7 day"));
     $sql_expiry = $database->mysqlQuery("SELECT count(tg_id) as expiry FROM `tbl_grn_order` WHERE tg_expiry_date BETWEEN '".$date."' AND '".$week."'");
     $result_expiry = $database->mysqlFetchArray($sql_expiry);

   //  $reorder_qry = $database->mysqlQuery("SELECT tbl_store_stock.ts_product,tbl_menumaster.mr_reorder_level,sum(tbl_store_stock.ts_qty) as total_qty FROM tbl_store_stock LEFT JOIN tbl_menumaster ON tbl_store_stock.ts_product=tbl_menumaster.mr_menuid GROUP BY tbl_store_stock.ts_product");

        $reorder_qry = $database->mysqlQuery("SELECT tbl_store_stock.ts_product,tbl_store_stock.ts_qty,tbl_store_stock.ts_weight,tbl_store_stock.ts_unit,tbl_menumaster.mr_reorder_level,sum(tbl_store_stock.ts_qty) as total_qty ,sum(tbl_store_stock.ts_weight) as total_weight FROM tbl_store_stock LEFT JOIN tbl_menumaster ON tbl_store_stock.ts_product=tbl_menumaster.mr_menuid GROUP BY tbl_store_stock.ts_product");


      $reorder=0;
      while($row=$database->mysqlFetchArray($reorder_qry)) 
      {
      	if($row['ts_unit']=='Nos')
      	{
      		if($row['total_qty']<$row['mr_reorder_level'])
      		{
      			$reorder++;
      		}
      	}
      	else if($row['ts_unit']=='Single')
      	{
      		if($row['total_qty']<$row['mr_reorder_level'])
      		{
      			$reorder++;
      		}
      	}
      	else 
      	{
      			
      		
      		if($row['total_weight']<$row['mr_reorder_level'])
      		{
      			$reorder++;
      		}
      	}
      	
      }

     ?>

    <div class="inv-finised" style="background-image: linear-gradient(348deg, #1363df, #71a1ec)!important;">
    <h6>Finished Goods</h6>
    <p><?= isset($result_finished['finished'])?$result_finished['finished']:'0'; ?></p></div>

    <div class="inv-raw" style="background-image: linear-gradient(348deg, #52a116, #7cc246)!important;">
    <h6>Raw Material</h6>
    <p><?=isset($result_finished['raw'])?$result_finished['raw']:'0'; ?></p></div>

    <div class="inv-finised" style="background-image: linear-gradient(348deg, #be0e40, #f14173)!important;">
    <h6>Expiry</h6>
    <p><?=isset($result_expiry['expiry'])?$result_expiry['expiry']:'0'?></p></div>

<div onclick="reorder_nav();" class="inv-raw" style="background-image: linear-gradient(348deg, #b29221, #f9d043)!important;cursor: pointer">
    <h6>Re-Order</h6>
    <p><?=isset($reorder)?$reorder:'0'?></p></div> 

<?php 
}


/************STOCK DETAILS ***************/
if(isset($_REQUEST['set']) && $_REQUEST['set']=='stock_details')
{
  $store_id= $_REQUEST['store'];
	if(isset($_REQUEST['date']))
	{
		$date =$_REQUEST['date'];
	}
	else
	{
		$date=$_SESSION['date'];
	}
  // $complete_table = $database->mysqlQuery("SELECT sd_id FROM tbl_stock_details");
  // $check = $database->mysqlNumRows($complete_table);



  // if($check == 0)
  // {
  //   $insert_day_stock =  $database->mysqlQuery("INSERT INTO tbl_stock_details(sd_date,sd_opening_stock,sd_stock_value,sd_stock_transfer,sd_stock_purchase,sd_closing_stock,sd_store_id)" ."VALUES ('".$date."','0.00','0.00','0.00','0.00','0.00','".$store_id."')"); 
  // }

	   $stock_details_qry = $database->mysqlQuery("SELECT * FROM `tbl_stock_details` WHERE sd_date='".$date."' AND sd_store_id='".$store_id."'");
     $stock_details = $database->mysqlFetchArray($stock_details_qry);

       	$current_closing_qry = $database->mysqlQuery("SELECT SUM(ts_total) as closing_stock FROM tbl_store_stock WHERE ts_store ='".$store_id."'");
       	$current_closing_res = $database->mysqlFetchArray($current_closing_qry);
        $sd_closing_stock  = $current_closing_res['closing_stock'];


       //$stock_purchase_qry = $database->mysqlQuery("SELECT sum(ts_total) as purchase FROM `tbl_store_stock` WHERE ts_stock_update_date='".$date."' AND ts_store='".$store_id."'");
       $stock_purchase_qry = $database->mysqlQuery("SELECT SUM(tg_final_rate) as purchase FROM `tbl_grn_order` WHERE tg_dayclosedate='".$date."' AND tg_store='".$store_id."' AND tg_status='Approved'");
       $stock_purchase_row = $database->mysqlFetchArray($stock_purchase_qry);
        $stock_purchase = $stock_purchase_row['purchase']; 


       

        $stock_transfer_qry = $database->mysqlQuery("SELECT sum(tt_total) as stock_transfer FROM tbl_store_transfer WHERE tt_dayclosedate='".$date."' AND tt_from_store ='".$store_id."'");
        $stock_transfer_row = $database->mysqlFetchArray($stock_transfer_qry);
        $stock_transfer = $stock_transfer_row['stock_transfer'];

        $stock_value_qry = $database->mysqlQuery("SELECT SUM(ts_total) as stock FROM `tbl_store_stock` WHERE ts_store='".$store_id."'");
        $stock_value_row = $database->mysqlFetchArray($stock_value_qry);
        $stock_value = $stock_value_row['stock'];

        $sd_stock_transfer= isset($stock_transfer)?$stock_transfer:'0.000';
        $sd_stock_purchase= isset($stock_purchase)?$stock_purchase:'0.000';
        $sd_closing_stock=  $sd_closing_stock;
     	  $sd_stock_value = $stock_value;

      // $day_stock =  $database->mysqlQuery("select sd_id from tbl_stock_details where sd_date='".$date."'"); 
       $exist   = $database->mysqlNumRows($stock_details_qry);

       if($exist==1)
       {
        $sd_id = $stock_details['sd_id'];

   		 $update_day_stock =  $database->mysqlQuery("UPDATE tbl_stock_details SET sd_date='".$date."',sd_stock_value='".$sd_stock_value."',sd_stock_transfer='".$sd_stock_transfer."',sd_stock_purchase='".$sd_stock_purchase."',`sd_closing_stock`='".$sd_closing_stock."' WHERE sd_id='".$sd_id."'"); 
       }
       else
       {
      		
       		$opn_stock_qry = $database->mysqlQuery("SELECT SUM(ts_total)as opening_stock FROM tbl_store_stock WHERE ts_store ='".$store_id."'");
        	$opn_stock_res = $database->mysqlFetchArray($opn_stock_qry);
        	$sd_opening_stock  = $opn_stock_res['opening_stock'];

         if(!$sd_opening_stock)
         {
          $sd_opening_stock='0.00';  
          $sd_closing_stock='0.00';      
         }
        
        //	$sd_store_id  = $opn_stock_res['ts_store'];
        	//$sd_opening_stock  = $opn_stock_res['opening_stock'];
        //if($sd_opening_stock)
 

       	$sd_stock_value = $sd_opening_stock+$sd_stock_purchase-$sd_stock_transfer;
                                                                                                                                                                                                                                                                                                                                                                                                                                           
       	$insert_day_stock =  $database->mysqlQuery("INSERT INTO tbl_stock_details(sd_date,sd_opening_stock,sd_stock_value,sd_stock_transfer,sd_stock_purchase,sd_closing_stock,sd_store_id)" ."VALUES ('".$date."','".$sd_opening_stock."','".$sd_stock_value."','".$sd_stock_transfer."','".$sd_stock_purchase."','".$sd_closing_stock."','".$store_id."')"); 
       }


  ?>



                <div class="inv-finised" style="background-image: linear-gradient(348deg, #16aba5, #33dad3)!important;">
                <h6>Opening Stock</h6>

                <p><?= isset($stock_details['sd_opening_stock'])?$stock_details['sd_opening_stock']:'0.000'?></p>
            </div>
                <div class="inv-raw" style="background-image: linear-gradient(348deg, #4b2f76, #8771a8)!important;">
                <h6>Stock Value</h6>
                <p><?= isset($stock_details['sd_stock_value'])?$stock_details['sd_stock_value']:'0.000'?></p>
            </div>
            <div class="inv-finised" style="background-image: linear-gradient(348deg, #cc6000, #ff861a)!important;">
                <h6>Stock Trasfer</h6>
               <p><?= isset($stock_details['sd_stock_transfer'])?$stock_details['sd_stock_transfer']:'0.000'?></p>
            </div>
            <div class="inv-raw" style="background-image: linear-gradient(348deg, #885a5a, #bb8d8d)!important;">
                <h6>Stock Purchase</h6>
               <p><?= isset($stock_details['sd_stock_purchase'])?$stock_details['sd_stock_purchase']:'0.000'?></p>
            </div>

<?php }


if(isset($_REQUEST['set'])&& $_REQUEST['set']=='profit_chart')
{
  $date = $_SESSION['date'];
  $week =date ( 'Y-m-d' , strtotime ( $date . ' - 4 days' ));

$profit_result =  $database->mysqlQuery("SELECT sum(x.total) as total, x.dayclose from (SELECT SUM(bm_total) as total,bm_dayclosedate as dayclose FROM tbl_tablebillmaster WHERE bm_status='Closed' AND bm_complimentary='N' GROUP BY bm_dayclosedate
UNION
SELECT SUM(tab_netamt) as total, tab_dayclosedate as dayclose FROM `tbl_takeaway_billmaster` WHERE `tab_complimentary`='N' AND `tab_status`='Closed' GROUP BY `tab_dayclosedate`)x WHERE x.dayclose>='$week' AND x.dayclose<='$date' group by  x.dayclose order by x.dayclose ASC");

$profit_date=Array();

 foreach($profit_result as $pdate)
 {
  $profit_date []=$pdate['dayclose'];

 }

$expense_result = $database->mysqlQuery("SELECT sum(x.expense) as expense,x.date from
(SELECT sum(ev_amount) as expense,ev_date as date FROM `tbl_expense_voucher` GROUP BY ev_date
UNION
SELECT SUM(sv_subtotal) as expense,sv_date as date FROM `tbl_supplier_voucher` GROUP BY sv_date
UNION
SELECT SUM(ev_amount) as expense,ev_date as date FROM `tbl_employee_voucher` GROUP BY ev_date)x WHERE x.date>='$week' AND x.date<='$date' group by x.date order by x.date ASC");

$expense_date=Array();

 foreach($expense_result as $dates)
 {
  $expense_date []=$dates['date'];

 }


$chart_array1=Array();
$chart_array2=Array();
$chart_array3=Array();
$history=Array();

 foreach($profit_result as $profit)
 {
 if (!in_array($profit['dayclose'], $expense_date))
 {
   $chart_array1[]=[
     'dayclose'=> $profit['dayclose'],
     'sale'=> $profit['total'],
     'expense' => 0,
     'loss'=> $profit['total']
   ];  
 }
}


foreach($expense_result as $expense)
{
  if(!in_array($expense['date'],$profit_date))
  {
    $sale=0;
    $loss= $sale-$expense['expense'];
    $chart_array2[]=[
      'dayclose'=> $expense['date'],
      'sale' => $sale,
      'expense' =>$expense['expense'],
      'loss' =>$loss
    ];
  }
}


foreach($profit_result as $profit_row)
{
  foreach($expense_result as $exp_row)
  {
    if($profit_row['dayclose']==$exp_row['date'])
    {
      $loss= $profit_row['total']-$exp_row['expense'];
      $chart_array3[]=[
        'dayclose'=> $profit_row['dayclose'],
        'sale'=> $profit_row['total'],
        'expense' => $exp_row['expense'],
        'loss' =>$loss
      ];          
    }
  }
}

$chart= array_merge($chart_array1,$chart_array2,$chart_array3);

//print_r($history);


// $result = Array();
//     foreach ($profit_result as $profit) {
//         foreach ($expense_result as $expense) {
//             if($profit['dayclose'] ==  $expense['date']) {
//               $expense['loss'] = $profit['total']-$expense['expense'];
//                 $result[] = array_merge($profit,$expense);            
//             }

//         }

//     }


$chart_row = Array();
$i=0;

     foreach ($chart as $row) 
  {   
   $chart_row[$i]=['date'=>$row['dayclose'],'total'=>$row['sale'],'expense'=>$row['expense'],'loss'=>$row['loss']];
       $i++;
  }

  if(empty($chart_row))
  {
    $chart_row[$i]=['date'=>$date,'total'=>0,'expense'=>0,'loss'=>0];
  }

 echo json_encode($chart_row);
 
}



if(isset($_REQUEST['set']) && $_REQUEST['set']=='history_table')
{ $total_sale=0;
  $total_consumption=0;
  $total_fc=0;
// $history_table = $database->mysqlQuery("SELECT ti_name as store,SUM(tc_total) as consumption FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE MONTH(tc_date)=MONTH(NOW()) AND YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date),tc_store");
//   $history_table = $database->mysqlQuery("SELECT q1.store_name,consumption,sale FROM (SELECT ti_name as store_name,SUM(tc_total) as consumption FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE MONTH(tc_date)=MONTH(NOW()) AND YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date),tc_store)   AS q1
//  LEFT JOIN(SELECT SUM(x.total)as sale ,x.store_name FROM(SELECT SUM(b.bd_amount) as total,d.ti_name as store_name FROM tbl_tablebillmaster as a LEFT JOIN tbl_tablebilldetails as b ON a.bm_billno=b.bd_billno JOIN tbl_menumaster as c ON b.bd_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.bm_dayclosedate)=MONTH(NOW()) AND YEAR(a.bm_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.bm_status='Closed' GROUP BY d.ti_id UNION SELECT SUM(b.tab_amount) total,d.ti_name as store_name FROM tbl_takeaway_billmaster as a LEFT JOIN tbl_takeaway_billdetails as b ON a.tab_billno=b.tab_billno JOIN tbl_menumaster as c ON b.tab_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.tab_dayclosedate)=MONTH(NOW()) AND YEAR(a.tab_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.tab_status='Closed' GROUP BY d.ti_id)x GROUP BY x.store_name)   AS q2
//       ON  q2.store_name = q1.store_name");

//  $history_table = $database->mysqlQuery("SELECT q1.store_name,consumption,sale FROM (SELECT SUM(x.total)as sale ,x.store_name FROM(SELECT SUM(b.bd_amount) as total,d.ti_name as store_name FROM tbl_tablebillmaster as a LEFT JOIN tbl_tablebilldetails as b ON a.bm_billno=b.bd_billno JOIN tbl_menumaster as c ON b.bd_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.bm_dayclosedate)=MONTH(NOW()) AND YEAR(a.bm_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.bm_status='Closed' GROUP BY d.ti_id UNION SELECT SUM(b.tab_amount) total,d.ti_name as store_name FROM tbl_takeaway_billmaster as a LEFT JOIN tbl_takeaway_billdetails as b ON a.tab_billno=b.tab_billno JOIN tbl_menumaster as c ON b.tab_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.tab_dayclosedate)=MONTH(NOW()) AND YEAR(a.tab_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.tab_status='Closed' GROUP BY d.ti_id)x GROUP BY x.store_name)AS q1
//          LEFT JOIN (SELECT ti_name as store_name,SUM(tc_total) as consumption FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE MONTH(tc_date)=MONTH(NOW()) AND YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date),tc_store) AS q2 ON  q2.store_name = q1.store_name");
  // $num_history = $database->mysqlNumRows($history_table); 


  $consumption = $database->mysqlQuery("SELECT ti_name as store_name,SUM(tc_total) as consumption FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE MONTH(tc_date)=MONTH(NOW()) AND YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date),tc_store");

  $sale = $database->mysqlQuery("SELECT SUM(x.total)as sale ,x.store_name FROM(SELECT SUM(b.bd_amount) as total,d.ti_name as store_name FROM tbl_tablebillmaster as a LEFT JOIN tbl_tablebilldetails as b ON a.bm_billno=b.bd_billno JOIN tbl_menumaster as c ON b.bd_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.bm_dayclosedate)=MONTH(NOW()) AND YEAR(a.bm_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.bm_status='Closed' GROUP BY d.ti_id UNION SELECT SUM(b.tab_amount) total,d.ti_name as store_name FROM tbl_takeaway_billmaster as a LEFT JOIN tbl_takeaway_billdetails as b ON a.tab_billno=b.tab_billno JOIN tbl_menumaster as c ON b.tab_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE MONTH(a.tab_dayclosedate)=MONTH(NOW()) AND YEAR(a.tab_dayclosedate)=YEAR(NOW()) AND c.mr_product_type='Finished' AND a.tab_status='Closed' GROUP BY d.ti_id)x GROUP BY x.store_name");

$store_con=Array();
$store_sale=Array();

 foreach($consumption as $cons)
 {
  $store_con []=$cons['store_name'];

 }

 foreach($sale as $cons1)
 {
  $store_sale []=$cons1['store_name'];

 }

$history_array1=Array();
$history_array2=Array();
$history_array3=Array();
$history=Array();
  foreach($consumption as $con_row)
  {
  if (!in_array($con_row['store_name'], $store_sale))
  {
    $history_array1[]=[
      'store_name'=> $con_row['store_name'],
      'sale'=> 0,
      'consumption' => $con_row['consumption']
    ];  
  }
  }


    foreach($sale as $sale_row)
    {    
      if (!in_array($sale_row['store_name'], $store_con))
      {
      $history_array2[]=[
        'store_name'=> $sale_row['store_name'],
        'sale'=> $sale_row['sale'],
        'consumption' => 0
      ];
      }
    }


      foreach($consumption as $cons_row)
      {
        foreach($sale as $sale_row)
        {
          if($cons_row['store_name']==$sale_row['store_name'])
          {
            $history_array3[]=[
              'store_name'=> $cons_row['store_name'],
              'sale'=> $sale_row['sale'],
              'consumption' => $cons_row['consumption']
            ];          
          }
        }
      }


      $history= array_merge($history_array1,$history_array2,$history_array3);
  ?>

      <table class="table table-bordered table-striped" style="position :relative;">
  <thead>
    <tr>
      <th scope="col">Store Name</th>
      <th scope="col">Sales</th>
      <th scope="col">Consumption</th>
      <th scope="col">FC</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if($history){
      $total_sale=0;
      $total_consumption=0;
      $total_fc=0;
     foreach($history as $history_table)
      {
        $total_sale=$total_sale+$history_table['sale'];
        $total_consumption=$total_consumption+$history_table['consumption'];?>
      <tr>
<?php
        if($history_table['sale']!='0.000')
        {
          $fc = ($history_table['consumption']/$history_table['sale'])*100;
        }
        else{
          $fc='0.00';
        }
       
        
     
        ?>
      <td><?=$history_table['store_name'];?></td>
      <td><?=$history_table['sale'];?></td>
      <td><?=$history_table['consumption']?$history_table['consumption']:'-';?></td>
      <td><?=round($fc,3)?></td>
    </tr>
     <?php }
      if($total_sale!='0.00')
      {
        $total_fc = ($total_consumption/$total_sale)*100;
      }
      else{
        $total_fc='0.00';
      }

     
     ?>
      <tr style="position:sticky; bottom:0;color: #e77b6c;background-color: #cdcdcd;">
      <th style="text-align:center;"> Total </th>
      <td><?=$total_sale?></td>
      <td><?=$total_consumption?></td>
      <td><?=round($total_fc,3)?></td>
    </tr>
    <?php }
    else{ ?>

      <tr>
      <td scope="row" style="text-align: center;" colspan="4">No Results Found</td>
    
    </tr>
    
    <?php } ?>
    



  </tbody>
</table>

<?php


}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='food_cost_chart')
{


  // $food_cost = $database->mysqlQuery("SELECT  q1.month,consumption,sale  FROM (SELECT MONTHNAME(tc_date) as month,SUM(tc_total) as consumption FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date)) AS q1 LEFT JOIN 
  // (SELECT SUM(x.total)as sale ,x.month FROM(SELECT SUM(b.tab_amount) total,MONTHNAME(a.tab_dayclosedate) as month FROM tbl_takeaway_billmaster as a LEFT JOIN tbl_takeaway_billdetails as b ON a.tab_billno=b.tab_billno JOIN tbl_menumaster as c ON b.tab_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE c.mr_product_type='Finished' AND a.tab_status='Closed' AND YEAR(a.tab_dayclosedate)=YEAR(NOW()) GROUP BY MONTH(a.tab_dayclosedate)
  // UNION SELECT SUM(b.bd_amount) as sale,MONTHNAME(a.bm_dayclosedate) as month FROM tbl_tablebillmaster as a LEFT JOIN tbl_tablebilldetails as b ON a.bm_billno=b.bd_billno JOIN tbl_menumaster as c ON b.bd_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE c.mr_product_type='Finished' AND a.bm_status='Closed' AND YEAR(a.bm_dayclosedate)=YEAR(NOW()) GROUP BY MONTH(a.bm_dayclosedate))x GROUP BY x.month) AS q2 ON q2.month=q1.month");

$consumption = $database->mysqlQuery("SELECT MONTHNAME(tc_date) as month,SUM(tc_total) as consumption,MONTH(tc_date) as num FROM tbl_consumption LEFT JOIN tbl_inv_kitchen ON tbl_consumption.tc_store=tbl_inv_kitchen.ti_id WHERE YEAR(tc_date)=YEAR(NOW()) GROUP BY MONTH(tc_date)");

$cons_months=Array();
foreach($consumption as $cons)
{
  $cons_months[] = $cons['month'];
}

$sales = $database->mysqlQuery("SELECT SUM(x.total)as sale ,x.month,X.num FROM(SELECT SUM(b.tab_amount) total,MONTHNAME(a.tab_dayclosedate) as month,MONTH(a.tab_dayclosedate) as num FROM tbl_takeaway_billmaster as a LEFT JOIN tbl_takeaway_billdetails as b ON a.tab_billno=b.tab_billno JOIN tbl_menumaster as c ON b.tab_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE c.mr_product_type='Finished' AND a.tab_status='Closed' AND YEAR(a.tab_dayclosedate)=YEAR(NOW()) GROUP BY MONTH(a.tab_dayclosedate) UNION SELECT SUM(b.bd_amount) as sale,MONTHNAME(a.bm_dayclosedate) as month,MONTH(a.bm_dayclosedate) as num FROM tbl_tablebillmaster as a LEFT JOIN tbl_tablebilldetails as b ON a.bm_billno=b.bd_billno JOIN tbl_menumaster as c ON b.bd_menuid=c.mr_menuid JOIN tbl_inv_kitchen d ON c.mr_inventory_kitchen=d.ti_id WHERE c.mr_product_type='Finished' AND a.bm_status='Closed' AND YEAR(a.bm_dayclosedate)=YEAR(NOW()) GROUP BY MONTH(a.bm_dayclosedate))x GROUP BY x.month");

$sale_months=Array();
foreach($sales as $sale)
{
  $sale_months[] = $sale['month'];
}

$food_cost1=Array();
$food_cost2=Array();
$food_cost3=Array();

foreach($consumption as $con_row)
{
if (!in_array($con_row['month'], $sale_months))
{
  $food_cost1[]=[
    'num'=>$con_row['num'],
    'month'=> $con_row['month'],
    'consumption' => $con_row['consumption'],
    'sale' =>0
  ];  
}
}

foreach($sales as $sale_row)
{
if (!in_array($sale_row['month'], $cons_months))
{
  $food_cost2[]=[
    'num'=>$sale_row['num'],
    'month'=> $sale_row['month'],
    'consumption' => 0,
    'sale' =>$sale_row['sale']
  ];  
}
}

foreach($consumption as $cons_row)
{
  foreach($sales as $sale_row)
  {
    if($cons_row['month']==$sale_row['month'])
    {
      $food_cost3[]=[
        'num'=>$sale_row['num'],
        'month'=> $cons_row['month'],
        'consumption' => $cons_row['consumption'],
        'sale'=> $sale_row['sale']
      ];          
    }
  }
}


$foods= array_merge($food_cost1,$food_cost2,$food_cost3);

sort($foods);

$i=0;
foreach($foods as $food)
{

  if($food['sale']!=0)
  {
  $food['fc'] = ($food['consumption']/$food['sale'])*100;
  }
  else{
    $food['fc'] =0;
  }

    $chart_row[$i]=['month'=>$food['month'],'food_cost'=> $food['fc']];

       $i++;
     }  

     if(empty($chart_row))
     {
      if(isset($_REQUEST['date']))
      {
        $date =$_REQUEST['date'];
      }
      else
      {
        $date=$_SESSION['date'];
      }
      $newDate = date('F', strtotime($date));
      $chart_row[$i]=['month'=>$newDate,'food_cost'=> 0];
     }
echo json_encode($chart_row);
}
?>