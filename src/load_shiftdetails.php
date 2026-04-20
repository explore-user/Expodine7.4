<?php

include('includes/session.php');
// Check session
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
    // echo $date;
 }

 
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " sd_day between '".$from."' and '".$to."'  ";
                    
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " sd_day between '".$from."' and '".$to."' ";
                     //$stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
		}
      
     
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " sd_day between '".$from."' and '".$to."'  ";
                     //$stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
					
                }
		

 else if($_REQUEST['bydate']!="")
      { 
	
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" sd_day = CURDATE() - INTERVAL 1 day ";
                    //$stringta.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  sd_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                   // $stringta.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                    //$stringta.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                    //$stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $st="Last 365 days";
                }
                $reporthead=$st;
                }
                
                
	}
      else{
                     $from=date("Y-m-d");
                     $to=date("Y-m-d");
                     $string.= " sd_day between '".$from."' and '".$to."'  ";
                     //$stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                }
        ?>
                    <table class="table table-bordered table-font user_shadow" >
   								 
				<thead>
                             
				<tr>
                                 <th width="5%">Sl</th>
                                  <th width="5%">Print</th>
                                   <th width="5%">Mail</th>
                                     <th width="5%">View</th>
                                       <th >Shift Force Close</th>
                                 <th >Shift Day</th>
                                  <th >Shift Open By</th>
                                 <th >Shift Open Time</th>
                                 <th >Shift Open Balance</th>
                                 <th >Shift Open Petty</th>
                                 <th >Shift Open Total</th>
                                 <th >Shift Open Deno</th>
                                 <th >Shift Open Machine</th>
                                 <th >Shift Close Time</th>
                                 <th >Shift Close Balance</th>
                                 <th >Shift Close Petty</th>
                                 <th >Shift Close Total</th>
                                 <th >Shift Close Deno</th>
                                 <th >Shift Close Machine</th>
                                  <th >Pending Bills</th>
                                
                                 </tr>
				</thead>
				<tbody>
                <?php
                 $sqldayclose  =  $database->mysqlQuery("Select  * FROM tbl_shift_details where $string");
                
                 $numdayclose   = $database->mysqlNumRows($sqldayclose);
          
	         if($numdayclose){
                  $i=0;
		  while($resultdayclose  = $database->mysqlFetchArray($sqldayclose)) 
			{
                      
                       $shiftopentime=$resultdayclose['sd_open'];
                       $shiftclosetime=$resultdayclose['sd_close'];
                      
                      
              $sqldayclose1  =  $database->mysqlQuery("Select ser_firstname FROM tbl_staffmaster where ser_staffid='".$resultdayclose['sd_open_staff']."'");
               
              $numdayclose1   = $database->mysqlNumRows($sqldayclose1);
          
	         if($numdayclose1){
                
		while($resultdayclose1  = $database->mysqlFetchArray($sqldayclose1)) 
		{
                      $name=$resultdayclose1['ser_firstname'];
                      
                }
                }
                      
        $datetime=date('Y-m-d H:i:s');
        
        $splitTimeStamp = explode(" ",$shiftopentime);

        $opentim= $splitTimeStamp[1];
        
        $splitTimeStamp1 = explode(" ",$datetime);

        $closetim= $splitTimeStamp1[1];
              
        $ta_hd=0;                        
        $sqldayclose1  =  $database->mysqlQuery("select  tab_billno  FROM tbl_takeaway_billmaster  where tab_dayclosedate='".$_SESSION['date']."' 
        and (tab_status !='Closed' and   tab_status !='Cancelled') and  tab_loginid='$name' and "
        . " tab_time between '$opentim' and '$closetim' and tab_mode!='CS' ");
        
        $numdayclose1   = $database->mysqlNumRows($sqldayclose1);
        if($numdayclose1){
        while($resultdayclose1  = $database->mysqlFetchArray($sqldayclose1)) 
	{
          $ta_hd++;
                      
         } 
        }
        
       
        $cs=0;                        
        $sqldayclose1  =  $database->mysqlQuery("select  tab_billno  FROM tbl_takeaway_billmaster  where tab_dayclosedate='".$_SESSION['date']."' 
        and (tab_status !='Closed' and   tab_status !='Cancelled') and  tab_loginid='$name' and  "
        . " tab_time between '$opentim' and '$closetim' and tab_mode='CS' ");
        
        $numdayclose1   = $database->mysqlNumRows($sqldayclose1);
        if($numdayclose1){
        while($resultdayclose1  = $database->mysqlFetchArray($sqldayclose1)) 
	{
          $cs++;
                      
                      
         } 
        }
        
       
        $di=0;                        
        $sqldayclose1  =  $database->mysqlQuery(" select  distinct(ter_orderno)   FROM tbl_tableorder  where ter_dayclosedate='".$_SESSION['date']."'
        and  (ter_status !='Closed' and  ter_status !='Cancelled')  and  ter_entryuser='$name' and ter_entrytime between '$opentim' and '$closetim' ");
        $numdayclose1   = $database->mysqlNumRows($sqldayclose1);
        if($numdayclose1){
        while($resultdayclose1  = $database->mysqlFetchArray($sqldayclose1)) 
	{
          $di++;
                      
         } 
        }
                   
          $i++;
                           
                     ?>
                                    <tr>
                                    <td width="5%"><?=$i?></td>
                                    <td width="5%"><a href="#"  class="" onclick="return shiftdetails('<?=$resultdayclose['sd_id']?>','<?=$resultdayclose['sd_day']?>','<?=$resultdayclose['sd_close']?>')" id=""><img src="img/printer_new.png"></a></td>
                                    <td width="5%"><a href="#"  class="" onclick="return shift_mail_send('<?=$resultdayclose['sd_id']?>','<?=$resultdayclose['sd_day']?>','<?=$resultdayclose['sd_close']?>')" id=""><img src="img/email_ico.png"></a></td>
                                    <td width="5%"><a href="#"  class="" onclick="return shift_view('<?=$resultdayclose['sd_id']?>','<?=$resultdayclose['sd_day']?>','<?=$resultdayclose['sd_close']?>')" id=""><img src="img/icon-view.png"></a></td>
                                   
                                    <td width="5%">
                                          <?php if($resultdayclose['sd_close']==''){ ?>
                                         <a href="#"  class="" onclick="return shift_force_close('<?=$resultdayclose['sd_id']?>','<?=$resultdayclose['sd_day']?>','<?=$resultdayclose['sd_close']?>')" id=""><img src="img/cancelled-ico.png"></a>
                                          <?php }else { ?>
                                         
                                         <a href="#" ><img src="img/check_mark.png"></a>
                                          <?php }?>
                                    </td>
                                   
                                   
                                    <td><?=$resultdayclose['sd_day']?></td>
                                    <td><?=$name?></td>
                                    <td><?=$resultdayclose['sd_open']?></td>
                                   
                                    <td><?=$resultdayclose['sd_open_balance']?></td>
                                    <td><?= $resultdayclose['sd_open_petty']?></td>
                                    <td><?=$resultdayclose['sd_total_value']?></td> 
                                    <td><?=$resultdayclose['sd_total_deno_value']?></td>
                                    <td><?=$resultdayclose['sd_open_machineid']?></td>
                                    <td><?=$resultdayclose['sd_close']?></td>
                                    <td><?=$resultdayclose['sd_close_balance']?></td>
                                    <td><?=$resultdayclose['sd_close_petty']?></td>
                                    <td><?=$resultdayclose['sd_total_value_close']?></td>
                                    <td><?=$resultdayclose['sd_total_deno_value_close']?></td>
                                    <td><?=$resultdayclose['sd_close_machineid']?></td>
                                     
                                     
                                    <?php if($resultdayclose['sd_close']=='' ){ ?> 
                                     
                                     <td  <?php if($di>0 || $ta_hd>0 || $cs>0 ){ ?> style="color:red;font-weight: bold" <?php }else{ ?> style="color:black" <?php } ?>  >DI:<?=$di?>  <br>  TA:<?=$ta_hd?> <br> CS:<?=$cs?></td>
                                    <?php }else { ?>
                                         
                                    <td>0 Bills</td>
                                    
                                    <?php }?>
                                    
         <?php } }else{ echo ' <tr> <td width="25%">NO SHIFT FOUND  </td></tr>'; } ?>
                
  <script>
            
  function shift_view(id,open,close){
         
        if(close=="")
  {
      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please Close The Shift To View');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
  }
  else
  {
       window.location.href='shift_view.php?slnoshift='+id+"&day_shift="+open+"&close="+close+"&set=shift_email"  
         
         
     }       
 }         
            
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
        alert("Please day close to get SMS ");
    }
                    }


                    
         function mail(b,dd){
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
             
             
             
            if(dd!=""){
                  
   var check = confirm("Are you sure you want to Send Mail?");
        if(check==true)
        {
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
        }
        return true;
    }else
    {
        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please Close The Shift To Send Mail');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
         }            
                    
   function pdf(b,dd){
       
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
             
         if(dd!=""){
                 
         var check = confirm("Are you sure you want to Send Mail?");
        if(check==true)
        {
            
            window.open("dayclosedetails_a4.php?datemail="+b);

        }
        return true;
    }else
    {
       
         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please Close The Shift To Send  Mail');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
    }
         }            
    
    
    function shift_force_close(closeid,date,dateclose){
      
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Force Closing Shift  ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
           if($('#forceclose_on').val()=='Y'){
            
            var datastring ="set=shift_force_close&close_id="+closeid;
            $.ajax({
                type: "POST",
                url: "load_index.php",
                data: datastring,
                success: function (data)
                { 
                    
                $.ajax({
                type: "POST",
                url: "print_details.php",
                data: "set=shift_detail&slno="+closeid+"&date="+date,
               
                success: function(data)
                {
           
           
           
                }
                });
                
                   setTimeout(function(){ 
          
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Shift Closed Sucessfully ');
                        $('.alert_error_popup_all_in_one').delay(2500).fadeOut('slow');
                  }, 1000); 
                       
                    
                 
                 // location.reload();
                 
                 var bydate=$('#bydate').val();
              
		  var fromdt=    $('#datepickerfrom').val();
		  var todt=    $('#datepickerfrom').val();
	          $('#datepickertodt').val(""); 
                  $('#datepickerfrom').val("");
		
						$.post("load_shiftdetails.php", { bydate:bydate,fromdt:fromdt,todt:todt,},
						function(data)
						{
							  data=$.trim(data);
                                                         
							  $('#reportload').html(data);
						});
                 
                 
                }
            });
            
        }else{
          
            
            $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('NO PERMISSION TO FORCE CLOSE ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
        
        
      
    }
                    
                    </script>
                
                </body>
                </table>
          