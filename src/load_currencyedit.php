<h3>Edit</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                                               <?php
                                               
                                               //include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
                   if($result_login['c_status']=="Active"){
        $chk="Checked";
    }
 else {
        $chk="";
    }
    
    
    
                       ?>
             
                  
                        <form role="form" action="currencymaster.php"  method="post"  name="compeditform"  >
                            <input type="hidden" name="hideditcomp"  value="<?=$_REQUEST['id']?>">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Currency name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input readonly type="text" class="form-control cancellation" id="compedit" name="compedit" tabindex="1"  placeholder=" Name" value="<?=$result_login['c_name']?>"></div>
                                                                  	
                                     	 
                               </div>
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Shortcode<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input type="text" tabindex="2" class="form-control cancellation" id="compedit1" name="compedit1"  placeholder=" Shortcode" value="<?=$result_login['c_short_code']?>"></div>
                                                                  	
                                     	 
                               </div>
                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox"   value="Y" tabindex="3" name="activecomp"  id="activecomp" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['c_status']?>">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                              
                                  </form> 
                        <?php }?>
                    </div>
                                    
                                    <a  href="#" onClick="validate_editcancel()" tabindex="4"><button class="md-save" >Update</button></a>
                             <a  href="#"><button class="md-close" tabindex="5">Close</button></a>
                             
				</div>
<script>

$("#compedit").focus();

$(".md-close").click(function(){
        $("#modal-18").removeClass('md-show');
});
</script>