 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
$(document).ready(function(){
    $(".tab_edt_btn14").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
            var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        var por=$(this).attr('poid');
                        var por1=por.split('_');
                        //alert(dinein_data[5]);
                        var  menuid1 =$("#countersalevalue").val();
                        var portion=por1[1];
                        //alert(portion);
                        
		 $.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=delcountersale&mid="+menuid1+"&portion="+portion+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[2]+"&packloose="+dinein_data[6]+"&unit="+dinein_data[4]+"&baseunit="+dinein_data[3]+"&weight="+dinein_data[5]+"&barcode="+dinein_data[7],
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=loadbranch&menid="+menuid1,
			success: function(msg)
			{
				$('#countersaletab').html(msg);
				
			}
		});
		   }
		});
	}
    });	      
});
</script>  


<?php
//include('includes/session.php');
session_start();		
include("database.class.php"); 
$database	= new Database(); 	


if($_REQUEST['value']=="addcountersale"){
    
    
        $menu_baseunit_id='';
	$nut=$_REQUEST['portion'];
	$rate		= $_REQUEST['rate'];
        $menuid=$_REQUEST['mid'];
 
        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
        if($num_baseunit){
          while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
	  {
		$menu_baseunit_id=$result_baseunit['bu_id'];
                          
	  }
        }
        
        if($_REQUEST['cs_plu_tax']!=''){
          $insertion['mrc_menu_tax_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['cs_plu_tax']);
        }
        
         if($_REQUEST['cs_menu_tax']!=''){
           $insertion['mrc_menu_tax_value'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['cs_menu_tax']);
        }
        
        $insertion['mrc_menu_final_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['cs_plu_rate']);
        
        $insertion['mrc_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['mrc_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ratetype']);
        $insertion['mrc_barcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['barcode']);
        if($_REQUEST['ratetype']=='Portion')
        {
         $insertion['mrc_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);   
        }
        if($_REQUEST['ratetype']=='Unit')
        {
         $insertion['mrc_unit_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['packloose']);   
         if($_REQUEST['packloose']=='Packet')
        {
         $insertion['mrc_unit_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['weight']);   
         $insertion['mrc_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unit']);
        }
        if($_REQUEST['packloose']=='Loose')
        {
         $insertion['mrc_base_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$menu_baseunit_id);   
         
        }
         
        }
	$branch=$_SESSION['branchofid'];
	$insertion['mrc_branchid']=mysqli_real_escape_string($database->DatabaseLink,$branch);	
	$sql=$database->check_duplicate_entry('tbl_menurate_counter',$insertion);
	 if($sql!=1)
	{
		$insertion['mrc_rate'] 	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['rate']);	
	
	            if($_REQUEST['ratetype']=='Unit'){
                if($_REQUEST['packloose']=='Loose')
                {
                
                $sql_baseunit_check  =  $database->mysqlQuery("select mrc_base_unit_id from tbl_menurate_counter where mrc_base_unit_id='".$menu_baseunit_id."' and mrc_menuid='".$menuid."'  and mrc_unit_type = 'Loose' "); 
                $num_baseunit_check  = $database->mysqlNumRows($sql_baseunit_check);
               
                if(!$num_baseunit_check){
                 $insertid =  $database->insert('tbl_menurate_counter',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="counterratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var counterratestatus=$('#counterratestatus');
			  counterratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                }
                else if($_REQUEST['packloose']=='Packet')
                {
                
                $sql_unit_check  =  $database->mysqlQuery("select mrc_unit_id from tbl_menurate_counter where mrc_unit_id='".$_REQUEST['unit']."' and mrc_menuid='".$menuid."'  and mrc_unit_weight='".$_REQUEST['weight']."' "); 
                $num_unit_check  = $database->mysqlNumRows($sql_unit_check);
                
                if(!$num_unit_check){
                 $insertid =  $database->insert('tbl_menurate_counter',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="counterratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                       <script type="text/javascript">
			  var counterratestatus=$('#counterratestatus');
			  counterratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                } 
        }
                else if($_REQUEST['ratetype']=='Portion')
                {
               
                $sql_portion_check  =  $database->mysqlQuery("select mrc_portion from tbl_menurate_counter where mrc_portion='".$nut."' and mrc_menuid='".$menuid."'  and mrc_rate_type='Portion' "); 
                $num_portion_check  = $database->mysqlNumRows($sql_portion_check);
                
                if(!$num_portion_check){
                 $insertid =  $database->insert('tbl_menurate_counter',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="counterratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                <script type="text/javascript">
			  var counterratestatus=$('#counterratestatus');
			  counterratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                }
                
                
                
            $date_log_in=date('Y-m-d H:i:s');
            $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','(Rate:$rate) (P:$nut) ','".$_SESSION['expodine_id']."','Rate Added','CS')");   
                
          $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
       
        ?>
        <script>
	document.getElementById("countersaleportion").value = "";
	$('#countersaleportion').find('option:first').attr('selected', 'selected');
	document.getElementById("countersalerate").value = "";
        document.getElementById("csweight").value = "";
        document.getElementById("csbarcode").value = "";
        document.getElementById("cskglit").value = "1";
	</script>
   <?php  }
	 else
	 {
		   ?>
		       <span id="counterratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var counterratestatus=$('#counterratestatus');
			  counterratestatus.text('Already exists');
			 </script>  
                      <?php
	 }
         ?>
        <script> 
        $('.countereditrate').click( function() { 
                   
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#countersalerate").val(dinein_data[0]);
                        $("#countersaleportion").val(dinein_data[1]);
                        $("#csportionselect").val(dinein_data[2]);
                       // $("#csbarcode").prop('disabled',true);
                        $("#csbarcode").val(dinein_data[7]);
                        
                         if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#cs_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#cs_menu_rate").val(dinein_data[0]);   
                        }
                        $("#cs_menu_tax_amt").val(dinein_data[8]);
                       // $("#cs_menu_rate").val(dinein_data[9]);
                        $("#cs_menu_tax").val(dinein_data[10]);
                        
                        if(dinein_data[2]=='Portion'){
                        $('#csportionunitspan').css('display','block');
                        $('#csportionselectspan').css('display','block');
                        $('#cspacketloosespan').css('display','none');
                        $('#csweightspan').css('display','none');
                        $('#cskglitterspan').css('display','none');
                        $('#csbaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#csportionunitspan').css('display','block');
                            $('#cspacketloosespan').css('display','block');
                            $('#csportionselectspan').css('display','none');
                            $('#cskglitterspan').css('display','block');
                            $('#cspackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#csweightspan').css('display','block');
                            $('#csweight').prop('disabled',true);
                            $('#csweight').val(dinein_data[5]);
                            $('#cskglitterspan').css('display','block');
                            $('#cskglit').val(dinein_data[4]);
                            $('#csbaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#csportionselectspan').css('display','none');
                            $('#csbaseunitspan').css('display','block');
                            $('#csbaseunit').val(dinein_data[3]);
                            $('#csweightspan').css('display','none');
                            $('#cskglitterspan').css('display','none');
                        }
                        }
                        $("#ucountersale").css("display","block");
                        $("#countersale").css("display","none");
                        $(".countereditrate").css("display","none");
                        $(".ncountereditrate").css("display","inline-block");
                        $(".counterselect").prop("disabled", true);
                    });
                    
                $('.ucountersale').click( function() {     
                  $("#ucountersale").css("display","none"); 
                  $("#countersale").css("display","block");
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                   $(".counterselect").prop("disabled", false);
                 });   
                 </script>

 <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
     <th>Rate Type</th>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Unit Type</th>
    <th>Unit Weight</th>
    <th>Unit Id</th>
    <th>Base unit Id</th>
    <th>Rate</th>
     <th>Tax</th>
      <th>Final Rate</th>
    <th>Barcode</th>
    <th>Edit</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
		    $portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                    $menubase_unit_name='';
                                         if($result_cat_s['mrc_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mrc_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'].'|'.$result_cat_s['mrc_menu_tax_amount'].'|'.$result_cat_s['mrc_menu_final_amount'].'|'.$result_cat_s['mrc_menu_tax_value'];

?>
    <tr>    
            <td><?=$result_cat_s['mrc_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrc_unit_type']?></td>
            <td><?=$result_cat_s['mrc_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
            <td><?=number_format($result_cat_s['mrc_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
            <td><?=number_format($result_cat_s['mrc_menu_final_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=$result_cat_s['mrc_barcode']?></td>
            <td> 
                <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" id2="<?=$counter_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
             <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
             <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }
else if($_REQUEST['value']=="upcountersale"){
    
       $string='';
       $nut=$_REQUEST['portion'];
       $rate	= $_REQUEST['rate'];
       $menuid=$_REQUEST['mid'];
        if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mrc_portion='$nut'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mrc_unit_weight='".$_REQUEST['weight']."' and mrc_unit_id='".$_REQUEST['unit']."'";   
            }
            if($_REQUEST['packloose']=='Loose')
            { 
                $menubase_unit='';
                $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
                $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                if($num_baseunit){
                  while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
                          {
                                          $menubase_unit=$result_baseunit['bu_id'];

                          }			
                } 
               $string.= " and  mrc_base_unit_id='".$menubase_unit."' ";
            }
         
        }
       
        
        $old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mrc_rate from tbl_menurate_counter where mrc_menuid='$menuid' $string "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mrc_rate'];

                          }			
                } 
        
        
        if($_REQUEST['cs_menu_tax']!='' && $_REQUEST['cs_menu_tax']>0){
            
               $query3=$database->mysqlQuery("update tbl_menurate_counter set mrc_rate='$rate',mrc_menu_tax_amount='".$_REQUEST['cs_plu_tax']."',mrc_barcode='".$_REQUEST['barcode']."',mrc_menu_final_amount='".$_REQUEST['cs_plu_rate']."',mrc_menu_tax_value='".$_REQUEST['cs_menu_tax']."' where mrc_menuid='$menuid' $string ");
      
      
        }else{
              $query3=$database->mysqlQuery("update tbl_menurate_counter set mrc_rate='$rate',mrc_menu_tax_amount='0',mrc_barcode='".$_REQUEST['barcode']."',mrc_menu_final_amount='".$_REQUEST['cs_plu_rate']."',mrc_menu_tax_value='0' where mrc_menuid='$menuid' $string ");
             
          
        }
       
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");    
        
         $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','(Old Rate:$old_rate) (P:$nut) ','".$_SESSION['expodine_id']."','Rate Updated','CS')");   
       
       ?>
         <script>
	document.getElementById("countersaleportion").value = "";
	$('#countersaleportion').find('option:first').attr('selected', 'selected');
	document.getElementById("countersalerate").value = "";
        document.getElementById("csweight").value = "";
        document.getElementById("csweight").disabled = false;
        document.getElementById("csbarcode").value = "";
        document.getElementById("csbarcode").disabled = false;
        document.getElementById("cskglit").disabled = false;
        document.getElementById("cskglit").value = "1";
	</script>
     <?php 
     ?>
        <script>
        $('.countereditrate').click( function() { 
//                    
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#countersalerate").val(dinein_data[0]);
                        $("#countersaleportion").val(dinein_data[1]);
                        $("#csportionselect").val(dinein_data[2]);
                        //$("#csbarcode").prop('disabled',true);
                        
                        $("#csbarcode").val(dinein_data[7]);
                         if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#cs_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#cs_menu_rate").val(dinein_data[0]);   
                        }
                        
                        $("#cs_menu_tax_amt").val(dinein_data[8]);
                      //  $("#cs_menu_rate").val(dinein_data[9]);
                        $("#cs_menu_tax").val(dinein_data[10]);
                        
                        if(dinein_data[2]=='Portion'){
                        $('#csportionunitspan').css('display','block');
                        $('#csportionselectspan').css('display','block');
                        $('#cspacketloosespan').css('display','none');
                        $('#csweightspan').css('display','none');
                        $('#cskglitterspan').css('display','none');
                        $('#csbaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#csportionunitspan').css('display','block');
                            $('#cspacketloosespan').css('display','block');
                            $('#csportionselectspan').css('display','none');
                            $('#cskglitterspan').css('display','block');
                            $('#cspackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#csweightspan').css('display','block');
                            $('#csweight').prop('disabled',true);
                            $('#csweight').val(dinein_data[5]);
                            $('#cskglitterspan').css('display','block');
                            $('#cskglit').val(dinein_data[4]);
                            $('#csbaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#csportionselectspan').css('display','none');
                            $('#csbaseunitspan').css('display','block');
                            $('#csbaseunit').val(dinein_data[3]);
                            $('#csweightspan').css('display','none');
                            $('#cskglitterspan').css('display','none');
                        }
                        }
                        $("#ucountersale").css("display","block");
                        $("#countersale").css("display","none");
                        $(".countereditrate").css("display","none");
                        $(".ncountereditrate").css("display","inline-block");
                        $(".counterselect").prop("disabled", true);
                    });
                    
                $('.ucountersale').click( function() {     
                  $("#ucountersale").css("display","none"); 
                  $("#countersale").css("display","block");
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                   $(".counterselect").prop("disabled", false);
                 });   
        </script> 
         <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
      <th>Rate Type</th>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Unit Type</th>
    <th>Unit Weight</th>
    <th>Unit Id</th>
    <th>Base unit Id</th>
    <th>Rate</th>
    <th>Tax</th>
      <th>Final Rate</th>
    <th>Barcode</th>
    <th>Edit</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
				$portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                            $menubase_unit_name='';
                                         if($result_cat_s['mrc_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mrc_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'].'|'.$result_cat_s['mrc_menu_tax_amount'].'|'.$result_cat_s['mrc_menu_final_amount'].'|'.$result_cat_s['mrc_menu_tax_value'];
        
?>
    <tr>
            <td><?=$result_cat_s['mrc_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrc_unit_type']?></td>
            <td><?=$result_cat_s['mrc_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
            
              <td><?=number_format($result_cat_s['mrc_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=number_format($result_cat_s['mrc_menu_final_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=$result_cat_s['mrc_barcode']?></td>
            <td> 
                <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" id2="<?=$counter_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
             <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
             <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php
    }
else if($_REQUEST['value']=="delcountersale"){ 
    
    
        $string='';
	$mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$portid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);
	if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mrc_portion='$portid'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mrc_unit_weight='".$_REQUEST['weight']."' and mrc_unit_id='".$_REQUEST['unit']."'";   
            }
            if($_REQUEST['packloose']=='Loose')
            { 
                $menubase_unit='';
                $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
                $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                if($num_baseunit){
                  while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
                          {
                                          $menubase_unit=$result_baseunit['bu_id'];

                          }			
                } 
               $string.= " and  mrc_base_unit_id='".$menubase_unit."' ";
            }
         
        }
        
        $old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mrc_rate from tbl_menurate_counter where mrc_menuid='$mid' $string "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mrc_rate'];

                          }			
                } 
        
        
        
        $sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menurate_counter where mrc_menuid='".$mid."'  $string "); 
        
        $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
        VALUES ('$date_log_in','".$mid."','(Old Rate:$old_rate)  (P:$portid) ','".$_SESSION['expodine_id']."','Rate Deleted','CS')");   
        
          $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
}
else if($_REQUEST['value']=="loadbranch"){
		 
 $mid =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menid']);
  ?>
        
        
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Rate Type</th>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Unit Type</th>
    <th>Unit Weight</th>
    <th>Unit Id</th>
    <th>Base unit Id</th>
    <th>Rate</th>
    <th>Tax</th>
    <th>Final Rate</th>
    <th>Barcode</th>
    <th>Edit</th>
  </tr>
   </thead>
     <tbody >    
         
 <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
			$portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                        $menubase_unit_name='';
                                         if($result_cat_s['mrc_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mrc_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'].'|'.$result_cat_s['mrc_menu_tax_amount'].'|'.$result_cat_s['mrc_menu_final_amount'];

?>
    <tr>
            <td><?=$result_cat_s['mrc_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrc_unit_type']?></td>
            <td><?=$result_cat_s['mrc_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
             <td><?=number_format($result_cat_s['mrc_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
              <td><?=number_format($result_cat_s['mrc_menu_final_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=$result_cat_s['mrc_barcode']?></td>
            <td> 
                <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" bid="br_<?=$result_cat_s['mrc_branchid']?>" id2="<?=$counter_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
             <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>"  class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
             <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>

  <?php $k++;}} ?>
    </tbody>
    </table>
     <?php } 
else if($_REQUEST['value']=="rate_apply_all"){
    
    
    $menu_baseunit_id       =0;
    $unit_type              ='';
    $unit_weight            =0;
    $portion                =0;
    $rate                   = $_REQUEST['rate'];
    $unit_id                =0;
    $base_unit_id           =0;
    $menuid=$_REQUEST['mid'];
    if($_REQUEST['baseunit']!=''){
        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
        if($num_baseunit){
          while($result_baseunit    = $database->mysqlFetchArray($sql_baseunit)) 
          {
                $menu_baseunit_id   =$result_baseunit['bu_id'];

          }
        }
    }
    $rate_type              = $_REQUEST['ratetype'];
    $barcode                = $_REQUEST['barcode'];
    if($rate_type=='Portion' && $_REQUEST['portion']!='')
    {
        $portion            =$_REQUEST['portion'];   
    }
    if($rate_type=='Unit')
    {
        $unit_type          =$_REQUEST['packloose'];   
        if($_REQUEST['packloose']=='Packet')
        {
            $unit_weight    =  $_REQUEST['weight'];   
            $unit_id        = $_REQUEST['unit'];
        }
        if($_REQUEST['packloose']=='Loose')
        {
            $base_unit_id   =  $menu_baseunit_id;   

        }
    }
    
    
     if($_REQUEST['cs_tax_value']!='' && $_REQUEST['cs_tax_value']>0){
        
        $tax=$_REQUEST['cs_tax_value'];
        $tax_amount=$_REQUEST['cs_tax_amount'];
        $final_rate=$_REQUEST['cs_menu_rate'];
        
        
    }else{
        
        $tax=0;
        $tax_amount=0;
        $final_rate=$_REQUEST['cs_menu_rate'];
    }
    
   
     $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','Rate : $rate ','".$_SESSION['expodine_id']."','Rate All','CS')");
    
    
    
        $database->mysqlQuery("SET @menuid      = " . "'" . $menuid . "'");
        $database->mysqlQuery("SET @ratetype    = " . "'" . $rate_type . "'");
        $database->mysqlQuery("SET @portion     = " . "'" . $portion . "'");
        $database->mysqlQuery("SET @unittype    = " . "'" . $unit_type . "'");
        $database->mysqlQuery("SET @unitweight  = " . "'" . $unit_weight . "'");
        $database->mysqlQuery("SET @unitid      = " . "'" . $unit_id . "'");
        $database->mysqlQuery("SET @baseunitid  = " . "'" . $base_unit_id . "'");
        $database->mysqlQuery("SET @rate        = " . "'" . $rate . "'");
        $database->mysqlQuery("SET @barcode     = " . "'" . $barcode . "'");
        
        $database->mysqlQuery("SET @tax_value     = " . "'" . $tax . "'");
         $database->mysqlQuery("SET @tax_amount     = " . "'" . $tax_amount . "'");
         $database->mysqlQuery("SET @final_rate     = " . "'" . $final_rate . "'");
        $Message='';

        $sq=$database->mysqlQuery("CALL proc_menu_rate_applyall(@menuid,@ratetype,@portion,@unittype,@unitweight,@unitid,@baseunitid,@barcode,@rate,@tax_value,@tax_amount,@final_rate,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));

        $rs = $database->mysqlQuery( 'SELECT @Message as Message' );
        while($row = mysqli_fetch_array($rs))
        {
        
        $Message=$row['Message'];

        
        }
        
        
        
          $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
        
         ?>
        <script> 
        $('.countereditrate').click( function() { 
                   
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#countersalerate").val(dinein_data[0]);
                        $("#countersaleportion").val(dinein_data[1]);
                        $("#csportionselect").val(dinein_data[2]);
                       // $("#csbarcode").prop('disabled',true);
                        $("#csbarcode").val(dinein_data[7]);
                        
                         if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#cs_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#cs_menu_rate").val(dinein_data[0]);   
                        }
                        $("#cs_menu_tax_amt").val(dinein_data[8]);
                      //  $("#cs_menu_rate").val(dinein_data[9]);
                        $("#cs_menu_tax").val(dinein_data[10]);
                        
                        if(dinein_data[2]=='Portion'){
                        $('#csportionunitspan').css('display','block');
                        $('#csportionselectspan').css('display','block');
                        $('#cspacketloosespan').css('display','none');
                        $('#csweightspan').css('display','none');
                        $('#cskglitterspan').css('display','none');
                        $('#csbaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#csportionunitspan').css('display','block');
                            $('#cspacketloosespan').css('display','block');
                            $('#csportionselectspan').css('display','none');
                            $('#cskglitterspan').css('display','block');
                            $('#cspackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#csweightspan').css('display','block');
                            $('#csweight').prop('disabled',true);
                            $('#csweight').val(dinein_data[5]);
                            $('#cskglitterspan').css('display','block');
                            $('#cskglit').val(dinein_data[4]);
                            $('#csbaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#csportionselectspan').css('display','none');
                            $('#csbaseunitspan').css('display','block');
                            $('#csbaseunit').val(dinein_data[3]);
                            $('#csweightspan').css('display','none');
                            $('#cskglitterspan').css('display','none');
                        }
                        }
                        $("#ucountersale").css("display","block");
                        $("#countersale").css("display","none");
                        $(".countereditrate").css("display","none");
                        $(".ncountereditrate").css("display","inline-block");
                        $(".counterselect").prop("disabled", true);
                    });
                    
                $('.ucountersale').click( function() {     
                  $("#ucountersale").css("display","none"); 
                  $("#countersale").css("display","block");
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                   $(".counterselect").prop("disabled", false);
                 });   
                 </script>
        <table width="100%" border="0" cellspacing="5"  class="scroll">          
        <thead>
            <tr>
               <th>Rate Type</th>
               <th><?=$_SESSION['s_portionname']?></th>
               <th>Unit Type</th>
               <th>Unit Weight</th>
               <th>Unit Id</th>
               <th>Base unit Id</th>
               <th>Rate</th>
                <th>Tax</th>
                  <th>Final Rate</th>
               <th>Barcode</th>
               <th>Edit</th>
             </tr>
        </thead>
        <tbody >                                           
        <?php
            $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$menuid."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
		{
                    $portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                    $menubase_unit_name='';
                    if($result_cat_s['mrc_base_unit_id']!=''){
                        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                        if($num_baseunit){
                            $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                            $menubase_unit_name=$result_baseunit['bu_name'];
                        }			
                    }
                    $menu_unit_name='';  
                    if($result_cat_s['mrc_unit_id']!=''){
                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                        $num_unit  = $database->mysqlNumRows($sql_unit);
                        if($num_unit){ 
                            $result_unit  = $database->mysqlFetchArray($sql_unit); 
                            $menu_unit_name=$result_unit['u_name'];
                        }			
                    } 
                    $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'].'|'.$result_cat_s['mrc_menu_tax_amount'].'|'.$result_cat_s['mrc_menu_final_amount'].'|'.$result_cat_s['mrc_menu_tax_value'];

        ?>
        <tr>
            <td><?=$result_cat_s['mrc_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrc_unit_type']?></td>
            <td><?=$result_cat_s['mrc_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
             <td><?=number_format($result_cat_s['mrc_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
              <td><?=number_format($result_cat_s['mrc_menu_final_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=$result_cat_s['mrc_barcode']?></td>
            <td> 
                <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" bid="br_<?=$result_cat_s['mrc_branchid']?>" id2="<?=$counter_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
                <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>"  class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
                <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
        </tr>
        <?php $k++;}} ?>
            <script>
                document.getElementById("countersaleportion").value = "";
                $('#countersaleportion').find('option:first').attr('selected', 'selected');
                document.getElementById("countersalerate").value = "";
                document.getElementById("csweight").value = "";
                document.getElementById("csbarcode").value = "";
                document.getElementById("cskglit").value = "1";
            </script>
        </tbody>
    </table> 
<?php
}        

else if($_REQUEST['value']=="select_department"){
    
    $menuid=$_REQUEST['mid'];
?>
    <script> 
        $('.countereditrate').click( function() { 
                   
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#countersalerate").val(dinein_data[0]);
                        $("#countersaleportion").val(dinein_data[1]);
                        $("#csportionselect").val(dinein_data[2]);
                        //$("#csbarcode").prop('disabled',true);
                        $("#csbarcode").val(dinein_data[7]);
                        
                         if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#cs_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#cs_menu_rate").val(dinein_data[0]);   
                        }
                        
                        $("#cs_menu_tax_amt").val(dinein_data[8]);
                       // $("#cs_menu_rate").val(dinein_data[9]);
                        $("#cs_menu_tax").val(dinein_data[10]);
                        
                        if(dinein_data[2]=='Portion'){
                        $('#csportionunitspan').css('display','block');
                        $('#csportionselectspan').css('display','block');
                        $('#cspacketloosespan').css('display','none');
                        $('#csweightspan').css('display','none');
                        $('#cskglitterspan').css('display','none');
                        $('#csbaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#csportionunitspan').css('display','block');
                            $('#cspacketloosespan').css('display','block');
                            $('#csportionselectspan').css('display','none');
                            $('#cskglitterspan').css('display','block');
                            $('#cspackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#csweightspan').css('display','block');
                            $('#csweight').prop('disabled',true);
                            $('#csweight').val(dinein_data[5]);
                            $('#cskglitterspan').css('display','block');
                            $('#cskglit').val(dinein_data[4]);
                            $('#csbaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#csportionselectspan').css('display','none');
                            $('#csbaseunitspan').css('display','block');
                            $('#csbaseunit').val(dinein_data[3]);
                            $('#csweightspan').css('display','none');
                            $('#cskglitterspan').css('display','none');
                        }
                        }
                        $("#ucountersale").css("display","block");
                        $("#countersale").css("display","none");
                        $(".countereditrate").css("display","none");
                        $(".ncountereditrate").css("display","inline-block");
                        $(".counterselect").prop("disabled", true);
                    });
                    
                $('.ucountersale').click( function() {     
                  $("#ucountersale").css("display","none"); 
                  $("#countersale").css("display","block");
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                   $(".counterselect").prop("disabled", false);
                 });   
                 </script>
        <table width="100%" border="0" cellspacing="5"  class="scroll">          
        <thead>
            <tr>
               <th>Rate Type</th>
               <th><?=$_SESSION['s_portionname']?></th>
               <th>Unit Type</th>
               <th>Unit Weight</th>
               <th>Unit Id</th>
               <th>Base unit Id</th>
               <th>Rate</th>
                 <th>Tax</th>
                 <th>Final Rate</th>
               <th>Barcode</th>
               <th>Edit</th>
             </tr>
        </thead>
        <tbody >                                           
        <?php
            $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$menuid."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
		{
                    $portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                    $menubase_unit_name='';
                    if($result_cat_s['mrc_base_unit_id']!=''){
                        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                        if($num_baseunit){
                            $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                            $menubase_unit_name=$result_baseunit['bu_name'];
                        }			
                    }
                    $menu_unit_name='';  
                    if($result_cat_s['mrc_unit_id']!=''){
                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                        $num_unit  = $database->mysqlNumRows($sql_unit);
                        if($num_unit){ 
                            $result_unit  = $database->mysqlFetchArray($sql_unit); 
                            $menu_unit_name=$result_unit['u_name'];
                        }			
                    } 
                    $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'].'|'.$result_cat_s['mrc_menu_tax_amount'].'|'.$result_cat_s['mrc_menu_final_amount'].'|'.$result_cat_s['mrc_menu_tax_value'];

        ?>
        <tr>
            <td><?=$result_cat_s['mrc_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mrc_unit_type']?></td>
            <td><?=$result_cat_s['mrc_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
               <td><?=number_format($result_cat_s['mrc_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mrc_menu_final_amount'],$_SESSION['be_decimal'])?></td>
               <td><?=$result_cat_s['mrc_barcode']?></td>
            <td> 
                <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" bid="br_<?=$result_cat_s['mrc_branchid']?>" id2="<?=$counter_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
                <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>"  class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
                <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
        </tr>
        <?php $k++;}} ?>
            <script>
                document.getElementById("countersaleportion").value = "";
                $('#countersaleportion').find('option:first').attr('selected', 'selected');
                document.getElementById("countersalerate").value = "";
                document.getElementById("csweight").value = "";
                document.getElementById("csbarcode").value = "";
                document.getElementById("cskglit").value = "1";
            </script>
        </tbody>
    </table>              
<?php
}
?>