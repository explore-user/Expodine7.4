 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn2").unbind().click(function(e){
            
	//var check = confirm("Are you sure you want to Delete this record?");
	//if(check==true)
	//{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var mainmenu=$('#addon').val();
		 $.ajax({
			type: "POST",
			url: "load_divaddons.php",
			data: "value=deladdon&mid="+mainmenu+"&addon_menuid="+idval,
			success: function(msg)
			{
					$('#menuaddontable').html(msg);
		   }
		});
                
			$.ajax({
			type: "POST",
			url: "load_divaddons.php",
			data: "value=loadbranch&mid="+mainmenu,
			success: function(msg)
			{
				$('#menuaddontable').html(msg);
			}
		});
                
                $('.addon_error').show();
                      
      $('.addon_error').text('REMOVED');
      $('.addon_error').delay(1000).fadeOut('slow');
    //}
		});      
    });
</script>  
<!-- delete ends  -->
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if(isset($_REQUEST['value']) && $_REQUEST['value']=="add-addon"){
    
    
	$addon_menuid		= $_REQUEST['addon_menuid'];
        $menuid=$_REQUEST['menuid'];
        $insertion['ma_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$menuid);
	$insertion['ma_addon_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$addon_menuid);
	$sql=$database->check_duplicate_entry('tbl_menu_addons',$insertion);
	 if($sql!=1)
	{
		
	$insertid              			=  $database->insert('tbl_menu_addons',$insertion);
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	?>
    <script>
    	document.getElementById("addons-menu").value = "";
		</script>
    
<?php
	 }
	 else
	 {
		 ?>
		       <span id="addonnotstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var addonnotstatus=$('#addonnotstatus');
			  addonnotstatus.text('Already exists');
			 </script>  
                      <?php
	 }
	
?>
 <table width="100%" border="0" cellspacing="5"  class="scroll">   
 <thead>
 <tr>
    <th>Add-ons</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select ma_addon_menuid, mr_menuid,mr_menuname from tbl_menu_addons left join tbl_menumaster on mr_menuid=ma_addon_menuid where  ma_menuid='".$_SESSION['menuidselect']."' "); 
//echo "select ma_addon_menuid from tbl_menu_addons where ma_menuid='".$_SESSION['menuidselect']."'";
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                            $menu_name=$result_cat_s['mr_menuname'];
?>                          
    <tr>
            <td><?=$menu_name?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['ma_addon_menuid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   
          </tr>
  <?php $k++;}} ?><input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
    </tbody>
   </table> 
                         
    <?php }
    
else if(isset($_REQUEST['value']) && $_REQUEST['value']=="deladdon"){ 
	
	$menuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$addon_id 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['addon_menuid']);
	
	
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menu_addons where ma_menuid='".$menuid."'  and ma_addon_menuid='".$addon_id."'"); 
	
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
        
	 }
    else if(isset($_REQUEST['value']) && $_REQUEST['value']=="loadbranch"){
		 
		 $menid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Add-ons</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody>
         
    <?php
    
    $sql_cat_s  =  $database->mysqlQuery("select ma_addon_menuid, mr_menuid,mr_menuname from tbl_menu_addons left join tbl_menumaster on mr_menuid=ma_addon_menuid where  ma_menuid='".$_SESSION['menuidselect']."' "); 
    $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                            $menu_name=$result_cat_s['mr_menuname'];
?>                          
    <tr>
            <td><?=$menu_name?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['ma_addon_menuid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   
          </tr>
  <?php $k++;}} ?><input type="hidden" name="menuidnew" id="menuidnew" value="<?=$_SESSION['menuidselect']?>" />
    </tbody>
    </table>
     <?php } ?>
