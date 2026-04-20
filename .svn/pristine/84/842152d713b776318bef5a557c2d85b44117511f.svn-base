 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
     
	$(".tab_edt_btn5").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
                        var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        //alert(dinein_data[5]);
                        var  menuid1 =$("#dineinvalue").val();
                        var portion=$("#dineinportion").val();
                        
            
                   
		 $.ajax({
			type: "POST",
			url: "load_divdinein.php",
			data: "value=deldinein&mid="+menuid1+"&portion="+dinein_data[2]+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[3]+"&floor="+dinein_data[1]+"&packloose="+dinein_data[7]+"&unit="+dinein_data[5]+"&baseunit="+dinein_data[4]+"&weight="+dinein_data[6]+"&barcode="+dinein_data[8],
			success: function(msg)
			{
				$.ajax({
                                type: "POST",
                                url: "load_divdinein.php",
                                data: "value=loadbranch&menid="+menuid1,
                                success: function(msg)
                                {
                                        $('#dinein').html(msg);
                                }
		});
		   }
		});
	}
	   });     
            });
</script>  



<?php
include('includes/session.php');		
include("database.class.php"); 
$database	= new Database(); 	



if($_REQUEST['value']=="adddinein"){
        
        
        $menu_baseunit_id='';
	$nut=$_REQUEST['portion'];
	$rate		= $_REQUEST['rate'];
	$menuid=$_REQUEST['mid'];
        $area=$_REQUEST['floor'];
        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
        if($num_baseunit){
          while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
	  {
		$menu_baseunit_id=$result_baseunit['bu_id'];
                          
	  }
        }
        
        
        $insertion['mmr_floorid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['floor']);
        $insertion['mmr_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['mmr_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ratetype']);
        $insertion['mmr_barcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['barcode']);
        if($_REQUEST['ratetype']=='Portion')
        {
         $insertion['mmr_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);   
        }
        if($_REQUEST['ratetype']=='Unit')
        {
         $insertion['mmr_unit_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['packloose']);   
         if($_REQUEST['packloose']=='Packet')
        {
         $insertion['mmr_unit_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['weight']);   
         $insertion['mmr_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unit']);
        }
        if($_REQUEST['packloose']=='Loose')
        {
         $insertion['mmr_base_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$menu_baseunit_id);   
         
        }
         
        }
        
        
        if($_REQUEST['di_tax_amount']!=''){
        $insertion['mmr_menu_tax_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['di_tax_amount']);
        }
        
         if($_REQUEST['di_tax_value']!=''){
        $insertion['mmr_menu_tax_value'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['di_tax_value']);
        }
        
        $insertion['mmr_menu_final_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['di_menu_rate']);
        
	 $sql=$database->check_duplicate_entry('tbl_menuratemaster',$insertion);
          
	 if($sql!=1)
	{
             
             
             $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' "); 
             
		$insertion['mmr_rate'] 	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['rate']);
                
                
                if($_REQUEST['ratetype']=='Unit'){
                if($_REQUEST['packloose']=='Loose')
                {
                $sql_floor_check  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_rate_type = 'Unit' and mmr_unit_type = 'Loose' and mmr_floorid='".$area."' and mmr_menuid='".$menuid."' "); 
                $num_floor_check  = $database->mysqlNumRows($sql_floor_check);
                
                $sql_baseunit_check  =  $database->mysqlQuery("select mmr_base_unit_id from tbl_menuratemaster where mmr_base_unit_id='".$menu_baseunit_id."' and mmr_menuid='".$menuid."' and mmr_floorid='".$area."' "); 
                $num_baseunit_check  = $database->mysqlNumRows($sql_baseunit_check);
               
                if(!$num_baseunit_check && !$num_floor_check){
                 $insertid =  $database->insert('tbl_menuratemaster',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                       <script type="text/javascript">
			var ratestatus=$('#ratestatus');
			ratestatus.text('Already exists');
		       </script>  
                       
                      <?php
                    }
                }
                else if($_REQUEST['packloose']=='Packet')
                {
                
                $sql_unit_check  =  $database->mysqlQuery("select mmr_unit_id from tbl_menuratemaster where mmr_unit_id='".$_REQUEST['unit']."' and mmr_menuid='".$menuid."' and mmr_floorid='".$area."' and mmr_unit_weight='".$_REQUEST['weight']."' "); 
                $num_unit_check  = $database->mysqlNumRows($sql_unit_check);
               
                if(!$num_unit_check){
                   $insertid =  $database->insert('tbl_menuratemaster',$insertion);
                }else
                {
                    
		?>
		        <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                        <script type="text/javascript">
			 var ratestatus=$('#ratestatus');
			 ratestatus.text('Already exists');
			</script>  
                <?php
                 }
                } 
              }
                else if($_REQUEST['ratetype']=='Portion')
                {
               
                $sql_portion_check  =  $database->mysqlQuery("select mmr_portion from tbl_menuratemaster where mmr_portion='".$nut."' and mmr_menuid='".$menuid."' and mmr_floorid='".$area."' and mmr_rate_type='Portion' "); 
                $num_portion_check  = $database->mysqlNumRows($sql_portion_check);
               
                if(!$num_portion_check){
                 $insertid =  $database->insert('tbl_menuratemaster',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                <script type="text/javascript">
			  var ratestatus=$('#ratestatus');
			  ratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                }


		
                
            $date_log_in=date('Y-m-d H:i:s');
            $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$_REQUEST['mid']."','(Rate:$rate) (P:$nut) (F:$area)','".$_SESSION['expodine_id']."','Rate Add','DI')");
                
                
		if($_SESSION['s_portion_autoday_update']=="Y")
				{
				if($_REQUEST['portion']==$_SESSION['seperateportion'])
				{
					$database->mysqlQuery("UPDATE tbl_menuratemaster  SET mmr_default='N' where mmr_menuid='".$_REQUEST['mid']."'  and  mmr_floorid='".$_REQUEST['floor']."'");
					
					$database->mysqlQuery("UPDATE tbl_menuratemaster  SET mmr_default='Y' where mmr_menuid='".$_REQUEST['mid']."' and  mmr_portion='".$_REQUEST['portion']."' and  mmr_floorid='".$_REQUEST['floor']."'");
				}
				}
		
		
	?>
                         
	<script>
	document.getElementById("dineinportion").value = "";
	
	$('#dineinportion').find('option:first').attr('selected', 'selected');
	document.getElementById("dineinrate").value = "";
	document.getElementById("dineinfloor").value = "";
        document.getElementById("diweight").value = "";
        document.getElementById("dibarcode").value = "";
        document.getElementById("diweight").disabled = false;
        document.getElementById("dibarcode").disabled = false;

	</script>
	<?php }else{ ?>
        
             <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var ratestatus=$('#ratestatus');
			  ratestatus.text('Already exists');
	    </script>  
                         
                         
         <?php
         
	 }
?>
        <script>
            
         $('.editrate').click( function() { 
         
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#dineinrate").val(dinein_data[0]);
                        $("#dineinfloor").val(dinein_data[1]);
                        $("#dineinportion").val(dinein_data[2]);
                        $("#diportionselect").val(dinein_data[3]);
                        $("#dibarcode").prop('disabled',true);
                        $("#dibarcode").val(dinein_data[8]);
                        
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#di_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#di_menu_rate").val(dinein_data[0]);   
                        }
                        //$("#di_menu_rate").val(dinein_data[9]);
                        $("#di_tax_value").val(dinein_data[10]);
                        $("#di_tax_amount").val(dinein_data[11]);
                        if(dinein_data[3]=='Portion'){
                        $('#diportionunitspan').css('display','block');
                        $('#diportionselectspan').css('display','block');
                        $('#dipacketloosespan').css('display','none');
                        $('#diweightspan').css('display','none');
                        $('#dikglitterspan').css('display','none');
                        $('#dibaseunitspan').css('display','none');
                        }
                        else if(dinein_data[3]=='Unit')
                        {    
                            
                            $('#diportionunitspan').css('display','block');
                            $('#dipacketloosespan').css('display','block');
                            $('#diportionselectspan').css('display','none');
                            $('#dikglitterspan').css('display','block');
                            $('#dipackloose').val(dinein_data[7]);
                            if(dinein_data[7]=='Packet'){
                                
                            $('#diweightspan').css('display','block');
                            $('#diweight').prop('disabled',true);
                            $('#diweight').val(dinein_data[6]);
                            $('#dikglitterspan').css('display','block');
                            $('#dikglit').val(dinein_data[5]);
                            $('#dibaseunitspan').css('display','none');
                            }
                            else if(dinein_data[7]=='Loose'){
                            $('#diportionselectspan').css('display','none');
                            $('#dibaseunitspan').css('display','block');
                            $('#dibaseunit').val(dinein_data[4]);
                            $('#diweightspan').css('display','none');
                            $('#dikglitterspan').css('display','none');
                        }
                        }
                      $("#update_dinein").css("display","block");
                        $("#submit_dinein").css("display","none");
                       $(".editrate").css("display","none");
                        $(".neditrate").css("display","inline-block");
                        $(".dineinselect").prop("disabled", true);
                             
                    });
                    
                $('.update_dinein').click( function() {  
                    
                    $("#update_dinein").css("display","none"); 
                    $("#submit_dinein").css("display","block");
                    $(".editrate").css("display","inline-block");
                    $(".neditrate").css("display","none");
                    $(".dineinselect").prop("disabled", false);
                    $("#diweight").prop("disabled", false);
                 });
        </script>    
        
        
 <table width="100%" border="0" cellspacing="5"  class="responstable" >   
 <thead>
 <tr>
 <th>Area</th>
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
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                   
				$floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
					$portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);
                                
                                        $menubase_unit_name='';
                                         if($result_cat_s['mmr_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mmr_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];
                    ?>
            <tr>
            <td><?=$floor_name['fr_floorname']?></td>
            <td><?=$result_cat_s['mmr_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mmr_unit_type']?></td>
              <td><?=$result_cat_s['mmr_unit_weight']?></td>
              <td><?=$menu_unit_name?></td>
              <td><?=$menubase_unit_name?></td>
               <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
                  <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                <td><?=$result_cat_s['mmr_barcode']?></td>
            
            <td> 
                <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?>" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>" id2="<?=$dinein_id?>" ><i class="glyphicon glyphicon-trash"></i></a>
          <a style="font-size: 15px;padding-left: 4px;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#"><i class="fa fa-edit"></i></a>
          <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
    </tr>
  <?php $k++;}} ?>
    
    </tbody>
   </table> 
        
<?php }
    
else if($_REQUEST['value']=="updinein"){
    
    
       $string='';
       
        $nut=$_REQUEST['portion'];
	$rate		= $_REQUEST['rate'];
        
	 $menuid=$_REQUEST['mid'];
         
         $area=$_REQUEST['floor'];
         
        if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mmr_portion='$nut'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mmr_unit_weight='".$_REQUEST['weight']."' and mmr_unit_id='".$_REQUEST['unit']."'";   
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
               $string.= " and  mmr_base_unit_id='".$menubase_unit."' ";
            }
         
        }
       
         
        
        $old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mmr_rate from tbl_menuratemaster where mmr_floorid='$area' and mmr_menuid='$menuid' $string "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mmr_rate'];

                          }			
                } 
        
        
        if($_REQUEST['di_tax_value']!='' && $_REQUEST['di_tax_value']>0){
     
             $query3=$database->mysqlQuery("update tbl_menuratemaster set mmr_menu_tax_amount='".$_REQUEST['di_tax_amount']."',"
                     . " mmr_menu_final_amount='".$_REQUEST['di_menu_rate']."',mmr_menu_tax_value='".$_REQUEST['di_tax_value']."', "
                     . " mmr_rate='$rate' where mmr_floorid='$area' and mmr_menuid='$menuid' $string ");     
     
        }else{
            
           $query3=$database->mysqlQuery("update tbl_menuratemaster set mmr_menu_tax_amount='0',mmr_menu_final_amount='".$_REQUEST['di_menu_rate']."',"
           . " mmr_menu_tax_value='0', mmr_rate='$rate' where mmr_floorid='$area' and mmr_menuid='$menuid' $string ");     
             
          
        }
         
        
        
        
        
         $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
         VALUES ('$date_log_in','".$_REQUEST['mid']."','Last rate : $old_rate (P:$nut) (F:$area)','".$_SESSION['expodine_id']."','Rate Update','DI')");

	 $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
         
	?>
        
	<script>
	document.getElementById("dineinportion").value = "1";
	
	$('#dineinportion').find('option:first').attr('selected', 'selected');
	document.getElementById("dineinrate").value = "";
	document.getElementById("dineinfloor").value = "";
        document.getElementById("diweight").value = "";
        document.getElementById("diweight").disabled = false;
        document.getElementById("dibarcode").value = "";
        document.getElementById("dibarcode").disabled = false;
	</script>
	<?php 


?>
        <script>
            
         $('.editrate').click( function() { 
            
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#dineinrate").val(dinein_data[0]);
                        $("#dineinfloor").val(dinein_data[1]);
                        $("#dineinportion").val(dinein_data[2]);
                        $("#diportionselect").val(dinein_data[3]);
                        $("#dibarcode").prop('disabled',true);
                        $("#dibarcode").val(dinein_data[8]);
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#di_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#di_menu_rate").val(dinein_data[0]);   
                        }
                       // $("#di_menu_rate").val(dinein_data[9]);
                        $("#di_tax_value").val(dinein_data[10]);
                        $("#di_tax_amount").val(dinein_data[11]);
                        
                        if(dinein_data[3]=='Portion'){
                        $('#diportionunitspan').css('display','block');
                        $('#diportionselectspan').css('display','block');
                        $('#dipacketloosespan').css('display','none');
                        $('#diweightspan').css('display','none');
                        $('#dikglitterspan').css('display','none');
                        $('#dibaseunitspan').css('display','none');
                        }
                        else if(dinein_data[3]=='Unit')
                        {    
                            
                            $('#diportionunitspan').css('display','block');
                            $('#dipacketloosespan').css('display','block');
                            $('#diportionselectspan').css('display','none');
                            $('#dikglitterspan').css('display','block');
                            $('#dipackloose').val(dinein_data[7]);
                            if(dinein_data[7]=='Packet'){
                                
                            $('#diweightspan').css('display','block');
                            $('#diweight').prop('disabled',true);
                            $('#diweight').val(dinein_data[6]);
                            $('#dikglitterspan').css('display','block');
                            $('#dikglit').val(dinein_data[5]);
                            $('#dibaseunitspan').css('display','none');
                            }
                            else if(dinein_data[7]=='Loose'){
                            $('#diportionselectspan').css('display','none');
                            $('#dibaseunitspan').css('display','block');
                            $('#dibaseunit').val(dinein_data[4]);
                            $('#diweightspan').css('display','none');
                            $('#dikglitterspan').css('display','none');
                        }
                        }
                        
                        $("#update_dinein").css("display","block");
                        $("#submit_dinein").css("display","none");
                        $(".editrate").css("display","none");
                        $(".neditrate").css("display","inline-block");
                        $(".dineinselect").prop("disabled", true);
                    });
                    
                $('.update_dinein').click( function() {     
                    
                   $("#update_dinein").css("display","none"); 
                   $("#submit_dinein").css("display","block");
                   $(".editrate").css("display","inline-block");
                   $(".neditrate").css("display","none");
                   $(".dineinselect").prop("disabled", false);
                   
                 });
        </script>    
        
        
 <table width="100%" border="0" cellspacing="5"  class="responstable" >   
 <thead>
 <tr>
 <th>Area</th>
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
            $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menuid."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                    if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
				$floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
					$portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);
                                        
                               $menubase_unit_name='';
                                         if($result_cat_s['mmr_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mmr_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];       
                                        
            ?>
         
            <tr>
            <td><?=$floor_name['fr_floorname']?></td>
            <td><?=$result_cat_s['mmr_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mmr_unit_type']?></td>
            <td><?=$result_cat_s['mmr_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
            <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
            <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td>
            <td><?=$result_cat_s['mmr_barcode']?></td>
            
     <td> 
     <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?>" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>" id2="<?=$dinein_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
     <a style="font-size: 15px;padding-left: 4px; display: inline-block ;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#"><i class="fa fa-edit"></i></a>
     <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
     </td>
    </tr>
    
  <?php $k++;}} ?>
    
    </tbody>
   </table> 
        
        
    <?php }
    
else if($_REQUEST['value']=="deldinein"){
    
    
        $string='';
      
	$menid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$flrid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['floor']);
	$portn= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);
        if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mmr_portion='".$_REQUEST['portion']."'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mmr_unit_weight='".$_REQUEST['weight']."' and mmr_unit_id='".$_REQUEST['unit']."'";   
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
               $string.= " and  mmr_base_unit_id='".$menubase_unit."' ";
            }
         
        }
        
        
        $old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mmr_rate from tbl_menuratemaster where mmr_floorid='$flrid' and mmr_menuid='$menid' $string "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mmr_rate'];

                          }			
                } 
        
        
        
        $sql_del  =  $database->mysqlQuery("select mmr_id from tbl_menuratemaster where mmr_menuid='".$menid."'  and mmr_floorid='".$flrid."' $string  "); 
               
                $num_del  = $database->mysqlNumRows($sql_del);
                if($num_del){
                  while($result_del  = $database->mysqlFetchArray($sql_del)) 
                          {
                   $date_del=date('Y-m-d H:i:s') ;    
            $sql_cat_s  =  $database->mysqlQuery("INSERT INTO tbl_menurate_delete_log(tmd_menuid, tmd_mmr_id,"
        . " tmd_mode, tmd_date_time, tmd_cloud_sync) VALUES ('".$menid."','".$result_del['mmr_id']."','DI','".$date_del."','N') "); 
                          }			
                } 
        
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menuratemaster where mmr_menuid='".$menid."'  and mmr_floorid='".$flrid."' $string  "); 
        
	$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menid."' and  mmr_floorid='".$flrid."' and mmr_default='Y'"); 
	$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if(!$num_cat_s){
		
            $database->mysqlQuery("UPDATE tbl_menuratemaster  SET mmr_default='Y' where mmr_menuid='".$menid."'  and  mmr_floorid='".$flrid."' LIMIT 1");
			
	}
        
        
        $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
        VALUES ('$date_log_in','".$_REQUEST['mid']."','(Old rate: $old_rate) (P:$portn) (F:$flrid) ','".$_SESSION['expodine_id']."','Rate Deleted','DI')");
        
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
	
	
 }
else if($_REQUEST['value']=="loadbranch"){
    
             
    $menuuid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menid']);
    ?>
        
    <table width="100%" border="0" cellspacing="5"  class="scroll">          
   <thead>
   <tr>
   <th>Area</th>
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
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menuuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                   
				$floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
				$portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);
                                $menubase_unit_name='';
                                         if($result_cat_s['mmr_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mmr_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];       
                                
?>
    <tr>
        <td><?=$floor_name['fr_floorname']?></td>
            <td><?=$result_cat_s['mmr_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$result_cat_s['mmr_unit_type']?></td>
            <td><?=$result_cat_s['mmr_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
            <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td>
             <td><?=$result_cat_s['mmr_barcode']?></td>
                 
          <!--  <td><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
            <td> 
                <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?>" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>" id2="<?=$dinein_id?>" ><i class="glyphicon glyphicon-trash"></i></a>
     <a style="font-size: 15px;padding-left: 4px; display: inline-block ;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>"><i class="fa fa-edit"></i></a>
           <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
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
    
    if($_REQUEST['di_tax_value']!='' && $_REQUEST['di_tax_value']>0){
        
        $tax=$_REQUEST['di_tax_value'];
        $tax_amount=$_REQUEST['di_tax_amount'];
        $final_rate=$_REQUEST['di_menu_rate'];
        
        
    }else{
        
        $tax=0;
        $tax_amount=0;
        $final_rate=$_REQUEST['di_menu_rate'];
    }
    
    
   
        
         $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','Rate : $rate ','".$_SESSION['expodine_id']."','Rate All','DI')");

			
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
    
    
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
    
         ?>
        <script>
         $('.editrate').click( function() { 
           
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#dineinrate").val(dinein_data[0]);
                        $("#dineinfloor").val(dinein_data[1]);
                        $("#dineinportion").val(dinein_data[2]);
                        $("#diportionselect").val(dinein_data[3]);
                        $("#dibarcode").prop('disabled',true);
                        $("#dibarcode").val(dinein_data[8]);
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#di_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#di_menu_rate").val(dinein_data[0]);   
                        }
                        //$("#di_menu_rate").val(dinein_data[9]);
                        $("#di_tax_value").val(dinein_data[10]);
                        $("#di_tax_amount").val(dinein_data[11]);
                        
                        if(dinein_data[3]=='Portion'){
                        $('#diportionunitspan').css('display','block');
                        $('#diportionselectspan').css('display','block');
                        $('#dipacketloosespan').css('display','none');
                        $('#diweightspan').css('display','none');
                        $('#dikglitterspan').css('display','none');
                        $('#dibaseunitspan').css('display','none');
                        }
                        else if(dinein_data[3]=='Unit')
                        {    
                            
                            $('#diportionunitspan').css('display','block');
                            $('#dipacketloosespan').css('display','block');
                            $('#diportionselectspan').css('display','none');
                            $('#dikglitterspan').css('display','block');
                            $('#dipackloose').val(dinein_data[7]);
                            if(dinein_data[7]=='Packet'){
                                
                            $('#diweightspan').css('display','block');
                            $('#diweight').prop('disabled',true);
                            $('#diweight').val(dinein_data[6]);
                            $('#dikglitterspan').css('display','block');
                            $('#dikglit').val(dinein_data[5]);
                            $('#dibaseunitspan').css('display','none');
                            }
                            else if(dinein_data[7]=='Loose'){
                            $('#diportionselectspan').css('display','none');
                            $('#dibaseunitspan').css('display','block');
                            $('#dibaseunit').val(dinein_data[4]);
                            $('#diweightspan').css('display','none');
                            $('#dikglitterspan').css('display','none');
                        }
                        }
                      $("#update_dinein").css("display","block");
                        $("#submit_dinein").css("display","none");
                       $(".editrate").css("display","none");
                        $(".neditrate").css("display","inline-block");
                        $(".dineinselect").prop("disabled", true);
                             
                    });
                    
                $('.update_dinein').click( function() {     
                    
                    $("#update_dinein").css("display","none"); 
                    $("#submit_dinein").css("display","block");
                    $(".editrate").css("display","inline-block");
                    $(".neditrate").css("display","none");
                    $(".dineinselect").prop("disabled", false);
                    $("#diweight").prop("disabled", false);
                 });
        </script> 
        
        <table width="100%" border="0" cellspacing="5"  class="responstable" >   
        <thead>
            <tr>
            <th>Area</th>
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
        <tbody>                                           
        <?php
           $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menuid."' "); 
           $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
           if($num_cat_s){$k=0;
                while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)){

                                   $floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
                                           $portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);

                                           $menubase_unit_name='';
                                            if($result_cat_s['mmr_base_unit_id']!=''){
                                            $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                           $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                           if($num_baseunit){
                                             $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                               $menubase_unit_name=$result_baseunit['bu_name'];

                                                     }			
                                               }
                                             $menu_unit_name='';  
                                           if($result_cat_s['mmr_unit_id']!=''){
                                           $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                           //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                           $num_unit  = $database->mysqlNumRows($sql_unit);
                                           if($num_unit){ 
                                             $result_unit  = $database->mysqlFetchArray($sql_unit); 

                                                           $menu_unit_name=$result_unit['u_name'];

                                                     }			
                                               } 
                                               $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];
                       ?>
               <tr>
                    <td><?=$floor_name['fr_floorname']?></td>
                    <td><?=$result_cat_s['mmr_rate_type']?></td>
                    <td><?=$portion_name['pm_portionname']?></td>
                    <td><?=$result_cat_s['mmr_unit_type']?></td>
                    <td><?=$result_cat_s['mmr_unit_weight']?></td>
                    <td><?=$menu_unit_name?></td>
                    <td><?=$menubase_unit_name?></td>
                    <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=$result_cat_s['mmr_barcode']?></td>

               <td> 
                   <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?>" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>" id2="<?=$dinein_id?>" ><i class="glyphicon glyphicon-trash"></i></a>
                   <a style="font-size: 15px;padding-left: 4px;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#"><i class="fa fa-edit"></i></a>
                   <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
               </td>
           </tr>
           <?php $k++;}} ?>
            <script>
                document.getElementById("dineinportion").value = "1";
                //$('#dineinportion').selectmenu('refresh', true);
                $('#dineinportion').find('option:first').attr('selected', 'selected');
                document.getElementById("dineinrate").value = "";
                document.getElementById("dineinfloor").value = "";
                document.getElementById("diweight").value = "";
                document.getElementById("dibarcode").value = "";
                document.getElementById("diweight").disabled = false;
                document.getElementById("dibarcode").disabled = false;
            </script>
        </tbody>
    </table> 
<?php
}

else if($_REQUEST['value']=="select_department"){
    $menuid=$_REQUEST['mid'];
?>
     <script>
         $('.editrate').click( function() { 
           
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#dineinrate").val(dinein_data[0]);
                        $("#dineinfloor").val(dinein_data[1]);
                        $("#dineinportion").val(dinein_data[2]);
                        $("#diportionselect").val(dinein_data[3]);
                        $("#dibarcode").prop('disabled',true);
                        $("#dibarcode").val(dinein_data[8]);
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#di_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#di_menu_rate").val(dinein_data[0]);   
                        }
                        //$("#di_menu_rate").val(dinein_data[9]);
                        $("#di_tax_value").val(dinein_data[10]);
                        $("#di_tax_amount").val(dinein_data[11]);
                        if(dinein_data[3]=='Portion'){
                        $('#diportionunitspan').css('display','block');
                        $('#diportionselectspan').css('display','block');
                        $('#dipacketloosespan').css('display','none');
                        $('#diweightspan').css('display','none');
                        $('#dikglitterspan').css('display','none');
                        $('#dibaseunitspan').css('display','none');
                        }
                        else if(dinein_data[3]=='Unit')
                        {    
                            
                            $('#diportionunitspan').css('display','block');
                            $('#dipacketloosespan').css('display','block');
                            $('#diportionselectspan').css('display','none');
                            $('#dikglitterspan').css('display','block');
                            $('#dipackloose').val(dinein_data[7]);
                            if(dinein_data[7]=='Packet'){
                                
                            $('#diweightspan').css('display','block');
                            $('#diweight').prop('disabled',true);
                            $('#diweight').val(dinein_data[6]);
                            $('#dikglitterspan').css('display','block');
                            $('#dikglit').val(dinein_data[5]);
                            $('#dibaseunitspan').css('display','none');
                            }
                            else if(dinein_data[7]=='Loose'){
                            $('#diportionselectspan').css('display','none');
                            $('#dibaseunitspan').css('display','block');
                            $('#dibaseunit').val(dinein_data[4]);
                            $('#diweightspan').css('display','none');
                            $('#dikglitterspan').css('display','none');
                        }
                        }
                      $("#update_dinein").css("display","block");
                        $("#submit_dinein").css("display","none");
                       $(".editrate").css("display","none");
                        $(".neditrate").css("display","inline-block");
                        $(".dineinselect").prop("disabled", true);
                             
                    });
                    
                $('.update_dinein').click( function() {     
                    
                    $("#update_dinein").css("display","none"); 
                    $("#submit_dinein").css("display","block");
                    $(".editrate").css("display","inline-block");
                    $(".neditrate").css("display","none");
                    $(".dineinselect").prop("disabled", false);
                    $("#diweight").prop("disabled", false);
                 });
        </script> 
        <table width="100%" border="0" cellspacing="5"  class="responstable" >   
        <thead>
            <tr>
            <th>Area</th>
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
        <tbody>                                           
        <?php
           $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$menuid."' "); 
           $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
           if($num_cat_s){$k=0;
                while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)){

                                   $floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
                                           $portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);

                                           $menubase_unit_name='';
                                            if($result_cat_s['mmr_base_unit_id']!=''){
                                            $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                           $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                           if($num_baseunit){
                                             $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                               $menubase_unit_name=$result_baseunit['bu_name'];

                                                     }			
                                               }
                                             $menu_unit_name='';  
                                           if($result_cat_s['mmr_unit_id']!=''){
                                           $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                           //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                           $num_unit  = $database->mysqlNumRows($sql_unit);
                                           if($num_unit){ 
                                             $result_unit  = $database->mysqlFetchArray($sql_unit); 

                                                           $menu_unit_name=$result_unit['u_name'];

                                                     }			
                                               } 
                                               $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];
                       ?>
               <tr>
                    <td><?=$floor_name['fr_floorname']?></td>
                    <td><?=$result_cat_s['mmr_rate_type']?></td>
                    <td><?=$portion_name['pm_portionname']?></td>
                    <td><?=$result_cat_s['mmr_unit_type']?></td>
                    <td><?=$result_cat_s['mmr_unit_weight']?></td>
                    <td><?=$menu_unit_name?></td>
                    <td><?=$menubase_unit_name?></td>
                    <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                     <td><?=$result_cat_s['mmr_barcode']?></td>

               <td> 
                   <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?>" nid="b_<?=$result_cat_s['mmr_portion']?>" fid="f_<?=$result_cat_s['mmr_floorid']?>" id2="<?=$dinein_id?>" ><i class="glyphicon glyphicon-trash"></i></a>
                   <a style="font-size: 15px;padding-left: 4px;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#"><i class="fa fa-edit"></i></a>
                   <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
               </td>
           </tr>
           
           <?php $k++;}} ?>
            <script>
                
                
                document.getElementById("dineinportion").value = "";
               
                $('#dineinportion').find('option:first').attr('selected', 'selected');
                document.getElementById("dineinrate").value = "";
                document.getElementById("dineinfloor").value = "";
                document.getElementById("diweight").value = "";
                document.getElementById("dibarcode").value = "";
                document.getElementById("diweight").disabled = false;
                document.getElementById("dibarcode").disabled = false;
            </script>
        </tbody>
    </table>   
        
<?php  }  ?>
     
     
    