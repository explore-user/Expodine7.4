<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

if($_REQUEST['set']=='loadbillfuldetails')
 {//orderno
	 $bilcount=$_REQUEST['billnos'];
	 unset($_SESSION['bilsplitorderfinal']);
	 ?>
      				<div class="bill_split_contant_table_head_left">
                    	<table  class="bill_split_center_table bill_split_center_table_left" width="100%" border="0">
                            <thead>
                              <tr>
                                <th  width="90%"><?=$_SESSION['bill_split_menu_item']?></th>
                                <th width="10%"><?=$_SESSION['bill_split_quantity']?></th>
                              </tr>
                              </thead>	
                          </table>
                    </div>
                    
                     <div class="bill_split_contant_table_head_right">
                    	<table class="bill_split_center_table" width="100%" border="0">
                            <thead>
                              <tr class="tr_clone">
                              <?php for($i=0;$i<$bilcount;$i++){ ?>
                                <th width="10%"><?=$_SESSION['bill_split_bill']?> -<?=$i+1?> <!--<div class="bill_split_center_table_chk_box"><input type="checkbox"></div>--></th>
                              <?php } ?>
                            
                              </tr>
                              
                              </thead>
                          </table>
                    </div><!--bill_split_contant_table_head_right-->
                    
                     <div class="bill_split_contant_cc" style="height: 73.8vh;min-height: 430px;">
                    	
                    <div class="bill_split_contant_scroll_right">
                     <div class="bill_split_contant_scroll_center_left">
                    	<table  class="bill_split_center_table bill_split_center_table_left" width="100%" border="0">
                        
                          <tbody>
                <?php 
				$total=0;
				 $cancel=0;
				 $count=1;
				if($_REQUEST['orderno'])
				{
				$orderno=array_unique($_REQUEST['orderno']);
				//$or=explode(",",$orderno);
				 foreach( $orderno as $number => $value)
				 { 
				
				 $tablenos='';
				 $tablenos_full=array();
				 $sql_kotlist  =  $database->mysqlQuery("SELECT tm.tr_tableno,ts.ts_tableidprefix,tm.tr_tableid from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1.ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=0;
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {   
                                                      
                                                                $table_name="";
                                                                $table_id=$result_kotlist['tr_tableid'];
                                                                $table_name=$result_kotlist['tr_tableno']; 
//                                                                $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                                                $response_table['messages'] = stream_get_contents($fptable);
//                                                                //var_dump($response_table['messages']);
//                                                                $resu_table= json_decode($response_table['messages'],true);
//                                                                //var_dump($resu_table['table_id'][0]);
//                                                                $table_count=count($resu_table['table_id']);
//                                                                //echo $table_count;
//                                                                for($m=0;$m<$table_count;$m++){
//                                                                if($table_id==$resu_table['table_id'][$m])
//                                                                {  
//                                                                    $table_id1=$resu_table['table_id'][$m];
//                                                                    $table_name=$resu_table['table_name'][$m]; 
//                                                                    //echo $table_name;
//                                                                }
//                                                            }
								  if($i==0)
								  {
									//$tablenos= $result_kotlist['tr_tableno']."(". $result_kotlist['ts_tableidprefix'].")";
									//$result_kotlist['tr_tableno']
									 $tablenos_full[]=$table_name."(". $result_kotlist['ts_tableidprefix'].")";
								  }else
								  {
									  //$tablenos=$tablenos.",". $result_kotlist['tr_tableno']."(". $result_kotlist['ts_tableidprefix'].")";
									  if (!in_array($table_name."(". $result_kotlist['ts_tableidprefix'].")",$tablenos_full))
									  {
									   $tablenos_full[]=$table_name."(". $result_kotlist['ts_tableidprefix'].")";
									  }
								  }
								  $i++;
							  }
					}
					$tablenos=implode(",",$tablenos_full); ?>
                    <tr class="listtablenames">
                            <td  width="100%"><?=$tablenos?></td>
                           <td  width="100%"></td>
                 	</tr>
                        
                    <?php  //below quary commended due to menu item duplication when split bill
//				$sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
//					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
//					if($num_kotlist){
//						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
//							  {
								  $sql_wholelist  =  $database->mysqlQuery("SELECT to1.ter_slno,mn.mr_menuname,mn.mr_menuid,pm.pm_portionname,sum(to1.ter_qty) as ter_qty,to1.ter_type,to1.ter_rate,(sum(to1.ter_qty) * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id WHERE to1.ter_orderno='$value' and to1.ter_dayclosedate='".$_SESSION['date']."' GROUP BY to1.ter_orderno,to1.ter_menuid,to1.ter_portion,to1.ter_rate,to1.ter_type "); 
								$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
								if($num_wholelist){
									  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
										  {
                                                                                        //$billsplit_menuid= trim(json_encode($result_wholelist['mr_menuid']),'""');
                                                                                        $billsplit_menuid1= $result_wholelist['mr_menuid'];
                                                                                        $billsplit_menu1= $result_wholelist['mr_menuname'];
                                                                                        
                                                                                        if($_SESSION['main_language']!='english'){
                
                                                                                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billsplit_menuid1."' and ls_language='".$_SESSION['main_language']."'");

                                                                                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                                                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                                                            $billsplit_menu1=$result_arabmenu['lm_menu_name'];
                                                                                            // $catid['name'][] = $catname;
                                                                                            //echo $catname;
                                                                                            }
                                                                                        
//                                                                                        $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$billsplit_menuid&dat=$other_lang","r");
//                                                                                        $response['messages'] = stream_get_contents($fp);
//                                                                                        //echo  $response['messages'];
//                                                                                        $resu= json_decode($response['messages'],true);
                                                                                        
											  if($result_wholelist['ter_cancel']=='N')
											  {
								  ?>
                                  <!--<input type="hidden"  value="<?=$result_wholelist['ter_qty'] ?>" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>"   ordval="<?=$value ?>" id="<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$value ?>" rateval="<?=$result_wholelist['ter_rate'] ?>" slno="<?=$result_wholelist['ter_slno']?>" count="<?=$count?>">-->
                          <tr class="tr_clone" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>"   ordval="<?=$value ?>" id="<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$value ?>" rateval="<?=$result_wholelist['ter_rate'] ?>" slno="<?=$result_wholelist['ter_slno']?>" count="<?=$count?>">
                            <td  width="90%"><?=$billsplit_menu1?></td>
                            <td width="10%"><span class="totalqtylist"><?=$result_wholelist['ter_qty']?></span><?="-(".number_format($result_wholelist['total'],$_SESSION['be_decimal'])."/-)"?><!--<input name="" style="text-align:center" class="bill_split_center_table_textbox tr_clone_add" type="text" value="" >--></td>
                          
                          </tr>
                           <?php $count++;}}} 	?>
                          <?php // }} 	?>
                          <?php } ?>
                          <?php } ?>
                        
                           
                          </tbody>
                        </table>
                        </div><!--bill_split_contant_scroll_center_left-->
                        
                        <div class="bill_split_contant_scroll_center_right">
                        	<table class="bill_split_center_table fuledittable" width="100%" border="0">
                      
                          <tbody>
                            <?php 
				$total=0;
				 $cancel=0;
				 $count=1;
				if($_REQUEST['orderno'])
				{
				$orderno=array_unique($_REQUEST['orderno']);
				//$or=explode(",",$orderno);
				 foreach( $orderno as $number => $value)
				 { 
				
				 ?>
                    <tr class="listtablenames">
                     <?php for($i=0;$i<$bilcount;$i++){ ?>
                            <td  width="10%"></td>
					<?php } ?>
                           
                 	</tr>
                    <?php //below quary commended due to menu item duplication when split bill
//				$sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
//					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
//					if($num_kotlist){
//						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
//							  {
								  $sql_wholelist  =  $database->mysqlQuery("SELECT to1.ter_slno,mn.mr_menuname,pm.pm_portionname,sum(to1.ter_qty) as ter_qty, to1.ter_type,to1.ter_rate,(sum(to1.ter_qty) * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id WHERE to1.ter_orderno='$value' and to1.ter_dayclosedate='".$_SESSION['date']."' GROUP BY to1.ter_orderno,to1.ter_menuid,to1.ter_portion,to1.ter_rate,to1.ter_type "); 
								$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
								if($num_wholelist){
									  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
										  {
											  if($result_wholelist['ter_cancel']=='N')
											  {
											  $total=$total + $result_wholelist['total'];
								  ?>
                                  <input type="hidden"  value="<?=$result_wholelist['ter_qty'] ?>" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>"  kotval="" ordval="<?=$value ?>" id="<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$value ?>" rateval="<?=$result_wholelist['ter_rate'] ?>">
                          <tr class="tr_clone" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>" kotval=""   ordval="<?=$value ?>"  rateval="<?=$result_wholelist['ter_rate'] ?>" slno="<?=$result_wholelist['ter_slno']?>">
                             <?php for($i=0;$i<$bilcount;$i++){
								
								  ?>
                            <td width="10%">
                            <input  style="text-align:center;    width: 21%;" class="bill_split_center_table_textbox changeqty eachfield<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$value ?> qtyval<?=$i?>" type="text"  menuname="<?=$result_wholelist['ter_menuid']?>" portion="<?=$result_wholelist['pm_id']?>" typeval="<?=$result_wholelist['ter_type']?>" rate="<?=$result_wholelist['ter_rate']?>">
                            <span   class="itemlisteach listamouttot<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$value ?> billval<?=$i?>" ></span>
                            <!--<div class="bill_split_center_table_chk_box"><input type="checkbox" name=""></div>--></td>
                            <?php } ?>
                          </tr>
                          <?php $count++;}}} 	?>
                          <?php // }} 	?>
                          <?php } ?>
                          <?php } ?>
                          
                          </tbody>
                        </table>
                        </div><!--bill_split_contant_scroll_center_right-->
                        
						</div><!--bill_split_contant_scroll-->
                       
                       
                         <div  class="bill_split_botttom_container">
                         	<div class="bill_split_botttom_container_left">
                                 <table class="bill_split_center_table bill_split_center_table_left" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                    <td  width="90%">
                                        <div class="billsplit_botom_left_text"><?=$_SESSION['bill_split_splittotal']?></div>
                                        <div class="billsplit_botom_rate ratesame"><?//round($total,2)?>/-</div>
                                    </td>
                                     <td width="10%">&nbsp;
                                        
                                    </td>
                                  </tr>
                                   </tbody>
                                </table>
                        	</div><!---bill_split_botttom_container_left--->
                            
                            <div class="bill_split_botttom_container_right">
                                 <table class="bill_split_center_table" width="100%" border="0">
                                    <tbody>
                                    <tr>
                                     <?php for($i=0;$i<$bilcount;$i++){ ?>
                                    <td width="10%"><div class="billsplit_botom_rate billdetails<?=$i?>" >/-</div></span></td>
                                   <?php } ?>
                                  </tr>
                                   </tbody>
                                </table>
                        	</div><!---bill_split_botttom_container_right--->
                            
                            
                        </div><!--bill_split_botttom_container-->
                      
                       
                       
                    </div><!--bill_split_contant_cc-->
                </div><!--billsplit_right_container-->
 <script type="text/javascript">
/*$(function(){
 $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_scroll_center_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
  $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_table_head_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
});*/
	$(document).ready(function(){
		 $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_scroll_center_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
  $(".bill_split_botttom_container_right").scroll(function(){
   $(".bill_split_contant_table_head_right").scrollLeft($(".bill_split_botttom_container_right").scrollLeft());
 });
		/* cancel each item by qty starts */			
	  $(".changeqty").bind('change',function() {
		   var decimal = $("#decimal").val();
                   //alert(decimal);
		  var billsplitmsg3 = ($("#billsplitmsg3").val());
		  	  var $tr    = $(this).closest('.tr_clone');
			  var $clone = $tr.clone();
			 // var valtotext_org   = $tr.attr('qtyval');//alert(valtotext_org)
			// var canceldtext=($clone.find(':text').val());alert(canceldtext)
			  
			      var portchange=($tr.attr("portionval"));
				  var menuchange=($tr.attr("menuval"));
				  var kotchange=($tr.attr("kotval"));
				  var ordchange=($tr.attr("ordval"));
				  var rate=($tr.attr("rateval"));
				   var uq=(menuchange+portchange+kotchange+ordchange);//alert(uq)
				  var orgval=parseInt(($("input[id='" + uq + "']").val())); //alert(orgval)
				  
				  //.closest('span')
				  //listamouttot
				   var selected_activities =$('.eachfield'+uq);
				  var ids = new Array();
				  var tot=0;
				  selected_activities.each(function(){
						var id_str   =  $(this).val();
					  if(id_str!='undefined' && id_str!='' && id_str!=null){
						  tot=parseInt( tot) + parseInt(id_str);
					  }
					});
					tot=parseInt(tot);
					if(tot>orgval)
					{
						$(this).val('');
						$(".error_feed").css("display","block");
						$(".error_feed").addClass("billgenration_validate");
						$(".error_feed").text(billsplitmsg3);
						$(".error_feed").delay(2000).fadeOut('slow');
					}else
					{
						  var cancelqty=$(this).val();//alert(cancelqty);
						  var amoutls=rate * cancelqty;//alert(amoutls);
						  //$(this).parent().next().find('.eachfield' + uq).val(orgval-tot);//alert(orgval-tot);
						  $(this).parent('td').find('.listamouttot'+uq).text(amoutls.toFixed(decimal));
						  
						  $(this).val(cancelqty);
						  
						  var bilct=$('#bilsplitcount').val();
						  var totalsum=0;
						  for(var i=0;i<bilct;i++)
						  {
								var selected_activities =$('.itemlisteach');
								var tots=0;
								selected_activities.each(function(){
								  var id_str   =  $(this).parent('td').find('.billval'+i).text();
								if(id_str!='undefined' && id_str!='' && id_str!=null){
									tots=parseFloat( tots) + parseFloat(id_str);
								}
							  });
							  
							   totalsum=parseFloat( tots) + parseFloat(totalsum);
							   $('.billdetails'+i).text(tots.toFixed(decimal));
							   $('.ratesame').text(totalsum.toFixed(decimal));
						  }
					  
					 /* if(canceldtext>valtotext_org)
					  {
						  alert("sorry")
					  }*/
					}
					//alert(ids)
					
					
					
			 // var final=parseInt(valtotext_org) +  parseInt(canceldtext);
		  
		  
		  });
	});

</script>    


 <?php
	 
 }else  if($_REQUEST['set']=='splitbillprocess')
 {
	  $rate			=$_REQUEST['rate'];
	  $qty			=$_REQUEST['qty'];
	  $menu			=$_REQUEST['menu'];
	  $portion		=$_REQUEST['portion'];
	  $typeval		=$_REQUEST['typeval'];
	  $bilct		=$_REQUEST['bilct'];
	  $amountid		=$_REQUEST['amountid'];
	  
	  $randbilno = rand(1000, 9999);
	  $biltemp="BS_".$_SESSION['set_billnotosplit']."_".$randbilno;
	  
	  try {
	  $database->mysqlQuery("SET @temp_billno = " . "'" . $biltemp . "'");
	  $database->mysqlQuery("SET @Original_billno = " . "'" . $_SESSION['set_billnotosplit'] . "'");
	  $message='';
		
	  //un comment
	 // $sql_table_sel  =  $database->mysqlQuery("INSERT INTO `tbl_tablebillmaster`(`bm_billno`, `bm_branchid`, `bm_orderno`, `bm_totalpax`, `bm_floorid`, `bm_dayclosedate`, `bm_status`, `bm_tableno`, `bm_discountlabel`, `bm_bill_is_split`)  select '".$biltemp."',`bm_branchid`, `bm_orderno`, `bm_totalpax`, `bm_floorid`, `bm_dayclosedate`, `bm_status`, `bm_tableno`, `bm_discountlabel`, `bm_bill_is_split`from tbl_tablebillmaster WHERE bm_billno = '".$_SESSION['set_billnotosplit']."'");
	// $sql_table_sel  =  $database->mysqlQuery("INSERT INTO `tbl_temp_tablebillmaster`(`bm_temp_billno`, `bm_main_billno`, `bm_branchid`, `bm_floorid`, `bm_subtotal`,  `bm_dayclosedate`, `bm_tableno`) select '".$biltemp."', bm_billno,`bm_branchid`,`bm_floorid`,bm_subtotal,bm_dayclosedate, bm_tableno from tbl_tablebillmaster where bm_billno = '".$_SESSION['set_billnotosplit']."'");
	 $sq=$database->mysqlQuery("CALL proc_temp_split_master(@temp_billno,@Original_billno,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	  
	
	   foreach( $menu as $number => $value)
		 { 
			 $g=array_search( $value, $menu);
			 
			//un comment
			if($qty[$g]!=0)
			{
			 try {
				 $database->mysqlQuery("SET @temp_billno = " . "'" . $biltemp . "'");
	 			 $database->mysqlQuery("SET @menuid = " . "'" . $value . "'");
				 $database->mysqlQuery("SET @portion = " . "'" . $portion[$g] . "'");
	 			 $database->mysqlQuery("SET @rate = " . "'" . $rate[$g] . "'");
				 $database->mysqlQuery("SET @qty = " . "'" . $qty[$g] . "'");
	 			 $database->mysqlQuery("SET @amount = " . "'" . $amountid[$g] . "'");
				 $database->mysqlQuery("SET @type = " . "'" . $typeval[$g] . "'");

	  			 $message='';
				 $sq=$database->mysqlQuery("CALL proc_temp_split_details(@temp_billno,@menuid,@portion,@rate,@qty,@amount,@type,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));	
			//$sql_table_sel  =  $database->mysqlQuery("INSERT INTO `tbl_temp_tablebilldetails`(`bd_temp_billno`, `bd_billslno`, `bd_menuid`, `bd_portion`, `bd_rate`, `bd_qty`, `bd_amount`, `bd_type`) VALUES('".$biltemp."',0,'".$value."','".$portion[$g]."','".$rate[$g]."','".$qty[$g]."','".$amountid[$g]."','".$typeval[$g]."')") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			
				 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  			}
			}
		 
		 }
		 
		  echo $biltemp;
		 $_SESSION['bilsplitorderfinal'][]=$biltemp;
		 
				 try {
			  $database->mysqlQuery("SET @temp_billno = " . "'" . $biltemp . "'");
			  	 $sq=$database->mysqlQuery("CALL proc_temp_split_delete(@temp_billno)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			  
			   } catch (Exception $e) {
				  $returnmsg= 'Caught exception: '.  $e;
				  $file = 'log.txt';
				  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				  echo $returnmsg; exit();
			  }
		
		 
		 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
		
 }else  if($_REQUEST['set']=='bilsplitmain')
 {
	 $bilno=$_SESSION['bilsplitorderfinal'];
	 foreach( $bilno as $number => $value)
		 { 
		 //echo $value;
		 }

 }else  if($_REQUEST['set']=='printsplitted')
 {
 }
 else  if($_REQUEST['set']=='proceedbill_split')
 {
	 $billno =$_REQUEST['billno'];
	 $noofbillssplitted =$_REQUEST['noofbillssplitted'];
	 //proc_billgenerate_split
	 //tempbillno,branchid,discount_of,discount_unit,discount,discountid,loyalty_id,no_of_split,billnumber,message
	 $discount_of_or="";
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
		$loyalityid=0; 
	 
	  try {
		  if(isset($_REQUEST['mode']))
		  {
			  if($_REQUEST['mode']=="withdiscountdrop")
			  {
				  $discount_of_or="";
				  $discount_unit_or="";
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['discamtdrop'];
				  $loyalityid=$_REQUEST['loyalityid'];
			  }else  if($_REQUEST['mode']=="withdiscounttext")
			  {
				  $discount_of_or=$_REQUEST['discount'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=""; 
				  $loyalityid=$_REQUEST['loyalityid'];
				  
			  }
                          else  if($_REQUEST['mode']=="withloyalty")
			  {
				  $discount_of_or='';
				  $discount_unit_or='';
				  $discount_or="N";
				  $discountid_or=""; 
				  $loyalityid=$_REQUEST['loyalityid'];
				  
			  }
		  }else
		  {
		$discount_of_or="";
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
		$loyalityid=0; 
		  }
		$database->mysqlQuery("SET @tempbillno = " . "'" . $billno . "'");
		$database->mysqlQuery("SET @branchid = " . "'" . $_SESSION['branchofid'] . "'");
		$database->mysqlQuery("SET @discount_of = " . "'".$discount_of_or."'");//$_REQUEST['cancelamt']
		$database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		$database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		$database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");
		$database->mysqlQuery("SET @loyalty_id = " . "'" . $loyalityid . "'");//,@discount_of,@discount_unit,@discount
		$database->mysqlQuery("SET @no_of_split = " . "'" . $noofbillssplitted . "'");
		 $billnumber='';
		$message='';
		$sq=$database->mysqlQuery("CALL proc_billgenerate_split(@tempbillno,@branchid,@discount_of,@discount_unit,@discount,@discountid,@loyalty_id,@no_of_split,@billnumber,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['billnumber'];
		}
		$_SESSION['billno']=$s;
		$billwhols=$_SESSION['finalbills'];
		foreach ($_SESSION['finalbills'] as $key => $value){
			if ($value == $billno) {
				unset($_SESSION['finalbills'][$key]);
			}
		}
		$returnmsg=$_SESSION['billno'];
		echo $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
 }else  if($_REQUEST['set']=='setwholedata')
 {
	 $bills=$_SESSION['finalbills'];
	 $bilcount=count($_SESSION['finalbills']);
	if(count($_SESSION['finalbills'])!=0)
	{
	 ?>
     
                <?php
				foreach( $bills as $number => $value)
				 {//$value='101';// coment this
					 ?>     
                <div class="take_staff_view_cc">
                 
                	<!--<div class="bill_shadow_left"></div>-->
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd"><?=$value?>
                        <div class="bill_split_head_right_chk">
                        	<!--<div class="checkboxFive">
                          <input type="checkbox" value="1" id="checkboxFiveInput" name=""/>
                          <label for="checkboxFiveInput"></label>
                          </div>-->
                        </div>
                        
                        </div>
                    </div><!--take_staff_view_head-->
                    
                     
                     
                    <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                    	
                     
                     <div class="bill_gen_new_table_head loadallhead">
                     <table class="billgenration_new_table" width="100%" border="0">
                        	<thead>
                                    <tr>
                                    <th width="10%">Sl No</th>
                                    <th width="40%">Menu Item</th>
                                    <th width="10%">Qty</th>
                                    <th width="15%">Rate</th>
                                    <th width="22%">Amount</th>
                                    
                                  </tr>
                            </thead>
                       </table>
                     </div><!--bill_gen_new_table_head-->
                     
                    <div  class="billgenration_new_table_content_container">
                    	
                          <table class="billgenration_new_table_content" width="100%" border="0">  
                            <tbody>
                                 <?php   
								 $total=0;
								 //`bd_temp_billno`, `bd_billslno`, `bd_menuid`, `bd_portion`, `bd_rate`, `bd_qty`, `bd_amount`, `bd_type` FROM `tbl_temp_tablebilldetails
				 $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_temp_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_temp_billno='".$value."' order by td.bd_billslno "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
								 $total=$total + $row_listall['bd_amount'];
								  ?>
                                  <tr>
                                    <td width="10%"><?=$row_listall['bd_billslno'] ?></td>
                                    <td width="40%"><?=$row_listall['mr_menuname'] ?></td>
                                    <td width="10%"><?=$row_listall['bd_qty'] ?></td>
                                    <td width="15%"><?=number_format($row_listall['bd_rate'],$_SESSION['be_decimal']) ?></td>
                                    <td width="22%"><?=number_format($row_listall['bd_amount'],$_SESSION['be_decimal']) ?></td>
                                  </tr>
                                 
                                  <?php } } ?>
                                                   
                            </tbody>
                            
                      </table>
                      </div><!--billgenration_new_table_content_container--->
                          
                    <div class="billsplited_view_bottom_cc">
                    	<div class="billsplited_bottom_right_rate">
                            <div class="bill_splited_total_rate"><?=number_format($total,$_SESSION['be_decimal'])?>/-</div>
                            <div class="bill_splited_total_text">Total - </div>
                        </div>
                         <div class="billsplited_bottom_right_rate" >
                            <div class="billsplited_mainbotom_right_print_btn_cc" style="margin-top:0px !important">
                                <a href="#" class="printsplittedbill" bilnosplt="<?=$value?>"><div class="billsplited_print_btn" style="    margin-left: -129px;">Print</div></a>
                            </div>
                        </div>
                       <!-- <div class="billsplited_bottom_right_rate">
                            <div class="bill_splited_total_rate">0/-</div>
                            <div class="bill_splited_total_text">Balance - </div>
                        </div>-->
                    </div><!--billsplited_view_bottom_cc-->
                        
                    </div><!--take_staff_view_cont_cc-->
                </div>
                
                
                
                
                <?php } 
				 echo '<script type="text/javascript">';
        echo 'window.location.href="billsplited_view.php"';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=billsplited_view.php" />';
        echo '</noscript>'; exit;
				
				?>
                
                <?php }else { 
				
                
                echo '<script type="text/javascript">';
        echo 'window.location.href="payment_pending.php";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=payment_pending.php" />';
        echo '</noscript>'; exit;
                
            // header("location:payment_pending.php");
            

				}
                
          ?>
          <script type="text/javascript"  src="js/bill_split_view_close.js?v=<?=md5_file('js/bill_split_view_close.js')?>"></script>  <?php      
               
  
 
 }
 ?>