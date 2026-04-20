<?php

include 'DB/config.php';

define("SITE_URL","http://192.168.1.112:8021/Expodine/"); 
define("ADMIN_URL","http://192.168.1.112:8021/Expodine/");

//define("PRINTER_IP","\\\\192.168.1.112\\");
define('MYSQL_TYPES_NUMERIC', 'int real ');
define('MYSQL_TYPES_DATE', 'datetime timestamp year date time ' );
define('MYSQL_TYPES_STRING', 'string blob ' );
 
$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
         $sql_gen =  mysqli_query($localhost,"select * from tbl_branchmaster"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_invoice6  = mysqli_fetch_array($sql_gen)) 
					{
                                       $timezone=$result_invoice6['be_time_zone'];
                                      
                                       
                                        }
                                }
 



date_default_timezone_set($timezone);
class Database
{
   var $last_error;        
   var $last_query;   
   var $host;   
   var $user;
   var $pw;
   var $db;  
   var $db_link;     
   var $auto_slashes; 

	var		$HostName;
	var		$UserName;
	var		$PassWord;
	var		$DatabaseName;
	var		$DatabaseLink;

 function __construct ($hostName = HOST_NAME, $userName = USER_NAME, $password = PASSWORD, $databaseName = DATABASE_NAME_REPORT)
	{

		 $this->HostName		=	$hostName;
		$this->UserName			=	$userName;
		$this->PassWord			=	$password;
		$this->DatabaseName		=	$databaseName;
		$this->DatabaseLink		=	mysqli_connect($this->HostName, $this->UserName, $this->PassWord,$this->DatabaseName) or die(mysql_error());
		mysqli_set_charset($this->DatabaseLink,"utf8");
		mysqli_query($this->DatabaseLink,"SET NAMES 'utf-8'");
		//$this->DatabaseLink		=	mysqli_connect("192.168.1.117", "sample", "123456","expodine_branch1") or die(mysql_error());
		//mysql_select_db($this->DatabaseName,$this->DatabaseLink); 
		//or die("<h3>Error on Server. Please Try Once Again...Thank You!!!<h2><hr>")
	}
	
	function throw_ex($er){  
	  throw new Exception($er);  
	}  

  function insert( $table, $data)
    {
       
        //Make sure the array isn't empty
        if( empty( $data ) )
        {
            return false;
        }
        
      $sql = "INSERT INTO ". $table;  
		
        $fields = array();
        $values = array();
        foreach( $data as $field => $value )
        {
            $fields[] = $field;
            $values[] = "'".$value."'";
        }
        $fields = ' (' . implode(', ', $fields) . ')';
        $values = '('. implode(', ', $values) .')';
        

     $sql .= $fields .' VALUES '. $values;
    //return $sql;
      
       
     return $this->insert_sql($sql);

    }
    


   function insert_sql($sql) {
       
      $this->last_query = $sql;
     
      $r = $this->mysqlQuery($sql);
      if (!$r) {
         $this->last_error = mysqli_connect_error ();
         return false;
      }
     
      $id = $this->mysqlInsertId();
      if ($id == 0) return true;
      else return $id;
   }

    function get_column_type($table, $column)
    {
     
      $r = mysqli_query($this->DatabaseLink,"SELECT $column FROM $table LIMIT 1");
      if (!$r)
      {
         $this->last_error = mysqli_error();
         return false;
      }
	  $finfo = mysqli_fetch_field_direct($r, 0);
	  $ret = $finfo->type;
     // $ret = mysql_field_type($r, 0);
      if (!$ret)
      {
         $this->last_error = "Unable to get column information on $table.$column.";
         mysqli_free_result($r);
         return false;
      }
      mysqli_free_result($r);
      return $ret;
    }
    function sql_date_format($value, $type)
     {

      if (gettype($value) == 'string') $value = strtotime($value);
      return date('Y-m-d H:i:s', $value);

   }
     function update_new( $table, $variables = array(), $where = array(), $limit = '' )
    {
        
        //Make sure the required data is passed before continuing
        //This does not include the $where variable as (though infrequently)
        //queries are designated to update entire tables
        if( empty( $variables ) )
        {
            return false;
        }
        $sql = "UPDATE ". $table ." SET ";
        foreach( $variables as $field => $value )
        {
            
            $updates[] = "`$field` = '$value'";
        }
        $sql .= implode(', ', $updates);
        
        //Add the $where clauses as needed
        if( !empty( $where ) )
        {
            foreach( $where as $field => $value )
            {
                $value = $value;

                $clause[] = "$field = '$value'";
            }
            $sql .= ' WHERE '. implode(' AND ', $clause);   
        }
        
        if( !empty( $limit ) )
        {
            $sql .= ' LIMIT '. $limit;
        }

        $query = $this->link->query( $sql );

        if( $this->link->error )
        {
            $this->log_db_errors( $this->link->error, $sql );
            return false;
        }
        else
        {
            return true;
        }
    } 
   function update($table, $data, $condition)
   {
           if (empty($data))
           {
         $this->last_error = "You must pass an array to the update_array() function." ;
         return false;
           }
     
      $sql = "UPDATE $table SET";
      foreach ($data as $key=>$value)
     {      // iterate values to input
	 $values='';
          $sql .= " $key=";
         $col_type = $this->get_column_type ($table, $key); // get column type
         if (!$col_type) return false;  // error!
          // determine if we need to encase the value in single quotes
          
         //if (substr_count('int', "$col_type "))
		 if(is_numeric("$col_type "))
         $sql .= "$value,";
         /*elseif (substr_count(MYSQL_TYPES_DATE, "$col_type " ))
         {
            $value = $this->sql_date_format ($value, $col_type); // format date
              $sql .= "'$value',";
         }*/
         else//if (substr_count("string", "$col_type "))
         {
          if ($this->auto_slashes) $value = addslashes($value);
            $values .= "'$value',";
            $sql=$sql.$values;
            unset($values);
         }
		 
      }
      $sql = rtrim($sql, ','); // strip off last "extra" comma
      if (!empty($condition)) $sql .= " WHERE $condition" ;
    	//echo "sql=$sql";
      // insert values
	//echo $sql; die();
	//echo $sql; die();
      return $this->update_sql($sql );
      
   }
   function check_duplicate_entry($table, $data)
   {
           if (empty($data))
           {
         $this->last_error = "You must pass an array to the duplicate_array() function." ;
         return false;
           }
     
      $sql = "SELECT * FROM $table WHERE ";
   // $sql = "UPDATE ". $table ." SET ";
        foreach( $data as $field => $value )
        {
            
            $updates[] = "`$field` = '$value'";
        }
        $sql .= implode(' and ', $updates);
        
    // echo $sql;die();
      return $this->duplicate_sql($sql );
      
   }
    function duplicate_sql($sql) {

    $this->last_query = $sql;
     
      $r = mysqli_query($this->DatabaseLink,$sql);
      if (!$r) {
         $this->last_error = mysqli_connect_error ();
         return false;
      }
     
      $rows = mysqli_num_rows($r);
      //if ($rows == 0) return true;  // no rows were updated
     // else
	   return $rows;
   }
  
     function update_sql($sql) {

    $this->last_query = $sql;
     
      $r = mysqli_query($this->DatabaseLink,$sql);
      if (!$r) {
         $this->last_error = mysqli_error ();
         return false;
      }
     
      $rows = mysqli_affected_rows($this->DatabaseLink);
      if ($rows == 0) return true;  // no rows were updated
      else return $rows;
   }
    
   function select_one_row($id)
   {
    $qry1=mysqli_query($this->DatabaseLink,"select * from s2 where bUserId='$id'");
    $s=mysql_fetch_assoc($qry1);
    return $s;
   }
   
	function mysqlQuery($qry)
	{	
		$rs		=	mysqli_query($this->DatabaseLink,$qry);
		return $rs;
		
		echo mysql_error();
	}
	
	function mysqlFetchArray($rs)
	{
		$row	=	array();
		if($rs	===	FALSE)  # In case invalid result resource
			return $row;
		$row	=	mysqli_fetch_array($rs);
		return $row;
	}
	
	function mysqlNumRows($rs)
	{
		if($rs	===	FALSE)   # In case invalid result resource
			return 0;
		$rows	=	mysqli_num_rows($rs);
		return $rows;
	}
	
	function mysqlFreeResult($rs)
	{
		if($rs	===	FALSE) # In case invalid result resource
			return ;
		mysqli_free_result($rs);
	}
	
	function mysqlInsertId()
	{
		$id	=	mysqli_insert_id($this->DatabaseLink);
		return $id;
	}
	
	function mysqlClose()
	{
		mysqli_close($this->DatabaseLink);
	}

	function getTableArray($qry)	// Returns a Two dimensional array which contains the data associated with the result set
	{
		$dataTable		=	array();
		$rs				=	mysqli_query($this->DatabaseLink,$qry);
		if($rs	===	FALSE)  # In case invalid result resource
			return $dataTable; 
		
		$fieldcount		=	@mysqli_num_fields($rs);
		//Fetching the Fields Names from the database.
		$fields			=	array();	
		for ($i=0; $i<$fieldcount; $i++ )
			$fields[$i]		=	@mysql_field_name($rs,$i);
		
		$count		=	0;
		
		while ($row	=	@mysqli_fetch_array($rs)) {
			for ($i=0; $i<$fieldcount; $i++ )
				$dataTable[$count][$fields[$i]]		=	$row[$fields[$i]];
			$count++;	
		}
		@mysqli_free_result($rs);
		return 	$dataTable;	
	}	
			
		function fetchSingleRow($qry)
	{
		$row		=	array();
		$rs			=	mysqli_query($this->DatabaseLink,$qry);
		if($rs	===	FALSE)
			return $row;
				
		$row		=	mysqli_fetch_array($rs);
		mysqli_free_result($rs);
		return $row;	
	}
	function fetchSingleAssocRow($qry)
	{
		$row		=	array();
		$rs			=	mysqli_query($this->DatabaseLink,$qry);
		if($rs	===	FALSE)
			return $row;
				
		$row		=	mysqli_fetch_assoc($rs);
		mysqli_free_result($rs);
		return $row;	
	}

	function pagenostring($qry,$start,$limit)
	{
		$linklimit	=	10;
		$Q_rs	=	@mysql_query($qry);
		$noofrows	=	@mysql_num_rows($Q_rs);
		
		$no_of_pages	=	$noofrows/$limit;
		$no_of_pages	=	ceil($no_of_pages);
		$str='&nbsp;';
		
		if($no_of_pages<=$linklimit)
		{
			for($i=0;$i<$no_of_pages;$i++)
			{
				if(($i*$limit)==$start)
					$str=$str.($i+1);
				else
					$str=$str.'&nbsp;<a class="font1" href="#" onClick="_submit('.$i*$limit.');">'.(1+$i).'</a>&nbsp;';
			}
			return($str);
		}
		else
		{
			if($start==0)
			{
				$istart	=	0;
				$iend	=	$linklimit;
			}
			else
			{
				if((($start/$limit)-$linklimit)<0)
					$istart	=	0;
				else
					$istart	=	($start/$limit)-($linklimit-1);
				if((($start/$limit)+$linklimit)>$no_of_pages)
					$iend	=	$no_of_pages;
				else
					$iend	=	($start/$limit)+$linklimit;
			}
			for($i=$istart;$i<$iend;$i++)
			{
				if(($i*$limit)==$start)
					$str=$str.($i+1);
				else
					$str=$str.'&nbsp;<a href="#" class="contant" onClick="_submit('.$i*$limit.');">'.(1+$i).'</a>&nbsp;';
			}
			return($str);
					
		}
	}
	
function sentence_case($string) {
    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
    $new_string = '';
    foreach ($sentences as $key => $sentence) {
        $new_string .= ($key & 1) == 0?
            ucfirst(strtolower(trim($sentence))) :
            $sentence.' ';
    }
    return trim($new_string);
}	
	
function limit_text($text,$news_limit )
{
  if( strlen($text)>$news_limit )
  {
    $text = substr( $text,0,$news_limit);
    $text = substr( $text,0,-(strlen(strrchr($text,' '))));
	$text =$text.'...';
  }
else
  {
  $text = $text;
  }
  return $text;
}
function convert_date($date){
	
	$newdate	= explode("-",$date);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
	
	$c_date		= $year."-".$month."-".$date;
	return $c_date;
	
}


############## Manage  Category Starts  ##################	 jeshina
function show_all_category()
	{
	
		$qrypdt		=	"select * from tbl_menumaincategory  order by mmy_maincategoryid  ";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		//echo $qrypdt;
		//print_r( $mquery);die();
		return $mquery;
	}
function show_category_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menumaincategory where mmy_maincategoryid='$id'  and mmy_active='Y'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
function show_category_view_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menumaincategory where mmy_maincategoryid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  Category  Ends  ##################

############## Manage  Sub Category Starts  ##################	 jeshina
function show_all_subcategory()
	{
	
		$qrypdt		=	"select * from tbl_menusubcategory  order by msy_subcategoryid  ";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		//echo $qrypdt;
		//print_r( $mquery);die();
		return $mquery;
	}
function show_subcategory_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menusubcategory where msy_subcategoryid='$id'  and msy_active='Y'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
function show_subcategory_view_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menusubcategory where msy_subcategoryid='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  Sub Category  Ends  ##################

############## Manage  Sub Category Starts  ##################	 jeshina
function show_menu_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menumaster where mr_menuid='$id' and mr_active='Y' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  Sub Category  Ends  ##################

############## Manage  Sub Category Starts  ##################	 jeshina
function show_menu_wholeful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_menumaster where mr_menuid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  Sub Category  Ends  ##################


############## Manage  master Starts  ##################	 jeshina
function show_mastertable_ful_details($tbid,$flr)
	{//`tbl_tablemaster`(`tr_tableid`, `tr_branchid`, `tr_floor`, `tr_tableno`, `tr_status`)
		$cqrycat	=	"SELECT * FROM tbl_tablemaster where tr_tableno='$tbid' and  tr_floor='$flr'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
function show_mastertable_details($tbid)
	{//`tbl_tablemaster`(`tr_tableid`, `tr_branchid`, `tr_floor`, `tr_tableno`, `tr_status`)
		$cqrycat	=	"SELECT * FROM tbl_tablemaster where tr_tableid='$tbid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  master  Ends  ##################




############## Manage  master Starts  ##################	 jeshina
function show_masterstaff_details($stid)
	{
		$cqrycat	=	"SELECT * FROM tbl_staffmaster where ser_staffid='$stid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  master  Ends  ##################

############## Manage  room master Starts  ##################	 jeshina
function show_masterroom_details($stid)
	{
		$cqrycat	=	"SELECT * FROM tbl_roommaster where rm_roomid='$stid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  room master  Ends  ##################
############## Manage  corporate master Starts  ##################	 jeshina
function show_mastercorporate_details($stid)
	{
		$cqrycat	=	"SELECT * FROM tbl_corporatemaster where ct_corporatecode='$stid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  corporate master  Ends  ##################

############## Manage  loyality master Starts  ##################	 jeshina
function show_masterloyality_details($stid)
	{
		$cqrycat	=	"SELECT * FROM tbl_loyalty_reg where ly_id='$stid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

############## Manage  loyality master  Ends  ##################


############## Manage  portion Starts  ##################	 jeshina
function show_portion_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_portionmaster where pm_id='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  Sub Category  Ends  ##################
###################Extra Tax start##########################
        
  function show_tax_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_extra_tax_master where amc_id='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}      
#########################Extra Tax End################################# Bhavya       
############## Manage  preference Starts  ##################	 jeshina
function show_prefernce_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_preferencemaster where pmr_id='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
        function show_prefernce_ful_details1($id)
	{
		$cqrycat	=	"SELECT * FROM  tbl_language_preference where 	l_pref_id='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  Sub Category  Ends  ##################
############## Manage  branch Starts  ##################	 jeshina
function show_branch_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_branchmaster where be_branchid='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  branch  Ends  ##################

############## Manage  Ingredient Starts  ##################	 jeshina

function show_ingredient_ful_details($id)
{
	$cqrycat	=	"SELECT * FROM tbl_ingredientmaster where ir_ingredientid='$id' ";
    $cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
    return $cdatacat;
}

 ############## Manage  Ingredient  Ends  ##################

############## Manage  Module Starts  ##################	 jeshina
//`tbl_usermodules`(`um_username`, `um_moduleid`, `um_submoduleid`, `um_access`)
function show_usermodule_ful_details($id,$user)
{
	$cqrycat	=	"SELECT * FROM tbl_usermodules where um_moduleid='$id' and um_username='$user' ";
    $cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
    return $cdatacat;
}
function show_usersubmodule_ful_details($id,$user,$sub)
{
	$cqrycat	=	"SELECT * FROM tbl_usermodules where um_moduleid='$id' and um_username='$user' and um_submoduleid='$sub' ";
    $cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
    return $cdatacat;
}
/*function show_submodule_ful_details($id)
{
	$cqrycat	=	"SELECT * FROM tbl_usermodules where um_submoduleid='$id' ";
    $cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
    return $cdatacat;
}
*/

 ############## Manage  Module  Ends  ##################
############## User Report Permission start############################
function show_userreport_ful_details($id,$user)
{
	$cqrycat	=	"SELECT * FROM tbl_user_reports where ur_reportid='$id' and ur_userid='$user' ";
    $cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
    return $cdatacat;
}

############## User Report Permission end############################ Bhavya





############## Manage  branch Starts  ##################	 jeshina
function show_login_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_logindetails where ls_username='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	

############## Manage  branch  Ends  ##################


############## Manage upload id Starts  ##################	 jeshina
function getEpoch()

{

	$date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

	return $dateDiff;

} 

############## Manage upload id  Ends  ##################


  function show_floor_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_floormaster where fr_floorid='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	 function show_tabledetails_ful($id,$pref)
	{
		$cqrycat	=	"SELECT * FROM tbl_tabledetails where ts_tableid='$id'  and  ts_tableidprefix='$pref'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	 function show_tabledetails_total($id,$tbid)
	{
		$cqrycat	=	"SELECT * FROM tbl_tabledetails where ts_orderno='$id'  and ts_tableid='$tbid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	function show_tableid_retieve($name)
	{
		$cqrycat	=	"SELECT * FROM tbl_tablemaster where tr_tableno='$name'  ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	

 function show_billdetails_ful($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_tablebillmaster where bm_billno='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
function show_kotcounter_ful($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_kotcountermaster where kr_kotcode='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}





############## High light  ################## xpat
function highlightkeyword($str, $search) {
    $highlightcolor = "#FFF";
    $occurrences = substr_count(strtolower($str), strtolower($search));
    $newstring = $str;
    $match = array();
 
    for ($i=0;$i<$occurrences;$i++) {
        $match[$i] = stripos($str, $search, $i);
        $match[$i] = substr($str, $match[$i], strlen($search));
        $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', ($newstring));
    }
 
    $newstring = str_replace('[#]', '<span style="color: '.$highlightcolor.'; background:#890000">', $newstring);
    $newstring = str_replace('[@]', '</span>', $newstring);
    return $newstring;
 
}
############## High light  ##################






############## Manage space  Starts  ##################
function insert_underscore($s)
{
	$sub = str_replace(' ','-',$s);
	$s_ex=explode("--",$sub); $ct=count($s_ex);
	if($ct)
	{
		$sub = str_replace('--','-',$sub);
		$s_ex1=explode("--",$sub); $ct1=count($s_ex);
		if($ct1)
		{
			$sub = str_replace('--','-',$sub);
		}

	}
	$sub = str_replace('\'','',$sub);
	$sub=strtolower($sub);
	return $sub;
}
############## Manage content  Ends  ##################
############## Manage Country  Details starts ##################      Ambili
function show_country_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_country where cy_countyid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
############## Manage Country Details  Ends  ##################	 

############## Manage State Details  starts  ##################	 Ambili


function show_state_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_state where se_stateid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	############## Manage State Details  Ends  ##################	

############## Manage City Details  Starts  ##################	 Ambili

	function show_city_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_city where cy_cityid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
############## Manage City Details  Ends  ##################	
############## Manage City Details  Starts  ##################	 Ambili

	function show_headofc_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_headoffice where he_officeid='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
############## Manage City Details  Ends  ##################	

function show_manage_stock($id)
	{//`tbl_menustock`(`mk_menuid`, `mk_date`, `mk_stock`) 
		$cqrycat	=	"SELECT * FROM `tbl_menustock` where `mk_menuid`='$id' and `mk_date`='".$_SESSION['date']."'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
function show_portion_short_ful_details($id)
	{
		$cqrycat	=	"SELECT * FROM tbl_portionmaster where pm_portionshortcode='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	function show_tableorder_ful_details($id)
	{
		 $cqrycat	=	"SELECT * FROM tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn ON to1.ter_menuid=mn.mr_menuid  where ter_orderno='$id' "; 
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	function show_kotmaster($id)
	{//`tbl_kotmaster`(`kr_date`, `kr_kotno`, `kr_print`, `kr_firstprint`, `kr_lastprint`)
		$cqrycat	=	"SELECT * FROM `tbl_kotmaster` where `kr_kotno`='$id' and `kr_date`='".$_SESSION['date']."'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	function show_kotmaster_list($id)
	{//`tbl_kotmaster`(`kr_date`, `kr_kotno`, `kr_print`, `kr_firstprint`, `kr_lastprint`)
		$cqrycat	=	"SELECT * FROM `tbl_kotmaster` where `kr_kotno`='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
	function show_customer_list($id)
	{//`tbl_kotmaster`(`kr_date`, `kr_kotno`, `kr_print`, `kr_firstprint`, `kr_lastprint`)
		$cqrycat	=	"SELECT * FROM `tbl_takeaway_customer` where `tac_customerid`='$id'";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}

function updateexpodine_machines()
{
	$this->mysqlQuery("UPDATE tbl_expodine_machines SET cm_xml_update_found = 'Y',cm_xml_update_from_link = '".$_SESSION['finalpath']."src/',cm_xml_update_found_time = now() where trim(cm_ip_address) != trim('".$_SESSION['hostnameorg']."')");  
}
	################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 2; 
        $previous       = $current_page - 2; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)? 1: $previous;
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active"><a href="#">'.$current_page.'</a></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active"><a href="#">'.$current_page.'</a></li>';
        }else{ //regular current link
            $pagination .= '<li class="active"><a href="#">'.$current_page.'</a></li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}


function sheetData($sheet,$type) {
	$xml = simplexml_load_file($_SESSION['s_xmlfilelocation']);
	$x = 1;
	while($x <= $sheet['numRows']) {
	  $y = 1;
	  if($type=="kot")
	  {
		  $id='';$kotname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $kotname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($kotname=='')
				  {
					  $child = $xml->kotcounter[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->kotcounter[1]->addChild($id,$kotname);
				  }	  
		 
			}
	  }
          if($type=="cat")
	  {
		  $id='';$categoryname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $categoryname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($categoryname=='')
				  {
					  $child = $xml->category[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->category[1]->addChild($id,$categoryname);
				  }	 	  
		  
			}
	  }
          if($type=="subcat")
	  {
		  $id='';$subcatname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $subcatname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	
			if($subcatname=='')
				  {
					  $child = $xml->subcategory[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->subcategory[1]->addChild($id,$subcatname);
				  }	  
		  
			}
	  }
          if($type=="portion")
	  {
		  $id='';$portionname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $portionname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($portionname=='')
				  {
					  $child = $xml->portion[1]->addChild("pm_".$id," ");
				  }else
				  {
						$child = $xml->portion[1]->addChild("pm_".$id,$portionname);
				  }	 
		  
			}
	  }
          if($type=="menu")
	  {
		  $id='';$menuname='';$shtcode=''; $itmshtcode=''; $desc=''; $diet=''; $prep='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $menuname=$sheet['cells'][$x][3];
			  }
			  if($sheet['cells'][$x][5])
			  {
				  $shtcode=$sheet['cells'][$x][5];
			  }
			  if($sheet['cells'][$x][7])
			  {
				  $itmshtcode=$sheet['cells'][$x][7];
			  }
			  if($sheet['cells'][$x][9])
			  {
				  $desc=$sheet['cells'][$x][9];
			  }
			  if($sheet['cells'][$x][11])
			  {
				  $diet=$sheet['cells'][$x][11];
			  }
			  if($sheet['cells'][$x][13])
			  {
				  $prep=$sheet['cells'][$x][13];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($menuname=='')
				  {
					 $child = $xml->menu[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->menu[1]->addChild($id,$menuname);
				  }	 
		  
		  if($shtcode=='')
				  {
					 $child = $xml->menu[1]->addChild("shortc_".$id," ");
				  }else
				  {
						$child = $xml->menu[1]->addChild("shortc_".$id,$shtcode);
				  }	 
		  
		  if($itmshtcode=='')
				  {
					   $child = $xml->menu[1]->addChild("itemc_".$id," ");
				  }else
				  {
						 $child = $xml->menu[1]->addChild("itemc_".$id,$itmshtcode);
				  }	 
		 
		  if($desc=='')
				  {
					  $child = $xml->menu[1]->addChild("desc_".$id," ");
				  }else
				  {
						$child = $xml->menu[1]->addChild("desc_".$id,$desc);
				  }	 
		  
		  if($diet=='')
				  {
					  $child = $xml->menu[1]->addChild("diet_".$id," ");
				  }else
				  {
						$child = $xml->menu[1]->addChild("diet_".$id,$diet);
				  }	 
		  
		  if($prep=='')
				  {
					  $child = $xml->menu[1]->addChild("prep_".$id," ");
				  }else
				  {
						$child = $xml->menu[1]->addChild("prep_".$id,$prep);
				  }	 
		  
			}
	  }
          if($type=="floor")
	  {
		  $id='';$floorname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $floorname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($floorname=='')
				  {
					 $child = $xml->floormaster[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->floormaster[1]->addChild($id,$floorname);
				  }	  
		  
			}
	  }
          if($type=="table")
	  {
		  $id='';$tablename='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $tablename=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($tablename=='')
				  {
					 $child = $xml->tablemaster [1]->addChild($id," ");
				  }else
				  {
						$child = $xml->tablemaster [1]->addChild($id,$tablename);
				  }	 
		  
			}
	  }
          
      /*    if($type=="bank")
	  {
		  $id='';$bankname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $bankname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
		  $child = $xml->menu[1]->addChild($id,$bankname);
			}
	  }*/
       /*   if($type=="feedback")
	  {
		  $id='';$feedbackname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $feedbackname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
		  $child = $xml->menu[1]->addChild($id,$feedbackname);
			}
	  }*/
           if($type=="pref")
	  {
		  $id='';$prefname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $prefname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($prefname=='')
				  {
					 $child = $xml->preference[1]->addChild("pmr_".$id," ");
				  }else
				  {
						$child = $xml->preference[1]->addChild("pmr_".$id,$prefname);
				  }		  
		  
			}
	  }
	  if($type=="staff")
	  {
		  $id='';$staffname='';$laststaffname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $staffname=$sheet['cells'][$x][3];
			  }
			  if($sheet['cells'][$x][5])
			  {
				  $laststaffname=$sheet['cells'][$x][5];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($staffname=='')
				  {
					 $child = $xml->staffmaster[1]->addChild("First_".$id," ");
				  }else
				  {
						$child = $xml->staffmaster[1]->addChild("First_".$id,$staffname);
				  }	
		  
		  if($laststaffname=='')
				  {
					  $child = $xml->staffmaster[1]->addChild("Last_".$id," ");
				  }else
				  {
						 $child = $xml->staffmaster[1]->addChild("Last_".$id,$laststaffname);
				  }	
		 
			}
	  }
          
          if($type=="discount")
	  {
		  $id='';$discountname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $discountname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	 
			if($discountname=='')
				  {
					  $child = $xml->discount[1]->addChild($id," ");
				  }else
				  {
						 $child = $xml->discount[1]->addChild($id,$discountname);
				  }	 
		 
			}
	  }
          if($type=="corp")
	  {
		  $id='';$corpname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $corpname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($corpname=='')
				  {
					   $child = $xml->corporate[1]->addChild($id," ");
				  }else
				  {
						  $child = $xml->corporate[1]->addChild($id,$corpname);
				  }		  
		 
			}
	  }
          if($type=="voucher")
	  {
		  $id='';$vouchername='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $vouchername=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($vouchername=='')
				  {
					   $child = $xml->voucher[1]->addChild($id," ");
				  }else
				  {
						 $child = $xml->voucher[1]->addChild($id,$vouchername);
				  }	
		  
			}
	  }
	   if($type=="bank")
	  {
		  $id='';$branchname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $branchname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($branchname=='')
				  {
					    $child = $xml->bankmaster[1]->addChild("bm_".$id," ");
				  }else
				  {
						  $child = $xml->bankmaster[1]->addChild("bm_".$id,$branchname);
				  }	
		 
			}
	  }
	   if($type=="feedback")
	  {
		  $id='';$branchname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $branchname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($branchname=='')
				  {
					    $child = $xml->feedback[1]->addChild($id," ");
				  }else
				  {
						  $child = $xml->feedback[1]->addChild($id,$branchname);
				  }		  
		  
			}
	  }
          if($type=="branch")
	  {
		  $id='';$branchname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $branchname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($branchname=='')
				  {
					    $child = $xml->branchmaster[1]->addChild($id," ");
				  }else
				  {
						 $child = $xml->branchmaster[1]->addChild($id,$branchname);
				  }			  
		 
			}
	  }
          if($type=="department")
	  {
		  $id='';$departmentname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $departmentname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($departmentname=='')
				  {
					   $child = $xml->department[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->department[1]->addChild($id,$departmentname);
				  }		  
		  
			}
	  }
          if($type=="designation")
	  {
		  $id='';$designationname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $designationname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{
				if($designationname=='')
				  {
					   $child = $xml->designation[1]->addChild($id," ");
				  }else
				  {
						$child = $xml->designation[1]->addChild($id,$designationname);
				  }		  
		  
			}
	 
         }
          if($type=="nutrition")
	  {
		  $id='';$nutname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $nutname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($nutname=='')
				  {
					   $child = $xml->nutrition[1]->addChild("nutr_".$id," ");
				  }else
				  {
						$child = $xml->nutrition[1]->addChild("nutr_".$id,$nutname);
				  }	
		  
			}
	  }  
	   if($type=="ing")
	  {
		  $id='';$ingname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $ingname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($ingname=='')
				  {
					  $child = $xml->ingredient[1]->addChild("ir_".$id," ");
				  }else
				  {
						$child = $xml->ingredient[1]->addChild("ir_".$id,$ingname);
				  }	
		  
			}
	  } 
	   if($type=="coupon")
	  {
		  $id='';$couponname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $couponname=$sheet['cells'][$x][3];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($couponname=='')
				  {
					  $child = $xml->coupon[1]->addChild("coup_".$id," ");
				  }else
				  {
						$child = $xml->coupon[1]->addChild("coup_".$id,$couponname);
				  }	
		  
			}
	  }  
	  if($type=="payment")
	  {
		  $id='';$paymentcode='';$paymentname='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $paymentcode=$sheet['cells'][$x][3];
			  }if($sheet['cells'][$x][5])
			  {
				  $paymentname=$sheet['cells'][$x][5];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	  
			if($paymentcode=='')
				  {
					   $child = $xml->paymentmode[1]->addChild("pcode_".$id," ");
				  }else
				  {
						 $child = $xml->paymentmode[1]->addChild("pcode_".$id,$paymentcode);
				  }	
		 
		  if($paymentname=='')
				  {
					 $child = $xml->paymentmode[1]->addChild("pname_".$id," ");
				  }else
				  {
						$child = $xml->paymentmode[1]->addChild("pname_".$id,$paymentname);
				  }	
		   
			}
	  }  if($type=="credit")
	  {
		  $id='';$credittype='';$credtilabel='';
		  while($y <= $sheet['numCols']) {
			  if($sheet['cells'][$x][1])
			  {
				  $id=$sheet['cells'][$x][1];
			  }
			  if($sheet['cells'][$x][3])
			  {
				  $credittype=$sheet['cells'][$x][3];
			  }if($sheet['cells'][$x][5])
			  {
				  $credtilabel=$sheet['cells'][$x][5];
			  }
			$y++;
		  } 
		  if($_SESSION['langauage_upload']=="arabic")
			{	 
			if($credittype=='')
				  {
					 $child = $xml->credittypes[1]->addChild("ctype_".$id," ");
				  }else
				  {
						$child = $xml->credittypes[1]->addChild("ctype_".$id,$credittype);
				  }	 
		  
		  if($credtilabel=='')
				  {
					$child = $xml->credittypes[1]->addChild("clabel_".$id," ");
				  }else
				  {
						$child = $xml->credittypes[1]->addChild("clabel_".$id,$credtilabel);
				  }	
		  
			}
	  }    
          
	  $x++;
	}
	$xml->asXML($_SESSION['s_xmlfilelocation']); 
}
function delete_nodes($tagid,$tagname, $fileName,$maintagname) {
        //delete from xml
        $xml = new DOMDocument();
        $xml->load($fileName);
        $users = $xml->getElementsByTagName($maintagname);
        foreach ($users as $item) {
			if($item->childNodes->length) { 
				  foreach($item->childNodes as $i) { 
					  if($i->nodeName==$tagid)
					  {
						  if($i->nodeValue==$tagname)
						  {
						  $item->removeChild($i);
						  }
					  }
				  } 
			  } 
        }
        $xml->save($fileName);
    }
function deletexml_fields($worksheetName,$field1,$field2)
	{
		$inputFileType = 'Excel5';
		$inputFileName = $_SESSION['s_excelfilelocation'];
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			  $worksheetTitle     = $worksheet->getTitle();
			  $highestRow         = $worksheet->getHighestRow(); // e.g. 10
			  $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
			  $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			  if($worksheetTitle==$worksheetName)
			  {
				   for ($row = 1; $row <= $highestRow; ++ $row) {
						 $col=0;
						  $cell = $worksheet->getCellByColumnAndRow($col, $row);
						  $val = $cell->getValue();
						  $col=1;
						  $cell = $worksheet->getCellByColumnAndRow($col, $row);
						  $val2 = $cell->getValue();
						  if($val==$field1 && $val2==$field2)
						  {
							  $worksheet->removeRow($row);
						  }
				  }
			  }
		}
	  $xlsx = new PHPExcel_Writer_Excel5($objPHPExcel);
	  $xlsx->save($_SESSION['s_excelfilelocation']);
	}	
}
?>