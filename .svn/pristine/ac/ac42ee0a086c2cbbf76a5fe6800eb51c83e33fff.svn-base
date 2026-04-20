<?php
session_start();
include("database.class.php"); 
$database	= new Database();


if(isset($_REQUEST['value']) && $_REQUEST['value']=='add_advance')
{ 
    
    if($_REQUEST['method_type']=='add'){
    
	$insertion['tp_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['amount']);
        $insertion['tp_delivery_date'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['date']);
        $insertion['tp_delivery_note'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['note']);
        $insertion['tp_customer'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['name']);
        $insertion['tp_number'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['number']);
        $insertion['tp_mode'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mode']);
        $insertion['tp_dayclose'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']);
        $insertion['tp_status'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Approved');
        
        $insertion['tp_mail'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mail']);
        
        if($_REQUEST['bank']!=''){
          $insertion['tp_bank'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['bank']);
        }
        
        if($_REQUEST['delivery']!=''){
          $insertion['tp_delivery_charge'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['delivery']);
        }
        
       
        $sql=$database->check_duplicate_entry('tbl_advance_payment',$insertion);
	 if($sql!=1)
	 {
	  $insertid =  $database->insert('tbl_advance_payment',$insertion);
          
               $sql_desg_nos3="select max(tp_id) as id from tbl_advance_payment ";
               $sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
	       $num_desg3  = $database->mysqlNumRows($sql_desg3);
	       if($num_desg3)
		{
			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
				{
                            $id=$result_desg3['id'];
                            
                        }
                        }
                         
                        
   /////////dayclose detail///////
        $insertion1['tdd_ref_id'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$id);
        $insertion1['tdd_advance_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['amount']);
        $insertion1['tdd_dayclose_date'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']);
        $sql1=$database->check_duplicate_entry('tbl_advance_day_detail',$insertion1);
	 if($sql1!=1)
	 {
	  $insertid1 =  $database->insert('tbl_advance_day_detail',$insertion1);
                        
         }        
                          
       
         }
	echo $id;
        
    }else{
        
       $query3=$database->mysqlQuery("update tbl_advance_payment set tp_amount='".$_REQUEST['amount']."',tp_delivery_date='".$_REQUEST['date']."',tp_delivery_note='".$_REQUEST['note']."',"
        . "tp_customer='".$_REQUEST['name']."' ,tp_number='".$_REQUEST['number']."',tp_mode='".$_REQUEST['mode']."',tp_dayclose='".$_SESSION['date']."' where tp_id='".$_REQUEST['type_id']."' ");  
        
        echo $_REQUEST['type_id'];
        
        $query34=$database->mysqlQuery("update tbl_advance_day_detail set tdd_advance_amount='".$_REQUEST['amount']."' where tdd_ref_id='".$_REQUEST['type_id']."'   ");
        
    }
           
}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='search_date_adv')
{ 
    
    $string='';
    
    $string.=" where tp_customer!='' ";
    
    $name=$_REQUEST['name'];
    
    $num=$_REQUEST['num'];
    
    if($name!='' && strlen($name)>2 ){
       $string.=" and (tp_customer like '%".$name."%'  or tp_number like '%".$name."%') ";
    }
    
    
    if($num!='' && strlen($num)>2){
       //$string.=" and tp_number like '%".$num."%' ";
    }
    
     if($_REQUEST['sts']!=''){
       $string.=" and tp_status = '".$_REQUEST['sts']."' ";
    }
    
    
    
         
        
         if($_REQUEST['entry']!="" && $_REQUEST['entry1']!="")
		{
			$string.= " and  tp_dayclose between '".$_REQUEST['entry']."' and '".$_REQUEST['entry1']."' ";
                       
		}
		else if($_REQUEST['entry']!="" && $_REQUEST['entry1']=="")
		{
			$to=date("Y-m-d");
			$string.= " and tp_dayclose between '".$_REQUEST['entry']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['entry']=="" && $_REQUEST['entry1']!="")
		{
			$from=date("Y-m-d");
			$string.= " and  tp_dayclose between '".$from."' and '".$_REQUEST['entry1']."' ";
                }else{
         
                    $string.=" and tp_dayclose = '".$_SESSION['date']."' "; 
                }

    
    
              if($_REQUEST['from_date']!="" && $_REQUEST['to_date']!="")
		{
			$string.= " and  tp_delivery_date between '".$_REQUEST['from_date']."' and '".$_REQUEST['to_date']."' ";
                       
		}
		else if($_REQUEST['from_date']!="" && $_REQUEST['to_date']=="")
		{
			$to=date("Y-m-d");
			$string.= " and tp_delivery_date between '".$_REQUEST['from_date']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['from_date']=="" && $_REQUEST['to_date']!="")
		{
			$from=date("Y-m-d");
			$string.= " and  tp_delivery_date between '".$from."' and '".$_REQUEST['to_date']."' ";
                }
                
                
   
          ?>
                    <table class="table_report scroll tablesorter "  width="100%" border="0" cellspacing="5" >
                              <thead>
                                <tr>
                                    <th width="25%" style="height: 40px;padding-left: 0px">Actions</th>
                                <th width="8%">Sl</th>
                                <th width="18%">Name</th>
                                <th width="17%">Phone</th>
                                <th width="8%">Id</th>
                                <th width="10%">Bill</th>
                                <th width="12%">Entry Date</th>
                                <th width="12%">Del Date</th>
                                <th width="12%">Mode</th>
                                <th width="12%" style="text-align: left">Status</th>
                                <th style="text-align: center" width="13%">Cancel By</th>
                                <th style="text-align: center" width="13%">Cancel On</th>
                                <th width="15%">Subtotal </th>
                                 <th width="10%">Tax </th>
                                 <th width="10%">Total </th>
                                  <th width="10%">Paid </th>
                                </tr>
                              
                             </thead>
                             
          <?php
          $i=0; $tot=0; $tot1=0; $taxtot=0; $subtot=0;
	  $sql_login  =  $database->mysqlQuery("select * from tbl_advance_payment  $string "); 
        //echo "select * from tbl_advance_payment  $string ";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                        $tot=$tot+$result_login['tp_amount'];
                        
                         $tot1=$tot1+$result_login['tp_final'];
                        
                         $subtot=$subtot+$result_login['tp_subtotal'];
			
                          $taxtot=$taxtot+$result_login['tp_tax'];
                          
                          
                          
	   ?>
    				<tr>
                                    
                                <td  width="25%">
                                
                                   <?php if($result_login['tp_status']!='Cancelled'){ ?>
                                    
                                    
                                   <?php  if( ((float)$result_login['tp_amount']!=(float)$result_login['tp_final']) || $result_login['tp_final']==0) { ?> 
                                    
                                   <?php if($result_login['tp_delivery_status']=='N') { ?> 
                                    
                                   <a style="cursor: pointer;margin-left:2px;"  onclick="edit_order('<?=$result_login['tp_id']?>');"  href="#" class="testmyprinter" ><img src="img/edit_btn.png"></a>
                                
                                   <?php } else { ?> 
                                 
                                 <strong title="DELIVERED" style="color:black;padding: 6px"> (D) </strong>
                                  
                                   <?php } ?> 
                                 
                                  <?php } else { ?> 
                                 
                                  <strong title="PAID" style="color:black;padding: 6px"> (P) </strong>
                                  
                                <?php } ?>   
                               
                               
                                <?php }  ?> 
                                 
                                <a  onclick="view_order('<?=$result_login['tp_id']?>');" style="margin-left:2%;cursor: pointer" href="#" class="testmyprinter" ><img src="img/icon-view.png"></a>
                               
                                <a  onclick="reprint('<?=$result_login['tp_id']?>');" style="margin-left:2%;cursor: pointer" href="#" class="" ><img src="img/printer_new.png"></a>
                                     
                                 <?php if($result_login['tp_status']!='Cancelled'){ ?>
                                
                                <span title="APPROVE ORDER" style="margin-left:2%;cursor: pointer;display: none" onclick="approve_cancel('<?=$result_login['tp_id']?>','Approved')" class="red-skin hash-skin"><img src="img/green_tick.png" width="25px" height="25px"></span>
                                
                                <span title="CANCEL ORDER" style="margin-left:2%;cursor: pointer" onclick="approve_cancel('<?=$result_login['tp_id']?>','Cancelled','<?=$result_login['tp_cs_bill']?>')" class="red-skin hash-skin"><img src="img/red_cross.png" width="25px" height="25px"></span>
                                
                                <?php } ?>
                                
                                </td>
                                
                                <td width="8%"><?=$i?></td>
                                <td class="name_show" width="18%"><?=$result_login['tp_customer']?></td>
                                <td width="17%"><?=$result_login['tp_number']?></td>
                                <td width="8%"><?=$result_login['tp_id']?></td>
                                <td width="10%"><?=$result_login['tp_cs_bill']?></td>
                                <td width="12%"><?=$result_login['tp_dayclose']?></td>
                                <td class="date_show"  width="12%"><?=$result_login['tp_delivery_date']?></td>
                                  
                                <td style="text-align: center" width="12%"><?=substr($result_login['tp_mode'],0,4)?></td>
                                  
                                  <?php if($result_login['tp_status']=='Approved') { ?> 
                                  
                                   <td width="12%"><i class="fa fa-check-square"></i></td>
                                   
                                  <?php }else { ?> 
                                   
                                   <td width="12%"><i class="fa fa-close"></i></td>
                                   
                                  <?php } ?> 
                                  
                                  <td width="13%"><?=$result_login['tp_cancel_login']?></td>
                                  <td width="13%"><?=substr($result_login['tp_cancel_date'],0,10)?></td>
                                  
                                  
                                  <td width="15%"><?=number_format($result_login['tp_subtotal'],$_SESSION['be_decimal'])?></td>
                                  <td width="10%"><?=number_format($result_login['tp_tax'],$_SESSION['be_decimal'])?></td>
                                  <td width="10%"><?=number_format($result_login['tp_final'],$_SESSION['be_decimal'])?></td>
                                  
                                 <td width="10%"><?=number_format($result_login['tp_amount'],$_SESSION['be_decimal'])?></td>
                                 
                                 
                                    
                                    
                                    
                                </tr>
                                 
                              <?php } } 
?>
                                
                                <tr style="background-color: #ececec">
                                <td style="font-weight: bold "  width="25%">Total</td>
                                <td width="8%"> </td>
                                <td width="18%"></td>
                                <td width="17%"></td>
                                <td width="8%"></td>
                                 <td width="10%"></td>
                                <td width="12%"></td>
                                <td width="12%"> </td>
                                <td width="12%"></td>
                                <td width="12%"></td>
                                <td width="13%"></td>
                                <td width="13%"></td>
                                <td width="15%"><?=number_format($subtot,$_SESSION['be_decimal'])?></td>
                                <td width="10%"><?=number_format($taxtot,$_SESSION['be_decimal'])?></td>
                                <td width="10%"><?=number_format($tot1,$_SESSION['be_decimal'])?></td>
                                <td style="font-weight: bold " width="10%"><?=number_format($tot,$_SESSION['be_decimal'])?> </td>
                               
                                </tr>      
                                
                                 </table>
<?php

}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='reprint_advance')
{ 
    
      require_once("printer_functions.php");
      $printpage=new PrinterCommonSettings();
          
      require_once("Escpos.php");
     if($_SESSION['s_printst']=='Y'){
       $printpage->print_advance_payment($_REQUEST['id_reprint']);
          
     }
}



else if(isset($_REQUEST['value']) && $_REQUEST['value']=='search_date_reminder')
{ 
    $string='';
    
    //$string.=" and tp_delivery_status='N' ";
    
    $string.=" and tp_delivery_status!='' ";
    
     if($_REQUEST['name']!=""){
         
         
          $string.=" and (tp_customer LIKE '%".$_REQUEST['name']."%' or tp_number LIKE '%".$_REQUEST['name']."%' ) ";
         
     }
            
             
             
    
    if($_REQUEST['bydate']==''){
   
    if($_REQUEST['from_date']!="" || $_REQUEST['to_date']!="")
		{
    if($_REQUEST['from_date']!="" && $_REQUEST['to_date']!="")
		{
			$string.= " and  DATE(tp_delivery_date) between '".$_REQUEST['from_date']."' and '".$_REQUEST['to_date']."' ";
                       
		}
		else if($_REQUEST['from_date']!="" && $_REQUEST['to_date']=="")
		{
			$to=date("Y-m-d");
			$string.= " and DATE(tp_delivery_date) between '".$_REQUEST['from_date']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['from_date']=="" && $_REQUEST['to_date']!="")
		{
			$from=date("Y-m-d");
			$string.= " and  DATE(tp_delivery_date) between '".$from."' and '".$_REQUEST['to_date']."' ";
                        
		}
                
                
                }else{
                     $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 6 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string.=" and tp_delivery_date between '".$cr_new."' and '".$cr7_new."' order by tp_delivery_date asc ";
                }
                
    }else{
        
        if($_REQUEST['bydate']=='week' ){
            
            $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 6 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string.=" and tp_delivery_date between '".$cr_new."' and '".$cr7_new."' order by tp_delivery_date asc ";
        
        }
        
        
        if($_REQUEST['bydate']=='today'){
            
         $cr=date('Y-m-d');
            
        $string.=" and DATE(tp_delivery_date) = '".$cr."'  order by tp_delivery_date asc ";
        }
        
        if($_REQUEST['bydate']=='15days'){
            
           $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 14 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string.=" and tp_delivery_date between '".$cr_new."' and '".$cr7_new."' order by tp_delivery_date asc ";
        }
        
        if($_REQUEST['bydate']=='month'){
            
             $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 29 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string.=" and tp_delivery_date between '".$cr_new."' and '".$cr7_new."' order by tp_delivery_date asc ";
        }
        
         if($_REQUEST['bydate']=='three_month'){
            
             $cr=date('Y-m-d');
             $cr_new =date("Y-m-d",  strtotime($cr));     
             $cr7=date('Y-m-d', strtotime(' + 89 days'));
             $cr7_new= date("Y-m-d",  strtotime($cr7));
            
        $string.=" and tp_delivery_date between '".$cr_new."' and '".$cr7_new."' order by tp_delivery_date asc ";
        }
        
        if($_REQUEST['bydate']=='last_60'){
            
        $string.=" and tp_delivery_date between  CURDATE( ) - INTERVAL 2 MONTH AND CURDATE( ) order by tp_delivery_date asc ";
        
        }
        
        
        
    }
   
?>
<table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" >
                              <thead>
                                  
                                <tr>
                                    <th width="17%" style="height: 35px;">Actions</th>    
                                <th width="8%">SL </th>
                                <th width="15%">CUSTOMER</th>
                                 <th width="15%">PHONE</th>
                                  <th width="10%">ID</th>
                                  <th width="10%">BILL</th> 
                                    <th width="10%">ENTRY</th>
                                 <th width="14%">DELIVERY</th>
                                  <th width="10%">MODE</th>
                                   <th width="10%">TOTAL</th>
                                 <th width="10%">PAID</th>
                                </tr>
                              
                             </thead>
          <?php
          
          $i=0; $tot=0; $paid=0;
	  $sql_login  =  $database->mysqlQuery("select * from tbl_advance_payment where tp_status='Approved' $string "); 
          //echo "select * from tbl_advance_payment  $string ";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
				 $tot=$tot+$result_login['tp_final'];
                                 
                                  $paid=$paid+$result_login['tp_amount'];
                                 
                                 $item_tot=0;          
                 
                     
                  $sb1=str_replace(',','',number_format($result_login['tp_final'],$_SESSION['be_decimal']));
                  $adv1=str_replace(',','',number_format($result_login['tp_amount'],$_SESSION['be_decimal']));
                  
                 
                  if($sb1>$adv1){
                     $check='YES'; 
                  }else{
                      $check='NO'; 
                  }
                  
                                 
	        ?>
    				<tr>
                                  <td width="17%">
                                      
                                     <?php if( ((float)$result_login['tp_final']!=(float)$result_login['tp_amount']) || $result_login['tp_delivery_status']=='N') { ?> 
                                      
                                      <a  onclick="delivery_status('<?=$result_login['tp_id']?>','<?=number_format($result_login['tp_final'],$_SESSION['be_decimal'])?>','<?=number_format($result_login['tp_amount'],$_SESSION['be_decimal'])?>','<?=$check?>');" style="margin-left:-5%" href="#" class="testmyprinter" title="Delivery" ><img src="img/gnarate_bill.png"></a>
                                    
                                      <?php }else{ ?> 
                                      
                                      <i title="PAID & DELIVERED " class="fa fa-check-square" ></i>
                                      
                                      <?php } ?> 
                                      
                                    <a  onclick="view_order('<?=$result_login['tp_id']?>');" style="margin-left:6%" href="#" class="testmyprinter" title="View" ><img src="img/icon-view.png"></a>
                                   
                                    <a  onclick="reprint('<?=$result_login['tp_id']?>');" style="margin-left:4%" href="#" class="" title="Reprint" ><img src="img/printer_new.png"></a>
                                     
                                 </td> 
                                    
                                <td width="8%"><?=$i?></td>
                                <td class="name_show" width="15%"><?=$result_login['tp_customer']?></td>
                                <td width="15%"><?=$result_login['tp_number']?></td>
                                 <td width="10%"><?=$result_login['tp_id']?></td>
                                  <td width="10%"><?=$result_login['tp_cs_bill']?></td>
                                    <td width="10%"><?=$result_login['tp_dayclose']?></td>
                                    <td  width="14%" style="font-weight: bold;color: darkred"><?=$result_login['tp_delivery_date']?>  <?php if($result_login['tp_delivery_status']=='Y'){ ?>   <i title="DELIVERED " style="color:green" class="fa fa-check-square" ></i> <?php } ?> </td>
                                   <td width="10%"><?=substr($result_login['tp_mode'],0,4)?></td>
                                   <td  width="10%"><?=number_format($result_login['tp_final'],$_SESSION['be_decimal'])?></td>
                                 <td width="10%"><?=number_format($result_login['tp_amount'],$_SESSION['be_decimal'])?></td>
                                
                                </tr>
                                 
                              <?php } } 
?>
                                
                                
                                <tr style="background-color: #ececec">
                                 <td style="font-weight: bold " width="17%">Total </td>     
                                <td  width="8%"> </td>
                                <td width="15%"></td>
                                 <td width="15%"></td>
                                  <td width="10%"></td>
                                   <td width="10%"></td>
                                   <td width="10%"></td>
                                 <td width="14%"> </td>
                                  <td width="10%"></td>
                                  <td style="font-weight: bold " width="10%"><?=number_format($tot,$_SESSION['be_decimal'])?> </td>
                                 <td style="font-weight: bold " width="10%"><?=number_format($paid,$_SESSION['be_decimal'])?> </td>
                                
                                </tr>      
                                 </table>
<?php

}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname_menu'){ 
    
     $name1='';
     $name=$_REQUEST['name'];
     $mid='';
     
     $rate=0; $rt=''; $portion='1'; $base=''; $unit='';
     
   if(strlen($_REQUEST['name'])>2){
       
       
       
   $sql_login  =  $database->mysqlQuery("select mr_menuname,mr_menuid from tbl_menumaster where (mr_menuname LIKE '%".$name."%' ) and mr_active='Y' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                               
                              $name1= $result_login['mr_menuname'];
                              $mid= $result_login['mr_menuid'];
                              
                              
          $sql_login  =  $database->mysqlQuery("select mrc_rate,mrc_rate_type,mrc_portion,mrc_base_unit_id,mrc_unit_id,mrc_unit_type"
          . " from tbl_menurate_counter where mrc_menuid ='$mid' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login5  = $database->mysqlFetchArray($sql_login)) 
		  {    
                      
                       $rate= $result_login5['mrc_rate'];
                       
                       $rt=$result_login5['mrc_rate_type'];
                      
                       if($result_login5['mrc_rate_type']=='Portion'){
                                     
                         $portion=$result_login5['mrc_portion'];
                            
                       }else if($result_login5['mrc_rate_type']=='Unit'){
                                    
                         if($result_login5['mrc_unit_type']=='Loose'){
                          
                           $base=$result_login5['mrc_base_unit_id'];
                                         
                        }else if($result_login5['mrc_unit_type']=='Packet'){
                                       
                           $unit=$result_login5['mrc_unit_id'];
                                        
                        } 
                                    
                    }
                      
                  }
                  }            
	   
    ?>

    <ul>
    <li id="load_name_ul" onclick="return name_click('<?=$name1?>','<?=$mid?>','<?=$rate?>','<?=$rt?>','<?=$portion?>','<?=$base?>','<?=$unit?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
    <?=$name1?>    
    </li>
    </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname'){ 
    
     $name1='';
     $name=$_REQUEST['name'];
     $num=$_REQUEST['number'];
     $mid='';
     
   if(strlen($_REQUEST['name'])>1){
       
       
   $sql_login  =  $database->mysqlQuery("select ly_firstname,ly_id,ly_mobileno  from tbl_loyalty_reg"
   . " where (ly_firstname LIKE '%".$name."%' ) and ly_status='Active' "); 
   
   
   }
   
   if(strlen($_REQUEST['number'])>1){
       
       
        $sql_login  =  $database->mysqlQuery("select ly_firstname,ly_id,ly_mobileno  from tbl_loyalty_reg"
   . " where (  ly_mobileno LIKE '%".$num."%' ) and ly_status='Active' "); 
   
       
   } 
   
   if(strlen($_REQUEST['name'])>1 || strlen($_REQUEST['number'])>1){
       
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                               
                              $name1= $result_login['ly_firstname'];
                              $mid= $result_login['ly_id'];
                              $num= $result_login['ly_mobileno'];
            
    ?>

<ul style="border: solid 1px black;margin-top: 3px;border-radius: 6px;">
    
    <li id="load_name_ul" onclick="return name_click1('<?=$name1?>','<?=$mid?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
    <?=$name1.'-'.$num?>    
    </li>
    </ul>
<?php

          }}
          
   }
	
}



else if(isset($_REQUEST['item_multi']) && $_REQUEST['item_multi']!=''){
   
         $row2=array();
        
    
        $insertion['tmd_ref_id']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['menu_add_id']));
        
         $insertion['tmd_menu']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['item_multi']));
         
         $insertion['tmd_qty']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['qty_multi']));
       
        $insertion['tmd_total']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['tot_multi']));
        
        //$insertion['tmd_type']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['type_multi']));
        
        $insertion['tmd_rate']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['rate_multi']));
        
        
        if($_REQUEST['weight']!=''){
          $insertion['tmd_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']));
          
         $insertion['tmd_total_weight']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['weight']*$_REQUEST['qty_multi']));
          
        }
        
         $insertion['tmd_menuid']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['item_id']));
        
	if($_REQUEST['des_multi']!=''){
        $insertion['tmd_description']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['des_multi']));
        }
	
    $sql=$database->check_duplicate_entry('tbl_advance_pay_menu_details',$insertion);
    if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_advance_pay_menu_details',$insertion);   
        
        
        $fnct_menu = $database->mysqlQuery("select * from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['menu_add_id']."' order by tmd_id asc");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
               
          echo json_encode($row2);
   }

}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='delcar'){
    
     $fnct_menu = $database->mysqlQuery("Delete from tbl_advance_pay_menu_details where tmd_id='".$_REQUEST['id']."'");
    
}


else if(isset($_REQUEST['value']) && $_REQUEST['value']=='delete_all'){
    
     $fnct_menu2 = $database->mysqlQuery("Delete from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['id']."'");
     
     $fnct_menu1 = $database->mysqlQuery("Delete from tbl_advance_payment where tp_id='".$_REQUEST['id']."'");
     
     
      $fnct_menu3 = $database->mysqlQuery("Delete from tbl_advance_day_detail where tdd_ref_id='".$_REQUEST['id']."'");
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='print_paper'){
    
   require_once("printer_functions.php");
   $printpage=new PrinterCommonSettings();
          
     require_once("Escpos.php");
     
     
     if($_REQUEST['bank']!=''){
         
         $bank=$_REQUEST['bank'];
     }else{
         $bank='0';
     }
     
     
      $query3=$database->mysqlQuery("update tbl_advance_payment set tp_amount='".$_REQUEST['paid']."',tp_final='".$_REQUEST['tot']."',"
       . " tp_tax='".$_REQUEST['tax']."',tp_subtotal='".$_REQUEST['sub']."',tp_bank='$bank',tp_mode='".$_REQUEST['mode']."' "
       . " where tp_id='".$_REQUEST['print_id']."'  ");
   
//      echo "update tbl_advance_payment set tp_amount='".$_REQUEST['paid']."',tp_final='".$_REQUEST['tot']."',"
//       . " tp_tax='".$_REQUEST['tax']."',tp_subtotal='".$_REQUEST['sub']."',tp_bank='$bank',tp_mode='".$_REQUEST['mode']."' "
//       . " where tp_id='".$_REQUEST['print_id']."'";
          
        if($_SESSION['s_printst']=='Y'){
            
            $printpage->print_advance_payment($_REQUEST['print_id']);
        }  
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='print_paper_check'){
    
     $fnct_menu = $database->mysqlQuery("select * from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['print_id']."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              echo 'YES';
        }else{
            echo 'NO';
        }
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='load_menu_details'){
    ?>
    <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5">
    <thead>
                            <tr>
                                <th width="20%">Item</th>
                                 <th width="5%">Weight</th>
                                 <th width="5%">Qty</th>
<!--                              <th width="10%">Type</th>-->
                                  <th width="10%">Rate</th>
                                  <th width="10%">Total</th>
                              </tr>

                             </thead>
                             <tbody>
                         <?php
                         $tot_all=0;
                           $fnct_menu = $database->mysqlQuery("select * from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['id_load']."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  $tot_all=$tot_all+$result_fnctvenue['tmd_total'];
              ?>
                             
              

                             
                             
                               <tr>
                                <td width="20%"><?=$result_fnctvenue['tmd_menu']?></td>
                                <td width="5%"><?=$result_fnctvenue['tmd_weight']?></td>
                                <td width="5%"><?=$result_fnctvenue['tmd_qty']?></td>
<!--                                <td width="10%"><?//=$result_fnctvenue['tmd_type']?></td>-->
                                <td width="10%"><?=number_format($result_fnctvenue['tmd_rate'],$_SESSION['be_decimal'])?></td>
                                <td width="10%"> <?=number_format($result_fnctvenue['tmd_total'],$_SESSION['be_decimal'])?></td>
                            </tr>
                            <tr><td style="border-bottom: 3px #cccac9 solid;" colspan="5">Description : <?=$result_fnctvenue['tmd_description']?></td></tr>
    
        <?php } } ?>
                        
                      <tr style="background-color: #ececec">
                                <td width="20%">Total</td>
                                <td width="5%"></td>
                                <td width="5%"></td>
<!--                                <td width="10%"></td>-->
                                <td width="10%"></td>
                                <td width="10%"> <?=number_format($tot_all,$_SESSION['be_decimal'])?></td>
                            </tr> 
                            
                            
                            
                            
                     </tbody> 
                    </table>  


<?php
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='authpincheck'){
    
    $fnct_menu = $database->mysqlQuery("select ser_advance_pay_permission from tbl_staffmaster where ser_authorisation_code='".$_REQUEST['pin']."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                  echo $result_fnctvenue['ser_advance_pay_permission'];
                  
              }
              }
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='edit_pop'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['edit_id']."' order by tmd_id asc ");
    $num_fdtl = $database->mysqlNumRows($fnct_menu);
    if ($num_fdtl > 0) {
    while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
    {
    $row2[]=$result_fnctvenue;
    }
    }
        
    echo json_encode($row2);
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='edit_pop_name'){
    
    $fnct_menu = $database->mysqlQuery("select * from tbl_advance_payment where tp_id='".$_REQUEST['edit_id']."'");
    $num_fdtl = $database->mysqlNumRows($fnct_menu);
    if ($num_fdtl > 0) {
    while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
    {
  echo $result_fnctvenue['tp_customer'].'*'.$result_fnctvenue['tp_number'].'*'.$result_fnctvenue['tp_amount'].'*'.$result_fnctvenue['tp_delivery_note']
  .'*'.$result_fnctvenue['tp_delivery_date'].'*'.$result_fnctvenue['tp_mode'].'*'.$result_fnctvenue['tp_bank'].'*'.$result_fnctvenue['tp_mail'];
    }
    }
    
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='delivery_status'){
    
    
    if($_REQUEST['status']=='Y'){
       $query3=$database->mysqlQuery("update tbl_advance_payment set tp_delivery_status='Y' where tp_id='".$_REQUEST['id']."'  ");
    }
    
    
    
    
    if($_REQUEST['bal']>0){
        
        $query3=$database->mysqlQuery("update tbl_advance_payment set tp_amount=tp_amount+'".$_REQUEST['bal']."' where tp_id='".$_REQUEST['id']."'  ");
   
        $insertion11['tdd_ref_id'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['id']);
        $insertion11['tdd_advance_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['bal']);
        $insertion11['tdd_dayclose_date'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']);
        $sql11=$database->check_duplicate_entry('tbl_advance_day_detail',$insertion11);
	 
           $insertid11 =  $database->insert('tbl_advance_day_detail',$insertion11);
       
        
    
    
    //////credit settle cs/////
        
         $crd_master=0; $cd_amount=0;
        $fnct_menu = $database->mysqlQuery("select * from tbl_advance_payment where tp_id='".$_REQUEST['id']."'");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) { 
             while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu)){
                
        $fnct_menu4 = $database->mysqlQuery("select cd_masterid,cd_amount from tbl_credit_details where cd_billno='".$result_fnctvenue['tp_cs_bill']."' limit 1");
        $num_fdtl4 = $database->mysqlNumRows($fnct_menu4);
        if ($num_fdtl4) { 
             while ($result_fnctvenue4 = $database->mysqlFetchArray($fnct_menu4)){
                 
                 $crd_master=$result_fnctvenue4['cd_masterid'];
                 
                 $cd_amount=$result_fnctvenue4['cd_amount'];
             }
             }
                 
                 
                 
                 
	$billno		=$result_fnctvenue['tp_cs_bill'];    
        
	$creditype	=NULL;
        
        $mode_pay=$_REQUEST['mode'];
        
        
        if($mode_pay=='CASH'){
             
                $typenam	='1';
                      
          }else if($mode_pay=='CARD'){
              
                $typenam	='2';
                
          }
	
	$credit				='N';
	$amountpaid                     =0;
        $amount_bal                     =0;
	$creditno			=$crd_master;
	
	$creditdeatils		        =NULL;
	$paidamount_credit	        =NULL;
	$amount_credit		        =0;
	
	$transactionamount	        =0;
	$card_bank			=0;
	$remark				=NULL;
	$voucherid			=NULL;
	$couponcompany		        =NULL;
	$couponamt			=0;
	$chequeno			=NULL;
	$chequebankname		        =NULL;
	$chequeamount		        =0;
        
        if($_REQUEST['mode']=="CASH")
	{
		$amountpaid=$_REQUEST['bal'];
                $amount_bal=0;
                $card_bank=0;
		
	}else if($_REQUEST['mode']=="CARD")
	{
		$transactionamount =$_REQUEST['bal'];
		$card_bank =$_REQUEST['bank'];
		$amountpaid=0;
                $amount_bal=0;
							 
	}
	
    $master=$crd_master;  
      
    $date=date("Y-m-d H:i:s");
    $rate_new =$cd_amount;
    
    
    $paid=$_REQUEST['bal'];
    $trans =$_REQUEST['bal'];
    
    
        ///cash////   
       
        if($_REQUEST['mode']=="CASH" && $_REQUEST['bal']>0)
	{
           
                $tot_part_paid=0;
                $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill WHERE tcp_billno='".$billno."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                     $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                 
                      $rt=$rate_new-$tot_part_paid;
                 
                }else{
                    
                      $rt=$rate_new;
                    
                }
                
               
            if($paid>$rt){    
                
              $paid=$paid-$rate_new;    
                
              $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
              . " VALUES ('".$billno."','1','$rt','$date','".$_SESSION['expodine_id']."')");   
           
              
            }else{
                
                if($paid>0){
                    
                 $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
                 . " VALUES ('".$billno."','1','$paid','$date','".$_SESSION['expodine_id']."')");  
                 
                 $paid=0;
                 
                }
                
           }
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
         }
        
         ///card/////
       
        if($_REQUEST['mode']=="CARD" && $_REQUEST['bal']>0)
	{
            
                $tot_part_paid=0;
                $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                     $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                 
                    $rt=$rate_new-$tot_part_paid;
                 
                }else{
                    
                    $rt=$rate_new;
                    
                }
                
               
            if($paid>$rt){    
                
              $paid=$paid-$rate_new;    
                
              $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
              . " VALUES ('".$billno."','2','$rt','$date','".$_SESSION['expodine_id']."')");   
           
            }else{
                
                if($paid>0){
                  
                 $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
                 . " VALUES ('".$billno."','2','$paid','$date','".$_SESSION['expodine_id']."')");  
                 
                 $paid=0;
                 
                }
               
           }
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
        
                $tot_all_bill=0;
                $sql_listall56  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno."' "); 
		$num_listall56  = $database->mysqlNumRows($sql_listall56);
		if($num_listall56){
		while($row_listall56  = $database->mysqlFetchArray($sql_listall56)) 
		{
                     $tot_all_bill=$tot_all_bill+$row_listall56['amt'];
                    
                 }
                 
                }
        
        if($tot_all_bill==$rate_new){
            
             $sql=$database->mysqlQuery("UPDATE tbl_credit_details SET cd_settled='Y' , cd_dateofsettle='$date' "
              . " WHERE cd_billno='".$billno."'  ");
            
        }
        
    
    
    
    if($amountpaid>0 || is_nan($amountpaid)){
        
    }else{
        $amountpaid=0;
    }
    
    if($amount_bal>0 || is_nan($amount_bal)){
        
    }else{
        $amount_bal=0;
    }
    
   
   $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_details_payment`(`cdp_master_id`, `cdp_dayclosedate`, `cdp_paid_cash`, `cdp_transaction_amount`, "
   . " `cdp_balance`,`cdp_login_id`,`cdp_bank`) VALUES"
   . " ('$master','".$_SESSION['date']."','$amountpaid','$transactionamount','$amount_bal','".$_SESSION['login_staff_id_expodine']."','$card_bank')");
	
   $sql=$database->mysqlQuery("UPDATE tbl_credit_master SET crd_totalamount=0 WHERE crd_totalamount<0 ");
       
   $sql=$database->mysqlQuery("delete from  tbl_credit_details  WHERE (cd_billno='' or cd_billno is null) ");
   
   $sql=$database->mysqlQuery("delete from tbl_credit_details_payment WHERE (cdp_master_id='' or cdp_master_id is null or cdp_master_id='undefined')");
    
   
             if($_SESSION['s_printst']=='Y'){

               require_once("printer_functions.php");
               $printpage=new PrinterCommonSettings();
               require_once("Escpos.php");

               $bill_in='';
               $bill_in.=$billno.',,';
               
               $printpage->print_credit_settle($bill_in,$amountpaid,$transactionamount,$_REQUEST['bal_rem']);

             }
      
              
   }
   }
   
   
    }
       
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='check_payment_count'){
    $count=0;
    $fnct_menu = $database->mysqlQuery("select * from tbl_advance_day_detail where tdd_ref_id='".$_REQUEST['id_num_check']."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) { 
             while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu)){
             $count++;
              }
               }
    echo $count;
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='status_change'){
 
    $date=date('Y-m-d H:i:s');
    $fnct_menu = $database->mysqlQuery("update tbl_advance_payment set tp_status='".$_REQUEST['status']."',tp_cancel_date='$date',"
    . " tp_cancel_login='".$_SESSION['expodine_id']."' where tp_id='".$_REQUEST['id_load']."'");
       
    
        //cs bill cancel start///////
    
	$billno=$_REQUEST['billno'];
	$slno='';
        $credit_amount= 0;
        $credit_id= '';
	if(isset($_REQUEST['slno']))
	{
	$slno=$_REQUEST['slno']; 
	$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' AND tab_slno='".$slno."'");
	}else
	{
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billmaster set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
	}
	$sql_listall  = $database->mysqlQuery("SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall)
        {
                while($row = mysqli_fetch_array($sql_listall))
                      {
                      $credit_amount= $row['cd_amount'];
                      $credit_id= $row['cd_masterid'];
                      }
                      
            $sql_listall  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' ");         
        }
        
	$sql_listall  =  $database->mysqlQuery("delete from tbl_credit_details  where  cd_billno='".$billno."' ");
	 
	$reasontext=mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));
	date_default_timezone_set('Asia/Kolkata');
        $dateexp=date("Y-m-d H:i:s");
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
        $num_table3  = $database->mysqlNumRows($sql_table_sel3);
        if($num_table3)
        {
                while($row = mysqli_fetch_array($sql_table_sel3))
                      {
                          $rrt= $row['ser_cancelwithkey'];
                          $staff_cancel= $row['ser_firstname'];
                      }
        }
      if($rrt=="Y")
        {  
                      $result= "yes";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        }else
        {
                      $result= "no";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        }
	
	
	$sql='';
	if(isset($_REQUEST['slno']))
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."',  `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' AND tab_slno='".$slno."' ");
	
	}else
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' ");	
	$sql=$database->mysqlQuery("UPDATE  tbl_takeaway_billmaster SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."'  ");
	}
	if($sql)
	echo  "ok";
	else
	echo "sorry";
	
        
        
      ////////stockupdate//////
     $sql_table_sel3114  = $database->mysqlQuery("SELECT tab_menuid,tab_portion,tab_qty from tbl_takeaway_billdetails WHERE tab_billno ='".$billno."' ");
     $num_table3114  = $database->mysqlNumRows($sql_table_sel3114);
     if($num_table3114)
     {
	  while($row114 = mysqli_fetch_array($sql_table_sel3114))
		{
              
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$row114['tab_qty']."' "
              . " where mk_menuid= '".$row114['tab_menuid']."' "
              . " and mk_portion= '".$row114['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and  mk_opening_stock >0 ");
      
           
		}
     }  
     ////stockend///////   
        
     $customer="";
     $point_add=0;
     $point_redeem=0;
     $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_loyalty_pointadd_bill where  lob_billno='".$billno."'"); 
		  $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
		  if($num_sms1211)
		  {
		      while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
			{
                              $customer =$result_sms1211['lob_loyalty_customer'];
                              $point_add =$result_sms1211['lob_point_add'];
                              $point_redeem =$result_sms1211['lob_point_redeem'];
                              
                        } }
                        
    if($point_redeem>0 || $point_add>0){  
                  
     $sql_loy=$database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_points=(ly_points+'".$point_redeem."')-'".$point_add."' ,ly_totalvisit=ly_totalvisit-1 WHERE ly_id='".$customer."' ");
     $sql_loy1=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster  SET tab_redeem_amount='0' where tab_billno='".$billno."' ");
     $sql_loy_del=$database->mysqlQuery("Delete from tbl_loyalty_pointadd_bill where lob_billno ='".$billno."' ");       
    
    }
        
                $bill_tot_cancel=0;     
                $sql_table_sel311  = $database->mysqlQuery("SELECT * from tbl_takeaway_billmaster  WHERE  tab_billno ='".$billno."' ");
                $num_table311  = $database->mysqlNumRows($sql_table_sel311);
                if($num_table311)
                {
                        while($row11 = mysqli_fetch_array($sql_table_sel311))
                              {
                                  $bill_tot_cancel= $row11['tab_netamt'];
                              }
                }    
  
            $reasontext_cancel='';
            $sql_sms121 =  $database->mysqlQuery("Select * from tbl_cancellation_reasons where  cr_id=$reasontext"); 
		  $num_sms121  = $database->mysqlNumRows($sql_sms121);
		  if($num_sms121)
		  {
		        while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
			{
                                $reasontext_cancel   =$result_sms121['cr_reason'];
                        } }
  
        $dt= date("Y-m-d h:i:s");  
        $dt1=date("Y-m-d");
        $detail=" Bill no:$billno \n Cancelled by: $staff_cancel \n Cancelled time:$dt \n Cancelled reason:$reasontext_cancel \n Bill amount:$bill_tot_cancel ";
        
       $date_nw_nw=date('Y-m-d H:i:s');
        
     $sql12=$database->mysqlQuery("INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')");  
           
     
   ///inv start///   
       
   if($_SESSION['s_inventory_staff_add']=='Y' && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
      
  
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails  where tab_billno='$billno' and tab_status='Cancelled' "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
            
            
        ////product wise//
            
        $sql_listall  =  $database->mysqlQuery("select * from tbl_production where tp_product='".$result_inv['tab_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall){
          
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
                $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
              }else{
                  
               if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
               $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
           }else{
                  
                  
              $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
              $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
           }
            
          }
          
        }else{
            
        ///recipe wise///
            
       if($result_inv['tab_portion']!=''){
           $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['tab_portion']."' and tmi_cs='Y' "); 
       }else{
           $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_cs='Y'  ");        
       }
              
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
           
            $qty_inv=$result_inv['tab_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['tab_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
        if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
       }
            
        }}else{
            
            ///normalwise///
            
            if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
              $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
            }else{
                  
            if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
               $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
        
           }else{
                  
                  
            $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
           
            } } }
            
        }
              
   }}
          
  }
  
        ///inv end///        
     
        $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Bill Cancel' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
          $firebase_report_status=$result_login_fire2['tf_active'];
        }}
     
         if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y"){
          
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    require 'vendor/autoload.php';
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\Apache24\htdocs\expodine\src\service_google.json');
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
   $body = " Bill No: $billno \nBill Cancelled by: $staff_cancel \nCancelled time:$dt \nCancelled Reason:$reasontext_cancel \nBill Amount: $bill_tot_cancel ";
   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname'].'  - BILL CANCELLED',
            'body' => $body
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
      //  echo 'Error:' . curl_error($ch);
    } else {
      //  echo 'Response: ' . $response;
    }
    curl_close($ch);
 
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
   }
   }
              

    
    
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='excel_download'){
    
  error_reporting(0);
    
  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  
  $string='';
  
  
              if($_REQUEST['entry']!="" && $_REQUEST['entry1']!="")
		{
		    $from=$_REQUEST['entry'];
		    $to=$_REQUEST['entry1'];
		    $string.= " and tp_dayclose between '".$from."' and '".$to."'  ";
                   
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['entry']!="" && $_REQUEST['entry1']=="")
		{
                     $from=$_REQUEST['entry'];
		     $to=date("Y-m-d");
		     $string.= " and tp_dayclose between '".$from."' and '".$to."' ";
                    
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                else if($_REQUEST['entry']=="" && $_REQUEST['entry1']!="")
                {
                     $from=date("Y-m-d");
                     $to=$_REQUEST['entry1'];
                     $string.= " and tp_dayclose between '".$from."' and '".$to."'  ";
                    
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }else
                {
                     $from=$_SESSION['date'];
                     $to=$_SESSION['date'];
                     $string.= " and tp_dayclose between '".$from."' and '".$to."'  ";
                    
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
  
  
                
                
                
  
                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$_REQUEST['fromdt'];
		    $to=$_REQUEST['todt'];
		    $string.= " and tp_delivery_date between '".$from."' and '".$to."'  ";
                   
                    //$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$_REQUEST['fromdt'];
		     $to=date("Y-m-d");
		     $string.= " and tp_delivery_date between '".$from."' and '".$to."' ";
                    
                     //$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$_REQUEST['todt'];
                     $string.= " and tp_delivery_date between '".$from."' and '".$to."'  ";
                    
                     //$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
                
                
  
            if($_REQUEST['name']!='' ){
                    $string.=" and (tp_customer like '%".$_REQUEST['name']."%' or tp_number like '%".$_REQUEST['name']."%') ";
            }
    
    
            if($_REQUEST['number']!='' ){
              //$string.=" and tp_number like '%".$_REQUEST['number']."%' ";
            }
              
            if($_REQUEST['sts']!='' ){
            //  $string.=" and tp_status = '".$_REQUEST['sts']."' ";
            }
                
              
            if($_REQUEST['entry']!='' ){
             // $string.=" and tp_dayclose = '".$_REQUEST['entry']."' ";
            }else{
                // $string.=" and tp_dayclose = '".$_SESSION['date']."' ";
            }
              
              
                
            $data=array();
            $data1=array();
            $xlsRow=1;
            $final=0;
            $final_all=0;
            
            
            if($_REQUEST['type']=='customer'){
            
            $sql_login_combo  =  $database->mysqlQuery(" select * from tbl_advance_payment where tp_status ='Approved' $string ");
            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){
		  while($result_login_combo  = $database->mysqlFetchArray($sql_login_combo)) 
			{
                      
                          $final=$final+$result_login_combo['tp_amount'];
                           
                          $data['Sl']="";
                          $data['Item']="";
                          $data['Weight']="";
                          $data['Qty']="";
                          $data['Rate ']="";
                          $data['Total weight']="";
                          $data['Type']='';
                          $data['Total']="";
                          $data['Description']='';
                         
                          array_push($data1,$data);
                          unset($data);
                           
                           
                          $data['Sl']="#";
                          $data['Item3']='Id:'.$result_login_combo['tp_id'].' | Bill : '.$result_login_combo['tp_cs_bill'];
                          $data['Weight']='';
                          $data['Qty']='Name:'.$result_login_combo['tp_customer'];
                          $data['Rate ']='Ph:'.$result_login_combo['tp_number'].' | Mode : '.$result_login_combo['tp_mode'];
                          $data['Total weight']="";
                          $data['Type']='';
                          $data['Total']="Entry:".$result_login_combo['tp_dayclose'];
                          $data['Description']="Delivery:".$result_login_combo['tp_delivery_date'];
                        
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                        
            $xlsRow1=1;  $tot_all=0;            
            $sql_login_combo5  =  $database->mysqlQuery(" select * from tbl_advance_pay_menu_details where tmd_ref_id='".$result_login_combo['tp_id']."'  ");
            $num_login_combo5   = $database->mysqlNumRows($sql_login_combo5);
             if($num_login_combo5){
		  while($result_login_combo5  = $database->mysqlFetchArray($sql_login_combo5)) 
			{ 
                          
                          $data['Sl']=$xlsRow1++;
                          $data['Item']=$result_login_combo5['tmd_menu'];
                          $data['Weight']=$result_login_combo5['tmd_weight'];
                          $data['Qty']=$result_login_combo5['tmd_qty'];
                          $data['Rate ']=$result_login_combo5['tmd_rate'];
                        
                          $data['Total weight']=($result_login_combo5['tmd_weight']*$result_login_combo5['tmd_qty']);
                          $data['Type']=$result_login_combo5['tmd_type'];
                          $data['Total']=$result_login_combo5['tmd_total'];
                          $data['Description']=$result_login_combo5['tmd_description'];
                         
                          array_push($data1,$data);
                          unset($data);
                          
                          $tot_all=$tot_all+$result_login_combo5['tmd_total'];
                      
                          $final_all=$final_all+$result_login_combo5['tmd_total'];
                   }
                  }
                  
                          $data['Sl']='Paid:'.$result_login_combo['tp_amount'];
                        
                          $data['Item']='';
                          $data['Weight']='';
                          $data['Qty']='';
                          $data['Rate ']='';
                          $data['Total weight']='';
                          $data['Type']='';
                          $data['Total']=$tot_all;
                          $data['Description']='';
                         
                          
                          array_push($data1,$data);
                          unset($data);    
                  
                          
                  
                        }}
                        
                          $data['Sl']="";
                          $data['Item']="";
                          $data['Weight']='';
                          $data['Qty']="";
                          $data['Rate ']="";
                          $data['Total weight']='';
                          $data['Type']='';
                          $data['Total']="";
                      
                          $data['Description']='';
                         
                          array_push($data1,$data);
                          unset($data); 
                          
                          $data['Sl']='Total Paid:'.$final;
                          $data['Item']='';
                          $data['Weight']='';
                          $data['Qty']='';
                          
                          $data['Rate ']='';
                          $data['Total weight']='';
                          $data['Type']='';
                          $data['Total']=$final_all;
                            
                          $data['Description']='';
                        
                          
                          array_push($data1,$data);
                          unset($data);             
            
        
                          
            }else if($_REQUEST['type']=='item'){
                 
                
            $tot_all=0; $tot=0;
            $sql_login_combo57  =  $database->mysqlQuery(" select tmd_type,tmd_menu,sum(tmd_total) as total,sum(tmd_total_weight) as weight from tbl_advance_pay_menu_details  left join tbl_advance_payment on tbl_advance_payment.tp_id=tbl_advance_pay_menu_details.tmd_ref_id where tp_status ='Approved' $string  group by tmd_menu order by tmd_menu asc ");
            $num_login_combo57   = $database->mysqlNumRows($sql_login_combo57);
            if($num_login_combo57){
		  while($result_login_combo57  = $database->mysqlFetchArray($sql_login_combo57)) 
			{ 
                
                $tot=$result_login_combo57['weight'];
                
                          $data['Sl']='#';
                          $data['Item']=$result_login_combo57['tmd_menu'];
                          $data['Weight']='';
                          $data['Qty']='';
                          $data['Total Weight']=$tot.' '.$result_login_combo57['tmd_type'];
                          $data['Type']='';
                          $data['Total']='';
                          
                          array_push($data1,$data);
                          unset($data);
                          
                 $tot_all=$tot_all+$result_login_combo57['total'];
                 
                
             $si=1; 
            $sql_login_combo5  =  $database->mysqlQuery(" select *,sum(tmd_qty) as qty,sum(tmd_rate) as rate ,sum(tmd_total) as total,sum(tmd_weight) as weight from tbl_advance_pay_menu_details  left join tbl_advance_payment on tbl_advance_payment.tp_id=tbl_advance_pay_menu_details.tmd_ref_id where tp_status ='Approved' $string and tmd_menu='".$result_login_combo57['tmd_menu']."' group by tmd_menu,tmd_weight order by tmd_menu asc ");
            $num_login_combo5   = $database->mysqlNumRows($sql_login_combo5);
            if($num_login_combo5){
		  while($result_login_combo5  = $database->mysqlFetchArray($sql_login_combo5)) 
			{ 
                      
                          $data['Sl']=$si++;
                          $data['Item']=$result_login_combo5['tmd_menu'];
                         
                          $data['Weight']=$result_login_combo5['tmd_weight'];
                          $data['Qty']=$result_login_combo5['tmd_qty'];
                          //$data['Rate ']=$result_login_combo5['rate'];
                          $data['Total Weight']=$result_login_combo5['tmd_total_weight'];
                          $data['Type']=$result_login_combo5['tmd_type'];
                          $data['Total']=$result_login_combo5['total'];
                          
                          array_push($data1,$data);
                          unset($data);
                         
                          
                 }} 
                 
                          $data['Sl']='';
                          $data['Item']='';
                          $data['Type']='';
                          
                          $data['Weight']='';
                          $data['Qty']='';
                         
                          $data['Total Weight']='';
                          $data['Total']='';
                          array_push($data1,$data);
                          unset($data);   
                 
      } }
                          
                         
                  
                          $data['Sl']='Final Total';
                          $data['Item']='';
                          $data['Type']='';
                        
                          $data['Weight']='';
                          $data['Qty']='';
                          $data['Total Weight']='';
                         
                          $data['Total']=$tot_all;
                          array_push($data1,$data);
                          unset($data);      
                  
    }
                          
             
  $filename = "Advance Report - " . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
    }
  unset($data);
  unset($data1);
 
 exit;   
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='edit_all'){

    
    if($_REQUEST['method_type']=='add'){
    
    $fnct_menu = $database->mysqlQuery("select max(tp_id) as id from tbl_advance_payment where tp_dayclose='".$_SESSION['date']."' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) { 
             while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu)){
            
                 echo $result_fnctvenue['id'];
              }
               }
    }else{
        
        echo $_REQUEST['type_id'];
        
    }
}if(isset($_REQUEST['set']) && $_REQUEST['set']=='load' ){
    
    
$localhost=mysqli_connect('192.168.0.155', 'root', '1234','expodine_archive');

$json_arr = array();

         $sql_gen =  mysqli_query($localhost,"select tm,paymode,card,cash,credit,billno,staff ,tableno,delivery, subtotal,
             discount,final,paid, balance,dayclosedate,daytime from 
             
        (select bm_paymode as paymode,bm_billtime as tm,bm_transactionamount as card,(bm_amountpaid-bm_amountbalace) as cash ,
        (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,bm_billno as billno, null as staff ,
        bm_tableno as tableno, null as delivery, bm_subtotal as  subtotal,  bm_discountvalue as discount,bm_finaltotal as final,
        bm_amountpaid as paid,   bm_amountbalace as balance ,bm.bm_dayclosedate as dayclosedate,bm.bm_billtime as daytime 
        from tbl_tablebillmaster bm  
        where bm_dayclosedate between CURDATE( ) - INTERVAL 180  DAY AND CURDATE( )
        union all
        select tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,(tab_amountpaid-tab_amountbalace) as cash , 
        (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,  tab_billno as billno, 
        tab_loginid as staff ,null as tableno, null as delivery,  tab_subtotal as subtotal,tab_discountvalue as discount,
        tab_netamt as final,    tab_amountpaid as paid,   tab_amountbalace as  balance,bm.tab_dayclosedate as dayclosedate,bm.tab_time as daytime 
        from tbl_takeaway_billmaster
        bm  where  tab_dayclosedate between CURDATE( ) - INTERVAL 180  DAY AND CURDATE( )  )s
        order by dayclosedate ,tm ASC limit 100"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		//  echo $num_gen;
                  if($num_gen){ $i=1;
		while($result_lang459  = mysqli_fetch_array($sql_gen))
		{ 

              
              $json_arr[] = array(
                  "sl" => $i++,
                  "date" => $result_lang459['dayclosedate'],
                    "bill" => $result_lang459['billno'],
                   "table" => $result_lang459['tableno'],
                   "by" => $result_lang459['staff'],
                   "delivery" => $result_lang459['delivery'],
                   "subtotal" => $result_lang459['subtotal'],
                    "non_tax" => $result_lang459['final'],
                    "tax1" => $result_lang459['final'],
                    "tax2" => $result_lang459['final'],
                   "disc" => $result_lang459['discount'],
                    "final" => $result_lang459['final'],
                   "card" => $result_lang459['card'],
                   "cash" => $result_lang459['cash'],
                   "credit" => $result_lang459['credit'],
                  
                   );
              

                  }}
                  
                  echo json_encode($json_arr);
                  
 }
 
 if(isset($_REQUEST['set']) && $_REQUEST['set']=='bill_cs'){
        
     
     
     if(!isset($_SESSION['cs_order_id']))
     {
    
    
        $orderid="TEMP*".$database->getEpoch();
        //$_SESSION['cs_order_id']=$orderid;

        $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        
        $ips=  substr($localIP,($ln-3),3);
        
        
	 $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;

     }
     
     
        //// cs item adding /////
            
        $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
        
         $rbill=''; 
        $fnct_menu116 = $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."'  and "
        . " tab_adv_orderno='".$_REQUEST['ref_id']."' ");
        $num_fdtl16 = $database->mysqlNumRows($fnct_menu116);
        if ($num_fdtl16) {
        while ($result_fnctvenue16 = $database->mysqlFetchArray($fnct_menu116)){  
            
        $rbill=$result_fnctvenue16['tab_billno'];
            
         $sql_general =  $database->mysqlQuery("update  tbl_takeaway_billmaster set tab_regen_status='Y',tab_bill_reorder='$rbill'  where tab_dayclosedate='".$_SESSION['date']."' and tab_billno ='$rbill' ");
         
         $sql_general =  $database->mysqlQuery("update  tbl_takeaway_billdetails set tab_regen_status_menu='Y' where tab_dayclose_in='".$_SESSION['date']."' and tab_billno ='$rbill' ");
         
         $_SESSION['cs_order_id']=$rbill;
         
        }
        
        }else{
            
            $localIP = getHostByName(getHostName());

        $sql_chk="select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."' "
        . " and tab_billno='".$_SESSION['cs_order_id']."' and tab_system_ip!='$localIP' ";
        $sql_menuaddon1  =  mysqli_query($con,$sql_chk); 
        $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
        if($num_menuaddon){
                
        $orderid="TEMP*".$database->getEpoch();
           
        $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        $ips=  substr($localIP,($ln-3),3);
        
        $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;
         
       }
            
        } 
        
        ///new bill//    
        
        $sl=1; 
       
        $fnct_menu11 = $database->mysqlQuery("select * from tbl_advance_pay_menu_details where tmd_ref_id='".$_REQUEST['ref_id']."' and tmd_billed='N' ");
        $num_fdtl1 = $database->mysqlNumRows($fnct_menu11);
        if ($num_fdtl1) { 
        while ($result_fnctvenue1 = $database->mysqlFetchArray($fnct_menu11)){
        
        ///////item rate details/////    
            
        $rt='Portion'; $ut='';    $unit_id=0;  $base_unit_id=0; 
        $fnct_menu111 = $database->mysqlQuery("select * from tbl_menurate_counter where mrc_menuid='".$result_fnctvenue1['tmd_menuid']."' ");
        $num_fdtl11 = $database->mysqlNumRows($fnct_menu111);
        if ($num_fdtl11) { 
        while ($result_fnctvenue11 = $database->mysqlFetchArray($fnct_menu111)){
            
                if($result_fnctvenue11['mrc_base_unit_id']==''){
                       $base_unit_id=0;
                }else{
                       $base_unit_id=$result_fnctvenue11['mrc_base_unit_id'];
                }
                
                if($result_fnctvenue11['mrc_unit_id']==''){
                         $unit_id=0;
                }else{
                         $unit_id=$result_fnctvenue11['mrc_unit_id'];
                }
                
               
                $rt=$result_fnctvenue11['mrc_rate_type'];
                        
                $ut=$result_fnctvenue11['mrc_unit_type'];

        }
        }
        
        
       
        
        
            
        $rate_in=$result_fnctvenue1['tmd_rate'];   
           
        $unit_weight='0';
        
         $portion='1';
        
        if($result_fnctvenue1['tmd_weight']>0){
            
              $unit_weight=$result_fnctvenue1['tmd_weight'];
             
              $portion='0';
             
        }
        
        if($result_fnctvenue1['tmd_description']!=''){
                         $pref='';
        }else{
                         $pref=$result_fnctvenue1['tmd_description'];
        }
        
        $slno=$sl++;
        
        $localIP = getHostByName(getHostName());

//        echo 'order:'.$_SESSION['cs_order_id'].",";
//         echo 'menuid:'.$result_fnctvenue1['tmd_menuid'].",";
//         echo 'ratetype:'.$rt.",";
//         echo 'portion:'.$portion.",";
//         echo 'unittype:'.$ut.",";
//         echo 'unitweight:'.$unit_weight.",";
//         echo 'unitid:'.$unit_id .",";
//         echo 'baseid:'.$base_unit_id .",";
//         echo 'qty:'.$result_fnctvenue1['tmd_qty'].",";
//         echo 'Pref:adv,';
//         echo 'rate:'.$rate_in.",";
//         echo 'ord:'.$_SESSION['branchofid'].",";
//         echo 'mode:'."Add,";
//         echo 'type:'."CS,";
//         echo 'slno:'.$slno.",";
//         echo 'dishtype:1,';    
//         echo 'food:0';	
	
	
	$database->mysqlQuery("SET @temp_billno                 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue1['tmd_menuid']) . "'");
	$database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$portion) . "'");
	$database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$result_fnctvenue1['tmd_qty']) . "'");
	$database->mysqlQuery("SET @preferencetext 	        = " . "" . mysqli_real_escape_string($database->DatabaseLink,$pref) . "");
        //$database->mysqlQuery("SET @preferencetext = NULL");

	$database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rate_in) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'1') . "'");
	$database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'Add') . "'");
	$database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'CS') . "'");
	$database->mysqlQuery("SET @rate_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rt) . "'");
        $database->mysqlQuery("SET @unit_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ut) . "'");
        $database->mysqlQuery("SET @unit_id 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_id) . "'");
        $database->mysqlQuery("SET @base_unit_id 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$base_unit_id) . "'");
        $database->mysqlQuery("SET @unit_weight 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_weight) . "'");
	$database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        //$database->mysqlQuery("SET @dish_type                   = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @dish_type = NULL");

        $database->mysqlQuery("SET @food                        = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'0') . "'");
        
        $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id, "
        . "@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");
	
      
        //queries mandatory///
        
        $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billmaster set tab_subtotal=tab_subtotal-(select sum(`tab_amount`) from "
        . " tbl_takeaway_billdetails where `tab_billno`='".$_SESSION['cs_order_id']."' and tab_status='Generated' and "
        . " tab_bill_addon_slno='".$slno."') where tab_dayclosedate='".$_SESSION['date']."' and `tab_billno`='".$_SESSION['cs_order_id']."'");
       
        
        $sql_delete_detl=mysqli_query($con,"Delete FROM tbl_takeaway_billmaster   where tab_dayclosedate='".$_SESSION['date']."' "
        . " and (tab_billno='' or tab_billno is NULL) ");
         
      
        
       $sql_delete_addon=mysqli_query($con,"Delete  FROM tbl_takeaway_billdetails   where tab_dayclose_in='".$_SESSION['date']."' "
       . " and  tab_billno='".$_SESSION['cs_order_id']."' and tab_status='Generated' and  tab_bill_addon_slno='".$slno."'");
       
      
      
        //quries end///
        
        
         
        if($_SESSION['incl_bill_format']=='Y'){ 
             
        if($portion !=0){
                
              $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  where  "
              . " mrc_menuid='".$result_fnctvenue1['tmd_menuid']."' and mrc_portion='$portion'  ";
              
        }else{
                
                if($unit_id!=0){
                    $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  "
                    . "where  mrc_menuid='".$result_fnctvenue1['tmd_menuid']."' and  mrc_unit_id='$unit_id' and mrc_unit_weight='$unit_weight' ";
                }
                
                if($base_unit_id !=0){
                    
                    $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  where "
                    . " mrc_menuid='".$result_fnctvenue1['tmd_menuid']."' and mrc_base_unit_id='$base_unit_id'  ";
                }
                
        }
           
            $new_rate=0;
            $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                while($result_format  = mysqli_fetch_array($sql_menuaddon1)) 
                {
                    if($result_format['mrc_menu_final_amount']>0 && $result_format['mrc_menu_final_amount'] !=''){
                        $new_rate=$result_format['mrc_menu_final_amount'];
                        
                    }else{
                         $new_rate=$result_format['mrc_rate'];
                     
                    }
                    
                     if($_REQUEST['manualrate_val']=='Y' && $_SESSION['incl_bill_format']=='Y'){
                     
                       $new_rate=$_REQUEST['rate'];
                    }
                    
                    
               if($portion !=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".$new_rate."' where "
                  . " `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$result_fnctvenue1['tmd_menuid']."' and tab_portion='$portion'  ");     
          
           
               }else{
                
                if($unit_id!=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".$new_rate."' where "
                  . " `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$result_fnctvenue1['tmd_menuid']."' and "
                  . " tab_unit_weight='$unit_weight' and tab_unit_id='$unit_id'  ");     
                }
                
                
                if($base_unit_id !=0){
                    
                   $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".($new_rate*$unit_weight)."'"
                   . " where `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$result_fnctvenue1['tmd_menuid']."' and "
                   . " tab_unit_weight='$unit_weight' and tab_base_unit_id='$base_unit_id' ");     
                   
                }
                
                
              }
             
              } }
        
    }
  
    
     //$fnct_menu11 = $database->mysqlQuery("update tbl_advance_pay_menu_details set tmd_billed='Y' where tmd_ref_id='".$_REQUEST['ref_id']."' and tmd_menuid='".$result_fnctvenue1['tmd_menuid']."' ");
      
    
    }}
        
    
    $fnct_menu11 = $database->mysqlQuery("update tbl_advance_pay_menu_details set tmd_billed='Y' where tmd_ref_id='".$_REQUEST['ref_id']."'  ");
      
    
    $sql_delete_addon11=mysqli_query($con,"update tbl_takeaway_billdetails set tab_bill_addon_slno='0' where tab_dayclose_in='".$_SESSION['date']."' "
    . " and  tab_billno='".$_SESSION['cs_order_id']."' ");
       
    
    //////////////////cs billing  starts here /////////////        
           
    $table_name='';
    $pax='';
    $csname='';
    $csphone='';
    $csgst='';
    $discountof=0;
    $redeem_amt=0;
    
	try {
          
	$database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @branchid	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'1') . "'");
	$database->mysqlQuery("SET @discount	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'N') . "'");
	$database->mysqlQuery("SET @discount_of	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
	$database->mysqlQuery("SET @discount_unit	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @loginid 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	
        $database->mysqlQuery("SET @table 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'' ).  "'");	
        $database->mysqlQuery("SET @pax 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @redeem 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
  
	$message='';  $new_billno=''; $discountid=0;
	
	$database->mysqlQuery("SET @discountid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
        
	$kotno="";
	$sq=$database->mysqlQuery("CALL  proc_gencounter_bill(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid,@table,@pax,@redeem,@new_billno,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	$rs = $database->mysqlQuery( 'SELECT @new_billno AS billnumber,@message as message' );
	$billnos="";$kotnos="";
	while($row = mysqli_fetch_array($rs))
	{
	   $_SESSION['billno']= $row['billnumber'];
	   $msg= $row['message'];
        
	}
      
       $sql_listall588  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_netamt=tab_total  WHERE "
       . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."'  and  tab_netamt<(tab_total+tab_roundoff_value)  ");       
    
       
       
       
	} catch (Exception $e) {
                  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	}
	  
        
        $mode_pay=''; $name=''; $num=''; $paid=0; $tot=0; $bank='';  $bal=0;
        $fnct_menu115 = $database->mysqlQuery("select * from tbl_advance_payment where tp_id='".$_REQUEST['ref_id']."' ");
        $num_fdtl15 = $database->mysqlNumRows($fnct_menu115);
        if ($num_fdtl15) { 
        while ($result_fnctvenue15 = $database->mysqlFetchArray($fnct_menu115)){
            
            $mode_pay=$result_fnctvenue15['tp_mode'];
            $name= $result_fnctvenue15['tp_customer']; 
            $num= $result_fnctvenue15['tp_number'];  
            $paid= $result_fnctvenue15['tp_amount'];  
            $tot= $result_fnctvenue15['tp_final'];  
            $bank= $result_fnctvenue15['tp_bank']; 
            
            $bal= ((float)$tot-(float)$paid); 
            
            $bill_in=$result_fnctvenue15['tp_cs_bill']; 
        }
        } 
        
          
    //queries mandatory///
        
    $datetime=date("Y-m-d H:i:s");
      
    $sql_update_subtotal1=mysqli_query($con," update tbl_takeaway_billmaster set tab_loginid='".$_SESSION['expodine_id']."', "
    . " tab_system_ip='$localIP',tab_adv_orderno='".$_REQUEST['ref_id']."' ,tbl_takeaway_printed='Y' ,tab_bill_print='Y', "
    . " tbl_takeaway_print_time='".$datetime."', tab_name='$name', tab_phone='$num' where "
    . " tab_dayclosedate='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' ");
        
    $sql_delete_day=mysqli_query($con,"update tbl_takeaway_billdetails set tab_dayclose_in='".$_SESSION['date']."' "
    . " where tab_billno='".$_SESSION['billno']."' ");
       
    
      
    //quries end///
        
        
    
   
        /////bill settle cs////
    
       
    if($bill_in=='' || $bill_in==NULL) 
    {
      
        $tip_amount=0;
        $tip_mode=0;
        $guest_number='';
        $guest_name='';
        $billno='';
        $billno		        =$_SESSION['billno'];
	$mode			='CS';
	$creditype		=NULL;
        
         if($mode_pay=='CASH'){
             
                $typenam	='1';
                      
          }else if($mode_pay=='CARD'){
              
                $typenam	='2';
                
          }else if($mode_pay=='CREDIT'){
              
                $typenam	='6';
                
          }else if($mode_pay=='COMPLIMENTARY'){
              
                $typenam	='7';
          }
          
	$credit			='N';
	$amountpaid=0;
	
	$creditdeatils		=NULL;
	$paidamount_credit	=0;
	$amount_credit		=0;
        $credit_remark_cs	=NULL;
	
	$transactionamount	=0;
	$card_bank		=0;
	$complmtry		='N';
	$remark			=NULL;
	$voucherid		=NULL;
	$couponcompany		=NULL;
	$couponamt		=0;
	$chequeno		=NULL;
	$chequebankname		=NULL;
	$chequeamount		=0;
	$staff=NULL;
	$secretkey=NULL;
	$stafflist=NULL;
        $upi_amount=0;
        $upi_txn_id=0;
        
	if($mode_pay=="CREDIT")
	{      
                $credit_remark_cs       =NULL;
		$creditype		='4';
		
		$amountpaid             =$paid;
		$amount_credit		=$bal;
		$credit			='Y';
		$bal          		='0';
                
                $guest_number           =$num;
                $guest_name          	=$name;
                $creditdeatils          ='';
                    
                $database->mysqlQuery("SET @guestname			= " . "'" . $name . "'");
		$database->mysqlQuery("SET @guestphone			= " . "'" . $num . "'");
                $database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		$database->mysqlQuery("SET @credittype			= " . "'" . $creditype . "'");
                $message='';
		$guest=$database->mysqlQuery("CALL proc_credit_entry(@guestname,@guestphone,@branchid,@credittype,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$guest_id='';
                $guest1 = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($guest1))
		{
		   $guest_id= $row['message'];
		}
                
                $creditdeatils=$guest_id;
                
	}
        else if($mode_pay=="CASH")
	{
		$amountpaid=$paid;
		$bal ='0';
		
	}else if($mode_pay=="CARD")
	{
		$transactionamount=$paid;
		$card_bank =$bank;
                
		$amountpaid='0';
		$bal   ='0';
							 
	}else if($mode_pay=="COMPLIMENTARY")
	{
		$remark='COMP_ADVANCE';
		$complmtry='Y';
	}
	
       $returnmsg=''; 
        
       
        
        try {

		$database->mysqlQuery("SET @billno			= " . "'" . $billno . "'");
		$database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		$database->mysqlQuery("SET @paymodeid			= " .$typenam );
		$database->mysqlQuery("SET @amountpaid			= " . "'" . $amountpaid . "'");
		$database->mysqlQuery("SET @upi_amount			= " . "'" . $upi_amount . "'");
                $database->mysqlQuery("SET @upi_txn_id			= " . "'" . $upi_txn_id . "'");
                $database->mysqlQuery("SET @transactionamount      	= " . "'" . $transactionamount . "'");
		$database->mysqlQuery("SET @card_bank			= " . "'" . $card_bank . "'");
		$database->mysqlQuery("SET @complementary		= " . "'" . $complmtry . "'");
		$database->mysqlQuery("SET @remark			= " . "'" . $remark . "'");
		$database->mysqlQuery("SET @voucherid			= " . "'" . $voucherid . "'");
		$database->mysqlQuery("SET @couponcompany		= " . "'" . $couponcompany . "'");
		$database->mysqlQuery("SET @couponamt			= " . "'" . $couponamt . "'");
		$database->mysqlQuery("SET @chequeno			= " . "'" . $chequeno . "'");
		$database->mysqlQuery("SET @chequebankname 		= " . "'" . $chequebankname . "'");
		$database->mysqlQuery("SET @chequeamount		= " . "'" . $chequeamount . "'");
		$database->mysqlQuery("SET @credit				= " . "'" . $credit . "'");
		$database->mysqlQuery("SET @creditmasterid		= " . "'" . $creditdeatils . "'");
		$database->mysqlQuery("SET @creditamount		= " . "'" . $amount_credit . "'");
		$database->mysqlQuery("SET @balanceamt		        = " . "'" .$bal . "'");
		
		$database->mysqlQuery("SET @complementary_staff		= " . "'" . $staff . "'");
		$database->mysqlQuery("SET @mode		        = " . "'" . $mode . "'");
                $database->mysqlQuery("SET @payment_login		= " . "'" . $_SESSION['expodine_id'] . "'");
                $database->mysqlQuery("SET @credit_remark_cs		= " . "'" . $credit_remark_cs . "'");
                $database->mysqlQuery("SET @order_confirming_staff = " . "'".$_SESSION['login_dayopen_staffid']."'");
                
//      echo $billno.'-'.$_SESSION['branchofid'].'-'.$typenam.'-'.$amountpaid.'-'.$upi_amount.'-'.$upi_txn_id.'-'.$transactionamount.'-'.$card_bank.'-'.
//      $complmtry.'-'.$remark.'-'.$voucherid
//     .'-'.$couponcompany.'-'.$couponamt.'-'.$chequeno.'-'.$chequebankname.'-'.$chequeamount.'-'.$credit.'-'.$creditdeatils.'-'.$amount_credit.'-'.$bal
//    .'-'.$staff.'-'.$mode.'-'.$_SESSION['expodine_id'].'-'.$credit_remark_cs.'-'.$_SESSION['login_dayopen_staffid'];
		 
		$message='';
		$kotno='';
		$sq=$database->mysqlQuery("CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	
	        $s='';
		$rs = $database->mysqlQuery( 'SELECT @message AS message,@kotno AS kotno' );
		while($row = mysqli_fetch_array($rs))
		{
                    
		  $s= $row['message'];
		  echo $_SESSION['printkotno']=$row['kotno'];
                  
		}
                
		$returnmsg=$s;
                
		$_SESSION['printkotbillno']=$_SESSION['billno'];
	
                
        if($_SESSION['s_printst']=='Y'){
            
            require_once("printer_functions.php");
            $printpage=new PrinterCommonSettings();
          
            require_once("Escpos.php");
     
            $homed="CS";
            
            $printpage->print_bill_ta($_SESSION['billno'],$homed,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],'');
       
        }
                
                
                
         if($_SESSION['s_printst']=='Y'){
             
                 
	//$printpage->print_kot_ta( $_SESSION['printkotno'],$_SESSION['billno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");
      
        //$printpage->print_kot_ta_consolidated( $_SESSION['printkotno'],$_SESSION['billno'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
       
        }       
        
         ///inv start///   
                 
        if($_SESSION['s_inventory_staff_add']=='Y'  && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
            
        $sql_login_invstore  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_staff_store='".$_SESSION['ser_store_inv']."'   where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' ");    
            
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails  where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' limit 100 "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
          
       ////product wise//
       $sql_listall  =  $database->mysqlQuery("select tp_product from tbl_production where tp_product='".$result_inv['tab_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
       $num_listall  = $database->mysqlNumRows($sql_listall);
       if($num_listall){
            
        if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
        }else{
                  
                  
        if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }
        
       }
          
       }else{
           
        ///recipe wise///
           
        if($result_inv['tab_portion']!=''){
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['tab_portion']."' and tmi_cs='Y' "); 
         }else{
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."'  and tmi_cs='Y' ");     
        }
           
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
        
            $qty_inv=$result_inv['tab_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['tab_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
       if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
       }
           
        }}else{
           
            ///normalwise///
           
        if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
    
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
        }else{
                  
        if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        
        } } }
        
       }
          
         ////foodcost entry///
       
        $food_cost_menu=0;
        $sql_login_cost  =  $database->mysqlQuery("select sum(tfc_total) as cost from tbl_food_cost where"
        . " tfc_menu='".$result_inv['tab_menuid']."' and tfc_cs='Y' group by tfc_menu,date(tfc_date) order by tfc_date asc  "); 
	$num_login_cost    = $database->mysqlNumRows($sql_login_cost );
	if($num_login_cost ){ 
	while($result_login_cost   = $database->mysqlFetchArray($sql_login_cost)) 
        { 
            
          $food_cost_menu=($result_inv['tab_qty']*$result_login_cost['cost']);
          
        }}
       
        $sql_login_inv_cost  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_cost='$food_cost_menu' where"
        . " tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' and tab_menuid='".$result_inv['tab_menuid']."' "); 
       
         ////foodcost end///
        
       }}
        
       }  
       
        ///inv end///        
                   
        $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Complimentary Settle' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
            $firebase_report_status_comp=$result_login_fire['tf_active'];
        }}
        
        
        $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Credit Settle' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
            $firebase_report_status_credit=$result_login_fire2['tf_active'];
        }}
        
        
           
    if($num!=''){
           
        $lid=0;
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$num."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
           while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
           {    
               $lid=$result_login_fire22['ly_id'];
                    
        } }else{
            
        $loy_qry14 = $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`) VALUES ('".$name."','".$num."')");
             
        
        
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$num."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
           while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
           { 
                 $lid=$result_login_fire22['ly_id'];
            }
           }
        }
           
       $date= date('Y-m-d H:i:s');   $mode="CS";  
        
       $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
       $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($tot));
       $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($lid));
       $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
       $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
        if($sql!=1)
	{
	  $insertid      =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
        
    }     
    
     $sql_delete_day5=mysqli_query($con,"update tbl_advance_payment set tp_cs_bill='".$_SESSION['billno']."' "
    . " where tp_id='".$_REQUEST['ref_id']."' "); 
    
  
 
        
                  
  if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && (($credit=="Y" && $firebase_report_status_credit=='Y') || ($complmtry=="Y" && $firebase_report_status_comp=='Y'))){
         
        $staff_pay1=$_SESSION['expodine_id'];
      
        $date_nw_nw=date('Y-m-d H:i:s');
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
          $amt_fire=1;
            
          if($credit == "Y" ){
              
               $title1=$_SESSION['s_branchname']." :  CREDIT BILL ";
              
               $data_body=" CREDIT BILL \nBill No:  $billno  \nDate:$date_nw_nw \nCredit Amount :$amount_credit \nAuthorization Staff: $staff_pay1 \nBill Amount : $amt_fire  ";
              
          }else if($complmtry == "Y" ){   
              
               $title1=$_SESSION['s_branchname']." :  COMPLIMENTARY BILL ";
               $data_body=" COMPLIMENTARY BILL \nBill No:  $billno  \nDate:$date_nw_nw \nAuthorization Staff: $staff_pay1 \nBill Amount : $amt_fire  ";
          }
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    $body = $data_body;
     require 'vendor/autoload.php';
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\Apache24\htdocs\expodine\src\service_google.json');
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

    $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";

    $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $title1,
            'body' => $body
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , 
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', 
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
    curl_close($ch);
   
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    
    } }
                   
    $queryupdate_cancel=$database->mysqlQuery("update tbl_takeaway_cancel_items set tc_cancel_kotno='".$_SESSION['printkotno']."' "
    . " where tc_billno='".$billno."' ");
                 
   
     exit();
    
                 
    } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
   }
	
  }
    
 }
 
?>