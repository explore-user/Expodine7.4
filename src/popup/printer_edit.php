<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['printerid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_printersettings INNER JOIN tbl_branchmaster ON  tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid and pr_id='".$_SESSION['printerid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['pr_printername'];
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

<script>

    $("#lantype").focus();
$(document).ready(function(){
$('#type1').change(function(){
    var optionSelected = $(this).find('option:selected').attr('title');
//    var flooroption = $(this).find('option:selected').attr('title2');
    //this will show the value of the atribute of that option.
	$('#hidloginstatus1').val(optionSelected);
//	$('#hidloginstatus22').val(optionSelected);
//	var ax=$('#hidloginstatus22').val();
//	alert(ax);
	if(optionSelected=="Y")
	{
		
		$('#forloginonly1').css("display", "block");
	}else
	{
		$('#forloginonly1').css("display", "none");
	}
        
//         $('#hidfloorvisible1').val(flooroption);
//        if(flooroption=="Y")
//        {
//            $('#fl_div').css("display", "block");
//        }else
//        {
//            $('#fl_div').css("display", "none");
//        }
});

$('#defaultusb1').click(function (e) {
			if($("#defaultusb1").is(':checked'))
			{
				$('.usbstatus').css('display','block');
				$('.lanstatus').css('display','none');
			}
			else
			{
				$('.usbstatus').css('display','none');
				$('.lanstatus').css('display','block');
				
			}
		});

 });
 
</script>

<div class="md-content edit_pr_new" style="position:fixed;left:30%;z-index:99999;width: 500px !important;background-color: #ededed"><!--1sttab top:5%;-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
 
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON  tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_printertype ON tbl_printersettings.pr_printertype=tbl_printertype.pt_id WHERE pr_id='".$_SESSION['printerid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
<!--                           <form role="form" action="printer_master.php"  method="post"  name="printer_masteredit">-->
                           
                           
                           
                                 
                         <div id="edit_print" class="printer_mode_select">
                    	<ul>
                            <form>
                                    <?php
                                $ch="";
                                $ch1="";
                                if($result_login['pr_defaultusb']=="N"){
                                    $ch="checked";
                                }
                                else if($result_login['pr_defaultusb']=="Y"){
                                    $ch1="checked";
                                }
                                ?>
                          <li style="text-align:right">
                              <input type="radio" id="l-option" name="selectoredit" <?=$ch?> value="lanedit" >
                            <label style="margin: 12px auto;" for="l-option">LAN</label>
                            
                            <div style="left: 90px;" class="check"></div>
                          </li>
                          
                          <li>
                              <input type="radio" id="u-option" name="selectoredit" <?=$ch1?> value="usbedit">
                            <label style="margin: 12px auto;" for="u-option">USB</label>
                            
                            <div class="check"><div class="inside"></div></div>
                          </li>
                            
                            </form>
                        </ul>
                    </div><!--printer_mode_select-->
                    <form  method="post" id="lanformedit">
                    <div class="printer_add_text_boxes_cc" id="lanedit">
                         <div class="group" id="">      
                          <select class="add_printer_drop" id="lantypeedit" name="lantypeedit">
                              <option value="DI" <?=($result_login['pr_floorid']!='' ? 'selected' : '')?>>Dine In</option>
                               
                              <option value="TA" <?=($result_login['pr_floorid']=='' ? 'selected' : '')?>>TA/CS</option> 
                                                                                                                            1</option>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        <div class="group" id="lanflooredit_div">      
                            <select class="add_printer_drop" id="lanflooredit" name="lanflooredit">
                          	 <option value>Floor*</option>
                                <?php
			          $sql_flr  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='" . $_SESSION['branchofid'] . "' and fr_status='Active' order by fr_floorid"); 
				  $num_flr   = $database->mysqlNumRows($sql_flr);
				  if($num_flr){
                                     while($result_flr  = $database->mysqlFetchArray($sql_flr)) {
                                          $sel2="";
                                       if($result_flr['fr_floorid']==$result_login['pr_floorid'])
                                       {
                                           
                                           $sel2="selected";
                                       }
                                       ?>
                              <option value="<?=$result_flr['fr_floorid']?>"<?=$sel2?>><?=$result_flr['fr_floorname']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                                  
                          
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        
                            <div class="group" id="lanforedit_div">      
                          <select class="add_printer_drop" id="lanforedit" name="lanforedit">
                              <option value>For<span style="color:#F00">*</span></option>
                           <?php
			          $sql_prnttype  =  $database->mysqlQuery("select * from tbl_printertype"); 
				  $num_prnttype   = $database->mysqlNumRows($sql_prnttype);
				  if($num_prnttype){
                                     while($result_prnttype  = $database->mysqlFetchArray($sql_prnttype)) {
                                         $sel1="";
                                       if($result_prnttype['pt_id']==$result_login['pr_printertype'])
                                       {
                                           
                                           $sel1="selected";
                                       }
                                         ?>
                              <option value="<?=$result_prnttype['pt_id']?>" <?=$sel1?>> <?=$result_prnttype['pt_typename']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                            
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            
                            
                           
                            <div class="group" id="lankotedit_div" >      
                                  
                                         <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_kotcountermaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select  id="lankotedit" name="lankotedit" data-rel="chosen" tabindex="9" title="KOT" left"." data-toggle="tooltip" class="add_printer_drop">
                                        
                                        
                                         <option value>Kot Type*</option>
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
                                                                             $sel4="";
                                       if($result_kot['kr_kotcode']==$result_login['pr_kotcode'])
                                       {
                                           
                                           $sel4="selected";
                                       }
									?>
                                              <option value="<?=$result_kot['kr_kotcode']?>" <?=$sel4?>> <?=$result_kot['kr_kotname']?></option> 
                                    <?php } ?> 
                                       
                                    	 </select>
                                         <?php } ?>
                                         
                                         
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                            
                            <div class="group" id="lannameedit_div">      
                             <input type="text" class="printernames" id="lannameedit" name="lannameedit"  placeholder="Printer Name" tabindex="0"  data-toggle="tooltip" title="Printer Name" value="<?=$result_login['pr_printername']?>">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Printer Name</label>
                        </div>
                            <div id="lanipshow">
                            <div class="group" id="lanipedit_div">      
                           <input type="text" class=" ips" id="lanipedit" name="lanipedit"  placeholder="Printer IP" tabindex="0"  data-toggle="tooltip" title="Printer IP" value="<?=$result_login['pr_printerip']?>" onkeypress="return numonly(this.evt)">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>LAN Ip</label>
                        </div>
                            <div class="group" id="lanportedit_div">      
                         <input type="text" class=" ports" id="lanportedit" name="lanportedit"  placeholder="Printer Port" tabindex="0"  data-toggle="tooltip" title="Printer Port" value="<?=$result_login['pr_printerport']?>" onkeypress="return numonly(this.evt)">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>LAN Port</label>
                        </div>
                                </div>
                            <div class="group" id="usbipedit_div">      
                          <input type="text" class=" ip1" id="usbipedit" name="usbipedit"  placeholder="Printer IP" tabindex="0"  data-toggle="tooltip" title="Printer IP" value="<?=$result_login['pr_usbprinterip']?>" onkeypress="return numonly(this.evt)">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>USB Ip</label>
                        </div>
                        <div class="group" id="usbipedit1_div">      
                          <input type="text" class=" ip1" id="usbipedit1" name="usbipedit1"  placeholder="Printer Name" tabindex="0"  data-toggle="tooltip" title="Printer IP" value="<?=$result_login['pr_usbprinter']?>">
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>USB NAME</label>
                        </div>
                            <div class="group" id="lancountedit_div">      
                          <input type="text" class="counts" id="lancountedit" name="lancountedit"  placeholder="Printer Port" tabindex="0"  data-toggle="tooltip" title="Printer Port" value="<?=$result_login['pr_printcount']?>" onkeypress="return numonly(this.evt)"> 
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label>Count</label>
                        </div>
                        
                            <div class="group" id="lanstyleedit_div">      
                           <select class="add_printer_drop" id="lanstyleedit" name="lanstyleedit">
                                <option value>Style<span style="color:#F00">*</span></option>
                              <?php
			          $sql_prntstyle  =  $database->mysqlQuery("select * from tbl_printer_styles"); 
				  $num_prntstyle   = $database->mysqlNumRows($sql_prntstyle);
				  if($num_prntstyle){
                                     while($result_prntstyle  = $database->mysqlFetchArray($sql_prntstyle)) {
                                          $sel3="";
                                       if($result_prntstyle['ps_id']==$result_login['pr_style'])
                                       {
                                           
                                           $sel3="selected";
                                       }
                                       ?>
                              <option value="<?=$result_prntstyle['ps_id']?>" <?=$sel3?>><?=$result_prntstyle['ps_name']?></option> 
                              <?php
                              
                                     }
                                     }
                                      ?>
                          </select>
                          <span class="highlight"></span>
                          <span class="bar"></span>
                        </div>
                        
                        <input type="hidden" id="hiddlan" name="hiddlan" value="<?=$result_login['pt_kotstatus']?>">
                        <input type="hidden" id="hiddfloor" name="hiddfloor" value="<?=$result_login['pr_floorid']?>">
                    <input type="hidden" id="hidddftusb" name="hidddftusb" value="<?=$result_login['pr_defaultusb']?>">
                    </div>
                    
                   
                    
                   <div style="font-size: 150% !important;" class="priner_add_status_checkbox_cc">
                     <?php 
                     $chk="";
                     if($result_login['pr_enable']=="Y")
                     {
                         $chk="checked";
                     }
                             ?>
                       <label>Status <input id="status1" name="status1" type="checkbox"  value="Y" class="ios-switch" <?=$chk?>  /></label>
                   </div> 
                                            </form>

                    
     

        

                           
                           
                           
                           
                        	
                               
                                    
                                    <div class="first_form_contain" style="width:100%;padding: 2px;">
                                        <a  href="#" class="entersubmit"  id="edit_lanbt" onClick="validate_printervallanedit('<?=$result_login['pr_id']?>')"><span class="md-save newbut">Update</span></a>
                                         
                                    </div><!---first_form_contain--->
                                  
 <?php }} ?>
                                            </div>
                                            
                                            
                                            
                                            
                                            
 <script type="text/javascript">
 // JS is only used to add the <div>s
var switches = document.querySelectorAll('input[type="checkbox"].ios-switch');

for (var i=0, sw; sw = switches[i++]; ) {
	var div = document.createElement('div');
	div.className = 'switch';
	sw.parentNode.insertBefore(div, sw.nextSibling);
}

    var  htt=document.getElementById('lanforedit').value;
  
    if ( htt == '6')
           {
$("#lankotedit").hide();
  
           $("#hiddlan").val("N");

}else 
{
    $("#lankotedit").show();
}




$("#lanipshow").show();

$("#usbipedit_div").hide();
$("#usbipedit1_div").hide();
       
 var usbhidden=$("#hidddftusb").val();
 if(usbhidden=="Y")
 {
   $("#lanipshow").hide();  
   $("#usbipedit_div").show();
$("#usbipedit1_div").show();
 }
 else
 {
   $("#lanipshow").show();  
   $("#usbipedit_div").hide();
$("#usbipedit1_div").hide();   
 }
 
 if($("#hiddlan").val()=="Y") {
      $("#lankotedit_div").show();

 }
 else
 {
     $("#lankotedit_div").hide();  
    
 }
 
  if($("#hiddusb").val()=="Y"){
      $("#usbkotedit_div").show();
  
 }
 else
 {
     $("#usbkotedit_div").hide();

 }
 
       

   $("#edit_print input[name='selectoredit']").click(function(){
   
     
    if($('input:radio[name=selectoredit]:checked').val() == "usbedit") {
     
          $("#lanipshow").hide();
       $("#usbipedit_div").show();
       $("#usbipedit1_div").show();
        $("#hidddftusb").val("Y");
      
        
      
    }
    else if($('input:radio[name=selectoredit]:checked').val() == "lanedit") {
     
         
         $("#lanipshow").show();
       $("#usbipedit_div").hide();  
       $("#usbipedit1_div").hide();
         $("#hidddftusb").val("N");
        
    }
	
    
});

$(document).ready(function() {
     
         
       
     
    
          
    $('#lanforedit').on('change', function() {
       
        
      if ( this.value == '1')
     
      {
           $("#lankotedit").show();
        $("#lankotedit_div").show();
           $("#hiddlan").val("Y");
    
          }
  else if(this.value == '4')
  { $("#lankotedit").show();
        $("#lankotedit_div").show();
       $("#hiddlan").val("Y");
  }
      else
      {
        $("#lankotedit_div").hide();
         $("#hiddlan").val("N");
      }
    });
    
    $('#usbforedit').on('change', function() {
         
         
      if ( this.value == '1')
     
      {
         
        $("#usbkotedit_div").show();
     
    
          }
  else if(this.value == '4')
  {
        $("#usbkotedit_div").show();
       
  }
      else
      {
        $("#usbkotedit_div").hide();
      }
    });
});

$('#lantypeedit').on('change', function() {
                var type = $('#lantypeedit').val();
                if(type!='DI')
                {
                    $('#lanflooredit').hide();
                    
                }else{
                    $('#lanflooredit').show();
                }
                });

 </script>                                           
                                               
                                            
                                            
<script type="text/javascript">
      $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
function validate_printall()
{
	var printidchk=$("#printerid").val();
	var printername1=$("#printername1").val().trim();
	
			var a=$("#type1").find('option:selected').attr('id');
			
			var b=$("#floor1").find('option:selected').attr('id');
			
			var cb= $("#kot1").val();
			
			  var brnch=$("#branch1").find('option:selected').attr('id');
			 
			if(cb !='')
	{
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprintkotedit&type1="+a+"&floor1="+b+"&printeridchk="+printidchk+"&kot1="+cb+"&printername1="+printername1+"&br1="+brnch,
			success: function(data)
			{
			data=$.trim(data);

			var namechk=$('#printereditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		  // $("#ipdivs").addClass("has-error");
	//  $("#ip1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
	//	 $("#ipdivs").removeClass("has-error");
	//   $("#ipdivs").addClass("has-success");
	  // return true;
document.printer_masteredit.submit();
			}
			}
		});
		
	}
	else
	{
		
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprintedit&type1="+a+"&floor1="+b+"&printeridchk="+printidchk+"&printername1="+printername1+"&br1="+brnch,
			success: function(data)
			{
			data=$.trim(data);

			var namechk=$('#printereditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		  // $("#ipdivs").addClass("has-error");
	//  $("#ip1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
	//	 $("#ipdivs").removeClass("has-error");
	//   $("#ipdivs").addClass("has-success");
	  // return true;
document.printer_masteredit.submit();
			}
			}
		});
		
	}
}

function numonly(evt)
    { 
        evt = (evt) ? evt : window.event;
        
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        //alert(charCode);
        if ((charCode >47 && charCode< 58 )|| charCode==46){
            
            return true;

        }
        else{
            
        return false;
    }
    }

	function validate_printervallanedit(id)
	     {
             if(validate_lanfloor1())
                   {
                         if(validate_lanfor1())
                         
                       {
                             if(validate_lankot1())
                         
                       { 
                        
	          if(validate_lanprintername1())
		 {
                   
                 if(validate_lanip1())
                 {
                  if(validate_lanport1())   
                  {
                  if(validate_lancount1())  
                  {
                    if(validate_lanstyle1())
                     {
                         
                         if(validate_usbip1())
                           {
              
                            
                     if(validate_usbname1())
                           {
                             
                    // document.getElementById("lanformedit").submit();
      
  var lantypeedit=$('#lantypeedit').val();
   var lanflooredit=$('#lanflooredit').val();
    var lanforedit=$('#lanforedit').val();
     var lannameedit=$('#lannameedit').val();
      var lanipedit=$('#lanipedit').val();
       var usbipedit=$('#usbipedit').val();
       var lanportedit=$('#lanportedit').val();
       var lancountedit=$('#lancountedit').val();
       var lankotedit=$('#lankotedit').val();
        var lanstyleedit=$('#lanstyleedit').val();
         var usbipedit1=$('#usbipedit1').val();
          var hidddftusb=$('#hidddftusb').val();
          
      if ($('#status1').is(":checked")){
           var status1='Y';
         }else{
           status1='N';
         }
               var hiddlan=$('#hiddlan').val();


      var type= $('#ptypes').val();
       var name= $('#pnames').val();
        var ip= $('#pips').val();
         var port= $('#pports').val();
          var kot= $('#pbranch_kot').val();
          var lan_usb_typ=$('#lan_usb_type').val();
       

if(type=="")
  {
	type="null";
  }

  if(name=="")
  {
	name="null";
  }
  
  if(ip=="")
  {
	ip="null";
  }
  
  if(port=="")
  {
	port="null";
  }
  
  if(kot=="")
  {
	kot="null";
  }
  
                  $.ajax({
			type: "POST",
			url: "printer_master.php",
			data: "set_print=printer_upate_new&lantypeedit="+lantypeedit+"&lanflooredit="+lanflooredit+"&lanforedit="+lanforedit+"&lannameedit="+lannameedit+"&lanipedit="+lanipedit+"&usbipedit="+usbipedit+"&lanportedit="+lanportedit+"&lancountedit="+lancountedit+"&lanstyleedit="+lanstyleedit+"&usbipedit1="+usbipedit1+"&hidddftusb="+hidddftusb+"&status1="+status1+"&hiddlan="+hiddlan+"&lankotedit="+lankotedit,      
			success: function(msg)
			{
                            
                          $(".new_overlay_print").css("display","block");
                  $(".popup_alert_box_new").css("display","block");
		  $(".popup_alert_box_new").text('PRINTER UPDATED SUCCESSFULLY');
		    $(".edit_pr_new").css("display","none");
                    
               setInterval(function () {
                   window.location.href="printer_master.php?*"+id+"*"+type+"*"+name+"*"+ip+"*"+port+"*"+kot+"*"+lan_usb_typ;
                }, 1000);    
                            
                            
				 
		        }
		        });
                   
                   
                       
                 
                  
                           }
                                    }   
                     }     
                   }
                  }
                  }
                 }
                }
               }
        
             }
            
             }
         

         
         
         
         
function validate_lanprintername1()   
	{
if($("#lannameedit").val()=="")
				{
					$("#lannameedit_div").addClass("has-error");
                                        alert('enter printer name');
						  document.printer_master.lannameedit.focus();
                                                 
						  return false;
				}
//                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                              if(!alphanumers.test($("#lannameedit").val())) {
//                              $("#lannameedit_div").addClass("has-error");
//                              alert('no characters allowed in name field');
//                             document.printer_master.lannameedit.focus();
//                        
//                   }  
                                else
					 {
				 var a=document.getElementById("lannameedit").value;
				 $("#lannameedit_div").removeClass("has-error");
			         $(this).addClass("has-success");
				 return true;
					 }
        }
        
        
	
	
	//validatelanip
	
	function validate_lanip1() 
	  {
              if($('input:radio[name=selectoredit]:checked').val() == "lanedit")
              {
              
		  var ipad=$("#lanipedit").val();
                 
                      
	   if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipad))
		{
			$("#lanipedit_div").removeClass("has-error");
			return (true);
			
		}else
		{
			$("#lanipedit_div").addClass("has-error");
                        alert("Enter Valid  lan IP Address");
			 document.printer_master.lanipedit.focus();
                         
			 return false;
		}
                 
              }
             else{
                                      $("#lanipedit_div").removeClass("has-error");
                                 
				   $(this).addClass("has-success");
				   return true;
                                    } 
        
        }
          
          
	 
	 
        //validatelanport
	 function validate_lanport1()   
	  {
               if($('input:radio[name=selectoredit]:checked').val() == "lanedit")
              {
              
              var lanport=$("#lanportedit").val();
		  if(lanport=="")
		  {
			  $("#lanportedit_div").addClass("has-error");
                             alert("Enter LAN Port");
					document.printer_master.lanportedit.focus();
                                   
					return false;
		  }
                   var alphanumers = /^[0-9]+$/;
                              if(!alphanumers.test($("#lanportedit").val())) {
                              $("#lanportedit_div").addClass("has-error");
                              alert('enter valid lan port');
                             document.printer_master.lanportedit.focus();
                        
                   }  
                  else
			   {
                               if(lanport.length < 2)
                               {
                                
			  $("#lanportedit_div").addClass("has-error");
                             alert("Enter valid port number");
					document.printer_master.lanportedit.focus();
                                   
					return false;
                               }
				  else{
                                      $("#lanportedit_div").removeClass("has-error");
                                 
				   $(this).addClass("has-success");
				   return true;
                                    }
			   }
	  
              }
               else{
                   $("#lanportedit_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
              }
              
          }
          
          //validatelancount
	  function validate_lancount1()   
	  {
		  if($("#lancountedit").val()=="")
		  {
			  $("#lancountedit_div").addClass("has-error");
                            alert("please input count");
					document.printer_master.lancountedit.focus();
                                      
					return false;
		  }
                  
                   var alphanumers = /^[0-9]+$/;
                              if(!alphanumers.test($("#lancountedit").val())) {
                              $("#lancountedit_div").addClass("has-error");
                              alert('enter valid count number');
                             document.printer_master.lancountedit.focus();
                         }
        
        else
			   {
				   $("#lancountedit_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
	  function validate_lanfloor1()   
	  {
              var type = $('#lantypeedit').val();
		  if($("#lanflooredit").val()==""&&type=='DI')
		  {
                          alert("Select floor");
			  $("#lanflooredit_div").addClass("has-error");
                           
					document.printer_master.lanflooredit.focus();
                                    
                                        return false;
		  }
                  else
			   {
                               
				   $("#lanflooredit_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
          function validate_lanfor1()   
	  {
		  if($("#lanforedit").val()=="")
		  {
			  $("#lanforedit_div").addClass("has-error");
                           alert("Select printer for");
					document.printer_master.lanforedit.focus();
                                        return false;
		  }
                  else
			   {
				   $("#lanforedit_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
           
           function validate_lankot1()   
	  {
              if($("#lanforedit").val()=="1" || $("#lanfor").val()=="4" )
              {
		  if($("#lankotedit").val()=="")
		  {
			  $("#lankotedit_div").addClass("has-error");
                           alert("Select kot type");
					document.printer_master.lankotedit.focus();
                                        return false;
		  }
                  else {
                        $("#lankotedit_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
                      return true;
                  }
              }
                  else
			   {
				   $("#lankotedit_div").removeClass("has-error");
                                   
				   $(this).addClass("has-success");
				   return true;
			   }
                       
	  }
           
          
          function validate_lanstyle1()   
	  {
		  if($("#lanstyleedit").val()=="")
		  {
			  $("#lanstyleedit_div").addClass("has-error");
                           alert("Select Style");
					document.printer_master.lanstyleedit.focus();
                                        alert("Select Style");
					return false;
		  }else
			   {
                             
				   $("#lanstyleedit_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
			   }
	  }
          
         
          
       
	
	function validate_usbip1() 
	  {
               if($('input:radio[name=selectoredit]:checked').val() == "usbedit")
              {
              
		  var ipad=$("#usbipedit").val();
                  
	   if (/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ipad))
		{
			$("#usbipedit_div").removeClass("has-error");
			return (true);
			
		}else
		{
			$("#usbipedit_div").addClass("has-error");
                        alert("Enter Valid USB IP Address");
			 document.printer_master.usbipedit.focus();
                         
			 return false;
		}
                   
               }
                else{
                   $("#usbipedit_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
              }
               
	  } 
          
          
          
	 function validate_usbname1()
         {
              if($('input:radio[name=selectoredit]:checked').val() == "usbedit")
              {
             if ($("#usbipedit1").val()=="")
             {
                 
               $("#usbipedit1_div").addClass("has-error");
                                        alert('enter usb name');
						  document.printer_master.usbipedit1.focus();
                                                 
						  return false; 
             }
//              var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                              if(!alphanumers.test($("#usbipedit1").val())) {
//                              $("#usbipedi1").addClass("has-error");
//                              alert('no characters allowed in name field');
//                             document.printer_master.usbipedit1.focus();
//                                           }  
             else
             {
                 $("#usbipedit1_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
             }
              }
              else{
                  
                   $("#usbipedit1_div").removeClass("has-error");
				   $(this).addClass("has-success");
				   return true;
              }
                      
         }

          

	</script>