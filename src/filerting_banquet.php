<html>
<div class="main_banquet_contant" style="padding-top:0" id="del_ff">
    <div id="left_table_scr_cc">
        <table class="responstable">
            <thead>
            <tr>
                <th >Action</th>
                <th width="5%">Date of Function</th>
                <th width="5%">Time</th>
                <th width="8%">Name </th>
                <th width="25%">Phone Number</th>
                <th width="18%">Email </th>
                <th width="18%">Contact Person  </th>
                <th width="5%">Mobile Number </th>
                <th width="10%">Location</th>
                <th width="10%">No of Pax</th>
                <th width="10%">Function Type</th>
                <th width="9%">Session</th>
                <th width="9%">Venue</th>
                <th width="9%">Address</th>
                <th style="min-width:500px;">Remarks</th>
                <th style="min-width:500px;">Menus</th>
                <th width="9%">Tottal</th>
            </tr>
            </thead>
            <?php

            $frmdate = $_GET['datefrom']; echo $frmdate;
            $todate = $_GET['dateto'];
            $banquet_filter = $_GET['bnquet_filter'];
            $phone_filter = $_GET['filter_phone'];
            $name_filter = $_GET['filter_name'];
            $ftype_filter = $_GET['filter_ftype']; exit();

            $sql_login  =  $database->mysqlQuery("select a.*,b.ft_name,c.fv_name from tbl_function_details a LEFT JOIN tbl_function_type b ON a.fd_function_type=b.ft_id LEFT JOIN tbl_function_venue c ON a.fd_venue=c.fv_id ORDER BY fd_id ASC");
            //echo "select * from tbl_function_details  LEFT JOIN  tbl_function_type ON tbl_function_details.fd_id=tbl_function_type.ft_id LEFT JOIN tbl_function_venue ON tbl_function_details.fd_id=tbl_function_venue.fv_id";
            $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
                while($result_login  = $database->mysqlFetchArray($sql_login))
                {
                    $id = $result_login['fd_id']; //echo $id;
                    $timestamp = $result_login['fd_time'];
                    $timez = date('H:i',strtotime($timestamp));
                    ?>
                    <tr>
                        <td>
                            <a href="#" name="edit_list" id="edit_list" class="md-trigger_cat edit_list" onclick="return fn_editlist(<?=$id?>);"><img src="images/edit_page.PNG"></a>
                            <a href="?id=<?=$id?>" id="delete_list" name="delete_list" <!--onclick="return delete_qry(<?/*=$id*/?>);-->"><img src="img/black_cross.png" width="25px" height="25px"></a>
                            <a href="banquet_invoice.php"><span class="banq_view_btn">Generate</span></a>
                        </td>
                        <td><?=$result_login['fd_date']?></td>
                        <td><?=$timez?></td>
                        <td><?=$result_login['fd_customer']?></td>
                        <td><?=$result_login['fd_landline']?></td>
                        <td><?=$result_login['fd_email']?></td>
                        <td><?=$result_login['fd_contact_person']?></td>
                        <td><?=$result_login['fd_mobile_1']?></td>
                        <td><?=$result_login['fd_address']?></td>
                        <td><?=$result_login['fd_no_of_pax']?></td>
                        <td><?=$result_login['ft_name']?></td>
                        <td><?=$result_login['fd_session']?></td>
                        <td><?=$result_login['fv_name']?></td>
                        <td><?=$result_login['fd_address']?></td>
                        <td><?=$result_login['fd_remarks']?></td>
                        <td><?=$result_login['fd_address']?></td>
                        <td><?=$result_login['fd_total_rate']?></td>
                    </tr>


                <?php } } ?>

            </tr>
            </tbody>
        </table>
    </div>
</div>
</html>