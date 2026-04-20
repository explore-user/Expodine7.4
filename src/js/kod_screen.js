
$(document).ready(function(){
	
	
  $('.swichkitchen').click(function () { 
              
	   var title=$(this).attr('title');
	   var screentyp=$('#screentype').val();
           var seltd=$('#countrseltd').val();
           var mode=$('#mode').val();
           var processcount=$('.kod_item_pend_count').html();
	
	  if ($(this).hasClass('table_floor_select_btn_act'))
			  {
				  if(title!="ALL")
				  {
					  $('.swichkitchen').filter('[title="ALL"]').removeClass('table_floor_select_btn_act');
				  }
				  $(this).removeClass('table_floor_select_btn_act');
			  }else
			  {
				  if(title=="ALL")
				  {
					  $('.swichkitchen').removeClass('table_floor_select_btn_act');
				  }else
				  {
					  $('.swichkitchen').filter('[title="ALL"]').removeClass('table_floor_select_btn_act');
				  }
				  $(this).addClass('table_floor_select_btn_act');
			  }
                          
		  var selected_activities =$('.table_floor_select_btn_act');
		  var ids = new Array();
		  selected_activities.each(function(){
                      
			  var id_str       =  $(this).attr("title");
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
			  }
			  
		  });
                 
		  if(screentyp=="screen_multi")
		  {
		   $('.load_colum_dinein').load('load_kod_screen.php?value=loadkodscreen&set=dine&counter='+ids);
		   $('.load_colum_takeaway').load('load_kod_screen.php?value=loadkodscreen&set=ta&counter='+ids);	
                   
		  }else if(screentyp=="screen_single")
		  {
			var setnm=$('#setname').val();
 			$('#columns').load('load_kod_screen.php?value=loadkodscreen&set='+setnm+'&counter='+ids);
		  }
	               $('#kod_top_notification').load('load_kod_notification_refresh.php?mode='+mode+'&processcount='+processcount+'&kotcounters='+ids)
	  
		});
                

$(".kod_item_details_popup_close").click(function(){
    
   $(".kod_item_details_popup").css("display","none");
});       
     
     
     
 $('.chekbx').click(function(){
     
     
      if(document.getElementById("chekbx").checked == true){ 
          
                 $('.popup_menudisplay').addClass('kod_popup_table_tr_act');
     
       }else{
            
                $('.popup_menudisplay').removeClass('kod_popup_table_tr_act');
        }
   
 });  
 
 
 $('.ready').click(function(){
         
          var title_value=$('.table_floor_select_btn_act').attr('title');
          var mode_load=$('#mode').val();
           
          var arr = new Array();
          var status= new Array();
          var combo_entry=new Array();
          
          var slno=new Array();
          var popkot= $('#popkotno').val();
          var popbill=$('#popbillno').val();
           
           $('.kod_popup_table_tr_act').each(function(){
               
             combo_entry.push($(this).attr('combo_entry'));
             var mm=$(this).find("#itemmenus").html();
             var mid=$(this).find('.menuid').val();
             arr.push(mid);

              var slnonew=$(this).find('#slno').val();
              slno.push(slnonew);
              var sta=$(this).find('.status').val();
              status.push(sta);
            
         });
        
      var menuid=arr.join(",");
      var status1=status.join(",");
      var slno1=slno.join(",");
      combo_entry=combo_entry.join(",");
     
       var datastring = 'kotnumber='+popkot+'&menuid='+menuid+'&billno='+popbill+'&status1='+status1+'&slno='+slno1+'&combo_entry='+combo_entry;
       $.ajax({
                type: "POST",
                url: "kod_menu_poppup.php",
                data: datastring,
                success: function (data)
                {
                 window.location.href='kod_screen.php?mode='+mode_load+'&title_value='+title_value;
                }
            });
            $('.popup_menudisplay').removeClass('kod_popup_table_tr_act'); 
            document.getElementById("chekbx").checked == false;
         $(".kod_item_details_popup").css("display","none");
      });   
      
      
  $('.served').click(function(){
          
          
         var title_value=$('.table_floor_select_btn_act').attr('title');
         var mode_load=$('#mode').val();
         
         var arr = new Array();
         var status= new Array();
         var combo_entry=new Array();
        
         var slno=new Array();
         var popkot= $('#popkotno').val();
         var popbill=$('#popbillno').val();
        
         $('.kod_popup_table_tr_act').each(function(){
             
            combo_entry.push($(this).attr('combo_entry'));
            var mm=$(this).find("#itemmenus").html();
            var mid=$(this).find('.menuid').val();
             
            arr.push(mid);
            var slnonew=$(this).find('#slno').val();
             
            slno.push(slnonew);
            var sta=$(this).find('.status').val();
            status.push(sta);
            
            
         });
        
          var slno1=slno.join(",");
         
          combo_entry=combo_entry.join(",");
          var menuid=arr.join(",");
          var status1=status.join(",");
     
        var datastring = 'kotnumber1='+popkot+'&menuid1='+menuid+'&billno1='+popbill+"&status="+status1+'&slno='+slno1+'&combo_entry='+combo_entry;
        $.ajax({
                type: "POST",
                url: "kod_menu_poppup.php",
                data: datastring,
                success: function (data)
                {
                  window.location.href='kod_screen.php?mode='+mode_load+'&title_value='+title_value;
                }
            });
            
            $('.popup_menudisplay').removeClass('kod_popup_table_tr_act');
            document.getElementById("chekbx").checked == false;
            $(".kod_item_details_popup").css("display","none");
            
      });    
                     
	
});





 function popupactiveraw(a){
     
      if( $('#menu'+a).hasClass('kod_popup_table_tr_act')){
          
         $('#menu'+a).removeClass('kod_popup_table_tr_act');
         
     }else{
         
          $('#menu'+a).addClass('kod_popup_table_tr_act');
     
    }
    
    var i=0;
    $('.kod_popup_table_tr_act').each(function(){
       i++;
    });
 
    if(i==$("#menucount").val())
    {

        document.getElementById("chekbx").checked = true;
    }
    else 
    {

       document.getElementById("chekbx").checked = false;

    }

 
 }

  
    function popupfunction(a,b,c,d,e,f,g){
   
        $('#chekbx').attr('checked', false);
        
        var datastring = 'kotno='+a+'&date='+c+'&billno='+b+'&mode='+e+'&takeaway='+d+'&dinein='+f+'&kitchen='+g;
        $("#popupmenulists").html('');
        $.ajax({
                type: "POST",
                url: "kod_menu_poppup.php",
                data: datastring,
                success: function (data)
                { 
                     var arr = data.split("+");
                     var res=JSON.parse(arr[0]);
                     

                     $.each(res, function(i, record)
                    { 
                        var slno1=parseInt(i)+1;
                        var addon='';
                        
                        if(record.addon_slno){
                             addon='(AD)';
                        }
                         
                       if(record.status=='Ready')
                       {
                           
                           $("#popupmenulists").append('<tr class="popup_menudisplay" status="'+record.status+'" combo_entry="'+record.combo_entry+'" id="menu' + slno1 + '" onClick="return popupactiveraw('+slno1+')">'+
                           '<td width="10%" >'+slno1+'</td>'+
                           '<td width="63%">'+'<span style="color:red">'+addon+'</span> '+'<strong id="itemmenus">'+record.menuname+'<span style="color:red">('+record.por+')</span> '+'<img src="img/served-icon-1.png" style="float:right">'+'</strong>'+'</td>'+
                        
                            '<td width="14%" id="itemquant">'+record.qty+'</td>'+
                           '<input type="hidden" class="menuid" value="'+record.menuid+'">'+
                           '<input type="hidden" class="status" value="'+record.status+'">'+
                            '<input type="hidden" id="menucount" value="'+arr[1]+'">'+
                           '<input type="hidden" id="slno" value="'+record.slno+'" >'+
                            '</tr>');
                       }
                       else
                       { 
                           
                           $("#popupmenulists").append('<tr class="popup_menudisplay" combo_entry="'+record.combo_entry+'" id="menu' + slno1 + '" onClick="return popupactiveraw('+slno1+')">'+
                           '<td width="10%" >'+slno1+'</td>'+
                           '<td width="63%">'+'<span style="color:red">'+addon+'</span> '+'<strong id="itemmenus">'+record.menuname+'</strong>'+'<span style="color:red">('+record.por+')</span> '+'</td>'+
                     
                           '<td width="14%" id="itemquant">'+record.qty+'</td>'+
                           '<input type="hidden" class="menuid" value="'+record.menuid+'">'+
                           '<input type="hidden" class="status" value="'+record.status+'">'+
                             '<input type="hidden" id="menucount" value="'+arr[1]+'">'+
                            '<input type="hidden" id="slno" value="'+record.slno+'" >'+
                            '</tr>');
                       }
                       
                  
                   }); 
                   
                   if(b==""){
                       
                          $(".served").text("Served");
                          
                   }else if(b!=""){
                          
                           $(".served").text("Packed");   
                      }
                      
                       $('#popkotno').val(a);
                       $('#popbillno').val(b);
                    
                }
            });
            
    $(".kod_item_details_popup").css("display","block");
 
    $('.popup_menudisplay').removeClass('kod_popup_table_tr_act'); 
    
    document.getElementById("chekbx").checked == false;
   
    return true;
}
