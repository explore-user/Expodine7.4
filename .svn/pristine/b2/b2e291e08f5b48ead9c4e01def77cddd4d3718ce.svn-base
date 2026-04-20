<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['report']=$_REQUEST['report'];
$sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where rm_id='".$_SESSION['report']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['rm_reportname'];
			  
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
$(document).ready(function(){
	
	var a=$('#emailchk').val();
	if(a =="Y")
	{
		$("#emailcheck").css("display","block");
	}
	else
	{
			$("#emailcheck").css("display","none");
	}

});

</script>




<script type="text/javascript">
$("#update").click(function(){
   
   if($(".reportnames").val()=="")
		{
			$("#reportname_div1").addClass("has-error");
				  document.report_masteredit.report1.focus();
				 
		}else
			 {
				 var a=document.getElementById("report1").value;
				
				$("#reportname_div1").removeClass("has-error");
					$(this).addClass("has-success");
					var a=$('#emailchk').val();
	               if(a =="Y")
	                {
				var enteremail=$('#emaillist').val();
					
					var s=enteremail;
		var values=s.split(',');
		
		var legt=values.length;
	//alert(legt);
		var nn=0;
			var vv="";
		for (var i = 0; i < values.length; i++) 
		{ 
		//alert(values[i]);
		var str=values[i];
		//alert(str);
		vv=str.trim() + "," + vv;
		//alert(vv);
			if((emailvalidation(str.trim()))==false)
			{
				nn=1;
			}
		}
		if(nn==1)
		{
			
			alert("Invalid email address! Please re-enter!");
			document.getElementById("enteremail").select();
			document.getElementById("enteremail").focus();
			return false;
		}
		
		vv = vv.substring(0, vv.length - 1);
//alert(vv);			
		 document.report_masteredit.submit();				
					
					
					
					}
					
					else
					{
						 document.report_masteredit.submit();				
					}
					
					
					/*if (emailvalidation(list))
					{
				 document.report_masteredit.submit();	
					}
					}
					else
					{
						 document.report_masteredit.submit();	
					}*/
					
			 }
   
   
   
   
   
});


/*var s=enteremail;
		var values=s.split(',');
		
		var legt=values.length;
		//alert(legt);
		var nn=0;
		for (var i = 0; i < values.length; i++) 
		{ 
		//alert(values[i]);
		var str=values[i];
		vv=str.trim() + "," + vv;
			if((emailvalidation(str.trim()))==false)
			{
				nn=1;
			}
		}
		if(nn==1)
		{
			
			alert("Invalid email address! Please re-enter!");
			document.getElementById("enteremail").select();
			document.getElementById("enteremail").focus();
			return false;
		}
		vv = vv.substring(0, vv.length - 1);*/
 
	
function emailvalidation(entered) {

    var email = entered;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(entered)) 
	{
   // $("#email_div").addClass("has-error");
	//document.staff_master.email.focus();
	return false;
 	}else
	{
		 //$("#email_div").removeClass("has-error");
		 return true;
	}
}
	
			
		
	
	</script>







<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"> <strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where rm_id='".$_REQUEST['report']."'"); 
	
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="report_master.php"  method="post"  name="report_masteredit">
                           
                            <input type="hidden" name="emailchk" id="emailchk" class="menuname" style="color:black" value="<?=$result_login['rm_predifinedemails']?>">        
                        	 <div class="first_form_contain">
                              <span id="flooreditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Report Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="reportname_div1" >
                                <input type="text" class="form-control reportnames" id="report1" name="report1"  placeholder="Report Name" tabindex="0"  data-toggle="tooltip" title="Report Name" value="<?=$result_login['rm_reportname']?>"></div>
                               </div>
                                 <div class="first_form_contain">
                                  <div class="form_name_cc">Report view</div>
                               	 <div class="form_textbox_cc" id="reportview_div1">
 <input type="checkbox" value="<?=$result_login['rm_reportview']?>" tabindex="5" name="reportview1"  id="reportview1" data-toggle="tooltip" title="Report view" <?php if($result_login['rm_reportview']=="Y") { ?> checked <?php } ?> ></div>
                               </div>
                                 <div class="first_form_contain">
                         	 <div class="form_name_cc">PrintA4</div>
                             	 <div class="form_textbox_cc" id="reportprinta41_div1">
 <input type="checkbox" value="<?=$result_login['rm_printa4']?>" tabindex="5" name="reportprinta41"  id="reportprinta41" data-toggle="tooltip" title="Report Print A4" <?php if($result_login['rm_printa4']=="Y") { ?> checked <?php } ?> ></div>     
                                 
                               
                               </div>
                               
                               
                                <div class="first_form_contain" id="emailcheck"  style="display:none">
                         	 <div class="form_name_cc">Email List</div>
                             	 <div class="form_textbox_cc" id="emaillist_div1" style="height:90px">
                                 
                                 
                                 <textarea style="line-height:23px;font-size:14px;width:100%;height:85px;resize:none;" name="emaillist" id="emaillist" rows="2" cols="40"><?=$result_login['rm_emaillist']?></textarea>

                               
                               </div>
                                  </div>
                               
                               
                               
                             <input type="hidden" name="reportid" id="reportid" class="menuname" style="color:black" value="<?=$result_login['rm_id']?>">        
                                 	<a href="#" id="update" ><span class="md-save newbut">Update</span></a>
                                 
                              
                                 
                                  </form>  
                                  
 <?php }} ?>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
