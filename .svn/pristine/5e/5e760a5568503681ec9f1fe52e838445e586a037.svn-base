<h3>Edit</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                                               <?php
                                               
                                               include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
	 $sql_login  =  $database->mysqlQuery("select * from tbl_expodine_machines where cm_id='".$_REQUEST['id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $result_login  = $database->mysqlFetchArray($sql_login);
	
                 
       
    
    
                 ?>           
                        <form role="form" action="expodine_machines.php"  method="post"  name="machineformedit"  >
                            <input type="hidden" name="hideditreg"  value="<?=$_REQUEST['id']?>">
                            
                              <div class="col-lg-6 col-md-6">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">System Ip <span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="1" class="form-control cancellation" id="ipaddress1" name="ipaddress1"  value="<?=$result_login['cm_ip_address']?>"></div>
                                         </div>                        	
                                      <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;"> Name<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input readonly tabindex="2" type="text" class="form-control cancellation" id="remark1" name="remark1"   value="<?=$result_login['cm_ip_remarks']?>"></div>
                                           </div>  
                              
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input readonly type="text" tabindex="3" class="form-control cancellation" id="port1" name="port1"   value="<?=$result_login['cm_ip_port']?>"></div>
                                           </div>                         	
                                     	 
                              <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Folder<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input readonly tabindex="4" type="text" class="form-control cancellation" id="folder1" name="folder1"   value="<?=$result_login['cm_ip_folder']?>"></div>
                                           </div>                         	
                                     	 
                                  
                              
                               <div class="first_form_contain" id="machinetype_div1" style="display:block">
                             	<div class="form_name_cc" style="font-size: 11px;"> Type<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <select tabindex="5" class="form-control cancellation" id="machinetype1" name="machinetype1"  ></div>
                                     <option value="" <?php if($result_login['cm_machine_type'] =="") echo "selected";?>>Please Select</option>
                                     <option value="counter" <?php if($result_login['cm_machine_type'] =="counter") echo "selected";?>>Counter</option>
                                    <option value="client" <?php if($result_login['cm_machine_type'] =="client") echo "selected";?>>Client</option>
                                    </select>
                               </div>  
                                </div>
                               
                               
                                 </div>
                              <div class="col-lg-6 col-md-6 no-padding">
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Ip<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="6" class="form-control cancellation" id="drawerip1" name="drawerip1"   value="<?=$result_login['cm_cash_drawer_ip']?>"></div>
                                           </div>     
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="7" class="form-control cancellation" id="drawerport1" name="drawerport1"   value="<?=$result_login['cm_cash_drawer_port']?>"></div>
                                           </div> 
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Enb<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                       <?php $drawerenb1=$result_login['cm_enable_cash_drawer'];?>
                               <select tabindex="8" class="form-control add_new_dropdown" name="drawerenable1" >
                                            <option value="Y" <?php if($drawerenb1=="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($drawerenb1 =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Server<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <?php $server1=$result_login['cm_is_server'];?>
                               <select tabindex="9" class="form-control add_new_dropdown" name="server1"  id="server1" >
                                            <option value="Y" <?php if($server1 =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($server1 =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                  <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Usb<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <?php $usbenb1=$result_login['cm_cash_drawer_usb'];?>
                               <select tabindex="10" class="form-control add_new_dropdown" name="usbenable1"  id="usbenable1" >
                                            <option value="Y" <?php if($usbenb1 =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($usbenb1 =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                               
                              </div>
                                  </form> 
                                 
                        <?php }?>
                    </div>
                                    
                                    <a  href="#" onClick="validate_editcancel()" tabindex="11"><button class="md-save" >Update</button></a>
                             <a  href="#"><button class="md-close" tabindex="12">Close</button></a>
                             
				</div>
<script>


   $("#ipaddress1").focus();
    
    $(document).ready(function() {
   $("#listall").tablesorter();
});

//if($('#server1').val()=='Y'){
//    //alert($('#server1').val());
//    $('#machinetype_div1').css('display','none');
//}
//else if($('#server1').val()=='N'){
//    //alert($('#server1').val());
//    $('#machinetype_div1').css('display','block');
//}
//$('#server1').change(function(){
//    
//  if($('#server1').val()=='Y'){
//    $('#machinetype_div1').css('display','none');
//}
//else if($('#server1').val()=='N'){
//    $('#machinetype_div1').css('display','block');
//}  
//});
$(".md-close").click(function(){
        $("#modal-18").removeClass('md-show');

}); 
</script>