 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	$(".tab_edt_btn10").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
                        var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        var por=$(this).attr('poid');
                       var por1=por.split('_');
                        var  menuid1 =$("#takeawayvalue").val();
                        var portion=por1[1];
                        
            
                   
		 $.ajax({
			type: "POST",
			url: "load_divtakeawayrate.php",
			data: "value=deltakeaway&mid="+menuid1+"&portion="+portion+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[2]+"&packloose="+dinein_data[6]+"&unit="+dinein_data[4]+"&baseunit="+dinein_data[3]+"&weight="+dinein_data[5]+"&barcode="+dinein_data[7]+"&food="+dinein_data[8],
			success: function(msg)
			{
				$.ajax({
                                type: "POST",
                                url: "load_divtakeawayrate.php",
                                data: "value=loadbranch&menid="+menuid1,
                                success: function(msg)
                                {
                                        $('#takeawayratetab').html(msg);
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


if($_REQUEST['value']=="addtakeaway"){
    
    
    
        $menu_baseunit_id='';
	$nut=$_REQUEST['portion'];
	$rate		= $_REQUEST['rate'];
        
        $food=$_REQUEST['food'];  
        
        $menuid=$_REQUEST['mid'];
         
        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_name='".$_REQUEST['baseunit']."'"); 
        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
        if($num_baseunit){
          while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
	  {
		$menu_baseunit_id=$result_baseunit['bu_id'];
                          
	  }
        }
        $insertion['mta_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$insertion['mta_rate_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ratetype']);
        $insertion['mta_barcode'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['barcode']);
         $insertion['mta_food_partner'] 		=  mysqli_real_escape_string($database->DatabaseLink,$food);
        if($_REQUEST['ratetype']=='Portion')
        {
         $insertion['mta_portion'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);   
        }
        if($_REQUEST['ratetype']=='Unit')
        {
         $insertion['mta_unit_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['packloose']);   
         if($_REQUEST['packloose']=='Packet')
        {
         $insertion['mta_unit_weight'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['weight']);   
         $insertion['mta_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unit']);
        }
        if($_REQUEST['packloose']=='Loose')
        {
         $insertion['mta_base_unit_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$menu_baseunit_id);   
         
        }
         
        }
        
        
        
        if($_REQUEST['ta_tax_amount']!=''){
        $insertion['mta_menu_tax_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ta_tax_amount']);
        }
        
         if($_REQUEST['ta_tax_value']!=''){
        $insertion['mta_menu_tax_value'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ta_tax_value']);
        }
        
        $insertion['mta_menu_final_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ta_menu_rate']);
        
        
        
        
        $branch=$_SESSION['branchofid'];
        
	$insertion['mta_branchid']=mysqli_real_escape_string($database->DatabaseLink,$branch);
        
	$sql=$database->check_duplicate_entry('tbl_menuratetakeaway',$insertion);
	 if($sql!=1)
	{
            $insertion['mta_rate'] 	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['rate']);	
            if($_REQUEST['ratetype']=='Unit'){
                if($_REQUEST['packloose']=='Loose')
                {
                
                $sql_baseunit_check  =  $database->mysqlQuery("select mta_base_unit_id from tbl_menuratetakeaway where mta_base_unit_id='".$menu_baseunit_id."' and mta_menuid='".$menuid."'  and mta_food_partner='".$food."'  and mta_unit_type = 'Loose' "); 
                $num_baseunit_check  = $database->mysqlNumRows($sql_baseunit_check);
                
                if(!$num_baseunit_check){
                 $insertid =  $database->insert('tbl_menuratetakeaway',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                       <script type="text/javascript">
			  var takeawayratestatus=$('#ratestatus');
			  takeawayratestatus.text('Already exists');
			 </script>  
                         
                    <?php
                    }
                }
                else if($_REQUEST['packloose']=='Packet')
                {
                
                $sql_unit_check  =  $database->mysqlQuery("select mta_unit_id from tbl_menuratetakeaway where mta_unit_id='".$_REQUEST['unit']."' and mta_menuid='".$menuid."' and mta_food_partner='".$food."'  and mta_unit_weight='".$_REQUEST['weight']."' "); 
                $num_unit_check  = $database->mysqlNumRows($sql_unit_check);
               
                if(!$num_unit_check){
                 $insertid =  $database->insert('tbl_menuratetakeaway',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                        <script type="text/javascript">
			  var takeawayratestatus=$('#ratestatus');
			  takeawayratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                } 
        }
                else if($_REQUEST['ratetype']=='Portion')
                {
               
                $sql_portion_check  =  $database->mysqlQuery("select mta_portion from tbl_menuratetakeaway where mta_portion='".$nut."' and mta_menuid='".$menuid."' and mta_food_partner='".$food."'  and mta_rate_type='Portion' "); 
                $num_portion_check  = $database->mysqlNumRows($sql_portion_check);
                //echo "select mmr_portion from tbl_menuratemaster where mmr_portion='".$nut."' and mmr_menuid='".$menuid."' and mmr_floorid='".$area."' and mmr_rate_type='Portion'";
                if(!$num_portion_check){
                 $insertid =  $database->insert('tbl_menuratetakeaway',$insertion);
                }
               
                else
                {
                    
		?>
		       <span id="ratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
                <script type="text/javascript">
			  var takeawayratestatus=$('#ratestatus');
			  takeawayratestatus.text('Already exists');
			 </script>  
                      <?php
                    }
                }
        
        
            $date_log_in=date('Y-m-d H:i:s');
            $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','(Rate:$rate) (P:$nut) (OL:$food)','".$_SESSION['expodine_id']."','Rate Added','TA-HD')");  
                
            $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
            
            
            
            
            
        if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){
          
          $name='';   $cat=''; $partner_urb='';
          
          $sql_login  =  $database->mysqlQuery("select mr_menuid,mr_menuname,mr_maincatid,mr_diet from tbl_menumaster where mr_menuid='$menuid' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_login);
            if($num_cat_s){
            while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
             {

                     $name=$result_cat_s['mr_menuname'];
                     $cat=$result_cat_s['mr_maincatid'];
                     
                     
                if($result_cat_s['mr_diet']=='Veg'){
                     $diet='1';
                }else if($result_cat_s['mr_diet']=='Non Veg'){
                     $diet='2'; 
                }else{
                     $diet='4';
                }
                     
            }
            }
            
            $sql_login2  =  $database->mysqlQuery("select tol_urban_name from tbl_online_order where tol_id='$food' "); 
            $num_cat_s2  = $database->mysqlNumRows($sql_login2);
            if($num_cat_s2){
            while($result_cat_s2  = $database->mysqlFetchArray($sql_login2)) 
             {

                     $partner_urb=$result_cat_s2['tol_urban_name'];
                    
            }
            }

        if($partner_urb!='Takeaway'){
   
        $row2=array();
         
        $date=date('Y-m-d H:i:s');
         
        $newname=$_SESSION['be_store_id'].'_'.$menuid.".png";
        
        $prt='"zomato","swiggy"';
         
        $dl='"delivery"';
         
        $loc='https://www.expodinereports.com/urban_piper/images/items_'.$_SESSION['be_store_id'].'/'.$newname;
        
        $localhost=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);   
        
        $sql_gen5 =  mysqli_query($localhost,"select tm_ref_id from tbl_item where  tm_ref_id='$menuid' "); 
      
	$num_gen  = mysqli_num_rows($sql_gen5);
	if($num_gen)
	{
        
        $log_data_print=mysqli_query($localhost,"update  tbl_item set  tm_item='$name', tm_ref_id='$menuid',"
        . " `tm_available`='true', `tm_ref_title`='$name', "
        . " `tm_desc`='".strtolower($name)."_', `tm_sold_store`='true', `tm_markup_price`='$rate', "
        . " `tm_price`='$rate', `tm_weight`='0', `tm_stock`='-1',"
        . " `tm_recommend`='true', `tm_food_type`='$diet', "
        . " `tm_category`='$cat',`tm_fulfillment`='$dl',`tm_image_url`='".$loc."',"
        . " `tm_platforms`='$prt',`tm_view`='Y' where tm_ref_id='$menuid' ");
            
            
        }else{
                  
            $log_data_print=mysqli_query($localhost,"INSERT INTO `tbl_item`(`tm_store`, `tm_item`, `tm_ref_id`, `tm_available`, `tm_ref_title`, "
             . " `tm_desc`, `tm_sold_store`, `tm_markup_price`, `tm_price`, `tm_weight`, `tm_stock`, `tm_recommend`, `tm_food_type`, "
             . " `tm_category`,`tm_fulfillment`,`tm_image_url`,`tm_platforms`,`tm_date`,`tm_sort`,`tm_view`,tm_status_item)"
             
           . " VALUES ('".$_SESSION['be_store_id']."','$name','$menuid','true',"
           . " '$name','".strtolower($name)."_','true','$rate','$rate',"
           . " '0','-1','true','$diet' ,'$cat','$dl','".$loc."','$prt','".$date."',(SELECT COALESCE(MAX(t2.tm_sort), 0) + 1 
               FROM tbl_item t2),'Y','disable' )");     
     
           
        $menu='"'.$menuid.'"';
                
        $log_data_print8=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='CGST'  ");
             
        $log_data_print9=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='SGST'  ");
        
        }
        
        }
            
        }    
            
        ?>

    <script>
	document.getElementById("takeawayportion").value = "1";
	$('#takeawayportion').find('option:first').attr('selected', 'selected');
	document.getElementById("takeawayrate").value = "";
        document.getElementById("taweight").value = "";
        document.getElementById("tabarcode").value = "";
        document.getElementById("takglit").value = "1";
    </script>
   <?php  }else{ ?>
    
	     <span id="takeawayratestatus" style="color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var takeawayratestatus=$('#takeawayratestatus');
			  takeawayratestatus.text('Already exists');
			 </script>  
         <?php
	 }
?>
  <script>  
      
    $('.takeeditrate').click( function() { 
        
        
                 	var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#takeawayrate").val(dinein_data[0]);
                        $("#takeawayportion").val(dinein_data[1]);
                        $("#taportionselect").val(dinein_data[2]);
                      
                        $("#tabarcode").val(dinein_data[7]);
                         $("#ta_food").prop('disabled',true);
                         $("#ta_food").val(dinein_data[8]);
                         
                         if(dinein_data[10]!='' && parseInt(dinein_data[10])>0){
                           $("#ta_menu_rate").val(dinein_data[10]);
                        }else{ 
                           $("#ta_menu_rate").val(dinein_data[0]);   
                        }
                        
                          
                           $("#ta_tax_value").val(dinein_data[11]);
                            $("#ta_tax_amount").val(dinein_data[9]);
                        if(dinein_data[2]=='Portion'){
                        $('#taportionunitspan').css('display','block');
                        $('#taportionselectspan').css('display','block');
                        $('#tapacketloosespan').css('display','none');
                        $('#taweightspan').css('display','none');
                        $('#takglitterspan').css('display','none');
                        $('#tabaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#taportionunitspan').css('display','block');
                            $('#tapacketloosespan').css('display','block');
                            $('#taportionselectspan').css('display','none');
                            $('#takglitterspan').css('display','block');
                            $('#tapackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#taweightspan').css('display','block');
                            $('#taweight').prop('disabled',true);
                            $('#taweight').val(dinein_data[5]);
                            $('#takglitterspan').css('display','block');
                            $('#takglit').val(dinein_data[4]);
                            $('#tabaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#taportionselectspan').css('display','none');
                            $('#tabaseunitspan').css('display','block');
                            $('#tabaseunit').val(dinein_data[3]);
                            $('#taweightspan').css('display','none');
                            $('#takglitterspan').css('display','none');
                        }
                        }
                        $("#utakeaway").css("display","block");
                        $("#takeaway").css("display","none");
                        $(".takeeditrate").css("display","none");
                        $(".ntakeeditrate").css("display","inline-block");
                        $(".takeselect").prop("disabled", true);
                    });
                    
                  $('.utakeaway').click( function() {     
                  $("#utakeaway").css("display","none"); 
                  $("#takeaway").css("display","block");
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none");
                   $(".takeselect").prop("disabled", false);
                 });                      
    </script>                         
                         
 <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
    <th>Rate Type</th>
    <th><?=$_SESSION['s_portionname']?></th>
     <th>Online</th>
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
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                                
				$portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                                $menubase_unit_name='';
                                         if($result_cat_s['mta_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mta_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];
$online_order_name_display='';
            $sql_cat_s_onl  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_cat_s['mta_food_partner']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s_onl);
                if($num_cat_s){
		while($result_cat_s_onl  = $database->mysqlFetchArray($sql_cat_s_onl)) 
		{
                    $online_order_name_display=$result_cat_s_onl['tol_name'];
                    
                }
                }
                                ?>
    <tr>    
            <td><?=$result_cat_s['mta_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
            <td><?=$online_order_name_display?></td>
            <td><?=$result_cat_s['mta_unit_type']?></td>
            <td><?=$result_cat_s['mta_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
             <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
              <td><?=$result_cat_s['mta_barcode']?></td>
            <td> 
                <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" id2="<?=$takeaway_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
             <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                 <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }
    
else if($_REQUEST['value']=="uptakeaway"){
    
    
       $string='';
       $nut=$_REQUEST['portion'];
       $rate	= $_REQUEST['rate'];
       $menuid=$_REQUEST['mid'];
       if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mta_portion='$nut'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mta_unit_weight='".$_REQUEST['weight']."' and mta_unit_id='".$_REQUEST['unit']."'";   
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
               $string.= " and  mta_base_unit_id='".$menubase_unit."' ";
            }
         
        }
       
$old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mta_rate from tbl_menuratetakeaway where mta_menuid='$menuid' and mta_food_partner='".$_REQUEST['food']."'  $string  "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mta_rate'];

                          }			
                } 
		

 if($_REQUEST['ta_tax_value']!='' && $_REQUEST['ta_tax_value']>0){
     
     
      $query3=$database->mysqlQuery("update tbl_menuratetakeaway set mta_menu_tax_value='".$_REQUEST['ta_tax_value']."',mta_barcode='".$_REQUEST['barcode']."',mta_menu_final_amount='".$_REQUEST['ta_menu_rate']."',mta_menu_tax_amount='".$_REQUEST['ta_tax_amount']."',mta_rate='$rate' where mta_menuid='$menuid' and mta_food_partner='".$_REQUEST['food']."'  $string ");
    
      
        }else{
             
             
          $query3=$database->mysqlQuery("update tbl_menuratetakeaway set mta_menu_tax_value='0',mta_barcode='".$_REQUEST['barcode']."',mta_menu_final_amount='".$_REQUEST['ta_menu_rate']."',mta_menu_tax_amount='0',mta_rate='$rate' where mta_menuid='$menuid' and mta_food_partner='".$_REQUEST['food']."'  $string ");
        }

        $food=$_REQUEST['food'];
        $date_log_in=date('Y-m-d H:i:s');
        
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
        VALUES ('$date_log_in','".$menuid."','(Old Rate:$old_rate) (P:$nut) (OL:$food)','".$_SESSION['expodine_id']."','Rate Updated','TA-HD')");  
        
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
       
       
       
        if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){
          
          $name='';   $cat=''; $partner_urb='';
          $sql_login  =  $database->mysqlQuery("select mr_menuid,mr_menuname,mr_diet,mr_maincatid from tbl_menumaster where mr_menuid='$menuid' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_login);
            if($num_cat_s){
            while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
                    {

                     $name=$result_cat_s['mr_menuname'];
                     $cat=$result_cat_s['mr_maincatid'];
                     
                     if($result_cat_s['mr_diet']=='Veg'){
                     $diet='1';
                }else if($result_cat_s['mr_diet']=='Non Veg'){
                     $diet='2'; 
                }else{
                     $diet='4';
                }
                     
            }
            }  

            $sql_login2  =  $database->mysqlQuery("select tol_urban_name from tbl_online_order where tol_id='$food' "); 
            $num_cat_s2  = $database->mysqlNumRows($sql_login2);
            if($num_cat_s2){
            while($result_cat_s2  = $database->mysqlFetchArray($sql_login2)) 
             {

                     $partner_urb=$result_cat_s2['tol_urban_name'];
                    
            }
            }

        if($partner_urb!='Takeaway'){
            
   
         $row2=array();
         
         $date=date('Y-m-d H:i:s');
         
         $newname=$_SESSION['be_store_id'].'_'.$menuid.".png";
        
         $prt='"zomato","swiggy"';
         
         $dl='"delivery"';
         
        $loc='https://www.expodinereports.com/urban_piper/images/items_'.$_SESSION['be_store_id'].'/'.$newname;
        
        $localhost=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);   
        
        $sql_gen5 =  mysqli_query($localhost,"select tm_ref_id from tbl_item where  tm_ref_id='$menuid' "); 
      
	$num_gen  = mysqli_num_rows($sql_gen5);
	if($num_gen)
	{
        
        $log_data_print=mysqli_query($localhost,"update  tbl_item set  tm_item='$name', tm_ref_id='$menuid',"
        . " `tm_available`='true', `tm_ref_title`='$name', "
        . " `tm_desc`='".strtolower($name)."_', `tm_sold_store`='true', `tm_markup_price`='$rate', "
        . " `tm_price`='$rate', `tm_weight`='0', `tm_stock`='-1',"
        . " `tm_recommend`='true', `tm_food_type`='$diet', "
        . " `tm_category`='$cat',`tm_fulfillment`='$dl',`tm_image_url`='".$loc."',"
        . " `tm_platforms`='$prt',`tm_view`='Y' where tm_ref_id='$menuid' ");
            
        
       
        }else{
                  
            $log_data_print=mysqli_query($localhost,"INSERT INTO `tbl_item`(`tm_store`, `tm_item`, `tm_ref_id`, `tm_available`, `tm_ref_title`, "
             . " `tm_desc`, `tm_sold_store`, `tm_markup_price`, `tm_price`, `tm_weight`, `tm_stock`, `tm_recommend`, `tm_food_type`, "
             . " `tm_category`,`tm_fulfillment`,`tm_image_url`,`tm_platforms`,`tm_date`,`tm_sort`,`tm_view`,tm_status_item)"
             
           . " VALUES ('".$_SESSION['be_store_id']."','$name','$menuid','true',"
           . " '$name','".strtolower($name)."_','true','$rate','$rate',"
           . " '0','-1','true','$diet' ,'$cat','$dl','".$loc."','$prt','".$date."',(SELECT COALESCE(MAX(t2.tm_sort), 0) + 1 
               FROM tbl_item t2),'Y','disable' )");     
     
           
        $menu='"'.$menuid.'"';
                
        $log_data_print8=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='CGST'  ");
             
        $log_data_print9=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='SGST'  ");
        
        }
            
        }  
        
        }
       
       
	?>
	<script>
	document.getElementById("takeawayportion").value = "1";
	$('#takeawayportion').find('option:first').attr('selected', 'selected');
	document.getElementById("takeawayrate").value = "";
        document.getElementById("taweight").value = "";
        document.getElementById("taweight").disabled = false;
        document.getElementById("tabarcode").value = "";
       // document.getElementById("tabarcode").disabled = false;
        document.getElementById("takglit").disabled = false;
        document.getElementById("takglit").value = '1';
	</script>
	<?php 
?>
        <script>
            
        $('.takeeditrate').click( function() {  
            
            
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#takeawayrate").val(dinein_data[0]);
                        $("#takeawayportion").val(dinein_data[1]);
                        $("#taportionselect").val(dinein_data[2]);
                        
                         $("#tabarcode").val(dinein_data[7]);
                         $("#ta_food").prop('disabled',true);
                         $("#ta_food").val(dinein_data[8]);
                         
                         if(dinein_data[10]!='' && parseInt(dinein_data[10])>0){
                        $("#ta_menu_rate").val(dinein_data[10]);
                        }else{ 
                         $("#ta_menu_rate").val(dinein_data[0]);   
                        }
                         
                           $("#ta_tax_value").val(dinein_data[11]);
                           $("#ta_tax_amount").val(dinein_data[9]);
                        if(dinein_data[2]=='Portion'){
                        $('#taportionunitspan').css('display','block');
                        $('#taportionselectspan').css('display','block');
                        $('#tapacketloosespan').css('display','none');
                        $('#taweightspan').css('display','none');
                        $('#takglitterspan').css('display','none');
                        $('#tabaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#taportionunitspan').css('display','block');
                            $('#tapacketloosespan').css('display','block');
                            $('#taportionselectspan').css('display','none');
                            $('#takglitterspan').css('display','block');
                            $('#tapackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#taweightspan').css('display','block');
                            $('#taweight').prop('disabled',true);
                            $('#taweight').val(dinein_data[5]);
                            $('#takglitterspan').css('display','block');
                            $('#takglit').val(dinein_data[4]);
                            $('#tabaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#taportionselectspan').css('display','none');
                            $('#tabaseunitspan').css('display','block');
                            $('#tabaseunit').val(dinein_data[3]);
                            $('#taweightspan').css('display','none');
                            $('#takglitterspan').css('display','none');
                        }
                        }
                        $("#utakeaway").css("display","block");
                        $("#takeaway").css("display","none");
                        $(".takeeditrate").css("display","none");
                        $(".ntakeeditrate").css("display","inline-block");
                        $(".takeselect").prop("disabled", true);
                    });
                    
                $('.utakeaway').click( function() {     
                  $("#utakeaway").css("display","none"); 
                  $("#takeaway").css("display","block");
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none");
                   $(".takeselect").prop("disabled", false);
                 });
        </script> 
      <table width="100%" border="0" cellspacing="5"  class="scroll" >   
 <thead>
 <tr>
     <th>Rate Type</th>
    <th><?=$_SESSION['s_portionname']?></th>
    <th>Online</th>
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
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$menuid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                            $portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                            $menubase_unit_name='';
                                         if($result_cat_s['mta_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mta_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];
$online_order_name_display='';
            $sql_cat_s_onl  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_cat_s['mta_food_partner']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s_onl);
                if($num_cat_s){
		while($result_cat_s_onl  = $database->mysqlFetchArray($sql_cat_s_onl)) 
		{
                    $online_order_name_display=$result_cat_s_onl['tol_name'];
                    
                }
                }
?>
    <tr>    
            <td><?=$result_cat_s['mta_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
             <td><?=$online_order_name_display?></td>
            <td><?=$result_cat_s['mta_unit_type']?></td>
            <td><?=$result_cat_s['mta_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
             <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
             <td><?=$result_cat_s['mta_barcode']?></td>
            <td> 
                <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" id2="<?=$takeaway_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
          <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                 <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
    </td>
    </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php  
     }  
    
else if($_REQUEST['value']=="deltakeaway"){ 
    
   
	$mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$portid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['portion']);
        $string='';
        if($_REQUEST['ratetype']=='Portion')
        {
         $string.= " and mta_portion='$portid'";
        }
        if($_REQUEST['ratetype']=='Unit')
        {
            if($_REQUEST['packloose']=='Packet')
            {
             $string.= " and mta_unit_weight='".$_REQUEST['weight']."' and mta_unit_id='".$_REQUEST['unit']."'";   
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
               $string.= " and  mta_base_unit_id='".$menubase_unit."' ";
            }
         
        }
        
        
        $old_rate=0;
        $sql_b  =  $database->mysqlQuery("select mta_rate from tbl_menuratetakeaway where mta_menuid='$mid' and mta_food_partner='".$_REQUEST['food']."'  $string  "); 
                $num_b  = $database->mysqlNumRows($sql_b);
                if($num_b){
                  while($result_b  = $database->mysqlFetchArray($sql_b)) 
                          {
                                          $old_rate=$result_b['mta_rate'];

                          }			
                } 
        
        
        
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menuratetakeaway where mta_food_partner='".$_REQUEST['food']."' and  mta_menuid='".$mid."' $string  "); 
	 
       
         $food=$_REQUEST['food'];
         $date_log_in=date('Y-m-d H:i:s');
         $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
         VALUES ('$date_log_in','$mid','(Old Rate:$old_rate) (P:$portid) (OL:$food)','".$_SESSION['expodine_id']."','Rate Deleted','TA-HD')");  
        
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
      <th>Online</th>
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
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
			$portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                        $menubase_unit_name='';
                                         if($result_cat_s['mta_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mta_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];

                          $online_order_name_display='';
            $sql_cat_s_onl  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_cat_s['mta_food_partner']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s_onl);
                if($num_cat_s){
		while($result_cat_s_onl  = $database->mysqlFetchArray($sql_cat_s_onl)) 
		{
                    $online_order_name_display=$result_cat_s_onl['tol_name'];
                    
                }
                }                  
                                            ?>
    <tr>
            <td><?=$result_cat_s['mta_rate_type']?></td>
            <td><?=$portion_name['pm_portionname']?></td>
              <td><?=$online_order_name_display?></td>
            <td><?=$result_cat_s['mta_unit_type']?></td>
            <td><?=$result_cat_s['mta_unit_weight']?></td>
            <td><?=$menu_unit_name?></td>
            <td><?=$menubase_unit_name?></td>
            <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
             <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
             <td><?=$result_cat_s['mta_barcode']?></td>
            <td> 
                <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" bid="br_<?=$result_cat_s['mta_branchid']?>" id2="<?=$takeaway_id?>"   ><i class="glyphicon glyphicon-trash"></i></a>
          <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                 <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
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
    
    if($_REQUEST['food']!=''){
    $food= $_REQUEST['food'];
    }else{
     $food='';   
    }
    
    
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
    
    
    if($_REQUEST['ta_tax_value']!='' && $_REQUEST['ta_tax_value']>0){
        
        $tax=$_REQUEST['ta_tax_value'];
        $tax_amount=$_REQUEST['ta_tax_amount'];
        $final_rate=$_REQUEST['ta_menu_rate'];
        
        
    }else{
        
        $tax=0;
        $tax_amount=0;
        $final_rate=$_REQUEST['ta_menu_rate'];
    }
    
    
    $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$menuid."','Rate : $rate ','".$_SESSION['expodine_id']."','Rate All','TA-HD')");
    
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
        
        
        if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){
          
          $name='';   $cat='';
          $sql_login  =  $database->mysqlQuery("select mr_menuid,mr_menuname,mr_maincatid,mr_diet from tbl_menumaster where mr_menuid='$menuid' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_login);
            if($num_cat_s){
            while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
                    {

                     $name=$result_cat_s['mr_menuname'];
                     $cat=$result_cat_s['mr_maincatid'];
                     
                     if($result_cat_s['mr_diet']=='Veg'){
                     $diet='1';
                }else if($result_cat_s['mr_diet']=='Non Veg'){
                     $diet='2'; 
                }else{
                     $diet='4';
                }
            }
            }  

   
         $row2=array();
         
         $date=date('Y-m-d H:i:s');
         
         $newname=$_SESSION['be_store_id'].'_'.$menuid.".png";
        
         $prt='"zomato","swiggy"';
         
         $dl='"delivery"';
         
        $loc='https://www.expodinereports.com/urban_piper/images/items_'.$_SESSION['be_store_id'].'/'.$newname;
        
        $localhost=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_URBAN);   
        
        $sql_gen5 =  mysqli_query($localhost,"select tm_ref_id from tbl_item where  tm_ref_id='$menuid' "); 
      
	$num_gen  = mysqli_num_rows($sql_gen5);
	if($num_gen)
	{
        
        $log_data_print=mysqli_query($localhost,"update  tbl_item set  tm_item='$name', tm_ref_id='$menuid',"
        . " `tm_available`='true', `tm_ref_title`='$name', "
        . " `tm_desc`='".strtolower($name)."_', `tm_sold_store`='true', `tm_markup_price`='$rate', "
        . " `tm_price`='$rate', `tm_weight`='0', `tm_stock`='-1',"
        . " `tm_recommend`='true', `tm_food_type`='$diet', "
        . " `tm_category`='$cat',`tm_fulfillment`='$dl',`tm_image_url`='".$loc."',"
        . " `tm_platforms`='$prt',`tm_view`='Y' where tm_ref_id='$menuid' ");
            
        
      
        }else{
                  
            $log_data_print=mysqli_query($localhost,"INSERT INTO `tbl_item`(`tm_store`, `tm_item`, `tm_ref_id`, `tm_available`, `tm_ref_title`, "
             . " `tm_desc`, `tm_sold_store`, `tm_markup_price`, `tm_price`, `tm_weight`, `tm_stock`, `tm_recommend`, `tm_food_type`, "
             . " `tm_category`,`tm_fulfillment`,`tm_image_url`,`tm_platforms`,`tm_date`,`tm_sort`,`tm_view`,tm_status_item)"
             
           . " VALUES ('".$_SESSION['be_store_id']."','$name','$menuid','true',"
           . " '$name','".strtolower($name)."_','true','$rate','$rate',"
           . " '0','-1','true','$diet' ,'$cat','$dl','".$loc."','$prt','".$date."',(SELECT COALESCE(MAX(t2.tm_sort), 0) + 1 
               FROM tbl_item t2),'Y','disable' )");     
     
           
        $menu='"'.$menuid.'"';
                
        $log_data_print8=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='CGST'  ");
             
        $log_data_print9=mysqli_query($localhost,"update tbl_tax set tx_item_ref= CONCAT_WS(',',tx_item_ref,'$menu')"
        . " where tx_title='SGST'  ");
        
        }
            
        }   

        
         ?>
        <script>
        $('.takeeditrate').click( function() {  
            
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#takeawayrate").val(dinein_data[0]);
                        $("#takeawayportion").val(dinein_data[1]);
                        $("#taportionselect").val(dinein_data[2]);
                       // $("#tabarcode").prop('disabled',true);
                        $("#tabarcode").val(dinein_data[7]);
                         $("#ta_food").prop('disabled',true);
                         $("#ta_food").val(dinein_data[8]);
                         
                         if(dinein_data[10]!='' && parseInt(dinein_data[10])>0){
                        $("#ta_menu_rate").val(dinein_data[10]);
                        }else{ 
                         $("#ta_menu_rate").val(dinein_data[0]);   
                        }
                         // $("#ta_menu_rate").val(dinein_data[10]);
                           $("#ta_tax_value").val(dinein_data[11]);
                            $("#ta_tax_amount").val(dinein_data[9]);
                        if(dinein_data[2]=='Portion'){
                        $('#taportionunitspan').css('display','block');
                        $('#taportionselectspan').css('display','block');
                        $('#tapacketloosespan').css('display','none');
                        $('#taweightspan').css('display','none');
                        $('#takglitterspan').css('display','none');
                        $('#tabaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#taportionunitspan').css('display','block');
                            $('#tapacketloosespan').css('display','block');
                            $('#taportionselectspan').css('display','none');
                            $('#takglitterspan').css('display','block');
                            $('#tapackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#taweightspan').css('display','block');
                            $('#taweight').prop('disabled',true);
                            $('#taweight').val(dinein_data[5]);
                            $('#takglitterspan').css('display','block');
                            $('#takglit').val(dinein_data[4]);
                            $('#tabaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#taportionselectspan').css('display','none');
                            $('#tabaseunitspan').css('display','block');
                            $('#tabaseunit').val(dinein_data[3]);
                            $('#taweightspan').css('display','none');
                            $('#takglitterspan').css('display','none');
                        }
                        }
                        $("#utakeaway").css("display","block");
                        $("#takeaway").css("display","none");
                        $(".takeeditrate").css("display","none");
                        $(".ntakeeditrate").css("display","inline-block");
                        $(".takeselect").prop("disabled", true);
                    });
                    
                $('.utakeaway').click( function() {     
                  $("#utakeaway").css("display","none"); 
                  $("#takeaway").css("display","block");
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none");
                   $(".takeselect").prop("disabled", false);
                 });
        </script> 
        <table width="100%" border="0" cellspacing="5"  class="scroll" >   
        <thead>
            <tr>
                <th>Rate Type</th>
                <th><?=$_SESSION['s_portionname']?></th>
                <th>Online</th>
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
            $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$menuid."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
		{
                                
                    $portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                    $menubase_unit_name='';
                    if($result_cat_s['mta_base_unit_id']!=''){
                        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                        if($num_baseunit){
                            $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                            $menubase_unit_name=$result_baseunit['bu_name'];
                        }			
                    }
                    $menu_unit_name='';  
                    if($result_cat_s['mta_unit_id']!=''){
                    $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                    //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                    $num_unit  = $database->mysqlNumRows($sql_unit);
                    if($num_unit){ 
                        $result_unit  = $database->mysqlFetchArray($sql_unit); 
                        $menu_unit_name=$result_unit['u_name'];
                    }			
                } 
            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];

            $online_order_name_display='';
            $sql_cat_s_onl  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_cat_s['mta_food_partner']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s_onl);
                if($num_cat_s){
		while($result_cat_s_onl  = $database->mysqlFetchArray($sql_cat_s_onl)) 
		{
                    $online_order_name_display=$result_cat_s_onl['tol_name'];
                    
                }
                }                
            ?>
            <tr>    
                <td><?=$result_cat_s['mta_rate_type']?></td>
                <td><?=$portion_name['pm_portionname']?></td>
                  <td><?=$online_order_name_display?></td>
                <td><?=$result_cat_s['mta_unit_type']?></td>
                <td><?=$result_cat_s['mta_unit_weight']?></td>
                <td><?=$menu_unit_name?></td>
                <td><?=$menubase_unit_name?></td>
                <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=$result_cat_s['mta_barcode']?></td>
                <td> 
                    <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" id2="<?=$takeaway_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
                 <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                     <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
                </td>
            </tr>    
           <?php $k++;}} ?>
            <script>
                document.getElementById("takeawayportion").value = "1";
                $('#takeawayportion').find('option:first').attr('selected', 'selected');
                document.getElementById("takeawayrate").value = "";
                document.getElementById("taweight").value = "";
                document.getElementById("tabarcode").value = "";
                document.getElementById("takglit").value = "1";
            </script>
        </tbody>
    </table> 
<?php
} 
else if($_REQUEST['value']=="select_department"){
    
    $menuid=$_REQUEST['mid'];
?>
    <script>
        $('.takeeditrate').click( function() {  
            
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#takeawayrate").val(dinein_data[0]);
                        $("#takeawayportion").val(dinein_data[1]);
                        $("#taportionselect").val(dinein_data[2]);
                       // $("#tabarcode").prop('disabled',true);
                        $("#tabarcode").val(dinein_data[7]);
                         $("#ta_food").prop('disabled',true);
                         $("#ta_food").val(dinein_data[8]);
                         
                         if(dinein_data[10]!='' && parseInt(dinein_data[10])>0){
                        $("#ta_menu_rate").val(dinein_data[10]);
                        }else{ 
                         $("#ta_menu_rate").val(dinein_data[0]);   
                        }
                         // $("#ta_menu_rate").val(dinein_data[10]);
                           $("#ta_tax_value").val(dinein_data[11]);
                            $("#ta_tax_amount").val(dinein_data[9]);
                        if(dinein_data[2]=='Portion'){
                        $('#taportionunitspan').css('display','block');
                        $('#taportionselectspan').css('display','block');
                        $('#tapacketloosespan').css('display','none');
                        $('#taweightspan').css('display','none');
                        $('#takglitterspan').css('display','none');
                        $('#tabaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#taportionunitspan').css('display','block');
                            $('#tapacketloosespan').css('display','block');
                            $('#taportionselectspan').css('display','none');
                            $('#takglitterspan').css('display','block');
                            $('#tapackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#taweightspan').css('display','block');
                            $('#taweight').prop('disabled',true);
                            $('#taweight').val(dinein_data[5]);
                            $('#takglitterspan').css('display','block');
                            $('#takglit').val(dinein_data[4]);
                            $('#tabaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#taportionselectspan').css('display','none');
                            $('#tabaseunitspan').css('display','block');
                            $('#tabaseunit').val(dinein_data[3]);
                            $('#taweightspan').css('display','none');
                            $('#takglitterspan').css('display','none');
                        }
                        }
                        $("#utakeaway").css("display","block");
                        $("#takeaway").css("display","none");
                        $(".takeeditrate").css("display","none");
                        $(".ntakeeditrate").css("display","inline-block");
                        $(".takeselect").prop("disabled", true);
                    });
                    
                $('.utakeaway').click( function() {     
                  $("#utakeaway").css("display","none"); 
                  $("#takeaway").css("display","block");
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none");
                   $(".takeselect").prop("disabled", false);
                 });
        </script> 
        <table width="100%" border="0" cellspacing="5"  class="scroll" >   
        <thead>
            <tr>
                <th>Rate Type</th>
                <th><?=$_SESSION['s_portionname']?></th>
                 <th>Online</th>
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
            $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$menuid."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
		{
                                
                    $portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                    $menubase_unit_name='';
                    if($result_cat_s['mta_base_unit_id']!=''){
                        $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                        if($num_baseunit){
                            $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                            $menubase_unit_name=$result_baseunit['bu_name'];
                        }			
                    }
                    $menu_unit_name='';  
                    if($result_cat_s['mta_unit_id']!=''){
                    $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                    //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'";
                    $num_unit  = $database->mysqlNumRows($sql_unit);
                    if($num_unit){ 
                        $result_unit  = $database->mysqlFetchArray($sql_unit); 
                        $menu_unit_name=$result_unit['u_name'];
                    }			
                } 
            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];

            $online_order_name_display='';
            $sql_cat_s_onl  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_cat_s['mta_food_partner']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s_onl);
                if($num_cat_s){
		while($result_cat_s_onl  = $database->mysqlFetchArray($sql_cat_s_onl)) 
		{
                    $online_order_name_display=$result_cat_s_onl['tol_name'];
                    
                }
                }
            
            ?>
            <tr>    
                <td><?=$result_cat_s['mta_rate_type']?></td>
                <td><?=$portion_name['pm_portionname']?></td>
                 <td><?=$online_order_name_display?></td>
                <td><?=$result_cat_s['mta_unit_type']?></td>
                <td><?=$result_cat_s['mta_unit_weight']?></td>
                <td><?=$menu_unit_name?></td>
                <td><?=$menubase_unit_name?></td>
                <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=$result_cat_s['mta_barcode']?></td>
                <td> 
                    <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" id2="<?=$takeaway_id?>"  ><i class="glyphicon glyphicon-trash"></i></a>
                 <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                     <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
                </td>
            </tr>    
           <?php $k++; }} ?>
            
           <script>
                document.getElementById("takeawayportion").value = "1";
                $('#takeawayportion').find('option:first').attr('selected', 'selected');
                document.getElementById("takeawayrate").value = "";
                document.getElementById("taweight").value = "";
                document.getElementById("tabarcode").value = "";
                document.getElementById("takglit").value = "1";
           </script>
           
        </tbody>
    </table> 
<?php
}
?>

