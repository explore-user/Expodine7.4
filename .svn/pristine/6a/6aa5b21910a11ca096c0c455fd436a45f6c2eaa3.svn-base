 <script src="js/jquery-1.10.2.min.js"></script>
   
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance

//`tbl_menumanagerdetails`(`mrd_menuid`, `mrd_branch`, `mrd_status`)
if($_REQUEST['value']=="searchmenumanager"){
	$search	= $_REQUEST['srchid'];
	
	$menuname=$_REQUEST['menu'];
	
	
	
	
	if($menuname !="%%")
	{
		
		
	 $sql_login  =  $database->mysqlQuery("select mgr_menuname from tbl_menumanager where mgr_menuid='".$menuname."'"); 
	
	 $num_cat_s  = $database->mysqlNumRows($sql_login);
	
	if($num_cat_s){
		while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
			{
				
					$searchname=$result_cat_s['mgr_menuname'];
					

			}
	}
	}
	
	else
	
{
	
	 
	 $searchname="%%";
	 
	 
}








?>
 
  
  

    
  
  <table width="100%" border="0" cellspacing="5"  class="scroll">          
 <thead>
 <tr>
    <th>Menu Name</th>
   
   
    <th>Active</th>
  </tr>
   </thead>
     <tbody >                                           
              
              
              
                                              <?php
											  
											  
											  
											  
$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menumanager where mgr_status LIKE '%" . $search ."%' AND mgr_menuname LIKE '%".$searchname."%' ");

//
//echo "select * from tbl_menumaincategory where mmy_maincategoryname LIKE  '%" . $searchname ."%'AND mmy_active LIKE '%" . $status ."%'";

$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
	if($num_cat_s){$k=0;
		while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
			{
					if($result_cat_s['mgr_status']=="Y")
				{
				
					$active="Yes";
				}else 
				{
					$active="No";
				}	
				
?>
    <tr>
         
         <td><?=$result_cat_s['mgr_menuname']?></td>
      
         <td><?=$active?></td>
         
          <!--  <td><a class="tab_edt_btn" href="#"><i class="glyphicon glyphicon-pencil"></i></a></td>-->
          
          </tr>

  <?php $k++;}} ?>

    </tbody>
    </table>
    
  
     
     <?php } ?>
