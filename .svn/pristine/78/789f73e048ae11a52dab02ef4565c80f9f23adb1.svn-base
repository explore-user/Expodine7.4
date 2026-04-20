<?php
include("includes/session.php");

include("database.class.php");

$database	= new Database(); // Create a new instance

$path = "uploads/";

//print $_SESSION['upload_id']; exit();

$upid= $_REQUEST['upid'];
$menuid=$_REQUEST['menuid'];

function getExtension($str) {

         $i = strrpos($str,".");

         if (!$i) { return ""; }

         $l = strlen($str) - $i;

         $ext = substr($str,$i+1,$l);

         return $ext;

 }
define ("WIDTH","168"); 
define ("HEIGHT","122");
define ("MAXWIDTH","500");  
define ("MAXHEIGHT","500");

function make_thumb($img_name,$filename,$new_w,$new_h)
 {
 	//get image extension.
 	$ext=getExtension($img_name);
 	//creates the new image using the appropriate function from gd library
 	if(!strcasecmp("jpg",$ext) || !strcasecmp("jpeg",$ext))
 		$src_img=imagecreatefromjpeg($img_name);
  	if(!strcasecmp("png",$ext))
 		$src_img=imagecreatefrompng($img_name);
	if(!strcasecmp("gif",$ext))
 		$src_img=imagecreatefromgif($img_name);
 	 	//gets the dimmensions of the image
 	$old_x=imageSX($src_img);
 	$old_y=imageSY($src_img);

//thumb create using specific width and height starts here 
$thumb_w=$new_w;
$thumb_h=$new_h;
//thumb create using specific width and height ends here 
	// we create a new image with the new dimmensions
 	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	// resize the big image to the new created one
 	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
 	// output the created image to the file. Now we will have the thumbnail into the file named by $filename
 	if(!strcmp("png",$ext))
 		imagepng($dst_img,$filename); 
	else if(!strcmp("gif",$ext))
 		imagegif($dst_img,$filename); 
 	else
 		imagejpeg($dst_img,$filename); 
  	//destroys source and destination images. 
 	imagedestroy($dst_img); 
 	imagedestroy($src_img); 
 }


$valid_formats = array("jpg", "png", "gif", "bmp", "tif", "jpeg");


if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){ 

			$name = $_FILES['uploadfile']['name'];
			
			$size = $_FILES['uploadfile']['size'];


			if(strlen($name))

				{
					
					list($txt, $ext) = explode(".", $name);

					$ext=strtolower($ext);

					if(in_array($ext,$valid_formats))

					{

					if($size<(1024*1024*4))

						{

							if($_FILES['uploadfile']['tmp_name'])

								{

								$actual_file_name = $txt.".".$ext;
	
								$tmp = $_FILES['uploadfile']['tmp_name'];
	
								
	
								list($width, $height) = getimagesize($_FILES['uploadfile']['tmp_name']);
	
                                                                
                                                               
								  
	                                                        $file_name='-'.$_REQUEST['menuid'];
                                                                        
								$save_name = "PACK".$file_name;
							
								
								$save_thumb="TMB".$file_name;
								
								$filepath = $path."$save_name".".".$ext;
								$filepath_thumb = $path."$save_thumb".".".$ext;
	
								$new_file_name	= $filepath;
								$new_file_thumb	= $filepath_thumb;
	
								$db_sve_name	= "uploads/$save_name".".".$ext;
								$db_sve_thumb	= "uploads/$save_thumb".".".$ext;
	
								$copied = copy($_FILES['uploadfile']['tmp_name'], $filepath);
								$copied = copy($_FILES['uploadfile']['tmp_name'], $filepath_thumb);
                                                                
                                                                
                                                                
								if($width > MAXWIDTH && $height > MAXHEIGHT) 
								{
									$save_thumb_name="PACK".$file_name;
									$filethumb_large = $path."$save_thumb_name".".".$ext;
									$db_sve_name=$filethumb_large;			
									$thumb_large=make_thumb($filepath,$db_sve_name,MAXWIDTH,MAXHEIGHT);
								}else
								{
									$save_thumb_name="PACK".$file_name;
									$filethumb_large = $path."$save_thumb_name".".".$ext;
									$db_sve_name=$filethumb_large;			
									$thumb_large=make_thumb($filepath,$db_sve_name,MAXWIDTH,MAXHEIGHT);								}
								if($width != WIDTH && $height != HEIGHT) 
								{
									$save_thumb_name_tb="TMB".$file_name;
									$filethumb_large_tb = $path."$save_thumb_name_tb".".".$ext;
									$db_sve_thumb=$filethumb_large_tb;			
									$thumb_large=make_thumb($filepath_thumb,$db_sve_thumb,'168','122');
								}
	
									$insertion['mes_imagethumb']			= $db_sve_thumb;					
									$insertion['mes_imagename']			= $db_sve_name;
							
								       $insertion['mes_menuid']=$menuid;
                                                                
	                                
									$insertId	= $database->insert('tbl_menuimages',$insertion);
									
							
									$fwd_name	= $actual_file_name;
	
									echo "success|$fwd_name"; 
                                                                      
                                                                    
                                                                }

								else{

								echo "error";
								//echo "success";
								}

							}

							else{

							echo "error";
							//echo "success";
							}

						}

						else{

						echo "error";
						//echo "success";
						
						}

				}
				else{

				//echo "error";
					echo "success";
				}

				

	$sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");		

}


?>

