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
  
  
if(isset($_REQUEST['set']) &&  $_REQUEST['set']=='vendor_voucher_report'){
    
     $data=array();
            $data1=array();
  
    $string='';
    
    if($_REQUEST['v_name']!=''){
    $string.=" and tv.v_name like '%".$_REQUEST['v_name']."%'   ";
    }
    
     if($_REQUEST['search_inv_no']!=''){
    $string.=" and ts.sv_invoice_no like '%".$_REQUEST['search_inv_no']."%'   ";
    }
    
    
    
     if($_REQUEST['search_type']!=''){
    $string.=" and ts.sv_purchase_type = '".$_REQUEST['search_type']."'   ";
    }
    
     if($_REQUEST['search_tax_type']!=''){
         
     if($_REQUEST['search_tax_type']=='vat'){
         
    $string.=" and ts.sv_tax > '0' and ts.sv_type_pay='First'  ";
    
    }else{
        
        $string.=" and ts.sv_tax = '0' and ts.sv_type_pay='First'  ";
    }
    
     }

    $pd='yes';
     if($_REQUEST['search_payment_type']!=''){
    
    if($_REQUEST['search_payment_type']=='paid'){
        
        $string.=" and ts.sv_paid_amount > '0' ";
        
        $pd='no';
    
       }else{
        
       $string.=" and  ts.sv_entry_type='Credit'  and ts.sv_paid_fully= 'N' and ts.sv_type_pay='First'  "; 
       
        }
    
     }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$_REQUEST['todt']."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and  ts.sv_date between '".$_REQUEST['fromdt']."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and ts.sv_date between '".$from."' and '".$_REQUEST['todt']."' ";
                        
		}
    
       $inv_amount=0;
       $sub_amount=0;
       $tax_amount=0;
   
    $tot_paid_sup=0; $tot_sv_invoice_amount=0;
    
    $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_supplier_voucher ts  left join  tbl_vendor_master tv on tv.v_id=ts.sv_vendor_id left join tbl_ledger_master tm on tm.tlm_id=ts.sv_from  where tv.v_name!='' $string order by ts.sv_id desc"); 
  
    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=1;
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { //$i++;   

               
                      $data['Sl No']=$i++;
                 
                      $data['Supplier']=$result_kotlist['v_name'];
                 
                      $data['Date']=$result_kotlist['sv_date'];
                      $data['Particulars']=$result_kotlist['sv_remarks'];
                       $data['Invoice No']=$result_kotlist['sv_invoice_no'];
                       $data['Subtotal']=$result_kotlist['sv_subtotal'];
                       $data['Tax']=$result_kotlist['sv_tax'];
                       
                      $data['Invoice Amount']=$result_kotlist['sv_invoice_amount'];
                     $data['Paid Amount ']=$result_kotlist['sv_paid_amount'];
                    $data['Credit Amount']=$result_kotlist['sv_credit_amount'];
                    
                      $data['Voucher Id']=$result_kotlist['sv_id'];
                    $data['From Acc']=$result_kotlist['tlm_ledger_name'];
                   $data['Return Amount']=$result_kotlist['sv_return_amount'];
                   
                 array_push($data1,$data);
                          unset($data);
                          
                          
   if($result_kotlist['sv_type_pay']=='First'){
       
       $inv_amount=$inv_amount+$result_kotlist['sv_invoice_amount'];
       $sub_amount=$sub_amount+$result_kotlist['sv_subtotal'];
       $tax_amount=$tax_amount+$result_kotlist['sv_tax'];
       
   }


             $tot_paid_sup=$tot_paid_sup+$result_kotlist['sv_paid_amount'];
             
             $tot_sv_invoice_amount=$tot_sv_invoice_amount+$result_kotlist['sv_invoice_amount'];

}



                         $data['Sl No']='Total';
                 
                      $data['Supplier']='';
                 
                      $data['Date']='';
                      $data['Particulars']='';
                       $data['Invoice No']='';
                       $data['Subtotal']=$sub_amount;
                       $data['Tax']=$tax_amount;
                       
                      $data['Invoice Amount']=$inv_amount;
                     $data['Paid Amount ']=$tot_paid_sup;
                     
                             if($pd=='no'){  
                                  $data['Credit Amount']='';
                              }else{ 
                                  
                              $data['Credit Amount']=($inv_amount-$tot_paid_sup);
                                               
                             } 
                     
                     
                   
                    
                      $data['Voucher Id']='';
                    $data['From Acc']='';
                   $data['Return Amount']='';
                   
                 array_push($data1,$data);
                          unset($data);


}

$filename = " Supplier Voucher.xls";
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
?>