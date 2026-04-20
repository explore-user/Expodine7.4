<?php

    include('../includes/session.php');		
    include("../database.class.php"); 
    $database	= new Database();

  $_SESSION['menuidselect']=$_REQUEST['menu'];

  $sql_login  =  $database->mysqlQuery("select mr_menuid,manual_barcode,mr_unit_type,mr_menuname,mr_rate_type,mr_base_unit from "
  . " tbl_menumaster where mr_menuid='".$_SESSION['menuidselect']."'"); 
  $num_cat_s  = $database->mysqlNumRows($sql_login);
  if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
                          $searchid_mn=$result_cat_s['mr_menuid'];
			  $searchname=$result_cat_s['mr_menuname'];
                          $manual_barcode=$result_cat_s['manual_barcode'];
                          $search_menurate_type=$result_cat_s['mr_rate_type'];
                          $search_menubase_unit=$result_cat_s['mr_base_unit'];
                          $search_menu_unittype=$result_cat_s['mr_unit_type'];
	  }			
} 
else
{ 
  $searchid_mn='';
  $searchname="";
  $search_menurate_type="";
  $search_menubase_unit="";
  $search_menu_unittype='';
}


    $menubase_unit='';
    $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$search_menubase_unit."'"); 
    $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
    if($num_baseunit){
      while($result_baseunit  = $database->mysqlFetchArray($sql_baseunit)) 
              {
                    $menubase_unit=$result_baseunit['bu_name'];

              }			
    } 


?>

<script>
$(document).ready(function(){
    
    
   $(document).keyup(function (e) {
      
        if ($("#di_menu_rate").is(":focus") && (e.keyCode == 13)) {
          
            
              var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
		var  menuid =$("#dineinvalue").val();
	        var portion=$("#dineinportion").val();
                var rate=$("#dineinrate").val();
                var ratetype=$("#diportionselect").val();
                var barcode=$("#dibarcode").val();
                
                var di_menu_rate=$("#di_menu_rate").val();
                var di_tax_value=$("#di_tax_value").val();
                var di_tax_amount=$("#di_tax_amount").val();
               
                if(ratetype=='Unit')
                {
                   packloose=$('#dipackloose').val();
                   weight=$('#diweight').val();
                   unit=$('#dikglit').val();
                   baseunit=$('#dibaseunit').val();
                }
                
        var area=$("#dineinfloor").val();
        var alphanumers = /^[0-9. ]+$/; 
	var msgstatus=$('#status');
        
	if(ratetype=='Portion' && portion == "" && rate =="" && area == "" )
	{
		msgstatus.text(' Add area,<?=$_SESSION['s_portionname']?> and rate');
	}
	else if(ratetype=='Portion' && portion == "" && rate =="" )
	{
		  msgstatus.text(' Add <?=$_SESSION['s_portionname']?> and rate');
	}
	 else if(ratetype=='Portion' && portion == "" && area =="" )
	  {
		   msgstatus.text(' Add area and <?=$_SESSION['s_portionname']?>');
	  } 
	   else if(ratetype=='Portion' && rate == "" && area =="" )
	  {
		     msgstatus.text(' Add area and rate');
	  }
	  else if(ratetype=='Portion' && portion =="")
	  {
		   msgstatus.text(' Add <?=$_SESSION['s_portionname']?>');
	  }
	  
	  else if(area =="")
	  {
		     msgstatus.text('Plz add area');
	  }
         
          else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msgstatus.text(' Add weight');
          }
          else if(rate == "")
	  {
		   msgstatus.text(' Add rate');
	  }
          else if (!alphanumers.test($("#dineinrate").val())){
              
                 msgstatus.text('Invalid Rate');
                 
             }
          
	 else
	  {
		        $.ajax({
                        type: "POST",
                        url: "load_divdinein.php",
                        data: "value=adddinein&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&floor="+area+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&di_menu_rate="+di_menu_rate+"&di_tax_value="+di_tax_value+"&di_tax_amount="+di_tax_amount,    
                        success: function(msg)
                        {   
 
			   msgstatus.text('');
			   $('#dinein').html(msg);
                            		
                           $('#di_menu_rate').val('');
                           $('#di_tax_value').val('');
                           $('#di_tax_amount').val('');	
                           $('#dineinrate').val('');	
                           $('#dibarcode').val('');
                           
                        }
                       });
	  }
            
        }

        if ($("#ta_menu_rate").is(":focus") && (e.keyCode == 13)) {
        
             
           
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
                 
                var msg2=$('#takestatus');
                var  menuid =$("#takeawayvalue").val();
                var portion=$("#takeawayportion").val();
                var ratetype=$("#taportionselect").val();
                var barcode=$("#tabarcode").val();
                var food=$("#ta_food").val();
                
                
                 var ta_menu_rate=$("#ta_menu_rate").val();
                 var ta_tax_value=$("#ta_tax_value").val();
                 var ta_tax_amount=$("#ta_tax_amount").val();
                
                 $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
                   if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){
                
                
                if(ratetype=='Unit')
                {
                   packloose=$('#tapackloose').val();
                   weight=$('#taweight').val();
                   unit=$('#takglit').val();
                   baseunit=$('#tabaseunit').val();
                }
                
                var rate=$("#takeawayrate").val();
                var alphanumers = /^[0-9. ]+$/; 
      
	 if(ratetype=='Portion' && portion =="" && rate==""  )
	   {
		   msg2.css("display","block");
		   msg2.text(' Add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(ratetype=='Portion' && portion =="")
	   {
		     msg2.css("display","block");
		     msg2.text(' Add <?=$_SESSION['s_portionname']?>');
	   }
          else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msg2.text('Plz add weight');
          }
	  else if(rate=="" )
	  {
		     msg2.css("display","block");
		     msg2.text(' Add rate');
                      
	  }
          else if (!alphanumers.test($("#takeawayrate").val())){
                 msg2.text('Invalid Rate');
                
          }
          else if (food==''){
                  msg2.text('Select Online Partner');
               
          }
          
        else
        {
		        $.ajax({
                        type: "POST",
                        url: "load_divtakeawayrate.php",
                        data: "value=addtakeaway&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&food="+food+"&ta_menu_rate="+ta_menu_rate+"&ta_tax_value="+ta_tax_value+"&ta_tax_amount="+ta_tax_amount,
                        success: function(msg)
                        {  
                            
                        msg2.text('');
			$('#takeawayratetab').html(msg);
                        $("#ta_menu_rate").val('');
                        $("#ta_tax_value").val('');
                        $("#ta_tax_amount").val('');
                        $("#takeawayrate").val('');
               			  
                        }
                    });
    }

    }else{
    
       msg2.css("display","block");
       msg2.text(' BARCODE ALREADY EXIST');
       
    }


    } });
           
           
           
        }


        if($("#cs_menu_rate").is(":focus") && (e.keyCode == 13)) { 

                //$("#countersale").click(); 
            
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
                 
                var msg3=$('#counterstatus');
                var  menuid =$("#countersalevalue").val();
	        var portion=$("#countersaleportion").val();
                var ratetype=$("#csportionselect").val();
                var barcode=$("#csbarcode").val();
                
               var cs_plu_rate=$("#cs_menu_rate").val();
               var cs_plu_tax=$("#cs_menu_tax_amt").val();
               var cs_menu_tax=$("#cs_menu_tax").val();
                 
                        $.ajax({
                        type: "POST",
                        url: "load_counter_sales.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
                if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){
                
                if(ratetype=='Unit')
                {
                   packloose=$('#cspackloose').val();
                   weight=$('#csweight').val();
                   unit=$('#cskglit').val();
                   baseunit=$('#csbaseunit').val();
                }
            
       var rate=$("#countersalerate").val();
       var alphanumers = /^[0-9. ]+$/; 
      
	 if(ratetype=='Portion' && portion =="" && rate==""  )
	   {
		   msg3.css("display","block");
		   msg3.text('Add Portion and Rate');
	   }
	   else if(ratetype=='Portion' && portion =="")
	   {
		      msg3.css("display","block");
		     msg3.text('Add Portion');
	   }
           else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msg3.text('Pls add weight');
          }
	   else if(rate=="" )
	   {
		      msg3.css("display","block");
		     msg3.text('Add rate');
                      
	   }
           else if (!alphanumers.test($("#countersalerate").val())){
               msg3.text('Invalid Rate');
                
           }
          
    else
    {
		 $.ajax({
                        type: "POST",
                        url: "load_divcountersalerate.php",
                        data: "value=addcountersale&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&cs_plu_rate="+cs_plu_rate+"&cs_plu_tax="+cs_plu_tax+"&cs_menu_tax="+cs_menu_tax,
                        success: function(msg)
                        {
						
                        msg3.text('');	
			$('#countersaletab').html(msg);
                        $("#cs_menu_rate").val('');
                        $("#cs_menu_tax_amt").val('');
                        $("#cs_menu_tax").val('');
                        }
                    });
    }

    }else{

                       $('#counterstatus').css("display","block");
                       $('#counterstatus').text('Barcode Already Exists');
                       $("#counterstatus").delay(1500).fadeOut('slow');
    }

    } });
            

     }
    
   });
    
    
    
    $('#csbarcode').bind('keypress', function (event) {
        
        var regex = new RegExp("^[a-zA-Z0-9,\b]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    
   });
    
    
/******************** Popup Close starts *********************  */     

    $('.md-close_pop').click( function() {  
        
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
			  $('.mynewpopupload').empty();
    });
    
/***************************************  Popup Close ends *******************  */

/******************************Dinein Clicks start***************/           
                
  $("#submit_dinein").click(function(){
                 
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
		var  menuid =$("#dineinvalue").val();
	        var portion=$("#dineinportion").val();
                var rate=$("#dineinrate").val();
                var ratetype=$("#diportionselect").val();
                var barcode=$("#dibarcode").val();
                
                var di_menu_rate=$("#di_menu_rate").val();
                var di_tax_value=$("#di_tax_value").val();
                var di_tax_amount=$("#di_tax_amount").val();
               
                if(ratetype=='Unit')
                {
                   packloose=$('#dipackloose').val();
                   weight=$('#diweight').val();
                   unit=$('#dikglit').val();
                   baseunit=$('#dibaseunit').val();
                }
                
        var area=$("#dineinfloor").val();
        var alphanumers = /^[0-9. ]+$/; 
	var msgstatus=$('#status');
        
	if(ratetype=='Portion' && portion == "" && rate =="" && area == "" )
	{
		msgstatus.text(' Add area,<?=$_SESSION['s_portionname']?> and rate');
	}
	else if(ratetype=='Portion' && portion == "" && rate =="" )
	{
		  msgstatus.text(' Add <?=$_SESSION['s_portionname']?> and rate');
	}
	 else if(ratetype=='Portion' && portion == "" && area =="" )
	  {
		   msgstatus.text(' Add area and <?=$_SESSION['s_portionname']?>');
	  } 
	   else if(ratetype=='Portion' && rate == "" && area =="" )
	  {
		     msgstatus.text(' Add area and rate');
	  }
	  else if(ratetype=='Portion' && portion =="")
	  {
		   msgstatus.text(' Add <?=$_SESSION['s_portionname']?>');
	  }
	  
	  else if(area =="")
	  {
		     msgstatus.text('Plz add area');
	  }
         
          else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msgstatus.text(' Add weight');
          }
          else if(rate == "")
	  {
		   msgstatus.text(' Add rate');
	  }
          else if (!alphanumers.test($("#dineinrate").val())){
              
                 msgstatus.text('Invalid Rate');
                 
             }
          
	 else
	  {
		 $.ajax({
                        type: "POST",
                        url: "load_divdinein.php",
                        data: "value=adddinein&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&floor="+area+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&di_menu_rate="+di_menu_rate+"&di_tax_value="+di_tax_value+"&di_tax_amount="+di_tax_amount,    
                        success: function(msg)
                        {   
 
					msgstatus.text('');
					$('#dinein').html(msg);
                            		
                           $('#di_menu_rate').val('');
                           $('#di_tax_value').val('');
                           $('#di_tax_amount').val('');	
                           $('#dineinrate').val('');	
                           $('#dibarcode').val('');
                           
                        }
                    });
	  }
	   });
           
           
    $(".tab_edt_btn5").click(function(e){
    
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
                        var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        //alert(dinein_data[5]);
                        var  menuid1 =$("#dineinvalue").val();
                        var portion=$("#dineinportion").val();
                        
		        $.ajax({
			type: "POST",
			url: "load_divdinein.php",
			data: "value=deldinein&mid="+menuid1+"&portion="+dinein_data[2]+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[3]+"&floor="+dinein_data[1]+"&packloose="+dinein_data[7]+"&unit="+dinein_data[5]+"&baseunit="+dinein_data[4]+"&weight="+dinein_data[6]+"&barcode="+dinein_data[8],
			success: function(msg)
			{
				$.ajax({
                                type: "POST",
                                url: "load_divdinein.php",
                                data: "value=loadbranch&menid="+menuid1,
                                success: function(msg)
                                {
                                        $('#dinein').html(msg);
                                }
		});
		   }
		});
		}
     });
        
        
    $("#update_dinein").click(function(){
                
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
		var  menuid =$("#dineinvalue").val();
                var portion=$("#dineinportion").val();
                var rate=$("#dineinrate").val();
                var area=$("#dineinfloor").val();
                var ratetype=$("#diportionselect").val();
                var barcode=$("#dibarcode").val();
                
                
                var di_menu_rate=$("#di_menu_rate").val();
                var di_tax_value=$("#di_tax_value").val();
                var di_tax_amount=$("#di_tax_amount").val();
               
                if(ratetype=='Unit')
                {
                   packloose=$('#dipackloose').val();
                   weight=$('#diweight').val();
                   unit=$('#dikglit').val();
                   baseunit=$('#dibaseunit').val();
                }
                
           var alphanumers = /^[0-9. ]+$/; 
	   var msgstatus=$('#status');

          if(rate == "")
	  {
		   msgstatus.text('Plz add rate');
	  }
          else if (!alphanumers.test($("#dineinrate").val())){
              
                  msgstatus.text('Invalid Rate');
                
                
             }

         
	 else
	  {
		 $.ajax({
                        type: "POST",
                        url: "load_divdinein.php",
                        data: "value=updinein&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&floor="+area+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&di_menu_rate="+di_menu_rate+"&di_tax_value="+di_tax_value+"&di_tax_amount="+di_tax_amount,
                        success: function(msg)
                        {
							
					msgstatus.text('');
					$('#dinein').html(msg);
							
			   $('#di_menu_rate').val('');
                           $('#di_tax_value').val('');
                           $('#di_tax_amount').val('');		
                           $('#dineinrate').val('');	
                           $('#dibarcode').val('');	
					}
                    });
	   }
	   }); 
           
           
    $('.editrate').click( function() { 
                          
                        var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        
                        $("#dineinrate").val(dinein_data[0]);
                        $("#dineinfloor").val(dinein_data[1]);
                        $("#dineinportion").val(dinein_data[2]);
                        $("#diportionselect").val(dinein_data[3]);
                        $("#dibarcode").prop('disabled',true);
                        $("#dibarcode").val(dinein_data[8]);
                        
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#di_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#di_menu_rate").val(dinein_data[0]);   
                        }
                        
                        $("#di_tax_value").val(dinein_data[10]);
                        $("#di_tax_amount").val(dinein_data[11]);
                        
                        
                        if(dinein_data[3]=='Portion'){
                        $('#diportionunitspan').css('display','block');
                        $('#diportionselectspan').css('display','block');
                        $('#dipacketloosespan').css('display','none');
                        $('#diweightspan').css('display','none');
                        $('#dikglitterspan').css('display','none');
                        $('#dibaseunitspan').css('display','none');
                        }
                        else if(dinein_data[3]=='Unit')
                        {    
                            
                            $('#diportionunitspan').css('display','block');
                            $('#dipacketloosespan').css('display','block');
                            $('#diportionselectspan').css('display','none');
                            $('#dikglitterspan').css('display','block');
                            $('#dipackloose').val(dinein_data[7]);
                            if(dinein_data[7]=='Packet'){
                                
                            $('#diweightspan').css('display','block');
                            $('#diweight').prop('disabled',true);
                            $('#diweight').val(dinein_data[6]);
                            $('#dikglitterspan').css('display','block');
                            $('#dikglit').val(dinein_data[5]);
                            $('#dibaseunitspan').css('display','none');
                            }
                            else if(dinein_data[7]=='Loose'){
                            $('#diportionselectspan').css('display','none');
                            $('#dibaseunitspan').css('display','block');
                            $('#dibaseunit').val(dinein_data[4]);
                            $('#diweightspan').css('display','none');
                            $('#dikglitterspan').css('display','none');
                        }
                        }
                        
                        
                        $("#update_dinein").css("display","block");
                        $("#submit_dinein").css("display","none");
                     
                     
                        $(".dineinselect").prop("disabled", true);
                        
                        
                    });
                    
    $('.update_dinein').click( function() {
                    
              
                  $("#update_dinein").css("display","none"); 
                  $("#submit_dinein").css("display","block");
                  $(".editrate").css("display","inline-block");
                  $(".neditrate").css("display","none");
                  $(".dineinselect").prop("disabled", false);
                   
   });
           
 /**************Dinein Click end*******************/               

		
/************** Takeaway Clicks Starts***************  */

  $("#takeaway").click(function(){ 
        
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
                 
                var msg2=$('#takestatus');
                var  menuid =$("#takeawayvalue").val();
                var portion=$("#takeawayportion").val();
                var ratetype=$("#taportionselect").val();
                var barcode=$("#tabarcode").val();
                var food=$("#ta_food").val();
                
                
                 var ta_menu_rate=$("#ta_menu_rate").val();
                 var ta_tax_value=$("#ta_tax_value").val();
                 var ta_tax_amount=$("#ta_tax_amount").val();
                
                 $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
                   if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){
                
                
                if(ratetype=='Unit')
                {
                   packloose=$('#tapackloose').val();
                   weight=$('#taweight').val();
                   unit=$('#takglit').val();
                   baseunit=$('#tabaseunit').val();
                }
                
                var rate=$("#takeawayrate").val();
                var alphanumers = /^[0-9. ]+$/; 
      
	 if(ratetype=='Portion' && portion =="" && rate==""  )
	   {
		   msg2.css("display","block");
		   msg2.text(' Add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(ratetype=='Portion' && portion =="")
	   {
		     msg2.css("display","block");
		     msg2.text(' Add <?=$_SESSION['s_portionname']?>');
	   }
          else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msg2.text('Plz add weight');
          }
	  else if(rate=="" )
	  {
		      msg2.css("display","block");
		     msg2.text(' Add rate');
                      
	  }
          else if (!alphanumers.test($("#takeawayrate").val())){
             msg2.text('Invalid Rate');
                
          }
          else if (food==''){
             msg2.text('Select Online Partner');
               
          }
          
   else
   {
		 $.ajax({
                        type: "POST",
                        url: "load_divtakeawayrate.php",
                        data: "value=addtakeaway&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&food="+food+"&ta_menu_rate="+ta_menu_rate+"&ta_tax_value="+ta_tax_value+"&ta_tax_amount="+ta_tax_amount,
                        success: function(msg)
                        {  
                            
                         msg2.text('');
			$('#takeawayratetab').html(msg);
                        $("#ta_menu_rate").val('');
                        $("#ta_tax_value").val('');
                        $("#ta_tax_amount").val('');
                        $("#takeawayrate").val('');
               			  
                        }
                    });
    }

    }else{
     msg2.css("display","block");
     msg2.text(' BARCODE ALREADY EXIST');
    }


    } });

    });
           
           
           
  $("#utakeaway").click(function(){
    
        var packloose='';
        var weight='';
        var unit='';
        var baseunit='';
        var msg2=$('#takestatus');
	var menuid =$("#takeawayvalue").val();
	var portion=$("#takeawayportion").val();
        var rate=$("#takeawayrate").val();
        var ratetype=$("#taportionselect").val();
        var barcode=$("#tabarcode").val();
        var food = $("#ta_food").val();  
          
          
          var ta_menu_rate=$("#ta_menu_rate").val();
          var ta_tax_value=$("#ta_tax_value").val();
          var ta_tax_amount=$("#ta_tax_amount").val();
         
        if(ratetype=='Unit')
        {
            packloose=$('#tapackloose').val();
            weight=$('#taweight').val();
            unit=$('#takglit').val();
            baseunit=$('#tabaseunit').val();
        }
        var alphanumers = /^[0-9. ]+$/; 
      
      
       $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
          if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){
      

	   if(rate=="" )
	   {
		      msg2.css("display","block");
		     msg2.text('Plz add rate');
                      
	   }
           else if (!alphanumers.test($("#takeawayrate").val())){
              msg2.text('Invalid Rate');
                
          }
           
          
        else
        {
		 $.ajax({
                        type: "POST",
                        url: "load_divtakeawayrate.php",
                        data: "value=uptakeaway&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&food="+food+"&ta_menu_rate="+ta_menu_rate+"&ta_tax_value="+ta_tax_value+"&ta_tax_amount="+ta_tax_amount,
                        success: function(msg)
                        {
                             msg2.text('');
						
		             $('#takeawayratetab').html(msg);
                             $("#takeawayrate").val('');	
                                
                             $('#ta_menu_rate').val('');
                             $('#ta_tax_value').val('');
                             $('#ta_tax_amount').val('');
                                
                        }
                    });
    }


    }else{
        
       msg2.css("display","block");
       msg2.text(' BARCODE ALREADY EXIST');
       $("#utakeaway").css("display","block");
       $("#takeaway").css("display","none");
    }


    } });

    });



 $('.takeeditrate').click( function() { 
        
                  
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                      
                        $("#takeawayrate").val(dinein_data[0]);
                        $("#takeawayportion").val(dinein_data[1]);
                        $("#taportionselect").val(dinein_data[2]);
                       
                        $("#tabarcode").val(dinein_data[7]);
                         $("#ta_food").prop('disabled',true);
                         $("#ta_food").val(dinein_data[8]);
                         
                        if(dinein_data[10]!='' && parseInt(dinein_data[10])>0){
                        $("#ta_menu_rate").val(dinein_data[10]);
                        }else{ 
                         $("#ta_menu_rate").val(dinein_data[0]);   
                        }
                         
                           $("#ta_tax_value").val(dinein_data[11]);
                            $("#ta_tax_amount").val(dinein_data[9]);
                         
                        if(dinein_data[2]=='Portion'){
                        $('#taportionunitspan').css('display','block');
                        $('#taportionselectspan').css('display','block');
                        $('#tapacketloosespan').css('display','none');
                        $('#taweightspan').css('display','none');
                        $('#takglitterspan').css('display','none');
                        $('#tabaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#taportionunitspan').css('display','block');
                            $('#tapacketloosespan').css('display','block');
                            $('#taportionselectspan').css('display','none');
                            $('#takglitterspan').css('display','block');
                            $('#tapackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#taweightspan').css('display','block');
                            $('#taweight').prop('disabled',true);
                            $('#taweight').val(dinein_data[5]);
                            $('#takglitterspan').css('display','block');
                            $('#takglit').val(dinein_data[4]);
                            $('#tabaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#taportionselectspan').css('display','none');
                            $('#tabaseunitspan').css('display','block');
                            $('#tabaseunit').val(dinein_data[4]);
                            $('#taweightspan').css('display','none');
                            $('#takglitterspan').css('display','none');
                        }
                        }
                        $("#utakeaway").css("display","block");
                        $("#takeaway").css("display","none");
                   
                        $(".takeselect").prop("disabled", true);

                    });
                    
                    
    $('.utakeaway').click( function() {
        
        
                   $("#utakeaway").css("display","none"); 
                   $("#takeaway").css("display","block");
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none"); 
                   $(".takeselect").prop("disabled", false);
    });
                 
                 
    $(".tab_edt_btn10").click(function(e){
        
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
                        var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        //alert(dinein_data[5]);
                       var por=$(this).attr('poid');
                       var por1=por.split('_');
                        var  menuid1 =$("#takeawayvalue").val();
                        var portion=por1[1];
                       
           
                   
		 $.ajax({
			type: "POST",
			url: "load_divtakeawayrate.php",
			data: "value=deltakeaway&mid="+menuid1+"&portion="+portion+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[2]+"&packloose="+dinein_data[6]+"&unit="+dinein_data[4]+"&baseunit="+dinein_data[3]+"&weight="+dinein_data[5]+"&barcode="+dinein_data[7]+"&food="+dinein_data[8],
			success: function(msg)
			{ 
				$.ajax({
                                type: "POST",
                                url: "load_divtakeawayrate.php",
                                data: "value=loadbranch&menid="+menuid1,
                                success: function(msg)
                                {
                                        $('#takeawayratetab').html(msg);
                                }
		});
		   }
		});
		}
    });

/*************************************** Takeaway Clicks ends *************************************************  */
/***************************************Room Service Clicks Start*****************************************/


    $("#roomservice").click(function(){
        
          var msg1=$('#roomstatus');
	  var  menuid =$("#rmservicevalue").val();
	  var portion=$("#rmserviceportion").val();
          var rate=$("#rmservicerate").val();
          var alphanumers = /^[0-9. ]+$/; 
      
	 if(portion =="" && rate==""  )
	   {
		   msg1.css("display","block");
		   msg1.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(portion =="")
	   {
		      msg1.css("display","block");
		     msg1.text('Plz add <?=$_SESSION['s_portionname']?>');
	   }
           
	   else if(rate=="" )
	   {
		      msg1.css("display","block");
		     msg1.text('Plz add rate');
                      
	   }
           else if (!alphanumers.test($("#rmservicerate").val())){
                msg1.text('Invalid Rate');
                
             }
          
else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divroomservicerate.php",
                        data: "value=addroomservice&mid="+menuid+"&portion="+portion+"&rate="+rate,
                        success: function(msg)
                        {
						
                                             msg1.text('');	
							$('#roomservicetab').html(msg);
                           
//						 $("#roomstatus").delay(150).fadeOut('slow');
//						 .delay(1000)
						  
                        }
                    });
}
	   });
    $("#uroomservice").click(function(){
      var msg1=$('#roomstatus');
	  var  menuid =$("#rmservicevalue").val();
	  var portion=$("#rmserviceportion").val();
      var rate=$("#rmservicerate").val();
       var alphanumers = /^[0-9. ]+$/; 
      
	 if(portion =="" && rate==""  )
	   {
		   msg1.css("display","block");
		   msg1.text('Plz add <?=$_SESSION['s_portionname']?> and rate');
	   }
	   else if(portion =="")
	   {
		      msg1.css("display","block");
		     msg1.text('Plz add <?=$_SESSION['s_portionname']?>');
	   }
           
	   else if(rate=="" )
	   {
		      msg1.css("display","block");
		     msg1.text('Plz add rate');
                      
	   }
           else if (!alphanumers.test($("#rmservicerate").val())){
         msg1.text('Invalid Rate');
                 // alert("Special charecter Not Allowed.");
             }
          
else
{
		 $.ajax({
                        type: "POST",
                        url: "load_divroomservicerate.php",
                        data: "value=uproomservice&mid="+menuid+"&portion="+portion+"&rate="+rate,
                        success: function(msg)
                        {
						
                                             msg1.text('');	
							$('#roomservicetab').html(msg);
                           
//						 $("#roomstatus").delay(150).fadeOut('slow');
//						 .delay(1000)
						  
                        }
                    });
}
	   });  
           
           
    $('.roomeditrate').click( function() { 
                    
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#rmservicerate").val(dinein_data[0]);
                        $("#rmserviceportion").val(dinein_data[1]);
                        $("#uroomservice").css("display","block");
                        $("#roomservice").css("display","none");
                        //$(".roomeditrate").css("display","none");
                        //$(".nroomeditrate").css("display","inline-block");
                         $(".roomselect").prop("disabled", true);

    });
                    
                    
    $('.uroomservice').click( function() {     
                  $("#uroomservice").css("display","none"); 
                  $("#roomservice").css("display","block");
                  $(".roomeditrate").css("display","inline-block");
                  $(".nroomeditrate").css("display","none");
                   $(".roomselect").prop("disabled", false);

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
           
           
/***************************************Room Service Clicks end*****************************************/

/***************************************counter sale Clicks Starts*****************************************/

    $("#countersale").click(function(){ 
       
                var packloose='';
                var weight='';
                var unit='';
                var baseunit='';
                 
                var msg3=$('#counterstatus');
                var  menuid =$("#countersalevalue").val();
	        var portion=$("#countersaleportion").val();
                var ratetype=$("#csportionselect").val();
                var barcode=$("#csbarcode").val();
                
               var cs_plu_rate=$("#cs_menu_rate").val();
               var cs_plu_tax=$("#cs_menu_tax_amt").val();
               var cs_menu_tax=$("#cs_menu_tax").val();
                 
                        $.ajax({
                        type: "POST",
                        url: "load_counter_sales.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
                   if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){
                
                if(ratetype=='Unit')
                {
                   packloose=$('#cspackloose').val();
                   weight=$('#csweight').val();
                   unit=$('#cskglit').val();
                   baseunit=$('#csbaseunit').val();
                }
            
      var rate=$("#countersalerate").val();
       var alphanumers = /^[0-9. ]+$/; 
      
	 if(ratetype=='Portion' && portion =="" && rate==""  )
	   {
		   msg3.css("display","block");
		   msg3.text('Add Portion and Rate');
	   }
	   else if(ratetype=='Portion' && portion =="")
	   {
		      msg3.css("display","block");
		     msg3.text('Add Portion');
	   }
           else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
          {
              msg3.text('Pls add weight');
          }
	   else if(rate=="" )
	   {
		      msg3.css("display","block");
		     msg3.text('Add rate');
                      
	   }
           else if (!alphanumers.test($("#countersalerate").val())){
               msg3.text('Invalid Rate');
                
           }
          
    else
    {
		 $.ajax({
                        type: "POST",
                        url: "load_divcountersalerate.php",
                        data: "value=addcountersale&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&cs_plu_rate="+cs_plu_rate+"&cs_plu_tax="+cs_plu_tax+"&cs_menu_tax="+cs_menu_tax,
                        success: function(msg)
                        {
						
                        msg3.text('');	
			$('#countersaletab').html(msg);
                        $("#cs_menu_rate").val('');
                        $("#cs_menu_tax_amt").val('');
                        $("#cs_menu_tax").val('');
                        }
                    });
    }

    }else{

                       $('#counterstatus').css("display","block");
                       $('#counterstatus').text('Barcode Already Exists');
                       $("#counterstatus").delay(1500).fadeOut('slow');
    }

    } });

});
           
           
           
           
    $("#ucountersale").click(function(){
        
        var packloose='';
        var weight='';
        var unit='';
        var baseunit='';
        var msg3=$('#counterstatus');
	var menuid =$("#countersalevalue").val();
	var portion=$("#countersaleportion").val();
        var ratetype=$("#csportionselect").val();
        var barcode=$("#csbarcode").val();
                
                
           var cs_plu_rate=$("#cs_menu_rate").val();
           var cs_plu_tax=$("#cs_menu_tax_amt").val();
           var cs_menu_tax=$("#cs_menu_tax").val();     
                
        if(ratetype=='Unit')
        {
            packloose=$('#cspackloose').val();
            weight=$('#csweight').val();
            unit=$('#cskglit').val();
            baseunit=$('#csbaseunit').val();
        }    
        
        var rate=$("#countersalerate").val();
        var alphanumers = /^[0-9. ]+$/; 
        
      
                    $.ajax({
                        type: "POST",
                        url: "load_counter_sales.php",
                        data: "set=check_barcode&barcode="+barcode+"&menuid_barcode="+menuid,
                        success: function(msg)
                        {
                            
           if( ($.trim(msg)=='ok' && barcode!='') ||  barcode==''){


	   if(rate=="" )
	   {
		     msg3.css("display","block");
		     msg3.text('Add rate');
                      
	   }
            else if (!alphanumers.test($("#countersalerate").val())){
                   msg3.text('Invalid Rate');
                
           }
             
          
 else
 {
		 $.ajax({
                        type: "POST",
                        url: "load_divcountersalerate.php",
                        data: "value=upcountersale&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&cs_plu_rate="+cs_plu_rate+"&cs_plu_tax="+cs_plu_tax+"&cs_menu_tax="+cs_menu_tax,
                        success: function(msg)
                        {
						
                         msg3.text('');	
			$('#countersaletab').html(msg);
                        $("#cs_menu_rate").val('');
                        $("#cs_menu_tax_amt").val('');
                        $("#cs_menu_tax").val('');   		  
                        }
                    });
 }


}else{

                   $('#counterstatus').css("display","block");
		   $('#counterstatus').text('Barcode Already Exists');
                   $("#counterstatus").delay(1500).fadeOut('slow');
                   $("#ucountersale").css("display","block");
                   $("#countersale").css("display","none");
}

} });




});
           
           
           
    $('.countereditrate').click( function() { 
                   
			var id_str   =  $(this).attr("id1");
                        var dinein_data = id_str.split('|');
                        $("#countersalerate").val(dinein_data[0]);
                        $("#countersaleportion").val(dinein_data[1]);
                        $("#csportionselect").val(dinein_data[2]);
                      
                        $("#csbarcode").val(dinein_data[7]);
                        
                        if(dinein_data[9]!='' && parseInt(dinein_data[9])>0){
                        $("#cs_menu_rate").val(dinein_data[9]);
                        }else{ 
                         $("#cs_menu_rate").val(dinein_data[0]);   
                        }
                        
                        $("#cs_menu_tax_amt").val(dinein_data[8]);
                       
                        $("#cs_menu_tax").val(dinein_data[10]);
                      
                        if(dinein_data[2]=='Portion'){
                        $('#csportionunitspan').css('display','block');
                        $('#csportionselectspan').css('display','block');
                        $('#cspacketloosespan').css('display','none');
                        $('#csweightspan').css('display','none');
                        $('#cskglitterspan').css('display','none');
                        $('#csbaseunitspan').css('display','none');
                        }
                        else if(dinein_data[2]=='Unit')
                        {    
                            
                            $('#csportionunitspan').css('display','block');
                            $('#cspacketloosespan').css('display','block');
                            $('#csportionselectspan').css('display','none');
                            $('#cskglitterspan').css('display','block');
                            $('#cspackloose').val(dinein_data[6]);
                            if(dinein_data[6]=='Packet'){
                                
                            $('#csweightspan').css('display','block');
                            $('#csweight').prop('disabled',true);
                            $('#csweight').val(dinein_data[5]);
                            $('#cskglitterspan').css('display','block');
                            $('#cskglit').val(dinein_data[4]);
                            $('#csbaseunitspan').css('display','none');
                            }
                            else if(dinein_data[6]=='Loose'){
                            $('#csportionselectspan').css('display','none');
                            $('#csbaseunitspan').css('display','block');
                            $('#csbaseunit').val(dinein_data[3]);
                            $('#csweightspan').css('display','none');
                            $('#cskglitterspan').css('display','none');
                        }
                        }
                        $("#ucountersale").css("display","block");
                        $("#countersale").css("display","none");
                        //$(".countereditrate").css("display","none");
                        //$(".ncountereditrate").css("display","inline-block");
                         $(".counterselect").prop("disabled", true);
                    });
                    
                    
    $('.ucountersale').click( function() {    
        
                  $("#ucountersale").css("display","none"); 
                  $("#countersale").css("display","block");
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                    $(".counterselect").prop("disabled", false);
   });
   
   
    $(".tab_edt_btn14").click(function(e){
        
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{           
            var id_str   =  $(this).attr("id2");
                        var dinein_data = id_str.split('|');
                        var por=$(this).attr('poid');
                        var por1=por.split('_');
                        //alert(dinein_data[5]);
                        var  menuid1 =$("#countersalevalue").val();
                        var portion=por1[1];
            
                        
		 $.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=delcountersale&mid="+menuid1+"&portion="+portion+"&rate="+dinein_data[0]+"&ratetype="+dinein_data[2]+"&packloose="+dinein_data[6]+"&unit="+dinein_data[4]+"&baseunit="+dinein_data[3]+"&weight="+dinein_data[5]+"&barcode="+dinein_data[7],
			success: function(msg)
			{
				$.ajax({
			type: "POST",
			url: "load_divcountersalerate.php",
			data: "value=loadbranch&menid="+menuid1,
			success: function(msg)
			{
				$('#countersaletab').html(msg);
				
			}
		});
		   }
		});
		}
   });  
           
           
/***************************************counter sale Clicks end*****************************************/
/**************************************** Apply Rate All Clicks **************************************************/


   $('.delete_all_rate').unbind().click(function(){
     
       $('#confirm_pop_all').show();
       $('#confirm_pop_all').css('z-index','99999999');          
       $('#pop_head_com').text('RATE IN ALL MODULES WILL BE DELETED ?');
     
        var module_selected=$(this).attr('id');
         
        $('#confirm_pop_all').attr('module_selected',module_selected);
        
           var  menuid='';
           if(module_selected=='selection_dinein_div'){
             menuid =$("#dineinvalue").val();
          }
          
          if(module_selected=='selection_takeaway_div'){
             menuid =$("#takeawayvalue").val();
          }
          
           if(module_selected=='selection_counter_div'){
             menuid =$("#countersalevalue").val();
          }
        $('#confirm_pop_all').attr('menuid',menuid);
        
        close_rate_on();
            
   });


    $('.apply_all').unbind().click(function(){
        
        var module_selected=$(this).attr('id');
        var packloose='';
        var weight='';
        var unit='';
        var baseunit='';
        var  menuid ='';
        var portion='';
        var rate='';
        var ratetype='';
        var barcode='';
        
        var  barcode_cs=$("#csbarcode").val();
        
        var  menuid_barcode =$("#dineinvalue").val();
        var  barcode_ta=$("#tabarcode").val();
        
        $.ajax({
                        type: "POST",
                        url: "load_counter_sales.php",
                        data: "set=check_barcode&barcode="+barcode_cs+"&menuid_barcode="+menuid_barcode,
                        success: function(msg)
                        {
                            
                           
                   if( ($.trim(msg)=='ok' && barcode_cs!='') ||  barcode_cs==''){
                       
                       
                       
            $.ajax({
                        type: "POST",
                        url: "load_takeaway.php",
                        data: "set=check_barcode&barcode="+barcode_ta+"&menuid_barcode="+menuid_barcode,
                        success: function(msg)
                        {
                            
                           
                   if( ($.trim(msg)=='ok' && barcode_ta!='') ||  barcode_ta==''){           
        
        if(module_selected=='selection_dinein_div'){
            
            menuid =$("#dineinvalue").val();
            portion=$("#dineinportion").val();
            rate=$("#dineinrate").val();
            ratetype=$("#diportionselect").val();
            barcode=$("#dibarcode").val();

            if(ratetype=='Unit')
            {
               packloose=$('#dipackloose').val();
               weight=$('#diweight').val();
               unit=$('#dikglit').val();
               baseunit=$('#dibaseunit').val();
            }

            var alphanumers = /^[0-9. ]+$/; 
            var msgstatus=$('#status');

            if(ratetype=='Portion' && portion == "" && rate =="" )
            {
                      msgstatus.text(' Add <?=$_SESSION['s_portionname']?> and rate');
            }

            else if(ratetype=='Portion' && portion =="")
            {
                     msgstatus.text(' Add <?=$_SESSION['s_portionname']?>');
            }
            else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
            {
                msgstatus.text(' Add weight');
            }
            else if(rate == "")
            {
                     msgstatus.text(' Add rate');
            }
            else if (!alphanumers.test($("#dineinrate").val())){
                msgstatus.text('Invalid Rate');
                
            }
            else{
                
                
                 var di_menu_rate=$("#di_menu_rate").val();
                        
                var di_tax_value=$("#di_tax_value").val();
                var di_tax_amount=$("#di_tax_amount").val();
                
             if((portion!="" && portion!="null" && portion!="undefined" && portion!=undefined) || ratetype=='Unit'){    
                $.ajax({
                       type: "POST",
                       url: "load_divdinein.php",
                       data: "value=rate_apply_all&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&di_menu_rate="+di_menu_rate+"&di_tax_value="+di_tax_value+"&di_tax_amount="+di_tax_amount,
                       success: function(msg)
                       {  
                            msgstatus.text('');
                            $('#dinein').html(msg);
                            
                        $("#dibarcode").val('');    
                    $("#dineinrate").val('');
                   $("#di_menu_rate").val('');      
               $("#di_tax_value").val('');
              $("#di_tax_amount").val('');
                            
                       }
                });
                
                 }else {
                msgstatus.text('SELECT PORTION ');
                
                 }
                
                
            }
        }    
        else if(module_selected=='selection_takeaway_div'){
            
            var msg2=$('#takestatus');
            menuid =$("#takeawayvalue").val();
            portion=$("#takeawayportion").val();
            ratetype=$("#taportionselect").val();
            barcode=$("#tabarcode").val();
              var food=$("#ta_food").val();   
              
            if(ratetype=='Unit')
            {
               packloose=$('#tapackloose').val();
               weight=$('#taweight').val();
               unit=$('#takglit').val();
               baseunit=$('#tabaseunit').val();
            }
           
            var rate=$("#takeawayrate").val();
            var alphanumers = /^[0-9. ]+$/; 
      
            if(ratetype=='Portion' && portion =="" && rate==""  )
            {
		msg2.css("display","block");
		msg2.text(' Add <?=$_SESSION['s_portionname']?> and rate');
            }
	   else if(ratetype=='Portion' && portion =="")
	   {
		msg2.css("display","block");
		msg2.text(' Add <?=$_SESSION['s_portionname']?>');
	   }
            else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
            {
                msg2.text(' Add weight');
            }
            else if(rate=="" )
            {
		msg2.css("display","block");
		msg2.text(' Add rate');
            }
            else if (!alphanumers.test($("#takeawayrate").val())){
                msg2.text('Invalid Rate');
                
            }else if (food==''){
                msg2.text('Select Online Partner');
                 
            }
            
            else
            {
                
                 var ta_menu_rate=$("#ta_menu_rate").val();
                        
                var ta_tax_value=$("#ta_tax_value").val();
                var ta_tax_amount=$("#ta_tax_amount").val();
                
               if((portion!="" && portion!="null" && portion!="undefined" && portion!=undefined) || ratetype=='Unit'){ 
                   
		$.ajax({
                    type: "POST",
                    url: "load_divtakeawayrate.php",
                    data: "value=rate_apply_all&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&food="+food+"&ta_menu_rate="+ta_menu_rate+"&ta_tax_value="+ta_tax_value+"&ta_tax_amount="+ta_tax_amount,
                    success: function(msg)
                    {  
                        msg2.text('');
                        $('#takeawayratetab').html(msg);
                     $("#ta_menu_rate").val('');
                        $("#takeawayrate").val('');
              $("#ta_tax_value").val('');
              $("#ta_tax_amount").val('');
            $("#tabarcode").val('');
             $("#ta_food").val('');   
                        
                    }
                });
                
    }else {
                msg2.text('SELECT PORTION ');
                
                 }
                
                
            }
        }
        else if(module_selected=='selection_counter_div'){
            var msg3=$('#counterstatus');
            menuid =$("#countersalevalue").val();
	    portion=$("#countersaleportion").val();
            ratetype=$("#csportionselect").val();
            barcode=$("#csbarcode").val();
            
            
            if(ratetype=='Unit')
            {
                packloose=$('#cspackloose').val();
                weight=$('#csweight').val();
                unit=$('#cskglit').val();
                baseunit=$('#csbaseunit').val();
            }
            var rate=$("#countersalerate").val();
            var alphanumers = /^[0-9. ]+$/; 
     
            if(ratetype=='Portion' && portion =="" && rate==""  )
            {
		msg3.css("display","block");
		msg3.text('Add <?=$_SESSION['s_portionname']?> and rate');
            }
            else if(ratetype=='Portion' && portion =="" && portion =="null")
            {
		msg3.css("display","block");
		msg3.text(' Add <?=$_SESSION['s_portionname']?>');
            }
            else if(ratetype=='Unit' && packloose=='Packet' && (weight==''||isNaN(weight)))
            {
                msg3.text(' Add weight');
            }
            else if(rate=="" )
            {
		msg3.css("display","block");
		msg3.text('Add add rate');
            }
            else if (!alphanumers.test($("#countersalerate").val())){
                msg3.text('Invalid Rate');
                 // alert("Special charecter Not Allowed.");
            }
          
            else
            { 
                var cs_menu_rate=$("#cs_menu_rate").val();
                        
                var cs_tax_value=$("#cs_menu_tax").val();
                var cs_tax_amount=$("#cs_menu_tax_amt").val();
                
               
                if((portion!="" && portion!="null" && portion!="undefined" && portion!=undefined) || ratetype=='Unit' ){
                    
		$.ajax({
                    type: "POST",
                    url: "load_divcountersalerate.php",
                    data: "value=rate_apply_all&mid="+menuid+"&portion="+portion+"&rate="+rate+"&ratetype="+ratetype+"&packloose="+packloose+"&unit="+unit+"&baseunit="+baseunit+"&weight="+weight+"&barcode="+barcode+"&cs_menu_rate="+cs_menu_rate+"&cs_tax_value="+cs_tax_value+"&cs_tax_amount="+cs_tax_amount,
                    success: function(msg)
                    {
                        $("#cs_menu_rate").val('');
                        
                        $("#cs_menu_tax_amt").val('');
                        
                         $("#cs_menu_tax").val('');
                        $("#countersalerate").val('');
                        $("#csbarcode").val('');
                        
                        msg3.text('');	
                        $('#countersaletab').html(msg);
                       $('#counterstatus').text('');
                    }
                });
                
    }else{
                    $('#counterstatus').css("display","block");
		   $('#counterstatus').text('SELECT PORTION');
                   $("#counterstatus").delay(1500).fadeOut('slow');
    }
                
            }
        }
        
   }else{

                   $('#takestatus').css("display","block");
		   $('#takestatus').text('Barcode Already Exists TA');
                   $("#takestatus").delay(1500).fadeOut('slow');
    }

    } }); 


    }else{

                       $('#counterstatus').css("display","block");
                       $('#counterstatus').text('Barcode Already Exists CS');
                       $("#counterstatus").delay(1500).fadeOut('slow');
    }

    } }); 


        
    });
    
    
/**************************************** Apply Rate All Clicks Ends**************************************************/
/*************************************** Submit  combination function starts *************************************************  */
 $("#combi").click(function(){
 
		var  menuid =$("#menuidnew").val();
		var  combinationid =$("#menu").val();
		var combstatus=$('#combistatus');
		if(combinationid == "")
		{
				combstatus.text('Plz add combination');
		}
       else
	   {
		 $.ajax({
                        type: "POST",
                        url: "load_divcombination.php",
                        data: "value=addcombination&combid="+combinationid+"&menuid="+menuid,
                        success: function(msg)
                        {
								combstatus.text('');
							$('#menucombination').html(msg);
                        }
                    });
	   }
  });	 
          
/*************************************** Submit  combination function ends *************************************************  */
	
/*************************************** Message clear starts *************************************************  */

 $("#tabwrap ul a").click(function(){
     
			  $('#status').text('');
			  $('#takestatus').text('');
                          $('#takeawayratestatus').text('');
                          $('#roomstatus').text('');
                          $('#roomratestatus').text('');
                          $('#counterstatus').text('');
                          $('#counterratestatus').text('');
			  $('#ratestatus').text('');
			  //document.getElementById("dineinportion").value = "";
			  $('#dineinportion').find('option:first').attr('selected', 'selected');
			  document.getElementById("dineinrate").value = "";
			  document.getElementById("dineinfloor").value = "";
			  //document.getElementById("takeawayportion").value = "";
			  $('#takeawayportion').find('option:first').attr('selected', 'selected');
                  document.getElementById("rmserviceportion").value = "";
	          document.getElementById("takeawayrate").value = "";
                  $('#rmserviceportion').find('option:first').attr('selected', 'selected');
	          document.getElementById("rmservicerate").value = "";
                  //document.getElementById("countersaleportion").value = "";
                  $('#countersaleportion').find('option:first').attr('selected', 'selected');
	          document.getElementById("countersalerate").value = "";
                   $(".dineinselect").prop("disabled", false);
                   $(".neditrate").css("display","none");
                   $(".editrate").css("display","inline-block");
                   $(".takeselect").prop("disabled", false);
                   $(".takeeditrate").css("display","inline-block");
                   $(".ntakeeditrate").css("display","none"); 
                   $(".counterselect").prop("disabled", false);
                   $(".countereditrate").css("display","inline-block");
                   $(".ncountereditrate").css("display","none");
                   $(".roomeditrate").css("display","inline-block");
                  $(".nroomeditrate").css("display","none");
                   $(".roomselect").prop("disabled", false);
                   
			  
		});
/*************************************** Message clear ends *************************************************  */		
/*************************************** Menu Rate adding Feilds Hide show onload Starts *************************************************  */		
    var a=$('#portiontype').val();
    
     if(a=='Portion'){
            $('#diportionunitspan').css('display','block');
            $('#diportionselectspan').css('display','block');
            $('#dipacketloosespan').css('display','none');
            $('#diweightspan').css('display','none');
            $('#dikglitterspan').css('display','none');
            $('#dibaseunitspan').css('display','none');
            
            $('#taportionunitspan').css('display','block');
            $('#taportionselectspan').css('display','block');
            $('#tapacketloosespan').css('display','none');
            $('#taweightspan').css('display','none');
            $('#takglitterspan').css('display','none');
            $('#tabaseunitspan').css('display','none');
            
            $('#csportionunitspan').css('display','block');
            $('#csportionselectspan').css('display','block');
            $('#cspacketloosespan').css('display','none');
            $('#csweightspan').css('display','none');
            $('#cskglitterspan').css('display','none');
            $('#csbaseunitspan').css('display','none');
        }
        else if(a=='Unit')
        {
            $('#diportionunitspan').css('display','block');
            $('#diportionselectspan').css('display','none');
            $('#dipacketloosespan').css('display','block');
            $('#diweightspan').css('display','block');
            $('#dikglitterspan').css('display','block');
            $('#dibaseunitspan').css('display','none');
            
            $('#taportionunitspan').css('display','block');
            $('#taportionselectspan').css('display','none');
            $('#tapacketloosespan').css('display','block');
            $('#taweightspan').css('display','block');
            $('#takglitterspan').css('display','block');
            $('#tabaseunitspan').css('display','none');
            
            $('#csportionunitspan').css('display','block');
            $('#csportionselectspan').css('display','none');
            $('#cspacketloosespan').css('display','block');
            $('#csweightspan').css('display','block');
            $('#cskglitterspan').css('display','block');
            $('#csbaseunitspan').css('display','none');
        }  
  
  /******** Menu Raete adding Feilds Hide show onload ends *******/		
  
});





    function close_rate_on(){

           $(".olddiv").removeClass("new_overlay"); 
           $('.mynewpopupload').css("display","none");
           $('.mynewpopupload').empty();

    }

function confirm_yes_new(){
    
     $('#confirm_pop_all').hide();
                
     $('#pop_head_com').text('');
     
    var module_selected = $('#confirm_pop_all').attr('module_selected');
  
    var  menuid=$('#confirm_pop_all').attr('menuid');
          
      
                $.ajax({
                       type: "POST",
                       url: "load_index.php",
                       data: "set=delete_all&mid="+menuid,
                       success: function(msg)
                       {  
                              $('#dinein').html('');
                              $('#takeawayratetab').html(''); 
                              $('#countersaletab').html('');
                              
                               $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('DELETED');
                        $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
                        
                             
                             
                $('.responstable tr').removeClass('table_active');
		$('.responstable tr').addClass('table_active');
               $('#hiddenmenuid').val(menuid);
		 $('.mynewpopupload').css("display","block"); 
		$(".olddiv").addClass("new_overlay");
			 
			  $.post("popup/menu_rate.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  $('.mynewpopupload').html(data);
				  });  
                             
                             
                             
                              
                       }
                });
     
     
     
}

</script>
<style>
.disablegenerate
{
pointer-events: none;
opacity: 0.4;
cursor:none;

}
    
</style>

<script src="master_style/js/basicTabs-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
            
		$('#tabwrap').basicTabs();
		
	});
	</script>
    
<input  type="hidden" id="portiontype" value="<?=$search_menurate_type?>">
<div class="md-content" style="position:fixed;width:820px;left:30%;top:5%;z-index:99999;"><!--1sttab-->
    <div  class="dfineheading"> <strong>Rate</strong> &nbsp; : <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span> &nbsp; |  &nbsp; REF ID :  <?=$searchid_mn?> </div> 
    <a href="#" onclick="return close_rate_on()"><button class="md-close_pop">x</button></a>
                                                <span id="tabwrap">
                                                <ul style="margin:0px;" class="tabs">
                                                    <li class="current"><a href="#home" onclick="return departmentselect('<?=$search_menurate_type?>','DI')">Dine In</a></li>
                                                    <li><a href="#about" onclick="return departmentselect('<?=$search_menurate_type?>','TA')">Take Away</a></li>
                                                    <li><a href="#counter" onclick="return departmentselect('<?=$search_menurate_type?>','CS')">Counter Sale</a></li>
                                                    <li><a href="#room">Room Services</a></li>
                                                </ul>
                                                <span class="tab_content">
                                                    <span id="home" class="current"  >
                                                   <span class="tab_sub_head rate-popup-head" style="">
                                                     <span class="form-group" style="width:90% !important;">
                                              
                                                     
                                                        <span class="col-sm-3 tab_text_box_cc no-padding" style="display:inline-block;float:left;    width: 14% !important;">
                                             <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											  //`tbl_kotcountermaster`(`kr_kotcode`, `kr_branchid`, `kr_kotname`)
                     ?>
                                                            <select data-placeholder="Enter Area" id="dineinfloor"  name="dineinfloor" data-rel="chosen" title="" data-toggle="tooltip" class="form-control add_new_dropdown dineinselect">
                                        <option value="">--Select Area--</option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
                                                                      	?>
                                              
                                              <option value="<?=$result_kot['fr_floorid']?>"><?=$result_kot['fr_floorname']?></option>
                                    <?php } ?> 
                                 
                                    	 </select>
                                    
                                         <?php } ?>
                                            
                                                    </span>       
                                                         
     
             <span class="col-sm-3 tab_text_box_cc no-padding" id="diportionunitspan" style="display:inline-block;float:left;  width: 9% !important;">
                                                         
                                         
                 <input type="text" class="form-control add_new_dropdown dineinselect portionselect" id="diportionselect" value="<?=$search_menurate_type?>"  readonly>
              </span>
         
       
        <span class="col-sm-3 tab_text_box_cc no-padding" id="diportionselectspan" style="display:none;float:left;  width: 9% !important;">
                              <?php
				$sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
				$num_kot   = $database->mysqlNumRows($sql_kot);
				if($num_kot){ $i=0;
                              ?>
                                        <select  data-placeholder="Enter" id="dineinportion" name="dineinportion" data-rel="chosen" title=""  data-toggle="tooltip" class="form-control add_new_dropdown dineinselect" <?php if($_SESSION['s_portnuse']=="N"){ ?> disabled="disabled" <?php } ?>>
                                     
                                        
                                         <?php 
					while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
					{
					?>
                                            <option value="<?=$result_kot['pm_id']?>" <?php if($_SESSION['s_portnuse']=="N"){ if($i==0){ ?> selected="selected" <?php }} ?> ><?=$result_kot['pm_portionname']?></option>
                                        <?php $i++;} ?> 
                                      
                                    	 </select>
                                         <?php } ?>
                                         </span>                   
        
        
 <style>
   .kg-num-text {
    width: 20%;
    float: left;
    color: #000;
    text-align: center;
    line-height: 30px;
    font-weight: bold;
    font-size: 15px;
}
                                                             
                                                         </style>    
        <span class="col-sm-3 tab_text_box_cc  no-padding" id="dipacketloosespan" style="display:none;float:left;width:11% !important">
         	<input type="text" class="form-control add_new_dropdown dineinselect pack-loose-select" id="dipackloose" value="<?=$search_menu_unittype?>" readonly >
              
        </span> 
                   
        <span class="col-sm-3 tab_text_box_cc  no-padding" id="diweightspan" style="display:none;float:left;width:9% !important">
            <input type="text" class="form-control" id="diweight"   placeholder="Weight" >
        </span>
        <span class="col-sm-3 tab_text_box_cc  no-padding" id="dikglitterspan" style="display:none;float:left;width:7% !important">
         	<select class="form-control add_new_dropdown dineinselect kg-lt-select" id="dikglit">
                <?php
                $sql_unit  =  $database->mysqlQuery("select um.u_name,um.u_id from tbl_base_unit_master u left join tbl_unit_master_combination uc on u.bu_id = uc.um_first_id left join tbl_unit_master um on um.u_id = uc.um_second_id where uc.um_first_id = '".$search_menubase_unit."'"); 
                $num_unit  = $database->mysqlNumRows($sql_unit);
                if($num_unit){
                  while($result_unit  = $database->mysqlFetchArray($sql_unit)) 
                          {
                      ?>
                            <option value="<?=$result_unit['u_id']?>"><?=$result_unit['u_name']?></option>
                                         
                        <?php    
                          }
                }
                      ?>
             </select>
        </span>  
                     
        <span class="col-sm-3 tab_text_box_cc  no-padding" id="dibaseunitspan" style="display:none;float:left;width:10% !important">
            <span class="kg-num-text" style="color: #000">1</span>
            <input style="width: 80%;float: right" type="text" class="form-control" id="dibaseunit" value="<?=$menubase_unit?>"   readonly>
        </span>
                                                         
                                                         
          <span class="col-sm-3 tab_text_box_cc  no-padding" id="" style="display:inline-block;float:left;width:12% !important">
              <input autofocus="on" type="text" class="form-control" value="" onkeyup="rate_calc_plu_di();"  id="di_menu_rate" name="" placeholder="Menu Rate">
        </span> 
                                                         
                                                         <span class="col-sm-3 tab_text_box_cc  no-padding" id="" style="display:inline-block;float:left;width:12% !important">
            <input type="text" class="form-control" value=""  id="di_tax_value" name="" onkeyup="rate_calc_plu_di();" placeholder="Tax%">
        </span> 
                                                         
                                                         <span class="col-sm-3 tab_text_box_cc  no-padding" id="" style="display:inline-block;float:left;width:12% !important">
                                                             <input type="text" class="form-control" readonly value=""  id="di_tax_amount" name="" placeholder="Tax Amount">
        </span> 
                                                         
                                                         
                                                         
        <span class="col-sm-3 tab_text_box_cc  no-padding" id="diratespan" style="display:inline-block;float:left;width:12% !important">
            <input readonly type="text" class="form-control" value=""  id="dineinrate" name="dineinrate" placeholder="Rate">
        </span>     
                                                         
                                                         
                                                         
        <span class="col-sm-3 tab_text_box_cc  no-padding"  id="dibarcodespan" style="display:inline-block;float:left;width:14% !important">
            <input type="text" class="form-control" id="dibarcode"  readonly   placeholder="Barcode">
        </span>
        
                                                    
                                                    
                                                    </span>
                                                <span class="col-sm-1 nopadding" style="  margin:0px 0 -6px 0;display: inline-block;float: left;">
                                                    <span class="search_btn_member_invoice" style="margin-left:0"><a href="#" id="submit_dinein"  style="display:block;">GO</a></span>
                                                </span>
                                                <span class="col-sm-1 nopadding" style="  margin:0px 0 -6px 0;display: inline-block;float: left;">       
                                                    <span  class="search_btn_member_invoice"><a href="#" style="display:none" id="update_dinein" class="update_dinein">GO</a></span>
                                                </span>
                                                <span class="col-sm-1 nopadding" style="  margin:0px 0 -6px 0;display: inline-block;float: left;">
                                                    <span  class="search_btn_member_invoice"><a href="#" style="display:block" id="selection_dinein_div" class="apply_all">APPLY ALL</a></span>
                                                    
                                                     <span  class="search_btn_member_invoice"><a href="#" style="display:block;left: 80px;position: absolute;width: 70px; top: 0px;background-color: #7a4242" id="selection_dinein_div" class="delete_all_rate">DELETE ALL</a></span>
                                                    
                                                    
                                                 <input type="hidden" name="dineinvalue" id="dineinvalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                                </span>
                                                       <span style="height:15px;text-align: center;width: 100%;float: left"><span id="status" style="padding-left:0px; padding-top:0px;  display: inline-block; color:#ff0000; font-weight:bold;  font-size: 12px;" ></span>  </span>
                                            </span><!---->
											<span class="tab_table_cont_cc">
                                                 <table class="responstable" id="dinein" >
                                                  <thead>
                                                  <tr>
                                                  <th>
                                                    Area
                                                  </th>
                                                  <th>Rate Type</th>
                                                  <th><?=$_SESSION['s_portionname']?></th>
                                                  <th>Unit Type</th>
                                                  <th>Unit Weight</th>
                                                  <th>Unit Id</th>
                                                  <th>Base unit Id</th>
                                                  <th>Rate</th>
                                                  <th>Tax </th>
                                                   <th>Final Rate</th>
                                                   <th>Barcode</th>
                                                  <th>Edit</th>                                                 
                                                  </tr>
                                                </thead>
                                                  <tbody>
                                                     <?php
                                                     //$menubase_unit_name='';$menu_unit_name='';
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0; 
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
					$floor_name=$database->show_floor_ful_details($result_cat_s['mmr_floorid']);
					$portion_name=$database->show_portion_ful_details($result_cat_s['mmr_portion']);
                                         
                                         $menubase_unit_name='';
                                         if($result_cat_s['mmr_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mmr_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mmr_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $dinein_id =$result_cat_s['mmr_rate'].'|'. $result_cat_s['mmr_floorid'].'|'.$result_cat_s['mmr_portion'].'|'.$result_cat_s['mmr_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mmr_unit_id'].'|'.$result_cat_s['mmr_unit_weight'].'|'.$result_cat_s['mmr_unit_type'].'|'.$result_cat_s['mmr_barcode'].'|'.$result_cat_s['mmr_menu_final_amount'].'|'.$result_cat_s['mmr_menu_tax_value'].'|'.$result_cat_s['mmr_menu_tax_amount'];
                                           
?>                                       
    <tr>
             <td><?=$floor_name['fr_floorname']?></td>
             <td><?=$result_cat_s['mmr_rate_type']?></td>
              <td><?=$portion_name['pm_portionname']?></td>
              <td><?=$result_cat_s['mmr_unit_type']?></td>
              <td><?=$result_cat_s['mmr_unit_weight']?></td>
              <td><?=$menu_unit_name?></td>
              <td><?=$menubase_unit_name?></td>
               <td><?=number_format($result_cat_s['mmr_rate'],$_SESSION['be_decimal'])?></td>
                <td><?=number_format($result_cat_s['mmr_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mmr_menu_final_amount'],$_SESSION['be_decimal'])?></td> 
                <td><?=$result_cat_s['mmr_barcode']?></td>
            <td> 
                <a class="tab_edt_btn5" href="#" id="m_<?=$result_cat_s['mmr_menuid']?> " frid="b_<?=$result_cat_s['mmr_floorid']?>" pid="p_<?=$result_cat_s['mmr_portion']?>" id2="<?=$dinein_id?>"   ><i class="glyphicon glyphicon-trash"></i></a>
            
                <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mmr_menuid']?>" class="editrate" id1="<?=$dinein_id?>" href="#" ><i class="fa fa-edit"></i></a>
            <a style="font-size: 15px;padding-left: 4px; display: none;" class="neditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
            </tbody>
                         </table>                                             
                                                </span>  <!--tab_table_cont_cc-->
                                                    </span>
   <!-----------------------------------------Dinein End----------------------------------------------->                                                 
                                                    
   <!-----------------------------------------Takeaway start----------------------------------------------->                                   
                                                    

                                                    <span style="display:none" id="about">
                                                      <span class="tab_sub_head" style="">
                                                        <span class="form-group" style="width:90% !important;">
                                                            <span class="col-sm-3 tab_text_box_cc no-padding" id="portionunitspan" style="display:inline-block;float:left;  width: 14% !important;">
                                                         
                                                                <input type="text" class="form-control add_new_dropdown takeselect portionselect" id="taportionselect" value="<?=$search_menurate_type?>"  readonly>
                                                                
                                                             </span>
                                                           <!--<span class="rate-portion-show-cc" style="display:block">--> 
                                                     <span class="form-group" style="  width: 20% !important;float: left;margin-right: 5px;display: none;" id="taportionselectspan">
                                                                            <?php 
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){$i=0;
                     ?>
                                        <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="takeawayportion" name="takeawayportion" data-rel="chosen" title="" data-toggle="tooltip" class="form-control add_new_dropdown takeselect" <?php if($_SESSION['s_portnuse']=="N"){ ?> disabled="disabled" <?php } ?>>
                                        
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{ 
									?>
                                            <option value="<?=$result_kot['pm_id']?>" <?php if($_SESSION['s_portnuse']=="N"){ if($i==0){ ?> selected="selected" <?php }} ?> ><?=$result_kot['pm_portionname']?></option>
                                    <?php  $i++;} ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                                     </span>    
                                                            
                                                            
<!--                                                            
                                                 /////////ta_food//////           -->
                                                  <span class="form-group" style="  width: 13% !important;float: left;margin-right: 5px;display: none;" id="ta_food_selectspan">
                                                                            <?php 
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_online_order where tol_status='Y' "); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){$i=0;
                     ?>
                                        <select data-placeholder="Select Online" id="ta_food" name="ta_food" data-rel="chosen" title="" data-toggle="tooltip" class="form-control add_new_dropdown takeselect" >
                                         <option value="" >Online order </option>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{ 
									?>
                                            <option value="<?=$result_kot['tol_id']?>" > <?=$result_kot['tol_name']?> </option>
                                         <?php  $i++;} ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                                     </span>              
                                                            
                                                            
                                                            
<!--                                                    </span>rate-portion-show-cc     -->
                                                    
<!--                                                    <span class="rate-unit-show-cc" style="display:none">  -->
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="tapacketloosespan" style="display:none;float:left;width:11% !important">
                                                        
                                                    <input type="text" class="form-control add_new_dropdown takeselect pack-loose-select" id="tapackloose" value="<?=$search_menu_unittype?>" readonly >
                                                </span> 
                                                          
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="taweightspan" style="display:none;float:left;width:10% !important">
                                                    <input type="text" class="form-control "  placeholder="Weight" id="taweight">
                                                </span>
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="takglitterspan" style="display:none;float:left;width:7% !important">
                                                        <select class="form-control add_new_dropdown takeselect kg-lt-select" id="takglit">
                                                      <?php
                                                            $sql_unit  =  $database->mysqlQuery("select um.u_name,um.u_id from tbl_base_unit_master u left join tbl_unit_master_combination uc on u.bu_id = uc.um_first_id left join tbl_unit_master um on um.u_id = uc.um_second_id where uc.um_first_id = '".$search_menubase_unit."' "); 
                                                    $num_unit  = $database->mysqlNumRows($sql_unit);
                                                    if($num_unit){
                                                      while($result_unit  = $database->mysqlFetchArray($sql_unit)) 
                                                              {
                                                          ?>
                                                                <option value="<?=$result_unit['u_id']?>"><?=$result_unit['u_name']?></option>

                                                            <?php    
                                                              }
                                                    }
                                                          ?>
                                                    </select>
                                                </span>  
                                                            
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="tabaseunitspan" style="display:none;float:left;width:10% !important">
                                                    <span style="color: #000" class="kg-num-text">1</span>
                                                    <input  style="width: 80%;float: right" type="text" class="form-control"  id="tabaseunit" value="<?=$menubase_unit?>"  readonly>
                                                </span>


                
              <span class="col-sm-3 no-padding tab_text_box_cc" style="    width: 10% !important;float:left;">
                    <input type="text" class="form-control" id="ta_menu_rate"  onkeyup="rate_calc_plu_ta();" name="ta_menu_rate" placeholder="Menu Rate">
                                                        </span>

                     <span class="col-sm-3 no-padding tab_text_box_cc"  style="    width: 10% !important;float:left;">
                         <input type="text" class="form-control" id="ta_tax_value" onkeyup="rate_calc_plu_ta();" name="ta_tax_value" placeholder="Tax %">
                                                        </span>

                <span class="col-sm-3 no-padding tab_text_box_cc"  style="    width: 10% !important;float:left;">
                           <input readonly type="text" class="form-control" id="ta_tax_amount" name="ta_tax_amount" placeholder="Tax Amount">
                                                        </span>



                                                
                                                        <span class="col-sm-3 no-padding tab_text_box_cc" id="taratespan" style="    width: 10% !important;float:left;">
                                                            <input readonly type="text" class="form-control" id="takeawayrate" name="takeawayrate" placeholder="Rate">
                                                        </span>

                                                    <span class="col-sm-3 tab_text_box_cc  no-padding" id="tabarcodespan" style="display:inline-block;float:left;width:10% !important">
                                                        <input type="text" class="form-control"  placeholder="Barcode"  <?php if($manual_barcode=='N'){ ?> readonly <?php } ?> id="tabarcode">
                                                    </span>

<!--                                                </span>rate-unit-show-cc-->
                                                    
                                                        </span>      
                                                    
                                                          
                                                          
                                                          
                                                    
                                                    
                                                          <span class="col-sm-1 nopadding" id="takeawayvalue_div" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                              <span class="search_btn_member_invoice"><a href="#" style="display:block" id="takeaway" >GO</a></span>
                                                          </span>
                                                            <span class="col-sm-1 nopadding" id="takeawayvalue_div" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                              <span class="search_btn_member_invoice"><a href="#" style="display:none" id="utakeaway" class="utakeaway" >GO</a></span>
                                                            </span>
                                                          <span class="col-sm-1 nopadding" id="takeawayvalue_div" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                                              <span  class="search_btn_member_invoice"><a href="#" style="display:block" id="selection_takeaway_div" class="apply_all">APPLY ALL</a></span>
                                                              <span  class="search_btn_member_invoice"><a href="#" style="display:block;left: 80px;position: absolute;width: 70px; top: 0px;background-color: #7a4242" id="selection_dinein_div" class="delete_all_rate">DELETE ALL</a></span>
                                                          </span>
                                                          
                                                          
                                                          <?php  if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?>
                                                          
                                                          <span style="position: absolute;color: darkred;margin-left: -383px;font-weight: bold;margin-top: 35px;"> [Urban piper rate may also change accordingly]   </span> 
                                                          
                                                          <?php } ?>
                                                                       <input type="hidden" name="takeawayvalue" id="takeawayvalue" value="<?=$_SESSION['menuidselect']?>" />                    
                                                
                                                        <span style="height:15px;text-align: center;width: 100%;float: left"><span id="takestatus" style="padding-left:0px; padding-top:0px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span></span>          
                                                        </span><!---->
							<span class="tab_table_cont_cc" >
                                                 <table class="responstable" id="takeawayratetab">
                                                 <thead>
                                                  <tr>
                                                      <th>Rate Type</th>
                                                    <th><?=$_SESSION['s_portionname']?></th>
                                                      <th>Online</th>
                                                    <th>Unit Type</th>
                                                    <th>Unit Weight</th>
                                                    <th>Unit Id</th>
                                                    <th>Base unit Id</th>
                                                    <th>Rate</th>
                                                       <th>Tax</th>
                                                          <th>Final Rate</th>
                                                      <th>Barcode</th>
                                                    <th>Edit</th>
                                                  </tr>
                                                  </thead>
                                                <tbody>
                                                    <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratetakeaway where mta_menuid='".$_SESSION['menuidselect']."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    
					$portion_name=$database->show_portion_ful_details($result_cat_s['mta_portion']);
                              $menubase_unit_name='';
                                         if($result_cat_s['mta_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mta_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mta_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mta_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $takeaway_id =$result_cat_s['mta_rate'].'|'.$result_cat_s['mta_portion'].'|'.$result_cat_s['mta_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mta_unit_id'].'|'.$result_cat_s['mta_unit_weight'].'|'.$result_cat_s['mta_unit_type'].'|'.$result_cat_s['mta_barcode'].'|'.$result_cat_s['mta_food_partner'].'|'.$result_cat_s['mta_menu_tax_amount'].'|'.$result_cat_s['mta_menu_final_amount'].'|'.$result_cat_s['mta_menu_tax_value'];
?>        
    <tr>    
              <td><?=$result_cat_s['mta_rate_type']?></td>  
              <td ><?=$portion_name['pm_portionname']?></td>
              <td><?=$result_cat_s['mta_food_partner']?></td>
              <td><?=$result_cat_s['mta_unit_type']?></td>
               <td><?=$result_cat_s['mta_unit_weight']?></td>
               <td><?=$menu_unit_name?></td>
               <td><?=$menubase_unit_name?></td>
               <td><?=number_format($result_cat_s['mta_rate'],$_SESSION['be_decimal'])?></td>
                <td><?=number_format($result_cat_s['mta_menu_tax_amount'],$_SESSION['be_decimal'])?></td>
                 <td><?=number_format($result_cat_s['mta_menu_final_amount'],$_SESSION['be_decimal'])?></td>
                <td><?=$result_cat_s['mta_barcode']?></td>
            <td> 
                <a class="tab_edt_btn10" href="#" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" id2="<?=$takeaway_id?>"><i class="glyphicon glyphicon-trash"></i></a>
             
                 <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mta_menuid']?>" poid="b_<?=$result_cat_s['mta_portion']?>" class="takeeditrate" id1="<?=$takeaway_id?>" href="#" ><i class="fa fa-edit"></i></a>
                 <a style="font-size: 15px;padding-left: 4px; display: none;" class="ntakeeditrate"  href="#" ><i class="fa fa-edit"></i></a>
            </td>
          </tr>
  <?php $k++;}} ?>
                                                </tbody>
                                                </table>
                                                </span>  <!--tab_table_cont_cc-->  
                                                </span>
                
                
 <!-----------------------------------------Takeaway End----------------------------------------------->               
                
                
                
   <!-----------------------------------------Rommservice start----------------------------------------------->             
                
                
                                                
                                                <span style="display:none" id="room">
                                                      <span class="tab_sub_head" style="">
                                                     <span class="form-group" style="  width: 33% !important;float: left;margin-right: 5px;">
                                                          <?php 
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){$i=0;
                                                                                  ?>
<!--                                                            <select data-placeholder="Enter Portion"  class="form-control add_new_dropdown">
                                                                    <option value="" selected="selected">--Portion--</option>                                          						  
                                                                    <option value="1">Single</option>
                                                                    <option value="2">Half</option>
                                                                    <option value="3">Full</option>
                                     				   </select>-->
                                                         
                                                          <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="rmserviceportion" name="rmserviceportion" data-rel="chosen" title="" left"." data-toggle="tooltip" class="form-control add_new_dropdown roomselect" <?php if($_SESSION['s_portnuse']=="N"){ ?> disabled="disabled" <?php } ?>>
                                        <?php if($_SESSION['s_portnuse']=="Y"){ ?> <option value="">--<?=$_SESSION['s_portionname']?>--</option>  <?php } ?>
                                        
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{ 
									?>
                                            <option value="<?=$result_kot['pm_id']?>" <?php if($_SESSION['s_portnuse']=="N"){ if($i==0){ ?> selected="selected" <?php }} ?> ><?=$result_kot['pm_portionname']?></option>
                                    <?php  $i++;} ?> 
                                         
                                    	 </select>
                                         <?php } ?>
                                                         
                                        </span>

				         <span class="col-sm-3 no-padding" style="display:inline-block;float:left;">
                                          <input type="text" class="form-control" id="rmservicerate" name="rmservicerate" placeholder="Rate">
                                         </span>
                                        <span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
                                            <span class="search_btn_member_invoice"><a href="#" style="display:block" id="roomservice">GO</a></span>
                                            <span class="search_btn_member_invoice"><a href="#" id="uroomservice" style="display:none" class="uroomservice">GO</a></span>
                                           <input type="hidden" name="rmservicevalue" id="rmservicevalue" value="<?=$_SESSION['menuidselect']?>" />
                                        </span>
                                        <span id="roomstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;"></span>
                                        </span>
                                        <!---->
                                        <span class="tab_table_cont_cc">
                                             <table class="responstable" id="roomservicetab">
                                             <thead>
                                              <tr>
                                                <th><?=$_SESSION['s_portionname']?></th>
                                                <th>Rate</th>
                                                <th>Edit</th>
                                              </tr>
                                              </thead>
<!--                                            <tbody>
                                                    <tr>
                                                      <td>Single</td>
                                                       <td>269.31</td>
                                                    <td> <a class="tab_edt_btn10" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
                                                  </tr>
                                              </tbody>-->
                                              
                                              
                                             <tbody>
                                                    <?php
                    $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_roomservice where mrs_menuid='".$_SESSION['menuidselect']."' "); 
                    $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                            if($num_cat_s){$k=0;
                                    while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
                                            {
                                                 $roomservice_id =$result_cat_s['mrs_rate'].'|'.$result_cat_s['mrs_portion'];
                                                 $portion_name=$database->show_portion_ful_details($result_cat_s['mrs_portion']);
                    ?>
                        <tr>
                                  <td ><?=$portion_name['pm_portionname']?></td>
                                   <td><?=$result_cat_s['mrs_rate']?></td>
                                <td> 
<!--                                    <a class="tab_edt_btn13" href="#" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>"><i class="glyphicon glyphicon-trash"></i></a>-->
                                <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrs_menuid']?>" poid="b_<?=$result_cat_s['mrs_portion']?>" class="roomeditrate" id1="<?=$roomservice_id?>" href="#" ><i class="fa fa-edit"></i></a>
                                <a style="font-size: 15px;padding-left: 4px; display: none;" class="nroomeditrate"  href="#" ><i class="fa fa-edit"></i></a>
                                </td>
                              </tr>
                      <?php $k++;}} ?>
                                                </tbody>
                                              
                                            </table>
                                            </span>
                                        <!--tab_table_cont_cc-->
                                        </span>
                                        
               <!-----------------------------------------Rommservice End----------------------------------------------->                         
         <!-----------------------------------------Countersale start----------------------------------------------->                               
  <span style="display:none" id="counter">
    <span class="tab_sub_head" style="">
        <span class="form-group" style="width:90% !important;">
            <span class="col-sm-3 tab_text_box_cc no-padding" id="csportionunitspan" style="display:inline-block;float:left;  width: 10% !important;">
                <input type="text" class="form-control add_new_dropdown dineinselect portionselect" id="csportionselect" value="<?=$search_menurate_type?>"  readonly>
            </span>
        
        
    <span class="form-group" id="csportionselectspan" style="  width: 10% !important;float: left;margin-right: 5px; display:none">
         <?php 
         $sql_kot  =  $database->mysqlQuery("select * from tbl_portionmaster"); 
          $num_kot   = $database->mysqlNumRows($sql_kot);
          if($num_kot){$i=0;
          ?>
<!--       <select data-placeholder="Enter Portion"  class="form-control add_new_dropdown">
         <option value="" selected="selected">--Portion--</option>                                          						  
         <option value="1">Single</option>
         <option value="2">Half</option>
       <option value="3">Full</option>
         </select>-->
             <select data-placeholder="Enter <?=$_SESSION['s_portionname']?>" id="countersaleportion" name="countersaleportion" data-rel="chosen" title=""  data-toggle="tooltip" class="form-control add_new_dropdown counterselect" <?php if($_SESSION['s_portnuse']=="N"){ ?> disabled="disabled" <?php } ?>>
                 <option value="">Select</option> 

                 <?php 
                                                while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                                        { 
                                                ?>
                    <option value="<?=$result_kot['pm_id']?>" <?php if($_SESSION['s_portnuse']=="N"){ if($i==0){ ?> selected="selected" <?php }} ?> ><?=$result_kot['pm_portionname']?></option>
            <?php  $i++;} ?> 

                 </select>
                 <?php } ?>                                                                               
       </span>
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="cspacketloosespan" style="display:none;float:left;width:11% !important">
                                                        
                                                    <input type="text" class="form-control add_new_dropdown dineinselect pack-loose-select" id="cspackloose" value="<?=$search_menu_unittype?>" readonly >
                                                </span> 
                                                            
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="csweightspan" style="display:none;float:left;width:10% !important">
                                                    <input type="text" class="form-control" id="csweight"  placeholder="Weight">
                                                </span>
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="cskglitterspan" style="display:none;float:left;width:7% !important">
                                                        <select class="form-control add_new_dropdown counterselect kg-lt-select" id="cskglit">
                                                      <?php
                                                            $sql_unit  =  $database->mysqlQuery("select um.u_name,um.u_id from tbl_base_unit_master u left join tbl_unit_master_combination uc on u.bu_id = uc.um_first_id left join tbl_unit_master um on um.u_id = uc.um_second_id where uc.um_first_id = '".$search_menubase_unit."' "); 
                                                    $num_unit  = $database->mysqlNumRows($sql_unit);
                                                    if($num_unit){
                                                      while($result_unit  = $database->mysqlFetchArray($sql_unit)) 
                                                              {
                                                          ?>
                                                                <option value="<?=$result_unit['u_id']?>"><?=$result_unit['u_name']?></option>

                                                            <?php    
                                                              }
                                                    }
                                                          ?>
                                                    </select>
                                                </span>  
                                               
                                                             
                                                <span class="col-sm-3 tab_text_box_cc  no-padding" id="csbaseunitspan" style="display:none;float:left;width:10% !important">
                                                    <span style="color: #000" class="kg-num-text">1</span>
                                                    <input style="width: 80%;float: right" type="text" class="form-control" id="csbaseunit" value="<?=$menubase_unit?>"  readonly>
                                                </span>
            
                              <span class="col-sm-3 tab_text_box_cc no-padding"  id="" style="width: 10% !important;float:left;">
                                  <input type="text" class="form-control" onkeyup="rate_calc_plu();" id="cs_menu_rate" name="" placeholder="Menu Rate">
                                                </span>   
            
                                   <span class="col-sm-3 tab_text_box_cc no-padding"  id="" style="width: 10% !important;float:left;">
                                                <input type="text" class="form-control" onkeyup="rate_calc_plu();"  id="cs_menu_tax" name="" placeholder="Tax %">
                                                </span>   
            
                         <span class="col-sm-3 tab_text_box_cc no-padding"  id="" style="width: 10% !important;float:left;">
                             <input type="text" class="form-control" readonly  id="cs_menu_tax_amt" name="" placeholder="Tax Amount">
                                                </span>   
            
            
                                                <span class="col-sm-3 tab_text_box_cc no-padding"  id="csretespan" style="width: 10% !important;float:left;">
                                                    <input readonly type="text" class="form-control" id="countersalerate" name="countersalerate" placeholder="Rate">
                                                </span>                                         
                                                    <span class="col-sm-3 tab_text_box_cc  no-padding" id="csbarcodespan" style="display:inline-block;float:left;width:15% !important">
                                                        <input type="text" class="form-control"   <?php if($manual_barcode=='N'){ ?> readonly <?php } ?>  id="csbarcode" placeholder="Barcode" >
                                                    </span>
                                                    
                                                        </span>        


<span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
    <span class="search_btn_member_invoice"><a href="#" style="display:block" id="countersale">GO</a></span>
</span>
<span class="col-sm-1 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
    <span class="search_btn_member_invoice"><a href="#" style="display:none" class="ucountersale" id="ucountersale">GO</a></span>
    </span>
<span class="col-sm-3 nopadding" style="  margin: 1px 0 -13px 0;display: inline-block;float: left;">
    <span style="width: 75px;" class="search_btn_member_invoice"><a href="#" style="display:block" id="selection_counter_div" class="apply_all ">APPLY ALL</a></span>
    <span  class="search_btn_member_invoice"><a href="#" style="display:block;left: 110px;position: absolute;width: 70px; top: -5px;background-color: #7a4242;margin-left: 0px;    margin-top: 5px;" id="selection_dinein_div" class="delete_all_rate">DELETE ALL</a></span>
<input type="hidden" name="countersalevalue" id="countersalevalue" value="<?=$_SESSION['menuidselect']?>" />
</span>
        <span style="height:15px;text-align: center;width: 100%;float: left"><span id="counterstatus" style="padding-left:0px; padding-top:0px;  display: inline-block; color:#ff0000; font-weight:bold;"></span></span>
</span>
<!---->
<span class="tab_table_cont_cc">
                                             <table class="responstable" id="countersaletab" >
                                             <thead>
                                              <tr>
                                                  <th>Rate Type</th>
                                                <th><?=$_SESSION['s_portionname']?></th>
                                                <th>Unit Type</th>
                                                <th>Unit Weight</th>
                                                <th>Unit Id</th>
                                                <th>Base unit Id</th>
                                                <th>Rate</th>
                                                 <th>Barcode</th>
                                                <th>Edit</th>
                                              </tr>
                                              </thead>
<!--                                            <tbody>
                                                    <tr>
                                                      <td>Single</td>
                                                       <td>269.31</td>
                                                    <td> <a class="tab_edt_btn10" href="#"><i class="glyphicon glyphicon-trash"></i></a></td>
                                                  </tr>
                                              </tbody>-->
                                              
                                                    <tbody>
                                                    <?php
                                                    
                    $sql_cat_s  =  $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$_SESSION['menuidselect']."' "); 
                    $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                            if($num_cat_s){$k=0;
                                    while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
                                            {
                                                
                                                $portion_name=$database->show_portion_ful_details($result_cat_s['mrc_portion']);
                                                $menubase_unit_name='';
                                         if($result_cat_s['mrc_base_unit_id']!=''){
                                         $sql_baseunit  =  $database->mysqlQuery("select * from tbl_base_unit_master where bu_id='".$result_cat_s['mrc_base_unit_id']."'"); 
                                        $num_baseunit  = $database->mysqlNumRows($sql_baseunit);
                                        if($num_baseunit){
                                          $result_baseunit  = $database->mysqlFetchArray($sql_baseunit); 
                                            $menubase_unit_name=$result_baseunit['bu_name'];

                                                  }			
                                            }
                                          $menu_unit_name='';  
                                        if($result_cat_s['mrc_unit_id']!=''){
                                        $sql_unit  =  $database->mysqlQuery("select * from tbl_unit_master where u_id='".$result_cat_s['mrc_unit_id']."'"); 
                                        //echo "select * from tbl_unit_master where u_id='".$result_cat_s['mmr_unit_id']."'";
                                        $num_unit  = $database->mysqlNumRows($sql_unit);
                                        if($num_unit){ 
                                          $result_unit  = $database->mysqlFetchArray($sql_unit); 
                                                  
                                                        $menu_unit_name=$result_unit['u_name'];

                                                  }			
                                            } 
                                            $counter_id =$result_cat_s['mrc_rate'].'|'.$result_cat_s['mrc_portion'].'|'.$result_cat_s['mrc_rate_type'].'|'.$menubase_unit_name.'|'.$result_cat_s['mrc_unit_id'].'|'.$result_cat_s['mrc_unit_weight'].'|'.$result_cat_s['mrc_unit_type'].'|'.$result_cat_s['mrc_barcode'];

                    ?>
                        <tr>
                                    <td><?=$result_cat_s['mrc_rate_type']?></td>
                                    <td ><?=$portion_name['pm_portionname']?></td>
                                    <td><?=$result_cat_s['mrc_unit_type']?></td>
                                    <td><?=$result_cat_s['mrc_unit_weight']?></td>
                                    <td><?=$menu_unit_name?></td>
                                    <td><?=$menubase_unit_name?></td>
                                   <td><?=number_format($result_cat_s['mrc_rate'],$_SESSION['be_decimal'])?></td>
                                     <td><?=$result_cat_s['mrc_barcode']?></td>
                                <td> 
                                    <a class="tab_edt_btn14" href="#" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" id2="<?=$counter_id?>"><i class="glyphicon glyphicon-trash"></i></a>
                                 <a style="font-size: 15px;padding-left: 4px;display: inline-block ;" id="m_<?=$result_cat_s['mrc_menuid']?>" poid="b_<?=$result_cat_s['mrc_portion']?>" class="countereditrate" id1="<?=$counter_id?>" href="#" ><i class="fa fa-edit"></i></a>
                                <a style="font-size: 15px;padding-left: 4px; display: none;" class="ncountereditrate"  href="#" ><i class="fa fa-edit"></i></a>
                                </td>
                              </tr>
                      <?php $k++;}} ?>
                                                </tbody>        
                                                                                         
                                              
                                            </table>
                                            </span>
<!--tab_table_cont_cc-->
</span>
<!-----------------------------------------CounterSale End----------------------------------------------->                                                
                                                
                                               </span><!--about-->
                                              </span>
                                            </div>

<script>
    
   function rate_calc_plu_di(){
    
      var decimal=$('#decimal').val();   
    
   var di_menu_rate=parseFloat($('#di_menu_rate').val());
   
   var di_menu_tax=parseFloat($('#di_tax_value').val());
    
    if(di_menu_tax!='' && di_menu_tax >0 ){
        
    var tax_calc=(di_menu_tax/100);
      
    var tot_rate=(di_menu_rate/(1+tax_calc));
    
    if(decimal=='2'){
    var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,2})?/)[0]);
    }else{
      var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,3})?/)[0]);   
        
    }
    
    $('#dineinrate').val(tt);
    
      var tax_amt=(di_menu_rate-tt);
    
     $('#di_tax_amount').val(tax_amt); 
     
        }else{
           $('#dineinrate').val(di_menu_rate);   
       }
       
       var rt=(di_menu_tax/100)+1;
       
       
      $('#di_tax_value').prop('title', 'Rate Change tax Incl value : '+rt); 
       
    
} 
    
  function rate_calc_plu_ta(){
      
        var decimal=$('#decimal').val();   
    
   var ta_menu_rate=parseFloat($('#ta_menu_rate').val());
   
   var ta_menu_tax=parseFloat($('#ta_tax_value').val());
    
    if(ta_menu_tax!='' && ta_menu_tax >0 ){
        
    var tax_calc=(ta_menu_tax/100);
      
    var tot_rate=(ta_menu_rate/(1+tax_calc));
    
    if(decimal=='2'){
    var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,2})?/)[0]);
    }else{
      var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,3})?/)[0]);   
        
    }
    
    
    $('#takeawayrate').val(tt);
    
      var tax_amt=(ta_menu_rate-tt);
    
     $('#ta_tax_amount').val(tax_amt); 
     
        }else{
           $('#takeawayrate').val(ta_menu_rate);   
       }
    
    
     var rt=(ta_menu_tax/100)+1;
       
       
      $('#ta_tax_value').prop('title', 'Rate Change tax Incl value : '+rt); 
    
}



function rate_calc_plu(){
    
    var decimal=$('#decimal').val();   
    
    var cs_menu_rate=parseFloat($('#cs_menu_rate').val());
   
    var cs_menu_tax=parseFloat($('#cs_menu_tax').val());
    
    if(cs_menu_tax!='' && cs_menu_tax >0 ){
        
    var tax_calc=(cs_menu_tax/100);
      
    var tot_rate=(cs_menu_rate/(1+tax_calc));
    if(decimal=='2'){
    var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,2})?/)[0]);
    }else{
      var tt=(tot_rate.toString().match(/^-?\d+(\.\d{0,3})?/)[0]);   
        
    }
   // alert(tt);
    $('#countersalerate').val(tt);
    
      var tax_amt=(cs_menu_rate-tt);
    
     $('#cs_menu_tax_amt').val(tax_amt); 
     
        }else{
           $('#countersalerate').val(cs_menu_rate);   
       }
    
    
    var rt=(cs_menu_tax/100)+1;
       
       
      $('#cs_menu_tax').prop('title', 'Rate Change tax Incl value : '+rt); 
    
}
        //alert(b);
        if($('#dipackloose').val()=='Packet')
        {
            $('#diportionunitspan').css('display','block');
            $('#diportionselectspan').css('display','none');
            $('#dipacketloosespan').css('display','block');
            $('#diweightspan').css('display','block');
            $('#dikglitterspan').css('display','block');
            $('#dibaseunitspan').css('display','none');
        }
        else if($('#dipackloose').val()=='Loose')
        {
            $('#diportionunitspan').css('display','block');
            $('#diportionselectspan').css('display','none');
            $('#dipacketloosespan').css('display','block');
            $('#diweightspan').css('display','none');
            $('#dikglitterspan').css('display','none');
            $('#dibaseunitspan').css('display','block');
        }
        if($('#tapackloose').val()=='Packet')
        {
        
            $('#taportionunitspan').css('display','block');
            $('#taportionselectspan').css('display','none');
            $('#tapacketloosespan').css('display','block');
            $('#taweightspan').css('display','block');
            $('#takglitterspan').css('display','block');
            $('#tabaseunitspan').css('display','none');
        }
        else if($('#tapackloose').val()=='Loose')
        {
            $('#taportionunitspan').css('display','block');
            $('#taportionselectspan').css('display','none');
            $('#tapacketloosespan').css('display','block');
            $('#taweightspan').css('display','none');
            $('#takglitterspan').css('display','none');
            $('#tabaseunitspan').css('display','block');
        }
        if($('#cspackloose').val()=='Packet')
        {
            $('#csportionunitspan').css('display','block');
            $('#csportionselectspan').css('display','none');
            $('#cspacketloosespan').css('display','block');
            $('#csweightspan').css('display','block');
            $('#cskglitterspan').css('display','block');
            $('#csbaseunitspan').css('display','none');
        }
                
        else if($('#cspackloose').val()=='Loose')
        {
            $('#csportionunitspan').css('display','block');
            $('#csportionselectspan').css('display','none');
            $('#cspacketloosespan').css('display','block');
            $('#csweightspan').css('display','none');
            $('#cskglitterspan').css('display','none');
            $('#csbaseunitspan').css('display','block');
        }
    
  function departmentselect(c,department){
        
            $("#update_dinein").css("display","none");
            $("#submit_dinein").css("display","block");
            $("#utakeaway").css("display","none");
            $("#takeaway").css("display","block");
            $("#ucountersale").css("display","none");
            $("#countersale").css("display","block");
       
            if(c=='Portion'){
                
                $('#diportionunitspan').css('display','block');
                $('#diportionselectspan').css('display','block');
                $('#dipacketloosespan').css('display','none');
                $('#diweightspan').css('display','none');
                $('#dikglitterspan').css('display','none');
                $('#dibaseunitspan').css('display','none');
                $('#dineinrate').val('');

                $('#taportionunitspan').css('display','block');
                $('#taportionselectspan').css('display','block');
                $('#tapacketloosespan').css('display','none');
                $('#taweightspan').css('display','none');
                $('#takglitterspan').css('display','none');
                $('#tabaseunitspan').css('display','none');
                $('#takeawayrate').val('');

                $('#csportionunitspan').css('display','block');
                $('#csportionselectspan').css('display','block');
                $('#cspacketloosespan').css('display','none');
                $('#csweightspan').css('display','none');
                $('#cskglitterspan').css('display','none');
                $('#csbaseunitspan').css('display','none');
                $('#countersalerate').val('');

            }
            else if(c=='Unit')
            {


             if($('#dipackloose').val()=='Packet')
             {
                $('#diportionunitspan').css('display','block');
                $('#diportionselectspan').css('display','none');
                $('#dipacketloosespan').css('display','block');
                $('#diweightspan').css('display','block');
                $('#dikglitterspan').css('display','block');
                $('#dibaseunitspan').css('display','none');
                $('#diweight').prop('disabled',false);
                 $('#diweight').val('');
                 $('#dikglit').val('1');
                 $('#dineinrate').val('');
                 $('#dibarcode').prop('disabled',false);
                 $('#dibarcode').val('');

            }
            else if($('#dipackloose').val()=='Loose')
            {
                $('#diportionunitspan').css('display','block');
                $('#diportionselectspan').css('display','none');
                $('#dipacketloosespan').css('display','block');
                $('#diweightspan').css('display','none');
                $('#dikglitterspan').css('display','none');
                $('#dibaseunitspan').css('display','block');
                 $('#dineinrate').val('');
                 $('#dibarcode').prop('disabled',false);
                 $('#dibarcode').val('');
            }
            if($('#tapackloose').val()=='Packet')
            {

                $('#taportionunitspan').css('display','block');
                $('#taportionselectspan').css('display','none');
                $('#tapacketloosespan').css('display','block');
                $('#taweightspan').css('display','block');
                $('#takglitterspan').css('display','block');
                $('#tabaseunitspan').css('display','none');
                $('#taweight').prop('disabled',false);
                $('#taweight').val('');
                 $('#takglit').val('1');
                 $('#takeawayrate').val('');
                 $('#tabarcode').prop('disabled',false);
                 $('#tabarcode').val('');
            }
            else if($('#tapackloose').val()=='Loose')
            {
                $('#taportionunitspan').css('display','block');
                $('#taportionselectspan').css('display','none');
                $('#tapacketloosespan').css('display','block');
                $('#taweightspan').css('display','none');
                $('#takglitterspan').css('display','none');
                $('#tabaseunitspan').css('display','block');
                 $('#takeawayrate').val('');
                 $('#tabarcode').prop('disabled',false);
                 $('#tabarcode').val('');
            }
            if($('#cspackloose').val()=='Packet')
            {
                $('#csportionunitspan').css('display','block');
                $('#csportionselectspan').css('display','none');
                $('#cspacketloosespan').css('display','block');
                $('#csweightspan').css('display','block');
                $('#cskglitterspan').css('display','block');
                $('#csbaseunitspan').css('display','none');
                $('#csweight').val('');
                $('#csweight').prop('disabled',false);
                 $('#cskglit').val('1');
                 $('#countersalerate').val('');
                 $('#csbarcode').prop('disabled',false);
                 $('#csbarcode').val('');
            }

            else if($('#cspackloose').val()=='Loose')
            {
                $('#csportionunitspan').css('display','block');
                $('#csportionselectspan').css('display','none');
                $('#cspacketloosespan').css('display','block');
                $('#csweightspan').css('display','none');
                $('#cskglitterspan').css('display','none');
                $('#csbaseunitspan').css('display','block');
                 $('#countersalerate').val('');
                 $('#csbarcode').prop('disabled',false);
                 $('#csbarcode').val('');
            }
            }
            var menuid
            if(department=='DI'){
                
                $('#di_tax_amount').val('');
                 $('#di_menu_rate').val('');
                 $('#di_tax_value').val('');
                
                menuid =$("#dineinvalue").val();
                $.ajax({
                    type: "POST",
                    url: "load_divdinein.php",
                    data: "value=select_department&mid="+menuid,
                    success: function(msg)
                    {   
                        $('#dinein').html(msg);
                       
                    $('#dineinportion').val('1');
                  

                        
                    }
                });
               
               
            }
            else if(department=='TA'){
                
                $('#ta_tax_amount').val('');
                 $('#ta_menu_rate').val('');
                 $('#ta_tax_value').val('');
                
                $('#ta_food_selectspan').show();
                menuid =$("#takeawayvalue").val();
                $.ajax({
                    type: "POST",
                    url: "load_divtakeawayrate.php",
                    data: "value=select_department&mid="+menuid,
                    success: function(msg)
                    {   
                        $('#takeawayratetab').html(msg);
                        
                        $('#takeawayportion').val('1');
                    }
                });
            }
            else if(department=='CS'){
                
                $('#cs_menu_tax_amt').val('');
                 $('#cs_menu_rate').val('');
                 $('#cs_menu_tax').val('');
                
                
                
                menuid =$("#countersalevalue").val();
                $.ajax({
                    type: "POST",
                    url: "load_divcountersalerate.php",
                    data: "value=select_department&mid="+menuid,
                    success: function(msg)
                    {   
                        $('#countersaletab').html(msg);
                        $('#countersaleportion').val('1');
                    }
                });
            }
        }
        
   
        
    </script>
