<?php

session_start();
//error_reporting(0);
include("database.class.php"); 
$database	= new Database();
$floor_id_new="";
if(isset($_REQUEST['set_add_load_floor'])&& ($_REQUEST['set_add_load_floor']=='add_load_floor')){
    
$floor_id_new=$_REQUEST['floor_id_tax'];
?>
<?php
                                         
$sql_login_fl1 = $database->mysqlQuery("select *,amc_name from tbl_floor_tax tf left join tbl_extra_tax_master te on te.amc_id=tf.ft_tax_id where tf.ft_floorid='".$floor_id_new."'");
$num_login_fl1 = $database->mysqlNumRows($sql_login_fl1);
if ($num_login_fl1) {
    while ($result_login_fl1 = $database->mysqlFetchArray($sql_login_fl1)) {
        ?>
                            <tr>
               			<td><?=$result_login_fl1['amc_name']?></td>
                                <td><a onclick="return delete_tax('<?=$result_login_fl1['ft_floorid']?>','<?=$result_login_fl1['ft_tax_id']?>');" href="#"><img src="img/delete_btn_2.png"></a></td>
                                </tr>
                                <?php } } ?>

<?php } ?>