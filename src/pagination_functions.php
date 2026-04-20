<?php

//include('includes/session.php'); // Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		
//continue only if $_POST is set and it is a Ajax request
//if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

if($_REQUEST['value']=="load_custhis")	
{?>
    <script src="js/takeaway_custhist.js"></script> 
    <?php
	$item_per_page 		= 10;
	$page_number 		='';
	//Get page number from Ajax POST
	if(isset($_POST["page"])){
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	//$results1 = $database->mysqlQuery("select distinct tab_customername,tab_customermobile from tbl_takeaway_billmaster where tab_customername<>'' OR tab_customermobile<>'' order by tab_customername");
	//$num_results1   = $database->mysqlNumRows($results1);
	$str='';
	if(isset($_REQUEST['search_guest']))
	{
		if(($_REQUEST['search_guest']!="null"))
		{
			$str=" AND tac_customername LIKE '%".$_REQUEST['search_guest']."%' ";
		}
		 if(($_REQUEST['search_code']!="null"))
		{
			$str.=" AND tac_contactno LIKE '%".$_REQUEST['search_code']."%' ";
		}
		
	}
	$results2 = $database->mysqlQuery("select distinct tac_customername,tac_contactno from tbl_takeaway_customer where (tac_customername<>'' OR tac_contactno<>'') $str order by tac_customername");
	$num_results2  = $database->mysqlNumRows($results2);
	//$num_results2  = $results2->fetch_row();
	
	
	$get_total_rows =$num_results2;//$results2->fetch_row();// $num_results2 ;// $results->fetch_row(); //hold total records in variable
	//break records into pages
	$total_pages = ceil($get_total_rows/$item_per_page);
	
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	

	//Limit our results within a specified range. 
	//$results = $mysqli->prepare("SELECT id, name, message FROM paginate ORDER BY id ASC LIMIT $page_position, $item_per_page");
	////$results->execute(); //Execute prepared Query
	//$results->bind_result($id, $name, $message); //bind variables to prepared statement
	
	//Display records fetched from database.
	//echo '<ul class="contents">';
	echo ' <div  class="left_detail_scroll"><table class="new_fnt" width="100%" border="0"> <tbody>';
	 $sql_bilhis="select distinct tac_customername,tac_contactno from tbl_takeaway_customer where (tac_customername<>'' OR tac_contactno<>'') $str order by tac_customername LIMIT $page_position, $item_per_page";
	$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
	$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);$i=$page_position + 1;
	if($num_bilhistory)
	{
		while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
			{?>
		<tr class="custhistory_eachs" mode='2' cname="<?=$result_bilhistory['tac_customername']?>" cmob="<?=$result_bilhistory['tac_contactno']?>">
       <td width="10%"><?=$i++?></td>
          <td width="50%"><?=$result_bilhistory['tac_customername']?></td>
          <td width="40%"><?=$result_bilhistory['tac_contactno']?></td>
       </tr>
     
       <?php
			}
	}
	echo ' </tbody> </table></div>';

	echo '<div align="center" class="ta_cumstomer_pagination_cc">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
	echo '</div>';
	
	exit;
	

}?>
      

<!--voucher head -->

<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
                        $.post("popup/voucherhead_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	
	
});
</script>

<?php
if($_REQUEST['value']=="load_voucherhead")
{?>
<!-- <script src="js/takeaway_custhist.js"></script> -->
    <?php 
    $item_per_page = 25;
    $page_number ='';
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    $results2 = $database->mysqlQuery("select * from tbl_voucherhead LEFT JOIN tbl_branchmaster ON tbl_voucherhead.vh_branchid=tbl_branchmaster.be_branchid");
    $num_results2  = $database->mysqlNumRows($results2);
    
    $get_total_rows =$num_results2;
    $total_pages = ceil($get_total_rows/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);
    ?>
     <div class="col-md-12 contant_table_cc"><table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="listall">  
    <thead>
        <tr>
            <th width="15%" class="header">Action</th>
            <th width="50%" class="header">Voucher Head</th>           
            <th width="25%" class="header">Branch</th>
            <th width="15%" class="header">Active</th>
           
          
       
        </tr>
    </thead>
    
    <?php
    echo '<tbody>';
    $sql_vouch  ="select * from tbl_voucherhead LEFT JOIN tbl_branchmaster ON tbl_voucherhead.vh_branchid=tbl_branchmaster.be_branchid LIMIT $page_position, $item_per_page";
    $sql_login  =  $database->mysqlQuery($sql_vouch);
    $num_login   = $database->mysqlNumRows($sql_login);
    $i=$page_position + 1;
      if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      if($result_login['vh_active']=="Y")
				{
					$active="Yes";
				}else
				{
					$active="No";
				}
                      
                      ?>
       <tr id="ids_<?=$result_login['vh_id']?>"  class="select">
            <td width="15%">
                <a href="#" class="md-trigger_vouc" id="ids_<?=$result_login['vh_id']?>"><img src="images/edit_page.PNG"></a>
                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['vh_id']?>">


                          <?php 
                          if($result_login['vh_active']=="Y"){
                              ?>  
                                 <a  onClick="delete_confirm('ToNo','<?=$result_login['vh_id']?>')"  > <img src="img/red_cross.png" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                  <a  onClick="delete_confirm('ToYes','<?=$result_login['vh_id']?>')"  > <img src="img/green_tick.png" width="25px" height="25px"></a>
                                 <?php } ?> 


<!--               <a href="#" class="md-trigger_vouc"><img src="img/delete_btn_2.png"></a>-->
            </td>
            <td  width="50%"><?=$result_login['vh_vouchername']?></td>
<!--            <td width="20%" class="header"><?//=$result_login['vh_type']?></td>-->
            <td width="25%"><?=$result_login['be_branchname']?></td>
            <td width="15%"><?=$active?></td>
               
        </tr>
            <?php }     } 
           echo '</tbody></table></div>';
           echo '<div align="center" class="ta_cumstomer_pagination_cc">';
           echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
           echo '</div>';
	
	exit;
}
   ?>  
        
  
 <!-- voucher Payment -->
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/vouchpayment_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});  
        
        $('.md-trigger_approve').click( function() { 
			var id_str   =  $(this).attr("id");
                        var sts= $(this).attr("id_sts");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
                          if(sts!="Cancelled"){
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
                        
                        var fr=$('#datepickerfrom').val();
                        
                        var to=$('#datepickertodt').val();
                        
                    
			  $.post("popup/vouchpayment_approved.php", {menu:menuid,fr:fr,to:to},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
                              }else{
                                  alert('Cancelled Payment Cant be Approved');
                              }
	});
        

});
function vouchersettle(i){


		
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(i);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/voucher_settlechange.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
//window.location.href = "popup/voucher_settlechange.php";
    });
}
</script>


 <?php
if($_REQUEST['value']=="load_salary")
{  $from="";
    $to="";
    $string='';
    ?>

    <?php 
             
   $string.="where ts_staff_id='".$_REQUEST['staff']."' and  ";
   
                 if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
        
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " CAST(ts_date_time AS DATE) between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " CAST(ts_date_time AS DATE) between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']=="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " CAST(ts_date_time AS DATE) between '".$from."' and '".$to."' ";
		}else
	{ 
          
		
		
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " CAST(ts_date_time AS DATE) between '".$from."' and '".$to."' ";
			
                        
			
	}
    
        //     }
    
    $item_per_page = 12;
    $page_number ='';
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    $results2 = $database->mysqlQuery("select * from tbl_staff_salary_detail $string ");
    
    $num_results2  = $database->mysqlNumRows($results2);
    
    $get_total_rows =$num_results2;
    $total_pages = ceil($get_total_rows/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);
    ?>
     <div class="col-md-3 contant_table_cc"> <table class="table_report scroll " width="100%" border="0" cellspacing="5" id="listall">  
    <thead>
         
        
        <tr>
            
            <th  style="width: 30%" class="header">Date</th>
            <th class="header"> Type</th>
              <th class="header">Salary Amount</th>
               
               
        </tr>
    </thead>
    
    
    <?php
    
    $tot_sal=0;
    $sql_vouch2  ="select * from tbl_staff_salary_detail $string and ts_type='Salary'  LIMIT $page_position, $item_per_page ";
    
    $sql_login2  =  $database->mysqlQuery($sql_vouch2);
    $num_login2   = $database->mysqlNumRows($sql_login2);
    
       if($num_login2){
          while($result_login2  = $database->mysqlFetchArray($sql_login2)) 
			{
              $tot_sal=$tot_sal+$result_login2['ts_amount'];
          } 
       }
    
    
    
    $tot=0;
    echo '<tbody>';
    $sql_vouch  ="select * from tbl_staff_salary_detail $string  LIMIT $page_position, $item_per_page ";
    
    $sql_login  =  $database->mysqlQuery($sql_vouch);
    $num_login   = $database->mysqlNumRows($sql_login);
    $i=$page_position + 1;
       if($num_login){
	        while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                 $tot=$tot+$result_login['ts_amount'];
                    ?>
        <tr id="ids_<?=$result_login['ts_id']?>"  class="select" id="select">
            
            
            
            <td><?=$result_login['ts_date_time']?></td>
             <td ><?=$result_login['ts_type']?></td>
            <td ><?=number_format($result_login['ts_amount'],$_SESSION['be_decimal'])?></td>
           
            
            
        
        <?php
       }}
       ?>
             <tr>
            <td>
              
            </td>
             <td>
             
            </td>
            <td>
             
            </td>
        </tr>
        
        
        <tr>
            <td style="font-weight: bold ">
               TOTAL Salary
            </td>
            <td>
             
            </td>
             <td style="font-weight: bold ">
               <?= number_format($tot_sal,$_SESSION['be_decimal'])?>
            </td>
        </tr> 
        
        
        
        <tr>
            <td style="font-weight: bold ">
               TOTAL (inc all)
            </td>
            <td>
             
            </td>
             <td style="font-weight: bold ">
               <?= number_format($tot,$_SESSION['be_decimal'])?>
            </td>
        </tr> 
            
         <?php     
           echo '</tbody></table></div>';
           echo '<div align="center" class="ta_cumstomer_pagination_cc">';
           echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
           echo '</div>';
	
	exit;
}
   ?>  




 <?php
if($_REQUEST['value']=="load_ledger")
{  $from="";
    $to="";
    $string='';
    ?>

    <?php 
             
   $string.='where ';
                 if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
        
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " CAST(vp_date AS DATE) between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " CAST(vp_date AS DATE) between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']=="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " CAST(vp_date AS DATE) between '".$from."' and '".$to."' ";
		}else
	{ 
          
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " CAST(vp_date AS DATE) between '".$from."' and '".$to."' ";
			
                        
			
	}
    
        //     }
    
    $item_per_page = 15;
    $page_number ='';
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    $results2 = $database->mysqlQuery("select tbl_voucherpayment.vp_id,tbl_voucherpayment.vp_type,tbl_voucherpayment.vp_date,tbl_voucherhead.vh_vouchername,sum(tbl_voucherpayment.vp_amount) as amount from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_branchmaster ON tbl_voucherpayment.vp_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_logindetails ON tbl_voucherpayment.vp_approvedby=tbl_logindetails.ls_username LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid $string group by tbl_voucherpayment.vp_date,tbl_voucherpayment.vp_vhid");
    
    $num_results2  = $database->mysqlNumRows($results2);
    
    $get_total_rows =$num_results2;
    $total_pages = ceil($get_total_rows/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);
    ?>
     <div class="col-md-12 contant_table_cc"> <table class="table_report scroll " width="100%" border="0" cellspacing="5" id="listall">  
    <thead>
         <tr>
            
             <th style="width: 30%" class="header"></th>
            <th class="header"></th>
          
           
            <th colspan="2" style="border-bottom: 1px #fff solid" class="header"> Amount</th>
               
        </tr>
        
        <tr>
            
            <th  style="width: 30%" class="header">Date</th>
              <th class="header">Account Head</th>
                <th class="header">Debit</th>
                
                <th class="header">Credit</th>
        </tr>
    </thead>
    
    
    <?php
    $db=0;
    $cr=0;
    
    echo '<tbody>';
    $sql_vouch  ="select tbl_voucherpayment.vp_id,tbl_voucherpayment.vp_type,tbl_voucherpayment.vp_date,tbl_voucherhead.vh_vouchername,sum(tbl_voucherpayment.vp_amount) as amount from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_branchmaster ON tbl_voucherpayment.vp_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_logindetails ON tbl_voucherpayment.vp_approvedby=tbl_logindetails.ls_username LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid $string group by tbl_voucherpayment.vp_date,tbl_voucherpayment.vp_vhid LIMIT $page_position, $item_per_page ";
    //echo "select tbl_voucherpayment.vp_date,tbl_voucherpayment.vh_vouchername,sum(tbl_voucherpayment.vp_amount) as amount from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_branchmaster ON tbl_voucherpayment.vp_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_logindetails ON tbl_voucherpayment.vp_approvedby=tbl_logindetails.ls_username LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid $string group by tbl_voucherpayment.vp_date,tbl_voucherpayment.vp_vhid LIMIT $page_position, $item_per_page ";
    $sql_login  =  $database->mysqlQuery($sql_vouch);
    $num_login   = $database->mysqlNumRows($sql_login);
    $i=$page_position + 1;
       if($num_login){
	        while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                 
                    ?>
        <tr id="ids_<?=$result_login['vp_id']?>"  class="select" id="select">
            
            
            
            <td><?=$result_login['vp_date']?></td>
            <td><?=$result_login['vh_vouchername']?></td>
            
            <?php if($result_login['vp_type']=='Income'){
                $db=$db+$result_login['amount'];
                ?>
          
               <td><?=$result_login['amount']?></td>
            <?php } else{
                ?>
                 <td></td>
            <?php } ?>
               
                <?php if($result_login['vp_type']=='Expense'){ 
                    
                     $cr=$cr+$result_login['amount'];
                    
                    ?>
          
               <td><?=$result_login['amount']?></td>
            <?php } else{
                ?>
                 <td></td>
            <?php } ?>
            
        </tr>
        <?php }     }
    
        
        if($db >0 || $cr >0 ){
        ?>
        
        <tr>
            <td></td>
            <td></td>  
            <td></td>
            <td></td>
        </tr>
        
        <tr>
            <td>Total</td>
             <td></td>  
             <td><?= number_format($db,$_SESSION['be_decimal'])?></td>
             <td><?=number_format($cr,$_SESSION['be_decimal'])?></td>
        </tr>
        
         <tr>
             <td></td>
             <td></td>  
             <td></td>
             <td></td>
        </tr>
        
         <tr>
             <td style="background-color: lightsalmon;font-weight: bold ">Total Carrydown= <?php $cd=0; $cd=$db-$cr; echo number_format($cd,$_SESSION['be_decimal']); ?></td>
            <td></td>  
            <td></td>
            <td></td>
        </tr>
        
        
        <?php
        
              }
           echo '</tbody></table></div>';
           echo '<div align="center" class="ta_cumstomer_pagination_cc">';
           echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
           echo '</div>';
	
	exit;
}
   ?>  





 <?php
if($_REQUEST['value']=="load_voucherpayment")
{  $from="";
    $to="";
        $string='';
    ?>
<!-- <script src="js/takeaway_custhist.js"></script> -->
    <?php 
             //if(isset($_REQUEST['from'])&& isset( $_REQUEST['to'])){
   $string.='where ';
                                                   if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
        
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']!="" && isset($_REQUEST['to'])&&$_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
		}
		else if(isset($_REQUEST['from'])&&$_REQUEST['from']=="" && isset($_REQUEST['to'])&&$_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
		}else
	{ 
          
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
			
                        
			
	}
    
        //     }
    
    $item_per_page = 15;
    $page_number ='';
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    $results2 = $database->mysqlQuery("select * from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_branchmaster ON tbl_voucherpayment.vp_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid $string");
    
    $num_results2  = $database->mysqlNumRows($results2);
    
    $get_total_rows =$num_results2;
    $total_pages = ceil($get_total_rows/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);
    ?>
        <div  style="width: 200%" class="col-md-18 contant_table_cc"><table class="table_report scroll tablesorter" border="0" cellspacing="5" id="listall">  
                <thead style="display:inline">
        <tr>
            <th  class="header">Action</th>
            <th class="header">Id</th>
            <th class="header">Date</th>
            <th  class="header">Acc Head</th>
            <th  class="header">Type</th>
            <th  class="header">Status</th>
            <th  class="header"> Pay Mode</th>
            <th class="header">Amount</th>
            <th  class="header">Paid To</th>
            <th  class="header">Recvd by</th>
            <th  class="header">Cheq Bank </th>
            <th  class="header">Cheq Brch </th>
            <th  class="header">Cheq Lf No</th>
            <th  class="header">Appr by</th>
            <th  class="header">Appr Date</th>
            <th  class="header"> Remarks</th>
            <th  class="header">Appr Remarks</th>

            <th  class="header">Sys Ip</th>
        </tr>
    </thead >
    
    
    <?php
    echo '<tbody>';
    $sql_vouch  ="select * from tbl_voucherpayment LEFT JOIN tbl_voucherhead ON tbl_voucherpayment.vp_vhid=tbl_voucherhead.vh_id LEFT JOIN tbl_branchmaster ON tbl_voucherpayment.vp_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_logindetails ON tbl_voucherpayment.vp_approvedby=tbl_logindetails.ls_username LEFT JOIN tbl_staffmaster ON tbl_voucherpayment.vp_approvedby=tbl_staffmaster.ser_staffid $string LIMIT $page_position, $item_per_page ";
    
    $sql_login  =  $database->mysqlQuery($sql_vouch);
    $num_login   = $database->mysqlNumRows($sql_login);
    $i=$page_position + 1;
       if($num_login){
	        while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                  
                    ?>
        <tr id="ids_<?=$result_login['vp_id']?>"  class="select" id="select">
            
            <td  id="statusbutton" class="statusbutton">

                <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['vp_id']?>">
                     
                     <?php
                      if($result_login['vp_status']=="Approved" )
				{ 
                          ?>
                          
                <a style="cursor:pointer;display: none" class="hidestatus " target="_blank" href="print_voucher.php?type=voucher_payment_old&id=<?=$result_login['vp_id']?>"  > <img src="img/printer.png" width="25px" height="25px"></a>        
                          
                     <?php
                              }
                     
                     if($result_login['vp_status']=="Approved" || $result_login['vp_status']=="Cancelled")
				{ 
                         
		       if($result_login['vp_status']=="Added"){ ?>  
                <a class="hidestatus disable_cls_voucher" onClick="delete_confirm('ToNo','<?=$result_login['vp_id']?>')"  > <img src="img/delete_btn_2.png" width="25px" height="25px"></a>
                       <?php } else{ ?>
                <a class="hidestatus disable_cls_voucher"  onClick="delete_confirm('ToYes','<?=$result_login['vp_id']?>')"  > <img src="img/delete_btn_2.png" width="25px" height="25px"></a>
                <a href="#" tittle="Edit" class="md-trigger_vouc hidestatus disable_cls_voucher" id="ids_<?=$result_login['vp_id']?>"><img src="images/edit_page.PNG"></a>
                        <?php  } ?> 
                             
                <a href="#" tittle="Approve" class="md-trigger_approve approve hidestatus disable_cls_voucher" id_sts="<?=$result_login['vp_status']?>" id="approve ids_<?=$result_login['vp_id']?>"><img src="img/approve_icon.png"></a> 
			<?php	}else{ ?>
				
			<?php if($result_login['vp_status']=="Added"){ ?>  
                <a  onClick="delete_confirm('ToNo','<?=$result_login['vp_id']?>')"  > <img src="img/delete_btn_2.png" width="25px" height="25px"></a>
                       <?php } else{ ?>
                <a  onClick="delete_confirm('ToYes','<?=$result_login['vp_id']?>')"  > <img src="img/delete_btn_2.png" width="25px" height="25px"></a>
                        <?php  } ?> 
                              
                              
                <a href="#" tittle="Edit" class="md-trigger_vouc" id="ids_<?=$result_login['vp_id']?>"><img src="images/edit_page.PNG"></a>
                <a href="#"  tittle="Approve" class="md-trigger_approve approve" id_sts="<?=$result_login['vp_status']?>" id="approve ids_<?=$result_login['vp_id']?>"><img src="img/approve_icon.png"></a> 
		
	                <?php	} ?>
                      
            </td>
        
            <td ><?=$result_login['vp_id']?></td>
            <td ><?=$result_login['vp_date']?></td>
            <td ><?=$result_login['vh_vouchername']?></td>
            <td  <?php if(($result_login['vp_type']=="Credit Expense" || $result_login['vp_type']=="Credit Income" ) && $result_login['vp_amount']>0.1){?>style="color:#F43D53;text-decoration: underline;cursor: pointer" onclick="return vouchersettle('<?=$result_login['vp_id']?>');"    <?php }else{ ?>   <?php } ?> > <?=$result_login['vp_type']?></td>
            <td  ><?=$result_login['vp_status']?></td>
            <td ><?=$result_login['vp_paymentmode']?></td>
            <td ><?=$result_login['vp_amount']?></td>
            <td ><?=$result_login['vp_paidto']?></td>
            <td ><?=$result_login['vp_receivedby']?></td>
            <td ><?=$result_login['vp_chequebank']?></td>
            <td ><?=$result_login['vp_chequebranch']?></td>
            <td ><?=$result_login['vp_chequeleafno']?></td>
            <td ><?=$result_login['ser_firstname']. " ". $result_login['ser_lastname']?></td>
           <td ><?=$result_login['vp_approveddate']?></td>
           <td ><?=$result_login['vp_add_remark']?></td>
            <td ><?=$result_login['vp_remarks']?></td>
            <td ><?=$result_login['vp_system_ip']?></td>
            
        </tr>
        <?php }     }
    
           echo '</tbody></table></div>';
           echo '<div align="center" class="ta_cumstomer_pagination_cc">';
           echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
           echo '</div>';
	
	exit;
}
   ?>   
  
   <!-----------Menu start------------->
<script>
  $(document).ready(function() {
$(".left_table_scr_cc tbody tr").click(function() {
	history.pushState({}, '', 'menu.php' );
    $(this).addClass('table_active').siblings().removeClass("table_active");
});


	$('.responstable tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
	
		$('.responstable tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
		
    });
    
   $('.md-trigger_edit').click( function() { 
	    var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  localStorage.editid=menuid;
                          
                          localStorage.editing_slno=$('#editing_slno_'+menuid).text();
			  $.post("popup/menu_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
                                  
                                  //if($('#login_id_menu').val()!='admin'){ 
                                  //$('.unittype_selection').css('pointer-events', 'none');
                                 // $('.portionunit_selection').css('pointer-events', 'none');
                                  // $('.baseunit_select').css('pointer-events', 'none');
                              // }
		         });  
	}); 
        
        $('.md-trigger_view').click( function() { 
	    var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  
			  $.post("popup/menu_view.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});
  
       $('.md-trigger_rate').click( function() { 
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_rate.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	}); 
    
//	$('.md-trigger_tax').click( function() { 
//		//alert("hiii")
//		$('.menu_tax_popup').css("display", "block");
//		$('.change_permission_overlay').css("display", "block");
//                var id_str   =  $(this).attr("id");
//                        var print_data = id_str.split('|');
//                        $("#taxvalue").val(print_data[0]);
//                        $("#menunametax").html(print_data[1]);
//
//	}) 
	
	$('.menu_tax_popup_close').click( function() { 
		//alert("hiii")
		$('.menu_tax_popup').css("display", "none");
		$('.change_permission_overlay').css("display", "none");
		
	})    

 $('.md-trigger_tax').click( function() { 
             var id_str   =  $(this).attr("id");
              var id_arr	  =	 id_str.split("_");
               var selval       =  id_arr[1];
              $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
                $('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/menu_tax.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
	});




});

</script>
   <?php
if($_REQUEST['value']=="load_menupage")
{
    
    $item_per_page = 30;
    $page_number ='';
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    $search="";
    $editing_slno=1;
            if(isset($_REQUEST['editing_slno'])){
             $editing_slno=$_REQUEST['editing_slno'];   
        }

 /* ******************************************** Menu master ******************************************************* */
		////mname mcate msubc mdiet mstatus
        $mname='null';
        $mcate='null';
        $msubc='null';
        $mstatus='null';
        $mdiet='null';
        $kitchen='null';
        $image_see='null';
        $excempt_sr='null';
        $cnt_ref='null';
        if(isset($_REQUEST['mname'])){
            $mname = $_REQUEST['mname'];
        }
        if(isset($_REQUEST['mcate'])){
            $mcate=$_REQUEST['mcate'];
        }
        if(isset($_REQUEST['mdiet'])){
            $msubc=$_REQUEST['msubc'];
        }
        if(isset($_REQUEST['mdiet'])){
	$mdiet=$_REQUEST['mdiet'];
        }
        if(isset($_REQUEST['mstatus'])){
            $mstatus=$_REQUEST['mstatus'];
        }
        if(isset($_REQUEST['kitchen'])){
            $kitchen=$_REQUEST['kitchen'];
        }
        
        if(isset($_REQUEST['image_see'])){
            $image_see=$_REQUEST['image_see'];
        }
        
        if(isset($_REQUEST['excempt_sr'])){
            $excempt_sr=$_REQUEST['excempt_sr'];
        }
        
         if(isset($_REQUEST['m_ref_cnt'])){
            $cnt_ref=$_REQUEST['m_ref_cnt'];
        }
        
        
       
	$search="";
        
	if($mname!='null')
	{
		if($search!="")
		{
			$search.=" and  mr_menuname LIKE  '%" . $mname ."%'";
		}else
		{
			$search.=" mr_menuname LIKE  '%" . $mname ."%'";
		}
	}
	if($mcate!='null')
	{
		if($search!="")
		{
			$search.=" and  mmy_maincategoryname =  '" . $mcate ."'";
		}else
		{
			$search.=" mmy_maincategoryname =  '" . $mcate ."'";
		}
	}
	if($msubc!='null')
	{
		if($search!="")
		{
			$search.=" and  msy_subcategoryname =  '" . $msubc ."'";
		}else
		{
			$search.=" msy_subcategoryname =  '" . $msubc ."'";
		}
	}
        
        
        if($cnt_ref!='null')
	{
		if($search!="")
		{
			//$search.=" and  (mr_central_id LIKE  '%" . $cnt_ref ."%' or  mr_menuid LIKE  '%" . $cnt_ref ."%')     ";
                        
                        $search.=" and  (mr_central_id =  '" . $cnt_ref ."' or  mr_menuid =  '" . $cnt_ref ."')     ";
		}else
		{
			//$search.=" ( mr_central_id LIKE  '%" . $cnt_ref ."%'  or mr_menuid LIKE  '%" . $cnt_ref ."%' ) ";
                    
                    $search.=" ( mr_central_id =  '" . $cnt_ref ."'  or mr_menuid =  '" . $cnt_ref ."' ) ";
		}
	}
        
        
        
	if($mdiet!='null')
	{
		if($search!="")
		{
                    
                    
                    if($mdiet!='all'){
                        
                        
                     if($mdiet!='Dynamic'){   
                        
                        if($mdiet!='Portion'){
                            
			    $search.=" and  mr_unit_type =  '" . $mdiet ."'";
                        }else{
                            $search.=" and  mr_rate_type ='Portion' ";
                        }
                        
                     }else{
                          $search.=" and  mr_manualrateentry ='Y' ";
                     }   
                        
                }
                        
		}else
		{    
                    if($mdiet!='all'){
                    
                    if($mdiet!='Dynamic'){     
                        
                     if($mdiet!='Portion'){
                         
			$search.=" mr_unit_type =  '" . $mdiet ."'";
                     }else{
                         $search.="  mr_rate_type ='Portion' ";
                     }
                      
                    }else{
                          $search.="  mr_manualrateentry ='Y' ";
                    } 
                     
                     
                     }
                     
		}
	}
	
        if($kitchen!='null')
	{
		if($search!="")
		{
			$search.=" and  mr_kotcounter =  '" . $kitchen ."'";
		}else
		{
			$search.=" mr_kotcounter =  '" . $kitchen ."'";
		}
	}
        
        if($excempt_sr!='null')
	{
		if($search!="")
		{
			$search.=" and  mr_product_type =  '" . $excempt_sr ."'";
		}else
		{
			$search.=" mr_product_type =  '" . $excempt_sr ."'";
		}
	}
        
        
         if($image_see!='null')
	{
		if($search!="")
		{
                    if($image_see=='Y'){
			$search.=" and  mr_manualrateentry  ='Y' ";
                    }else if($image_see=='T'){
                        $search.=" and  mr_excempt_tax  ='Y' ";
                    }else if($image_see=='D'){
                        $search.=" and  mr_excempt_disc  ='Y' ";
                    }else if($image_see=='B'){
                        $search.=" and  manual_barcode  ='Y' ";
                    }else if($image_see=='R'){
                        $search.=" and  mr_ingredient  ='Y' ";
                    }else if($image_see=='K'){
                        $search.=" and  mr_show_in_kot_print  ='N' ";
                    }else if($image_see=='S'){
                        $search.=" and  mr_dailystock_in_number  ='Y' ";
                    }
                    else if($image_see=='A'){
                        $search.=" and  mr_add_on  ='Y' ";
                    }
                     else if($image_see=='Q'){
                        $search.=" and  mr_qr_set  ='Y' ";
                    } else if($image_see=='KOD'){
                        $search.="  and mr_show_in_kod  ='Y' ";
                    }     
                        
		}else
		{
		    if($image_see=='Y'){
			$search.="   mr_manualrateentry  ='Y' ";
                    }else if($image_see=='T'){
                        $search.="   mr_excempt_tax  ='Y' ";
                    }else if($image_see=='D'){
                        $search.="   mr_excempt_disc  ='Y' ";
                    }else if($image_see=='B'){
                        $search.="   manual_barcode  ='Y' ";
                    }else if($image_see=='R'){
                        $search.="   mr_ingredient  ='Y' ";
                    }else if($image_see=='K'){
                        $search.="   mr_show_in_kot_print  ='N' ";
                    }else if($image_see=='S'){
                        $search.="   mr_dailystock_in_number  ='Y' ";
                    }else if($image_see=='A'){
                        $search.="   mr_add_on  ='Y' ";
                    }
                    else if($image_see=='Q'){
                        $search.="   mr_qr_set  ='Y' ";
                    }   
                    else if($image_see=='KOD'){
                        $search.="   mr_show_in_kod  ='Y' ";
                    }   
		}
	}
        
        
        $search1='';
         if($image_see!='null' || $image_see=='null')
	{
		       
         $search1.=" group by mr_menuid ";
             
	}else{
             $search1.="  ";
        }
        
        
        
	if($mstatus!='null')
	{
		$sr="";
	$type=strtolower($mstatus);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	
        
        if($mstatus!='S'){
		if($search!="")
		{
			$search.=" and  mr_active =  '" . $sr ."'";
		}else
		{
			$search.=" mr_active =  '" . $sr ."'";
		}
                
        }else{
            
            if($search!="")
		{
			$search.=" and  mr_stock_in_out =  'N' ";
		}else
		{
			$search.=" mr_stock_in_out =  'N' ";
		}
                
            
        }
        
        
	}
        
        if($search!="")
		{
			$search.=" and  mr_delete_mode='N' ";
		}else
		{
			$search.=" mr_delete_mode='N' ";
		}
       
        
        $where='';
        if($search!=''){
            $where=" where ";
        }
    
       
    $results2 = $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON "
            . "tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menuimages ON "
            . "tbl_menuimages.mes_menuid=tbl_menumaster.mr_menuid  LEFT JOIN tbl_menusubcategory ON "
            . "tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $where $search $search1 ");
   // echo "select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menuimages ON tbl_menuimages.mes_menuid=tbl_menumaster.mr_menuid  LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid $where $search";
    $num_results2  = $database->mysqlNumRows($results2);
    
    $get_total_rows =$num_results2;
    $total_pages = ceil($get_total_rows/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);
    ?>
     <div id="left_table_scr_cc"><table class="responstable tablesorter" id="listall">  
    <thead>
     <tr>
        <th width="3%">Sl No </th>
        <th width="20%">Item</th>
         <th width="7%">Type</th>
        <th width="10%">Main Category</th>
        <th width="10%">Sub Category</th>
        <th width="10%">Kitchen</th>
        <th width="5%">Type</th>
        <th width="6%"> Ref Id</th>
        <th width="5%"> Cnt Id</th>
        <th width="28%">Action</th>
        
        <th width="5%">Rate</th>
        <th width="6%">Item Tax</th>
          </tr>
    </thead>
    
    <?php
    
    echo '<tbody>';
    $_SESSION['menuidselect']="";
    $sql_menu  ="select * from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid"
            . " LEFT JOIN tbl_menuimages ON tbl_menuimages.mes_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menusubcategory ON"
            . " tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid left join tbl_kotcountermaster on"
            . " tbl_kotcountermaster.kr_kotcode=tbl_menumaster.mr_kotcounter $where $search $search1 order by "
            . " tbl_menumaster.mr_active desc  LIMIT $page_position, $item_per_page ";
   
    $sql_login  =  $database->mysqlQuery($sql_menu);
    $num_login   = $database->mysqlNumRows($sql_login);
    $i=$page_position + 1;
    $startnum=$page_position+1;
    if($startnum==0){                            
        $startnum=1;
    }
      if($num_login){ 
          
                  $i=$page_position; 
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
				{
                      
                                $i++;
                                
				$taxmenu_id = $result_login['mr_menuid'].'|'.$result_login['mr_menuname'];
                                
				if($result_login['mr_active']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}
                                
                                 if($result_login['mr_show_in_kod']=="Y")
				{
				
					$activekod2="Yes";
				}else 
				{
					$activekod2="No";
				}
                                
				if(!isset($_REQUEST['id']))
				{
				  if($i==1)
				  {
					  $_SESSION['menuidselect']=$result_login['mr_menuid'];
				  }
				}
                                
                                if($result_login['mr_rate_type']=="Portion")
				{
				
					$rt_type="Portion";
				}else 
				{
					$rt_type=$result_login['mr_unit_type'];
				}
                                
                                
                                
    $sql_kotlist1  =  $database->mysqlQuery("SELECT  ti_name from tbl_inv_kitchen where  ti_id = '".$result_login['mr_inventory_kitchen']."' "); 
 
    $num_kotlist1  = $database->mysqlNumRows($sql_kotlist1);
					if($num_kotlist1){
					while($result_kotlist1  = $database->mysqlFetchArray($sql_kotlist1)) 
					{                                                       
                                            $inv_name=   $result_kotlist1['ti_name'];          
                                        } }     
                                        
                                        $itemotherlangname='';
                                        if($_SESSION['main_language']=='arabic')
					{
                                         
					$sql_othlamg  = $database->mysqlQuery("Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_login['mr_menuid']."' AND lm_language_id='2'"); 
					$num_othlamg  = mysqli_num_rows($sql_othlamg);
					if($num_othlamg)
					{
					while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
					{
					  $itemotherlangname=$result_othlamg['lm_menu_print'];
					}
					}
                                        
					}   
                                        
                                        
                                        $itemotherlangname_cat='';
                                        if($_SESSION['main_language']=='arabic')
					{
                                        
					$sql_othlamg  = $database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_main left join tbl_languages on ls_id=mm_lang_id WHERE mm_categoryid='".$result_login['mr_maincatid']."' and ls_language='".$_SESSION['main_language']."' "); 
					$num_othlamg  = mysqli_num_rows($sql_othlamg);
					if($num_othlamg)
					{
					while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
					{
					   $itemotherlangname_cat=$result_othlamg['mm_name'];
					}
					}
                                        
					}   
                                
				
	 ?>
                                <tr id="ids_<?=$result_login['mr_menuid']?>" class="clicktoview <?php if($i==$editing_slno){ ?> table_active <?php } ?> ">
                                <td width="3%" id="editing_slno_<?=$result_login['mr_menuid']?>"><?=$i?></td>
                                <td width="20%"><?=$result_login['mr_menuname']?> <?=$itemotherlangname?></td>
                                <td width="7%"><?=$result_login['mr_product_type']?></td>
                                <td width="10%"><?=$result_login['mmy_maincategoryname']?> <?=$itemotherlangname_cat?></td>
                                <td width="10%"><?=$result_login['msy_subcategoryname']?></td>
                                <td width="10%"><?=$result_login['kr_kotname']?></td>
                                <td width="5%"><?=$rt_type?></td>
                                <td width="6%"><?=$result_login['mr_menuid']?></td>
                                <td width="5%"><?=$result_login['mr_central_id']?></td>
                                <!-- data-modal="view_<?=$result_login['mr_menuid']?>"-->
                                <td width="28%" style="text-align: left !important;"> 
                                    
                                    <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$_SESSION['menuidselect']?>">
                                     
                                                
                                    <?php  if($active=="No") { ?>

                                    <a title="Inactive" class="tab_edt_btn" href="#" onClick="delete_confirm('ToYes','<?=$result_login['mr_menuid']?>')"><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"/></i></a>

                                    <a style="border: solid 1px;border-radius: 5px;padding: 2px;color: red;">INACTIVE</a>
                                    
                                    
                                    <?php }else if($active=="Yes") { ?>
                                    
                                    
                                     <a style="display: none" title="View Menu" class="tab_edt_btn md-trigger_view" id="set_<?=$result_login['mr_menuid']?>" ><i class="icontick"><img src="img/icon-view.png" width="22px" height="22px"/></i></a>
                                  
                                     <a title="Edit Menu" class="tab_edt_btn md-trigger_edit" id="set_<?=$result_login['mr_menuid']?>" ><i class="fa fa-edit"></i></a>
                                        

                                    <a title="Active" class="tab_edt_btn" href="#" onClick="delete_confirm('ToNo','<?=$result_login['mr_menuid']?>')"><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"/></i></a>
                                                     
                                    <?php  if($result_login['mr_excempt_disc']=="N") { ?>      
                                    
                                     <a title="Discount" onclick="return discount_icon('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>');" class="tab_edt_btn discount_pop_btn" href="#"><i class="icontick"><img src="img/discount_ico.png" width="28px" height="25px"/></i></a>
                                     
                                     <?php }else{ ?>
                                     
                                     <a title="Can't add discount because it's discount excempt" class="tab_edt_btn discount_pop_btn" href="#"><i class="icontick"><img src="img/delete_btn_2.png" width="28px" height="25px"/></i></a>

                                      <?php } ?>  

                                     
                                     <?php  if($result_login['mr_ingredient']=="Y"  && $_SESSION['ser_recipe']=='Y') { ?>
                                     
                                     <a title="Recipes Adding" onclick="return ing_view('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>','<?=$result_login['mr_inventory_kitchen']?>','<?=$result_login['mr_rate_type']?>','<?=$inv_name?>');" class="tab_edt_btn ingredient_btn" style="margin-left:7px" href="#"><i class="icontick"><img src="img/ingredient_ico.png" width="24px" height="24px"/></i></a>
                                    
                                     <?php } ?>
                                     
                                     
					<?php  if($result_login['mr_unit_type']!="Loose") { ?>	
                                     
				        <a onclick="return barcode_view('<?=$result_login['mr_menuid']?>','<?=$result_login['mr_menuname']?>');"  title="Barcode Printing"   class="tab_edt_btn ingredient_btn"  style="margin-left:3px" href="#"><i class="icontick"><img src="img/barcode.png" width="30px" height="30px"/></i></a>
                                      
                                        <?php } ?>
                                       
                                       
                                        <?php  if($_SESSION['ser_delete_menu']=='Y'){ ?>
                                         <a onclick="return hide_view('<?=$result_login['mr_menuid']?>');"  title="ITEM DELETE" class="tab_edt_btn ingredient_btn"  ><i class="icontick"><img style="background-color: #c55b5b;border-radius: 20px;" src="img/black_cross.png" width="25px" height="25px"/></i></a>
                                       <?php } ?>
                                       
                                       <?php  if($result_login['mr_stock_in_out']=='Y'){ ?>
                                       
                                         <a id="green_stk_<?=$result_login['mr_menuid']?>" style="background: #648964;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;" onclick="return stock_view('<?=$result_login['mr_menuid']?>','N');"  title="ITEM STOCK IN " class="tab_edt_btn ingredient_btn"  >IN</a>
                                      
                                         <?php }else{ ?>
                                        
                                        <a id="red_stk_<?=$result_login['mr_menuid']?>"  style="background: #993d3d;width: 30px;padding: 1px !important;top: -3px;border: solid 2px;border-radius: 4px;color: white !important;"  onclick="return stock_view('<?=$result_login['mr_menuid']?>','Y');"  title="ITEM STOCK OUT" class="tab_edt_btn ingredient_btn"  >OUT</a>
                                     
                                       <?php } ?>
                                       
                                       <?php } ?>
                                       
                                      
                                       </td>
                                                     
                                                     
                                                     
                                                     <td width="5%"  <?php  if($active=="No") { ?> class='disable_cls_voucher'  <?php  } ?>>
                                                         
                                                       <?php  if($result_login['mr_product_type']!="Raw") { ?>		   
                                                       <a title="Add Price  " class="md-trigger_rate" id="set_<?=$result_login['mr_menuid']?>"><img src="img/rate.png"></a>
                                                     
                                                     
                                                         <?php }else{ ?>
                                                           <a title="No Price  " class="" ><img src="img/black_cross.png"></a>
                                                           
                                                         <?php } ?>
                                                           
                                                           
                                                         </td>
                                                       
                                                           
                                                           
                                                     <td width="6%" <?php  if($active=="No") { ?> class='disable_cls_voucher'  <?php  } ?>>
                                                          <?php  if($result_login['mr_excempt_tax']=="N") { ?>
                                                       <a  title="Add Item Tax  " class="md-trigger_tax" id="set_<?=$result_login['mr_menuid']?>"><img src="img/tax-icon.png"></a>
                                                           <?php }else{ ?>
                                                        <a title="Can't add tax because it's tax excempt"><img src="img/delete_btn_2.png"></a>   
                                                        <?php } ?>  
                                                     
                                                     </td>
<!--                                                        <td class="" width="5%"><a class="md-trigger_tax" id="<?=$taxmenu_id?>"><img src="img/tax-icon.png"></a></td>-->
                                                      <!--<a class="tab_edt_btn" href="#" onClick="delete_confirm('<?=$result_login['mr_menuid']?>')"><i class="glyphicon glyphicon-trash"></i></a></td>-->
                              </tr>
                              <?php  } }else{ $_SESSION['menuidselect']="0"; } 
           echo '</tbody></table></div>';
           echo '<div align="center" class="ta_cumstomer_pagination_cc"></div>';
           echo $database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
?>
                            <script> 
                             $(document).ready(function() {
                                $('.menu_total_showing_text').text('Showing '+ <?=$startnum?>+' to '+ <?=$i?>+' of '+ <?=$get_total_rows?>);
                                localStorage.page1=$('.pagination li.active').find('a').text(); 
                             });
                            
                            
                            </script>      
 <?php          
	exit;
}

else if($_REQUEST['value']=="load_combo_stock"){
    $item_per_page = 25;
    $page_number ='';
    $combo_name='';
    $editing_slno='';
    if(isset($_REQUEST['editing_slno'])){
     $editing_slno=$_REQUEST['editing_slno'];   
    }
    if(isset($_REQUEST['combo_name'])){
     $combo_name=" where cn.cn_name LIKE  '%" . $_REQUEST['combo_name'] ."%' ";   
    }
    if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
     if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number    
    }else{
      $page_number = 1; //if there's no page number, set it to 1  
    }
    
    $sql_combo_stock =  $database->mysqlQuery("select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id $combo_name
                                                order by cn.cn_id, cp.cp_id asc ");
//                                    echo "select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
//                                                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
//                                                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id
//                                                                                order by cn.cn_id, cp.cp_id asc";
                                    $num_combo_stock  = $database->mysqlNumRows($sql_combo_stock);
                                    $get_total_rows =$num_combo_stock;
                                    $total_pages = ceil($get_total_rows/$item_per_page);
                                    $page_position = (($page_number-1) * $item_per_page);
    
    ?>
                            <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <th>Action</th>
                                <th width="10%">Sl No</th>
                                <th height="35px" class="header">Combo Pack</th>
                                <th height="35px" class="header">Stock Number</th>
                                <th height="35px" class="header">Stock Status</th>
                                <th height="35px" class="header">Stock Date</th>
                                
                              </tr>
                             </thead>
                             <tbody id="stock_table_content">
                                 <?php 
                                    $sql_combo_stock =  $database->mysqlQuery("select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
                                                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
                                                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id $combo_name
                                                                                order by cn.cn_id, cp.cp_id asc limit $page_position,$item_per_page ");
//                                    echo "select cs.cs_id,cs.cs_stock_number, cs.`cs_stock_status`,cs.cs_stock_date,cs.cs_last_updated, cn.cn_name, cp.cp_pack_name  FROM tbl_combo_stock cs
//                                                                                left join tbl_combo_name cn on cn.cn_id=cs.cs_combo_id
//                                                                                left join tbl_combo_packs cp on cp.cp_id=cs.cs_pack_id
//                                                                                order by cn.cn_id, cp.cp_id asc";
                                    $num_combo_stock  = $database->mysqlNumRows($sql_combo_stock);
                                    
                                    $i=$page_position + 1;
                                    $startnum=$page_position+1;
                                    if($startnum==0){
                                        $startnum=1;
                                    }
                                        if($num_combo_stock){$i=$page_position;
                                            while($result_combo_stock  = $database->mysqlFetchArray($sql_combo_stock)){
                                                $i++;
                                    ?>
                                            <tr id="focusid_<?=$result_combo_stock['cs_id']?>" class="select <?php if($i==$editing_slno){ ?> table_active <?php }?> combo_id">
                                <td id="edit_stock_<?=$result_combo_stock['cs_id']?>"><i class="fa fa-edit combo_edit" id="combo_edit_<?=$result_combo_stock['cs_id']?>" style='cursor: pointer' onClick='return combo_edit_stock("<?=$result_combo_stock['cs_id']?>")'></i><i class="fa fa-save combo_update" id="combo_update_<?=$result_combo_stock['cs_id']?>" style='cursor: pointer;display:none' onClick='return combo_update_stock("<?=$result_combo_stock['cs_id']?>")'></i></td>
                                <td width="10%" id="editing_slno_<?=$result_combo_stock['cs_id']?>"><?=$i?></td>
                                <td><strong class="stock_id" id="stock_id_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cn_name'].' '.$result_combo_stock['cp_pack_name']?></strong></td>
                                <td class="stock_number"><span class="stock_number_diplay" id="stock_number_diplay_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cs_stock_number']?></span><input type="text" style="display:none"  class="stock_number_edit" id="stock_number_edit_<?=$result_combo_stock['cs_id']?>" onkeypress="return numdot(event)"></td>
                                <td class="stock_status" id="stock_status_<?=$result_combo_stock['cs_id']?>"><?php if($result_combo_stock['cs_stock_status']=='Y'){ echo 'In Stock';}else { echo 'Out of Stock';}?></td>
                                <td class="stock_date" id="stock_date_<?=$result_combo_stock['cs_id']?>"><?=$result_combo_stock['cs_stock_date']?></td>
                               
                            </tr>
                                <?php
                                    }}
                                ?>
                             
                            </tbody>
                       </table>
                           <?php
                               echo '<div align="center" class="ta_cumstomer_pagination_cc"></div>';
                                $a=$database->paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
                            echo $a;
                                ?>  
                            <script> 
                             $(document).ready(function() {
                                $('.menu_total_showing_text').text('Showing '+ <?=$startnum?>+' to '+ <?=$i?>+' of '+ <?=$get_total_rows?>);
                                 localStorage.page=$('.pagination li.active').find('a').text();
                             });
                            
                            
                            </script> 
                           
                            
 <?php
}
?>
        <!-----------Menu end------------->
