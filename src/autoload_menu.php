<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
error_reporting(0);
if(isset($_REQUEST['set']) && $_REQUEST['set']=="autoload")
{
 $_SESSION['menuarray']=array();
$_SESSION['menumodarray']=array();
$_SESSION['menusubarray']=array();
$_SESSION['menufullarray']=array();
$sql_login  =  $database->mysqlQuery("Select tbl_modulemaster.mer_modulename, tbl_modulesubmaster.mser_subname, tbl_modulemaster.mer_modulelink, tbl_modulesubmaster.mser_submodulelink, tbl_usermodules.um_access,  tbl_usermodules.um_username From tbl_usermodules Inner Join tbl_modulesubmaster On tbl_modulesubmaster.mser_submoduleid = tbl_usermodules.um_submoduleid Inner Join tbl_modulemaster On tbl_modulemaster.mer_moduleid = tbl_usermodules.um_moduleid Where tbl_usermodules.um_username = '".$_SESSION['expodine_id']."' order by   tbl_modulemaster.mer_modulename"); 
$num_login   = $database->mysqlNumRows($sql_login);
if($num_login)
{
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{
			 $_SESSION['menuarray'][]=$result_login['mer_modulelink'];
			 $_SESSION['menumodarray'][]=$result_login['mer_modulename'];
			 $_SESSION['menusubarray'][]=$result_login['mser_submodulelink'];
			 if($result_login['mser_submodulelink']!="")
			 $_SESSION['menufullarray'][]=$result_login['mser_submodulelink'];
			 if($result_login['mer_modulelink']!="")
			 $_SESSION['menufullarray'][]=$result_login['mer_modulelink'];
		}
		
}
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="stewrdalertrefresh")
{
	$curdt=date("Y-m-d");
                  $_SESSION['sterdalertcount']=0 ;
				  $sql_stwrd  =  $database->mysqlQuery("Select tbl_tablemaster.tr_tableno, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = 'steward' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							   $timestamp = strtotime($result_stwrd['tbl_inserttime']);
							   $_5minuteslater = time() + 5 * 60;//< time()-300 
							$totalval= $_5minuteslater - $timestamp;
							  if($totalval<1000 || $totalval==0)
							  {
								  if($result_stwrd['tbl_read']!='Y')
								 $_SESSION['sterdalertcount']++; 
							  }
							} 
					}
					echo  $_SESSION['sterdalertcount'];
} 
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="urban_piper_order")
{
	$store_urban=''; $db_urban=''; $_SESSION['uraban_order_count_d']=0;
        $dt_order=date('Y-m-d');
  
$ct=0;
$a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
$localhost=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);
    //$sql_gen =  mysqli_query($localhost,"select td_date,td_order_id from tbl_order_details td left join tbl_order_relay_customer tc "
   //      . " on td.td_order_id = tc.tor_order_no where date(td.td_date)='$dt_order' and  td.td_order_local_accepted='N' and"
   //      . " (td.td_webhook_status is NULL or  td.td_webhook_status='Placed')    order by td.td_date asc"); 
 
 
 $sql_gen =  mysqli_query($localhost,"select td_date,td_order_id from tbl_order_details td "
         . "  where date(td.td_date)='$dt_order' and  td.td_order_local_accepted='N' and"
         . " (td.td_webhook_status is NULL or  td.td_webhook_status='Placed')    order by td.td_date asc"); 
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{                                                             
$start = strtotime($result_cat_s_tc['td_date']);
$end = strtotime(date('Y-m-d H:i:s'));
$mins = ($end - $start) / 60;
   if($mins<15){
          $ct++; 
        }                   
}
echo $ct;


 }else{
    echo 0;
 }                                            
}else{
    echo 0;   
}        

$_SESSION['uraban_order_count_d']=$ct;

} 
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="qr_order")
{  
    
$qr_branch=''; $qr_db=''; $_SESSION['qr_order_count_d']=0;

 $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join"
        . "  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
 }
}

$ct=0; $zr=0; $rn=''; $ord='';
$a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
  $localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
  $sql_gen =  mysqli_query($localhost3,"select tq_localy_confirmed,tq_running,tq_order_no from tbl_qr_order_details "
  . "  where  tq_synced='Y' and  (tq_localy_confirmed='N' or tq_running='Y') and tq_cancelled='N'   and tq_branch='$qr_branch' "); 
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                         $ct++;   
                                         
                                         $rn.=$result_cat_s_tc['tq_running'];
                                         
                                         $ord.=$result_cat_s_tc['tq_order_no'].','; 
                                         
                        }
                                         echo  $ct.'*'.$rn.'*'.$ord;
                                }else{ 
                                         echo $zr.'*N*';         
                                }                                           
   }else{
        
     echo $zr.'*N*';  
        
   }     
   
   
   $_SESSION['qr_order_count_d']=$ct;
   
   
   
} 
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="central_accept_reject")
{
    
  $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {  
            
    $qr_branch=''; $qr_db='';
    $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join"
            . "  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
     while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
              {
         $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
          $qr_db=$result_cat_s_tc['be_qrcode_db'];
     }
    }  


      $localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR); 
                     $cnt_id='';
                     $sql_gen =  mysqli_query($localhost3,"select * from tbl_central_kitchen_transfer  where tct_status_live='Cancelled' and  tct_reject_update='N'  and tct_local_branch='$qr_branch' group by tct_central_id ,tct_product"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_fnctvenue  = mysqli_fetch_array($sql_gen)) 
		     {   
                                    
                    $cnt_id=$result_fnctvenue['tct_central_id'];  
                                    
                 if($result_fnctvenue['tct_unit_type']=='Single' || $result_fnctvenue['tct_unit_type']=='Nos'){
     
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue['tct_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."'  ");         
          }else{
              
         if($result_fnctvenue['tct_rate_type']=='Packet' && ($result_fnctvenue['tct_unit_type']=='KG' || $result_fnctvenue['tct_unit_type']=='LTR')){   
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue['tct_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."' ");                     
        }else{           
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$result_fnctvenue['tct_weight']."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_fnctvenue['tct_product']."' and ts_store='".$result_fnctvenue['tct_local_store']."' ");            
          }
          }                                                                           
          }                                  
    $sql_gen =  mysqli_query($localhost3,"update tbl_central_kitchen_transfer set  tct_reject_update='Y'  where  tct_status_live='Cancelled' and tct_local_branch='$qr_branch' and tct_central_id='$cnt_id' "); 
                             
       }
       
       
       
       
                    $cnt_id1='';
                    $sql_gen1 =  mysqli_query($localhost3,"select * from tbl_central_kitchen_transfer  where tct_edited_stage='Editing' and tct_status_live='Accepted' and tct_local_branch='$qr_branch' group by tct_central_id ,tct_product"); 
       
		  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
				while($result_fnctvenue8  = mysqli_fetch_array($sql_gen1)) 
		     {      
                                    
                    $cnt_id1=$result_fnctvenue8['tct_central_id'];   
                    
       if($result_fnctvenue8['tct_unit_type']=='Single' || $result_fnctvenue8['tct_unit_type']=='Nos'){  
                     
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue8['tct_edit_value']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_fnctvenue8['tct_product']."' and ts_store='".$result_fnctvenue8['tct_local_store']."'  ");         
          }else{             
         if($result_fnctvenue8['tct_rate_type']=='Packet' && ($result_fnctvenue8['tct_unit_type']=='KG' || $result_fnctvenue8['tct_unit_type']=='LTR')){ 
             
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_fnctvenue8['tct_edit_value']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_product='".$result_fnctvenue8['tct_product']."' and ts_store='".$result_fnctvenue8['tct_local_store']."' ");                     
        }else{
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$result_fnctvenue8['tct_edit_value']."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_fnctvenue8['tct_product']."' and ts_store='".$result_fnctvenue8['tct_local_store']."' ");                       
          }           
          }                              
          }  
          
    $sql_gen5 =  mysqli_query($localhost3,"update tbl_central_kitchen_transfer set  tct_edited_stage='Updated'  where  tct_status_live='Accepted' and tct_edited_stage='Editing' and tct_local_branch='$qr_branch' and tct_central_id='$cnt_id1' ");                       
      
    }   
       
}   
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="central_accept_transfer_count")
{
    
$qr_branch=''; $qr_db=''; $_SESSION['inv_central_transfer_d']=0;

$sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join  "
        . " tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
 }
}

  $ct=0;
  $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
   $localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

   $sql_gen =  mysqli_query($localhost3,"select * from tbl_cloud_store_transfer
   where tct_to_branch='".$_SESSION['firebase_id']."' and tct_local_accepted='N' and tct_rejected='N'  and "
   . "  (tct_partial_option!='cancel' or tct_partial_option is null) "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
		    while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
		  {
                             $ct++;    
                }
                             echo  $ct;
                  }else{                              
                                   echo 0;                           
                 }                      
           }else{
          echo 0;   
        }        
        
    $_SESSION['inv_central_transfer_d']=$ct;    
        
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="central_req_reject")
{
    
    $qr_branch=''; $qr_db=''; $date=date('Y-m-d');  $_SESSION['inv_central_req_reject_d']=0;  

    $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join "
    . " tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
     while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
              {

         $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
          $qr_db=$result_cat_s_tc['be_qrcode_db'];
     }
    }

   $ct=0;
   $a="8.8.8.8";
   
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
  $localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

  $sql_gen =  mysqli_query($localhost3,"select tr_req_id from tbl_requisition  where tr_central='Y' and  tr_status='Cancel' "
  . " and branchid='$qr_branch' and  date(tr_status_date)='$date' group by tr_req_id,branchid "); 
     
		 $num_gen  = mysqli_num_rows($sql_gen);
		 if($num_gen)
		  {
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                               $ct++;    
                        }
                
                               echo  $ct;
                
                }else{                              
                               echo 0;                           
                }  
                
               }else{
                               echo 0;   
               }   
               
       $_SESSION['inv_central_req_reject_d']=$ct;           
               
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=="central_accept_count")
{
    
$qr_branch=''; $qr_db='';

$sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
 }
}

$ct=0;
 $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
$localhost3=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

 $sql_gen =  mysqli_query($localhost3,"select tct_central_id from tbl_central_kitchen_transfer  where  (tct_received='N' or tct_received is null)  and (tct_status_live!='Cancelled' or tct_status_live is null)   and tct_to_branch='$qr_branch' group by tct_central_id "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
               $ct++;    
                }
                echo  $ct;
                  }else{                              
                                   echo 0;                           
                                }                      
           }else{
          echo 0;   
        }                                       
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="wateralertrefresh")
{
	$curdt=date("Y-m-d");
                  $_SESSION['wateralertcount']=0 ;
				  $sql_stwrd  =  $database->mysqlQuery("Select tbl_tablemaster.tr_tableno, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = 'water' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							   $timestamp = strtotime($result_stwrd['tbl_inserttime']);
							   $_5minuteslater = time() + 5 * 60;//< time()-300 
							$totalval= $_5minuteslater - $timestamp;
							  if($totalval<1000 || $totalval==0)
							  {
								  if($result_stwrd['tbl_read']!='Y')
								 $_SESSION['wateralertcount']++; 
							  }
							} 
					}
					echo  $_SESSION['wateralertcount'];
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="billalertrefresh")
{
	$curdt=date("Y-m-d");
                  $_SESSION['billalertcount']=0 ;
				 $sql_stwrd  =  $database->mysqlQuery("Select b.bm_tableno,n.tbl_insertdate, n.tbl_inserttime, b.bm_billno,b.bm_finaltotal, n.tbl_read, n.tbl_readby, n.tbl_readdate, n.tbl_readtime from tbl_notifications n left Join tbl_tablemaster t On t.tr_tableid = n.tbl_tableid left Join tbl_modulesubmaster ms On n.tbl_notificationtype = ms.mser_submoduleid left Join tbl_modulemaster m On ms.mser_moduleid = m.mer_moduleid left join tbl_tablebillmaster b ON b.bm_billno = n.tbl_billno where ms.mser_submodulelink = 'bill' And n.tbl_insertdate = '".$curdt."' Order By n.tbl_inserttime desc");//echo "Select b.bm_tableno,n.tbl_insertdate, n.tbl_inserttime, b.bm_billno,b.bm_finaltotal, n.tbl_read, n.tbl_readby, n.tbl_readdate, n.tbl_readtime from tbl_notifications n left Join tbl_tablemaster t On t.tr_tableid = n.tbl_tableid left Join tbl_modulesubmaster ms On n.tbl_notificationtype = ms.mser_submoduleid left Join tbl_modulemaster m On ms.mser_moduleid = m.mer_moduleid left join tbl_tablebillmaster b ON b.bm_billno = n.tbl_billno where ms.mser_submodulelink = 'bill' And n.tbl_insertdate = '".$_SESSION['date']."' Order By n.tbl_inserttime desc";
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							   $timestamp = strtotime($result_stwrd['tbl_inserttime']);//echo "<br>";
							   $_5minuteslater = time() + 5 * 60;//echo "****";//< time()-300 
						 $totalval= $_5minuteslater - $timestamp;
							  if($totalval<1000 || $totalval==0)
							  {
								  if($result_stwrd['tbl_read']!='Y')
								 $_SESSION['billalertcount']++; 
							  }
							} 
					}
					echo  $_SESSION['billalertcount'];
} else if(isset($_REQUEST['set']) && $_REQUEST['set']=="kotalertrefresh")
{
	$curdt=date("Y-m-d");
                  $_SESSION['kotalertcount']=0 ;
				  $sql_stwrd  =  $database->mysqlQuery("Select tbl_tablemaster.tr_tableno, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = 'kot' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							   $timestamp = strtotime($result_stwrd['tbl_inserttime']);
							   $_5minuteslater = time() + 5 * 60;//< time()-300 
							$totalval= $_5minuteslater - $timestamp;
							  if($totalval<1000 || $totalval==0)
							  {
								  if($result_stwrd['tbl_read']!='Y')
								 $_SESSION['kotalertcount']++; 
							  }
							} 
					}
					echo  $_SESSION['kotalertcount'];
} 
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="insert")
{
	$curd=date("Y-m-d");
	$sql_stwrd  =  $database->mysqlQuery("Update tbl_notifications set tbl_read='Y' , tbl_readby='".$_SESSION['expodine_id']."' ,tbl_readdate='".$curd."' ,tbl_readtime='".date("H:i:s")."'  where tbl_notificationtype='".$_REQUEST['not']."' and  tbl_tableid='".$_REQUEST['tabl']."' and  tbl_insertdate='".$curd."' and tbl_inserttime='".$_REQUEST['time']."'");
	if($_REQUEST['not']=="9")
	{
		$notf="water";
	}else if($_REQUEST['not']=="10")
	{
		$notf="steward";
	}else if($_REQUEST['not']=="8")
	{
		$notf="bill";
	}
	?>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" >
$(document).ready(function()
{
	
	$('.class').click(function()
{
 var tbl   =  $(this).attr("tbl");
 var tbl1	  =	 tbl.split("_");
 var tablenam       =  tbl1[1];
 
 var tim   =  $(this).attr("tim");
 var tim1	  =	 tim.split("_");
 var timealert       =  tim1[1];
 
  var not   =  $(this).attr("not");
 var not1	  =	 not.split("_");
 var notalert       =  not1[1];

$.ajax({
	   type: "POST",
	   url: "../autoload_menu.php",

	   data: "set=insert&tabl="+tablenam+"&time="+timealert+"&not="+notalert,
	   success: function(msg)
	   {
		   if(notalert=="10")
		   {
				$('.popup_1').html(msg);
		   }else if(notalert=="9")
		   {
			   $('.pop_water').html(msg);
		   }
		   return false;
	   }
   });

});
	

});


</script>
    <?php
	$curdt=date("Y-m-d");
	$sql_stwrd ='';
	if($notf=="bill")
	{
		$sql_stwrd  =  $database->mysqlQuery("Select b.bm_tableno as tabname,n.tbl_insertdate, n.tbl_inserttime, b.bm_billno,b.bm_finaltotal, n.tbl_read, n.tbl_readby, n.tbl_readdate, n.tbl_readtime,n.tbl_notificationtype,n.tbl_tableid as tabid from tbl_notifications n left Join tbl_tablemaster t On t.tr_tableid = n.tbl_tableid left Join tbl_modulesubmaster ms On n.tbl_notificationtype = ms.mser_submoduleid left Join tbl_modulemaster m On ms.mser_moduleid = m.mer_moduleid left join tbl_tablebillmaster b ON b.bm_billno = n.tbl_billno where ms.mser_submodulelink = '".$notf."' And n.tbl_insertdate = '".$curdt."' Order By n.tbl_inserttime desc"); 
	}else
	{
 $sql_stwrd  =  $database->mysqlQuery("Select tbl_notifications.tbl_notificationtype,tbl_tablemaster.tr_tableno  as tabname,tbl_tablemaster.tr_tableid  as tabid, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications Inner Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid Inner Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid Inner Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid Where tbl_modulesubmaster.mser_submodulelink = '".$notf."' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
	}
				  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							  $rd=0;
							  if($result_stwrd['tbl_readby']!="")
							  {
								 $timestamp = strtotime($result_stwrd['tbl_readtime']);
								 $_5minuteslater = time() + 5 * 60;//< time()-300 
								 $totalval= $_5minuteslater - $timestamp;
								 if($totalval<1000)
								 {
									 $rd=0;
								 }else
								  {
									 $rd=1; 
								  }
							  }
							  ?>
    <?php if($rd==0){ ?>
	<a href="#" <?php if($result_stwrd['tbl_readby']==""){ ?>class="class" tbl="tbl_<?=$result_stwrd['tabid']?>" tim="tm_<?=$result_stwrd['tbl_inserttime']?>" not="not_<?=$result_stwrd['tbl_notificationtype']?>" <?php } ?>>
    <div class="notification_cont_list <?php if($result_stwrd['tbl_readby']!=""){ ?> notiify_list_visited <?php } ?>">
        <div class="nitify_table_no">Table - <span><?=$result_stwrd['tabname']?></span></div>
        <?php if($notf=="bill")
	{?>
     Amount - <?=$result_stwrd['bm_finaltotal']?>
        Bill No-<?=$result_stwrd['bm_billno']?>
    
    <?php } ?>
        <div class="nitify_time">Time : <span><?=date("h:i A",strtotime($result_stwrd['tbl_inserttime']));?> </span></div>
        <?php if($result_stwrd['tbl_readby']!=""){ ?> 
        	<div class="noti_stewrd_name">Steward - <span><?=$result_stwrd['tbl_readby']?></span> 
            <div class="nitify_time">Read : <span><?=date("h:i A",strtotime($result_stwrd['tbl_readtime']));?> </span></div>
            </div> 
		<?php } ?>
    </div></a><!--notification_cont_list--->
    <?php } ?>
  
    
    <?php } } 
	
}else   if(isset($_REQUEST['set']) && $_REQUEST['set']=="billaretupdate")
{$curd=date("Y-m-d");
	$sql_stwrd  =  $database->mysqlQuery("Update tbl_notifications set tbl_read='Y' , tbl_readby='".$_SESSION['expodine_id']."' ,tbl_readdate='".$curd."' ,tbl_readtime='".date("H:i:s")."'  where tbl_notificationtype='8'  and  tbl_insertdate='".$curd."' ");
}
else   if(isset($_REQUEST['set']) && $_REQUEST['set']=="kotaretupdate")
{$curd=date("Y-m-d");
	$sql_stwrd  =  $database->mysqlQuery("Update tbl_notifications set tbl_read='Y' , tbl_readby='".$_SESSION['expodine_id']."' ,tbl_readdate='".$curd."' ,tbl_readtime='".date("H:i:s")."'  where tbl_notificationtype='7'  and  tbl_insertdate='".$curd."' ");
}else   if(isset($_REQUEST['set']) && $_REQUEST['set']=="autorefreshalerts")
{
	
	if($_REQUEST['not']=="9")
	{
		$notf="water";
	}else if($_REQUEST['not']=="10")
	{
		$notf="steward";
	}else if($_REQUEST['not']=="8")
	{
		$notf="bill";
	}
	?>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" >
$(document).ready(function()
{
	
	$('.class').click(function()
{
 var tbl   =  $(this).attr("tbl");
 var tbl1	  =	 tbl.split("_");
 var tablenam       =  tbl1[1];
 
 var tim   =  $(this).attr("tim");
 var tim1	  =	 tim.split("_");
 var timealert       =  tim1[1];
 
  var not   =  $(this).attr("not");
 var not1	  =	 not.split("_");
 var notalert       =  not1[1];

$.ajax({
	   type: "POST",
	   url: "../autoload_menu.php",

	   data: "set=insert&tabl="+tablenam+"&time="+timealert+"&not="+notalert,
	   success: function(msg)
	   {
		   if(notalert=="10")
		   {
				$('.popup_1').html(msg);
		   }else if(notalert=="9")
		   {
			   $('.pop_water').html(msg);
		   }
		   return false;
	   }
   });

});
	

});


</script>
    <?php
	$curdt=date("Y-m-d");

if($notf=="bill")
	{
		$sql_stwrd  =  $database->mysqlQuery("Select b.bm_tableno as tabname,n.tbl_insertdate, n.tbl_inserttime, b.bm_billno,b.bm_finaltotal, n.tbl_read, n.tbl_readby, n.tbl_readdate, n.tbl_readtime,n.tbl_notificationtype,n.tbl_tableid as tabid,t.tr_tableno as tableno1,tds.ts_tableidprefix as prefix from tbl_notifications n left Join tbl_tablemaster t On t.tr_tableid = n.tbl_tableid left Join tbl_modulesubmaster ms On n.tbl_notificationtype = ms.mser_submoduleid left Join tbl_modulemaster m On ms.mser_moduleid = m.mer_moduleid left join tbl_tablebillmaster b ON b.bm_billno = n.tbl_billno left join tbl_tabledetails tds on tds.ts_tableid=n.tbl_tableid where ms.mser_submodulelink = '".$notf."' And n.tbl_insertdate = '".$curdt."' Order By n.tbl_inserttime desc"); 
	}else
	{
 $sql_stwrd  =  $database->mysqlQuery("Select tbl_notifications.tbl_notificationtype,tbl_tablemaster.tr_tableno  as tabname,tbl_tablemaster.tr_tableid  as tabid,tbl_tablemaster.tr_tableno as tableno1,tds.ts_tableidprefix as prefix, tbl_notifications.tbl_message, tbl_notifications.tbl_insertdate, tbl_notifications.tbl_inserttime, tbl_notifications.tbl_read, tbl_notifications.tbl_readby, tbl_notifications.tbl_readdate, tbl_notifications.tbl_readtime From tbl_notifications left Join tbl_modulesubmaster On tbl_notifications.tbl_notificationtype = tbl_modulesubmaster.mser_submoduleid left Join tbl_tablemaster On tbl_tablemaster.tr_tableid = tbl_notifications.tbl_tableid left Join tbl_modulemaster On tbl_modulesubmaster.mser_moduleid = tbl_modulemaster.mer_moduleid left join tbl_tabledetails tds on tds.ts_tableid=tbl_notifications.tbl_tableid Where tbl_modulesubmaster.mser_submodulelink = '".$notf."' And tbl_notifications.tbl_insertdate = '".$curdt."' Order By tbl_notifications.tbl_readtime Asc"); 
	}
			  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
				  if($num_stwrd)
				  {
					  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
						  {
							  $rd=0;
							  if($result_stwrd['tbl_readby']!="")
							  {
								 $timestamp = strtotime($result_stwrd['tbl_readtime']);
								 $_5minuteslater = time() + 5 * 60;//< time()-300 
								 $totalval= $_5minuteslater - $timestamp;
								 if($totalval<1000)
								 {
									 $rd=0;
								 }else
								  {
									 $rd=1; 
								  }
							  }
							  ?>
    <?php if($rd==0){ ?>
	<a href="#" <?php if($result_stwrd['tbl_readby']==""){ ?>class="class" tbl="tbl_<?=$result_stwrd['tabid']?>" tim="tm_<?=$result_stwrd['tbl_inserttime']?>" not="not_<?=$result_stwrd['tbl_notificationtype']?>" <?php } ?>>
    <div class="notification_cont_list <?php if($result_stwrd['tbl_readby']!=""){ ?> notiify_list_visited <?php } ?>">
        <div class="nitify_table_no notif_bill_table">Table - <span><span><?php if ($result_stwrd['tabname']!='') {
        	 echo $result_stwrd['tabname'];} else { echo $result_stwrd['tableno1']; if($result_stwrd['prefix']!=''){ echo '('.$result_stwrd['prefix'].')';}}?></span></div>
        <?php if($notf=="bill"|| $notf=="steward")
	{?>
    <div class="nitify_time notif_bill_time">Time : <span><?=date("h:i A",strtotime($result_stwrd['tbl_inserttime']));?> </span></div>
    <?php if($notf=="bill"){
    if($result_stwrd['bm_billno']!=""){

    ?>
     <span class="notif_bill_no">Bill No-<?=$result_stwrd['bm_billno']?></span>
     <span class="notif_bill_amount">Amount - <?=$result_stwrd['bm_finaltotal']?></span> 
        
    
    <?php }else { ?>
        <span  style="color: red">BILL ALERT</span>
        <?php }}} ?>
        
        <?php if($result_stwrd['tbl_readby']!=""){ ?> 
        	<div class="noti_stewrd_name notif_bill_read_cc">Steward - <span><?=$result_stwrd['tbl_readby']?></span> 
            <div class="nitify_time notif_bill_read_time">Read : <span><?=date("h:i A",strtotime($result_stwrd['tbl_readtime']));?> </span></div>
            </div> 
		<?php } ?>
    </div></a><!--notification_cont_list--->
    <?php } ?>
  
    
    <?php } } 
	

}else   if(isset($_REQUEST['set']) && $_REQUEST['set']=="korprintrefresh")
{ $data=array();
		 $sql_stwrd  =  $database->mysqlQuery("SELECT kr_kotno FROM `tbl_kotmaster` WHERE ( `kr_time`> DATE_SUB( CURRENT_TIME(), INTERVAL 5 MINUTE)) AND kr_print='N' AND  kr_date='".$_SESSION['date']."'"); 
	  $num_stwrd   = $database->mysqlNumRows($sql_stwrd);
	  if($num_stwrd)
	  {
		  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
			  {
				$data[]=$result_stwrd['kr_kotno'];					
			  }
	  }
	  $st=implode(",",$data);
	  echo $st;

	
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=="copyfolders")
{$update="";$copy='';
	 $sql_stwrd  =  $database->mysqlQuery("SELECT cm_xml_update_from_link FROM `tbl_expodine_machines` WHERE trim(`cm_ip_address`) = '".$_SESSION['hostnameorg']."'"); 
	$num_stwrd   = $database->mysqlNumRows($sql_stwrd);
	  if($num_stwrd)
	  {
		  while($result_stwrd  = $database->mysqlFetchArray($sql_stwrd)) 
			  {if($result_stwrd['cm_xml_update_found']=='Y')
				{
					if(!@copy($result_stwrd['cm_xml_update_from_link'].'xml/menus.xml','xml/menus.xml'))
					  {						
					  } else {
						 chmod('xml/menus.xml', 0777);
						$database->mysqlQuery("UPDATE tbl_expodine_machines SET cm_xml_update_found = 'N',cm_lastupdated_time = now() where trim(cm_ip_address) = trim('".$_SESSION['hostnameorg']."')");			
					  }
					  if(!@copy($result_stwrd['cm_xml_update_from_link'].'xmlupdate.xls','xmlupdate.xls'))
					  {
					  } else {
						  chmod('xmlupdate.xls', 0777);						
					  }
				}
			  }
	  }
}
?>