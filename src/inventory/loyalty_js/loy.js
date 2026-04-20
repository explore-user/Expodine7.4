$(document).ready(function(){
    
$('#check_all').click(function(){
    
    if($("#check_all").prop('checked') == true){
      $('.camp_chk_sel').each(function(){
        $(this).prop('checked',true);
    
   })
       $('#check_group').hide();
    }else{
        $('.camp_chk_sel').each(function(){
        $(this).prop('checked',false);
    $('#check_group').show();
   })
   
    }
     
});

  
});

function singleclick(){
    
          if($('.singlecheck').is(':checked')){
            
              $('#check_group').hide();
          }else{
            $('#check_group').show(); 
        }
       
}


function send_reward(){
    
  var condent=$('#reward_condent').val();
  var campaign_id=$('#campaign_id').val();
  var from_date_coupon=$('#from_date_coupon').val();
   var to_date_coupon=$('#to_date_coupon').val();
   
      var allmail=new Array();
      var allsms=new Array();
      var allname=new Array();
    $('.camp_chk_sel').each(function(){
       
    if($(this).prop('checked') == true){
   
    var number=$(this).attr('mobile');
    var email=$(this).attr('mail');
    var name=$(this).attr('name');
    
    allmail.push(email);
    allsms.push(number);
    allname.push(name);
    }
    
    });
    
      var sms=allsms.join(',');
      var mail=allmail.join(',');
      var nameall=allname.join(',');
   
        if($('.smson').is(':checked')){
           var  smson="Y";
        } else{
            smson="N";
        }
        
        if($('.mailon').is(':checked')){
           var  mailon="Y";
        } else{
            mailon="N";
        }
        
        var group=$('#check_group').val();
        
        
       
  if((sms!='' || mail!='') || group!=''){
      
      if(mailon!='N' || smson!='N'){
          
     $('.new_print_loading_bill_sms').show();
   var data="set_reward_sms_mail_campaign=sms_mail_campaign&all_sms="+sms+"&all_mail="+mail+"&nameall="+nameall+"&mailon="+mailon+"&smson="+smson+"&condent="+condent+"&group="+group+"&campaign_id="+campaign_id+"&from_date_coupon="+from_date_coupon+"&to_date_coupon="+to_date_coupon;
    
    $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
        
           location.reload();
           
        }
    }); 
      }else{
     $('#error_msg').show();
     $('#error_msg').html('Please Select Sms / Mail For Sending Campaign ');
     $("#error_msg").delay(2000).fadeOut('slow');
      }
  }else{
     $('#error_msg').show();
     $('#error_msg').html('Please Select Group');
     $("#error_msg").delay(2000).fadeOut('slow');
  }
}

function add_to_group(){
    
    
    var sel=$('#check_group').val();
    
   if(sel!=""){
     //  $('.hid_tab').hide();
     $('.view_search').hide();
    $('#view_tick').hide();
        var data="set_group_view1=group_view1&groupid1="+sel;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
        
           $('#load_camp_msg').html(data);
        }
    }); 
   }else{
          $('#view_tick').show();
           $('.view_search').show();
          
      //  $('.hid_tab').show();
        var data="set_camp_msg=msg_camp";
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
         
           $('#load_camp_msg').html('');
        }
    }); 
   }
}