<?php
error_reporting(0);
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=2;

if(isset($_REQUEST['set']) && ($_REQUEST['set']=='release')){


        $id=$_REQUEST['staffid'];
        $reason=$_REQUEST['reason'];

        $sql_kot1 =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster  where ser_staffid='$id'");
	while($result_kot1  = $database->mysqlFetchArray($sql_kot1))
		{
			$user=$result_kot1['ser_firstname'];

		}

   $ad=$_SESSION['expodine_id'];

   $msg="$user login has been released by $ad with reason- $reason ";
  
   $result_rl=$database->mysqlQuery("UPDATE  tbl_logindetails  SET  ls_login_status='N' WHERE ls_staffid = '$id'");
   
   $result_rl=$database->mysqlQuery("INSERT INTO tbl_login_restrict_logs(r_message) VALUES ('$msg')");
   
   
   
}


if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
   
   if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_staffmaster SET  ser_employeestatus='Active' WHERE ser_staffid = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_staffmaster SET  ser_employeestatus='Inactive' WHERE ser_staffid = '" .$_REQUEST['id']."'");
	}
	
       $date_cr22=date('Y-m-d H:i:s'); 
       $user_bb=$_SESSION['expodine_id'];
       $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_staffmaster_logs`(`message`, `date_time`) VALUES"
       . " ('Updated status of $id by $user_bb ','$date_cr22')");   

    if (!headers_sent())
    {
        header('Location: staff_master.php?msg=3&staff_id='.$id);
        exit;
        }
    else
        {
        echo '<script type="text/javascript">';
        echo 'window.location.href="staff_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=staff_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
    
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['firstname']))
{

if(isset($_POST['brhdchk']))
{
    
  $brhdchk=$_POST['brhdchk'];

}

        $insertion['ser_mode'] =$brhdchk;


	if($brhdchk =='B')
	{ 
            
                $br="1";
		$insertion['ser_branchofficeid']=mysqli_real_escape_string($database->DatabaseLink,$br);

	}
	
	
	$insertion['ser_firstname'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['firstname']);
    	$insertion['ser_lastname']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['lastname']);
	$insertion ['ser_gender']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['gender']);

	if ($_REQUEST['dob'] !="")
	{
	  $insertion['ser_dob']=$database->convert_date($_REQUEST['dob']);
	}
        
	if($_REQUEST['nationality']!=''){
            
	$insertion ['ser_nationality']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['nationality']);

        }
        
        $insertion ['ser_address1']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['address1']);
	$insertion ['ser_address2']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['address2']);
	$insertion ['ser_mobileno']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mobileno']);
        $insertion ['ser_mobileno']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mobileno']);
        
        if($_REQUEST['salary']!=''){
            
        $insertion ['ser_salary']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['salary']);
        
        }else{
            
               $insertion ['ser_salary']= mysqli_real_escape_string($database->DatabaseLink,0);
               
        }

        if($_REQUEST['authcode']!=""){
            
          $insertion ['ser_authorisation_code']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['authcode']);
        }
        
        
	$insertion ['ser_alternateno']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['alternateno']);
        
	if($_REQUEST['city']!=''){
            
        $insertion ['ser_city']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['city']);

        }
        
        if($_REQUEST['country']!=''){
            
        $insertion ['ser_country']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['country']);
        }
        
	if ($_REQUEST['dateofjoin'] !="")
	{
            
	$insertion ['ser_dateofjoin']=$database->convert_date($_REQUEST['dateofjoin']);
	}
        
        $insertion ['ser_department']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['department']);
	$insertion ['ser_designation']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['designation']);
	$insertion ['ser_email']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['email']);
	$insertion ['ser_employeestatus']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['employeestatus']);
	$insertion ['ser_idno']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['idno']);
	$insertion ['ser_idtype']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['idtype']);

        $insertion ['ser_remarks']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['remarks']);
        
	if($_REQUEST['state']!=''){
            
        $insertion['ser_state']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['state']);

        }
        
        if($_REQUEST['floorsel'] !="")
	{
            
	$insertion['ser_defaultfloor']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['floorsel']);
	}
        
        if($_REQUEST['store_sel'] !="")
	{
            
	$insertion['ser_store_inv']= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['store_sel']);
	}
        
        $insertion['ser_created_by']= mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']);
        
        $date_cr=date('Y-m-d H:i:s');
        $insertion['ser_created_time']= mysqli_real_escape_string($database->DatabaseLink,$date_cr);
        
        
       
        
	$active='';
        
	 if(isset($_REQUEST['cancelpermission']))
	{
	 		$active='Y';
	}else
	{
		$active='N';
	}

	$insertion['ser_cancelpermission']=$active;



        $active3='';
	if(isset($_REQUEST['manualdiscount']))
	{
	 		$active3='Y';
	}else
	{
		$active3='N';
	}

        $active4='';
	if(isset($_REQUEST['stockchange']))
	{
	        $active4='Y';
	}else
	{
		$active4='N';
	}

	$insertion['ser_stockchng_permission']=$active4;


	$dis_permission='';

	if(isset($_REQUEST['discountpermission']))
	{
		$dis_permission='Y';
	}
	else
	{
		$dis_permission='N';
	}
		$insertion['ser_discountpermission']=$dis_permission;
		$complementarymanagement='';

	if(isset($_REQUEST['complementarymanagement']))
	{
		$complementarymanagement='Y';
	}
	else
	{
		$complementarymanagement='N';
	}

		$insertion['ser_compl_mgmt']=$complementarymanagement;

	$active2='';
	if($_REQUEST['hidloginstatus']=="Yes")
	{
			 if(isset($_REQUEST['cancelwithkey']))
			{
					$active2='Y';
			}else
			{
				$active2='N';
			}
	}else
	{
		$active2='Y';
	}
        
	$insertion['ser_cancelwithkey']=$active2;
	
        $sql=$database->check_duplicate_entry('tbl_staffmaster',$insertion);
        
	 if($sql!=1)
	{
	$insertid           =  $database->insert('tbl_staffmaster',$insertion);
        
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
        
         
   
         
         
        
	  $sql = "SELECT * FROM tbl_staffmaster WHERE ";
	    foreach( $insertion as $field => $value )
        {
            $updates[] = "`$field` = '$value'";
        }
         $sql .= implode(' and ', $updates);

	$sql_stff  =  $database->mysqlQuery($sql);
	while($result_stff  = $database->mysqlFetchArray($sql_stff))
	{
		$id=$result_stff['ser_staffid'];
	}
        
        
        
        ///staff credit master adding/////
                        
        $insertion4['crd_branchid'] 		=  '1';
		
	$insertion4['crd_active'] 		=  'Y';
	
	$insertion4['crd_type'] 		=  '2';	
                        
	$insertion4['crd_totalamount'] =		0;
		
        $insertion4['crd_staffid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($id));              
               		
        $sql5=$database->check_duplicate_entry('tbl_credit_master',$insertion);
   
	 if($sql5!=1)
	{
	   $insertid4   =  $database->insert('tbl_credit_master',$insertion4);          
                       
        }
        
        
         /////staff ledger/////
        
           $cr='20';
           $staff_acc='';
           $sql_kot  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid='$id' "); 
	   $num_kot   = $database->mysqlNumRows($sql_kot);
	   if($num_kot){
	   while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
	   {
               $staff_acc=$result_kot['ser_firstname'];
           }}
           
                    $insertion11['tlm_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['staff']));
                    $insertion11['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($staff_acc));
                    $insertion11['tlm_group'] 		         =  mysqli_real_escape_string($database->DatabaseLink,trim($cr));
      
       $sql1=$database->check_duplicate_entry('tbl_ledger_master',$insertion11);
  
	 if($sql1!=1)
	{
	   $insertid11    =  $database->insert('tbl_ledger_master',$insertion11);
        } 
           
        ///end//////
        
        
	$desigbranch="";
	 $sql_kot  =  $database->mysqlQuery("select * from tbl_designationmaster where dr_designationid='".$_REQUEST['designation']."'");
	 while($result_kot  = $database->mysqlFetchArray($sql_kot))
		{
			$desigbranch=$result_kot['dr_isbranch'];
		}


            if($active=="Y")
            {
                try {
 		$database->mysqlQuery("SET @staffid = " . "'" . $id . "'");
		$secretkey='';
		$sq=$database->mysqlQuery("CALL proc_gensecretkey(@staffid,@secretkey)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
}

	if($_REQUEST['hidloginstatus']=="Yes")
	{
		if ($_SESSION['headofid']!="")
		{
                    
		        $headoff= $_SESSION['headofid'];
			
			$encrypted_password=md5($_REQUEST['password']);
                        
			$insertions['ls_username'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['username']);
			$insertions['ls_password'] 		=  $encrypted_password;
			$insertions['ls_staffid'] 		=  $id;
                        
				if(isset($_REQUEST['chkapplogin']))
				  {
						  $insertions['ls_applogin'] 		=  'Y';
				  }else
				  {
						  $insertions['ls_applogin'] 		=  'N';
				  }
                                  
				  if($_REQUEST['headoffice']!="")
				  {
                                      
				   $insertions['ls_headofficeid'] 	=mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['headoffice']);
				  }
				
				  else
				  {
                                      $br1="1";
                                      
			              $insertions['ls_branchid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$br1);
				  }
                                  
				      $insertid              			=  $database->insert('tbl_logindetails',$insertions);
		}
		else
		{          
                                $br1="1";
                
				$branchnew=mysqli_real_escape_string($database->DatabaseLink,$br1);
                                
				$headoff="";
				$encrypted_password=md5($_REQUEST['password']);
				$insertions['ls_username'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['username']);
			
				$insertions['ls_password'] 		=  $encrypted_password;
				$insertions['ls_staffid'] 		=  $id;
				if(isset($_REQUEST['chkapplogin']))
				  {
						  $insertions['ls_applogin'] 		=  'Y';
				  }else
				  {
						  $insertions['ls_applogin'] 		=  'N';
				  }
						  $insertions['ls_branchid'] 		=  $branchnew;

						  $insertid         =  $database->insert('tbl_logindetails',$insertions);


                                  }
	}

	$database->updateexpodine_machines();
       
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select ser_staffid from tbl_staffmaster where 	ser_firstname='".$insertion['ser_firstname']."' AND ser_lastname='".$insertion['ser_lastname']."'");
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login))
			{
				 $lastid=$result_login['ser_staffid'];
			}
                        
                        
          $sql_login9  =  $database->mysqlQuery("select * from tbl_staffmaster where ser_staffid='".$lastid."' ");
	  $num_login9   = $database->mysqlNumRows($sql_login9);
          if($num_login9){
		  while($result_login9  = $database->mysqlFetchArray($sql_login9))
			{
				 $fname=$result_login9['ser_firstname'];
                                 $gender=$result_login9['ser_gender'];
                                 $dob=$result_login9['ser_dob'];
                                 $add=$result_login9['ser_address1'];
                                 $num=$result_login9['ser_mobileno'];
                                 $password=$result_login9['ser_authorisation_code'];
                                 $c_password=$result_login9['ser_authorisation_code'];
			}      
          }
                        
              
    if($_REQUEST['designation']=='1' ||  $_REQUEST['designation']=='7' || $_REQUEST['designation']=='8' ){
        
        
        $from_id=0;
        
       if($_REQUEST['designation']=='1'){
           
           $from_id='2';
           
       }
       
       if($_REQUEST['designation']=='7'){
           
           $from_id='4';
           
       }
       
       if($_REQUEST['designation']=='8'){
           $from_id='3';
       }
       
        //normal////    
    $query3=$database->mysqlQuery("UPDATE  tbl_staffmaster  to1, tbl_staffmaster from1
    SET to1.ser_compl_mgmt=from1.ser_compl_mgmt,to1.ser_cancelpermission =from1.ser_cancelpermission, 
    to1.ser_discountpermission =from1.ser_discountpermission ,to1.ser_stockchng_permission =from1.ser_stockchng_permission, 
    to1.ser_cancelwithkey=from1.ser_cancelwithkey,to1.ser_discount_manual =from1.ser_discount_manual , 
    to1.ser_counter_enable_generate =from1.ser_counter_enable_generate, to1.ser_counter_enable_hold =from1.ser_counter_enable_hold, 
    to1.ser_dayclose_revert_permission=from1.ser_dayclose_revert_permission,to1.ser_permit_cash_drawer_open =from1.ser_permit_cash_drawer_open,
    to1.ser_kot_cancel_permission =from1.ser_kot_cancel_permission, 
    to1.ser_bill_settle_permission=from1.ser_bill_settle_permission,to1.ser_bill_cancel_permission =from1.ser_bill_cancel_permission,
    to1.ser_rate_edit =from1.ser_rate_edit, 
    to1.ser_counter_settle_permission=from1.ser_counter_settle_permission,to1.ser_dayclose_permission =from1.ser_dayclose_permission,
    to1.ser_shift_permission =from1.ser_shift_permission, to1.ser_release_login =from1.ser_release_login,
    to1.ser_bill_regen_per =from1.ser_bill_regen_per, 
    to1.ser_bill_reprint_per = from1.ser_bill_reprint_per, to1.ser_kot_reprint_per =from1.ser_kot_reprint_per,
    to1.ser_bill_settle_change_per =from1.ser_bill_settle_change_per, to1.ser_order_split_permission = from1.ser_order_split_permission,
    to1.ser_tip_edit_permission =from1.ser_tip_edit_permission ,to1.ser_bill_reset =from1.ser_bill_reset,to1.ser_credit_view=from1.ser_credit_view,
    to1.ser_comp_view=from1.ser_comp_view,to1.ser_credit_permission=from1.ser_credit_permission,
    to1.ser_comp_permission=from1.ser_comp_permission,to1.ser_bill_print_permission=from1.ser_bill_print_permission,
    to1.ser_bill_edit_permission=from1.ser_bill_edit_permission,to1.ser_change_table_permission=from1.ser_change_table_permission,
    to1.ser_advance_pay_permission=from1.ser_advance_pay_permission,to1.ser_counter_settle_permission=from1.ser_counter_settle_permission,
    to1.ser_reset_accounts=from1.ser_reset_accounts,to1.ser_online_order=from1.ser_online_order,
      to1.ser_inv_permission=from1.ser_inv_permission, to1.ser_physical_stock_permission=from1.ser_physical_stock_permission, 
      to1.ser_wastage_entry`=from1.ser_wastage_entry,
      to1.ser_stock_entry= from1.ser_stock_entry,
      to1.ser_req=from1.ser_req, to1.ser_po=from1.ser_po, to1.ser_rps= from1.ser_rps, to1.ser_store_transfer=from1.ser_store_transfer,
      to1.ser_return_history= from1.ser_return_history,
      to1.ser_inventory_reports= from1.ser_inventory_reports, to1.ser_purchase_return=from1.ser_purchase_return,
      to1.ser_consumption=from1.ser_consumption, to1.ser_store_stock= from1.ser_store_stock,
      to1.ser_dashboard=from1.ser_dashboard, to1.ser_recipe= from1.ser_recipe, to1.ser_production= from1.ser_production,
      to1.ser_central_kitchen=from1.ser_central_kitchen, to1.ser_central_accept=from1.ser_central_accept,
      to1.ser_com_item=from1.ser_com_item, to1.ser_inv_check_all= from1.ser_inv_check_all, to1.ser_force_close= from1.ser_force_close,
      to1.ser_discount_after= from1.ser_discount_after,
      to1.ser_all_shift_closer= from1.ser_all_shift_closer, to1.ser_item_discount_manual=from1.ser_item_discount_manual,
      to1.ser_indent=from1.ser_indent, to1.ser_delete_menu=from1.ser_delete_menu,
      to1.ser_menu_unit_edit=from1.ser_menu_unit_edit, to1.ser_approve_cancel_inv=from1.ser_approve_cancel_inv,
       to1.ser_direct_transfer= from1.ser_direct_transfer, to1.ser_indent_accept= from1.ser_indent_accept,
      to1.ser_normal_transfer_accept= from1.ser_normal_transfer_accept, to1.ser_direct_transfer_accept=from1.ser_direct_transfer_accept
      WHERE from1.ser_staffid = '$from_id' and to1.ser_staffid ='$lastid' ");
           
    
    $query34=$database->mysqlQuery("UPDATE  tbl_logindetails  to1, tbl_logindetails from1 "
    . " SET to1.ls_restrict_login=from1.ls_restrict_login,to1.ls_applogin=from1.ls_applogin WHERE from1.ls_staffid='$from_id' and to1.ls_staffid ='$lastid' ");
   
    
      ////app///
     $query3=$database->mysqlQuery("UPDATE  tbl_app_permissions  to1, tbl_app_permissions from1
     SET to1.tap_app_login=from1.tap_app_login , to1.tap_dinein_module=from1.tap_dinein_module ,  to1.tap_tahd_module=from1.tap_tahd_module , 
     to1.tap_cs_module=from1.tap_cs_module , to1.tap_item_cancel=from1.tap_item_cancel , to1.tap_bill_cancel=from1.tap_bill_cancel 
     WHERE from1.tap_staff_id = '$from_id' and to1.tap_staff_id ='$lastid' ");
    
       
     ///user permission//
     
        $from_user1=	$from_id;
	$to_user1=$lastid;
        
        
        $sql_mainmod  =  $database->mysqlQuery("select ls_username  from tbl_logindetails where ls_staffid='$from_user1' "); 
        $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
        if($num_mainmod){
	while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
	{
            $from_user=$result_mainmod['ls_username'];
        }
        }
        
        
        $sql_mainmod3  =  $database->mysqlQuery("select ls_username  from tbl_logindetails where ls_staffid='$to_user1' "); 
        $num_mainmod3   = $database->mysqlNumRows($sql_mainmod3);
        if($num_mainmod3){
	while($result_mainmod3  = $database->mysqlFetchArray($sql_mainmod3)) 
	{
            $to_user=$result_mainmod3['ls_username'];
        }
        }
        
        
	if($to_user !="")
	{
                     
          $dlt_query=$database->mysqlQuery("DELETE FROM  tbl_usermodules WHERE um_username ='$to_user'"); 
      
          $insrt_query=$database->mysqlQuery("INSERT INTO tbl_usermodules(um_username, um_moduleid, um_submoduleid, um_access)"
          . " select '$to_user', um_moduleid, um_submoduleid, um_access from tbl_usermodules where um_username = '$from_user' ")	 ;
		 
	}
     
        /////end////
        
     
      }
          
          
          
             

          }
	
    if (!headers_sent())
    {
        header('Location: staff_master.php?msg=2');
        exit;
        }
    else
        {
        echo '<script type="text/javascript">';
        echo 'window.location.href="staff_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=staff_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}



if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['firstname1']))
{
    
        $string='';

	if(isset($_POST['hidemode']))
        {
          $brhdchk1=$_POST['hidemode'];

        }

        
	$id=$_REQUEST['staffid'];
	$us=$_REQUEST['user12'];

	$firstname=$_REQUEST['firstname1'];

	$lastname=$_REQUEST['lastname1'];
	$gender=$_REQUEST['gender1'];
        if($_REQUEST['dob1']!=''){
	$dateOb=$database->convert_date($_REQUEST['dob1']);
	$newdate	= explode("-",$dateOb);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
        
	if(strlen($date) == '2')
	{
		$dob11		= $year."-".$month."-".$date;
	}
	else
	{
	$dob11		= $date."-".$month."-".$year;
	}
        $string.=" ,ser_dob='".$dob11."'";
        }
        if($_REQUEST['dateofjoin1']!=''){
	$dateOj=$database->convert_date($_REQUEST['dateofjoin1']);
		$newdate1	= explode("-",$dateOj);
	$date1		= $newdate1[0];
	$month1		= $newdate1[1];
	$year1		= $newdate1[2];
	if(strlen($date1) == '2')
	{
		$dateofjoin11		= $year1."-".$month1."-".$date1;
	}
	else
	{
	$dateofjoin11		= $date1."-".$month1."-".$year1;
	}
          $string.=" ,ser_dateofjoin='".$dateofjoin11."'";
        }

	$address11=$_REQUEST['address11'];
        $address2=$_REQUEST['address22'];
	$mobile=$_REQUEST['mobileno1'];
        
        
        if($_REQUEST['salary1']!='' || $_REQUEST['salary1']!=null){
        $salary1=$_REQUEST['salary1'];
        }else{
            $salary1=0;
        }
	$alternateno=$_REQUEST['alternateno1'];


	$department=$_REQUEST['department1'];
	$designation=$_REQUEST['designation1'];

	$email=$_REQUEST['email1'];
	$employeestatus=$_REQUEST['employeestatus1'];
	$idno=$_REQUEST['idno1'];
	$idtype=$_REQUEST['idtype1'];
	$remarks=$_REQUEST['remarks1'];

	$floor= $_REQUEST['floorsel1'];

           
        $authcod=$_REQUEST['authcode1'];

	$active='';


        $active3='';


        $active4='';

      $query13=$database->mysqlQuery(" update tbl_ledger_master set tlm_ledger_name='".$firstname."' where tlm_staff_id='".$id."'");

      $date_upd=date('Y-m-d H:i:s');
      $update_by=" By ".$_SESSION['expodine_id']."  at  $date_upd ";
      
       if($_REQUEST['store_sel1']!='' &&  $_REQUEST['store_sel1']!=null  &&  $_REQUEST['store_sel1']!=' ' ){
           
        $store=$_REQUEST['store_sel1'];
        
        if($authcod==""){
              
                $query13=$database->mysqlQuery(" update tbl_staffmaster set ser_last_update='$update_by', ser_store_inv='$store', "
                . " ser_firstname='".$firstname."', ser_lastname='".$lastname."',ser_gender='".$gender."',ser_address1='".$address11."',"
                . " ser_address2='".$address2."',ser_mobileno='".$mobile."',ser_salary='".$salary1."' ,ser_alternateno='".$alternateno."',"
                . " ser_department='".$department."',ser_designation='".$designation."',ser_email='".$email."',ser_employeestatus='".$employeestatus."',"
                . " ser_idno='".$idno."',ser_idtype='".$idtype."',ser_remarks='".$remarks."',ser_defaultfloor='".$floor."',"
                . " ser_authorisation_code=NULL $string where ser_staffid='".$id."'");
                
      }else{
          
               $query13=$database->mysqlQuery(" update tbl_staffmaster set ser_last_update='$update_by',ser_store_inv='$store', ser_firstname='".$firstname."',"
               . "  ser_lastname='".$lastname."',ser_gender='".$gender."',ser_address1='".$address11."',ser_address2='".$address2."',"
               . " ser_salary='".$salary1."',ser_mobileno='".$mobile."',ser_alternateno='".$alternateno."',ser_department='".$department."',"
               . " ser_designation='".$designation."',ser_email='".$email."',ser_employeestatus='".$employeestatus."',ser_idno='".$idno."',"
               . " ser_idtype='".$idtype."',ser_remarks='".$remarks."', ser_defaultfloor='".$floor."',ser_authorisation_code='".$authcod."' "
               . " $string where ser_staffid='".$id."'");
      }
        
        }else{
            
            if($authcod==""){
                 
                $query13=$database->mysqlQuery(" update tbl_staffmaster set  ser_last_update='$update_by',ser_firstname='".$firstname."', "
                . " ser_lastname='".$lastname."',ser_gender='".$gender."',ser_address1='".$address11."',ser_address2='".$address2."', "
                . " ser_mobileno='".$mobile."',ser_salary='".$salary1."' ,ser_alternateno='".$alternateno."',ser_department='".$department."', "
                . " ser_designation='".$designation."',ser_email='".$email."',ser_employeestatus='".$employeestatus."',ser_idno='".$idno."',"
                . " ser_idtype='".$idtype."',ser_remarks='".$remarks."',ser_defaultfloor='".$floor."',ser_authorisation_code=NULL $string "
                . " where ser_staffid='".$id."'");
                
            }else{
              
               $query13=$database->mysqlQuery(" update tbl_staffmaster set  ser_last_update='$update_by',ser_firstname='".$firstname."', "
               . " ser_lastname='".$lastname."',ser_gender='".$gender."',ser_address1='".$address11."',ser_address2='".$address2."',"
               . " ser_salary='".$salary1."',ser_mobileno='".$mobile."',ser_alternateno='".$alternateno."',ser_department='".$department."',"
               . " ser_designation='".$designation."',ser_email='".$email."',ser_employeestatus='".$employeestatus."',ser_idno='".$idno."',"
               . " ser_idtype='".$idtype."',ser_remarks='".$remarks."', ser_defaultfloor='".$floor."',ser_authorisation_code='".$authcod."'"
               . " $string where ser_staffid='".$id."'");
            }
        
          
    }
      
    
       $date_cr22=date('Y-m-d H:i:s'); 
       $user_bb=$_SESSION['expodine_id'];
       $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_staffmaster_logs`(`message`, `date_time`) VALUES"
       . " ('Updated staff details of $id by $user_bb ','$date_cr22')"); 
      
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");

	 $desigbranch="";
	 $sql_kot  =  $database->mysqlQuery("select * from tbl_designationmaster where dr_designationid='".$_REQUEST['designation1']."'");
	 while($result_kot  = $database->mysqlFetchArray($sql_kot))
	 {
			$desigbranch=$result_kot['dr_isbranch'];
	  }

	if($active=="Y")
	{

			$result='';
			$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_secretkeymaster  WHERE  sr_staffid='" . $id . "' AND  (sr_expiredtime ='0000-00-00 00:00:00' OR  sr_expiredtime IS NULL)");
			$num_table3  = $database->mysqlNumRows($sql_table_sel3);
			if($num_table3)
			{
				  $result= "yes";
			}else
			{
				  $result= "no";
			}
			if($result=="no")
			{
                            
			 try {
					$database->mysqlQuery("SET @staffid = " . "'" . $id . "'");
					$secretkey='';
					$sq=$database->mysqlQuery("CALL proc_gensecretkey(@staffid,@secretkey)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
					 } catch (Exception $e) {
					  $returnmsg= 'Caught exception: '.  $e;
					  $file = 'log.txt';
					  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
					  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
					  echo $returnmsg; exit();
				  }
			}
		}
                
	$database->updateexpodine_machines();


	if($us =='ys')
	{


		if($_REQUEST['hidloginstatus1']=="Yes")
	{
		$test=$_REQUEST['hidloginstatus1'];

		$id1=$_REQUEST['username1'];
                
		$staff=$_REQUEST['staffid'];
                
			if(isset($_REQUEST['chkapplogin1']))
			  {
	 		$ls_applogin1		=  'Y';
			  }else
			  {
	 		$ls_applogin1		=  'N';
			  }



	$result='';

	$query33=$database->mysqlQuery("update tbl_logindetails set ls_username='".$id1."',ls_status='Y' where ls_staffid='".$staff."'");

	}
	else
	{
		$test=$_REQUEST['hidloginstatus1'];
		$id1=$_REQUEST['username1'];

		$staff=$_REQUEST['staffid'];
                
			if(isset($_REQUEST['chkapplogin1']))
			  {
	 		         $ls_applogin1		=  'Y';
			  }else
			  {
	 		         $ls_applogin1		=  'N';

			  }

	$query33=$database->mysqlQuery("update tbl_logindetails set ls_username='".$id1."', ls_status='N' where ls_staffid='".$staff."'");

	}


    if (!headers_sent())
    {
        header('Location: staff_master.php?msg=3&staff_id='.$id);
        exit;
        
    }
    else
        {
        echo '<script type="text/javascript">';
        echo 'window.location.href="staff_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=staff_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
	}
	else
	{

		if($_REQUEST['hidloginstatus12']=="Yes")
	{
                    
	if ($_SESSION['headofid']!="")
	{
		$headoff= $_SESSION['headofid'];
		$branchnew="";
		$encrypted_password=md5($_REQUEST['password12']);
                 
		$insertions['ls_username'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['username12']);
		
		$insertions['ls_password'] 		=  $encrypted_password;
		$insertions['ls_staffid'] 		= $_REQUEST['staffid'];

			if(isset($_REQUEST['chkapplogin12']))
			  {
					  $insertions['ls_applogin'] 		=  'Y';
			  }else
			  {
					  $insertions['ls_applogin'] 		=  'N';
			  }



			if($_REQUEST['headofficename']!="")
			{  
                                $insertions['ls_headofficeid'] 	= $_REQUEST['headofficename'];
			}
			if($_REQUEST['branchname']!="")
			{ 
                                 $br2="1";
				 $insertions['ls_branchid'] 	= $br2;
			}

			   $insertid              			=  $database->insert('tbl_logindetails',$insertions);
	}
	else
	{
		    $branchnew= "1";

		    $encrypted_password=md5($_REQUEST['password12']);
		    $insertions['ls_username'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['username12']);
			
		    $insertions['ls_password'] 		=  $encrypted_password;
                    
		    $insertions['ls_staffid'] 		= $_REQUEST['staffid'];
                    
			if(isset($_REQUEST['chkapplogin12']))
			  {
					  $insertions['ls_applogin'] 		=  'Y';
			  }else
			  {
					  $insertions['ls_applogin'] 		=  'N';
			  }
					

                                         $insertions['ls_branchid'] 		= $branchnew;
			                 $insertid              		=  $database->insert('tbl_logindetails',$insertions);




        }
	}



	}
        
    header("location: staff_master.php?msg=3&staff_id=".$id);
    
    if (!headers_sent())
    {
        header('Location: staff_master.php?msg=3&staff_id='.$id);
        exit;
        }
    else
        {
        echo '<script type="text/javascript">';
        echo 'window.location.href="staff_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=staff_master.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}

$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}

?>


<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Staff Master</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">
<link rel="stylesheet" href="master_style/table_style.css">
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.form_textbox_cc .tooltip{display:none !important;}
.fa-eye{  color: #000;position: relative;top: 4px;}
.ui-autocomplete{z-index:999999 !important;}
.geogrph_table .first_form_contain{height: 45px !important;}
.staff_view_tbl td{text-align:left;padding-left:10px;}
.md-content .form-control{height: 33px;padding: 0px 12px;border-radius:3px;}
.md-content .geogrph_table .form_name_cc{line-height:40px;}
 .index_popup_1{
            width:55%;
            height:180px;
            position:absolute;
            margin:auto;
            background-color:#fff;
            border-radius:5px;
            box-shadow:0 0 5px #ccc;
            right:0;
            left:0;
            top:0;
            bottom:0;
            z-index:9999;
            overflow:hidden;
        }
        .btn_index_popup{
                width:18%;
                display:inline-block;
                height:30px;
                line-height:25px;
                background-color: lightgray;
                text-align:center;
                margin-right:1%;
                border-radius:5px;
                transition:all 0.2s ease;

            }
            .md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
 </style>

<script>

    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
    $("#modal-17").removeClass('md-show');

    });

	

$(document).ready(function(){


	$("#add_staff").click(function()
	{

		
	$("#firstname").focus();
        
	});

	$("#staffname").focus();


	$('.table_report tr').click(function() {
            
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
    
	$('.md-trigger_stf').click( function() {



			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block");
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/staff_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);

				  $('.mynewpopupload').html(data);
				  });
	});
	$('.md-button').click( function() {

			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block");
			$(".olddiv").addClass("new_overlay");
			var staffid=$('#hiddenmenuid').val();
			  $.post("popup/staff_view.php", {staff:staffid},
				  function(data)
				  {
				  data=$.trim(data);

				  $('.mynewpopupload').html(data);
				  });
	});
        
	$('.ui-corner-all').click( function() {
	validateSearch();
	});


});
</script>

<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/style_date.css">
<script>
 $(document).ready(function() {

  $("#dob").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#dateofjoin").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$('#staffname').autocomplete({source:'autocomplete/find_keywords.php?type=sname_s', minLength:1});
			$('#deptname').autocomplete({source:'autocomplete/find_keywords.php?type=dep_s', minLength:1});
			$('#desg').autocomplete({source:'autocomplete/find_keywords.php?type=desg_s', minLength:1});
			$('#emplystatus').autocomplete({source:'autocomplete/find_keywords.php?type=emp_s', minLength:1});
 });
</script>
<script>
$(document).ready(function(){
    
    var url_check=$('#url_check').val();
    
   var new_id=url_check.split('staff_id=');
   
  
   if(new_id[1]=='' || new_id[1]=='undefined' || new_id[1]==undefined ){
                localStorage.staffname_ld = 'null';
                localStorage.deptname_ld = 'null';
                localStorage.desg_ld = 'null';
                localStorage.emplystatus_ld = 'null';
   }
   
   
    $('.change_cls_'+new_id[1]).addClass('table_active');
    
    
                if(localStorage.staffname_ld !='' && localStorage.staffname_ld !='null' )  {   
                    $('#staffname').val(localStorage.staffname_ld);
                
                 }else{
                 $('#staffname').val('');  
                 }
                      
                $('#deptname').val(localStorage.deptname_ld);
                $('#desg').val( localStorage.desg_ld);
                 $('#emplystatus').val(localStorage.emplystatus_ld);
                 
                 
       if(localStorage.staffname_ld !='null'  || localStorage.deptname_ld !='null' || localStorage.desg_ld !='null' ||  localStorage.emplystatus_ld !='null')      
                 
        {
            validateSearch();
            
        }
    
    
    
    
    
    
    
    
    
    
$('#designation').change(function(){

      $('#confirmcode').prop('readonly', false);
           $('#authcode').prop('readonly', false);
           
  var  codeauth=$(this).find('option:selected').attr('authcodeshow');
  if(codeauth=="N"){
   
     $('#authcode').prop('readonly', true);
     
      $('#authcode').val();
  }

  var  codeauth2=$(this).find('option:selected').attr('authcodeshow2');
  if(codeauth2=="N"){
     $('#confirmcode').prop('readonly', true);
    
      $('#authcode').val();
  }

    var optionSelected = $(this).find('option:selected').attr('title');
  
	$('#hidloginstatus').val(optionSelected);

	$('#hidloginstatus12').val(optionSelected);
	if(optionSelected=="Yes")
	{
		$('#forloginonly').css("display", "block");
                $('#username').val($('#firstname').val());
	}else
	{
                $('#username').val('');
		$('#forloginonly').css("display", "none");
	}
});
 });

</script>

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }

</style>
</head>
<body>


    <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >


<div class="olddiv "></div>
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Staff Master</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="cc_new_main">
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
				<div class="als-viewport" style="width:100% !important">
					<?php  include "includes/page_top.php"; ?>
                                    <div style="width:110px;position: absolute;right: 18px;top: -15px;" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #d17171;font-size: 14px;height: 30px;line-height: 30px;color: black;font-weight: bold" href="user_permission.php" >USER PERMISSION </a></div>
				</div>
			</div>
                   </div><!--cc_new-->
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                            	<span class="filte_new_text">Staff Name</span>
                                <input type="text" class="form-control filte_new_box" id="staffname" name="staffname" placeholder="Staff Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                               <span class="filte_new_text">Select Department</span>
                                <select  class="add_text_box filte_new_box"  id="deptname" name="deptname" onChange="validateSearch()">
                                 <option value="null" default>All</option>

                                 <?php
									 $sql_login  =  $database->mysqlQuery("select * from  tbl_departmentmaster ");
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login))
											{
	 										?>
                                <option value="<?=$result_login['der_departmentname']?>"><?=$result_login['der_departmentname']?></option>
                               <?php } } ?>
                                </select>
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                              	<span class="filte_new_text">Select Designation</span>
                                 <select  class="add_text_box filte_new_box"  id="desg" name="desg" onChange="validateSearch()">
                                 <option value="null" default>All</option>

                                 <?php
									 $sql_login  =  $database->mysqlQuery("select * from tbl_designationmaster where dr_designationname<>'Super Admin' ");
									  $num_login   = $database->mysqlNumRows($sql_login);
									  if($num_login){
										  while($result_login  = $database->mysqlFetchArray($sql_login))
											{
	 										?>
                                <option value="<?=$result_login['dr_designationname']?>"><?=$result_login['dr_designationname']?></option>
                               <?php } } ?>
                                </select>
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                               <span class="filte_new_text">Select Status</span>
                                <select  class="add_text_box filte_new_box"  id="emplystatus" name="emplystatus" onChange="validateSearch()">
                                <option value="null">All</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                                   <option value="Terminated">Terminated</option>
                                      <option value="Suspended">Suspended</option>
                                </select>
                            </div>
                            <!-- <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%">
                                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Key words to search" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                            </div>-->
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                                <div style="margin-left:2%; width: 25%;display: none" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>
                                <div style="margin-left:2%;width: 25%;" class="search_btn_member_invoice filte_new_box_btn"><a href="staff_master.php" >Reset</a></div>
                            </div>
                        </div><!--form_group-->
                    </div>
                   <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                          <a tittle="Add" href="#" class="md-trigger add_btn_2" id="add_staff" data-modal="modal-17" onClick="staffclr()" ></a>
                      </div>
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter "  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Staff Name</th>
                              
                                 <th>Department</th>
                                 <th>Designation</th>
                                 <th style="display:none"> Status</th>
                                  <th> Login Status</th>
                                  <th>Login ID </th>
                                  <td style="min-width:230px;width:28%">Action</td>
                              </tr>
                             </thead>
                             
                                 <?php
                                 
                                 $addmn_string=''; $del='';
                                 
                                 if($_SESSION['expodine_id'] != 'admin'){   
                                     
                                    $addmn_string.=" and DS.dr_designationname<>'Super Admin' ";
                                     
                                    $del.=" and S.ser_delete_mode='N' ";  
                                     
                                 }else{
                                     
                                    $addmn_string.="";  
                                    
                                     $del.="";  
                                    
                                 }
                                 
                            

		if($_SESSION['branchofid']!="")
		{
			
	            $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster AS S LEFT JOIN tbl_departmentmaster AS D ON "
                    . " S.ser_department=D.der_departmentid LEFT JOIN tbl_designationmaster AS DS ON S.ser_designation=DS.dr_designationid "
                    . " LEFT JOIN tbl_branchmaster AS B ON S.ser_branchofficeid=B.be_branchid left join tbl_logindetails tl on tl.ls_staffid=S.ser_staffid"
                    . " where S.ser_branchofficeid='".$_SESSION['branchofid']."' and"
                    . " S.ser_branchofficeid = B.be_branchid $addmn_string $del order by s.ser_firstname asc");

		}else{


	   $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster AS S  LEFT JOIN tbl_departmentmaster AS D ON "
           . "S.ser_department=D.der_departmentid LEFT JOIN tbl_designationmaster AS DS ON S.ser_designation=DS.dr_designationid"
           . " LEFT JOIN tbl_branchmaster AS B ON S.ser_branchofficeid=B.be_branchid left join tbl_logindetails tl on tl.ls_staffid=S.ser_staffid"
           . " where S.ser_staffid!='' $addmn_string $del order by s.ser_firstname asc");

		}
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login))
			{

                      if($result_login['ls_login_status']=="Y"){
                          $login=" IN";
                      }else {
                        $login=" OUT" ;
                      }

                     if($result_login['ls_login_status']==""){
                         $login="NO LOGIN" ;
                     }
                     
                     
                      if($result_login['ls_username']!=""){
                         $user_login=$result_login['ls_username'];
                     }else{
                       $user_login ='[X]'; 
                     }
                     

	 ?>
    				<tr id="ids_<?=$result_login['ser_staffid']?>"  class="change_cls_<?=$result_login['ser_staffid']?>" >
                                 <td  <?php  if($result_login['ser_staffid']=='1'){ ?> style="color:darkred;font-weight: bold" <?php } ?>     ><?=$result_login['ser_firstname']." ".$result_login['ser_lastname']?></td>
                                <td><?=$result_login['der_departmentname']?></td>
                                     <td><?=$result_login['dr_designationname']?></td>
                                     <td style="display:none">  <?=$result_login['ser_employeestatus']?></td>
                                     <td>  <?=$login?> &nbsp; <?php if($_SESSION['ser_release_login']=="Y" && $result_login['ls_login_status']!="" && $result_login['ls_login_status']=="Y" && $result_login['ls_restrict_login']=="Y" ){ ?>
                                         <span onclick="return release_login('<?=$result_login['ser_staffid']?>');"   class="staff_permission_btn stfid" stf="<?=$result_login['ser_staffid']?>"
                                               style="float:right;background-color:#A91400;cursor: pointer;margin-right: 3px;">Release</span>  &nbsp; &nbsp; <?php } ?> </td>
                             
                                      <td style="text-align: left;padding-left: 5px;font-size: 12px " title="Login name and staff id"> <?//=$user_login?> ID &nbsp; :  &nbsp; <?=$result_login['ser_staffid']?> </td>
                                   
                                     
                                     <td style="    min-width: 223px;width: 28%;">

                                      
                                    <a title="ATTENDANCE" style="margin: 0 1%;display: none"  class="tab_edt_btn " href="staff_attendance.php?id=<?=$result_login['ser_staffid']?>&name=<?=$result_login['ser_firstname']?>" ><i class="fa fa-calendar"></i></a>
                                       
                                     <?php  if(trim($_SESSION['expodine_id']) ==  "admin" && $result_login['ser_delete_mode']=='N' && ($result_login['ser_staffid']!='1' && $result_login['ser_staffid']!='2' && $result_login['ser_staffid']!='3' && $result_login['ser_staffid']!='4')){  ?>     
                                    
                                     <a title="DELETE" style="margin: 0 1%;"  class="tab_edt_btn " href="#" onclick="delete_staff('<?=$result_login['ser_staffid']?>')"><i class="fa fa-close"></i></a>
    
                                     <?php }else{ ?> 
                                     
                                     <?php if(trim($_SESSION['expodine_id']) == 'admin' && $result_login['ser_delete_mode']=='Y'){ ?>
                                     
                                     <a title="RESTORE" style="margin: 0 1%;color: green"  onclick="restore_staff('<?=$result_login['ser_staffid']?>')" class="tab_edt_btn " href="#" ><i class="fa fa-refresh"></i></a>
                                     
                                    <?php }else{ ?>
                                     
                                      <a title="CANT DELETE THIS STAFF" style="margin: 0 1%;opacity: 0.5"  class="tab_edt_btn " href="#" ><i class="fa fa-close"></i></a>
                                     
                                    <?php }  } ?> 
                                     
                                     
                                         
                                    <?php if($_SESSION['s_inventory_staff_add']=='Y'){  ?>         
                                    <a onClick="store_add('<?=$result_login['ser_staffid']?>')" title="Invenetoy stores" style="margin: 0 1%;"  class="tab_edt_btn md-button" href="#" ><i class="fa fa-shopping-cart "></i></a>
                                    
                                    <?php } ?>      
                                         
                                    <a style="margin: 0 1%;display: none"  class="tab_edt_btn md-button" href="#" id="ids_<?=$result_login['ser_staffid']?>"><i class="fa fa-eye"></i></a>

                                <a style="display:none;color:black;top: 2px;position: relative;margin: 0 1% 0 1%;" class="tab_edt_btn " href="staff_salary_detail.php?staff_id=<?=$result_login['ser_staffid']?>" ><i style="font-size: 20px" class="fa fa-dollar"></i></a>
                              <!--  data-modal="view_<?=$result_login['ser_staffid']?>"-->

                                 <a  style="margin: 0 1%;" href="#" class="md-trigger_stf" id="ids_<?=$result_login['ser_staffid']?>"  authcodeshow2="<?=$result_login['dr_authorisation_code']?>"><img src="images/edit_page.PNG"></a>
                                 <?php if($result_login['ser_employeestatus']=="Active"){ ?>
                                 <a style="border: solid limegreen 4px; width: 22px; height: 22px;border-radius: 50%;    margin: 0 1%;" onClick="delete_confirm('ToNo','<?=$result_login['ser_staffid']?>')"  > <img style="position: relative;    top: -1px;" src="img/black_tick.png" width="18px" height="18px"></a>
                                 <?php } else{ ?>
                                  <a style="border:solid red 4px; width: 22px; height: 22px;border-radius: 50%;margin: 0 1%; " onClick="delete_confirm('ToYes','<?=$result_login['ser_staffid']?>')"  > <img style="position: relative;    top: -1px;" src="img/black_cross.png" width="18px" height="18px"></a>
                                 <?php } ?>
                                  
                                 <a  style="    margin: 0 1%;" class="md-permission" href="permissions.php?id=<?=$result_login['ser_staffid']?>" id="ids_<?=$result_login['ser_staffid']?>"><span class="staff_permission_btn">Permission</span></a>

                                 <a  style="margin: 0 1%;display: none" class="md-permission" href="permissions_app.php?id=<?=$result_login['ser_staffid']?>" id="ids_<?=$result_login['ser_staffid']?>"><span style="background-color: #910202 " class="staff_permission_btn">App</span></a>

                                </td>
                              </tr>
                                 <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['ser_staffid']?>">
                              <?php } } ?>
                        </table>
                   </div>
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>


 <div style="width:640px;position:absolute" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>ADD STAFF</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">

                              <form role="form" action="staff_master.php"  method="post"  name="staff_master">
                                  <div class=" content hideContent" style="height:175px">
                               <span id="staffchk" class="load_error alertsmaster" style="color:#F00" ></span>
                              <table class="geogrph_table">

                              <tr class="first_form_contain">
                            <!--  <input type="hidden" id='sesh' name="sesh" value="<?=$_SESSION['headofid']?>" >
                              <input type="hidden" id='sesb' name="sesb" value="<?=$_SESSION['branchid']?>"-->


                              <td><div class="form_name_cc">First Name<span style="color:#F00">*</span></div></td>
                              <td><div class="form_textbox_cc" id="staff_div">
                                      <input type="text" class="form-control firstname" id="firstname" name="firstname" onkeyup="return set_username()" onchange="return set_username()"  placeholder="First Name" tabindex="1" autofocus="autofocus"  data-toggle="tooltip" title="First Name" ></div></td>
                             
                            <td  style="display: none "><div class="form_name_cc">Last Name</div> </td>
                              <td  style="display: none "><div class="form_textbox_cc" id="lastname_div">
                                <input type="text" class="form-control lastname" id="lastname" name="lastname"  placeholder="Last Name" tabindex="2"  data-toggle="tooltip" title="Last Name" ></div>
                              </td>
                              
                              
                               <td><div class="form_name_cc">Floor</div></td>
                                  <td><div class="form_textbox_cc"  > <div class="form-group" id="flr_div">
                                        <?php
					$sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster");
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){
                                        ?>
                                        <select data-placeholder="Select Floor" tabindex="8" id="floorsel" name="floorsel" data-rel="chosen" tabindex="22" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">All</option>
                                         <optgroup label="Floor">
                                         <?php
					 while($result_kot  = $database->mysqlFetchArray($sql_kot))
					  {
					  ?>
                                            <option value="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                        <?php } ?>
                                            
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                              
                                         </div>
                                   	 </div>
                            </td>
                              

                             </tr>



                               <tr class="first_form_contain">
                                <td><div class="form_name_cc">Gender<span style="color:#F00">*</span></div></td>
                               	<td> <div class="form_textbox_cc" id="gender_div">
                                 <select data-placeholder="Gender" name="gender"  id="gender" data-rel="chosen" tabindex="3" title="Gender" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select</option>
                                         <optgroup label="Gender">
                                             <option selected value="Male">Male</option>
                                            <option value="Female">Female</option>
                                         </optgroup>
                                 </select></div></td>

                                 <td>  	<div class="form_name_cc">Department <span style="color:#F00">*</span></div></td>
                                <td>  <div class="form_textbox_cc"  > <div class="form-group" id="department_div">
                                         <?php $s2=1;
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_departmentmaster");
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  
                     ?>
                                        <select data-placeholder="Enter Department Name" id="department" tabindex="4" name="department" data-rel="chosen" title="Department Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select</option>
                                         <optgroup label="DEPARTMENT">
                                         <?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot))
										{
									?>
                                             <option  <?php $si_set2=$s2++; if($si_set2==1){ ?>  selected  <?php } ?> value="<?=$result_kot['der_departmentid']?>"><?=$result_kot['der_departmentname']?></option>
                                    <?php } ?>
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc--></td>


                               </tr>

                               <tr class="first_form_contain">

                                 <td>     	<div class="form_name_cc">Designation <span style="color:#F00">*</span></div></td>
                      <td>            <div class="form_textbox_cc"  > <div class="form-group" id="designation_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_designationmaster");
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Designation" id="designation" name="designation" tabindex="5" data-rel="chosen" title="Designation" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select</option>
                                         <optgroup label="Designation">
                                         <?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot))
										{
                                                                            if($_SESSION['dr_designationname']=='Super Admin'){
									?>
                                                                    <option value="<?=$result_kot['dr_designationid']?>" title="<?=$result_kot['dr_login']?>" authcodeshow="<?=$result_kot['dr_authorisation_code']?>" authcodeshow2="<?=$result_kot['dr_takeorder']?>"><?=$result_kot['dr_designationname']?></option>
                                                                                <?php }  else{
                                                                                    if($result_kot['dr_designationname']!='Super Admin'){ ?>
                                                                    <option value="<?=$result_kot['dr_designationid']?>" title="<?=$result_kot['dr_login']?>" authcodeshow="<?=$result_kot['dr_authorisation_code']?>" authcodeshow2="<?=$result_kot['dr_takeorder']?>"><?=$result_kot['dr_designationname']?></option>
                                                                               <?php  } } }?>
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         <input type="hidden" name="hidloginstatus" id="hidloginstatus" >
                                         <input type="hidden" name="hidloginstatus12" id="hidloginstatus12" >
                                         </div>
                                   	    </div><!--form_textbox_cc-->  </td>

                                        <td>   	<div class="form_name_cc">Employee Status  <span style="color:#F00">*</span> </div></td>
                               	 <td><div class="form_textbox_cc" id="employeestatus_div">
                                  <select data-placeholder="Employee status" name="employeestatus"  id="employeestatus" tabindex="6" data-rel="chosen" title="Employeestatus" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Select</option>
                                         <optgroup label="Employee Status">
                                            <option selected  value="Active"  >Active</option>
                                            <option value="Terminated">Terminated</option>
                                            <option value="Suspended">Suspended</option>
                                            <option value="Inactive">Inactive</option>
                                         </optgroup>
                                    	 </select></div>
                                        </td>

                               </tr>

                                <tr class="first_form_contain">

      <td style="line-height: 43px;display: none"><div class="form_name_cc" id="brnchchk" style="display:block">Branch<span style="color:#F00">*</span></div>
                                 <div class="form_name_cc" id="hdchk" style="display:none">Head Office<span style="color:#F00">*</span></div>
                                  <td style="line-height: 43px;display: none"><div class="form_textbox_cc" id="brnchdivchk" style="display:block"  > <div class="form-group" id="branch_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_branchmaster ");
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Branch" id="branch" name="branch" data-rel="chosen" tabindex="7" title="Branch" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Branch">
                                         <?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot))
										{
									?>
                                            <option value="<?=$result_kot['be_branchid']?>"  <?php if($result_kot['be_branchid']==$_SESSION['branchofid']) { ?> selected="selected"  <?php } ?> ><?=$result_kot['be_branchname']?> </option>
                                    <?php } ?>
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div><!--form_textbox_cc-->


                                        <div class="form_textbox_cc" id="headdivchk" style="display:none"  ><!-- <div class="form-group" id="head_div">-->
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_headoffice");
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter headoffice" id="headoffice" name="headoffice" data-rel="chosen" tabindex="8" title="Headoffice" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Headoffice">
                                         <?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot))
										{
									?>
                                            <option value="<?=$result_kot['he_officeid']?>"  <?php if($result_kot['he_officeid']==$_SESSION['headofid']) { ?> selected="selected"  <?php } ?>><?=$result_kot['he_officename']?></option>
                                    <?php } ?>
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                      <!--   </div>-->
                                   	    </div><!--form_textbox_cc-->


                                        </td>


                            </td>

                            
                            
                             <td><div class="form_name_cc">Inventory Store</div></td>
                                  <td><div class="form_textbox_cc"  > <div class="form-group" id="flr_div">
                                         <?php
					$sql_kot  =  $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){
                                        ?>
                                        <select data-placeholder="Select Floor" tabindex="8" id="store_sel" name="store_sel" data-rel="chosen" tabindex="22" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value="">Store</option>
                                        
                                        <?php
					while($result_kot  = $database->mysqlFetchArray($sql_kot))
					{
					?>
                                            <option    value="<?=$result_kot['ti_id']?>"><?=$result_kot['ti_name']?></option>
                                        <?php } ?>
                                        
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	 </div>
                            </td>
                            
                            
                                   <td style="display: none "><div class="form_name_cc">Mobile No</div></td>
                                <td style="display: none "><div class="form_textbox_cc" id="mobile_div">
                                      <input type="text" class="form-control mobileno" id="mobileno" name="mobileno"  placeholder="Mobile No" tabindex="9"  data-toggle="tooltip" title="Mobile No" onChange="validate_mobile()"></div>
                                </td>

                            <td style="display:none"><div class="form_name_cc">Email</div></td>
                              <td style="display:none"><div class="form_textbox_cc" id="email_div">
                                <input type="text" class="form-control email" id="email" name="email" tabindex="7"  placeholder="Email" title="Email" onChange="emailvalidation(this.value);" ></div>
                            </td>
                              
                            
                           


                               </tr>


                               <tr class="first_form_contain">
<!--                                <td colspan="2"><div style="padding:0" class="form_name_cc">Cancel Permission </div>
                                  <div  class="form_textbox_cc" >
                                   <label>
                                 <input  style="margin-left:2%" type="checkbox" value="N" tabindex="23" name="cancelpermission"  id="cancelpermission" data-toggle="tooltip" title="active" >
                                 </label>
                                 </div></td> -->

                                   
                                   
                                   
                                   
                                   
                                 
                              
                                      <td style="display: none "><div class="form_name_cc">Salary</div></td>
                                <td style="display: none "><div class="form_textbox_cc" id="salary_div">
                                        <input type="text" class="form-control mobileno" id="salary" name="salary"  placeholder="Salary Amount" tabindex="10"  data-toggle="tooltip" title=" Salary" onChange="" onkeypress="return numdot(event);" ></div>
                                </td>
                              
                                    <td style="display: none "> 	<div class="form_name_cc">ID No</div></td>

                               <td style="display: none ">	 <div class="form_textbox_cc" id="menumaincategory_div">
                                <input type="text" class="form-control idno" id="idno" name="idno"  placeholder="ID No" tabindex="17"  data-toggle="tooltip" title="ID No" ></div>
                               </td>  
                               
                               
                               
                               </tr>


                               <tr>
                                 <td><div class="form_name_cc">Mode</div></td>


                                 <td style="line-height: 43px;">
                            <!--     <div id="brnchshow" class="form-control">
<?php $b='branch'; ?>
<input type="text"  id="" name="" value="<?=$b?>"  >

</div>
                          -->       	<div class="branch_floor_select_cc">
                                    	<div class="floor_checkbox_cc ">


                                        	<!--<div style="text-align:left" class="floor_checkbox_name">Branch</div>
                                            <div  style="text-align:right" class="floor_checkbox_name">Head Office</div>-->

<?php if($_SESSION['branchofid']!=""){?>
                                          <div style="width:auto" class="floor_checkbox_name stafff_branch_view_add">Branch</div>

  <?php }?>


                                          <div class="check_box_cc" id="hidediv" style="display:none">



<input type="hidden" name="sesh" id="sesh" value="<?=$_SESSION['headofid']?>">
<input type="hidden" name="sesb" id="sesb" value="<?=$_SESSION['branchofid']?>">



    <div style="width:auto" class="floor_checkbox_name">Branch</div>  <input type="radio" name="brhdchk"  <?php if($_SESSION['branchofid'] !=""){?> checked="checked"<?php } ?> id="branchchk"  value="B" style="position: relative;top: 3px;">
                                          <div  style="width:auto" class="floor_checkbox_name">Head Office</div> <input  type="radio"  name="brhdchk" id="headchk"  <?php if($_SESSION['headofid'] !=""){?> checked="checked"<?php } ?>  value="H" style="position: relative;top: 3px;"></div>



                                          <!-- <div  style="text-align:right" class="floor_checkbox_name">Head Office</div>-->
                                       <!-- <div class="floor_checkbox_cc">
                                        	<div class="floor_checkbox_name">Haedoffice</div>
                                            <div class="check_box_cc"><input type="radio"  name="headchk" id="headchk" value="h"></div>
                                        </div>-->
                                       </div>
                                    </div><!---branch_floor_select_cc--->
                                 </td>  
                               </tr>



                              <tr  class="first_form_contain" style="border-top:1px #ccc solid;">

                                  
                                  
                                  
                              <td><div class="form_name_cc">Alternate No</div></td>
                              <td><div class="form_textbox_cc" id="alternate_div">
                                <input type="text" class="form-control alternateno" id="alternateno" name="alternateno"  placeholder="Alternate No" tabindex="11"  data-toggle="tooltip" title="Alternate No" ></div></td>
                            <td><div class="form_name_cc">Remarks</div></td>
                              <td><div class="form_textbox_cc" id="remarks_div">
                                <input type="text" class="form-control remarks" id="remarks" name="remarks"  placeholder="Remarks" tabindex="12"  data-toggle="tooltip" title="Remarks" ></div></td>

                              </tr>



                               <tr class="first_form_contain">

                                  <td><div class="form_name_cc">Date Of Birth </div></td>
                                  <td> 	 <div class="form_textbox_cc" id="dob_div">
                                <input type="text" class="form-control dateofbirth" id="dob" name="dob"  placeholder="Date Of Birth" tabindex="13"  data-toggle="tooltip" title="Date Of Birth" ></div></td>
                              <td>  <div class="form_name_cc">Date Of Join </div></td>
                               	 <td><div class="form_textbox_cc" id="doj_div">
                                <input type="text" class="form-control dateofjoin" id="dateofjoin" name="dateofjoin"  placeholder="Date Of Join" tabindex="14"  data-toggle="tooltip" title="Date Of Join" ></div> </td>

                                  </tr>




                               <tr class="first_form_contain">

                                <td><div class="form_name_cc">Address1</div></td>
                                  <td> 	 <div class="form_textbox_cc" id="address1_div">
                                <input type="text" class="form-control address1" id="address1" name="address1" tabindex="15"  placeholder="Address1" tabindex="0"  data-toggle="tooltip" title="Address1" ></div></td>

                              <td><div class="form_name_cc">Address2</div></td>
                              <td><div class="form_textbox_cc" id="address2_div">
                                <input type="text" class="form-control address2" id="address2" name="address2" tabindex="16"  placeholder="Address2" tabindex="0"  data-toggle="tooltip" title="Address2" ></div></td>



                            </tr>
                            <tr class="first_form_contain">

 


                             
                           <td>	<div class="form_name_cc">ID Type</div></td>
                               <td>	 <div class="form_textbox_cc" id="menumaincategory_div">
                                <input type="text" class="form-control idtype" id="idtype" name="idtype"  placeholder="ID Type" tabindex="18"  data-toggle="tooltip" title="ID Type" ></div></td>

                            </tr>
                            <tr class="first_form_contain">

                            	<!--<td><div class="form_name_cc">Floor</div></td>
                                  <td><div class="form_textbox_cc"  > <div class="form-group" id="flr_div">
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster");
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Select Floor" id="floorsel" name="floorsel" data-rel="chosen" tabindex="22" title="Floor" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Floor">
                                         <?php
									while($result_kot  = $database->mysqlFetchArray($sql_kot))
										{
									?>
                                            <option value="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?>
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                         </div>
                                   	    </div>
                            </td>-->





                               </tr>


                               <tr>



                               </tr>




                               </table>
                               </div>

                                <div class="show-more" style="display:none">
                                    <a style="color: #0087f3;float: right;" href="#">Show more</a>
                                </div>

                      <div style="display:none" id="forloginonly">
                     <strong class="staff_logindetail_head" style="color:#000">Login Details</strong>
                     <table class="geogrph_table">
                     <tr class="first_form_contain">

                            <td> <div class="form_name_cc">User Name</div></td>
                             <td>  	 <div class="form_textbox_cc" id="username_div">
                                <input type="text" class="form-control username" id="username" name="username"  placeholder="User Name" tabindex="28"  data-toggle="tooltip" title="User Name" readonly></div></td>



<!--
                               </tr>
                               <tr  class="first_form_contain" id="code_div"  >-->

                                <td><div class="form_name_cc">Auth. code</div></td>
                                <td><div class="form_textbox_cc confirm_code_staff_n" id="authcode_div">
                                        <input type="password" class="form-control mobileno" id="authcode"  onkeypress="return numonly(event)" name="authcode"  placeholder="Authorisation code" tabindex="9"  data-toggle="tooltip" title="Authorisation code"  maxlength="4"onblur="validate_authcode()" autocomplete="off">
                                    </div>
                                    <div  class="confirm_code_staff_eye"><a href="#"  onmouseup="mouseoverPass1();"  onmousedown="mouseoutPass1();"><i class="fa fa-eye"></i></a></div>
                                </td>

                               </tr>

                               </table>
                                  </div>

                               </form>
                    </div>
                                    <a  href="#" class="entersubmit" onClick="validate_staff(); " tabindex="19"><span style="margin:15px 8px 0 0;" class="md-save newbut" >Save</span></a>
                             <!--<a href="#"><button style="margin-top:15px;" class="md-close" onClick="clearall()" tabindex="34">Close me!</button></a>-->
				</div>
                </div>
		</div>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script type="text/javascript">
    
    document.getElementById("authcode").value='';
    
     $('.entersubmit').ready(function () {

        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        
        });
        
        
    function store_set_staff(){
      
      var staff= $('#store_staff').attr('staff');
      
      var stores=$('.stores_all').val();
        
        var ids=new Array();
        var selected_activities =$("[name='stores_all[]']:checked");
			selected_activities.each(function(){
                            
			  var id_str       =  $(this).attr("store");
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
				ids.push(id_str);
			  }
     
				
			});
        
        
        
      
        
     $('.store_pop').show();
      
     var datarp="set=set_store_staff&staff="+staff+"&stores="+ids;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
     
          $('#store_staff').html('');
           $('.store_pop').hide();
           $('#store_staff').attr('staff','');
      }
      });
        
  }     
        
        
        
   function store_add(id){
      
      $('#store_staff').attr('staff',id);
       
        
     $('.store_pop').show();
      
     var datarp="set=load_store_staff&staff="+id;

       $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datarp,
        success: function(data)
        {
     
          $('#store_staff').html($.trim(data));
    
      }
      });
        
  }   
        
        
        
   function delete_confirm(status,id)
  {
      $('.common_popup_all').show();
      $('.common_popup_all').attr('status',status);
      $('.common_popup_all').attr('id',id);
//	var check = confirm("Are you sure you want to Change Status?");
//	if(check==true)
//	{
//		if(status=="ToYes")
//		{
//		window.location="staff_master.php?id="+id+"&delete=yes";
//		}else
//		{window.location="staff_master.php?id="+id+"&delete=no";
//		}
//	}

  }
  

  
  
  function staff_status_change(){
      
    var status=   $('.common_popup_all').attr('status');
    var id= $('.common_popup_all').attr('id');
      
      if(status=="ToYes")
		{
		  window.location="staff_master.php?id="+id+"&delete=yes";
		}else
		{ 
                    window.location="staff_master.php?id="+id+"&delete=no";
                }
  }
  
  
function staffclr()
                        {
                            document.getElementById('firstname').value = '';
                            document.getElementById('lastname').value = '';
                           // document.getElementById('gender').value = '';
                            document.getElementById('email').value = '';
                           // document.getElementById('department').value = '';
                            document.getElementById('designation').value = '';
                            document.getElementById('mobileno').value = '';
                            document.getElementById('alternateno').value = '';
                           // document.getElementById('employeestatus').value = '';
                            document.getElementById('dob').value = '';
                            document.getElementById('nationality').value = '';
                            document.getElementById('country').value = '';
                            document.getElementById('state').value = '';
                            document.getElementById('city').value = '';
                            document.getElementById('address1').value = '';
                            document.getElementById('address2').value = '';
                            document.getElementById('idno').value = '';
                            document.getElementById('remarks').value = '';
                            document.getElementById('dateofjoin').value = '';
//                            document.getElementById('cancelpermission').value = '';
                            document.getElementById('idtype').value = '';
                            document.getElementById('floorsel').value = '';
                            document.getElementById('branch').value = '';
                            document.getElementById('username').value = '';
//                            document.getElementById('password').value = '';
//                            document.getElementById('confirmpassword').value = '';
                            $('#staffchk').text('');
		            $("input[type=checkbox]").each(function() { this.checked=false; });
	                    $("#menumaincategory_div").removeClass("has-error");
	                    $("#staff_div").removeClass("has-error");
	                    $("#lastname_div").removeClass("has-error");
	                    $("#gender_div").removeClass("has-error");
                            $("#email_div").removeClass("has-error");
                            $("#department_div").removeClass("has-error");
                            $("#designation_div").removeClass("has-error");
                            $("#mobile_div").removeClass("has-error");
                            $("#employeestatus_div").removeClass("has-error");
                            $("#dob_div").removeClass("has-error");
                            $("#nationality_div").removeClass("has-error");
                            $("#country_div").removeClass("has-error");
                            $("#state_div").removeClass("has-error");
                            $("#city_div").removeClass("has-error");
                            $("#remarks_div").removeClass("has-error");
                            $("#doj_div").removeClass("has-error");
                            $("#flr_div").removeClass("has-error");
                            $("#address1_div").removeClass("has-error");
                            $("#address2_div").removeClass("has-error");
                            $("#password_div").removeClass("has-error");
                            $("#username_div").removeClass("has-error");
                            $("#confpassword_div").removeClass("has-error");
                            $("#alternate_div").removeClass("has-error");
                            $("#alternate_div").removeClass("has-error");
                        }


    function validate_staff(){
	if(validate_firstname()){

            if(validate_gender()){

		if(validate_department()){

                    if(validate_designation()){

			if(validate_employeestatus()){



				//if(validate_password()){

                                    //if(validate_confirmpassword()){

                                        if(validate_username()){

                                            document.staff_master.submit();
                                        }
                                    //}
				//}

			}
                    }
		}
            }
	}
    }

		function validate_firstname()
			{



				if($(".firstname").val()=="")
				{
					$("#staff_div").addClass("has-error");
						  document.staff_master.firstname.focus();
                                                 // alert("Enter First Name.");
                         
                        $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Enter First Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#firstname").val())){
                              $("#staff_div").addClass("has-error");
                             document.staff_master.firstname.focus();
                          //alert("Special charecter Not Allowed.");
                          $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('No Special Characters');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }
                                else
					 {
				 var a=document.getElementById("firstname").value;
				 $("#staff_div").removeClass("has-error");
			         $(this).addClass("has-success");
				 return true;
					 }
			}


		function validate_gender()
			{
				if($("#gender").val()=="")
				{
					$("#gender_div").addClass("has-error");
						  document.staff_master.gender.focus();
                                                 // alert("Select Gender.");
                                                 $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Gender');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#gender").val())){
                              $("#gender_div").addClass("has-error");
                             document.staff_master.gender.focus();
                             $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('No Special Characters');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                           // alert("Special charecter Not Allowed.");
                               }

                                    else
					 {
						 var a=document.getElementById("gender").value;
						 $("#gender_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_country()
			{
				if($("#country").val()=="")
				{
					$("#country_div").addClass("has-error");
						  document.staff_master.country.focus();
                                                  alert("Enter Country.");
						  return false;
				}
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#country").val())){
                              $("#country_div").addClass("has-error");
                             document.staff_master.country.focus();
                          alert("Special charecter Not Allowed.");
                               }
                                    else
					 {
						 var a=document.getElementById("country").value;
						 $("#country_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_state()
			{
				if($("#state").val()=="" || $("#state").val()==null )
				{

					$("#state_div").addClass("has-error");
						  document.staff_master.state.focus();
                                                  alert("Enter State.");
						  return false;
				}
                                    var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#state").val())){
                              $("#state_div").addClass("has-error");
                            document.staff_master.state.focus();
                          alert("Special charecter Not Allowed.");
                               }

                                 else
					 {
						 var a=document.getElementById("state").value;
						 //alert(a);
						 $("#state_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
		function validate_city()
			{
				if($("#city").val()=="")
				{
					$("#city_div").addClass("has-error");
						  document.staff_master.city.focus();
                                                  alert("Enter City.");
						  return false;
				}

                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#city").val())){
                                $("#city_div").addClass("has-error");
                                document.staff_master.city.focus();
                              alert("Special charecter Not Allowed.");
                               }
                                 else
					 {
						 var a=document.getElementById("city").value;
						 $("#city_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}

			function validate_mobile()
			{
//
                                var alphanumers = /^[0-9 +]+$/;
                                if(!alphanumers.test($("#mobileno").val())){
                                $("#mobile_div").addClass("has-error");
//                                document.staff_master.mobileno.focus();
                             //alert("Special charecter Not Allowed.");
                             alert("Enter Valid Numbers.");
                             return false;
                               }

                                     else
					 {
						if (IsNumeric($("#mobileno").val()))
						{
						 var a=document.getElementById("mobileno").value;

						 $("#mobile_div").removeClass("has-error");
					     $('#mobile_div').addClass("has-success");
						 return true;
						}
						else
						{
							$("#mobile_div").addClass("has-error");

						     document.staff_master.mobileno.focus();
							alert('Please enter a valid mobile no')
							return false;
						}
					 }
			}
                        function validate_confirmcode()
	{
                                        $("#confirm_div").removeClass("has-error");
                                         var cnfcode=$("#confirmcode").val();
                                       var alphanumers = /^[0-9]+$/;
                                       if(cnfcode != ''){
                                                 if(!alphanumers.test(cnfcode)||cnfcode.length<4){
                                                      alert("Enter Valid 4 Digit confirm code");
                                                      $("#confirm_div").addClass("has-error");
                                                       $("#confirm_div").focus();

                                                 }
                                                  else
	                      {
		 var ax=document.getElementById("confirmcode").value;

	                               $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkpin&mid="+ax,
			success: function(data)
			{
			data=$.trim(data);

			if(data =="yes")
			{
                                                                                           alert("confirm code already exists !");
                                                                                           $("#confirm_div").addClass("has-error");
                                                       $("#confirm_div").focus();
                                                     return  false;
                                                                      }
                                                       }

                                    });
                             }
                         }
                     }
        function validate_authcode()
	{
                                        $("#authcode_div").removeClass("has-error");
                                         var cnfcode1=$("#authcode").val();
                                       var alphanumers = /^[0-9]+$/;
                                       if(cnfcode1 != ''){
                                                 if(!alphanumers.test(cnfcode1)||cnfcode1.length<4){
                                                      alert("Enter Valid 4 to 6 Digit authorisation code");
                                                      $("#authcode_div").addClass("has-error");
                                                       $("#authcode_div").focus();
                                                 }
                                                    else
	                      {
		 var ay=document.getElementById("authcode").value;

	                               $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkpin2&mid="+ay,
			success: function(data)
			{

			data=$.trim(data);

			if(data =="yes")
			{                                                                                              alert("authorisation code already exists !");
                                                                                           $("#authcode_div").addClass("has-error");
                                                       $("#authcode_div").focus();

                                                           return  false;
                                                                      }
                                                       }

                                    });

                             }
                                       }

                                 }


		function validate_dob()
			{
				if($("#dob").val()=="")
				{
					$("#dob_div").addClass("has-error");
						  document.staff_master.dob.focus();
                                                  alert("Enter Date of Birth.");
						  return false;
				}
                                  var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#dob").val())){
                                $("#dob_div").addClass("has-error");
                                document.staff_master.dob.focus();
                              alert("Special charecter Not Allowed.");
                               }

                                    else
					 {
						 var a=document.getElementById("dob").value;

						 $("#dob_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
                        
                        
                       
                        
			function validate_doj()
			{
				if($("#dateofjoin").val()=="")
				{
					$("#doj_div").addClass("has-error");
						  document.staff_master.dateofjoin.focus();
                                                  alert("Enter Date of Join.");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#dateofjoin").val())){
                                $("#doj_div").addClass("has-error");
                                document.staff_master.dateofjoin.focus();
                              alert("Special charecter Not Allowed.");
                               }
                              else
					 {
						 var a=document.getElementById("dateofjoin").value;

						 $("#doj_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}

			function validate_nationality()
			{
				if($("#nationality").val()=="")
				{
					$("#nationality_div").addClass("has-error");
						  document.staff_master.nationality.focus();
                                                  alert("Enter Nationality.");
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9]+$/;
                                if(!alphanumers.test($("#nationality").val())){
                                $("#nationality_div").addClass("has-error");
                                 document.staff_master.nationality.focus();
                              alert("Special charecter Not Allowed.");
                               }
                                  else
					 {
						 var a=document.getElementById("nationality").value;

						 $("#nationality_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_address1()
			{
				if($("#address1").val()=="")
				{
					$("#address1_div").addClass("has-error");
						  document.staff_master.address1.focus();
                                                 alert("Enter Address1.");
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#address1").val())){
                                $("#address1_div").addClass("has-error");
                                 document.staff_master.address1.focus();
                              alert("Special charecter Not Allowed.");
                               }

                                  else
					 {
						 var a=document.getElementById("address1").value;

						 $("#address1_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_department()
			{
				if($("#department").val()=="")
				{
					$("#department_div").addClass("has-error");
						  document.staff_master.department.focus();
                                                  //alert("Select Department.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Department');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9]+$/;
                                if(!alphanumers.test($("#department").val())){
                                $("#department_div").addClass("has-error");
                                 document.staff_master.department.focus();
                             alert("Special charecter Not Allowed.");
                               }
                                else
					 {
						 var a=document.getElementById("department").value;
						 //alert(a);
						 $("#department_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
		function validate_designation()
			{
				if($("#designation").val()=="")
				{
					$("#designation_div").addClass("has-error");
						  document.staff_master.designation.focus();
                                                  // alert("Select designation.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Designation');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}

//                                var alphanumers = /^[a-zA-Z0-9]+$/;
//                                if(!alphanumers.test($("#designation").val())){
//                                $("#designation_div").addClass("has-error");
//                                document.staff_master.designation.focus();
////                              alert("Special charecter Not Allowed.");
//                               }
                                else
					 {
						 var a=document.getElementById("designation").value;
						//  var optionSelected12 = $("#designation").find('option:selected').attr('title');
						 $("#designation_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_employeestatus()
			{
				if($("#employeestatus").val()=="")
				{
					$("#employeestatus_div").addClass("has-error");
						  document.staff_master.employeestatus.focus();
                                                  //alert("Select Employee Status.");
                                                  $('.alert_error_popup_all_in_one').show();           
                        $('.alert_error_popup_all_in_one').text('Select Employee Status ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
//                                 var alphanumers = /^[a-zA-Z0-9]+$/;
//                                if(!alphanumers.test($("#employeestatus").val())){
//                                $("#employeestatus_div").addClass("has-error");
//                                document.staff_master.employeestatus.focus();
////                              alert("Special charecter Not Allowed.");
//                               }
                                 else
					 {
						 var a=document.getElementById("employeestatus").value;
						 //alert(a);
						 $("#employeestatus_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
			}
			function validate_branch()
			{

				var sesh=$('#sesh').val();

	var sesb=$('#sesb').val();
	if(sesh!="")
	{


	if ($("#branchchk").is(':checked'))
	{
		if($("#branch").val()=="")
				{
					$("#branch_div").addClass("has-error");
						  document.staff_master.branch.focus();

						  return false;
				}

                                   else
					 {
						 var a=document.getElementById("branch").value;
						 //alert(a);
						 $("#branch_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
	}
	else
	{

		if($("#headoffice").val()=="")
				{
					$("#headdivchk").addClass("has-error");
						  document.staff_master.headoffice.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("headoffice").value;
						 //alert(a);
						 $("#headdivchk").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
	}
	}
	else
	{
		if($("#branch").val()=="")
				{
					$("#branch_div").addClass("has-error");
						  document.staff_master.branch.focus();
                                                   alert("Select Branch.");
						  return false;
				}else
					 {
						 var a=document.getElementById("branch").value;
						 //alert(a);
						 $("#branch_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }

	}





			}
			function validate_username()
			{


				if($("#hidloginstatus12").val()!="No")
				{
				if($("#username").val()=="")
				{
					$("#username_div").addClass("has-error");
						  document.staff_master.username.focus();
                                                   alert("Enter Username.");
						  return false;
				}

                                 else
					 {
						 var ab=document.getElementById("username").value;

	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkuserk&mid="+ab,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
//			var namechk=$('#catstatus1234');
			if(data =="sorry")
			{
                            alert("Username Already exists");
//		 namechk.text('Already exists');
		   $("#username_div").addClass("has-error");
	  $("#username").focus();

	return false;
			}
			else
			{

		//alert("aa");
		 $("#username_div").removeClass("has-error");
	   $("#username_div").addClass("has-success");
	document.staff_master.submit();
	  //	alert('aa');

			}
			}
		});







//						 $("#username_div").removeClass("has-error");
//					     $(this).addClass("has-success");
//						 return true;
					 }
				}

//                                var alphanumers = /^[a-zA-Z0-9]+$/;
//                                if(!alphanumers.test($("#username").val())){
//                                $("#username_div").addClass("has-error");
//                                document.staff_master.username.focus();
////                              alert("Special charecter Not Allowed.");
//                               }

				else
				{
					 return true;
				}

			}
			function validate_password()
			{
				if($("#hidloginstatus12").val()!="No")
				{
				if($("#password").val()=="")
				{
					$("#password_div").addClass("has-error");
						  document.staff_master.password.focus();
                                                   alert("Enter Password.");
						  return false;
				}else
					 {
						 var a=document.getElementById("password").value;
						 $("#password_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
				}
				else
				{
					return true;
				}
			}
			function validate_confirmpassword()
			{
				if($("#hidloginstatus12").val()!="No")
				{
				if($("#confirmpassword").val()=="")
				{
					$("#confpassword_div").addClass("has-error");
						  document.staff_master.confirmpassword.focus();
                                                   alert("Enter Confirm Password.");
						  return false;
				}else
					 {
						 var a=document.getElementById("confirmpassword").value;
						if(checkn_change('confpassword_div','confirmpassword'))
						{
						 $("#confpassword_div").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
						}
						else
						{
//							  document.staff_master.confirmpassword.focus();
//							  $("#confpassword_div").addClass("has-error");
                                                          alert("Password not Matching.");
						  return false;
						}
					 }
				}
				else
				{
					return true;
				}
			}

	function checkn_change(divid,controlid)
{

	if(document.getElementById(controlid).value=="")
	{
		$("#"+divid).addClass("has-error");
		$("#"+divid).removeClass("has-success");
	}else
	{
	$("#"+divid).removeClass("has-error");
	$("#"+divid).addClass("has-success");
	}
	if(divid=='confpassword_div')
	{
		if(document.getElementById("password").value!="")
		  {
			  if(document.getElementById("password").value!=document.getElementById("confirmpassword").value)
			  {

				   $("#confpassword_div").addClass("has-error");
				  $("#confpassword_div").addClass("has-feedback");
				/*  $("#sp_confp").css("display", "block");
				  $("#sp_confp").removeClass("glyphicon-ok");
				  $("#sp_confp").addClass("glyphicon-remove")*/;
			  		document.staff_master.confirmpassword.focus();
			  		return false;
			  }else
			  {
				  $("#confpassword_div").removeClass("has-error");
				  $("#confpassword_div").addClass("has-success");
				  $("#confpassword_div").addClass("has-feedback");
//				  $("#sp_confp").css("display", "block");
//				  $("#sp_confp").removeClass("glyphicon-remove");
//				  $("#sp_confp").addClass("glyphicon-ok");
				  $("#password_div").addClass("has-success");
				  $("#password_div").addClass("has-feedback");
				 // $("#sp_pas").css("display", "block");
//				  $("#sp_pas").removeClass("glyphicon-remove");
//				  $("#sp_pas").addClass("glyphicon-ok");
			  		return true;
			  }

		  }else
		  {
			  $("#password_div").addClass("has-error");
			  document.staff_master.password.focus();
			  return false;
		  }
	}

}


function IsNumeric(strString)
 {
     
  var strValidChars = "0123456789-+(). ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
  var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {

   return false;
  }

  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;

}

function emailvalidation(entered) {

    var email = entered;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(entered))
	{
    $("#email_div").addClass("has-error");
	document.staff_master.email.focus();
        alert("Enter Valid Email.");
	return false;
 	}else
	{
		 $("#email_div").removeClass("has-error");
		 return true;
	}
}

function set_username(){
  var login_permission =  $('#designation').find('option:selected').attr('title');
  if(login_permission=="Yes")
	{
            $('#username').val($('#firstname').val());
	}
}
	</script>
<script type="text/javascript">



function restore_staff(staff)
{
    
       
        $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('RESTORE STAFF ?');
         
         $('#confirm_pop_all').attr('rstaff',staff); 
       
            
        
}

 function confirm_yes_new(){
           
        var staff= $('#confirm_pop_all').attr('staff');
        
        var rstaff= $('#confirm_pop_all').attr('rstaff');
        
        if(staff!='' && staff!='undefined' && staff!=undefined){
            
        $.ajax({
		  type: "POST",
		  url: "load_index.php",
		  data: "set=staff_delete&staff="+staff,
		  success: function(msg)
		  {
			  location.reload();
		  }
	  });
        
        }
        
       if(rstaff!='' && rstaff!='undefined' && rstaff!=undefined){  
           
        $.ajax({
		  type: "POST",
		  url: "load_index.php",
		  data: "set=staff_delete_restore&staff="+rstaff,
		  success: function(msg)
		  {
			  location.reload();
		  }
	  });
      }
        
        
    }


function delete_staff(staff)
{
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM DELETE ?');
         
         $('#confirm_pop_all').attr('staff',staff);
           
        
}


function viewcity(val)
{
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadcity&cityid="+val,
		  success: function(msg)
		  {
			  $('#city').html(msg);
		  }
	  });
}



function viewstate(val)
{
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadstate&stateid="+val,
		  success: function(msg)
		  {
			  $('#state').html(msg);
		  }
	  });
}

function validateSearch()
{//portionams shtcds
	var staff =$("#staffname").val();
  if(staff=="")
  {
	  staff="null";
  }
  var departmnt=$("#deptname").val();
  if(departmnt=="")
  {
	  departmnt="null";
  }
  var desgnation=$("#desg").val();
  if(desgnation=="")
  {
	  desgnation="null";
  }
  var emplystatus=$("#emplystatus").val();
  if(emplystatus=="")
  {
	  emplystatus="null";
  }
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchstaff&staff="+staff+"&departmnt="+departmnt+"&desgnation="+desgnation+"&emplystatus="+emplystatus,
			success: function(msg)
			{
				$('#listall').html(msg);
			}
		});
                
                localStorage.staffname_ld = staff;
                localStorage.deptname_ld = departmnt;
                localStorage.desg_ld = desgnation;
                localStorage.emplystatus_ld = emplystatus;
                
                
}
 </script>
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
});
</script>
<script>

function check() {
 //   document.getElementById("branchchk").checked = true;
	var a=$('#brhdchk').val();
//alert(a);
	var sesh=$('#sesh').val();
	//alert(sesh);
	var sesb=$('#sesb').val();
	//alert(sesb);
	if(sesh !="")
	{

	 $('#branchchk').attr('enabled', 'enabled');
		  $('#headchk').attr('enabled', 'enabled');

				//alert('hd');
				$('#brnchchk').css("display","none");
					$('#brnchdivchk').css("display","none");
					$('#headdivchk').css("display","block");
					$('#hdchk').css("display","block");
					/*$('#hidediv').css("display","block")*/
		/*  	$('#brnchshow').css("display","none");*/

	}
	else
	{
		/* $('#branchchk').attr('disabled', 'disabled');*/
	<!--	  $('#headchk').attr('disabled', 'disabled');-->
		/*	  $('#headchk').css("display", "none");*/

		$("#brnchchk").css("display","block");
				$('#brnchdivchk').css("display","block");
				$('#headdivchk').css("display","none");
				$('#hdchk').css("display","none");
				$('#hidediv').css("display","none")
				<!--  $('#hidediv').css("display","none");-->
				  /*	$('#brnchshow').css("display","block");*/
	}
}
$(document).ready(function() {

	check();
});
$('#branchchk').click(function() {


        if ($(this).is(':checked')) {
			var a=$('#branchchk').val();

			if(a =="B")
			{
				$("#brnchchk").css("display","block");
				$('#brnchdivchk').css("display","block");
				$('#headdivchk').css("display","none");
				$('#hdchk').css("display","none");
			}
			else
			{
				$('#brnchchk').css("display","none");
				$('#brnchdivchk').css("display","none");
				$('#headdivchk').css("display","block");
				$('#hdchk').css("display","block");
			}
		//alert(a);
      // put your code here and your alert
   }
});

$('#headchk').click(function() {
        if ($(this).is(':checked')) {
			var a=$('#headchk').val();

			if(a =="H")
			{
				$("#brnchchk").css("display","none");
				$('#brnchdivchk').css("display","none");
				$('#headdivchk').css("display","block");
				$('#hdchk').css("display","block");
			}
			else
			{
				$('#brnchchk').css("display","block");
				$('#brnchdivchk').css("display","block");
				$('#headdivchk').css("display","none");
				$('#hdchk').css("display","none");



			}
		//alert(a);
      // put your code here and your alert
   }
});



</script>

<script type="text/javascript">
    
$(".show-more a").on("click", function() {
    
    var $this = $(this);
    var $content = $this.parent().prev("div.content");
    var linkText = $this.text().toUpperCase();

    if(linkText === "SHOW MORE"){
        linkText = "Show less";
        $content.switchClass("hideContent", "showContent", 400);
    } else {
        linkText = "Show more";
        $content.switchClass("showContent", "hideContent", 400);
    };

    $this.text(linkText);
});

//eyeclick//
function mouseoverPass(obj) {
  var obj = document.getElementById('confirmcode');
  obj.type = "password";

}

function mouseoutPass(obj) {
  var obj = document.getElementById('confirmcode');
  obj.type = "text";

}

function mouseoverPass1(obj) {
  var obj = document.getElementById('authcode');
  obj.type = "password";

}

function mouseoutPass1(obj) {
  var obj = document.getElementById('authcode');
  obj.type = "text";

}


function numonly(evt)
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {

        return false;

    }
    return true;
}



function release_login(i){
    
    $('#hidstaff').val(i);
    $('.release_reason_popup').css('display','block');
    $(".olddiv").addClass("new_overlay");

}



function sub_release(){
    
    var st=$('#hidstaff').val();
    var reason=$('#rel_reason').val();
    
    if(reason!=""){
    var datarp="set=release&staffid="+st+"&reason="+reason;

       $.ajax({
        type: "POST",
        url: "staff_master.php",
        data: datarp,
        success: function(data)
        {
     
     $('.release_reason_popup').css('display','none');
     $(".olddiv").removeClass("new_overlay");
     location.reload();
    
        }

    });
    
    }else{
      $('#reason_error').text('Enter reason');

       $('#reason_error').fade(2500);
    }
}


function numdot(e)
{
             var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
 
}



  
</script>
<div style="display:none;height:100px;bottom: auto;top: 40%;width:400px;padding: 15px" class="index_popup_1 disountenterpopup release_reason_popup">
    <input type="hidden" id="hidstaff" >
          <div class="discount_offer_or_cc">
        Enter  Reason ? 
        
        <input  type="text" class="form-control" name="rel_reason" id="rel_reason"  style="width:90%;border: 1px solid #C1C1C1;display:inline-block;height:33px;padding:0px;padding-left:2px;margin-right: 10px;" value="Login Back ">

        </div>

    <div class="index_popup_contant" style="margin-top: 4px;">
    	<div onclick="return sub_release();" style="width:25%;cursor: pointer" class="btn_index_popup"><a href="#" class="" >Submit</a></div>
        <div  style="width:25%;cursor: pointer" class="btn_index_popup"><a href="staff_master.php" class="" >Close</a></div>
        <span style="color:red" id="reason_error"></span>
    </div>
 </div>

<div style="position:absolute;width:100%;left:0;top:0%;z-index:99999;" class="mynewpopupload"  ></div>


<div class="main_logout_popup_cc common_popup_all" style="display:none">
        <div class="main_logout_popup">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">CONFIRM STATUS CHANGE ?</h1>
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="$('.common_popup_all').hide();" style="color:#AB2426 !important" href="#" class="">NO</a></div>
                <div class="btn_logout_yes_no"><a onclick="return staff_status_change();" href="#" class="">YES</a></div>
            </div>
       </div>
     </div>



<div class="main_logout_popup_cc store_pop" style="display:none;">
    <div class="main_logout_popup" style="width: 450px !important;height: 255px !important">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">Select Your Stores ?</h1>
                
                <div id="store_staff">
            
                    
                </div>
                
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 3px;"><a onclick="$('.store_pop').hide();" style="color:#AB2426 !important" href="#" class="">Exit</a></div>
                <div class="btn_logout_yes_no" style=" margin-top: 25px !important;"><a onclick="return store_set_staff();" href="#" class="">Submit</a></div>
            </div>
       </div>
     </div>

</body>
</html>
