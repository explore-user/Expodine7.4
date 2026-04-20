 <script src="js/jquery-1.10.2.min.js"></script>
 <script>
    $(document).ready(function(){
        
	$(".tab_edt_btn15").click(function(e){
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
        $(".alert_error_popup_all_in_one_menu").show();
             $(".alert_error_popup_all_in_one_menu").text('DELETED');
             $(".alert_error_popup_all_in_one_menu").delay(2000).fadeOut('slow');
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("nid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
	 var fr_str   =  $(this).attr("fid");
		  var fr_arr	  =	 fr_str.split("_");
		  var frval       =  fr_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_extra_tax.php",
			data: "value=deletetax&mid="+idval+"&taxid="+frval+"&slno="+bcval,
			success: function(msg)
			{
			}
		});
		$.ajax({
			type: "POST",
			url: "load_extra_tax.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#menutax').html(msg);
			}
		});
	//}
	   });	      
            });   
</script> 
 
 
<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if($_REQUEST['value']=="addtax"){
	$nut=$_REQUEST['taxname'];
        $menuid=$_REQUEST['mid'];
        $insertion['mtm_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['mtm_tax_id']              =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['taxname']);	
	$sql=$database->check_duplicate_entry('tbl_menu_tax_master',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_menu_tax_master',$insertion);
        
        
        $tx=$_REQUEST['taxname'];
         $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$_REQUEST['mid']."','(Taxid:$tx)','".$_SESSION['expodine_id']."','Item Tax Added','Menu master')");   
        
        
        
	?>
    <script>
	document.getElementById("extrataxname").value = "";
	$('#extrataxname').find('option:first').attr('selected', 'selected');
	</script>
   <?php  }
	 else
	 {
		   ?>
		       <span id="taxstatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var taxstatus=$('#taxstatus');
			  taxstatus.text('Already exists');
			 </script>  
                      <?php
	 }
?>                         
                         
                         <table width="100%" border="0" cellspacing="5" id="menutax" class="scroll responstable" >   
 <thead>
 <tr>
    <th width="15%">Sl No</th>
    <th>TAX</th>
    <th width="15%">Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_tax_master where mtm_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;$i=1;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$tax_name=$database->show_tax_ful_details($result_cat_s['mtm_tax_id']);
?>
    <tr>
            <td><?=$i++?></td>
            <td><?=$tax_name['amc_name']?></td>
            <td> 
                 <a class="tab_edt_btn15" href="#" id="m_<?=$result_cat_s['mtm_menuid']?>" nid="b_<?=$result_cat_s['mtm_slno']?>" fid="f_<?=$result_cat_s['mtm_tax_id']?>"   ><img src="img/delete_btn_2.png"></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }
    
     else if($_REQUEST['value']=="deletetax"){ 
	$mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$taxid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['taxid']);
        $slno 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['slno']);
        
        $tx=$_REQUEST['taxid'];
         $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$_REQUEST['mid']."','(Taxid:$tx)','".$_SESSION['expodine_id']."','Item Tax Deleted','Menu master')");   
        
        
        
        
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menu_tax_master where mtm_menuid='".$mid."'  and mtm_tax_id='".$taxid."' and mtm_slno='".$slno."'"); 
	 }
         else if($_REQUEST['value']=="loadbranch"){
		 
		 $mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menid']);
		  ?>
  <table width="100%" border="0" cellspacing="5" id="menutax" class="scroll">          
 <thead>
 <tr>
    <th width="15%">Sl No</th>
    <th>TAX</th>
    <th width="15%">Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_tax_master where mtm_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
			$tax_name=$database->show_tax_ful_details($result_cat_s['mtm_tax_id']);
?>
    <tr>
            <td><?=$result_cat_s ['mtm_slno']?></td>
            <td><?=$tax_name['amc_name']?></td>
                 
            <td> 
                <a class="tab_edt_btn15" href="#" id="m_<?=$result_cat_s['mtm_menuid']?>" nid="b_<?=$result_cat_s['mtm_slno']?>" fid="f_<?=$result_cat_s['mtm_tax_id']?>"   ><img src="img/delete_btn_2.png"></a>
    </td>
    </tr>

  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } ?>
    
      
                         