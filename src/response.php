<?php

if (is_ajax()) {
    
  if (isset($_POST["action"]) && !empty($_POST["action"])) { 
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
          case "add": add_function(); break;
	  case "edit": edit_function(); break;
	  case "check": check_function(); break;
	  case "update": update_function_new(); break;
          case "update1": update_function(); break;
	  //case "bill": bill_function(); break;
    }
  }
}

//Function to check if the request is an AJAX request

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function throw_ex($er){  
	  throw new Exception($er);  
} 
    




function add_function(){
    
session_start();

include("database.class.php"); 
$database	= new Database();

$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
mysqli_set_charset($con,"utf8");
mysqli_query($con,"SET NAMES 'utf-8'");

  $return = $_POST;
  $insertion = $_POST;
  $insertion1 = $_POST;
  
  
  
 if(isset($_REQUEST['mode_qr'])&& $_REQUEST['mode_qr']=='DI'){
  
        $_SESSION['preferencetextvalue']='';

        $_SESSION['quantityvalue']=$_REQUEST['qtyval'];

        $_SESSION['ratevalue']=$_REQUEST['rateval'];

        $_SESSION['menu_id']=$_REQUEST['menu'];

        $_SESSION['portionvalue']=$_REQUEST['portionval'];

        $_SESSION['unit_id']=0;

        $_SESSION['baseunit_id']=0;
          
   }
  
        $time=10;
	if($_SESSION['typevalue']=="TakeAway")
	{
            
	if($_SESSION['ratevalue']=='')
	{
            
	$sql_menutak="select mta_rate from tbl_menuratetakeaway where  mta_menuid='".$_SESSION['menu_id']."' and  mta_portion='".$_SESSION['portionvalue']."' ";
        $sql_tak  =  mysqli_query($con,$sql_menutak); 
	$num_tak  = mysqli_num_rows($sql_tak);
		if($num_tak){
			while($result_tak  = mysqli_fetch_array($sql_tak)) 
				{
					$rate=$result_tak['mta_rate'];
				}
		}else
		{
			$rate="";
		}
		}else
		{
	  	$rate=$_SESSION['ratevalue'];
		}
	}else
	{
		if($_SESSION['ratevalue']=='')
		{
                    
		 $sql_menuportion="select mmr_rate from tbl_menuratemaster where  mmr_menuid='".$_SESSION['menu_id']."' and  "
                 . " mmr_floorid='".$_REQUEST['floorid']."' and mmr_portion='".$_SESSION['portionvalue']."' ";
		 $sql_portions  =  mysqli_query($con,$sql_menuportion); 
		  $num_portions  = mysqli_num_rows($sql_portions);
		  if($num_portions)
			{
				while($result_portions  = mysqli_fetch_array($sql_portions)) 
					{
						$rate=$result_portions['mmr_rate'];
						$rate='0';
					}
			}
		}else
		{
                    if($_SESSION['ratevalue']!=''){
                        
	  	        $rate=$_SESSION['ratevalue'];
                    }
                    else{
                        $rate=0;
                    }
		}
	}
	
        
        
        
	if (strpos($_SESSION['order_id'], 'TEMP') !== false)
 	 {
 	     $sql = "select ter_orderno from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno_temp='". $_SESSION['order_id']."' ";
	     $result = mysqli_query($con,$sql);
		if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {	
                            
			$_SESSION['order_id'] = $row["ter_orderno"];	
		}
		}
        }
        
		$unitweight=0;
                
                if($_REQUEST['unitweight']!=''){
                    
                $unitweight=$_REQUEST['unitweight'];
                  echo $unitweight;
                }
                
                if($_REQUEST['baseunitweight']!=''){
                    $unitweight=$_REQUEST['baseunitweight'];
                }
                
                $portion=0;
                if($_SESSION['portionvalue']!=''){
                    $portion=$_SESSION['portionvalue'];
                }
                
                
                ///dynamic rate incl////   
               if($_REQUEST['manualrate_val']=='Y' && $_SESSION['incl_bill_format']=='Y'){
                     
                 $tax_vl=0;   
                 $sql_menuaddon4 = "select sum(amc_value) as tx from tbl_extra_tax_master "
                 . " left join tbl_floor_tax on tbl_floor_tax.ft_tax_id=tbl_extra_tax_master.amc_id "
                 . " WHERE tbl_floor_tax.ft_floorid='".$_REQUEST['floorid']."' "
                 . " and tbl_extra_tax_master.amc_active='Y' and tbl_extra_tax_master.amc_item_tax='N' group by tbl_floor_tax.ft_floorid ";
             
            
                    $sql_menuaddon12  =  mysqli_query($con,$sql_menuaddon4); 
                    $num_menuaddon2  = mysqli_num_rows($sql_menuaddon12);
                    if($num_menuaddon2){
                        while($result_menus2  = mysqli_fetch_array($sql_menuaddon12)) 
			{
                            
                             $tax_vl=$result_menus2['tx'];    
                        }
                        }
                      
                    $tax_vl1=($tax_vl/100);
                    
                    $tax_vl2=($_REQUEST['rate']/(1+$tax_vl1));
        
                    $rate=$tax_vl2;
        
                 }   
                    
                
                
                
            
		$insertion['ter_orderno'] 		=  $_SESSION['order_id'];
		$insertion['ter_branchid'] 		=  $_REQUEST['branchid'];
		$insertion['ter_menuid'] 		=  $_SESSION['menu_id'];
                $insertion['ter_rate_type'] 		=  $_REQUEST['ratetype'];
		$insertion['ter_portion'] 		=  $portion;
                $insertion['ter_unit_type'] 		=  $_REQUEST['unittype'];
                $insertion['ter_unit_weight'] 		=  $unitweight;
                $insertion['ter_unit_id'] 		=  $_SESSION['unit_id'];
                $insertion['ter_base_unit_id'] 		=  $_SESSION['baseunit_id'];
		$insertion['ter_rate'] 			=  $rate;
		$insertion['ter_qty'] 			=  $_SESSION['quantityvalue'];
		$insertion['ter_status'] 		=  "Added";
		
		$insertion['ter_preferencetext']   =  rtrim($_SESSION['preferencetextvalue'],',');
		$insertion['ter_orderfrom'] 	   =  "Web_Interface";
		$insertion['ter_entryuser'] 	   =  $_SESSION['expodine_id'];
		$insertion['ter_esttime'] 	   =  $time;
		$insertion['ter_type'] 	           =  $_SESSION['typevalue'];
		$insertion['ter_staff'] 	   =  $_REQUEST['stewardid'];
		
		if(($_SESSION['preferencetextvalue'])==""){
                    
		     $insertion['ter_preferencetext'] =  NULL;
                }
                
                     $addon=json_decode($_REQUEST['addon']);
                
	             $s=''; 	
           try {            

//              echo  $insertion['ter_orderno'] . ","
//	        . $insertion['ter_branchid'] . ","
//	        .  $insertion['ter_menuid'] . ","
//              .  $insertion['ter_rate_type'] . ","
//              .  $insertion['ter_portion'] . ","
//              .  $insertion['ter_unit_type'] . ","
//              . $insertion['ter_unit_weight'] . ","
//              . $insertion['ter_unit_id'] . ","
//             . $insertion['ter_base_unit_id'] . ","
//	       . $insertion['ter_qty'] . ","
//	       . $insertion['ter_status'] . ","
//	       . $insertion['ter_orderfrom'] . ","
//	       . $insertion['ter_entryuser'] . ","
//	       . $insertion['ter_esttime'] . ","
//	       . $insertion['ter_staff'] . ","
//	       . $insertion['ter_type'] . ","
//	       . $_REQUEST['floorid'] . ","
//	       . $rate . ","
//             . $insertion['ter_preferencetext'];
    
		  mysqli_query($con,"SET @temporderno = " . "'" . $insertion['ter_orderno'] . "'");
		  mysqli_query($con,"SET @branchid = " . "'" . $insertion['ter_branchid'] . "'");
		  mysqli_query($con,"SET @menuid = " . "'" . $insertion['ter_menuid'] . "'");
                  mysqli_query($con,"SET @ratetype = " . "'" . $insertion['ter_rate_type'] . "'");
                  mysqli_query($con,"SET @portion = " . "'" . $insertion['ter_portion'] . "'");
                  mysqli_query($con,"SET @unittype = " . "'" . $insertion['ter_unit_type'] . "'");
                  mysqli_query($con,"SET @unitweight = " . "'" . $insertion['ter_unit_weight'] . "'");
                  mysqli_query($con,"SET @unitid= " . "'" . $insertion['ter_unit_id'] . "'");
                  mysqli_query($con,"SET @baseunitid = " . "'" . $insertion['ter_base_unit_id'] . "'");
		  mysqli_query($con,"SET @qty = " . "'" . $insertion['ter_qty'] . "'");
		  mysqli_query($con,"SET @status = " . "'" . $insertion['ter_status'] . "'");
		  mysqli_query($con,"SET @orderfrom = " . "'" . $insertion['ter_orderfrom'] . "'");
		  mysqli_query($con,"SET @entryuser = " . "'" . $insertion['ter_entryuser'] . "'");
		  mysqli_query($con,"SET @est_time = " . "'" . $insertion['ter_esttime'] . "'");
		  mysqli_query($con,"SET @staff = " . "'" . $insertion['ter_staff'] . "'");
		  mysqli_query($con,"SET @type = " . "'" . $insertion['ter_type'] . "'");
		  mysqli_query($con,"SET @floorid = " . "'" . $_REQUEST['floorid'] . "'");
		  mysqli_query($con,"SET @manual_rate = " . "'" . $rate . "'");
                  mysqli_query($con,"SET @addon_slno = " . "''");
		  mysqli_query($con,"SET @preferencetext = " . "'" . $insertion['ter_preferencetext'] . "'");
                 
		$messsage='';
		
		$sq=mysqli_query($con,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@ratetype,@portion,@unittype,@unitweight,@unitid,@baseunitid,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferencetext,@addon_slno,@messsage)") or $this->throw_ex(mysqli_error($con));
		$rs = mysqli_query($con, 'SELECT @messsage AS messsage' );
		while($row = mysqli_fetch_array($rs))
		{
		  $s= $row['messsage'];
		}
                
                
    if(isset($_REQUEST['mode_qr'])&& $_REQUEST['mode_qr']=='DI'){   
        
        $sql_update_subtotal=mysqli_query($con," update tbl_tableorder set ter_qr_order='".$_REQUEST['order_qr']."' where "
        . " ter_dayclosedate='".$_SESSION['date']."' and `ter_orderno`='".$insertion['ter_orderno']."'  ");     
    }                
                
       if($_REQUEST['manualrate_val']=='Y'){ 
           
        $sql_update_dyn=mysqli_query($con," update tbl_tableorder set ter_dynamic_rate='Y' where "
        . " ter_dayclosedate='".$_SESSION['date']."' and ter_orderno='".$insertion['ter_orderno']."' and ter_menuid='".$insertion['ter_menuid']."' ");  
           
       }
    
    
    
    
    echo $s;
          
    
    
    
    
                
  if($_SESSION['incl_bill_format']=='Y'){ 
            
            if($insertion['ter_portion'] !=0){
                
                 $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where  mmr_menuid='".$insertion['ter_menuid']."' and mmr_portion='".$insertion['ter_portion']."'   ";
         
            }else{
                
                if($insertion['ter_unit_id']!=0){
                
                 $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where  mmr_menuid='".$insertion['ter_menuid']."' and mmr_unit_weight='".$insertion['ter_unit_weight']."' and mmr_unit_id='".$insertion['ter_unit_id']."' ";
                }
                
                if($insertion['ter_base_unit_id'] !=0){
                    
                 $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where  mmr_menuid='".$insertion['ter_menuid']."' and mmr_base_unit_id='".$insertion['ter_base_unit_id']."'  ";
                   
                }
                
            }
            
            
            
            $new_rate=0;
            $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                while($result_format  = mysqli_fetch_array($sql_menuaddon1)) 
                {
                    
                    if($result_format['mmr_menu_final_amount']>0 && $result_format['mmr_menu_final_amount'] !=''){
                        
                    $new_rate=$result_format['mmr_menu_final_amount'];
                        
                    }else{
                        
                    $new_rate=$result_format['mmr_rate'];
                     
                    }
                     
                 
                  ///dynamic rate incl////   
                 if($_REQUEST['manualrate_val']=='Y' && $_SESSION['incl_bill_format']=='Y'){
                     
                       $new_rate=$_REQUEST['rate'];
                 }
                    
                    
                    
                    
                    
               if($insertion['ter_portion'] !=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_tableorder set ter_new_rate_incl='".$new_rate."' where `ter_orderno`='".$insertion['ter_orderno']."' and ter_menuid='".$insertion['ter_menuid']."' and ter_portion='".$insertion['ter_portion']."'  ");     
          
         
              }else{
                
                if($insertion['ter_unit_id']!=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_tableorder set ter_new_rate_incl='".$new_rate."' where `ter_orderno`='".$insertion['ter_orderno']."' and ter_menuid='".$insertion['ter_menuid']."' and ter_unit_weight='".$insertion['ter_unit_weight']."'  and ter_unit_id='".$insertion['ter_unit_id']."'  ");     
                }
                
                
                if($insertion['ter_base_unit_id'] !=0){
                    
                   $sql_update_subtotal=mysqli_query($con," update tbl_tableorder set ter_new_rate_incl='".($new_rate*$insertion['ter_unit_weight'])."' where `ter_orderno`='".$insertion['ter_orderno']."' and ter_menuid='".$insertion['ter_menuid']."' and ter_unit_weight='".$insertion['ter_unit_weight']."'  and ter_base_unit_id='".$insertion['ter_base_unit_id']."'  ");     
                   
                }
                
                
            }
               
                 }
                }  
        
  }
                
                 
   if(!empty($addon)){
                    
                    $sql_menuaddon="select ter_slno from tbl_tableorder where  ter_menuid='".$_SESSION['menu_id']."'and ter_orderno='".$_SESSION['order_id']."' and ter_status='Added' ";
                    
                    $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
                    $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
                    if($num_menuaddon){
                        while($result_menuaddon  = mysqli_fetch_array($sql_menuaddon1)) 
			{
				$add_slno=$result_menuaddon['ter_slno'];
			}
                    }  
               
                for($p=0;$p<count($addon);$p++){  
                        
                        $s_addon='';
                        $addon_menuid=$addon[$p]->menu_id;
                        $addon_menurate=$addon[$p]->menu_rate;
                        $addon_menuqty=$addon[$p]->menu_qty;
                       
                        mysqli_query($con,"SET @menuid = " . "'" . $addon_menuid . "'");
                        mysqli_query($con,"SET @ratetype = " . 'Portion');
                        mysqli_query($con,"SET @portion = ".'1');
                        mysqli_query($con,"SET @unittype = " .NULL);
                        mysqli_query($con,"SET @unitweight = " .'0');
                        mysqli_query($con,"SET @unitid= " . '0');
                        mysqli_query($con,"SET @baseunitid = " . '0');
                        mysqli_query($con,"SET @qty = " . "'" . $addon_menuqty . "'");
                        mysqli_query($con,"SET @manual_rate = " ." '".$addon_menurate."'");
                        mysqli_query($con,"SET @addon_slno = " . "'".$add_slno."'");
                        
                        $addon_chque=mysqli_query($con,"SELECT ter_orderno FROM tbl_tableorder WHERE ter_orderno= '".$_SESSION['order_id']."' AND"
                        . " ter_menuid= '".$addon_menuid."' AND  ter_portion ='1' AND ter_rate_type = 'Portion' AND ter_status= 'Added' "
                        . " AND  ter_addon_slno='".$add_slno."'  LIMIT 0, 1");
                       
                        $num_addon_chque  = mysqli_num_rows($addon_chque);
                        if($num_addon_chque){
                           
                            mysqli_query($con,"UPDATE  tbl_tableorder SET ter_qty = ($addon_menuqty + ter_qty),"
                            . " ter_total_rate= ter_rate*($addon_menuqty + ter_qty),ter_preferencetext = '" . $insertion['ter_preferencetext'] . "',"
                            . " ter_entrytime = time(now()) WHERE ter_orderno= '".$_SESSION['order_id']."' AND ter_menuid= '".$addon_menuid."' AND"
                            . " ter_portion ='1' AND ter_rate_type = 'Portion' AND ter_status= 'Added' AND  ter_addon_slno='".$add_slno."'");
                       
                        }else{
                           
                            $sq_addon=mysqli_query($con,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@ratetype,@portion,@unittype,@unitweight,@unitid,@baseunitid,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferencetext,@addon_slno,@messsage)") or $this->throw_ex(mysqli_error($con));
                            $rs_addon = mysqli_query($con, 'SELECT @messsage AS messsage' );
                            while($row_addon = mysqli_fetch_array($rs_addon))
                            {
                               $s_addon= $row_addon['messsage'];
                            }

                     
                        }
                        
                  //$sql_menuaddon=mysqli_query($con,"INSERT INTO `tbl_order_addon`(`ad_orderno`, `ad_order_slno`, `ad_addon_menu`, `ad_rate`, 
                  // `ad_qty`, `ad_total_rate`, `ad_dayclosedate`,ad_entrydate) VALUES ('".$_SESSION['order_id']."','".$add_slno."','".$addon_menuid."',
                  // '".$addon_menurate."','".$addon_menuqty."','".$addon_menurate."'*'".$addon_menuqty."','".$_SESSION['date']."',NOW())");
                         
                }
                        echo $s;
                        
                }else{
                        echo $s;
                }
		
                
		$k=trim($s);
                
		if($k=="Order Already Billed")
		{
			$_SESSION['backchecking']="Y";
		}else
		{
			$_SESSION['backchecking']="N";
		}
		
		unset($_SESSION['quantityvalue']);
		unset($_SESSION['ratevalue']);
		unset($_SESSION['menu_id']);
		unset($_SESSION['preferenceselectvalue']);
		unset($_SESSION['preferencetextvalue']);
                
                
	 } catch (Exception $e) {
             
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }	

}

function edit_function(){
    
   session_start();

   include("database.class.php"); //DB Connection class
   $database	= new Database();
   $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
   mysqli_set_charset($con,"utf8");
   mysqli_query($con,"SET NAMES 'utf-8'");


  $return = $_POST;
  $insertion = $_POST;
  
  if($_SESSION['ratevalue']=='')
  {
		    $sql_menuportion="select mmr_rate from tbl_menuratemaster where  mmr_menuid='".$_SESSION['menu_id']."' and  "
                    . " mmr_floorid='".$_REQUEST['floorid']."' and mmr_portion='".$_SESSION['portionvalue']."'";
		    $sql_portions  =  mysqli_query($con,$sql_menuportion); 
			$num_portions  = mysqli_num_rows($sql_portions);
			if($num_portions){
				while($result_portions  = mysqli_fetch_array($sql_portions)) 
					{
						$rate=$result_portions['mmr_rate'];
						$rate='0';
					}
			}
		}else
		{
			$rate=$_SESSION['ratevalue'];
		}
                
                
	$rate=$_SESSION['ratevalue'];
	$sql_menuportion="select mr_time_min from tbl_menumaster where  mr_menuid='".$_SESSION['menu_id']."' ";
        $sql_portions  =  mysqli_query($con,$sql_menuportion); 
	$num_portions  = mysqli_num_rows($sql_portions);
	if($num_portions){
		while($result_portions  = mysqli_fetch_array($sql_portions)) 
			{
				$time=$result_portions['mr_time_min'];
			}
	}
	if($_SESSION['typevalue']=="TakeAway")
	{
		if($_SESSION['ratevalue']=='')
		{
	$sql_menutak="select mta_rate from tbl_menuratetakeaway where  mta_menuid='".$_SESSION['menu_id']."' and  mta_portion='".$_SESSION['portionvalue']."' and mta_branchid='".$_REQUEST['branchid']."'";
        $sql_tak  =  mysqli_query($con,$sql_menutak); 
	$num_tak  = mysqli_num_rows($sql_tak);
	if($num_tak){
		while($result_tak  = mysqli_fetch_array($sql_tak)) 
			{
				$rate=$result_tak['mta_rate'];
			}
	}else
	{
		   $rate="";
		
	}
	}else
		{
	  	   $rate=$_SESSION['ratevalue'];
		}
	}
        
	if (strpos($_SESSION['order_id'], 'TEMP') !== false)
 	{
 	    $sql = "select ter_orderno from tbl_tableorder where ter_orderno_temp='". $_SESSION['order_id']."'";
	    $result = mysqli_query($con,$sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {	
				$_SESSION['order_id'] = $row["ter_orderno"];	
			}
		}
        }
                $insertion['ter_slno'] 		    =  $_REQUEST['slno'];
		$insertion['ter_orderno'] 		=  $_SESSION['order_id'];
		$insertion['ter_branchid'] 		=  $_REQUEST['branchid'];
		$insertion['ter_menuid'] 		=  $_SESSION['menu_id'];
		$insertion['ter_portion'] 		=  $_SESSION['portionvalue'];
		$insertion['ter_rate'] 			=  $rate;
		$insertion['ter_qty'] 			=  $_REQUEST['qty'];
		$insertion['ter_status'] 		=  "Added";
		$insertion['ter_preference'] 	        = $_REQUEST['prefvalue'];
		$insertion['ter_preferencetext'] 	=$_REQUEST['preftext'];
		$insertion['ter_orderfrom'] 	        =  "Web_Interface";
		$insertion['ter_entryuser'] 	        =  $_SESSION['expodine_id'];
		$insertion['ter_esttime'] 	        =  $time;
		$insertion['ter_type'] 	                =  $_SESSION['typevalue'];
		$insertion['ter_staff'] 		=  $_REQUEST['stewardid'];
                
		$con1="";$con2="";$con3="";$con4="";
		$preftetx="";
		$preftevl="";
		
		if( ($_REQUEST['preftext'])=="0"  )
		$insertion['ter_preferencetext'] =  NULL;


                try {
                    
		  mysqli_query($con,"SET @orderno = " . "'" . $insertion['ter_orderno'] . "'");
		  mysqli_query($con,"SET @slno = " . "'" . $insertion['ter_slno'] . "'");
		  mysqli_query($con,"SET @qty = " . "'" . $insertion['ter_qty'] . "'");
		  mysqli_query($con,"SET @pref = " . "'" . $insertion['ter_preference'] . "'");
		  mysqli_query($con,"SET @pref_text = " . "'" . $insertion['ter_preferencetext'] . "'");
		  mysqli_query($con,"SET @rate = " . "'" . $rate . "'");
		 
		$sq=mysqli_query($con,"CALL proc_tableorderedit(@orderno,@slno,@qty,@pref,@pref_text,@rate)") or $this->throw_ex(mysqli_error($con));
		
	     } catch (Exception $e) {
                 
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	    }	

     print_r($insertion);	
		
}


function check_function()
{
    
 session_start();

include("database.class.php"); //DB Connection class
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
mysqli_set_charset($con,"utf8");
mysqli_query($con,"SET NAMES 'utf-8'");

  $insertion = $_POST;
  $insertions = $_POST;

	$sql_menuportion="select mr_time_min from tbl_menumaster where  mr_menuid='".$_SESSION['menu_id']."' ";
   $sql_portions  =  mysqli_query($con,$sql_menuportion); 
	$num_portions  = mysqli_num_rows($sql_portions);
	if($num_portions){
		while($result_portions  = mysqli_fetch_array($sql_portions)) 
			{
				$time=$result_portions['mr_time_min'];
			}
	}
	
        
		$insertion['ter_orderno'] 		=  $_SESSION['order_id'];
		$insertion['ter_branchid'] 		=  $_REQUEST['branchid'];
		$insertion['ter_menuid'] 		=  $_SESSION['menu_id'];
		$insertion['ter_portion'] 		=  $_SESSION['portionvalue'];
		$insertion['ter_qty'] 			=  $_SESSION['quantityvalue'];
		$insertion['ter_status'] 		=  "Added";
		
		$insertion['ter_preferencetext'] =  NULL;
		$insertion['ter_orderfrom'] 	 =  "Web_Interface";
		$insertion['ter_entryuser'] 	 =  $_SESSION['expodine_id'];
		$insertion['ter_esttime'] 	    =  $time;
		$insertion['ter_type'] 	         =  $_SESSION['typevalue'];
		$insertion['ter_staff'] 		=  $_REQUEST['stewardid'];
                
	$sql=mysqli_query($con,"select ter_orderno from tbl_tableorder where ter_orderno='".$_SESSION['order_id']."' and  ter_menuid='".$insertion['ter_menuid']."' and ter_portion='".$_SESSION['portionvalue']."' and ter_type='".$_SESSION['typevalue']."' and ter_status='Added' and ter_rate='".$_SESSION['ratevalue']."' ");
	$rs=mysqli_num_rows($sql);
	if(!$rs)
	{
 		$insertions['msg']="ok";
	}else 
	{
		$insertions['msg']="sorry";
	}
  $insertions["json"] = json_encode($insertions);
  echo json_encode($insertions);
  
}
function update_function()
{ 

    session_start();

    include("database.class.php"); //DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
    mysqli_set_charset($con,"utf8");
    mysqli_query($con,"SET NAMES 'utf-8'");
    $PREF='';
		$QTY= $_REQUEST['qty'];
                $PORTION= $_REQUEST['portion'];
                $SLNO= $_REQUEST['slno'];
               
                $preftetx='';
                if($_REQUEST['pref_text']!='' && $_REQUEST['pref_text']!=',' ){
                $preftetx= rtrim($_REQUEST['pref_text'],',');
                }
               
                
                $manual_rate= $_REQUEST['manual_rate'];
                $manualrate_entry= $_REQUEST['manualrate_entry'];
                if($manualrate_entry=='Y')
                {
                  $RATE= $manual_rate; 
                }
                else{
                    
                    $RATE= $_REQUEST['final1'];
                    
                    }
                    
                $unitweight=0;
                if($_REQUEST['unitweight']!=''){
                $unitweight=$_REQUEST['unitweight'];
                }
                else if($_REQUEST['baseunitweight']!=''){
                    $unitweight=$_REQUEST['baseunitweight'];
                }
                $addon=json_decode($_REQUEST['addon']);
                
            try {
		  mysqli_query($con,"SET @orderno = " . "'" . $_SESSION['order_id'] . "'");
		  mysqli_query($con,"SET @slno = " . "'" . $SLNO . "'");
		  mysqli_query($con,"SET @qty = " . "'" . $QTY . "'");
		
		  mysqli_query($con,"SET @pref_text = " . "'" . $preftetx . "'");
		  mysqli_query($con,"SET @rate = " . "'".$RATE. "'");
                 
                  mysqli_query($con,"SET @unitweight = " . "'".$unitweight. "'");
		 
		$sq=mysqli_query($con,"CALL proc_tableorderedit(@orderno,@slno,@qty,@pref_text,@rate,@unitweight,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$rs = mysqli_query($con, 'SELECT @message AS messsage' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['messsage'];
		}
                
                
                $pref_ids=json_decode($_REQUEST['pref_ids']);
     
      if(!empty($pref_ids)) {
     
      
      for($p1=0;$p1<count($pref_ids);$p1++){
          
           $pref_id=$pref_ids[$p1]->pref_id;
           
           $pref_qty=$pref_ids[$p1]->pref_qty;
           
           $pref_name=$pref_ids[$p1]->pref_name;
           
           $sql_chk="select tmp_menu from tbl_menu_preference_kot where tmp_orderno_bill='".$_SESSION['order_id']."'"
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id' ";
         
           $sql_menuaddon1  =  mysqli_query($con,$sql_chk); 
           $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
           if($num_menuaddon){
           
           $sql_qry111 = $database->mysqlQuery("update `tbl_menu_preference_kot`  set `tmp_qty`='$pref_qty' where"
                   . "  tmp_orderno_bill='".$_SESSION['order_id']."' "
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id'");
                  
             $sql_qry111 = $database->mysqlQuery("DELETE FROM tbl_menu_preference_kot WHERE (tmp_qty='' OR tmp_qty='0')  AND"
                     . "  tmp_orderno_bill='".$_SESSION['order_id']."' "
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id'");
           
           }else{
               
                $sql_qry111 = $database->mysqlQuery("INSERT INTO `tbl_menu_preference_kot`(`tmp_orderno_bill`, `tmp_qty`, `tmp_mode`,"
                   . "`tmp_menu`, `tmp_pref_id`, `tmp_pref_name`) "
                   . "VALUES ('".$_SESSION['order_id']."','$pref_qty','DI','".$_REQUEST['menuid']."','$pref_id','$pref_name')");
                  
               
           }
          
      }
       
     
  }
                
                
                
                
                
                if (!empty($addon)) {
                    $addon_chk=mysqli_query($con,"DELETE FROM tbl_tableorder WHERE ter_orderno= '".$_SESSION['order_id']."' AND  ter_addon_slno='".$SLNO."' ");
                    $sql_staff="select ls_staffid FROM tbl_logindetails where ls_username='".$_SESSION['expodine_id']."'";
                    $sql_staff1  =  mysqli_query($con,$sql_staff); 
                    $num_staff  = mysqli_num_rows($sql_staff1);
                    if($num_staff){
                        $result_staff=mysqli_fetch_array($sql_staff1);
                        $staff=$result_staff['ls_staffid'];
                    }
                    
                    for($p=0;$p<count($addon);$p++){
                        if($addon[$p]->menu_qty){
                        $addon_menuid=$addon[$p]->menu_id;
                        $addon_menuslno=$addon[$p]->menu_slno;
                        $addon_menurate=$addon[$p]->menu_rate;
                        $addon_menuqty=$addon[$p]->menu_qty;
                        $rate_type='Portion';
                        $portion='1';
                        $unittype=NULL;
                        $unit_id=0;
                        $unit_weight=0;
                        $baseunit_id=0;
                        $manual_rate=$addon_menurate;
                        $status='Added';
                        $order_from='Web_Interface';
                        $estimated_time=10;
                        $type='Dinein';
                        $branch=1;
                        $add_slno=$SLNO;
                        
                        mysqli_query($con,"SET @orderno = " . "'" . $_SESSION['order_id'] . "'");
                        mysqli_query($con,"SET @branchid = " ."'".$branch."'");
                        mysqli_query($con,"SET @menuid = " . "'".$addon_menuid."'");
                        mysqli_query($con,"SET @ratetype = " ."'".$rate_type."'");
                        mysqli_query($con,"SET @portion = "."'".$portion."'");
                        mysqli_query($con,"SET @unittype = " ."'".$unittype."'");
                        mysqli_query($con,"SET @unitid= " ."'".$unit_id."'" );
                        mysqli_query($con,"SET @baseunitid = " ."'".$baseunit_id."'");
                        mysqli_query($con,"SET @manual_rate = " . "'".$manual_rate."'");
                        mysqli_query($con,"SET @status = " . "'".$status."'");
                        mysqli_query($con,"SET @orderfrom = " . "'".$order_from."'");
                        mysqli_query($con,"SET @entryuser = " . "'".$_SESSION['expodine_id']."'");
                        mysqli_query($con,"SET @est_time = " . "'".$estimated_time."'");
                        mysqli_query($con,"SET @staff = " . "'".$staff."'");
                        mysqli_query($con,"SET @type = " . "'".$type."'");
                        mysqli_query($con,"SET @floorid = " ." '".$_SESSION['floorid']."'");
                        mysqli_query($con,"SET @manual_rate = " . "'".$addon_menurate."'");
                        mysqli_query($con,"SET @addon_slno = " . "'".$add_slno."'");
                       
                        mysqli_query($con,"SET @slno = " . "'".$addon_menuslno."'");
                        mysqli_query($con,"SET @qty = " . "'".$addon_menuqty."'");
                        mysqli_query($con,"SET @rate = " . "'".$addon_menurate."'");
                        mysqli_query($con,"SET @unitweight = " . "'".$unit_weight."'");
                        
                        //echo $_SESSION['order_id']."'".$branch."'".$addon_menuid."'".$rate_type."'".$portion."'".$unittype."'".$unit_id."'".$baseunit_id."'".$unit_weight."'".$addon_menuqty."'".$status."'".$order_from."'".$_SESSION['expodine_id']."'".$estimated_time."'".$type."'".$_SESSION['floorid']."'".$addon_menurate;
                        
                        $sq_addon=mysqli_query($con,"CALL proc_tableordernentry(@orderno,@branchid,@menuid,@ratetype,@portion,@unittype,@unitweight,@unitid,@baseunitid,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@pref_text,@addon_slno,@messsage)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
                        $rs_addon = mysqli_query($con, 'SELECT @messsage AS messsage' );
                        while($row_addon = mysqli_fetch_array($rs_addon))
                        {
                        $s_addon= $row_addon['messsage'];
                        }


                        
                        }
                    }
                echo $s;
                }
		else{
                    echo $s;
                }
            }
                   
         
         
         catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
            }	
	
 
}

function update_function_new()
{
	
session_start();


include("database.class.php"); // DB Connection class
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
mysqli_set_charset($con,"utf8");
mysqli_query($con,"SET NAMES 'utf-8'");

  $return = $_POST;
  $insertion = $_POST;
  $insertion1 = $_POST;
  $qty_ch=0;
  $preftetx="";
  $preftevl="";
                
	$sql_ch=mysqli_query($con,"select ter_preferencetext,ter_preference from tbl_tableorder where ter_orderno='".$_SESSION['order_id']."' and"
        . " ter_menuid='".$_SESSION['menu_id']."' and ter_portion='".$_SESSION['portionvalue']."'  and ter_type='".$_SESSION['typevalue']."' and"
        . " ter_status='Added' ");
	$rs_ch=mysqli_num_rows($sql_ch);
	if($rs_ch)
	{
		while($result_ch  = mysqli_fetch_array($sql_ch)) 
			{
				$qty_ch=$_SESSION['quantityvalue'];
				$preftetx=$result_ch['ter_preferencetext'];
				$preftevl=$result_ch['ter_preference'];
			}
	}
  
  
	$sql_menuportion="select mr_time_min from tbl_menumaster where  mr_menuid='".$_SESSION['menu_id']."' ";
        $sql_portions  =  mysqli_query($con,$sql_menuportion); 
	$num_portions  = mysqli_num_rows($sql_portions);
	if($num_portions){
		while($result_portions  = mysqli_fetch_array($sql_portions)) 
			{
				$time=$result_portions['mr_time_min'];
			}
	}
        
	if($_SESSION['typevalue']=="TakeAway")
	{
            
	if($_SESSION['ratevalue']=='')
	{
            
	$sql_menutak="select mta_rate from tbl_menuratetakeaway where  mta_menuid='".$_SESSION['menu_id']."' and  mta_portion='".$_SESSION['portionvalue']."' and mta_branchid='".$_REQUEST['branchid']."'";
        $sql_tak  =  mysqli_query($con,$sql_menutak); 
	$num_tak  = mysqli_num_rows($sql_tak);
		if($num_tak){
			while($result_tak  = mysqli_fetch_array($sql_tak)) 
				{
					$rate=$result_tak['mta_rate'];
				}
		}else
		{
			$rate="";
		}
		}else
		{
	  	       $rate=$_SESSION['ratevalue'];
		}
	}else
	{
		if($_SESSION['ratevalue']=='')
		{
                    
		 $sql_menuportion="select mmr_rate from tbl_menuratemaster where  mmr_menuid='".$_SESSION['menu_id']."' and  mmr_floorid='".$_REQUEST['floorid']."' and mmr_portion='".$_SESSION['portionvalue']."'";
		 $sql_portions  =  mysqli_query($con,$sql_menuportion); 
		 $num_portions  = mysqli_num_rows($sql_portions);
		 if($num_portions)
			{
				while($result_portions  = mysqli_fetch_array($sql_portions)) 
					{
						$rate=$result_portions['mmr_rate'];
						$rate='0';
					}
			}
		}else
		{
	  	    $rate=$_SESSION['ratevalue'];
		}
	}if (strpos($_SESSION['order_id'], 'TEMP') !== false)
 	{
            
 	    $sql = "select ter_orderno from tbl_tableorder where ter_orderno_temp='". $_SESSION['order_id']."'";
	    $result = mysqli_query($con,$sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {	
                            
				$_SESSION['order_id'] = $row["ter_orderno"];	
			}
		}
        }
       
		$insertion['ter_orderno'] 		=  $_SESSION['order_id'];
		$insertion['ter_branchid'] 		=  $_REQUEST['branchid'];
		$insertion['ter_menuid'] 		=  $_SESSION['menu_id'];
		$insertion['ter_portion'] 		=  $_SESSION['portionvalue'];
		$insertion['ter_rate'] 			=  $rate;
		$insertion['ter_qty'] 			=   $_SESSION['quantityvalue'];
		$insertion['ter_status'] 		=  "Added";
		$insertion['ter_preference'] 	 =  $_SESSION['preferenceselectvalue'];
		$insertion['ter_preferencetext'] =  $_SESSION['preferencetextvalue'];
		$insertion['ter_orderfrom'] 	 =  "Web_Interface";
		$insertion['ter_entryuser'] 	 =  $_SESSION['expodine_id'];
		$insertion['ter_esttime'] 	    =  $time;
		$insertion['ter_type'] 	         =  $_SESSION['typevalue'];
		$insertion['ter_staff'] 		=  $_REQUEST['stewardid'];
		
		if( ($_SESSION['preferencetextvalue'])==""  )
		$insertion['ter_preferencetext'] =  NULL;
		
		if($preftetx!="")
		{
			if(is_null($insertion['ter_preferencetext']))
			{
				$insertion['ter_preferencetext']=$preftetx;
			}else
			{
			$insertion['ter_preferencetext']=$preftetx."".$_SESSION['preferencetextvalue'];
			}
		}
		else
		{
			
			$insertion['ter_preferencetext']=$_SESSION['preferencetextvalue'];
			
		}
		$s=''; 
try {
		  mysqli_query($con,"SET @temporderno = " . "'" . $insertion['ter_orderno'] . "'");
		  mysqli_query($con,"SET @branchid = " . "'" . $insertion['ter_branchid'] . "'");
		  mysqli_query($con,"SET @menuid = " . "'" . $insertion['ter_menuid'] . "'");
		  mysqli_query($con,"SET @portion = " . "'" . $insertion['ter_portion'] . "'");
		  mysqli_query($con,"SET @qty = " . "'" . $insertion['ter_qty'] . "'");
		  mysqli_query($con,"SET @status = " . "'" . $insertion['ter_status'] . "'");
		  mysqli_query($con,"SET @orderfrom = " . "'" . $insertion['ter_orderfrom'] . "'");
		  mysqli_query($con,"SET @entryuser = " . "'" . $insertion['ter_entryuser'] . "'");
		  mysqli_query($con,"SET @est_time = " . "'" . $insertion['ter_esttime'] . "'");
		  mysqli_query($con,"SET @staff = " . "'" . $insertion['ter_staff'] . "'");
		  mysqli_query($con,"SET @type = " . "'" . $insertion['ter_type'] . "'");
		  mysqli_query($con,"SET @floorid = " . "'" . $_REQUEST['floorid'] . "'");
		  mysqli_query($con,"SET @manual_rate = " . "'" . $rate . "'");
		  mysqli_query($con,"SET @preferenceid = " . "'" . $insertion['ter_preference'] . "'");
		  mysqli_query($con,"SET @preferencetext = " . "'" . $insertion['ter_preferencetext'] . "'");
		
		$messsage='';
		 
		$sq=mysqli_query($con,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@portion,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferenceid,@preferencetext,@messsage)") or $this->throw_ex(mysqli_error($con));
		$rs = mysqli_query($con, 'SELECT @messsage AS messsage' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['messsage'];
		}
		echo $s;
		$k=trim($s);
		if($k=="Order Already Billed")
		{
			$_SESSION['backchecking']="Y";
		}else
		{
			$_SESSION['backchecking']="N";
		}
		
	        } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	        }	

}

?>