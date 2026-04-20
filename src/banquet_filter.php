<?php

include("database.class.php"); // DB Connection class
$database	= new Database();

if(isset($_REQUEST['type']) && ($_REQUEST['type']=='filter'))
{
    
    
    $arr = array();
    $from = date('Y-m-d',strtotime($_REQUEST['datefrom']));
    $to   = date('Y-m-d',strtotime($_REQUEST['dateto']));
    $banquetorder = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['banquetorder']));
    $ftype =  mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['ftype']));
    $name =  mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['name']));
    $search = "";

    if($banquetorder!="All")
    {
        if($search!="")
        {
            $search.=" and fd_reg_type ='".$banquetorder."'";
        }
        else
        {
            $search.=" fd_reg_type ='".$banquetorder."'";
        }
    }


    if($ftype!="Select")
     {
         if($search!="")
         {
             $search.=" and  fd_function_type = '".$ftype."'";
         }
         else
         {
             $search.=" fd_function_type = '". $ftype ."%'";
         }
     }

    if($name!="null")
     {
         if($search!="")
         {
             $search.=" and  fd_customer LIKE  '%" . $name ."%'";
         }
         else
         {
             $search.=" fd_customer LIKE  '%" . $name ."%'";
         }
     }

    if($search!="")
    {
        $search="where $search and ";
    }
    else
    {
        $search ="where ";
    }
    $reslt = "";

    $sql_bq  =  $database->mysqlQuery("select a.*,b.ft_name,c.fv_name from tbl_function_details a LEFT JOIN tbl_function_type b ON a.fd_function_type=b.ft_id LEFT JOIN tbl_function_venue c ON a.fd_venue=c.fv_id $search  `fd_date` BETWEEN '$from' AND '$to' and fd_id NOT LIKE '%temp_%'  ORDER BY fd_id DESC");
    $num_bq  = $database->mysqlNumRows($sql_bq);
    if($num_bq)
    {
        while ($result_cat_s = $database->mysqlFetchArray($sql_bq))
        {
//            $arr[] = $result_cat_s;
            if($result_cat_s['fd_status']=='Invoiced')
            {
                $edit =  "disablegenerate";
            }
            else{
                $edit= "";
            }
            $id = "'".$result_cat_s['fd_id']."'";

            $reslt .= '<tr>';

            
            
             
            
$reslt .= '<td>  <a href="print_function_list.php?functionid='.$id.'" name="print_list" target="_blank" id="print_list" class="md-trigger_cat edit_list '.$edit.'" onClick="return fn_printlist("'.$id.'");"> <img src="img/printer_new.PNG"></a>'
. '       <a href="#" name="edit_list" id="edit_list" class="md-trigger_cat edit_list '.$edit.'" onClick="return fn_editlist('.$id.');">
                     <img src="images/edit_page.PNG"></a><a href="#" id="delete_list" class="'.$edit.'" name="delete_list" onClick="return cancelstatus('.$id.');">
                     <img src="img/black_cross.png" width="25px" height="25px"></a>
                     <span class="'.$edit.'">
                     <a href="banquet_invoice.php?id='.$result_cat_s["fd_id"].'"><span class="banq_view_btn">Generate</span></a>
                     </td>';
            $reslt .= '<td>'.$result_cat_s['fd_id'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_reg_type'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_date'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_customer'].'</td>';
            $sqllogin  =  $database->mysqlQuery("select *  from tbl_function_invoice where  fi_function_id='".$result_cat_s['fd_id']."'");
            $numlogin   = $database->mysqlNumRows($sqllogin);
            if($numlogin) {

                while ($resultlogin = $database->mysqlFetchArray($sqllogin)) {
                    $idd = $resultlogin['fi_invoice_no'];
                    $idf = $resultlogin['fi_function_id'];
                    $reslt .= "<td> <a href='invoice_preview.php?value=inv&idinbq=$idf&dup=(Duplicate Copy)' target='_blank'> ".$resultlogin['fi_invoice_no']."</td>";
                }
            }   
            else
            {
                $reslt .= '<td></td>';
            }
            $reslt .= '<td>'.$result_cat_s['fd_time'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_landline'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_email'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_contact_person'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_mobile_1'].'</td>';
            $reslt .= '<td>'.urlencode($result_cat_s['fd_session']).'</td>';
            $reslt .= '<td>'.$result_cat_s['ft_name'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fv_name'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_billing_type'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_no_of_pax'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_per_head_cost'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_address'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_remarks'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_status'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_total_rate'].'</td>';
            $reslt .= '<td>'.$result_cat_s['fd_advance_given'].'</td>';
            $reslt .= '<tr>';
        }
    }
  echo $reslt.'+';
}
?>