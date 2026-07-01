<?php 
	include("createDatabase.php");
	include("connectionDB.php");
	//echo $_POST['search'];

	$data = array();
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$nameOfWord = $_POST['search'];
		$sql = "SELECT * FROM dictionary_resource WHERE name LIKE '%".$nameOfWord."%'";
		$result = mysqli_query($conn,$sql);
		if($result && mysqli_num_rows($result)== 1){
			while ($row = mysqli_fetch_assoc($result)) {
				$meaningOfWord = $row['meaning'];
				$nameOfWord = $row['name'];
			}
			$_SESSION['nameOfWord'] = $nameOfWord;
			$_SESSION['meaningOfWord'] = $meaningOfWord;
			$data['searchResult'] = $meaningOfWord;
			$data['success'] = "true";
		}else {
			$data['noResult'] = "Result for the search word does not exist in the dictionary";
			$data['failure'] = false;
		}
	}else {
		$data['noResult'] = "Result for the search word can't be empty";
		$data['failure'] = "false";
	}
	echo json_encode($data);

 ?>