$(document).ready(function(){
    
    //***********************COMBO RATE POPUP WHEN PACK ADDING TIME******************//
    
    if(sessionStorage.newpack==1){
        $('.new_overlay').css('display','block');
        $('#combo_rate_popup').css('display','block');
        var combo_name=$('#combo_name_pack_add').text();
        $('#combo_name_rate_add').text(combo_name);
        var combo_pack_name=$('.combo_pack_rate_add').last().attr('combo_pack_name');
        var combo_pack_id=$('.combo_pack_rate_add').last().attr('combo_pack_id');
        $('.comb_pack_name_display').text(combo_pack_name);
        $('#comb_pack_id_display').val(combo_pack_id);
        var dataString = 'set=combo_pack_rate_addpopup&combo_pack_id='+combo_pack_id+'&mode=DI';
        $.ajax({
            type: "POST",
            url: "combo_add_menuload.php",
            data: dataString,
            success: function(data) {
                $('.tab_content').html(data);
                $('#floor_selection_span').css('display','block');
                sessionStorage.newpack=0;
            }   
        });
    }
    //***********************COMBO RATE POPUP WHEN PACK ADDING TIME******************//
    
    $('#combo_pack').focus();
    var onload_row_pack_name=$('.pack_rows:First').find('.combo_pack_name_display').text();
    var onload_row_pack_id=$('.pack_rows:First').attr('id');
    var onload_combo_id=$('#combo_id_field').val();
        if(localStorage.firstload=='Y'){
            localStorage.combo_pack_id=$('.pack_rows:First').attr('id');
        }
    $('.pack_rows').each(function(){
        if($(this).attr('id')==localStorage.combo_pack_id){
         
        $('.pack_rows').removeClass('select_cmb_pack');
        $(this).addClass('select_cmb_pack');
        var each_row_pack_name=$(this).find('.combo_pack_name_display').text();
        $('#pack_item_head').text(each_row_pack_name+' Items');
        }   
    });
    if(localStorage.combo_type==1){
        $('#combo_qty_div').css('display','block');
        
    }
    else{
       
        $('.pack_qty_display').css('display','none');
        $('.pack_qty_display_head').css('display','none');
        if(localStorage.combo_type==3){
        $('#optional_menu_type_div').css('display','block');
        $('#menu_option_selection_div').css('display','block');
        
        
        }
        $('#menu_qty_div').css('display','block');
        
    }
    var dataString = 'set=menu_first_load&onload_row_pack_id='+localStorage.combo_pack_id+'&onload_combo_id='+onload_combo_id+"&onload_combo_type="+localStorage.combo_type;
    $.ajax({
        type: "POST",
        url: "combo_add_menuload.php",
        data: dataString,
        success: function(data) {
            
            $('.combo_menu_load_table').html(data);
            }   
            
    });
    
    
    
    $('#combo_pack_add').click(function(){
        var combo_id=$('#combo_id_field').val();
        var combo_pack_edit_id=$('#combo_pack_id_field').val();
        
        var combo_name_pack_add=$('#combo_name_pack_add').text();
        var combo_pack_name=$('#combo_pack').val();
        
        if(combo_pack_name==''){
                $('#combo_pack').focus();
                $('#combo_pack').addClass('cmb_txt_error');
                $('#combo_pack_alert_span').css('display','block');
                $('#combo_pack_alert_span').text('Please Add Combo Pack..');
                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                return false;
        }else{
            $('#combo_pack').removeClass('cmb_txt_error');
            if(localStorage.combo_type==1){
                var combo_pack_qty=$('#combo_qty').val();
                
                if(combo_pack_qty<=0 || !$.isNumeric(combo_pack_qty)){
                    $('#combo_qty').focus();
                    $('#combo_qty').addClass('cmb_txt_error');
                    $('#combo_pack_alert_span').css('display','block');
                    $('#combo_pack_alert_span').text('Please Check Qty..');
                    $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                    return false;
                }
            }    
               
            else{
                  var combo_pack_qty=0;
            }
            $('#combo_qty').removeClass('cmb_txt_error');
            var dataString = 'set=combo_pack_add&combo_id='+combo_id+'&combo_pack_name='+combo_pack_name+"&combo_pack_qty="+combo_pack_qty+"&combo_name_pack_add="+combo_name_pack_add+"&combo_pack_edit_id="+combo_pack_edit_id;
            $.ajax({
                type: "POST",
                url: "combo-add.php",
                data: dataString,
                success: function(data) {
                    data=data.split("@@@");
                    $('#combo_pack').val('');
                    $('#combo_pack').focus();
                    $('#combo_qty').val('');
                     $('#combo_pack_alert_span').css('display','block');
                    $('#combo_pack_alert_span').text(data[1]);
                    $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                    //alert(combo_pack_edit_id);
                    if(combo_pack_edit_id==''){
                        sessionStorage.newpack=1;
                    }
                    window.location="combo-add.php?set=combodetails&combo_id="+combo_id+"&combo_name="+combo_name_pack_add+"&combo_type="+localStorage.combo_type;
                }
            });
            
        }
    });
    
    $('.combo_pack_edit_btn').click(function(){
        
        var combo_pack_edit_id=$(this).attr('id');
        var combo_pack_qty_edit=$('#pack_qty_display'+combo_pack_edit_id).text();
        var combopack_edit_name=$("#combo_pack_name_display"+combo_pack_edit_id).text();
        var combo_name_pack_edit=$('#combo_name_pack_add').text();
        combopack_edit_name=combopack_edit_name.replace(combo_name_pack_edit,'');
       $('#combo_pack').val($.trim(combopack_edit_name));
        $('#combo_pack').focus();
       if(combo_pack_qty_edit>0){
           $('#combo_qty').val(combo_pack_qty_edit);
       }
        $('#combo_pack_id_field').val(combo_pack_edit_id);      
    });
    $('.combo_pack_delete_btn').click(function(){
        var combo_pack_delete_id=$(this).attr('id');
         var combo_id=$('#combo_id_field').val();
        var dataString = 'set=combo_pack_delete&combo_pack_delete_id='+combo_pack_delete_id;
            $.ajax({
                type: "POST",
                url: "combo-add.php",
                data: dataString,
                success: function(data) {
                   
                }
            });
    });
    $('.combo_pack_status_change').click(function(){
        var combo_pack_id=$(this).attr('id1');
        var status_to=$(this).attr('status_to');
        var dataString = 'set=combo_pack_status_change&combo_pack_edit_id='+combo_pack_id+"&status_to="+status_to;
        $.ajax({
            type: "POST",
            url: "combo-add.php",
            data: dataString,
            success: function(data) {
                data=data.split("@@@");
                $('#combo_pack_alert_span').css('display','block');
                $('#combo_pack_alert_span').text(data[1]);
                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
            }
        });
        
    });
    $('.pack_rows').click(function(){
            $('.pack_rows').removeClass('select_cmb_pack');
            $(this).addClass('select_cmb_pack');
            var each_row_pack_name=$(this).find('.combo_pack_name_display').text();
            $('#pack_item_head').text(each_row_pack_name+' Items');
            $('#search_menu_combo').val('');
            $("#valueofsearch_menu").val('');
            $('#combo_pack_menuqty').val('');
            $('#search_menu_combo').removeClass('cmb_txt_error');
            $('#search_menu_combo').focus();
            var row_pack_id=$(this).attr('id');
            localStorage.combo_pack_id=row_pack_id;
            localStorage.firstload='N';
            var combo_id=$('#combo_id_field').val();
           
            var dataString = 'set=menu_first_load&onload_row_pack_id='+row_pack_id+'&onload_combo_id='+combo_id+"&onload_combo_type="+localStorage.combo_type;
            $.ajax({
                type: "POST",
                url: "combo_add_menuload.php",
                data: dataString,
                success: function(data) {

                    $('.combo_menu_load_table').html(data);
                    }   

            });
    });
    
    $('#compo_pack_menu_add').click(function(){
           var combo_pack_menu_entry_id=$('#combo_pack_menu_entry_id').val();
           
           var combo_menu_id=$("#valueofsearch_menu").val();
           var combo_id=$("#combo_id_field").val();
           var combo_pack_id=$('.select_cmb_pack').find('.combopack_row_id').attr('id1');
           var menu_combo_qty=$('#combo_pack_menuqty').val();
           var menu_sale_type=$('#menu_sale_type').val();
           var menu_option_label=$('#menu_option_label').val();
//           alert(combo_menu_id);
//           alert(combo_pack_id);
//           alert(combo_id);
//           alert(menu_sale_type);
//           alert(menu_option_label);
//           alert(menu_combo_qty);
                if(combo_menu_id==''){
                    $('#search_menu_combo').focus();
                    $('#search_menu_combo').addClass('cmb_txt_error');
                    $('#combo_pack_alert_span').css('display','block');
                    $('#combo_pack_alert_span').text('Please Add Menu');
                    $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                    return false;
                }
                else{
                        $('#search_menu_combo').removeClass('cmb_txt_error');                   
                        if(localStorage.combo_type==3){
                            if(menu_sale_type==''){
                                $('#menu_sale_type').focus();
                                $('#menu_sale_type').addClass('cmb_txt_error');
                                $('#combo_pack_alert_span').css('display','block');
                                $('#combo_pack_alert_span').text('Please Select One Option..');
                                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                                return false;
                            }
                            
                                
                            if(menu_option_label=='' && menu_sale_type=='Option'){
                                $('#menu_sale_type').removeClass('cmb_txt_error'); 
                                $('#menu_option_label').focus();
                                $('#menu_option_label').addClass('cmb_txt_error');
                                $('#combo_pack_alert_span').css('display','block');
                                $('#combo_pack_alert_span').text('Please Select One Option..');
                                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                                return false;
                            }
                        }
                            if(localStorage.combo_type==2 || localStorage.combo_type==3){
                                if(menu_combo_qty<=0 || !$.isNumeric(menu_combo_qty)){
                            
                                    $('#menu_option_label').removeClass('cmb_txt_error');
                                    $('#combo_pack_menuqty').focus();
                                    $('#combo_pack_menuqty').addClass('cmb_txt_error');
                                    $('#combo_pack_alert_span').css('display','block');
                                    $('#combo_pack_alert_span').text('Please Check Qty..');
                                    $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                                    return false;
                                    }
                            }
                            $('#combo_pack_menuqty').removeClass('cmb_txt_error');
                            var dataString = 'set=combo_pack_menu_add&combo_menuid='+combo_menu_id+"&combo_id="+combo_id+"&combo_pack_id="+combo_pack_id+"&menu_sale_type="+menu_sale_type+"&menu_option_label="+menu_option_label+"&menu_combo_qty="+menu_combo_qty+"&combo_pack_menu_entry_id="+combo_pack_menu_entry_id;
                             $.ajax({
                                 type: "POST",
                                 url: "combo-add.php",
                                 data: dataString,
                                 success: function(data) {
                                    data=data.split("@@@");
                                    if(data[1]=='Menu Already Added...'){
                                        $('#search_menu_combo').val('');
                                        $('#search_menu_combo').focus();
                                        $('#search_menu_combo').addClass('cmb_txt_error');
                                        $('#combo_pack_alert_span').css('display','block');
                                        $('#combo_pack_alert_span').text(data[1]);
                                        $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                                        return false;
                                    }else{
                                        $('#search_menu_combo').val('');
                                        $('#combo_pack_menuqty').val('');
                                        $('#menu_sale_type').val('');
                                        $('#menu_option_label').val('');
                                    
                                        $('#search_menu_combo').focus();
                                        $('#combo_pack_alert_span').css('display','block');
                                        $('#combo_pack_alert_span').text(data[1]);
                                        $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                                        location.reload();
                                    }
                                    }
                             });    
                                
                    }   
    });
    $('#menu_label_add_btn').click(function(){
        var menu_label=$('#menu_label_add_feild').val();
        
        if(menu_label==''){
            $('#menu_label_add_feild').focus();
            $('#menu_label_add_feild').addClass('cmb_txt_error');
            $('#label_alert_span').css('display','block');
            $('#label_alert_span').text('Please Add Label..');
            $('#label_alert_span').delay(2000).fadeOut('slow');
            return false;
        }else{
            $('#menu_label_add_feild').removeClass('cmb_txt_error');
            
            var dataString = 'set=menu_label_add&menu_label='+menu_label;
            $.ajax({
                type: "POST",
                url: "combo-add.php",
                data: dataString,
                success: function(data) {
                    data=data.split("@@@");
                    $('#menu_label_add_feild').val('');
                    $('#menu_label_add_feild').focus();
                    $('#label_alert_span').css('display','block');
                    $('#label_alert_span').text(data[1]);
                    $('#label_alert_span').delay(2000).fadeOut('slow');
                    var dataString = 'set=menu_label_load';
                    $.ajax({
                        type: "POST",
                        url: "combo_add_menuload.php",
                        data: dataString,
                        success: function(data) {
                           $('#label_table_data').html(data); 
                        }
                    });
                }
            });    
        }
    });
    
    $('#menu_sale_type').change(function(){
        if($('#menu_sale_type').val()=='Fixed'){
            $('#menu_option_label').val('');
            $('#menu_option_label').prop('disabled',true);
            $('#label_add_popup_call').css('pointer-events','none');
        }
        else{
            $('#menu_option_label').prop('disabled',false);
            $('#label_add_popup_call').css('pointer-events','inherit');
        }
    });
    
    $("#search_menu_combo").autocomplete({
                          
                            minLength: 0,
                            source:"combo_add_menuload.php?set=searchnameonly",
                             
                            focus: function (event, ui) {
                               
                                $("#search_menu_combo").val(ui.item.label2);
                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
                               
                                return false;
                            },
                            select: function (event, ui) {

                                $("#valueofsearch_menu").val(ui.item.id);
                                var menunames = $("#valueofsearch_menu").val();
                                
                                data = null;
                                return false;
                            }
                            
                        });
    $("#search_menu_combo").change(function(){
        
        if($("#search_menu_combo").val()==''){
            $("#valueofsearch_menu").val('');
        }
     }); 
    $('#label_add_popup_call').click(function(){
            $('.md-overlay').css('display','block');
            $('.label_add_popup').addClass('md-show');
     });
    $('#label_add_popup_close').click(function(){
            $('.md-overlay').css('display','none');
            $('.label_add_popup').removeClass('md-show');
            var dataString = 'set=option_div_refresh';
            $.ajax({
                type: "POST",
                url: "combo_add_menuload.php",
                data: dataString,
                success: function(data) {

                    $('#menu_option_label').html(data);
                    
                    }   

                });
     });
    
    $('#rate_popup_close').click(function(){
        $('.new_overlay').css('display','none');
        $('#combo_rate_popup').css('display','none');
    });

    $('.combo_pack_rate_add').click(function(){
        $('.new_overlay').css('display','block');
        $('#combo_rate_popup').css('display','block');
        var combo_name=$('#combo_name_pack_add').text();
        $('#combo_name_rate_add').text(combo_name);
        var combo_pack_name=$(this).attr('combo_pack_name');
        var combo_pack_id=$(this).attr('combo_pack_id');
        $('.comb_pack_name_display').text(combo_pack_name);
        $('#comb_pack_id_display').val(combo_pack_id);
        var dataString = 'set=combo_pack_rate_addpopup&combo_pack_id='+combo_pack_id+'&mode=DI';
        $.ajax({
            type: "POST",
            url: "combo_add_menuload.php",
            data: dataString,
            success: function(data) {
                $('.tab_content').html(data);
                 $('#floor_selection_span').css('display','block');
            }   
        });
        
    
    });
    
    
});
function label_delete(labelid){
       
      var label_id=labelid;
      var dataString = 'set=menu_label_delete&label_id='+label_id;
                    $.ajax({
                        type: "POST",
                        url: "combo-add.php",
                        data: dataString,
                        success: function(data) {
                            data=data.split("@@@");
                            $('#menu_label_add_feild').val('');
                            $('#menu_label_add_feild').focus();
                            $('#label_alert_span').css('display','block');
                            $('#label_alert_span').text(data[1]);
                            $('#label_alert_span').delay(2000).fadeOut('slow');
                            var dataString = 'set=menu_label_load';
                            $.ajax({
                                type: "POST",
                                url: "combo_add_menuload.php",
                                data: dataString,
                                success: function(data) {
                                   $('#label_table_data').html(data); 
                                }
                            });
                        }
                    });
    };
function combo_menu_delete(menu_delete_id){
        var menu_delete_id=menu_delete_id;
        var dataString = 'set=combo_menu_delete&combo_menu_delete_id='+menu_delete_id;
                    $.ajax({
                        type: "POST",
                        url: "combo-add.php",
                        data: dataString,
                        success: function(data) {
                            
                            data=data.split("@@@");
                            $('#search_menu_combo').val('');
                            $('#search_menu_combo').focus();
                            $('#combo_pack_alert_span').css('display','block');
                            $('#combo_pack_alert_span').text(data[1]);
                            $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                            
                        }
                    });
        
    };
function combo_menu_edit(menu_edit_id){
    $('#compo_pack_menu_add').text('UPDATE');
    $('#combo_pack_menu_entry_id').val(menu_edit_id);
    var combo_menu=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_column').text();
    var combo_menu_id=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_column').attr('id');
    var combo_menu_type=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_type_column').text();
    var combo_menu_option=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_option_column').text();
    var combo_menu_option_id=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_option_column').attr('id');
    var combo_menu_qty=$("#each_menu_row_"+menu_edit_id).find('.combo_menu_qty_column').text();
//    alert(combo_menu);
//    alert(combo_menu_id);
//    alert(combo_menu_type);
//    alert(combo_menu_option);
//    alert(combo_menu_qty);
    $('#search_menu_combo').val(combo_menu);
    $('#valueofsearch_menu').val(combo_menu_id);
    if(combo_menu_qty!='' && combo_menu_qty>0 ){
        $('#combo_pack_menuqty').val(combo_menu_qty);
    }
    if(combo_menu_type!=''){
        $('#menu_sale_type').val(combo_menu_type);
        if(combo_menu_type=='Fixed'){
            
            $('#menu_option_label').val('');
            $('#menu_option_label').prop('disabled',true);
            $('#label_add_popup_call').css('pointer-events','none');
            
        }
        else{
            $('#menu_option_label').prop('disabled',false);
            $('#label_add_popup_call').css('pointer-events','inherit');
            $('#menu_option_label').val(combo_menu_option_id);
        }
    }
};
function combo_menu_status_change(status_to,combo_pack_menu_entry_id){
    
    var dataString = 'set=combo_menu_status_change&combo_pack_menu_entry_id='+combo_pack_menu_entry_id+"&status_to="+status_to;
    $.ajax({
        type: "POST",
        url: "combo-add.php",
        data: dataString,
        success: function(data) {
            data=data.split("@@@");
            $('#combo_pack_alert_span').css('display','block');
            $('#combo_pack_alert_span').text(data[1]);
            $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
        }
    });
};
function departmentselect(department){ 
    
    
    
     $('#dineinfloor').val('');
    $('#dineinrate').val('');
    var combo_pack_id=$('#comb_pack_id_display').val();
    var dataString = 'set=combo_pack_rate_addpopup&combo_pack_id='+combo_pack_id+'&mode='+department;
        $.ajax({
            type: "POST",
            url: "combo_add_menuload.php",
            data: dataString,
            success: function(data) { 
                $('.tab_content').html(data);
                 //$('#floor_selection_span').css('display','block');
            }   
        });
    $('.departments_selection>li').each(function(){
        
        if($(this).attr('id1')==department){
            
            $('.departments_selection>li').removeClass('current');
            $(this).addClass('current');
            
            
        }
    });
}
function rate_add(){
    
      var combo_pack_id=$('#comb_pack_id_display').val();
      var combo_pack_rate_id=$('#comb_pack_rate_id_display').val();
      //alert(combo_pack_rate_id);
      var combo_id=$('#combo_id_field').val();
      var floor_id=$('#dineinfloor').val();
      var combo_rate=$('#dineinrate').val();
      var apply_all=$('#apply_all').is(':checked');
      var online=$('#ta_online').val();
      
      var department;
      $('.departments_selection>li').each(function(){
          
        if($(this).hasClass('current')){
           department=$(this).attr('id1');  
        }  
      });
      
      
      if(floor_id=='' && department=='DI' && apply_all==false ){
                $('#dineinfloor').focus();
                $('#dineinfloor').addClass('cmb_txt_error');
//                $('#combo_pack_alert_span').css('display','block');
//                $('#combo_pack_alert_span').text('Please Add Combo Pack..');
//                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                return false;
      }else if(online=='' && department=='TA' && apply_all==false ){
                $('#ta_online').focus();
                $('#ta_online').addClass('cmb_txt_error');
//                $('#combo_pack_alert_span').css('display','block');
//                $('#combo_pack_alert_span').text('Please Add Combo Pack..');
//                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                return false;
      }else{
          $('#ta_online').removeClass('cmb_txt_error');
           $('#dineinfloor').removeClass('cmb_txt_error');
          if(combo_rate<=0 ||combo_rate==''){
             
              $('#dineinrate').focus();
                $('#dineinrate').addClass('cmb_txt_error');
//                $('#combo_pack_alert_span').css('display','block');
//                $('#combo_pack_alert_span').text('Please Add Combo Pack..');
//                $('#combo_pack_alert_span').delay(2000).fadeOut('slow');
                return false;
          }
          else{
                $('#dineinrate').removeClass('cmb_txt_error');
                var dataString = 'set=combo_rate_add&combo_id='+combo_id+"&combo_pack_id="+combo_pack_id+"&floor_id="+floor_id+"&department="+department+"&combo_rate="+combo_rate+"&combo_pack_rate_id="+combo_pack_rate_id+'&apply_all='+apply_all+"&online="+online;
                $.ajax({
                    type: "POST",
                    url: "combo-add.php",
                    data: dataString,
                    success: function(data) {
                        data=data.split("@@@");
                        $('#dineinfloor').val('');
                        $('#dineinfloor').prop('disabled',false);
                        $('#dineinrate').val('');
                        var dataString = 'set=combo_pack_rate_addpopup&combo_pack_id='+combo_pack_id+'&mode='+department;
                        $.ajax({
                            type: "POST",
                            url: "combo_add_menuload.php",
                            data: dataString,
                            success: function(data) {
                                $('.tab_content').html(data);
                                 //$('#floor_selection_span').css('display','block');
                            }   
                        });
                        $('.departments_selection>li').each(function(){
                            if($(this).attr('id1')==department){
                                $('.departments_selection>li').removeClass('current');
                                $(this).addClass('current');
                                

                            }
                        });
                        $('#status').css('display','block');
                        $('#status').text(data[1]);
                       // $('#status').delay(2000).fadeOut('slow');
                    }
                });
          }
      }
      
    };
function delete_combo_rate(combo_pack_rate_id){
        var combo_pack_id=$('#comb_pack_id_display').val();
        var combo_id=$('#combo_id_field').val();
        var department;
        $('.departments_selection>li').each(function(){

          if($(this).hasClass('current')){
             department=$(this).attr('id1');  
          }  
        }); 
        var dataString = 'set=combo_pack_rate_delete&combo_pack_rate_id='+combo_pack_rate_id;
        $.ajax({
            type: "POST",
            url: "combo-add.php",
            data: dataString,
            success: function(data) {
                data=data.split("@@@");
                $('#dineinfloor').val('');
                $('#dineinrate').val('');
                var dataString = 'set=combo_pack_rate_addpopup&combo_pack_id='+combo_pack_id+'&mode='+department;
                $.ajax({
                    type: "POST",
                    url: "combo_add_menuload.php",
                    data: dataString,
                    success: function(data) {
                        $('.tab_content').html(data);
                    //$('#floor_selection_span').css('display','block');
                    }   
                });
            }
        });
};
function edit_combo_rate(combo_pack_rate_id,combo_pack_rate,combo_floor_id,online_id_combo){
//        alert(combo_pack_rate_id);
        //alert(combo_pack_rate);
//        alert(combo_floor_id);
        $('#apply_all_span').css('display','none');
        $('#rate_add_btn').text('UPDATE');
        $('#comb_pack_rate_id_display').val(combo_pack_rate_id);
        $('#dineinfloor').val(combo_floor_id);
         $('#dineinfloor').prop('disabled',true);
         $('#ta_online').val(online_id_combo);
         $('#ta_online').prop('disabled',true);
        $('#dineinrate').val(combo_pack_rate);
         
        
}; 