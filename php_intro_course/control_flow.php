<?php 
/* While loop example
$value = rand(10, 14);
echo $value."</br>";

while ($value != 12) {
	echo "Hello World! $value"."</br>";
	$value = rand(10, 14);
	echo $value."</br>";
}
*/

//Do while loop example
/*
$value = -1;
do {
	echo "Hello World! $value"."</br>";
	$value = $value - 1;
} while ($value > 0);
*/

//For loop
for ($i=0; $i < 5; $i++) { 

	//if ($i == 2) break;
	if ($i == 2) continue;


	echo "Hello World! $i"."</br>";
}
echo "This is the end of the loop"
 ?>