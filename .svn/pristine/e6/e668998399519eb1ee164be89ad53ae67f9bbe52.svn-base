<?php

session_start(); 

        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
        }else{
            
            error_reporting(0);
            echo '<span style="color:red;font-size:12px;font-weight:bold;text-align:center">* WARNING : CHECK INTERNET STABILITY *</span>';
           
        }

?>
<link rel="shortcut icon" href="img/favicon.ico">



<!DOCTYPE HTML>
<html><head>
    <meta http-equiv="Cache-control" content="no-cache">    
        
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>QR </title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away_new.css" rel="stylesheet" type="text/css">
<style>
    .confrmation_overlay_auth{
	width:100%;
	height:100%;
	position:fixed;
	z-index:99999;
	background-color:rgba(0,0,0,0.8);
	top:0;
        display: none;
        text-align:center;
	padding-top:150px
}

.confrmation_overlay_auth img{
    
    width:100px;
    height:100px;
   
}


.online_order_history_btn{width: 140px;    margin-left: 2%;}
.acc_table_scroll tbody {height: 56vh;}
.new_order_box_sc .take-away-quee-box {width:12%}
.online_order_history_btn img{width: 20px;}
.new_item_sm_pop{    height: 470px;}
@media (max-width:1100px){
  .new_order_box_sc .take-away-quee-box {width:15%}
}
@media (max-width:800px){
  .new_order_box_sc .take-away-quee-box {width:40%; margin:1%; margin-left:5%;}
  .online_order_history_btn{width: 70px;margin-left: 2%;font-size:5px;margin:2px!important; float:right!important; display: inline-block;}
}
</style>

   <script src="../js/jquery-1.10.2.min.js"></script>  
    
   <script type="text/javascript">
   $(document).ready(function () {
               
    setInterval(function () {
             
         location.reload();
             
    }, 300000);     
      
      
      
      
                
    setInterval(function () {
       
        var datastringnewcard="set=load_qr_order_all";
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {  
            $('.take-away-quee-contant-cc').html(data);
        } 
        });
         
         $.post("../autoload_menu.php", {set:'qr_order'},
					function(data)
					{
                                           
					 data=$.trim(data).split('*');
                                     
                                         var ub_count=  $('#count_qr').html();
                                  
                                                if(ub_count>0)
						{ 
						     $('#urbanAudio')[0].play();
						}
                                                
                                              $('#count_qr').html(data[0]);
                                               
                                              if(data[1]=='Y' &&  localStorage.running_order!='Y' ){ 
                                                   localStorage.running_order='Y';
                                                   location.reload();
                                              }
                                              
                                              
                                              
     //////// auto confirm order//////
     
      var auto_accept_qr=$('#auto_accept_qr').val();       
     
      if(auto_accept_qr=='Y'){
          
        var  orders_in=data[2].substring(0,data[2].length - 1);
              
        var ord_count= orders_in.split(',');
              
        for(var i=0;i<=ord_count.length;i++){
           
        if(ord_count[i]!='undefined' && ord_count[i]!=undefined && ord_count[i]!='null'){    
                  
        // $('.main_loader_sec').css('display','block');           
        var datastringnewcard="set=load_qr_auto_confirm&order_in="+ord_count[i];
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {  
          
          
        var dat=$.trim(data).split('*');
         
        if(dat[11]=='TA'){
             
        ////takeaway homedelivery///
          
        var datastringnewcard="set=add_order_qr&order_id="+dat[15]+"&store_id="+dat[3]+"&channel="+dat[4]+"&time="+dat[1]+"&charge="+dat[0];
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
           var homed='HD'; var discount_of='0'; var discount='N'; var discount_unit=''; var discountid='';
       
           var gst=''; var loyalty_redeemamount=''; var id_of_order='';
            
           var dataString = 'value=submitvalues_ta&name=' + dat[5] +'&address=' + dat[7] +'&orderaddr='+ dat[7] +'&landmark=' +
                                dat[8] +'&area=' + dat[9] +'&remarks='+dat[10]+'&mobile=' + dat[6] +'&homed=' + homed
                                + '&discount_of='+ discount_of + '&discount=' + discount + ' &discount_unit='+discount_unit
                                + '&discountid='+discountid+'&gst='+gst
                                +"&redeemamount="+loyalty_redeemamount
                                +"&id_of_order="+id_of_order+"&bill_setup=online_setup";
			
				        $.ajax({
					type: "POST",
					url: "../load_takeaway.php",
					data: dataString,
					success: function(data1) { 
                                            
                                           // $('.main_loader_sec').css('display','none'); 
                                            
                                          }
					});
      
                              }  
                            });
               
         }
         
         
         
         if(dat[11]=='DI'){
            
          ////DINE IN///
          
         var table3= new Array();
        
         var floor= dat[13];
         var table1= $('.table_di');
         var order_qr=dat[15];
         var store_qr=dat[3];
         var  table= dat[12]
         var name_qr=dat[5]
         var num_qr=dat[6]
         
         var run = dat[14];
         
        table1.each(function(){
            
            table3.push(table);
        });
         
       $.post("../load_div.php", {tableid:table3,table:table,steward:'1',persons:'qr',type:'single',set:'check_table_vaccancy'},
       function(data)
       {
                   
         var dt=$.trim(data).split('*');
                   
         if(dt[0]=='yes' || (run=='Y' && dt[2]!='Billed') ){ 
              
        // $('.main_loader_sec').css('display','block'); 
           
         if(run=='Y'){
             
             localStorage.running_order='N'; 
              
             $.post("../menu_order.php", {orderid:dt[1],staffid:'1'},
             function(data)
             {
                
                
              $.post("../load_div.php", {tableid:table,staffid:'1',asciival:'65',set:'table_setting_di'},
              function(data22)
              {
                   var orderno=$.trim(data22);
                
              $.post("load_qr_orders.php", {order_qr:order_qr,store_qr:store_qr,set:'table_di_menu_list',run:'Y'},
              function(data1)
              {
                   
                      var a=JSON.parse(data1);
                      $.each(a, function(i, record) {
                          
                        var mn=record.tqi_menuid;
                        var rate=record.tqi_rate;
                        var portion=record.tqi_portion;
                        var qty=record.tqi_qty;
                      
           var stewardid='1';
                           
           var branchid='1';
         
           var  dataString = 'action=add&tableid='+table+"&floorid="+floor+"&stewardid="+stewardid+"&orderid="+orderno+"&branchid="+branchid+
           "&ratetype=Portion&unittype=&unittype=&unitweight=&baseunitweight=&unitid=&baseunitid=&addon=&qtyval="+qty+"&menu="+mn+
           "&rateval="+rate+"&portionval="+portion+"&mode_qr=DI&order_qr="+order_qr;
  
                            $.ajax({
				type: "POST",
				url: "../response.php",
				data: dataString,
				success: function(data) { 
                                   
                                    
                                        $.post("../itemedit.php", {set:'confirm',waiter:stewardid,order_confirming_staff:stewardid},
					function(data)
					{
                                           
                                            //$.post("../print_details.php", {set:'kotprint'});
                                            
                                            //$.post("../print_details.php", {set:'console'});  
                                            
                                            var kotno=$.trim(data);
                                            
                                            $.post("../print_details.php", {kot:kotno,set:'kotprint',check:'kotmissed'},
                                            function(data1)
                                            { 
                                                
                                            });
                                            
                                            
                                            $.post("../print_details.php", {kot:kotno,set:'console',check:'kotmissed'},
			                    function(data1)
			                    {
                                                
                                            });
                                            
                                        });  
                                        
                                        
                                    
                                            setTimeout(function(){
                                                location.reload();
                                            }, 2000); 
                         } });
                     
                    });  
               });        
                     
            });
                
                
                
            });
              
          }else{ 
                
              $.post("../load_div.php", {tableid:table3,table:table,steward:'1',persons:'qr',type:'single',set:'takeorder'},
          
            function(data)
            {
                 
                    
              $.post("../load_div.php", {tableid:table,staffid:'1',asciival:'65',set:'table_setting_di'},
              function(data22)
                {
                    
                    
                   var orderno=$.trim(data22);
                
              $.post("load_qr_orders.php", {order_qr:order_qr,store_qr:store_qr,set:'table_di_menu_list',run:'N'},
               function(data1)
                {
                     
                   
                   
                      var a=JSON.parse(data1);
                      $.each(a, function(i, record) {
                          
                        var mn=record.tqi_menuid;
                        var rate=record.tqi_rate;
                        var portion=record.tqi_portion;
                        var qty=record.tqi_qty;
                      
         var stewardid='1';
                           
         var branchid='1';
         
          var  dataString = 'action=add&tableid='+table+"&floorid="+floor+"&stewardid="+stewardid+"&orderid="+orderno+"&branchid="+branchid+
          "&ratetype=Portion&unittype=&unittype=&unitweight=&baseunitweight=&unitid=&baseunitid=&addon=&qtyval="+qty+"&menu="+mn+
          "&rateval="+rate+"&portionval="+portion+"&mode_qr=DI&order_qr="+order_qr;
    
                            $.ajax({
				type: "POST",
				url: "../response.php",
				data: dataString,
				success: function(data) { 
                                    
                                    
                                 $.post("../itemedit.php", {set:'confirm',waiter:stewardid,order_confirming_staff:stewardid},
					function(data)
					{
                                            $.post("../print_details.php", {set:'kotprint'});
                                            $.post("../print_details.php", {set:'console'});  
                                            
                                        });  
                                    
                                    setTimeout(function(){
                                       location.reload();
                                    }, 2000); 
                         } });
                     
                    });  
               });        
                     
            });
            
            
   
          }); 
      }
          
    }else{
        
        $('.main_loader_sec').css('display','none'); 
        
       if(run=='Y' && dt[2]=='Billed') {
          alert('TABLE IS BILLED. PLEASE REGENERATE FOR RUNNING ORDER');   
       }else{
         alert('TABLE IS OCCUPIED ALREADY');    
       }
         
    }
         
    });

     
    }
          
           
            
            
        } 
        });
               
        }
             
        }      
              
       /////
       
        }
        
        
                                                
     });
         
               
   }, 5000);
                
                
   });  
         
         
   function settlepopupcommonta(){
   
     window.location.href = "../take_away_.php?settacommon=settletapopup";

   }    
            
  function settlepopupcommondi(){
   
     window.location.href = "../table_selection.php";

  }            
            
  function print_qr_kot(kot,bill,mode){
           
        var check = confirm("CONFIRM KOT ?");
	if(check==true)
	{
              $('.main_loader_sec').css('display','block'); 
              
        if(mode=='TA'){
		var dataString = "bill_kot=online_kot&online_kot="+kot+"&online_bill="+bill+"&mode="+mode;
                
		$.ajax({
		type: "POST",
		url: "../load_takeaway.php",
		data: dataString,
		success: function(data2) {
                  $('.main_loader_sec').css('display','none'); 
                }
            });
        }else{
            
           $.post("../print_details.php", {kot:kot,set:'console',check:'kotmissed'},
			  function(data1)
			  {
                              
			  });
            
            $('.main_loader_sec').css('display','none'); 
        }
       }     
   }  
   
   
  function print_qr_bill(bill,mode){
           
        var check = confirm("CONFIRM PRINT ?");
	if(check==true)
	{
              $('.main_loader_sec').css('display','block'); 
              
              if(mode=='TA'){
		var dataString = "set=reprint_ta_new&homed=HD&billno="+bill+"&mode="+mode;
                
		$.ajax({
		type: "POST",
		url: "../print_details.php",
		data: dataString,
		success: function(data2) {
                  
                    $('.main_loader_sec').css('display','none'); 
        
                }
            });
            
             }else{
                $.post("../print_details.php", {bilno:bill,bill_reprint:'Y',set:'billprint'},
                              function(data)
                              {
                                   $('.main_loader_sec').css('display','none'); 
              });
            }
       }     
     }  
    
    
   function go_home_new(){
         
        window.parent.location.href ="../index.php";
         
   }
    
    
    
   function go_nav(){
        
          $('.main_loader_sec').css('display','block'); 
       
            window.location.href="online_order_screen.php";
    }
    
    function qr_history(){
        
          $('.main_loader_sec').css('display','block'); 
       
            window.location.href=" qr_order_history.php";
    }
    
    
    function table_ok(){
        
        $('.main_loader_sec').css('display','block'); 
        
         var table3= new Array();
        
         var floor= $('#floor_di').val();
         var  table1= $('.table_di');
         var order_qr=$('#table_di').attr('qr_order');
         var store_qr=$('#table_di').attr('store_qr');
         
         var  table= $('#table_di').val();
         
         var name_qr= $('#table_di').attr('name_qr');
         var num_qr= $('#table_di').attr('num_qr');
         
         var run = $('#table_di').attr('run');
         
        table1.each(function(){
            
            table3.push(table);
        });
         
       $.post("../load_div.php", {tableid:table3,table:table,steward:'1',persons:'qr',type:'single',set:'check_table_vaccancy'},
              function(data)
               {
                   
         var dt=$.trim(data).split('*');
                   
         if(dt[0]=='yes' || (run=='Y' && dt[2]!='Billed') ){ 
              
         $('.main_loader_sec').css('display','block'); 
           
         if(run=='Y'){
             
              
               localStorage.running_order='N'; 
              
              
             $.post("../menu_order.php", {orderid:dt[1],staffid:'1'},
                function(data)
            {
                
                
              $.post("../load_div.php", {tableid:table,staffid:'1',asciival:'65',set:'table_setting_di'},
              function(data22)
                {
                   var orderno=$.trim(data22);
                
              $.post("load_qr_orders.php", {order_qr:order_qr,store_qr:store_qr,set:'table_di_menu_list',run:'Y'},
              function(data1)
                {
                   
                      var a=JSON.parse(data1);
                      $.each(a, function(i, record) {
                          
                        var mn=record.tqi_menuid;
                        var rate=record.tqi_rate;
                        var portion=record.tqi_portion;
                        var qty=record.tqi_qty;
                      
           var stewardid='1';
                           
           var branchid='1';
         
           var  dataString = 'action=add&tableid='+table+"&floorid="+floor+"&stewardid="+stewardid+"&orderid="+orderno+"&branchid="+branchid+
           "&ratetype=Portion&unittype=&unittype=&unitweight=&baseunitweight=&unitid=&baseunitid=&addon=&qtyval="+qty+"&menu="+mn+
           "&rateval="+rate+"&portionval="+portion+"&mode_qr=DI&order_qr="+order_qr;
  
                            $.ajax({
				type: "POST",
				url: "../response.php",
				data: dataString,
				success: function(data) { 
                                   
                                    
                                 $.post("../itemedit.php", {set:'confirm',waiter:stewardid,order_confirming_staff:stewardid},
					function(data)
					{
                                           
                                            $.post("../print_details.php", {set:'kotprint'});
                                            
                                            $.post("../print_details.php", {set:'console'});  
                                            
                                        });  
                                    
                                    setTimeout(function(){
                                        location.reload();
                                    }, 1000); 
                         } });
                     
                    });  
               });        
                     
            });
                
                
                
            });
              
          }else{ 
              
              $.post("../load_div.php", {tableid:table3,table:table,steward:'1',persons:'qr',type:'single',set:'takeorder'},
          
            function(data)
            {
                 
                    
              $.post("../load_div.php", {tableid:table,staffid:'1',asciival:'65',set:'table_setting_di'},
              function(data22)
                {
                    
                    
                   var orderno=$.trim(data22);
                
              $.post("load_qr_orders.php", {order_qr:order_qr,store_qr:store_qr,set:'table_di_menu_list',run:'N'},
               function(data1)
                {
                     
                   
                   
                      var a=JSON.parse(data1);
                      $.each(a, function(i, record) {
                          
                        var mn=record.tqi_menuid;
                        var rate=record.tqi_rate;
                        var portion=record.tqi_portion;
                        var qty=record.tqi_qty;
                      
         var stewardid='1';
                           
         var branchid='1';
         
          var  dataString = 'action=add&tableid='+table+"&floorid="+floor+"&stewardid="+stewardid+"&orderid="+orderno+"&branchid="+branchid+
          "&ratetype=Portion&unittype=&unittype=&unitweight=&baseunitweight=&unitid=&baseunitid=&addon=&qtyval="+qty+"&menu="+mn+
          "&rateval="+rate+"&portionval="+portion+"&mode_qr=DI&order_qr="+order_qr;
    
                            $.ajax({
				type: "POST",
				url: "../response.php",
				data: dataString,
				success: function(data) { 
                                    
                                    
                                 $.post("../itemedit.php", {set:'confirm',waiter:stewardid,order_confirming_staff:stewardid},
					function(data)
					{
                                            $.post("../print_details.php", {set:'kotprint'});
                                            $.post("../print_details.php", {set:'console'});  
                                            
                                        });  
                                    
                                    setTimeout(function(){
                                       location.reload();
                                    }, 2000); 
                         } });
                     
                    });  
               });        
                     
            });
            
            
   
          }); 
      }
          
    }else{
        
        $('.main_loader_sec').css('display','none'); 
        
       if(run=='Y' && dt[2]=='Billed') {
          alert('TABLE IS BILLED. PLEASE REGENERATE FOR RUNNING ORDER');   
       }else{
         alert('TABLE IS OCCUPIED ALREADY');    
       }
       
        
        
        
       
    }
         
      });

    }
    
    
    function confirm_order(charge,time,order,store,channel,name,phone,address,landmark,area,remarks,mode,table,floor,run){
        
        if(mode=='TA'){
        
        var check = confirm("NOTICE : ONCE ACCEPETED DELIVERY ORDERS CAN'T BE CANCELLED ?");
	if(check==true)
	{
            
         $('.main_loader_sec').css('display','block'); 
        
         var datastringnewcard="set=add_order_qr&order_id="+order+"&store_id="+store+"&channel="+channel+"&time="+time+"&charge="+charge;
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
        
           var homed='HD'; var discount_of='0'; var discount='N'; var discount_unit=''; var discountid='';
       
           var gst=''; var loyalty_redeemamount=''; var id_of_order='';
            
            var dataString = 'value=submitvalues_ta&name=' + name +'&address=' + address +'&orderaddr='+ address +'&landmark=' +
                                landmark +'&area=' + area +'&remarks='+remarks+'&mobile=' + phone +'&homed=' + homed
                                + '&discount_of='+ discount_of + '&discount=' + discount + ' &discount_unit='+discount_unit
                                + '&discountid='+discountid+'&gst='+gst
                               
                                +"&redeemamount="+loyalty_redeemamount
                               +"&id_of_order="+id_of_order+"&bill_setup=online_setup";
			
				
				 $.ajax({
					type: "POST",
					url: "../load_takeaway.php",
					data: dataString,
					success: function(data1) { 
                                            
                                           $('.main_loader_sec').css('display','none'); 
  
      
                                          }
					});
      
      
                              }  
                            });
       
        }
        
        }else{
            
          $('.di_popup_sec').css('display','block');   
        
          $('#floor_di').val(floor);
          $('#table_di').val(table);
          $('#table_di').attr('qr_order',order);
          $('#table_di').attr('store_qr',store);
          $('#table_di').attr('name_qr',name);
          $('#table_di').attr('num_qr',phone);
          $('#table_di').attr('run',run);
           
          if(run=='Y'){
               
          $('#floor_di').css('pointer-events','none');
          $('#table_di').css('pointer-events','none');
          
          }
           
           
        
    }
       
    }
    
    
   function cancel_di_close(){
        
        $('.di_popup_sec').css('display','none');   
        $('#floor_di').val('');
        $('#table_di').val('');
   }
    
    
  function load_urban_items(ord,store){
       
         $('.main_loader_sec').css('display','block'); 
         var datastringnewcard="set=list_qr_order&order_id="+ord+"&branch="+store;
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {      
          
          $('#urban_item_div').show();
          $('#load_data_item').html(data);
          $('.main_loader_sec').css('display','none'); 
        }  
       });
        
        
    }
    
    
   function close_list_items(){
         $('#urban_item_div').hide();
         $('#load_data_item').html('');
   }
    
    
  function cancel_order_status_ok(){
        
           var store=$('.cancel_reason_popup_sec').attr('store');
           var ord= $('.cancel_reason_popup_sec').attr('order');
          
           var channel= $('.cancel_reason_popup_sec').attr('channel');
           
           var cancel_reason=$('#cancel_reason').val();
          
         
        if(cancel_reason!=''){
           
        $('.cancel_reason_popup_sec').css('display','none');   
        
        $('.main_loader_sec').css('display','block');   
        
        var datastringnewcard="set=cancel_order_qr&order_id="+ord+"&store_id="+store+"&cancel_reason="+cancel_reason;
      
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        {
            
            location.reload();
            
        } 
      });
      
      }else{
          
          alert('SELECT REASON FOR CANCELLATION');
          
      }
      
      
   }
    
    
  function cancel_order_status(ord,store,channel){
        
           $('.cancel_reason_popup_sec').attr('store',store);
           $('.cancel_reason_popup_sec').attr('order',ord);
           $('.cancel_reason_popup_sec').attr('channel',channel);
           $('.cancel_reason_popup_sec').css('display','block');   
       
   }
   
   
   function ready_order_urban(ord,store){
       
        $('.main_loader_sec').css('display','block');   
         
        var datastringnewcard="set=ready_order_qr&order_id="+ord+"&store_id="+store;
       
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        { 
            
              setInterval(function () {
                  
                  $('.main_loader_sec').css('display','none');
                         
              }, 3000);
           
        } 
      });
   }
   
   
   function cancel_order_close(){
        
    $('.cancel_reason_popup_sec').css('display','none');   
       
   }
   
   
   function store_action(storeid,sts){
       
        if(sts=='Y'){
             var check = confirm("OPEN STORE ?");
        }else{
             var check = confirm("CLOSE STORE ?");
        }
         
         
	if(check==true)
	{
            
        $('.main_loader_sec').css('display','block');   
        var datastringnewcard="set=store_action_set&storeid="+storeid+"&sts="+sts;
        // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "load_qr_orders.php",
        data: datastringnewcard,
        success: function(data)
        { 
            location.reload();
        } 
       });
      
      
        }
      
   }
   
   
    function bill_print_request(qr_ord,kot,ord,table,floor){
        
        var check = confirm("ACCEPT BILL REQUEST FROM CUSTOMER AND PRINT BILL?");
     
	if(check==true)
	{
        
        var orderno_from_tablesel13 = ord+',';  
        var tableno_from_tablesel3  =  table+'(A),';   
    
        var current_floor=floor;
      
        var Bill_print = "Bill_print";
          
          $.post("../printercheck_1.php", {type:Bill_print,floor:current_floor},
                                               
            function(data)
            { 
            data=$.trim(data); 
          
            if(data !='')
            {                     
               alert('PRINTER UNAVAILABLE');
            
            }else{ 
             
                $('.main_loader_sec').css('display','block');   
              
                var discount_from_drop='';
                var type='';
                var discount_mode='';
                var orderno_from_tablesel=new Array();
                var tableno_from_tablesel1=new Array();
                var discount=0;
               
                var orderno_from_tablesel1=orderno_from_tablesel13.split(',');
                 
                for(var j=0;j<orderno_from_tablesel1.length;j++){
                    
                    if(orderno_from_tablesel1[j]!="" || orderno_from_tablesel1[j]!='undefined'){
                        orderno_from_tablesel.push(orderno_from_tablesel1[j]);
                    }
                }
               
                var tableno_from_tablesel=tableno_from_tablesel3.split(',');
               
                for (var p=0;p<tableno_from_tablesel.length;p++){
                    
                    if(tableno_from_tablesel[p].length!=0 && tableno_from_tablesel[p]!='undefined'){
                        
                        tableno_from_tablesel1.push(tableno_from_tablesel[p]);
                    }
                }
                
                var tb=tableno_from_tablesel1[0].split('(');
               
                $.post("../load_div.php", {tableid:tb[0],set:'delete_table_loy',floor_loy:current_floor},
                function(data){
                      
		data=$.trim(data);
                   
                var bill_loy=$.trim(data).split('*');
                
               if(bill_loy[0]!=''){
                   
                   var name_loy=bill_loy[0];
               }else{
                     var name_loy='';
               }
                
               if(bill_loy[1]!=''){
                     var num_loy=bill_loy[1];
               }else{
                     var num_loy='';
               }
               
               if(bill_loy[2]!=''){
                   var gst_loy=bill_loy[2];  
               }else{
                    var gst_loy=''; 
               }
                
                                           var redeem_amount=0;
                                           var loyalty_id='';
                                           var loyalty_billamount6=0;
                                           var loyalty_billamount=0;
                                           var loyalty_billamount11=0;
                                           var loyalty_billamount1=0;
                                           var lp_add='';
                                           var lp_amt='';
                                           var tot_point=0;
                                           var loyalty_pointredeem=0;
                                           var loyalty_redeemamount=0;
                                           var loy_number='';
                                           var loy_name='';
                            
                var data_passing={ tabname:tableno_from_tablesel1,tableid:'',prefx:'',discount:discount,disctype:discount_mode,loyalityid:'',
                    ord:orderno_from_tablesel,billname:name_loy,billnum:num_loy,billgst:gst_loy,redeem_amount:redeem_amount,id_loy:loyalty_id,
                    point_add:tot_point,point_redeem:loyalty_pointredeem,billamount:loyalty_billamount,redeemamount:loyalty_redeemamount,
                    new_bill_amt:loyalty_billamount1,loy_number:loy_number,loy_name:loy_name,set:'proceedbill' };
           
                $.post("../load_completedorder.php", data_passing,
                function(data){ 
                    
                $.post("../print_details.php", {set:'billprint'},
                function(data1){
                        
                });
                    
                setTimeout(function () {
                    
                    $('.main_loader_sec').css('display','none');  
                    
                }, 500);
           
           
                $.post("../load_div.php", {tableid:'',set:'tableselectionauto',tablename:'',qr_ord:qr_ord});
                   
                   
                });
                
               }); 
                 
            }
            
        });
        }
 }
    </script>

</head>

<body>
          
 <?php 

  include("../database.class.php");
  $database	= new Database();
  //error_reporting(0);
  $qr_branch=''; $qr_db=''; $db_urban='';

    $sql_login_dc  =  $database->mysqlQuery("select tb.be_store_db,tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
    while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
              {
     
      $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
      $qr_db=$result_cat_s_tc['be_qrcode_db'];
      $db_urban=$result_cat_s_tc['be_store_db'];
 }
}


 $store_sts='';

 $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

 
 $sql_gen =  mysqli_query($localhost1,"select tcd_qr_enable from tbl_cloud_menu_detail   where  branchid ='$qr_branch' "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{      
                            $store_sts=  $result_cat_s_tc['tcd_qr_enable'];
                         }
                        }
          ?>
    
    <input type="hidden" value="<?=$_SESSION['auto_accept_qr']?>" id="auto_accept_qr" >
    
 <div class="container-fluid no-padding">
      <div class="middle_container">
      <div class="top_site_map_cc new-sitemap-cc" style="width:100%;">
      <div class="logo_container">
          <a onclick="go_home_new();" href="#"> <div class="logo"><img src="../img/logo20.png"></div></a>
        </div>
         
          <div style="width:150px" onclick="qr_history()" class="online_order_history_btn"> <a href="#"><img src="../img/mn_master_mn_ico.png" alt=""> QR ORDER HISTORY</a> </div>
          
          <div style="width:100px" class="online_order_history_btn"> <a href="../table_selection.php"><img src="../img/reg_ico.png" alt=""> DINE IN</a> </div>
          
          <div style="width:100px" class="online_order_history_btn"> <a href="../take_away_.php"><img src="../img/takeaway-ico.png" alt=""> DELIVERY</a> </div>
           
          <?php if($db_urban!=''){ ?>
          <div style="background-color: #8c8c37;margin-left: 70px;    font-size: 10px;width: 150px;font-weight: bold;
}" onclick="go_nav()" class="online_order_history_btn"> <a href="#"><img src="../img/download_pdf_btn.png" alt=""> GO TO ONLINE ORDERS</a> </div>
          <?php }else{ ?>
          <div style="background-color: #8c8c37;margin-left: 70px"  class="online_order_history_btn"> <a href="#"><img src="../img/download_pdf_btn.png" alt=""> QR ORDERS</a> </div>
         
           <?php } ?>
          
          
         <?php  if($store_sts=='Y'){ ?>
          
          <span class="online_odr_main_head" style="position:relative;top:4px;"></span>

          <div style="cursor:pointer;float: right;width:50px;margin-right:5px" class="online_order_history_btn"> <img src="../img/mn_master_mn_ico.png" alt=""><span id="count_qr"><?php if(isset($_SESSION['qr_order_count'])){ echo $_SESSION['qr_order_count']; } ?> </span></div>

          <div style="cursor:pointer;float: right;" class="online_order_history_btn"> <a onclick="store_action('<?=$qr_branch?>','N')"><img src="../img/green_tick.png" style="top: -1px;" alt=""> STORE OPEN </a> </div>
          
          <?php } else{ ?>
           
           <div style="cursor:pointer;float: right;" class="online_order_history_btn"> <a onclick="store_action('<?=$qr_branch?>','Y')" ><img src="../img/red_tick.png" style="top: -1px;" alt=""> STORE ClOSED </a> </div>
           
          <?php } ?>
          
         
      </div>

         
        <div class="take-away-quee-contant-cc new_order_box_sc">

          
<?php

  
   $table_new=''; $floor_new=''; $running='N';  $addr='';
   
   $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_details td left join tbl_qr_user_detail tc on td.tq_user = tc.tu_number   where  td.tq_synced='Y'  and tq_localy_delivered!='Y' and tq_cancelled!='Y' AND tq_branch='$qr_branch' order by td.tq_order_time desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                    
                                    $addr=$result_cat_s_tc['tu_buliding_home_name'].' , '.$result_cat_s_tc['tu_lanmark'];
                                    
                                    $running=$result_cat_s_tc['tq_running'];
                                    
                             if($result_cat_s_tc['tq_mode']=='DI'){
                                      
                                      
                             $sql_tab = "select tr_tableno from tbl_tablemaster where tr_tableid='".$result_cat_s_tc['tq_table']."' ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $table_new=$result_menus['tr_tableno'];
                                        }
                                        }
                                        
                             $sql_tab = "select fr_floorname from tbl_floormaster where fr_floorid='".$result_cat_s_tc['tq_floor']."' ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $floor_new=$result_menus['fr_floorname'];
                                        }
                                        }
                                      
                                      
                                     $mode= $floor_new.' &nbsp; | &nbsp; '.$table_new ;
                                     
                                  }else{
                                      
                                      $mode= 'Delivery';
                                      
                                  }  
                                    
                                    

if($result_cat_s_tc['tq_order_no']!=""){
    
    $date=date('Y-m-d H:i:s');
    
    $timeFirst  = strtotime($date);
    $timeSecond = strtotime($result_cat_s_tc['tq_order_time']);

    $totalSecondsDiff = abs($timeFirst-$timeSecond); 
    $totalMinutesDiff = $totalSecondsDiff/60;

    $bill_ta=''; $kot_ta=''; $ord='';

    if($result_cat_s_tc['tq_mode']=='TA'){
       
    $sql_login_dc  =  $database->mysqlQuery("select tab_billno,tab_kotno from  tbl_takeaway_billmaster where tab_qr_order_id='".$result_cat_s_tc['tq_order_no']."' "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
     while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
              {
     
      $bill_ta=$result_cat_s_tc3['tab_billno'];
      $kot_ta=$result_cat_s_tc3['tab_kotno']; 
 }
}

 }else{
       
       $sql_login_dc  =  $database->mysqlQuery("select ter_billnumber,ter_kotno,ter_orderno from  tbl_tableorder where ter_qr_order='".$result_cat_s_tc['tq_order_no']."' group by ter_qr_order "); 
       $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
        if($num_cat_s_dc){
         while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
           {
     
       $bill_ta=$result_cat_s_tc3['ter_billnumber'];
       $kot_ta=$result_cat_s_tc3['ter_kotno']; 
       $ord=$result_cat_s_tc3['ter_orderno']; 
 }
}

   }

                   
  ?>
          
                    <div class="take-away-quee-box " style="height:175px">       
                            
                    <div   class="take-away-quee-box-head"> 
                        
                    <strong <?php if($totalMinutesDiff>10){ ?> title="Order Delayed" style="background-color: red;height: 32px;top-padding:5px" <?php }else{ ?> style="background-color: #57cc99;height: 32px;top-padding:5px;"  <?php } ?> > 
                          
                     <span style="margin-left: -40px;color: white;font-size: 9px;margin-top: 3px">#<?=$result_cat_s_tc['tq_order_no']?> 
                                
                     </span> <br> <span title="FLOOR | TABLE" style="font-size: 9px;margin-top: 3px;margin-left: -20px;color: white;font-weight: bold"> * <?=$mode?>  </span>
                        
                        
                     <?php if($result_cat_s_tc['tq_bill_request']=="Y" && $result_cat_s_tc['tq_bill_printed']=="N"  && $bill_ta=='' &&  $kot_ta!=''){   ?>
                          
                     <span title="BILL REQUESTED BY CUSTOMER" > <img onclick="bill_print_request('<?=$result_cat_s_tc['tq_order_no']?>','<?=$kot_ta?>','<?=$ord?>','<?=$result_cat_s_tc['tq_table']?>','<?=$result_cat_s_tc['tq_floor']?>');" style="margin-top: -28px;margin-left: 127px;" src="../img/bill-icon.png"></span>
                      
                      <?php }  ?>
                        
                      </strong>
                        
                      <div class="take-away-quee-box-time"><span ><?=$result_cat_s_tc['tq_order_time']?></span>
                      
                      </div>
                      
                     
                    </div>
                
                
                    <div class="take-away-quee-box-time"><img src="img/cst.png" alt=""> : <span> <?=$result_cat_s_tc['tu_name']?></span></div>
                    <div class="take-away-quee-box-time"><img src="img/phn.png" alt=""> : <span> <?=$result_cat_s_tc['tu_number']?></span></div>
                    <div class="take-away-quee-box-time"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['tu_city']?></span></div>
                     
                      <div class="take-away-quee-box-time"><img src="img/amt.png" alt=""> : <span> <?=number_format($result_cat_s_tc['tq_final'],$_SESSION['be_decimal'])?></span></div>
                    
                    <?php if($result_cat_s_tc['tq_localy_confirmed']=="N"  || $running=='Y'  ){   ?>
                          
                     <div id="accept_btn" class="online_acpt_btn_new" onclick="confirm_order('<?=$result_cat_s_tc['tq_delivery_charge']?>','<?=$result_cat_s_tc['tq_order_time']?>','<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>','qr_code','<?=$result_cat_s_tc['tu_name']?>',' <?=$result_cat_s_tc['tu_number']?>','<?=$addr?>','<?=$result_cat_s_tc['tu_lanmark']?>','<?=$result_cat_s_tc['tu_area']?>','<?=$result_cat_s_tc['tu_pincode']?>','<?=$result_cat_s_tc['tq_mode']?>','<?=$result_cat_s_tc['tq_table']?>','<?=$result_cat_s_tc['tq_floor']?>','<?=$running?>');"  style="background-color: #659465 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">
               
                   <?php if($running=="N"){   ?>       
                         
                         Accept 
                         
                   <?php }else{   ?>    
                         
                         <span>Running</span>  
                         
                   <?php }  ?>    
                     
                     </div> 
                   
                     
                    <?php  }  ?>
                     
                     
                     <?php if($result_cat_s_tc['tq_localy_confirmed']=="N"){   ?>
                     
                      <div  class="online_acpt_btn_new" id="cancel_btn" onclick="cancel_order_status('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>','qr_code' );"  style="background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CANCEL</div>  
                     
                     <?php  }  ?>
                      
                      
                      
                     <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y" && $running=='N' && $result_cat_s_tc['tq_mode']=='TA' && $result_cat_s_tc['tq_localy_ready']=="N" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn" onclick="ready_order_urban('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>' );"  style="width:100% !important;background-color: darkred ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">ASSIGN</div>  
                     
                     <?php  } if($result_cat_s_tc['tq_localy_confirmed']=="Y" && $running=='N'  && $result_cat_s_tc['tq_mode']=='DI' && $result_cat_s_tc['tq_localy_ready']=="N" ){   ?>
                     
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #75935f ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CONFIRMED TO TABLE</div>  
                      
                    <?php } ?>
                   
                    <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"  && $result_cat_s_tc['tq_mode']=='DI' && $result_cat_s_tc['tq_localy_ready']=="Y" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #03a4e2 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">BILLED
                     
                     
                      <img onclick="settlepopupcommondi();"  style="position: fixed;
                        border: solid 1px;
                        width: 21px;
                        margin-left: 33px;
                        margin-top: -2px;border-radius: 4px;padding: 1px" src="../img/rate.png">
                     
                     </div>  
                     
                    <?php } ?>
                     
                     <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"  && $result_cat_s_tc['tq_mode']=='TA' && $result_cat_s_tc['tq_localy_ready']=="Y" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #2a9b61 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">PICKED
                        <img onclick="settlepopupcommonta();"  style="position: fixed;
                        border: solid 1px;
                        width: 21px;
                        margin-left: 33px;
                        margin-top: -2px;border-radius: 4px;padding: 1px" src="../img/rate.png">
                     </div>  
                     
                        <?php } ?>
                     
                     
                   <div  class="take-away-quee-box-head" > 
                       
                   <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"){   ?>
                      <span title="<?=$kot_ta?>" style="float:right;margin-right: 125px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white " class="odr_item_view_btn " onclick="print_qr_kot('<?=$kot_ta?>','<?=$bill_ta?>','<?=$result_cat_s_tc['tq_mode']?>');">KOT</span>
                      <span title="<?=$bill_ta?>" style="float:right;margin-right: 65px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white" class="odr_item_view_btn" onclick="print_qr_bill('<?=$bill_ta?>','<?=$result_cat_s_tc['tq_mode']?>');">BILL</span>
                   <?php } ?> 
                      
                    <span class="odr_item_view_btn" style="background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white;margin-right: 5px;" onclick="load_urban_items('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>');">INFO</span>
                   
                    </div>
                    
                 </div>
            
<?php

} } }else{
     ?>
    
    <span style="margin-left: 0%;padding-top: 30%;color: white;margin-top: 0px;" >NO QR ORDERS FOUND</span> 
    
    <?php
}

?>
            
      </div>
        
      </div>  
     
</div>



    <div class="new_item_sm_pop_sec" id="urban_item_div" style="display:none;" >
        <div class="new_item_sm_pop" style="overflow: scroll">
			<div class="new_item_sm_pop_head">View Items
                            <a onclick="close_list_items()" href="#"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>

			</div>
			<div class="new_item_sm_pop_cnt">
				<table>
					<thead>
					<tr>
					<th>Name</th>
					<th>Qty</th>
                                        <th>Amount</th>
                                        <th>Total</th>
					</tr>
					</thead>
                                        <tbody id="load_data_item">
						
						
					</tbody>
				        </table>
			</div>
		
	</div>
</div>



   <div class="cancel_reason_popup_sec" style="display:none">
   <div class="cancel_reason_popup">
      <div class="cancel_reason_popup_head">
          CANCEL REASON  
          <a onclick="cancel_order_close()" href="#"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>
      </div>
      <div class="cancel_reason_popup_cnt">
          <div class="reson_select_drp">
              <select class="reson_select_sec_option" id="cancel_reason">
                    <option value="">SELECT REASON</option>
                  <option value="item_out_of_stock">Item_out_of_stock</option>
         
 <option value="store_closed">Store_closed</option>
 <option value="store_busy">Store_busy</option>
 <option value="rider_not_available">Rider_not_available</option>
 <option value="out_of_delivery_radius">Out_of_delivery_radius</option>
 <option value="connectivity_issue">Connectivity_issue</option>
 <option value="total_missmatch">Total_missmatch</option>
 <option value="invalid_item">Invalid_item</option>
 <option value="option_out_of_stock">Option_out_of_stock</option>
 <option value="invalid_option">Invalid_option</option>
 <option value="unspecified">Unspecified</option>
              </select>
          </div>
      </div>
       <div class="reson_select_sec_btn_row" onclick="cancel_order_status_ok();">
          <div  class="reson_sub_btn">SUBMIT</div>
      </div>
   </div>
</div>

    
 <div class="di_popup_sec" style="display:none">
     <div class="cancel_reason_popup" style="height:210px">
      <div class="cancel_reason_popup_head">
          CONFIRM TABLE ?   
          <a onclick="cancel_di_close()" href="#"  class="add_room_pop_close"><img src="../img/uploadify-cancel.png" alt=""></a>
      </div>
       
      <div class="cancel_reason_popup_cnt">
          <div class="reson_select_drp">
              <div>  <span style="float:left"> Floor: </span>
                  
                  <select class="reson_select_sec_option" id="floor_di" style="width:150px;margin-top: -10px;margin-left: 20px;pointer-events: none">
                   <?php
                   $sql_tab = "select fr_floorid,fr_floorname from tbl_floormaster ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                           
                                     ?>
                  
                   <option value="<?=$result_menus['fr_floorid']?>"> <?=$result_menus['fr_floorname']?></option>
                   <?php
                                   
                
                       } } 
                       ?>
                  </select> </div><br>
              
             <div>
             <span style="float:left;margin-top: 17px"> Table: </span>
             <select class="reson_select_sec_option table_di" id="table_di"  style="margin-top:5px;width:150px;margin-left: 20px;pointer-events: none">
                   <?php
                   $sql_tab = "select tr_tableno,tr_floorid,tr_tableid from tbl_tablemaster  ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                           
                                     ?>
                  
                   <option value="<?=$result_menus['tr_tableid']?>"> <?=$result_menus['tr_tableno']?></option>
                   <?php
                                   
                
                       } } 
                       ?> 
              </select>
              
              </div>
                  
          </div>
      </div>
       
       <div class="reson_select_sec_btn_row" onclick="table_ok();">
          <div  class="reson_sub_btn">SUBMIT</div>
      </div>
   </div>
</div>

    
    
    
    
<div style="display:none" class="confrmation_overlay_auth"></div>

 <div class="main_loader_sec" style="display: none;width: 100%;height:100%;position: fixed;left:0;top:0;background-color:rgba(0,0,0,0.5);z-index: 999;text-align:center;padding-top:20%">
        <img src="img/loader.gif" style="width: 150px;" alt="">
  </div>
 <audio id="urbanAudio"><source src="../urban.ogg" type="audio/ogg"></audio>
</body>
</html>
<!-- <meta http-equiv="refresh" content="2">-->