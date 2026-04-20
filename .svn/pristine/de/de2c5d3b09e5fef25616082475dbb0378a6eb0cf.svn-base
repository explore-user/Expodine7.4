<style>form{font-family:Arial, Helvetica, sans-serif}</style>
<?php
include('../includes/session.php');		// Check session
//session_start();
include("../database.class.php"); // DB Connection class

$database	= new Database();

if($_SERVER['REQUEST_METHOD'] == 'POST' ) //&&  $_REQUEST['type']=="insert"
{
	
	//`tbl_staffattendence`(`sce_staffid`, `sce_date`, `sce_timein`, `sce_timeout`)
	$hour=$_REQUEST['hourset'];
	$minute=$_REQUEST['minset'];
	$ampm=$_REQUEST['ampm'];
	$time=$hour.":".$minute.":00"." ".$ampm;
	$finaldate= date("H:i:s", strtotime($time)); 
	 $type=$_REQUEST['type'];
	
	if($type=="insert ")
	{
	$insertion['sce_timeout']=$finaldate;
	$insertion['sce_staffid']=$_REQUEST['stw'];
	$insertion['sce_date']=$_REQUEST['dt'];
	mysqli_query($database->DatabaseLink,"Update tbl_staffattendence set sce_timeout='".$finaldate."' where sce_staffid='".$_REQUEST['stw'] ."' and sce_date='".$_REQUEST['dt']."'");
	// $sql=$database->check_duplicate_entry('tbl_staffattendence',$insertion);
	// if($sql!=1)
	/*{
	$insertid              			=  $database->insert('tbl_staffattendence',$insertion);
	 }*/
	}else if($type=="update ")
	{
		$condition		 = 'sce_staffid='.$_REQUEST['stw'] .' and sce_date=\''.$_REQUEST['dt'].'\'';
		$update['sce_timeout']=$finaldate;
		
		mysqli_query($database->DatabaseLink,"Update tbl_staffattendence set sce_timeout='".$finaldate."' where sce_staffid='".$_REQUEST['stw'] ."' and sce_date='".$_REQUEST['dt']."'");
		
		//$insertid=  $database->update('tbl_staffattendence',$update,$condition);	
	}
	
	 
	header("location: ../attendence_staff.php");
	
}

if(($_REQUEST['mode']=="view")){ ?>
      <div class="container-fluid" style="margin-top: 20px;">
          <div class="row">
              <div class="col-lg-12">
                  <form>
                      <legend style="  display: block;width: 100%;padding: 0;margin-bottom: 13px;margin-top: -10px;font-size: 21px;line-height: inherit;color: #333;text-align: center;border: none;">Attendence</legend>
                      <div class="form-group" style="width:99% !important; border:1px solid #A5A5A5;margin-right:1%;padding:2% !important;">
                      
                      <div style="width:100%; float:left;line-height:34px;font-size:14px;">TIME OUT</div>
                        <?php
						$date=$_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['day'];
						//`tbl_staffattendence`(`sce_staffid`, `sce_date`, `sce_slno`, `sce_timein`, `sce_timeout`)
						//echo "Select * from tbl_staffattendence Where sce_date = '".$date."' and sce_staffid='".$_REQUEST['stew']."'";
						$sql_table_sel  =  $database->mysqlQuery("Select * from tbl_staffattendence Where sce_date = '".$date."' and sce_staffid='".$_REQUEST['stew']."' and sce_timeout<>''"); 
					$num_table  = $database->mysqlNumRows($sql_table_sel);
					if($num_table){
						  while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
							  { 
							  echo $result_table_sel['sce_timeout'];
							  }
					}
						?>  
                         
                      </div>
                      <div style="width: 100%;" class="form-group">
                          <button style="width:100%;height:auto;padding: 5px;margin: 5px 0 10px;" type="button" class="btn btn-primary btn-block sub_btn closefull" id="close-nicemodal">OK</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
<?php }  else if(($_REQUEST['mode']=="add")){ 
	
	$date=$_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['day'];
	?>
<div class="container-fluid" style="margin-top: 20px;">
	<div class="row">
		<div class="col-lg-12">
			<form name="submitin" id="submitin" action="<?=$_SERVER['PHP_SELF']?>" method="post">
				<legend style="  display: block;width: 100%;padding: 0;margin-bottom: 13px;margin-top: -10px;font-size: 21px;line-height: inherit;color: #333;text-align: center;border: none;">Attendence</legend>
				<div class="form-group" style="width:99% !important; border:1px solid #A5A5A5;margin-right:1%;padding:2% !important;">
                
                <div style="width:100%; float:left;line-height:34px;font-size:14px;">TIME OUT</div>
					<?php
					$hour="";
					$minute="";
					$ampm="";
					//echo "Select * from tbl_staffattendence Where sce_date = '".$date."' and sce_staffid='".$_REQUEST['stew']."'";
					$sql_table_sel  =  $database->mysqlQuery("Select * from tbl_staffattendence Where sce_date = '".$date."' and sce_staffid='".$_REQUEST['stew']."' and sce_timeout<>''"); 
					$num_table  = $database->mysqlNumRows($sql_table_sel);
					if($num_table)
					{
					  while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
						  { 
						  		 $in=$result_table_sel['sce_timeout'];
								
								//$out=$result_table_sel['sce_timeout'];
								$tm=date('g:i a', strtotime($in));
								$splt=explode(" ",$tm);
								$hm=$splt[0];
								$ampm=$splt[1];
								
								$splt1=explode(":",$hm);
								$hour=$splt1[0];
								 $minute=$splt1[1];
								
								
						  }
					}else
					{
						$hour="";
						$minute="";
						$ampm="";
					}
					?>
					<select id="hourset" name="hourset" class="form-control_main" style="width:30%;margin-right:3%;" >
                    <option value="">Hour</option>
                    <?php for($i=1;$i<=12;$i++) { ?>
                    <option value="<?=$i?>" <?php if($hour==$i){ ?> selected="selected" <?php } ?>><?=$i?></option>
                    <?php } ?>
                    </select>
                    
                    <select id="minset" name="minset" class="form-control_main" style="width:30%;margin-right:3%;" >
                    <option value="">Minute</option>
                    <option value="00" <?php if($minute=="00"){ ?> selected="selected" <?php } ?>>00</option>
                   <?php for($i=5;$i<=55;$i=$i+5) { ?>
                   <?php if($i==5) $v="05"; else $v=$i; ?>
                    <option value="<?=$v?>" <?php if($minute==$v){ ?> selected="selected" <?php } ?>><?=$v?></option>
                    <?php } ?>
                    </select>
                    
                    <select id="ampm"  name="ampm" class="form-control_main" style="width:30%;" >
                    <option value="AM" <?php if($ampm=="am"){ ?> selected="selected" <?php } ?> >am</option>
                    <option value="PM" <?php if($ampm=="pm"){ ?> selected="selected" <?php } ?>>pm</option>
                    
                    </select>
                   <input type="hidden"  name="type" id="type" value="<?php if($hour!=""){ echo "update"; } else {echo "insert";} ?> "  /> 
                  <input type="hidden"  name="mode" id="mode" value="add"  /> 
                  <input type="hidden"  name="stw" id="stw" value="<?=$_REQUEST['stew']?>"  />
                  <input type="hidden"  name="dt" id="dt" value="<?=$date?>"  />
				</div>
				
				
              
				<div style="width: 100%;" class="form-group">
                <?php if($hour!="") { ?>
                <a onclick="validatepage()"  style="width:100%;height:auto;padding: 5px;margin: 5px 0 10px;" class="btn btn-primary btn-block sub_btn closefull">Update</a>
                <?php } else { ?>
                <a onclick="validatepage()"  style="width:100%;height:auto;padding: 5px;margin: 5px 0 10px;" class="btn btn-primary btn-block sub_btn closefull">Submit</a>
                <?php } ?>
					<!--<button style="width:100%;height:auto;padding: 5px;margin: 5px 0 10px;" type="submit" class="btn btn-primary btn-block sub_btn closefull">SUBMIT</button>-->
				</div>
			</form>
		</div>
	</div>
</div>


<?php } ?>

<script>
function validatepage()
{
	if(document.getElementById("hourset").value=="")
	{
		alert("Enter Hour");
		return false;
	}
	if(document.getElementById("minset").value=="")
	{
		alert("Enter MInutes");
		return false;
	}
	document.submitin.submit();
}
</script>