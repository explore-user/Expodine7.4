$(document).ready(function(){
    
    
    var dt = new Date();

     $('#analytic_time_date_new').text(dt);
    
    
  /********************** FIRST SECTION ******************************/ 
   var parsed_data=''; 
    var dataString = 'value=first_load';
    $.ajax({
        type: "POST",
        url: "load_analytics.php",
        data: dataString,
        success: function(data) {
            parsed_data=JSON.parse(data);
            
            $('#cash_value').text(parsed_data["CASH"]);
            $('#card_value').text(parsed_data["CARD"]);
            $('#credit_person_value').text(parsed_data["CREDIT_PERSON"]);
            $('#complimentary_value').text(parsed_data["COMPLIMENTARY"]);
            $('#pax').text(parsed_data["PAX"]);
            $('#bills_cancelled').text(parsed_data["BILLS_CANCELLED"]);
            $('#items_cancelled').text(parsed_data["ITEMS_CANCELLED"]);
            
            
        }   
    });
    /********************** FIRST SECTION ******************************/
    
    /********************** SECOND SECTION ******************************/
    var dataString = 'value=sales';
    parsed_data='';
    $.ajax({
        type: "POST",
        url: "load_analytics.php",
        data: dataString,
        success: function(data) {
            parsed_data=JSON.parse(data);
            
            $('#total_sale').text(parsed_data["TOTAL"]);
            $('#avg_cost').text(parsed_data["AVG_COST"]);
                     
                     
             $('#pending_sale_head').attr('title',parsed_data["TOTAL_PENDING_bifur"]);        
                   
             //$('#pend_view_all').text(parsed_data["TOTAL_PENDING_bifur"]);
            
            
            $('#pending_sale_amount').text(parsed_data["TOTAL_PENDING"]);
            if(parsed_data["DI"]){
               $('#di_total').text(parsed_data["DI"]); 
            }
            if(parsed_data["TA"]){
             $('#ta_total').text(parsed_data["TA"]);   
            }
            if(parsed_data["CS"]){
                $('#cs_total').text(parsed_data["CS"]);
            }
            if(parsed_data["HD"]){
               $('#hd_total').text(parsed_data["HD"]); 
            }
            
        }
    });
    

    
    $('.sale_and_bills').click(function(){
        
        var action='';
        $('.sale_and_bills').removeClass('left_ttl_sl_act');
        
        $(this).addClass('left_ttl_sl_act');
        
        if($(this).attr('action')=='sales'){
            action='Total Sales' ;
            
            $('#total_sale').show();
            $('#total_bill').hide();
            $('#di_total').show();
            $('#di_total_bill').hide();
            $('#ta_total').show();
            $('#ta_total_bill').hide();
            $('#hd_total').show();
            $('#hd_total_bill').hide();
            $('#cs_total').show();
            $('#cs_total_bill').hide();
             $('#pending_sale_head').text('Pending Sales');
              $('#pending_sale_amount').show(); 
        }
        else if($(this).attr('action')=='bills'){
            
            action='Total Bills' ;
            $('#total_sale').hide();
            $('#total_bill').show();
            $('#di_total').hide();
            $('#di_total_bill').show();
            $('#ta_total').hide();
            $('#ta_total_bill').show();
            $('#hd_total').hide();
            $('#hd_total_bill').show();
            $('#cs_total').hide();
            $('#cs_total_bill').show();
            $('#pending_sale_head').text('');
            $('#pending_sale_amount').hide(); 
        }
        
        $('#sale_heading').text(action);
        
        
        var dataString = 'value='+$(this).attr('action');
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data) {
                parsed_data=JSON.parse(data);
                
                if(action=='Total Sales'){ 
                    
                     $('#pending_sale_head').attr('title',parsed_data["TOTAL_PENDING_bifur"]);
                   
                     $('#total_sale').text(parsed_data["TOTAL"]);
                    
                     $('#pending_sale_amount').text(parsed_data["TOTAL_PENDING"]);
                     
                    if(parsed_data["DI"]){
                       $('#di_total').text(parsed_data["DI"]); 
                    }
                    if(parsed_data["TA"]){
                     $('#ta_total').text(parsed_data["TA"]);   
                    }
                    if(parsed_data["CS"]){
                        $('#cs_total').text(parsed_data["CS"]);
                    }
                    if(parsed_data["HD"]){
                       $('#hd_total').text(parsed_data["HD"]); 
                    }
                }
                else if(action=='Total Bills'){
                    
                    $('#total_bill').text(parsed_data["TOTAL_BILLS"]);
                    if(parsed_data["DI"]){
                       $('#di_total_bill').text(parsed_data["DI"]); 
                    }
                    if(parsed_data["TA"]){
                     $('#ta_total_bill').text(parsed_data["TA"]);   
                    }
                    if(parsed_data["CS"]){
                        $('#cs_total_bill').text(parsed_data["CS"]);
                    }
                    if(parsed_data["HD"]){
                       $('#hd_total_bill').text(parsed_data["HD"]); 
                    }
                }
            }
        }); 
      
    });
    
    /********************** SECOND SECTION ******************************/
    /*********************** BEST SELLING ITEMS*******************************/
    var dataString = 'value=best_selling';
    parsed_data='';
    $.ajax({
        type: "POST",
        url: "load_analytics.php",
        data: dataString,
        success: function(data) {
            
            parsed_data=JSON.parse(data);
            
            for(var st=0;st<parsed_data["BEST_SELLING"].length;st++){
                //alert('1');
                $(".best_sale_lsit").append('<div class="most_sale_lsit"><span>'+parsed_data["BEST_SELLING"][st].MENU+'</span><span class="most_sale_lsit_rt">'+parsed_data["BEST_SELLING"][st].TOTAL+'</span><span class="most_sale_lsit_rt">'+parsed_data["BEST_SELLING"][st].QTY+'</span></div>');

            }
            
                
        }
    });
    
    
    /*********************** BEST SELLING ITEMS*******************************/
    
    /*********************** MOST REVENUE GENERATING ITEMS*******************************/
    var dataString = 'value=most_revenue';
    parsed_data='';
    $.ajax({
        type: "POST",
        url: "load_analytics.php",
        data: dataString,
        success: function(data) {
            
            parsed_data=JSON.parse(data);
            for(var st=0;st<parsed_data["MOST_REVENUE"].length;st++){
                
                $(".most_revenue_lsit").append('<div class="most_sale_lsit"><span>'+parsed_data["MOST_REVENUE"][st].MENU+'</span><span class="most_sale_lsit_rt">'+parsed_data["MOST_REVENUE"][st].TOTAL+'</span><span class="most_sale_lsit_rt">'+parsed_data["MOST_REVENUE"][st].QTY+'</span></div>');

            }
            
                
        }
    });
    
    
    /*********************** MOST REVENUE GENERATING ITEMS*******************************/
    
    $(".cl_tt_2").click(function(){
            $("#total_qc_view").removeClass('bg-info');
            $("#total_qc_view").addClass('bg_ttl_1');
        });
        
    $(".cl_tt_1").click(function(){
        $("#total_qc_view").removeClass('bg_ttl_1');
        $("#total_qc_view").addClass('bg-info');
    });


    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {   
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    }
    
   /***********************************HOURLY REPORT *****************************************/
   google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawStacked);

    function drawStacked() {
//      
      var dataString = 'value=hourly_wise';
        
            $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) {
                 parsed_data='';
                parsed_data=JSON.parse(data1);
                
               var hourly_arr =[
                           ['TIME', 'DI','TA' ,'CS','HD'],
                       ];
                
                $.each(parsed_data['HOUR'],function(ii,value11){
                var graph_time=Number(value11[0].toString());
                
                for(var st=0;st<value11.length;st++){
                    
                    var time2='';
                    var session='am';
                    var time3=0;
                    var time33=0;
                    time2=Number(value11[st].toString());
                    
                    var di=0;
                    var ta=0;
                    var cs=0;
                    var hd=0;
                    $.each(parsed_data['HOURLY_WISE'][0][ii][value11[st]],function(i,value){
                        var value1=value.toString();
                        
                      if(i=='DI'){
                            di=value1.replace(',','');  
                        }
                      else if(i=='TA'){
                            ta=value1.replace(',','');  
                        }
                      else if(i=='CS'){
                            cs=value1.replace(',','');  
                        }
                      else if(i=='HD'){
                            hd=value1.replace(',','');  
                        }   
                      
                    });
                    
                    if(time2>11){
                        session='PM';
                        time3=parseInt(time2-12);
                        time33=parseInt(time2-12);
                        if(time3==0){
                           time33=12; 
                        }
                        if(parseInt(time3+1)==12){
                           session='AM';
                       }
                    }
                    else{
                       session='AM';
                       time33=time2;
                       time3=time2;
                       if(parseInt(time3+1)==12){
                           session='PM';
                       }
                    }
                    
                    hourly_arr.push([time33+"-"+parseInt(time3+1)+" "+session,Number(di),Number(ta),Number(cs),Number(hd)]);
                }
     
        });
        
      var data = google.visualization.arrayToDataTable(hourly_arr);
       
        var options = {
            legend: {'position':'center','alignment':'center'},
          title: '',
          isStacked: true,
          
        };
      
      var chart = new google.visualization.ColumnChart(document.getElementById('weakly_new'));
      chart.draw(data, options);
  
        }
            });
    }
    
   /***********************************HOURLY REPORT *****************************************/
   
   
   /********************************** PIE CHART SECTION ************************************/
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    
    
    function drawChart() {
        var dataString = 'value=steward_performance';
        parsed_data='';
         var steward_arr =[
                    [ 'name', 'total'],
                ];
        $.ajax({
            type: "POST",
            url: "load_analytics.php",
            data: dataString,
            success: function(data1) {
                parsed_data=JSON.parse(data1);
              
                for(var st=0;st<parsed_data['STEWARD_PERFORMANCE'].length;st++){
                   var steward = parsed_data['STEWARD_PERFORMANCE'][st].steward;
                    var total = parsed_data['STEWARD_PERFORMANCE'][st].total;
                    steward_arr.push([steward,      parseFloat(total)]);
  
               }
            
        var data = google.visualization.arrayToDataTable(steward_arr);
       
        
        var options = {
            legend: {'position':'center','alignment':'center'},
          title: '',
          is3D: true,
            chartArea: {
                         width: 340,
                          height: 150,
                         left: 50,
                    },

        };

        var chart = new google.visualization.PieChart(document.getElementById('stackedchart'));
        chart.draw(data, options);
        }  
           
        });
    }
    /********************** PIE CHART SECTION ******************************/
//    google.charts.load('current', {'packages':['corechart']});
//    google.charts.setOnLoadCallback(drawVisualization);
//    
//    function drawVisualization() {
//        
//        
//        var dataString = 'value=hourly_wise';
//        parsed_data='';
//         var hourly_arr =[
//                    ['Month', 'DI', 'TA', 'CS', 'HD'],
//                ];
//            $.ajax({
//            type: "POST",
//            url: "load_analytics.php",
//            data: dataString,
//            success: function(data1) {
//                //alert(data1);
//                //alert(unique(parsed_data['STEWARD_PERFORMANCE'].length));
//                parsed_data=JSON.parse(data1);
//                //alert(parsed_data['HOUR'].length);
//                for(var st=0;st<parsed_data['HOUR'].length;st++){
//                    var di=0;
//                    var ta=0;
//                    var cs=0;
//                    var hd=0;
//                    $.each(parsed_data['HOURLY_WISE'][0][parsed_data['HOUR'][st]],function(i,value){
//                        var value1=value.toString();
//                      if(i=='DI'){
//                            di=value1.replace(',','');  
//                        }
//                      else if(i=='TA'){
//                            ta=value1.replace(',','');  
//                        }
//                      else if(i=='CS'){
//                            cs=value1.replace(',','');  
//                        }
//                      else if(i=='HD'){
//                            hd=value1.replace(',','');  
//                        }   
//                      
//                    });
//                    
//                    
//                    hourly_arr.push([parsed_data['HOUR'][st],parseFloat(di),parseFloat(ta),parseFloat(cs),parseFloat(hd)]);
//                     
//               }
//                    // Some raw data (not necessarily accurate)
//                    var data = google.visualization.arrayToDataTable(hourly_arr);
//
//                    var options = {
//                      title : '',
//                      vAxis: {title: ''},
//                      hAxis: {title: ''},
//                      seriesType: 'bars',
//                      series: {4: {type: 'line'}}
//                    };
//
//                    var chart = new google.visualization.ComboChart(document.getElementById('weakly_rp'));
//                    chart.draw(data, options);
//                }
//            });
//    }
});
