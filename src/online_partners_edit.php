<h3>Edit</h3>
				<div >
                    <div >
                                               <?php
                                               error_reporting(0);
                                               include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_online_order where tol_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
                   if($result_login['tol_status']=="Y"){
        $chk="Checked";
    }
 else {
        $chk="";
    }
    
    
    
    
    
    
                       ?>
             
                  
                        <form role="form" action="online_partners.php"  method="post"  name="denomeditform" enctype="multipart/form-data"  >
                            <input type="hidden" name="hideditdenom"  value="<?=$_REQUEST['id']?>">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                                     
                                  <div class="first_form_contain">
                             	<div class="form_name_cc">Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                 <input type="text" class="form-control cancellation" tabindex="1" id="denomedit" name="denomedit"  value="<?=$result_login['tol_name']?>"></div>
                                                                  	
                                     	 
                               </div>    
                                     
                                     
                                     
                                     <div class="form_name_cc"> &nbsp; Urban Piper Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">

                                     <select tabindex="2" class="form-control cancellation" id="denomedit_urb" name="denomedit_urb"  >
                 <option  value="">Select</option>
                 <option <?php if (strpos($result_login['tol_urban_name'], 'Takeaway') !== false){ ?> selected <?php } ?>  value="Takeaway">Takeaway</option>
               
                 <option <?php if (strpos($result_login['tol_urban_name'], 'zomato') !== false){ ?> selected <?php } ?>  value="zomato">zomato</option>
              
                <option <?php if (strpos($result_login['tol_urban_name'], 'swiggy') !== false){ ?> selected <?php } ?>  value="swiggy">swiggy </option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'ubereats') !== false){ ?> selected <?php } ?>  value="ubereats">ubereats</option> 
                <option <?php if (strpos($result_login['tol_urban_name'], 'scootsy') !== false){ ?> selected <?php } ?>  value="scootsy">scootsy</option> 
                <option <?php if (strpos($result_login['tol_urban_name'], 'dunzo') !== false){ ?> selected <?php } ?>  value="dunzo">dunzo</option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'dotpe') !== false){ ?> selected <?php } ?>  value="dotpe">dotpe</option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'foodpanda') !== false){ ?> selected <?php } ?>  value="foodpanda">foodpanda</option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'amazon') !== false){ ?> selected <?php } ?>  value="amazon">amazon</option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'swiggystore') !== false){ ?> selected <?php } ?>  value="swiggystore">swiggystore</option>
                <option <?php if (strpos($result_login['tol_urban_name'], 'zomatomarket') !== false){ ?> selected <?php } ?>  value="zomatomarket">zomatomarket</option>
               
               </select>


                                                            
                                     	 
                               </div>
                               
                               
                               
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Local Order<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select tabindex="4"  class="form-control cancellation"  id="local_order1" name="local_order1" >
                                          <?php
            $sql_cat_s  =  $database->mysqlQuery(" select * from tbl_online_order where tol_id='".$_REQUEST['id']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	    if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
                                         <option <?php if($result_cat_s['tol_local_order']=='Y'){ ?> selected <?php } ?> value='Y'> Yes </option>
                                         <option <?php if($result_cat_s['tol_local_order']=='N'){ ?> selected <?php } ?> value='N' > No </option>
                                         
            <?php } } ?>        
                                     </select>
                                 </div>
                                </div>
                                
                                
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Qr Code Order<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                    
                                 
                                     
                                     
                                     <select  tabindex="5" class="form-control cancellation" onchange="qr_check();"  id="qr_order1" name="qr_order1" >
                                          <?php
            $sql_cat_s  =  $database->mysqlQuery(" select * from tbl_online_order where tol_id='".$_REQUEST['id']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	    if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
                                         <option <?php if($result_cat_s['tol_qr_order']=='Y'){ ?> selected <?php } ?> value='Y'> Yes </option>
                                         <option <?php if($result_cat_s['tol_qr_order']=='N'){ ?> selected <?php } ?> value='N' > No </option>
                                         
            <?php } } ?>        
                                     </select>
                                 </div>
                                </div>
                                
                                
                                 <div class="first_form_contain">
                             	<div class="form_name_cc">Credit Settle<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select tabindex="8" class="form-control cancellation"  id="denomedit_crd" name="denomedit_crd" >
                                          <?php
            $sql_cat_s  =  $database->mysqlQuery(" select * from tbl_online_order where tol_id='".$_REQUEST['id']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	    if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
                                         <option <?php if($result_cat_s['tol_credit_settle']=='Y'){ ?> selected <?php } ?> value='Y'> Yes </option>
                                         <option <?php if($result_cat_s['tol_credit_settle']=='N'){ ?> selected <?php } ?> value='N' > No </option>
                                         
            <?php } } ?>        
                                     </select>
                                 </div>
                                </div>
                               
                               <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Online Tax<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <select style="pointer-events: none " tabindex="6" class="form-control cancellation"  id="denomedit_tx" name="denomedit_tx" >
                                          <?php
            $sql_cat_s  =  $database->mysqlQuery(" select * from tbl_online_order where tol_id='".$_REQUEST['id']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	    if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
                                         <option <?php if($result_cat_s['tol_tax']=='Y'){ ?> selected <?php } ?> value='Y'> Yes </option>
                                         <option <?php if($result_cat_s['tol_tax']=='N'){ ?> selected <?php } ?> value='N' > No </option>
                                         
            <?php } } ?>        
                                     </select>
                                 </div>
                                </div>
                                
                                
                                 
                               
                               
                               <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Tax(%)<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input readonly tabindex="7" onkeypress="return numdot(event)"  type="text" class="form-control cancellation" id="tax_value_edit" name="tax_value_edit"  value="<?=$result_login['tol_tax_value']?>"></div>
                                                                  	
                                     	 
                               </div>
                                
                                
                                 <div class="first_form_contain" style="display:none">
                             	<div class="form_name_cc">Discount(%)<span style="color:#F00"></span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input tabindex="3" onkeypress="return numdot(event)"  type="text" class="form-control cancellation" id="denomedit_ds" name="denomedit_ds"  value="<?=$result_login['tol_discount']?>"></div>
                                                                  	
                                     	 
                               </div>
                               
                               
                               
                               
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox" tabindex="9"   value="Y" tabindex="2" name="activedenom"   id="activedenom" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['tol_status']?>">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                              
                                <div class="first_form_contain">
                              <div class="form_name_cc"> Logo <span style="color:#F00"></span></div>
                              

    
                              <div id="ch_file"> <input tabindex="10" name="image_file51" id="image_file51" onchange="image_preview1(this);" type="file">     </div>   
                               
            </div>
            <div class="first_form_contain">
            <div class="form_name_cc"> &nbsp;</div>
            <div class="form_textbox_cc" style="height:auto;position: absolute;right: -135px;bottom: 38px;">
     

    
                             
    
                             
                             <?php if($result_login['tol_logo_url']!=''){ ?> 
                
                <img style="width:100px;height: 100px;padding: 20px;display: block;padding-left: 0; padding-top: 0;" id="blah1" src="<?=$result_login['tol_logo_url']?>" alt="Image" />
                
                             <div id="remove_img" onclick="delete_image('<?=$result_login['tol_logo_url']?>');" style="color:#9a4e4e;cursor:pointer;position: relative; top: -17px;" class="form_name_cc"> Remove <span style="color:#F00"></span></div>  
                               
                             <?php }?>
                             
                           
                                  </form> 
                        <?php }?>
                        </div>
                    </div>
                    </div>
                                    
                                    <a  href="#" tabindex="11" onClick="validate_editcancel('<?=$_REQUEST['id']?>')" tabindex="3"><button class="md-save" >Update</button></a>
                             <a  href="#"><button class="md-close" tabindex="4">Close</button></a>
                             </div>
				</div>
<script type="text/javascript">
    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
    
        $('.md-close').click();
    });
    

    $("#denomedit").focus();
    
    function qr_check(){
           var flr=  $('#denomedit').attr('qr_id_flr');
           
          
            $.ajax({
                                type: "POST",
                                url: "load_takeaway.php",
                                data: "set=check_qr&flr="+flr,
                                success: function (msg)
                                { 
                                  if($.trim(msg)=='sorry'){
                                 $("#qr_order1").val('N');     
                                      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Qr Order Already Exist .Keep It No');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                                  }
                                    
                                }
                            });
            
            
        }
    
    
     function numdot(e) {     
   
            var charCode;
            
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        }
        
  function image_preview1(input) { 
      
       var aa=$('#image_file51').val();
      
     
   var str2 = ".png";

   if(aa.includes(str2)){
      
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) { 
                      
               
                $('#blah1').show();
                $('#blah1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }else{
        alert('ONLY PNG IMAGES ALLOWED');
            $('#image_file51').val('');
            $('#blah1').hide();
                $('#blah1').attr('src', '');
    }
    }
    
    
    function delete_image(logo){
         var confirm1=confirm("CONFIRM DELETE ?");
    if(confirm1===true){
        
                        $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: "set=delete_image&logo="+logo,
			success: function(msg)
			{
                        $('#blah1').hide();
                         $('#remove_img').hide();
                          
                        }
                    });
                }
    }
    
      function numdot(item,evt) {
     
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
    
    
$(".md-close").click(function(){
        $("#modal-18").removeClass('md-show');
});

   
   
</script>