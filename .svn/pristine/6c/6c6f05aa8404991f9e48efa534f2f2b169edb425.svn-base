// JavaScript Document
	/*****************************************  Search box change starts ******************************************************************  */
	function sortbyvalues(value)
	{
		$("#type").empty();
		var printvalue="";
		if(value=="new")
		{
			printvalue="NEW";
		}
		else if(value=="kot")
		{
			printvalue="KOT";
		}else if(value=="pending")
		{
			printvalue="PENDING DISH";
	
		}else if(value=="dine")
		{
			printvalue="DINE IN";
	
		}else if(value=="area")
		{
			printvalue="AREA";
	
		}else if(value=="est")
		{
			printvalue="ESTIMATE TIME";
	
		}
		 $.post("load_kot.php", {orderby:value,set:'setsortkot'},
			  function(data)
			  {
				  data=$.trim(data);
				  $('#boxscrol2').html(data);	
				  $('#type').text(printvalue);	
			 });	
	}
	/*****************************************  Search box change ends ******************************************************************  */
$(document).ready(function() {
	
	/*****************************************  Dropdown starts ******************************************************************  */
	$('#menu').fancySelect().on('change', function() {
					newSection = $('#' + $(this).val())

					if (newSection.hasClass('current')) {
						return;
					}

					$('section').removeClass('current');
					newSection.addClass('current');

					$('section:not(.current)').fadeOut(300, function() {
						newSection.fadeIn(300);
					});
				});
				$('#menu1').fancySelect().on('change', function() {
					newSection = $('#' + $(this).val())

					if (newSection.hasClass('current')) {
						return;
					}

					$('section').removeClass('current');
					newSection.addClass('current');

					$('section:not(.current)').fadeOut(300, function() {
						newSection.fadeIn(300);
					});
				});
	/*****************************************  Dropdown ends ******************************************************************  */
	
	/*****************************************  Check box all click starts ******************************************************************  */
	 $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { 
            $('.checkbox1').each(function() { 
                this.checked = true;  
            });
			$(".toserve").addClass("tr_color_3");
        }else{
            $('.checkbox1').each(function() {
                this.checked = false;  
            }); 
			$(".toserve").removeClass("tr_color_3");            
        }
    });
    
	/*****************************************  Check box all click ends ******************************************************************  */
	
	/*****************************************  kotserveditems starts ******************************************************************  */
	 $('#kotserveditems').click(function () {
             var kotmsg1 = ($("#kotmsg1").val());
			  var kotmsg3 = ($("#kotmsg3").val());
                          var combo_entry=new Array();
			var selected_activities =$('.tr_color_3');
			var kotvalues;
			var slvalues = new Array();
			selected_activities.each(function(){
                                combo_entry.push($(this).attr("combo_entry"));
				var kot   =  $(this).attr("kot");
                                var kotval	  =	 kot.split("_");
				var kotvalue       =  kotval[1];
				kotvalues=kotvalue;
				var sl   =  $(this).attr("slno");
				var slval	  =	 sl.split("_");
				var slvalue       =  slval[1];
				if(slvalue!='undefined' && slvalue!='' && slvalue!=null){
					slvalues.push(slvalue);
				}
			});
			if(slvalues!="")
			{
				$.post("load_div.php", {kot:kotvalues,slno:slvalues,combo_entry:combo_entry,set:'setkotserved'},
						function(data)
						{
							data=$.trim(data);
							$(".loaderror").css("display","block");
							$(".loaderror").addClass("popup_validate_kot");
							$(".loaderror").text(kotmsg1);
							$('.loaderror').delay(2000).fadeOut('slow');
							$('#setallkot').load('load_div.php?set=setmykot&kot='+kotvalues+'&nosl=0');
							$('#boxscrol2').load('load_kot.php');				  
				});
			}else
			{
				$(".loaderror").css("display","block");
				$(".loaderror").addClass("popup_validate_kot");
				$(".loaderror").text(kotmsg3);
				$('.loaderror').delay(2000).fadeOut('slow');
			}
	});
		
	/*****************************************  kotserveditems ends ******************************************************************  */
	
	/*****************************************  Kot Print starts ******************************************************************  */
	 $('.print_kot').click(function () {
			 var v=$('#order_number_view').text();
			  var kotn=(v.substring(1)); 
			  var id=$('.order_active').parent('a').attr('myorder');
			  var slval	  =	 id.split("_");
				var ord       =  slval[1];
			
			  $.post("load_div.php", {kot:kotn,set:'chekserved'},
				function(data)
				{
				data=$.trim(data);
				if(data=="ok")
				{
					$.post("print_details.php", {kot:kotn,ordn:ord,set:'kotprint'},
					function(data)
					{
					data=$.trim(data);
					});	
				}else
				{
					//alert("No items to print in KOT");
					$(".loaderror").css("display","block");
			 		$(".loaderror").addClass("popup_validate");
					$(".loaderror").text("No items to print in KOT");
			 		$('.loaderror').delay(2000).fadeOut('slow');
				}
									  
				});	
	});
	/*****************************************  Kot Print ends ******************************************************************  */
	
	/*****************************************  Ready to serve starts ******************************************************************  */
	 $('#readytoserve').click(function () {
             var kotmsg2 = ($("#kotmsg2").val());
             var kotmsg3 = ($("#kotmsg3").val());
             var combo_entry=new Array();
			var selected_activities =$('.tr_color_3');
			var kotvalues;
			var slvalues = new Array();
			selected_activities.each(function(){
				var kot   =  $(this).attr("kot");
                                //alert($(this).attr("combo_entry"));
                                combo_entry.push($(this).attr("combo_entry"));
				var kotval	  =	 kot.split("_");
				var kotvalue       =  kotval[1];
				kotvalues=kotvalue;
				var sl   =  $(this).attr("slno");
				var slval	  =	 sl.split("_");
				var slvalue       =  slval[1];
				if(slvalue!='undefined' && slvalue!='' && slvalue!=null){
					slvalues.push(slvalue);
				}
			});
			if(slvalues!="")
			{
				$.post("load_div.php", {kot:kotvalues,slno:slvalues,combo_entry:combo_entry,set:'setkotready'},
						function(data)
						{
							data=$.trim(data);
							$(".loaderror").css("display","block");
							$(".loaderror").addClass("popup_validate_kot");
							$(".loaderror").text(kotmsg2);
							$('.loaderror').delay(2000).fadeOut('slow');
							$('#setallkot').load('load_div.php?set=setmykot&kot='+kotvalues+'&nosl=0');
							$('#boxscrol2').load('load_kot.php');				  
				});
			}else
			{
				$(".loaderror").css("display","block");
				$(".loaderror").addClass("popup_validate_kot");
				$(".loaderror").text(kotmsg3);
				$('.loaderror').delay(2000).fadeOut('slow');
			}
	});
		
	/*****************************************  Ready to serve ends ******************************************************************  */
	
	
	});