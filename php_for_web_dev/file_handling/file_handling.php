<?php 

try{
	$fileName = "sticky_file.txt";
	if(!file_exists($fileName)) throw new Exception("File not found");
	//if we want to replace the content of the file with new text
	//$fileResource = fopen($fileName, 'w');

	//if we want to just add additional text
	//$fileResource = fopen($fileName, 'a');
	//fwrite($fileResource, " ,this is another content");

	//deleting a file
	$status = unlink($fileName);
	if($status){
		echo "File deleted successfully";
	}else {
		echo "File was not  deleted";	
	}

}catch(Exception $exception){
	echo $exception;
}
 ?>
