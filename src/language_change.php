<?PHP
function print_bill_ta($billno,$mode,$branchid,$type,$billip="N",$hosttype='')
	{
		/* ************************************TA print Bill starts******************************************************************  */
		require_once("Escpos.php");
		require('printlogo/I18N/Arabic.php');
		$Arabic = new I18N_Arabic('Glyphs');  
		/*require_once("printlogo/RTLBuffer.php");
		$eposEncodings = array( // E-pos TEP 200M character tables
        'CP437' => 0,
        'CP1256' => 34,
        'CP864' => 63);*/
		if($type=="web")
		{
	   		$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
		}else if($type=="android")
		{
			include("appdbconnection.php");
		}
		
		$reprint='';
		   $branchname="";
		   $branchaddress="";
		   $branchemail="";
		   $branchphone="";
		   $branchothers1="";
		   $branchothers2="";
		   $branchothers3="";
		   $footer1="";
		   $footer2="";
		   $footer3="";
		   $footer4="";
		    $showcancel='';
		   $s_servicetaxunit="";
		  $s_servicechargeunit="";
		  $s_vatunit="";
		  
		  $be_billnoformat= '';
		  $be_showcancelledbill= '';
		  $be_billwithportion= '';
		  $be_logoinbill= '';
		   $sql_branch =  mysqli_query($localhost,"Select * from tbl_branchmaster where be_branchid='".$branchid."'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $branchaddress=$result_branch['be_address'];
						 $branchemail=$result_branch['be_email'];
						 $branchphone=$result_branch['be_phone'];
						 $branchothers1=$result_branch['be_others1'];
						 $branchothers2=$result_branch['be_others2'];
						 $branchothers3=$result_branch['be_others3'];
						 $footer1=$result_branch['be_footer1'];
						 $footer2=$result_branch['be_footer2'];
						 $footer3=$result_branch['be_footer3'];
						 $footer4=$result_branch['be_footer4'];
						 
						 $showcancel=$result_branch['be_showcancelledbill'];
						 $s_servicetaxunit=$result_branch['be_servicetaxunit'];
						 $s_servicechargeunit=$result_branch['be_servicechargeunit'];
						 $s_vatunit=$result_branch['be_vatunit'];
						  
						$status = $result_branch["be_kotstatuschange"];
						$direct= $result_branch["be_directclosefirst"];
						$bilformat= $result_branch["be_billnoformat"];
						
						$be_billnoformat= $result_branch["be_billnoformat"];
						$be_showcancelledbill= $result_branch["be_showcancelledbill"];
						$be_billwithportion= $result_branch["be_billwithportion"];
						$be_logoinbill= $result_branch["be_logoinbill"];
                                                $be_billref_in_bill=$result_branch["be_billref_in_bill"];
												 $decimal=$result_branch['be_decimal'];
					}
		  }
		 $otherlang='';
		  $sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='".$branchid."'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang'];
					}
		  }
		  $total=0; $servtsx=0;$vat=0;$servchrg=0;$final=0;$cancel=0;$disc=0;$assigd="";$dscval='';$roundoffvaluec='';
		  $servtx_bill=0;$servchrg_bill=0;$vat_bill=0;$modeoforder='';
		  $cutsnam='';$cutsaddr='';$cutsphon='';
		 $sql_portions_bill  =  mysqli_query($localhost,"SELECT * from tbl_takeaway_billmaster as bm LEFT JOIN tbl_staffmaster as sm ON  bm.tab_assignedto=sm.ser_staffid LEFT JOIN tbl_takeaway_customer as cr  ON bm.tab_hdcustomerid=cr.tac_customerid  WHERE bm.tab_billno='".$billno."' "); 
			  $num_portions_bill  = mysqli_num_rows($sql_portions_bill);
			  if($num_portions_bill)
			  {
					while($result_portions_bill  = mysqli_fetch_array($sql_portions_bill)) 
						{
							
						   if($be_billref_in_bill !='N' && $result_portions_bill['tab_bill_ref'] != NULL){
                                                          $refno=$result_portions_bill['tab_bill_ref']; 
                                                        }
						   $modeoforder=$result_portions_bill['tab_mode'];
						   
						   $total=number_format($result_portions_bill['tab_subtotal'],$decimal);
						   
						   $cancel=number_format($result_portions_bill['tab_cancelamount'],$decimal);
						   $disc=number_format($result_portions_bill['tab_discountvalue'],$decimal);
						    $dscval=number_format($result_portions_bill['tab_discount_label'],$decimal);
							
						   $servtx_bill=number_format($result_portions_bill['tab_servicetax'],$decimal);
						   $servchrg_bill=number_format($result_portions_bill['tab_servicecharge'],$decimal);
						   $vat_bill=number_format($result_portions_bill['tab_vat'],$decimal);
						  /* $servtsx=$result_portions_bill['bm_servicetax'].$st;
						   $vat=$result_portions_bill['bm_vat'].$st3;
						   $servchrg=$result_portions_bill['tab_servicecharge'].$st2;*/
						   
						   $final=number_format($result_portions_bill['tab_netamt'],$decimal);
						   $assigd=$result_portions_bill['ser_firstname']." ".$result_portions_bill['ser_lastname'];
						   $cutsnam=$result_portions_bill['tac_customername'];
						   $cutsaddr=$result_portions_bill['tac_address'];
						   if($cutsaddr!="")$cutsaddr.=",";
						   $cutsaddrlmrk=$result_portions_bill['tac_landmark'];
						   if($cutsaddr!="")$cutsaddr.="";
						   $cutsaddr.=$result_portions_bill['tac_area'];
						   $cutsphon=$result_portions_bill['tac_contactno'];
                                                   $note = $result_portions_bill['tac_remarks'];
						   
						   $roundoffvaluec=number_format($result_portions_bill['tab_roundoff_value'],$decimal);
						}
						
			  }
			  
			   $discsettlectr="";
		   $be_roundoff_visible='';
		   if($modeoforder=="CS")
			  {
				   $sql_table_pt="SELECT * FROM `tbl_branch_settings_counter` WHERE bsc_branchid='".$branchid."'";
				  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
				  $num_pt  = mysqli_num_rows($sql_pt);
				  if($num_pt){
					  while($result_pt  = mysqli_fetch_array($sql_pt)) 
						  {
							  //$_SESSION['counter_discount_popup']=$result_pt['bsc_discount_popup'];
							  $discsettlectr=$result_pt['bsc_bill_before_settle']; 
							  $be_roundoff_visible=$result_pt['bsc_roundoff_visible'];
						  }
				  } 
			  }else
			  {
				  $sql_table_pt="SELECT * FROM `tbl_branch_settings_ta_hd` WHERE bsth_branchid='".$branchid."' ";
				  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
				  $num_pt  = mysqli_num_rows($sql_pt);
				  if($num_pt){
					  while($result_pt  = mysqli_fetch_array($sql_pt)) 
						  {
							  //$_SESSION['counter_discount_popup']=$result_pt['bsc_discount_popup'];
							  //$discsettlectr=$result_pt['bsc_bill_before_settle']; 
							  $be_roundoff_visible=$result_pt['bsth_roundoff_visible'];
						  }
				  } 
			  }
		
			  $sql_portions_bill='';
			   $fr_vbill_tax='';
			  $fr_vbill_charge='';
			  $fr_vbill_vat='';
			  if($modeoforder=="CS")
			  {
				  $sql_portions_bill  =  mysqli_query($localhost,"SELECT bsc_servicetax as srtx,bsc_vat as vt,bsc_servicecharge as srch,bsc_bill_view_servicetax as vwtx,bsc_bill_view_vat as vwvt,bsc_bill_view_servicecharge as vwsg from tbl_branch_settings_counter    WHERE bsc_branchid='".$branchid."' "); 
			  }else
			  {//`bsth_branchid`, `bsth_servicetax`, `bsth_vat`, `bsth_servicecharge`, `bsth_view_servicetax`, `bsth_view_vat`, `bsth_view_servicecharge`, `bsth_nearest_roundoff`, `bsth_kotbypass`, `bsth_kotprint`, `bsth_billno_daily_format`, `bsth_discount_popup`, `bsth_roundoff_visible`, `bsth_enable_extra_tax`
				   $sql_portions_bill  =  mysqli_query($localhost,"SELECT bsth_servicetax as srtx,bsth_vat as vt,bsth_servicecharge as srch,bsth_view_servicetax as vwtx,bsth_view_vat as vwvt,bsth_view_servicecharge as vwsg from tbl_branch_settings_ta_hd    WHERE bsth_branchid='".$branchid."' "); 
			  }
			  $num_portions_bill  = mysqli_num_rows($sql_portions_bill);
			  if($num_portions_bill)
			  {
					while($result_portions_bill  = mysqli_fetch_array($sql_portions_bill)) 
						{
							$st="";$st2="";$st3="";//$s_servicetaxunit $s_servicechargeunit $s_vatunit
						   if( $s_servicetaxunit=="%")
						   $st=$s_servicetaxunit;
						   
						   if( $s_servicechargeunit=="%")
						   $st2=$s_servicechargeunit;
						   
						   if( $s_vatunit=="%")
						   $st3=$s_vatunit;
						   
						   $servtsx=$result_portions_bill['srtx'].$st;
						   $vat=$result_portions_bill['vt'].$st3;
						   $servchrg=$result_portions_bill['srch'].$st2;
						   
						    $fr_vbill_tax=$result_portions_bill['vwtx'];
							$fr_vbill_charge=$result_portions_bill['vwsg'];
							$fr_vbill_vat=$result_portions_bill['vwvt'];
						}
			  }
			  
			  $ctr_paymode='';$ctr_amtpaid='';$ctr_amtbal='';$ctr_tranc='';$ctr_comp='';
			  $sql_portions_bill  =  mysqli_query($localhost,"SELECT pm.pym_name,bm.tab_amountpaid,bm.tab_amountbalace,bm.tab_transactionamount,bm.tab_complimentaryremark ,bm.tbl_takeaway_printed from tbl_takeaway_billmaster as bm LEFT JOIN tbl_paymentmode as pm ON  pm.pym_id=bm.tab_paymode   WHERE bm.tab_billno='".$billno."' "); 
			  $num_portions_bill  = mysqli_num_rows($sql_portions_bill);
			  if($num_portions_bill)
			  {
					while($result_portions_bill  = mysqli_fetch_array($sql_portions_bill)) 
						{
							$ctr_paymode=$result_portions_bill['pym_name'];
							if($ctr_paymode=="Cash" || $ctr_paymode=="Credit / Debit Card")
							{
							$ctr_amtpaid=number_format($result_portions_bill['tab_amountpaid'],$decimal);
							$ctr_amtbal=number_format($result_portions_bill['tab_amountbalace'],$decimal);
							//$ctr_tranc=$result_portions_bill['tab_transactionamount'];
							}
							if($ctr_paymode=="Cash" || $ctr_paymode=="Credit / Debit Card")
							{
							$ctr_amtpaid=number_format($result_portions_bill['tab_amountpaid'],$decimal);
							$ctr_amtbal=number_format($result_portions_bill['tab_amountbalace'],$decimal);
							$ctr_tranc=number_format($result_portions_bill['tab_transactionamount'],$decimal);
							}
							if($ctr_paymode=="Complimentary")
							$ctr_comp=$result_portions_bill['tab_complimentaryremark'];
							
							if($result_portions_bill['tbl_takeaway_printed']=='Y')
							$reprint="( Duplicate Copy )";
						}
			  }
			  
		 $billprint_tp='';
		 $sql_table_pt="select * from tbl_printertype ";
			  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
			  $num_pt  = mysqli_num_rows($sql_pt);
			  if($num_pt){
				  while($result_pt  = mysqli_fetch_array($sql_pt)) 
					  {
						  if($result_pt['pt_typename']=="Bill Print TA CS")
						  {
							  $billprint_tp=$result_pt['pt_id'];
						  }
						  
					  }
			  }
		//echo "ok";
		
		$sql_kots='';
		$finalip='';
		$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$branchid."' and pr_printertype='".$billprint_tp."'";
		$sql_kotss  =  mysqli_query($localhost,$sql_kots); 
		 $num_kots  = mysqli_num_rows($sql_kotss);
		if($num_kots){	
		while($result_kots  = mysqli_fetch_array($sql_kotss)) 
				{
						if($result_kots['pr_enable']=='Y')
						{
						$ps_count=$result_kots['pr_printcount'];
						  for($l=1;$l<=$ps_count;$l++)
						  {
							  $printers='';
								if($result_kots['pr_defaultusb']=='Y')
								{
								}else
								{
																		
									$printip='';
									if($type!="android")
									{
										
										if($billip=='Y')
										{
										 $sql_kots_check="Select * From  tbl_printersettings_ip  Where pr_machine_ip ='".trim($hosttype)."'  AND pr_id='".trim($result_kots['pr_id'])."' ";
										$sql_kotss2  =  mysqli_query($localhost,$sql_kots_check); 
										$num_kots2  = mysqli_num_rows($sql_kotss2);
										if($num_kots2){
											while($result_kots2  = mysqli_fetch_array($sql_kotss2)) 
											{
												$printip=trim($result_kots2['pr_id']);
											}
											
											if($printip==trim($result_kots['pr_id']))
											{
												$finalip=$printip;
											}
										}
										}
									}
								}
						  }
						}
				}
		}
		
		$printers='';
		//$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$branchid."' and pr_printertype='".$billprint_tp."'";
		$sql_kots='';
		if($billip=='Y')
		{
			
			  $sql_kots="Select * From tbl_printersettings as ps LEFT JOIN  tbl_printersettings_ip as pi ON ps.pr_id=pi.pr_id Where ps.pr_branchid ='".$branchid."' and ps.pr_printertype='".$billprint_tp."' and pi.pr_id='".$finalip."'";
		}else
		{
			 $sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$branchid."' and pr_printertype='".$billprint_tp."'";
		}
		$sql_kotss  =  mysqli_query($localhost,$sql_kots); 
		$num_kots  = mysqli_num_rows($sql_kotss);
		if($num_kots){	
		while($result_kots  = mysqli_fetch_array($sql_kotss)) 
				{
						if($result_kots['pr_enable']=='Y')
						{
						$ps_count=$result_kots['pr_printcount'];
						  for($l=1;$l<=$ps_count;$l++)
						  {
							  
								if($result_kots['pr_defaultusb']=='Y')
								{
									 $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
									$connector = new FilePrintConnector($printer);
								  	$printers = new Escpos($connector);
								}else
								{
									/*$connector = new NetworkPrintConnector($result_kots['pr_printerip'], $result_kots['pr_printerport']);
									$printers = new Escpos($connector);*/
									
									
									$printip='';
									//$billip='Y';
									if($type!="android")
									{
										
										//if($billip=='Y')
										//echo $billip;
										if($billip=='Y')
										{
										//$_SESSION['hosttype'];
										//".$_SESSION['hosttype']."
										 $sql_kots_check="Select * From  tbl_printersettings_ip  Where pr_machine_ip ='".trim($hosttype)."'  AND pr_id='".trim($result_kots['pr_id'])."' ";
										$sql_kotss2  =  mysqli_query($localhost,$sql_kots_check); 
										$num_kots2  = mysqli_num_rows($sql_kotss2);
										if($num_kots2){
											while($result_kots2  = mysqli_fetch_array($sql_kotss2)) 
											{
												$printip=trim($result_kots2['pr_id']);
											}
											
											if($printip==trim($result_kots['pr_id']))
											{
												$connector = new NetworkPrintConnector($result_kots['pr_printerip'], $result_kots['pr_printerport']);
											$printers = new Escpos($connector);
											//exit();
											}else
											{
												//exit();
											}
											
										}
									
										}else
										  {
											  $connector = new NetworkPrintConnector($result_kots['pr_printerip'], $result_kots['pr_printerport']);
											  $printers = new Escpos($connector);
										  }
									}else
									{
										$connector = new NetworkPrintConnector($result_kots['pr_printerip'], $result_kots['pr_printerport']);
										$printers = new Escpos($connector);
									}
									
									
									
									
									
									
								
								}//echo "inside"; //print_r($printers);
								$printers -> setJustification(Escpos::JUSTIFY_CENTER);
								if($be_logoinbill=="Y")
								{
								$logo = new EscposImage("img/print-logo/print_logo.png");
								
								$printers -> bitImage($logo);//graphics($logo);
								$printers -> feed();
								}
								
								if($branchname!="" && $be_logoinbill=="N")
			 						{
										$printers -> setJustification(Escpos::JUSTIFY_CENTER);
										$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
										$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
										$printers -> setEmphasis(true);
										$printers -> setTextSize(2,2);
										$printers -> text($branchname);
										$printers -> setTextSize(1, 2);
										$printers -> selectPrintMode();
										$printers -> feed();
									}
									 if($branchothers1!="")
									 {
										$printers -> setFont(Escpos::FONT_C);
										 $printers -> text($branchothers1);
										 $printers -> feed();
									 }
									if($branchaddress!="")
								   {
										  $printers -> setFont(Escpos::FONT_C);
										  $printers -> text($branchaddress);
										  $printers -> feed();
								   }
								   if($branchothers2!="")
									 {
										$printers -> setFont(Escpos::FONT_C);
										 $printers -> text($branchothers2);
										 $printers -> feed();
									 }
								   if($branchemail!="")
									{
										  $printers -> setFont(Escpos::FONT_C);
										  $printers -> text($branchemail);
										  $printers -> feed();
								   }
								   if($branchphone!="")
								   {
									   $printers -> setFont(Escpos::FONT_C);
										 $printers -> text($branchphone);
										 $printers -> feed();
								   }
								  
									 
									 if($branchothers3!="")
									 {
										$printers -> setFont(Escpos::FONT_C);
										 $printers -> text($branchothers3);
										 $printers -> feed();
									 }
                                                                         
                                                                         
                                                                          if($refno != NULL)
									 {
                                                                              $printers -> feed();
										$printers -> setEmphasis(true);
										$datebill= array(
											  new datebill($floorname,"REF_NO:".$refno,$result_kots['pr_style']),
										  );
										  foreach($datebill as $datebill) {
											 
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										 	  $printers -> text($datebill);
										  }
                                                                         
                                                                         }
                                                                         else{
                                                                           $printers -> feed();
//										$printers -> setEmphasis(true);
//										$datebill1= array(
//											  new datebill($result_kots['pr_style']),
//										  );
//										  foreach($datebill1 as $datebill1) {
//											 
//											  $printers -> setFont(Escpos::FONT_C);
//											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
//										 	  $printers -> text($datebill1);
//										  }  
                                                                         }
                                                                         
//									 $printers -> feed();
									 $printers -> setEmphasis(true);
									 if($be_billnoformat=="Y")
									 {
										$billpart=explode("-",$billno);
										$datebill= array(
											  new datebill("Bill-".$billpart[1],"Date:".date("d-m-y h:ia"),$result_kots['pr_style']),
										  );
										  foreach($datebill as $datebill) {
											 
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										 	  $printers -> text($datebill);
										  }
									 }else
									 {
										 $billpart=$billno;
										$datebill= array(
											new datebill("Bill-".$billpart,"Date:".date("d-m-y h:ia"),$result_kots['pr_style']),
										);
										foreach($datebill as $datebill) {
											
											$printers -> setFont(Escpos::FONT_C);
											$printers -> setJustification(Escpos::JUSTIFY_LEFT);
										 	 $printers -> text($datebill);
										}
									 }
								   	  $printers -> setEmphasis(false);
									 //$printers -> feed();
									 
									
									
									
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }
									  
									  $printers -> setEmphasis(false);
									  $menulist= array(
										  new menulist("PRODUCT","QTY","RATE", "AMOUNT",$result_kots['pr_style']),
									  );
									  foreach($menulist as $menulist) {
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($menulist);
									  }
									  
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										   $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }
									  
									  $ct=0;
									  
		 $sql_portions  =  mysqli_query($localhost,"Select tbl_takeaway_billdetails.tab_qty,tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_slno,tbl_menumaster.mr_itemshortcode,tbl_portionmaster.pm_portionshortcode,tbl_portionmaster.pm_viewinbill,tbl_takeaway_billdetails.tab_status,tbl_takeaway_billdetails.tab_amount,tbl_takeaway_billdetails.tab_rate,tbl_takeaway_billdetails.tab_symbol_for_tax,tbl_menumaster.mr_menuid From tbl_menumaster Inner Join tbl_takeaway_billdetails On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_portionmaster.pm_id =tbl_takeaway_billdetails.tab_portion Where tbl_takeaway_billdetails.tab_billno = '".$billno."' AND (tbl_takeaway_billdetails.tab_status='Packed' || tbl_takeaway_billdetails.tab_status='KOT_Generated' || tbl_takeaway_billdetails.tab_status='Assigned' || tbl_takeaway_billdetails.tab_status='Bill_Generated' || tbl_takeaway_billdetails.tab_status='Closed' || tbl_takeaway_billdetails.tab_status='Processing')  order by tab_slno DESC"); 
									  $num_portions  = mysqli_num_rows($sql_portions);
									  if($num_portions)
									  {
											while($result_portions  = mysqli_fetch_array($sql_portions)) 
												{
													$itemotherlangname='';
													if($otherlang=='Y')
													{mysqli_query($localhost,"SET NAMES 'utf8'");
														//$sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_portions['mr_menuid']."' AND lm_language_id=(SELECT `ls_id` FROM `tbl_languages` WHERE `ls_status`='Y' )"); 
														$sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_portions['mr_menuid']."' AND lm_language_id='2'"); 
									  $num_othlamg  = mysqli_num_rows($sql_othlamg);
									  if($num_othlamg)
									  {
											while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
												{
													$itemotherlangname=$result_othlamg['lm_menu_print'];
												}
									  }
													}
													
													
													
													$ct++;
											  
												  	 $menulist=array();
													  if($be_billwithportion=="Y")
													  {
														  if($result_portions['pm_viewinbill']=="Y")
														  {
															  $menulist= array(
															  new menulist($ccl.$result_portions['mr_itemshortcode']."(".$result_portions['pm_portionshortcode'] .")".$result_portions['tab_symbol_for_tax'],$result_portions['tab_qty'],number_format($result_portions['tab_rate'],$decimal), number_format($result_portions['tab_amount'],$decimal),$result_kots['pr_style']),
															  
															  );
														  }else
														  {
															  $menulist= array(
														  new menulist($ccl.$result_portions['mr_itemshortcode'].$result_portions['tab_symbol_for_tax'],$result_portions['tab_qty'],number_format($result_portions['tab_rate'],$decimal), number_format($result_portions['tab_amount'],$decimal),$result_kots['pr_style']),
														  );
														  }
													  }else
													  {
														  $menulist= array(
														  new menulist($ccl.$result_portions['mr_itemshortcode'].$result_portions['tab_symbol_for_tax'],$result_portions['tab_qty'],number_format($result_portions['tab_rate'],$decimal), number_format($result_portions['tab_amount'],$decimal),$result_kots['pr_style']),
														  );
													  }
													  foreach($menulist as $menulist) {
														  $printers -> setFont(Escpos::FONT_C);
														   $printers -> setJustification(Escpos::JUSTIFY_LEFT);
														  $printers -> text($menulist);
														 
													  }
												  
												    if($otherlang=='Y')
													{
														  $str=$itemotherlangname;
															$randtemp=mktime(0,0,0,12,31,1979);
															$this->itemimage_create($str,$randtemp,$Arabic);
															$printers -> setJustification(Escpos::JUSTIFY_LEFT);
															$logo = new EscposImage("printlogo/printimages/".$randtemp.".png");
															$printers -> bitImage($logo);//graphics($logo);
													}
												}
									  }
									  
									  
									  
									  
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										   $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }
									  
									  $singletext= array(
									  new singletext("Items- ".$ct,$result_kots['pr_style']),
									  );
									  foreach($singletext as $singletext) {
										   $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($singletext);
									  }
									  
									  /*$printers -> setFont(Escpos::FONT_C);
									  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  $printers -> text("  Items- ".$ct);*/
									  
									  $printers -> feed();
									 
										$bilno= array(
											new bilno("Total",$total,$result_kots['pr_style']),
										);
										foreach($bilno as $bilno) {
											$printers -> setFont(Escpos::FONT_C);
											$printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										}
									  
									  
									 
									  /*if($servchrg!="0.00" )
									  {
										  $bilno= array(
											  new bilno("Service charge ",$servchrg,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
									  		$printers -> text($bilno);
										  }
									  }
									 
									  $bilno= array(
											  new bilno("TOTAL PAYABLE (Round Off if any)",($total + $servchrg),$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
									  		$printers -> text($bilno);
										  }*/
										  
										  if($cancel!="0.00")
									  {
										  $bilno= array(
											  new bilno("Cancel",$cancel,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										  }
									  }
									  if($disc!="0.00"  )//&& $fr_vbill_discount=="Y"
									  {
										  $bilno= array(
											  new bilno("Discount ".$dscval,$disc,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										  }
							  
									  }
									  if($disc!="0.00")//  && $fr_vbill_discount=="Y"
									  {
											if($final!="0.00")
											{
												$bilno= array(
													new bilno("Total : ",number_format(($total - $disc),$decimal),$result_kots['pr_style']),
												);
												foreach($bilno as $bilno) {
													$printers -> setFont(Escpos::FONT_C);
									  				$printers -> text($bilno);
												}
									
											}
									  }
									  if($servchrg_bill!="0.00"  && $fr_vbill_charge=="Y")
									  {
										  $bilno= array(
											  new bilno("Service charge (".$servchrg.")",$servchrg_bill,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										  }
									  }
									  if($servtx_bill!="0.00"  && $fr_vbill_tax=="Y")
									  {
										  $bilno= array(
											  new bilno("Service Tax (".$servtsx.")",$servtx_bill,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										  }
									  }
									  if($vat_bill!="0.00"  && $fr_vbill_vat=="Y")
									  {
										  $bilno= array(
											  new bilno("VAT (".$vat.")",$vat_bill,$result_kots['pr_style']),
										  );
										  foreach($bilno as $bilno) {
											  $printers -> setFont(Escpos::FONT_C);
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($bilno);
										  }
									  }
									  
									  //for tax field
									   $sql_tax  =  mysqli_query($localhost,"SELECT  `tbe_taxid`, `tbe_total_value`, `tbe_label` FROM `tbl_takeaway_bill_extra_tax_master`  WHERE tbe_billno='".$billno."'"); 
									  $num_tax  = mysqli_num_rows($sql_tax);
									  if($num_tax)
									  {
											while($result_tax  = mysqli_fetch_array($sql_tax)) 
												{
												   $bilno= array(
														  new bilno($result_tax['tbe_label'],$result_tax['tbe_total_value'],$result_kots['pr_style']),
													  );
													  foreach($bilno as $bilno) {
														  $printers -> setFont(Escpos::FONT_C);
														  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
														$printers -> text($bilno);
													  }
												}
									  }
										  //ends
										  if($roundoffvaluec!="0.00"  && $be_roundoff_visible=='Y')
										  {
											  $bilno= array(
														  new bilno("Round Off",$roundoffvaluec,$result_kots['pr_style']),
													  );
													  foreach($bilno as $bilno) {
														  $printers -> setFont(Escpos::FONT_C);
														  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
														$printers -> text($bilno);
													  }
										  }
										  
									  $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										  $printers -> setEmphasis(true);
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
										  $printers -> setEmphasis(false);
									  }
                                                                          
                                                                          
                                                                          
                                                                                  if($roundoffvaluec>0)
									  {
									  	$printers -> setEmphasis(true);
                                                                                $printers -> setFont(Escpos::FONT_C);
//                                                                                $printers -> textRaw(" TOTAL PAYABLE(Inc. Round Off)   "); 
                                                                                    $spc ="";
                                                                                for($i=strlen($final);$i<16;$i++){
                                                                                    $spc.= "  ";
                                                                                }
                                                                                $printers -> textRaw(" TOTAL PAYABLE ".$spc); 
									  $bilno= array(
										  new bilno("",$result_kots['pr_style']),
									  );
									  foreach($bilno as $bilno) {
										  $printers -> setEmphasis(true);
									          $printers -> setFont(Escpos::FONT_C);
										  $printers -> setTextSize(2, 1);
                                                                                  $printers -> text($final);
                                                                                  $printers -> setEmphasis(false);
                                                                                  $printers -> selectPrintMode();
                                                                                  $printers -> feed();
									  }    
                                                                                  $printers -> setFont(Escpos::FONT_A);
										  $printers -> setTextSize(1, 1);
                                                                                  $printers -> textRaw(" (Inc. Round Off)                               ");           
                                                                                  $printers -> setEmphasis(false);
                                                                                  $printers -> selectPrintMode();
                                                                                        
										  } 
								
									  else
									  {
                                                                              
										 $printers -> setEmphasis(true);
                                                                                $printers -> setFont(Escpos::FONT_C);
//                                                                                $printers -> textRaw(" TOTAL PAYABLE                     "); 
                                                                                $spc ="";
                                                                                for($i=strlen($final);$i<16;$i++){
                                                                                    $spc.= "  ";
                                                                                }
                                                                                $printers -> textRaw(" TOTAL PAYABLE ".$spc); 
									  $bilno= array(
										  new bilno("",$result_kots['pr_style']),
									  );
									  foreach($bilno as $bilno) {
										  $printers -> setEmphasis(true);
									          $printers -> setFont(Escpos::FONT_C);
										  $printers -> setTextSize(2, 1);
                                                                                  $printers -> text($final);
                                                                                  $printers -> setEmphasis(false);
                                                                                  $printers -> selectPrintMode();
                                                                                  $printers -> feed();
									  }
                                                                                        
										  } 
                                                                          
                                                                          
                                                                          //---------------address-------------------
                                                                                 
                                                                          if($mode=="HD")
									{
                                                                                $dashedline= array(
                                                                                new dashedline("-",$result_kots['pr_style']),
                                                                                );
                                                                                foreach($dashedline as $dashedline) {
                                                                                        $printers -> setEmphasis(true);
                                                                                        $printers -> setJustification(Escpos::JUSTIFY_LEFT);
                                                                                        $printers -> text($dashedline);
                                                                                        $printers -> setEmphasis(false);
                                                                                }
//										$kotheader= array(
//											new kotheader("Del Boy  ",$assigd,$result_kots['pr_style']),
//										);
//										foreach($kotheader as $kotheader) {
//											$printers -> setFont(Escpos::FONT_C);
//											$printers -> setJustification(Escpos::JUSTIFY_LEFT);
//									  		$printers -> text($kotheader);
//										}
										$printers -> setEmphasis(true);
										$kotheader= array(
											new kotheader("Customer",$cutsnam,$result_kots['pr_style']),
										);
										foreach($kotheader as $kotheader) {
											$printers -> setFont(Escpos::FONT_C);
											$printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($kotheader);
										}
                                                                                $kotheader= array(
											new kotheader("Phone",$cutsphon,$result_kots['pr_style']),
										);
										foreach($kotheader as $kotheader) {
											$printers -> setFont(Escpos::FONT_C);
											$printers -> setJustification(Escpos::JUSTIFY_LEFT);
									  		$printers -> text($kotheader);
										}
                                                                                
                                                                                
                                                                                
                                                                                $printers -> setEmphasis(false);
										if($cutsaddr!="")
										{    
                                                                                    
                                                                                   $aa=strlen($cutsaddrlmrk);
                                                                                    $f=  substr($cutsaddrlmrk,0,35);
                                                                                    $f1=substr($cutsaddrlmrk,35,70);
                                                                                    $kotheader= array(
												new kotheader("Landmark",$f,$result_kots['pr_style']),
											);
											foreach($kotheader as $kotheader) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($kotheader);
											}
                                                                                        if($aa>35){
                                                                                    $kotheader= array(
												new kotheader1("",$f1,$result_kots['pr_style']),
											);
											foreach($kotheader as $kotheader) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($kotheader);
											}
                                                                                        }
                                                                                        $b1=  strlen($cutsaddr);
                                                                                      $bb=  substr($cutsaddr,0,35);
                                                                                       $bb1=  substr($cutsaddr,35,70);
											$kotheader= array(
												new kotheader("Address",$bb,$result_kots['pr_style']),
											);
											foreach($kotheader as $kotheader) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($kotheader);
											}
                                                                                        if($b1>35){
											$kotheader= array(
												new kotheader1("",$bb1,$result_kots['pr_style']),
											);
											foreach($kotheader as $kotheader) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($kotheader);
											}
                                                                                        }
										}
										
                                                                                if($note!=""){
                                                                                   
                                                                                    $printers -> setEmphasis(true);
                                                                                    
                                                                                    $kotheader= array(
                                                                                            new kotheader("Note",$note,$result_kots['pr_style']),
                                                                                    );
                                                                                    foreach($kotheader as $kotheader) {
                                                                                            $printers -> setFont(Escpos::FONT_C);
                                                                                            $printers -> setJustification(Escpos::JUSTIFY_LEFT);
                                                                                            $printers -> text($kotheader);
                                                                                    }
                                                                                    $printers -> setEmphasis(false);
                                                                                }
//                                                                                
									}
                                                                                  //-----------------------------
                                                                          
//									   if($roundoffvaluec>0)
//									  {
//									  $bilno= array(
//											  new bilno("TOTAL PAYABLE(Inc. Round Off)",($final),$result_kots['pr_style']),
//										  );
//										  foreach($bilno as $bilno) {
//											  $printers -> setEmphasis(true);
//											  $printers -> setFont(Escpos::FONT_C);
//											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
//									  		$printers -> text($bilno);
//											$printers -> setEmphasis(false);
//										  }
//									  }else
//									  {
//										   $bilno= array(
//											  new bilno("TOTAL PAYABLE",($final),$result_kots['pr_style']),
//										  );
//										  foreach($bilno as $bilno) {
//											  $printers -> setEmphasis(true);
//											  $printers -> setFont(Escpos::FONT_C);
//											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
//									  		$printers -> text($bilno);
//											$printers -> setEmphasis(false);
//										  }
//									  }
										  
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }
									 
									
									 if($discsettlectr=="N")
									 {
										if($ctr_paymode=="Cash")
										{
											$bilno= array(
											new bilno("Payment Mode",$ctr_paymode,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											
											$bilno= array(
											new bilno("Cash",$ctr_amtpaid,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											
											$bilno= array(
											new bilno("Balance Due",$ctr_amtbal,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											 $dashedline= array(
										  new dashedline("-",$result_kots['pr_style']),
										  );
										  foreach($dashedline as $dashedline) {
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
											  $printers -> text($dashedline);
										  }
										
										}else if($ctr_paymode=="Credit / Debit Card")
										{
											$bilno= array(
											new bilno("Payment Mode","Card",$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											
											$bilno= array(
											new bilno("Card",$ctr_tranc,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											if($ctr_amtpaid!="0.00")
											{
												  $bilno= array(
												  new bilno("Cash",$ctr_amtpaid,$result_kots['pr_style']),
												  );
												  foreach($bilno as $bilno) {
													  $printers -> setFont(Escpos::FONT_C);
													  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
													  $printers -> text($bilno);
												  }
												  
												  $bilno= array(
												  new bilno("Balance Due",$ctr_amtbal,$result_kots['pr_style']),
												  );
												  foreach($bilno as $bilno) {
													  $printers -> setFont(Escpos::FONT_C);
													  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
													  $printers -> text($bilno);
												  }
											}
											 $dashedline= array(
										  new dashedline("-",$result_kots['pr_style']),
										  );
										  foreach($dashedline as $dashedline) {
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
											  $printers -> text($dashedline);
										  }
										}else if($ctr_paymode=="Complimentary")
										{
											$bilno= array(
											new bilno("Payment Mode",$ctr_paymode,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											
											$bilno= array(
											new bilno("Remarks",$ctr_comp,$result_kots['pr_style']),
											);
											foreach($bilno as $bilno) {
												$printers -> setFont(Escpos::FONT_C);
												$printers -> setJustification(Escpos::JUSTIFY_LEFT);
												$printers -> text($bilno);
											}
											 $dashedline= array(
										  new dashedline("-",$result_kots['pr_style']),
										  );
										  foreach($dashedline as $dashedline) {
											  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
											  $printers -> text($dashedline);
										  }
										}
										
									 }
									 
									 
									
									  
									
									if($reprint!="")
									{									
										$printers -> setFont(Escpos::FONT_C);
										$printers -> setJustification(Escpos::JUSTIFY_CENTER);
									  	$printers -> text($reprint);
										$printers -> feed();
									}
									
									if($footer1!="")
										 {
											 
									$printers -> setFont(Escpos::FONT_C);
									$printers -> setJustification(Escpos::JUSTIFY_CENTER);
									  	$printers -> text($footer1);
										 }
									if($footer2!="")
										 {$printers -> feed();
									$printers -> setFont(Escpos::FONT_C);
									$printers -> setJustification(Escpos::JUSTIFY_CENTER);
									  	$printers -> text($footer2);
										 }
									if(($footer1!="" || $footer2!='') && $footer3!='')
									{
										$printers -> feed();
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }
									}
									if($footer3!="")
										 {//$printers -> feed();
									$printers -> setFont(Escpos::FONT_C);
									$printers -> setJustification(Escpos::JUSTIFY_CENTER);
									  	$printers -> text($footer3);
									
										 }
									if($footer4!="")
										 {
									$printers -> feed();
									if($footer1!="" || $footer2!='' || $footer3!='' || $reprint!='')
									{
									 $dashedline= array(
									  new dashedline("-",$result_kots['pr_style']),
									  );
									  foreach($dashedline as $dashedline) {
										  $printers -> setJustification(Escpos::JUSTIFY_LEFT);
										  $printers -> text($dashedline);
									  }	
									}
									$printers -> setFont(Escpos::FONT_C);
									$printers -> setJustification(Escpos::JUSTIFY_CENTER);
									  	$printers -> text($footer4);
									
										 }
									 $printers -> feed();
									 $printers -> cut();		 
									 $printers -> close();
							}
						}
					
				}
		} 
		  
		/* ************************************TA print Bill ends******************************************************************  */
	}