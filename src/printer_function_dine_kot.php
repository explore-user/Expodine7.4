
<?php

  $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
  $sql_gen =  mysqli_query($localhost,"select * from tbl_branchmaster"); 
  $num_gen  = mysqli_num_rows($sql_gen);
  if($num_gen)
  {
  while($result_invoice6  = mysqli_fetch_array($sql_gen)) 
  {
  $timezone=$result_invoice6['be_time_zone'];
  }
  }
 
date_default_timezone_set($timezone); 
 
class PrinterCommonSettingskot
{
	
    function print_kot_new($kot_id,$order_id,$date,$kotprint_tp,$branchofid,$type)
	{
     
		/* ************************************Dine in print KOT starts******************************************************************  */
		require_once("Escpos.php");
                
		if($type=="web")
		{
                    $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
		}else if($type=="android")
		{
                    include("appdbconnection.php");
		}
                
      // log_query///          
    $date_log_in=  date("Y-m-d H:i:s");
    $data_log= 'DI - '.$kot_id;
    $log_data_print=mysqli_query($localhost,"INSERT INTO tbl_printer_function_log(`tpf_log_data`, `tpf_date_time`, `tpf_print_status`) VALUES ('".$data_log."','".$date_log_in."','N')");            
      
                
		$typeof=$type;
		$num_menuss=0;
		$array_kot= array();
		$kot_name= array();
		$printer_kotusbip=array();
		$printer_kotusb=array();
		$printer_kotip=array();
		$printer_kotport=array();
		$print_count=array();
		$print_default=array();
		$print_default_status=array();
		$floorid="";
		$print_nosprint=array();
		$print_kotids=array();
		$print_style=array();
		
		//print_variables
		$kotid='';
		$kottime='';
		$kottable='';
		$kotsteward='';
		$kotname='';
                

		 $sql_flor="Select tbl_tabledetails.ts_floorid FROM tbl_tabledetails Where tbl_tabledetails.ts_orderno ='".$order_id."'";
		$sql_flors  =  mysqli_query($localhost,$sql_flor); 
		 $num_flor  = mysqli_num_rows($sql_flors);
		if($num_flor){	
		while($result_flor  = mysqli_fetch_array($sql_flors)) 
				{
					 $floorid=$result_flor['ts_floorid'];
				}
		}
                
                
                $otherlang='';
		  $sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='".$branchofid."'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang_kot'];
					}
		  }
                
                  
                  if($otherlang=='Y'){
                      require('printlogo/I18N/Arabic.php');
		     $Arabic = new I18N_Arabic('Glyphs');  
                  }
                  
                  
                
                
		$slnoinkot='';
		$rateinkot='';
		$staffinkot='';
		$itemcoutinkot='';
		$floor_in_kotprint='';
		//
		$result = mysqli_query($localhost,"SELECT be_decimal,be_kotstatuschange,be_slnoin_kotprint,be_ratein_kotprint,be_staffin_kotprint ,be_total_itemcountin_kotprint,be_floor_in_kotprint FROM `tbl_branchmaster` WHERE be_branchid = '".$branchofid."'");
			if (mysqli_num_rows($result) > 0) 
			{
				 while ($row = mysqli_fetch_array($result)) {
                                     
                            
                                      $decimal=$row['be_decimal'];
                                       $status = $row["be_kotstatuschange"];
					 $slnoinkot=$row["be_slnoin_kotprint"];
					 $rateinkot=$row["be_ratein_kotprint"];
					 $staffinkot=$row["be_staffin_kotprint"];
					 $itemcoutinkot=$row["be_total_itemcountin_kotprint"];
					$floor_in_kotprint=$row["be_floor_in_kotprint"];
				}
			}
                        
			$floorname='';
			$result = mysqli_query($localhost,"SELECT fr_floorname FROM `tbl_floormaster` WHERE fr_floorid = '".$floorid."'");
			if (mysqli_num_rows($result) > 0) 
			{
				 while ($row = mysqli_fetch_array($result)) {
					$floorname=$row['fr_floorname']; 
				 }
			}
                        
			$linesep='N';
	                $result = mysqli_query($localhost,"SELECT * FROM `tbl_branch_settings_printer` WHERE bp_branchid = '".$branchofid."'");
			if (mysqli_num_rows($result) > 0) 
			{
				 while ($row = mysqli_fetch_array($result)) {
					 $linesep = $row["bp_lineseperation_kotprint"];
					
					
				}
			}
			
                       
                     
		
                          $sql_kots="Select distinct (km.kr_kotname),ps.pr_id,km.kr_kotcode,ps.pr_printerip, ps.pr_printerport,
                            ps.pr_usbprinter, ps.pr_usbprinterip,ps.pr_defaultusb,ps.pr_enable,ps.pr_printcount,ps.pr_style 
                            From tbl_tableorder o 
                            left join tbl_menumaster mm on mm.mr_menuid = o.ter_menuid 
                            left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter 
                            left join tbl_printersettings ps On km.kr_kotcode = ps.pr_kotcode 
                            Where km.kr_branchid ='1' And ps.pr_floorid='".$floorid."' 
                            And mm.mr_show_in_kot_print='Y' and ps.pr_printertype='".$kotprint_tp."' and o.ter_dayclosedate='".$date."' and o.ter_kotno='".$kot_id."'
                            ";
                
                $sql_kotss  =  mysqli_query($localhost,$sql_kots); 
		 $num_kots  = mysqli_num_rows($sql_kotss);
		if($num_kots){	 //$oldip="";
		while($result_kots  = mysqli_fetch_array($sql_kotss)) 
		{
                        if($result_kots['pr_defaultusb']=='N'){
                            $counter_prn=$result_kots['pr_printerip'];
                                if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                                    exec("ping -n 1 -w 1 ".$counter_prn, $output, $result); 
                                } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                                    {
                                        exec("ping -c 1 -w 1 ".$counter_prn, $output, $result);
                                    }
                                } 
                                else{
                                    $result=0;
                                }
                                        if ($result == 0)
                                        {
                    
					$arraycodekot[] = $result_kots['kr_kotcode'];
                                       // if($previp!=$result_kots['pr_printerip']){
                                            //$previp=$result_kots['pr_printerip'];
					$array_kot[] = $result_kots['pr_id'];//kr_kotcode
                                       // }
					$kot_name[$result_kots['pr_id']] = $result_kots['kr_kotname'];
					
					$printer_kotport[$result_kots['pr_id']]=$result_kots['pr_printerport'];
					$printer_kotusb[$result_kots['pr_id']]=$result_kots['pr_usbprinter'];
					$printer_kotusbip[$result_kots['pr_id']]=$result_kots['pr_usbprinterip'];
					$print_default[$result_kots['pr_id']]=$result_kots['pr_defaultusb'];
					$print_default_status[$result_kots['pr_id']]=$result_kots['pr_enable'];
					$print_nosprint[$result_kots['pr_id']]=$result_kots['pr_printcount'];
					$print_style[$result_kots['pr_id']]=$result_kots['pr_style'];
                                      
					$printer_kotip[$result_kots['pr_id']]=$result_kots['pr_printerip'];
				   
                                        
				}
		}
				
        }  
        
		$tble="";
		$scount=0;
		$cur=date("Y-m-d");
		$ct="";
                 $print_in_kot=0;
                 //echo "select * from tbl_tableorder as tr LEFT JOIN tbl_menumaster as mr ON tr.ter_menuid=mr.mr_menuid	LEFT JOIN tbl_preferencemaster as pr ON tr.ter_preference=pr.pmr_id	LEFT JOIN tbl_portionmaster as pm ON tr.ter_portion=pm.pm_id  where tr.ter_kotno='".$kot_id."' and  tr.ter_dayclosedate='".$date."'  AND tr.ter_status<>'NotInStock' and mr.mr_show_in_kot_print='Y' order by mr_kotcounter,mr_maincatid ASC";
		//exit();
                 $sql_menulist="select tr.* from tbl_tableorder as tr LEFT JOIN tbl_menumaster as mr ON tr.ter_menuid=mr.mr_menuid and mr.mr_show_in_kot_print='Y'	 where tr.ter_kotno='".$kot_id."' and  tr.ter_dayclosedate='".$date."'  order by mr_kotcounter,mr_maincatid ASC";//LPAD(lower(mmy_orderof_print), 10,0),
		$sql_menus  =  mysqli_query($localhost,$sql_menulist); 
		$num_menus  = mysqli_num_rows($sql_menus);
		if($num_menus)
			{   
                            $print_in_kot=1;
                            //echo $print_in_kot;
                       //exit();
                    		$i=1;
				$kotid=$kot_id;
				$stf="";
				$sql_menulists="select distinct(tr.tr_tableno),ts.ts_tableidprefix,sf.ser_firstname from tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tr ON ts.ts_tableid=tr.tr_tableid LEFT JOIN tbl_staffmaster as sf ON  sf.ser_staffid=ts.ts_orderstaff where ts.ts_orderno ='".$order_id."' ";
				$sql_menuss  =  mysqli_query($localhost,$sql_menulists); 
				$num_menuss  = mysqli_num_rows($sql_menuss);
				if($num_menuss)
				{
					$k=1;	
					while($result_menuss  = mysqli_fetch_array($sql_menuss)) 
						{
                                            
                                            
						if($k==1)
						  {
							  $tble=$result_menuss['tr_tableno']."(".$result_menuss['ts_tableidprefix'].")";	
						  }else
						  {
							  $tble=$tble.",".$result_menuss['tr_tableno']."(".$result_menuss['ts_tableidprefix'].")";	
						  }
						  
						  if($k==1)
						  {
							  $stf=$result_menuss['ser_firstname'];	
						  }else
						  {
							  $stf=$stf.",".$result_menuss['ser_firstname'];	
						  }
						  $k++;
						}
				}
                                 //----------------------
                                $sql_stwd="select sf.ser_firstname
                                from tbl_tableorder tor
                                LEFT JOIN tbl_staffmaster as sf ON  sf.ser_staffid=tor.ter_waiter_id
                                where tor.ter_orderno ='$order_id' order by tor.ter_slno desc
                                limit 1";
				$sql_stwd  =  mysqli_query($localhost,$sql_stwd); 
				$num_stw  = mysqli_num_rows($sql_stwd);
				if($num_stw)
				{
                                    $result_stwd  = mysqli_fetch_array($sql_stwd);
                                    $waiter = $result_stwd['ser_firstname'];
                                }
                                //----------------------
				$tb=explode(",",$tble);
				$tabl=array_unique($tb);
				if(count($tabl)==1)
				{
					$table=$tabl[0];
				}else
				{
					$table=implode(",",$tabl);
				}
				
				$stff=explode(",",$stf);
				$stfd=array_unique($stff);
				if(count($stfd)==1)
				{
					$stfnam=$stfd[0];
				}else
				{
					$stfnam=implode(",",$stfd);
				}
                                $order_confirming_staff='';
                                
                                    $sql_order_confirming_staff="select sm.ser_firstname from tbl_kotmaster km  
                                                        left join tbl_staffmaster sm on sm.ser_staffid=km.kr_order_confirming_staff
                                                        where km.kr_kotno='".$kot_id."' and km.kr_date='".$date."' ";
				
                                    $sql_order_confirming_staff1  =  mysqli_query($localhost,$sql_order_confirming_staff); 
				$num_order_confirming_staff = mysqli_num_rows($sql_order_confirming_staff1);
				if($num_order_confirming_staff)
				{
                                    $result_order_confirming_staff  = mysqli_fetch_array($sql_order_confirming_staff1);
                                    $order_confirming_staff = $result_order_confirming_staff['ser_firstname'];
                                }        
                                
			  $kottime=date("Y-m-d H:i:s");
			  $kottable=$table;
			  $kotsteward=$order_confirming_staff;
			  
			  $ct=count($array_kot);
			  for($i=0;$i<$ct;$i++)
				  {${'a' . $i}="";${'b' . $i}='';}
				  $l=1;
				  $tets=array();$t=1;
				  $oldcat='';
								$newcat='';
                                                                
                                                           $prf="";      
				  while($result_menus  = mysqli_fetch_array($sql_menus)) 
                                         
					  {
                                      
                                       $prf=$result_menus['ter_preferencetext'];
                                              
                                      
                                      
						for($j=0;$j<$ct;$j++)
							{
                                                    
                                                     $itemotherlangname='';
                                              
                                    if($otherlang=='Y')
                                    {//mysqli_query($localhost,"SET CHARACTER SET 'utf8'");

                                    //$sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_portions['mr_menuid']."' AND lm_language_id=(SELECT `ls_id` FROM `tbl_languages` WHERE `ls_status`='Y' )"); 
                                    mysqli_query($localhost,"SET NAMES 'utf8'");
                                    mysqli_query($localhost,'SET CHARACTER SET utf8');
                                    $sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_menus['mr_menuid']."' AND lm_language_id='2'");
                                    $num_othlamg  = mysqli_num_rows($sql_othlamg);
                                    if($num_othlamg)
                                    {
                                            while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
                                            {
                                              $itemotherlangname=($result_othlamg['lm_menu_print']);
                                            }
                                    }
                            }
                                                    
                                                    
                                                    
                                                    
								$str="";
								$qts='';
								$typeval='';
								$type=$result_menus['ter_type'];
								if($type!="Dinein")
								{
									$typeval='(TA)';
								}
								
								if($t==1)
								{
									$oldcat=$result_menus['mr_maincatid'];
									$newcat=$result_menus['mr_maincatid'];
									
								}else
								{
									$newcat=$result_menus['mr_maincatid'];
								}
								if($result_menus['mr_kotcounter']==$arraycodekot[$j])
									{
										
										$k="-";
										$qtys=$result_menus['ter_qty'] * $result_menus['ter_rate'];
										if($slnoinkot=='Y')
										{
											$str= $l." ) ".$result_menus['mr_menuname']."-".$typeval;
										}else
										{
											$str=" ".$result_menus['ter_qty']." - ".$result_menus['mr_menuname']."-".$typeval;
											//$str= $result_menus['mr_menuname']."-".$result_menus['ter_qty']." - ".$typeval;
										}
										if($result_menus['pm_viewinkot']=="Y")
										{
											$str .= "\n     ".$result_menus['pm_portionname'];
											if($slnoinkot=='Y')
											{
												$str .= "        -".$result_menus['ter_qty'];
											}
											
										}else
										{
											if($slnoinkot=='Y')
											{
												$str .= "      ".$result_menus['ter_qty'];
											}
										}
										if($rateinkot=='Y')
										{
											$str .= " * ".number_format($result_menus['ter_rate'],$decimal)." = ".number_format($qtys,$decimal);
										}
									   if($result_menus['pmr_name']!="")
									   {
									   $str .= "\n " .$result_menus['pmr_name'].",";
									   }
                                                                            $str.="\n ";
									   if($prf!="0" && $prf!="")
									   {
										  
                                                                                   
									   $str .= "PREF: ".$prf;
                                                                             $str.="\n";
									   }
									   $str .= "\n";
									   $stnew='';
									   if($t!=1)
										{
											if($newcat!=$oldcat)
											{
												if($linesep=="Y")
												{
												$stnew="  "."----------------------\n";
												}
												$oldcat=$result_menus['mr_maincatid'];
											}
										}$t++;
									   
									   ${'a' . $j} .= $stnew.$str;
									   $tets[$j] .= $str;
									   ${'b' . $j} += $qtys;
									   $print_count[$j]++;
									   $l++;
									   if($result_menus['ter_qty']<1)
									   {
										   $query =mysqli_query($localhost,"update  tbl_tableorder set ter_status='KOT_Cancel' WHERE ter_orderno = '".$order_id."' And ter_kotno='".$kot_id."' ");
									   }
									}
								}
										 
							}
			}
			$prtck=0;
                        
                        if($print_in_kot==1){
		for($j=0;$j<$ct;$j++)
			  {         
                                $m=0;
                                $qtys=0;
					  $duplicatekot="";
					  
					  $printers='';
					  $connector='';
					  $sql_branch =  mysqli_query($localhost,"Select * from tbl_kotmaster where kr_kotno='".$kot_id."' AND kr_print='Y' AND kr_date='".$date."'"); 
						  $num_branch  = mysqli_num_rows($sql_branch);
						  if($num_branch)
						  {
							  while($result_menus  = mysqli_fetch_array($sql_branch)) 
					  			{
							  $kottime=$result_menus['kr_firstprint'];
							  //$duplicatekot="(Re-print)";
								}
						  }
						  $kotprintermode="";
						  $sql_branch =  mysqli_query($localhost,"Select * from tbl_kotmaster where kr_kotno='".$kot_id."'  AND kr_date='".$date."'"); 
						  $num_branch  = mysqli_num_rows($sql_branch);
						  if($num_branch)
						  {
							  while($result_menus  = mysqli_fetch_array($sql_branch)) 
					  			{
							  $kotprintermode=$result_menus['kr_mode_of_order'];
							  //$duplicatekot="(Re-print)";
								}
						  }
					  if(${'a' . $j}!="" || ${'a' . $j}=="")
					  {
						if($print_default_status[$array_kot[$j]]=='Y')
						{
							 $ps_count=$print_nosprint[$array_kot[$j]];
							for($g=1;$g<=$ps_count;$g++)
							{
								 $strs= ${'a' . $j};//$tets[$j];
								//$printers='';
								if($print_default[$array_kot[$j]]=='Y') // checking usb or not
							   {
									$printer="\\\\".$printer_kotusbip[$array_kot[$j]]."\\".$printer_kotusb[$array_kot[$j]];
									$connector = new FilePrintConnector($printer);
									$printers = new Escpos($connector);
							   }else
							   {//echo $j.$printer_kotip[$array_kot[$j]]."---".$printer_kotport[$array_kot[$j]];
                                                               
                                                               
                                                              
									$connector = new NetworkPrintConnector($printer_kotip[$array_kot[$j]], $printer_kotport[$array_kot[$j]]);
									$printers = new Escpos($connector);
                                                              
							   }
								
								$printers -> setJustification(Escpos::JUSTIFY_CENTER);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
								$printers -> setEmphasis(true);
								$printers -> setTextSize(2,2);
                                                        $printers -> text($kotid);
								$printers -> setTextSize(1, 2);
								$printers -> selectPrintMode();
								if($duplicatekot!='')
								{
									$printers -> feed();
									$printers -> setEmphasis(true);
									$printers -> setFont(Escpos::FONT_C);
									$printers -> text($duplicatekot);
									$printers -> feed();
								}else
								{
									$printers -> feed();
								}
								$printers -> feed();
								$printers -> setEmphasis(true);
								$printers -> setTextSize(1,2);
								$printers -> text($kotprintermode);
								$printers -> feed();
								
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
								$kotheader= array(
                                                                    
										new kotheader("Time",date('Y-m-d  h:i A', strtotime($kottime)),$print_style[$array_kot[$j]]),
									);
								foreach($kotheader as $kotheader) {
									$printers -> text($kotheader);
								}
								$printers -> selectPrintMode();
								$printers -> feed();
//								$kotheader= array(
//										new kotheader("Table",$kottable,$print_style[$array_kot[$j]]),
//									);
//								foreach($kotheader as $kotheader) {
//									$printers -> text($kotheader);
//								}
                                                                $printers -> setFont(Escpos::FONT_A);
                                                                $printers -> setJustification(Escpos::JUSTIFY_CENTER);
                                                                $printers -> setTextSize(2,1);
                                                                $printers -> text("Table: ".$kottable."\n\n");
                                                                $printers -> selectPrintMode();
								
								if($staffinkot=='Y')
								  {
									  $kotheader= array(
											  new kotheader("Steward",$kotsteward,$print_style[$array_kot[$j]]),
										  );
									  foreach($kotheader as $kotheader) {
										  $printers -> text($kotheader);
									  }
								  }
                                                                  //-----------
                                                                  if($waiter!=''){
                                                                   $kotheader= array(
											  new kotheader("Served By",$waiter,$print_style[$array_kot[$j]]),
										  );
									  foreach($kotheader as $kotheader) {
										  $printers -> text($kotheader);
									  }
                                                                  }
                                                                          //------------
                                                                  
								 if($floor_in_kotprint=='Y')
								  { 
								  	$kotheader= array(
										new kotheader("Floor",$floorname,$print_style[$array_kot[$j]]),
									);
									foreach($kotheader as $kotheader) {
										$printers -> text($kotheader);
									}
								  }
								  
								  
								$kotheader= array(
										new kotheader("KOT name",$kot_name[$array_kot[$j]],$print_style[$array_kot[$j]]),
									);
								foreach($kotheader as $kotheader) {
									$printers -> text($kotheader);
								}
								$printers -> setEmphasis(false);
								 $dashedline= array(
										new dashedline("-",$print_style[$array_kot[$j]]),
										);
										foreach($dashedline as $dashedline) {
											$printers -> text($dashedline);
										}
								//$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> text($strs,$print_style[$result_kots['pr_id']]);
                                                                
                                /********************* to print arabic and english starts**************************/
								
		
		
		$sql_menulist_in="select tr.ter_count_combo_ordering,tr.ter_slno, tr.ter_rate_type, tr.ter_unit_type,tr.ter_rate,tr.ter_qty, tr.ter_preferencetext, 
                    tr.ter_unit_id, tr.ter_base_unit_id, tr.ter_unit_weight, mr.mr_menuname,mr.mr_menuid,mr.mr_maincatid, mr.mr_show_in_kot_print, bum.bu_id, bum.bu_name,
                     um.u_name, pm.pm_portionname, pm.pm_viewinkot,pr.pmr_name from tbl_tableorder as tr 
                     LEFT JOIN tbl_menumaster as mr ON tr.ter_menuid=mr.mr_menuid and mr.mr_kotcounter='".$arraycodekot[$j]."'	
                     LEFT JOIN tbl_preferencemaster as pr ON tr.ter_preference=pr.pmr_id	
                     LEFT JOIN tbl_portionmaster as pm ON tr.ter_portion=pm.pm_id 
                     left join tbl_unit_master um on um.u_id=tr.ter_unit_id 
                     left join tbl_base_unit_master bum on bum.bu_id=tr.ter_base_unit_id  
                     where tr.ter_kotno='".$kot_id."' and  tr.ter_dayclosedate='".$date."'  AND tr.ter_status<>'NotInStock'    order by mr_kotcounter,ter_count_combo_ordering ASC";//LPAD(lower(mmy_orderof_print), 10,0),
		$sql_menus_in  =  mysqli_query($localhost,$sql_menulist_in); 
		$num_menus_in  = mysqli_num_rows($sql_menus_in);
		if($num_menus_in)
			{
               $str="";     
			  $i=1;
			  $kotid=$kot_id;
			  $stf="";
			  $l=1;
			  $tets=array();$t=1;
			  $oldcat='';
			  $newcat='';
			  $prf="";
                          $combo_ordering_count=array();
                          $combo_pack_rate=0;
                          $combo_menu_qty=0;
                          $combo_qty=0;
                         
                          //$print_in_kot=array();
			  while($result_menus_in  = mysqli_fetch_array($sql_menus_in)) 
				  { 
                                    
                                                    
                              
                                    if($result_menus_in['mr_show_in_kot_print']=='Y'){
                                        
                                       $prf=$result_menus_in['ter_preferencetext'];
//						for($r=0;$r<$ct;$r++)
//							{
                                                           $itemotherlangname='';
								if($otherlang=='Y')
								{ 
									  mysqli_query($localhost,"SET NAMES 'utf8'");
									  mysqli_query($localhost,'SET CHARACTER SET utf8');
									  $sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_menus_in['mr_menuid']."' AND lm_language_id='2'");
									  $num_othlamg  = mysqli_num_rows($sql_othlamg);
									  if($num_othlamg)
									  {
											  while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
											  {
												$itemotherlangname=($result_othlamg['lm_menu_print']);
											  }
									  }
                            	                                }
								$str="";
								
								
								if($t==1)
								{
									$oldcat=$result_menus_in['mr_maincatid'];
									$newcat=$result_menus_in['mr_maincatid'];
									
								}else
								{
									$newcat=$result_menus_in['mr_maincatid'];
								}
//								if($result_menus_in['mr_kotcounter']==$arraycodekot[$m])
//									{
									if($result_menus_in['ter_count_combo_ordering']){
                                        
                                                                           
                                                                            $sql_combo_heading  =  mysqli_query($localhost,"select  cn.cn_name,cp.cp_pack_name,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_combo_pack_rate FROM 
                                                                                                                            tbl_combo_ordering_details cod 
                                                                                                                            left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                                                                            left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                                                                                            where cod.cod_count_combo_ordering='".$result_menus_in['ter_count_combo_ordering']."' and cod.cod_menu_id='".$result_menus_in['mr_menuid']."'  and cod.cod_count_combo_ordering IS NOT  NULL"); 
                                                                            $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                                                            if($num_combo_heading)
                                                                                {
                                                                                    $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                                                                    $combo_pack_rate=$result_combo_heading['cod_combo_pack_rate'];
                                                                                    $combo_menu_qty=$result_combo_heading['cod_menu_qty'];
                                                                                    $combo_qty=$result_combo_heading['cod_combo_qty'];
                                                                                    $combo_name = $result_combo_heading['cn_name'].' - '. $result_combo_heading['cp_pack_name'].' (Qty:'.$result_combo_heading['cod_combo_qty'].') - '.number_format(($combo_pack_rate*$combo_qty),$decimal);
                                                                                }
                                                                        }
                                                                                if($result_menus_in['ter_count_combo_ordering'] && !in_array($result_menus_in['ter_count_combo_ordering'],$combo_ordering_count)){
                                                                                        $combo_ordering_count[]=$result_menus_in['ter_count_combo_ordering'];
                                                                                        $qtys=$qtys+($combo_pack_rate*$combo_qty);
                                                                                        $printers -> setEmphasis(true);
                                                                                        $printers -> setFont(Escpos::FONT_A);
                                                                                        $printers -> setJustification(Escpos::JUSTIFY_LEFT);
                                                                                        $printers -> text($combo_name);
                                                                                        $printers -> setEmphasis(false);
                                                                                        $printers -> feed();
                                                                                }
                                                                                else{
                                                                                    $combo_name='';
                                                                                }
										
                                                                                
                                                                                $k="-";
                                                                                $qtys1=0;
                                                                                
                                                                                    
                                                                                
                                                                                if($result_menus_in['ter_count_combo_ordering']==NULL){
                                                                                    $qtys1=$result_menus_in['ter_qty'] * $result_menus_in['ter_rate'];
                                                                                    $qtys=$qtys+($result_menus_in['ter_qty'] * $result_menus_in['ter_rate']);
                                                                                }
										if($slnoinkot=='Y')
										{
											$str= $l." ) ".$result_menus_in['mr_menuname']."-".$typeval;
                                                                                        
										}else
										{       if($result_menus_in['ter_count_combo_ordering']==NULL){
                                                                                            $str=" ".$result_menus_in['ter_qty']." - ".$result_menus_in['mr_menuname']."-".$typeval;
											//$str= $result_menus['mr_menuname']."-".$result_menus['ter_qty']." - ".$typeval;
                                                                                        }else{
                                                                                            $str=" ".$combo_qty." * ".$combo_menu_qty." - ".$result_menus_in['mr_menuname']."-".$typeval;
                                                                                        }
                                                                                        
                                                                                }
										if($result_menus_in['pm_viewinkot']=="Y")
										{
											$str .= "\n     ".$result_menus_in['pm_portionname'];
											if($slnoinkot=='Y')
											{   if($result_menus_in['ter_count_combo_ordering']==NULL){
												$str .= "        -".$result_menus_in['ter_qty'];
                                                                                            }else{
                                                                                               $str .= "         ".$combo_qty." * ".$combo_menu_qty; 
                                                                                            }    
											}
											
										}else
										{
											if($slnoinkot=='Y'){ 
                                                                                            if($result_menus_in['ter_count_combo_ordering']==NULL){
												$str .= "         ".$result_menus_in['ter_qty'];
                                                                                            }else{
                                                                                               $str .= "         ".$combo_qty." * ".$combo_menu_qty; 
                                                                                            }    
											}
											
										}
										if($rateinkot=='Y')
										{       if($result_menus_in['ter_count_combo_ordering']==NULL){
											 $str .= " * ".number_format($result_menus_in['ter_rate'],$decimal)." = ".number_format($qtys1,$decimal);
                                                                                        }
                                                                                        
                                                                                }        
									   if($result_menus_in['pmr_name']!="")
									   {
									   $str .= "\n " .$result_menus_in['pmr_name'].",";
									   }
                                                                           else
                                                                           {
                                                                            if($result_menus_in['ter_unit_id']!="")
                                                                            {
                                                                             $str .= "\n " .$result_menus_in['ter_unit_type'].":".number_format($result_menus_in['ter_unit_weight'],$decimal)." ".$result_menus_in['u_name'].","; 
                                                                            }
                                                                            else if($result_menus_in['ter_base_unit_id']!=""){
                                                                               $str .= "\n " .$result_menus_in['ter_unit_type'].":".number_format($result_menus_in['ter_unit_weight'],$decimal)." ".$result_menus_in['bu_name'].",";  
                                                                            }
                                                                           }
                                        //$str.="\n ";
									   if($prf!="0" && $prf!="")
									   {
                                                                               $str .= "\n";
									   $str .= " PREF: ".$prf;
                                       
									   }
                                                                           if($itemotherlangname==""){
                                                                                $str .= "\n";
                                                                           }
                                                                           
									   $str .= "\n";
									   $stnew='';
									   if($t!=1)
										{
											if($newcat!=$oldcat)
											{
												if($linesep=="Y")
												{
												$stnew="  "."----------------------\n";
												}
												$oldcat=$result_menus_in['mr_maincatid'];
											}
										}$t++;
									   
									   $l++;
									  
									   
									   
									   if($stnew.$str)
										{
							            $printers -> setJustification(Escpos::JUSTIFY_LEFT);
								        $printers -> text($stnew.$str);
								
								        $str1='';$randtemp='';
										if($otherlang=='Y')
												{//$printers -> text($itemotherlangname);
												$str1=$itemotherlangname;
												$randtemp=mktime(0,0,0,12,31,1979);
                                                                                                
												$this->itemimage_create($str1,$randtemp,$Arabic);
                                                                                           
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$logo = new EscposImage("printlogo/printimages/".$randtemp.".png");
												$printers -> bitImage($logo);//graphics($logo);
												//unlink("printlogo/printimages/".$randtemp.".png");
												unset($logo);
                                                                                                
                                                                                                 $printers -> feed();
												}
										}	
									//}
								//}
							$m++;
                                                        
							}
							
				
                        }							
  }								
 
					                                                           
			
								$dashedline= array(
										new dashedline("-",$print_style[$array_kot[$j]]),
										);
										foreach($dashedline as $dashedline) {
											$printers -> text($dashedline);
										}
								if($itemcoutinkot=='Y')
								  {
									  $kotheader= array(
										new kotheader("Items ",$m,$print_style[$array_kot[$j]]),
										);
										foreach($kotheader as $kotheader) {
											$printers -> text($kotheader);
										}
								  }
								  if($rateinkot=='Y')
									{
										$kotheader= array(
										new kotheader("Kot Value ",number_format(($qtys+$qtys_addon),$decimal),$print_style[$array_kot[$j]]),
										);
										foreach($kotheader as $kotheader) {
											$printers -> text($kotheader);
										}
									}
								
								$printers -> cut();
								$printers -> close();
							}
						}
						  
						//kot print status 
						
						if($print_default_status[$array_kot[$j]]=='Y')
							  {
								  $sql_branch =  mysqli_query($localhost,"Select * from tbl_kotmaster where kr_kotno='".$kot_id."' AND kr_print='N' AND kr_date='".$date."'"); 
								  $num_branch  = mysqli_num_rows($sql_branch);
								  if($num_branch)
								  {
									    $datetime=date("Y-m-d H:i:s");
										$query =mysqli_query($localhost,"update  tbl_kotmaster set kr_firstprint='".$datetime."' ,kr_print='Y',kr_lastprint='".$datetime."' WHERE kr_kotno='".$kot_id."' AND kr_print='N' AND kr_date='".$date."' ");		
								  }else
								  {
									    $datetime=date("Y-m-d H:i:s");
										$query =mysqli_query($localhost,"update  tbl_kotmaster set kr_lastprint='".$datetime."'  WHERE kr_kotno='".$kot_id."' AND kr_print='Y' AND kr_date='".$date."' ");	
								  }
							  }
						}
					
     // log_query///	
    
    $log_data_print=mysqli_query($localhost,"update tbl_printer_function_log set  tpf_print_status='Y' where tpf_id=LAST_INSERT_ID() ");                                                  
                                                
				  if($typeof=="android")
					{
						if($printers)
							{
							 $prtck++;
								
							}
							
					}	
						  				 
			  }
                          }
			  
			 if($typeof=="android")
			  {
				return $prtck;
			  }	else
			   {
				  return true;
			   }
			
		/* ************************************Dine in print KOT ends******************************************************************  */	
	               
	}
     
        
    function itemimage_create($str,$rand,$Arabic)
	{
		if(!headers_sent()){
		header("Content-type: image/png"); 
		}
		$im="";
		$im =imagecreate(400, 40);
		$bg = imagecolorallocatealpha($im, 255, 255, 255,45); 
		$textcolor  = imagecolorallocate($im, 0, 0, 0); 
		$font  ='printlogo/I18N/Arabic/Font/trado.ttf';
		$text =$str; 
		
		
		$text = $Arabic->utf8Glyphs($text); 
		imagettftext($im, 30, 0, 10, 20, $textcolor, $font, $text); 
		imagepng($im,'printlogo/printimages/'.$rand.'.png'); 
		unset($Arabic);
	   // imagedestroy($im); 
	}
      
      
}

class menulistinvoice {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $perhead;
    private $style;

    public function __construct($product = '',$perhead = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> perhead = $perhead;
        $this -> qty = $qty;
        $this -> rate = $rate;
	$this -> amount = $amount;
        $this -> style = $style;
    }

    public function __toString() {
		$leftCols ="";
		$leftCols1 ="";
                $rightCols ="";
		$rightCols1 ="";
                $rightCols2 ="";
		$left='';
		if($this -> style =="1")
		{
                $leftCols ="20%";
		$leftCols1 ="6%";
                $rightCols ="6%";
		$rightCols1 ="6%";//bbq
                $rightCols2="8%";
		}else if($this -> style =="2") 
		{
		$leftCols ="16%";
		$leftCols1 ="5%";
                $rightCols ="5%";
		$rightCols1 ="7%";//ojin
                $rightCols2="7%";
		}
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT);
		$left1 = str_pad($this -> perhead, $leftCols1,' ', STR_PAD_LEFT);
		$right = str_pad($this -> qty, $rightCols,' ', STR_PAD_LEFT);
		$right1 = str_pad($this -> rate, $rightCols1,' ', STR_PAD_LEFT);
		$right2 = str_pad($this -> amount, $rightCols2,' ', STR_PAD_LEFT);
                
                
        return "$left$left1$right$right1$right2\n";
    }
}



class menulist {
    private $product;
    private $qty;
    private $rate;
	private $amount;
	private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
		$this -> amount = $amount;
		$this -> style = $style;
    }

    public function __toString() {
		 $leftCols ="";
		$leftCols1 ="";
        $rightCols ="";
		$rightCols1 ="";
		$left='';
		if($this -> style =="1")
		{
        $leftCols ="20%";
		$leftCols1 ="7%";
        $rightCols ="10%";
		$rightCols1 ="10%";//bbq
		$left = str_pad(" ".$this -> product, $leftCols,' ', STR_PAD_RIGHT);
		}else if($this -> style =="2") 
		{
		$leftCols ="20%";
		$leftCols1 ="3%";
        $rightCols ="10%";
		$rightCols1 ="8%";//ojin
		$left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT);
		}
		
		
        
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT);
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH);
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT);
        return "$left$left1$right$right1\n";
    }
}	
class bilno {
    private $name;
    private $price;
	private $style;

    public function __construct($name = '', $price = '',$style='') {
        $this -> name = $name;
        $this -> price = $price;
		$this -> style = $style;
    }

    public function __toString() {
		$leftCols = '';
        $rightCols = '';
		$left='';
		if($this -> style =="1")
		{
        $leftCols = '33%';
        $rightCols = '14%';
		$left = str_pad(" ".$this -> name, $leftCols) ;
		}else  if($this -> style =="2")
		{
        $leftCols = '31%';
        $rightCols = '10%';
		$left = str_pad($this -> name, $leftCols) ;
		}
        
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class datebill {
    private $name;
    private $price;
	private $style;

    public function __construct($name = '', $price = '',$style='') {
        $this -> name = $name;
        $this -> price = $price;
		$this -> style = $style;
    }

    public function __toString() {
		$leftCols = '';
        $rightCols = '';
		$left='';
		if($this -> style =="1")
		{
        $leftCols = '23%';
        $rightCols = '24%';
		$left = str_pad(" ".$this -> name, $leftCols,' ', STR_PAD_RIGHT) ;
		}else if($this -> style =="2")
		{
        $leftCols = '18%';
        $rightCols = '21%';
		$left = str_pad($this -> name, $leftCols,' ', STR_PAD_RIGHT) ;
		} 
        
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class kotheader1 {
    private $name;
    private $values;
	private $style;

    public function __construct($name = '', $values = '',$style='') {
        $this -> name = $name;
        $this -> values = $values;
		$this -> style = $style;
    }
    

    public function __toString() {
		$leftCols = '';
        $rightCols = '';
		$left ='';
		if($this -> style =="1")
		{
			$leftCols = '11%';
			$rightCols = '34%';
			$left = str_pad(" ".$this -> name, $leftCols) ;
		}else if($this -> style =="2")
		{
			$leftCols = '10%';
			$rightCols = '30%';
			$left = str_pad($this -> name, $leftCols) ;
		}
        
        $right = str_pad($this -> values, $rightCols,' ', STR_PAD_RIGHT);
        return "$left $right\n";
    }
}
class kotheader {
    private $name;
    private $values;
	private $style;

    public function __construct($name = '', $values = '',$style='') {
        $this -> name = $name;
        $this -> values = $values;
		$this -> style = $style;
    }
    

    public function __toString() {
		$leftCols = '';
        $rightCols = '';
		$left ='';
		if($this -> style =="1")
		{
			$leftCols = '11%';
			$rightCols = '34%';
			$left = str_pad(" ".$this -> name, $leftCols) ;
		}else if($this -> style =="2")
		{
			$leftCols = '10%';
			$rightCols = '30%';
			$left = str_pad($this -> name, $leftCols) ;
		}
        
        $right = str_pad($this -> values, $rightCols,' ', STR_PAD_RIGHT);
        return "$left:$right\n";
    }
}
class hdaddress {
    private $name;
    private $values;
	private $style;

    public function __construct($name = '', $values = '',$style='') {
        $this -> name = $name;
        $this -> values = $values;
		$this -> style = $style;
    }

    public function __toString() {
		$leftCols = '';
        $rightCols = '';
		$left ='';
		if($this -> style =="1")
		{
			$leftCols = '11%';
			$rightCols = '34%';
			$left = str_pad(" ".$this -> name, $leftCols) ;
		}else if($this -> style =="2")
		{
			$leftCols = '10%';
			$rightCols = '30%';
			$left = str_pad($this -> name, $leftCols) ;
		}
        
        $right = str_pad($this -> values, $rightCols,' ', STR_PAD_RIGHT);
        return "$left:$right\n";
    }
}
class dashedline {
    private $name;
    private $style;

    public function __construct($name = '', $style='') {
        $this -> name = $name;
        $this -> style = $style;
    }

    public function __toString() {
		$leftCols = '';$right='';
		if($this -> style =="1")
		{
        	$leftCols = '47%';
			$right = str_pad(" ".$this -> name, $leftCols,'-', STR_PAD_RIGHT);
		}else if($this -> style =="2")
		{
			$leftCols = '41%';
			$right = str_pad($this -> name, $leftCols,'-', STR_PAD_RIGHT);
		}
        
        return "$right\n";
    }
}
class singletext {
     private $name;
    private $style;

    public function __construct($name = '', $style='') {
        $this -> name = $name;
        $this -> style = $style;
    }

    public function __toString() {
		$leftCols = '';$right='';
		if($this -> style =="1")
		{
        	$leftCols = '47%';
			$right = str_pad(" ".$this -> name, $leftCols,' ', STR_PAD_RIGHT);
		}else if($this -> style =="2")
		{
			$leftCols = '41%';
			$right = str_pad($this -> name, $leftCols,' ', STR_PAD_RIGHT);
		}
        
        return "$right\n";
    }
}

class totalpayable {
     private $amount;
    private $style;

    public function __construct($amount = '', $style='') {
        $this -> amount = $amount;
        $this -> style = $style;
    }

    public function __toString() {
		$rightCols = '';$right='';
		if($this -> style =="1")
		{
        	$rightCols = '17%';
			$right = str_pad($this -> amount, $rightCols,' ', STR_PAD_LEFT);
		}else if($this -> style =="2")
		{
			$rightCols = '14%';
			$right = str_pad($this -> amount, $rightCols,' ', STR_PAD_LEFT);
		}
        
        return "$right\n";
    }
}
class deno {
    private $product;
    private $qty;
    private $rate;
	
	private $style;

    public function __construct($product = '', $qty = '', $rate = '', $style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
		
		$this -> style = $style;
    }

    public function __toString() {
		 $leftCols ="";
		$leftCols1 ="";
          $rightCols ="";
		
		$left='';
		if($this -> style =="1")
		{
        $leftCols ="15%";
	$leftCols1 ="5%";
        $rightCols ="25%";
		
		$left = str_pad(" ".$this -> product, $leftCols,' ', STR_PAD_RIGHT);
		}else if($this -> style =="2") 
		{
		$leftCols ="15%";
		$leftCols1 ="5%";
               $rightCols ="20%";
		
		$left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT);
		}
		
		
        
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH);
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT);
		
        return "$left$left1$right\n";
    }
}	
