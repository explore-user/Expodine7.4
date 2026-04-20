 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn1").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("meid");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("combinationid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divcombination.php",
			data: "value=delcombination&mid="+idval+"&combnid="+bcval,
			success: function(msg)
			{
			 $.ajax({
			type: "POST",
			url: "load_divcombination.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#menucombination').html(msg);
			}
		});
			}
		});
	}
	   });	      
            });
</script>  
<!-- delete ends  -->
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if($_REQUEST['value']=="addcombination"){
	$cid		= $_REQUEST['combid'];
$midnew=$_REQUEST['menuid'];
$insertion['mn_menucombid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['combid']);
	$insertion['mn_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuid']);
	$sql=$database->check_duplicate_entry('tbl_menucombination',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_menucombination',$insertion);
	?>
	<script>
		document.getElementById("menu").value = "";
	</script>
	
	 <?php }
	 else
	 {
		 	 ?>
		       <span id="comstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var comstatus=$('#comstatus');
			  comstatus.text('Already exists');
			 </script>  
                      <?php
	 }
?>
 <table width="100%" border="0" cellspacing="5"  class="scroll">   
 <thead>
 <tr>
    <th width="30%">Combination</th>
    <th width="10%">Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menucombination where mn_menuid='".$midnew."' "); 

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$menu_name=$database->show_menu_ful_details($result_cat_s['mn_menucombid']);
?>
    <tr>
            <td><?=$menu_name['mr_menuname']?></td>
            <td> <a class="tab_edt_btn1" href="#" combinationid="m_<?=$result_cat_s['mn_menucombid']?>" meid="b_<?=$result_cat_s['mn_menuid']?>" ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }else if($_REQUEST['value']=="delcombination"){ 
	$menudel 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$cid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['combnid']);
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menucombination where mn_menuid='".$menudel."'  and mn_menucombid='".$cid."'"); 
	 }else if($_REQUEST['value']=="loadbranch"){
		 $menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Combination</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menucombination where mn_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
		$menu_name=$database->show_menu_ful_details($result_cat_s['mn_menucombid']);
?>
    <tr>
           <td><?=$menu_name['mr_menuname']?></td>
            <td> <a class="tab_edt_btn1" href="#" meid="m_<?=$result_cat_s['mn_menuid']?>" combinationid="b_<?=$result_cat_s['mn_menucombid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } ?>
