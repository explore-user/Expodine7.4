<?php

	
if($_REQUEST['checkvalue']=='fielddefine'){ 
	/**********************************************************field define starts*****************************************************/
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
error_reporting(0);
$localhost=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);

require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

	$excel = new PhpExcelReader;
	$excel->setOutputEncoding('UTF-8');
	$excel->read('report/report_master.xls');
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	
	
	$floorvaluereturn=$database->floorvaluereturn();
	$bydatevaluereturn=$database->bydatevaluereturn();
	$stewardvaluereturn=$database->stewardvaluereturn();

	for($i=0; $i<$nr_sheets; $i++) {
		if($excel->boundsheets[$i]['name']==$_REQUEST['reportid'])
		{
	 		$sheet=$excel->sheets[$i];
			$fieldnumbr=0;
			$x = 1;
			while($x <= $sheet['numRows']) {
			  $y = 1;
			  while($y <= $sheet['numCols']) {
				  
				  if($x==3 && $y==2)
				  $fieldnumbr = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
				  
				  $_SESSION['fieldsnumber']=$fieldnumbr;
				
					if($x>=4 && $y==1)
					{
						
					}
				$y++;
			  }  
			  $x++;
			}
			
			$x=5;
			while($x <= $sheet['numRows']) {
			for($fl=1;$fl<=$fieldnumbr;$fl++)
						{
						?>
                         
                         <?php if(isset($sheet['cells'][$x][1])){ 
						 		if(($sheet['cells'][$x][1])=="Field ".$fl." : Name"){?>
                                <div class="search_name_box_main">
                            <div class="text-selection_name"><?=isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : ''?>:</div>
                            <?php $x++;} ?>
                            <?php if(isset($sheet['cells'][$x][2])){
								if(($sheet['cells'][$x][1])=="Field ".$fl." : Input Type"){ 
						 		if(($sheet['cells'][$x][2])=="DropDown"){$x++; ?>
                             <div class="input-group">
                             <?php if(($sheet['cells'][$x][1])=="Field ".$fl." : Id"){$fieldid=$sheet['cells'][$x][2];$x++;  ?>
                                 <select  class="form-control " id="<?=$fieldid ?>">
                                 <?php if(($sheet['cells'][$x][1])=="Field ".$fl." : Data Type"){ ?>
                                      <option value="">Select</option>
                                      <?php if(($sheet['cells'][$x][2])=="Query"){$x++; ?>
                                      <?php 
					  					$menusub=${$sheet['cells'][$x][2]};$x++;
										$num_menuss  = $database->mysqlNumRows($menusub);
										if($num_menuss){	
										while($result_menuss  = $database->mysqlFetchArray($menusub)) 
												{	
										?>
                                      <option  value="<?=$result_menuss['id']?>"><?=$result_menuss['value']?></option>
								<?php } }?>
                                      <?php }else if(($sheet['cells'][$x][2])=="Static"){$x++; ?>
                                      <?php 
										$staticfun=$sheet['cells'][$x][2];
					  					$menusub=$database->$staticfun();$x++;
										$num_menuss  = count($menusub);
										foreach( $menusub as $id => $value){ 	
										?>
                                      <option  value="<?=$id?>"><?=$value?></option>
								<?php } ?>
                                      <?php }  } ?>
                                    </select>
                                    <script>
									   $(document).ready(function() {
										
										   $("#<?=$fieldid?>").change(function (){
											var vars = [];
											var IDs = [];
											$(".form-control").each(function(){ 
											var newid=this.id;
												IDs.push(this.id); 
												vars.push($('#'+this.id).val()); 
												
												if (newid.search("bydate_") >= 0)
												{
													var splited=newid.split("bydate_");
													$("#from_"+splited[1]).val('');
													$("#to_"+splited[1]).val('');
												}
											});
											var dataString;
											dataString="checkvalue=loadreportdata&type=html&ids="+IDs+"&values="+vars;
											var request=  $.ajax({
											  type: "POST",
											  url: "load_reportall.php",
											  data: dataString,
											  success: function(data) {
													  $('#reportload').html(data);
													  
												  }
											  });
											   data = null;
										   dataString = null;
										  request.onreadystatechange = null;
										  request.abort = null;
										  request = null;
										   return false;
											
										    });
										});
										  </script>
                                    <?php } ?>
                            </div>
                             </div>
                             <?php }else if(($sheet['cells'][$x][2])=="TextBox") {$x++; ?>
								<div class="input-group">
                                <?php if(($sheet['cells'][$x][1])=="Field ".$fl." : Id"){$fieldid=$sheet['cells'][$x][2];$x++; ?>
                                 <?php if(($sheet['cells'][$x][1])=="Field ".$fl." : Data Type"){ ?>
                                 <?php if(($sheet['cells'][$x][2])=="Date"){$x++; ?>
                                     <input type="text" class="form-control" id="<?=$fieldid ?>" >
                                      <script>
									   $(document).ready(function() {
										$("#<?=$fieldid?>").datepicker({
											changeMonth: true,
											changeYear: true,
											maxDate: "+0D "
										  });
										  $("#<?=$fieldid?>").change(function (){
											var vars = [];
											var IDs = [];
											$(".form-control").each(function(){ 
												IDs.push(this.id); 
												vars.push($('#'+this.id).val()); 
											});
											
											var dataString;
											dataString="checkvalue=loadreportdata&type=html&ids="+IDs+"&values="+vars;
											var request=  $.ajax({
											  type: "POST",
											  url: "load_reportall.php",
											  data: dataString,
											  success: function(data) {//alert(data);
													  $('#reportload').html(data);
													  
												  }
											  });
											   data = null;
										   dataString = null;
										  request.onreadystatechange = null;
										  request.abort = null;
										  request = null;
										   return false;
											
											
										    });
										});
										  </script>
                                     <?php } ?>
                                     <?php } ?>
                                <?php } ?>     
                                </div> 
								  </div>
							<?php  
							}}}} ?>
                        
                        <?php 
						
						} $x++;
			}
	 
	  
		}
	}
	

	/**********************************************************field define ends*****************************************************/

}else if($_REQUEST['checkvalue']=='loadreportdata'){ 
session_start();
error_reporting(0);
$localhost=mysqli_connect($_SESSION['host'], $_SESSION['user'], $_SESSION['pas'],$_SESSION['db']);
$template='';
$templateDir='D:\wamp\www\expodine\template\\';

require_once 'PHPReport.php';
require_once 'Classes/PHPExcel.php';
/*require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

	$excel = new PhpExcelReader;
	$excel->setOutputEncoding('UTF-8');
	$excel->read('template/summary.xls');
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
*/
	$myprocedureresult='';
	$reportname=array();
	 $tableheads=array();
	$controlnames=explode(",",$_REQUEST['ids']);
	$controlvalues=explode(",",$_REQUEST['values']);
	$reportname=$controlvalues[0];
	$reportproc='';
	$connectionfields='N';
	$fieldcount=0;
	$reportheaddate=array();
	
	//try{
		if($reportname=='tot_sales')
		{		
		$name='Dollar';
		$age='1';
		mysqli_query($localhost,"SET @name = " . "'".$name."'");
		mysqli_query($localhost,"SET @age = " . "'".$age."'");
		$message="";
		//$tt=$database->mysqlQuery("CALL test_report(@name,@age1,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$myprocedureresult=mysqli_multi_query($localhost,"CALL test_report(@name,@age,@message)");
		}else  if($reportname=='discount_report')
		{
		$name='Dollar';
		$age='1';
		mysqli_query($localhost,"SET @name = " . "'".$name."'");
		mysqli_query($localhost,"SET @age = " . "'".$age."'");
		$message="";
		//$tt=$database->mysqlQuery("CALL test_report(@name,@age1,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$myprocedureresult=mysqli_multi_query($localhost,"CALL test_report(@name,@age,@message)");
		}else if($reportname=='total_summary_details')
		{		
				$template='summary.xls';
				$fieldcount=11;
				$fromdate='';
				$todate='';
				if($controlvalues[1]=='')
				{
					$fromdate=$_SESSION['date'];	
				}else{
					$fromdate=$controlvalues[1];
				}
				if($controlvalues[2]=='')
				{
					$todate=$_SESSION['date'];	
				}else{
					$todate=$controlvalues[2];
				}
				$bydate=$controlvalues[3];
				
				if($bydate!='')
				{	$vl='';
					$sql_bydt=mysqli_query($localhost,"SELECT `rbd_typename` FROM `tbl_report_bydate` WHERE `rbd_id`='".$bydate."'");
					$num_bydt  = mysqli_num_rows($sql_bydt);
					if($num_bydt)
					{
						while($row_bydt=mysqli_fetch_array($sql_bydt))
						{
							$vl=$row_bydt['rbd_typename'];
						}
					}
					$reportheaddate=array(
							array('types'=>$vl)
						);
				}else
				{
					  $reportheaddate=array(
						  array('types'=>"From ".$fromdate." To ".$todate)
					  );
				}
				mysqli_query($localhost,"SET @From_date = " . "'".$fromdate."'");
				mysqli_query($localhost,"SET @To_date = " . "'".$todate."'");
				mysqli_query($localhost,"SET @Date_in_string_id = " . "'".$bydate."'");
				$myprocedureresult=mysqli_multi_query($localhost,"CALL proc_report_total_summary_details(@From_date,@To_date,@Date_in_string_id)");
				$reportname=array(
					array('reportname'=>"Total Summary Sales")
				);
				
				 if ($myprocedureresult)
		{$ss=1;$totdt=array();
		  do
			{
			if ($result=mysqli_store_result($localhost)) { 
			   $ct= mysqli_field_count($localhost);
			  $data[]=array();
			  while ($row=mysqli_fetch_row($result))
				{
				for($i=1;$i<=$ct;$i++)
				{	
					if(isset($row[$i]))
					{
					$data[$ss][$row[0]]= $row[$i];
					$totdt[]=$row[0];
					}
				}
				} 
			  // Free result set
			  mysqli_free_result($result);
			  }
			 $ss++;
			}
		  while (mysqli_next_result($localhost));
		}
		$dates=array_keys(array_flip($totdt)); //print_r($totdt);
	    $fieldrows=count($dates);
		

	$totals[0]['cash']='';
	$totals[0]['cards']='';
	$totals[0]['coupons']='';
	$totals[0]['voucher']='';
	$totals[0]['cheque']='';
	$totals[0]['credits']='';
	$totals[0]['comp']='';
	$totals[0]['pax']='';
	$totals[0]['total']='';	
 	for($rows=0;$rows<=$fieldrows;$rows++) {
	if(isset($dates[$rows])){ 
   		 $tot=0;
		for($cols=0;$cols<$fieldcount-1;$cols++) { 
		if($cols==0)$products[$rows]['saledate']=$dates[$rows];
		if($cols==1){$products[$rows]['cash']=$data[1][$dates[$rows]];		$totals[0]['cash']=$totals[0]['cash'] + $data[1][$dates[$rows]];}
		if($cols==2){$products[$rows]['cards']=$data[2][$dates[$rows]];		$totals[0]['cards']=$totals[0]['cards'] + $data[2][$dates[$rows]];}
		if($cols==3){$products[$rows]['coupons']=$data[3][$dates[$rows]];	$totals[0]['coupons']=$totals[0]['coupons'] + $data[3][$dates[$rows]];}
		if($cols==4){$products[$rows]['voucher']=$data[4][$dates[$rows]];	$totals[0]['voucher']=$totals[0]['voucher'] + $data[4][$dates[$rows]];}
		if($cols==5){$products[$rows]['cheque']=$data[5][$dates[$rows]];		$totals[0]['cheque']=$totals[0]['cheque'] + $data[5][$dates[$rows]];}
		if($cols==6){$products[$rows]['credits']=$data[6][$dates[$rows]];	$totals[0]['credits']=$totals[0]['credits'] + $data[6][$dates[$rows]];}
		if($cols==7){$products[$rows]['comp']=$data[7][$dates[$rows]];		$totals[0]['comp']=$totals[0]['comp'] + $data[7][$dates[$rows]];}
		if($cols==8){$products[$rows]['pax']=$data[8][$dates[$rows]];		$totals[0]['pax']=$totals[0]['pax'] + $data[8][$dates[$rows]];}
		if($cols<=7) {$tot=$tot+$data[$cols-1][$dates[$rows]]; }
		  }
		  $products[$rows]['total']=$tot;							$totals[0]['total']=$totals[0]['total'] + $tot;
		}}
				
		}else if($reportname=='stewards_performance_report')
		{		
				$template='steward_performance.xls';
				$fieldcount=4;
				$fromdate='';
				$todate='';
				$steward=$controlvalues[1];
				if($controlvalues[2]=='')
				{
					$fromdate=$_SESSION['date'];	
				}else{
					$fromdate=$controlvalues[2];
				}
				if($controlvalues[3]=='')
				{
					$todate=$_SESSION['date'];	
				}else{
					$todate=$controlvalues[3];
				}
				$bydate=$controlvalues[4];
				
				if($bydate!='')
				{	$vl='';
					$sql_bydt=mysqli_query($localhost,"SELECT `rbd_typename` FROM `tbl_report_bydate` WHERE `rbd_id`='".$bydate."'");
					$num_bydt  = mysqli_num_rows($sql_bydt);
					if($num_bydt)
					{
						while($row_bydt=mysqli_fetch_array($sql_bydt))
						{
							$vl=$row_bydt['rbd_typename'];
						}
					}
					$reportheaddate=array(
							array('types'=>$vl)
						);
				}else
				{
					  $reportheaddate=array(
						  array('types'=>"From ".$fromdate." To ".$todate)
					  );
				}
				mysqli_query($localhost,"SET @From_date = " . "'".$fromdate."'");
				mysqli_query($localhost,"SET @To_date = " . "'".$todate."'");
				mysqli_query($localhost,"SET @Date_in_string_id = " . "'".$bydate."'");
				mysqli_query($localhost,"SET @Staff_id = " . "'".$steward."'");
				$myprocedureresult=mysqli_multi_query($localhost,"CALL proc_report_steward_performace(@From_date,@To_date,@Date_in_string_id,@Staff_id)");
				$reportname=array(
					array('reportname'=>"Stewards Performance Report")
				);
				
	if ($myprocedureresult)
		{$ss=1;$totdt=array();
		  do
			{
			if ($result=mysqli_store_result($localhost)) { 
			   $ct= mysqli_field_count($localhost);
			  $data[]=array();
			  while ($row=mysqli_fetch_row($result))
				{
				for($i=2;$i<=$ct;$i++)
				{	
					if(isset($row[$i]))
					{
					$data[$ss][$row[0]]= $row[$i]; 
					$totdt[]=$row[0];
					}
				}
				} 
			  // Free result set
			  mysqli_free_result($result);
			  }
			 $ss++;
			}
		  while (mysqli_next_result($localhost));
		}
		$dates=array_keys(array_flip($totdt)); //print_r($totdt);
	    $fieldrows=count($dates);
		
	$totals[0]['billcount']='';
	$totals[0]['amount']='';
	
 	for($rows=0;$rows<=$fieldrows;$rows++) {
	if(isset($dates[$rows])){ 
   		 $tot=0;
		for($cols=0;$cols<$fieldcount-1;$cols++) { 
		if($cols==0)$products[$rows]['saledate']=$dates[$rows];
		if($cols==1){$products[$rows]['billcount']=$data[1][$dates[$rows]];		$totals[0]['billcount']=$totals[0]['billcount'] + $data[1][$dates[$rows]];}
		if($cols==2){$products[$rows]['amount']=$data[2][$dates[$rows]];		$totals[0]['amount']=$totals[0]['amount'] + $data[2][$dates[$rows]];}
		  }
		}}
				
		}else if($reportname=='turnover_report')
		{		
				$template='turnover_report.xls';
				$fieldcount=7;
				$fromdate='';
				$todate='';
				
				if($controlvalues[1]=='')
				{
					$fromdate=$_SESSION['date'];	
				}else{
					$fromdate=$controlvalues[1];
				}
				if($controlvalues[2]=='')
				{
					$todate=$_SESSION['date'];	
				}else{
					$todate=$controlvalues[2];
				}
				$bydate=$controlvalues[3];
				
				if($bydate!='')
				{	$vl='';
					$sql_bydt=mysqli_query($localhost,"SELECT `rbd_typename` FROM `tbl_report_bydate` WHERE `rbd_id`='".$bydate."'");
					$num_bydt  = mysqli_num_rows($sql_bydt);
					if($num_bydt)
					{
						while($row_bydt=mysqli_fetch_array($sql_bydt))
						{
							$vl=$row_bydt['rbd_typename'];
						}
					}
					$reportheaddate=array(
							array('types'=>$vl)
						);
				}else
				{
					  $reportheaddate=array(
						  array('types'=>"From ".$fromdate." To ".$todate)
					  );
				}
				mysqli_query($localhost,"SET @From_date = " . "'".$fromdate."'");
				mysqli_query($localhost,"SET @To_date = " . "'".$todate."'");
				mysqli_query($localhost,"SET @Date_in_string_id = " . "'".$bydate."'");
				$myprocedureresult=mysqli_multi_query($localhost,"CALL proc_report_turnover(@From_date,@To_date,@Date_in_string_id)");
				$reportname=array(
					array('reportname'=>"Turn Over Report")
				);
				
	if ($myprocedureresult)
		{$ss=1;$totdt=array();
		  do
			{
			if ($result=mysqli_store_result($localhost)) { 
			   $ct= mysqli_field_count($localhost);
			  $data[]=array();
			  while ($row=mysqli_fetch_row($result))
				{
				for($i=2;$i<=$ct;$i++)
				{	
					if(isset($row[$i]))
					{
					 $data[$ss][$i-1][$row[1]]= $row[$i]; 
					$totdt[]=$row[1];
					}
				}//print_r($data);die();
				} 
			  // Free result set
			  mysqli_free_result($result);
			  }
			 $ss++;
			}
		  while (mysqli_next_result($localhost));
		}
		$dates=array_keys(array_flip($totdt)); //print_r($totdt);
	    $fieldrows=count($dates);
//{item:#}	{item:saledate}	{item:gross}		{item:sertax}		{item:vat}		{item:pax}	{item:net}		
		
	$totals[0]['gross']='';
	$totals[0]['sertax']='';
	$totals[0]['vat']='';
	$totals[0]['pax']='';
	$totals[0]['net']='';
	
 	for($rows=0;$rows<=$fieldrows;$rows++) {
	if(isset($dates[$rows])){ 
   		 $tot=0;
		for($cols=0;$cols<$fieldcount-1;$cols++) { 
		if($cols==0)$products[$rows]['saledate']=$dates[$rows];
		if($cols==1){
			$products[$rows]['gross']=$data[1][1][$dates[$rows]] + $data[2][1][$dates[$rows]] + $data[3][1][$dates[$rows]];		
			$totals[0]['gross']=$totals[0]['gross'] + $data[1][1][$dates[$rows]] + $data[2][1][$dates[$rows]] + $data[3][1][$dates[$rows]];
			}
		if($cols==3){
			$products[$rows]['sertax']=$data[1][3][$dates[$rows]] + $data[2][3][$dates[$rows]] + $data[3][3][$dates[$rows]];	
			$totals[0]['sertax']=$totals[0]['sertax'] + $data[1][3][$dates[$rows]] + $data[2][3][$dates[$rows]] + $data[3][3][$dates[$rows]];
			}
		if($cols==2){
			$products[$rows]['vat']=$data[1][2][$dates[$rows]] + $data[2][2][$dates[$rows]] + $data[3][2][$dates[$rows]];	
			$totals[0]['vat']=$totals[0]['vat'] + $data[1][2][$dates[$rows]] + $data[2][2][$dates[$rows]] + $data[3][2][$dates[$rows]];
			}
		if($cols==4){
			$products[$rows]['pax']=$data[1][4][$dates[$rows]] + $data[2][4][$dates[$rows]] + $data[3][4][$dates[$rows]];	
			$totals[0]['pax']=$totals[0]['pax'] + $data[1][4][$dates[$rows]] + $data[2][4][$dates[$rows]] + $data[3][4][$dates[$rows]];
			}
		if($cols==5){
			$products[$rows]['net']=$data[1][5][$dates[$rows]] + $data[2][5][$dates[$rows]] + $data[3][5][$dates[$rows]];		
			$totals[0]['net']=$totals[0]['net'] + $data[1][5][$dates[$rows]] + $data[2][5][$dates[$rows]] + $data[3][5][$dates[$rows]];
			}
		  }
		}}
				
		}
		
		$config=array(
		'template'=>$template,
		'templateDir'=>$templateDir
	);

	/*} catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }*/
	 
	 
		  $R=new PHPReport($config);
		  $R->load(array(
		  array(
				'id'=>'rptname',
				'repeat'=>true,
				'data'=>$reportname,
				'minRows'=>1
				),
			array(
				'id'=>'rpts',
				'repeat'=>true,
				'data'=>$reportheaddate,
				'minRows'=>2
				),
			array(
				'id'=>'item',
				'repeat'=>true,
				'data'=>$products,
				'minRows'=>2
				),
			array(
				'id'=>'sum',
				'repeat'=>true,
				'data'=>$totals,
				'minRows'=>2
				)
			)
        );
if(($_REQUEST['type'])=='excel')
{
	echo $R->render('excel');
	exit();
}else if(($_REQUEST['type'])=='html')
{
echo $R->render('html');
}

	?>
	
	
    
    
    
	<?php
	

	
}
