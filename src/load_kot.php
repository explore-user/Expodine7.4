<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
//echo $_SESSION['mykot'];
error_reporting(0);
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
 unset($_SESSION['ajaxtablesel']);
	  unset($_SESSION['ajaxprefsel']);
if(isset($_REQUEST['orderby']))
{//pending dine area est
	if($_REQUEST['orderby']=="new")
	{
		
		$_SESSION['orderby']="NEW";
		$_SESSION['orderbyvalue']="new";

	}
	else if($_REQUEST['orderby']=="kot")
	{
		
		$_SESSION['orderby']="KOT";
		$_SESSION['orderbyvalue']="kot";

	}else if($_REQUEST['orderby']=="pending")
	{
		
		$_SESSION['orderby']="PENDING DISH";
		$_SESSION['orderbyvalue']="pending";

	}else if($_REQUEST['orderby']=="dine")
	{
		$_SESSION['orderby']="DINE IN";
		$_SESSION['orderbyvalue']="dine";

	}else if($_REQUEST['orderby']=="area")
	{
		
		$_SESSION['orderby']="AREA";
		$_SESSION['orderbyvalue']="area";

	}else if($_REQUEST['orderby']=="est")
	{
		
		$_SESSION['orderby']="ESTIMATE TIME";
		$_SESSION['orderbyvalue']="est";

	}
}else
{
	$orderby="";
	
}
if(!isset($_SESSION['orderbyvalue']))
{
	$_SESSION['orderby']="KOT";
		$_SESSION['orderbyvalue']="kot";

}


?>
         <!--left_sorting_cc-->
   
<script src="js/jquery.backTop.min.js"></script>
        <script>
            $(document).ready( function() {
                $('#backTop').backTop({
                    'position' : 1600,
                    'speed' : 500,
                    'color' : 'red',
                });
            });
        </script>   
         
         <!--left_sorting_cc-->
     <?php    
         // `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`)
		 ////pending dine area est
		 $array_kot= array();
		 $array_ord= array();
		 // echo "select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Served')  and ter_status<>'Closed' order by ter_entrytime DESC";
		 $curdt=date("Y-m-d");
		  if($_SESSION['orderbyvalue']=="new")
		 {
		 		$sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC");//or ter_status='Served' 
				$num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){$l=1;$myarr=array();$s=1;
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
									$sql_dinin  =  $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='".$array_ord[$number]."' "); 
									$num_dinin  = $database->mysqlNumRows($sql_dinin);
									$time_dine=0;$noofpsns=0;
									if($num_dinin) 
									{
									while($result_dinin  = $database->mysqlFetchArray($sql_dinin)) 
										  {
											  $time_dine=$result_dinin['ts_dineintime'];
											  $date=date($time_dine);
												$time_dinevalue= date("h:i:s", strtotime($date));
											  
										  }
									}
									$sql_est  =  $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='".$value."' and ter_dayclosedate='".$_SESSION['date']."' "); 
									$num_est  = $database->mysqlNumRows($sql_est);
									if($num_est)
										{
						 				 while($result_est  = $database->mysqlFetchArray($sql_est)) 
							  				{
												$esttime=$result_est['esttime'];
							  				}
							  			}
										 $sql_entry  =  $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='".$value."' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_entry  = $database->mysqlNumRows($sql_entry);
									if($num_entry)
										{
						 				 while($result_entry  = $database->mysqlFetchArray($sql_entry)) 
							  				{
												 $entry=$result_entry['tm'];
							  				}
							  			}else
										{
											$entry="";
										}
										/*  to calculate new    */
										$m=0;
										$ss=$_SESSION['date']." ".$entry;//date("Y-m-d")
										$date2 = strtotime($ss);
										$date1 = time();
										$subTime = $date1 - $date2;
										$m = ($subTime/60)%60;
										$date=$_SESSION['date']." ".date("H:i:s");//date("Y-m-d H:i:s");										
										$currentDate = strtotime($date);
										$ss=$_SESSION['date']." ".$entry;//"2015-04-29 2:00:15"; date("Y-m-d")
								   if($entry!="")
									 {//echo $ss;
										 $ss=date("Y-m-d H:i:s",strtotime($ss));
										   $date2 = strtotime($ss);
								  
										   $dt=$currentDate - $date2;
										   $s=strtotime($dt);
										  $dt=($dt/60)%60;
										  $k=$esttime -  $dt;
										  if($k<0)
										  {
											  $k=0;
										  }
									 }else
										{
											$k=0;
										}
								    $myarr[]=$k;
									if(in_array($k,$myarr))
									{
										$v=$k.$s++;
										if(in_array($v,$myarr))
										{
											$s++;
										}else
										{
											$myarr[]=$v;
										$array_kot[$v] = $result_order_tab['ter_kotno'];
										$array_ord[$v] = $result_order_tab['ter_orderno'];
										}
									}else
									{
								    $array_kot[$k] = $result_order_tab['ter_kotno'];
									$array_ord[$k] = $result_order_tab['ter_orderno'];
									}
								$l++; 
							  }
					}
					ksort($array_kot);
					ksort($array_ord);
					
		 }else if($_SESSION['orderbyvalue']=="kot")
		 {
		 		$sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC"); //or ter_status='Served'
				$num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
								    $array_kot[] = $result_order_tab['ter_kotno'];
									$array_ord[] = $result_order_tab['ter_orderno'];
								
							  }
					}
					ksort($array_kot);
					ksort($array_ord);
					
		 }else if($_SESSION['orderbyvalue']=="pending")
		 {
			// echo "select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Served')  and ter_status<>'Closed' order by ter_entrytime DESC";
				 $sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC");  // or ter_status='Served'
				 
				 $num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){$l=1;$myarr=array();$k=1;
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
								   
								 	$sql_dish_count  =  $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='".$result_order_tab['ter_kotno']."' and (ter_status='Opened' or ter_status='Served' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_dish_count  = $database->mysqlNumRows($sql_dish_count);
															
									$sql_pedng_count  =  $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='".$result_order_tab['ter_kotno']."' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_pedng_count  = $database->mysqlNumRows($sql_pedng_count);
									
									//$pend=$num_dish_count - $num_pedng_count;
									$myarr[]=$num_pedng_count;
									if(in_array($num_pedng_count,$myarr))
									{
										$v=$num_pedng_count.$k++;
										if(in_array($v,$myarr))
										{
											$k++;
										}else
										{
											$myarr[]=$v;
										$array_kot[$v] = $result_order_tab['ter_kotno'];
										$array_ord[$v] = $result_order_tab['ter_orderno'];
										}
									}else
									{
								    $array_kot[$num_pedng_count] = $result_order_tab['ter_kotno'];
									$array_ord[$num_pedng_count] = $result_order_tab['ter_orderno'];
									}
									
								
								$l++; 	
								
							  }
					}
					
					ksort($array_kot);
					ksort($array_ord);
					//print_r($array_kot);
				 
		 }else if($_SESSION['orderbyvalue']=="dine")
		 {
				 $sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC");  // or ter_status='Served'
				  $num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){$l=1;$myarr=array();$k=1;
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
								 $sql_dinin  =  $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='".$result_order_tab['ter_orderno']."' "); 
								 $num_dinin  = $database->mysqlNumRows($sql_dinin);
								  $time_dine=0;$noofpsns=0;
								  if($num_dinin) 
								  {
								  while($result_dinin  = $database->mysqlFetchArray($sql_dinin)) 
										{
											$time_dine=$result_dinin['ts_dineintime'];
											$date=date($time_dine);
											 $time_dinevalue= date("h:i:s", strtotime($date));
											 $d= strtotime($date);
											   $array_kot[$d] = $result_order_tab['ter_kotno'];
												$array_ord[$d] = $result_order_tab['ter_orderno'];
											
										}
								  }
							  }
					}
					//print_r($array_kot);
					ksort($array_kot);
					ksort($array_ord);
					//print_r($array_kot);
				 
		 }else if($_SESSION['orderbyvalue']=="area")
		 {
			 	$sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC");  //or ter_status='Served'
				
				 $num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){$l=1;$myarr1=array();$k=1;$srr=array();
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
				
				$sql_tablnames  =  $database->mysqlQuery("select tm.tr_tableno as ord,fm.fr_floorname as fmname  from tbl_tabledetails as td LEFT JOIN tbl_tablemaster as tm on tm.tr_tableid=td.ts_tableid LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=tm.tr_floorid where td.ts_orderno='".$result_order_tab['ter_orderno']."' "); 
				
									$num_tablnames  = $database->mysqlNumRows($sql_tablnames);
									if($num_tablnames){
									while($result_tablnames  = $database->mysqlFetchArray($sql_tablnames)) 
										{
											
											
											/*$floorname=$result_tablnames['fmname'];
											$array_kot[$floorname] = $result_order_tab['ter_kotno'];
												$array_ord[$floorname] = $result_order_tab['ter_orderno'];*/
												if(!in_array($result_order_tab['ter_kotno'],$srr))
												{
													$srr[]=$result_order_tab['ter_kotno'];
													$floorname=$result_tablnames['fmname'];
													$myarr1[]=$floorname;
													if(in_array($floorname,$myarr1))
													{
														$v=$floorname.$k++;
														if(in_array($v,$myarr1))
														{
															$k++;
														}else
														{
															$myarr1[]=$v;
														$array_kot[$v] = $result_order_tab['ter_kotno'];
														$array_ord[$v] = $result_order_tab['ter_orderno'];
														}
													}else
													{
													$array_kot[$floorname] = $result_order_tab['ter_kotno'];
													$array_ord[$floorname] = $result_order_tab['ter_orderno'];
													}
												}
												
												
											
										
							  }
					}
							  }
					}
				ksort($array_kot);
					ksort($array_ord);
					//print_r($myarr1);
				
		 }else if($_SESSION['orderbyvalue']=="est")
		 {
				 $sql_order_tab  =  $database->mysqlQuery("select distinct(ter_kotno),ter_orderno from tbl_tableorder where (ter_status='Opened' or ter_status='Ready')  and ter_status<>'Closed' and ter_dayclosedate='".$_SESSION['date']."' order by ter_entrytime DESC"); //or ter_status='Served'
				 $num_tab  = $database->mysqlNumRows($sql_order_tab);
					if($num_tab){$l=1;
						  while($result_order_tab  = $database->mysqlFetchArray($sql_order_tab)) 
							  {
								   
				 					$sql_est  =  $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='".$result_order_tab['ter_kotno']."' "); 
									$num_est  = $database->mysqlNumRows($sql_est);
									if($num_est)
										{
						 				 while($result_est  = $database->mysqlFetchArray($sql_est)) 
							  				{
												$esttime=$result_est['esttime'];
							  				}
							  			}
										 $sql_entry  =  $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='".$result_order_tab['ter_kotno']."' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_entry  = $database->mysqlNumRows($sql_entry);
									if($num_entry)
										{
						 				 while($result_entry  = $database->mysqlFetchArray($sql_entry)) 
							  				{
												 $entry=$result_entry['tm'];
							  				}
							  			}
										/*  to calculate new    */
										$m=0;
									 $ss=$_SESSION['date']." ".$entry;//date("Y-m-d")
									 if($entry!="")
									 {//echo $ss;
										 $ss=date("Y-m-d H:i:s",strtotime($ss));	
									 }
									$date2 = strtotime($ss);
									$date1 = time();
									 $subTime = $date1 - $date2;
								 	 $m = ($subTime/60)%60;
								  $date=$_SESSION['date']." ".date("H:i:s");//date("Y-m-d H:i:s");										
								  $currentDate = strtotime($date);
								  
								  $ss=$_SESSION['date']." ".$entry;//"2015-04-29 2:00:15";date("Y-m-d")
								  $date2 = strtotime($ss);
								  
								  $dt=$currentDate - $date2;
								  $s=strtotime($dt);
								  $dt=($dt/60)%60;
								  $k=$esttime -  $dt;
								  if($k<0)
								  {
									  $k=0;
								  }
								  $array_kot[$k."".$l] = $result_order_tab['ter_kotno'];
								  $array_ord[$k."".$l] = $result_order_tab['ter_orderno'];
								 $l++; 
							  }
			}
			ksort($array_kot);
			ksort($array_ord);	 
			//	print_r($array_kot);	  
				 
		 }
		 $f=0;
		  $count= count($array_kot);
		 ?>
         <script>
		$(document).ready(function() {
			$('#totalkotct').text(<?=$count?>);
			 });
        </script>  
         <?php
		 foreach( $array_kot as $number => $value){
								 $sql_tablnames  =  $database->mysqlQuery("select tm.tr_tableno as ord,fm.fr_floorname as fmname,fm.fr_floorid,td.ts_tableid  from tbl_tabledetails as td LEFT JOIN tbl_tablemaster as tm on tm.tr_tableid=td.ts_tableid LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=tm.tr_floorid where td.ts_orderno='".$array_ord[$number]."' "); 
									$num_tablnames  = $database->mysqlNumRows($sql_tablnames);
									if($num_tablnames){$h=0;
									while($result_tablnames  = $database->mysqlFetchArray($sql_tablnames)) 
										{
											$prf=$database->show_tabledetails_total($array_ord[$number],$result_tablnames['ts_tableid']);
                                                                                        $floorname=$result_tablnames['fmname'];
                                                        
                                                                                        if($_SESSION['main_language']!='english'){

                                                                                        $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_tablnames['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");

                                                                                        //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                                                        $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                                                         if($num_arabfloor){
                                                                                            while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                                                        $floor_name=$result_arabfloor['f_floor_name'];

                                                                                        }}}
//                                                                                        $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                                                                        $response_table['messages'] = stream_get_contents($fptable);
//                                                                                        //var_dump($response_table['messages']);
//                                                                                        $resu_table= json_decode($response_table['messages'],true);
//                                                                                        //var_dump($resu_table['table_id'][0]);
//                                                                                        $table_count=count($resu_table['table_id']);
//                                                                                        // echo $table_count;
//                                                                                        for($t=0;$t<$table_count;$t++){
//                                                                                        if($result_tablnames['ts_tableid']==$resu_table['table_id'][$t])
//                                                                                            {
//                                                                                                $table_name=$resu_table['table_name'][$t];
//                                                                                            }
//                                                                                        }
                                                                                         $table_name=$result_tablnames['ord'];
                                                                                        if($h==0)
											{
												$tablename=$table_name." (".$prf['ts_tableidprefix'].")";//$result_tablnames['ord']
											}else
											{
												$tablename=$tablename.",".$table_name." (".$prf['ts_tableidprefix'].")";
											}
											//$floorname=$_SESSION[$result_tablnames['fr_floorid']]['floormaster'];//$result_tablnames['fmname'];
//                                                                                        $floorname="";
//                                                                                        $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                                                                        //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//                                                                                        $response_floor['messages'] = stream_get_contents($fpfloor);
//                                                                                        //echo  $response['messages'];
//                                                                                        $resu_floor= json_decode($response_floor['messages'],true);
//                                                                                        //var_dump($resu_floor);
//                                                                                        $floor_count=count($resu_floor);
//                                                                                        for($f=0;$f<$floor_count;$f++)
//                                                                                        {
//                                                                                            if($result_tablnames['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                                                            $floorname=$resu_floor['floor_name'][$f];
//                                                                                            }  
//                                                                                        }
                                                                                        
											$h++;
										}
									}
								  $sql_dish_count  =  $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='".$value."' and (ter_status='Opened' or ter_status='Served' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_dish_count  = $database->mysqlNumRows($sql_dish_count);
									
									$sql_pedng_count  =  $database->mysqlQuery("select * from tbl_tableorder where ter_kotno='".$value."' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_pedng_count  = $database->mysqlNumRows($sql_pedng_count);
									$pend=$num_dish_count - $num_pedng_count;
									$sql_dinin  =  $database->mysqlQuery("select * from tbl_tabledetails where ts_orderno='".$array_ord[$number]."' "); 
									$num_dinin  = $database->mysqlNumRows($sql_dinin);
									$time_dine=0;$noofpsns=0;
									if($num_dinin) 
									{
									while($result_dinin  = $database->mysqlFetchArray($sql_dinin)) 
										  {
											  $time_dine=$result_dinin['ts_dineintime'];
											  $date=date($time_dine);
												$time_dinevalue= date("h:i:s", strtotime($date));
											  
										  }
									}
									$sql_est  =  $database->mysqlQuery("select max(ter_esttime) as esttime from tbl_tableorder where ter_kotno='".$value."' and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_est  = $database->mysqlNumRows($sql_est);
									if($num_est)
										{
						 				 while($result_est  = $database->mysqlFetchArray($sql_est)) 
							  				{
												$esttime=$result_est['esttime'];
							  				}
							  			}
										 $sql_entry  =  $database->mysqlQuery("select max(ter_entrytime) as tm from tbl_tableorder where ter_kotno='".$value."' and (ter_status='Opened' or ter_status='Ready') and ter_dayclosedate='".$_SESSION['date']."'"); 
									$num_entry  = $database->mysqlNumRows($sql_entry);
									if($num_entry)
										{
						 				 while($result_entry  = $database->mysqlFetchArray($sql_entry)) 
							  				{
												 $entry=$result_entry['tm'];
							  				}
							  			}else
										{
											$entry="";
										}
										/*  to calculate new    */
										$m=0;
									$ss=$_SESSION['date']." ".$entry;//date("Y-m-d")
									$date2 = strtotime($ss);
									$date1 = time();
									  $subTime = $date1 - $date2;
								 	 $m = ($subTime/60)%60;
								  $date=$_SESSION['date']." ".date("H:i:s");//date("Y-m-d H:i:s");										
								  $currentDate = strtotime($date);
								  $ss=$_SESSION['date']." ".$entry;//"2015-04-29 2:00:15";date("Y-m-d")
								   if($entry!="")
									 {//echo $ss;
										 $ss=date("Y-m-d H:i:s",strtotime($ss));
										   $date2 = strtotime($ss);
								  
										   $dt=$currentDate - $date2;
										   $s=strtotime($dt);
										  $dt=($dt/60)%60;
										  $k=$esttime -  $dt;
										  if($k<0)
										  {
											  $k=0;
										  }
								 	
									 }else
										{
											$k=0;
										}
		 ?>
        <span  id="<?=$k?>"> 
    	 <a href="#"  class="each_order_sel " myorder="ord_<?=$array_ord[$number]?>" mykot="kt_<?=$value?>"> 
         <div class="kot_list_item <?php if($_SESSION['mykot']==$value){ ?> order_active <?php } ?> myid<?=$array_ord[$number]?> <?php if(($k==0 || $k<0) && $num_pedng_count>=1){ ?> odr_2nd_active <?php } ?>  <?php if($k!=0 && $k<=5){ ?>blink_me <?php } ?>">
          <?php if($subTime<=500 ) { ?>
           <div class="kot_new_notification"><?=$_SESSION['kot_new']?></div>
           <?php } ?>
       		 <div class="kot_list_order_head"> <?=$_SESSION['kot_kot_no']?> - <?=$value?></div>
        	<div class="kot_list_item_head">
            <span id="setfloor_<?=$array_ord[$number]?>"><?=$floorname?></span>
            <!--Table- --><span id="settable_<?=$array_ord[$number]?>"><?=$tablename?></span></div>
            <span class="table_detail_kot">
                  <span><?=$_SESSION['menu_order_selected_dinein']?> - <?=$time_dinevalue?></span>
                  <span><?=$_SESSION['kot_est_timeleft']?> - <p id="timese<?=$f?>" style="display:block !important"><?=$k?></p></span>
             </span><!--table_detail_kot-->
             <div class="total_cont_cc_kot">
                 <span><?=$_SESSION['kot_total_count']?> -   <?=$num_dish_count?></span>
                 <span><?=$_SESSION['kot_pending_dish']?> -  <?=$num_pedng_count?></span>
             </div><!--total_cont_cc_kot-->
        </div><!--kot_list_item-->
        </a>
        </span>
         <?php $f++;}// } ?>
        <a id="backTop"><?=$_SESSION['kot_backtop']?></a> 
<script src="js/load_kot_chk.js"></script>
    
