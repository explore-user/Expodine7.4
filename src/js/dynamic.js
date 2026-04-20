// JavaScript Document
 $(document).ready(function() {
  
	  var nice = $("html").niceScroll();  // The document page (body)
	  $("#div1").html($("#div1").html()+' '+nice.version);
	  $("#content-3dd_tbl").niceScroll({touchbehavior:true}); // First scrollable DIV
	  $("#content-3dd_rightn").niceScroll({touchbehavior:true});
	  $("#boxscrol3").niceScroll({touchbehavior:true});
	  $("#boxscrol_right").niceScroll({touchbehavior:true,});
	  $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#F00",cursoropacitymax:0.7,touchbehavior:true});  // Second scrollable DIV
	  $("#boxframe").niceScroll("#boxscroll3",{cursorcolor:"#0F0",cursoropacitymax:0.7,touchbehavior:true});  // This is an IFrame (iPad compatible)
	  $("#boxscroll4").niceScroll("#boxscroll4 .wrapper",{});  // hw acceleration enabled when using wrapper
	  //bill generation screen 1
	   $("#kot_scroll").niceScroll({touchbehavior:true});
	   //bill generation screen 3
	   $("#kot_bill_scroll").niceScroll({touchbehavior:true});
	   $(".hgt").niceScroll({touchbehavior:true}); 
	   //bill generation screen 2
	  $("#kot_scroll1").niceScroll();
	  $("#table_list").niceScroll({touchbehavior:true});
	  $("#table_list1").niceScroll();
	  $("#table_menu").niceScroll({touchbehavior:true,}); // Scroll Y Axis 
	  $("#bill_scr").niceScroll({touchbehavior:true,});
		 
	  nice = $("#table_menu").niceScroll();
	  var _super = nice.getContentSize;
	  nice.getContentSize = function() {      
		var page = _super.call(nice);
		page.h = nice.win.height();
		return page;
	  }
	  //Menu order
     $("#boxscroll").niceScroll({touchbehavior:true}); // First scrollable DIV 
	 $("#boxscrol2").niceScroll({touchbehavior:true}); //boxzoom:true
	 // $("#submenu").niceScroll({touchbehavior:true});
	  
	  // kot
	 $("#boxscrol2").niceScroll({touchbehavior:true,boxzoom:false});
	 $("#boxscrol3").niceScroll({touchbehavior:true});
	  $("#right_total").niceScroll({touchbehavior:true});
	 $("#boxscrol_right_pri").niceScroll({touchbehavior:true});
	 


  });