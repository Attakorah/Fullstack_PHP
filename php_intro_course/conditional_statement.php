<?php 

$score = 15;

if ($score >= 70 && $score <=100 ) {
	echo "A";
}elseif ($score >= 60 && $score < 70) {
	echo "B";
}elseif ($score >= 50 && $score < 60){
	echo "C";
}elseif ($score >= 45 && $score < 50){
	echo "D";
}elseif ($score >= 40 && $score < 45){
	echo "E";
}elseif ($score >= 0 && $score < 40){
	echo "F";
}else {
	echo "The score must be within 0 to 100";
}

 ?>