 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn11").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("imgid");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var md_str   =  $(this).attr("id");
		  var md_arr	  =	 md_str.split("_");
		  var mdval       =  md_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=delimage&mid="+idval+"&mimg="+mdval,
			success: function(msg)
			{
			$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+mdval,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
			}
		});
	}
	   });	      
            });
</script>
<script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" />   
 <style>
.menu_upload_img{width:100%;}
.menu_upload_img td, th{max-width:0px;}
 </style> 
<!-- delete ends  -->
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if($_REQUEST['value']=="addimage"){
  $imid		= $_REQUEST['mid'];
?>
 <table  class="scroll menu_upload_img">   
 <thead>
 <tr>
    <th>Images</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuimages where mes_menuid='".$imid."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
            <td><?php if($result_cat_s['mes_imagethumb']) { ?><a href="<?=$result_cat_s['mes_imagethumb']?>" class="preview">View</a><?php }else{echo "
NULL";} ?></td>
            <td> <a class="tab_edt_btn11" href="#" id="m_<?=$result_cat_s['mes_menuid']?>" imgid="m_<?=$result_cat_s['mes_imagename']?>"  ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }
	else if($_REQUEST['value']=="delimage"){ 
            
	$menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$imgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mimg']);
	$thumb="";
	$sql_img=$database->mysqlQuery("Select mes_imagethumb from tbl_menuimages where mes_imagename ='".$menuid."' "); //selecting image to be deleted from folder uploads
	while($result_cat_s  = $database->mysqlFetchArray($sql_img)) 
		  {
			  $thumb=$result_cat_s['mes_imagethumb'];
		  }
		  unlink($thumb); //unlinking thumb image from uploads folder
		  unlink($menuid); //unlinking original image from uploads folder
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menuimages where mes_imagename ='".$menuid."' "); 
        
        $dt_new=date('Y-m-d H:i:s');
        $sql12=$database->mysqlQuery("INSERT INTO tbl_menuimage_delete_log(tmi_thumb_location,tmi_menuid, tmi_date_time,tmi_cloud_branch_id) VALUES ('$thumb','$imgid','$dt_new','".$_SESSION['firebase_id']."')");   
        
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	 }
	 
	 else if($_REQUEST['value']=="loadbranch"){
		 $menuimgid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
		  ?>
  <table  class="scroll menu_upload_img  ">          
 <thead>
 <tr>
    <th>Image</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuimages where mes_menuid='".$menuimgid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
          <!--  <td width="30%"><?=$result_cat_s['mes_imagename']?></td>-->
             <td><?php if($result_cat_s['mes_imagename']) { ?><a href="<?=$result_cat_s['mes_imagename']?>" class="preview">View</a><?php }else{echo "
NULL";} ?></td>  
          <!--  <td><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
            <td > <a class="tab_edt_btn11" href="#" imgid="m_<?=$result_cat_s['mes_imagename']?>" id="m_<?=$result_cat_s['mes_menuid']?>"   ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>

  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } ?>
