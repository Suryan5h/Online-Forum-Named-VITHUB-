<?php
$target_dir="uploads/";
$target_file=$target_dir.basename($_FILES["filetoupload"]["name"]);
$uploadok=1;
$imageFileType=pathinfo($target_file.PATHINFO_EXTENSION);
//image is actual or fake
if(isset($_POST["submit"])){
	$check=getimagesize($_FILES["filetoupload"]["tmp_name"]);
	if($check!==false){
		echo "File is an image".$check["mime"].".";
		$uploadok=1;
	}
	else{
		echo "File is not an image";
		$uploadok=0;
	}
}
//check if file exists
if(file_exists($target_file)){
	echo "Sorry, file exists";
	$uploadok=0;
}
//limit size
if($_FILES["filetoupload"]["size"]>500000){
	echo "Sorry, file to large";
	$uploadok=0;
}
//limit file type
if($imageFileType!="jpg" || $imageFileType="png" || $imageFileType="jpeg" || $imageFileType="gif"){
	echo "Sorry,file not allowed";
	$uploadok=0;
}
?>