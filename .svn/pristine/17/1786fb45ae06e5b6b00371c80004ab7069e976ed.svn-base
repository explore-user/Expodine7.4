$(document).ready(function(){
    $('#combo_name').val('');
    $('#combo_type').val('');
    //$('#combo_add_btn').text('ADD');
    $('#combo_add_btn').click(function(){
        add_combo();
        
    });
    
    function add_combo()
    {
        if($('#combo_name').val()!=''){
            
            $('#combo_name').removeClass('cmb_txt_error');
            var combo_name=$('#combo_name').val();
            
            if($('#combo_type').val()!=''){
                
                $('#combo_type').removeClass('cmb_txt_error');
                var combo_type=$('#combo_type').val();
                document.combo_name.submit();
            }
            else{
                $('#combo_type').addClass('cmb_txt_error');
                $('#combo_alert_span').css('display','block');
                $('#combo_alert_span').text('Please Select Combo Type..');
                $('#combo_alert_span').delay(2000).fadeOut('slow');
                return false;
            }
        }
        else{
           $('#combo_name').addClass('cmb_txt_error');
           $('#combo_alert_span').css('display','block');
           $('#combo_alert_span').text('Please Add Combo Name..');
           $('#combo_alert_span').delay(2000).fadeOut('slow');
           return false;
        }
    }
    $('.combo_name_edit').click(function(){
        var combo_id=$(this).attr('id');
        var combo_name=$('#combo_name'+combo_id).text();
        //var combo_status=$('#combo_status'+combo_id).attr('id1');
        var combo_type=$('#combo_type'+combo_id).attr('id1');
         $('#combo_add_btn').text('UPDATE');
        $('#combo_edit_id1').val(combo_id);
        $('#combo_name').val(combo_name);
        $('#combo_type').val(combo_type);
        $('#combo_type').prop('disabled',true);
        //$('#combo_status').val(combo_status);
           $('#combo_name').focus();

    });
    $('.pack_add_btn').click(function(){
        var combo_id=$(this).attr('id');
        var combo_name=$('#combo_name'+combo_id).text();
        var combo_status=$('#combo_status'+combo_id).text();
        var combo_type=$('#combo_type'+combo_id).attr('id1');
        localStorage.combo_type=combo_type;
        localStorage.firstload='Y';
        
        
       window.location="combo-add.php?set=combodetails&combo_id="+combo_id+"&combo_name="+combo_name+"&combo_type="+combo_type;
        
    });
    $('.combo_status_change').click(function(){
        var combo_id=$(this).attr('id1');
        var status_to=$(this).attr('status_to');
        var dataString = 'set=combo_name_status_change&combo_id='+combo_id+"&status_to="+status_to;
        $.ajax({
            type: "POST",
            url: "combo.php",
            data: dataString,
            success: function(data) {
//                data=data.split("@@@");
//                $('#combo_alert_span').css('display','block');
//                $('#combo_alert_span').text(data[1]);
//                $('#combo_alert_span').delay(2000).fadeOut('slow');


                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('STATUS CHANGED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                          setInterval(function () {
                     location.reload();
                }, 500);

            }
        });
        
    });
    $('.combo_stock_check').click(function(){
        var stock_check=$(this).attr('stock_check');
        var combo_id=$(this).attr('id1');
        
        var dataString = 'set=stock_check_change&combo_id='+combo_id+"&stock_check="+stock_check;
        $.ajax({
            type: "POST",
            url: "combo.php",
            data: dataString,
            success: function(data) {
                data=data.split("@@@");
                $('#combo_alert_span').css('display','block');
                $('#combo_alert_span').text(data[1]);
                $('#combo_alert_span').delay(2000).fadeOut('slow');
            }
        });
        
    });
});

function combo_name_delete(combo_id){
    
    
    $('.combo_delete_pop_new').show();
    
     $('.combo_delete_pop_new').attr('combo_id',combo_id);

}

function delete_combo_new(){
    
    var combo_id= $('.combo_delete_pop_new').attr('combo_id');
    
            var dataString = 'set=combo_name_delete&combo_id='+combo_id;
                    $.ajax({
                        type: "POST",
                        url: "combo.php",
                        data: dataString,
                        success: function(data1) {
                            
//                            data1=data1.split("@@@");
//                            
//                            $('#combo_alert_span').css('display','block');
//                            $('#combo_alert_span').text(data1[1]);
//                            $('#combo_alert_span').delay(2000).fadeOut('slow');
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('COMBO DELETED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                          setInterval(function () {
                     location.reload();
                }, 500);
                        
                        }
                    });
                    
}