<?php

session_start();
//error_reporting(0);
include("database.class.php"); 
$database	= new Database();



if(isset($_REQUEST['set_discount_add'])&& ($_REQUEST['set_discount_add']=='discount_add')){
            $id=$_REQUEST['menuid_ds'];
             $value= $_REQUEST['value'];
             $dine= $_REQUEST['dine'];
             $ta=$_REQUEST['ta'];
             $cs= $_REQUEST['cs'];
             $date=$_REQUEST['datelimit'];
             $from= $_REQUEST['from'];
             $to=$_REQUEST['to'];
             $sts= $_REQUEST['status'];
            $day=$_REQUEST['daylimit'];
            $time=$_REQUEST['timelimit'];
             
            
                if($_REQUEST['from_time']!=""){
             $fromtime=date("H:i", strtotime($_REQUEST['from_time'])); 
                }else{
                   $fromtime=""; 
                }
                
                 if($_REQUEST['to_time']!=""){
              $totime= date("H:i", strtotime($_REQUEST['to_time']));
              
                 }else{
                     $totime="";
                 }
              
              $day_in= $_REQUEST['day'];
              
             if($day_in!=""){
                 $insertion['md_day']= mysqli_real_escape_string($database->DatabaseLink,trim($day_in));    
             }
                 
             
              
              if($fromtime!=""){
                  $insertion['md_from_time']= mysqli_real_escape_string($database->DatabaseLink,trim($fromtime));   
              }
              
         if($totime!=""){
    
               $insertion['md_to_time']= mysqli_real_escape_string($database->DatabaseLink,trim($totime));   
                }
              
              
             if($from!=""){
                   $insertion['md_from_date']= mysqli_real_escape_string($database->DatabaseLink,trim($from)); 
             }
             
             if($to!=""){
                 $insertion['md_to_date']= mysqli_real_escape_string($database->DatabaseLink,trim($to));
             }
             
             $sl=0;
             
             
         $insertion['md_slno'] = mysqli_real_escape_string($database->DatabaseLink,trim($sl));      
        $insertion['md_menuid'] = mysqli_real_escape_string($database->DatabaseLink,trim($id)); 
        $insertion['md_discount']= mysqli_real_escape_string($database->DatabaseLink,trim($value)); 
        $insertion['md_di_active']=  mysqli_real_escape_string($database->DatabaseLink,trim($dine)); 
        $insertion['md_ta_active']=  mysqli_real_escape_string($database->DatabaseLink,trim($ta));
        $insertion['md_cs_active']=  mysqli_real_escape_string($database->DatabaseLink,trim($cs));
        $insertion['md_date_limit']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
        $insertion['md_time_limit']= mysqli_real_escape_string($database->DatabaseLink,trim($time));
        $insertion['md_day_limit']= mysqli_real_escape_string($database->DatabaseLink,trim($day));
     
	
        $insertion['md_active']= mysqli_real_escape_string($database->DatabaseLink,trim($sts));
        
       
   
	$insertid      =  $database->insert('tbl_menu_discount',$insertion); 

        
       
        

}

if(isset($_REQUEST['set_discount_update'])&& ($_REQUEST['set_discount_update']=='discount_update')){

 

             $id1=$_REQUEST['menuid_ds1'];
             $slno1= $_REQUEST['slno1'];
             $value1= $_REQUEST['value1'];
             $dine1= $_REQUEST['dine1'];
             $ta1=$_REQUEST['ta1'];
             $cs1= $_REQUEST['cs1'];
             
             $date1=$_REQUEST['datelimit1'];
           
             $sts1= $_REQUEST['status1'];
             
             $time1= $_REQUEST['timelimit1'];
             $day1=$_REQUEST['daylimit1'];
             
             
             
             if($_REQUEST['to1']!=""){
                   $to1=$_REQUEST['to1'];
             }else{
                 $to1="";
             }
             
             
             if($_REQUEST['from1']!=""){
                  $from1= $_REQUEST['from1'];
             }else{
               $from1="";  
             }
            
           
            if($_REQUEST['day1']!=""){
                $dayin1=$_REQUEST['day1'];
            }else{
                $dayin1="";
            }
             
             if($_REQUEST['to_time1']!=""){
              $totime1= date("H:i", strtotime($_REQUEST['to_time1']));
             
             }else{
                $totime1=""; 
             }
             
             if($_REQUEST['from_time1']!=""){
              $fromtime1= date("H:i", strtotime($_REQUEST['from_time1']));
             
             }else{
               $fromtime1="";  
             }
             
           
              if($_REQUEST['daylimit1']=="N"){
                   $dayin1="";
              }
             
            
            if($_REQUEST['datelimit1']=="N"){
                   $from1="";
                   $to1="";
              }   
             
              if($_REQUEST['timelimit1']=="N"){
                   $totime1="";
                   $fromtime1="";
              }  
              
              
             $sql_smsattemt_updation  =  $database->mysqlQuery("UPDATE tbl_menu_discount SET md_discount='".$value1."',md_active='".$sts1."',
                     md_date_limit='".$date1."',md_from_date=IF('$from1'='',NULL,'$from1'),md_to_date=IF('$to1'='',NULL,'$to1'),md_di_active='".$dine1."',
                     md_cs_active='".$cs1."',md_ta_active='".$ta1."',md_time_limit='".$time1."',md_day_limit='".$day1."',md_from_time=IF('$fromtime1'='',NULL,'$fromtime1'),
                     md_to_time=IF('$totime1'='',NULL,'$totime1'),md_day='".$dayin1."' where md_menuid='".$id1."' and md_slno='".$slno1."' ");

             
     
 }


if(isset($_REQUEST['set_discount_list'])&& ($_REQUEST['set_discount_list']=='discount_list')){
    
    $discount_menuid=$_REQUEST['discount_id'];
    $discount_name=$_REQUEST['discount_name'];
    
    
  
?>
 <div class="discount_popup_cc disc_pop" >
        	<div class="discount_popup">
                    <div class="discount_popup_head" >Discount- <?= $discount_name?><a href="#" onclick="return close_discount();"><button class="md-close_pop discount_pop_close disc_close">x</button></a></div>
        		<div class="discount_popup_conatant">
        			<div class="dicount_popup_add_sec">
        				
                       <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:12%;margin-bottom: 10px">
                          <p class="menu_filter_txt">Discount</p>
                         
                          <select class="form-control" id="ds_value">
                              <option value="">Select</option>
                                                              <?php 
                       $sql_cat_s_dis  =  $database->mysqlQuery("select * from  tbl_discountmaster where ds_item_discount='Y' and ds_status='Active' ");

           $num_cat_s_dis  = $database->mysqlNumRows($sql_cat_s_dis);
	if($num_cat_s_dis){
		while($result_ds_view_dis  = $database->mysqlFetchArray($sql_cat_s_dis)) 
			{
                    
                    if($result_ds_view_dis['ds_mode']=='P'){
                        $mode='%';
                        }else{
                          $mode="";  
                        }
                    
                    
                    ?>
                              <option value="<?=$result_ds_view_dis['ds_discountid']?>"> <?=$result_ds_view_dis['ds_discountname']?>&nbsp;[<?=$result_ds_view_dis['ds_discountof']?>  <?=$mode?>]</option>
                              
        <?php } } ?>
                          </select>
					   </div>
       					<div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 10px">
                          <p class="menu_filter_txt">DI</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_dine">
					   </div>
      				<div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 10px">
                          <p class="menu_filter_txt">TA-HD</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_takeaway">
					   </div>
       				<div class="col-sm-2 check_box_cc_disc" style="padding-right: 5px;padding-left: 0px;width:5%;margin-bottom: 10px">
                          <p class="menu_filter_txt">CS</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_counter">
					   </div>
      				
                        <div id="del_disc_new">    
                       
                            
                       
                                    
                       <div class="col-sm-2 check_box_cc_disc" style="display: none;padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 10px" id="ds_daylimit_div">
                          <p class="menu_filter_txt">Day Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_daylimit" onclick="daychange();">
			</div>
                        </div>     
                                    
                        
                         <div class="col-sm-2" style="padding-right: 5px;padding-left: 5px;width:9%;margin-bottom: 10px">
                          <p class="menu_filter_txt">Status</p>
                          <select class="form-control" id="ds_status">
                              <option value="Y">Active</option>
                              <option value="N">Inactive</option>
                          </select>
					   </div>
      				
                          <div class="col-sm-2 check_box_cc_disc" style="display: block;padding-right: 5px;padding-left: 0px;width:10%;margin-bottom: 10px" id="ds_datelimit_div">
                          <p class="menu_filter_txt">Date Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_datelimit" onclick="datechange();">
			</div>           
                                    
                                    
      			<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:11%;margin-left: 7px;display: block;margin-bottom: 10px" id="from_div">
                          <p class="menu_filter_txt">From</p>
                          <input type="text" class="form-control"  placeholder="From" id="ds_from" data-provide="datepicker">
					   </div>
      				
      				<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:11%;display: block;margin-bottom: 10px" id="to_div">
                          <p class="menu_filter_txt">To</p>
                          <input type="text" class="form-control"  placeholder="To" id="ds_to" data-provide="datepicker">
					   </div>
     				 
                           <div class="col-sm-2 check_box_cc_disc" style="display: block;padding-right: 5px;padding-left: 0px;width:8%;margin-bottom: 10px" id="ds_timelimit_div">
                          <p class="menu_filter_txt">Time Limit</p>
                          <input type="checkbox" class="checkbox_discount" id="ds_timelimit" onclick="timechange();">
			</div>          
                                    
     			<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:11%;margin-bottom:10px;display: block" id="from_div_time">
                          <p class="menu_filter_txt">Start Time</p>
                          <input type="time" class="form-control" id="ds_startime" placeholder="Time From" onchange="fromtime(this.value)" >
                           <span id="display_timefrom" style="display:none"></span>
					   </div>
     			<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:11%;margin-left: 7px;margin-bottom: 10px;display: block" id="to_div_time">
                          <p class="menu_filter_txt">End Time </p>
                          <input type="time" class="form-control"  id="ds_endtime"  placeholder="Time To" onchange="totime(this.value)">
                            <span id="display_timeto" style="display:none"></span>
			</div>
                                    
                        <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:10%;margin-bottom: 10px;display: none" id="day_div">
                          <p class="menu_filter_txt">Day</p>
                          <select class="form-control" id="ds_day">
                               <option value="">Select</option>
                              <option value="Monday">Monday</option>
                               <option value="Tuesday">Tuesday</option>
                               <option value="Wednesday">Wednesday</option>
                               <option value="Thursday">Thursday</option>
                               <option value="Friday">Friday</option>
                               <option value="Saturday">Saturday</option>
                               <option value="Sunday">Sunday</option>
                              
                          </select>
					   </div>
      				 
       				<div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:9%">
       				<div id="add_ds" style="margin: 17px 0 0 4px;" class="search_btn_member_invoice"><a onclick="return add_discount('<?=$discount_menuid?>');" href="#" >+ADD</a></div>
                                <div id="upd_ds" style="margin: 13px 0 0 4px;display: none" class="search_btn_member_invoice"><a onclick="return update_discount('<?=$discount_menuid?>');" href="#" >Update</a></div>
                                          
                                <input type="hidden" id="hidden_slno" >
                                </div>
                                    <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;width:9%">
                                     <div id="clear_ds" style="margin: 13px 0 0 4px;display: none" class="search_btn_member_invoice"><a onclick="return clear_discount();" href="#" >Clear All</a></div>
        			</div>
        			</div>
        			<span class="tab_table_cont_cc">
				      <table class="responstable" id="dinein">
						  <thead>
						  <tr>
						  <th>Discount</th>
						  <th>DI</th>
						  <th>TA</th>
						  <th>CS</th>
                                             <th>Date Limit</th><!--
-->						  <th>Date From</th><!--
-->						  <th>Date To</th><!--
-->						  <th>Time Limit</th><!--
-->						  <th>Time From</th>
						  <th>Time To</th><!--
                                                     <th>Day Limit</th>
                                                     <th>Day</th>-->
						  <th>Status</th>
						  <th>Action</th>                                                 
						  </tr>
						</thead>
                                                <tbody id="refcount_discount">
                                                      <?php 
                       $sql_cat_s  =  $database->mysqlQuery("select * from  tbl_menu_discount left join tbl_discountmaster on ds_discountid= md_discount where md_menuid='".$discount_menuid."'");

           $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){
		while($result_ds_view  = $database->mysqlFetchArray($sql_cat_s)) 
			{
                    ?>
               
			                                      
							 <tr>
							 <td><?=$result_ds_view['ds_discountname']?></td>
							 <td><?=$result_ds_view['md_di_active']?></td>
							  <td><?=$result_ds_view['md_ta_active']?></td>
							  <td><?=$result_ds_view['md_cs_active']?></td>
                                                           <td><?=$result_ds_view['md_date_limit']?></td><!--
-->							  <td><?=$result_ds_view['md_from_date']?></td>
							  <td><?=$result_ds_view['md_to_date']?></td><!--
                                                          
                                                          
-->							  <td><?=$result_ds_view['md_time_limit']?></td><!--
-->							  <td><?=$result_ds_view['md_from_time']?></td>
							  <td><?=$result_ds_view['md_to_time']?></td>
                                                          <!--
                                                          <td><?//=$result_ds_view['md_day_limit']?></td>
							  <td><?//=$result_ds_view['md_day']?></td>-->
                                                          
							  <td><?=$result_ds_view['md_active']?></td>
							   
							<td> 
								
								<a onclick="return edit_discount('<?=$result_ds_view['md_discount']?>','<?=$result_ds_view['md_di_active']?>','<?=$result_ds_view['md_ta_active']?>','<?=$result_ds_view['md_cs_active']?>','<?=$result_ds_view['md_date_limit']?>','<?=$result_ds_view['md_from_date']?>','<?=$result_ds_view['md_to_date']?>','<?=$result_ds_view['md_active']?>','<?=$result_ds_view['md_slno']?>','<?=$result_ds_view['md_time_limit']?>','<?=$result_ds_view['md_day_limit']?>','<?=$result_ds_view['md_from_time']?>','<?=$result_ds_view['md_to_time']?>','<?=$result_ds_view['md_day']?>');" style="font-size: 18px;padding-left: 10px;display: inline-block ;"  href="#"><i class="fa fa-edit"></i></a>
								
							</td>
						  </tr>
        <?php } } ?>
							  </tbody>
							</table>    
                                    
						 </span>

        		</div>
        	<strong style="color:red;text-align: center;margin-top: -18px;font-size: 15px;float: left;width: 100%;" id="error_show_dis" ></strong> 	
        	</div>
        	
        </div>    
<style>.tab_table_cont_cc {
    width: 100%;
    height: 48vh;
    min-height: 370px;}</style>

<script type="text/javascript">
    $(document).ready(function(){
    
    
     $( "#ds_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
             $( "#ds_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
    
            
         
            
            
                  });
                  
                  
     function fromtime(time) {

  //console.log(time);
  //alert(time.value);
  if (time.value !== "") {
    var hours = time.split(":")[0];
    var minutes = time.split(":")[1];
    var suffix = hours >= 12 ? "pm" : "am";
    hours = hours % 12 || 12;
    hours = hours < 10 ? "0" + hours : hours;

    var displayTime = hours + ":" + minutes + " " + suffix;
    document.getElementById("display_timefrom").innerHTML = displayTime;
    
  }
     }
                  
                  
   function totime(time1) {

  if (time1.value !== "") {
    var hours = time1.split(":")[0];
    var minutes = time1.split(":")[1];
    var suffix = hours >= 12 ? "pm" : "am";
    hours = hours % 12 || 12;
    hours = hours < 10 ? "0" + hours : hours;

    var displayTime = hours + ":" + minutes + " " + suffix;
    document.getElementById("display_timeto").innerHTML = displayTime;
  }               
   }                
             function close_discount(){
                    $('.disc_pop').hide();
                 }
                  
                  
                  
                  
      function add_discount(mid){
          
          var value=$('#ds_value').val();
         
           if(document.getElementById('ds_takeaway').checked) {
               var ta='Y'; 
           }else{
                ta='N'; 
           }
           
           if(document.getElementById('ds_counter').checked) {
               var cs='Y'; 
           }else{
                 cs='N'; 
           }
           
           if(document.getElementById('ds_dine').checked) {
               var dine='Y'; 
           }else{
                dine='N'; 
           }
           
           if(document.getElementById('ds_datelimit').checked) {
               var datelimit='Y'; 
           }else{
                datelimit='N'; 
           }
             
             if(document.getElementById('ds_timelimit').checked) {
               var timelimit='Y'; 
           }else{
                 timelimit='N'; 
           }
           
           if(document.getElementById('ds_daylimit').checked) {
               var daylimit='Y'; 
           }else{
                 daylimit='N'; 
           }
             
               var from=$('#ds_from').val();
               var to=$('#ds_to').val();
               var status=$('#ds_status').val();
             
               if (from.indexOf('/') > -1 ) {
   
      var d=from.replace('/','-');
      var d1=d.replace('/','-');
     var d2=d1.split('-');
      from=d2[2]+'-'+d2[0]+'-'+d2[1];
  
      }           
            
      
      
        if (to.indexOf('/') > -1 ) {
   
      var d13=to.replace('/','-');
      var d11=d13.replace('/','-');
     var d21=d11.split('-');
      to=d21[2]+'-'+d21[0]+'-'+d21[1];
  
      }
               var from_time=$('#display_timefrom').html();
               var to_time=$('#display_timeto').html();
       
              var day=$('#ds_day').val();
              
           
          
          if(value!=""){
             
             var data2="value=check_discount_item&menu_id="+mid+"&dis_id="+value;
             
              $.ajax({
        type: "POST",
        url: "load_divcheckmenu.php",
        data: data2,
        success: function(data)
        {
           data=$.trim(data);
          
           if(data!="sorry"){ 
              
          var data="set_discount_add=discount_add&value="+value+"&dine="+dine+"&ta="+ta+"&cs="+cs+"&datelimit="+datelimit+"&from="+from+"&to="+to+"&status="+status+"&menuid_ds="+mid+"&timelimit="+timelimit+"&daylimit="+daylimit+"&from_time="+from_time+"&to_time="+to_time+"&day="+day;
       
         //alert(data);
        $.ajax({
        type: "POST",
        url: "menu_discount.php",
        data: data,
        success: function(data)
        {
            
         var data="set_add_load=add_load&menu_ds_id="+mid;
       
         
        $.ajax({
        type: "POST",
        url: "load_menu_discount.php",
        data: data,
        success: function(data)
        {
          $('#refcount_discount').html(data);
          $('#ds_value').val('');  
          $('#ds_from').val('');
          $('#ds_to').val('');
          $('#ds_status').val('Y');
          $('#ds_dine').attr('checked', false);
          $('#ds_takeaway').attr('checked', false);
          $('#ds_counter').attr('checked', false);
          $('#ds_datelimit').attr('checked', false);
           $('#ds_timelimit').attr('checked', false);
            $('#ds_daylimit').attr('checked', false);
          $('#from_div').hide();
            $('#to_div').hide();
            $('#from_div_time').hide();
          $('#to_div_time').hide();
            $('#error_show_dis').empty();
              $('#day_div').hide();
               $('#ds_day').val('');
                            $('#error_show_dis').css("display", "block");
			    var rptstatuschkk112=$('#error_show_dis');
                            // alert(rptstatus);
                              rptstatuschkk112.text('ADDED');	
                            $("#error_show_dis").delay(2000).fadeOut('slow');
                             $('#ds_value').focus();  
        }
    });
          
            
        }
    });
        
          }else{
              $('#error_show_dis').empty();	
                            $('#error_show_dis').css("display", "block");
			    var rptstatuschkk112=$('#error_show_dis');
                            // alert(rptstatus);
                            rptstatuschkk112.text('Discount Already Exist For Menu');	
                            $("#error_show_dis").delay(2000).fadeOut('slow');
                             $('#ds_value').focus();  
          }
          
          
      }
      });
        
        
        
          }
          else{
                                $('#error_show_dis').empty();	
                            $('#error_show_dis').css("display", "block");
			    var rptstatuschkk112=$('#error_show_dis');
                            // alert(rptstatus);
                            rptstatuschkk112.text('Select Discount...!');	
                            $("#error_show_dis").delay(2000).fadeOut('slow');
                             $('#ds_value').focus();  
          }
          
          
          
          
          
      }
      
      
   function datechange(){
    
    if(document.getElementById('ds_datelimit').checked) {
   $('#from_div').show();
    $('#to_div').show();
} else {
  $('#from_div').hide();
   $('#to_div').hide();
}
    
    
}   

  function timechange(){
    
    if(document.getElementById('ds_timelimit').checked) {
   $('#from_div_time').show();
    $('#to_div_time').show();
} else {
  $('#from_div_time').hide();
   $('#to_div_time').hide();
}
    
    
} 
  
  
   function daychange(){
    
    if(document.getElementById('ds_daylimit').checked) {
   $('#day_div').show();
   
} else {
  $('#day_div').hide();
  
}
    
    
} 
  
  
  function clear_discount(){
      
          $('#ds_value').val('');  
          $('#ds_from').val('');
          $('#ds_to').val('');
          $('#ds_status').val('Y');
          $('#ds_dine').attr('checked', false);
          $('#ds_takeaway').attr('checked', false);
          $('#ds_counter').attr('checked', false);
          $('#ds_datelimit').attr('checked', false);
           $('#ds_timelimit').attr('checked', false);
            $('#ds_daylimit').attr('checked', false);
         
         $('#from_div').hide();
         $('#to_div').hide();
         $('#ds_daylimit_div').show();
          $('#ds_timelimit_div').show();
           $('#add_ds').show();   
           $('#upd_ds').hide();  
             $('#clear_ds').hide();  
               $('#from_div_time').hide();
                 $('#to_div_time').hide();
                  $('#day_div').hide();
  }
  
  
  
  function edit_discount(v,d,t,c,dl,fr,to,ac,sl,tl,dyl,tls,tle,dyin){
     
            $('#ds_value').val(v);  
            $('#ds_dine').val(d);  
            $('#ds_takeaway').val(t);  
            $('#ds_counter').val(c);  
            $('#ds_datelimit').val(dl);  
            $('#ds_from').val(fr);  
            $('#ds_to').val(to);  
             $('#ds_status').val(ac);  
             
             
             
           $('#del_disc_new').hide();    
           
            if(c=='Y'){
             $('#ds_counter').prop('checked', true);
         }else{
             $('#ds_counter').prop('checked', false); 
         }
         
          if(t=='Y'){
             $('#ds_takeaway').prop('checked', true);
         }else{
             $('#ds_takeaway').prop('checked', false); 
         }
         
          if(d=='Y'){
             $('#ds_dine').prop('checked', true);
         }else{
             $('#ds_dine').prop('checked', false); 
         }
        
           if(dl=='Y'){
             $('#ds_datelimit').prop('checked', true);
              $('#from_div').show();
                $('#to_div').show();
                $('#ds_from').val(fr);  
                 $('#ds_to').val(to);  
             
         }else{
             $('#ds_datelimit').prop('checked', false); 
            
         }
         
         if(tl=='Y'){
             $('#ds_timelimit').prop('checked', true);
              $('#from_div_time').show();
                 $('#to_div_time').show();
                
             $('#ds_startime').val(tls);
             $('#ds_endtime').val(tle)
         }else{
             $('#ds_timelimit').prop('checked', false); 
            
         }
         
         
          if(dyl=='Y'){
             $('#ds_daylimit').prop('checked', true);
              $('#day_div').show();
               $('#ds_day').val(dyin);
                
             
         }else{
             $('#ds_daylimit').prop('checked', false); 
            
         }
         
         
          $('#add_ds').hide();   
          $('#upd_ds').show();  
          $('#clear_ds').show();  
           
           $('#hidden_slno').val(sl);
           
       $('#ds_datelimit_div').show();
       $('#ds_daylimit_div').show();
      
    
     
     
       $('#ds_timelimit_div').show();
      
       
      
     
  }
  
  
  function update_discount(i){
      
      var slno1=$('#hidden_slno').val();
      
      var value1=$('#ds_value').val();
         
           if(document.getElementById('ds_takeaway').checked) {
               var ta1='Y'; 
           }else{
                var ta1='N'; 
           }
           
           if(document.getElementById('ds_counter').checked) {
               var cs1='Y'; 
           }else{
                var cs1='N'; 
           }
           
           if(document.getElementById('ds_dine').checked) {
               var dine1='Y'; 
           }else{
                var dine1='N'; 
           }
           
          
               var status1=$('#ds_status').val();
          
          
               if(document.getElementById('ds_datelimit').checked) {
               var datelimit1='Y'; 
           }else{
                datelimit1='N'; 
           }
             
             if(document.getElementById('ds_timelimit').checked) {
               var timelimit1='Y'; 
           }else{
                 timelimit1='N'; 
           }
           
           if(document.getElementById('ds_daylimit').checked) {
               var daylimit1='Y'; 
           }else{
                 daylimit1='N'; 
           }
              
               
               var from1=$('#ds_from').val();
               var to1=$('#ds_to').val();
               var from_time1=$('#ds_startime').val();
               var to_time1=$('#ds_endtime').val();
                var day1=$('#ds_day').val();
          
          
          
          
              if (from1.indexOf('/') > -1 ) {
   
      var d=from1.replace('/','-');
      var d1=d.replace('/','-');
     var d2=d1.split('-');
      from1=d2[2]+'-'+d2[0]+'-'+d2[1];
  
      }           
            
      
      
        if (to1.indexOf('/') > -1 ) {
   
      var d13=to1.replace('/','-');
      var d11=d13.replace('/','-');
     var d21=d11.split('-');
      to1=d21[2]+'-'+d21[0]+'-'+d21[1];
  
      }
          
          
          
        
          if(value1!=""){
              
          var data="set_discount_update=discount_update&value1="+value1+"&dine1="+dine1+"&ta1="+ta1+"&cs1="+cs1+"&status1="+status1+"&menuid_ds1="+i+"&slno1="+slno1+"&timelimit1="+timelimit1+"&daylimit1="+daylimit1+"&from_time1="+from_time1+"&to_time1="+to_time1+"&day1="+day1+"&datelimit1="+datelimit1+"&from1="+from1+"&to1="+to1;
       
      
        $.ajax({
        type: "POST",
        url: "menu_discount.php",
        data: data,
        success: function(data)
        {
            
         var data="set_add_load=add_load&menu_ds_id="+i;
       
         
        $.ajax({
        type: "POST",
        url: "load_menu_discount.php",
        data: data,
        success: function(data)
        {
          $('#refcount_discount').html(data);
          $('#ds_value').val('');  
          $('#ds_from').val('');
           $('#ds_startime').val('');
           $('#ds_endtime').val('');
            $('#ds_day').val('');
           
          $('#ds_to').val('');
          $('#ds_status').val('Y');
          $('#ds_dine').attr('checked', false);
          $('#ds_takeaway').attr('checked', false);
          $('#ds_counter').attr('checked', false);
          $('#ds_datelimit').attr('checked', false);
           $('#ds_timelimit').attr('checked', false);
           $('#ds_daylimit').attr('checked', false);
          $('#ds_datelimit_div').show();
         
           $('#ds_daylimit_div').show();
           $('#ds_timelimit_div').show();
           $('#add_ds').show();   
           $('#upd_ds').hide();  
           $('#clear_ds').hide();  
           $('#from_div_time').hide();
                 $('#to_div_time').hide();
                  $('#day_div').hide();
                  $('#from_div').hide();
                 $('#to_div').hide();
                  
                                    $('#error_show_dis').empty();	
                                    $('#error_show_dis').css("display", "block");
                                    var rptstatuschkk112=$('#error_show_dis');

                                    rptstatuschkk112.text('UPDATED');	
                                    $("#error_show_dis").delay(2000).fadeOut('slow');

        }
    });
          
            
        }
    });
        
          }else{
                                $('#error_show_dis').empty();	
                            $('#error_show_dis').css("display", "block");
			    var rptstatuschkk112=$('#error_show_dis');
                            // alert(rptstatus);
                            rptstatuschkk112.text('Enter Details');	
                            $("#error_show_dis").delay(1500).fadeOut('slow');
                             $('#ds_value').focus();  
          }
     
      
      
  }
  
 
    </script>

<script>
    //$('#ds_startime').timepicki({});
//	$('#ds_endtime').timepicki({});
</script>
<?php
}
?>