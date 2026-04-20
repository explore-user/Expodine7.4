<?php session_start(); 
include("../database.class.php"); // DB Connection class
$database	= new Database();

?>
<script src="../js/jquery-1.10.2.min.js"></script>
 <script>
  $(document).ready(function() {
  	setInterval(function() {
    $.post("../autoload_menu.php", {set:'korprintrefresh'},
		function(data)
		{
		data=$.trim(data);
		
		var kot=data.split(',');
		var legth=kot.length;
		//$('#fff').html(data);
		/*$('#stewrdrefreshcount').html(data);
		$('#stwnot').html(data);*/
		for(var i=0;i<legth;i++)
		{//alert(kot[i]);
		var kt=kot[i];
		$.post("../print_details.php", {kot:kt,set:'kotprint',check:'kotmissed'},
			function(data1)
			{
			data1=$.trim(data1);
			
			});	
		}
		});	
		}, 3000); 
});
</script>
<?php
/*if($_SESSION['s_printst']=="Y") // printer ye or no
{
	
}
*/

?>
<!--
<div id="fff"></div>-->

