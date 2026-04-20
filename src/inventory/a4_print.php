<style>td{padding:5px;font-family:sans-serif;font-size: 14px;}
</style>
<style>
@page { size: auto;  margin: 0mm; }
</style>
<div style="width: 92%;height: auto;float: left;padding: 2%;border: solid 1px #ccc;margin: 2%;"  >
    
    <span onclick="return ref_page();" id="ref_btn" style="border-radius: 5px;float: right;cursor: pointer;padding:5px 10px;color:#fff;display: none;background-color: #f3f3f3" ><a style="color:#fff;text-decoration:none;background-color: #f3f3f3" > <img src="../img/arrow-bt.png"  > </a></span>
    
  <?php  if(isset($_REQUEST['type']) && $_REQUEST['type']=='transfer_print'){ ?>
    <span id="back_btn" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff" ><a style="color:#fff;text-decoration:none" href="transfer_history.php"> GO BACK </a></span>
  <?php }else{ ?>
    <span id="back_btn" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff" ><a style="color:#fff;text-decoration:none" href="history.php"> GO BACK </a></span>
 
     <?php } ?>
    
<span id="print_btn" onclick="return print_page();" style="border-radius: 5px;float: right;background-color: #c0732f;cursor: pointer;padding:5px 10px;color:#fff;margin-right:10px" > PRINT </span>
 
    
<?php
session_start();
    include("../database.class.php");  
    $database	= new Database();
		
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  if(isset($_REQUEST['type']) && $_REQUEST['type']=='print_req_order'){
         
  ?>
    
<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;" colspan="17">
       <img width="150px" src="../img/report-logo/reportlogo.png" />
    
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>REQUISITION</strong></th>
      </tr>
      
      <tr >
      <th style="font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"> Store : <?=$_REQUEST['store']?> | Date : <?=$_REQUEST['date']?></th>
      </tr>
      
   <tr >
    <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>ID : <?=$_REQUEST['id']?> </strong></th>
      </tr>
    </thead>
    </table> 
    


                                   <table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                              
                                                <td style="width:5%">Sl</td>
                                                    
                                                <td style="width:30%">Item</td> 
                                                 <td style="width:10%">Type</td>
                                                 <td style="width:10%">Unit </td>
                                                 <td style="width:10%">Qty</td>
                                                <td style="width:10%">Weight</td>
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                            
                                        </thead>
                                        
                                        <tbody>

                                        <?php
                                         
        
        
       $sql_login17  =  $database->mysqlQuery("select * from  tbl_requisition left join tbl_menumaster on tbl_requisition.tr_product=tbl_menumaster.mr_menuid   where tbl_requisition.tr_req_id='".$_REQUEST['id']."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                      ?>

                <tr>
                       <td><?=$i++?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                      <td><?=$result_login1['tr_rate_type']?></td>
                      <td><?=$result_login1['tr_unittype']?></td>
                      <td><?=$result_login1['tr_qty']?></td>
                      <td><?=$result_login1['tr_weight']?></td>
                 </tr>

                      
          <?php }} ?>
                
                             
             </tbody>
              </table>   
 <?php  

  }
 
 if(isset($_REQUEST['type']) && $_REQUEST['type']=='print_purchase_order'){
         
  ?>
    
<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;" colspan="17">
       <img width="150px" src="../img/report-logo/reportlogo.png" />
    
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>PURCHASE ORDER</strong></th>
      </tr>
      
      <tr >
      <th style="font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Supplier :  <?=$_REQUEST['supplier']?> | Store : <?=$_REQUEST['store']?> | Date: <?=$_REQUEST['date']?> </th>
      </tr>
      
   <tr >
    <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>ID : <?=$_REQUEST['id']?> </strong></th>
      </tr>
    </thead>
    </table> 
    


<table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                              
                                             
                                               
                                                
                                                    <td style="width:5%">Sl</td>
                                                    
                                                    <td style="width:30%">Item</td> 
                                                     <td style="width:10%">Type</td>
                                                 <td style="width:10%">Unit </td>
                                                 <td style="width:10%">Qty</td>
                                                <td style="width:10%">Weight</td>
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                            
                                        </thead>
                                        
                                        <tbody>

                                        <?php
                                         
        
        
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_purchase_order left join tbl_menumaster on tbl_purchase_order.tp_product=tbl_menumaster.mr_menuid   where tbl_purchase_order.tp_purchase_id='".$_REQUEST['id']."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      ?>

                <tr>
                       <td><?=$i++?></td>
                      <td><?=$result_login1['mr_menuname']?></td>
                       <td><?=$result_login1['tp_rate_type']?></td>
                      <td><?=$result_login1['tp_unittype']?></td>
                      <td><?=$result_login1['tp_qty']?></td>
                      
                      <td><?=$result_login1['tp_weight']?></td>
                     
                 </tr>

                      
          <?php }} ?>
                
                             
             </tbody>
              </table>   
 <?php  }  

if(isset($_REQUEST['type']) && $_REQUEST['type']=='print_grn_order'){ ?>
         
<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;" colspan="17">
       <img width="150px" src="../img/report-logo/reportlogo.png" />
    
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>GRN ORDER ID : <?=$_REQUEST['id']?></strong></th>
      </tr>
      
      <tr >
          
       <th style="float: left;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Invoice Date :  <?=$_REQUEST['date']?> &nbsp; &nbsp; | &nbsp; &nbsp;  Invoice No : <?=$_REQUEST['inv']?></th>
        <th style="float: right;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Grn Date :  <?=$_REQUEST['dayclose']?> </th>
         
         </tr>
      
      
      <tr >
    
          
      <th style="font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Supplier :  <?=$_REQUEST['supplier']?> &nbsp; &nbsp; | &nbsp; &nbsp;  Store : <?=$_REQUEST['store']?></th>
      </tr>
      
   <tr >
    <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong> </strong></th>
      </tr>
    </thead>
    </table> 
    
<table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                               <td style="width:5%">Sl</td>
                                                <td style="width:30%">Item</td> 
                                                <td style="width:10%">Type</td>
                                                 <td style="width:10%">Unit </td>
                                                 <td style="width:10%">Qty</td>
                                                <td style="width:10%">Weight</td>
                                                <td style="width:10%">Rate</td>
                                                <td style="width:15%">Tax</td>
                                                <td style="width:15%">Total</td>
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                       </thead>
                                       <tbody>
       <?php
                               
       $tot=0; $tottx=0; $rt=0; $adj=0;
        $sql_login17  =  $database->mysqlQuery("select * from  tbl_grn_order left join tbl_menumaster on tbl_grn_order.tg_product=tbl_menumaster.mr_menuid left join tbl_grn_summary on tbl_grn_summary.tgs_grn_id=tbl_grn_order.tg_grn_id  where tbl_grn_order.tg_grn_id='".$_REQUEST['id']."' order by tbl_menumaster.mr_menuname asc  "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                      $tot=$tot+$result_login1['tg_final_rate'];
                        $tottx=$tottx+$result_login1['tg_tax_rate'];
                        $rt=$rt+$result_login1['tg_unit_rate'];
                        
                        $adj=$result_login1['tgs_adjustment'];
                      ?>

                     <tr>
                     <td><?=$i++?></td>
                     <td><?=$result_login1['mr_menuname']?></td>
                     <td><?=$result_login1['tg_rate_type']?></td>
                     <td><?=$result_login1['tg_unittype']?></td>
                     <td><?=$result_login1['tg_qty']?></td>
                     <td><?=$result_login1['tg_weight']?></td>
                     <td><?=number_format($result_login1['tg_unit_rate'],$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format($result_login1['tg_tax_rate'],$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format($result_login1['tg_final_rate'],$_SESSION['be_decimal']) ?></td>
                     </tr>

                      
          <?php }} ?>
                
                  <tr>
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                     <td><?=number_format($rt,$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format($tottx,$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format($tot,$_SESSION['be_decimal']) ?></td>
                     
                 </tr>
                 
                 
                 <tr>
                      <td>Final</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                     <td></td>
                     <td>Adjustment : <?=number_format($adj,$_SESSION['be_decimal']) ?></td>
                     <td><?=number_format(($tot+$adj),$_SESSION['be_decimal']) ?></td>
                     
                 </tr>
            
              </tbody>
              </table>   
 <?php  }  


if(isset($_REQUEST['type']) && $_REQUEST['type']=='transfer_print'){ ?>
         
<table class="table table-bordered table-font user_shadow newconsl_table" style="width:100%;float:left" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid;padding: 20px 0;" colspan="17">
       <img width="150px" src="../img/report-logo/reportlogo.png" />
    
      </tr>
     <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong>TRANSFER ID : <?=$_REQUEST['id']?></strong></th>
      </tr>
      
      
      <?php 
      
       $from=''; $to=''; $indent_id=''; $direct_id='';
       $sql_kotlist  =  $database->mysqlQuery("SELECT   tt_indent,tt_direct_grn,tt_dayclosedate,tt_from_store,tt_to_store from tbl_store_transfer where tt_trn_id='".$_REQUEST['id']."' limit 1 "); 
       $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){ 
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	{  
                                    
             $date= $result_kotlist['tt_dayclosedate'];
             $indent_id    = $result_kotlist['tt_indent'];                   
              $direct_id    = $result_kotlist['tt_direct_grn'];                                    
                                
        $fnct_menu = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tt_from_store']."' ");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) { 
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                 
                           $from=$result_fnctvenue['ti_name'];
                        
                  
              }
              }
              
              
        $fnct_menu4 = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_id='".$result_kotlist['tt_to_store']."' ");
        $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if ($num_fdtl4 > 0) { 
              while ($result_fnctvenue1 = $database->mysqlFetchArray($fnct_menu4))
              { 
                 $to=$result_fnctvenue1['ti_name'];
                  
              }
              }
              
              
      } }
                                
      ?>
      
      <tr >
          
       <th style="float: left;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Date :  <?=$date?> </th>
        <th style="float: right;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">From Store :  <?=$from?> &nbsp; &nbsp; | &nbsp; &nbsp;  To Store : <?=$to?></th>
         
         </tr>
      
      
     <tr >
          
         <?php if($indent_id!=''){ ?>
       <th style="float: left;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Indent Id :  <?=$indent_id?> </th>
       
       
         <?php } if($direct_id!='' && $direct_id!='0' ){ ?>
        <th style="float: right;font-size:12px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4">Direct Id :  <?=$direct_id?> </th>
         
         <?php } ?>
         </tr>
      
   <tr >
    <th style="font-size:18px;color:#000;background-color:#FFF;padding: 2px 0 10px 0; font-family:sans-serif" colspan="4"><strong> </strong></th>
      </tr>
    </thead>
    </table> 
    
<table style="width:100%;float:left">
                                        <thead>
                                            <tr>
                                               <td style="width:5%">Sl</td>
                                                <td style="width:40%">Item</td> 
                                                <td style="width:10%">Type</td>
                                                 <td style="width:10%">Unit </td>
                                                 <td style="width:10%">Qty</td>
                                                <td style="width:10%">Weight</td>
                                                <td style="width:10%">Rate</td>
                                              
                                                <td style="width:25%">Total</td>
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                       </thead>
                                       <tbody>
       <?php
                               
       $tot=0; $tottx=0; $rt=0; $adj=0;
        $sql_login17  =  $database->mysqlQuery("SELECT * from tbl_store_transfer "
                . " left join tbl_menumaster on tbl_menumaster.mr_menuid=tbl_store_transfer.tt_product  where tt_trn_id='".$_REQUEST['id']."' "); 
            
	  $num_login17   = $database->mysqlNumRows($sql_login17);
	  if($num_login17){  $i=1;
		  while($result_login1  = $database->mysqlFetchArray($sql_login17)) 
			{
                      
                         $tot=$tot+$result_login1['tt_total'];
                       
                        $rt=$rt+$result_login1['tt_rate'];
                        
                        
                      ?>

                     <tr>
                     <td><?=$i++?></td>
                     <td><?=$result_login1['mr_menuname']?></td>
                     <td><?=$result_login1['tt_rate_type']?></td>
                     <td><?=$result_login1['tt_unit_type']?></td>
                     <td><?=$result_login1['tt_qty']?></td>
                     <td><?=$result_login1['tt_weight']?></td>
                     <td><?=number_format($result_login1['tt_rate'],$_SESSION['be_decimal']) ?></td>
                     
                     <td><?=number_format($result_login1['tt_total'],$_SESSION['be_decimal']) ?></td>
                     </tr>

                      
          <?php }} ?>
                
                  <tr>
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                     <td></td>
                   
                     <td><?=number_format($tot,$_SESSION['be_decimal']) ?></td>
                     
                 </tr>
                 
                 
                 
            
              </tbody>
              </table>   
 <?php  } ?>  


       
     <script type="text/javascript">
function print_page()
{
    document.getElementById("back_btn").style.display = "none";	
    document.getElementById("print_btn").style.display = "none";
    document.getElementById("ref_btn").style.display = "block";
 
  window.print();
}

function ref_page()
{
    document.getElementById("back_btn").style.display = "block";	
    document.getElementById("print_btn").style.display = "block";
    document.getElementById("ref_btn").style.display = "none";
 
}
</script>  

</div>