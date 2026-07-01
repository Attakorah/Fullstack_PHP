<?php 

	function checkIfDatabaseExist(){
		$servername = "localhost";
		$username = "root";
		$password = "mysql";
		$dbname = "dictionary";
		$conn = mysqli_connect($servername,$username,$password);
		if (!mysqli_select_db($conn,$dbname)){
			$createDatabase = "CREATE DATABASE IF NOT EXISTS $dbname";
			mysqli_query($conn,$createDatabase);
		}
		mysqli_close($conn);
	}

	function checkIfTableExist(){
		$servername = "localhost";
		$username = "root";
		$password = "mysql";
		$dbname = "dictionary";
		$conn = mysqli_connect($servername,$username,$password,$dbname);
		mysqli_set_charset($conn,'utf8mb4');
		$checkTable = "SELECT 1 FROM information_schema.tables WHERE table_schema ='$dbname' AND table_name = 'dictionary_resource' LIMIT 1";
		$result = mysqli_query($conn,$checkTable);
		if($result && mysqli_num_rows($result) == 0){
			$createTable = "CREATE TABLE dictionary_resource (
					id INT,
					word VARCHAR(255),
					definition TEXT
			) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
			mysqli_query($conn,$createTable);
			$path = "../csv/dictionary.csv";
			$filePath = fopen($path, "r");
			while (!feof($filePath)) {
				if (!$line = fgetcsv($filePath)) continue;

				$id 	= mysqli_real_escape_string($conn,$line[0]);
				$word 	= mysqli_real_escape_string($conn, mb_convert_encoding($line[1], 'UTF-8', 'Windows-1252'));
				$def 	= mysqli_real_escape_string($conn, mb_convert_encoding($line[2], 'UTF-8', 'Windows-1252'));

				$importSQL = "INSERT INTO dictionary_resource VALUES('$id','$word','$def')";
				mysqli_query($conn,$importSQL);
			}
			fclose($filePath);
		} else {
			//echo "Exist";
		}
		mysqli_close($conn);
	}

	checkIfDatabaseExist();
	checkIfTableExist();

 ?>