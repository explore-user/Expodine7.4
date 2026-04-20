<h3>Edit</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                                               <?php
                                               
                                               include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_cancellation_reasons where cr_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
                   if($result_login['cr_active']=="Y"){
        $chk="Checked";
    }
 else {
        $chk="";
    }
    
    
    
                       ?>
             
                  
                        <form role="form" action="cancellation.php"  method="post"  name="cancellationformedit"  >
                            <input type="hidden" name="hidedit"  value="<?=$_REQUEST['id']?>">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Reason<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input type="text" tabindex="1" class="form-control cancellation" id="cancellation1edit" name="cancellation1edit"  placeholder="Cancellation Reason" value="<?=$result_login['cr_reason']?>"></div>
                                                                  	
                                     	 
                               </div>
                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox"  value="Y" tabindex="2" name="activeedit"  id="activeedit" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['cr_active']?>">
                       
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
<script>

$("#cancellation1edit").focus();

$(".md-close").click(function(){
        $("#modal-18").removeClass('md-show');
});
</script>