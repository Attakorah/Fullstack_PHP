<?php 

$ages = array("Attakorah" => 13,"Emmanuel" => 14,"Amaniampong" => 15, "Kofi" => 11);

// echo $ages["Attakorah"]."</br>";
// echo $ages["Emmanuel"]."</br>";
// echo $ages["Amaniampong"]."</br>";
$maxAge = PHP_INT_MIN;
$name = "";
/*
foreach ($ages as $key => $value) {
	echo $key ." ". $value."</br>";
}*/

foreach ($ages as $key => $value) {
	if ($value > $maxAge) {
		$maxAge = $value;
		$name = $key;		
	}
}

echo "The name of the eldest person in the class is ".$name." who is ".$maxAge." years old.";

 ?>