<?php 
/*
$cities = array("Sunyani","Kumasi","Accra","Cape Coast","Tamale");

	echo "City 1 is $cities[0]"."</br>";
	echo "City 2 is $cities[1]"."</br>";
	echo "City 3 is $cities[2]"."</br>";
$size = count($cities);
for ($i=0; $i < $size; $i++) { 
	echo "City ".($i+1) ." is $cities[$i]"."</br>";
}
*/

$numbers = array(5,-2,7,8,4);
$max = $numbers[0];

$size = count($numbers);
for ($i=0; $i < $size; $i++) { 

	$number = $numbers[$i];
	if($number > $max){
		$max = $number;
	}

	//echo $number."</br>";
}
echo $max;
 ?>