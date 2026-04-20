<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=18;


   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="cat1")){
    $cat1=$_REQUEST['item1'];
    $catid1=$_REQUEST['idofcat'];
    //$catid4=$_REQUEST['hiddf'];
    //echo $cat1,$catid1,$catid4;
    
    
    
    
    $querylang=$database->mysqlQuery("select cc_base_currency from tbl_currency_conv_rate where cc_base_currency='".$_SESSION['idrr']."' and cc_currency='".$catid1."'");
    $num_gen9  = mysqli_num_rows($querylang);
		  if($num_gen9)
		  {
    
   
    $querylang1=$database->mysqlQuery("update tbl_currency_conv_rate set cc_conversion_rate='".$cat1."' where cc_currency='".$catid1."' and cc_base_currency='".$_SESSION['idrr']."'");
        }else
    {
         $insertion['cc_base_currency'] = $_SESSION['idrr'];
         $insertion['cc_currency'] =$catid1;
          $insertion['cc_conversion_rate'] = $cat1;
          $insertid = $database->insert('tbl_currency_conv_rate', $insertion);
    }
    
    
}

         $sq_lang45=$database->mysqlQuery("select be_base_currency from  tbl_branchmaster");
            $nm_lang45= $database->mysqlNumRows($sq_lang45);
            if($nm_lang45){
		while($result_lang45  = $database->mysqlFetchArray($sq_lang45)) 
						  {
                      $currency                           =$result_lang45['be_base_currency'];
                                                  }
                }
                
                
if ( !isset($_SESSION['idrr']) ) {
    
    $_SESSION['idrr'] = $currency;
} else {
   if(isset($_REQUEST['set1'])&&($_REQUEST['set1']=="cat11")){
     
  $_SESSION['idrr']= $_REQUEST['hiddf12'];
  //echo $_REQUEST['hiddf12'] ;
 
}
}

              

$lang="";
$sql_login  =  $database->mysqlQuery("select * from tbl_currency_master where c_id='".$_SESSION['idrr']."'"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
                                          
                                          $lang= $result_login['c_name'];
                                            
                                }
                                        }







?>






<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Conversion</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
.searchlist{
	width: 96% !important;background: #f2f2f2  !important; position: absolute !important;top: 55px;z-index: 9999;padding-left: 1%;max-height:350px;overflow:auto}
</style>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
        min-height: 330px;
    height: 66vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;width:270px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
	.bnq_dtail_table td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.main_banquet_contant table td{min-height:40px !important;}
.banq_inv_right_table th{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
	.main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
	.main_banquet_form_box{margin-bottom:7px}
	.als-item a{padding: 0 10px;}
        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .als-wrapper{
         overflow-y: hidden;
         margin: 0px auto;
        height: 50px;
        white-space: nowrap;
        }
        #lista1 .als-item{    display: inline-block;float: none; height: 30px;}
        .als-wrapper::-webkit-scrollbar {
            height: 14px;
        }
        .als-container{border-bottom: 3px solid #191919 !important;}
	#left_table_scr_cc{height: 79vh;width: 99.9%;}
</style>

 

</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Currency Conversion Rate</a></li>
            		
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="mlt_language_contant_cc">
                    
                    	
                        <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                <h3 style="background: #fff;margin-bottom: 0;padding: 13px;margin-top:0">CURRENCY CONVERSION RATE<a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold " href="conversionrate.php">RESET</a></h3>
                                
             
            
                    </div>
                        </div>
                   </div>
                   
                   		<div class="main_banquet_contant_head" style="line-height: 20px;">
                        	<span style="margin: 10px 0;">Select Currency Type</span>
                            <div class="main_banquet_form_box" style="width: 50%">
                                    <div class="main_banquet_form_textbox">
                                        <select id="selectedlang" name="selectedlang" onchange="changeof()" class="main_banquet_form_textbox_input" style="border-radius: 5px;height:35px;font-size:15px;">                  
                                            <option hidden="" id="dft"><?=$lang?></option>
                                            <?php
			   $sql_login  =  $database->mysqlQuery("select * from tbl_currency_master"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
                                            $idd1=$result_login['c_id'];
                                            
					  ?>
                                                            

                <option value="<?=$idd1?>"><?=$result_login['c_name']?></option>
                  
                      
                                    <?php } } ?>
                                     
 </select>
                                    </div>
                                </div>
<!--                              <div style="margin-left:1%;width:10%;margin-top: 4px;" class="search_btn_member_invoice"><a href="#" id='submitlang'>Submit</a></div>  -->
                        </div>
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    <table class="responstable">  
                                        <thead>
                                         <tr>
                                         	<th style="min-width:50px;">Edit</th>
                                         	
                                                <th>Currency<span id="newlang"> </span></th>
                                                <th>Conversion Rate<span id="newlang"> </span></th>
                                             
                                             
                                              </tr>
                                        </thead>
                                        <tbody>
                                 
                                                   
                                           <?php  
                                            $sql_login1  =  $database->mysqlQuery("select id,currency ,conversion_rate from 
(
select cc_currency AS id,c_name as currency, r.cc_conversion_rate as conversion_rate from tbl_currency_conv_rate r 
left join tbl_currency_master c on c.c_id = r.cc_currency
where cc_base_currency ='".$_SESSION['idrr']."'
union all
select c_id AS id,c.c_name as currency,0 as conversion_rate from tbl_currency_master c where c_id != '".$_SESSION['idrr']."')t group by currency order by currency");
                                                     
				$num_login1  = $database->mysqlNumRows($sql_login1);
				if($num_login1){
					while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
					  {
                                            
                                        
                                               ?>   
                                                 <tr>
                                                     <td style="min-width:50px;">
                                                         <a href="#" style="display:block" class="edit_list text1" id="edtbtn<?=$result_login1['id']?>" onclick="edit_click('<?=$result_login1['id']?>')"  ><img src="images/edit_page.PNG"></a>
                                                         <a href="#" style="display:none" class="edit_list" id="savebtn<?=$result_login1['id']?>" onclick="save_click('<?=$result_login1['id']?>',)"  ><img src="img/save_ico.png"></a>
                                                   </td>

                                                   <td aaa="<?=$result_login1['id']?>" ><?=$result_login1['currency']?></td>
                                                   
                                               
                                               
                                               <td ><div style="display:block" id="catnameshow<?=$result_login1['id']?>"><?=$result_login1['conversion_rate']?></div>
                                                   <div id="catnameedit<?=$result_login1['id']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" onkeypress="return numonly(event)" name="catnamefield" id="catnamefield<?=$result_login1['id']?>"  > </div>
                                               </td>
                                                 </tr>
                                <?php } } ?>
                                                   
                                                    
                                      

                                         </tbody>
                                      </table>
                                    </div>

                                   

                                    

                            </div>

                            
                        </div>
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

<!---banquet_listting_edit_popup-->
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
   
function changeof(){
   
  var sl=$('#selectedlang').val();
    var hid99=sl.split("_");
   $('#newlang').html(hid99[1]);
   
   var datastringnew1="set1=cat11&hiddf12="+hid99[0];
      
       $.ajax({
        type: "POST",
        url: "conversionrate.php",
        data: datastringnew1,
        success: function(data)
        {
        

         //alert(data);
        }
    });
    location.reload();
   }
  
 
    
  
  
  function edit_click(a){
      
     var show123=$('#catnameshow'+a).html();
      $(".text1").addClass("disablegenerate");
          $('#catnameshow'+a).hide();
       $('#catnameedit'+a).show();
        $('#savebtn'+a).show();
         $('#edtbtn'+a).hide();
        $('#catnamefield'+a).val(show123);
       $('#catnamefield'+a).focus();
       
     
    }



   function save_click(b){
    
     
      
     var itemname=$('#catnamefield'+b).val();
     var fitem= itemname.trim( );
     //alert(fitem);
   //alert(fitem);
     var catsh=$('#catnameshow'+b).html();
  //     var hid=$('#selectedlang').val();
//     var hid1=hid.split("_");
        $('#catnameshow'+b).show();
       $('#catnameedit'+b).hide();
        $('#savebtn'+b).hide();
         $('#edtbtn'+b).show();
       
       var datastringnew="set=cat1&item1="+fitem+"&idofcat="+b+"&catsh="+catsh;
       
       $.ajax({
        type: "POST",
        url: "conversionrate.php",
        data: datastringnew,
        success: function(data)
        {
        

         //alert(data);
        }
    });
       
      location.reload();
       
   }
   
function numonly(catnamefield)
{
if(event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46)
            {
               var txtbx=document.getElementById(catnamefield);
               var amount = document.getElementById(catnamefield).value;
               var present=0;
               var count=0;

               if(amount.indexOf(".",present)||amount.indexOf(".",present+1));
               {
              // alert('0');
               }

              /*if(amount.length==2)
              {
                if(event.keyCode != 46)
                return false;
              }*/
               do
               {
               present=amount.indexOf(".",present);
               if(present!=-1)
                {
                 count++;
                 present++;
                 }
               }
               while(present!=-1);
               if(present==-1 && amount.length==0 && event.keyCode == 46)
               {
                    event.keyCode=0;
                    //alert("Wrong position of decimal point not  allowed !!");
                    return false;
               }

               if(count>=1 && event.keyCode == 46)
               {

                    event.keyCode=0;
                    //alert("Only one decimal point is allowed !!");
                    return false;
               }
               if(count==1)
               {
                var lastdigits=amount.substring(amount.indexOf(".")+1,amount.length);
                if(lastdigits.length>=2)
                            {
                              //alert("Two decimal places only allowed");
                              event.keyCode=0;
                              return false;
                              }
               }
                    return true;
            }
            else
            {
                    event.keyCode=0;
                    //alert("Only Numbers with dot allowed !!");
                    return false;
            }
} 
   
   
   

</script>


</body>
</html>