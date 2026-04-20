 <script src="js/jquery-1.10.2.min.js"></script>
   
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance


if($_REQUEST['value']=="searchrate"){
	$search	= $_REQUEST['srchid'];
	
	if($search!= "")
	{

  
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster where mr_menuname='".$search."'"); 
	
	 $num_cat_s  = $database->mysqlNumRows($sql_login);
	
	if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
			{
				
					$searchname=$result_cat_s['mr_menuname'];
				
                 
	
			}
	}

	}
	else
	{
		
		$searchname="";
	}

?>
 
  
  

    
  
  <table width="100%" border="0" cellspacing="5"  class="table table-bordered table-font user_shadow" id="listall">          
 <thead>
 <tr>
    <th>Menu Name</th>
    <th>Floor</th>
    <th><?=$_SESSION['s_portionname']?></th>
   <th>Rate</th>
   
  </tr>
   </thead>
     <tbody >                                           
              
              
              
                                              <?php
											  
											  
											  
											  
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster INNER JOIN tbl_menumaster ON tbl_menuratemaster.mmr_menuid=tbl_menumaster.mr_menuid INNER JOIN tbl_floormaster ON  tbl_menuratemaster.mmr_floorid =tbl_floormaster.fr_floorid INNER JOIN tbl_portionmaster ON tbl_menuratemaster.mmr_portion=tbl_portionmaster.pm_id   where mr_menuname LIKE  '%" . $searchname ."%'");

//
//echo "select * from tbl_menumaincategory where mmy_maincategoryname LIKE  '%" . $searchname ."%'AND mmy_active LIKE '%" . $status ."%'";

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					
				
?>
    <tr>
         
         <td><?=$result_cat_s['mr_menuname']?></td>
       <td><?=$result_cat_s['fr_floorname']?></td>
       <td><?=$result_cat_s['pm_portionname']?></td>
       <td><?=$result_cat_s['mmr_rate']?></td>
          <!--  <td><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
          
          </tr>

  <?php $k++;}} ?>

    </tbody>
    </table>
    
     
 
     
     <?php } ?>
