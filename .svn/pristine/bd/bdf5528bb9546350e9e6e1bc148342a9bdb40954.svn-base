<html lang="en"><head>
 
    <meta charset="utf-8">
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <!-- The styles -->
    <link href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    
    <link href="css/animate.min.css" rel="stylesheet">
	<link href="css/new_1.css" rel="stylesheet">
    <style>
    body{
	 -webkit-background-size: cover !important;
	  -moz-background-size: cover !important;
	   -o-background-size: cover !important;
	    background-size: cover !important;}
	#content{ margin:auto;left: 1%;right: 1%;position: absolute;margin-top:-10px;padding-top: 30px;width:440px;padding: 10px;}
	.alert {padding: 13px;margin-bottom:0px;}
	form{display:inline-block}
	.white_bg{background-color:transparent}
	.company_logo_cc{height:90px;max-width: 270px;width:auto;}
	.btn{padding: 13px 12px;}
	.kotcancel_reason_popup_new_right_cc .keys span, .top span.clear {width: 23%;height: 50px;line-height: 50px;font-size: 17px;margin: 0 1% 2% 1%;}
	.kotcancel_reason_popup_new_right_cc .keys span:hover{background-color:#d9260e !important;color:#fff !important;}
	.login-box img{max-width:230px;width:auto}
    </style>
<!-- jQuery -->
<script src="bower_components/jquery/jquery.min.js"></script>

<script>
$(function() {
    $(window).on('resize', function resize()  {
        $(window).off('resize', resize);
        setTimeout(function () {
            var content = $('#content');
            var top = (window.innerHeight - content.height()) / 2;
            content.css('top', Math.max(0, top) + 'px');
            $(window).on('resize', resize);
        }, 50);
    }).resize();
    $('#password').css("cursor", "default");
});
</script>    
    
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body  onload="disableBackButton();" style="" cz-shortcut-listen="true">
 <input type="hidden" id="logstatus" value="">
<div style="padding:0 30px" class="ch-container">
    <div class="row">
        
   <!-- <div class="row">
        <div class="col-md-12 center login-header">
        
        </div>
    </div>-->   

    <div class="row">
       
        <div id="content" class="well col-md-4 center login-box" style="top: 0px;">
        <div class="col-md-12"><img src="img/company-logo/company_logo_outer.png"></div>
         <!--<p style="margin:0">Version 2.16.53</p>-->
            
            
            <div class="col-md-12" style="height:20px;padding:2% 0;">
            	   
            </div>
            
                        	            <div class="alert alert-info" style="color:#090;padding: 5px;">
             
            </div>
            	        
        
        
                    
        <div style="padding: 5px;font-weight: 600;margin-bottom:0px;" class="alert alert-info">
             
            </div>
       
            <form style="margin-top:10px" class="form-horizontal" action="" method="post" name="loginpage">

                <fieldset style="display:block">
                    <div class="input-group input-group-lg" id="username_div">
                        <input type="hidden" name="focusedtext" id="focusedtext">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                        

                        <input style="width:80%" type="password" class="form-control directionchg" id="pin" name="pin" placeholder="CODE" maxlength="4" autofocus="true" onkeypress="return numonly(event)">
                        <span class="login_back_btn calculator_settle_back">&nbsp;</span>

                    </div>
                    
                    
					<div class="login_keyboard_cc" style="margin-top:2%;">
                    	<div class="kotcancel_reason_popup_new_right_cc" style="display:block">
                            <div class="keys settle_key" style="padding:0;">
                                <span class="calculator_settle">1</span>
                                <span class="calculator_settle">2</span>
                                <span class="calculator_settle">3</span>
                                <span class="calculator_settle">4</span>
                                <span class="calculator_settle">5</span>
                                <span class="calculator_settle">6</span>
                                <span class="calculator_settle">7</span>
                                <span class="calculator_settle">8</span>
                                <span class="calculator_settle">9</span>
                                <span class="calculator_settle">0</span>
                                 <!--<span class="calculator_settle_back">&nbsp;</span>-->
                                  <span style="width: 48%;" class="calculator_settle">Clear</span>
                            </div>
                      </div>
                    </div><!--login_keyboard_cc-->
                    
                    <div class="clearfix"></div>
                    
                    <p class="col-md-5 col-sm-5 pull-right" style="padding-right:0;margin:0">
                       <!-- <button type="submit" class="btn btn-primary">Login</button>-->
                      <a style="margin-top:5px;" href="#" class="btn btn-primary orange_back login_btn" onkeypress="if(event.keyCode=='13')return pincheck()">LOGIN</a>
                       </p>
                </fieldset>
           
                
                
            </form>
        </div>
        
        
        
        
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- language popup -->

	
    
<div class="language_overlay"></div>
<script>
            function disableBackButton(){
           history.pushState(null, null, 'login.php');
window.addEventListener('popstate', function () {
    history.pushState(null, null, 'login.php');
});
        }




            </script>
<script>

 document.onkeydown= function(ev){
                   
var keyCode = ev.keyCode || ev.which;   
    if (keyCode == 13) { 
      $('.login_btn').click();
      
       return false;
    }
   
}

  
   $(".login_btn").click(function(){
      
        var pin=$('#pin').val();   
             if(pin!=''){
       var data1="set=check_login&pin="+pin;
    
        $.ajax({
        type: "POST",
        url: "load_track.php",
        data: data1,
        success: function(data)
        {
  
      if($.trim(data)=='ok'){
          window.location.href='index.php';
      }else{
          alert('INVALID CODE');
          $('#pin').val(''); 
          $('#pin').focus(); 
      }
           
    
        }
        });
        
    }else{
        alert('ENTER YOUR CODE');
         $('#pin').focus(); 
    }
     
   });
  
  
function numonly(evt)
{
evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
       
       return false;
     
   }
   return true;
}
          //---------------------number pad
        $('.calculator_settle').click( function(event) {
           
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
		var focused=$('#focusedtext').val();
              
		var calval=($(this).text());
		
		var org=$('#'+focused).val();
             
			if(calval>=0)
			{   
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		        $('#'+focused).focus();
		
		
		
	});
        
        $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            $('#pin').focus();
        });
 
              
</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>

<script src="js/charisma.js"></script>

</body></html>