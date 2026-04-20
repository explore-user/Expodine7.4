 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn2").click(function(e){
	
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
		  var id_str   =  $(this).attr("cid");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("mid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_div_addon.php",
			data: "value=deladdon&mid="+idval+"&prefrncid="+bcval,
			success: function(msg)
			{
					
					$.ajax({
			type: "POST",
			url: "load_div_addon.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
			
				$('#menupreference').html(msg);
			}
		});
			   
			}
		});
                
                 $('.addon_error').show();
                      
      $('.addon_error').text('REMOVED');
      $('.addon_error').delay(1000).fadeOut('slow');
	///}
	   });	      
            });
</script>  
<!-- delete ends  -->
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if($_REQUEST['value']=="addonadding"){
	$prefid		= $_REQUEST['adid'];
        $menuid=$_REQUEST['menuid'];
        $insertion['mar_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuid']);
	$insertion['mar_addon_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['adid']);
        $insertion['mar_rate'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['addonrate']);
	$sql=$database->check_duplicate_entry('tbl_menu_addon_rate',$insertion);
	 if($sql!=1)
	{
		
	$insertid              			=  $database->insert('tbl_menu_addon_rate',$insertion);
	?>
    <script>
    	document.getElementById("preference").value = "";
		</script>
    
<?php
	 }
	 else
	 {
		 ?>
		       <span id="prefnotstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var prefrncstatus=$('#prefnotstatus');
			  prefrncstatus.text('Already exists');
			 </script>  
                      <?php
	 }
	
?>
 <table width="100%" border="0" cellspacing="5"  class="scroll">   
 <thead>
 <tr>
    <th>Addons</th>
    <th>Rate</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_addon_rate  where mar_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$menu_name1=$database->show_addon_ful_details($result_cat_s['mar_addon_id']);
?>
    <tr>
            <td><?=$menu_name1['ma_name']?></td>
             <td><?=$result_cat_s['mar_rate']?></td>
            <td> <a class="tab_edt_btn2" href="#" cid="m_<?=$result_cat_s['mar_menuid']?>" mid="b_<?=$result_cat_s['mar_addon_id']?>" ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>

    </tbody>
   </table> 
    <?php }else if($_REQUEST['value']=="deladdon"){ 
	
	$menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$pid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['prefrncid']);
	
	
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menu_addon_rate where mar_menuid='".$menuid."'  and mar_addon_id='".$pid."'"); 
	
	 }else if($_REQUEST['value']=="loadbranch"){
		 
		 $menid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Addons</th>
     <th>Rate</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menu_addon_rate  where mar_menuid='".$menid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$menu_name=$database->show_addon_ful_details($result_cat_s['mar_addon_id']);
?>
    <tr>
             <td><?=$menu_name['ma_name']?></td>
             <td><?=$result_cat_s['mar_rate']?></td>
            <td> <a class="tab_edt_btn2" href="#" cid="m_<?=$result_cat_s['mar_menuid']?>" mid="b_<?=$result_cat_s['mar_addon_id']?>"  ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>

    </tbody>
    </table>
     <?php } ?>
