 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn4").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("ingid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divingredient.php",
			data: "value=delingredient&mid="+idval+"&ingid="+bcval,
			success: function(msg)
			{
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divingredient.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menuingredient').html(msg);
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
if($_REQUEST['value']=="addingredient"){
	$ingid		= $_REQUEST['ingrid'];
$mid=$_REQUEST['menuid'];
$insertion['ms_ingridentid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingrid']);
	$insertion['ms_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuid']);
	$sql=$database->check_duplicate_entry('tbl_menuingredients',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_menuingredients',$insertion);
	?>
    <script>
    document.getElementById("ingredient").value = "";
	</script>
	<?php
	 }
	 else
	 {
		 	 ?>
       
		       <span id="ingrdnotstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var ingrstatus=$('#ingrdnotstatus');
			  ingrstatus.text('Already exists');
			 </script>  
                      <?php
	 }
	
?>
 <table width="100%" border="0" cellspacing="5"  class="scroll">   
 <thead>
 <tr>
    <th>Ingredients</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuingredients where ms_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$ingredient_name=$database->show_ingredient_ful_details($result_cat_s['ms_ingridentid']);
?>
    <tr>
            <td><?=$ingredient_name['ir_ingredientname']?></td>
            <td> <a class="tab_edt_btn4" href="#" id="m_<?=$result_cat_s['ms_menuid']?>" ingid="b_<?=$result_cat_s['ms_ingridentid']?>"  ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>

  <?php $k++;}} ?>

    </tbody>
   </table> 
    <?php }else if($_REQUEST['value']=="delingredient"){ 
	
	$ingrid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ingid']);
	 $mid=mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menuingredients where ms_ingridentid='".$ingrid."' and ms_menuid='".$mid."' "); 
	
	 }else if($_REQUEST['value']=="loadbranch"){
		 
		 $mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Ingredient</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuingredients where ms_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				$ingredient_name=$database->show_ingredient_ful_details($result_cat_s['ms_ingridentid']);
?>
    <tr>
            <td><?=$ingredient_name['ir_ingredientname']?></td>
            <td> <a class="tab_edt_btn4" href="#" id="m_<?=$result_cat_s['ms_menuid']?>" ingid="b_<?=$result_cat_s['ms_ingridentid']?>" ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } ?>
