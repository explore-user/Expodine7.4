<?php

include('includes/session.php');

if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php"); 
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}


$string="";

 if(isset($_REQUEST['date'])){
 $date=$_REQUEST['date'];
  }


 
 if(isset($_REQUEST['ft'])  &&$_REQUEST['ft']=="set"){			
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " dc_dateopen between '".$from."' and '".$to."'  ";
                    
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " dc_dateopenbetween '".$from."' and '".$to."' ";
                     //$stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
		}
      
     
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " dc_dateopen between '".$from."' and '".$to."'  ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
                }
		
} 
 else if($_REQUEST['ft']=="abc")
      { 
	
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" dc_dateopen = CURDATE() - INTERVAL 1 day";
                    //$stringta.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  dc_dateopen between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                   // $stringta.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    //$stringta.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" dc_dateopen between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $st="Last 365 days";
                }
                }
                
                $reporthead=$st;
	}
      
        ?>
                    <table class="table table-bordered table-font user_shadow" >
   								 
				<thead>
                             
				<tr>
                                 <th width="5%">SL</th>
                                 <th >Sale Date</th>
                                 <th >Open Date</th>
                                 <th >Open Time</th>
                                 <th >Close Date</th>
                                 <th >Close Time</th>
                                 <th style="display:none">SMS </th>
                                 <th >Email  </th>
                                 <th style="display:none">SMS Time</th>
                                 <th >Email Time</th>
                                   <th width="7%">Login</th>
                                     <th width="7%">System Ip</th>
                                 <th width="7%">Print</th>
                                 <th style="display:none" width="7%">SMS</th>
                                 <th width="7%">Email</th>
                                 <th width="7%">Doc</th>
                                
                                 </tr>
				</thead>
				<tbody>
                <?php
                 $sqldayclose  =  $database->mysqlQuery("Select dc_timeclose,dc_closing_user,dc_closing_pc,dc_day,dc_dateopen,dc_timeopen,dc_last_sms_time,dc_last_email_time,dc_dateclose,dc_dayclose_sms_success,dc_dayclose_email_success from tbl_dayclose where $string");
                 $numdayclose   = $database->mysqlNumRows($sqldayclose);
         // echo "Select dc_timeclose,dc_closing_user,dc_closing_pc,dc_day,dc_dateopen,dc_timeopen,dc_last_sms_time,dc_last_email_time,dc_dateclose,dc_dayclose_sms_success,dc_dayclose_email_success from tbl_dayclose where $string";
	  if($numdayclose){
                  $i=0;
		  while($resultdayclose  = $database->mysqlFetchArray($sqldayclose)) 
			{
                            $i++;
                     ?>
                                    <tr>
                                    <td width="5%"><?=$i?></td>
                                    <td><?=$resultdayclose['dc_day']?></td>
                                    <td><?=$resultdayclose['dc_dateopen']?></td>
                                    <td><?=$resultdayclose['dc_timeopen']?></td>
                                    <td><?=$resultdayclose['dc_dateclose']?></td>
                                    <td id="dcdate"><?= $resultdayclose['dc_timeclose']?></td>
                                    <td style="display:none" id="dcdate"><?php if($resultdayclose['dc_dayclose_sms_success']=='Y'){ echo 'Sent'; }else{ echo 'No';}?></td>
                                    <td id="dcdate"><?php if($resultdayclose['dc_dayclose_email_success']=='Y'){ echo 'Sent'; }else{ echo 'No';}?></td>
                                    <td style="display:none"><?=$resultdayclose['dc_last_sms_time']?></td>
                                    <td><?=$resultdayclose['dc_last_email_time']?></td>
                                     <td><?=$resultdayclose['dc_closing_user']?></td>
                                      <td><?=$resultdayclose['dc_closing_pc']?></td>
                                    <td width="7%"><a href="#"  class="dayclosedetails" onclick="return dayclose('<?=$resultdayclose['dc_dateopen']?>','<?=$resultdayclose['dc_dateclose']?>')" id="<?=$resultdayclose['dc_dateopen']?>"><img src="img/printer_new.png"></a></td>
                                    <td style="display:none" width="7%"><a href="#" class="smsclick" onclick="sms('<?=$resultdayclose['dc_day']?>','<?=$resultdayclose['dc_dateclose']?>')" ><img src="img/sms_ico.png"></a></td>
                                    <td width="7%"><a href="#" onclick="mail('<?=$resultdayclose['dc_day']?>','<?=$resultdayclose['dc_dateclose']?>')" ><img src="img/email_ico.png"></a></td>
                                    <td width="7%"><a href="#" onclick="pdf('<?=$resultdayclose['dc_day']?>','<?=$resultdayclose['dc_dateclose']?>')" ><img src="img/view_ico.png"></a></td>
                                   
                                    </tr>
         <?php } }  ?>
                
        <script>
                    
        function sms(a,dd){
                       
                       
                        var bydate=$("#bydate").val();
                        var fromdt=$("#datepickerfrom").val();
                        var todt=$("#datepickertodt").val();
                        //alert(fromdt);
                         //alert(todt);
                         // alert(bydate);
                        if(fromdt!=""){
                            var ft="set";
                        };
                        if(bydate!="null"){
                            var ft="abc";
                        };
                       

         if(dd!=""){
                  
         var check = confirm("Are you sure you want to Send SMS?");
        if(check==true)
        {
            var datastring ="datesms="+a;
            $.ajax({
                type: "POST",
                url: "dayclosesmsnew.php",
                data: datastring,
                success: function (data)
                {
                  //alert(data) ;
                  $("#reportload").load("load_dayclosedetails.php?ft="+ft+"&bydate="+bydate+"&fromdt="+fromdt+"&todt="+todt);
                }
            });
        }
        return true;
    }else
    {
                       $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please day close to get sms ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
                    }

 function confirm_yes_new(){
           
       var b = $('#confirm_pop_all').attr('open1');
       var dd = $('#confirm_pop_all').attr('close1');
       
                var bydate=$("#bydate").val();
                var fromdt=$("#datepickerfrom").val();
                var todt=$("#datepickertodt").val();
                //alert(fromdt);
                //alert(todt);
                //alert(bydate);
                if(fromdt!=""){
                    var ft="set";
                };
                if(bydate!="null"){
                    var ft="abc";
                };
             
            var datastring ="datemail="+b;
            $.ajax({
                type: "POST",
                url: "dayclose_emailnew.php",
                data: datastring,
                success: function (data)
                {
                  //alert(data) ; 
                  $("#reportload").load("load_dayclosedetails.php?ft="+ft+"&bydate="+bydate+"&fromdt="+fromdt+"&todt="+todt);
                }
            });
            
             $('#confirm_pop_all').hide();
                
         $('#pop_head_com').text('');
        
       
           
    }
                    
         function mail(b,dd){
             
               if(dd!=""){
             
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('SEND MAIL ?');
         
         $('#confirm_pop_all').attr('open1',b);
         $('#confirm_pop_all').attr('close1',dd);
        
     }else
        {
          
          
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please day close to get Mail ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
       }
  }            
        
        
   function pdf(bb,dd){
             
        if(dd!=""){
                 
        
            window.open("dayclosedetails_a4.php?datemail="+bb);
        
    }else
    {
         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please day close to download ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
         }            
                    
                    
                    </script>
                
                </body>
                </table>
          