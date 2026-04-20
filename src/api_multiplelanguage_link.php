<?php

                        $sql_apilink = $database->mysqlQuery("select be_appstring from tbl_branchmaster");
                        $num_apilink = $database->mysqlNumRows($sql_apilink);
                        if ($num_apilink) {
                        $result_apilink = $database->mysqlFetchArray($sql_apilink);                              
                        $apilink = $result_apilink['be_appstring'];
                         }

?>
