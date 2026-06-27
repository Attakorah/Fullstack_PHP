<?php 
/* Looping through multidimensional array first form
$numbers = array(
	array(1,2,3,4),
	array(2,4,6,8),
	array(3,6,9),
	array(5)
);

//echo $numbers[2][2];

for ($i=0; $i < count($numbers); $i++) { 

	//$child = $numbers[$i];
	for ($j=0; $j < count($numbers[$i]); $j++) { 

		echo $numbers[$i][$j]." ";
	}

	echo "</br>";
}
*/

/* Looping through multidimensional array second form
$ages = array(
	"male" => array("Emmanuel" => 14,"Attakorah" => 13,"Amaniampong" => 12),
	"female" => array("Comfort" => 12, "Abenaa" => 11,"Gyamfuah" => 10)
);

//echo $ages["male"]["Attakorah"];

foreach ($ages as $key => $value) {
	$child = $value;
	foreach ($child as $childKey => $childValue) {
		
		echo $childKey . " " . $childValue." ";
	}
	echo "</br>";
}
*/

/*Looping through multidimensional array third form
 $students = array(
 	array("Emmanuel" => 12,"Attakorah" => 14,"Amaniampong" => 15),
 	array("Comfort" => 13, "Abenaa" => 10,"Gyamfuah" => 14)
 );

 //echo $students[0]["Emmanuel"];

 for ($i=0; $i < count($students); $i++) { 

 	$child = $students[$i];
 	foreach ($child as $key => $value) {
 		echo $key." ".$value." ";
 	}
 	echo "</br>";
 }
*/

/*Looping through multidimensional array fourth form
$ages = array(
	"male" => array(2,4,6,8),
	"female" => array(3,6,9)
);

//echo $ages["male"][2];

foreach ($ages as $key => $value) {
	//$child = $value;

	for ($i=0; $i < count($value); $i++) { 
		echo $value[$i]." ";
	}
	echo "</br>";
}
*/

//Looping through multidimensional array with child and subchild
$results = array(
	"100level" => array(
		"mth101" => array(88,94,41),
		"chm101" => array(78,76,89),
		"phy101" => array(77,71,79)
	),
	"200level" => array(
		"mth201" => array(67,62,89,91),
		"chm201" => array(89,82,56)
	)
);

foreach ($results as $key => $value) {
	$child = $value;
	foreach ($child as $childKey => $childValue) {
		$subChild = $childValue;
		for ($i=0; $i < count($subChild); $i++) { 
			echo $subChild[$i]." ";
		}
		echo "</br>";
	}
	echo "</br>";
}
?>