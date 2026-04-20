// JavaScript Document
$(document).ready(function(){
	/***************************************** cancel eachitem  starts ******************************************************************  */
	$('.canceleachitem').click(function () {
		
		$('.closeoneclass2').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.closeoneclass2 .textcontent').html('Are you Sure you Want to Cancel This Item?');
		var billno       =  $(this).attr("billno");
		var slno       =  $(this).attr("slno");	 
		$('#hidbilnotosave').val(billno);
		$('#hidslnotosave').val(slno);
		
		
		}); 
 /*************************************** cancel each item ends ******************************************************************  */
 
 /*************************************** cancel close click starts ******************************************************************  */
   $('.closecancel2').click(function () {
    
		$('.closeoneclass2').css('display','none');
		$('.closeoneclass3').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('#hidbilnotosave').val('');
		$('#hidslnotosave').val('');
		$(' #typeentery ').text('');
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
	 
	 /*************************************** cancel close click starts ******************************************************************  */
   $('.closeoksubmit').click(function () { 
        
		$('.closeoneclass3').css('display','block');
		$('.confrmation_overlay').css('display','block');
		//$('.closeoneclass3 .textcontent').html('Are you Sure you Want to Cancel This Item?');
		//var billno       =  $(this).attr("billno");
		//var slno       =  $(this).attr("slno");	 
		//$('#hidbilnotosave').val(billno);
		//$('#hidslnotosave').val(slno);
	
	});
	 /*************************************** cancel close click ends ******************************************************************  */
 
 
 
 
 
  /*************************************** cancel each item by qty starts ***********************************************************  */
 	
	  $(".tr_clone_add").bind('change',function() {
		  
		   if($(this).val()!=0)
		  {//mnv qty
			  var $tr    = $(this).closest('.tr_clone');
			  var $clone = $tr.clone();
			  var valtotext_org   = $tr.attr('qtyval');
			  var slno   = $tr.attr('slno');
			  var canceldtext=($clone.find(':text').val());
			  var final=parseInt(valtotext_org) -  parseInt(canceldtext);
			
			if(final>=0) 
			  { alert(canceldtext)
				  $(this).parent().parent().clone().appendTo('.locate'+slno+':first');
				  $tr.find(':text').val(final);
				  $(".tr_clone_add1"+slno).val(final);
				  $(this).parent().parent().attr('qtyval',final);
				  $(this).parent().parent().siblings('.slmyno').text('');
			  }else
			  {//alert("sorry");
			  }
			 //$('.right_bill_history_detail:last').clone().appendTo('#tt:last'); 
			   	// && final<valtotext_org 
			  /*if(final>=0) 
			  {
				  
				  var portchange=($tr.attr("portionval"))
				  var menuchange=($tr.attr("menuval"))
				  var kotchange=($tr.attr("kotval"))
				  var ordchange=($tr.attr("ordval"))
				  var rate=($tr.attr("rateval"))
				   var uq=(menuchange+portchange+kotchange+ordchange)
				  var orgval=($("input[id='" + uq + "']").val());
				  if(final<=orgval)
				  {
						$tr.removeAttr('qtyval');
						$tr.attr('qtyval',final);
						$tr.after($clone);
						$clone.find(':text').val($(this).val());
						$clone.find('td:first').text('');
						$clone.css('background','#FEC7B4');
						$clone.addClass('cancel_clr');
						$clone.find('a').addClass('a_demo_four_active');
						$clone.find(':text').prop('disabled', true);
						var qtychange=($(this).val())
						var qtyc	  =	 qtychange.split("-");
						$(this).val(final);
						//alert(final)
						var totc=parseFloat(rate) *  parseFloat(qtyc[1]);
						if($('#totalcancelrate').val()!="" || $('#totalcancelrate').val()!="0")
						{
						var fn=parseFloat($('#totalcancelrate').val()) + parseFloat(totc);
						}else
						{
							var fn= parseFloat(totc);
						}
						 $('#totalcancelrate').val(fn);
						 
					    $.post("load_bill.php", {menuchange:menuchange,portchange:portchange,kotchange:kotchange,ordchange:ordchange,qtychange:final,set:'cancelupdationbill'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						$('#dfr').html(data);
						});
				  }else
				  {
					  $tr.find(':text').val(valtotext_org);
				  }
			  }
			  else
			  {
				  $tr.find(':text').val(valtotext_org);
			  }*/
		  }else
		  {//alert("gg");
		  }
		
	  });
	  /*************************************** cancel eachitem by qty ends ******************************************************************  */
	 
   
}); 