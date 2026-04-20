// JavaScript Document

 $(document).ready(function() {
     window.onload = function() {
            $('.singlecheck').hide();
              //$('.wholeclick').hide();
     }
	/***************************************** checkbox each click starts ******************************************************************  */
	  $("input:checkbox[name='selecteach']").on('click', function() {
           
			var $box = $(this);
			var group = "input:checkbox[orderno='" + $box.attr("orderno") + "']";
			if ($box.is(":checked")) 
			{
				  $(group).prop("checked", true);
			} else 
			{
				 $(group).prop("checked", false);
			}
			
			var count_checked = $("input:checkbox[name='selecteach']:checked").length; // count the checked rows
			var count_full = $("input:checkbox[name='selecteach']").length;
			if(count_full == count_checked) 
			{
				$("input:checkbox[name='selectwhole']").prop("checked", true);
			}else
			{
				$("input:checkbox[name='selectwhole']").prop("checked", false);
			}
	  });

	/***************************************** checkbox each click ends ******************************************************************  */
	
	/***************************************** checkbox whole click starts ******************************************************************  */
	  $("input:checkbox[name='selectwhole']").on('click', function() {
             
			var $box = $(this);
			var group = "input:checkbox[name='selecteach']";
			if ($box.is(":checked")) 
			{
				  $(group).prop("checked", true);
			} else 
			{
				 $(group).prop("checked", false);
			}
	  });

	/***************************************** checkbox whole click ends ******************************************************************  */
	 $('#bilsplitcount').keypress(function (event) {
		
			if (event.keyCode == 13) {
				$('.addsplitnumbers').click();
			}else
			{
			 
			}
		
		
		 
		 });
	
	/***************************************** Add Bill Split numbers starts ******************************************************************  */
	 $('.addsplitnumbers').click(function () {
             //alert("hi");
//             $(".confirmbills").css("display","block"); 
             $(".completeall").css("display","none");
             var billsplitmsg1 = ($("#billsplitmsg1").val());
             var billsplitmsg2 = ($("#billsplitmsg2").val());
			 var billsplitmsg3 = ($("#billsplitmsg3").val());
			 var bilsplittotqty = ($("#bilsplittotqty").val());
			 var bilsplit=$('#bilsplitcount').val();//alert(bilsplit);alert(bilsplittotqty);
		var count_checked = $("input:checkbox[name='selecteach']:checked").length; 
		 if(count_checked == 0 ) 
        {
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(billsplitmsg1);
			$(".error_feed").delay(2000).fadeOut('slow');
		}else if((parseInt(bilsplit) > parseInt(bilsplittotqty)))
        {
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(billsplitmsg3);
			$(".error_feed").delay(2000).fadeOut('slow');
		}else
		{
			
			var letterNumber = /^[0-9]+$/;  
			 if((bilsplit.match(letterNumber)))
			 {
                             $(".confirmbills").css("display","block");
				 var tablename=new Array();
				 var selected_activities =$("input:checkbox[name='selecteach']:checked");
				  selected_activities.each(function(){
					var id_str       =  $(this).attr("tablenames");
                                        //alert(id_str);
					if(id_str!='undefined' && id_str!='' && id_str!=null){
							tablename.push(id_str);
						}
				  });
			
				  $('.confrimverify').css('display','block');
				  $('.confrmation_overlay').css('display','block');
				  
				  $('.tableidpop').text(tablename);
				  $('.splitnospop').text(bilsplit);
				  
			 }else
			 {
				 $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text(billsplitmsg2);
				$(".error_feed").delay(2000).fadeOut('slow');
			 }
		}
	
	
	});

	/***************************************** Add Bill Split numbers ends ******************************************************************  */
	
	/***************************************** cancel Verify starts ******************************************************************  */
	 $('.noverify').click(function () {
		$('.confrimverify').css('display','none');
		$('.confrmation_overlay').css('display','none');
	});

	/***************************************** cancel Verify ends ******************************************************************  */
	
	/***************************************** ok Verify starts ******************************************************************  */
	 $('.yesverify').click(function () {
		 
		$('.confrimverify').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var bilsplit=$('#bilsplitcount').val();
		var bilrate=$('.biltotalrate').text();
		var orderno=new Array();
	   var selected_activities =$("input:checkbox[name='selecteach']:checked");
		selected_activities.each(function(){
		  var id_str       =  $(this).attr("orderno");
		  if(id_str!='undefined' && id_str!='' && id_str!=null){
				  orderno.push(id_str);
			  }
		});
		//alert(orderno)
		$('.loadbildeatilstotal').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
		$.post("load_billsplit.php", {orderno:orderno,billnos:bilsplit,set:'loadbillfuldetails'},
			function(data)
			{
			$('.loadbildeatilstotal').html(data);
			//$('.ratesame').html(bilrate);
			});
		
	});

	/***************************************** ok Verify ends ******************************************************************  */
	/***************************************** confrim bills starts ******************************************************************  */
	 $('.confirmbills').click(function () {
             var billsplitmsg4 = ($("#billsplitmsg4").val());
		 //var bilto=parseFloat($('.biltotalrate').text());
		 // var rate=parseFloat($('.ratesame').text());
		  var selected_activities =$('.totalqtylist');
		  var tots=0;
		  selected_activities.each(function(){
			var qtid_str   =  $(this).text();
		  if((qtid_str!='undefined' && qtid_str!='' && qtid_str!=null)){
			   tots=parseFloat( tots) + parseFloat(qtid_str);
		  }
		});
		//alert(tots)
		
		 var bilct=$('#bilsplitcount').val();
		  var eachs=0;
		  for(var i=0;i<bilct;i++)
		  {
		 var selected_activities =$('.itemlisteach');
                 
		 
		  selected_activities.each(function(){
			var qtid_str   =  $(this).parent('td').find('.qtyval'+i).val();
		  if((qtid_str!='undefined' && qtid_str!='' && qtid_str!=null)){
			   eachs=parseFloat( eachs) + parseFloat(qtid_str);
                           //alert(eachs);
                           //alert(eachs);
		  }
		});
		  }
		 //alert(eachs)
		  if(tots==eachs)
		  {
		 $('.confrimwhole').css('display','block');
		 $('.confrmation_overlay').css('display','block');
		  }else
		  {
			  $(".error_feed").css("display","block");
				$(".error_feed").addClass("billgenration_validate");
				$(".error_feed").text("Complete the fields");
				$(".error_feed").delay(2000).fadeOut('slow');
		  }
		 
		 });

	/***************************************** confrim bills ends ******************************************************************  */
	/*****************************************no  confrim bills starts ******************************************************************  */
	 $('.nocfmverify').click(function () {
		 $('.confrimwhole').css('display','none');
		 $('.confrmation_overlay').css('display','none');
		 
		 });

	/***************************************** no confrim bills ends ******************************************************************  */
	/*****************************************ok  confrim bills starts ******************************************************************  */
	 $('.cfmverify').click(function () {
		 
		 $('.confrimwhole').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$(".confirmbills").css("display","none");
		$(".completeall").css("display","block");
		
		
		var selected_activities =$('.fuledittable').find("input");
	  selected_activities.each(function(){
		var id_str   =  $(this).val();
	  if(id_str==''){
		  $(this).val('0')
		  
	  }
	 });
	 
	 var selected_activities =$('.itemlisteach');
       
	  selected_activities.each(function(){
		var id_str   =  $(this).text();
	  if(id_str==''){
		  $(this).text('0')
		  
	  }
	 });	
		
		$(".fuledittable").find("input").attr("disabled", "disabled");
		 });

	/***************************************** ok confrim bills ends ******************************************************************  */
	/*****************************************complete all bills starts ******************************************************************  */
	 $('.completeall').click(function () {
		 var bilct=$('#bilsplitcount').val();
		 var bilnofinal=new Array();
		 for(var i=0;i<bilct;i++)
		  {
				var selected_activities =$('.itemlisteach');
                                 // alert(selected_activities);
				var qtyid=new Array();
				var rateid=new Array();
				var menuid=new Array();
				var portionid=new Array();
				var typeid=new Array();
				var amountid=new Array();
				var tots=0;
				selected_activities.each(function(){
				  var amtid_str   =  $(this).parent('td').find('.billval'+i).text();
				  var qtid_str   =  $(this).parent('td').find('.qtyval'+i).val();
				  var mnid_str   =  $(this).parent('td').find('.qtyval'+i).attr('menuname');
				  var ptid_str   =  $(this).parent('td').find('.qtyval'+i).attr('portion');
				  var tyid_str   =  $(this).parent('td').find('.qtyval'+i).attr('typeval');
				  var rtid_str   =  $(this).parent('td').find('.qtyval'+i).attr('rate');
				if((rtid_str!='undefined' && rtid_str!='' && rtid_str!=null)){
					 rateid.push(rtid_str);
				}
				if((qtid_str!='undefined' && qtid_str!='' && qtid_str!=null)){
					 qtyid.push(qtid_str);
				}
				if((mnid_str!='undefined' && mnid_str!='' && mnid_str!=null)){
					 menuid.push(mnid_str);
				}
				if((ptid_str!='undefined' && ptid_str!='' && ptid_str!=null)){
					 portionid.push(ptid_str);
				}
				if((tyid_str!='undefined' && tyid_str!='' && tyid_str!=null)){
					 typeid.push(tyid_str);
				}
				if((amtid_str!='undefined' && amtid_str!='' && amtid_str!=null)){
					 amountid.push(amtid_str);
				}
			  });
			 /* alert(rateid);
			  alert(qtyid);
			  alert(menuid);
			  alert(portionid);
			  alert(typeid);*/
			   var data = {
				  "set"		: "splitbillprocess",
				  "rate"	: rateid,
				  "qty"		: qtyid,
				  "menu"	: menuid,
				  "portion"	: portionid,
				  "typeval"	: typeid,
				  "bilct"	: bilct,
				  "amountid"	: amountid 
				};
				data = $(this).serialize() + "&" + $.param(data);//alert(data);
				  var request= $.ajax({
					  type: "POST",
					  dataType: "text",
					  url: "load_billsplit.php", 
					  data: data,
					  success: function(data) {
						  var res=data.trim();
						  //alert(res)
						   bilnofinal.push(res);
						  //alert(bilnofinal);
					  }
				});
			  	
		  		
				data = null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
			  
		  }
		  
		   var data = {
				  "set"		: "bilsplitmain"
				};
				data = $(this).serialize() + "&" + $.param(data);
				  var request= $.ajax({
					  type: "POST",
					  dataType: "text",
					  url: "load_billsplit.php", 
					  data: data,
					  success: function(data) {
						   var res=data.trim();
						  //alert(res);
						    window.location='billsplited_view.php'; //un comment
					  }
				});
			  	
		  		
				data = null;
				request.onreadystatechange = null;
				request.abort = null;
				request = null;
		  
		
		 
		 });

	/***************************************** complete all bills ends ******************************************************************  */
	
	

	
	
  });