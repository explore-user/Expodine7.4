<?php

include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 
//include("excel_plugin.php");// Create a new instance
function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

if(isset($_REQUEST['menu_to_excel'])){
    $data=array();
    $data_head=array();
    $data1=array();
    $xlsRow=1;
    
   
    $sql_login  =  $database->mysqlQuery("select c.mr_menuid,c.mr_menuname,c.mr_diet,c.mr_prepmode,c.mr_description,c.mr_itemshortcode,
                                          (select m.lm_menu_name from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_name,
                                          (select m.lm_menu_print from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_print,
                                          (select m.lm_menu_description from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_description,
                                          (select m.lm_menu_diet from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_diet,
                                          (select m.lm_menu_prepmode from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_prepmode,
                                          (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language
                                          from  tbl_menumaster c order by c.mr_menuname");
    
//echo "select c.mr_menuid,c.mr_menuname,c.mr_diet,c.mr_prepmode,c.mr_description,c.mr_itemcode,
//                                          (select m.lm_menu_name from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_name,
//                                          (select m.lm_menu_print from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_print,
//                                          (select m.lm_menu_description from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_description,
//                                          (select m.lm_menu_diet from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_diet,
//                                          (select m.lm_menu_prepmode from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as lm_menu_prepmode,
//                                          (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language
//                                          from  tbl_menumaster c order by c.mr_menuname";
    $num_login   = $database->mysqlNumRows($sql_login);
    
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login))
                    {
                          if($xlsRow==1){
                              $data_head=array('Sl No','Menu Name-English','Menu Name-'.ucfirst($result_login['ls_language']),
                               'Menu Print-English','Menu Print-'.ucfirst($result_login['ls_language']),'Menu Description-English',
                               'Menu Description-'.ucfirst($result_login['ls_language']),'Menu Diet-English','Menu Diet-'.ucfirst($result_login['ls_language']),
                                'Menu Prepmode-English','Menu Prepmode-'.ucfirst($result_login['ls_language']));
                          }
                          $data['Sl No']=$xlsRow;
                          $data['Menu Name-English']=$result_login['mr_menuname'];
                          $data['Menu Name-'.ucfirst($result_login['ls_language'])]=$result_login['lm_menu_name'];
                          $data['Menu Print-English']=$result_login['mr_itemshortcode'];
                          $data['Menu Print-'.ucfirst($result_login['ls_language'])]=$result_login['lm_menu_print'];
                          $data['Menu Description-English']=$result_login['mr_description'];
                          $data['Menu Description-'.ucfirst($result_login['ls_language'])]=$result_login['lm_menu_description'];
                          $data['Menu Diet-English']=$result_login['mr_diet'];
                          $data['Menu Diet-'.ucfirst($result_login['ls_language'])]=$result_login['lm_menu_diet'];
                          $data['Menu Prepmode-English']=$result_login['mr_prepmode'];
                          $data['Menu Prepmode-'.ucfirst($result_login['ls_language'])]=$result_login['lm_menu_prepmode'];
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
             }
             }
 header("Content-Type: application/vnd.ms-excel");
 $filename = "menu.xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
}
else if(isset($_REQUEST['category_to_excel'])){
    $data=array();
    $data1=array();
    $xlsRow=1;
    
   
    $sql_login  =  $database->mysqlQuery("select c.mmy_maincategoryid,c.mmy_maincategoryname,
                                        (select m.mm_name from tbl_language_menu_main m  where m.mm_categoryid = c.mmy_maincategoryid and m.mm_lang_id ='".$_SESSION['idrr']."' )as name_lang , 
                                        (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language 
                                        from tbl_menumaincategory c order by c.mmy_maincategoryname");

//                                    echo "select c.mmy_maincategoryid,c.mmy_maincategoryname,
//                                    (select m.mm_name from tbl_language_menu_main m  where m.mm_categoryid = c.mmy_maincategoryid and m.mm_lang_id ='".$_SESSION['idrr']."' )as name_lang,  
//                                    (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language
//                                    from tbl_menumaincategory c order by c.mmy_maincategoryname";
    $num_login   = $database->mysqlNumRows($sql_login);
    
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login))
                    {
                          
                          $data['Sl No']=$xlsRow;
                          $data['Categroy Name-English']=$result_login['mmy_maincategoryname'];
                          $data['Categroy Name-'.ucfirst($result_login['ls_language'])]=$result_login['name_lang'];
                          
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
             }
             }
 header("Content-Type: application/vnd.ms-excel");
 $filename = "category.xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
}
else if(isset($_REQUEST['subcategory_to_excel'])){
    $data=array();
    $data1=array();
    $xlsRow=1;
    
   
    $sql_login  =  $database->mysqlQuery("select c.msy_subcategoryid,c.msy_subcategoryname,
                                        (select m.mm_name from tbl_language_menu_sub m  where m.mm_sub_category_id = c.msy_subcategoryid and m.mm_lang_id ='".$_SESSION['idrr']."' )as name_lang,  
                                        (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language   
                                        from tbl_menusubcategory c order by c.msy_subcategoryname ");

//                                    echo "select c.msy_subcategoryid,c.msy_subcategoryname,
//                                        (select m.mm_name from tbl_language_menu_sub m  where m.mm_sub_category_id = c.msy_subcategoryid and m.mm_lang_id ='".$_SESSION['idrr']."' )as name_lang,  
//                                        (select l.ls_language from tbl_languages l where l.ls_id='".$_SESSION['idrr']."') as ls_language   
//                                        from tbl_menusubcategory c order by c.msy_subcategoryname";
    $num_login   = $database->mysqlNumRows($sql_login);
    
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login))
                    {
                          
                          $data['Sl No']=$xlsRow;
                          $data['Sub Categroy Name-English']=$result_login['msy_subcategoryname'];
                          $data['Sub Categroy Name-'.ucfirst($result_login['ls_language'])]=$result_login['name_lang'];
                          
                          
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
             }
             }
 header("Content-Type: application/vnd.ms-excel");
 $filename = "subcategory.xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
}

?>
