<?php 
session_start();

//error_reporting(0);
include("database.class.php");
$database	= new Database();

if(isset($_REQUEST['set_floor_add_new'])&& ($_REQUEST['set_floor_add_new']=='floor_add_new')){
             $fl=$_REQUEST['floor_id_add'];
             $ft= $_REQUEST['floor_tax_add'];
             $sts="Y";
             
            
        $insertion['ft_floorid'] = mysqli_real_escape_string($database->DatabaseLink,trim($fl)); 
        $insertion['ft_tax_id']= mysqli_real_escape_string($database->DatabaseLink,trim($ft)); 
        $insertion['ft_active']=  mysqli_real_escape_string($database->DatabaseLink,trim($sts)); 
        
   
	$insertid      =  $database->insert('tbl_floor_tax',$insertion); 


}

if(isset($_REQUEST['set_floor_del'])&& ($_REQUEST['set_floor_del']=='floor_del')){
    
    $del_id_floor=$_REQUEST['floor_id'];
    $del_id_tax=$_REQUEST['floor_tax'];
    
    
    $delete_tbl_fn = $database->mysqlQuery("DELETE FROM tbl_floor_tax WHERE ft_floorid='".$del_id_floor."' and ft_tax_id='".$del_id_tax."'");
}



if(isset($_REQUEST['set_floor_list'])&& ($_REQUEST['set_floor_list']=='floor_list')){
    
    $floor_id=$_REQUEST['floor_id'];
    $floor_name=$_REQUEST['floor_name'];
    
     
  
?>



<div class="discount_popup_cc floor_tax" id="tax_popup_floor" >
   <div class="discount_popup" style="width: 400px;padding: 15px 4px 0 16px;">
      <div class="discount_popup_head">Floor-<?=$floor_name?><a href="#"><button class="md-close_pop discount_pop_close disc_close">x</button></a></div>
      <div class="discount_popup_conatant">
         <div class="dicount_popup_add_sec">
            
            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:60%;margin-bottom: 5px">
               <p style="line-height: 32px;width: 12%;float: left;" class="menu_filter_txt">TAX</p>
               <select style="width: 85%;" class="form-control" id="floor_tax_type">
                   
                   <?php
$sql_login_fl = $database->mysqlQuery("select * from tbl_extra_tax_master where amc_item_tax='N'");
$num_login_fl = $database->mysqlNumRows($sql_login_fl);
if ($num_login_fl) {
    while ($result_login_fl = $database->mysqlFetchArray($sql_login_fl)) {
        ?>
                   
                  <option value="<?=$result_login_fl['amc_id']?>"><?=$result_login_fl['amc_name']?></option>
<?php } } ?>
               </select>
            </div>
            
            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:10%">
                <div id="add_ds" style="margin: 0px 0 0 4px;width: 80px" class="search_btn_member_invoice"><a onclick="return add_tax_floor();" style="line-height: 29px;" href="#">+ADD</a></div>
                <input type="hidden" id="hidden_floorid" value="<?=$floor_id?>">
               
            </div>
         </div>
         <span class="tab_table_cont_cc">
            <table class="responstable" id="dinein">
               <thead>
                  <tr>
                     <th>Text</th>
                     <th>Delete</th>
                  </tr>
               </thead>
               <tbody id="ref_floor">
               		
                            
                                         <?php
                                         
$sql_login_fl1 = $database->mysqlQuery("select *,amc_name from tbl_floor_tax tf left join tbl_extra_tax_master te on te.amc_id=tf.ft_tax_id where tf.ft_floorid='".$floor_id."'");
$num_login_fl1 = $database->mysqlNumRows($sql_login_fl1);
if ($num_login_fl1) {
    while ($result_login_fl1 = $database->mysqlFetchArray($sql_login_fl1)) {
        ?>
                            <tr>
               			<td><?=$result_login_fl1['amc_name']?></td>
                                <td><a onclick="return delete_tax('<?=$result_login_fl1['ft_floorid']?>','<?=$result_login_fl1['ft_tax_id']?>');" href="#"><img src="img/delete_btn_2.png"></a></td>
                                </tr>
                                <?php } } ?>
               		
               </tbody>
            </table>
         </span>
        
      </div>
   </div>
</div>


<script type="text/javascript">
    
      $('.disc_close').click(function () {
                $('.floor_tax').hide();
            });
            
        
       function confirm_yes_new(){
           
        var f= $('#confirm_pop_all').attr('floor');
         var t=$('#confirm_pop_all').attr('tax');
           
           
        var data="set_floor_del=floor_del&floor_id="+f+"&floor_tax="+t;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_add.php",
        data: data,
        success: function(data)
        {
            
            var data="set_add_load_floor=add_load_floor&floor_id_tax="+f;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_manage.php",
        data: data,
        success: function(data)
        {
            
            $('#ref_floor').html(data);    
        }
    }); 
            
            
          
        }
      }); 
           
           
         $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
           
       }  
        
        
            
            
        function delete_tax(f,t){
                
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM DELETE ?');
         
         $('#confirm_pop_all').attr('floor',f);
         $('#confirm_pop_all').attr('tax',t);
         
                
    }
    
    
    function add_tax_floor(){
        
        var tax= $('#floor_tax_type').val();
         
         var floor=$('#hidden_floorid').val();
        
        
        var data="set_floor_add_new=floor_add_new&floor_id_add="+floor+"&floor_tax_add="+tax;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_add.php",
        data: data,
        success: function(data)
        {
            
            var data="set_add_load_floor=add_load_floor&floor_id_tax="+floor;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_manage.php",
        data: data,
        success: function(data)
        {
            
            $('#ref_floor').html(data);    
        }
    }); 
            
            
          
        }
    }); 
        
    }
    
    
    
    </script>

<?php } ?>