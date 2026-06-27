<?php 

/* A function to add two numbers 
function addTwoNumbers($num1,$num2){
	$sum = $num1 + $num2;

	return $sum;
}

//$result = addTwoNumbers(25,35);
//echo $result;

echo addTwoNumbers(45,-15);
*/

/* A function for finding the max value in an array
function maxValueInArray($array){
	$max = PHP_INT_MIN;
	for ($i=0; $i < count($array); $i++) { 
		if ($array[$i] > $max) {
			$max = $array[$i];
		}
	}
	return $max;
}

$maxValue = maxValueInArray(array(-1,6,-19,35,55));
echo $maxValue;
*/

// A function to arrange the values in an array in reverse order
function reverseArray($array){
	$i = 0;
	$j = count($array) -1;

	while ($i < $j) {
		
		$array = swap($array,$i,$j);
		$i++;
		$j--;
	}
	return $array;
}

function swap($array,$position1,$position2){
	$temp = $array[$position2];
	$array[$position2] = $array[$position1];
	$array[$position1] = $temp;
	return $array;
}

function customPrint($array){
	for ($i=0; $i < count($array); $i++) { 
		echo $array[$i]." ";
	}
	return;
}
$reversedArray = reverseArray(array(1,2,3,4,5,6,7,8,9));
//customPrint($reversedArray);

/*Scope of variables
$variable = 2;
function sum($value){
	global $variable;
	echo $variable."</br>";
	return $value;
}
function show($value){
	echo $GLOBALS['variable']."</br>";
	return $value;
}

echo sum(10);
echo show(15);
*/

 ?>