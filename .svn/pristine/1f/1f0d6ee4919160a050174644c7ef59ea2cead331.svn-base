<?php

session_start();

include("database.class.php");// DB Connection class
$database	= new Database();

$string="";

$string.=" where mk_id !='' ";



if(isset($_REQUEST['menusearch_status'])&&($_REQUEST['menusearch_status']=="Y" || $_REQUEST['menusearch_status']== "N")){
    
    $menusearch_status=$_REQUEST['menusearch_status'];
     
    $string.=" and mk_stock='".$menusearch_status."' ";
}

if(isset($_REQUEST['menusearch_word'])&& $_REQUEST['menusearch_word']!="")
{ 
   $menusearch_word=$_REQUEST['menusearch_word'];
   
   $string.=" and mr.mr_menuname LIKE '%".$menusearch_word."%' ";
}

if(isset($_REQUEST['menu_stock_no'])&& $_REQUEST['menu_stock_no']!="")
{ 
   $menu_daily_stock_in_no=$_REQUEST['menu_stock_no'];
 
   $string.=" and mr.mr_dailystock_in_number='".$menu_daily_stock_in_no."' ";
}


if(isset($_REQUEST['menusearch_maincat']) && ($_REQUEST['menusearch_maincat']!='null')){
    
    $menusearch_maincat=$_REQUEST['menusearch_maincat'];
    
    $string.=" and mmc.mmy_maincategoryid='".$menusearch_maincat."'";   
   
}

if(isset($_REQUEST['menusearch_subcat']) && ($_REQUEST['menusearch_subcat']!='null')){
    $menusearch_subcat=$_REQUEST['menusearch_subcat'];
    
    $string.=" and msc.msy_subcategoryid='".$menusearch_subcat."'";   
    

}
 
$pagination=0;
$recordcount="";
if(isset($_REQUEST['pagination']))
{
    
$pagination= $_REQUEST['pagination'];
$recordcount=$_REQUEST['recordcount'];

}
?>

<table class="responstable " id="listall">
                                        
                                        
                                            <thead>
                                                <tr>
                                                    <th style="min-width:40px" width="5%" class="header">Action</th>
                                                    <th style="min-width:30px" width="5%" class="header">Sl No</th>
                                                    <th style="min-width: 100px;display: none" width="7%" class="header">Date</th>
                                                    <th width="18%" class="header">Item</th>
                                                    <th width="15%" class="header">Unit</th>
                                                    <th width="10%" class="header">Main Category </th>
                                                    <th width="10%" class="header">Ref ID </th>
                                                    <th width="8%" class="header">Opening Stock </th>
                                                    <th width="8%" class="header">Added Stock</th>
                                                    <th width="8%" class="header">Stock Number</th>
                                                    <th style="min-width:60px" width="8%" class="header">Sold </th>
                                                    <th style="min-width:30px" width="8%" >Stock</th>
                                                    <th style="display:none"  width="15%" class="header">Stock Time</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                <?php
                                       
                                $sql_login  =  $database->mysqlQuery("select mk_added_stock_total,mk_open_stock_date,mk_opening_stock,bu_name,"
                                . " u_name,pm_portionname,mk_menuid,msc.msy_subcategoryname,mmc.mmy_maincategoryname,mk_stock,mk_stocktime,"
                                . " mk_stock_number,mk_date,mr.mr_menuname,mr.mr_dailystock_in_number,mk_portion,mk_unit_type,mk_base_unit_id,"
                                . " mk_unit_id,mk_unit_weight from tbl_menustock left join tbl_portionmaster tp on tp.pm_id=mk_portion left join "
                                . " tbl_base_unit_master on bu_id=mk_base_unit_id left join tbl_unit_master on u_id=mk_unit_id "
                                . " LEFT JOIN tbl_menumaster mr on mr.mr_menuid=mk_menuid left join tbl_menumaincategory as mmc on "
                                . " mmc.mmy_maincategoryid=mr.mr_maincatid left join tbl_menusubcategory as msc "
                                . " on msc.msy_subcategoryid=mr.mr_subcatid  ".$string."  and mr.mr_delete_mode='N'"
                                . " order by mr.mr_menuname ASC LIMIT ". $pagination.",75"); 
                         $num_login   = $database->mysqlNumRows($sql_login);
                         if($num_login){
                            if($recordcount!=""){
                                
                                $i=$recordcount;
                                
                            }else{
                                
                                $i=1;
                            }
                        while($result_login  = $database->mysqlFetchArray($sql_login)) 
                            {
                            
                                $ordered_portion='';  $portion_check='';
                                
                                if($result_login['mk_unit_type']==''){
                                    
                                     $ordered_portion=$result_login['pm_portionname'];
                                     $portion_check='single';
                                     
                                }else if($result_login['mk_unit_type']=='Packet'){
                                    
                                    $ordered_portion=$result_login['mk_unit_type'].' : '.number_format($result_login['mk_unit_weight'],$_SESSION['be_decimal']).' '.$result_login['u_name'];
                                    $portion_check='pack';
                                    
                                }else if($result_login['mk_unit_type']=='Loose'){
                                    
                                     $ordered_portion=$result_login['mk_unit_type'].' : '.number_format($result_login['mk_unit_weight'],$_SESSION['be_decimal']).' '.$result_login['bu_name'];
                                     $portion_check='loose';
                                     
                                }
                                
				
                          ?>
                                                
                            <tr id="ids_<?=$i?>_<?=$result_login['mk_menuid']?> " class="clicktoview" >
                                
                             <?php if(($result_login['mk_open_stock_date']==$_SESSION['date'] && $result_login['mk_opening_stock']>0) || $portion_check!='single' ) { ?>
                                
                                <td style="min-width:42px" title="Edit Not Possible" width="5%" ><div style="display:block"  > <a class="tab_edt_btn md-trigger_edit"   ><i class="fa fa-lock"  ></i></a></div>     
                                 
                              <?php } else{ ?>
                               
                                <td style="min-width:42px" width="5%" ><div style="display:block" id="editbutton<?=$result_login['mk_menuid']?><?=$i?>" > <a class="tab_edt_btn md-trigger_edit stockedit" id="<?=$i?>"  ><i class="fa fa-edit" onclick=" return editstock('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$i?>','<?=$result_login['mr_dailystock_in_number']?>');" ></i></a></div>     
                               
                             <?php } ?>
                                    
                                <div style="display:none" id="savebutton<?=$result_login['mk_menuid']?><?=$i?>"><a class="tab_edt_btn md-trigger_edit stocksave " id="<?=$i?>" onclick="return savestock('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$result_login['mk_unit_type']?>','<?=$result_login['mk_unit_id']?>','<?=$result_login['mk_base_unit_id']?>','<?=$result_login['mk_unit_weight']?>','<?=$i?>','<?=$ordered_portion?>');"><i class="fa fa-save"></i></a></div></td>
                                
                                <td style="min-width:32px" width="5%" ><?=$i?></td>
                                <td style="display:none" width="7%"><?=$result_login['mk_date']?></td>
                                <td width="25%"><?=$result_login['mr_menuname']?></td>
                                <td width="7%"><?=$ordered_portion?></td>
                                <td width="10%"><?=$result_login['mmy_maincategoryname']?></td>
                                <td width="10%"><?=$result_login['mk_menuid']?></td>
                                
                                <td width="8%"><div style="display:block" id="stockquant_open<?=$result_login['mk_menuid']?><?=$i?>"><?=$result_login['mk_opening_stock']?></div><div style="display:none" id="stockquantedit_open<?=$result_login['mk_menuid']?><?=$i?>"><input maxlength="7" style="width:50%"  type="text" <?php if($result_login['mk_open_stock_date']==$_SESSION['date'] && $result_login['mk_opening_stock']>0 ) { ?> readonly  title="Edit Possible Only Once In A Day"   <?php } ?>  id="stockchangebox_open<?=$result_login['mk_menuid']?><?=$i?>" onkeypress="return numonly()"></div></td>
                                 
                                <td style="text-align: left !important;padding-left: 3px !important" width="8%"><?=$result_login['mk_added_stock_total']?>  <?php if($result_login['mk_opening_stock']>0) { ?> <a onclick="add_stock_click('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$result_login['mk_unit_type']?>','<?=$result_login['mk_unit_id']?>','<?=$result_login['mk_base_unit_id']?>','<?=$result_login['mk_unit_weight']?>','<?=$i?>','<?=$result_login['mr_menuname']?>','<?=$ordered_portion?>');"  style="float:right;margin-right: 5px;text-align: center"  class="stck_add_btn" href="#">+</a> <?php } ?> </td>
                                
                                <td width="8%"><div style="display:block" id="stockquant<?=$result_login['mk_menuid']?><?=$i?>"><?=$result_login['mk_stock_number']?></div><div style="display:none" id="stockquantedit<?=$result_login['mk_menuid']?><?=$i?>"><input readonly  type="text" maxlength="7"  style="width:50%"  id="stockchangebox<?=$result_login['mk_menuid']?><?=$i?>" onkeypress="return numonly()"></div></td>
                                
                                <td style="min-width:60px" width="8%"><?= (($result_login['mk_opening_stock']+$result_login['mk_added_stock_total'])-$result_login['mk_stock_number'])  ?></td>
                                
                            <td  width="8%"><div style="display:block" id="stockstatusdispaly<?=$result_login['mk_menuid']?><?=$i?>"><?php if($result_login['mk_stock']=='Y'){ ?>Yes<?php } else { ?> No <?php }?></div><div style="display:none" id="stockstatusedit<?=$result_login['mk_menuid']?><?=$i?>"><select class="add_text_box" id="status<?=$result_login['mk_menuid']?><?=$i?>"><option  value="Y">Yes</option><option value="N">No</option></select></div></td>
                               
                            <td style="display:none"  width="15%"><?=$result_login['mk_stocktime']?></td>
                                
                            </tr>
                            
                        <?php  $i++; } } ?>

                   </tbody>
                   </table>

