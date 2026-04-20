<?php
error_reporting(0);
session_start();
include("..\database.class.php"); 	
	
$database	= new Database(); 

if( $_REQUEST['type']=="loyalty_pdf")
{
  $string="";
    $name='';
    $email='';
    $phone='';
    if($_REQUEST['name']!="" || $_REQUEST['email']!="" || $_REQUEST['number']!=""){
         $string.='where ';
           $string.='ly_branchid="1" ';
    }
           $email=  trim($_REQUEST['email']);
           $name=  trim($_REQUEST['name']);
           $phone=  trim($_REQUEST['number']);
             
             
          if($_REQUEST['name']!=""){
             if(strlen($_REQUEST['name'])>2){
          $string.=" and  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%')  ";
          }
          }
          
        if($_REQUEST['email']!=""){
             if(strlen($_REQUEST['email'])>2){
         $string.=" and ly_emailid LIKE '%".$email."%' ";
          }
        }
       if($_REQUEST['number']!=""){
               if(strlen($_REQUEST['number'])>2){
         $string.=" and ly_mobileno LIKE '%".$phone."%' ";
          }
       }
       
       
       
       
                $return.="\r\n";
                $menulist= array(
                        new report_head("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                
                $menulist= array(
                        new report_head("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
               
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                
	
	$return.="\r\n";
	$return.="----------------------------------------------------------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new cancel_history("Slno","Name","Phone", "Email","Birthday","Aniversary","Profession","Visits","Status","Entry Date","Entry From7"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------------------------------------------------------";
        $return.="\r\n";
    
	

 	   $sql_login  =  $database->mysqlQuery("select * from tbl_loyalty_reg $string ");
      $num_login   = $database->mysqlNumRows($sql_login);
  
	
	  if($num_login)
	  {       $i=0;
              while($result_login  = $database->mysqlFetchArray($sql_login))
                {
                     $i++;
                        
               
                        $dataName=$result_login['ly_firstname']. $result_login['ly_lastname'];
                        $dataMobile=$result_login['ly_mobileno'];
                        $dataEmail=$result_login['ly_emailid'];
                        $dataBirthday=$result_login['ly_birthdaydate'];
                        $dataAniversary=$result_login['ly_anniversarydate'];
                        $dataProfession=$result_login['ly_profession'];
                        $datavisits=$result_login['ly_totalvisit'];
                        $dataStatus=$result_login['ly_status'];
                        $dataEntrydt=$result_login['ly_entrydatetime'];
                        $dataEntryfr=$result_login['ly_entry_from'];
                        
                         $menulist= array(
                                new cancel_history($i,$database->$dataName,$dataMobile,$dataEmail,$dataBirthday,$dataAniversary,$dataProfession,$datavisits,$dataStatus,$dataEntrydt,$dataEntryfr),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			
			}
			}
                  
                        $return.="----------------------------------------------------------------------------------------------------------------------";
                       
			$return.="\r\n";
                        $return.="----------------------------------------------------------------------------------------------------------------------";

	}
        require_once('D:/fpdf.php'); 
ob_end_clean(); //    the buffer and never prints or returns anything.
ob_start(); // it starts buffering
$pdf = new FPDF('P','cm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetLeftMargin(2);
$pdf->MultiCell(72,0.5,$return);
$pdf->Output();
ob_end_flush();	

 
class report_head {
    private $head;
    
    public function __construct($head = '') {
        $this -> head = $head;
       
    }

    public function __toString() {
        $centerCols ="125%";
		
                $centercol = str_pad($this -> head, $centerCols,' ', STR_PAD_BOTH) ;
		
		
        return "$centercol\n";
    }
} 



class cancel_history {
    private $slno;
    private $kot;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$kot = '',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> kot = $kot;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols ="10%";
	$leftCols1 ="15%";
        $leftCols2 ="20%";
        $rightCols ="15%";
	$rightCols1 ="20%";
        $rightCols2 ="20%";
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $leftCols1,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left1$left2$right$right1$right2\n";
    }
}

?>