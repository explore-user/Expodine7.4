<?php
include('includes/session.php');		
//session_start();
include("database.class.php"); 
$database	= new Database();
$_SESSION['pagid']=2;


$_SESSION['salary_staff']=$_REQUEST['staff_id'];
$last= date('d-m-Y', strtotime('last day of this month'));
$first=date('d-m-Y', strtotime('first day of this month'))   ;

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Staff</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
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
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
            $(document).ready(function () {
             
             
  $("#datepickerfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
     changeYear: true,
	  maxDate: "+0D "
    });
    
     $("#datepickerfrom").change(function () {
         var  from=($(this).val());
        var to=$("#datepickertodt").val();
        var staff=$("#staff").val();
        if(to==""){
            var  to="";
        }
         $.post("pagination_functions.php", {value:'load_salary',from:from,to:to,staff:staff},
         function (data){
             $("#vouchpmt" ).html( data);
         

     });
          });
      $("#datepickertodt").change(function () {
             var staff=$("#staff").val();
         var  to=($(this).val());
        var from=$("#datepickerfrom").val();
         $.post("pagination_functions.php", {value:'load_salary',from:from,to:to,staff:staff},
         function (data){
             $("#vouchpmt" ).html( data);
         

     });
     });
    
        });          
</script>
<script type="text/javascript">
$(document).ready(function() {
       var staff=$("#staff").val();
	$("#vouchpmt" ).load( "pagination_functions.php?value=load_salary&staff="+staff);
	
	$("#vouchpmt").on( "click", ".pagination a", function (e){
		e.preventDefault();
                   var staff=$("#staff").val();
		  var to=$("#datepickertodt").val();
		var page = $(this).attr("data-page"); 
                 var from=$("#datepickerfrom").val();
		$("#vouchpmt").load("pagination_functions.php",{"value":'load_salary',"page":page,"from":from,"to":to,"staff":staff}, function(){ 
			
		});
		
	});
});
</script>



<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}


 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.categ_discount_popup_cc .discount_popup{    width: 370px;}
.categ_discount_popup_cc .dicount_popup_add_sec{padding: 5px}
</style>

<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">


</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
    
    
    <input  type="hidden" id="tot_salary" >
    <input type="hidden" value="<?=$first?>" id="first_date" >
    <input type="hidden" value="<?=$last?>"  id="last_date" >
    <input type="hidden" value="<?=$_SESSION['salary_staff']?>" id="staff" >
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer"></a></li>
                      <?php if(isset($_REQUEST['msg'])){ ?>
                        <div class="load_error alertsmasters"><?=$alert?></div>
                        <script >
                       $(".load_error").delay(2000).fadeOut('slow');
                        </script>
                        <?php } ?>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="cc_new_main">
                       
                     <div style="  border: 0px #B6B6B6 solid;" class="cc_new">
                       	<div  id="lista1" class="als-container">
                            <div class="pagination_voucher" style="height:auto">
                                
                            
                                <nav style="margin:2px 3px 0 0;float:right;">

                                </nav>
                      
                                <div  id="totalsalesdiv" class="search_name_box_main" style="width:100%" >
                                    <a style="" data-modal="modal-17"  href="#" onClick=" add_pop();"><div style="background-color: #ab2426;position: static" class="voucher_bill_add_btn">PAY </div></a>
                                <div style="width: 10%;"  class="search_name_box_main">
                                    <div  style="color: #fff" class="text-selection_name"></div>
                                     <div class="input-group">
                                         <input placeholder="From"  style="margin: 1px;height: 28px !important;border-radius: 5px;" autocomplete="off" type="text" class="form-control" id="datepickerfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div  style="width: 10%;" class="search_name_box_main">
                                     <div style="color: #fff" class="text-selection_name"></div>
                                     <div class="input-group">
                                         <input  placeholder="To"  style="margin: 1px;height: 28px !important;border-radius: 5px;" autocomplete="off" type="text" class="form-control" id="datepickertodt" >            
                                    </div>
                                 </div>
                                    
                                    <span onclick="goto();" style="background-color: #ab2426;border-radius: 3px;cursor: pointer;float: right;padding:3px 9px;color: #fff;margin-right: 15px;border-bottom: 3px #860608  solid ">&nbsp;&nbsp; STAFF MASTER &nbsp;&nbsp; </span>   
                            </div>
                            <?php
                              $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster  where ser_staffid='".$_SESSION['salary_staff']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                           $name=$result_login['ser_firstname'];
                    ?>
                               &nbsp;&nbsp; 
                               <span style="color:lightgrey;font-size: 15px;font-weight: bold;text-transform: uppercase;width:auto; float: left; padding: 5px; border-top: 1px #424242 solid;margin-top: 5px"><?=$result_login['ser_firstname']?> &nbsp;&nbsp; |
                               &nbsp;&nbsp;   &nbsp;&nbsp;
                                   
                                  <span> Basic Salary - <?= number_format($result_login['ser_salary'],$_SESSION['be_decimal'])?> </span>     
                                  <input type="hidden" value="<?=number_format($result_login['ser_salary'],$_SESSION['be_decimal'])?>" id="base_salary" >
                                </span>          
                                
                    <?php
                }
                }
                
                
          $sql_login1  =  $database->mysqlQuery("select sum(ts.ts_amount) as amt from tbl_staff_salary_detail ts left join tbl_staffmaster st on st.ser_staffid=ts.ts_staff_id where ts.ts_staff_id='".$_SESSION['salary_staff']."'"); 
	  $num_login1  =  $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{
                      ?>  
                                
                        <span style="display:none;color:white;font-size: 15px;font-weight: bold;text-transform: uppercase;width:auto; float: left; padding: 5px;    border-top: 1px #424242 solid;margin-top: 5px"> |  &nbsp;&nbsp;   &nbsp;&nbsp;  Total Salary Paid - <?=  number_format($result_login1['amt'],$_SESSION['be_decimal'])?></span>
                                
                           <?php
                            } }
                           ?>  
                        </div>
                        </div>
                       </div>
            
                   </div><!--cc_new-->
                   
                   <div class="col-md-12 contant_table_cc" id="vouchpmt">
  
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
 



<div class="categ_discount_popup_cc" style="display: none;">
    <div class="discount_popup" style="height:auto;bottom: inherit;top:10%">
        <div class="discount_popup_head" >SALARY - <?=$name?><a href="#"><button class="md-close_pop discount_pop_close categ_discount_cls ">x</button></a></div>
        <div class="discount_popup_conatant">
        <div class="dicount_popup_add_sec">
          
        <div class="col-sm-6"  style="margin-bottom: 5px;padding: 5px;">
        <p class="menu_filter_txt">Salary Amount  </p>
        <input type="text" id="salary" class="form-control" placeholder="Amount" maxlength="10" autofocus="" autocomplete="off" onkeypress=" return numdot(event);">
	</div>
               
        <div class="col-sm-6" style="margin-bottom: 5px;padding: 5px;">
                             <p class="menu_filter_txt">Select</p>
                             <select class="form-control" id="salary_type" >
                                 <option value="">Type</option>
                                 <option value="Salary">Salary</option>
                                  <option value="Incentive">Incentive</option>
                                   <option value="Commission">Commission</option>
                                    <option value="Advance">Advance</option>
                                     <option value="Bonus">Bonus</option>
                                    <option value="Others">Others</option>
                                 
        </select>
	</div>
            
             <div style="background-color: blue" class="ex_tax_btn search_btn_member_invoice tax_change_sub  "><a href="#" onclick="return add_pays();" >Extras</a></div>    
                 
                 
        <div id="extra_div_for_pay" style="display:none">
            
            
            
       <div class="col-sm-6"  style="margin-bottom: 5px;padding: 5px;">
        <p class="menu_filter_txt"> Amount  </p>
        <input type="text" id="extra_1" class="form-control" placeholder="Amount" maxlength="10" autofocus="" autocomplete="off" onkeypress=" return numdot(event);">
	</div>
        <div class="col-sm-6" style="margin-bottom: 5px;padding: 5px;">
                             <p class="menu_filter_txt">Select Type 1</p>
                             <select class="form-control" id="extra_type1" >
                             <option value="">Type</option>
                           
                             <option value="Incentive">Incentive</option>
                             <option value="Commission">Commission</option>
                             <option value="Advance">Advance</option>
                              <option value="Bonus">Bonus</option>
                             <option value="Others">Others</option>
        </select>
	</div>
            
           
            <div class="col-sm-6"  style="margin-bottom: 5px;padding: 5px;">
        <p class="menu_filter_txt"> Amount  </p>
        <input type="text" id="extra_2" class="form-control" placeholder="Amount" maxlength="10" autofocus="" autocomplete="off" onkeypress=" return numdot(event);">
	</div>
        <div class="col-sm-6" style="margin-bottom: 5px;padding: 5px;">
                             <p class="menu_filter_txt">Select Type 2</p>
                             <select class="form-control" id="extra_type2" >
                             <option value="">Type</option>
                            
                             <option value="Incentive">Incentive</option>
                             <option value="Commission">Commission</option>
                             <option value="Advance">Advance</option>
                              <option value="Bonus">Bonus</option>
                             <option value="Others">Others</option>
        </select>
	</div>
                     
        </div>     
                 
                 
                 
                 
                 
                 
                 
        </div>
        			
        <div class="col-sm-12 extax_btn_cc" style="border: 0">
        			
        <div style="" class="ex_tax_btn search_btn_member_invoice tax_change_sub  "><a href="#" onclick="return add_salary_full();" >Proceed</a></div><br>
        
        <div style="height:20px">
          <span id="load_error" style="color:red"></span>	   
        </div>
       
        
        
    	</div>
        			
	</div>
				 
	</div> 
  </div> 





<div class="md-overlay"></div><!-- the overlay element -->



<script src="master_style/js/modalEffects.js"></script>


<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>
<div class="md-overlay"></div>
<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
<!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script type="text/javascript">
   $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        }); 
        
 function numdot(e)
 {
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


function goto(){
    window.location.href="staff_master.php";
}




function add_pays(){
   
     $('#extra_div_for_pay').slideToggle('slow');
     $('#extra_1').val('');
      $('#extra_2').val('');
      
     
}


function add_pop(){
   $('.categ_discount_popup_cc').show();
   $("#salary").val('');
     $("#salary").focus();
}
     
     
     function add_salary_full(){
         
    	var base1=$('#base_salary').val();
        var base=base1.replace(',','');
         var id=    $("#staff").val();  
        var first1=$('#first_date').val();
      
        var f1=first1.split('-');
        var first=f1[2]+'-'+f1[1]+'-'+f1[0];
       
        var last1=$('#last_date').val();
        var l1=last1.split('-');
        var last=l1[2]+'-'+l1[1]+'-'+l1[0];
        
         $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "value=salary_check&from="+first+"&to="+last+"&id="+id,
                        
			success: function(msg)
			{
                           
                        var tot_salary1=$.trim(msg);
                     
                        $('#tot_salary').val(tot_salary1);
                        
                        if( ($("#salary").val()!="" && $("#salary_type").val()!="") || ($("#extra_1").val()!="" && $("#extra_type1").val()!="") || ($("#extra_2").val()!="" && $("#extra_type2").val()!="") ){
				
                                
                                if($("#extra_1").val()!="" && $("#extra_type1").val()==""){
                                     $('#load_error').css("display", "block");
                                     $('#load_error').text('Select Type1');	
                                     $("#load_error").delay(1500).fadeOut('slow');
                                    exit();
                                }
                                 if($("#extra_2").val()!="" && $("#extra_type2").val()==""){
                                     $('#load_error').css("display", "block");
                                     $('#load_error').text('Select Type2');	
                                     $("#load_error").delay(1500).fadeOut('slow');
                                    exit();
                                }
                         
                          
                         
                    var whole_salary=parseFloat($("#salary").val()) + parseFloat($('#tot_salary').val());
                    
                
                  
                                if( whole_salary > parseFloat(base) && $("#salary_type").val()=='Salary'){
                                     $('#load_error').css("display", "block");
                                     $('#load_error').text("Amount can't be greater than Base salary of this Month");	
                                     $("#load_error").delay(2000).fadeOut('slow');
                                     $("#salary").val('');
                                      $("#salary").focus();
                                    exit();  
                                }
                                   
                                var sal=    $("#salary").val();                    
				var type=   $("#salary_type").val();    
                                 
                                var sal1=   $("#extra_1").val();                    
				var type1=  $("#extra_type1").val();
                                 
                                var sal2=   $("#extra_2").val();                    
				var type2=  $("#extra_type2").val();
                                 
                       $.ajax({
			type: "POST",
			url: "load_div.php",
			data: "value=salary_add&salary_amount="+sal+"&s_id="+id+"&type="+type+"&sal1="+sal1+'&sal2='+sal2+"&type1="+type1+"&type2="+type2,
                        
			success: function(msg)
			{ 
				window.location.href="staff_salary_detail.php?staff_id="+id;	
                        }		
		      });  
                
                    }else{
                        
                        
                        
                       
                     $('#load_error').css("display", "block");
                     
                     if($("#salary").val()==""){
                         
                     $('#load_error').text('Enter Amount');	
                     $("#salary").val('');
                     $("#salary").focus();
                     
                     }else{
                         
                     $('#load_error').text('Select Type');	
                     
                     }  
                     
                     $("#load_error").delay(1500).fadeOut('slow');
                     
                      
                      
                     } 
                        
                        } 
                    });
       
        
      
				
                                         
					 
    } 
     
     
     
     
     $('.md-close_pop').click(function(){
          $('.categ_discount_popup_cc').hide();
          $('#extra_div_for_pay').hide();
          $("#salary").val('');
          $("#extra_1").val('');
          $("#extra_2").val('');
          
          $("#salary_type").val('');
          $("#extra_type1").val('');
          $("#extra_type2").val('');
         
     });
</script>