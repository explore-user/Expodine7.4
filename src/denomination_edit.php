<h3>Edit</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                                               <?php
                                               
                                               include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_denomination_master where dm_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
                   if($result_login['dm_active']=="Y"){
        $chk="Checked";
    }
 else {
        $chk="";
    }
    
    
    
                       ?>
             
                  
                        <form role="form" action="denomination.php"  method="post"  name="denomeditform"  >
                            <input type="hidden" name="hideditdenom"  value="<?=$_REQUEST['id']?>">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Denomination<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input type="text" class="form-control cancellation" id="denomedit" name="denomedit" onkeypress="return numdot(this,event);"  placeholder="unit" value="<?=$result_login['dm_denomination']?>"></div>
                                                                  	
                                     	 
                               </div>
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Display Order<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input type="text" class="form-control cancellation" id="displayedit" onkeypress="return numdot(this,event);"  name="displayedit"  placeholder="unit" value="<?=$result_login['dm_display_order']?>"></div>
                                                                  	
                                     	 
                               </div>
                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox"   value="Y" tabindex="2" name="activedenom"   id="activedenom" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['dm_active']?>">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                              
                                  </form> 
                        <?php }?>
                    </div>
                                    
                                    <a  href="#" onClick="validate_editcancel()" tabindex="3"><button class="md-save" >Update</button></a>
                             <a  href="#"><button class="md-close" tabindex="4">Close me!</button></a>
                             
				</div>
<script type="text/javascript">

     $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
   $("#modal-18").removeClass('md-show');
//$(".close_staff_pop").click();
    });


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