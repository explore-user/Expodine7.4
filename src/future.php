<!DOCTYPE html>
<?php 
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();


if($_SESSION["archive_enabled"]=='Y'){ 
    
$pdo = new PDO(
    "mysql:host=" . HOST_NAME . ";dbname=" . DATABASE_NAME_REPORT . ";charset=utf8mb4",
    USER_NAME,
    PASSWORD
);

 }else{
    
   $pdo = new PDO(
    "mysql:host=" . HOST_NAME . ";dbname=" . DATABASE_NAME . ";charset=utf8mb4",
    USER_NAME,
    PASSWORD 
    );
    
}

?>

<html>
<head>
     <link rel="shortcut icon" href="img/favicon.ico">
    <title>Sales Prediction</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <div style="width: 100%">
  
    <a style="padding: 8px 30px;border: none;border-radius: 8px;font-size: 14px;font-weight: 600;cursor: pointer;
    transition: all 0.3s ease;max-width: 240px;background: darkred;color: white;text-decoration: none; " href="analytics.php">BACK</a>
    
     <a style="padding: 8px 30px;border: none;border-radius: 8px;font-size: 14px;font-weight: 600;cursor: pointer;margin-left: 430px;
    position: absolute;transition: all 0.3s ease;max-width: 240px;background: darkred;color: white;text-decoration: none;margin-top: 10px;
    <?php  if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="sale" )){ ?> border:solid 3px black <?php } ?>"
    href="future.php?set=sale">SALES</a>
    
    <a style="padding: 8px 30px;border: none;border-radius: 8px;font-size: 14px;font-weight: 600;cursor: pointer;margin-left: 570px;
    position: absolute;    transition: all 0.3s ease;max-width: 240px;background: darkred;color: white;text-decoration: none;margin-top: 10px;
        <?php  if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="restock" )){ ?> border:solid 3px black <?php } ?>"
    href="future.php?set=restock" >RESTOCK</a>
    
    </div>
     <?php if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="sale" )){ 
        
   // Get last 6 months sales (sum by month)
   $stmt = $pdo->prepare("
      SELECT month, total FROM (
    SELECT DATE_FORMAT(bm_dayclosedate,'%Y-%m') AS month, SUM(bm_finaltotal) AS total
    FROM tbl_tablebillmaster
    WHERE bm_dayclosedate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and bm_status='Closed' AND bm_complimentary!='Y'
    GROUP BY month
    
    UNION ALL
    
    SELECT DATE_FORMAT(tab_dayclosedate,'%Y-%m') AS month, SUM(tab_netamt) AS total
    FROM tbl_takeaway_billmaster
    WHERE tab_dayclosedate >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) and tab_status='Closed' AND tab_complimentary!='Y'
    GROUP BY month
) x
ORDER BY month ASC");

$stmt->execute();
$sales_data = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(count($sales_data) < 2){
    die("Not enough data of last 3 months to predict future sales.");
}

$totals = [];
$months = [];
foreach($sales_data as $row){
    $months[] = $row['month'];
    $totals[] = $row['total'];
}

// Weighted moving average (recent months get higher weight)
$weights = range(1, count($totals)); // e.g., [1,2,3,4,5,6]
$weighted_sum = 0;
$total_weight = array_sum($weights);

for($i=0; $i<count($totals); $i++){
    $weighted_sum += $totals[$i] * $weights[$i];
}
$weighted_average = $weighted_sum / $total_weight;

// Predict next 3 months using gradual trend
$predicted_totals = [];
$predicted_months = [];
$last_month = new DateTime(end($months)."-01");
$last_sales = end($totals);

for($i=1; $i<=3; $i++){
    // Apply weighted average + small monthly growth (5% trend)
    $last_sales = $weighted_average * (1 + 0.05*$i);
    $predicted_totals[] = round($last_sales,2);
    $last_month->modify('+1 month');
    $predicted_months[] = $last_month->format('Y-m');
}

// Combine historical + predicted for chart
$all_months = array_merge($months, $predicted_months);
$all_totals = array_merge($totals, $predicted_totals);


?>
         
    <div style="width: 100%; max-width: 900px; height: auto; min-height: 300px; margin: 0 auto; background: #eee;margin-top: 40px;">
  
    <canvas id="salesChart" width="950" height="500" ></canvas>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($all_months); ?>,
                datasets: [
                    {
                        label: 'Normal Sales',
                        data: <?php echo json_encode($totals); ?>,
                        borderColor: 'blue',
                        fill: false,
                    },
                    {
                        label: 'Predicted Sales',
                        data: <?php echo json_encode(array_merge(array_fill(0, count($totals), null), $predicted_totals)); ?>,
                        borderColor: 'red',
                        borderDash: [5,5],
                        fill: false,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Approximate Sales Prediction for Next 3 Months' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
    
   <?php } ?> 
    
   <?php  if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="restock" )){
    
   $stmt = $pdo->query("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
    
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total,
                                                    CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),
                                                    COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),
                                                    COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate >= CURDATE() - INTERVAL 90 DAY  and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total,
                                                    CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate >= CURDATE() - INTERVAL 90 DAY  and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate >= CURDATE() - INTERVAL 90 DAY  and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate >= CURDATE() - INTERVAL 90 DAY  and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno )
                                                    x group by x.menuid order by qty desc LIMIT 0,10");

        $sales = $stmt->fetchAll();
        
        ?>
    
   <div class="most_sale_lsit_head" style="top:50px;position: absolute; padding: 0px;font-weight: bold;font-size: 20px">
  
   <span class="most_sale_lsit_rt">CONSIDER RESTOCK OF THIS 10 ITEMS </span>
                        
   </div><br>

   <?php

   foreach ($sales as $s) {
   
   if ($s['qty'] > 5) { ?>
        
   <div class="most_sale_lsit_head" style="margin-top:50px;position: absolute; padding: 0px;font-size: 12px;font-weight: bold;">
  
    <span class="most_sale_lsit_rt"> . &nbsp; <?=$s['menu']?></span>
                        
   </div><br>
         
      <?php   
    }
  }

  }

?>
    
    
</body>
</html>
