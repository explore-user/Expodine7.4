<?php
include("database.class.php");
//include("api_multiplelanguage_link.php");// DB Connection class
$database = new Database();
session_start();
header('Content-Type: text/html; charset=utf-8');
if((isset($_REQUEST['set']))&&($_REQUEST['set']=='maincat')){
    
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