$(document).ready(function(){ 
  var combo_stock_check=$('#combo_stock_check').val();
  localStorage.adding_click_count=0;
  
  
    //$('#combo_qty_select').addClass('focused');
    $('#combo_qty_select').focus();
    if($('#combo_type').val()=='1'){
        $('.qty_minus_btn').show();
        $('.qty_plus_btn').show();
        $('.menu_selection_check:first').prop('checked',true);
        $('.menu_selection_check').prop('disabled',true);
        $('.menu_qty_display').prop('disabled',true);
        $('.menu_qty_display:first').val($('#combo_pack_max_qty').val());
       
        
    }else{
       $('.menu_qty_display').prop('readonly',true);
       $('.checkmark_fixed_menu').hide();
      
    }
    
    $('.option_header').each(function(){
       $('.option_'+$(this).text()+':first').prop('checked',true);
    });
    $('.option_checkboxes').click(function(){
        var label_name=$(this).attr('label_name');
        $('.option_'+label_name).prop('checked',false);
        $(this).prop('checked',true);
    });
    $('#combo_pop_close').click(function(){
        $("#combo_ordering_popup").empty();
        $("#combo_ordering_popup").css('display','none');
        //$(".combo-popup-cc").hide();
    });
    
    $('.combo_caclulator_btn').click(function(){
        var click_val=$(this).text();
        var combo_qty_old=$('#combo_qty_select').val();
        if(combo_qty_old==''){
          combo_qty_old=0;  
        }
            localStorage.stock_val=parseFloat($('#stock_show').text())+parseFloat(combo_qty_old);
            
            var combo_qty=$('#combo_qty_select').val();
            if($.isNumeric(click_val) && combo_qty.length<3){
                if(combo_qty=='' ||combo_qty==0){
                    $('#combo_qty_select').val(click_val);
                    $('#combo_qty_select').focus();
                }
                else{
                    $('#combo_qty_select').removeClass('focused');
                    $('#combo_qty_select').val($('#combo_qty_select').val()+click_val);
                    $('#combo_qty_select').focus();
                }
                if(combo_stock_check=='Y'){
                    if(parseFloat(localStorage.stock_val)>=parseFloat($('#combo_qty_select').val())){
                        
                        var qty_left=parseFloat(localStorage.stock_val)-parseFloat($('#combo_qty_select').val())
                        $('#stock_show').text(qty_left);
                    }
                    else{
                                                  
                        var qty_last_digit_removed = $('#combo_qty_select').val().substring(0,$('#combo_qty_select').val().length-1);
                        $('#combo_qty_select').val(qty_last_digit_removed);
                        $('#combo_qty_select').addClass('focused');
                        $('.popup_validate').show();
                        $('.popup_validate_alert').text('Please Check Qty Left...');
                        $('#combo_qty_select').focus();
                        
                        setTimeout(function(){
                            $('.popup_validate').hide(); }, 2000);
                    }
                }
            }
            else{
                $('#combo_qty_select').addClass('focused');
                $('.popup_validate').show();
                $('.popup_validate_alert').text('Check Qty...');
                $('#combo_qty_select').focus();
                setTimeout(function(){
                    $('.popup_validate').hide(); }, 2000);
            }
            
    });
    $('#combo_clear_calc').click(function(){
            var combo_qty_old=$('#combo_qty_select').val();
            if(combo_qty_old==''){
              combo_qty_old=0;  
            }
            localStorage.stock_val=parseFloat($('#stock_show').text())+parseFloat(combo_qty_old);
            $('#combo_qty_select').val('');
            $('#stock_show').text(localStorage.stock_val);
            $('#combo_qty_select').focus();
        
    });
    $('.qty_plus_btn').click(function(){
        var total_pack_qty=0;
         var max_possible_qty=$('#combo_pack_max_qty').val();
       
        $('.menu_qty_display').each(function(){
             total_pack_qty+=parseFloat($(this).val());
         }); 
         //alert(max_possible_qty);
         //alert(total_pack_qty);
        if(parseFloat(max_possible_qty)>parseFloat(total_pack_qty)){
            
            var menu_old_qty=$('#menu_qty_display_'+$(this).attr('count')).val();
            
            $('#menu_qty_display_'+$(this).attr('count')).val(parseFloat($('#menu_qty_display_'+$(this).attr('count')).val())+parseFloat(1));
            if(parseFloat($('#menu_qty_display_'+$(this).attr('count')).val())>parseFloat(0)){
                
                $('#menu_selection_check_'+$(this).attr('count')).prop('checked',true);
            }
        }
        else{
            $('.popup_validate').show();
            $('.popup_validate_alert').text('Menu Qty Reached Max...');
            $('#combo_qty_select').focus();
            setTimeout(function(){
                $('.popup_validate').hide(); }, 2000);
            }
                
    });
    $('.qty_minus_btn').click(function(){
           var menu_old_qty=$('#menu_qty_display_'+$(this).attr('count')).val();
            if(parseFloat(menu_old_qty)==parseFloat(0)){
                $('#menu_selection_check_'+$(this).attr('count')).prop('checked',false);
            }
            if(parseFloat(menu_old_qty)>parseFloat(0)){
                $('#menu_qty_display_'+$(this).attr('count')).val(parseFloat($('#menu_qty_display_'+$(this).attr('count')).val())-parseFloat(1));
            };
            //alert(parseFloat($('#menu_qty_display_'+$(this).attr('count')).val()));
            if(parseFloat($('#menu_qty_display_'+$(this).attr('count')).val())==parseFloat(0)){
                $('#menu_selection_check_'+$(this).attr('count')).prop('checked',false);
            }
    });

    
    
    $('#combo_add_btn').click(function(){
        
        var combo_adding_id=$('#combo_adding_id').val();
        var combo_pack_adding_id=$('#combo_pack_adding_id').val();
        var combo_qty=$('#combo_qty_select').val();
        var combo_pack_rate=$('#combo_pack_rate').val();
        var combo_pack_preference=$('#manual_preference').val();
        var combo_menu_array=new Array();
        var stock_left=0;
       
        if(combo_stock_check=='Y'){
            stock_left=parseFloat(localStorage.stock_val)-parseFloat(combo_qty);
        }
        
       
        if(combo_pack_rate<=0){
            $('.popup_validate').show();
            $('.popup_validate_alert').text('Pack rate is 0 ');
            $('.menu_qty_display:first').addClass('focused');
            setTimeout(function(){
                $('.popup_validate').hide(); }, 2000);
                return false;
        }
        else{
            if(combo_qty=='' ||combo_qty==0){
                $('#combo_qty_select').addClass('focused');
                $('.popup_validate').show();
                $('.popup_validate_alert').text('Check Qty...');
                $('#combo_qty_select').focus();
                setTimeout(function(){
                    $('.popup_validate').hide(); }, 2000);
                return false;
            }
            else{  
                     $('#combo_qty_select').removeClass('focused');
                    if($('#combo_type').val()=='1'){
                        var max_possible_qty=$('#combo_pack_max_qty').val();
                        var total_pack_qty=0;
                        $('.menu_qty_display').each(function(){
                            total_pack_qty+=parseFloat($(this).val());
                        });
                        if(parseFloat(max_possible_qty)>parseFloat(total_pack_qty)){
                            $('.popup_validate').show();
                            $('.popup_validate_alert').text('Menu Qty Mismatch...');
                            $('.menu_qty_display:first').addClass('focused');
                            setTimeout(function(){
                                $('.popup_validate').hide(); }, 2000);
                            return false;
                        }else{
                            $('.menu_qty_display:first').removeClass('focused');
                            $('.fixed_combo_menus').each(function(){
                                //alert($(this).find('.menu_selection_check').is(':checked'));
                                if($(this).find('.menu_selection_check').is(':checked')==true){
    //                                alert($(this).find('.menu_selection_check').is(':checked'));
    //                                alert($(this).find('.menu_selection_check').attr('value1'));
    //                                alert($(this).find('.menu_qty_display').val());
                                        combo_menu_array.push({
                                            combo_adding_id:combo_adding_id,
                                            combo_pack_adding_id:combo_pack_adding_id,
                                            combo_qty:combo_qty,
                                            combo_pack_rate:combo_pack_rate,
                                            combo_menu_id:$(this).find('.menu_selection_check').attr('value1'),
                                            combo_each_menu_qty: $(this).find('.menu_qty_display').val(),
                                            combo_pack_preference:combo_pack_preference
                                            
                                            

                                    });
                                }
                            });
                            }
                        }
                        else {
                            $('.fixed_combo_menus').each(function(){

                                        combo_menu_array.push({
                                            combo_adding_id:combo_adding_id,
                                            combo_pack_adding_id:combo_pack_adding_id,
                                            combo_qty:combo_qty,
                                            combo_pack_rate:combo_pack_rate,
                                            combo_menu_id:$(this).find('.menu_selection_check').attr('value1'),
                                            combo_each_menu_qty: $(this).find('.menu_qty_display').val(),
                                            combo_pack_preference:combo_pack_preference
                                            
                                            

                                    });

                            });
                            if($('#combo_type').val()=='3'){
                                $('.option_combo_menus').each(function(){
                                    if($(this).find('.option_checkboxes').is(':checked')==true){
                                        combo_menu_array.push({
                                            combo_adding_id:combo_adding_id,
                                            combo_pack_adding_id:combo_pack_adding_id,
                                            combo_qty:combo_qty,
                                            combo_pack_rate:combo_pack_rate,
                                            combo_menu_id:$(this).find('.option_checkboxes').attr('value1'),
                                            combo_each_menu_qty: $(this).find('.option_menu_qty_display').val(),
                                            combo_pack_preference:combo_pack_preference
                                            
                                            

                                        });
                                    }
                                });
                            }
                        }
                            var combo_menu_jsonstring=JSON.stringify(combo_menu_array);
                            //alert(steward);
                            localStorage.adding_click_count+=1;
                            $('#combo_add_btn').css('pointer-events', 'none');
                            $("#combo_ordering_popup").html('<img class="combo_image_load" src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
                            var dataString = "value=combo_adding&combo_menu_details="+combo_menu_jsonstring+"&cod_count_combo_ordering="+localStorage.cod_count_combo_ordering+"&combo_stock_check="+combo_stock_check+"&stock_left="+stock_left;
                            $.ajax({
                                type: "POST",
                                url: "load_counter_sales.php",
                                data: dataString,
                                success: function(data) {
                                    //alert(data);
                                    $("#combo_ordering_popup").css('display','none');
                                    
                                    var dataString1 = 'value=loaditemsorderd';
                                    var request=  $.ajax({
                                        type: "POST",
					url: "load_counter_sales.php",
					data: dataString1,
					success: function(data) {
                                            
                                            $('.listorderditems').html(data);//alert(typesub);
                                            var coutrgen=$('#counter_gen').val();
								var coutrstafgen=$('#counter_staff_gen').val();//alert(coutrgen+coutrstafgen)
								if(coutrgen=='Y' && coutrstafgen=='Y')
								{
								$('.genonly').css("display","block");
								}
								$('.gensettl').css("display","block");
								var coutrhld=$('#counter_hold').val();
								var coutrstafhld=$('#counter_staff_hold').val();
								if(coutrhld=='Y' && coutrstafhld=='Y')
								{
								$('.holdorders').css("display","block");
								}
                                        }
                                    });    
                                    return true;
                                }
                            });


            }
        } 
            
    });    
    $('#combo_qty_select').keydown(function(e){
       
        if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105)|| e.keyCode==8) { 
              
            var click_val='';
            var combo_qty_old=$('#combo_qty_select').val();
            if(combo_qty_old==''){
              combo_qty_old=0;  
            }
            localStorage.stock_val=parseFloat($('#stock_show').text())+parseFloat(combo_qty_old);
            if(e.keyCode!=8){
                if(e.keyCode>95){
                    e.keyCode-=48;
                }
                click_val=String.fromCharCode(e.keyCode);
                var combo_qty=$('#combo_qty_select').val()+click_val;
                if($('#combo_qty_select').val()==0){
                    $('#combo_qty_select').val('');
                }
           
            }else{
                var combo_qty=$('#combo_qty_select').val().substring(0,$('#combo_qty_select').val().length-1);
                
            }
            
            if(($.isNumeric(click_val) && combo_qty.length<4) ||e.keyCode==8){
                if(combo_qty==''){
                   combo_qty=0; 
                }
               
                if(combo_stock_check=='Y'){
                    if(parseFloat(localStorage.stock_val)>=parseFloat(combo_qty)){
                        
                        var qty_left=parseFloat(localStorage.stock_val)-parseFloat(combo_qty)
                        //alert(qty_left);
                        $('#stock_show').text(qty_left);
                        
                    }
                    else{
                                                  
                        var qty_last_digit_removed = combo_qty.substring(0,combo_qty.length-1);
                         
                        $('#combo_qty_select').val(qty_last_digit_removed);
                        $('#combo_qty_select').addClass('focused');
                        $('.popup_validate').show();
                        $('.popup_validate_alert').text('Please Check Qty Left...');
                        $('#combo_qty_select').focus();
                        
                        setTimeout(function(){
                            $('.popup_validate').hide(); }, 2000);
                        return false;
                    }
                }
            }
        
            else{
                
                $('#combo_qty_select').addClass('focused');
                $('.popup_validate').show();
                $('.popup_validate_alert').text('Check Qty...');
                $('#combo_qty_select').focus();
                setTimeout(function(){
                    $('.popup_validate').hide(); }, 2000);
                 return false;
            }
        }   
    });
    $('.accordion-header').click(function () {
      // arrow animation on click
      var div_id=$(this).attr('id');
      
        if($(this).children('.arrow').hasClass('active')){
            $('.accordion-header').children('.arrow').removeClass('active');
            $('.accordion-body').slideUp('fast').removeClass('active');
        }else{
            $('.accordion-header').children('.arrow').removeClass('active');
            $('.accordion-body').slideUp('fast').removeClass('active');
            $(this).children('.arrow').addClass('active');
            $('.'+div_id).slideDown('fast').addClass('active');
        }
     // $(this).parent().siblings().children('.accordion-body').slideUp('fast');
     });
});
$(document).keyup(function(e){
    if(e.keyCode==13 && localStorage.adding_click_count==0)
    {
      $('#combo_add_btn').click();
      $('#combo_add_btn').css('pointer-events', 'none');
    }
    
});
