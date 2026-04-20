<?php
//include('../includes/session.php');
session_start();		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['taxid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_extra_tax_master where amc_id='".$_SESSION['taxid']."'");

$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['amc_name'];
                         
	  }			
} 
else
{
  $searchname="";
}
	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
	/***************************************  Popup function starts *************************************************  */
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span>
  </div> 
    
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
 
   <div>
        <span style="float: left;width: 100%;height: 20px"><strong style="color:red" id="error_msg_tax1"></strong></span>
                     <?php
                         $sql_login  =  $database->mysqlQuery("select * from tbl_extra_tax_master Where amc_id='".$_SESSION['taxid']."'"); 
                          $num_login   = $database->mysqlNumRows($sql_login);
                          if($num_login){
                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                        {
                         ?>
                         <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:10px;">
                            
                        <form role="form" action="extra_tax.php"  method="post"  name="extra_taxedit">

                        <span id="extrastatus123" class="load_error alertsmaster" style="color:#F00" ></span>
                       	<div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc" >Name <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcname_divs">
                                 <input tabindex="1" type="text" class="form-control amcname1" autofocus="autofocus" placeholder="Name" id="amcname1" name="amcname1" value="<?=$result_login['amc_name']?>"></div>
                        </div>


                        <div class="first_form_contain" style="width:49%;margin-left:1%">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Value  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcvalue_divs">
                                 <input tabindex="2" type="text" readonly class="form-control" placeholder="Value" id="amcvalue1" name="amcvalue1" value="<?=$result_login['amc_value']?>"></div>
                        </div>
                         <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Label  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amclabel_divs">
                                 <input tabindex="3" type="text" class="form-control" placeholder="Label" id="amclabel1" name="amclabel1" value="<?=$result_login['amc_label']?>"></div>
                        </div>
                       <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc" >Unit <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcname_divs">
                                 
                                 <select tabindex="4" id="unit_type" name="unit_type_edit" class="form-control">
                                     <option value="P" <?php if($result_login['amc_unit']=='P') { ?> selected <?php } ?>>%</option>
                                     <option value="V" <?php if($result_login['amc_unit']=='V') { ?> selected <?php } ?>>V</option>
                                 </select>
                                 </div>
                        </div>
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Active  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                  <input tabindex="5" type="checkbox" value="<?=$result_login['amc_active']?>"  name="amcactive1"  id="amcactive1" data-toggle="tooltip" title="active" <?php if($result_login['amc_active']=="Y") { ?> checked <?php } ?> >
                        </div>
                        </div>
                        
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Item Tax  <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input tabindex="6" type="checkbox" value="<?=$result_login['amc_item_tax']?>"  name="tax_active1"  id="tax_active1" onclick="return taxchange1();" data-toggle="tooltip" title="active" <?php if($result_login['amc_item_tax']=="Y") { ?> checked <?php } ?> >
                        </div>
                        </div>
                        
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">CS  <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input tabindex="7" type="checkbox" value="<?=$result_login['amc_enable_cs']?>"  name="tax_cs1"  id="tax_cs1"  data-toggle="tooltip" title="active" <?php if($result_login['amc_enable_cs']=="Y") { ?> checked <?php } ?> >
                        </div>
                        </div>
                        
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">TA  <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input tabindex="8" type="checkbox" value="<?=$result_login['amc_enable_ta']?>"  name="tax_ta1"  id="tax_ta1"  data-toggle="tooltip" title="active" <?php if($result_login['amc_enable_ta']=="Y") { ?> checked <?php } ?> >
                        </div>
                        </div>
                        
                        <div class="first_form_contain" style="width:49%;margin-left:0">
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">HD  <span style="color:#F00"></span></div>
                             <div class="form_textbox_cc" id="amcactive_divs">
                                 <input tabindex="9" type="checkbox" value="<?=$result_login['amc_enable_hd']?>"  name="tax_hd1"  id="tax_hd1"  data-toggle="tooltip" title="active" <?php if($result_login['amc_enable_hd']=="Y") { ?> checked <?php } ?> >
                        </div>
                        </div>
                        
                        
                         <div class="first_form_contain" id="edit_symbol" <?php if($result_login['amc_item_tax']=="N") { ?> style="width:49%;display:none" <?php } ?>>
                             <span class="load_error alertsmaster" style="color:#F00"></span> 
                             <div class="form_name_cc">Symbol  <span style="color:#F00">*</span></div>
                             <div class="form_textbox_cc" id="amcsymbol_divs">
                                 <input type="text" class="form-control"  onkeyup="symbol_in();" autocomplete="off" placeholder="Sybmol" id="amcsymbol1" name="amcsymbol1" onchange="valisymbol1()" value="<?=$result_login['amc_symbol']?>"></div>
                        </div>
                        
                        
                             <input type="hidden" name="amcid1" id="amcid1" class="menuname" style="color:black" value="<?=$result_login['amc_id']?>">
                             </form>  
                             </div>
                             <a  href="#" class="entersubmit"  onClick="update_extratax()" tabindex="10"><span class="md-save newbut">Update</span></a>
                       
                                <?php }} ?>
</div>
</div>


<script type="text/javascript">

    $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            //alert("hiiiii");
        $('.md-close_pop').click();
    });
    $("#amcname1").focus();
    
function symbol_in(){

var syb= $("#amcsymbol1").val();
if(syb=='<'|| syb=='>' || syb=='"' || syb=="'"){
    $("#amcsymbol1").val('');
       $('#error_msg_tax1').css("display", "block");
	$('#error_msg_tax1').text('This symbol cant be added');	
	$("#error_msg_tax1").delay(1500).fadeOut('slow');
}

}
    function validate_all1()
   {
        var taxid=$("#amcid1").val();
	var ab=$("#amcname1").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkextraedit&mid="+ab+"&taxtid="+taxid,
			success: function(data)
			{
			data=$.trim(data);
	//	alert(data);
			var namechk=$('#extrastatus123');
			if(data =="sorry")
			{
		 //namechk.text('Extra Tax Already exists');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Tax Name Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
	          $("#amcname_divs").addClass("has-error");
	        $("#amcname1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
	   $("#amcname_divs").removeClass("has-error");
	   $("#amcname_divs").addClass("has-success");
	document.extra_taxedit.submit();
			}
			}
		}); 

	
}

function update_extratax()
			{
                            
                                    
                            if(validate_name1())
				  {
                                       if(validate_value1())
				  {
                                     
                                      if(validate_lable1())
				{
                                 
                                    if(validate_all1())
				{
                                }
                               
			
                                    
                              }
                             }
					
		          }
                      }


function validate_name1()   
			{
				if($(".amcname1").val()=="")
				{
					$("#amcname_divs").addClass("has-error");
				
						  document.extra_taxedit.amcname1.focus();
                                                  //alert("Enter Name");
                                                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
						  return false;
				}
                              
                                      else
					 {
						 var a=document.getElementById("amcname1").value;
						 $("#amcname_divs").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
                                     }
                                     
                                    
                    
                    
                     
                                      function validate_value1()
                        {
                            if ($("#amcvalue1").val() == "0.00")
                            {
                                $("#amcvalue_divs").addClass("has-error");
                                document.extra_taxedit.amcvalue1.focus();
                                //alert("Enter Value")
                                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Value');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                                
                            } 
                           
//                             var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                          if(!alphanumers.test($("#amcvalue").val())){
//                       $("#amcvalue_div").addClass("has-error");
//                        document.extra_tax.amcvalue.focus();
//                  alert("Special charecter Not Allowed.");
//                        }
                            else
                            {
                                
                                    $("#amcvalue_divs").removeClass("has-error");
                                    $(this).addClass("has-success");
                                    return true;
                                
                            }
                        
                    }
                    
                    
                    
                    
                    
                 function validate_lable1()   
			{
				
						if ($("#amclabel1").val() == "")
                            {
                                $("#amclabel_divs").addClass("has-error");
                                document.extra_taxedit.amclabel1.focus();
                                //alert("Enter Label")
                                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Label');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            } 
                           
                         
                            else
                                {
			 return true;	  
                                 }
					
                                     }  
                                     
                           function validate_symbol()   
			{
				
						 return true;
					
                                     }          


function valisymbol1()
      {
	var ac1=$("#amcsymbol1").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=extrataxsymbol1&mid11="+ac1,
			success: function(data)
			{
			data=$.trim(data);
		//alert(data);
			var namechk=$('#extrastatus123');
			if(data =="sorry")
			{
		// namechk.text('Already exists');
                  $("#amcsymbol_divs").addClass("has-error");	        
                  $("#amcsymbol1").focus();
                  $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Symbol Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
               // alert('Symbol Already exists');
                 return false;
			}
			else
			{
			
		namechk.text('');
	 $("#amcsymbol_divs").removeClass("has-error");
	   $("#amcsymbol_divs").addClass("has-success");
//	  	alert('aa');

			}
			}
		}); 

	
}   

function taxchange1(){
    
    var sts=$('#tax_active1').val();
   
    
    if(document.getElementById('tax_active1').checked) {
   $('#edit_symbol').show();
} else {
  $('#edit_symbol').hide();
}
    
    
}
</script>
