<?php
include('includes/session.php'); // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();// Create a new instance
include("api_multiplelanguage_link.php");

$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

  if(isset($_REQUEST['setrate'])&& ($_REQUEST['setrate']=='hiddenrate')){
         
      $manualratenew=$_REQUEST['mnrate'] ;
      //$menuidnew=$_REQUEST['newid'];
      //$menuprcode=$_REQUEST['prcode'];
      $menu_slno=$_REQUEST['menu_slno'];
      $order_no=$_REQUEST['order_no'];
      $kot_no=$_REQUEST['kot_no'];
      
   $sql_table_selrate  =  $database->mysqlQuery("update tbl_tableorder set ter_rate='".$manualratenew."',ter_total_rate=ter_qty*'".$manualratenew."' where  ter_orderno='".$order_no."' and ter_slno='".$menu_slno."'  ");  
  
} 

 if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='loadlisthead_co')){

	 ?>
                                <table class="billgenration_new_table" width="100%" border="0">
                        	<thead>
                                    <tr>
                                    <th width="20%"><?=$_SESSION['completed_order_tableno']?></th>
                                    <th width="25%"><?=$_SESSION['completed_order_ordertime']?></th>
                                    <?php if($_SESSION['floorid']=='all'){?> <th width="20%"><?=$_SESSION['completed_order_floor_select']?></th> <?php } ?>
                                    <th width="15%"><?=$_SESSION['completed_order_orderrate']?></th>
                                    
                            </tr>
                            </thead>
                            </table>
 <?php
 }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='loadbilldetails_co')){
  
  if((isset($_REQUEST['floorid'])))
			{
				$_SESSION['floorid']=$_REQUEST['floorid'];
				$_SESSION['florids']=$_REQUEST['floorid'];
                                $floorid=  trim(json_encode($_SESSION['floorid']),'""');
			}
$orderno= array();			
if(isset($_REQUEST['ordno']))
{
	
	$orderno=$_REQUEST['ordno'];
}

 ?>

 <script type="text/javascript" src="js/bill_completedorder_select.js"></script>  
 <table class="billgenration_new_table_content" width="100%" border="0">
 <tbody>
        
 <?php
		
		
		if(isset($_SESSION['floorid']))
		{
			if($_SESSION['floorid']=="all")
			{
				$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,ts.ts_totalamount,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,fm.fr_floorid FROM tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND (ts.ts_status<>'Billed') AND (ts.ts_completed_order = 'Y') AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
			}else
			{
			        $sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,ts.ts_totalamount,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,fm.fr_floorid FROM tbl_tabledetails as ts LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND ts.ts_floorid='".$_SESSION['floorid']."'  AND (ts.ts_status<>'Billed') AND (ts.ts_completed_order = 'Y') AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
			}
		  $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{
				
					//echo $result_table_sel['ts_orderno'];
                                        $floor_name="";
                                        $floor_name=$result_table_sel['fr_floorname'];
                                            if($_SESSION['main_language']!='english'){
                
                                                $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_table_sel['fr_floorid']."' and ls_language='".$_SESSION['main_language']."'");
                                                //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                                                $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                                                if($num_arabfloor){
                                                    while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                                                    $floor_name=$result_arabfloor['f_floor_name'];
                                                }}}
//                                        $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                        //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//                                        $response_floor['messages'] = stream_get_contents($fpfloor);
//                                        //echo  $response['messages'];
//                                        $resu_floor= json_decode($response_floor['messages'],true);
//                                        //var_dump($resu_floor);
//                                        //var_dump($result_table_sel['fr_floorid']);
//                                        $floor_count=count($resu_floor['floor_id']);
//                                        //echo $floor_count;
//                                        for($f=0;$f<$floor_count;$f++)
//                                        {
//                                         if($result_table_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                            
//                                          $floor_name=$resu_floor['floor_name'][$f];
//                                           //echo $floor_name;
//                                        }  
//                                    
//                                        }
                                    
                                            $table_name="";
                                            $table_id=$result_table_sel['ts_tableid'];
                                            $table_name=$result_table_sel['tr_tableno'];
//                                              $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                              $response_table['messages'] = stream_get_contents($fptable);
//                                              //var_dump($response_table['messages']);
//                                              $resu_table= json_decode($response_table['messages'],true);
//                                              //var_dump($resu_table['table_id'][0]);
//                                              $table_count=count($resu_table['table_id']);
//                                               //echo $table_count;
//                                              for($m=0;$m<$table_count;$m++){
//                                                  if($table_id==$resu_table['table_id'][$m])
//                                                  {  
//                                                      $table_id1=$resu_table['table_id'][$m];
//                                                     $table_name=$resu_table['table_name'][$m]; 
//                                                     //echo $table_name;
//                                                  }
//                                              }
					?>
 
                                 <tr class="clickeachrowcompld <?php if(in_array($result_table_sel['ts_orderno'],$orderno)){ ?> tr_bill_gen_active<?php } ?> " name="nam_<?= $table_id ?>" pref="<?= $result_table_sel['ts_tableidprefix'] ?>" ordno="<?= $result_table_sel['ts_orderno'] ?>" tabname="<?= $table_name?>" tablename="<?= $table_name."(".$result_table_sel['ts_tableidprefix'].")" ?>"><!--<tr class="tr_bill_gen_active">-->
                                
                                    <td width="20%"><strong><?= $table_name." (".$result_table_sel['ts_tableidprefix'].")" ?></strong></td>
                                    <td width="25%"> <?= date("h:i:s",strtotime($result_table_sel['ts_dineintime'])) ?></td>
                                     <?php if($_SESSION['floorid']=='all'){?> <td width="20%"><?=$floor_name//$result_table_sel['fr_floorname']?></td> <?php } ?>
                                    <td width="15%"><?=number_format($result_table_sel['ts_totalamount'],$_SESSION['be_decimal'])?>/-</td>
                                  </tr>
                                
                   <?php }}else { 
				   ?>
                   <tr>
                   <td style="color:#F00"><?=$_SESSION['credit_settlement_error_record_display']?></td>
                   </tr>
                   <?php
				   }} ?>
                 </tbody>
                            </table>
                            
                           
 <?php
 } else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='loadbillwholelist_co')){
 
	 
	 
	 //SELECT to1.ter_slno,mn.mr_menuname,pm.pm_portionname,to1.ter_qty,to1.ter_rate,(to1.ter_qty * to1.ter_rate) from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id WHERE to1.ter_orderno='KBP111215-6' and to1.ter_dayclosedate='2015-12-11'
	 ?>
 <div class="kotcancel_reason_popup_new" style="display:none;left:-350px;top:-50px">
       
      
        
         <input type="hidden" name="slno_dynamic_menu" id="slno_dynamic_menu" />
          <input type="hidden" name="order_dynamic_menu" id="order_dynamic_menu" />
          
         <input type="hidden" name="focusedtext" id="focusedtext" />
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    

        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin" onkeypress="return numonly(event)" autofocus="true" maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnrate">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnrate">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>
 
 
 
 
 <table id="mytable" class="billgenration_new_table listorderlist" width="100%" border="0" cellspacing="5">
                            <thead>
                                  <tr>
                                    <th width="10%"><?=$_SESSION['completed_order_slno']?></th>
                                    <th width="30%"><?=$_SESSION['completed_order_menuitem']?></th>
                                    <th width="20%">Unit</th>
                                    <th width="10%"><?=$_SESSION['completed_order_orderqty']?></th>
                                    <th width="15%"><?=$_SESSION['completed_order_order_rate']?></th>
                                    <th width="12%"><?=$_SESSION['completed_order_order_amount']?></th>
                                  </tr>
                              </thead>
                              <tbody >
                               <?php    
				//SELECT tm.tr_tableno,ts.ts_tableidprefix from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1. ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='KBP111215-6' and to1.ter_dayclosedate='2015-12-11'
				 $total=0;
				 $cancel=0;
                                 $combo_entry_count=array();
				if($_REQUEST['ordno'])
				{
				$orderno=$_REQUEST['ordno'];
				$or=explode(",",$orderno);
				 foreach( $or as $number => $value)
				 { 
				
				 $tablenos='';
				 $tablenos_full=array();
                                 $table_name="";
                                 $table_prefix="";
                                 $slno=0;
                                 if($orderno!=""){
				 $sql_kotlist  =  $database->mysqlQuery("SELECT tm.tr_tableno,ts.ts_tableidprefix,tm.tr_tableid from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1.ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=0;//$table_name="";
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {     // echo "fdnhhdfdn";
                                                                $table_prefix=$result_kotlist['ts_tableidprefix'];   
                                                                $table_id=$result_kotlist['tr_tableid'];
                                                                $table_name=$result_kotlist['tr_tableno'];
                                                                

                                                      
								  $i++;
								 
								 
								  
							  }
					}
					
                                 }			  ?>
                              <tr class="selectorderno" orderno="<?=$value?>" listorders="<?=$value?>">
                                    <td class="complete_odr_table_head" colspan="5">
                                    	<div class="food_incread_add_btn" id="tablename_classadd"><?=$table_name?>(<?=$table_prefix?>)</div>
                                    	<a href="#" class="deletetablefromlist" orderlist="<?=$value?>"><div class="completed_odr_cncel_icon"></div></a>
                                    </td>
                              </tr>
                               <?php 
				 
				 
				$sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$kot_no='';
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { $kot_no=$result_kotlist['ter_kotno'];
								  ?>
                              <tr listorders="<?=$value?>">
                                    <td class="table_dtail_multisel" colspan="5"><?=$result_kotlist['ter_kotno']?></td>
                              </tr>
                               <?php 
                                $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."' and cod.cod_kot_no='".$kot_no."'"); 
//				echo "select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
//                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
//                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."' and cod.cod_kot_no='".$kot_no."'";
                                $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
					if($num_combo_list){  
						  while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
							  {    
                                                            $slno++; 
                                                            $combo_menu_array=array();
                                                           
                                                          if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                                                $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                                                $total=$total+$result_combo_list['cod_combo_total_rate'];
                                                               
                                                                $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                                               left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                               where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                                                
                                                          ?>
                             
                                                    <tr>
                                                       <td width="10%"><?=$slno?></td>
                                                       <td width="30%" ><?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?><br>
                                                           <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                                       </td>
                                                       <td width="20%">Combo</td>
                                                       <td width="10%"><?=$result_combo_list['cod_combo_qty']?></td>
                                                       <td width="15%"><?=number_format($result_combo_list['cod_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                                        
                                                       <td width="12%" ><span><?=number_format($result_combo_list['cod_combo_total_rate'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                <?php
                                                          }
                                                }}
                               
                               
                               
				$sql_wholelist  =  $database->mysqlQuery("SELECT to1.ter_unit_weight,to1.ter_rate_type,to1.ter_unit_type,um.u_name,bum.bu_name,mn.mr_manualrateentry,to1.ter_slno,mn.mr_menuname,mn.mr_menuid,pm.pm_portionname,to1.ter_qty,to1.ter_rate,(to1.ter_qty * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id left join tbl_unit_master um on um.u_id=to1.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=to1.ter_base_unit_id WHERE to1.ter_kotno='".$result_kotlist['ter_kotno']."' and to1.ter_dayclosedate='".$_SESSION['date']."' and ter_count_combo_ordering IS NULL "); 
					$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
					if($num_wholelist){
						  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
							  {     $slno++;
                                                               $billgen_menuname=$result_wholelist['mr_menuname'];
                                                               //$slno=$result_wholelist['ter_slno'];
//                                                                 $billgen_menuid= trim(json_encode($result_wholelist['mr_menuid']),'""');
//                                                                $billgen_portionid= trim(json_encode($result_wholelist['pm_id']),'""');
//                                                                
//                                                                
//								    $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$billgen_menuid&dat=$other_lang","r");
//                                                                    $response['messages'] = stream_get_contents($fp);
//                                                                    //echo  $response['messages'];
//                                                                    $resu= json_decode($response['messages'],true);
//                                                                    
//                                                                    
//                                                                    $fp_portion=fopen($apilink."/src/main_menu_display.php?set=orderedportion&ordered_portionid=$billgen_portionid&dat=$other_lang","r");
//                                                                    $response_portion['messagesportion'] = stream_get_contents($fp_portion);
//                                                                    //echo $response_portion['messagesportion'];
//                                                                    $resu_portion= json_decode($response_portion['messagesportion'],true);
                                                                     if($_SESSION['main_language']!='english'){
                
                                                                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_wholelist['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                                                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                                                    $billgen_menuname=$result_arabmenu['lm_menu_name'];
                                                                                    // $catid['name'][] = $catname;
                                                                                    //echo $catname;
                                                                                    }
								
								$temval="N"; 
								if($result_wholelist['ter_billnumber']!='')
								{
									$temp = strpos($result_wholelist['ter_billnumber'], "TEMP");
									if ($temp !== false) {
										   //echo "The string '$findme' was found in the string '$mystring'";
											$temval="Y";  
									  } else {
										   //echo "The string '$findme' was not found in the string '$mystring'";
										   $temval="Y";
									  }
								}
								if($result_wholelist['ter_cancel']=="Y"){
								$cancel=$cancel + $result_wholelist['total'];
                                                                
                                                                }
								$total=$total + $result_wholelist['total'] ;
                                                               
								$ids="pm_".$result_wholelist['pm_id'];
								  ?>
                                   <input type="hidden"  value="<?=$result_wholelist['ter_qty'] ?>" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>"  kotval="<?=$result_kotlist['ter_kotno'] ?>" ordval="<?=$value ?>" id="<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$result_kotlist['ter_kotno'].$value ?>" rateval="<?=$result_wholelist['ter_rate'] ?>" slno="<?=$result_wholelist['ter_slno']?>">
                                  <tr listorders="<?=$value?>" class="tr_clone" qtyval="<?=$result_wholelist['ter_qty'] ?>" portionval="<?=$result_wholelist['pm_id'] ?>" menuval="<?=$result_wholelist['ter_menuid'] ?>"  kotval="<?=$result_kotlist['ter_kotno'] ?>" ordval="<?=$value ?>" id="<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$result_kotlist['ter_kotno'].$value ?>" rateval="<?=$result_wholelist['ter_rate'] ?>" slno="<?=$result_wholelist['ter_slno']?>"  <?php if($result_wholelist['ter_cancel']=="Y"){ ?>style="background:#FEC7B4;" <?php } ?>>
                                   <input type="hidden" value="<?=$result_wholelist['ter_qty'] ?>" class="tr_clone_add1">
                                    <td width="10%"><?=$slno?>
                                    <?php if(($result_wholelist['ter_billnumber']=="" || $temval=="Y" ) && $_SESSION['s_singlecancel_billverify']=='Y'){ ?>
                                    
                                    

                                    
									<?php } ?>
                                    </td>
                                    <td width="30%"><?=$billgen_menuname?></td>
                                    <td width="20%"><?php if($result_wholelist['ter_rate_type']=='Portion') { echo 'Portion : '. $result_wholelist['pm_portionname'];} else{ if($result_wholelist['ter_unit_type']=='Packet'){echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];  } else if($result_wholelist['ter_unit_type']=='Loose'){ echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name']; } }?></td>
                                    <td width="10%">
                                    
                                    <?=$result_wholelist['ter_qty']?>
                                    
                                    </td>
                                    <?php
                                    
                                    
                                    
                                    if($result_wholelist['mr_manualrateentry']=='N'){
                                    ?>
                                    <td width="15%"><?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?></td>
                                    <?php
                                    } else {
                                    ?>
                                    <td width="15%" id="reftd">
                                       
                                    <input style="width:50%; text-align:center;margin-right:30px;border-color:lightcoral" type="text" name="hiddenrate" id="hiddenrate<?=$value?><?=$slno?>" value="<?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?>" >
                                    <input type="hidden" name="submitrate" id="submitrate"  onclick="return subrate('<?=$result_wholelist["ter_menuid"]?>');" >
                                    <span name="submitrate1" id="submitrate1"  onclick="return subrate1('<?=$slno?>','<?=$value?>');"><img src="img/rate.png" /> </span>
                                    </td>
                                    <?php
                                        }
                                        ?>
                                    <td width="12%" id="amtrefresh"><span   id="listamouttot<?=$result_wholelist['ter_menuid'].$result_wholelist['pm_id'].$result_kotlist['ter_kotno'].$value ?>" ><?=number_format($result_wholelist['total'],$_SESSION['be_decimal']);?></span></td>
                                  </tr>
                                  <?php } }?>
                                  <?php } }  }?>
                                  
                                  <?php }
								  if($cancel!=0)
								{
									$total=$total - $cancel;
								}else
								{
								$total=$total ;
								}
								  
                                                                
                                                          
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
								   ?>
                                  <script>
							   
								  $('#cancelrate').text((<?=$cancel?>).toFixed(<?=$_SESSION['be_decimal']?>));
								  $('#totalrate').text((<?=$total?>).toFixed(<?= $_SESSION['be_decimal']?>));
								  </script>
                                  </tbody>
                              </table>
                                
                            
                              
                               
							   <script type="text/javascript" src="js/bill_completedorder_list.js"></script> 
                                <script>
	$(document).ready(function(){
		var decimal=$('#decimal').val();	
		/* cancel each item by qty starts */			
	  $(".tr_clone_add").bind('change',function() {
		  
		  
		 
		 var letterNumber = /^[0-9]-+$/; 
		 var  orgnmbr=$(this).val();//alert(orgnmbr);
		 
		//if(!isAlphaOrParen(orgnmbr))
		if (!orgnmbr.match(/[a-zA-Z*]/i)) 
		//if(orgnmbr.match(new RegExp(^-\d*\.{0,1}\d*$)))
		 {
		 var vqtyval=parseInt($(this).val());	//alert(vqtyval);
		   if(vqtyval!=0 && (vqtyval<0) )//isNaN($(this).val()) ||  && (vqtyval.match(letterNumber))
		  {
		 
		  	
				
				
			  var $tr    = $(this).closest('.tr_clone');
			  var $clone = $tr.clone();
			  var valtotext_org   = $tr.attr('qtyval');
			  var canceldtext=($clone.find(':text').val());
			  var final=parseInt(valtotext_org) +  parseInt(canceldtext);
			  if(final>=0) 
			  {
				  var portchange=($tr.attr("portionval"))
				  var menuchange=($tr.attr("menuval"))
				  var kotchange=($tr.attr("kotval"))
				  var ordchange=($tr.attr("ordval"))
				  var rate=($tr.attr("rateval"))
				   var slno=($tr.attr("slno"))
				   var uq=(menuchange+portchange+kotchange+ordchange)
				  var orgval=($("input[id='" + uq + "']").val());//alert(final);
				 // alert(orgval);
				  if(final<=orgval)
				  {
					  $('.confrimeachcancel').css('display','block');
		  				$('.confrmation_overlay').css('display','block');
						$tr.removeAttr('qtyval');
						$tr.attr('qtyval',final);
						var finalrate=final *  rate;
						$("span[id='listamouttot" + uq + "']").text(finalrate.toFixed(2))
						$tr.after($clone);
						$clone.find(':text').val($(this).val());
						$clone.find('td:first').text('');
						$clone.css('background','#FEC7B4');
						$clone.addClass('cancel_clr');
						$clone.find('a').addClass('a_demo_four_active');
						$clone.find(':text').prop('disabled', true);
						var qtychange=($(this).val())
						var qtyc	  =	 qtychange.split("-");
						$(this).val(final);
						var cnct	  =	 canceldtext.split("-");
						
						var cancelrate=cnct[1] *  rate;
						$clone.find('td:last').text(cancelrate);
						
						var cancelfl=parseFloat($('#cancelrate').text());
						var tc=parseFloat(cancelfl) + parseFloat(cancelrate);
						$('#cancelrate').text(tc.toFixed(2));
						
						var totalfl=parseFloat($('#totalrate').text());
						var ct=parseFloat(totalfl) - parseFloat(cancelrate);
						$('#totalrate').text(ct.toFixed(decimal));
						
						var totc=parseFloat(rate) *  parseFloat(qtyc[1]);
						if($('#totalcancelrate').val()!="" || $('#totalcancelrate').val()!="0")
						{
						var fn=parseFloat($('#totalcancelrate').val()) + parseFloat(totc);
						}else
						{
							var fn= parseFloat(totc);
						}
						 $('#totalcancelrate').val(fn.toFixed(2));
						
						$('#hid_menuchange').val(menuchange);
						$('#hid_portchange').val(portchange);
						$('#hid_kotchange').val(kotchange);
						$('#hid_ordchange').val(ordchange);
						$('#hid_final').val(final);
						$('#hid_slno').val(slno);
						$('#hid_qtychange').val(vqtyval);
				  }else
				  {//alert("h");
					  $tr.find(':text').val(valtotext_org);
					   $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text("Check Quantity");
				$(".error_feed").delay(2000).fadeOut('slow');
				  }
			  }
			  else
			  {//alert("g");
				  $tr.find(':text').val(valtotext_org);
				  $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text("Check Quantity");
				$(".error_feed").delay(2000).fadeOut('slow');
			  }
		  }else
		  {
			  $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text("Check Quantity");
				$(".error_feed").delay(2000).fadeOut('slow');
		  }
		 }else
		 {
			  $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text("Special characters");
				$(".error_feed").delay(2000).fadeOut('slow');
		 }
	  
		
	  });
	  /* cancel each item by qty  ends*/			
$('.calculator_settle').click( function(event) {
            //alert('hi');
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
		var focused=$('#focusedtext').val();
               //alert(focused);
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
                //alert(org.length);
			if(calval>=0)
			{   
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
		
		
		
	});



$('#kotcancel_reason_popup_new_proceed_btnrate').click(function(){
 
  
     var pin =  $('#pin').val();
              //alert(pin);
              if(pin !=''){
              $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		function(data)
		{
                    data=$.trim(data);
                    if(data!="NO")
                    {
               //var prcode=$('#randomprcode').val();
              //var randid=$('#randomid').val();
              var menu_slno=$('#slno_dynamic_menu').val();
              var order_no=$('#order_dynamic_menu').val();
              //var kot_no=$('#kotno_dynamic_menu').val();
              //alert(randid);
               var rt=$('#hiddenrate'+order_no+menu_slno).val();
              
              
      
      
      
      
  var datastringnew="setrate=hiddenrate&mnrate="+rt+"&menu_slno="+menu_slno+"&order_no="+order_no;
  //alert(datastringnew);
       
       $.ajax({
        type: "POST",
        url: "load_completedorder.php",
        data: datastringnew,
        success: function(data)
        {
         
    //location.reload();
    
    
    
    var ord=$('.selectorderno').attr('orderno');
   
    
     var datastringnew1="set=loadbillwholelist_co&ordno="+ord;
 $.ajax({
        type: "POST",
        url: "load_completedorder.php",
        data: datastringnew1,
        success: function(data)
        {
         
    //location.reload();
     
    $('#listwholedetailslist').html(data);
                                                          
                                                              
        }
       
          
    });
                                                          
                                                              
        }
       
          
    });
    
  $('.kotcancel_reason_popup_new').css('display','none');
                    $('.confrmation_overlay').css('display','none');
              
              
            var  tname=$('#tablename_classadd').html();
           var tnamecomplete=$('#complete_tablename').html();
          
              
               //location.reload();
             
                  
            
                }else{
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED!");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                    }
});
}
              });

$('#kotcancel_reason_popup_new_cancel_btnrate').click(function(){
  $('.kotcancel_reason_popup_new').css('display','none');
                    $('.confrmation_overlay').css('display','none');
});





		}); 
                
                
 function numonly(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
     }


 $('#pin').keypress(function(ev){
     
            if(ev.keyCode == 13){
                ev.stopImmediatePropagation();
                $('#kotcancel_reason_popup_new_proceed_btnrate').trigger('click');
            }
        });



        function subrate1(slno,order){
            
           //alert(slno);
           //alert(order);
         $('#pin').focus();
         //$('#randomid').val(f);
         $('#slno_dynamic_menu').val(slno);
          //$('#kotno_dynamic_menu').val(kot);
           $('#order_dynamic_menu').val(order);
          //$('#randomprcode').val(p);
        
         $('.kotcancel_reason_popup_new').css('display','block');
         $('.confrmation_overlay').css('display','block');         
            $('#pin').focus();    
                
    }       
           
           
           
    function isInteger(n) {
        return /^[0-9]-+$/.test(n);
    }
    
  function isAlphaOrParen(str) {
      return /^[a-zA-Z()]+$/.test(str);
   }
	</script>
                               
                                
<?php

 } else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='proceedbill')){
 
             $totname='';
             
             if(isset($_REQUEST['billnum']) && $_REQUEST['billnum']!=''){
             $billnum=$_REQUEST['billnum'];
             }else{
                 $billnum=""; 
             }
             
              if(isset($_REQUEST['billname']) && $_REQUEST['billname']!=''){
             $billname=$_REQUEST['billname'];
             }else{
                 $billname=""; 
             }
             
              if(isset($_REQUEST['billgst']) && $_REQUEST['billgst']!=''){
             $billgst=$_REQUEST['billgst'];
             }else{
                 $billgst=""; 
             }
             
             
        if(!empty($_REQUEST['tabname'])){
            
	    $totname  =  array_unique($_REQUEST['tabname']);
            $tablecount=count($totname);
            $tb='';
            
           for($i=0;$i<$tablecount;$i++)
              {
                     if($i==0)
                     {
                             $tb= $totname[$i];
                     }else
                     {
                             $tb=$tb.",". $totname[$i];
                     }
              }
              
             }
             
        
             
	 if(isset($_REQUEST['loyalityid'])&& $_REQUEST['loyalityid']!='')
	 {      
	 	$loyalityid=$_REQUEST['loyalityid'];
	 }else
	 {
		$loyalityid=0; 
	 }
	
	 $j=0;$totalcancel=0;
	 $orderarray= array();
	 $orderarray=array_unique($_REQUEST['ord']);
	 $ct=count($orderarray);
	 $final="";
         
	 for($i=0;$i<$ct;$i++)
	 {
		 if($i==0)
		 {
			 $final=$orderarray[$i];
                         $final1="'".$orderarray[$i]."'";
		 }else
		 {
			 $final=$final .",". $orderarray[$i];
                         $final1=$final1 .","."'".$orderarray[$i]."'";
		 }
	 }
         
	  $orderfinal=rtrim($final,',');
	  $branch=$_SESSION['branchofid'];
	  $cancel=0;
	  $returnmsg='';
          
	  try {
		  $discount_of_or='';
		  $discount_unit_or='';
		  $discount_or='';
		  $discountid_or='';
		  if(isset($_REQUEST['type']))
		  {
			  if($_REQUEST['type']=="drop")
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['discount'];
			  }else if($_REQUEST['type']=="text")
			  {
				 $discount_of_or=$_REQUEST['discount'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=0; 
			  }else
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="N";
				  $discountid_or=0; 
			  }
		  }else
		  {
			  $discount_of_or=0;
			  $discount_unit_or=0;
			  $discount_or="N";
			  $discountid_or=0; 
		  }
                  
//                      

                 if(isset($_REQUEST['redeem_amount']) && $_REQUEST['redeem_amount']!=""){
                     
                     $redeem=$_REQUEST['redeem_amount'];
                     
                 }else{
                     
                     $redeem=0;
                 }
                 
//                        echo $orderfinal.','.
//                        $branch.','.
//                        $discount_of_or.','.
//                        $discount_unit_or.','.
//                        $discount_or.','.
//                        $discountid_or.','.
//                        $tb.','.
//                        $redeem;    
                         
		  $database->mysqlQuery("SET @orderno = " . "'" . $orderfinal . "'");
		  $database->mysqlQuery("SET @branchid = " . "'" . $branch . "'");
		  //$database->mysqlQuery("SET @cancelamt = " . "'" . $cancel . "'");
		  $database->mysqlQuery("SET @discount_of = " . "'" . $discount_of_or . "'");
		  $database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		  $database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		  $database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");//,@discount_of,@discount_unit,@discount
		  $database->mysqlQuery("SET @tableno = " . "'" . $tb . "'");
                  $database->mysqlQuery("SET @redeem_amount = " . "'" . $redeem . "'");
                  
		  //$database->mysqlQuery("SET @loyalty_id = " . "'" . $loyalityid . "'");
		  $billnumber='';
		  $Message='';
                  
                  $sql_table_status  =  $database->mysqlQuery("SELECT ts_orderno FROM `tbl_tabledetails` WHERE `ts_orderno` IN ($final1) and `ts_status` = 'Billed'"); 
                    $num_table_status  = $database->mysqlNumRows($sql_table_status);
                    if($num_table_status)
                    {
                        
                    }
                    else{
                        
                        $sq=$database->mysqlQuery("CALL proc_billgenerate(@orderno,@branchid,@discount_of,@discount_unit,@discount,@discountid,@tableno,@redeem_amount,@billnumber,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
                                                                          
                        $rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber,@Message as Message' );
                        while($row = mysqli_fetch_array($rs))
                        {
                            
                        $s= $row['billnumber'];
                        $returnmsg=$row['Message'];

                        }
                        
                     $query32=$database->mysqlQuery(" Update tbl_tablebillmaster set bm_login='".$_SESSION['expodine_id']."', bm_cname='".$billname."',bm_cnumber='".$billnum."',bm_gst='".$billgst."' WHERE bm_billno='".$s."' ");  
		    
                     $query323=$database->mysqlQuery(" Update tbl_tablebilldetails set bd_dayclose_in='".$_SESSION['date']."' WHERE bd_billno='".$s."' ");  
                     
                     $_SESSION['billno']=$s;
                   
                    }
                 
                    
       if($_SESSION['qr_db_set']!=''){             
                    
        $qr_order='';           
        $sql_listall5  =  $database->mysqlQuery("SELECT ter_qr_order from tbl_tableorder  WHERE ter_dayclosedate='".$_SESSION['date']."'  and ter_billnumber='".$_SESSION['billno']."' group by ter_billnumber limit 1   "); 
	$num_listall5  = $database->mysqlNumRows($sql_listall5);
	if($num_listall5){  $default_loy='Y';
	while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
	 {	
              $qr_order=$row_listall5['ter_qr_order'];
         }
        }    
        
        
        if($qr_order!=''){
            
         $date=date('Y-m-d H:i:s');
         $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR); 
           
         $sql_gen1 =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_ready='Y' ,td_local_ready_time='$date' "
                 . " where tq_branch='".$_SESSION['firebase_id']."' and tq_order_no='".$qr_order."' ");  
         
          $sql_gen =  mysqli_query($localhost1,"update tbl_qr_order_details set tq_bill_printed='Y' ,tq_print_time='$date' , "
               . " tq_printed_by='".$_SESSION['expodine_id']."' where tq_branch='".$_SESSION['firebase_id']."' and tq_order_no='".$qr_order."' ");
          
          $sql_gen =  mysqli_query($localhost1,"select tc.tu_name,tc.tu_number from tbl_qr_order_details td "
                  . " left join tbl_qr_user_detail tc on td.tq_user = tc.tu_number   where td.tq_localy_ready='Y' "
                  . " and td.tq_cancelled!='Y' AND td.tq_branch='".$_SESSION['firebase_id']."' and td.tq_order_no='".$qr_order."' limit 1"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                    
          $sql_listall5  =  $database->mysqlQuery("update tbl_tablebillmaster set bm_qr_orderno='$qr_order', bm_cname='".$result_cat_s_tc['tu_name']."',bm_cnumber='".$result_cat_s_tc['tu_number']."' "
          . "  WHERE bm_dayclosedate='".$_SESSION['date']."'  and bm_billno='".$_SESSION['billno']."'    ");                      
                        }
                        }
          
       }    

       }    
       
       
    ///di loyalty popup //
    
    if( isset($_REQUEST['loy_number']) && $_REQUEST['loy_number']!='' && $_REQUEST['loy_number']!='undefined' && $_REQUEST['loy_name']!=''){   
           
     $sql_listall5  =  $database->mysqlQuery("SELECT ly_mobileno from tbl_loyalty_reg  WHERE ly_mobileno='".$_REQUEST['loy_number']."'  "); 
     $num_listall5  = $database->mysqlNumRows($sql_listall5);
     if(!$num_listall5){ 
       $sql_taxdetails  =  $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`,ly_branchid,ly_totalvisit,ly_loy_login,ly_module,ly_default) VALUES ('".$_REQUEST['loy_name']."','".$_REQUEST['loy_number']."','1','0','1','DI','Y')");
      
         $billnum=$_REQUEST['loy_number'];
   
     }
    }
     
    
  
     $default_loy='';  $default_loy_id=''; $bill_amount=0; $rd_loy_pt=0;  $pt_add=0; $rd_loy_amt=0; $def_name='';
      $sql_listall  =  $database->mysqlQuery("SELECT ly_id,ly_firstname from tbl_loyalty_reg  WHERE ly_mobileno='$billnum'  and  ly_module='DI' and ly_default='Y' limit 1 "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){  $default_loy='Y';
	while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
		{
           
           $default_loy_id=$row_listall['ly_id'];
           $def_name=$row_listall['ly_firstname'];
                    
        $sql_listall5  =  $database->mysqlQuery("SELECT bm_finaltotal from tbl_tablebillmaster  WHERE bm_billno='".$_SESSION['billno']."' "); 
	$num_listall5  = $database->mysqlNumRows($sql_listall5);
	if($num_listall5){  $default_loy='Y';
	while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
	 {	
            
            $bill_amount=$row_listall5['bm_finaltotal'];
          
        }
        }    
        
                                $amount_rule_add=1; $point_rule_add=1;
                                $sql_desg_nos1190="select lyp_point,lyp_amount from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }
         
     $pt_add= ($bill_amount/$amount_rule_add)*$point_rule_add;
                    
     $date= date('Y-m-d H:i:s');
        
      $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['billno']));
          
          
       if($pt_add>0){
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim($pt_add));
       }
      
       if($rd_loy_pt>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($rd_loy_pt));
       }
       
        if($rd_loy_amt>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($rd_loy_amt));
        }
        
          if($_REQUEST['point_redeem']>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_redeem']));
       }
       
        if($_REQUEST['redeemamount']>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['redeemamount']));
        }
       
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($bill_amount));
         
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($default_loy_id));
      
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim('CS'));
      
     $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
     if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        }
         
        if($rd_loy_pt>0){
            
           $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'".$rd_loy_pt."') where ly_id='".$default_loy_id."'");  
           
        }
        
        if($pt_add>0){ 
          $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'".$pt_add."'),ly_totalvisit=ly_totalvisit+1  where ly_id='".$default_loy_id."'");
       
        }
        
        $a="8.8.8.8"; $rd=''; $ad='';
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            $sms_number='';
	    $sms_text="";
		   
                   if($rd_loy_pt>0){
                       $rd="You have redeemed ".number_format($rd_loy_pt,$_SESSION['be_decimal'])." points.";
                   }
                   
                    if($pt_add>0){
                       $ad="You have earned ".number_format($pt_add,$_SESSION['be_decimal'])." points.";
                   }
                   
                $common="(DI) Visit Again . Thank You .\n".$_SESSION['s_branchname']	;
		
		$l_name=$def_name;
		$sms_text="Congratulations ".$l_name.".\n".$rd."\n".$ad."\n".$common;
                $date_sms = date('Y-m-d H:i:s');
                 
       $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('".$sms_text."','".$date_sms."','".$_SESSION['expodine_id']."')");  
       
                $sms_number=$billnum;
		
		$message=urlencode($sms_text);
	
            }
                    
                 }
                 
      }else{       
                      
             ///////   loyalty reddem add starts  ///////            
                     
        if(isset($_REQUEST['point_redeem']) && ($_REQUEST['point_redeem']>0 || $_REQUEST['point_add']>0) ){              
        $date= date('Y-m-d H:i:s');
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['billno']));
          
          
       if($_REQUEST['point_add']>0){
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_add']));
       }
      
       if($_REQUEST['point_redeem']>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_redeem']));
       }
       
        if($_REQUEST['redeemamount']>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['redeemamount']));
        }
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['billamount']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
    
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['id_loy']));
      
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim('DI'));
        
    $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
    if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        }
      
        if($_REQUEST['point_redeem']>0){
            
           $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'".$_REQUEST['point_redeem']."') where ly_id='".$_REQUEST['id_loy']."'");  
           
        }
        
        if($_REQUEST['point_add']>0){ 
          $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'".$_REQUEST['point_add']."'),ly_totalvisit=ly_totalvisit+1  where ly_id='".$_REQUEST['id_loy']."'");
       
        }
        
        }               
                    
///////////  loyalty ends  ////////////
        
          }
        
         $sql_menulist= "SELECT ly_id,ly_firstname,ly_mobileno,ly_gst FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_mobileno='$billnum' and ly_module='DI' order by ly_id desc limit 1 ";
						 $sql_menus  =  $database->mysqlQuery($sql_menulist); 
						$num_menus  = $database->mysqlNumRows($sql_menus);
						if($num_menus){
						while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						 {
                                               
         $query32=$database->mysqlQuery(" Update tbl_tablebillmaster set bm_loy_id='".$result_menus['ly_id']."', bm_cname='".$result_menus['ly_firstname']."',bm_cnumber='".$result_menus['ly_mobileno']."',bm_gst='".$result_menus['ly_gst']."' WHERE bm_billno='".$_SESSION['billno']."' ");  
         
         
         $query328=$database->mysqlQuery("update  tbl_loyalty_reg set ly_default='N',ly_module=''  where ly_mobileno='$billnum' and ly_module='DI' ");
        
           }}
        
       $sql_menulist= "SELECT ly_id,ly_firstname,ly_mobileno,ly_gst FROM  tbl_loyalty_reg  WHERE  ly_mobileno='$billnum' and ly_module='DI' order by ly_id desc limit 1 ";
						 $sql_menus  =  $database->mysqlQuery($sql_menulist); 
						$num_menus  = $database->mysqlNumRows($sql_menus);
						if($num_menus){
						while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						 {
                                                   
         $query32=$database->mysqlQuery(" Update tbl_tablebillmaster set bm_loy_id='".$result_menus['ly_id']."', bm_cname='".$result_menus['ly_firstname']."',bm_cnumber='".$result_menus['ly_mobileno']."',bm_gst='".$result_menus['ly_gst']."' WHERE bm_billno='".$_SESSION['billno']."' ");  
         
                                                }}
        
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg;
                  exit();
	  }

	 echo $returnmsg;
	 
 } else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='proceedbilling')){
 
	$ord   =  $_REQUEST['finalorder'];
	$brch  =  $_SESSION['branchofid'];
	$tabno =  $_REQUEST['tabno'];
	$pref  =  $_REQUEST['pref'];
	$totname  =  $_REQUEST['totname'];
	$tablecount=count($totname);
	$tb='';
   for($i=0;$i<$tablecount;$i++)
	  {         
                if($i==0)
		 {
			$tb= $totname[$i];
		 }else
		 {
			 $tb=$tb.",". $totname[$i];
		 }
	  }
	$k=0; 
	foreach( $ord as $number => $value){ 
	if($k==0)
	{
		$order=$value;
	}else
	{
		$order=$order .",". $value;
	}
	$k++;
	}
	 $returnmsg=''; //echo $tb;
	  try {
		 $discount_of_or="";
		  $discount_unit_or="";
		  $discount_or="N";
		  $discountid_or=""; 
		 $loyalityid=0;   
		$database->mysqlQuery("SET @orderno = " . "'" . $order . "'");
		$database->mysqlQuery("SET @branchid = " . "'" . $brch . "'");
		$database->mysqlQuery("SET @cancelamt = " . "'0'");//$_REQUEST['cancelamt']
		$database->mysqlQuery("SET @discount_of = " . "'" . $discount_of_or . "'");
		$database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		$database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		$database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");//,@discount_of,@discount_unit,@discount
		$database->mysqlQuery("SET @tableno = " . "'" . $tb . "'");
		 $database->mysqlQuery("SET @loyalty_id = " . "'" . $loyalityid . "'");
		$billnumber='';
		$Message='';
		$sq=$database->mysqlQuery("CALL proc_billgenerate(@orderno,@branchid,@billnumber,@cancelamt,@discount_of,@discount_unit,@discount,@discountid,@tableno,@loyalty_id,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber,@Message as Message' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['billnumber'];
		$returnmsg=$row['Message'];
		}
		$_SESSION['billno']=$s;
		echo "";
		//echo $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	 
          
          
             
          
          
	?>
  
                                
                                <?php
	
 }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='deleteachitem')){
 
	  $menu=$_REQUEST['menu'];
	  $sln=$_REQUEST['sln'];
	  $kot=$_REQUEST['kot'];
	  $qty=$_REQUEST['qty'];
	  $ordernumber=$_REQUEST['ordernumber'];
  
	   if(($_REQUEST['st']=="cancel"))
	  {
		   $sql_table_sel1_sel1  =  $database->mysqlQuery("UPDATE  tbl_tableorder set ter_cancel='Y' where ter_kotno='".$kot."' and ter_menuid='".$menu."' and ter_slno='".$sln."' and ter_qty='".$qty."' and ter_orderno='".$ordernumber."'");
		   if(isset($_REQUEST['auth']))
		   {
			  $reason=$_REQUEST['reasontext'];
			  $secret=$_REQUEST['secretkey'];
			  $staff=$_REQUEST['stafflist'];
			  $expodineid=$_SESSION['expodine_id']; 
			  
			  $database->mysqlQuery("UPDATE  tbl_tableorder set ter_cancelledby_careof='".$staff."',ter_cancelledreason='".$reason."',ter_cancelledsecretkey='".$secret."',ter_cancelledlogin='".$expodineid."' where ter_kotno='".$kot."' and ter_menuid='".$menu."' and ter_slno='".$sln."' and ter_qty='".$qty."' and ter_orderno='".$ordernumber."'");
			  
			  $dateexp=date("Y-m-d H:i:s");
				$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staff."' AND  ser_employeestatus='Active'"); $rrt='';
			  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
			  if($num_table3)
			  {
				  while($row = mysqli_fetch_array($sql_table_sel3))
					{
					$rrt= $row['ser_cancelwithkey'];
					}
			  }
			if($rrt=="Y")
				{  
					$result= "yes";
					$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$secret."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
			  }else
			  {
					$result= "no";
					$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($secret)."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
			  }
	
			  
			  
		   }
		   
	  }else if(($_REQUEST['st']=="enable"))
	  {
		  $sql_table_sel1_sel1  =  $database->mysqlQuery("UPDATE  tbl_tableorder set ter_cancel='N' where ter_kotno='".$kot."' and ter_menuid='".$menu."' and ter_slno='".$sln."' and ter_qty='".$qty."' and ter_orderno='".$ordernumber."'");
	  }
	 
 }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='canceleacitemqty')){

	if(isset($_REQUEST['stafflist']))
	{
	$qty=explode("-",$_REQUEST['qtychange']);
	$insertion['ch_orderno'] 			=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ordchange']);
	$insertion['ch_orderslno'] 			=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['slno']);
	$insertion['ch_cancelled_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$qty[1]);
	$insertion['ch_cancelledby_careof'] =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['stafflist']);
	$insertion['ch_kotno'] 				=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['kotchange']);
	$insertion['ch_cancelledreason'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));
	$insertion['ch_cancelledsecret'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['secretkey']);
	$insertion['ch_cancelledlogin'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']);
	$insertid              			=  $database->insert('tbl_tableorder_changes',$insertion);
	
	
		$dateexp=date("Y-m-d H:i:s");
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
		$rrt= $row['ser_cancelwithkey'];
		}
  }
if($rrt=="Y")
	{  
		$result= "yes";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }else
  {
	  	$result= "no";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }
	
	
	
	
	
	
	}
	else
	{
		
		$qty=explode("-",$_REQUEST['qtychange']);
	$insertion['ch_orderno'] 			=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ordchange']);
	$insertion['ch_orderslno'] 			=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['slno']);
	$insertion['ch_cancelled_qty'] 		=  mysqli_real_escape_string($database->DatabaseLink,$qty[1]);
	/*$insertion['ch_cancelledby_careof'] =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['stafflist']);*/
	$insertion['ch_kotno'] 				=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['kotchange']);
/*	$insertion['ch_cancelledreason'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));*/
	/*$insertion['ch_cancelledsecret'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['secretkey']);*/
	$insertion['ch_cancelledlogin'] 	=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']);
	$insertid              			=  $database->insert('tbl_tableorder_changes',$insertion);
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	//And ter_menuid='".$_REQUEST['menuchange']."' And ter_kotno='".$_REQUEST['kotchange']."' And ter_portion='".$_REQUEST['portchange']."' And ter_branchid='".$_SESSION['branchofid']."'
	$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_tableorder   WHERE ter_orderno='".$_REQUEST['ordchange']."'  AND ter_slno='".$_REQUEST['slno']."'"); 
	$num_table1  = $database->mysqlNumRows($sql_table_sel1);
	if($num_table1)
	{
		  while($rs  = $database->mysqlFetchArray($sql_table_sel1)) 
			  {
				  $tercanel="N";
				  if($_REQUEST['final']==0)
				  {
					   $tercanel="Y";
				  }
				  $database->mysqlQuery("UPDATE tbl_tableorder SET ter_qty='".$_REQUEST['final']."',ter_cancel='$tercanel' WHERE ter_orderno='".$_REQUEST['ordchange']."'  AND ter_slno='".$_REQUEST['slno']."'");
				  
				  
			  }
			  echo "ok";
	}else
	{
		echo "sorry";
	}
	
	
	
}else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='closedirectfuncion_co')){

	$returnmsg='';
	$returnmsg_err='';$modes='';
	if($_SESSION['s_ta_directclosefirst']=='Y') 
	 {$s='';
	 $database->mysqlQuery("SET @billno = " . "'" . $_SESSION['billno'] . "'");
	 $message='';
	 if(isset($_REQUEST['setmode']))
	 {
		 $modes=$_REQUEST['setmode'];
	 }else
	 {
	 $modes='BC';
	 }
	 $database->mysqlQuery("SET @mode = " . "'" . $modes . "'");
	 $s='';
	  try {
		 $sqs=$database->mysqlQuery("CALL proc_billclose(@billno,@message,@mode)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
		 $rss = $database->mysqlQuery( 'SELECT @message AS message' );
		  while($rows = mysqli_fetch_array($rss))
		  {
		  $s= $rows['message'];
		  }
		  $returnmsg=$s;
		   $returnmsg_err="";
		   echo  $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg_err= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg_err.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg_err;exit();
		 // echo $_SESSION['s_ta_directclosefirst'];
	  }
	 
	 }else 
	 {
		 if(isset($_REQUEST['setmode']))
		 {
				 $_SESSION['billno']=$_REQUEST['bilno'];
				$s='';
			 $database->mysqlQuery("SET @billno = " . "'" . $_SESSION['billno'] . "'");
			 $message='';
			 $database->mysqlQuery("SET @mode = " . "'" . $_REQUEST['setmode'] . "'");
			 // if(isset($_REQUEST['setmode']))
			 //{
				// $mode=$_REQUEST['setmode'];
			 //}else
			 //{
			//	 $mode='BC';
			 //}
			 
			 
			  try {
				 $sqs=$database->mysqlQuery("CALL proc_billclose(@billno,@message,@mode)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
				 $rss = $database->mysqlQuery( 'SELECT @message AS message' );
				  while($rows = mysqli_fetch_array($rss))
				  {
				  $s= $rows['message'];
				  }
				  $returnmsg=$s;
				   $returnmsg_err="";
				  //echo $returnmsg;
			  } catch (Exception $e) {
				  $returnmsg_err= 'Caught exception: '.  $e;
				  $file = 'log.txt';
				   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg_err.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				  echo  $returnmsg_err;exit();
			  }
	 
		 }
	 }
	
         
} else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='msg_in_loyalty')){
    
     if($_REQUEST['point_redeem']>0 || $_REQUEST['point_add']>0){
       
         $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
      $rd="";
        $ad="";   
                $sms_number='';
		$sms_text="";
		$be_sms_username="";
		$be_sms_apipassword="";
		$be_sms_senderid="";
                $be_sms_domainid="";
                $be_sms_method='';
                $be_sms_priority='';
	        $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $be_sms_username			=$result_general['be_sms_username'];
					     $be_sms_apipassword		=$result_general['be_sms_apipassword'];
				             $be_sms_senderid			=$result_general['be_sms_senderid'];
		                              $be_sms_domainid			=$result_general['be_sms_domainid'];
                                              $be_sms_priority                  =$result_general['be_sms_priority'];                                                                                                           $be_sms_priority			=$result_general['be_sms_priority'];
                                              $be_sms_method                    =$result_general['be_sms_method'];                                                                                                              $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
                  
                   if($_REQUEST['point_redeem']>0){
                       $rd = "You have redeemed ".number_format($_REQUEST['point_redeem'],$_SESSION['be_decimal'])." points.";
                   }
                   
                   
                    if($_REQUEST['point_add']>0){
                       $ad = " You have earned ".number_format($_REQUEST['point_add'],$_SESSION['be_decimal'])." points.";
                    }
                   
                $common=" (DI)Visit Again . Thank You .\n".$_SESSION['s_branchname']	;
		
		$l_name=$_REQUEST['loy_name'];
		$sms_text="Dear ".$l_name.".\n".$rd."\n".$ad."\n".$common;
                $date_sms = date('Y-m-d H:i:s');
                 
   $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('".$sms_text."','".$date_sms."','".$_SESSION['expodine_id']."')");  
       
                $sms_number=$_REQUEST['loy_number'];
		$api_password=$be_sms_apipassword;
		$smstype = $be_sms_method; 
                $username=urlencode($be_sms_username);
		$sender=urlencode($be_sms_senderid);
		$message=urlencode($sms_text);
		$domain=urlencode($be_sms_domainid);
                $route=urlencode($be_sms_priority);
		
              
                
		 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
			
		$fp = fopen("http://$domain/pushsms.php?$parameters", "r");
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
       
        }   
 }
}
 else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='proceed_after_dis')){
 
 
    
  $redeem=0;
  $sql_general =  $database->mysqlQuery("Select bm_redeem_amount from tbl_tablebillmaster where bm_billno ='".$_REQUEST['billno']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $redeem			=$result_general['bm_redeem_amount'];
					                                                                                                            
                                                 
                  }
                }
                
                
          
               
			  if($_REQUEST['type']=="drop")
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['discount'];
			  }else
			  {
				 $discount_of_or=$_REQUEST['discount'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=0; 
			  }
			  
		  
          
    $database->mysqlQuery("SET @TEMP_billnumber = " . "'" .$_REQUEST['billno']. "'");
   
                 $database->mysqlQuery("SET @discount_of = " . "'" . $discount_of_or . "'");
		  $database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		  $database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		  $database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");
		
                  $database->mysqlQuery("SET @redeem = " . "'" . $redeem . "'");
       
    $sq = $database->mysqlQuery("CALL  proc_discount_after_bill(@TEMP_billnumber,@discount_of,@discount_unit,@discount,@discountid,@redeem,@Message)");
    $rs = $database->mysqlQuery("SELECT @Message AS message");
    while($row = mysqli_fetch_array($rs))
    {
        $s= $row['message'];
       
    }
    
    echo $s;
   
    }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_discount_after')){
 
  
  $dis=0;
  $sql_general =  $database->mysqlQuery("Select bm_discountvalue from tbl_tablebillmaster where bm_dayclosedate ='".$_SESSION['date']."' and "
          . " bm_billno ='".$_REQUEST['billno']."'  limit 1"); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $dis			=$result_general['bm_discountvalue'];
					                                                                                                            
                                                 
                  }
                }
                
                
           if($dis>0){
               echo 'yes';
           }else{
               echo 'no';
           }     
                
                
    }