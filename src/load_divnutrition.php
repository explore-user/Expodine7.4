 <script src="js/jquery-1.10.2.min.js"></script>
       <!-- delete starts  -->
<script>
 $(document).ready(function(){
	 $(".tab_edt_btn3").click(function(e){
	var check = confirm("Are you sure you want to Delete this record?");
	if(check==true)
	{
		  var id_str   =  $(this).attr("id");
		  var id_arr	  =	 id_str.split("_");
		  var idval       =  id_arr[1];
		  var bc_str   =  $(this).attr("nid");
		  var bc_arr	  =	 bc_str.split("_");
		  var bcval       =  bc_arr[1];
		 $.ajax({
			type: "POST",
			url: "load_divnutrition.php",
			data: "value=delnutrition&mid="+idval+"&nid="+bcval,
			success: function(msg)
			{
			}
		});
		$.ajax({
			type: "POST",
			url: "load_divnutrition.php",
			data: "value=loadbranch&mid="+idval,
			success: function(msg)
			{
				$('#menunutrition').html(msg);
			}
		});
	
	}
	   });	      
            });
			

</script>  
<!-- delete ends  -->
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
require_once 'Classes/PHPExcel/IOFactory.php';
if($_REQUEST['value']=="addnutrition"){
 $nut=$_REQUEST['nutritionname'];
	$nutrid		= $_REQUEST['nutritionvalue'];
 $menuid=$_REQUEST['mid'];
$insertion['mnf_nutrition'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['nutritionname']);
$insertion['mnf_menuid'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	
	$sql=$database->check_duplicate_entry('tbl_menunutitionfacts',$insertion);
	 if($sql!=1)
	{$insertion['mnf_value'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['nutritionvalue']);	
	$insertid              			=  $database->insert('tbl_menunutitionfacts',$insertion);
	$database->updateexpodine_machines(); 
        //add xml code starts
	  $lastid='';
	 $sql_login  =  $database->mysqlQuery("select mnf_menuid from tbl_menunutitionfacts where 	mnf_nutrition='".$insertion['mnf_nutrition']."'  AND mnf_value='".$insertion['mnf_value']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$lastid=$result_login['mnf_menuid'];
			}
				  $doc = new DOMDocument();
				 // $doc->formatOutput = true;
				//$doc->preserveWhiteSpace = true;
				  $doc->load($_SESSION['s_xmlfilelocation']);
				  $main = $doc->getElementsByTagName( "nutrition" );
				  $main2 = $doc->getElementsByTagName( "nutr_".$lastid );
				  if($main->length != 0 && $main2->length != 0) //already
				  {  
					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
					   if($insertion['mnf_nutrition']=='')
					  {
						 $child = $xml->nutrition[0]->addChild("nutr_".$lastid," ");
					  }else
					  {
						  $child = $xml->nutrition[0]->addChild("nutr_".$lastid,$insertion['mnf_nutrition']);
					  }
				  	  //$child = $xml->nutrition[0]->addChild("nutr_".$lastid,$insertion['mnf_nutrition']);
					 // $child = $xml->nutrition[0]->addChild("val_".$lastid,$insertion['mnf_value']);
					  $dom = new DOMDocument('1.0');
					  $dom->preserveWhiteSpace = false;
					  $dom->formatOutput = true;
					  $dom->loadXML($xml->asXML());
					  $xml = new SimpleXMLElement($dom->saveXML());
					  $xml->asXML($_SESSION['s_xmlfilelocation']);
				  }else // not exist
				  {
					  $xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
					  $eg=1;$ar=1;
					  foreach ($xml->nutrition as $lang) {
						  if($lang["lang"]=="english")
						  {
							  $eg++;
						  }
						  if($lang["lang"]=="arabic")
						  {
							  $ar++; 
						  }
						  
					  }
					  if($eg==1)
					  {
					  $child = $xml->addChild("nutrition");
					  $child->addAttribute("lang", "english");
					  }
					  if($ar==1)
					  {
					  $child = $xml->addChild("nutrition");
					  $child->addAttribute("lang", "arabic");
					  }
					  if($insertion['mnf_nutrition']=='')
					  {
						 $child = $xml->nutrition[0]->addChild("nutr_".$lastid," ");
					  }else
					  {
						  $child = $xml->nutrition[0]->addChild("nutr_".$lastid,$insertion['mnf_nutrition']);
					  }
					  
					  
					 // $child = $xml->nutrition[0]->addChild("val_".$lastid,$insertion['mnf_value']);
					  $dom = new DOMDocument('1.0');
					  $dom->preserveWhiteSpace = false;
					  $dom->formatOutput = true;
					  $dom->loadXML($xml->asXML());
					  $xml = new SimpleXMLElement($dom->saveXML());
					  $xml->asXML($_SESSION['s_xmlfilelocation']);
				  }
		//add xml code ends	
		
		//excel code starts
		$inputFileType = 'Excel5';
		$inputFileName = $_SESSION['s_excelfilelocation'];
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			  $worksheetTitle     = $worksheet->getTitle();
			  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
			  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			  if($worksheetTitle=="nutrition")
			  {
				  $i=$highestRow + 1;
				  $worksheet->setCellValue("A".$i, $lastid);
				  $worksheet->setCellValue("B".$i, $insertion['mnf_nutrition']);
			  }
		}
	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
	  $xlsx->save($_SESSION['s_excelfilelocation']);
		//excel code ends
        
        
        ?>
    <script>
		document.getElementById("nutrition").value = "";
		document.getElementById("value").value = "";
 
	</script>
    
	<?php }
	 else 
	 {
		  ?>
       
		       <span id="nutstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold;" ></span>      
             <script type="text/javascript">
			  var nutstatus=$('#nutstatus');
			  nutstatus.text('Already exists');
			 </script>  
                      <?php
	 }
?>
 <table width="100%" border="0" cellspacing="5"  class="scroll">   
 <thead>
 <tr>
    <th>Nutrition</th>
    <th>Value</th>
  <!--  <th>Edit</th>-->
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menunutitionfacts where mnf_menuid='".$menuid."' "); 

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
            <td ><?=$result_cat_s['mnf_nutrition']?></td>
            <td><?=$result_cat_s['mnf_value']?></td>
            <td> <a class="tab_edt_btn3" href="#" id="m_<?=$result_cat_s['mnf_menuid']?>" nid="b_<?=$result_cat_s['mnf_nutrition']?>" ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>
    </tbody>
   </table> 
    <?php }else if($_REQUEST['value']=="delnutrition"){ 
	
	$mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
	$nid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['nid']);
	$sql_cat_s  =  $database->mysqlQuery("Delete  from tbl_menunutitionfacts where mnf_menuid='".$mid."'  and mnf_nutrition='".$nid."' "); 
	
	
	
$database->delete_nodes("nutr_".$mid,$nid,$_SESSION['s_xmlfilelocation'],"nutrition");	
$database->deletexml_fields("nutrition",$mid,$nid);
	
	 }else if($_REQUEST['value']=="loadbranch"){
		 $mid 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mid']);
		  ?>
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Nutrition</th>
    <th>Value</th>
    <th>Delete</th>
  </tr>
   </thead>
     <tbody >                                           
                                              <?php
											
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menunutitionfacts where mnf_menuid='".$mid."' "); 
$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
?>
    <tr>
            <td><?=$result_cat_s ['mnf_nutrition']?></td>
                 <td><?=$result_cat_s ['mnf_value']?></td>
          <!--  <td><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
            <td> <a class="tab_edt_btn3" href="#" id="m_<?=$result_cat_s['mnf_menuid']?>" nid="b_<?=$result_cat_s['mnf_nutrition']?>"  ><i class="glyphicon glyphicon-trash"></i></a></td>
          </tr>
  <?php $k++;}} ?>

    </tbody>
    </table>
      <?php }  ?>  
     
  
