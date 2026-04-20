<?php

//include('includes/session.php');  // Check session
include("database.class.php"); // DB Connection class
$database = new Database();
session_start();
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");


 $catid=array();



  //return json_encode($catid) ;
if((isset($_REQUEST['set']))&&($_REQUEST['set']=='subcategory')){
 	$catid1=$_REQUEST['catid'];
      
        $dat=$_REQUEST['mainlang'];
        //echo $catid1;
	$sql_subcat = $database->mysqlQuery("select distinct(mr.mr_subcatid) as subid,msy_subcategoryid,msy_subcategoryname from tbl_menumaster as mr LEFT JOIN tbl_menusubcategory as ms ON mr.mr_subcatid=ms.msy_subcategoryid where mr.mr_active='Y' and mr.mr_maincatid='" . $catid1 . "' order by mr.mr_subcatid");
                //echo "select distinct(mr.mr_subcatid) as subid,msy_subcategoryid,msy_subcategoryname from tbl_menumaster as mr LEFT JOIN tbl_menusubcategory as ms ON mr.mr_subcatid=ms.msy_subcategoryid where ms.msy_active='Y' and mr.mr_maincatid='" . $catid1 . "' order by mr.mr_subcatid";
                $num_subcat = $database->mysqlNumRows($sql_subcat);
                if($num_subcat){
                    $j = 0;
                                            while ($result_subcat = $database->mysqlFetchArray($sql_subcat)) {
						$sub_catname=$result_subcat['msy_subcategoryname'];
                                                $sub_catid=$result_subcat['subid'];
                                           
                                                //echo $sub_catname;
            if($dat!='english'){
                
                $sql_arabsubcat=$database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabsubcat = $database->mysqlNumRows($sql_arabsubcat);
                $result_arabsubcat = $database->mysqlFetchArray($sql_arabsubcat);
                $sub_catname=$result_arabsubcat['mm_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                $catid['subcategoryname'][] = $sub_catname;
                $catid['subcategoryid'][] = $result_subcat['subid'];
            //echo $sub_catname;
 } } 
 
 echo json_encode(['subcat'=>$catid['subcategoryname'],'subcatid'=>$catid['subcategoryid']]) ;
 }
 else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='menuname')){
      //echo "$menuid";
 $sub_catid=$_REQUEST['subid'];
 $dat=$_REQUEST['mainlang'];
 $maincatid=$_REQUEST['maincat'];
 $opendate=$_REQUEST['dateopen'];
 $menuid=$_REQUEST['menuid'];
$listimage=$_REQUEST['listimage'];
$floorid=$_REQUEST['floorid'];
 //echo "$menuid";
 //echo $sub_catid;             
                                if($menuid==""){
                                 if ($sub_catid == 'all') {
                                        $sql_menulist = "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mc.mmy_active='Y' and mr.mr_active='Y' and  mr.mr_maincatid='" . $maincatid . "'  and tbl_menustock.mk_date='" . $opendate . "'  order by mr_subcatid "; // and mr.mr_subcatid IS NULL //and tbl_menustock.`mk_stock`='Y'
                                    } 
                                    
                                    
                                    else {
                              
                                        $sql_menulist = "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid LEFT JOIN tbl_menusubcategory as ms ON ms.msy_subcategoryid=mr.mr_subcatid LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid   WHERE mc.mmy_active='Y' and ms.msy_active	='Y' and mr.mr_active='Y' and  mr.mr_maincatid='" . $maincatid . "' and mr.mr_subcatid='" . $sub_catid . "' and tbl_menustock.mk_date='" . $opendate . "'  order by mr_subcatid "; //and tbl_menustock.`mk_stock`='Y' 
                                    }
                                }
                                else {
                                    
                                    if ($sub_catid == 'all') {
                                        $sql_menulist = "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mc.mmy_active='Y' and mr.mr_active='Y' and  mr.mr_maincatid='" . $maincatid . "' and mr.mr_menuid='".$menuid."'  and tbl_menustock.mk_date='" . $opendate . "'  order by mr_subcatid "; // and mr.mr_subcatid IS NULL //and tbl_menustock.`mk_stock`='Y'
                                    } 
                                    
                                    
                                    else {
                              
                                        $sql_menulist = "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid LEFT JOIN tbl_menusubcategory as ms ON ms.msy_subcategoryid=mr.mr_subcatid LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid   WHERE mc.mmy_active='Y' and ms.msy_active ='Y' and mr.mr_active='Y' and  mr.mr_maincatid='" . $maincatid . "' and mr.mr_subcatid='" . $sub_catid . "' and mr.mr_menuid='".$menuid."' and tbl_menustock.mk_date='" . $opendate . "'  order by mr_subcatid "; //and tbl_menustock.`mk_stock`='Y' 
                                    }
                                    
                                    
                                    
                                }
                                
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                           $menu_name = $result_menus['mr_menuname'];
                                           $catid['menu_id'][] = $result_menus['mr_menuid'];
                                            $catid['menu_stock'][] = $result_menus['mk_stock'];
                if($dat!='english'){
                
                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$dat."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                $menu_name=$result_arabmenu['lm_menu_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                 $catid['menu_name'][]= $menu_name;      
                 
                 if ($listimage == "Y") { // image show permission
                                               $sql_img = "SELECT * FROM tbl_menuimages where mes_menuid='" . $result_menus['mr_menuid'] . "' limit 0,1";
                                              $sql_imgs = $database->mysqlQuery($sql_img);
                                                $num_imgs = $database->mysqlNumRows($sql_imgs);
                                               if ($num_imgs) {
                                                    while ($result_imgs = $database->mysqlFetchArray($sql_imgs)) {
                                                        $catid['image'][] = $result_imgs['mes_imagethumb'];
                                                        
                                                    }
                                                } else {
                                                     $catid['image'][] = "uploads/default_photo.jpg";
                                               }
                                            }
                                           $portn = "N";
                                           $sql_menuportion = "select * from tbl_menuratemaster where  mmr_menuid='" . $result_menus['mr_menuid'] . "' and  mmr_floorid='" . $floorid . "' AND (mmr_rate<>'0' OR mmr_rate IS NOT NULL)";
                                            $sql_portions = $database->mysqlQuery($sql_menuportion);
                                            $num_portions = $database->mysqlNumRows($sql_portions);
                                            if ($num_portions) {
                                                $portn = "Y";
                                                $catid['portion']='Y';
                                            }
                                           
                                   
                              
 
 
 
    
}
echo json_encode(['menuname'=>$catid['menu_name'],'menuid'=>$catid['menu_id'],'menustock'=>$catid['menu_stock'],'portion'=>$catid['portion']]) ;
 }}

else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='orderedmenu')){
 
 $menuid=trim($_REQUEST['ordered_menuid'],'"');
 $dat=$_REQUEST['dat'];
 //echo $menuid;
 //echo $sub_catid;             
                                if($menuid!=""){
                               
                                        $sql_menulist = "select mr.mr_menuid,mr.mr_menuname from tbl_menumaster as mr WHERE mr.mr_menuid='".$menuid."'"; // and mr.mr_subcatid IS NULL //and tbl_menustock.`mk_stock`='Y'
                                    //echo "select mr.mr_menuid,mr.mr_menuname from tbl_menumaster as mr 	WHERE mr.mr_menuid='".$menuid."'";
                                    
                                }
                                
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                           $menu_name = $result_menus['mr_menuname'];
                                           
                if($dat!='english'){
                
                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$dat."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                $menu_name=$result_arabmenu['lm_menu_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                 $catid['menu_name'][]= $menu_name;      
 
 
 
 
    
}
echo json_encode($catid) ;
 }} 

else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='orderedportion')){
 
 $portionid=trim($_REQUEST['ordered_portionid'],'"');
 $dat=$_REQUEST['dat'];
 //echo $menuid;
 //echo $sub_catid;             
                                if($portionid!=""){
                               
                                        $sql_menulist = "select pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm where pm.pm_id='".$portionid."'"; 
                                    //echo "select pm.pm_id,pm.pm_portionname from tbl_portionmaster pm where pm.pm_id='".$portionid."'";
                                    
                                }
                                
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                           $portion_name = $result_menus['pm_portionname'];
                                           $portion_id = $result_menus['pm_id'];
                                           $catid['portion_shortcode'][]= $result_menus['pm_portionshortcode'];
                                           
                if($dat!='english'){
                
                $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$result_menus['pm_id']."' and ls_language='".$dat."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                $portion_name=$result_arabportion['lm_portion_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                 $catid['portion_name'][]= $portion_name;      
 
 
 
 
    
}
//echo json_encode($catid) ;
echo json_encode(['portion_name'=>$catid['portion_name'],'portion_shortcode'=>$catid['portion_shortcode']]);
 }} 
else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='orderedmenupreference')){
 
 $ordered_menuid=trim($_REQUEST['ordered_menuid'],'"');
 $dat=$_REQUEST['dat'];
 //echo $menuid;
 //echo $sub_catid;             
                                if($ordered_menuid!=""){
                                $sql_menupref="select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$ordered_menuid."'";
                                 //echo "select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$ordered_menuid."'";
                                }
                                $sql_pref  =  $database->mysqlQuery($sql_menupref); 
				 $num_pref  = $database->mysqlNumRows($sql_pref);
				 if($num_pref){
                                        while ($result_menupref = $database->mysqlFetchArray($sql_pref)) {
                                            
                                           $pref_name = $result_menupref['pmr_name'];
                                           $pref_id = $result_menupref['pmr_id'];
                                           
                if($dat!='english'){
                
                $sql_arabpref=$database->mysqlQuery("SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'");
                
                //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                $num_arabpref = $database->mysqlNumRows($sql_arabpref);
                 if($num_arabpref){
                    while ($result_arabpref = $database->mysqlFetchArray($sql_arabpref)){
                $pref_name=$result_arabpref['l_pref_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }}}
                 $catid['pref_name'][]= $pref_name;      
 
 
 
 
 }   

echo json_encode($catid) ;
}}

else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='table')){
    $string="";
 if($_REQUEST['floorid']!=""){
 $floorid=trim($_REQUEST['floorid'],'"');
 $string= " tr_floorid='" . $floorid . "' and ";
 }
 $dat=$_REQUEST['dat'];
 //echo $menuid;
 //echo $sub_catid;             
                                
                              $sql_table_sel = $database->mysqlQuery("select * from tbl_tablemaster where $string tr_status='Active'  order by tr_displayorder");
                            $num_table = $database->mysqlNumRows($sql_table_sel);
                            if ($num_table) {
                                while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
                                            
                                           $table_name = $result_table_sel['tr_tableno'];
                                           $table_id = $result_table_sel['tr_tableid'];
                                           $table_vacantcount = $result_table_sel['tr_vaccantcount'];
                                           $table_nextprefix = $result_table_sel['tr_nextprefix_ascii'];
                                           
                                           
                if($dat!='english'){
                
                $sql_arabtable=$database->mysqlQuery("SELECT t_table_name FROM tbl_language_table_master left join tbl_languages on ls_id=t_lang_id WHERE t_table_id='".$result_table_sel['tr_tableid']."' and ls_language='".$dat."'");
                
                //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                $num_arabtable = $database->mysqlNumRows($sql_arabtable);
                 if($num_arabtable){
                    while ($result_arabtable = $database->mysqlFetchArray($sql_arabtable)){
                $table_name=$result_arabtable['t_table_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }}}
                 $catid['table_name'][]= $table_name;
                 $catid['table_id'][]= $result_table_sel['tr_tableid']; 
                 $catid['table_vacantcount'][]= $result_table_sel['tr_vaccantcount'];
                 $catid['table_nextprefix'][]= $result_table_sel['tr_nextprefix_ascii'];
                  $catid['table_status'][]= $result_table_sel['tr_status'];
 
 
 
 }   

//echo json_encode($catid) ;
echo json_encode(['table_name'=>$catid['table_name'],'table_id'=>$catid['table_id'],'table_vacantcount'=>$catid['table_vacantcount'],'table_nextprefix'=>$catid['table_nextprefix'],'table_status'=>$catid['table_status']]) ;
}}
 
else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='staff_ordertake')){
 
 //$floorid=trim($_REQUEST['floorid'],'"');
 $dat=$_REQUEST['dat'];

 //echo $dat;
                            if(isset($_REQUEST['staffid'])){
                               $sql_staff_sel = $database->mysqlQuery("select * from tbl_staffmaster where ser_staffid='".$_REQUEST['staffid']."'");
                            }
                            else{
                              $sql_staff_sel = $database->mysqlQuery("SELECT dr_designationid,ser_staffid,ser_firstname,ser_lastname  FROM tbl_staffmaster left Join tbl_designationmaster on dr_designationid=ser_designation where ser_employeestatus ='Active' and dr_takeorder='Y'");
                            //echo "SELECT dr_designationid,ser_staffid,ser_firstname,ser_lastname  FROM tbl_staffmaster left Join tbl_designationmaster on dr_designationid=ser_designation where ser_employeestatus ='Active' and dr_takeorder='Y'";
                            }
                            $num_staff = $database->mysqlNumRows($sql_staff_sel);
                            if ($num_staff) {
                                while ($result_staff_sel = $database->mysqlFetchArray($sql_staff_sel)) {
                                            
                                           $staff_name = $result_staff_sel['ser_firstname']."  ".$result_staff_sel['ser_lastname'];
                                           $staff_id = $result_staff_sel['ser_staffid'];
                                        if(!isset($_REQUEST['staffid'])){
                                           $staff_designation = $result_staff_sel['dr_designationid'];
                                           $catid['staff_designation'][]= $result_staff_sel['dr_designationid'];
                                           }
                                           else{
                                           $catid['staff_designation'][]="";
                                           }
                                           
                                           
                if($dat!='english'){
                
                $sql_arabstaff=$database->mysqlQuery("SELECT s_staff_first_name,s_staff_last_name FROM tbl_language_staff left join tbl_languages on ls_id=s_lang_id WHERE s_staff_id='".$result_staff_sel['ser_staffid']."' and ls_language='".$dat."'");
                
                //echo " SELECT s_staff_first_name,s_staff_last_name FROM tbl_language_staff left join tbl_languages on ls_id=s_lang_id WHERE s_staff_id='".$result_staff_sel['ser_staffid']."' and ls_language='".$dat."'";
                $num_arabstaff = $database->mysqlNumRows($sql_arabstaff);
                 if($num_arabstaff){
                    while ($result_arabstaff = $database->mysqlFetchArray($sql_arabstaff)){
                $staff_name=$result_arabstaff['s_staff_first_name']."  ".$result_arabstaff['s_staff_last_name'];
              
                }}}
                 $catid['staff_name'][]= $staff_name;
                 $catid['staff_id'][]= $result_staff_sel['ser_staffid']; 
                
                 
 
 
 
 }   

//echo json_encode($catid) ;
echo json_encode(['staff_name'=>$catid['staff_name'],'staff_id'=>$catid['staff_id'],'staff_designation'=>$catid['staff_designation']]) ;
}}


else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='floors')){
 
 //$floorid=trim($_REQUEST['floorid'],'"');
 $dat=trim($_REQUEST['dat'],'"');
 //echo $dat;
 //echo $sub_catid;             
                                
                              $sql_floor = $database->mysqlQuery("SELECT fr_floorid,fr_floorname FROM tbl_floormaster");
                            $num_floor = $database->mysqlNumRows($sql_floor);
                            if ($num_floor) {
                                while ($result_floor = $database->mysqlFetchArray($sql_floor)) {
                                            
                                           $floor_name = $result_floor['fr_floorname'];
                                           $floor_id = $result_floor['fr_floorid'];
                                           
                                           
                                           
                                           
                if($dat!='english'){
                
                $sql_arabfloor=$database->mysqlQuery("SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'");
                
                //echo " SELECT f_floor_name FROM tbl_language_floor left join tbl_languages on ls_id=f_lang_id WHERE 	f_floor_id='".$result_floor['fr_floorid']."' and ls_language='".$dat."'";
                $num_arabfloor = $database->mysqlNumRows($sql_arabfloor);
                 if($num_arabfloor){
                    while ($result_arabfloor = $database->mysqlFetchArray($sql_arabfloor)){
                $floor_name=$result_arabfloor['f_floor_name'];
              
                }}}
                 $catid['floor_name'][]= $floor_name;
                 $catid['floor_id'][]= $result_floor['fr_floorid']; 
                 
                 
 
 
 
 }   

//echo json_encode($catid) ;
echo json_encode(['floor_name'=>$catid['floor_name'],'floor_id'=>$catid['floor_id']]) ;
}}
 
 
else if((isset($_REQUEST['set']))&&($_REQUEST['set']=='maincat')){
    
    $dat=$_REQUEST['dat'];
$opendate=$_REQUEST['opendate'];
$listimage=$_REQUEST['listimage'];
$floorid=$_REQUEST['floorid'];
  //echo  $floorid; 
    
    

    $catid=array();
   
   $sql_cat = $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid,my.mmy_maincategoryname,my.mmy_maincategoryid,my.mmy_displayorder   from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder");
   //echo "select distinct(mr.mr_maincatid) as catid,my.mmy_maincategoryname,my.mmy_maincategoryid,my.mmy_displayorder   from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder";              
   $num_cat = $database->mysqlNumRows($sql_cat);
        if ($num_cat) {
            $j =0;
            while ($result_cat = $database->mysqlFetchArray($sql_cat)) {
            $sql_cat_r = $database->mysqlQuery("SELECT mr.`mmr_rate` FROM `tbl_menuratemaster` as mr LEFT JOIN tbl_menumaster as ms ON mr.`mmr_menuid`=ms.mr_menuid WHERE ms.mr_maincatid='".$result_cat['catid']."' AND mr.mmr_floorid='".$floorid."' AND (mr.mmr_rate<>'0' OR mr.mmr_rate IS NOT NULL)");
            //echo "SELECT mr.`mmr_rate` FROM `tbl_menuratemaster` as mr LEFT JOIN tbl_menumaster as ms ON mr.`mmr_menuid`=ms.mr_menuid WHERE ms.mr_maincatid='".$resu['maincategoryid'][$i]."' AND mr.mmr_floorid='".$_SESSION['floorid']."' AND (mr.mmr_rate<>'0' OR mr.mmr_rate IS NOT NULL)";
            $num_cat_r = $database->mysqlNumRows($sql_cat_r);
            if ($num_cat_r) {
                $catname=$result_cat['mmy_maincategoryname'];
                $catid['maincategoryid'][] = $result_cat['catid'];
            
            if($dat!='english'){
                $sql_arabcat=$database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_main left join tbl_languages on ls_id=mm_lang_id WHERE mm_categoryid='".$result_cat['mmy_maincategoryid']."' and ls_language='".$dat."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_main left join tbl_languages on ls_id=mm_lang_id WHERE mm_categoryid='".$result_cat['mmy_maincategoryid']."' and ls_language='".$dat."'";
                $num_arabcat = $database->mysqlNumRows($sql_arabcat);
                $result_arabcat = $database->mysqlFetchArray($sql_arabcat);
                $catname=$result_arabcat['mm_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                $catid['maincategoryname'][] = $catname;
            }
                

 }
}                                       
echo json_encode(['maincategoryname'=>$catid['maincategoryname'],'maincategoryid'=>$catid['maincategoryid']]) ;                                                         

            
}

?>