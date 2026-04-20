<?php
include('includes/session.php');		// Check session
include("database.class.php"); 
$database	= new Database(); 		// Create a new instance
    ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=date('d-m-Y  h:s a')?></title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.prnt-table td{padding: 5px;border: solid 1px #000}body{background-color: #fff !important;text-transform: uppercase;}
.prnt-list{float: left;width: 100%;margin: 0;padding: 0;margin-top: 40px;text-align: left}
.prnt-list li{font-size: 18px;color: #000;float: left;list-style-position: inside;text-transform: uppercase;width: 100%}
.prnt-table span{width: 40%;display: inline-block}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
</head>
<body style="background:none;overflow:scroll !important;text-align: center">
<!-- main header -->
<div style="width:1000px;margin:0 auto;border: solid 2px #000;display: inline-block;padding: 1%;">

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">
                            <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
      <tbody>
          <tr> 
          <td  > <input id="printbutton" type="submit" value="Print" class="print_button_main" onclick="return print_page()" />
              <input type="submit" value="Close" class="print_button_main" onclick="return close_page()" style="margin-right: 20px;float: left " /></td>
          </tr>
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
      </tbody>
  </table>
                            <?php
                            $branchname='';
                            $address='';
                            $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_name_tax1,be_name_tax2,be_name_tax3,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='1'"); 
                            $num_branch  = $database->mysqlNumRows($sql_branch);
                            if($num_branch)
                            {
                                          while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
                                                  {
                                                           $branchname=$result_branch['be_branchname'];
                                                           $address=$result_branch['be_address'];
                                                           

                                                  }
                            }


                    ?>
                
                <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
          <img width="200px" src="img/report-logo/reportlogo.png" /><br>
              <strong><u><?=$branchname?></u></strong><br>
      <strong><u><?=$address?></u></strong>
      </th>
       
        
      </tr>
            <tr >
                <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Function Prospect</strong></th>
                </tr>
        <tr>
                <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>DATE:<?=date('d-m-Y  h:s a')?></strong></th>
      </tr>

      
    </thead>
    </table>
                
       
<?php

    $function_id='';
    $function_id=$_REQUEST['functionid'];
    //echo $function_id;
    $funtion_customer_name="";
    $funtion_customer_number="";
    $funtion_customer_number2='';
    $funtion_date="";
    $funtion_venue="";
    $funtion_service="";
    $funtion_amount="";
    $funtion_session="";
    $funtion_noof_guest="";
    $funtion_advance_amount="";
    $funtion_billing_type="";
    $funtion_remarks='';
 
     	  $sql_login  =  $database->mysqlQuery("select *,fv_name,ft_name from tbl_function_details left join tbl_function_venue on fv_id=fd_venue left join tbl_function_type on ft_id=fd_function_type where fd_id='".$_REQUEST['functionid']."'"); 
	 //echo "select *,fv_name,ft_name from tbl_function_details left join tbl_function_venue on fv_id=fd_venue left join tbl_function_type on ft_id=fd_function_type where fd_id='".$_REQUEST['functionid']."'";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            
                                    $funtion_customer_name=$result_login['fd_customer'];
                                    $funtion_customer_number=$result_login['fd_mobile_1'];
                                    $funtion_customer_number2=$result_login['fd_mobile_2'];
                                    $funtion_date=date('d-m-Y',strtotime($result_login['fd_date']));
                                    $funtion_venue=$result_login['fv_name'];
                                    $funtion_service=$result_login['ft_name'];
                                    $funtion_session=$result_login['fd_session'];
                                    $funtion_noof_guest=$result_login['fd_no_of_pax'];
                                    $funtion_advance_amount=$result_login['fd_advance_given'];
                                    $funtion_billing_type=$result_login['fd_billing_type'];
                                    $funtion_remarks=$result_login['fd_remarks'];
                                    
                                    
                                    
                        
                        }
                    }

?>
<table class="prnt-table" border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
    <tbody>
        <tr>
            <td width="50%"><span>CUSTOMER NAME</span>:<?=$funtion_customer_name?></td>
            <td width="50%"><span>FUNCTION DATE</span>:<?=$funtion_date?></td>
        </tr>
        <tr>
            <td width="50%"><span>NUMBER OF GUESTS</span>:<?=$funtion_noof_guest?></td>
            <td width="50%"><span>SESSION</span>:<?=$funtion_session?></td>
        </tr>
        <tr>
            <td><span>CONTACT NO</span>:<?=$funtion_customer_number?></td>
            <td><span>CONTACT NO2</span>:<?=$funtion_customer_number2?></td>
        </tr>
        <tr>
            <td><span>FUNCTION TYPE</span>:<?=$funtion_service?></td>
            <td><span>ADVANCE AMT</span>:<?=$funtion_advance_amount?></td>
        </tr>
        <tr>
            <td><span>BILLING TYPE</span>:<?=$funtion_billing_type?></td>
            <td><span>VENUE</span>:<?=$funtion_venue?></td>
        </tr>
    </tbody>
</table> 
                            <p style="text-align:left"><span><strong>Remarks</strong></span>:<?=$funtion_remarks?>.</p>
                              <ul class="prnt-list">
                                  <h2>Menu</h2>
<?php 
        $sql_login  =  $database->mysqlQuery("select *,fdm_menu from tbl_function_details left join tbl_function_details_menu on fdm_function_id=fd_id  where fd_id='".$_REQUEST['functionid']."'"); 
	 //echo "select *,fdm_menu from tbl_function_details left join tbl_function_details_menu on fdm_function_id=fd_id  where fd_id='".$_REQUEST['functionid']."'";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      ?>
                          
                          <li><?=$result_login['fdm_menu']?></li>
                     
                <?php
                
                        }
                  }
                  
                   
?>
    </ul>
                            <span style="width:40%;float: left;text-align: left">Prepared By:
                                <span ><strong><?=$_SESSION['expodine_id']?></strong></span>
                            </span>
                           
                            <span style="width:40%;float: right">Checked By:
                                <span></span>
                            </span>
                            
                            </div>
	</div>
        <!-- Bottom TABLE -->
    </div>
  </div></div>
				
<!--[if !IE]>end section content bottom<![endif]-->
</body>
</html>
<script type="text/javascript">
function print_page()
{
  document.getElementById("printbutton").style.display = "none";	
  window.print();
}


function close_page(){
   window.top.close();
}

</script>