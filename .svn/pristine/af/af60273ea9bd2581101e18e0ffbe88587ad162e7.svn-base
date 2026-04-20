<h3>Edit</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                                               <?php
                                               
                                               //include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_cardmaster where crd_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
                   if($result_login['crd_active']=="Y"){
        $chk="Checked";
    }
 else {
        $chk="";
    }
    
    
    
                       ?>
             
                  
                        <form role="form" action="cardmaster.php"  method="post"  name="compeditform"  >
                            <input type="hidden" name="hideditcomp"  value="<?=$_REQUEST['id']?>">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Card<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     
                                     <input type="text" tabindex="1" class="form-control cancellation" id="compedit" name="compedit"  placeholder=" Name" value="<?=$result_login['crd_name']?>" readonly></div>
                                                                  	
                                     	 
                               </div>
                               
                               
                               
                               
                               
                                                <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox"  tabindex="2"  value="Y" tabindex="2" name="activecomp"  id="activecomp" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['crd_active']?>">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                              <div class="image-crop">
<!--				<div class="form_name_cc">Card Image Url<span style="color:#F00">*</span></div>
                                  <div ><input name="image_file5" id="image_file5" onChange="fileSelectHandler()" type="file"></div>-->
<!--                                     <div style="display: table;"><input class="upload_log_buton companylogo entersubmit" type="submit" value="Submit" name="submit5"></div>                           -->
                               </div>
                                  </form> 
                        <?php }?>
                    </div>
                                    
                                    <a  href="#" onClick="validate_editcancel()" tabindex="3"><button class="md-save" >Update</button></a>
                             <a  href="#"><button class="md-close" tabindex="4">Close</button></a>
                             
				</div>
<script>

            $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $("#modal-18").removeClass('md-show');
    });    

$("#compedit").focus();

$(".md-close").click(function(){
        $("#modal-18").removeClass('md-show');
});
</script>