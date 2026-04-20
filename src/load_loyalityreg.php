<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
require_once("includes/title_settings.php");
include('includes/master_settings.php');
include('includes/menu_settings.php');

if($_REQUEST['value']=="checkduplicateentry")
{
	$firstname=$_REQUEST['firstname'];
	$mobile=$_REQUEST['mobile'];
	 $email=$_REQUEST['email'];
	
	if(isset($_REQUEST['hidid']))
	{
	//$sql_loy_s  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_firstname='".$firstname."' AND ly_mobileno LIKE '%".$mobile."' AND ly_id <> '".$_REQUEST['hidid']."'");
	/*$sql_loy_s_n  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_firstname='".$firstname."' AND ly_id <> '".$_REQUEST['hidid']."'");
	$num_loy_s_n  = $database->mysqlNumRows($sql_loy_s_n);
	if($num_loy_s_n){
		$res=  "Name Already Exists";
		echo $res;
		exit();
	}else
	{
		$res="ok";echo $res;
	}*/

	
	$sql_loy_s_m  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_mobileno LIKE '%".$mobile."' AND ly_id <> '".$_REQUEST['hidid']."'");
	$num_loy_s_m  = $database->mysqlNumRows($sql_loy_s_m);
	if($num_loy_s_m){
		$res= $_SESSION['registration_mobilealready'];
		echo $res;
		exit();
	}else
	{
		/*$res="ok";echo $res;*/
	}
	
	
	if($email !="")
	{
	$sql_loy_s_e  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_emailid='".$email."' AND ly_id <> '".$_REQUEST['hidid']."'");
	$num_loy_s_e  = $database->mysqlNumRows($sql_loy_s_e);
	if($num_loy_s_e){
		$res=  $_SESSION['registration_emailalready'];
		echo $res;
		exit();
	}else
	{
		$res="ok";echo $res;
	}
	}
	
	}
	else
	{
	/*$sql_loy_s_n  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_firstname='".$firstname."'"); 
	$num_loy_s_n  = $database->mysqlNumRows($sql_loy_s_n);
	if($num_loy_s_n){
		$res=  "Name Already Exists";
		echo $res;
		exit();
	}else
	{
		//$res="ok";echo $res;
	}*/

	$sql_loy_s_m  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_mobileno LIKE '%".$mobile."'"); 
	$num_loy_s_m  = $database->mysqlNumRows($sql_loy_s_m);
	if($num_loy_s_m){
		$res= $_SESSION['registration_mobilealready'];
		echo $res;
		exit();
	}else
	{
		/*$res="ok";echo $res;*/
	}
	
	if($email !="")
	{
	$sql_loy_s_e  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_emailid='".$email."'"); 
	$num_loy_s_e  = $database->mysqlNumRows($sql_loy_s_e);
	if($num_loy_s_e){
		$res=  $_SESSION['registration_emailalready'];
		echo $res;
		exit();
	}else
	{
		$res="ok";echo $res;
	}
	}
	}
	
}else if($_REQUEST['value']=="loaddetails") 
{
	//tbl_loyalty_reg(ly_id, ly_firstname, ly_lastname, ly_mobileno, ly_emailid, ly_birthdaydate, ly_anniversarydate, ly_profession, ly_totalvisit, ly_mailreceive, ly_smsreceive)ly_maritalstatus
	$regno=$_REQUEST['regno'];
	$ly_firstname			='';
	$ly_lastname			='';
	$ly_mobileno			='';
	$ly_emailid				='';
	$ly_birthdaydate		='';
	$ly_maritalstatus		='';
	$ly_anniversarydate		='';
	$ly_profession			='';
	$ly_mailreceive			='';
	$ly_smsreceive			='';
	$sql_loyt_s  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_id='".$regno."' "); 
	$num_loyt_s  = $database->mysqlNumRows($sql_loyt_s);
	if($num_loyt_s)
		{
		while($result_loyt_s  = $database->mysqlFetchArray($sql_loyt_s)) 
			{
				$ly_firstname			=$result_loyt_s['ly_firstname'];
				$ly_lastname			=$result_loyt_s['ly_lastname'];
				$ly_mobileno			=$result_loyt_s['ly_mobileno'];
				$ly_emailid				=$result_loyt_s['ly_emailid'];
				if($result_loyt_s['ly_birthdaydate']!="" && $result_loyt_s['ly_birthdaydate']!="0000-00-00")
				{
					$bdate           =explode("-",$result_loyt_s['ly_birthdaydate']);
					$ly_birthdaydate		=$bdate[2]."/".$bdate[1]."/".$bdate[0];
				}
				$ly_maritalstatus		=$result_loyt_s['ly_maritalstatus'];
				if($result_loyt_s['ly_anniversarydate']!="" && $result_loyt_s['ly_anniversarydate']!="0000-00-00")
				{
					$adate           =explode("-",$result_loyt_s['ly_anniversarydate']);
					$ly_anniversarydate		=$adate[2]."/".$adate[1]."/".$adate[0];
				}
				$ly_profession			=$result_loyt_s['ly_profession'];
				if($result_loyt_s['ly_mailreceive']=='Y')
					$ly_mailreceive			="Yes";
				else
					$ly_mailreceive			="No";
				if($result_loyt_s['ly_smsreceive']=='Y')
					$ly_smsreceive			="Yes";
				else
					$ly_smsreceive			="No";	
				
				
			}
		}
	?>
     

            	<div class="right_reg_rigstration_form_cc">
             		<div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_firstname']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_firstname?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_lastname']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_lastname?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_mobile']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_mobileno?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_email']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_emailid?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_birthday']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_birthdaydate?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_maritalstatus']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_maritalstatus?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_anniversary']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_anniversarydate?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_profession']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_profession?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_mailreceive']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_mailreceive?></div>
                    <div class="reg_rigstration_form_name"><strong><?=$_SESSION['registration_smsreceive']?></strong><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name"><?=$ly_smsreceive?></div>
                    
                     <!--<div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="" type="checkbox" value="" checked disabled> Mail Recieve</div>-->
                    
                 </div><!---right_reg_rigstration_form_cc---->
                  <div class="registration_submit_btn_cc"><a href="#" regno="<?=$regno?>" class="clickediteach"><?=$_SESSION['registration_edit']?></a> <a href="index.php"><?=$_SESSION['registration_backtohome']?></a></div>
                  <script src="js/registration_edit.js"></script>  
    <?php
}else if($_REQUEST['value']=="useredit") 
{
	$regno=$_REQUEST['regno'];
	$ly_firstname			='';
	$ly_lastname			='';
	$ly_mobileno			='';
	$ly_emailid				='';
	$ly_birthdaydate		='';
	$ly_maritalstatus		='';
	$ly_anniversarydate		='';
	$ly_profession			='';
	$ly_mailreceive			='';
	$ly_smsreceive			='';
	$sql_loyt_s  =  $database->mysqlQuery("select * from tbl_loyalty_reg where ly_id='".$regno."' "); 
	$num_loyt_s  = $database->mysqlNumRows($sql_loyt_s);
	if($num_loyt_s)
		{
		while($result_loyt_s  = $database->mysqlFetchArray($sql_loyt_s)) 
			{
				$ly_firstname			=$result_loyt_s['ly_firstname'];
				$ly_lastname			=$result_loyt_s['ly_lastname'];
				$ly_mobileno			=$result_loyt_s['ly_mobileno'];
				$ly_emailid				=$result_loyt_s['ly_emailid'];
				if($result_loyt_s['ly_birthdaydate']!="" && $result_loyt_s['ly_birthdaydate']!="0000-00-00")
				{
					$bdate           =explode("-",$result_loyt_s['ly_birthdaydate']);
					$ly_birthdaydate		=$bdate[2]."/".$bdate[1]."/".$bdate[0];
				}
				$ly_maritalstatus		=$result_loyt_s['ly_maritalstatus'];
				if($result_loyt_s['ly_anniversarydate']!="" && $result_loyt_s['ly_anniversarydate']!="0000-00-00")
				{
					$adate           =explode("-",$result_loyt_s['ly_anniversarydate']);
					$ly_anniversarydate		=$adate[2]."/".$adate[1]."/".$adate[0];
				}
				$ly_profession			=$result_loyt_s['ly_profession'];
				if($result_loyt_s['ly_mailreceive']=='Y')
					$ly_mailreceive			="Yes";
				else
					$ly_mailreceive			="No";
				if($result_loyt_s['ly_smsreceive']=='Y')
					$ly_smsreceive			="Yes";
				else
					$ly_smsreceive			="No";	
				
				
			}
		}
	?> 
                  
      <script type="text/javascript">
            $(document).ready(function () {
                $("#regstatus1").change(function () {
                var aat1 = ($(this).val());
                if (aat1 == "Married") {
                $('.regmarried1').css("display", "block");          
                 }
                  if (aat1 == "Single") {
                  $('.regmarried1').css("display", "none");
                
                  }

                 });
            });


    </script>           
                  
     <form role="form" action="registration.php"  method="post"  name="registration_form_edit">
     <input type="hidden" name="hidid" id="hidid"  value="<?= $regno?>" />
                <div class="right_reg_rigstration_form_cc">
              	<div class="new_user_reg_text"><span id="loaderror1" class="register_error" style="display:none;"></span></div>
                	<div class="reg_rigstration_form_name"><?=$_SESSION['registration_firstname']?><span style="color:#F00">*</span><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name " id="div_firstname1"><input placeholder="<?=$_SESSION['registration_entername']?>" class="reg_filter_text_box" name="firstname1" id="firstname1" type="text" value="<?=$ly_firstname?>" readonly="readonly"></div>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_lastname']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_lastname1"><input placeholder="<?=$_SESSION['registration_enterlastname']?>" class="reg_filter_text_box" name="lastname1" id="lastname1" type="text" value="<?=$ly_lastname?>"></div>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_mobile']?> <span style="color:#F00">*</span><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_mobile1"><input placeholder="<?=$_SESSION['registration_entermobile']?>" class="reg_filter_text_box" name="mobile1"  id="mobile1" type="text" value="<?=$ly_mobileno?>"></div>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_email']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_email1"><input placeholder="<?=$_SESSION['registration_enteremail']?>" class="reg_filter_text_box" name="email1" id="email1"  type="text" value="<?=$ly_emailid?>"></div>
                    
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_birthday']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_birthday1"><input placeholder="<?=$_SESSION['registration_enterdob']?>" class="reg_filter_text_box" name="birthday1" id="birthday1" type="text" value="<?=$ly_birthdaydate?>"></div>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_maritalstatus']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_status">
                    	<select class="reg_filter_text_box" name="status1" id="regstatus1">
                           
                           <option value="Married" <?php if($ly_maritalstatus=="Married"){ ?> selected="selected" <?php } ?>> <?=$_SESSION['registration_married']?></option>
                            <option value="Single" <?php if($ly_maritalstatus=="Single"){ ?> selected="selected" <?php } ?>> <?=$_SESSION['registration_single']?></option>
                        </select>
                    </div>
                
                     <div class="regmarried1" <?php if ($ly_maritalstatus=='Married'){ ?>style="display:block" <?php } else { ?> style="display:none;width:100%;float:left;" <?php } ?>>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_anniversary']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_anniversary1"><input placeholder="<?=$_SESSION['registration_aniverdate']?>" class="reg_filter_text_box" name="anniversary1" id="anniversary1" type="text" value="<?=$ly_anniversarydate?>"></div>
                    </div>
                    <div class="reg_rigstration_form_name"><?=$_SESSION['registration_profession']?><span style="float:right">:</span></div>
                    <div class="reg_rigstration_form_name" id="div_profession1"><input placeholder="<?=$_SESSION['registration_enterprofession']?>" class="reg_filter_text_box" name="profession1" id="profession1" type="text" value="<?=$ly_profession?>"></div>
                    
                     <div style=" margin-left: 15%;" class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box mailrecv" name="mailreceive1" id="mailreceive1" type="checkbox" value="1" <?php if($ly_mailreceive=="Yes") { ?> checked="checked"  <?php } ?>><?=$_SESSION['registration_mailreceive']?></div>
                     <div class="reg_rigstration_form_name reg_check_cc"><input class="reg_chk_box" name="smsreceive1" id="smsreceive1" type="checkbox" value="1" <?php if($ly_smsreceive=="Yes") { ?> checked="checked"  <?php } ?>	><?=$_SESSION['registration_smsreceive']?></div>
                    <input type="hidden" name="hidstatus1" id="hidstatus1" value="<?=$ly_id?>">>
              <!--firstname lastname mobile email birthday status anniversary profession mailreceive smsreceive-->     
                </div><!---right_reg_rigstration_form_cc--->
                </form>
                 <div class="registration_submit_btn_cc"><a href="#" onClick="validate_updateregister()"><?=$_SESSION['registration_update']?></a> <a href="index.php"><?=$_SESSION['registration_backtohome']?></a></div>
    <?php
	
}else if($_REQUEST['value']=="loadlisteach") 
{
	if(isset($_REQUEST['regno']))
	$regno=$_REQUEST['regno'];
	else
	$regno=='';
	?>
    <script src="js/registration.js"></script>   
    <table class="registerd_detail_head tablesorter" width="100%" border="0" >
                    <thead>
                      <tr style="width: 99%;">
                        <th width="10%"><?=$_SESSION['registration_slno']?></th>
                        <th width="30%"><?=$_SESSION['registration_name']?></th>
                        <th width="20%"><?=$_SESSION['registration_phone']?></th>
                        <th width="10%"><?=$_SESSION['registration_noofvisit']?></th>
                        <th width="10%"><?=$_SESSION['registration_status']?></th>
                        <th width="10%"><?=$_SESSION['registration_action']?></th>
                      </tr>
                      </thead>
<!--                    </table>-->
               
                
                
<!--                	<table class="registerd_detail_head tablesorter" width="100%" border="0" cellspacing="5" id="listall">-->
                   	 <tbody>
                                    
                    <?php
					$sql_cat_s  =  $database->mysqlQuery("select * from tbl_loyalty_reg order by ly_firstname "); 
					$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
						if($num_cat_s){$k=1;
							while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
								{
					?>
                           <tr ><!--class="registration_active"--> <!--class="registratneachclick" regno="<?=$result_cat_s['ly_id']?>"-->
                            <td width="10%"><?=$k++; ?></td>
                            <td class="registratneachclick" num="<?=$result_cat_s['ly_mobileno'] ?>"   sts="<?=$result_cat_s['ly_status']?>"  ml="<?=$result_cat_s['ly_emailid'] ?>" regno="<?=$result_cat_s['ly_id']?>" width="30%"><?=$result_cat_s['ly_firstname'] ?></td>
                            <td width="20%"><?=$result_cat_s['ly_mobileno'] ?></td>
                            <td width="10%"><?=$result_cat_s['ly_totalvisit'] ?></td>
                            
                            <td width="10%"><?=$result_cat_s['ly_status']?></td>
                          <td width="10%">
                             <?php if($result_cat_s['ly_status']=="Active"){ ?>  
                                 <a style="background-color:transparent;top: -4px; position: relative;"   class="cancelregistration bill_history_close_btn" onClick="delete_confirm('ToNo','<?=$result_cat_s['ly_id']?>')" title="ToNo" id="ids_<?=$result_cat_s['ly_id']?>"  ><img src="img/cancel_bill.png"></a>
                                 <?php } else{ ?>
                                  <a style="background-color:transparent;top: -4px; position: relative;" class="cancelregistration bill_history_close_btn"   onClick="delete_confirm('ToYes','<?=$result_cat_s['ly_id']?>')" title="ToYes" id="ids_<?=$result_cat_s['ly_id']?>"  ><img src="img/check_mark.png"> </a>
                                 <?php } ?>   
                                 </td>
                                 
                                
                         <!--   <td width="10%"><a href="#" style="background-color:transparent;top: -4px;
    position: relative;" class="cancelregistration bill_history_close_btn"><img src="img/check_mark.png"></a></td>-->
                           <!-- <td width="10%"><a href="#" style="background-color:transparent;top: -4px;
    position: relative;" class="cancelregistration bill_history_close_btn"><img src="img/check_mark.png"></a></td>-->
                          </tr>
                          <?php } } ?>
                          
                      </tbody>
                    </table>
    <?php
} elseif($_REQUEST['value']=="loadlistall_search") 
{
	$string='';
	if(isset($_REQUEST['filtername']))
	$string.="WHERE ly_firstname LIKE '%".$_REQUEST['filtername']."%' ";
	
	
	if(isset($_REQUEST['filterno']))
	{
		if($string!='')
		{
			$string.="AND  ly_mobileno LIKE '%".$_REQUEST['filterno']."%'";
		}else
		{
			$string.="WHERE ly_mobileno LIKE '%".$_REQUEST['filterno']."%'";
		}
	}
	
	?>
    <script src="js/registration.js"></script>   
    <script>
	
			$('.cancelregistration').click(function () {
        $('.pop_regstration_conform').css('display','block');
		$('.confrmation_overlay').css('display','block');
				
	});
	
	$('.bill_history_close_btn').click(function(){
		
			var id_str   =  $(this).attr("id");
	 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		var title=$(this).attr("title");
		
		
		$('#hidcancel').val(selval);
$('#hidcanc').val(title);
	});
	</script>
    
    
    
    <table class="registerd_detail_head tablesorter" width="100%" border="0" >
                    <thead>
                      <tr style="width: 99%;">
                        <th width="10%"><?=$_SESSION['registration_slno']?></th>
                        <th width="30%"><?=$_SESSION['registration_name']?></th>
                        <th width="20%"><?=$_SESSION['registration_phone']?></th>
                        <th width="10%"><?=$_SESSION['registration_noofvisit']?></th>
                        <th width="10%"><?=$_SESSION['registration_status']?></th>
                        <th width="10%"><?=$_SESSION['registration_action']?></th>
                      </tr>
                      </thead>
                       <tbody>
<!--                    </table>-->
                                    
                    <?php
					$sql_cat_s  =  $database->mysqlQuery("select * from tbl_loyalty_reg $string  order by ly_firstname "); 
					$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
						if($num_cat_s){$k=1;
							while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
								{
					?>
                           <tr ><!--class="registration_active"-->
                            <td width="10%"><?=$k++; ?></td>
                            <td  class="registratneachclick  " regno="<?=$result_cat_s['ly_id']?>" width="30%"><?=$result_cat_s['ly_firstname'] ?></td>
                            <td width="20%"><?=$result_cat_s['ly_mobileno'] ?></td>
                            <td width="10%"><?=$result_cat_s['ly_totalvisit'] ?></td>
                             <td width="10%"><?=$result_cat_s['ly_status'] ?></td>
                               <td width="10%">
                             <?php if($result_cat_s['ly_status']=="Active"){ ?>  
                                 <a style="background-color:transparent;top: -4px; position: relative;"   class="cancelregistration bill_history_close_btn" onClick="delete_confirm('ToNo','<?=$result_cat_s['ly_id']?>')" title="ToNo" id="ids_<?=$result_cat_s['ly_id']?>"  ><img src="img/cancel_bill.png"></a>
                                 <?php } else{ ?>
                                  <a style="background-color:transparent;top: -4px; position: relative;" class="cancelregistration bill_history_close_btn"   onClick="delete_confirm('ToYes','<?=$result_cat_s['ly_id']?>')" title="ToYes" id="ids_<?=$result_cat_s['ly_id']?>"  ><img src="img/check_mark.png"> </a>
                                 <?php } ?>   
                                 </td>
                          </tr>
                          <?php } } ?>
                          
                      </tbody>
                    </table>
    <?php
} 
