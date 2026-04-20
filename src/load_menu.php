<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
<link href="master_style/app.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/tabs_cont_2.css">
<!--<script src="master_style/js/modernizr.custom.js"></script>-->
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:0px !important } 
.tabs li a{width: 49.6% !important;  background-color: rgba(0, 0, 0, 0.8);  margin: 0 0.1%;}
.tabs li a:hover{background-color: rgb(163, 68, 0)}
.tabs li.current a{background-color:rgb(163, 68, 0)}
::-webkit-scrollbar {
    width: 8px;
	height:10px;
}
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
}
::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<!--<script src="mn/js/modernizr.custom.js"></script>-->
<!--<script src="js/jquery.nicescroll.min.js"></script>-->
<script src="mn/js/classie.js"></script>
<script src="mn/js/mlpushmenu.js"></script>
  <script src="tooltip/main.js" type="text/javascript"></script>
<link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
<script>
$(document).ready(function(){
	 $(".tab_edt_btn11").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var md_str   =  $(this).attr("menid");
		  var md_arr	  =	 md_str.split("_");
		  var mdval       =  md_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=delimage&mid="+idval+"&mimg="+mdval,
			success: function(msg)
			{
						$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+mdval,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
		   }
		});
    }
		});
	 $(".tab_edt_btn10").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("poid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divtakeawayrate.php",
			data: "value=deltakeaway&mid="+idval+"&portion="+bcval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divtakeawayrate.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#takeawayratetab').html(msg);
			}
		});
		   }
		});
		}
		});
                
          
                $(".tab_edt_btn13").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("poid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divroomservicerate.php",
			data: "value=delroomservice&mid="+idval+"&portion="+bcval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divroomservicerate.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#roomservicetab').html(msg);
				
			}
		});
		   }
		});
		}
		});
                
                
                       $(".tab_edt_btn14").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("poid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=delcountersale&mid="+idval+"&portion="+bcval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#countersaletab').html(msg);
				
			}
		});
		   }
		});
		}
		});  
                
                
                
                
	 $(".tab_edt_btn5").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("frid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		  var pn_str= $(this).attr("pid");
		  var pn_arr	  =	 pn_str.split("_");
		  var pnval       =  pn_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divdinein.php",
			data: "value=deldinein&mid="+idval+"&floorid="+bcval+"&portion="+pnval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divdinein.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#dinein').html(msg);
			}
		});
				
		   }
		});
		
		}
		});
   $(".tab_edt_btn1").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divcombination.php",
			data: "value=delcombination&mid="+idval+"&combnid="+bcval,
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divcombination.php",
			data: "value=loadbranch&menid="+idval,
			success: function(msg)
			{
				$('#menucombination').html(msg);
			}
		});
				
		   }
		});
    }
		});
	   $("#combi").click(function(){
		var  menuid =$("#mtest").val();
		var  combinationid =$("#menu").val();
		var combistatus=$('#combstatus');
		if(combinationid == "")
		{
			<!--alert('Plz add combination');-->
			combistatus.text('Plz add combination');
		}
       else
	   {
		 $.ajax({
                        type: "POST",
                        url: "load_divcombination.php",
                        data: "value=addcombination&combid="+combinationid+"&menuid="+menuid,
                        success: function(msg)
                        {
							combistatus.text('');
							$('#menucombination').html(msg);
                        }
                    });
	   }
	   });	 
 });
</script>
<script type="text/javascript">
 $(document).ready(function(){
	  $("#submit_dinein").click(function(){
		var  menuid =$("#mtest").val();
	    var portion=$("#dineinportion").val();
        var rate=$("#dineinrate").val();
       var area=$("#dineinfloor").val();
	   var dineinstatus=$('#dinestatus');
	if(portion == "" && rate =="" && area == "" )
	{
		  dineinstatus.text('Plz add area,<?=$_SESSION['s_portionname']?> and rate');
	}
	else if(portion == "" && rate =="" )
	{
		  dineinstatus.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	}
	 else if(portion == "" && area =="" )
	  {
		   dineinstatus.text('Plz add area and <?=$_SESSION['s_portionname']?>');
	  } 
	   else if(rate == "" && area =="" )
	  {
		  dineinstatus.text('Plz add area and rate');
	  }
	  else if(portion =="")
	  {
		  dineinstatus.text('Plz add <?=$_SESSION['s_portionname']?>');
	  }
	  else if(rate == "")
	  {
		  dineinstatus.text('Plz add rate');
	  }
	  else if(area =="")
	  {
		   dineinstatus.text('Plz add area');
	  }
	 else
	  {
		 $.ajax({
                        type: "POST",
                        url: "load_divdinein.php",
                        data: "value=adddinein&mid="+menuid+"&portion="+portion+"&rate="+rate+"&floor="+area,
                        success: function(msg)
                        {
						 dineinstatus.text('');
							$('#dinein').html(msg);
                        }
                    });
	  }
	   });	
	 $(".tab_edt_btn2").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divpreference.php",
			data: "value=delpreference&mid="+idval+"&prefrncid="+bcval,
			success: function(msg)
			{
					$('#menupreference').html(msg);
		   }
		});
			$.ajax({
			type: "POST",
			url: "load_divpreference.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menupreference').html(msg);
			}
		});
    }
		});
	   $("#submit_preference").click(function(){
		// Get ID of the link to delete
		var  menuid =$("#mtest").val();
		var  preferenceid =$("#preference").val();
var prfstatus=$('#prefstatus');
		if(preferenceid =='')
		{
		<!--	alert('Plz add preference');-->
			prfstatus.text('Plz add preference');
		}
		else
		{
		//alert(menuid);
		//alert(slno);
		 $.ajax({
                        type: "POST",
                        url: "load_divpreference.php",
                        data: "value=addpreference&prefid="+preferenceid+"&menuid="+menuid,
                        success: function(msg)
                        {
							prfstatus.text('');
							$('#menupreference').html(msg);
                        }
                    });
		}
     
	   });	      
	     $("#submit_ingredient").click(function(){
		// Get ID of the link to delete
		var  menuid =$("#mtest").val();
		var  ingredientid =$("#ingredient").val();
		var ingrstatus=$('#ingstatus');
	  	if(ingredientid =="")
		{
		<!--	alert('Plz add ingredients');-->
				ingrstatus.text('Plz add ingredients');
		}
		else
		{
		 $.ajax({
                        type: "POST",
                        url: "load_divingredient.php",
                        data: "value=addingredient&ingrid="+ingredientid+"&menuid="+menuid,
                        success: function(msg)
                        {
							ingrstatus.text('');
							$('#menuingredient').html(msg);
                           
                        }
                    });
		}
	   });	      
	  $(".tab_edt_btn4").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divingredient.php",
			data: "value=delingredient&mid="+idval+"&ingid="+bcval,
			success: function(msg)
			{
					$('#menuingredient').html(msg);
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divingredient.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menuingredient').html(msg);
			}
		});
	}
	   });
	  $("#takeaway").click(function(){
		var  menuid =$("#mtest").val();
	    var portion=$("#takeawayportion").val();
        var rate=$("#takeawayrate").val();
		var takestatus=$('#takeawaystatus');
	<!--mestatus.text('Image uploaded successfully!');-->
	  	 if(portion =="" && rate==""  )
	   {
		   	takestatus.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(portion =="")
	   {
			takestatus.text('Plz add <?=$_SESSION['s_portionname']?>');
	   }
	   else if(rate=="" )
	   {
		  	takestatus.text('Plz add rate');
	   }
           
else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divtakeawayrate.php",
                        data: "value=addtakeaway&mid="+menuid+"&portion="+portion+"&rate="+rate,
                        success: function(msg)
                        {
							takestatus.text('');
							$('#takeawayratetab').html(msg);
                        }
                    });
}
     
	   });	
           
           
           
           
          $("#roomservice").click(function(){
		var  menuid =$("#mtest").val();
	    var portion=$("#rmserviceportion").val();
        var rate=$("#rmservicerate").val();
		var roomstatus=$('#roomservicestatus');
	<!--mestatus.text('Image uploaded successfully!');-->
	  	 if(portion =="" && rate==""  )
	   {
		   	takestatus.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(portion =="")
	   {
			takestatus.text('Plz add <?=$_SESSION['s_portionname']?>');
	   }
	   else if(rate=="" )
	   {
		  	takestatus.text('Plz add rate');
	   }
           
else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divroomservicerate.php",
                        data: "value=addroomservice&mid="+menuid+"&portion="+portion+"&rate="+rate,
                        success: function(msg)
                        {
							takestatus.text('');
							$('#roomservicetab').html(msg);
                        }
                    });
}
     
	   });	  
           
           
           
       $("#countersale").click(function(){
		var  menuid =$("#mtest").val();
	    var portion=$("#countersaleportion").val();
        var rate=$("#countersalerate").val();
		var countertatus=$('#countersalestatus');
	<!--mestatus.text('Image uploaded successfully!');-->
	  	 if(portion =="" && rate==""  )
	   {
		   	takestatus.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(portion =="")
	   {
			takestatus.text('Plz add <?=$_SESSION['s_portionname']?>');
	   }
	   else if(rate=="" )
	   {
		  	takestatus.text('Plz add rate');
	   }
           
else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divcountersale.php",
                        data: "value=addcountersale&mid="+menuid+"&portion="+portion+"&rate="+rate,
                        success: function(msg)
                        {
							takestatus.text('');
							$('#countersaletab').html(msg);
                        }
                    });
}
     
	   });	    
           
           
   
           
	 $("#submit_nutrition").click(function(){
		var  menuid =$("#mtest").val();
	    var nutrition=$("#nutrition").val();
        var nutrival=$("#value").val();
var nutstatus=$('#nutrstatus');
 if(nutrition == "" && nutrival == "" )
{
<!--	alert('Plz add nutrition facts');-->
		nutstatus.text('Plz add nutrition facts');
}
else if(nutrival =="")
{
	<!--alert('Plz add nutrition value');-->
	nutstatus.text('Plz add nutrition value');
}
else if(nutrition == "")
{
	<!--alert('Plz add nutrition'); -->
	nutstatus.text('Plz add nutrition');
}

else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divnutrition.php",
                        data: "value=addnutrition&mid="+menuid+"&nutritionname="+nutrition+"&nutritionvalue="+nutrival,
                        success: function(msg)
                        {
							$('#menunutrition').html(msg);
                           	nutstatus.text('');
                        }
                    });
}
	   });	
	    $(".tab_edt_btn3").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("pid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divnutrition.php",
			data: "value=delnutrition&mid="+idval+"&nid="+bcval,
			success: function(msg)
			{
					$('#menunutrition').html(msg);
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divnutrition.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menunutrition').html(msg);
			}
		});
	
	}
	   });
 });
</script>
<div class="md-overlay"></div><!-- the overlay element -->
<!--<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>-->
<!--<script src="master_style/menu/js/app.js"></script> -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<!--<script src="master_style/js/menu/app.js"></script>-->
<!--<script>!window.jQuery && document.write(unescape('%3Cscript src="javascript/jquery-1.7.2.min.js"%3E%3C/script%3E'))</script>-->
<script src="javascript/demo.js"></script>
<script src="javascript/modernizr.custom.34807.js"></script>
<script> if(!Modernizr.csstransforms3d) document.getElementById('information').style.display = 'block'; </script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script>
$(document).ready(function() {
    $("#content div").hide(); // Initially hide all content
    $("#tabs li:first").attr("id","current"); // Activate first tab
    $("#content div:first").fadeIn(); // Show first tab content
    $('#tabs a').click(function(e) {
       // e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
    });
});
</script>
<script src="master_style/js/basicTabs-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#tabwrap').basicTabs();
	});
	</script>
<!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
<!--<script type="text/javascript" src="js/Ajaxfileupload-jquery-1.3.2.js" ></script>-->
<link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!-- MULTIPLE UPLOADING SCRIPT ENDS HERE -->
 <script type="text/javascript" >
	$(function(){
	    var menu=$('#mtest').val();
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadGalFile.php?upid=<?=$upload_id?>&menuid='+menu,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				<!-- if (! (ext && /^(jpg|png|jpeg|gif|bmp|tif)$/.test(ext))){ -->
                    // extension is not allowed 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					/*mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					return false; */
			<!--	}-->
				mestatus.html('<font color="#ff0000">Please wait...</font> <img src="resources/images/ajax-loader.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				//mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				var details	= response.split("|");
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
				} else{
					<!--mestatus.text('Photo Uploaded Error!');
					mestatus.text('Image uploaded successfully!');
				}
				
					$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+menu,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
			}
		});
			}
		});
	});
</script>
 <?php
//session_start();
 ob_start();
 //include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
if(!isset($_SESSION['upload_id']))
{
$_SESSION['upload_id'] = $database->getEpoch();
}
$upload_id		= $_SESSION['upload_id'];
if($_REQUEST['value']=="loadmenu"){
	 $mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	 $sql_login  =  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$mid."'"); 
	 $num_cat_s  = $database->mysqlNumRows($sql_login);
	if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
			{
					$searchname=$result_cat_s['mr_menuname'];
			}
	} 
	  ?>
                                 <input type="hidden" name="mtest" id="mtest" value="<?=$_REQUEST['mid']?>" />
                        	<div class="col-lg-12 col-md-12 min-height nopadding">
                            	<div class="text_displaying_contain" >
									<div class="master_page_tab_cc">
                                        <div class="tab_body">
                                        <ul id="tabs">
                                            <li><a href="#" title="tab1">Rate Master</a></li>
                                            <li><a href="#" title="tab2">Menu combination</a></li>
                                            <li><a href="#" title="tab3">Menu Images</a></li>
                                            <li><a href="#" title="tab4">Menu Preferences</a></li> 
                                             <li><a href="#" title="tab5">Menu Nutrition</a></li>   
                                              <li><a href="#" title="tab6">Ingredient Master</a></li>      
                                        </ul>
                                         <div   class="module_cat_head menu_master_right_heading_check">                    
                                                    <span style="font-size: 18px;"> <?=$searchname ?></span>
                                                    </div>
                                        <div id="content"> 
                                            <div  id="tab1" ><!--1sttab-->
                                            <span id="tabwrap">
                                                <ul style="margin:0;" class="tabs">
                                                    <li class="current"><a href="#home">Dine In</a></li>
                                                    <li><a href="#about">Take Away</a></li>
                                                    <li><a href="#room">Room Services</a></li>
                                                    <li><a href="#counter">Counter Sale</a></li>
                                                </ul>
                                                <span class="tab_content">
                                                    <span id="home" class="current"  >
                                                   <span class="tab_sub_head" style="">
                                                     <span class="form-group" style="width:90% !important;">
                                                    <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:none;">
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Area" id="dineinfloor" name="dineinfloor" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Area">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                                    </span>
                                                    <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:none;">
                                                            <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											 
                     ?>
                                        <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="dineinportion" name="dineinportion" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="<?=$_SESSION['s_portionname']?>">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                                    </span>
                                                    <span class="col-sm-4 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="dineinrate" name="dineinrate" placeholder="Rate">
                                                    </span>
                                                    
                                                    </span>
                                           
                                                <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_dinein">GO</a></span>
                                                </span>
                                                 <span id="dinestatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;" ></span>   
                                            </span><!---->
                    
											<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="dinein" >
                                                  <thead>
                                                  <tr>
                                                  <th>
                                              Area
                                                  </th>
                                                  <th><?=$_SESSION['s_portionname']?></th>
                                                  <th>Rate</th>
                                                  
<th>Delete</th>                                                 
                                                  </tr>
                                                </thead>
                                                  <tbody>
                                                     <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
					$portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);
?>
    <tr>
             <td width="38%"><?=$floor_name['fr_floorname']?></td>
              <td width="38%"><?=$portion_name['pm_portionname']?></td>
               <td width="12%"><?=$result_cat_s['mmr_rate']?></td>
            <td> <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?> " frid="b_<?=$result_cat_s['mmr_floorid']?>" pid="p_<?=$result_cat_s['mmr_portion']?>"   ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
            </tbody>
                         </table>                                             
                                                </span>  <!--tab_table_cont_cc-->
                                                    </span>
                                                       </span>
                                                    <span style="display:none" id="about">
                                                      <span class="tab_sub_head" style="">
                                                     <span class="form-group" style="  width: 33% !important;float: left;margin-right: 5px;">
                                                                            <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="takeawayportion" name="takeawayportion" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="<?=$_SESSION['s_portionname']?>">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                                    </span>
                                                    
                                                     <span class="col-sm-3 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="takeawayrate" name="takeawayrate" placeholder="Rate">
                                                    </span>
                                                <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="takeaway" >GO</a></span>
                                                </span>
                                                <span id="takeawaystatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;" ></span>          
                                            </span><!---->
												<span class="tab_table_cont_cc" >
                                                 <table class="responstable" id="takeawayratetab">
                                                 <thead>
                                                  <tr>
                                                    <th><?=$_SESSION['s_portionname']?></th>
                                                    <th>Rate</th>
                                                    <th>Delete</th>
                                                  </tr>
                                                  </thead>
                                                <tbody>
                                                    <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
?>
    <tr>
              <td width="38%"><?=$portion_name['pm_portionname']?></td>
               <td width="12%"><?=$result_cat_s['mta_rate']?></td>
            <td> <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
               <input type="hidden" name="mtest" id="mtest" value="<?=$mid?>" />
          </tr>

  <?php $k++;}} ?>
                                                </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                </span>
                                                
  
                                                
                                   <span style="display:none" id="room">
                                                      <span class="tab_sub_head" style="">
                                                     <span class="form-group" style="  width: 33% !important;float: left;margin-right: 5px;">
                                                                            <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="rmserviceportion" name="rmserviceportion" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="<?=$_SESSION['s_portionname']?>">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                                    </span>
                                                    
                                                     <span class="col-sm-3 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="rmservicerate" name="rmservicerate" placeholder="Rate">
                                                    </span>
                                                <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="roomservice" >GO</a></span>
                                                </span>
                                                <span id="roomservicetatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;" ></span>          
                                            </span><!---->
												<span class="tab_table_cont_cc" >
                                                 <table class="responstable" id="roomservicetab">
                                                 <thead>
                                                  <tr>
                                                    <th><?=$_SESSION['s_portionname']?></th>
                                                    <th>Rate</th>
                                                    <th>Delete</th>
                                                  </tr>
                                                  </thead>
                                                <tbody>
                                                    <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_roomservice where mrs_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$portion_name=$database->show_portion_ful_details($result_cat_s['mrs_portion']);
?>
    <tr>
              <td width="38%"><?=$portion_name['pm_portionname']?></td>
               <td width="12%"><?=$result_cat_s['mrs_rate']?></td>
            <td> <a class="tab_edt_btn13" href="#" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
               <input type="hidden" name="mtest" id="mtest" value="<?=$mid?>" />
          </tr>

  <?php $k++;}} ?>
                                                </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                </span>
                                                
                                                
                                                
                                          <span style="display:none" id="counter">
                                                      <span class="tab_sub_head" style="">
                                                     <span class="form-group" style="  width: 33% !important;float: left;margin-right: 5px;">
                                                                            <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="countersaleportion" name="countersaleportion" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="<?=$_SESSION['s_portionname']?>">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pm_id']?>"><?=$result_kot['pm_portionname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>
                                                    </span>
                                                    
                                                     <span class="col-sm-3 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="countersalerate" name="countersalerate" placeholder="Rate">
                                                    </span>
                                                <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="countersale" >GO</a></span>
                                                </span>
                                                <span id="countersalestatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;" ></span>          
                                            </span><!---->
												<span class="tab_table_cont_cc" >
                                                 <table class="responstable" id="countersaletab">
                                                 <thead>
                                                  <tr>
                                                    <th><?=$_SESSION['s_portionname']?></th>
                                                    <th>Rate</th>
                                                    <th>Delete</th>
                                                  </tr>
                                                  </thead>
                                                <tbody>
                                                    <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
?>
    <tr>
              <td width="38%"><?=$portion_name['pm_portionname']?></td>
               <td width="12%"><?=$result_cat_s['mrc_rate']?></td>
            <td> <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
               <input type="hidden" name="mtest" id="mtest" value="<?=$mid?>" />
          </tr>

  <?php $k++;}} ?>
                                                </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                </span>  
                                                
                                                
           
                                                
                                               </span><!--about-->
<!--                                              </span>-->
                                            </div><!--ending-->
                                                <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster INNER JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid INNER JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
	 ?>
                     <div id="tab2" >
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:none;">
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_menumaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                        <select data-placeholder="Enter Combination" id="menu" name="menu" data-rel="chosen" title="Combination" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Combination">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['mr_menuid']?>"><?=$result_kot['mr_menuname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>                     
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="combi">GO</a></span>
                                                  </span>
                                                  
                                                     <span id="combstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>         
                                             
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menucombination"  >
                                                   <thead>
                                          <tr>
                                            <th width="30%">Combination</th>
                                            <th width="10%">Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
											
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menucombination where mn_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					$menu_name=$database->show_menu_ful_details($result_cat_s['mn_menucombid']);
?>
    <tr>
            <td width="75%"><?=$menu_name['mr_menuname']?></td>
                 <td> <a class="tab_edt_btn1" href="#" id="m_<?=$result_cat_s['mn_menuid']?>" pid="b_<?=$result_cat_s['mn_menucombid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   <input type="hidden" name="mtest" id="mtest" value="<?=$mid?>" />
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>
                                            <?php }}?>
                                            <div id="tab3">
  <input type="hidden" name="upload_id" value="<?=$_SESSION['upload_id']?>" />   
              <div class="branch_listing_table load_tables2" id="menuimage1" style="display:block !important">
                            	<table width="100%" border="0" cellspacing="0">
                                <thead>
                                          <tr>
                                            <th width="20%">Image</th>
                                            <th width="10%">Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
										
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuimages where mes_menuid='".$mid."'");
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
              <td><?php if($result_cat_s['mes_imagethumb']) { ?><a href="<?=$result_cat_s['mes_imagethumb']?>" class="preview">View</a><?php }else{echo "
NULL";} ?></td>  
           <td> <a class="tab_edt_btn11" href="#" id="m_<?=$result_cat_s['mes_imagename']?>" menid="b_<?=$result_cat_s['mes_menuid']?>" ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                    </table>	
                            </div><!--tab_list_cc-->

                                             <span id="me" class="styleall">Upload Image</span> <span id="mestatus" style="padding-left:20px; padding-top:9px; float:left; color:#615c86; font-weight:bold;" ></span>
</div>
                              <div id="tab4" >
                                          <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:none;">
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_preferencemaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
                     ?>
                                        <select data-placeholder="Enter Preference" id="preference" name="preference" data-rel="chosen" title="Preference" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Preference">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['pmr_id']?>"><?=$result_kot['pmr_name']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>                     
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_preference">GO</a></span>
                                                  </span>
                                                      <span id="prefstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>          
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menupreference"  >
                                                   <thead>
                                          <tr>
                                            <th width="30%">Preference</th>
                                            <th width="10%">Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuprefmaster where mpr_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
						$menu_name=$database->show_prefernce_ful_details($result_cat_s['mpr_prefeernce']);
?>
    <tr>
            <td width="75%"><?=$menu_name['pmr_name']?></td>
                 <td>  <a class="tab_edt_btn2" href="#" id="m_<?=$result_cat_s['mpr_menuid']?>" pid="b_<?=$result_cat_s['mpr_prefeernce']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
                   <input type="hidden" name="mtest" id="mtest" value="<?=$mid?>" />
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>
                                            
                                            <div id="tab5">
                                                 <span class="col-sm-3 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="nutrition" name="nutrition" placeholder="Nutrition">
                                                    </span>
                                                   
                                                <span class="col-sm-3 no-padding" style="display:inline-block;float:none;">
                                                         <input type="text" class="form-control" id="value" name="value" placeholder="Value">
                                                    </span>
                                                   
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_nutrition" >GO</a></span>
                                                </span>
                                                    <span id="nutrstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>          
                                                
                                                    	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menunutrition"  >
                                                   <thead>
                                          <tr>
                                            <th width="30%">Nutrition</th>
                                           <th width="30%">Value</th>
                                            <th width="10%">Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
											  //`mrd_menuid`, `mrd_branch`, `mrd_status`
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menunutitionfacts where mnf_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
            <td width="75%"><?=$result_cat_s['mnf_nutrition']?></td>
            
            <td><?=$result_cat_s['mnf_value']?></td>
                 <td> <a class="tab_edt_btn3" href="#" id="m_<?=$result_cat_s['mnf_menuid']?>" pid="b_<?=$result_cat_s['mnf_nutrition']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>
                                            <div id="tab6">
                                              <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:none;">
                                                                   <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_ingredientmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
										
                     ?>
                                        <select data-placeholder="Enter Ingredient" id="ingredient" name="ingredient" data-rel="chosen" title="Ingredient" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                        <option value=""></option>
                                         <optgroup label="Ingredient">
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ir_ingredientid']?>"><?=$result_kot['ir_ingredientname']?></option>
                                    <?php } ?> 
                                         </optgroup>
                                    	 </select>
                                         <?php } ?>             
                                                    </span>
                                             <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: none;">
                                                    <span class="search_btn_member_invoice"><a href="#" id="submit_ingredient">GO</a></span>
                                                </span>
                                                
                                                 <span id="ingstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>    
                                                	<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="menuingredient"  >
                                                   <thead>
                                          <tr>
                                            <th width="30%">Ingredients</th>
                                            <th width="10%">Delete</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                           <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuingredients where ms_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
				
					$ingredient_name=$database->show_ingredient_ful_details($result_cat_s['ms_ingridentid']);
?>
    <tr>
            <td width="75%"><?=$ingredient_name['ir_ingredientname']?></td>
            
                 <td> <a class="tab_edt_btn4" href="#" id="m_<?=$result_cat_s['ms_menuid']?>" pid="b_<?=$result_cat_s['ms_ingridentid']?>"><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
                                              </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                            </div>
                                    </div>
                                           	    
                                </div><!--form_contain_cc-->
                            </div> 
                        </div><!--left_container-->
                       
                    </div><!--middle_container-->
      <?php }  ob_flush();?>  
