<?php

session_start();
include("database.class.php"); 
$database	= new Database();


////payment report///
  $dataPoints='';    $cash=0; 
        $sql_cash =  $database->mysqlQuery("select sum(cash) as cash, sum(pax) as pax from ( select sum(bm.bm_amountpaid)-sum(bm.bm_amountbalace) as cash,sum(bm.bm_totalpax) as pax FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' union all
                                            select sum(tbm.tab_amountpaid)-sum(tbm.tab_amountbalace) as cash, 0 as pax FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."') x");
       $num_cash = $database->mysqlNumRows($sql_cash);
        if($num_cash){
            while($result_cash = $database->mysqlFetchArray($sql_cash)){
               $cash=  number_format($result_cash['cash'],$_SESSION['be_decimal']);
              
            }
        }
        
        $card=0;
       $sql_card =  $database->mysqlQuery("select sum(card) as card from( select sum(bm.bm_transactionamount) as card  FROM tbl_tablebillmaster bm 
                                            where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_paymode='2'  union all
                                            select  sum(tbm.tab_transactionamount) as card FROM tbl_takeaway_billmaster tbm 
                                            where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_paymode='2'  )x");

    $num_card = $database->mysqlNumRows($sql_card);
        if($num_card){
            while($result_card= $database->mysqlFetchArray($sql_card)){
              $card=  number_format($result_card['card'],$_SESSION['be_decimal']);   
            }
        }
        
        $credit=0;
        $sql_credit_person =  $database->mysqlQuery("select sum(credit_person) as credit_person from ( 
                                                    select sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)) as credit_person FROM tbl_tablebillmaster bm
                                                   where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_paymode='6'  union all
                                                    select sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)) as credit_person FROM tbl_takeaway_billmaster tbm 
                                                    where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_paymode='6' ) x");
       $num_credit_person = $database->mysqlNumRows($sql_credit_person);
        if($num_credit_person){
            while($result_credit_person = $database->mysqlFetchArray($sql_credit_person)){
              $credit=  number_format($result_credit_person['credit_person'],$_SESSION['be_decimal']);   
            }
        } 
        
        $comp=0;
        $sql_complimentary =  $database->mysqlQuery("select sum(complimentary) as complimentary from ( 
                                            select sum(bm.bm_finaltotal) as complimentary FROM tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' union all 
                                            select sum(tbm.tab_netamt) as complimentary FROM tbl_takeaway_billmaster tbm left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' ) x");
    
        $num_complimentary = $database->mysqlNumRows($sql_complimentary);
        if($num_complimentary){
            while($result_complimentary = $database->mysqlFetchArray($sql_complimentary)){
               $comp=  number_format($result_complimentary['complimentary'],$_SESSION['be_decimal']);   
            }
        }
        

        
      
        
      $dataPoints = array( 
	array("label"=>"Cash", "y"=>$cash),
	array("label"=>"Card", "y"=>$card),
	array("label"=>"Credit", "y"=>$credit),
	array("label"=>"Complimentary", "y"=>$comp)
	
    );
      
      
      
      
/////  daywise 5 days////     
     $dataPoints1 = array();
       $sql_cash =  $database->mysqlQuery("select sum(tot) as tot, date from(select sum(bm_finaltotal) as tot , bm_dayclosedate as date FROM"
               . " tbl_tablebillmaster where bm_status='Closed' and bm_complimentary!='Y' group by date union all select sum(tab_netamt) as tot, tab_dayclosedate as date FROM"
               . " tbl_takeaway_billmaster where tab_status='Closed' and tab_complimentary!='Y' group by date) x group by date limit 5 ");
     $num_cash = $database->mysqlNumRows($sql_cash);
        if($num_cash){
            while($result_cash = $database->mysqlFetchArray($sql_cash)){
                
       array_push($dataPoints1, array("y" =>  $result_cash['tot'], "label" => $result_cash['date'] ));
            
       //array("y" =>  $result_cash['tot'], "label" => $result_cash['date'] );
            
        }}else{
            array_push($dataPoints1, array("y" =>  0, "label" => '' ));
        }
        
        
     /////  staffwise ////     
      $dataPoints2 = array();
       $sql_cash1 =  $database->mysqlQuery("select sum(tot) as tot, login from(select sum(bm_finaltotal) as tot , bm_settlement_login as login FROM "
               . " tbl_tablebillmaster where bm_status='Closed' and bm_complimentary!='Y' and bm_dayclosedate='".$_SESSION['date']."' group by login union all select sum(tab_netamt) as tot, tab_settlement_login as login FROM"
               . " tbl_takeaway_billmaster where tab_status='Closed' and tab_complimentary!='Y' and tab_dayclosedate='".$_SESSION['date']."' group by login) x group by login  ");
     $num_cash1 = $database->mysqlNumRows($sql_cash1);
        if($num_cash1){
            while($result_cash1 = $database->mysqlFetchArray($sql_cash1)){
                
       array_push($dataPoints2, array("y" =>  $result_cash1['tot'], "label" => $result_cash1['login'] ));
            
       //array("y" =>  $result_cash['tot'], "label" => $result_cash['date'] );
            
        }}else{
            array_push($dataPoints1, array("y" =>  0, "label" => '' ));
        } 
        
        
       ////billcancel///
        
      $dataPoints3 = array();
       $sql_cash11 =  $database->mysqlQuery("select sum(tot) as tot, date ,sum(ct) as ct from(select count(bm_billno) as ct,sum(bm_finaltotal) as tot , bm_dayclosedate as date FROM"
               . " tbl_tablebillmaster where bm_status='Cancelled' and bm_dayclosedate='".$_SESSION['date']."' and bm_complimentary!='Y' group by date union all select count(tab_billno) as ct,sum(tab_netamt) as tot, tab_dayclosedate as date FROM"
               . " tbl_takeaway_billmaster where tab_status='Cancelled' and tab_dayclosedate='".$_SESSION['date']."' and tab_complimentary!='Y' group by date) x group by date ");
     $num_cash11 = $database->mysqlNumRows($sql_cash11);
        if($num_cash11){
            while($result_cash11 = $database->mysqlFetchArray($sql_cash11)){
                
       array_push($dataPoints3, array("y" =>  $result_cash11['ct'], "label" => $result_cash11['date'].' - Bill Nos['.$result_cash11['tot'].']'  ));
            
       //array("y" =>  $result_cash['tot'], "label" => $result_cash['date'] );
            
        }}else{
             array_push($dataPoints3, array("y" =>  0, "label" => 0));
        }  
        
        
       /////itemcancel///
        
       $sql_cash12 =  $database->mysqlQuery("SELECT SUM(cancelled_items) AS cancelled_items, date  FROM (
                                                    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items,oc.ch_dayclosedate as date FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NULL union all
                                                    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items,oc.ch_dayclosedate as date FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NOT NULL union all
                                                    SELECT  sum(tc.tc_cancel_qty) as cancelled_items , tc.tc_dayclosedate as date  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NULL union all
                                                    SELECT  sum(tc.tc_combo_pack_cancelled_qty) as cancelled_items,tc.tc_dayclosedate as date  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NOT NULL )x  ");
        $num_cash12 = $database->mysqlNumRows($sql_cash12);
        if($num_cash12){
            while($result_cash12 = $database->mysqlFetchArray($sql_cash12)){
                
       array_push($dataPoints3, array("y" =>  $result_cash12['cancelled_items'], "label" => $result_cash12['date'].' Item Qty' ));
            
       //array("y" =>  $result_cash['tot'], "label" => $result_cash['date'] );
            
        }}else{
             array_push($dataPoints3, array("y" =>  0, "label" => 0));
        } 
     
        
        
   /////modulewise sale///     
         $dataPoints4 = array();
         $sql_module_wise_sales =  $database->mysqlQuery("select 'DI' as mode, sum(bm.bm_finaltotal) as final,count(bm.bm_billno) as bills FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_complimentary!='Y' AND bm.bm_paymode IS NOT NULL union all
                                                        select  tbm.tab_mode as mode, sum(tbm.tab_netamt) as final,count(tbm.tab_billno) as bills FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_complimentary!='Y' AND tbm.tab_paymode IS NOT NULL group by tbm.tab_mode");


        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
        if($num_module_wise_sales){
            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
                
                array_push($dataPoints4, array("label" =>  $result_module_wise_sales['mode'], "y" => $result_module_wise_sales['final']  ));
            }
            }else{
            array_push($dataPoints1, array("label" =>  '', "y" => 0 ));
        }
        
            
            
    ////all expense//
            
             $dataPoints5 = array();  $dataPoints6 = array();  $dataPoints7 = array();
             
             //supplier voucger//
         $sql_module_wise_sales =  $database->mysqlQuery("select sum(sv_paid_amount) as expense1,sv_date FROM tbl_supplier_voucher where sv_date !=''  group by sv_date desc limit 5 ");

        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
        if($num_module_wise_sales){
            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
                
                array_push($dataPoints5, array("label" =>  $result_module_wise_sales['sv_date'], "y" => $result_module_wise_sales['expense1']  ));
            }
            }else{
             array_push($dataPoints5, array("label" =>  0, "y" => 0));
             } 
            
        
       ///expense voucher//
             
             
              $sql_module_wise_sales =  $database->mysqlQuery("select sum(ev_amount) as expense ,ev_date FROM tbl_expense_voucher where ev_date!=''  group by ev_date desc limit 5  ");

        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
        if($num_module_wise_sales){
            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
                
                array_push($dataPoints6, array("label" =>  $result_module_wise_sales['ev_date'], "y" => $result_module_wise_sales['expense']  ));
            }
            }else{
             array_push($dataPoints6, array("label" =>  0, "y" => 0));
             } 
             
           
             ///employee voucher//
             
             
              $sql_module_wise_sales =  $database->mysqlQuery("select sum(ev_amount) as expense2,ev_date FROM tbl_employee_voucher where ev_date!=''  group by ev_date desc limit 5  ");

        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
        if($num_module_wise_sales){
            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
                
                array_push($dataPoints7, array("label" =>  $result_module_wise_sales['ev_date'], "y" => $result_module_wise_sales['expense2']  ));
            }
            }else{
             array_push($dataPoints7, array("label" =>  0, "y" => 0));
             } 
?>

<html>
<head>
      <link rel="shortcut icon" href="img/favicon.ico">
    <title>GRAPH</title>
<script>
window.onload = function() {
 
 ///payment ///
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Payment Report"
	},
	subtitles: [{
		text: "Today"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();



///last 5 days ///

var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Last 5 Days Sales"
	},
	axisY: {
		title: ""
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## ",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();


////staff performance///

var chart = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	title: {
		text: "Staff Settlement Performance"
	},
	data: [{
		type: "pyramid",
		indexLabel: "{label} - {y}",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();



//////item cancel bill cancel//


var chart = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title:{
		text: "Cancellations Today"
	},
	axisY: {
		title: "Items - Bills",
		includeZero: true,
		prefix: "",
		suffix:  ""
	},
	data: [{
		type: "bar",
		yValueFormatString: "#,##0",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

 
 ///module wise//
 var chart = new CanvasJS.Chart("chartContainer4", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Modulewise Sale"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
 
 
////expense account//




var chart = new CanvasJS.Chart("chartContainer5", {                            
	title: {
		text: "Expense Last 5 days"
	},
	axisY:{
		suffix: ""
	},
	toolTip: {
		shared: true,
		reversed: true
	},
	legend:{
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [
		{
			type: "stackedArea100",
			name: "Supplier Voucher",
			showInLegend: true,
			yValueFormatString: "#0.0#\"\"",
			dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
		},
		{
			type: "stackedArea100",
			name: "Expense Voucher",
			showInLegend: true,
			yValueFormatString: "#0.0#\"\"",
			dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
		},
		{
			type: "stackedArea100",
			name: "Employee Voucher",
			showInLegend: true,
			yValueFormatString: "#0.0#\"\"",
			dataPoints: <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>
		}
	]
});
 
chart.render();
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="lib/rickshaw/rickshaw.min.css" rel="stylesheet">  
    <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/anlytic.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <title> Analytics Report</title>

</head>
<body>
    
    
    
    <?php include "includes/topbar.php"; ?>
    
    <a style="position: absolute;    top: 8px;right: 227px;font-weight: 500;letter-spacing: 0.5px;color: white;background-color: #820000;border: none;border-radius: 3px;padding: 5px;margin-left: -1px;border-bottom: solid 2px #fff;" href="index.php">Back</a>

    
    
    <div style="display: grid;grid-template-columns: 1fr 1fr 1fr;gap: 15px; margin-left:15px;">
<div id="chartContainer" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;"></div>

<div id="chartContainer1" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;"></div>

<div id="chartContainer2" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;"></div>


<div id="chartContainer3" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;margin-top: 30px"></div>

<div id="chartContainer5" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;margin-top: 30px"></div>


<div id="chartContainer4" style="height:250px; width:425px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;background-color:#fff; border-radius:10px;margin-top: 30px"></div>
</div>
<script src="js/chart_new.js"></script>
</body>
</html>     