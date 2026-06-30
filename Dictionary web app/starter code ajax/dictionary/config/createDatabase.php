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
		$checkTable = "SELECT 1 FROM information_schema.tables WHERE table_schema ='$dbname' AND table_name = 'dictionary_resource' LIMIT 1";
		$result = mysqli_query($conn,$checkTable);
		if ($result && mysqli_num_rows($result)>  0) {
			echo "exist";
		} else {
			echo "noExist";
		}
		mysqli_close($conn);
	}

	checkIfDatabaseExist();
	checkIfTableExist();

 ?>