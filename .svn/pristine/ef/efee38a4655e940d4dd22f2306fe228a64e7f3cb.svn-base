 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn13").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("nid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divroomservicerate.php",
			data: "value=delroomservice&mid="+idval+"&portion="+bcval,
			success: function(msg)
			{
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divroomservicerate.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#roomservicetab').html(msg);
			}
		});
	}
	   });	      
            });
</script>  


<!-- delete ends  -->
<?php
//include('includes/session.php');
session_start();		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if($_REQUEST['value']=="addroomservice"){
	$nut=$_REQUEST['portion'];
	$rate		= $_REQUEST['rate'];
 $menuid=$_REQUEST['mid'];
$insertion['mrs_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['mrs_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);	
	$branch=$_SESSION['branchofid'];
	$insertion['mrs_branchid']=mysqli_real_escape_string($database->DatabaseLink,$branch);	
	$sql=$database->check_duplicate_entry('tbl_menurate_roomservice',$insertion);
	 if($sql!=1)
	{
			$insertion['mrs_rate'] 	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['rate']);	
	$insertid              			=  $database->insert('tbl_menurate_roomservice',$insertion);
	?>
    <script>
	document.getElementById("rmserviceportion").value = "";
	$('#rmserviceportion').find('option:first').attr('selected', 'selected');
	document.getElementById("rmservicerate").value = "";
	</script>
   <?php  }
	 else
	 {
		   ?>
		       <span id="roomratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var roomratestatus=$('#roomratestatus');
			  roomratestatus.text('Already exists');
			 </script>  
                      <?php
	 } ?>
        <script> 
       $('.roomeditrate').click( function() { 
                    
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#rmservicerate").val(dinein_data[0]);
                        $("#rmserviceportion").val(dinein_data[1]);
                        $("#uroomservice").css("display","block");
                        $("#roomservice").css("display","none");
                        $(".roomeditrate").css("display","none");
                        $(".nroomeditrate").css("display","inline-block");
                        $(".roomselect").prop("disabled", true);
                    });
                    
                $('.uroomservice').click( function() {     
                  $("#uroomservice").css("display","none"); 
                  $("#roomservice").css("display","block");
                  $(".roomeditrate").css("display","inline-block");
                  $(".nroomeditrate").css("display","none");
                  $(".roomselect").prop("disabled", false);
                 });   
         </script>
         
 <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Rate</th>
    <th>Edit</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_roomservice where mrs_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                             $roomservice_id =$result_cat_s['mrs_rate'].'|'.$result_cat_s['mrs_portion'];
                             $portion_name=$database->show_portion_ful_details($result_cat_s['mrs_portion']);
?>
    <tr>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrs_rate']?></td>
            <td> 
<!--                <a class="tab_edt_btn13" href="#" id="m_<?=$result_cat_s['mrs_menuid']?>" nid="b_<?=$result_cat_s['mrs_portion']?>"  ><i class="glyphicon glyphicon-trash"></i></a>-->
            <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>" class="roomeditrate" id1="<?=$roomservice_id?>" href="#" ><i class="fa fa-edit"></i></a>
            <a style="font-size: 15px;padding-left: 4px; display: none;" class="nroomeditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }
    
    else if($_REQUEST['value']=="uproomservice"){
     $nut=$_REQUEST['portion'];
     $rate	= $_REQUEST['rate'];
     $menuid=$_REQUEST['mid']; 
     $query3=$database->mysqlQuery("update tbl_menurate_roomservice set mrs_portion='$nut',mrs_rate='$rate' where mrs_menuid='$menuid' and mrs_portion='$nut'");
      ?>
      <script>
	document.getElementById("rmserviceportion").value = "";
	$('#rmserviceportion').find('option:first').attr('selected', 'selected');
	document.getElementById("rmservicerate").value = "";
	</script>
        <?php 
     ?>
        <script>
         $('.roomeditrate').click( function() { 
                    
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#rmservicerate").val(dinein_data[0]);
                        $("#rmserviceportion").val(dinein_data[1]);
                        $("#uroomservice").css("display","block");
                        $("#roomservice").css("display","none");
                        $(".roomeditrate").css("display","none");
                        $(".nroomeditrate").css("display","inline-block");
                        $(".roomselect").prop("disabled", true);
                    });
                    
                $('.uroomservice').click( function() {     
                  $("#uroomservice").css("display","none"); 
                  $("#roomservice").css("display","block");
                  $(".roomeditrate").css("display","inline-block");
                  $(".nroomeditrate").css("display","none");
                  $(".roomselect").prop("disabled", false);
                 }); 
        </script> 
        <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Rate</th>
    <th>Edit</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_roomservice where mrs_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    $roomservice_id =$result_cat_s['mrs_rate'].'|'.$result_cat_s['mrs_portion'];
		    $portion_name=$database->show_portion_ful_details($result_cat_s['mrs_portion']);
?>
    <tr>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrs_rate']?></td>
            <td> 
<!--                <a class="tab_edt_btn13" href="#" id="m_<?=$result_cat_s['mrs_menuid']?>" nid="b_<?=$result_cat_s['mrs_portion']?>"  ><i class="glyphicon glyphicon-trash"></i></a>-->
            <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>" class="roomeditrate" id1="<?=$roomservice_id?>" href="#" ><i class="fa fa-edit"></i></a>
            <a style="font-size: 15px;padding-left: 4px; display: none;" class="nroomeditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php
    }
    
    
    else if($_REQUEST['value']=="delroomservice"){ 
	$mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$portid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menurate_roomservice where mrs_menuid='".$mid."'  and mrs_portion='".$portid."' "); 
	 }else if($_REQUEST['value']=="loadbranch"){
		 
		 $mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th width="30%"><?=$_SESSION['s_portionname']?></th>
    <th width="30%">Rate</th>
    <th width="20%">Edit</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_roomservice where mrs_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
			$roomservice_id =$result_cat_s['mrs_rate'].'|'.$result_cat_s['mrs_portion'];	
			$portion_name=$database->show_portion_ful_details($result_cat_s['mrs_portion']);
?>
    <tr>
            <td><?=$portion_name ['pm_portionname']?></td>
                 <td><?=$result_cat_s ['mrs_rate']?></td>
            <td> 
<!--                <a class="tab_edt_btn13" href="#" id="m_<?=$result_cat_s['mrs_menuid']?>" nid="b_<?=$result_cat_s['mrs_portion']?>" bid="br_<?=$result_cat_s['mrs_branchid']?>"   ><i class="glyphicon glyphicon-trash"></i></a>-->
            <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>" class="roomeditrate" id1="<?=$roomservice_id?>" href="#" ><i class="fa fa-edit"></i></a>
            <a style="font-size: 15px;padding-left: 4px; display: none;" class="nroomeditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>

  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } ?>

