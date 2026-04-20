<?php
//include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();

/*$tbl_date = $database->mysqlQuery("SELECT fd_date FROM `tbl_function_details`");
$dateqry = $database->mysqlFetchArray($tbl_date);

$date = $dateqry['fd_date'];*/

?>

            <?php

            if($_SERVER["REQUEST_METHOD"]== "POST") {



               // $datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_function_type`,`fd_customer`, `fd_email`, `fd_mobile_1`,ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date` BETWEEN '".$from."' AND '".$to."' ");

                if ($_REQUEST['datefrom'] != "" && $_REQUEST['dateto'] != "") {
                    $from = date('Y-m-d',strtotime($_REQUEST['datefrom']));
                    $to = date('Y-m-d',strtotime($_REQUEST['dateto']));

                       //$datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_function_type`,`fd_customer`, `fd_email`, `fd_mobile_1`,ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date` BETWEEN '".$from."' AND '".$to."' ");
                       $datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_customer`, `fd_email`, `fd_mobile_1`,ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date` BETWEEN '$from' AND '$to'");


                   }
                elseif ($_REQUEST['datefrom'] != "" && $_REQUEST['dateto'] == "") {
                    $from = date('Y-m-d',strtotime($_REQUEST['datefrom']));
                       $to = date("Y-m-d");

                       //$datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_function_type`,`fd_customer`, `fd_email`, `fd_mobile_1`,ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date`='".$from."'");
                       $datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_customer`, `fd_email`, `fd_mobile_1`, ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date`='$from'");
                   }
                elseif ($_REQUEST['datefrom'] == "" && $_REQUEST['dateto'] != "") {
                       $from = date("Y-m-d");
                    $to = date('Y-m-d',strtotime($_REQUEST['dateto']));

                       $datebetween = $database->mysqlQuery("SELECT `fd_date`,`fd_customer`, `fd_email`, `fd_mobile_1`,ft.ft_name FROM `tbl_function_details` fd LEFT JOIN tbl_function_type ft ON fd.fd_function_type=ft.ft_id WHERE `fd_date`='".$to."'");

                   }
               $row2 = array();
                $num = $database->mysqlNumRows($datebetween);
                while($result = $database->mysqlFetchArray($datebetween))
                {
                    $row2[] = $result;
                     }
            echo json_encode($row2).'+';
            }?>

